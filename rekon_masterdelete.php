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

$rekon_master_delete = NULL; // Initialize page object first

class crekon_master_delete extends crekon_master {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = "{4B5DAB39-E4BC-48DF-9311-E295A5F18030}";

	// Table name
	var $TableName = 'rekon_master';

	// Page object name
	var $PageObjName = 'rekon_master_delete';

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
			define("EW_PAGE_ID", 'delete', TRUE);

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
		if (!$Security->CanDelete()) {
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
			$this->Page_Terminate("rekon_masterlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in rekon_master class, rekon_masterinfo.php

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
				$this->Page_Terminate("rekon_masterlist.php"); // Return to list
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
				$sThisKey .= $row['rm_id'];
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("rekon_masterlist.php"), "", $this->TableVar, TRUE);
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
if (!isset($rekon_master_delete)) $rekon_master_delete = new crekon_master_delete();

// Page init
$rekon_master_delete->Page_Init();

// Page main
$rekon_master_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$rekon_master_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = frekon_masterdelete = new ew_Form("frekon_masterdelete", "delete");

// Form_CustomValidate event
frekon_masterdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
frekon_masterdelete.ValidateRequired = true;
<?php } else { ?>
frekon_masterdelete.ValidateRequired = false; 
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
<?php $rekon_master_delete->ShowPageHeader(); ?>
<?php
$rekon_master_delete->ShowMessage();
?>
<form name="frekon_masterdelete" id="frekon_masterdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($rekon_master_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $rekon_master_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="rekon_master">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($rekon_master_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table class="table ewTable">
<?php echo $rekon_master->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
<?php if ($rekon_master->rm_id->Visible) { // rm_id ?>
		<th><span id="elh_rekon_master_rm_id" class="rekon_master_rm_id"><?php echo $rekon_master->rm_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->pegawai_id->Visible) { // pegawai_id ?>
		<th><span id="elh_rekon_master_pegawai_id" class="rekon_master_pegawai_id"><?php echo $rekon_master->pegawai_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f1->Visible) { // f1 ?>
		<th><span id="elh_rekon_master_f1" class="rekon_master_f1"><?php echo $rekon_master->f1->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f2->Visible) { // f2 ?>
		<th><span id="elh_rekon_master_f2" class="rekon_master_f2"><?php echo $rekon_master->f2->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f3->Visible) { // f3 ?>
		<th><span id="elh_rekon_master_f3" class="rekon_master_f3"><?php echo $rekon_master->f3->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f4->Visible) { // f4 ?>
		<th><span id="elh_rekon_master_f4" class="rekon_master_f4"><?php echo $rekon_master->f4->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f5->Visible) { // f5 ?>
		<th><span id="elh_rekon_master_f5" class="rekon_master_f5"><?php echo $rekon_master->f5->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f6->Visible) { // f6 ?>
		<th><span id="elh_rekon_master_f6" class="rekon_master_f6"><?php echo $rekon_master->f6->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f7->Visible) { // f7 ?>
		<th><span id="elh_rekon_master_f7" class="rekon_master_f7"><?php echo $rekon_master->f7->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f8->Visible) { // f8 ?>
		<th><span id="elh_rekon_master_f8" class="rekon_master_f8"><?php echo $rekon_master->f8->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f9->Visible) { // f9 ?>
		<th><span id="elh_rekon_master_f9" class="rekon_master_f9"><?php echo $rekon_master->f9->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f10->Visible) { // f10 ?>
		<th><span id="elh_rekon_master_f10" class="rekon_master_f10"><?php echo $rekon_master->f10->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f11->Visible) { // f11 ?>
		<th><span id="elh_rekon_master_f11" class="rekon_master_f11"><?php echo $rekon_master->f11->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f12->Visible) { // f12 ?>
		<th><span id="elh_rekon_master_f12" class="rekon_master_f12"><?php echo $rekon_master->f12->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f13->Visible) { // f13 ?>
		<th><span id="elh_rekon_master_f13" class="rekon_master_f13"><?php echo $rekon_master->f13->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f14->Visible) { // f14 ?>
		<th><span id="elh_rekon_master_f14" class="rekon_master_f14"><?php echo $rekon_master->f14->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f15->Visible) { // f15 ?>
		<th><span id="elh_rekon_master_f15" class="rekon_master_f15"><?php echo $rekon_master->f15->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f16->Visible) { // f16 ?>
		<th><span id="elh_rekon_master_f16" class="rekon_master_f16"><?php echo $rekon_master->f16->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f17->Visible) { // f17 ?>
		<th><span id="elh_rekon_master_f17" class="rekon_master_f17"><?php echo $rekon_master->f17->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f18->Visible) { // f18 ?>
		<th><span id="elh_rekon_master_f18" class="rekon_master_f18"><?php echo $rekon_master->f18->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f19->Visible) { // f19 ?>
		<th><span id="elh_rekon_master_f19" class="rekon_master_f19"><?php echo $rekon_master->f19->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f20->Visible) { // f20 ?>
		<th><span id="elh_rekon_master_f20" class="rekon_master_f20"><?php echo $rekon_master->f20->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f21->Visible) { // f21 ?>
		<th><span id="elh_rekon_master_f21" class="rekon_master_f21"><?php echo $rekon_master->f21->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f22->Visible) { // f22 ?>
		<th><span id="elh_rekon_master_f22" class="rekon_master_f22"><?php echo $rekon_master->f22->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f23->Visible) { // f23 ?>
		<th><span id="elh_rekon_master_f23" class="rekon_master_f23"><?php echo $rekon_master->f23->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f24->Visible) { // f24 ?>
		<th><span id="elh_rekon_master_f24" class="rekon_master_f24"><?php echo $rekon_master->f24->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f25->Visible) { // f25 ?>
		<th><span id="elh_rekon_master_f25" class="rekon_master_f25"><?php echo $rekon_master->f25->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f26->Visible) { // f26 ?>
		<th><span id="elh_rekon_master_f26" class="rekon_master_f26"><?php echo $rekon_master->f26->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f27->Visible) { // f27 ?>
		<th><span id="elh_rekon_master_f27" class="rekon_master_f27"><?php echo $rekon_master->f27->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f28->Visible) { // f28 ?>
		<th><span id="elh_rekon_master_f28" class="rekon_master_f28"><?php echo $rekon_master->f28->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f29->Visible) { // f29 ?>
		<th><span id="elh_rekon_master_f29" class="rekon_master_f29"><?php echo $rekon_master->f29->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f30->Visible) { // f30 ?>
		<th><span id="elh_rekon_master_f30" class="rekon_master_f30"><?php echo $rekon_master->f30->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f31->Visible) { // f31 ?>
		<th><span id="elh_rekon_master_f31" class="rekon_master_f31"><?php echo $rekon_master->f31->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f32->Visible) { // f32 ?>
		<th><span id="elh_rekon_master_f32" class="rekon_master_f32"><?php echo $rekon_master->f32->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f33->Visible) { // f33 ?>
		<th><span id="elh_rekon_master_f33" class="rekon_master_f33"><?php echo $rekon_master->f33->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f34->Visible) { // f34 ?>
		<th><span id="elh_rekon_master_f34" class="rekon_master_f34"><?php echo $rekon_master->f34->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f35->Visible) { // f35 ?>
		<th><span id="elh_rekon_master_f35" class="rekon_master_f35"><?php echo $rekon_master->f35->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f36->Visible) { // f36 ?>
		<th><span id="elh_rekon_master_f36" class="rekon_master_f36"><?php echo $rekon_master->f36->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f37->Visible) { // f37 ?>
		<th><span id="elh_rekon_master_f37" class="rekon_master_f37"><?php echo $rekon_master->f37->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f38->Visible) { // f38 ?>
		<th><span id="elh_rekon_master_f38" class="rekon_master_f38"><?php echo $rekon_master->f38->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f39->Visible) { // f39 ?>
		<th><span id="elh_rekon_master_f39" class="rekon_master_f39"><?php echo $rekon_master->f39->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f40->Visible) { // f40 ?>
		<th><span id="elh_rekon_master_f40" class="rekon_master_f40"><?php echo $rekon_master->f40->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f41->Visible) { // f41 ?>
		<th><span id="elh_rekon_master_f41" class="rekon_master_f41"><?php echo $rekon_master->f41->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f42->Visible) { // f42 ?>
		<th><span id="elh_rekon_master_f42" class="rekon_master_f42"><?php echo $rekon_master->f42->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f43->Visible) { // f43 ?>
		<th><span id="elh_rekon_master_f43" class="rekon_master_f43"><?php echo $rekon_master->f43->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f44->Visible) { // f44 ?>
		<th><span id="elh_rekon_master_f44" class="rekon_master_f44"><?php echo $rekon_master->f44->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f45->Visible) { // f45 ?>
		<th><span id="elh_rekon_master_f45" class="rekon_master_f45"><?php echo $rekon_master->f45->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f46->Visible) { // f46 ?>
		<th><span id="elh_rekon_master_f46" class="rekon_master_f46"><?php echo $rekon_master->f46->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f47->Visible) { // f47 ?>
		<th><span id="elh_rekon_master_f47" class="rekon_master_f47"><?php echo $rekon_master->f47->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f48->Visible) { // f48 ?>
		<th><span id="elh_rekon_master_f48" class="rekon_master_f48"><?php echo $rekon_master->f48->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f49->Visible) { // f49 ?>
		<th><span id="elh_rekon_master_f49" class="rekon_master_f49"><?php echo $rekon_master->f49->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f50->Visible) { // f50 ?>
		<th><span id="elh_rekon_master_f50" class="rekon_master_f50"><?php echo $rekon_master->f50->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f51->Visible) { // f51 ?>
		<th><span id="elh_rekon_master_f51" class="rekon_master_f51"><?php echo $rekon_master->f51->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f52->Visible) { // f52 ?>
		<th><span id="elh_rekon_master_f52" class="rekon_master_f52"><?php echo $rekon_master->f52->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f53->Visible) { // f53 ?>
		<th><span id="elh_rekon_master_f53" class="rekon_master_f53"><?php echo $rekon_master->f53->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f54->Visible) { // f54 ?>
		<th><span id="elh_rekon_master_f54" class="rekon_master_f54"><?php echo $rekon_master->f54->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f55->Visible) { // f55 ?>
		<th><span id="elh_rekon_master_f55" class="rekon_master_f55"><?php echo $rekon_master->f55->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f56->Visible) { // f56 ?>
		<th><span id="elh_rekon_master_f56" class="rekon_master_f56"><?php echo $rekon_master->f56->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f57->Visible) { // f57 ?>
		<th><span id="elh_rekon_master_f57" class="rekon_master_f57"><?php echo $rekon_master->f57->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f58->Visible) { // f58 ?>
		<th><span id="elh_rekon_master_f58" class="rekon_master_f58"><?php echo $rekon_master->f58->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f59->Visible) { // f59 ?>
		<th><span id="elh_rekon_master_f59" class="rekon_master_f59"><?php echo $rekon_master->f59->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f60->Visible) { // f60 ?>
		<th><span id="elh_rekon_master_f60" class="rekon_master_f60"><?php echo $rekon_master->f60->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f61->Visible) { // f61 ?>
		<th><span id="elh_rekon_master_f61" class="rekon_master_f61"><?php echo $rekon_master->f61->FldCaption() ?></span></th>
<?php } ?>
<?php if ($rekon_master->f62->Visible) { // f62 ?>
		<th><span id="elh_rekon_master_f62" class="rekon_master_f62"><?php echo $rekon_master->f62->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$rekon_master_delete->RecCnt = 0;
$i = 0;
while (!$rekon_master_delete->Recordset->EOF) {
	$rekon_master_delete->RecCnt++;
	$rekon_master_delete->RowCnt++;

	// Set row properties
	$rekon_master->ResetAttrs();
	$rekon_master->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$rekon_master_delete->LoadRowValues($rekon_master_delete->Recordset);

	// Render row
	$rekon_master_delete->RenderRow();
?>
	<tr<?php echo $rekon_master->RowAttributes() ?>>
<?php if ($rekon_master->rm_id->Visible) { // rm_id ?>
		<td<?php echo $rekon_master->rm_id->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_rm_id" class="rekon_master_rm_id">
<span<?php echo $rekon_master->rm_id->ViewAttributes() ?>>
<?php echo $rekon_master->rm_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->pegawai_id->Visible) { // pegawai_id ?>
		<td<?php echo $rekon_master->pegawai_id->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_pegawai_id" class="rekon_master_pegawai_id">
<span<?php echo $rekon_master->pegawai_id->ViewAttributes() ?>>
<?php echo $rekon_master->pegawai_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f1->Visible) { // f1 ?>
		<td<?php echo $rekon_master->f1->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f1" class="rekon_master_f1">
<span<?php echo $rekon_master->f1->ViewAttributes() ?>>
<?php echo $rekon_master->f1->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f2->Visible) { // f2 ?>
		<td<?php echo $rekon_master->f2->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f2" class="rekon_master_f2">
<span<?php echo $rekon_master->f2->ViewAttributes() ?>>
<?php echo $rekon_master->f2->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f3->Visible) { // f3 ?>
		<td<?php echo $rekon_master->f3->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f3" class="rekon_master_f3">
<span<?php echo $rekon_master->f3->ViewAttributes() ?>>
<?php echo $rekon_master->f3->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f4->Visible) { // f4 ?>
		<td<?php echo $rekon_master->f4->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f4" class="rekon_master_f4">
<span<?php echo $rekon_master->f4->ViewAttributes() ?>>
<?php echo $rekon_master->f4->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f5->Visible) { // f5 ?>
		<td<?php echo $rekon_master->f5->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f5" class="rekon_master_f5">
<span<?php echo $rekon_master->f5->ViewAttributes() ?>>
<?php echo $rekon_master->f5->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f6->Visible) { // f6 ?>
		<td<?php echo $rekon_master->f6->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f6" class="rekon_master_f6">
<span<?php echo $rekon_master->f6->ViewAttributes() ?>>
<?php echo $rekon_master->f6->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f7->Visible) { // f7 ?>
		<td<?php echo $rekon_master->f7->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f7" class="rekon_master_f7">
<span<?php echo $rekon_master->f7->ViewAttributes() ?>>
<?php echo $rekon_master->f7->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f8->Visible) { // f8 ?>
		<td<?php echo $rekon_master->f8->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f8" class="rekon_master_f8">
<span<?php echo $rekon_master->f8->ViewAttributes() ?>>
<?php echo $rekon_master->f8->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f9->Visible) { // f9 ?>
		<td<?php echo $rekon_master->f9->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f9" class="rekon_master_f9">
<span<?php echo $rekon_master->f9->ViewAttributes() ?>>
<?php echo $rekon_master->f9->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f10->Visible) { // f10 ?>
		<td<?php echo $rekon_master->f10->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f10" class="rekon_master_f10">
<span<?php echo $rekon_master->f10->ViewAttributes() ?>>
<?php echo $rekon_master->f10->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f11->Visible) { // f11 ?>
		<td<?php echo $rekon_master->f11->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f11" class="rekon_master_f11">
<span<?php echo $rekon_master->f11->ViewAttributes() ?>>
<?php echo $rekon_master->f11->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f12->Visible) { // f12 ?>
		<td<?php echo $rekon_master->f12->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f12" class="rekon_master_f12">
<span<?php echo $rekon_master->f12->ViewAttributes() ?>>
<?php echo $rekon_master->f12->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f13->Visible) { // f13 ?>
		<td<?php echo $rekon_master->f13->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f13" class="rekon_master_f13">
<span<?php echo $rekon_master->f13->ViewAttributes() ?>>
<?php echo $rekon_master->f13->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f14->Visible) { // f14 ?>
		<td<?php echo $rekon_master->f14->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f14" class="rekon_master_f14">
<span<?php echo $rekon_master->f14->ViewAttributes() ?>>
<?php echo $rekon_master->f14->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f15->Visible) { // f15 ?>
		<td<?php echo $rekon_master->f15->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f15" class="rekon_master_f15">
<span<?php echo $rekon_master->f15->ViewAttributes() ?>>
<?php echo $rekon_master->f15->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f16->Visible) { // f16 ?>
		<td<?php echo $rekon_master->f16->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f16" class="rekon_master_f16">
<span<?php echo $rekon_master->f16->ViewAttributes() ?>>
<?php echo $rekon_master->f16->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f17->Visible) { // f17 ?>
		<td<?php echo $rekon_master->f17->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f17" class="rekon_master_f17">
<span<?php echo $rekon_master->f17->ViewAttributes() ?>>
<?php echo $rekon_master->f17->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f18->Visible) { // f18 ?>
		<td<?php echo $rekon_master->f18->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f18" class="rekon_master_f18">
<span<?php echo $rekon_master->f18->ViewAttributes() ?>>
<?php echo $rekon_master->f18->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f19->Visible) { // f19 ?>
		<td<?php echo $rekon_master->f19->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f19" class="rekon_master_f19">
<span<?php echo $rekon_master->f19->ViewAttributes() ?>>
<?php echo $rekon_master->f19->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f20->Visible) { // f20 ?>
		<td<?php echo $rekon_master->f20->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f20" class="rekon_master_f20">
<span<?php echo $rekon_master->f20->ViewAttributes() ?>>
<?php echo $rekon_master->f20->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f21->Visible) { // f21 ?>
		<td<?php echo $rekon_master->f21->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f21" class="rekon_master_f21">
<span<?php echo $rekon_master->f21->ViewAttributes() ?>>
<?php echo $rekon_master->f21->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f22->Visible) { // f22 ?>
		<td<?php echo $rekon_master->f22->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f22" class="rekon_master_f22">
<span<?php echo $rekon_master->f22->ViewAttributes() ?>>
<?php echo $rekon_master->f22->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f23->Visible) { // f23 ?>
		<td<?php echo $rekon_master->f23->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f23" class="rekon_master_f23">
<span<?php echo $rekon_master->f23->ViewAttributes() ?>>
<?php echo $rekon_master->f23->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f24->Visible) { // f24 ?>
		<td<?php echo $rekon_master->f24->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f24" class="rekon_master_f24">
<span<?php echo $rekon_master->f24->ViewAttributes() ?>>
<?php echo $rekon_master->f24->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f25->Visible) { // f25 ?>
		<td<?php echo $rekon_master->f25->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f25" class="rekon_master_f25">
<span<?php echo $rekon_master->f25->ViewAttributes() ?>>
<?php echo $rekon_master->f25->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f26->Visible) { // f26 ?>
		<td<?php echo $rekon_master->f26->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f26" class="rekon_master_f26">
<span<?php echo $rekon_master->f26->ViewAttributes() ?>>
<?php echo $rekon_master->f26->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f27->Visible) { // f27 ?>
		<td<?php echo $rekon_master->f27->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f27" class="rekon_master_f27">
<span<?php echo $rekon_master->f27->ViewAttributes() ?>>
<?php echo $rekon_master->f27->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f28->Visible) { // f28 ?>
		<td<?php echo $rekon_master->f28->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f28" class="rekon_master_f28">
<span<?php echo $rekon_master->f28->ViewAttributes() ?>>
<?php echo $rekon_master->f28->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f29->Visible) { // f29 ?>
		<td<?php echo $rekon_master->f29->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f29" class="rekon_master_f29">
<span<?php echo $rekon_master->f29->ViewAttributes() ?>>
<?php echo $rekon_master->f29->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f30->Visible) { // f30 ?>
		<td<?php echo $rekon_master->f30->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f30" class="rekon_master_f30">
<span<?php echo $rekon_master->f30->ViewAttributes() ?>>
<?php echo $rekon_master->f30->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f31->Visible) { // f31 ?>
		<td<?php echo $rekon_master->f31->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f31" class="rekon_master_f31">
<span<?php echo $rekon_master->f31->ViewAttributes() ?>>
<?php echo $rekon_master->f31->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f32->Visible) { // f32 ?>
		<td<?php echo $rekon_master->f32->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f32" class="rekon_master_f32">
<span<?php echo $rekon_master->f32->ViewAttributes() ?>>
<?php echo $rekon_master->f32->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f33->Visible) { // f33 ?>
		<td<?php echo $rekon_master->f33->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f33" class="rekon_master_f33">
<span<?php echo $rekon_master->f33->ViewAttributes() ?>>
<?php echo $rekon_master->f33->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f34->Visible) { // f34 ?>
		<td<?php echo $rekon_master->f34->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f34" class="rekon_master_f34">
<span<?php echo $rekon_master->f34->ViewAttributes() ?>>
<?php echo $rekon_master->f34->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f35->Visible) { // f35 ?>
		<td<?php echo $rekon_master->f35->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f35" class="rekon_master_f35">
<span<?php echo $rekon_master->f35->ViewAttributes() ?>>
<?php echo $rekon_master->f35->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f36->Visible) { // f36 ?>
		<td<?php echo $rekon_master->f36->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f36" class="rekon_master_f36">
<span<?php echo $rekon_master->f36->ViewAttributes() ?>>
<?php echo $rekon_master->f36->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f37->Visible) { // f37 ?>
		<td<?php echo $rekon_master->f37->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f37" class="rekon_master_f37">
<span<?php echo $rekon_master->f37->ViewAttributes() ?>>
<?php echo $rekon_master->f37->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f38->Visible) { // f38 ?>
		<td<?php echo $rekon_master->f38->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f38" class="rekon_master_f38">
<span<?php echo $rekon_master->f38->ViewAttributes() ?>>
<?php echo $rekon_master->f38->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f39->Visible) { // f39 ?>
		<td<?php echo $rekon_master->f39->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f39" class="rekon_master_f39">
<span<?php echo $rekon_master->f39->ViewAttributes() ?>>
<?php echo $rekon_master->f39->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f40->Visible) { // f40 ?>
		<td<?php echo $rekon_master->f40->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f40" class="rekon_master_f40">
<span<?php echo $rekon_master->f40->ViewAttributes() ?>>
<?php echo $rekon_master->f40->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f41->Visible) { // f41 ?>
		<td<?php echo $rekon_master->f41->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f41" class="rekon_master_f41">
<span<?php echo $rekon_master->f41->ViewAttributes() ?>>
<?php echo $rekon_master->f41->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f42->Visible) { // f42 ?>
		<td<?php echo $rekon_master->f42->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f42" class="rekon_master_f42">
<span<?php echo $rekon_master->f42->ViewAttributes() ?>>
<?php echo $rekon_master->f42->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f43->Visible) { // f43 ?>
		<td<?php echo $rekon_master->f43->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f43" class="rekon_master_f43">
<span<?php echo $rekon_master->f43->ViewAttributes() ?>>
<?php echo $rekon_master->f43->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f44->Visible) { // f44 ?>
		<td<?php echo $rekon_master->f44->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f44" class="rekon_master_f44">
<span<?php echo $rekon_master->f44->ViewAttributes() ?>>
<?php echo $rekon_master->f44->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f45->Visible) { // f45 ?>
		<td<?php echo $rekon_master->f45->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f45" class="rekon_master_f45">
<span<?php echo $rekon_master->f45->ViewAttributes() ?>>
<?php echo $rekon_master->f45->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f46->Visible) { // f46 ?>
		<td<?php echo $rekon_master->f46->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f46" class="rekon_master_f46">
<span<?php echo $rekon_master->f46->ViewAttributes() ?>>
<?php echo $rekon_master->f46->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f47->Visible) { // f47 ?>
		<td<?php echo $rekon_master->f47->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f47" class="rekon_master_f47">
<span<?php echo $rekon_master->f47->ViewAttributes() ?>>
<?php echo $rekon_master->f47->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f48->Visible) { // f48 ?>
		<td<?php echo $rekon_master->f48->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f48" class="rekon_master_f48">
<span<?php echo $rekon_master->f48->ViewAttributes() ?>>
<?php echo $rekon_master->f48->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f49->Visible) { // f49 ?>
		<td<?php echo $rekon_master->f49->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f49" class="rekon_master_f49">
<span<?php echo $rekon_master->f49->ViewAttributes() ?>>
<?php echo $rekon_master->f49->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f50->Visible) { // f50 ?>
		<td<?php echo $rekon_master->f50->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f50" class="rekon_master_f50">
<span<?php echo $rekon_master->f50->ViewAttributes() ?>>
<?php echo $rekon_master->f50->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f51->Visible) { // f51 ?>
		<td<?php echo $rekon_master->f51->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f51" class="rekon_master_f51">
<span<?php echo $rekon_master->f51->ViewAttributes() ?>>
<?php echo $rekon_master->f51->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f52->Visible) { // f52 ?>
		<td<?php echo $rekon_master->f52->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f52" class="rekon_master_f52">
<span<?php echo $rekon_master->f52->ViewAttributes() ?>>
<?php echo $rekon_master->f52->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f53->Visible) { // f53 ?>
		<td<?php echo $rekon_master->f53->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f53" class="rekon_master_f53">
<span<?php echo $rekon_master->f53->ViewAttributes() ?>>
<?php echo $rekon_master->f53->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f54->Visible) { // f54 ?>
		<td<?php echo $rekon_master->f54->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f54" class="rekon_master_f54">
<span<?php echo $rekon_master->f54->ViewAttributes() ?>>
<?php echo $rekon_master->f54->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f55->Visible) { // f55 ?>
		<td<?php echo $rekon_master->f55->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f55" class="rekon_master_f55">
<span<?php echo $rekon_master->f55->ViewAttributes() ?>>
<?php echo $rekon_master->f55->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f56->Visible) { // f56 ?>
		<td<?php echo $rekon_master->f56->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f56" class="rekon_master_f56">
<span<?php echo $rekon_master->f56->ViewAttributes() ?>>
<?php echo $rekon_master->f56->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f57->Visible) { // f57 ?>
		<td<?php echo $rekon_master->f57->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f57" class="rekon_master_f57">
<span<?php echo $rekon_master->f57->ViewAttributes() ?>>
<?php echo $rekon_master->f57->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f58->Visible) { // f58 ?>
		<td<?php echo $rekon_master->f58->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f58" class="rekon_master_f58">
<span<?php echo $rekon_master->f58->ViewAttributes() ?>>
<?php echo $rekon_master->f58->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f59->Visible) { // f59 ?>
		<td<?php echo $rekon_master->f59->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f59" class="rekon_master_f59">
<span<?php echo $rekon_master->f59->ViewAttributes() ?>>
<?php echo $rekon_master->f59->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f60->Visible) { // f60 ?>
		<td<?php echo $rekon_master->f60->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f60" class="rekon_master_f60">
<span<?php echo $rekon_master->f60->ViewAttributes() ?>>
<?php echo $rekon_master->f60->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f61->Visible) { // f61 ?>
		<td<?php echo $rekon_master->f61->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f61" class="rekon_master_f61">
<span<?php echo $rekon_master->f61->ViewAttributes() ?>>
<?php echo $rekon_master->f61->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($rekon_master->f62->Visible) { // f62 ?>
		<td<?php echo $rekon_master->f62->CellAttributes() ?>>
<span id="el<?php echo $rekon_master_delete->RowCnt ?>_rekon_master_f62" class="rekon_master_f62">
<span<?php echo $rekon_master->f62->ViewAttributes() ?>>
<?php echo $rekon_master->f62->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$rekon_master_delete->Recordset->MoveNext();
}
$rekon_master_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $rekon_master_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
frekon_masterdelete.Init();
</script>
<?php
$rekon_master_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$rekon_master_delete->Page_Terminate();
?>
