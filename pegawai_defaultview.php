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

$pegawai_default_view = NULL; // Initialize page object first

class cpegawai_default_view extends cpegawai_default {

	// Page ID
	var $PageID = 'view';

	// Project ID
	var $ProjectID = "{4B5DAB39-E4BC-48DF-9311-E295A5F18030}";

	// Table name
	var $TableName = 'pegawai_default';

	// Page object name
	var $PageObjName = 'pegawai_default_view';

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

		// Table object (pegawai_default)
		if (!isset($GLOBALS["pegawai_default"]) || get_class($GLOBALS["pegawai_default"]) == "cpegawai_default") {
			$GLOBALS["pegawai_default"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["pegawai_default"];
		}
		$KeyUrl = "";
		if (@$_GET["pd_id"] <> "") {
			$this->RecKey["pd_id"] = $_GET["pd_id"];
			$KeyUrl .= "&amp;pd_id=" . urlencode($this->RecKey["pd_id"]);
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
				$this->Page_Terminate(ew_GetUrl("pegawai_defaultlist.php"));
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
		if (@$_GET["pd_id"] <> "") {
			if ($gsExportFile <> "") $gsExportFile .= "_";
			$gsExportFile .= ew_StripSlashes($_GET["pd_id"]);
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
		$this->pd_id->SetVisibility();
		$this->pd_id->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
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
			if (@$_GET["pd_id"] <> "") {
				$this->pd_id->setQueryStringValue($_GET["pd_id"]);
				$this->RecKey["pd_id"] = $this->pd_id->QueryStringValue;
			} elseif (@$_POST["pd_id"] <> "") {
				$this->pd_id->setFormValue($_POST["pd_id"]);
				$this->RecKey["pd_id"] = $this->pd_id->FormValue;
			} else {
				$sReturnUrl = "pegawai_defaultlist.php"; // Return to list
			}

			// Get action
			$this->CurrentAction = "I"; // Display form
			switch ($this->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "pegawai_defaultlist.php"; // No matching record, return to list
					}
			}

			// Export data only
			if ($this->CustomExport == "" && in_array($this->Export, array("html","word","excel","xml","csv","email","pdf"))) {
				$this->ExportData();
				$this->Page_Terminate(); // Terminate response
				exit();
			}
		} else {
			$sReturnUrl = "pegawai_defaultlist.php"; // Not page request, return to list
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
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderByList())));
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
		if ($this->AuditTrailOnView) $this->WriteAuditTrailOnView($row);
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

			// pd_id
			$this->pd_id->LinkCustomAttributes = "";
			$this->pd_id->HrefValue = "";
			$this->pd_id->TooltipValue = "";

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
		$item->Body = "<button id=\"emf_pegawai_default\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_pegawai_default',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fpegawai_defaultview,key:" . ew_ArrayToJsonAttr($this->RecKey) . ",sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("pegawai_defaultlist.php"), "", $this->TableVar, TRUE);
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
if (!isset($pegawai_default_view)) $pegawai_default_view = new cpegawai_default_view();

// Page init
$pegawai_default_view->Page_Init();

