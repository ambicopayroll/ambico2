select
	  a.jdw_id
    , a.pegawai_id
    , a.tgl
    , c.jk_nm
    , d.scan_masuk

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
    ) d on d.pin = b.pegawai_pin

where
	-- cast(a.tgl as date) between cast('2017-03-05' as date) and cast('2017-03-11' as date)
    (cast(d.scan_masuk as date) = cast(a.tgl as date)
	and hour(timediff(c.jk_m, time(d.scan_masuk))) <= 1)

order by
	a.tgl