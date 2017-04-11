select
	a.pegawai_id
    , a.pegawai_nama
    , a.pegawai_nip
    , b.*
from
	pegawai a
    left join (select * from t_jdw_krj_def where cast(tgl as date) between cast('2017-03-02' as date) and cast('2017-03-08' as date)) b on a.pegawai_id = b.pegawai_id
-- where
	
-- group by
	-- a.pegawai_id
    
order by
	a.pegawai_nip
    , b.tgl