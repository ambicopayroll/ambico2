<?php

// jdkr_id
// pegawai_id
// tgl_id
// jk_id

?>
<?php if ($t_jdkr_peg->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $t_jdkr_peg->TableCaption() ?></h4> -->
<table id="tbl_t_jdkr_pegmaster" class="table table-bordered table-striped ewViewTable">
<?php echo $t_jdkr_peg->TableCustomInnerHtml ?>
	<tbody>
<?php if ($t_jdkr_peg->jdkr_id->Visible) { // jdkr_id ?>
		<tr id="r_jdkr_id">
			<td><?php echo $t_jdkr_peg->jdkr_id->FldCaption() ?></td>
			<td<?php echo $t_jdkr_peg->jdkr_id->CellAttributes() ?>>
<span id="el_t_jdkr_peg_jdkr_id">
<span<?php echo $t_jdkr_peg->jdkr_id->ViewAttributes() ?>>
<?php echo $t_jdkr_peg->jdkr_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_jdkr_peg->pegawai_id->Visible) { // pegawai_id ?>
		<tr id="r_pegawai_id">
			<td><?php echo $t_jdkr_peg->pegawai_id->FldCaption() ?></td>
			<td<?php echo $t_jdkr_peg->pegawai_id->CellAttributes() ?>>
<span id="el_t_jdkr_peg_pegawai_id">
<span<?php echo $t_jdkr_peg->pegawai_id->ViewAttributes() ?>>
<?php echo $t_jdkr_peg->pegawai_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_jdkr_peg->tgl_id->Visible) { // tgl_id ?>
		<tr id="r_tgl_id">
			<td><?php echo $t_jdkr_peg->tgl_id->FldCaption() ?></td>
			<td<?php echo $t_jdkr_peg->tgl_id->CellAttributes() ?>>
<span id="el_t_jdkr_peg_tgl_id">
<span<?php echo $t_jdkr_peg->tgl_id->ViewAttributes() ?>>
<?php echo $t_jdkr_peg->tgl_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t_jdkr_peg->jk_id->Visible) { // jk_id ?>
		<tr id="r_jk_id">
			<td><?php echo $t_jdkr_peg->jk_id->FldCaption() ?></td>
			<td<?php echo $t_jdkr_peg->jk_id->CellAttributes() ?>>
<span id="el_t_jdkr_peg_jk_id">
<span<?php echo $t_jdkr_peg->jk_id->ViewAttributes() ?>>
<?php echo $t_jdkr_peg->jk_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
