<?php include_once "t_userinfo.php" ?>
<?php

// Create page object
if (!isset($t_jk_grid)) $t_jk_grid = new ct_jk_grid();

// Page init
$t_jk_grid->Page_Init();

// Page main
$t_jk_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_jk_grid->Page_Render();
?>
<?php if ($t_jk->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft_jkgrid = new ew_Form("ft_jkgrid", "grid");
ft_jkgrid.FormKeyCountName = '<?php echo $t_jk_grid->FormKeyCountName ?>';

// Validate form
ft_jkgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_jk_nm");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t_jk->jk_nm->FldCaption(), $t_jk->jk_nm->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_jk_kd");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t_jk->jk_kd->FldCaption(), $t_jk->jk_kd->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_jk_m");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t_jk->jk_m->FldCaption(), $t_jk->jk_m->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_jk_m");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jk->jk_m->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_jk_k");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t_jk->jk_k->FldCaption(), $t_jk->jk_k->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_jk_k");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jk->jk_k->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft_jkgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "jk_nm", false)) return false;
	if (ew_ValueChanged(fobj, infix, "jk_kd", false)) return false;
	if (ew_ValueChanged(fobj, infix, "jk_m", false)) return false;
	if (ew_ValueChanged(fobj, infix, "jk_k", false)) return false;
	if (ew_ValueChanged(fobj, infix, "jk_ket", false)) return false;
	return true;
}

