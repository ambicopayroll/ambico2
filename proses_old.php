<?php

function selisih($jam_masuk, $jam_keluar) {
	list($h, $m, $s) = explode(":", $jam_masuk);
	$dtawal = mktime($h, $m, $s, "1", "1", "1");
	list($h, $m, $s) = explode(":", $jam_keluar);
	$dtakhir = mktime($h, $m, $s, "1", "1", "1");
	$dtselisih = $dtakhir - $dtawal;
	
	$totalmenit = $dtselisih / 60;
	$jam = explode(".", $totalmenit / 60);
	$sisamenit = ($totalmenit / 60) - $jam[0];
	$sisamenit2 = $sisamenit * 60;
	
	return "$jam[0] jam $sisamenit2 menit";
}

/*function cek_valid($jam_scan, $ar_jam_check, $menit_range, $before, $after) {
	list($h, $m, $s) = explode(":", $jam_check);
	$dt_jam_check = mktime($h, $m, $s, "1", "1", "1");
	list($h, $m, $s) = explode(":", $jam_scan);
	$dt_jam_scan = mktime($h, $m, $s, "1", "1", "1");
	
	if ($jam_scan <= $jam_check) {
		
	}
	
	if ($before) { // untuk check scan masuk
		
	}
	else { // untuk check scan keluar
		
	}
	list($h, $m, $s) = explode(":", $jam_masuk);
	$dtawal = mktime($h, $m, $s, "1", "1", "1");
	list($h, $m, $s) = explode(":", $jam_keluar);
	$dtakhir = mktime($h, $m, $s, "1", "1", "1");
	$dtselisih = $dtakhir - $dtawal;
	
	$totalmenit = $dtselisih / 60;
	$jam = explode(".", $totalmenit / 60);
	$sisamenit = ($totalmenit / 60) - $jam[0];
	$sisamenit2 = $sisamenit * 60;
	
	return "$jam[0] jam $sisamenit2 menit";
}

echo selisih("07:00:00", "14:20:00")."<br/>";*/

include("conn.php");

mysql_connect($hostname_conn, $username_conn, $password_conn) or die ("Tidak bisa terkoneksi ke Database server");
mysql_select_db($database_conn) or die ("Database tidak ditemukan");

// hitung selisih tanggal
$mtgl1 = new DateTime(date("Y-m-d", strtotime($_POST["start"])));
$mtgl2 = new DateTime(date("Y-m-d", strtotime($_POST["end"])));
$minterval = $mtgl1->diff($mtgl2);
$mjml_hari = $minterval->format('%d') + 1;
$mtgl1_for = date("Y-m-d", strtotime($_POST["start"]));
$mtgl2_for = date("Y-m-d", strtotime($_POST["end"]));

$msql = "select pin from att_log where cast(scan_date as date) between cast('".$mtgl1_for."' as date) and cast('".$mtgl2_for."' as date)
	group by pin
	";
$mquery = mysql_query($msql);
if (mysql_num_rows($mquery) > 0) {
	
	$mnama_tabel_temp = "t_tmp_rekon_".date("YmdHis");
	$msql = "create table ".$mnama_tabel_temp." select * from rekon_master";
	mysql_query($msql);
	
	$msql2 = "select pin from att_log where cast(scan_date as date) between cast('".$mtgl1_for."' as date) and cast('".$mtgl2_for."' as date)
		group by pin
		";
	$mquery2 = mysql_query($msql2);
	while ($row2 = mysql_fetch_array($mquery2)) {
		$mdatapertama = true;
		$msql3 = "
			select
				a.scan_date,
				b.pegawai_id
			from
				att_log a
				left join pegawai b on a.pin = b.pegawai_pin
			where
				a.pin = '".$row2["pin"]."'
				and
				cast(scan_date as date) between cast('".$mtgl1_for."' as date) and cast('".$mtgl2_for."' as date)
			order by
				a.scan_date
			";
		$mquery3 = mysql_query($msql3);
		while ($row3 = mysql_fetch_array($mquery3)) {
			//0 = minggu
			//1 = senin
			//2 = selasa
			//3 = rabu
			//4 = kamis
			//5 = jumat
			//6 = sabtu
			//echo "<br/>";
			if ($mdatapertama) {
				$mdatapertama = false;
				$msql4 = "insert into ".$mnama_tabel_temp." (pegawai_id) values ('".$row3["pegawai_id"]."')";
				mysql_query($msql4);
				$mtgl_check = $mtgl1_for;
				$i = 1;
			}
			
			$mtgl_check = $mtgl1_for;
			//$i = 1;
			while (strtotime($mtgl_check) <= strtotime($mtgl2_for)) {
				//echo "mtgl_check = ".$mtgl_check." | mtgl_db = ".date("Y-m-d", strtotime($row3["scan_date"]))." ";
				if ($mtgl_check == date("Y-m-d", strtotime($row3["scan_date"]))) {
				//if (strtotime($mtgl_check) == strtotime($row3["scan_date"])) {
					$msql4 = "update ".$mnama_tabel_temp." set f".$i." = '".$row3["scan_date"]."' where pegawai_id = '".$row3["pegawai_id"]."'";
					mysql_query($msql4); echo $msql4."<br/>";
					//$mtgl_check = mktime(0, 0, 0, date("m", strtotime($mtgl_check)), date("d", strtotime($mtgl_check))+1, date("Y", strtotime($mtgl_check)));
					//$mtgl_check = date("Y-m-d", $mtgl_check);
					//$i++;
					break;
				}
				$mtgl_check = mktime(0, 0, 0, date("m", strtotime($mtgl_check)), date("d", strtotime($mtgl_check))+1, date("Y", strtotime($mtgl_check)));
				$mtgl_check = date("Y-m-d", $mtgl_check);
				$i++;
				//break;
			}

		}

	}

}

?>