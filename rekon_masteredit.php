<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "rekon_masterinfo.php" ?>
<?php include_once "t_userinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$rekon_master_edit = NULL; // Initialize page object first

class crekon_master_edit extends crekon_master {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = "{4B5DAB39-E4BC-48DF-9311-E295A5F18030}";

	// Table name
	var $TableName = 'rekon_master';

	// Page object name
	var $PageObjName = 'rekon_master_edit';

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

		// Table object (rekon_master)
		if (!isset($GLOBALS["rekon_master"]) || get_class($GLOBALS["rekon_master"]) == "crekon_master") {
			$GLOBALS["rekon_master"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["rekon_master"];
		}

		// Table object (t_user)
		if (!isset($GLOBALS['t_user'])) $GLOBALS['t_user'] = new ct_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'rekon_master', TRUE);

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
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("rekon_masterlist.php"));
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
		$this->rm_id->SetVisibility();
		$this->rm_id->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->pegawai_id->SetVisibility();
		$this->f1->SetVisibility();
		$this->f2->SetVisibility();
		$this->f3->SetVisibility();
		$this->f4->SetVisibility();
		$this->f5->SetVisibility();
		$this->f6->SetVisibility();
		$this->f7->SetVisibility();
		$this->f8->SetVisibility();
		$this->f9->SetVisibility();
		$this->f10->SetVisibility();
		$this->f11->SetVisibility();
		$this->f12->SetVisibility();
		$this->f13->SetVisibility();
		$this->f14->SetVisibility();
		$this->f15->SetVisibility();
		$this->f16->SetVisibility();
		$this->f17->SetVisibility();
		$this->f18->SetVisibility();
		$this->f19->SetVisibility();
		$this->f20->SetVisibility();
		$this->f21->SetVisibility();
		$this->f22->SetVisibility();
		$this->f23->SetVisibility();
		$this->f24->SetVisibility();
		$this->f25->SetVisibility();
		$this->f26->SetVisibility();
		$this->f27->SetVisibility();
		$this->f28->SetVisibility();
		$this->f29->SetVisibility();
		$this->f30->SetVisibility();
		$this->f31->SetVisibility();
		$this->f32->SetVisibility();
		$this->f33->SetVisibility();
		$this->f34->SetVisibility();
		$this->f35->SetVisibility();
		$this->f36->SetVisibility();
		$this->f37->SetVisibility();
		$this->f38->SetVisibility();
		$this->f39->SetVisibility();
		$this->f40->SetVisibility();
		$this->f41->SetVisibility();
		$this->f42->SetVisibility();
		$this->f43->SetVisibility();
		$this->f44->SetVisibility();
		$this->f45->SetVisibility();
		$this->f46->SetVisibility();
		$this->f47->SetVisibility();
		$this->f48->SetVisibility();
		$this->f49->SetVisibility();
		$this->f50->SetVisibility();
		$this->f51->SetVisibility();
		$this->f52->SetVisibility();
		$this->f53->SetVisibility();
		$this->f54->SetVisibility();
		$this->f55->SetVisibility();
		$this->f56->SetVisibility();
		$this->f57->SetVisibility();
		$this->f58->SetVisibility();
		$this->f59->SetVisibility();
		$this->f60->SetVisibility();
		$this->f61->SetVisibility();
		$this->f62->SetVisibility();

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
		global $EW_EXPORT, $rekon_master;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($rekon_master);
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
	var $FormClassName = "form-horizontal ewForm ewEditForm";
	var $IsModal = FALSE;
	var $DbMasterFilter;
	var $DbDetailFilter;

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

		// Load key from QueryString
		if (@$_GET["rm_id"] <> "") {
			$this->rm_id->setQueryStringValue($_GET["rm_id"]);
		}

		// Process form if post back
		if (@$_POST["a_edit"] <> "") {
			$this->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values
		} else {
			$this->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($this->rm_id->CurrentValue == "") {
			$this->Page_Terminate("rekon_masterlist.php"); // Invalid key, return to list
		}

		// Validate form if post back
		if (@$_POST["a_edit"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		}
		switch ($this->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("rekon_masterlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "rekon_masterlist.php")
					$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to list page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} elseif ($this->getFailureMessage() == $Language->Phrase("NoRecord")) {
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render the record
		$this->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$this->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->rm_id->FldIsDetailKey)
			$this->rm_id->setFormValue($objForm->GetValue("x_rm_id"));
		if (!$this->pegawai_id->FldIsDetailKey) {
			$this->pegawai_id->setFormValue($objForm->GetValue("x_pegawai_id"));
		}
		if (!$this->f1->FldIsDetailKey) {
			$this->f1->setFormValue($objForm->GetValue("x_f1"));
			$this->f1->CurrentValue = ew_UnFormatDateTime($this->f1->CurrentValue, 0);
		}
		if (!$this->f2->FldIsDetailKey) {
			$this->f2->setFormValue($objForm->GetValue("x_f2"));
			$this->f2->CurrentValue = ew_UnFormatDateTime($this->f2->CurrentValue, 0);
		}
		if (!$this->f3->FldIsDetailKey) {
			$this->f3->setFormValue($objForm->GetValue("x_f3"));
			$this->f3->CurrentValue = ew_UnFormatDateTime($this->f3->CurrentValue, 0);
		}
		if (!$this->f4->FldIsDetailKey) {
			$this->f4->setFormValue($objForm->GetValue("x_f4"));
			$this->f4->CurrentValue = ew_UnFormatDateTime($this->f4->CurrentValue, 0);
		}
		if (!$this->f5->FldIsDetailKey) {
			$this->f5->setFormValue($objForm->GetValue("x_f5"));
			$this->f5->CurrentValue = ew_UnFormatDateTime($this->f5->CurrentValue, 0);
		}
		if (!$this->f6->FldIsDetailKey) {
			$this->f6->setFormValue($objForm->GetValue("x_f6"));
			$this->f6->CurrentValue = ew_UnFormatDateTime($this->f6->CurrentValue, 0);
		}
		if (!$this->f7->FldIsDetailKey) {
			$this->f7->setFormValue($objForm->GetValue("x_f7"));
			$this->f7->CurrentValue = ew_UnFormatDateTime($this->f7->CurrentValue, 0);
		}
		if (!$this->f8->FldIsDetailKey) {
			$this->f8->setFormValue($objForm->GetValue("x_f8"));
			$this->f8->CurrentValue = ew_UnFormatDateTime($this->f8->CurrentValue, 0);
		}
		if (!$this->f9->FldIsDetailKey) {
			$this->f9->setFormValue($objForm->GetValue("x_f9"));
			$this->f9->CurrentValue = ew_UnFormatDateTime($this->f9->CurrentValue, 0);
		}
		if (!$this->f10->FldIsDetailKey) {
			$this->f10->setFormValue($objForm->GetValue("x_f10"));
			$this->f10->CurrentValue = ew_UnFormatDateTime($this->f10->CurrentValue, 0);
		}
		if (!$this->f11->FldIsDetailKey) {
			$this->f11->setFormValue($objForm->GetValue("x_f11"));
			$this->f11->CurrentValue = ew_UnFormatDateTime($this->f11->CurrentValue, 0);
		}
		if (!$this->f12->FldIsDetailKey) {
			$this->f12->setFormValue($objForm->GetValue("x_f12"));
			$this->f12->CurrentValue = ew_UnFormatDateTime($this->f12->CurrentValue, 0);
		}
		if (!$this->f13->FldIsDetailKey) {
			$this->f13->setFormValue($objForm->GetValue("x_f13"));
			$this->f13->CurrentValue = ew_UnFormatDateTime($this->f13->CurrentValue, 0);
		}
		if (!$this->f14->FldIsDetailKey) {
			$this->f14->setFormValue($objForm->GetValue("x_f14"));
			$this->f14->CurrentValue = ew_UnFormatDateTime($this->f14->CurrentValue, 0);
		}
		if (!$this->f15->FldIsDetailKey) {
			$this->f15->setFormValue($objForm->GetValue("x_f15"));
			$this->f15->CurrentValue = ew_UnFormatDateTime($this->f15->CurrentValue, 0);
		}
		if (!$this->f16->FldIsDetailKey) {
			$this->f16->setFormValue($objForm->GetValue("x_f16"));
			$this->f16->CurrentValue = ew_UnFormatDateTime($this->f16->CurrentValue, 0);
		}
		if (!$this->f17->FldIsDetailKey) {
			$this->f17->setFormValue($objForm->GetValue("x_f17"));
			$this->f17->CurrentValue = ew_UnFormatDateTime($this->f17->CurrentValue, 0);
		}
		if (!$this->f18->FldIsDetailKey) {
			$this->f18->setFormValue($objForm->GetValue("x_f18"));
			$this->f18->CurrentValue = ew_UnFormatDateTime($this->f18->CurrentValue, 0);
		}
		if (!$this->f19->FldIsDetailKey) {
			$this->f19->setFormValue($objForm->GetValue("x_f19"));
			$this->f19->CurrentValue = ew_UnFormatDateTime($this->f19->CurrentValue, 0);
		}
		if (!$this->f20->FldIsDetailKey) {
			$this->f20->setFormValue($objForm->GetValue("x_f20"));
			$this->f20->CurrentValue = ew_UnFormatDateTime($this->f20->CurrentValue, 0);
		}
		if (!$this->f21->FldIsDetailKey) {
			$this->f21->setFormValue($objForm->GetValue("x_f21"));
			$this->f21->CurrentValue = ew_UnFormatDateTime($this->f21->CurrentValue, 0);
		}
		if (!$this->f22->FldIsDetailKey) {
			$this->f22->setFormValue($objForm->GetValue("x_f22"));
			$this->f22->CurrentValue = ew_UnFormatDateTime($this->f22->CurrentValue, 0);
		}
		if (!$this->f23->FldIsDetailKey) {
			$this->f23->setFormValue($objForm->GetValue("x_f23"));
			$this->f23->CurrentValue = ew_UnFormatDateTime($this->f23->CurrentValue, 0);
		}
		if (!$this->f24->FldIsDetailKey) {
			$this->f24->setFormValue($objForm->GetValue("x_f24"));
			$this->f24->CurrentValue = ew_UnFormatDateTime($this->f24->CurrentValue, 0);
		}
		if (!$this->f25->FldIsDetailKey) {
			$this->f25->setFormValue($objForm->GetValue("x_f25"));
			$this->f25->CurrentValue = ew_UnFormatDateTime($this->f25->CurrentValue, 0);
		}
		if (!$this->f26->FldIsDetailKey) {
			$this->f26->setFormValue($objForm->GetValue("x_f26"));
			$this->f26->CurrentValue = ew_UnFormatDateTime($this->f26->CurrentValue, 0);
		}
		if (!$this->f27->FldIsDetailKey) {
			$this->f27->setFormValue($objForm->GetValue("x_f27"));
			$this->f27->CurrentValue = ew_UnFormatDateTime($this->f27->CurrentValue, 0);
		}
		if (!$this->f28->FldIsDetailKey) {
			$this->f28->setFormValue($objForm->GetValue("x_f28"));
			$this->f28->CurrentValue = ew_UnFormatDateTime($this->f28->CurrentValue, 0);
		}
		if (!$this->f29->FldIsDetailKey) {
			$this->f29->setFormValue($objForm->GetValue("x_f29"));
			$this->f29->CurrentValue = ew_UnFormatDateTime($this->f29->CurrentValue, 0);
		}
		if (!$this->f30->FldIsDetailKey) {
			$this->f30->setFormValue($objForm->GetValue("x_f30"));
			$this->f30->CurrentValue = ew_UnFormatDateTime($this->f30->CurrentValue, 0);
		}
		if (!$this->f31->FldIsDetailKey) {
			$this->f31->setFormValue($objForm->GetValue("x_f31"));
			$this->f31->CurrentValue = ew_UnFormatDateTime($this->f31->CurrentValue, 0);
		}
		if (!$this->f32->FldIsDetailKey) {
			$this->f32->setFormValue($objForm->GetValue("x_f32"));
			$this->f32->CurrentValue = ew_UnFormatDateTime($this->f32->CurrentValue, 0);
		}
		if (!$this->f33->FldIsDetailKey) {
			$this->f33->setFormValue($objForm->GetValue("x_f33"));
			$this->f33->CurrentValue = ew_UnFormatDateTime($this->f33->CurrentValue, 0);
		}
		if (!$this->f34->FldIsDetailKey) {
			$this->f34->setFormValue($objForm->GetValue("x_f34"));
			$this->f34->CurrentValue = ew_UnFormatDateTime($this->f34->CurrentValue, 0);
		}
		if (!$this->f35->FldIsDetailKey) {
			$this->f35->setFormValue($objForm->GetValue("x_f35"));
			$this->f35->CurrentValue = ew_UnFormatDateTime($this->f35->CurrentValue, 0);
		}
		if (!$this->f36->FldIsDetailKey) {
			$this->f36->setFormValue($objForm->GetValue("x_f36"));
			$this->f36->CurrentValue = ew_UnFormatDateTime($this->f36->CurrentValue, 0);
		}
		if (!$this->f37->FldIsDetailKey) {
			$this->f37->setFormValue($objForm->GetValue("x_f37"));
			$this->f37->CurrentValue = ew_UnFormatDateTime($this->f37->CurrentValue, 0);
		}
		if (!$this->f38->FldIsDetailKey) {
			$this->f38->setFormValue($objForm->GetValue("x_f38"));
			$this->f38->CurrentValue = ew_UnFormatDateTime($this->f38->CurrentValue, 0);
		}
		if (!$this->f39->FldIsDetailKey) {
			$this->f39->setFormValue($objForm->GetValue("x_f39"));
			$this->f39->CurrentValue = ew_UnFormatDateTime($this->f39->CurrentValue, 0);
		}
		if (!$this->f40->FldIsDetailKey) {
			$this->f40->setFormValue($objForm->GetValue("x_f40"));
			$this->f40->CurrentValue = ew_UnFormatDateTime($this->f40->CurrentValue, 0);
		}
		if (!$this->f41->FldIsDetailKey) {
			$this->f41->setFormValue($objForm->GetValue("x_f41"));
			$this->f41->CurrentValue = ew_UnFormatDateTime($this->f41->CurrentValue, 0);
		}
		if (!$this->f42->FldIsDetailKey) {
			$this->f42->setFormValue($objForm->GetValue("x_f42"));
			$this->f42->CurrentValue = ew_UnFormatDateTime($this->f42->CurrentValue, 0);
		}
		if (!$this->f43->FldIsDetailKey) {
			$this->f43->setFormValue($objForm->GetValue("x_f43"));
			$this->f43->CurrentValue = ew_UnFormatDateTime($this->f43->CurrentValue, 0);
		}
		if (!$this->f44->FldIsDetailKey) {
			$this->f44->setFormValue($objForm->GetValue("x_f44"));
			$this->f44->CurrentValue = ew_UnFormatDateTime($this->f44->CurrentValue, 0);
		}
		if (!$this->f45->FldIsDetailKey) {
			$this->f45->setFormValue($objForm->GetValue("x_f45"));
			$this->f45->CurrentValue = ew_UnFormatDateTime($this->f45->CurrentValue, 0);
		}
		if (!$this->f46->FldIsDetailKey) {
			$this->f46->setFormValue($objForm->GetValue("x_f46"));
			$this->f46->CurrentValue = ew_UnFormatDateTime($this->f46->CurrentValue, 0);
		}
		if (!$this->f47->FldIsDetailKey) {
			$this->f47->setFormValue($objForm->GetValue("x_f47"));
			$this->f47->CurrentValue = ew_UnFormatDateTime($this->f47->CurrentValue, 0);
		}
		if (!$this->f48->FldIsDetailKey) {
			$this->f48->setFormValue($objForm->GetValue("x_f48"));
			$this->f48->CurrentValue = ew_UnFormatDateTime($this->f48->CurrentValue, 0);
		}
		if (!$this->f49->FldIsDetailKey) {
			$this->f49->setFormValue($objForm->GetValue("x_f49"));
			$this->f49->CurrentValue = ew_UnFormatDateTime($this->f49->CurrentValue, 0);
		}
		if (!$this->f50->FldIsDetailKey) {
			$this->f50->setFormValue($objForm->GetValue("x_f50"));
			$this->f50->CurrentValue = ew_UnFormatDateTime($this->f50->CurrentValue, 0);
		}
		if (!$this->f51->FldIsDetailKey) {
			$this->f51->setFormValue($objForm->GetValue("x_f51"));
			$this->f51->CurrentValue = ew_UnFormatDateTime($this->f51->CurrentValue, 0);
		}
		if (!$this->f52->FldIsDetailKey) {
			$this->f52->setFormValue($objForm->GetValue("x_f52"));
			$this->f52->CurrentValue = ew_UnFormatDateTime($this->f52->CurrentValue, 0);
		}
		if (!$this->f53->FldIsDetailKey) {
			$this->f53->setFormValue($objForm->GetValue("x_f53"));
			$this->f53->CurrentValue = ew_UnFormatDateTime($this->f53->CurrentValue, 0);
		}
		if (!$this->f54->FldIsDetailKey) {
			$this->f54->setFormValue($objForm->GetValue("x_f54"));
			$this->f54->CurrentValue = ew_UnFormatDateTime($this->f54->CurrentValue, 0);
		}
		if (!$this->f55->FldIsDetailKey) {
			$this->f55->setFormValue($objForm->GetValue("x_f55"));
			$this->f55->CurrentValue = ew_UnFormatDateTime($this->f55->CurrentValue, 0);
		}
		if (!$this->f56->FldIsDetailKey) {
			$this->f56->setFormValue($objForm->GetValue("x_f56"));
			$this->f56->CurrentValue = ew_UnFormatDateTime($this->f56->CurrentValue, 0);
		}
		if (!$this->f57->FldIsDetailKey) {
			$this->f57->setFormValue($objForm->GetValue("x_f57"));
			$this->f57->CurrentValue = ew_UnFormatDateTime($this->f57->CurrentValue, 0);
		}
		if (!$this->f58->FldIsDetailKey) {
			$this->f58->setFormValue($objForm->GetValue("x_f58"));
			$this->f58->CurrentValue = ew_UnFormatDateTime($this->f58->CurrentValue, 0);
		}
		if (!$this->f59->FldIsDetailKey) {
			$this->f59->setFormValue($objForm->GetValue("x_f59"));
			$this->f59->CurrentValue = ew_UnFormatDateTime($this->f59->CurrentValue, 0);
		}
		if (!$this->f60->FldIsDetailKey) {
			$this->f60->setFormValue($objForm->GetValue("x_f60"));
			$this->f60->CurrentValue = ew_UnFormatDateTime($this->f60->CurrentValue, 0);
		}
		if (!$this->f61->FldIsDetailKey) {
			$this->f61->setFormValue($objForm->GetValue("x_f61"));
			$this->f61->CurrentValue = ew_UnFormatDateTime($this->f61->CurrentValue, 0);
		}
		if (!$this->f62->FldIsDetailKey) {
			$this->f62->setFormValue($objForm->GetValue("x_f62"));
			$this->f62->CurrentValue = ew_UnFormatDateTime($this->f62->CurrentValue, 0);
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadRow();
		$this->rm_id->CurrentValue = $this->rm_id->FormValue;
		$this->pegawai_id->CurrentValue = $this->pegawai_id->FormValue;
		$this->f1->CurrentValue = $this->f1->FormValue;
		$this->f1->CurrentValue = ew_UnFormatDateTime($this->f1->CurrentValue, 0);
		$this->f2->CurrentValue = $this->f2->FormValue;
		$this->f2->CurrentValue = ew_UnFormatDateTime($this->f2->CurrentValue, 0);
		$this->f3->CurrentValue = $this->f3->FormValue;
		$this->f3->CurrentValue = ew_UnFormatDateTime($this->f3->CurrentValue, 0);
		$this->f4->CurrentValue = $this->f4->FormValue;
		$this->f4->CurrentValue = ew_UnFormatDateTime($this->f4->CurrentValue, 0);
		$this->f5->CurrentValue = $this->f5->FormValue;
		$this->f5->CurrentValue = ew_UnFormatDateTime($this->f5->CurrentValue, 0);
		$this->f6->CurrentValue = $this->f6->FormValue;
		$this->f6->CurrentValue = ew_UnFormatDateTime($this->f6->CurrentValue, 0);
		$this->f7->CurrentValue = $this->f7->FormValue;
		$this->f7->CurrentValue = ew_UnFormatDateTime($this->f7->CurrentValue, 0);
		$this->f8->CurrentValue = $this->f8->FormValue;
		$this->f8->CurrentValue = ew_UnFormatDateTime($this->f8->CurrentValue, 0);
		$this->f9->CurrentValue = $this->f9->FormValue;
		$this->f9->CurrentValue = ew_UnFormatDateTime($this->f9->CurrentValue, 0);
		$this->f10->CurrentValue = $this->f10->FormValue;
		$this->f10->CurrentValue = ew_UnFormatDateTime($this->f10->CurrentValue, 0);
		$this->f11->CurrentValue = $this->f11->FormValue;
		$this->f11->CurrentValue = ew_UnFormatDateTime($this->f11->CurrentValue, 0);
		$this->f12->CurrentValue = $this->f12->FormValue;
		$this->f12->CurrentValue = ew_UnFormatDateTime($this->f12->CurrentValue, 0);
		$this->f13->CurrentValue = $this->f13->FormValue;
		$this->f13->CurrentValue = ew_UnFormatDateTime($this->f13->CurrentValue, 0);
		$this->f14->CurrentValue = $this->f14->FormValue;
		$this->f14->CurrentValue = ew_UnFormatDateTime($this->f14->CurrentValue, 0);
		$this->f15->CurrentValue = $this->f15->FormValue;
		$this->f15->CurrentValue = ew_UnFormatDateTime($this->f15->CurrentValue, 0);
		$this->f16->CurrentValue = $this->f16->FormValue;
		$this->f16->CurrentValue = ew_UnFormatDateTime($this->f16->CurrentValue, 0);
		$this->f17->CurrentValue = $this->f17->FormValue;
		$this->f17->CurrentValue = ew_UnFormatDateTime($this->f17->CurrentValue, 0);
		$this->f18->CurrentValue = $this->f18->FormValue;
		$this->f18->CurrentValue = ew_UnFormatDateTime($this->f18->CurrentValue, 0);
		$this->f19->CurrentValue = $this->f19->FormValue;
		$this->f19->CurrentValue = ew_UnFormatDateTime($this->f19->CurrentValue, 0);
		$this->f20->CurrentValue = $this->f20->FormValue;
		$this->f20->CurrentValue = ew_UnFormatDateTime($this->f20->CurrentValue, 0);
		$this->f21->CurrentValue = $this->f21->FormValue;
		$this->f21->CurrentValue = ew_UnFormatDateTime($this->f21->CurrentValue, 0);
		$this->f22->CurrentValue = $this->f22->FormValue;
		$this->f22->CurrentValue = ew_UnFormatDateTime($this->f22->CurrentValue, 0);
		$this->f23->CurrentValue = $this->f23->FormValue;
		$this->f23->CurrentValue = ew_UnFormatDateTime($this->f23->CurrentValue, 0);
		$this->f24->CurrentValue = $this->f24->FormValue;
		$this->f24->CurrentValue = ew_UnFormatDateTime($this->f24->CurrentValue, 0);
		$this->f25->CurrentValue = $this->f25->FormValue;
		$this->f25->CurrentValue = ew_UnFormatDateTime($this->f25->CurrentValue, 0);
		$this->f26->CurrentValue = $this->f26->FormValue;
		$this->f26->CurrentValue = ew_UnFormatDateTime($this->f26->CurrentValue, 0);
		$this->f27->CurrentValue = $this->f27->FormValue;
		$this->f27->CurrentValue = ew_UnFormatDateTime($this->f27->CurrentValue, 0);
		$this->f28->CurrentValue = $this->f28->FormValue;
		$this->f28->CurrentValue = ew_UnFormatDateTime($this->f28->CurrentValue, 0);
		$this->f29->CurrentValue = $this->f29->FormValue;
		$this->f29->CurrentValue = ew_UnFormatDateTime($this->f29->CurrentValue, 0);
		$this->f30->CurrentValue = $this->f30->FormValue;
		$this->f30->CurrentValue = ew_UnFormatDateTime($this->f30->CurrentValue, 0);
		$this->f31->CurrentValue = $this->f31->FormValue;
		$this->f31->CurrentValue = ew_UnFormatDateTime($this->f31->CurrentValue, 0);
		$this->f32->CurrentValue = $this->f32->FormValue;
		$this->f32->CurrentValue = ew_UnFormatDateTime($this->f32->CurrentValue, 0);
		$this->f33->CurrentValue = $this->f33->FormValue;
		$this->f33->CurrentValue = ew_UnFormatDateTime($this->f33->CurrentValue, 0);
		$this->f34->CurrentValue = $this->f34->FormValue;
		$this->f34->CurrentValue = ew_UnFormatDateTime($this->f34->CurrentValue, 0);
		$this->f35->CurrentValue = $this->f35->FormValue;
		$this->f35->CurrentValue = ew_UnFormatDateTime($this->f35->CurrentValue, 0);
		$this->f36->CurrentValue = $this->f36->FormValue;
		$this->f36->CurrentValue = ew_UnFormatDateTime($this->f36->CurrentValue, 0);
		$this->f37->CurrentValue = $this->f37->FormValue;
		$this->f37->CurrentValue = ew_UnFormatDateTime($this->f37->CurrentValue, 0);
		$this->f38->CurrentValue = $this->f38->FormValue;
		$this->f38->CurrentValue = ew_UnFormatDateTime($this->f38->CurrentValue, 0);
		$this->f39->CurrentValue = $this->f39->FormValue;
		$this->f39->CurrentValue = ew_UnFormatDateTime($this->f39->CurrentValue, 0);
		$this->f40->CurrentValue = $this->f40->FormValue;
		$this->f40->CurrentValue = ew_UnFormatDateTime($this->f40->CurrentValue, 0);
		$this->f41->CurrentValue = $this->f41->FormValue;
		$this->f41->CurrentValue = ew_UnFormatDateTime($this->f41->CurrentValue, 0);
		$this->f42->CurrentValue = $this->f42->FormValue;
		$this->f42->CurrentValue = ew_UnFormatDateTime($this->f42->CurrentValue, 0);
		$this->f43->CurrentValue = $this->f43->FormValue;
		$this->f43->CurrentValue = ew_UnFormatDateTime($this->f43->CurrentValue, 0);
		$this->f44->CurrentValue = $this->f44->FormValue;
		$this->f44->CurrentValue = ew_UnFormatDateTime($this->f44->CurrentValue, 0);
		$this->f45->CurrentValue = $this->f45->FormValue;
		$this->f45->CurrentValue = ew_UnFormatDateTime($this->f45->CurrentValue, 0);
		$this->f46->CurrentValue = $this->f46->FormValue;
		$this->f46->CurrentValue = ew_UnFormatDateTime($this->f46->CurrentValue, 0);
		$this->f47->CurrentValue = $this->f47->FormValue;
		$this->f47->CurrentValue = ew_UnFormatDateTime($this->f47->CurrentValue, 0);
		$this->f48->CurrentValue = $this->f48->FormValue;
		$this->f48->CurrentValue = ew_UnFormatDateTime($this->f48->CurrentValue, 0);
		$this->f49->CurrentValue = $this->f49->FormValue;
		$this->f49->CurrentValue = ew_UnFormatDateTime($this->f49->CurrentValue, 0);
		$this->f50->CurrentValue = $this->f50->FormValue;
		$this->f50->CurrentValue = ew_UnFormatDateTime($this->f50->CurrentValue, 0);
		$this->f51->CurrentValue = $this->f51->FormValue;
		$this->f51->CurrentValue = ew_UnFormatDateTime($this->f51->CurrentValue, 0);
		$this->f52->CurrentValue = $this->f52->FormValue;
		$this->f52->CurrentValue = ew_UnFormatDateTime($this->f52->CurrentValue, 0);
		$this->f53->CurrentValue = $this->f53->FormValue;
		$this->f53->CurrentValue = ew_UnFormatDateTime($this->f53->CurrentValue, 0);
		$this->f54->CurrentValue = $this->f54->FormValue;
		$this->f54->CurrentValue = ew_UnFormatDateTime($this->f54->CurrentValue, 0);
		$this->f55->CurrentValue = $this->f55->FormValue;
		$this->f55->CurrentValue = ew_UnFormatDateTime($this->f55->CurrentValue, 0);
		$this->f56->CurrentValue = $this->f56->FormValue;
		$this->f56->CurrentValue = ew_UnFormatDateTime($this->f56->CurrentValue, 0);
		$this->f57->CurrentValue = $this->f57->FormValue;
		$this->f57->CurrentValue = ew_UnFormatDateTime($this->f57->CurrentValue, 0);
		$this->f58->CurrentValue = $this->f58->FormValue;
		$this->f58->CurrentValue = ew_UnFormatDateTime($this->f58->CurrentValue, 0);
		$this->f59->CurrentValue = $this->f59->FormValue;
		$this->f59->CurrentValue = ew_UnFormatDateTime($this->f59->CurrentValue, 0);
		$this->f60->CurrentValue = $this->f60->FormValue;
		$this->f60->CurrentValue = ew_UnFormatDateTime($this->f60->CurrentValue, 0);
		$this->f61->CurrentValue = $this->f61->FormValue;
		$this->f61->CurrentValue = ew_UnFormatDateTime($this->f61->CurrentValue, 0);
		$this->f62->CurrentValue = $this->f62->FormValue;
		$this->f62->CurrentValue = ew_UnFormatDateTime($this->f62->CurrentValue, 0);
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
		$this->rm_id->setDbValue($rs->fields('rm_id'));
		$this->pegawai_id->setDbValue($rs->fields('pegawai_id'));
		$this->f1->setDbValue($rs->fields('f1'));
		$this->f2->setDbValue($rs->fields('f2'));
		$this->f3->setDbValue($rs->fields('f3'));
		$this->f4->setDbValue($rs->fields('f4'));
		$this->f5->setDbValue($rs->fields('f5'));
		$this->f6->setDbValue($rs->fields('f6'));
		$this->f7->setDbValue($rs->fields('f7'));
		$this->f8->setDbValue($rs->fields('f8'));
		$this->f9->setDbValue($rs->fields('f9'));
		$this->f10->setDbValue($rs->fields('f10'));
		$this->f11->setDbValue($rs->fields('f11'));
		$this->f12->setDbValue($rs->fields('f12'));
		$this->f13->setDbValue($rs->fields('f13'));
		$this->f14->setDbValue($rs->fields('f14'));
		$this->f15->setDbValue($rs->fields('f15'));
		$this->f16->setDbValue($rs->fields('f16'));
		$this->f17->setDbValue($rs->fields('f17'));
		$this->f18->setDbValue($rs->fields('f18'));
		$this->f19->setDbValue($rs->fields('f19'));
		$this->f20->setDbValue($rs->fields('f20'));
		$this->f21->setDbValue($rs->fields('f21'));
		$this->f22->setDbValue($rs->fields('f22'));
		$this->f23->setDbValue($rs->fields('f23'));
		$this->f24->setDbValue($rs->fields('f24'));
		$this->f25->setDbValue($rs->fields('f25'));
		$this->f26->setDbValue($rs->fields('f26'));
		$this->f27->setDbValue($rs->fields('f27'));
		$this->f28->setDbValue($rs->fields('f28'));
		$this->f29->setDbValue($rs->fields('f29'));
		$this->f30->setDbValue($rs->fields('f30'));
		$this->f31->setDbValue($rs->fields('f31'));
		$this->f32->setDbValue($rs->fields('f32'));
		$this->f33->setDbValue($rs->fields('f33'));
		$this->f34->setDbValue($rs->fields('f34'));
		$this->f35->setDbValue($rs->fields('f35'));
		$this->f36->setDbValue($rs->fields('f36'));
		$this->f37->setDbValue($rs->fields('f37'));
		$this->f38->setDbValue($rs->fields('f38'));
		$this->f39->setDbValue($rs->fields('f39'));
		$this->f40->setDbValue($rs->fields('f40'));
		$this->f41->setDbValue($rs->fields('f41'));
		$this->f42->setDbValue($rs->fields('f42'));
		$this->f43->setDbValue($rs->fields('f43'));
		$this->f44->setDbValue($rs->fields('f44'));
		$this->f45->setDbValue($rs->fields('f45'));
		$this->f46->setDbValue($rs->fields('f46'));
		$this->f47->setDbValue($rs->fields('f47'));
		$this->f48->setDbValue($rs->fields('f48'));
		$this->f49->setDbValue($rs->fields('f49'));
		$this->f50->setDbValue($rs->fields('f50'));
		$this->f51->setDbValue($rs->fields('f51'));
		$this->f52->setDbValue($rs->fields('f52'));
		$this->f53->setDbValue($rs->fields('f53'));
		$this->f54->setDbValue($rs->fields('f54'));
		$this->f55->setDbValue($rs->fields('f55'));
		$this->f56->setDbValue($rs->fields('f56'));
		$this->f57->setDbValue($rs->fields('f57'));
		$this->f58->setDbValue($rs->fields('f58'));
		$this->f59->setDbValue($rs->fields('f59'));
		$this->f60->setDbValue($rs->fields('f60'));
		$this->f61->setDbValue($rs->fields('f61'));
		$this->f62->setDbValue($rs->fields('f62'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->rm_id->DbValue = $row['rm_id'];
		$this->pegawai_id->DbValue = $row['pegawai_id'];
		$this->f1->DbValue = $row['f1'];
		$this->f2->DbValue = $row['f2'];
		$this->f3->DbValue = $row['f3'];
		$this->f4->DbValue = $row['f4'];
		$this->f5->DbValue = $row['f5'];
		$this->f6->DbValue = $row['f6'];
		$this->f7->DbValue = $row['f7'];
		$this->f8->DbValue = $row['f8'];
		$this->f9->DbValue = $row['f9'];
		$this->f10->DbValue = $row['f10'];
		$this->f11->DbValue = $row['f11'];
		$this->f12->DbValue = $row['f12'];
		$this->f13->DbValue = $row['f13'];
		$this->f14->DbValue = $row['f14'];
		$this->f15->DbValue = $row['f15'];
		$this->f16->DbValue = $row['f16'];
		$this->f17->DbValue = $row['f17'];
		$this->f18->DbValue = $row['f18'];
		$this->f19->DbValue = $row['f19'];
		$this->f20->DbValue = $row['f20'];
		$this->f21->DbValue = $row['f21'];
		$this->f22->DbValue = $row['f22'];
		$this->f23->DbValue = $row['f23'];
		$this->f24->DbValue = $row['f24'];
		$this->f25->DbValue = $row['f25'];
		$this->f26->DbValue = $row['f26'];
		$this->f27->DbValue = $row['f27'];
		$this->f28->DbValue = $row['f28'];
		$this->f29->DbValue = $row['f29'];
		$this->f30->DbValue = $row['f30'];
		$this->f31->DbValue = $row['f31'];
		$this->f32->DbValue = $row['f32'];
		$this->f33->DbValue = $row['f33'];
		$this->f34->DbValue = $row['f34'];
		$this->f35->DbValue = $row['f35'];
		$this->f36->DbValue = $row['f36'];
		$this->f37->DbValue = $row['f37'];
		$this->f38->DbValue = $row['f38'];
		$this->f39->DbValue = $row['f39'];
		$this->f40->DbValue = $row['f40'];
		$this->f41->DbValue = $row['f41'];
		$this->f42->DbValue = $row['f42'];
		$this->f43->DbValue = $row['f43'];
		$this->f44->DbValue = $row['f44'];
		$this->f45->DbValue = $row['f45'];
		$this->f46->DbValue = $row['f46'];
		$this->f47->DbValue = $row['f47'];
		$this->f48->DbValue = $row['f48'];
		$this->f49->DbValue = $row['f49'];
		$this->f50->DbValue = $row['f50'];
		$this->f51->DbValue = $row['f51'];
		$this->f52->DbValue = $row['f52'];
		$this->f53->DbValue = $row['f53'];
		$this->f54->DbValue = $row['f54'];
		$this->f55->DbValue = $row['f55'];
		$this->f56->DbValue = $row['f56'];
		$this->f57->DbValue = $row['f57'];
		$this->f58->DbValue = $row['f58'];
		$this->f59->DbValue = $row['f59'];
		$this->f60->DbValue = $row['f60'];
		$this->f61->DbValue = $row['f61'];
		$this->f62->DbValue = $row['f62'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// rm_id
		// pegawai_id
		// f1
		// f2
		// f3
		// f4
		// f5
		// f6
		// f7
		// f8
		// f9
		// f10
		// f11
		// f12
		// f13
		// f14
		// f15
		// f16
		// f17
		// f18
		// f19
		// f20
		// f21
		// f22
		// f23
		// f24
		// f25
		// f26
		// f27
		// f28
		// f29
		// f30
		// f31
		// f32
		// f33
		// f34
		// f35
		// f36
		// f37
		// f38
		// f39
		// f40
		// f41
		// f42
		// f43
		// f44
		// f45
		// f46
		// f47
		// f48
		// f49
		// f50
		// f51
		// f52
		// f53
		// f54
		// f55
		// f56
		// f57
		// f58
		// f59
		// f60
		// f61
		// f62

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// rm_id
		$this->rm_id->ViewValue = $this->rm_id->CurrentValue;
		$this->rm_id->ViewCustomAttributes = "";

		// pegawai_id
		$this->pegawai_id->ViewValue = $this->pegawai_id->CurrentValue;
		$this->pegawai_id->ViewCustomAttributes = "";

		// f1
		$this->f1->ViewValue = $this->f1->CurrentValue;
		$this->f1->ViewCustomAttributes = "";

		// f2
		$this->f2->ViewValue = $this->f2->CurrentValue;
		$this->f2->ViewCustomAttributes = "";

		// f3
		$this->f3->ViewValue = $this->f3->CurrentValue;
		$this->f3->ViewCustomAttributes = "";

		// f4
		$this->f4->ViewValue = $this->f4->CurrentValue;
		$this->f4->ViewCustomAttributes = "";

		// f5
		$this->f5->ViewValue = $this->f5->CurrentValue;
		$this->f5->ViewCustomAttributes = "";

		// f6
		$this->f6->ViewValue = $this->f6->CurrentValue;
		$this->f6->ViewCustomAttributes = "";

		// f7
		$this->f7->ViewValue = $this->f7->CurrentValue;
		$this->f7->ViewCustomAttributes = "";

		// f8
		$this->f8->ViewValue = $this->f8->CurrentValue;
		$this->f8->ViewCustomAttributes = "";

		// f9
		$this->f9->ViewValue = $this->f9->CurrentValue;
		$this->f9->ViewCustomAttributes = "";

		// f10
		$this->f10->ViewValue = $this->f10->CurrentValue;
		$this->f10->ViewCustomAttributes = "";

		// f11
		$this->f11->ViewValue = $this->f11->CurrentValue;
		$this->f11->ViewCustomAttributes = "";

		// f12
		$this->f12->ViewValue = $this->f12->CurrentValue;
		$this->f12->ViewCustomAttributes = "";

		// f13
		$this->f13->ViewValue = $this->f13->CurrentValue;
		$this->f13->ViewCustomAttributes = "";

		// f14
		$this->f14->ViewValue = $this->f14->CurrentValue;
		$this->f14->ViewCustomAttributes = "";

		// f15
		$this->f15->ViewValue = $this->f15->CurrentValue;
		$this->f15->ViewCustomAttributes = "";

		// f16
		$this->f16->ViewValue = $this->f16->CurrentValue;
		$this->f16->ViewCustomAttributes = "";

		// f17
		$this->f17->ViewValue = $this->f17->CurrentValue;
		$this->f17->ViewCustomAttributes = "";

		// f18
		$this->f18->ViewValue = $this->f18->CurrentValue;
		$this->f18->ViewCustomAttributes = "";

		// f19
		$this->f19->ViewValue = $this->f19->CurrentValue;
		$this->f19->ViewCustomAttributes = "";

		// f20
		$this->f20->ViewValue = $this->f20->CurrentValue;
		$this->f20->ViewCustomAttributes = "";

		// f21
		$this->f21->ViewValue = $this->f21->CurrentValue;
		$this->f21->ViewCustomAttributes = "";

		// f22
		$this->f22->ViewValue = $this->f22->CurrentValue;
		$this->f22->ViewCustomAttributes = "";

		// f23
		$this->f23->ViewValue = $this->f23->CurrentValue;
		$this->f23->ViewCustomAttributes = "";

		// f24
		$this->f24->ViewValue = $this->f24->CurrentValue;
		$this->f24->ViewCustomAttributes = "";

		// f25
		$this->f25->ViewValue = $this->f25->CurrentValue;
		$this->f25->ViewCustomAttributes = "";

		// f26
		$this->f26->ViewValue = $this->f26->CurrentValue;
		$this->f26->ViewCustomAttributes = "";

		// f27
		$this->f27->ViewValue = $this->f27->CurrentValue;
		$this->f27->ViewCustomAttributes = "";

		// f28
		$this->f28->ViewValue = $this->f28->CurrentValue;
		$this->f28->ViewCustomAttributes = "";

		// f29
		$this->f29->ViewValue = $this->f29->CurrentValue;
		$this->f29->ViewCustomAttributes = "";

		// f30
		$this->f30->ViewValue = $this->f30->CurrentValue;
		$this->f30->ViewCustomAttributes = "";

		// f31
		$this->f31->ViewValue = $this->f31->CurrentValue;
		$this->f31->ViewCustomAttributes = "";

		// f32
		$this->f32->ViewValue = $this->f32->CurrentValue;
		$this->f32->ViewValue = ew_FormatDateTime($this->f32->ViewValue, 0);
		$this->f32->ViewCustomAttributes = "";

		// f33
		$this->f33->ViewValue = $this->f33->CurrentValue;
		$this->f33->ViewValue = ew_FormatDateTime($this->f33->ViewValue, 0);
		$this->f33->ViewCustomAttributes = "";

		// f34
		$this->f34->ViewValue = $this->f34->CurrentValue;
		$this->f34->ViewValue = ew_FormatDateTime($this->f34->ViewValue, 0);
		$this->f34->ViewCustomAttributes = "";

		// f35
		$this->f35->ViewValue = $this->f35->CurrentValue;
		$this->f35->ViewValue = ew_FormatDateTime($this->f35->ViewValue, 0);
		$this->f35->ViewCustomAttributes = "";

		// f36
		$this->f36->ViewValue = $this->f36->CurrentValue;
		$this->f36->ViewValue = ew_FormatDateTime($this->f36->ViewValue, 0);
		$this->f36->ViewCustomAttributes = "";

		// f37
		$this->f37->ViewValue = $this->f37->CurrentValue;
		$this->f37->ViewValue = ew_FormatDateTime($this->f37->ViewValue, 0);
		$this->f37->ViewCustomAttributes = "";

		// f38
		$this->f38->ViewValue = $this->f38->CurrentValue;
		$this->f38->ViewValue = ew_FormatDateTime($this->f38->ViewValue, 0);
		$this->f38->ViewCustomAttributes = "";

		// f39
		$this->f39->ViewValue = $this->f39->CurrentValue;
		$this->f39->ViewValue = ew_FormatDateTime($this->f39->ViewValue, 0);
		$this->f39->ViewCustomAttributes = "";

		// f40
		$this->f40->ViewValue = $this->f40->CurrentValue;
		$this->f40->ViewValue = ew_FormatDateTime($this->f40->ViewValue, 0);
		$this->f40->ViewCustomAttributes = "";

		// f41
		$this->f41->ViewValue = $this->f41->CurrentValue;
		$this->f41->ViewValue = ew_FormatDateTime($this->f41->ViewValue, 0);
		$this->f41->ViewCustomAttributes = "";

		// f42
		$this->f42->ViewValue = $this->f42->CurrentValue;
		$this->f42->ViewValue = ew_FormatDateTime($this->f42->ViewValue, 0);
		$this->f42->ViewCustomAttributes = "";

		// f43
		$this->f43->ViewValue = $this->f43->CurrentValue;
		$this->f43->ViewValue = ew_FormatDateTime($this->f43->ViewValue, 0);
		$this->f43->ViewCustomAttributes = "";

		// f44
		$this->f44->ViewValue = $this->f44->CurrentValue;
		$this->f44->ViewValue = ew_FormatDateTime($this->f44->ViewValue, 0);
		$this->f44->ViewCustomAttributes = "";

		// f45
		$this->f45->ViewValue = $this->f45->CurrentValue;
		$this->f45->ViewValue = ew_FormatDateTime($this->f45->ViewValue, 0);
		$this->f45->ViewCustomAttributes = "";

		// f46
		$this->f46->ViewValue = $this->f46->CurrentValue;
		$this->f46->ViewValue = ew_FormatDateTime($this->f46->ViewValue, 0);
		$this->f46->ViewCustomAttributes = "";

		// f47
		$this->f47->ViewValue = $this->f47->CurrentValue;
		$this->f47->ViewValue = ew_FormatDateTime($this->f47->ViewValue, 0);
		$this->f47->ViewCustomAttributes = "";

		// f48
		$this->f48->ViewValue = $this->f48->CurrentValue;
		$this->f48->ViewValue = ew_FormatDateTime($this->f48->ViewValue, 0);
		$this->f48->ViewCustomAttributes = "";

		// f49
		$this->f49->ViewValue = $this->f49->CurrentValue;
		$this->f49->ViewValue = ew_FormatDateTime($this->f49->ViewValue, 0);
		$this->f49->ViewCustomAttributes = "";

		// f50
		$this->f50->ViewValue = $this->f50->CurrentValue;
		$this->f50->ViewValue = ew_FormatDateTime($this->f50->ViewValue, 0);
		$this->f50->ViewCustomAttributes = "";

		// f51
		$this->f51->ViewValue = $this->f51->CurrentValue;
		$this->f51->ViewValue = ew_FormatDateTime($this->f51->ViewValue, 0);
		$this->f51->ViewCustomAttributes = "";

		// f52
		$this->f52->ViewValue = $this->f52->CurrentValue;
		$this->f52->ViewValue = ew_FormatDateTime($this->f52->ViewValue, 0);
		$this->f52->ViewCustomAttributes = "";

		// f53
		$this->f53->ViewValue = $this->f53->CurrentValue;
		$this->f53->ViewValue = ew_FormatDateTime($this->f53->ViewValue, 0);
		$this->f53->ViewCustomAttributes = "";

		// f54
		$this->f54->ViewValue = $this->f54->CurrentValue;
		$this->f54->ViewValue = ew_FormatDateTime($this->f54->ViewValue, 0);
		$this->f54->ViewCustomAttributes = "";

		// f55
		$this->f55->ViewValue = $this->f55->CurrentValue;
		$this->f55->ViewValue = ew_FormatDateTime($this->f55->ViewValue, 0);
		$this->f55->ViewCustomAttributes = "";

		// f56
		$this->f56->ViewValue = $this->f56->CurrentValue;
		$this->f56->ViewValue = ew_FormatDateTime($this->f56->ViewValue, 0);
		$this->f56->ViewCustomAttributes = "";

		// f57
		$this->f57->ViewValue = $this->f57->CurrentValue;
		$this->f57->ViewValue = ew_FormatDateTime($this->f57->ViewValue, 0);
		$this->f57->ViewCustomAttributes = "";

		// f58
		$this->f58->ViewValue = $this->f58->CurrentValue;
		$this->f58->ViewValue = ew_FormatDateTime($this->f58->ViewValue, 0);
		$this->f58->ViewCustomAttributes = "";

		// f59
		$this->f59->ViewValue = $this->f59->CurrentValue;
		$this->f59->ViewValue = ew_FormatDateTime($this->f59->ViewValue, 0);
		$this->f59->ViewCustomAttributes = "";

		// f60
		$this->f60->ViewValue = $this->f60->CurrentValue;
		$this->f60->ViewValue = ew_FormatDateTime($this->f60->ViewValue, 0);
		$this->f60->ViewCustomAttributes = "";

		// f61
		$this->f61->ViewValue = $this->f61->CurrentValue;
		$this->f61->ViewValue = ew_FormatDateTime($this->f61->ViewValue, 0);
		$this->f61->ViewCustomAttributes = "";

		// f62
		$this->f62->ViewValue = $this->f62->CurrentValue;
		$this->f62->ViewValue = ew_FormatDateTime($this->f62->ViewValue, 0);
		$this->f62->ViewCustomAttributes = "";

			// rm_id
			$this->rm_id->LinkCustomAttributes = "";
			$this->rm_id->HrefValue = "";
			$this->rm_id->TooltipValue = "";

			// pegawai_id
			$this->pegawai_id->LinkCustomAttributes = "";
			$this->pegawai_id->HrefValue = "";
			$this->pegawai_id->TooltipValue = "";

			// f1
			$this->f1->LinkCustomAttributes = "";
			$this->f1->HrefValue = "";
			$this->f1->TooltipValue = "";

			// f2
			$this->f2->LinkCustomAttributes = "";
			$this->f2->HrefValue = "";
			$this->f2->TooltipValue = "";

			// f3
			$this->f3->LinkCustomAttributes = "";
			$this->f3->HrefValue = "";
			$this->f3->TooltipValue = "";

			// f4
			$this->f4->LinkCustomAttributes = "";
			$this->f4->HrefValue = "";
			$this->f4->TooltipValue = "";

			// f5
			$this->f5->LinkCustomAttributes = "";
			$this->f5->HrefValue = "";
			$this->f5->TooltipValue = "";

			// f6
			$this->f6->LinkCustomAttributes = "";
			$this->f6->HrefValue = "";
			$this->f6->TooltipValue = "";

			// f7
			$this->f7->LinkCustomAttributes = "";
			$this->f7->HrefValue = "";
			$this->f7->TooltipValue = "";

			// f8
			$this->f8->LinkCustomAttributes = "";
			$this->f8->HrefValue = "";
			$this->f8->TooltipValue = "";

			// f9
			$this->f9->LinkCustomAttributes = "";
			$this->f9->HrefValue = "";
			$this->f9->TooltipValue = "";

			// f10
			$this->f10->LinkCustomAttributes = "";
			$this->f10->HrefValue = "";
			$this->f10->TooltipValue = "";

			// f11
			$this->f11->LinkCustomAttributes = "";
			$this->f11->HrefValue = "";
			$this->f11->TooltipValue = "";

			// f12
			$this->f12->LinkCustomAttributes = "";
			$this->f12->HrefValue = "";
			$this->f12->TooltipValue = "";

			// f13
			$this->f13->LinkCustomAttributes = "";
			$this->f13->HrefValue = "";
			$this->f13->TooltipValue = "";

			// f14
			$this->f14->LinkCustomAttributes = "";
			$this->f14->HrefValue = "";
			$this->f14->TooltipValue = "";

			// f15
			$this->f15->LinkCustomAttributes = "";
			$this->f15->HrefValue = "";
			$this->f15->TooltipValue = "";

			// f16
			$this->f16->LinkCustomAttributes = "";
			$this->f16->HrefValue = "";
			$this->f16->TooltipValue = "";

			// f17
			$this->f17->LinkCustomAttributes = "";
			$this->f17->HrefValue = "";
			$this->f17->TooltipValue = "";

			// f18
			$this->f18->LinkCustomAttributes = "";
			$this->f18->HrefValue = "";
			$this->f18->TooltipValue = "";

			// f19
			$this->f19->LinkCustomAttributes = "";
			$this->f19->HrefValue = "";
			$this->f19->TooltipValue = "";

			// f20
			$this->f20->LinkCustomAttributes = "";
			$this->f20->HrefValue = "";
			$this->f20->TooltipValue = "";

			// f21
			$this->f21->LinkCustomAttributes = "";
			$this->f21->HrefValue = "";
			$this->f21->TooltipValue = "";

			// f22
			$this->f22->LinkCustomAttributes = "";
			$this->f22->HrefValue = "";
			$this->f22->TooltipValue = "";

			// f23
			$this->f23->LinkCustomAttributes = "";
			$this->f23->HrefValue = "";
			$this->f23->TooltipValue = "";

			// f24
			$this->f24->LinkCustomAttributes = "";
			$this->f24->HrefValue = "";
			$this->f24->TooltipValue = "";

			// f25
			$this->f25->LinkCustomAttributes = "";
			$this->f25->HrefValue = "";
			$this->f25->TooltipValue = "";

			// f26
			$this->f26->LinkCustomAttributes = "";
			$this->f26->HrefValue = "";
			$this->f26->TooltipValue = "";

			// f27
			$this->f27->LinkCustomAttributes = "";
			$this->f27->HrefValue = "";
			$this->f27->TooltipValue = "";

			// f28
			$this->f28->LinkCustomAttributes = "";
			$this->f28->HrefValue = "";
			$this->f28->TooltipValue = "";

			// f29
			$this->f29->LinkCustomAttributes = "";
			$this->f29->HrefValue = "";
			$this->f29->TooltipValue = "";

			// f30
			$this->f30->LinkCustomAttributes = "";
			$this->f30->HrefValue = "";
			$this->f30->TooltipValue = "";

			// f31
			$this->f31->LinkCustomAttributes = "";
			$this->f31->HrefValue = "";
			$this->f31->TooltipValue = "";

			// f32
			$this->f32->LinkCustomAttributes = "";
			$this->f32->HrefValue = "";
			$this->f32->TooltipValue = "";

			// f33
			$this->f33->LinkCustomAttributes = "";
			$this->f33->HrefValue = "";
			$this->f33->TooltipValue = "";

			// f34
			$this->f34->LinkCustomAttributes = "";
			$this->f34->HrefValue = "";
			$this->f34->TooltipValue = "";

			// f35
			$this->f35->LinkCustomAttributes = "";
			$this->f35->HrefValue = "";
			$this->f35->TooltipValue = "";

			// f36
			$this->f36->LinkCustomAttributes = "";
			$this->f36->HrefValue = "";
			$this->f36->TooltipValue = "";

			// f37
			$this->f37->LinkCustomAttributes = "";
			$this->f37->HrefValue = "";
			$this->f37->TooltipValue = "";

			// f38
			$this->f38->LinkCustomAttributes = "";
			$this->f38->HrefValue = "";
			$this->f38->TooltipValue = "";

			// f39
			$this->f39->LinkCustomAttributes = "";
			$this->f39->HrefValue = "";
			$this->f39->TooltipValue = "";

			// f40
			$this->f40->LinkCustomAttributes = "";
			$this->f40->HrefValue = "";
			$this->f40->TooltipValue = "";

			// f41
			$this->f41->LinkCustomAttributes = "";
			$this->f41->HrefValue = "";
			$this->f41->TooltipValue = "";

			// f42
			$this->f42->LinkCustomAttributes = "";
			$this->f42->HrefValue = "";
			$this->f42->TooltipValue = "";

			// f43
			$this->f43->LinkCustomAttributes = "";
			$this->f43->HrefValue = "";
			$this->f43->TooltipValue = "";

			// f44
			$this->f44->LinkCustomAttributes = "";
			$this->f44->HrefValue = "";
			$this->f44->TooltipValue = "";

			// f45
			$this->f45->LinkCustomAttributes = "";
			$this->f45->HrefValue = "";
			$this->f45->TooltipValue = "";

			// f46
			$this->f46->LinkCustomAttributes = "";
			$this->f46->HrefValue = "";
			$this->f46->TooltipValue = "";

			// f47
			$this->f47->LinkCustomAttributes = "";
			$this->f47->HrefValue = "";
			$this->f47->TooltipValue = "";

			// f48
			$this->f48->LinkCustomAttributes = "";
			$this->f48->HrefValue = "";
			$this->f48->TooltipValue = "";

			// f49
			$this->f49->LinkCustomAttributes = "";
			$this->f49->HrefValue = "";
			$this->f49->TooltipValue = "";

			// f50
			$this->f50->LinkCustomAttributes = "";
			$this->f50->HrefValue = "";
			$this->f50->TooltipValue = "";

			// f51
			$this->f51->LinkCustomAttributes = "";
			$this->f51->HrefValue = "";
			$this->f51->TooltipValue = "";

			// f52
			$this->f52->LinkCustomAttributes = "";
			$this->f52->HrefValue = "";
			$this->f52->TooltipValue = "";

			// f53
			$this->f53->LinkCustomAttributes = "";
			$this->f53->HrefValue = "";
			$this->f53->TooltipValue = "";

			// f54
			$this->f54->LinkCustomAttributes = "";
			$this->f54->HrefValue = "";
			$this->f54->TooltipValue = "";

			// f55
			$this->f55->LinkCustomAttributes = "";
			$this->f55->HrefValue = "";
			$this->f55->TooltipValue = "";

			// f56
			$this->f56->LinkCustomAttributes = "";
			$this->f56->HrefValue = "";
			$this->f56->TooltipValue = "";

			// f57
			$this->f57->LinkCustomAttributes = "";
			$this->f57->HrefValue = "";
			$this->f57->TooltipValue = "";

			// f58
			$this->f58->LinkCustomAttributes = "";
			$this->f58->HrefValue = "";
			$this->f58->TooltipValue = "";

			// f59
			$this->f59->LinkCustomAttributes = "";
			$this->f59->HrefValue = "";
			$this->f59->TooltipValue = "";

			// f60
			$this->f60->LinkCustomAttributes = "";
			$this->f60->HrefValue = "";
			$this->f60->TooltipValue = "";

			// f61
			$this->f61->LinkCustomAttributes = "";
			$this->f61->HrefValue = "";
			$this->f61->TooltipValue = "";

			// f62
			$this->f62->LinkCustomAttributes = "";
			$this->f62->HrefValue = "";
			$this->f62->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// rm_id
			$this->rm_id->EditAttrs["class"] = "form-control";
			$this->rm_id->EditCustomAttributes = "";
			$this->rm_id->EditValue = $this->rm_id->CurrentValue;
			$this->rm_id->ViewCustomAttributes = "";

			// pegawai_id
			$this->pegawai_id->EditAttrs["class"] = "form-control";
			$this->pegawai_id->EditCustomAttributes = "";
			$this->pegawai_id->EditValue = ew_HtmlEncode($this->pegawai_id->CurrentValue);
			$this->pegawai_id->PlaceHolder = ew_RemoveHtml($this->pegawai_id->FldCaption());

			// f1
			$this->f1->EditAttrs["class"] = "form-control";
			$this->f1->EditCustomAttributes = "";
			$this->f1->EditValue = ew_HtmlEncode($this->f1->CurrentValue);
			$this->f1->PlaceHolder = ew_RemoveHtml($this->f1->FldCaption());

			// f2
			$this->f2->EditAttrs["class"] = "form-control";
			$this->f2->EditCustomAttributes = "";
			$this->f2->EditValue = ew_HtmlEncode($this->f2->CurrentValue);
			$this->f2->PlaceHolder = ew_RemoveHtml($this->f2->FldCaption());

			// f3
			$this->f3->EditAttrs["class"] = "form-control";
			$this->f3->EditCustomAttributes = "";
			$this->f3->EditValue = ew_HtmlEncode($this->f3->CurrentValue);
			$this->f3->PlaceHolder = ew_RemoveHtml($this->f3->FldCaption());

			// f4
			$this->f4->EditAttrs["class"] = "form-control";
			$this->f4->EditCustomAttributes = "";
			$this->f4->EditValue = ew_HtmlEncode($this->f4->CurrentValue);
			$this->f4->PlaceHolder = ew_RemoveHtml($this->f4->FldCaption());

			// f5
			$this->f5->EditAttrs["class"] = "form-control";
			$this->f5->EditCustomAttributes = "";
			$this->f5->EditValue = ew_HtmlEncode($this->f5->CurrentValue);
			$this->f5->PlaceHolder = ew_RemoveHtml($this->f5->FldCaption());

			// f6
			$this->f6->EditAttrs["class"] = "form-control";
			$this->f6->EditCustomAttributes = "";
			$this->f6->EditValue = ew_HtmlEncode($this->f6->CurrentValue);
			$this->f6->PlaceHolder = ew_RemoveHtml($this->f6->FldCaption());

			// f7
			$this->f7->EditAttrs["class"] = "form-control";
			$this->f7->EditCustomAttributes = "";
			$this->f7->EditValue = ew_HtmlEncode($this->f7->CurrentValue);
			$this->f7->PlaceHolder = ew_RemoveHtml($this->f7->FldCaption());

			// f8
			$this->f8->EditAttrs["class"] = "form-control";
			$this->f8->EditCustomAttributes = "";
			$this->f8->EditValue = ew_HtmlEncode($this->f8->CurrentValue);
			$this->f8->PlaceHolder = ew_RemoveHtml($this->f8->FldCaption());

			// f9
			$this->f9->EditAttrs["class"] = "form-control";
			$this->f9->EditCustomAttributes = "";
			$this->f9->EditValue = ew_HtmlEncode($this->f9->CurrentValue);
			$this->f9->PlaceHolder = ew_RemoveHtml($this->f9->FldCaption());

			// f10
			$this->f10->EditAttrs["class"] = "form-control";
			$this->f10->EditCustomAttributes = "";
			$this->f10->EditValue = ew_HtmlEncode($this->f10->CurrentValue);
			$this->f10->PlaceHolder = ew_RemoveHtml($this->f10->FldCaption());

			// f11
			$this->f11->EditAttrs["class"] = "form-control";
			$this->f11->EditCustomAttributes = "";
			$this->f11->EditValue = ew_HtmlEncode($this->f11->CurrentValue);
			$this->f11->PlaceHolder = ew_RemoveHtml($this->f11->FldCaption());

			// f12
			$this->f12->EditAttrs["class"] = "form-control";
			$this->f12->EditCustomAttributes = "";
			$this->f12->EditValue = ew_HtmlEncode($this->f12->CurrentValue);
			$this->f12->PlaceHolder = ew_RemoveHtml($this->f12->FldCaption());

			// f13
			$this->f13->EditAttrs["class"] = "form-control";
			$this->f13->EditCustomAttributes = "";
			$this->f13->EditValue = ew_HtmlEncode($this->f13->CurrentValue);
			$this->f13->PlaceHolder = ew_RemoveHtml($this->f13->FldCaption());

			// f14
			$this->f14->EditAttrs["class"] = "form-control";
			$this->f14->EditCustomAttributes = "";
			$this->f14->EditValue = ew_HtmlEncode($this->f14->CurrentValue);
			$this->f14->PlaceHolder = ew_RemoveHtml($this->f14->FldCaption());

			// f15
			$this->f15->EditAttrs["class"] = "form-control";
			$this->f15->EditCustomAttributes = "";
			$this->f15->EditValue = ew_HtmlEncode($this->f15->CurrentValue);
			$this->f15->PlaceHolder = ew_RemoveHtml($this->f15->FldCaption());

			// f16
			$this->f16->EditAttrs["class"] = "form-control";
			$this->f16->EditCustomAttributes = "";
			$this->f16->EditValue = ew_HtmlEncode($this->f16->CurrentValue);
			$this->f16->PlaceHolder = ew_RemoveHtml($this->f16->FldCaption());

			// f17
			$this->f17->EditAttrs["class"] = "form-control";
			$this->f17->EditCustomAttributes = "";
			$this->f17->EditValue = ew_HtmlEncode($this->f17->CurrentValue);
			$this->f17->PlaceHolder = ew_RemoveHtml($this->f17->FldCaption());

			// f18
			$this->f18->EditAttrs["class"] = "form-control";
			$this->f18->EditCustomAttributes = "";
			$this->f18->EditValue = ew_HtmlEncode($this->f18->CurrentValue);
			$this->f18->PlaceHolder = ew_RemoveHtml($this->f18->FldCaption());

			// f19
			$this->f19->EditAttrs["class"] = "form-control";
			$this->f19->EditCustomAttributes = "";
			$this->f19->EditValue = ew_HtmlEncode($this->f19->CurrentValue);
			$this->f19->PlaceHolder = ew_RemoveHtml($this->f19->FldCaption());

			// f20
			$this->f20->EditAttrs["class"] = "form-control";
			$this->f20->EditCustomAttributes = "";
			$this->f20->EditValue = ew_HtmlEncode($this->f20->CurrentValue);
			$this->f20->PlaceHolder = ew_RemoveHtml($this->f20->FldCaption());

			// f21
			$this->f21->EditAttrs["class"] = "form-control";
			$this->f21->EditCustomAttributes = "";
			$this->f21->EditValue = ew_HtmlEncode($this->f21->CurrentValue);
			$this->f21->PlaceHolder = ew_RemoveHtml($this->f21->FldCaption());

			// f22
			$this->f22->EditAttrs["class"] = "form-control";
			$this->f22->EditCustomAttributes = "";
			$this->f22->EditValue = ew_HtmlEncode($this->f22->CurrentValue);
			$this->f22->PlaceHolder = ew_RemoveHtml($this->f22->FldCaption());

			// f23
			$this->f23->EditAttrs["class"] = "form-control";
			$this->f23->EditCustomAttributes = "";
			$this->f23->EditValue = ew_HtmlEncode($this->f23->CurrentValue);
			$this->f23->PlaceHolder = ew_RemoveHtml($this->f23->FldCaption());

			// f24
			$this->f24->EditAttrs["class"] = "form-control";
			$this->f24->EditCustomAttributes = "";
			$this->f24->EditValue = ew_HtmlEncode($this->f24->CurrentValue);
			$this->f24->PlaceHolder = ew_RemoveHtml($this->f24->FldCaption());

			// f25
			$this->f25->EditAttrs["class"] = "form-control";
			$this->f25->EditCustomAttributes = "";
			$this->f25->EditValue = ew_HtmlEncode($this->f25->CurrentValue);
			$this->f25->PlaceHolder = ew_RemoveHtml($this->f25->FldCaption());

			// f26
			$this->f26->EditAttrs["class"] = "form-control";
			$this->f26->EditCustomAttributes = "";
			$this->f26->EditValue = ew_HtmlEncode($this->f26->CurrentValue);
			$this->f26->PlaceHolder = ew_RemoveHtml($this->f26->FldCaption());

			// f27
			$this->f27->EditAttrs["class"] = "form-control";
			$this->f27->EditCustomAttributes = "";
			$this->f27->EditValue = ew_HtmlEncode($this->f27->CurrentValue);
			$this->f27->PlaceHolder = ew_RemoveHtml($this->f27->FldCaption());

			// f28
			$this->f28->EditAttrs["class"] = "form-control";
			$this->f28->EditCustomAttributes = "";
			$this->f28->EditValue = ew_HtmlEncode($this->f28->CurrentValue);
			$this->f28->PlaceHolder = ew_RemoveHtml($this->f28->FldCaption());

			// f29
			$this->f29->EditAttrs["class"] = "form-control";
			$this->f29->EditCustomAttributes = "";
			$this->f29->EditValue = ew_HtmlEncode($this->f29->CurrentValue);
			$this->f29->PlaceHolder = ew_RemoveHtml($this->f29->FldCaption());

			// f30
			$this->f30->EditAttrs["class"] = "form-control";
			$this->f30->EditCustomAttributes = "";
			$this->f30->EditValue = ew_HtmlEncode($this->f30->CurrentValue);
			$this->f30->PlaceHolder = ew_RemoveHtml($this->f30->FldCaption());

			// f31
			$this->f31->EditAttrs["class"] = "form-control";
			$this->f31->EditCustomAttributes = "";
			$this->f31->EditValue = ew_HtmlEncode($this->f31->CurrentValue);
			$this->f31->PlaceHolder = ew_RemoveHtml($this->f31->FldCaption());

			// f32
			$this->f32->EditAttrs["class"] = "form-control";
			$this->f32->EditCustomAttributes = "";
			$this->f32->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f32->CurrentValue, 8));
			$this->f32->PlaceHolder = ew_RemoveHtml($this->f32->FldCaption());

			// f33
			$this->f33->EditAttrs["class"] = "form-control";
			$this->f33->EditCustomAttributes = "";
			$this->f33->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f33->CurrentValue, 8));
			$this->f33->PlaceHolder = ew_RemoveHtml($this->f33->FldCaption());

			// f34
			$this->f34->EditAttrs["class"] = "form-control";
			$this->f34->EditCustomAttributes = "";
			$this->f34->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f34->CurrentValue, 8));
			$this->f34->PlaceHolder = ew_RemoveHtml($this->f34->FldCaption());

			// f35
			$this->f35->EditAttrs["class"] = "form-control";
			$this->f35->EditCustomAttributes = "";
			$this->f35->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f35->CurrentValue, 8));
			$this->f35->PlaceHolder = ew_RemoveHtml($this->f35->FldCaption());

			// f36
			$this->f36->EditAttrs["class"] = "form-control";
			$this->f36->EditCustomAttributes = "";
			$this->f36->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f36->CurrentValue, 8));
			$this->f36->PlaceHolder = ew_RemoveHtml($this->f36->FldCaption());

			// f37
			$this->f37->EditAttrs["class"] = "form-control";
			$this->f37->EditCustomAttributes = "";
			$this->f37->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f37->CurrentValue, 8));
			$this->f37->PlaceHolder = ew_RemoveHtml($this->f37->FldCaption());

			// f38
			$this->f38->EditAttrs["class"] = "form-control";
			$this->f38->EditCustomAttributes = "";
			$this->f38->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f38->CurrentValue, 8));
			$this->f38->PlaceHolder = ew_RemoveHtml($this->f38->FldCaption());

			// f39
			$this->f39->EditAttrs["class"] = "form-control";
			$this->f39->EditCustomAttributes = "";
			$this->f39->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f39->CurrentValue, 8));
			$this->f39->PlaceHolder = ew_RemoveHtml($this->f39->FldCaption());

			// f40
			$this->f40->EditAttrs["class"] = "form-control";
			$this->f40->EditCustomAttributes = "";
			$this->f40->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f40->CurrentValue, 8));
			$this->f40->PlaceHolder = ew_RemoveHtml($this->f40->FldCaption());

			// f41
			$this->f41->EditAttrs["class"] = "form-control";
			$this->f41->EditCustomAttributes = "";
			$this->f41->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f41->CurrentValue, 8));
			$this->f41->PlaceHolder = ew_RemoveHtml($this->f41->FldCaption());

			// f42
			$this->f42->EditAttrs["class"] = "form-control";
			$this->f42->EditCustomAttributes = "";
			$this->f42->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f42->CurrentValue, 8));
			$this->f42->PlaceHolder = ew_RemoveHtml($this->f42->FldCaption());

			// f43
			$this->f43->EditAttrs["class"] = "form-control";
			$this->f43->EditCustomAttributes = "";
			$this->f43->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f43->CurrentValue, 8));
			$this->f43->PlaceHolder = ew_RemoveHtml($this->f43->FldCaption());

			// f44
			$this->f44->EditAttrs["class"] = "form-control";
			$this->f44->EditCustomAttributes = "";
			$this->f44->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f44->CurrentValue, 8));
			$this->f44->PlaceHolder = ew_RemoveHtml($this->f44->FldCaption());

			// f45
			$this->f45->EditAttrs["class"] = "form-control";
			$this->f45->EditCustomAttributes = "";
			$this->f45->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f45->CurrentValue, 8));
			$this->f45->PlaceHolder = ew_RemoveHtml($this->f45->FldCaption());

			// f46
			$this->f46->EditAttrs["class"] = "form-control";
			$this->f46->EditCustomAttributes = "";
			$this->f46->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f46->CurrentValue, 8));
			$this->f46->PlaceHolder = ew_RemoveHtml($this->f46->FldCaption());

			// f47
			$this->f47->EditAttrs["class"] = "form-control";
			$this->f47->EditCustomAttributes = "";
			$this->f47->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f47->CurrentValue, 8));
			$this->f47->PlaceHolder = ew_RemoveHtml($this->f47->FldCaption());

			// f48
			$this->f48->EditAttrs["class"] = "form-control";
			$this->f48->EditCustomAttributes = "";
			$this->f48->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f48->CurrentValue, 8));
			$this->f48->PlaceHolder = ew_RemoveHtml($this->f48->FldCaption());

			// f49
			$this->f49->EditAttrs["class"] = "form-control";
			$this->f49->EditCustomAttributes = "";
			$this->f49->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f49->CurrentValue, 8));
			$this->f49->PlaceHolder = ew_RemoveHtml($this->f49->FldCaption());

			// f50
			$this->f50->EditAttrs["class"] = "form-control";
			$this->f50->EditCustomAttributes = "";
			$this->f50->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f50->CurrentValue, 8));
			$this->f50->PlaceHolder = ew_RemoveHtml($this->f50->FldCaption());

			// f51
			$this->f51->EditAttrs["class"] = "form-control";
			$this->f51->EditCustomAttributes = "";
			$this->f51->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f51->CurrentValue, 8));
			$this->f51->PlaceHolder = ew_RemoveHtml($this->f51->FldCaption());

			// f52
			$this->f52->EditAttrs["class"] = "form-control";
			$this->f52->EditCustomAttributes = "";
			$this->f52->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f52->CurrentValue, 8));
			$this->f52->PlaceHolder = ew_RemoveHtml($this->f52->FldCaption());

			// f53
			$this->f53->EditAttrs["class"] = "form-control";
			$this->f53->EditCustomAttributes = "";
			$this->f53->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f53->CurrentValue, 8));
			$this->f53->PlaceHolder = ew_RemoveHtml($this->f53->FldCaption());

			// f54
			$this->f54->EditAttrs["class"] = "form-control";
			$this->f54->EditCustomAttributes = "";
			$this->f54->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f54->CurrentValue, 8));
			$this->f54->PlaceHolder = ew_RemoveHtml($this->f54->FldCaption());

			// f55
			$this->f55->EditAttrs["class"] = "form-control";
			$this->f55->EditCustomAttributes = "";
			$this->f55->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f55->CurrentValue, 8));
			$this->f55->PlaceHolder = ew_RemoveHtml($this->f55->FldCaption());

			// f56
			$this->f56->EditAttrs["class"] = "form-control";
			$this->f56->EditCustomAttributes = "";
			$this->f56->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f56->CurrentValue, 8));
			$this->f56->PlaceHolder = ew_RemoveHtml($this->f56->FldCaption());

			// f57
			$this->f57->EditAttrs["class"] = "form-control";
			$this->f57->EditCustomAttributes = "";
			$this->f57->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f57->CurrentValue, 8));
			$this->f57->PlaceHolder = ew_RemoveHtml($this->f57->FldCaption());

			// f58
			$this->f58->EditAttrs["class"] = "form-control";
			$this->f58->EditCustomAttributes = "";
			$this->f58->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f58->CurrentValue, 8));
			$this->f58->PlaceHolder = ew_RemoveHtml($this->f58->FldCaption());

			// f59
			$this->f59->EditAttrs["class"] = "form-control";
			$this->f59->EditCustomAttributes = "";
			$this->f59->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f59->CurrentValue, 8));
			$this->f59->PlaceHolder = ew_RemoveHtml($this->f59->FldCaption());

			// f60
			$this->f60->EditAttrs["class"] = "form-control";
			$this->f60->EditCustomAttributes = "";
			$this->f60->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f60->CurrentValue, 8));
			$this->f60->PlaceHolder = ew_RemoveHtml($this->f60->FldCaption());

			// f61
			$this->f61->EditAttrs["class"] = "form-control";
			$this->f61->EditCustomAttributes = "";
			$this->f61->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f61->CurrentValue, 8));
			$this->f61->PlaceHolder = ew_RemoveHtml($this->f61->FldCaption());

			// f62
			$this->f62->EditAttrs["class"] = "form-control";
			$this->f62->EditCustomAttributes = "";
			$this->f62->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->f62->CurrentValue, 8));
			$this->f62->PlaceHolder = ew_RemoveHtml($this->f62->FldCaption());

			// Edit refer script
			// rm_id

			$this->rm_id->LinkCustomAttributes = "";
			$this->rm_id->HrefValue = "";

			// pegawai_id
			$this->pegawai_id->LinkCustomAttributes = "";
			$this->pegawai_id->HrefValue = "";

			// f1
			$this->f1->LinkCustomAttributes = "";
			$this->f1->HrefValue = "";

			// f2
			$this->f2->LinkCustomAttributes = "";
			$this->f2->HrefValue = "";

			// f3
			$this->f3->LinkCustomAttributes = "";
			$this->f3->HrefValue = "";

			// f4
			$this->f4->LinkCustomAttributes = "";
			$this->f4->HrefValue = "";

			// f5
			$this->f5->LinkCustomAttributes = "";
			$this->f5->HrefValue = "";

			// f6
			$this->f6->LinkCustomAttributes = "";
			$this->f6->HrefValue = "";

			// f7
			$this->f7->LinkCustomAttributes = "";
			$this->f7->HrefValue = "";

			// f8
			$this->f8->LinkCustomAttributes = "";
			$this->f8->HrefValue = "";

			// f9
			$this->f9->LinkCustomAttributes = "";
			$this->f9->HrefValue = "";

			// f10
			$this->f10->LinkCustomAttributes = "";
			$this->f10->HrefValue = "";

			// f11
			$this->f11->LinkCustomAttributes = "";
			$this->f11->HrefValue = "";

			// f12
			$this->f12->LinkCustomAttributes = "";
			$this->f12->HrefValue = "";

			// f13
			$this->f13->LinkCustomAttributes = "";
			$this->f13->HrefValue = "";

			// f14
			$this->f14->LinkCustomAttributes = "";
			$this->f14->HrefValue = "";

			// f15
			$this->f15->LinkCustomAttributes = "";
			$this->f15->HrefValue = "";

			// f16
			$this->f16->LinkCustomAttributes = "";
			$this->f16->HrefValue = "";

			// f17
			$this->f17->LinkCustomAttributes = "";
			$this->f17->HrefValue = "";

			// f18
			$this->f18->LinkCustomAttributes = "";
			$this->f18->HrefValue = "";

			// f19
			$this->f19->LinkCustomAttributes = "";
			$this->f19->HrefValue = "";

			// f20
			$this->f20->LinkCustomAttributes = "";
			$this->f20->HrefValue = "";

			// f21
			$this->f21->LinkCustomAttributes = "";
			$this->f21->HrefValue = "";

			// f22
			$this->f22->LinkCustomAttributes = "";
			$this->f22->HrefValue = "";

			// f23
			$this->f23->LinkCustomAttributes = "";
			$this->f23->HrefValue = "";

			// f24
			$this->f24->LinkCustomAttributes = "";
			$this->f24->HrefValue = "";

			// f25
			$this->f25->LinkCustomAttributes = "";
			$this->f25->HrefValue = "";

			// f26
			$this->f26->LinkCustomAttributes = "";
			$this->f26->HrefValue = "";

			// f27
			$this->f27->LinkCustomAttributes = "";
			$this->f27->HrefValue = "";

			// f28
			$this->f28->LinkCustomAttributes = "";
			$this->f28->HrefValue = "";

			// f29
			$this->f29->LinkCustomAttributes = "";
			$this->f29->HrefValue = "";

			// f30
			$this->f30->LinkCustomAttributes = "";
			$this->f30->HrefValue = "";

			// f31
			$this->f31->LinkCustomAttributes = "";
			$this->f31->HrefValue = "";

			// f32
			$this->f32->LinkCustomAttributes = "";
			$this->f32->HrefValue = "";

			// f33
			$this->f33->LinkCustomAttributes = "";
			$this->f33->HrefValue = "";

			// f34
			$this->f34->LinkCustomAttributes = "";
			$this->f34->HrefValue = "";

			// f35
			$this->f35->LinkCustomAttributes = "";
			$this->f35->HrefValue = "";

			// f36
			$this->f36->LinkCustomAttributes = "";
			$this->f36->HrefValue = "";

			// f37
			$this->f37->LinkCustomAttributes = "";
			$this->f37->HrefValue = "";

			// f38
			$this->f38->LinkCustomAttributes = "";
			$this->f38->HrefValue = "";

			// f39
			$this->f39->LinkCustomAttributes = "";
			$this->f39->HrefValue = "";

			// f40
			$this->f40->LinkCustomAttributes = "";
			$this->f40->HrefValue = "";

			// f41
			$this->f41->LinkCustomAttributes = "";
			$this->f41->HrefValue = "";

			// f42
			$this->f42->LinkCustomAttributes = "";
			$this->f42->HrefValue = "";

			// f43
			$this->f43->LinkCustomAttributes = "";
			$this->f43->HrefValue = "";

			// f44
			$this->f44->LinkCustomAttributes = "";
			$this->f44->HrefValue = "";

			// f45
			$this->f45->LinkCustomAttributes = "";
			$this->f45->HrefValue = "";

			// f46
			$this->f46->LinkCustomAttributes = "";
			$this->f46->HrefValue = "";

			// f47
			$this->f47->LinkCustomAttributes = "";
			$this->f47->HrefValue = "";

			// f48
			$this->f48->LinkCustomAttributes = "";
			$this->f48->HrefValue = "";

			// f49
			$this->f49->LinkCustomAttributes = "";
			$this->f49->HrefValue = "";

			// f50
			$this->f50->LinkCustomAttributes = "";
			$this->f50->HrefValue = "";

			// f51
			$this->f51->LinkCustomAttributes = "";
			$this->f51->HrefValue = "";

			// f52
			$this->f52->LinkCustomAttributes = "";
			$this->f52->HrefValue = "";

			// f53
			$this->f53->LinkCustomAttributes = "";
			$this->f53->HrefValue = "";

			// f54
			$this->f54->LinkCustomAttributes = "";
			$this->f54->HrefValue = "";

			// f55
			$this->f55->LinkCustomAttributes = "";
			$this->f55->HrefValue = "";

			// f56
			$this->f56->LinkCustomAttributes = "";
			$this->f56->HrefValue = "";

			// f57
			$this->f57->LinkCustomAttributes = "";
			$this->f57->HrefValue = "";

			// f58
			$this->f58->LinkCustomAttributes = "";
			$this->f58->HrefValue = "";

			// f59
			$this->f59->LinkCustomAttributes = "";
			$this->f59->HrefValue = "";

			// f60
			$this->f60->LinkCustomAttributes = "";
			$this->f60->HrefValue = "";

			// f61
			$this->f61->LinkCustomAttributes = "";
			$this->f61->HrefValue = "";

			// f62
			$this->f62->LinkCustomAttributes = "";
			$this->f62->HrefValue = "";
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
		if (!$this->f1->FldIsDetailKey && !is_null($this->f1->FormValue) && $this->f1->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f1->FldCaption(), $this->f1->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f1->FormValue)) {
			ew_AddMessage($gsFormError, $this->f1->FldErrMsg());
		}
		if (!$this->f2->FldIsDetailKey && !is_null($this->f2->FormValue) && $this->f2->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f2->FldCaption(), $this->f2->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f2->FormValue)) {
			ew_AddMessage($gsFormError, $this->f2->FldErrMsg());
		}
		if (!$this->f3->FldIsDetailKey && !is_null($this->f3->FormValue) && $this->f3->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f3->FldCaption(), $this->f3->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f3->FormValue)) {
			ew_AddMessage($gsFormError, $this->f3->FldErrMsg());
		}
		if (!$this->f4->FldIsDetailKey && !is_null($this->f4->FormValue) && $this->f4->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f4->FldCaption(), $this->f4->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f4->FormValue)) {
			ew_AddMessage($gsFormError, $this->f4->FldErrMsg());
		}
		if (!$this->f5->FldIsDetailKey && !is_null($this->f5->FormValue) && $this->f5->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f5->FldCaption(), $this->f5->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f5->FormValue)) {
			ew_AddMessage($gsFormError, $this->f5->FldErrMsg());
		}
		if (!$this->f6->FldIsDetailKey && !is_null($this->f6->FormValue) && $this->f6->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f6->FldCaption(), $this->f6->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f6->FormValue)) {
			ew_AddMessage($gsFormError, $this->f6->FldErrMsg());
		}
		if (!$this->f7->FldIsDetailKey && !is_null($this->f7->FormValue) && $this->f7->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f7->FldCaption(), $this->f7->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f7->FormValue)) {
			ew_AddMessage($gsFormError, $this->f7->FldErrMsg());
		}
		if (!$this->f8->FldIsDetailKey && !is_null($this->f8->FormValue) && $this->f8->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f8->FldCaption(), $this->f8->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f8->FormValue)) {
			ew_AddMessage($gsFormError, $this->f8->FldErrMsg());
		}
		if (!$this->f9->FldIsDetailKey && !is_null($this->f9->FormValue) && $this->f9->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f9->FldCaption(), $this->f9->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f9->FormValue)) {
			ew_AddMessage($gsFormError, $this->f9->FldErrMsg());
		}
		if (!$this->f10->FldIsDetailKey && !is_null($this->f10->FormValue) && $this->f10->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f10->FldCaption(), $this->f10->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f10->FormValue)) {
			ew_AddMessage($gsFormError, $this->f10->FldErrMsg());
		}
		if (!$this->f11->FldIsDetailKey && !is_null($this->f11->FormValue) && $this->f11->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f11->FldCaption(), $this->f11->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f11->FormValue)) {
			ew_AddMessage($gsFormError, $this->f11->FldErrMsg());
		}
		if (!$this->f12->FldIsDetailKey && !is_null($this->f12->FormValue) && $this->f12->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f12->FldCaption(), $this->f12->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f12->FormValue)) {
			ew_AddMessage($gsFormError, $this->f12->FldErrMsg());
		}
		if (!$this->f13->FldIsDetailKey && !is_null($this->f13->FormValue) && $this->f13->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f13->FldCaption(), $this->f13->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f13->FormValue)) {
			ew_AddMessage($gsFormError, $this->f13->FldErrMsg());
		}
		if (!$this->f14->FldIsDetailKey && !is_null($this->f14->FormValue) && $this->f14->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f14->FldCaption(), $this->f14->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f14->FormValue)) {
			ew_AddMessage($gsFormError, $this->f14->FldErrMsg());
		}
		if (!$this->f15->FldIsDetailKey && !is_null($this->f15->FormValue) && $this->f15->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f15->FldCaption(), $this->f15->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f15->FormValue)) {
			ew_AddMessage($gsFormError, $this->f15->FldErrMsg());
		}
		if (!$this->f16->FldIsDetailKey && !is_null($this->f16->FormValue) && $this->f16->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f16->FldCaption(), $this->f16->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f16->FormValue)) {
			ew_AddMessage($gsFormError, $this->f16->FldErrMsg());
		}
		if (!$this->f17->FldIsDetailKey && !is_null($this->f17->FormValue) && $this->f17->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f17->FldCaption(), $this->f17->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f17->FormValue)) {
			ew_AddMessage($gsFormError, $this->f17->FldErrMsg());
		}
		if (!$this->f18->FldIsDetailKey && !is_null($this->f18->FormValue) && $this->f18->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f18->FldCaption(), $this->f18->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f18->FormValue)) {
			ew_AddMessage($gsFormError, $this->f18->FldErrMsg());
		}
		if (!$this->f19->FldIsDetailKey && !is_null($this->f19->FormValue) && $this->f19->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f19->FldCaption(), $this->f19->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f19->FormValue)) {
			ew_AddMessage($gsFormError, $this->f19->FldErrMsg());
		}
		if (!$this->f20->FldIsDetailKey && !is_null($this->f20->FormValue) && $this->f20->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f20->FldCaption(), $this->f20->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f20->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20->FldErrMsg());
		}
		if (!$this->f21->FldIsDetailKey && !is_null($this->f21->FormValue) && $this->f21->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f21->FldCaption(), $this->f21->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f21->FormValue)) {
			ew_AddMessage($gsFormError, $this->f21->FldErrMsg());
		}
		if (!$this->f22->FldIsDetailKey && !is_null($this->f22->FormValue) && $this->f22->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f22->FldCaption(), $this->f22->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f22->FormValue)) {
			ew_AddMessage($gsFormError, $this->f22->FldErrMsg());
		}
		if (!$this->f23->FldIsDetailKey && !is_null($this->f23->FormValue) && $this->f23->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f23->FldCaption(), $this->f23->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f23->FormValue)) {
			ew_AddMessage($gsFormError, $this->f23->FldErrMsg());
		}
		if (!$this->f24->FldIsDetailKey && !is_null($this->f24->FormValue) && $this->f24->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f24->FldCaption(), $this->f24->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f24->FormValue)) {
			ew_AddMessage($gsFormError, $this->f24->FldErrMsg());
		}
		if (!$this->f25->FldIsDetailKey && !is_null($this->f25->FormValue) && $this->f25->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f25->FldCaption(), $this->f25->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f25->FormValue)) {
			ew_AddMessage($gsFormError, $this->f25->FldErrMsg());
		}
		if (!$this->f26->FldIsDetailKey && !is_null($this->f26->FormValue) && $this->f26->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f26->FldCaption(), $this->f26->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f26->FormValue)) {
			ew_AddMessage($gsFormError, $this->f26->FldErrMsg());
		}
		if (!$this->f27->FldIsDetailKey && !is_null($this->f27->FormValue) && $this->f27->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f27->FldCaption(), $this->f27->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f27->FormValue)) {
			ew_AddMessage($gsFormError, $this->f27->FldErrMsg());
		}
		if (!$this->f28->FldIsDetailKey && !is_null($this->f28->FormValue) && $this->f28->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f28->FldCaption(), $this->f28->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f28->FormValue)) {
			ew_AddMessage($gsFormError, $this->f28->FldErrMsg());
		}
		if (!$this->f29->FldIsDetailKey && !is_null($this->f29->FormValue) && $this->f29->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f29->FldCaption(), $this->f29->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f29->FormValue)) {
			ew_AddMessage($gsFormError, $this->f29->FldErrMsg());
		}
		if (!$this->f30->FldIsDetailKey && !is_null($this->f30->FormValue) && $this->f30->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f30->FldCaption(), $this->f30->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f30->FormValue)) {
			ew_AddMessage($gsFormError, $this->f30->FldErrMsg());
		}
		if (!$this->f31->FldIsDetailKey && !is_null($this->f31->FormValue) && $this->f31->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f31->FldCaption(), $this->f31->ReqErrMsg));
		}
		if (!ew_CheckTime($this->f31->FormValue)) {
			ew_AddMessage($gsFormError, $this->f31->FldErrMsg());
		}
		if (!$this->f32->FldIsDetailKey && !is_null($this->f32->FormValue) && $this->f32->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f32->FldCaption(), $this->f32->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f32->FormValue)) {
			ew_AddMessage($gsFormError, $this->f32->FldErrMsg());
		}
		if (!$this->f33->FldIsDetailKey && !is_null($this->f33->FormValue) && $this->f33->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f33->FldCaption(), $this->f33->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f33->FormValue)) {
			ew_AddMessage($gsFormError, $this->f33->FldErrMsg());
		}
		if (!$this->f34->FldIsDetailKey && !is_null($this->f34->FormValue) && $this->f34->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f34->FldCaption(), $this->f34->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f34->FormValue)) {
			ew_AddMessage($gsFormError, $this->f34->FldErrMsg());
		}
		if (!$this->f35->FldIsDetailKey && !is_null($this->f35->FormValue) && $this->f35->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f35->FldCaption(), $this->f35->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f35->FormValue)) {
			ew_AddMessage($gsFormError, $this->f35->FldErrMsg());
		}
		if (!$this->f36->FldIsDetailKey && !is_null($this->f36->FormValue) && $this->f36->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f36->FldCaption(), $this->f36->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f36->FormValue)) {
			ew_AddMessage($gsFormError, $this->f36->FldErrMsg());
		}
		if (!$this->f37->FldIsDetailKey && !is_null($this->f37->FormValue) && $this->f37->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f37->FldCaption(), $this->f37->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f37->FormValue)) {
			ew_AddMessage($gsFormError, $this->f37->FldErrMsg());
		}
		if (!$this->f38->FldIsDetailKey && !is_null($this->f38->FormValue) && $this->f38->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f38->FldCaption(), $this->f38->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f38->FormValue)) {
			ew_AddMessage($gsFormError, $this->f38->FldErrMsg());
		}
		if (!$this->f39->FldIsDetailKey && !is_null($this->f39->FormValue) && $this->f39->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f39->FldCaption(), $this->f39->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f39->FormValue)) {
			ew_AddMessage($gsFormError, $this->f39->FldErrMsg());
		}
		if (!$this->f40->FldIsDetailKey && !is_null($this->f40->FormValue) && $this->f40->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f40->FldCaption(), $this->f40->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f40->FormValue)) {
			ew_AddMessage($gsFormError, $this->f40->FldErrMsg());
		}
		if (!$this->f41->FldIsDetailKey && !is_null($this->f41->FormValue) && $this->f41->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f41->FldCaption(), $this->f41->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f41->FormValue)) {
			ew_AddMessage($gsFormError, $this->f41->FldErrMsg());
		}
		if (!$this->f42->FldIsDetailKey && !is_null($this->f42->FormValue) && $this->f42->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f42->FldCaption(), $this->f42->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f42->FormValue)) {
			ew_AddMessage($gsFormError, $this->f42->FldErrMsg());
		}
		if (!$this->f43->FldIsDetailKey && !is_null($this->f43->FormValue) && $this->f43->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f43->FldCaption(), $this->f43->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f43->FormValue)) {
			ew_AddMessage($gsFormError, $this->f43->FldErrMsg());
		}
		if (!$this->f44->FldIsDetailKey && !is_null($this->f44->FormValue) && $this->f44->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f44->FldCaption(), $this->f44->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f44->FormValue)) {
			ew_AddMessage($gsFormError, $this->f44->FldErrMsg());
		}
		if (!$this->f45->FldIsDetailKey && !is_null($this->f45->FormValue) && $this->f45->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f45->FldCaption(), $this->f45->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f45->FormValue)) {
			ew_AddMessage($gsFormError, $this->f45->FldErrMsg());
		}
		if (!$this->f46->FldIsDetailKey && !is_null($this->f46->FormValue) && $this->f46->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f46->FldCaption(), $this->f46->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f46->FormValue)) {
			ew_AddMessage($gsFormError, $this->f46->FldErrMsg());
		}
		if (!$this->f47->FldIsDetailKey && !is_null($this->f47->FormValue) && $this->f47->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f47->FldCaption(), $this->f47->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f47->FormValue)) {
			ew_AddMessage($gsFormError, $this->f47->FldErrMsg());
		}
		if (!$this->f48->FldIsDetailKey && !is_null($this->f48->FormValue) && $this->f48->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f48->FldCaption(), $this->f48->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f48->FormValue)) {
			ew_AddMessage($gsFormError, $this->f48->FldErrMsg());
		}
		if (!$this->f49->FldIsDetailKey && !is_null($this->f49->FormValue) && $this->f49->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f49->FldCaption(), $this->f49->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f49->FormValue)) {
			ew_AddMessage($gsFormError, $this->f49->FldErrMsg());
		}
		if (!$this->f50->FldIsDetailKey && !is_null($this->f50->FormValue) && $this->f50->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f50->FldCaption(), $this->f50->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f50->FormValue)) {
			ew_AddMessage($gsFormError, $this->f50->FldErrMsg());
		}
		if (!$this->f51->FldIsDetailKey && !is_null($this->f51->FormValue) && $this->f51->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f51->FldCaption(), $this->f51->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f51->FormValue)) {
			ew_AddMessage($gsFormError, $this->f51->FldErrMsg());
		}
		if (!$this->f52->FldIsDetailKey && !is_null($this->f52->FormValue) && $this->f52->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f52->FldCaption(), $this->f52->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f52->FormValue)) {
			ew_AddMessage($gsFormError, $this->f52->FldErrMsg());
		}
		if (!$this->f53->FldIsDetailKey && !is_null($this->f53->FormValue) && $this->f53->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f53->FldCaption(), $this->f53->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f53->FormValue)) {
			ew_AddMessage($gsFormError, $this->f53->FldErrMsg());
		}
		if (!$this->f54->FldIsDetailKey && !is_null($this->f54->FormValue) && $this->f54->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f54->FldCaption(), $this->f54->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f54->FormValue)) {
			ew_AddMessage($gsFormError, $this->f54->FldErrMsg());
		}
		if (!$this->f55->FldIsDetailKey && !is_null($this->f55->FormValue) && $this->f55->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f55->FldCaption(), $this->f55->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f55->FormValue)) {
			ew_AddMessage($gsFormError, $this->f55->FldErrMsg());
		}
		if (!$this->f56->FldIsDetailKey && !is_null($this->f56->FormValue) && $this->f56->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f56->FldCaption(), $this->f56->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f56->FormValue)) {
			ew_AddMessage($gsFormError, $this->f56->FldErrMsg());
		}
		if (!$this->f57->FldIsDetailKey && !is_null($this->f57->FormValue) && $this->f57->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f57->FldCaption(), $this->f57->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f57->FormValue)) {
			ew_AddMessage($gsFormError, $this->f57->FldErrMsg());
		}
		if (!$this->f58->FldIsDetailKey && !is_null($this->f58->FormValue) && $this->f58->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f58->FldCaption(), $this->f58->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f58->FormValue)) {
			ew_AddMessage($gsFormError, $this->f58->FldErrMsg());
		}
		if (!$this->f59->FldIsDetailKey && !is_null($this->f59->FormValue) && $this->f59->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f59->FldCaption(), $this->f59->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f59->FormValue)) {
			ew_AddMessage($gsFormError, $this->f59->FldErrMsg());
		}
		if (!$this->f60->FldIsDetailKey && !is_null($this->f60->FormValue) && $this->f60->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f60->FldCaption(), $this->f60->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f60->FormValue)) {
			ew_AddMessage($gsFormError, $this->f60->FldErrMsg());
		}
		if (!$this->f61->FldIsDetailKey && !is_null($this->f61->FormValue) && $this->f61->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f61->FldCaption(), $this->f61->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f61->FormValue)) {
			ew_AddMessage($gsFormError, $this->f61->FldErrMsg());
		}
		if (!$this->f62->FldIsDetailKey && !is_null($this->f62->FormValue) && $this->f62->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f62->FldCaption(), $this->f62->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->f62->FormValue)) {
			ew_AddMessage($gsFormError, $this->f62->FldErrMsg());
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

	// Update record based on key values
	function EditRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$conn = &$this->Connection();
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// pegawai_id
			$this->pegawai_id->SetDbValueDef($rsnew, $this->pegawai_id->CurrentValue, 0, $this->pegawai_id->ReadOnly);

			// f1
			$this->f1->SetDbValueDef($rsnew, $this->f1->CurrentValue, ew_CurrentDate(), $this->f1->ReadOnly);

			// f2
			$this->f2->SetDbValueDef($rsnew, $this->f2->CurrentValue, ew_CurrentDate(), $this->f2->ReadOnly);

			// f3
			$this->f3->SetDbValueDef($rsnew, $this->f3->CurrentValue, ew_CurrentDate(), $this->f3->ReadOnly);

			// f4
			$this->f4->SetDbValueDef($rsnew, $this->f4->CurrentValue, ew_CurrentDate(), $this->f4->ReadOnly);

			// f5
			$this->f5->SetDbValueDef($rsnew, $this->f5->CurrentValue, ew_CurrentDate(), $this->f5->ReadOnly);

			// f6
			$this->f6->SetDbValueDef($rsnew, $this->f6->CurrentValue, ew_CurrentDate(), $this->f6->ReadOnly);

			// f7
			$this->f7->SetDbValueDef($rsnew, $this->f7->CurrentValue, ew_CurrentDate(), $this->f7->ReadOnly);

			// f8
			$this->f8->SetDbValueDef($rsnew, $this->f8->CurrentValue, ew_CurrentDate(), $this->f8->ReadOnly);

			// f9
			$this->f9->SetDbValueDef($rsnew, $this->f9->CurrentValue, ew_CurrentDate(), $this->f9->ReadOnly);

			// f10
			$this->f10->SetDbValueDef($rsnew, $this->f10->CurrentValue, ew_CurrentDate(), $this->f10->ReadOnly);

			// f11
			$this->f11->SetDbValueDef($rsnew, $this->f11->CurrentValue, ew_CurrentDate(), $this->f11->ReadOnly);

			// f12
			$this->f12->SetDbValueDef($rsnew, $this->f12->CurrentValue, ew_CurrentDate(), $this->f12->ReadOnly);

			// f13
			$this->f13->SetDbValueDef($rsnew, $this->f13->CurrentValue, ew_CurrentDate(), $this->f13->ReadOnly);

			// f14
			$this->f14->SetDbValueDef($rsnew, $this->f14->CurrentValue, ew_CurrentDate(), $this->f14->ReadOnly);

			// f15
			$this->f15->SetDbValueDef($rsnew, $this->f15->CurrentValue, ew_CurrentDate(), $this->f15->ReadOnly);

			// f16
			$this->f16->SetDbValueDef($rsnew, $this->f16->CurrentValue, ew_CurrentDate(), $this->f16->ReadOnly);

			// f17
			$this->f17->SetDbValueDef($rsnew, $this->f17->CurrentValue, ew_CurrentDate(), $this->f17->ReadOnly);

			// f18
			$this->f18->SetDbValueDef($rsnew, $this->f18->CurrentValue, ew_CurrentDate(), $this->f18->ReadOnly);

			// f19
			$this->f19->SetDbValueDef($rsnew, $this->f19->CurrentValue, ew_CurrentDate(), $this->f19->ReadOnly);

			// f20
			$this->f20->SetDbValueDef($rsnew, $this->f20->CurrentValue, ew_CurrentDate(), $this->f20->ReadOnly);

			// f21
			$this->f21->SetDbValueDef($rsnew, $this->f21->CurrentValue, ew_CurrentDate(), $this->f21->ReadOnly);

			// f22
			$this->f22->SetDbValueDef($rsnew, $this->f22->CurrentValue, ew_CurrentDate(), $this->f22->ReadOnly);

			// f23
			$this->f23->SetDbValueDef($rsnew, $this->f23->CurrentValue, ew_CurrentDate(), $this->f23->ReadOnly);

			// f24
			$this->f24->SetDbValueDef($rsnew, $this->f24->CurrentValue, ew_CurrentDate(), $this->f24->ReadOnly);

			// f25
			$this->f25->SetDbValueDef($rsnew, $this->f25->CurrentValue, ew_CurrentDate(), $this->f25->ReadOnly);

			// f26
			$this->f26->SetDbValueDef($rsnew, $this->f26->CurrentValue, ew_CurrentDate(), $this->f26->ReadOnly);

			// f27
			$this->f27->SetDbValueDef($rsnew, $this->f27->CurrentValue, ew_CurrentDate(), $this->f27->ReadOnly);

			// f28
			$this->f28->SetDbValueDef($rsnew, $this->f28->CurrentValue, ew_CurrentDate(), $this->f28->ReadOnly);

			// f29
			$this->f29->SetDbValueDef($rsnew, $this->f29->CurrentValue, ew_CurrentDate(), $this->f29->ReadOnly);

			// f30
			$this->f30->SetDbValueDef($rsnew, $this->f30->CurrentValue, ew_CurrentDate(), $this->f30->ReadOnly);

			// f31
			$this->f31->SetDbValueDef($rsnew, $this->f31->CurrentValue, ew_CurrentDate(), $this->f31->ReadOnly);

			// f32
			$this->f32->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f32->CurrentValue, 0), ew_CurrentDate(), $this->f32->ReadOnly);

			// f33
			$this->f33->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f33->CurrentValue, 0), ew_CurrentDate(), $this->f33->ReadOnly);

			// f34
			$this->f34->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f34->CurrentValue, 0), ew_CurrentDate(), $this->f34->ReadOnly);

			// f35
			$this->f35->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f35->CurrentValue, 0), ew_CurrentDate(), $this->f35->ReadOnly);

			// f36
			$this->f36->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f36->CurrentValue, 0), ew_CurrentDate(), $this->f36->ReadOnly);

			// f37
			$this->f37->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f37->CurrentValue, 0), ew_CurrentDate(), $this->f37->ReadOnly);

			// f38
			$this->f38->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f38->CurrentValue, 0), ew_CurrentDate(), $this->f38->ReadOnly);

			// f39
			$this->f39->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f39->CurrentValue, 0), ew_CurrentDate(), $this->f39->ReadOnly);

			// f40
			$this->f40->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f40->CurrentValue, 0), ew_CurrentDate(), $this->f40->ReadOnly);

			// f41
			$this->f41->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f41->CurrentValue, 0), ew_CurrentDate(), $this->f41->ReadOnly);

			// f42
			$this->f42->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f42->CurrentValue, 0), ew_CurrentDate(), $this->f42->ReadOnly);

			// f43
			$this->f43->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f43->CurrentValue, 0), ew_CurrentDate(), $this->f43->ReadOnly);

			// f44
			$this->f44->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f44->CurrentValue, 0), ew_CurrentDate(), $this->f44->ReadOnly);

			// f45
			$this->f45->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f45->CurrentValue, 0), ew_CurrentDate(), $this->f45->ReadOnly);

			// f46
			$this->f46->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f46->CurrentValue, 0), ew_CurrentDate(), $this->f46->ReadOnly);

			// f47
			$this->f47->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f47->CurrentValue, 0), ew_CurrentDate(), $this->f47->ReadOnly);

			// f48
			$this->f48->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f48->CurrentValue, 0), ew_CurrentDate(), $this->f48->ReadOnly);

			// f49
			$this->f49->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f49->CurrentValue, 0), ew_CurrentDate(), $this->f49->ReadOnly);

			// f50
			$this->f50->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f50->CurrentValue, 0), ew_CurrentDate(), $this->f50->ReadOnly);

			// f51
			$this->f51->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f51->CurrentValue, 0), ew_CurrentDate(), $this->f51->ReadOnly);

			// f52
			$this->f52->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f52->CurrentValue, 0), ew_CurrentDate(), $this->f52->ReadOnly);

			// f53
			$this->f53->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f53->CurrentValue, 0), ew_CurrentDate(), $this->f53->ReadOnly);

			// f54
			$this->f54->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f54->CurrentValue, 0), ew_CurrentDate(), $this->f54->ReadOnly);

			// f55
			$this->f55->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f55->CurrentValue, 0), ew_CurrentDate(), $this->f55->ReadOnly);

			// f56
			$this->f56->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f56->CurrentValue, 0), ew_CurrentDate(), $this->f56->ReadOnly);

			// f57
			$this->f57->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f57->CurrentValue, 0), ew_CurrentDate(), $this->f57->ReadOnly);

			// f58
			$this->f58->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f58->CurrentValue, 0), ew_CurrentDate(), $this->f58->ReadOnly);

			// f59
			$this->f59->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f59->CurrentValue, 0), ew_CurrentDate(), $this->f59->ReadOnly);

			// f60
			$this->f60->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f60->CurrentValue, 0), ew_CurrentDate(), $this->f60->ReadOnly);

			// f61
			$this->f61->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f61->CurrentValue, 0), ew_CurrentDate(), $this->f61->ReadOnly);

			// f62
			$this->f62->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->f62->CurrentValue, 0), ew_CurrentDate(), $this->f62->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $this->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				if (count($rsnew) > 0)
					$EditRow = $this->Update($rsnew, "", $rsold);
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($EditRow) {
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("rekon_masterlist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
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
if (!isset($rekon_master_edit)) $rekon_master_edit = new crekon_master_edit();

// Page init
$rekon_master_edit->Page_Init();

// Page main
$rekon_master_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rekon_master_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = frekon_masteredit = new ew_Form("frekon_masteredit", "edit");

// Validate form
frekon_masteredit.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->pegawai_id->FldCaption(), $rekon_master->pegawai_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_pegawai_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->pegawai_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f1");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f1->FldCaption(), $rekon_master->f1->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f1");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f1->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f2");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f2->FldCaption(), $rekon_master->f2->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f2");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f2->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f3");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f3->FldCaption(), $rekon_master->f3->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f3");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f3->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f4");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f4->FldCaption(), $rekon_master->f4->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f4");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f4->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f5");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f5->FldCaption(), $rekon_master->f5->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f5");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f5->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f6");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f6->FldCaption(), $rekon_master->f6->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f6");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f6->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f7");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f7->FldCaption(), $rekon_master->f7->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f7");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f7->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f8");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f8->FldCaption(), $rekon_master->f8->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f8");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f8->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f9");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f9->FldCaption(), $rekon_master->f9->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f9");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f9->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f10");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f10->FldCaption(), $rekon_master->f10->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f10");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f10->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f11");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f11->FldCaption(), $rekon_master->f11->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f11");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f11->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f12");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f12->FldCaption(), $rekon_master->f12->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f12");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f12->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f13");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f13->FldCaption(), $rekon_master->f13->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f13");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f13->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f14");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f14->FldCaption(), $rekon_master->f14->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f14");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f14->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f15");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f15->FldCaption(), $rekon_master->f15->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f15");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f15->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f16");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f16->FldCaption(), $rekon_master->f16->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f16");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f16->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f17");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f17->FldCaption(), $rekon_master->f17->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f17");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f17->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f18");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f18->FldCaption(), $rekon_master->f18->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f18");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f18->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f19");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f19->FldCaption(), $rekon_master->f19->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f19");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f19->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f20->FldCaption(), $rekon_master->f20->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f20");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f20->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f21");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f21->FldCaption(), $rekon_master->f21->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f21");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f21->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f22");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f22->FldCaption(), $rekon_master->f22->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f22");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f22->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f23");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f23->FldCaption(), $rekon_master->f23->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f23");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f23->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f24");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f24->FldCaption(), $rekon_master->f24->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f24");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f24->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f25");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f25->FldCaption(), $rekon_master->f25->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f25");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f25->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f26");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f26->FldCaption(), $rekon_master->f26->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f26");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f26->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f27");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f27->FldCaption(), $rekon_master->f27->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f27");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f27->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f28");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f28->FldCaption(), $rekon_master->f28->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f28");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f28->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f29");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f29->FldCaption(), $rekon_master->f29->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f29");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f29->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f30");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f30->FldCaption(), $rekon_master->f30->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f30");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f30->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f31");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f31->FldCaption(), $rekon_master->f31->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f31");
			if (elm && !ew_CheckTime(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f31->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f32");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f32->FldCaption(), $rekon_master->f32->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f32");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f32->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f33");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f33->FldCaption(), $rekon_master->f33->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f33");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f33->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f34");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f34->FldCaption(), $rekon_master->f34->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f34");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f34->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f35");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f35->FldCaption(), $rekon_master->f35->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f35");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f35->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f36");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f36->FldCaption(), $rekon_master->f36->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f36");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f36->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f37");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f37->FldCaption(), $rekon_master->f37->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f37");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f37->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f38");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f38->FldCaption(), $rekon_master->f38->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f38");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f38->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f39");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f39->FldCaption(), $rekon_master->f39->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f39");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f39->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f40");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f40->FldCaption(), $rekon_master->f40->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f40");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f40->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f41");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f41->FldCaption(), $rekon_master->f41->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f41");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f41->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f42");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f42->FldCaption(), $rekon_master->f42->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f42");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f42->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f43");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f43->FldCaption(), $rekon_master->f43->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f43");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f43->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f44");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f44->FldCaption(), $rekon_master->f44->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f44");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f44->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f45");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f45->FldCaption(), $rekon_master->f45->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f45");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f45->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f46");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f46->FldCaption(), $rekon_master->f46->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f46");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f46->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f47");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f47->FldCaption(), $rekon_master->f47->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f47");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f47->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f48");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f48->FldCaption(), $rekon_master->f48->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f48");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f48->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f49");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f49->FldCaption(), $rekon_master->f49->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f49");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f49->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f50");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f50->FldCaption(), $rekon_master->f50->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f50");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f50->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f51");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f51->FldCaption(), $rekon_master->f51->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f51");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f51->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f52");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f52->FldCaption(), $rekon_master->f52->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f52");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f52->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f53");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f53->FldCaption(), $rekon_master->f53->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f53");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f53->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f54");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f54->FldCaption(), $rekon_master->f54->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f54");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f54->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f55");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f55->FldCaption(), $rekon_master->f55->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f55");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f55->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f56");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f56->FldCaption(), $rekon_master->f56->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f56");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f56->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f57");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f57->FldCaption(), $rekon_master->f57->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f57");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f57->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f58");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f58->FldCaption(), $rekon_master->f58->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f58");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f58->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f59");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f59->FldCaption(), $rekon_master->f59->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f59");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f59->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f60");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f60->FldCaption(), $rekon_master->f60->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f60");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f60->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f61");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f61->FldCaption(), $rekon_master->f61->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f61");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f61->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f62");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $rekon_master->f62->FldCaption(), $rekon_master->f62->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f62");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($rekon_master->f62->FldErrMsg()) ?>");

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
frekon_masteredit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
frekon_masteredit.ValidateRequired = true;
<?php } else { ?>
frekon_masteredit.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$rekon_master_edit->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $rekon_master_edit->ShowPageHeader(); ?>
<?php
$rekon_master_edit->ShowMessage();
?>
<form name="frekon_masteredit" id="frekon_masteredit" class="<?php echo $rekon_master_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rekon_master_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rekon_master_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rekon_master">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<?php if ($rekon_master_edit->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div>
<?php if ($rekon_master->rm_id->Visible) { // rm_id ?>
	<div id="r_rm_id" class="form-group">
		<label id="elh_rekon_master_rm_id" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->rm_id->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->rm_id->CellAttributes() ?>>
<span id="el_rekon_master_rm_id">
<span<?php echo $rekon_master->rm_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $rekon_master->rm_id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="rekon_master" data-field="x_rm_id" name="x_rm_id" id="x_rm_id" value="<?php echo ew_HtmlEncode($rekon_master->rm_id->CurrentValue) ?>">
<?php echo $rekon_master->rm_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->pegawai_id->Visible) { // pegawai_id ?>
	<div id="r_pegawai_id" class="form-group">
		<label id="elh_rekon_master_pegawai_id" for="x_pegawai_id" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->pegawai_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->pegawai_id->CellAttributes() ?>>
<span id="el_rekon_master_pegawai_id">
<input type="text" data-table="rekon_master" data-field="x_pegawai_id" name="x_pegawai_id" id="x_pegawai_id" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->pegawai_id->getPlaceHolder()) ?>" value="<?php echo $rekon_master->pegawai_id->EditValue ?>"<?php echo $rekon_master->pegawai_id->EditAttributes() ?>>
</span>
<?php echo $rekon_master->pegawai_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f1->Visible) { // f1 ?>
	<div id="r_f1" class="form-group">
		<label id="elh_rekon_master_f1" for="x_f1" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f1->CellAttributes() ?>>
<span id="el_rekon_master_f1">
<input type="text" data-table="rekon_master" data-field="x_f1" name="x_f1" id="x_f1" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f1->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f1->EditValue ?>"<?php echo $rekon_master->f1->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f2->Visible) { // f2 ?>
	<div id="r_f2" class="form-group">
		<label id="elh_rekon_master_f2" for="x_f2" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f2->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f2->CellAttributes() ?>>
<span id="el_rekon_master_f2">
<input type="text" data-table="rekon_master" data-field="x_f2" name="x_f2" id="x_f2" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f2->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f2->EditValue ?>"<?php echo $rekon_master->f2->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f3->Visible) { // f3 ?>
	<div id="r_f3" class="form-group">
		<label id="elh_rekon_master_f3" for="x_f3" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f3->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f3->CellAttributes() ?>>
<span id="el_rekon_master_f3">
<input type="text" data-table="rekon_master" data-field="x_f3" name="x_f3" id="x_f3" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f3->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f3->EditValue ?>"<?php echo $rekon_master->f3->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f4->Visible) { // f4 ?>
	<div id="r_f4" class="form-group">
		<label id="elh_rekon_master_f4" for="x_f4" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f4->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f4->CellAttributes() ?>>
<span id="el_rekon_master_f4">
<input type="text" data-table="rekon_master" data-field="x_f4" name="x_f4" id="x_f4" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f4->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f4->EditValue ?>"<?php echo $rekon_master->f4->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f4->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f5->Visible) { // f5 ?>
	<div id="r_f5" class="form-group">
		<label id="elh_rekon_master_f5" for="x_f5" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f5->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f5->CellAttributes() ?>>
<span id="el_rekon_master_f5">
<input type="text" data-table="rekon_master" data-field="x_f5" name="x_f5" id="x_f5" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f5->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f5->EditValue ?>"<?php echo $rekon_master->f5->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f5->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f6->Visible) { // f6 ?>
	<div id="r_f6" class="form-group">
		<label id="elh_rekon_master_f6" for="x_f6" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f6->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f6->CellAttributes() ?>>
<span id="el_rekon_master_f6">
<input type="text" data-table="rekon_master" data-field="x_f6" name="x_f6" id="x_f6" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f6->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f6->EditValue ?>"<?php echo $rekon_master->f6->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f6->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f7->Visible) { // f7 ?>
	<div id="r_f7" class="form-group">
		<label id="elh_rekon_master_f7" for="x_f7" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f7->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f7->CellAttributes() ?>>
<span id="el_rekon_master_f7">
<input type="text" data-table="rekon_master" data-field="x_f7" name="x_f7" id="x_f7" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f7->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f7->EditValue ?>"<?php echo $rekon_master->f7->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f7->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f8->Visible) { // f8 ?>
	<div id="r_f8" class="form-group">
		<label id="elh_rekon_master_f8" for="x_f8" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f8->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f8->CellAttributes() ?>>
<span id="el_rekon_master_f8">
<input type="text" data-table="rekon_master" data-field="x_f8" name="x_f8" id="x_f8" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f8->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f8->EditValue ?>"<?php echo $rekon_master->f8->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f8->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f9->Visible) { // f9 ?>
	<div id="r_f9" class="form-group">
		<label id="elh_rekon_master_f9" for="x_f9" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f9->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f9->CellAttributes() ?>>
<span id="el_rekon_master_f9">
<input type="text" data-table="rekon_master" data-field="x_f9" name="x_f9" id="x_f9" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f9->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f9->EditValue ?>"<?php echo $rekon_master->f9->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f9->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f10->Visible) { // f10 ?>
	<div id="r_f10" class="form-group">
		<label id="elh_rekon_master_f10" for="x_f10" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f10->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f10->CellAttributes() ?>>
<span id="el_rekon_master_f10">
<input type="text" data-table="rekon_master" data-field="x_f10" name="x_f10" id="x_f10" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f10->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f10->EditValue ?>"<?php echo $rekon_master->f10->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f10->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f11->Visible) { // f11 ?>
	<div id="r_f11" class="form-group">
		<label id="elh_rekon_master_f11" for="x_f11" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f11->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f11->CellAttributes() ?>>
<span id="el_rekon_master_f11">
<input type="text" data-table="rekon_master" data-field="x_f11" name="x_f11" id="x_f11" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f11->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f11->EditValue ?>"<?php echo $rekon_master->f11->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f11->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f12->Visible) { // f12 ?>
	<div id="r_f12" class="form-group">
		<label id="elh_rekon_master_f12" for="x_f12" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f12->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f12->CellAttributes() ?>>
<span id="el_rekon_master_f12">
<input type="text" data-table="rekon_master" data-field="x_f12" name="x_f12" id="x_f12" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f12->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f12->EditValue ?>"<?php echo $rekon_master->f12->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f12->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f13->Visible) { // f13 ?>
	<div id="r_f13" class="form-group">
		<label id="elh_rekon_master_f13" for="x_f13" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f13->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f13->CellAttributes() ?>>
<span id="el_rekon_master_f13">
<input type="text" data-table="rekon_master" data-field="x_f13" name="x_f13" id="x_f13" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f13->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f13->EditValue ?>"<?php echo $rekon_master->f13->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f13->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f14->Visible) { // f14 ?>
	<div id="r_f14" class="form-group">
		<label id="elh_rekon_master_f14" for="x_f14" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f14->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f14->CellAttributes() ?>>
<span id="el_rekon_master_f14">
<input type="text" data-table="rekon_master" data-field="x_f14" name="x_f14" id="x_f14" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f14->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f14->EditValue ?>"<?php echo $rekon_master->f14->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f14->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f15->Visible) { // f15 ?>
	<div id="r_f15" class="form-group">
		<label id="elh_rekon_master_f15" for="x_f15" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f15->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f15->CellAttributes() ?>>
<span id="el_rekon_master_f15">
<input type="text" data-table="rekon_master" data-field="x_f15" name="x_f15" id="x_f15" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f15->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f15->EditValue ?>"<?php echo $rekon_master->f15->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f15->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f16->Visible) { // f16 ?>
	<div id="r_f16" class="form-group">
		<label id="elh_rekon_master_f16" for="x_f16" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f16->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f16->CellAttributes() ?>>
<span id="el_rekon_master_f16">
<input type="text" data-table="rekon_master" data-field="x_f16" name="x_f16" id="x_f16" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f16->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f16->EditValue ?>"<?php echo $rekon_master->f16->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f16->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f17->Visible) { // f17 ?>
	<div id="r_f17" class="form-group">
		<label id="elh_rekon_master_f17" for="x_f17" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f17->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f17->CellAttributes() ?>>
<span id="el_rekon_master_f17">
<input type="text" data-table="rekon_master" data-field="x_f17" name="x_f17" id="x_f17" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f17->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f17->EditValue ?>"<?php echo $rekon_master->f17->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f17->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f18->Visible) { // f18 ?>
	<div id="r_f18" class="form-group">
		<label id="elh_rekon_master_f18" for="x_f18" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f18->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f18->CellAttributes() ?>>
<span id="el_rekon_master_f18">
<input type="text" data-table="rekon_master" data-field="x_f18" name="x_f18" id="x_f18" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f18->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f18->EditValue ?>"<?php echo $rekon_master->f18->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f18->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f19->Visible) { // f19 ?>
	<div id="r_f19" class="form-group">
		<label id="elh_rekon_master_f19" for="x_f19" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f19->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f19->CellAttributes() ?>>
<span id="el_rekon_master_f19">
<input type="text" data-table="rekon_master" data-field="x_f19" name="x_f19" id="x_f19" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f19->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f19->EditValue ?>"<?php echo $rekon_master->f19->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f19->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f20->Visible) { // f20 ?>
	<div id="r_f20" class="form-group">
		<label id="elh_rekon_master_f20" for="x_f20" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f20->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f20->CellAttributes() ?>>
<span id="el_rekon_master_f20">
<input type="text" data-table="rekon_master" data-field="x_f20" name="x_f20" id="x_f20" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f20->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f20->EditValue ?>"<?php echo $rekon_master->f20->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f20->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f21->Visible) { // f21 ?>
	<div id="r_f21" class="form-group">
		<label id="elh_rekon_master_f21" for="x_f21" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f21->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f21->CellAttributes() ?>>
<span id="el_rekon_master_f21">
<input type="text" data-table="rekon_master" data-field="x_f21" name="x_f21" id="x_f21" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f21->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f21->EditValue ?>"<?php echo $rekon_master->f21->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f21->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f22->Visible) { // f22 ?>
	<div id="r_f22" class="form-group">
		<label id="elh_rekon_master_f22" for="x_f22" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f22->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f22->CellAttributes() ?>>
<span id="el_rekon_master_f22">
<input type="text" data-table="rekon_master" data-field="x_f22" name="x_f22" id="x_f22" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f22->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f22->EditValue ?>"<?php echo $rekon_master->f22->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f22->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f23->Visible) { // f23 ?>
	<div id="r_f23" class="form-group">
		<label id="elh_rekon_master_f23" for="x_f23" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f23->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f23->CellAttributes() ?>>
<span id="el_rekon_master_f23">
<input type="text" data-table="rekon_master" data-field="x_f23" name="x_f23" id="x_f23" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f23->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f23->EditValue ?>"<?php echo $rekon_master->f23->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f23->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f24->Visible) { // f24 ?>
	<div id="r_f24" class="form-group">
		<label id="elh_rekon_master_f24" for="x_f24" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f24->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f24->CellAttributes() ?>>
<span id="el_rekon_master_f24">
<input type="text" data-table="rekon_master" data-field="x_f24" name="x_f24" id="x_f24" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f24->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f24->EditValue ?>"<?php echo $rekon_master->f24->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f24->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f25->Visible) { // f25 ?>
	<div id="r_f25" class="form-group">
		<label id="elh_rekon_master_f25" for="x_f25" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f25->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f25->CellAttributes() ?>>
<span id="el_rekon_master_f25">
<input type="text" data-table="rekon_master" data-field="x_f25" name="x_f25" id="x_f25" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f25->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f25->EditValue ?>"<?php echo $rekon_master->f25->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f25->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f26->Visible) { // f26 ?>
	<div id="r_f26" class="form-group">
		<label id="elh_rekon_master_f26" for="x_f26" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f26->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f26->CellAttributes() ?>>
<span id="el_rekon_master_f26">
<input type="text" data-table="rekon_master" data-field="x_f26" name="x_f26" id="x_f26" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f26->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f26->EditValue ?>"<?php echo $rekon_master->f26->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f26->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f27->Visible) { // f27 ?>
	<div id="r_f27" class="form-group">
		<label id="elh_rekon_master_f27" for="x_f27" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f27->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f27->CellAttributes() ?>>
<span id="el_rekon_master_f27">
<input type="text" data-table="rekon_master" data-field="x_f27" name="x_f27" id="x_f27" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f27->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f27->EditValue ?>"<?php echo $rekon_master->f27->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f27->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f28->Visible) { // f28 ?>
	<div id="r_f28" class="form-group">
		<label id="elh_rekon_master_f28" for="x_f28" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f28->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f28->CellAttributes() ?>>
<span id="el_rekon_master_f28">
<input type="text" data-table="rekon_master" data-field="x_f28" name="x_f28" id="x_f28" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f28->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f28->EditValue ?>"<?php echo $rekon_master->f28->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f28->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f29->Visible) { // f29 ?>
	<div id="r_f29" class="form-group">
		<label id="elh_rekon_master_f29" for="x_f29" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f29->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f29->CellAttributes() ?>>
<span id="el_rekon_master_f29">
<input type="text" data-table="rekon_master" data-field="x_f29" name="x_f29" id="x_f29" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f29->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f29->EditValue ?>"<?php echo $rekon_master->f29->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f29->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f30->Visible) { // f30 ?>
	<div id="r_f30" class="form-group">
		<label id="elh_rekon_master_f30" for="x_f30" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f30->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f30->CellAttributes() ?>>
<span id="el_rekon_master_f30">
<input type="text" data-table="rekon_master" data-field="x_f30" name="x_f30" id="x_f30" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f30->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f30->EditValue ?>"<?php echo $rekon_master->f30->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f30->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f31->Visible) { // f31 ?>
	<div id="r_f31" class="form-group">
		<label id="elh_rekon_master_f31" for="x_f31" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f31->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f31->CellAttributes() ?>>
<span id="el_rekon_master_f31">
<input type="text" data-table="rekon_master" data-field="x_f31" name="x_f31" id="x_f31" size="30" placeholder="<?php echo ew_HtmlEncode($rekon_master->f31->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f31->EditValue ?>"<?php echo $rekon_master->f31->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f31->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f32->Visible) { // f32 ?>
	<div id="r_f32" class="form-group">
		<label id="elh_rekon_master_f32" for="x_f32" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f32->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f32->CellAttributes() ?>>
<span id="el_rekon_master_f32">
<input type="text" data-table="rekon_master" data-field="x_f32" name="x_f32" id="x_f32" placeholder="<?php echo ew_HtmlEncode($rekon_master->f32->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f32->EditValue ?>"<?php echo $rekon_master->f32->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f32->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f33->Visible) { // f33 ?>
	<div id="r_f33" class="form-group">
		<label id="elh_rekon_master_f33" for="x_f33" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f33->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f33->CellAttributes() ?>>
<span id="el_rekon_master_f33">
<input type="text" data-table="rekon_master" data-field="x_f33" name="x_f33" id="x_f33" placeholder="<?php echo ew_HtmlEncode($rekon_master->f33->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f33->EditValue ?>"<?php echo $rekon_master->f33->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f33->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f34->Visible) { // f34 ?>
	<div id="r_f34" class="form-group">
		<label id="elh_rekon_master_f34" for="x_f34" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f34->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f34->CellAttributes() ?>>
<span id="el_rekon_master_f34">
<input type="text" data-table="rekon_master" data-field="x_f34" name="x_f34" id="x_f34" placeholder="<?php echo ew_HtmlEncode($rekon_master->f34->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f34->EditValue ?>"<?php echo $rekon_master->f34->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f34->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f35->Visible) { // f35 ?>
	<div id="r_f35" class="form-group">
		<label id="elh_rekon_master_f35" for="x_f35" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f35->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f35->CellAttributes() ?>>
<span id="el_rekon_master_f35">
<input type="text" data-table="rekon_master" data-field="x_f35" name="x_f35" id="x_f35" placeholder="<?php echo ew_HtmlEncode($rekon_master->f35->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f35->EditValue ?>"<?php echo $rekon_master->f35->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f35->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f36->Visible) { // f36 ?>
	<div id="r_f36" class="form-group">
		<label id="elh_rekon_master_f36" for="x_f36" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f36->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f36->CellAttributes() ?>>
<span id="el_rekon_master_f36">
<input type="text" data-table="rekon_master" data-field="x_f36" name="x_f36" id="x_f36" placeholder="<?php echo ew_HtmlEncode($rekon_master->f36->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f36->EditValue ?>"<?php echo $rekon_master->f36->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f36->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f37->Visible) { // f37 ?>
	<div id="r_f37" class="form-group">
		<label id="elh_rekon_master_f37" for="x_f37" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f37->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f37->CellAttributes() ?>>
<span id="el_rekon_master_f37">
<input type="text" data-table="rekon_master" data-field="x_f37" name="x_f37" id="x_f37" placeholder="<?php echo ew_HtmlEncode($rekon_master->f37->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f37->EditValue ?>"<?php echo $rekon_master->f37->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f37->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f38->Visible) { // f38 ?>
	<div id="r_f38" class="form-group">
		<label id="elh_rekon_master_f38" for="x_f38" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f38->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f38->CellAttributes() ?>>
<span id="el_rekon_master_f38">
<input type="text" data-table="rekon_master" data-field="x_f38" name="x_f38" id="x_f38" placeholder="<?php echo ew_HtmlEncode($rekon_master->f38->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f38->EditValue ?>"<?php echo $rekon_master->f38->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f38->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f39->Visible) { // f39 ?>
	<div id="r_f39" class="form-group">
		<label id="elh_rekon_master_f39" for="x_f39" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f39->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f39->CellAttributes() ?>>
<span id="el_rekon_master_f39">
<input type="text" data-table="rekon_master" data-field="x_f39" name="x_f39" id="x_f39" placeholder="<?php echo ew_HtmlEncode($rekon_master->f39->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f39->EditValue ?>"<?php echo $rekon_master->f39->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f39->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f40->Visible) { // f40 ?>
	<div id="r_f40" class="form-group">
		<label id="elh_rekon_master_f40" for="x_f40" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f40->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f40->CellAttributes() ?>>
<span id="el_rekon_master_f40">
<input type="text" data-table="rekon_master" data-field="x_f40" name="x_f40" id="x_f40" placeholder="<?php echo ew_HtmlEncode($rekon_master->f40->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f40->EditValue ?>"<?php echo $rekon_master->f40->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f40->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f41->Visible) { // f41 ?>
	<div id="r_f41" class="form-group">
		<label id="elh_rekon_master_f41" for="x_f41" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f41->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f41->CellAttributes() ?>>
<span id="el_rekon_master_f41">
<input type="text" data-table="rekon_master" data-field="x_f41" name="x_f41" id="x_f41" placeholder="<?php echo ew_HtmlEncode($rekon_master->f41->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f41->EditValue ?>"<?php echo $rekon_master->f41->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f41->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f42->Visible) { // f42 ?>
	<div id="r_f42" class="form-group">
		<label id="elh_rekon_master_f42" for="x_f42" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f42->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f42->CellAttributes() ?>>
<span id="el_rekon_master_f42">
<input type="text" data-table="rekon_master" data-field="x_f42" name="x_f42" id="x_f42" placeholder="<?php echo ew_HtmlEncode($rekon_master->f42->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f42->EditValue ?>"<?php echo $rekon_master->f42->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f42->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f43->Visible) { // f43 ?>
	<div id="r_f43" class="form-group">
		<label id="elh_rekon_master_f43" for="x_f43" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f43->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f43->CellAttributes() ?>>
<span id="el_rekon_master_f43">
<input type="text" data-table="rekon_master" data-field="x_f43" name="x_f43" id="x_f43" placeholder="<?php echo ew_HtmlEncode($rekon_master->f43->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f43->EditValue ?>"<?php echo $rekon_master->f43->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f43->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f44->Visible) { // f44 ?>
	<div id="r_f44" class="form-group">
		<label id="elh_rekon_master_f44" for="x_f44" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f44->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f44->CellAttributes() ?>>
<span id="el_rekon_master_f44">
<input type="text" data-table="rekon_master" data-field="x_f44" name="x_f44" id="x_f44" placeholder="<?php echo ew_HtmlEncode($rekon_master->f44->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f44->EditValue ?>"<?php echo $rekon_master->f44->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f44->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f45->Visible) { // f45 ?>
	<div id="r_f45" class="form-group">
		<label id="elh_rekon_master_f45" for="x_f45" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f45->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f45->CellAttributes() ?>>
<span id="el_rekon_master_f45">
<input type="text" data-table="rekon_master" data-field="x_f45" name="x_f45" id="x_f45" placeholder="<?php echo ew_HtmlEncode($rekon_master->f45->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f45->EditValue ?>"<?php echo $rekon_master->f45->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f45->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f46->Visible) { // f46 ?>
	<div id="r_f46" class="form-group">
		<label id="elh_rekon_master_f46" for="x_f46" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f46->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f46->CellAttributes() ?>>
<span id="el_rekon_master_f46">
<input type="text" data-table="rekon_master" data-field="x_f46" name="x_f46" id="x_f46" placeholder="<?php echo ew_HtmlEncode($rekon_master->f46->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f46->EditValue ?>"<?php echo $rekon_master->f46->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f46->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f47->Visible) { // f47 ?>
	<div id="r_f47" class="form-group">
		<label id="elh_rekon_master_f47" for="x_f47" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f47->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f47->CellAttributes() ?>>
<span id="el_rekon_master_f47">
<input type="text" data-table="rekon_master" data-field="x_f47" name="x_f47" id="x_f47" placeholder="<?php echo ew_HtmlEncode($rekon_master->f47->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f47->EditValue ?>"<?php echo $rekon_master->f47->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f47->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f48->Visible) { // f48 ?>
	<div id="r_f48" class="form-group">
		<label id="elh_rekon_master_f48" for="x_f48" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f48->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f48->CellAttributes() ?>>
<span id="el_rekon_master_f48">
<input type="text" data-table="rekon_master" data-field="x_f48" name="x_f48" id="x_f48" placeholder="<?php echo ew_HtmlEncode($rekon_master->f48->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f48->EditValue ?>"<?php echo $rekon_master->f48->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f48->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f49->Visible) { // f49 ?>
	<div id="r_f49" class="form-group">
		<label id="elh_rekon_master_f49" for="x_f49" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f49->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f49->CellAttributes() ?>>
<span id="el_rekon_master_f49">
<input type="text" data-table="rekon_master" data-field="x_f49" name="x_f49" id="x_f49" placeholder="<?php echo ew_HtmlEncode($rekon_master->f49->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f49->EditValue ?>"<?php echo $rekon_master->f49->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f49->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f50->Visible) { // f50 ?>
	<div id="r_f50" class="form-group">
		<label id="elh_rekon_master_f50" for="x_f50" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f50->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f50->CellAttributes() ?>>
<span id="el_rekon_master_f50">
<input type="text" data-table="rekon_master" data-field="x_f50" name="x_f50" id="x_f50" placeholder="<?php echo ew_HtmlEncode($rekon_master->f50->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f50->EditValue ?>"<?php echo $rekon_master->f50->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f50->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f51->Visible) { // f51 ?>
	<div id="r_f51" class="form-group">
		<label id="elh_rekon_master_f51" for="x_f51" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f51->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f51->CellAttributes() ?>>
<span id="el_rekon_master_f51">
<input type="text" data-table="rekon_master" data-field="x_f51" name="x_f51" id="x_f51" placeholder="<?php echo ew_HtmlEncode($rekon_master->f51->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f51->EditValue ?>"<?php echo $rekon_master->f51->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f51->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f52->Visible) { // f52 ?>
	<div id="r_f52" class="form-group">
		<label id="elh_rekon_master_f52" for="x_f52" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f52->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f52->CellAttributes() ?>>
<span id="el_rekon_master_f52">
<input type="text" data-table="rekon_master" data-field="x_f52" name="x_f52" id="x_f52" placeholder="<?php echo ew_HtmlEncode($rekon_master->f52->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f52->EditValue ?>"<?php echo $rekon_master->f52->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f52->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f53->Visible) { // f53 ?>
	<div id="r_f53" class="form-group">
		<label id="elh_rekon_master_f53" for="x_f53" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f53->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f53->CellAttributes() ?>>
<span id="el_rekon_master_f53">
<input type="text" data-table="rekon_master" data-field="x_f53" name="x_f53" id="x_f53" placeholder="<?php echo ew_HtmlEncode($rekon_master->f53->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f53->EditValue ?>"<?php echo $rekon_master->f53->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f53->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f54->Visible) { // f54 ?>
	<div id="r_f54" class="form-group">
		<label id="elh_rekon_master_f54" for="x_f54" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f54->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f54->CellAttributes() ?>>
<span id="el_rekon_master_f54">
<input type="text" data-table="rekon_master" data-field="x_f54" name="x_f54" id="x_f54" placeholder="<?php echo ew_HtmlEncode($rekon_master->f54->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f54->EditValue ?>"<?php echo $rekon_master->f54->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f54->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f55->Visible) { // f55 ?>
	<div id="r_f55" class="form-group">
		<label id="elh_rekon_master_f55" for="x_f55" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f55->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f55->CellAttributes() ?>>
<span id="el_rekon_master_f55">
<input type="text" data-table="rekon_master" data-field="x_f55" name="x_f55" id="x_f55" placeholder="<?php echo ew_HtmlEncode($rekon_master->f55->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f55->EditValue ?>"<?php echo $rekon_master->f55->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f55->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f56->Visible) { // f56 ?>
	<div id="r_f56" class="form-group">
		<label id="elh_rekon_master_f56" for="x_f56" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f56->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f56->CellAttributes() ?>>
<span id="el_rekon_master_f56">
<input type="text" data-table="rekon_master" data-field="x_f56" name="x_f56" id="x_f56" placeholder="<?php echo ew_HtmlEncode($rekon_master->f56->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f56->EditValue ?>"<?php echo $rekon_master->f56->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f56->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f57->Visible) { // f57 ?>
	<div id="r_f57" class="form-group">
		<label id="elh_rekon_master_f57" for="x_f57" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f57->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f57->CellAttributes() ?>>
<span id="el_rekon_master_f57">
<input type="text" data-table="rekon_master" data-field="x_f57" name="x_f57" id="x_f57" placeholder="<?php echo ew_HtmlEncode($rekon_master->f57->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f57->EditValue ?>"<?php echo $rekon_master->f57->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f57->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f58->Visible) { // f58 ?>
	<div id="r_f58" class="form-group">
		<label id="elh_rekon_master_f58" for="x_f58" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f58->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f58->CellAttributes() ?>>
<span id="el_rekon_master_f58">
<input type="text" data-table="rekon_master" data-field="x_f58" name="x_f58" id="x_f58" placeholder="<?php echo ew_HtmlEncode($rekon_master->f58->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f58->EditValue ?>"<?php echo $rekon_master->f58->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f58->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f59->Visible) { // f59 ?>
	<div id="r_f59" class="form-group">
		<label id="elh_rekon_master_f59" for="x_f59" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f59->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f59->CellAttributes() ?>>
<span id="el_rekon_master_f59">
<input type="text" data-table="rekon_master" data-field="x_f59" name="x_f59" id="x_f59" placeholder="<?php echo ew_HtmlEncode($rekon_master->f59->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f59->EditValue ?>"<?php echo $rekon_master->f59->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f59->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f60->Visible) { // f60 ?>
	<div id="r_f60" class="form-group">
		<label id="elh_rekon_master_f60" for="x_f60" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f60->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f60->CellAttributes() ?>>
<span id="el_rekon_master_f60">
<input type="text" data-table="rekon_master" data-field="x_f60" name="x_f60" id="x_f60" placeholder="<?php echo ew_HtmlEncode($rekon_master->f60->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f60->EditValue ?>"<?php echo $rekon_master->f60->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f60->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f61->Visible) { // f61 ?>
	<div id="r_f61" class="form-group">
		<label id="elh_rekon_master_f61" for="x_f61" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f61->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f61->CellAttributes() ?>>
<span id="el_rekon_master_f61">
<input type="text" data-table="rekon_master" data-field="x_f61" name="x_f61" id="x_f61" placeholder="<?php echo ew_HtmlEncode($rekon_master->f61->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f61->EditValue ?>"<?php echo $rekon_master->f61->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f61->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($rekon_master->f62->Visible) { // f62 ?>
	<div id="r_f62" class="form-group">
		<label id="elh_rekon_master_f62" for="x_f62" class="col-sm-2 control-label ewLabel"><?php echo $rekon_master->f62->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $rekon_master->f62->CellAttributes() ?>>
<span id="el_rekon_master_f62">
<input type="text" data-table="rekon_master" data-field="x_f62" name="x_f62" id="x_f62" placeholder="<?php echo ew_HtmlEncode($rekon_master->f62->getPlaceHolder()) ?>" value="<?php echo $rekon_master->f62->EditValue ?>"<?php echo $rekon_master->f62->EditAttributes() ?>>
</span>
<?php echo $rekon_master->f62->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<?php if (!$rekon_master_edit->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $rekon_master_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php } ?>
</form>
<script type="text/javascript">
frekon_masteredit.Init();
</script>
<?php
$rekon_master_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$rekon_master_edit->Page_Terminate();
?>
