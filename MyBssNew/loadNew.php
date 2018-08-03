<?php

require ("Db/dbHelp.php");

function queryAll(){
	global $mysqli;
	
	if(!$mysqli)  {
		echo"database error";
	}else{
		$mysqli->query('set names utf8;');
		$sql = "SELECT * FROM postdescribe order by releaseTime desc limit 0 , 2";//µ¹Ðð²éÑ¯ limit 0 , 2
		$result = $mysqli->query($sql);
		
		$response = array();
		$postData = array();
		$contentData = array();
		$moduleData = array();
		$userData = array();
		
		while($row = mysqli_fetch_assoc($result)){
			$postData[] = $row;	
			$contentData[] = queryContentId($row['postId']);
            $moduleData [] = queryModuleId($row['moduleId']);
            $userData[] = queryUserId($row['userId']);
			
			$response['postList'] = $postData;
			$response['contentList'] = $contentData;
            $response['moduleList'] = $moduleData;
            $response['userList'] = $userData;
		}
		
		echo json_encode($response);
	}
}

function queryContentId($postId){
	global $mysqli;
	if(!$mysqli)  {
		echo"database error";
	}else{
		$mysqli->query('set names utf8;');
		$sql = "select * from postcontent where postContentId = '$postId'";
		$result = $mysqli->query($sql);
		$row = mysqli_fetch_assoc($result);
	}
	return $row;
}
function queryModuleId($moduleId){
    global $mysqli;
    if(!$mysqli)  {
        echo"database error";
    }else{
        $mysqli->query('set names utf8;');
        $sql = "select * from postmodule where moduleId = '$moduleId'";
        $result = $mysqli->query($sql);
        $row = mysqli_fetch_assoc($result);
    }
    return $row;
}
function queryUserId($userId){
    global $mysqli;
    if(!$mysqli)  {
        echo"database error";
    }else{
        $mysqli->query('set names utf8;');
        $sql = "select * from bbs_user where userId = '$userId'";
        $result = $mysqli->query($sql);
        $row = mysqli_fetch_assoc($result);
    }
    return $row;
}


queryAll();
mysqli_close($mysqli);

?>