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
$image=$_FILES['configPicture']['name'];
//if it is not empty

if ($image)
{
	//get the original name of the file from the clients machine
	$filename = stripslashes($_FILES['configPicture']['name']);
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
		$size=filesize($_FILES['configPicture']['tmp_name']);

		//compare the size with the maxim size we defined and print error if bigger
		if ($size > MAX_SIZE*1024)
		{
			//echo '<h1>You have exceeded the size limit!</h1>';
			$errors='2';
		}
		if ($_FILES['configPicture']["error"] > 0)
		{
			echo "Return Code: " . $_FILES['configPicture']["error"] . "<br />";
		}
		else
		{
			echo "Upload: " . $_FILES['configPicture']["name"] . "<br />";
			echo "Type: " . $_FILES['configPicture']["type"] . "<br />";
			echo "Size: " . ($_FILES['configPicture']["size"] / 1024) . " Kb<br />";
			echo "Temp file: " . $_FILES['configPicture']["tmp_name"] . "<br />";
	
			if (file_exists("../uploads/" . $_FILES['configPicture']["name"]))
			{
				//echo $_FILES['configPicture']["name"] . " already exists. ";
				$errors='3';
			}
			else
			{
				move_uploaded_file($_FILES['configPicture']["tmp_name"], "../uploads/" . $_FILES['configPicture']["name"]);
				echo "Stored in: " . "../uploads/" . $_FILES['configPicture']["name"];
			}
		}
	}
}
//echo $errors;
if (!$errors) {
	include_once('db_conn.php');
	include_once('db_func.php');
	
	$m_id = $_POST['configMId'];
	$username = $_POST['configUsername'];
	/* $expireSecs = 0;
	if ($username == 'guest') {
		$expireSql=sprintf("SELECT `expire_secs` FROM `freead_expire` WHERE `m_level` = 3");
		$expireResult=db_query($expireSql);
		while ($row = db_fetch_array($expireResult)) {
			$expireSecs = $row['expire_secs'];
			break;
		}
	} */
	$a_position = $_POST['configPosition'];	
	$a_title = $_POST['configTitle'];
	$a_content = $_POST['configContent'];
	$a_picture = $_FILES['configPicture']['name'];
	$a_link = $_POST['configLink'];
	$a_phone = $_POST['configPhone'];
	$SQLStrUser = '';	
	if ($username == 'guest') {
		$trial_expire = $_POST['configExpire'];
		$SQLStrUser = "INSERT INTO freead_ad " .
		  			"(m_id, a_position, a_title, a_content, " . 
		            "a_picture, a_link, a_phone, trial_expire) VALUES(" .
		            "'$m_id', '$a_position', '$a_title', '$a_content', " .
		            "'$a_picture', '$a_link', '$a_phone', '$trial_expire') ";
	}
	else {
		$SQLStrUser = "INSERT INTO freead_ad " .
		  			"(m_id, a_position, a_title, a_content, " . 
		            "a_picture, a_link, a_phone) VALUES(" .
		            "'$m_id', '$a_position', '$a_title', '$a_content', " .
		            "'$a_picture', '$a_link', '$a_phone') ";
	}
	$res=db_query($SQLStrUser);
	//$return_arr = array();
	if(!$res) {
		$errors='4';
	}
} 
header("Location: add_new_ad.html?status=" . $errors . "&id=".$m_id."&username=".$username);	
die;
?>