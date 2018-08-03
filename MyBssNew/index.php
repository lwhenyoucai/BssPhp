<?php

require ("Db/dbHelp.php");

header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Credentials:true'); 
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type');  

//获取url参数
$action = isset($_POST['action']) ? $_POST['action'] : '';
$name = isset($_POST['username']) ? $_POST['username'] : '';
$psd = isset($_POST['password']) ? $_POST['password'] : '';
$clientCookies = isset($_POST['cookies'])?$_POST['cookies']:'';

$serverCookies = isset($_COOKIE['token'])?$_COOKIE['token']:'';

if(!$mysqli) {
    echo "数据库连接失败！".mysql_error;
}
if($action=='login') {
    login($name, $psd);
} else if($action=='register') {
    register($name, $psd);
} else if($action=='modifyPsd') {
    modifyPsd($name, $psd);
} else if($action=='showAll') {
    showAll();
} else if($action=='verification'){
    loginVerification($name, $psd);//登陆验证
}else {
    $result = array("result"=>"error_request");
    $json = json_encode($result);
    echo $json;
}

mysqli_close($mysqli);

/*用户登录*/
function login($name, $psd) {
    //$str = "123";
    //file_put_contents('C:\wamp\www\MyBss\Log\test.txt',$str);
    //global $mysqli;

    $mysqli = new mysqli(DBHOST, DBUSERNAME, DBUSERPSW,DBNAME);
    if($mysqli) {

        $mysqli->query('set names utf8;');
        $sql = "select * from bbs_user where user_name= '$name' and user_psw= '$psd'";
        $result = $mysqli->query($sql);
        $row = mysqli_fetch_assoc($result);

        $response = array();
          
        
        if($row > 0){
            //将登陆状态至为1
            $sql = "UPDATE bbs_user SET login_status='1' WHERE user_name= '$name' and user_psw= '$psd'";
            if(mysqli_query($mysqli,$sql)){
                $response["success"] = 1;
                setcookie("token",md5($name.$psd),time()+3600,'/');//创建cookies
            }

        }else{
            $response["success"] = 0;
        }
        echo json_encode($response);//以json的形式返回给客户端
    }
}
/**登录验证*/
function loginVerification($name, $psd) {
    /*$response = array();
     if($serverCookies!=$clientCookies){
        $response['success'] = 0;
        }else{
        $response['success'] = 1;
        }*/
    global $mysqli;
    if($mysqli) {
        $mysqli->query('set names utf8;');
        $sql = "select * from bbs_user where user_name= '$name' and user_psw= '$psd' and login_status='1'";
        $result = $mysqli->query($sql);
        $row = mysqli_fetch_assoc($result);
        $response = array();
        if($row>0){
            $response['success'] = 1;
        }else{
            $response['success'] = 0;
        }
    }

    echo json_encode($response);

}



/*用户注册*/
function register($name, $psd) {
    $userData = json_decode($_POST['jsonUserData'],true);
    global $mysqli;

    $email= $userData['user_email'];
    $postCount = $userData['post_count'];
    $loginStatus = $userData['login_status'];

    if($mysqli) {
        //数据库查询
        $result = $mysqli->query("select user_name from bbs_user");
        $exist = false;
        while($row = mysqli_fetch_assoc($result)) {
            if($name == $row['user_name']) {
                //注册失败，用户名已存在;
                $exist = true;
                $register_result = array("register_result"=>0);
                $json = json_encode($register_result);
                echo $json;
            }
        }
        //插入数据库
        if(!$exist) {
            //$id = mysqli_fetch_assoc($result) + 1;
            $sql = "insert into bbs_user (user_name,user_psw,user_email,post_count,login_status) 
			values('$name','$psd', '$email','$postCount','$loginStatus')";
            $success = $mysqli->query($sql);
            if($success) {
                //注册成功
                $register_result = array("register_result"=>1);
                $json = json_encode($register_result);
                echo $json;
            } else {
                //注册失败，数据库插入错误
                $register_result = array("register_result"=>2);
                $json = json_encode($register_result);
                echo $json;
            }
        }
    }
}

/*修改登录密码*/
function modifyPsd($name, $psd) {
    $newpsd = $_POST['newpsd'];
    global $mysqli;

    if($mysqli) {
        //用户登录
        $login_result = login($name, $psd);
        //修改密码
        if($login_result) {
            $success = mysqli_query($mysqli,"update bbs_user set user_psw='$newpsd' where user_name='$name'");
            if($success) {
                //修改成功
                $modify_result = array("modify_result"=>$success);
                $json = json_encode($modify_result);
                echo $json;
            } else {
                //修改失败，数据库错误
                $modify_result = array("modify_result"=>$success,"error_code"=>1);
                $json = json_encode($modify_result);
                echo $json;
            }
        } else {
            //修改失败，登录失败
            $modify_result = array("modify_result"=>false,"error_code"=>2);
            $json = json_encode($modify_result);
            echo $json;
        }
    }
}

?>