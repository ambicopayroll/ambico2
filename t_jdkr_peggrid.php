<?php include_once "t_userinfo.php" ?>
<?php

// Create page object
if (!isset($t_jdkr_peg_grid)) $t_jdkr_peg_grid = new ct_jdkr_peg_grid();

// Page init
$t_jdkr_peg_grid->Page_Init();

// Page main
$t_jdkr_peg_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_jdkr_peg_grid->Page_Render();
?>
<?php if ($t_jdkr_peg->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft_jdkr_peggrid = new ew_Form("ft_jdkr_peggrid", "grid");
ft_jdkr_peggrid.FormKeyCountName = '<?php echo $t_jdkr_peg_grid->FormKeyCountName ?>';

// Validate form
ft_jdkr_peggrid.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		var checkrow = (gridinsert) ? !this.EmptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
			elm = this.GetElements("x" + infix + "_pegawai_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t_jdkr_peg->pegawai_id->FldCaption(), $t_jdkr_peg->pegawai_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_tgl");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t_jdkr_peg->tgl->FldCaption(), $t_jdkr_peg->tgl->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_tgl");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jdkr_peg->tgl->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_jk_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t_jdkr_peg->jk_id->FldCaption(), $t_jdkr_peg->jk_id->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft_jdkr_peggrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "pegawai_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "tgl", false)) return false;
	if (ew_ValueChanged(fobj, infix, "jk_id", false)) return false;
	return true;
}