// Form_CustomValidate event
ft_jkgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft_jkgrid.ValidateRequired = true;
<?php } else { ?>
ft_jkgrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
if ($t_jk->CurrentAction == "gridadd") {
	if ($t_jk->CurrentMode == "copy") {
		$bSelectLimit = $t_jk_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t_jk_grid->TotalRecs = $t_jk->SelectRecordCount();
			$t_jk_grid->Recordset = $t_jk_grid->LoadRecordset($t_jk_grid->StartRec-1, $t_jk_grid->DisplayRecs);
		} else {
			if ($t_jk_grid->Recordset = $t_jk_grid->LoadRecordset())
				$t_jk_grid->TotalRecs = $t_jk_grid->Recordset->RecordCount();
		}
		$t_jk_grid->StartRec = 1;
		$t_jk_grid->DisplayRecs = $t_jk_grid->TotalRecs;
	} else {
		$t_jk->CurrentFilter = "0=1";
		$t_jk_grid->StartRec = 1;
		$t_jk_grid->DisplayRecs = $t_jk->GridAddRowCount;
	}
	$t_jk_grid->TotalRecs = $t_jk_grid->DisplayRecs;
	$t_jk_grid->StopRec = $t_jk_grid->DisplayRecs;
} else {
	$bSelectLimit = $t_jk_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t_jk_grid->TotalRecs <= 0)
			$t_jk_grid->TotalRecs = $t_jk->SelectRecordCount();
	} else {
		if (!$t_jk_grid->Recordset && ($t_jk_grid->Recordset = $t_jk_grid->LoadRecordset()))
			$t_jk_grid->TotalRecs = $t_jk_grid->Recordset->RecordCount();
	}
	$t_jk_grid->StartRec = 1;
	$t_jk_grid->DisplayRecs = $t_jk_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t_jk_grid->Recordset = $t_jk_grid->LoadRecordset($t_jk_grid->StartRec-1, $t_jk_grid->DisplayRecs);

	// Set no record found message
	if ($t_jk->CurrentAction == "" && $t_jk_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t_jk_grid->setWarningMessage(ew_DeniedMsg());
		if ($t_jk_grid->SearchWhere == "0=101")
			$t_jk_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t_jk_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t_jk_grid->RenderOtherOptions();
?>
<?php $t_jk_grid->ShowPageHeader(); ?>
<?php
$t_jk_grid->ShowMessage();
?>
<?php if ($t_jk_grid->TotalRecs > 0 || $t_jk->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t_jk">
<div id="ft_jkgrid" class="ewForm form-inline">
<?php if ($t_jk_grid->ShowOtherOptions) { ?>
<div class="panel-heading ewGridUpperPanel">
<?php
	foreach ($t_jk_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_t_jk" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t_jkgrid" class="table ewTable">
<?php echo $t_jk->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t_jk_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t_jk_grid->RenderListOptions();

// Render list options (header, left)
$t_jk_grid->ListOptions->Render("header", "left");
?>
<?php if ($t_jk->jk_nm->Visible) { // jk_nm ?>
	<?php if ($t_jk->SortUrl($t_jk->jk_nm) == "") { ?>
		<th data-name="jk_nm"><div id="elh_t_jk_jk_nm" class="t_jk_jk_nm"><div class="ewTableHeaderCaption"><?php echo $t_jk->jk_nm->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jk_nm"><div><div id="elh_t_jk_jk_nm" class="t_jk_jk_nm">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t_jk->jk_nm->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t_jk->jk_nm->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t_jk->jk_nm->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t_jk->jk_kd->Visible) { // jk_kd ?>
	<?php if ($t_jk->SortUrl($t_jk->jk_kd) == "") { ?>
		<th data-name="jk_kd"><div id="elh_t_jk_jk_kd" class="t_jk_jk_kd"><div class="ewTableHeaderCaption"><?php echo $t_jk->jk_kd->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jk_kd"><div><div id="elh_t_jk_jk_kd" class="t_jk_jk_kd">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t_jk->jk_kd->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t_jk->jk_kd->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t_jk->jk_kd->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t_jk->jk_m->Visible) { // jk_m ?>
	<?php if ($t_jk->SortUrl($t_jk->jk_m) == "") { ?>
		<th data-name="jk_m"><div id="elh_t_jk_jk_m" class="t_jk_jk_m"><div class="ewTableHeaderCaption"><?php echo $t_jk->jk_m->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jk_m"><div><div id="elh_t_jk_jk_m" class="t_jk_jk_m">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t_jk->jk_m->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t_jk->jk_m->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t_jk->jk_m->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t_jk->jk_k->Visible) { // jk_k ?>
	<?php if ($t_jk->SortUrl($t_jk->jk_k) == "") { ?>
		<th data-name="jk_k"><div id="elh_t_jk_jk_k" class="t_jk_jk_k"><div class="ewTableHeaderCaption"><?php echo $t_jk->jk_k->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jk_k"><div><div id="elh_t_jk_jk_k" class="t_jk_jk_k">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t_jk->jk_k->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t_jk->jk_k->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t_jk->jk_k->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t_jk->jk_ket->Visible) { // jk_ket ?>
	<?php if ($t_jk->SortUrl($t_jk->jk_ket) == "") { ?>
		<th data-name="jk_ket"><div id="elh_t_jk_jk_ket" class="t_jk_jk_ket"><div class="ewTableHeaderCaption"><?php echo $t_jk->jk_ket->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jk_ket"><div><div id="elh_t_jk_jk_ket" class="t_jk_jk_ket">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t_jk->jk_ket->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t_jk->jk_ket->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t_jk->jk_ket->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t_jk_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t_jk_grid->StartRec = 1;
$t_jk_grid->StopRec = $t_jk_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t_jk_grid->FormKeyCountName) && ($t_jk->CurrentAction == "gridadd" || $t_jk->CurrentAction == "gridedit" || $t_jk->CurrentAction == "F")) {
		$t_jk_grid->KeyCount = $objForm->GetValue($t_jk_grid->FormKeyCountName);
		$t_jk_grid->StopRec = $t_jk_grid->StartRec + $t_jk_grid->KeyCount - 1;
	}
}
$t_jk_grid->RecCnt = $t_jk_grid->StartRec - 1;
if ($t_jk_grid->Recordset && !$t_jk_grid->Recordset->EOF) {
	$t_jk_grid->Recordset->MoveFirst();
	$bSelectLimit = $t_jk_grid->UseSelectLimit;
	if (!$bSelectLimit && $t_jk_grid->StartRec > 1)
		$t_jk_grid->Recordset->Move($t_jk_grid->StartRec - 1);
} elseif (!$t_jk->AllowAddDeleteRow && $t_jk_grid->StopRec == 0) {
	$t_jk_grid->StopRec = $t_jk->GridAddRowCount;
}

// Initialize aggregate
$t_jk->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t_jk->ResetAttrs();
$t_jk_grid->RenderRow();
if ($t_jk->CurrentAction == "gridadd")
	$t_jk_grid->RowIndex = 0;
if ($t_jk->CurrentAction == "gridedit")
	$t_jk_grid->RowIndex = 0;
while ($t_jk_grid->RecCnt < $t_jk_grid->StopRec) {
	$t_jk_grid->RecCnt++;
	if (intval($t_jk_grid->RecCnt) >= intval($t_jk_grid->StartRec)) {
		$t_jk_grid->RowCnt++;
		if ($t_jk->CurrentAction == "gridadd" || $t_jk->CurrentAction == "gridedit" || $t_jk->CurrentAction == "F") {
			$t_jk_grid->RowIndex++;
			$objForm->Index = $t_jk_grid->RowIndex;
			if ($objForm->HasValue($t_jk_grid->FormActionName))
				$t_jk_grid->RowAction = strval($objForm->GetValue($t_jk_grid->FormActionName));
			elseif ($t_jk->CurrentAction == "gridadd")
				$t_jk_grid->RowAction = "insert";
			else
				$t_jk_grid->RowAction = "";
		}

		// Set up key count
		$t_jk_grid->KeyCount = $t_jk_grid->RowIndex;

		// Init row class and style
		$t_jk->ResetAttrs();
		$t_jk->CssClass = "";
		if ($t_jk->CurrentAction == "gridadd") {
			if ($t_jk->CurrentMode == "copy") {
				$t_jk_grid->LoadRowValues($t_jk_grid->Recordset); // Load row values
				$t_jk_grid->SetRecordKey($t_jk_grid->RowOldKey, $t_jk_grid->Recordset); // Set old record key
			} else {
				$t_jk_grid->LoadDefaultValues(); // Load default values
				$t_jk_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t_jk_grid->LoadRowValues($t_jk_grid->Recordset); // Load row values
		}
		$t_jk->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t_jk->CurrentAction == "gridadd") // Grid add
			$t_jk->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t_jk->CurrentAction == "gridadd" && $t_jk->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t_jk_grid->RestoreCurrentRowFormValues($t_jk_grid->RowIndex); // Restore form values
		if ($t_jk->CurrentAction == "gridedit") { // Grid edit
			if ($t_jk->EventCancelled) {
				$t_jk_grid->RestoreCurrentRowFormValues($t_jk_grid->RowIndex); // Restore form values
			}
			if ($t_jk_grid->RowAction == "insert")
				$t_jk->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t_jk->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t_jk->CurrentAction == "gridedit" && ($t_jk->RowType == EW_ROWTYPE_EDIT || $t_jk->RowType == EW_ROWTYPE_ADD) && $t_jk->EventCancelled) // Update failed
			$t_jk_grid->RestoreCurrentRowFormValues($t_jk_grid->RowIndex); // Restore form values
		if ($t_jk->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t_jk_grid->EditRowCnt++;
		if ($t_jk->CurrentAction == "F") // Confirm row
			$t_jk_grid->RestoreCurrentRowFormValues($t_jk_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t_jk->RowAttrs = array_merge($t_jk->RowAttrs, array('data-rowindex'=>$t_jk_grid->RowCnt, 'id'=>'r' . $t_jk_grid->RowCnt . '_t_jk', 'data-rowtype'=>$t_jk->RowType));

		// Render row
		$t_jk_grid->RenderRow();

		// Render list options
		$t_jk_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t_jk_grid->RowAction <> "delete" && $t_jk_grid->RowAction <> "insertdelete" && !($t_jk_grid->RowAction == "insert" && $t_jk->CurrentAction == "F" && $t_jk_grid->EmptyRow())) {
?>
	<tr<?php echo $t_jk->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t_jk_grid->ListOptions->Render("body", "left", $t_jk_grid->RowCnt);
?>
	<?php if ($t_jk->jk_nm->Visible) { // jk_nm ?>
		<td data-name="jk_nm"<?php echo $t_jk->jk_nm->CellAttributes() ?>>
<?php if ($t_jk->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jk_grid->RowCnt ?>_t_jk_jk_nm" class="form-group t_jk_jk_nm">
<input type="text" data-table="t_jk" data-field="x_jk_nm" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_nm" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_nm" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t_jk->jk_nm->getPlaceHolder()) ?>" value="<?php echo $t_jk->jk_nm->EditValue ?>"<?php echo $t_jk->jk_nm->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t_jk" data-field="x_jk_nm" name="o<?php echo $t_jk_grid->RowIndex ?>_jk_nm" id="o<?php echo $t_jk_grid->RowIndex ?>_jk_nm" value="<?php echo ew_HtmlEncode($t_jk->jk_nm->OldValue) ?>">
<?php } ?>
<?php if ($t_jk->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_jk_grid->RowCnt ?>_t_jk_jk_nm" class="form-group t_jk_jk_nm">
<input type="text" data-table="t_jk" data-field="x_jk_nm" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_nm" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_nm" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t_jk->jk_nm->getPlaceHolder()) ?>" value="<?php echo $t_jk->jk_nm->EditValue ?>"<?php echo $t_jk->jk_nm->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_jk->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jk_grid->RowCnt ?>_t_jk_jk_nm" class="t_jk_jk_nm">
<span<?php echo $t_jk->jk_nm->ViewAttributes() ?>>
<?php echo $t_jk->jk_nm->ListViewValue() ?></span>
</span>
<?php if ($t_jk->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t_jk" data-field="x_jk_nm" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_nm" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_nm" value="<?php echo ew_HtmlEncode($t_jk->jk_nm->FormValue) ?>">
<input type="hidden" data-table="t_jk" data-field="x_jk_nm" name="o<?php echo $t_jk_grid->RowIndex ?>_jk_nm" id="o<?php echo $t_jk_grid->RowIndex ?>_jk_nm" value="<?php echo ew_HtmlEncode($t_jk->jk_nm->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jk" data-field="x_jk_nm" name="ft_jkgrid$x<?php echo $t_jk_grid->RowIndex ?>_jk_nm" id="ft_jkgrid$x<?php echo $t_jk_grid->RowIndex ?>_jk_nm" value="<?php echo ew_HtmlEncode($t_jk->jk_nm->FormValue) ?>">
<input type="hidden" data-table="t_jk" data-field="x_jk_nm" name="ft_jkgrid$o<?php echo $t_jk_grid->RowIndex ?>_jk_nm" id="ft_jkgrid$o<?php echo $t_jk_grid->RowIndex ?>_jk_nm" value="<?php echo ew_HtmlEncode($t_jk->jk_nm->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t_jk_grid->PageObjName . "_row_" . $t_jk_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t_jk->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t_jk" data-field="x_jk_id" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_id" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_id" value="<?php echo ew_HtmlEncode($t_jk->jk_id->CurrentValue) ?>">
<input type="hidden" data-table="t_jk" data-field="x_jk_id" name="o<?php echo $t_jk_grid->RowIndex ?>_jk_id" id="o<?php echo $t_jk_grid->RowIndex ?>_jk_id" value="<?php echo ew_HtmlEncode($t_jk->jk_id->OldValue) ?>">
<?php } ?>
<?php if ($t_jk->RowType == EW_ROWTYPE_EDIT || $t_jk->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t_jk" data-field="x_jk_id" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_id" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_id" value="<?php echo ew_HtmlEncode($t_jk->jk_id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t_jk->jk_kd->Visible) { // jk_kd ?>
		<td data-name="jk_kd"<?php echo $t_jk->jk_kd->CellAttributes() ?>>
<?php if ($t_jk->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jk_grid->RowCnt ?>_t_jk_jk_kd" class="form-group t_jk_jk_kd">
<input type="text" data-table="t_jk" data-field="x_jk_kd" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_kd" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_kd" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t_jk->jk_kd->getPlaceHolder()) ?>" value="<?php echo $t_jk->jk_kd->EditValue ?>"<?php echo $t_jk->jk_kd->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t_jk" data-field="x_jk_kd" name="o<?php echo $t_jk_grid->RowIndex ?>_jk_kd" id="o<?php echo $t_jk_grid->RowIndex ?>_jk_kd" value="<?php echo ew_HtmlEncode($t_jk->jk_kd->OldValue) ?>">
<?php } ?>
<?php if ($t_jk->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_jk_grid->RowCnt ?>_t_jk_jk_kd" class="form-group t_jk_jk_kd">
<input type="text" data-table="t_jk" data-field="x_jk_kd" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_kd" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_kd" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t_jk->jk_kd->getPlaceHolder()) ?>" value="<?php echo $t_jk->jk_kd->EditValue ?>"<?php echo $t_jk->jk_kd->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_jk->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jk_grid->RowCnt ?>_t_jk_jk_kd" class="t_jk_jk_kd">
<span<?php echo $t_jk->jk_kd->ViewAttributes() ?>>
<?php echo $t_jk->jk_kd->ListViewValue() ?></span>
</span>
<?php if ($t_jk->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t_jk" data-field="x_jk_kd" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_kd" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_kd" value="<?php echo ew_HtmlEncode($t_jk->jk_kd->FormValue) ?>">
<input type="hidden" data-table="t_jk" data-field="x_jk_kd" name="o<?php echo $t_jk_grid->RowIndex ?>_jk_kd" id="o<?php echo $t_jk_grid->RowIndex ?>_jk_kd" value="<?php echo ew_HtmlEncode($t_jk->jk_kd->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jk" data-field="x_jk_kd" name="ft_jkgrid$x<?php echo $t_jk_grid->RowIndex ?>_jk_kd" id="ft_jkgrid$x<?php echo $t_jk_grid->RowIndex ?>_jk_kd" value="<?php echo ew_HtmlEncode($t_jk->jk_kd->FormValue) ?>">
<input type="hidden" data-table="t_jk" data-field="x_jk_kd" name="ft_jkgrid$o<?php echo $t_jk_grid->RowIndex ?>_jk_kd" id="ft_jkgrid$o<?php echo $t_jk_grid->RowIndex ?>_jk_kd" value="<?php echo ew_HtmlEncode($t_jk->jk_kd->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jk->jk_m->Visible) { // jk_m ?>
		<td data-name="jk_m"<?php echo $t_jk->jk_m->CellAttributes() ?>>
<?php if ($t_jk->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jk_grid->RowCnt ?>_t_jk_jk_m" class="form-group t_jk_jk_m">
<input type="text" data-table="t_jk" data-field="x_jk_m" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_m" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_m" size="30" placeholder="<?php echo ew_HtmlEncode($t_jk->jk_m->getPlaceHolder()) ?>" value="<?php echo $t_jk->jk_m->EditValue ?>"<?php echo $t_jk->jk_m->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t_jk" data-field="x_jk_m" name="o<?php echo $t_jk_grid->RowIndex ?>_jk_m" id="o<?php echo $t_jk_grid->RowIndex ?>_jk_m" value="<?php echo ew_HtmlEncode($t_jk->jk_m->OldValue) ?>">
<?php } ?>
<?php if ($t_jk->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_jk_grid->RowCnt ?>_t_jk_jk_m" class="form-group t_jk_jk_m">
<input type="text" data-table="t_jk" data-field="x_jk_m" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_m" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_m" size="30" placeholder="<?php echo ew_HtmlEncode($t_jk->jk_m->getPlaceHolder()) ?>" value="<?php echo $t_jk->jk_m->EditValue ?>"<?php echo $t_jk->jk_m->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_jk->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jk_grid->RowCnt ?>_t_jk_jk_m" class="t_jk_jk_m">
<span<?php echo $t_jk->jk_m->ViewAttributes() ?>>
<?php echo $t_jk->jk_m->ListViewValue() ?></span>
</span>
<?php if ($t_jk->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t_jk" data-field="x_jk_m" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_m" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_m" value="<?php echo ew_HtmlEncode($t_jk->jk_m->FormValue) ?>">
<input type="hidden" data-table="t_jk" data-field="x_jk_m" name="o<?php echo $t_jk_grid->RowIndex ?>_jk_m" id="o<?php echo $t_jk_grid->RowIndex ?>_jk_m" value="<?php echo ew_HtmlEncode($t_jk->jk_m->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jk" data-field="x_jk_m" name="ft_jkgrid$x<?php echo $t_jk_grid->RowIndex ?>_jk_m" id="ft_jkgrid$x<?php echo $t_jk_grid->RowIndex ?>_jk_m" value="<?php echo ew_HtmlEncode($t_jk->jk_m->FormValue) ?>">
<input type="hidden" data-table="t_jk" data-field="x_jk_m" name="ft_jkgrid$o<?php echo $t_jk_grid->RowIndex ?>_jk_m" id="ft_jkgrid$o<?php echo $t_jk_grid->RowIndex ?>_jk_m" value="<?php echo ew_HtmlEncode($t_jk->jk_m->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jk->jk_k->Visible) { // jk_k ?>
		<td data-name="jk_k"<?php echo $t_jk->jk_k->CellAttributes() ?>>
<?php if ($t_jk->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jk_grid->RowCnt ?>_t_jk_jk_k" class="form-group t_jk_jk_k">
<input type="text" data-table="t_jk" data-field="x_jk_k" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_k" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_k" size="30" placeholder="<?php echo ew_HtmlEncode($t_jk->jk_k->getPlaceHolder()) ?>" value="<?php echo $t_jk->jk_k->EditValue ?>"<?php echo $t_jk->jk_k->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t_jk" data-field="x_jk_k" name="o<?php echo $t_jk_grid->RowIndex ?>_jk_k" id="o<?php echo $t_jk_grid->RowIndex ?>_jk_k" value="<?php echo ew_HtmlEncode($t_jk->jk_k->OldValue) ?>">
<?php } ?>
<?php if ($t_jk->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_jk_grid->RowCnt ?>_t_jk_jk_k" class="form-group t_jk_jk_k">
<input type="text" data-table="t_jk" data-field="x_jk_k" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_k" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_k" size="30" placeholder="<?php echo ew_HtmlEncode($t_jk->jk_k->getPlaceHolder()) ?>" value="<?php echo $t_jk->jk_k->EditValue ?>"<?php echo $t_jk->jk_k->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t_jk->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jk_grid->RowCnt ?>_t_jk_jk_k" class="t_jk_jk_k">
<span<?php echo $t_jk->jk_k->ViewAttributes() ?>>
<?php echo $t_jk->jk_k->ListViewValue() ?></span>
</span>
<?php if ($t_jk->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t_jk" data-field="x_jk_k" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_k" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_k" value="<?php echo ew_HtmlEncode($t_jk->jk_k->FormValue) ?>">
<input type="hidden" data-table="t_jk" data-field="x_jk_k" name="o<?php echo $t_jk_grid->RowIndex ?>_jk_k" id="o<?php echo $t_jk_grid->RowIndex ?>_jk_k" value="<?php echo ew_HtmlEncode($t_jk->jk_k->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jk" data-field="x_jk_k" name="ft_jkgrid$x<?php echo $t_jk_grid->RowIndex ?>_jk_k" id="ft_jkgrid$x<?php echo $t_jk_grid->RowIndex ?>_jk_k" value="<?php echo ew_HtmlEncode($t_jk->jk_k->FormValue) ?>">
<input type="hidden" data-table="t_jk" data-field="x_jk_k" name="ft_jkgrid$o<?php echo $t_jk_grid->RowIndex ?>_jk_k" id="ft_jkgrid$o<?php echo $t_jk_grid->RowIndex ?>_jk_k" value="<?php echo ew_HtmlEncode($t_jk->jk_k->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t_jk->jk_ket->Visible) { // jk_ket ?>
		<td data-name="jk_ket"<?php echo $t_jk->jk_ket->CellAttributes() ?>>
<?php if ($t_jk->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t_jk_grid->RowCnt ?>_t_jk_jk_ket" class="form-group t_jk_jk_ket">
<textarea data-table="t_jk" data-field="x_jk_ket" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_ket" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_ket" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t_jk->jk_ket->getPlaceHolder()) ?>"<?php echo $t_jk->jk_ket->EditAttributes() ?>><?php echo $t_jk->jk_ket->EditValue ?></textarea>
</span>
<input type="hidden" data-table="t_jk" data-field="x_jk_ket" name="o<?php echo $t_jk_grid->RowIndex ?>_jk_ket" id="o<?php echo $t_jk_grid->RowIndex ?>_jk_ket" value="<?php echo ew_HtmlEncode($t_jk->jk_ket->OldValue) ?>">
<?php } ?>
<?php if ($t_jk->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t_jk_grid->RowCnt ?>_t_jk_jk_ket" class="form-group t_jk_jk_ket">
<textarea data-table="t_jk" data-field="x_jk_ket" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_ket" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_ket" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t_jk->jk_ket->getPlaceHolder()) ?>"<?php echo $t_jk->jk_ket->EditAttributes() ?>><?php echo $t_jk->jk_ket->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($t_jk->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t_jk_grid->RowCnt ?>_t_jk_jk_ket" class="t_jk_jk_ket">
<span<?php echo $t_jk->jk_ket->ViewAttributes() ?>>
<?php echo $t_jk->jk_ket->ListViewValue() ?></span>
</span>
<?php if ($t_jk->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t_jk" data-field="x_jk_ket" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_ket" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_ket" value="<?php echo ew_HtmlEncode($t_jk->jk_ket->FormValue) ?>">
<input type="hidden" data-table="t_jk" data-field="x_jk_ket" name="o<?php echo $t_jk_grid->RowIndex ?>_jk_ket" id="o<?php echo $t_jk_grid->RowIndex ?>_jk_ket" value="<?php echo ew_HtmlEncode($t_jk->jk_ket->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t_jk" data-field="x_jk_ket" name="ft_jkgrid$x<?php echo $t_jk_grid->RowIndex ?>_jk_ket" id="ft_jkgrid$x<?php echo $t_jk_grid->RowIndex ?>_jk_ket" value="<?php echo ew_HtmlEncode($t_jk->jk_ket->FormValue) ?>">
<input type="hidden" data-table="t_jk" data-field="x_jk_ket" name="ft_jkgrid$o<?php echo $t_jk_grid->RowIndex ?>_jk_ket" id="ft_jkgrid$o<?php echo $t_jk_grid->RowIndex ?>_jk_ket" value="<?php echo ew_HtmlEncode($t_jk->jk_ket->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_jk_grid->ListOptions->Render("body", "right", $t_jk_grid->RowCnt);
?>
	</tr>
<?php if ($t_jk->RowType == EW_ROWTYPE_ADD || $t_jk->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft_jkgrid.UpdateOpts(<?php echo $t_jk_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t_jk->CurrentAction <> "gridadd" || $t_jk->CurrentMode == "copy")
		if (!$t_jk_grid->Recordset->EOF) $t_jk_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t_jk->CurrentMode == "add" || $t_jk->CurrentMode == "copy" || $t_jk->CurrentMode == "edit") {
		$t_jk_grid->RowIndex = '$rowindex$';
		$t_jk_grid->LoadDefaultValues();

		// Set row properties
		$t_jk->ResetAttrs();
		$t_jk->RowAttrs = array_merge($t_jk->RowAttrs, array('data-rowindex'=>$t_jk_grid->RowIndex, 'id'=>'r0_t_jk', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t_jk->RowAttrs["class"], "ewTemplate");
		$t_jk->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t_jk_grid->RenderRow();

		// Render list options
		$t_jk_grid->RenderListOptions();
		$t_jk_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t_jk->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t_jk_grid->ListOptions->Render("body", "left", $t_jk_grid->RowIndex);
?>
	<?php if ($t_jk->jk_nm->Visible) { // jk_nm ?>
		<td data-name="jk_nm">
<?php if ($t_jk->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t_jk_jk_nm" class="form-group t_jk_jk_nm">
<input type="text" data-table="t_jk" data-field="x_jk_nm" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_nm" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_nm" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t_jk->jk_nm->getPlaceHolder()) ?>" value="<?php echo $t_jk->jk_nm->EditValue ?>"<?php echo $t_jk->jk_nm->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_jk_jk_nm" class="form-group t_jk_jk_nm">
<span<?php echo $t_jk->jk_nm->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t_jk->jk_nm->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t_jk" data-field="x_jk_nm" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_nm" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_nm" value="<?php echo ew_HtmlEncode($t_jk->jk_nm->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jk" data-field="x_jk_nm" name="o<?php echo $t_jk_grid->RowIndex ?>_jk_nm" id="o<?php echo $t_jk_grid->RowIndex ?>_jk_nm" value="<?php echo ew_HtmlEncode($t_jk->jk_nm->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jk->jk_kd->Visible) { // jk_kd ?>
		<td data-name="jk_kd">
<?php if ($t_jk->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t_jk_jk_kd" class="form-group t_jk_jk_kd">
<input type="text" data-table="t_jk" data-field="x_jk_kd" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_kd" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_kd" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t_jk->jk_kd->getPlaceHolder()) ?>" value="<?php echo $t_jk->jk_kd->EditValue ?>"<?php echo $t_jk->jk_kd->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_jk_jk_kd" class="form-group t_jk_jk_kd">
<span<?php echo $t_jk->jk_kd->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t_jk->jk_kd->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t_jk" data-field="x_jk_kd" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_kd" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_kd" value="<?php echo ew_HtmlEncode($t_jk->jk_kd->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jk" data-field="x_jk_kd" name="o<?php echo $t_jk_grid->RowIndex ?>_jk_kd" id="o<?php echo $t_jk_grid->RowIndex ?>_jk_kd" value="<?php echo ew_HtmlEncode($t_jk->jk_kd->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jk->jk_m->Visible) { // jk_m ?>
		<td data-name="jk_m">
<?php if ($t_jk->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t_jk_jk_m" class="form-group t_jk_jk_m">
<input type="text" data-table="t_jk" data-field="x_jk_m" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_m" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_m" size="30" placeholder="<?php echo ew_HtmlEncode($t_jk->jk_m->getPlaceHolder()) ?>" value="<?php echo $t_jk->jk_m->EditValue ?>"<?php echo $t_jk->jk_m->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_jk_jk_m" class="form-group t_jk_jk_m">
<span<?php echo $t_jk->jk_m->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t_jk->jk_m->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t_jk" data-field="x_jk_m" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_m" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_m" value="<?php echo ew_HtmlEncode($t_jk->jk_m->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jk" data-field="x_jk_m" name="o<?php echo $t_jk_grid->RowIndex ?>_jk_m" id="o<?php echo $t_jk_grid->RowIndex ?>_jk_m" value="<?php echo ew_HtmlEncode($t_jk->jk_m->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jk->jk_k->Visible) { // jk_k ?>
		<td data-name="jk_k">
<?php if ($t_jk->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t_jk_jk_k" class="form-group t_jk_jk_k">
<input type="text" data-table="t_jk" data-field="x_jk_k" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_k" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_k" size="30" placeholder="<?php echo ew_HtmlEncode($t_jk->jk_k->getPlaceHolder()) ?>" value="<?php echo $t_jk->jk_k->EditValue ?>"<?php echo $t_jk->jk_k->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_jk_jk_k" class="form-group t_jk_jk_k">
<span<?php echo $t_jk->jk_k->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t_jk->jk_k->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t_jk" data-field="x_jk_k" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_k" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_k" value="<?php echo ew_HtmlEncode($t_jk->jk_k->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jk" data-field="x_jk_k" name="o<?php echo $t_jk_grid->RowIndex ?>_jk_k" id="o<?php echo $t_jk_grid->RowIndex ?>_jk_k" value="<?php echo ew_HtmlEncode($t_jk->jk_k->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t_jk->jk_ket->Visible) { // jk_ket ?>
		<td data-name="jk_ket">
<?php if ($t_jk->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t_jk_jk_ket" class="form-group t_jk_jk_ket">
<textarea data-table="t_jk" data-field="x_jk_ket" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_ket" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_ket" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($t_jk->jk_ket->getPlaceHolder()) ?>"<?php echo $t_jk->jk_ket->EditAttributes() ?>><?php echo $t_jk->jk_ket->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_t_jk_jk_ket" class="form-group t_jk_jk_ket">
<span<?php echo $t_jk->jk_ket->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t_jk->jk_ket->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t_jk" data-field="x_jk_ket" name="x<?php echo $t_jk_grid->RowIndex ?>_jk_ket" id="x<?php echo $t_jk_grid->RowIndex ?>_jk_ket" value="<?php echo ew_HtmlEncode($t_jk->jk_ket->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t_jk" data-field="x_jk_ket" name="o<?php echo $t_jk_grid->RowIndex ?>_jk_ket" id="o<?php echo $t_jk_grid->RowIndex ?>_jk_ket" value="<?php echo ew_HtmlEncode($t_jk->jk_ket->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t_jk_grid->ListOptions->Render("body", "right", $t_jk_grid->RowCnt);
?>
<script type="text/javascript">
ft_jkgrid.UpdateOpts(<?php echo $t_jk_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t_jk->CurrentMode == "add" || $t_jk->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t_jk_grid->FormKeyCountName ?>" id="<?php echo $t_jk_grid->FormKeyCountName ?>" value="<?php echo $t_jk_grid->KeyCount ?>">
<?php echo $t_jk_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_jk->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t_jk_grid->FormKeyCountName ?>" id="<?php echo $t_jk_grid->FormKeyCountName ?>" value="<?php echo $t_jk_grid->KeyCount ?>">
<?php echo $t_jk_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t_jk->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft_jkgrid">
</div>
<?php

// Close recordset
if ($t_jk_grid->Recordset)
	$t_jk_grid->Recordset->Close();
?>
<?php if ($t_jk_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($t_jk_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t_jk_grid->TotalRecs == 0 && $t_jk->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t_jk_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t_jk->Export == "") { ?>
<script type="text/javascript">
ft_jkgrid.Init();
</script>
<?php } ?>
<?php
$t_jk_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t_jk_grid->Page_Terminate();
?>
