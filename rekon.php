<?php
include "conn.php";

mysql_connect($hostname_conn, $username_conn, $password_conn) or die ("Tidak bisa terkoneksi ke Database server");
mysql_select_db($database_conn) or die ("Database tidak ditemukan");

$msql = "
	select
		  a.*
		, b.jk_nm
		, b.jk_kd
		, b.jk_m
		, b.jk_k
		, c.pegawai_pin
	from
		t_jdw_krj_def a
		left join t_jk b on a.jk_id = b.jk_id
		left join pegawai c on a.pegawai_id = c.pegawai_id
	where
		a.pegawai_id = 295
		and (
		isnull(scan_masuk)
		or isnull(scan_keluar))
	"; //echo $msql; exit;
$mquery = mysql_query($msql);
//echo mysql_num_rows($mquery);
if (mysql_num_rows($mquery) < 0) {
	exit;	
}

while ($mrow = mysql_fetch_array($mquery)) {
	//echo $mrow["tgl"]."<br/>";
	if ($mrow["scan_masuk"] == null) {
		$msql = "
			select
				scan_date
			from
				att_log
			where
				pin = ".$mrow["pegawai_pin"]."
				and cast(scan_date as date) = cast('".$mrow["tgl"]."' as date)
				and cast(scan_date as time) between cast('1974-12-24 ".$mrow["jk_m"]."' - interval '60' minute as time) and cast('".$mrow["jk_m"]."' as time)
			"; //echo $msql; exit;
		$mquery2 = mysql_query($msql);
		if (mysql_num_rows($mquery2) > 0) {
			$mrow2 = mysql_fetch_array($mquery2);
			$msql = "update t_jdw_krj_def set scan_masuk = '".$mrow2["scan_date"]."' where jdw_id = ".$mrow["jdw_id"].""; //echo $msql."<br/>";
			mysql_query($msql);
		}
	}
	if ($mrow["scan_keluar"] == null) {
		$msql = "
			select
				scan_date
			from
				att_log
			where
				pin = ".$mrow["pegawai_pin"]."
				and cast(scan_date as date) = case when left('".$mrow["jk_kd"]."',2) = 'S3' then cast('".$mrow["tgl"]."'  + interval 1 day as date) else cast('".$mrow["tgl"]."' as date) end
				and cast(scan_date as time) between cast('".$mrow["jk_k"]."' as time) and cast('1974-12-24 ".$mrow["jk_k"]."' + interval '60' minute as time)
			"; echo $msql."<br/>"; //exit;
		$mquery2 = mysql_query($msql);
		if (mysql_num_rows($mquery2) > 0) {
			$mrow2 = mysql_fetch_array($mquery2);
			$msql = "update t_jdw_krj_def set scan_keluar = '".$mrow2["scan_date"]."' where jdw_id = ".$mrow["jdw_id"].""; //echo $msql."<br/>";
			mysql_query($msql);
		}
	}
}

/*
select
    , d.scan_masuk
    , e.scan_keluar
from
	t_jdw_krj_def a
    left join pegawai b on b.pegawai_id = a.pegawai_id
    left join t_jk c on a.jk_id = c.jk_id
    left join (
		select
			  pin
			, scan_date as scan_masuk
		from
			att_log
		where
			pin = 297
            and
            cast(scan_date as date) between cast('2017-03-05' as date) and cast('2017-03-11' as date)
    ) d on d.pin = b.pegawai_pin
    left join (
		select
			  pin
			, scan_date as scan_keluar
		from
			att_log
		where
			pin = 297
            and
            cast(scan_date as date) between cast('2017-03-05' as date) and cast('2017-03-11' as date)
    ) e on e.pin = b.pegawai_pin
where
	cast(a.tgl as date) between cast('2017-03-05' as date) and cast('2017-03-11' as date)
    and
    a.pegawai_id = 295
    and
    cast(d.scan_masuk as date) = cast(a.tgl as date)
	and hour(timediff(c.jk_m, time(d.scan_masuk))) <= 1
    and
    cast(e.scan_keluar as date) = case when left(c.jk_kd,2) = 'S3' then cast(a.tgl  + interval 1 day as date) else cast(a.tgl as date) end
	and hour(timediff(c.jk_k, time(e.scan_keluar))) <= 1
    
order by
	a.tgl
*/

?>