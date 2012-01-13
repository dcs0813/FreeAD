<?php
//session_start();

//引入自訂的變數與資料庫設定檔
require_once('db_conn.php');
require_once('db_func.php');
//require_once('config.inc.php');

//定義 $maintext 變數, 用以存放網頁 maintext 區塊的 HTML 原始碼
$maintext='';
//定義 $errMsg 變數, 用以存放錯誤訊息
//$errMsg='';
//定義 $usrMsg 變數, 用以存放一般訊息
$usrMsg='';

//SESSION 的 m_id 變數儲存目前登入的使用者 ID
//若尚未建立, 則初始化之
if ( ! isset($_SESSION['m_id']) ) {
  $_SESSION['m_id'] = FALSE;
}

//------------------------ 登出功能 -------------------------------
//使用者按下登出連結時, 會以 GET 的方式傳入 logout 參數等於 1,
if ( isset($_GET['logout']) && $_GET['logout'] == 1 ){
  $_SESSION['m_id'] = FALSE;
  $_SESSION['m_username'] = FALSE;
  $usrMsg.='已經成功登出';
}


//------------------------ 登入功能 -------------------------------
//若收到帳號密碼, 便檢查是否正確
if (isset($_POST['loginUserName']) && isset($_POST['loginPassword'])) {
    	$sql=sprintf("SELECT `m_id`, `m_username` FROM `freead_member` WHERE `m_username` = '%s' AND `m_password` = '%s'",
						    	db_escape($_POST['loginUserName']),
								db_escape( md5($_POST['loginPassword'])) );
  $result=db_query($sql);
  $num=db_num_rows($result);
  $row=db_fetch_array($result);
  if ($num>0) {
    header("Location: ../index.html?status=loginSuccess&id=".$row['m_id']."&username=".$row['m_username']);
  }
  else {
  	header("Location: ../index.html?status=loginFailed");
  }
  die;
}
?>