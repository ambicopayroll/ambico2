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

$mnama_tabel_temp = "t_tmp_rekon_".date("YmdHis");

$msql = "create table ".$mnama_tabel_temp." select * from rekon_master";
mysql_query($msql);

$msql = "select pin from att_log where cast(scan_date as date) between cast('2017-03-02' as date) and cast('2017-03-09' as date)
	group by pin
	";
$mquery = mysql_query($msql);
if (mysql_num_rows($mquery) > 0) {
	
	$msql2 = "select pin from att_log where cast(scan_date as date) between cast('2017-03-02' as date) and cast('2017-03-09' as date)
		group by pin
		";
	$mquery2 = mysql_query($msql2);
	while ($row2 = mysql_fetch_array($mquery2)) {
	
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
				cast(a.scan_date as date) between cast('2017-03-02' as date) and cast('2017-03-09' as date)
			order by
				a.scan_date
			";	
			
		$mdatapertama = true;
		$nomor_index_field = 0;

		$mquery3 = mysql_query($msql3);
		while ($row3 = mysql_fetch_array($mquery3)) {
			//echo $row["scan_date"]."<br/>";
			$mscan_date = strtotime($row3["scan_date"]);
			$mtgl = date("d-m-Y", $mscan_date); //echo $mtgl;
			$mjam = date("H:i:s", $mscan_date); //echo $mjam;
			$dotw = date("w", $mscan_date);
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
				$msql4 = "insert into ".$mnama_tabel_temp." (pegawai_id, f".++$nomor_index_field.") values ('".$row3["pegawai_id"]."', '".$mjam."')";
				mysql_query($msql4);
			}
			else {
				$msql4 = "update ".$mnama_tabel_temp." set f".++$nomor_index_field." = '".$mjam."' where pegawai_id = '".$row3["pegawai_id"]."'"; //echo $msql2;
				mysql_query($msql4);
			}
		}
	
	}

}
	



	




?>