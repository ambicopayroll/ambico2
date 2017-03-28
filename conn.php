<?php
//echo "1: ".$_SERVER["REMOTE_ADDR"];
//echo "2: ".$_SERVER["HTTP_POST"];
if ($_SERVER["REMOTE_ADDR"] == "127.0.0.1"  || $_SERVER["REMOTE_ADDR"] == "::1"  || $_SERVER["HTTP_POST"] == "localhost" ) {
	$hostname_conn = "localhost";
	$database_conn = "fin_pro"; //$database_conn = "zecorind_mitra2";
	$username_conn = "root"; //$username_conn = "zecorind_root";
	$password_conn = "admin";
} elseif (ew_CurrentHost () == "ambico.nma-indonesia.com") { // setting koneksi database untuk komputer server
	$hostname_conn = "mysql.idhostinger.com";  // sesuaikan dengan ip address atau hostname komputer server
	$username_conn = "u945388674_ambic"; // sesuaikan dengan username database di komputer server
	$password_conn = "M457r1P 81"; // sesuaikan deengan password database di komputer server
	$database_conn = "u945388674_ambic"; // sesuaikan dengan nama database di komputer server
} elseif (ew_CurrentHost () == "ambico2.890m.com") { // setting koneksi database untuk komputer server
	$hostname_conn = "mysql.idhostinger.com";  // sesuaikan dengan ip address atau hostname komputer server
	$username_conn = "u616044283_ambic"; // sesuaikan dengan username database di komputer server
	$password_conn = "PresarioCQ43"; // sesuaikan deengan password database di komputer server
	$database_conn = "u616044283_ambic"; // sesuaikan dengan nama database di komputer server
}

?>