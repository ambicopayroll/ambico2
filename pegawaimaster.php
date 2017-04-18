<?php

// pegawai_pin
// pegawai_nip
// pegawai_nama
// pegawai_telp
// tempat_lahir
// tgl_lahir
// pembagian1_id
// pembagian2_id
// pembagian3_id
// gender

?>
<?php if ($pegawai->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $pegawai->TableCaption() ?></h4> -->
<table id="tbl_pegawaimaster" class="table table-bordered table-striped ewViewTable">
<?php echo $pegawai->TableCustomInnerHtml ?>
	<tbody>
<?php if ($pegawai->pegawai_pin->Visible) { // pegawai_pin ?>
		<tr id="r_pegawai_pin">
			<td><?php echo $pegawai->pegawai_pin->FldCaption() ?></td>
			<td<?php echo $pegawai->pegawai_pin->CellAttributes() ?>>
<span id="el_pegawai_pegawai_pin">
<span<?php echo $pegawai->pegawai_pin->ViewAttributes() ?>>
<?php echo $pegawai->pegawai_pin->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->pegawai_nip->Visible) { // pegawai_nip ?>
		<tr id="r_pegawai_nip">
			<td><?php echo $pegawai->pegawai_nip->FldCaption() ?></td>
			<td<?php echo $pegawai->pegawai_nip->CellAttributes() ?>>
<span id="el_pegawai_pegawai_nip">
<span<?php echo $pegawai->pegawai_nip->ViewAttributes() ?>>
<?php echo $pegawai->pegawai_nip->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->pegawai_nama->Visible) { // pegawai_nama ?>
		<tr id="r_pegawai_nama">
			<td><?php echo $pegawai->pegawai_nama->FldCaption() ?></td>
			<td<?php echo $pegawai->pegawai_nama->CellAttributes() ?>>
<span id="el_pegawai_pegawai_nama">
<span<?php echo $pegawai->pegawai_nama->ViewAttributes() ?>>
<?php echo $pegawai->pegawai_nama->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->pegawai_telp->Visible) { // pegawai_telp ?>
		<tr id="r_pegawai_telp">
			<td><?php echo $pegawai->pegawai_telp->FldCaption() ?></td>
			<td<?php echo $pegawai->pegawai_telp->CellAttributes() ?>>
<span id="el_pegawai_pegawai_telp">
<span<?php echo $pegawai->pegawai_telp->ViewAttributes() ?>>
<?php echo $pegawai->pegawai_telp->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->tempat_lahir->Visible) { // tempat_lahir ?>
		<tr id="r_tempat_lahir">
			<td><?php echo $pegawai->tempat_lahir->FldCaption() ?></td>
			<td<?php echo $pegawai->tempat_lahir->CellAttributes() ?>>
<span id="el_pegawai_tempat_lahir">
<span<?php echo $pegawai->tempat_lahir->ViewAttributes() ?>>
<?php echo $pegawai->tempat_lahir->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->tgl_lahir->Visible) { // tgl_lahir ?>
		<tr id="r_tgl_lahir">
			<td><?php echo $pegawai->tgl_lahir->FldCaption() ?></td>
			<td<?php echo $pegawai->tgl_lahir->CellAttributes() ?>>
<span id="el_pegawai_tgl_lahir">
<span<?php echo $pegawai->tgl_lahir->ViewAttributes() ?>>
<?php echo $pegawai->tgl_lahir->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->pembagian1_id->Visible) { // pembagian1_id ?>
		<tr id="r_pembagian1_id">
			<td><?php echo $pegawai->pembagian1_id->FldCaption() ?></td>
			<td<?php echo $pegawai->pembagian1_id->CellAttributes() ?>>
<span id="el_pegawai_pembagian1_id">
<span<?php echo $pegawai->pembagian1_id->ViewAttributes() ?>>
<?php echo $pegawai->pembagian1_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->pembagian2_id->Visible) { // pembagian2_id ?>
		<tr id="r_pembagian2_id">
			<td><?php echo $pegawai->pembagian2_id->FldCaption() ?></td>
			<td<?php echo $pegawai->pembagian2_id->CellAttributes() ?>>
<span id="el_pegawai_pembagian2_id">
<span<?php echo $pegawai->pembagian2_id->ViewAttributes() ?>>
<?php echo $pegawai->pembagian2_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->pembagian3_id->Visible) { // pembagian3_id ?>
		<tr id="r_pembagian3_id">
			<td><?php echo $pegawai->pembagian3_id->FldCaption() ?></td>
			<td<?php echo $pegawai->pembagian3_id->CellAttributes() ?>>
<span id="el_pegawai_pembagian3_id">
<span<?php echo $pegawai->pembagian3_id->ViewAttributes() ?>>
<?php echo $pegawai->pembagian3_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pegawai->gender->Visible) { // gender ?>
		<tr id="r_gender">
			<td><?php echo $pegawai->gender->FldCaption() ?></td>
			<td<?php echo $pegawai->gender->CellAttributes() ?>>
<span id="el_pegawai_gender">
<span<?php echo $pegawai->gender->ViewAttributes() ?>>
<?php echo $pegawai->gender->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