// Page main
$pegawai_default_view->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pegawai_default_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($pegawai_default->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "view";
var CurrentForm = fpegawai_defaultview = new ew_Form("fpegawai_defaultview", "view");

// Form_CustomValidate event
fpegawai_defaultview.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fpegawai_defaultview.ValidateRequired = true;
<?php } else { ?>
fpegawai_defaultview.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fpegawai_defaultview.Lists["x_pegawai_id"] = {"LinkField":"x_pegawai_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_pegawai_nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"pegawai"};
fpegawai_defaultview.Lists["x_dept_id"] = {"LinkField":"x_pembagian2_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_pembagian2_nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"pembagian2"};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($pegawai_default->Export == "") { ?>
<div class="ewToolbar">
<?php if (!$pegawai_default_view->IsModal) { ?>
<?php if ($pegawai_default->Export == "") { ?>
<?php $Breadcrumb->Render(); ?>
<?php } ?>
<?php } ?>
<?php $pegawai_default_view->ExportOptions->Render("body") ?>
<?php
	foreach ($pegawai_default_view->OtherOptions as &$option)
		$option->Render("body");
?>
<?php if (!$pegawai_default_view->IsModal) { ?>
<?php if ($pegawai_default->Export == "") { ?>
<?php echo $Language->SelectionForm(); ?>
<?php } ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $pegawai_default_view->ShowPageHeader(); ?>
<?php
$pegawai_default_view->ShowMessage();
?>
<form name="fpegawai_defaultview" id="fpegawai_defaultview" class="form-inline ewForm ewViewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($pegawai_default_view->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $pegawai_default_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pegawai_default">
<?php if ($pegawai_default_view->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<table class="table table-bordered table-striped ewViewTable">
<?php if ($pegawai_default->pd_id->Visible) { // pd_id ?>
	<tr id="r_pd_id">
		<td><span id="elh_pegawai_default_pd_id"><?php echo $pegawai_default->pd_id->FldCaption() ?></span></td>
		<td data-name="pd_id"<?php echo $pegawai_default->pd_id->CellAttributes() ?>>
<span id="el_pegawai_default_pd_id">
<span<?php echo $pegawai_default->pd_id->ViewAttributes() ?>>
<?php echo $pegawai_default->pd_id->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->pegawai_id->Visible) { // pegawai_id ?>
	<tr id="r_pegawai_id">
		<td><span id="elh_pegawai_default_pegawai_id"><?php echo $pegawai_default->pegawai_id->FldCaption() ?></span></td>
		<td data-name="pegawai_id"<?php echo $pegawai_default->pegawai_id->CellAttributes() ?>>
<span id="el_pegawai_default_pegawai_id">
<span<?php echo $pegawai_default->pegawai_id->ViewAttributes() ?>>
<?php echo $pegawai_default->pegawai_id->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->dept_id->Visible) { // dept_id ?>
	<tr id="r_dept_id">
		<td><span id="elh_pegawai_default_dept_id"><?php echo $pegawai_default->dept_id->FldCaption() ?></span></td>
		<td data-name="dept_id"<?php echo $pegawai_default->dept_id->CellAttributes() ?>>
<span id="el_pegawai_default_dept_id">
<span<?php echo $pegawai_default->dept_id->ViewAttributes() ?>>
<?php echo $pegawai_default->dept_id->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f0m1->Visible) { // f0m1 ?>
	<tr id="r_f0m1">
		<td><span id="elh_pegawai_default_f0m1"><?php echo $pegawai_default->f0m1->FldCaption() ?></span></td>
		<td data-name="f0m1"<?php echo $pegawai_default->f0m1->CellAttributes() ?>>
<span id="el_pegawai_default_f0m1">
<span<?php echo $pegawai_default->f0m1->ViewAttributes() ?>>
<?php echo $pegawai_default->f0m1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f0k1->Visible) { // f0k1 ?>
	<tr id="r_f0k1">
		<td><span id="elh_pegawai_default_f0k1"><?php echo $pegawai_default->f0k1->FldCaption() ?></span></td>
		<td data-name="f0k1"<?php echo $pegawai_default->f0k1->CellAttributes() ?>>
<span id="el_pegawai_default_f0k1">
<span<?php echo $pegawai_default->f0k1->ViewAttributes() ?>>
<?php echo $pegawai_default->f0k1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f1m1->Visible) { // f1m1 ?>
	<tr id="r_f1m1">
		<td><span id="elh_pegawai_default_f1m1"><?php echo $pegawai_default->f1m1->FldCaption() ?></span></td>
		<td data-name="f1m1"<?php echo $pegawai_default->f1m1->CellAttributes() ?>>
<span id="el_pegawai_default_f1m1">
<span<?php echo $pegawai_default->f1m1->ViewAttributes() ?>>
<?php echo $pegawai_default->f1m1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f1k1->Visible) { // f1k1 ?>
	<tr id="r_f1k1">
		<td><span id="elh_pegawai_default_f1k1"><?php echo $pegawai_default->f1k1->FldCaption() ?></span></td>
		<td data-name="f1k1"<?php echo $pegawai_default->f1k1->CellAttributes() ?>>
<span id="el_pegawai_default_f1k1">
<span<?php echo $pegawai_default->f1k1->ViewAttributes() ?>>
<?php echo $pegawai_default->f1k1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f2m1->Visible) { // f2m1 ?>
	<tr id="r_f2m1">
		<td><span id="elh_pegawai_default_f2m1"><?php echo $pegawai_default->f2m1->FldCaption() ?></span></td>
		<td data-name="f2m1"<?php echo $pegawai_default->f2m1->CellAttributes() ?>>
<span id="el_pegawai_default_f2m1">
<span<?php echo $pegawai_default->f2m1->ViewAttributes() ?>>
<?php echo $pegawai_default->f2m1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f2k1->Visible) { // f2k1 ?>
	<tr id="r_f2k1">
		<td><span id="elh_pegawai_default_f2k1"><?php echo $pegawai_default->f2k1->FldCaption() ?></span></td>
		<td data-name="f2k1"<?php echo $pegawai_default->f2k1->CellAttributes() ?>>
<span id="el_pegawai_default_f2k1">
<span<?php echo $pegawai_default->f2k1->ViewAttributes() ?>>
<?php echo $pegawai_default->f2k1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f3m1->Visible) { // f3m1 ?>
	<tr id="r_f3m1">
		<td><span id="elh_pegawai_default_f3m1"><?php echo $pegawai_default->f3m1->FldCaption() ?></span></td>
		<td data-name="f3m1"<?php echo $pegawai_default->f3m1->CellAttributes() ?>>
<span id="el_pegawai_default_f3m1">
<span<?php echo $pegawai_default->f3m1->ViewAttributes() ?>>
<?php echo $pegawai_default->f3m1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f3k1->Visible) { // f3k1 ?>
	<tr id="r_f3k1">
		<td><span id="elh_pegawai_default_f3k1"><?php echo $pegawai_default->f3k1->FldCaption() ?></span></td>
		<td data-name="f3k1"<?php echo $pegawai_default->f3k1->CellAttributes() ?>>
<span id="el_pegawai_default_f3k1">
<span<?php echo $pegawai_default->f3k1->ViewAttributes() ?>>
<?php echo $pegawai_default->f3k1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f4m1->Visible) { // f4m1 ?>
	<tr id="r_f4m1">
		<td><span id="elh_pegawai_default_f4m1"><?php echo $pegawai_default->f4m1->FldCaption() ?></span></td>
		<td data-name="f4m1"<?php echo $pegawai_default->f4m1->CellAttributes() ?>>
<span id="el_pegawai_default_f4m1">
<span<?php echo $pegawai_default->f4m1->ViewAttributes() ?>>
<?php echo $pegawai_default->f4m1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f4k1->Visible) { // f4k1 ?>
	<tr id="r_f4k1">
		<td><span id="elh_pegawai_default_f4k1"><?php echo $pegawai_default->f4k1->FldCaption() ?></span></td>
		<td data-name="f4k1"<?php echo $pegawai_default->f4k1->CellAttributes() ?>>
<span id="el_pegawai_default_f4k1">
<span<?php echo $pegawai_default->f4k1->ViewAttributes() ?>>
<?php echo $pegawai_default->f4k1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f5m1->Visible) { // f5m1 ?>
	<tr id="r_f5m1">
		<td><span id="elh_pegawai_default_f5m1"><?php echo $pegawai_default->f5m1->FldCaption() ?></span></td>
		<td data-name="f5m1"<?php echo $pegawai_default->f5m1->CellAttributes() ?>>
<span id="el_pegawai_default_f5m1">
<span<?php echo $pegawai_default->f5m1->ViewAttributes() ?>>
<?php echo $pegawai_default->f5m1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f5k1->Visible) { // f5k1 ?>
	<tr id="r_f5k1">
		<td><span id="elh_pegawai_default_f5k1"><?php echo $pegawai_default->f5k1->FldCaption() ?></span></td>
		<td data-name="f5k1"<?php echo $pegawai_default->f5k1->CellAttributes() ?>>
<span id="el_pegawai_default_f5k1">
<span<?php echo $pegawai_default->f5k1->ViewAttributes() ?>>
<?php echo $pegawai_default->f5k1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f6m1->Visible) { // f6m1 ?>
	<tr id="r_f6m1">
		<td><span id="elh_pegawai_default_f6m1"><?php echo $pegawai_default->f6m1->FldCaption() ?></span></td>
		<td data-name="f6m1"<?php echo $pegawai_default->f6m1->CellAttributes() ?>>
<span id="el_pegawai_default_f6m1">
<span<?php echo $pegawai_default->f6m1->ViewAttributes() ?>>
<?php echo $pegawai_default->f6m1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f6k1->Visible) { // f6k1 ?>
	<tr id="r_f6k1">
		<td><span id="elh_pegawai_default_f6k1"><?php echo $pegawai_default->f6k1->FldCaption() ?></span></td>
		<td data-name="f6k1"<?php echo $pegawai_default->f6k1->CellAttributes() ?>>
<span id="el_pegawai_default_f6k1">
<span<?php echo $pegawai_default->f6k1->ViewAttributes() ?>>
<?php echo $pegawai_default->f6k1->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f0m2->Visible) { // f0m2 ?>
	<tr id="r_f0m2">
		<td><span id="elh_pegawai_default_f0m2"><?php echo $pegawai_default->f0m2->FldCaption() ?></span></td>
		<td data-name="f0m2"<?php echo $pegawai_default->f0m2->CellAttributes() ?>>
<span id="el_pegawai_default_f0m2">
<span<?php echo $pegawai_default->f0m2->ViewAttributes() ?>>
<?php echo $pegawai_default->f0m2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f0k2->Visible) { // f0k2 ?>
	<tr id="r_f0k2">
		<td><span id="elh_pegawai_default_f0k2"><?php echo $pegawai_default->f0k2->FldCaption() ?></span></td>
		<td data-name="f0k2"<?php echo $pegawai_default->f0k2->CellAttributes() ?>>
<span id="el_pegawai_default_f0k2">
<span<?php echo $pegawai_default->f0k2->ViewAttributes() ?>>
<?php echo $pegawai_default->f0k2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f1m2->Visible) { // f1m2 ?>
	<tr id="r_f1m2">
		<td><span id="elh_pegawai_default_f1m2"><?php echo $pegawai_default->f1m2->FldCaption() ?></span></td>
		<td data-name="f1m2"<?php echo $pegawai_default->f1m2->CellAttributes() ?>>
<span id="el_pegawai_default_f1m2">
<span<?php echo $pegawai_default->f1m2->ViewAttributes() ?>>
<?php echo $pegawai_default->f1m2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f1k2->Visible) { // f1k2 ?>
	<tr id="r_f1k2">
		<td><span id="elh_pegawai_default_f1k2"><?php echo $pegawai_default->f1k2->FldCaption() ?></span></td>
		<td data-name="f1k2"<?php echo $pegawai_default->f1k2->CellAttributes() ?>>
<span id="el_pegawai_default_f1k2">
<span<?php echo $pegawai_default->f1k2->ViewAttributes() ?>>
<?php echo $pegawai_default->f1k2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f2m2->Visible) { // f2m2 ?>
	<tr id="r_f2m2">
		<td><span id="elh_pegawai_default_f2m2"><?php echo $pegawai_default->f2m2->FldCaption() ?></span></td>
		<td data-name="f2m2"<?php echo $pegawai_default->f2m2->CellAttributes() ?>>
<span id="el_pegawai_default_f2m2">
<span<?php echo $pegawai_default->f2m2->ViewAttributes() ?>>
<?php echo $pegawai_default->f2m2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f2k2->Visible) { // f2k2 ?>
	<tr id="r_f2k2">
		<td><span id="elh_pegawai_default_f2k2"><?php echo $pegawai_default->f2k2->FldCaption() ?></span></td>
		<td data-name="f2k2"<?php echo $pegawai_default->f2k2->CellAttributes() ?>>
<span id="el_pegawai_default_f2k2">
<span<?php echo $pegawai_default->f2k2->ViewAttributes() ?>>
<?php echo $pegawai_default->f2k2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f3m2->Visible) { // f3m2 ?>
	<tr id="r_f3m2">
		<td><span id="elh_pegawai_default_f3m2"><?php echo $pegawai_default->f3m2->FldCaption() ?></span></td>
		<td data-name="f3m2"<?php echo $pegawai_default->f3m2->CellAttributes() ?>>
<span id="el_pegawai_default_f3m2">
<span<?php echo $pegawai_default->f3m2->ViewAttributes() ?>>
<?php echo $pegawai_default->f3m2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f3k2->Visible) { // f3k2 ?>
	<tr id="r_f3k2">
		<td><span id="elh_pegawai_default_f3k2"><?php echo $pegawai_default->f3k2->FldCaption() ?></span></td>
		<td data-name="f3k2"<?php echo $pegawai_default->f3k2->CellAttributes() ?>>
<span id="el_pegawai_default_f3k2">
<span<?php echo $pegawai_default->f3k2->ViewAttributes() ?>>
<?php echo $pegawai_default->f3k2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f4m2->Visible) { // f4m2 ?>
	<tr id="r_f4m2">
		<td><span id="elh_pegawai_default_f4m2"><?php echo $pegawai_default->f4m2->FldCaption() ?></span></td>
		<td data-name="f4m2"<?php echo $pegawai_default->f4m2->CellAttributes() ?>>
<span id="el_pegawai_default_f4m2">
<span<?php echo $pegawai_default->f4m2->ViewAttributes() ?>>
<?php echo $pegawai_default->f4m2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f4k2->Visible) { // f4k2 ?>
	<tr id="r_f4k2">
		<td><span id="elh_pegawai_default_f4k2"><?php echo $pegawai_default->f4k2->FldCaption() ?></span></td>
		<td data-name="f4k2"<?php echo $pegawai_default->f4k2->CellAttributes() ?>>
<span id="el_pegawai_default_f4k2">
<span<?php echo $pegawai_default->f4k2->ViewAttributes() ?>>
<?php echo $pegawai_default->f4k2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f5m2->Visible) { // f5m2 ?>
	<tr id="r_f5m2">
		<td><span id="elh_pegawai_default_f5m2"><?php echo $pegawai_default->f5m2->FldCaption() ?></span></td>
		<td data-name="f5m2"<?php echo $pegawai_default->f5m2->CellAttributes() ?>>
<span id="el_pegawai_default_f5m2">
<span<?php echo $pegawai_default->f5m2->ViewAttributes() ?>>
<?php echo $pegawai_default->f5m2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f5k2->Visible) { // f5k2 ?>
	<tr id="r_f5k2">
		<td><span id="elh_pegawai_default_f5k2"><?php echo $pegawai_default->f5k2->FldCaption() ?></span></td>
		<td data-name="f5k2"<?php echo $pegawai_default->f5k2->CellAttributes() ?>>
<span id="el_pegawai_default_f5k2">
<span<?php echo $pegawai_default->f5k2->ViewAttributes() ?>>
<?php echo $pegawai_default->f5k2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f6m2->Visible) { // f6m2 ?>
	<tr id="r_f6m2">
		<td><span id="elh_pegawai_default_f6m2"><?php echo $pegawai_default->f6m2->FldCaption() ?></span></td>
		<td data-name="f6m2"<?php echo $pegawai_default->f6m2->CellAttributes() ?>>
<span id="el_pegawai_default_f6m2">
<span<?php echo $pegawai_default->f6m2->ViewAttributes() ?>>
<?php echo $pegawai_default->f6m2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f6k2->Visible) { // f6k2 ?>
	<tr id="r_f6k2">
		<td><span id="elh_pegawai_default_f6k2"><?php echo $pegawai_default->f6k2->FldCaption() ?></span></td>
		<td data-name="f6k2"<?php echo $pegawai_default->f6k2->CellAttributes() ?>>
<span id="el_pegawai_default_f6k2">
<span<?php echo $pegawai_default->f6k2->ViewAttributes() ?>>
<?php echo $pegawai_default->f6k2->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f0m3->Visible) { // f0m3 ?>
	<tr id="r_f0m3">
		<td><span id="elh_pegawai_default_f0m3"><?php echo $pegawai_default->f0m3->FldCaption() ?></span></td>
		<td data-name="f0m3"<?php echo $pegawai_default->f0m3->CellAttributes() ?>>
<span id="el_pegawai_default_f0m3">
<span<?php echo $pegawai_default->f0m3->ViewAttributes() ?>>
<?php echo $pegawai_default->f0m3->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f0k3->Visible) { // f0k3 ?>
	<tr id="r_f0k3">
		<td><span id="elh_pegawai_default_f0k3"><?php echo $pegawai_default->f0k3->FldCaption() ?></span></td>
		<td data-name="f0k3"<?php echo $pegawai_default->f0k3->CellAttributes() ?>>
<span id="el_pegawai_default_f0k3">
<span<?php echo $pegawai_default->f0k3->ViewAttributes() ?>>
<?php echo $pegawai_default->f0k3->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f1m3->Visible) { // f1m3 ?>
	<tr id="r_f1m3">
		<td><span id="elh_pegawai_default_f1m3"><?php echo $pegawai_default->f1m3->FldCaption() ?></span></td>
		<td data-name="f1m3"<?php echo $pegawai_default->f1m3->CellAttributes() ?>>
<span id="el_pegawai_default_f1m3">
<span<?php echo $pegawai_default->f1m3->ViewAttributes() ?>>
<?php echo $pegawai_default->f1m3->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f1k3->Visible) { // f1k3 ?>
	<tr id="r_f1k3">
		<td><span id="elh_pegawai_default_f1k3"><?php echo $pegawai_default->f1k3->FldCaption() ?></span></td>
		<td data-name="f1k3"<?php echo $pegawai_default->f1k3->CellAttributes() ?>>
<span id="el_pegawai_default_f1k3">
<span<?php echo $pegawai_default->f1k3->ViewAttributes() ?>>
<?php echo $pegawai_default->f1k3->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f2m3->Visible) { // f2m3 ?>
	<tr id="r_f2m3">
		<td><span id="elh_pegawai_default_f2m3"><?php echo $pegawai_default->f2m3->FldCaption() ?></span></td>
		<td data-name="f2m3"<?php echo $pegawai_default->f2m3->CellAttributes() ?>>
<span id="el_pegawai_default_f2m3">
<span<?php echo $pegawai_default->f2m3->ViewAttributes() ?>>
<?php echo $pegawai_default->f2m3->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f2k3->Visible) { // f2k3 ?>
	<tr id="r_f2k3">
		<td><span id="elh_pegawai_default_f2k3"><?php echo $pegawai_default->f2k3->FldCaption() ?></span></td>
		<td data-name="f2k3"<?php echo $pegawai_default->f2k3->CellAttributes() ?>>
<span id="el_pegawai_default_f2k3">
<span<?php echo $pegawai_default->f2k3->ViewAttributes() ?>>
<?php echo $pegawai_default->f2k3->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f3m3->Visible) { // f3m3 ?>
	<tr id="r_f3m3">
		<td><span id="elh_pegawai_default_f3m3"><?php echo $pegawai_default->f3m3->FldCaption() ?></span></td>
		<td data-name="f3m3"<?php echo $pegawai_default->f3m3->CellAttributes() ?>>
<span id="el_pegawai_default_f3m3">
<span<?php echo $pegawai_default->f3m3->ViewAttributes() ?>>
<?php echo $pegawai_default->f3m3->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f3k3->Visible) { // f3k3 ?>
	<tr id="r_f3k3">
		<td><span id="elh_pegawai_default_f3k3"><?php echo $pegawai_default->f3k3->FldCaption() ?></span></td>
		<td data-name="f3k3"<?php echo $pegawai_default->f3k3->CellAttributes() ?>>
<span id="el_pegawai_default_f3k3">
<span<?php echo $pegawai_default->f3k3->ViewAttributes() ?>>
<?php echo $pegawai_default->f3k3->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f4m3->Visible) { // f4m3 ?>
	<tr id="r_f4m3">
		<td><span id="elh_pegawai_default_f4m3"><?php echo $pegawai_default->f4m3->FldCaption() ?></span></td>
		<td data-name="f4m3"<?php echo $pegawai_default->f4m3->CellAttributes() ?>>
<span id="el_pegawai_default_f4m3">
<span<?php echo $pegawai_default->f4m3->ViewAttributes() ?>>
<?php echo $pegawai_default->f4m3->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f4k3->Visible) { // f4k3 ?>
	<tr id="r_f4k3">
		<td><span id="elh_pegawai_default_f4k3"><?php echo $pegawai_default->f4k3->FldCaption() ?></span></td>
		<td data-name="f4k3"<?php echo $pegawai_default->f4k3->CellAttributes() ?>>
<span id="el_pegawai_default_f4k3">
<span<?php echo $pegawai_default->f4k3->ViewAttributes() ?>>
<?php echo $pegawai_default->f4k3->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f5m3->Visible) { // f5m3 ?>
	<tr id="r_f5m3">
		<td><span id="elh_pegawai_default_f5m3"><?php echo $pegawai_default->f5m3->FldCaption() ?></span></td>
		<td data-name="f5m3"<?php echo $pegawai_default->f5m3->CellAttributes() ?>>
<span id="el_pegawai_default_f5m3">
<span<?php echo $pegawai_default->f5m3->ViewAttributes() ?>>
<?php echo $pegawai_default->f5m3->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f5k3->Visible) { // f5k3 ?>
	<tr id="r_f5k3">
		<td><span id="elh_pegawai_default_f5k3"><?php echo $pegawai_default->f5k3->FldCaption() ?></span></td>
		<td data-name="f5k3"<?php echo $pegawai_default->f5k3->CellAttributes() ?>>
<span id="el_pegawai_default_f5k3">
<span<?php echo $pegawai_default->f5k3->ViewAttributes() ?>>
<?php echo $pegawai_default->f5k3->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f6m3->Visible) { // f6m3 ?>
	<tr id="r_f6m3">
		<td><span id="elh_pegawai_default_f6m3"><?php echo $pegawai_default->f6m3->FldCaption() ?></span></td>
		<td data-name="f6m3"<?php echo $pegawai_default->f6m3->CellAttributes() ?>>
<span id="el_pegawai_default_f6m3">
<span<?php echo $pegawai_default->f6m3->ViewAttributes() ?>>
<?php echo $pegawai_default->f6m3->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pegawai_default->f6k3->Visible) { // f6k3 ?>
	<tr id="r_f6k3">
		<td><span id="elh_pegawai_default_f6k3"><?php echo $pegawai_default->f6k3->FldCaption() ?></span></td>
		<td data-name="f6k3"<?php echo $pegawai_default->f6k3->CellAttributes() ?>>
<span id="el_pegawai_default_f6k3">
<span<?php echo $pegawai_default->f6k3->ViewAttributes() ?>>
<?php echo $pegawai_default->f6k3->ViewValue ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php if ($pegawai_default->Export == "") { ?>
<script type="text/javascript">
fpegawai_defaultview.Init();
</script>
<?php } ?>
<?php
$pegawai_default_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($pegawai_default->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$pegawai_default_view->Page_Terminate();
?>
