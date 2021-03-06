CREATE TABLE IF NOT EXISTS `pegawai_default` (
  `pd_id` int(11) NOT NULL AUTO_INCREMENT,
  `pegawai_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `sk_msk_1` time not null,
  `sk_kel_1` time not null,
  `ju_msk_1` time not null,
  `ju_kel_1` time not null,
  `sa_msk_1` time not null,
  `sa_kel_1` time not null,
  `mi_msk_1` time not null,
  `mi_kel_1` time not null,
  `li_msk_1` time not null,
  `li_kel_1` time not null,
  `sk_msk_2` time not null,
  `sk_kel_2` time not null,
  `ju_msk_2` time not null,
  `ju_kel_2` time not null,
  `sa_msk_2` time not null,
  `sa_kel_2` time not null,
  `mi_msk_2` time not null,
  `mi_kel_2` time not null,
  `li_msk_2` time not null,
  `li_kel_2` time not null,
  `sk_msk_3` time not null,
  `sk_kel_3` time not null,
  `ju_msk_3` time not null,
  `ju_kel_3` time not null,
  `sa_msk_3` time not null,
  `sa_kel_3` time not null,
  `mi_msk_3` time not null,
  `mi_kel_3` time not null,
  `li_msk_3` time not null,
  `li_kel_3` time not null,

  PRIMARY KEY (`pd_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;