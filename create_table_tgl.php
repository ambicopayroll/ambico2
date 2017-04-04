<?php

include "conn.php";

mysql_connect($hostname_conn, $username_conn, $password_conn) or die ("Tidak bisa terkoneksi ke Database server");
mysql_select_db($database_conn) or die ("Database tidak ditemukan");

$mtgl_awal = '2017-01-01';
$mtgl_akhir = '2017-12-31';

while (strtotime($mtgl_awal) <= strtotime($mtgl_akhir)) {
	$msql = "insert into t_tgl_2017 values (null, '".$mtgl_awal."')"; //echo $msql; exit;
	mysql_query($msql);
	$mtgl_awal = date("Y-m-d", strtotime("+1 day", strtotime($mtgl_awal)));
}

?>