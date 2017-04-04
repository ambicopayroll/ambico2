<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "pegawai_defaultinfo.php" ?>
<?php include_once "t_userinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$pegawai_default_add = NULL; // Initialize page object first

class cpegawai_default_add extends cpegawai_default {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = "{4B5DAB39-E4BC-48DF-9311-E295A5F18030}";

	// Table name
	var $TableName = 'pegawai_default';

	// Page object name
	var $PageObjName = 'pegawai_default_add';

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

		// Table object (pegawai_default)
		if (!isset($GLOBALS["pegawai_default"]) || get_class($GLOBALS["pegawai_default"]) == "cpegawai_default") {
			$GLOBALS["pegawai_default"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["pegawai_default"];
		}

		// Table object (t_user)
		if (!isset($GLOBALS['t_user'])) $GLOBALS['t_user'] = new ct_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pegawai_default', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("pegawai_defaultlist.php"));
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
		$this->dept_id->SetVisibility();
		$this->f0m1->SetVisibility();
		$this->f0k1->SetVisibility();
		$this->f1m1->SetVisibility();
		$this->f1k1->SetVisibility();
		$this->f2m1->SetVisibility();
		$this->f2k1->SetVisibility();
		$this->f3m1->SetVisibility();
		$this->f3k1->SetVisibility();
		$this->f4m1->SetVisibility();
		$this->f4k1->SetVisibility();
		$this->f5m1->SetVisibility();
		$this->f5k1->SetVisibility();
		$this->f6m1->SetVisibility();
		$this->f6k1->SetVisibility();
		$this->f0m2->SetVisibility();
		$this->f0k2->SetVisibility();
		$this->f1m2->SetVisibility();
		$this->f1k2->SetVisibility();
		$this->f2m2->SetVisibility();
		$this->f2k2->SetVisibility();
		$this->f3m2->SetVisibility();
		$this->f3k2->SetVisibility();
		$this->f4m2->SetVisibility();
		$this->f4k2->SetVisibility();
		$this->f5m2->SetVisibility();
		$this->f5k2->SetVisibility();
		$this->f6m2->SetVisibility();
		$this->f6k2->SetVisibility();
		$this->f0m3->SetVisibility();
		$this->f0k3->SetVisibility();
		$this->f1m3->SetVisibility();
		$this->f1k3->SetVisibility();
		$this->f2m3->SetVisibility();
		$this->f2k3->SetVisibility();
		$this->f3m3->SetVisibility();
		$this->f3k3->SetVisibility();
		$this->f4m3->SetVisibility();
		$this->f4k3->SetVisibility();
		$this->f5m3->SetVisibility();
		$this->f5k3->SetVisibility();
		$this->f6m3->SetVisibility();
		$this->f6k3->SetVisibility();

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
		global $EW_EXPORT, $pegawai_default;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($pegawai_default);
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
			if (@$_GET["pd_id"] != "") {
				$this->pd_id->setQueryStringValue($_GET["pd_id"]);
				$this->setKey("pd_id", $this->pd_id->CurrentValue); // Set up key
			} else {
				$this->setKey("pd_id", ""); // Clear key
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
					$this->Page_Terminate("pegawai_defaultlist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "pegawai_defaultlist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to list page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "pegawai_defaultview.php")
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
		$this->dept_id->CurrentValue = NULL;
		$this->dept_id->OldValue = $this->dept_id->CurrentValue;
		$this->f0m1->CurrentValue = NULL;
		$this->f0m1->OldValue = $this->f0m1->CurrentValue;
		$this->f0k1->CurrentValue = NULL;
		$this->f0k1->OldValue = $this->f0k1->CurrentValue;
		$this->f1m1->CurrentValue = NULL;
		$this->f1m1->OldValue = $this->f1m1->CurrentValue;
		$this->f1k1->CurrentValue = NULL;
		$this->f1k1->OldValue = $this->f1k1->CurrentValue;
		$this->f2m1->CurrentValue = NULL;
		$this->f2m1->OldValue = $this->f2m1->CurrentValue;
		$this->f2k1->CurrentValue = NULL;
		$this->f2k1->OldValue = $this->f2k1->CurrentValue;
		$this->f3m1->CurrentValue = NULL;
		$this->f3m1->OldValue = $this->f3m1->CurrentValue;
		$this->f3k1->CurrentValue = NULL;
		$this->f3k1->OldValue = $this->f3k1->CurrentValue;
		$this->f4m1->CurrentValue = NULL;
		$this->f4m1->OldValue = $this->f4m1->CurrentValue;
		$this->f4k1->CurrentValue = NULL;
		$this->f4k1->OldValue = $this->f4k1->CurrentValue;
		$this->f5m1->CurrentValue = NULL;
		$this->f5m1->OldValue = $this->f5m1->CurrentValue;
		$this->f5k1->CurrentValue = NULL;
		$this->f5k1->OldValue = $this->f5k1->CurrentValue;
		$this->f6m1->CurrentValue = NULL;
		$this->f6m1->OldValue = $this->f6m1->CurrentValue;
		$this->f6k1->CurrentValue = NULL;
		$this->f6k1->OldValue = $this->f6k1->CurrentValue;
		$this->f0m2->CurrentValue = NULL;
		$this->f0m2->OldValue = $this->f0m2->CurrentValue;
		$this->f0k2->CurrentValue = NULL;
		$this->f0k2->OldValue = $this->f0k2->CurrentValue;
		$this->f1m2->CurrentValue = NULL;
		$this->f1m2->OldValue = $this->f1m2->CurrentValue;
		$this->f1k2->CurrentValue = NULL;
		$this->f1k2->OldValue = $this->f1k2->CurrentValue;
		$this->f2m2->CurrentValue = NULL;
		$this->f2m2->OldValue = $this->f2m2->CurrentValue;
		$this->f2k2->CurrentValue = NULL;
		$this->f2k2->OldValue = $this->f2k2->CurrentValue;
		$this->f3m2->CurrentValue = NULL;
		$this->f3m2->OldValue = $this->f3m2->CurrentValue;
		$this->f3k2->CurrentValue = NULL;
		$this->f3k2->OldValue = $this->f3k2->CurrentValue;
		$this->f4m2->CurrentValue = NULL;
		$this->f4m2->OldValue = $this->f4m2->CurrentValue;
		$this->f4k2->CurrentValue = NULL;
		$this->f4k2->OldValue = $this->f4k2->CurrentValue;
		$this->f5m2->CurrentValue = NULL;
		$this->f5m2->OldValue = $this->f5m2->CurrentValue;
		$this->f5k2->CurrentValue = NULL;
		$this->f5k2->OldValue = $this->f5k2->CurrentValue;
		$this->f6m2->CurrentValue = NULL;
		$this->f6m2->OldValue = $this->f6m2->CurrentValue;
		$this->f6k2->CurrentValue = NULL;
		$this->f6k2->OldValue = $this->f6k2->CurrentValue;
		$this->f0m3->CurrentValue = NULL;
		$this->f0m3->OldValue = $this->f0m3->CurrentValue;
		$this->f0k3->CurrentValue = NULL;
		$this->f0k3->OldValue = $this->f0k3->CurrentValue;
		$this->f1m3->CurrentValue = NULL;
		$this->f1m3->OldValue = $this->f1m3->CurrentValue;
		$this->f1k3->CurrentValue = NULL;
		$this->f1k3->OldValue = $this->f1k3->CurrentValue;
		$this->f2m3->CurrentValue = NULL;
		$this->f2m3->OldValue = $this->f2m3->CurrentValue;
		$this->f2k3->CurrentValue = NULL;
		$this->f2k3->OldValue = $this->f2k3->CurrentValue;
		$this->f3m3->CurrentValue = NULL;
		$this->f3m3->OldValue = $this->f3m3->CurrentValue;
		$this->f3k3->CurrentValue = NULL;
		$this->f3k3->OldValue = $this->f3k3->CurrentValue;
		$this->f4m3->CurrentValue = NULL;
		$this->f4m3->OldValue = $this->f4m3->CurrentValue;
		$this->f4k3->CurrentValue = NULL;
		$this->f4k3->OldValue = $this->f4k3->CurrentValue;
		$this->f5m3->CurrentValue = NULL;
		$this->f5m3->OldValue = $this->f5m3->CurrentValue;
		$this->f5k3->CurrentValue = NULL;
		$this->f5k3->OldValue = $this->f5k3->CurrentValue;
		$this->f6m3->CurrentValue = NULL;
		$this->f6m3->OldValue = $this->f6m3->CurrentValue;
		$this->f6k3->CurrentValue = NULL;
		$this->f6k3->OldValue = $this->f6k3->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->pegawai_id->FldIsDetailKey) {
			$this->pegawai_id->setFormValue($objForm->GetValue("x_pegawai_id"));
		}
		if (!$this->dept_id->FldIsDetailKey) {
			$this->dept_id->setFormValue($objForm->GetValue("x_dept_id"));
		}
		if (!$this->f0m1->FldIsDetailKey) {
			$this->f0m1->setFormValue($objForm->GetValue("x_f0m1"));
		}
		if (!$this->f0k1->FldIsDetailKey) {
			$this->f0k1->setFormValue($objForm->GetValue("x_f0k1"));
		}
		if (!$this->f1m1->FldIsDetailKey) {
			$this->f1m1->setFormValue($objForm->GetValue("x_f1m1"));
		}
		if (!$this->f1k1->FldIsDetailKey) {
			$this->f1k1->setFormValue($objForm->GetValue("x_f1k1"));
		}
		if (!$this->f2m1->FldIsDetailKey) {
			$this->f2m1->setFormValue($objForm->GetValue("x_f2m1"));
		}
		if (!$this->f2k1->FldIsDetailKey) {
			$this->f2k1->setFormValue($objForm->GetValue("x_f2k1"));
		}
		if (!$this->f3m1->FldIsDetailKey) {
			$this->f3m1->setFormValue($objForm->GetValue("x_f3m1"));
		}
		if (!$this->f3k1->FldIsDetailKey) {
			$this->f3k1->setFormValue($objForm->GetValue("x_f3k1"));
		}
		if (!$this->f4m1->FldIsDetailKey) {
			$this->f4m1->setFormValue($objForm->GetValue("x_f4m1"));
		}
		if (!$this->f4k1->FldIsDetailKey) {
			$this->f4k1->setFormValue($objForm->GetValue("x_f4k1"));
		}
		if (!$this->f5m1->FldIsDetailKey) {
			$this->f5m1->setFormValue($objForm->GetValue("x_f5m1"));
		}
		if (!$this->f5k1->FldIsDetailKey) {
			$this->f5k1->setFormValue($objForm->GetValue("x_f5k1"));
		}
		if (!$this->f6m1->FldIsDetailKey) {
			$this->f6m1->setFormValue($objForm->GetValue("x_f6m1"));
		}
		if (!$this->f6k1->FldIsDetailKey) {
			$this->f6k1->setFormValue($objForm->GetValue("x_f6k1"));
		}
		if (!$this->f0m2->FldIsDetailKey) {
			$this->f0m2->setFormValue($objForm->GetValue("x_f0m2"));
		}
		if (!$this->f0k2->FldIsDetailKey) {
			$this->f0k2->setFormValue($objForm->GetValue("x_f0k2"));
		}
		if (!$this->f1m2->FldIsDetailKey) {
			$this->f1m2->setFormValue($objForm->GetValue("x_f1m2"));
		}
		if (!$this->f1k2->FldIsDetailKey) {
			$this->f1k2->setFormValue($objForm->GetValue("x_f1k2"));
		}
		if (!$this->f2m2->FldIsDetailKey) {
			$this->f2m2->setFormValue($objForm->GetValue("x_f2m2"));
		}
		if (!$this->f2k2->FldIsDetailKey) {
			$this->f2k2->setFormValue($objForm->GetValue("x_f2k2"));
		}
		if (!$this->f3m2->FldIsDetailKey) {
			$this->f3m2->setFormValue($objForm->GetValue("x_f3m2"));
		}
		if (!$this->f3k2->FldIsDetailKey) {
			$this->f3k2->setFormValue($objForm->GetValue("x_f3k2"));
		}
		if (!$this->f4m2->FldIsDetailKey) {
			$this->f4m2->setFormValue($objForm->GetValue("x_f4m2"));
		}
		if (!$this->f4k2->FldIsDetailKey) {
			$this->f4k2->setFormValue($objForm->GetValue("x_f4k2"));
		}
		if (!$this->f5m2->FldIsDetailKey) {
			$this->f5m2->setFormValue($objForm->GetValue("x_f5m2"));
		}
		if (!$this->f5k2->FldIsDetailKey) {
			$this->f5k2->setFormValue($objForm->GetValue("x_f5k2"));
		}
		if (!$this->f6m2->FldIsDetailKey) {
			$this->f6m2->setFormValue($objForm->GetValue("x_f6m2"));
		}
		if (!$this->f6k2->FldIsDetailKey) {
			$this->f6k2->setFormValue($objForm->GetValue("x_f6k2"));
		}
		if (!$this->f0m3->FldIsDetailKey) {
			$this->f0m3->setFormValue($objForm->GetValue("x_f0m3"));
		}
		if (!$this->f0k3->FldIsDetailKey) {
			$this->f0k3->setFormValue($objForm->GetValue("x_f0k3"));
		}
		if (!$this->f1m3->FldIsDetailKey) {
			$this->f1m3->setFormValue($objForm->GetValue("x_f1m3"));
		}
		if (!$this->f1k3->FldIsDetailKey) {
			$this->f1k3->setFormValue($objForm->GetValue("x_f1k3"));
		}
		if (!$this->f2m3->FldIsDetailKey) {
			$this->f2m3->setFormValue($objForm->GetValue("x_f2m3"));
		}
		if (!$this->f2k3->FldIsDetailKey) {
			$this->f2k3->setFormValue($objForm->GetValue("x_f2k3"));
		}
		if (!$this->f3m3->FldIsDetailKey) {
			$this->f3m3->setFormValue($objForm->GetValue("x_f3m3"));
		}
		if (!$this->f3k3->FldIsDetailKey) {
			$this->f3k3->setFormValue($objForm->GetValue("x_f3k3"));
		}
		if (!$this->f4m3->FldIsDetailKey) {
			$this->f4m3->setFormValue($objForm->GetValue("x_f4m3"));
		}
		if (!$this->f4k3->FldIsDetailKey) {
			$this->f4k3->setFormValue($objForm->GetValue("x_f4k3"));
		}
		if (!$this->f5m3->FldIsDetailKey) {
			$this->f5m3->setFormValue($objForm->GetValue("x_f5m3"));
		}
		if (!$this->f5k3->FldIsDetailKey) {
			$this->f5k3->setFormValue($objForm->GetValue("x_f5k3"));
		}
		if (!$this->f6m3->FldIsDetailKey) {
			$this->f6m3->setFormValue($objForm->GetValue("x_f6m3"));
		}
		if (!$this->f6k3->FldIsDetailKey) {
			$this->f6k3->setFormValue($objForm->GetValue("x_f6k3"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadOldRecord();
		$this->pegawai_id->CurrentValue = $this->pegawai_id->FormValue;
		$this->dept_id->CurrentValue = $this->dept_id->FormValue;
		$this->f0m1->CurrentValue = $this->f0m1->FormValue;
		$this->f0k1->CurrentValue = $this->f0k1->FormValue;
		$this->f1m1->CurrentValue = $this->f1m1->FormValue;
		$this->f1k1->CurrentValue = $this->f1k1->FormValue;
		$this->f2m1->CurrentValue = $this->f2m1->FormValue;
		$this->f2k1->CurrentValue = $this->f2k1->FormValue;
		$this->f3m1->CurrentValue = $this->f3m1->FormValue;
		$this->f3k1->CurrentValue = $this->f3k1->FormValue;
		$this->f4m1->CurrentValue = $this->f4m1->FormValue;
		$this->f4k1->CurrentValue = $this->f4k1->FormValue;
		$this->f5m1->CurrentValue = $this->f5m1->FormValue;
		$this->f5k1->CurrentValue = $this->f5k1->FormValue;
		$this->f6m1->CurrentValue = $this->f6m1->FormValue;
		$this->f6k1->CurrentValue = $this->f6k1->FormValue;
		$this->f0m2->CurrentValue = $this->f0m2->FormValue;
		$this->f0k2->CurrentValue = $this->f0k2->FormValue;
		$this->f1m2->CurrentValue = $this->f1m2->FormValue;
		$this->f1k2->CurrentValue = $this->f1k2->FormValue;
		$this->f2m2->CurrentValue = $this->f2m2->FormValue;
		$this->f2k2->CurrentValue = $this->f2k2->FormValue;
		$this->f3m2->CurrentValue = $this->f3m2->FormValue;
		$this->f3k2->CurrentValue = $this->f3k2->FormValue;
		$this->f4m2->CurrentValue = $this->f4m2->FormValue;
		$this->f4k2->CurrentValue = $this->f4k2->FormValue;
		$this->f5m2->CurrentValue = $this->f5m2->FormValue;
		$this->f5k2->CurrentValue = $this->f5k2->FormValue;
		$this->f6m2->CurrentValue = $this->f6m2->FormValue;
		$this->f6k2->CurrentValue = $this->f6k2->FormValue;
		$this->f0m3->CurrentValue = $this->f0m3->FormValue;
		$this->f0k3->CurrentValue = $this->f0k3->FormValue;
		$this->f1m3->CurrentValue = $this->f1m3->FormValue;
		$this->f1k3->CurrentValue = $this->f1k3->FormValue;
		$this->f2m3->CurrentValue = $this->f2m3->FormValue;
		$this->f2k3->CurrentValue = $this->f2k3->FormValue;
		$this->f3m3->CurrentValue = $this->f3m3->FormValue;
		$this->f3k3->CurrentValue = $this->f3k3->FormValue;
		$this->f4m3->CurrentValue = $this->f4m3->FormValue;
		$this->f4k3->CurrentValue = $this->f4k3->FormValue;
		$this->f5m3->CurrentValue = $this->f5m3->FormValue;
		$this->f5k3->CurrentValue = $this->f5k3->FormValue;
		$this->f6m3->CurrentValue = $this->f6m3->FormValue;
		$this->f6k3->CurrentValue = $this->f6k3->FormValue;
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
		$this->pd_id->setDbValue($rs->fields('pd_id'));
		$this->pegawai_id->setDbValue($rs->fields('pegawai_id'));
		if (array_key_exists('EV__pegawai_id', $rs->fields)) {
			$this->pegawai_id->VirtualValue = $rs->fields('EV__pegawai_id'); // Set up virtual field value
		} else {
			$this->pegawai_id->VirtualValue = ""; // Clear value
		}
		$this->dept_id->setDbValue($rs->fields('dept_id'));
		if (array_key_exists('EV__dept_id', $rs->fields)) {
			$this->dept_id->VirtualValue = $rs->fields('EV__dept_id'); // Set up virtual field value
		} else {
			$this->dept_id->VirtualValue = ""; // Clear value
		}
		$this->f0m1->setDbValue($rs->fields('f0m1'));
		$this->f0k1->setDbValue($rs->fields('f0k1'));
		$this->f1m1->setDbValue($rs->fields('f1m1'));
		$this->f1k1->setDbValue($rs->fields('f1k1'));
		$this->f2m1->setDbValue($rs->fields('f2m1'));
		$this->f2k1->setDbValue($rs->fields('f2k1'));
		$this->f3m1->setDbValue($rs->fields('f3m1'));
		$this->f3k1->setDbValue($rs->fields('f3k1'));
		$this->f4m1->setDbValue($rs->fields('f4m1'));
		$this->f4k1->setDbValue($rs->fields('f4k1'));
		$this->f5m1->setDbValue($rs->fields('f5m1'));
		$this->f5k1->setDbValue($rs->fields('f5k1'));
		$this->f6m1->setDbValue($rs->fields('f6m1'));
		$this->f6k1->setDbValue($rs->fields('f6k1'));
		$this->f0m2->setDbValue($rs->fields('f0m2'));
		$this->f0k2->setDbValue($rs->fields('f0k2'));
		$this->f1m2->setDbValue($rs->fields('f1m2'));
		$this->f1k2->setDbValue($rs->fields('f1k2'));
		$this->f2m2->setDbValue($rs->fields('f2m2'));
		$this->f2k2->setDbValue($rs->fields('f2k2'));
		$this->f3m2->setDbValue($rs->fields('f3m2'));
		$this->f3k2->setDbValue($rs->fields('f3k2'));
		$this->f4m2->setDbValue($rs->fields('f4m2'));
		$this->f4k2->setDbValue($rs->fields('f4k2'));
		$this->f5m2->setDbValue($rs->fields('f5m2'));
		$this->f5k2->setDbValue($rs->fields('f5k2'));
		$this->f6m2->setDbValue($rs->fields('f6m2'));
		$this->f6k2->setDbValue($rs->fields('f6k2'));
		$this->f0m3->setDbValue($rs->fields('f0m3'));
		$this->f0k3->setDbValue($rs->fields('f0k3'));
		$this->f1m3->setDbValue($rs->fields('f1m3'));
		$this->f1k3->setDbValue($rs->fields('f1k3'));
		$this->f2m3->setDbValue($rs->fields('f2m3'));
		$this->f2k3->setDbValue($rs->fields('f2k3'));
		$this->f3m3->setDbValue($rs->fields('f3m3'));
		$this->f3k3->setDbValue($rs->fields('f3k3'));
		$this->f4m3->setDbValue($rs->fields('f4m3'));
		$this->f4k3->setDbValue($rs->fields('f4k3'));
		$this->f5m3->setDbValue($rs->fields('f5m3'));
		$this->f5k3->setDbValue($rs->fields('f5k3'));
		$this->f6m3->setDbValue($rs->fields('f6m3'));
		$this->f6k3->setDbValue($rs->fields('f6k3'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->pd_id->DbValue = $row['pd_id'];
		$this->pegawai_id->DbValue = $row['pegawai_id'];
		$this->dept_id->DbValue = $row['dept_id'];
		$this->f0m1->DbValue = $row['f0m1'];
		$this->f0k1->DbValue = $row['f0k1'];
		$this->f1m1->DbValue = $row['f1m1'];
		$this->f1k1->DbValue = $row['f1k1'];
		$this->f2m1->DbValue = $row['f2m1'];
		$this->f2k1->DbValue = $row['f2k1'];
		$this->f3m1->DbValue = $row['f3m1'];
		$this->f3k1->DbValue = $row['f3k1'];
		$this->f4m1->DbValue = $row['f4m1'];
		$this->f4k1->DbValue = $row['f4k1'];
		$this->f5m1->DbValue = $row['f5m1'];
		$this->f5k1->DbValue = $row['f5k1'];
		$this->f6m1->DbValue = $row['f6m1'];
		$this->f6k1->DbValue = $row['f6k1'];
		$this->f0m2->DbValue = $row['f0m2'];
		$this->f0k2->DbValue = $row['f0k2'];
		$this->f1m2->DbValue = $row['f1m2'];
		$this->f1k2->DbValue = $row['f1k2'];
		$this->f2m2->DbValue = $row['f2m2'];
		$this->f2k2->DbValue = $row['f2k2'];
		$this->f3m2->DbValue = $row['f3m2'];
		$this->f3k2->DbValue = $row['f3k2'];
		$this->f4m2->DbValue = $row['f4m2'];
		$this->f4k2->DbValue = $row['f4k2'];
		$this->f5m2->DbValue = $row['f5m2'];
		$this->f5k2->DbValue = $row['f5k2'];
		$this->f6m2->DbValue = $row['f6m2'];
		$this->f6k2->DbValue = $row['f6k2'];
		$this->f0m3->DbValue = $row['f0m3'];
		$this->f0k3->DbValue = $row['f0k3'];
		$this->f1m3->DbValue = $row['f1m3'];
		$this->f1k3->DbValue = $row['f1k3'];
		$this->f2m3->DbValue = $row['f2m3'];
		$this->f2k3->DbValue = $row['f2k3'];
		$this->f3m3->DbValue = $row['f3m3'];
		$this->f3k3->DbValue = $row['f3k3'];
		$this->f4m3->DbValue = $row['f4m3'];
		$this->f4k3->DbValue = $row['f4k3'];
		$this->f5m3->DbValue = $row['f5m3'];
		$this->f5k3->DbValue = $row['f5k3'];
		$this->f6m3->DbValue = $row['f6m3'];
		$this->f6k3->DbValue = $row['f6k3'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("pd_id")) <> "")
			$this->pd_id->CurrentValue = $this->getKey("pd_id"); // pd_id
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
		// pd_id
		// pegawai_id
		// dept_id
		// f0m1
		// f0k1
		// f1m1
		// f1k1
		// f2m1
		// f2k1
		// f3m1
		// f3k1
		// f4m1
		// f4k1
		// f5m1
		// f5k1
		// f6m1
		// f6k1
		// f0m2
		// f0k2
		// f1m2
		// f1k2
		// f2m2
		// f2k2
		// f3m2
		// f3k2
		// f4m2
		// f4k2
		// f5m2
		// f5k2
		// f6m2
		// f6k2
		// f0m3
		// f0k3
		// f1m3
		// f1k3
		// f2m3
		// f2k3
		// f3m3
		// f3k3
		// f4m3
		// f4k3
		// f5m3
		// f5k3
		// f6m3
		// f6k3

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// pd_id
		$this->pd_id->ViewValue = $this->pd_id->CurrentValue;
		$this->pd_id->ViewCustomAttributes = "";

		// pegawai_id
		if ($this->pegawai_id->VirtualValue <> "") {
			$this->pegawai_id->ViewValue = $this->pegawai_id->VirtualValue;
		} else {
			$this->pegawai_id->ViewValue = $this->pegawai_id->CurrentValue;
		if (strval($this->pegawai_id->CurrentValue) <> "") {
			$sFilterWrk = "`pegawai_id`" . ew_SearchString("=", $this->pegawai_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `pegawai_id`, `pegawai_nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `pegawai`";
		$sWhereWrk = "";
		$this->pegawai_id->LookupFilters = array("dx1" => '`pegawai_nama`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->pegawai_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->pegawai_id->ViewValue = $this->pegawai_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->pegawai_id->ViewValue = $this->pegawai_id->CurrentValue;
			}
		} else {
			$this->pegawai_id->ViewValue = NULL;
		}
		}
		$this->pegawai_id->ViewCustomAttributes = "";

		// dept_id
		if ($this->dept_id->VirtualValue <> "") {
			$this->dept_id->ViewValue = $this->dept_id->VirtualValue;
		} else {
			$this->dept_id->ViewValue = $this->dept_id->CurrentValue;
		if (strval($this->dept_id->CurrentValue) <> "") {
			$sFilterWrk = "`pembagian2_id`" . ew_SearchString("=", $this->dept_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `pembagian2_id`, `pembagian2_nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `pembagian2`";
		$sWhereWrk = "";
		$this->dept_id->LookupFilters = array("dx1" => '`pembagian2_nama`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->dept_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->dept_id->ViewValue = $this->dept_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->dept_id->ViewValue = $this->dept_id->CurrentValue;
			}
		} else {
			$this->dept_id->ViewValue = NULL;
		}
		}
		$this->dept_id->ViewCustomAttributes = "";

		// f0m1
		$this->f0m1->ViewValue = $this->f0m1->CurrentValue;
		$this->f0m1->ViewCustomAttributes = "";

		// f0k1
		$this->f0k1->ViewValue = $this->f0k1->CurrentValue;
		$this->f0k1->ViewCustomAttributes = "";

		// f1m1
		$this->f1m1->ViewValue = $this->f1m1->CurrentValue;
		$this->f1m1->ViewCustomAttributes = "";

		// f1k1
		$this->f1k1->ViewValue = $this->f1k1->CurrentValue;
		$this->f1k1->ViewCustomAttributes = "";

		// f2m1
		$this->f2m1->ViewValue = $this->f2m1->CurrentValue;
		$this->f2m1->ViewCustomAttributes = "";

		// f2k1
		$this->f2k1->ViewValue = $this->f2k1->CurrentValue;
		$this->f2k1->ViewCustomAttributes = "";

		// f3m1
		$this->f3m1->ViewValue = $this->f3m1->CurrentValue;
		$this->f3m1->ViewCustomAttributes = "";

		// f3k1
		$this->f3k1->ViewValue = $this->f3k1->CurrentValue;
		$this->f3k1->ViewCustomAttributes = "";

		// f4m1
		$this->f4m1->ViewValue = $this->f4m1->CurrentValue;
		$this->f4m1->ViewCustomAttributes = "";

		// f4k1
		$this->f4k1->ViewValue = $this->f4k1->CurrentValue;
		$this->f4k1->ViewCustomAttributes = "";

		// f5m1
		$this->f5m1->ViewValue = $this->f5m1->CurrentValue;
		$this->f5m1->ViewCustomAttributes = "";

		// f5k1
		$this->f5k1->ViewValue = $this->f5k1->CurrentValue;
		$this->f5k1->ViewCustomAttributes = "";

		// f6m1
		$this->f6m1->ViewValue = $this->f6m1->CurrentValue;
		$this->f6m1->ViewCustomAttributes = "";

		// f6k1
		$this->f6k1->ViewValue = $this->f6k1->CurrentValue;
		$this->f6k1->ViewCustomAttributes = "";

		// f0m2
		$this->f0m2->ViewValue = $this->f0m2->CurrentValue;
		$this->f0m2->ViewCustomAttributes = "";

		// f0k2
		$this->f0k2->ViewValue = $this->f0k2->CurrentValue;
		$this->f0k2->ViewCustomAttributes = "";

		// f1m2
		$this->f1m2->ViewValue = $this->f1m2->CurrentValue;
		$this->f1m2->ViewCustomAttributes = "";

		// f1k2
		$this->f1k2->ViewValue = $this->f1k2->CurrentValue;
		$this->f1k2->ViewCustomAttributes = "";

		// f2m2
		$this->f2m2->ViewValue = $this->f2m2->CurrentValue;
		$this->f2m2->ViewCustomAttributes = "";

		// f2k2
		$this->f2k2->ViewValue = $this->f2k2->CurrentValue;
		$this->f2k2->ViewCustomAttributes = "";

		// f3m2
		$this->f3m2->ViewValue = $this->f3m2->CurrentValue;
		$this->f3m2->ViewCustomAttributes = "";

		// f3k2
		$this->f3k2->ViewValue = $this->f3k2->CurrentValue;
		$this->f3k2->ViewCustomAttributes = "";

		// f4m2
		$this->f4m2->ViewValue = $this->f4m2->CurrentValue;
		$this->f4m2->ViewCustomAttributes = "";

		// f4k2
		$this->f4k2->ViewValue = $this->f4k2->CurrentValue;
		$this->f4k2->ViewCustomAttributes = "";

		// f5m2
		$this->f5m2->ViewValue = $this->f5m2->CurrentValue;
		$this->f5m2->ViewCustomAttributes = "";

		// f5k2
		$this->f5k2->ViewValue = $this->f5k2->CurrentValue;
		$this->f5k2->ViewCustomAttributes = "";

		// f6m2
		$this->f6m2->ViewValue = $this->f6m2->CurrentValue;
		$this->f6m2->ViewCustomAttributes = "";

		// f6k2
		$this->f6k2->ViewValue = $this->f6k2->CurrentValue;
		$this->f6k2->ViewCustomAttributes = "";

		// f0m3
		$this->f0m3->ViewValue = $this->f0m3->CurrentValue;
		$this->f0m3->ViewCustomAttributes = "";

		// f0k3
		$this->f0k3->ViewValue = $this->f0k3->CurrentValue;
		$this->f0k3->ViewCustomAttributes = "";

		// f1m3
		$this->f1m3->ViewValue = $this->f1m3->CurrentValue;
		$this->f1m3->ViewCustomAttributes = "";

		// f1k3
		$this->f1k3->ViewValue = $this->f1k3->CurrentValue;
		$this->f1k3->ViewCustomAttributes = "";

		// f2m3
		$this->f2m3->ViewValue = $this->f2m3->CurrentValue;
		$this->f2m3->ViewCustomAttributes = "";

		// f2k3
		$this->f2k3->ViewValue = $this->f2k3->CurrentValue;
		$this->f2k3->ViewCustomAttributes = "";

		// f3m3
		$this->f3m3->ViewValue = $this->f3m3->CurrentValue;
		$this->f3m3->ViewCustomAttributes = "";

		// f3k3
		$this->f3k3->ViewValue = $this->f3k3->CurrentValue;
		$this->f3k3->ViewCustomAttributes = "";

		// f4m3
		$this->f4m3->ViewValue = $this->f4m3->CurrentValue;
		$this->f4m3->ViewCustomAttributes = "";

		// f4k3
		$this->f4k3->ViewValue = $this->f4k3->CurrentValue;
		$this->f4k3->ViewCustomAttributes = "";

		// f5m3
		$this->f5m3->ViewValue = $this->f5m3->CurrentValue;
		$this->f5m3->ViewCustomAttributes = "";

		// f5k3
		$this->f5k3->ViewValue = $this->f5k3->CurrentValue;
		$this->f5k3->ViewCustomAttributes = "";

		// f6m3
		$this->f6m3->ViewValue = $this->f6m3->CurrentValue;
		$this->f6m3->ViewCustomAttributes = "";

		// f6k3
		$this->f6k3->ViewValue = $this->f6k3->CurrentValue;
		$this->f6k3->ViewCustomAttributes = "";

			// pegawai_id
			$this->pegawai_id->LinkCustomAttributes = "";
			$this->pegawai_id->HrefValue = "";
			$this->pegawai_id->TooltipValue = "";

			// dept_id
			$this->dept_id->LinkCustomAttributes = "";
			$this->dept_id->HrefValue = "";
			$this->dept_id->TooltipValue = "";

			// f0m1
			$this->f0m1->LinkCustomAttributes = "";
			$this->f0m1->HrefValue = "";
			$this->f0m1->TooltipValue = "";

			// f0k1
			$this->f0k1->LinkCustomAttributes = "";
			$this->f0k1->HrefValue = "";
			$this->f0k1->TooltipValue = "";

			// f1m1
			$this->f1m1->LinkCustomAttributes = "";
			$this->f1m1->HrefValue = "";
			$this->f1m1->TooltipValue = "";

			// f1k1
			$this->f1k1->LinkCustomAttributes = "";
			$this->f1k1->HrefValue = "";
			$this->f1k1->TooltipValue = "";

			// f2m1
			$this->f2m1->LinkCustomAttributes = "";
			$this->f2m1->HrefValue = "";
			$this->f2m1->TooltipValue = "";

			// f2k1
			$this->f2k1->LinkCustomAttributes = "";
			$this->f2k1->HrefValue = "";
			$this->f2k1->TooltipValue = "";

			// f3m1
			$this->f3m1->LinkCustomAttributes = "";
			$this->f3m1->HrefValue = "";
			$this->f3m1->TooltipValue = "";

			// f3k1
			$this->f3k1->LinkCustomAttributes = "";
			$this->f3k1->HrefValue = "";
			$this->f3k1->TooltipValue = "";

			// f4m1
			$this->f4m1->LinkCustomAttributes = "";
			$this->f4m1->HrefValue = "";
			$this->f4m1->TooltipValue = "";

			// f4k1
			$this->f4k1->LinkCustomAttributes = "";
			$this->f4k1->HrefValue = "";
			$this->f4k1->TooltipValue = "";

			// f5m1
			$this->f5m1->LinkCustomAttributes = "";
			$this->f5m1->HrefValue = "";
			$this->f5m1->TooltipValue = "";

			// f5k1
			$this->f5k1->LinkCustomAttributes = "";
			$this->f5k1->HrefValue = "";
			$this->f5k1->TooltipValue = "";

			// f6m1
			$this->f6m1->LinkCustomAttributes = "";
			$this->f6m1->HrefValue = "";
			$this->f6m1->TooltipValue = "";

			// f6k1
			$this->f6k1->LinkCustomAttributes = "";
			$this->f6k1->HrefValue = "";
			$this->f6k1->TooltipValue = "";

			// f0m2
			$this->f0m2->LinkCustomAttributes = "";
			$this->f0m2->HrefValue = "";
			$this->f0m2->TooltipValue = "";

			// f0k2
			$this->f0k2->LinkCustomAttributes = "";
			$this->f0k2->HrefValue = "";
			$this->f0k2->TooltipValue = "";

			// f1m2
			$this->f1m2->LinkCustomAttributes = "";
			$this->f1m2->HrefValue = "";
			$this->f1m2->TooltipValue = "";

			// f1k2
			$this->f1k2->LinkCustomAttributes = "";
			$this->f1k2->HrefValue = "";
			$this->f1k2->TooltipValue = "";

			// f2m2
			$this->f2m2->LinkCustomAttributes = "";
			$this->f2m2->HrefValue = "";
			$this->f2m2->TooltipValue = "";

			// f2k2
			$this->f2k2->LinkCustomAttributes = "";
			$this->f2k2->HrefValue = "";
			$this->f2k2->TooltipValue = "";

			// f3m2
			$this->f3m2->LinkCustomAttributes = "";
			$this->f3m2->HrefValue = "";
			$this->f3m2->TooltipValue = "";

			// f3k2
			$this->f3k2->LinkCustomAttributes = "";
			$this->f3k2->HrefValue = "";
			$this->f3k2->TooltipValue = "";

			// f4m2
			$this->f4m2->LinkCustomAttributes = "";
			$this->f4m2->HrefValue = "";
			$this->f4m2->TooltipValue = "";

			// f4k2
			$this->f4k2->LinkCustomAttributes = "";
			$this->f4k2->HrefValue = "";
			$this->f4k2->TooltipValue = "";

			// f5m2
			$this->f5m2->LinkCustomAttributes = "";
			$this->f5m2->HrefValue = "";
			$this->f5m2->TooltipValue = "";

			// f5k2
			$this->f5k2->LinkCustomAttributes = "";
			$this->f5k2->HrefValue = "";
			$this->f5k2->TooltipValue = "";

			// f6m2
			$this->f6m2->LinkCustomAttributes = "";
			$this->f6m2->HrefValue = "";
			$this->f6m2->TooltipValue = "";

			// f6k2
			$this->f6k2->LinkCustomAttributes = "";
			$this->f6k2->HrefValue = "";
			$this->f6k2->TooltipValue = "";

			// f0m3
			$this->f0m3->LinkCustomAttributes = "";
			$this->f0m3->HrefValue = "";
			$this->f0m3->TooltipValue = "";

			// f0k3
			$this->f0k3->LinkCustomAttributes = "";
			$this->f0k3->HrefValue = "";
			$this->f0k3->TooltipValue = "";

			// f1m3
			$this->f1m3->LinkCustomAttributes = "";
			$this->f1m3->HrefValue = "";
			$this->f1m3->TooltipValue = "";

			// f1k3
			$this->f1k3->LinkCustomAttributes = "";
			$this->f1k3->HrefValue = "";
			$this->f1k3->TooltipValue = "";

			// f2m3
			$this->f2m3->LinkCustomAttributes = "";
			$this->f2m3->HrefValue = "";
			$this->f2m3->TooltipValue = "";

			// f2k3
			$this->f2k3->LinkCustomAttributes = "";
			$this->f2k3->HrefValue = "";
			$this->f2k3->TooltipValue = "";

			// f3m3
			$this->f3m3->LinkCustomAttributes = "";
			$this->f3m3->HrefValue = "";
			$this->f3m3->TooltipValue = "";

			// f3k3
			$this->f3k3->LinkCustomAttributes = "";
			$this->f3k3->HrefValue = "";
			$this->f3k3->TooltipValue = "";

			// f4m3
			$this->f4m3->LinkCustomAttributes = "";
			$this->f4m3->HrefValue = "";
			$this->f4m3->TooltipValue = "";

			// f4k3
			$this->f4k3->LinkCustomAttributes = "";
			$this->f4k3->HrefValue = "";
			$this->f4k3->TooltipValue = "";

			// f5m3
			$this->f5m3->LinkCustomAttributes = "";
			$this->f5m3->HrefValue = "";
			$this->f5m3->TooltipValue = "";

			// f5k3
			$this->f5k3->LinkCustomAttributes = "";
			$this->f5k3->HrefValue = "";
			$this->f5k3->TooltipValue = "";

			// f6m3
			$this->f6m3->LinkCustomAttributes = "";
			$this->f6m3->HrefValue = "";
			$this->f6m3->TooltipValue = "";

			// f6k3
			$this->f6k3->LinkCustomAttributes = "";
			$this->f6k3->HrefValue = "";
			$this->f6k3->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// pegawai_id
			$this->pegawai_id->EditAttrs["class"] = "form-control";
			$this->pegawai_id->EditCustomAttributes = "";
			$this->pegawai_id->EditValue = ew_HtmlEncode($this->pegawai_id->CurrentValue);
			if (strval($this->pegawai_id->CurrentValue) <> "") {
				$sFilterWrk = "`pegawai_id`" . ew_SearchString("=", $this->pegawai_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `pegawai_id`, `pegawai_nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `pegawai`";
			$sWhereWrk = "";
			$this->pegawai_id->LookupFilters = array("dx1" => '`pegawai_nama`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->pegawai_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
					$this->pegawai_id->EditValue = $this->pegawai_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->pegawai_id->EditValue = ew_HtmlEncode($this->pegawai_id->CurrentValue);
				}
			} else {
				$this->pegawai_id->EditValue = NULL;
			}
			$this->pegawai_id->PlaceHolder = ew_RemoveHtml($this->pegawai_id->FldCaption());

			// dept_id
			$this->dept_id->EditAttrs["class"] = "form-control";
			$this->dept_id->EditCustomAttributes = "";
			$this->dept_id->EditValue = ew_HtmlEncode($this->dept_id->CurrentValue);
			if (strval($this->dept_id->CurrentValue) <> "") {
				$sFilterWrk = "`pembagian2_id`" . ew_SearchString("=", $this->dept_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `pembagian2_id`, `pembagian2_nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `pembagian2`";
			$sWhereWrk = "";
			$this->dept_id->LookupFilters = array("dx1" => '`pembagian2_nama`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->dept_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
					$this->dept_id->EditValue = $this->dept_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->dept_id->EditValue = ew_HtmlEncode($this->dept_id->CurrentValue);
				}
			} else {
				$this->dept_id->EditValue = NULL;
			}
			$this->dept_id->PlaceHolder = ew_RemoveHtml($this->dept_id->FldCaption());

			// f0m1
			$this->f0m1->EditAttrs["class"] = "form-control";
			$this->f0m1->EditCustomAttributes = "";
			$this->f0m1->EditValue = ew_HtmlEncode($this->f0m1->CurrentValue);
			$this->f0m1->PlaceHolder = ew_RemoveHtml($this->f0m1->FldCaption());

			// f0k1
			$this->f0k1->EditAttrs["class"] = "form-control";
			$this->f0k1->EditCustomAttributes = "";
			$this->f0k1->EditValue = ew_HtmlEncode($this->f0k1->CurrentValue);
			$this->f0k1->PlaceHolder = ew_RemoveHtml($this->f0k1->FldCaption());

			// f1m1
			$this->f1m1->EditAttrs["class"] = "form-control";
			$this->f1m1->EditCustomAttributes = "";
			$this->f1m1->EditValue = ew_HtmlEncode($this->f1m1->CurrentValue);
			$this->f1m1->PlaceHolder = ew_RemoveHtml($this->f1m1->FldCaption());

			// f1k1
			$this->f1k1->EditAttrs["class"] = "form-control";
			$this->f1k1->EditCustomAttributes = "";
			$this->f1k1->EditValue = ew_HtmlEncode($this->f1k1->CurrentValue);
			$this->f1k1->PlaceHolder = ew_RemoveHtml($this->f1k1->FldCaption());

			// f2m1
			$this->f2m1->EditAttrs["class"] = "form-control";
			$this->f2m1->EditCustomAttributes = "";
			$this->f2m1->EditValue = ew_HtmlEncode($this->f2m1->CurrentValue);
			$this->f2m1->PlaceHolder = ew_RemoveHtml($this->f2m1->FldCaption());

			// f2k1
			$this->f2k1->EditAttrs["class"] = "form-control";
			$this->f2k1->EditCustomAttributes = "";
			$this->f2k1->EditValue = ew_HtmlEncode($this->f2k1->CurrentValue);
			$this->f2k1->PlaceHolder = ew_RemoveHtml($this->f2k1->FldCaption());

			// f3m1
			$this->f3m1->EditAttrs["class"] = "form-control";
			$this->f3m1->EditCustomAttributes = "";
			$this->f3m1->EditValue = ew_HtmlEncode($this->f3m1->CurrentValue);
			$this->f3m1->PlaceHolder = ew_RemoveHtml($this->f3m1->FldCaption());

			// f3k1
			$this->f3k1->EditAttrs["class"] = "form-control";
			$this->f3k1->EditCustomAttributes = "";
			$this->f3k1->EditValue = ew_HtmlEncode($this->f3k1->CurrentValue);
			$this->f3k1->PlaceHolder = ew_RemoveHtml($this->f3k1->FldCaption());

			// f4m1
			$this->f4m1->EditAttrs["class"] = "form-control";
			$this->f4m1->EditCustomAttributes = "";
			$this->f4m1->EditValue = ew_HtmlEncode($this->f4m1->CurrentValue);
			$this->f4m1->PlaceHolder = ew_RemoveHtml($this->f4m1->FldCaption());

			// f4k1
			$this->f4k1->EditAttrs["class"] = "form-control";
			$this->f4k1->EditCustomAttributes = "";
			$this->f4k1->EditValue = ew_HtmlEncode($this->f4k1->CurrentValue);
			$this->f4k1->PlaceHolder = ew_RemoveHtml($this->f4k1->FldCaption());

			// f5m1
			$this->f5m1->EditAttrs["class"] = "form-control";
			$this->f5m1->EditCustomAttributes = "";
			$this->f5m1->EditValue = ew_HtmlEncode($this->f5m1->CurrentValue);
			$this->f5m1->PlaceHolder = ew_RemoveHtml($this->f5m1->FldCaption());

			// f5k1
			$this->f5k1->EditAttrs["class"] = "form-control";
			$this->f5k1->EditCustomAttributes = "";
			$this->f5k1->EditValue = ew_HtmlEncode($this->f5k1->CurrentValue);
			$this->f5k1->PlaceHolder = ew_RemoveHtml($this->f5k1->FldCaption());

			// f6m1
			$this->f6m1->EditAttrs["class"] = "form-control";
			$this->f6m1->EditCustomAttributes = "";
			$this->f6m1->EditValue = ew_HtmlEncode($this->f6m1->CurrentValue);
			$this->f6m1->PlaceHolder = ew_RemoveHtml($this->f6m1->FldCaption());

			// f6k1
			$this->f6k1->EditAttrs["class"] = "form-control";
			$this->f6k1->EditCustomAttributes = "";
			$this->f6k1->EditValue = ew_HtmlEncode($this->f6k1->CurrentValue);
			$this->f6k1->PlaceHolder = ew_RemoveHtml($this->f6k1->FldCaption());

			// f0m2
			$this->f0m2->EditAttrs["class"] = "form-control";
			$this->f0m2->EditCustomAttributes = "";
			$this->f0m2->EditValue = ew_HtmlEncode($this->f0m2->CurrentValue);
			$this->f0m2->PlaceHolder = ew_RemoveHtml($this->f0m2->FldCaption());

			// f0k2
			$this->f0k2->EditAttrs["class"] = "form-control";
			$this->f0k2->EditCustomAttributes = "";
			$this->f0k2->EditValue = ew_HtmlEncode($this->f0k2->CurrentValue);
			$this->f0k2->PlaceHolder = ew_RemoveHtml($this->f0k2->FldCaption());

			// f1m2
			$this->f1m2->EditAttrs["class"] = "form-control";
			$this->f1m2->EditCustomAttributes = "";
			$this->f1m2->EditValue = ew_HtmlEncode($this->f1m2->CurrentValue);
			$this->f1m2->PlaceHolder = ew_RemoveHtml($this->f1m2->FldCaption());

			// f1k2
			$this->f1k2->EditAttrs["class"] = "form-control";
			$this->f1k2->EditCustomAttributes = "";
			$this->f1k2->EditValue = ew_HtmlEncode($this->f1k2->CurrentValue);
			$this->f1k2->PlaceHolder = ew_RemoveHtml($this->f1k2->FldCaption());

			// f2m2
			$this->f2m2->EditAttrs["class"] = "form-control";
			$this->f2m2->EditCustomAttributes = "";
			$this->f2m2->EditValue = ew_HtmlEncode($this->f2m2->CurrentValue);
			$this->f2m2->PlaceHolder = ew_RemoveHtml($this->f2m2->FldCaption());

			// f2k2
			$this->f2k2->EditAttrs["class"] = "form-control";
			$this->f2k2->EditCustomAttributes = "";
			$this->f2k2->EditValue = ew_HtmlEncode($this->f2k2->CurrentValue);
			$this->f2k2->PlaceHolder = ew_RemoveHtml($this->f2k2->FldCaption());

			// f3m2
			$this->f3m2->EditAttrs["class"] = "form-control";
			$this->f3m2->EditCustomAttributes = "";
			$this->f3m2->EditValue = ew_HtmlEncode($this->f3m2->CurrentValue);
			$this->f3m2->PlaceHolder = ew_RemoveHtml($this->f3m2->FldCaption());

			// f3k2
			$this->f3k2->EditAttrs["class"] = "form-control";
			$this->f3k2->EditCustomAttributes = "";
			$this->f3k2->EditValue = ew_HtmlEncode($this->f3k2->CurrentValue);
			$this->f3k2->PlaceHolder = ew_RemoveHtml($this->f3k2->FldCaption());

			// f4m2
			$this->f4m2->EditAttrs["class"] = "form-control";
			$this->f4m2->EditCustomAttributes = "";
			$this->f4m2->EditValue = ew_HtmlEncode($this->f4m2->CurrentValue);
			$this->f4m2->PlaceHolder = ew_RemoveHtml($this->f4m2->FldCaption());

			// f4k2
			$this->f4k2->EditAttrs["class"] = "form-control";
			$this->f4k2->EditCustomAttributes = "";
			$this->f4k2->EditValue = ew_HtmlEncode($this->f4k2->CurrentValue);
			$this->f4k2->PlaceHolder = ew_RemoveHtml($this->f4k2->FldCaption());

			// f5m2
			$this->f5m2->EditAttrs["class"] = "form-control";
			$this->f5m2->EditCustomAttributes = "";
			$this->f5m2->EditValue = ew_HtmlEncode($this->f5m2->CurrentValue);
			$this->f5m2->PlaceHolder = ew_RemoveHtml($this->f5m2->FldCaption());

			// f5k2
			$this->f5k2->EditAttrs["class"] = "form-control";
			$this->f5k2->EditCustomAttributes = "";
			$this->f5k2->EditValue = ew_HtmlEncode($this->f5k2->CurrentValue);
			$this->f5k2->PlaceHolder = ew_RemoveHtml($this->f5k2->FldCaption());

			// f6m2
			$this->f6m2->EditAttrs["class"] = "form-control";
			$this->f6m2->EditCustomAttributes = "";
			$this->f6m2->EditValue = ew_HtmlEncode($this->f6m2->CurrentValue);
			$this->f6m2->PlaceHolder = ew_RemoveHtml($this->f6m2->FldCaption());

			// f6k2
			$this->f6k2->EditAttrs["class"] = "form-control";
			$this->f6k2->EditCustomAttributes = "";
			$this->f6k2->EditValue = ew_HtmlEncode($this->f6k2->CurrentValue);
			$this->f6k2->PlaceHolder = ew_RemoveHtml($this->f6k2->FldCaption());

			// f0m3
			$this->f0m3->EditAttrs["class"] = "form-control";
			$this->f0m3->EditCustomAttributes = "";
			$this->f0m3->EditValue = ew_HtmlEncode($this->f0m3->CurrentValue);
			$this->f0m3->PlaceHolder = ew_RemoveHtml($this->f0m3->FldCaption());

			// f0k3
			$this->f0k3->EditAttrs["class"] = "form-control";
			$this->f0k3->EditCustomAttributes = "";
			$this->f0k3->EditValue = ew_HtmlEncode($this->f0k3->CurrentValue);
			$this->f0k3->PlaceHolder = ew_RemoveHtml($this->f0k3->FldCaption());

			// f1m3
			$this->f1m3->EditAttrs["class"] = "form-control";
			$this->f1m3->EditCustomAttributes = "";
			$this->f1m3->EditValue = ew_HtmlEncode($this->f1m3->CurrentValue);
			$this->f1m3->PlaceHolder = ew_RemoveHtml($this->f1m3->FldCaption());

			// f1k3
			$this->f1k3->EditAttrs["class"] = "form-control";
			$this->f1k3->EditCustomAttributes = "";
			$this->f1k3->EditValue = ew_HtmlEncode($this->f1k3->CurrentValue);
			$this->f1k3->PlaceHolder = ew_RemoveHtml($this->f1k3->FldCaption());

			// f2m3
			$this->f2m3->EditAttrs["class"] = "form-control";
			$this->f2m3->EditCustomAttributes = "";
			$this->f2m3->EditValue = ew_HtmlEncode($this->f2m3->CurrentValue);
			$this->f2m3->PlaceHolder = ew_RemoveHtml($this->f2m3->FldCaption());

			// f2k3
			$this->f2k3->EditAttrs["class"] = "form-control";
			$this->f2k3->EditCustomAttributes = "";
			$this->f2k3->EditValue = ew_HtmlEncode($this->f2k3->CurrentValue);
			$this->f2k3->PlaceHolder = ew_RemoveHtml($this->f2k3->FldCaption());

			// f3m3
			$this->f3m3->EditAttrs["class"] = "form-control";
			$this->f3m3->EditCustomAttributes = "";
			$this->f3m3->EditValue = ew_HtmlEncode($this->f3m3->CurrentValue);
			$this->f3m3->PlaceHolder = ew_RemoveHtml($this->f3m3->FldCaption());

			// f3k3
			$this->f3k3->EditAttrs["class"] = "form-control";
			$this->f3k3->EditCustomAttributes = "";
			$this->f3k3->EditValue = ew_HtmlEncode($this->f3k3->CurrentValue);
			$this->f3k3->PlaceHolder = ew_RemoveHtml($this->f3k3->FldCaption());

			// f4m3
			$this->f4m3->EditAttrs["class"] = "form-control";
			$this->f4m3->EditCustomAttributes = "";
			$this->f4m3->EditValue = ew_HtmlEncode($this->f4m3->CurrentValue);
			$this->f4m3->PlaceHolder = ew_RemoveHtml($this->f4m3->FldCaption());

			// f4k3
			$this->f4k3->EditAttrs["class"] = "form-control";
			$this->f4k3->EditCustomAttributes = "";
			$this->f4k3->EditValue = ew_HtmlEncode($this->f4k3->CurrentValue);
			$this->f4k3->PlaceHolder = ew_RemoveHtml($this->f4k3->FldCaption());

			// f5m3
			$this->f5m3->EditAttrs["class"] = "form-control";
			$this->f5m3->EditCustomAttributes = "";
			$this->f5m3->EditValue = ew_HtmlEncode($this->f5m3->CurrentValue);
			$this->f5m3->PlaceHolder = ew_RemoveHtml($this->f5m3->FldCaption());

			// f5k3
			$this->f5k3->EditAttrs["class"] = "form-control";
			$this->f5k3->EditCustomAttributes = "";
			$this->f5k3->EditValue = ew_HtmlEncode($this->f5k3->CurrentValue);
			$this->f5k3->PlaceHolder = ew_RemoveHtml($this->f5k3->FldCaption());

			// f6m3
			$this->f6m3->EditAttrs["class"] = "form-control";
			$this->f6m3->EditCustomAttributes = "";
			$this->f6m3->EditValue = ew_HtmlEncode($this->f6m3->CurrentValue);
			$this->f6m3->PlaceHolder = ew_RemoveHtml($this->f6m3->FldCaption());

			// f6k3
			$this->f6k3->EditAttrs["class"] = "form-control";
			$this->f6k3->EditCustomAttributes = "";
			$this->f6k3->EditValue = ew_HtmlEncode($this->f6k3->CurrentValue);
			$this->f6k3->PlaceHolder = ew_RemoveHtml($this->f6k3->FldCaption());

			// Add refer script
			// pegawai_id

			$this->pegawai_id->LinkCustomAttributes = "";
			$this->pegawai_id->HrefValue = "";

			// dept_id
			$this->dept_id->LinkCustomAttributes = "";
			$this->dept_id->HrefValue = "";

			// f0m1
			$this->f0m1->LinkCustomAttributes = "";
			$this->f0m1->HrefValue = "";

			// f0k1
			$this->f0k1->LinkCustomAttributes = "";
			$this->f0k1->HrefValue = "";

			// f1m1
			$this->f1m1->LinkCustomAttributes = "";
			$this->f1m1->HrefValue = "";

			// f1k1
			$this->f1k1->LinkCustomAttributes = "";
			$this->f1k1->HrefValue = "";

			// f2m1
			$this->f2m1->LinkCustomAttributes = "";
			$this->f2m1->HrefValue = "";

			// f2k1
			$this->f2k1->LinkCustomAttributes = "";
			$this->f2k1->HrefValue = "";

			// f3m1
			$this->f3m1->LinkCustomAttributes = "";
			$this->f3m1->HrefValue = "";

			// f3k1
			$this->f3k1->LinkCustomAttributes = "";
			$this->f3k1->HrefValue = "";

			// f4m1
			$this->f4m1->LinkCustomAttributes = "";
			$this->f4m1->HrefValue = "";

			// f4k1
			$this->f4k1->LinkCustomAttributes = "";
			$this->f4k1->HrefValue = "";

			// f5m1
			$this->f5m1->LinkCustomAttributes = "";
			$this->f5m1->HrefValue = "";

			// f5k1
			$this->f5k1->LinkCustomAttributes = "";
			$this->f5k1->HrefValue = "";

			// f6m1
			$this->f6m1->LinkCustomAttributes = "";
			$this->f6m1->HrefValue = "";

			// f6k1
			$this->f6k1->LinkCustomAttributes = "";
			$this->f6k1->HrefValue = "";

			// f0m2
			$this->f0m2->LinkCustomAttributes = "";
			$this->f0m2->HrefValue = "";

			// f0k2
			$this->f0k2->LinkCustomAttributes = "";
			$this->f0k2->HrefValue = "";

			// f1m2
			$this->f1m2->LinkCustomAttributes = "";
			$this->f1m2->HrefValue = "";

			// f1k2
			$this->f1k2->LinkCustomAttributes = "";
			$this->f1k2->HrefValue = "";

			// f2m2
			$this->f2m2->LinkCustomAttributes = "";
			$this->f2m2->HrefValue = "";

			// f2k2
			$this->f2k2->LinkCustomAttributes = "";
			$this->f2k2->HrefValue = "";

			// f3m2
			$this->f3m2->LinkCustomAttributes = "";
			$this->f3m2->HrefValue = "";

			// f3k2
			$this->f3k2->LinkCustomAttributes = "";
			$this->f3k2->HrefValue = "";

			// f4m2
			$this->f4m2->LinkCustomAttributes = "";
			$this->f4m2->HrefValue = "";

			// f4k2
			$this->f4k2->LinkCustomAttributes = "";
			$this->f4k2->HrefValue = "";

			// f5m2
			$this->f5m2->LinkCustomAttributes = "";
			$this->f5m2->HrefValue = "";

			// f5k2
			$this->f5k2->LinkCustomAttributes = "";
			$this->f5k2->HrefValue = "";

			// f6m2
			$this->f6m2->LinkCustomAttributes = "";
			$this->f6m2->HrefValue = "";

			// f6k2
			$this->f6k2->LinkCustomAttributes = "";
			$this->f6k2->HrefValue = "";

			// f0m3
			$this->f0m3->LinkCustomAttributes = "";
			$this->f0m3->HrefValue = "";

			// f0k3
			$this->f0k3->LinkCustomAttributes = "";
			$this->f0k3->HrefValue = "";

			// f1m3
			$this->f1m3->LinkCustomAttributes = "";
			$this->f1m3->HrefValue = "";

			// f1k3
			$this->f1k3->LinkCustomAttributes = "";
			$this->f1k3->HrefValue = "";

			// f2m3
			$this->f2m3->LinkCustomAttributes = "";
			$this->f2m3->HrefValue = "";

			// f2k3
			$this->f2k3->LinkCustomAttributes = "";
			$this->f2k3->HrefValue = "";

			// f3m3
			$this->f3m3->LinkCustomAttributes = "";
			$this->f3m3->HrefValue = "";

			// f3k3
			$this->f3k3->LinkCustomAttributes = "";
			$this->f3k3->HrefValue = "";

			// f4m3
			$this->f4m3->LinkCustomAttributes = "";
			$this->f4m3->HrefValue = "";

			// f4k3
			$this->f4k3->LinkCustomAttributes = "";
			$this->f4k3->HrefValue = "";

			// f5m3
			$this->f5m3->LinkCustomAttributes = "";
			$this->f5m3->HrefValue = "";

			// f5k3
			$this->f5k3->LinkCustomAttributes = "";
			$this->f5k3->HrefValue = "";

			// f6m3
			$this->f6m3->LinkCustomAttributes = "";
			$this->f6m3->HrefValue = "";

			// f6k3
			$this->f6k3->LinkCustomAttributes = "";
			$this->f6k3->HrefValue = "";
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
		if (!$this->dept_id->FldIsDetailKey && !is_null($this->dept_id->FormValue) && $this->dept_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->dept_id->FldCaption(), $this->dept_id->ReqErrMsg));
		}
		if (!$this->f0m1->FldIsDetailKey && !is_null($this->f0m1->FormValue) && $this->f0m1->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f0m1->FldCaption(), $this->f0m1->ReqErrMsg));
		}
		if (!$this->f0k1->FldIsDetailKey && !is_null($this->f0k1->FormValue) && $this->f0k1->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f0k1->FldCaption(), $this->f0k1->ReqErrMsg));
		}
		if (!$this->f1m1->FldIsDetailKey && !is_null($this->f1m1->FormValue) && $this->f1m1->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f1m1->FldCaption(), $this->f1m1->ReqErrMsg));
		}
		if (!$this->f1k1->FldIsDetailKey && !is_null($this->f1k1->FormValue) && $this->f1k1->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f1k1->FldCaption(), $this->f1k1->ReqErrMsg));
		}
		if (!$this->f2m1->FldIsDetailKey && !is_null($this->f2m1->FormValue) && $this->f2m1->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f2m1->FldCaption(), $this->f2m1->ReqErrMsg));
		}
		if (!$this->f2k1->FldIsDetailKey && !is_null($this->f2k1->FormValue) && $this->f2k1->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f2k1->FldCaption(), $this->f2k1->ReqErrMsg));
		}
		if (!$this->f3m1->FldIsDetailKey && !is_null($this->f3m1->FormValue) && $this->f3m1->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f3m1->FldCaption(), $this->f3m1->ReqErrMsg));
		}
		if (!$this->f3k1->FldIsDetailKey && !is_null($this->f3k1->FormValue) && $this->f3k1->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f3k1->FldCaption(), $this->f3k1->ReqErrMsg));
		}
		if (!$this->f4m1->FldIsDetailKey && !is_null($this->f4m1->FormValue) && $this->f4m1->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f4m1->FldCaption(), $this->f4m1->ReqErrMsg));
		}
		if (!$this->f4k1->FldIsDetailKey && !is_null($this->f4k1->FormValue) && $this->f4k1->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f4k1->FldCaption(), $this->f4k1->ReqErrMsg));
		}
		if (!$this->f5m1->FldIsDetailKey && !is_null($this->f5m1->FormValue) && $this->f5m1->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f5m1->FldCaption(), $this->f5m1->ReqErrMsg));
		}
		if (!$this->f5k1->FldIsDetailKey && !is_null($this->f5k1->FormValue) && $this->f5k1->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f5k1->FldCaption(), $this->f5k1->ReqErrMsg));
		}
		if (!$this->f6m1->FldIsDetailKey && !is_null($this->f6m1->FormValue) && $this->f6m1->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f6m1->FldCaption(), $this->f6m1->ReqErrMsg));
		}
		if (!$this->f6k1->FldIsDetailKey && !is_null($this->f6k1->FormValue) && $this->f6k1->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f6k1->FldCaption(), $this->f6k1->ReqErrMsg));
		}
		if (!$this->f0m2->FldIsDetailKey && !is_null($this->f0m2->FormValue) && $this->f0m2->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f0m2->FldCaption(), $this->f0m2->ReqErrMsg));
		}
		if (!$this->f0k2->FldIsDetailKey && !is_null($this->f0k2->FormValue) && $this->f0k2->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f0k2->FldCaption(), $this->f0k2->ReqErrMsg));
		}
		if (!$this->f1m2->FldIsDetailKey && !is_null($this->f1m2->FormValue) && $this->f1m2->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f1m2->FldCaption(), $this->f1m2->ReqErrMsg));
		}
		if (!$this->f1k2->FldIsDetailKey && !is_null($this->f1k2->FormValue) && $this->f1k2->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f1k2->FldCaption(), $this->f1k2->ReqErrMsg));
		}
		if (!$this->f2m2->FldIsDetailKey && !is_null($this->f2m2->FormValue) && $this->f2m2->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f2m2->FldCaption(), $this->f2m2->ReqErrMsg));
		}
		if (!$this->f2k2->FldIsDetailKey && !is_null($this->f2k2->FormValue) && $this->f2k2->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f2k2->FldCaption(), $this->f2k2->ReqErrMsg));
		}
		if (!$this->f3m2->FldIsDetailKey && !is_null($this->f3m2->FormValue) && $this->f3m2->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f3m2->FldCaption(), $this->f3m2->ReqErrMsg));
		}
		if (!$this->f3k2->FldIsDetailKey && !is_null($this->f3k2->FormValue) && $this->f3k2->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f3k2->FldCaption(), $this->f3k2->ReqErrMsg));
		}
		if (!$this->f4m2->FldIsDetailKey && !is_null($this->f4m2->FormValue) && $this->f4m2->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f4m2->FldCaption(), $this->f4m2->ReqErrMsg));
		}
		if (!$this->f4k2->FldIsDetailKey && !is_null($this->f4k2->FormValue) && $this->f4k2->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f4k2->FldCaption(), $this->f4k2->ReqErrMsg));
		}
		if (!$this->f5m2->FldIsDetailKey && !is_null($this->f5m2->FormValue) && $this->f5m2->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f5m2->FldCaption(), $this->f5m2->ReqErrMsg));
		}
		if (!$this->f5k2->FldIsDetailKey && !is_null($this->f5k2->FormValue) && $this->f5k2->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f5k2->FldCaption(), $this->f5k2->ReqErrMsg));
		}
		if (!$this->f6m2->FldIsDetailKey && !is_null($this->f6m2->FormValue) && $this->f6m2->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f6m2->FldCaption(), $this->f6m2->ReqErrMsg));
		}
		if (!$this->f6k2->FldIsDetailKey && !is_null($this->f6k2->FormValue) && $this->f6k2->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f6k2->FldCaption(), $this->f6k2->ReqErrMsg));
		}
		if (!$this->f0m3->FldIsDetailKey && !is_null($this->f0m3->FormValue) && $this->f0m3->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f0m3->FldCaption(), $this->f0m3->ReqErrMsg));
		}
		if (!$this->f0k3->FldIsDetailKey && !is_null($this->f0k3->FormValue) && $this->f0k3->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f0k3->FldCaption(), $this->f0k3->ReqErrMsg));
		}
		if (!$this->f1m3->FldIsDetailKey && !is_null($this->f1m3->FormValue) && $this->f1m3->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f1m3->FldCaption(), $this->f1m3->ReqErrMsg));
		}
		if (!$this->f1k3->FldIsDetailKey && !is_null($this->f1k3->FormValue) && $this->f1k3->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f1k3->FldCaption(), $this->f1k3->ReqErrMsg));
		}
		if (!$this->f2m3->FldIsDetailKey && !is_null($this->f2m3->FormValue) && $this->f2m3->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f2m3->FldCaption(), $this->f2m3->ReqErrMsg));
		}
		if (!$this->f2k3->FldIsDetailKey && !is_null($this->f2k3->FormValue) && $this->f2k3->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f2k3->FldCaption(), $this->f2k3->ReqErrMsg));
		}
		if (!$this->f3m3->FldIsDetailKey && !is_null($this->f3m3->FormValue) && $this->f3m3->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f3m3->FldCaption(), $this->f3m3->ReqErrMsg));
		}
		if (!$this->f3k3->FldIsDetailKey && !is_null($this->f3k3->FormValue) && $this->f3k3->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f3k3->FldCaption(), $this->f3k3->ReqErrMsg));
		}
		if (!$this->f4m3->FldIsDetailKey && !is_null($this->f4m3->FormValue) && $this->f4m3->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f4m3->FldCaption(), $this->f4m3->ReqErrMsg));
		}
		if (!$this->f4k3->FldIsDetailKey && !is_null($this->f4k3->FormValue) && $this->f4k3->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f4k3->FldCaption(), $this->f4k3->ReqErrMsg));
		}
		if (!$this->f5m3->FldIsDetailKey && !is_null($this->f5m3->FormValue) && $this->f5m3->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f5m3->FldCaption(), $this->f5m3->ReqErrMsg));
		}
		if (!$this->f5k3->FldIsDetailKey && !is_null($this->f5k3->FormValue) && $this->f5k3->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f5k3->FldCaption(), $this->f5k3->ReqErrMsg));
		}
		if (!$this->f6m3->FldIsDetailKey && !is_null($this->f6m3->FormValue) && $this->f6m3->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f6m3->FldCaption(), $this->f6m3->ReqErrMsg));
		}
		if (!$this->f6k3->FldIsDetailKey && !is_null($this->f6k3->FormValue) && $this->f6k3->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->f6k3->FldCaption(), $this->f6k3->ReqErrMsg));
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

		// dept_id
		$this->dept_id->SetDbValueDef($rsnew, $this->dept_id->CurrentValue, 0, FALSE);

		// f0m1
		$this->f0m1->SetDbValueDef($rsnew, $this->f0m1->CurrentValue, "", FALSE);

		// f0k1
		$this->f0k1->SetDbValueDef($rsnew, $this->f0k1->CurrentValue, "", FALSE);

		// f1m1
		$this->f1m1->SetDbValueDef($rsnew, $this->f1m1->CurrentValue, "", FALSE);

		// f1k1
		$this->f1k1->SetDbValueDef($rsnew, $this->f1k1->CurrentValue, "", FALSE);

		// f2m1
		$this->f2m1->SetDbValueDef($rsnew, $this->f2m1->CurrentValue, "", FALSE);

		// f2k1
		$this->f2k1->SetDbValueDef($rsnew, $this->f2k1->CurrentValue, "", FALSE);

		// f3m1
		$this->f3m1->SetDbValueDef($rsnew, $this->f3m1->CurrentValue, "", FALSE);

		// f3k1
		$this->f3k1->SetDbValueDef($rsnew, $this->f3k1->CurrentValue, "", FALSE);

		// f4m1
		$this->f4m1->SetDbValueDef($rsnew, $this->f4m1->CurrentValue, "", FALSE);

		// f4k1
		$this->f4k1->SetDbValueDef($rsnew, $this->f4k1->CurrentValue, "", FALSE);

		// f5m1
		$this->f5m1->SetDbValueDef($rsnew, $this->f5m1->CurrentValue, "", FALSE);

		// f5k1
		$this->f5k1->SetDbValueDef($rsnew, $this->f5k1->CurrentValue, "", FALSE);

		// f6m1
		$this->f6m1->SetDbValueDef($rsnew, $this->f6m1->CurrentValue, "", FALSE);

		// f6k1
		$this->f6k1->SetDbValueDef($rsnew, $this->f6k1->CurrentValue, "", FALSE);

		// f0m2
		$this->f0m2->SetDbValueDef($rsnew, $this->f0m2->CurrentValue, "", FALSE);

		// f0k2
		$this->f0k2->SetDbValueDef($rsnew, $this->f0k2->CurrentValue, "", FALSE);

		// f1m2
		$this->f1m2->SetDbValueDef($rsnew, $this->f1m2->CurrentValue, "", FALSE);

		// f1k2
		$this->f1k2->SetDbValueDef($rsnew, $this->f1k2->CurrentValue, "", FALSE);

		// f2m2
		$this->f2m2->SetDbValueDef($rsnew, $this->f2m2->CurrentValue, "", FALSE);

		// f2k2
		$this->f2k2->SetDbValueDef($rsnew, $this->f2k2->CurrentValue, "", FALSE);

		// f3m2
		$this->f3m2->SetDbValueDef($rsnew, $this->f3m2->CurrentValue, "", FALSE);

		// f3k2
		$this->f3k2->SetDbValueDef($rsnew, $this->f3k2->CurrentValue, "", FALSE);

		// f4m2
		$this->f4m2->SetDbValueDef($rsnew, $this->f4m2->CurrentValue, "", FALSE);

		// f4k2
		$this->f4k2->SetDbValueDef($rsnew, $this->f4k2->CurrentValue, "", FALSE);

		// f5m2
		$this->f5m2->SetDbValueDef($rsnew, $this->f5m2->CurrentValue, "", FALSE);

		// f5k2
		$this->f5k2->SetDbValueDef($rsnew, $this->f5k2->CurrentValue, "", FALSE);

		// f6m2
		$this->f6m2->SetDbValueDef($rsnew, $this->f6m2->CurrentValue, "", FALSE);

		// f6k2
		$this->f6k2->SetDbValueDef($rsnew, $this->f6k2->CurrentValue, "", FALSE);

		// f0m3
		$this->f0m3->SetDbValueDef($rsnew, $this->f0m3->CurrentValue, "", FALSE);

		// f0k3
		$this->f0k3->SetDbValueDef($rsnew, $this->f0k3->CurrentValue, "", FALSE);

		// f1m3
		$this->f1m3->SetDbValueDef($rsnew, $this->f1m3->CurrentValue, "", FALSE);

		// f1k3
		$this->f1k3->SetDbValueDef($rsnew, $this->f1k3->CurrentValue, "", FALSE);

		// f2m3
		$this->f2m3->SetDbValueDef($rsnew, $this->f2m3->CurrentValue, "", FALSE);

		// f2k3
		$this->f2k3->SetDbValueDef($rsnew, $this->f2k3->CurrentValue, "", FALSE);

		// f3m3
		$this->f3m3->SetDbValueDef($rsnew, $this->f3m3->CurrentValue, "", FALSE);

		// f3k3
		$this->f3k3->SetDbValueDef($rsnew, $this->f3k3->CurrentValue, "", FALSE);

		// f4m3
		$this->f4m3->SetDbValueDef($rsnew, $this->f4m3->CurrentValue, "", FALSE);

		// f4k3
		$this->f4k3->SetDbValueDef($rsnew, $this->f4k3->CurrentValue, "", FALSE);

		// f5m3
		$this->f5m3->SetDbValueDef($rsnew, $this->f5m3->CurrentValue, "", FALSE);

		// f5k3
		$this->f5k3->SetDbValueDef($rsnew, $this->f5k3->CurrentValue, "", FALSE);

		// f6m3
		$this->f6m3->SetDbValueDef($rsnew, $this->f6m3->CurrentValue, "", FALSE);

		// f6k3
		$this->f6k3->SetDbValueDef($rsnew, $this->f6k3->CurrentValue, "", FALSE);

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("pegawai_defaultlist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_pegawai_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `pegawai_id` AS `LinkFld`, `pegawai_nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `pegawai`";
			$sWhereWrk = "{filter}";
			$this->pegawai_id->LookupFilters = array("dx1" => '`pegawai_nama`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`pegawai_id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->pegawai_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_dept_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `pembagian2_id` AS `LinkFld`, `pembagian2_nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `pembagian2`";
			$sWhereWrk = "{filter}";
			$this->dept_id->LookupFilters = array("dx1" => '`pembagian2_nama`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`pembagian2_id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->dept_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_pegawai_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `pegawai_id`, `pegawai_nama` AS `DispFld` FROM `pegawai`";
			$sWhereWrk = "`pegawai_nama` LIKE '{query_value}%'";
			$this->pegawai_id->LookupFilters = array("dx1" => '`pegawai_nama`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->pegawai_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " LIMIT " . EW_AUTO_SUGGEST_MAX_ENTRIES;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_dept_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `pembagian2_id`, `pembagian2_nama` AS `DispFld` FROM `pembagian2`";
			$sWhereWrk = "`pembagian2_nama` LIKE '{query_value}%'";
			$this->dept_id->LookupFilters = array("dx1" => '`pembagian2_nama`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->dept_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " LIMIT " . EW_AUTO_SUGGEST_MAX_ENTRIES;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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
if (!isset($pegawai_default_add)) $pegawai_default_add = new cpegawai_default_add();

// Page init
$pegawai_default_add->Page_Init();

// Page main
$pegawai_default_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pegawai_default_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = fpegawai_defaultadd = new ew_Form("fpegawai_defaultadd", "add");

// Validate form
fpegawai_defaultadd.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->pegawai_id->FldCaption(), $pegawai_default->pegawai_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_dept_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->dept_id->FldCaption(), $pegawai_default->dept_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f0m1");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f0m1->FldCaption(), $pegawai_default->f0m1->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f0k1");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f0k1->FldCaption(), $pegawai_default->f0k1->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f1m1");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f1m1->FldCaption(), $pegawai_default->f1m1->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f1k1");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f1k1->FldCaption(), $pegawai_default->f1k1->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f2m1");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f2m1->FldCaption(), $pegawai_default->f2m1->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f2k1");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f2k1->FldCaption(), $pegawai_default->f2k1->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f3m1");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f3m1->FldCaption(), $pegawai_default->f3m1->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f3k1");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f3k1->FldCaption(), $pegawai_default->f3k1->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f4m1");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f4m1->FldCaption(), $pegawai_default->f4m1->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f4k1");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f4k1->FldCaption(), $pegawai_default->f4k1->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f5m1");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f5m1->FldCaption(), $pegawai_default->f5m1->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f5k1");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f5k1->FldCaption(), $pegawai_default->f5k1->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f6m1");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f6m1->FldCaption(), $pegawai_default->f6m1->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f6k1");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f6k1->FldCaption(), $pegawai_default->f6k1->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f0m2");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f0m2->FldCaption(), $pegawai_default->f0m2->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f0k2");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f0k2->FldCaption(), $pegawai_default->f0k2->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f1m2");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f1m2->FldCaption(), $pegawai_default->f1m2->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f1k2");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f1k2->FldCaption(), $pegawai_default->f1k2->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f2m2");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f2m2->FldCaption(), $pegawai_default->f2m2->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f2k2");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f2k2->FldCaption(), $pegawai_default->f2k2->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f3m2");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f3m2->FldCaption(), $pegawai_default->f3m2->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f3k2");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f3k2->FldCaption(), $pegawai_default->f3k2->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f4m2");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f4m2->FldCaption(), $pegawai_default->f4m2->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f4k2");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f4k2->FldCaption(), $pegawai_default->f4k2->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f5m2");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f5m2->FldCaption(), $pegawai_default->f5m2->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f5k2");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f5k2->FldCaption(), $pegawai_default->f5k2->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f6m2");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f6m2->FldCaption(), $pegawai_default->f6m2->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f6k2");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f6k2->FldCaption(), $pegawai_default->f6k2->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f0m3");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f0m3->FldCaption(), $pegawai_default->f0m3->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f0k3");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f0k3->FldCaption(), $pegawai_default->f0k3->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f1m3");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f1m3->FldCaption(), $pegawai_default->f1m3->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f1k3");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f1k3->FldCaption(), $pegawai_default->f1k3->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f2m3");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f2m3->FldCaption(), $pegawai_default->f2m3->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f2k3");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f2k3->FldCaption(), $pegawai_default->f2k3->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f3m3");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f3m3->FldCaption(), $pegawai_default->f3m3->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f3k3");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f3k3->FldCaption(), $pegawai_default->f3k3->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f4m3");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f4m3->FldCaption(), $pegawai_default->f4m3->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f4k3");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f4k3->FldCaption(), $pegawai_default->f4k3->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f5m3");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f5m3->FldCaption(), $pegawai_default->f5m3->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f5k3");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f5k3->FldCaption(), $pegawai_default->f5k3->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f6m3");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f6m3->FldCaption(), $pegawai_default->f6m3->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_f6k3");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pegawai_default->f6k3->FldCaption(), $pegawai_default->f6k3->ReqErrMsg)) ?>");

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
fpegawai_defaultadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fpegawai_defaultadd.ValidateRequired = true;
<?php } else { ?>
fpegawai_defaultadd.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fpegawai_defaultadd.Lists["x_pegawai_id"] = {"LinkField":"x_pegawai_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_pegawai_nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"pegawai"};
fpegawai_defaultadd.Lists["x_dept_id"] = {"LinkField":"x_pembagian2_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_pembagian2_nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"pembagian2"};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$pegawai_default_add->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $pegawai_default_add->ShowPageHeader(); ?>
<?php
$pegawai_default_add->ShowMessage();
?>
<form name="fpegawai_defaultadd" id="fpegawai_defaultadd" class="<?php echo $pegawai_default_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($pegawai_default_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $pegawai_default_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pegawai_default">
<input type="hidden" name="a_add" id="a_add" value="A">
<?php if ($pegawai_default_add->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div>
<?php if ($pegawai_default->pegawai_id->Visible) { // pegawai_id ?>
	<div id="r_pegawai_id" class="form-group">
		<label id="elh_pegawai_default_pegawai_id" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->pegawai_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->pegawai_id->CellAttributes() ?>>
<span id="el_pegawai_default_pegawai_id">
<?php
$wrkonchange = trim(" " . @$pegawai_default->pegawai_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$pegawai_default->pegawai_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_pegawai_id" style="white-space: nowrap; z-index: 8980">
	<input type="text" name="sv_x_pegawai_id" id="sv_x_pegawai_id" value="<?php echo $pegawai_default->pegawai_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($pegawai_default->pegawai_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($pegawai_default->pegawai_id->getPlaceHolder()) ?>"<?php echo $pegawai_default->pegawai_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="pegawai_default" data-field="x_pegawai_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pegawai_default->pegawai_id->DisplayValueSeparatorAttribute() ?>" name="x_pegawai_id" id="x_pegawai_id" value="<?php echo ew_HtmlEncode($pegawai_default->pegawai_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x_pegawai_id" id="q_x_pegawai_id" value="<?php echo $pegawai_default->pegawai_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
fpegawai_defaultadd.CreateAutoSuggest({"id":"x_pegawai_id","forceSelect":true});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($pegawai_default->pegawai_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_pegawai_id',m:0,n:10,srch:false});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" name="s_x_pegawai_id" id="s_x_pegawai_id" value="<?php echo $pegawai_default->pegawai_id->LookupFilterQuery(false) ?>">
</span>
<?php echo $pegawai_default->pegawai_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->dept_id->Visible) { // dept_id ?>
	<div id="r_dept_id" class="form-group">
		<label id="elh_pegawai_default_dept_id" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->dept_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->dept_id->CellAttributes() ?>>
<span id="el_pegawai_default_dept_id">
<?php
$wrkonchange = trim(" " . @$pegawai_default->dept_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$pegawai_default->dept_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_dept_id" style="white-space: nowrap; z-index: 8970">
	<input type="text" name="sv_x_dept_id" id="sv_x_dept_id" value="<?php echo $pegawai_default->dept_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($pegawai_default->dept_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($pegawai_default->dept_id->getPlaceHolder()) ?>"<?php echo $pegawai_default->dept_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="pegawai_default" data-field="x_dept_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pegawai_default->dept_id->DisplayValueSeparatorAttribute() ?>" name="x_dept_id" id="x_dept_id" value="<?php echo ew_HtmlEncode($pegawai_default->dept_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x_dept_id" id="q_x_dept_id" value="<?php echo $pegawai_default->dept_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
fpegawai_defaultadd.CreateAutoSuggest({"id":"x_dept_id","forceSelect":true});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($pegawai_default->dept_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_dept_id',m:0,n:10,srch:false});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" name="s_x_dept_id" id="s_x_dept_id" value="<?php echo $pegawai_default->dept_id->LookupFilterQuery(false) ?>">
</span>
<?php echo $pegawai_default->dept_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f0m1->Visible) { // f0m1 ?>
	<div id="r_f0m1" class="form-group">
		<label id="elh_pegawai_default_f0m1" for="x_f0m1" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f0m1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f0m1->CellAttributes() ?>>
<span id="el_pegawai_default_f0m1">
<input type="text" data-table="pegawai_default" data-field="x_f0m1" name="x_f0m1" id="x_f0m1" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f0m1->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f0m1->EditValue ?>"<?php echo $pegawai_default->f0m1->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f0m1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f0k1->Visible) { // f0k1 ?>
	<div id="r_f0k1" class="form-group">
		<label id="elh_pegawai_default_f0k1" for="x_f0k1" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f0k1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f0k1->CellAttributes() ?>>
<span id="el_pegawai_default_f0k1">
<input type="text" data-table="pegawai_default" data-field="x_f0k1" name="x_f0k1" id="x_f0k1" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f0k1->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f0k1->EditValue ?>"<?php echo $pegawai_default->f0k1->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f0k1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f1m1->Visible) { // f1m1 ?>
	<div id="r_f1m1" class="form-group">
		<label id="elh_pegawai_default_f1m1" for="x_f1m1" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f1m1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f1m1->CellAttributes() ?>>
<span id="el_pegawai_default_f1m1">
<input type="text" data-table="pegawai_default" data-field="x_f1m1" name="x_f1m1" id="x_f1m1" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f1m1->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f1m1->EditValue ?>"<?php echo $pegawai_default->f1m1->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f1m1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f1k1->Visible) { // f1k1 ?>
	<div id="r_f1k1" class="form-group">
		<label id="elh_pegawai_default_f1k1" for="x_f1k1" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f1k1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f1k1->CellAttributes() ?>>
<span id="el_pegawai_default_f1k1">
<input type="text" data-table="pegawai_default" data-field="x_f1k1" name="x_f1k1" id="x_f1k1" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f1k1->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f1k1->EditValue ?>"<?php echo $pegawai_default->f1k1->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f1k1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f2m1->Visible) { // f2m1 ?>
	<div id="r_f2m1" class="form-group">
		<label id="elh_pegawai_default_f2m1" for="x_f2m1" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f2m1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f2m1->CellAttributes() ?>>
<span id="el_pegawai_default_f2m1">
<input type="text" data-table="pegawai_default" data-field="x_f2m1" name="x_f2m1" id="x_f2m1" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f2m1->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f2m1->EditValue ?>"<?php echo $pegawai_default->f2m1->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f2m1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f2k1->Visible) { // f2k1 ?>
	<div id="r_f2k1" class="form-group">
		<label id="elh_pegawai_default_f2k1" for="x_f2k1" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f2k1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f2k1->CellAttributes() ?>>
<span id="el_pegawai_default_f2k1">
<input type="text" data-table="pegawai_default" data-field="x_f2k1" name="x_f2k1" id="x_f2k1" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f2k1->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f2k1->EditValue ?>"<?php echo $pegawai_default->f2k1->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f2k1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f3m1->Visible) { // f3m1 ?>
	<div id="r_f3m1" class="form-group">
		<label id="elh_pegawai_default_f3m1" for="x_f3m1" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f3m1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f3m1->CellAttributes() ?>>
<span id="el_pegawai_default_f3m1">
<input type="text" data-table="pegawai_default" data-field="x_f3m1" name="x_f3m1" id="x_f3m1" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f3m1->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f3m1->EditValue ?>"<?php echo $pegawai_default->f3m1->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f3m1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f3k1->Visible) { // f3k1 ?>
	<div id="r_f3k1" class="form-group">
		<label id="elh_pegawai_default_f3k1" for="x_f3k1" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f3k1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f3k1->CellAttributes() ?>>
<span id="el_pegawai_default_f3k1">
<input type="text" data-table="pegawai_default" data-field="x_f3k1" name="x_f3k1" id="x_f3k1" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f3k1->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f3k1->EditValue ?>"<?php echo $pegawai_default->f3k1->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f3k1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f4m1->Visible) { // f4m1 ?>
	<div id="r_f4m1" class="form-group">
		<label id="elh_pegawai_default_f4m1" for="x_f4m1" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f4m1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f4m1->CellAttributes() ?>>
<span id="el_pegawai_default_f4m1">
<input type="text" data-table="pegawai_default" data-field="x_f4m1" name="x_f4m1" id="x_f4m1" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f4m1->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f4m1->EditValue ?>"<?php echo $pegawai_default->f4m1->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f4m1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f4k1->Visible) { // f4k1 ?>
	<div id="r_f4k1" class="form-group">
		<label id="elh_pegawai_default_f4k1" for="x_f4k1" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f4k1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f4k1->CellAttributes() ?>>
<span id="el_pegawai_default_f4k1">
<input type="text" data-table="pegawai_default" data-field="x_f4k1" name="x_f4k1" id="x_f4k1" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f4k1->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f4k1->EditValue ?>"<?php echo $pegawai_default->f4k1->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f4k1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f5m1->Visible) { // f5m1 ?>
	<div id="r_f5m1" class="form-group">
		<label id="elh_pegawai_default_f5m1" for="x_f5m1" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f5m1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f5m1->CellAttributes() ?>>
<span id="el_pegawai_default_f5m1">
<input type="text" data-table="pegawai_default" data-field="x_f5m1" name="x_f5m1" id="x_f5m1" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f5m1->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f5m1->EditValue ?>"<?php echo $pegawai_default->f5m1->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f5m1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f5k1->Visible) { // f5k1 ?>
	<div id="r_f5k1" class="form-group">
		<label id="elh_pegawai_default_f5k1" for="x_f5k1" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f5k1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f5k1->CellAttributes() ?>>
<span id="el_pegawai_default_f5k1">
<input type="text" data-table="pegawai_default" data-field="x_f5k1" name="x_f5k1" id="x_f5k1" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f5k1->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f5k1->EditValue ?>"<?php echo $pegawai_default->f5k1->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f5k1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f6m1->Visible) { // f6m1 ?>
	<div id="r_f6m1" class="form-group">
		<label id="elh_pegawai_default_f6m1" for="x_f6m1" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f6m1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f6m1->CellAttributes() ?>>
<span id="el_pegawai_default_f6m1">
<input type="text" data-table="pegawai_default" data-field="x_f6m1" name="x_f6m1" id="x_f6m1" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f6m1->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f6m1->EditValue ?>"<?php echo $pegawai_default->f6m1->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f6m1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f6k1->Visible) { // f6k1 ?>
	<div id="r_f6k1" class="form-group">
		<label id="elh_pegawai_default_f6k1" for="x_f6k1" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f6k1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f6k1->CellAttributes() ?>>
<span id="el_pegawai_default_f6k1">
<input type="text" data-table="pegawai_default" data-field="x_f6k1" name="x_f6k1" id="x_f6k1" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f6k1->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f6k1->EditValue ?>"<?php echo $pegawai_default->f6k1->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f6k1->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f0m2->Visible) { // f0m2 ?>
	<div id="r_f0m2" class="form-group">
		<label id="elh_pegawai_default_f0m2" for="x_f0m2" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f0m2->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f0m2->CellAttributes() ?>>
<span id="el_pegawai_default_f0m2">
<input type="text" data-table="pegawai_default" data-field="x_f0m2" name="x_f0m2" id="x_f0m2" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f0m2->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f0m2->EditValue ?>"<?php echo $pegawai_default->f0m2->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f0m2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f0k2->Visible) { // f0k2 ?>
	<div id="r_f0k2" class="form-group">
		<label id="elh_pegawai_default_f0k2" for="x_f0k2" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f0k2->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f0k2->CellAttributes() ?>>
<span id="el_pegawai_default_f0k2">
<input type="text" data-table="pegawai_default" data-field="x_f0k2" name="x_f0k2" id="x_f0k2" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f0k2->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f0k2->EditValue ?>"<?php echo $pegawai_default->f0k2->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f0k2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f1m2->Visible) { // f1m2 ?>
	<div id="r_f1m2" class="form-group">
		<label id="elh_pegawai_default_f1m2" for="x_f1m2" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f1m2->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f1m2->CellAttributes() ?>>
<span id="el_pegawai_default_f1m2">
<input type="text" data-table="pegawai_default" data-field="x_f1m2" name="x_f1m2" id="x_f1m2" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f1m2->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f1m2->EditValue ?>"<?php echo $pegawai_default->f1m2->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f1m2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f1k2->Visible) { // f1k2 ?>
	<div id="r_f1k2" class="form-group">
		<label id="elh_pegawai_default_f1k2" for="x_f1k2" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f1k2->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f1k2->CellAttributes() ?>>
<span id="el_pegawai_default_f1k2">
<input type="text" data-table="pegawai_default" data-field="x_f1k2" name="x_f1k2" id="x_f1k2" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f1k2->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f1k2->EditValue ?>"<?php echo $pegawai_default->f1k2->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f1k2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f2m2->Visible) { // f2m2 ?>
	<div id="r_f2m2" class="form-group">
		<label id="elh_pegawai_default_f2m2" for="x_f2m2" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f2m2->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f2m2->CellAttributes() ?>>
<span id="el_pegawai_default_f2m2">
<input type="text" data-table="pegawai_default" data-field="x_f2m2" name="x_f2m2" id="x_f2m2" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f2m2->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f2m2->EditValue ?>"<?php echo $pegawai_default->f2m2->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f2m2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f2k2->Visible) { // f2k2 ?>
	<div id="r_f2k2" class="form-group">
		<label id="elh_pegawai_default_f2k2" for="x_f2k2" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f2k2->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f2k2->CellAttributes() ?>>
<span id="el_pegawai_default_f2k2">
<input type="text" data-table="pegawai_default" data-field="x_f2k2" name="x_f2k2" id="x_f2k2" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f2k2->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f2k2->EditValue ?>"<?php echo $pegawai_default->f2k2->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f2k2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f3m2->Visible) { // f3m2 ?>
	<div id="r_f3m2" class="form-group">
		<label id="elh_pegawai_default_f3m2" for="x_f3m2" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f3m2->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f3m2->CellAttributes() ?>>
<span id="el_pegawai_default_f3m2">
<input type="text" data-table="pegawai_default" data-field="x_f3m2" name="x_f3m2" id="x_f3m2" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f3m2->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f3m2->EditValue ?>"<?php echo $pegawai_default->f3m2->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f3m2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f3k2->Visible) { // f3k2 ?>
	<div id="r_f3k2" class="form-group">
		<label id="elh_pegawai_default_f3k2" for="x_f3k2" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f3k2->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f3k2->CellAttributes() ?>>
<span id="el_pegawai_default_f3k2">
<input type="text" data-table="pegawai_default" data-field="x_f3k2" name="x_f3k2" id="x_f3k2" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f3k2->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f3k2->EditValue ?>"<?php echo $pegawai_default->f3k2->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f3k2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f4m2->Visible) { // f4m2 ?>
	<div id="r_f4m2" class="form-group">
		<label id="elh_pegawai_default_f4m2" for="x_f4m2" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f4m2->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f4m2->CellAttributes() ?>>
<span id="el_pegawai_default_f4m2">
<input type="text" data-table="pegawai_default" data-field="x_f4m2" name="x_f4m2" id="x_f4m2" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f4m2->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f4m2->EditValue ?>"<?php echo $pegawai_default->f4m2->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f4m2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f4k2->Visible) { // f4k2 ?>
	<div id="r_f4k2" class="form-group">
		<label id="elh_pegawai_default_f4k2" for="x_f4k2" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f4k2->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f4k2->CellAttributes() ?>>
<span id="el_pegawai_default_f4k2">
<input type="text" data-table="pegawai_default" data-field="x_f4k2" name="x_f4k2" id="x_f4k2" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f4k2->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f4k2->EditValue ?>"<?php echo $pegawai_default->f4k2->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f4k2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f5m2->Visible) { // f5m2 ?>
	<div id="r_f5m2" class="form-group">
		<label id="elh_pegawai_default_f5m2" for="x_f5m2" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f5m2->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f5m2->CellAttributes() ?>>
<span id="el_pegawai_default_f5m2">
<input type="text" data-table="pegawai_default" data-field="x_f5m2" name="x_f5m2" id="x_f5m2" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f5m2->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f5m2->EditValue ?>"<?php echo $pegawai_default->f5m2->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f5m2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f5k2->Visible) { // f5k2 ?>
	<div id="r_f5k2" class="form-group">
		<label id="elh_pegawai_default_f5k2" for="x_f5k2" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f5k2->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f5k2->CellAttributes() ?>>
<span id="el_pegawai_default_f5k2">
<input type="text" data-table="pegawai_default" data-field="x_f5k2" name="x_f5k2" id="x_f5k2" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f5k2->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f5k2->EditValue ?>"<?php echo $pegawai_default->f5k2->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f5k2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f6m2->Visible) { // f6m2 ?>
	<div id="r_f6m2" class="form-group">
		<label id="elh_pegawai_default_f6m2" for="x_f6m2" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f6m2->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f6m2->CellAttributes() ?>>
<span id="el_pegawai_default_f6m2">
<input type="text" data-table="pegawai_default" data-field="x_f6m2" name="x_f6m2" id="x_f6m2" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f6m2->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f6m2->EditValue ?>"<?php echo $pegawai_default->f6m2->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f6m2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f6k2->Visible) { // f6k2 ?>
	<div id="r_f6k2" class="form-group">
		<label id="elh_pegawai_default_f6k2" for="x_f6k2" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f6k2->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f6k2->CellAttributes() ?>>
<span id="el_pegawai_default_f6k2">
<input type="text" data-table="pegawai_default" data-field="x_f6k2" name="x_f6k2" id="x_f6k2" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f6k2->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f6k2->EditValue ?>"<?php echo $pegawai_default->f6k2->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f6k2->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f0m3->Visible) { // f0m3 ?>
	<div id="r_f0m3" class="form-group">
		<label id="elh_pegawai_default_f0m3" for="x_f0m3" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f0m3->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f0m3->CellAttributes() ?>>
<span id="el_pegawai_default_f0m3">
<input type="text" data-table="pegawai_default" data-field="x_f0m3" name="x_f0m3" id="x_f0m3" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f0m3->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f0m3->EditValue ?>"<?php echo $pegawai_default->f0m3->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f0m3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f0k3->Visible) { // f0k3 ?>
	<div id="r_f0k3" class="form-group">
		<label id="elh_pegawai_default_f0k3" for="x_f0k3" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f0k3->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f0k3->CellAttributes() ?>>
<span id="el_pegawai_default_f0k3">
<input type="text" data-table="pegawai_default" data-field="x_f0k3" name="x_f0k3" id="x_f0k3" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f0k3->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f0k3->EditValue ?>"<?php echo $pegawai_default->f0k3->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f0k3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f1m3->Visible) { // f1m3 ?>
	<div id="r_f1m3" class="form-group">
		<label id="elh_pegawai_default_f1m3" for="x_f1m3" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f1m3->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f1m3->CellAttributes() ?>>
<span id="el_pegawai_default_f1m3">
<input type="text" data-table="pegawai_default" data-field="x_f1m3" name="x_f1m3" id="x_f1m3" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f1m3->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f1m3->EditValue ?>"<?php echo $pegawai_default->f1m3->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f1m3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f1k3->Visible) { // f1k3 ?>
	<div id="r_f1k3" class="form-group">
		<label id="elh_pegawai_default_f1k3" for="x_f1k3" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f1k3->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f1k3->CellAttributes() ?>>
<span id="el_pegawai_default_f1k3">
<input type="text" data-table="pegawai_default" data-field="x_f1k3" name="x_f1k3" id="x_f1k3" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f1k3->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f1k3->EditValue ?>"<?php echo $pegawai_default->f1k3->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f1k3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f2m3->Visible) { // f2m3 ?>
	<div id="r_f2m3" class="form-group">
		<label id="elh_pegawai_default_f2m3" for="x_f2m3" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f2m3->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f2m3->CellAttributes() ?>>
<span id="el_pegawai_default_f2m3">
<input type="text" data-table="pegawai_default" data-field="x_f2m3" name="x_f2m3" id="x_f2m3" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f2m3->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f2m3->EditValue ?>"<?php echo $pegawai_default->f2m3->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f2m3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f2k3->Visible) { // f2k3 ?>
	<div id="r_f2k3" class="form-group">
		<label id="elh_pegawai_default_f2k3" for="x_f2k3" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f2k3->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f2k3->CellAttributes() ?>>
<span id="el_pegawai_default_f2k3">
<input type="text" data-table="pegawai_default" data-field="x_f2k3" name="x_f2k3" id="x_f2k3" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f2k3->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f2k3->EditValue ?>"<?php echo $pegawai_default->f2k3->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f2k3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f3m3->Visible) { // f3m3 ?>
	<div id="r_f3m3" class="form-group">
		<label id="elh_pegawai_default_f3m3" for="x_f3m3" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f3m3->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f3m3->CellAttributes() ?>>
<span id="el_pegawai_default_f3m3">
<input type="text" data-table="pegawai_default" data-field="x_f3m3" name="x_f3m3" id="x_f3m3" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f3m3->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f3m3->EditValue ?>"<?php echo $pegawai_default->f3m3->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f3m3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f3k3->Visible) { // f3k3 ?>
	<div id="r_f3k3" class="form-group">
		<label id="elh_pegawai_default_f3k3" for="x_f3k3" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f3k3->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f3k3->CellAttributes() ?>>
<span id="el_pegawai_default_f3k3">
<input type="text" data-table="pegawai_default" data-field="x_f3k3" name="x_f3k3" id="x_f3k3" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f3k3->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f3k3->EditValue ?>"<?php echo $pegawai_default->f3k3->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f3k3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f4m3->Visible) { // f4m3 ?>
	<div id="r_f4m3" class="form-group">
		<label id="elh_pegawai_default_f4m3" for="x_f4m3" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f4m3->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f4m3->CellAttributes() ?>>
<span id="el_pegawai_default_f4m3">
<input type="text" data-table="pegawai_default" data-field="x_f4m3" name="x_f4m3" id="x_f4m3" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f4m3->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f4m3->EditValue ?>"<?php echo $pegawai_default->f4m3->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f4m3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f4k3->Visible) { // f4k3 ?>
	<div id="r_f4k3" class="form-group">
		<label id="elh_pegawai_default_f4k3" for="x_f4k3" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f4k3->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f4k3->CellAttributes() ?>>
<span id="el_pegawai_default_f4k3">
<input type="text" data-table="pegawai_default" data-field="x_f4k3" name="x_f4k3" id="x_f4k3" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f4k3->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f4k3->EditValue ?>"<?php echo $pegawai_default->f4k3->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f4k3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f5m3->Visible) { // f5m3 ?>
	<div id="r_f5m3" class="form-group">
		<label id="elh_pegawai_default_f5m3" for="x_f5m3" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f5m3->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f5m3->CellAttributes() ?>>
<span id="el_pegawai_default_f5m3">
<input type="text" data-table="pegawai_default" data-field="x_f5m3" name="x_f5m3" id="x_f5m3" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f5m3->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f5m3->EditValue ?>"<?php echo $pegawai_default->f5m3->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f5m3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f5k3->Visible) { // f5k3 ?>
	<div id="r_f5k3" class="form-group">
		<label id="elh_pegawai_default_f5k3" for="x_f5k3" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f5k3->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f5k3->CellAttributes() ?>>
<span id="el_pegawai_default_f5k3">
<input type="text" data-table="pegawai_default" data-field="x_f5k3" name="x_f5k3" id="x_f5k3" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f5k3->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f5k3->EditValue ?>"<?php echo $pegawai_default->f5k3->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f5k3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f6m3->Visible) { // f6m3 ?>
	<div id="r_f6m3" class="form-group">
		<label id="elh_pegawai_default_f6m3" for="x_f6m3" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f6m3->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f6m3->CellAttributes() ?>>
<span id="el_pegawai_default_f6m3">
<input type="text" data-table="pegawai_default" data-field="x_f6m3" name="x_f6m3" id="x_f6m3" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f6m3->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f6m3->EditValue ?>"<?php echo $pegawai_default->f6m3->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f6m3->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pegawai_default->f6k3->Visible) { // f6k3 ?>
	<div id="r_f6k3" class="form-group">
		<label id="elh_pegawai_default_f6k3" for="x_f6k3" class="col-sm-2 control-label ewLabel"><?php echo $pegawai_default->f6k3->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $pegawai_default->f6k3->CellAttributes() ?>>
<span id="el_pegawai_default_f6k3">
<input type="text" data-table="pegawai_default" data-field="x_f6k3" name="x_f6k3" id="x_f6k3" size="30" maxlength="4" placeholder="<?php echo ew_HtmlEncode($pegawai_default->f6k3->getPlaceHolder()) ?>" value="<?php echo $pegawai_default->f6k3->EditValue ?>"<?php echo $pegawai_default->f6k3->EditAttributes() ?>>
</span>
<?php echo $pegawai_default->f6k3->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<?php if (!$pegawai_default_add->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $pegawai_default_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php } ?>
</form>
<script type="text/javascript">
fpegawai_defaultadd.Init();
</script>
<?php
$pegawai_default_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$pegawai_default_add->Page_Terminate();
?>