// Form_CustomValidate event
ft_jdkr_peggrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft_jdkr_peggrid.ValidateRequired = true;
<?php } else { ?>
ft_jdkr_peggrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft_jdkr_peggrid.Lists["x_pegawai_id"] = {"LinkField":"x_pegawai_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_pegawai_nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"pegawai"};
ft_jdkr_peggrid.Lists["x_jk_id"] = {"LinkField":"x_jk_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_jk_nm","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t_jk"};

// Form object for search
</script>
<?php } ?>
<?php
if ($t_jdkr_peg->CurrentAction == "gridadd") {
	if ($t_jdkr_peg->CurrentMode == "copy") {
		$bSelectLimit = $t_jdkr_peg_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t_jdkr_peg_grid->TotalRecs = $t_jdkr_peg->SelectRecordCount();
			$t_jdkr_peg_grid->Recordset = $t_jdkr_peg_grid->LoadRecordset($t_jdkr_peg_grid->StartRec-1, $t_jdkr_peg_grid->DisplayRecs);
		} else {
			if ($t_jdkr_peg_grid->Recordset = $t_jdkr_peg_grid->LoadRecordset())
				$t_jdkr_peg_grid->TotalRecs = $t_jdkr_peg_grid->Recordset->RecordCount();
		}
		$t_jdkr_peg_grid->StartRec = 1;
		$t_jdkr_peg_grid->DisplayRecs = $t_jdkr_peg_grid->TotalRecs;
	} else {
		$t_jdkr_peg->CurrentFilter = "0=1";
		$t_jdkr_peg_grid->StartRec = 1;
		$t_jdkr_peg_grid->DisplayRecs = $t_jdkr_peg->GridAddRowCount;
	}
	$t_jdkr_peg_grid->TotalRecs = $t_jdkr_peg_grid->DisplayRecs;
	$t_jdkr_peg_grid->StopRec = $t_jdkr_peg_grid->DisplayRecs;
} else {
	$bSelectLimit = $t_jdkr_peg_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t_jdkr_peg_grid->TotalRecs <= 0)
			$t_jdkr_peg_grid->TotalRecs = $t_jdkr_peg->SelectRecordCount();
	} else {
		if (!$t_jdkr_peg_grid->Recordset && ($t_jdkr_peg_grid->Recordset = $t_jdkr_peg_grid->LoadRecordset()))
			$t_jdkr_peg_grid->TotalRecs = $t_jdkr_peg_grid->Recordset->RecordCount();
	}
	$t_jdkr_peg_grid->StartRec = 1;
	$t_jdkr_peg_grid->DisplayRecs = $t_jdkr_peg_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t_jdkr_peg_grid->Recordset = $t_jdkr_peg_grid->LoadRecordset($t_jdkr_peg_grid->StartRec-1, $t_jdkr_peg_grid->DisplayRecs);

	// Set no record found message
	if ($t_jdkr_peg->CurrentAction == "" && $t_jdkr_peg_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t_jdkr_peg_grid->setWarningMessage(ew_DeniedMsg());
		if ($t_jdkr_peg_grid->SearchWhere == "0=101")
			$t_jdkr_peg_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t_jdkr_peg_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t_jdkr_peg_grid->RenderOtherOptions();
?>
<?php $t_jdkr_peg_grid->ShowPageHeader(); ?>
<?php
$t_jdkr_peg_grid->ShowMessage();
?>
<?php if ($t_jdkr_peg_grid->TotalRecs > 0 || $t_jdkr_peg->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t_jdkr_peg">
<div id="ft_jdkr_peggrid" class="ewForm form-inline">
<?php if ($t_jdkr_peg_grid->ShowOtherOptions) { ?>
<div class="panel-heading ewGridUpperPanel">
<?php
	foreach ($t_jdkr_peg_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_t_jdkr_peg" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t_jdkr_peggrid" class="table ewTable">
<?php echo $t_jdkr_peg->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t_jdkr_peg_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t_jdkr_peg_grid->RenderListOptions();

// Render list options (header, left)
$t_jdkr_peg_grid->ListOptions->Render("header", "left");
?>
<?php if ($t_jdkr_peg->jdkr_id->Visible) { // jdkr_id ?>
	<?php if ($t_jdkr_peg->SortUrl($t_jdkr_peg->jdkr_id) == "") { ?>
		<th data-name="jdkr_id"><div id="elh_t_jdkr_peg_jdkr_id" class="t_jdkr_peg_jdkr_id"><div class="ewTableHeaderCaption"><?php echo $t_jdkr_peg->jdkr_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jdkr_id"><div><div id="elh_t_jdkr_peg_jdkr_id" class="t_jdkr_peg_jdkr_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t_jdkr_peg->jdkr_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t_jdkr_peg->jdkr_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t_jdkr_peg->jdkr_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t_jdkr_peg->pegawai_id->Visible) { // pegawai_id ?>
	<?php if ($t_jdkr_peg->SortUrl($t_jdkr_peg->pegawai_id) == "") { ?>
		<th data-name="pegawai_id"><div id="elh_t_jdkr_peg_pegawai_id" class="t_jdkr_peg_pegawai_id"><div class="ewTableHeaderCaption"><?php echo $t_jdkr_peg->pegawai_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pegawai_id"><div><div id="elh_t_jdkr_peg_pegawai_id" class="t_jdkr_peg_pegawai_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t_jdkr_peg->pegawai_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t_jdkr_peg->pegawai_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t_jdkr_peg->pegawai_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t_jdkr_peg->tgl->Visible) { // tgl ?>
	<?php if ($t_jdkr_peg->SortUrl($t_jdkr_peg->tgl) == "") { ?>
		<th data-name="tgl"><div id="elh_t_jdkr_peg_tgl" class="t_jdkr_peg_tgl"><div class="ewTableHeaderCaption"><?php echo $t_jdkr_peg->tgl->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tgl"><div><div id="elh_t_jdkr_peg_tgl" class="t_jdkr_peg_tgl">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t_jdkr_peg->tgl->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t_jdkr_peg->tgl->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t_jdkr_peg->tgl->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t_jdkr_peg->jk_id->Visible) { // jk_id ?>
	<?php if ($t_jdkr_peg->SortUrl($t_jdkr_peg->jk_id) == "") { ?>
		<th data-name="jk_id"><div id="elh_t_jdkr_peg_jk_id" class="t_jdkr_peg_jk_id"><div class="ewTableHeaderCaption"><?php echo $t_jdkr_peg->jk_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jk_id"><div><div id="elh_t_jdkr_peg_jk_id" class="t_jdkr_peg_jk_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t_jdkr_peg->jk_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t_jdkr_peg->jk_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t_jdkr_peg->jk_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t_jdkr_peg_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t_jdkr_peg_grid->StartRec = 1;
$t_jdkr_peg_grid->StopRec = $t_jdkr_peg_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t_jdkr_peg_grid->FormKeyCountName) && ($t_jdkr_peg->CurrentAction == "gridadd" || $t_jdkr_peg->CurrentAction == "gridedit" || $t_jdkr_peg->CurrentAction == "F")) {
		$t_jdkr_peg_grid->KeyCount = $objForm->GetValue($t_jdkr_peg_grid->FormKeyCountName);
		$t_jdkr_peg_grid->StopRec = $t_jdkr_peg_grid->StartRec + $t_jdkr_peg_grid->KeyCount - 1;
	}
}
$t_jdkr_peg_grid->RecCnt = $t_jdkr_peg_grid->StartRec - 1;
if ($t_jdkr_peg_grid->Recordset && !$t_jdkr_peg_grid->Recordset->EOF) {
	$t_jdkr_peg_grid->Recordset->MoveFirst();
	$bSelectLimit = $t_jdkr_peg_grid->UseSelectLimit;
	if (!$bSelectLimit && $t_jdkr_peg_grid->StartRec > 1)
		$t_jdkr_peg_grid->Recordset->Move($t_jdkr_peg_grid->StartRec - 1);
} elseif (!$t_jdkr_peg->AllowAddDeleteRow && $t_jdkr_peg_grid->StopRec == 0) {
	$t_jdkr_peg_grid->StopRec = $t_jdkr_peg->GridAddRowCount;
}

// Initialize aggregate
$t_jdkr_peg->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t_jdkr_peg->ResetAttrs();
$t_jdkr_peg_grid->RenderRow();
if ($t_jdkr_peg->CurrentAction == "gridadd")
	$t_jdkr_peg_grid->RowIndex = 0;
if ($t_jdkr_peg->CurrentAction == "gridedit")
	$t_jdkr_peg_grid->RowIndex = 0;
while ($t_jdkr_peg_grid->RecCnt < $t_jdkr_peg_grid->StopRec) {
	$t_jdkr_peg_grid->RecCnt++;
	if (intval($t_jdkr_peg_grid->RecCnt) >= intval($t_jdkr_peg_grid->StartRec)) {
		$t_jdkr_peg_grid->RowCnt++;
		if ($t_jdkr_peg->CurrentAction == "gridadd" || $t_jdkr_peg->CurrentAction == "gridedit" || $t_jdkr_peg->CurrentAction == "F") {
			$t_jdkr_peg_grid->RowIndex++;
			$objForm->Index = $t_jdkr_peg_grid->RowIndex;
			if ($objForm->HasValue($t_jdkr_peg_grid->FormActionName))
				$t_jdkr_peg_grid->RowAction = strval($objForm->GetValue($t_jdkr_peg_grid->FormActionName));
			elseif ($t_jdkr_peg->CurrentAction == "gridadd")
				$t_jdkr_peg_grid->RowAction = "insert";
			else
				$t_jdkr_peg_grid->RowAction = "";
		}

		// Set up key count
		$t_jdkr_peg_grid->KeyCount = $t_jdkr_peg_grid->RowIndex;

		// Init row class and style
		$t_jdkr_peg->ResetAttrs();
		$t_jdkr_peg->CssClass = "";
		if ($t_jdkr_peg->CurrentAction == "gridadd") {
			if ($t_jdkr_peg->CurrentMode == "copy") {
				$t_jdkr_peg_grid->LoadRowValues($t_jdkr_peg_grid->Recordset); // Load row values
				$t_jdkr_peg_grid->SetRecordKey($t_jdkr_peg_grid->RowOldKey, $t_jdkr_peg_grid->Recordset); // Set old record key
			} else {
				$t_jdkr_peg_grid->LoadDefaultValues(); // Load default values
				$t_jdkr_peg_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t_jdkr_peg_grid->LoadRowValues($t_jdkr_peg_grid->Recordset); // Load row values
		}
		$t_jdkr_peg->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t_jdkr_peg->CurrentAction == "gridadd") // Grid add
			$t_jdkr_peg->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t_jdkr_peg->CurrentAction == "gridadd" && $t_jdkr_peg->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t_jdkr_peg_grid->RestoreCurrentRowFormValues($t_jdkr_peg_grid->RowIndex); // Restore form values
		if ($t_jdkr_peg->CurrentAction == "gridedit") { // Grid edit
			if ($t_jdkr_peg->EventCancelled) {
				$t_jdkr_peg_grid->RestoreCurrentRowFormValues($t_jdkr_peg_grid->RowIndex); // Restore form values
			}
			if ($t_jdkr_peg_grid->RowAction == "insert")
				$t_jdkr_peg->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t_jdkr_peg->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t_jdkr_peg->CurrentAction == "gridedit" && ($t_jdkr_peg->RowType == EW_ROWTYPE_EDIT || $t_jdkr_peg->RowType == EW_ROWTYPE_ADD) && $t_jdkr_peg->EventCancelled) // Update failed
			$t_jdkr_peg_grid->RestoreCurrentRowFormValues($t_jdkr_peg_grid->RowIndex); // Restore form values
		if ($t_jdkr_peg->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t_jdkr_peg_grid->EditRowCnt++;
		if ($t_jdkr_peg->CurrentAction == "F") // Confirm row
			$t_jdkr_peg_grid->RestoreCurrentRowFormValues($t_jdkr_peg_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_jdkr_peg->RowAttrs = array_merge($t_jdkr_peg->RowAttrs, array('data-rowindex'=>$t_jdkr_peg_grid->RowCnt, 'id'=>'r' . $t_jdkr_peg_grid->RowCnt . '_t_jdkr_peg', 'data-rowtype'=>$t_jdkr_peg->RowType));

		// Render row
		$t_jdkr_peg_grid->RenderRow();

		// Render list options
		$t_jdkr_peg_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_jdkr_peg_grid->RowAction <> "delete" && $t_jdkr_peg_grid->RowAction <> "insertdelete" && !($t_jdkr_peg_grid->RowAction == "insert" && $t_jdkr_peg->CurrentAction == "F" && $t_jdkr_peg_grid->EmptyRow())) {
?>
	<tr<?php echo $t_jdkr_peg->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t_jdkr_peg_grid->ListOptions->Render("body", "left", $t_jdkr_peg_grid->RowCnt);
?>
	<?php if ($t_jdkr_peg->jdkr_id->Visible) { // jdkr_id ?>
		<td data-name="jdkr_id"<?php echo $t_jdkr_peg->jdkr_id->CellAttributes() ?>>
<?php if ($t_jdkr_peg->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_jdkr_id" name="o<?php echo $t_jdkr_peg_grid->RowIndex ?>_jdkr_id" id="o<?php echo $t_jdkr_peg_grid->RowIndex ?>_jdkr_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->jdkr_id->OldValue) ?>">
<?php } ?>
<?php if ($t_jdkr_peg->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_jdkr_peg_grid->RowCnt ?>_t_jdkr_peg_jdkr_id" class="form-group t_jdkr_peg_jdkr_id">
<span<?php echo $t_jdkr_peg->jdkr_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t_jdkr_peg->jdkr_id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_jdkr_id" name="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jdkr_id" id="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jdkr_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->jdkr_id->CurrentValue) ?>">
<?php } ?>
<?php if ($t_jdkr_peg->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jdkr_peg_grid->RowCnt ?>_t_jdkr_peg_jdkr_id" class="t_jdkr_peg_jdkr_id">
<span<?php echo $t_jdkr_peg->jdkr_id->ViewAttributes() ?>>
<?php echo $t_jdkr_peg->jdkr_id->ListViewValue() ?></span>
</span>
<?php if ($t_jdkr_peg->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_jdkr_id" name="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jdkr_id" id="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jdkr_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->jdkr_id->FormValue) ?>">
<input type="hidden" data-table="t_jdkr_peg" data-field="x_jdkr_id" name="o<?php echo $t_jdkr_peg_grid->RowIndex ?>_jdkr_id" id="o<?php echo $t_jdkr_peg_grid->RowIndex ?>_jdkr_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->jdkr_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_jdkr_id" name="ft_jdkr_peggrid$x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jdkr_id" id="ft_jdkr_peggrid$x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jdkr_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->jdkr_id->FormValue) ?>">
<input type="hidden" data-table="t_jdkr_peg" data-field="x_jdkr_id" name="ft_jdkr_peggrid$o<?php echo $t_jdkr_peg_grid->RowIndex ?>_jdkr_id" id="ft_jdkr_peggrid$o<?php echo $t_jdkr_peg_grid->RowIndex ?>_jdkr_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->jdkr_id->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t_jdkr_peg_grid->PageObjName . "_row_" . $t_jdkr_peg_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($t_jdkr_peg->pegawai_id->Visible) { // pegawai_id ?>
		<td data-name="pegawai_id"<?php echo $t_jdkr_peg->pegawai_id->CellAttributes() ?>>
<?php if ($t_jdkr_peg->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($t_jdkr_peg->pegawai_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t_jdkr_peg_grid->RowCnt ?>_t_jdkr_peg_pegawai_id" class="form-group t_jdkr_peg_pegawai_id">
<span<?php echo $t_jdkr_peg->pegawai_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t_jdkr_peg->pegawai_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" name="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->pegawai_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_jdkr_peg_grid->RowCnt ?>_t_jdkr_peg_pegawai_id" class="form-group t_jdkr_peg_pegawai_id">
<?php
$wrkonchange = trim(" " . @$t_jdkr_peg->pegawai_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t_jdkr_peg->pegawai_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t_jdkr_peg_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" id="sv_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" value="<?php echo $t_jdkr_peg->pegawai_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t_jdkr_peg->pegawai_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t_jdkr_peg->pegawai_id->getPlaceHolder()) ?>"<?php echo $t_jdkr_peg->pegawai_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_pegawai_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_jdkr_peg->pegawai_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" id="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->pegawai_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" id="q_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" value="<?php echo $t_jdkr_peg->pegawai_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft_jdkr_peggrid.CreateAutoSuggest({"id":"x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id","forceSelect":true});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t_jdkr_peg->pegawai_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id',m:0,n:10,srch:false});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" name="s_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" id="s_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" value="<?php echo $t_jdkr_peg->pegawai_id->LookupFilterQuery(false) ?>">
</span>
<?php } ?>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_pegawai_id" name="o<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" id="o<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->pegawai_id->OldValue) ?>">
<?php } ?>
<?php if ($t_jdkr_peg->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t_jdkr_peg->pegawai_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t_jdkr_peg_grid->RowCnt ?>_t_jdkr_peg_pegawai_id" class="form-group t_jdkr_peg_pegawai_id">
<span<?php echo $t_jdkr_peg->pegawai_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t_jdkr_peg->pegawai_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" name="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->pegawai_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t_jdkr_peg_grid->RowCnt ?>_t_jdkr_peg_pegawai_id" class="form-group t_jdkr_peg_pegawai_id">
<?php
$wrkonchange = trim(" " . @$t_jdkr_peg->pegawai_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t_jdkr_peg->pegawai_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t_jdkr_peg_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" id="sv_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" value="<?php echo $t_jdkr_peg->pegawai_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t_jdkr_peg->pegawai_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t_jdkr_peg->pegawai_id->getPlaceHolder()) ?>"<?php echo $t_jdkr_peg->pegawai_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_pegawai_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_jdkr_peg->pegawai_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" id="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->pegawai_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" id="q_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" value="<?php echo $t_jdkr_peg->pegawai_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft_jdkr_peggrid.CreateAutoSuggest({"id":"x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id","forceSelect":true});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t_jdkr_peg->pegawai_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id',m:0,n:10,srch:false});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" name="s_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" id="s_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" value="<?php echo $t_jdkr_peg->pegawai_id->LookupFilterQuery(false) ?>">
</span>
<?php } ?>
<?php } ?>
<?php if ($t_jdkr_peg->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jdkr_peg_grid->RowCnt ?>_t_jdkr_peg_pegawai_id" class="t_jdkr_peg_pegawai_id">
<span<?php echo $t_jdkr_peg->pegawai_id->ViewAttributes() ?>>
<?php echo $t_jdkr_peg->pegawai_id->ListViewValue() ?></span>
</span>
<?php if ($t_jdkr_peg->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_pegawai_id" name="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" id="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->pegawai_id->FormValue) ?>">
<input type="hidden" data-table="t_jdkr_peg" data-field="x_pegawai_id" name="o<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" id="o<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->pegawai_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_pegawai_id" name="ft_jdkr_peggrid$x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" id="ft_jdkr_peggrid$x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->pegawai_id->FormValue) ?>">
<input type="hidden" data-table="t_jdkr_peg" data-field="x_pegawai_id" name="ft_jdkr_peggrid$o<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" id="ft_jdkr_peggrid$o<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->pegawai_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jdkr_peg->tgl->Visible) { // tgl ?>
		<td data-name="tgl"<?php echo $t_jdkr_peg->tgl->CellAttributes() ?>>
<?php if ($t_jdkr_peg->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jdkr_peg_grid->RowCnt ?>_t_jdkr_peg_tgl" class="form-group t_jdkr_peg_tgl">
<input type="text" data-table="t_jdkr_peg" data-field="x_tgl" name="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_tgl" id="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_tgl" placeholder="<?php echo ew_HtmlEncode($t_jdkr_peg->tgl->getPlaceHolder()) ?>" value="<?php echo $t_jdkr_peg->tgl->EditValue ?>"<?php echo $t_jdkr_peg->tgl->EditAttributes() ?>>
<?php if (!$t_jdkr_peg->tgl->ReadOnly && !$t_jdkr_peg->tgl->Disabled && !isset($t_jdkr_peg->tgl->EditAttrs["readonly"]) && !isset($t_jdkr_peg->tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft_jdkr_peggrid", "x<?php echo $t_jdkr_peg_grid->RowIndex ?>_tgl", 0);
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_tgl" name="o<?php echo $t_jdkr_peg_grid->RowIndex ?>_tgl" id="o<?php echo $t_jdkr_peg_grid->RowIndex ?>_tgl" value="<?php echo ew_HtmlEncode($t_jdkr_peg->tgl->OldValue) ?>">
<?php } ?>
<?php if ($t_jdkr_peg->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_jdkr_peg_grid->RowCnt ?>_t_jdkr_peg_tgl" class="form-group t_jdkr_peg_tgl">
<input type="text" data-table="t_jdkr_peg" data-field="x_tgl" name="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_tgl" id="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_tgl" placeholder="<?php echo ew_HtmlEncode($t_jdkr_peg->tgl->getPlaceHolder()) ?>" value="<?php echo $t_jdkr_peg->tgl->EditValue ?>"<?php echo $t_jdkr_peg->tgl->EditAttributes() ?>>
<?php if (!$t_jdkr_peg->tgl->ReadOnly && !$t_jdkr_peg->tgl->Disabled && !isset($t_jdkr_peg->tgl->EditAttrs["readonly"]) && !isset($t_jdkr_peg->tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft_jdkr_peggrid", "x<?php echo $t_jdkr_peg_grid->RowIndex ?>_tgl", 0);
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t_jdkr_peg->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jdkr_peg_grid->RowCnt ?>_t_jdkr_peg_tgl" class="t_jdkr_peg_tgl">
<span<?php echo $t_jdkr_peg->tgl->ViewAttributes() ?>>
<?php echo $t_jdkr_peg->tgl->ListViewValue() ?></span>
</span>
<?php if ($t_jdkr_peg->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_tgl" name="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_tgl" id="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_tgl" value="<?php echo ew_HtmlEncode($t_jdkr_peg->tgl->FormValue) ?>">
<input type="hidden" data-table="t_jdkr_peg" data-field="x_tgl" name="o<?php echo $t_jdkr_peg_grid->RowIndex ?>_tgl" id="o<?php echo $t_jdkr_peg_grid->RowIndex ?>_tgl" value="<?php echo ew_HtmlEncode($t_jdkr_peg->tgl->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_tgl" name="ft_jdkr_peggrid$x<?php echo $t_jdkr_peg_grid->RowIndex ?>_tgl" id="ft_jdkr_peggrid$x<?php echo $t_jdkr_peg_grid->RowIndex ?>_tgl" value="<?php echo ew_HtmlEncode($t_jdkr_peg->tgl->FormValue) ?>">
<input type="hidden" data-table="t_jdkr_peg" data-field="x_tgl" name="ft_jdkr_peggrid$o<?php echo $t_jdkr_peg_grid->RowIndex ?>_tgl" id="ft_jdkr_peggrid$o<?php echo $t_jdkr_peg_grid->RowIndex ?>_tgl" value="<?php echo ew_HtmlEncode($t_jdkr_peg->tgl->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jdkr_peg->jk_id->Visible) { // jk_id ?>
		<td data-name="jk_id"<?php echo $t_jdkr_peg->jk_id->CellAttributes() ?>>
<?php if ($t_jdkr_peg->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jdkr_peg_grid->RowCnt ?>_t_jdkr_peg_jk_id" class="form-group t_jdkr_peg_jk_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id"><?php echo (strval($t_jdkr_peg->jk_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t_jdkr_peg->jk_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t_jdkr_peg->jk_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_jk_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_jdkr_peg->jk_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" id="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" value="<?php echo $t_jdkr_peg->jk_id->CurrentValue ?>"<?php echo $t_jdkr_peg->jk_id->EditAttributes() ?>>
<input type="hidden" name="s_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" id="s_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" value="<?php echo $t_jdkr_peg->jk_id->LookupFilterQuery() ?>">
</span>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_jk_id" name="o<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" id="o<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->jk_id->OldValue) ?>">
<?php } ?>
<?php if ($t_jdkr_peg->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_jdkr_peg_grid->RowCnt ?>_t_jdkr_peg_jk_id" class="form-group t_jdkr_peg_jk_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id"><?php echo (strval($t_jdkr_peg->jk_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t_jdkr_peg->jk_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t_jdkr_peg->jk_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_jk_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_jdkr_peg->jk_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" id="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" value="<?php echo $t_jdkr_peg->jk_id->CurrentValue ?>"<?php echo $t_jdkr_peg->jk_id->EditAttributes() ?>>
<input type="hidden" name="s_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" id="s_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" value="<?php echo $t_jdkr_peg->jk_id->LookupFilterQuery() ?>">
</span>
<?php } ?>
<?php if ($t_jdkr_peg->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jdkr_peg_grid->RowCnt ?>_t_jdkr_peg_jk_id" class="t_jdkr_peg_jk_id">
<span<?php echo $t_jdkr_peg->jk_id->ViewAttributes() ?>>
<?php echo $t_jdkr_peg->jk_id->ListViewValue() ?></span>
</span>
<?php if ($t_jdkr_peg->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_jk_id" name="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" id="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->jk_id->FormValue) ?>">
<input type="hidden" data-table="t_jdkr_peg" data-field="x_jk_id" name="o<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" id="o<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->jk_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_jk_id" name="ft_jdkr_peggrid$x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" id="ft_jdkr_peggrid$x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->jk_id->FormValue) ?>">
<input type="hidden" data-table="t_jdkr_peg" data-field="x_jk_id" name="ft_jdkr_peggrid$o<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" id="ft_jdkr_peggrid$o<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->jk_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_jdkr_peg_grid->ListOptions->Render("body", "right", $t_jdkr_peg_grid->RowCnt);
?>
	</tr>
<?php if ($t_jdkr_peg->RowType == EW_ROWTYPE_ADD || $t_jdkr_peg->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft_jdkr_peggrid.UpdateOpts(<?php echo $t_jdkr_peg_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t_jdkr_peg->CurrentAction <> "gridadd" || $t_jdkr_peg->CurrentMode == "copy")
		if (!$t_jdkr_peg_grid->Recordset->EOF) $t_jdkr_peg_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t_jdkr_peg->CurrentMode == "add" || $t_jdkr_peg->CurrentMode == "copy" || $t_jdkr_peg->CurrentMode == "edit") {
		$t_jdkr_peg_grid->RowIndex = '$rowindex$';
		$t_jdkr_peg_grid->LoadDefaultValues();

		// Set row properties
		$t_jdkr_peg->ResetAttrs();
		$t_jdkr_peg->RowAttrs = array_merge($t_jdkr_peg->RowAttrs, array('data-rowindex'=>$t_jdkr_peg_grid->RowIndex, 'id'=>'r0_t_jdkr_peg', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t_jdkr_peg->RowAttrs["class"], "ewTemplate");
		$t_jdkr_peg->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t_jdkr_peg_grid->RenderRow();

		// Render list options
		$t_jdkr_peg_grid->RenderListOptions();
		$t_jdkr_peg_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t_jdkr_peg->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t_jdkr_peg_grid->ListOptions->Render("body", "left", $t_jdkr_peg_grid->RowIndex);
?>
	<?php if ($t_jdkr_peg->jdkr_id->Visible) { // jdkr_id ?>
		<td data-name="jdkr_id">
<?php if ($t_jdkr_peg->CurrentAction <> "F") { ?>
<?php } else { ?>
<span id="el$rowindex$_t_jdkr_peg_jdkr_id" class="form-group t_jdkr_peg_jdkr_id">
<span<?php echo $t_jdkr_peg->jdkr_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t_jdkr_peg->jdkr_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_jdkr_id" name="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jdkr_id" id="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jdkr_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->jdkr_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_jdkr_id" name="o<?php echo $t_jdkr_peg_grid->RowIndex ?>_jdkr_id" id="o<?php echo $t_jdkr_peg_grid->RowIndex ?>_jdkr_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->jdkr_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jdkr_peg->pegawai_id->Visible) { // pegawai_id ?>
		<td data-name="pegawai_id">
<?php if ($t_jdkr_peg->CurrentAction <> "F") { ?>
<?php if ($t_jdkr_peg->pegawai_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_t_jdkr_peg_pegawai_id" class="form-group t_jdkr_peg_pegawai_id">
<span<?php echo $t_jdkr_peg->pegawai_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t_jdkr_peg->pegawai_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" name="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->pegawai_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t_jdkr_peg_pegawai_id" class="form-group t_jdkr_peg_pegawai_id">
<?php
$wrkonchange = trim(" " . @$t_jdkr_peg->pegawai_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t_jdkr_peg->pegawai_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t_jdkr_peg_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" id="sv_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" value="<?php echo $t_jdkr_peg->pegawai_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t_jdkr_peg->pegawai_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t_jdkr_peg->pegawai_id->getPlaceHolder()) ?>"<?php echo $t_jdkr_peg->pegawai_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_pegawai_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_jdkr_peg->pegawai_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" id="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->pegawai_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" id="q_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" value="<?php echo $t_jdkr_peg->pegawai_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft_jdkr_peggrid.CreateAutoSuggest({"id":"x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id","forceSelect":true});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t_jdkr_peg->pegawai_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id',m:0,n:10,srch:false});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" name="s_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" id="s_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" value="<?php echo $t_jdkr_peg->pegawai_id->LookupFilterQuery(false) ?>">
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t_jdkr_peg_pegawai_id" class="form-group t_jdkr_peg_pegawai_id">
<span<?php echo $t_jdkr_peg->pegawai_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t_jdkr_peg->pegawai_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_pegawai_id" name="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" id="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->pegawai_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_pegawai_id" name="o<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" id="o<?php echo $t_jdkr_peg_grid->RowIndex ?>_pegawai_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->pegawai_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jdkr_peg->tgl->Visible) { // tgl ?>
		<td data-name="tgl">
<?php if ($t_jdkr_peg->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t_jdkr_peg_tgl" class="form-group t_jdkr_peg_tgl">
<input type="text" data-table="t_jdkr_peg" data-field="x_tgl" name="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_tgl" id="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_tgl" placeholder="<?php echo ew_HtmlEncode($t_jdkr_peg->tgl->getPlaceHolder()) ?>" value="<?php echo $t_jdkr_peg->tgl->EditValue ?>"<?php echo $t_jdkr_peg->tgl->EditAttributes() ?>>
<?php if (!$t_jdkr_peg->tgl->ReadOnly && !$t_jdkr_peg->tgl->Disabled && !isset($t_jdkr_peg->tgl->EditAttrs["readonly"]) && !isset($t_jdkr_peg->tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft_jdkr_peggrid", "x<?php echo $t_jdkr_peg_grid->RowIndex ?>_tgl", 0);
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_jdkr_peg_tgl" class="form-group t_jdkr_peg_tgl">
<span<?php echo $t_jdkr_peg->tgl->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t_jdkr_peg->tgl->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_tgl" name="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_tgl" id="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_tgl" value="<?php echo ew_HtmlEncode($t_jdkr_peg->tgl->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_tgl" name="o<?php echo $t_jdkr_peg_grid->RowIndex ?>_tgl" id="o<?php echo $t_jdkr_peg_grid->RowIndex ?>_tgl" value="<?php echo ew_HtmlEncode($t_jdkr_peg->tgl->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jdkr_peg->jk_id->Visible) { // jk_id ?>
		<td data-name="jk_id">
<?php if ($t_jdkr_peg->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t_jdkr_peg_jk_id" class="form-group t_jdkr_peg_jk_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id"><?php echo (strval($t_jdkr_peg->jk_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t_jdkr_peg->jk_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t_jdkr_peg->jk_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_jk_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_jdkr_peg->jk_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" id="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" value="<?php echo $t_jdkr_peg->jk_id->CurrentValue ?>"<?php echo $t_jdkr_peg->jk_id->EditAttributes() ?>>
<input type="hidden" name="s_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" id="s_x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" value="<?php echo $t_jdkr_peg->jk_id->LookupFilterQuery() ?>">
</span>
<?php } else { ?>
<span id="el$rowindex$_t_jdkr_peg_jk_id" class="form-group t_jdkr_peg_jk_id">
<span<?php echo $t_jdkr_peg->jk_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t_jdkr_peg->jk_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_jk_id" name="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" id="x<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->jk_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jdkr_peg" data-field="x_jk_id" name="o<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" id="o<?php echo $t_jdkr_peg_grid->RowIndex ?>_jk_id" value="<?php echo ew_HtmlEncode($t_jdkr_peg->jk_id->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_jdkr_peg_grid->ListOptions->Render("body", "right", $t_jdkr_peg_grid->RowCnt);
?>
<script type="text/javascript">
ft_jdkr_peggrid.UpdateOpts(<?php echo $t_jdkr_peg_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t_jdkr_peg->CurrentMode == "add" || $t_jdkr_peg->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t_jdkr_peg_grid->FormKeyCountName ?>" id="<?php echo $t_jdkr_peg_grid->FormKeyCountName ?>" value="<?php echo $t_jdkr_peg_grid->KeyCount ?>">
<?php echo $t_jdkr_peg_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_jdkr_peg->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t_jdkr_peg_grid->FormKeyCountName ?>" id="<?php echo $t_jdkr_peg_grid->FormKeyCountName ?>" value="<?php echo $t_jdkr_peg_grid->KeyCount ?>">
<?php echo $t_jdkr_peg_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_jdkr_peg->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft_jdkr_peggrid">
</div>
<?php

// Close recordset
if ($t_jdkr_peg_grid->Recordset)
	$t_jdkr_peg_grid->Recordset->Close();
?>
<?php if ($t_jdkr_peg_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($t_jdkr_peg_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t_jdkr_peg_grid->TotalRecs == 0 && $t_jdkr_peg->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t_jdkr_peg_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t_jdkr_peg->Export == "") { ?>
<script type="text/javascript">
ft_jdkr_peggrid.Init();
</script>
<?php } ?>
<?php
$t_jdkr_peg_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t_jdkr_peg_grid->Page_Terminate();
?>
