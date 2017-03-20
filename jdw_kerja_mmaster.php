<?php

// jdw_kerja_m_id
// jdw_kerja_m_kode
// jdw_kerja_m_name
// jdw_kerja_m_keterangan
// jdw_kerja_m_periode
// jdw_kerja_m_mulai
// jdw_kerja_m_type
// use_sama

?>
<?php if ($jdw_kerja_m->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $jdw_kerja_m->TableCaption() ?></h4> -->
<table id="tbl_jdw_kerja_mmaster" class="table table-bordered table-striped ewViewTable">
<?php echo $jdw_kerja_m->TableCustomInnerHtml ?>
	<tbody>
<?php if ($jdw_kerja_m->jdw_kerja_m_id->Visible) { // jdw_kerja_m_id ?>
		<tr id="r_jdw_kerja_m_id">
			<td><?php echo $jdw_kerja_m->jdw_kerja_m_id->FldCaption() ?></td>
			<td<?php echo $jdw_kerja_m->jdw_kerja_m_id->CellAttributes() ?>>
<span id="el_jdw_kerja_m_jdw_kerja_m_id">
<span<?php echo $jdw_kerja_m->jdw_kerja_m_id->ViewAttributes() ?>>
<?php echo $jdw_kerja_m->jdw_kerja_m_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($jdw_kerja_m->jdw_kerja_m_kode->Visible) { // jdw_kerja_m_kode ?>
		<tr id="r_jdw_kerja_m_kode">
			<td><?php echo $jdw_kerja_m->jdw_kerja_m_kode->FldCaption() ?></td>
			<td<?php echo $jdw_kerja_m->jdw_kerja_m_kode->CellAttributes() ?>>
<span id="el_jdw_kerja_m_jdw_kerja_m_kode">
<span<?php echo $jdw_kerja_m->jdw_kerja_m_kode->ViewAttributes() ?>>
<?php echo $jdw_kerja_m->jdw_kerja_m_kode->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($jdw_kerja_m->jdw_kerja_m_name->Visible) { // jdw_kerja_m_name ?>
		<tr id="r_jdw_kerja_m_name">
			<td><?php echo $jdw_kerja_m->jdw_kerja_m_name->FldCaption() ?></td>
			<td<?php echo $jdw_kerja_m->jdw_kerja_m_name->CellAttributes() ?>>
<span id="el_jdw_kerja_m_jdw_kerja_m_name">
<span<?php echo $jdw_kerja_m->jdw_kerja_m_name->ViewAttributes() ?>>
<?php echo $jdw_kerja_m->jdw_kerja_m_name->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($jdw_kerja_m->jdw_kerja_m_keterangan->Visible) { // jdw_kerja_m_keterangan ?>
		<tr id="r_jdw_kerja_m_keterangan">
			<td><?php echo $jdw_kerja_m->jdw_kerja_m_keterangan->FldCaption() ?></td>
			<td<?php echo $jdw_kerja_m->jdw_kerja_m_keterangan->CellAttributes() ?>>
<span id="el_jdw_kerja_m_jdw_kerja_m_keterangan">
<span<?php echo $jdw_kerja_m->jdw_kerja_m_keterangan->ViewAttributes() ?>>
<?php echo $jdw_kerja_m->jdw_kerja_m_keterangan->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($jdw_kerja_m->jdw_kerja_m_periode->Visible) { // jdw_kerja_m_periode ?>
		<tr id="r_jdw_kerja_m_periode">
			<td><?php echo $jdw_kerja_m->jdw_kerja_m_periode->FldCaption() ?></td>
			<td<?php echo $jdw_kerja_m->jdw_kerja_m_periode->CellAttributes() ?>>
<span id="el_jdw_kerja_m_jdw_kerja_m_periode">
<span<?php echo $jdw_kerja_m->jdw_kerja_m_periode->ViewAttributes() ?>>
<?php echo $jdw_kerja_m->jdw_kerja_m_periode->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($jdw_kerja_m->jdw_kerja_m_mulai->Visible) { // jdw_kerja_m_mulai ?>
		<tr id="r_jdw_kerja_m_mulai">
			<td><?php echo $jdw_kerja_m->jdw_kerja_m_mulai->FldCaption() ?></td>
			<td<?php echo $jdw_kerja_m->jdw_kerja_m_mulai->CellAttributes() ?>>
<span id="el_jdw_kerja_m_jdw_kerja_m_mulai">
<span<?php echo $jdw_kerja_m->jdw_kerja_m_mulai->ViewAttributes() ?>>
<?php echo $jdw_kerja_m->jdw_kerja_m_mulai->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($jdw_kerja_m->jdw_kerja_m_type->Visible) { // jdw_kerja_m_type ?>
		<tr id="r_jdw_kerja_m_type">
			<td><?php echo $jdw_kerja_m->jdw_kerja_m_type->FldCaption() ?></td>
			<td<?php echo $jdw_kerja_m->jdw_kerja_m_type->CellAttributes() ?>>
<span id="el_jdw_kerja_m_jdw_kerja_m_type">
<span<?php echo $jdw_kerja_m->jdw_kerja_m_type->ViewAttributes() ?>>
<?php echo $jdw_kerja_m->jdw_kerja_m_type->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($jdw_kerja_m->use_sama->Visible) { // use_sama ?>
		<tr id="r_use_sama">
			<td><?php echo $jdw_kerja_m->use_sama->FldCaption() ?></td>
			<td<?php echo $jdw_kerja_m->use_sama->CellAttributes() ?>>
<span id="el_jdw_kerja_m_use_sama">
<span<?php echo $jdw_kerja_m->use_sama->ViewAttributes() ?>>
<?php echo $jdw_kerja_m->use_sama->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
