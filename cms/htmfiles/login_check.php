<?php
  include_once('../../htmfiles/db_conn.php');
  include_once('../../htmfiles/db_func.php');
//   header('Content-Type: text/html; charset=utf-8');

  if (isset($_POST['admuser']) && $_POST['admuser'] == 'admin' || $_POST['admuser'] == 'root' ) {
  	if (isset($_POST['admuser']) && isset($_POST['admpass'])) {
  		$sql=sprintf("SELECT `m_id`, `m_username` FROM `freead_member` WHERE `m_username` = '%s' AND `m_password` = '%s' AND `m_level` = 1",
  		db_escape($_POST['admuser']),
  		db_escape( md5($_POST['admpass'])) );
  		$result=db_query($sql);
  		$num=db_num_rows($result);
  		$row=db_fetch_array($result);
  		if ($num>0) {
  			header("Location: cms_setup.html?status=loginSuccess&username=".$row['m_username']);
  		}
  		else {
  			header("Location: login.html?status=loginFailed");
  		}
  	
  	}  	
  }
  else {
  	header("Location: login.html?status=loginFailed");
  }
  die;
?>
