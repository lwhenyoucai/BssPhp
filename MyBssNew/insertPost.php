<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/2
 * Time: 0:34
 */
require ("Db/dbHelp.php");
//获取url参数
$postContent = isset($_POST['postContent']) ? $_POST['postContent'] : '';

function receiveFile(){
    header('Content-type: application/json;charset=utf-8');
    if(empty($_FILES)) die('{"status":0,"msg":"错误提交"}');
    $dirPath = './heardResource/';//设置文件保存的目录
    if(!is_dir($dirPath)){
        @mkdir($dirPath);//目录不存在则创建目录
    }
    $count = count($_FILES);//所有文件数
    if($count<1) die('{"status":0,"msg":"错误提交"}');//没有提交的文件
    $success = $failure = 0;

    $imgArray = array();

    foreach($_FILES as $key => $value){
        //循环遍历数据
        $tmp = $value['name'];//获取上传文件名
        $tmpName = $value['tmp_name'];//临时文件路径
        //上传的文件会被保存到php临时目录，调用函数将文件复制到指定目录
        if(move_uploaded_file($tmpName,$dirPath.$tmp)){//date('YmdHis').'_'.
            $success++;
            $imgArray[] = "http://".$_SERVER['SERVER_ADDR']."/MyBssNew/heardResource/".$tmp;
        }else{
            $failure++;
        }
    }
    $arr['status'] = 1;
    $arr['msg']   = '提交成功';
    $arr['success'] = $success;
    $arr['failure'] = $failure;
    //echo json_encode($arr);//{"status":1,"msg":"\u63d0\u4ea4\u6210\u529f","success":3,"failure":0}

    return json_encode($imgArray);
}

function insertDataBase($postContent,$imgJson){
    $postData = json_decode($postContent,true);

    global $mysqli;
    $userId = $postData['userId'];
    $postContents = $postData['postContent'];
    $postTitle = $postData['postTitle'];
    $moduleId = $postData['moduleId'];
    $moduleTitle = $postData['moduleTitle'];
    $nullValue = " ";
    $zoValues = 0;
    //获取服务器时间
    date_default_timezone_set("Asia/Shanghai");
    $releaseTime = date("Y-m-d h:i:s");


    //$mysqli->query("set character set 'utf8'");//读库
    $mysqli->query("set names 'utf8'");//写库
    //其实读写都可以只加入
    //$mysqli->query("set names 'utf8'");

    $sql = "insert into postdescribe (postTitle,userId,moduleId,browsCount,likeCount,releaseTime) 
			values('$postTitle','$userId', '$moduleId','$zoValues','$zoValues','$releaseTime')";
    $postSuccess = $mysqli->query($sql);
    $oid = mysqli_insert_id($mysqli);

    $sqlContent = "insert into postcontent (postContentId,postContent,imagList,recordList,videoList) 
			values('$oid','$postContents', '$imgJson','$nullValue','$nullValue')";
    $postContentSuccess = $mysqli->query($sqlContent);

    /*$sqlModule = "insert into postmodule (moduleId,moduleTitle,moduleDesc)
			values('$oid','$moduleTitle', '$nullValue')";
    $postModuleSuccess = $mysqli->query($sqlModule);*/

    if($postSuccess&&$postContentSuccess){
        echo "success";
    }else{
        echo "failure";
    }

    //error_log($postContent,3,'./Log/test.log');

    //error_log($imgJson,3,'./Log/test111.log');

}
insertDataBase($postContent,receiveFile());

?>