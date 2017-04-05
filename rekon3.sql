select
	b.jdw_id,
	a.pegawai_id,
    d.scan_date,
    b.tgl,
    c.jk_nm,
    c.jk_kd,
    c.jk_m,
    c.jk_k

from
	pegawai a
    left join t_jdw_krj_def b on b.pegawai_id = a.pegawai_id
	left join t_jk c on c.jk_id = b.jk_id
	left join att_log d on d.pin = a.pegawai_pin
where
	a.pegawai_id = 295
    and cast(b.tgl as date) between cast('2017-02-26' as date) and cast('2017-03-05' as date)
    and cast(d.scan_date as date) = cast(b.tgl as date)
	and hour(timediff(c.jk_m, time(d.scan_date))) <= 1
order by
	b.tgl,
    d.scan_date