Select t_jdw_krj_def.jdw_id,
  t_jdw_krj_def.pegawai_id,
  t_jdw_krj_def.tgl,
  t_jdw_krj_def.jk_id,
  t_jk.jk_nm,
  pegawai.pegawai_pin,
  att_log.scan_date As scan_masuk,
  att_log1.scan_date As scan_keluar
From t_jdw_krj_def
  Inner Join t_jk On t_jdw_krj_def.jk_id = t_jk.jk_id
  Inner Join pegawai On t_jdw_krj_def.pegawai_id = pegawai.pegawai_id
  Inner Join att_log On pegawai.pegawai_pin = att_log.pin
  Inner Join att_log att_log1 On pegawai.pegawai_pin = att_log1.pin
Where (Cast(att_log.scan_date As date) = Cast(t_jdw_krj_def.tgl As date) And
  Hour(TimeDiff(t_jk.jk_m, Time(att_log.scan_date))) <= 1) Or
  (Cast(att_log1.scan_date As date) = Case
    When Left(t_jk.jk_kd, 2) = 'S3' Then Cast(t_jdw_krj_def.tgl + Interval 1
    Day As date) Else Cast(t_jdw_krj_def.tgl As date)
  End And Hour(TimeDiff(t_jk.jk_k, Time(att_log1.scan_date))) <= 1)
