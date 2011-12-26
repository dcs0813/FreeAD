<?php
header('Content-type: application/json');

include_once('../../htmfiles/db_conn.php');
include_once('../../htmfiles/db_func.php');
if(isSet($_POST['type']))
{
	$type = $_POST['type'];
	$level = $_POST['level'];
	if ($type == 'get') {
		
		$sql=sprintf("SELECT `expire_secs` FROM `freead_expire` WHERE `m_level` = %d",
					db_escape($level) );
		$result=db_query($sql);
		while ($row = db_fetch_array($result)) {
			$return_arr = array();
			$return_arr["getExpire"]=$row['expire_secs'];
			$json_encoded_string = json_encode($return_arr);
			echo $json_encoded_string;
			die;
		}
	}
	else if ($type == 'set') {
		$expire = $_POST['expire_secs'];
		$expire = $expire * 24 * 60 * 60;
		$SQLStr = "UPDATE `freead_expire` SET `expire_secs` = '$expire' WHERE m_level= '$level'";
		$res = db_query($SQLStr);
		$expire_set = '';
		if($res == true) {
			$expire_set = 'success';
		}
		else {
			$expire_set = 'failed';
		}
		$return_arr["setExpire"] = $expire_set;
		$json_encoded_string = json_encode($return_arr);
		echo $json_encoded_string;
		die;
	}
}

?>
