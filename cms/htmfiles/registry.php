<?php
	header('Content-type: application/json');

	include_once('../../htmfiles/db_conn.php');
	include_once('../../htmfiles/db_func.php');
	
	//定義 myStripslashes 函式, 刪除 php 可能自動加上的 "\"
	function myStripslashes($value){
		if (get_magic_quotes_gpc())
		$value = stripslashes($value);
		return $value;
	}
	
	if(isSet($_POST['mode']))
	{
		$mode = $_POST['mode'];
		if ($mode == 'add') {
			$m_username = $_POST['username'];
			$m_password = $_POST['userpass'];
			$name = $_POST['name'];
			$phone = $_POST['phone'];
			$payment = $_POST['payment'];
			$initTime = $_POST['initTime'];
			$expireTime = $_POST['expireTime'];
			$is_delete = 0;
			$m_level = 2;
			// 新增會員基本資料 (member_info 資料表)
			$SQLStrUser = "INSERT INTO freead_member " .
					  			"(m_username, m_password, m_level, name, " . 
					            "phone, payment, expire, initTime, is_delete) VALUES(" .
					            "'$m_username', md5('$m_password'), '$m_level', '$name', " .
					            "'$phone', '$payment', '$expireTime', '$initTime', '$is_delete') ";
			$res=db_query($SQLStrUser);
			$return_arr = array();
			$registry_check = '';
			if($res == true) {
				// 若新增資料成功
				//echo '<script>alert("註冊成功！");</script>';
				$registry_check = 'success';
			}
			else { // 若新增失敗則顯示錯誤訊息並轉回第 1 步的網頁
				/* echo '<script>alert("註冊失敗...");' .
					  	         'location.href = "cms_edit.html";</script>'; */
				$registry_check = 'failed';
			}
			$return_arr["registry"] = $registry_check;
			$json_encoded_string = json_encode($return_arr);
			echo $json_encoded_string;
			die;
		}
		else if ($mode == 'update') {
			$m_id=mysql_real_escape_string(myStripslashes($_POST['userid']));
			
			$stack = array();
			$delcmd = false;
			if(isSet($_POST['is_delete'])) {
				$is_delete=mysql_real_escape_string(myStripslashes($_POST['is_delete']));
				//$sqlstr.= "`is_delete` = '" . $is_delete . "' ";
				$delcmd = true;
				array_push($stack, "`is_delete` = '" . $is_delete . "'");
			}
			if(isSet($_POST['username'])) {				
				$m_username=mysql_real_escape_string(myStripslashes($_POST['username']));
				//$sqlstr.= "`m_username` = '" . $m_username . "' ";
				array_push($stack, "`m_username` = '" . $m_username . "'");
			}
			if(isSet($_POST['userpass'])) {
				$m_password=mysql_real_escape_string(myStripslashes($_POST['userpass']));
				//$sqlstr.= "`m_password` = '" . md5($m_password) . "' ";
				array_push($stack, "`m_password` = '" . md5($m_password) . "'");
			}
			if(isSet($_POST['name'])) {
				$name=mysql_real_escape_string(myStripslashes($_POST['name']));
				//$sqlstr.= "`name` = '" . $name . "' ";
				array_push($stack, "`name` = '" . $name . "'");
			}
			if(isSet($_POST['phone'])) {
				$phone=mysql_real_escape_string(myStripslashes($_POST['phone']));
				//$sqlstr.= "`phone` = '" . $phone . "' ";
				array_push($stack, "`phone` = '" . $phone . "'");
			}	
			if(isSet($_POST['payment'])) {
				$payment=mysql_real_escape_string(myStripslashes($_POST['payment']));
				//$sqlstr.= "`payment` = '" . $payment . "' ";
				array_push($stack, "`payment` = '" . $payment . "'");
			}
			if(isSet($_POST['initTime'])) {
				$initTime=mysql_real_escape_string(myStripslashes($_POST['initTime']));
				//$sqlstr.= "`initTime` = '" . $initTime . "' ";
				array_push($stack, "`initTime` = '" . $initTime . "'");
			}	
			if(isSet($_POST['expireTime'])) {
				$expire=mysql_real_escape_string(myStripslashes($_POST['expireTime']));
				//$sqlstr.= "`expire` = '" . $expire . "' ";
				array_push($stack, "`expire` = '" . $expire . "'");
			}	
			$sqlstr = "UPDATE `freead_member` SET ";
			$count = sizeof($stack);
			for ($i = 0; $i < $count; $i++ ) {
				if ($i==$count-1) {
					$sqlstr.=($stack[$i]." ");
				}
				else {
					$sqlstr.=($stack[$i].", ");
				}
			}	
			$sqlstr.= " WHERE `m_id` = '" . $m_id . "'";
			$result=mysql_query($sqlstr);
			$registry_check = '';
			if (db_affected_rows() > 0) {
				$registry_check = '1';
				if($delcmd) {
					$registry_check = '2';
				}
			}
			else {
				$registry_check.='3';
				if($delcmd) {
					$registry_check = '4';
				}
			}
			//header("Location: cms_maintain.html?status=".$registry_check."&m_id=".$m_id);	
			$return_arr["data"] = $sqlstr;
			$return_arr["registry"] = $registry_check;
			$json_encoded_string = json_encode($return_arr);
			echo $json_encoded_string;
			die;			
		}
		else if ($mode == 'get' && isSet($_POST['m_id'])) {
			$m_id = $_POST['m_id'];
			$sql = sprintf("SELECT * FROM freead_member WHERE m_id = '" . db_escape($m_id) . "' AND is_delete=0" );
			$result=db_query($sql);
			while ($row = db_fetch_array($result)) {
				$return_arr = array();
				$return_arr["name"]=$row['name'];
				$return_arr["phone"]=$row['phone'];
				$return_arr["initTime"]=$row['initTime'];
				$return_arr["payment"]=$row['payment'];
				$return_arr["username"]=$row['m_username'];
				$return_arr["password"]=$row['m_password'];
				$return_arr["expireTime"]=$row['expire'];
				$json_encoded_string = json_encode($return_arr);
				echo $json_encoded_string;
				die;
			}
		}
		else if ($mode == 'getAll') {
			$sql = sprintf("SELECT m_id,m_username,expire FROM freead_member WHERE is_delete=0");
			$res=db_query($sql);
			if ( db_num_rows($res) > 0) {
				$json = array();
				while($result = mysql_fetch_array($res))
				{	
					$json[] = $result;
					/* $json[]['m_id'] = $result['m_id'];
					$json[]['m_username'] = $result['m_username'];
					$json[]['expire'] = $result['expire']; */
				}
				echo json_encode($json);
			}
			else {
				$json = array();
				echo json_encode($json);
			}
			die;
		}
		else if ($mode == 'get' && isSet($_POST['username'])) {
			$m_username = $_POST['username'];
			$sql=sprintf("SELECT * FROM freead_member WHERE m_username = '" . db_escape($username) . "' AND is_delete=0" );
			$result=db_query($sql);
			while ($row = db_fetch_array($result)) {
				$return_arr = array();
				$return_arr["name"]=$row['name'];
				$return_arr["phone"]=$row['phone'];
				$return_arr["initTime"]=$row['initTime'];
				$return_arr["payment"]=$row['payment'];
				$return_arr["username"]=$row['m_username'];
				$return_arr["password"]=$row['m_password'];
				$return_arr["expireTime"]=$row['expire'];
				$json_encoded_string = json_encode($return_arr);
				echo $json_encoded_string;
				die;
			}
		}
	}
	

?>
