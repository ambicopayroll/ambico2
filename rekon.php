<?php
include "adodb5/adodb.inc.php";

$conn = ADONewConnection('mysql');
//$conn->Connect('localhost','root','admin','fin_pro');

if ($_SERVER["HTTP_HOST"] == "localhost" ) { // testing on local PC
	$conn->Connect('localhost','root','admin','fin_pro');
} elseif ($_SERVER["HTTP_HOST"] == "ambico.nma-indonesia.com") { // setting koneksi database untuk komputer server
	$conn->Connect('mysql.idhostinger.com','u945388674_ambic','M457r1P 81','u945388674_ambic');
}

$mtgl_start = $_POST["start"];
$mtgl_end = $_POST["end"];

$rs = $conn->Execute('select * from t_jdw_krj_peg order by pegawai_id, tgl1');

?>