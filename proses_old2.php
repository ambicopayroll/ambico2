<?php
include("conn.php");

mysql_connect($hostname_conn, $username_conn, $password_conn) or die ("Tidak bisa terkoneksi ke Database server");
mysql_select_db($database_conn) or die ("Database tidak ditemukan");

// hitung selisih tanggal
$mstart = new DateTime(date("Y-m-d", strtotime($_POST["start"])));
$mend = new DateTime(date("Y-m-d", strtotime($_POST["end"])));
$mselisih = $mstart->diff($mend);
$mselisih_hari = $mselisih->format('%d') + 1;
$mstart = date("Y-m-d", strtotime($_POST["start"]));
$mend = date("Y-m-d", strtotime($_POST["end"]));
$mend_plus_1 = mktime(0, 0, 0, 
	date("m", strtotime($_POST["end"])), 
	date("d", strtotime($_POST["end"])) + 1, 
	date("Y", strtotime($_POST["end"])));
$mend_plus_1 = date("Y-m-d", $mend_plus_1); 
// echo $mend_plus_1; exit;

// ambil data hanya pin, dalam range tanggal yang dikehendaki, untuk mengetahui :: ada data atau tidak ada data
$msql = "
	select
		pin
	from
		att_log
	where
		cast(scan_date as date) between cast('".$mstart."' as date) and cast('".$mend_plus_1."' as date)
	group by
		pin
	";
$mquery = mysql_query($msql);
if (mysql_num_rows($mquery) > 0) {

	// create temporary table 
	$mnama_tabel_temp = "t_tmp_rekon_".date("YmdHis");
	$msql = "
		CREATE TABLE ".$mnama_tabel_temp." (
			`rm_id` int(11) NOT NULL AUTO_INCREMENT,
			`pegawai_id` int(11) NOT NULL,";
	$tgl = $_POST["start"];
	for ($i = 1; $i <= $mselisih_hari+1; $i++) {
		$mnama_field = date("Ymd", strtotime($tgl));
		$msql .= "`f_".$mnama_field."_in` datetime not null,`f".$mnama_field."_out` datetime not null,";
		$tgl = mktime(0, 0, 0, date("m", strtotime($tgl)), date("d", strtotime($tgl))+1, date("Y", strtotime($tgl)));
		$tgl = date("Y-m-d", $tgl);
	}
	$msql .= "
			PRIMARY KEY (`rm_id`)
		) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2"; //echo $msql; exit;
	mysql_query($msql);

	//collect data
	$msql2 = "
		select
			pin
		from
			att_log
		where
			cast(scan_date as date) between cast('".$mstart."' as date) and cast('".$mend_plus_1."' as date)
		group by
			pin
		";
	$mquery2 = mysql_query($msql2);
	while ($row2 = mysql_fetch_array($mquery2)) {
		
		$mdata_pertama = true;

		// update field genap (field scan masuk)
		$msql3 = "
			select
				min(a.scan_date) as min_scan_date,
				b.pegawai_id
			from
				att_log a
				left join pegawai b on a.pin = b.pegawai_pin
			where
				a.pin = '".$row2["pin"]."'
				and
				cast(scan_date as date) between cast('".$mstart."' as date) and cast('".$mend_plus_1."' as date)
			group by
				a.scan_date
			"; echo $msql3; exit;
		$mquery3 = mysql_query($msql3);
		while ($row3 = mysql_fetch_array($mquery3)) {
			if ($mdata_pertama) {
				$mdata_pertama = false;
				$msql4 = "insert into ".$mnama_tabel_temp." (pegawai_id) values ('".$row3["pegawai_id"]."')";
				mysql_query($msql4);
			}
			$mnama_field = date("Ymd", strtotime($row3["min_scan_date"]))."_in";
			$msql4 = "update ".$mnama_tabel_temp." set f_".$mnama_field." = '".$row3["min_scan_date"]."' where pegawai_id = '".$row3["pegawai_id"]."'";
			mysql_query($msql4); echo $msql4."<br/>";
		}
		
		// update field genap (field scan keluar)
		$msql3 = "
			select
				max(a.scan_date) as max_scan_date,
				b.pegawai_id
			from
				att_log a
				left join pegawai b on a.pin = b.pegawai_pin
			where
				a.pin = '".$row2["pin"]."'
				and
				cast(scan_date as date) between cast('".$mstart."' as date) and cast('".$mend_plus_1."' as date)
			group by
				a.scan_date
			";
		$mquery3 = mysql_query($msql3);
		while ($row3 = mysql_fetch_array($mquery3)) {
			$mnama_field = date("Ymd", strtotime($row3["max_scan_date"]))."_out";
			$msql4 = "update ".$mnama_tabel_temp." set f_".$mnama_field." = '".$row3["max_scan_date"]."' where pegawai_id = '".$row3["pegawai_id"]."'";
			mysql_query($msql4); echo $msql4."<br/>";
		}

	}

}

?>