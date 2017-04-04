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

$pegawai_default_list = NULL; // Initialize page object first

class cpegawai_default_list extends cpegawai_default {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = "{4B5DAB39-E4BC-48DF-9311-E295A5F18030}";

	// Table name
	var $TableName = 'pegawai_default';

	// Page object name
	var $PageObjName = 'pegawai_default_list';

	// Grid form hidden field names
	var $FormName = 'fpegawai_defaultlist';
	var $FormActionName = 'k_action';
	var $FormKeyName = 'k_key';
	var $FormOldKeyName = 'k_oldkey';
	var $FormBlankRowName = 'k_blankrow';
	var $FormKeyCountName = 'key_count';

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

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "pegawai_defaultadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "pegawai_defaultdelete.php";
		$this->MultiUpdateUrl = "pegawai_defaultupdate.php";

		// Table object (t_user)
		if (!isset($GLOBALS['t_user'])) $GLOBALS['t_user'] = new ct_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

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

		// List options
		$this->ListOptions = new cListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Other options
		$this->OtherOptions['addedit'] = new cListOptions();
		$this->OtherOptions['addedit']->Tag = "div";
		$this->OtherOptions['addedit']->TagClassName = "ewAddEditOption";
		$this->OtherOptions['detail'] = new cListOptions();
		$this->OtherOptions['detail']->Tag = "div";
		$this->OtherOptions['detail']->TagClassName = "ewDetailOption";
		$this->OtherOptions['action'] = new cListOptions();
		$this->OtherOptions['action']->Tag = "div";
		$this->OtherOptions['action']->TagClassName = "ewActionOption";

		// Filter options
		$this->FilterOptions = new cListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ewFilterOption fpegawai_defaultlistsrch";

		// List actions
		$this->ListActions = new cListActions();
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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			$this->Page_Terminate(ew_GetUrl("index.php"));
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

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

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

