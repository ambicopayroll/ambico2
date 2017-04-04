<?php
include "adodb5/adodb.inc.php";

$conn = ADONewConnection('mysql');
$conn->Connect('localhost','root','admin','fin_pro');
$rs = $conn->Execute('select * from t_jdw_krj_peg order by pegawai_id, tgl1');

while (!$rs->EOF) {
	$mpegawai_id = $rs->fields["pegawai_id"];
	$conn->Execute("delete from t_jdw_krj_def where pegawai_id = ".$mpegawai_id."");
	while ($mpegawai_id == $rs->fields["pegawai_id"]) {
		$mtgl1 = $rs->fields["tgl1"];
		$mtgl2 = $rs->fields["tgl2"];
		while (strtotime($mtgl1) <= strtotime($mtgl2)) {
			$msql = "insert into t_jdw_krj_def values (null, ".$mpegawai_id.", '".$mtgl1."', ".$rs->fields["jk_id"].")";
			$conn->Execute($msql);
			$mtgl1 = date("Y-m-d", strtotime("+1 day", strtotime($mtgl1)));
		}
		$mtgl_terakhir = $rs->fields["tgl2"];
		$rs->MoveNext();
	}
	$mtgl_start = date("Y-m-d", strtotime("+1 day", strtotime($mtgl_terakhir)));
	while (date("Y", strtotime($mtgl_start)) < "2018") {
		$msql = "select jk_id,datediff(tgl2, tgl1)+1 as jk_id_count from t_jdw_krj_peg where pegawai_id = ".$mpegawai_id." order by tgl1";
		$rs2 = $conn->Execute($msql);
		while (!$rs2->EOF) {
			for ($i = 1; $i <= $rs2->fields["jk_id_count"]; $i++) {
				$conn->Execute("insert into t_jdw_krj_def values (null, ".$mpegawai_id.", '".$mtgl_start."', ".$rs2->fields["jk_id"].")");
				$mtgl_start = date("Y-m-d", strtotime("+1 day", strtotime($mtgl_start)));
			}
			$rs2->MoveNext();
		}
	}
}
$rs->Close();
$conn->Close();

header("location: ./generate_.php?ok=1");

?>