<?php

// Global variable for table object
$kartu_scanlog = NULL;

//
// Table class for kartu_scanlog
//
class ckartu_scanlog extends cTable {
	var $ks_id;
	var $pegawai_id;
	var $dow;
	var $scan_tgl;
	var $scan_jam_1;
	var $scan_jam_2;
	var $scan_jam_3;
	var $scan_jam_4;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'kartu_scanlog';
		$this->TableName = 'kartu_scanlog';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`kartu_scanlog`";
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PHPExcel only)
		$this->ExportExcelPageSize = ""; // Page size (PHPExcel only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// ks_id
		$this->ks_id = new cField('kartu_scanlog', 'kartu_scanlog', 'x_ks_id', 'ks_id', '`ks_id`', '`ks_id`', 3, -1, FALSE, '`ks_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->ks_id->Sortable = TRUE; // Allow sort
		$this->ks_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['ks_id'] = &$this->ks_id;

		// pegawai_id
		$this->pegawai_id = new cField('kartu_scanlog', 'kartu_scanlog', 'x_pegawai_id', 'pegawai_id', '`pegawai_id`', '`pegawai_id`', 3, -1, FALSE, '`pegawai_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pegawai_id->Sortable = TRUE; // Allow sort
		$this->pegawai_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pegawai_id'] = &$this->pegawai_id;

		// dow
		$this->dow = new cField('kartu_scanlog', 'kartu_scanlog', 'x_dow', 'dow', '`dow`', '`dow`', 3, -1, FALSE, '`dow`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->dow->Sortable = TRUE; // Allow sort
		$this->dow->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['dow'] = &$this->dow;

		// scan_tgl
		$this->scan_tgl = new cField('kartu_scanlog', 'kartu_scanlog', 'x_scan_tgl', 'scan_tgl', '`scan_tgl`', ew_CastDateFieldForLike('`scan_tgl`', 0, "DB"), 133, 0, FALSE, '`scan_tgl`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->scan_tgl->Sortable = TRUE; // Allow sort
		$this->scan_tgl->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['scan_tgl'] = &$this->scan_tgl;

		// scan_jam_1
		$this->scan_jam_1 = new cField('kartu_scanlog', 'kartu_scanlog', 'x_scan_jam_1', 'scan_jam_1', '`scan_jam_1`', ew_CastDateFieldForLike('`scan_jam_1`', 0, "DB"), 134, -1, FALSE, '`scan_jam_1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->scan_jam_1->Sortable = TRUE; // Allow sort
		$this->scan_jam_1->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['scan_jam_1'] = &$this->scan_jam_1;

		// scan_jam_2
		$this->scan_jam_2 = new cField('kartu_scanlog', 'kartu_scanlog', 'x_scan_jam_2', 'scan_jam_2', '`scan_jam_2`', ew_CastDateFieldForLike('`scan_jam_2`', 0, "DB"), 134, -1, FALSE, '`scan_jam_2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->scan_jam_2->Sortable = TRUE; // Allow sort
		$this->scan_jam_2->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['scan_jam_2'] = &$this->scan_jam_2;

		// scan_jam_3
		$this->scan_jam_3 = new cField('kartu_scanlog', 'kartu_scanlog', 'x_scan_jam_3', 'scan_jam_3', '`scan_jam_3`', ew_CastDateFieldForLike('`scan_jam_3`', 0, "DB"), 134, -1, FALSE, '`scan_jam_3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->scan_jam_3->Sortable = TRUE; // Allow sort
		$this->scan_jam_3->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['scan_jam_3'] = &$this->scan_jam_3;

		// scan_jam_4
		$this->scan_jam_4 = new cField('kartu_scanlog', 'kartu_scanlog', 'x_scan_jam_4', 'scan_jam_4', '`scan_jam_4`', ew_CastDateFieldForLike('`scan_jam_4`', 0, "DB"), 134, -1, FALSE, '`scan_jam_4`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->scan_jam_4->Sortable = TRUE; // Allow sort
		$this->scan_jam_4->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['scan_jam_4'] = &$this->scan_jam_4;
	}

	// Set Field Visibility
	function SetFieldVisibility($fldparm) {
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Multiple column sort
	function UpdateSort(&$ofld, $ctrl) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			if ($ctrl) {
				$sOrderBy = $this->getSessionOrderBy();
				if (strpos($sOrderBy, $sSortField . " " . $sLastSort) !== FALSE) {
					$sOrderBy = str_replace($sSortField . " " . $sLastSort, $sSortField . " " . $sThisSort, $sOrderBy);
				} else {
					if ($sOrderBy <> "") $sOrderBy .= ", ";
					$sOrderBy .= $sSortField . " " . $sThisSort;
				}
				$this->setSessionOrderBy($sOrderBy); // Save to Session
			} else {
				$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
			}
		} else {
			if (!$ctrl) $ofld->setSort("");
		}
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`kartu_scanlog`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}
	var $_SqlSelect = "";

	function getSqlSelect() { // Select
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
		return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
		$this->_SqlSelect = $v;
	}
	var $_SqlWhere = "";

	function getSqlWhere() { // Where
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
		return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
		$this->_SqlWhere = $v;
	}
	var $_SqlGroupBy = "";

	function getSqlGroupBy() { // Group By
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
		return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
		$this->_SqlGroupBy = $v;
	}
	var $_SqlHaving = "";

	function getSqlHaving() { // Having
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
		return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
		$this->_SqlHaving = $v;
	}
	var $_SqlOrderBy = "";

	function getSqlOrderBy() { // Order By
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "";
	}

	function SqlOrderBy() { // For backward compatibility
		return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
		$this->_SqlOrderBy = $v;
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Check if User ID security allows view all
	function UserIDAllow($id = "") {
		$allow = EW_USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$this->Recordset_Selecting($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		$cnt = -1;
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') && preg_match("/^SELECT \* FROM/i", $sSql)) {
			$sSql = "SELECT COUNT(*) FROM" . preg_replace('/^SELECT\s([\s\S]+)?\*\sFROM/i', "", $sSql);
			$sOrderBy = $this->GetOrderBy();
			if (substr($sSql, strlen($sOrderBy) * -1) == $sOrderBy)
				$sSql = substr($sSql, 0, strlen($sSql) - strlen($sOrderBy)); // Remove ORDER BY clause
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);

		//$sSql = $this->SQL();
		$sSql = $this->GetSQL($this->CurrentFilter, "");
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			$conn = &$this->Connection();
			if ($rs = $conn->Execute($sSql)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		while (substr($names, -1) == ",")
			$names = substr($names, 0, -1);
		while (substr($values, -1) == ",")
			$values = substr($values, 0, -1);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	function Insert(&$rs) {
		$conn = &$this->Connection();
		$bInsert = $conn->Execute($this->InsertSQL($rs));
		if ($bInsert) {

			// Get insert id if necessary
			$this->ks_id->setDbValue($conn->Insert_ID());
			$rs['ks_id'] = $this->ks_id->DbValue;
		}
		return $bInsert;
	}

	// UPDATE statement
	function UpdateSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$sql .= $this->fields[$name]->FldExpression . "=";
			$sql .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		while (substr($sql, -1) == ",")
			$sql = substr($sql, 0, -1);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		ew_AddFilter($filter, $where);
		if ($filter <> "")	$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	function Update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE) {
		$conn = &$this->Connection();
		$bUpdate = $conn->Execute($this->UpdateSQL($rs, $where, $curfilter));
		return $bUpdate;
	}

	// DELETE statement
	function DeleteSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		if ($rs) {
			if (array_key_exists('ks_id', $rs))
				ew_AddFilter($where, ew_QuotedName('ks_id', $this->DBID) . '=' . ew_QuotedValue($rs['ks_id'], $this->ks_id->FldDataType, $this->DBID));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		ew_AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	function Delete(&$rs, $where = "", $curfilter = TRUE) {
		$conn = &$this->Connection();
		$bDelete = $conn->Execute($this->DeleteSQL($rs, $where, $curfilter));
		return $bDelete;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`ks_id` = @ks_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->ks_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@ks_id@", ew_AdjustSql($this->ks_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "kartu_scanloglist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "kartu_scanloglist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("kartu_scanlogview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("kartu_scanlogview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "kartu_scanlogadd.php?" . $this->UrlParm($parm);
		else
			$url = "kartu_scanlogadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("kartu_scanlogedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("kartu_scanlogadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("kartu_scanlogdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "ks_id:" . ew_VarToJson($this->ks_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->ks_id->CurrentValue)) {
			$sUrl .= "ks_id=" . urlencode($this->ks_id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort());
			return $this->AddMasterUrl(ew_CurrentPage() . "?" . $sUrlParm);
		} else {
			return "";
		}
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		global $EW_COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = ew_StripSlashes($_POST["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = ew_StripSlashes($_GET["key_m"]);
			$cnt = count($arKeys);
		} elseif (!empty($_GET) || !empty($_POST)) {
			$isPost = ew_IsHttpPost();
			if ($isPost && isset($_POST["ks_id"]))
				$arKeys[] = ew_StripSlashes($_POST["ks_id"]);
			elseif (isset($_GET["ks_id"]))
				$arKeys[] = ew_StripSlashes($_GET["ks_id"]);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->ks_id->CurrentValue = $key;
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {

		// Set up filter (SQL WHERE clause) and get return SQL
		//$this->CurrentFilter = $sFilter;
		//$sSql = $this->SQL();

		$sSql = $this->GetSQL($sFilter, "");
		$conn = &$this->Connection();
		$rs = $conn->Execute($sSql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->ks_id->setDbValue($rs->fields('ks_id'));
		$this->pegawai_id->setDbValue($rs->fields('pegawai_id'));
		$this->dow->setDbValue($rs->fields('dow'));
		$this->scan_tgl->setDbValue($rs->fields('scan_tgl'));
		$this->scan_jam_1->setDbValue($rs->fields('scan_jam_1'));
		$this->scan_jam_2->setDbValue($rs->fields('scan_jam_2'));
		$this->scan_jam_3->setDbValue($rs->fields('scan_jam_3'));
		$this->scan_jam_4->setDbValue($rs->fields('scan_jam_4'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// ks_id
		// pegawai_id
		// dow
		// scan_tgl
		// scan_jam_1
		// scan_jam_2
		// scan_jam_3
		// scan_jam_4
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

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// ks_id
		$this->ks_id->EditAttrs["class"] = "form-control";
		$this->ks_id->EditCustomAttributes = "";
		$this->ks_id->EditValue = $this->ks_id->CurrentValue;
		$this->ks_id->ViewCustomAttributes = "";

		// pegawai_id
		$this->pegawai_id->EditAttrs["class"] = "form-control";
		$this->pegawai_id->EditCustomAttributes = "";
		$this->pegawai_id->EditValue = $this->pegawai_id->CurrentValue;
		$this->pegawai_id->PlaceHolder = ew_RemoveHtml($this->pegawai_id->FldCaption());

		// dow
		$this->dow->EditAttrs["class"] = "form-control";
		$this->dow->EditCustomAttributes = "";
		$this->dow->EditValue = $this->dow->CurrentValue;
		$this->dow->PlaceHolder = ew_RemoveHtml($this->dow->FldCaption());

		// scan_tgl
		$this->scan_tgl->EditAttrs["class"] = "form-control";
		$this->scan_tgl->EditCustomAttributes = "";
		$this->scan_tgl->EditValue = ew_FormatDateTime($this->scan_tgl->CurrentValue, 8);
		$this->scan_tgl->PlaceHolder = ew_RemoveHtml($this->scan_tgl->FldCaption());

		// scan_jam_1
		$this->scan_jam_1->EditAttrs["class"] = "form-control";
		$this->scan_jam_1->EditCustomAttributes = "";
		$this->scan_jam_1->EditValue = $this->scan_jam_1->CurrentValue;
		$this->scan_jam_1->PlaceHolder = ew_RemoveHtml($this->scan_jam_1->FldCaption());

		// scan_jam_2
		$this->scan_jam_2->EditAttrs["class"] = "form-control";
		$this->scan_jam_2->EditCustomAttributes = "";
		$this->scan_jam_2->EditValue = $this->scan_jam_2->CurrentValue;
		$this->scan_jam_2->PlaceHolder = ew_RemoveHtml($this->scan_jam_2->FldCaption());

		// scan_jam_3
		$this->scan_jam_3->EditAttrs["class"] = "form-control";
		$this->scan_jam_3->EditCustomAttributes = "";
		$this->scan_jam_3->EditValue = $this->scan_jam_3->CurrentValue;
		$this->scan_jam_3->PlaceHolder = ew_RemoveHtml($this->scan_jam_3->FldCaption());

		// scan_jam_4
		$this->scan_jam_4->EditAttrs["class"] = "form-control";
		$this->scan_jam_4->EditCustomAttributes = "";
		$this->scan_jam_4->EditValue = $this->scan_jam_4->CurrentValue;
		$this->scan_jam_4->PlaceHolder = ew_RemoveHtml($this->scan_jam_4->FldCaption());

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {

		// Call Row Rendered event
		$this->Row_Rendered();
	}
	var $ExportDoc;

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;
		if (!$Doc->ExportCustom) {

			// Write header
			$Doc->ExportTableHeader();
			if ($Doc->Horizontal) { // Horizontal format, write header
				$Doc->BeginExportRow();
				if ($ExportPageType == "view") {
					if ($this->ks_id->Exportable) $Doc->ExportCaption($this->ks_id);
					if ($this->pegawai_id->Exportable) $Doc->ExportCaption($this->pegawai_id);
					if ($this->dow->Exportable) $Doc->ExportCaption($this->dow);
					if ($this->scan_tgl->Exportable) $Doc->ExportCaption($this->scan_tgl);
					if ($this->scan_jam_1->Exportable) $Doc->ExportCaption($this->scan_jam_1);
					if ($this->scan_jam_2->Exportable) $Doc->ExportCaption($this->scan_jam_2);
					if ($this->scan_jam_3->Exportable) $Doc->ExportCaption($this->scan_jam_3);
					if ($this->scan_jam_4->Exportable) $Doc->ExportCaption($this->scan_jam_4);
				} else {
					if ($this->ks_id->Exportable) $Doc->ExportCaption($this->ks_id);
					if ($this->pegawai_id->Exportable) $Doc->ExportCaption($this->pegawai_id);
					if ($this->dow->Exportable) $Doc->ExportCaption($this->dow);
					if ($this->scan_tgl->Exportable) $Doc->ExportCaption($this->scan_tgl);
					if ($this->scan_jam_1->Exportable) $Doc->ExportCaption($this->scan_jam_1);
					if ($this->scan_jam_2->Exportable) $Doc->ExportCaption($this->scan_jam_2);
					if ($this->scan_jam_3->Exportable) $Doc->ExportCaption($this->scan_jam_3);
					if ($this->scan_jam_4->Exportable) $Doc->ExportCaption($this->scan_jam_4);
				}
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if (!$Doc->ExportCustom) {
					$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
					if ($ExportPageType == "view") {
						if ($this->ks_id->Exportable) $Doc->ExportField($this->ks_id);
						if ($this->pegawai_id->Exportable) $Doc->ExportField($this->pegawai_id);
						if ($this->dow->Exportable) $Doc->ExportField($this->dow);
						if ($this->scan_tgl->Exportable) $Doc->ExportField($this->scan_tgl);
						if ($this->scan_jam_1->Exportable) $Doc->ExportField($this->scan_jam_1);
						if ($this->scan_jam_2->Exportable) $Doc->ExportField($this->scan_jam_2);
						if ($this->scan_jam_3->Exportable) $Doc->ExportField($this->scan_jam_3);
						if ($this->scan_jam_4->Exportable) $Doc->ExportField($this->scan_jam_4);
					} else {
						if ($this->ks_id->Exportable) $Doc->ExportField($this->ks_id);
						if ($this->pegawai_id->Exportable) $Doc->ExportField($this->pegawai_id);
						if ($this->dow->Exportable) $Doc->ExportField($this->dow);
						if ($this->scan_tgl->Exportable) $Doc->ExportField($this->scan_tgl);
						if ($this->scan_jam_1->Exportable) $Doc->ExportField($this->scan_jam_1);
						if ($this->scan_jam_2->Exportable) $Doc->ExportField($this->scan_jam_2);
						if ($this->scan_jam_3->Exportable) $Doc->ExportField($this->scan_jam_3);
						if ($this->scan_jam_4->Exportable) $Doc->ExportField($this->scan_jam_4);
					}
					$Doc->EndExportRow();
				}
			}

			// Call Row Export server event
			if ($Doc->ExportCustom)
				$this->Row_Export($Recordset->fields);
			$Recordset->MoveNext();
		}
		if (!$Doc->ExportCustom) {
			$Doc->ExportTableFooter();
		}
	}

	// Get auto fill value
	function GetAutoFill($id, $val) {
		$rsarr = array();
		$rowcnt = 0;

		// Output
		if (is_array($rsarr) && $rowcnt > 0) {
			$fldcnt = count($rsarr[0]);
			for ($i = 0; $i < $rowcnt; $i++) {
				for ($j = 0; $j < $fldcnt; $j++) {
					$str = strval($rsarr[$i][$j]);
					$str = ew_ConvertToUtf8($str);
					if (isset($post["keepCRLF"])) {
						$str = str_replace(array("\r", "\n"), array("\\r", "\\n"), $str);
					} else {
						$str = str_replace(array("\r", "\n"), array(" ", " "), $str);
					}
					$rsarr[$i][$j] = $str;
				}
			}
			return ew_ArrayToJson($rsarr);
		} else {
			return FALSE;
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->FldName, $fld->LookupFilters, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
