<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/5/2
 * Time: 23:22
 */

require ("Db/dbHelp.php");

$action = isset($_POST['action']) ? $_POST['action'] : '';
$browsCount = isset($_POST['browsCount'])?$_POST['browsCount']:'';
$likeCount = isset($_POST['likeCount'])?$_POST['likeCount']:'';
$postId = isset($_POST['postId'])?$_POST['postId']:'';

if($action=='brows'){
    addBrowsCount($postId,$browsCount);
}else if($action == 'like'){
    addLikeCount($postId,$likeCount);
}else{
    $result = array("result"=>"error_request");
    $json = json_encode($result);
    echo $json;
}

mysqli_close($mysqli);

function addBrowsCount($postId,$browsCount){
    global $mysqli;
    $success = mysqli_query($mysqli,"update postdescribe set browsCount='$browsCount' where postId='$postId'");
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

}

function addLikeCount($postId,$likeCount){
    global $mysqli;
    $success = mysqli_query($mysqli,"update postdescribe set likeCount='$likeCount' where postId='$postId'");
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
}

?>