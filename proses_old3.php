<?php
include "conn.php";

mysql_connect($hostname_conn, $username_conn, $password_conn) or die ("Tidak bisa terkoneksi ke Database server");
mysql_select_db($database_conn) or die ("Database tidak ditemukan");

$mstart = date("Y-m-d", strtotime($_POST["start"]));
$mend = date("Y-m-d", strtotime($_POST["end"]));

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
	"; echo $msql; exit;
$mquery = mysql_query($msql);
if (mysql_num_rows($mquery) > 0) {
	$mjum_rec = mysql_num_rows($mquery);
	$mdata_pertama = true;
	while ($mrow = mysql_fetch_array($mquery)) {
		if ($mdata_pertama) {
			$mdata_pertama = false;
			$mpin = $mrow["pin"];
			//$mscan_date_tgl = date("Y-m-d", strtotime($mrow["scan_date"]));
			$mscan_date_tgl = substr($mrow["att_id", 0, 8]);
		}
		if ($mpin == $mrow["pin"]) { // data masih pada posisi pin yang sama
			if ($mscan_date_tgl == substr($mrow["att_id", 0, 8])) { // data pada posisi tanggal yang sama
				$mdow = date("w", strtotime($mrow["scan_date"])); // menghasilkan nilai day of week, 0 = sunday, 6 = saturday, nilai = 3
				$mjam = date("H:i:s", strtotime($mrow["scan_date"])); // menghasilkan nilai jam pegawai saat finger, nilai = 05:52:00
				// mengambil field pembanding di tabel default yang sesuai dengan dow nya
				$mjam_m1 = $mrow["f".$mdow."m1"];
				list($h, $m, $s) = explode(":", $mjam_m1);
				$mjam_m1_cek = mktime($h-1, $m, $s, "1", "1", "1");
				
				$mjam_k1 = $mrow["f".$mdow."k1"];
				list($h, $m, $s) = explode(":", $mjam_k1);
				$mjam_k1_cek = mktime($h+1, $m, $s, "1", "1", "1");
				
				$mjam_m2 = $mrow["f".$mdow."m2"];
				list($h, $m, $s) = explode(":", $mjam_m2);
				$mjam_m2_cek = mktime($h-1, $m, $s, "1", "1", "1");
				
				$mjam_k2 = $mrow["f".$mdow."k2"];
				list($h, $m, $s) = explode(":", $mjam_k2);
				$mjam_k2_cek = mktime($h+1, $m, $s, "1", "1", "1");
				
				$mjam_m3 = $mrow["f".$mdow."m3"];
				list($h, $m, $s) = explode(":", $mjam_m3);
				$mjam_m3_cek = mktime($h-1, $m, $s, "1", "1", "1");
				
				$mjam_k3 = $mrow["f".$mdow."k3"];
				list($h, $m, $s) = explode(":", $mjam_k3);
				$mjam_k3_cek = mktime($h+1, $m, $s, "1", "1", "1");

				$mm1 = 0; $mk1 = 0;
				$mm2 = 0; $mk2 = 0;
				$mm3 = 0; $mk3 = 0;
				if (strtotime($mjam) <= strtotime($mjam_m1) and strtotime($mjam) >= strtotime($mjam_m1_cek)) {
					$mm1 = 1;
				}
				elseif (strtotime($mjam) >= strtotime($mjam_k1) and strtotime($mjam) <= strtotime($mjam_k1_cek)) {
					$mk1 = 1;
				}
				elseif (strtotime($mjam) <= strtotime($mjam_m2) and strtotime($mjam) >= strtotime($mjam_m2_cek)) {
					$mm2 = 1;
				}
				elseif (strtotime($mjam) >= strtotime($mjam_k2) and strtotime($mjam) <= strtotime($mjam_k2_cek)) {
					$mk2 = 1;
				}
				elseif (strtotime($mjam) <= strtotime($mjam_m3) and strtotime($mjam) >= strtotime($mjam_m3_cek)) {
					$mm3 = 1;
				}
				elseif (strtotime($mjam) >= strtotime($mjam_k3) and strtotime($mjam) <= strtotime($mjam_k3_cek)) {
					$mk3 = 1;
				}
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
}
?>