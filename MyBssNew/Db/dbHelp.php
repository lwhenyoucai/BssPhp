<?php

define("DBHOST","localhost");
define("DBUSERNAME","root");
define("DBUSERPSW","root");
define("DBNAME","mysamplebbs");
$mysqli = new mysqli(DBHOST, DBUSERNAME, DBUSERPSW,DBNAME);
header('content-type:application:json;charset=utf8');  
header('Access-Control-Allow-Origin:*');  
header('Access-Control-Allow-Methods:POST');  
header('Access-Control-Allow-Headers:x-requested-with,content-type');  
/*function query_Db(){

    $mysqli = new mysqli("localhost", "root", "123456","mysamplebbs");
    if(!$mysqli)  {
        echo"database error";
    }else{
        echo"php env successful";
        $mysqli->query('set names utf8;');
        $sql = "SELECT * FROM bbs_user";
        $result = $mysqli->query($sql);
        
        while($row = mysqli_fetch_assoc($result)){
            echo "<div style=\"height:24px; line-height:24px; font-weight:bold;\">"; //排版代码
            echo $row['user_name'] . "<br/>";
            echo "</div>"; //排版代码
        }

    }

}

function insert_Db(){
    $mysqli = new mysqli("localhost", "root", "123456","mysamplebbs");
    if(!$mysqli)  {
        echo"database error";
    }else{
        echo"php env successful";
        $mysqli->query('set names utf8;');
        $sql="INSERT INTO bbs_user (user_name,user_psw,user_email,post_count) VALUES ('yq','123456','yq@qq.com',0)";
        if($result = $mysqli->query($sql)){
            //echo "成功";
        }else{
            //echo "失败";
        }
    }
}*/
?>