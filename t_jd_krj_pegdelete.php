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

$t_jd_krj_peg_delete = NULL; // Initialize page object first

class ct_jd_krj_peg_delete extends ct_jd_krj_peg {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = "{4B5DAB39-E4BC-48DF-9311-E295A5F18030}";

	// Table name
	var $TableName = 't_jd_krj_peg';

	// Page object name
	var $PageObjName = 't_jd_krj_peg_delete';

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
			define("EW_PAGE_ID", 'delete', TRUE);

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
		if (!$Security->CanDelete()) {
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
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->jdwkrjpeg_id->SetVisibility();
		$this->jdwkrjpeg_id->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
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
			$this->Page_Terminate("t_jd_krj_peglist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in t_jd_krj_peg class, t_jd_krj_peginfo.php

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
				$this->Page_Terminate("t_jd_krj_peglist.php"); // Return to list
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

			// jdwkrjpeg_id
			$this->jdwkrjpeg_id->LinkCustomAttributes = "";
			$this->jdwkrjpeg_id->HrefValue = "";
			$this->jdwkrjpeg_id->TooltipValue = "";

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
		if ($this->AuditTrailOnDelete) $this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteBegin")); // Batch delete begin

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
				$sThisKey .= $row['jdwkrjpeg_id'];
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
			if ($this->AuditTrailOnDelete) $this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteSuccess")); // Batch delete success
		} else {
			$conn->RollbackTrans(); // Rollback changes
			if ($this->AuditTrailOnDelete) $this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteRollback")); // Batch delete rollback
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t_jd_krj_peglist.php"), "", $this->TableVar, TRUE);
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
if (!isset($t_jd_krj_peg_delete)) $t_jd_krj_peg_delete = new ct_jd_krj_peg_delete();

// Page init
$t_jd_krj_peg_delete->Page_Init();

// Page main
$t_jd_krj_peg_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t_jd_krj_peg_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = ft_jd_krj_pegdelete = new ew_Form("ft_jd_krj_pegdelete", "delete");

// Form_CustomValidate event
ft_jd_krj_pegdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft_jd_krj_pegdelete.ValidateRequired = true;
<?php } else { ?>
ft_jd_krj_pegdelete.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft_jd_krj_pegdelete.Lists["x_f20170102"] = {"LinkField":"x_jk_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_jk_nm","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t_jk"};
ft_jd_krj_pegdelete.Lists["x_f20171231"] = {"LinkField":"x_jk_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_jk_nm","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t_jk"};

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
<?php $t_jd_krj_peg_delete->ShowPageHeader(); ?>
<?php
$t_jd_krj_peg_delete->ShowMessage();
?>
<form name="ft_jd_krj_pegdelete" id="ft_jd_krj_pegdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t_jd_krj_peg_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t_jd_krj_peg_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t_jd_krj_peg">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($t_jd_krj_peg_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table class="table ewTable">
<?php echo $t_jd_krj_peg->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
<?php if ($t_jd_krj_peg->jdwkrjpeg_id->Visible) { // jdwkrjpeg_id ?>
		<th><span id="elh_t_jd_krj_peg_jdwkrjpeg_id" class="t_jd_krj_peg_jdwkrjpeg_id"><?php echo $t_jd_krj_peg->jdwkrjpeg_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->pegawai_id->Visible) { // pegawai_id ?>
		<th><span id="elh_t_jd_krj_peg_pegawai_id" class="t_jd_krj_peg_pegawai_id"><?php echo $t_jd_krj_peg->pegawai_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170101->Visible) { // f20170101 ?>
		<th><span id="elh_t_jd_krj_peg_f20170101" class="t_jd_krj_peg_f20170101"><?php echo $t_jd_krj_peg->f20170101->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170102->Visible) { // f20170102 ?>
		<th><span id="elh_t_jd_krj_peg_f20170102" class="t_jd_krj_peg_f20170102"><?php echo $t_jd_krj_peg->f20170102->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170103->Visible) { // f20170103 ?>
		<th><span id="elh_t_jd_krj_peg_f20170103" class="t_jd_krj_peg_f20170103"><?php echo $t_jd_krj_peg->f20170103->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170104->Visible) { // f20170104 ?>
		<th><span id="elh_t_jd_krj_peg_f20170104" class="t_jd_krj_peg_f20170104"><?php echo $t_jd_krj_peg->f20170104->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170105->Visible) { // f20170105 ?>
		<th><span id="elh_t_jd_krj_peg_f20170105" class="t_jd_krj_peg_f20170105"><?php echo $t_jd_krj_peg->f20170105->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170106->Visible) { // f20170106 ?>
		<th><span id="elh_t_jd_krj_peg_f20170106" class="t_jd_krj_peg_f20170106"><?php echo $t_jd_krj_peg->f20170106->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170107->Visible) { // f20170107 ?>
		<th><span id="elh_t_jd_krj_peg_f20170107" class="t_jd_krj_peg_f20170107"><?php echo $t_jd_krj_peg->f20170107->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170108->Visible) { // f20170108 ?>
		<th><span id="elh_t_jd_krj_peg_f20170108" class="t_jd_krj_peg_f20170108"><?php echo $t_jd_krj_peg->f20170108->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170109->Visible) { // f20170109 ?>
		<th><span id="elh_t_jd_krj_peg_f20170109" class="t_jd_krj_peg_f20170109"><?php echo $t_jd_krj_peg->f20170109->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170110->Visible) { // f20170110 ?>
		<th><span id="elh_t_jd_krj_peg_f20170110" class="t_jd_krj_peg_f20170110"><?php echo $t_jd_krj_peg->f20170110->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170111->Visible) { // f20170111 ?>
		<th><span id="elh_t_jd_krj_peg_f20170111" class="t_jd_krj_peg_f20170111"><?php echo $t_jd_krj_peg->f20170111->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170112->Visible) { // f20170112 ?>
		<th><span id="elh_t_jd_krj_peg_f20170112" class="t_jd_krj_peg_f20170112"><?php echo $t_jd_krj_peg->f20170112->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170113->Visible) { // f20170113 ?>
		<th><span id="elh_t_jd_krj_peg_f20170113" class="t_jd_krj_peg_f20170113"><?php echo $t_jd_krj_peg->f20170113->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170114->Visible) { // f20170114 ?>
		<th><span id="elh_t_jd_krj_peg_f20170114" class="t_jd_krj_peg_f20170114"><?php echo $t_jd_krj_peg->f20170114->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170115->Visible) { // f20170115 ?>
		<th><span id="elh_t_jd_krj_peg_f20170115" class="t_jd_krj_peg_f20170115"><?php echo $t_jd_krj_peg->f20170115->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170116->Visible) { // f20170116 ?>
		<th><span id="elh_t_jd_krj_peg_f20170116" class="t_jd_krj_peg_f20170116"><?php echo $t_jd_krj_peg->f20170116->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170117->Visible) { // f20170117 ?>
		<th><span id="elh_t_jd_krj_peg_f20170117" class="t_jd_krj_peg_f20170117"><?php echo $t_jd_krj_peg->f20170117->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170118->Visible) { // f20170118 ?>
		<th><span id="elh_t_jd_krj_peg_f20170118" class="t_jd_krj_peg_f20170118"><?php echo $t_jd_krj_peg->f20170118->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170119->Visible) { // f20170119 ?>
		<th><span id="elh_t_jd_krj_peg_f20170119" class="t_jd_krj_peg_f20170119"><?php echo $t_jd_krj_peg->f20170119->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170120->Visible) { // f20170120 ?>
		<th><span id="elh_t_jd_krj_peg_f20170120" class="t_jd_krj_peg_f20170120"><?php echo $t_jd_krj_peg->f20170120->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170121->Visible) { // f20170121 ?>
		<th><span id="elh_t_jd_krj_peg_f20170121" class="t_jd_krj_peg_f20170121"><?php echo $t_jd_krj_peg->f20170121->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170122->Visible) { // f20170122 ?>
		<th><span id="elh_t_jd_krj_peg_f20170122" class="t_jd_krj_peg_f20170122"><?php echo $t_jd_krj_peg->f20170122->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170123->Visible) { // f20170123 ?>
		<th><span id="elh_t_jd_krj_peg_f20170123" class="t_jd_krj_peg_f20170123"><?php echo $t_jd_krj_peg->f20170123->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170124->Visible) { // f20170124 ?>
		<th><span id="elh_t_jd_krj_peg_f20170124" class="t_jd_krj_peg_f20170124"><?php echo $t_jd_krj_peg->f20170124->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170125->Visible) { // f20170125 ?>
		<th><span id="elh_t_jd_krj_peg_f20170125" class="t_jd_krj_peg_f20170125"><?php echo $t_jd_krj_peg->f20170125->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170126->Visible) { // f20170126 ?>
		<th><span id="elh_t_jd_krj_peg_f20170126" class="t_jd_krj_peg_f20170126"><?php echo $t_jd_krj_peg->f20170126->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170127->Visible) { // f20170127 ?>
		<th><span id="elh_t_jd_krj_peg_f20170127" class="t_jd_krj_peg_f20170127"><?php echo $t_jd_krj_peg->f20170127->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170128->Visible) { // f20170128 ?>
		<th><span id="elh_t_jd_krj_peg_f20170128" class="t_jd_krj_peg_f20170128"><?php echo $t_jd_krj_peg->f20170128->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170129->Visible) { // f20170129 ?>
		<th><span id="elh_t_jd_krj_peg_f20170129" class="t_jd_krj_peg_f20170129"><?php echo $t_jd_krj_peg->f20170129->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170130->Visible) { // f20170130 ?>
		<th><span id="elh_t_jd_krj_peg_f20170130" class="t_jd_krj_peg_f20170130"><?php echo $t_jd_krj_peg->f20170130->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170131->Visible) { // f20170131 ?>
		<th><span id="elh_t_jd_krj_peg_f20170131" class="t_jd_krj_peg_f20170131"><?php echo $t_jd_krj_peg->f20170131->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170201->Visible) { // f20170201 ?>
		<th><span id="elh_t_jd_krj_peg_f20170201" class="t_jd_krj_peg_f20170201"><?php echo $t_jd_krj_peg->f20170201->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170202->Visible) { // f20170202 ?>
		<th><span id="elh_t_jd_krj_peg_f20170202" class="t_jd_krj_peg_f20170202"><?php echo $t_jd_krj_peg->f20170202->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170203->Visible) { // f20170203 ?>
		<th><span id="elh_t_jd_krj_peg_f20170203" class="t_jd_krj_peg_f20170203"><?php echo $t_jd_krj_peg->f20170203->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170204->Visible) { // f20170204 ?>
		<th><span id="elh_t_jd_krj_peg_f20170204" class="t_jd_krj_peg_f20170204"><?php echo $t_jd_krj_peg->f20170204->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170205->Visible) { // f20170205 ?>
		<th><span id="elh_t_jd_krj_peg_f20170205" class="t_jd_krj_peg_f20170205"><?php echo $t_jd_krj_peg->f20170205->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170206->Visible) { // f20170206 ?>
		<th><span id="elh_t_jd_krj_peg_f20170206" class="t_jd_krj_peg_f20170206"><?php echo $t_jd_krj_peg->f20170206->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170207->Visible) { // f20170207 ?>
		<th><span id="elh_t_jd_krj_peg_f20170207" class="t_jd_krj_peg_f20170207"><?php echo $t_jd_krj_peg->f20170207->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170208->Visible) { // f20170208 ?>
		<th><span id="elh_t_jd_krj_peg_f20170208" class="t_jd_krj_peg_f20170208"><?php echo $t_jd_krj_peg->f20170208->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170209->Visible) { // f20170209 ?>
		<th><span id="elh_t_jd_krj_peg_f20170209" class="t_jd_krj_peg_f20170209"><?php echo $t_jd_krj_peg->f20170209->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170210->Visible) { // f20170210 ?>
		<th><span id="elh_t_jd_krj_peg_f20170210" class="t_jd_krj_peg_f20170210"><?php echo $t_jd_krj_peg->f20170210->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170211->Visible) { // f20170211 ?>
		<th><span id="elh_t_jd_krj_peg_f20170211" class="t_jd_krj_peg_f20170211"><?php echo $t_jd_krj_peg->f20170211->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170212->Visible) { // f20170212 ?>
		<th><span id="elh_t_jd_krj_peg_f20170212" class="t_jd_krj_peg_f20170212"><?php echo $t_jd_krj_peg->f20170212->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170213->Visible) { // f20170213 ?>
		<th><span id="elh_t_jd_krj_peg_f20170213" class="t_jd_krj_peg_f20170213"><?php echo $t_jd_krj_peg->f20170213->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170214->Visible) { // f20170214 ?>
		<th><span id="elh_t_jd_krj_peg_f20170214" class="t_jd_krj_peg_f20170214"><?php echo $t_jd_krj_peg->f20170214->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170215->Visible) { // f20170215 ?>
		<th><span id="elh_t_jd_krj_peg_f20170215" class="t_jd_krj_peg_f20170215"><?php echo $t_jd_krj_peg->f20170215->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170216->Visible) { // f20170216 ?>
		<th><span id="elh_t_jd_krj_peg_f20170216" class="t_jd_krj_peg_f20170216"><?php echo $t_jd_krj_peg->f20170216->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170217->Visible) { // f20170217 ?>
		<th><span id="elh_t_jd_krj_peg_f20170217" class="t_jd_krj_peg_f20170217"><?php echo $t_jd_krj_peg->f20170217->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170218->Visible) { // f20170218 ?>
		<th><span id="elh_t_jd_krj_peg_f20170218" class="t_jd_krj_peg_f20170218"><?php echo $t_jd_krj_peg->f20170218->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170219->Visible) { // f20170219 ?>
		<th><span id="elh_t_jd_krj_peg_f20170219" class="t_jd_krj_peg_f20170219"><?php echo $t_jd_krj_peg->f20170219->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170220->Visible) { // f20170220 ?>
		<th><span id="elh_t_jd_krj_peg_f20170220" class="t_jd_krj_peg_f20170220"><?php echo $t_jd_krj_peg->f20170220->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170221->Visible) { // f20170221 ?>
		<th><span id="elh_t_jd_krj_peg_f20170221" class="t_jd_krj_peg_f20170221"><?php echo $t_jd_krj_peg->f20170221->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170222->Visible) { // f20170222 ?>
		<th><span id="elh_t_jd_krj_peg_f20170222" class="t_jd_krj_peg_f20170222"><?php echo $t_jd_krj_peg->f20170222->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170223->Visible) { // f20170223 ?>
		<th><span id="elh_t_jd_krj_peg_f20170223" class="t_jd_krj_peg_f20170223"><?php echo $t_jd_krj_peg->f20170223->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170224->Visible) { // f20170224 ?>
		<th><span id="elh_t_jd_krj_peg_f20170224" class="t_jd_krj_peg_f20170224"><?php echo $t_jd_krj_peg->f20170224->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170225->Visible) { // f20170225 ?>
		<th><span id="elh_t_jd_krj_peg_f20170225" class="t_jd_krj_peg_f20170225"><?php echo $t_jd_krj_peg->f20170225->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170226->Visible) { // f20170226 ?>
		<th><span id="elh_t_jd_krj_peg_f20170226" class="t_jd_krj_peg_f20170226"><?php echo $t_jd_krj_peg->f20170226->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170227->Visible) { // f20170227 ?>
		<th><span id="elh_t_jd_krj_peg_f20170227" class="t_jd_krj_peg_f20170227"><?php echo $t_jd_krj_peg->f20170227->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170228->Visible) { // f20170228 ?>
		<th><span id="elh_t_jd_krj_peg_f20170228" class="t_jd_krj_peg_f20170228"><?php echo $t_jd_krj_peg->f20170228->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170229->Visible) { // f20170229 ?>
		<th><span id="elh_t_jd_krj_peg_f20170229" class="t_jd_krj_peg_f20170229"><?php echo $t_jd_krj_peg->f20170229->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170301->Visible) { // f20170301 ?>
		<th><span id="elh_t_jd_krj_peg_f20170301" class="t_jd_krj_peg_f20170301"><?php echo $t_jd_krj_peg->f20170301->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170302->Visible) { // f20170302 ?>
		<th><span id="elh_t_jd_krj_peg_f20170302" class="t_jd_krj_peg_f20170302"><?php echo $t_jd_krj_peg->f20170302->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170303->Visible) { // f20170303 ?>
		<th><span id="elh_t_jd_krj_peg_f20170303" class="t_jd_krj_peg_f20170303"><?php echo $t_jd_krj_peg->f20170303->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170304->Visible) { // f20170304 ?>
		<th><span id="elh_t_jd_krj_peg_f20170304" class="t_jd_krj_peg_f20170304"><?php echo $t_jd_krj_peg->f20170304->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170305->Visible) { // f20170305 ?>
		<th><span id="elh_t_jd_krj_peg_f20170305" class="t_jd_krj_peg_f20170305"><?php echo $t_jd_krj_peg->f20170305->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170306->Visible) { // f20170306 ?>
		<th><span id="elh_t_jd_krj_peg_f20170306" class="t_jd_krj_peg_f20170306"><?php echo $t_jd_krj_peg->f20170306->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170307->Visible) { // f20170307 ?>
		<th><span id="elh_t_jd_krj_peg_f20170307" class="t_jd_krj_peg_f20170307"><?php echo $t_jd_krj_peg->f20170307->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170308->Visible) { // f20170308 ?>
		<th><span id="elh_t_jd_krj_peg_f20170308" class="t_jd_krj_peg_f20170308"><?php echo $t_jd_krj_peg->f20170308->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170309->Visible) { // f20170309 ?>
		<th><span id="elh_t_jd_krj_peg_f20170309" class="t_jd_krj_peg_f20170309"><?php echo $t_jd_krj_peg->f20170309->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170310->Visible) { // f20170310 ?>
		<th><span id="elh_t_jd_krj_peg_f20170310" class="t_jd_krj_peg_f20170310"><?php echo $t_jd_krj_peg->f20170310->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170311->Visible) { // f20170311 ?>
		<th><span id="elh_t_jd_krj_peg_f20170311" class="t_jd_krj_peg_f20170311"><?php echo $t_jd_krj_peg->f20170311->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170312->Visible) { // f20170312 ?>
		<th><span id="elh_t_jd_krj_peg_f20170312" class="t_jd_krj_peg_f20170312"><?php echo $t_jd_krj_peg->f20170312->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170313->Visible) { // f20170313 ?>
		<th><span id="elh_t_jd_krj_peg_f20170313" class="t_jd_krj_peg_f20170313"><?php echo $t_jd_krj_peg->f20170313->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170314->Visible) { // f20170314 ?>
		<th><span id="elh_t_jd_krj_peg_f20170314" class="t_jd_krj_peg_f20170314"><?php echo $t_jd_krj_peg->f20170314->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170315->Visible) { // f20170315 ?>
		<th><span id="elh_t_jd_krj_peg_f20170315" class="t_jd_krj_peg_f20170315"><?php echo $t_jd_krj_peg->f20170315->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170316->Visible) { // f20170316 ?>
		<th><span id="elh_t_jd_krj_peg_f20170316" class="t_jd_krj_peg_f20170316"><?php echo $t_jd_krj_peg->f20170316->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170317->Visible) { // f20170317 ?>
		<th><span id="elh_t_jd_krj_peg_f20170317" class="t_jd_krj_peg_f20170317"><?php echo $t_jd_krj_peg->f20170317->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170318->Visible) { // f20170318 ?>
		<th><span id="elh_t_jd_krj_peg_f20170318" class="t_jd_krj_peg_f20170318"><?php echo $t_jd_krj_peg->f20170318->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170319->Visible) { // f20170319 ?>
		<th><span id="elh_t_jd_krj_peg_f20170319" class="t_jd_krj_peg_f20170319"><?php echo $t_jd_krj_peg->f20170319->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170320->Visible) { // f20170320 ?>
		<th><span id="elh_t_jd_krj_peg_f20170320" class="t_jd_krj_peg_f20170320"><?php echo $t_jd_krj_peg->f20170320->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170321->Visible) { // f20170321 ?>
		<th><span id="elh_t_jd_krj_peg_f20170321" class="t_jd_krj_peg_f20170321"><?php echo $t_jd_krj_peg->f20170321->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170322->Visible) { // f20170322 ?>
		<th><span id="elh_t_jd_krj_peg_f20170322" class="t_jd_krj_peg_f20170322"><?php echo $t_jd_krj_peg->f20170322->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170323->Visible) { // f20170323 ?>
		<th><span id="elh_t_jd_krj_peg_f20170323" class="t_jd_krj_peg_f20170323"><?php echo $t_jd_krj_peg->f20170323->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170324->Visible) { // f20170324 ?>
		<th><span id="elh_t_jd_krj_peg_f20170324" class="t_jd_krj_peg_f20170324"><?php echo $t_jd_krj_peg->f20170324->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170325->Visible) { // f20170325 ?>
		<th><span id="elh_t_jd_krj_peg_f20170325" class="t_jd_krj_peg_f20170325"><?php echo $t_jd_krj_peg->f20170325->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170326->Visible) { // f20170326 ?>
		<th><span id="elh_t_jd_krj_peg_f20170326" class="t_jd_krj_peg_f20170326"><?php echo $t_jd_krj_peg->f20170326->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170327->Visible) { // f20170327 ?>
		<th><span id="elh_t_jd_krj_peg_f20170327" class="t_jd_krj_peg_f20170327"><?php echo $t_jd_krj_peg->f20170327->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170328->Visible) { // f20170328 ?>
		<th><span id="elh_t_jd_krj_peg_f20170328" class="t_jd_krj_peg_f20170328"><?php echo $t_jd_krj_peg->f20170328->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170329->Visible) { // f20170329 ?>
		<th><span id="elh_t_jd_krj_peg_f20170329" class="t_jd_krj_peg_f20170329"><?php echo $t_jd_krj_peg->f20170329->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170330->Visible) { // f20170330 ?>
		<th><span id="elh_t_jd_krj_peg_f20170330" class="t_jd_krj_peg_f20170330"><?php echo $t_jd_krj_peg->f20170330->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170331->Visible) { // f20170331 ?>
		<th><span id="elh_t_jd_krj_peg_f20170331" class="t_jd_krj_peg_f20170331"><?php echo $t_jd_krj_peg->f20170331->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170401->Visible) { // f20170401 ?>
		<th><span id="elh_t_jd_krj_peg_f20170401" class="t_jd_krj_peg_f20170401"><?php echo $t_jd_krj_peg->f20170401->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170402->Visible) { // f20170402 ?>
		<th><span id="elh_t_jd_krj_peg_f20170402" class="t_jd_krj_peg_f20170402"><?php echo $t_jd_krj_peg->f20170402->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170403->Visible) { // f20170403 ?>
		<th><span id="elh_t_jd_krj_peg_f20170403" class="t_jd_krj_peg_f20170403"><?php echo $t_jd_krj_peg->f20170403->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170404->Visible) { // f20170404 ?>
		<th><span id="elh_t_jd_krj_peg_f20170404" class="t_jd_krj_peg_f20170404"><?php echo $t_jd_krj_peg->f20170404->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170405->Visible) { // f20170405 ?>
		<th><span id="elh_t_jd_krj_peg_f20170405" class="t_jd_krj_peg_f20170405"><?php echo $t_jd_krj_peg->f20170405->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170406->Visible) { // f20170406 ?>
		<th><span id="elh_t_jd_krj_peg_f20170406" class="t_jd_krj_peg_f20170406"><?php echo $t_jd_krj_peg->f20170406->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170407->Visible) { // f20170407 ?>
		<th><span id="elh_t_jd_krj_peg_f20170407" class="t_jd_krj_peg_f20170407"><?php echo $t_jd_krj_peg->f20170407->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170408->Visible) { // f20170408 ?>
		<th><span id="elh_t_jd_krj_peg_f20170408" class="t_jd_krj_peg_f20170408"><?php echo $t_jd_krj_peg->f20170408->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170409->Visible) { // f20170409 ?>
		<th><span id="elh_t_jd_krj_peg_f20170409" class="t_jd_krj_peg_f20170409"><?php echo $t_jd_krj_peg->f20170409->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170410->Visible) { // f20170410 ?>
		<th><span id="elh_t_jd_krj_peg_f20170410" class="t_jd_krj_peg_f20170410"><?php echo $t_jd_krj_peg->f20170410->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170411->Visible) { // f20170411 ?>
		<th><span id="elh_t_jd_krj_peg_f20170411" class="t_jd_krj_peg_f20170411"><?php echo $t_jd_krj_peg->f20170411->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170412->Visible) { // f20170412 ?>
		<th><span id="elh_t_jd_krj_peg_f20170412" class="t_jd_krj_peg_f20170412"><?php echo $t_jd_krj_peg->f20170412->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170413->Visible) { // f20170413 ?>
		<th><span id="elh_t_jd_krj_peg_f20170413" class="t_jd_krj_peg_f20170413"><?php echo $t_jd_krj_peg->f20170413->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170414->Visible) { // f20170414 ?>
		<th><span id="elh_t_jd_krj_peg_f20170414" class="t_jd_krj_peg_f20170414"><?php echo $t_jd_krj_peg->f20170414->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170415->Visible) { // f20170415 ?>
		<th><span id="elh_t_jd_krj_peg_f20170415" class="t_jd_krj_peg_f20170415"><?php echo $t_jd_krj_peg->f20170415->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170416->Visible) { // f20170416 ?>
		<th><span id="elh_t_jd_krj_peg_f20170416" class="t_jd_krj_peg_f20170416"><?php echo $t_jd_krj_peg->f20170416->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170417->Visible) { // f20170417 ?>
		<th><span id="elh_t_jd_krj_peg_f20170417" class="t_jd_krj_peg_f20170417"><?php echo $t_jd_krj_peg->f20170417->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170418->Visible) { // f20170418 ?>
		<th><span id="elh_t_jd_krj_peg_f20170418" class="t_jd_krj_peg_f20170418"><?php echo $t_jd_krj_peg->f20170418->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170419->Visible) { // f20170419 ?>
		<th><span id="elh_t_jd_krj_peg_f20170419" class="t_jd_krj_peg_f20170419"><?php echo $t_jd_krj_peg->f20170419->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170420->Visible) { // f20170420 ?>
		<th><span id="elh_t_jd_krj_peg_f20170420" class="t_jd_krj_peg_f20170420"><?php echo $t_jd_krj_peg->f20170420->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170421->Visible) { // f20170421 ?>
		<th><span id="elh_t_jd_krj_peg_f20170421" class="t_jd_krj_peg_f20170421"><?php echo $t_jd_krj_peg->f20170421->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170422->Visible) { // f20170422 ?>
		<th><span id="elh_t_jd_krj_peg_f20170422" class="t_jd_krj_peg_f20170422"><?php echo $t_jd_krj_peg->f20170422->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170423->Visible) { // f20170423 ?>
		<th><span id="elh_t_jd_krj_peg_f20170423" class="t_jd_krj_peg_f20170423"><?php echo $t_jd_krj_peg->f20170423->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170424->Visible) { // f20170424 ?>
		<th><span id="elh_t_jd_krj_peg_f20170424" class="t_jd_krj_peg_f20170424"><?php echo $t_jd_krj_peg->f20170424->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170425->Visible) { // f20170425 ?>
		<th><span id="elh_t_jd_krj_peg_f20170425" class="t_jd_krj_peg_f20170425"><?php echo $t_jd_krj_peg->f20170425->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170426->Visible) { // f20170426 ?>
		<th><span id="elh_t_jd_krj_peg_f20170426" class="t_jd_krj_peg_f20170426"><?php echo $t_jd_krj_peg->f20170426->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170427->Visible) { // f20170427 ?>
		<th><span id="elh_t_jd_krj_peg_f20170427" class="t_jd_krj_peg_f20170427"><?php echo $t_jd_krj_peg->f20170427->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170428->Visible) { // f20170428 ?>
		<th><span id="elh_t_jd_krj_peg_f20170428" class="t_jd_krj_peg_f20170428"><?php echo $t_jd_krj_peg->f20170428->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170429->Visible) { // f20170429 ?>
		<th><span id="elh_t_jd_krj_peg_f20170429" class="t_jd_krj_peg_f20170429"><?php echo $t_jd_krj_peg->f20170429->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170430->Visible) { // f20170430 ?>
		<th><span id="elh_t_jd_krj_peg_f20170430" class="t_jd_krj_peg_f20170430"><?php echo $t_jd_krj_peg->f20170430->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170501->Visible) { // f20170501 ?>
		<th><span id="elh_t_jd_krj_peg_f20170501" class="t_jd_krj_peg_f20170501"><?php echo $t_jd_krj_peg->f20170501->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170502->Visible) { // f20170502 ?>
		<th><span id="elh_t_jd_krj_peg_f20170502" class="t_jd_krj_peg_f20170502"><?php echo $t_jd_krj_peg->f20170502->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170503->Visible) { // f20170503 ?>
		<th><span id="elh_t_jd_krj_peg_f20170503" class="t_jd_krj_peg_f20170503"><?php echo $t_jd_krj_peg->f20170503->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170504->Visible) { // f20170504 ?>
		<th><span id="elh_t_jd_krj_peg_f20170504" class="t_jd_krj_peg_f20170504"><?php echo $t_jd_krj_peg->f20170504->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170505->Visible) { // f20170505 ?>
		<th><span id="elh_t_jd_krj_peg_f20170505" class="t_jd_krj_peg_f20170505"><?php echo $t_jd_krj_peg->f20170505->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170506->Visible) { // f20170506 ?>
		<th><span id="elh_t_jd_krj_peg_f20170506" class="t_jd_krj_peg_f20170506"><?php echo $t_jd_krj_peg->f20170506->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170507->Visible) { // f20170507 ?>
		<th><span id="elh_t_jd_krj_peg_f20170507" class="t_jd_krj_peg_f20170507"><?php echo $t_jd_krj_peg->f20170507->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170508->Visible) { // f20170508 ?>
		<th><span id="elh_t_jd_krj_peg_f20170508" class="t_jd_krj_peg_f20170508"><?php echo $t_jd_krj_peg->f20170508->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170509->Visible) { // f20170509 ?>
		<th><span id="elh_t_jd_krj_peg_f20170509" class="t_jd_krj_peg_f20170509"><?php echo $t_jd_krj_peg->f20170509->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170510->Visible) { // f20170510 ?>
		<th><span id="elh_t_jd_krj_peg_f20170510" class="t_jd_krj_peg_f20170510"><?php echo $t_jd_krj_peg->f20170510->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170511->Visible) { // f20170511 ?>
		<th><span id="elh_t_jd_krj_peg_f20170511" class="t_jd_krj_peg_f20170511"><?php echo $t_jd_krj_peg->f20170511->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170512->Visible) { // f20170512 ?>
		<th><span id="elh_t_jd_krj_peg_f20170512" class="t_jd_krj_peg_f20170512"><?php echo $t_jd_krj_peg->f20170512->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170513->Visible) { // f20170513 ?>
		<th><span id="elh_t_jd_krj_peg_f20170513" class="t_jd_krj_peg_f20170513"><?php echo $t_jd_krj_peg->f20170513->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170514->Visible) { // f20170514 ?>
		<th><span id="elh_t_jd_krj_peg_f20170514" class="t_jd_krj_peg_f20170514"><?php echo $t_jd_krj_peg->f20170514->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170515->Visible) { // f20170515 ?>
		<th><span id="elh_t_jd_krj_peg_f20170515" class="t_jd_krj_peg_f20170515"><?php echo $t_jd_krj_peg->f20170515->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170516->Visible) { // f20170516 ?>
		<th><span id="elh_t_jd_krj_peg_f20170516" class="t_jd_krj_peg_f20170516"><?php echo $t_jd_krj_peg->f20170516->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170517->Visible) { // f20170517 ?>
		<th><span id="elh_t_jd_krj_peg_f20170517" class="t_jd_krj_peg_f20170517"><?php echo $t_jd_krj_peg->f20170517->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170518->Visible) { // f20170518 ?>
		<th><span id="elh_t_jd_krj_peg_f20170518" class="t_jd_krj_peg_f20170518"><?php echo $t_jd_krj_peg->f20170518->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170519->Visible) { // f20170519 ?>
		<th><span id="elh_t_jd_krj_peg_f20170519" class="t_jd_krj_peg_f20170519"><?php echo $t_jd_krj_peg->f20170519->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170520->Visible) { // f20170520 ?>
		<th><span id="elh_t_jd_krj_peg_f20170520" class="t_jd_krj_peg_f20170520"><?php echo $t_jd_krj_peg->f20170520->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170521->Visible) { // f20170521 ?>
		<th><span id="elh_t_jd_krj_peg_f20170521" class="t_jd_krj_peg_f20170521"><?php echo $t_jd_krj_peg->f20170521->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170522->Visible) { // f20170522 ?>
		<th><span id="elh_t_jd_krj_peg_f20170522" class="t_jd_krj_peg_f20170522"><?php echo $t_jd_krj_peg->f20170522->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170523->Visible) { // f20170523 ?>
		<th><span id="elh_t_jd_krj_peg_f20170523" class="t_jd_krj_peg_f20170523"><?php echo $t_jd_krj_peg->f20170523->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170524->Visible) { // f20170524 ?>
		<th><span id="elh_t_jd_krj_peg_f20170524" class="t_jd_krj_peg_f20170524"><?php echo $t_jd_krj_peg->f20170524->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170525->Visible) { // f20170525 ?>
		<th><span id="elh_t_jd_krj_peg_f20170525" class="t_jd_krj_peg_f20170525"><?php echo $t_jd_krj_peg->f20170525->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170526->Visible) { // f20170526 ?>
		<th><span id="elh_t_jd_krj_peg_f20170526" class="t_jd_krj_peg_f20170526"><?php echo $t_jd_krj_peg->f20170526->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170527->Visible) { // f20170527 ?>
		<th><span id="elh_t_jd_krj_peg_f20170527" class="t_jd_krj_peg_f20170527"><?php echo $t_jd_krj_peg->f20170527->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170528->Visible) { // f20170528 ?>
		<th><span id="elh_t_jd_krj_peg_f20170528" class="t_jd_krj_peg_f20170528"><?php echo $t_jd_krj_peg->f20170528->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170529->Visible) { // f20170529 ?>
		<th><span id="elh_t_jd_krj_peg_f20170529" class="t_jd_krj_peg_f20170529"><?php echo $t_jd_krj_peg->f20170529->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170530->Visible) { // f20170530 ?>
		<th><span id="elh_t_jd_krj_peg_f20170530" class="t_jd_krj_peg_f20170530"><?php echo $t_jd_krj_peg->f20170530->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170531->Visible) { // f20170531 ?>
		<th><span id="elh_t_jd_krj_peg_f20170531" class="t_jd_krj_peg_f20170531"><?php echo $t_jd_krj_peg->f20170531->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170601->Visible) { // f20170601 ?>
		<th><span id="elh_t_jd_krj_peg_f20170601" class="t_jd_krj_peg_f20170601"><?php echo $t_jd_krj_peg->f20170601->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170602->Visible) { // f20170602 ?>
		<th><span id="elh_t_jd_krj_peg_f20170602" class="t_jd_krj_peg_f20170602"><?php echo $t_jd_krj_peg->f20170602->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170603->Visible) { // f20170603 ?>
		<th><span id="elh_t_jd_krj_peg_f20170603" class="t_jd_krj_peg_f20170603"><?php echo $t_jd_krj_peg->f20170603->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170604->Visible) { // f20170604 ?>
		<th><span id="elh_t_jd_krj_peg_f20170604" class="t_jd_krj_peg_f20170604"><?php echo $t_jd_krj_peg->f20170604->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170605->Visible) { // f20170605 ?>
		<th><span id="elh_t_jd_krj_peg_f20170605" class="t_jd_krj_peg_f20170605"><?php echo $t_jd_krj_peg->f20170605->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170606->Visible) { // f20170606 ?>
		<th><span id="elh_t_jd_krj_peg_f20170606" class="t_jd_krj_peg_f20170606"><?php echo $t_jd_krj_peg->f20170606->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170607->Visible) { // f20170607 ?>
		<th><span id="elh_t_jd_krj_peg_f20170607" class="t_jd_krj_peg_f20170607"><?php echo $t_jd_krj_peg->f20170607->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170608->Visible) { // f20170608 ?>
		<th><span id="elh_t_jd_krj_peg_f20170608" class="t_jd_krj_peg_f20170608"><?php echo $t_jd_krj_peg->f20170608->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170609->Visible) { // f20170609 ?>
		<th><span id="elh_t_jd_krj_peg_f20170609" class="t_jd_krj_peg_f20170609"><?php echo $t_jd_krj_peg->f20170609->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170610->Visible) { // f20170610 ?>
		<th><span id="elh_t_jd_krj_peg_f20170610" class="t_jd_krj_peg_f20170610"><?php echo $t_jd_krj_peg->f20170610->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170611->Visible) { // f20170611 ?>
		<th><span id="elh_t_jd_krj_peg_f20170611" class="t_jd_krj_peg_f20170611"><?php echo $t_jd_krj_peg->f20170611->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170612->Visible) { // f20170612 ?>
		<th><span id="elh_t_jd_krj_peg_f20170612" class="t_jd_krj_peg_f20170612"><?php echo $t_jd_krj_peg->f20170612->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170613->Visible) { // f20170613 ?>
		<th><span id="elh_t_jd_krj_peg_f20170613" class="t_jd_krj_peg_f20170613"><?php echo $t_jd_krj_peg->f20170613->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170614->Visible) { // f20170614 ?>
		<th><span id="elh_t_jd_krj_peg_f20170614" class="t_jd_krj_peg_f20170614"><?php echo $t_jd_krj_peg->f20170614->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170615->Visible) { // f20170615 ?>
		<th><span id="elh_t_jd_krj_peg_f20170615" class="t_jd_krj_peg_f20170615"><?php echo $t_jd_krj_peg->f20170615->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170616->Visible) { // f20170616 ?>
		<th><span id="elh_t_jd_krj_peg_f20170616" class="t_jd_krj_peg_f20170616"><?php echo $t_jd_krj_peg->f20170616->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170617->Visible) { // f20170617 ?>
		<th><span id="elh_t_jd_krj_peg_f20170617" class="t_jd_krj_peg_f20170617"><?php echo $t_jd_krj_peg->f20170617->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170618->Visible) { // f20170618 ?>
		<th><span id="elh_t_jd_krj_peg_f20170618" class="t_jd_krj_peg_f20170618"><?php echo $t_jd_krj_peg->f20170618->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170619->Visible) { // f20170619 ?>
		<th><span id="elh_t_jd_krj_peg_f20170619" class="t_jd_krj_peg_f20170619"><?php echo $t_jd_krj_peg->f20170619->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170620->Visible) { // f20170620 ?>
		<th><span id="elh_t_jd_krj_peg_f20170620" class="t_jd_krj_peg_f20170620"><?php echo $t_jd_krj_peg->f20170620->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170621->Visible) { // f20170621 ?>
		<th><span id="elh_t_jd_krj_peg_f20170621" class="t_jd_krj_peg_f20170621"><?php echo $t_jd_krj_peg->f20170621->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170622->Visible) { // f20170622 ?>
		<th><span id="elh_t_jd_krj_peg_f20170622" class="t_jd_krj_peg_f20170622"><?php echo $t_jd_krj_peg->f20170622->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170623->Visible) { // f20170623 ?>
		<th><span id="elh_t_jd_krj_peg_f20170623" class="t_jd_krj_peg_f20170623"><?php echo $t_jd_krj_peg->f20170623->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170624->Visible) { // f20170624 ?>
		<th><span id="elh_t_jd_krj_peg_f20170624" class="t_jd_krj_peg_f20170624"><?php echo $t_jd_krj_peg->f20170624->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170625->Visible) { // f20170625 ?>
		<th><span id="elh_t_jd_krj_peg_f20170625" class="t_jd_krj_peg_f20170625"><?php echo $t_jd_krj_peg->f20170625->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170626->Visible) { // f20170626 ?>
		<th><span id="elh_t_jd_krj_peg_f20170626" class="t_jd_krj_peg_f20170626"><?php echo $t_jd_krj_peg->f20170626->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170627->Visible) { // f20170627 ?>
		<th><span id="elh_t_jd_krj_peg_f20170627" class="t_jd_krj_peg_f20170627"><?php echo $t_jd_krj_peg->f20170627->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170628->Visible) { // f20170628 ?>
		<th><span id="elh_t_jd_krj_peg_f20170628" class="t_jd_krj_peg_f20170628"><?php echo $t_jd_krj_peg->f20170628->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170629->Visible) { // f20170629 ?>
		<th><span id="elh_t_jd_krj_peg_f20170629" class="t_jd_krj_peg_f20170629"><?php echo $t_jd_krj_peg->f20170629->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170630->Visible) { // f20170630 ?>
		<th><span id="elh_t_jd_krj_peg_f20170630" class="t_jd_krj_peg_f20170630"><?php echo $t_jd_krj_peg->f20170630->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170701->Visible) { // f20170701 ?>
		<th><span id="elh_t_jd_krj_peg_f20170701" class="t_jd_krj_peg_f20170701"><?php echo $t_jd_krj_peg->f20170701->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170702->Visible) { // f20170702 ?>
		<th><span id="elh_t_jd_krj_peg_f20170702" class="t_jd_krj_peg_f20170702"><?php echo $t_jd_krj_peg->f20170702->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170703->Visible) { // f20170703 ?>
		<th><span id="elh_t_jd_krj_peg_f20170703" class="t_jd_krj_peg_f20170703"><?php echo $t_jd_krj_peg->f20170703->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170704->Visible) { // f20170704 ?>
		<th><span id="elh_t_jd_krj_peg_f20170704" class="t_jd_krj_peg_f20170704"><?php echo $t_jd_krj_peg->f20170704->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170705->Visible) { // f20170705 ?>
		<th><span id="elh_t_jd_krj_peg_f20170705" class="t_jd_krj_peg_f20170705"><?php echo $t_jd_krj_peg->f20170705->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170706->Visible) { // f20170706 ?>
		<th><span id="elh_t_jd_krj_peg_f20170706" class="t_jd_krj_peg_f20170706"><?php echo $t_jd_krj_peg->f20170706->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170707->Visible) { // f20170707 ?>
		<th><span id="elh_t_jd_krj_peg_f20170707" class="t_jd_krj_peg_f20170707"><?php echo $t_jd_krj_peg->f20170707->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170708->Visible) { // f20170708 ?>
		<th><span id="elh_t_jd_krj_peg_f20170708" class="t_jd_krj_peg_f20170708"><?php echo $t_jd_krj_peg->f20170708->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170709->Visible) { // f20170709 ?>
		<th><span id="elh_t_jd_krj_peg_f20170709" class="t_jd_krj_peg_f20170709"><?php echo $t_jd_krj_peg->f20170709->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170710->Visible) { // f20170710 ?>
		<th><span id="elh_t_jd_krj_peg_f20170710" class="t_jd_krj_peg_f20170710"><?php echo $t_jd_krj_peg->f20170710->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170711->Visible) { // f20170711 ?>
		<th><span id="elh_t_jd_krj_peg_f20170711" class="t_jd_krj_peg_f20170711"><?php echo $t_jd_krj_peg->f20170711->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170712->Visible) { // f20170712 ?>
		<th><span id="elh_t_jd_krj_peg_f20170712" class="t_jd_krj_peg_f20170712"><?php echo $t_jd_krj_peg->f20170712->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170713->Visible) { // f20170713 ?>
		<th><span id="elh_t_jd_krj_peg_f20170713" class="t_jd_krj_peg_f20170713"><?php echo $t_jd_krj_peg->f20170713->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170714->Visible) { // f20170714 ?>
		<th><span id="elh_t_jd_krj_peg_f20170714" class="t_jd_krj_peg_f20170714"><?php echo $t_jd_krj_peg->f20170714->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170715->Visible) { // f20170715 ?>
		<th><span id="elh_t_jd_krj_peg_f20170715" class="t_jd_krj_peg_f20170715"><?php echo $t_jd_krj_peg->f20170715->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170716->Visible) { // f20170716 ?>
		<th><span id="elh_t_jd_krj_peg_f20170716" class="t_jd_krj_peg_f20170716"><?php echo $t_jd_krj_peg->f20170716->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170717->Visible) { // f20170717 ?>
		<th><span id="elh_t_jd_krj_peg_f20170717" class="t_jd_krj_peg_f20170717"><?php echo $t_jd_krj_peg->f20170717->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170718->Visible) { // f20170718 ?>
		<th><span id="elh_t_jd_krj_peg_f20170718" class="t_jd_krj_peg_f20170718"><?php echo $t_jd_krj_peg->f20170718->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170719->Visible) { // f20170719 ?>
		<th><span id="elh_t_jd_krj_peg_f20170719" class="t_jd_krj_peg_f20170719"><?php echo $t_jd_krj_peg->f20170719->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170720->Visible) { // f20170720 ?>
		<th><span id="elh_t_jd_krj_peg_f20170720" class="t_jd_krj_peg_f20170720"><?php echo $t_jd_krj_peg->f20170720->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170721->Visible) { // f20170721 ?>
		<th><span id="elh_t_jd_krj_peg_f20170721" class="t_jd_krj_peg_f20170721"><?php echo $t_jd_krj_peg->f20170721->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170722->Visible) { // f20170722 ?>
		<th><span id="elh_t_jd_krj_peg_f20170722" class="t_jd_krj_peg_f20170722"><?php echo $t_jd_krj_peg->f20170722->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170723->Visible) { // f20170723 ?>
		<th><span id="elh_t_jd_krj_peg_f20170723" class="t_jd_krj_peg_f20170723"><?php echo $t_jd_krj_peg->f20170723->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170724->Visible) { // f20170724 ?>
		<th><span id="elh_t_jd_krj_peg_f20170724" class="t_jd_krj_peg_f20170724"><?php echo $t_jd_krj_peg->f20170724->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170725->Visible) { // f20170725 ?>
		<th><span id="elh_t_jd_krj_peg_f20170725" class="t_jd_krj_peg_f20170725"><?php echo $t_jd_krj_peg->f20170725->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170726->Visible) { // f20170726 ?>
		<th><span id="elh_t_jd_krj_peg_f20170726" class="t_jd_krj_peg_f20170726"><?php echo $t_jd_krj_peg->f20170726->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170727->Visible) { // f20170727 ?>
		<th><span id="elh_t_jd_krj_peg_f20170727" class="t_jd_krj_peg_f20170727"><?php echo $t_jd_krj_peg->f20170727->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170728->Visible) { // f20170728 ?>
		<th><span id="elh_t_jd_krj_peg_f20170728" class="t_jd_krj_peg_f20170728"><?php echo $t_jd_krj_peg->f20170728->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170729->Visible) { // f20170729 ?>
		<th><span id="elh_t_jd_krj_peg_f20170729" class="t_jd_krj_peg_f20170729"><?php echo $t_jd_krj_peg->f20170729->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170730->Visible) { // f20170730 ?>
		<th><span id="elh_t_jd_krj_peg_f20170730" class="t_jd_krj_peg_f20170730"><?php echo $t_jd_krj_peg->f20170730->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170731->Visible) { // f20170731 ?>
		<th><span id="elh_t_jd_krj_peg_f20170731" class="t_jd_krj_peg_f20170731"><?php echo $t_jd_krj_peg->f20170731->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170801->Visible) { // f20170801 ?>
		<th><span id="elh_t_jd_krj_peg_f20170801" class="t_jd_krj_peg_f20170801"><?php echo $t_jd_krj_peg->f20170801->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170802->Visible) { // f20170802 ?>
		<th><span id="elh_t_jd_krj_peg_f20170802" class="t_jd_krj_peg_f20170802"><?php echo $t_jd_krj_peg->f20170802->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170803->Visible) { // f20170803 ?>
		<th><span id="elh_t_jd_krj_peg_f20170803" class="t_jd_krj_peg_f20170803"><?php echo $t_jd_krj_peg->f20170803->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170804->Visible) { // f20170804 ?>
		<th><span id="elh_t_jd_krj_peg_f20170804" class="t_jd_krj_peg_f20170804"><?php echo $t_jd_krj_peg->f20170804->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170805->Visible) { // f20170805 ?>
		<th><span id="elh_t_jd_krj_peg_f20170805" class="t_jd_krj_peg_f20170805"><?php echo $t_jd_krj_peg->f20170805->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170806->Visible) { // f20170806 ?>
		<th><span id="elh_t_jd_krj_peg_f20170806" class="t_jd_krj_peg_f20170806"><?php echo $t_jd_krj_peg->f20170806->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170807->Visible) { // f20170807 ?>
		<th><span id="elh_t_jd_krj_peg_f20170807" class="t_jd_krj_peg_f20170807"><?php echo $t_jd_krj_peg->f20170807->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170808->Visible) { // f20170808 ?>
		<th><span id="elh_t_jd_krj_peg_f20170808" class="t_jd_krj_peg_f20170808"><?php echo $t_jd_krj_peg->f20170808->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170809->Visible) { // f20170809 ?>
		<th><span id="elh_t_jd_krj_peg_f20170809" class="t_jd_krj_peg_f20170809"><?php echo $t_jd_krj_peg->f20170809->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170810->Visible) { // f20170810 ?>
		<th><span id="elh_t_jd_krj_peg_f20170810" class="t_jd_krj_peg_f20170810"><?php echo $t_jd_krj_peg->f20170810->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170811->Visible) { // f20170811 ?>
		<th><span id="elh_t_jd_krj_peg_f20170811" class="t_jd_krj_peg_f20170811"><?php echo $t_jd_krj_peg->f20170811->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170812->Visible) { // f20170812 ?>
		<th><span id="elh_t_jd_krj_peg_f20170812" class="t_jd_krj_peg_f20170812"><?php echo $t_jd_krj_peg->f20170812->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170813->Visible) { // f20170813 ?>
		<th><span id="elh_t_jd_krj_peg_f20170813" class="t_jd_krj_peg_f20170813"><?php echo $t_jd_krj_peg->f20170813->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170814->Visible) { // f20170814 ?>
		<th><span id="elh_t_jd_krj_peg_f20170814" class="t_jd_krj_peg_f20170814"><?php echo $t_jd_krj_peg->f20170814->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170815->Visible) { // f20170815 ?>
		<th><span id="elh_t_jd_krj_peg_f20170815" class="t_jd_krj_peg_f20170815"><?php echo $t_jd_krj_peg->f20170815->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170816->Visible) { // f20170816 ?>
		<th><span id="elh_t_jd_krj_peg_f20170816" class="t_jd_krj_peg_f20170816"><?php echo $t_jd_krj_peg->f20170816->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170817->Visible) { // f20170817 ?>
		<th><span id="elh_t_jd_krj_peg_f20170817" class="t_jd_krj_peg_f20170817"><?php echo $t_jd_krj_peg->f20170817->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170818->Visible) { // f20170818 ?>
		<th><span id="elh_t_jd_krj_peg_f20170818" class="t_jd_krj_peg_f20170818"><?php echo $t_jd_krj_peg->f20170818->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170819->Visible) { // f20170819 ?>
		<th><span id="elh_t_jd_krj_peg_f20170819" class="t_jd_krj_peg_f20170819"><?php echo $t_jd_krj_peg->f20170819->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170820->Visible) { // f20170820 ?>
		<th><span id="elh_t_jd_krj_peg_f20170820" class="t_jd_krj_peg_f20170820"><?php echo $t_jd_krj_peg->f20170820->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170821->Visible) { // f20170821 ?>
		<th><span id="elh_t_jd_krj_peg_f20170821" class="t_jd_krj_peg_f20170821"><?php echo $t_jd_krj_peg->f20170821->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170822->Visible) { // f20170822 ?>
		<th><span id="elh_t_jd_krj_peg_f20170822" class="t_jd_krj_peg_f20170822"><?php echo $t_jd_krj_peg->f20170822->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170823->Visible) { // f20170823 ?>
		<th><span id="elh_t_jd_krj_peg_f20170823" class="t_jd_krj_peg_f20170823"><?php echo $t_jd_krj_peg->f20170823->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170824->Visible) { // f20170824 ?>
		<th><span id="elh_t_jd_krj_peg_f20170824" class="t_jd_krj_peg_f20170824"><?php echo $t_jd_krj_peg->f20170824->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170825->Visible) { // f20170825 ?>
		<th><span id="elh_t_jd_krj_peg_f20170825" class="t_jd_krj_peg_f20170825"><?php echo $t_jd_krj_peg->f20170825->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170826->Visible) { // f20170826 ?>
		<th><span id="elh_t_jd_krj_peg_f20170826" class="t_jd_krj_peg_f20170826"><?php echo $t_jd_krj_peg->f20170826->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170827->Visible) { // f20170827 ?>
		<th><span id="elh_t_jd_krj_peg_f20170827" class="t_jd_krj_peg_f20170827"><?php echo $t_jd_krj_peg->f20170827->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170828->Visible) { // f20170828 ?>
		<th><span id="elh_t_jd_krj_peg_f20170828" class="t_jd_krj_peg_f20170828"><?php echo $t_jd_krj_peg->f20170828->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170829->Visible) { // f20170829 ?>
		<th><span id="elh_t_jd_krj_peg_f20170829" class="t_jd_krj_peg_f20170829"><?php echo $t_jd_krj_peg->f20170829->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170830->Visible) { // f20170830 ?>
		<th><span id="elh_t_jd_krj_peg_f20170830" class="t_jd_krj_peg_f20170830"><?php echo $t_jd_krj_peg->f20170830->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170831->Visible) { // f20170831 ?>
		<th><span id="elh_t_jd_krj_peg_f20170831" class="t_jd_krj_peg_f20170831"><?php echo $t_jd_krj_peg->f20170831->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170901->Visible) { // f20170901 ?>
		<th><span id="elh_t_jd_krj_peg_f20170901" class="t_jd_krj_peg_f20170901"><?php echo $t_jd_krj_peg->f20170901->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170902->Visible) { // f20170902 ?>
		<th><span id="elh_t_jd_krj_peg_f20170902" class="t_jd_krj_peg_f20170902"><?php echo $t_jd_krj_peg->f20170902->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170903->Visible) { // f20170903 ?>
		<th><span id="elh_t_jd_krj_peg_f20170903" class="t_jd_krj_peg_f20170903"><?php echo $t_jd_krj_peg->f20170903->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170904->Visible) { // f20170904 ?>
		<th><span id="elh_t_jd_krj_peg_f20170904" class="t_jd_krj_peg_f20170904"><?php echo $t_jd_krj_peg->f20170904->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170905->Visible) { // f20170905 ?>
		<th><span id="elh_t_jd_krj_peg_f20170905" class="t_jd_krj_peg_f20170905"><?php echo $t_jd_krj_peg->f20170905->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170906->Visible) { // f20170906 ?>
		<th><span id="elh_t_jd_krj_peg_f20170906" class="t_jd_krj_peg_f20170906"><?php echo $t_jd_krj_peg->f20170906->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170907->Visible) { // f20170907 ?>
		<th><span id="elh_t_jd_krj_peg_f20170907" class="t_jd_krj_peg_f20170907"><?php echo $t_jd_krj_peg->f20170907->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170908->Visible) { // f20170908 ?>
		<th><span id="elh_t_jd_krj_peg_f20170908" class="t_jd_krj_peg_f20170908"><?php echo $t_jd_krj_peg->f20170908->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170909->Visible) { // f20170909 ?>
		<th><span id="elh_t_jd_krj_peg_f20170909" class="t_jd_krj_peg_f20170909"><?php echo $t_jd_krj_peg->f20170909->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170910->Visible) { // f20170910 ?>
		<th><span id="elh_t_jd_krj_peg_f20170910" class="t_jd_krj_peg_f20170910"><?php echo $t_jd_krj_peg->f20170910->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170911->Visible) { // f20170911 ?>
		<th><span id="elh_t_jd_krj_peg_f20170911" class="t_jd_krj_peg_f20170911"><?php echo $t_jd_krj_peg->f20170911->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170912->Visible) { // f20170912 ?>
		<th><span id="elh_t_jd_krj_peg_f20170912" class="t_jd_krj_peg_f20170912"><?php echo $t_jd_krj_peg->f20170912->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170913->Visible) { // f20170913 ?>
		<th><span id="elh_t_jd_krj_peg_f20170913" class="t_jd_krj_peg_f20170913"><?php echo $t_jd_krj_peg->f20170913->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170914->Visible) { // f20170914 ?>
		<th><span id="elh_t_jd_krj_peg_f20170914" class="t_jd_krj_peg_f20170914"><?php echo $t_jd_krj_peg->f20170914->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170915->Visible) { // f20170915 ?>
		<th><span id="elh_t_jd_krj_peg_f20170915" class="t_jd_krj_peg_f20170915"><?php echo $t_jd_krj_peg->f20170915->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170916->Visible) { // f20170916 ?>
		<th><span id="elh_t_jd_krj_peg_f20170916" class="t_jd_krj_peg_f20170916"><?php echo $t_jd_krj_peg->f20170916->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170917->Visible) { // f20170917 ?>
		<th><span id="elh_t_jd_krj_peg_f20170917" class="t_jd_krj_peg_f20170917"><?php echo $t_jd_krj_peg->f20170917->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170918->Visible) { // f20170918 ?>
		<th><span id="elh_t_jd_krj_peg_f20170918" class="t_jd_krj_peg_f20170918"><?php echo $t_jd_krj_peg->f20170918->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170919->Visible) { // f20170919 ?>
		<th><span id="elh_t_jd_krj_peg_f20170919" class="t_jd_krj_peg_f20170919"><?php echo $t_jd_krj_peg->f20170919->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170920->Visible) { // f20170920 ?>
		<th><span id="elh_t_jd_krj_peg_f20170920" class="t_jd_krj_peg_f20170920"><?php echo $t_jd_krj_peg->f20170920->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170921->Visible) { // f20170921 ?>
		<th><span id="elh_t_jd_krj_peg_f20170921" class="t_jd_krj_peg_f20170921"><?php echo $t_jd_krj_peg->f20170921->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170922->Visible) { // f20170922 ?>
		<th><span id="elh_t_jd_krj_peg_f20170922" class="t_jd_krj_peg_f20170922"><?php echo $t_jd_krj_peg->f20170922->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170923->Visible) { // f20170923 ?>
		<th><span id="elh_t_jd_krj_peg_f20170923" class="t_jd_krj_peg_f20170923"><?php echo $t_jd_krj_peg->f20170923->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170924->Visible) { // f20170924 ?>
		<th><span id="elh_t_jd_krj_peg_f20170924" class="t_jd_krj_peg_f20170924"><?php echo $t_jd_krj_peg->f20170924->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170925->Visible) { // f20170925 ?>
		<th><span id="elh_t_jd_krj_peg_f20170925" class="t_jd_krj_peg_f20170925"><?php echo $t_jd_krj_peg->f20170925->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170926->Visible) { // f20170926 ?>
		<th><span id="elh_t_jd_krj_peg_f20170926" class="t_jd_krj_peg_f20170926"><?php echo $t_jd_krj_peg->f20170926->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170927->Visible) { // f20170927 ?>
		<th><span id="elh_t_jd_krj_peg_f20170927" class="t_jd_krj_peg_f20170927"><?php echo $t_jd_krj_peg->f20170927->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170928->Visible) { // f20170928 ?>
		<th><span id="elh_t_jd_krj_peg_f20170928" class="t_jd_krj_peg_f20170928"><?php echo $t_jd_krj_peg->f20170928->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170929->Visible) { // f20170929 ?>
		<th><span id="elh_t_jd_krj_peg_f20170929" class="t_jd_krj_peg_f20170929"><?php echo $t_jd_krj_peg->f20170929->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170930->Visible) { // f20170930 ?>
		<th><span id="elh_t_jd_krj_peg_f20170930" class="t_jd_krj_peg_f20170930"><?php echo $t_jd_krj_peg->f20170930->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171001->Visible) { // f20171001 ?>
		<th><span id="elh_t_jd_krj_peg_f20171001" class="t_jd_krj_peg_f20171001"><?php echo $t_jd_krj_peg->f20171001->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171002->Visible) { // f20171002 ?>
		<th><span id="elh_t_jd_krj_peg_f20171002" class="t_jd_krj_peg_f20171002"><?php echo $t_jd_krj_peg->f20171002->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171003->Visible) { // f20171003 ?>
		<th><span id="elh_t_jd_krj_peg_f20171003" class="t_jd_krj_peg_f20171003"><?php echo $t_jd_krj_peg->f20171003->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171004->Visible) { // f20171004 ?>
		<th><span id="elh_t_jd_krj_peg_f20171004" class="t_jd_krj_peg_f20171004"><?php echo $t_jd_krj_peg->f20171004->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171005->Visible) { // f20171005 ?>
		<th><span id="elh_t_jd_krj_peg_f20171005" class="t_jd_krj_peg_f20171005"><?php echo $t_jd_krj_peg->f20171005->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171006->Visible) { // f20171006 ?>
		<th><span id="elh_t_jd_krj_peg_f20171006" class="t_jd_krj_peg_f20171006"><?php echo $t_jd_krj_peg->f20171006->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171007->Visible) { // f20171007 ?>
		<th><span id="elh_t_jd_krj_peg_f20171007" class="t_jd_krj_peg_f20171007"><?php echo $t_jd_krj_peg->f20171007->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171008->Visible) { // f20171008 ?>
		<th><span id="elh_t_jd_krj_peg_f20171008" class="t_jd_krj_peg_f20171008"><?php echo $t_jd_krj_peg->f20171008->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171009->Visible) { // f20171009 ?>
		<th><span id="elh_t_jd_krj_peg_f20171009" class="t_jd_krj_peg_f20171009"><?php echo $t_jd_krj_peg->f20171009->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171010->Visible) { // f20171010 ?>
		<th><span id="elh_t_jd_krj_peg_f20171010" class="t_jd_krj_peg_f20171010"><?php echo $t_jd_krj_peg->f20171010->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171011->Visible) { // f20171011 ?>
		<th><span id="elh_t_jd_krj_peg_f20171011" class="t_jd_krj_peg_f20171011"><?php echo $t_jd_krj_peg->f20171011->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171012->Visible) { // f20171012 ?>
		<th><span id="elh_t_jd_krj_peg_f20171012" class="t_jd_krj_peg_f20171012"><?php echo $t_jd_krj_peg->f20171012->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171013->Visible) { // f20171013 ?>
		<th><span id="elh_t_jd_krj_peg_f20171013" class="t_jd_krj_peg_f20171013"><?php echo $t_jd_krj_peg->f20171013->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171014->Visible) { // f20171014 ?>
		<th><span id="elh_t_jd_krj_peg_f20171014" class="t_jd_krj_peg_f20171014"><?php echo $t_jd_krj_peg->f20171014->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171015->Visible) { // f20171015 ?>
		<th><span id="elh_t_jd_krj_peg_f20171015" class="t_jd_krj_peg_f20171015"><?php echo $t_jd_krj_peg->f20171015->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171016->Visible) { // f20171016 ?>
		<th><span id="elh_t_jd_krj_peg_f20171016" class="t_jd_krj_peg_f20171016"><?php echo $t_jd_krj_peg->f20171016->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171017->Visible) { // f20171017 ?>
		<th><span id="elh_t_jd_krj_peg_f20171017" class="t_jd_krj_peg_f20171017"><?php echo $t_jd_krj_peg->f20171017->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171018->Visible) { // f20171018 ?>
		<th><span id="elh_t_jd_krj_peg_f20171018" class="t_jd_krj_peg_f20171018"><?php echo $t_jd_krj_peg->f20171018->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171019->Visible) { // f20171019 ?>
		<th><span id="elh_t_jd_krj_peg_f20171019" class="t_jd_krj_peg_f20171019"><?php echo $t_jd_krj_peg->f20171019->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171020->Visible) { // f20171020 ?>
		<th><span id="elh_t_jd_krj_peg_f20171020" class="t_jd_krj_peg_f20171020"><?php echo $t_jd_krj_peg->f20171020->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171021->Visible) { // f20171021 ?>
		<th><span id="elh_t_jd_krj_peg_f20171021" class="t_jd_krj_peg_f20171021"><?php echo $t_jd_krj_peg->f20171021->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171022->Visible) { // f20171022 ?>
		<th><span id="elh_t_jd_krj_peg_f20171022" class="t_jd_krj_peg_f20171022"><?php echo $t_jd_krj_peg->f20171022->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171023->Visible) { // f20171023 ?>
		<th><span id="elh_t_jd_krj_peg_f20171023" class="t_jd_krj_peg_f20171023"><?php echo $t_jd_krj_peg->f20171023->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171024->Visible) { // f20171024 ?>
		<th><span id="elh_t_jd_krj_peg_f20171024" class="t_jd_krj_peg_f20171024"><?php echo $t_jd_krj_peg->f20171024->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171025->Visible) { // f20171025 ?>
		<th><span id="elh_t_jd_krj_peg_f20171025" class="t_jd_krj_peg_f20171025"><?php echo $t_jd_krj_peg->f20171025->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171026->Visible) { // f20171026 ?>
		<th><span id="elh_t_jd_krj_peg_f20171026" class="t_jd_krj_peg_f20171026"><?php echo $t_jd_krj_peg->f20171026->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171027->Visible) { // f20171027 ?>
		<th><span id="elh_t_jd_krj_peg_f20171027" class="t_jd_krj_peg_f20171027"><?php echo $t_jd_krj_peg->f20171027->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171028->Visible) { // f20171028 ?>
		<th><span id="elh_t_jd_krj_peg_f20171028" class="t_jd_krj_peg_f20171028"><?php echo $t_jd_krj_peg->f20171028->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171029->Visible) { // f20171029 ?>
		<th><span id="elh_t_jd_krj_peg_f20171029" class="t_jd_krj_peg_f20171029"><?php echo $t_jd_krj_peg->f20171029->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171030->Visible) { // f20171030 ?>
		<th><span id="elh_t_jd_krj_peg_f20171030" class="t_jd_krj_peg_f20171030"><?php echo $t_jd_krj_peg->f20171030->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171031->Visible) { // f20171031 ?>
		<th><span id="elh_t_jd_krj_peg_f20171031" class="t_jd_krj_peg_f20171031"><?php echo $t_jd_krj_peg->f20171031->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171101->Visible) { // f20171101 ?>
		<th><span id="elh_t_jd_krj_peg_f20171101" class="t_jd_krj_peg_f20171101"><?php echo $t_jd_krj_peg->f20171101->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171102->Visible) { // f20171102 ?>
		<th><span id="elh_t_jd_krj_peg_f20171102" class="t_jd_krj_peg_f20171102"><?php echo $t_jd_krj_peg->f20171102->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171103->Visible) { // f20171103 ?>
		<th><span id="elh_t_jd_krj_peg_f20171103" class="t_jd_krj_peg_f20171103"><?php echo $t_jd_krj_peg->f20171103->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171104->Visible) { // f20171104 ?>
		<th><span id="elh_t_jd_krj_peg_f20171104" class="t_jd_krj_peg_f20171104"><?php echo $t_jd_krj_peg->f20171104->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171105->Visible) { // f20171105 ?>
		<th><span id="elh_t_jd_krj_peg_f20171105" class="t_jd_krj_peg_f20171105"><?php echo $t_jd_krj_peg->f20171105->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171106->Visible) { // f20171106 ?>
		<th><span id="elh_t_jd_krj_peg_f20171106" class="t_jd_krj_peg_f20171106"><?php echo $t_jd_krj_peg->f20171106->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171107->Visible) { // f20171107 ?>
		<th><span id="elh_t_jd_krj_peg_f20171107" class="t_jd_krj_peg_f20171107"><?php echo $t_jd_krj_peg->f20171107->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171108->Visible) { // f20171108 ?>
		<th><span id="elh_t_jd_krj_peg_f20171108" class="t_jd_krj_peg_f20171108"><?php echo $t_jd_krj_peg->f20171108->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171109->Visible) { // f20171109 ?>
		<th><span id="elh_t_jd_krj_peg_f20171109" class="t_jd_krj_peg_f20171109"><?php echo $t_jd_krj_peg->f20171109->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171110->Visible) { // f20171110 ?>
		<th><span id="elh_t_jd_krj_peg_f20171110" class="t_jd_krj_peg_f20171110"><?php echo $t_jd_krj_peg->f20171110->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171111->Visible) { // f20171111 ?>
		<th><span id="elh_t_jd_krj_peg_f20171111" class="t_jd_krj_peg_f20171111"><?php echo $t_jd_krj_peg->f20171111->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171112->Visible) { // f20171112 ?>
		<th><span id="elh_t_jd_krj_peg_f20171112" class="t_jd_krj_peg_f20171112"><?php echo $t_jd_krj_peg->f20171112->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171113->Visible) { // f20171113 ?>
		<th><span id="elh_t_jd_krj_peg_f20171113" class="t_jd_krj_peg_f20171113"><?php echo $t_jd_krj_peg->f20171113->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171114->Visible) { // f20171114 ?>
		<th><span id="elh_t_jd_krj_peg_f20171114" class="t_jd_krj_peg_f20171114"><?php echo $t_jd_krj_peg->f20171114->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171115->Visible) { // f20171115 ?>
		<th><span id="elh_t_jd_krj_peg_f20171115" class="t_jd_krj_peg_f20171115"><?php echo $t_jd_krj_peg->f20171115->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171116->Visible) { // f20171116 ?>
		<th><span id="elh_t_jd_krj_peg_f20171116" class="t_jd_krj_peg_f20171116"><?php echo $t_jd_krj_peg->f20171116->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171117->Visible) { // f20171117 ?>
		<th><span id="elh_t_jd_krj_peg_f20171117" class="t_jd_krj_peg_f20171117"><?php echo $t_jd_krj_peg->f20171117->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171118->Visible) { // f20171118 ?>
		<th><span id="elh_t_jd_krj_peg_f20171118" class="t_jd_krj_peg_f20171118"><?php echo $t_jd_krj_peg->f20171118->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171119->Visible) { // f20171119 ?>
		<th><span id="elh_t_jd_krj_peg_f20171119" class="t_jd_krj_peg_f20171119"><?php echo $t_jd_krj_peg->f20171119->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171120->Visible) { // f20171120 ?>
		<th><span id="elh_t_jd_krj_peg_f20171120" class="t_jd_krj_peg_f20171120"><?php echo $t_jd_krj_peg->f20171120->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171121->Visible) { // f20171121 ?>
		<th><span id="elh_t_jd_krj_peg_f20171121" class="t_jd_krj_peg_f20171121"><?php echo $t_jd_krj_peg->f20171121->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171122->Visible) { // f20171122 ?>
		<th><span id="elh_t_jd_krj_peg_f20171122" class="t_jd_krj_peg_f20171122"><?php echo $t_jd_krj_peg->f20171122->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171123->Visible) { // f20171123 ?>
		<th><span id="elh_t_jd_krj_peg_f20171123" class="t_jd_krj_peg_f20171123"><?php echo $t_jd_krj_peg->f20171123->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171124->Visible) { // f20171124 ?>
		<th><span id="elh_t_jd_krj_peg_f20171124" class="t_jd_krj_peg_f20171124"><?php echo $t_jd_krj_peg->f20171124->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171125->Visible) { // f20171125 ?>
		<th><span id="elh_t_jd_krj_peg_f20171125" class="t_jd_krj_peg_f20171125"><?php echo $t_jd_krj_peg->f20171125->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171126->Visible) { // f20171126 ?>
		<th><span id="elh_t_jd_krj_peg_f20171126" class="t_jd_krj_peg_f20171126"><?php echo $t_jd_krj_peg->f20171126->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171127->Visible) { // f20171127 ?>
		<th><span id="elh_t_jd_krj_peg_f20171127" class="t_jd_krj_peg_f20171127"><?php echo $t_jd_krj_peg->f20171127->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171128->Visible) { // f20171128 ?>
		<th><span id="elh_t_jd_krj_peg_f20171128" class="t_jd_krj_peg_f20171128"><?php echo $t_jd_krj_peg->f20171128->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171129->Visible) { // f20171129 ?>
		<th><span id="elh_t_jd_krj_peg_f20171129" class="t_jd_krj_peg_f20171129"><?php echo $t_jd_krj_peg->f20171129->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171130->Visible) { // f20171130 ?>
		<th><span id="elh_t_jd_krj_peg_f20171130" class="t_jd_krj_peg_f20171130"><?php echo $t_jd_krj_peg->f20171130->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171201->Visible) { // f20171201 ?>
		<th><span id="elh_t_jd_krj_peg_f20171201" class="t_jd_krj_peg_f20171201"><?php echo $t_jd_krj_peg->f20171201->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171202->Visible) { // f20171202 ?>
		<th><span id="elh_t_jd_krj_peg_f20171202" class="t_jd_krj_peg_f20171202"><?php echo $t_jd_krj_peg->f20171202->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171203->Visible) { // f20171203 ?>
		<th><span id="elh_t_jd_krj_peg_f20171203" class="t_jd_krj_peg_f20171203"><?php echo $t_jd_krj_peg->f20171203->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171204->Visible) { // f20171204 ?>
		<th><span id="elh_t_jd_krj_peg_f20171204" class="t_jd_krj_peg_f20171204"><?php echo $t_jd_krj_peg->f20171204->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171205->Visible) { // f20171205 ?>
		<th><span id="elh_t_jd_krj_peg_f20171205" class="t_jd_krj_peg_f20171205"><?php echo $t_jd_krj_peg->f20171205->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171206->Visible) { // f20171206 ?>
		<th><span id="elh_t_jd_krj_peg_f20171206" class="t_jd_krj_peg_f20171206"><?php echo $t_jd_krj_peg->f20171206->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171207->Visible) { // f20171207 ?>
		<th><span id="elh_t_jd_krj_peg_f20171207" class="t_jd_krj_peg_f20171207"><?php echo $t_jd_krj_peg->f20171207->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171208->Visible) { // f20171208 ?>
		<th><span id="elh_t_jd_krj_peg_f20171208" class="t_jd_krj_peg_f20171208"><?php echo $t_jd_krj_peg->f20171208->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171209->Visible) { // f20171209 ?>
		<th><span id="elh_t_jd_krj_peg_f20171209" class="t_jd_krj_peg_f20171209"><?php echo $t_jd_krj_peg->f20171209->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171210->Visible) { // f20171210 ?>
		<th><span id="elh_t_jd_krj_peg_f20171210" class="t_jd_krj_peg_f20171210"><?php echo $t_jd_krj_peg->f20171210->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171211->Visible) { // f20171211 ?>
		<th><span id="elh_t_jd_krj_peg_f20171211" class="t_jd_krj_peg_f20171211"><?php echo $t_jd_krj_peg->f20171211->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171212->Visible) { // f20171212 ?>
		<th><span id="elh_t_jd_krj_peg_f20171212" class="t_jd_krj_peg_f20171212"><?php echo $t_jd_krj_peg->f20171212->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171213->Visible) { // f20171213 ?>
		<th><span id="elh_t_jd_krj_peg_f20171213" class="t_jd_krj_peg_f20171213"><?php echo $t_jd_krj_peg->f20171213->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171214->Visible) { // f20171214 ?>
		<th><span id="elh_t_jd_krj_peg_f20171214" class="t_jd_krj_peg_f20171214"><?php echo $t_jd_krj_peg->f20171214->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171215->Visible) { // f20171215 ?>
		<th><span id="elh_t_jd_krj_peg_f20171215" class="t_jd_krj_peg_f20171215"><?php echo $t_jd_krj_peg->f20171215->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171216->Visible) { // f20171216 ?>
		<th><span id="elh_t_jd_krj_peg_f20171216" class="t_jd_krj_peg_f20171216"><?php echo $t_jd_krj_peg->f20171216->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171217->Visible) { // f20171217 ?>
		<th><span id="elh_t_jd_krj_peg_f20171217" class="t_jd_krj_peg_f20171217"><?php echo $t_jd_krj_peg->f20171217->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171218->Visible) { // f20171218 ?>
		<th><span id="elh_t_jd_krj_peg_f20171218" class="t_jd_krj_peg_f20171218"><?php echo $t_jd_krj_peg->f20171218->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171219->Visible) { // f20171219 ?>
		<th><span id="elh_t_jd_krj_peg_f20171219" class="t_jd_krj_peg_f20171219"><?php echo $t_jd_krj_peg->f20171219->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171220->Visible) { // f20171220 ?>
		<th><span id="elh_t_jd_krj_peg_f20171220" class="t_jd_krj_peg_f20171220"><?php echo $t_jd_krj_peg->f20171220->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171221->Visible) { // f20171221 ?>
		<th><span id="elh_t_jd_krj_peg_f20171221" class="t_jd_krj_peg_f20171221"><?php echo $t_jd_krj_peg->f20171221->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171222->Visible) { // f20171222 ?>
		<th><span id="elh_t_jd_krj_peg_f20171222" class="t_jd_krj_peg_f20171222"><?php echo $t_jd_krj_peg->f20171222->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171223->Visible) { // f20171223 ?>
		<th><span id="elh_t_jd_krj_peg_f20171223" class="t_jd_krj_peg_f20171223"><?php echo $t_jd_krj_peg->f20171223->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171224->Visible) { // f20171224 ?>
		<th><span id="elh_t_jd_krj_peg_f20171224" class="t_jd_krj_peg_f20171224"><?php echo $t_jd_krj_peg->f20171224->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171225->Visible) { // f20171225 ?>
		<th><span id="elh_t_jd_krj_peg_f20171225" class="t_jd_krj_peg_f20171225"><?php echo $t_jd_krj_peg->f20171225->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171226->Visible) { // f20171226 ?>
		<th><span id="elh_t_jd_krj_peg_f20171226" class="t_jd_krj_peg_f20171226"><?php echo $t_jd_krj_peg->f20171226->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171227->Visible) { // f20171227 ?>
		<th><span id="elh_t_jd_krj_peg_f20171227" class="t_jd_krj_peg_f20171227"><?php echo $t_jd_krj_peg->f20171227->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171228->Visible) { // f20171228 ?>
		<th><span id="elh_t_jd_krj_peg_f20171228" class="t_jd_krj_peg_f20171228"><?php echo $t_jd_krj_peg->f20171228->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171229->Visible) { // f20171229 ?>
		<th><span id="elh_t_jd_krj_peg_f20171229" class="t_jd_krj_peg_f20171229"><?php echo $t_jd_krj_peg->f20171229->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171230->Visible) { // f20171230 ?>
		<th><span id="elh_t_jd_krj_peg_f20171230" class="t_jd_krj_peg_f20171230"><?php echo $t_jd_krj_peg->f20171230->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171231->Visible) { // f20171231 ?>
		<th><span id="elh_t_jd_krj_peg_f20171231" class="t_jd_krj_peg_f20171231"><?php echo $t_jd_krj_peg->f20171231->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t_jd_krj_peg_delete->RecCnt = 0;
$i = 0;
while (!$t_jd_krj_peg_delete->Recordset->EOF) {
	$t_jd_krj_peg_delete->RecCnt++;
	$t_jd_krj_peg_delete->RowCnt++;

	// Set row properties
	$t_jd_krj_peg->ResetAttrs();
	$t_jd_krj_peg->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$t_jd_krj_peg_delete->LoadRowValues($t_jd_krj_peg_delete->Recordset);

	// Render row
	$t_jd_krj_peg_delete->RenderRow();
?>
	<tr<?php echo $t_jd_krj_peg->RowAttributes() ?>>
<?php if ($t_jd_krj_peg->jdwkrjpeg_id->Visible) { // jdwkrjpeg_id ?>
		<td<?php echo $t_jd_krj_peg->jdwkrjpeg_id->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_jdwkrjpeg_id" class="t_jd_krj_peg_jdwkrjpeg_id">
<span<?php echo $t_jd_krj_peg->jdwkrjpeg_id->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->jdwkrjpeg_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->pegawai_id->Visible) { // pegawai_id ?>
		<td<?php echo $t_jd_krj_peg->pegawai_id->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_pegawai_id" class="t_jd_krj_peg_pegawai_id">
<span<?php echo $t_jd_krj_peg->pegawai_id->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->pegawai_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170101->Visible) { // f20170101 ?>
		<td<?php echo $t_jd_krj_peg->f20170101->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170101" class="t_jd_krj_peg_f20170101">
<span<?php echo $t_jd_krj_peg->f20170101->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170101->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170102->Visible) { // f20170102 ?>
		<td<?php echo $t_jd_krj_peg->f20170102->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170102" class="t_jd_krj_peg_f20170102">
<span<?php echo $t_jd_krj_peg->f20170102->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170102->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170103->Visible) { // f20170103 ?>
		<td<?php echo $t_jd_krj_peg->f20170103->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170103" class="t_jd_krj_peg_f20170103">
<span<?php echo $t_jd_krj_peg->f20170103->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170103->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170104->Visible) { // f20170104 ?>
		<td<?php echo $t_jd_krj_peg->f20170104->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170104" class="t_jd_krj_peg_f20170104">
<span<?php echo $t_jd_krj_peg->f20170104->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170104->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170105->Visible) { // f20170105 ?>
		<td<?php echo $t_jd_krj_peg->f20170105->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170105" class="t_jd_krj_peg_f20170105">
<span<?php echo $t_jd_krj_peg->f20170105->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170105->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170106->Visible) { // f20170106 ?>
		<td<?php echo $t_jd_krj_peg->f20170106->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170106" class="t_jd_krj_peg_f20170106">
<span<?php echo $t_jd_krj_peg->f20170106->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170106->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170107->Visible) { // f20170107 ?>
		<td<?php echo $t_jd_krj_peg->f20170107->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170107" class="t_jd_krj_peg_f20170107">
<span<?php echo $t_jd_krj_peg->f20170107->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170107->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170108->Visible) { // f20170108 ?>
		<td<?php echo $t_jd_krj_peg->f20170108->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170108" class="t_jd_krj_peg_f20170108">
<span<?php echo $t_jd_krj_peg->f20170108->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170108->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170109->Visible) { // f20170109 ?>
		<td<?php echo $t_jd_krj_peg->f20170109->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170109" class="t_jd_krj_peg_f20170109">
<span<?php echo $t_jd_krj_peg->f20170109->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170109->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170110->Visible) { // f20170110 ?>
		<td<?php echo $t_jd_krj_peg->f20170110->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170110" class="t_jd_krj_peg_f20170110">
<span<?php echo $t_jd_krj_peg->f20170110->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170110->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170111->Visible) { // f20170111 ?>
		<td<?php echo $t_jd_krj_peg->f20170111->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170111" class="t_jd_krj_peg_f20170111">
<span<?php echo $t_jd_krj_peg->f20170111->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170111->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170112->Visible) { // f20170112 ?>
		<td<?php echo $t_jd_krj_peg->f20170112->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170112" class="t_jd_krj_peg_f20170112">
<span<?php echo $t_jd_krj_peg->f20170112->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170112->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170113->Visible) { // f20170113 ?>
		<td<?php echo $t_jd_krj_peg->f20170113->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170113" class="t_jd_krj_peg_f20170113">
<span<?php echo $t_jd_krj_peg->f20170113->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170113->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170114->Visible) { // f20170114 ?>
		<td<?php echo $t_jd_krj_peg->f20170114->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170114" class="t_jd_krj_peg_f20170114">
<span<?php echo $t_jd_krj_peg->f20170114->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170114->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170115->Visible) { // f20170115 ?>
		<td<?php echo $t_jd_krj_peg->f20170115->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170115" class="t_jd_krj_peg_f20170115">
<span<?php echo $t_jd_krj_peg->f20170115->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170115->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170116->Visible) { // f20170116 ?>
		<td<?php echo $t_jd_krj_peg->f20170116->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170116" class="t_jd_krj_peg_f20170116">
<span<?php echo $t_jd_krj_peg->f20170116->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170116->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170117->Visible) { // f20170117 ?>
		<td<?php echo $t_jd_krj_peg->f20170117->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170117" class="t_jd_krj_peg_f20170117">
<span<?php echo $t_jd_krj_peg->f20170117->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170117->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170118->Visible) { // f20170118 ?>
		<td<?php echo $t_jd_krj_peg->f20170118->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170118" class="t_jd_krj_peg_f20170118">
<span<?php echo $t_jd_krj_peg->f20170118->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170118->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170119->Visible) { // f20170119 ?>
		<td<?php echo $t_jd_krj_peg->f20170119->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170119" class="t_jd_krj_peg_f20170119">
<span<?php echo $t_jd_krj_peg->f20170119->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170119->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170120->Visible) { // f20170120 ?>
		<td<?php echo $t_jd_krj_peg->f20170120->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170120" class="t_jd_krj_peg_f20170120">
<span<?php echo $t_jd_krj_peg->f20170120->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170120->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170121->Visible) { // f20170121 ?>
		<td<?php echo $t_jd_krj_peg->f20170121->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170121" class="t_jd_krj_peg_f20170121">
<span<?php echo $t_jd_krj_peg->f20170121->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170121->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170122->Visible) { // f20170122 ?>
		<td<?php echo $t_jd_krj_peg->f20170122->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170122" class="t_jd_krj_peg_f20170122">
<span<?php echo $t_jd_krj_peg->f20170122->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170122->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170123->Visible) { // f20170123 ?>
		<td<?php echo $t_jd_krj_peg->f20170123->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170123" class="t_jd_krj_peg_f20170123">
<span<?php echo $t_jd_krj_peg->f20170123->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170123->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170124->Visible) { // f20170124 ?>
		<td<?php echo $t_jd_krj_peg->f20170124->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170124" class="t_jd_krj_peg_f20170124">
<span<?php echo $t_jd_krj_peg->f20170124->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170124->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170125->Visible) { // f20170125 ?>
		<td<?php echo $t_jd_krj_peg->f20170125->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170125" class="t_jd_krj_peg_f20170125">
<span<?php echo $t_jd_krj_peg->f20170125->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170125->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170126->Visible) { // f20170126 ?>
		<td<?php echo $t_jd_krj_peg->f20170126->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170126" class="t_jd_krj_peg_f20170126">
<span<?php echo $t_jd_krj_peg->f20170126->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170126->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170127->Visible) { // f20170127 ?>
		<td<?php echo $t_jd_krj_peg->f20170127->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170127" class="t_jd_krj_peg_f20170127">
<span<?php echo $t_jd_krj_peg->f20170127->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170127->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170128->Visible) { // f20170128 ?>
		<td<?php echo $t_jd_krj_peg->f20170128->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170128" class="t_jd_krj_peg_f20170128">
<span<?php echo $t_jd_krj_peg->f20170128->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170128->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170129->Visible) { // f20170129 ?>
		<td<?php echo $t_jd_krj_peg->f20170129->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170129" class="t_jd_krj_peg_f20170129">
<span<?php echo $t_jd_krj_peg->f20170129->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170129->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170130->Visible) { // f20170130 ?>
		<td<?php echo $t_jd_krj_peg->f20170130->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170130" class="t_jd_krj_peg_f20170130">
<span<?php echo $t_jd_krj_peg->f20170130->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170130->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170131->Visible) { // f20170131 ?>
		<td<?php echo $t_jd_krj_peg->f20170131->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170131" class="t_jd_krj_peg_f20170131">
<span<?php echo $t_jd_krj_peg->f20170131->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170131->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170201->Visible) { // f20170201 ?>
		<td<?php echo $t_jd_krj_peg->f20170201->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170201" class="t_jd_krj_peg_f20170201">
<span<?php echo $t_jd_krj_peg->f20170201->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170201->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170202->Visible) { // f20170202 ?>
		<td<?php echo $t_jd_krj_peg->f20170202->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170202" class="t_jd_krj_peg_f20170202">
<span<?php echo $t_jd_krj_peg->f20170202->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170202->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170203->Visible) { // f20170203 ?>
		<td<?php echo $t_jd_krj_peg->f20170203->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170203" class="t_jd_krj_peg_f20170203">
<span<?php echo $t_jd_krj_peg->f20170203->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170203->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170204->Visible) { // f20170204 ?>
		<td<?php echo $t_jd_krj_peg->f20170204->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170204" class="t_jd_krj_peg_f20170204">
<span<?php echo $t_jd_krj_peg->f20170204->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170204->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170205->Visible) { // f20170205 ?>
		<td<?php echo $t_jd_krj_peg->f20170205->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170205" class="t_jd_krj_peg_f20170205">
<span<?php echo $t_jd_krj_peg->f20170205->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170205->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170206->Visible) { // f20170206 ?>
		<td<?php echo $t_jd_krj_peg->f20170206->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170206" class="t_jd_krj_peg_f20170206">
<span<?php echo $t_jd_krj_peg->f20170206->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170206->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170207->Visible) { // f20170207 ?>
		<td<?php echo $t_jd_krj_peg->f20170207->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170207" class="t_jd_krj_peg_f20170207">
<span<?php echo $t_jd_krj_peg->f20170207->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170207->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170208->Visible) { // f20170208 ?>
		<td<?php echo $t_jd_krj_peg->f20170208->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170208" class="t_jd_krj_peg_f20170208">
<span<?php echo $t_jd_krj_peg->f20170208->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170208->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170209->Visible) { // f20170209 ?>
		<td<?php echo $t_jd_krj_peg->f20170209->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170209" class="t_jd_krj_peg_f20170209">
<span<?php echo $t_jd_krj_peg->f20170209->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170209->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170210->Visible) { // f20170210 ?>
		<td<?php echo $t_jd_krj_peg->f20170210->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170210" class="t_jd_krj_peg_f20170210">
<span<?php echo $t_jd_krj_peg->f20170210->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170210->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170211->Visible) { // f20170211 ?>
		<td<?php echo $t_jd_krj_peg->f20170211->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170211" class="t_jd_krj_peg_f20170211">
<span<?php echo $t_jd_krj_peg->f20170211->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170211->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170212->Visible) { // f20170212 ?>
		<td<?php echo $t_jd_krj_peg->f20170212->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170212" class="t_jd_krj_peg_f20170212">
<span<?php echo $t_jd_krj_peg->f20170212->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170212->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170213->Visible) { // f20170213 ?>
		<td<?php echo $t_jd_krj_peg->f20170213->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170213" class="t_jd_krj_peg_f20170213">
<span<?php echo $t_jd_krj_peg->f20170213->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170213->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170214->Visible) { // f20170214 ?>
		<td<?php echo $t_jd_krj_peg->f20170214->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170214" class="t_jd_krj_peg_f20170214">
<span<?php echo $t_jd_krj_peg->f20170214->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170214->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170215->Visible) { // f20170215 ?>
		<td<?php echo $t_jd_krj_peg->f20170215->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170215" class="t_jd_krj_peg_f20170215">
<span<?php echo $t_jd_krj_peg->f20170215->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170215->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170216->Visible) { // f20170216 ?>
		<td<?php echo $t_jd_krj_peg->f20170216->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170216" class="t_jd_krj_peg_f20170216">
<span<?php echo $t_jd_krj_peg->f20170216->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170216->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170217->Visible) { // f20170217 ?>
		<td<?php echo $t_jd_krj_peg->f20170217->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170217" class="t_jd_krj_peg_f20170217">
<span<?php echo $t_jd_krj_peg->f20170217->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170217->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170218->Visible) { // f20170218 ?>
		<td<?php echo $t_jd_krj_peg->f20170218->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170218" class="t_jd_krj_peg_f20170218">
<span<?php echo $t_jd_krj_peg->f20170218->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170218->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170219->Visible) { // f20170219 ?>
		<td<?php echo $t_jd_krj_peg->f20170219->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170219" class="t_jd_krj_peg_f20170219">
<span<?php echo $t_jd_krj_peg->f20170219->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170219->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170220->Visible) { // f20170220 ?>
		<td<?php echo $t_jd_krj_peg->f20170220->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170220" class="t_jd_krj_peg_f20170220">
<span<?php echo $t_jd_krj_peg->f20170220->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170220->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170221->Visible) { // f20170221 ?>
		<td<?php echo $t_jd_krj_peg->f20170221->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170221" class="t_jd_krj_peg_f20170221">
<span<?php echo $t_jd_krj_peg->f20170221->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170221->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170222->Visible) { // f20170222 ?>
		<td<?php echo $t_jd_krj_peg->f20170222->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170222" class="t_jd_krj_peg_f20170222">
<span<?php echo $t_jd_krj_peg->f20170222->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170222->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170223->Visible) { // f20170223 ?>
		<td<?php echo $t_jd_krj_peg->f20170223->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170223" class="t_jd_krj_peg_f20170223">
<span<?php echo $t_jd_krj_peg->f20170223->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170223->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170224->Visible) { // f20170224 ?>
		<td<?php echo $t_jd_krj_peg->f20170224->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170224" class="t_jd_krj_peg_f20170224">
<span<?php echo $t_jd_krj_peg->f20170224->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170224->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170225->Visible) { // f20170225 ?>
		<td<?php echo $t_jd_krj_peg->f20170225->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170225" class="t_jd_krj_peg_f20170225">
<span<?php echo $t_jd_krj_peg->f20170225->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170225->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170226->Visible) { // f20170226 ?>
		<td<?php echo $t_jd_krj_peg->f20170226->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170226" class="t_jd_krj_peg_f20170226">
<span<?php echo $t_jd_krj_peg->f20170226->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170226->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170227->Visible) { // f20170227 ?>
		<td<?php echo $t_jd_krj_peg->f20170227->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170227" class="t_jd_krj_peg_f20170227">
<span<?php echo $t_jd_krj_peg->f20170227->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170227->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170228->Visible) { // f20170228 ?>
		<td<?php echo $t_jd_krj_peg->f20170228->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170228" class="t_jd_krj_peg_f20170228">
<span<?php echo $t_jd_krj_peg->f20170228->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170228->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170229->Visible) { // f20170229 ?>
		<td<?php echo $t_jd_krj_peg->f20170229->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170229" class="t_jd_krj_peg_f20170229">
<span<?php echo $t_jd_krj_peg->f20170229->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170229->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170301->Visible) { // f20170301 ?>
		<td<?php echo $t_jd_krj_peg->f20170301->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170301" class="t_jd_krj_peg_f20170301">
<span<?php echo $t_jd_krj_peg->f20170301->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170301->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170302->Visible) { // f20170302 ?>
		<td<?php echo $t_jd_krj_peg->f20170302->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170302" class="t_jd_krj_peg_f20170302">
<span<?php echo $t_jd_krj_peg->f20170302->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170302->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170303->Visible) { // f20170303 ?>
		<td<?php echo $t_jd_krj_peg->f20170303->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170303" class="t_jd_krj_peg_f20170303">
<span<?php echo $t_jd_krj_peg->f20170303->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170303->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170304->Visible) { // f20170304 ?>
		<td<?php echo $t_jd_krj_peg->f20170304->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170304" class="t_jd_krj_peg_f20170304">
<span<?php echo $t_jd_krj_peg->f20170304->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170304->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170305->Visible) { // f20170305 ?>
		<td<?php echo $t_jd_krj_peg->f20170305->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170305" class="t_jd_krj_peg_f20170305">
<span<?php echo $t_jd_krj_peg->f20170305->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170305->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170306->Visible) { // f20170306 ?>
		<td<?php echo $t_jd_krj_peg->f20170306->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170306" class="t_jd_krj_peg_f20170306">
<span<?php echo $t_jd_krj_peg->f20170306->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170306->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170307->Visible) { // f20170307 ?>
		<td<?php echo $t_jd_krj_peg->f20170307->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170307" class="t_jd_krj_peg_f20170307">
<span<?php echo $t_jd_krj_peg->f20170307->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170307->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170308->Visible) { // f20170308 ?>
		<td<?php echo $t_jd_krj_peg->f20170308->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170308" class="t_jd_krj_peg_f20170308">
<span<?php echo $t_jd_krj_peg->f20170308->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170308->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170309->Visible) { // f20170309 ?>
		<td<?php echo $t_jd_krj_peg->f20170309->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170309" class="t_jd_krj_peg_f20170309">
<span<?php echo $t_jd_krj_peg->f20170309->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170309->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170310->Visible) { // f20170310 ?>
		<td<?php echo $t_jd_krj_peg->f20170310->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170310" class="t_jd_krj_peg_f20170310">
<span<?php echo $t_jd_krj_peg->f20170310->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170310->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170311->Visible) { // f20170311 ?>
		<td<?php echo $t_jd_krj_peg->f20170311->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170311" class="t_jd_krj_peg_f20170311">
<span<?php echo $t_jd_krj_peg->f20170311->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170311->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170312->Visible) { // f20170312 ?>
		<td<?php echo $t_jd_krj_peg->f20170312->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170312" class="t_jd_krj_peg_f20170312">
<span<?php echo $t_jd_krj_peg->f20170312->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170312->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170313->Visible) { // f20170313 ?>
		<td<?php echo $t_jd_krj_peg->f20170313->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170313" class="t_jd_krj_peg_f20170313">
<span<?php echo $t_jd_krj_peg->f20170313->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170313->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170314->Visible) { // f20170314 ?>
		<td<?php echo $t_jd_krj_peg->f20170314->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170314" class="t_jd_krj_peg_f20170314">
<span<?php echo $t_jd_krj_peg->f20170314->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170314->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170315->Visible) { // f20170315 ?>
		<td<?php echo $t_jd_krj_peg->f20170315->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170315" class="t_jd_krj_peg_f20170315">
<span<?php echo $t_jd_krj_peg->f20170315->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170315->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170316->Visible) { // f20170316 ?>
		<td<?php echo $t_jd_krj_peg->f20170316->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170316" class="t_jd_krj_peg_f20170316">
<span<?php echo $t_jd_krj_peg->f20170316->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170316->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170317->Visible) { // f20170317 ?>
		<td<?php echo $t_jd_krj_peg->f20170317->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170317" class="t_jd_krj_peg_f20170317">
<span<?php echo $t_jd_krj_peg->f20170317->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170317->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170318->Visible) { // f20170318 ?>
		<td<?php echo $t_jd_krj_peg->f20170318->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170318" class="t_jd_krj_peg_f20170318">
<span<?php echo $t_jd_krj_peg->f20170318->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170318->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170319->Visible) { // f20170319 ?>
		<td<?php echo $t_jd_krj_peg->f20170319->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170319" class="t_jd_krj_peg_f20170319">
<span<?php echo $t_jd_krj_peg->f20170319->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170319->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170320->Visible) { // f20170320 ?>
		<td<?php echo $t_jd_krj_peg->f20170320->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170320" class="t_jd_krj_peg_f20170320">
<span<?php echo $t_jd_krj_peg->f20170320->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170320->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170321->Visible) { // f20170321 ?>
		<td<?php echo $t_jd_krj_peg->f20170321->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170321" class="t_jd_krj_peg_f20170321">
<span<?php echo $t_jd_krj_peg->f20170321->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170321->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170322->Visible) { // f20170322 ?>
		<td<?php echo $t_jd_krj_peg->f20170322->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170322" class="t_jd_krj_peg_f20170322">
<span<?php echo $t_jd_krj_peg->f20170322->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170322->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170323->Visible) { // f20170323 ?>
		<td<?php echo $t_jd_krj_peg->f20170323->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170323" class="t_jd_krj_peg_f20170323">
<span<?php echo $t_jd_krj_peg->f20170323->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170323->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170324->Visible) { // f20170324 ?>
		<td<?php echo $t_jd_krj_peg->f20170324->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170324" class="t_jd_krj_peg_f20170324">
<span<?php echo $t_jd_krj_peg->f20170324->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170324->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170325->Visible) { // f20170325 ?>
		<td<?php echo $t_jd_krj_peg->f20170325->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170325" class="t_jd_krj_peg_f20170325">
<span<?php echo $t_jd_krj_peg->f20170325->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170325->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170326->Visible) { // f20170326 ?>
		<td<?php echo $t_jd_krj_peg->f20170326->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170326" class="t_jd_krj_peg_f20170326">
<span<?php echo $t_jd_krj_peg->f20170326->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170326->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170327->Visible) { // f20170327 ?>
		<td<?php echo $t_jd_krj_peg->f20170327->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170327" class="t_jd_krj_peg_f20170327">
<span<?php echo $t_jd_krj_peg->f20170327->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170327->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170328->Visible) { // f20170328 ?>
		<td<?php echo $t_jd_krj_peg->f20170328->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170328" class="t_jd_krj_peg_f20170328">
<span<?php echo $t_jd_krj_peg->f20170328->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170328->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170329->Visible) { // f20170329 ?>
		<td<?php echo $t_jd_krj_peg->f20170329->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170329" class="t_jd_krj_peg_f20170329">
<span<?php echo $t_jd_krj_peg->f20170329->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170329->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170330->Visible) { // f20170330 ?>
		<td<?php echo $t_jd_krj_peg->f20170330->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170330" class="t_jd_krj_peg_f20170330">
<span<?php echo $t_jd_krj_peg->f20170330->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170330->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170331->Visible) { // f20170331 ?>
		<td<?php echo $t_jd_krj_peg->f20170331->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170331" class="t_jd_krj_peg_f20170331">
<span<?php echo $t_jd_krj_peg->f20170331->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170331->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170401->Visible) { // f20170401 ?>
		<td<?php echo $t_jd_krj_peg->f20170401->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170401" class="t_jd_krj_peg_f20170401">
<span<?php echo $t_jd_krj_peg->f20170401->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170401->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170402->Visible) { // f20170402 ?>
		<td<?php echo $t_jd_krj_peg->f20170402->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170402" class="t_jd_krj_peg_f20170402">
<span<?php echo $t_jd_krj_peg->f20170402->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170402->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170403->Visible) { // f20170403 ?>
		<td<?php echo $t_jd_krj_peg->f20170403->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170403" class="t_jd_krj_peg_f20170403">
<span<?php echo $t_jd_krj_peg->f20170403->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170403->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170404->Visible) { // f20170404 ?>
		<td<?php echo $t_jd_krj_peg->f20170404->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170404" class="t_jd_krj_peg_f20170404">
<span<?php echo $t_jd_krj_peg->f20170404->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170404->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170405->Visible) { // f20170405 ?>
		<td<?php echo $t_jd_krj_peg->f20170405->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170405" class="t_jd_krj_peg_f20170405">
<span<?php echo $t_jd_krj_peg->f20170405->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170405->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170406->Visible) { // f20170406 ?>
		<td<?php echo $t_jd_krj_peg->f20170406->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170406" class="t_jd_krj_peg_f20170406">
<span<?php echo $t_jd_krj_peg->f20170406->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170406->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170407->Visible) { // f20170407 ?>
		<td<?php echo $t_jd_krj_peg->f20170407->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170407" class="t_jd_krj_peg_f20170407">
<span<?php echo $t_jd_krj_peg->f20170407->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170407->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170408->Visible) { // f20170408 ?>
		<td<?php echo $t_jd_krj_peg->f20170408->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170408" class="t_jd_krj_peg_f20170408">
<span<?php echo $t_jd_krj_peg->f20170408->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170408->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170409->Visible) { // f20170409 ?>
		<td<?php echo $t_jd_krj_peg->f20170409->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170409" class="t_jd_krj_peg_f20170409">
<span<?php echo $t_jd_krj_peg->f20170409->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170409->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170410->Visible) { // f20170410 ?>
		<td<?php echo $t_jd_krj_peg->f20170410->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170410" class="t_jd_krj_peg_f20170410">
<span<?php echo $t_jd_krj_peg->f20170410->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170410->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170411->Visible) { // f20170411 ?>
		<td<?php echo $t_jd_krj_peg->f20170411->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170411" class="t_jd_krj_peg_f20170411">
<span<?php echo $t_jd_krj_peg->f20170411->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170411->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170412->Visible) { // f20170412 ?>
		<td<?php echo $t_jd_krj_peg->f20170412->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170412" class="t_jd_krj_peg_f20170412">
<span<?php echo $t_jd_krj_peg->f20170412->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170412->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170413->Visible) { // f20170413 ?>
		<td<?php echo $t_jd_krj_peg->f20170413->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170413" class="t_jd_krj_peg_f20170413">
<span<?php echo $t_jd_krj_peg->f20170413->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170413->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170414->Visible) { // f20170414 ?>
		<td<?php echo $t_jd_krj_peg->f20170414->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170414" class="t_jd_krj_peg_f20170414">
<span<?php echo $t_jd_krj_peg->f20170414->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170414->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170415->Visible) { // f20170415 ?>
		<td<?php echo $t_jd_krj_peg->f20170415->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170415" class="t_jd_krj_peg_f20170415">
<span<?php echo $t_jd_krj_peg->f20170415->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170415->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170416->Visible) { // f20170416 ?>
		<td<?php echo $t_jd_krj_peg->f20170416->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170416" class="t_jd_krj_peg_f20170416">
<span<?php echo $t_jd_krj_peg->f20170416->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170416->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170417->Visible) { // f20170417 ?>
		<td<?php echo $t_jd_krj_peg->f20170417->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170417" class="t_jd_krj_peg_f20170417">
<span<?php echo $t_jd_krj_peg->f20170417->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170417->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170418->Visible) { // f20170418 ?>
		<td<?php echo $t_jd_krj_peg->f20170418->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170418" class="t_jd_krj_peg_f20170418">
<span<?php echo $t_jd_krj_peg->f20170418->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170418->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170419->Visible) { // f20170419 ?>
		<td<?php echo $t_jd_krj_peg->f20170419->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170419" class="t_jd_krj_peg_f20170419">
<span<?php echo $t_jd_krj_peg->f20170419->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170419->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170420->Visible) { // f20170420 ?>
		<td<?php echo $t_jd_krj_peg->f20170420->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170420" class="t_jd_krj_peg_f20170420">
<span<?php echo $t_jd_krj_peg->f20170420->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170420->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170421->Visible) { // f20170421 ?>
		<td<?php echo $t_jd_krj_peg->f20170421->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170421" class="t_jd_krj_peg_f20170421">
<span<?php echo $t_jd_krj_peg->f20170421->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170421->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170422->Visible) { // f20170422 ?>
		<td<?php echo $t_jd_krj_peg->f20170422->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170422" class="t_jd_krj_peg_f20170422">
<span<?php echo $t_jd_krj_peg->f20170422->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170422->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170423->Visible) { // f20170423 ?>
		<td<?php echo $t_jd_krj_peg->f20170423->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170423" class="t_jd_krj_peg_f20170423">
<span<?php echo $t_jd_krj_peg->f20170423->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170423->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170424->Visible) { // f20170424 ?>
		<td<?php echo $t_jd_krj_peg->f20170424->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170424" class="t_jd_krj_peg_f20170424">
<span<?php echo $t_jd_krj_peg->f20170424->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170424->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170425->Visible) { // f20170425 ?>
		<td<?php echo $t_jd_krj_peg->f20170425->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170425" class="t_jd_krj_peg_f20170425">
<span<?php echo $t_jd_krj_peg->f20170425->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170425->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170426->Visible) { // f20170426 ?>
		<td<?php echo $t_jd_krj_peg->f20170426->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170426" class="t_jd_krj_peg_f20170426">
<span<?php echo $t_jd_krj_peg->f20170426->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170426->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170427->Visible) { // f20170427 ?>
		<td<?php echo $t_jd_krj_peg->f20170427->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170427" class="t_jd_krj_peg_f20170427">
<span<?php echo $t_jd_krj_peg->f20170427->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170427->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170428->Visible) { // f20170428 ?>
		<td<?php echo $t_jd_krj_peg->f20170428->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170428" class="t_jd_krj_peg_f20170428">
<span<?php echo $t_jd_krj_peg->f20170428->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170428->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170429->Visible) { // f20170429 ?>
		<td<?php echo $t_jd_krj_peg->f20170429->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170429" class="t_jd_krj_peg_f20170429">
<span<?php echo $t_jd_krj_peg->f20170429->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170429->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170430->Visible) { // f20170430 ?>
		<td<?php echo $t_jd_krj_peg->f20170430->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170430" class="t_jd_krj_peg_f20170430">
<span<?php echo $t_jd_krj_peg->f20170430->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170430->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170501->Visible) { // f20170501 ?>
		<td<?php echo $t_jd_krj_peg->f20170501->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170501" class="t_jd_krj_peg_f20170501">
<span<?php echo $t_jd_krj_peg->f20170501->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170501->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170502->Visible) { // f20170502 ?>
		<td<?php echo $t_jd_krj_peg->f20170502->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170502" class="t_jd_krj_peg_f20170502">
<span<?php echo $t_jd_krj_peg->f20170502->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170502->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170503->Visible) { // f20170503 ?>
		<td<?php echo $t_jd_krj_peg->f20170503->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170503" class="t_jd_krj_peg_f20170503">
<span<?php echo $t_jd_krj_peg->f20170503->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170503->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170504->Visible) { // f20170504 ?>
		<td<?php echo $t_jd_krj_peg->f20170504->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170504" class="t_jd_krj_peg_f20170504">
<span<?php echo $t_jd_krj_peg->f20170504->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170504->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170505->Visible) { // f20170505 ?>
		<td<?php echo $t_jd_krj_peg->f20170505->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170505" class="t_jd_krj_peg_f20170505">
<span<?php echo $t_jd_krj_peg->f20170505->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170505->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170506->Visible) { // f20170506 ?>
		<td<?php echo $t_jd_krj_peg->f20170506->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170506" class="t_jd_krj_peg_f20170506">
<span<?php echo $t_jd_krj_peg->f20170506->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170506->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170507->Visible) { // f20170507 ?>
		<td<?php echo $t_jd_krj_peg->f20170507->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170507" class="t_jd_krj_peg_f20170507">
<span<?php echo $t_jd_krj_peg->f20170507->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170507->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170508->Visible) { // f20170508 ?>
		<td<?php echo $t_jd_krj_peg->f20170508->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170508" class="t_jd_krj_peg_f20170508">
<span<?php echo $t_jd_krj_peg->f20170508->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170508->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170509->Visible) { // f20170509 ?>
		<td<?php echo $t_jd_krj_peg->f20170509->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170509" class="t_jd_krj_peg_f20170509">
<span<?php echo $t_jd_krj_peg->f20170509->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170509->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170510->Visible) { // f20170510 ?>
		<td<?php echo $t_jd_krj_peg->f20170510->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170510" class="t_jd_krj_peg_f20170510">
<span<?php echo $t_jd_krj_peg->f20170510->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170510->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170511->Visible) { // f20170511 ?>
		<td<?php echo $t_jd_krj_peg->f20170511->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170511" class="t_jd_krj_peg_f20170511">
<span<?php echo $t_jd_krj_peg->f20170511->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170511->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170512->Visible) { // f20170512 ?>
		<td<?php echo $t_jd_krj_peg->f20170512->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170512" class="t_jd_krj_peg_f20170512">
<span<?php echo $t_jd_krj_peg->f20170512->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170512->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170513->Visible) { // f20170513 ?>
		<td<?php echo $t_jd_krj_peg->f20170513->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170513" class="t_jd_krj_peg_f20170513">
<span<?php echo $t_jd_krj_peg->f20170513->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170513->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170514->Visible) { // f20170514 ?>
		<td<?php echo $t_jd_krj_peg->f20170514->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170514" class="t_jd_krj_peg_f20170514">
<span<?php echo $t_jd_krj_peg->f20170514->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170514->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170515->Visible) { // f20170515 ?>
		<td<?php echo $t_jd_krj_peg->f20170515->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170515" class="t_jd_krj_peg_f20170515">
<span<?php echo $t_jd_krj_peg->f20170515->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170515->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170516->Visible) { // f20170516 ?>
		<td<?php echo $t_jd_krj_peg->f20170516->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170516" class="t_jd_krj_peg_f20170516">
<span<?php echo $t_jd_krj_peg->f20170516->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170516->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170517->Visible) { // f20170517 ?>
		<td<?php echo $t_jd_krj_peg->f20170517->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170517" class="t_jd_krj_peg_f20170517">
<span<?php echo $t_jd_krj_peg->f20170517->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170517->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170518->Visible) { // f20170518 ?>
		<td<?php echo $t_jd_krj_peg->f20170518->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170518" class="t_jd_krj_peg_f20170518">
<span<?php echo $t_jd_krj_peg->f20170518->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170518->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170519->Visible) { // f20170519 ?>
		<td<?php echo $t_jd_krj_peg->f20170519->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170519" class="t_jd_krj_peg_f20170519">
<span<?php echo $t_jd_krj_peg->f20170519->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170519->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170520->Visible) { // f20170520 ?>
		<td<?php echo $t_jd_krj_peg->f20170520->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170520" class="t_jd_krj_peg_f20170520">
<span<?php echo $t_jd_krj_peg->f20170520->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170520->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170521->Visible) { // f20170521 ?>
		<td<?php echo $t_jd_krj_peg->f20170521->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170521" class="t_jd_krj_peg_f20170521">
<span<?php echo $t_jd_krj_peg->f20170521->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170521->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170522->Visible) { // f20170522 ?>
		<td<?php echo $t_jd_krj_peg->f20170522->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170522" class="t_jd_krj_peg_f20170522">
<span<?php echo $t_jd_krj_peg->f20170522->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170522->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170523->Visible) { // f20170523 ?>
		<td<?php echo $t_jd_krj_peg->f20170523->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170523" class="t_jd_krj_peg_f20170523">
<span<?php echo $t_jd_krj_peg->f20170523->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170523->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170524->Visible) { // f20170524 ?>
		<td<?php echo $t_jd_krj_peg->f20170524->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170524" class="t_jd_krj_peg_f20170524">
<span<?php echo $t_jd_krj_peg->f20170524->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170524->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170525->Visible) { // f20170525 ?>
		<td<?php echo $t_jd_krj_peg->f20170525->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170525" class="t_jd_krj_peg_f20170525">
<span<?php echo $t_jd_krj_peg->f20170525->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170525->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170526->Visible) { // f20170526 ?>
		<td<?php echo $t_jd_krj_peg->f20170526->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170526" class="t_jd_krj_peg_f20170526">
<span<?php echo $t_jd_krj_peg->f20170526->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170526->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170527->Visible) { // f20170527 ?>
		<td<?php echo $t_jd_krj_peg->f20170527->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170527" class="t_jd_krj_peg_f20170527">
<span<?php echo $t_jd_krj_peg->f20170527->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170527->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170528->Visible) { // f20170528 ?>
		<td<?php echo $t_jd_krj_peg->f20170528->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170528" class="t_jd_krj_peg_f20170528">
<span<?php echo $t_jd_krj_peg->f20170528->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170528->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170529->Visible) { // f20170529 ?>
		<td<?php echo $t_jd_krj_peg->f20170529->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170529" class="t_jd_krj_peg_f20170529">
<span<?php echo $t_jd_krj_peg->f20170529->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170529->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170530->Visible) { // f20170530 ?>
		<td<?php echo $t_jd_krj_peg->f20170530->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170530" class="t_jd_krj_peg_f20170530">
<span<?php echo $t_jd_krj_peg->f20170530->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170530->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170531->Visible) { // f20170531 ?>
		<td<?php echo $t_jd_krj_peg->f20170531->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170531" class="t_jd_krj_peg_f20170531">
<span<?php echo $t_jd_krj_peg->f20170531->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170531->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170601->Visible) { // f20170601 ?>
		<td<?php echo $t_jd_krj_peg->f20170601->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170601" class="t_jd_krj_peg_f20170601">
<span<?php echo $t_jd_krj_peg->f20170601->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170601->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170602->Visible) { // f20170602 ?>
		<td<?php echo $t_jd_krj_peg->f20170602->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170602" class="t_jd_krj_peg_f20170602">
<span<?php echo $t_jd_krj_peg->f20170602->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170602->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170603->Visible) { // f20170603 ?>
		<td<?php echo $t_jd_krj_peg->f20170603->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170603" class="t_jd_krj_peg_f20170603">
<span<?php echo $t_jd_krj_peg->f20170603->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170603->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170604->Visible) { // f20170604 ?>
		<td<?php echo $t_jd_krj_peg->f20170604->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170604" class="t_jd_krj_peg_f20170604">
<span<?php echo $t_jd_krj_peg->f20170604->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170604->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170605->Visible) { // f20170605 ?>
		<td<?php echo $t_jd_krj_peg->f20170605->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170605" class="t_jd_krj_peg_f20170605">
<span<?php echo $t_jd_krj_peg->f20170605->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170605->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170606->Visible) { // f20170606 ?>
		<td<?php echo $t_jd_krj_peg->f20170606->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170606" class="t_jd_krj_peg_f20170606">
<span<?php echo $t_jd_krj_peg->f20170606->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170606->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170607->Visible) { // f20170607 ?>
		<td<?php echo $t_jd_krj_peg->f20170607->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170607" class="t_jd_krj_peg_f20170607">
<span<?php echo $t_jd_krj_peg->f20170607->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170607->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170608->Visible) { // f20170608 ?>
		<td<?php echo $t_jd_krj_peg->f20170608->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170608" class="t_jd_krj_peg_f20170608">
<span<?php echo $t_jd_krj_peg->f20170608->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170608->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170609->Visible) { // f20170609 ?>
		<td<?php echo $t_jd_krj_peg->f20170609->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170609" class="t_jd_krj_peg_f20170609">
<span<?php echo $t_jd_krj_peg->f20170609->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170609->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170610->Visible) { // f20170610 ?>
		<td<?php echo $t_jd_krj_peg->f20170610->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170610" class="t_jd_krj_peg_f20170610">
<span<?php echo $t_jd_krj_peg->f20170610->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170610->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170611->Visible) { // f20170611 ?>
		<td<?php echo $t_jd_krj_peg->f20170611->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170611" class="t_jd_krj_peg_f20170611">
<span<?php echo $t_jd_krj_peg->f20170611->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170611->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170612->Visible) { // f20170612 ?>
		<td<?php echo $t_jd_krj_peg->f20170612->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170612" class="t_jd_krj_peg_f20170612">
<span<?php echo $t_jd_krj_peg->f20170612->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170612->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170613->Visible) { // f20170613 ?>
		<td<?php echo $t_jd_krj_peg->f20170613->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170613" class="t_jd_krj_peg_f20170613">
<span<?php echo $t_jd_krj_peg->f20170613->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170613->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170614->Visible) { // f20170614 ?>
		<td<?php echo $t_jd_krj_peg->f20170614->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170614" class="t_jd_krj_peg_f20170614">
<span<?php echo $t_jd_krj_peg->f20170614->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170614->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170615->Visible) { // f20170615 ?>
		<td<?php echo $t_jd_krj_peg->f20170615->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170615" class="t_jd_krj_peg_f20170615">
<span<?php echo $t_jd_krj_peg->f20170615->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170615->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170616->Visible) { // f20170616 ?>
		<td<?php echo $t_jd_krj_peg->f20170616->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170616" class="t_jd_krj_peg_f20170616">
<span<?php echo $t_jd_krj_peg->f20170616->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170616->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170617->Visible) { // f20170617 ?>
		<td<?php echo $t_jd_krj_peg->f20170617->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170617" class="t_jd_krj_peg_f20170617">
<span<?php echo $t_jd_krj_peg->f20170617->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170617->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170618->Visible) { // f20170618 ?>
		<td<?php echo $t_jd_krj_peg->f20170618->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170618" class="t_jd_krj_peg_f20170618">
<span<?php echo $t_jd_krj_peg->f20170618->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170618->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170619->Visible) { // f20170619 ?>
		<td<?php echo $t_jd_krj_peg->f20170619->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170619" class="t_jd_krj_peg_f20170619">
<span<?php echo $t_jd_krj_peg->f20170619->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170619->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170620->Visible) { // f20170620 ?>
		<td<?php echo $t_jd_krj_peg->f20170620->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170620" class="t_jd_krj_peg_f20170620">
<span<?php echo $t_jd_krj_peg->f20170620->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170620->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170621->Visible) { // f20170621 ?>
		<td<?php echo $t_jd_krj_peg->f20170621->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170621" class="t_jd_krj_peg_f20170621">
<span<?php echo $t_jd_krj_peg->f20170621->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170621->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170622->Visible) { // f20170622 ?>
		<td<?php echo $t_jd_krj_peg->f20170622->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170622" class="t_jd_krj_peg_f20170622">
<span<?php echo $t_jd_krj_peg->f20170622->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170622->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170623->Visible) { // f20170623 ?>
		<td<?php echo $t_jd_krj_peg->f20170623->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170623" class="t_jd_krj_peg_f20170623">
<span<?php echo $t_jd_krj_peg->f20170623->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170623->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170624->Visible) { // f20170624 ?>
		<td<?php echo $t_jd_krj_peg->f20170624->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170624" class="t_jd_krj_peg_f20170624">
<span<?php echo $t_jd_krj_peg->f20170624->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170624->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170625->Visible) { // f20170625 ?>
		<td<?php echo $t_jd_krj_peg->f20170625->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170625" class="t_jd_krj_peg_f20170625">
<span<?php echo $t_jd_krj_peg->f20170625->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170625->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170626->Visible) { // f20170626 ?>
		<td<?php echo $t_jd_krj_peg->f20170626->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170626" class="t_jd_krj_peg_f20170626">
<span<?php echo $t_jd_krj_peg->f20170626->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170626->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170627->Visible) { // f20170627 ?>
		<td<?php echo $t_jd_krj_peg->f20170627->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170627" class="t_jd_krj_peg_f20170627">
<span<?php echo $t_jd_krj_peg->f20170627->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170627->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170628->Visible) { // f20170628 ?>
		<td<?php echo $t_jd_krj_peg->f20170628->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170628" class="t_jd_krj_peg_f20170628">
<span<?php echo $t_jd_krj_peg->f20170628->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170628->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170629->Visible) { // f20170629 ?>
		<td<?php echo $t_jd_krj_peg->f20170629->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170629" class="t_jd_krj_peg_f20170629">
<span<?php echo $t_jd_krj_peg->f20170629->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170629->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170630->Visible) { // f20170630 ?>
		<td<?php echo $t_jd_krj_peg->f20170630->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170630" class="t_jd_krj_peg_f20170630">
<span<?php echo $t_jd_krj_peg->f20170630->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170630->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170701->Visible) { // f20170701 ?>
		<td<?php echo $t_jd_krj_peg->f20170701->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170701" class="t_jd_krj_peg_f20170701">
<span<?php echo $t_jd_krj_peg->f20170701->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170701->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170702->Visible) { // f20170702 ?>
		<td<?php echo $t_jd_krj_peg->f20170702->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170702" class="t_jd_krj_peg_f20170702">
<span<?php echo $t_jd_krj_peg->f20170702->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170702->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170703->Visible) { // f20170703 ?>
		<td<?php echo $t_jd_krj_peg->f20170703->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170703" class="t_jd_krj_peg_f20170703">
<span<?php echo $t_jd_krj_peg->f20170703->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170703->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170704->Visible) { // f20170704 ?>
		<td<?php echo $t_jd_krj_peg->f20170704->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170704" class="t_jd_krj_peg_f20170704">
<span<?php echo $t_jd_krj_peg->f20170704->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170704->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170705->Visible) { // f20170705 ?>
		<td<?php echo $t_jd_krj_peg->f20170705->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170705" class="t_jd_krj_peg_f20170705">
<span<?php echo $t_jd_krj_peg->f20170705->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170705->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170706->Visible) { // f20170706 ?>
		<td<?php echo $t_jd_krj_peg->f20170706->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170706" class="t_jd_krj_peg_f20170706">
<span<?php echo $t_jd_krj_peg->f20170706->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170706->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170707->Visible) { // f20170707 ?>
		<td<?php echo $t_jd_krj_peg->f20170707->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170707" class="t_jd_krj_peg_f20170707">
<span<?php echo $t_jd_krj_peg->f20170707->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170707->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170708->Visible) { // f20170708 ?>
		<td<?php echo $t_jd_krj_peg->f20170708->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170708" class="t_jd_krj_peg_f20170708">
<span<?php echo $t_jd_krj_peg->f20170708->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170708->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170709->Visible) { // f20170709 ?>
		<td<?php echo $t_jd_krj_peg->f20170709->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170709" class="t_jd_krj_peg_f20170709">
<span<?php echo $t_jd_krj_peg->f20170709->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170709->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170710->Visible) { // f20170710 ?>
		<td<?php echo $t_jd_krj_peg->f20170710->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170710" class="t_jd_krj_peg_f20170710">
<span<?php echo $t_jd_krj_peg->f20170710->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170710->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170711->Visible) { // f20170711 ?>
		<td<?php echo $t_jd_krj_peg->f20170711->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170711" class="t_jd_krj_peg_f20170711">
<span<?php echo $t_jd_krj_peg->f20170711->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170711->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170712->Visible) { // f20170712 ?>
		<td<?php echo $t_jd_krj_peg->f20170712->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170712" class="t_jd_krj_peg_f20170712">
<span<?php echo $t_jd_krj_peg->f20170712->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170712->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170713->Visible) { // f20170713 ?>
		<td<?php echo $t_jd_krj_peg->f20170713->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170713" class="t_jd_krj_peg_f20170713">
<span<?php echo $t_jd_krj_peg->f20170713->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170713->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170714->Visible) { // f20170714 ?>
		<td<?php echo $t_jd_krj_peg->f20170714->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170714" class="t_jd_krj_peg_f20170714">
<span<?php echo $t_jd_krj_peg->f20170714->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170714->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170715->Visible) { // f20170715 ?>
		<td<?php echo $t_jd_krj_peg->f20170715->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170715" class="t_jd_krj_peg_f20170715">
<span<?php echo $t_jd_krj_peg->f20170715->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170715->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170716->Visible) { // f20170716 ?>
		<td<?php echo $t_jd_krj_peg->f20170716->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170716" class="t_jd_krj_peg_f20170716">
<span<?php echo $t_jd_krj_peg->f20170716->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170716->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170717->Visible) { // f20170717 ?>
		<td<?php echo $t_jd_krj_peg->f20170717->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170717" class="t_jd_krj_peg_f20170717">
<span<?php echo $t_jd_krj_peg->f20170717->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170717->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170718->Visible) { // f20170718 ?>
		<td<?php echo $t_jd_krj_peg->f20170718->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170718" class="t_jd_krj_peg_f20170718">
<span<?php echo $t_jd_krj_peg->f20170718->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170718->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170719->Visible) { // f20170719 ?>
		<td<?php echo $t_jd_krj_peg->f20170719->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170719" class="t_jd_krj_peg_f20170719">
<span<?php echo $t_jd_krj_peg->f20170719->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170719->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170720->Visible) { // f20170720 ?>
		<td<?php echo $t_jd_krj_peg->f20170720->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170720" class="t_jd_krj_peg_f20170720">
<span<?php echo $t_jd_krj_peg->f20170720->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170720->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170721->Visible) { // f20170721 ?>
		<td<?php echo $t_jd_krj_peg->f20170721->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170721" class="t_jd_krj_peg_f20170721">
<span<?php echo $t_jd_krj_peg->f20170721->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170721->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170722->Visible) { // f20170722 ?>
		<td<?php echo $t_jd_krj_peg->f20170722->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170722" class="t_jd_krj_peg_f20170722">
<span<?php echo $t_jd_krj_peg->f20170722->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170722->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170723->Visible) { // f20170723 ?>
		<td<?php echo $t_jd_krj_peg->f20170723->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170723" class="t_jd_krj_peg_f20170723">
<span<?php echo $t_jd_krj_peg->f20170723->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170723->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170724->Visible) { // f20170724 ?>
		<td<?php echo $t_jd_krj_peg->f20170724->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170724" class="t_jd_krj_peg_f20170724">
<span<?php echo $t_jd_krj_peg->f20170724->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170724->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170725->Visible) { // f20170725 ?>
		<td<?php echo $t_jd_krj_peg->f20170725->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170725" class="t_jd_krj_peg_f20170725">
<span<?php echo $t_jd_krj_peg->f20170725->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170725->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170726->Visible) { // f20170726 ?>
		<td<?php echo $t_jd_krj_peg->f20170726->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170726" class="t_jd_krj_peg_f20170726">
<span<?php echo $t_jd_krj_peg->f20170726->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170726->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170727->Visible) { // f20170727 ?>
		<td<?php echo $t_jd_krj_peg->f20170727->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170727" class="t_jd_krj_peg_f20170727">
<span<?php echo $t_jd_krj_peg->f20170727->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170727->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170728->Visible) { // f20170728 ?>
		<td<?php echo $t_jd_krj_peg->f20170728->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170728" class="t_jd_krj_peg_f20170728">
<span<?php echo $t_jd_krj_peg->f20170728->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170728->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170729->Visible) { // f20170729 ?>
		<td<?php echo $t_jd_krj_peg->f20170729->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170729" class="t_jd_krj_peg_f20170729">
<span<?php echo $t_jd_krj_peg->f20170729->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170729->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170730->Visible) { // f20170730 ?>
		<td<?php echo $t_jd_krj_peg->f20170730->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170730" class="t_jd_krj_peg_f20170730">
<span<?php echo $t_jd_krj_peg->f20170730->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170730->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170731->Visible) { // f20170731 ?>
		<td<?php echo $t_jd_krj_peg->f20170731->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170731" class="t_jd_krj_peg_f20170731">
<span<?php echo $t_jd_krj_peg->f20170731->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170731->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170801->Visible) { // f20170801 ?>
		<td<?php echo $t_jd_krj_peg->f20170801->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170801" class="t_jd_krj_peg_f20170801">
<span<?php echo $t_jd_krj_peg->f20170801->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170801->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170802->Visible) { // f20170802 ?>
		<td<?php echo $t_jd_krj_peg->f20170802->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170802" class="t_jd_krj_peg_f20170802">
<span<?php echo $t_jd_krj_peg->f20170802->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170802->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170803->Visible) { // f20170803 ?>
		<td<?php echo $t_jd_krj_peg->f20170803->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170803" class="t_jd_krj_peg_f20170803">
<span<?php echo $t_jd_krj_peg->f20170803->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170803->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170804->Visible) { // f20170804 ?>
		<td<?php echo $t_jd_krj_peg->f20170804->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170804" class="t_jd_krj_peg_f20170804">
<span<?php echo $t_jd_krj_peg->f20170804->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170804->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170805->Visible) { // f20170805 ?>
		<td<?php echo $t_jd_krj_peg->f20170805->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170805" class="t_jd_krj_peg_f20170805">
<span<?php echo $t_jd_krj_peg->f20170805->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170805->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170806->Visible) { // f20170806 ?>
		<td<?php echo $t_jd_krj_peg->f20170806->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170806" class="t_jd_krj_peg_f20170806">
<span<?php echo $t_jd_krj_peg->f20170806->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170806->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170807->Visible) { // f20170807 ?>
		<td<?php echo $t_jd_krj_peg->f20170807->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170807" class="t_jd_krj_peg_f20170807">
<span<?php echo $t_jd_krj_peg->f20170807->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170807->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170808->Visible) { // f20170808 ?>
		<td<?php echo $t_jd_krj_peg->f20170808->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170808" class="t_jd_krj_peg_f20170808">
<span<?php echo $t_jd_krj_peg->f20170808->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170808->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170809->Visible) { // f20170809 ?>
		<td<?php echo $t_jd_krj_peg->f20170809->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170809" class="t_jd_krj_peg_f20170809">
<span<?php echo $t_jd_krj_peg->f20170809->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170809->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170810->Visible) { // f20170810 ?>
		<td<?php echo $t_jd_krj_peg->f20170810->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170810" class="t_jd_krj_peg_f20170810">
<span<?php echo $t_jd_krj_peg->f20170810->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170810->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170811->Visible) { // f20170811 ?>
		<td<?php echo $t_jd_krj_peg->f20170811->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170811" class="t_jd_krj_peg_f20170811">
<span<?php echo $t_jd_krj_peg->f20170811->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170811->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170812->Visible) { // f20170812 ?>
		<td<?php echo $t_jd_krj_peg->f20170812->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170812" class="t_jd_krj_peg_f20170812">
<span<?php echo $t_jd_krj_peg->f20170812->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170812->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170813->Visible) { // f20170813 ?>
		<td<?php echo $t_jd_krj_peg->f20170813->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170813" class="t_jd_krj_peg_f20170813">
<span<?php echo $t_jd_krj_peg->f20170813->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170813->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170814->Visible) { // f20170814 ?>
		<td<?php echo $t_jd_krj_peg->f20170814->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170814" class="t_jd_krj_peg_f20170814">
<span<?php echo $t_jd_krj_peg->f20170814->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170814->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170815->Visible) { // f20170815 ?>
		<td<?php echo $t_jd_krj_peg->f20170815->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170815" class="t_jd_krj_peg_f20170815">
<span<?php echo $t_jd_krj_peg->f20170815->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170815->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170816->Visible) { // f20170816 ?>
		<td<?php echo $t_jd_krj_peg->f20170816->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170816" class="t_jd_krj_peg_f20170816">
<span<?php echo $t_jd_krj_peg->f20170816->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170816->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170817->Visible) { // f20170817 ?>
		<td<?php echo $t_jd_krj_peg->f20170817->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170817" class="t_jd_krj_peg_f20170817">
<span<?php echo $t_jd_krj_peg->f20170817->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170817->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170818->Visible) { // f20170818 ?>
		<td<?php echo $t_jd_krj_peg->f20170818->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170818" class="t_jd_krj_peg_f20170818">
<span<?php echo $t_jd_krj_peg->f20170818->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170818->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170819->Visible) { // f20170819 ?>
		<td<?php echo $t_jd_krj_peg->f20170819->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170819" class="t_jd_krj_peg_f20170819">
<span<?php echo $t_jd_krj_peg->f20170819->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170819->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170820->Visible) { // f20170820 ?>
		<td<?php echo $t_jd_krj_peg->f20170820->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170820" class="t_jd_krj_peg_f20170820">
<span<?php echo $t_jd_krj_peg->f20170820->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170820->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170821->Visible) { // f20170821 ?>
		<td<?php echo $t_jd_krj_peg->f20170821->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170821" class="t_jd_krj_peg_f20170821">
<span<?php echo $t_jd_krj_peg->f20170821->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170821->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170822->Visible) { // f20170822 ?>
		<td<?php echo $t_jd_krj_peg->f20170822->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170822" class="t_jd_krj_peg_f20170822">
<span<?php echo $t_jd_krj_peg->f20170822->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170822->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170823->Visible) { // f20170823 ?>
		<td<?php echo $t_jd_krj_peg->f20170823->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170823" class="t_jd_krj_peg_f20170823">
<span<?php echo $t_jd_krj_peg->f20170823->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170823->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170824->Visible) { // f20170824 ?>
		<td<?php echo $t_jd_krj_peg->f20170824->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170824" class="t_jd_krj_peg_f20170824">
<span<?php echo $t_jd_krj_peg->f20170824->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170824->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170825->Visible) { // f20170825 ?>
		<td<?php echo $t_jd_krj_peg->f20170825->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170825" class="t_jd_krj_peg_f20170825">
<span<?php echo $t_jd_krj_peg->f20170825->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170825->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170826->Visible) { // f20170826 ?>
		<td<?php echo $t_jd_krj_peg->f20170826->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170826" class="t_jd_krj_peg_f20170826">
<span<?php echo $t_jd_krj_peg->f20170826->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170826->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170827->Visible) { // f20170827 ?>
		<td<?php echo $t_jd_krj_peg->f20170827->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170827" class="t_jd_krj_peg_f20170827">
<span<?php echo $t_jd_krj_peg->f20170827->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170827->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170828->Visible) { // f20170828 ?>
		<td<?php echo $t_jd_krj_peg->f20170828->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170828" class="t_jd_krj_peg_f20170828">
<span<?php echo $t_jd_krj_peg->f20170828->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170828->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170829->Visible) { // f20170829 ?>
		<td<?php echo $t_jd_krj_peg->f20170829->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170829" class="t_jd_krj_peg_f20170829">
<span<?php echo $t_jd_krj_peg->f20170829->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170829->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170830->Visible) { // f20170830 ?>
		<td<?php echo $t_jd_krj_peg->f20170830->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170830" class="t_jd_krj_peg_f20170830">
<span<?php echo $t_jd_krj_peg->f20170830->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170830->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170831->Visible) { // f20170831 ?>
		<td<?php echo $t_jd_krj_peg->f20170831->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170831" class="t_jd_krj_peg_f20170831">
<span<?php echo $t_jd_krj_peg->f20170831->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170831->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170901->Visible) { // f20170901 ?>
		<td<?php echo $t_jd_krj_peg->f20170901->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170901" class="t_jd_krj_peg_f20170901">
<span<?php echo $t_jd_krj_peg->f20170901->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170901->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170902->Visible) { // f20170902 ?>
		<td<?php echo $t_jd_krj_peg->f20170902->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170902" class="t_jd_krj_peg_f20170902">
<span<?php echo $t_jd_krj_peg->f20170902->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170902->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170903->Visible) { // f20170903 ?>
		<td<?php echo $t_jd_krj_peg->f20170903->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170903" class="t_jd_krj_peg_f20170903">
<span<?php echo $t_jd_krj_peg->f20170903->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170903->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170904->Visible) { // f20170904 ?>
		<td<?php echo $t_jd_krj_peg->f20170904->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170904" class="t_jd_krj_peg_f20170904">
<span<?php echo $t_jd_krj_peg->f20170904->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170904->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170905->Visible) { // f20170905 ?>
		<td<?php echo $t_jd_krj_peg->f20170905->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170905" class="t_jd_krj_peg_f20170905">
<span<?php echo $t_jd_krj_peg->f20170905->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170905->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170906->Visible) { // f20170906 ?>
		<td<?php echo $t_jd_krj_peg->f20170906->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170906" class="t_jd_krj_peg_f20170906">
<span<?php echo $t_jd_krj_peg->f20170906->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170906->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170907->Visible) { // f20170907 ?>
		<td<?php echo $t_jd_krj_peg->f20170907->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170907" class="t_jd_krj_peg_f20170907">
<span<?php echo $t_jd_krj_peg->f20170907->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170907->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170908->Visible) { // f20170908 ?>
		<td<?php echo $t_jd_krj_peg->f20170908->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170908" class="t_jd_krj_peg_f20170908">
<span<?php echo $t_jd_krj_peg->f20170908->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170908->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170909->Visible) { // f20170909 ?>
		<td<?php echo $t_jd_krj_peg->f20170909->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170909" class="t_jd_krj_peg_f20170909">
<span<?php echo $t_jd_krj_peg->f20170909->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170909->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170910->Visible) { // f20170910 ?>
		<td<?php echo $t_jd_krj_peg->f20170910->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170910" class="t_jd_krj_peg_f20170910">
<span<?php echo $t_jd_krj_peg->f20170910->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170910->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170911->Visible) { // f20170911 ?>
		<td<?php echo $t_jd_krj_peg->f20170911->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170911" class="t_jd_krj_peg_f20170911">
<span<?php echo $t_jd_krj_peg->f20170911->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170911->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170912->Visible) { // f20170912 ?>
		<td<?php echo $t_jd_krj_peg->f20170912->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170912" class="t_jd_krj_peg_f20170912">
<span<?php echo $t_jd_krj_peg->f20170912->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170912->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170913->Visible) { // f20170913 ?>
		<td<?php echo $t_jd_krj_peg->f20170913->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170913" class="t_jd_krj_peg_f20170913">
<span<?php echo $t_jd_krj_peg->f20170913->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170913->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170914->Visible) { // f20170914 ?>
		<td<?php echo $t_jd_krj_peg->f20170914->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170914" class="t_jd_krj_peg_f20170914">
<span<?php echo $t_jd_krj_peg->f20170914->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170914->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170915->Visible) { // f20170915 ?>
		<td<?php echo $t_jd_krj_peg->f20170915->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170915" class="t_jd_krj_peg_f20170915">
<span<?php echo $t_jd_krj_peg->f20170915->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170915->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170916->Visible) { // f20170916 ?>
		<td<?php echo $t_jd_krj_peg->f20170916->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170916" class="t_jd_krj_peg_f20170916">
<span<?php echo $t_jd_krj_peg->f20170916->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170916->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170917->Visible) { // f20170917 ?>
		<td<?php echo $t_jd_krj_peg->f20170917->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170917" class="t_jd_krj_peg_f20170917">
<span<?php echo $t_jd_krj_peg->f20170917->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170917->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170918->Visible) { // f20170918 ?>
		<td<?php echo $t_jd_krj_peg->f20170918->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170918" class="t_jd_krj_peg_f20170918">
<span<?php echo $t_jd_krj_peg->f20170918->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170918->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170919->Visible) { // f20170919 ?>
		<td<?php echo $t_jd_krj_peg->f20170919->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170919" class="t_jd_krj_peg_f20170919">
<span<?php echo $t_jd_krj_peg->f20170919->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170919->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170920->Visible) { // f20170920 ?>
		<td<?php echo $t_jd_krj_peg->f20170920->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170920" class="t_jd_krj_peg_f20170920">
<span<?php echo $t_jd_krj_peg->f20170920->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170920->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170921->Visible) { // f20170921 ?>
		<td<?php echo $t_jd_krj_peg->f20170921->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170921" class="t_jd_krj_peg_f20170921">
<span<?php echo $t_jd_krj_peg->f20170921->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170921->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170922->Visible) { // f20170922 ?>
		<td<?php echo $t_jd_krj_peg->f20170922->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170922" class="t_jd_krj_peg_f20170922">
<span<?php echo $t_jd_krj_peg->f20170922->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170922->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170923->Visible) { // f20170923 ?>
		<td<?php echo $t_jd_krj_peg->f20170923->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170923" class="t_jd_krj_peg_f20170923">
<span<?php echo $t_jd_krj_peg->f20170923->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170923->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170924->Visible) { // f20170924 ?>
		<td<?php echo $t_jd_krj_peg->f20170924->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170924" class="t_jd_krj_peg_f20170924">
<span<?php echo $t_jd_krj_peg->f20170924->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170924->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170925->Visible) { // f20170925 ?>
		<td<?php echo $t_jd_krj_peg->f20170925->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170925" class="t_jd_krj_peg_f20170925">
<span<?php echo $t_jd_krj_peg->f20170925->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170925->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170926->Visible) { // f20170926 ?>
		<td<?php echo $t_jd_krj_peg->f20170926->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170926" class="t_jd_krj_peg_f20170926">
<span<?php echo $t_jd_krj_peg->f20170926->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170926->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170927->Visible) { // f20170927 ?>
		<td<?php echo $t_jd_krj_peg->f20170927->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170927" class="t_jd_krj_peg_f20170927">
<span<?php echo $t_jd_krj_peg->f20170927->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170927->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170928->Visible) { // f20170928 ?>
		<td<?php echo $t_jd_krj_peg->f20170928->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170928" class="t_jd_krj_peg_f20170928">
<span<?php echo $t_jd_krj_peg->f20170928->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170928->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170929->Visible) { // f20170929 ?>
		<td<?php echo $t_jd_krj_peg->f20170929->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170929" class="t_jd_krj_peg_f20170929">
<span<?php echo $t_jd_krj_peg->f20170929->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170929->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20170930->Visible) { // f20170930 ?>
		<td<?php echo $t_jd_krj_peg->f20170930->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20170930" class="t_jd_krj_peg_f20170930">
<span<?php echo $t_jd_krj_peg->f20170930->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20170930->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171001->Visible) { // f20171001 ?>
		<td<?php echo $t_jd_krj_peg->f20171001->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171001" class="t_jd_krj_peg_f20171001">
<span<?php echo $t_jd_krj_peg->f20171001->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171001->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171002->Visible) { // f20171002 ?>
		<td<?php echo $t_jd_krj_peg->f20171002->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171002" class="t_jd_krj_peg_f20171002">
<span<?php echo $t_jd_krj_peg->f20171002->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171002->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171003->Visible) { // f20171003 ?>
		<td<?php echo $t_jd_krj_peg->f20171003->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171003" class="t_jd_krj_peg_f20171003">
<span<?php echo $t_jd_krj_peg->f20171003->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171003->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171004->Visible) { // f20171004 ?>
		<td<?php echo $t_jd_krj_peg->f20171004->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171004" class="t_jd_krj_peg_f20171004">
<span<?php echo $t_jd_krj_peg->f20171004->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171004->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171005->Visible) { // f20171005 ?>
		<td<?php echo $t_jd_krj_peg->f20171005->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171005" class="t_jd_krj_peg_f20171005">
<span<?php echo $t_jd_krj_peg->f20171005->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171005->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171006->Visible) { // f20171006 ?>
		<td<?php echo $t_jd_krj_peg->f20171006->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171006" class="t_jd_krj_peg_f20171006">
<span<?php echo $t_jd_krj_peg->f20171006->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171006->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171007->Visible) { // f20171007 ?>
		<td<?php echo $t_jd_krj_peg->f20171007->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171007" class="t_jd_krj_peg_f20171007">
<span<?php echo $t_jd_krj_peg->f20171007->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171007->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171008->Visible) { // f20171008 ?>
		<td<?php echo $t_jd_krj_peg->f20171008->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171008" class="t_jd_krj_peg_f20171008">
<span<?php echo $t_jd_krj_peg->f20171008->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171008->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171009->Visible) { // f20171009 ?>
		<td<?php echo $t_jd_krj_peg->f20171009->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171009" class="t_jd_krj_peg_f20171009">
<span<?php echo $t_jd_krj_peg->f20171009->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171009->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171010->Visible) { // f20171010 ?>
		<td<?php echo $t_jd_krj_peg->f20171010->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171010" class="t_jd_krj_peg_f20171010">
<span<?php echo $t_jd_krj_peg->f20171010->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171010->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171011->Visible) { // f20171011 ?>
		<td<?php echo $t_jd_krj_peg->f20171011->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171011" class="t_jd_krj_peg_f20171011">
<span<?php echo $t_jd_krj_peg->f20171011->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171011->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171012->Visible) { // f20171012 ?>
		<td<?php echo $t_jd_krj_peg->f20171012->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171012" class="t_jd_krj_peg_f20171012">
<span<?php echo $t_jd_krj_peg->f20171012->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171012->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171013->Visible) { // f20171013 ?>
		<td<?php echo $t_jd_krj_peg->f20171013->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171013" class="t_jd_krj_peg_f20171013">
<span<?php echo $t_jd_krj_peg->f20171013->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171013->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171014->Visible) { // f20171014 ?>
		<td<?php echo $t_jd_krj_peg->f20171014->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171014" class="t_jd_krj_peg_f20171014">
<span<?php echo $t_jd_krj_peg->f20171014->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171014->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171015->Visible) { // f20171015 ?>
		<td<?php echo $t_jd_krj_peg->f20171015->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171015" class="t_jd_krj_peg_f20171015">
<span<?php echo $t_jd_krj_peg->f20171015->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171015->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171016->Visible) { // f20171016 ?>
		<td<?php echo $t_jd_krj_peg->f20171016->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171016" class="t_jd_krj_peg_f20171016">
<span<?php echo $t_jd_krj_peg->f20171016->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171016->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171017->Visible) { // f20171017 ?>
		<td<?php echo $t_jd_krj_peg->f20171017->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171017" class="t_jd_krj_peg_f20171017">
<span<?php echo $t_jd_krj_peg->f20171017->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171017->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171018->Visible) { // f20171018 ?>
		<td<?php echo $t_jd_krj_peg->f20171018->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171018" class="t_jd_krj_peg_f20171018">
<span<?php echo $t_jd_krj_peg->f20171018->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171018->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171019->Visible) { // f20171019 ?>
		<td<?php echo $t_jd_krj_peg->f20171019->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171019" class="t_jd_krj_peg_f20171019">
<span<?php echo $t_jd_krj_peg->f20171019->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171019->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171020->Visible) { // f20171020 ?>
		<td<?php echo $t_jd_krj_peg->f20171020->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171020" class="t_jd_krj_peg_f20171020">
<span<?php echo $t_jd_krj_peg->f20171020->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171020->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171021->Visible) { // f20171021 ?>
		<td<?php echo $t_jd_krj_peg->f20171021->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171021" class="t_jd_krj_peg_f20171021">
<span<?php echo $t_jd_krj_peg->f20171021->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171021->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171022->Visible) { // f20171022 ?>
		<td<?php echo $t_jd_krj_peg->f20171022->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171022" class="t_jd_krj_peg_f20171022">
<span<?php echo $t_jd_krj_peg->f20171022->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171022->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171023->Visible) { // f20171023 ?>
		<td<?php echo $t_jd_krj_peg->f20171023->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171023" class="t_jd_krj_peg_f20171023">
<span<?php echo $t_jd_krj_peg->f20171023->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171023->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171024->Visible) { // f20171024 ?>
		<td<?php echo $t_jd_krj_peg->f20171024->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171024" class="t_jd_krj_peg_f20171024">
<span<?php echo $t_jd_krj_peg->f20171024->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171024->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171025->Visible) { // f20171025 ?>
		<td<?php echo $t_jd_krj_peg->f20171025->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171025" class="t_jd_krj_peg_f20171025">
<span<?php echo $t_jd_krj_peg->f20171025->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171025->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171026->Visible) { // f20171026 ?>
		<td<?php echo $t_jd_krj_peg->f20171026->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171026" class="t_jd_krj_peg_f20171026">
<span<?php echo $t_jd_krj_peg->f20171026->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171026->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171027->Visible) { // f20171027 ?>
		<td<?php echo $t_jd_krj_peg->f20171027->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171027" class="t_jd_krj_peg_f20171027">
<span<?php echo $t_jd_krj_peg->f20171027->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171027->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171028->Visible) { // f20171028 ?>
		<td<?php echo $t_jd_krj_peg->f20171028->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171028" class="t_jd_krj_peg_f20171028">
<span<?php echo $t_jd_krj_peg->f20171028->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171028->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171029->Visible) { // f20171029 ?>
		<td<?php echo $t_jd_krj_peg->f20171029->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171029" class="t_jd_krj_peg_f20171029">
<span<?php echo $t_jd_krj_peg->f20171029->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171029->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171030->Visible) { // f20171030 ?>
		<td<?php echo $t_jd_krj_peg->f20171030->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171030" class="t_jd_krj_peg_f20171030">
<span<?php echo $t_jd_krj_peg->f20171030->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171030->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171031->Visible) { // f20171031 ?>
		<td<?php echo $t_jd_krj_peg->f20171031->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171031" class="t_jd_krj_peg_f20171031">
<span<?php echo $t_jd_krj_peg->f20171031->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171031->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171101->Visible) { // f20171101 ?>
		<td<?php echo $t_jd_krj_peg->f20171101->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171101" class="t_jd_krj_peg_f20171101">
<span<?php echo $t_jd_krj_peg->f20171101->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171101->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171102->Visible) { // f20171102 ?>
		<td<?php echo $t_jd_krj_peg->f20171102->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171102" class="t_jd_krj_peg_f20171102">
<span<?php echo $t_jd_krj_peg->f20171102->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171102->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171103->Visible) { // f20171103 ?>
		<td<?php echo $t_jd_krj_peg->f20171103->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171103" class="t_jd_krj_peg_f20171103">
<span<?php echo $t_jd_krj_peg->f20171103->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171103->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171104->Visible) { // f20171104 ?>
		<td<?php echo $t_jd_krj_peg->f20171104->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171104" class="t_jd_krj_peg_f20171104">
<span<?php echo $t_jd_krj_peg->f20171104->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171104->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171105->Visible) { // f20171105 ?>
		<td<?php echo $t_jd_krj_peg->f20171105->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171105" class="t_jd_krj_peg_f20171105">
<span<?php echo $t_jd_krj_peg->f20171105->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171105->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171106->Visible) { // f20171106 ?>
		<td<?php echo $t_jd_krj_peg->f20171106->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171106" class="t_jd_krj_peg_f20171106">
<span<?php echo $t_jd_krj_peg->f20171106->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171106->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171107->Visible) { // f20171107 ?>
		<td<?php echo $t_jd_krj_peg->f20171107->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171107" class="t_jd_krj_peg_f20171107">
<span<?php echo $t_jd_krj_peg->f20171107->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171107->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171108->Visible) { // f20171108 ?>
		<td<?php echo $t_jd_krj_peg->f20171108->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171108" class="t_jd_krj_peg_f20171108">
<span<?php echo $t_jd_krj_peg->f20171108->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171108->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171109->Visible) { // f20171109 ?>
		<td<?php echo $t_jd_krj_peg->f20171109->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171109" class="t_jd_krj_peg_f20171109">
<span<?php echo $t_jd_krj_peg->f20171109->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171109->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171110->Visible) { // f20171110 ?>
		<td<?php echo $t_jd_krj_peg->f20171110->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171110" class="t_jd_krj_peg_f20171110">
<span<?php echo $t_jd_krj_peg->f20171110->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171110->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171111->Visible) { // f20171111 ?>
		<td<?php echo $t_jd_krj_peg->f20171111->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171111" class="t_jd_krj_peg_f20171111">
<span<?php echo $t_jd_krj_peg->f20171111->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171111->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171112->Visible) { // f20171112 ?>
		<td<?php echo $t_jd_krj_peg->f20171112->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171112" class="t_jd_krj_peg_f20171112">
<span<?php echo $t_jd_krj_peg->f20171112->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171112->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171113->Visible) { // f20171113 ?>
		<td<?php echo $t_jd_krj_peg->f20171113->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171113" class="t_jd_krj_peg_f20171113">
<span<?php echo $t_jd_krj_peg->f20171113->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171113->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171114->Visible) { // f20171114 ?>
		<td<?php echo $t_jd_krj_peg->f20171114->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171114" class="t_jd_krj_peg_f20171114">
<span<?php echo $t_jd_krj_peg->f20171114->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171114->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171115->Visible) { // f20171115 ?>
		<td<?php echo $t_jd_krj_peg->f20171115->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171115" class="t_jd_krj_peg_f20171115">
<span<?php echo $t_jd_krj_peg->f20171115->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171115->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171116->Visible) { // f20171116 ?>
		<td<?php echo $t_jd_krj_peg->f20171116->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171116" class="t_jd_krj_peg_f20171116">
<span<?php echo $t_jd_krj_peg->f20171116->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171116->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171117->Visible) { // f20171117 ?>
		<td<?php echo $t_jd_krj_peg->f20171117->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171117" class="t_jd_krj_peg_f20171117">
<span<?php echo $t_jd_krj_peg->f20171117->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171117->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171118->Visible) { // f20171118 ?>
		<td<?php echo $t_jd_krj_peg->f20171118->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171118" class="t_jd_krj_peg_f20171118">
<span<?php echo $t_jd_krj_peg->f20171118->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171118->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171119->Visible) { // f20171119 ?>
		<td<?php echo $t_jd_krj_peg->f20171119->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171119" class="t_jd_krj_peg_f20171119">
<span<?php echo $t_jd_krj_peg->f20171119->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171119->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171120->Visible) { // f20171120 ?>
		<td<?php echo $t_jd_krj_peg->f20171120->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171120" class="t_jd_krj_peg_f20171120">
<span<?php echo $t_jd_krj_peg->f20171120->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171120->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171121->Visible) { // f20171121 ?>
		<td<?php echo $t_jd_krj_peg->f20171121->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171121" class="t_jd_krj_peg_f20171121">
<span<?php echo $t_jd_krj_peg->f20171121->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171121->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171122->Visible) { // f20171122 ?>
		<td<?php echo $t_jd_krj_peg->f20171122->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171122" class="t_jd_krj_peg_f20171122">
<span<?php echo $t_jd_krj_peg->f20171122->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171122->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171123->Visible) { // f20171123 ?>
		<td<?php echo $t_jd_krj_peg->f20171123->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171123" class="t_jd_krj_peg_f20171123">
<span<?php echo $t_jd_krj_peg->f20171123->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171123->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171124->Visible) { // f20171124 ?>
		<td<?php echo $t_jd_krj_peg->f20171124->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171124" class="t_jd_krj_peg_f20171124">
<span<?php echo $t_jd_krj_peg->f20171124->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171124->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171125->Visible) { // f20171125 ?>
		<td<?php echo $t_jd_krj_peg->f20171125->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171125" class="t_jd_krj_peg_f20171125">
<span<?php echo $t_jd_krj_peg->f20171125->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171125->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171126->Visible) { // f20171126 ?>
		<td<?php echo $t_jd_krj_peg->f20171126->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171126" class="t_jd_krj_peg_f20171126">
<span<?php echo $t_jd_krj_peg->f20171126->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171126->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171127->Visible) { // f20171127 ?>
		<td<?php echo $t_jd_krj_peg->f20171127->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171127" class="t_jd_krj_peg_f20171127">
<span<?php echo $t_jd_krj_peg->f20171127->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171127->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171128->Visible) { // f20171128 ?>
		<td<?php echo $t_jd_krj_peg->f20171128->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171128" class="t_jd_krj_peg_f20171128">
<span<?php echo $t_jd_krj_peg->f20171128->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171128->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171129->Visible) { // f20171129 ?>
		<td<?php echo $t_jd_krj_peg->f20171129->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171129" class="t_jd_krj_peg_f20171129">
<span<?php echo $t_jd_krj_peg->f20171129->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171129->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171130->Visible) { // f20171130 ?>
		<td<?php echo $t_jd_krj_peg->f20171130->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171130" class="t_jd_krj_peg_f20171130">
<span<?php echo $t_jd_krj_peg->f20171130->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171130->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171201->Visible) { // f20171201 ?>
		<td<?php echo $t_jd_krj_peg->f20171201->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171201" class="t_jd_krj_peg_f20171201">
<span<?php echo $t_jd_krj_peg->f20171201->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171201->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171202->Visible) { // f20171202 ?>
		<td<?php echo $t_jd_krj_peg->f20171202->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171202" class="t_jd_krj_peg_f20171202">
<span<?php echo $t_jd_krj_peg->f20171202->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171202->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171203->Visible) { // f20171203 ?>
		<td<?php echo $t_jd_krj_peg->f20171203->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171203" class="t_jd_krj_peg_f20171203">
<span<?php echo $t_jd_krj_peg->f20171203->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171203->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171204->Visible) { // f20171204 ?>
		<td<?php echo $t_jd_krj_peg->f20171204->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171204" class="t_jd_krj_peg_f20171204">
<span<?php echo $t_jd_krj_peg->f20171204->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171204->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171205->Visible) { // f20171205 ?>
		<td<?php echo $t_jd_krj_peg->f20171205->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171205" class="t_jd_krj_peg_f20171205">
<span<?php echo $t_jd_krj_peg->f20171205->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171205->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171206->Visible) { // f20171206 ?>
		<td<?php echo $t_jd_krj_peg->f20171206->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171206" class="t_jd_krj_peg_f20171206">
<span<?php echo $t_jd_krj_peg->f20171206->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171206->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171207->Visible) { // f20171207 ?>
		<td<?php echo $t_jd_krj_peg->f20171207->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171207" class="t_jd_krj_peg_f20171207">
<span<?php echo $t_jd_krj_peg->f20171207->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171207->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171208->Visible) { // f20171208 ?>
		<td<?php echo $t_jd_krj_peg->f20171208->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171208" class="t_jd_krj_peg_f20171208">
<span<?php echo $t_jd_krj_peg->f20171208->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171208->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171209->Visible) { // f20171209 ?>
		<td<?php echo $t_jd_krj_peg->f20171209->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171209" class="t_jd_krj_peg_f20171209">
<span<?php echo $t_jd_krj_peg->f20171209->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171209->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171210->Visible) { // f20171210 ?>
		<td<?php echo $t_jd_krj_peg->f20171210->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171210" class="t_jd_krj_peg_f20171210">
<span<?php echo $t_jd_krj_peg->f20171210->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171210->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171211->Visible) { // f20171211 ?>
		<td<?php echo $t_jd_krj_peg->f20171211->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171211" class="t_jd_krj_peg_f20171211">
<span<?php echo $t_jd_krj_peg->f20171211->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171211->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171212->Visible) { // f20171212 ?>
		<td<?php echo $t_jd_krj_peg->f20171212->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171212" class="t_jd_krj_peg_f20171212">
<span<?php echo $t_jd_krj_peg->f20171212->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171212->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171213->Visible) { // f20171213 ?>
		<td<?php echo $t_jd_krj_peg->f20171213->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171213" class="t_jd_krj_peg_f20171213">
<span<?php echo $t_jd_krj_peg->f20171213->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171213->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171214->Visible) { // f20171214 ?>
		<td<?php echo $t_jd_krj_peg->f20171214->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171214" class="t_jd_krj_peg_f20171214">
<span<?php echo $t_jd_krj_peg->f20171214->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171214->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171215->Visible) { // f20171215 ?>
		<td<?php echo $t_jd_krj_peg->f20171215->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171215" class="t_jd_krj_peg_f20171215">
<span<?php echo $t_jd_krj_peg->f20171215->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171215->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171216->Visible) { // f20171216 ?>
		<td<?php echo $t_jd_krj_peg->f20171216->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171216" class="t_jd_krj_peg_f20171216">
<span<?php echo $t_jd_krj_peg->f20171216->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171216->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171217->Visible) { // f20171217 ?>
		<td<?php echo $t_jd_krj_peg->f20171217->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171217" class="t_jd_krj_peg_f20171217">
<span<?php echo $t_jd_krj_peg->f20171217->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171217->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171218->Visible) { // f20171218 ?>
		<td<?php echo $t_jd_krj_peg->f20171218->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171218" class="t_jd_krj_peg_f20171218">
<span<?php echo $t_jd_krj_peg->f20171218->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171218->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171219->Visible) { // f20171219 ?>
		<td<?php echo $t_jd_krj_peg->f20171219->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171219" class="t_jd_krj_peg_f20171219">
<span<?php echo $t_jd_krj_peg->f20171219->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171219->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171220->Visible) { // f20171220 ?>
		<td<?php echo $t_jd_krj_peg->f20171220->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171220" class="t_jd_krj_peg_f20171220">
<span<?php echo $t_jd_krj_peg->f20171220->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171220->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171221->Visible) { // f20171221 ?>
		<td<?php echo $t_jd_krj_peg->f20171221->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171221" class="t_jd_krj_peg_f20171221">
<span<?php echo $t_jd_krj_peg->f20171221->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171221->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171222->Visible) { // f20171222 ?>
		<td<?php echo $t_jd_krj_peg->f20171222->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171222" class="t_jd_krj_peg_f20171222">
<span<?php echo $t_jd_krj_peg->f20171222->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171222->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171223->Visible) { // f20171223 ?>
		<td<?php echo $t_jd_krj_peg->f20171223->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171223" class="t_jd_krj_peg_f20171223">
<span<?php echo $t_jd_krj_peg->f20171223->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171223->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171224->Visible) { // f20171224 ?>
		<td<?php echo $t_jd_krj_peg->f20171224->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171224" class="t_jd_krj_peg_f20171224">
<span<?php echo $t_jd_krj_peg->f20171224->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171224->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171225->Visible) { // f20171225 ?>
		<td<?php echo $t_jd_krj_peg->f20171225->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171225" class="t_jd_krj_peg_f20171225">
<span<?php echo $t_jd_krj_peg->f20171225->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171225->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171226->Visible) { // f20171226 ?>
		<td<?php echo $t_jd_krj_peg->f20171226->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171226" class="t_jd_krj_peg_f20171226">
<span<?php echo $t_jd_krj_peg->f20171226->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171226->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171227->Visible) { // f20171227 ?>
		<td<?php echo $t_jd_krj_peg->f20171227->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171227" class="t_jd_krj_peg_f20171227">
<span<?php echo $t_jd_krj_peg->f20171227->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171227->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171228->Visible) { // f20171228 ?>
		<td<?php echo $t_jd_krj_peg->f20171228->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171228" class="t_jd_krj_peg_f20171228">
<span<?php echo $t_jd_krj_peg->f20171228->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171228->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171229->Visible) { // f20171229 ?>
		<td<?php echo $t_jd_krj_peg->f20171229->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171229" class="t_jd_krj_peg_f20171229">
<span<?php echo $t_jd_krj_peg->f20171229->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171229->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171230->Visible) { // f20171230 ?>
		<td<?php echo $t_jd_krj_peg->f20171230->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171230" class="t_jd_krj_peg_f20171230">
<span<?php echo $t_jd_krj_peg->f20171230->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171230->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t_jd_krj_peg->f20171231->Visible) { // f20171231 ?>
		<td<?php echo $t_jd_krj_peg->f20171231->CellAttributes() ?>>
<span id="el<?php echo $t_jd_krj_peg_delete->RowCnt ?>_t_jd_krj_peg_f20171231" class="t_jd_krj_peg_f20171231">
<span<?php echo $t_jd_krj_peg->f20171231->ViewAttributes() ?>>
<?php echo $t_jd_krj_peg->f20171231->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t_jd_krj_peg_delete->Recordset->MoveNext();
}
$t_jd_krj_peg_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t_jd_krj_peg_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
ft_jd_krj_pegdelete.Init();
</script>
<?php
$t_jd_krj_peg_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t_jd_krj_peg_delete->Page_Terminate();
?>
