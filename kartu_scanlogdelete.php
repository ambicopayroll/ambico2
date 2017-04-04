<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "kartu_scanloginfo.php" ?>
<?php include_once "t_userinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$kartu_scanlog_delete = NULL; // Initialize page object first

class ckartu_scanlog_delete extends ckartu_scanlog {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = "{4B5DAB39-E4BC-48DF-9311-E295A5F18030}";

	// Table name
	var $TableName = 'kartu_scanlog';

	// Page object name
	var $PageObjName = 'kartu_scanlog_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EW_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_WARNING_MESSAGE], $v);
	}

	// Methods to clear message
	function ClearMessage() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
	}

	function ClearFailureMessage() {
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
	}

	function ClearSuccessMessage() {
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
	}

	function ClearWarningMessage() {
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	function ClearMessages() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EW_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p>" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Footer exists, display
			echo "<p>" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm;
		if ($this->UseTokenInUrl) {
			if ($objForm)
				return ($this->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $TokenTimeout = 0;
	var $CheckToken = EW_CHECK_TOKEN;
	var $CheckTokenFn = "ew_CheckToken";
	var $CreateTokenFn = "ew_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ew_IsHttpPost())
			return TRUE;
		if (!isset($_POST[EW_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EW_TOKEN_NAME], $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $gsToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$gsToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language;
		global $UserTable, $UserTableConn;
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = ew_SessionTimeoutTime();

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (kartu_scanlog)
		if (!isset($GLOBALS["kartu_scanlog"]) || get_class($GLOBALS["kartu_scanlog"]) == "ckartu_scanlog") {
			$GLOBALS["kartu_scanlog"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["kartu_scanlog"];
		}

		// Table object (t_user)
		if (!isset($GLOBALS['t_user'])) $GLOBALS['t_user'] = new ct_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'kartu_scanlog', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect($this->DBID);

		// User table object (t_user)
		if (!isset($UserTable)) {
			$UserTable = new ct_user();
			$UserTableConn = Conn($UserTable->DBID);
		}
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanDelete()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("kartu_scanloglist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}
		if ($Security->IsLoggedIn()) {
			$Security->UserID_Loading();
			$Security->LoadUserID();
			$Security->UserID_Loaded();
		}
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->ks_id->SetVisibility();
		$this->ks_id->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->pegawai_id->SetVisibility();
		$this->dow->SetVisibility();
		$this->scan_tgl->SetVisibility();
		$this->scan_jam_1->SetVisibility();
		$this->scan_jam_2->SetVisibility();
		$this->scan_jam_3->SetVisibility();
		$this->scan_jam_4->SetVisibility();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $Language->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Create Token
		$this->CreateToken();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT, $kartu_scanlog;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($kartu_scanlog);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}
		$this->Page_Redirecting($url);

		 // Close connection
		ew_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;
	var $StartRowCnt = 1;
	var $RowCnt = 0;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		$sFilter = $this->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("kartu_scanloglist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in kartu_scanlog class, kartu_scanloginfo.php

		$this->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$this->CurrentAction = $_POST["a_delete"];
		} elseif (@$_GET["a_delete"] == "1") {
			$this->CurrentAction = "D"; // Delete record directly
		} else {
			$this->CurrentAction = "I"; // Display record
		}
		if ($this->CurrentAction == "D") {
			$this->SendEmail = TRUE; // Send email on delete success
			if ($this->DeleteRows()) { // Delete rows
				if ($this->getSuccessMessage() == "")
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
				$this->Page_Terminate($this->getReturnUrl()); // Return to caller
			} else { // Delete failed
				$this->CurrentAction = "I"; // Display record
			}
		}
		if ($this->CurrentAction == "I") { // Load records for display
			if ($this->Recordset = $this->LoadRecordset())
				$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecs <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->Close();
				$this->Page_Terminate("kartu_scanloglist.php"); // Return to list
			}
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {

		// Load List page SQL
		$sSql = $this->SelectSQL();
		$conn = &$this->Connection();

		// Load recordset
		$dbtype = ew_GetConnectionType($this->DBID);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())));
			} else {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = ew_LoadRecordset($sSql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row = &$rs->fields;
		$this->Row_Selected($row);
		$this->ks_id->setDbValue($rs->fields('ks_id'));
		$this->pegawai_id->setDbValue($rs->fields('pegawai_id'));
		$this->dow->setDbValue($rs->fields('dow'));
		$this->scan_tgl->setDbValue($rs->fields('scan_tgl'));
		$this->scan_jam_1->setDbValue($rs->fields('scan_jam_1'));
		$this->scan_jam_2->setDbValue($rs->fields('scan_jam_2'));
		$this->scan_jam_3->setDbValue($rs->fields('scan_jam_3'));
		$this->scan_jam_4->setDbValue($rs->fields('scan_jam_4'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->ks_id->DbValue = $row['ks_id'];
		$this->pegawai_id->DbValue = $row['pegawai_id'];
		$this->dow->DbValue = $row['dow'];
		$this->scan_tgl->DbValue = $row['scan_tgl'];
		$this->scan_jam_1->DbValue = $row['scan_jam_1'];
		$this->scan_jam_2->DbValue = $row['scan_jam_2'];
		$this->scan_jam_3->DbValue = $row['scan_jam_3'];
		$this->scan_jam_4->DbValue = $row['scan_jam_4'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// ks_id
		// pegawai_id
		// dow
		// scan_tgl
		// scan_jam_1
		// scan_jam_2
		// scan_jam_3
		// scan_jam_4

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// ks_id
		$this->ks_id->ViewValue = $this->ks_id->CurrentValue;
		$this->ks_id->ViewCustomAttributes = "";

		// pegawai_id
		$this->pegawai_id->ViewValue = $this->pegawai_id->CurrentValue;
		$this->pegawai_id->ViewCustomAttributes = "";

		// dow
		$this->dow->ViewValue = $this->dow->CurrentValue;
		$this->dow->ViewCustomAttributes = "";

		// scan_tgl
		$this->scan_tgl->ViewValue = $this->scan_tgl->CurrentValue;
		$this->scan_tgl->ViewValue = ew_FormatDateTime($this->scan_tgl->ViewValue, 0);
		$this->scan_tgl->ViewCustomAttributes = "";

		// scan_jam_1
		$this->scan_jam_1->ViewValue = $this->scan_jam_1->CurrentValue;
		$this->scan_jam_1->ViewCustomAttributes = "";

		// scan_jam_2
		$this->scan_jam_2->ViewValue = $this->scan_jam_2->CurrentValue;
		$this->scan_jam_2->ViewCustomAttributes = "";

		// scan_jam_3
		$this->scan_jam_3->ViewValue = $this->scan_jam_3->CurrentValue;
		$this->scan_jam_3->ViewCustomAttributes = "";

		// scan_jam_4
		$this->scan_jam_4->ViewValue = $this->scan_jam_4->CurrentValue;
		$this->scan_jam_4->ViewCustomAttributes = "";

			// ks_id
			$this->ks_id->LinkCustomAttributes = "";
			$this->ks_id->HrefValue = "";
			$this->ks_id->TooltipValue = "";

			// pegawai_id
			$this->pegawai_id->LinkCustomAttributes = "";
			$this->pegawai_id->HrefValue = "";
			$this->pegawai_id->TooltipValue = "";

			// dow
			$this->dow->LinkCustomAttributes = "";
			$this->dow->HrefValue = "";
			$this->dow->TooltipValue = "";

			// scan_tgl
			$this->scan_tgl->LinkCustomAttributes = "";
			$this->scan_tgl->HrefValue = "";
			$this->scan_tgl->TooltipValue = "";

			// scan_jam_1
			$this->scan_jam_1->LinkCustomAttributes = "";
			$this->scan_jam_1->HrefValue = "";
			$this->scan_jam_1->TooltipValue = "";

			// scan_jam_2
			$this->scan_jam_2->LinkCustomAttributes = "";
			$this->scan_jam_2->HrefValue = "";
			$this->scan_jam_2->TooltipValue = "";

			// scan_jam_3
			$this->scan_jam_3->LinkCustomAttributes = "";
			$this->scan_jam_3->HrefValue = "";
			$this->scan_jam_3->TooltipValue = "";

			// scan_jam_4
			$this->scan_jam_4->LinkCustomAttributes = "";
			$this->scan_jam_4->HrefValue = "";
			$this->scan_jam_4->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $Language, $Security;
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;

		//} else {
		//	$this->LoadRowValues($rs); // Load row values

		}
		$rows = ($rs) ? $rs->GetRows() : array();
		$conn->BeginTrans();

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['ks_id'];
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("kartu_scanloglist.php"), "", $this->TableVar, TRUE);
		$PageId = "delete";
		$Breadcrumb->Add("delete", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($kartu_scanlog_delete)) $kartu_scanlog_delete = new ckartu_scanlog_delete();

// Page init
$kartu_scanlog_delete->Page_Init();

// Page main
$kartu_scanlog_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kartu_scanlog_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = fkartu_scanlogdelete = new ew_Form("fkartu_scanlogdelete", "delete");

// Form_CustomValidate event
fkartu_scanlogdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fkartu_scanlogdelete.ValidateRequired = true;
<?php } else { ?>
fkartu_scanlogdelete.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php $kartu_scanlog_delete->ShowPageHeader(); ?>
<?php
$kartu_scanlog_delete->ShowMessage();
?>
<form name="fkartu_scanlogdelete" id="fkartu_scanlogdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($kartu_scanlog_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $kartu_scanlog_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kartu_scanlog">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($kartu_scanlog_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table class="table ewTable">
<?php echo $kartu_scanlog->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
<?php if ($kartu_scanlog->ks_id->Visible) { // ks_id ?>
		<th><span id="elh_kartu_scanlog_ks_id" class="kartu_scanlog_ks_id"><?php echo $kartu_scanlog->ks_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($kartu_scanlog->pegawai_id->Visible) { // pegawai_id ?>
		<th><span id="elh_kartu_scanlog_pegawai_id" class="kartu_scanlog_pegawai_id"><?php echo $kartu_scanlog->pegawai_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($kartu_scanlog->dow->Visible) { // dow ?>
		<th><span id="elh_kartu_scanlog_dow" class="kartu_scanlog_dow"><?php echo $kartu_scanlog->dow->FldCaption() ?></span></th>
<?php } ?>
<?php if ($kartu_scanlog->scan_tgl->Visible) { // scan_tgl ?>
		<th><span id="elh_kartu_scanlog_scan_tgl" class="kartu_scanlog_scan_tgl"><?php echo $kartu_scanlog->scan_tgl->FldCaption() ?></span></th>
<?php } ?>
<?php if ($kartu_scanlog->scan_jam_1->Visible) { // scan_jam_1 ?>
		<th><span id="elh_kartu_scanlog_scan_jam_1" class="kartu_scanlog_scan_jam_1"><?php echo $kartu_scanlog->scan_jam_1->FldCaption() ?></span></th>
<?php } ?>
<?php if ($kartu_scanlog->scan_jam_2->Visible) { // scan_jam_2 ?>
		<th><span id="elh_kartu_scanlog_scan_jam_2" class="kartu_scanlog_scan_jam_2"><?php echo $kartu_scanlog->scan_jam_2->FldCaption() ?></span></th>
<?php } ?>
<?php if ($kartu_scanlog->scan_jam_3->Visible) { // scan_jam_3 ?>
		<th><span id="elh_kartu_scanlog_scan_jam_3" class="kartu_scanlog_scan_jam_3"><?php echo $kartu_scanlog->scan_jam_3->FldCaption() ?></span></th>
<?php } ?>
<?php if ($kartu_scanlog->scan_jam_4->Visible) { // scan_jam_4 ?>
		<th><span id="elh_kartu_scanlog_scan_jam_4" class="kartu_scanlog_scan_jam_4"><?php echo $kartu_scanlog->scan_jam_4->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$kartu_scanlog_delete->RecCnt = 0;
$i = 0;
while (!$kartu_scanlog_delete->Recordset->EOF) {
	$kartu_scanlog_delete->RecCnt++;
	$kartu_scanlog_delete->RowCnt++;

	// Set row properties
	$kartu_scanlog->ResetAttrs();
	$kartu_scanlog->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$kartu_scanlog_delete->LoadRowValues($kartu_scanlog_delete->Recordset);

	// Render row
	$kartu_scanlog_delete->RenderRow();
?>
	<tr<?php echo $kartu_scanlog->RowAttributes() ?>>
<?php if ($kartu_scanlog->ks_id->Visible) { // ks_id ?>
		<td<?php echo $kartu_scanlog->ks_id->CellAttributes() ?>>
<span id="el<?php echo $kartu_scanlog_delete->RowCnt ?>_kartu_scanlog_ks_id" class="kartu_scanlog_ks_id">
<span<?php echo $kartu_scanlog->ks_id->ViewAttributes() ?>>
<?php echo $kartu_scanlog->ks_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartu_scanlog->pegawai_id->Visible) { // pegawai_id ?>
		<td<?php echo $kartu_scanlog->pegawai_id->CellAttributes() ?>>
<span id="el<?php echo $kartu_scanlog_delete->RowCnt ?>_kartu_scanlog_pegawai_id" class="kartu_scanlog_pegawai_id">
<span<?php echo $kartu_scanlog->pegawai_id->ViewAttributes() ?>>
<?php echo $kartu_scanlog->pegawai_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartu_scanlog->dow->Visible) { // dow ?>
		<td<?php echo $kartu_scanlog->dow->CellAttributes() ?>>
<span id="el<?php echo $kartu_scanlog_delete->RowCnt ?>_kartu_scanlog_dow" class="kartu_scanlog_dow">
<span<?php echo $kartu_scanlog->dow->ViewAttributes() ?>>
<?php echo $kartu_scanlog->dow->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartu_scanlog->scan_tgl->Visible) { // scan_tgl ?>
		<td<?php echo $kartu_scanlog->scan_tgl->CellAttributes() ?>>
<span id="el<?php echo $kartu_scanlog_delete->RowCnt ?>_kartu_scanlog_scan_tgl" class="kartu_scanlog_scan_tgl">
<span<?php echo $kartu_scanlog->scan_tgl->ViewAttributes() ?>>
<?php echo $kartu_scanlog->scan_tgl->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartu_scanlog->scan_jam_1->Visible) { // scan_jam_1 ?>
		<td<?php echo $kartu_scanlog->scan_jam_1->CellAttributes() ?>>
<span id="el<?php echo $kartu_scanlog_delete->RowCnt ?>_kartu_scanlog_scan_jam_1" class="kartu_scanlog_scan_jam_1">
<span<?php echo $kartu_scanlog->scan_jam_1->ViewAttributes() ?>>
<?php echo $kartu_scanlog->scan_jam_1->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartu_scanlog->scan_jam_2->Visible) { // scan_jam_2 ?>
		<td<?php echo $kartu_scanlog->scan_jam_2->CellAttributes() ?>>
<span id="el<?php echo $kartu_scanlog_delete->RowCnt ?>_kartu_scanlog_scan_jam_2" class="kartu_scanlog_scan_jam_2">
<span<?php echo $kartu_scanlog->scan_jam_2->ViewAttributes() ?>>
<?php echo $kartu_scanlog->scan_jam_2->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartu_scanlog->scan_jam_3->Visible) { // scan_jam_3 ?>
		<td<?php echo $kartu_scanlog->scan_jam_3->CellAttributes() ?>>
<span id="el<?php echo $kartu_scanlog_delete->RowCnt ?>_kartu_scanlog_scan_jam_3" class="kartu_scanlog_scan_jam_3">
<span<?php echo $kartu_scanlog->scan_jam_3->ViewAttributes() ?>>
<?php echo $kartu_scanlog->scan_jam_3->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($kartu_scanlog->scan_jam_4->Visible) { // scan_jam_4 ?>
		<td<?php echo $kartu_scanlog->scan_jam_4->CellAttributes() ?>>
<span id="el<?php echo $kartu_scanlog_delete->RowCnt ?>_kartu_scanlog_scan_jam_4" class="kartu_scanlog_scan_jam_4">
<span<?php echo $kartu_scanlog->scan_jam_4->ViewAttributes() ?>>
<?php echo $kartu_scanlog->scan_jam_4->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$kartu_scanlog_delete->Recordset->MoveNext();
}
$kartu_scanlog_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $kartu_scanlog_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
fkartu_scanlogdelete.Init();
</script>
<?php
$kartu_scanlog_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$kartu_scanlog_delete->Page_Terminate();
?>
