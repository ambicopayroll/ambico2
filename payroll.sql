select
	a.pegawai_id
    , a.pegawai_nama
    , b.*
from
	pegawai a
    left join t_jdw_krj_def b on a.pegawai_id = b.pegawai_id
where
	cast(b.tgl as date) between cast('2017-02-26' as date) and cast('2017-03-04' as date)
-- group by
	-- a.pegawai_id
    
