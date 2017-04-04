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

$kartu_scanlog_add = NULL; // Initialize page object first

class ckartu_scanlog_add extends ckartu_scanlog {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = "{4B5DAB39-E4BC-48DF-9311-E295A5F18030}";

	// Table name
	var $TableName = 'kartu_scanlog';

	// Page object name
	var $PageObjName = 'kartu_scanlog_add';

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
			define("EW_PAGE_ID", 'add', TRUE);

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
		if (!$Security->CanAdd()) {
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

		// Create form object
		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
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

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {
			$results = $this->GetAutoFill(@$_POST["name"], @$_POST["q"]);
			if ($results) {

				// Clean output buffer
				if (!EW_DEBUG_ENABLED && ob_get_length())
					ob_end_clean();
				echo $results;
				$this->Page_Terminate();
				exit();
			}
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

			// Handle modal response
			if ($this->IsModal) {
				$row = array();
				$row["url"] = $url;
				echo ew_ArrayToJson(array($row));
			} else {
				header("Location: " . $url);
			}
		}
		exit();
	}
	var $FormClassName = "form-horizontal ewForm ewAddForm";
	var $IsModal = FALSE;
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;
		global $gbSkipHeaderFooter;

		// Check modal
		$this->IsModal = (@$_GET["modal"] == "1" || @$_POST["modal"] == "1");
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$this->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["ks_id"] != "") {
				$this->ks_id->setQueryStringValue($_GET["ks_id"]);
				$this->setKey("ks_id", $this->ks_id->CurrentValue); // Set up key
			} else {
				$this->setKey("ks_id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "C"; // Copy record
			} else {
				$this->CurrentAction = "I"; // Display blank record
			}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Validate form if post back
		if (@$_POST["a_add"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else {
			if ($this->CurrentAction == "I") // Load default values for blank record
				$this->LoadDefaultValues();
		}

		// Perform action based on action code
		switch ($this->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("kartu_scanloglist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "kartu_scanloglist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to list page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "kartu_scanlogview.php")
						$sReturnUrl = $this->GetViewUrl(); // View page, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$this->RowType = EW_ROWTYPE_ADD; // Render add type

		// Render row
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		$this->pegawai_id->CurrentValue = NULL;
		$this->pegawai_id->OldValue = $this->pegawai_id->CurrentValue;
		$this->dow->CurrentValue = NULL;
		$this->dow->OldValue = $this->dow->CurrentValue;
		$this->scan_tgl->CurrentValue = NULL;
		$this->scan_tgl->OldValue = $this->scan_tgl->CurrentValue;
		$this->scan_jam_1->CurrentValue = NULL;
		$this->scan_jam_1->OldValue = $this->scan_jam_1->CurrentValue;
		$this->scan_jam_2->CurrentValue = NULL;
		$this->scan_jam_2->OldValue = $this->scan_jam_2->CurrentValue;
		$this->scan_jam_3->CurrentValue = NULL;
		$this->scan_jam_3->OldValue = $this->scan_jam_3->CurrentValue;
		$this->scan_jam_4->CurrentValue = NULL;
		$this->scan_jam_4->OldValue = $this->scan_jam_4->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->pegawai_id->FldIsDetailKey) {
			$this->pegawai_id->setFormValue($objForm->GetValue("x_pegawai_id"));
		}
		if (!$this->dow->FldIsDetailKey) {
			$this->dow->setFormValue($objForm->GetValue("x_dow"));
		}
		if (!$this->scan_tgl->FldIsDetailKey) {
			$this->scan_tgl->setFormValue($objForm->GetValue("x_scan_tgl"));
			$this->scan_tgl->CurrentValue = ew_UnFormatDateTime($this->scan_tgl->CurrentValue, 0);
		}
		if (!$this->scan_jam_1->FldIsDetailKey) {
			$this->scan_jam_1->setFormValue($objForm->GetValue("x_scan_jam_1"));
			$this->scan_jam_1->CurrentValue = ew_UnFormatDateTime($this->scan_jam_1->CurrentValue, 0);
		}
		if (!$this->scan_jam_2->FldIsDetailKey) {
			$this->scan_jam_2->setFormValue($objForm->GetValue("x_scan_jam_2"));
			$this->scan_jam_2->CurrentValue = ew_UnFormatDateTime($this->scan_jam_2->CurrentValue, 0);
		}
		if (!$this->scan_jam_3->FldIsDetailKey) {
			$this->scan_jam_3->setFormValue($objForm->GetValue("x_scan_jam_3"));
			$this->scan_jam_3->CurrentValue = ew_UnFormatDateTime($this->scan_jam_3->CurrentValue, 0);
		}
		if (!$this->scan_jam_4->FldIsDetailKey) {
			$this->scan_jam_4->setFormValue($objForm->GetValue("x_scan_jam_4"));
			$this->scan_jam_4->CurrentValue = ew_UnFormatDateTime($this->scan_jam_4->CurrentValue, 0);
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadOldRecord();
		$this->pegawai_id->CurrentValue = $this->pegawai_id->FormValue;
		$this->dow->CurrentValue = $this->dow->FormValue;
		$this->scan_tgl->CurrentValue = $this->scan_tgl->FormValue;
		$this->scan_tgl->CurrentValue = ew_UnFormatDateTime($this->scan_tgl->CurrentValue, 0);
		$this->scan_jam_1->CurrentValue = $this->scan_jam_1->FormValue;
		$this->scan_jam_1->CurrentValue = ew_UnFormatDateTime($this->scan_jam_1->CurrentValue, 0);
		$this->scan_jam_2->CurrentValue = $this->scan_jam_2->FormValue;
		$this->scan_jam_2->CurrentValue = ew_UnFormatDateTime($this->scan_jam_2->CurrentValue, 0);
		$this->scan_jam_3->CurrentValue = $this->scan_jam_3->FormValue;
		$this->scan_jam_3->CurrentValue = ew_UnFormatDateTime($this->scan_jam_3->CurrentValue, 0);
		$this->scan_jam_4->CurrentValue = $this->scan_jam_4->FormValue;
		$this->scan_jam_4->CurrentValue = ew_UnFormatDateTime($this->scan_jam_4->CurrentValue, 0);
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

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("ks_id")) <> "")
			$this->ks_id->CurrentValue = $this->getKey("ks_id"); // ks_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$this->CurrentFilter = $this->KeyFilter();
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$this->OldRecordset = ew_LoadRecordset($sSql, $conn);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// pegawai_id
			$this->pegawai_id->EditAttrs["class"] = "form-control";
			$this->pegawai_id->EditCustomAttributes = "";
			$this->pegawai_id->EditValue = ew_HtmlEncode($this->pegawai_id->CurrentValue);
			$this->pegawai_id->PlaceHolder = ew_RemoveHtml($this->pegawai_id->FldCaption());

			// dow
			$this->dow->EditAttrs["class"] = "form-control";
			$this->dow->EditCustomAttributes = "";
			$this->dow->EditValue = ew_HtmlEncode($this->dow->CurrentValue);
			$this->dow->PlaceHolder = ew_RemoveHtml($this->dow->FldCaption());

			// scan_tgl
			$this->scan_tgl->EditAttrs["class"] = "form-control";
			$this->scan_tgl->EditCustomAttributes = "";
			$this->scan_tgl->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->scan_tgl->CurrentValue, 8));
			$this->scan_tgl->PlaceHolder = ew_RemoveHtml($this->scan_tgl->FldCaption());

			// scan_jam_1
			$this->scan_jam_1->EditAttrs["class"] = "form-control";
			$this->scan_jam_1->EditCustomAttributes = "";
			$this->scan_jam_1->EditValue = ew_HtmlEncode($this->scan_jam_1->CurrentValue);
			$this->scan_jam_1->PlaceHolder = ew_RemoveHtml($this->scan_jam_1->FldCaption());

			// scan_jam_2
			$this->scan_jam_2->EditAttrs["class"] = "form-control";
			$this->scan_jam_2->EditCustomAttributes = "";
			$this->scan_jam_2->EditValue = ew_HtmlEncode($this->scan_jam_2->CurrentValue);
			$this->scan_jam_2->PlaceHolder = ew_RemoveHtml($this->scan_jam_2->FldCaption());

			// scan_jam_3
			$this->scan_jam_3->EditAttrs["class"] = "form-control";
			$this->scan_jam_3->EditCustomAttributes = "";
			$this->scan_jam_3->EditValue = ew_HtmlEncode($this->scan_jam_3->CurrentValue);
			$this->scan_jam_3->PlaceHolder = ew_RemoveHtml($this->scan_jam_3->FldCaption());

			// scan_jam_4
			$this->scan_jam_4->EditAttrs["class"] = "form-control";
			$this->scan_jam_4->EditCustomAttributes = "";
			$this->scan_jam_4->EditValue = ew_HtmlEncode($this->scan_jam_4->CurrentValue);
			$this->scan_jam_4->PlaceHolder = ew_RemoveHtml($this->scan_jam_4->FldCaption());

			// Add refer script
			// pegawai_id

			$this->pegawai_id->LinkCustomAttributes = "";
			$this->pegawai_id->HrefValue = "";

			// dow
			$this->dow->LinkCustomAttributes = "";
			$this->dow->HrefValue = "";

			// scan_tgl
			$this->scan_tgl->LinkCustomAttributes = "";
			$this->scan_tgl->HrefValue = "";

			// scan_jam_1
			$this->scan_jam_1->LinkCustomAttributes = "";
			$this->scan_jam_1->HrefValue = "";

			// scan_jam_2
			$this->scan_jam_2->LinkCustomAttributes = "";
			$this->scan_jam_2->HrefValue = "";

			// scan_jam_3
			$this->scan_jam_3->LinkCustomAttributes = "";
			$this->scan_jam_3->HrefValue = "";

			// scan_jam_4
			$this->scan_jam_4->LinkCustomAttributes = "";
			$this->scan_jam_4->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD ||
			$this->RowType == EW_ROWTYPE_EDIT ||
			$this->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$this->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!$this->pegawai_id->FldIsDetailKey && !is_null($this->pegawai_id->FormValue) && $this->pegawai_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->pegawai_id->FldCaption(), $this->pegawai_id->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->pegawai_id->FormValue)) {
			ew_AddMessage($gsFormError, $this->pegawai_id->FldErrMsg());
		}
		if (!$this->dow->FldIsDetailKey && !is_null($this->dow->FormValue) && $this->dow->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->dow->FldCaption(), $this->dow->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->dow->FormValue)) {
			ew_AddMessage($gsFormError, $this->dow->FldErrMsg());
		}
		if (!$this->scan_tgl->FldIsDetailKey && !is_null($this->scan_tgl->FormValue) && $this->scan_tgl->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->scan_tgl->FldCaption(), $this->scan_tgl->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->scan_tgl->FormValue)) {
			ew_AddMessage($gsFormError, $this->scan_tgl->FldErrMsg());
		}
		if (!$this->scan_jam_1->FldIsDetailKey && !is_null($this->scan_jam_1->FormValue) && $this->scan_jam_1->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->scan_jam_1->FldCaption(), $this->scan_jam_1->ReqErrMsg));
		}
		if (!ew_CheckTime($this->scan_jam_1->FormValue)) {
			ew_AddMessage($gsFormError, $this->scan_jam_1->FldErrMsg());
		}
		if (!$this->scan_jam_2->FldIsDetailKey && !is_null($this->scan_jam_2->FormValue) && $this->scan_jam_2->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->scan_jam_2->FldCaption(), $this->scan_jam_2->ReqErrMsg));
		}
		if (!ew_CheckTime($this->scan_jam_2->FormValue)) {
			ew_AddMessage($gsFormError, $this->scan_jam_2->FldErrMsg());
		}
		if (!$this->scan_jam_3->FldIsDetailKey && !is_null($this->scan_jam_3->FormValue) && $this->scan_jam_3->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->scan_jam_3->FldCaption(), $this->scan_jam_3->ReqErrMsg));
		}
		if (!ew_CheckTime($this->scan_jam_3->FormValue)) {
			ew_AddMessage($gsFormError, $this->scan_jam_3->FldErrMsg());
		}
		if (!$this->scan_jam_4->FldIsDetailKey && !is_null($this->scan_jam_4->FormValue) && $this->scan_jam_4->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->scan_jam_4->FldCaption(), $this->scan_jam_4->ReqErrMsg));
		}
		if (!ew_CheckTime($this->scan_jam_4->FormValue)) {
			ew_AddMessage($gsFormError, $this->scan_jam_4->FldErrMsg());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;
		$conn = &$this->Connection();

		// Load db values from rsold
		if ($rsold) {
			$this->LoadDbValues($rsold);
		}
		$rsnew = array();

		// pegawai_id
		$this->pegawai_id->SetDbValueDef($rsnew, $this->pegawai_id->CurrentValue, 0, FALSE);

		// dow
		$this->dow->SetDbValueDef($rsnew, $this->dow->CurrentValue, 0, FALSE);

		// scan_tgl
		$this->scan_tgl->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->scan_tgl->CurrentValue, 0), ew_CurrentDate(), FALSE);

		// scan_jam_1
		$this->scan_jam_1->SetDbValueDef($rsnew, $this->scan_jam_1->CurrentValue, ew_CurrentTime(), FALSE);

		// scan_jam_2
		$this->scan_jam_2->SetDbValueDef($rsnew, $this->scan_jam_2->CurrentValue, ew_CurrentTime(), FALSE);

		// scan_jam_3
		$this->scan_jam_3->SetDbValueDef($rsnew, $this->scan_jam_3->CurrentValue, ew_CurrentTime(), FALSE);

		// scan_jam_4
		$this->scan_jam_4->SetDbValueDef($rsnew, $this->scan_jam_4->CurrentValue, ew_CurrentTime(), FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("kartu_scanloglist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($kartu_scanlog_add)) $kartu_scanlog_add = new ckartu_scanlog_add();

// Page init
$kartu_scanlog_add->Page_Init();

// Page main
$kartu_scanlog_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$kartu_scanlog_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = fkartu_scanlogadd = new ew_Form("fkartu_scanlogadd", "add");

// Validate form
fkartu_scanlogadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_pegawai_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $kartu_scanlog->pegawai_id->FldCaption(), $kartu_scanlog->pegawai_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_pegawai_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($kartu_scanlog->pegawai_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_dow");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $kartu_scanlog->dow->FldCaption(), $kartu_scanlog->dow->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_dow");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($kartu_scanlog->dow->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_scan_tgl");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $kartu_scanlog->scan_tgl->FldCaption(), $kartu_scanlog->scan_tgl->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_scan_tgl");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($kartu_scanlog->scan_tgl->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_scan_jam_1");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $kartu_scanlog->scan_jam_1->FldCaption(), $kartu_scanlog->scan_jam_1->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_scan_jam_1");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($kartu_scanlog->scan_jam_1->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_scan_jam_2");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $kartu_scanlog->scan_jam_2->FldCaption(), $kartu_scanlog->scan_jam_2->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_scan_jam_2");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($kartu_scanlog->scan_jam_2->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_scan_jam_3");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $kartu_scanlog->scan_jam_3->FldCaption(), $kartu_scanlog->scan_jam_3->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_scan_jam_3");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($kartu_scanlog->scan_jam_3->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_scan_jam_4");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $kartu_scanlog->scan_jam_4->FldCaption(), $kartu_scanlog->scan_jam_4->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_scan_jam_4");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($kartu_scanlog->scan_jam_4->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ewForms[val])
			if (!ewForms[val].Validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
fkartu_scanlogadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fkartu_scanlogadd.ValidateRequired = true;
<?php } else { ?>
fkartu_scanlogadd.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$kartu_scanlog_add->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $kartu_scanlog_add->ShowPageHeader(); ?>
<?php
$kartu_scanlog_add->ShowMessage();
?>
<form name="fkartu_scanlogadd" id="fkartu_scanlogadd" class="<?php echo $kartu_scanlog_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($kartu_scanlog_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $kartu_scanlog_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="kartu_scanlog">
<input type="hidden" name="a_add" id="a_add" value="A">
<?php if ($kartu_scanlog_add->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div>
<?php if ($kartu_scanlog->pegawai_id->Visible) { // pegawai_id ?>
	<div id="r_pegawai_id" class="form-group">
		<label id="elh_kartu_scanlog_pegawai_id" for="x_pegawai_id" class="col-sm-2 control-label ewLabel"><?php echo $kartu_scanlog->pegawai_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $kartu_scanlog->pegawai_id->CellAttributes() ?>>
<span id="el_kartu_scanlog_pegawai_id">
<input type="text" data-table="kartu_scanlog" data-field="x_pegawai_id" name="x_pegawai_id" id="x_pegawai_id" size="30" placeholder="<?php echo ew_HtmlEncode($kartu_scanlog->pegawai_id->getPlaceHolder()) ?>" value="<?php echo $kartu_scanlog->pegawai_id->EditValue ?>"<?php echo $kartu_scanlog->pegawai_id->EditAttributes() ?>>
</span>
<?php echo $kartu_scanlog->pegawai_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartu_scanlog->dow->Visible) { // dow ?>
	<div id="r_dow" class="form-group">
		<label id="elh_kartu_scanlog_dow" for="x_dow" class="col-sm-2 control-label ewLabel"><?php echo $kartu_scanlog->dow->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $kartu_scanlog->dow->CellAttributes() ?>>
<span id="el_kartu_scanlog_dow">
<input type="text" data-table="kartu_scanlog" data-field="x_dow" name="x_dow" id="x_dow" size="30" placeholder="<?php echo ew_HtmlEncode($kartu_scanlog->dow->getPlaceHolder()) ?>" value="<?php echo $kartu_scanlog->dow->EditValue ?>"<?php echo $kartu_scanlog->dow->EditAttributes() ?>>
</span>
<?php echo $kartu_scanlog->dow->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartu_scanlog->scan_tgl->Visible) { // scan_tgl ?>
	<div id="r_scan_tgl" class="form-group">
		<label id="elh_kartu_scanlog_scan_tgl" for="x_scan_tgl" class="col-sm-2 control-label ewLabel"><?php echo $kartu_scanlog->scan_tgl->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $kartu_scanlog->scan_tgl->CellAttributes() ?>>
<span id="el_kartu_scanlog_scan_tgl">
<input type="text" data-table="kartu_scanlog" data-field="x_scan_tgl" name="x_scan_tgl" id="x_scan_tgl" placeholder="<?php echo ew_HtmlEncode($kartu_scanlog->scan_tgl->getPlaceHolder()) ?>" value="<?php echo $kartu_scanlog->scan_tgl->EditValue ?>"<?php echo $kartu_scanlog->scan_tgl->EditAttributes() ?>>
</span>
<?php echo $kartu_scanlog->scan_tgl->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartu_scanlog->scan_jam_1->Visible) { // scan_jam_1 ?>
	<div id="r_scan_jam_1" class="form-group">
		<label id="elh_kartu_scanlog_scan_jam_1" for="x_scan_jam_1" class="col-sm-2 control-label ewLabel"><?php echo $kartu_scanlog->scan_jam_1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $kartu_scanlog->scan_jam_1->CellAttributes() ?>>
<span id="el_kartu_scanlog_scan_jam_1">
<input type="text" data-table="kartu_scanlog" data-field="x_scan_jam_1" name="x_scan_jam_1" id="x_scan_jam_1" size="30" placeholder="<?php echo ew_HtmlEncode($kartu_scanlog->scan_jam_1->getPlaceHolder()) ?>" value="<?php echo $kartu_scanlog->scan_jam_1->EditValue ?>"<?php echo $kartu_scanlog->scan_jam_1->EditAttributes() ?>>
</span>
<?php echo $kartu_scanlog->scan_jam_1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartu_scanlog->scan_jam_2->Visible) { // scan_jam_2 ?>
	<div id="r_scan_jam_2" class="form-group">
		<label id="elh_kartu_scanlog_scan_jam_2" for="x_scan_jam_2" class="col-sm-2 control-label ewLabel"><?php echo $kartu_scanlog->scan_jam_2->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $kartu_scanlog->scan_jam_2->CellAttributes() ?>>
<span id="el_kartu_scanlog_scan_jam_2">
<input type="text" data-table="kartu_scanlog" data-field="x_scan_jam_2" name="x_scan_jam_2" id="x_scan_jam_2" size="30" placeholder="<?php echo ew_HtmlEncode($kartu_scanlog->scan_jam_2->getPlaceHolder()) ?>" value="<?php echo $kartu_scanlog->scan_jam_2->EditValue ?>"<?php echo $kartu_scanlog->scan_jam_2->EditAttributes() ?>>
</span>
<?php echo $kartu_scanlog->scan_jam_2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartu_scanlog->scan_jam_3->Visible) { // scan_jam_3 ?>
	<div id="r_scan_jam_3" class="form-group">
		<label id="elh_kartu_scanlog_scan_jam_3" for="x_scan_jam_3" class="col-sm-2 control-label ewLabel"><?php echo $kartu_scanlog->scan_jam_3->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $kartu_scanlog->scan_jam_3->CellAttributes() ?>>
<span id="el_kartu_scanlog_scan_jam_3">
<input type="text" data-table="kartu_scanlog" data-field="x_scan_jam_3" name="x_scan_jam_3" id="x_scan_jam_3" size="30" placeholder="<?php echo ew_HtmlEncode($kartu_scanlog->scan_jam_3->getPlaceHolder()) ?>" value="<?php echo $kartu_scanlog->scan_jam_3->EditValue ?>"<?php echo $kartu_scanlog->scan_jam_3->EditAttributes() ?>>
</span>
<?php echo $kartu_scanlog->scan_jam_3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($kartu_scanlog->scan_jam_4->Visible) { // scan_jam_4 ?>
	<div id="r_scan_jam_4" class="form-group">
		<label id="elh_kartu_scanlog_scan_jam_4" for="x_scan_jam_4" class="col-sm-2 control-label ewLabel"><?php echo $kartu_scanlog->scan_jam_4->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $kartu_scanlog->scan_jam_4->CellAttributes() ?>>
<span id="el_kartu_scanlog_scan_jam_4">
<input type="text" data-table="kartu_scanlog" data-field="x_scan_jam_4" name="x_scan_jam_4" id="x_scan_jam_4" size="30" placeholder="<?php echo ew_HtmlEncode($kartu_scanlog->scan_jam_4->getPlaceHolder()) ?>" value="<?php echo $kartu_scanlog->scan_jam_4->EditValue ?>"<?php echo $kartu_scanlog->scan_jam_4->EditAttributes() ?>>
</span>
<?php echo $kartu_scanlog->scan_jam_4->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<?php if (!$kartu_scanlog_add->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $kartu_scanlog_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php } ?>
</form>
<script type="text/javascript">
fkartu_scanlogadd.Init();
</script>
<?php
$kartu_scanlog_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$kartu_scanlog_add->Page_Terminate();
?>
