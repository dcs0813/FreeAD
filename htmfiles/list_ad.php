<?php
//include_once('session.php');
include_once('db_conn.php');
include_once('db_func.php');
header('Content-Type: text/html; charset=utf-8');

// 使用 JOIN 語法由 member、menber_info 及 member_extra 資料表
// 取得指定會員的全部資料
$SQLStr = "SELECT * FROM freead_member";
$res = db_query($SQLStr);
// 判斷查詢結果無資料, 則結束程式
/* if (db_num_rows($res)<=0) {
	echo "<script>";
	echo "alert(\"無此會員\");";
	echo "</script>";
	echo "<body onload = \"window.close();\">";
	exit();
} */

// ------------------------------------------------------
// 有資料才繼續執行
if (db_num_rows($res)>0) {
	$row = db_fetch_array($res);
	foreach ($row as $data)  // 顯示資料前, 先轉換特殊字元
	echo json_encode($data);
}
else {
	$json = array();
	echo json_encode($json);
}

/* $json = array();
$json[0] = array("Ted", "r0c2", "aaa", "台裔球星林書豪在推特上宣佈將加盟火箭，很興奮成為休士頓球隊的一員 ...", "", "http://www.yahoo.com.tw", "12345678", "12/27/2011 12:33 PM +0800");
$json[1] = array("Andy", "r1c1", "bbb", "內政部送修土地五法 不動產實價登錄 不作為課稅依據", "居住與土地正義是馬英九總統這次大選主打政見之一，上周二，他要求立法部門在本會期通過攸關土地改採市價徵收、不動產實價登錄等的「土地五法」。目前內政部與國民黨團已達成共識 ......。", "", "http://www.yahoo.com.tw", "12345678", "12/27/2011 12:33 PM +0800");
$json[2] = array("Amy", "r3c1", "ccc", "台裔球星林書豪在推特上宣佈將加盟火箭，很興奮成為休士頓球隊的一員 ...", "", "http://www.yahoo.com.tw", "12345678", "06/27/2012 12:33 PM +0800");
echo json_encode($json); */
?>