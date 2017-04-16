<?php
include "adodb5/adodb.inc.php";

$conn = ADONewConnection('mysql');
//$conn->Connect('localhost','root','admin','fin_pro');

if ($_SERVER["HTTP_HOST"] == "localhost" ) { // testing on local PC
	$conn->Connect('localhost','root','admin','fin_pro');
} elseif ($_SERVER["HTTP_HOST"] == "ambico.nma-indonesia.com") { // setting koneksi database untuk komputer server
	$conn->Connect('mysql.idhostinger.com','u945388674_ambic','M457r1P 81','u945388674_ambic');
}

// echo "under progress ... ";

echo $_POST['start']." - ".$_POST['end']." - ";

$msql = "
	select * from
		v_rekon a
		left join t_rumus_peg b on a.pegawai_id = b.pegawai_id
		left join t_rumus c on b.rumus_id = c.rumus_id
	where
		tgl between '".$_POST['start']."' and '".$_POST['end']."'
		and c.hk_gol = a.gol_hk
	order by
		a.pegawai_id
		, tgl
	"; echo $msql; exit;

$rs = $conn->Execute($msql);

while (!$rs->EOF) {
	$mpegawai_id = $rs->fields["pegawai_id"];
	$mupah = 0;
	$mpremi_malam = 0;
	$mtidak_masuk = 0;
	$mpot_absen = 0;
	while ($mpegawai_id == $rs->fields["pegawai_id"]) {
		$mupah += $rs->fields["upah"];
		if (substr($rs->fields["jk_kd"], 0, 2) == "S3") {
			$mpremi_malam += $rs->fields["premi_malam"];
		}
		$mpremi_hadir = $rs->fields["premi_hadir"];
		if (is_null($rs->fields["gol_hk"])) {
			$mtidak_masuk = 1;
			$mpot_absen += $rs->fields["pot_absen"];
		}
		$rs->MoveNext();
	}
	$mtotal = $mupah + $mpremi_malam + $mpremi_hadir - $mpot_absen;
	echo $mupah." ".$mpremi_malam." ".($mtidak_masuk ? "0" : $mpremi_hadir)." ".$mtotal;
}
$rs->Close();
$conn->Close();

// header("location: ./payroll_.php?ok=1");

?>