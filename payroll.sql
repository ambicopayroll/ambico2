-- select * from v_rekon

select * from
	v_rekon a
    left join t_rumus_peg b on a.pegawai_id = b.pegawai_id
    left join t_rumus c on b.rumus_id = c.rumus_id
where
	tgl between '2017-03-02' and '2017-03-08'
    and c.hk_gol = a.gol_hk
order by
	a.pegawai_id
    , tgl