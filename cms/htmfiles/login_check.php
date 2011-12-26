<?php
  include_once('../../htmfiles/db_conn.php');
  include_once('../../htmfiles/db_func.php');
  header('Content-Type: text/html; charset=utf-8');

  // 檢查帳號名稱及密碼
  $qrystr = "SELECT * FROM freead_member WHERE m_username ='$admuser'" .
            " AND md5('$userpass') = m_userpass";
  $res = db_query($qrystr);
  
  $script=''; // 用來儲存 JavaScript 的變數
  if (db_num_rows($res)>0) {  // 若帳號及密碼正確
    $row = db_fetch_array($res);
    
    if ($row['m_level'] == '1') {// 檢查等級是否為管理員
      // 在 session 中記錄管理員已登入
      session_start();
      $_SESSION['is_admin'] = true;

      $script= 'alert("登入成功！");' .
               'location.href = "cms_edit.html?mode=add";';
    }
    else // 密碼錯誤
      $script='alert("你沒有權限！");' .
              'location.href = "login.htm";';
  }
  else // 等級不夠 
      $script='alert("帳號或密碼錯誤！");' .
              'location.href = "login.htm";';

  // 輸出 JavaScript 程式
  echo "<script>$script</script>";  
?>
