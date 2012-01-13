<?php
header('Content-type: application/json');
//define a maxim size for the uploaded images in Kb
define ("MAX_SIZE","500");

//This function reads the extension of the file. It is used to determine if the file  is an image by checking the extension.
function getExtension($str) {
	$i = strrpos($str,".");
	if (!$i) {
		return "";
	}
	$l = strlen($str) - $i;
	$ext = substr($str,$i+1,$l);
	return $ext;
}

//This variable is used as a flag. The value is initialized with 0 (meaning no error  found)
//and it will be changed to 1 if an errro occures.
//If the error occures the file will not be uploaded.
$errors=0;
//checks if the form has been submitted
//reads the name of the file the user submitted for uploading
include_once('db_conn.php');
include_once('db_func.php');
if (isSet($_POST['is_delete'])) {
	$a_id = $_POST['maintainAId'];
	
	$preSql = sprintf("SELECT * FROM freead_ad WHERE freead_ad.a_id=%d", db_escape($a_id));
	$result=db_query($preSql);
	
	if ( db_num_rows($result)>0 ) {
		$is_delete = $_POST['is_delete'];
			
		$row=db_fetch_array($result);
		$o_is_delete = $row['is_delete'];
			
		if ($o_is_delete != $is_delete) {
			$sqlstr = "UPDATE `freead_ad` SET `is_delete` = '" . $is_delete . "' WHERE `a_id` = '" . $a_id . "'";
			$result=mysql_query($sqlstr);
			if (db_affected_rows() > 0) {
				;
			}
			else {
				$errors='4';
			}
		}
		$return_arr["result"] = $errors;
		echo json_encode($return_arr);
		die;		
	}
}
else {
	$image=$_FILES['maintainPicture']['name'];
	//if it is not empty
	
	if ($image)
	{
		//get the original name of the file from the clients machine
		$filename = stripslashes($_FILES['maintainPicture']['name']);
		//get the extension of the file in a lower case format
		$extension = getExtension($filename);
		$extension = strtolower($extension);
		//if it is not a known extension, we will suppose it is an error and will not  upload the file,
		//otherwise we will do more tests
		if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif"))
		{
			//print error message
			//echo '<h1>Unknown extension!</h1>';
			$errors='1';
		}
		else
		{
			//get the size of the image in bytes
			//$_FILES['image']['tmp_name'] is the temporary filename of the file
			//in which the uploaded file was stored on the server
			$size=filesize($_FILES['maintainPicture']['tmp_name']);
	
			//compare the size with the maxim size we defined and print error if bigger
			if ($size > MAX_SIZE*1024)
			{
				//echo '<h1>You have exceeded the size limit!</h1>';
				$errors='2';
			}
			if ($_FILES['maintainPicture']["error"] > 0)
			{
				echo "Return Code: " . $_FILES['maintainPicture']["error"] . "<br />";
			}
			else
			{
				echo "Upload: " . $_FILES['maintainPicture']["name"] . "<br />";
				echo "Type: " . $_FILES['maintainPicture']["type"] . "<br />";
				echo "Size: " . ($_FILES['maintainPicture']["size"] / 1024) . " Kb<br />";
				echo "Temp file: " . $_FILES['maintainPicture']["tmp_name"] . "<br />";
	
				if (file_exists("../uploads/" . $_FILES['maintainPicture']["name"]))
				{
					//echo $_FILES['maintainPicture']["name"] . " already exists. ";
					$errors='3';
				}
				else
				{
					move_uploaded_file($_FILES['maintainPicture']["tmp_name"], "../uploads/" . $_FILES['maintainPicture']["name"]);
					echo "Stored in: " . "../uploads/" . $_FILES['maintainPicture']["name"];
				}
			}
		}
	}
	//echo $errors;
	if (!$errors) {
		$a_id = $_POST['maintainAId'];
	
		$preSql = sprintf("SELECT * FROM freead_ad WHERE a_id=%d", db_escape($a_id));
		$result=db_query($preSql);
	
		if ( db_num_rows($result)>0 ) {
			$m_id = $_POST['maintainMId'];
			$username = $_POST['maintainUsername'];
			$a_title = $_POST['maintainTitle'];
			$a_content = $_POST['maintainContent'];
			$a_picture = $_FILES['maintainPicture']['name'];
			$a_link = $_POST['maintainLink'];
			$a_phone = $_POST['maintainPhone'];

			$row=db_fetch_array($result);
			$o_title = $row['a_title'];
			$o_content = $row['a_content'];
			$o_picture = $row['a_picture'];
			$o_link = $row['a_link'];
			$o_phone = $row['a_phone'];

			$stack = array();
			if ($o_title != $a_title) {
				array_push($stack, "`a_title` = '" . $a_title . "'");
			}
			if ($o_content != $a_content) {
				array_push($stack, "`a_content` = '" . $a_content . "'");
			}
			if ($image && $o_picture != $a_picture) {
				array_push($stack, "`a_picture` = '" . $a_picture . "'");
			}
			if ($o_link != $a_link) {
				array_push($stack, "`a_link` = '" . $a_link . "'");
			}
			if ($o_phone != $a_phone) {
				array_push($stack, "`a_phone` = '" . $a_phone . "'");
			}
				
			$sqlstr = "UPDATE `freead_ad` SET ";
			$count = sizeof($stack);
			for ($i = 0; $i < $count; $i++ ) {
				if ($i==$count-1) {
					$sqlstr.=($stack[$i]." ");
				}
				else {
					$sqlstr.=($stack[$i].", ");
				}
			}
			$sqlstr.= " WHERE `a_id` = '" . $a_id . "'";
			$result=mysql_query($sqlstr);
			if (db_affected_rows() <= 0) {
				$errors='4';
			}
			header("Location: maintain_ad.html?status=" . $errors . "&id=".$m_id."&username=".$username."&arg".$sqlstr);
			die;
		}
	}
}

?>
