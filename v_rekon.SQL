Select t_jdw_krj_def.jdw_id As jdw_id,
  t_jdw_krj_def.pegawai_id As pegawai_id,
  t_jdw_krj_def.tgl As tgl,
  t_jdw_krj_def.jk_id As jk_id,
  t_jdw_krj_def.scan_masuk As scan_masuk,
  t_jdw_krj_def.scan_keluar As scan_keluar,
  pegawai.pegawai_nama As pegawai_nama,
  pegawai.pegawai_pin As pegawai_pin,
  pegawai.pegawai_nip As pegawai_nip,
  t_jk.jk_nm As jk_nm,
  (Case
    When ((t_jdw_krj_def.scan_masuk Is Not Null) And
    (t_jdw_krj_def.scan_keluar Is Not Null)) Then t_jk.jk_kd Else Null
  End) As jk_kd,
  (Case
    When ((t_jdw_krj_def.scan_masuk Is Not Null) And
    (t_jdw_krj_def.scan_keluar Is Not Null)) Then t_jdw_krj_def.hk Else Null
  End) As gol_hk
From (t_jdw_krj_def
  Join pegawai On t_jdw_krj_def.pegawai_id = pegawai.pegawai_id)
  Join t_jk On t_jdw_krj_def.jk_id = t_jk.jk_id
