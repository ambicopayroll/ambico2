<?php
include "conn.php";

mysql_connect($hostname_conn, $username_conn, $password_conn) or die ("Tidak bisa terkoneksi ke Database server");
mysql_select_db($database_conn) or die ("Database tidak ditemukan");

$mstart = date("Y-m-d", strtotime($_POST["start"]));
$mend = date("Y-m-d", strtotime($_POST["end"]));
$mrange_m = "0070";
$mrange_k = "0030";
$ar_hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");

$msql = "
	select
		a.pin,
		substring(a.att_id, 1, 8) as tanggal,
		substring(a.att_id, 9, 4) as jam,
		date_format(scan_date, '%w') as dow,
		c.*
	from
		att_log a
		left join pegawai b on a.pin = b.pegawai_pin
		left join pegawai_default c on b.pegawai_id = c.pegawai_id
	where
		pin = 53
		and cast(scan_date as date) between cast('".$mstart."' as date) and cast('".$mend."' as date)
	order by
		pin,
		scan_date
	"; //echo $msql; exit;
$mquery = mysql_query($msql);
if (mysql_num_rows($mquery) > 0) {
	$mdata_pertama = true;
	while ($mrow = mysql_fetch_array($mquery)) {
		if ($mdata_pertama) {
			$mdata_pertama = false;
			$mpin = $mrow["pin"];
			$mtanggal = $mrow["tanggal"];
		}
		//if ($mpin == $mrow["pin"]) { // data masih pada posisi pin yang sama
			if ($mtanggal == $mrow["tanggal"]) { // data pada posisi tanggal yang sama
				if ($mrow["jam"] <= $mrow["f".$mrow["dow"]."m1"] and $mrow["jam"] >= substr("00".($mrow["f".$mrow["dow"]."m1"]-$mrange_m), -4)) {
					echo $ar_hari[$mrow["dow"]]." - ".$mtanggal." - ".$mrow["jam"]." - ".substr("00".($mrow["f".$mrow["dow"]."m1"]-$mrange_m), -4)." s.d. ".$mrow["f".$mrow["dow"]."m1"]." - "." masuk shift 1<br/>";
				}
				elseif ($mrow["jam"] >= $mrow["f".$mrow["dow"]."k1"] and $mrow["jam"] <= substr("00".($mrow["f".$mrow["dow"]."k1"]+$mrange_k), -4)) {
					echo $ar_hari[$mrow["dow"]]." - ".$mtanggal." - ".$mrow["jam"]." - ".$mrow["f".$mrow["dow"]."k1"]." s.d. ".substr("00".($mrow["f".$mrow["dow"]."k1"]+$mrange_k), -4)." - "." keluar shift 1<br/>";
				}
				elseif ($mrow["jam"] <= $mrow["f".$mrow["dow"]."m2"] and $mrow["jam"] >= substr("00".($mrow["f".$mrow["dow"]."m2"]-$mrange_m), -4)) {
					echo $ar_hari[$mrow["dow"]]." - ".$mtanggal." - ".$mrow["jam"]." - ".substr("00".($mrow["f".$mrow["dow"]."m2"]-$mrange_m), -4)." s.d. ".$mrow["f".$mrow["dow"]."m2"]." - "." masuk shift 2<br/>";
				}
				elseif ($mrow["jam"] >= $mrow["f".$mrow["dow"]."k2"] and $mrow["jam"] <= substr("00".($mrow["f".$mrow["dow"]."k2"]+$mrange_k), -4)) {
					echo $ar_hari[$mrow["dow"]]." - ".$mtanggal." - ".$mrow["jam"]." - ".$mrow["f".$mrow["dow"]."k2"]." s.d. ".substr("00".($mrow["f".$mrow["dow"]."k2"]+$mrange_k), -4)." - "." keluar shift 2<br/>";
				}
				elseif ($mrow["jam"] <= $mrow["f".$mrow["dow"]."m3"] and $mrow["jam"] >= substr("00".($mrow["f".$mrow["dow"]."m3"]-$mrange_m), -4)) {
					echo $ar_hari[$mrow["dow"]]." - ".$mtanggal." - ".$mrow["jam"]." - ".substr("00".($mrow["f".$mrow["dow"]."m3"]-$mrange_m), -4)." s.d. ".$mrow["f".$mrow["dow"]."m3"]." - "." masuk shift 3<br/>";
				}
				elseif ($mrow["jam"] >= $mrow["f".$mrow["dow"]."k3"] and $mrow["jam"] <= substr("00".($mrow["f".$mrow["dow"]."k3"]+$mrange_k), -4)) {
					echo $ar_hari[$mrow["dow"]]." - ".$mtanggal." - ".$mrow["jam"]." - ".$mrow["f".$mrow["dow"]."k3"]." s.d. ".substr("00".($mrow["f".$mrow["dow"]."k3"]+$mrange_k), -4)." - "." keluar shift 3<br/>";
				}
				else {
					echo $ar_hari[$mrow["dow"]]." - ".$mtanggal." - ".$mrow["jam"]." - "." tidak valid<br/>";
				}
			}
			else {
				$mtanggal = $mrow["tanggal"];
				if ($mrow["jam"] <= $mrow["f".$mrow["dow"]."m1"] and $mrow["jam"] >= substr("00".($mrow["f".$mrow["dow"]."m1"]-$mrange_m), -4)) {
					echo $ar_hari[$mrow["dow"]]." - ".$mtanggal." - ".$mrow["jam"]." - ".substr("00".($mrow["f".$mrow["dow"]."m1"]-$mrange_m), -4)." s.d. ".$mrow["f".$mrow["dow"]."m1"]." - "." masuk shift 1<br/>";
				}
				elseif ($mrow["jam"] >= $mrow["f".$mrow["dow"]."k1"] and $mrow["jam"] <= substr("00".($mrow["f".$mrow["dow"]."k1"]+$mrange_k), -4)) {
					echo $ar_hari[$mrow["dow"]]." - ".$mtanggal." - ".$mrow["jam"]." - ".$mrow["f".$mrow["dow"]."k1"]." s.d. ".substr("00".($mrow["f".$mrow["dow"]."k1"]+$mrange_k), -4)." - "." keluar shift 1<br/>";
				}
				elseif ($mrow["jam"] <= $mrow["f".$mrow["dow"]."m2"] and $mrow["jam"] >= substr("00".($mrow["f".$mrow["dow"]."m2"]-$mrange_m), -4)) {
					echo $ar_hari[$mrow["dow"]]." - ".$mtanggal." - ".$mrow["jam"]." - ".substr("00".($mrow["f".$mrow["dow"]."m2"]-$mrange_m), -4)." s.d. ".$mrow["f".$mrow["dow"]."m2"]." - "." masuk shift 2<br/>";
				}
				elseif ($mrow["jam"] >= $mrow["f".$mrow["dow"]."k2"] and $mrow["jam"] <= substr("00".($mrow["f".$mrow["dow"]."k2"]+$mrange_k), -4)) {
					echo $ar_hari[$mrow["dow"]]." - ".$mtanggal." - ".$mrow["jam"]." - ".$mrow["f".$mrow["dow"]."k2"]." s.d. ".substr("00".($mrow["f".$mrow["dow"]."k2"]+$mrange_k), -4)." - "." keluar shift 2<br/>";
				}
				elseif ($mrow["jam"] <= $mrow["f".$mrow["dow"]."m3"] and $mrow["jam"] >= substr("00".($mrow["f".$mrow["dow"]."m3"]-$mrange_m), -4)) {
					echo $ar_hari[$mrow["dow"]]." - ".$mtanggal." - ".$mrow["jam"]." - ".substr("00".($mrow["f".$mrow["dow"]."m3"]-$mrange_m), -4)." s.d. ".$mrow["f".$mrow["dow"]."m3"]." - "." masuk shift 3<br/>";
				}
				elseif ($mrow["jam"] >= $mrow["f".$mrow["dow"]."k3"] and $mrow["jam"] <= substr("00".($mrow["f".$mrow["dow"]."k3"]+$mrange_k), -4)) {
					echo $ar_hari[$mrow["dow"]]." - ".$mtanggal." - ".$mrow["jam"]." - ".$mrow["f".$mrow["dow"]."k3"]." s.d. ".substr("00".($mrow["f".$mrow["dow"]."k3"]+$mrange_k), -4)." - "." keluar shift 3<br/>";
				}
				else {
					echo $ar_hari[$mrow["dow"]]." - ".$mtanggal." - ".$mrow["jam"]." - "." tidak valid<br/>";
				}
			}
		//}
	}
}
?>