Select att_log.sn As sn,
  att_log.scan_date As scan_date,
  att_log.pin As pin,
  att_log.att_id As att_id,
  Cast(Date_Format(att_log.scan_date, '%Y-%m-%d') As date) As scan_date_tgl,
  Date_Format(att_log.scan_date, '%d-%m-%Y %H:%i:%s') As scan_date_tgl_jam,
  pegawai.pegawai_nip,
  pegawai.pegawai_nama
From att_log
  left Join pegawai On att_log.pin = pegawai.pegawai_pin