		// Setup other options
		$this->SetupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->Add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == EW_ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions->Items["checkbox"]->Visible = TRUE;
				break;
			}
		}
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
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $SearchOptions; // Search options
	var $OtherOptions = array(); // Other options
	var $FilterOptions; // Filter options
	var $ListActions; // List actions
	var $SelectedCount = 0;
	var $SelectedIndex = 0;
	var $DisplayRecs = 20;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $DefaultSearchWhere = ""; // Default search WHERE clause
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $StartRowCnt = 1;
	var $RowCnt = 0;
	var $Attrs = array(); // Row attributes and cell attributes
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $MultiColumnClass;
	var $MultiColumnEditClass = "col-sm-12";
	var $MultiColumnCnt = 12;
	var $MultiColumnEditCnt = 12;
	var $GridCnt = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;	
	var $MultiSelectKey;
	var $Command;
	var $RestoreSearch = FALSE;
	var $DetailPages;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";

		// Get command
		$this->Command = strtolower(@$_GET["cmd"]);
		if ($this->IsPageRequest()) { // Validate request

			// Process list action first
			if ($this->ProcessListAction()) // Ajax request
				$this->Page_Terminate();

			// Handle reset command
			$this->ResetCmd();

			// Set up Breadcrumb
			if ($this->Export == "")
				$this->SetupBreadcrumb();

			// Hide list options
			if ($this->Export <> "") {
				$this->ListOptions->HideAllOptions(array("sequence"));
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->Export <> "" || $this->CurrentAction <> "") {
				$this->ExportOptions->HideAllOptions();
				$this->FilterOptions->HideAllOptions();
			}

			// Hide other options
			if ($this->Export <> "") {
				foreach ($this->OtherOptions as &$option)
					$option->HideAllOptions();
			}

			// Get default search criteria
			ew_AddFilter($this->DefaultSearchWhere, $this->BasicSearchWhere(TRUE));

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Process filter list
			$this->ProcessFilterList();

			// Restore search parms from Session if not searching / reset / export
			if (($this->Export <> "" || $this->Command <> "search" && $this->Command <> "reset" && $this->Command <> "resetall") && $this->CheckSearchParms())
				$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->CheckSearchParms()) {

			// Load basic search from default
			$this->BasicSearch->LoadDefault();
			if ($this->BasicSearch->Keyword != "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} else {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$this->setSessionWhere($sFilter);
		$this->CurrentFilter = "";

		// Export data only
		if ($this->CustomExport == "" && in_array($this->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}

		// Load record count first
		if (!$this->IsAddOrEdit()) {
			$bSelectLimit = $this->UseSelectLimit;
			if ($bSelectLimit) {
				$this->TotalRecs = $this->SelectRecordCount();
			} else {
				if ($this->Recordset = $this->LoadRecordset())
					$this->TotalRecs = $this->Recordset->RecordCount();
			}
		}

		// Search options
		$this->SetupSearchOptions();
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $this->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		$arrKeyFlds = explode($GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"], $key);
		if (count($arrKeyFlds) >= 1) {
			$this->pd_id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->pd_id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Get list of filters
	function GetFilterList() {
		global $UserProfile;

		// Load server side filters
		if (EW_SEARCH_FILTER_OPTION == "Server") {
			$sSavedFilterList = $UserProfile->GetSearchFilters(CurrentUserName(), "fpegawai_defaultlistsrch");
		} else {
			$sSavedFilterList = "";
		}

		// Initialize
		$sFilterList = "";
		$sFilterList = ew_Concat($sFilterList, $this->pd_id->AdvancedSearch->ToJSON(), ","); // Field pd_id
		$sFilterList = ew_Concat($sFilterList, $this->pegawai_id->AdvancedSearch->ToJSON(), ","); // Field pegawai_id
		$sFilterList = ew_Concat($sFilterList, $this->dept_id->AdvancedSearch->ToJSON(), ","); // Field dept_id
		$sFilterList = ew_Concat($sFilterList, $this->f0m1->AdvancedSearch->ToJSON(), ","); // Field f0m1
		$sFilterList = ew_Concat($sFilterList, $this->f0k1->AdvancedSearch->ToJSON(), ","); // Field f0k1
		$sFilterList = ew_Concat($sFilterList, $this->f1m1->AdvancedSearch->ToJSON(), ","); // Field f1m1
		$sFilterList = ew_Concat($sFilterList, $this->f1k1->AdvancedSearch->ToJSON(), ","); // Field f1k1
		$sFilterList = ew_Concat($sFilterList, $this->f2m1->AdvancedSearch->ToJSON(), ","); // Field f2m1
		$sFilterList = ew_Concat($sFilterList, $this->f2k1->AdvancedSearch->ToJSON(), ","); // Field f2k1
		$sFilterList = ew_Concat($sFilterList, $this->f3m1->AdvancedSearch->ToJSON(), ","); // Field f3m1
		$sFilterList = ew_Concat($sFilterList, $this->f3k1->AdvancedSearch->ToJSON(), ","); // Field f3k1
		$sFilterList = ew_Concat($sFilterList, $this->f4m1->AdvancedSearch->ToJSON(), ","); // Field f4m1
		$sFilterList = ew_Concat($sFilterList, $this->f4k1->AdvancedSearch->ToJSON(), ","); // Field f4k1
		$sFilterList = ew_Concat($sFilterList, $this->f5m1->AdvancedSearch->ToJSON(), ","); // Field f5m1
		$sFilterList = ew_Concat($sFilterList, $this->f5k1->AdvancedSearch->ToJSON(), ","); // Field f5k1
		$sFilterList = ew_Concat($sFilterList, $this->f6m1->AdvancedSearch->ToJSON(), ","); // Field f6m1
		$sFilterList = ew_Concat($sFilterList, $this->f6k1->AdvancedSearch->ToJSON(), ","); // Field f6k1
		$sFilterList = ew_Concat($sFilterList, $this->f0m2->AdvancedSearch->ToJSON(), ","); // Field f0m2
		$sFilterList = ew_Concat($sFilterList, $this->f0k2->AdvancedSearch->ToJSON(), ","); // Field f0k2
		$sFilterList = ew_Concat($sFilterList, $this->f1m2->AdvancedSearch->ToJSON(), ","); // Field f1m2
		$sFilterList = ew_Concat($sFilterList, $this->f1k2->AdvancedSearch->ToJSON(), ","); // Field f1k2
		$sFilterList = ew_Concat($sFilterList, $this->f2m2->AdvancedSearch->ToJSON(), ","); // Field f2m2
		$sFilterList = ew_Concat($sFilterList, $this->f2k2->AdvancedSearch->ToJSON(), ","); // Field f2k2
		$sFilterList = ew_Concat($sFilterList, $this->f3m2->AdvancedSearch->ToJSON(), ","); // Field f3m2
		$sFilterList = ew_Concat($sFilterList, $this->f3k2->AdvancedSearch->ToJSON(), ","); // Field f3k2
		$sFilterList = ew_Concat($sFilterList, $this->f4m2->AdvancedSearch->ToJSON(), ","); // Field f4m2
		$sFilterList = ew_Concat($sFilterList, $this->f4k2->AdvancedSearch->ToJSON(), ","); // Field f4k2
		$sFilterList = ew_Concat($sFilterList, $this->f5m2->AdvancedSearch->ToJSON(), ","); // Field f5m2
		$sFilterList = ew_Concat($sFilterList, $this->f5k2->AdvancedSearch->ToJSON(), ","); // Field f5k2
		$sFilterList = ew_Concat($sFilterList, $this->f6m2->AdvancedSearch->ToJSON(), ","); // Field f6m2
		$sFilterList = ew_Concat($sFilterList, $this->f6k2->AdvancedSearch->ToJSON(), ","); // Field f6k2
		$sFilterList = ew_Concat($sFilterList, $this->f0m3->AdvancedSearch->ToJSON(), ","); // Field f0m3
		$sFilterList = ew_Concat($sFilterList, $this->f0k3->AdvancedSearch->ToJSON(), ","); // Field f0k3
		$sFilterList = ew_Concat($sFilterList, $this->f1m3->AdvancedSearch->ToJSON(), ","); // Field f1m3
		$sFilterList = ew_Concat($sFilterList, $this->f1k3->AdvancedSearch->ToJSON(), ","); // Field f1k3
		$sFilterList = ew_Concat($sFilterList, $this->f2m3->AdvancedSearch->ToJSON(), ","); // Field f2m3
		$sFilterList = ew_Concat($sFilterList, $this->f2k3->AdvancedSearch->ToJSON(), ","); // Field f2k3
		$sFilterList = ew_Concat($sFilterList, $this->f3m3->AdvancedSearch->ToJSON(), ","); // Field f3m3
		$sFilterList = ew_Concat($sFilterList, $this->f3k3->AdvancedSearch->ToJSON(), ","); // Field f3k3
		$sFilterList = ew_Concat($sFilterList, $this->f4m3->AdvancedSearch->ToJSON(), ","); // Field f4m3
		$sFilterList = ew_Concat($sFilterList, $this->f4k3->AdvancedSearch->ToJSON(), ","); // Field f4k3
		$sFilterList = ew_Concat($sFilterList, $this->f5m3->AdvancedSearch->ToJSON(), ","); // Field f5m3
		$sFilterList = ew_Concat($sFilterList, $this->f5k3->AdvancedSearch->ToJSON(), ","); // Field f5k3
		$sFilterList = ew_Concat($sFilterList, $this->f6m3->AdvancedSearch->ToJSON(), ","); // Field f6m3
		$sFilterList = ew_Concat($sFilterList, $this->f6k3->AdvancedSearch->ToJSON(), ","); // Field f6k3
		if ($this->BasicSearch->Keyword <> "") {
			$sWrk = "\"" . EW_TABLE_BASIC_SEARCH . "\":\"" . ew_JsEncode2($this->BasicSearch->Keyword) . "\",\"" . EW_TABLE_BASIC_SEARCH_TYPE . "\":\"" . ew_JsEncode2($this->BasicSearch->Type) . "\"";
			$sFilterList = ew_Concat($sFilterList, $sWrk, ",");
		}
		$sFilterList = preg_replace('/,$/', "", $sFilterList);

		// Return filter list in json
		if ($sFilterList <> "")
			$sFilterList = "\"data\":{" . $sFilterList . "}";
		if ($sSavedFilterList <> "") {
			if ($sFilterList <> "")
				$sFilterList .= ",";
			$sFilterList .= "\"filters\":" . $sSavedFilterList;
		}
		return ($sFilterList <> "") ? "{" . $sFilterList . "}" : "null";
	}

	// Process filter list
	function ProcessFilterList() {
		global $UserProfile;
		if (@$_POST["ajax"] == "savefilters") { // Save filter request (Ajax)
			$filters = ew_StripSlashes(@$_POST["filters"]);
			$UserProfile->SetSearchFilters(CurrentUserName(), "fpegawai_defaultlistsrch", $filters);

			// Clean output buffer
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			echo ew_ArrayToJson(array(array("success" => TRUE))); // Success
			$this->Page_Terminate();
			exit();
		} elseif (@$_POST["cmd"] == "resetfilter") {
			$this->RestoreFilterList();
		}
	}

	// Restore list of filters
	function RestoreFilterList() {

		// Return if not reset filter
		if (@$_POST["cmd"] <> "resetfilter")
			return FALSE;
		$filter = json_decode(ew_StripSlashes(@$_POST["filter"]), TRUE);
		$this->Command = "search";

		// Field pd_id
		$this->pd_id->AdvancedSearch->SearchValue = @$filter["x_pd_id"];
		$this->pd_id->AdvancedSearch->SearchOperator = @$filter["z_pd_id"];
		$this->pd_id->AdvancedSearch->SearchCondition = @$filter["v_pd_id"];
		$this->pd_id->AdvancedSearch->SearchValue2 = @$filter["y_pd_id"];
		$this->pd_id->AdvancedSearch->SearchOperator2 = @$filter["w_pd_id"];
		$this->pd_id->AdvancedSearch->Save();

		// Field pegawai_id
		$this->pegawai_id->AdvancedSearch->SearchValue = @$filter["x_pegawai_id"];
		$this->pegawai_id->AdvancedSearch->SearchOperator = @$filter["z_pegawai_id"];
		$this->pegawai_id->AdvancedSearch->SearchCondition = @$filter["v_pegawai_id"];
		$this->pegawai_id->AdvancedSearch->SearchValue2 = @$filter["y_pegawai_id"];
		$this->pegawai_id->AdvancedSearch->SearchOperator2 = @$filter["w_pegawai_id"];
		$this->pegawai_id->AdvancedSearch->Save();

		// Field dept_id
		$this->dept_id->AdvancedSearch->SearchValue = @$filter["x_dept_id"];
		$this->dept_id->AdvancedSearch->SearchOperator = @$filter["z_dept_id"];
		$this->dept_id->AdvancedSearch->SearchCondition = @$filter["v_dept_id"];
		$this->dept_id->AdvancedSearch->SearchValue2 = @$filter["y_dept_id"];
		$this->dept_id->AdvancedSearch->SearchOperator2 = @$filter["w_dept_id"];
		$this->dept_id->AdvancedSearch->Save();

		// Field f0m1
		$this->f0m1->AdvancedSearch->SearchValue = @$filter["x_f0m1"];
		$this->f0m1->AdvancedSearch->SearchOperator = @$filter["z_f0m1"];
		$this->f0m1->AdvancedSearch->SearchCondition = @$filter["v_f0m1"];
		$this->f0m1->AdvancedSearch->SearchValue2 = @$filter["y_f0m1"];
		$this->f0m1->AdvancedSearch->SearchOperator2 = @$filter["w_f0m1"];
		$this->f0m1->AdvancedSearch->Save();

		// Field f0k1
		$this->f0k1->AdvancedSearch->SearchValue = @$filter["x_f0k1"];
		$this->f0k1->AdvancedSearch->SearchOperator = @$filter["z_f0k1"];
		$this->f0k1->AdvancedSearch->SearchCondition = @$filter["v_f0k1"];
		$this->f0k1->AdvancedSearch->SearchValue2 = @$filter["y_f0k1"];
		$this->f0k1->AdvancedSearch->SearchOperator2 = @$filter["w_f0k1"];
		$this->f0k1->AdvancedSearch->Save();

		// Field f1m1
		$this->f1m1->AdvancedSearch->SearchValue = @$filter["x_f1m1"];
		$this->f1m1->AdvancedSearch->SearchOperator = @$filter["z_f1m1"];
		$this->f1m1->AdvancedSearch->SearchCondition = @$filter["v_f1m1"];
		$this->f1m1->AdvancedSearch->SearchValue2 = @$filter["y_f1m1"];
		$this->f1m1->AdvancedSearch->SearchOperator2 = @$filter["w_f1m1"];
		$this->f1m1->AdvancedSearch->Save();

		// Field f1k1
		$this->f1k1->AdvancedSearch->SearchValue = @$filter["x_f1k1"];
		$this->f1k1->AdvancedSearch->SearchOperator = @$filter["z_f1k1"];
		$this->f1k1->AdvancedSearch->SearchCondition = @$filter["v_f1k1"];
		$this->f1k1->AdvancedSearch->SearchValue2 = @$filter["y_f1k1"];
		$this->f1k1->AdvancedSearch->SearchOperator2 = @$filter["w_f1k1"];
		$this->f1k1->AdvancedSearch->Save();

		// Field f2m1
		$this->f2m1->AdvancedSearch->SearchValue = @$filter["x_f2m1"];
		$this->f2m1->AdvancedSearch->SearchOperator = @$filter["z_f2m1"];
		$this->f2m1->AdvancedSearch->SearchCondition = @$filter["v_f2m1"];
		$this->f2m1->AdvancedSearch->SearchValue2 = @$filter["y_f2m1"];
		$this->f2m1->AdvancedSearch->SearchOperator2 = @$filter["w_f2m1"];
		$this->f2m1->AdvancedSearch->Save();

		// Field f2k1
		$this->f2k1->AdvancedSearch->SearchValue = @$filter["x_f2k1"];
		$this->f2k1->AdvancedSearch->SearchOperator = @$filter["z_f2k1"];
		$this->f2k1->AdvancedSearch->SearchCondition = @$filter["v_f2k1"];
		$this->f2k1->AdvancedSearch->SearchValue2 = @$filter["y_f2k1"];
		$this->f2k1->AdvancedSearch->SearchOperator2 = @$filter["w_f2k1"];
		$this->f2k1->AdvancedSearch->Save();

		// Field f3m1
		$this->f3m1->AdvancedSearch->SearchValue = @$filter["x_f3m1"];
		$this->f3m1->AdvancedSearch->SearchOperator = @$filter["z_f3m1"];
		$this->f3m1->AdvancedSearch->SearchCondition = @$filter["v_f3m1"];
		$this->f3m1->AdvancedSearch->SearchValue2 = @$filter["y_f3m1"];
		$this->f3m1->AdvancedSearch->SearchOperator2 = @$filter["w_f3m1"];
		$this->f3m1->AdvancedSearch->Save();

		// Field f3k1
		$this->f3k1->AdvancedSearch->SearchValue = @$filter["x_f3k1"];
		$this->f3k1->AdvancedSearch->SearchOperator = @$filter["z_f3k1"];
		$this->f3k1->AdvancedSearch->SearchCondition = @$filter["v_f3k1"];
		$this->f3k1->AdvancedSearch->SearchValue2 = @$filter["y_f3k1"];
		$this->f3k1->AdvancedSearch->SearchOperator2 = @$filter["w_f3k1"];
		$this->f3k1->AdvancedSearch->Save();

		// Field f4m1
		$this->f4m1->AdvancedSearch->SearchValue = @$filter["x_f4m1"];
		$this->f4m1->AdvancedSearch->SearchOperator = @$filter["z_f4m1"];
		$this->f4m1->AdvancedSearch->SearchCondition = @$filter["v_f4m1"];
		$this->f4m1->AdvancedSearch->SearchValue2 = @$filter["y_f4m1"];
		$this->f4m1->AdvancedSearch->SearchOperator2 = @$filter["w_f4m1"];
		$this->f4m1->AdvancedSearch->Save();

		// Field f4k1
		$this->f4k1->AdvancedSearch->SearchValue = @$filter["x_f4k1"];
		$this->f4k1->AdvancedSearch->SearchOperator = @$filter["z_f4k1"];
		$this->f4k1->AdvancedSearch->SearchCondition = @$filter["v_f4k1"];
		$this->f4k1->AdvancedSearch->SearchValue2 = @$filter["y_f4k1"];
		$this->f4k1->AdvancedSearch->SearchOperator2 = @$filter["w_f4k1"];
		$this->f4k1->AdvancedSearch->Save();

		// Field f5m1
		$this->f5m1->AdvancedSearch->SearchValue = @$filter["x_f5m1"];
		$this->f5m1->AdvancedSearch->SearchOperator = @$filter["z_f5m1"];
		$this->f5m1->AdvancedSearch->SearchCondition = @$filter["v_f5m1"];
		$this->f5m1->AdvancedSearch->SearchValue2 = @$filter["y_f5m1"];
		$this->f5m1->AdvancedSearch->SearchOperator2 = @$filter["w_f5m1"];
		$this->f5m1->AdvancedSearch->Save();

		// Field f5k1
		$this->f5k1->AdvancedSearch->SearchValue = @$filter["x_f5k1"];
		$this->f5k1->AdvancedSearch->SearchOperator = @$filter["z_f5k1"];
		$this->f5k1->AdvancedSearch->SearchCondition = @$filter["v_f5k1"];
		$this->f5k1->AdvancedSearch->SearchValue2 = @$filter["y_f5k1"];
		$this->f5k1->AdvancedSearch->SearchOperator2 = @$filter["w_f5k1"];
		$this->f5k1->AdvancedSearch->Save();

		// Field f6m1
		$this->f6m1->AdvancedSearch->SearchValue = @$filter["x_f6m1"];
		$this->f6m1->AdvancedSearch->SearchOperator = @$filter["z_f6m1"];
		$this->f6m1->AdvancedSearch->SearchCondition = @$filter["v_f6m1"];
		$this->f6m1->AdvancedSearch->SearchValue2 = @$filter["y_f6m1"];
		$this->f6m1->AdvancedSearch->SearchOperator2 = @$filter["w_f6m1"];
		$this->f6m1->AdvancedSearch->Save();

		// Field f6k1
		$this->f6k1->AdvancedSearch->SearchValue = @$filter["x_f6k1"];
		$this->f6k1->AdvancedSearch->SearchOperator = @$filter["z_f6k1"];
		$this->f6k1->AdvancedSearch->SearchCondition = @$filter["v_f6k1"];
		$this->f6k1->AdvancedSearch->SearchValue2 = @$filter["y_f6k1"];
		$this->f6k1->AdvancedSearch->SearchOperator2 = @$filter["w_f6k1"];
		$this->f6k1->AdvancedSearch->Save();

		// Field f0m2
		$this->f0m2->AdvancedSearch->SearchValue = @$filter["x_f0m2"];
		$this->f0m2->AdvancedSearch->SearchOperator = @$filter["z_f0m2"];
		$this->f0m2->AdvancedSearch->SearchCondition = @$filter["v_f0m2"];
		$this->f0m2->AdvancedSearch->SearchValue2 = @$filter["y_f0m2"];
		$this->f0m2->AdvancedSearch->SearchOperator2 = @$filter["w_f0m2"];
		$this->f0m2->AdvancedSearch->Save();

		// Field f0k2
		$this->f0k2->AdvancedSearch->SearchValue = @$filter["x_f0k2"];
		$this->f0k2->AdvancedSearch->SearchOperator = @$filter["z_f0k2"];
		$this->f0k2->AdvancedSearch->SearchCondition = @$filter["v_f0k2"];
		$this->f0k2->AdvancedSearch->SearchValue2 = @$filter["y_f0k2"];
		$this->f0k2->AdvancedSearch->SearchOperator2 = @$filter["w_f0k2"];
		$this->f0k2->AdvancedSearch->Save();

		// Field f1m2
		$this->f1m2->AdvancedSearch->SearchValue = @$filter["x_f1m2"];
		$this->f1m2->AdvancedSearch->SearchOperator = @$filter["z_f1m2"];
		$this->f1m2->AdvancedSearch->SearchCondition = @$filter["v_f1m2"];
		$this->f1m2->AdvancedSearch->SearchValue2 = @$filter["y_f1m2"];
		$this->f1m2->AdvancedSearch->SearchOperator2 = @$filter["w_f1m2"];
		$this->f1m2->AdvancedSearch->Save();

		// Field f1k2
		$this->f1k2->AdvancedSearch->SearchValue = @$filter["x_f1k2"];
		$this->f1k2->AdvancedSearch->SearchOperator = @$filter["z_f1k2"];
		$this->f1k2->AdvancedSearch->SearchCondition = @$filter["v_f1k2"];
		$this->f1k2->AdvancedSearch->SearchValue2 = @$filter["y_f1k2"];
		$this->f1k2->AdvancedSearch->SearchOperator2 = @$filter["w_f1k2"];
		$this->f1k2->AdvancedSearch->Save();

		// Field f2m2
		$this->f2m2->AdvancedSearch->SearchValue = @$filter["x_f2m2"];
		$this->f2m2->AdvancedSearch->SearchOperator = @$filter["z_f2m2"];
		$this->f2m2->AdvancedSearch->SearchCondition = @$filter["v_f2m2"];
		$this->f2m2->AdvancedSearch->SearchValue2 = @$filter["y_f2m2"];
		$this->f2m2->AdvancedSearch->SearchOperator2 = @$filter["w_f2m2"];
		$this->f2m2->AdvancedSearch->Save();

		// Field f2k2
		$this->f2k2->AdvancedSearch->SearchValue = @$filter["x_f2k2"];
		$this->f2k2->AdvancedSearch->SearchOperator = @$filter["z_f2k2"];
		$this->f2k2->AdvancedSearch->SearchCondition = @$filter["v_f2k2"];
		$this->f2k2->AdvancedSearch->SearchValue2 = @$filter["y_f2k2"];
		$this->f2k2->AdvancedSearch->SearchOperator2 = @$filter["w_f2k2"];
		$this->f2k2->AdvancedSearch->Save();

		// Field f3m2
		$this->f3m2->AdvancedSearch->SearchValue = @$filter["x_f3m2"];
		$this->f3m2->AdvancedSearch->SearchOperator = @$filter["z_f3m2"];
		$this->f3m2->AdvancedSearch->SearchCondition = @$filter["v_f3m2"];
		$this->f3m2->AdvancedSearch->SearchValue2 = @$filter["y_f3m2"];
		$this->f3m2->AdvancedSearch->SearchOperator2 = @$filter["w_f3m2"];
		$this->f3m2->AdvancedSearch->Save();

		// Field f3k2
		$this->f3k2->AdvancedSearch->SearchValue = @$filter["x_f3k2"];
		$this->f3k2->AdvancedSearch->SearchOperator = @$filter["z_f3k2"];
		$this->f3k2->AdvancedSearch->SearchCondition = @$filter["v_f3k2"];
		$this->f3k2->AdvancedSearch->SearchValue2 = @$filter["y_f3k2"];
		$this->f3k2->AdvancedSearch->SearchOperator2 = @$filter["w_f3k2"];
		$this->f3k2->AdvancedSearch->Save();

		// Field f4m2
		$this->f4m2->AdvancedSearch->SearchValue = @$filter["x_f4m2"];
		$this->f4m2->AdvancedSearch->SearchOperator = @$filter["z_f4m2"];
		$this->f4m2->AdvancedSearch->SearchCondition = @$filter["v_f4m2"];
		$this->f4m2->AdvancedSearch->SearchValue2 = @$filter["y_f4m2"];
		$this->f4m2->AdvancedSearch->SearchOperator2 = @$filter["w_f4m2"];
		$this->f4m2->AdvancedSearch->Save();

		// Field f4k2
		$this->f4k2->AdvancedSearch->SearchValue = @$filter["x_f4k2"];
		$this->f4k2->AdvancedSearch->SearchOperator = @$filter["z_f4k2"];
		$this->f4k2->AdvancedSearch->SearchCondition = @$filter["v_f4k2"];
		$this->f4k2->AdvancedSearch->SearchValue2 = @$filter["y_f4k2"];
		$this->f4k2->AdvancedSearch->SearchOperator2 = @$filter["w_f4k2"];
		$this->f4k2->AdvancedSearch->Save();

		// Field f5m2
		$this->f5m2->AdvancedSearch->SearchValue = @$filter["x_f5m2"];
		$this->f5m2->AdvancedSearch->SearchOperator = @$filter["z_f5m2"];
		$this->f5m2->AdvancedSearch->SearchCondition = @$filter["v_f5m2"];
		$this->f5m2->AdvancedSearch->SearchValue2 = @$filter["y_f5m2"];
		$this->f5m2->AdvancedSearch->SearchOperator2 = @$filter["w_f5m2"];
		$this->f5m2->AdvancedSearch->Save();

		// Field f5k2
		$this->f5k2->AdvancedSearch->SearchValue = @$filter["x_f5k2"];
		$this->f5k2->AdvancedSearch->SearchOperator = @$filter["z_f5k2"];
		$this->f5k2->AdvancedSearch->SearchCondition = @$filter["v_f5k2"];
		$this->f5k2->AdvancedSearch->SearchValue2 = @$filter["y_f5k2"];
		$this->f5k2->AdvancedSearch->SearchOperator2 = @$filter["w_f5k2"];
		$this->f5k2->AdvancedSearch->Save();

		// Field f6m2
		$this->f6m2->AdvancedSearch->SearchValue = @$filter["x_f6m2"];
		$this->f6m2->AdvancedSearch->SearchOperator = @$filter["z_f6m2"];
		$this->f6m2->AdvancedSearch->SearchCondition = @$filter["v_f6m2"];
		$this->f6m2->AdvancedSearch->SearchValue2 = @$filter["y_f6m2"];
		$this->f6m2->AdvancedSearch->SearchOperator2 = @$filter["w_f6m2"];
		$this->f6m2->AdvancedSearch->Save();

		// Field f6k2
		$this->f6k2->AdvancedSearch->SearchValue = @$filter["x_f6k2"];
		$this->f6k2->AdvancedSearch->SearchOperator = @$filter["z_f6k2"];
		$this->f6k2->AdvancedSearch->SearchCondition = @$filter["v_f6k2"];
		$this->f6k2->AdvancedSearch->SearchValue2 = @$filter["y_f6k2"];
		$this->f6k2->AdvancedSearch->SearchOperator2 = @$filter["w_f6k2"];
		$this->f6k2->AdvancedSearch->Save();

		// Field f0m3
		$this->f0m3->AdvancedSearch->SearchValue = @$filter["x_f0m3"];
		$this->f0m3->AdvancedSearch->SearchOperator = @$filter["z_f0m3"];
		$this->f0m3->AdvancedSearch->SearchCondition = @$filter["v_f0m3"];
		$this->f0m3->AdvancedSearch->SearchValue2 = @$filter["y_f0m3"];
		$this->f0m3->AdvancedSearch->SearchOperator2 = @$filter["w_f0m3"];
		$this->f0m3->AdvancedSearch->Save();

		// Field f0k3
		$this->f0k3->AdvancedSearch->SearchValue = @$filter["x_f0k3"];
		$this->f0k3->AdvancedSearch->SearchOperator = @$filter["z_f0k3"];
		$this->f0k3->AdvancedSearch->SearchCondition = @$filter["v_f0k3"];
		$this->f0k3->AdvancedSearch->SearchValue2 = @$filter["y_f0k3"];
		$this->f0k3->AdvancedSearch->SearchOperator2 = @$filter["w_f0k3"];
		$this->f0k3->AdvancedSearch->Save();

		// Field f1m3
		$this->f1m3->AdvancedSearch->SearchValue = @$filter["x_f1m3"];
		$this->f1m3->AdvancedSearch->SearchOperator = @$filter["z_f1m3"];
		$this->f1m3->AdvancedSearch->SearchCondition = @$filter["v_f1m3"];
		$this->f1m3->AdvancedSearch->SearchValue2 = @$filter["y_f1m3"];
		$this->f1m3->AdvancedSearch->SearchOperator2 = @$filter["w_f1m3"];
		$this->f1m3->AdvancedSearch->Save();

		// Field f1k3
		$this->f1k3->AdvancedSearch->SearchValue = @$filter["x_f1k3"];
		$this->f1k3->AdvancedSearch->SearchOperator = @$filter["z_f1k3"];
		$this->f1k3->AdvancedSearch->SearchCondition = @$filter["v_f1k3"];
		$this->f1k3->AdvancedSearch->SearchValue2 = @$filter["y_f1k3"];
		$this->f1k3->AdvancedSearch->SearchOperator2 = @$filter["w_f1k3"];
		$this->f1k3->AdvancedSearch->Save();

		// Field f2m3
		$this->f2m3->AdvancedSearch->SearchValue = @$filter["x_f2m3"];
		$this->f2m3->AdvancedSearch->SearchOperator = @$filter["z_f2m3"];
		$this->f2m3->AdvancedSearch->SearchCondition = @$filter["v_f2m3"];
		$this->f2m3->AdvancedSearch->SearchValue2 = @$filter["y_f2m3"];
		$this->f2m3->AdvancedSearch->SearchOperator2 = @$filter["w_f2m3"];
		$this->f2m3->AdvancedSearch->Save();

		// Field f2k3
		$this->f2k3->AdvancedSearch->SearchValue = @$filter["x_f2k3"];
		$this->f2k3->AdvancedSearch->SearchOperator = @$filter["z_f2k3"];
		$this->f2k3->AdvancedSearch->SearchCondition = @$filter["v_f2k3"];
		$this->f2k3->AdvancedSearch->SearchValue2 = @$filter["y_f2k3"];
		$this->f2k3->AdvancedSearch->SearchOperator2 = @$filter["w_f2k3"];
		$this->f2k3->AdvancedSearch->Save();

		// Field f3m3
		$this->f3m3->AdvancedSearch->SearchValue = @$filter["x_f3m3"];
		$this->f3m3->AdvancedSearch->SearchOperator = @$filter["z_f3m3"];
		$this->f3m3->AdvancedSearch->SearchCondition = @$filter["v_f3m3"];
		$this->f3m3->AdvancedSearch->SearchValue2 = @$filter["y_f3m3"];
		$this->f3m3->AdvancedSearch->SearchOperator2 = @$filter["w_f3m3"];
		$this->f3m3->AdvancedSearch->Save();

		// Field f3k3
		$this->f3k3->AdvancedSearch->SearchValue = @$filter["x_f3k3"];
		$this->f3k3->AdvancedSearch->SearchOperator = @$filter["z_f3k3"];
		$this->f3k3->AdvancedSearch->SearchCondition = @$filter["v_f3k3"];
		$this->f3k3->AdvancedSearch->SearchValue2 = @$filter["y_f3k3"];
		$this->f3k3->AdvancedSearch->SearchOperator2 = @$filter["w_f3k3"];
		$this->f3k3->AdvancedSearch->Save();

		// Field f4m3
		$this->f4m3->AdvancedSearch->SearchValue = @$filter["x_f4m3"];
		$this->f4m3->AdvancedSearch->SearchOperator = @$filter["z_f4m3"];
		$this->f4m3->AdvancedSearch->SearchCondition = @$filter["v_f4m3"];
		$this->f4m3->AdvancedSearch->SearchValue2 = @$filter["y_f4m3"];
		$this->f4m3->AdvancedSearch->SearchOperator2 = @$filter["w_f4m3"];
		$this->f4m3->AdvancedSearch->Save();

		// Field f4k3
		$this->f4k3->AdvancedSearch->SearchValue = @$filter["x_f4k3"];
		$this->f4k3->AdvancedSearch->SearchOperator = @$filter["z_f4k3"];
		$this->f4k3->AdvancedSearch->SearchCondition = @$filter["v_f4k3"];
		$this->f4k3->AdvancedSearch->SearchValue2 = @$filter["y_f4k3"];
		$this->f4k3->AdvancedSearch->SearchOperator2 = @$filter["w_f4k3"];
		$this->f4k3->AdvancedSearch->Save();

		// Field f5m3
		$this->f5m3->AdvancedSearch->SearchValue = @$filter["x_f5m3"];
		$this->f5m3->AdvancedSearch->SearchOperator = @$filter["z_f5m3"];
		$this->f5m3->AdvancedSearch->SearchCondition = @$filter["v_f5m3"];
		$this->f5m3->AdvancedSearch->SearchValue2 = @$filter["y_f5m3"];
		$this->f5m3->AdvancedSearch->SearchOperator2 = @$filter["w_f5m3"];
		$this->f5m3->AdvancedSearch->Save();

		// Field f5k3
		$this->f5k3->AdvancedSearch->SearchValue = @$filter["x_f5k3"];
		$this->f5k3->AdvancedSearch->SearchOperator = @$filter["z_f5k3"];
		$this->f5k3->AdvancedSearch->SearchCondition = @$filter["v_f5k3"];
		$this->f5k3->AdvancedSearch->SearchValue2 = @$filter["y_f5k3"];
		$this->f5k3->AdvancedSearch->SearchOperator2 = @$filter["w_f5k3"];
		$this->f5k3->AdvancedSearch->Save();

		// Field f6m3
		$this->f6m3->AdvancedSearch->SearchValue = @$filter["x_f6m3"];
		$this->f6m3->AdvancedSearch->SearchOperator = @$filter["z_f6m3"];
		$this->f6m3->AdvancedSearch->SearchCondition = @$filter["v_f6m3"];
		$this->f6m3->AdvancedSearch->SearchValue2 = @$filter["y_f6m3"];
		$this->f6m3->AdvancedSearch->SearchOperator2 = @$filter["w_f6m3"];
		$this->f6m3->AdvancedSearch->Save();

		// Field f6k3
		$this->f6k3->AdvancedSearch->SearchValue = @$filter["x_f6k3"];
		$this->f6k3->AdvancedSearch->SearchOperator = @$filter["z_f6k3"];
		$this->f6k3->AdvancedSearch->SearchCondition = @$filter["v_f6k3"];
		$this->f6k3->AdvancedSearch->SearchValue2 = @$filter["y_f6k3"];
		$this->f6k3->AdvancedSearch->SearchOperator2 = @$filter["w_f6k3"];
		$this->f6k3->AdvancedSearch->Save();
		$this->BasicSearch->setKeyword(@$filter[EW_TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[EW_TABLE_BASIC_SEARCH_TYPE]);
	}

	// Return basic search SQL
	function BasicSearchSQL($arKeywords, $type) {
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $this->f0m1, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f0k1, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f1m1, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f1k1, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f2m1, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f2k1, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f3m1, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f3k1, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f4m1, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f4k1, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f5m1, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f5k1, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f6m1, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f6k1, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f0m2, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f0k2, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f1m2, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f1k2, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f2m2, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f2k2, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f3m2, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f3k2, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f4m2, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f4k2, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f5m2, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f5k2, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f6m2, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f6k2, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f0m3, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f0k3, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f1m3, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f1k3, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f2m3, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f2k3, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f3m3, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f3k3, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f4m3, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f4k3, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f5m3, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f5k3, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f6m3, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->f6k3, $arKeywords, $type);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSQL(&$Where, &$Fld, $arKeywords, $type) {
		global $EW_BASIC_SEARCH_IGNORE_PATTERN;
		$sDefCond = ($type == "OR") ? "OR" : "AND";
		$arSQL = array(); // Array for SQL parts
		$arCond = array(); // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$Keyword = $arKeywords[$i];
			$Keyword = trim($Keyword);
			if ($EW_BASIC_SEARCH_IGNORE_PATTERN <> "") {
				$Keyword = preg_replace($EW_BASIC_SEARCH_IGNORE_PATTERN, "\\", $Keyword);
				$ar = explode("\\", $Keyword);
			} else {
				$ar = array($Keyword);
			}
			foreach ($ar as $Keyword) {
				if ($Keyword <> "") {
					$sWrk = "";
					if ($Keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j-1] = "OR";
					} elseif ($Keyword == EW_NULL_VALUE) {
						$sWrk = $Fld->FldExpression . " IS NULL";
					} elseif ($Keyword == EW_NOT_NULL_VALUE) {
						$sWrk = $Fld->FldExpression . " IS NOT NULL";
					} elseif ($Fld->FldIsVirtual) {
						$sWrk = $Fld->FldVirtualExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", EW_DATATYPE_STRING, $this->DBID), $this->DBID);
					} elseif ($Fld->FldDataType != EW_DATATYPE_NUMBER || is_numeric($Keyword)) {
						$sWrk = $Fld->FldBasicSearchExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", EW_DATATYPE_STRING, $this->DBID), $this->DBID);
					}
					if ($sWrk <> "") {
						$arSQL[$j] = $sWrk;
						$arCond[$j] = $sDefCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSQL);
		$bQuoted = FALSE;
		$sSql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt-1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$bQuoted) $sSql .= "(";
					$bQuoted = TRUE;
				}
				$sSql .= $arSQL[$i];
				if ($bQuoted && $arCond[$i] <> "OR") {
					$sSql .= ")";
					$bQuoted = FALSE;
				}
				$sSql .= " " . $arCond[$i] . " ";
			}
			$sSql .= $arSQL[$cnt-1];
			if ($bQuoted)
				$sSql .= ")";
		}
		if ($sSql <> "") {
			if ($Where <> "") $Where .= " OR ";
			$Where .=  "(" . $sSql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere($Default = FALSE) {
		global $Security;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = ($Default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$sSearchType = ($Default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "=") {
				$ar = array();

				// Match quoted keywords (i.e.: "...")
				if (preg_match_all('/"([^"]*)"/i', $sSearch, $matches, PREG_SET_ORDER)) {
					foreach ($matches as $match) {
						$p = strpos($sSearch, $match[0]);
						$str = substr($sSearch, 0, $p);
						$sSearch = substr($sSearch, $p + strlen($match[0]));
						if (strlen(trim($str)) > 0)
							$ar = array_merge($ar, explode(" ", trim($str)));
						$ar[] = $match[1]; // Save quoted keyword
					}
				}

				// Match individual keywords
				if (strlen(trim($sSearch)) > 0)
					$ar = array_merge($ar, explode(" ", trim($sSearch)));

				// Search keyword in any fields
				if (($sSearchType == "OR" || $sSearchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
					foreach ($ar as $sKeyword) {
						if ($sKeyword <> "") {
							if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
							$sSearchStr .= "(" . $this->BasicSearchSQL(array($sKeyword), $sSearchType) . ")";
						}
					}
				} else {
					$sSearchStr = $this->BasicSearchSQL($ar, $sSearchType);
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL(array($sSearch), $sSearchType);
			}
			if (!$Default) $this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($sSearchKeyword);
			$this->BasicSearch->setType($sSearchType);
		}
		return $sSearchStr;
	}

	// Check if search parm exists
	function CheckSearchParms() {

		// Check basic search
		if ($this->BasicSearch->IssetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Load advanced search default values
	function LoadAdvancedSearchDefault() {
		return FALSE;
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		$this->BasicSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->Load();
	}

	// Set up sort parameters
	function SetUpSortOrder() {

		// Check for Ctrl pressed
		$bCtrl = (@$_GET["ctrl"] <> "");

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->pd_id, $bCtrl); // pd_id
			$this->UpdateSort($this->pegawai_id, $bCtrl); // pegawai_id
			$this->UpdateSort($this->dept_id, $bCtrl); // dept_id
			$this->UpdateSort($this->f0m1, $bCtrl); // f0m1
			$this->UpdateSort($this->f0k1, $bCtrl); // f0k1
			$this->UpdateSort($this->f1m1, $bCtrl); // f1m1
			$this->UpdateSort($this->f1k1, $bCtrl); // f1k1
			$this->UpdateSort($this->f2m1, $bCtrl); // f2m1
			$this->UpdateSort($this->f2k1, $bCtrl); // f2k1
			$this->UpdateSort($this->f3m1, $bCtrl); // f3m1
			$this->UpdateSort($this->f3k1, $bCtrl); // f3k1
			$this->UpdateSort($this->f4m1, $bCtrl); // f4m1
			$this->UpdateSort($this->f4k1, $bCtrl); // f4k1
			$this->UpdateSort($this->f5m1, $bCtrl); // f5m1
			$this->UpdateSort($this->f5k1, $bCtrl); // f5k1
			$this->UpdateSort($this->f6m1, $bCtrl); // f6m1
			$this->UpdateSort($this->f6k1, $bCtrl); // f6k1
			$this->UpdateSort($this->f0m2, $bCtrl); // f0m2
			$this->UpdateSort($this->f0k2, $bCtrl); // f0k2
			$this->UpdateSort($this->f1m2, $bCtrl); // f1m2
			$this->UpdateSort($this->f1k2, $bCtrl); // f1k2
			$this->UpdateSort($this->f2m2, $bCtrl); // f2m2
			$this->UpdateSort($this->f2k2, $bCtrl); // f2k2
			$this->UpdateSort($this->f3m2, $bCtrl); // f3m2
			$this->UpdateSort($this->f3k2, $bCtrl); // f3k2
			$this->UpdateSort($this->f4m2, $bCtrl); // f4m2
			$this->UpdateSort($this->f4k2, $bCtrl); // f4k2
			$this->UpdateSort($this->f5m2, $bCtrl); // f5m2
			$this->UpdateSort($this->f5k2, $bCtrl); // f5k2
			$this->UpdateSort($this->f6m2, $bCtrl); // f6m2
			$this->UpdateSort($this->f6k2, $bCtrl); // f6k2
			$this->UpdateSort($this->f0m3, $bCtrl); // f0m3
			$this->UpdateSort($this->f0k3, $bCtrl); // f0k3
			$this->UpdateSort($this->f1m3, $bCtrl); // f1m3
			$this->UpdateSort($this->f1k3, $bCtrl); // f1k3
			$this->UpdateSort($this->f2m3, $bCtrl); // f2m3
			$this->UpdateSort($this->f2k3, $bCtrl); // f2k3
			$this->UpdateSort($this->f3m3, $bCtrl); // f3m3
			$this->UpdateSort($this->f3k3, $bCtrl); // f3k3
			$this->UpdateSort($this->f4m3, $bCtrl); // f4m3
			$this->UpdateSort($this->f4k3, $bCtrl); // f4k3
			$this->UpdateSort($this->f5m3, $bCtrl); // f5m3
			$this->UpdateSort($this->f5k3, $bCtrl); // f5k3
			$this->UpdateSort($this->f6m3, $bCtrl); // f6m3
			$this->UpdateSort($this->f6k3, $bCtrl); // f6k3
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		$sOrderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($this->getSqlOrderBy() <> "") {
				$sOrderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)
	function ResetCmd() {

		// Check if reset command
		if (substr($this->Command,0,5) == "reset") {

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->setSessionOrderByList($sOrderBy);
				$this->pd_id->setSort("");
				$this->pegawai_id->setSort("");
				$this->dept_id->setSort("");
				$this->f0m1->setSort("");
				$this->f0k1->setSort("");
				$this->f1m1->setSort("");
				$this->f1k1->setSort("");
				$this->f2m1->setSort("");
				$this->f2k1->setSort("");
				$this->f3m1->setSort("");
				$this->f3k1->setSort("");
				$this->f4m1->setSort("");
				$this->f4k1->setSort("");
				$this->f5m1->setSort("");
				$this->f5k1->setSort("");
				$this->f6m1->setSort("");
				$this->f6k1->setSort("");
				$this->f0m2->setSort("");
				$this->f0k2->setSort("");
				$this->f1m2->setSort("");
				$this->f1k2->setSort("");
				$this->f2m2->setSort("");
				$this->f2k2->setSort("");
				$this->f3m2->setSort("");
				$this->f3k2->setSort("");
				$this->f4m2->setSort("");
				$this->f4k2->setSort("");
				$this->f5m2->setSort("");
				$this->f5k2->setSort("");
				$this->f6m2->setSort("");
				$this->f6k2->setSort("");
				$this->f0m3->setSort("");
				$this->f0k3->setSort("");
				$this->f1m3->setSort("");
				$this->f1k3->setSort("");
				$this->f2m3->setSort("");
				$this->f2k3->setSort("");
				$this->f3m3->setSort("");
				$this->f3k3->setSort("");
				$this->f4m3->setSort("");
				$this->f4k3->setSort("");
				$this->f5m3->setSort("");
				$this->f5k3->setSort("");
				$this->f6m3->setSort("");
				$this->f6k3->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language;

		// Add group option item
		$item = &$this->ListOptions->Add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;

		// "view"
		$item = &$this->ListOptions->Add("view");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanView();
		$item->OnLeft = FALSE;

		// "edit"
		$item = &$this->ListOptions->Add("edit");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanEdit();
		$item->OnLeft = FALSE;

		// "copy"
		$item = &$this->ListOptions->Add("copy");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanAdd();
		$item->OnLeft = FALSE;

		// "delete"
		$item = &$this->ListOptions->Add("delete");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = FALSE;

		// List actions
		$item = &$this->ListOptions->Add("listactions");
		$item->CssStyle = "white-space: nowrap;";
		$item->OnLeft = FALSE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->Add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = FALSE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" onclick=\"ew_SelectAllKey(this);\">";
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// "sequence"
		$item = &$this->ListOptions->Add("sequence");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE; // Always on left
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseImageAndText = TRUE;
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->Phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && ew_IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->ButtonClass = "btn-sm"; // Class for button group

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		$this->SetupListOptionsExt();
		$item = &$this->ListOptions->GetItem($this->ListOptions->GroupOptionName);
		$item->Visible = $this->ListOptions->GroupOptionVisible();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $objForm;
		$this->ListOptions->LoadDefault();

		// "sequence"
		$oListOpt = &$this->ListOptions->Items["sequence"];
		$oListOpt->Body = ew_FormatSeqNo($this->RecCnt);

		// "view"
		$oListOpt = &$this->ListOptions->Items["view"];
		$viewcaption = ew_HtmlTitle($Language->Phrase("ViewLink"));
		if ($Security->CanView()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewView\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . ew_HtmlEncode($this->ViewUrl) . "\">" . $Language->Phrase("ViewLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// "edit"
		$oListOpt = &$this->ListOptions->Items["edit"];
		$editcaption = ew_HtmlTitle($Language->Phrase("EditLink"));
		if ($Security->CanEdit()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" href=\"" . ew_HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("EditLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// "copy"
		$oListOpt = &$this->ListOptions->Items["copy"];
		$copycaption = ew_HtmlTitle($Language->Phrase("CopyLink"));
		if ($Security->CanAdd()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewCopy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . ew_HtmlEncode($this->CopyUrl) . "\">" . $Language->Phrase("CopyLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// "delete"
		$oListOpt = &$this->ListOptions->Items["delete"];
		if ($Security->CanDelete())
			$oListOpt->Body = "<a class=\"ewRowLink ewDelete\"" . "" . " title=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" href=\"" . ew_HtmlEncode($this->DeleteUrl) . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		else
			$oListOpt->Body = "";

		// Set up list action buttons
		$oListOpt = &$this->ListOptions->GetItem("listactions");
		if ($oListOpt && $this->Export == "" && $this->CurrentAction == "") {
			$body = "";
			$links = array();
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode(str_replace(" ewIcon", "", $listaction->Icon)) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\"></span> " : "";
					$links[] = "<li><a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $Language->Phrase("ListActionButton") . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default btn-sm ewActions\" title=\"" . ew_HtmlTitle($Language->Phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->Phrase("ListActionButton") . "<b class=\"caret\"></b></button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($oListOpt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$oListOpt->Body = $body;
				$oListOpt->Visible = TRUE;
			}
		}

		// "checkbox"
		$oListOpt = &$this->ListOptions->Items["checkbox"];
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" value=\"" . ew_HtmlEncode($this->pd_id->CurrentValue) . "\" onclick='ew_ClickMultiCheckbox(event);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["addedit"];

		// Add
		$item = &$option->Add("add");
		$addcaption = ew_HtmlTitle($Language->Phrase("AddLink"));
		$item->Body = "<a class=\"ewAddEdit ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . ew_HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("AddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->CanAdd());
		$option = $options["action"];

		// Set up options default
		foreach ($options as &$option) {
			$option->UseImageAndText = TRUE;
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;
			$option->ButtonClass = "btn-sm"; // Class for button group
			$item = &$option->Add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->Phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->Phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->Phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->Add("savecurrentfilter");
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fpegawai_defaultlistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fpegawai_defaultlistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->Phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->Add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	function RenderOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_MULTIPLE) {
					$item = &$option->Add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode($listaction->Icon) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\"></span> " : $caption;
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fpegawai_defaultlist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecs <= 0) {
				$option = &$options["addedit"];
				$item = &$option->GetItem("gridedit");
				if ($item) $item->Visible = FALSE;
				$option = &$options["action"];
				$option->HideAllOptions();
			}
	}

	// Process list action
	function ProcessListAction() {
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$sFilter = $this->GetKeyFilter();
		$UserAction = @$_POST["useraction"];
		if ($sFilter <> "" && $UserAction <> "") {

			// Check permission first
			$ActionCaption = $UserAction;
			if (array_key_exists($UserAction, $this->ListActions->Items)) {
				$ActionCaption = $this->ListActions->Items[$UserAction]->Caption;
				if (!$this->ListActions->Items[$UserAction]->Allow) {
					$errmsg = str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionNotAllowed"));
					if (@$_POST["ajax"] == $UserAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $sFilter;
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$rs = $conn->Execute($sSql);
			$conn->raiseErrorFn = '';
			$this->CurrentAction = $UserAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->BeginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$Processed = $this->Row_CustomAction($UserAction, $row);
					if (!$Processed) break;
					$rs->MoveNext();
				}
				if ($Processed) {
					$conn->CommitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->RollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage <> "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->Close();
			$this->CurrentAction = ""; // Clear action
			if (@$_POST["ajax"] == $UserAction) { // Ajax
				if ($this->getSuccessMessage() <> "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->ClearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() <> "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->ClearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up search options
	function SetupSearchOptions() {
		global $Language;
		$this->SearchOptions = new cListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ewSearchOption";

		// Search button
		$item = &$this->SearchOptions->Add("searchtoggle");
		$SearchToggleClass = ($this->SearchWhere <> "") ? " active" : " active";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fpegawai_defaultlistsrch\">" . $Language->Phrase("SearchBtn") . "</button>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->Add("showall");
		$item->Body = "<a class=\"btn btn-default ewShowAll\" title=\"" . $Language->Phrase("ShowAll") . "\" data-caption=\"" . $Language->Phrase("ShowAll") . "\" href=\"" . $this->PageUrl() . "cmd=reset\">" . $Language->Phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseImageAndText = TRUE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->Phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->Add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->Export <> "" || $this->CurrentAction <> "")
			$this->SearchOptions->HideAllOptions();
		global $Security;
		if (!$Security->CanSearch()) {
			$this->SearchOptions->HideAllOptions();
			$this->FilterOptions->HideAllOptions();
		}
	}

	function SetupListOptionsExt() {
		global $Security, $Language;
	}

	function RenderListOptionsExt() {
		global $Security, $Language;
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

	// Load basic search values
	function LoadBasicSearchValues() {
		$this->BasicSearch->Keyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		if ($this->BasicSearch->Keyword <> "") $this->Command = "search";
		$this->BasicSearch->Type = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
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
		$this->ViewUrl = $this->GetViewUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->InlineEditUrl = $this->GetInlineEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->InlineCopyUrl = $this->GetInlineCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();

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
		$item->Visible = FALSE;

		// Export to Email
		$item = &$this->ExportOptions->Add("email");
		$url = "";
		$item->Body = "<button id=\"emf_pegawai_default\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_pegawai_default',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fpegawai_defaultlist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = $this->UseSelectLimit;

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

		// Export all
		if ($this->ExportAll) {
			set_time_limit(EW_EXPORT_ALL_TIME_LIMIT);
			$this->DisplayRecs = $this->TotalRecs;
			$this->StopRec = $this->TotalRecs;
		} else { // Export one page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecs <= 0) {
				$this->StopRec = $this->TotalRecs;
			} else {
				$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->StartRec-1, $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		$this->ExportDoc = ew_ExportDocument($this, "h");
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
		$this->ExportDocument($Doc, $rs, $this->StartRec, $this->StopRec, "");
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

		// Build QueryString for search
		if ($this->BasicSearch->getKeyword() <> "") {
			$sQry .= "&" . EW_TABLE_BASIC_SEARCH . "=" . urlencode($this->BasicSearch->getKeyword()) . "&" . EW_TABLE_BASIC_SEARCH_TYPE . "=" . urlencode($this->BasicSearch->getType());
		}

		// Build QueryString for pager
		$sQry .= "&" . EW_TABLE_REC_PER_PAGE . "=" . urlencode($this->getRecordsPerPage()) . "&" . EW_TABLE_START_REC . "=" . urlencode($this->getStartRecordNumber());
		return $sQry;
	}

	// Add search QueryString
	function AddSearchQueryString(&$Qry, &$Fld) {
		$FldSearchValue = $Fld->AdvancedSearch->getValue("x");
		$FldParm = substr($Fld->FldVar,2);
		if (strval($FldSearchValue) <> "") {
			$Qry .= "&x_" . $FldParm . "=" . urlencode($FldSearchValue) .
				"&z_" . $FldParm . "=" . urlencode($Fld->AdvancedSearch->getValue("z"));
		}
		$FldSearchValue2 = $Fld->AdvancedSearch->getValue("y");
		if (strval($FldSearchValue2) <> "") {
			$Qry .= "&v_" . $FldParm . "=" . urlencode($Fld->AdvancedSearch->getValue("v")) .
				"&y_" . $FldParm . "=" . urlencode($FldSearchValue2) .
				"&w_" . $FldParm . "=" . urlencode($Fld->AdvancedSearch->getValue("w"));
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->Add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
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

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
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
if (!isset($pegawai_default_list)) $pegawai_default_list = new cpegawai_default_list();

// Page init
$pegawai_default_list->Page_Init();

// Page main
$pegawai_default_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pegawai_default_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($pegawai_default->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fpegawai_defaultlist = new ew_Form("fpegawai_defaultlist", "list");
fpegawai_defaultlist.FormKeyCountName = '<?php echo $pegawai_default_list->FormKeyCountName ?>';

// Form_CustomValidate event
fpegawai_defaultlist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fpegawai_defaultlist.ValidateRequired = true;
<?php } else { ?>
fpegawai_defaultlist.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fpegawai_defaultlist.Lists["x_pegawai_id"] = {"LinkField":"x_pegawai_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_pegawai_nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"pegawai"};
fpegawai_defaultlist.Lists["x_dept_id"] = {"LinkField":"x_pembagian2_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_pembagian2_nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"pembagian2"};

// Form object for search
var CurrentSearchForm = fpegawai_defaultlistsrch = new ew_Form("fpegawai_defaultlistsrch");
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($pegawai_default->Export == "") { ?>
<div class="ewToolbar">
<?php if ($pegawai_default->Export == "") { ?>
<?php $Breadcrumb->Render(); ?>
<?php } ?>
<?php if ($pegawai_default_list->TotalRecs > 0 && $pegawai_default_list->ExportOptions->Visible()) { ?>
<?php $pegawai_default_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($pegawai_default_list->SearchOptions->Visible()) { ?>
<?php $pegawai_default_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($pegawai_default_list->FilterOptions->Visible()) { ?>
<?php $pegawai_default_list->FilterOptions->Render("body") ?>
<?php } ?>
<?php if ($pegawai_default->Export == "") { ?>
<?php echo $Language->SelectionForm(); ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
	$bSelectLimit = $pegawai_default_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($pegawai_default_list->TotalRecs <= 0)
			$pegawai_default_list->TotalRecs = $pegawai_default->SelectRecordCount();
	} else {
		if (!$pegawai_default_list->Recordset && ($pegawai_default_list->Recordset = $pegawai_default_list->LoadRecordset()))
			$pegawai_default_list->TotalRecs = $pegawai_default_list->Recordset->RecordCount();
	}
	$pegawai_default_list->StartRec = 1;
	if ($pegawai_default_list->DisplayRecs <= 0 || ($pegawai_default->Export <> "" && $pegawai_default->ExportAll)) // Display all records
		$pegawai_default_list->DisplayRecs = $pegawai_default_list->TotalRecs;
	if (!($pegawai_default->Export <> "" && $pegawai_default->ExportAll))
		$pegawai_default_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$pegawai_default_list->Recordset = $pegawai_default_list->LoadRecordset($pegawai_default_list->StartRec-1, $pegawai_default_list->DisplayRecs);

	// Set no record found message
	if ($pegawai_default->CurrentAction == "" && $pegawai_default_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$pegawai_default_list->setWarningMessage(ew_DeniedMsg());
		if ($pegawai_default_list->SearchWhere == "0=101")
			$pegawai_default_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$pegawai_default_list->setWarningMessage($Language->Phrase("NoRecord"));
	}

	// Audit trail on search
	if ($pegawai_default_list->AuditTrailOnSearch && $pegawai_default_list->Command == "search" && !$pegawai_default_list->RestoreSearch) {
		$searchparm = ew_ServerVar("QUERY_STRING");
		$searchsql = $pegawai_default_list->getSessionWhere();
		$pegawai_default_list->WriteAuditTrailOnSearch($searchparm, $searchsql);
	}
$pegawai_default_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($pegawai_default->Export == "" && $pegawai_default->CurrentAction == "") { ?>
<form name="fpegawai_defaultlistsrch" id="fpegawai_defaultlistsrch" class="form-inline ewForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($pegawai_default_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="fpegawai_defaultlistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="pegawai_default">
	<div class="ewBasicSearch">
<div id="xsr_1" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($pegawai_default_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo ew_HtmlEncode($Language->Phrase("Search")) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($pegawai_default_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $pegawai_default_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($pegawai_default_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($pegawai_default_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($pegawai_default_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($pegawai_default_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
		</ul>
	<button class="btn btn-primary ewButton" name="btnsubmit" id="btnsubmit" type="submit"><?php echo $Language->Phrase("QuickSearchBtn") ?></button>
	</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $pegawai_default_list->ShowPageHeader(); ?>
<?php
$pegawai_default_list->ShowMessage();
?>
<?php if ($pegawai_default_list->TotalRecs > 0 || $pegawai_default->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid pegawai_default">
<form name="fpegawai_defaultlist" id="fpegawai_defaultlist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($pegawai_default_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $pegawai_default_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pegawai_default">
<div id="gmp_pegawai_default" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php if ($pegawai_default_list->TotalRecs > 0 || $pegawai_default->CurrentAction == "gridedit") { ?>
<table id="tbl_pegawai_defaultlist" class="table ewTable">
<?php echo $pegawai_default->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$pegawai_default_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$pegawai_default_list->RenderListOptions();

// Render list options (header, left)
$pegawai_default_list->ListOptions->Render("header", "left");
?>
<?php if ($pegawai_default->pd_id->Visible) { // pd_id ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->pd_id) == "") { ?>
		<th data-name="pd_id"><div id="elh_pegawai_default_pd_id" class="pegawai_default_pd_id"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->pd_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pd_id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->pd_id) ?>',2);"><div id="elh_pegawai_default_pd_id" class="pegawai_default_pd_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->pd_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->pd_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->pd_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->pegawai_id->Visible) { // pegawai_id ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->pegawai_id) == "") { ?>
		<th data-name="pegawai_id"><div id="elh_pegawai_default_pegawai_id" class="pegawai_default_pegawai_id"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->pegawai_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pegawai_id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->pegawai_id) ?>',2);"><div id="elh_pegawai_default_pegawai_id" class="pegawai_default_pegawai_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->pegawai_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->pegawai_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->pegawai_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->dept_id->Visible) { // dept_id ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->dept_id) == "") { ?>
		<th data-name="dept_id"><div id="elh_pegawai_default_dept_id" class="pegawai_default_dept_id"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->dept_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="dept_id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->dept_id) ?>',2);"><div id="elh_pegawai_default_dept_id" class="pegawai_default_dept_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->dept_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->dept_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->dept_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f0m1->Visible) { // f0m1 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f0m1) == "") { ?>
		<th data-name="f0m1"><div id="elh_pegawai_default_f0m1" class="pegawai_default_f0m1"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f0m1->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f0m1"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f0m1) ?>',2);"><div id="elh_pegawai_default_f0m1" class="pegawai_default_f0m1">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f0m1->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f0m1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f0m1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f0k1->Visible) { // f0k1 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f0k1) == "") { ?>
		<th data-name="f0k1"><div id="elh_pegawai_default_f0k1" class="pegawai_default_f0k1"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f0k1->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f0k1"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f0k1) ?>',2);"><div id="elh_pegawai_default_f0k1" class="pegawai_default_f0k1">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f0k1->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f0k1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f0k1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f1m1->Visible) { // f1m1 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f1m1) == "") { ?>
		<th data-name="f1m1"><div id="elh_pegawai_default_f1m1" class="pegawai_default_f1m1"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f1m1->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f1m1"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f1m1) ?>',2);"><div id="elh_pegawai_default_f1m1" class="pegawai_default_f1m1">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f1m1->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f1m1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f1m1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f1k1->Visible) { // f1k1 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f1k1) == "") { ?>
		<th data-name="f1k1"><div id="elh_pegawai_default_f1k1" class="pegawai_default_f1k1"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f1k1->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f1k1"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f1k1) ?>',2);"><div id="elh_pegawai_default_f1k1" class="pegawai_default_f1k1">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f1k1->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f1k1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f1k1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f2m1->Visible) { // f2m1 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f2m1) == "") { ?>
		<th data-name="f2m1"><div id="elh_pegawai_default_f2m1" class="pegawai_default_f2m1"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f2m1->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f2m1"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f2m1) ?>',2);"><div id="elh_pegawai_default_f2m1" class="pegawai_default_f2m1">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f2m1->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f2m1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f2m1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f2k1->Visible) { // f2k1 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f2k1) == "") { ?>
		<th data-name="f2k1"><div id="elh_pegawai_default_f2k1" class="pegawai_default_f2k1"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f2k1->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f2k1"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f2k1) ?>',2);"><div id="elh_pegawai_default_f2k1" class="pegawai_default_f2k1">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f2k1->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f2k1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f2k1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f3m1->Visible) { // f3m1 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f3m1) == "") { ?>
		<th data-name="f3m1"><div id="elh_pegawai_default_f3m1" class="pegawai_default_f3m1"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f3m1->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f3m1"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f3m1) ?>',2);"><div id="elh_pegawai_default_f3m1" class="pegawai_default_f3m1">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f3m1->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f3m1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f3m1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f3k1->Visible) { // f3k1 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f3k1) == "") { ?>
		<th data-name="f3k1"><div id="elh_pegawai_default_f3k1" class="pegawai_default_f3k1"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f3k1->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f3k1"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f3k1) ?>',2);"><div id="elh_pegawai_default_f3k1" class="pegawai_default_f3k1">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f3k1->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f3k1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f3k1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f4m1->Visible) { // f4m1 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f4m1) == "") { ?>
		<th data-name="f4m1"><div id="elh_pegawai_default_f4m1" class="pegawai_default_f4m1"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f4m1->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f4m1"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f4m1) ?>',2);"><div id="elh_pegawai_default_f4m1" class="pegawai_default_f4m1">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f4m1->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f4m1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f4m1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f4k1->Visible) { // f4k1 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f4k1) == "") { ?>
		<th data-name="f4k1"><div id="elh_pegawai_default_f4k1" class="pegawai_default_f4k1"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f4k1->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f4k1"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f4k1) ?>',2);"><div id="elh_pegawai_default_f4k1" class="pegawai_default_f4k1">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f4k1->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f4k1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f4k1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f5m1->Visible) { // f5m1 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f5m1) == "") { ?>
		<th data-name="f5m1"><div id="elh_pegawai_default_f5m1" class="pegawai_default_f5m1"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f5m1->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f5m1"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f5m1) ?>',2);"><div id="elh_pegawai_default_f5m1" class="pegawai_default_f5m1">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f5m1->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f5m1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f5m1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f5k1->Visible) { // f5k1 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f5k1) == "") { ?>
		<th data-name="f5k1"><div id="elh_pegawai_default_f5k1" class="pegawai_default_f5k1"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f5k1->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f5k1"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f5k1) ?>',2);"><div id="elh_pegawai_default_f5k1" class="pegawai_default_f5k1">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f5k1->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f5k1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f5k1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f6m1->Visible) { // f6m1 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f6m1) == "") { ?>
		<th data-name="f6m1"><div id="elh_pegawai_default_f6m1" class="pegawai_default_f6m1"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f6m1->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f6m1"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f6m1) ?>',2);"><div id="elh_pegawai_default_f6m1" class="pegawai_default_f6m1">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f6m1->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f6m1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f6m1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f6k1->Visible) { // f6k1 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f6k1) == "") { ?>
		<th data-name="f6k1"><div id="elh_pegawai_default_f6k1" class="pegawai_default_f6k1"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f6k1->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f6k1"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f6k1) ?>',2);"><div id="elh_pegawai_default_f6k1" class="pegawai_default_f6k1">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f6k1->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f6k1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f6k1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f0m2->Visible) { // f0m2 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f0m2) == "") { ?>
		<th data-name="f0m2"><div id="elh_pegawai_default_f0m2" class="pegawai_default_f0m2"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f0m2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f0m2"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f0m2) ?>',2);"><div id="elh_pegawai_default_f0m2" class="pegawai_default_f0m2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f0m2->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f0m2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f0m2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f0k2->Visible) { // f0k2 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f0k2) == "") { ?>
		<th data-name="f0k2"><div id="elh_pegawai_default_f0k2" class="pegawai_default_f0k2"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f0k2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f0k2"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f0k2) ?>',2);"><div id="elh_pegawai_default_f0k2" class="pegawai_default_f0k2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f0k2->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f0k2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f0k2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f1m2->Visible) { // f1m2 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f1m2) == "") { ?>
		<th data-name="f1m2"><div id="elh_pegawai_default_f1m2" class="pegawai_default_f1m2"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f1m2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f1m2"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f1m2) ?>',2);"><div id="elh_pegawai_default_f1m2" class="pegawai_default_f1m2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f1m2->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f1m2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f1m2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f1k2->Visible) { // f1k2 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f1k2) == "") { ?>
		<th data-name="f1k2"><div id="elh_pegawai_default_f1k2" class="pegawai_default_f1k2"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f1k2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f1k2"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f1k2) ?>',2);"><div id="elh_pegawai_default_f1k2" class="pegawai_default_f1k2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f1k2->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f1k2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f1k2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f2m2->Visible) { // f2m2 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f2m2) == "") { ?>
		<th data-name="f2m2"><div id="elh_pegawai_default_f2m2" class="pegawai_default_f2m2"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f2m2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f2m2"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f2m2) ?>',2);"><div id="elh_pegawai_default_f2m2" class="pegawai_default_f2m2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f2m2->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f2m2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f2m2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f2k2->Visible) { // f2k2 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f2k2) == "") { ?>
		<th data-name="f2k2"><div id="elh_pegawai_default_f2k2" class="pegawai_default_f2k2"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f2k2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f2k2"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f2k2) ?>',2);"><div id="elh_pegawai_default_f2k2" class="pegawai_default_f2k2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f2k2->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f2k2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f2k2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f3m2->Visible) { // f3m2 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f3m2) == "") { ?>
		<th data-name="f3m2"><div id="elh_pegawai_default_f3m2" class="pegawai_default_f3m2"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f3m2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f3m2"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f3m2) ?>',2);"><div id="elh_pegawai_default_f3m2" class="pegawai_default_f3m2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f3m2->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f3m2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f3m2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f3k2->Visible) { // f3k2 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f3k2) == "") { ?>
		<th data-name="f3k2"><div id="elh_pegawai_default_f3k2" class="pegawai_default_f3k2"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f3k2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f3k2"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f3k2) ?>',2);"><div id="elh_pegawai_default_f3k2" class="pegawai_default_f3k2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f3k2->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f3k2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f3k2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f4m2->Visible) { // f4m2 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f4m2) == "") { ?>
		<th data-name="f4m2"><div id="elh_pegawai_default_f4m2" class="pegawai_default_f4m2"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f4m2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f4m2"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f4m2) ?>',2);"><div id="elh_pegawai_default_f4m2" class="pegawai_default_f4m2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f4m2->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f4m2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f4m2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f4k2->Visible) { // f4k2 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f4k2) == "") { ?>
		<th data-name="f4k2"><div id="elh_pegawai_default_f4k2" class="pegawai_default_f4k2"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f4k2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f4k2"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f4k2) ?>',2);"><div id="elh_pegawai_default_f4k2" class="pegawai_default_f4k2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f4k2->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f4k2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f4k2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f5m2->Visible) { // f5m2 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f5m2) == "") { ?>
		<th data-name="f5m2"><div id="elh_pegawai_default_f5m2" class="pegawai_default_f5m2"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f5m2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f5m2"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f5m2) ?>',2);"><div id="elh_pegawai_default_f5m2" class="pegawai_default_f5m2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f5m2->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f5m2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f5m2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f5k2->Visible) { // f5k2 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f5k2) == "") { ?>
		<th data-name="f5k2"><div id="elh_pegawai_default_f5k2" class="pegawai_default_f5k2"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f5k2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f5k2"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f5k2) ?>',2);"><div id="elh_pegawai_default_f5k2" class="pegawai_default_f5k2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f5k2->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f5k2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f5k2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f6m2->Visible) { // f6m2 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f6m2) == "") { ?>
		<th data-name="f6m2"><div id="elh_pegawai_default_f6m2" class="pegawai_default_f6m2"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f6m2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f6m2"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f6m2) ?>',2);"><div id="elh_pegawai_default_f6m2" class="pegawai_default_f6m2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f6m2->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f6m2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f6m2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f6k2->Visible) { // f6k2 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f6k2) == "") { ?>
		<th data-name="f6k2"><div id="elh_pegawai_default_f6k2" class="pegawai_default_f6k2"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f6k2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f6k2"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f6k2) ?>',2);"><div id="elh_pegawai_default_f6k2" class="pegawai_default_f6k2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f6k2->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f6k2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f6k2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f0m3->Visible) { // f0m3 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f0m3) == "") { ?>
		<th data-name="f0m3"><div id="elh_pegawai_default_f0m3" class="pegawai_default_f0m3"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f0m3->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f0m3"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f0m3) ?>',2);"><div id="elh_pegawai_default_f0m3" class="pegawai_default_f0m3">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f0m3->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f0m3->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f0m3->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f0k3->Visible) { // f0k3 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f0k3) == "") { ?>
		<th data-name="f0k3"><div id="elh_pegawai_default_f0k3" class="pegawai_default_f0k3"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f0k3->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f0k3"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f0k3) ?>',2);"><div id="elh_pegawai_default_f0k3" class="pegawai_default_f0k3">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f0k3->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f0k3->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f0k3->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f1m3->Visible) { // f1m3 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f1m3) == "") { ?>
		<th data-name="f1m3"><div id="elh_pegawai_default_f1m3" class="pegawai_default_f1m3"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f1m3->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f1m3"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f1m3) ?>',2);"><div id="elh_pegawai_default_f1m3" class="pegawai_default_f1m3">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f1m3->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f1m3->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f1m3->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f1k3->Visible) { // f1k3 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f1k3) == "") { ?>
		<th data-name="f1k3"><div id="elh_pegawai_default_f1k3" class="pegawai_default_f1k3"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f1k3->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f1k3"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f1k3) ?>',2);"><div id="elh_pegawai_default_f1k3" class="pegawai_default_f1k3">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f1k3->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f1k3->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f1k3->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f2m3->Visible) { // f2m3 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f2m3) == "") { ?>
		<th data-name="f2m3"><div id="elh_pegawai_default_f2m3" class="pegawai_default_f2m3"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f2m3->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f2m3"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f2m3) ?>',2);"><div id="elh_pegawai_default_f2m3" class="pegawai_default_f2m3">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f2m3->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f2m3->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f2m3->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f2k3->Visible) { // f2k3 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f2k3) == "") { ?>
		<th data-name="f2k3"><div id="elh_pegawai_default_f2k3" class="pegawai_default_f2k3"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f2k3->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f2k3"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f2k3) ?>',2);"><div id="elh_pegawai_default_f2k3" class="pegawai_default_f2k3">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f2k3->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f2k3->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f2k3->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f3m3->Visible) { // f3m3 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f3m3) == "") { ?>
		<th data-name="f3m3"><div id="elh_pegawai_default_f3m3" class="pegawai_default_f3m3"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f3m3->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f3m3"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f3m3) ?>',2);"><div id="elh_pegawai_default_f3m3" class="pegawai_default_f3m3">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f3m3->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f3m3->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f3m3->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f3k3->Visible) { // f3k3 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f3k3) == "") { ?>
		<th data-name="f3k3"><div id="elh_pegawai_default_f3k3" class="pegawai_default_f3k3"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f3k3->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f3k3"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f3k3) ?>',2);"><div id="elh_pegawai_default_f3k3" class="pegawai_default_f3k3">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f3k3->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f3k3->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f3k3->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f4m3->Visible) { // f4m3 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f4m3) == "") { ?>
		<th data-name="f4m3"><div id="elh_pegawai_default_f4m3" class="pegawai_default_f4m3"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f4m3->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f4m3"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f4m3) ?>',2);"><div id="elh_pegawai_default_f4m3" class="pegawai_default_f4m3">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f4m3->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f4m3->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f4m3->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f4k3->Visible) { // f4k3 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f4k3) == "") { ?>
		<th data-name="f4k3"><div id="elh_pegawai_default_f4k3" class="pegawai_default_f4k3"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f4k3->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f4k3"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f4k3) ?>',2);"><div id="elh_pegawai_default_f4k3" class="pegawai_default_f4k3">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f4k3->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f4k3->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f4k3->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f5m3->Visible) { // f5m3 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f5m3) == "") { ?>
		<th data-name="f5m3"><div id="elh_pegawai_default_f5m3" class="pegawai_default_f5m3"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f5m3->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f5m3"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f5m3) ?>',2);"><div id="elh_pegawai_default_f5m3" class="pegawai_default_f5m3">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f5m3->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f5m3->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f5m3->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f5k3->Visible) { // f5k3 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f5k3) == "") { ?>
		<th data-name="f5k3"><div id="elh_pegawai_default_f5k3" class="pegawai_default_f5k3"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f5k3->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f5k3"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f5k3) ?>',2);"><div id="elh_pegawai_default_f5k3" class="pegawai_default_f5k3">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f5k3->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f5k3->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f5k3->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f6m3->Visible) { // f6m3 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f6m3) == "") { ?>
		<th data-name="f6m3"><div id="elh_pegawai_default_f6m3" class="pegawai_default_f6m3"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f6m3->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f6m3"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f6m3) ?>',2);"><div id="elh_pegawai_default_f6m3" class="pegawai_default_f6m3">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f6m3->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f6m3->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f6m3->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($pegawai_default->f6k3->Visible) { // f6k3 ?>
	<?php if ($pegawai_default->SortUrl($pegawai_default->f6k3) == "") { ?>
		<th data-name="f6k3"><div id="elh_pegawai_default_f6k3" class="pegawai_default_f6k3"><div class="ewTableHeaderCaption"><?php echo $pegawai_default->f6k3->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="f6k3"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pegawai_default->SortUrl($pegawai_default->f6k3) ?>',2);"><div id="elh_pegawai_default_f6k3" class="pegawai_default_f6k3">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pegawai_default->f6k3->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($pegawai_default->f6k3->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pegawai_default->f6k3->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$pegawai_default_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($pegawai_default->ExportAll && $pegawai_default->Export <> "") {
	$pegawai_default_list->StopRec = $pegawai_default_list->TotalRecs;
} else {

	// Set the last record to display
	if ($pegawai_default_list->TotalRecs > $pegawai_default_list->StartRec + $pegawai_default_list->DisplayRecs - 1)
		$pegawai_default_list->StopRec = $pegawai_default_list->StartRec + $pegawai_default_list->DisplayRecs - 1;
	else
		$pegawai_default_list->StopRec = $pegawai_default_list->TotalRecs;
}
$pegawai_default_list->RecCnt = $pegawai_default_list->StartRec - 1;
if ($pegawai_default_list->Recordset && !$pegawai_default_list->Recordset->EOF) {
	$pegawai_default_list->Recordset->MoveFirst();
	$bSelectLimit = $pegawai_default_list->UseSelectLimit;
	if (!$bSelectLimit && $pegawai_default_list->StartRec > 1)
		$pegawai_default_list->Recordset->Move($pegawai_default_list->StartRec - 1);
} elseif (!$pegawai_default->AllowAddDeleteRow && $pegawai_default_list->StopRec == 0) {
	$pegawai_default_list->StopRec = $pegawai_default->GridAddRowCount;
}

// Initialize aggregate
$pegawai_default->RowType = EW_ROWTYPE_AGGREGATEINIT;
$pegawai_default->ResetAttrs();
$pegawai_default_list->RenderRow();
while ($pegawai_default_list->RecCnt < $pegawai_default_list->StopRec) {
	$pegawai_default_list->RecCnt++;
	if (intval($pegawai_default_list->RecCnt) >= intval($pegawai_default_list->StartRec)) {
		$pegawai_default_list->RowCnt++;

		// Set up key count
		$pegawai_default_list->KeyCount = $pegawai_default_list->RowIndex;

		// Init row class and style
		$pegawai_default->ResetAttrs();
		$pegawai_default->CssClass = "";
		if ($pegawai_default->CurrentAction == "gridadd") {
		} else {
			$pegawai_default_list->LoadRowValues($pegawai_default_list->Recordset); // Load row values
		}
		$pegawai_default->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$pegawai_default->RowAttrs = array_merge($pegawai_default->RowAttrs, array('data-rowindex'=>$pegawai_default_list->RowCnt, 'id'=>'r' . $pegawai_default_list->RowCnt . '_pegawai_default', 'data-rowtype'=>$pegawai_default->RowType));

		// Render row
		$pegawai_default_list->RenderRow();

		// Render list options
		$pegawai_default_list->RenderListOptions();
?>
	<tr<?php echo $pegawai_default->RowAttributes() ?>>
<?php

// Render list options (body, left)
$pegawai_default_list->ListOptions->Render("body", "left", $pegawai_default_list->RowCnt);
?>
	<?php if ($pegawai_default->pd_id->Visible) { // pd_id ?>
		<td data-name="pd_id"<?php echo $pegawai_default->pd_id->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_pd_id" class="pegawai_default_pd_id">
<span<?php echo $pegawai_default->pd_id->ViewAttributes() ?>>
<?php echo $pegawai_default->pd_id->ListViewValue() ?></span>
</span>
<a id="<?php echo $pegawai_default_list->PageObjName . "_row_" . $pegawai_default_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($pegawai_default->pegawai_id->Visible) { // pegawai_id ?>
		<td data-name="pegawai_id"<?php echo $pegawai_default->pegawai_id->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_pegawai_id" class="pegawai_default_pegawai_id">
<span<?php echo $pegawai_default->pegawai_id->ViewAttributes() ?>>
<?php echo $pegawai_default->pegawai_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->dept_id->Visible) { // dept_id ?>
		<td data-name="dept_id"<?php echo $pegawai_default->dept_id->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_dept_id" class="pegawai_default_dept_id">
<span<?php echo $pegawai_default->dept_id->ViewAttributes() ?>>
<?php echo $pegawai_default->dept_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f0m1->Visible) { // f0m1 ?>
		<td data-name="f0m1"<?php echo $pegawai_default->f0m1->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f0m1" class="pegawai_default_f0m1">
<span<?php echo $pegawai_default->f0m1->ViewAttributes() ?>>
<?php echo $pegawai_default->f0m1->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f0k1->Visible) { // f0k1 ?>
		<td data-name="f0k1"<?php echo $pegawai_default->f0k1->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f0k1" class="pegawai_default_f0k1">
<span<?php echo $pegawai_default->f0k1->ViewAttributes() ?>>
<?php echo $pegawai_default->f0k1->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f1m1->Visible) { // f1m1 ?>
		<td data-name="f1m1"<?php echo $pegawai_default->f1m1->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f1m1" class="pegawai_default_f1m1">
<span<?php echo $pegawai_default->f1m1->ViewAttributes() ?>>
<?php echo $pegawai_default->f1m1->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f1k1->Visible) { // f1k1 ?>
		<td data-name="f1k1"<?php echo $pegawai_default->f1k1->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f1k1" class="pegawai_default_f1k1">
<span<?php echo $pegawai_default->f1k1->ViewAttributes() ?>>
<?php echo $pegawai_default->f1k1->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f2m1->Visible) { // f2m1 ?>
		<td data-name="f2m1"<?php echo $pegawai_default->f2m1->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f2m1" class="pegawai_default_f2m1">
<span<?php echo $pegawai_default->f2m1->ViewAttributes() ?>>
<?php echo $pegawai_default->f2m1->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f2k1->Visible) { // f2k1 ?>
		<td data-name="f2k1"<?php echo $pegawai_default->f2k1->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f2k1" class="pegawai_default_f2k1">
<span<?php echo $pegawai_default->f2k1->ViewAttributes() ?>>
<?php echo $pegawai_default->f2k1->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f3m1->Visible) { // f3m1 ?>
		<td data-name="f3m1"<?php echo $pegawai_default->f3m1->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f3m1" class="pegawai_default_f3m1">
<span<?php echo $pegawai_default->f3m1->ViewAttributes() ?>>
<?php echo $pegawai_default->f3m1->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f3k1->Visible) { // f3k1 ?>
		<td data-name="f3k1"<?php echo $pegawai_default->f3k1->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f3k1" class="pegawai_default_f3k1">
<span<?php echo $pegawai_default->f3k1->ViewAttributes() ?>>
<?php echo $pegawai_default->f3k1->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f4m1->Visible) { // f4m1 ?>
		<td data-name="f4m1"<?php echo $pegawai_default->f4m1->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f4m1" class="pegawai_default_f4m1">
<span<?php echo $pegawai_default->f4m1->ViewAttributes() ?>>
<?php echo $pegawai_default->f4m1->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f4k1->Visible) { // f4k1 ?>
		<td data-name="f4k1"<?php echo $pegawai_default->f4k1->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f4k1" class="pegawai_default_f4k1">
<span<?php echo $pegawai_default->f4k1->ViewAttributes() ?>>
<?php echo $pegawai_default->f4k1->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f5m1->Visible) { // f5m1 ?>
		<td data-name="f5m1"<?php echo $pegawai_default->f5m1->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f5m1" class="pegawai_default_f5m1">
<span<?php echo $pegawai_default->f5m1->ViewAttributes() ?>>
<?php echo $pegawai_default->f5m1->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f5k1->Visible) { // f5k1 ?>
		<td data-name="f5k1"<?php echo $pegawai_default->f5k1->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f5k1" class="pegawai_default_f5k1">
<span<?php echo $pegawai_default->f5k1->ViewAttributes() ?>>
<?php echo $pegawai_default->f5k1->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f6m1->Visible) { // f6m1 ?>
		<td data-name="f6m1"<?php echo $pegawai_default->f6m1->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f6m1" class="pegawai_default_f6m1">
<span<?php echo $pegawai_default->f6m1->ViewAttributes() ?>>
<?php echo $pegawai_default->f6m1->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f6k1->Visible) { // f6k1 ?>
		<td data-name="f6k1"<?php echo $pegawai_default->f6k1->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f6k1" class="pegawai_default_f6k1">
<span<?php echo $pegawai_default->f6k1->ViewAttributes() ?>>
<?php echo $pegawai_default->f6k1->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f0m2->Visible) { // f0m2 ?>
		<td data-name="f0m2"<?php echo $pegawai_default->f0m2->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f0m2" class="pegawai_default_f0m2">
<span<?php echo $pegawai_default->f0m2->ViewAttributes() ?>>
<?php echo $pegawai_default->f0m2->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f0k2->Visible) { // f0k2 ?>
		<td data-name="f0k2"<?php echo $pegawai_default->f0k2->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f0k2" class="pegawai_default_f0k2">
<span<?php echo $pegawai_default->f0k2->ViewAttributes() ?>>
<?php echo $pegawai_default->f0k2->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f1m2->Visible) { // f1m2 ?>
		<td data-name="f1m2"<?php echo $pegawai_default->f1m2->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f1m2" class="pegawai_default_f1m2">
<span<?php echo $pegawai_default->f1m2->ViewAttributes() ?>>
<?php echo $pegawai_default->f1m2->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f1k2->Visible) { // f1k2 ?>
		<td data-name="f1k2"<?php echo $pegawai_default->f1k2->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f1k2" class="pegawai_default_f1k2">
<span<?php echo $pegawai_default->f1k2->ViewAttributes() ?>>
<?php echo $pegawai_default->f1k2->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f2m2->Visible) { // f2m2 ?>
		<td data-name="f2m2"<?php echo $pegawai_default->f2m2->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f2m2" class="pegawai_default_f2m2">
<span<?php echo $pegawai_default->f2m2->ViewAttributes() ?>>
<?php echo $pegawai_default->f2m2->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f2k2->Visible) { // f2k2 ?>
		<td data-name="f2k2"<?php echo $pegawai_default->f2k2->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f2k2" class="pegawai_default_f2k2">
<span<?php echo $pegawai_default->f2k2->ViewAttributes() ?>>
<?php echo $pegawai_default->f2k2->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f3m2->Visible) { // f3m2 ?>
		<td data-name="f3m2"<?php echo $pegawai_default->f3m2->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f3m2" class="pegawai_default_f3m2">
<span<?php echo $pegawai_default->f3m2->ViewAttributes() ?>>
<?php echo $pegawai_default->f3m2->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f3k2->Visible) { // f3k2 ?>
		<td data-name="f3k2"<?php echo $pegawai_default->f3k2->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f3k2" class="pegawai_default_f3k2">
<span<?php echo $pegawai_default->f3k2->ViewAttributes() ?>>
<?php echo $pegawai_default->f3k2->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f4m2->Visible) { // f4m2 ?>
		<td data-name="f4m2"<?php echo $pegawai_default->f4m2->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f4m2" class="pegawai_default_f4m2">
<span<?php echo $pegawai_default->f4m2->ViewAttributes() ?>>
<?php echo $pegawai_default->f4m2->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f4k2->Visible) { // f4k2 ?>
		<td data-name="f4k2"<?php echo $pegawai_default->f4k2->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f4k2" class="pegawai_default_f4k2">
<span<?php echo $pegawai_default->f4k2->ViewAttributes() ?>>
<?php echo $pegawai_default->f4k2->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f5m2->Visible) { // f5m2 ?>
		<td data-name="f5m2"<?php echo $pegawai_default->f5m2->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f5m2" class="pegawai_default_f5m2">
<span<?php echo $pegawai_default->f5m2->ViewAttributes() ?>>
<?php echo $pegawai_default->f5m2->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f5k2->Visible) { // f5k2 ?>
		<td data-name="f5k2"<?php echo $pegawai_default->f5k2->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f5k2" class="pegawai_default_f5k2">
<span<?php echo $pegawai_default->f5k2->ViewAttributes() ?>>
<?php echo $pegawai_default->f5k2->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f6m2->Visible) { // f6m2 ?>
		<td data-name="f6m2"<?php echo $pegawai_default->f6m2->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f6m2" class="pegawai_default_f6m2">
<span<?php echo $pegawai_default->f6m2->ViewAttributes() ?>>
<?php echo $pegawai_default->f6m2->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f6k2->Visible) { // f6k2 ?>
		<td data-name="f6k2"<?php echo $pegawai_default->f6k2->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f6k2" class="pegawai_default_f6k2">
<span<?php echo $pegawai_default->f6k2->ViewAttributes() ?>>
<?php echo $pegawai_default->f6k2->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f0m3->Visible) { // f0m3 ?>
		<td data-name="f0m3"<?php echo $pegawai_default->f0m3->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f0m3" class="pegawai_default_f0m3">
<span<?php echo $pegawai_default->f0m3->ViewAttributes() ?>>
<?php echo $pegawai_default->f0m3->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f0k3->Visible) { // f0k3 ?>
		<td data-name="f0k3"<?php echo $pegawai_default->f0k3->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f0k3" class="pegawai_default_f0k3">
<span<?php echo $pegawai_default->f0k3->ViewAttributes() ?>>
<?php echo $pegawai_default->f0k3->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f1m3->Visible) { // f1m3 ?>
		<td data-name="f1m3"<?php echo $pegawai_default->f1m3->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f1m3" class="pegawai_default_f1m3">
<span<?php echo $pegawai_default->f1m3->ViewAttributes() ?>>
<?php echo $pegawai_default->f1m3->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f1k3->Visible) { // f1k3 ?>
		<td data-name="f1k3"<?php echo $pegawai_default->f1k3->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f1k3" class="pegawai_default_f1k3">
<span<?php echo $pegawai_default->f1k3->ViewAttributes() ?>>
<?php echo $pegawai_default->f1k3->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f2m3->Visible) { // f2m3 ?>
		<td data-name="f2m3"<?php echo $pegawai_default->f2m3->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f2m3" class="pegawai_default_f2m3">
<span<?php echo $pegawai_default->f2m3->ViewAttributes() ?>>
<?php echo $pegawai_default->f2m3->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f2k3->Visible) { // f2k3 ?>
		<td data-name="f2k3"<?php echo $pegawai_default->f2k3->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f2k3" class="pegawai_default_f2k3">
<span<?php echo $pegawai_default->f2k3->ViewAttributes() ?>>
<?php echo $pegawai_default->f2k3->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f3m3->Visible) { // f3m3 ?>
		<td data-name="f3m3"<?php echo $pegawai_default->f3m3->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f3m3" class="pegawai_default_f3m3">
<span<?php echo $pegawai_default->f3m3->ViewAttributes() ?>>
<?php echo $pegawai_default->f3m3->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f3k3->Visible) { // f3k3 ?>
		<td data-name="f3k3"<?php echo $pegawai_default->f3k3->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f3k3" class="pegawai_default_f3k3">
<span<?php echo $pegawai_default->f3k3->ViewAttributes() ?>>
<?php echo $pegawai_default->f3k3->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f4m3->Visible) { // f4m3 ?>
		<td data-name="f4m3"<?php echo $pegawai_default->f4m3->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f4m3" class="pegawai_default_f4m3">
<span<?php echo $pegawai_default->f4m3->ViewAttributes() ?>>
<?php echo $pegawai_default->f4m3->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f4k3->Visible) { // f4k3 ?>
		<td data-name="f4k3"<?php echo $pegawai_default->f4k3->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f4k3" class="pegawai_default_f4k3">
<span<?php echo $pegawai_default->f4k3->ViewAttributes() ?>>
<?php echo $pegawai_default->f4k3->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f5m3->Visible) { // f5m3 ?>
		<td data-name="f5m3"<?php echo $pegawai_default->f5m3->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f5m3" class="pegawai_default_f5m3">
<span<?php echo $pegawai_default->f5m3->ViewAttributes() ?>>
<?php echo $pegawai_default->f5m3->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f5k3->Visible) { // f5k3 ?>
		<td data-name="f5k3"<?php echo $pegawai_default->f5k3->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f5k3" class="pegawai_default_f5k3">
<span<?php echo $pegawai_default->f5k3->ViewAttributes() ?>>
<?php echo $pegawai_default->f5k3->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f6m3->Visible) { // f6m3 ?>
		<td data-name="f6m3"<?php echo $pegawai_default->f6m3->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f6m3" class="pegawai_default_f6m3">
<span<?php echo $pegawai_default->f6m3->ViewAttributes() ?>>
<?php echo $pegawai_default->f6m3->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pegawai_default->f6k3->Visible) { // f6k3 ?>
		<td data-name="f6k3"<?php echo $pegawai_default->f6k3->CellAttributes() ?>>
<span id="el<?php echo $pegawai_default_list->RowCnt ?>_pegawai_default_f6k3" class="pegawai_default_f6k3">
<span<?php echo $pegawai_default->f6k3->ViewAttributes() ?>>
<?php echo $pegawai_default->f6k3->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pegawai_default_list->ListOptions->Render("body", "right", $pegawai_default_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($pegawai_default->CurrentAction <> "gridadd")
		$pegawai_default_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($pegawai_default->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($pegawai_default_list->Recordset)
	$pegawai_default_list->Recordset->Close();
?>
<?php if ($pegawai_default->Export == "") { ?>
<div class="panel-footer ewGridLowerPanel">
<?php if ($pegawai_default->CurrentAction <> "gridadd" && $pegawai_default->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($pegawai_default_list->Pager)) $pegawai_default_list->Pager = new cPrevNextPager($pegawai_default_list->StartRec, $pegawai_default_list->DisplayRecs, $pegawai_default_list->TotalRecs) ?>
<?php if ($pegawai_default_list->Pager->RecordCount > 0 && $pegawai_default_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($pegawai_default_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $pegawai_default_list->PageUrl() ?>start=<?php echo $pegawai_default_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($pegawai_default_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $pegawai_default_list->PageUrl() ?>start=<?php echo $pegawai_default_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $pegawai_default_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($pegawai_default_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $pegawai_default_list->PageUrl() ?>start=<?php echo $pegawai_default_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($pegawai_default_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $pegawai_default_list->PageUrl() ?>start=<?php echo $pegawai_default_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $pegawai_default_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $pegawai_default_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $pegawai_default_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $pegawai_default_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($pegawai_default_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($pegawai_default_list->TotalRecs == 0 && $pegawai_default->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($pegawai_default_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($pegawai_default->Export == "") { ?>
<script type="text/javascript">
fpegawai_defaultlistsrch.FilterList = <?php echo $pegawai_default_list->GetFilterList() ?>;
fpegawai_defaultlistsrch.Init();
fpegawai_defaultlist.Init();
</script>
<?php } ?>
<?php
$pegawai_default_list->ShowPageFooter();
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
$pegawai_default_list->Page_Terminate();
?>
