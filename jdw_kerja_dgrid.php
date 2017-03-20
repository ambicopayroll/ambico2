<?php include_once "t_userinfo.php" ?>
<?php

// Create page object
if (!isset($jdw_kerja_d_grid)) $jdw_kerja_d_grid = new cjdw_kerja_d_grid();

// Page init
$jdw_kerja_d_grid->Page_Init();

// Page main
$jdw_kerja_d_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$jdw_kerja_d_grid->Page_Render();
?>
<?php if ($jdw_kerja_d->Export == "") { ?>
<script type="text/javascript">

// Form object
var fjdw_kerja_dgrid = new ew_Form("fjdw_kerja_dgrid", "grid");
fjdw_kerja_dgrid.FormKeyCountName = '<?php echo $jdw_kerja_d_grid->FormKeyCountName ?>';

// Validate form
fjdw_kerja_dgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_jdw_kerja_m_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $jdw_kerja_d->jdw_kerja_m_id->FldCaption(), $jdw_kerja_d->jdw_kerja_m_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_jdw_kerja_d_idx");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $jdw_kerja_d->jdw_kerja_d_idx->FldCaption(), $jdw_kerja_d->jdw_kerja_d_idx->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_jdw_kerja_d_idx");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($jdw_kerja_d->jdw_kerja_d_idx->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_jk_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $jdw_kerja_d->jk_id->FldCaption(), $jdw_kerja_d->jk_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_jk_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($jdw_kerja_d->jk_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_jdw_kerja_d_libur");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($jdw_kerja_d->jdw_kerja_d_libur->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fjdw_kerja_dgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "jdw_kerja_m_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "jdw_kerja_d_idx", false)) return false;
	if (ew_ValueChanged(fobj, infix, "jk_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "jdw_kerja_d_hari", false)) return false;
	if (ew_ValueChanged(fobj, infix, "jdw_kerja_d_libur", false)) return false;
	return true;
}

// Form_CustomValidate event
fjdw_kerja_dgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fjdw_kerja_dgrid.ValidateRequired = true;
<?php } else { ?>
fjdw_kerja_dgrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fjdw_kerja_dgrid.Lists["x_jdw_kerja_m_id"] = {"LinkField":"x_jdw_kerja_m_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_jdw_kerja_m_kode","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"jdw_kerja_m"};

// Form object for search
</script>
<?php } ?>
<?php
if ($jdw_kerja_d->CurrentAction == "gridadd") {
	if ($jdw_kerja_d->CurrentMode == "copy") {
		$bSelectLimit = $jdw_kerja_d_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$jdw_kerja_d_grid->TotalRecs = $jdw_kerja_d->SelectRecordCount();
			$jdw_kerja_d_grid->Recordset = $jdw_kerja_d_grid->LoadRecordset($jdw_kerja_d_grid->StartRec-1, $jdw_kerja_d_grid->DisplayRecs);
		} else {
			if ($jdw_kerja_d_grid->Recordset = $jdw_kerja_d_grid->LoadRecordset())
				$jdw_kerja_d_grid->TotalRecs = $jdw_kerja_d_grid->Recordset->RecordCount();
		}
		$jdw_kerja_d_grid->StartRec = 1;
		$jdw_kerja_d_grid->DisplayRecs = $jdw_kerja_d_grid->TotalRecs;
	} else {
		$jdw_kerja_d->CurrentFilter = "0=1";
		$jdw_kerja_d_grid->StartRec = 1;
		$jdw_kerja_d_grid->DisplayRecs = $jdw_kerja_d->GridAddRowCount;
	}
	$jdw_kerja_d_grid->TotalRecs = $jdw_kerja_d_grid->DisplayRecs;
	$jdw_kerja_d_grid->StopRec = $jdw_kerja_d_grid->DisplayRecs;
} else {
	$bSelectLimit = $jdw_kerja_d_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($jdw_kerja_d_grid->TotalRecs <= 0)
			$jdw_kerja_d_grid->TotalRecs = $jdw_kerja_d->SelectRecordCount();
	} else {
		if (!$jdw_kerja_d_grid->Recordset && ($jdw_kerja_d_grid->Recordset = $jdw_kerja_d_grid->LoadRecordset()))
			$jdw_kerja_d_grid->TotalRecs = $jdw_kerja_d_grid->Recordset->RecordCount();
	}
	$jdw_kerja_d_grid->StartRec = 1;
	$jdw_kerja_d_grid->DisplayRecs = $jdw_kerja_d_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$jdw_kerja_d_grid->Recordset = $jdw_kerja_d_grid->LoadRecordset($jdw_kerja_d_grid->StartRec-1, $jdw_kerja_d_grid->DisplayRecs);

	// Set no record found message
	if ($jdw_kerja_d->CurrentAction == "" && $jdw_kerja_d_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$jdw_kerja_d_grid->setWarningMessage(ew_DeniedMsg());
		if ($jdw_kerja_d_grid->SearchWhere == "0=101")
			$jdw_kerja_d_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$jdw_kerja_d_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$jdw_kerja_d_grid->RenderOtherOptions();
?>
<?php $jdw_kerja_d_grid->ShowPageHeader(); ?>
<?php
$jdw_kerja_d_grid->ShowMessage();
?>
<?php if ($jdw_kerja_d_grid->TotalRecs > 0 || $jdw_kerja_d->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid jdw_kerja_d">
<div id="fjdw_kerja_dgrid" class="ewForm form-inline">
<div id="gmp_jdw_kerja_d" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_jdw_kerja_dgrid" class="table ewTable">
<?php echo $jdw_kerja_d->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$jdw_kerja_d_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$jdw_kerja_d_grid->RenderListOptions();

// Render list options (header, left)
$jdw_kerja_d_grid->ListOptions->Render("header", "left");
?>
<?php if ($jdw_kerja_d->jdw_kerja_m_id->Visible) { // jdw_kerja_m_id ?>
	<?php if ($jdw_kerja_d->SortUrl($jdw_kerja_d->jdw_kerja_m_id) == "") { ?>
		<th data-name="jdw_kerja_m_id"><div id="elh_jdw_kerja_d_jdw_kerja_m_id" class="jdw_kerja_d_jdw_kerja_m_id"><div class="ewTableHeaderCaption"><?php echo $jdw_kerja_d->jdw_kerja_m_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jdw_kerja_m_id"><div><div id="elh_jdw_kerja_d_jdw_kerja_m_id" class="jdw_kerja_d_jdw_kerja_m_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $jdw_kerja_d->jdw_kerja_m_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($jdw_kerja_d->jdw_kerja_m_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($jdw_kerja_d->jdw_kerja_m_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($jdw_kerja_d->jdw_kerja_d_idx->Visible) { // jdw_kerja_d_idx ?>
	<?php if ($jdw_kerja_d->SortUrl($jdw_kerja_d->jdw_kerja_d_idx) == "") { ?>
		<th data-name="jdw_kerja_d_idx"><div id="elh_jdw_kerja_d_jdw_kerja_d_idx" class="jdw_kerja_d_jdw_kerja_d_idx"><div class="ewTableHeaderCaption"><?php echo $jdw_kerja_d->jdw_kerja_d_idx->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jdw_kerja_d_idx"><div><div id="elh_jdw_kerja_d_jdw_kerja_d_idx" class="jdw_kerja_d_jdw_kerja_d_idx">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $jdw_kerja_d->jdw_kerja_d_idx->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($jdw_kerja_d->jdw_kerja_d_idx->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($jdw_kerja_d->jdw_kerja_d_idx->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($jdw_kerja_d->jk_id->Visible) { // jk_id ?>
	<?php if ($jdw_kerja_d->SortUrl($jdw_kerja_d->jk_id) == "") { ?>
		<th data-name="jk_id"><div id="elh_jdw_kerja_d_jk_id" class="jdw_kerja_d_jk_id"><div class="ewTableHeaderCaption"><?php echo $jdw_kerja_d->jk_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jk_id"><div><div id="elh_jdw_kerja_d_jk_id" class="jdw_kerja_d_jk_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $jdw_kerja_d->jk_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($jdw_kerja_d->jk_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($jdw_kerja_d->jk_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($jdw_kerja_d->jdw_kerja_d_hari->Visible) { // jdw_kerja_d_hari ?>
	<?php if ($jdw_kerja_d->SortUrl($jdw_kerja_d->jdw_kerja_d_hari) == "") { ?>
		<th data-name="jdw_kerja_d_hari"><div id="elh_jdw_kerja_d_jdw_kerja_d_hari" class="jdw_kerja_d_jdw_kerja_d_hari"><div class="ewTableHeaderCaption"><?php echo $jdw_kerja_d->jdw_kerja_d_hari->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jdw_kerja_d_hari"><div><div id="elh_jdw_kerja_d_jdw_kerja_d_hari" class="jdw_kerja_d_jdw_kerja_d_hari">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $jdw_kerja_d->jdw_kerja_d_hari->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($jdw_kerja_d->jdw_kerja_d_hari->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($jdw_kerja_d->jdw_kerja_d_hari->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($jdw_kerja_d->jdw_kerja_d_libur->Visible) { // jdw_kerja_d_libur ?>
	<?php if ($jdw_kerja_d->SortUrl($jdw_kerja_d->jdw_kerja_d_libur) == "") { ?>
		<th data-name="jdw_kerja_d_libur"><div id="elh_jdw_kerja_d_jdw_kerja_d_libur" class="jdw_kerja_d_jdw_kerja_d_libur"><div class="ewTableHeaderCaption"><?php echo $jdw_kerja_d->jdw_kerja_d_libur->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="jdw_kerja_d_libur"><div><div id="elh_jdw_kerja_d_jdw_kerja_d_libur" class="jdw_kerja_d_jdw_kerja_d_libur">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $jdw_kerja_d->jdw_kerja_d_libur->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($jdw_kerja_d->jdw_kerja_d_libur->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($jdw_kerja_d->jdw_kerja_d_libur->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$jdw_kerja_d_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$jdw_kerja_d_grid->StartRec = 1;
$jdw_kerja_d_grid->StopRec = $jdw_kerja_d_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($jdw_kerja_d_grid->FormKeyCountName) && ($jdw_kerja_d->CurrentAction == "gridadd" || $jdw_kerja_d->CurrentAction == "gridedit" || $jdw_kerja_d->CurrentAction == "F")) {
		$jdw_kerja_d_grid->KeyCount = $objForm->GetValue($jdw_kerja_d_grid->FormKeyCountName);
		$jdw_kerja_d_grid->StopRec = $jdw_kerja_d_grid->StartRec + $jdw_kerja_d_grid->KeyCount - 1;
	}
}
$jdw_kerja_d_grid->RecCnt = $jdw_kerja_d_grid->StartRec - 1;
if ($jdw_kerja_d_grid->Recordset && !$jdw_kerja_d_grid->Recordset->EOF) {
	$jdw_kerja_d_grid->Recordset->MoveFirst();
	$bSelectLimit = $jdw_kerja_d_grid->UseSelectLimit;
	if (!$bSelectLimit && $jdw_kerja_d_grid->StartRec > 1)
		$jdw_kerja_d_grid->Recordset->Move($jdw_kerja_d_grid->StartRec - 1);
} elseif (!$jdw_kerja_d->AllowAddDeleteRow && $jdw_kerja_d_grid->StopRec == 0) {
	$jdw_kerja_d_grid->StopRec = $jdw_kerja_d->GridAddRowCount;
}

// Initialize aggregate
$jdw_kerja_d->RowType = EW_ROWTYPE_AGGREGATEINIT;
$jdw_kerja_d->ResetAttrs();
$jdw_kerja_d_grid->RenderRow();
if ($jdw_kerja_d->CurrentAction == "gridadd")
	$jdw_kerja_d_grid->RowIndex = 0;
if ($jdw_kerja_d->CurrentAction == "gridedit")
	$jdw_kerja_d_grid->RowIndex = 0;
while ($jdw_kerja_d_grid->RecCnt < $jdw_kerja_d_grid->StopRec) {
	$jdw_kerja_d_grid->RecCnt++;
	if (intval($jdw_kerja_d_grid->RecCnt) >= intval($jdw_kerja_d_grid->StartRec)) {
		$jdw_kerja_d_grid->RowCnt++;
		if ($jdw_kerja_d->CurrentAction == "gridadd" || $jdw_kerja_d->CurrentAction == "gridedit" || $jdw_kerja_d->CurrentAction == "F") {
			$jdw_kerja_d_grid->RowIndex++;
			$objForm->Index = $jdw_kerja_d_grid->RowIndex;
			if ($objForm->HasValue($jdw_kerja_d_grid->FormActionName))
				$jdw_kerja_d_grid->RowAction = strval($objForm->GetValue($jdw_kerja_d_grid->FormActionName));
			elseif ($jdw_kerja_d->CurrentAction == "gridadd")
				$jdw_kerja_d_grid->RowAction = "insert";
			else
				$jdw_kerja_d_grid->RowAction = "";
		}

		// Set up key count
		$jdw_kerja_d_grid->KeyCount = $jdw_kerja_d_grid->RowIndex;

		// Init row class and style
		$jdw_kerja_d->ResetAttrs();
		$jdw_kerja_d->CssClass = "";
		if ($jdw_kerja_d->CurrentAction == "gridadd") {
			if ($jdw_kerja_d->CurrentMode == "copy") {
				$jdw_kerja_d_grid->LoadRowValues($jdw_kerja_d_grid->Recordset); // Load row values
				$jdw_kerja_d_grid->SetRecordKey($jdw_kerja_d_grid->RowOldKey, $jdw_kerja_d_grid->Recordset); // Set old record key
			} else {
				$jdw_kerja_d_grid->LoadDefaultValues(); // Load default values
				$jdw_kerja_d_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$jdw_kerja_d_grid->LoadRowValues($jdw_kerja_d_grid->Recordset); // Load row values
		}
		$jdw_kerja_d->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($jdw_kerja_d->CurrentAction == "gridadd") // Grid add
			$jdw_kerja_d->RowType = EW_ROWTYPE_ADD; // Render add
		if ($jdw_kerja_d->CurrentAction == "gridadd" && $jdw_kerja_d->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$jdw_kerja_d_grid->RestoreCurrentRowFormValues($jdw_kerja_d_grid->RowIndex); // Restore form values
		if ($jdw_kerja_d->CurrentAction == "gridedit") { // Grid edit
			if ($jdw_kerja_d->EventCancelled) {
				$jdw_kerja_d_grid->RestoreCurrentRowFormValues($jdw_kerja_d_grid->RowIndex); // Restore form values
			}
			if ($jdw_kerja_d_grid->RowAction == "insert")
				$jdw_kerja_d->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$jdw_kerja_d->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($jdw_kerja_d->CurrentAction == "gridedit" && ($jdw_kerja_d->RowType == EW_ROWTYPE_EDIT || $jdw_kerja_d->RowType == EW_ROWTYPE_ADD) && $jdw_kerja_d->EventCancelled) // Update failed
			$jdw_kerja_d_grid->RestoreCurrentRowFormValues($jdw_kerja_d_grid->RowIndex); // Restore form values
		if ($jdw_kerja_d->RowType == EW_ROWTYPE_EDIT) // Edit row
			$jdw_kerja_d_grid->EditRowCnt++;
		if ($jdw_kerja_d->CurrentAction == "F") // Confirm row
			$jdw_kerja_d_grid->RestoreCurrentRowFormValues($jdw_kerja_d_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$jdw_kerja_d->RowAttrs = array_merge($jdw_kerja_d->RowAttrs, array('data-rowindex'=>$jdw_kerja_d_grid->RowCnt, 'id'=>'r' . $jdw_kerja_d_grid->RowCnt . '_jdw_kerja_d', 'data-rowtype'=>$jdw_kerja_d->RowType));

		// Render row
		$jdw_kerja_d_grid->RenderRow();

		// Render list options
		$jdw_kerja_d_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($jdw_kerja_d_grid->RowAction <> "delete" && $jdw_kerja_d_grid->RowAction <> "insertdelete" && !($jdw_kerja_d_grid->RowAction == "insert" && $jdw_kerja_d->CurrentAction == "F" && $jdw_kerja_d_grid->EmptyRow())) {
?>
	<tr<?php echo $jdw_kerja_d->RowAttributes() ?>>
<?php

// Render list options (body, left)
$jdw_kerja_d_grid->ListOptions->Render("body", "left", $jdw_kerja_d_grid->RowCnt);
?>
	<?php if ($jdw_kerja_d->jdw_kerja_m_id->Visible) { // jdw_kerja_m_id ?>
		<td data-name="jdw_kerja_m_id"<?php echo $jdw_kerja_d->jdw_kerja_m_id->CellAttributes() ?>>
<?php if ($jdw_kerja_d->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($jdw_kerja_d->jdw_kerja_m_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $jdw_kerja_d_grid->RowCnt ?>_jdw_kerja_d_jdw_kerja_m_id" class="form-group jdw_kerja_d_jdw_kerja_m_id">
<span<?php echo $jdw_kerja_d->jdw_kerja_m_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $jdw_kerja_d->jdw_kerja_m_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_m_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $jdw_kerja_d_grid->RowCnt ?>_jdw_kerja_d_jdw_kerja_m_id" class="form-group jdw_kerja_d_jdw_kerja_m_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id"><?php echo (strval($jdw_kerja_d->jdw_kerja_m_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $jdw_kerja_d->jdw_kerja_m_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($jdw_kerja_d->jdw_kerja_m_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_m_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $jdw_kerja_d->jdw_kerja_m_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" value="<?php echo $jdw_kerja_d->jdw_kerja_m_id->CurrentValue ?>"<?php echo $jdw_kerja_d->jdw_kerja_m_id->EditAttributes() ?>>
<input type="hidden" name="s_x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" id="s_x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" value="<?php echo $jdw_kerja_d->jdw_kerja_m_id->LookupFilterQuery() ?>">
</span>
<?php } ?>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_m_id" name="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" id="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_m_id->OldValue) ?>">
<?php } ?>
<?php if ($jdw_kerja_d->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $jdw_kerja_d_grid->RowCnt ?>_jdw_kerja_d_jdw_kerja_m_id" class="form-group jdw_kerja_d_jdw_kerja_m_id">
<span<?php echo $jdw_kerja_d->jdw_kerja_m_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $jdw_kerja_d->jdw_kerja_m_id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_m_id" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_m_id->CurrentValue) ?>">
<?php } ?>
<?php if ($jdw_kerja_d->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $jdw_kerja_d_grid->RowCnt ?>_jdw_kerja_d_jdw_kerja_m_id" class="jdw_kerja_d_jdw_kerja_m_id">
<span<?php echo $jdw_kerja_d->jdw_kerja_m_id->ViewAttributes() ?>>
<?php echo $jdw_kerja_d->jdw_kerja_m_id->ListViewValue() ?></span>
</span>
<?php if ($jdw_kerja_d->CurrentAction <> "F") { ?>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_m_id" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_m_id->FormValue) ?>">
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_m_id" name="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" id="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_m_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_m_id" name="fjdw_kerja_dgrid$x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" id="fjdw_kerja_dgrid$x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_m_id->FormValue) ?>">
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_m_id" name="fjdw_kerja_dgrid$o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" id="fjdw_kerja_dgrid$o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_m_id->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $jdw_kerja_d_grid->PageObjName . "_row_" . $jdw_kerja_d_grid->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($jdw_kerja_d->jdw_kerja_d_idx->Visible) { // jdw_kerja_d_idx ?>
		<td data-name="jdw_kerja_d_idx"<?php echo $jdw_kerja_d->jdw_kerja_d_idx->CellAttributes() ?>>
<?php if ($jdw_kerja_d->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $jdw_kerja_d_grid->RowCnt ?>_jdw_kerja_d_jdw_kerja_d_idx" class="form-group jdw_kerja_d_jdw_kerja_d_idx">
<input type="text" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_idx" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_idx" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_idx" size="30" placeholder="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_idx->getPlaceHolder()) ?>" value="<?php echo $jdw_kerja_d->jdw_kerja_d_idx->EditValue ?>"<?php echo $jdw_kerja_d->jdw_kerja_d_idx->EditAttributes() ?>>
</span>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_idx" name="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_idx" id="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_idx" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_idx->OldValue) ?>">
<?php } ?>
<?php if ($jdw_kerja_d->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $jdw_kerja_d_grid->RowCnt ?>_jdw_kerja_d_jdw_kerja_d_idx" class="form-group jdw_kerja_d_jdw_kerja_d_idx">
<span<?php echo $jdw_kerja_d->jdw_kerja_d_idx->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $jdw_kerja_d->jdw_kerja_d_idx->EditValue ?></p></span>
</span>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_idx" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_idx" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_idx" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_idx->CurrentValue) ?>">
<?php } ?>
<?php if ($jdw_kerja_d->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $jdw_kerja_d_grid->RowCnt ?>_jdw_kerja_d_jdw_kerja_d_idx" class="jdw_kerja_d_jdw_kerja_d_idx">
<span<?php echo $jdw_kerja_d->jdw_kerja_d_idx->ViewAttributes() ?>>
<?php echo $jdw_kerja_d->jdw_kerja_d_idx->ListViewValue() ?></span>
</span>
<?php if ($jdw_kerja_d->CurrentAction <> "F") { ?>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_idx" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_idx" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_idx" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_idx->FormValue) ?>">
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_idx" name="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_idx" id="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_idx" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_idx->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_idx" name="fjdw_kerja_dgrid$x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_idx" id="fjdw_kerja_dgrid$x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_idx" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_idx->FormValue) ?>">
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_idx" name="fjdw_kerja_dgrid$o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_idx" id="fjdw_kerja_dgrid$o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_idx" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_idx->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($jdw_kerja_d->jk_id->Visible) { // jk_id ?>
		<td data-name="jk_id"<?php echo $jdw_kerja_d->jk_id->CellAttributes() ?>>
<?php if ($jdw_kerja_d->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $jdw_kerja_d_grid->RowCnt ?>_jdw_kerja_d_jk_id" class="form-group jdw_kerja_d_jk_id">
<input type="text" data-table="jdw_kerja_d" data-field="x_jk_id" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jk_id" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jk_id" size="30" placeholder="<?php echo ew_HtmlEncode($jdw_kerja_d->jk_id->getPlaceHolder()) ?>" value="<?php echo $jdw_kerja_d->jk_id->EditValue ?>"<?php echo $jdw_kerja_d->jk_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jk_id" name="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jk_id" id="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jk_id" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jk_id->OldValue) ?>">
<?php } ?>
<?php if ($jdw_kerja_d->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $jdw_kerja_d_grid->RowCnt ?>_jdw_kerja_d_jk_id" class="form-group jdw_kerja_d_jk_id">
<span<?php echo $jdw_kerja_d->jk_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $jdw_kerja_d->jk_id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jk_id" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jk_id" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jk_id" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jk_id->CurrentValue) ?>">
<?php } ?>
<?php if ($jdw_kerja_d->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $jdw_kerja_d_grid->RowCnt ?>_jdw_kerja_d_jk_id" class="jdw_kerja_d_jk_id">
<span<?php echo $jdw_kerja_d->jk_id->ViewAttributes() ?>>
<?php echo $jdw_kerja_d->jk_id->ListViewValue() ?></span>
</span>
<?php if ($jdw_kerja_d->CurrentAction <> "F") { ?>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jk_id" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jk_id" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jk_id" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jk_id->FormValue) ?>">
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jk_id" name="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jk_id" id="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jk_id" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jk_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jk_id" name="fjdw_kerja_dgrid$x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jk_id" id="fjdw_kerja_dgrid$x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jk_id" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jk_id->FormValue) ?>">
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jk_id" name="fjdw_kerja_dgrid$o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jk_id" id="fjdw_kerja_dgrid$o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jk_id" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jk_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($jdw_kerja_d->jdw_kerja_d_hari->Visible) { // jdw_kerja_d_hari ?>
		<td data-name="jdw_kerja_d_hari"<?php echo $jdw_kerja_d->jdw_kerja_d_hari->CellAttributes() ?>>
<?php if ($jdw_kerja_d->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $jdw_kerja_d_grid->RowCnt ?>_jdw_kerja_d_jdw_kerja_d_hari" class="form-group jdw_kerja_d_jdw_kerja_d_hari">
<input type="text" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_hari" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_hari" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_hari" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_hari->getPlaceHolder()) ?>" value="<?php echo $jdw_kerja_d->jdw_kerja_d_hari->EditValue ?>"<?php echo $jdw_kerja_d->jdw_kerja_d_hari->EditAttributes() ?>>
</span>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_hari" name="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_hari" id="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_hari" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_hari->OldValue) ?>">
<?php } ?>
<?php if ($jdw_kerja_d->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $jdw_kerja_d_grid->RowCnt ?>_jdw_kerja_d_jdw_kerja_d_hari" class="form-group jdw_kerja_d_jdw_kerja_d_hari">
<input type="text" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_hari" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_hari" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_hari" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_hari->getPlaceHolder()) ?>" value="<?php echo $jdw_kerja_d->jdw_kerja_d_hari->EditValue ?>"<?php echo $jdw_kerja_d->jdw_kerja_d_hari->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($jdw_kerja_d->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $jdw_kerja_d_grid->RowCnt ?>_jdw_kerja_d_jdw_kerja_d_hari" class="jdw_kerja_d_jdw_kerja_d_hari">
<span<?php echo $jdw_kerja_d->jdw_kerja_d_hari->ViewAttributes() ?>>
<?php echo $jdw_kerja_d->jdw_kerja_d_hari->ListViewValue() ?></span>
</span>
<?php if ($jdw_kerja_d->CurrentAction <> "F") { ?>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_hari" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_hari" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_hari" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_hari->FormValue) ?>">
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_hari" name="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_hari" id="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_hari" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_hari->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_hari" name="fjdw_kerja_dgrid$x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_hari" id="fjdw_kerja_dgrid$x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_hari" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_hari->FormValue) ?>">
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_hari" name="fjdw_kerja_dgrid$o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_hari" id="fjdw_kerja_dgrid$o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_hari" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_hari->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($jdw_kerja_d->jdw_kerja_d_libur->Visible) { // jdw_kerja_d_libur ?>
		<td data-name="jdw_kerja_d_libur"<?php echo $jdw_kerja_d->jdw_kerja_d_libur->CellAttributes() ?>>
<?php if ($jdw_kerja_d->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $jdw_kerja_d_grid->RowCnt ?>_jdw_kerja_d_jdw_kerja_d_libur" class="form-group jdw_kerja_d_jdw_kerja_d_libur">
<input type="text" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_libur" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_libur" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_libur" size="30" placeholder="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_libur->getPlaceHolder()) ?>" value="<?php echo $jdw_kerja_d->jdw_kerja_d_libur->EditValue ?>"<?php echo $jdw_kerja_d->jdw_kerja_d_libur->EditAttributes() ?>>
</span>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_libur" name="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_libur" id="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_libur" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_libur->OldValue) ?>">
<?php } ?>
<?php if ($jdw_kerja_d->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $jdw_kerja_d_grid->RowCnt ?>_jdw_kerja_d_jdw_kerja_d_libur" class="form-group jdw_kerja_d_jdw_kerja_d_libur">
<input type="text" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_libur" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_libur" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_libur" size="30" placeholder="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_libur->getPlaceHolder()) ?>" value="<?php echo $jdw_kerja_d->jdw_kerja_d_libur->EditValue ?>"<?php echo $jdw_kerja_d->jdw_kerja_d_libur->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($jdw_kerja_d->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $jdw_kerja_d_grid->RowCnt ?>_jdw_kerja_d_jdw_kerja_d_libur" class="jdw_kerja_d_jdw_kerja_d_libur">
<span<?php echo $jdw_kerja_d->jdw_kerja_d_libur->ViewAttributes() ?>>
<?php echo $jdw_kerja_d->jdw_kerja_d_libur->ListViewValue() ?></span>
</span>
<?php if ($jdw_kerja_d->CurrentAction <> "F") { ?>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_libur" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_libur" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_libur" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_libur->FormValue) ?>">
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_libur" name="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_libur" id="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_libur" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_libur->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_libur" name="fjdw_kerja_dgrid$x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_libur" id="fjdw_kerja_dgrid$x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_libur" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_libur->FormValue) ?>">
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_libur" name="fjdw_kerja_dgrid$o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_libur" id="fjdw_kerja_dgrid$o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_libur" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_libur->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$jdw_kerja_d_grid->ListOptions->Render("body", "right", $jdw_kerja_d_grid->RowCnt);
?>
	</tr>
<?php if ($jdw_kerja_d->RowType == EW_ROWTYPE_ADD || $jdw_kerja_d->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fjdw_kerja_dgrid.UpdateOpts(<?php echo $jdw_kerja_d_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($jdw_kerja_d->CurrentAction <> "gridadd" || $jdw_kerja_d->CurrentMode == "copy")
		if (!$jdw_kerja_d_grid->Recordset->EOF) $jdw_kerja_d_grid->Recordset->MoveNext();
}
?>
<?php
	if ($jdw_kerja_d->CurrentMode == "add" || $jdw_kerja_d->CurrentMode == "copy" || $jdw_kerja_d->CurrentMode == "edit") {
		$jdw_kerja_d_grid->RowIndex = '$rowindex$';
		$jdw_kerja_d_grid->LoadDefaultValues();

		// Set row properties
		$jdw_kerja_d->ResetAttrs();
		$jdw_kerja_d->RowAttrs = array_merge($jdw_kerja_d->RowAttrs, array('data-rowindex'=>$jdw_kerja_d_grid->RowIndex, 'id'=>'r0_jdw_kerja_d', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($jdw_kerja_d->RowAttrs["class"], "ewTemplate");
		$jdw_kerja_d->RowType = EW_ROWTYPE_ADD;

		// Render row
		$jdw_kerja_d_grid->RenderRow();

		// Render list options
		$jdw_kerja_d_grid->RenderListOptions();
		$jdw_kerja_d_grid->StartRowCnt = 0;
?>
	<tr<?php echo $jdw_kerja_d->RowAttributes() ?>>
<?php

// Render list options (body, left)
$jdw_kerja_d_grid->ListOptions->Render("body", "left", $jdw_kerja_d_grid->RowIndex);
?>
	<?php if ($jdw_kerja_d->jdw_kerja_m_id->Visible) { // jdw_kerja_m_id ?>
		<td data-name="jdw_kerja_m_id">
<?php if ($jdw_kerja_d->CurrentAction <> "F") { ?>
<?php if ($jdw_kerja_d->jdw_kerja_m_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_jdw_kerja_d_jdw_kerja_m_id" class="form-group jdw_kerja_d_jdw_kerja_m_id">
<span<?php echo $jdw_kerja_d->jdw_kerja_m_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $jdw_kerja_d->jdw_kerja_m_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_m_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_jdw_kerja_d_jdw_kerja_m_id" class="form-group jdw_kerja_d_jdw_kerja_m_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id"><?php echo (strval($jdw_kerja_d->jdw_kerja_m_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $jdw_kerja_d->jdw_kerja_m_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($jdw_kerja_d->jdw_kerja_m_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_m_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $jdw_kerja_d->jdw_kerja_m_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" value="<?php echo $jdw_kerja_d->jdw_kerja_m_id->CurrentValue ?>"<?php echo $jdw_kerja_d->jdw_kerja_m_id->EditAttributes() ?>>
<input type="hidden" name="s_x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" id="s_x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" value="<?php echo $jdw_kerja_d->jdw_kerja_m_id->LookupFilterQuery() ?>">
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_jdw_kerja_d_jdw_kerja_m_id" class="form-group jdw_kerja_d_jdw_kerja_m_id">
<span<?php echo $jdw_kerja_d->jdw_kerja_m_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $jdw_kerja_d->jdw_kerja_m_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_m_id" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_m_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_m_id" name="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" id="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_m_id" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_m_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($jdw_kerja_d->jdw_kerja_d_idx->Visible) { // jdw_kerja_d_idx ?>
		<td data-name="jdw_kerja_d_idx">
<?php if ($jdw_kerja_d->CurrentAction <> "F") { ?>
<span id="el$rowindex$_jdw_kerja_d_jdw_kerja_d_idx" class="form-group jdw_kerja_d_jdw_kerja_d_idx">
<input type="text" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_idx" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_idx" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_idx" size="30" placeholder="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_idx->getPlaceHolder()) ?>" value="<?php echo $jdw_kerja_d->jdw_kerja_d_idx->EditValue ?>"<?php echo $jdw_kerja_d->jdw_kerja_d_idx->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_jdw_kerja_d_jdw_kerja_d_idx" class="form-group jdw_kerja_d_jdw_kerja_d_idx">
<span<?php echo $jdw_kerja_d->jdw_kerja_d_idx->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $jdw_kerja_d->jdw_kerja_d_idx->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_idx" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_idx" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_idx" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_idx->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_idx" name="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_idx" id="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_idx" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_idx->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($jdw_kerja_d->jk_id->Visible) { // jk_id ?>
		<td data-name="jk_id">
<?php if ($jdw_kerja_d->CurrentAction <> "F") { ?>
<span id="el$rowindex$_jdw_kerja_d_jk_id" class="form-group jdw_kerja_d_jk_id">
<input type="text" data-table="jdw_kerja_d" data-field="x_jk_id" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jk_id" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jk_id" size="30" placeholder="<?php echo ew_HtmlEncode($jdw_kerja_d->jk_id->getPlaceHolder()) ?>" value="<?php echo $jdw_kerja_d->jk_id->EditValue ?>"<?php echo $jdw_kerja_d->jk_id->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_jdw_kerja_d_jk_id" class="form-group jdw_kerja_d_jk_id">
<span<?php echo $jdw_kerja_d->jk_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $jdw_kerja_d->jk_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jk_id" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jk_id" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jk_id" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jk_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jk_id" name="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jk_id" id="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jk_id" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jk_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($jdw_kerja_d->jdw_kerja_d_hari->Visible) { // jdw_kerja_d_hari ?>
		<td data-name="jdw_kerja_d_hari">
<?php if ($jdw_kerja_d->CurrentAction <> "F") { ?>
<span id="el$rowindex$_jdw_kerja_d_jdw_kerja_d_hari" class="form-group jdw_kerja_d_jdw_kerja_d_hari">
<input type="text" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_hari" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_hari" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_hari" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_hari->getPlaceHolder()) ?>" value="<?php echo $jdw_kerja_d->jdw_kerja_d_hari->EditValue ?>"<?php echo $jdw_kerja_d->jdw_kerja_d_hari->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_jdw_kerja_d_jdw_kerja_d_hari" class="form-group jdw_kerja_d_jdw_kerja_d_hari">
<span<?php echo $jdw_kerja_d->jdw_kerja_d_hari->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $jdw_kerja_d->jdw_kerja_d_hari->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_hari" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_hari" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_hari" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_hari->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_hari" name="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_hari" id="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_hari" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_hari->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($jdw_kerja_d->jdw_kerja_d_libur->Visible) { // jdw_kerja_d_libur ?>
		<td data-name="jdw_kerja_d_libur">
<?php if ($jdw_kerja_d->CurrentAction <> "F") { ?>
<span id="el$rowindex$_jdw_kerja_d_jdw_kerja_d_libur" class="form-group jdw_kerja_d_jdw_kerja_d_libur">
<input type="text" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_libur" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_libur" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_libur" size="30" placeholder="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_libur->getPlaceHolder()) ?>" value="<?php echo $jdw_kerja_d->jdw_kerja_d_libur->EditValue ?>"<?php echo $jdw_kerja_d->jdw_kerja_d_libur->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_jdw_kerja_d_jdw_kerja_d_libur" class="form-group jdw_kerja_d_jdw_kerja_d_libur">
<span<?php echo $jdw_kerja_d->jdw_kerja_d_libur->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $jdw_kerja_d->jdw_kerja_d_libur->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_libur" name="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_libur" id="x<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_libur" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_libur->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="jdw_kerja_d" data-field="x_jdw_kerja_d_libur" name="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_libur" id="o<?php echo $jdw_kerja_d_grid->RowIndex ?>_jdw_kerja_d_libur" value="<?php echo ew_HtmlEncode($jdw_kerja_d->jdw_kerja_d_libur->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$jdw_kerja_d_grid->ListOptions->Render("body", "right", $jdw_kerja_d_grid->RowCnt);
?>
<script type="text/javascript">
fjdw_kerja_dgrid.UpdateOpts(<?php echo $jdw_kerja_d_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($jdw_kerja_d->CurrentMode == "add" || $jdw_kerja_d->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $jdw_kerja_d_grid->FormKeyCountName ?>" id="<?php echo $jdw_kerja_d_grid->FormKeyCountName ?>" value="<?php echo $jdw_kerja_d_grid->KeyCount ?>">
<?php echo $jdw_kerja_d_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($jdw_kerja_d->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $jdw_kerja_d_grid->FormKeyCountName ?>" id="<?php echo $jdw_kerja_d_grid->FormKeyCountName ?>" value="<?php echo $jdw_kerja_d_grid->KeyCount ?>">
<?php echo $jdw_kerja_d_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($jdw_kerja_d->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fjdw_kerja_dgrid">
</div>
<?php

// Close recordset
if ($jdw_kerja_d_grid->Recordset)
	$jdw_kerja_d_grid->Recordset->Close();
?>
<?php if ($jdw_kerja_d_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($jdw_kerja_d_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($jdw_kerja_d_grid->TotalRecs == 0 && $jdw_kerja_d->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($jdw_kerja_d_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($jdw_kerja_d->Export == "") { ?>
<script type="text/javascript">
fjdw_kerja_dgrid.Init();
</script>
<?php } ?>
<?php
$jdw_kerja_d_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$jdw_kerja_d_grid->Page_Terminate();
?>
