Select t_jdw_krj_def.jdw_id,
  t_jdw_krj_def.pegawai_id,
  t_jdw_krj_def.tgl,
  t_jdw_krj_def.jk_id,
  t_jdw_krj_def.scan_masuk,
  t_jdw_krj_def.scan_keluar,
  pegawai.pegawai_nama,
  pegawai.pegawai_pin,
  pegawai.pegawai_nip,
  t_jk.jk_nm,
  t_jk.jk_kd
From t_jdw_krj_def
  Inner Join pegawai On t_jdw_krj_def.pegawai_id = pegawai.pegawai_id
  Inner Join t_jk On t_jdw_krj_def.jk_id = t_jk.jk_id
