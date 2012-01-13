<?php
/*if(isSet($_POST['username']))
{
$usernames = array('john','michael','terry', 'steve', 'donald');

$username = $_POST['username'];

if(in_array($username, $usernames))
	{
	echo '<font color="red">The nickname <STRONG>'.$username.'</STRONG> is already in use.</font>';
	}
	else
	{
	echo 'OK';
	}
}*/


// This is a sample code in case you wish to check the username from a mysql db table

if(isSet($_POST['username']))
{
	$m_username = $_POST['username'];
	/*$dbHost = 'db_host_here'; // usually localhost
	$dbUsername = 'db_username_here';
	$dbPassword = 'db_password_here';
	$dbDatabase = 'db_name_here';*/	
	include_once('../../htmfiles/db_conn.php');
 	include_once('../../htmfiles/db_func.php');
	/*$db = mysql_connect($dbHost, $dbUsername, $dbPassword) or die ("Unable to connect to Database Server.");
	mysql_select_db ($dbDatabase, $db) or die ("Could not select database.");	
	$sql_check = mysql_query("select id from members where username='".$username."'") or die(mysql_error());*/
	$SQLStr = "SELECT m_username FROM freead_member " . 
    "WHERE m_username = '" . db_escape($username) . "' AND is_delete=0";
	
    $res = db_query($SQLStr);// 若查詢結果中有資料
    if (db_num_rows($res) == 1) // 表示名稱已被註冊
	/*if(mysql_num_rows($sql_check))*/
	{
		echo '<font color="red">使用者名稱 <STRONG>'.$username.'</STRONG> 已經註冊了.</font>';
	}
	else
	{

		echo 'OK';
	}

}

?>