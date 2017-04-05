select
	  a.jdw_id
    , a.pegawai_id
    , a.tgl
    , c.jk_nm
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