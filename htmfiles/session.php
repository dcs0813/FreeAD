<?php
  session_start();
  header('Content-Type: text/html; charset=utf-8');

  // 檢查是否已使用管理員身份登入
  if( $_SESSION['is_admin']!=true ) 
      echo "<script>" .
           "alert(\"請先登入\");" .
           "location.href = \"login.htm\";" .
           "</script>";
?>
