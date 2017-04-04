<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t_jd_krj_peginfo.php" ?>
<?php include_once "t_userinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t_jd_krj_peg_add = NULL; // Initialize page object first

class ct_jd_krj_peg_add extends ct_jd_krj_peg {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = "{4B5DAB39-E4BC-48DF-9311-E295A5F18030}";

	// Table name
	var $TableName = 't_jd_krj_peg';

	// Page object name
	var $PageObjName = 't_jd_krj_peg_add';

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

		// Table object (t_jd_krj_peg)
		if (!isset($GLOBALS["t_jd_krj_peg"]) || get_class($GLOBALS["t_jd_krj_peg"]) == "ct_jd_krj_peg") {
			$GLOBALS["t_jd_krj_peg"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t_jd_krj_peg"];
		}

		// Table object (t_user)
		if (!isset($GLOBALS['t_user'])) $GLOBALS['t_user'] = new ct_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't_jd_krj_peg', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("t_jd_krj_peglist.php"));
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
		$this->f20170101->SetVisibility();
		$this->f20170102->SetVisibility();
		$this->f20170103->SetVisibility();
		$this->f20170104->SetVisibility();
		$this->f20170105->SetVisibility();
		$this->f20170106->SetVisibility();
		$this->f20170107->SetVisibility();
		$this->f20170108->SetVisibility();
		$this->f20170109->SetVisibility();
		$this->f20170110->SetVisibility();
		$this->f20170111->SetVisibility();
		$this->f20170112->SetVisibility();
		$this->f20170113->SetVisibility();
		$this->f20170114->SetVisibility();
		$this->f20170115->SetVisibility();
		$this->f20170116->SetVisibility();
		$this->f20170117->SetVisibility();
		$this->f20170118->SetVisibility();
		$this->f20170119->SetVisibility();
		$this->f20170120->SetVisibility();
		$this->f20170121->SetVisibility();
		$this->f20170122->SetVisibility();
		$this->f20170123->SetVisibility();
		$this->f20170124->SetVisibility();
		$this->f20170125->SetVisibility();
		$this->f20170126->SetVisibility();
		$this->f20170127->SetVisibility();
		$this->f20170128->SetVisibility();
		$this->f20170129->SetVisibility();
		$this->f20170130->SetVisibility();
		$this->f20170131->SetVisibility();
		$this->f20170201->SetVisibility();
		$this->f20170202->SetVisibility();
		$this->f20170203->SetVisibility();
		$this->f20170204->SetVisibility();
		$this->f20170205->SetVisibility();
		$this->f20170206->SetVisibility();
		$this->f20170207->SetVisibility();
		$this->f20170208->SetVisibility();
		$this->f20170209->SetVisibility();
		$this->f20170210->SetVisibility();
		$this->f20170211->SetVisibility();
		$this->f20170212->SetVisibility();
		$this->f20170213->SetVisibility();
		$this->f20170214->SetVisibility();
		$this->f20170215->SetVisibility();
		$this->f20170216->SetVisibility();
		$this->f20170217->SetVisibility();
		$this->f20170218->SetVisibility();
		$this->f20170219->SetVisibility();
		$this->f20170220->SetVisibility();
		$this->f20170221->SetVisibility();
		$this->f20170222->SetVisibility();
		$this->f20170223->SetVisibility();
		$this->f20170224->SetVisibility();
		$this->f20170225->SetVisibility();
		$this->f20170226->SetVisibility();
		$this->f20170227->SetVisibility();
		$this->f20170228->SetVisibility();
		$this->f20170229->SetVisibility();
		$this->f20170301->SetVisibility();
		$this->f20170302->SetVisibility();
		$this->f20170303->SetVisibility();
		$this->f20170304->SetVisibility();
		$this->f20170305->SetVisibility();
		$this->f20170306->SetVisibility();
		$this->f20170307->SetVisibility();
		$this->f20170308->SetVisibility();
		$this->f20170309->SetVisibility();
		$this->f20170310->SetVisibility();
		$this->f20170311->SetVisibility();
		$this->f20170312->SetVisibility();
		$this->f20170313->SetVisibility();
		$this->f20170314->SetVisibility();
		$this->f20170315->SetVisibility();
		$this->f20170316->SetVisibility();
		$this->f20170317->SetVisibility();
		$this->f20170318->SetVisibility();
		$this->f20170319->SetVisibility();
		$this->f20170320->SetVisibility();
		$this->f20170321->SetVisibility();
		$this->f20170322->SetVisibility();
		$this->f20170323->SetVisibility();
		$this->f20170324->SetVisibility();
		$this->f20170325->SetVisibility();
		$this->f20170326->SetVisibility();
		$this->f20170327->SetVisibility();
		$this->f20170328->SetVisibility();
		$this->f20170329->SetVisibility();
		$this->f20170330->SetVisibility();
		$this->f20170331->SetVisibility();
		$this->f20170401->SetVisibility();
		$this->f20170402->SetVisibility();
		$this->f20170403->SetVisibility();
		$this->f20170404->SetVisibility();
		$this->f20170405->SetVisibility();
		$this->f20170406->SetVisibility();
		$this->f20170407->SetVisibility();
		$this->f20170408->SetVisibility();
		$this->f20170409->SetVisibility();
		$this->f20170410->SetVisibility();
		$this->f20170411->SetVisibility();
		$this->f20170412->SetVisibility();
		$this->f20170413->SetVisibility();
		$this->f20170414->SetVisibility();
		$this->f20170415->SetVisibility();
		$this->f20170416->SetVisibility();
		$this->f20170417->SetVisibility();
		$this->f20170418->SetVisibility();
		$this->f20170419->SetVisibility();
		$this->f20170420->SetVisibility();
		$this->f20170421->SetVisibility();
		$this->f20170422->SetVisibility();
		$this->f20170423->SetVisibility();
		$this->f20170424->SetVisibility();
		$this->f20170425->SetVisibility();
		$this->f20170426->SetVisibility();
		$this->f20170427->SetVisibility();
		$this->f20170428->SetVisibility();
		$this->f20170429->SetVisibility();
		$this->f20170430->SetVisibility();
		$this->f20170501->SetVisibility();
		$this->f20170502->SetVisibility();
		$this->f20170503->SetVisibility();
		$this->f20170504->SetVisibility();
		$this->f20170505->SetVisibility();
		$this->f20170506->SetVisibility();
		$this->f20170507->SetVisibility();
		$this->f20170508->SetVisibility();
		$this->f20170509->SetVisibility();
		$this->f20170510->SetVisibility();
		$this->f20170511->SetVisibility();
		$this->f20170512->SetVisibility();
		$this->f20170513->SetVisibility();
		$this->f20170514->SetVisibility();
		$this->f20170515->SetVisibility();
		$this->f20170516->SetVisibility();
		$this->f20170517->SetVisibility();
		$this->f20170518->SetVisibility();
		$this->f20170519->SetVisibility();
		$this->f20170520->SetVisibility();
		$this->f20170521->SetVisibility();
		$this->f20170522->SetVisibility();
		$this->f20170523->SetVisibility();
		$this->f20170524->SetVisibility();
		$this->f20170525->SetVisibility();
		$this->f20170526->SetVisibility();
		$this->f20170527->SetVisibility();
		$this->f20170528->SetVisibility();
		$this->f20170529->SetVisibility();
		$this->f20170530->SetVisibility();
		$this->f20170531->SetVisibility();
		$this->f20170601->SetVisibility();
		$this->f20170602->SetVisibility();
		$this->f20170603->SetVisibility();
		$this->f20170604->SetVisibility();
		$this->f20170605->SetVisibility();
		$this->f20170606->SetVisibility();
		$this->f20170607->SetVisibility();
		$this->f20170608->SetVisibility();
		$this->f20170609->SetVisibility();
		$this->f20170610->SetVisibility();
		$this->f20170611->SetVisibility();
		$this->f20170612->SetVisibility();
		$this->f20170613->SetVisibility();
		$this->f20170614->SetVisibility();
		$this->f20170615->SetVisibility();
		$this->f20170616->SetVisibility();
		$this->f20170617->SetVisibility();
		$this->f20170618->SetVisibility();
		$this->f20170619->SetVisibility();
		$this->f20170620->SetVisibility();
		$this->f20170621->SetVisibility();
		$this->f20170622->SetVisibility();
		$this->f20170623->SetVisibility();
		$this->f20170624->SetVisibility();
		$this->f20170625->SetVisibility();
		$this->f20170626->SetVisibility();
		$this->f20170627->SetVisibility();
		$this->f20170628->SetVisibility();
		$this->f20170629->SetVisibility();
		$this->f20170630->SetVisibility();
		$this->f20170701->SetVisibility();
		$this->f20170702->SetVisibility();
		$this->f20170703->SetVisibility();
		$this->f20170704->SetVisibility();
		$this->f20170705->SetVisibility();
		$this->f20170706->SetVisibility();
		$this->f20170707->SetVisibility();
		$this->f20170708->SetVisibility();
		$this->f20170709->SetVisibility();
		$this->f20170710->SetVisibility();
		$this->f20170711->SetVisibility();
		$this->f20170712->SetVisibility();
		$this->f20170713->SetVisibility();
		$this->f20170714->SetVisibility();
		$this->f20170715->SetVisibility();
		$this->f20170716->SetVisibility();
		$this->f20170717->SetVisibility();
		$this->f20170718->SetVisibility();
		$this->f20170719->SetVisibility();
		$this->f20170720->SetVisibility();
		$this->f20170721->SetVisibility();
		$this->f20170722->SetVisibility();
		$this->f20170723->SetVisibility();
		$this->f20170724->SetVisibility();
		$this->f20170725->SetVisibility();
		$this->f20170726->SetVisibility();
		$this->f20170727->SetVisibility();
		$this->f20170728->SetVisibility();
		$this->f20170729->SetVisibility();
		$this->f20170730->SetVisibility();
		$this->f20170731->SetVisibility();
		$this->f20170801->SetVisibility();
		$this->f20170802->SetVisibility();
		$this->f20170803->SetVisibility();
		$this->f20170804->SetVisibility();
		$this->f20170805->SetVisibility();
		$this->f20170806->SetVisibility();
		$this->f20170807->SetVisibility();
		$this->f20170808->SetVisibility();
		$this->f20170809->SetVisibility();
		$this->f20170810->SetVisibility();
		$this->f20170811->SetVisibility();
		$this->f20170812->SetVisibility();
		$this->f20170813->SetVisibility();
		$this->f20170814->SetVisibility();
		$this->f20170815->SetVisibility();
		$this->f20170816->SetVisibility();
		$this->f20170817->SetVisibility();
		$this->f20170818->SetVisibility();
		$this->f20170819->SetVisibility();
		$this->f20170820->SetVisibility();
		$this->f20170821->SetVisibility();
		$this->f20170822->SetVisibility();
		$this->f20170823->SetVisibility();
		$this->f20170824->SetVisibility();
		$this->f20170825->SetVisibility();
		$this->f20170826->SetVisibility();
		$this->f20170827->SetVisibility();
		$this->f20170828->SetVisibility();
		$this->f20170829->SetVisibility();
		$this->f20170830->SetVisibility();
		$this->f20170831->SetVisibility();
		$this->f20170901->SetVisibility();
		$this->f20170902->SetVisibility();
		$this->f20170903->SetVisibility();
		$this->f20170904->SetVisibility();
		$this->f20170905->SetVisibility();
		$this->f20170906->SetVisibility();
		$this->f20170907->SetVisibility();
		$this->f20170908->SetVisibility();
		$this->f20170909->SetVisibility();
		$this->f20170910->SetVisibility();
		$this->f20170911->SetVisibility();
		$this->f20170912->SetVisibility();
		$this->f20170913->SetVisibility();
		$this->f20170914->SetVisibility();
		$this->f20170915->SetVisibility();
		$this->f20170916->SetVisibility();
		$this->f20170917->SetVisibility();
		$this->f20170918->SetVisibility();
		$this->f20170919->SetVisibility();
		$this->f20170920->SetVisibility();
		$this->f20170921->SetVisibility();
		$this->f20170922->SetVisibility();
		$this->f20170923->SetVisibility();
		$this->f20170924->SetVisibility();
		$this->f20170925->SetVisibility();
		$this->f20170926->SetVisibility();
		$this->f20170927->SetVisibility();
		$this->f20170928->SetVisibility();
		$this->f20170929->SetVisibility();
		$this->f20170930->SetVisibility();
		$this->f20171001->SetVisibility();
		$this->f20171002->SetVisibility();
		$this->f20171003->SetVisibility();
		$this->f20171004->SetVisibility();
		$this->f20171005->SetVisibility();
		$this->f20171006->SetVisibility();
		$this->f20171007->SetVisibility();
		$this->f20171008->SetVisibility();
		$this->f20171009->SetVisibility();
		$this->f20171010->SetVisibility();
		$this->f20171011->SetVisibility();
		$this->f20171012->SetVisibility();
		$this->f20171013->SetVisibility();
		$this->f20171014->SetVisibility();
		$this->f20171015->SetVisibility();
		$this->f20171016->SetVisibility();
		$this->f20171017->SetVisibility();
		$this->f20171018->SetVisibility();
		$this->f20171019->SetVisibility();
		$this->f20171020->SetVisibility();
		$this->f20171021->SetVisibility();
		$this->f20171022->SetVisibility();
		$this->f20171023->SetVisibility();
		$this->f20171024->SetVisibility();
		$this->f20171025->SetVisibility();
		$this->f20171026->SetVisibility();
		$this->f20171027->SetVisibility();
		$this->f20171028->SetVisibility();
		$this->f20171029->SetVisibility();
		$this->f20171030->SetVisibility();
		$this->f20171031->SetVisibility();
		$this->f20171101->SetVisibility();
		$this->f20171102->SetVisibility();
		$this->f20171103->SetVisibility();
		$this->f20171104->SetVisibility();
		$this->f20171105->SetVisibility();
		$this->f20171106->SetVisibility();
		$this->f20171107->SetVisibility();
		$this->f20171108->SetVisibility();
		$this->f20171109->SetVisibility();
		$this->f20171110->SetVisibility();
		$this->f20171111->SetVisibility();
		$this->f20171112->SetVisibility();
		$this->f20171113->SetVisibility();
		$this->f20171114->SetVisibility();
		$this->f20171115->SetVisibility();
		$this->f20171116->SetVisibility();
		$this->f20171117->SetVisibility();
		$this->f20171118->SetVisibility();
		$this->f20171119->SetVisibility();
		$this->f20171120->SetVisibility();
		$this->f20171121->SetVisibility();
		$this->f20171122->SetVisibility();
		$this->f20171123->SetVisibility();
		$this->f20171124->SetVisibility();
		$this->f20171125->SetVisibility();
		$this->f20171126->SetVisibility();
		$this->f20171127->SetVisibility();
		$this->f20171128->SetVisibility();
		$this->f20171129->SetVisibility();
		$this->f20171130->SetVisibility();
		$this->f20171201->SetVisibility();
		$this->f20171202->SetVisibility();
		$this->f20171203->SetVisibility();
		$this->f20171204->SetVisibility();
		$this->f20171205->SetVisibility();
		$this->f20171206->SetVisibility();
		$this->f20171207->SetVisibility();
		$this->f20171208->SetVisibility();
		$this->f20171209->SetVisibility();
		$this->f20171210->SetVisibility();
		$this->f20171211->SetVisibility();
		$this->f20171212->SetVisibility();
		$this->f20171213->SetVisibility();
		$this->f20171214->SetVisibility();
		$this->f20171215->SetVisibility();
		$this->f20171216->SetVisibility();
		$this->f20171217->SetVisibility();
		$this->f20171218->SetVisibility();
		$this->f20171219->SetVisibility();
		$this->f20171220->SetVisibility();
		$this->f20171221->SetVisibility();
		$this->f20171222->SetVisibility();
		$this->f20171223->SetVisibility();
		$this->f20171224->SetVisibility();
		$this->f20171225->SetVisibility();
		$this->f20171226->SetVisibility();
		$this->f20171227->SetVisibility();
		$this->f20171228->SetVisibility();
		$this->f20171229->SetVisibility();
		$this->f20171230->SetVisibility();
		$this->f20171231->SetVisibility();

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
		global $EW_EXPORT, $t_jd_krj_peg;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t_jd_krj_peg);
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
			if (@$_GET["jdwkrjpeg_id"] != "") {
				$this->jdwkrjpeg_id->setQueryStringValue($_GET["jdwkrjpeg_id"]);
				$this->setKey("jdwkrjpeg_id", $this->jdwkrjpeg_id->CurrentValue); // Set up key
			} else {
				$this->setKey("jdwkrjpeg_id", ""); // Clear key
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
					$this->Page_Terminate("t_jd_krj_peglist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "t_jd_krj_peglist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to list page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "t_jd_krj_pegview.php")
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
		$this->f20170101->CurrentValue = NULL;
		$this->f20170101->OldValue = $this->f20170101->CurrentValue;
		$this->f20170102->CurrentValue = NULL;
		$this->f20170102->OldValue = $this->f20170102->CurrentValue;
		$this->f20170103->CurrentValue = NULL;
		$this->f20170103->OldValue = $this->f20170103->CurrentValue;
		$this->f20170104->CurrentValue = NULL;
		$this->f20170104->OldValue = $this->f20170104->CurrentValue;
		$this->f20170105->CurrentValue = NULL;
		$this->f20170105->OldValue = $this->f20170105->CurrentValue;
		$this->f20170106->CurrentValue = NULL;
		$this->f20170106->OldValue = $this->f20170106->CurrentValue;
		$this->f20170107->CurrentValue = NULL;
		$this->f20170107->OldValue = $this->f20170107->CurrentValue;
		$this->f20170108->CurrentValue = NULL;
		$this->f20170108->OldValue = $this->f20170108->CurrentValue;
		$this->f20170109->CurrentValue = NULL;
		$this->f20170109->OldValue = $this->f20170109->CurrentValue;
		$this->f20170110->CurrentValue = NULL;
		$this->f20170110->OldValue = $this->f20170110->CurrentValue;
		$this->f20170111->CurrentValue = NULL;
		$this->f20170111->OldValue = $this->f20170111->CurrentValue;
		$this->f20170112->CurrentValue = NULL;
		$this->f20170112->OldValue = $this->f20170112->CurrentValue;
		$this->f20170113->CurrentValue = NULL;
		$this->f20170113->OldValue = $this->f20170113->CurrentValue;
		$this->f20170114->CurrentValue = NULL;
		$this->f20170114->OldValue = $this->f20170114->CurrentValue;
		$this->f20170115->CurrentValue = NULL;
		$this->f20170115->OldValue = $this->f20170115->CurrentValue;
		$this->f20170116->CurrentValue = NULL;
		$this->f20170116->OldValue = $this->f20170116->CurrentValue;
		$this->f20170117->CurrentValue = NULL;
		$this->f20170117->OldValue = $this->f20170117->CurrentValue;
		$this->f20170118->CurrentValue = NULL;
		$this->f20170118->OldValue = $this->f20170118->CurrentValue;
		$this->f20170119->CurrentValue = NULL;
		$this->f20170119->OldValue = $this->f20170119->CurrentValue;
		$this->f20170120->CurrentValue = NULL;
		$this->f20170120->OldValue = $this->f20170120->CurrentValue;
		$this->f20170121->CurrentValue = NULL;
		$this->f20170121->OldValue = $this->f20170121->CurrentValue;
		$this->f20170122->CurrentValue = NULL;
		$this->f20170122->OldValue = $this->f20170122->CurrentValue;
		$this->f20170123->CurrentValue = NULL;
		$this->f20170123->OldValue = $this->f20170123->CurrentValue;
		$this->f20170124->CurrentValue = NULL;
		$this->f20170124->OldValue = $this->f20170124->CurrentValue;
		$this->f20170125->CurrentValue = NULL;
		$this->f20170125->OldValue = $this->f20170125->CurrentValue;
		$this->f20170126->CurrentValue = NULL;
		$this->f20170126->OldValue = $this->f20170126->CurrentValue;
		$this->f20170127->CurrentValue = NULL;
		$this->f20170127->OldValue = $this->f20170127->CurrentValue;
		$this->f20170128->CurrentValue = NULL;
		$this->f20170128->OldValue = $this->f20170128->CurrentValue;
		$this->f20170129->CurrentValue = NULL;
		$this->f20170129->OldValue = $this->f20170129->CurrentValue;
		$this->f20170130->CurrentValue = NULL;
		$this->f20170130->OldValue = $this->f20170130->CurrentValue;
		$this->f20170131->CurrentValue = NULL;
		$this->f20170131->OldValue = $this->f20170131->CurrentValue;
		$this->f20170201->CurrentValue = NULL;
		$this->f20170201->OldValue = $this->f20170201->CurrentValue;
		$this->f20170202->CurrentValue = NULL;
		$this->f20170202->OldValue = $this->f20170202->CurrentValue;
		$this->f20170203->CurrentValue = NULL;
		$this->f20170203->OldValue = $this->f20170203->CurrentValue;
		$this->f20170204->CurrentValue = NULL;
		$this->f20170204->OldValue = $this->f20170204->CurrentValue;
		$this->f20170205->CurrentValue = NULL;
		$this->f20170205->OldValue = $this->f20170205->CurrentValue;
		$this->f20170206->CurrentValue = NULL;
		$this->f20170206->OldValue = $this->f20170206->CurrentValue;
		$this->f20170207->CurrentValue = NULL;
		$this->f20170207->OldValue = $this->f20170207->CurrentValue;
		$this->f20170208->CurrentValue = NULL;
		$this->f20170208->OldValue = $this->f20170208->CurrentValue;
		$this->f20170209->CurrentValue = NULL;
		$this->f20170209->OldValue = $this->f20170209->CurrentValue;
		$this->f20170210->CurrentValue = NULL;
		$this->f20170210->OldValue = $this->f20170210->CurrentValue;
		$this->f20170211->CurrentValue = NULL;
		$this->f20170211->OldValue = $this->f20170211->CurrentValue;
		$this->f20170212->CurrentValue = NULL;
		$this->f20170212->OldValue = $this->f20170212->CurrentValue;
		$this->f20170213->CurrentValue = NULL;
		$this->f20170213->OldValue = $this->f20170213->CurrentValue;
		$this->f20170214->CurrentValue = NULL;
		$this->f20170214->OldValue = $this->f20170214->CurrentValue;
		$this->f20170215->CurrentValue = NULL;
		$this->f20170215->OldValue = $this->f20170215->CurrentValue;
		$this->f20170216->CurrentValue = NULL;
		$this->f20170216->OldValue = $this->f20170216->CurrentValue;
		$this->f20170217->CurrentValue = NULL;
		$this->f20170217->OldValue = $this->f20170217->CurrentValue;
		$this->f20170218->CurrentValue = NULL;
		$this->f20170218->OldValue = $this->f20170218->CurrentValue;
		$this->f20170219->CurrentValue = NULL;
		$this->f20170219->OldValue = $this->f20170219->CurrentValue;
		$this->f20170220->CurrentValue = NULL;
		$this->f20170220->OldValue = $this->f20170220->CurrentValue;
		$this->f20170221->CurrentValue = NULL;
		$this->f20170221->OldValue = $this->f20170221->CurrentValue;
		$this->f20170222->CurrentValue = NULL;
		$this->f20170222->OldValue = $this->f20170222->CurrentValue;
		$this->f20170223->CurrentValue = NULL;
		$this->f20170223->OldValue = $this->f20170223->CurrentValue;
		$this->f20170224->CurrentValue = NULL;
		$this->f20170224->OldValue = $this->f20170224->CurrentValue;
		$this->f20170225->CurrentValue = NULL;
		$this->f20170225->OldValue = $this->f20170225->CurrentValue;
		$this->f20170226->CurrentValue = NULL;
		$this->f20170226->OldValue = $this->f20170226->CurrentValue;
		$this->f20170227->CurrentValue = NULL;
		$this->f20170227->OldValue = $this->f20170227->CurrentValue;
		$this->f20170228->CurrentValue = NULL;
		$this->f20170228->OldValue = $this->f20170228->CurrentValue;
		$this->f20170229->CurrentValue = NULL;
		$this->f20170229->OldValue = $this->f20170229->CurrentValue;
		$this->f20170301->CurrentValue = NULL;
		$this->f20170301->OldValue = $this->f20170301->CurrentValue;
		$this->f20170302->CurrentValue = NULL;
		$this->f20170302->OldValue = $this->f20170302->CurrentValue;
		$this->f20170303->CurrentValue = NULL;
		$this->f20170303->OldValue = $this->f20170303->CurrentValue;
		$this->f20170304->CurrentValue = NULL;
		$this->f20170304->OldValue = $this->f20170304->CurrentValue;
		$this->f20170305->CurrentValue = NULL;
		$this->f20170305->OldValue = $this->f20170305->CurrentValue;
		$this->f20170306->CurrentValue = NULL;
		$this->f20170306->OldValue = $this->f20170306->CurrentValue;
		$this->f20170307->CurrentValue = NULL;
		$this->f20170307->OldValue = $this->f20170307->CurrentValue;
		$this->f20170308->CurrentValue = NULL;
		$this->f20170308->OldValue = $this->f20170308->CurrentValue;
		$this->f20170309->CurrentValue = NULL;
		$this->f20170309->OldValue = $this->f20170309->CurrentValue;
		$this->f20170310->CurrentValue = NULL;
		$this->f20170310->OldValue = $this->f20170310->CurrentValue;
		$this->f20170311->CurrentValue = NULL;
		$this->f20170311->OldValue = $this->f20170311->CurrentValue;
		$this->f20170312->CurrentValue = NULL;
		$this->f20170312->OldValue = $this->f20170312->CurrentValue;
		$this->f20170313->CurrentValue = NULL;
		$this->f20170313->OldValue = $this->f20170313->CurrentValue;
		$this->f20170314->CurrentValue = NULL;
		$this->f20170314->OldValue = $this->f20170314->CurrentValue;
		$this->f20170315->CurrentValue = NULL;
		$this->f20170315->OldValue = $this->f20170315->CurrentValue;
		$this->f20170316->CurrentValue = NULL;
		$this->f20170316->OldValue = $this->f20170316->CurrentValue;
		$this->f20170317->CurrentValue = NULL;
		$this->f20170317->OldValue = $this->f20170317->CurrentValue;
		$this->f20170318->CurrentValue = NULL;
		$this->f20170318->OldValue = $this->f20170318->CurrentValue;
		$this->f20170319->CurrentValue = NULL;
		$this->f20170319->OldValue = $this->f20170319->CurrentValue;
		$this->f20170320->CurrentValue = NULL;
		$this->f20170320->OldValue = $this->f20170320->CurrentValue;
		$this->f20170321->CurrentValue = NULL;
		$this->f20170321->OldValue = $this->f20170321->CurrentValue;
		$this->f20170322->CurrentValue = NULL;
		$this->f20170322->OldValue = $this->f20170322->CurrentValue;
		$this->f20170323->CurrentValue = NULL;
		$this->f20170323->OldValue = $this->f20170323->CurrentValue;
		$this->f20170324->CurrentValue = NULL;
		$this->f20170324->OldValue = $this->f20170324->CurrentValue;
		$this->f20170325->CurrentValue = NULL;
		$this->f20170325->OldValue = $this->f20170325->CurrentValue;
		$this->f20170326->CurrentValue = NULL;
		$this->f20170326->OldValue = $this->f20170326->CurrentValue;
		$this->f20170327->CurrentValue = NULL;
		$this->f20170327->OldValue = $this->f20170327->CurrentValue;
		$this->f20170328->CurrentValue = NULL;
		$this->f20170328->OldValue = $this->f20170328->CurrentValue;
		$this->f20170329->CurrentValue = NULL;
		$this->f20170329->OldValue = $this->f20170329->CurrentValue;
		$this->f20170330->CurrentValue = NULL;
		$this->f20170330->OldValue = $this->f20170330->CurrentValue;
		$this->f20170331->CurrentValue = NULL;
		$this->f20170331->OldValue = $this->f20170331->CurrentValue;
		$this->f20170401->CurrentValue = NULL;
		$this->f20170401->OldValue = $this->f20170401->CurrentValue;
		$this->f20170402->CurrentValue = NULL;
		$this->f20170402->OldValue = $this->f20170402->CurrentValue;
		$this->f20170403->CurrentValue = NULL;
		$this->f20170403->OldValue = $this->f20170403->CurrentValue;
		$this->f20170404->CurrentValue = NULL;
		$this->f20170404->OldValue = $this->f20170404->CurrentValue;
		$this->f20170405->CurrentValue = NULL;
		$this->f20170405->OldValue = $this->f20170405->CurrentValue;
		$this->f20170406->CurrentValue = NULL;
		$this->f20170406->OldValue = $this->f20170406->CurrentValue;
		$this->f20170407->CurrentValue = NULL;
		$this->f20170407->OldValue = $this->f20170407->CurrentValue;
		$this->f20170408->CurrentValue = NULL;
		$this->f20170408->OldValue = $this->f20170408->CurrentValue;
		$this->f20170409->CurrentValue = NULL;
		$this->f20170409->OldValue = $this->f20170409->CurrentValue;
		$this->f20170410->CurrentValue = NULL;
		$this->f20170410->OldValue = $this->f20170410->CurrentValue;
		$this->f20170411->CurrentValue = NULL;
		$this->f20170411->OldValue = $this->f20170411->CurrentValue;
		$this->f20170412->CurrentValue = NULL;
		$this->f20170412->OldValue = $this->f20170412->CurrentValue;
		$this->f20170413->CurrentValue = NULL;
		$this->f20170413->OldValue = $this->f20170413->CurrentValue;
		$this->f20170414->CurrentValue = NULL;
		$this->f20170414->OldValue = $this->f20170414->CurrentValue;
		$this->f20170415->CurrentValue = NULL;
		$this->f20170415->OldValue = $this->f20170415->CurrentValue;
		$this->f20170416->CurrentValue = NULL;
		$this->f20170416->OldValue = $this->f20170416->CurrentValue;
		$this->f20170417->CurrentValue = NULL;
		$this->f20170417->OldValue = $this->f20170417->CurrentValue;
		$this->f20170418->CurrentValue = NULL;
		$this->f20170418->OldValue = $this->f20170418->CurrentValue;
		$this->f20170419->CurrentValue = NULL;
		$this->f20170419->OldValue = $this->f20170419->CurrentValue;
		$this->f20170420->CurrentValue = NULL;
		$this->f20170420->OldValue = $this->f20170420->CurrentValue;
		$this->f20170421->CurrentValue = NULL;
		$this->f20170421->OldValue = $this->f20170421->CurrentValue;
		$this->f20170422->CurrentValue = NULL;
		$this->f20170422->OldValue = $this->f20170422->CurrentValue;
		$this->f20170423->CurrentValue = NULL;
		$this->f20170423->OldValue = $this->f20170423->CurrentValue;
		$this->f20170424->CurrentValue = NULL;
		$this->f20170424->OldValue = $this->f20170424->CurrentValue;
		$this->f20170425->CurrentValue = NULL;
		$this->f20170425->OldValue = $this->f20170425->CurrentValue;
		$this->f20170426->CurrentValue = NULL;
		$this->f20170426->OldValue = $this->f20170426->CurrentValue;
		$this->f20170427->CurrentValue = NULL;
		$this->f20170427->OldValue = $this->f20170427->CurrentValue;
		$this->f20170428->CurrentValue = NULL;
		$this->f20170428->OldValue = $this->f20170428->CurrentValue;
		$this->f20170429->CurrentValue = NULL;
		$this->f20170429->OldValue = $this->f20170429->CurrentValue;
		$this->f20170430->CurrentValue = NULL;
		$this->f20170430->OldValue = $this->f20170430->CurrentValue;
		$this->f20170501->CurrentValue = NULL;
		$this->f20170501->OldValue = $this->f20170501->CurrentValue;
		$this->f20170502->CurrentValue = NULL;
		$this->f20170502->OldValue = $this->f20170502->CurrentValue;
		$this->f20170503->CurrentValue = NULL;
		$this->f20170503->OldValue = $this->f20170503->CurrentValue;
		$this->f20170504->CurrentValue = NULL;
		$this->f20170504->OldValue = $this->f20170504->CurrentValue;
		$this->f20170505->CurrentValue = NULL;
		$this->f20170505->OldValue = $this->f20170505->CurrentValue;
		$this->f20170506->CurrentValue = NULL;
		$this->f20170506->OldValue = $this->f20170506->CurrentValue;
		$this->f20170507->CurrentValue = NULL;
		$this->f20170507->OldValue = $this->f20170507->CurrentValue;
		$this->f20170508->CurrentValue = NULL;
		$this->f20170508->OldValue = $this->f20170508->CurrentValue;
		$this->f20170509->CurrentValue = NULL;
		$this->f20170509->OldValue = $this->f20170509->CurrentValue;
		$this->f20170510->CurrentValue = NULL;
		$this->f20170510->OldValue = $this->f20170510->CurrentValue;
		$this->f20170511->CurrentValue = NULL;
		$this->f20170511->OldValue = $this->f20170511->CurrentValue;
		$this->f20170512->CurrentValue = NULL;
		$this->f20170512->OldValue = $this->f20170512->CurrentValue;
		$this->f20170513->CurrentValue = NULL;
		$this->f20170513->OldValue = $this->f20170513->CurrentValue;
		$this->f20170514->CurrentValue = NULL;
		$this->f20170514->OldValue = $this->f20170514->CurrentValue;
		$this->f20170515->CurrentValue = NULL;
		$this->f20170515->OldValue = $this->f20170515->CurrentValue;
		$this->f20170516->CurrentValue = NULL;
		$this->f20170516->OldValue = $this->f20170516->CurrentValue;
		$this->f20170517->CurrentValue = NULL;
		$this->f20170517->OldValue = $this->f20170517->CurrentValue;
		$this->f20170518->CurrentValue = NULL;
		$this->f20170518->OldValue = $this->f20170518->CurrentValue;
		$this->f20170519->CurrentValue = NULL;
		$this->f20170519->OldValue = $this->f20170519->CurrentValue;
		$this->f20170520->CurrentValue = NULL;
		$this->f20170520->OldValue = $this->f20170520->CurrentValue;
		$this->f20170521->CurrentValue = NULL;
		$this->f20170521->OldValue = $this->f20170521->CurrentValue;
		$this->f20170522->CurrentValue = NULL;
		$this->f20170522->OldValue = $this->f20170522->CurrentValue;
		$this->f20170523->CurrentValue = NULL;
		$this->f20170523->OldValue = $this->f20170523->CurrentValue;
		$this->f20170524->CurrentValue = NULL;
		$this->f20170524->OldValue = $this->f20170524->CurrentValue;
		$this->f20170525->CurrentValue = NULL;
		$this->f20170525->OldValue = $this->f20170525->CurrentValue;
		$this->f20170526->CurrentValue = NULL;
		$this->f20170526->OldValue = $this->f20170526->CurrentValue;
		$this->f20170527->CurrentValue = NULL;
		$this->f20170527->OldValue = $this->f20170527->CurrentValue;
		$this->f20170528->CurrentValue = NULL;
		$this->f20170528->OldValue = $this->f20170528->CurrentValue;
		$this->f20170529->CurrentValue = NULL;
		$this->f20170529->OldValue = $this->f20170529->CurrentValue;
		$this->f20170530->CurrentValue = NULL;
		$this->f20170530->OldValue = $this->f20170530->CurrentValue;
		$this->f20170531->CurrentValue = NULL;
		$this->f20170531->OldValue = $this->f20170531->CurrentValue;
		$this->f20170601->CurrentValue = NULL;
		$this->f20170601->OldValue = $this->f20170601->CurrentValue;
		$this->f20170602->CurrentValue = NULL;
		$this->f20170602->OldValue = $this->f20170602->CurrentValue;
		$this->f20170603->CurrentValue = NULL;
		$this->f20170603->OldValue = $this->f20170603->CurrentValue;
		$this->f20170604->CurrentValue = NULL;
		$this->f20170604->OldValue = $this->f20170604->CurrentValue;
		$this->f20170605->CurrentValue = NULL;
		$this->f20170605->OldValue = $this->f20170605->CurrentValue;
		$this->f20170606->CurrentValue = NULL;
		$this->f20170606->OldValue = $this->f20170606->CurrentValue;
		$this->f20170607->CurrentValue = NULL;
		$this->f20170607->OldValue = $this->f20170607->CurrentValue;
		$this->f20170608->CurrentValue = NULL;
		$this->f20170608->OldValue = $this->f20170608->CurrentValue;
		$this->f20170609->CurrentValue = NULL;
		$this->f20170609->OldValue = $this->f20170609->CurrentValue;
		$this->f20170610->CurrentValue = NULL;
		$this->f20170610->OldValue = $this->f20170610->CurrentValue;
		$this->f20170611->CurrentValue = NULL;
		$this->f20170611->OldValue = $this->f20170611->CurrentValue;
		$this->f20170612->CurrentValue = NULL;
		$this->f20170612->OldValue = $this->f20170612->CurrentValue;
		$this->f20170613->CurrentValue = NULL;
		$this->f20170613->OldValue = $this->f20170613->CurrentValue;
		$this->f20170614->CurrentValue = NULL;
		$this->f20170614->OldValue = $this->f20170614->CurrentValue;
		$this->f20170615->CurrentValue = NULL;
		$this->f20170615->OldValue = $this->f20170615->CurrentValue;
		$this->f20170616->CurrentValue = NULL;
		$this->f20170616->OldValue = $this->f20170616->CurrentValue;
		$this->f20170617->CurrentValue = NULL;
		$this->f20170617->OldValue = $this->f20170617->CurrentValue;
		$this->f20170618->CurrentValue = NULL;
		$this->f20170618->OldValue = $this->f20170618->CurrentValue;
		$this->f20170619->CurrentValue = NULL;
		$this->f20170619->OldValue = $this->f20170619->CurrentValue;
		$this->f20170620->CurrentValue = NULL;
		$this->f20170620->OldValue = $this->f20170620->CurrentValue;
		$this->f20170621->CurrentValue = NULL;
		$this->f20170621->OldValue = $this->f20170621->CurrentValue;
		$this->f20170622->CurrentValue = NULL;
		$this->f20170622->OldValue = $this->f20170622->CurrentValue;
		$this->f20170623->CurrentValue = NULL;
		$this->f20170623->OldValue = $this->f20170623->CurrentValue;
		$this->f20170624->CurrentValue = NULL;
		$this->f20170624->OldValue = $this->f20170624->CurrentValue;
		$this->f20170625->CurrentValue = NULL;
		$this->f20170625->OldValue = $this->f20170625->CurrentValue;
		$this->f20170626->CurrentValue = NULL;
		$this->f20170626->OldValue = $this->f20170626->CurrentValue;
		$this->f20170627->CurrentValue = NULL;
		$this->f20170627->OldValue = $this->f20170627->CurrentValue;
		$this->f20170628->CurrentValue = NULL;
		$this->f20170628->OldValue = $this->f20170628->CurrentValue;
		$this->f20170629->CurrentValue = NULL;
		$this->f20170629->OldValue = $this->f20170629->CurrentValue;
		$this->f20170630->CurrentValue = NULL;
		$this->f20170630->OldValue = $this->f20170630->CurrentValue;
		$this->f20170701->CurrentValue = NULL;
		$this->f20170701->OldValue = $this->f20170701->CurrentValue;
		$this->f20170702->CurrentValue = NULL;
		$this->f20170702->OldValue = $this->f20170702->CurrentValue;
		$this->f20170703->CurrentValue = NULL;
		$this->f20170703->OldValue = $this->f20170703->CurrentValue;
		$this->f20170704->CurrentValue = NULL;
		$this->f20170704->OldValue = $this->f20170704->CurrentValue;
		$this->f20170705->CurrentValue = NULL;
		$this->f20170705->OldValue = $this->f20170705->CurrentValue;
		$this->f20170706->CurrentValue = NULL;
		$this->f20170706->OldValue = $this->f20170706->CurrentValue;
		$this->f20170707->CurrentValue = NULL;
		$this->f20170707->OldValue = $this->f20170707->CurrentValue;
		$this->f20170708->CurrentValue = NULL;
		$this->f20170708->OldValue = $this->f20170708->CurrentValue;
		$this->f20170709->CurrentValue = NULL;
		$this->f20170709->OldValue = $this->f20170709->CurrentValue;
		$this->f20170710->CurrentValue = NULL;
		$this->f20170710->OldValue = $this->f20170710->CurrentValue;
		$this->f20170711->CurrentValue = NULL;
		$this->f20170711->OldValue = $this->f20170711->CurrentValue;
		$this->f20170712->CurrentValue = NULL;
		$this->f20170712->OldValue = $this->f20170712->CurrentValue;
		$this->f20170713->CurrentValue = NULL;
		$this->f20170713->OldValue = $this->f20170713->CurrentValue;
		$this->f20170714->CurrentValue = NULL;
		$this->f20170714->OldValue = $this->f20170714->CurrentValue;
		$this->f20170715->CurrentValue = NULL;
		$this->f20170715->OldValue = $this->f20170715->CurrentValue;
		$this->f20170716->CurrentValue = NULL;
		$this->f20170716->OldValue = $this->f20170716->CurrentValue;
		$this->f20170717->CurrentValue = NULL;
		$this->f20170717->OldValue = $this->f20170717->CurrentValue;
		$this->f20170718->CurrentValue = NULL;
		$this->f20170718->OldValue = $this->f20170718->CurrentValue;
		$this->f20170719->CurrentValue = NULL;
		$this->f20170719->OldValue = $this->f20170719->CurrentValue;
		$this->f20170720->CurrentValue = NULL;
		$this->f20170720->OldValue = $this->f20170720->CurrentValue;
		$this->f20170721->CurrentValue = NULL;
		$this->f20170721->OldValue = $this->f20170721->CurrentValue;
		$this->f20170722->CurrentValue = NULL;
		$this->f20170722->OldValue = $this->f20170722->CurrentValue;
		$this->f20170723->CurrentValue = NULL;
		$this->f20170723->OldValue = $this->f20170723->CurrentValue;
		$this->f20170724->CurrentValue = NULL;
		$this->f20170724->OldValue = $this->f20170724->CurrentValue;
		$this->f20170725->CurrentValue = NULL;
		$this->f20170725->OldValue = $this->f20170725->CurrentValue;
		$this->f20170726->CurrentValue = NULL;
		$this->f20170726->OldValue = $this->f20170726->CurrentValue;
		$this->f20170727->CurrentValue = NULL;
		$this->f20170727->OldValue = $this->f20170727->CurrentValue;
		$this->f20170728->CurrentValue = NULL;
		$this->f20170728->OldValue = $this->f20170728->CurrentValue;
		$this->f20170729->CurrentValue = NULL;
		$this->f20170729->OldValue = $this->f20170729->CurrentValue;
		$this->f20170730->CurrentValue = NULL;
		$this->f20170730->OldValue = $this->f20170730->CurrentValue;
		$this->f20170731->CurrentValue = NULL;
		$this->f20170731->OldValue = $this->f20170731->CurrentValue;
		$this->f20170801->CurrentValue = NULL;
		$this->f20170801->OldValue = $this->f20170801->CurrentValue;
		$this->f20170802->CurrentValue = NULL;
		$this->f20170802->OldValue = $this->f20170802->CurrentValue;
		$this->f20170803->CurrentValue = NULL;
		$this->f20170803->OldValue = $this->f20170803->CurrentValue;
		$this->f20170804->CurrentValue = NULL;
		$this->f20170804->OldValue = $this->f20170804->CurrentValue;
		$this->f20170805->CurrentValue = NULL;
		$this->f20170805->OldValue = $this->f20170805->CurrentValue;
		$this->f20170806->CurrentValue = NULL;
		$this->f20170806->OldValue = $this->f20170806->CurrentValue;
		$this->f20170807->CurrentValue = NULL;
		$this->f20170807->OldValue = $this->f20170807->CurrentValue;
		$this->f20170808->CurrentValue = NULL;
		$this->f20170808->OldValue = $this->f20170808->CurrentValue;
		$this->f20170809->CurrentValue = NULL;
		$this->f20170809->OldValue = $this->f20170809->CurrentValue;
		$this->f20170810->CurrentValue = NULL;
		$this->f20170810->OldValue = $this->f20170810->CurrentValue;
		$this->f20170811->CurrentValue = NULL;
		$this->f20170811->OldValue = $this->f20170811->CurrentValue;
		$this->f20170812->CurrentValue = NULL;
		$this->f20170812->OldValue = $this->f20170812->CurrentValue;
		$this->f20170813->CurrentValue = NULL;
		$this->f20170813->OldValue = $this->f20170813->CurrentValue;
		$this->f20170814->CurrentValue = NULL;
		$this->f20170814->OldValue = $this->f20170814->CurrentValue;
		$this->f20170815->CurrentValue = NULL;
		$this->f20170815->OldValue = $this->f20170815->CurrentValue;
		$this->f20170816->CurrentValue = NULL;
		$this->f20170816->OldValue = $this->f20170816->CurrentValue;
		$this->f20170817->CurrentValue = NULL;
		$this->f20170817->OldValue = $this->f20170817->CurrentValue;
		$this->f20170818->CurrentValue = NULL;
		$this->f20170818->OldValue = $this->f20170818->CurrentValue;
		$this->f20170819->CurrentValue = NULL;
		$this->f20170819->OldValue = $this->f20170819->CurrentValue;
		$this->f20170820->CurrentValue = NULL;
		$this->f20170820->OldValue = $this->f20170820->CurrentValue;
		$this->f20170821->CurrentValue = NULL;
		$this->f20170821->OldValue = $this->f20170821->CurrentValue;
		$this->f20170822->CurrentValue = NULL;
		$this->f20170822->OldValue = $this->f20170822->CurrentValue;
		$this->f20170823->CurrentValue = NULL;
		$this->f20170823->OldValue = $this->f20170823->CurrentValue;
		$this->f20170824->CurrentValue = NULL;
		$this->f20170824->OldValue = $this->f20170824->CurrentValue;
		$this->f20170825->CurrentValue = NULL;
		$this->f20170825->OldValue = $this->f20170825->CurrentValue;
		$this->f20170826->CurrentValue = NULL;
		$this->f20170826->OldValue = $this->f20170826->CurrentValue;
		$this->f20170827->CurrentValue = NULL;
		$this->f20170827->OldValue = $this->f20170827->CurrentValue;
		$this->f20170828->CurrentValue = NULL;
		$this->f20170828->OldValue = $this->f20170828->CurrentValue;
		$this->f20170829->CurrentValue = NULL;
		$this->f20170829->OldValue = $this->f20170829->CurrentValue;
		$this->f20170830->CurrentValue = NULL;
		$this->f20170830->OldValue = $this->f20170830->CurrentValue;
		$this->f20170831->CurrentValue = NULL;
		$this->f20170831->OldValue = $this->f20170831->CurrentValue;
		$this->f20170901->CurrentValue = NULL;
		$this->f20170901->OldValue = $this->f20170901->CurrentValue;
		$this->f20170902->CurrentValue = NULL;
		$this->f20170902->OldValue = $this->f20170902->CurrentValue;
		$this->f20170903->CurrentValue = NULL;
		$this->f20170903->OldValue = $this->f20170903->CurrentValue;
		$this->f20170904->CurrentValue = NULL;
		$this->f20170904->OldValue = $this->f20170904->CurrentValue;
		$this->f20170905->CurrentValue = NULL;
		$this->f20170905->OldValue = $this->f20170905->CurrentValue;
		$this->f20170906->CurrentValue = NULL;
		$this->f20170906->OldValue = $this->f20170906->CurrentValue;
		$this->f20170907->CurrentValue = NULL;
		$this->f20170907->OldValue = $this->f20170907->CurrentValue;
		$this->f20170908->CurrentValue = NULL;
		$this->f20170908->OldValue = $this->f20170908->CurrentValue;
		$this->f20170909->CurrentValue = NULL;
		$this->f20170909->OldValue = $this->f20170909->CurrentValue;
		$this->f20170910->CurrentValue = NULL;
		$this->f20170910->OldValue = $this->f20170910->CurrentValue;
		$this->f20170911->CurrentValue = NULL;
		$this->f20170911->OldValue = $this->f20170911->CurrentValue;
		$this->f20170912->CurrentValue = NULL;
		$this->f20170912->OldValue = $this->f20170912->CurrentValue;
		$this->f20170913->CurrentValue = NULL;
		$this->f20170913->OldValue = $this->f20170913->CurrentValue;
		$this->f20170914->CurrentValue = NULL;
		$this->f20170914->OldValue = $this->f20170914->CurrentValue;
		$this->f20170915->CurrentValue = NULL;
		$this->f20170915->OldValue = $this->f20170915->CurrentValue;
		$this->f20170916->CurrentValue = NULL;
		$this->f20170916->OldValue = $this->f20170916->CurrentValue;
		$this->f20170917->CurrentValue = NULL;
		$this->f20170917->OldValue = $this->f20170917->CurrentValue;
		$this->f20170918->CurrentValue = NULL;
		$this->f20170918->OldValue = $this->f20170918->CurrentValue;
		$this->f20170919->CurrentValue = NULL;
		$this->f20170919->OldValue = $this->f20170919->CurrentValue;
		$this->f20170920->CurrentValue = NULL;
		$this->f20170920->OldValue = $this->f20170920->CurrentValue;
		$this->f20170921->CurrentValue = NULL;
		$this->f20170921->OldValue = $this->f20170921->CurrentValue;
		$this->f20170922->CurrentValue = NULL;
		$this->f20170922->OldValue = $this->f20170922->CurrentValue;
		$this->f20170923->CurrentValue = NULL;
		$this->f20170923->OldValue = $this->f20170923->CurrentValue;
		$this->f20170924->CurrentValue = NULL;
		$this->f20170924->OldValue = $this->f20170924->CurrentValue;
		$this->f20170925->CurrentValue = NULL;
		$this->f20170925->OldValue = $this->f20170925->CurrentValue;
		$this->f20170926->CurrentValue = NULL;
		$this->f20170926->OldValue = $this->f20170926->CurrentValue;
		$this->f20170927->CurrentValue = NULL;
		$this->f20170927->OldValue = $this->f20170927->CurrentValue;
		$this->f20170928->CurrentValue = NULL;
		$this->f20170928->OldValue = $this->f20170928->CurrentValue;
		$this->f20170929->CurrentValue = NULL;
		$this->f20170929->OldValue = $this->f20170929->CurrentValue;
		$this->f20170930->CurrentValue = NULL;
		$this->f20170930->OldValue = $this->f20170930->CurrentValue;
		$this->f20171001->CurrentValue = NULL;
		$this->f20171001->OldValue = $this->f20171001->CurrentValue;
		$this->f20171002->CurrentValue = NULL;
		$this->f20171002->OldValue = $this->f20171002->CurrentValue;
		$this->f20171003->CurrentValue = NULL;
		$this->f20171003->OldValue = $this->f20171003->CurrentValue;
		$this->f20171004->CurrentValue = NULL;
		$this->f20171004->OldValue = $this->f20171004->CurrentValue;
		$this->f20171005->CurrentValue = NULL;
		$this->f20171005->OldValue = $this->f20171005->CurrentValue;
		$this->f20171006->CurrentValue = NULL;
		$this->f20171006->OldValue = $this->f20171006->CurrentValue;
		$this->f20171007->CurrentValue = NULL;
		$this->f20171007->OldValue = $this->f20171007->CurrentValue;
		$this->f20171008->CurrentValue = NULL;
		$this->f20171008->OldValue = $this->f20171008->CurrentValue;
		$this->f20171009->CurrentValue = NULL;
		$this->f20171009->OldValue = $this->f20171009->CurrentValue;
		$this->f20171010->CurrentValue = NULL;
		$this->f20171010->OldValue = $this->f20171010->CurrentValue;
		$this->f20171011->CurrentValue = NULL;
		$this->f20171011->OldValue = $this->f20171011->CurrentValue;
		$this->f20171012->CurrentValue = NULL;
		$this->f20171012->OldValue = $this->f20171012->CurrentValue;
		$this->f20171013->CurrentValue = NULL;
		$this->f20171013->OldValue = $this->f20171013->CurrentValue;
		$this->f20171014->CurrentValue = NULL;
		$this->f20171014->OldValue = $this->f20171014->CurrentValue;
		$this->f20171015->CurrentValue = NULL;
		$this->f20171015->OldValue = $this->f20171015->CurrentValue;
		$this->f20171016->CurrentValue = NULL;
		$this->f20171016->OldValue = $this->f20171016->CurrentValue;
		$this->f20171017->CurrentValue = NULL;
		$this->f20171017->OldValue = $this->f20171017->CurrentValue;
		$this->f20171018->CurrentValue = NULL;
		$this->f20171018->OldValue = $this->f20171018->CurrentValue;
		$this->f20171019->CurrentValue = NULL;
		$this->f20171019->OldValue = $this->f20171019->CurrentValue;
		$this->f20171020->CurrentValue = NULL;
		$this->f20171020->OldValue = $this->f20171020->CurrentValue;
		$this->f20171021->CurrentValue = NULL;
		$this->f20171021->OldValue = $this->f20171021->CurrentValue;
		$this->f20171022->CurrentValue = NULL;
		$this->f20171022->OldValue = $this->f20171022->CurrentValue;
		$this->f20171023->CurrentValue = NULL;
		$this->f20171023->OldValue = $this->f20171023->CurrentValue;
		$this->f20171024->CurrentValue = NULL;
		$this->f20171024->OldValue = $this->f20171024->CurrentValue;
		$this->f20171025->CurrentValue = NULL;
		$this->f20171025->OldValue = $this->f20171025->CurrentValue;
		$this->f20171026->CurrentValue = NULL;
		$this->f20171026->OldValue = $this->f20171026->CurrentValue;
		$this->f20171027->CurrentValue = NULL;
		$this->f20171027->OldValue = $this->f20171027->CurrentValue;
		$this->f20171028->CurrentValue = NULL;
		$this->f20171028->OldValue = $this->f20171028->CurrentValue;
		$this->f20171029->CurrentValue = NULL;
		$this->f20171029->OldValue = $this->f20171029->CurrentValue;
		$this->f20171030->CurrentValue = NULL;
		$this->f20171030->OldValue = $this->f20171030->CurrentValue;
		$this->f20171031->CurrentValue = NULL;
		$this->f20171031->OldValue = $this->f20171031->CurrentValue;
		$this->f20171101->CurrentValue = NULL;
		$this->f20171101->OldValue = $this->f20171101->CurrentValue;
		$this->f20171102->CurrentValue = NULL;
		$this->f20171102->OldValue = $this->f20171102->CurrentValue;
		$this->f20171103->CurrentValue = NULL;
		$this->f20171103->OldValue = $this->f20171103->CurrentValue;
		$this->f20171104->CurrentValue = NULL;
		$this->f20171104->OldValue = $this->f20171104->CurrentValue;
		$this->f20171105->CurrentValue = NULL;
		$this->f20171105->OldValue = $this->f20171105->CurrentValue;
		$this->f20171106->CurrentValue = NULL;
		$this->f20171106->OldValue = $this->f20171106->CurrentValue;
		$this->f20171107->CurrentValue = NULL;
		$this->f20171107->OldValue = $this->f20171107->CurrentValue;
		$this->f20171108->CurrentValue = NULL;
		$this->f20171108->OldValue = $this->f20171108->CurrentValue;
		$this->f20171109->CurrentValue = NULL;
		$this->f20171109->OldValue = $this->f20171109->CurrentValue;
		$this->f20171110->CurrentValue = NULL;
		$this->f20171110->OldValue = $this->f20171110->CurrentValue;
		$this->f20171111->CurrentValue = NULL;
		$this->f20171111->OldValue = $this->f20171111->CurrentValue;
		$this->f20171112->CurrentValue = NULL;
		$this->f20171112->OldValue = $this->f20171112->CurrentValue;
		$this->f20171113->CurrentValue = NULL;
		$this->f20171113->OldValue = $this->f20171113->CurrentValue;
		$this->f20171114->CurrentValue = NULL;
		$this->f20171114->OldValue = $this->f20171114->CurrentValue;
		$this->f20171115->CurrentValue = NULL;
		$this->f20171115->OldValue = $this->f20171115->CurrentValue;
		$this->f20171116->CurrentValue = NULL;
		$this->f20171116->OldValue = $this->f20171116->CurrentValue;
		$this->f20171117->CurrentValue = NULL;
		$this->f20171117->OldValue = $this->f20171117->CurrentValue;
		$this->f20171118->CurrentValue = NULL;
		$this->f20171118->OldValue = $this->f20171118->CurrentValue;
		$this->f20171119->CurrentValue = NULL;
		$this->f20171119->OldValue = $this->f20171119->CurrentValue;
		$this->f20171120->CurrentValue = NULL;
		$this->f20171120->OldValue = $this->f20171120->CurrentValue;
		$this->f20171121->CurrentValue = NULL;
		$this->f20171121->OldValue = $this->f20171121->CurrentValue;
		$this->f20171122->CurrentValue = NULL;
		$this->f20171122->OldValue = $this->f20171122->CurrentValue;
		$this->f20171123->CurrentValue = NULL;
		$this->f20171123->OldValue = $this->f20171123->CurrentValue;
		$this->f20171124->CurrentValue = NULL;
		$this->f20171124->OldValue = $this->f20171124->CurrentValue;
		$this->f20171125->CurrentValue = NULL;
		$this->f20171125->OldValue = $this->f20171125->CurrentValue;
		$this->f20171126->CurrentValue = NULL;
		$this->f20171126->OldValue = $this->f20171126->CurrentValue;
		$this->f20171127->CurrentValue = NULL;
		$this->f20171127->OldValue = $this->f20171127->CurrentValue;
		$this->f20171128->CurrentValue = NULL;
		$this->f20171128->OldValue = $this->f20171128->CurrentValue;
		$this->f20171129->CurrentValue = NULL;
		$this->f20171129->OldValue = $this->f20171129->CurrentValue;
		$this->f20171130->CurrentValue = NULL;
		$this->f20171130->OldValue = $this->f20171130->CurrentValue;
		$this->f20171201->CurrentValue = NULL;
		$this->f20171201->OldValue = $this->f20171201->CurrentValue;
		$this->f20171202->CurrentValue = NULL;
		$this->f20171202->OldValue = $this->f20171202->CurrentValue;
		$this->f20171203->CurrentValue = NULL;
		$this->f20171203->OldValue = $this->f20171203->CurrentValue;
		$this->f20171204->CurrentValue = NULL;
		$this->f20171204->OldValue = $this->f20171204->CurrentValue;
		$this->f20171205->CurrentValue = NULL;
		$this->f20171205->OldValue = $this->f20171205->CurrentValue;
		$this->f20171206->CurrentValue = NULL;
		$this->f20171206->OldValue = $this->f20171206->CurrentValue;
		$this->f20171207->CurrentValue = NULL;
		$this->f20171207->OldValue = $this->f20171207->CurrentValue;
		$this->f20171208->CurrentValue = NULL;
		$this->f20171208->OldValue = $this->f20171208->CurrentValue;
		$this->f20171209->CurrentValue = NULL;
		$this->f20171209->OldValue = $this->f20171209->CurrentValue;
		$this->f20171210->CurrentValue = NULL;
		$this->f20171210->OldValue = $this->f20171210->CurrentValue;
		$this->f20171211->CurrentValue = NULL;
		$this->f20171211->OldValue = $this->f20171211->CurrentValue;
		$this->f20171212->CurrentValue = NULL;
		$this->f20171212->OldValue = $this->f20171212->CurrentValue;
		$this->f20171213->CurrentValue = NULL;
		$this->f20171213->OldValue = $this->f20171213->CurrentValue;
		$this->f20171214->CurrentValue = NULL;
		$this->f20171214->OldValue = $this->f20171214->CurrentValue;
		$this->f20171215->CurrentValue = NULL;
		$this->f20171215->OldValue = $this->f20171215->CurrentValue;
		$this->f20171216->CurrentValue = NULL;
		$this->f20171216->OldValue = $this->f20171216->CurrentValue;
		$this->f20171217->CurrentValue = NULL;
		$this->f20171217->OldValue = $this->f20171217->CurrentValue;
		$this->f20171218->CurrentValue = NULL;
		$this->f20171218->OldValue = $this->f20171218->CurrentValue;
		$this->f20171219->CurrentValue = NULL;
		$this->f20171219->OldValue = $this->f20171219->CurrentValue;
		$this->f20171220->CurrentValue = NULL;
		$this->f20171220->OldValue = $this->f20171220->CurrentValue;
		$this->f20171221->CurrentValue = NULL;
		$this->f20171221->OldValue = $this->f20171221->CurrentValue;
		$this->f20171222->CurrentValue = NULL;
		$this->f20171222->OldValue = $this->f20171222->CurrentValue;
		$this->f20171223->CurrentValue = NULL;
		$this->f20171223->OldValue = $this->f20171223->CurrentValue;
		$this->f20171224->CurrentValue = NULL;
		$this->f20171224->OldValue = $this->f20171224->CurrentValue;
		$this->f20171225->CurrentValue = NULL;
		$this->f20171225->OldValue = $this->f20171225->CurrentValue;
		$this->f20171226->CurrentValue = NULL;
		$this->f20171226->OldValue = $this->f20171226->CurrentValue;
		$this->f20171227->CurrentValue = NULL;
		$this->f20171227->OldValue = $this->f20171227->CurrentValue;
		$this->f20171228->CurrentValue = NULL;
		$this->f20171228->OldValue = $this->f20171228->CurrentValue;
		$this->f20171229->CurrentValue = NULL;
		$this->f20171229->OldValue = $this->f20171229->CurrentValue;
		$this->f20171230->CurrentValue = NULL;
		$this->f20171230->OldValue = $this->f20171230->CurrentValue;
		$this->f20171231->CurrentValue = NULL;
		$this->f20171231->OldValue = $this->f20171231->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->pegawai_id->FldIsDetailKey) {
			$this->pegawai_id->setFormValue($objForm->GetValue("x_pegawai_id"));
		}
		if (!$this->f20170101->FldIsDetailKey) {
			$this->f20170101->setFormValue($objForm->GetValue("x_f20170101"));
		}
		if (!$this->f20170102->FldIsDetailKey) {
			$this->f20170102->setFormValue($objForm->GetValue("x_f20170102"));
		}
		if (!$this->f20170103->FldIsDetailKey) {
			$this->f20170103->setFormValue($objForm->GetValue("x_f20170103"));
		}
		if (!$this->f20170104->FldIsDetailKey) {
			$this->f20170104->setFormValue($objForm->GetValue("x_f20170104"));
		}
		if (!$this->f20170105->FldIsDetailKey) {
			$this->f20170105->setFormValue($objForm->GetValue("x_f20170105"));
		}
		if (!$this->f20170106->FldIsDetailKey) {
			$this->f20170106->setFormValue($objForm->GetValue("x_f20170106"));
		}
		if (!$this->f20170107->FldIsDetailKey) {
			$this->f20170107->setFormValue($objForm->GetValue("x_f20170107"));
		}
		if (!$this->f20170108->FldIsDetailKey) {
			$this->f20170108->setFormValue($objForm->GetValue("x_f20170108"));
		}
		if (!$this->f20170109->FldIsDetailKey) {
			$this->f20170109->setFormValue($objForm->GetValue("x_f20170109"));
		}
		if (!$this->f20170110->FldIsDetailKey) {
			$this->f20170110->setFormValue($objForm->GetValue("x_f20170110"));
		}
		if (!$this->f20170111->FldIsDetailKey) {
			$this->f20170111->setFormValue($objForm->GetValue("x_f20170111"));
		}
		if (!$this->f20170112->FldIsDetailKey) {
			$this->f20170112->setFormValue($objForm->GetValue("x_f20170112"));
		}
		if (!$this->f20170113->FldIsDetailKey) {
			$this->f20170113->setFormValue($objForm->GetValue("x_f20170113"));
		}
		if (!$this->f20170114->FldIsDetailKey) {
			$this->f20170114->setFormValue($objForm->GetValue("x_f20170114"));
		}
		if (!$this->f20170115->FldIsDetailKey) {
			$this->f20170115->setFormValue($objForm->GetValue("x_f20170115"));
		}
		if (!$this->f20170116->FldIsDetailKey) {
			$this->f20170116->setFormValue($objForm->GetValue("x_f20170116"));
		}
		if (!$this->f20170117->FldIsDetailKey) {
			$this->f20170117->setFormValue($objForm->GetValue("x_f20170117"));
		}
		if (!$this->f20170118->FldIsDetailKey) {
			$this->f20170118->setFormValue($objForm->GetValue("x_f20170118"));
		}
		if (!$this->f20170119->FldIsDetailKey) {
			$this->f20170119->setFormValue($objForm->GetValue("x_f20170119"));
		}
		if (!$this->f20170120->FldIsDetailKey) {
			$this->f20170120->setFormValue($objForm->GetValue("x_f20170120"));
		}
		if (!$this->f20170121->FldIsDetailKey) {
			$this->f20170121->setFormValue($objForm->GetValue("x_f20170121"));
		}
		if (!$this->f20170122->FldIsDetailKey) {
			$this->f20170122->setFormValue($objForm->GetValue("x_f20170122"));
		}
		if (!$this->f20170123->FldIsDetailKey) {
			$this->f20170123->setFormValue($objForm->GetValue("x_f20170123"));
		}
		if (!$this->f20170124->FldIsDetailKey) {
			$this->f20170124->setFormValue($objForm->GetValue("x_f20170124"));
		}
		if (!$this->f20170125->FldIsDetailKey) {
			$this->f20170125->setFormValue($objForm->GetValue("x_f20170125"));
		}
		if (!$this->f20170126->FldIsDetailKey) {
			$this->f20170126->setFormValue($objForm->GetValue("x_f20170126"));
		}
		if (!$this->f20170127->FldIsDetailKey) {
			$this->f20170127->setFormValue($objForm->GetValue("x_f20170127"));
		}
		if (!$this->f20170128->FldIsDetailKey) {
			$this->f20170128->setFormValue($objForm->GetValue("x_f20170128"));
		}
		if (!$this->f20170129->FldIsDetailKey) {
			$this->f20170129->setFormValue($objForm->GetValue("x_f20170129"));
		}
		if (!$this->f20170130->FldIsDetailKey) {
			$this->f20170130->setFormValue($objForm->GetValue("x_f20170130"));
		}
		if (!$this->f20170131->FldIsDetailKey) {
			$this->f20170131->setFormValue($objForm->GetValue("x_f20170131"));
		}
		if (!$this->f20170201->FldIsDetailKey) {
			$this->f20170201->setFormValue($objForm->GetValue("x_f20170201"));
		}
		if (!$this->f20170202->FldIsDetailKey) {
			$this->f20170202->setFormValue($objForm->GetValue("x_f20170202"));
		}
		if (!$this->f20170203->FldIsDetailKey) {
			$this->f20170203->setFormValue($objForm->GetValue("x_f20170203"));
		}
		if (!$this->f20170204->FldIsDetailKey) {
			$this->f20170204->setFormValue($objForm->GetValue("x_f20170204"));
		}
		if (!$this->f20170205->FldIsDetailKey) {
			$this->f20170205->setFormValue($objForm->GetValue("x_f20170205"));
		}
		if (!$this->f20170206->FldIsDetailKey) {
			$this->f20170206->setFormValue($objForm->GetValue("x_f20170206"));
		}
		if (!$this->f20170207->FldIsDetailKey) {
			$this->f20170207->setFormValue($objForm->GetValue("x_f20170207"));
		}
		if (!$this->f20170208->FldIsDetailKey) {
			$this->f20170208->setFormValue($objForm->GetValue("x_f20170208"));
		}
		if (!$this->f20170209->FldIsDetailKey) {
			$this->f20170209->setFormValue($objForm->GetValue("x_f20170209"));
		}
		if (!$this->f20170210->FldIsDetailKey) {
			$this->f20170210->setFormValue($objForm->GetValue("x_f20170210"));
		}
		if (!$this->f20170211->FldIsDetailKey) {
			$this->f20170211->setFormValue($objForm->GetValue("x_f20170211"));
		}
		if (!$this->f20170212->FldIsDetailKey) {
			$this->f20170212->setFormValue($objForm->GetValue("x_f20170212"));
		}
		if (!$this->f20170213->FldIsDetailKey) {
			$this->f20170213->setFormValue($objForm->GetValue("x_f20170213"));
		}
		if (!$this->f20170214->FldIsDetailKey) {
			$this->f20170214->setFormValue($objForm->GetValue("x_f20170214"));
		}
		if (!$this->f20170215->FldIsDetailKey) {
			$this->f20170215->setFormValue($objForm->GetValue("x_f20170215"));
		}
		if (!$this->f20170216->FldIsDetailKey) {
			$this->f20170216->setFormValue($objForm->GetValue("x_f20170216"));
		}
		if (!$this->f20170217->FldIsDetailKey) {
			$this->f20170217->setFormValue($objForm->GetValue("x_f20170217"));
		}
		if (!$this->f20170218->FldIsDetailKey) {
			$this->f20170218->setFormValue($objForm->GetValue("x_f20170218"));
		}
		if (!$this->f20170219->FldIsDetailKey) {
			$this->f20170219->setFormValue($objForm->GetValue("x_f20170219"));
		}
		if (!$this->f20170220->FldIsDetailKey) {
			$this->f20170220->setFormValue($objForm->GetValue("x_f20170220"));
		}
		if (!$this->f20170221->FldIsDetailKey) {
			$this->f20170221->setFormValue($objForm->GetValue("x_f20170221"));
		}
		if (!$this->f20170222->FldIsDetailKey) {
			$this->f20170222->setFormValue($objForm->GetValue("x_f20170222"));
		}
		if (!$this->f20170223->FldIsDetailKey) {
			$this->f20170223->setFormValue($objForm->GetValue("x_f20170223"));
		}
		if (!$this->f20170224->FldIsDetailKey) {
			$this->f20170224->setFormValue($objForm->GetValue("x_f20170224"));
		}
		if (!$this->f20170225->FldIsDetailKey) {
			$this->f20170225->setFormValue($objForm->GetValue("x_f20170225"));
		}
		if (!$this->f20170226->FldIsDetailKey) {
			$this->f20170226->setFormValue($objForm->GetValue("x_f20170226"));
		}
		if (!$this->f20170227->FldIsDetailKey) {
			$this->f20170227->setFormValue($objForm->GetValue("x_f20170227"));
		}
		if (!$this->f20170228->FldIsDetailKey) {
			$this->f20170228->setFormValue($objForm->GetValue("x_f20170228"));
		}
		if (!$this->f20170229->FldIsDetailKey) {
			$this->f20170229->setFormValue($objForm->GetValue("x_f20170229"));
		}
		if (!$this->f20170301->FldIsDetailKey) {
			$this->f20170301->setFormValue($objForm->GetValue("x_f20170301"));
		}
		if (!$this->f20170302->FldIsDetailKey) {
			$this->f20170302->setFormValue($objForm->GetValue("x_f20170302"));
		}
		if (!$this->f20170303->FldIsDetailKey) {
			$this->f20170303->setFormValue($objForm->GetValue("x_f20170303"));
		}
		if (!$this->f20170304->FldIsDetailKey) {
			$this->f20170304->setFormValue($objForm->GetValue("x_f20170304"));
		}
		if (!$this->f20170305->FldIsDetailKey) {
			$this->f20170305->setFormValue($objForm->GetValue("x_f20170305"));
		}
		if (!$this->f20170306->FldIsDetailKey) {
			$this->f20170306->setFormValue($objForm->GetValue("x_f20170306"));
		}
		if (!$this->f20170307->FldIsDetailKey) {
			$this->f20170307->setFormValue($objForm->GetValue("x_f20170307"));
		}
		if (!$this->f20170308->FldIsDetailKey) {
			$this->f20170308->setFormValue($objForm->GetValue("x_f20170308"));
		}
		if (!$this->f20170309->FldIsDetailKey) {
			$this->f20170309->setFormValue($objForm->GetValue("x_f20170309"));
		}
		if (!$this->f20170310->FldIsDetailKey) {
			$this->f20170310->setFormValue($objForm->GetValue("x_f20170310"));
		}
		if (!$this->f20170311->FldIsDetailKey) {
			$this->f20170311->setFormValue($objForm->GetValue("x_f20170311"));
		}
		if (!$this->f20170312->FldIsDetailKey) {
			$this->f20170312->setFormValue($objForm->GetValue("x_f20170312"));
		}
		if (!$this->f20170313->FldIsDetailKey) {
			$this->f20170313->setFormValue($objForm->GetValue("x_f20170313"));
		}
		if (!$this->f20170314->FldIsDetailKey) {
			$this->f20170314->setFormValue($objForm->GetValue("x_f20170314"));
		}
		if (!$this->f20170315->FldIsDetailKey) {
			$this->f20170315->setFormValue($objForm->GetValue("x_f20170315"));
		}
		if (!$this->f20170316->FldIsDetailKey) {
			$this->f20170316->setFormValue($objForm->GetValue("x_f20170316"));
		}
		if (!$this->f20170317->FldIsDetailKey) {
			$this->f20170317->setFormValue($objForm->GetValue("x_f20170317"));
		}
		if (!$this->f20170318->FldIsDetailKey) {
			$this->f20170318->setFormValue($objForm->GetValue("x_f20170318"));
		}
		if (!$this->f20170319->FldIsDetailKey) {
			$this->f20170319->setFormValue($objForm->GetValue("x_f20170319"));
		}
		if (!$this->f20170320->FldIsDetailKey) {
			$this->f20170320->setFormValue($objForm->GetValue("x_f20170320"));
		}
		if (!$this->f20170321->FldIsDetailKey) {
			$this->f20170321->setFormValue($objForm->GetValue("x_f20170321"));
		}
		if (!$this->f20170322->FldIsDetailKey) {
			$this->f20170322->setFormValue($objForm->GetValue("x_f20170322"));
		}
		if (!$this->f20170323->FldIsDetailKey) {
			$this->f20170323->setFormValue($objForm->GetValue("x_f20170323"));
		}
		if (!$this->f20170324->FldIsDetailKey) {
			$this->f20170324->setFormValue($objForm->GetValue("x_f20170324"));
		}
		if (!$this->f20170325->FldIsDetailKey) {
			$this->f20170325->setFormValue($objForm->GetValue("x_f20170325"));
		}
		if (!$this->f20170326->FldIsDetailKey) {
			$this->f20170326->setFormValue($objForm->GetValue("x_f20170326"));
		}
		if (!$this->f20170327->FldIsDetailKey) {
			$this->f20170327->setFormValue($objForm->GetValue("x_f20170327"));
		}
		if (!$this->f20170328->FldIsDetailKey) {
			$this->f20170328->setFormValue($objForm->GetValue("x_f20170328"));
		}
		if (!$this->f20170329->FldIsDetailKey) {
			$this->f20170329->setFormValue($objForm->GetValue("x_f20170329"));
		}
		if (!$this->f20170330->FldIsDetailKey) {
			$this->f20170330->setFormValue($objForm->GetValue("x_f20170330"));
		}
		if (!$this->f20170331->FldIsDetailKey) {
			$this->f20170331->setFormValue($objForm->GetValue("x_f20170331"));
		}
		if (!$this->f20170401->FldIsDetailKey) {
			$this->f20170401->setFormValue($objForm->GetValue("x_f20170401"));
		}
		if (!$this->f20170402->FldIsDetailKey) {
			$this->f20170402->setFormValue($objForm->GetValue("x_f20170402"));
		}
		if (!$this->f20170403->FldIsDetailKey) {
			$this->f20170403->setFormValue($objForm->GetValue("x_f20170403"));
		}
		if (!$this->f20170404->FldIsDetailKey) {
			$this->f20170404->setFormValue($objForm->GetValue("x_f20170404"));
		}
		if (!$this->f20170405->FldIsDetailKey) {
			$this->f20170405->setFormValue($objForm->GetValue("x_f20170405"));
		}
		if (!$this->f20170406->FldIsDetailKey) {
			$this->f20170406->setFormValue($objForm->GetValue("x_f20170406"));
		}
		if (!$this->f20170407->FldIsDetailKey) {
			$this->f20170407->setFormValue($objForm->GetValue("x_f20170407"));
		}
		if (!$this->f20170408->FldIsDetailKey) {
			$this->f20170408->setFormValue($objForm->GetValue("x_f20170408"));
		}
		if (!$this->f20170409->FldIsDetailKey) {
			$this->f20170409->setFormValue($objForm->GetValue("x_f20170409"));
		}
		if (!$this->f20170410->FldIsDetailKey) {
			$this->f20170410->setFormValue($objForm->GetValue("x_f20170410"));
		}
		if (!$this->f20170411->FldIsDetailKey) {
			$this->f20170411->setFormValue($objForm->GetValue("x_f20170411"));
		}
		if (!$this->f20170412->FldIsDetailKey) {
			$this->f20170412->setFormValue($objForm->GetValue("x_f20170412"));
		}
		if (!$this->f20170413->FldIsDetailKey) {
			$this->f20170413->setFormValue($objForm->GetValue("x_f20170413"));
		}
		if (!$this->f20170414->FldIsDetailKey) {
			$this->f20170414->setFormValue($objForm->GetValue("x_f20170414"));
		}
		if (!$this->f20170415->FldIsDetailKey) {
			$this->f20170415->setFormValue($objForm->GetValue("x_f20170415"));
		}
		if (!$this->f20170416->FldIsDetailKey) {
			$this->f20170416->setFormValue($objForm->GetValue("x_f20170416"));
		}
		if (!$this->f20170417->FldIsDetailKey) {
			$this->f20170417->setFormValue($objForm->GetValue("x_f20170417"));
		}
		if (!$this->f20170418->FldIsDetailKey) {
			$this->f20170418->setFormValue($objForm->GetValue("x_f20170418"));
		}
		if (!$this->f20170419->FldIsDetailKey) {
			$this->f20170419->setFormValue($objForm->GetValue("x_f20170419"));
		}
		if (!$this->f20170420->FldIsDetailKey) {
			$this->f20170420->setFormValue($objForm->GetValue("x_f20170420"));
		}
		if (!$this->f20170421->FldIsDetailKey) {
			$this->f20170421->setFormValue($objForm->GetValue("x_f20170421"));
		}
		if (!$this->f20170422->FldIsDetailKey) {
			$this->f20170422->setFormValue($objForm->GetValue("x_f20170422"));
		}
		if (!$this->f20170423->FldIsDetailKey) {
			$this->f20170423->setFormValue($objForm->GetValue("x_f20170423"));
		}
		if (!$this->f20170424->FldIsDetailKey) {
			$this->f20170424->setFormValue($objForm->GetValue("x_f20170424"));
		}
		if (!$this->f20170425->FldIsDetailKey) {
			$this->f20170425->setFormValue($objForm->GetValue("x_f20170425"));
		}
		if (!$this->f20170426->FldIsDetailKey) {
			$this->f20170426->setFormValue($objForm->GetValue("x_f20170426"));
		}
		if (!$this->f20170427->FldIsDetailKey) {
			$this->f20170427->setFormValue($objForm->GetValue("x_f20170427"));
		}
		if (!$this->f20170428->FldIsDetailKey) {
			$this->f20170428->setFormValue($objForm->GetValue("x_f20170428"));
		}
		if (!$this->f20170429->FldIsDetailKey) {
			$this->f20170429->setFormValue($objForm->GetValue("x_f20170429"));
		}
		if (!$this->f20170430->FldIsDetailKey) {
			$this->f20170430->setFormValue($objForm->GetValue("x_f20170430"));
		}
		if (!$this->f20170501->FldIsDetailKey) {
			$this->f20170501->setFormValue($objForm->GetValue("x_f20170501"));
		}
		if (!$this->f20170502->FldIsDetailKey) {
			$this->f20170502->setFormValue($objForm->GetValue("x_f20170502"));
		}
		if (!$this->f20170503->FldIsDetailKey) {
			$this->f20170503->setFormValue($objForm->GetValue("x_f20170503"));
		}
		if (!$this->f20170504->FldIsDetailKey) {
			$this->f20170504->setFormValue($objForm->GetValue("x_f20170504"));
		}
		if (!$this->f20170505->FldIsDetailKey) {
			$this->f20170505->setFormValue($objForm->GetValue("x_f20170505"));
		}
		if (!$this->f20170506->FldIsDetailKey) {
			$this->f20170506->setFormValue($objForm->GetValue("x_f20170506"));
		}
		if (!$this->f20170507->FldIsDetailKey) {
			$this->f20170507->setFormValue($objForm->GetValue("x_f20170507"));
		}
		if (!$this->f20170508->FldIsDetailKey) {
			$this->f20170508->setFormValue($objForm->GetValue("x_f20170508"));
		}
		if (!$this->f20170509->FldIsDetailKey) {
			$this->f20170509->setFormValue($objForm->GetValue("x_f20170509"));
		}
		if (!$this->f20170510->FldIsDetailKey) {
			$this->f20170510->setFormValue($objForm->GetValue("x_f20170510"));
		}
		if (!$this->f20170511->FldIsDetailKey) {
			$this->f20170511->setFormValue($objForm->GetValue("x_f20170511"));
		}
		if (!$this->f20170512->FldIsDetailKey) {
			$this->f20170512->setFormValue($objForm->GetValue("x_f20170512"));
		}
		if (!$this->f20170513->FldIsDetailKey) {
			$this->f20170513->setFormValue($objForm->GetValue("x_f20170513"));
		}
		if (!$this->f20170514->FldIsDetailKey) {
			$this->f20170514->setFormValue($objForm->GetValue("x_f20170514"));
		}
		if (!$this->f20170515->FldIsDetailKey) {
			$this->f20170515->setFormValue($objForm->GetValue("x_f20170515"));
		}
		if (!$this->f20170516->FldIsDetailKey) {
			$this->f20170516->setFormValue($objForm->GetValue("x_f20170516"));
		}
		if (!$this->f20170517->FldIsDetailKey) {
			$this->f20170517->setFormValue($objForm->GetValue("x_f20170517"));
		}
		if (!$this->f20170518->FldIsDetailKey) {
			$this->f20170518->setFormValue($objForm->GetValue("x_f20170518"));
		}
		if (!$this->f20170519->FldIsDetailKey) {
			$this->f20170519->setFormValue($objForm->GetValue("x_f20170519"));
		}
		if (!$this->f20170520->FldIsDetailKey) {
			$this->f20170520->setFormValue($objForm->GetValue("x_f20170520"));
		}
		if (!$this->f20170521->FldIsDetailKey) {
			$this->f20170521->setFormValue($objForm->GetValue("x_f20170521"));
		}
		if (!$this->f20170522->FldIsDetailKey) {
			$this->f20170522->setFormValue($objForm->GetValue("x_f20170522"));
		}
		if (!$this->f20170523->FldIsDetailKey) {
			$this->f20170523->setFormValue($objForm->GetValue("x_f20170523"));
		}
		if (!$this->f20170524->FldIsDetailKey) {
			$this->f20170524->setFormValue($objForm->GetValue("x_f20170524"));
		}
		if (!$this->f20170525->FldIsDetailKey) {
			$this->f20170525->setFormValue($objForm->GetValue("x_f20170525"));
		}
		if (!$this->f20170526->FldIsDetailKey) {
			$this->f20170526->setFormValue($objForm->GetValue("x_f20170526"));
		}
		if (!$this->f20170527->FldIsDetailKey) {
			$this->f20170527->setFormValue($objForm->GetValue("x_f20170527"));
		}
		if (!$this->f20170528->FldIsDetailKey) {
			$this->f20170528->setFormValue($objForm->GetValue("x_f20170528"));
		}
		if (!$this->f20170529->FldIsDetailKey) {
			$this->f20170529->setFormValue($objForm->GetValue("x_f20170529"));
		}
		if (!$this->f20170530->FldIsDetailKey) {
			$this->f20170530->setFormValue($objForm->GetValue("x_f20170530"));
		}
		if (!$this->f20170531->FldIsDetailKey) {
			$this->f20170531->setFormValue($objForm->GetValue("x_f20170531"));
		}
		if (!$this->f20170601->FldIsDetailKey) {
			$this->f20170601->setFormValue($objForm->GetValue("x_f20170601"));
		}
		if (!$this->f20170602->FldIsDetailKey) {
			$this->f20170602->setFormValue($objForm->GetValue("x_f20170602"));
		}
		if (!$this->f20170603->FldIsDetailKey) {
			$this->f20170603->setFormValue($objForm->GetValue("x_f20170603"));
		}
		if (!$this->f20170604->FldIsDetailKey) {
			$this->f20170604->setFormValue($objForm->GetValue("x_f20170604"));
		}
		if (!$this->f20170605->FldIsDetailKey) {
			$this->f20170605->setFormValue($objForm->GetValue("x_f20170605"));
		}
		if (!$this->f20170606->FldIsDetailKey) {
			$this->f20170606->setFormValue($objForm->GetValue("x_f20170606"));
		}
		if (!$this->f20170607->FldIsDetailKey) {
			$this->f20170607->setFormValue($objForm->GetValue("x_f20170607"));
		}
		if (!$this->f20170608->FldIsDetailKey) {
			$this->f20170608->setFormValue($objForm->GetValue("x_f20170608"));
		}
		if (!$this->f20170609->FldIsDetailKey) {
			$this->f20170609->setFormValue($objForm->GetValue("x_f20170609"));
		}
		if (!$this->f20170610->FldIsDetailKey) {
			$this->f20170610->setFormValue($objForm->GetValue("x_f20170610"));
		}
		if (!$this->f20170611->FldIsDetailKey) {
			$this->f20170611->setFormValue($objForm->GetValue("x_f20170611"));
		}
		if (!$this->f20170612->FldIsDetailKey) {
			$this->f20170612->setFormValue($objForm->GetValue("x_f20170612"));
		}
		if (!$this->f20170613->FldIsDetailKey) {
			$this->f20170613->setFormValue($objForm->GetValue("x_f20170613"));
		}
		if (!$this->f20170614->FldIsDetailKey) {
			$this->f20170614->setFormValue($objForm->GetValue("x_f20170614"));
		}
		if (!$this->f20170615->FldIsDetailKey) {
			$this->f20170615->setFormValue($objForm->GetValue("x_f20170615"));
		}
		if (!$this->f20170616->FldIsDetailKey) {
			$this->f20170616->setFormValue($objForm->GetValue("x_f20170616"));
		}
		if (!$this->f20170617->FldIsDetailKey) {
			$this->f20170617->setFormValue($objForm->GetValue("x_f20170617"));
		}
		if (!$this->f20170618->FldIsDetailKey) {
			$this->f20170618->setFormValue($objForm->GetValue("x_f20170618"));
		}
		if (!$this->f20170619->FldIsDetailKey) {
			$this->f20170619->setFormValue($objForm->GetValue("x_f20170619"));
		}
		if (!$this->f20170620->FldIsDetailKey) {
			$this->f20170620->setFormValue($objForm->GetValue("x_f20170620"));
		}
		if (!$this->f20170621->FldIsDetailKey) {
			$this->f20170621->setFormValue($objForm->GetValue("x_f20170621"));
		}
		if (!$this->f20170622->FldIsDetailKey) {
			$this->f20170622->setFormValue($objForm->GetValue("x_f20170622"));
		}
		if (!$this->f20170623->FldIsDetailKey) {
			$this->f20170623->setFormValue($objForm->GetValue("x_f20170623"));
		}
		if (!$this->f20170624->FldIsDetailKey) {
			$this->f20170624->setFormValue($objForm->GetValue("x_f20170624"));
		}
		if (!$this->f20170625->FldIsDetailKey) {
			$this->f20170625->setFormValue($objForm->GetValue("x_f20170625"));
		}
		if (!$this->f20170626->FldIsDetailKey) {
			$this->f20170626->setFormValue($objForm->GetValue("x_f20170626"));
		}
		if (!$this->f20170627->FldIsDetailKey) {
			$this->f20170627->setFormValue($objForm->GetValue("x_f20170627"));
		}
		if (!$this->f20170628->FldIsDetailKey) {
			$this->f20170628->setFormValue($objForm->GetValue("x_f20170628"));
		}
		if (!$this->f20170629->FldIsDetailKey) {
			$this->f20170629->setFormValue($objForm->GetValue("x_f20170629"));
		}
		if (!$this->f20170630->FldIsDetailKey) {
			$this->f20170630->setFormValue($objForm->GetValue("x_f20170630"));
		}
		if (!$this->f20170701->FldIsDetailKey) {
			$this->f20170701->setFormValue($objForm->GetValue("x_f20170701"));
		}
		if (!$this->f20170702->FldIsDetailKey) {
			$this->f20170702->setFormValue($objForm->GetValue("x_f20170702"));
		}
		if (!$this->f20170703->FldIsDetailKey) {
			$this->f20170703->setFormValue($objForm->GetValue("x_f20170703"));
		}
		if (!$this->f20170704->FldIsDetailKey) {
			$this->f20170704->setFormValue($objForm->GetValue("x_f20170704"));
		}
		if (!$this->f20170705->FldIsDetailKey) {
			$this->f20170705->setFormValue($objForm->GetValue("x_f20170705"));
		}
		if (!$this->f20170706->FldIsDetailKey) {
			$this->f20170706->setFormValue($objForm->GetValue("x_f20170706"));
		}
		if (!$this->f20170707->FldIsDetailKey) {
			$this->f20170707->setFormValue($objForm->GetValue("x_f20170707"));
		}
		if (!$this->f20170708->FldIsDetailKey) {
			$this->f20170708->setFormValue($objForm->GetValue("x_f20170708"));
		}
		if (!$this->f20170709->FldIsDetailKey) {
			$this->f20170709->setFormValue($objForm->GetValue("x_f20170709"));
		}
		if (!$this->f20170710->FldIsDetailKey) {
			$this->f20170710->setFormValue($objForm->GetValue("x_f20170710"));
		}
		if (!$this->f20170711->FldIsDetailKey) {
			$this->f20170711->setFormValue($objForm->GetValue("x_f20170711"));
		}
		if (!$this->f20170712->FldIsDetailKey) {
			$this->f20170712->setFormValue($objForm->GetValue("x_f20170712"));
		}
		if (!$this->f20170713->FldIsDetailKey) {
			$this->f20170713->setFormValue($objForm->GetValue("x_f20170713"));
		}
		if (!$this->f20170714->FldIsDetailKey) {
			$this->f20170714->setFormValue($objForm->GetValue("x_f20170714"));
		}
		if (!$this->f20170715->FldIsDetailKey) {
			$this->f20170715->setFormValue($objForm->GetValue("x_f20170715"));
		}
		if (!$this->f20170716->FldIsDetailKey) {
			$this->f20170716->setFormValue($objForm->GetValue("x_f20170716"));
		}
		if (!$this->f20170717->FldIsDetailKey) {
			$this->f20170717->setFormValue($objForm->GetValue("x_f20170717"));
		}
		if (!$this->f20170718->FldIsDetailKey) {
			$this->f20170718->setFormValue($objForm->GetValue("x_f20170718"));
		}
		if (!$this->f20170719->FldIsDetailKey) {
			$this->f20170719->setFormValue($objForm->GetValue("x_f20170719"));
		}
		if (!$this->f20170720->FldIsDetailKey) {
			$this->f20170720->setFormValue($objForm->GetValue("x_f20170720"));
		}
		if (!$this->f20170721->FldIsDetailKey) {
			$this->f20170721->setFormValue($objForm->GetValue("x_f20170721"));
		}
		if (!$this->f20170722->FldIsDetailKey) {
			$this->f20170722->setFormValue($objForm->GetValue("x_f20170722"));
		}
		if (!$this->f20170723->FldIsDetailKey) {
			$this->f20170723->setFormValue($objForm->GetValue("x_f20170723"));
		}
		if (!$this->f20170724->FldIsDetailKey) {
			$this->f20170724->setFormValue($objForm->GetValue("x_f20170724"));
		}
		if (!$this->f20170725->FldIsDetailKey) {
			$this->f20170725->setFormValue($objForm->GetValue("x_f20170725"));
		}
		if (!$this->f20170726->FldIsDetailKey) {
			$this->f20170726->setFormValue($objForm->GetValue("x_f20170726"));
		}
		if (!$this->f20170727->FldIsDetailKey) {
			$this->f20170727->setFormValue($objForm->GetValue("x_f20170727"));
		}
		if (!$this->f20170728->FldIsDetailKey) {
			$this->f20170728->setFormValue($objForm->GetValue("x_f20170728"));
		}
		if (!$this->f20170729->FldIsDetailKey) {
			$this->f20170729->setFormValue($objForm->GetValue("x_f20170729"));
		}
		if (!$this->f20170730->FldIsDetailKey) {
			$this->f20170730->setFormValue($objForm->GetValue("x_f20170730"));
		}
		if (!$this->f20170731->FldIsDetailKey) {
			$this->f20170731->setFormValue($objForm->GetValue("x_f20170731"));
		}
		if (!$this->f20170801->FldIsDetailKey) {
			$this->f20170801->setFormValue($objForm->GetValue("x_f20170801"));
		}
		if (!$this->f20170802->FldIsDetailKey) {
			$this->f20170802->setFormValue($objForm->GetValue("x_f20170802"));
		}
		if (!$this->f20170803->FldIsDetailKey) {
			$this->f20170803->setFormValue($objForm->GetValue("x_f20170803"));
		}
		if (!$this->f20170804->FldIsDetailKey) {
			$this->f20170804->setFormValue($objForm->GetValue("x_f20170804"));
		}
		if (!$this->f20170805->FldIsDetailKey) {
			$this->f20170805->setFormValue($objForm->GetValue("x_f20170805"));
		}
		if (!$this->f20170806->FldIsDetailKey) {
			$this->f20170806->setFormValue($objForm->GetValue("x_f20170806"));
		}
		if (!$this->f20170807->FldIsDetailKey) {
			$this->f20170807->setFormValue($objForm->GetValue("x_f20170807"));
		}
		if (!$this->f20170808->FldIsDetailKey) {
			$this->f20170808->setFormValue($objForm->GetValue("x_f20170808"));
		}
		if (!$this->f20170809->FldIsDetailKey) {
			$this->f20170809->setFormValue($objForm->GetValue("x_f20170809"));
		}
		if (!$this->f20170810->FldIsDetailKey) {
			$this->f20170810->setFormValue($objForm->GetValue("x_f20170810"));
		}
		if (!$this->f20170811->FldIsDetailKey) {
			$this->f20170811->setFormValue($objForm->GetValue("x_f20170811"));
		}
		if (!$this->f20170812->FldIsDetailKey) {
			$this->f20170812->setFormValue($objForm->GetValue("x_f20170812"));
		}
		if (!$this->f20170813->FldIsDetailKey) {
			$this->f20170813->setFormValue($objForm->GetValue("x_f20170813"));
		}
		if (!$this->f20170814->FldIsDetailKey) {
			$this->f20170814->setFormValue($objForm->GetValue("x_f20170814"));
		}
		if (!$this->f20170815->FldIsDetailKey) {
			$this->f20170815->setFormValue($objForm->GetValue("x_f20170815"));
		}
		if (!$this->f20170816->FldIsDetailKey) {
			$this->f20170816->setFormValue($objForm->GetValue("x_f20170816"));
		}
		if (!$this->f20170817->FldIsDetailKey) {
			$this->f20170817->setFormValue($objForm->GetValue("x_f20170817"));
		}
		if (!$this->f20170818->FldIsDetailKey) {
			$this->f20170818->setFormValue($objForm->GetValue("x_f20170818"));
		}
		if (!$this->f20170819->FldIsDetailKey) {
			$this->f20170819->setFormValue($objForm->GetValue("x_f20170819"));
		}
		if (!$this->f20170820->FldIsDetailKey) {
			$this->f20170820->setFormValue($objForm->GetValue("x_f20170820"));
		}
		if (!$this->f20170821->FldIsDetailKey) {
			$this->f20170821->setFormValue($objForm->GetValue("x_f20170821"));
		}
		if (!$this->f20170822->FldIsDetailKey) {
			$this->f20170822->setFormValue($objForm->GetValue("x_f20170822"));
		}
		if (!$this->f20170823->FldIsDetailKey) {
			$this->f20170823->setFormValue($objForm->GetValue("x_f20170823"));
		}
		if (!$this->f20170824->FldIsDetailKey) {
			$this->f20170824->setFormValue($objForm->GetValue("x_f20170824"));
		}
		if (!$this->f20170825->FldIsDetailKey) {
			$this->f20170825->setFormValue($objForm->GetValue("x_f20170825"));
		}
		if (!$this->f20170826->FldIsDetailKey) {
			$this->f20170826->setFormValue($objForm->GetValue("x_f20170826"));
		}
		if (!$this->f20170827->FldIsDetailKey) {
			$this->f20170827->setFormValue($objForm->GetValue("x_f20170827"));
		}
		if (!$this->f20170828->FldIsDetailKey) {
			$this->f20170828->setFormValue($objForm->GetValue("x_f20170828"));
		}
		if (!$this->f20170829->FldIsDetailKey) {
			$this->f20170829->setFormValue($objForm->GetValue("x_f20170829"));
		}
		if (!$this->f20170830->FldIsDetailKey) {
			$this->f20170830->setFormValue($objForm->GetValue("x_f20170830"));
		}
		if (!$this->f20170831->FldIsDetailKey) {
			$this->f20170831->setFormValue($objForm->GetValue("x_f20170831"));
		}
		if (!$this->f20170901->FldIsDetailKey) {
			$this->f20170901->setFormValue($objForm->GetValue("x_f20170901"));
		}
		if (!$this->f20170902->FldIsDetailKey) {
			$this->f20170902->setFormValue($objForm->GetValue("x_f20170902"));
		}
		if (!$this->f20170903->FldIsDetailKey) {
			$this->f20170903->setFormValue($objForm->GetValue("x_f20170903"));
		}
		if (!$this->f20170904->FldIsDetailKey) {
			$this->f20170904->setFormValue($objForm->GetValue("x_f20170904"));
		}
		if (!$this->f20170905->FldIsDetailKey) {
			$this->f20170905->setFormValue($objForm->GetValue("x_f20170905"));
		}
		if (!$this->f20170906->FldIsDetailKey) {
			$this->f20170906->setFormValue($objForm->GetValue("x_f20170906"));
		}
		if (!$this->f20170907->FldIsDetailKey) {
			$this->f20170907->setFormValue($objForm->GetValue("x_f20170907"));
		}
		if (!$this->f20170908->FldIsDetailKey) {
			$this->f20170908->setFormValue($objForm->GetValue("x_f20170908"));
		}
		if (!$this->f20170909->FldIsDetailKey) {
			$this->f20170909->setFormValue($objForm->GetValue("x_f20170909"));
		}
		if (!$this->f20170910->FldIsDetailKey) {
			$this->f20170910->setFormValue($objForm->GetValue("x_f20170910"));
		}
		if (!$this->f20170911->FldIsDetailKey) {
			$this->f20170911->setFormValue($objForm->GetValue("x_f20170911"));
		}
		if (!$this->f20170912->FldIsDetailKey) {
			$this->f20170912->setFormValue($objForm->GetValue("x_f20170912"));
		}
		if (!$this->f20170913->FldIsDetailKey) {
			$this->f20170913->setFormValue($objForm->GetValue("x_f20170913"));
		}
		if (!$this->f20170914->FldIsDetailKey) {
			$this->f20170914->setFormValue($objForm->GetValue("x_f20170914"));
		}
		if (!$this->f20170915->FldIsDetailKey) {
			$this->f20170915->setFormValue($objForm->GetValue("x_f20170915"));
		}
		if (!$this->f20170916->FldIsDetailKey) {
			$this->f20170916->setFormValue($objForm->GetValue("x_f20170916"));
		}
		if (!$this->f20170917->FldIsDetailKey) {
			$this->f20170917->setFormValue($objForm->GetValue("x_f20170917"));
		}
		if (!$this->f20170918->FldIsDetailKey) {
			$this->f20170918->setFormValue($objForm->GetValue("x_f20170918"));
		}
		if (!$this->f20170919->FldIsDetailKey) {
			$this->f20170919->setFormValue($objForm->GetValue("x_f20170919"));
		}
		if (!$this->f20170920->FldIsDetailKey) {
			$this->f20170920->setFormValue($objForm->GetValue("x_f20170920"));
		}
		if (!$this->f20170921->FldIsDetailKey) {
			$this->f20170921->setFormValue($objForm->GetValue("x_f20170921"));
		}
		if (!$this->f20170922->FldIsDetailKey) {
			$this->f20170922->setFormValue($objForm->GetValue("x_f20170922"));
		}
		if (!$this->f20170923->FldIsDetailKey) {
			$this->f20170923->setFormValue($objForm->GetValue("x_f20170923"));
		}
		if (!$this->f20170924->FldIsDetailKey) {
			$this->f20170924->setFormValue($objForm->GetValue("x_f20170924"));
		}
		if (!$this->f20170925->FldIsDetailKey) {
			$this->f20170925->setFormValue($objForm->GetValue("x_f20170925"));
		}
		if (!$this->f20170926->FldIsDetailKey) {
			$this->f20170926->setFormValue($objForm->GetValue("x_f20170926"));
		}
		if (!$this->f20170927->FldIsDetailKey) {
			$this->f20170927->setFormValue($objForm->GetValue("x_f20170927"));
		}
		if (!$this->f20170928->FldIsDetailKey) {
			$this->f20170928->setFormValue($objForm->GetValue("x_f20170928"));
		}
		if (!$this->f20170929->FldIsDetailKey) {
			$this->f20170929->setFormValue($objForm->GetValue("x_f20170929"));
		}
		if (!$this->f20170930->FldIsDetailKey) {
			$this->f20170930->setFormValue($objForm->GetValue("x_f20170930"));
		}
		if (!$this->f20171001->FldIsDetailKey) {
			$this->f20171001->setFormValue($objForm->GetValue("x_f20171001"));
		}
		if (!$this->f20171002->FldIsDetailKey) {
			$this->f20171002->setFormValue($objForm->GetValue("x_f20171002"));
		}
		if (!$this->f20171003->FldIsDetailKey) {
			$this->f20171003->setFormValue($objForm->GetValue("x_f20171003"));
		}
		if (!$this->f20171004->FldIsDetailKey) {
			$this->f20171004->setFormValue($objForm->GetValue("x_f20171004"));
		}
		if (!$this->f20171005->FldIsDetailKey) {
			$this->f20171005->setFormValue($objForm->GetValue("x_f20171005"));
		}
		if (!$this->f20171006->FldIsDetailKey) {
			$this->f20171006->setFormValue($objForm->GetValue("x_f20171006"));
		}
		if (!$this->f20171007->FldIsDetailKey) {
			$this->f20171007->setFormValue($objForm->GetValue("x_f20171007"));
		}
		if (!$this->f20171008->FldIsDetailKey) {
			$this->f20171008->setFormValue($objForm->GetValue("x_f20171008"));
		}
		if (!$this->f20171009->FldIsDetailKey) {
			$this->f20171009->setFormValue($objForm->GetValue("x_f20171009"));
		}
		if (!$this->f20171010->FldIsDetailKey) {
			$this->f20171010->setFormValue($objForm->GetValue("x_f20171010"));
		}
		if (!$this->f20171011->FldIsDetailKey) {
			$this->f20171011->setFormValue($objForm->GetValue("x_f20171011"));
		}
		if (!$this->f20171012->FldIsDetailKey) {
			$this->f20171012->setFormValue($objForm->GetValue("x_f20171012"));
		}
		if (!$this->f20171013->FldIsDetailKey) {
			$this->f20171013->setFormValue($objForm->GetValue("x_f20171013"));
		}
		if (!$this->f20171014->FldIsDetailKey) {
			$this->f20171014->setFormValue($objForm->GetValue("x_f20171014"));
		}
		if (!$this->f20171015->FldIsDetailKey) {
			$this->f20171015->setFormValue($objForm->GetValue("x_f20171015"));
		}
		if (!$this->f20171016->FldIsDetailKey) {
			$this->f20171016->setFormValue($objForm->GetValue("x_f20171016"));
		}
		if (!$this->f20171017->FldIsDetailKey) {
			$this->f20171017->setFormValue($objForm->GetValue("x_f20171017"));
		}
		if (!$this->f20171018->FldIsDetailKey) {
			$this->f20171018->setFormValue($objForm->GetValue("x_f20171018"));
		}
		if (!$this->f20171019->FldIsDetailKey) {
			$this->f20171019->setFormValue($objForm->GetValue("x_f20171019"));
		}
		if (!$this->f20171020->FldIsDetailKey) {
			$this->f20171020->setFormValue($objForm->GetValue("x_f20171020"));
		}
		if (!$this->f20171021->FldIsDetailKey) {
			$this->f20171021->setFormValue($objForm->GetValue("x_f20171021"));
		}
		if (!$this->f20171022->FldIsDetailKey) {
			$this->f20171022->setFormValue($objForm->GetValue("x_f20171022"));
		}
		if (!$this->f20171023->FldIsDetailKey) {
			$this->f20171023->setFormValue($objForm->GetValue("x_f20171023"));
		}
		if (!$this->f20171024->FldIsDetailKey) {
			$this->f20171024->setFormValue($objForm->GetValue("x_f20171024"));
		}
		if (!$this->f20171025->FldIsDetailKey) {
			$this->f20171025->setFormValue($objForm->GetValue("x_f20171025"));
		}
		if (!$this->f20171026->FldIsDetailKey) {
			$this->f20171026->setFormValue($objForm->GetValue("x_f20171026"));
		}
		if (!$this->f20171027->FldIsDetailKey) {
			$this->f20171027->setFormValue($objForm->GetValue("x_f20171027"));
		}
		if (!$this->f20171028->FldIsDetailKey) {
			$this->f20171028->setFormValue($objForm->GetValue("x_f20171028"));
		}
		if (!$this->f20171029->FldIsDetailKey) {
			$this->f20171029->setFormValue($objForm->GetValue("x_f20171029"));
		}
		if (!$this->f20171030->FldIsDetailKey) {
			$this->f20171030->setFormValue($objForm->GetValue("x_f20171030"));
		}
		if (!$this->f20171031->FldIsDetailKey) {
			$this->f20171031->setFormValue($objForm->GetValue("x_f20171031"));
		}
		if (!$this->f20171101->FldIsDetailKey) {
			$this->f20171101->setFormValue($objForm->GetValue("x_f20171101"));
		}
		if (!$this->f20171102->FldIsDetailKey) {
			$this->f20171102->setFormValue($objForm->GetValue("x_f20171102"));
		}
		if (!$this->f20171103->FldIsDetailKey) {
			$this->f20171103->setFormValue($objForm->GetValue("x_f20171103"));
		}
		if (!$this->f20171104->FldIsDetailKey) {
			$this->f20171104->setFormValue($objForm->GetValue("x_f20171104"));
		}
		if (!$this->f20171105->FldIsDetailKey) {
			$this->f20171105->setFormValue($objForm->GetValue("x_f20171105"));
		}
		if (!$this->f20171106->FldIsDetailKey) {
			$this->f20171106->setFormValue($objForm->GetValue("x_f20171106"));
		}
		if (!$this->f20171107->FldIsDetailKey) {
			$this->f20171107->setFormValue($objForm->GetValue("x_f20171107"));
		}
		if (!$this->f20171108->FldIsDetailKey) {
			$this->f20171108->setFormValue($objForm->GetValue("x_f20171108"));
		}
		if (!$this->f20171109->FldIsDetailKey) {
			$this->f20171109->setFormValue($objForm->GetValue("x_f20171109"));
		}
		if (!$this->f20171110->FldIsDetailKey) {
			$this->f20171110->setFormValue($objForm->GetValue("x_f20171110"));
		}
		if (!$this->f20171111->FldIsDetailKey) {
			$this->f20171111->setFormValue($objForm->GetValue("x_f20171111"));
		}
		if (!$this->f20171112->FldIsDetailKey) {
			$this->f20171112->setFormValue($objForm->GetValue("x_f20171112"));
		}
		if (!$this->f20171113->FldIsDetailKey) {
			$this->f20171113->setFormValue($objForm->GetValue("x_f20171113"));
		}
		if (!$this->f20171114->FldIsDetailKey) {
			$this->f20171114->setFormValue($objForm->GetValue("x_f20171114"));
		}
		if (!$this->f20171115->FldIsDetailKey) {
			$this->f20171115->setFormValue($objForm->GetValue("x_f20171115"));
		}
		if (!$this->f20171116->FldIsDetailKey) {
			$this->f20171116->setFormValue($objForm->GetValue("x_f20171116"));
		}
		if (!$this->f20171117->FldIsDetailKey) {
			$this->f20171117->setFormValue($objForm->GetValue("x_f20171117"));
		}
		if (!$this->f20171118->FldIsDetailKey) {
			$this->f20171118->setFormValue($objForm->GetValue("x_f20171118"));
		}
		if (!$this->f20171119->FldIsDetailKey) {
			$this->f20171119->setFormValue($objForm->GetValue("x_f20171119"));
		}
		if (!$this->f20171120->FldIsDetailKey) {
			$this->f20171120->setFormValue($objForm->GetValue("x_f20171120"));
		}
		if (!$this->f20171121->FldIsDetailKey) {
			$this->f20171121->setFormValue($objForm->GetValue("x_f20171121"));
		}
		if (!$this->f20171122->FldIsDetailKey) {
			$this->f20171122->setFormValue($objForm->GetValue("x_f20171122"));
		}
		if (!$this->f20171123->FldIsDetailKey) {
			$this->f20171123->setFormValue($objForm->GetValue("x_f20171123"));
		}
		if (!$this->f20171124->FldIsDetailKey) {
			$this->f20171124->setFormValue($objForm->GetValue("x_f20171124"));
		}
		if (!$this->f20171125->FldIsDetailKey) {
			$this->f20171125->setFormValue($objForm->GetValue("x_f20171125"));
		}
		if (!$this->f20171126->FldIsDetailKey) {
			$this->f20171126->setFormValue($objForm->GetValue("x_f20171126"));
		}
		if (!$this->f20171127->FldIsDetailKey) {
			$this->f20171127->setFormValue($objForm->GetValue("x_f20171127"));
		}
		if (!$this->f20171128->FldIsDetailKey) {
			$this->f20171128->setFormValue($objForm->GetValue("x_f20171128"));
		}
		if (!$this->f20171129->FldIsDetailKey) {
			$this->f20171129->setFormValue($objForm->GetValue("x_f20171129"));
		}
		if (!$this->f20171130->FldIsDetailKey) {
			$this->f20171130->setFormValue($objForm->GetValue("x_f20171130"));
		}
		if (!$this->f20171201->FldIsDetailKey) {
			$this->f20171201->setFormValue($objForm->GetValue("x_f20171201"));
		}
		if (!$this->f20171202->FldIsDetailKey) {
			$this->f20171202->setFormValue($objForm->GetValue("x_f20171202"));
		}
		if (!$this->f20171203->FldIsDetailKey) {
			$this->f20171203->setFormValue($objForm->GetValue("x_f20171203"));
		}
		if (!$this->f20171204->FldIsDetailKey) {
			$this->f20171204->setFormValue($objForm->GetValue("x_f20171204"));
		}
		if (!$this->f20171205->FldIsDetailKey) {
			$this->f20171205->setFormValue($objForm->GetValue("x_f20171205"));
		}
		if (!$this->f20171206->FldIsDetailKey) {
			$this->f20171206->setFormValue($objForm->GetValue("x_f20171206"));
		}
		if (!$this->f20171207->FldIsDetailKey) {
			$this->f20171207->setFormValue($objForm->GetValue("x_f20171207"));
		}
		if (!$this->f20171208->FldIsDetailKey) {
			$this->f20171208->setFormValue($objForm->GetValue("x_f20171208"));
		}
		if (!$this->f20171209->FldIsDetailKey) {
			$this->f20171209->setFormValue($objForm->GetValue("x_f20171209"));
		}
		if (!$this->f20171210->FldIsDetailKey) {
			$this->f20171210->setFormValue($objForm->GetValue("x_f20171210"));
		}
		if (!$this->f20171211->FldIsDetailKey) {
			$this->f20171211->setFormValue($objForm->GetValue("x_f20171211"));
		}
		if (!$this->f20171212->FldIsDetailKey) {
			$this->f20171212->setFormValue($objForm->GetValue("x_f20171212"));
		}
		if (!$this->f20171213->FldIsDetailKey) {
			$this->f20171213->setFormValue($objForm->GetValue("x_f20171213"));
		}
		if (!$this->f20171214->FldIsDetailKey) {
			$this->f20171214->setFormValue($objForm->GetValue("x_f20171214"));
		}
		if (!$this->f20171215->FldIsDetailKey) {
			$this->f20171215->setFormValue($objForm->GetValue("x_f20171215"));
		}
		if (!$this->f20171216->FldIsDetailKey) {
			$this->f20171216->setFormValue($objForm->GetValue("x_f20171216"));
		}
		if (!$this->f20171217->FldIsDetailKey) {
			$this->f20171217->setFormValue($objForm->GetValue("x_f20171217"));
		}
		if (!$this->f20171218->FldIsDetailKey) {
			$this->f20171218->setFormValue($objForm->GetValue("x_f20171218"));
		}
		if (!$this->f20171219->FldIsDetailKey) {
			$this->f20171219->setFormValue($objForm->GetValue("x_f20171219"));
		}
		if (!$this->f20171220->FldIsDetailKey) {
			$this->f20171220->setFormValue($objForm->GetValue("x_f20171220"));
		}
		if (!$this->f20171221->FldIsDetailKey) {
			$this->f20171221->setFormValue($objForm->GetValue("x_f20171221"));
		}
		if (!$this->f20171222->FldIsDetailKey) {
			$this->f20171222->setFormValue($objForm->GetValue("x_f20171222"));
		}
		if (!$this->f20171223->FldIsDetailKey) {
			$this->f20171223->setFormValue($objForm->GetValue("x_f20171223"));
		}
		if (!$this->f20171224->FldIsDetailKey) {
			$this->f20171224->setFormValue($objForm->GetValue("x_f20171224"));
		}
		if (!$this->f20171225->FldIsDetailKey) {
			$this->f20171225->setFormValue($objForm->GetValue("x_f20171225"));
		}
		if (!$this->f20171226->FldIsDetailKey) {
			$this->f20171226->setFormValue($objForm->GetValue("x_f20171226"));
		}
		if (!$this->f20171227->FldIsDetailKey) {
			$this->f20171227->setFormValue($objForm->GetValue("x_f20171227"));
		}
		if (!$this->f20171228->FldIsDetailKey) {
			$this->f20171228->setFormValue($objForm->GetValue("x_f20171228"));
		}
		if (!$this->f20171229->FldIsDetailKey) {
			$this->f20171229->setFormValue($objForm->GetValue("x_f20171229"));
		}
		if (!$this->f20171230->FldIsDetailKey) {
			$this->f20171230->setFormValue($objForm->GetValue("x_f20171230"));
		}
		if (!$this->f20171231->FldIsDetailKey) {
			$this->f20171231->setFormValue($objForm->GetValue("x_f20171231"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadOldRecord();
		$this->pegawai_id->CurrentValue = $this->pegawai_id->FormValue;
		$this->f20170101->CurrentValue = $this->f20170101->FormValue;
		$this->f20170102->CurrentValue = $this->f20170102->FormValue;
		$this->f20170103->CurrentValue = $this->f20170103->FormValue;
		$this->f20170104->CurrentValue = $this->f20170104->FormValue;
		$this->f20170105->CurrentValue = $this->f20170105->FormValue;
		$this->f20170106->CurrentValue = $this->f20170106->FormValue;
		$this->f20170107->CurrentValue = $this->f20170107->FormValue;
		$this->f20170108->CurrentValue = $this->f20170108->FormValue;
		$this->f20170109->CurrentValue = $this->f20170109->FormValue;
		$this->f20170110->CurrentValue = $this->f20170110->FormValue;
		$this->f20170111->CurrentValue = $this->f20170111->FormValue;
		$this->f20170112->CurrentValue = $this->f20170112->FormValue;
		$this->f20170113->CurrentValue = $this->f20170113->FormValue;
		$this->f20170114->CurrentValue = $this->f20170114->FormValue;
		$this->f20170115->CurrentValue = $this->f20170115->FormValue;
		$this->f20170116->CurrentValue = $this->f20170116->FormValue;
		$this->f20170117->CurrentValue = $this->f20170117->FormValue;
		$this->f20170118->CurrentValue = $this->f20170118->FormValue;
		$this->f20170119->CurrentValue = $this->f20170119->FormValue;
		$this->f20170120->CurrentValue = $this->f20170120->FormValue;
		$this->f20170121->CurrentValue = $this->f20170121->FormValue;
		$this->f20170122->CurrentValue = $this->f20170122->FormValue;
		$this->f20170123->CurrentValue = $this->f20170123->FormValue;
		$this->f20170124->CurrentValue = $this->f20170124->FormValue;
		$this->f20170125->CurrentValue = $this->f20170125->FormValue;
		$this->f20170126->CurrentValue = $this->f20170126->FormValue;
		$this->f20170127->CurrentValue = $this->f20170127->FormValue;
		$this->f20170128->CurrentValue = $this->f20170128->FormValue;
		$this->f20170129->CurrentValue = $this->f20170129->FormValue;
		$this->f20170130->CurrentValue = $this->f20170130->FormValue;
		$this->f20170131->CurrentValue = $this->f20170131->FormValue;
		$this->f20170201->CurrentValue = $this->f20170201->FormValue;
		$this->f20170202->CurrentValue = $this->f20170202->FormValue;
		$this->f20170203->CurrentValue = $this->f20170203->FormValue;
		$this->f20170204->CurrentValue = $this->f20170204->FormValue;
		$this->f20170205->CurrentValue = $this->f20170205->FormValue;
		$this->f20170206->CurrentValue = $this->f20170206->FormValue;
		$this->f20170207->CurrentValue = $this->f20170207->FormValue;
		$this->f20170208->CurrentValue = $this->f20170208->FormValue;
		$this->f20170209->CurrentValue = $this->f20170209->FormValue;
		$this->f20170210->CurrentValue = $this->f20170210->FormValue;
		$this->f20170211->CurrentValue = $this->f20170211->FormValue;
		$this->f20170212->CurrentValue = $this->f20170212->FormValue;
		$this->f20170213->CurrentValue = $this->f20170213->FormValue;
		$this->f20170214->CurrentValue = $this->f20170214->FormValue;
		$this->f20170215->CurrentValue = $this->f20170215->FormValue;
		$this->f20170216->CurrentValue = $this->f20170216->FormValue;
		$this->f20170217->CurrentValue = $this->f20170217->FormValue;
		$this->f20170218->CurrentValue = $this->f20170218->FormValue;
		$this->f20170219->CurrentValue = $this->f20170219->FormValue;
		$this->f20170220->CurrentValue = $this->f20170220->FormValue;
		$this->f20170221->CurrentValue = $this->f20170221->FormValue;
		$this->f20170222->CurrentValue = $this->f20170222->FormValue;
		$this->f20170223->CurrentValue = $this->f20170223->FormValue;
		$this->f20170224->CurrentValue = $this->f20170224->FormValue;
		$this->f20170225->CurrentValue = $this->f20170225->FormValue;
		$this->f20170226->CurrentValue = $this->f20170226->FormValue;
		$this->f20170227->CurrentValue = $this->f20170227->FormValue;
		$this->f20170228->CurrentValue = $this->f20170228->FormValue;
		$this->f20170229->CurrentValue = $this->f20170229->FormValue;
		$this->f20170301->CurrentValue = $this->f20170301->FormValue;
		$this->f20170302->CurrentValue = $this->f20170302->FormValue;
		$this->f20170303->CurrentValue = $this->f20170303->FormValue;
		$this->f20170304->CurrentValue = $this->f20170304->FormValue;
		$this->f20170305->CurrentValue = $this->f20170305->FormValue;
		$this->f20170306->CurrentValue = $this->f20170306->FormValue;
		$this->f20170307->CurrentValue = $this->f20170307->FormValue;
		$this->f20170308->CurrentValue = $this->f20170308->FormValue;
		$this->f20170309->CurrentValue = $this->f20170309->FormValue;
		$this->f20170310->CurrentValue = $this->f20170310->FormValue;
		$this->f20170311->CurrentValue = $this->f20170311->FormValue;
		$this->f20170312->CurrentValue = $this->f20170312->FormValue;
		$this->f20170313->CurrentValue = $this->f20170313->FormValue;
		$this->f20170314->CurrentValue = $this->f20170314->FormValue;
		$this->f20170315->CurrentValue = $this->f20170315->FormValue;
		$this->f20170316->CurrentValue = $this->f20170316->FormValue;
		$this->f20170317->CurrentValue = $this->f20170317->FormValue;
		$this->f20170318->CurrentValue = $this->f20170318->FormValue;
		$this->f20170319->CurrentValue = $this->f20170319->FormValue;
		$this->f20170320->CurrentValue = $this->f20170320->FormValue;
		$this->f20170321->CurrentValue = $this->f20170321->FormValue;
		$this->f20170322->CurrentValue = $this->f20170322->FormValue;
		$this->f20170323->CurrentValue = $this->f20170323->FormValue;
		$this->f20170324->CurrentValue = $this->f20170324->FormValue;
		$this->f20170325->CurrentValue = $this->f20170325->FormValue;
		$this->f20170326->CurrentValue = $this->f20170326->FormValue;
		$this->f20170327->CurrentValue = $this->f20170327->FormValue;
		$this->f20170328->CurrentValue = $this->f20170328->FormValue;
		$this->f20170329->CurrentValue = $this->f20170329->FormValue;
		$this->f20170330->CurrentValue = $this->f20170330->FormValue;
		$this->f20170331->CurrentValue = $this->f20170331->FormValue;
		$this->f20170401->CurrentValue = $this->f20170401->FormValue;
		$this->f20170402->CurrentValue = $this->f20170402->FormValue;
		$this->f20170403->CurrentValue = $this->f20170403->FormValue;
		$this->f20170404->CurrentValue = $this->f20170404->FormValue;
		$this->f20170405->CurrentValue = $this->f20170405->FormValue;
		$this->f20170406->CurrentValue = $this->f20170406->FormValue;
		$this->f20170407->CurrentValue = $this->f20170407->FormValue;
		$this->f20170408->CurrentValue = $this->f20170408->FormValue;
		$this->f20170409->CurrentValue = $this->f20170409->FormValue;
		$this->f20170410->CurrentValue = $this->f20170410->FormValue;
		$this->f20170411->CurrentValue = $this->f20170411->FormValue;
		$this->f20170412->CurrentValue = $this->f20170412->FormValue;
		$this->f20170413->CurrentValue = $this->f20170413->FormValue;
		$this->f20170414->CurrentValue = $this->f20170414->FormValue;
		$this->f20170415->CurrentValue = $this->f20170415->FormValue;
		$this->f20170416->CurrentValue = $this->f20170416->FormValue;
		$this->f20170417->CurrentValue = $this->f20170417->FormValue;
		$this->f20170418->CurrentValue = $this->f20170418->FormValue;
		$this->f20170419->CurrentValue = $this->f20170419->FormValue;
		$this->f20170420->CurrentValue = $this->f20170420->FormValue;
		$this->f20170421->CurrentValue = $this->f20170421->FormValue;
		$this->f20170422->CurrentValue = $this->f20170422->FormValue;
		$this->f20170423->CurrentValue = $this->f20170423->FormValue;
		$this->f20170424->CurrentValue = $this->f20170424->FormValue;
		$this->f20170425->CurrentValue = $this->f20170425->FormValue;
		$this->f20170426->CurrentValue = $this->f20170426->FormValue;
		$this->f20170427->CurrentValue = $this->f20170427->FormValue;
		$this->f20170428->CurrentValue = $this->f20170428->FormValue;
		$this->f20170429->CurrentValue = $this->f20170429->FormValue;
		$this->f20170430->CurrentValue = $this->f20170430->FormValue;
		$this->f20170501->CurrentValue = $this->f20170501->FormValue;
		$this->f20170502->CurrentValue = $this->f20170502->FormValue;
		$this->f20170503->CurrentValue = $this->f20170503->FormValue;
		$this->f20170504->CurrentValue = $this->f20170504->FormValue;
		$this->f20170505->CurrentValue = $this->f20170505->FormValue;
		$this->f20170506->CurrentValue = $this->f20170506->FormValue;
		$this->f20170507->CurrentValue = $this->f20170507->FormValue;
		$this->f20170508->CurrentValue = $this->f20170508->FormValue;
		$this->f20170509->CurrentValue = $this->f20170509->FormValue;
		$this->f20170510->CurrentValue = $this->f20170510->FormValue;
		$this->f20170511->CurrentValue = $this->f20170511->FormValue;
		$this->f20170512->CurrentValue = $this->f20170512->FormValue;
		$this->f20170513->CurrentValue = $this->f20170513->FormValue;
		$this->f20170514->CurrentValue = $this->f20170514->FormValue;
		$this->f20170515->CurrentValue = $this->f20170515->FormValue;
		$this->f20170516->CurrentValue = $this->f20170516->FormValue;
		$this->f20170517->CurrentValue = $this->f20170517->FormValue;
		$this->f20170518->CurrentValue = $this->f20170518->FormValue;
		$this->f20170519->CurrentValue = $this->f20170519->FormValue;
		$this->f20170520->CurrentValue = $this->f20170520->FormValue;
		$this->f20170521->CurrentValue = $this->f20170521->FormValue;
		$this->f20170522->CurrentValue = $this->f20170522->FormValue;
		$this->f20170523->CurrentValue = $this->f20170523->FormValue;
		$this->f20170524->CurrentValue = $this->f20170524->FormValue;
		$this->f20170525->CurrentValue = $this->f20170525->FormValue;
		$this->f20170526->CurrentValue = $this->f20170526->FormValue;
		$this->f20170527->CurrentValue = $this->f20170527->FormValue;
		$this->f20170528->CurrentValue = $this->f20170528->FormValue;
		$this->f20170529->CurrentValue = $this->f20170529->FormValue;
		$this->f20170530->CurrentValue = $this->f20170530->FormValue;
		$this->f20170531->CurrentValue = $this->f20170531->FormValue;
		$this->f20170601->CurrentValue = $this->f20170601->FormValue;
		$this->f20170602->CurrentValue = $this->f20170602->FormValue;
		$this->f20170603->CurrentValue = $this->f20170603->FormValue;
		$this->f20170604->CurrentValue = $this->f20170604->FormValue;
		$this->f20170605->CurrentValue = $this->f20170605->FormValue;
		$this->f20170606->CurrentValue = $this->f20170606->FormValue;
		$this->f20170607->CurrentValue = $this->f20170607->FormValue;
		$this->f20170608->CurrentValue = $this->f20170608->FormValue;
		$this->f20170609->CurrentValue = $this->f20170609->FormValue;
		$this->f20170610->CurrentValue = $this->f20170610->FormValue;
		$this->f20170611->CurrentValue = $this->f20170611->FormValue;
		$this->f20170612->CurrentValue = $this->f20170612->FormValue;
		$this->f20170613->CurrentValue = $this->f20170613->FormValue;
		$this->f20170614->CurrentValue = $this->f20170614->FormValue;
		$this->f20170615->CurrentValue = $this->f20170615->FormValue;
		$this->f20170616->CurrentValue = $this->f20170616->FormValue;
		$this->f20170617->CurrentValue = $this->f20170617->FormValue;
		$this->f20170618->CurrentValue = $this->f20170618->FormValue;
		$this->f20170619->CurrentValue = $this->f20170619->FormValue;
		$this->f20170620->CurrentValue = $this->f20170620->FormValue;
		$this->f20170621->CurrentValue = $this->f20170621->FormValue;
		$this->f20170622->CurrentValue = $this->f20170622->FormValue;
		$this->f20170623->CurrentValue = $this->f20170623->FormValue;
		$this->f20170624->CurrentValue = $this->f20170624->FormValue;
		$this->f20170625->CurrentValue = $this->f20170625->FormValue;
		$this->f20170626->CurrentValue = $this->f20170626->FormValue;
		$this->f20170627->CurrentValue = $this->f20170627->FormValue;
		$this->f20170628->CurrentValue = $this->f20170628->FormValue;
		$this->f20170629->CurrentValue = $this->f20170629->FormValue;
		$this->f20170630->CurrentValue = $this->f20170630->FormValue;
		$this->f20170701->CurrentValue = $this->f20170701->FormValue;
		$this->f20170702->CurrentValue = $this->f20170702->FormValue;
		$this->f20170703->CurrentValue = $this->f20170703->FormValue;
		$this->f20170704->CurrentValue = $this->f20170704->FormValue;
		$this->f20170705->CurrentValue = $this->f20170705->FormValue;
		$this->f20170706->CurrentValue = $this->f20170706->FormValue;
		$this->f20170707->CurrentValue = $this->f20170707->FormValue;
		$this->f20170708->CurrentValue = $this->f20170708->FormValue;
		$this->f20170709->CurrentValue = $this->f20170709->FormValue;
		$this->f20170710->CurrentValue = $this->f20170710->FormValue;
		$this->f20170711->CurrentValue = $this->f20170711->FormValue;
		$this->f20170712->CurrentValue = $this->f20170712->FormValue;
		$this->f20170713->CurrentValue = $this->f20170713->FormValue;
		$this->f20170714->CurrentValue = $this->f20170714->FormValue;
		$this->f20170715->CurrentValue = $this->f20170715->FormValue;
		$this->f20170716->CurrentValue = $this->f20170716->FormValue;
		$this->f20170717->CurrentValue = $this->f20170717->FormValue;
		$this->f20170718->CurrentValue = $this->f20170718->FormValue;
		$this->f20170719->CurrentValue = $this->f20170719->FormValue;
		$this->f20170720->CurrentValue = $this->f20170720->FormValue;
		$this->f20170721->CurrentValue = $this->f20170721->FormValue;
		$this->f20170722->CurrentValue = $this->f20170722->FormValue;
		$this->f20170723->CurrentValue = $this->f20170723->FormValue;
		$this->f20170724->CurrentValue = $this->f20170724->FormValue;
		$this->f20170725->CurrentValue = $this->f20170725->FormValue;
		$this->f20170726->CurrentValue = $this->f20170726->FormValue;
		$this->f20170727->CurrentValue = $this->f20170727->FormValue;
		$this->f20170728->CurrentValue = $this->f20170728->FormValue;
		$this->f20170729->CurrentValue = $this->f20170729->FormValue;
		$this->f20170730->CurrentValue = $this->f20170730->FormValue;
		$this->f20170731->CurrentValue = $this->f20170731->FormValue;
		$this->f20170801->CurrentValue = $this->f20170801->FormValue;
		$this->f20170802->CurrentValue = $this->f20170802->FormValue;
		$this->f20170803->CurrentValue = $this->f20170803->FormValue;
		$this->f20170804->CurrentValue = $this->f20170804->FormValue;
		$this->f20170805->CurrentValue = $this->f20170805->FormValue;
		$this->f20170806->CurrentValue = $this->f20170806->FormValue;
		$this->f20170807->CurrentValue = $this->f20170807->FormValue;
		$this->f20170808->CurrentValue = $this->f20170808->FormValue;
		$this->f20170809->CurrentValue = $this->f20170809->FormValue;
		$this->f20170810->CurrentValue = $this->f20170810->FormValue;
		$this->f20170811->CurrentValue = $this->f20170811->FormValue;
		$this->f20170812->CurrentValue = $this->f20170812->FormValue;
		$this->f20170813->CurrentValue = $this->f20170813->FormValue;
		$this->f20170814->CurrentValue = $this->f20170814->FormValue;
		$this->f20170815->CurrentValue = $this->f20170815->FormValue;
		$this->f20170816->CurrentValue = $this->f20170816->FormValue;
		$this->f20170817->CurrentValue = $this->f20170817->FormValue;
		$this->f20170818->CurrentValue = $this->f20170818->FormValue;
		$this->f20170819->CurrentValue = $this->f20170819->FormValue;
		$this->f20170820->CurrentValue = $this->f20170820->FormValue;
		$this->f20170821->CurrentValue = $this->f20170821->FormValue;
		$this->f20170822->CurrentValue = $this->f20170822->FormValue;
		$this->f20170823->CurrentValue = $this->f20170823->FormValue;
		$this->f20170824->CurrentValue = $this->f20170824->FormValue;
		$this->f20170825->CurrentValue = $this->f20170825->FormValue;
		$this->f20170826->CurrentValue = $this->f20170826->FormValue;
		$this->f20170827->CurrentValue = $this->f20170827->FormValue;
		$this->f20170828->CurrentValue = $this->f20170828->FormValue;
		$this->f20170829->CurrentValue = $this->f20170829->FormValue;
		$this->f20170830->CurrentValue = $this->f20170830->FormValue;
		$this->f20170831->CurrentValue = $this->f20170831->FormValue;
		$this->f20170901->CurrentValue = $this->f20170901->FormValue;
		$this->f20170902->CurrentValue = $this->f20170902->FormValue;
		$this->f20170903->CurrentValue = $this->f20170903->FormValue;
		$this->f20170904->CurrentValue = $this->f20170904->FormValue;
		$this->f20170905->CurrentValue = $this->f20170905->FormValue;
		$this->f20170906->CurrentValue = $this->f20170906->FormValue;
		$this->f20170907->CurrentValue = $this->f20170907->FormValue;
		$this->f20170908->CurrentValue = $this->f20170908->FormValue;
		$this->f20170909->CurrentValue = $this->f20170909->FormValue;
		$this->f20170910->CurrentValue = $this->f20170910->FormValue;
		$this->f20170911->CurrentValue = $this->f20170911->FormValue;
		$this->f20170912->CurrentValue = $this->f20170912->FormValue;
		$this->f20170913->CurrentValue = $this->f20170913->FormValue;
		$this->f20170914->CurrentValue = $this->f20170914->FormValue;
		$this->f20170915->CurrentValue = $this->f20170915->FormValue;
		$this->f20170916->CurrentValue = $this->f20170916->FormValue;
		$this->f20170917->CurrentValue = $this->f20170917->FormValue;
		$this->f20170918->CurrentValue = $this->f20170918->FormValue;
		$this->f20170919->CurrentValue = $this->f20170919->FormValue;
		$this->f20170920->CurrentValue = $this->f20170920->FormValue;
		$this->f20170921->CurrentValue = $this->f20170921->FormValue;
		$this->f20170922->CurrentValue = $this->f20170922->FormValue;
		$this->f20170923->CurrentValue = $this->f20170923->FormValue;
		$this->f20170924->CurrentValue = $this->f20170924->FormValue;
		$this->f20170925->CurrentValue = $this->f20170925->FormValue;
		$this->f20170926->CurrentValue = $this->f20170926->FormValue;
		$this->f20170927->CurrentValue = $this->f20170927->FormValue;
		$this->f20170928->CurrentValue = $this->f20170928->FormValue;
		$this->f20170929->CurrentValue = $this->f20170929->FormValue;
		$this->f20170930->CurrentValue = $this->f20170930->FormValue;
		$this->f20171001->CurrentValue = $this->f20171001->FormValue;
		$this->f20171002->CurrentValue = $this->f20171002->FormValue;
		$this->f20171003->CurrentValue = $this->f20171003->FormValue;
		$this->f20171004->CurrentValue = $this->f20171004->FormValue;
		$this->f20171005->CurrentValue = $this->f20171005->FormValue;
		$this->f20171006->CurrentValue = $this->f20171006->FormValue;
		$this->f20171007->CurrentValue = $this->f20171007->FormValue;
		$this->f20171008->CurrentValue = $this->f20171008->FormValue;
		$this->f20171009->CurrentValue = $this->f20171009->FormValue;
		$this->f20171010->CurrentValue = $this->f20171010->FormValue;
		$this->f20171011->CurrentValue = $this->f20171011->FormValue;
		$this->f20171012->CurrentValue = $this->f20171012->FormValue;
		$this->f20171013->CurrentValue = $this->f20171013->FormValue;
		$this->f20171014->CurrentValue = $this->f20171014->FormValue;
		$this->f20171015->CurrentValue = $this->f20171015->FormValue;
		$this->f20171016->CurrentValue = $this->f20171016->FormValue;
		$this->f20171017->CurrentValue = $this->f20171017->FormValue;
		$this->f20171018->CurrentValue = $this->f20171018->FormValue;
		$this->f20171019->CurrentValue = $this->f20171019->FormValue;
		$this->f20171020->CurrentValue = $this->f20171020->FormValue;
		$this->f20171021->CurrentValue = $this->f20171021->FormValue;
		$this->f20171022->CurrentValue = $this->f20171022->FormValue;
		$this->f20171023->CurrentValue = $this->f20171023->FormValue;
		$this->f20171024->CurrentValue = $this->f20171024->FormValue;
		$this->f20171025->CurrentValue = $this->f20171025->FormValue;
		$this->f20171026->CurrentValue = $this->f20171026->FormValue;
		$this->f20171027->CurrentValue = $this->f20171027->FormValue;
		$this->f20171028->CurrentValue = $this->f20171028->FormValue;
		$this->f20171029->CurrentValue = $this->f20171029->FormValue;
		$this->f20171030->CurrentValue = $this->f20171030->FormValue;
		$this->f20171031->CurrentValue = $this->f20171031->FormValue;
		$this->f20171101->CurrentValue = $this->f20171101->FormValue;
		$this->f20171102->CurrentValue = $this->f20171102->FormValue;
		$this->f20171103->CurrentValue = $this->f20171103->FormValue;
		$this->f20171104->CurrentValue = $this->f20171104->FormValue;
		$this->f20171105->CurrentValue = $this->f20171105->FormValue;
		$this->f20171106->CurrentValue = $this->f20171106->FormValue;
		$this->f20171107->CurrentValue = $this->f20171107->FormValue;
		$this->f20171108->CurrentValue = $this->f20171108->FormValue;
		$this->f20171109->CurrentValue = $this->f20171109->FormValue;
		$this->f20171110->CurrentValue = $this->f20171110->FormValue;
		$this->f20171111->CurrentValue = $this->f20171111->FormValue;
		$this->f20171112->CurrentValue = $this->f20171112->FormValue;
		$this->f20171113->CurrentValue = $this->f20171113->FormValue;
		$this->f20171114->CurrentValue = $this->f20171114->FormValue;
		$this->f20171115->CurrentValue = $this->f20171115->FormValue;
		$this->f20171116->CurrentValue = $this->f20171116->FormValue;
		$this->f20171117->CurrentValue = $this->f20171117->FormValue;
		$this->f20171118->CurrentValue = $this->f20171118->FormValue;
		$this->f20171119->CurrentValue = $this->f20171119->FormValue;
		$this->f20171120->CurrentValue = $this->f20171120->FormValue;
		$this->f20171121->CurrentValue = $this->f20171121->FormValue;
		$this->f20171122->CurrentValue = $this->f20171122->FormValue;
		$this->f20171123->CurrentValue = $this->f20171123->FormValue;
		$this->f20171124->CurrentValue = $this->f20171124->FormValue;
		$this->f20171125->CurrentValue = $this->f20171125->FormValue;
		$this->f20171126->CurrentValue = $this->f20171126->FormValue;
		$this->f20171127->CurrentValue = $this->f20171127->FormValue;
		$this->f20171128->CurrentValue = $this->f20171128->FormValue;
		$this->f20171129->CurrentValue = $this->f20171129->FormValue;
		$this->f20171130->CurrentValue = $this->f20171130->FormValue;
		$this->f20171201->CurrentValue = $this->f20171201->FormValue;
		$this->f20171202->CurrentValue = $this->f20171202->FormValue;
		$this->f20171203->CurrentValue = $this->f20171203->FormValue;
		$this->f20171204->CurrentValue = $this->f20171204->FormValue;
		$this->f20171205->CurrentValue = $this->f20171205->FormValue;
		$this->f20171206->CurrentValue = $this->f20171206->FormValue;
		$this->f20171207->CurrentValue = $this->f20171207->FormValue;
		$this->f20171208->CurrentValue = $this->f20171208->FormValue;
		$this->f20171209->CurrentValue = $this->f20171209->FormValue;
		$this->f20171210->CurrentValue = $this->f20171210->FormValue;
		$this->f20171211->CurrentValue = $this->f20171211->FormValue;
		$this->f20171212->CurrentValue = $this->f20171212->FormValue;
		$this->f20171213->CurrentValue = $this->f20171213->FormValue;
		$this->f20171214->CurrentValue = $this->f20171214->FormValue;
		$this->f20171215->CurrentValue = $this->f20171215->FormValue;
		$this->f20171216->CurrentValue = $this->f20171216->FormValue;
		$this->f20171217->CurrentValue = $this->f20171217->FormValue;
		$this->f20171218->CurrentValue = $this->f20171218->FormValue;
		$this->f20171219->CurrentValue = $this->f20171219->FormValue;
		$this->f20171220->CurrentValue = $this->f20171220->FormValue;
		$this->f20171221->CurrentValue = $this->f20171221->FormValue;
		$this->f20171222->CurrentValue = $this->f20171222->FormValue;
		$this->f20171223->CurrentValue = $this->f20171223->FormValue;
		$this->f20171224->CurrentValue = $this->f20171224->FormValue;
		$this->f20171225->CurrentValue = $this->f20171225->FormValue;
		$this->f20171226->CurrentValue = $this->f20171226->FormValue;
		$this->f20171227->CurrentValue = $this->f20171227->FormValue;
		$this->f20171228->CurrentValue = $this->f20171228->FormValue;
		$this->f20171229->CurrentValue = $this->f20171229->FormValue;
		$this->f20171230->CurrentValue = $this->f20171230->FormValue;
		$this->f20171231->CurrentValue = $this->f20171231->FormValue;
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
		$this->jdwkrjpeg_id->setDbValue($rs->fields('jdwkrjpeg_id'));
		$this->pegawai_id->setDbValue($rs->fields('pegawai_id'));
		$this->f20170101->setDbValue($rs->fields('f20170101'));
		$this->f20170102->setDbValue($rs->fields('f20170102'));
		if (array_key_exists('EV__f20170102', $rs->fields)) {
			$this->f20170102->VirtualValue = $rs->fields('EV__f20170102'); // Set up virtual field value
		} else {
			$this->f20170102->VirtualValue = ""; // Clear value
		}
		$this->f20170103->setDbValue($rs->fields('f20170103'));
		$this->f20170104->setDbValue($rs->fields('f20170104'));
		$this->f20170105->setDbValue($rs->fields('f20170105'));
		$this->f20170106->setDbValue($rs->fields('f20170106'));
		$this->f20170107->setDbValue($rs->fields('f20170107'));
		$this->f20170108->setDbValue($rs->fields('f20170108'));
		$this->f20170109->setDbValue($rs->fields('f20170109'));
		$this->f20170110->setDbValue($rs->fields('f20170110'));
		$this->f20170111->setDbValue($rs->fields('f20170111'));
		$this->f20170112->setDbValue($rs->fields('f20170112'));
		$this->f20170113->setDbValue($rs->fields('f20170113'));
		$this->f20170114->setDbValue($rs->fields('f20170114'));
		$this->f20170115->setDbValue($rs->fields('f20170115'));
		$this->f20170116->setDbValue($rs->fields('f20170116'));
		$this->f20170117->setDbValue($rs->fields('f20170117'));
		$this->f20170118->setDbValue($rs->fields('f20170118'));
		$this->f20170119->setDbValue($rs->fields('f20170119'));
		$this->f20170120->setDbValue($rs->fields('f20170120'));
		$this->f20170121->setDbValue($rs->fields('f20170121'));
		$this->f20170122->setDbValue($rs->fields('f20170122'));
		$this->f20170123->setDbValue($rs->fields('f20170123'));
		$this->f20170124->setDbValue($rs->fields('f20170124'));
		$this->f20170125->setDbValue($rs->fields('f20170125'));
		$this->f20170126->setDbValue($rs->fields('f20170126'));
		$this->f20170127->setDbValue($rs->fields('f20170127'));
		$this->f20170128->setDbValue($rs->fields('f20170128'));
		$this->f20170129->setDbValue($rs->fields('f20170129'));
		$this->f20170130->setDbValue($rs->fields('f20170130'));
		$this->f20170131->setDbValue($rs->fields('f20170131'));
		$this->f20170201->setDbValue($rs->fields('f20170201'));
		$this->f20170202->setDbValue($rs->fields('f20170202'));
		$this->f20170203->setDbValue($rs->fields('f20170203'));
		$this->f20170204->setDbValue($rs->fields('f20170204'));
		$this->f20170205->setDbValue($rs->fields('f20170205'));
		$this->f20170206->setDbValue($rs->fields('f20170206'));
		$this->f20170207->setDbValue($rs->fields('f20170207'));
		$this->f20170208->setDbValue($rs->fields('f20170208'));
		$this->f20170209->setDbValue($rs->fields('f20170209'));
		$this->f20170210->setDbValue($rs->fields('f20170210'));
		$this->f20170211->setDbValue($rs->fields('f20170211'));
		$this->f20170212->setDbValue($rs->fields('f20170212'));
		$this->f20170213->setDbValue($rs->fields('f20170213'));
		$this->f20170214->setDbValue($rs->fields('f20170214'));
		$this->f20170215->setDbValue($rs->fields('f20170215'));
		$this->f20170216->setDbValue($rs->fields('f20170216'));
		$this->f20170217->setDbValue($rs->fields('f20170217'));
		$this->f20170218->setDbValue($rs->fields('f20170218'));
		$this->f20170219->setDbValue($rs->fields('f20170219'));
		$this->f20170220->setDbValue($rs->fields('f20170220'));
		$this->f20170221->setDbValue($rs->fields('f20170221'));
		$this->f20170222->setDbValue($rs->fields('f20170222'));
		$this->f20170223->setDbValue($rs->fields('f20170223'));
		$this->f20170224->setDbValue($rs->fields('f20170224'));
		$this->f20170225->setDbValue($rs->fields('f20170225'));
		$this->f20170226->setDbValue($rs->fields('f20170226'));
		$this->f20170227->setDbValue($rs->fields('f20170227'));
		$this->f20170228->setDbValue($rs->fields('f20170228'));
		$this->f20170229->setDbValue($rs->fields('f20170229'));
		$this->f20170301->setDbValue($rs->fields('f20170301'));
		$this->f20170302->setDbValue($rs->fields('f20170302'));
		$this->f20170303->setDbValue($rs->fields('f20170303'));
		$this->f20170304->setDbValue($rs->fields('f20170304'));
		$this->f20170305->setDbValue($rs->fields('f20170305'));
		$this->f20170306->setDbValue($rs->fields('f20170306'));
		$this->f20170307->setDbValue($rs->fields('f20170307'));
		$this->f20170308->setDbValue($rs->fields('f20170308'));
		$this->f20170309->setDbValue($rs->fields('f20170309'));
		$this->f20170310->setDbValue($rs->fields('f20170310'));
		$this->f20170311->setDbValue($rs->fields('f20170311'));
		$this->f20170312->setDbValue($rs->fields('f20170312'));
		$this->f20170313->setDbValue($rs->fields('f20170313'));
		$this->f20170314->setDbValue($rs->fields('f20170314'));
		$this->f20170315->setDbValue($rs->fields('f20170315'));
		$this->f20170316->setDbValue($rs->fields('f20170316'));
		$this->f20170317->setDbValue($rs->fields('f20170317'));
		$this->f20170318->setDbValue($rs->fields('f20170318'));
		$this->f20170319->setDbValue($rs->fields('f20170319'));
		$this->f20170320->setDbValue($rs->fields('f20170320'));
		$this->f20170321->setDbValue($rs->fields('f20170321'));
		$this->f20170322->setDbValue($rs->fields('f20170322'));
		$this->f20170323->setDbValue($rs->fields('f20170323'));
		$this->f20170324->setDbValue($rs->fields('f20170324'));
		$this->f20170325->setDbValue($rs->fields('f20170325'));
		$this->f20170326->setDbValue($rs->fields('f20170326'));
		$this->f20170327->setDbValue($rs->fields('f20170327'));
		$this->f20170328->setDbValue($rs->fields('f20170328'));
		$this->f20170329->setDbValue($rs->fields('f20170329'));
		$this->f20170330->setDbValue($rs->fields('f20170330'));
		$this->f20170331->setDbValue($rs->fields('f20170331'));
		$this->f20170401->setDbValue($rs->fields('f20170401'));
		$this->f20170402->setDbValue($rs->fields('f20170402'));
		$this->f20170403->setDbValue($rs->fields('f20170403'));
		$this->f20170404->setDbValue($rs->fields('f20170404'));
		$this->f20170405->setDbValue($rs->fields('f20170405'));
		$this->f20170406->setDbValue($rs->fields('f20170406'));
		$this->f20170407->setDbValue($rs->fields('f20170407'));
		$this->f20170408->setDbValue($rs->fields('f20170408'));
		$this->f20170409->setDbValue($rs->fields('f20170409'));
		$this->f20170410->setDbValue($rs->fields('f20170410'));
		$this->f20170411->setDbValue($rs->fields('f20170411'));
		$this->f20170412->setDbValue($rs->fields('f20170412'));
		$this->f20170413->setDbValue($rs->fields('f20170413'));
		$this->f20170414->setDbValue($rs->fields('f20170414'));
		$this->f20170415->setDbValue($rs->fields('f20170415'));
		$this->f20170416->setDbValue($rs->fields('f20170416'));
		$this->f20170417->setDbValue($rs->fields('f20170417'));
		$this->f20170418->setDbValue($rs->fields('f20170418'));
		$this->f20170419->setDbValue($rs->fields('f20170419'));
		$this->f20170420->setDbValue($rs->fields('f20170420'));
		$this->f20170421->setDbValue($rs->fields('f20170421'));
		$this->f20170422->setDbValue($rs->fields('f20170422'));
		$this->f20170423->setDbValue($rs->fields('f20170423'));
		$this->f20170424->setDbValue($rs->fields('f20170424'));
		$this->f20170425->setDbValue($rs->fields('f20170425'));
		$this->f20170426->setDbValue($rs->fields('f20170426'));
		$this->f20170427->setDbValue($rs->fields('f20170427'));
		$this->f20170428->setDbValue($rs->fields('f20170428'));
		$this->f20170429->setDbValue($rs->fields('f20170429'));
		$this->f20170430->setDbValue($rs->fields('f20170430'));
		$this->f20170501->setDbValue($rs->fields('f20170501'));
		$this->f20170502->setDbValue($rs->fields('f20170502'));
		$this->f20170503->setDbValue($rs->fields('f20170503'));
		$this->f20170504->setDbValue($rs->fields('f20170504'));
		$this->f20170505->setDbValue($rs->fields('f20170505'));
		$this->f20170506->setDbValue($rs->fields('f20170506'));
		$this->f20170507->setDbValue($rs->fields('f20170507'));
		$this->f20170508->setDbValue($rs->fields('f20170508'));
		$this->f20170509->setDbValue($rs->fields('f20170509'));
		$this->f20170510->setDbValue($rs->fields('f20170510'));
		$this->f20170511->setDbValue($rs->fields('f20170511'));
		$this->f20170512->setDbValue($rs->fields('f20170512'));
		$this->f20170513->setDbValue($rs->fields('f20170513'));
		$this->f20170514->setDbValue($rs->fields('f20170514'));
		$this->f20170515->setDbValue($rs->fields('f20170515'));
		$this->f20170516->setDbValue($rs->fields('f20170516'));
		$this->f20170517->setDbValue($rs->fields('f20170517'));
		$this->f20170518->setDbValue($rs->fields('f20170518'));
		$this->f20170519->setDbValue($rs->fields('f20170519'));
		$this->f20170520->setDbValue($rs->fields('f20170520'));
		$this->f20170521->setDbValue($rs->fields('f20170521'));
		$this->f20170522->setDbValue($rs->fields('f20170522'));
		$this->f20170523->setDbValue($rs->fields('f20170523'));
		$this->f20170524->setDbValue($rs->fields('f20170524'));
		$this->f20170525->setDbValue($rs->fields('f20170525'));
		$this->f20170526->setDbValue($rs->fields('f20170526'));
		$this->f20170527->setDbValue($rs->fields('f20170527'));
		$this->f20170528->setDbValue($rs->fields('f20170528'));
		$this->f20170529->setDbValue($rs->fields('f20170529'));
		$this->f20170530->setDbValue($rs->fields('f20170530'));
		$this->f20170531->setDbValue($rs->fields('f20170531'));
		$this->f20170601->setDbValue($rs->fields('f20170601'));
		$this->f20170602->setDbValue($rs->fields('f20170602'));
		$this->f20170603->setDbValue($rs->fields('f20170603'));
		$this->f20170604->setDbValue($rs->fields('f20170604'));
		$this->f20170605->setDbValue($rs->fields('f20170605'));
		$this->f20170606->setDbValue($rs->fields('f20170606'));
		$this->f20170607->setDbValue($rs->fields('f20170607'));
		$this->f20170608->setDbValue($rs->fields('f20170608'));
		$this->f20170609->setDbValue($rs->fields('f20170609'));
		$this->f20170610->setDbValue($rs->fields('f20170610'));
		$this->f20170611->setDbValue($rs->fields('f20170611'));
		$this->f20170612->setDbValue($rs->fields('f20170612'));
		$this->f20170613->setDbValue($rs->fields('f20170613'));
		$this->f20170614->setDbValue($rs->fields('f20170614'));
		$this->f20170615->setDbValue($rs->fields('f20170615'));
		$this->f20170616->setDbValue($rs->fields('f20170616'));
		$this->f20170617->setDbValue($rs->fields('f20170617'));
		$this->f20170618->setDbValue($rs->fields('f20170618'));
		$this->f20170619->setDbValue($rs->fields('f20170619'));
		$this->f20170620->setDbValue($rs->fields('f20170620'));
		$this->f20170621->setDbValue($rs->fields('f20170621'));
		$this->f20170622->setDbValue($rs->fields('f20170622'));
		$this->f20170623->setDbValue($rs->fields('f20170623'));
		$this->f20170624->setDbValue($rs->fields('f20170624'));
		$this->f20170625->setDbValue($rs->fields('f20170625'));
		$this->f20170626->setDbValue($rs->fields('f20170626'));
		$this->f20170627->setDbValue($rs->fields('f20170627'));
		$this->f20170628->setDbValue($rs->fields('f20170628'));
		$this->f20170629->setDbValue($rs->fields('f20170629'));
		$this->f20170630->setDbValue($rs->fields('f20170630'));
		$this->f20170701->setDbValue($rs->fields('f20170701'));
		$this->f20170702->setDbValue($rs->fields('f20170702'));
		$this->f20170703->setDbValue($rs->fields('f20170703'));
		$this->f20170704->setDbValue($rs->fields('f20170704'));
		$this->f20170705->setDbValue($rs->fields('f20170705'));
		$this->f20170706->setDbValue($rs->fields('f20170706'));
		$this->f20170707->setDbValue($rs->fields('f20170707'));
		$this->f20170708->setDbValue($rs->fields('f20170708'));
		$this->f20170709->setDbValue($rs->fields('f20170709'));
		$this->f20170710->setDbValue($rs->fields('f20170710'));
		$this->f20170711->setDbValue($rs->fields('f20170711'));
		$this->f20170712->setDbValue($rs->fields('f20170712'));
		$this->f20170713->setDbValue($rs->fields('f20170713'));
		$this->f20170714->setDbValue($rs->fields('f20170714'));
		$this->f20170715->setDbValue($rs->fields('f20170715'));
		$this->f20170716->setDbValue($rs->fields('f20170716'));
		$this->f20170717->setDbValue($rs->fields('f20170717'));
		$this->f20170718->setDbValue($rs->fields('f20170718'));
		$this->f20170719->setDbValue($rs->fields('f20170719'));
		$this->f20170720->setDbValue($rs->fields('f20170720'));
		$this->f20170721->setDbValue($rs->fields('f20170721'));
		$this->f20170722->setDbValue($rs->fields('f20170722'));
		$this->f20170723->setDbValue($rs->fields('f20170723'));
		$this->f20170724->setDbValue($rs->fields('f20170724'));
		$this->f20170725->setDbValue($rs->fields('f20170725'));
		$this->f20170726->setDbValue($rs->fields('f20170726'));
		$this->f20170727->setDbValue($rs->fields('f20170727'));
		$this->f20170728->setDbValue($rs->fields('f20170728'));
		$this->f20170729->setDbValue($rs->fields('f20170729'));
		$this->f20170730->setDbValue($rs->fields('f20170730'));
		$this->f20170731->setDbValue($rs->fields('f20170731'));
		$this->f20170801->setDbValue($rs->fields('f20170801'));
		$this->f20170802->setDbValue($rs->fields('f20170802'));
		$this->f20170803->setDbValue($rs->fields('f20170803'));
		$this->f20170804->setDbValue($rs->fields('f20170804'));
		$this->f20170805->setDbValue($rs->fields('f20170805'));
		$this->f20170806->setDbValue($rs->fields('f20170806'));
		$this->f20170807->setDbValue($rs->fields('f20170807'));
		$this->f20170808->setDbValue($rs->fields('f20170808'));
		$this->f20170809->setDbValue($rs->fields('f20170809'));
		$this->f20170810->setDbValue($rs->fields('f20170810'));
		$this->f20170811->setDbValue($rs->fields('f20170811'));
		$this->f20170812->setDbValue($rs->fields('f20170812'));
		$this->f20170813->setDbValue($rs->fields('f20170813'));
		$this->f20170814->setDbValue($rs->fields('f20170814'));
		$this->f20170815->setDbValue($rs->fields('f20170815'));
		$this->f20170816->setDbValue($rs->fields('f20170816'));
		$this->f20170817->setDbValue($rs->fields('f20170817'));
		$this->f20170818->setDbValue($rs->fields('f20170818'));
		$this->f20170819->setDbValue($rs->fields('f20170819'));
		$this->f20170820->setDbValue($rs->fields('f20170820'));
		$this->f20170821->setDbValue($rs->fields('f20170821'));
		$this->f20170822->setDbValue($rs->fields('f20170822'));
		$this->f20170823->setDbValue($rs->fields('f20170823'));
		$this->f20170824->setDbValue($rs->fields('f20170824'));
		$this->f20170825->setDbValue($rs->fields('f20170825'));
		$this->f20170826->setDbValue($rs->fields('f20170826'));
		$this->f20170827->setDbValue($rs->fields('f20170827'));
		$this->f20170828->setDbValue($rs->fields('f20170828'));
		$this->f20170829->setDbValue($rs->fields('f20170829'));
		$this->f20170830->setDbValue($rs->fields('f20170830'));
		$this->f20170831->setDbValue($rs->fields('f20170831'));
		$this->f20170901->setDbValue($rs->fields('f20170901'));
		$this->f20170902->setDbValue($rs->fields('f20170902'));
		$this->f20170903->setDbValue($rs->fields('f20170903'));
		$this->f20170904->setDbValue($rs->fields('f20170904'));
		$this->f20170905->setDbValue($rs->fields('f20170905'));
		$this->f20170906->setDbValue($rs->fields('f20170906'));
		$this->f20170907->setDbValue($rs->fields('f20170907'));
		$this->f20170908->setDbValue($rs->fields('f20170908'));
		$this->f20170909->setDbValue($rs->fields('f20170909'));
		$this->f20170910->setDbValue($rs->fields('f20170910'));
		$this->f20170911->setDbValue($rs->fields('f20170911'));
		$this->f20170912->setDbValue($rs->fields('f20170912'));
		$this->f20170913->setDbValue($rs->fields('f20170913'));
		$this->f20170914->setDbValue($rs->fields('f20170914'));
		$this->f20170915->setDbValue($rs->fields('f20170915'));
		$this->f20170916->setDbValue($rs->fields('f20170916'));
		$this->f20170917->setDbValue($rs->fields('f20170917'));
		$this->f20170918->setDbValue($rs->fields('f20170918'));
		$this->f20170919->setDbValue($rs->fields('f20170919'));
		$this->f20170920->setDbValue($rs->fields('f20170920'));
		$this->f20170921->setDbValue($rs->fields('f20170921'));
		$this->f20170922->setDbValue($rs->fields('f20170922'));
		$this->f20170923->setDbValue($rs->fields('f20170923'));
		$this->f20170924->setDbValue($rs->fields('f20170924'));
		$this->f20170925->setDbValue($rs->fields('f20170925'));
		$this->f20170926->setDbValue($rs->fields('f20170926'));
		$this->f20170927->setDbValue($rs->fields('f20170927'));
		$this->f20170928->setDbValue($rs->fields('f20170928'));
		$this->f20170929->setDbValue($rs->fields('f20170929'));
		$this->f20170930->setDbValue($rs->fields('f20170930'));
		$this->f20171001->setDbValue($rs->fields('f20171001'));
		$this->f20171002->setDbValue($rs->fields('f20171002'));
		$this->f20171003->setDbValue($rs->fields('f20171003'));
		$this->f20171004->setDbValue($rs->fields('f20171004'));
		$this->f20171005->setDbValue($rs->fields('f20171005'));
		$this->f20171006->setDbValue($rs->fields('f20171006'));
		$this->f20171007->setDbValue($rs->fields('f20171007'));
		$this->f20171008->setDbValue($rs->fields('f20171008'));
		$this->f20171009->setDbValue($rs->fields('f20171009'));
		$this->f20171010->setDbValue($rs->fields('f20171010'));
		$this->f20171011->setDbValue($rs->fields('f20171011'));
		$this->f20171012->setDbValue($rs->fields('f20171012'));
		$this->f20171013->setDbValue($rs->fields('f20171013'));
		$this->f20171014->setDbValue($rs->fields('f20171014'));
		$this->f20171015->setDbValue($rs->fields('f20171015'));
		$this->f20171016->setDbValue($rs->fields('f20171016'));
		$this->f20171017->setDbValue($rs->fields('f20171017'));
		$this->f20171018->setDbValue($rs->fields('f20171018'));
		$this->f20171019->setDbValue($rs->fields('f20171019'));
		$this->f20171020->setDbValue($rs->fields('f20171020'));
		$this->f20171021->setDbValue($rs->fields('f20171021'));
		$this->f20171022->setDbValue($rs->fields('f20171022'));
		$this->f20171023->setDbValue($rs->fields('f20171023'));
		$this->f20171024->setDbValue($rs->fields('f20171024'));
		$this->f20171025->setDbValue($rs->fields('f20171025'));
		$this->f20171026->setDbValue($rs->fields('f20171026'));
		$this->f20171027->setDbValue($rs->fields('f20171027'));
		$this->f20171028->setDbValue($rs->fields('f20171028'));
		$this->f20171029->setDbValue($rs->fields('f20171029'));
		$this->f20171030->setDbValue($rs->fields('f20171030'));
		$this->f20171031->setDbValue($rs->fields('f20171031'));
		$this->f20171101->setDbValue($rs->fields('f20171101'));
		$this->f20171102->setDbValue($rs->fields('f20171102'));
		$this->f20171103->setDbValue($rs->fields('f20171103'));
		$this->f20171104->setDbValue($rs->fields('f20171104'));
		$this->f20171105->setDbValue($rs->fields('f20171105'));
		$this->f20171106->setDbValue($rs->fields('f20171106'));
		$this->f20171107->setDbValue($rs->fields('f20171107'));
		$this->f20171108->setDbValue($rs->fields('f20171108'));
		$this->f20171109->setDbValue($rs->fields('f20171109'));
		$this->f20171110->setDbValue($rs->fields('f20171110'));
		$this->f20171111->setDbValue($rs->fields('f20171111'));
		$this->f20171112->setDbValue($rs->fields('f20171112'));
		$this->f20171113->setDbValue($rs->fields('f20171113'));
		$this->f20171114->setDbValue($rs->fields('f20171114'));
		$this->f20171115->setDbValue($rs->fields('f20171115'));
		$this->f20171116->setDbValue($rs->fields('f20171116'));
		$this->f20171117->setDbValue($rs->fields('f20171117'));
		$this->f20171118->setDbValue($rs->fields('f20171118'));
		$this->f20171119->setDbValue($rs->fields('f20171119'));
		$this->f20171120->setDbValue($rs->fields('f20171120'));
		$this->f20171121->setDbValue($rs->fields('f20171121'));
		$this->f20171122->setDbValue($rs->fields('f20171122'));
		$this->f20171123->setDbValue($rs->fields('f20171123'));
		$this->f20171124->setDbValue($rs->fields('f20171124'));
		$this->f20171125->setDbValue($rs->fields('f20171125'));
		$this->f20171126->setDbValue($rs->fields('f20171126'));
		$this->f20171127->setDbValue($rs->fields('f20171127'));
		$this->f20171128->setDbValue($rs->fields('f20171128'));
		$this->f20171129->setDbValue($rs->fields('f20171129'));
		$this->f20171130->setDbValue($rs->fields('f20171130'));
		$this->f20171201->setDbValue($rs->fields('f20171201'));
		$this->f20171202->setDbValue($rs->fields('f20171202'));
		$this->f20171203->setDbValue($rs->fields('f20171203'));
		$this->f20171204->setDbValue($rs->fields('f20171204'));
		$this->f20171205->setDbValue($rs->fields('f20171205'));
		$this->f20171206->setDbValue($rs->fields('f20171206'));
		$this->f20171207->setDbValue($rs->fields('f20171207'));
		$this->f20171208->setDbValue($rs->fields('f20171208'));
		$this->f20171209->setDbValue($rs->fields('f20171209'));
		$this->f20171210->setDbValue($rs->fields('f20171210'));
		$this->f20171211->setDbValue($rs->fields('f20171211'));
		$this->f20171212->setDbValue($rs->fields('f20171212'));
		$this->f20171213->setDbValue($rs->fields('f20171213'));
		$this->f20171214->setDbValue($rs->fields('f20171214'));
		$this->f20171215->setDbValue($rs->fields('f20171215'));
		$this->f20171216->setDbValue($rs->fields('f20171216'));
		$this->f20171217->setDbValue($rs->fields('f20171217'));
		$this->f20171218->setDbValue($rs->fields('f20171218'));
		$this->f20171219->setDbValue($rs->fields('f20171219'));
		$this->f20171220->setDbValue($rs->fields('f20171220'));
		$this->f20171221->setDbValue($rs->fields('f20171221'));
		$this->f20171222->setDbValue($rs->fields('f20171222'));
		$this->f20171223->setDbValue($rs->fields('f20171223'));
		$this->f20171224->setDbValue($rs->fields('f20171224'));
		$this->f20171225->setDbValue($rs->fields('f20171225'));
		$this->f20171226->setDbValue($rs->fields('f20171226'));
		$this->f20171227->setDbValue($rs->fields('f20171227'));
		$this->f20171228->setDbValue($rs->fields('f20171228'));
		$this->f20171229->setDbValue($rs->fields('f20171229'));
		$this->f20171230->setDbValue($rs->fields('f20171230'));
		$this->f20171231->setDbValue($rs->fields('f20171231'));
		if (array_key_exists('EV__f20171231', $rs->fields)) {
			$this->f20171231->VirtualValue = $rs->fields('EV__f20171231'); // Set up virtual field value
		} else {
			$this->f20171231->VirtualValue = ""; // Clear value
		}
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->jdwkrjpeg_id->DbValue = $row['jdwkrjpeg_id'];
		$this->pegawai_id->DbValue = $row['pegawai_id'];
		$this->f20170101->DbValue = $row['f20170101'];
		$this->f20170102->DbValue = $row['f20170102'];
		$this->f20170103->DbValue = $row['f20170103'];
		$this->f20170104->DbValue = $row['f20170104'];
		$this->f20170105->DbValue = $row['f20170105'];
		$this->f20170106->DbValue = $row['f20170106'];
		$this->f20170107->DbValue = $row['f20170107'];
		$this->f20170108->DbValue = $row['f20170108'];
		$this->f20170109->DbValue = $row['f20170109'];
		$this->f20170110->DbValue = $row['f20170110'];
		$this->f20170111->DbValue = $row['f20170111'];
		$this->f20170112->DbValue = $row['f20170112'];
		$this->f20170113->DbValue = $row['f20170113'];
		$this->f20170114->DbValue = $row['f20170114'];
		$this->f20170115->DbValue = $row['f20170115'];
		$this->f20170116->DbValue = $row['f20170116'];
		$this->f20170117->DbValue = $row['f20170117'];
		$this->f20170118->DbValue = $row['f20170118'];
		$this->f20170119->DbValue = $row['f20170119'];
		$this->f20170120->DbValue = $row['f20170120'];
		$this->f20170121->DbValue = $row['f20170121'];
		$this->f20170122->DbValue = $row['f20170122'];
		$this->f20170123->DbValue = $row['f20170123'];
		$this->f20170124->DbValue = $row['f20170124'];
		$this->f20170125->DbValue = $row['f20170125'];
		$this->f20170126->DbValue = $row['f20170126'];
		$this->f20170127->DbValue = $row['f20170127'];
		$this->f20170128->DbValue = $row['f20170128'];
		$this->f20170129->DbValue = $row['f20170129'];
		$this->f20170130->DbValue = $row['f20170130'];
		$this->f20170131->DbValue = $row['f20170131'];
		$this->f20170201->DbValue = $row['f20170201'];
		$this->f20170202->DbValue = $row['f20170202'];
		$this->f20170203->DbValue = $row['f20170203'];
		$this->f20170204->DbValue = $row['f20170204'];
		$this->f20170205->DbValue = $row['f20170205'];
		$this->f20170206->DbValue = $row['f20170206'];
		$this->f20170207->DbValue = $row['f20170207'];
		$this->f20170208->DbValue = $row['f20170208'];
		$this->f20170209->DbValue = $row['f20170209'];
		$this->f20170210->DbValue = $row['f20170210'];
		$this->f20170211->DbValue = $row['f20170211'];
		$this->f20170212->DbValue = $row['f20170212'];
		$this->f20170213->DbValue = $row['f20170213'];
		$this->f20170214->DbValue = $row['f20170214'];
		$this->f20170215->DbValue = $row['f20170215'];
		$this->f20170216->DbValue = $row['f20170216'];
		$this->f20170217->DbValue = $row['f20170217'];
		$this->f20170218->DbValue = $row['f20170218'];
		$this->f20170219->DbValue = $row['f20170219'];
		$this->f20170220->DbValue = $row['f20170220'];
		$this->f20170221->DbValue = $row['f20170221'];
		$this->f20170222->DbValue = $row['f20170222'];
		$this->f20170223->DbValue = $row['f20170223'];
		$this->f20170224->DbValue = $row['f20170224'];
		$this->f20170225->DbValue = $row['f20170225'];
		$this->f20170226->DbValue = $row['f20170226'];
		$this->f20170227->DbValue = $row['f20170227'];
		$this->f20170228->DbValue = $row['f20170228'];
		$this->f20170229->DbValue = $row['f20170229'];
		$this->f20170301->DbValue = $row['f20170301'];
		$this->f20170302->DbValue = $row['f20170302'];
		$this->f20170303->DbValue = $row['f20170303'];
		$this->f20170304->DbValue = $row['f20170304'];
		$this->f20170305->DbValue = $row['f20170305'];
		$this->f20170306->DbValue = $row['f20170306'];
		$this->f20170307->DbValue = $row['f20170307'];
		$this->f20170308->DbValue = $row['f20170308'];
		$this->f20170309->DbValue = $row['f20170309'];
		$this->f20170310->DbValue = $row['f20170310'];
		$this->f20170311->DbValue = $row['f20170311'];
		$this->f20170312->DbValue = $row['f20170312'];
		$this->f20170313->DbValue = $row['f20170313'];
		$this->f20170314->DbValue = $row['f20170314'];
		$this->f20170315->DbValue = $row['f20170315'];
		$this->f20170316->DbValue = $row['f20170316'];
		$this->f20170317->DbValue = $row['f20170317'];
		$this->f20170318->DbValue = $row['f20170318'];
		$this->f20170319->DbValue = $row['f20170319'];
		$this->f20170320->DbValue = $row['f20170320'];
		$this->f20170321->DbValue = $row['f20170321'];
		$this->f20170322->DbValue = $row['f20170322'];
		$this->f20170323->DbValue = $row['f20170323'];
		$this->f20170324->DbValue = $row['f20170324'];
		$this->f20170325->DbValue = $row['f20170325'];
		$this->f20170326->DbValue = $row['f20170326'];
		$this->f20170327->DbValue = $row['f20170327'];
		$this->f20170328->DbValue = $row['f20170328'];
		$this->f20170329->DbValue = $row['f20170329'];
		$this->f20170330->DbValue = $row['f20170330'];
		$this->f20170331->DbValue = $row['f20170331'];
		$this->f20170401->DbValue = $row['f20170401'];
		$this->f20170402->DbValue = $row['f20170402'];
		$this->f20170403->DbValue = $row['f20170403'];
		$this->f20170404->DbValue = $row['f20170404'];
		$this->f20170405->DbValue = $row['f20170405'];
		$this->f20170406->DbValue = $row['f20170406'];
		$this->f20170407->DbValue = $row['f20170407'];
		$this->f20170408->DbValue = $row['f20170408'];
		$this->f20170409->DbValue = $row['f20170409'];
		$this->f20170410->DbValue = $row['f20170410'];
		$this->f20170411->DbValue = $row['f20170411'];
		$this->f20170412->DbValue = $row['f20170412'];
		$this->f20170413->DbValue = $row['f20170413'];
		$this->f20170414->DbValue = $row['f20170414'];
		$this->f20170415->DbValue = $row['f20170415'];
		$this->f20170416->DbValue = $row['f20170416'];
		$this->f20170417->DbValue = $row['f20170417'];
		$this->f20170418->DbValue = $row['f20170418'];
		$this->f20170419->DbValue = $row['f20170419'];
		$this->f20170420->DbValue = $row['f20170420'];
		$this->f20170421->DbValue = $row['f20170421'];
		$this->f20170422->DbValue = $row['f20170422'];
		$this->f20170423->DbValue = $row['f20170423'];
		$this->f20170424->DbValue = $row['f20170424'];
		$this->f20170425->DbValue = $row['f20170425'];
		$this->f20170426->DbValue = $row['f20170426'];
		$this->f20170427->DbValue = $row['f20170427'];
		$this->f20170428->DbValue = $row['f20170428'];
		$this->f20170429->DbValue = $row['f20170429'];
		$this->f20170430->DbValue = $row['f20170430'];
		$this->f20170501->DbValue = $row['f20170501'];
		$this->f20170502->DbValue = $row['f20170502'];
		$this->f20170503->DbValue = $row['f20170503'];
		$this->f20170504->DbValue = $row['f20170504'];
		$this->f20170505->DbValue = $row['f20170505'];
		$this->f20170506->DbValue = $row['f20170506'];
		$this->f20170507->DbValue = $row['f20170507'];
		$this->f20170508->DbValue = $row['f20170508'];
		$this->f20170509->DbValue = $row['f20170509'];
		$this->f20170510->DbValue = $row['f20170510'];
		$this->f20170511->DbValue = $row['f20170511'];
		$this->f20170512->DbValue = $row['f20170512'];
		$this->f20170513->DbValue = $row['f20170513'];
		$this->f20170514->DbValue = $row['f20170514'];
		$this->f20170515->DbValue = $row['f20170515'];
		$this->f20170516->DbValue = $row['f20170516'];
		$this->f20170517->DbValue = $row['f20170517'];
		$this->f20170518->DbValue = $row['f20170518'];
		$this->f20170519->DbValue = $row['f20170519'];
		$this->f20170520->DbValue = $row['f20170520'];
		$this->f20170521->DbValue = $row['f20170521'];
		$this->f20170522->DbValue = $row['f20170522'];
		$this->f20170523->DbValue = $row['f20170523'];
		$this->f20170524->DbValue = $row['f20170524'];
		$this->f20170525->DbValue = $row['f20170525'];
		$this->f20170526->DbValue = $row['f20170526'];
		$this->f20170527->DbValue = $row['f20170527'];
		$this->f20170528->DbValue = $row['f20170528'];
		$this->f20170529->DbValue = $row['f20170529'];
		$this->f20170530->DbValue = $row['f20170530'];
		$this->f20170531->DbValue = $row['f20170531'];
		$this->f20170601->DbValue = $row['f20170601'];
		$this->f20170602->DbValue = $row['f20170602'];
		$this->f20170603->DbValue = $row['f20170603'];
		$this->f20170604->DbValue = $row['f20170604'];
		$this->f20170605->DbValue = $row['f20170605'];
		$this->f20170606->DbValue = $row['f20170606'];
		$this->f20170607->DbValue = $row['f20170607'];
		$this->f20170608->DbValue = $row['f20170608'];
		$this->f20170609->DbValue = $row['f20170609'];
		$this->f20170610->DbValue = $row['f20170610'];
		$this->f20170611->DbValue = $row['f20170611'];
		$this->f20170612->DbValue = $row['f20170612'];
		$this->f20170613->DbValue = $row['f20170613'];
		$this->f20170614->DbValue = $row['f20170614'];
		$this->f20170615->DbValue = $row['f20170615'];
		$this->f20170616->DbValue = $row['f20170616'];
		$this->f20170617->DbValue = $row['f20170617'];
		$this->f20170618->DbValue = $row['f20170618'];
		$this->f20170619->DbValue = $row['f20170619'];
		$this->f20170620->DbValue = $row['f20170620'];
		$this->f20170621->DbValue = $row['f20170621'];
		$this->f20170622->DbValue = $row['f20170622'];
		$this->f20170623->DbValue = $row['f20170623'];
		$this->f20170624->DbValue = $row['f20170624'];
		$this->f20170625->DbValue = $row['f20170625'];
		$this->f20170626->DbValue = $row['f20170626'];
		$this->f20170627->DbValue = $row['f20170627'];
		$this->f20170628->DbValue = $row['f20170628'];
		$this->f20170629->DbValue = $row['f20170629'];
		$this->f20170630->DbValue = $row['f20170630'];
		$this->f20170701->DbValue = $row['f20170701'];
		$this->f20170702->DbValue = $row['f20170702'];
		$this->f20170703->DbValue = $row['f20170703'];
		$this->f20170704->DbValue = $row['f20170704'];
		$this->f20170705->DbValue = $row['f20170705'];
		$this->f20170706->DbValue = $row['f20170706'];
		$this->f20170707->DbValue = $row['f20170707'];
		$this->f20170708->DbValue = $row['f20170708'];
		$this->f20170709->DbValue = $row['f20170709'];
		$this->f20170710->DbValue = $row['f20170710'];
		$this->f20170711->DbValue = $row['f20170711'];
		$this->f20170712->DbValue = $row['f20170712'];
		$this->f20170713->DbValue = $row['f20170713'];
		$this->f20170714->DbValue = $row['f20170714'];
		$this->f20170715->DbValue = $row['f20170715'];
		$this->f20170716->DbValue = $row['f20170716'];
		$this->f20170717->DbValue = $row['f20170717'];
		$this->f20170718->DbValue = $row['f20170718'];
		$this->f20170719->DbValue = $row['f20170719'];
		$this->f20170720->DbValue = $row['f20170720'];
		$this->f20170721->DbValue = $row['f20170721'];
		$this->f20170722->DbValue = $row['f20170722'];
		$this->f20170723->DbValue = $row['f20170723'];
		$this->f20170724->DbValue = $row['f20170724'];
		$this->f20170725->DbValue = $row['f20170725'];
		$this->f20170726->DbValue = $row['f20170726'];
		$this->f20170727->DbValue = $row['f20170727'];
		$this->f20170728->DbValue = $row['f20170728'];
		$this->f20170729->DbValue = $row['f20170729'];
		$this->f20170730->DbValue = $row['f20170730'];
		$this->f20170731->DbValue = $row['f20170731'];
		$this->f20170801->DbValue = $row['f20170801'];
		$this->f20170802->DbValue = $row['f20170802'];
		$this->f20170803->DbValue = $row['f20170803'];
		$this->f20170804->DbValue = $row['f20170804'];
		$this->f20170805->DbValue = $row['f20170805'];
		$this->f20170806->DbValue = $row['f20170806'];
		$this->f20170807->DbValue = $row['f20170807'];
		$this->f20170808->DbValue = $row['f20170808'];
		$this->f20170809->DbValue = $row['f20170809'];
		$this->f20170810->DbValue = $row['f20170810'];
		$this->f20170811->DbValue = $row['f20170811'];
		$this->f20170812->DbValue = $row['f20170812'];
		$this->f20170813->DbValue = $row['f20170813'];
		$this->f20170814->DbValue = $row['f20170814'];
		$this->f20170815->DbValue = $row['f20170815'];
		$this->f20170816->DbValue = $row['f20170816'];
		$this->f20170817->DbValue = $row['f20170817'];
		$this->f20170818->DbValue = $row['f20170818'];
		$this->f20170819->DbValue = $row['f20170819'];
		$this->f20170820->DbValue = $row['f20170820'];
		$this->f20170821->DbValue = $row['f20170821'];
		$this->f20170822->DbValue = $row['f20170822'];
		$this->f20170823->DbValue = $row['f20170823'];
		$this->f20170824->DbValue = $row['f20170824'];
		$this->f20170825->DbValue = $row['f20170825'];
		$this->f20170826->DbValue = $row['f20170826'];
		$this->f20170827->DbValue = $row['f20170827'];
		$this->f20170828->DbValue = $row['f20170828'];
		$this->f20170829->DbValue = $row['f20170829'];
		$this->f20170830->DbValue = $row['f20170830'];
		$this->f20170831->DbValue = $row['f20170831'];
		$this->f20170901->DbValue = $row['f20170901'];
		$this->f20170902->DbValue = $row['f20170902'];
		$this->f20170903->DbValue = $row['f20170903'];
		$this->f20170904->DbValue = $row['f20170904'];
		$this->f20170905->DbValue = $row['f20170905'];
		$this->f20170906->DbValue = $row['f20170906'];
		$this->f20170907->DbValue = $row['f20170907'];
		$this->f20170908->DbValue = $row['f20170908'];
		$this->f20170909->DbValue = $row['f20170909'];
		$this->f20170910->DbValue = $row['f20170910'];
		$this->f20170911->DbValue = $row['f20170911'];
		$this->f20170912->DbValue = $row['f20170912'];
		$this->f20170913->DbValue = $row['f20170913'];
		$this->f20170914->DbValue = $row['f20170914'];
		$this->f20170915->DbValue = $row['f20170915'];
		$this->f20170916->DbValue = $row['f20170916'];
		$this->f20170917->DbValue = $row['f20170917'];
		$this->f20170918->DbValue = $row['f20170918'];
		$this->f20170919->DbValue = $row['f20170919'];
		$this->f20170920->DbValue = $row['f20170920'];
		$this->f20170921->DbValue = $row['f20170921'];
		$this->f20170922->DbValue = $row['f20170922'];
		$this->f20170923->DbValue = $row['f20170923'];
		$this->f20170924->DbValue = $row['f20170924'];
		$this->f20170925->DbValue = $row['f20170925'];
		$this->f20170926->DbValue = $row['f20170926'];
		$this->f20170927->DbValue = $row['f20170927'];
		$this->f20170928->DbValue = $row['f20170928'];
		$this->f20170929->DbValue = $row['f20170929'];
		$this->f20170930->DbValue = $row['f20170930'];
		$this->f20171001->DbValue = $row['f20171001'];
		$this->f20171002->DbValue = $row['f20171002'];
		$this->f20171003->DbValue = $row['f20171003'];
		$this->f20171004->DbValue = $row['f20171004'];
		$this->f20171005->DbValue = $row['f20171005'];
		$this->f20171006->DbValue = $row['f20171006'];
		$this->f20171007->DbValue = $row['f20171007'];
		$this->f20171008->DbValue = $row['f20171008'];
		$this->f20171009->DbValue = $row['f20171009'];
		$this->f20171010->DbValue = $row['f20171010'];
		$this->f20171011->DbValue = $row['f20171011'];
		$this->f20171012->DbValue = $row['f20171012'];
		$this->f20171013->DbValue = $row['f20171013'];
		$this->f20171014->DbValue = $row['f20171014'];
		$this->f20171015->DbValue = $row['f20171015'];
		$this->f20171016->DbValue = $row['f20171016'];
		$this->f20171017->DbValue = $row['f20171017'];
		$this->f20171018->DbValue = $row['f20171018'];
		$this->f20171019->DbValue = $row['f20171019'];
		$this->f20171020->DbValue = $row['f20171020'];
		$this->f20171021->DbValue = $row['f20171021'];
		$this->f20171022->DbValue = $row['f20171022'];
		$this->f20171023->DbValue = $row['f20171023'];
		$this->f20171024->DbValue = $row['f20171024'];
		$this->f20171025->DbValue = $row['f20171025'];
		$this->f20171026->DbValue = $row['f20171026'];
		$this->f20171027->DbValue = $row['f20171027'];
		$this->f20171028->DbValue = $row['f20171028'];
		$this->f20171029->DbValue = $row['f20171029'];
		$this->f20171030->DbValue = $row['f20171030'];
		$this->f20171031->DbValue = $row['f20171031'];
		$this->f20171101->DbValue = $row['f20171101'];
		$this->f20171102->DbValue = $row['f20171102'];
		$this->f20171103->DbValue = $row['f20171103'];
		$this->f20171104->DbValue = $row['f20171104'];
		$this->f20171105->DbValue = $row['f20171105'];
		$this->f20171106->DbValue = $row['f20171106'];
		$this->f20171107->DbValue = $row['f20171107'];
		$this->f20171108->DbValue = $row['f20171108'];
		$this->f20171109->DbValue = $row['f20171109'];
		$this->f20171110->DbValue = $row['f20171110'];
		$this->f20171111->DbValue = $row['f20171111'];
		$this->f20171112->DbValue = $row['f20171112'];
		$this->f20171113->DbValue = $row['f20171113'];
		$this->f20171114->DbValue = $row['f20171114'];
		$this->f20171115->DbValue = $row['f20171115'];
		$this->f20171116->DbValue = $row['f20171116'];
		$this->f20171117->DbValue = $row['f20171117'];
		$this->f20171118->DbValue = $row['f20171118'];
		$this->f20171119->DbValue = $row['f20171119'];
		$this->f20171120->DbValue = $row['f20171120'];
		$this->f20171121->DbValue = $row['f20171121'];
		$this->f20171122->DbValue = $row['f20171122'];
		$this->f20171123->DbValue = $row['f20171123'];
		$this->f20171124->DbValue = $row['f20171124'];
		$this->f20171125->DbValue = $row['f20171125'];
		$this->f20171126->DbValue = $row['f20171126'];
		$this->f20171127->DbValue = $row['f20171127'];
		$this->f20171128->DbValue = $row['f20171128'];
		$this->f20171129->DbValue = $row['f20171129'];
		$this->f20171130->DbValue = $row['f20171130'];
		$this->f20171201->DbValue = $row['f20171201'];
		$this->f20171202->DbValue = $row['f20171202'];
		$this->f20171203->DbValue = $row['f20171203'];
		$this->f20171204->DbValue = $row['f20171204'];
		$this->f20171205->DbValue = $row['f20171205'];
		$this->f20171206->DbValue = $row['f20171206'];
		$this->f20171207->DbValue = $row['f20171207'];
		$this->f20171208->DbValue = $row['f20171208'];
		$this->f20171209->DbValue = $row['f20171209'];
		$this->f20171210->DbValue = $row['f20171210'];
		$this->f20171211->DbValue = $row['f20171211'];
		$this->f20171212->DbValue = $row['f20171212'];
		$this->f20171213->DbValue = $row['f20171213'];
		$this->f20171214->DbValue = $row['f20171214'];
		$this->f20171215->DbValue = $row['f20171215'];
		$this->f20171216->DbValue = $row['f20171216'];
		$this->f20171217->DbValue = $row['f20171217'];
		$this->f20171218->DbValue = $row['f20171218'];
		$this->f20171219->DbValue = $row['f20171219'];
		$this->f20171220->DbValue = $row['f20171220'];
		$this->f20171221->DbValue = $row['f20171221'];
		$this->f20171222->DbValue = $row['f20171222'];
		$this->f20171223->DbValue = $row['f20171223'];
		$this->f20171224->DbValue = $row['f20171224'];
		$this->f20171225->DbValue = $row['f20171225'];
		$this->f20171226->DbValue = $row['f20171226'];
		$this->f20171227->DbValue = $row['f20171227'];
		$this->f20171228->DbValue = $row['f20171228'];
		$this->f20171229->DbValue = $row['f20171229'];
		$this->f20171230->DbValue = $row['f20171230'];
		$this->f20171231->DbValue = $row['f20171231'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("jdwkrjpeg_id")) <> "")
			$this->jdwkrjpeg_id->CurrentValue = $this->getKey("jdwkrjpeg_id"); // jdwkrjpeg_id
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
		// jdwkrjpeg_id
		// pegawai_id
		// f20170101
		// f20170102
		// f20170103
		// f20170104
		// f20170105
		// f20170106
		// f20170107
		// f20170108
		// f20170109
		// f20170110
		// f20170111
		// f20170112
		// f20170113
		// f20170114
		// f20170115
		// f20170116
		// f20170117
		// f20170118
		// f20170119
		// f20170120
		// f20170121
		// f20170122
		// f20170123
		// f20170124
		// f20170125
		// f20170126
		// f20170127
		// f20170128
		// f20170129
		// f20170130
		// f20170131
		// f20170201
		// f20170202
		// f20170203
		// f20170204
		// f20170205
		// f20170206
		// f20170207
		// f20170208
		// f20170209
		// f20170210
		// f20170211
		// f20170212
		// f20170213
		// f20170214
		// f20170215
		// f20170216
		// f20170217
		// f20170218
		// f20170219
		// f20170220
		// f20170221
		// f20170222
		// f20170223
		// f20170224
		// f20170225
		// f20170226
		// f20170227
		// f20170228
		// f20170229
		// f20170301
		// f20170302
		// f20170303
		// f20170304
		// f20170305
		// f20170306
		// f20170307
		// f20170308
		// f20170309
		// f20170310
		// f20170311
		// f20170312
		// f20170313
		// f20170314
		// f20170315
		// f20170316
		// f20170317
		// f20170318
		// f20170319
		// f20170320
		// f20170321
		// f20170322
		// f20170323
		// f20170324
		// f20170325
		// f20170326
		// f20170327
		// f20170328
		// f20170329
		// f20170330
		// f20170331
		// f20170401
		// f20170402
		// f20170403
		// f20170404
		// f20170405
		// f20170406
		// f20170407
		// f20170408
		// f20170409
		// f20170410
		// f20170411
		// f20170412
		// f20170413
		// f20170414
		// f20170415
		// f20170416
		// f20170417
		// f20170418
		// f20170419
		// f20170420
		// f20170421
		// f20170422
		// f20170423
		// f20170424
		// f20170425
		// f20170426
		// f20170427
		// f20170428
		// f20170429
		// f20170430
		// f20170501
		// f20170502
		// f20170503
		// f20170504
		// f20170505
		// f20170506
		// f20170507
		// f20170508
		// f20170509
		// f20170510
		// f20170511
		// f20170512
		// f20170513
		// f20170514
		// f20170515
		// f20170516
		// f20170517
		// f20170518
		// f20170519
		// f20170520
		// f20170521
		// f20170522
		// f20170523
		// f20170524
		// f20170525
		// f20170526
		// f20170527
		// f20170528
		// f20170529
		// f20170530
		// f20170531
		// f20170601
		// f20170602
		// f20170603
		// f20170604
		// f20170605
		// f20170606
		// f20170607
		// f20170608
		// f20170609
		// f20170610
		// f20170611
		// f20170612
		// f20170613
		// f20170614
		// f20170615
		// f20170616
		// f20170617
		// f20170618
		// f20170619
		// f20170620
		// f20170621
		// f20170622
		// f20170623
		// f20170624
		// f20170625
		// f20170626
		// f20170627
		// f20170628
		// f20170629
		// f20170630
		// f20170701
		// f20170702
		// f20170703
		// f20170704
		// f20170705
		// f20170706
		// f20170707
		// f20170708
		// f20170709
		// f20170710
		// f20170711
		// f20170712
		// f20170713
		// f20170714
		// f20170715
		// f20170716
		// f20170717
		// f20170718
		// f20170719
		// f20170720
		// f20170721
		// f20170722
		// f20170723
		// f20170724
		// f20170725
		// f20170726
		// f20170727
		// f20170728
		// f20170729
		// f20170730
		// f20170731
		// f20170801
		// f20170802
		// f20170803
		// f20170804
		// f20170805
		// f20170806
		// f20170807
		// f20170808
		// f20170809
		// f20170810
		// f20170811
		// f20170812
		// f20170813
		// f20170814
		// f20170815
		// f20170816
		// f20170817
		// f20170818
		// f20170819
		// f20170820
		// f20170821
		// f20170822
		// f20170823
		// f20170824
		// f20170825
		// f20170826
		// f20170827
		// f20170828
		// f20170829
		// f20170830
		// f20170831
		// f20170901
		// f20170902
		// f20170903
		// f20170904
		// f20170905
		// f20170906
		// f20170907
		// f20170908
		// f20170909
		// f20170910
		// f20170911
		// f20170912
		// f20170913
		// f20170914
		// f20170915
		// f20170916
		// f20170917
		// f20170918
		// f20170919
		// f20170920
		// f20170921
		// f20170922
		// f20170923
		// f20170924
		// f20170925
		// f20170926
		// f20170927
		// f20170928
		// f20170929
		// f20170930
		// f20171001
		// f20171002
		// f20171003
		// f20171004
		// f20171005
		// f20171006
		// f20171007
		// f20171008
		// f20171009
		// f20171010
		// f20171011
		// f20171012
		// f20171013
		// f20171014
		// f20171015
		// f20171016
		// f20171017
		// f20171018
		// f20171019
		// f20171020
		// f20171021
		// f20171022
		// f20171023
		// f20171024
		// f20171025
		// f20171026
		// f20171027
		// f20171028
		// f20171029
		// f20171030
		// f20171031
		// f20171101
		// f20171102
		// f20171103
		// f20171104
		// f20171105
		// f20171106
		// f20171107
		// f20171108
		// f20171109
		// f20171110
		// f20171111
		// f20171112
		// f20171113
		// f20171114
		// f20171115
		// f20171116
		// f20171117
		// f20171118
		// f20171119
		// f20171120
		// f20171121
		// f20171122
		// f20171123
		// f20171124
		// f20171125
		// f20171126
		// f20171127
		// f20171128
		// f20171129
		// f20171130
		// f20171201
		// f20171202
		// f20171203
		// f20171204
		// f20171205
		// f20171206
		// f20171207
		// f20171208
		// f20171209
		// f20171210
		// f20171211
		// f20171212
		// f20171213
		// f20171214
		// f20171215
		// f20171216
		// f20171217
		// f20171218
		// f20171219
		// f20171220
		// f20171221
		// f20171222
		// f20171223
		// f20171224
		// f20171225
		// f20171226
		// f20171227
		// f20171228
		// f20171229
		// f20171230
		// f20171231

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// jdwkrjpeg_id
		$this->jdwkrjpeg_id->ViewValue = $this->jdwkrjpeg_id->CurrentValue;
		$this->jdwkrjpeg_id->ViewCustomAttributes = "";

		// pegawai_id
		$this->pegawai_id->ViewValue = $this->pegawai_id->CurrentValue;
		$this->pegawai_id->ViewCustomAttributes = "";

		// f20170101
		$this->f20170101->ViewValue = $this->f20170101->CurrentValue;
		$this->f20170101->ViewCustomAttributes = "";

		// f20170102
		if ($this->f20170102->VirtualValue <> "") {
			$this->f20170102->ViewValue = $this->f20170102->VirtualValue;
		} else {
			$this->f20170102->ViewValue = $this->f20170102->CurrentValue;
		if (strval($this->f20170102->CurrentValue) <> "") {
			$sFilterWrk = "`jk_id`" . ew_SearchString("=", $this->f20170102->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `jk_id`, `jk_nm` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t_jk`";
		$sWhereWrk = "";
		$this->f20170102->LookupFilters = array("dx1" => '`jk_nm`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->f20170102, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->f20170102->ViewValue = $this->f20170102->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->f20170102->ViewValue = $this->f20170102->CurrentValue;
			}
		} else {
			$this->f20170102->ViewValue = NULL;
		}
		}
		$this->f20170102->ViewCustomAttributes = "";

		// f20170103
		$this->f20170103->ViewValue = $this->f20170103->CurrentValue;
		$this->f20170103->ViewCustomAttributes = "";

		// f20170104
		$this->f20170104->ViewValue = $this->f20170104->CurrentValue;
		$this->f20170104->ViewCustomAttributes = "";

		// f20170105
		$this->f20170105->ViewValue = $this->f20170105->CurrentValue;
		$this->f20170105->ViewCustomAttributes = "";

		// f20170106
		$this->f20170106->ViewValue = $this->f20170106->CurrentValue;
		$this->f20170106->ViewCustomAttributes = "";

		// f20170107
		$this->f20170107->ViewValue = $this->f20170107->CurrentValue;
		$this->f20170107->ViewCustomAttributes = "";

		// f20170108
		$this->f20170108->ViewValue = $this->f20170108->CurrentValue;
		$this->f20170108->ViewCustomAttributes = "";

		// f20170109
		$this->f20170109->ViewValue = $this->f20170109->CurrentValue;
		$this->f20170109->ViewCustomAttributes = "";

		// f20170110
		$this->f20170110->ViewValue = $this->f20170110->CurrentValue;
		$this->f20170110->ViewCustomAttributes = "";

		// f20170111
		$this->f20170111->ViewValue = $this->f20170111->CurrentValue;
		$this->f20170111->ViewCustomAttributes = "";

		// f20170112
		$this->f20170112->ViewValue = $this->f20170112->CurrentValue;
		$this->f20170112->ViewCustomAttributes = "";

		// f20170113
		$this->f20170113->ViewValue = $this->f20170113->CurrentValue;
		$this->f20170113->ViewCustomAttributes = "";

		// f20170114
		$this->f20170114->ViewValue = $this->f20170114->CurrentValue;
		$this->f20170114->ViewCustomAttributes = "";

		// f20170115
		$this->f20170115->ViewValue = $this->f20170115->CurrentValue;
		$this->f20170115->ViewCustomAttributes = "";

		// f20170116
		$this->f20170116->ViewValue = $this->f20170116->CurrentValue;
		$this->f20170116->ViewCustomAttributes = "";

		// f20170117
		$this->f20170117->ViewValue = $this->f20170117->CurrentValue;
		$this->f20170117->ViewCustomAttributes = "";

		// f20170118
		$this->f20170118->ViewValue = $this->f20170118->CurrentValue;
		$this->f20170118->ViewCustomAttributes = "";

		// f20170119
		$this->f20170119->ViewValue = $this->f20170119->CurrentValue;
		$this->f20170119->ViewCustomAttributes = "";

		// f20170120
		$this->f20170120->ViewValue = $this->f20170120->CurrentValue;
		$this->f20170120->ViewCustomAttributes = "";

		// f20170121
		$this->f20170121->ViewValue = $this->f20170121->CurrentValue;
		$this->f20170121->ViewCustomAttributes = "";

		// f20170122
		$this->f20170122->ViewValue = $this->f20170122->CurrentValue;
		$this->f20170122->ViewCustomAttributes = "";

		// f20170123
		$this->f20170123->ViewValue = $this->f20170123->CurrentValue;
		$this->f20170123->ViewCustomAttributes = "";

		// f20170124
		$this->f20170124->ViewValue = $this->f20170124->CurrentValue;
		$this->f20170124->ViewCustomAttributes = "";

		// f20170125
		$this->f20170125->ViewValue = $this->f20170125->CurrentValue;
		$this->f20170125->ViewCustomAttributes = "";

		// f20170126
		$this->f20170126->ViewValue = $this->f20170126->CurrentValue;
		$this->f20170126->ViewCustomAttributes = "";

		// f20170127
		$this->f20170127->ViewValue = $this->f20170127->CurrentValue;
		$this->f20170127->ViewCustomAttributes = "";

		// f20170128
		$this->f20170128->ViewValue = $this->f20170128->CurrentValue;
		$this->f20170128->ViewCustomAttributes = "";

		// f20170129
		$this->f20170129->ViewValue = $this->f20170129->CurrentValue;
		$this->f20170129->ViewCustomAttributes = "";

		// f20170130
		$this->f20170130->ViewValue = $this->f20170130->CurrentValue;
		$this->f20170130->ViewCustomAttributes = "";

		// f20170131
		$this->f20170131->ViewValue = $this->f20170131->CurrentValue;
		$this->f20170131->ViewCustomAttributes = "";

		// f20170201
		$this->f20170201->ViewValue = $this->f20170201->CurrentValue;
		$this->f20170201->ViewCustomAttributes = "";

		// f20170202
		$this->f20170202->ViewValue = $this->f20170202->CurrentValue;
		$this->f20170202->ViewCustomAttributes = "";

		// f20170203
		$this->f20170203->ViewValue = $this->f20170203->CurrentValue;
		$this->f20170203->ViewCustomAttributes = "";

		// f20170204
		$this->f20170204->ViewValue = $this->f20170204->CurrentValue;
		$this->f20170204->ViewCustomAttributes = "";

		// f20170205
		$this->f20170205->ViewValue = $this->f20170205->CurrentValue;
		$this->f20170205->ViewCustomAttributes = "";

		// f20170206
		$this->f20170206->ViewValue = $this->f20170206->CurrentValue;
		$this->f20170206->ViewCustomAttributes = "";

		// f20170207
		$this->f20170207->ViewValue = $this->f20170207->CurrentValue;
		$this->f20170207->ViewCustomAttributes = "";

		// f20170208
		$this->f20170208->ViewValue = $this->f20170208->CurrentValue;
		$this->f20170208->ViewCustomAttributes = "";

		// f20170209
		$this->f20170209->ViewValue = $this->f20170209->CurrentValue;
		$this->f20170209->ViewCustomAttributes = "";

		// f20170210
		$this->f20170210->ViewValue = $this->f20170210->CurrentValue;
		$this->f20170210->ViewCustomAttributes = "";

		// f20170211
		$this->f20170211->ViewValue = $this->f20170211->CurrentValue;
		$this->f20170211->ViewCustomAttributes = "";

		// f20170212
		$this->f20170212->ViewValue = $this->f20170212->CurrentValue;
		$this->f20170212->ViewCustomAttributes = "";

		// f20170213
		$this->f20170213->ViewValue = $this->f20170213->CurrentValue;
		$this->f20170213->ViewCustomAttributes = "";

		// f20170214
		$this->f20170214->ViewValue = $this->f20170214->CurrentValue;
		$this->f20170214->ViewCustomAttributes = "";

		// f20170215
		$this->f20170215->ViewValue = $this->f20170215->CurrentValue;
		$this->f20170215->ViewCustomAttributes = "";

		// f20170216
		$this->f20170216->ViewValue = $this->f20170216->CurrentValue;
		$this->f20170216->ViewCustomAttributes = "";

		// f20170217
		$this->f20170217->ViewValue = $this->f20170217->CurrentValue;
		$this->f20170217->ViewCustomAttributes = "";

		// f20170218
		$this->f20170218->ViewValue = $this->f20170218->CurrentValue;
		$this->f20170218->ViewCustomAttributes = "";

		// f20170219
		$this->f20170219->ViewValue = $this->f20170219->CurrentValue;
		$this->f20170219->ViewCustomAttributes = "";

		// f20170220
		$this->f20170220->ViewValue = $this->f20170220->CurrentValue;
		$this->f20170220->ViewCustomAttributes = "";

		// f20170221
		$this->f20170221->ViewValue = $this->f20170221->CurrentValue;
		$this->f20170221->ViewCustomAttributes = "";

		// f20170222
		$this->f20170222->ViewValue = $this->f20170222->CurrentValue;
		$this->f20170222->ViewCustomAttributes = "";

		// f20170223
		$this->f20170223->ViewValue = $this->f20170223->CurrentValue;
		$this->f20170223->ViewCustomAttributes = "";

		// f20170224
		$this->f20170224->ViewValue = $this->f20170224->CurrentValue;
		$this->f20170224->ViewCustomAttributes = "";

		// f20170225
		$this->f20170225->ViewValue = $this->f20170225->CurrentValue;
		$this->f20170225->ViewCustomAttributes = "";

		// f20170226
		$this->f20170226->ViewValue = $this->f20170226->CurrentValue;
		$this->f20170226->ViewCustomAttributes = "";

		// f20170227
		$this->f20170227->ViewValue = $this->f20170227->CurrentValue;
		$this->f20170227->ViewCustomAttributes = "";

		// f20170228
		$this->f20170228->ViewValue = $this->f20170228->CurrentValue;
		$this->f20170228->ViewCustomAttributes = "";

		// f20170229
		$this->f20170229->ViewValue = $this->f20170229->CurrentValue;
		$this->f20170229->ViewCustomAttributes = "";

		// f20170301
		$this->f20170301->ViewValue = $this->f20170301->CurrentValue;
		$this->f20170301->ViewCustomAttributes = "";

		// f20170302
		$this->f20170302->ViewValue = $this->f20170302->CurrentValue;
		$this->f20170302->ViewCustomAttributes = "";

		// f20170303
		$this->f20170303->ViewValue = $this->f20170303->CurrentValue;
		$this->f20170303->ViewCustomAttributes = "";

		// f20170304
		$this->f20170304->ViewValue = $this->f20170304->CurrentValue;
		$this->f20170304->ViewCustomAttributes = "";

		// f20170305
		$this->f20170305->ViewValue = $this->f20170305->CurrentValue;
		$this->f20170305->ViewCustomAttributes = "";

		// f20170306
		$this->f20170306->ViewValue = $this->f20170306->CurrentValue;
		$this->f20170306->ViewCustomAttributes = "";

		// f20170307
		$this->f20170307->ViewValue = $this->f20170307->CurrentValue;
		$this->f20170307->ViewCustomAttributes = "";

		// f20170308
		$this->f20170308->ViewValue = $this->f20170308->CurrentValue;
		$this->f20170308->ViewCustomAttributes = "";

		// f20170309
		$this->f20170309->ViewValue = $this->f20170309->CurrentValue;
		$this->f20170309->ViewCustomAttributes = "";

		// f20170310
		$this->f20170310->ViewValue = $this->f20170310->CurrentValue;
		$this->f20170310->ViewCustomAttributes = "";

		// f20170311
		$this->f20170311->ViewValue = $this->f20170311->CurrentValue;
		$this->f20170311->ViewCustomAttributes = "";

		// f20170312
		$this->f20170312->ViewValue = $this->f20170312->CurrentValue;
		$this->f20170312->ViewCustomAttributes = "";

		// f20170313
		$this->f20170313->ViewValue = $this->f20170313->CurrentValue;
		$this->f20170313->ViewCustomAttributes = "";

		// f20170314
		$this->f20170314->ViewValue = $this->f20170314->CurrentValue;
		$this->f20170314->ViewCustomAttributes = "";

		// f20170315
		$this->f20170315->ViewValue = $this->f20170315->CurrentValue;
		$this->f20170315->ViewCustomAttributes = "";

		// f20170316
		$this->f20170316->ViewValue = $this->f20170316->CurrentValue;
		$this->f20170316->ViewCustomAttributes = "";

		// f20170317
		$this->f20170317->ViewValue = $this->f20170317->CurrentValue;
		$this->f20170317->ViewCustomAttributes = "";

		// f20170318
		$this->f20170318->ViewValue = $this->f20170318->CurrentValue;
		$this->f20170318->ViewCustomAttributes = "";

		// f20170319
		$this->f20170319->ViewValue = $this->f20170319->CurrentValue;
		$this->f20170319->ViewCustomAttributes = "";

		// f20170320
		$this->f20170320->ViewValue = $this->f20170320->CurrentValue;
		$this->f20170320->ViewCustomAttributes = "";

		// f20170321
		$this->f20170321->ViewValue = $this->f20170321->CurrentValue;
		$this->f20170321->ViewCustomAttributes = "";

		// f20170322
		$this->f20170322->ViewValue = $this->f20170322->CurrentValue;
		$this->f20170322->ViewCustomAttributes = "";

		// f20170323
		$this->f20170323->ViewValue = $this->f20170323->CurrentValue;
		$this->f20170323->ViewCustomAttributes = "";

		// f20170324
		$this->f20170324->ViewValue = $this->f20170324->CurrentValue;
		$this->f20170324->ViewCustomAttributes = "";

		// f20170325
		$this->f20170325->ViewValue = $this->f20170325->CurrentValue;
		$this->f20170325->ViewCustomAttributes = "";

		// f20170326
		$this->f20170326->ViewValue = $this->f20170326->CurrentValue;
		$this->f20170326->ViewCustomAttributes = "";

		// f20170327
		$this->f20170327->ViewValue = $this->f20170327->CurrentValue;
		$this->f20170327->ViewCustomAttributes = "";

		// f20170328
		$this->f20170328->ViewValue = $this->f20170328->CurrentValue;
		$this->f20170328->ViewCustomAttributes = "";

		// f20170329
		$this->f20170329->ViewValue = $this->f20170329->CurrentValue;
		$this->f20170329->ViewCustomAttributes = "";

		// f20170330
		$this->f20170330->ViewValue = $this->f20170330->CurrentValue;
		$this->f20170330->ViewCustomAttributes = "";

		// f20170331
		$this->f20170331->ViewValue = $this->f20170331->CurrentValue;
		$this->f20170331->ViewCustomAttributes = "";

		// f20170401
		$this->f20170401->ViewValue = $this->f20170401->CurrentValue;
		$this->f20170401->ViewCustomAttributes = "";

		// f20170402
		$this->f20170402->ViewValue = $this->f20170402->CurrentValue;
		$this->f20170402->ViewCustomAttributes = "";

		// f20170403
		$this->f20170403->ViewValue = $this->f20170403->CurrentValue;
		$this->f20170403->ViewCustomAttributes = "";

		// f20170404
		$this->f20170404->ViewValue = $this->f20170404->CurrentValue;
		$this->f20170404->ViewCustomAttributes = "";

		// f20170405
		$this->f20170405->ViewValue = $this->f20170405->CurrentValue;
		$this->f20170405->ViewCustomAttributes = "";

		// f20170406
		$this->f20170406->ViewValue = $this->f20170406->CurrentValue;
		$this->f20170406->ViewCustomAttributes = "";

		// f20170407
		$this->f20170407->ViewValue = $this->f20170407->CurrentValue;
		$this->f20170407->ViewCustomAttributes = "";

		// f20170408
		$this->f20170408->ViewValue = $this->f20170408->CurrentValue;
		$this->f20170408->ViewCustomAttributes = "";

		// f20170409
		$this->f20170409->ViewValue = $this->f20170409->CurrentValue;
		$this->f20170409->ViewCustomAttributes = "";

		// f20170410
		$this->f20170410->ViewValue = $this->f20170410->CurrentValue;
		$this->f20170410->ViewCustomAttributes = "";

		// f20170411
		$this->f20170411->ViewValue = $this->f20170411->CurrentValue;
		$this->f20170411->ViewCustomAttributes = "";

		// f20170412
		$this->f20170412->ViewValue = $this->f20170412->CurrentValue;
		$this->f20170412->ViewCustomAttributes = "";

		// f20170413
		$this->f20170413->ViewValue = $this->f20170413->CurrentValue;
		$this->f20170413->ViewCustomAttributes = "";

		// f20170414
		$this->f20170414->ViewValue = $this->f20170414->CurrentValue;
		$this->f20170414->ViewCustomAttributes = "";

		// f20170415
		$this->f20170415->ViewValue = $this->f20170415->CurrentValue;
		$this->f20170415->ViewCustomAttributes = "";

		// f20170416
		$this->f20170416->ViewValue = $this->f20170416->CurrentValue;
		$this->f20170416->ViewCustomAttributes = "";

		// f20170417
		$this->f20170417->ViewValue = $this->f20170417->CurrentValue;
		$this->f20170417->ViewCustomAttributes = "";

		// f20170418
		$this->f20170418->ViewValue = $this->f20170418->CurrentValue;
		$this->f20170418->ViewCustomAttributes = "";

		// f20170419
		$this->f20170419->ViewValue = $this->f20170419->CurrentValue;
		$this->f20170419->ViewCustomAttributes = "";

		// f20170420
		$this->f20170420->ViewValue = $this->f20170420->CurrentValue;
		$this->f20170420->ViewCustomAttributes = "";

		// f20170421
		$this->f20170421->ViewValue = $this->f20170421->CurrentValue;
		$this->f20170421->ViewCustomAttributes = "";

		// f20170422
		$this->f20170422->ViewValue = $this->f20170422->CurrentValue;
		$this->f20170422->ViewCustomAttributes = "";

		// f20170423
		$this->f20170423->ViewValue = $this->f20170423->CurrentValue;
		$this->f20170423->ViewCustomAttributes = "";

		// f20170424
		$this->f20170424->ViewValue = $this->f20170424->CurrentValue;
		$this->f20170424->ViewCustomAttributes = "";

		// f20170425
		$this->f20170425->ViewValue = $this->f20170425->CurrentValue;
		$this->f20170425->ViewCustomAttributes = "";

		// f20170426
		$this->f20170426->ViewValue = $this->f20170426->CurrentValue;
		$this->f20170426->ViewCustomAttributes = "";

		// f20170427
		$this->f20170427->ViewValue = $this->f20170427->CurrentValue;
		$this->f20170427->ViewCustomAttributes = "";

		// f20170428
		$this->f20170428->ViewValue = $this->f20170428->CurrentValue;
		$this->f20170428->ViewCustomAttributes = "";

		// f20170429
		$this->f20170429->ViewValue = $this->f20170429->CurrentValue;
		$this->f20170429->ViewCustomAttributes = "";

		// f20170430
		$this->f20170430->ViewValue = $this->f20170430->CurrentValue;
		$this->f20170430->ViewCustomAttributes = "";

		// f20170501
		$this->f20170501->ViewValue = $this->f20170501->CurrentValue;
		$this->f20170501->ViewCustomAttributes = "";

		// f20170502
		$this->f20170502->ViewValue = $this->f20170502->CurrentValue;
		$this->f20170502->ViewCustomAttributes = "";

		// f20170503
		$this->f20170503->ViewValue = $this->f20170503->CurrentValue;
		$this->f20170503->ViewCustomAttributes = "";

		// f20170504
		$this->f20170504->ViewValue = $this->f20170504->CurrentValue;
		$this->f20170504->ViewCustomAttributes = "";

		// f20170505
		$this->f20170505->ViewValue = $this->f20170505->CurrentValue;
		$this->f20170505->ViewCustomAttributes = "";

		// f20170506
		$this->f20170506->ViewValue = $this->f20170506->CurrentValue;
		$this->f20170506->ViewCustomAttributes = "";

		// f20170507
		$this->f20170507->ViewValue = $this->f20170507->CurrentValue;
		$this->f20170507->ViewCustomAttributes = "";

		// f20170508
		$this->f20170508->ViewValue = $this->f20170508->CurrentValue;
		$this->f20170508->ViewCustomAttributes = "";

		// f20170509
		$this->f20170509->ViewValue = $this->f20170509->CurrentValue;
		$this->f20170509->ViewCustomAttributes = "";

		// f20170510
		$this->f20170510->ViewValue = $this->f20170510->CurrentValue;
		$this->f20170510->ViewCustomAttributes = "";

		// f20170511
		$this->f20170511->ViewValue = $this->f20170511->CurrentValue;
		$this->f20170511->ViewCustomAttributes = "";

		// f20170512
		$this->f20170512->ViewValue = $this->f20170512->CurrentValue;
		$this->f20170512->ViewCustomAttributes = "";

		// f20170513
		$this->f20170513->ViewValue = $this->f20170513->CurrentValue;
		$this->f20170513->ViewCustomAttributes = "";

		// f20170514
		$this->f20170514->ViewValue = $this->f20170514->CurrentValue;
		$this->f20170514->ViewCustomAttributes = "";

		// f20170515
		$this->f20170515->ViewValue = $this->f20170515->CurrentValue;
		$this->f20170515->ViewCustomAttributes = "";

		// f20170516
		$this->f20170516->ViewValue = $this->f20170516->CurrentValue;
		$this->f20170516->ViewCustomAttributes = "";

		// f20170517
		$this->f20170517->ViewValue = $this->f20170517->CurrentValue;
		$this->f20170517->ViewCustomAttributes = "";

		// f20170518
		$this->f20170518->ViewValue = $this->f20170518->CurrentValue;
		$this->f20170518->ViewCustomAttributes = "";

		// f20170519
		$this->f20170519->ViewValue = $this->f20170519->CurrentValue;
		$this->f20170519->ViewCustomAttributes = "";

		// f20170520
		$this->f20170520->ViewValue = $this->f20170520->CurrentValue;
		$this->f20170520->ViewCustomAttributes = "";

		// f20170521
		$this->f20170521->ViewValue = $this->f20170521->CurrentValue;
		$this->f20170521->ViewCustomAttributes = "";

		// f20170522
		$this->f20170522->ViewValue = $this->f20170522->CurrentValue;
		$this->f20170522->ViewCustomAttributes = "";

		// f20170523
		$this->f20170523->ViewValue = $this->f20170523->CurrentValue;
		$this->f20170523->ViewCustomAttributes = "";

		// f20170524
		$this->f20170524->ViewValue = $this->f20170524->CurrentValue;
		$this->f20170524->ViewCustomAttributes = "";

		// f20170525
		$this->f20170525->ViewValue = $this->f20170525->CurrentValue;
		$this->f20170525->ViewCustomAttributes = "";

		// f20170526
		$this->f20170526->ViewValue = $this->f20170526->CurrentValue;
		$this->f20170526->ViewCustomAttributes = "";

		// f20170527
		$this->f20170527->ViewValue = $this->f20170527->CurrentValue;
		$this->f20170527->ViewCustomAttributes = "";

		// f20170528
		$this->f20170528->ViewValue = $this->f20170528->CurrentValue;
		$this->f20170528->ViewCustomAttributes = "";

		// f20170529
		$this->f20170529->ViewValue = $this->f20170529->CurrentValue;
		$this->f20170529->ViewCustomAttributes = "";

		// f20170530
		$this->f20170530->ViewValue = $this->f20170530->CurrentValue;
		$this->f20170530->ViewCustomAttributes = "";

		// f20170531
		$this->f20170531->ViewValue = $this->f20170531->CurrentValue;
		$this->f20170531->ViewCustomAttributes = "";

		// f20170601
		$this->f20170601->ViewValue = $this->f20170601->CurrentValue;
		$this->f20170601->ViewCustomAttributes = "";

		// f20170602
		$this->f20170602->ViewValue = $this->f20170602->CurrentValue;
		$this->f20170602->ViewCustomAttributes = "";

		// f20170603
		$this->f20170603->ViewValue = $this->f20170603->CurrentValue;
		$this->f20170603->ViewCustomAttributes = "";

		// f20170604
		$this->f20170604->ViewValue = $this->f20170604->CurrentValue;
		$this->f20170604->ViewCustomAttributes = "";

		// f20170605
		$this->f20170605->ViewValue = $this->f20170605->CurrentValue;
		$this->f20170605->ViewCustomAttributes = "";

		// f20170606
		$this->f20170606->ViewValue = $this->f20170606->CurrentValue;
		$this->f20170606->ViewCustomAttributes = "";

		// f20170607
		$this->f20170607->ViewValue = $this->f20170607->CurrentValue;
		$this->f20170607->ViewCustomAttributes = "";

		// f20170608
		$this->f20170608->ViewValue = $this->f20170608->CurrentValue;
		$this->f20170608->ViewCustomAttributes = "";

		// f20170609
		$this->f20170609->ViewValue = $this->f20170609->CurrentValue;
		$this->f20170609->ViewCustomAttributes = "";

		// f20170610
		$this->f20170610->ViewValue = $this->f20170610->CurrentValue;
		$this->f20170610->ViewCustomAttributes = "";

		// f20170611
		$this->f20170611->ViewValue = $this->f20170611->CurrentValue;
		$this->f20170611->ViewCustomAttributes = "";

		// f20170612
		$this->f20170612->ViewValue = $this->f20170612->CurrentValue;
		$this->f20170612->ViewCustomAttributes = "";

		// f20170613
		$this->f20170613->ViewValue = $this->f20170613->CurrentValue;
		$this->f20170613->ViewCustomAttributes = "";

		// f20170614
		$this->f20170614->ViewValue = $this->f20170614->CurrentValue;
		$this->f20170614->ViewCustomAttributes = "";

		// f20170615
		$this->f20170615->ViewValue = $this->f20170615->CurrentValue;
		$this->f20170615->ViewCustomAttributes = "";

		// f20170616
		$this->f20170616->ViewValue = $this->f20170616->CurrentValue;
		$this->f20170616->ViewCustomAttributes = "";

		// f20170617
		$this->f20170617->ViewValue = $this->f20170617->CurrentValue;
		$this->f20170617->ViewCustomAttributes = "";

		// f20170618
		$this->f20170618->ViewValue = $this->f20170618->CurrentValue;
		$this->f20170618->ViewCustomAttributes = "";

		// f20170619
		$this->f20170619->ViewValue = $this->f20170619->CurrentValue;
		$this->f20170619->ViewCustomAttributes = "";

		// f20170620
		$this->f20170620->ViewValue = $this->f20170620->CurrentValue;
		$this->f20170620->ViewCustomAttributes = "";

		// f20170621
		$this->f20170621->ViewValue = $this->f20170621->CurrentValue;
		$this->f20170621->ViewCustomAttributes = "";

		// f20170622
		$this->f20170622->ViewValue = $this->f20170622->CurrentValue;
		$this->f20170622->ViewCustomAttributes = "";

		// f20170623
		$this->f20170623->ViewValue = $this->f20170623->CurrentValue;
		$this->f20170623->ViewCustomAttributes = "";

		// f20170624
		$this->f20170624->ViewValue = $this->f20170624->CurrentValue;
		$this->f20170624->ViewCustomAttributes = "";

		// f20170625
		$this->f20170625->ViewValue = $this->f20170625->CurrentValue;
		$this->f20170625->ViewCustomAttributes = "";

		// f20170626
		$this->f20170626->ViewValue = $this->f20170626->CurrentValue;
		$this->f20170626->ViewCustomAttributes = "";

		// f20170627
		$this->f20170627->ViewValue = $this->f20170627->CurrentValue;
		$this->f20170627->ViewCustomAttributes = "";

		// f20170628
		$this->f20170628->ViewValue = $this->f20170628->CurrentValue;
		$this->f20170628->ViewCustomAttributes = "";

		// f20170629
		$this->f20170629->ViewValue = $this->f20170629->CurrentValue;
		$this->f20170629->ViewCustomAttributes = "";

		// f20170630
		$this->f20170630->ViewValue = $this->f20170630->CurrentValue;
		$this->f20170630->ViewCustomAttributes = "";

		// f20170701
		$this->f20170701->ViewValue = $this->f20170701->CurrentValue;
		$this->f20170701->ViewCustomAttributes = "";

		// f20170702
		$this->f20170702->ViewValue = $this->f20170702->CurrentValue;
		$this->f20170702->ViewCustomAttributes = "";

		// f20170703
		$this->f20170703->ViewValue = $this->f20170703->CurrentValue;
		$this->f20170703->ViewCustomAttributes = "";

		// f20170704
		$this->f20170704->ViewValue = $this->f20170704->CurrentValue;
		$this->f20170704->ViewCustomAttributes = "";

		// f20170705
		$this->f20170705->ViewValue = $this->f20170705->CurrentValue;
		$this->f20170705->ViewCustomAttributes = "";

		// f20170706
		$this->f20170706->ViewValue = $this->f20170706->CurrentValue;
		$this->f20170706->ViewCustomAttributes = "";

		// f20170707
		$this->f20170707->ViewValue = $this->f20170707->CurrentValue;
		$this->f20170707->ViewCustomAttributes = "";

		// f20170708
		$this->f20170708->ViewValue = $this->f20170708->CurrentValue;
		$this->f20170708->ViewCustomAttributes = "";

		// f20170709
		$this->f20170709->ViewValue = $this->f20170709->CurrentValue;
		$this->f20170709->ViewCustomAttributes = "";

		// f20170710
		$this->f20170710->ViewValue = $this->f20170710->CurrentValue;
		$this->f20170710->ViewCustomAttributes = "";

		// f20170711
		$this->f20170711->ViewValue = $this->f20170711->CurrentValue;
		$this->f20170711->ViewCustomAttributes = "";

		// f20170712
		$this->f20170712->ViewValue = $this->f20170712->CurrentValue;
		$this->f20170712->ViewCustomAttributes = "";

		// f20170713
		$this->f20170713->ViewValue = $this->f20170713->CurrentValue;
		$this->f20170713->ViewCustomAttributes = "";

		// f20170714
		$this->f20170714->ViewValue = $this->f20170714->CurrentValue;
		$this->f20170714->ViewCustomAttributes = "";

		// f20170715
		$this->f20170715->ViewValue = $this->f20170715->CurrentValue;
		$this->f20170715->ViewCustomAttributes = "";

		// f20170716
		$this->f20170716->ViewValue = $this->f20170716->CurrentValue;
		$this->f20170716->ViewCustomAttributes = "";

		// f20170717
		$this->f20170717->ViewValue = $this->f20170717->CurrentValue;
		$this->f20170717->ViewCustomAttributes = "";

		// f20170718
		$this->f20170718->ViewValue = $this->f20170718->CurrentValue;
		$this->f20170718->ViewCustomAttributes = "";

		// f20170719
		$this->f20170719->ViewValue = $this->f20170719->CurrentValue;
		$this->f20170719->ViewCustomAttributes = "";

		// f20170720
		$this->f20170720->ViewValue = $this->f20170720->CurrentValue;
		$this->f20170720->ViewCustomAttributes = "";

		// f20170721
		$this->f20170721->ViewValue = $this->f20170721->CurrentValue;
		$this->f20170721->ViewCustomAttributes = "";

		// f20170722
		$this->f20170722->ViewValue = $this->f20170722->CurrentValue;
		$this->f20170722->ViewCustomAttributes = "";

		// f20170723
		$this->f20170723->ViewValue = $this->f20170723->CurrentValue;
		$this->f20170723->ViewCustomAttributes = "";

		// f20170724
		$this->f20170724->ViewValue = $this->f20170724->CurrentValue;
		$this->f20170724->ViewCustomAttributes = "";

		// f20170725
		$this->f20170725->ViewValue = $this->f20170725->CurrentValue;
		$this->f20170725->ViewCustomAttributes = "";

		// f20170726
		$this->f20170726->ViewValue = $this->f20170726->CurrentValue;
		$this->f20170726->ViewCustomAttributes = "";

		// f20170727
		$this->f20170727->ViewValue = $this->f20170727->CurrentValue;
		$this->f20170727->ViewCustomAttributes = "";

		// f20170728
		$this->f20170728->ViewValue = $this->f20170728->CurrentValue;
		$this->f20170728->ViewCustomAttributes = "";

		// f20170729
		$this->f20170729->ViewValue = $this->f20170729->CurrentValue;
		$this->f20170729->ViewCustomAttributes = "";

		// f20170730
		$this->f20170730->ViewValue = $this->f20170730->CurrentValue;
		$this->f20170730->ViewCustomAttributes = "";

		// f20170731
		$this->f20170731->ViewValue = $this->f20170731->CurrentValue;
		$this->f20170731->ViewCustomAttributes = "";

		// f20170801
		$this->f20170801->ViewValue = $this->f20170801->CurrentValue;
		$this->f20170801->ViewCustomAttributes = "";

		// f20170802
		$this->f20170802->ViewValue = $this->f20170802->CurrentValue;
		$this->f20170802->ViewCustomAttributes = "";

		// f20170803
		$this->f20170803->ViewValue = $this->f20170803->CurrentValue;
		$this->f20170803->ViewCustomAttributes = "";

		// f20170804
		$this->f20170804->ViewValue = $this->f20170804->CurrentValue;
		$this->f20170804->ViewCustomAttributes = "";

		// f20170805
		$this->f20170805->ViewValue = $this->f20170805->CurrentValue;
		$this->f20170805->ViewCustomAttributes = "";

		// f20170806
		$this->f20170806->ViewValue = $this->f20170806->CurrentValue;
		$this->f20170806->ViewCustomAttributes = "";

		// f20170807
		$this->f20170807->ViewValue = $this->f20170807->CurrentValue;
		$this->f20170807->ViewCustomAttributes = "";

		// f20170808
		$this->f20170808->ViewValue = $this->f20170808->CurrentValue;
		$this->f20170808->ViewCustomAttributes = "";

		// f20170809
		$this->f20170809->ViewValue = $this->f20170809->CurrentValue;
		$this->f20170809->ViewCustomAttributes = "";

		// f20170810
		$this->f20170810->ViewValue = $this->f20170810->CurrentValue;
		$this->f20170810->ViewCustomAttributes = "";

		// f20170811
		$this->f20170811->ViewValue = $this->f20170811->CurrentValue;
		$this->f20170811->ViewCustomAttributes = "";

		// f20170812
		$this->f20170812->ViewValue = $this->f20170812->CurrentValue;
		$this->f20170812->ViewCustomAttributes = "";

		// f20170813
		$this->f20170813->ViewValue = $this->f20170813->CurrentValue;
		$this->f20170813->ViewCustomAttributes = "";

		// f20170814
		$this->f20170814->ViewValue = $this->f20170814->CurrentValue;
		$this->f20170814->ViewCustomAttributes = "";

		// f20170815
		$this->f20170815->ViewValue = $this->f20170815->CurrentValue;
		$this->f20170815->ViewCustomAttributes = "";

		// f20170816
		$this->f20170816->ViewValue = $this->f20170816->CurrentValue;
		$this->f20170816->ViewCustomAttributes = "";

		// f20170817
		$this->f20170817->ViewValue = $this->f20170817->CurrentValue;
		$this->f20170817->ViewCustomAttributes = "";

		// f20170818
		$this->f20170818->ViewValue = $this->f20170818->CurrentValue;
		$this->f20170818->ViewCustomAttributes = "";

		// f20170819
		$this->f20170819->ViewValue = $this->f20170819->CurrentValue;
		$this->f20170819->ViewCustomAttributes = "";

		// f20170820
		$this->f20170820->ViewValue = $this->f20170820->CurrentValue;
		$this->f20170820->ViewCustomAttributes = "";

		// f20170821
		$this->f20170821->ViewValue = $this->f20170821->CurrentValue;
		$this->f20170821->ViewCustomAttributes = "";

		// f20170822
		$this->f20170822->ViewValue = $this->f20170822->CurrentValue;
		$this->f20170822->ViewCustomAttributes = "";

		// f20170823
		$this->f20170823->ViewValue = $this->f20170823->CurrentValue;
		$this->f20170823->ViewCustomAttributes = "";

		// f20170824
		$this->f20170824->ViewValue = $this->f20170824->CurrentValue;
		$this->f20170824->ViewCustomAttributes = "";

		// f20170825
		$this->f20170825->ViewValue = $this->f20170825->CurrentValue;
		$this->f20170825->ViewCustomAttributes = "";

		// f20170826
		$this->f20170826->ViewValue = $this->f20170826->CurrentValue;
		$this->f20170826->ViewCustomAttributes = "";

		// f20170827
		$this->f20170827->ViewValue = $this->f20170827->CurrentValue;
		$this->f20170827->ViewCustomAttributes = "";

		// f20170828
		$this->f20170828->ViewValue = $this->f20170828->CurrentValue;
		$this->f20170828->ViewCustomAttributes = "";

		// f20170829
		$this->f20170829->ViewValue = $this->f20170829->CurrentValue;
		$this->f20170829->ViewCustomAttributes = "";

		// f20170830
		$this->f20170830->ViewValue = $this->f20170830->CurrentValue;
		$this->f20170830->ViewCustomAttributes = "";

		// f20170831
		$this->f20170831->ViewValue = $this->f20170831->CurrentValue;
		$this->f20170831->ViewCustomAttributes = "";

		// f20170901
		$this->f20170901->ViewValue = $this->f20170901->CurrentValue;
		$this->f20170901->ViewCustomAttributes = "";

		// f20170902
		$this->f20170902->ViewValue = $this->f20170902->CurrentValue;
		$this->f20170902->ViewCustomAttributes = "";

		// f20170903
		$this->f20170903->ViewValue = $this->f20170903->CurrentValue;
		$this->f20170903->ViewCustomAttributes = "";

		// f20170904
		$this->f20170904->ViewValue = $this->f20170904->CurrentValue;
		$this->f20170904->ViewCustomAttributes = "";

		// f20170905
		$this->f20170905->ViewValue = $this->f20170905->CurrentValue;
		$this->f20170905->ViewCustomAttributes = "";

		// f20170906
		$this->f20170906->ViewValue = $this->f20170906->CurrentValue;
		$this->f20170906->ViewCustomAttributes = "";

		// f20170907
		$this->f20170907->ViewValue = $this->f20170907->CurrentValue;
		$this->f20170907->ViewCustomAttributes = "";

		// f20170908
		$this->f20170908->ViewValue = $this->f20170908->CurrentValue;
		$this->f20170908->ViewCustomAttributes = "";

		// f20170909
		$this->f20170909->ViewValue = $this->f20170909->CurrentValue;
		$this->f20170909->ViewCustomAttributes = "";

		// f20170910
		$this->f20170910->ViewValue = $this->f20170910->CurrentValue;
		$this->f20170910->ViewCustomAttributes = "";

		// f20170911
		$this->f20170911->ViewValue = $this->f20170911->CurrentValue;
		$this->f20170911->ViewCustomAttributes = "";

		// f20170912
		$this->f20170912->ViewValue = $this->f20170912->CurrentValue;
		$this->f20170912->ViewCustomAttributes = "";

		// f20170913
		$this->f20170913->ViewValue = $this->f20170913->CurrentValue;
		$this->f20170913->ViewCustomAttributes = "";

		// f20170914
		$this->f20170914->ViewValue = $this->f20170914->CurrentValue;
		$this->f20170914->ViewCustomAttributes = "";

		// f20170915
		$this->f20170915->ViewValue = $this->f20170915->CurrentValue;
		$this->f20170915->ViewCustomAttributes = "";

		// f20170916
		$this->f20170916->ViewValue = $this->f20170916->CurrentValue;
		$this->f20170916->ViewCustomAttributes = "";

		// f20170917
		$this->f20170917->ViewValue = $this->f20170917->CurrentValue;
		$this->f20170917->ViewCustomAttributes = "";

		// f20170918
		$this->f20170918->ViewValue = $this->f20170918->CurrentValue;
		$this->f20170918->ViewCustomAttributes = "";

		// f20170919
		$this->f20170919->ViewValue = $this->f20170919->CurrentValue;
		$this->f20170919->ViewCustomAttributes = "";

		// f20170920
		$this->f20170920->ViewValue = $this->f20170920->CurrentValue;
		$this->f20170920->ViewCustomAttributes = "";

		// f20170921
		$this->f20170921->ViewValue = $this->f20170921->CurrentValue;
		$this->f20170921->ViewCustomAttributes = "";

		// f20170922
		$this->f20170922->ViewValue = $this->f20170922->CurrentValue;
		$this->f20170922->ViewCustomAttributes = "";

		// f20170923
		$this->f20170923->ViewValue = $this->f20170923->CurrentValue;
		$this->f20170923->ViewCustomAttributes = "";

		// f20170924
		$this->f20170924->ViewValue = $this->f20170924->CurrentValue;
		$this->f20170924->ViewCustomAttributes = "";

		// f20170925
		$this->f20170925->ViewValue = $this->f20170925->CurrentValue;
		$this->f20170925->ViewCustomAttributes = "";

		// f20170926
		$this->f20170926->ViewValue = $this->f20170926->CurrentValue;
		$this->f20170926->ViewCustomAttributes = "";

		// f20170927
		$this->f20170927->ViewValue = $this->f20170927->CurrentValue;
		$this->f20170927->ViewCustomAttributes = "";

		// f20170928
		$this->f20170928->ViewValue = $this->f20170928->CurrentValue;
		$this->f20170928->ViewCustomAttributes = "";

		// f20170929
		$this->f20170929->ViewValue = $this->f20170929->CurrentValue;
		$this->f20170929->ViewCustomAttributes = "";

		// f20170930
		$this->f20170930->ViewValue = $this->f20170930->CurrentValue;
		$this->f20170930->ViewCustomAttributes = "";

		// f20171001
		$this->f20171001->ViewValue = $this->f20171001->CurrentValue;
		$this->f20171001->ViewCustomAttributes = "";

		// f20171002
		$this->f20171002->ViewValue = $this->f20171002->CurrentValue;
		$this->f20171002->ViewCustomAttributes = "";

		// f20171003
		$this->f20171003->ViewValue = $this->f20171003->CurrentValue;
		$this->f20171003->ViewCustomAttributes = "";

		// f20171004
		$this->f20171004->ViewValue = $this->f20171004->CurrentValue;
		$this->f20171004->ViewCustomAttributes = "";

		// f20171005
		$this->f20171005->ViewValue = $this->f20171005->CurrentValue;
		$this->f20171005->ViewCustomAttributes = "";

		// f20171006
		$this->f20171006->ViewValue = $this->f20171006->CurrentValue;
		$this->f20171006->ViewCustomAttributes = "";

		// f20171007
		$this->f20171007->ViewValue = $this->f20171007->CurrentValue;
		$this->f20171007->ViewCustomAttributes = "";

		// f20171008
		$this->f20171008->ViewValue = $this->f20171008->CurrentValue;
		$this->f20171008->ViewCustomAttributes = "";

		// f20171009
		$this->f20171009->ViewValue = $this->f20171009->CurrentValue;
		$this->f20171009->ViewCustomAttributes = "";

		// f20171010
		$this->f20171010->ViewValue = $this->f20171010->CurrentValue;
		$this->f20171010->ViewCustomAttributes = "";

		// f20171011
		$this->f20171011->ViewValue = $this->f20171011->CurrentValue;
		$this->f20171011->ViewCustomAttributes = "";

		// f20171012
		$this->f20171012->ViewValue = $this->f20171012->CurrentValue;
		$this->f20171012->ViewCustomAttributes = "";

		// f20171013
		$this->f20171013->ViewValue = $this->f20171013->CurrentValue;
		$this->f20171013->ViewCustomAttributes = "";

		// f20171014
		$this->f20171014->ViewValue = $this->f20171014->CurrentValue;
		$this->f20171014->ViewCustomAttributes = "";

		// f20171015
		$this->f20171015->ViewValue = $this->f20171015->CurrentValue;
		$this->f20171015->ViewCustomAttributes = "";

		// f20171016
		$this->f20171016->ViewValue = $this->f20171016->CurrentValue;
		$this->f20171016->ViewCustomAttributes = "";

		// f20171017
		$this->f20171017->ViewValue = $this->f20171017->CurrentValue;
		$this->f20171017->ViewCustomAttributes = "";

		// f20171018
		$this->f20171018->ViewValue = $this->f20171018->CurrentValue;
		$this->f20171018->ViewCustomAttributes = "";

		// f20171019
		$this->f20171019->ViewValue = $this->f20171019->CurrentValue;
		$this->f20171019->ViewCustomAttributes = "";

		// f20171020
		$this->f20171020->ViewValue = $this->f20171020->CurrentValue;
		$this->f20171020->ViewCustomAttributes = "";

		// f20171021
		$this->f20171021->ViewValue = $this->f20171021->CurrentValue;
		$this->f20171021->ViewCustomAttributes = "";

		// f20171022
		$this->f20171022->ViewValue = $this->f20171022->CurrentValue;
		$this->f20171022->ViewCustomAttributes = "";

		// f20171023
		$this->f20171023->ViewValue = $this->f20171023->CurrentValue;
		$this->f20171023->ViewCustomAttributes = "";

		// f20171024
		$this->f20171024->ViewValue = $this->f20171024->CurrentValue;
		$this->f20171024->ViewCustomAttributes = "";

		// f20171025
		$this->f20171025->ViewValue = $this->f20171025->CurrentValue;
		$this->f20171025->ViewCustomAttributes = "";

		// f20171026
		$this->f20171026->ViewValue = $this->f20171026->CurrentValue;
		$this->f20171026->ViewCustomAttributes = "";

		// f20171027
		$this->f20171027->ViewValue = $this->f20171027->CurrentValue;
		$this->f20171027->ViewCustomAttributes = "";

		// f20171028
		$this->f20171028->ViewValue = $this->f20171028->CurrentValue;
		$this->f20171028->ViewCustomAttributes = "";

		// f20171029
		$this->f20171029->ViewValue = $this->f20171029->CurrentValue;
		$this->f20171029->ViewCustomAttributes = "";

		// f20171030
		$this->f20171030->ViewValue = $this->f20171030->CurrentValue;
		$this->f20171030->ViewCustomAttributes = "";

		// f20171031
		$this->f20171031->ViewValue = $this->f20171031->CurrentValue;
		$this->f20171031->ViewCustomAttributes = "";

		// f20171101
		$this->f20171101->ViewValue = $this->f20171101->CurrentValue;
		$this->f20171101->ViewCustomAttributes = "";

		// f20171102
		$this->f20171102->ViewValue = $this->f20171102->CurrentValue;
		$this->f20171102->ViewCustomAttributes = "";

		// f20171103
		$this->f20171103->ViewValue = $this->f20171103->CurrentValue;
		$this->f20171103->ViewCustomAttributes = "";

		// f20171104
		$this->f20171104->ViewValue = $this->f20171104->CurrentValue;
		$this->f20171104->ViewCustomAttributes = "";

		// f20171105
		$this->f20171105->ViewValue = $this->f20171105->CurrentValue;
		$this->f20171105->ViewCustomAttributes = "";

		// f20171106
		$this->f20171106->ViewValue = $this->f20171106->CurrentValue;
		$this->f20171106->ViewCustomAttributes = "";

		// f20171107
		$this->f20171107->ViewValue = $this->f20171107->CurrentValue;
		$this->f20171107->ViewCustomAttributes = "";

		// f20171108
		$this->f20171108->ViewValue = $this->f20171108->CurrentValue;
		$this->f20171108->ViewCustomAttributes = "";

		// f20171109
		$this->f20171109->ViewValue = $this->f20171109->CurrentValue;
		$this->f20171109->ViewCustomAttributes = "";

		// f20171110
		$this->f20171110->ViewValue = $this->f20171110->CurrentValue;
		$this->f20171110->ViewCustomAttributes = "";

		// f20171111
		$this->f20171111->ViewValue = $this->f20171111->CurrentValue;
		$this->f20171111->ViewCustomAttributes = "";

		// f20171112
		$this->f20171112->ViewValue = $this->f20171112->CurrentValue;
		$this->f20171112->ViewCustomAttributes = "";

		// f20171113
		$this->f20171113->ViewValue = $this->f20171113->CurrentValue;
		$this->f20171113->ViewCustomAttributes = "";

		// f20171114
		$this->f20171114->ViewValue = $this->f20171114->CurrentValue;
		$this->f20171114->ViewCustomAttributes = "";

		// f20171115
		$this->f20171115->ViewValue = $this->f20171115->CurrentValue;
		$this->f20171115->ViewCustomAttributes = "";

		// f20171116
		$this->f20171116->ViewValue = $this->f20171116->CurrentValue;
		$this->f20171116->ViewCustomAttributes = "";

		// f20171117
		$this->f20171117->ViewValue = $this->f20171117->CurrentValue;
		$this->f20171117->ViewCustomAttributes = "";

		// f20171118
		$this->f20171118->ViewValue = $this->f20171118->CurrentValue;
		$this->f20171118->ViewCustomAttributes = "";

		// f20171119
		$this->f20171119->ViewValue = $this->f20171119->CurrentValue;
		$this->f20171119->ViewCustomAttributes = "";

		// f20171120
		$this->f20171120->ViewValue = $this->f20171120->CurrentValue;
		$this->f20171120->ViewCustomAttributes = "";

		// f20171121
		$this->f20171121->ViewValue = $this->f20171121->CurrentValue;
		$this->f20171121->ViewCustomAttributes = "";

		// f20171122
		$this->f20171122->ViewValue = $this->f20171122->CurrentValue;
		$this->f20171122->ViewCustomAttributes = "";

		// f20171123
		$this->f20171123->ViewValue = $this->f20171123->CurrentValue;
		$this->f20171123->ViewCustomAttributes = "";

		// f20171124
		$this->f20171124->ViewValue = $this->f20171124->CurrentValue;
		$this->f20171124->ViewCustomAttributes = "";

		// f20171125
		$this->f20171125->ViewValue = $this->f20171125->CurrentValue;
		$this->f20171125->ViewCustomAttributes = "";

		// f20171126
		$this->f20171126->ViewValue = $this->f20171126->CurrentValue;
		$this->f20171126->ViewCustomAttributes = "";

		// f20171127
		$this->f20171127->ViewValue = $this->f20171127->CurrentValue;
		$this->f20171127->ViewCustomAttributes = "";

		// f20171128
		$this->f20171128->ViewValue = $this->f20171128->CurrentValue;
		$this->f20171128->ViewCustomAttributes = "";

		// f20171129
		$this->f20171129->ViewValue = $this->f20171129->CurrentValue;
		$this->f20171129->ViewCustomAttributes = "";

		// f20171130
		$this->f20171130->ViewValue = $this->f20171130->CurrentValue;
		$this->f20171130->ViewCustomAttributes = "";

		// f20171201
		$this->f20171201->ViewValue = $this->f20171201->CurrentValue;
		$this->f20171201->ViewCustomAttributes = "";

		// f20171202
		$this->f20171202->ViewValue = $this->f20171202->CurrentValue;
		$this->f20171202->ViewCustomAttributes = "";

		// f20171203
		$this->f20171203->ViewValue = $this->f20171203->CurrentValue;
		$this->f20171203->ViewCustomAttributes = "";

		// f20171204
		$this->f20171204->ViewValue = $this->f20171204->CurrentValue;
		$this->f20171204->ViewCustomAttributes = "";

		// f20171205
		$this->f20171205->ViewValue = $this->f20171205->CurrentValue;
		$this->f20171205->ViewCustomAttributes = "";

		// f20171206
		$this->f20171206->ViewValue = $this->f20171206->CurrentValue;
		$this->f20171206->ViewCustomAttributes = "";

		// f20171207
		$this->f20171207->ViewValue = $this->f20171207->CurrentValue;
		$this->f20171207->ViewCustomAttributes = "";

		// f20171208
		$this->f20171208->ViewValue = $this->f20171208->CurrentValue;
		$this->f20171208->ViewCustomAttributes = "";

		// f20171209
		$this->f20171209->ViewValue = $this->f20171209->CurrentValue;
		$this->f20171209->ViewCustomAttributes = "";

		// f20171210
		$this->f20171210->ViewValue = $this->f20171210->CurrentValue;
		$this->f20171210->ViewCustomAttributes = "";

		// f20171211
		$this->f20171211->ViewValue = $this->f20171211->CurrentValue;
		$this->f20171211->ViewCustomAttributes = "";

		// f20171212
		$this->f20171212->ViewValue = $this->f20171212->CurrentValue;
		$this->f20171212->ViewCustomAttributes = "";

		// f20171213
		$this->f20171213->ViewValue = $this->f20171213->CurrentValue;
		$this->f20171213->ViewCustomAttributes = "";

		// f20171214
		$this->f20171214->ViewValue = $this->f20171214->CurrentValue;
		$this->f20171214->ViewCustomAttributes = "";

		// f20171215
		$this->f20171215->ViewValue = $this->f20171215->CurrentValue;
		$this->f20171215->ViewCustomAttributes = "";

		// f20171216
		$this->f20171216->ViewValue = $this->f20171216->CurrentValue;
		$this->f20171216->ViewCustomAttributes = "";

		// f20171217
		$this->f20171217->ViewValue = $this->f20171217->CurrentValue;
		$this->f20171217->ViewCustomAttributes = "";

		// f20171218
		$this->f20171218->ViewValue = $this->f20171218->CurrentValue;
		$this->f20171218->ViewCustomAttributes = "";

		// f20171219
		$this->f20171219->ViewValue = $this->f20171219->CurrentValue;
		$this->f20171219->ViewCustomAttributes = "";

		// f20171220
		$this->f20171220->ViewValue = $this->f20171220->CurrentValue;
		$this->f20171220->ViewCustomAttributes = "";

		// f20171221
		$this->f20171221->ViewValue = $this->f20171221->CurrentValue;
		$this->f20171221->ViewCustomAttributes = "";

		// f20171222
		$this->f20171222->ViewValue = $this->f20171222->CurrentValue;
		$this->f20171222->ViewCustomAttributes = "";

		// f20171223
		$this->f20171223->ViewValue = $this->f20171223->CurrentValue;
		$this->f20171223->ViewCustomAttributes = "";

		// f20171224
		$this->f20171224->ViewValue = $this->f20171224->CurrentValue;
		$this->f20171224->ViewCustomAttributes = "";

		// f20171225
		$this->f20171225->ViewValue = $this->f20171225->CurrentValue;
		$this->f20171225->ViewCustomAttributes = "";

		// f20171226
		$this->f20171226->ViewValue = $this->f20171226->CurrentValue;
		$this->f20171226->ViewCustomAttributes = "";

		// f20171227
		$this->f20171227->ViewValue = $this->f20171227->CurrentValue;
		$this->f20171227->ViewCustomAttributes = "";

		// f20171228
		$this->f20171228->ViewValue = $this->f20171228->CurrentValue;
		$this->f20171228->ViewCustomAttributes = "";

		// f20171229
		$this->f20171229->ViewValue = $this->f20171229->CurrentValue;
		$this->f20171229->ViewCustomAttributes = "";

		// f20171230
		$this->f20171230->ViewValue = $this->f20171230->CurrentValue;
		$this->f20171230->ViewCustomAttributes = "";

		// f20171231
		if ($this->f20171231->VirtualValue <> "") {
			$this->f20171231->ViewValue = $this->f20171231->VirtualValue;
		} else {
			$this->f20171231->ViewValue = $this->f20171231->CurrentValue;
		if (strval($this->f20171231->CurrentValue) <> "") {
			$sFilterWrk = "`jk_id`" . ew_SearchString("=", $this->f20171231->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `jk_id`, `jk_nm` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t_jk`";
		$sWhereWrk = "";
		$this->f20171231->LookupFilters = array("dx1" => '`jk_nm`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->f20171231, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->f20171231->ViewValue = $this->f20171231->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->f20171231->ViewValue = $this->f20171231->CurrentValue;
			}
		} else {
			$this->f20171231->ViewValue = NULL;
		}
		}
		$this->f20171231->ViewCustomAttributes = "";

			// pegawai_id
			$this->pegawai_id->LinkCustomAttributes = "";
			$this->pegawai_id->HrefValue = "";
			$this->pegawai_id->TooltipValue = "";

			// f20170101
			$this->f20170101->LinkCustomAttributes = "";
			$this->f20170101->HrefValue = "";
			$this->f20170101->TooltipValue = "";

			// f20170102
			$this->f20170102->LinkCustomAttributes = "";
			$this->f20170102->HrefValue = "";
			$this->f20170102->TooltipValue = "";

			// f20170103
			$this->f20170103->LinkCustomAttributes = "";
			$this->f20170103->HrefValue = "";
			$this->f20170103->TooltipValue = "";

			// f20170104
			$this->f20170104->LinkCustomAttributes = "";
			$this->f20170104->HrefValue = "";
			$this->f20170104->TooltipValue = "";

			// f20170105
			$this->f20170105->LinkCustomAttributes = "";
			$this->f20170105->HrefValue = "";
			$this->f20170105->TooltipValue = "";

			// f20170106
			$this->f20170106->LinkCustomAttributes = "";
			$this->f20170106->HrefValue = "";
			$this->f20170106->TooltipValue = "";

			// f20170107
			$this->f20170107->LinkCustomAttributes = "";
			$this->f20170107->HrefValue = "";
			$this->f20170107->TooltipValue = "";

			// f20170108
			$this->f20170108->LinkCustomAttributes = "";
			$this->f20170108->HrefValue = "";
			$this->f20170108->TooltipValue = "";

			// f20170109
			$this->f20170109->LinkCustomAttributes = "";
			$this->f20170109->HrefValue = "";
			$this->f20170109->TooltipValue = "";

			// f20170110
			$this->f20170110->LinkCustomAttributes = "";
			$this->f20170110->HrefValue = "";
			$this->f20170110->TooltipValue = "";

			// f20170111
			$this->f20170111->LinkCustomAttributes = "";
			$this->f20170111->HrefValue = "";
			$this->f20170111->TooltipValue = "";

			// f20170112
			$this->f20170112->LinkCustomAttributes = "";
			$this->f20170112->HrefValue = "";
			$this->f20170112->TooltipValue = "";

			// f20170113
			$this->f20170113->LinkCustomAttributes = "";
			$this->f20170113->HrefValue = "";
			$this->f20170113->TooltipValue = "";

			// f20170114
			$this->f20170114->LinkCustomAttributes = "";
			$this->f20170114->HrefValue = "";
			$this->f20170114->TooltipValue = "";

			// f20170115
			$this->f20170115->LinkCustomAttributes = "";
			$this->f20170115->HrefValue = "";
			$this->f20170115->TooltipValue = "";

			// f20170116
			$this->f20170116->LinkCustomAttributes = "";
			$this->f20170116->HrefValue = "";
			$this->f20170116->TooltipValue = "";

			// f20170117
			$this->f20170117->LinkCustomAttributes = "";
			$this->f20170117->HrefValue = "";
			$this->f20170117->TooltipValue = "";

			// f20170118
			$this->f20170118->LinkCustomAttributes = "";
			$this->f20170118->HrefValue = "";
			$this->f20170118->TooltipValue = "";

			// f20170119
			$this->f20170119->LinkCustomAttributes = "";
			$this->f20170119->HrefValue = "";
			$this->f20170119->TooltipValue = "";

			// f20170120
			$this->f20170120->LinkCustomAttributes = "";
			$this->f20170120->HrefValue = "";
			$this->f20170120->TooltipValue = "";

			// f20170121
			$this->f20170121->LinkCustomAttributes = "";
			$this->f20170121->HrefValue = "";
			$this->f20170121->TooltipValue = "";

			// f20170122
			$this->f20170122->LinkCustomAttributes = "";
			$this->f20170122->HrefValue = "";
			$this->f20170122->TooltipValue = "";

			// f20170123
			$this->f20170123->LinkCustomAttributes = "";
			$this->f20170123->HrefValue = "";
			$this->f20170123->TooltipValue = "";

			// f20170124
			$this->f20170124->LinkCustomAttributes = "";
			$this->f20170124->HrefValue = "";
			$this->f20170124->TooltipValue = "";

			// f20170125
			$this->f20170125->LinkCustomAttributes = "";
			$this->f20170125->HrefValue = "";
			$this->f20170125->TooltipValue = "";

			// f20170126
			$this->f20170126->LinkCustomAttributes = "";
			$this->f20170126->HrefValue = "";
			$this->f20170126->TooltipValue = "";

			// f20170127
			$this->f20170127->LinkCustomAttributes = "";
			$this->f20170127->HrefValue = "";
			$this->f20170127->TooltipValue = "";

			// f20170128
			$this->f20170128->LinkCustomAttributes = "";
			$this->f20170128->HrefValue = "";
			$this->f20170128->TooltipValue = "";

			// f20170129
			$this->f20170129->LinkCustomAttributes = "";
			$this->f20170129->HrefValue = "";
			$this->f20170129->TooltipValue = "";

			// f20170130
			$this->f20170130->LinkCustomAttributes = "";
			$this->f20170130->HrefValue = "";
			$this->f20170130->TooltipValue = "";

			// f20170131
			$this->f20170131->LinkCustomAttributes = "";
			$this->f20170131->HrefValue = "";
			$this->f20170131->TooltipValue = "";

			// f20170201
			$this->f20170201->LinkCustomAttributes = "";
			$this->f20170201->HrefValue = "";
			$this->f20170201->TooltipValue = "";

			// f20170202
			$this->f20170202->LinkCustomAttributes = "";
			$this->f20170202->HrefValue = "";
			$this->f20170202->TooltipValue = "";

			// f20170203
			$this->f20170203->LinkCustomAttributes = "";
			$this->f20170203->HrefValue = "";
			$this->f20170203->TooltipValue = "";

			// f20170204
			$this->f20170204->LinkCustomAttributes = "";
			$this->f20170204->HrefValue = "";
			$this->f20170204->TooltipValue = "";

			// f20170205
			$this->f20170205->LinkCustomAttributes = "";
			$this->f20170205->HrefValue = "";
			$this->f20170205->TooltipValue = "";

			// f20170206
			$this->f20170206->LinkCustomAttributes = "";
			$this->f20170206->HrefValue = "";
			$this->f20170206->TooltipValue = "";

			// f20170207
			$this->f20170207->LinkCustomAttributes = "";
			$this->f20170207->HrefValue = "";
			$this->f20170207->TooltipValue = "";

			// f20170208
			$this->f20170208->LinkCustomAttributes = "";
			$this->f20170208->HrefValue = "";
			$this->f20170208->TooltipValue = "";

			// f20170209
			$this->f20170209->LinkCustomAttributes = "";
			$this->f20170209->HrefValue = "";
			$this->f20170209->TooltipValue = "";

			// f20170210
			$this->f20170210->LinkCustomAttributes = "";
			$this->f20170210->HrefValue = "";
			$this->f20170210->TooltipValue = "";

			// f20170211
			$this->f20170211->LinkCustomAttributes = "";
			$this->f20170211->HrefValue = "";
			$this->f20170211->TooltipValue = "";

			// f20170212
			$this->f20170212->LinkCustomAttributes = "";
			$this->f20170212->HrefValue = "";
			$this->f20170212->TooltipValue = "";

			// f20170213
			$this->f20170213->LinkCustomAttributes = "";
			$this->f20170213->HrefValue = "";
			$this->f20170213->TooltipValue = "";

			// f20170214
			$this->f20170214->LinkCustomAttributes = "";
			$this->f20170214->HrefValue = "";
			$this->f20170214->TooltipValue = "";

			// f20170215
			$this->f20170215->LinkCustomAttributes = "";
			$this->f20170215->HrefValue = "";
			$this->f20170215->TooltipValue = "";

			// f20170216
			$this->f20170216->LinkCustomAttributes = "";
			$this->f20170216->HrefValue = "";
			$this->f20170216->TooltipValue = "";

			// f20170217
			$this->f20170217->LinkCustomAttributes = "";
			$this->f20170217->HrefValue = "";
			$this->f20170217->TooltipValue = "";

			// f20170218
			$this->f20170218->LinkCustomAttributes = "";
			$this->f20170218->HrefValue = "";
			$this->f20170218->TooltipValue = "";

			// f20170219
			$this->f20170219->LinkCustomAttributes = "";
			$this->f20170219->HrefValue = "";
			$this->f20170219->TooltipValue = "";

			// f20170220
			$this->f20170220->LinkCustomAttributes = "";
			$this->f20170220->HrefValue = "";
			$this->f20170220->TooltipValue = "";

			// f20170221
			$this->f20170221->LinkCustomAttributes = "";
			$this->f20170221->HrefValue = "";
			$this->f20170221->TooltipValue = "";

			// f20170222
			$this->f20170222->LinkCustomAttributes = "";
			$this->f20170222->HrefValue = "";
			$this->f20170222->TooltipValue = "";

			// f20170223
			$this->f20170223->LinkCustomAttributes = "";
			$this->f20170223->HrefValue = "";
			$this->f20170223->TooltipValue = "";

			// f20170224
			$this->f20170224->LinkCustomAttributes = "";
			$this->f20170224->HrefValue = "";
			$this->f20170224->TooltipValue = "";

			// f20170225
			$this->f20170225->LinkCustomAttributes = "";
			$this->f20170225->HrefValue = "";
			$this->f20170225->TooltipValue = "";

			// f20170226
			$this->f20170226->LinkCustomAttributes = "";
			$this->f20170226->HrefValue = "";
			$this->f20170226->TooltipValue = "";

			// f20170227
			$this->f20170227->LinkCustomAttributes = "";
			$this->f20170227->HrefValue = "";
			$this->f20170227->TooltipValue = "";

			// f20170228
			$this->f20170228->LinkCustomAttributes = "";
			$this->f20170228->HrefValue = "";
			$this->f20170228->TooltipValue = "";

			// f20170229
			$this->f20170229->LinkCustomAttributes = "";
			$this->f20170229->HrefValue = "";
			$this->f20170229->TooltipValue = "";

			// f20170301
			$this->f20170301->LinkCustomAttributes = "";
			$this->f20170301->HrefValue = "";
			$this->f20170301->TooltipValue = "";

			// f20170302
			$this->f20170302->LinkCustomAttributes = "";
			$this->f20170302->HrefValue = "";
			$this->f20170302->TooltipValue = "";

			// f20170303
			$this->f20170303->LinkCustomAttributes = "";
			$this->f20170303->HrefValue = "";
			$this->f20170303->TooltipValue = "";

			// f20170304
			$this->f20170304->LinkCustomAttributes = "";
			$this->f20170304->HrefValue = "";
			$this->f20170304->TooltipValue = "";

			// f20170305
			$this->f20170305->LinkCustomAttributes = "";
			$this->f20170305->HrefValue = "";
			$this->f20170305->TooltipValue = "";

			// f20170306
			$this->f20170306->LinkCustomAttributes = "";
			$this->f20170306->HrefValue = "";
			$this->f20170306->TooltipValue = "";

			// f20170307
			$this->f20170307->LinkCustomAttributes = "";
			$this->f20170307->HrefValue = "";
			$this->f20170307->TooltipValue = "";

			// f20170308
			$this->f20170308->LinkCustomAttributes = "";
			$this->f20170308->HrefValue = "";
			$this->f20170308->TooltipValue = "";

			// f20170309
			$this->f20170309->LinkCustomAttributes = "";
			$this->f20170309->HrefValue = "";
			$this->f20170309->TooltipValue = "";

			// f20170310
			$this->f20170310->LinkCustomAttributes = "";
			$this->f20170310->HrefValue = "";
			$this->f20170310->TooltipValue = "";

			// f20170311
			$this->f20170311->LinkCustomAttributes = "";
			$this->f20170311->HrefValue = "";
			$this->f20170311->TooltipValue = "";

			// f20170312
			$this->f20170312->LinkCustomAttributes = "";
			$this->f20170312->HrefValue = "";
			$this->f20170312->TooltipValue = "";

			// f20170313
			$this->f20170313->LinkCustomAttributes = "";
			$this->f20170313->HrefValue = "";
			$this->f20170313->TooltipValue = "";

			// f20170314
			$this->f20170314->LinkCustomAttributes = "";
			$this->f20170314->HrefValue = "";
			$this->f20170314->TooltipValue = "";

			// f20170315
			$this->f20170315->LinkCustomAttributes = "";
			$this->f20170315->HrefValue = "";
			$this->f20170315->TooltipValue = "";

			// f20170316
			$this->f20170316->LinkCustomAttributes = "";
			$this->f20170316->HrefValue = "";
			$this->f20170316->TooltipValue = "";

			// f20170317
			$this->f20170317->LinkCustomAttributes = "";
			$this->f20170317->HrefValue = "";
			$this->f20170317->TooltipValue = "";

			// f20170318
			$this->f20170318->LinkCustomAttributes = "";
			$this->f20170318->HrefValue = "";
			$this->f20170318->TooltipValue = "";

			// f20170319
			$this->f20170319->LinkCustomAttributes = "";
			$this->f20170319->HrefValue = "";
			$this->f20170319->TooltipValue = "";

			// f20170320
			$this->f20170320->LinkCustomAttributes = "";
			$this->f20170320->HrefValue = "";
			$this->f20170320->TooltipValue = "";

			// f20170321
			$this->f20170321->LinkCustomAttributes = "";
			$this->f20170321->HrefValue = "";
			$this->f20170321->TooltipValue = "";

			// f20170322
			$this->f20170322->LinkCustomAttributes = "";
			$this->f20170322->HrefValue = "";
			$this->f20170322->TooltipValue = "";

			// f20170323
			$this->f20170323->LinkCustomAttributes = "";
			$this->f20170323->HrefValue = "";
			$this->f20170323->TooltipValue = "";

			// f20170324
			$this->f20170324->LinkCustomAttributes = "";
			$this->f20170324->HrefValue = "";
			$this->f20170324->TooltipValue = "";

			// f20170325
			$this->f20170325->LinkCustomAttributes = "";
			$this->f20170325->HrefValue = "";
			$this->f20170325->TooltipValue = "";

			// f20170326
			$this->f20170326->LinkCustomAttributes = "";
			$this->f20170326->HrefValue = "";
			$this->f20170326->TooltipValue = "";

			// f20170327
			$this->f20170327->LinkCustomAttributes = "";
			$this->f20170327->HrefValue = "";
			$this->f20170327->TooltipValue = "";

			// f20170328
			$this->f20170328->LinkCustomAttributes = "";
			$this->f20170328->HrefValue = "";
			$this->f20170328->TooltipValue = "";

			// f20170329
			$this->f20170329->LinkCustomAttributes = "";
			$this->f20170329->HrefValue = "";
			$this->f20170329->TooltipValue = "";

			// f20170330
			$this->f20170330->LinkCustomAttributes = "";
			$this->f20170330->HrefValue = "";
			$this->f20170330->TooltipValue = "";

			// f20170331
			$this->f20170331->LinkCustomAttributes = "";
			$this->f20170331->HrefValue = "";
			$this->f20170331->TooltipValue = "";

			// f20170401
			$this->f20170401->LinkCustomAttributes = "";
			$this->f20170401->HrefValue = "";
			$this->f20170401->TooltipValue = "";

			// f20170402
			$this->f20170402->LinkCustomAttributes = "";
			$this->f20170402->HrefValue = "";
			$this->f20170402->TooltipValue = "";

			// f20170403
			$this->f20170403->LinkCustomAttributes = "";
			$this->f20170403->HrefValue = "";
			$this->f20170403->TooltipValue = "";

			// f20170404
			$this->f20170404->LinkCustomAttributes = "";
			$this->f20170404->HrefValue = "";
			$this->f20170404->TooltipValue = "";

			// f20170405
			$this->f20170405->LinkCustomAttributes = "";
			$this->f20170405->HrefValue = "";
			$this->f20170405->TooltipValue = "";

			// f20170406
			$this->f20170406->LinkCustomAttributes = "";
			$this->f20170406->HrefValue = "";
			$this->f20170406->TooltipValue = "";

			// f20170407
			$this->f20170407->LinkCustomAttributes = "";
			$this->f20170407->HrefValue = "";
			$this->f20170407->TooltipValue = "";

			// f20170408
			$this->f20170408->LinkCustomAttributes = "";
			$this->f20170408->HrefValue = "";
			$this->f20170408->TooltipValue = "";

			// f20170409
			$this->f20170409->LinkCustomAttributes = "";
			$this->f20170409->HrefValue = "";
			$this->f20170409->TooltipValue = "";

			// f20170410
			$this->f20170410->LinkCustomAttributes = "";
			$this->f20170410->HrefValue = "";
			$this->f20170410->TooltipValue = "";

			// f20170411
			$this->f20170411->LinkCustomAttributes = "";
			$this->f20170411->HrefValue = "";
			$this->f20170411->TooltipValue = "";

			// f20170412
			$this->f20170412->LinkCustomAttributes = "";
			$this->f20170412->HrefValue = "";
			$this->f20170412->TooltipValue = "";

			// f20170413
			$this->f20170413->LinkCustomAttributes = "";
			$this->f20170413->HrefValue = "";
			$this->f20170413->TooltipValue = "";

			// f20170414
			$this->f20170414->LinkCustomAttributes = "";
			$this->f20170414->HrefValue = "";
			$this->f20170414->TooltipValue = "";

			// f20170415
			$this->f20170415->LinkCustomAttributes = "";
			$this->f20170415->HrefValue = "";
			$this->f20170415->TooltipValue = "";

			// f20170416
			$this->f20170416->LinkCustomAttributes = "";
			$this->f20170416->HrefValue = "";
			$this->f20170416->TooltipValue = "";

			// f20170417
			$this->f20170417->LinkCustomAttributes = "";
			$this->f20170417->HrefValue = "";
			$this->f20170417->TooltipValue = "";

			// f20170418
			$this->f20170418->LinkCustomAttributes = "";
			$this->f20170418->HrefValue = "";
			$this->f20170418->TooltipValue = "";

			// f20170419
			$this->f20170419->LinkCustomAttributes = "";
			$this->f20170419->HrefValue = "";
			$this->f20170419->TooltipValue = "";

			// f20170420
			$this->f20170420->LinkCustomAttributes = "";
			$this->f20170420->HrefValue = "";
			$this->f20170420->TooltipValue = "";

			// f20170421
			$this->f20170421->LinkCustomAttributes = "";
			$this->f20170421->HrefValue = "";
			$this->f20170421->TooltipValue = "";

			// f20170422
			$this->f20170422->LinkCustomAttributes = "";
			$this->f20170422->HrefValue = "";
			$this->f20170422->TooltipValue = "";

			// f20170423
			$this->f20170423->LinkCustomAttributes = "";
			$this->f20170423->HrefValue = "";
			$this->f20170423->TooltipValue = "";

			// f20170424
			$this->f20170424->LinkCustomAttributes = "";
			$this->f20170424->HrefValue = "";
			$this->f20170424->TooltipValue = "";

			// f20170425
			$this->f20170425->LinkCustomAttributes = "";
			$this->f20170425->HrefValue = "";
			$this->f20170425->TooltipValue = "";

			// f20170426
			$this->f20170426->LinkCustomAttributes = "";
			$this->f20170426->HrefValue = "";
			$this->f20170426->TooltipValue = "";

			// f20170427
			$this->f20170427->LinkCustomAttributes = "";
			$this->f20170427->HrefValue = "";
			$this->f20170427->TooltipValue = "";

			// f20170428
			$this->f20170428->LinkCustomAttributes = "";
			$this->f20170428->HrefValue = "";
			$this->f20170428->TooltipValue = "";

			// f20170429
			$this->f20170429->LinkCustomAttributes = "";
			$this->f20170429->HrefValue = "";
			$this->f20170429->TooltipValue = "";

			// f20170430
			$this->f20170430->LinkCustomAttributes = "";
			$this->f20170430->HrefValue = "";
			$this->f20170430->TooltipValue = "";

			// f20170501
			$this->f20170501->LinkCustomAttributes = "";
			$this->f20170501->HrefValue = "";
			$this->f20170501->TooltipValue = "";

			// f20170502
			$this->f20170502->LinkCustomAttributes = "";
			$this->f20170502->HrefValue = "";
			$this->f20170502->TooltipValue = "";

			// f20170503
			$this->f20170503->LinkCustomAttributes = "";
			$this->f20170503->HrefValue = "";
			$this->f20170503->TooltipValue = "";

			// f20170504
			$this->f20170504->LinkCustomAttributes = "";
			$this->f20170504->HrefValue = "";
			$this->f20170504->TooltipValue = "";

			// f20170505
			$this->f20170505->LinkCustomAttributes = "";
			$this->f20170505->HrefValue = "";
			$this->f20170505->TooltipValue = "";

			// f20170506
			$this->f20170506->LinkCustomAttributes = "";
			$this->f20170506->HrefValue = "";
			$this->f20170506->TooltipValue = "";

			// f20170507
			$this->f20170507->LinkCustomAttributes = "";
			$this->f20170507->HrefValue = "";
			$this->f20170507->TooltipValue = "";

			// f20170508
			$this->f20170508->LinkCustomAttributes = "";
			$this->f20170508->HrefValue = "";
			$this->f20170508->TooltipValue = "";

			// f20170509
			$this->f20170509->LinkCustomAttributes = "";
			$this->f20170509->HrefValue = "";
			$this->f20170509->TooltipValue = "";

			// f20170510
			$this->f20170510->LinkCustomAttributes = "";
			$this->f20170510->HrefValue = "";
			$this->f20170510->TooltipValue = "";

			// f20170511
			$this->f20170511->LinkCustomAttributes = "";
			$this->f20170511->HrefValue = "";
			$this->f20170511->TooltipValue = "";

			// f20170512
			$this->f20170512->LinkCustomAttributes = "";
			$this->f20170512->HrefValue = "";
			$this->f20170512->TooltipValue = "";

			// f20170513
			$this->f20170513->LinkCustomAttributes = "";
			$this->f20170513->HrefValue = "";
			$this->f20170513->TooltipValue = "";

			// f20170514
			$this->f20170514->LinkCustomAttributes = "";
			$this->f20170514->HrefValue = "";
			$this->f20170514->TooltipValue = "";

			// f20170515
			$this->f20170515->LinkCustomAttributes = "";
			$this->f20170515->HrefValue = "";
			$this->f20170515->TooltipValue = "";

			// f20170516
			$this->f20170516->LinkCustomAttributes = "";
			$this->f20170516->HrefValue = "";
			$this->f20170516->TooltipValue = "";

			// f20170517
			$this->f20170517->LinkCustomAttributes = "";
			$this->f20170517->HrefValue = "";
			$this->f20170517->TooltipValue = "";

			// f20170518
			$this->f20170518->LinkCustomAttributes = "";
			$this->f20170518->HrefValue = "";
			$this->f20170518->TooltipValue = "";

			// f20170519
			$this->f20170519->LinkCustomAttributes = "";
			$this->f20170519->HrefValue = "";
			$this->f20170519->TooltipValue = "";

			// f20170520
			$this->f20170520->LinkCustomAttributes = "";
			$this->f20170520->HrefValue = "";
			$this->f20170520->TooltipValue = "";

			// f20170521
			$this->f20170521->LinkCustomAttributes = "";
			$this->f20170521->HrefValue = "";
			$this->f20170521->TooltipValue = "";

			// f20170522
			$this->f20170522->LinkCustomAttributes = "";
			$this->f20170522->HrefValue = "";
			$this->f20170522->TooltipValue = "";

			// f20170523
			$this->f20170523->LinkCustomAttributes = "";
			$this->f20170523->HrefValue = "";
			$this->f20170523->TooltipValue = "";

			// f20170524
			$this->f20170524->LinkCustomAttributes = "";
			$this->f20170524->HrefValue = "";
			$this->f20170524->TooltipValue = "";

			// f20170525
			$this->f20170525->LinkCustomAttributes = "";
			$this->f20170525->HrefValue = "";
			$this->f20170525->TooltipValue = "";

			// f20170526
			$this->f20170526->LinkCustomAttributes = "";
			$this->f20170526->HrefValue = "";
			$this->f20170526->TooltipValue = "";

			// f20170527
			$this->f20170527->LinkCustomAttributes = "";
			$this->f20170527->HrefValue = "";
			$this->f20170527->TooltipValue = "";

			// f20170528
			$this->f20170528->LinkCustomAttributes = "";
			$this->f20170528->HrefValue = "";
			$this->f20170528->TooltipValue = "";

			// f20170529
			$this->f20170529->LinkCustomAttributes = "";
			$this->f20170529->HrefValue = "";
			$this->f20170529->TooltipValue = "";

			// f20170530
			$this->f20170530->LinkCustomAttributes = "";
			$this->f20170530->HrefValue = "";
			$this->f20170530->TooltipValue = "";

			// f20170531
			$this->f20170531->LinkCustomAttributes = "";
			$this->f20170531->HrefValue = "";
			$this->f20170531->TooltipValue = "";

			// f20170601
			$this->f20170601->LinkCustomAttributes = "";
			$this->f20170601->HrefValue = "";
			$this->f20170601->TooltipValue = "";

			// f20170602
			$this->f20170602->LinkCustomAttributes = "";
			$this->f20170602->HrefValue = "";
			$this->f20170602->TooltipValue = "";

			// f20170603
			$this->f20170603->LinkCustomAttributes = "";
			$this->f20170603->HrefValue = "";
			$this->f20170603->TooltipValue = "";

			// f20170604
			$this->f20170604->LinkCustomAttributes = "";
			$this->f20170604->HrefValue = "";
			$this->f20170604->TooltipValue = "";

			// f20170605
			$this->f20170605->LinkCustomAttributes = "";
			$this->f20170605->HrefValue = "";
			$this->f20170605->TooltipValue = "";

			// f20170606
			$this->f20170606->LinkCustomAttributes = "";
			$this->f20170606->HrefValue = "";
			$this->f20170606->TooltipValue = "";

			// f20170607
			$this->f20170607->LinkCustomAttributes = "";
			$this->f20170607->HrefValue = "";
			$this->f20170607->TooltipValue = "";

			// f20170608
			$this->f20170608->LinkCustomAttributes = "";
			$this->f20170608->HrefValue = "";
			$this->f20170608->TooltipValue = "";

			// f20170609
			$this->f20170609->LinkCustomAttributes = "";
			$this->f20170609->HrefValue = "";
			$this->f20170609->TooltipValue = "";

			// f20170610
			$this->f20170610->LinkCustomAttributes = "";
			$this->f20170610->HrefValue = "";
			$this->f20170610->TooltipValue = "";

			// f20170611
			$this->f20170611->LinkCustomAttributes = "";
			$this->f20170611->HrefValue = "";
			$this->f20170611->TooltipValue = "";

			// f20170612
			$this->f20170612->LinkCustomAttributes = "";
			$this->f20170612->HrefValue = "";
			$this->f20170612->TooltipValue = "";

			// f20170613
			$this->f20170613->LinkCustomAttributes = "";
			$this->f20170613->HrefValue = "";
			$this->f20170613->TooltipValue = "";

			// f20170614
			$this->f20170614->LinkCustomAttributes = "";
			$this->f20170614->HrefValue = "";
			$this->f20170614->TooltipValue = "";

			// f20170615
			$this->f20170615->LinkCustomAttributes = "";
			$this->f20170615->HrefValue = "";
			$this->f20170615->TooltipValue = "";

			// f20170616
			$this->f20170616->LinkCustomAttributes = "";
			$this->f20170616->HrefValue = "";
			$this->f20170616->TooltipValue = "";

			// f20170617
			$this->f20170617->LinkCustomAttributes = "";
			$this->f20170617->HrefValue = "";
			$this->f20170617->TooltipValue = "";

			// f20170618
			$this->f20170618->LinkCustomAttributes = "";
			$this->f20170618->HrefValue = "";
			$this->f20170618->TooltipValue = "";

			// f20170619
			$this->f20170619->LinkCustomAttributes = "";
			$this->f20170619->HrefValue = "";
			$this->f20170619->TooltipValue = "";

			// f20170620
			$this->f20170620->LinkCustomAttributes = "";
			$this->f20170620->HrefValue = "";
			$this->f20170620->TooltipValue = "";

			// f20170621
			$this->f20170621->LinkCustomAttributes = "";
			$this->f20170621->HrefValue = "";
			$this->f20170621->TooltipValue = "";

			// f20170622
			$this->f20170622->LinkCustomAttributes = "";
			$this->f20170622->HrefValue = "";
			$this->f20170622->TooltipValue = "";

			// f20170623
			$this->f20170623->LinkCustomAttributes = "";
			$this->f20170623->HrefValue = "";
			$this->f20170623->TooltipValue = "";

			// f20170624
			$this->f20170624->LinkCustomAttributes = "";
			$this->f20170624->HrefValue = "";
			$this->f20170624->TooltipValue = "";

			// f20170625
			$this->f20170625->LinkCustomAttributes = "";
			$this->f20170625->HrefValue = "";
			$this->f20170625->TooltipValue = "";

			// f20170626
			$this->f20170626->LinkCustomAttributes = "";
			$this->f20170626->HrefValue = "";
			$this->f20170626->TooltipValue = "";

			// f20170627
			$this->f20170627->LinkCustomAttributes = "";
			$this->f20170627->HrefValue = "";
			$this->f20170627->TooltipValue = "";

			// f20170628
			$this->f20170628->LinkCustomAttributes = "";
			$this->f20170628->HrefValue = "";
			$this->f20170628->TooltipValue = "";

			// f20170629
			$this->f20170629->LinkCustomAttributes = "";
			$this->f20170629->HrefValue = "";
			$this->f20170629->TooltipValue = "";

			// f20170630
			$this->f20170630->LinkCustomAttributes = "";
			$this->f20170630->HrefValue = "";
			$this->f20170630->TooltipValue = "";

			// f20170701
			$this->f20170701->LinkCustomAttributes = "";
			$this->f20170701->HrefValue = "";
			$this->f20170701->TooltipValue = "";

			// f20170702
			$this->f20170702->LinkCustomAttributes = "";
			$this->f20170702->HrefValue = "";
			$this->f20170702->TooltipValue = "";

			// f20170703
			$this->f20170703->LinkCustomAttributes = "";
			$this->f20170703->HrefValue = "";
			$this->f20170703->TooltipValue = "";

			// f20170704
			$this->f20170704->LinkCustomAttributes = "";
			$this->f20170704->HrefValue = "";
			$this->f20170704->TooltipValue = "";

			// f20170705
			$this->f20170705->LinkCustomAttributes = "";
			$this->f20170705->HrefValue = "";
			$this->f20170705->TooltipValue = "";

			// f20170706
			$this->f20170706->LinkCustomAttributes = "";
			$this->f20170706->HrefValue = "";
			$this->f20170706->TooltipValue = "";

			// f20170707
			$this->f20170707->LinkCustomAttributes = "";
			$this->f20170707->HrefValue = "";
			$this->f20170707->TooltipValue = "";

			// f20170708
			$this->f20170708->LinkCustomAttributes = "";
			$this->f20170708->HrefValue = "";
			$this->f20170708->TooltipValue = "";

			// f20170709
			$this->f20170709->LinkCustomAttributes = "";
			$this->f20170709->HrefValue = "";
			$this->f20170709->TooltipValue = "";

			// f20170710
			$this->f20170710->LinkCustomAttributes = "";
			$this->f20170710->HrefValue = "";
			$this->f20170710->TooltipValue = "";

			// f20170711
			$this->f20170711->LinkCustomAttributes = "";
			$this->f20170711->HrefValue = "";
			$this->f20170711->TooltipValue = "";

			// f20170712
			$this->f20170712->LinkCustomAttributes = "";
			$this->f20170712->HrefValue = "";
			$this->f20170712->TooltipValue = "";

			// f20170713
			$this->f20170713->LinkCustomAttributes = "";
			$this->f20170713->HrefValue = "";
			$this->f20170713->TooltipValue = "";

			// f20170714
			$this->f20170714->LinkCustomAttributes = "";
			$this->f20170714->HrefValue = "";
			$this->f20170714->TooltipValue = "";

			// f20170715
			$this->f20170715->LinkCustomAttributes = "";
			$this->f20170715->HrefValue = "";
			$this->f20170715->TooltipValue = "";

			// f20170716
			$this->f20170716->LinkCustomAttributes = "";
			$this->f20170716->HrefValue = "";
			$this->f20170716->TooltipValue = "";

			// f20170717
			$this->f20170717->LinkCustomAttributes = "";
			$this->f20170717->HrefValue = "";
			$this->f20170717->TooltipValue = "";

			// f20170718
			$this->f20170718->LinkCustomAttributes = "";
			$this->f20170718->HrefValue = "";
			$this->f20170718->TooltipValue = "";

			// f20170719
			$this->f20170719->LinkCustomAttributes = "";
			$this->f20170719->HrefValue = "";
			$this->f20170719->TooltipValue = "";

			// f20170720
			$this->f20170720->LinkCustomAttributes = "";
			$this->f20170720->HrefValue = "";
			$this->f20170720->TooltipValue = "";

			// f20170721
			$this->f20170721->LinkCustomAttributes = "";
			$this->f20170721->HrefValue = "";
			$this->f20170721->TooltipValue = "";

			// f20170722
			$this->f20170722->LinkCustomAttributes = "";
			$this->f20170722->HrefValue = "";
			$this->f20170722->TooltipValue = "";

			// f20170723
			$this->f20170723->LinkCustomAttributes = "";
			$this->f20170723->HrefValue = "";
			$this->f20170723->TooltipValue = "";

			// f20170724
			$this->f20170724->LinkCustomAttributes = "";
			$this->f20170724->HrefValue = "";
			$this->f20170724->TooltipValue = "";

			// f20170725
			$this->f20170725->LinkCustomAttributes = "";
			$this->f20170725->HrefValue = "";
			$this->f20170725->TooltipValue = "";

			// f20170726
			$this->f20170726->LinkCustomAttributes = "";
			$this->f20170726->HrefValue = "";
			$this->f20170726->TooltipValue = "";

			// f20170727
			$this->f20170727->LinkCustomAttributes = "";
			$this->f20170727->HrefValue = "";
			$this->f20170727->TooltipValue = "";

			// f20170728
			$this->f20170728->LinkCustomAttributes = "";
			$this->f20170728->HrefValue = "";
			$this->f20170728->TooltipValue = "";

			// f20170729
			$this->f20170729->LinkCustomAttributes = "";
			$this->f20170729->HrefValue = "";
			$this->f20170729->TooltipValue = "";

			// f20170730
			$this->f20170730->LinkCustomAttributes = "";
			$this->f20170730->HrefValue = "";
			$this->f20170730->TooltipValue = "";

			// f20170731
			$this->f20170731->LinkCustomAttributes = "";
			$this->f20170731->HrefValue = "";
			$this->f20170731->TooltipValue = "";

			// f20170801
			$this->f20170801->LinkCustomAttributes = "";
			$this->f20170801->HrefValue = "";
			$this->f20170801->TooltipValue = "";

			// f20170802
			$this->f20170802->LinkCustomAttributes = "";
			$this->f20170802->HrefValue = "";
			$this->f20170802->TooltipValue = "";

			// f20170803
			$this->f20170803->LinkCustomAttributes = "";
			$this->f20170803->HrefValue = "";
			$this->f20170803->TooltipValue = "";

			// f20170804
			$this->f20170804->LinkCustomAttributes = "";
			$this->f20170804->HrefValue = "";
			$this->f20170804->TooltipValue = "";

			// f20170805
			$this->f20170805->LinkCustomAttributes = "";
			$this->f20170805->HrefValue = "";
			$this->f20170805->TooltipValue = "";

			// f20170806
			$this->f20170806->LinkCustomAttributes = "";
			$this->f20170806->HrefValue = "";
			$this->f20170806->TooltipValue = "";

			// f20170807
			$this->f20170807->LinkCustomAttributes = "";
			$this->f20170807->HrefValue = "";
			$this->f20170807->TooltipValue = "";

			// f20170808
			$this->f20170808->LinkCustomAttributes = "";
			$this->f20170808->HrefValue = "";
			$this->f20170808->TooltipValue = "";

			// f20170809
			$this->f20170809->LinkCustomAttributes = "";
			$this->f20170809->HrefValue = "";
			$this->f20170809->TooltipValue = "";

			// f20170810
			$this->f20170810->LinkCustomAttributes = "";
			$this->f20170810->HrefValue = "";
			$this->f20170810->TooltipValue = "";

			// f20170811
			$this->f20170811->LinkCustomAttributes = "";
			$this->f20170811->HrefValue = "";
			$this->f20170811->TooltipValue = "";

			// f20170812
			$this->f20170812->LinkCustomAttributes = "";
			$this->f20170812->HrefValue = "";
			$this->f20170812->TooltipValue = "";

			// f20170813
			$this->f20170813->LinkCustomAttributes = "";
			$this->f20170813->HrefValue = "";
			$this->f20170813->TooltipValue = "";

			// f20170814
			$this->f20170814->LinkCustomAttributes = "";
			$this->f20170814->HrefValue = "";
			$this->f20170814->TooltipValue = "";

			// f20170815
			$this->f20170815->LinkCustomAttributes = "";
			$this->f20170815->HrefValue = "";
			$this->f20170815->TooltipValue = "";

			// f20170816
			$this->f20170816->LinkCustomAttributes = "";
			$this->f20170816->HrefValue = "";
			$this->f20170816->TooltipValue = "";

			// f20170817
			$this->f20170817->LinkCustomAttributes = "";
			$this->f20170817->HrefValue = "";
			$this->f20170817->TooltipValue = "";

			// f20170818
			$this->f20170818->LinkCustomAttributes = "";
			$this->f20170818->HrefValue = "";
			$this->f20170818->TooltipValue = "";

			// f20170819
			$this->f20170819->LinkCustomAttributes = "";
			$this->f20170819->HrefValue = "";
			$this->f20170819->TooltipValue = "";

			// f20170820
			$this->f20170820->LinkCustomAttributes = "";
			$this->f20170820->HrefValue = "";
			$this->f20170820->TooltipValue = "";

			// f20170821
			$this->f20170821->LinkCustomAttributes = "";
			$this->f20170821->HrefValue = "";
			$this->f20170821->TooltipValue = "";

			// f20170822
			$this->f20170822->LinkCustomAttributes = "";
			$this->f20170822->HrefValue = "";
			$this->f20170822->TooltipValue = "";

			// f20170823
			$this->f20170823->LinkCustomAttributes = "";
			$this->f20170823->HrefValue = "";
			$this->f20170823->TooltipValue = "";

			// f20170824
			$this->f20170824->LinkCustomAttributes = "";
			$this->f20170824->HrefValue = "";
			$this->f20170824->TooltipValue = "";

			// f20170825
			$this->f20170825->LinkCustomAttributes = "";
			$this->f20170825->HrefValue = "";
			$this->f20170825->TooltipValue = "";

			// f20170826
			$this->f20170826->LinkCustomAttributes = "";
			$this->f20170826->HrefValue = "";
			$this->f20170826->TooltipValue = "";

			// f20170827
			$this->f20170827->LinkCustomAttributes = "";
			$this->f20170827->HrefValue = "";
			$this->f20170827->TooltipValue = "";

			// f20170828
			$this->f20170828->LinkCustomAttributes = "";
			$this->f20170828->HrefValue = "";
			$this->f20170828->TooltipValue = "";

			// f20170829
			$this->f20170829->LinkCustomAttributes = "";
			$this->f20170829->HrefValue = "";
			$this->f20170829->TooltipValue = "";

			// f20170830
			$this->f20170830->LinkCustomAttributes = "";
			$this->f20170830->HrefValue = "";
			$this->f20170830->TooltipValue = "";

			// f20170831
			$this->f20170831->LinkCustomAttributes = "";
			$this->f20170831->HrefValue = "";
			$this->f20170831->TooltipValue = "";

			// f20170901
			$this->f20170901->LinkCustomAttributes = "";
			$this->f20170901->HrefValue = "";
			$this->f20170901->TooltipValue = "";

			// f20170902
			$this->f20170902->LinkCustomAttributes = "";
			$this->f20170902->HrefValue = "";
			$this->f20170902->TooltipValue = "";

			// f20170903
			$this->f20170903->LinkCustomAttributes = "";
			$this->f20170903->HrefValue = "";
			$this->f20170903->TooltipValue = "";

			// f20170904
			$this->f20170904->LinkCustomAttributes = "";
			$this->f20170904->HrefValue = "";
			$this->f20170904->TooltipValue = "";

			// f20170905
			$this->f20170905->LinkCustomAttributes = "";
			$this->f20170905->HrefValue = "";
			$this->f20170905->TooltipValue = "";

			// f20170906
			$this->f20170906->LinkCustomAttributes = "";
			$this->f20170906->HrefValue = "";
			$this->f20170906->TooltipValue = "";

			// f20170907
			$this->f20170907->LinkCustomAttributes = "";
			$this->f20170907->HrefValue = "";
			$this->f20170907->TooltipValue = "";

			// f20170908
			$this->f20170908->LinkCustomAttributes = "";
			$this->f20170908->HrefValue = "";
			$this->f20170908->TooltipValue = "";

			// f20170909
			$this->f20170909->LinkCustomAttributes = "";
			$this->f20170909->HrefValue = "";
			$this->f20170909->TooltipValue = "";

			// f20170910
			$this->f20170910->LinkCustomAttributes = "";
			$this->f20170910->HrefValue = "";
			$this->f20170910->TooltipValue = "";

			// f20170911
			$this->f20170911->LinkCustomAttributes = "";
			$this->f20170911->HrefValue = "";
			$this->f20170911->TooltipValue = "";

			// f20170912
			$this->f20170912->LinkCustomAttributes = "";
			$this->f20170912->HrefValue = "";
			$this->f20170912->TooltipValue = "";

			// f20170913
			$this->f20170913->LinkCustomAttributes = "";
			$this->f20170913->HrefValue = "";
			$this->f20170913->TooltipValue = "";

			// f20170914
			$this->f20170914->LinkCustomAttributes = "";
			$this->f20170914->HrefValue = "";
			$this->f20170914->TooltipValue = "";

			// f20170915
			$this->f20170915->LinkCustomAttributes = "";
			$this->f20170915->HrefValue = "";
			$this->f20170915->TooltipValue = "";

			// f20170916
			$this->f20170916->LinkCustomAttributes = "";
			$this->f20170916->HrefValue = "";
			$this->f20170916->TooltipValue = "";

			// f20170917
			$this->f20170917->LinkCustomAttributes = "";
			$this->f20170917->HrefValue = "";
			$this->f20170917->TooltipValue = "";

			// f20170918
			$this->f20170918->LinkCustomAttributes = "";
			$this->f20170918->HrefValue = "";
			$this->f20170918->TooltipValue = "";

			// f20170919
			$this->f20170919->LinkCustomAttributes = "";
			$this->f20170919->HrefValue = "";
			$this->f20170919->TooltipValue = "";

			// f20170920
			$this->f20170920->LinkCustomAttributes = "";
			$this->f20170920->HrefValue = "";
			$this->f20170920->TooltipValue = "";

			// f20170921
			$this->f20170921->LinkCustomAttributes = "";
			$this->f20170921->HrefValue = "";
			$this->f20170921->TooltipValue = "";

			// f20170922
			$this->f20170922->LinkCustomAttributes = "";
			$this->f20170922->HrefValue = "";
			$this->f20170922->TooltipValue = "";

			// f20170923
			$this->f20170923->LinkCustomAttributes = "";
			$this->f20170923->HrefValue = "";
			$this->f20170923->TooltipValue = "";

			// f20170924
			$this->f20170924->LinkCustomAttributes = "";
			$this->f20170924->HrefValue = "";
			$this->f20170924->TooltipValue = "";

			// f20170925
			$this->f20170925->LinkCustomAttributes = "";
			$this->f20170925->HrefValue = "";
			$this->f20170925->TooltipValue = "";

			// f20170926
			$this->f20170926->LinkCustomAttributes = "";
			$this->f20170926->HrefValue = "";
			$this->f20170926->TooltipValue = "";

			// f20170927
			$this->f20170927->LinkCustomAttributes = "";
			$this->f20170927->HrefValue = "";
			$this->f20170927->TooltipValue = "";

			// f20170928
			$this->f20170928->LinkCustomAttributes = "";
			$this->f20170928->HrefValue = "";
			$this->f20170928->TooltipValue = "";

			// f20170929
			$this->f20170929->LinkCustomAttributes = "";
			$this->f20170929->HrefValue = "";
			$this->f20170929->TooltipValue = "";

			// f20170930
			$this->f20170930->LinkCustomAttributes = "";
			$this->f20170930->HrefValue = "";
			$this->f20170930->TooltipValue = "";

			// f20171001
			$this->f20171001->LinkCustomAttributes = "";
			$this->f20171001->HrefValue = "";
			$this->f20171001->TooltipValue = "";

			// f20171002
			$this->f20171002->LinkCustomAttributes = "";
			$this->f20171002->HrefValue = "";
			$this->f20171002->TooltipValue = "";

			// f20171003
			$this->f20171003->LinkCustomAttributes = "";
			$this->f20171003->HrefValue = "";
			$this->f20171003->TooltipValue = "";

			// f20171004
			$this->f20171004->LinkCustomAttributes = "";
			$this->f20171004->HrefValue = "";
			$this->f20171004->TooltipValue = "";

			// f20171005
			$this->f20171005->LinkCustomAttributes = "";
			$this->f20171005->HrefValue = "";
			$this->f20171005->TooltipValue = "";

			// f20171006
			$this->f20171006->LinkCustomAttributes = "";
			$this->f20171006->HrefValue = "";
			$this->f20171006->TooltipValue = "";

			// f20171007
			$this->f20171007->LinkCustomAttributes = "";
			$this->f20171007->HrefValue = "";
			$this->f20171007->TooltipValue = "";

			// f20171008
			$this->f20171008->LinkCustomAttributes = "";
			$this->f20171008->HrefValue = "";
			$this->f20171008->TooltipValue = "";

			// f20171009
			$this->f20171009->LinkCustomAttributes = "";
			$this->f20171009->HrefValue = "";
			$this->f20171009->TooltipValue = "";

			// f20171010
			$this->f20171010->LinkCustomAttributes = "";
			$this->f20171010->HrefValue = "";
			$this->f20171010->TooltipValue = "";

			// f20171011
			$this->f20171011->LinkCustomAttributes = "";
			$this->f20171011->HrefValue = "";
			$this->f20171011->TooltipValue = "";

			// f20171012
			$this->f20171012->LinkCustomAttributes = "";
			$this->f20171012->HrefValue = "";
			$this->f20171012->TooltipValue = "";

			// f20171013
			$this->f20171013->LinkCustomAttributes = "";
			$this->f20171013->HrefValue = "";
			$this->f20171013->TooltipValue = "";

			// f20171014
			$this->f20171014->LinkCustomAttributes = "";
			$this->f20171014->HrefValue = "";
			$this->f20171014->TooltipValue = "";

			// f20171015
			$this->f20171015->LinkCustomAttributes = "";
			$this->f20171015->HrefValue = "";
			$this->f20171015->TooltipValue = "";

			// f20171016
			$this->f20171016->LinkCustomAttributes = "";
			$this->f20171016->HrefValue = "";
			$this->f20171016->TooltipValue = "";

			// f20171017
			$this->f20171017->LinkCustomAttributes = "";
			$this->f20171017->HrefValue = "";
			$this->f20171017->TooltipValue = "";

			// f20171018
			$this->f20171018->LinkCustomAttributes = "";
			$this->f20171018->HrefValue = "";
			$this->f20171018->TooltipValue = "";

			// f20171019
			$this->f20171019->LinkCustomAttributes = "";
			$this->f20171019->HrefValue = "";
			$this->f20171019->TooltipValue = "";

			// f20171020
			$this->f20171020->LinkCustomAttributes = "";
			$this->f20171020->HrefValue = "";
			$this->f20171020->TooltipValue = "";

			// f20171021
			$this->f20171021->LinkCustomAttributes = "";
			$this->f20171021->HrefValue = "";
			$this->f20171021->TooltipValue = "";

			// f20171022
			$this->f20171022->LinkCustomAttributes = "";
			$this->f20171022->HrefValue = "";
			$this->f20171022->TooltipValue = "";

			// f20171023
			$this->f20171023->LinkCustomAttributes = "";
			$this->f20171023->HrefValue = "";
			$this->f20171023->TooltipValue = "";

			// f20171024
			$this->f20171024->LinkCustomAttributes = "";
			$this->f20171024->HrefValue = "";
			$this->f20171024->TooltipValue = "";

			// f20171025
			$this->f20171025->LinkCustomAttributes = "";
			$this->f20171025->HrefValue = "";
			$this->f20171025->TooltipValue = "";

			// f20171026
			$this->f20171026->LinkCustomAttributes = "";
			$this->f20171026->HrefValue = "";
			$this->f20171026->TooltipValue = "";

			// f20171027
			$this->f20171027->LinkCustomAttributes = "";
			$this->f20171027->HrefValue = "";
			$this->f20171027->TooltipValue = "";

			// f20171028
			$this->f20171028->LinkCustomAttributes = "";
			$this->f20171028->HrefValue = "";
			$this->f20171028->TooltipValue = "";

			// f20171029
			$this->f20171029->LinkCustomAttributes = "";
			$this->f20171029->HrefValue = "";
			$this->f20171029->TooltipValue = "";

			// f20171030
			$this->f20171030->LinkCustomAttributes = "";
			$this->f20171030->HrefValue = "";
			$this->f20171030->TooltipValue = "";

			// f20171031
			$this->f20171031->LinkCustomAttributes = "";
			$this->f20171031->HrefValue = "";
			$this->f20171031->TooltipValue = "";

			// f20171101
			$this->f20171101->LinkCustomAttributes = "";
			$this->f20171101->HrefValue = "";
			$this->f20171101->TooltipValue = "";

			// f20171102
			$this->f20171102->LinkCustomAttributes = "";
			$this->f20171102->HrefValue = "";
			$this->f20171102->TooltipValue = "";

			// f20171103
			$this->f20171103->LinkCustomAttributes = "";
			$this->f20171103->HrefValue = "";
			$this->f20171103->TooltipValue = "";

			// f20171104
			$this->f20171104->LinkCustomAttributes = "";
			$this->f20171104->HrefValue = "";
			$this->f20171104->TooltipValue = "";

			// f20171105
			$this->f20171105->LinkCustomAttributes = "";
			$this->f20171105->HrefValue = "";
			$this->f20171105->TooltipValue = "";

			// f20171106
			$this->f20171106->LinkCustomAttributes = "";
			$this->f20171106->HrefValue = "";
			$this->f20171106->TooltipValue = "";

			// f20171107
			$this->f20171107->LinkCustomAttributes = "";
			$this->f20171107->HrefValue = "";
			$this->f20171107->TooltipValue = "";

			// f20171108
			$this->f20171108->LinkCustomAttributes = "";
			$this->f20171108->HrefValue = "";
			$this->f20171108->TooltipValue = "";

			// f20171109
			$this->f20171109->LinkCustomAttributes = "";
			$this->f20171109->HrefValue = "";
			$this->f20171109->TooltipValue = "";

			// f20171110
			$this->f20171110->LinkCustomAttributes = "";
			$this->f20171110->HrefValue = "";
			$this->f20171110->TooltipValue = "";

			// f20171111
			$this->f20171111->LinkCustomAttributes = "";
			$this->f20171111->HrefValue = "";
			$this->f20171111->TooltipValue = "";

			// f20171112
			$this->f20171112->LinkCustomAttributes = "";
			$this->f20171112->HrefValue = "";
			$this->f20171112->TooltipValue = "";

			// f20171113
			$this->f20171113->LinkCustomAttributes = "";
			$this->f20171113->HrefValue = "";
			$this->f20171113->TooltipValue = "";

			// f20171114
			$this->f20171114->LinkCustomAttributes = "";
			$this->f20171114->HrefValue = "";
			$this->f20171114->TooltipValue = "";

			// f20171115
			$this->f20171115->LinkCustomAttributes = "";
			$this->f20171115->HrefValue = "";
			$this->f20171115->TooltipValue = "";

			// f20171116
			$this->f20171116->LinkCustomAttributes = "";
			$this->f20171116->HrefValue = "";
			$this->f20171116->TooltipValue = "";

			// f20171117
			$this->f20171117->LinkCustomAttributes = "";
			$this->f20171117->HrefValue = "";
			$this->f20171117->TooltipValue = "";

			// f20171118
			$this->f20171118->LinkCustomAttributes = "";
			$this->f20171118->HrefValue = "";
			$this->f20171118->TooltipValue = "";

			// f20171119
			$this->f20171119->LinkCustomAttributes = "";
			$this->f20171119->HrefValue = "";
			$this->f20171119->TooltipValue = "";

			// f20171120
			$this->f20171120->LinkCustomAttributes = "";
			$this->f20171120->HrefValue = "";
			$this->f20171120->TooltipValue = "";

			// f20171121
			$this->f20171121->LinkCustomAttributes = "";
			$this->f20171121->HrefValue = "";
			$this->f20171121->TooltipValue = "";

			// f20171122
			$this->f20171122->LinkCustomAttributes = "";
			$this->f20171122->HrefValue = "";
			$this->f20171122->TooltipValue = "";

			// f20171123
			$this->f20171123->LinkCustomAttributes = "";
			$this->f20171123->HrefValue = "";
			$this->f20171123->TooltipValue = "";

			// f20171124
			$this->f20171124->LinkCustomAttributes = "";
			$this->f20171124->HrefValue = "";
			$this->f20171124->TooltipValue = "";

			// f20171125
			$this->f20171125->LinkCustomAttributes = "";
			$this->f20171125->HrefValue = "";
			$this->f20171125->TooltipValue = "";

			// f20171126
			$this->f20171126->LinkCustomAttributes = "";
			$this->f20171126->HrefValue = "";
			$this->f20171126->TooltipValue = "";

			// f20171127
			$this->f20171127->LinkCustomAttributes = "";
			$this->f20171127->HrefValue = "";
			$this->f20171127->TooltipValue = "";

			// f20171128
			$this->f20171128->LinkCustomAttributes = "";
			$this->f20171128->HrefValue = "";
			$this->f20171128->TooltipValue = "";

			// f20171129
			$this->f20171129->LinkCustomAttributes = "";
			$this->f20171129->HrefValue = "";
			$this->f20171129->TooltipValue = "";

			// f20171130
			$this->f20171130->LinkCustomAttributes = "";
			$this->f20171130->HrefValue = "";
			$this->f20171130->TooltipValue = "";

			// f20171201
			$this->f20171201->LinkCustomAttributes = "";
			$this->f20171201->HrefValue = "";
			$this->f20171201->TooltipValue = "";

			// f20171202
			$this->f20171202->LinkCustomAttributes = "";
			$this->f20171202->HrefValue = "";
			$this->f20171202->TooltipValue = "";

			// f20171203
			$this->f20171203->LinkCustomAttributes = "";
			$this->f20171203->HrefValue = "";
			$this->f20171203->TooltipValue = "";

			// f20171204
			$this->f20171204->LinkCustomAttributes = "";
			$this->f20171204->HrefValue = "";
			$this->f20171204->TooltipValue = "";

			// f20171205
			$this->f20171205->LinkCustomAttributes = "";
			$this->f20171205->HrefValue = "";
			$this->f20171205->TooltipValue = "";

			// f20171206
			$this->f20171206->LinkCustomAttributes = "";
			$this->f20171206->HrefValue = "";
			$this->f20171206->TooltipValue = "";

			// f20171207
			$this->f20171207->LinkCustomAttributes = "";
			$this->f20171207->HrefValue = "";
			$this->f20171207->TooltipValue = "";

			// f20171208
			$this->f20171208->LinkCustomAttributes = "";
			$this->f20171208->HrefValue = "";
			$this->f20171208->TooltipValue = "";

			// f20171209
			$this->f20171209->LinkCustomAttributes = "";
			$this->f20171209->HrefValue = "";
			$this->f20171209->TooltipValue = "";

			// f20171210
			$this->f20171210->LinkCustomAttributes = "";
			$this->f20171210->HrefValue = "";
			$this->f20171210->TooltipValue = "";

			// f20171211
			$this->f20171211->LinkCustomAttributes = "";
			$this->f20171211->HrefValue = "";
			$this->f20171211->TooltipValue = "";

			// f20171212
			$this->f20171212->LinkCustomAttributes = "";
			$this->f20171212->HrefValue = "";
			$this->f20171212->TooltipValue = "";

			// f20171213
			$this->f20171213->LinkCustomAttributes = "";
			$this->f20171213->HrefValue = "";
			$this->f20171213->TooltipValue = "";

			// f20171214
			$this->f20171214->LinkCustomAttributes = "";
			$this->f20171214->HrefValue = "";
			$this->f20171214->TooltipValue = "";

			// f20171215
			$this->f20171215->LinkCustomAttributes = "";
			$this->f20171215->HrefValue = "";
			$this->f20171215->TooltipValue = "";

			// f20171216
			$this->f20171216->LinkCustomAttributes = "";
			$this->f20171216->HrefValue = "";
			$this->f20171216->TooltipValue = "";

			// f20171217
			$this->f20171217->LinkCustomAttributes = "";
			$this->f20171217->HrefValue = "";
			$this->f20171217->TooltipValue = "";

			// f20171218
			$this->f20171218->LinkCustomAttributes = "";
			$this->f20171218->HrefValue = "";
			$this->f20171218->TooltipValue = "";

			// f20171219
			$this->f20171219->LinkCustomAttributes = "";
			$this->f20171219->HrefValue = "";
			$this->f20171219->TooltipValue = "";

			// f20171220
			$this->f20171220->LinkCustomAttributes = "";
			$this->f20171220->HrefValue = "";
			$this->f20171220->TooltipValue = "";

			// f20171221
			$this->f20171221->LinkCustomAttributes = "";
			$this->f20171221->HrefValue = "";
			$this->f20171221->TooltipValue = "";

			// f20171222
			$this->f20171222->LinkCustomAttributes = "";
			$this->f20171222->HrefValue = "";
			$this->f20171222->TooltipValue = "";

			// f20171223
			$this->f20171223->LinkCustomAttributes = "";
			$this->f20171223->HrefValue = "";
			$this->f20171223->TooltipValue = "";

			// f20171224
			$this->f20171224->LinkCustomAttributes = "";
			$this->f20171224->HrefValue = "";
			$this->f20171224->TooltipValue = "";

			// f20171225
			$this->f20171225->LinkCustomAttributes = "";
			$this->f20171225->HrefValue = "";
			$this->f20171225->TooltipValue = "";

			// f20171226
			$this->f20171226->LinkCustomAttributes = "";
			$this->f20171226->HrefValue = "";
			$this->f20171226->TooltipValue = "";

			// f20171227
			$this->f20171227->LinkCustomAttributes = "";
			$this->f20171227->HrefValue = "";
			$this->f20171227->TooltipValue = "";

			// f20171228
			$this->f20171228->LinkCustomAttributes = "";
			$this->f20171228->HrefValue = "";
			$this->f20171228->TooltipValue = "";

			// f20171229
			$this->f20171229->LinkCustomAttributes = "";
			$this->f20171229->HrefValue = "";
			$this->f20171229->TooltipValue = "";

			// f20171230
			$this->f20171230->LinkCustomAttributes = "";
			$this->f20171230->HrefValue = "";
			$this->f20171230->TooltipValue = "";

			// f20171231
			$this->f20171231->LinkCustomAttributes = "";
			$this->f20171231->HrefValue = "";
			$this->f20171231->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// pegawai_id
			$this->pegawai_id->EditAttrs["class"] = "form-control";
			$this->pegawai_id->EditCustomAttributes = "";
			$this->pegawai_id->EditValue = ew_HtmlEncode($this->pegawai_id->CurrentValue);
			$this->pegawai_id->PlaceHolder = ew_RemoveHtml($this->pegawai_id->FldCaption());

			// f20170101
			$this->f20170101->EditAttrs["class"] = "form-control";
			$this->f20170101->EditCustomAttributes = "";
			$this->f20170101->EditValue = ew_HtmlEncode($this->f20170101->CurrentValue);
			$this->f20170101->PlaceHolder = ew_RemoveHtml($this->f20170101->FldCaption());

			// f20170102
			$this->f20170102->EditAttrs["class"] = "form-control";
			$this->f20170102->EditCustomAttributes = "";
			$this->f20170102->EditValue = ew_HtmlEncode($this->f20170102->CurrentValue);
			if (strval($this->f20170102->CurrentValue) <> "") {
				$sFilterWrk = "`jk_id`" . ew_SearchString("=", $this->f20170102->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `jk_id`, `jk_nm` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t_jk`";
			$sWhereWrk = "";
			$this->f20170102->LookupFilters = array("dx1" => '`jk_nm`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->f20170102, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
					$this->f20170102->EditValue = $this->f20170102->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->f20170102->EditValue = ew_HtmlEncode($this->f20170102->CurrentValue);
				}
			} else {
				$this->f20170102->EditValue = NULL;
			}
			$this->f20170102->PlaceHolder = ew_RemoveHtml($this->f20170102->FldCaption());

			// f20170103
			$this->f20170103->EditAttrs["class"] = "form-control";
			$this->f20170103->EditCustomAttributes = "";
			$this->f20170103->EditValue = ew_HtmlEncode($this->f20170103->CurrentValue);
			$this->f20170103->PlaceHolder = ew_RemoveHtml($this->f20170103->FldCaption());

			// f20170104
			$this->f20170104->EditAttrs["class"] = "form-control";
			$this->f20170104->EditCustomAttributes = "";
			$this->f20170104->EditValue = ew_HtmlEncode($this->f20170104->CurrentValue);
			$this->f20170104->PlaceHolder = ew_RemoveHtml($this->f20170104->FldCaption());

			// f20170105
			$this->f20170105->EditAttrs["class"] = "form-control";
			$this->f20170105->EditCustomAttributes = "";
			$this->f20170105->EditValue = ew_HtmlEncode($this->f20170105->CurrentValue);
			$this->f20170105->PlaceHolder = ew_RemoveHtml($this->f20170105->FldCaption());

			// f20170106
			$this->f20170106->EditAttrs["class"] = "form-control";
			$this->f20170106->EditCustomAttributes = "";
			$this->f20170106->EditValue = ew_HtmlEncode($this->f20170106->CurrentValue);
			$this->f20170106->PlaceHolder = ew_RemoveHtml($this->f20170106->FldCaption());

			// f20170107
			$this->f20170107->EditAttrs["class"] = "form-control";
			$this->f20170107->EditCustomAttributes = "";
			$this->f20170107->EditValue = ew_HtmlEncode($this->f20170107->CurrentValue);
			$this->f20170107->PlaceHolder = ew_RemoveHtml($this->f20170107->FldCaption());

			// f20170108
			$this->f20170108->EditAttrs["class"] = "form-control";
			$this->f20170108->EditCustomAttributes = "";
			$this->f20170108->EditValue = ew_HtmlEncode($this->f20170108->CurrentValue);
			$this->f20170108->PlaceHolder = ew_RemoveHtml($this->f20170108->FldCaption());

			// f20170109
			$this->f20170109->EditAttrs["class"] = "form-control";
			$this->f20170109->EditCustomAttributes = "";
			$this->f20170109->EditValue = ew_HtmlEncode($this->f20170109->CurrentValue);
			$this->f20170109->PlaceHolder = ew_RemoveHtml($this->f20170109->FldCaption());

			// f20170110
			$this->f20170110->EditAttrs["class"] = "form-control";
			$this->f20170110->EditCustomAttributes = "";
			$this->f20170110->EditValue = ew_HtmlEncode($this->f20170110->CurrentValue);
			$this->f20170110->PlaceHolder = ew_RemoveHtml($this->f20170110->FldCaption());

			// f20170111
			$this->f20170111->EditAttrs["class"] = "form-control";
			$this->f20170111->EditCustomAttributes = "";
			$this->f20170111->EditValue = ew_HtmlEncode($this->f20170111->CurrentValue);
			$this->f20170111->PlaceHolder = ew_RemoveHtml($this->f20170111->FldCaption());

			// f20170112
			$this->f20170112->EditAttrs["class"] = "form-control";
			$this->f20170112->EditCustomAttributes = "";
			$this->f20170112->EditValue = ew_HtmlEncode($this->f20170112->CurrentValue);
			$this->f20170112->PlaceHolder = ew_RemoveHtml($this->f20170112->FldCaption());

			// f20170113
			$this->f20170113->EditAttrs["class"] = "form-control";
			$this->f20170113->EditCustomAttributes = "";
			$this->f20170113->EditValue = ew_HtmlEncode($this->f20170113->CurrentValue);
			$this->f20170113->PlaceHolder = ew_RemoveHtml($this->f20170113->FldCaption());

			// f20170114
			$this->f20170114->EditAttrs["class"] = "form-control";
			$this->f20170114->EditCustomAttributes = "";
			$this->f20170114->EditValue = ew_HtmlEncode($this->f20170114->CurrentValue);
			$this->f20170114->PlaceHolder = ew_RemoveHtml($this->f20170114->FldCaption());

			// f20170115
			$this->f20170115->EditAttrs["class"] = "form-control";
			$this->f20170115->EditCustomAttributes = "";
			$this->f20170115->EditValue = ew_HtmlEncode($this->f20170115->CurrentValue);
			$this->f20170115->PlaceHolder = ew_RemoveHtml($this->f20170115->FldCaption());

			// f20170116
			$this->f20170116->EditAttrs["class"] = "form-control";
			$this->f20170116->EditCustomAttributes = "";
			$this->f20170116->EditValue = ew_HtmlEncode($this->f20170116->CurrentValue);
			$this->f20170116->PlaceHolder = ew_RemoveHtml($this->f20170116->FldCaption());

			// f20170117
			$this->f20170117->EditAttrs["class"] = "form-control";
			$this->f20170117->EditCustomAttributes = "";
			$this->f20170117->EditValue = ew_HtmlEncode($this->f20170117->CurrentValue);
			$this->f20170117->PlaceHolder = ew_RemoveHtml($this->f20170117->FldCaption());

			// f20170118
			$this->f20170118->EditAttrs["class"] = "form-control";
			$this->f20170118->EditCustomAttributes = "";
			$this->f20170118->EditValue = ew_HtmlEncode($this->f20170118->CurrentValue);
			$this->f20170118->PlaceHolder = ew_RemoveHtml($this->f20170118->FldCaption());

			// f20170119
			$this->f20170119->EditAttrs["class"] = "form-control";
			$this->f20170119->EditCustomAttributes = "";
			$this->f20170119->EditValue = ew_HtmlEncode($this->f20170119->CurrentValue);
			$this->f20170119->PlaceHolder = ew_RemoveHtml($this->f20170119->FldCaption());

			// f20170120
			$this->f20170120->EditAttrs["class"] = "form-control";
			$this->f20170120->EditCustomAttributes = "";
			$this->f20170120->EditValue = ew_HtmlEncode($this->f20170120->CurrentValue);
			$this->f20170120->PlaceHolder = ew_RemoveHtml($this->f20170120->FldCaption());

			// f20170121
			$this->f20170121->EditAttrs["class"] = "form-control";
			$this->f20170121->EditCustomAttributes = "";
			$this->f20170121->EditValue = ew_HtmlEncode($this->f20170121->CurrentValue);
			$this->f20170121->PlaceHolder = ew_RemoveHtml($this->f20170121->FldCaption());

			// f20170122
			$this->f20170122->EditAttrs["class"] = "form-control";
			$this->f20170122->EditCustomAttributes = "";
			$this->f20170122->EditValue = ew_HtmlEncode($this->f20170122->CurrentValue);
			$this->f20170122->PlaceHolder = ew_RemoveHtml($this->f20170122->FldCaption());

			// f20170123
			$this->f20170123->EditAttrs["class"] = "form-control";
			$this->f20170123->EditCustomAttributes = "";
			$this->f20170123->EditValue = ew_HtmlEncode($this->f20170123->CurrentValue);
			$this->f20170123->PlaceHolder = ew_RemoveHtml($this->f20170123->FldCaption());

			// f20170124
			$this->f20170124->EditAttrs["class"] = "form-control";
			$this->f20170124->EditCustomAttributes = "";
			$this->f20170124->EditValue = ew_HtmlEncode($this->f20170124->CurrentValue);
			$this->f20170124->PlaceHolder = ew_RemoveHtml($this->f20170124->FldCaption());

			// f20170125
			$this->f20170125->EditAttrs["class"] = "form-control";
			$this->f20170125->EditCustomAttributes = "";
			$this->f20170125->EditValue = ew_HtmlEncode($this->f20170125->CurrentValue);
			$this->f20170125->PlaceHolder = ew_RemoveHtml($this->f20170125->FldCaption());

			// f20170126
			$this->f20170126->EditAttrs["class"] = "form-control";
			$this->f20170126->EditCustomAttributes = "";
			$this->f20170126->EditValue = ew_HtmlEncode($this->f20170126->CurrentValue);
			$this->f20170126->PlaceHolder = ew_RemoveHtml($this->f20170126->FldCaption());

			// f20170127
			$this->f20170127->EditAttrs["class"] = "form-control";
			$this->f20170127->EditCustomAttributes = "";
			$this->f20170127->EditValue = ew_HtmlEncode($this->f20170127->CurrentValue);
			$this->f20170127->PlaceHolder = ew_RemoveHtml($this->f20170127->FldCaption());

			// f20170128
			$this->f20170128->EditAttrs["class"] = "form-control";
			$this->f20170128->EditCustomAttributes = "";
			$this->f20170128->EditValue = ew_HtmlEncode($this->f20170128->CurrentValue);
			$this->f20170128->PlaceHolder = ew_RemoveHtml($this->f20170128->FldCaption());

			// f20170129
			$this->f20170129->EditAttrs["class"] = "form-control";
			$this->f20170129->EditCustomAttributes = "";
			$this->f20170129->EditValue = ew_HtmlEncode($this->f20170129->CurrentValue);
			$this->f20170129->PlaceHolder = ew_RemoveHtml($this->f20170129->FldCaption());

			// f20170130
			$this->f20170130->EditAttrs["class"] = "form-control";
			$this->f20170130->EditCustomAttributes = "";
			$this->f20170130->EditValue = ew_HtmlEncode($this->f20170130->CurrentValue);
			$this->f20170130->PlaceHolder = ew_RemoveHtml($this->f20170130->FldCaption());

			// f20170131
			$this->f20170131->EditAttrs["class"] = "form-control";
			$this->f20170131->EditCustomAttributes = "";
			$this->f20170131->EditValue = ew_HtmlEncode($this->f20170131->CurrentValue);
			$this->f20170131->PlaceHolder = ew_RemoveHtml($this->f20170131->FldCaption());

			// f20170201
			$this->f20170201->EditAttrs["class"] = "form-control";
			$this->f20170201->EditCustomAttributes = "";
			$this->f20170201->EditValue = ew_HtmlEncode($this->f20170201->CurrentValue);
			$this->f20170201->PlaceHolder = ew_RemoveHtml($this->f20170201->FldCaption());

			// f20170202
			$this->f20170202->EditAttrs["class"] = "form-control";
			$this->f20170202->EditCustomAttributes = "";
			$this->f20170202->EditValue = ew_HtmlEncode($this->f20170202->CurrentValue);
			$this->f20170202->PlaceHolder = ew_RemoveHtml($this->f20170202->FldCaption());

			// f20170203
			$this->f20170203->EditAttrs["class"] = "form-control";
			$this->f20170203->EditCustomAttributes = "";
			$this->f20170203->EditValue = ew_HtmlEncode($this->f20170203->CurrentValue);
			$this->f20170203->PlaceHolder = ew_RemoveHtml($this->f20170203->FldCaption());

			// f20170204
			$this->f20170204->EditAttrs["class"] = "form-control";
			$this->f20170204->EditCustomAttributes = "";
			$this->f20170204->EditValue = ew_HtmlEncode($this->f20170204->CurrentValue);
			$this->f20170204->PlaceHolder = ew_RemoveHtml($this->f20170204->FldCaption());

			// f20170205
			$this->f20170205->EditAttrs["class"] = "form-control";
			$this->f20170205->EditCustomAttributes = "";
			$this->f20170205->EditValue = ew_HtmlEncode($this->f20170205->CurrentValue);
			$this->f20170205->PlaceHolder = ew_RemoveHtml($this->f20170205->FldCaption());

			// f20170206
			$this->f20170206->EditAttrs["class"] = "form-control";
			$this->f20170206->EditCustomAttributes = "";
			$this->f20170206->EditValue = ew_HtmlEncode($this->f20170206->CurrentValue);
			$this->f20170206->PlaceHolder = ew_RemoveHtml($this->f20170206->FldCaption());

			// f20170207
			$this->f20170207->EditAttrs["class"] = "form-control";
			$this->f20170207->EditCustomAttributes = "";
			$this->f20170207->EditValue = ew_HtmlEncode($this->f20170207->CurrentValue);
			$this->f20170207->PlaceHolder = ew_RemoveHtml($this->f20170207->FldCaption());

			// f20170208
			$this->f20170208->EditAttrs["class"] = "form-control";
			$this->f20170208->EditCustomAttributes = "";
			$this->f20170208->EditValue = ew_HtmlEncode($this->f20170208->CurrentValue);
			$this->f20170208->PlaceHolder = ew_RemoveHtml($this->f20170208->FldCaption());

			// f20170209
			$this->f20170209->EditAttrs["class"] = "form-control";
			$this->f20170209->EditCustomAttributes = "";
			$this->f20170209->EditValue = ew_HtmlEncode($this->f20170209->CurrentValue);
			$this->f20170209->PlaceHolder = ew_RemoveHtml($this->f20170209->FldCaption());

			// f20170210
			$this->f20170210->EditAttrs["class"] = "form-control";
			$this->f20170210->EditCustomAttributes = "";
			$this->f20170210->EditValue = ew_HtmlEncode($this->f20170210->CurrentValue);
			$this->f20170210->PlaceHolder = ew_RemoveHtml($this->f20170210->FldCaption());

			// f20170211
			$this->f20170211->EditAttrs["class"] = "form-control";
			$this->f20170211->EditCustomAttributes = "";
			$this->f20170211->EditValue = ew_HtmlEncode($this->f20170211->CurrentValue);
			$this->f20170211->PlaceHolder = ew_RemoveHtml($this->f20170211->FldCaption());

			// f20170212
			$this->f20170212->EditAttrs["class"] = "form-control";
			$this->f20170212->EditCustomAttributes = "";
			$this->f20170212->EditValue = ew_HtmlEncode($this->f20170212->CurrentValue);
			$this->f20170212->PlaceHolder = ew_RemoveHtml($this->f20170212->FldCaption());

			// f20170213
			$this->f20170213->EditAttrs["class"] = "form-control";
			$this->f20170213->EditCustomAttributes = "";
			$this->f20170213->EditValue = ew_HtmlEncode($this->f20170213->CurrentValue);
			$this->f20170213->PlaceHolder = ew_RemoveHtml($this->f20170213->FldCaption());

			// f20170214
			$this->f20170214->EditAttrs["class"] = "form-control";
			$this->f20170214->EditCustomAttributes = "";
			$this->f20170214->EditValue = ew_HtmlEncode($this->f20170214->CurrentValue);
			$this->f20170214->PlaceHolder = ew_RemoveHtml($this->f20170214->FldCaption());

			// f20170215
			$this->f20170215->EditAttrs["class"] = "form-control";
			$this->f20170215->EditCustomAttributes = "";
			$this->f20170215->EditValue = ew_HtmlEncode($this->f20170215->CurrentValue);
			$this->f20170215->PlaceHolder = ew_RemoveHtml($this->f20170215->FldCaption());

			// f20170216
			$this->f20170216->EditAttrs["class"] = "form-control";
			$this->f20170216->EditCustomAttributes = "";
			$this->f20170216->EditValue = ew_HtmlEncode($this->f20170216->CurrentValue);
			$this->f20170216->PlaceHolder = ew_RemoveHtml($this->f20170216->FldCaption());

			// f20170217
			$this->f20170217->EditAttrs["class"] = "form-control";
			$this->f20170217->EditCustomAttributes = "";
			$this->f20170217->EditValue = ew_HtmlEncode($this->f20170217->CurrentValue);
			$this->f20170217->PlaceHolder = ew_RemoveHtml($this->f20170217->FldCaption());

			// f20170218
			$this->f20170218->EditAttrs["class"] = "form-control";
			$this->f20170218->EditCustomAttributes = "";
			$this->f20170218->EditValue = ew_HtmlEncode($this->f20170218->CurrentValue);
			$this->f20170218->PlaceHolder = ew_RemoveHtml($this->f20170218->FldCaption());

			// f20170219
			$this->f20170219->EditAttrs["class"] = "form-control";
			$this->f20170219->EditCustomAttributes = "";
			$this->f20170219->EditValue = ew_HtmlEncode($this->f20170219->CurrentValue);
			$this->f20170219->PlaceHolder = ew_RemoveHtml($this->f20170219->FldCaption());

			// f20170220
			$this->f20170220->EditAttrs["class"] = "form-control";
			$this->f20170220->EditCustomAttributes = "";
			$this->f20170220->EditValue = ew_HtmlEncode($this->f20170220->CurrentValue);
			$this->f20170220->PlaceHolder = ew_RemoveHtml($this->f20170220->FldCaption());

			// f20170221
			$this->f20170221->EditAttrs["class"] = "form-control";
			$this->f20170221->EditCustomAttributes = "";
			$this->f20170221->EditValue = ew_HtmlEncode($this->f20170221->CurrentValue);
			$this->f20170221->PlaceHolder = ew_RemoveHtml($this->f20170221->FldCaption());

			// f20170222
			$this->f20170222->EditAttrs["class"] = "form-control";
			$this->f20170222->EditCustomAttributes = "";
			$this->f20170222->EditValue = ew_HtmlEncode($this->f20170222->CurrentValue);
			$this->f20170222->PlaceHolder = ew_RemoveHtml($this->f20170222->FldCaption());

			// f20170223
			$this->f20170223->EditAttrs["class"] = "form-control";
			$this->f20170223->EditCustomAttributes = "";
			$this->f20170223->EditValue = ew_HtmlEncode($this->f20170223->CurrentValue);
			$this->f20170223->PlaceHolder = ew_RemoveHtml($this->f20170223->FldCaption());

			// f20170224
			$this->f20170224->EditAttrs["class"] = "form-control";
			$this->f20170224->EditCustomAttributes = "";
			$this->f20170224->EditValue = ew_HtmlEncode($this->f20170224->CurrentValue);
			$this->f20170224->PlaceHolder = ew_RemoveHtml($this->f20170224->FldCaption());

			// f20170225
			$this->f20170225->EditAttrs["class"] = "form-control";
			$this->f20170225->EditCustomAttributes = "";
			$this->f20170225->EditValue = ew_HtmlEncode($this->f20170225->CurrentValue);
			$this->f20170225->PlaceHolder = ew_RemoveHtml($this->f20170225->FldCaption());

			// f20170226
			$this->f20170226->EditAttrs["class"] = "form-control";
			$this->f20170226->EditCustomAttributes = "";
			$this->f20170226->EditValue = ew_HtmlEncode($this->f20170226->CurrentValue);
			$this->f20170226->PlaceHolder = ew_RemoveHtml($this->f20170226->FldCaption());

			// f20170227
			$this->f20170227->EditAttrs["class"] = "form-control";
			$this->f20170227->EditCustomAttributes = "";
			$this->f20170227->EditValue = ew_HtmlEncode($this->f20170227->CurrentValue);
			$this->f20170227->PlaceHolder = ew_RemoveHtml($this->f20170227->FldCaption());

			// f20170228
			$this->f20170228->EditAttrs["class"] = "form-control";
			$this->f20170228->EditCustomAttributes = "";
			$this->f20170228->EditValue = ew_HtmlEncode($this->f20170228->CurrentValue);
			$this->f20170228->PlaceHolder = ew_RemoveHtml($this->f20170228->FldCaption());

			// f20170229
			$this->f20170229->EditAttrs["class"] = "form-control";
			$this->f20170229->EditCustomAttributes = "";
			$this->f20170229->EditValue = ew_HtmlEncode($this->f20170229->CurrentValue);
			$this->f20170229->PlaceHolder = ew_RemoveHtml($this->f20170229->FldCaption());

			// f20170301
			$this->f20170301->EditAttrs["class"] = "form-control";
			$this->f20170301->EditCustomAttributes = "";
			$this->f20170301->EditValue = ew_HtmlEncode($this->f20170301->CurrentValue);
			$this->f20170301->PlaceHolder = ew_RemoveHtml($this->f20170301->FldCaption());

			// f20170302
			$this->f20170302->EditAttrs["class"] = "form-control";
			$this->f20170302->EditCustomAttributes = "";
			$this->f20170302->EditValue = ew_HtmlEncode($this->f20170302->CurrentValue);
			$this->f20170302->PlaceHolder = ew_RemoveHtml($this->f20170302->FldCaption());

			// f20170303
			$this->f20170303->EditAttrs["class"] = "form-control";
			$this->f20170303->EditCustomAttributes = "";
			$this->f20170303->EditValue = ew_HtmlEncode($this->f20170303->CurrentValue);
			$this->f20170303->PlaceHolder = ew_RemoveHtml($this->f20170303->FldCaption());

			// f20170304
			$this->f20170304->EditAttrs["class"] = "form-control";
			$this->f20170304->EditCustomAttributes = "";
			$this->f20170304->EditValue = ew_HtmlEncode($this->f20170304->CurrentValue);
			$this->f20170304->PlaceHolder = ew_RemoveHtml($this->f20170304->FldCaption());

			// f20170305
			$this->f20170305->EditAttrs["class"] = "form-control";
			$this->f20170305->EditCustomAttributes = "";
			$this->f20170305->EditValue = ew_HtmlEncode($this->f20170305->CurrentValue);
			$this->f20170305->PlaceHolder = ew_RemoveHtml($this->f20170305->FldCaption());

			// f20170306
			$this->f20170306->EditAttrs["class"] = "form-control";
			$this->f20170306->EditCustomAttributes = "";
			$this->f20170306->EditValue = ew_HtmlEncode($this->f20170306->CurrentValue);
			$this->f20170306->PlaceHolder = ew_RemoveHtml($this->f20170306->FldCaption());

			// f20170307
			$this->f20170307->EditAttrs["class"] = "form-control";
			$this->f20170307->EditCustomAttributes = "";
			$this->f20170307->EditValue = ew_HtmlEncode($this->f20170307->CurrentValue);
			$this->f20170307->PlaceHolder = ew_RemoveHtml($this->f20170307->FldCaption());

			// f20170308
			$this->f20170308->EditAttrs["class"] = "form-control";
			$this->f20170308->EditCustomAttributes = "";
			$this->f20170308->EditValue = ew_HtmlEncode($this->f20170308->CurrentValue);
			$this->f20170308->PlaceHolder = ew_RemoveHtml($this->f20170308->FldCaption());

			// f20170309
			$this->f20170309->EditAttrs["class"] = "form-control";
			$this->f20170309->EditCustomAttributes = "";
			$this->f20170309->EditValue = ew_HtmlEncode($this->f20170309->CurrentValue);
			$this->f20170309->PlaceHolder = ew_RemoveHtml($this->f20170309->FldCaption());

			// f20170310
			$this->f20170310->EditAttrs["class"] = "form-control";
			$this->f20170310->EditCustomAttributes = "";
			$this->f20170310->EditValue = ew_HtmlEncode($this->f20170310->CurrentValue);
			$this->f20170310->PlaceHolder = ew_RemoveHtml($this->f20170310->FldCaption());

			// f20170311
			$this->f20170311->EditAttrs["class"] = "form-control";
			$this->f20170311->EditCustomAttributes = "";
			$this->f20170311->EditValue = ew_HtmlEncode($this->f20170311->CurrentValue);
			$this->f20170311->PlaceHolder = ew_RemoveHtml($this->f20170311->FldCaption());

			// f20170312
			$this->f20170312->EditAttrs["class"] = "form-control";
			$this->f20170312->EditCustomAttributes = "";
			$this->f20170312->EditValue = ew_HtmlEncode($this->f20170312->CurrentValue);
			$this->f20170312->PlaceHolder = ew_RemoveHtml($this->f20170312->FldCaption());

			// f20170313
			$this->f20170313->EditAttrs["class"] = "form-control";
			$this->f20170313->EditCustomAttributes = "";
			$this->f20170313->EditValue = ew_HtmlEncode($this->f20170313->CurrentValue);
			$this->f20170313->PlaceHolder = ew_RemoveHtml($this->f20170313->FldCaption());

			// f20170314
			$this->f20170314->EditAttrs["class"] = "form-control";
			$this->f20170314->EditCustomAttributes = "";
			$this->f20170314->EditValue = ew_HtmlEncode($this->f20170314->CurrentValue);
			$this->f20170314->PlaceHolder = ew_RemoveHtml($this->f20170314->FldCaption());

			// f20170315
			$this->f20170315->EditAttrs["class"] = "form-control";
			$this->f20170315->EditCustomAttributes = "";
			$this->f20170315->EditValue = ew_HtmlEncode($this->f20170315->CurrentValue);
			$this->f20170315->PlaceHolder = ew_RemoveHtml($this->f20170315->FldCaption());

			// f20170316
			$this->f20170316->EditAttrs["class"] = "form-control";
			$this->f20170316->EditCustomAttributes = "";
			$this->f20170316->EditValue = ew_HtmlEncode($this->f20170316->CurrentValue);
			$this->f20170316->PlaceHolder = ew_RemoveHtml($this->f20170316->FldCaption());

			// f20170317
			$this->f20170317->EditAttrs["class"] = "form-control";
			$this->f20170317->EditCustomAttributes = "";
			$this->f20170317->EditValue = ew_HtmlEncode($this->f20170317->CurrentValue);
			$this->f20170317->PlaceHolder = ew_RemoveHtml($this->f20170317->FldCaption());

			// f20170318
			$this->f20170318->EditAttrs["class"] = "form-control";
			$this->f20170318->EditCustomAttributes = "";
			$this->f20170318->EditValue = ew_HtmlEncode($this->f20170318->CurrentValue);
			$this->f20170318->PlaceHolder = ew_RemoveHtml($this->f20170318->FldCaption());

			// f20170319
			$this->f20170319->EditAttrs["class"] = "form-control";
			$this->f20170319->EditCustomAttributes = "";
			$this->f20170319->EditValue = ew_HtmlEncode($this->f20170319->CurrentValue);
			$this->f20170319->PlaceHolder = ew_RemoveHtml($this->f20170319->FldCaption());

			// f20170320
			$this->f20170320->EditAttrs["class"] = "form-control";
			$this->f20170320->EditCustomAttributes = "";
			$this->f20170320->EditValue = ew_HtmlEncode($this->f20170320->CurrentValue);
			$this->f20170320->PlaceHolder = ew_RemoveHtml($this->f20170320->FldCaption());

			// f20170321
			$this->f20170321->EditAttrs["class"] = "form-control";
			$this->f20170321->EditCustomAttributes = "";
			$this->f20170321->EditValue = ew_HtmlEncode($this->f20170321->CurrentValue);
			$this->f20170321->PlaceHolder = ew_RemoveHtml($this->f20170321->FldCaption());

			// f20170322
			$this->f20170322->EditAttrs["class"] = "form-control";
			$this->f20170322->EditCustomAttributes = "";
			$this->f20170322->EditValue = ew_HtmlEncode($this->f20170322->CurrentValue);
			$this->f20170322->PlaceHolder = ew_RemoveHtml($this->f20170322->FldCaption());

			// f20170323
			$this->f20170323->EditAttrs["class"] = "form-control";
			$this->f20170323->EditCustomAttributes = "";
			$this->f20170323->EditValue = ew_HtmlEncode($this->f20170323->CurrentValue);
			$this->f20170323->PlaceHolder = ew_RemoveHtml($this->f20170323->FldCaption());

			// f20170324
			$this->f20170324->EditAttrs["class"] = "form-control";
			$this->f20170324->EditCustomAttributes = "";
			$this->f20170324->EditValue = ew_HtmlEncode($this->f20170324->CurrentValue);
			$this->f20170324->PlaceHolder = ew_RemoveHtml($this->f20170324->FldCaption());

			// f20170325
			$this->f20170325->EditAttrs["class"] = "form-control";
			$this->f20170325->EditCustomAttributes = "";
			$this->f20170325->EditValue = ew_HtmlEncode($this->f20170325->CurrentValue);
			$this->f20170325->PlaceHolder = ew_RemoveHtml($this->f20170325->FldCaption());

			// f20170326
			$this->f20170326->EditAttrs["class"] = "form-control";
			$this->f20170326->EditCustomAttributes = "";
			$this->f20170326->EditValue = ew_HtmlEncode($this->f20170326->CurrentValue);
			$this->f20170326->PlaceHolder = ew_RemoveHtml($this->f20170326->FldCaption());

			// f20170327
			$this->f20170327->EditAttrs["class"] = "form-control";
			$this->f20170327->EditCustomAttributes = "";
			$this->f20170327->EditValue = ew_HtmlEncode($this->f20170327->CurrentValue);
			$this->f20170327->PlaceHolder = ew_RemoveHtml($this->f20170327->FldCaption());

			// f20170328
			$this->f20170328->EditAttrs["class"] = "form-control";
			$this->f20170328->EditCustomAttributes = "";
			$this->f20170328->EditValue = ew_HtmlEncode($this->f20170328->CurrentValue);
			$this->f20170328->PlaceHolder = ew_RemoveHtml($this->f20170328->FldCaption());

			// f20170329
			$this->f20170329->EditAttrs["class"] = "form-control";
			$this->f20170329->EditCustomAttributes = "";
			$this->f20170329->EditValue = ew_HtmlEncode($this->f20170329->CurrentValue);
			$this->f20170329->PlaceHolder = ew_RemoveHtml($this->f20170329->FldCaption());

			// f20170330
			$this->f20170330->EditAttrs["class"] = "form-control";
			$this->f20170330->EditCustomAttributes = "";
			$this->f20170330->EditValue = ew_HtmlEncode($this->f20170330->CurrentValue);
			$this->f20170330->PlaceHolder = ew_RemoveHtml($this->f20170330->FldCaption());

			// f20170331
			$this->f20170331->EditAttrs["class"] = "form-control";
			$this->f20170331->EditCustomAttributes = "";
			$this->f20170331->EditValue = ew_HtmlEncode($this->f20170331->CurrentValue);
			$this->f20170331->PlaceHolder = ew_RemoveHtml($this->f20170331->FldCaption());

			// f20170401
			$this->f20170401->EditAttrs["class"] = "form-control";
			$this->f20170401->EditCustomAttributes = "";
			$this->f20170401->EditValue = ew_HtmlEncode($this->f20170401->CurrentValue);
			$this->f20170401->PlaceHolder = ew_RemoveHtml($this->f20170401->FldCaption());

			// f20170402
			$this->f20170402->EditAttrs["class"] = "form-control";
			$this->f20170402->EditCustomAttributes = "";
			$this->f20170402->EditValue = ew_HtmlEncode($this->f20170402->CurrentValue);
			$this->f20170402->PlaceHolder = ew_RemoveHtml($this->f20170402->FldCaption());

			// f20170403
			$this->f20170403->EditAttrs["class"] = "form-control";
			$this->f20170403->EditCustomAttributes = "";
			$this->f20170403->EditValue = ew_HtmlEncode($this->f20170403->CurrentValue);
			$this->f20170403->PlaceHolder = ew_RemoveHtml($this->f20170403->FldCaption());

			// f20170404
			$this->f20170404->EditAttrs["class"] = "form-control";
			$this->f20170404->EditCustomAttributes = "";
			$this->f20170404->EditValue = ew_HtmlEncode($this->f20170404->CurrentValue);
			$this->f20170404->PlaceHolder = ew_RemoveHtml($this->f20170404->FldCaption());

			// f20170405
			$this->f20170405->EditAttrs["class"] = "form-control";
			$this->f20170405->EditCustomAttributes = "";
			$this->f20170405->EditValue = ew_HtmlEncode($this->f20170405->CurrentValue);
			$this->f20170405->PlaceHolder = ew_RemoveHtml($this->f20170405->FldCaption());

			// f20170406
			$this->f20170406->EditAttrs["class"] = "form-control";
			$this->f20170406->EditCustomAttributes = "";
			$this->f20170406->EditValue = ew_HtmlEncode($this->f20170406->CurrentValue);
			$this->f20170406->PlaceHolder = ew_RemoveHtml($this->f20170406->FldCaption());

			// f20170407
			$this->f20170407->EditAttrs["class"] = "form-control";
			$this->f20170407->EditCustomAttributes = "";
			$this->f20170407->EditValue = ew_HtmlEncode($this->f20170407->CurrentValue);
			$this->f20170407->PlaceHolder = ew_RemoveHtml($this->f20170407->FldCaption());

			// f20170408
			$this->f20170408->EditAttrs["class"] = "form-control";
			$this->f20170408->EditCustomAttributes = "";
			$this->f20170408->EditValue = ew_HtmlEncode($this->f20170408->CurrentValue);
			$this->f20170408->PlaceHolder = ew_RemoveHtml($this->f20170408->FldCaption());

			// f20170409
			$this->f20170409->EditAttrs["class"] = "form-control";
			$this->f20170409->EditCustomAttributes = "";
			$this->f20170409->EditValue = ew_HtmlEncode($this->f20170409->CurrentValue);
			$this->f20170409->PlaceHolder = ew_RemoveHtml($this->f20170409->FldCaption());

			// f20170410
			$this->f20170410->EditAttrs["class"] = "form-control";
			$this->f20170410->EditCustomAttributes = "";
			$this->f20170410->EditValue = ew_HtmlEncode($this->f20170410->CurrentValue);
			$this->f20170410->PlaceHolder = ew_RemoveHtml($this->f20170410->FldCaption());

			// f20170411
			$this->f20170411->EditAttrs["class"] = "form-control";
			$this->f20170411->EditCustomAttributes = "";
			$this->f20170411->EditValue = ew_HtmlEncode($this->f20170411->CurrentValue);
			$this->f20170411->PlaceHolder = ew_RemoveHtml($this->f20170411->FldCaption());

			// f20170412
			$this->f20170412->EditAttrs["class"] = "form-control";
			$this->f20170412->EditCustomAttributes = "";
			$this->f20170412->EditValue = ew_HtmlEncode($this->f20170412->CurrentValue);
			$this->f20170412->PlaceHolder = ew_RemoveHtml($this->f20170412->FldCaption());

			// f20170413
			$this->f20170413->EditAttrs["class"] = "form-control";
			$this->f20170413->EditCustomAttributes = "";
			$this->f20170413->EditValue = ew_HtmlEncode($this->f20170413->CurrentValue);
			$this->f20170413->PlaceHolder = ew_RemoveHtml($this->f20170413->FldCaption());

			// f20170414
			$this->f20170414->EditAttrs["class"] = "form-control";
			$this->f20170414->EditCustomAttributes = "";
			$this->f20170414->EditValue = ew_HtmlEncode($this->f20170414->CurrentValue);
			$this->f20170414->PlaceHolder = ew_RemoveHtml($this->f20170414->FldCaption());

			// f20170415
			$this->f20170415->EditAttrs["class"] = "form-control";
			$this->f20170415->EditCustomAttributes = "";
			$this->f20170415->EditValue = ew_HtmlEncode($this->f20170415->CurrentValue);
			$this->f20170415->PlaceHolder = ew_RemoveHtml($this->f20170415->FldCaption());

			// f20170416
			$this->f20170416->EditAttrs["class"] = "form-control";
			$this->f20170416->EditCustomAttributes = "";
			$this->f20170416->EditValue = ew_HtmlEncode($this->f20170416->CurrentValue);
			$this->f20170416->PlaceHolder = ew_RemoveHtml($this->f20170416->FldCaption());

			// f20170417
			$this->f20170417->EditAttrs["class"] = "form-control";
			$this->f20170417->EditCustomAttributes = "";
			$this->f20170417->EditValue = ew_HtmlEncode($this->f20170417->CurrentValue);
			$this->f20170417->PlaceHolder = ew_RemoveHtml($this->f20170417->FldCaption());

			// f20170418
			$this->f20170418->EditAttrs["class"] = "form-control";
			$this->f20170418->EditCustomAttributes = "";
			$this->f20170418->EditValue = ew_HtmlEncode($this->f20170418->CurrentValue);
			$this->f20170418->PlaceHolder = ew_RemoveHtml($this->f20170418->FldCaption());

			// f20170419
			$this->f20170419->EditAttrs["class"] = "form-control";
			$this->f20170419->EditCustomAttributes = "";
			$this->f20170419->EditValue = ew_HtmlEncode($this->f20170419->CurrentValue);
			$this->f20170419->PlaceHolder = ew_RemoveHtml($this->f20170419->FldCaption());

			// f20170420
			$this->f20170420->EditAttrs["class"] = "form-control";
			$this->f20170420->EditCustomAttributes = "";
			$this->f20170420->EditValue = ew_HtmlEncode($this->f20170420->CurrentValue);
			$this->f20170420->PlaceHolder = ew_RemoveHtml($this->f20170420->FldCaption());

			// f20170421
			$this->f20170421->EditAttrs["class"] = "form-control";
			$this->f20170421->EditCustomAttributes = "";
			$this->f20170421->EditValue = ew_HtmlEncode($this->f20170421->CurrentValue);
			$this->f20170421->PlaceHolder = ew_RemoveHtml($this->f20170421->FldCaption());

			// f20170422
			$this->f20170422->EditAttrs["class"] = "form-control";
			$this->f20170422->EditCustomAttributes = "";
			$this->f20170422->EditValue = ew_HtmlEncode($this->f20170422->CurrentValue);
			$this->f20170422->PlaceHolder = ew_RemoveHtml($this->f20170422->FldCaption());

			// f20170423
			$this->f20170423->EditAttrs["class"] = "form-control";
			$this->f20170423->EditCustomAttributes = "";
			$this->f20170423->EditValue = ew_HtmlEncode($this->f20170423->CurrentValue);
			$this->f20170423->PlaceHolder = ew_RemoveHtml($this->f20170423->FldCaption());

			// f20170424
			$this->f20170424->EditAttrs["class"] = "form-control";
			$this->f20170424->EditCustomAttributes = "";
			$this->f20170424->EditValue = ew_HtmlEncode($this->f20170424->CurrentValue);
			$this->f20170424->PlaceHolder = ew_RemoveHtml($this->f20170424->FldCaption());

			// f20170425
			$this->f20170425->EditAttrs["class"] = "form-control";
			$this->f20170425->EditCustomAttributes = "";
			$this->f20170425->EditValue = ew_HtmlEncode($this->f20170425->CurrentValue);
			$this->f20170425->PlaceHolder = ew_RemoveHtml($this->f20170425->FldCaption());

			// f20170426
			$this->f20170426->EditAttrs["class"] = "form-control";
			$this->f20170426->EditCustomAttributes = "";
			$this->f20170426->EditValue = ew_HtmlEncode($this->f20170426->CurrentValue);
			$this->f20170426->PlaceHolder = ew_RemoveHtml($this->f20170426->FldCaption());

			// f20170427
			$this->f20170427->EditAttrs["class"] = "form-control";
			$this->f20170427->EditCustomAttributes = "";
			$this->f20170427->EditValue = ew_HtmlEncode($this->f20170427->CurrentValue);
			$this->f20170427->PlaceHolder = ew_RemoveHtml($this->f20170427->FldCaption());

			// f20170428
			$this->f20170428->EditAttrs["class"] = "form-control";
			$this->f20170428->EditCustomAttributes = "";
			$this->f20170428->EditValue = ew_HtmlEncode($this->f20170428->CurrentValue);
			$this->f20170428->PlaceHolder = ew_RemoveHtml($this->f20170428->FldCaption());

			// f20170429
			$this->f20170429->EditAttrs["class"] = "form-control";
			$this->f20170429->EditCustomAttributes = "";
			$this->f20170429->EditValue = ew_HtmlEncode($this->f20170429->CurrentValue);
			$this->f20170429->PlaceHolder = ew_RemoveHtml($this->f20170429->FldCaption());

			// f20170430
			$this->f20170430->EditAttrs["class"] = "form-control";
			$this->f20170430->EditCustomAttributes = "";
			$this->f20170430->EditValue = ew_HtmlEncode($this->f20170430->CurrentValue);
			$this->f20170430->PlaceHolder = ew_RemoveHtml($this->f20170430->FldCaption());

			// f20170501
			$this->f20170501->EditAttrs["class"] = "form-control";
			$this->f20170501->EditCustomAttributes = "";
			$this->f20170501->EditValue = ew_HtmlEncode($this->f20170501->CurrentValue);
			$this->f20170501->PlaceHolder = ew_RemoveHtml($this->f20170501->FldCaption());

			// f20170502
			$this->f20170502->EditAttrs["class"] = "form-control";
			$this->f20170502->EditCustomAttributes = "";
			$this->f20170502->EditValue = ew_HtmlEncode($this->f20170502->CurrentValue);
			$this->f20170502->PlaceHolder = ew_RemoveHtml($this->f20170502->FldCaption());

			// f20170503
			$this->f20170503->EditAttrs["class"] = "form-control";
			$this->f20170503->EditCustomAttributes = "";
			$this->f20170503->EditValue = ew_HtmlEncode($this->f20170503->CurrentValue);
			$this->f20170503->PlaceHolder = ew_RemoveHtml($this->f20170503->FldCaption());

			// f20170504
			$this->f20170504->EditAttrs["class"] = "form-control";
			$this->f20170504->EditCustomAttributes = "";
			$this->f20170504->EditValue = ew_HtmlEncode($this->f20170504->CurrentValue);
			$this->f20170504->PlaceHolder = ew_RemoveHtml($this->f20170504->FldCaption());

			// f20170505
			$this->f20170505->EditAttrs["class"] = "form-control";
			$this->f20170505->EditCustomAttributes = "";
			$this->f20170505->EditValue = ew_HtmlEncode($this->f20170505->CurrentValue);
			$this->f20170505->PlaceHolder = ew_RemoveHtml($this->f20170505->FldCaption());

			// f20170506
			$this->f20170506->EditAttrs["class"] = "form-control";
			$this->f20170506->EditCustomAttributes = "";
			$this->f20170506->EditValue = ew_HtmlEncode($this->f20170506->CurrentValue);
			$this->f20170506->PlaceHolder = ew_RemoveHtml($this->f20170506->FldCaption());

			// f20170507
			$this->f20170507->EditAttrs["class"] = "form-control";
			$this->f20170507->EditCustomAttributes = "";
			$this->f20170507->EditValue = ew_HtmlEncode($this->f20170507->CurrentValue);
			$this->f20170507->PlaceHolder = ew_RemoveHtml($this->f20170507->FldCaption());

			// f20170508
			$this->f20170508->EditAttrs["class"] = "form-control";
			$this->f20170508->EditCustomAttributes = "";
			$this->f20170508->EditValue = ew_HtmlEncode($this->f20170508->CurrentValue);
			$this->f20170508->PlaceHolder = ew_RemoveHtml($this->f20170508->FldCaption());

			// f20170509
			$this->f20170509->EditAttrs["class"] = "form-control";
			$this->f20170509->EditCustomAttributes = "";
			$this->f20170509->EditValue = ew_HtmlEncode($this->f20170509->CurrentValue);
			$this->f20170509->PlaceHolder = ew_RemoveHtml($this->f20170509->FldCaption());

			// f20170510
			$this->f20170510->EditAttrs["class"] = "form-control";
			$this->f20170510->EditCustomAttributes = "";
			$this->f20170510->EditValue = ew_HtmlEncode($this->f20170510->CurrentValue);
			$this->f20170510->PlaceHolder = ew_RemoveHtml($this->f20170510->FldCaption());

			// f20170511
			$this->f20170511->EditAttrs["class"] = "form-control";
			$this->f20170511->EditCustomAttributes = "";
			$this->f20170511->EditValue = ew_HtmlEncode($this->f20170511->CurrentValue);
			$this->f20170511->PlaceHolder = ew_RemoveHtml($this->f20170511->FldCaption());

			// f20170512
			$this->f20170512->EditAttrs["class"] = "form-control";
			$this->f20170512->EditCustomAttributes = "";
			$this->f20170512->EditValue = ew_HtmlEncode($this->f20170512->CurrentValue);
			$this->f20170512->PlaceHolder = ew_RemoveHtml($this->f20170512->FldCaption());

			// f20170513
			$this->f20170513->EditAttrs["class"] = "form-control";
			$this->f20170513->EditCustomAttributes = "";
			$this->f20170513->EditValue = ew_HtmlEncode($this->f20170513->CurrentValue);
			$this->f20170513->PlaceHolder = ew_RemoveHtml($this->f20170513->FldCaption());

			// f20170514
			$this->f20170514->EditAttrs["class"] = "form-control";
			$this->f20170514->EditCustomAttributes = "";
			$this->f20170514->EditValue = ew_HtmlEncode($this->f20170514->CurrentValue);
			$this->f20170514->PlaceHolder = ew_RemoveHtml($this->f20170514->FldCaption());

			// f20170515
			$this->f20170515->EditAttrs["class"] = "form-control";
			$this->f20170515->EditCustomAttributes = "";
			$this->f20170515->EditValue = ew_HtmlEncode($this->f20170515->CurrentValue);
			$this->f20170515->PlaceHolder = ew_RemoveHtml($this->f20170515->FldCaption());

			// f20170516
			$this->f20170516->EditAttrs["class"] = "form-control";
			$this->f20170516->EditCustomAttributes = "";
			$this->f20170516->EditValue = ew_HtmlEncode($this->f20170516->CurrentValue);
			$this->f20170516->PlaceHolder = ew_RemoveHtml($this->f20170516->FldCaption());

			// f20170517
			$this->f20170517->EditAttrs["class"] = "form-control";
			$this->f20170517->EditCustomAttributes = "";
			$this->f20170517->EditValue = ew_HtmlEncode($this->f20170517->CurrentValue);
			$this->f20170517->PlaceHolder = ew_RemoveHtml($this->f20170517->FldCaption());

			// f20170518
			$this->f20170518->EditAttrs["class"] = "form-control";
			$this->f20170518->EditCustomAttributes = "";
			$this->f20170518->EditValue = ew_HtmlEncode($this->f20170518->CurrentValue);
			$this->f20170518->PlaceHolder = ew_RemoveHtml($this->f20170518->FldCaption());

			// f20170519
			$this->f20170519->EditAttrs["class"] = "form-control";
			$this->f20170519->EditCustomAttributes = "";
			$this->f20170519->EditValue = ew_HtmlEncode($this->f20170519->CurrentValue);
			$this->f20170519->PlaceHolder = ew_RemoveHtml($this->f20170519->FldCaption());

			// f20170520
			$this->f20170520->EditAttrs["class"] = "form-control";
			$this->f20170520->EditCustomAttributes = "";
			$this->f20170520->EditValue = ew_HtmlEncode($this->f20170520->CurrentValue);
			$this->f20170520->PlaceHolder = ew_RemoveHtml($this->f20170520->FldCaption());

			// f20170521
			$this->f20170521->EditAttrs["class"] = "form-control";
			$this->f20170521->EditCustomAttributes = "";
			$this->f20170521->EditValue = ew_HtmlEncode($this->f20170521->CurrentValue);
			$this->f20170521->PlaceHolder = ew_RemoveHtml($this->f20170521->FldCaption());

			// f20170522
			$this->f20170522->EditAttrs["class"] = "form-control";
			$this->f20170522->EditCustomAttributes = "";
			$this->f20170522->EditValue = ew_HtmlEncode($this->f20170522->CurrentValue);
			$this->f20170522->PlaceHolder = ew_RemoveHtml($this->f20170522->FldCaption());

			// f20170523
			$this->f20170523->EditAttrs["class"] = "form-control";
			$this->f20170523->EditCustomAttributes = "";
			$this->f20170523->EditValue = ew_HtmlEncode($this->f20170523->CurrentValue);
			$this->f20170523->PlaceHolder = ew_RemoveHtml($this->f20170523->FldCaption());

			// f20170524
			$this->f20170524->EditAttrs["class"] = "form-control";
			$this->f20170524->EditCustomAttributes = "";
			$this->f20170524->EditValue = ew_HtmlEncode($this->f20170524->CurrentValue);
			$this->f20170524->PlaceHolder = ew_RemoveHtml($this->f20170524->FldCaption());

			// f20170525
			$this->f20170525->EditAttrs["class"] = "form-control";
			$this->f20170525->EditCustomAttributes = "";
			$this->f20170525->EditValue = ew_HtmlEncode($this->f20170525->CurrentValue);
			$this->f20170525->PlaceHolder = ew_RemoveHtml($this->f20170525->FldCaption());

			// f20170526
			$this->f20170526->EditAttrs["class"] = "form-control";
			$this->f20170526->EditCustomAttributes = "";
			$this->f20170526->EditValue = ew_HtmlEncode($this->f20170526->CurrentValue);
			$this->f20170526->PlaceHolder = ew_RemoveHtml($this->f20170526->FldCaption());

			// f20170527
			$this->f20170527->EditAttrs["class"] = "form-control";
			$this->f20170527->EditCustomAttributes = "";
			$this->f20170527->EditValue = ew_HtmlEncode($this->f20170527->CurrentValue);
			$this->f20170527->PlaceHolder = ew_RemoveHtml($this->f20170527->FldCaption());

			// f20170528
			$this->f20170528->EditAttrs["class"] = "form-control";
			$this->f20170528->EditCustomAttributes = "";
			$this->f20170528->EditValue = ew_HtmlEncode($this->f20170528->CurrentValue);
			$this->f20170528->PlaceHolder = ew_RemoveHtml($this->f20170528->FldCaption());

			// f20170529
			$this->f20170529->EditAttrs["class"] = "form-control";
			$this->f20170529->EditCustomAttributes = "";
			$this->f20170529->EditValue = ew_HtmlEncode($this->f20170529->CurrentValue);
			$this->f20170529->PlaceHolder = ew_RemoveHtml($this->f20170529->FldCaption());

			// f20170530
			$this->f20170530->EditAttrs["class"] = "form-control";
			$this->f20170530->EditCustomAttributes = "";
			$this->f20170530->EditValue = ew_HtmlEncode($this->f20170530->CurrentValue);
			$this->f20170530->PlaceHolder = ew_RemoveHtml($this->f20170530->FldCaption());

			// f20170531
			$this->f20170531->EditAttrs["class"] = "form-control";
			$this->f20170531->EditCustomAttributes = "";
			$this->f20170531->EditValue = ew_HtmlEncode($this->f20170531->CurrentValue);
			$this->f20170531->PlaceHolder = ew_RemoveHtml($this->f20170531->FldCaption());

			// f20170601
			$this->f20170601->EditAttrs["class"] = "form-control";
			$this->f20170601->EditCustomAttributes = "";
			$this->f20170601->EditValue = ew_HtmlEncode($this->f20170601->CurrentValue);
			$this->f20170601->PlaceHolder = ew_RemoveHtml($this->f20170601->FldCaption());

			// f20170602
			$this->f20170602->EditAttrs["class"] = "form-control";
			$this->f20170602->EditCustomAttributes = "";
			$this->f20170602->EditValue = ew_HtmlEncode($this->f20170602->CurrentValue);
			$this->f20170602->PlaceHolder = ew_RemoveHtml($this->f20170602->FldCaption());

			// f20170603
			$this->f20170603->EditAttrs["class"] = "form-control";
			$this->f20170603->EditCustomAttributes = "";
			$this->f20170603->EditValue = ew_HtmlEncode($this->f20170603->CurrentValue);
			$this->f20170603->PlaceHolder = ew_RemoveHtml($this->f20170603->FldCaption());

			// f20170604
			$this->f20170604->EditAttrs["class"] = "form-control";
			$this->f20170604->EditCustomAttributes = "";
			$this->f20170604->EditValue = ew_HtmlEncode($this->f20170604->CurrentValue);
			$this->f20170604->PlaceHolder = ew_RemoveHtml($this->f20170604->FldCaption());

			// f20170605
			$this->f20170605->EditAttrs["class"] = "form-control";
			$this->f20170605->EditCustomAttributes = "";
			$this->f20170605->EditValue = ew_HtmlEncode($this->f20170605->CurrentValue);
			$this->f20170605->PlaceHolder = ew_RemoveHtml($this->f20170605->FldCaption());

			// f20170606
			$this->f20170606->EditAttrs["class"] = "form-control";
			$this->f20170606->EditCustomAttributes = "";
			$this->f20170606->EditValue = ew_HtmlEncode($this->f20170606->CurrentValue);
			$this->f20170606->PlaceHolder = ew_RemoveHtml($this->f20170606->FldCaption());

			// f20170607
			$this->f20170607->EditAttrs["class"] = "form-control";
			$this->f20170607->EditCustomAttributes = "";
			$this->f20170607->EditValue = ew_HtmlEncode($this->f20170607->CurrentValue);
			$this->f20170607->PlaceHolder = ew_RemoveHtml($this->f20170607->FldCaption());

			// f20170608
			$this->f20170608->EditAttrs["class"] = "form-control";
			$this->f20170608->EditCustomAttributes = "";
			$this->f20170608->EditValue = ew_HtmlEncode($this->f20170608->CurrentValue);
			$this->f20170608->PlaceHolder = ew_RemoveHtml($this->f20170608->FldCaption());

			// f20170609
			$this->f20170609->EditAttrs["class"] = "form-control";
			$this->f20170609->EditCustomAttributes = "";
			$this->f20170609->EditValue = ew_HtmlEncode($this->f20170609->CurrentValue);
			$this->f20170609->PlaceHolder = ew_RemoveHtml($this->f20170609->FldCaption());

			// f20170610
			$this->f20170610->EditAttrs["class"] = "form-control";
			$this->f20170610->EditCustomAttributes = "";
			$this->f20170610->EditValue = ew_HtmlEncode($this->f20170610->CurrentValue);
			$this->f20170610->PlaceHolder = ew_RemoveHtml($this->f20170610->FldCaption());

			// f20170611
			$this->f20170611->EditAttrs["class"] = "form-control";
			$this->f20170611->EditCustomAttributes = "";
			$this->f20170611->EditValue = ew_HtmlEncode($this->f20170611->CurrentValue);
			$this->f20170611->PlaceHolder = ew_RemoveHtml($this->f20170611->FldCaption());

			// f20170612
			$this->f20170612->EditAttrs["class"] = "form-control";
			$this->f20170612->EditCustomAttributes = "";
			$this->f20170612->EditValue = ew_HtmlEncode($this->f20170612->CurrentValue);
			$this->f20170612->PlaceHolder = ew_RemoveHtml($this->f20170612->FldCaption());

			// f20170613
			$this->f20170613->EditAttrs["class"] = "form-control";
			$this->f20170613->EditCustomAttributes = "";
			$this->f20170613->EditValue = ew_HtmlEncode($this->f20170613->CurrentValue);
			$this->f20170613->PlaceHolder = ew_RemoveHtml($this->f20170613->FldCaption());

			// f20170614
			$this->f20170614->EditAttrs["class"] = "form-control";
			$this->f20170614->EditCustomAttributes = "";
			$this->f20170614->EditValue = ew_HtmlEncode($this->f20170614->CurrentValue);
			$this->f20170614->PlaceHolder = ew_RemoveHtml($this->f20170614->FldCaption());

			// f20170615
			$this->f20170615->EditAttrs["class"] = "form-control";
			$this->f20170615->EditCustomAttributes = "";
			$this->f20170615->EditValue = ew_HtmlEncode($this->f20170615->CurrentValue);
			$this->f20170615->PlaceHolder = ew_RemoveHtml($this->f20170615->FldCaption());

			// f20170616
			$this->f20170616->EditAttrs["class"] = "form-control";
			$this->f20170616->EditCustomAttributes = "";
			$this->f20170616->EditValue = ew_HtmlEncode($this->f20170616->CurrentValue);
			$this->f20170616->PlaceHolder = ew_RemoveHtml($this->f20170616->FldCaption());

			// f20170617
			$this->f20170617->EditAttrs["class"] = "form-control";
			$this->f20170617->EditCustomAttributes = "";
			$this->f20170617->EditValue = ew_HtmlEncode($this->f20170617->CurrentValue);
			$this->f20170617->PlaceHolder = ew_RemoveHtml($this->f20170617->FldCaption());

			// f20170618
			$this->f20170618->EditAttrs["class"] = "form-control";
			$this->f20170618->EditCustomAttributes = "";
			$this->f20170618->EditValue = ew_HtmlEncode($this->f20170618->CurrentValue);
			$this->f20170618->PlaceHolder = ew_RemoveHtml($this->f20170618->FldCaption());

			// f20170619
			$this->f20170619->EditAttrs["class"] = "form-control";
			$this->f20170619->EditCustomAttributes = "";
			$this->f20170619->EditValue = ew_HtmlEncode($this->f20170619->CurrentValue);
			$this->f20170619->PlaceHolder = ew_RemoveHtml($this->f20170619->FldCaption());

			// f20170620
			$this->f20170620->EditAttrs["class"] = "form-control";
			$this->f20170620->EditCustomAttributes = "";
			$this->f20170620->EditValue = ew_HtmlEncode($this->f20170620->CurrentValue);
			$this->f20170620->PlaceHolder = ew_RemoveHtml($this->f20170620->FldCaption());

			// f20170621
			$this->f20170621->EditAttrs["class"] = "form-control";
			$this->f20170621->EditCustomAttributes = "";
			$this->f20170621->EditValue = ew_HtmlEncode($this->f20170621->CurrentValue);
			$this->f20170621->PlaceHolder = ew_RemoveHtml($this->f20170621->FldCaption());

			// f20170622
			$this->f20170622->EditAttrs["class"] = "form-control";
			$this->f20170622->EditCustomAttributes = "";
			$this->f20170622->EditValue = ew_HtmlEncode($this->f20170622->CurrentValue);
			$this->f20170622->PlaceHolder = ew_RemoveHtml($this->f20170622->FldCaption());

			// f20170623
			$this->f20170623->EditAttrs["class"] = "form-control";
			$this->f20170623->EditCustomAttributes = "";
			$this->f20170623->EditValue = ew_HtmlEncode($this->f20170623->CurrentValue);
			$this->f20170623->PlaceHolder = ew_RemoveHtml($this->f20170623->FldCaption());

			// f20170624
			$this->f20170624->EditAttrs["class"] = "form-control";
			$this->f20170624->EditCustomAttributes = "";
			$this->f20170624->EditValue = ew_HtmlEncode($this->f20170624->CurrentValue);
			$this->f20170624->PlaceHolder = ew_RemoveHtml($this->f20170624->FldCaption());

			// f20170625
			$this->f20170625->EditAttrs["class"] = "form-control";
			$this->f20170625->EditCustomAttributes = "";
			$this->f20170625->EditValue = ew_HtmlEncode($this->f20170625->CurrentValue);
			$this->f20170625->PlaceHolder = ew_RemoveHtml($this->f20170625->FldCaption());

			// f20170626
			$this->f20170626->EditAttrs["class"] = "form-control";
			$this->f20170626->EditCustomAttributes = "";
			$this->f20170626->EditValue = ew_HtmlEncode($this->f20170626->CurrentValue);
			$this->f20170626->PlaceHolder = ew_RemoveHtml($this->f20170626->FldCaption());

			// f20170627
			$this->f20170627->EditAttrs["class"] = "form-control";
			$this->f20170627->EditCustomAttributes = "";
			$this->f20170627->EditValue = ew_HtmlEncode($this->f20170627->CurrentValue);
			$this->f20170627->PlaceHolder = ew_RemoveHtml($this->f20170627->FldCaption());

			// f20170628
			$this->f20170628->EditAttrs["class"] = "form-control";
			$this->f20170628->EditCustomAttributes = "";
			$this->f20170628->EditValue = ew_HtmlEncode($this->f20170628->CurrentValue);
			$this->f20170628->PlaceHolder = ew_RemoveHtml($this->f20170628->FldCaption());

			// f20170629
			$this->f20170629->EditAttrs["class"] = "form-control";
			$this->f20170629->EditCustomAttributes = "";
			$this->f20170629->EditValue = ew_HtmlEncode($this->f20170629->CurrentValue);
			$this->f20170629->PlaceHolder = ew_RemoveHtml($this->f20170629->FldCaption());

			// f20170630
			$this->f20170630->EditAttrs["class"] = "form-control";
			$this->f20170630->EditCustomAttributes = "";
			$this->f20170630->EditValue = ew_HtmlEncode($this->f20170630->CurrentValue);
			$this->f20170630->PlaceHolder = ew_RemoveHtml($this->f20170630->FldCaption());

			// f20170701
			$this->f20170701->EditAttrs["class"] = "form-control";
			$this->f20170701->EditCustomAttributes = "";
			$this->f20170701->EditValue = ew_HtmlEncode($this->f20170701->CurrentValue);
			$this->f20170701->PlaceHolder = ew_RemoveHtml($this->f20170701->FldCaption());

			// f20170702
			$this->f20170702->EditAttrs["class"] = "form-control";
			$this->f20170702->EditCustomAttributes = "";
			$this->f20170702->EditValue = ew_HtmlEncode($this->f20170702->CurrentValue);
			$this->f20170702->PlaceHolder = ew_RemoveHtml($this->f20170702->FldCaption());

			// f20170703
			$this->f20170703->EditAttrs["class"] = "form-control";
			$this->f20170703->EditCustomAttributes = "";
			$this->f20170703->EditValue = ew_HtmlEncode($this->f20170703->CurrentValue);
			$this->f20170703->PlaceHolder = ew_RemoveHtml($this->f20170703->FldCaption());

			// f20170704
			$this->f20170704->EditAttrs["class"] = "form-control";
			$this->f20170704->EditCustomAttributes = "";
			$this->f20170704->EditValue = ew_HtmlEncode($this->f20170704->CurrentValue);
			$this->f20170704->PlaceHolder = ew_RemoveHtml($this->f20170704->FldCaption());

			// f20170705
			$this->f20170705->EditAttrs["class"] = "form-control";
			$this->f20170705->EditCustomAttributes = "";
			$this->f20170705->EditValue = ew_HtmlEncode($this->f20170705->CurrentValue);
			$this->f20170705->PlaceHolder = ew_RemoveHtml($this->f20170705->FldCaption());

			// f20170706
			$this->f20170706->EditAttrs["class"] = "form-control";
			$this->f20170706->EditCustomAttributes = "";
			$this->f20170706->EditValue = ew_HtmlEncode($this->f20170706->CurrentValue);
			$this->f20170706->PlaceHolder = ew_RemoveHtml($this->f20170706->FldCaption());

			// f20170707
			$this->f20170707->EditAttrs["class"] = "form-control";
			$this->f20170707->EditCustomAttributes = "";
			$this->f20170707->EditValue = ew_HtmlEncode($this->f20170707->CurrentValue);
			$this->f20170707->PlaceHolder = ew_RemoveHtml($this->f20170707->FldCaption());

			// f20170708
			$this->f20170708->EditAttrs["class"] = "form-control";
			$this->f20170708->EditCustomAttributes = "";
			$this->f20170708->EditValue = ew_HtmlEncode($this->f20170708->CurrentValue);
			$this->f20170708->PlaceHolder = ew_RemoveHtml($this->f20170708->FldCaption());

			// f20170709
			$this->f20170709->EditAttrs["class"] = "form-control";
			$this->f20170709->EditCustomAttributes = "";
			$this->f20170709->EditValue = ew_HtmlEncode($this->f20170709->CurrentValue);
			$this->f20170709->PlaceHolder = ew_RemoveHtml($this->f20170709->FldCaption());

			// f20170710
			$this->f20170710->EditAttrs["class"] = "form-control";
			$this->f20170710->EditCustomAttributes = "";
			$this->f20170710->EditValue = ew_HtmlEncode($this->f20170710->CurrentValue);
			$this->f20170710->PlaceHolder = ew_RemoveHtml($this->f20170710->FldCaption());

			// f20170711
			$this->f20170711->EditAttrs["class"] = "form-control";
			$this->f20170711->EditCustomAttributes = "";
			$this->f20170711->EditValue = ew_HtmlEncode($this->f20170711->CurrentValue);
			$this->f20170711->PlaceHolder = ew_RemoveHtml($this->f20170711->FldCaption());

			// f20170712
			$this->f20170712->EditAttrs["class"] = "form-control";
			$this->f20170712->EditCustomAttributes = "";
			$this->f20170712->EditValue = ew_HtmlEncode($this->f20170712->CurrentValue);
			$this->f20170712->PlaceHolder = ew_RemoveHtml($this->f20170712->FldCaption());

			// f20170713
			$this->f20170713->EditAttrs["class"] = "form-control";
			$this->f20170713->EditCustomAttributes = "";
			$this->f20170713->EditValue = ew_HtmlEncode($this->f20170713->CurrentValue);
			$this->f20170713->PlaceHolder = ew_RemoveHtml($this->f20170713->FldCaption());

			// f20170714
			$this->f20170714->EditAttrs["class"] = "form-control";
			$this->f20170714->EditCustomAttributes = "";
			$this->f20170714->EditValue = ew_HtmlEncode($this->f20170714->CurrentValue);
			$this->f20170714->PlaceHolder = ew_RemoveHtml($this->f20170714->FldCaption());

			// f20170715
			$this->f20170715->EditAttrs["class"] = "form-control";
			$this->f20170715->EditCustomAttributes = "";
			$this->f20170715->EditValue = ew_HtmlEncode($this->f20170715->CurrentValue);
			$this->f20170715->PlaceHolder = ew_RemoveHtml($this->f20170715->FldCaption());

			// f20170716
			$this->f20170716->EditAttrs["class"] = "form-control";
			$this->f20170716->EditCustomAttributes = "";
			$this->f20170716->EditValue = ew_HtmlEncode($this->f20170716->CurrentValue);
			$this->f20170716->PlaceHolder = ew_RemoveHtml($this->f20170716->FldCaption());

			// f20170717
			$this->f20170717->EditAttrs["class"] = "form-control";
			$this->f20170717->EditCustomAttributes = "";
			$this->f20170717->EditValue = ew_HtmlEncode($this->f20170717->CurrentValue);
			$this->f20170717->PlaceHolder = ew_RemoveHtml($this->f20170717->FldCaption());

			// f20170718
			$this->f20170718->EditAttrs["class"] = "form-control";
			$this->f20170718->EditCustomAttributes = "";
			$this->f20170718->EditValue = ew_HtmlEncode($this->f20170718->CurrentValue);
			$this->f20170718->PlaceHolder = ew_RemoveHtml($this->f20170718->FldCaption());

			// f20170719
			$this->f20170719->EditAttrs["class"] = "form-control";
			$this->f20170719->EditCustomAttributes = "";
			$this->f20170719->EditValue = ew_HtmlEncode($this->f20170719->CurrentValue);
			$this->f20170719->PlaceHolder = ew_RemoveHtml($this->f20170719->FldCaption());

			// f20170720
			$this->f20170720->EditAttrs["class"] = "form-control";
			$this->f20170720->EditCustomAttributes = "";
			$this->f20170720->EditValue = ew_HtmlEncode($this->f20170720->CurrentValue);
			$this->f20170720->PlaceHolder = ew_RemoveHtml($this->f20170720->FldCaption());

			// f20170721
			$this->f20170721->EditAttrs["class"] = "form-control";
			$this->f20170721->EditCustomAttributes = "";
			$this->f20170721->EditValue = ew_HtmlEncode($this->f20170721->CurrentValue);
			$this->f20170721->PlaceHolder = ew_RemoveHtml($this->f20170721->FldCaption());

			// f20170722
			$this->f20170722->EditAttrs["class"] = "form-control";
			$this->f20170722->EditCustomAttributes = "";
			$this->f20170722->EditValue = ew_HtmlEncode($this->f20170722->CurrentValue);
			$this->f20170722->PlaceHolder = ew_RemoveHtml($this->f20170722->FldCaption());

			// f20170723
			$this->f20170723->EditAttrs["class"] = "form-control";
			$this->f20170723->EditCustomAttributes = "";
			$this->f20170723->EditValue = ew_HtmlEncode($this->f20170723->CurrentValue);
			$this->f20170723->PlaceHolder = ew_RemoveHtml($this->f20170723->FldCaption());

			// f20170724
			$this->f20170724->EditAttrs["class"] = "form-control";
			$this->f20170724->EditCustomAttributes = "";
			$this->f20170724->EditValue = ew_HtmlEncode($this->f20170724->CurrentValue);
			$this->f20170724->PlaceHolder = ew_RemoveHtml($this->f20170724->FldCaption());

			// f20170725
			$this->f20170725->EditAttrs["class"] = "form-control";
			$this->f20170725->EditCustomAttributes = "";
			$this->f20170725->EditValue = ew_HtmlEncode($this->f20170725->CurrentValue);
			$this->f20170725->PlaceHolder = ew_RemoveHtml($this->f20170725->FldCaption());

			// f20170726
			$this->f20170726->EditAttrs["class"] = "form-control";
			$this->f20170726->EditCustomAttributes = "";
			$this->f20170726->EditValue = ew_HtmlEncode($this->f20170726->CurrentValue);
			$this->f20170726->PlaceHolder = ew_RemoveHtml($this->f20170726->FldCaption());

			// f20170727
			$this->f20170727->EditAttrs["class"] = "form-control";
			$this->f20170727->EditCustomAttributes = "";
			$this->f20170727->EditValue = ew_HtmlEncode($this->f20170727->CurrentValue);
			$this->f20170727->PlaceHolder = ew_RemoveHtml($this->f20170727->FldCaption());

			// f20170728
			$this->f20170728->EditAttrs["class"] = "form-control";
			$this->f20170728->EditCustomAttributes = "";
			$this->f20170728->EditValue = ew_HtmlEncode($this->f20170728->CurrentValue);
			$this->f20170728->PlaceHolder = ew_RemoveHtml($this->f20170728->FldCaption());

			// f20170729
			$this->f20170729->EditAttrs["class"] = "form-control";
			$this->f20170729->EditCustomAttributes = "";
			$this->f20170729->EditValue = ew_HtmlEncode($this->f20170729->CurrentValue);
			$this->f20170729->PlaceHolder = ew_RemoveHtml($this->f20170729->FldCaption());

			// f20170730
			$this->f20170730->EditAttrs["class"] = "form-control";
			$this->f20170730->EditCustomAttributes = "";
			$this->f20170730->EditValue = ew_HtmlEncode($this->f20170730->CurrentValue);
			$this->f20170730->PlaceHolder = ew_RemoveHtml($this->f20170730->FldCaption());

			// f20170731
			$this->f20170731->EditAttrs["class"] = "form-control";
			$this->f20170731->EditCustomAttributes = "";
			$this->f20170731->EditValue = ew_HtmlEncode($this->f20170731->CurrentValue);
			$this->f20170731->PlaceHolder = ew_RemoveHtml($this->f20170731->FldCaption());

			// f20170801
			$this->f20170801->EditAttrs["class"] = "form-control";
			$this->f20170801->EditCustomAttributes = "";
			$this->f20170801->EditValue = ew_HtmlEncode($this->f20170801->CurrentValue);
			$this->f20170801->PlaceHolder = ew_RemoveHtml($this->f20170801->FldCaption());

			// f20170802
			$this->f20170802->EditAttrs["class"] = "form-control";
			$this->f20170802->EditCustomAttributes = "";
			$this->f20170802->EditValue = ew_HtmlEncode($this->f20170802->CurrentValue);
			$this->f20170802->PlaceHolder = ew_RemoveHtml($this->f20170802->FldCaption());

			// f20170803
			$this->f20170803->EditAttrs["class"] = "form-control";
			$this->f20170803->EditCustomAttributes = "";
			$this->f20170803->EditValue = ew_HtmlEncode($this->f20170803->CurrentValue);
			$this->f20170803->PlaceHolder = ew_RemoveHtml($this->f20170803->FldCaption());

			// f20170804
			$this->f20170804->EditAttrs["class"] = "form-control";
			$this->f20170804->EditCustomAttributes = "";
			$this->f20170804->EditValue = ew_HtmlEncode($this->f20170804->CurrentValue);
			$this->f20170804->PlaceHolder = ew_RemoveHtml($this->f20170804->FldCaption());

			// f20170805
			$this->f20170805->EditAttrs["class"] = "form-control";
			$this->f20170805->EditCustomAttributes = "";
			$this->f20170805->EditValue = ew_HtmlEncode($this->f20170805->CurrentValue);
			$this->f20170805->PlaceHolder = ew_RemoveHtml($this->f20170805->FldCaption());

			// f20170806
			$this->f20170806->EditAttrs["class"] = "form-control";
			$this->f20170806->EditCustomAttributes = "";
			$this->f20170806->EditValue = ew_HtmlEncode($this->f20170806->CurrentValue);
			$this->f20170806->PlaceHolder = ew_RemoveHtml($this->f20170806->FldCaption());

			// f20170807
			$this->f20170807->EditAttrs["class"] = "form-control";
			$this->f20170807->EditCustomAttributes = "";
			$this->f20170807->EditValue = ew_HtmlEncode($this->f20170807->CurrentValue);
			$this->f20170807->PlaceHolder = ew_RemoveHtml($this->f20170807->FldCaption());

			// f20170808
			$this->f20170808->EditAttrs["class"] = "form-control";
			$this->f20170808->EditCustomAttributes = "";
			$this->f20170808->EditValue = ew_HtmlEncode($this->f20170808->CurrentValue);
			$this->f20170808->PlaceHolder = ew_RemoveHtml($this->f20170808->FldCaption());

			// f20170809
			$this->f20170809->EditAttrs["class"] = "form-control";
			$this->f20170809->EditCustomAttributes = "";
			$this->f20170809->EditValue = ew_HtmlEncode($this->f20170809->CurrentValue);
			$this->f20170809->PlaceHolder = ew_RemoveHtml($this->f20170809->FldCaption());

			// f20170810
			$this->f20170810->EditAttrs["class"] = "form-control";
			$this->f20170810->EditCustomAttributes = "";
			$this->f20170810->EditValue = ew_HtmlEncode($this->f20170810->CurrentValue);
			$this->f20170810->PlaceHolder = ew_RemoveHtml($this->f20170810->FldCaption());

			// f20170811
			$this->f20170811->EditAttrs["class"] = "form-control";
			$this->f20170811->EditCustomAttributes = "";
			$this->f20170811->EditValue = ew_HtmlEncode($this->f20170811->CurrentValue);
			$this->f20170811->PlaceHolder = ew_RemoveHtml($this->f20170811->FldCaption());

			// f20170812
			$this->f20170812->EditAttrs["class"] = "form-control";
			$this->f20170812->EditCustomAttributes = "";
			$this->f20170812->EditValue = ew_HtmlEncode($this->f20170812->CurrentValue);
			$this->f20170812->PlaceHolder = ew_RemoveHtml($this->f20170812->FldCaption());

			// f20170813
			$this->f20170813->EditAttrs["class"] = "form-control";
			$this->f20170813->EditCustomAttributes = "";
			$this->f20170813->EditValue = ew_HtmlEncode($this->f20170813->CurrentValue);
			$this->f20170813->PlaceHolder = ew_RemoveHtml($this->f20170813->FldCaption());

			// f20170814
			$this->f20170814->EditAttrs["class"] = "form-control";
			$this->f20170814->EditCustomAttributes = "";
			$this->f20170814->EditValue = ew_HtmlEncode($this->f20170814->CurrentValue);
			$this->f20170814->PlaceHolder = ew_RemoveHtml($this->f20170814->FldCaption());

			// f20170815
			$this->f20170815->EditAttrs["class"] = "form-control";
			$this->f20170815->EditCustomAttributes = "";
			$this->f20170815->EditValue = ew_HtmlEncode($this->f20170815->CurrentValue);
			$this->f20170815->PlaceHolder = ew_RemoveHtml($this->f20170815->FldCaption());

			// f20170816
			$this->f20170816->EditAttrs["class"] = "form-control";
			$this->f20170816->EditCustomAttributes = "";
			$this->f20170816->EditValue = ew_HtmlEncode($this->f20170816->CurrentValue);
			$this->f20170816->PlaceHolder = ew_RemoveHtml($this->f20170816->FldCaption());

			// f20170817
			$this->f20170817->EditAttrs["class"] = "form-control";
			$this->f20170817->EditCustomAttributes = "";
			$this->f20170817->EditValue = ew_HtmlEncode($this->f20170817->CurrentValue);
			$this->f20170817->PlaceHolder = ew_RemoveHtml($this->f20170817->FldCaption());

			// f20170818
			$this->f20170818->EditAttrs["class"] = "form-control";
			$this->f20170818->EditCustomAttributes = "";
			$this->f20170818->EditValue = ew_HtmlEncode($this->f20170818->CurrentValue);
			$this->f20170818->PlaceHolder = ew_RemoveHtml($this->f20170818->FldCaption());

			// f20170819
			$this->f20170819->EditAttrs["class"] = "form-control";
			$this->f20170819->EditCustomAttributes = "";
			$this->f20170819->EditValue = ew_HtmlEncode($this->f20170819->CurrentValue);
			$this->f20170819->PlaceHolder = ew_RemoveHtml($this->f20170819->FldCaption());

			// f20170820
			$this->f20170820->EditAttrs["class"] = "form-control";
			$this->f20170820->EditCustomAttributes = "";
			$this->f20170820->EditValue = ew_HtmlEncode($this->f20170820->CurrentValue);
			$this->f20170820->PlaceHolder = ew_RemoveHtml($this->f20170820->FldCaption());

			// f20170821
			$this->f20170821->EditAttrs["class"] = "form-control";
			$this->f20170821->EditCustomAttributes = "";
			$this->f20170821->EditValue = ew_HtmlEncode($this->f20170821->CurrentValue);
			$this->f20170821->PlaceHolder = ew_RemoveHtml($this->f20170821->FldCaption());

			// f20170822
			$this->f20170822->EditAttrs["class"] = "form-control";
			$this->f20170822->EditCustomAttributes = "";
			$this->f20170822->EditValue = ew_HtmlEncode($this->f20170822->CurrentValue);
			$this->f20170822->PlaceHolder = ew_RemoveHtml($this->f20170822->FldCaption());

			// f20170823
			$this->f20170823->EditAttrs["class"] = "form-control";
			$this->f20170823->EditCustomAttributes = "";
			$this->f20170823->EditValue = ew_HtmlEncode($this->f20170823->CurrentValue);
			$this->f20170823->PlaceHolder = ew_RemoveHtml($this->f20170823->FldCaption());

			// f20170824
			$this->f20170824->EditAttrs["class"] = "form-control";
			$this->f20170824->EditCustomAttributes = "";
			$this->f20170824->EditValue = ew_HtmlEncode($this->f20170824->CurrentValue);
			$this->f20170824->PlaceHolder = ew_RemoveHtml($this->f20170824->FldCaption());

			// f20170825
			$this->f20170825->EditAttrs["class"] = "form-control";
			$this->f20170825->EditCustomAttributes = "";
			$this->f20170825->EditValue = ew_HtmlEncode($this->f20170825->CurrentValue);
			$this->f20170825->PlaceHolder = ew_RemoveHtml($this->f20170825->FldCaption());

			// f20170826
			$this->f20170826->EditAttrs["class"] = "form-control";
			$this->f20170826->EditCustomAttributes = "";
			$this->f20170826->EditValue = ew_HtmlEncode($this->f20170826->CurrentValue);
			$this->f20170826->PlaceHolder = ew_RemoveHtml($this->f20170826->FldCaption());

			// f20170827
			$this->f20170827->EditAttrs["class"] = "form-control";
			$this->f20170827->EditCustomAttributes = "";
			$this->f20170827->EditValue = ew_HtmlEncode($this->f20170827->CurrentValue);
			$this->f20170827->PlaceHolder = ew_RemoveHtml($this->f20170827->FldCaption());

			// f20170828
			$this->f20170828->EditAttrs["class"] = "form-control";
			$this->f20170828->EditCustomAttributes = "";
			$this->f20170828->EditValue = ew_HtmlEncode($this->f20170828->CurrentValue);
			$this->f20170828->PlaceHolder = ew_RemoveHtml($this->f20170828->FldCaption());

			// f20170829
			$this->f20170829->EditAttrs["class"] = "form-control";
			$this->f20170829->EditCustomAttributes = "";
			$this->f20170829->EditValue = ew_HtmlEncode($this->f20170829->CurrentValue);
			$this->f20170829->PlaceHolder = ew_RemoveHtml($this->f20170829->FldCaption());

			// f20170830
			$this->f20170830->EditAttrs["class"] = "form-control";
			$this->f20170830->EditCustomAttributes = "";
			$this->f20170830->EditValue = ew_HtmlEncode($this->f20170830->CurrentValue);
			$this->f20170830->PlaceHolder = ew_RemoveHtml($this->f20170830->FldCaption());

			// f20170831
			$this->f20170831->EditAttrs["class"] = "form-control";
			$this->f20170831->EditCustomAttributes = "";
			$this->f20170831->EditValue = ew_HtmlEncode($this->f20170831->CurrentValue);
			$this->f20170831->PlaceHolder = ew_RemoveHtml($this->f20170831->FldCaption());

			// f20170901
			$this->f20170901->EditAttrs["class"] = "form-control";
			$this->f20170901->EditCustomAttributes = "";
			$this->f20170901->EditValue = ew_HtmlEncode($this->f20170901->CurrentValue);
			$this->f20170901->PlaceHolder = ew_RemoveHtml($this->f20170901->FldCaption());

			// f20170902
			$this->f20170902->EditAttrs["class"] = "form-control";
			$this->f20170902->EditCustomAttributes = "";
			$this->f20170902->EditValue = ew_HtmlEncode($this->f20170902->CurrentValue);
			$this->f20170902->PlaceHolder = ew_RemoveHtml($this->f20170902->FldCaption());

			// f20170903
			$this->f20170903->EditAttrs["class"] = "form-control";
			$this->f20170903->EditCustomAttributes = "";
			$this->f20170903->EditValue = ew_HtmlEncode($this->f20170903->CurrentValue);
			$this->f20170903->PlaceHolder = ew_RemoveHtml($this->f20170903->FldCaption());

			// f20170904
			$this->f20170904->EditAttrs["class"] = "form-control";
			$this->f20170904->EditCustomAttributes = "";
			$this->f20170904->EditValue = ew_HtmlEncode($this->f20170904->CurrentValue);
			$this->f20170904->PlaceHolder = ew_RemoveHtml($this->f20170904->FldCaption());

			// f20170905
			$this->f20170905->EditAttrs["class"] = "form-control";
			$this->f20170905->EditCustomAttributes = "";
			$this->f20170905->EditValue = ew_HtmlEncode($this->f20170905->CurrentValue);
			$this->f20170905->PlaceHolder = ew_RemoveHtml($this->f20170905->FldCaption());

			// f20170906
			$this->f20170906->EditAttrs["class"] = "form-control";
			$this->f20170906->EditCustomAttributes = "";
			$this->f20170906->EditValue = ew_HtmlEncode($this->f20170906->CurrentValue);
			$this->f20170906->PlaceHolder = ew_RemoveHtml($this->f20170906->FldCaption());

			// f20170907
			$this->f20170907->EditAttrs["class"] = "form-control";
			$this->f20170907->EditCustomAttributes = "";
			$this->f20170907->EditValue = ew_HtmlEncode($this->f20170907->CurrentValue);
			$this->f20170907->PlaceHolder = ew_RemoveHtml($this->f20170907->FldCaption());

			// f20170908
			$this->f20170908->EditAttrs["class"] = "form-control";
			$this->f20170908->EditCustomAttributes = "";
			$this->f20170908->EditValue = ew_HtmlEncode($this->f20170908->CurrentValue);
			$this->f20170908->PlaceHolder = ew_RemoveHtml($this->f20170908->FldCaption());

			// f20170909
			$this->f20170909->EditAttrs["class"] = "form-control";
			$this->f20170909->EditCustomAttributes = "";
			$this->f20170909->EditValue = ew_HtmlEncode($this->f20170909->CurrentValue);
			$this->f20170909->PlaceHolder = ew_RemoveHtml($this->f20170909->FldCaption());

			// f20170910
			$this->f20170910->EditAttrs["class"] = "form-control";
			$this->f20170910->EditCustomAttributes = "";
			$this->f20170910->EditValue = ew_HtmlEncode($this->f20170910->CurrentValue);
			$this->f20170910->PlaceHolder = ew_RemoveHtml($this->f20170910->FldCaption());

			// f20170911
			$this->f20170911->EditAttrs["class"] = "form-control";
			$this->f20170911->EditCustomAttributes = "";
			$this->f20170911->EditValue = ew_HtmlEncode($this->f20170911->CurrentValue);
			$this->f20170911->PlaceHolder = ew_RemoveHtml($this->f20170911->FldCaption());

			// f20170912
			$this->f20170912->EditAttrs["class"] = "form-control";
			$this->f20170912->EditCustomAttributes = "";
			$this->f20170912->EditValue = ew_HtmlEncode($this->f20170912->CurrentValue);
			$this->f20170912->PlaceHolder = ew_RemoveHtml($this->f20170912->FldCaption());

			// f20170913
			$this->f20170913->EditAttrs["class"] = "form-control";
			$this->f20170913->EditCustomAttributes = "";
			$this->f20170913->EditValue = ew_HtmlEncode($this->f20170913->CurrentValue);
			$this->f20170913->PlaceHolder = ew_RemoveHtml($this->f20170913->FldCaption());

			// f20170914
			$this->f20170914->EditAttrs["class"] = "form-control";
			$this->f20170914->EditCustomAttributes = "";
			$this->f20170914->EditValue = ew_HtmlEncode($this->f20170914->CurrentValue);
			$this->f20170914->PlaceHolder = ew_RemoveHtml($this->f20170914->FldCaption());

			// f20170915
			$this->f20170915->EditAttrs["class"] = "form-control";
			$this->f20170915->EditCustomAttributes = "";
			$this->f20170915->EditValue = ew_HtmlEncode($this->f20170915->CurrentValue);
			$this->f20170915->PlaceHolder = ew_RemoveHtml($this->f20170915->FldCaption());

			// f20170916
			$this->f20170916->EditAttrs["class"] = "form-control";
			$this->f20170916->EditCustomAttributes = "";
			$this->f20170916->EditValue = ew_HtmlEncode($this->f20170916->CurrentValue);
			$this->f20170916->PlaceHolder = ew_RemoveHtml($this->f20170916->FldCaption());

			// f20170917
			$this->f20170917->EditAttrs["class"] = "form-control";
			$this->f20170917->EditCustomAttributes = "";
			$this->f20170917->EditValue = ew_HtmlEncode($this->f20170917->CurrentValue);
			$this->f20170917->PlaceHolder = ew_RemoveHtml($this->f20170917->FldCaption());

			// f20170918
			$this->f20170918->EditAttrs["class"] = "form-control";
			$this->f20170918->EditCustomAttributes = "";
			$this->f20170918->EditValue = ew_HtmlEncode($this->f20170918->CurrentValue);
			$this->f20170918->PlaceHolder = ew_RemoveHtml($this->f20170918->FldCaption());

			// f20170919
			$this->f20170919->EditAttrs["class"] = "form-control";
			$this->f20170919->EditCustomAttributes = "";
			$this->f20170919->EditValue = ew_HtmlEncode($this->f20170919->CurrentValue);
			$this->f20170919->PlaceHolder = ew_RemoveHtml($this->f20170919->FldCaption());

			// f20170920
			$this->f20170920->EditAttrs["class"] = "form-control";
			$this->f20170920->EditCustomAttributes = "";
			$this->f20170920->EditValue = ew_HtmlEncode($this->f20170920->CurrentValue);
			$this->f20170920->PlaceHolder = ew_RemoveHtml($this->f20170920->FldCaption());

			// f20170921
			$this->f20170921->EditAttrs["class"] = "form-control";
			$this->f20170921->EditCustomAttributes = "";
			$this->f20170921->EditValue = ew_HtmlEncode($this->f20170921->CurrentValue);
			$this->f20170921->PlaceHolder = ew_RemoveHtml($this->f20170921->FldCaption());

			// f20170922
			$this->f20170922->EditAttrs["class"] = "form-control";
			$this->f20170922->EditCustomAttributes = "";
			$this->f20170922->EditValue = ew_HtmlEncode($this->f20170922->CurrentValue);
			$this->f20170922->PlaceHolder = ew_RemoveHtml($this->f20170922->FldCaption());

			// f20170923
			$this->f20170923->EditAttrs["class"] = "form-control";
			$this->f20170923->EditCustomAttributes = "";
			$this->f20170923->EditValue = ew_HtmlEncode($this->f20170923->CurrentValue);
			$this->f20170923->PlaceHolder = ew_RemoveHtml($this->f20170923->FldCaption());

			// f20170924
			$this->f20170924->EditAttrs["class"] = "form-control";
			$this->f20170924->EditCustomAttributes = "";
			$this->f20170924->EditValue = ew_HtmlEncode($this->f20170924->CurrentValue);
			$this->f20170924->PlaceHolder = ew_RemoveHtml($this->f20170924->FldCaption());

			// f20170925
			$this->f20170925->EditAttrs["class"] = "form-control";
			$this->f20170925->EditCustomAttributes = "";
			$this->f20170925->EditValue = ew_HtmlEncode($this->f20170925->CurrentValue);
			$this->f20170925->PlaceHolder = ew_RemoveHtml($this->f20170925->FldCaption());

			// f20170926
			$this->f20170926->EditAttrs["class"] = "form-control";
			$this->f20170926->EditCustomAttributes = "";
			$this->f20170926->EditValue = ew_HtmlEncode($this->f20170926->CurrentValue);
			$this->f20170926->PlaceHolder = ew_RemoveHtml($this->f20170926->FldCaption());

			// f20170927
			$this->f20170927->EditAttrs["class"] = "form-control";
			$this->f20170927->EditCustomAttributes = "";
			$this->f20170927->EditValue = ew_HtmlEncode($this->f20170927->CurrentValue);
			$this->f20170927->PlaceHolder = ew_RemoveHtml($this->f20170927->FldCaption());

			// f20170928
			$this->f20170928->EditAttrs["class"] = "form-control";
			$this->f20170928->EditCustomAttributes = "";
			$this->f20170928->EditValue = ew_HtmlEncode($this->f20170928->CurrentValue);
			$this->f20170928->PlaceHolder = ew_RemoveHtml($this->f20170928->FldCaption());

			// f20170929
			$this->f20170929->EditAttrs["class"] = "form-control";
			$this->f20170929->EditCustomAttributes = "";
			$this->f20170929->EditValue = ew_HtmlEncode($this->f20170929->CurrentValue);
			$this->f20170929->PlaceHolder = ew_RemoveHtml($this->f20170929->FldCaption());

			// f20170930
			$this->f20170930->EditAttrs["class"] = "form-control";
			$this->f20170930->EditCustomAttributes = "";
			$this->f20170930->EditValue = ew_HtmlEncode($this->f20170930->CurrentValue);
			$this->f20170930->PlaceHolder = ew_RemoveHtml($this->f20170930->FldCaption());

			// f20171001
			$this->f20171001->EditAttrs["class"] = "form-control";
			$this->f20171001->EditCustomAttributes = "";
			$this->f20171001->EditValue = ew_HtmlEncode($this->f20171001->CurrentValue);
			$this->f20171001->PlaceHolder = ew_RemoveHtml($this->f20171001->FldCaption());

			// f20171002
			$this->f20171002->EditAttrs["class"] = "form-control";
			$this->f20171002->EditCustomAttributes = "";
			$this->f20171002->EditValue = ew_HtmlEncode($this->f20171002->CurrentValue);
			$this->f20171002->PlaceHolder = ew_RemoveHtml($this->f20171002->FldCaption());

			// f20171003
			$this->f20171003->EditAttrs["class"] = "form-control";
			$this->f20171003->EditCustomAttributes = "";
			$this->f20171003->EditValue = ew_HtmlEncode($this->f20171003->CurrentValue);
			$this->f20171003->PlaceHolder = ew_RemoveHtml($this->f20171003->FldCaption());

			// f20171004
			$this->f20171004->EditAttrs["class"] = "form-control";
			$this->f20171004->EditCustomAttributes = "";
			$this->f20171004->EditValue = ew_HtmlEncode($this->f20171004->CurrentValue);
			$this->f20171004->PlaceHolder = ew_RemoveHtml($this->f20171004->FldCaption());

			// f20171005
			$this->f20171005->EditAttrs["class"] = "form-control";
			$this->f20171005->EditCustomAttributes = "";
			$this->f20171005->EditValue = ew_HtmlEncode($this->f20171005->CurrentValue);
			$this->f20171005->PlaceHolder = ew_RemoveHtml($this->f20171005->FldCaption());

			// f20171006
			$this->f20171006->EditAttrs["class"] = "form-control";
			$this->f20171006->EditCustomAttributes = "";
			$this->f20171006->EditValue = ew_HtmlEncode($this->f20171006->CurrentValue);
			$this->f20171006->PlaceHolder = ew_RemoveHtml($this->f20171006->FldCaption());

			// f20171007
			$this->f20171007->EditAttrs["class"] = "form-control";
			$this->f20171007->EditCustomAttributes = "";
			$this->f20171007->EditValue = ew_HtmlEncode($this->f20171007->CurrentValue);
			$this->f20171007->PlaceHolder = ew_RemoveHtml($this->f20171007->FldCaption());

			// f20171008
			$this->f20171008->EditAttrs["class"] = "form-control";
			$this->f20171008->EditCustomAttributes = "";
			$this->f20171008->EditValue = ew_HtmlEncode($this->f20171008->CurrentValue);
			$this->f20171008->PlaceHolder = ew_RemoveHtml($this->f20171008->FldCaption());

			// f20171009
			$this->f20171009->EditAttrs["class"] = "form-control";
			$this->f20171009->EditCustomAttributes = "";
			$this->f20171009->EditValue = ew_HtmlEncode($this->f20171009->CurrentValue);
			$this->f20171009->PlaceHolder = ew_RemoveHtml($this->f20171009->FldCaption());

			// f20171010
			$this->f20171010->EditAttrs["class"] = "form-control";
			$this->f20171010->EditCustomAttributes = "";
			$this->f20171010->EditValue = ew_HtmlEncode($this->f20171010->CurrentValue);
			$this->f20171010->PlaceHolder = ew_RemoveHtml($this->f20171010->FldCaption());

			// f20171011
			$this->f20171011->EditAttrs["class"] = "form-control";
			$this->f20171011->EditCustomAttributes = "";
			$this->f20171011->EditValue = ew_HtmlEncode($this->f20171011->CurrentValue);
			$this->f20171011->PlaceHolder = ew_RemoveHtml($this->f20171011->FldCaption());

			// f20171012
			$this->f20171012->EditAttrs["class"] = "form-control";
			$this->f20171012->EditCustomAttributes = "";
			$this->f20171012->EditValue = ew_HtmlEncode($this->f20171012->CurrentValue);
			$this->f20171012->PlaceHolder = ew_RemoveHtml($this->f20171012->FldCaption());

			// f20171013
			$this->f20171013->EditAttrs["class"] = "form-control";
			$this->f20171013->EditCustomAttributes = "";
			$this->f20171013->EditValue = ew_HtmlEncode($this->f20171013->CurrentValue);
			$this->f20171013->PlaceHolder = ew_RemoveHtml($this->f20171013->FldCaption());

			// f20171014
			$this->f20171014->EditAttrs["class"] = "form-control";
			$this->f20171014->EditCustomAttributes = "";
			$this->f20171014->EditValue = ew_HtmlEncode($this->f20171014->CurrentValue);
			$this->f20171014->PlaceHolder = ew_RemoveHtml($this->f20171014->FldCaption());

			// f20171015
			$this->f20171015->EditAttrs["class"] = "form-control";
			$this->f20171015->EditCustomAttributes = "";
			$this->f20171015->EditValue = ew_HtmlEncode($this->f20171015->CurrentValue);
			$this->f20171015->PlaceHolder = ew_RemoveHtml($this->f20171015->FldCaption());

			// f20171016
			$this->f20171016->EditAttrs["class"] = "form-control";
			$this->f20171016->EditCustomAttributes = "";
			$this->f20171016->EditValue = ew_HtmlEncode($this->f20171016->CurrentValue);
			$this->f20171016->PlaceHolder = ew_RemoveHtml($this->f20171016->FldCaption());

			// f20171017
			$this->f20171017->EditAttrs["class"] = "form-control";
			$this->f20171017->EditCustomAttributes = "";
			$this->f20171017->EditValue = ew_HtmlEncode($this->f20171017->CurrentValue);
			$this->f20171017->PlaceHolder = ew_RemoveHtml($this->f20171017->FldCaption());

			// f20171018
			$this->f20171018->EditAttrs["class"] = "form-control";
			$this->f20171018->EditCustomAttributes = "";
			$this->f20171018->EditValue = ew_HtmlEncode($this->f20171018->CurrentValue);
			$this->f20171018->PlaceHolder = ew_RemoveHtml($this->f20171018->FldCaption());

			// f20171019
			$this->f20171019->EditAttrs["class"] = "form-control";
			$this->f20171019->EditCustomAttributes = "";
			$this->f20171019->EditValue = ew_HtmlEncode($this->f20171019->CurrentValue);
			$this->f20171019->PlaceHolder = ew_RemoveHtml($this->f20171019->FldCaption());

			// f20171020
			$this->f20171020->EditAttrs["class"] = "form-control";
			$this->f20171020->EditCustomAttributes = "";
			$this->f20171020->EditValue = ew_HtmlEncode($this->f20171020->CurrentValue);
			$this->f20171020->PlaceHolder = ew_RemoveHtml($this->f20171020->FldCaption());

			// f20171021
			$this->f20171021->EditAttrs["class"] = "form-control";
			$this->f20171021->EditCustomAttributes = "";
			$this->f20171021->EditValue = ew_HtmlEncode($this->f20171021->CurrentValue);
			$this->f20171021->PlaceHolder = ew_RemoveHtml($this->f20171021->FldCaption());

			// f20171022
			$this->f20171022->EditAttrs["class"] = "form-control";
			$this->f20171022->EditCustomAttributes = "";
			$this->f20171022->EditValue = ew_HtmlEncode($this->f20171022->CurrentValue);
			$this->f20171022->PlaceHolder = ew_RemoveHtml($this->f20171022->FldCaption());

			// f20171023
			$this->f20171023->EditAttrs["class"] = "form-control";
			$this->f20171023->EditCustomAttributes = "";
			$this->f20171023->EditValue = ew_HtmlEncode($this->f20171023->CurrentValue);
			$this->f20171023->PlaceHolder = ew_RemoveHtml($this->f20171023->FldCaption());

			// f20171024
			$this->f20171024->EditAttrs["class"] = "form-control";
			$this->f20171024->EditCustomAttributes = "";
			$this->f20171024->EditValue = ew_HtmlEncode($this->f20171024->CurrentValue);
			$this->f20171024->PlaceHolder = ew_RemoveHtml($this->f20171024->FldCaption());

			// f20171025
			$this->f20171025->EditAttrs["class"] = "form-control";
			$this->f20171025->EditCustomAttributes = "";
			$this->f20171025->EditValue = ew_HtmlEncode($this->f20171025->CurrentValue);
			$this->f20171025->PlaceHolder = ew_RemoveHtml($this->f20171025->FldCaption());

			// f20171026
			$this->f20171026->EditAttrs["class"] = "form-control";
			$this->f20171026->EditCustomAttributes = "";
			$this->f20171026->EditValue = ew_HtmlEncode($this->f20171026->CurrentValue);
			$this->f20171026->PlaceHolder = ew_RemoveHtml($this->f20171026->FldCaption());

			// f20171027
			$this->f20171027->EditAttrs["class"] = "form-control";
			$this->f20171027->EditCustomAttributes = "";
			$this->f20171027->EditValue = ew_HtmlEncode($this->f20171027->CurrentValue);
			$this->f20171027->PlaceHolder = ew_RemoveHtml($this->f20171027->FldCaption());

			// f20171028
			$this->f20171028->EditAttrs["class"] = "form-control";
			$this->f20171028->EditCustomAttributes = "";
			$this->f20171028->EditValue = ew_HtmlEncode($this->f20171028->CurrentValue);
			$this->f20171028->PlaceHolder = ew_RemoveHtml($this->f20171028->FldCaption());

			// f20171029
			$this->f20171029->EditAttrs["class"] = "form-control";
			$this->f20171029->EditCustomAttributes = "";
			$this->f20171029->EditValue = ew_HtmlEncode($this->f20171029->CurrentValue);
			$this->f20171029->PlaceHolder = ew_RemoveHtml($this->f20171029->FldCaption());

			// f20171030
			$this->f20171030->EditAttrs["class"] = "form-control";
			$this->f20171030->EditCustomAttributes = "";
			$this->f20171030->EditValue = ew_HtmlEncode($this->f20171030->CurrentValue);
			$this->f20171030->PlaceHolder = ew_RemoveHtml($this->f20171030->FldCaption());

			// f20171031
			$this->f20171031->EditAttrs["class"] = "form-control";
			$this->f20171031->EditCustomAttributes = "";
			$this->f20171031->EditValue = ew_HtmlEncode($this->f20171031->CurrentValue);
			$this->f20171031->PlaceHolder = ew_RemoveHtml($this->f20171031->FldCaption());

			// f20171101
			$this->f20171101->EditAttrs["class"] = "form-control";
			$this->f20171101->EditCustomAttributes = "";
			$this->f20171101->EditValue = ew_HtmlEncode($this->f20171101->CurrentValue);
			$this->f20171101->PlaceHolder = ew_RemoveHtml($this->f20171101->FldCaption());

			// f20171102
			$this->f20171102->EditAttrs["class"] = "form-control";
			$this->f20171102->EditCustomAttributes = "";
			$this->f20171102->EditValue = ew_HtmlEncode($this->f20171102->CurrentValue);
			$this->f20171102->PlaceHolder = ew_RemoveHtml($this->f20171102->FldCaption());

			// f20171103
			$this->f20171103->EditAttrs["class"] = "form-control";
			$this->f20171103->EditCustomAttributes = "";
			$this->f20171103->EditValue = ew_HtmlEncode($this->f20171103->CurrentValue);
			$this->f20171103->PlaceHolder = ew_RemoveHtml($this->f20171103->FldCaption());

			// f20171104
			$this->f20171104->EditAttrs["class"] = "form-control";
			$this->f20171104->EditCustomAttributes = "";
			$this->f20171104->EditValue = ew_HtmlEncode($this->f20171104->CurrentValue);
			$this->f20171104->PlaceHolder = ew_RemoveHtml($this->f20171104->FldCaption());

			// f20171105
			$this->f20171105->EditAttrs["class"] = "form-control";
			$this->f20171105->EditCustomAttributes = "";
			$this->f20171105->EditValue = ew_HtmlEncode($this->f20171105->CurrentValue);
			$this->f20171105->PlaceHolder = ew_RemoveHtml($this->f20171105->FldCaption());

			// f20171106
			$this->f20171106->EditAttrs["class"] = "form-control";
			$this->f20171106->EditCustomAttributes = "";
			$this->f20171106->EditValue = ew_HtmlEncode($this->f20171106->CurrentValue);
			$this->f20171106->PlaceHolder = ew_RemoveHtml($this->f20171106->FldCaption());

			// f20171107
			$this->f20171107->EditAttrs["class"] = "form-control";
			$this->f20171107->EditCustomAttributes = "";
			$this->f20171107->EditValue = ew_HtmlEncode($this->f20171107->CurrentValue);
			$this->f20171107->PlaceHolder = ew_RemoveHtml($this->f20171107->FldCaption());

			// f20171108
			$this->f20171108->EditAttrs["class"] = "form-control";
			$this->f20171108->EditCustomAttributes = "";
			$this->f20171108->EditValue = ew_HtmlEncode($this->f20171108->CurrentValue);
			$this->f20171108->PlaceHolder = ew_RemoveHtml($this->f20171108->FldCaption());

			// f20171109
			$this->f20171109->EditAttrs["class"] = "form-control";
			$this->f20171109->EditCustomAttributes = "";
			$this->f20171109->EditValue = ew_HtmlEncode($this->f20171109->CurrentValue);
			$this->f20171109->PlaceHolder = ew_RemoveHtml($this->f20171109->FldCaption());

			// f20171110
			$this->f20171110->EditAttrs["class"] = "form-control";
			$this->f20171110->EditCustomAttributes = "";
			$this->f20171110->EditValue = ew_HtmlEncode($this->f20171110->CurrentValue);
			$this->f20171110->PlaceHolder = ew_RemoveHtml($this->f20171110->FldCaption());

			// f20171111
			$this->f20171111->EditAttrs["class"] = "form-control";
			$this->f20171111->EditCustomAttributes = "";
			$this->f20171111->EditValue = ew_HtmlEncode($this->f20171111->CurrentValue);
			$this->f20171111->PlaceHolder = ew_RemoveHtml($this->f20171111->FldCaption());

			// f20171112
			$this->f20171112->EditAttrs["class"] = "form-control";
			$this->f20171112->EditCustomAttributes = "";
			$this->f20171112->EditValue = ew_HtmlEncode($this->f20171112->CurrentValue);
			$this->f20171112->PlaceHolder = ew_RemoveHtml($this->f20171112->FldCaption());

			// f20171113
			$this->f20171113->EditAttrs["class"] = "form-control";
			$this->f20171113->EditCustomAttributes = "";
			$this->f20171113->EditValue = ew_HtmlEncode($this->f20171113->CurrentValue);
			$this->f20171113->PlaceHolder = ew_RemoveHtml($this->f20171113->FldCaption());

			// f20171114
			$this->f20171114->EditAttrs["class"] = "form-control";
			$this->f20171114->EditCustomAttributes = "";
			$this->f20171114->EditValue = ew_HtmlEncode($this->f20171114->CurrentValue);
			$this->f20171114->PlaceHolder = ew_RemoveHtml($this->f20171114->FldCaption());

			// f20171115
			$this->f20171115->EditAttrs["class"] = "form-control";
			$this->f20171115->EditCustomAttributes = "";
			$this->f20171115->EditValue = ew_HtmlEncode($this->f20171115->CurrentValue);
			$this->f20171115->PlaceHolder = ew_RemoveHtml($this->f20171115->FldCaption());

			// f20171116
			$this->f20171116->EditAttrs["class"] = "form-control";
			$this->f20171116->EditCustomAttributes = "";
			$this->f20171116->EditValue = ew_HtmlEncode($this->f20171116->CurrentValue);
			$this->f20171116->PlaceHolder = ew_RemoveHtml($this->f20171116->FldCaption());

			// f20171117
			$this->f20171117->EditAttrs["class"] = "form-control";
			$this->f20171117->EditCustomAttributes = "";
			$this->f20171117->EditValue = ew_HtmlEncode($this->f20171117->CurrentValue);
			$this->f20171117->PlaceHolder = ew_RemoveHtml($this->f20171117->FldCaption());

			// f20171118
			$this->f20171118->EditAttrs["class"] = "form-control";
			$this->f20171118->EditCustomAttributes = "";
			$this->f20171118->EditValue = ew_HtmlEncode($this->f20171118->CurrentValue);
			$this->f20171118->PlaceHolder = ew_RemoveHtml($this->f20171118->FldCaption());

			// f20171119
			$this->f20171119->EditAttrs["class"] = "form-control";
			$this->f20171119->EditCustomAttributes = "";
			$this->f20171119->EditValue = ew_HtmlEncode($this->f20171119->CurrentValue);
			$this->f20171119->PlaceHolder = ew_RemoveHtml($this->f20171119->FldCaption());

			// f20171120
			$this->f20171120->EditAttrs["class"] = "form-control";
			$this->f20171120->EditCustomAttributes = "";
			$this->f20171120->EditValue = ew_HtmlEncode($this->f20171120->CurrentValue);
			$this->f20171120->PlaceHolder = ew_RemoveHtml($this->f20171120->FldCaption());

			// f20171121
			$this->f20171121->EditAttrs["class"] = "form-control";
			$this->f20171121->EditCustomAttributes = "";
			$this->f20171121->EditValue = ew_HtmlEncode($this->f20171121->CurrentValue);
			$this->f20171121->PlaceHolder = ew_RemoveHtml($this->f20171121->FldCaption());

			// f20171122
			$this->f20171122->EditAttrs["class"] = "form-control";
			$this->f20171122->EditCustomAttributes = "";
			$this->f20171122->EditValue = ew_HtmlEncode($this->f20171122->CurrentValue);
			$this->f20171122->PlaceHolder = ew_RemoveHtml($this->f20171122->FldCaption());

			// f20171123
			$this->f20171123->EditAttrs["class"] = "form-control";
			$this->f20171123->EditCustomAttributes = "";
			$this->f20171123->EditValue = ew_HtmlEncode($this->f20171123->CurrentValue);
			$this->f20171123->PlaceHolder = ew_RemoveHtml($this->f20171123->FldCaption());

			// f20171124
			$this->f20171124->EditAttrs["class"] = "form-control";
			$this->f20171124->EditCustomAttributes = "";
			$this->f20171124->EditValue = ew_HtmlEncode($this->f20171124->CurrentValue);
			$this->f20171124->PlaceHolder = ew_RemoveHtml($this->f20171124->FldCaption());

			// f20171125
			$this->f20171125->EditAttrs["class"] = "form-control";
			$this->f20171125->EditCustomAttributes = "";
			$this->f20171125->EditValue = ew_HtmlEncode($this->f20171125->CurrentValue);
			$this->f20171125->PlaceHolder = ew_RemoveHtml($this->f20171125->FldCaption());

			// f20171126
			$this->f20171126->EditAttrs["class"] = "form-control";
			$this->f20171126->EditCustomAttributes = "";
			$this->f20171126->EditValue = ew_HtmlEncode($this->f20171126->CurrentValue);
			$this->f20171126->PlaceHolder = ew_RemoveHtml($this->f20171126->FldCaption());

			// f20171127
			$this->f20171127->EditAttrs["class"] = "form-control";
			$this->f20171127->EditCustomAttributes = "";
			$this->f20171127->EditValue = ew_HtmlEncode($this->f20171127->CurrentValue);
			$this->f20171127->PlaceHolder = ew_RemoveHtml($this->f20171127->FldCaption());

			// f20171128
			$this->f20171128->EditAttrs["class"] = "form-control";
			$this->f20171128->EditCustomAttributes = "";
			$this->f20171128->EditValue = ew_HtmlEncode($this->f20171128->CurrentValue);
			$this->f20171128->PlaceHolder = ew_RemoveHtml($this->f20171128->FldCaption());

			// f20171129
			$this->f20171129->EditAttrs["class"] = "form-control";
			$this->f20171129->EditCustomAttributes = "";
			$this->f20171129->EditValue = ew_HtmlEncode($this->f20171129->CurrentValue);
			$this->f20171129->PlaceHolder = ew_RemoveHtml($this->f20171129->FldCaption());

			// f20171130
			$this->f20171130->EditAttrs["class"] = "form-control";
			$this->f20171130->EditCustomAttributes = "";
			$this->f20171130->EditValue = ew_HtmlEncode($this->f20171130->CurrentValue);
			$this->f20171130->PlaceHolder = ew_RemoveHtml($this->f20171130->FldCaption());

			// f20171201
			$this->f20171201->EditAttrs["class"] = "form-control";
			$this->f20171201->EditCustomAttributes = "";
			$this->f20171201->EditValue = ew_HtmlEncode($this->f20171201->CurrentValue);
			$this->f20171201->PlaceHolder = ew_RemoveHtml($this->f20171201->FldCaption());

			// f20171202
			$this->f20171202->EditAttrs["class"] = "form-control";
			$this->f20171202->EditCustomAttributes = "";
			$this->f20171202->EditValue = ew_HtmlEncode($this->f20171202->CurrentValue);
			$this->f20171202->PlaceHolder = ew_RemoveHtml($this->f20171202->FldCaption());

			// f20171203
			$this->f20171203->EditAttrs["class"] = "form-control";
			$this->f20171203->EditCustomAttributes = "";
			$this->f20171203->EditValue = ew_HtmlEncode($this->f20171203->CurrentValue);
			$this->f20171203->PlaceHolder = ew_RemoveHtml($this->f20171203->FldCaption());

			// f20171204
			$this->f20171204->EditAttrs["class"] = "form-control";
			$this->f20171204->EditCustomAttributes = "";
			$this->f20171204->EditValue = ew_HtmlEncode($this->f20171204->CurrentValue);
			$this->f20171204->PlaceHolder = ew_RemoveHtml($this->f20171204->FldCaption());

			// f20171205
			$this->f20171205->EditAttrs["class"] = "form-control";
			$this->f20171205->EditCustomAttributes = "";
			$this->f20171205->EditValue = ew_HtmlEncode($this->f20171205->CurrentValue);
			$this->f20171205->PlaceHolder = ew_RemoveHtml($this->f20171205->FldCaption());

			// f20171206
			$this->f20171206->EditAttrs["class"] = "form-control";
			$this->f20171206->EditCustomAttributes = "";
			$this->f20171206->EditValue = ew_HtmlEncode($this->f20171206->CurrentValue);
			$this->f20171206->PlaceHolder = ew_RemoveHtml($this->f20171206->FldCaption());

			// f20171207
			$this->f20171207->EditAttrs["class"] = "form-control";
			$this->f20171207->EditCustomAttributes = "";
			$this->f20171207->EditValue = ew_HtmlEncode($this->f20171207->CurrentValue);
			$this->f20171207->PlaceHolder = ew_RemoveHtml($this->f20171207->FldCaption());

			// f20171208
			$this->f20171208->EditAttrs["class"] = "form-control";
			$this->f20171208->EditCustomAttributes = "";
			$this->f20171208->EditValue = ew_HtmlEncode($this->f20171208->CurrentValue);
			$this->f20171208->PlaceHolder = ew_RemoveHtml($this->f20171208->FldCaption());

			// f20171209
			$this->f20171209->EditAttrs["class"] = "form-control";
			$this->f20171209->EditCustomAttributes = "";
			$this->f20171209->EditValue = ew_HtmlEncode($this->f20171209->CurrentValue);
			$this->f20171209->PlaceHolder = ew_RemoveHtml($this->f20171209->FldCaption());

			// f20171210
			$this->f20171210->EditAttrs["class"] = "form-control";
			$this->f20171210->EditCustomAttributes = "";
			$this->f20171210->EditValue = ew_HtmlEncode($this->f20171210->CurrentValue);
			$this->f20171210->PlaceHolder = ew_RemoveHtml($this->f20171210->FldCaption());

			// f20171211
			$this->f20171211->EditAttrs["class"] = "form-control";
			$this->f20171211->EditCustomAttributes = "";
			$this->f20171211->EditValue = ew_HtmlEncode($this->f20171211->CurrentValue);
			$this->f20171211->PlaceHolder = ew_RemoveHtml($this->f20171211->FldCaption());

			// f20171212
			$this->f20171212->EditAttrs["class"] = "form-control";
			$this->f20171212->EditCustomAttributes = "";
			$this->f20171212->EditValue = ew_HtmlEncode($this->f20171212->CurrentValue);
			$this->f20171212->PlaceHolder = ew_RemoveHtml($this->f20171212->FldCaption());

			// f20171213
			$this->f20171213->EditAttrs["class"] = "form-control";
			$this->f20171213->EditCustomAttributes = "";
			$this->f20171213->EditValue = ew_HtmlEncode($this->f20171213->CurrentValue);
			$this->f20171213->PlaceHolder = ew_RemoveHtml($this->f20171213->FldCaption());

			// f20171214
			$this->f20171214->EditAttrs["class"] = "form-control";
			$this->f20171214->EditCustomAttributes = "";
			$this->f20171214->EditValue = ew_HtmlEncode($this->f20171214->CurrentValue);
			$this->f20171214->PlaceHolder = ew_RemoveHtml($this->f20171214->FldCaption());

			// f20171215
			$this->f20171215->EditAttrs["class"] = "form-control";
			$this->f20171215->EditCustomAttributes = "";
			$this->f20171215->EditValue = ew_HtmlEncode($this->f20171215->CurrentValue);
			$this->f20171215->PlaceHolder = ew_RemoveHtml($this->f20171215->FldCaption());

			// f20171216
			$this->f20171216->EditAttrs["class"] = "form-control";
			$this->f20171216->EditCustomAttributes = "";
			$this->f20171216->EditValue = ew_HtmlEncode($this->f20171216->CurrentValue);
			$this->f20171216->PlaceHolder = ew_RemoveHtml($this->f20171216->FldCaption());

			// f20171217
			$this->f20171217->EditAttrs["class"] = "form-control";
			$this->f20171217->EditCustomAttributes = "";
			$this->f20171217->EditValue = ew_HtmlEncode($this->f20171217->CurrentValue);
			$this->f20171217->PlaceHolder = ew_RemoveHtml($this->f20171217->FldCaption());

			// f20171218
			$this->f20171218->EditAttrs["class"] = "form-control";
			$this->f20171218->EditCustomAttributes = "";
			$this->f20171218->EditValue = ew_HtmlEncode($this->f20171218->CurrentValue);
			$this->f20171218->PlaceHolder = ew_RemoveHtml($this->f20171218->FldCaption());

			// f20171219
			$this->f20171219->EditAttrs["class"] = "form-control";
			$this->f20171219->EditCustomAttributes = "";
			$this->f20171219->EditValue = ew_HtmlEncode($this->f20171219->CurrentValue);
			$this->f20171219->PlaceHolder = ew_RemoveHtml($this->f20171219->FldCaption());

			// f20171220
			$this->f20171220->EditAttrs["class"] = "form-control";
			$this->f20171220->EditCustomAttributes = "";
			$this->f20171220->EditValue = ew_HtmlEncode($this->f20171220->CurrentValue);
			$this->f20171220->PlaceHolder = ew_RemoveHtml($this->f20171220->FldCaption());

			// f20171221
			$this->f20171221->EditAttrs["class"] = "form-control";
			$this->f20171221->EditCustomAttributes = "";
			$this->f20171221->EditValue = ew_HtmlEncode($this->f20171221->CurrentValue);
			$this->f20171221->PlaceHolder = ew_RemoveHtml($this->f20171221->FldCaption());

			// f20171222
			$this->f20171222->EditAttrs["class"] = "form-control";
			$this->f20171222->EditCustomAttributes = "";
			$this->f20171222->EditValue = ew_HtmlEncode($this->f20171222->CurrentValue);
			$this->f20171222->PlaceHolder = ew_RemoveHtml($this->f20171222->FldCaption());

			// f20171223
			$this->f20171223->EditAttrs["class"] = "form-control";
			$this->f20171223->EditCustomAttributes = "";
			$this->f20171223->EditValue = ew_HtmlEncode($this->f20171223->CurrentValue);
			$this->f20171223->PlaceHolder = ew_RemoveHtml($this->f20171223->FldCaption());

			// f20171224
			$this->f20171224->EditAttrs["class"] = "form-control";
			$this->f20171224->EditCustomAttributes = "";
			$this->f20171224->EditValue = ew_HtmlEncode($this->f20171224->CurrentValue);
			$this->f20171224->PlaceHolder = ew_RemoveHtml($this->f20171224->FldCaption());

			// f20171225
			$this->f20171225->EditAttrs["class"] = "form-control";
			$this->f20171225->EditCustomAttributes = "";
			$this->f20171225->EditValue = ew_HtmlEncode($this->f20171225->CurrentValue);
			$this->f20171225->PlaceHolder = ew_RemoveHtml($this->f20171225->FldCaption());

			// f20171226
			$this->f20171226->EditAttrs["class"] = "form-control";
			$this->f20171226->EditCustomAttributes = "";
			$this->f20171226->EditValue = ew_HtmlEncode($this->f20171226->CurrentValue);
			$this->f20171226->PlaceHolder = ew_RemoveHtml($this->f20171226->FldCaption());

			// f20171227
			$this->f20171227->EditAttrs["class"] = "form-control";
			$this->f20171227->EditCustomAttributes = "";
			$this->f20171227->EditValue = ew_HtmlEncode($this->f20171227->CurrentValue);
			$this->f20171227->PlaceHolder = ew_RemoveHtml($this->f20171227->FldCaption());

			// f20171228
			$this->f20171228->EditAttrs["class"] = "form-control";
			$this->f20171228->EditCustomAttributes = "";
			$this->f20171228->EditValue = ew_HtmlEncode($this->f20171228->CurrentValue);
			$this->f20171228->PlaceHolder = ew_RemoveHtml($this->f20171228->FldCaption());

			// f20171229
			$this->f20171229->EditAttrs["class"] = "form-control";
			$this->f20171229->EditCustomAttributes = "";
			$this->f20171229->EditValue = ew_HtmlEncode($this->f20171229->CurrentValue);
			$this->f20171229->PlaceHolder = ew_RemoveHtml($this->f20171229->FldCaption());

			// f20171230
			$this->f20171230->EditAttrs["class"] = "form-control";
			$this->f20171230->EditCustomAttributes = "";
			$this->f20171230->EditValue = ew_HtmlEncode($this->f20171230->CurrentValue);
			$this->f20171230->PlaceHolder = ew_RemoveHtml($this->f20171230->FldCaption());

			// f20171231
			$this->f20171231->EditAttrs["class"] = "form-control";
			$this->f20171231->EditCustomAttributes = "";
			$this->f20171231->EditValue = ew_HtmlEncode($this->f20171231->CurrentValue);
			if (strval($this->f20171231->CurrentValue) <> "") {
				$sFilterWrk = "`jk_id`" . ew_SearchString("=", $this->f20171231->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `jk_id`, `jk_nm` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t_jk`";
			$sWhereWrk = "";
			$this->f20171231->LookupFilters = array("dx1" => '`jk_nm`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->f20171231, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
					$this->f20171231->EditValue = $this->f20171231->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->f20171231->EditValue = ew_HtmlEncode($this->f20171231->CurrentValue);
				}
			} else {
				$this->f20171231->EditValue = NULL;
			}
			$this->f20171231->PlaceHolder = ew_RemoveHtml($this->f20171231->FldCaption());

			// Add refer script
			// pegawai_id

			$this->pegawai_id->LinkCustomAttributes = "";
			$this->pegawai_id->HrefValue = "";

			// f20170101
			$this->f20170101->LinkCustomAttributes = "";
			$this->f20170101->HrefValue = "";

			// f20170102
			$this->f20170102->LinkCustomAttributes = "";
			$this->f20170102->HrefValue = "";

			// f20170103
			$this->f20170103->LinkCustomAttributes = "";
			$this->f20170103->HrefValue = "";

			// f20170104
			$this->f20170104->LinkCustomAttributes = "";
			$this->f20170104->HrefValue = "";

			// f20170105
			$this->f20170105->LinkCustomAttributes = "";
			$this->f20170105->HrefValue = "";

			// f20170106
			$this->f20170106->LinkCustomAttributes = "";
			$this->f20170106->HrefValue = "";

			// f20170107
			$this->f20170107->LinkCustomAttributes = "";
			$this->f20170107->HrefValue = "";

			// f20170108
			$this->f20170108->LinkCustomAttributes = "";
			$this->f20170108->HrefValue = "";

			// f20170109
			$this->f20170109->LinkCustomAttributes = "";
			$this->f20170109->HrefValue = "";

			// f20170110
			$this->f20170110->LinkCustomAttributes = "";
			$this->f20170110->HrefValue = "";

			// f20170111
			$this->f20170111->LinkCustomAttributes = "";
			$this->f20170111->HrefValue = "";

			// f20170112
			$this->f20170112->LinkCustomAttributes = "";
			$this->f20170112->HrefValue = "";

			// f20170113
			$this->f20170113->LinkCustomAttributes = "";
			$this->f20170113->HrefValue = "";

			// f20170114
			$this->f20170114->LinkCustomAttributes = "";
			$this->f20170114->HrefValue = "";

			// f20170115
			$this->f20170115->LinkCustomAttributes = "";
			$this->f20170115->HrefValue = "";

			// f20170116
			$this->f20170116->LinkCustomAttributes = "";
			$this->f20170116->HrefValue = "";

			// f20170117
			$this->f20170117->LinkCustomAttributes = "";
			$this->f20170117->HrefValue = "";

			// f20170118
			$this->f20170118->LinkCustomAttributes = "";
			$this->f20170118->HrefValue = "";

			// f20170119
			$this->f20170119->LinkCustomAttributes = "";
			$this->f20170119->HrefValue = "";

			// f20170120
			$this->f20170120->LinkCustomAttributes = "";
			$this->f20170120->HrefValue = "";

			// f20170121
			$this->f20170121->LinkCustomAttributes = "";
			$this->f20170121->HrefValue = "";

			// f20170122
			$this->f20170122->LinkCustomAttributes = "";
			$this->f20170122->HrefValue = "";

			// f20170123
			$this->f20170123->LinkCustomAttributes = "";
			$this->f20170123->HrefValue = "";

			// f20170124
			$this->f20170124->LinkCustomAttributes = "";
			$this->f20170124->HrefValue = "";

			// f20170125
			$this->f20170125->LinkCustomAttributes = "";
			$this->f20170125->HrefValue = "";

			// f20170126
			$this->f20170126->LinkCustomAttributes = "";
			$this->f20170126->HrefValue = "";

			// f20170127
			$this->f20170127->LinkCustomAttributes = "";
			$this->f20170127->HrefValue = "";

			// f20170128
			$this->f20170128->LinkCustomAttributes = "";
			$this->f20170128->HrefValue = "";

			// f20170129
			$this->f20170129->LinkCustomAttributes = "";
			$this->f20170129->HrefValue = "";

			// f20170130
			$this->f20170130->LinkCustomAttributes = "";
			$this->f20170130->HrefValue = "";

			// f20170131
			$this->f20170131->LinkCustomAttributes = "";
			$this->f20170131->HrefValue = "";

			// f20170201
			$this->f20170201->LinkCustomAttributes = "";
			$this->f20170201->HrefValue = "";

			// f20170202
			$this->f20170202->LinkCustomAttributes = "";
			$this->f20170202->HrefValue = "";

			// f20170203
			$this->f20170203->LinkCustomAttributes = "";
			$this->f20170203->HrefValue = "";

			// f20170204
			$this->f20170204->LinkCustomAttributes = "";
			$this->f20170204->HrefValue = "";

			// f20170205
			$this->f20170205->LinkCustomAttributes = "";
			$this->f20170205->HrefValue = "";

			// f20170206
			$this->f20170206->LinkCustomAttributes = "";
			$this->f20170206->HrefValue = "";

			// f20170207
			$this->f20170207->LinkCustomAttributes = "";
			$this->f20170207->HrefValue = "";

			// f20170208
			$this->f20170208->LinkCustomAttributes = "";
			$this->f20170208->HrefValue = "";

			// f20170209
			$this->f20170209->LinkCustomAttributes = "";
			$this->f20170209->HrefValue = "";

			// f20170210
			$this->f20170210->LinkCustomAttributes = "";
			$this->f20170210->HrefValue = "";

			// f20170211
			$this->f20170211->LinkCustomAttributes = "";
			$this->f20170211->HrefValue = "";

			// f20170212
			$this->f20170212->LinkCustomAttributes = "";
			$this->f20170212->HrefValue = "";

			// f20170213
			$this->f20170213->LinkCustomAttributes = "";
			$this->f20170213->HrefValue = "";

			// f20170214
			$this->f20170214->LinkCustomAttributes = "";
			$this->f20170214->HrefValue = "";

			// f20170215
			$this->f20170215->LinkCustomAttributes = "";
			$this->f20170215->HrefValue = "";

			// f20170216
			$this->f20170216->LinkCustomAttributes = "";
			$this->f20170216->HrefValue = "";

			// f20170217
			$this->f20170217->LinkCustomAttributes = "";
			$this->f20170217->HrefValue = "";

			// f20170218
			$this->f20170218->LinkCustomAttributes = "";
			$this->f20170218->HrefValue = "";

			// f20170219
			$this->f20170219->LinkCustomAttributes = "";
			$this->f20170219->HrefValue = "";

			// f20170220
			$this->f20170220->LinkCustomAttributes = "";
			$this->f20170220->HrefValue = "";

			// f20170221
			$this->f20170221->LinkCustomAttributes = "";
			$this->f20170221->HrefValue = "";

			// f20170222
			$this->f20170222->LinkCustomAttributes = "";
			$this->f20170222->HrefValue = "";

			// f20170223
			$this->f20170223->LinkCustomAttributes = "";
			$this->f20170223->HrefValue = "";

			// f20170224
			$this->f20170224->LinkCustomAttributes = "";
			$this->f20170224->HrefValue = "";

			// f20170225
			$this->f20170225->LinkCustomAttributes = "";
			$this->f20170225->HrefValue = "";

			// f20170226
			$this->f20170226->LinkCustomAttributes = "";
			$this->f20170226->HrefValue = "";

			// f20170227
			$this->f20170227->LinkCustomAttributes = "";
			$this->f20170227->HrefValue = "";

			// f20170228
			$this->f20170228->LinkCustomAttributes = "";
			$this->f20170228->HrefValue = "";

			// f20170229
			$this->f20170229->LinkCustomAttributes = "";
			$this->f20170229->HrefValue = "";

			// f20170301
			$this->f20170301->LinkCustomAttributes = "";
			$this->f20170301->HrefValue = "";

			// f20170302
			$this->f20170302->LinkCustomAttributes = "";
			$this->f20170302->HrefValue = "";

			// f20170303
			$this->f20170303->LinkCustomAttributes = "";
			$this->f20170303->HrefValue = "";

			// f20170304
			$this->f20170304->LinkCustomAttributes = "";
			$this->f20170304->HrefValue = "";

			// f20170305
			$this->f20170305->LinkCustomAttributes = "";
			$this->f20170305->HrefValue = "";

			// f20170306
			$this->f20170306->LinkCustomAttributes = "";
			$this->f20170306->HrefValue = "";

			// f20170307
			$this->f20170307->LinkCustomAttributes = "";
			$this->f20170307->HrefValue = "";

			// f20170308
			$this->f20170308->LinkCustomAttributes = "";
			$this->f20170308->HrefValue = "";

			// f20170309
			$this->f20170309->LinkCustomAttributes = "";
			$this->f20170309->HrefValue = "";

			// f20170310
			$this->f20170310->LinkCustomAttributes = "";
			$this->f20170310->HrefValue = "";

			// f20170311
			$this->f20170311->LinkCustomAttributes = "";
			$this->f20170311->HrefValue = "";

			// f20170312
			$this->f20170312->LinkCustomAttributes = "";
			$this->f20170312->HrefValue = "";

			// f20170313
			$this->f20170313->LinkCustomAttributes = "";
			$this->f20170313->HrefValue = "";

			// f20170314
			$this->f20170314->LinkCustomAttributes = "";
			$this->f20170314->HrefValue = "";

			// f20170315
			$this->f20170315->LinkCustomAttributes = "";
			$this->f20170315->HrefValue = "";

			// f20170316
			$this->f20170316->LinkCustomAttributes = "";
			$this->f20170316->HrefValue = "";

			// f20170317
			$this->f20170317->LinkCustomAttributes = "";
			$this->f20170317->HrefValue = "";

			// f20170318
			$this->f20170318->LinkCustomAttributes = "";
			$this->f20170318->HrefValue = "";

			// f20170319
			$this->f20170319->LinkCustomAttributes = "";
			$this->f20170319->HrefValue = "";

			// f20170320
			$this->f20170320->LinkCustomAttributes = "";
			$this->f20170320->HrefValue = "";

			// f20170321
			$this->f20170321->LinkCustomAttributes = "";
			$this->f20170321->HrefValue = "";

			// f20170322
			$this->f20170322->LinkCustomAttributes = "";
			$this->f20170322->HrefValue = "";

			// f20170323
			$this->f20170323->LinkCustomAttributes = "";
			$this->f20170323->HrefValue = "";

			// f20170324
			$this->f20170324->LinkCustomAttributes = "";
			$this->f20170324->HrefValue = "";

			// f20170325
			$this->f20170325->LinkCustomAttributes = "";
			$this->f20170325->HrefValue = "";

			// f20170326
			$this->f20170326->LinkCustomAttributes = "";
			$this->f20170326->HrefValue = "";

			// f20170327
			$this->f20170327->LinkCustomAttributes = "";
			$this->f20170327->HrefValue = "";

			// f20170328
			$this->f20170328->LinkCustomAttributes = "";
			$this->f20170328->HrefValue = "";

			// f20170329
			$this->f20170329->LinkCustomAttributes = "";
			$this->f20170329->HrefValue = "";

			// f20170330
			$this->f20170330->LinkCustomAttributes = "";
			$this->f20170330->HrefValue = "";

			// f20170331
			$this->f20170331->LinkCustomAttributes = "";
			$this->f20170331->HrefValue = "";

			// f20170401
			$this->f20170401->LinkCustomAttributes = "";
			$this->f20170401->HrefValue = "";

			// f20170402
			$this->f20170402->LinkCustomAttributes = "";
			$this->f20170402->HrefValue = "";

			// f20170403
			$this->f20170403->LinkCustomAttributes = "";
			$this->f20170403->HrefValue = "";

			// f20170404
			$this->f20170404->LinkCustomAttributes = "";
			$this->f20170404->HrefValue = "";

			// f20170405
			$this->f20170405->LinkCustomAttributes = "";
			$this->f20170405->HrefValue = "";

			// f20170406
			$this->f20170406->LinkCustomAttributes = "";
			$this->f20170406->HrefValue = "";

			// f20170407
			$this->f20170407->LinkCustomAttributes = "";
			$this->f20170407->HrefValue = "";

			// f20170408
			$this->f20170408->LinkCustomAttributes = "";
			$this->f20170408->HrefValue = "";

			// f20170409
			$this->f20170409->LinkCustomAttributes = "";
			$this->f20170409->HrefValue = "";

			// f20170410
			$this->f20170410->LinkCustomAttributes = "";
			$this->f20170410->HrefValue = "";

			// f20170411
			$this->f20170411->LinkCustomAttributes = "";
			$this->f20170411->HrefValue = "";

			// f20170412
			$this->f20170412->LinkCustomAttributes = "";
			$this->f20170412->HrefValue = "";

			// f20170413
			$this->f20170413->LinkCustomAttributes = "";
			$this->f20170413->HrefValue = "";

			// f20170414
			$this->f20170414->LinkCustomAttributes = "";
			$this->f20170414->HrefValue = "";

			// f20170415
			$this->f20170415->LinkCustomAttributes = "";
			$this->f20170415->HrefValue = "";

			// f20170416
			$this->f20170416->LinkCustomAttributes = "";
			$this->f20170416->HrefValue = "";

			// f20170417
			$this->f20170417->LinkCustomAttributes = "";
			$this->f20170417->HrefValue = "";

			// f20170418
			$this->f20170418->LinkCustomAttributes = "";
			$this->f20170418->HrefValue = "";

			// f20170419
			$this->f20170419->LinkCustomAttributes = "";
			$this->f20170419->HrefValue = "";

			// f20170420
			$this->f20170420->LinkCustomAttributes = "";
			$this->f20170420->HrefValue = "";

			// f20170421
			$this->f20170421->LinkCustomAttributes = "";
			$this->f20170421->HrefValue = "";

			// f20170422
			$this->f20170422->LinkCustomAttributes = "";
			$this->f20170422->HrefValue = "";

			// f20170423
			$this->f20170423->LinkCustomAttributes = "";
			$this->f20170423->HrefValue = "";

			// f20170424
			$this->f20170424->LinkCustomAttributes = "";
			$this->f20170424->HrefValue = "";

			// f20170425
			$this->f20170425->LinkCustomAttributes = "";
			$this->f20170425->HrefValue = "";

			// f20170426
			$this->f20170426->LinkCustomAttributes = "";
			$this->f20170426->HrefValue = "";

			// f20170427
			$this->f20170427->LinkCustomAttributes = "";
			$this->f20170427->HrefValue = "";

			// f20170428
			$this->f20170428->LinkCustomAttributes = "";
			$this->f20170428->HrefValue = "";

			// f20170429
			$this->f20170429->LinkCustomAttributes = "";
			$this->f20170429->HrefValue = "";

			// f20170430
			$this->f20170430->LinkCustomAttributes = "";
			$this->f20170430->HrefValue = "";

			// f20170501
			$this->f20170501->LinkCustomAttributes = "";
			$this->f20170501->HrefValue = "";

			// f20170502
			$this->f20170502->LinkCustomAttributes = "";
			$this->f20170502->HrefValue = "";

			// f20170503
			$this->f20170503->LinkCustomAttributes = "";
			$this->f20170503->HrefValue = "";

			// f20170504
			$this->f20170504->LinkCustomAttributes = "";
			$this->f20170504->HrefValue = "";

			// f20170505
			$this->f20170505->LinkCustomAttributes = "";
			$this->f20170505->HrefValue = "";

			// f20170506
			$this->f20170506->LinkCustomAttributes = "";
			$this->f20170506->HrefValue = "";

			// f20170507
			$this->f20170507->LinkCustomAttributes = "";
			$this->f20170507->HrefValue = "";

			// f20170508
			$this->f20170508->LinkCustomAttributes = "";
			$this->f20170508->HrefValue = "";

			// f20170509
			$this->f20170509->LinkCustomAttributes = "";
			$this->f20170509->HrefValue = "";

			// f20170510
			$this->f20170510->LinkCustomAttributes = "";
			$this->f20170510->HrefValue = "";

			// f20170511
			$this->f20170511->LinkCustomAttributes = "";
			$this->f20170511->HrefValue = "";

			// f20170512
			$this->f20170512->LinkCustomAttributes = "";
			$this->f20170512->HrefValue = "";

			// f20170513
			$this->f20170513->LinkCustomAttributes = "";
			$this->f20170513->HrefValue = "";

			// f20170514
			$this->f20170514->LinkCustomAttributes = "";
			$this->f20170514->HrefValue = "";

			// f20170515
			$this->f20170515->LinkCustomAttributes = "";
			$this->f20170515->HrefValue = "";

			// f20170516
			$this->f20170516->LinkCustomAttributes = "";
			$this->f20170516->HrefValue = "";

			// f20170517
			$this->f20170517->LinkCustomAttributes = "";
			$this->f20170517->HrefValue = "";

			// f20170518
			$this->f20170518->LinkCustomAttributes = "";
			$this->f20170518->HrefValue = "";

			// f20170519
			$this->f20170519->LinkCustomAttributes = "";
			$this->f20170519->HrefValue = "";

			// f20170520
			$this->f20170520->LinkCustomAttributes = "";
			$this->f20170520->HrefValue = "";

			// f20170521
			$this->f20170521->LinkCustomAttributes = "";
			$this->f20170521->HrefValue = "";

			// f20170522
			$this->f20170522->LinkCustomAttributes = "";
			$this->f20170522->HrefValue = "";

			// f20170523
			$this->f20170523->LinkCustomAttributes = "";
			$this->f20170523->HrefValue = "";

			// f20170524
			$this->f20170524->LinkCustomAttributes = "";
			$this->f20170524->HrefValue = "";

			// f20170525
			$this->f20170525->LinkCustomAttributes = "";
			$this->f20170525->HrefValue = "";

			// f20170526
			$this->f20170526->LinkCustomAttributes = "";
			$this->f20170526->HrefValue = "";

			// f20170527
			$this->f20170527->LinkCustomAttributes = "";
			$this->f20170527->HrefValue = "";

			// f20170528
			$this->f20170528->LinkCustomAttributes = "";
			$this->f20170528->HrefValue = "";

			// f20170529
			$this->f20170529->LinkCustomAttributes = "";
			$this->f20170529->HrefValue = "";

			// f20170530
			$this->f20170530->LinkCustomAttributes = "";
			$this->f20170530->HrefValue = "";

			// f20170531
			$this->f20170531->LinkCustomAttributes = "";
			$this->f20170531->HrefValue = "";

			// f20170601
			$this->f20170601->LinkCustomAttributes = "";
			$this->f20170601->HrefValue = "";

			// f20170602
			$this->f20170602->LinkCustomAttributes = "";
			$this->f20170602->HrefValue = "";

			// f20170603
			$this->f20170603->LinkCustomAttributes = "";
			$this->f20170603->HrefValue = "";

			// f20170604
			$this->f20170604->LinkCustomAttributes = "";
			$this->f20170604->HrefValue = "";

			// f20170605
			$this->f20170605->LinkCustomAttributes = "";
			$this->f20170605->HrefValue = "";

			// f20170606
			$this->f20170606->LinkCustomAttributes = "";
			$this->f20170606->HrefValue = "";

			// f20170607
			$this->f20170607->LinkCustomAttributes = "";
			$this->f20170607->HrefValue = "";

			// f20170608
			$this->f20170608->LinkCustomAttributes = "";
			$this->f20170608->HrefValue = "";

			// f20170609
			$this->f20170609->LinkCustomAttributes = "";
			$this->f20170609->HrefValue = "";

			// f20170610
			$this->f20170610->LinkCustomAttributes = "";
			$this->f20170610->HrefValue = "";

			// f20170611
			$this->f20170611->LinkCustomAttributes = "";
			$this->f20170611->HrefValue = "";

			// f20170612
			$this->f20170612->LinkCustomAttributes = "";
			$this->f20170612->HrefValue = "";

			// f20170613
			$this->f20170613->LinkCustomAttributes = "";
			$this->f20170613->HrefValue = "";

			// f20170614
			$this->f20170614->LinkCustomAttributes = "";
			$this->f20170614->HrefValue = "";

			// f20170615
			$this->f20170615->LinkCustomAttributes = "";
			$this->f20170615->HrefValue = "";

			// f20170616
			$this->f20170616->LinkCustomAttributes = "";
			$this->f20170616->HrefValue = "";

			// f20170617
			$this->f20170617->LinkCustomAttributes = "";
			$this->f20170617->HrefValue = "";

			// f20170618
			$this->f20170618->LinkCustomAttributes = "";
			$this->f20170618->HrefValue = "";

			// f20170619
			$this->f20170619->LinkCustomAttributes = "";
			$this->f20170619->HrefValue = "";

			// f20170620
			$this->f20170620->LinkCustomAttributes = "";
			$this->f20170620->HrefValue = "";

			// f20170621
			$this->f20170621->LinkCustomAttributes = "";
			$this->f20170621->HrefValue = "";

			// f20170622
			$this->f20170622->LinkCustomAttributes = "";
			$this->f20170622->HrefValue = "";

			// f20170623
			$this->f20170623->LinkCustomAttributes = "";
			$this->f20170623->HrefValue = "";

			// f20170624
			$this->f20170624->LinkCustomAttributes = "";
			$this->f20170624->HrefValue = "";

			// f20170625
			$this->f20170625->LinkCustomAttributes = "";
			$this->f20170625->HrefValue = "";

			// f20170626
			$this->f20170626->LinkCustomAttributes = "";
			$this->f20170626->HrefValue = "";

			// f20170627
			$this->f20170627->LinkCustomAttributes = "";
			$this->f20170627->HrefValue = "";

			// f20170628
			$this->f20170628->LinkCustomAttributes = "";
			$this->f20170628->HrefValue = "";

			// f20170629
			$this->f20170629->LinkCustomAttributes = "";
			$this->f20170629->HrefValue = "";

			// f20170630
			$this->f20170630->LinkCustomAttributes = "";
			$this->f20170630->HrefValue = "";

			// f20170701
			$this->f20170701->LinkCustomAttributes = "";
			$this->f20170701->HrefValue = "";

			// f20170702
			$this->f20170702->LinkCustomAttributes = "";
			$this->f20170702->HrefValue = "";

			// f20170703
			$this->f20170703->LinkCustomAttributes = "";
			$this->f20170703->HrefValue = "";

			// f20170704
			$this->f20170704->LinkCustomAttributes = "";
			$this->f20170704->HrefValue = "";

			// f20170705
			$this->f20170705->LinkCustomAttributes = "";
			$this->f20170705->HrefValue = "";

			// f20170706
			$this->f20170706->LinkCustomAttributes = "";
			$this->f20170706->HrefValue = "";

			// f20170707
			$this->f20170707->LinkCustomAttributes = "";
			$this->f20170707->HrefValue = "";

			// f20170708
			$this->f20170708->LinkCustomAttributes = "";
			$this->f20170708->HrefValue = "";

			// f20170709
			$this->f20170709->LinkCustomAttributes = "";
			$this->f20170709->HrefValue = "";

			// f20170710
			$this->f20170710->LinkCustomAttributes = "";
			$this->f20170710->HrefValue = "";

			// f20170711
			$this->f20170711->LinkCustomAttributes = "";
			$this->f20170711->HrefValue = "";

			// f20170712
			$this->f20170712->LinkCustomAttributes = "";
			$this->f20170712->HrefValue = "";

			// f20170713
			$this->f20170713->LinkCustomAttributes = "";
			$this->f20170713->HrefValue = "";

			// f20170714
			$this->f20170714->LinkCustomAttributes = "";
			$this->f20170714->HrefValue = "";

			// f20170715
			$this->f20170715->LinkCustomAttributes = "";
			$this->f20170715->HrefValue = "";

			// f20170716
			$this->f20170716->LinkCustomAttributes = "";
			$this->f20170716->HrefValue = "";

			// f20170717
			$this->f20170717->LinkCustomAttributes = "";
			$this->f20170717->HrefValue = "";

			// f20170718
			$this->f20170718->LinkCustomAttributes = "";
			$this->f20170718->HrefValue = "";

			// f20170719
			$this->f20170719->LinkCustomAttributes = "";
			$this->f20170719->HrefValue = "";

			// f20170720
			$this->f20170720->LinkCustomAttributes = "";
			$this->f20170720->HrefValue = "";

			// f20170721
			$this->f20170721->LinkCustomAttributes = "";
			$this->f20170721->HrefValue = "";

			// f20170722
			$this->f20170722->LinkCustomAttributes = "";
			$this->f20170722->HrefValue = "";

			// f20170723
			$this->f20170723->LinkCustomAttributes = "";
			$this->f20170723->HrefValue = "";

			// f20170724
			$this->f20170724->LinkCustomAttributes = "";
			$this->f20170724->HrefValue = "";

			// f20170725
			$this->f20170725->LinkCustomAttributes = "";
			$this->f20170725->HrefValue = "";

			// f20170726
			$this->f20170726->LinkCustomAttributes = "";
			$this->f20170726->HrefValue = "";

			// f20170727
			$this->f20170727->LinkCustomAttributes = "";
			$this->f20170727->HrefValue = "";

			// f20170728
			$this->f20170728->LinkCustomAttributes = "";
			$this->f20170728->HrefValue = "";

			// f20170729
			$this->f20170729->LinkCustomAttributes = "";
			$this->f20170729->HrefValue = "";

			// f20170730
			$this->f20170730->LinkCustomAttributes = "";
			$this->f20170730->HrefValue = "";

			// f20170731
			$this->f20170731->LinkCustomAttributes = "";
			$this->f20170731->HrefValue = "";

			// f20170801
			$this->f20170801->LinkCustomAttributes = "";
			$this->f20170801->HrefValue = "";

			// f20170802
			$this->f20170802->LinkCustomAttributes = "";
			$this->f20170802->HrefValue = "";

			// f20170803
			$this->f20170803->LinkCustomAttributes = "";
			$this->f20170803->HrefValue = "";

			// f20170804
			$this->f20170804->LinkCustomAttributes = "";
			$this->f20170804->HrefValue = "";

			// f20170805
			$this->f20170805->LinkCustomAttributes = "";
			$this->f20170805->HrefValue = "";

			// f20170806
			$this->f20170806->LinkCustomAttributes = "";
			$this->f20170806->HrefValue = "";

			// f20170807
			$this->f20170807->LinkCustomAttributes = "";
			$this->f20170807->HrefValue = "";

			// f20170808
			$this->f20170808->LinkCustomAttributes = "";
			$this->f20170808->HrefValue = "";

			// f20170809
			$this->f20170809->LinkCustomAttributes = "";
			$this->f20170809->HrefValue = "";

			// f20170810
			$this->f20170810->LinkCustomAttributes = "";
			$this->f20170810->HrefValue = "";

			// f20170811
			$this->f20170811->LinkCustomAttributes = "";
			$this->f20170811->HrefValue = "";

			// f20170812
			$this->f20170812->LinkCustomAttributes = "";
			$this->f20170812->HrefValue = "";

			// f20170813
			$this->f20170813->LinkCustomAttributes = "";
			$this->f20170813->HrefValue = "";

			// f20170814
			$this->f20170814->LinkCustomAttributes = "";
			$this->f20170814->HrefValue = "";

			// f20170815
			$this->f20170815->LinkCustomAttributes = "";
			$this->f20170815->HrefValue = "";

			// f20170816
			$this->f20170816->LinkCustomAttributes = "";
			$this->f20170816->HrefValue = "";

			// f20170817
			$this->f20170817->LinkCustomAttributes = "";
			$this->f20170817->HrefValue = "";

			// f20170818
			$this->f20170818->LinkCustomAttributes = "";
			$this->f20170818->HrefValue = "";

			// f20170819
			$this->f20170819->LinkCustomAttributes = "";
			$this->f20170819->HrefValue = "";

			// f20170820
			$this->f20170820->LinkCustomAttributes = "";
			$this->f20170820->HrefValue = "";

			// f20170821
			$this->f20170821->LinkCustomAttributes = "";
			$this->f20170821->HrefValue = "";

			// f20170822
			$this->f20170822->LinkCustomAttributes = "";
			$this->f20170822->HrefValue = "";

			// f20170823
			$this->f20170823->LinkCustomAttributes = "";
			$this->f20170823->HrefValue = "";

			// f20170824
			$this->f20170824->LinkCustomAttributes = "";
			$this->f20170824->HrefValue = "";

			// f20170825
			$this->f20170825->LinkCustomAttributes = "";
			$this->f20170825->HrefValue = "";

			// f20170826
			$this->f20170826->LinkCustomAttributes = "";
			$this->f20170826->HrefValue = "";

			// f20170827
			$this->f20170827->LinkCustomAttributes = "";
			$this->f20170827->HrefValue = "";

			// f20170828
			$this->f20170828->LinkCustomAttributes = "";
			$this->f20170828->HrefValue = "";

			// f20170829
			$this->f20170829->LinkCustomAttributes = "";
			$this->f20170829->HrefValue = "";

			// f20170830
			$this->f20170830->LinkCustomAttributes = "";
			$this->f20170830->HrefValue = "";

			// f20170831
			$this->f20170831->LinkCustomAttributes = "";
			$this->f20170831->HrefValue = "";

			// f20170901
			$this->f20170901->LinkCustomAttributes = "";
			$this->f20170901->HrefValue = "";

			// f20170902
			$this->f20170902->LinkCustomAttributes = "";
			$this->f20170902->HrefValue = "";

			// f20170903
			$this->f20170903->LinkCustomAttributes = "";
			$this->f20170903->HrefValue = "";

			// f20170904
			$this->f20170904->LinkCustomAttributes = "";
			$this->f20170904->HrefValue = "";

			// f20170905
			$this->f20170905->LinkCustomAttributes = "";
			$this->f20170905->HrefValue = "";

			// f20170906
			$this->f20170906->LinkCustomAttributes = "";
			$this->f20170906->HrefValue = "";

			// f20170907
			$this->f20170907->LinkCustomAttributes = "";
			$this->f20170907->HrefValue = "";

			// f20170908
			$this->f20170908->LinkCustomAttributes = "";
			$this->f20170908->HrefValue = "";

			// f20170909
			$this->f20170909->LinkCustomAttributes = "";
			$this->f20170909->HrefValue = "";

			// f20170910
			$this->f20170910->LinkCustomAttributes = "";
			$this->f20170910->HrefValue = "";

			// f20170911
			$this->f20170911->LinkCustomAttributes = "";
			$this->f20170911->HrefValue = "";

			// f20170912
			$this->f20170912->LinkCustomAttributes = "";
			$this->f20170912->HrefValue = "";

			// f20170913
			$this->f20170913->LinkCustomAttributes = "";
			$this->f20170913->HrefValue = "";

			// f20170914
			$this->f20170914->LinkCustomAttributes = "";
			$this->f20170914->HrefValue = "";

			// f20170915
			$this->f20170915->LinkCustomAttributes = "";
			$this->f20170915->HrefValue = "";

			// f20170916
			$this->f20170916->LinkCustomAttributes = "";
			$this->f20170916->HrefValue = "";

			// f20170917
			$this->f20170917->LinkCustomAttributes = "";
			$this->f20170917->HrefValue = "";

			// f20170918
			$this->f20170918->LinkCustomAttributes = "";
			$this->f20170918->HrefValue = "";

			// f20170919
			$this->f20170919->LinkCustomAttributes = "";
			$this->f20170919->HrefValue = "";

			// f20170920
			$this->f20170920->LinkCustomAttributes = "";
			$this->f20170920->HrefValue = "";

			// f20170921
			$this->f20170921->LinkCustomAttributes = "";
			$this->f20170921->HrefValue = "";

			// f20170922
			$this->f20170922->LinkCustomAttributes = "";
			$this->f20170922->HrefValue = "";

			// f20170923
			$this->f20170923->LinkCustomAttributes = "";
			$this->f20170923->HrefValue = "";

			// f20170924
			$this->f20170924->LinkCustomAttributes = "";
			$this->f20170924->HrefValue = "";

			// f20170925
			$this->f20170925->LinkCustomAttributes = "";
			$this->f20170925->HrefValue = "";

			// f20170926
			$this->f20170926->LinkCustomAttributes = "";
			$this->f20170926->HrefValue = "";

			// f20170927
			$this->f20170927->LinkCustomAttributes = "";
			$this->f20170927->HrefValue = "";

			// f20170928
			$this->f20170928->LinkCustomAttributes = "";
			$this->f20170928->HrefValue = "";

			// f20170929
			$this->f20170929->LinkCustomAttributes = "";
			$this->f20170929->HrefValue = "";

			// f20170930
			$this->f20170930->LinkCustomAttributes = "";
			$this->f20170930->HrefValue = "";

			// f20171001
			$this->f20171001->LinkCustomAttributes = "";
			$this->f20171001->HrefValue = "";

			// f20171002
			$this->f20171002->LinkCustomAttributes = "";
			$this->f20171002->HrefValue = "";

			// f20171003
			$this->f20171003->LinkCustomAttributes = "";
			$this->f20171003->HrefValue = "";

			// f20171004
			$this->f20171004->LinkCustomAttributes = "";
			$this->f20171004->HrefValue = "";

			// f20171005
			$this->f20171005->LinkCustomAttributes = "";
			$this->f20171005->HrefValue = "";

			// f20171006
			$this->f20171006->LinkCustomAttributes = "";
			$this->f20171006->HrefValue = "";

			// f20171007
			$this->f20171007->LinkCustomAttributes = "";
			$this->f20171007->HrefValue = "";

			// f20171008
			$this->f20171008->LinkCustomAttributes = "";
			$this->f20171008->HrefValue = "";

			// f20171009
			$this->f20171009->LinkCustomAttributes = "";
			$this->f20171009->HrefValue = "";

			// f20171010
			$this->f20171010->LinkCustomAttributes = "";
			$this->f20171010->HrefValue = "";

			// f20171011
			$this->f20171011->LinkCustomAttributes = "";
			$this->f20171011->HrefValue = "";

			// f20171012
			$this->f20171012->LinkCustomAttributes = "";
			$this->f20171012->HrefValue = "";

			// f20171013
			$this->f20171013->LinkCustomAttributes = "";
			$this->f20171013->HrefValue = "";

			// f20171014
			$this->f20171014->LinkCustomAttributes = "";
			$this->f20171014->HrefValue = "";

			// f20171015
			$this->f20171015->LinkCustomAttributes = "";
			$this->f20171015->HrefValue = "";

			// f20171016
			$this->f20171016->LinkCustomAttributes = "";
			$this->f20171016->HrefValue = "";

			// f20171017
			$this->f20171017->LinkCustomAttributes = "";
			$this->f20171017->HrefValue = "";

			// f20171018
			$this->f20171018->LinkCustomAttributes = "";
			$this->f20171018->HrefValue = "";

			// f20171019
			$this->f20171019->LinkCustomAttributes = "";
			$this->f20171019->HrefValue = "";

			// f20171020
			$this->f20171020->LinkCustomAttributes = "";
			$this->f20171020->HrefValue = "";

			// f20171021
			$this->f20171021->LinkCustomAttributes = "";
			$this->f20171021->HrefValue = "";

			// f20171022
			$this->f20171022->LinkCustomAttributes = "";
			$this->f20171022->HrefValue = "";

			// f20171023
			$this->f20171023->LinkCustomAttributes = "";
			$this->f20171023->HrefValue = "";

			// f20171024
			$this->f20171024->LinkCustomAttributes = "";
			$this->f20171024->HrefValue = "";

			// f20171025
			$this->f20171025->LinkCustomAttributes = "";
			$this->f20171025->HrefValue = "";

			// f20171026
			$this->f20171026->LinkCustomAttributes = "";
			$this->f20171026->HrefValue = "";

			// f20171027
			$this->f20171027->LinkCustomAttributes = "";
			$this->f20171027->HrefValue = "";

			// f20171028
			$this->f20171028->LinkCustomAttributes = "";
			$this->f20171028->HrefValue = "";

			// f20171029
			$this->f20171029->LinkCustomAttributes = "";
			$this->f20171029->HrefValue = "";

			// f20171030
			$this->f20171030->LinkCustomAttributes = "";
			$this->f20171030->HrefValue = "";

			// f20171031
			$this->f20171031->LinkCustomAttributes = "";
			$this->f20171031->HrefValue = "";

			// f20171101
			$this->f20171101->LinkCustomAttributes = "";
			$this->f20171101->HrefValue = "";

			// f20171102
			$this->f20171102->LinkCustomAttributes = "";
			$this->f20171102->HrefValue = "";

			// f20171103
			$this->f20171103->LinkCustomAttributes = "";
			$this->f20171103->HrefValue = "";

			// f20171104
			$this->f20171104->LinkCustomAttributes = "";
			$this->f20171104->HrefValue = "";

			// f20171105
			$this->f20171105->LinkCustomAttributes = "";
			$this->f20171105->HrefValue = "";

			// f20171106
			$this->f20171106->LinkCustomAttributes = "";
			$this->f20171106->HrefValue = "";

			// f20171107
			$this->f20171107->LinkCustomAttributes = "";
			$this->f20171107->HrefValue = "";

			// f20171108
			$this->f20171108->LinkCustomAttributes = "";
			$this->f20171108->HrefValue = "";

			// f20171109
			$this->f20171109->LinkCustomAttributes = "";
			$this->f20171109->HrefValue = "";

			// f20171110
			$this->f20171110->LinkCustomAttributes = "";
			$this->f20171110->HrefValue = "";

			// f20171111
			$this->f20171111->LinkCustomAttributes = "";
			$this->f20171111->HrefValue = "";

			// f20171112
			$this->f20171112->LinkCustomAttributes = "";
			$this->f20171112->HrefValue = "";

			// f20171113
			$this->f20171113->LinkCustomAttributes = "";
			$this->f20171113->HrefValue = "";

			// f20171114
			$this->f20171114->LinkCustomAttributes = "";
			$this->f20171114->HrefValue = "";

			// f20171115
			$this->f20171115->LinkCustomAttributes = "";
			$this->f20171115->HrefValue = "";

			// f20171116
			$this->f20171116->LinkCustomAttributes = "";
			$this->f20171116->HrefValue = "";

			// f20171117
			$this->f20171117->LinkCustomAttributes = "";
			$this->f20171117->HrefValue = "";

			// f20171118
			$this->f20171118->LinkCustomAttributes = "";
			$this->f20171118->HrefValue = "";

			// f20171119
			$this->f20171119->LinkCustomAttributes = "";
			$this->f20171119->HrefValue = "";

			// f20171120
			$this->f20171120->LinkCustomAttributes = "";
			$this->f20171120->HrefValue = "";

			// f20171121
			$this->f20171121->LinkCustomAttributes = "";
			$this->f20171121->HrefValue = "";

			// f20171122
			$this->f20171122->LinkCustomAttributes = "";
			$this->f20171122->HrefValue = "";

			// f20171123
			$this->f20171123->LinkCustomAttributes = "";
			$this->f20171123->HrefValue = "";

			// f20171124
			$this->f20171124->LinkCustomAttributes = "";
			$this->f20171124->HrefValue = "";

			// f20171125
			$this->f20171125->LinkCustomAttributes = "";
			$this->f20171125->HrefValue = "";

			// f20171126
			$this->f20171126->LinkCustomAttributes = "";
			$this->f20171126->HrefValue = "";

			// f20171127
			$this->f20171127->LinkCustomAttributes = "";
			$this->f20171127->HrefValue = "";

			// f20171128
			$this->f20171128->LinkCustomAttributes = "";
			$this->f20171128->HrefValue = "";

			// f20171129
			$this->f20171129->LinkCustomAttributes = "";
			$this->f20171129->HrefValue = "";

			// f20171130
			$this->f20171130->LinkCustomAttributes = "";
			$this->f20171130->HrefValue = "";

			// f20171201
			$this->f20171201->LinkCustomAttributes = "";
			$this->f20171201->HrefValue = "";

			// f20171202
			$this->f20171202->LinkCustomAttributes = "";
			$this->f20171202->HrefValue = "";

			// f20171203
			$this->f20171203->LinkCustomAttributes = "";
			$this->f20171203->HrefValue = "";

			// f20171204
			$this->f20171204->LinkCustomAttributes = "";
			$this->f20171204->HrefValue = "";

			// f20171205
			$this->f20171205->LinkCustomAttributes = "";
			$this->f20171205->HrefValue = "";

			// f20171206
			$this->f20171206->LinkCustomAttributes = "";
			$this->f20171206->HrefValue = "";

			// f20171207
			$this->f20171207->LinkCustomAttributes = "";
			$this->f20171207->HrefValue = "";

			// f20171208
			$this->f20171208->LinkCustomAttributes = "";
			$this->f20171208->HrefValue = "";

			// f20171209
			$this->f20171209->LinkCustomAttributes = "";
			$this->f20171209->HrefValue = "";

			// f20171210
			$this->f20171210->LinkCustomAttributes = "";
			$this->f20171210->HrefValue = "";

			// f20171211
			$this->f20171211->LinkCustomAttributes = "";
			$this->f20171211->HrefValue = "";

			// f20171212
			$this->f20171212->LinkCustomAttributes = "";
			$this->f20171212->HrefValue = "";

			// f20171213
			$this->f20171213->LinkCustomAttributes = "";
			$this->f20171213->HrefValue = "";

			// f20171214
			$this->f20171214->LinkCustomAttributes = "";
			$this->f20171214->HrefValue = "";

			// f20171215
			$this->f20171215->LinkCustomAttributes = "";
			$this->f20171215->HrefValue = "";

			// f20171216
			$this->f20171216->LinkCustomAttributes = "";
			$this->f20171216->HrefValue = "";

			// f20171217
			$this->f20171217->LinkCustomAttributes = "";
			$this->f20171217->HrefValue = "";

			// f20171218
			$this->f20171218->LinkCustomAttributes = "";
			$this->f20171218->HrefValue = "";

			// f20171219
			$this->f20171219->LinkCustomAttributes = "";
			$this->f20171219->HrefValue = "";

			// f20171220
			$this->f20171220->LinkCustomAttributes = "";
			$this->f20171220->HrefValue = "";

			// f20171221
			$this->f20171221->LinkCustomAttributes = "";
			$this->f20171221->HrefValue = "";

			// f20171222
			$this->f20171222->LinkCustomAttributes = "";
			$this->f20171222->HrefValue = "";

			// f20171223
			$this->f20171223->LinkCustomAttributes = "";
			$this->f20171223->HrefValue = "";

			// f20171224
			$this->f20171224->LinkCustomAttributes = "";
			$this->f20171224->HrefValue = "";

			// f20171225
			$this->f20171225->LinkCustomAttributes = "";
			$this->f20171225->HrefValue = "";

			// f20171226
			$this->f20171226->LinkCustomAttributes = "";
			$this->f20171226->HrefValue = "";

			// f20171227
			$this->f20171227->LinkCustomAttributes = "";
			$this->f20171227->HrefValue = "";

			// f20171228
			$this->f20171228->LinkCustomAttributes = "";
			$this->f20171228->HrefValue = "";

			// f20171229
			$this->f20171229->LinkCustomAttributes = "";
			$this->f20171229->HrefValue = "";

			// f20171230
			$this->f20171230->LinkCustomAttributes = "";
			$this->f20171230->HrefValue = "";

			// f20171231
			$this->f20171231->LinkCustomAttributes = "";
			$this->f20171231->HrefValue = "";
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
		if (!ew_CheckInteger($this->f20170101->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170101->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170103->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170103->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170104->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170104->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170105->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170105->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170106->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170106->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170107->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170107->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170108->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170108->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170109->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170109->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170110->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170110->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170111->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170111->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170112->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170112->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170113->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170113->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170114->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170114->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170115->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170115->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170116->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170116->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170117->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170117->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170118->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170118->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170119->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170119->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170120->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170120->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170121->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170121->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170122->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170122->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170123->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170123->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170124->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170124->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170125->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170125->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170126->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170126->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170127->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170127->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170128->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170128->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170129->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170129->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170130->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170130->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170131->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170131->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170201->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170201->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170202->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170202->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170203->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170203->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170204->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170204->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170205->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170205->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170206->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170206->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170207->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170207->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170208->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170208->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170209->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170209->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170210->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170210->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170211->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170211->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170212->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170212->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170213->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170213->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170214->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170214->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170215->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170215->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170216->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170216->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170217->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170217->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170218->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170218->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170219->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170219->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170220->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170220->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170221->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170221->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170222->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170222->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170223->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170223->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170224->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170224->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170225->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170225->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170226->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170226->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170227->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170227->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170228->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170228->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170229->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170229->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170301->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170301->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170302->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170302->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170303->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170303->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170304->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170304->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170305->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170305->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170306->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170306->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170307->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170307->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170308->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170308->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170309->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170309->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170310->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170310->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170311->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170311->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170312->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170312->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170313->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170313->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170314->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170314->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170315->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170315->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170316->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170316->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170317->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170317->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170318->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170318->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170319->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170319->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170320->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170320->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170321->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170321->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170322->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170322->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170323->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170323->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170324->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170324->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170325->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170325->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170326->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170326->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170327->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170327->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170328->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170328->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170329->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170329->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170330->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170330->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170331->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170331->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170401->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170401->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170402->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170402->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170403->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170403->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170404->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170404->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170405->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170405->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170406->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170406->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170407->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170407->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170408->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170408->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170409->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170409->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170410->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170410->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170411->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170411->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170412->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170412->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170413->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170413->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170414->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170414->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170415->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170415->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170416->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170416->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170417->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170417->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170418->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170418->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170419->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170419->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170420->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170420->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170421->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170421->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170422->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170422->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170423->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170423->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170424->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170424->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170425->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170425->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170426->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170426->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170427->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170427->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170428->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170428->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170429->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170429->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170430->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170430->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170501->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170501->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170502->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170502->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170503->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170503->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170504->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170504->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170505->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170505->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170506->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170506->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170507->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170507->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170508->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170508->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170509->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170509->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170510->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170510->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170511->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170511->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170512->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170512->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170513->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170513->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170514->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170514->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170515->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170515->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170516->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170516->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170517->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170517->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170518->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170518->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170519->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170519->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170520->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170520->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170521->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170521->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170522->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170522->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170523->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170523->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170524->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170524->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170525->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170525->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170526->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170526->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170527->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170527->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170528->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170528->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170529->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170529->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170530->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170530->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170531->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170531->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170601->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170601->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170602->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170602->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170603->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170603->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170604->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170604->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170605->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170605->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170606->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170606->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170607->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170607->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170608->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170608->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170609->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170609->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170610->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170610->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170611->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170611->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170612->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170612->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170613->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170613->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170614->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170614->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170615->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170615->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170616->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170616->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170617->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170617->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170618->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170618->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170619->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170619->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170620->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170620->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170621->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170621->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170622->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170622->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170623->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170623->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170624->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170624->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170625->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170625->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170626->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170626->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170627->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170627->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170628->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170628->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170629->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170629->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170630->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170630->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170701->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170701->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170702->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170702->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170703->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170703->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170704->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170704->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170705->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170705->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170706->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170706->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170707->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170707->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170708->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170708->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170709->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170709->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170710->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170710->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170711->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170711->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170712->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170712->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170713->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170713->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170714->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170714->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170715->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170715->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170716->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170716->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170717->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170717->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170718->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170718->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170719->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170719->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170720->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170720->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170721->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170721->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170722->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170722->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170723->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170723->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170724->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170724->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170725->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170725->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170726->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170726->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170727->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170727->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170728->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170728->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170729->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170729->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170730->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170730->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170731->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170731->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170801->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170801->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170802->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170802->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170803->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170803->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170804->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170804->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170805->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170805->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170806->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170806->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170807->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170807->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170808->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170808->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170809->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170809->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170810->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170810->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170811->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170811->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170812->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170812->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170813->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170813->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170814->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170814->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170815->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170815->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170816->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170816->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170817->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170817->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170818->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170818->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170819->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170819->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170820->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170820->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170821->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170821->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170822->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170822->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170823->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170823->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170824->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170824->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170825->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170825->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170826->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170826->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170827->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170827->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170828->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170828->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170829->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170829->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170830->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170830->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170831->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170831->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170901->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170901->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170902->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170902->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170903->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170903->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170904->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170904->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170905->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170905->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170906->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170906->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170907->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170907->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170908->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170908->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170909->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170909->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170910->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170910->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170911->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170911->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170912->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170912->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170913->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170913->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170914->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170914->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170915->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170915->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170916->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170916->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170917->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170917->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170918->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170918->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170919->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170919->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170920->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170920->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170921->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170921->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170922->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170922->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170923->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170923->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170924->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170924->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170925->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170925->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170926->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170926->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170927->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170927->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170928->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170928->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170929->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170929->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20170930->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20170930->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171001->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171001->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171002->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171002->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171003->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171003->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171004->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171004->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171005->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171005->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171006->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171006->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171007->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171007->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171008->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171008->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171009->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171009->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171010->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171010->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171011->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171011->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171012->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171012->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171013->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171013->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171014->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171014->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171015->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171015->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171016->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171016->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171017->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171017->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171018->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171018->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171019->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171019->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171020->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171020->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171021->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171021->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171022->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171022->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171023->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171023->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171024->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171024->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171025->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171025->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171026->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171026->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171027->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171027->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171028->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171028->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171029->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171029->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171030->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171030->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171031->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171031->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171101->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171101->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171102->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171102->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171103->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171103->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171104->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171104->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171105->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171105->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171106->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171106->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171107->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171107->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171108->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171108->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171109->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171109->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171110->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171110->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171111->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171111->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171112->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171112->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171113->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171113->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171114->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171114->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171115->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171115->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171116->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171116->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171117->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171117->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171118->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171118->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171119->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171119->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171120->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171120->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171121->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171121->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171122->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171122->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171123->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171123->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171124->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171124->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171125->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171125->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171126->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171126->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171127->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171127->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171128->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171128->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171129->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171129->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171130->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171130->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171201->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171201->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171202->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171202->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171203->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171203->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171204->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171204->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171205->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171205->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171206->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171206->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171207->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171207->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171208->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171208->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171209->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171209->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171210->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171210->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171211->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171211->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171212->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171212->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171213->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171213->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171214->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171214->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171215->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171215->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171216->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171216->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171217->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171217->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171218->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171218->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171219->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171219->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171220->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171220->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171221->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171221->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171222->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171222->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171223->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171223->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171224->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171224->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171225->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171225->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171226->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171226->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171227->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171227->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171228->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171228->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171229->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171229->FldErrMsg());
		}
		if (!ew_CheckInteger($this->f20171230->FormValue)) {
			ew_AddMessage($gsFormError, $this->f20171230->FldErrMsg());
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

		// f20170101
		$this->f20170101->SetDbValueDef($rsnew, $this->f20170101->CurrentValue, NULL, FALSE);

		// f20170102
		$this->f20170102->SetDbValueDef($rsnew, $this->f20170102->CurrentValue, NULL, FALSE);

		// f20170103
		$this->f20170103->SetDbValueDef($rsnew, $this->f20170103->CurrentValue, NULL, FALSE);

		// f20170104
		$this->f20170104->SetDbValueDef($rsnew, $this->f20170104->CurrentValue, NULL, FALSE);

		// f20170105
		$this->f20170105->SetDbValueDef($rsnew, $this->f20170105->CurrentValue, NULL, FALSE);

		// f20170106
		$this->f20170106->SetDbValueDef($rsnew, $this->f20170106->CurrentValue, NULL, FALSE);

		// f20170107
		$this->f20170107->SetDbValueDef($rsnew, $this->f20170107->CurrentValue, NULL, FALSE);

		// f20170108
		$this->f20170108->SetDbValueDef($rsnew, $this->f20170108->CurrentValue, NULL, FALSE);

		// f20170109
		$this->f20170109->SetDbValueDef($rsnew, $this->f20170109->CurrentValue, NULL, FALSE);

		// f20170110
		$this->f20170110->SetDbValueDef($rsnew, $this->f20170110->CurrentValue, NULL, FALSE);

		// f20170111
		$this->f20170111->SetDbValueDef($rsnew, $this->f20170111->CurrentValue, NULL, FALSE);

		// f20170112
		$this->f20170112->SetDbValueDef($rsnew, $this->f20170112->CurrentValue, NULL, FALSE);

		// f20170113
		$this->f20170113->SetDbValueDef($rsnew, $this->f20170113->CurrentValue, NULL, FALSE);

		// f20170114
		$this->f20170114->SetDbValueDef($rsnew, $this->f20170114->CurrentValue, NULL, FALSE);

		// f20170115
		$this->f20170115->SetDbValueDef($rsnew, $this->f20170115->CurrentValue, NULL, FALSE);

		// f20170116
		$this->f20170116->SetDbValueDef($rsnew, $this->f20170116->CurrentValue, NULL, FALSE);

		// f20170117
		$this->f20170117->SetDbValueDef($rsnew, $this->f20170117->CurrentValue, NULL, FALSE);

		// f20170118
		$this->f20170118->SetDbValueDef($rsnew, $this->f20170118->CurrentValue, NULL, FALSE);

		// f20170119
		$this->f20170119->SetDbValueDef($rsnew, $this->f20170119->CurrentValue, NULL, FALSE);

		// f20170120
		$this->f20170120->SetDbValueDef($rsnew, $this->f20170120->CurrentValue, NULL, FALSE);

		// f20170121
		$this->f20170121->SetDbValueDef($rsnew, $this->f20170121->CurrentValue, NULL, FALSE);

		// f20170122
		$this->f20170122->SetDbValueDef($rsnew, $this->f20170122->CurrentValue, NULL, FALSE);

		// f20170123
		$this->f20170123->SetDbValueDef($rsnew, $this->f20170123->CurrentValue, NULL, FALSE);

		// f20170124
		$this->f20170124->SetDbValueDef($rsnew, $this->f20170124->CurrentValue, NULL, FALSE);

		// f20170125
		$this->f20170125->SetDbValueDef($rsnew, $this->f20170125->CurrentValue, NULL, FALSE);

		// f20170126
		$this->f20170126->SetDbValueDef($rsnew, $this->f20170126->CurrentValue, NULL, FALSE);

		// f20170127
		$this->f20170127->SetDbValueDef($rsnew, $this->f20170127->CurrentValue, NULL, FALSE);

		// f20170128
		$this->f20170128->SetDbValueDef($rsnew, $this->f20170128->CurrentValue, NULL, FALSE);

		// f20170129
		$this->f20170129->SetDbValueDef($rsnew, $this->f20170129->CurrentValue, NULL, FALSE);

		// f20170130
		$this->f20170130->SetDbValueDef($rsnew, $this->f20170130->CurrentValue, NULL, FALSE);

		// f20170131
		$this->f20170131->SetDbValueDef($rsnew, $this->f20170131->CurrentValue, NULL, FALSE);

		// f20170201
		$this->f20170201->SetDbValueDef($rsnew, $this->f20170201->CurrentValue, NULL, FALSE);

		// f20170202
		$this->f20170202->SetDbValueDef($rsnew, $this->f20170202->CurrentValue, NULL, FALSE);

		// f20170203
		$this->f20170203->SetDbValueDef($rsnew, $this->f20170203->CurrentValue, NULL, FALSE);

		// f20170204
		$this->f20170204->SetDbValueDef($rsnew, $this->f20170204->CurrentValue, NULL, FALSE);

		// f20170205
		$this->f20170205->SetDbValueDef($rsnew, $this->f20170205->CurrentValue, NULL, FALSE);

		// f20170206
		$this->f20170206->SetDbValueDef($rsnew, $this->f20170206->CurrentValue, NULL, FALSE);

		// f20170207
		$this->f20170207->SetDbValueDef($rsnew, $this->f20170207->CurrentValue, NULL, FALSE);

		// f20170208
		$this->f20170208->SetDbValueDef($rsnew, $this->f20170208->CurrentValue, NULL, FALSE);

		// f20170209
		$this->f20170209->SetDbValueDef($rsnew, $this->f20170209->CurrentValue, NULL, FALSE);

		// f20170210
		$this->f20170210->SetDbValueDef($rsnew, $this->f20170210->CurrentValue, NULL, FALSE);

		// f20170211
		$this->f20170211->SetDbValueDef($rsnew, $this->f20170211->CurrentValue, NULL, FALSE);

		// f20170212
		$this->f20170212->SetDbValueDef($rsnew, $this->f20170212->CurrentValue, NULL, FALSE);

		// f20170213
		$this->f20170213->SetDbValueDef($rsnew, $this->f20170213->CurrentValue, NULL, FALSE);

		// f20170214
		$this->f20170214->SetDbValueDef($rsnew, $this->f20170214->CurrentValue, NULL, FALSE);

		// f20170215
		$this->f20170215->SetDbValueDef($rsnew, $this->f20170215->CurrentValue, NULL, FALSE);

		// f20170216
		$this->f20170216->SetDbValueDef($rsnew, $this->f20170216->CurrentValue, NULL, FALSE);

		// f20170217
		$this->f20170217->SetDbValueDef($rsnew, $this->f20170217->CurrentValue, NULL, FALSE);

		// f20170218
		$this->f20170218->SetDbValueDef($rsnew, $this->f20170218->CurrentValue, NULL, FALSE);

		// f20170219
		$this->f20170219->SetDbValueDef($rsnew, $this->f20170219->CurrentValue, NULL, FALSE);

		// f20170220
		$this->f20170220->SetDbValueDef($rsnew, $this->f20170220->CurrentValue, NULL, FALSE);

		// f20170221
		$this->f20170221->SetDbValueDef($rsnew, $this->f20170221->CurrentValue, NULL, FALSE);

		// f20170222
		$this->f20170222->SetDbValueDef($rsnew, $this->f20170222->CurrentValue, NULL, FALSE);

		// f20170223
		$this->f20170223->SetDbValueDef($rsnew, $this->f20170223->CurrentValue, NULL, FALSE);

		// f20170224
		$this->f20170224->SetDbValueDef($rsnew, $this->f20170224->CurrentValue, NULL, FALSE);

		// f20170225
		$this->f20170225->SetDbValueDef($rsnew, $this->f20170225->CurrentValue, NULL, FALSE);

		// f20170226
		$this->f20170226->SetDbValueDef($rsnew, $this->f20170226->CurrentValue, NULL, FALSE);

		// f20170227
		$this->f20170227->SetDbValueDef($rsnew, $this->f20170227->CurrentValue, NULL, FALSE);

		// f20170228
		$this->f20170228->SetDbValueDef($rsnew, $this->f20170228->CurrentValue, NULL, FALSE);

		// f20170229
		$this->f20170229->SetDbValueDef($rsnew, $this->f20170229->CurrentValue, NULL, FALSE);

		// f20170301
		$this->f20170301->SetDbValueDef($rsnew, $this->f20170301->CurrentValue, NULL, FALSE);

		// f20170302
		$this->f20170302->SetDbValueDef($rsnew, $this->f20170302->CurrentValue, NULL, FALSE);

		// f20170303
		$this->f20170303->SetDbValueDef($rsnew, $this->f20170303->CurrentValue, NULL, FALSE);

		// f20170304
		$this->f20170304->SetDbValueDef($rsnew, $this->f20170304->CurrentValue, NULL, FALSE);

		// f20170305
		$this->f20170305->SetDbValueDef($rsnew, $this->f20170305->CurrentValue, NULL, FALSE);

		// f20170306
		$this->f20170306->SetDbValueDef($rsnew, $this->f20170306->CurrentValue, NULL, FALSE);

		// f20170307
		$this->f20170307->SetDbValueDef($rsnew, $this->f20170307->CurrentValue, NULL, FALSE);

		// f20170308
		$this->f20170308->SetDbValueDef($rsnew, $this->f20170308->CurrentValue, NULL, FALSE);

		// f20170309
		$this->f20170309->SetDbValueDef($rsnew, $this->f20170309->CurrentValue, NULL, FALSE);

		// f20170310
		$this->f20170310->SetDbValueDef($rsnew, $this->f20170310->CurrentValue, NULL, FALSE);

		// f20170311
		$this->f20170311->SetDbValueDef($rsnew, $this->f20170311->CurrentValue, NULL, FALSE);

		// f20170312
		$this->f20170312->SetDbValueDef($rsnew, $this->f20170312->CurrentValue, NULL, FALSE);

		// f20170313
		$this->f20170313->SetDbValueDef($rsnew, $this->f20170313->CurrentValue, NULL, FALSE);

		// f20170314
		$this->f20170314->SetDbValueDef($rsnew, $this->f20170314->CurrentValue, NULL, FALSE);

		// f20170315
		$this->f20170315->SetDbValueDef($rsnew, $this->f20170315->CurrentValue, NULL, FALSE);

		// f20170316
		$this->f20170316->SetDbValueDef($rsnew, $this->f20170316->CurrentValue, NULL, FALSE);

		// f20170317
		$this->f20170317->SetDbValueDef($rsnew, $this->f20170317->CurrentValue, NULL, FALSE);

		// f20170318
		$this->f20170318->SetDbValueDef($rsnew, $this->f20170318->CurrentValue, NULL, FALSE);

		// f20170319
		$this->f20170319->SetDbValueDef($rsnew, $this->f20170319->CurrentValue, NULL, FALSE);

		// f20170320
		$this->f20170320->SetDbValueDef($rsnew, $this->f20170320->CurrentValue, NULL, FALSE);

		// f20170321
		$this->f20170321->SetDbValueDef($rsnew, $this->f20170321->CurrentValue, NULL, FALSE);

		// f20170322
		$this->f20170322->SetDbValueDef($rsnew, $this->f20170322->CurrentValue, NULL, FALSE);

		// f20170323
		$this->f20170323->SetDbValueDef($rsnew, $this->f20170323->CurrentValue, NULL, FALSE);

		// f20170324
		$this->f20170324->SetDbValueDef($rsnew, $this->f20170324->CurrentValue, NULL, FALSE);

		// f20170325
		$this->f20170325->SetDbValueDef($rsnew, $this->f20170325->CurrentValue, NULL, FALSE);

		// f20170326
		$this->f20170326->SetDbValueDef($rsnew, $this->f20170326->CurrentValue, NULL, FALSE);

		// f20170327
		$this->f20170327->SetDbValueDef($rsnew, $this->f20170327->CurrentValue, NULL, FALSE);

		// f20170328
		$this->f20170328->SetDbValueDef($rsnew, $this->f20170328->CurrentValue, NULL, FALSE);

		// f20170329
		$this->f20170329->SetDbValueDef($rsnew, $this->f20170329->CurrentValue, NULL, FALSE);

		// f20170330
		$this->f20170330->SetDbValueDef($rsnew, $this->f20170330->CurrentValue, NULL, FALSE);

		// f20170331
		$this->f20170331->SetDbValueDef($rsnew, $this->f20170331->CurrentValue, NULL, FALSE);

		// f20170401
		$this->f20170401->SetDbValueDef($rsnew, $this->f20170401->CurrentValue, NULL, FALSE);

		// f20170402
		$this->f20170402->SetDbValueDef($rsnew, $this->f20170402->CurrentValue, NULL, FALSE);

		// f20170403
		$this->f20170403->SetDbValueDef($rsnew, $this->f20170403->CurrentValue, NULL, FALSE);

		// f20170404
		$this->f20170404->SetDbValueDef($rsnew, $this->f20170404->CurrentValue, NULL, FALSE);

		// f20170405
		$this->f20170405->SetDbValueDef($rsnew, $this->f20170405->CurrentValue, NULL, FALSE);

		// f20170406
		$this->f20170406->SetDbValueDef($rsnew, $this->f20170406->CurrentValue, NULL, FALSE);

		// f20170407
		$this->f20170407->SetDbValueDef($rsnew, $this->f20170407->CurrentValue, NULL, FALSE);

		// f20170408
		$this->f20170408->SetDbValueDef($rsnew, $this->f20170408->CurrentValue, NULL, FALSE);

		// f20170409
		$this->f20170409->SetDbValueDef($rsnew, $this->f20170409->CurrentValue, NULL, FALSE);

		// f20170410
		$this->f20170410->SetDbValueDef($rsnew, $this->f20170410->CurrentValue, NULL, FALSE);

		// f20170411
		$this->f20170411->SetDbValueDef($rsnew, $this->f20170411->CurrentValue, NULL, FALSE);

		// f20170412
		$this->f20170412->SetDbValueDef($rsnew, $this->f20170412->CurrentValue, NULL, FALSE);

		// f20170413
		$this->f20170413->SetDbValueDef($rsnew, $this->f20170413->CurrentValue, NULL, FALSE);

		// f20170414
		$this->f20170414->SetDbValueDef($rsnew, $this->f20170414->CurrentValue, NULL, FALSE);

		// f20170415
		$this->f20170415->SetDbValueDef($rsnew, $this->f20170415->CurrentValue, NULL, FALSE);

		// f20170416
		$this->f20170416->SetDbValueDef($rsnew, $this->f20170416->CurrentValue, NULL, FALSE);

		// f20170417
		$this->f20170417->SetDbValueDef($rsnew, $this->f20170417->CurrentValue, NULL, FALSE);

		// f20170418
		$this->f20170418->SetDbValueDef($rsnew, $this->f20170418->CurrentValue, NULL, FALSE);

		// f20170419
		$this->f20170419->SetDbValueDef($rsnew, $this->f20170419->CurrentValue, NULL, FALSE);

		// f20170420
		$this->f20170420->SetDbValueDef($rsnew, $this->f20170420->CurrentValue, NULL, FALSE);

		// f20170421
		$this->f20170421->SetDbValueDef($rsnew, $this->f20170421->CurrentValue, NULL, FALSE);

		// f20170422
		$this->f20170422->SetDbValueDef($rsnew, $this->f20170422->CurrentValue, NULL, FALSE);

		// f20170423
		$this->f20170423->SetDbValueDef($rsnew, $this->f20170423->CurrentValue, NULL, FALSE);

		// f20170424
		$this->f20170424->SetDbValueDef($rsnew, $this->f20170424->CurrentValue, NULL, FALSE);

		// f20170425
		$this->f20170425->SetDbValueDef($rsnew, $this->f20170425->CurrentValue, NULL, FALSE);

		// f20170426
		$this->f20170426->SetDbValueDef($rsnew, $this->f20170426->CurrentValue, NULL, FALSE);

		// f20170427
		$this->f20170427->SetDbValueDef($rsnew, $this->f20170427->CurrentValue, NULL, FALSE);

		// f20170428
		$this->f20170428->SetDbValueDef($rsnew, $this->f20170428->CurrentValue, NULL, FALSE);

		// f20170429
		$this->f20170429->SetDbValueDef($rsnew, $this->f20170429->CurrentValue, NULL, FALSE);

		// f20170430
		$this->f20170430->SetDbValueDef($rsnew, $this->f20170430->CurrentValue, NULL, FALSE);

		// f20170501
		$this->f20170501->SetDbValueDef($rsnew, $this->f20170501->CurrentValue, NULL, FALSE);

		// f20170502
		$this->f20170502->SetDbValueDef($rsnew, $this->f20170502->CurrentValue, NULL, FALSE);

		// f20170503
		$this->f20170503->SetDbValueDef($rsnew, $this->f20170503->CurrentValue, NULL, FALSE);

		// f20170504
		$this->f20170504->SetDbValueDef($rsnew, $this->f20170504->CurrentValue, NULL, FALSE);

		// f20170505
		$this->f20170505->SetDbValueDef($rsnew, $this->f20170505->CurrentValue, NULL, FALSE);

		// f20170506
		$this->f20170506->SetDbValueDef($rsnew, $this->f20170506->CurrentValue, NULL, FALSE);

		// f20170507
		$this->f20170507->SetDbValueDef($rsnew, $this->f20170507->CurrentValue, NULL, FALSE);

		// f20170508
		$this->f20170508->SetDbValueDef($rsnew, $this->f20170508->CurrentValue, NULL, FALSE);

		// f20170509
		$this->f20170509->SetDbValueDef($rsnew, $this->f20170509->CurrentValue, NULL, FALSE);

		// f20170510
		$this->f20170510->SetDbValueDef($rsnew, $this->f20170510->CurrentValue, NULL, FALSE);

		// f20170511
		$this->f20170511->SetDbValueDef($rsnew, $this->f20170511->CurrentValue, NULL, FALSE);

		// f20170512
		$this->f20170512->SetDbValueDef($rsnew, $this->f20170512->CurrentValue, NULL, FALSE);

		// f20170513
		$this->f20170513->SetDbValueDef($rsnew, $this->f20170513->CurrentValue, NULL, FALSE);

		// f20170514
		$this->f20170514->SetDbValueDef($rsnew, $this->f20170514->CurrentValue, NULL, FALSE);

		// f20170515
		$this->f20170515->SetDbValueDef($rsnew, $this->f20170515->CurrentValue, NULL, FALSE);

		// f20170516
		$this->f20170516->SetDbValueDef($rsnew, $this->f20170516->CurrentValue, NULL, FALSE);

		// f20170517
		$this->f20170517->SetDbValueDef($rsnew, $this->f20170517->CurrentValue, NULL, FALSE);

		// f20170518
		$this->f20170518->SetDbValueDef($rsnew, $this->f20170518->CurrentValue, NULL, FALSE);

		// f20170519
		$this->f20170519->SetDbValueDef($rsnew, $this->f20170519->CurrentValue, NULL, FALSE);

		// f20170520
		$this->f20170520->SetDbValueDef($rsnew, $this->f20170520->CurrentValue, NULL, FALSE);

		// f20170521
		$this->f20170521->SetDbValueDef($rsnew, $this->f20170521->CurrentValue, NULL, FALSE);

		// f20170522
		$this->f20170522->SetDbValueDef($rsnew, $this->f20170522->CurrentValue, NULL, FALSE);

		// f20170523
		$this->f20170523->SetDbValueDef($rsnew, $this->f20170523->CurrentValue, NULL, FALSE);

		// f20170524
		$this->f20170524->SetDbValueDef($rsnew, $this->f20170524->CurrentValue, NULL, FALSE);

		// f20170525
		$this->f20170525->SetDbValueDef($rsnew, $this->f20170525->CurrentValue, NULL, FALSE);

		// f20170526
		$this->f20170526->SetDbValueDef($rsnew, $this->f20170526->CurrentValue, NULL, FALSE);

		// f20170527
		$this->f20170527->SetDbValueDef($rsnew, $this->f20170527->CurrentValue, NULL, FALSE);

		// f20170528
		$this->f20170528->SetDbValueDef($rsnew, $this->f20170528->CurrentValue, NULL, FALSE);

		// f20170529
		$this->f20170529->SetDbValueDef($rsnew, $this->f20170529->CurrentValue, NULL, FALSE);

		// f20170530
		$this->f20170530->SetDbValueDef($rsnew, $this->f20170530->CurrentValue, NULL, FALSE);

		// f20170531
		$this->f20170531->SetDbValueDef($rsnew, $this->f20170531->CurrentValue, NULL, FALSE);

		// f20170601
		$this->f20170601->SetDbValueDef($rsnew, $this->f20170601->CurrentValue, NULL, FALSE);

		// f20170602
		$this->f20170602->SetDbValueDef($rsnew, $this->f20170602->CurrentValue, NULL, FALSE);

		// f20170603
		$this->f20170603->SetDbValueDef($rsnew, $this->f20170603->CurrentValue, NULL, FALSE);

		// f20170604
		$this->f20170604->SetDbValueDef($rsnew, $this->f20170604->CurrentValue, NULL, FALSE);

		// f20170605
		$this->f20170605->SetDbValueDef($rsnew, $this->f20170605->CurrentValue, NULL, FALSE);

		// f20170606
		$this->f20170606->SetDbValueDef($rsnew, $this->f20170606->CurrentValue, NULL, FALSE);

		// f20170607
		$this->f20170607->SetDbValueDef($rsnew, $this->f20170607->CurrentValue, NULL, FALSE);

		// f20170608
		$this->f20170608->SetDbValueDef($rsnew, $this->f20170608->CurrentValue, NULL, FALSE);

		// f20170609
		$this->f20170609->SetDbValueDef($rsnew, $this->f20170609->CurrentValue, NULL, FALSE);

		// f20170610
		$this->f20170610->SetDbValueDef($rsnew, $this->f20170610->CurrentValue, NULL, FALSE);

		// f20170611
		$this->f20170611->SetDbValueDef($rsnew, $this->f20170611->CurrentValue, NULL, FALSE);

		// f20170612
		$this->f20170612->SetDbValueDef($rsnew, $this->f20170612->CurrentValue, NULL, FALSE);

		// f20170613
		$this->f20170613->SetDbValueDef($rsnew, $this->f20170613->CurrentValue, NULL, FALSE);

		// f20170614
		$this->f20170614->SetDbValueDef($rsnew, $this->f20170614->CurrentValue, NULL, FALSE);

		// f20170615
		$this->f20170615->SetDbValueDef($rsnew, $this->f20170615->CurrentValue, NULL, FALSE);

		// f20170616
		$this->f20170616->SetDbValueDef($rsnew, $this->f20170616->CurrentValue, NULL, FALSE);

		// f20170617
		$this->f20170617->SetDbValueDef($rsnew, $this->f20170617->CurrentValue, NULL, FALSE);

		// f20170618
		$this->f20170618->SetDbValueDef($rsnew, $this->f20170618->CurrentValue, NULL, FALSE);

		// f20170619
		$this->f20170619->SetDbValueDef($rsnew, $this->f20170619->CurrentValue, NULL, FALSE);

		// f20170620
		$this->f20170620->SetDbValueDef($rsnew, $this->f20170620->CurrentValue, NULL, FALSE);

		// f20170621
		$this->f20170621->SetDbValueDef($rsnew, $this->f20170621->CurrentValue, NULL, FALSE);

		// f20170622
		$this->f20170622->SetDbValueDef($rsnew, $this->f20170622->CurrentValue, NULL, FALSE);

		// f20170623
		$this->f20170623->SetDbValueDef($rsnew, $this->f20170623->CurrentValue, NULL, FALSE);

		// f20170624
		$this->f20170624->SetDbValueDef($rsnew, $this->f20170624->CurrentValue, NULL, FALSE);

		// f20170625
		$this->f20170625->SetDbValueDef($rsnew, $this->f20170625->CurrentValue, NULL, FALSE);

		// f20170626
		$this->f20170626->SetDbValueDef($rsnew, $this->f20170626->CurrentValue, NULL, FALSE);

		// f20170627
		$this->f20170627->SetDbValueDef($rsnew, $this->f20170627->CurrentValue, NULL, FALSE);

		// f20170628
		$this->f20170628->SetDbValueDef($rsnew, $this->f20170628->CurrentValue, NULL, FALSE);

		// f20170629
		$this->f20170629->SetDbValueDef($rsnew, $this->f20170629->CurrentValue, NULL, FALSE);

		// f20170630
		$this->f20170630->SetDbValueDef($rsnew, $this->f20170630->CurrentValue, NULL, FALSE);

		// f20170701
		$this->f20170701->SetDbValueDef($rsnew, $this->f20170701->CurrentValue, NULL, FALSE);

		// f20170702
		$this->f20170702->SetDbValueDef($rsnew, $this->f20170702->CurrentValue, NULL, FALSE);

		// f20170703
		$this->f20170703->SetDbValueDef($rsnew, $this->f20170703->CurrentValue, NULL, FALSE);

		// f20170704
		$this->f20170704->SetDbValueDef($rsnew, $this->f20170704->CurrentValue, NULL, FALSE);

		// f20170705
		$this->f20170705->SetDbValueDef($rsnew, $this->f20170705->CurrentValue, NULL, FALSE);

		// f20170706
		$this->f20170706->SetDbValueDef($rsnew, $this->f20170706->CurrentValue, NULL, FALSE);

		// f20170707
		$this->f20170707->SetDbValueDef($rsnew, $this->f20170707->CurrentValue, NULL, FALSE);

		// f20170708
		$this->f20170708->SetDbValueDef($rsnew, $this->f20170708->CurrentValue, NULL, FALSE);

		// f20170709
		$this->f20170709->SetDbValueDef($rsnew, $this->f20170709->CurrentValue, NULL, FALSE);

		// f20170710
		$this->f20170710->SetDbValueDef($rsnew, $this->f20170710->CurrentValue, NULL, FALSE);

		// f20170711
		$this->f20170711->SetDbValueDef($rsnew, $this->f20170711->CurrentValue, NULL, FALSE);

		// f20170712
		$this->f20170712->SetDbValueDef($rsnew, $this->f20170712->CurrentValue, NULL, FALSE);

		// f20170713
		$this->f20170713->SetDbValueDef($rsnew, $this->f20170713->CurrentValue, NULL, FALSE);

		// f20170714
		$this->f20170714->SetDbValueDef($rsnew, $this->f20170714->CurrentValue, NULL, FALSE);

		// f20170715
		$this->f20170715->SetDbValueDef($rsnew, $this->f20170715->CurrentValue, NULL, FALSE);

		// f20170716
		$this->f20170716->SetDbValueDef($rsnew, $this->f20170716->CurrentValue, NULL, FALSE);

		// f20170717
		$this->f20170717->SetDbValueDef($rsnew, $this->f20170717->CurrentValue, NULL, FALSE);

		// f20170718
		$this->f20170718->SetDbValueDef($rsnew, $this->f20170718->CurrentValue, NULL, FALSE);

		// f20170719
		$this->f20170719->SetDbValueDef($rsnew, $this->f20170719->CurrentValue, NULL, FALSE);

		// f20170720
		$this->f20170720->SetDbValueDef($rsnew, $this->f20170720->CurrentValue, NULL, FALSE);

		// f20170721
		$this->f20170721->SetDbValueDef($rsnew, $this->f20170721->CurrentValue, NULL, FALSE);

		// f20170722
		$this->f20170722->SetDbValueDef($rsnew, $this->f20170722->CurrentValue, NULL, FALSE);

		// f20170723
		$this->f20170723->SetDbValueDef($rsnew, $this->f20170723->CurrentValue, NULL, FALSE);

		// f20170724
		$this->f20170724->SetDbValueDef($rsnew, $this->f20170724->CurrentValue, NULL, FALSE);

		// f20170725
		$this->f20170725->SetDbValueDef($rsnew, $this->f20170725->CurrentValue, NULL, FALSE);

		// f20170726
		$this->f20170726->SetDbValueDef($rsnew, $this->f20170726->CurrentValue, NULL, FALSE);

		// f20170727
		$this->f20170727->SetDbValueDef($rsnew, $this->f20170727->CurrentValue, NULL, FALSE);

		// f20170728
		$this->f20170728->SetDbValueDef($rsnew, $this->f20170728->CurrentValue, NULL, FALSE);

		// f20170729
		$this->f20170729->SetDbValueDef($rsnew, $this->f20170729->CurrentValue, NULL, FALSE);

		// f20170730
		$this->f20170730->SetDbValueDef($rsnew, $this->f20170730->CurrentValue, NULL, FALSE);

		// f20170731
		$this->f20170731->SetDbValueDef($rsnew, $this->f20170731->CurrentValue, NULL, FALSE);

		// f20170801
		$this->f20170801->SetDbValueDef($rsnew, $this->f20170801->CurrentValue, NULL, FALSE);

		// f20170802
		$this->f20170802->SetDbValueDef($rsnew, $this->f20170802->CurrentValue, NULL, FALSE);

		// f20170803
		$this->f20170803->SetDbValueDef($rsnew, $this->f20170803->CurrentValue, NULL, FALSE);

		// f20170804
		$this->f20170804->SetDbValueDef($rsnew, $this->f20170804->CurrentValue, NULL, FALSE);

		// f20170805
		$this->f20170805->SetDbValueDef($rsnew, $this->f20170805->CurrentValue, NULL, FALSE);

		// f20170806
		$this->f20170806->SetDbValueDef($rsnew, $this->f20170806->CurrentValue, NULL, FALSE);

		// f20170807
		$this->f20170807->SetDbValueDef($rsnew, $this->f20170807->CurrentValue, NULL, FALSE);

		// f20170808
		$this->f20170808->SetDbValueDef($rsnew, $this->f20170808->CurrentValue, NULL, FALSE);

		// f20170809
		$this->f20170809->SetDbValueDef($rsnew, $this->f20170809->CurrentValue, NULL, FALSE);

		// f20170810
		$this->f20170810->SetDbValueDef($rsnew, $this->f20170810->CurrentValue, NULL, FALSE);

		// f20170811
		$this->f20170811->SetDbValueDef($rsnew, $this->f20170811->CurrentValue, NULL, FALSE);

		// f20170812
		$this->f20170812->SetDbValueDef($rsnew, $this->f20170812->CurrentValue, NULL, FALSE);

		// f20170813
		$this->f20170813->SetDbValueDef($rsnew, $this->f20170813->CurrentValue, NULL, FALSE);

		// f20170814
		$this->f20170814->SetDbValueDef($rsnew, $this->f20170814->CurrentValue, NULL, FALSE);

		// f20170815
		$this->f20170815->SetDbValueDef($rsnew, $this->f20170815->CurrentValue, NULL, FALSE);

		// f20170816
		$this->f20170816->SetDbValueDef($rsnew, $this->f20170816->CurrentValue, NULL, FALSE);

		// f20170817
		$this->f20170817->SetDbValueDef($rsnew, $this->f20170817->CurrentValue, NULL, FALSE);

		// f20170818
		$this->f20170818->SetDbValueDef($rsnew, $this->f20170818->CurrentValue, NULL, FALSE);

		// f20170819
		$this->f20170819->SetDbValueDef($rsnew, $this->f20170819->CurrentValue, NULL, FALSE);

		// f20170820
		$this->f20170820->SetDbValueDef($rsnew, $this->f20170820->CurrentValue, NULL, FALSE);

		// f20170821
		$this->f20170821->SetDbValueDef($rsnew, $this->f20170821->CurrentValue, NULL, FALSE);

		// f20170822
		$this->f20170822->SetDbValueDef($rsnew, $this->f20170822->CurrentValue, NULL, FALSE);

		// f20170823
		$this->f20170823->SetDbValueDef($rsnew, $this->f20170823->CurrentValue, NULL, FALSE);

		// f20170824
		$this->f20170824->SetDbValueDef($rsnew, $this->f20170824->CurrentValue, NULL, FALSE);

		// f20170825
		$this->f20170825->SetDbValueDef($rsnew, $this->f20170825->CurrentValue, NULL, FALSE);

		// f20170826
		$this->f20170826->SetDbValueDef($rsnew, $this->f20170826->CurrentValue, NULL, FALSE);

		// f20170827
		$this->f20170827->SetDbValueDef($rsnew, $this->f20170827->CurrentValue, NULL, FALSE);

		// f20170828
		$this->f20170828->SetDbValueDef($rsnew, $this->f20170828->CurrentValue, NULL, FALSE);

		// f20170829
		$this->f20170829->SetDbValueDef($rsnew, $this->f20170829->CurrentValue, NULL, FALSE);

		// f20170830
		$this->f20170830->SetDbValueDef($rsnew, $this->f20170830->CurrentValue, NULL, FALSE);

		// f20170831
		$this->f20170831->SetDbValueDef($rsnew, $this->f20170831->CurrentValue, NULL, FALSE);

		// f20170901
		$this->f20170901->SetDbValueDef($rsnew, $this->f20170901->CurrentValue, NULL, FALSE);

		// f20170902
		$this->f20170902->SetDbValueDef($rsnew, $this->f20170902->CurrentValue, NULL, FALSE);

		// f20170903
		$this->f20170903->SetDbValueDef($rsnew, $this->f20170903->CurrentValue, NULL, FALSE);

		// f20170904
		$this->f20170904->SetDbValueDef($rsnew, $this->f20170904->CurrentValue, NULL, FALSE);

		// f20170905
		$this->f20170905->SetDbValueDef($rsnew, $this->f20170905->CurrentValue, NULL, FALSE);

		// f20170906
		$this->f20170906->SetDbValueDef($rsnew, $this->f20170906->CurrentValue, NULL, FALSE);

		// f20170907
		$this->f20170907->SetDbValueDef($rsnew, $this->f20170907->CurrentValue, NULL, FALSE);

		// f20170908
		$this->f20170908->SetDbValueDef($rsnew, $this->f20170908->CurrentValue, NULL, FALSE);

		// f20170909
		$this->f20170909->SetDbValueDef($rsnew, $this->f20170909->CurrentValue, NULL, FALSE);

		// f20170910
		$this->f20170910->SetDbValueDef($rsnew, $this->f20170910->CurrentValue, NULL, FALSE);

		// f20170911
		$this->f20170911->SetDbValueDef($rsnew, $this->f20170911->CurrentValue, NULL, FALSE);

		// f20170912
		$this->f20170912->SetDbValueDef($rsnew, $this->f20170912->CurrentValue, NULL, FALSE);

		// f20170913
		$this->f20170913->SetDbValueDef($rsnew, $this->f20170913->CurrentValue, NULL, FALSE);

		// f20170914
		$this->f20170914->SetDbValueDef($rsnew, $this->f20170914->CurrentValue, NULL, FALSE);

		// f20170915
		$this->f20170915->SetDbValueDef($rsnew, $this->f20170915->CurrentValue, NULL, FALSE);

		// f20170916
		$this->f20170916->SetDbValueDef($rsnew, $this->f20170916->CurrentValue, NULL, FALSE);

		// f20170917
		$this->f20170917->SetDbValueDef($rsnew, $this->f20170917->CurrentValue, NULL, FALSE);

		// f20170918
		$this->f20170918->SetDbValueDef($rsnew, $this->f20170918->CurrentValue, NULL, FALSE);

		// f20170919
		$this->f20170919->SetDbValueDef($rsnew, $this->f20170919->CurrentValue, NULL, FALSE);

		// f20170920
		$this->f20170920->SetDbValueDef($rsnew, $this->f20170920->CurrentValue, NULL, FALSE);

		// f20170921
		$this->f20170921->SetDbValueDef($rsnew, $this->f20170921->CurrentValue, NULL, FALSE);

		// f20170922
		$this->f20170922->SetDbValueDef($rsnew, $this->f20170922->CurrentValue, NULL, FALSE);

		// f20170923
		$this->f20170923->SetDbValueDef($rsnew, $this->f20170923->CurrentValue, NULL, FALSE);

		// f20170924
		$this->f20170924->SetDbValueDef($rsnew, $this->f20170924->CurrentValue, NULL, FALSE);

		// f20170925
		$this->f20170925->SetDbValueDef($rsnew, $this->f20170925->CurrentValue, NULL, FALSE);

		// f20170926
		$this->f20170926->SetDbValueDef($rsnew, $this->f20170926->CurrentValue, NULL, FALSE);

		// f20170927
		$this->f20170927->SetDbValueDef($rsnew, $this->f20170927->CurrentValue, NULL, FALSE);

		// f20170928
		$this->f20170928->SetDbValueDef($rsnew, $this->f20170928->CurrentValue, NULL, FALSE);

		// f20170929
		$this->f20170929->SetDbValueDef($rsnew, $this->f20170929->CurrentValue, NULL, FALSE);

		// f20170930
		$this->f20170930->SetDbValueDef($rsnew, $this->f20170930->CurrentValue, NULL, FALSE);

		// f20171001
		$this->f20171001->SetDbValueDef($rsnew, $this->f20171001->CurrentValue, NULL, FALSE);

		// f20171002
		$this->f20171002->SetDbValueDef($rsnew, $this->f20171002->CurrentValue, NULL, FALSE);

		// f20171003
		$this->f20171003->SetDbValueDef($rsnew, $this->f20171003->CurrentValue, NULL, FALSE);

		// f20171004
		$this->f20171004->SetDbValueDef($rsnew, $this->f20171004->CurrentValue, NULL, FALSE);

		// f20171005
		$this->f20171005->SetDbValueDef($rsnew, $this->f20171005->CurrentValue, NULL, FALSE);

		// f20171006
		$this->f20171006->SetDbValueDef($rsnew, $this->f20171006->CurrentValue, NULL, FALSE);

		// f20171007
		$this->f20171007->SetDbValueDef($rsnew, $this->f20171007->CurrentValue, NULL, FALSE);

		// f20171008
		$this->f20171008->SetDbValueDef($rsnew, $this->f20171008->CurrentValue, NULL, FALSE);

		// f20171009
		$this->f20171009->SetDbValueDef($rsnew, $this->f20171009->CurrentValue, NULL, FALSE);

		// f20171010
		$this->f20171010->SetDbValueDef($rsnew, $this->f20171010->CurrentValue, NULL, FALSE);

		// f20171011
		$this->f20171011->SetDbValueDef($rsnew, $this->f20171011->CurrentValue, NULL, FALSE);

		// f20171012
		$this->f20171012->SetDbValueDef($rsnew, $this->f20171012->CurrentValue, NULL, FALSE);

		// f20171013
		$this->f20171013->SetDbValueDef($rsnew, $this->f20171013->CurrentValue, NULL, FALSE);

		// f20171014
		$this->f20171014->SetDbValueDef($rsnew, $this->f20171014->CurrentValue, NULL, FALSE);

		// f20171015
		$this->f20171015->SetDbValueDef($rsnew, $this->f20171015->CurrentValue, NULL, FALSE);

		// f20171016
		$this->f20171016->SetDbValueDef($rsnew, $this->f20171016->CurrentValue, NULL, FALSE);

		// f20171017
		$this->f20171017->SetDbValueDef($rsnew, $this->f20171017->CurrentValue, NULL, FALSE);

		// f20171018
		$this->f20171018->SetDbValueDef($rsnew, $this->f20171018->CurrentValue, NULL, FALSE);

		// f20171019
		$this->f20171019->SetDbValueDef($rsnew, $this->f20171019->CurrentValue, NULL, FALSE);

		// f20171020
		$this->f20171020->SetDbValueDef($rsnew, $this->f20171020->CurrentValue, NULL, FALSE);

		// f20171021
		$this->f20171021->SetDbValueDef($rsnew, $this->f20171021->CurrentValue, NULL, FALSE);

		// f20171022
		$this->f20171022->SetDbValueDef($rsnew, $this->f20171022->CurrentValue, NULL, FALSE);

		// f20171023
		$this->f20171023->SetDbValueDef($rsnew, $this->f20171023->CurrentValue, NULL, FALSE);

		// f20171024
		$this->f20171024->SetDbValueDef($rsnew, $this->f20171024->CurrentValue, NULL, FALSE);

		// f20171025
		$this->f20171025->SetDbValueDef($rsnew, $this->f20171025->CurrentValue, NULL, FALSE);

		// f20171026
		$this->f20171026->SetDbValueDef($rsnew, $this->f20171026->CurrentValue, NULL, FALSE);

		// f20171027
		$this->f20171027->SetDbValueDef($rsnew, $this->f20171027->CurrentValue, NULL, FALSE);

		// f20171028
		$this->f20171028->SetDbValueDef($rsnew, $this->f20171028->CurrentValue, NULL, FALSE);

		// f20171029
		$this->f20171029->SetDbValueDef($rsnew, $this->f20171029->CurrentValue, NULL, FALSE);

		// f20171030
		$this->f20171030->SetDbValueDef($rsnew, $this->f20171030->CurrentValue, NULL, FALSE);

		// f20171031
		$this->f20171031->SetDbValueDef($rsnew, $this->f20171031->CurrentValue, NULL, FALSE);

		// f20171101
		$this->f20171101->SetDbValueDef($rsnew, $this->f20171101->CurrentValue, NULL, FALSE);

		// f20171102
		$this->f20171102->SetDbValueDef($rsnew, $this->f20171102->CurrentValue, NULL, FALSE);

		// f20171103
		$this->f20171103->SetDbValueDef($rsnew, $this->f20171103->CurrentValue, NULL, FALSE);

		// f20171104
		$this->f20171104->SetDbValueDef($rsnew, $this->f20171104->CurrentValue, NULL, FALSE);

		// f20171105
		$this->f20171105->SetDbValueDef($rsnew, $this->f20171105->CurrentValue, NULL, FALSE);

		// f20171106
		$this->f20171106->SetDbValueDef($rsnew, $this->f20171106->CurrentValue, NULL, FALSE);

		// f20171107
		$this->f20171107->SetDbValueDef($rsnew, $this->f20171107->CurrentValue, NULL, FALSE);

		// f20171108
		$this->f20171108->SetDbValueDef($rsnew, $this->f20171108->CurrentValue, NULL, FALSE);

		// f20171109
		$this->f20171109->SetDbValueDef($rsnew, $this->f20171109->CurrentValue, NULL, FALSE);

		// f20171110
		$this->f20171110->SetDbValueDef($rsnew, $this->f20171110->CurrentValue, NULL, FALSE);

		// f20171111
		$this->f20171111->SetDbValueDef($rsnew, $this->f20171111->CurrentValue, NULL, FALSE);

		// f20171112
		$this->f20171112->SetDbValueDef($rsnew, $this->f20171112->CurrentValue, NULL, FALSE);

		// f20171113
		$this->f20171113->SetDbValueDef($rsnew, $this->f20171113->CurrentValue, NULL, FALSE);

		// f20171114
		$this->f20171114->SetDbValueDef($rsnew, $this->f20171114->CurrentValue, NULL, FALSE);

		// f20171115
		$this->f20171115->SetDbValueDef($rsnew, $this->f20171115->CurrentValue, NULL, FALSE);

		// f20171116
		$this->f20171116->SetDbValueDef($rsnew, $this->f20171116->CurrentValue, NULL, FALSE);

		// f20171117
		$this->f20171117->SetDbValueDef($rsnew, $this->f20171117->CurrentValue, NULL, FALSE);

		// f20171118
		$this->f20171118->SetDbValueDef($rsnew, $this->f20171118->CurrentValue, NULL, FALSE);

		// f20171119
		$this->f20171119->SetDbValueDef($rsnew, $this->f20171119->CurrentValue, NULL, FALSE);

		// f20171120
		$this->f20171120->SetDbValueDef($rsnew, $this->f20171120->CurrentValue, NULL, FALSE);

		// f20171121
		$this->f20171121->SetDbValueDef($rsnew, $this->f20171121->CurrentValue, NULL, FALSE);

		// f20171122
		$this->f20171122->SetDbValueDef($rsnew, $this->f20171122->CurrentValue, NULL, FALSE);

		// f20171123
		$this->f20171123->SetDbValueDef($rsnew, $this->f20171123->CurrentValue, NULL, FALSE);

		// f20171124
		$this->f20171124->SetDbValueDef($rsnew, $this->f20171124->CurrentValue, NULL, FALSE);

		// f20171125
		$this->f20171125->SetDbValueDef($rsnew, $this->f20171125->CurrentValue, NULL, FALSE);

		// f20171126
		$this->f20171126->SetDbValueDef($rsnew, $this->f20171126->CurrentValue, NULL, FALSE);

		// f20171127
		$this->f20171127->SetDbValueDef($rsnew, $this->f20171127->CurrentValue, NULL, FALSE);

		// f20171128
		$this->f20171128->SetDbValueDef($rsnew, $this->f20171128->CurrentValue, NULL, FALSE);

		// f20171129
		$this->f20171129->SetDbValueDef($rsnew, $this->f20171129->CurrentValue, NULL, FALSE);

		// f20171130
		$this->f20171130->SetDbValueDef($rsnew, $this->f20171130->CurrentValue, NULL, FALSE);

		// f20171201
		$this->f20171201->SetDbValueDef($rsnew, $this->f20171201->CurrentValue, NULL, FALSE);

		// f20171202
		$this->f20171202->SetDbValueDef($rsnew, $this->f20171202->CurrentValue, NULL, FALSE);

		// f20171203
		$this->f20171203->SetDbValueDef($rsnew, $this->f20171203->CurrentValue, NULL, FALSE);

		// f20171204
		$this->f20171204->SetDbValueDef($rsnew, $this->f20171204->CurrentValue, NULL, FALSE);

		// f20171205
		$this->f20171205->SetDbValueDef($rsnew, $this->f20171205->CurrentValue, NULL, FALSE);

		// f20171206
		$this->f20171206->SetDbValueDef($rsnew, $this->f20171206->CurrentValue, NULL, FALSE);

		// f20171207
		$this->f20171207->SetDbValueDef($rsnew, $this->f20171207->CurrentValue, NULL, FALSE);

		// f20171208
		$this->f20171208->SetDbValueDef($rsnew, $this->f20171208->CurrentValue, NULL, FALSE);

		// f20171209
		$this->f20171209->SetDbValueDef($rsnew, $this->f20171209->CurrentValue, NULL, FALSE);

		// f20171210
		$this->f20171210->SetDbValueDef($rsnew, $this->f20171210->CurrentValue, NULL, FALSE);

		// f20171211
		$this->f20171211->SetDbValueDef($rsnew, $this->f20171211->CurrentValue, NULL, FALSE);

		// f20171212
		$this->f20171212->SetDbValueDef($rsnew, $this->f20171212->CurrentValue, NULL, FALSE);

		// f20171213
		$this->f20171213->SetDbValueDef($rsnew, $this->f20171213->CurrentValue, NULL, FALSE);

		// f20171214
		$this->f20171214->SetDbValueDef($rsnew, $this->f20171214->CurrentValue, NULL, FALSE);

		// f20171215
		$this->f20171215->SetDbValueDef($rsnew, $this->f20171215->CurrentValue, NULL, FALSE);

		// f20171216
		$this->f20171216->SetDbValueDef($rsnew, $this->f20171216->CurrentValue, NULL, FALSE);

		// f20171217
		$this->f20171217->SetDbValueDef($rsnew, $this->f20171217->CurrentValue, NULL, FALSE);

		// f20171218
		$this->f20171218->SetDbValueDef($rsnew, $this->f20171218->CurrentValue, NULL, FALSE);

		// f20171219
		$this->f20171219->SetDbValueDef($rsnew, $this->f20171219->CurrentValue, NULL, FALSE);

		// f20171220
		$this->f20171220->SetDbValueDef($rsnew, $this->f20171220->CurrentValue, NULL, FALSE);

		// f20171221
		$this->f20171221->SetDbValueDef($rsnew, $this->f20171221->CurrentValue, NULL, FALSE);

		// f20171222
		$this->f20171222->SetDbValueDef($rsnew, $this->f20171222->CurrentValue, NULL, FALSE);

		// f20171223
		$this->f20171223->SetDbValueDef($rsnew, $this->f20171223->CurrentValue, NULL, FALSE);

		// f20171224
		$this->f20171224->SetDbValueDef($rsnew, $this->f20171224->CurrentValue, NULL, FALSE);

		// f20171225
		$this->f20171225->SetDbValueDef($rsnew, $this->f20171225->CurrentValue, NULL, FALSE);

		// f20171226
		$this->f20171226->SetDbValueDef($rsnew, $this->f20171226->CurrentValue, NULL, FALSE);

		// f20171227
		$this->f20171227->SetDbValueDef($rsnew, $this->f20171227->CurrentValue, NULL, FALSE);

		// f20171228
		$this->f20171228->SetDbValueDef($rsnew, $this->f20171228->CurrentValue, NULL, FALSE);

		// f20171229
		$this->f20171229->SetDbValueDef($rsnew, $this->f20171229->CurrentValue, NULL, FALSE);

		// f20171230
		$this->f20171230->SetDbValueDef($rsnew, $this->f20171230->CurrentValue, NULL, FALSE);

		// f20171231
		$this->f20171231->SetDbValueDef($rsnew, $this->f20171231->CurrentValue, NULL, FALSE);

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t_jd_krj_peglist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_f20170102":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `jk_id` AS `LinkFld`, `jk_nm` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t_jk`";
			$sWhereWrk = "{filter}";
			$this->f20170102->LookupFilters = array("dx1" => '`jk_nm`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`jk_id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->f20170102, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_f20171231":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `jk_id` AS `LinkFld`, `jk_nm` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t_jk`";
			$sWhereWrk = "{filter}";
			$this->f20171231->LookupFilters = array("dx1" => '`jk_nm`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`jk_id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->f20171231, $sWhereWrk); // Call Lookup selecting
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
		case "x_f20170102":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `jk_id`, `jk_nm` AS `DispFld` FROM `t_jk`";
			$sWhereWrk = "`jk_nm` LIKE '{query_value}%'";
			$this->f20170102->LookupFilters = array("dx1" => '`jk_nm`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->f20170102, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " LIMIT " . EW_AUTO_SUGGEST_MAX_ENTRIES;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_f20171231":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `jk_id`, `jk_nm` AS `DispFld` FROM `t_jk`";
			$sWhereWrk = "`jk_nm` LIKE '{query_value}%'";
			$this->f20171231->LookupFilters = array("dx1" => '`jk_nm`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->f20171231, $sWhereWrk); // Call Lookup selecting
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
if (!isset($t_jd_krj_peg_add)) $t_jd_krj_peg_add = new ct_jd_krj_peg_add();

// Page init
$t_jd_krj_peg_add->Page_Init();

// Page main
$t_jd_krj_peg_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_jd_krj_peg_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = ft_jd_krj_pegadd = new ew_Form("ft_jd_krj_pegadd", "add");

// Validate form
ft_jd_krj_pegadd.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t_jd_krj_peg->pegawai_id->FldCaption(), $t_jd_krj_peg->pegawai_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_pegawai_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->pegawai_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170101");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170101->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170103");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170103->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170104");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170104->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170105");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170105->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170106");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170106->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170107");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170107->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170108");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170108->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170109");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170109->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170110");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170110->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170111");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170111->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170112");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170112->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170113");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170113->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170114");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170114->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170115");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170115->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170116");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170116->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170117");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170117->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170118");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170118->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170119");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170119->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170120");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170120->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170121");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170121->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170122");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170122->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170123");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170123->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170124");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170124->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170125");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170125->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170126");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170126->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170127");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170127->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170128");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170128->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170129");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170129->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170130");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170130->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170131");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170131->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170201");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170201->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170202");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170202->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170203");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170203->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170204");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170204->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170205");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170205->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170206");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170206->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170207");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170207->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170208");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170208->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170209");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170209->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170210");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170210->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170211");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170211->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170212");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170212->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170213");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170213->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170214");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170214->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170215");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170215->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170216");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170216->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170217");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170217->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170218");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170218->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170219");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170219->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170220");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170220->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170221");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170221->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170222");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170222->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170223");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170223->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170224");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170224->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170225");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170225->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170226");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170226->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170227");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170227->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170228");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170228->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170229");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170229->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170301");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170301->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170302");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170302->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170303");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170303->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170304");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170304->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170305");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170305->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170306");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170306->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170307");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170307->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170308");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170308->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170309");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170309->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170310");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170310->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170311");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170311->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170312");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170312->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170313");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170313->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170314");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170314->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170315");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170315->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170316");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170316->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170317");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170317->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170318");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170318->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170319");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170319->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170320");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170320->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170321");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170321->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170322");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170322->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170323");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170323->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170324");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170324->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170325");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170325->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170326");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170326->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170327");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170327->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170328");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170328->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170329");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170329->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170330");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170330->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170331");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170331->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170401");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170401->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170402");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170402->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170403");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170403->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170404");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170404->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170405");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170405->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170406");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170406->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170407");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170407->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170408");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170408->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170409");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170409->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170410");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170410->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170411");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170411->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170412");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170412->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170413");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170413->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170414");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170414->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170415");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170415->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170416");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170416->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170417");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170417->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170418");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170418->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170419");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170419->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170420");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170420->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170421");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170421->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170422");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170422->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170423");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170423->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170424");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170424->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170425");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170425->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170426");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170426->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170427");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170427->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170428");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170428->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170429");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170429->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170430");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170430->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170501");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170501->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170502");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170502->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170503");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170503->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170504");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170504->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170505");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170505->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170506");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170506->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170507");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170507->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170508");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170508->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170509");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170509->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170510");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170510->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170511");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170511->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170512");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170512->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170513");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170513->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170514");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170514->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170515");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170515->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170516");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170516->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170517");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170517->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170518");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170518->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170519");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170519->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170520");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170520->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170521");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170521->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170522");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170522->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170523");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170523->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170524");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170524->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170525");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170525->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170526");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170526->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170527");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170527->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170528");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170528->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170529");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170529->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170530");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170530->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170531");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170531->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170601");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170601->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170602");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170602->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170603");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170603->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170604");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170604->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170605");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170605->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170606");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170606->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170607");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170607->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170608");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170608->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170609");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170609->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170610");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170610->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170611");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170611->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170612");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170612->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170613");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170613->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170614");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170614->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170615");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170615->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170616");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170616->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170617");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170617->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170618");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170618->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170619");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170619->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170620");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170620->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170621");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170621->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170622");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170622->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170623");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170623->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170624");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170624->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170625");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170625->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170626");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170626->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170627");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170627->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170628");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170628->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170629");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170629->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170630");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170630->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170701");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170701->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170702");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170702->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170703");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170703->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170704");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170704->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170705");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170705->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170706");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170706->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170707");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170707->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170708");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170708->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170709");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170709->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170710");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170710->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170711");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170711->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170712");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170712->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170713");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170713->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170714");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170714->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170715");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170715->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170716");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170716->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170717");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170717->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170718");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170718->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170719");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170719->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170720");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170720->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170721");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170721->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170722");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170722->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170723");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170723->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170724");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170724->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170725");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170725->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170726");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170726->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170727");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170727->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170728");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170728->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170729");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170729->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170730");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170730->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170731");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170731->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170801");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170801->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170802");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170802->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170803");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170803->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170804");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170804->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170805");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170805->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170806");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170806->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170807");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170807->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170808");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170808->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170809");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170809->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170810");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170810->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170811");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170811->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170812");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170812->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170813");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170813->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170814");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170814->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170815");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170815->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170816");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170816->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170817");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170817->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170818");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170818->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170819");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170819->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170820");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170820->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170821");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170821->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170822");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170822->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170823");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170823->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170824");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170824->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170825");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170825->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170826");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170826->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170827");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170827->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170828");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170828->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170829");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170829->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170830");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170830->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170831");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170831->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170901");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170901->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170902");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170902->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170903");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170903->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170904");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170904->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170905");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170905->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170906");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170906->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170907");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170907->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170908");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170908->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170909");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170909->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170910");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170910->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170911");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170911->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170912");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170912->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170913");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170913->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170914");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170914->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170915");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170915->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170916");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170916->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170917");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170917->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170918");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170918->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170919");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170919->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170920");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170920->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170921");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170921->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170922");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170922->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170923");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170923->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170924");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170924->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170925");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170925->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170926");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170926->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170927");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170927->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170928");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170928->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170929");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170929->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20170930");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20170930->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171001");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171001->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171002");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171002->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171003");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171003->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171004");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171004->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171005");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171005->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171006");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171006->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171007");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171007->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171008");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171008->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171009");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171009->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171010");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171010->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171011");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171011->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171012");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171012->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171013");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171013->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171014");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171014->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171015");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171015->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171016");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171016->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171017");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171017->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171018");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171018->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171019");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171019->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171020");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171020->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171021");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171021->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171022");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171022->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171023");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171023->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171024");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171024->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171025");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171025->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171026");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171026->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171027");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171027->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171028");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171028->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171029");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171029->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171030");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171030->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171031");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171031->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171101");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171101->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171102");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171102->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171103");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171103->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171104");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171104->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171105");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171105->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171106");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171106->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171107");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171107->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171108");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171108->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171109");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171109->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171110");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171110->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171111");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171111->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171112");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171112->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171113");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171113->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171114");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171114->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171115");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171115->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171116");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171116->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171117");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171117->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171118");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171118->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171119");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171119->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171120");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171120->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171121");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171121->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171122");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171122->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171123");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171123->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171124");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171124->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171125");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171125->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171126");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171126->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171127");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171127->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171128");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171128->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171129");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171129->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171130");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171130->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171201");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171201->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171202");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171202->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171203");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171203->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171204");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171204->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171205");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171205->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171206");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171206->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171207");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171207->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171208");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171208->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171209");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171209->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171210");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171210->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171211");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171211->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171212");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171212->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171213");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171213->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171214");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171214->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171215");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171215->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171216");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171216->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171217");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171217->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171218");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171218->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171219");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171219->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171220");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171220->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171221");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171221->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171222");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171222->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171223");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171223->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171224");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171224->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171225");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171225->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171226");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171226->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171227");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171227->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171228");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171228->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171229");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171229->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_f20171230");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t_jd_krj_peg->f20171230->FldErrMsg()) ?>");

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
ft_jd_krj_pegadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft_jd_krj_pegadd.ValidateRequired = true;
<?php } else { ?>
ft_jd_krj_pegadd.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft_jd_krj_pegadd.Lists["x_f20170102"] = {"LinkField":"x_jk_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_jk_nm","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t_jk"};
ft_jd_krj_pegadd.Lists["x_f20171231"] = {"LinkField":"x_jk_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_jk_nm","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t_jk"};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$t_jd_krj_peg_add->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t_jd_krj_peg_add->ShowPageHeader(); ?>
<?php
$t_jd_krj_peg_add->ShowMessage();
?>
<form name="ft_jd_krj_pegadd" id="ft_jd_krj_pegadd" class="<?php echo $t_jd_krj_peg_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t_jd_krj_peg_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t_jd_krj_peg_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_jd_krj_peg">
<input type="hidden" name="a_add" id="a_add" value="A">
<?php if ($t_jd_krj_peg_add->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div>
<?php if ($t_jd_krj_peg->pegawai_id->Visible) { // pegawai_id ?>
	<div id="r_pegawai_id" class="form-group">
		<label id="elh_t_jd_krj_peg_pegawai_id" for="x_pegawai_id" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->pegawai_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->pegawai_id->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_pegawai_id">
<input type="text" data-table="t_jd_krj_peg" data-field="x_pegawai_id" name="x_pegawai_id" id="x_pegawai_id" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->pegawai_id->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->pegawai_id->EditValue ?>"<?php echo $t_jd_krj_peg->pegawai_id->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->pegawai_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170101->Visible) { // f20170101 ?>
	<div id="r_f20170101" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170101" for="x_f20170101" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170101->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170101->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170101">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170101" name="x_f20170101" id="x_f20170101" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170101->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170101->EditValue ?>"<?php echo $t_jd_krj_peg->f20170101->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170101->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170102->Visible) { // f20170102 ?>
	<div id="r_f20170102" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170102" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170102->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170102->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170102">
<?php
$wrkonchange = trim(" " . @$t_jd_krj_peg->f20170102->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t_jd_krj_peg->f20170102->EditAttrs["onchange"] = "";
?>
<span id="as_x_f20170102" style="white-space: nowrap; z-index: 8960">
	<input type="text" name="sv_x_f20170102" id="sv_x_f20170102" value="<?php echo $t_jd_krj_peg->f20170102->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170102->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170102->getPlaceHolder()) ?>"<?php echo $t_jd_krj_peg->f20170102->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t_jd_krj_peg" data-field="x_f20170102" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_jd_krj_peg->f20170102->DisplayValueSeparatorAttribute() ?>" name="x_f20170102" id="x_f20170102" value="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170102->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x_f20170102" id="q_x_f20170102" value="<?php echo $t_jd_krj_peg->f20170102->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft_jd_krj_pegadd.CreateAutoSuggest({"id":"x_f20170102","forceSelect":true});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t_jd_krj_peg->f20170102->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_f20170102',m:0,n:10,srch:false});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" name="s_x_f20170102" id="s_x_f20170102" value="<?php echo $t_jd_krj_peg->f20170102->LookupFilterQuery(false) ?>">
</span>
<?php echo $t_jd_krj_peg->f20170102->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170103->Visible) { // f20170103 ?>
	<div id="r_f20170103" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170103" for="x_f20170103" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170103->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170103->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170103">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170103" name="x_f20170103" id="x_f20170103" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170103->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170103->EditValue ?>"<?php echo $t_jd_krj_peg->f20170103->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170103->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170104->Visible) { // f20170104 ?>
	<div id="r_f20170104" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170104" for="x_f20170104" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170104->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170104->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170104">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170104" name="x_f20170104" id="x_f20170104" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170104->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170104->EditValue ?>"<?php echo $t_jd_krj_peg->f20170104->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170104->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170105->Visible) { // f20170105 ?>
	<div id="r_f20170105" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170105" for="x_f20170105" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170105->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170105->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170105">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170105" name="x_f20170105" id="x_f20170105" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170105->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170105->EditValue ?>"<?php echo $t_jd_krj_peg->f20170105->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170105->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170106->Visible) { // f20170106 ?>
	<div id="r_f20170106" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170106" for="x_f20170106" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170106->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170106->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170106">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170106" name="x_f20170106" id="x_f20170106" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170106->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170106->EditValue ?>"<?php echo $t_jd_krj_peg->f20170106->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170106->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170107->Visible) { // f20170107 ?>
	<div id="r_f20170107" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170107" for="x_f20170107" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170107->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170107->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170107">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170107" name="x_f20170107" id="x_f20170107" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170107->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170107->EditValue ?>"<?php echo $t_jd_krj_peg->f20170107->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170107->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170108->Visible) { // f20170108 ?>
	<div id="r_f20170108" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170108" for="x_f20170108" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170108->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170108->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170108">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170108" name="x_f20170108" id="x_f20170108" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170108->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170108->EditValue ?>"<?php echo $t_jd_krj_peg->f20170108->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170108->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170109->Visible) { // f20170109 ?>
	<div id="r_f20170109" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170109" for="x_f20170109" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170109->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170109->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170109">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170109" name="x_f20170109" id="x_f20170109" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170109->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170109->EditValue ?>"<?php echo $t_jd_krj_peg->f20170109->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170109->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170110->Visible) { // f20170110 ?>
	<div id="r_f20170110" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170110" for="x_f20170110" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170110->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170110->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170110">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170110" name="x_f20170110" id="x_f20170110" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170110->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170110->EditValue ?>"<?php echo $t_jd_krj_peg->f20170110->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170110->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170111->Visible) { // f20170111 ?>
	<div id="r_f20170111" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170111" for="x_f20170111" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170111->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170111->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170111">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170111" name="x_f20170111" id="x_f20170111" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170111->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170111->EditValue ?>"<?php echo $t_jd_krj_peg->f20170111->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170111->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170112->Visible) { // f20170112 ?>
	<div id="r_f20170112" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170112" for="x_f20170112" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170112->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170112->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170112">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170112" name="x_f20170112" id="x_f20170112" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170112->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170112->EditValue ?>"<?php echo $t_jd_krj_peg->f20170112->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170112->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170113->Visible) { // f20170113 ?>
	<div id="r_f20170113" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170113" for="x_f20170113" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170113->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170113->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170113">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170113" name="x_f20170113" id="x_f20170113" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170113->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170113->EditValue ?>"<?php echo $t_jd_krj_peg->f20170113->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170113->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170114->Visible) { // f20170114 ?>
	<div id="r_f20170114" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170114" for="x_f20170114" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170114->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170114->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170114">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170114" name="x_f20170114" id="x_f20170114" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170114->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170114->EditValue ?>"<?php echo $t_jd_krj_peg->f20170114->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170114->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170115->Visible) { // f20170115 ?>
	<div id="r_f20170115" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170115" for="x_f20170115" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170115->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170115->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170115">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170115" name="x_f20170115" id="x_f20170115" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170115->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170115->EditValue ?>"<?php echo $t_jd_krj_peg->f20170115->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170115->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170116->Visible) { // f20170116 ?>
	<div id="r_f20170116" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170116" for="x_f20170116" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170116->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170116->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170116">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170116" name="x_f20170116" id="x_f20170116" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170116->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170116->EditValue ?>"<?php echo $t_jd_krj_peg->f20170116->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170116->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170117->Visible) { // f20170117 ?>
	<div id="r_f20170117" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170117" for="x_f20170117" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170117->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170117->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170117">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170117" name="x_f20170117" id="x_f20170117" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170117->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170117->EditValue ?>"<?php echo $t_jd_krj_peg->f20170117->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170117->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170118->Visible) { // f20170118 ?>
	<div id="r_f20170118" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170118" for="x_f20170118" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170118->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170118->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170118">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170118" name="x_f20170118" id="x_f20170118" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170118->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170118->EditValue ?>"<?php echo $t_jd_krj_peg->f20170118->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170118->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170119->Visible) { // f20170119 ?>
	<div id="r_f20170119" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170119" for="x_f20170119" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170119->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170119->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170119">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170119" name="x_f20170119" id="x_f20170119" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170119->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170119->EditValue ?>"<?php echo $t_jd_krj_peg->f20170119->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170119->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170120->Visible) { // f20170120 ?>
	<div id="r_f20170120" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170120" for="x_f20170120" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170120->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170120->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170120">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170120" name="x_f20170120" id="x_f20170120" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170120->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170120->EditValue ?>"<?php echo $t_jd_krj_peg->f20170120->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170120->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170121->Visible) { // f20170121 ?>
	<div id="r_f20170121" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170121" for="x_f20170121" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170121->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170121->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170121">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170121" name="x_f20170121" id="x_f20170121" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170121->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170121->EditValue ?>"<?php echo $t_jd_krj_peg->f20170121->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170121->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170122->Visible) { // f20170122 ?>
	<div id="r_f20170122" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170122" for="x_f20170122" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170122->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170122->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170122">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170122" name="x_f20170122" id="x_f20170122" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170122->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170122->EditValue ?>"<?php echo $t_jd_krj_peg->f20170122->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170122->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170123->Visible) { // f20170123 ?>
	<div id="r_f20170123" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170123" for="x_f20170123" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170123->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170123->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170123">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170123" name="x_f20170123" id="x_f20170123" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170123->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170123->EditValue ?>"<?php echo $t_jd_krj_peg->f20170123->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170123->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170124->Visible) { // f20170124 ?>
	<div id="r_f20170124" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170124" for="x_f20170124" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170124->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170124->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170124">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170124" name="x_f20170124" id="x_f20170124" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170124->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170124->EditValue ?>"<?php echo $t_jd_krj_peg->f20170124->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170124->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170125->Visible) { // f20170125 ?>
	<div id="r_f20170125" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170125" for="x_f20170125" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170125->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170125->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170125">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170125" name="x_f20170125" id="x_f20170125" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170125->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170125->EditValue ?>"<?php echo $t_jd_krj_peg->f20170125->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170125->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170126->Visible) { // f20170126 ?>
	<div id="r_f20170126" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170126" for="x_f20170126" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170126->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170126->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170126">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170126" name="x_f20170126" id="x_f20170126" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170126->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170126->EditValue ?>"<?php echo $t_jd_krj_peg->f20170126->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170126->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170127->Visible) { // f20170127 ?>
	<div id="r_f20170127" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170127" for="x_f20170127" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170127->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170127->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170127">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170127" name="x_f20170127" id="x_f20170127" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170127->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170127->EditValue ?>"<?php echo $t_jd_krj_peg->f20170127->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170127->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170128->Visible) { // f20170128 ?>
	<div id="r_f20170128" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170128" for="x_f20170128" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170128->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170128->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170128">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170128" name="x_f20170128" id="x_f20170128" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170128->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170128->EditValue ?>"<?php echo $t_jd_krj_peg->f20170128->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170128->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170129->Visible) { // f20170129 ?>
	<div id="r_f20170129" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170129" for="x_f20170129" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170129->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170129->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170129">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170129" name="x_f20170129" id="x_f20170129" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170129->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170129->EditValue ?>"<?php echo $t_jd_krj_peg->f20170129->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170129->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170130->Visible) { // f20170130 ?>
	<div id="r_f20170130" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170130" for="x_f20170130" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170130->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170130->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170130">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170130" name="x_f20170130" id="x_f20170130" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170130->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170130->EditValue ?>"<?php echo $t_jd_krj_peg->f20170130->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170130->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170131->Visible) { // f20170131 ?>
	<div id="r_f20170131" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170131" for="x_f20170131" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170131->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170131->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170131">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170131" name="x_f20170131" id="x_f20170131" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170131->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170131->EditValue ?>"<?php echo $t_jd_krj_peg->f20170131->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170131->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170201->Visible) { // f20170201 ?>
	<div id="r_f20170201" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170201" for="x_f20170201" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170201->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170201->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170201">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170201" name="x_f20170201" id="x_f20170201" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170201->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170201->EditValue ?>"<?php echo $t_jd_krj_peg->f20170201->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170201->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170202->Visible) { // f20170202 ?>
	<div id="r_f20170202" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170202" for="x_f20170202" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170202->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170202->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170202">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170202" name="x_f20170202" id="x_f20170202" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170202->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170202->EditValue ?>"<?php echo $t_jd_krj_peg->f20170202->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170202->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170203->Visible) { // f20170203 ?>
	<div id="r_f20170203" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170203" for="x_f20170203" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170203->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170203->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170203">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170203" name="x_f20170203" id="x_f20170203" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170203->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170203->EditValue ?>"<?php echo $t_jd_krj_peg->f20170203->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170203->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170204->Visible) { // f20170204 ?>
	<div id="r_f20170204" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170204" for="x_f20170204" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170204->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170204->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170204">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170204" name="x_f20170204" id="x_f20170204" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170204->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170204->EditValue ?>"<?php echo $t_jd_krj_peg->f20170204->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170204->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170205->Visible) { // f20170205 ?>
	<div id="r_f20170205" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170205" for="x_f20170205" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170205->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170205->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170205">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170205" name="x_f20170205" id="x_f20170205" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170205->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170205->EditValue ?>"<?php echo $t_jd_krj_peg->f20170205->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170205->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170206->Visible) { // f20170206 ?>
	<div id="r_f20170206" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170206" for="x_f20170206" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170206->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170206->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170206">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170206" name="x_f20170206" id="x_f20170206" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170206->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170206->EditValue ?>"<?php echo $t_jd_krj_peg->f20170206->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170206->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170207->Visible) { // f20170207 ?>
	<div id="r_f20170207" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170207" for="x_f20170207" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170207->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170207->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170207">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170207" name="x_f20170207" id="x_f20170207" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170207->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170207->EditValue ?>"<?php echo $t_jd_krj_peg->f20170207->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170207->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170208->Visible) { // f20170208 ?>
	<div id="r_f20170208" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170208" for="x_f20170208" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170208->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170208->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170208">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170208" name="x_f20170208" id="x_f20170208" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170208->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170208->EditValue ?>"<?php echo $t_jd_krj_peg->f20170208->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170208->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170209->Visible) { // f20170209 ?>
	<div id="r_f20170209" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170209" for="x_f20170209" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170209->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170209->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170209">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170209" name="x_f20170209" id="x_f20170209" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170209->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170209->EditValue ?>"<?php echo $t_jd_krj_peg->f20170209->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170209->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170210->Visible) { // f20170210 ?>
	<div id="r_f20170210" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170210" for="x_f20170210" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170210->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170210->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170210">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170210" name="x_f20170210" id="x_f20170210" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170210->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170210->EditValue ?>"<?php echo $t_jd_krj_peg->f20170210->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170210->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170211->Visible) { // f20170211 ?>
	<div id="r_f20170211" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170211" for="x_f20170211" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170211->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170211->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170211">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170211" name="x_f20170211" id="x_f20170211" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170211->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170211->EditValue ?>"<?php echo $t_jd_krj_peg->f20170211->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170211->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170212->Visible) { // f20170212 ?>
	<div id="r_f20170212" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170212" for="x_f20170212" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170212->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170212->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170212">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170212" name="x_f20170212" id="x_f20170212" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170212->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170212->EditValue ?>"<?php echo $t_jd_krj_peg->f20170212->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170212->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170213->Visible) { // f20170213 ?>
	<div id="r_f20170213" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170213" for="x_f20170213" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170213->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170213->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170213">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170213" name="x_f20170213" id="x_f20170213" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170213->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170213->EditValue ?>"<?php echo $t_jd_krj_peg->f20170213->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170213->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170214->Visible) { // f20170214 ?>
	<div id="r_f20170214" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170214" for="x_f20170214" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170214->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170214->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170214">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170214" name="x_f20170214" id="x_f20170214" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170214->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170214->EditValue ?>"<?php echo $t_jd_krj_peg->f20170214->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170214->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170215->Visible) { // f20170215 ?>
	<div id="r_f20170215" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170215" for="x_f20170215" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170215->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170215->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170215">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170215" name="x_f20170215" id="x_f20170215" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170215->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170215->EditValue ?>"<?php echo $t_jd_krj_peg->f20170215->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170215->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170216->Visible) { // f20170216 ?>
	<div id="r_f20170216" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170216" for="x_f20170216" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170216->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170216->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170216">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170216" name="x_f20170216" id="x_f20170216" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170216->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170216->EditValue ?>"<?php echo $t_jd_krj_peg->f20170216->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170216->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170217->Visible) { // f20170217 ?>
	<div id="r_f20170217" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170217" for="x_f20170217" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170217->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170217->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170217">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170217" name="x_f20170217" id="x_f20170217" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170217->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170217->EditValue ?>"<?php echo $t_jd_krj_peg->f20170217->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170217->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170218->Visible) { // f20170218 ?>
	<div id="r_f20170218" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170218" for="x_f20170218" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170218->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170218->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170218">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170218" name="x_f20170218" id="x_f20170218" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170218->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170218->EditValue ?>"<?php echo $t_jd_krj_peg->f20170218->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170218->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170219->Visible) { // f20170219 ?>
	<div id="r_f20170219" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170219" for="x_f20170219" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170219->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170219->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170219">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170219" name="x_f20170219" id="x_f20170219" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170219->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170219->EditValue ?>"<?php echo $t_jd_krj_peg->f20170219->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170219->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170220->Visible) { // f20170220 ?>
	<div id="r_f20170220" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170220" for="x_f20170220" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170220->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170220->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170220">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170220" name="x_f20170220" id="x_f20170220" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170220->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170220->EditValue ?>"<?php echo $t_jd_krj_peg->f20170220->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170220->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170221->Visible) { // f20170221 ?>
	<div id="r_f20170221" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170221" for="x_f20170221" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170221->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170221->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170221">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170221" name="x_f20170221" id="x_f20170221" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170221->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170221->EditValue ?>"<?php echo $t_jd_krj_peg->f20170221->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170221->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170222->Visible) { // f20170222 ?>
	<div id="r_f20170222" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170222" for="x_f20170222" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170222->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170222->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170222">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170222" name="x_f20170222" id="x_f20170222" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170222->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170222->EditValue ?>"<?php echo $t_jd_krj_peg->f20170222->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170222->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170223->Visible) { // f20170223 ?>
	<div id="r_f20170223" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170223" for="x_f20170223" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170223->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170223->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170223">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170223" name="x_f20170223" id="x_f20170223" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170223->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170223->EditValue ?>"<?php echo $t_jd_krj_peg->f20170223->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170223->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170224->Visible) { // f20170224 ?>
	<div id="r_f20170224" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170224" for="x_f20170224" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170224->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170224->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170224">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170224" name="x_f20170224" id="x_f20170224" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170224->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170224->EditValue ?>"<?php echo $t_jd_krj_peg->f20170224->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170224->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170225->Visible) { // f20170225 ?>
	<div id="r_f20170225" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170225" for="x_f20170225" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170225->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170225->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170225">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170225" name="x_f20170225" id="x_f20170225" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170225->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170225->EditValue ?>"<?php echo $t_jd_krj_peg->f20170225->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170225->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170226->Visible) { // f20170226 ?>
	<div id="r_f20170226" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170226" for="x_f20170226" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170226->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170226->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170226">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170226" name="x_f20170226" id="x_f20170226" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170226->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170226->EditValue ?>"<?php echo $t_jd_krj_peg->f20170226->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170226->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170227->Visible) { // f20170227 ?>
	<div id="r_f20170227" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170227" for="x_f20170227" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170227->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170227->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170227">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170227" name="x_f20170227" id="x_f20170227" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170227->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170227->EditValue ?>"<?php echo $t_jd_krj_peg->f20170227->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170227->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170228->Visible) { // f20170228 ?>
	<div id="r_f20170228" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170228" for="x_f20170228" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170228->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170228->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170228">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170228" name="x_f20170228" id="x_f20170228" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170228->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170228->EditValue ?>"<?php echo $t_jd_krj_peg->f20170228->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170228->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170229->Visible) { // f20170229 ?>
	<div id="r_f20170229" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170229" for="x_f20170229" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170229->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170229->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170229">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170229" name="x_f20170229" id="x_f20170229" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170229->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170229->EditValue ?>"<?php echo $t_jd_krj_peg->f20170229->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170229->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170301->Visible) { // f20170301 ?>
	<div id="r_f20170301" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170301" for="x_f20170301" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170301->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170301->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170301">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170301" name="x_f20170301" id="x_f20170301" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170301->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170301->EditValue ?>"<?php echo $t_jd_krj_peg->f20170301->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170301->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170302->Visible) { // f20170302 ?>
	<div id="r_f20170302" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170302" for="x_f20170302" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170302->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170302->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170302">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170302" name="x_f20170302" id="x_f20170302" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170302->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170302->EditValue ?>"<?php echo $t_jd_krj_peg->f20170302->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170302->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170303->Visible) { // f20170303 ?>
	<div id="r_f20170303" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170303" for="x_f20170303" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170303->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170303->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170303">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170303" name="x_f20170303" id="x_f20170303" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170303->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170303->EditValue ?>"<?php echo $t_jd_krj_peg->f20170303->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170303->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170304->Visible) { // f20170304 ?>
	<div id="r_f20170304" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170304" for="x_f20170304" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170304->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170304->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170304">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170304" name="x_f20170304" id="x_f20170304" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170304->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170304->EditValue ?>"<?php echo $t_jd_krj_peg->f20170304->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170304->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170305->Visible) { // f20170305 ?>
	<div id="r_f20170305" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170305" for="x_f20170305" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170305->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170305->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170305">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170305" name="x_f20170305" id="x_f20170305" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170305->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170305->EditValue ?>"<?php echo $t_jd_krj_peg->f20170305->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170305->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170306->Visible) { // f20170306 ?>
	<div id="r_f20170306" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170306" for="x_f20170306" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170306->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170306->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170306">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170306" name="x_f20170306" id="x_f20170306" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170306->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170306->EditValue ?>"<?php echo $t_jd_krj_peg->f20170306->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170306->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170307->Visible) { // f20170307 ?>
	<div id="r_f20170307" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170307" for="x_f20170307" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170307->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170307->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170307">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170307" name="x_f20170307" id="x_f20170307" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170307->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170307->EditValue ?>"<?php echo $t_jd_krj_peg->f20170307->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170307->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170308->Visible) { // f20170308 ?>
	<div id="r_f20170308" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170308" for="x_f20170308" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170308->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170308->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170308">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170308" name="x_f20170308" id="x_f20170308" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170308->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170308->EditValue ?>"<?php echo $t_jd_krj_peg->f20170308->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170308->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170309->Visible) { // f20170309 ?>
	<div id="r_f20170309" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170309" for="x_f20170309" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170309->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170309->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170309">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170309" name="x_f20170309" id="x_f20170309" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170309->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170309->EditValue ?>"<?php echo $t_jd_krj_peg->f20170309->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170309->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170310->Visible) { // f20170310 ?>
	<div id="r_f20170310" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170310" for="x_f20170310" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170310->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170310->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170310">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170310" name="x_f20170310" id="x_f20170310" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170310->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170310->EditValue ?>"<?php echo $t_jd_krj_peg->f20170310->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170310->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170311->Visible) { // f20170311 ?>
	<div id="r_f20170311" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170311" for="x_f20170311" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170311->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170311->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170311">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170311" name="x_f20170311" id="x_f20170311" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170311->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170311->EditValue ?>"<?php echo $t_jd_krj_peg->f20170311->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170311->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170312->Visible) { // f20170312 ?>
	<div id="r_f20170312" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170312" for="x_f20170312" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170312->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170312->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170312">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170312" name="x_f20170312" id="x_f20170312" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170312->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170312->EditValue ?>"<?php echo $t_jd_krj_peg->f20170312->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170312->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170313->Visible) { // f20170313 ?>
	<div id="r_f20170313" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170313" for="x_f20170313" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170313->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170313->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170313">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170313" name="x_f20170313" id="x_f20170313" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170313->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170313->EditValue ?>"<?php echo $t_jd_krj_peg->f20170313->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170313->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170314->Visible) { // f20170314 ?>
	<div id="r_f20170314" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170314" for="x_f20170314" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170314->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170314->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170314">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170314" name="x_f20170314" id="x_f20170314" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170314->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170314->EditValue ?>"<?php echo $t_jd_krj_peg->f20170314->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170314->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170315->Visible) { // f20170315 ?>
	<div id="r_f20170315" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170315" for="x_f20170315" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170315->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170315->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170315">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170315" name="x_f20170315" id="x_f20170315" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170315->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170315->EditValue ?>"<?php echo $t_jd_krj_peg->f20170315->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170315->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170316->Visible) { // f20170316 ?>
	<div id="r_f20170316" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170316" for="x_f20170316" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170316->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170316->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170316">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170316" name="x_f20170316" id="x_f20170316" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170316->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170316->EditValue ?>"<?php echo $t_jd_krj_peg->f20170316->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170316->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170317->Visible) { // f20170317 ?>
	<div id="r_f20170317" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170317" for="x_f20170317" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170317->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170317->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170317">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170317" name="x_f20170317" id="x_f20170317" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170317->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170317->EditValue ?>"<?php echo $t_jd_krj_peg->f20170317->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170317->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170318->Visible) { // f20170318 ?>
	<div id="r_f20170318" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170318" for="x_f20170318" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170318->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170318->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170318">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170318" name="x_f20170318" id="x_f20170318" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170318->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170318->EditValue ?>"<?php echo $t_jd_krj_peg->f20170318->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170318->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170319->Visible) { // f20170319 ?>
	<div id="r_f20170319" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170319" for="x_f20170319" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170319->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170319->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170319">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170319" name="x_f20170319" id="x_f20170319" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170319->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170319->EditValue ?>"<?php echo $t_jd_krj_peg->f20170319->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170319->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170320->Visible) { // f20170320 ?>
	<div id="r_f20170320" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170320" for="x_f20170320" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170320->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170320->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170320">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170320" name="x_f20170320" id="x_f20170320" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170320->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170320->EditValue ?>"<?php echo $t_jd_krj_peg->f20170320->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170320->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170321->Visible) { // f20170321 ?>
	<div id="r_f20170321" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170321" for="x_f20170321" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170321->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170321->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170321">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170321" name="x_f20170321" id="x_f20170321" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170321->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170321->EditValue ?>"<?php echo $t_jd_krj_peg->f20170321->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170321->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170322->Visible) { // f20170322 ?>
	<div id="r_f20170322" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170322" for="x_f20170322" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170322->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170322->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170322">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170322" name="x_f20170322" id="x_f20170322" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170322->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170322->EditValue ?>"<?php echo $t_jd_krj_peg->f20170322->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170322->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170323->Visible) { // f20170323 ?>
	<div id="r_f20170323" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170323" for="x_f20170323" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170323->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170323->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170323">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170323" name="x_f20170323" id="x_f20170323" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170323->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170323->EditValue ?>"<?php echo $t_jd_krj_peg->f20170323->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170323->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170324->Visible) { // f20170324 ?>
	<div id="r_f20170324" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170324" for="x_f20170324" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170324->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170324->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170324">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170324" name="x_f20170324" id="x_f20170324" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170324->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170324->EditValue ?>"<?php echo $t_jd_krj_peg->f20170324->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170324->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170325->Visible) { // f20170325 ?>
	<div id="r_f20170325" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170325" for="x_f20170325" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170325->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170325->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170325">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170325" name="x_f20170325" id="x_f20170325" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170325->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170325->EditValue ?>"<?php echo $t_jd_krj_peg->f20170325->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170325->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170326->Visible) { // f20170326 ?>
	<div id="r_f20170326" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170326" for="x_f20170326" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170326->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170326->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170326">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170326" name="x_f20170326" id="x_f20170326" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170326->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170326->EditValue ?>"<?php echo $t_jd_krj_peg->f20170326->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170326->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170327->Visible) { // f20170327 ?>
	<div id="r_f20170327" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170327" for="x_f20170327" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170327->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170327->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170327">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170327" name="x_f20170327" id="x_f20170327" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170327->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170327->EditValue ?>"<?php echo $t_jd_krj_peg->f20170327->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170327->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170328->Visible) { // f20170328 ?>
	<div id="r_f20170328" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170328" for="x_f20170328" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170328->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170328->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170328">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170328" name="x_f20170328" id="x_f20170328" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170328->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170328->EditValue ?>"<?php echo $t_jd_krj_peg->f20170328->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170328->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170329->Visible) { // f20170329 ?>
	<div id="r_f20170329" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170329" for="x_f20170329" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170329->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170329->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170329">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170329" name="x_f20170329" id="x_f20170329" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170329->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170329->EditValue ?>"<?php echo $t_jd_krj_peg->f20170329->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170329->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170330->Visible) { // f20170330 ?>
	<div id="r_f20170330" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170330" for="x_f20170330" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170330->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170330->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170330">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170330" name="x_f20170330" id="x_f20170330" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170330->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170330->EditValue ?>"<?php echo $t_jd_krj_peg->f20170330->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170330->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170331->Visible) { // f20170331 ?>
	<div id="r_f20170331" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170331" for="x_f20170331" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170331->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170331->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170331">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170331" name="x_f20170331" id="x_f20170331" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170331->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170331->EditValue ?>"<?php echo $t_jd_krj_peg->f20170331->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170331->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170401->Visible) { // f20170401 ?>
	<div id="r_f20170401" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170401" for="x_f20170401" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170401->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170401->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170401">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170401" name="x_f20170401" id="x_f20170401" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170401->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170401->EditValue ?>"<?php echo $t_jd_krj_peg->f20170401->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170401->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170402->Visible) { // f20170402 ?>
	<div id="r_f20170402" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170402" for="x_f20170402" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170402->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170402->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170402">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170402" name="x_f20170402" id="x_f20170402" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170402->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170402->EditValue ?>"<?php echo $t_jd_krj_peg->f20170402->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170402->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170403->Visible) { // f20170403 ?>
	<div id="r_f20170403" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170403" for="x_f20170403" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170403->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170403->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170403">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170403" name="x_f20170403" id="x_f20170403" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170403->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170403->EditValue ?>"<?php echo $t_jd_krj_peg->f20170403->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170403->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170404->Visible) { // f20170404 ?>
	<div id="r_f20170404" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170404" for="x_f20170404" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170404->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170404->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170404">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170404" name="x_f20170404" id="x_f20170404" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170404->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170404->EditValue ?>"<?php echo $t_jd_krj_peg->f20170404->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170404->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170405->Visible) { // f20170405 ?>
	<div id="r_f20170405" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170405" for="x_f20170405" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170405->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170405->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170405">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170405" name="x_f20170405" id="x_f20170405" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170405->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170405->EditValue ?>"<?php echo $t_jd_krj_peg->f20170405->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170405->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170406->Visible) { // f20170406 ?>
	<div id="r_f20170406" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170406" for="x_f20170406" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170406->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170406->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170406">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170406" name="x_f20170406" id="x_f20170406" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170406->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170406->EditValue ?>"<?php echo $t_jd_krj_peg->f20170406->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170406->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170407->Visible) { // f20170407 ?>
	<div id="r_f20170407" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170407" for="x_f20170407" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170407->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170407->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170407">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170407" name="x_f20170407" id="x_f20170407" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170407->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170407->EditValue ?>"<?php echo $t_jd_krj_peg->f20170407->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170407->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170408->Visible) { // f20170408 ?>
	<div id="r_f20170408" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170408" for="x_f20170408" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170408->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170408->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170408">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170408" name="x_f20170408" id="x_f20170408" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170408->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170408->EditValue ?>"<?php echo $t_jd_krj_peg->f20170408->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170408->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170409->Visible) { // f20170409 ?>
	<div id="r_f20170409" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170409" for="x_f20170409" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170409->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170409->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170409">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170409" name="x_f20170409" id="x_f20170409" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170409->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170409->EditValue ?>"<?php echo $t_jd_krj_peg->f20170409->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170409->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170410->Visible) { // f20170410 ?>
	<div id="r_f20170410" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170410" for="x_f20170410" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170410->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170410->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170410">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170410" name="x_f20170410" id="x_f20170410" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170410->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170410->EditValue ?>"<?php echo $t_jd_krj_peg->f20170410->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170410->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170411->Visible) { // f20170411 ?>
	<div id="r_f20170411" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170411" for="x_f20170411" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170411->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170411->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170411">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170411" name="x_f20170411" id="x_f20170411" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170411->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170411->EditValue ?>"<?php echo $t_jd_krj_peg->f20170411->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170411->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170412->Visible) { // f20170412 ?>
	<div id="r_f20170412" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170412" for="x_f20170412" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170412->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170412->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170412">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170412" name="x_f20170412" id="x_f20170412" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170412->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170412->EditValue ?>"<?php echo $t_jd_krj_peg->f20170412->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170412->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170413->Visible) { // f20170413 ?>
	<div id="r_f20170413" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170413" for="x_f20170413" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170413->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170413->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170413">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170413" name="x_f20170413" id="x_f20170413" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170413->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170413->EditValue ?>"<?php echo $t_jd_krj_peg->f20170413->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170413->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170414->Visible) { // f20170414 ?>
	<div id="r_f20170414" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170414" for="x_f20170414" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170414->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170414->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170414">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170414" name="x_f20170414" id="x_f20170414" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170414->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170414->EditValue ?>"<?php echo $t_jd_krj_peg->f20170414->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170414->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170415->Visible) { // f20170415 ?>
	<div id="r_f20170415" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170415" for="x_f20170415" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170415->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170415->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170415">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170415" name="x_f20170415" id="x_f20170415" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170415->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170415->EditValue ?>"<?php echo $t_jd_krj_peg->f20170415->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170415->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170416->Visible) { // f20170416 ?>
	<div id="r_f20170416" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170416" for="x_f20170416" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170416->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170416->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170416">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170416" name="x_f20170416" id="x_f20170416" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170416->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170416->EditValue ?>"<?php echo $t_jd_krj_peg->f20170416->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170416->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170417->Visible) { // f20170417 ?>
	<div id="r_f20170417" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170417" for="x_f20170417" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170417->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170417->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170417">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170417" name="x_f20170417" id="x_f20170417" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170417->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170417->EditValue ?>"<?php echo $t_jd_krj_peg->f20170417->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170417->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170418->Visible) { // f20170418 ?>
	<div id="r_f20170418" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170418" for="x_f20170418" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170418->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170418->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170418">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170418" name="x_f20170418" id="x_f20170418" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170418->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170418->EditValue ?>"<?php echo $t_jd_krj_peg->f20170418->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170418->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170419->Visible) { // f20170419 ?>
	<div id="r_f20170419" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170419" for="x_f20170419" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170419->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170419->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170419">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170419" name="x_f20170419" id="x_f20170419" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170419->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170419->EditValue ?>"<?php echo $t_jd_krj_peg->f20170419->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170419->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170420->Visible) { // f20170420 ?>
	<div id="r_f20170420" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170420" for="x_f20170420" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170420->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170420->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170420">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170420" name="x_f20170420" id="x_f20170420" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170420->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170420->EditValue ?>"<?php echo $t_jd_krj_peg->f20170420->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170420->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170421->Visible) { // f20170421 ?>
	<div id="r_f20170421" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170421" for="x_f20170421" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170421->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170421->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170421">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170421" name="x_f20170421" id="x_f20170421" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170421->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170421->EditValue ?>"<?php echo $t_jd_krj_peg->f20170421->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170421->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170422->Visible) { // f20170422 ?>
	<div id="r_f20170422" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170422" for="x_f20170422" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170422->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170422->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170422">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170422" name="x_f20170422" id="x_f20170422" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170422->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170422->EditValue ?>"<?php echo $t_jd_krj_peg->f20170422->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170422->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170423->Visible) { // f20170423 ?>
	<div id="r_f20170423" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170423" for="x_f20170423" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170423->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170423->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170423">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170423" name="x_f20170423" id="x_f20170423" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170423->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170423->EditValue ?>"<?php echo $t_jd_krj_peg->f20170423->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170423->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170424->Visible) { // f20170424 ?>
	<div id="r_f20170424" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170424" for="x_f20170424" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170424->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170424->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170424">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170424" name="x_f20170424" id="x_f20170424" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170424->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170424->EditValue ?>"<?php echo $t_jd_krj_peg->f20170424->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170424->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170425->Visible) { // f20170425 ?>
	<div id="r_f20170425" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170425" for="x_f20170425" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170425->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170425->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170425">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170425" name="x_f20170425" id="x_f20170425" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170425->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170425->EditValue ?>"<?php echo $t_jd_krj_peg->f20170425->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170425->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170426->Visible) { // f20170426 ?>
	<div id="r_f20170426" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170426" for="x_f20170426" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170426->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170426->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170426">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170426" name="x_f20170426" id="x_f20170426" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170426->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170426->EditValue ?>"<?php echo $t_jd_krj_peg->f20170426->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170426->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170427->Visible) { // f20170427 ?>
	<div id="r_f20170427" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170427" for="x_f20170427" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170427->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170427->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170427">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170427" name="x_f20170427" id="x_f20170427" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170427->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170427->EditValue ?>"<?php echo $t_jd_krj_peg->f20170427->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170427->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170428->Visible) { // f20170428 ?>
	<div id="r_f20170428" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170428" for="x_f20170428" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170428->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170428->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170428">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170428" name="x_f20170428" id="x_f20170428" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170428->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170428->EditValue ?>"<?php echo $t_jd_krj_peg->f20170428->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170428->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170429->Visible) { // f20170429 ?>
	<div id="r_f20170429" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170429" for="x_f20170429" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170429->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170429->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170429">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170429" name="x_f20170429" id="x_f20170429" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170429->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170429->EditValue ?>"<?php echo $t_jd_krj_peg->f20170429->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170429->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170430->Visible) { // f20170430 ?>
	<div id="r_f20170430" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170430" for="x_f20170430" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170430->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170430->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170430">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170430" name="x_f20170430" id="x_f20170430" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170430->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170430->EditValue ?>"<?php echo $t_jd_krj_peg->f20170430->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170430->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170501->Visible) { // f20170501 ?>
	<div id="r_f20170501" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170501" for="x_f20170501" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170501->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170501->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170501">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170501" name="x_f20170501" id="x_f20170501" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170501->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170501->EditValue ?>"<?php echo $t_jd_krj_peg->f20170501->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170501->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170502->Visible) { // f20170502 ?>
	<div id="r_f20170502" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170502" for="x_f20170502" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170502->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170502->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170502">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170502" name="x_f20170502" id="x_f20170502" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170502->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170502->EditValue ?>"<?php echo $t_jd_krj_peg->f20170502->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170502->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170503->Visible) { // f20170503 ?>
	<div id="r_f20170503" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170503" for="x_f20170503" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170503->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170503->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170503">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170503" name="x_f20170503" id="x_f20170503" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170503->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170503->EditValue ?>"<?php echo $t_jd_krj_peg->f20170503->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170503->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170504->Visible) { // f20170504 ?>
	<div id="r_f20170504" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170504" for="x_f20170504" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170504->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170504->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170504">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170504" name="x_f20170504" id="x_f20170504" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170504->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170504->EditValue ?>"<?php echo $t_jd_krj_peg->f20170504->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170504->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170505->Visible) { // f20170505 ?>
	<div id="r_f20170505" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170505" for="x_f20170505" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170505->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170505->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170505">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170505" name="x_f20170505" id="x_f20170505" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170505->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170505->EditValue ?>"<?php echo $t_jd_krj_peg->f20170505->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170505->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170506->Visible) { // f20170506 ?>
	<div id="r_f20170506" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170506" for="x_f20170506" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170506->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170506->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170506">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170506" name="x_f20170506" id="x_f20170506" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170506->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170506->EditValue ?>"<?php echo $t_jd_krj_peg->f20170506->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170506->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170507->Visible) { // f20170507 ?>
	<div id="r_f20170507" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170507" for="x_f20170507" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170507->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170507->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170507">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170507" name="x_f20170507" id="x_f20170507" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170507->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170507->EditValue ?>"<?php echo $t_jd_krj_peg->f20170507->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170507->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170508->Visible) { // f20170508 ?>
	<div id="r_f20170508" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170508" for="x_f20170508" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170508->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170508->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170508">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170508" name="x_f20170508" id="x_f20170508" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170508->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170508->EditValue ?>"<?php echo $t_jd_krj_peg->f20170508->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170508->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170509->Visible) { // f20170509 ?>
	<div id="r_f20170509" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170509" for="x_f20170509" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170509->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170509->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170509">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170509" name="x_f20170509" id="x_f20170509" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170509->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170509->EditValue ?>"<?php echo $t_jd_krj_peg->f20170509->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170509->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170510->Visible) { // f20170510 ?>
	<div id="r_f20170510" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170510" for="x_f20170510" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170510->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170510->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170510">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170510" name="x_f20170510" id="x_f20170510" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170510->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170510->EditValue ?>"<?php echo $t_jd_krj_peg->f20170510->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170510->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170511->Visible) { // f20170511 ?>
	<div id="r_f20170511" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170511" for="x_f20170511" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170511->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170511->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170511">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170511" name="x_f20170511" id="x_f20170511" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170511->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170511->EditValue ?>"<?php echo $t_jd_krj_peg->f20170511->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170511->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170512->Visible) { // f20170512 ?>
	<div id="r_f20170512" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170512" for="x_f20170512" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170512->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170512->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170512">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170512" name="x_f20170512" id="x_f20170512" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170512->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170512->EditValue ?>"<?php echo $t_jd_krj_peg->f20170512->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170512->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170513->Visible) { // f20170513 ?>
	<div id="r_f20170513" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170513" for="x_f20170513" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170513->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170513->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170513">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170513" name="x_f20170513" id="x_f20170513" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170513->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170513->EditValue ?>"<?php echo $t_jd_krj_peg->f20170513->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170513->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170514->Visible) { // f20170514 ?>
	<div id="r_f20170514" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170514" for="x_f20170514" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170514->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170514->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170514">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170514" name="x_f20170514" id="x_f20170514" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170514->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170514->EditValue ?>"<?php echo $t_jd_krj_peg->f20170514->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170514->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170515->Visible) { // f20170515 ?>
	<div id="r_f20170515" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170515" for="x_f20170515" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170515->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170515->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170515">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170515" name="x_f20170515" id="x_f20170515" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170515->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170515->EditValue ?>"<?php echo $t_jd_krj_peg->f20170515->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170515->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170516->Visible) { // f20170516 ?>
	<div id="r_f20170516" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170516" for="x_f20170516" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170516->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170516->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170516">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170516" name="x_f20170516" id="x_f20170516" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170516->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170516->EditValue ?>"<?php echo $t_jd_krj_peg->f20170516->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170516->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170517->Visible) { // f20170517 ?>
	<div id="r_f20170517" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170517" for="x_f20170517" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170517->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170517->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170517">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170517" name="x_f20170517" id="x_f20170517" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170517->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170517->EditValue ?>"<?php echo $t_jd_krj_peg->f20170517->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170517->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170518->Visible) { // f20170518 ?>
	<div id="r_f20170518" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170518" for="x_f20170518" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170518->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170518->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170518">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170518" name="x_f20170518" id="x_f20170518" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170518->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170518->EditValue ?>"<?php echo $t_jd_krj_peg->f20170518->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170518->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170519->Visible) { // f20170519 ?>
	<div id="r_f20170519" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170519" for="x_f20170519" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170519->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170519->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170519">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170519" name="x_f20170519" id="x_f20170519" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170519->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170519->EditValue ?>"<?php echo $t_jd_krj_peg->f20170519->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170519->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170520->Visible) { // f20170520 ?>
	<div id="r_f20170520" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170520" for="x_f20170520" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170520->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170520->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170520">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170520" name="x_f20170520" id="x_f20170520" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170520->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170520->EditValue ?>"<?php echo $t_jd_krj_peg->f20170520->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170520->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170521->Visible) { // f20170521 ?>
	<div id="r_f20170521" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170521" for="x_f20170521" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170521->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170521->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170521">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170521" name="x_f20170521" id="x_f20170521" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170521->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170521->EditValue ?>"<?php echo $t_jd_krj_peg->f20170521->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170521->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170522->Visible) { // f20170522 ?>
	<div id="r_f20170522" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170522" for="x_f20170522" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170522->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170522->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170522">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170522" name="x_f20170522" id="x_f20170522" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170522->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170522->EditValue ?>"<?php echo $t_jd_krj_peg->f20170522->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170522->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170523->Visible) { // f20170523 ?>
	<div id="r_f20170523" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170523" for="x_f20170523" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170523->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170523->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170523">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170523" name="x_f20170523" id="x_f20170523" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170523->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170523->EditValue ?>"<?php echo $t_jd_krj_peg->f20170523->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170523->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170524->Visible) { // f20170524 ?>
	<div id="r_f20170524" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170524" for="x_f20170524" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170524->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170524->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170524">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170524" name="x_f20170524" id="x_f20170524" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170524->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170524->EditValue ?>"<?php echo $t_jd_krj_peg->f20170524->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170524->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170525->Visible) { // f20170525 ?>
	<div id="r_f20170525" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170525" for="x_f20170525" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170525->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170525->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170525">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170525" name="x_f20170525" id="x_f20170525" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170525->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170525->EditValue ?>"<?php echo $t_jd_krj_peg->f20170525->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170525->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170526->Visible) { // f20170526 ?>
	<div id="r_f20170526" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170526" for="x_f20170526" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170526->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170526->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170526">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170526" name="x_f20170526" id="x_f20170526" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170526->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170526->EditValue ?>"<?php echo $t_jd_krj_peg->f20170526->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170526->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170527->Visible) { // f20170527 ?>
	<div id="r_f20170527" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170527" for="x_f20170527" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170527->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170527->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170527">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170527" name="x_f20170527" id="x_f20170527" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170527->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170527->EditValue ?>"<?php echo $t_jd_krj_peg->f20170527->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170527->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170528->Visible) { // f20170528 ?>
	<div id="r_f20170528" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170528" for="x_f20170528" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170528->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170528->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170528">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170528" name="x_f20170528" id="x_f20170528" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170528->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170528->EditValue ?>"<?php echo $t_jd_krj_peg->f20170528->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170528->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170529->Visible) { // f20170529 ?>
	<div id="r_f20170529" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170529" for="x_f20170529" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170529->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170529->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170529">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170529" name="x_f20170529" id="x_f20170529" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170529->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170529->EditValue ?>"<?php echo $t_jd_krj_peg->f20170529->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170529->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170530->Visible) { // f20170530 ?>
	<div id="r_f20170530" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170530" for="x_f20170530" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170530->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170530->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170530">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170530" name="x_f20170530" id="x_f20170530" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170530->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170530->EditValue ?>"<?php echo $t_jd_krj_peg->f20170530->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170530->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170531->Visible) { // f20170531 ?>
	<div id="r_f20170531" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170531" for="x_f20170531" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170531->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170531->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170531">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170531" name="x_f20170531" id="x_f20170531" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170531->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170531->EditValue ?>"<?php echo $t_jd_krj_peg->f20170531->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170531->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170601->Visible) { // f20170601 ?>
	<div id="r_f20170601" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170601" for="x_f20170601" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170601->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170601->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170601">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170601" name="x_f20170601" id="x_f20170601" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170601->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170601->EditValue ?>"<?php echo $t_jd_krj_peg->f20170601->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170601->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170602->Visible) { // f20170602 ?>
	<div id="r_f20170602" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170602" for="x_f20170602" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170602->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170602->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170602">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170602" name="x_f20170602" id="x_f20170602" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170602->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170602->EditValue ?>"<?php echo $t_jd_krj_peg->f20170602->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170602->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170603->Visible) { // f20170603 ?>
	<div id="r_f20170603" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170603" for="x_f20170603" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170603->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170603->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170603">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170603" name="x_f20170603" id="x_f20170603" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170603->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170603->EditValue ?>"<?php echo $t_jd_krj_peg->f20170603->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170603->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170604->Visible) { // f20170604 ?>
	<div id="r_f20170604" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170604" for="x_f20170604" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170604->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170604->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170604">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170604" name="x_f20170604" id="x_f20170604" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170604->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170604->EditValue ?>"<?php echo $t_jd_krj_peg->f20170604->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170604->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170605->Visible) { // f20170605 ?>
	<div id="r_f20170605" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170605" for="x_f20170605" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170605->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170605->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170605">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170605" name="x_f20170605" id="x_f20170605" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170605->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170605->EditValue ?>"<?php echo $t_jd_krj_peg->f20170605->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170605->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170606->Visible) { // f20170606 ?>
	<div id="r_f20170606" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170606" for="x_f20170606" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170606->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170606->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170606">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170606" name="x_f20170606" id="x_f20170606" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170606->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170606->EditValue ?>"<?php echo $t_jd_krj_peg->f20170606->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170606->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170607->Visible) { // f20170607 ?>
	<div id="r_f20170607" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170607" for="x_f20170607" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170607->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170607->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170607">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170607" name="x_f20170607" id="x_f20170607" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170607->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170607->EditValue ?>"<?php echo $t_jd_krj_peg->f20170607->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170607->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170608->Visible) { // f20170608 ?>
	<div id="r_f20170608" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170608" for="x_f20170608" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170608->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170608->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170608">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170608" name="x_f20170608" id="x_f20170608" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170608->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170608->EditValue ?>"<?php echo $t_jd_krj_peg->f20170608->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170608->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170609->Visible) { // f20170609 ?>
	<div id="r_f20170609" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170609" for="x_f20170609" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170609->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170609->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170609">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170609" name="x_f20170609" id="x_f20170609" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170609->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170609->EditValue ?>"<?php echo $t_jd_krj_peg->f20170609->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170609->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170610->Visible) { // f20170610 ?>
	<div id="r_f20170610" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170610" for="x_f20170610" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170610->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170610->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170610">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170610" name="x_f20170610" id="x_f20170610" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170610->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170610->EditValue ?>"<?php echo $t_jd_krj_peg->f20170610->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170610->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170611->Visible) { // f20170611 ?>
	<div id="r_f20170611" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170611" for="x_f20170611" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170611->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170611->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170611">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170611" name="x_f20170611" id="x_f20170611" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170611->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170611->EditValue ?>"<?php echo $t_jd_krj_peg->f20170611->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170611->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170612->Visible) { // f20170612 ?>
	<div id="r_f20170612" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170612" for="x_f20170612" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170612->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170612->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170612">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170612" name="x_f20170612" id="x_f20170612" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170612->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170612->EditValue ?>"<?php echo $t_jd_krj_peg->f20170612->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170612->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170613->Visible) { // f20170613 ?>
	<div id="r_f20170613" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170613" for="x_f20170613" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170613->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170613->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170613">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170613" name="x_f20170613" id="x_f20170613" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170613->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170613->EditValue ?>"<?php echo $t_jd_krj_peg->f20170613->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170613->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170614->Visible) { // f20170614 ?>
	<div id="r_f20170614" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170614" for="x_f20170614" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170614->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170614->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170614">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170614" name="x_f20170614" id="x_f20170614" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170614->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170614->EditValue ?>"<?php echo $t_jd_krj_peg->f20170614->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170614->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170615->Visible) { // f20170615 ?>
	<div id="r_f20170615" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170615" for="x_f20170615" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170615->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170615->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170615">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170615" name="x_f20170615" id="x_f20170615" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170615->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170615->EditValue ?>"<?php echo $t_jd_krj_peg->f20170615->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170615->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170616->Visible) { // f20170616 ?>
	<div id="r_f20170616" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170616" for="x_f20170616" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170616->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170616->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170616">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170616" name="x_f20170616" id="x_f20170616" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170616->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170616->EditValue ?>"<?php echo $t_jd_krj_peg->f20170616->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170616->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170617->Visible) { // f20170617 ?>
	<div id="r_f20170617" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170617" for="x_f20170617" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170617->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170617->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170617">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170617" name="x_f20170617" id="x_f20170617" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170617->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170617->EditValue ?>"<?php echo $t_jd_krj_peg->f20170617->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170617->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170618->Visible) { // f20170618 ?>
	<div id="r_f20170618" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170618" for="x_f20170618" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170618->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170618->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170618">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170618" name="x_f20170618" id="x_f20170618" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170618->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170618->EditValue ?>"<?php echo $t_jd_krj_peg->f20170618->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170618->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170619->Visible) { // f20170619 ?>
	<div id="r_f20170619" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170619" for="x_f20170619" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170619->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170619->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170619">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170619" name="x_f20170619" id="x_f20170619" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170619->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170619->EditValue ?>"<?php echo $t_jd_krj_peg->f20170619->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170619->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170620->Visible) { // f20170620 ?>
	<div id="r_f20170620" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170620" for="x_f20170620" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170620->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170620->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170620">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170620" name="x_f20170620" id="x_f20170620" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170620->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170620->EditValue ?>"<?php echo $t_jd_krj_peg->f20170620->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170620->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170621->Visible) { // f20170621 ?>
	<div id="r_f20170621" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170621" for="x_f20170621" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170621->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170621->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170621">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170621" name="x_f20170621" id="x_f20170621" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170621->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170621->EditValue ?>"<?php echo $t_jd_krj_peg->f20170621->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170621->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170622->Visible) { // f20170622 ?>
	<div id="r_f20170622" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170622" for="x_f20170622" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170622->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170622->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170622">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170622" name="x_f20170622" id="x_f20170622" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170622->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170622->EditValue ?>"<?php echo $t_jd_krj_peg->f20170622->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170622->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170623->Visible) { // f20170623 ?>
	<div id="r_f20170623" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170623" for="x_f20170623" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170623->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170623->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170623">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170623" name="x_f20170623" id="x_f20170623" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170623->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170623->EditValue ?>"<?php echo $t_jd_krj_peg->f20170623->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170623->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170624->Visible) { // f20170624 ?>
	<div id="r_f20170624" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170624" for="x_f20170624" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170624->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170624->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170624">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170624" name="x_f20170624" id="x_f20170624" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170624->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170624->EditValue ?>"<?php echo $t_jd_krj_peg->f20170624->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170624->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170625->Visible) { // f20170625 ?>
	<div id="r_f20170625" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170625" for="x_f20170625" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170625->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170625->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170625">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170625" name="x_f20170625" id="x_f20170625" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170625->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170625->EditValue ?>"<?php echo $t_jd_krj_peg->f20170625->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170625->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170626->Visible) { // f20170626 ?>
	<div id="r_f20170626" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170626" for="x_f20170626" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170626->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170626->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170626">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170626" name="x_f20170626" id="x_f20170626" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170626->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170626->EditValue ?>"<?php echo $t_jd_krj_peg->f20170626->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170626->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170627->Visible) { // f20170627 ?>
	<div id="r_f20170627" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170627" for="x_f20170627" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170627->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170627->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170627">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170627" name="x_f20170627" id="x_f20170627" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170627->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170627->EditValue ?>"<?php echo $t_jd_krj_peg->f20170627->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170627->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170628->Visible) { // f20170628 ?>
	<div id="r_f20170628" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170628" for="x_f20170628" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170628->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170628->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170628">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170628" name="x_f20170628" id="x_f20170628" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170628->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170628->EditValue ?>"<?php echo $t_jd_krj_peg->f20170628->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170628->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170629->Visible) { // f20170629 ?>
	<div id="r_f20170629" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170629" for="x_f20170629" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170629->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170629->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170629">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170629" name="x_f20170629" id="x_f20170629" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170629->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170629->EditValue ?>"<?php echo $t_jd_krj_peg->f20170629->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170629->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170630->Visible) { // f20170630 ?>
	<div id="r_f20170630" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170630" for="x_f20170630" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170630->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170630->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170630">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170630" name="x_f20170630" id="x_f20170630" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170630->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170630->EditValue ?>"<?php echo $t_jd_krj_peg->f20170630->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170630->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170701->Visible) { // f20170701 ?>
	<div id="r_f20170701" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170701" for="x_f20170701" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170701->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170701->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170701">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170701" name="x_f20170701" id="x_f20170701" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170701->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170701->EditValue ?>"<?php echo $t_jd_krj_peg->f20170701->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170701->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170702->Visible) { // f20170702 ?>
	<div id="r_f20170702" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170702" for="x_f20170702" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170702->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170702->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170702">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170702" name="x_f20170702" id="x_f20170702" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170702->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170702->EditValue ?>"<?php echo $t_jd_krj_peg->f20170702->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170702->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170703->Visible) { // f20170703 ?>
	<div id="r_f20170703" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170703" for="x_f20170703" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170703->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170703->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170703">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170703" name="x_f20170703" id="x_f20170703" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170703->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170703->EditValue ?>"<?php echo $t_jd_krj_peg->f20170703->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170703->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170704->Visible) { // f20170704 ?>
	<div id="r_f20170704" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170704" for="x_f20170704" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170704->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170704->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170704">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170704" name="x_f20170704" id="x_f20170704" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170704->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170704->EditValue ?>"<?php echo $t_jd_krj_peg->f20170704->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170704->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170705->Visible) { // f20170705 ?>
	<div id="r_f20170705" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170705" for="x_f20170705" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170705->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170705->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170705">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170705" name="x_f20170705" id="x_f20170705" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170705->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170705->EditValue ?>"<?php echo $t_jd_krj_peg->f20170705->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170705->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170706->Visible) { // f20170706 ?>
	<div id="r_f20170706" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170706" for="x_f20170706" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170706->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170706->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170706">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170706" name="x_f20170706" id="x_f20170706" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170706->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170706->EditValue ?>"<?php echo $t_jd_krj_peg->f20170706->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170706->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170707->Visible) { // f20170707 ?>
	<div id="r_f20170707" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170707" for="x_f20170707" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170707->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170707->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170707">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170707" name="x_f20170707" id="x_f20170707" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170707->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170707->EditValue ?>"<?php echo $t_jd_krj_peg->f20170707->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170707->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170708->Visible) { // f20170708 ?>
	<div id="r_f20170708" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170708" for="x_f20170708" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170708->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170708->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170708">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170708" name="x_f20170708" id="x_f20170708" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170708->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170708->EditValue ?>"<?php echo $t_jd_krj_peg->f20170708->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170708->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170709->Visible) { // f20170709 ?>
	<div id="r_f20170709" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170709" for="x_f20170709" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170709->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170709->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170709">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170709" name="x_f20170709" id="x_f20170709" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170709->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170709->EditValue ?>"<?php echo $t_jd_krj_peg->f20170709->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170709->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170710->Visible) { // f20170710 ?>
	<div id="r_f20170710" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170710" for="x_f20170710" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170710->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170710->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170710">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170710" name="x_f20170710" id="x_f20170710" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170710->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170710->EditValue ?>"<?php echo $t_jd_krj_peg->f20170710->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170710->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170711->Visible) { // f20170711 ?>
	<div id="r_f20170711" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170711" for="x_f20170711" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170711->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170711->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170711">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170711" name="x_f20170711" id="x_f20170711" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170711->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170711->EditValue ?>"<?php echo $t_jd_krj_peg->f20170711->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170711->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170712->Visible) { // f20170712 ?>
	<div id="r_f20170712" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170712" for="x_f20170712" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170712->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170712->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170712">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170712" name="x_f20170712" id="x_f20170712" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170712->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170712->EditValue ?>"<?php echo $t_jd_krj_peg->f20170712->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170712->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170713->Visible) { // f20170713 ?>
	<div id="r_f20170713" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170713" for="x_f20170713" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170713->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170713->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170713">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170713" name="x_f20170713" id="x_f20170713" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170713->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170713->EditValue ?>"<?php echo $t_jd_krj_peg->f20170713->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170713->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170714->Visible) { // f20170714 ?>
	<div id="r_f20170714" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170714" for="x_f20170714" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170714->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170714->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170714">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170714" name="x_f20170714" id="x_f20170714" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170714->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170714->EditValue ?>"<?php echo $t_jd_krj_peg->f20170714->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170714->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170715->Visible) { // f20170715 ?>
	<div id="r_f20170715" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170715" for="x_f20170715" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170715->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170715->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170715">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170715" name="x_f20170715" id="x_f20170715" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170715->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170715->EditValue ?>"<?php echo $t_jd_krj_peg->f20170715->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170715->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170716->Visible) { // f20170716 ?>
	<div id="r_f20170716" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170716" for="x_f20170716" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170716->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170716->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170716">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170716" name="x_f20170716" id="x_f20170716" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170716->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170716->EditValue ?>"<?php echo $t_jd_krj_peg->f20170716->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170716->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170717->Visible) { // f20170717 ?>
	<div id="r_f20170717" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170717" for="x_f20170717" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170717->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170717->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170717">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170717" name="x_f20170717" id="x_f20170717" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170717->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170717->EditValue ?>"<?php echo $t_jd_krj_peg->f20170717->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170717->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170718->Visible) { // f20170718 ?>
	<div id="r_f20170718" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170718" for="x_f20170718" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170718->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170718->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170718">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170718" name="x_f20170718" id="x_f20170718" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170718->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170718->EditValue ?>"<?php echo $t_jd_krj_peg->f20170718->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170718->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170719->Visible) { // f20170719 ?>
	<div id="r_f20170719" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170719" for="x_f20170719" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170719->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170719->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170719">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170719" name="x_f20170719" id="x_f20170719" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170719->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170719->EditValue ?>"<?php echo $t_jd_krj_peg->f20170719->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170719->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170720->Visible) { // f20170720 ?>
	<div id="r_f20170720" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170720" for="x_f20170720" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170720->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170720->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170720">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170720" name="x_f20170720" id="x_f20170720" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170720->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170720->EditValue ?>"<?php echo $t_jd_krj_peg->f20170720->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170720->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170721->Visible) { // f20170721 ?>
	<div id="r_f20170721" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170721" for="x_f20170721" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170721->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170721->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170721">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170721" name="x_f20170721" id="x_f20170721" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170721->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170721->EditValue ?>"<?php echo $t_jd_krj_peg->f20170721->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170721->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170722->Visible) { // f20170722 ?>
	<div id="r_f20170722" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170722" for="x_f20170722" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170722->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170722->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170722">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170722" name="x_f20170722" id="x_f20170722" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170722->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170722->EditValue ?>"<?php echo $t_jd_krj_peg->f20170722->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170722->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170723->Visible) { // f20170723 ?>
	<div id="r_f20170723" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170723" for="x_f20170723" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170723->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170723->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170723">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170723" name="x_f20170723" id="x_f20170723" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170723->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170723->EditValue ?>"<?php echo $t_jd_krj_peg->f20170723->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170723->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170724->Visible) { // f20170724 ?>
	<div id="r_f20170724" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170724" for="x_f20170724" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170724->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170724->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170724">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170724" name="x_f20170724" id="x_f20170724" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170724->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170724->EditValue ?>"<?php echo $t_jd_krj_peg->f20170724->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170724->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170725->Visible) { // f20170725 ?>
	<div id="r_f20170725" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170725" for="x_f20170725" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170725->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170725->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170725">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170725" name="x_f20170725" id="x_f20170725" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170725->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170725->EditValue ?>"<?php echo $t_jd_krj_peg->f20170725->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170725->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170726->Visible) { // f20170726 ?>
	<div id="r_f20170726" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170726" for="x_f20170726" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170726->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170726->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170726">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170726" name="x_f20170726" id="x_f20170726" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170726->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170726->EditValue ?>"<?php echo $t_jd_krj_peg->f20170726->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170726->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170727->Visible) { // f20170727 ?>
	<div id="r_f20170727" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170727" for="x_f20170727" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170727->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170727->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170727">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170727" name="x_f20170727" id="x_f20170727" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170727->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170727->EditValue ?>"<?php echo $t_jd_krj_peg->f20170727->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170727->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170728->Visible) { // f20170728 ?>
	<div id="r_f20170728" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170728" for="x_f20170728" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170728->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170728->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170728">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170728" name="x_f20170728" id="x_f20170728" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170728->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170728->EditValue ?>"<?php echo $t_jd_krj_peg->f20170728->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170728->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170729->Visible) { // f20170729 ?>
	<div id="r_f20170729" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170729" for="x_f20170729" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170729->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170729->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170729">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170729" name="x_f20170729" id="x_f20170729" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170729->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170729->EditValue ?>"<?php echo $t_jd_krj_peg->f20170729->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170729->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170730->Visible) { // f20170730 ?>
	<div id="r_f20170730" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170730" for="x_f20170730" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170730->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170730->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170730">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170730" name="x_f20170730" id="x_f20170730" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170730->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170730->EditValue ?>"<?php echo $t_jd_krj_peg->f20170730->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170730->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170731->Visible) { // f20170731 ?>
	<div id="r_f20170731" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170731" for="x_f20170731" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170731->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170731->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170731">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170731" name="x_f20170731" id="x_f20170731" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170731->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170731->EditValue ?>"<?php echo $t_jd_krj_peg->f20170731->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170731->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170801->Visible) { // f20170801 ?>
	<div id="r_f20170801" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170801" for="x_f20170801" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170801->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170801->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170801">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170801" name="x_f20170801" id="x_f20170801" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170801->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170801->EditValue ?>"<?php echo $t_jd_krj_peg->f20170801->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170801->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170802->Visible) { // f20170802 ?>
	<div id="r_f20170802" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170802" for="x_f20170802" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170802->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170802->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170802">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170802" name="x_f20170802" id="x_f20170802" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170802->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170802->EditValue ?>"<?php echo $t_jd_krj_peg->f20170802->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170802->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170803->Visible) { // f20170803 ?>
	<div id="r_f20170803" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170803" for="x_f20170803" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170803->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170803->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170803">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170803" name="x_f20170803" id="x_f20170803" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170803->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170803->EditValue ?>"<?php echo $t_jd_krj_peg->f20170803->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170803->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170804->Visible) { // f20170804 ?>
	<div id="r_f20170804" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170804" for="x_f20170804" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170804->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170804->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170804">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170804" name="x_f20170804" id="x_f20170804" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170804->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170804->EditValue ?>"<?php echo $t_jd_krj_peg->f20170804->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170804->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170805->Visible) { // f20170805 ?>
	<div id="r_f20170805" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170805" for="x_f20170805" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170805->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170805->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170805">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170805" name="x_f20170805" id="x_f20170805" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170805->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170805->EditValue ?>"<?php echo $t_jd_krj_peg->f20170805->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170805->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170806->Visible) { // f20170806 ?>
	<div id="r_f20170806" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170806" for="x_f20170806" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170806->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170806->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170806">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170806" name="x_f20170806" id="x_f20170806" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170806->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170806->EditValue ?>"<?php echo $t_jd_krj_peg->f20170806->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170806->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170807->Visible) { // f20170807 ?>
	<div id="r_f20170807" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170807" for="x_f20170807" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170807->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170807->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170807">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170807" name="x_f20170807" id="x_f20170807" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170807->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170807->EditValue ?>"<?php echo $t_jd_krj_peg->f20170807->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170807->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170808->Visible) { // f20170808 ?>
	<div id="r_f20170808" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170808" for="x_f20170808" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170808->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170808->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170808">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170808" name="x_f20170808" id="x_f20170808" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170808->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170808->EditValue ?>"<?php echo $t_jd_krj_peg->f20170808->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170808->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170809->Visible) { // f20170809 ?>
	<div id="r_f20170809" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170809" for="x_f20170809" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170809->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170809->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170809">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170809" name="x_f20170809" id="x_f20170809" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170809->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170809->EditValue ?>"<?php echo $t_jd_krj_peg->f20170809->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170809->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170810->Visible) { // f20170810 ?>
	<div id="r_f20170810" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170810" for="x_f20170810" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170810->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170810->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170810">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170810" name="x_f20170810" id="x_f20170810" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170810->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170810->EditValue ?>"<?php echo $t_jd_krj_peg->f20170810->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170810->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170811->Visible) { // f20170811 ?>
	<div id="r_f20170811" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170811" for="x_f20170811" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170811->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170811->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170811">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170811" name="x_f20170811" id="x_f20170811" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170811->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170811->EditValue ?>"<?php echo $t_jd_krj_peg->f20170811->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170811->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170812->Visible) { // f20170812 ?>
	<div id="r_f20170812" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170812" for="x_f20170812" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170812->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170812->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170812">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170812" name="x_f20170812" id="x_f20170812" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170812->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170812->EditValue ?>"<?php echo $t_jd_krj_peg->f20170812->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170812->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170813->Visible) { // f20170813 ?>
	<div id="r_f20170813" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170813" for="x_f20170813" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170813->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170813->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170813">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170813" name="x_f20170813" id="x_f20170813" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170813->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170813->EditValue ?>"<?php echo $t_jd_krj_peg->f20170813->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170813->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170814->Visible) { // f20170814 ?>
	<div id="r_f20170814" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170814" for="x_f20170814" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170814->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170814->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170814">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170814" name="x_f20170814" id="x_f20170814" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170814->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170814->EditValue ?>"<?php echo $t_jd_krj_peg->f20170814->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170814->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170815->Visible) { // f20170815 ?>
	<div id="r_f20170815" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170815" for="x_f20170815" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170815->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170815->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170815">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170815" name="x_f20170815" id="x_f20170815" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170815->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170815->EditValue ?>"<?php echo $t_jd_krj_peg->f20170815->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170815->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170816->Visible) { // f20170816 ?>
	<div id="r_f20170816" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170816" for="x_f20170816" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170816->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170816->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170816">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170816" name="x_f20170816" id="x_f20170816" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170816->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170816->EditValue ?>"<?php echo $t_jd_krj_peg->f20170816->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170816->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170817->Visible) { // f20170817 ?>
	<div id="r_f20170817" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170817" for="x_f20170817" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170817->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170817->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170817">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170817" name="x_f20170817" id="x_f20170817" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170817->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170817->EditValue ?>"<?php echo $t_jd_krj_peg->f20170817->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170817->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170818->Visible) { // f20170818 ?>
	<div id="r_f20170818" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170818" for="x_f20170818" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170818->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170818->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170818">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170818" name="x_f20170818" id="x_f20170818" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170818->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170818->EditValue ?>"<?php echo $t_jd_krj_peg->f20170818->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170818->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170819->Visible) { // f20170819 ?>
	<div id="r_f20170819" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170819" for="x_f20170819" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170819->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170819->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170819">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170819" name="x_f20170819" id="x_f20170819" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170819->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170819->EditValue ?>"<?php echo $t_jd_krj_peg->f20170819->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170819->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170820->Visible) { // f20170820 ?>
	<div id="r_f20170820" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170820" for="x_f20170820" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170820->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170820->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170820">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170820" name="x_f20170820" id="x_f20170820" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170820->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170820->EditValue ?>"<?php echo $t_jd_krj_peg->f20170820->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170820->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170821->Visible) { // f20170821 ?>
	<div id="r_f20170821" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170821" for="x_f20170821" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170821->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170821->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170821">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170821" name="x_f20170821" id="x_f20170821" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170821->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170821->EditValue ?>"<?php echo $t_jd_krj_peg->f20170821->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170821->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170822->Visible) { // f20170822 ?>
	<div id="r_f20170822" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170822" for="x_f20170822" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170822->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170822->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170822">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170822" name="x_f20170822" id="x_f20170822" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170822->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170822->EditValue ?>"<?php echo $t_jd_krj_peg->f20170822->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170822->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170823->Visible) { // f20170823 ?>
	<div id="r_f20170823" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170823" for="x_f20170823" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170823->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170823->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170823">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170823" name="x_f20170823" id="x_f20170823" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170823->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170823->EditValue ?>"<?php echo $t_jd_krj_peg->f20170823->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170823->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170824->Visible) { // f20170824 ?>
	<div id="r_f20170824" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170824" for="x_f20170824" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170824->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170824->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170824">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170824" name="x_f20170824" id="x_f20170824" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170824->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170824->EditValue ?>"<?php echo $t_jd_krj_peg->f20170824->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170824->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170825->Visible) { // f20170825 ?>
	<div id="r_f20170825" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170825" for="x_f20170825" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170825->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170825->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170825">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170825" name="x_f20170825" id="x_f20170825" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170825->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170825->EditValue ?>"<?php echo $t_jd_krj_peg->f20170825->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170825->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170826->Visible) { // f20170826 ?>
	<div id="r_f20170826" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170826" for="x_f20170826" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170826->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170826->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170826">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170826" name="x_f20170826" id="x_f20170826" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170826->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170826->EditValue ?>"<?php echo $t_jd_krj_peg->f20170826->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170826->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170827->Visible) { // f20170827 ?>
	<div id="r_f20170827" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170827" for="x_f20170827" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170827->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170827->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170827">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170827" name="x_f20170827" id="x_f20170827" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170827->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170827->EditValue ?>"<?php echo $t_jd_krj_peg->f20170827->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170827->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170828->Visible) { // f20170828 ?>
	<div id="r_f20170828" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170828" for="x_f20170828" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170828->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170828->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170828">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170828" name="x_f20170828" id="x_f20170828" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170828->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170828->EditValue ?>"<?php echo $t_jd_krj_peg->f20170828->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170828->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170829->Visible) { // f20170829 ?>
	<div id="r_f20170829" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170829" for="x_f20170829" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170829->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170829->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170829">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170829" name="x_f20170829" id="x_f20170829" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170829->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170829->EditValue ?>"<?php echo $t_jd_krj_peg->f20170829->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170829->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170830->Visible) { // f20170830 ?>
	<div id="r_f20170830" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170830" for="x_f20170830" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170830->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170830->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170830">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170830" name="x_f20170830" id="x_f20170830" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170830->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170830->EditValue ?>"<?php echo $t_jd_krj_peg->f20170830->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170830->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170831->Visible) { // f20170831 ?>
	<div id="r_f20170831" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170831" for="x_f20170831" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170831->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170831->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170831">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170831" name="x_f20170831" id="x_f20170831" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170831->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170831->EditValue ?>"<?php echo $t_jd_krj_peg->f20170831->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170831->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170901->Visible) { // f20170901 ?>
	<div id="r_f20170901" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170901" for="x_f20170901" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170901->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170901->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170901">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170901" name="x_f20170901" id="x_f20170901" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170901->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170901->EditValue ?>"<?php echo $t_jd_krj_peg->f20170901->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170901->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170902->Visible) { // f20170902 ?>
	<div id="r_f20170902" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170902" for="x_f20170902" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170902->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170902->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170902">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170902" name="x_f20170902" id="x_f20170902" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170902->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170902->EditValue ?>"<?php echo $t_jd_krj_peg->f20170902->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170902->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170903->Visible) { // f20170903 ?>
	<div id="r_f20170903" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170903" for="x_f20170903" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170903->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170903->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170903">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170903" name="x_f20170903" id="x_f20170903" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170903->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170903->EditValue ?>"<?php echo $t_jd_krj_peg->f20170903->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170903->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170904->Visible) { // f20170904 ?>
	<div id="r_f20170904" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170904" for="x_f20170904" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170904->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170904->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170904">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170904" name="x_f20170904" id="x_f20170904" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170904->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170904->EditValue ?>"<?php echo $t_jd_krj_peg->f20170904->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170904->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170905->Visible) { // f20170905 ?>
	<div id="r_f20170905" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170905" for="x_f20170905" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170905->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170905->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170905">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170905" name="x_f20170905" id="x_f20170905" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170905->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170905->EditValue ?>"<?php echo $t_jd_krj_peg->f20170905->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170905->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170906->Visible) { // f20170906 ?>
	<div id="r_f20170906" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170906" for="x_f20170906" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170906->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170906->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170906">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170906" name="x_f20170906" id="x_f20170906" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170906->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170906->EditValue ?>"<?php echo $t_jd_krj_peg->f20170906->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170906->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170907->Visible) { // f20170907 ?>
	<div id="r_f20170907" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170907" for="x_f20170907" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170907->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170907->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170907">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170907" name="x_f20170907" id="x_f20170907" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170907->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170907->EditValue ?>"<?php echo $t_jd_krj_peg->f20170907->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170907->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170908->Visible) { // f20170908 ?>
	<div id="r_f20170908" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170908" for="x_f20170908" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170908->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170908->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170908">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170908" name="x_f20170908" id="x_f20170908" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170908->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170908->EditValue ?>"<?php echo $t_jd_krj_peg->f20170908->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170908->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170909->Visible) { // f20170909 ?>
	<div id="r_f20170909" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170909" for="x_f20170909" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170909->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170909->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170909">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170909" name="x_f20170909" id="x_f20170909" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170909->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170909->EditValue ?>"<?php echo $t_jd_krj_peg->f20170909->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170909->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170910->Visible) { // f20170910 ?>
	<div id="r_f20170910" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170910" for="x_f20170910" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170910->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170910->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170910">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170910" name="x_f20170910" id="x_f20170910" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170910->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170910->EditValue ?>"<?php echo $t_jd_krj_peg->f20170910->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170910->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170911->Visible) { // f20170911 ?>
	<div id="r_f20170911" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170911" for="x_f20170911" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170911->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170911->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170911">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170911" name="x_f20170911" id="x_f20170911" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170911->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170911->EditValue ?>"<?php echo $t_jd_krj_peg->f20170911->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170911->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170912->Visible) { // f20170912 ?>
	<div id="r_f20170912" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170912" for="x_f20170912" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170912->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170912->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170912">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170912" name="x_f20170912" id="x_f20170912" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170912->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170912->EditValue ?>"<?php echo $t_jd_krj_peg->f20170912->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170912->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170913->Visible) { // f20170913 ?>
	<div id="r_f20170913" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170913" for="x_f20170913" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170913->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170913->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170913">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170913" name="x_f20170913" id="x_f20170913" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170913->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170913->EditValue ?>"<?php echo $t_jd_krj_peg->f20170913->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170913->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170914->Visible) { // f20170914 ?>
	<div id="r_f20170914" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170914" for="x_f20170914" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170914->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170914->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170914">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170914" name="x_f20170914" id="x_f20170914" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170914->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170914->EditValue ?>"<?php echo $t_jd_krj_peg->f20170914->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170914->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170915->Visible) { // f20170915 ?>
	<div id="r_f20170915" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170915" for="x_f20170915" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170915->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170915->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170915">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170915" name="x_f20170915" id="x_f20170915" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170915->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170915->EditValue ?>"<?php echo $t_jd_krj_peg->f20170915->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170915->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170916->Visible) { // f20170916 ?>
	<div id="r_f20170916" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170916" for="x_f20170916" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170916->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170916->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170916">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170916" name="x_f20170916" id="x_f20170916" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170916->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170916->EditValue ?>"<?php echo $t_jd_krj_peg->f20170916->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170916->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170917->Visible) { // f20170917 ?>
	<div id="r_f20170917" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170917" for="x_f20170917" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170917->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170917->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170917">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170917" name="x_f20170917" id="x_f20170917" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170917->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170917->EditValue ?>"<?php echo $t_jd_krj_peg->f20170917->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170917->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170918->Visible) { // f20170918 ?>
	<div id="r_f20170918" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170918" for="x_f20170918" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170918->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170918->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170918">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170918" name="x_f20170918" id="x_f20170918" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170918->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170918->EditValue ?>"<?php echo $t_jd_krj_peg->f20170918->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170918->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170919->Visible) { // f20170919 ?>
	<div id="r_f20170919" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170919" for="x_f20170919" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170919->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170919->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170919">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170919" name="x_f20170919" id="x_f20170919" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170919->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170919->EditValue ?>"<?php echo $t_jd_krj_peg->f20170919->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170919->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170920->Visible) { // f20170920 ?>
	<div id="r_f20170920" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170920" for="x_f20170920" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170920->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170920->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170920">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170920" name="x_f20170920" id="x_f20170920" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170920->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170920->EditValue ?>"<?php echo $t_jd_krj_peg->f20170920->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170920->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170921->Visible) { // f20170921 ?>
	<div id="r_f20170921" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170921" for="x_f20170921" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170921->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170921->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170921">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170921" name="x_f20170921" id="x_f20170921" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170921->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170921->EditValue ?>"<?php echo $t_jd_krj_peg->f20170921->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170921->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170922->Visible) { // f20170922 ?>
	<div id="r_f20170922" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170922" for="x_f20170922" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170922->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170922->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170922">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170922" name="x_f20170922" id="x_f20170922" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170922->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170922->EditValue ?>"<?php echo $t_jd_krj_peg->f20170922->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170922->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170923->Visible) { // f20170923 ?>
	<div id="r_f20170923" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170923" for="x_f20170923" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170923->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170923->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170923">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170923" name="x_f20170923" id="x_f20170923" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170923->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170923->EditValue ?>"<?php echo $t_jd_krj_peg->f20170923->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170923->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170924->Visible) { // f20170924 ?>
	<div id="r_f20170924" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170924" for="x_f20170924" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170924->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170924->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170924">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170924" name="x_f20170924" id="x_f20170924" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170924->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170924->EditValue ?>"<?php echo $t_jd_krj_peg->f20170924->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170924->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170925->Visible) { // f20170925 ?>
	<div id="r_f20170925" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170925" for="x_f20170925" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170925->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170925->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170925">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170925" name="x_f20170925" id="x_f20170925" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170925->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170925->EditValue ?>"<?php echo $t_jd_krj_peg->f20170925->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170925->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170926->Visible) { // f20170926 ?>
	<div id="r_f20170926" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170926" for="x_f20170926" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170926->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170926->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170926">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170926" name="x_f20170926" id="x_f20170926" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170926->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170926->EditValue ?>"<?php echo $t_jd_krj_peg->f20170926->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170926->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170927->Visible) { // f20170927 ?>
	<div id="r_f20170927" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170927" for="x_f20170927" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170927->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170927->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170927">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170927" name="x_f20170927" id="x_f20170927" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170927->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170927->EditValue ?>"<?php echo $t_jd_krj_peg->f20170927->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170927->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170928->Visible) { // f20170928 ?>
	<div id="r_f20170928" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170928" for="x_f20170928" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170928->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170928->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170928">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170928" name="x_f20170928" id="x_f20170928" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170928->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170928->EditValue ?>"<?php echo $t_jd_krj_peg->f20170928->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170928->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170929->Visible) { // f20170929 ?>
	<div id="r_f20170929" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170929" for="x_f20170929" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170929->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170929->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170929">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170929" name="x_f20170929" id="x_f20170929" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170929->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170929->EditValue ?>"<?php echo $t_jd_krj_peg->f20170929->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170929->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170930->Visible) { // f20170930 ?>
	<div id="r_f20170930" class="form-group">
		<label id="elh_t_jd_krj_peg_f20170930" for="x_f20170930" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20170930->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20170930->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20170930">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20170930" name="x_f20170930" id="x_f20170930" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20170930->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20170930->EditValue ?>"<?php echo $t_jd_krj_peg->f20170930->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20170930->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171001->Visible) { // f20171001 ?>
	<div id="r_f20171001" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171001" for="x_f20171001" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171001->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171001->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171001">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171001" name="x_f20171001" id="x_f20171001" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171001->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171001->EditValue ?>"<?php echo $t_jd_krj_peg->f20171001->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171001->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171002->Visible) { // f20171002 ?>
	<div id="r_f20171002" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171002" for="x_f20171002" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171002->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171002->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171002">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171002" name="x_f20171002" id="x_f20171002" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171002->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171002->EditValue ?>"<?php echo $t_jd_krj_peg->f20171002->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171002->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171003->Visible) { // f20171003 ?>
	<div id="r_f20171003" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171003" for="x_f20171003" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171003->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171003->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171003">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171003" name="x_f20171003" id="x_f20171003" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171003->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171003->EditValue ?>"<?php echo $t_jd_krj_peg->f20171003->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171003->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171004->Visible) { // f20171004 ?>
	<div id="r_f20171004" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171004" for="x_f20171004" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171004->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171004->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171004">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171004" name="x_f20171004" id="x_f20171004" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171004->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171004->EditValue ?>"<?php echo $t_jd_krj_peg->f20171004->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171004->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171005->Visible) { // f20171005 ?>
	<div id="r_f20171005" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171005" for="x_f20171005" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171005->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171005->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171005">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171005" name="x_f20171005" id="x_f20171005" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171005->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171005->EditValue ?>"<?php echo $t_jd_krj_peg->f20171005->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171005->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171006->Visible) { // f20171006 ?>
	<div id="r_f20171006" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171006" for="x_f20171006" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171006->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171006->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171006">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171006" name="x_f20171006" id="x_f20171006" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171006->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171006->EditValue ?>"<?php echo $t_jd_krj_peg->f20171006->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171006->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171007->Visible) { // f20171007 ?>
	<div id="r_f20171007" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171007" for="x_f20171007" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171007->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171007->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171007">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171007" name="x_f20171007" id="x_f20171007" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171007->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171007->EditValue ?>"<?php echo $t_jd_krj_peg->f20171007->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171007->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171008->Visible) { // f20171008 ?>
	<div id="r_f20171008" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171008" for="x_f20171008" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171008->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171008->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171008">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171008" name="x_f20171008" id="x_f20171008" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171008->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171008->EditValue ?>"<?php echo $t_jd_krj_peg->f20171008->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171008->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171009->Visible) { // f20171009 ?>
	<div id="r_f20171009" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171009" for="x_f20171009" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171009->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171009->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171009">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171009" name="x_f20171009" id="x_f20171009" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171009->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171009->EditValue ?>"<?php echo $t_jd_krj_peg->f20171009->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171009->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171010->Visible) { // f20171010 ?>
	<div id="r_f20171010" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171010" for="x_f20171010" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171010->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171010->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171010">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171010" name="x_f20171010" id="x_f20171010" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171010->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171010->EditValue ?>"<?php echo $t_jd_krj_peg->f20171010->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171010->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171011->Visible) { // f20171011 ?>
	<div id="r_f20171011" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171011" for="x_f20171011" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171011->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171011->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171011">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171011" name="x_f20171011" id="x_f20171011" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171011->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171011->EditValue ?>"<?php echo $t_jd_krj_peg->f20171011->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171011->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171012->Visible) { // f20171012 ?>
	<div id="r_f20171012" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171012" for="x_f20171012" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171012->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171012->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171012">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171012" name="x_f20171012" id="x_f20171012" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171012->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171012->EditValue ?>"<?php echo $t_jd_krj_peg->f20171012->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171012->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171013->Visible) { // f20171013 ?>
	<div id="r_f20171013" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171013" for="x_f20171013" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171013->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171013->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171013">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171013" name="x_f20171013" id="x_f20171013" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171013->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171013->EditValue ?>"<?php echo $t_jd_krj_peg->f20171013->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171013->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171014->Visible) { // f20171014 ?>
	<div id="r_f20171014" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171014" for="x_f20171014" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171014->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171014->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171014">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171014" name="x_f20171014" id="x_f20171014" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171014->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171014->EditValue ?>"<?php echo $t_jd_krj_peg->f20171014->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171014->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171015->Visible) { // f20171015 ?>
	<div id="r_f20171015" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171015" for="x_f20171015" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171015->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171015->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171015">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171015" name="x_f20171015" id="x_f20171015" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171015->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171015->EditValue ?>"<?php echo $t_jd_krj_peg->f20171015->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171015->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171016->Visible) { // f20171016 ?>
	<div id="r_f20171016" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171016" for="x_f20171016" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171016->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171016->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171016">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171016" name="x_f20171016" id="x_f20171016" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171016->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171016->EditValue ?>"<?php echo $t_jd_krj_peg->f20171016->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171016->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171017->Visible) { // f20171017 ?>
	<div id="r_f20171017" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171017" for="x_f20171017" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171017->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171017->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171017">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171017" name="x_f20171017" id="x_f20171017" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171017->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171017->EditValue ?>"<?php echo $t_jd_krj_peg->f20171017->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171017->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171018->Visible) { // f20171018 ?>
	<div id="r_f20171018" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171018" for="x_f20171018" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171018->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171018->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171018">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171018" name="x_f20171018" id="x_f20171018" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171018->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171018->EditValue ?>"<?php echo $t_jd_krj_peg->f20171018->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171018->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171019->Visible) { // f20171019 ?>
	<div id="r_f20171019" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171019" for="x_f20171019" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171019->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171019->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171019">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171019" name="x_f20171019" id="x_f20171019" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171019->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171019->EditValue ?>"<?php echo $t_jd_krj_peg->f20171019->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171019->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171020->Visible) { // f20171020 ?>
	<div id="r_f20171020" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171020" for="x_f20171020" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171020->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171020->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171020">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171020" name="x_f20171020" id="x_f20171020" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171020->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171020->EditValue ?>"<?php echo $t_jd_krj_peg->f20171020->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171020->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171021->Visible) { // f20171021 ?>
	<div id="r_f20171021" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171021" for="x_f20171021" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171021->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171021->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171021">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171021" name="x_f20171021" id="x_f20171021" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171021->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171021->EditValue ?>"<?php echo $t_jd_krj_peg->f20171021->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171021->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171022->Visible) { // f20171022 ?>
	<div id="r_f20171022" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171022" for="x_f20171022" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171022->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171022->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171022">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171022" name="x_f20171022" id="x_f20171022" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171022->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171022->EditValue ?>"<?php echo $t_jd_krj_peg->f20171022->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171022->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171023->Visible) { // f20171023 ?>
	<div id="r_f20171023" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171023" for="x_f20171023" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171023->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171023->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171023">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171023" name="x_f20171023" id="x_f20171023" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171023->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171023->EditValue ?>"<?php echo $t_jd_krj_peg->f20171023->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171023->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171024->Visible) { // f20171024 ?>
	<div id="r_f20171024" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171024" for="x_f20171024" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171024->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171024->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171024">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171024" name="x_f20171024" id="x_f20171024" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171024->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171024->EditValue ?>"<?php echo $t_jd_krj_peg->f20171024->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171024->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171025->Visible) { // f20171025 ?>
	<div id="r_f20171025" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171025" for="x_f20171025" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171025->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171025->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171025">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171025" name="x_f20171025" id="x_f20171025" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171025->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171025->EditValue ?>"<?php echo $t_jd_krj_peg->f20171025->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171025->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171026->Visible) { // f20171026 ?>
	<div id="r_f20171026" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171026" for="x_f20171026" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171026->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171026->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171026">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171026" name="x_f20171026" id="x_f20171026" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171026->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171026->EditValue ?>"<?php echo $t_jd_krj_peg->f20171026->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171026->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171027->Visible) { // f20171027 ?>
	<div id="r_f20171027" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171027" for="x_f20171027" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171027->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171027->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171027">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171027" name="x_f20171027" id="x_f20171027" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171027->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171027->EditValue ?>"<?php echo $t_jd_krj_peg->f20171027->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171027->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171028->Visible) { // f20171028 ?>
	<div id="r_f20171028" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171028" for="x_f20171028" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171028->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171028->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171028">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171028" name="x_f20171028" id="x_f20171028" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171028->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171028->EditValue ?>"<?php echo $t_jd_krj_peg->f20171028->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171028->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171029->Visible) { // f20171029 ?>
	<div id="r_f20171029" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171029" for="x_f20171029" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171029->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171029->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171029">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171029" name="x_f20171029" id="x_f20171029" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171029->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171029->EditValue ?>"<?php echo $t_jd_krj_peg->f20171029->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171029->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171030->Visible) { // f20171030 ?>
	<div id="r_f20171030" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171030" for="x_f20171030" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171030->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171030->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171030">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171030" name="x_f20171030" id="x_f20171030" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171030->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171030->EditValue ?>"<?php echo $t_jd_krj_peg->f20171030->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171030->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171031->Visible) { // f20171031 ?>
	<div id="r_f20171031" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171031" for="x_f20171031" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171031->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171031->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171031">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171031" name="x_f20171031" id="x_f20171031" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171031->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171031->EditValue ?>"<?php echo $t_jd_krj_peg->f20171031->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171031->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171101->Visible) { // f20171101 ?>
	<div id="r_f20171101" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171101" for="x_f20171101" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171101->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171101->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171101">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171101" name="x_f20171101" id="x_f20171101" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171101->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171101->EditValue ?>"<?php echo $t_jd_krj_peg->f20171101->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171101->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171102->Visible) { // f20171102 ?>
	<div id="r_f20171102" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171102" for="x_f20171102" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171102->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171102->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171102">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171102" name="x_f20171102" id="x_f20171102" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171102->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171102->EditValue ?>"<?php echo $t_jd_krj_peg->f20171102->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171102->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171103->Visible) { // f20171103 ?>
	<div id="r_f20171103" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171103" for="x_f20171103" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171103->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171103->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171103">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171103" name="x_f20171103" id="x_f20171103" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171103->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171103->EditValue ?>"<?php echo $t_jd_krj_peg->f20171103->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171103->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171104->Visible) { // f20171104 ?>
	<div id="r_f20171104" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171104" for="x_f20171104" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171104->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171104->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171104">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171104" name="x_f20171104" id="x_f20171104" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171104->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171104->EditValue ?>"<?php echo $t_jd_krj_peg->f20171104->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171104->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171105->Visible) { // f20171105 ?>
	<div id="r_f20171105" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171105" for="x_f20171105" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171105->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171105->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171105">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171105" name="x_f20171105" id="x_f20171105" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171105->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171105->EditValue ?>"<?php echo $t_jd_krj_peg->f20171105->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171105->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171106->Visible) { // f20171106 ?>
	<div id="r_f20171106" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171106" for="x_f20171106" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171106->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171106->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171106">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171106" name="x_f20171106" id="x_f20171106" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171106->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171106->EditValue ?>"<?php echo $t_jd_krj_peg->f20171106->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171106->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171107->Visible) { // f20171107 ?>
	<div id="r_f20171107" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171107" for="x_f20171107" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171107->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171107->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171107">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171107" name="x_f20171107" id="x_f20171107" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171107->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171107->EditValue ?>"<?php echo $t_jd_krj_peg->f20171107->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171107->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171108->Visible) { // f20171108 ?>
	<div id="r_f20171108" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171108" for="x_f20171108" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171108->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171108->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171108">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171108" name="x_f20171108" id="x_f20171108" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171108->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171108->EditValue ?>"<?php echo $t_jd_krj_peg->f20171108->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171108->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171109->Visible) { // f20171109 ?>
	<div id="r_f20171109" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171109" for="x_f20171109" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171109->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171109->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171109">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171109" name="x_f20171109" id="x_f20171109" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171109->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171109->EditValue ?>"<?php echo $t_jd_krj_peg->f20171109->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171109->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171110->Visible) { // f20171110 ?>
	<div id="r_f20171110" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171110" for="x_f20171110" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171110->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171110->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171110">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171110" name="x_f20171110" id="x_f20171110" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171110->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171110->EditValue ?>"<?php echo $t_jd_krj_peg->f20171110->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171110->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171111->Visible) { // f20171111 ?>
	<div id="r_f20171111" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171111" for="x_f20171111" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171111->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171111->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171111">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171111" name="x_f20171111" id="x_f20171111" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171111->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171111->EditValue ?>"<?php echo $t_jd_krj_peg->f20171111->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171111->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171112->Visible) { // f20171112 ?>
	<div id="r_f20171112" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171112" for="x_f20171112" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171112->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171112->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171112">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171112" name="x_f20171112" id="x_f20171112" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171112->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171112->EditValue ?>"<?php echo $t_jd_krj_peg->f20171112->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171112->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171113->Visible) { // f20171113 ?>
	<div id="r_f20171113" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171113" for="x_f20171113" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171113->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171113->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171113">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171113" name="x_f20171113" id="x_f20171113" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171113->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171113->EditValue ?>"<?php echo $t_jd_krj_peg->f20171113->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171113->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171114->Visible) { // f20171114 ?>
	<div id="r_f20171114" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171114" for="x_f20171114" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171114->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171114->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171114">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171114" name="x_f20171114" id="x_f20171114" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171114->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171114->EditValue ?>"<?php echo $t_jd_krj_peg->f20171114->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171114->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171115->Visible) { // f20171115 ?>
	<div id="r_f20171115" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171115" for="x_f20171115" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171115->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171115->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171115">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171115" name="x_f20171115" id="x_f20171115" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171115->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171115->EditValue ?>"<?php echo $t_jd_krj_peg->f20171115->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171115->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171116->Visible) { // f20171116 ?>
	<div id="r_f20171116" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171116" for="x_f20171116" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171116->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171116->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171116">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171116" name="x_f20171116" id="x_f20171116" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171116->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171116->EditValue ?>"<?php echo $t_jd_krj_peg->f20171116->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171116->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171117->Visible) { // f20171117 ?>
	<div id="r_f20171117" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171117" for="x_f20171117" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171117->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171117->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171117">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171117" name="x_f20171117" id="x_f20171117" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171117->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171117->EditValue ?>"<?php echo $t_jd_krj_peg->f20171117->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171117->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171118->Visible) { // f20171118 ?>
	<div id="r_f20171118" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171118" for="x_f20171118" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171118->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171118->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171118">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171118" name="x_f20171118" id="x_f20171118" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171118->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171118->EditValue ?>"<?php echo $t_jd_krj_peg->f20171118->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171118->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171119->Visible) { // f20171119 ?>
	<div id="r_f20171119" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171119" for="x_f20171119" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171119->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171119->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171119">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171119" name="x_f20171119" id="x_f20171119" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171119->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171119->EditValue ?>"<?php echo $t_jd_krj_peg->f20171119->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171119->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171120->Visible) { // f20171120 ?>
	<div id="r_f20171120" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171120" for="x_f20171120" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171120->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171120->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171120">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171120" name="x_f20171120" id="x_f20171120" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171120->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171120->EditValue ?>"<?php echo $t_jd_krj_peg->f20171120->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171120->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171121->Visible) { // f20171121 ?>
	<div id="r_f20171121" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171121" for="x_f20171121" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171121->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171121->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171121">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171121" name="x_f20171121" id="x_f20171121" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171121->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171121->EditValue ?>"<?php echo $t_jd_krj_peg->f20171121->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171121->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171122->Visible) { // f20171122 ?>
	<div id="r_f20171122" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171122" for="x_f20171122" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171122->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171122->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171122">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171122" name="x_f20171122" id="x_f20171122" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171122->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171122->EditValue ?>"<?php echo $t_jd_krj_peg->f20171122->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171122->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171123->Visible) { // f20171123 ?>
	<div id="r_f20171123" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171123" for="x_f20171123" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171123->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171123->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171123">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171123" name="x_f20171123" id="x_f20171123" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171123->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171123->EditValue ?>"<?php echo $t_jd_krj_peg->f20171123->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171123->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171124->Visible) { // f20171124 ?>
	<div id="r_f20171124" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171124" for="x_f20171124" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171124->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171124->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171124">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171124" name="x_f20171124" id="x_f20171124" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171124->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171124->EditValue ?>"<?php echo $t_jd_krj_peg->f20171124->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171124->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171125->Visible) { // f20171125 ?>
	<div id="r_f20171125" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171125" for="x_f20171125" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171125->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171125->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171125">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171125" name="x_f20171125" id="x_f20171125" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171125->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171125->EditValue ?>"<?php echo $t_jd_krj_peg->f20171125->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171125->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171126->Visible) { // f20171126 ?>
	<div id="r_f20171126" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171126" for="x_f20171126" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171126->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171126->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171126">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171126" name="x_f20171126" id="x_f20171126" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171126->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171126->EditValue ?>"<?php echo $t_jd_krj_peg->f20171126->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171126->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171127->Visible) { // f20171127 ?>
	<div id="r_f20171127" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171127" for="x_f20171127" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171127->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171127->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171127">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171127" name="x_f20171127" id="x_f20171127" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171127->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171127->EditValue ?>"<?php echo $t_jd_krj_peg->f20171127->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171127->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171128->Visible) { // f20171128 ?>
	<div id="r_f20171128" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171128" for="x_f20171128" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171128->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171128->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171128">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171128" name="x_f20171128" id="x_f20171128" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171128->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171128->EditValue ?>"<?php echo $t_jd_krj_peg->f20171128->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171128->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171129->Visible) { // f20171129 ?>
	<div id="r_f20171129" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171129" for="x_f20171129" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171129->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171129->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171129">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171129" name="x_f20171129" id="x_f20171129" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171129->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171129->EditValue ?>"<?php echo $t_jd_krj_peg->f20171129->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171129->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171130->Visible) { // f20171130 ?>
	<div id="r_f20171130" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171130" for="x_f20171130" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171130->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171130->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171130">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171130" name="x_f20171130" id="x_f20171130" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171130->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171130->EditValue ?>"<?php echo $t_jd_krj_peg->f20171130->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171130->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171201->Visible) { // f20171201 ?>
	<div id="r_f20171201" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171201" for="x_f20171201" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171201->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171201->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171201">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171201" name="x_f20171201" id="x_f20171201" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171201->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171201->EditValue ?>"<?php echo $t_jd_krj_peg->f20171201->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171201->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171202->Visible) { // f20171202 ?>
	<div id="r_f20171202" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171202" for="x_f20171202" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171202->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171202->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171202">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171202" name="x_f20171202" id="x_f20171202" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171202->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171202->EditValue ?>"<?php echo $t_jd_krj_peg->f20171202->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171202->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171203->Visible) { // f20171203 ?>
	<div id="r_f20171203" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171203" for="x_f20171203" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171203->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171203->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171203">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171203" name="x_f20171203" id="x_f20171203" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171203->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171203->EditValue ?>"<?php echo $t_jd_krj_peg->f20171203->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171203->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171204->Visible) { // f20171204 ?>
	<div id="r_f20171204" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171204" for="x_f20171204" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171204->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171204->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171204">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171204" name="x_f20171204" id="x_f20171204" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171204->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171204->EditValue ?>"<?php echo $t_jd_krj_peg->f20171204->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171204->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171205->Visible) { // f20171205 ?>
	<div id="r_f20171205" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171205" for="x_f20171205" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171205->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171205->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171205">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171205" name="x_f20171205" id="x_f20171205" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171205->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171205->EditValue ?>"<?php echo $t_jd_krj_peg->f20171205->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171205->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171206->Visible) { // f20171206 ?>
	<div id="r_f20171206" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171206" for="x_f20171206" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171206->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171206->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171206">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171206" name="x_f20171206" id="x_f20171206" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171206->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171206->EditValue ?>"<?php echo $t_jd_krj_peg->f20171206->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171206->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171207->Visible) { // f20171207 ?>
	<div id="r_f20171207" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171207" for="x_f20171207" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171207->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171207->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171207">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171207" name="x_f20171207" id="x_f20171207" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171207->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171207->EditValue ?>"<?php echo $t_jd_krj_peg->f20171207->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171207->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171208->Visible) { // f20171208 ?>
	<div id="r_f20171208" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171208" for="x_f20171208" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171208->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171208->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171208">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171208" name="x_f20171208" id="x_f20171208" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171208->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171208->EditValue ?>"<?php echo $t_jd_krj_peg->f20171208->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171208->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171209->Visible) { // f20171209 ?>
	<div id="r_f20171209" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171209" for="x_f20171209" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171209->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171209->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171209">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171209" name="x_f20171209" id="x_f20171209" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171209->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171209->EditValue ?>"<?php echo $t_jd_krj_peg->f20171209->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171209->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171210->Visible) { // f20171210 ?>
	<div id="r_f20171210" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171210" for="x_f20171210" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171210->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171210->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171210">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171210" name="x_f20171210" id="x_f20171210" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171210->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171210->EditValue ?>"<?php echo $t_jd_krj_peg->f20171210->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171210->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171211->Visible) { // f20171211 ?>
	<div id="r_f20171211" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171211" for="x_f20171211" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171211->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171211->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171211">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171211" name="x_f20171211" id="x_f20171211" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171211->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171211->EditValue ?>"<?php echo $t_jd_krj_peg->f20171211->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171211->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171212->Visible) { // f20171212 ?>
	<div id="r_f20171212" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171212" for="x_f20171212" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171212->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171212->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171212">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171212" name="x_f20171212" id="x_f20171212" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171212->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171212->EditValue ?>"<?php echo $t_jd_krj_peg->f20171212->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171212->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171213->Visible) { // f20171213 ?>
	<div id="r_f20171213" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171213" for="x_f20171213" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171213->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171213->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171213">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171213" name="x_f20171213" id="x_f20171213" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171213->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171213->EditValue ?>"<?php echo $t_jd_krj_peg->f20171213->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171213->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171214->Visible) { // f20171214 ?>
	<div id="r_f20171214" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171214" for="x_f20171214" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171214->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171214->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171214">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171214" name="x_f20171214" id="x_f20171214" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171214->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171214->EditValue ?>"<?php echo $t_jd_krj_peg->f20171214->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171214->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171215->Visible) { // f20171215 ?>
	<div id="r_f20171215" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171215" for="x_f20171215" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171215->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171215->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171215">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171215" name="x_f20171215" id="x_f20171215" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171215->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171215->EditValue ?>"<?php echo $t_jd_krj_peg->f20171215->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171215->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171216->Visible) { // f20171216 ?>
	<div id="r_f20171216" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171216" for="x_f20171216" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171216->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171216->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171216">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171216" name="x_f20171216" id="x_f20171216" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171216->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171216->EditValue ?>"<?php echo $t_jd_krj_peg->f20171216->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171216->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171217->Visible) { // f20171217 ?>
	<div id="r_f20171217" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171217" for="x_f20171217" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171217->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171217->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171217">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171217" name="x_f20171217" id="x_f20171217" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171217->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171217->EditValue ?>"<?php echo $t_jd_krj_peg->f20171217->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171217->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171218->Visible) { // f20171218 ?>
	<div id="r_f20171218" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171218" for="x_f20171218" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171218->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171218->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171218">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171218" name="x_f20171218" id="x_f20171218" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171218->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171218->EditValue ?>"<?php echo $t_jd_krj_peg->f20171218->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171218->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171219->Visible) { // f20171219 ?>
	<div id="r_f20171219" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171219" for="x_f20171219" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171219->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171219->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171219">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171219" name="x_f20171219" id="x_f20171219" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171219->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171219->EditValue ?>"<?php echo $t_jd_krj_peg->f20171219->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171219->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171220->Visible) { // f20171220 ?>
	<div id="r_f20171220" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171220" for="x_f20171220" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171220->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171220->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171220">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171220" name="x_f20171220" id="x_f20171220" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171220->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171220->EditValue ?>"<?php echo $t_jd_krj_peg->f20171220->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171220->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171221->Visible) { // f20171221 ?>
	<div id="r_f20171221" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171221" for="x_f20171221" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171221->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171221->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171221">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171221" name="x_f20171221" id="x_f20171221" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171221->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171221->EditValue ?>"<?php echo $t_jd_krj_peg->f20171221->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171221->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171222->Visible) { // f20171222 ?>
	<div id="r_f20171222" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171222" for="x_f20171222" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171222->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171222->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171222">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171222" name="x_f20171222" id="x_f20171222" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171222->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171222->EditValue ?>"<?php echo $t_jd_krj_peg->f20171222->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171222->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171223->Visible) { // f20171223 ?>
	<div id="r_f20171223" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171223" for="x_f20171223" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171223->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171223->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171223">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171223" name="x_f20171223" id="x_f20171223" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171223->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171223->EditValue ?>"<?php echo $t_jd_krj_peg->f20171223->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171223->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171224->Visible) { // f20171224 ?>
	<div id="r_f20171224" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171224" for="x_f20171224" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171224->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171224->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171224">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171224" name="x_f20171224" id="x_f20171224" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171224->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171224->EditValue ?>"<?php echo $t_jd_krj_peg->f20171224->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171224->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171225->Visible) { // f20171225 ?>
	<div id="r_f20171225" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171225" for="x_f20171225" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171225->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171225->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171225">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171225" name="x_f20171225" id="x_f20171225" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171225->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171225->EditValue ?>"<?php echo $t_jd_krj_peg->f20171225->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171225->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171226->Visible) { // f20171226 ?>
	<div id="r_f20171226" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171226" for="x_f20171226" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171226->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171226->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171226">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171226" name="x_f20171226" id="x_f20171226" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171226->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171226->EditValue ?>"<?php echo $t_jd_krj_peg->f20171226->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171226->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171227->Visible) { // f20171227 ?>
	<div id="r_f20171227" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171227" for="x_f20171227" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171227->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171227->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171227">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171227" name="x_f20171227" id="x_f20171227" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171227->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171227->EditValue ?>"<?php echo $t_jd_krj_peg->f20171227->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171227->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171228->Visible) { // f20171228 ?>
	<div id="r_f20171228" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171228" for="x_f20171228" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171228->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171228->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171228">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171228" name="x_f20171228" id="x_f20171228" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171228->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171228->EditValue ?>"<?php echo $t_jd_krj_peg->f20171228->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171228->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171229->Visible) { // f20171229 ?>
	<div id="r_f20171229" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171229" for="x_f20171229" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171229->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171229->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171229">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171229" name="x_f20171229" id="x_f20171229" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171229->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171229->EditValue ?>"<?php echo $t_jd_krj_peg->f20171229->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171229->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171230->Visible) { // f20171230 ?>
	<div id="r_f20171230" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171230" for="x_f20171230" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171230->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171230->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171230">
<input type="text" data-table="t_jd_krj_peg" data-field="x_f20171230" name="x_f20171230" id="x_f20171230" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171230->getPlaceHolder()) ?>" value="<?php echo $t_jd_krj_peg->f20171230->EditValue ?>"<?php echo $t_jd_krj_peg->f20171230->EditAttributes() ?>>
</span>
<?php echo $t_jd_krj_peg->f20171230->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171231->Visible) { // f20171231 ?>
	<div id="r_f20171231" class="form-group">
		<label id="elh_t_jd_krj_peg_f20171231" class="col-sm-2 control-label ewLabel"><?php echo $t_jd_krj_peg->f20171231->FldCaption() ?></label>
		<div class="col-sm-10"><div<?php echo $t_jd_krj_peg->f20171231->CellAttributes() ?>>
<span id="el_t_jd_krj_peg_f20171231">
<?php
$wrkonchange = trim(" " . @$t_jd_krj_peg->f20171231->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t_jd_krj_peg->f20171231->EditAttrs["onchange"] = "";
?>
<span id="as_x_f20171231" style="white-space: nowrap; z-index: 5320">
	<input type="text" name="sv_x_f20171231" id="sv_x_f20171231" value="<?php echo $t_jd_krj_peg->f20171231->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171231->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171231->getPlaceHolder()) ?>"<?php echo $t_jd_krj_peg->f20171231->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t_jd_krj_peg" data-field="x_f20171231" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t_jd_krj_peg->f20171231->DisplayValueSeparatorAttribute() ?>" name="x_f20171231" id="x_f20171231" value="<?php echo ew_HtmlEncode($t_jd_krj_peg->f20171231->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x_f20171231" id="q_x_f20171231" value="<?php echo $t_jd_krj_peg->f20171231->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft_jd_krj_pegadd.CreateAutoSuggest({"id":"x_f20171231","forceSelect":true});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t_jd_krj_peg->f20171231->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_f20171231',m:0,n:10,srch:false});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" name="s_x_f20171231" id="s_x_f20171231" value="<?php echo $t_jd_krj_peg->f20171231->LookupFilterQuery(false) ?>">
</span>
<?php echo $t_jd_krj_peg->f20171231->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<?php if (!$t_jd_krj_peg_add->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t_jd_krj_peg_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php } ?>
</form>
<script type="text/javascript">
ft_jd_krj_pegadd.Init();
</script>
<?php
$t_jd_krj_peg_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t_jd_krj_peg_add->Page_Terminate();
?>
