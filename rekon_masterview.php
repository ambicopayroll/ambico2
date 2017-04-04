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

$rekon_master_view = NULL; // Initialize page object first

class crekon_master_view extends crekon_master {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = "{4B5DAB39-E4BC-48DF-9311-E295A5F18030}";

	// Table name
	var $TableName = 'rekon_master';

	// Page object name
	var $PageObjName = 'rekon_master_view';

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

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Custom export
	var $ExportExcelCustom = FALSE;
	var $ExportWordCustom = FALSE;
	var $ExportPdfCustom = FALSE;
	var $ExportEmailCustom = FALSE;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

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
		$KeyUrl = "";
		if (@$_GET["rm_id"] <> "") {
			$this->RecKey["rm_id"] = $_GET["rm_id"];
			$KeyUrl .= "&amp;rm_id=" . urlencode($this->RecKey["rm_id"]);
		}
		$this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
		$this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

		// Table object (t_user)
		if (!isset($GLOBALS['t_user'])) $GLOBALS['t_user'] = new ct_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

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

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Other options
		$this->OtherOptions['action'] = new cListOptions();
		$this->OtherOptions['action']->Tag = "div";
		$this->OtherOptions['action']->TagClassName = "ewActionOption";
		$this->OtherOptions['detail'] = new cListOptions();
		$this->OtherOptions['detail']->Tag = "div";
		$this->OtherOptions['detail']->TagClassName = "ewDetailOption";
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
		if (!$Security->CanView()) {
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

		// Get export parameters
		$custom = "";
		if (@$_GET["export"] <> "") {
			$this->Export = $_GET["export"];
			$custom = @$_GET["custom"];
		} elseif (@$_POST["export"] <> "") {
			$this->Export = $_POST["export"];
			$custom = @$_POST["custom"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$this->Export = $_POST["exporttype"];
			$custom = @$_POST["custom"];
		} else {
			$this->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExportFile = $this->TableVar; // Get export file, used in header
		if (@$_GET["rm_id"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["rm_id"]);
		}

		// Get custom export parameters
		if ($this->Export <> "" && $custom <> "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$gsCustomExport = $this->CustomExport;
		$gsExport = $this->Export; // Get export parameter, used in header

		// Update Export URLs
		if (defined("EW_USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (defined("EW_USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action

		// Setup export options
		$this->SetupExportOptions();
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
	var $ExportOptions; // Export options
	var $OtherOptions = array(); // Other options
	var $DisplayRecs = 1;
	var $DbMasterFilter;
	var $DbDetailFilter;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $RecCnt;
	var $RecKey = array();
	var $IsModal = FALSE;
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;
		global $gbSkipHeaderFooter;

		// Check modal
		$this->IsModal = (@$_GET["modal"] == "1" || @$_POST["modal"] == "1");
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["rm_id"] <> "") {
				$this->rm_id->setQueryStringValue($_GET["rm_id"]);
				$this->RecKey["rm_id"] = $this->rm_id->QueryStringValue;
			} elseif (@$_POST["rm_id"] <> "") {
				$this->rm_id->setFormValue($_POST["rm_id"]);
				$this->RecKey["rm_id"] = $this->rm_id->FormValue;
			} else {
				$sReturnUrl = "rekon_masterlist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "I"; // Display form
			switch ($this->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "rekon_masterlist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if ($this->CustomExport == "" && in_array($this->Export, array("html","word","excel","xml","csv","email","pdf"))) {
				$this->ExportData();
				$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "rekon_masterlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Set up Breadcrumb
		if ($this->Export == "")
			$this->SetupBreadcrumb();

		// Render row
		$this->RowType = EW_ROWTYPE_VIEW;
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = &$options["action"];

		// Add
		$item = &$option->Add("add");
		$addcaption = ew_HtmlTitle($Language->Phrase("ViewPageAddLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ewAction ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"javascript:void(0);\" onclick=\"ew_ModalDialogShow({lnk:this,url:'" . ew_HtmlEncode($this->AddUrl) . "',caption:'" . $addcaption . "'});\">" . $Language->Phrase("ViewPageAddLink") . "</a>";
		else
			$item->Body = "<a class=\"ewAction ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . ew_HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("ViewPageAddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->CanAdd());

		// Edit
		$item = &$option->Add("edit");
		$editcaption = ew_HtmlTitle($Language->Phrase("ViewPageEditLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ewAction ewEdit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"javascript:void(0);\" onclick=\"ew_ModalDialogShow({lnk:this,url:'" . ew_HtmlEncode($this->EditUrl) . "',caption:'" . $editcaption . "'});\">" . $Language->Phrase("ViewPageEditLink") . "</a>";
		else
			$item->Body = "<a class=\"ewAction ewEdit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . ew_HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("ViewPageEditLink") . "</a>";
		$item->Visible = ($this->EditUrl <> "" && $Security->CanEdit());

		// Copy
		$item = &$option->Add("copy");
		$copycaption = ew_HtmlTitle($Language->Phrase("ViewPageCopyLink"));
		if ($this->IsModal) // Modal
			$item->Body = "<a class=\"ewAction ewCopy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"javascript:void(0);\" onclick=\"ew_ModalDialogShow({lnk:this,url:'" . ew_HtmlEncode($this->CopyUrl) . "',caption:'" . $copycaption . "'});\">" . $Language->Phrase("ViewPageCopyLink") . "</a>";
		else
			$item->Body = "<a class=\"ewAction ewCopy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . ew_HtmlEncode($this->CopyUrl) . "\">" . $Language->Phrase("ViewPageCopyLink") . "</a>";
		$item->Visible = ($this->CopyUrl <> "" && $Security->CanAdd());

		// Delete
		$item = &$option->Add("delete");
		if ($this->IsModal) // Handle as inline delete
			$item->Body = "<a onclick=\"return ew_ConfirmDelete(this);\" class=\"ewAction ewDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("ViewPageDeleteLink")) . "\" href=\"" . ew_HtmlEncode(ew_AddQueryStringToUrl($this->DeleteUrl, "a_delete=1")) . "\">" . $Language->Phrase("ViewPageDeleteLink") . "</a>";
		else
			$item->Body = "<a class=\"ewAction ewDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("ViewPageDeleteLink")) . "\" href=\"" . ew_HtmlEncode($this->DeleteUrl) . "\">" . $Language->Phrase("ViewPageDeleteLink") . "</a>";
		$item->Visible = ($this->DeleteUrl <> "" && $Security->CanDelete());

		// Set up action default
		$option = &$options["action"];
		$option->DropDownButtonPhrase = $Language->Phrase("ButtonActions");
		$option->UseImageAndText = TRUE;
		$option->UseDropDownButton = FALSE;
		$option->UseButtonGroup = TRUE;
		$item = &$option->Add($option->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
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
		$this->AddUrl = $this->GetAddUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();
		$this->ListUrl = $this->GetListUrl();
		$this->SetupOtherOptions();

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
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->Add("print");
		$item->Body = "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ewExportLink ewPrint\" title=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\">" . $Language->Phrase("PrinterFriendly") . "</a>";
		$item->Visible = TRUE;

		// Export to Excel
		$item = &$this->ExportOptions->Add("excel");
		$item->Body = "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ewExportLink ewExcel\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcelText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcelText")) . "\">" . $Language->Phrase("ExportToExcel") . "</a>";
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->Add("word");
		$item->Body = "<a href=\"" . $this->ExportWordUrl . "\" class=\"ewExportLink ewWord\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToWordText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToWordText")) . "\">" . $Language->Phrase("ExportToWord") . "</a>";
		$item->Visible = TRUE;

		// Export to Html
		$item = &$this->ExportOptions->Add("html");
		$item->Body = "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ewExportLink ewHtml\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtmlText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtmlText")) . "\">" . $Language->Phrase("ExportToHtml") . "</a>";
		$item->Visible = TRUE;

		// Export to Xml
		$item = &$this->ExportOptions->Add("xml");
		$item->Body = "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ewExportLink ewXml\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToXmlText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToXmlText")) . "\">" . $Language->Phrase("ExportToXml") . "</a>";
		$item->Visible = TRUE;

		// Export to Csv
		$item = &$this->ExportOptions->Add("csv");
		$item->Body = "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ewExportLink ewCsv\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsvText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsvText")) . "\">" . $Language->Phrase("ExportToCsv") . "</a>";
		$item->Visible = TRUE;

		// Export to Pdf
		$item = &$this->ExportOptions->Add("pdf");
		$item->Body = "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ewExportLink ewPdf\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToPDFText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToPDFText")) . "\">" . $Language->Phrase("ExportToPDF") . "</a>";
		$item->Visible = TRUE;

		// Export to Email
		$item = &$this->ExportOptions->Add("email");
		$url = "";
		$item->Body = "<button id=\"emf_rekon_master\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_rekon_master',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.frekon_masterview,key:" . ew_ArrayToJsonAttr($this->RecKey) . ",sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
		$item->Visible = TRUE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseImageAndText = TRUE;
		$this->ExportOptions->UseDropDownButton = TRUE;
		if ($this->ExportOptions->UseButtonGroup && ew_IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->Phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->Add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide options for export
		if ($this->Export <> "")
			$this->ExportOptions->HideAllOptions();
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = FALSE;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $this->SelectRecordCount();
		} else {
			if (!$this->Recordset)
				$this->Recordset = $this->LoadRecordset();
			$rs = &$this->Recordset;
			if ($rs)
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;
		$this->SetUpStartRec(); // Set up start record position

		// Set the last record to display
		if ($this->DisplayRecs <= 0) {
			$this->StopRec = $this->TotalRecs;
		} else {
			$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
		}
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		$this->ExportDoc = ew_ExportDocument($this, "v");
		$Doc = &$this->ExportDoc;
		if ($bSelectLimit) {
			$this->StartRec = 1;
			$this->StopRec = $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs;
		} else {

			//$this->StartRec = $this->StartRec;
			//$this->StopRec = $this->StopRec;

		}

		// Call Page Exporting server event
		$this->ExportDoc->ExportCustom = !$this->Page_Exporting();
		$ParentTable = "";
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		$Doc->Text .= $sHeader;
		$this->ExportDocument($Doc, $rs, $this->StartRec, $this->StopRec, "view");
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		$Doc->Text .= $sFooter;

		// Close recordset
		$rs->Close();

		// Call Page Exported server event
		$this->Page_Exported();

		// Export header and footer
		$Doc->ExportHeaderAndFooter();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED && $this->Export <> "pdf")
			echo ew_DebugMsg();

		// Output data
		if ($this->Export == "email") {
			echo $this->ExportEmail($Doc->Text);
		} else {
			$Doc->Export();
		}
	}

	// Export email
	function ExportEmail($EmailContent) {
		global $gTmpImages, $Language;
		$sSender = @$_POST["sender"];
		$sRecipient = @$_POST["recipient"];
		$sCc = @$_POST["cc"];
		$sBcc = @$_POST["bcc"];
		$sContentType = @$_POST["contenttype"];

		// Subject
		$sSubject = ew_StripSlashes(@$_POST["subject"]);
		$sEmailSubject = $sSubject;

		// Message
		$sContent = ew_StripSlashes(@$_POST["message"]);
		$sEmailMessage = $sContent;

		// Check sender
		if ($sSender == "") {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterSenderEmail") . "</p>";
		}
		if (!ew_CheckEmail($sSender)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperSenderEmail") . "</p>";
		}

		// Check recipient
		if (!ew_CheckEmailList($sRecipient, EW_MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperRecipientEmail") . "</p>";
		}

		// Check cc
		if (!ew_CheckEmailList($sCc, EW_MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperCcEmail") . "</p>";
		}

		// Check bcc
		if (!ew_CheckEmailList($sBcc, EW_MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperBccEmail") . "</p>";
		}

		// Check email sent count
		if (!isset($_SESSION[EW_EXPORT_EMAIL_COUNTER]))
			$_SESSION[EW_EXPORT_EMAIL_COUNTER] = 0;
		if (intval($_SESSION[EW_EXPORT_EMAIL_COUNTER]) > EW_MAX_EMAIL_SENT_COUNT) {
			return "<p class=\"text-danger\">" . $Language->Phrase("ExceedMaxEmailExport") . "</p>";
		}

		// Send email
		$Email = new cEmail();
		$Email->Sender = $sSender; // Sender
		$Email->Recipient = $sRecipient; // Recipient
		$Email->Cc = $sCc; // Cc
		$Email->Bcc = $sBcc; // Bcc
		$Email->Subject = $sEmailSubject; // Subject
		$Email->Format = ($sContentType == "url") ? "text" : "html";
		if ($sEmailMessage <> "") {
			$sEmailMessage = ew_RemoveXSS($sEmailMessage);
			$sEmailMessage .= ($sContentType == "url") ? "\r\n\r\n" : "<br><br>";
		}
		if ($sContentType == "url") {
			$sUrl = ew_ConvertFullUrl(ew_CurrentPage() . "?" . $this->ExportQueryString());
			$sEmailMessage .= $sUrl; // Send URL only
		} else {
			foreach ($gTmpImages as $tmpimage)
				$Email->AddEmbeddedImage($tmpimage);
			$sEmailMessage .= ew_CleanEmailContent($EmailContent); // Send HTML
		}
		$Email->Content = $sEmailMessage; // Content
		$EventArgs = array();
		if ($this->Recordset) {
			$this->RecCnt = $this->StartRec - 1;
			$this->Recordset->MoveFirst();
			if ($this->StartRec > 1)
				$this->Recordset->Move($this->StartRec - 1);
			$EventArgs["rs"] = &$this->Recordset;
		}
		$bEmailSent = FALSE;
		if ($this->Email_Sending($Email, $EventArgs))
			$bEmailSent = $Email->Send();

		// Check email sent status
		if ($bEmailSent) {

			// Update email sent count
			$_SESSION[EW_EXPORT_EMAIL_COUNTER]++;

			// Sent email success
			return "<p class=\"text-success\">" . $Language->Phrase("SendEmailSuccess") . "</p>"; // Set up success message
		} else {

			// Sent email failure
			return "<p class=\"text-danger\">" . $Email->SendErrDescription . "</p>";
		}
	}

	// Export QueryString
	function ExportQueryString() {

		// Initialize
		$sQry = "export=html";

		// Add record key QueryString
		$sQry .= "&" . substr($this->KeyUrl("", ""), 1);
		return $sQry;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("rekon_masterlist.php"), "", $this->TableVar, TRUE);
		$PageId = "view";
		$Breadcrumb->Add("view", $PageId, $url);
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

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($rekon_master_view)) $rekon_master_view = new crekon_master_view();

// Page init
$rekon_master_view->Page_Init();

// Page main
$rekon_master_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rekon_master_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($rekon_master->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = frekon_masterview = new ew_Form("frekon_masterview", "view");

// Form_CustomValidate event
frekon_masterview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
frekon_masterview.ValidateRequired = true;
<?php } else { ?>
frekon_masterview.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($rekon_master->Export == "") { ?>
<div class="ewToolbar">
<?php if (!$rekon_master_view->IsModal) { ?>
<?php if ($rekon_master->Export == "") { ?>
<?php $Breadcrumb->Render(); ?>
<?php } ?>
<?php } ?>
<?php $rekon_master_view->ExportOptions->Render("body") ?>
<?php
	foreach ($rekon_master_view->OtherOptions as &$option)
		$option->Render("body");
?>
<?php if (!$rekon_master_view->IsModal) { ?>
<?php if ($rekon_master->Export == "") { ?>
<?php echo $Language->SelectionForm(); ?>
<?php } ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $rekon_master_view->ShowPageHeader(); ?>
<?php
$rekon_master_view->ShowMessage();
?>
<form name="frekon_masterview" id="frekon_masterview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rekon_master_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rekon_master_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rekon_master">
<?php if ($rekon_master_view->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<table class="table table-bordered table-striped ewViewTable">
<?php if ($rekon_master->rm_id->Visible) { // rm_id ?>
	<tr id="r_rm_id">
		<td><span id="elh_rekon_master_rm_id"><?php echo $rekon_master->rm_id->FldCaption() ?></span></td>
		<td data-name="rm_id"<?php echo $rekon_master->rm_id->CellAttributes() ?>>
<span id="el_rekon_master_rm_id">
<span<?php echo $rekon_master->rm_id->ViewAttributes() ?>>
<?php echo $rekon_master->rm_id->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->pegawai_id->Visible) { // pegawai_id ?>
	<tr id="r_pegawai_id">
		<td><span id="elh_rekon_master_pegawai_id"><?php echo $rekon_master->pegawai_id->FldCaption() ?></span></td>
		<td data-name="pegawai_id"<?php echo $rekon_master->pegawai_id->CellAttributes() ?>>
<span id="el_rekon_master_pegawai_id">
<span<?php echo $rekon_master->pegawai_id->ViewAttributes() ?>>
<?php echo $rekon_master->pegawai_id->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f1->Visible) { // f1 ?>
	<tr id="r_f1">
		<td><span id="elh_rekon_master_f1"><?php echo $rekon_master->f1->FldCaption() ?></span></td>
		<td data-name="f1"<?php echo $rekon_master->f1->CellAttributes() ?>>
<span id="el_rekon_master_f1">
<span<?php echo $rekon_master->f1->ViewAttributes() ?>>
<?php echo $rekon_master->f1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f2->Visible) { // f2 ?>
	<tr id="r_f2">
		<td><span id="elh_rekon_master_f2"><?php echo $rekon_master->f2->FldCaption() ?></span></td>
		<td data-name="f2"<?php echo $rekon_master->f2->CellAttributes() ?>>
<span id="el_rekon_master_f2">
<span<?php echo $rekon_master->f2->ViewAttributes() ?>>
<?php echo $rekon_master->f2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f3->Visible) { // f3 ?>
	<tr id="r_f3">
		<td><span id="elh_rekon_master_f3"><?php echo $rekon_master->f3->FldCaption() ?></span></td>
		<td data-name="f3"<?php echo $rekon_master->f3->CellAttributes() ?>>
<span id="el_rekon_master_f3">
<span<?php echo $rekon_master->f3->ViewAttributes() ?>>
<?php echo $rekon_master->f3->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f4->Visible) { // f4 ?>
	<tr id="r_f4">
		<td><span id="elh_rekon_master_f4"><?php echo $rekon_master->f4->FldCaption() ?></span></td>
		<td data-name="f4"<?php echo $rekon_master->f4->CellAttributes() ?>>
<span id="el_rekon_master_f4">
<span<?php echo $rekon_master->f4->ViewAttributes() ?>>
<?php echo $rekon_master->f4->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f5->Visible) { // f5 ?>
	<tr id="r_f5">
		<td><span id="elh_rekon_master_f5"><?php echo $rekon_master->f5->FldCaption() ?></span></td>
		<td data-name="f5"<?php echo $rekon_master->f5->CellAttributes() ?>>
<span id="el_rekon_master_f5">
<span<?php echo $rekon_master->f5->ViewAttributes() ?>>
<?php echo $rekon_master->f5->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f6->Visible) { // f6 ?>
	<tr id="r_f6">
		<td><span id="elh_rekon_master_f6"><?php echo $rekon_master->f6->FldCaption() ?></span></td>
		<td data-name="f6"<?php echo $rekon_master->f6->CellAttributes() ?>>
<span id="el_rekon_master_f6">
<span<?php echo $rekon_master->f6->ViewAttributes() ?>>
<?php echo $rekon_master->f6->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f7->Visible) { // f7 ?>
	<tr id="r_f7">
		<td><span id="elh_rekon_master_f7"><?php echo $rekon_master->f7->FldCaption() ?></span></td>
		<td data-name="f7"<?php echo $rekon_master->f7->CellAttributes() ?>>
<span id="el_rekon_master_f7">
<span<?php echo $rekon_master->f7->ViewAttributes() ?>>
<?php echo $rekon_master->f7->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f8->Visible) { // f8 ?>
	<tr id="r_f8">
		<td><span id="elh_rekon_master_f8"><?php echo $rekon_master->f8->FldCaption() ?></span></td>
		<td data-name="f8"<?php echo $rekon_master->f8->CellAttributes() ?>>
<span id="el_rekon_master_f8">
<span<?php echo $rekon_master->f8->ViewAttributes() ?>>
<?php echo $rekon_master->f8->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f9->Visible) { // f9 ?>
	<tr id="r_f9">
		<td><span id="elh_rekon_master_f9"><?php echo $rekon_master->f9->FldCaption() ?></span></td>
		<td data-name="f9"<?php echo $rekon_master->f9->CellAttributes() ?>>
<span id="el_rekon_master_f9">
<span<?php echo $rekon_master->f9->ViewAttributes() ?>>
<?php echo $rekon_master->f9->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f10->Visible) { // f10 ?>
	<tr id="r_f10">
		<td><span id="elh_rekon_master_f10"><?php echo $rekon_master->f10->FldCaption() ?></span></td>
		<td data-name="f10"<?php echo $rekon_master->f10->CellAttributes() ?>>
<span id="el_rekon_master_f10">
<span<?php echo $rekon_master->f10->ViewAttributes() ?>>
<?php echo $rekon_master->f10->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f11->Visible) { // f11 ?>
	<tr id="r_f11">
		<td><span id="elh_rekon_master_f11"><?php echo $rekon_master->f11->FldCaption() ?></span></td>
		<td data-name="f11"<?php echo $rekon_master->f11->CellAttributes() ?>>
<span id="el_rekon_master_f11">
<span<?php echo $rekon_master->f11->ViewAttributes() ?>>
<?php echo $rekon_master->f11->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f12->Visible) { // f12 ?>
	<tr id="r_f12">
		<td><span id="elh_rekon_master_f12"><?php echo $rekon_master->f12->FldCaption() ?></span></td>
		<td data-name="f12"<?php echo $rekon_master->f12->CellAttributes() ?>>
<span id="el_rekon_master_f12">
<span<?php echo $rekon_master->f12->ViewAttributes() ?>>
<?php echo $rekon_master->f12->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f13->Visible) { // f13 ?>
	<tr id="r_f13">
		<td><span id="elh_rekon_master_f13"><?php echo $rekon_master->f13->FldCaption() ?></span></td>
		<td data-name="f13"<?php echo $rekon_master->f13->CellAttributes() ?>>
<span id="el_rekon_master_f13">
<span<?php echo $rekon_master->f13->ViewAttributes() ?>>
<?php echo $rekon_master->f13->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f14->Visible) { // f14 ?>
	<tr id="r_f14">
		<td><span id="elh_rekon_master_f14"><?php echo $rekon_master->f14->FldCaption() ?></span></td>
		<td data-name="f14"<?php echo $rekon_master->f14->CellAttributes() ?>>
<span id="el_rekon_master_f14">
<span<?php echo $rekon_master->f14->ViewAttributes() ?>>
<?php echo $rekon_master->f14->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f15->Visible) { // f15 ?>
	<tr id="r_f15">
		<td><span id="elh_rekon_master_f15"><?php echo $rekon_master->f15->FldCaption() ?></span></td>
		<td data-name="f15"<?php echo $rekon_master->f15->CellAttributes() ?>>
<span id="el_rekon_master_f15">
<span<?php echo $rekon_master->f15->ViewAttributes() ?>>
<?php echo $rekon_master->f15->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f16->Visible) { // f16 ?>
	<tr id="r_f16">
		<td><span id="elh_rekon_master_f16"><?php echo $rekon_master->f16->FldCaption() ?></span></td>
		<td data-name="f16"<?php echo $rekon_master->f16->CellAttributes() ?>>
<span id="el_rekon_master_f16">
<span<?php echo $rekon_master->f16->ViewAttributes() ?>>
<?php echo $rekon_master->f16->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f17->Visible) { // f17 ?>
	<tr id="r_f17">
		<td><span id="elh_rekon_master_f17"><?php echo $rekon_master->f17->FldCaption() ?></span></td>
		<td data-name="f17"<?php echo $rekon_master->f17->CellAttributes() ?>>
<span id="el_rekon_master_f17">
<span<?php echo $rekon_master->f17->ViewAttributes() ?>>
<?php echo $rekon_master->f17->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f18->Visible) { // f18 ?>
	<tr id="r_f18">
		<td><span id="elh_rekon_master_f18"><?php echo $rekon_master->f18->FldCaption() ?></span></td>
		<td data-name="f18"<?php echo $rekon_master->f18->CellAttributes() ?>>
<span id="el_rekon_master_f18">
<span<?php echo $rekon_master->f18->ViewAttributes() ?>>
<?php echo $rekon_master->f18->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f19->Visible) { // f19 ?>
	<tr id="r_f19">
		<td><span id="elh_rekon_master_f19"><?php echo $rekon_master->f19->FldCaption() ?></span></td>
		<td data-name="f19"<?php echo $rekon_master->f19->CellAttributes() ?>>
<span id="el_rekon_master_f19">
<span<?php echo $rekon_master->f19->ViewAttributes() ?>>
<?php echo $rekon_master->f19->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f20->Visible) { // f20 ?>
	<tr id="r_f20">
		<td><span id="elh_rekon_master_f20"><?php echo $rekon_master->f20->FldCaption() ?></span></td>
		<td data-name="f20"<?php echo $rekon_master->f20->CellAttributes() ?>>
<span id="el_rekon_master_f20">
<span<?php echo $rekon_master->f20->ViewAttributes() ?>>
<?php echo $rekon_master->f20->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f21->Visible) { // f21 ?>
	<tr id="r_f21">
		<td><span id="elh_rekon_master_f21"><?php echo $rekon_master->f21->FldCaption() ?></span></td>
		<td data-name="f21"<?php echo $rekon_master->f21->CellAttributes() ?>>
<span id="el_rekon_master_f21">
<span<?php echo $rekon_master->f21->ViewAttributes() ?>>
<?php echo $rekon_master->f21->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f22->Visible) { // f22 ?>
	<tr id="r_f22">
		<td><span id="elh_rekon_master_f22"><?php echo $rekon_master->f22->FldCaption() ?></span></td>
		<td data-name="f22"<?php echo $rekon_master->f22->CellAttributes() ?>>
<span id="el_rekon_master_f22">
<span<?php echo $rekon_master->f22->ViewAttributes() ?>>
<?php echo $rekon_master->f22->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f23->Visible) { // f23 ?>
	<tr id="r_f23">
		<td><span id="elh_rekon_master_f23"><?php echo $rekon_master->f23->FldCaption() ?></span></td>
		<td data-name="f23"<?php echo $rekon_master->f23->CellAttributes() ?>>
<span id="el_rekon_master_f23">
<span<?php echo $rekon_master->f23->ViewAttributes() ?>>
<?php echo $rekon_master->f23->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f24->Visible) { // f24 ?>
	<tr id="r_f24">
		<td><span id="elh_rekon_master_f24"><?php echo $rekon_master->f24->FldCaption() ?></span></td>
		<td data-name="f24"<?php echo $rekon_master->f24->CellAttributes() ?>>
<span id="el_rekon_master_f24">
<span<?php echo $rekon_master->f24->ViewAttributes() ?>>
<?php echo $rekon_master->f24->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f25->Visible) { // f25 ?>
	<tr id="r_f25">
		<td><span id="elh_rekon_master_f25"><?php echo $rekon_master->f25->FldCaption() ?></span></td>
		<td data-name="f25"<?php echo $rekon_master->f25->CellAttributes() ?>>
<span id="el_rekon_master_f25">
<span<?php echo $rekon_master->f25->ViewAttributes() ?>>
<?php echo $rekon_master->f25->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f26->Visible) { // f26 ?>
	<tr id="r_f26">
		<td><span id="elh_rekon_master_f26"><?php echo $rekon_master->f26->FldCaption() ?></span></td>
		<td data-name="f26"<?php echo $rekon_master->f26->CellAttributes() ?>>
<span id="el_rekon_master_f26">
<span<?php echo $rekon_master->f26->ViewAttributes() ?>>
<?php echo $rekon_master->f26->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f27->Visible) { // f27 ?>
	<tr id="r_f27">
		<td><span id="elh_rekon_master_f27"><?php echo $rekon_master->f27->FldCaption() ?></span></td>
		<td data-name="f27"<?php echo $rekon_master->f27->CellAttributes() ?>>
<span id="el_rekon_master_f27">
<span<?php echo $rekon_master->f27->ViewAttributes() ?>>
<?php echo $rekon_master->f27->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f28->Visible) { // f28 ?>
	<tr id="r_f28">
		<td><span id="elh_rekon_master_f28"><?php echo $rekon_master->f28->FldCaption() ?></span></td>
		<td data-name="f28"<?php echo $rekon_master->f28->CellAttributes() ?>>
<span id="el_rekon_master_f28">
<span<?php echo $rekon_master->f28->ViewAttributes() ?>>
<?php echo $rekon_master->f28->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f29->Visible) { // f29 ?>
	<tr id="r_f29">
		<td><span id="elh_rekon_master_f29"><?php echo $rekon_master->f29->FldCaption() ?></span></td>
		<td data-name="f29"<?php echo $rekon_master->f29->CellAttributes() ?>>
<span id="el_rekon_master_f29">
<span<?php echo $rekon_master->f29->ViewAttributes() ?>>
<?php echo $rekon_master->f29->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f30->Visible) { // f30 ?>
	<tr id="r_f30">
		<td><span id="elh_rekon_master_f30"><?php echo $rekon_master->f30->FldCaption() ?></span></td>
		<td data-name="f30"<?php echo $rekon_master->f30->CellAttributes() ?>>
<span id="el_rekon_master_f30">
<span<?php echo $rekon_master->f30->ViewAttributes() ?>>
<?php echo $rekon_master->f30->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f31->Visible) { // f31 ?>
	<tr id="r_f31">
		<td><span id="elh_rekon_master_f31"><?php echo $rekon_master->f31->FldCaption() ?></span></td>
		<td data-name="f31"<?php echo $rekon_master->f31->CellAttributes() ?>>
<span id="el_rekon_master_f31">
<span<?php echo $rekon_master->f31->ViewAttributes() ?>>
<?php echo $rekon_master->f31->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f32->Visible) { // f32 ?>
	<tr id="r_f32">
		<td><span id="elh_rekon_master_f32"><?php echo $rekon_master->f32->FldCaption() ?></span></td>
		<td data-name="f32"<?php echo $rekon_master->f32->CellAttributes() ?>>
<span id="el_rekon_master_f32">
<span<?php echo $rekon_master->f32->ViewAttributes() ?>>
<?php echo $rekon_master->f32->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f33->Visible) { // f33 ?>
	<tr id="r_f33">
		<td><span id="elh_rekon_master_f33"><?php echo $rekon_master->f33->FldCaption() ?></span></td>
		<td data-name="f33"<?php echo $rekon_master->f33->CellAttributes() ?>>
<span id="el_rekon_master_f33">
<span<?php echo $rekon_master->f33->ViewAttributes() ?>>
<?php echo $rekon_master->f33->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f34->Visible) { // f34 ?>
	<tr id="r_f34">
		<td><span id="elh_rekon_master_f34"><?php echo $rekon_master->f34->FldCaption() ?></span></td>
		<td data-name="f34"<?php echo $rekon_master->f34->CellAttributes() ?>>
<span id="el_rekon_master_f34">
<span<?php echo $rekon_master->f34->ViewAttributes() ?>>
<?php echo $rekon_master->f34->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f35->Visible) { // f35 ?>
	<tr id="r_f35">
		<td><span id="elh_rekon_master_f35"><?php echo $rekon_master->f35->FldCaption() ?></span></td>
		<td data-name="f35"<?php echo $rekon_master->f35->CellAttributes() ?>>
<span id="el_rekon_master_f35">
<span<?php echo $rekon_master->f35->ViewAttributes() ?>>
<?php echo $rekon_master->f35->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f36->Visible) { // f36 ?>
	<tr id="r_f36">
		<td><span id="elh_rekon_master_f36"><?php echo $rekon_master->f36->FldCaption() ?></span></td>
		<td data-name="f36"<?php echo $rekon_master->f36->CellAttributes() ?>>
<span id="el_rekon_master_f36">
<span<?php echo $rekon_master->f36->ViewAttributes() ?>>
<?php echo $rekon_master->f36->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f37->Visible) { // f37 ?>
	<tr id="r_f37">
		<td><span id="elh_rekon_master_f37"><?php echo $rekon_master->f37->FldCaption() ?></span></td>
		<td data-name="f37"<?php echo $rekon_master->f37->CellAttributes() ?>>
<span id="el_rekon_master_f37">
<span<?php echo $rekon_master->f37->ViewAttributes() ?>>
<?php echo $rekon_master->f37->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f38->Visible) { // f38 ?>
	<tr id="r_f38">
		<td><span id="elh_rekon_master_f38"><?php echo $rekon_master->f38->FldCaption() ?></span></td>
		<td data-name="f38"<?php echo $rekon_master->f38->CellAttributes() ?>>
<span id="el_rekon_master_f38">
<span<?php echo $rekon_master->f38->ViewAttributes() ?>>
<?php echo $rekon_master->f38->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f39->Visible) { // f39 ?>
	<tr id="r_f39">
		<td><span id="elh_rekon_master_f39"><?php echo $rekon_master->f39->FldCaption() ?></span></td>
		<td data-name="f39"<?php echo $rekon_master->f39->CellAttributes() ?>>
<span id="el_rekon_master_f39">
<span<?php echo $rekon_master->f39->ViewAttributes() ?>>
<?php echo $rekon_master->f39->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f40->Visible) { // f40 ?>
	<tr id="r_f40">
		<td><span id="elh_rekon_master_f40"><?php echo $rekon_master->f40->FldCaption() ?></span></td>
		<td data-name="f40"<?php echo $rekon_master->f40->CellAttributes() ?>>
<span id="el_rekon_master_f40">
<span<?php echo $rekon_master->f40->ViewAttributes() ?>>
<?php echo $rekon_master->f40->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f41->Visible) { // f41 ?>
	<tr id="r_f41">
		<td><span id="elh_rekon_master_f41"><?php echo $rekon_master->f41->FldCaption() ?></span></td>
		<td data-name="f41"<?php echo $rekon_master->f41->CellAttributes() ?>>
<span id="el_rekon_master_f41">
<span<?php echo $rekon_master->f41->ViewAttributes() ?>>
<?php echo $rekon_master->f41->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f42->Visible) { // f42 ?>
	<tr id="r_f42">
		<td><span id="elh_rekon_master_f42"><?php echo $rekon_master->f42->FldCaption() ?></span></td>
		<td data-name="f42"<?php echo $rekon_master->f42->CellAttributes() ?>>
<span id="el_rekon_master_f42">
<span<?php echo $rekon_master->f42->ViewAttributes() ?>>
<?php echo $rekon_master->f42->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f43->Visible) { // f43 ?>
	<tr id="r_f43">
		<td><span id="elh_rekon_master_f43"><?php echo $rekon_master->f43->FldCaption() ?></span></td>
		<td data-name="f43"<?php echo $rekon_master->f43->CellAttributes() ?>>
<span id="el_rekon_master_f43">
<span<?php echo $rekon_master->f43->ViewAttributes() ?>>
<?php echo $rekon_master->f43->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f44->Visible) { // f44 ?>
	<tr id="r_f44">
		<td><span id="elh_rekon_master_f44"><?php echo $rekon_master->f44->FldCaption() ?></span></td>
		<td data-name="f44"<?php echo $rekon_master->f44->CellAttributes() ?>>
<span id="el_rekon_master_f44">
<span<?php echo $rekon_master->f44->ViewAttributes() ?>>
<?php echo $rekon_master->f44->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f45->Visible) { // f45 ?>
	<tr id="r_f45">
		<td><span id="elh_rekon_master_f45"><?php echo $rekon_master->f45->FldCaption() ?></span></td>
		<td data-name="f45"<?php echo $rekon_master->f45->CellAttributes() ?>>
<span id="el_rekon_master_f45">
<span<?php echo $rekon_master->f45->ViewAttributes() ?>>
<?php echo $rekon_master->f45->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f46->Visible) { // f46 ?>
	<tr id="r_f46">
		<td><span id="elh_rekon_master_f46"><?php echo $rekon_master->f46->FldCaption() ?></span></td>
		<td data-name="f46"<?php echo $rekon_master->f46->CellAttributes() ?>>
<span id="el_rekon_master_f46">
<span<?php echo $rekon_master->f46->ViewAttributes() ?>>
<?php echo $rekon_master->f46->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f47->Visible) { // f47 ?>
	<tr id="r_f47">
		<td><span id="elh_rekon_master_f47"><?php echo $rekon_master->f47->FldCaption() ?></span></td>
		<td data-name="f47"<?php echo $rekon_master->f47->CellAttributes() ?>>
<span id="el_rekon_master_f47">
<span<?php echo $rekon_master->f47->ViewAttributes() ?>>
<?php echo $rekon_master->f47->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f48->Visible) { // f48 ?>
	<tr id="r_f48">
		<td><span id="elh_rekon_master_f48"><?php echo $rekon_master->f48->FldCaption() ?></span></td>
		<td data-name="f48"<?php echo $rekon_master->f48->CellAttributes() ?>>
<span id="el_rekon_master_f48">
<span<?php echo $rekon_master->f48->ViewAttributes() ?>>
<?php echo $rekon_master->f48->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f49->Visible) { // f49 ?>
	<tr id="r_f49">
		<td><span id="elh_rekon_master_f49"><?php echo $rekon_master->f49->FldCaption() ?></span></td>
		<td data-name="f49"<?php echo $rekon_master->f49->CellAttributes() ?>>
<span id="el_rekon_master_f49">
<span<?php echo $rekon_master->f49->ViewAttributes() ?>>
<?php echo $rekon_master->f49->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f50->Visible) { // f50 ?>
	<tr id="r_f50">
		<td><span id="elh_rekon_master_f50"><?php echo $rekon_master->f50->FldCaption() ?></span></td>
		<td data-name="f50"<?php echo $rekon_master->f50->CellAttributes() ?>>
<span id="el_rekon_master_f50">
<span<?php echo $rekon_master->f50->ViewAttributes() ?>>
<?php echo $rekon_master->f50->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f51->Visible) { // f51 ?>
	<tr id="r_f51">
		<td><span id="elh_rekon_master_f51"><?php echo $rekon_master->f51->FldCaption() ?></span></td>
		<td data-name="f51"<?php echo $rekon_master->f51->CellAttributes() ?>>
<span id="el_rekon_master_f51">
<span<?php echo $rekon_master->f51->ViewAttributes() ?>>
<?php echo $rekon_master->f51->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f52->Visible) { // f52 ?>
	<tr id="r_f52">
		<td><span id="elh_rekon_master_f52"><?php echo $rekon_master->f52->FldCaption() ?></span></td>
		<td data-name="f52"<?php echo $rekon_master->f52->CellAttributes() ?>>
<span id="el_rekon_master_f52">
<span<?php echo $rekon_master->f52->ViewAttributes() ?>>
<?php echo $rekon_master->f52->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f53->Visible) { // f53 ?>
	<tr id="r_f53">
		<td><span id="elh_rekon_master_f53"><?php echo $rekon_master->f53->FldCaption() ?></span></td>
		<td data-name="f53"<?php echo $rekon_master->f53->CellAttributes() ?>>
<span id="el_rekon_master_f53">
<span<?php echo $rekon_master->f53->ViewAttributes() ?>>
<?php echo $rekon_master->f53->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f54->Visible) { // f54 ?>
	<tr id="r_f54">
		<td><span id="elh_rekon_master_f54"><?php echo $rekon_master->f54->FldCaption() ?></span></td>
		<td data-name="f54"<?php echo $rekon_master->f54->CellAttributes() ?>>
<span id="el_rekon_master_f54">
<span<?php echo $rekon_master->f54->ViewAttributes() ?>>
<?php echo $rekon_master->f54->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f55->Visible) { // f55 ?>
	<tr id="r_f55">
		<td><span id="elh_rekon_master_f55"><?php echo $rekon_master->f55->FldCaption() ?></span></td>
		<td data-name="f55"<?php echo $rekon_master->f55->CellAttributes() ?>>
<span id="el_rekon_master_f55">
<span<?php echo $rekon_master->f55->ViewAttributes() ?>>
<?php echo $rekon_master->f55->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f56->Visible) { // f56 ?>
	<tr id="r_f56">
		<td><span id="elh_rekon_master_f56"><?php echo $rekon_master->f56->FldCaption() ?></span></td>
		<td data-name="f56"<?php echo $rekon_master->f56->CellAttributes() ?>>
<span id="el_rekon_master_f56">
<span<?php echo $rekon_master->f56->ViewAttributes() ?>>
<?php echo $rekon_master->f56->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f57->Visible) { // f57 ?>
	<tr id="r_f57">
		<td><span id="elh_rekon_master_f57"><?php echo $rekon_master->f57->FldCaption() ?></span></td>
		<td data-name="f57"<?php echo $rekon_master->f57->CellAttributes() ?>>
<span id="el_rekon_master_f57">
<span<?php echo $rekon_master->f57->ViewAttributes() ?>>
<?php echo $rekon_master->f57->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f58->Visible) { // f58 ?>
	<tr id="r_f58">
		<td><span id="elh_rekon_master_f58"><?php echo $rekon_master->f58->FldCaption() ?></span></td>
		<td data-name="f58"<?php echo $rekon_master->f58->CellAttributes() ?>>
<span id="el_rekon_master_f58">
<span<?php echo $rekon_master->f58->ViewAttributes() ?>>
<?php echo $rekon_master->f58->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f59->Visible) { // f59 ?>
	<tr id="r_f59">
		<td><span id="elh_rekon_master_f59"><?php echo $rekon_master->f59->FldCaption() ?></span></td>
		<td data-name="f59"<?php echo $rekon_master->f59->CellAttributes() ?>>
<span id="el_rekon_master_f59">
<span<?php echo $rekon_master->f59->ViewAttributes() ?>>
<?php echo $rekon_master->f59->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f60->Visible) { // f60 ?>
	<tr id="r_f60">
		<td><span id="elh_rekon_master_f60"><?php echo $rekon_master->f60->FldCaption() ?></span></td>
		<td data-name="f60"<?php echo $rekon_master->f60->CellAttributes() ?>>
<span id="el_rekon_master_f60">
<span<?php echo $rekon_master->f60->ViewAttributes() ?>>
<?php echo $rekon_master->f60->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f61->Visible) { // f61 ?>
	<tr id="r_f61">
		<td><span id="elh_rekon_master_f61"><?php echo $rekon_master->f61->FldCaption() ?></span></td>
		<td data-name="f61"<?php echo $rekon_master->f61->CellAttributes() ?>>
<span id="el_rekon_master_f61">
<span<?php echo $rekon_master->f61->ViewAttributes() ?>>
<?php echo $rekon_master->f61->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($rekon_master->f62->Visible) { // f62 ?>
	<tr id="r_f62">
		<td><span id="elh_rekon_master_f62"><?php echo $rekon_master->f62->FldCaption() ?></span></td>
		<td data-name="f62"<?php echo $rekon_master->f62->CellAttributes() ?>>
<span id="el_rekon_master_f62">
<span<?php echo $rekon_master->f62->ViewAttributes() ?>>
<?php echo $rekon_master->f62->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php if ($rekon_master->Export == "") { ?>
<script type="text/javascript">
frekon_masterview.Init();
</script>
<?php } ?>
<?php
$rekon_master_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($rekon_master->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$rekon_master_view->Page_Terminate();
?>
