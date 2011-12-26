<?php
	header('Content-type: application/json');

	include_once('../../htmfiles/db_conn.php');
	include_once('../../htmfiles/db_func.php');
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
		else if ($mode == 'edit') {		
			
		}
		else if ($mode == 'getAll') {
			$result = db_query("SELECT m_username FROM freead_member");
			$num = db_num_rows($result);
			$return_arr = array();
			$idx = 0;
			while ($row = db_fetch_array($result)) {
				$return_arr[$idx++]=$row['m_username'];
			}
			$json_encoded_string = json_encode($return_arr);
			echo $json_encoded_string;
			die;
		}
		else if ($mode == 'get') {
			$m_username = $_POST['username'];
			$sql=sprintf("SELECT * FROM freead_member WHERE m_username = '" . db_escape($username) . "'" );
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
