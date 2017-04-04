<?php
include "conn.php";

mysql_connect($hostname_conn, $username_conn, $password_conn) or die ("Tidak bisa terkoneksi ke Database server");
mysql_select_db($database_conn) or die ("Database tidak ditemukan");

$mstart = date("Y-m-d", strtotime($_POST["start"]));
$mend = date("Y-m-d", strtotime($_POST["end"]));

$msql = "select *, date_format(scan_date, '%Y-%m-%d') as scan_date_2 from att_log where pin = 53 and cast(scan_date as date) between cast('".$mstart."' as date) and cast('".$mend."' as date) order by pin, scan_date"; //echo $msql; exit;
$mquery = mysql_query($msql);
if (mysql_num_rows($mquery) > 0) {
	$mjum_rec = mysql_num_rows($mquery);
	$mdata_pertama = true;
	while ($mrow = mysql_fetch_array($mquery)) {
		if ($mdata_pertama) {
			$mdata_pertama = false;
			$mtgl_scan_date = $mrow["scan_date_2"];
			echo $mrow["pin"]." - ".date("w", strtotime($mrow["scan_date_2"]))." - ".$mrow["scan_date_2"];
			$mpegawai_id = $mrow["pin"];
			$mdow = date("w", strtotime($mrow["scan_date_2"]));
			$mscan_tgl = $mrow["scan_date_2"];
			$msql2 = "insert into kartu_scanlog (pegawai_id, dow, scan_tgl) values (".$mrow["pin"].", ".date("w", strtotime($mrow["scan_date_2"])).", '".$mrow["scan_date_2"]."')";
			mysql_query($msql2);
			$i = 1;
		}
		if ($mtgl_scan_date == $mrow["scan_date_2"]) {
			echo " - ".date("H:i:s", strtotime($mrow["scan_date"]));
			$msql2 = "update kartu_scanlog set scan_jam_".$i." = '".date("H:i:s", strtotime($mrow["scan_date"]))."' where pegawai_id = ".$mpegawai_id." and dow = ".$mdow." and scan_tgl = '".$mscan_tgl."'";
			mysql_query($msql2);
			$i++;
			//echo " - ".$msql2;
		}
		else {
			echo "<br/>";
			$mtgl_scan_date = $mrow["scan_date_2"];
			echo $mrow["pin"]." - ".date("w", strtotime($mrow["scan_date_2"]))." - ".$mrow["scan_date_2"]." - ".date("H:i:s", strtotime($mrow["scan_date"]));
			$mpegawai_id = $mrow["pin"];
			$mdow = date("w", strtotime($mrow["scan_date_2"]));
			$mscan_tgl = $mrow["scan_date_2"];
			$msql2 = "insert into kartu_scanlog (pegawai_id, dow, scan_tgl, scan_jam_1) values (".$mrow["pin"].", ".date("w", strtotime($mrow["scan_date_2"])).", '".$mrow["scan_date_2"]."', '".date("H:i:s", strtotime($mrow["scan_date"]))."')";
			mysql_query($msql2);
			$i = 2;
			//echo " - ".date("H:i:s", strtotime($mrow["scan_date"]));
			//$msql2 = "update kartu_scanlog set scan_jam_".$i." = '".date("H:i:s", strtotime($mrow["scan_date"]))."' where pegawai_id = ".$mpegawai_id." and dow = ".$mdow." and scan_tgl = '".$mscan_tgl."'";
			//mysql_query($msql2);
			//$i++;
		}
	}
}
?>