<?php
//include_once('session.php');
include_once('db_conn.php');
include_once('db_func.php');
header('Content-Type: text/html; charset=utf-8');

if(isSet($_POST['mode'])) {
	$mode = $_POST['mode'];
	if ($mode == 'getAll') {
		
		// 使用 JOIN 語法由 member、menber_info 及 member_extra 資料表
		// 取得指定會員的全部資料
		
		$SQLStr = sprintf("SELECT freead_member.m_username, freead_ad.a_position, freead_ad.a_title, freead_ad.a_content, freead_ad.a_picture, freead_ad.a_link, freead_ad.a_phone, freead_member.expire, freead_ad.trial_expire, freead_ad.m_id, freead_ad.a_id FROM freead_member RIGHT JOIN freead_ad ON freead_member.m_id = freead_ad.m_id WHERE freead_ad.is_delete=0");
		$res = db_query($SQLStr);
		//判斷查詢結果
		//有資料才繼續執行
		if ( db_num_rows($res) > 0) {
			$json = array();
			while($result = mysql_fetch_array($res))
			{
				$json[] = $result;
			}
			echo json_encode($json);
		}
		else {
			$json = array();
			echo json_encode($json);
		}
	}
	else if($mode == 'get') {		
		// 使用 JOIN 語法由 member、menber_info 及 member_extra 資料表
		// 取得指定會員的全部資料
		$a_id = $_POST['Aid'];
		$sql = sprintf("SELECT * FROM freead_ad WHERE a_id='" . $a_id . "'");
		$result=db_query($sql);
		while ($row = db_fetch_array($result)) {
			$return_arr = array();
			$return_arr["a_title"]=$row['a_title'];
			$return_arr["a_content"]=$row['a_content'];
			$return_arr["a_picture"]=$row['a_picture'];
			$return_arr["a_link"]=$row['a_link'];
			$return_arr["a_phone"]=$row['a_phone'];
			$json_encoded_string = json_encode($return_arr);
			echo $json_encoded_string;
			die;
		}
	} 
}

die;
/* $json = array();
$json[0] = array("Ted", "r0c2", "aaa", "台裔球星林書豪在推特上宣佈將加盟火箭，很興奮成為休士頓球隊的一員 ...", "", "http://www.yahoo.com.tw", "12345678", "12/27/2011 12:33 PM +0800");
$json[1] = array("Andy", "r1c1", "bbb", "內政部送修土地五法 不動產實價登錄 不作為課稅依據", "居住與土地正義是馬英九總統這次大選主打政見之一，上周二，他要求立法部門在本會期通過攸關土地改採市價徵收、不動產實價登錄等的「土地五法」。目前內政部與國民黨團已達成共識 ......。", "", "http://www.yahoo.com.tw", "12345678", "12/27/2011 12:33 PM +0800");
$json[2] = array("Amy", "r3c1", "ccc", "台裔球星林書豪在推特上宣佈將加盟火箭，很興奮成為休士頓球隊的一員 ...", "", "http://www.yahoo.com.tw", "12345678", "06/27/2012 12:33 PM +0800");
echo json_encode($json); */
?>