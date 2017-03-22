select
  b.pin,
  a.pegawai_pin,
  a.pegawai_nama,
  a.pegawai_nip,
  b.scan_date,
  c.jdw_kerja_m_id
from
  pegawai a
  left join att_log b on a.pegawai_pin = b.pin
  left join jdw_kerja_pegawai c on a.pegawai_id = c.pegawai_id
where
  a.pegawai_id = 144
  and
  cast(b.scan_date as date) between cast('2017-03-05' as date) and cast('2017-03-11' as date)