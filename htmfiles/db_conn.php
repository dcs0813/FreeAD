<?php
  $DB_HOST        = "localhost";    // 資料庫主機位置
  $DB_LOGIN       = "vhost20672";         // 資料庫的使用者帳號
  $DB_PASSWORD    = "19770813";       // 資料庫的使用者密碼
  $DB_NAME        = "vhost20672-2";        // 資料庫名稱

  $conn = mysql_connect($DB_HOST, $DB_LOGIN, $DB_PASSWORD);
  mysql_select_db($DB_NAME);
  mysql_set_charset('utf8', $conn);
?>
