<?php

// Global variable for table object
$pegawai_default = NULL;

//
// Table class for pegawai_default
//
class cpegawai_default extends cTable {
	var $AuditTrailOnAdd = TRUE;
	var $AuditTrailOnEdit = TRUE;
	var $AuditTrailOnDelete = TRUE;
	var $AuditTrailOnView = FALSE;
	var $AuditTrailOnViewData = FALSE;
	var $AuditTrailOnSearch = FALSE;
	var $pd_id;
	var $pegawai_id;
	var $dept_id;
	var $f0m1;
	var $f0k1;
	var $f1m1;
	var $f1k1;
	var $f2m1;
	var $f2k1;
	var $f3m1;
	var $f3k1;
	var $f4m1;
	var $f4k1;
	var $f5m1;
	var $f5k1;
	var $f6m1;
	var $f6k1;
	var $f0m2;
	var $f0k2;
	var $f1m2;
	var $f1k2;
	var $f2m2;
	var $f2k2;
	var $f3m2;
	var $f3k2;
	var $f4m2;
	var $f4k2;
	var $f5m2;
	var $f5k2;
	var $f6m2;
	var $f6k2;
	var $f0m3;
	var $f0k3;
	var $f1m3;
	var $f1k3;
	var $f2m3;
	var $f2k3;
	var $f3m3;
	var $f3k3;
	var $f4m3;
	var $f4k3;
	var $f5m3;
	var $f5k3;
	var $f6m3;
	var $f6k3;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'pegawai_default';
		$this->TableName = 'pegawai_default';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`pegawai_default`";
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

		// pd_id
		$this->pd_id = new cField('pegawai_default', 'pegawai_default', 'x_pd_id', 'pd_id', '`pd_id`', '`pd_id`', 3, -1, FALSE, '`pd_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->pd_id->Sortable = TRUE; // Allow sort
		$this->pd_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pd_id'] = &$this->pd_id;

		// pegawai_id
		$this->pegawai_id = new cField('pegawai_default', 'pegawai_default', 'x_pegawai_id', 'pegawai_id', '`pegawai_id`', '`pegawai_id`', 3, -1, FALSE, '`EV__pegawai_id`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->pegawai_id->Sortable = TRUE; // Allow sort
		$this->pegawai_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pegawai_id'] = &$this->pegawai_id;

		// dept_id
		$this->dept_id = new cField('pegawai_default', 'pegawai_default', 'x_dept_id', 'dept_id', '`dept_id`', '`dept_id`', 3, -1, FALSE, '`EV__dept_id`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->dept_id->Sortable = TRUE; // Allow sort
		$this->dept_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['dept_id'] = &$this->dept_id;

		// f0m1
		$this->f0m1 = new cField('pegawai_default', 'pegawai_default', 'x_f0m1', 'f0m1', '`f0m1`', '`f0m1`', 200, -1, FALSE, '`f0m1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f0m1->Sortable = TRUE; // Allow sort
		$this->fields['f0m1'] = &$this->f0m1;

		// f0k1
		$this->f0k1 = new cField('pegawai_default', 'pegawai_default', 'x_f0k1', 'f0k1', '`f0k1`', '`f0k1`', 200, -1, FALSE, '`f0k1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f0k1->Sortable = TRUE; // Allow sort
		$this->fields['f0k1'] = &$this->f0k1;

		// f1m1
		$this->f1m1 = new cField('pegawai_default', 'pegawai_default', 'x_f1m1', 'f1m1', '`f1m1`', '`f1m1`', 200, -1, FALSE, '`f1m1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f1m1->Sortable = TRUE; // Allow sort
		$this->fields['f1m1'] = &$this->f1m1;

		// f1k1
		$this->f1k1 = new cField('pegawai_default', 'pegawai_default', 'x_f1k1', 'f1k1', '`f1k1`', '`f1k1`', 200, -1, FALSE, '`f1k1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f1k1->Sortable = TRUE; // Allow sort
		$this->fields['f1k1'] = &$this->f1k1;

		// f2m1
		$this->f2m1 = new cField('pegawai_default', 'pegawai_default', 'x_f2m1', 'f2m1', '`f2m1`', '`f2m1`', 200, -1, FALSE, '`f2m1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f2m1->Sortable = TRUE; // Allow sort
		$this->fields['f2m1'] = &$this->f2m1;

		// f2k1
		$this->f2k1 = new cField('pegawai_default', 'pegawai_default', 'x_f2k1', 'f2k1', '`f2k1`', '`f2k1`', 200, -1, FALSE, '`f2k1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f2k1->Sortable = TRUE; // Allow sort
		$this->fields['f2k1'] = &$this->f2k1;

		// f3m1
		$this->f3m1 = new cField('pegawai_default', 'pegawai_default', 'x_f3m1', 'f3m1', '`f3m1`', '`f3m1`', 200, -1, FALSE, '`f3m1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f3m1->Sortable = TRUE; // Allow sort
		$this->fields['f3m1'] = &$this->f3m1;

		// f3k1
		$this->f3k1 = new cField('pegawai_default', 'pegawai_default', 'x_f3k1', 'f3k1', '`f3k1`', '`f3k1`', 200, -1, FALSE, '`f3k1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f3k1->Sortable = TRUE; // Allow sort
		$this->fields['f3k1'] = &$this->f3k1;

		// f4m1
		$this->f4m1 = new cField('pegawai_default', 'pegawai_default', 'x_f4m1', 'f4m1', '`f4m1`', '`f4m1`', 200, -1, FALSE, '`f4m1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f4m1->Sortable = TRUE; // Allow sort
		$this->fields['f4m1'] = &$this->f4m1;

		// f4k1
		$this->f4k1 = new cField('pegawai_default', 'pegawai_default', 'x_f4k1', 'f4k1', '`f4k1`', '`f4k1`', 200, -1, FALSE, '`f4k1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f4k1->Sortable = TRUE; // Allow sort
		$this->fields['f4k1'] = &$this->f4k1;

		// f5m1
		$this->f5m1 = new cField('pegawai_default', 'pegawai_default', 'x_f5m1', 'f5m1', '`f5m1`', '`f5m1`', 200, -1, FALSE, '`f5m1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f5m1->Sortable = TRUE; // Allow sort
		$this->fields['f5m1'] = &$this->f5m1;

		// f5k1
		$this->f5k1 = new cField('pegawai_default', 'pegawai_default', 'x_f5k1', 'f5k1', '`f5k1`', '`f5k1`', 200, -1, FALSE, '`f5k1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f5k1->Sortable = TRUE; // Allow sort
		$this->fields['f5k1'] = &$this->f5k1;

		// f6m1
		$this->f6m1 = new cField('pegawai_default', 'pegawai_default', 'x_f6m1', 'f6m1', '`f6m1`', '`f6m1`', 200, -1, FALSE, '`f6m1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f6m1->Sortable = TRUE; // Allow sort
		$this->fields['f6m1'] = &$this->f6m1;

		// f6k1
		$this->f6k1 = new cField('pegawai_default', 'pegawai_default', 'x_f6k1', 'f6k1', '`f6k1`', '`f6k1`', 200, -1, FALSE, '`f6k1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f6k1->Sortable = TRUE; // Allow sort
		$this->fields['f6k1'] = &$this->f6k1;

		// f0m2
		$this->f0m2 = new cField('pegawai_default', 'pegawai_default', 'x_f0m2', 'f0m2', '`f0m2`', '`f0m2`', 200, -1, FALSE, '`f0m2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f0m2->Sortable = TRUE; // Allow sort
		$this->fields['f0m2'] = &$this->f0m2;

		// f0k2
		$this->f0k2 = new cField('pegawai_default', 'pegawai_default', 'x_f0k2', 'f0k2', '`f0k2`', '`f0k2`', 200, -1, FALSE, '`f0k2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f0k2->Sortable = TRUE; // Allow sort
		$this->fields['f0k2'] = &$this->f0k2;

		// f1m2
		$this->f1m2 = new cField('pegawai_default', 'pegawai_default', 'x_f1m2', 'f1m2', '`f1m2`', '`f1m2`', 200, -1, FALSE, '`f1m2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f1m2->Sortable = TRUE; // Allow sort
		$this->fields['f1m2'] = &$this->f1m2;

		// f1k2
		$this->f1k2 = new cField('pegawai_default', 'pegawai_default', 'x_f1k2', 'f1k2', '`f1k2`', '`f1k2`', 200, -1, FALSE, '`f1k2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f1k2->Sortable = TRUE; // Allow sort
		$this->fields['f1k2'] = &$this->f1k2;

		// f2m2
		$this->f2m2 = new cField('pegawai_default', 'pegawai_default', 'x_f2m2', 'f2m2', '`f2m2`', '`f2m2`', 200, -1, FALSE, '`f2m2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f2m2->Sortable = TRUE; // Allow sort
		$this->fields['f2m2'] = &$this->f2m2;

		// f2k2
		$this->f2k2 = new cField('pegawai_default', 'pegawai_default', 'x_f2k2', 'f2k2', '`f2k2`', '`f2k2`', 200, -1, FALSE, '`f2k2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f2k2->Sortable = TRUE; // Allow sort
		$this->fields['f2k2'] = &$this->f2k2;

		// f3m2
		$this->f3m2 = new cField('pegawai_default', 'pegawai_default', 'x_f3m2', 'f3m2', '`f3m2`', '`f3m2`', 200, -1, FALSE, '`f3m2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f3m2->Sortable = TRUE; // Allow sort
		$this->fields['f3m2'] = &$this->f3m2;

		// f3k2
		$this->f3k2 = new cField('pegawai_default', 'pegawai_default', 'x_f3k2', 'f3k2', '`f3k2`', '`f3k2`', 200, -1, FALSE, '`f3k2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f3k2->Sortable = TRUE; // Allow sort
		$this->fields['f3k2'] = &$this->f3k2;

		// f4m2
		$this->f4m2 = new cField('pegawai_default', 'pegawai_default', 'x_f4m2', 'f4m2', '`f4m2`', '`f4m2`', 200, -1, FALSE, '`f4m2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f4m2->Sortable = TRUE; // Allow sort
		$this->fields['f4m2'] = &$this->f4m2;

		// f4k2
		$this->f4k2 = new cField('pegawai_default', 'pegawai_default', 'x_f4k2', 'f4k2', '`f4k2`', '`f4k2`', 200, -1, FALSE, '`f4k2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f4k2->Sortable = TRUE; // Allow sort
		$this->fields['f4k2'] = &$this->f4k2;

		// f5m2
		$this->f5m2 = new cField('pegawai_default', 'pegawai_default', 'x_f5m2', 'f5m2', '`f5m2`', '`f5m2`', 200, -1, FALSE, '`f5m2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f5m2->Sortable = TRUE; // Allow sort
		$this->fields['f5m2'] = &$this->f5m2;

		// f5k2
		$this->f5k2 = new cField('pegawai_default', 'pegawai_default', 'x_f5k2', 'f5k2', '`f5k2`', '`f5k2`', 200, -1, FALSE, '`f5k2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f5k2->Sortable = TRUE; // Allow sort
		$this->fields['f5k2'] = &$this->f5k2;

		// f6m2
		$this->f6m2 = new cField('pegawai_default', 'pegawai_default', 'x_f6m2', 'f6m2', '`f6m2`', '`f6m2`', 200, -1, FALSE, '`f6m2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f6m2->Sortable = TRUE; // Allow sort
		$this->fields['f6m2'] = &$this->f6m2;

		// f6k2
		$this->f6k2 = new cField('pegawai_default', 'pegawai_default', 'x_f6k2', 'f6k2', '`f6k2`', '`f6k2`', 200, -1, FALSE, '`f6k2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f6k2->Sortable = TRUE; // Allow sort
		$this->fields['f6k2'] = &$this->f6k2;

		// f0m3
		$this->f0m3 = new cField('pegawai_default', 'pegawai_default', 'x_f0m3', 'f0m3', '`f0m3`', '`f0m3`', 200, -1, FALSE, '`f0m3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f0m3->Sortable = TRUE; // Allow sort
		$this->fields['f0m3'] = &$this->f0m3;

		// f0k3
		$this->f0k3 = new cField('pegawai_default', 'pegawai_default', 'x_f0k3', 'f0k3', '`f0k3`', '`f0k3`', 200, -1, FALSE, '`f0k3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f0k3->Sortable = TRUE; // Allow sort
		$this->fields['f0k3'] = &$this->f0k3;

		// f1m3
		$this->f1m3 = new cField('pegawai_default', 'pegawai_default', 'x_f1m3', 'f1m3', '`f1m3`', '`f1m3`', 200, -1, FALSE, '`f1m3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f1m3->Sortable = TRUE; // Allow sort
		$this->fields['f1m3'] = &$this->f1m3;

		// f1k3
		$this->f1k3 = new cField('pegawai_default', 'pegawai_default', 'x_f1k3', 'f1k3', '`f1k3`', '`f1k3`', 200, -1, FALSE, '`f1k3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f1k3->Sortable = TRUE; // Allow sort
		$this->fields['f1k3'] = &$this->f1k3;

		// f2m3
		$this->f2m3 = new cField('pegawai_default', 'pegawai_default', 'x_f2m3', 'f2m3', '`f2m3`', '`f2m3`', 200, -1, FALSE, '`f2m3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f2m3->Sortable = TRUE; // Allow sort
		$this->fields['f2m3'] = &$this->f2m3;

		// f2k3
		$this->f2k3 = new cField('pegawai_default', 'pegawai_default', 'x_f2k3', 'f2k3', '`f2k3`', '`f2k3`', 200, -1, FALSE, '`f2k3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f2k3->Sortable = TRUE; // Allow sort
		$this->fields['f2k3'] = &$this->f2k3;

		// f3m3
		$this->f3m3 = new cField('pegawai_default', 'pegawai_default', 'x_f3m3', 'f3m3', '`f3m3`', '`f3m3`', 200, -1, FALSE, '`f3m3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f3m3->Sortable = TRUE; // Allow sort
		$this->fields['f3m3'] = &$this->f3m3;

		// f3k3
		$this->f3k3 = new cField('pegawai_default', 'pegawai_default', 'x_f3k3', 'f3k3', '`f3k3`', '`f3k3`', 200, -1, FALSE, '`f3k3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f3k3->Sortable = TRUE; // Allow sort
		$this->fields['f3k3'] = &$this->f3k3;

		// f4m3
		$this->f4m3 = new cField('pegawai_default', 'pegawai_default', 'x_f4m3', 'f4m3', '`f4m3`', '`f4m3`', 200, -1, FALSE, '`f4m3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f4m3->Sortable = TRUE; // Allow sort
		$this->fields['f4m3'] = &$this->f4m3;

		// f4k3
		$this->f4k3 = new cField('pegawai_default', 'pegawai_default', 'x_f4k3', 'f4k3', '`f4k3`', '`f4k3`', 200, -1, FALSE, '`f4k3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f4k3->Sortable = TRUE; // Allow sort
		$this->fields['f4k3'] = &$this->f4k3;

		// f5m3
		$this->f5m3 = new cField('pegawai_default', 'pegawai_default', 'x_f5m3', 'f5m3', '`f5m3`', '`f5m3`', 200, -1, FALSE, '`f5m3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f5m3->Sortable = TRUE; // Allow sort
		$this->fields['f5m3'] = &$this->f5m3;

		// f5k3
		$this->f5k3 = new cField('pegawai_default', 'pegawai_default', 'x_f5k3', 'f5k3', '`f5k3`', '`f5k3`', 200, -1, FALSE, '`f5k3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f5k3->Sortable = TRUE; // Allow sort
		$this->fields['f5k3'] = &$this->f5k3;

		// f6m3
		$this->f6m3 = new cField('pegawai_default', 'pegawai_default', 'x_f6m3', 'f6m3', '`f6m3`', '`f6m3`', 200, -1, FALSE, '`f6m3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f6m3->Sortable = TRUE; // Allow sort
		$this->fields['f6m3'] = &$this->f6m3;

		// f6k3
		$this->f6k3 = new cField('pegawai_default', 'pegawai_default', 'x_f6k3', 'f6k3', '`f6k3`', '`f6k3`', 200, -1, FALSE, '`f6k3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f6k3->Sortable = TRUE; // Allow sort
		$this->fields['f6k3'] = &$this->f6k3;
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
			$sSortFieldList = ($ofld->FldVirtualExpression <> "") ? $ofld->FldVirtualExpression : $sSortField;
			if ($ctrl) {
				$sOrderByList = $this->getSessionOrderByList();
				if (strpos($sOrderByList, $sSortFieldList . " " . $sLastSort) !== FALSE) {
					$sOrderByList = str_replace($sSortFieldList . " " . $sLastSort, $sSortFieldList . " " . $sThisSort, $sOrderByList);
				} else {
					if ($sOrderByList <> "") $sOrderByList .= ", ";
					$sOrderByList .= $sSortFieldList . " " . $sThisSort;
				}
				$this->setSessionOrderByList($sOrderByList); // Save to Session
			} else {
				$this->setSessionOrderByList($sSortFieldList . " " . $sThisSort); // Save to Session
			}
		} else {
			if (!$ctrl) $ofld->setSort("");
		}
	}

	// Session ORDER BY for List page
	function getSessionOrderByList() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY_LIST];
	}

	function setSessionOrderByList($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY_LIST] = $v;
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`pegawai_default`";
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
	var $_SqlSelectList = "";

	function getSqlSelectList() { // Select for List page
		$select = "";
		$select = "SELECT * FROM (" .
			"SELECT *, (SELECT `pegawai_nama` FROM `pegawai` `EW_TMP_LOOKUPTABLE` WHERE `EW_TMP_LOOKUPTABLE`.`pegawai_id` = `pegawai_default`.`pegawai_id` LIMIT 1) AS `EV__pegawai_id`, (SELECT `pembagian2_nama` FROM `pembagian2` `EW_TMP_LOOKUPTABLE` WHERE `EW_TMP_LOOKUPTABLE`.`pembagian2_id` = `pegawai_default`.`dept_id` LIMIT 1) AS `EV__dept_id` FROM `pegawai_default`" .
			") `EW_TMP_TABLE`";
		return ($this->_SqlSelectList <> "") ? $this->_SqlSelectList : $select;
	}

	function SqlSelectList() { // For backward compatibility
		return $this->getSqlSelectList();
	}

	function setSqlSelectList($v) {
		$this->_SqlSelectList = $v;
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
		if ($this->UseVirtualFields()) {
			$sSort = $this->getSessionOrderByList();
			return ew_BuildSelectSql($this->getSqlSelectList(), $this->getSqlWhere(), $this->getSqlGroupBy(),
				$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
		} else {
			$sSort = $this->getSessionOrderBy();
			return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(),
				$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
		}
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = ($this->UseVirtualFields()) ? $this->getSessionOrderByList() : $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sSort);
	}

	// Check if virtual fields is used in SQL
	function UseVirtualFields() {
		$sWhere = $this->getSessionWhere();
		$sOrderBy = $this->getSessionOrderByList();
		if ($sWhere <> "")
			$sWhere = " " . str_replace(array("(",")"), array("",""), $sWhere) . " ";
		if ($sOrderBy <> "")
			$sOrderBy = " " . str_replace(array("(",")"), array("",""), $sOrderBy) . " ";
		if ($this->pegawai_id->AdvancedSearch->SearchValue <> "" ||
			$this->pegawai_id->AdvancedSearch->SearchValue2 <> "" ||
			strpos($sWhere, " " . $this->pegawai_id->FldVirtualExpression . " ") !== FALSE)
			return TRUE;
		if (strpos($sOrderBy, " " . $this->pegawai_id->FldVirtualExpression . " ") !== FALSE)
			return TRUE;
		if ($this->dept_id->AdvancedSearch->SearchValue <> "" ||
			$this->dept_id->AdvancedSearch->SearchValue2 <> "" ||
			strpos($sWhere, " " . $this->dept_id->FldVirtualExpression . " ") !== FALSE)
			return TRUE;
		if (strpos($sOrderBy, " " . $this->dept_id->FldVirtualExpression . " ") !== FALSE)
			return TRUE;
		return FALSE;
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
			$this->pd_id->setDbValue($conn->Insert_ID());
			$rs['pd_id'] = $this->pd_id->DbValue;
			if ($this->AuditTrailOnAdd)
				$this->WriteAuditTrailOnAdd($rs);
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
		if ($bUpdate && $this->AuditTrailOnEdit) {
			$rsaudit = $rs;
			$fldname = 'pd_id';
			if (!array_key_exists($fldname, $rsaudit)) $rsaudit[$fldname] = $rsold[$fldname];
			$this->WriteAuditTrailOnEdit($rsaudit, $rsold);
		}
		return $bUpdate;
	}

	// DELETE statement
	function DeleteSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		if ($rs) {
			if (array_key_exists('pd_id', $rs))
				ew_AddFilter($where, ew_QuotedName('pd_id', $this->DBID) . '=' . ew_QuotedValue($rs['pd_id'], $this->pd_id->FldDataType, $this->DBID));
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
		if ($bDelete && $this->AuditTrailOnDelete)
			$this->WriteAuditTrailOnDelete($rs);
		return $bDelete;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`pd_id` = @pd_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->pd_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@pd_id@", ew_AdjustSql($this->pd_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "pegawai_defaultlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "pegawai_defaultlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("pegawai_defaultview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("pegawai_defaultview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "pegawai_defaultadd.php?" . $this->UrlParm($parm);
		else
			$url = "pegawai_defaultadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("pegawai_defaultedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("pegawai_defaultadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("pegawai_defaultdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "pd_id:" . ew_VarToJson($this->pd_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->pd_id->CurrentValue)) {
			$sUrl .= "pd_id=" . urlencode($this->pd_id->CurrentValue);
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
			if ($isPost && isset($_POST["pd_id"]))
				$arKeys[] = ew_StripSlashes($_POST["pd_id"]);
			elseif (isset($_GET["pd_id"]))
				$arKeys[] = ew_StripSlashes($_GET["pd_id"]);
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
			$this->pd_id->CurrentValue = $key;
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
		$this->pd_id->setDbValue($rs->fields('pd_id'));
		$this->pegawai_id->setDbValue($rs->fields('pegawai_id'));
		$this->dept_id->setDbValue($rs->fields('dept_id'));
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

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
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

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// pd_id
		$this->pd_id->EditAttrs["class"] = "form-control";
		$this->pd_id->EditCustomAttributes = "";
		$this->pd_id->EditValue = $this->pd_id->CurrentValue;
		$this->pd_id->ViewCustomAttributes = "";

		// pegawai_id
		$this->pegawai_id->EditAttrs["class"] = "form-control";
		$this->pegawai_id->EditCustomAttributes = "";
		$this->pegawai_id->EditValue = $this->pegawai_id->CurrentValue;
		$this->pegawai_id->PlaceHolder = ew_RemoveHtml($this->pegawai_id->FldCaption());

		// dept_id
		$this->dept_id->EditAttrs["class"] = "form-control";
		$this->dept_id->EditCustomAttributes = "";
		$this->dept_id->EditValue = $this->dept_id->CurrentValue;
		$this->dept_id->PlaceHolder = ew_RemoveHtml($this->dept_id->FldCaption());

		// f0m1
		$this->f0m1->EditAttrs["class"] = "form-control";
		$this->f0m1->EditCustomAttributes = "";
		$this->f0m1->EditValue = $this->f0m1->CurrentValue;
		$this->f0m1->PlaceHolder = ew_RemoveHtml($this->f0m1->FldCaption());

		// f0k1
		$this->f0k1->EditAttrs["class"] = "form-control";
		$this->f0k1->EditCustomAttributes = "";
		$this->f0k1->EditValue = $this->f0k1->CurrentValue;
		$this->f0k1->PlaceHolder = ew_RemoveHtml($this->f0k1->FldCaption());

		// f1m1
		$this->f1m1->EditAttrs["class"] = "form-control";
		$this->f1m1->EditCustomAttributes = "";
		$this->f1m1->EditValue = $this->f1m1->CurrentValue;
		$this->f1m1->PlaceHolder = ew_RemoveHtml($this->f1m1->FldCaption());

		// f1k1
		$this->f1k1->EditAttrs["class"] = "form-control";
		$this->f1k1->EditCustomAttributes = "";
		$this->f1k1->EditValue = $this->f1k1->CurrentValue;
		$this->f1k1->PlaceHolder = ew_RemoveHtml($this->f1k1->FldCaption());

		// f2m1
		$this->f2m1->EditAttrs["class"] = "form-control";
		$this->f2m1->EditCustomAttributes = "";
		$this->f2m1->EditValue = $this->f2m1->CurrentValue;
		$this->f2m1->PlaceHolder = ew_RemoveHtml($this->f2m1->FldCaption());

		// f2k1
		$this->f2k1->EditAttrs["class"] = "form-control";
		$this->f2k1->EditCustomAttributes = "";
		$this->f2k1->EditValue = $this->f2k1->CurrentValue;
		$this->f2k1->PlaceHolder = ew_RemoveHtml($this->f2k1->FldCaption());

		// f3m1
		$this->f3m1->EditAttrs["class"] = "form-control";
		$this->f3m1->EditCustomAttributes = "";
		$this->f3m1->EditValue = $this->f3m1->CurrentValue;
		$this->f3m1->PlaceHolder = ew_RemoveHtml($this->f3m1->FldCaption());

		// f3k1
		$this->f3k1->EditAttrs["class"] = "form-control";
		$this->f3k1->EditCustomAttributes = "";
		$this->f3k1->EditValue = $this->f3k1->CurrentValue;
		$this->f3k1->PlaceHolder = ew_RemoveHtml($this->f3k1->FldCaption());

		// f4m1
		$this->f4m1->EditAttrs["class"] = "form-control";
		$this->f4m1->EditCustomAttributes = "";
		$this->f4m1->EditValue = $this->f4m1->CurrentValue;
		$this->f4m1->PlaceHolder = ew_RemoveHtml($this->f4m1->FldCaption());

		// f4k1
		$this->f4k1->EditAttrs["class"] = "form-control";
		$this->f4k1->EditCustomAttributes = "";
		$this->f4k1->EditValue = $this->f4k1->CurrentValue;
		$this->f4k1->PlaceHolder = ew_RemoveHtml($this->f4k1->FldCaption());

		// f5m1
		$this->f5m1->EditAttrs["class"] = "form-control";
		$this->f5m1->EditCustomAttributes = "";
		$this->f5m1->EditValue = $this->f5m1->CurrentValue;
		$this->f5m1->PlaceHolder = ew_RemoveHtml($this->f5m1->FldCaption());

		// f5k1
		$this->f5k1->EditAttrs["class"] = "form-control";
		$this->f5k1->EditCustomAttributes = "";
		$this->f5k1->EditValue = $this->f5k1->CurrentValue;
		$this->f5k1->PlaceHolder = ew_RemoveHtml($this->f5k1->FldCaption());

		// f6m1
		$this->f6m1->EditAttrs["class"] = "form-control";
		$this->f6m1->EditCustomAttributes = "";
		$this->f6m1->EditValue = $this->f6m1->CurrentValue;
		$this->f6m1->PlaceHolder = ew_RemoveHtml($this->f6m1->FldCaption());

		// f6k1
		$this->f6k1->EditAttrs["class"] = "form-control";
		$this->f6k1->EditCustomAttributes = "";
		$this->f6k1->EditValue = $this->f6k1->CurrentValue;
		$this->f6k1->PlaceHolder = ew_RemoveHtml($this->f6k1->FldCaption());

		// f0m2
		$this->f0m2->EditAttrs["class"] = "form-control";
		$this->f0m2->EditCustomAttributes = "";
		$this->f0m2->EditValue = $this->f0m2->CurrentValue;
		$this->f0m2->PlaceHolder = ew_RemoveHtml($this->f0m2->FldCaption());

		// f0k2
		$this->f0k2->EditAttrs["class"] = "form-control";
		$this->f0k2->EditCustomAttributes = "";
		$this->f0k2->EditValue = $this->f0k2->CurrentValue;
		$this->f0k2->PlaceHolder = ew_RemoveHtml($this->f0k2->FldCaption());

		// f1m2
		$this->f1m2->EditAttrs["class"] = "form-control";
		$this->f1m2->EditCustomAttributes = "";
		$this->f1m2->EditValue = $this->f1m2->CurrentValue;
		$this->f1m2->PlaceHolder = ew_RemoveHtml($this->f1m2->FldCaption());

		// f1k2
		$this->f1k2->EditAttrs["class"] = "form-control";
		$this->f1k2->EditCustomAttributes = "";
		$this->f1k2->EditValue = $this->f1k2->CurrentValue;
		$this->f1k2->PlaceHolder = ew_RemoveHtml($this->f1k2->FldCaption());

		// f2m2
		$this->f2m2->EditAttrs["class"] = "form-control";
		$this->f2m2->EditCustomAttributes = "";
		$this->f2m2->EditValue = $this->f2m2->CurrentValue;
		$this->f2m2->PlaceHolder = ew_RemoveHtml($this->f2m2->FldCaption());

		// f2k2
		$this->f2k2->EditAttrs["class"] = "form-control";
		$this->f2k2->EditCustomAttributes = "";
		$this->f2k2->EditValue = $this->f2k2->CurrentValue;
		$this->f2k2->PlaceHolder = ew_RemoveHtml($this->f2k2->FldCaption());

		// f3m2
		$this->f3m2->EditAttrs["class"] = "form-control";
		$this->f3m2->EditCustomAttributes = "";
		$this->f3m2->EditValue = $this->f3m2->CurrentValue;
		$this->f3m2->PlaceHolder = ew_RemoveHtml($this->f3m2->FldCaption());

		// f3k2
		$this->f3k2->EditAttrs["class"] = "form-control";
		$this->f3k2->EditCustomAttributes = "";
		$this->f3k2->EditValue = $this->f3k2->CurrentValue;
		$this->f3k2->PlaceHolder = ew_RemoveHtml($this->f3k2->FldCaption());

		// f4m2
		$this->f4m2->EditAttrs["class"] = "form-control";
		$this->f4m2->EditCustomAttributes = "";
		$this->f4m2->EditValue = $this->f4m2->CurrentValue;
		$this->f4m2->PlaceHolder = ew_RemoveHtml($this->f4m2->FldCaption());

		// f4k2
		$this->f4k2->EditAttrs["class"] = "form-control";
		$this->f4k2->EditCustomAttributes = "";
		$this->f4k2->EditValue = $this->f4k2->CurrentValue;
		$this->f4k2->PlaceHolder = ew_RemoveHtml($this->f4k2->FldCaption());

		// f5m2
		$this->f5m2->EditAttrs["class"] = "form-control";
		$this->f5m2->EditCustomAttributes = "";
		$this->f5m2->EditValue = $this->f5m2->CurrentValue;
		$this->f5m2->PlaceHolder = ew_RemoveHtml($this->f5m2->FldCaption());

		// f5k2
		$this->f5k2->EditAttrs["class"] = "form-control";
		$this->f5k2->EditCustomAttributes = "";
		$this->f5k2->EditValue = $this->f5k2->CurrentValue;
		$this->f5k2->PlaceHolder = ew_RemoveHtml($this->f5k2->FldCaption());

		// f6m2
		$this->f6m2->EditAttrs["class"] = "form-control";
		$this->f6m2->EditCustomAttributes = "";
		$this->f6m2->EditValue = $this->f6m2->CurrentValue;
		$this->f6m2->PlaceHolder = ew_RemoveHtml($this->f6m2->FldCaption());

		// f6k2
		$this->f6k2->EditAttrs["class"] = "form-control";
		$this->f6k2->EditCustomAttributes = "";
		$this->f6k2->EditValue = $this->f6k2->CurrentValue;
		$this->f6k2->PlaceHolder = ew_RemoveHtml($this->f6k2->FldCaption());

		// f0m3
		$this->f0m3->EditAttrs["class"] = "form-control";
		$this->f0m3->EditCustomAttributes = "";
		$this->f0m3->EditValue = $this->f0m3->CurrentValue;
		$this->f0m3->PlaceHolder = ew_RemoveHtml($this->f0m3->FldCaption());

		// f0k3
		$this->f0k3->EditAttrs["class"] = "form-control";
		$this->f0k3->EditCustomAttributes = "";
		$this->f0k3->EditValue = $this->f0k3->CurrentValue;
		$this->f0k3->PlaceHolder = ew_RemoveHtml($this->f0k3->FldCaption());

		// f1m3
		$this->f1m3->EditAttrs["class"] = "form-control";
		$this->f1m3->EditCustomAttributes = "";
		$this->f1m3->EditValue = $this->f1m3->CurrentValue;
		$this->f1m3->PlaceHolder = ew_RemoveHtml($this->f1m3->FldCaption());

		// f1k3
		$this->f1k3->EditAttrs["class"] = "form-control";
		$this->f1k3->EditCustomAttributes = "";
		$this->f1k3->EditValue = $this->f1k3->CurrentValue;
		$this->f1k3->PlaceHolder = ew_RemoveHtml($this->f1k3->FldCaption());

		// f2m3
		$this->f2m3->EditAttrs["class"] = "form-control";
		$this->f2m3->EditCustomAttributes = "";
		$this->f2m3->EditValue = $this->f2m3->CurrentValue;
		$this->f2m3->PlaceHolder = ew_RemoveHtml($this->f2m3->FldCaption());

		// f2k3
		$this->f2k3->EditAttrs["class"] = "form-control";
		$this->f2k3->EditCustomAttributes = "";
		$this->f2k3->EditValue = $this->f2k3->CurrentValue;
		$this->f2k3->PlaceHolder = ew_RemoveHtml($this->f2k3->FldCaption());

		// f3m3
		$this->f3m3->EditAttrs["class"] = "form-control";
		$this->f3m3->EditCustomAttributes = "";
		$this->f3m3->EditValue = $this->f3m3->CurrentValue;
		$this->f3m3->PlaceHolder = ew_RemoveHtml($this->f3m3->FldCaption());

		// f3k3
		$this->f3k3->EditAttrs["class"] = "form-control";
		$this->f3k3->EditCustomAttributes = "";
		$this->f3k3->EditValue = $this->f3k3->CurrentValue;
		$this->f3k3->PlaceHolder = ew_RemoveHtml($this->f3k3->FldCaption());

		// f4m3
		$this->f4m3->EditAttrs["class"] = "form-control";
		$this->f4m3->EditCustomAttributes = "";
		$this->f4m3->EditValue = $this->f4m3->CurrentValue;
		$this->f4m3->PlaceHolder = ew_RemoveHtml($this->f4m3->FldCaption());

		// f4k3
		$this->f4k3->EditAttrs["class"] = "form-control";
		$this->f4k3->EditCustomAttributes = "";
		$this->f4k3->EditValue = $this->f4k3->CurrentValue;
		$this->f4k3->PlaceHolder = ew_RemoveHtml($this->f4k3->FldCaption());

		// f5m3
		$this->f5m3->EditAttrs["class"] = "form-control";
		$this->f5m3->EditCustomAttributes = "";
		$this->f5m3->EditValue = $this->f5m3->CurrentValue;
		$this->f5m3->PlaceHolder = ew_RemoveHtml($this->f5m3->FldCaption());

		// f5k3
		$this->f5k3->EditAttrs["class"] = "form-control";
		$this->f5k3->EditCustomAttributes = "";
		$this->f5k3->EditValue = $this->f5k3->CurrentValue;
		$this->f5k3->PlaceHolder = ew_RemoveHtml($this->f5k3->FldCaption());

		// f6m3
		$this->f6m3->EditAttrs["class"] = "form-control";
		$this->f6m3->EditCustomAttributes = "";
		$this->f6m3->EditValue = $this->f6m3->CurrentValue;
		$this->f6m3->PlaceHolder = ew_RemoveHtml($this->f6m3->FldCaption());

		// f6k3
		$this->f6k3->EditAttrs["class"] = "form-control";
		$this->f6k3->EditCustomAttributes = "";
		$this->f6k3->EditValue = $this->f6k3->CurrentValue;
		$this->f6k3->PlaceHolder = ew_RemoveHtml($this->f6k3->FldCaption());

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
					if ($this->pd_id->Exportable) $Doc->ExportCaption($this->pd_id);
					if ($this->pegawai_id->Exportable) $Doc->ExportCaption($this->pegawai_id);
					if ($this->dept_id->Exportable) $Doc->ExportCaption($this->dept_id);
					if ($this->f0m1->Exportable) $Doc->ExportCaption($this->f0m1);
					if ($this->f0k1->Exportable) $Doc->ExportCaption($this->f0k1);
					if ($this->f1m1->Exportable) $Doc->ExportCaption($this->f1m1);
					if ($this->f1k1->Exportable) $Doc->ExportCaption($this->f1k1);
					if ($this->f2m1->Exportable) $Doc->ExportCaption($this->f2m1);
					if ($this->f2k1->Exportable) $Doc->ExportCaption($this->f2k1);
					if ($this->f3m1->Exportable) $Doc->ExportCaption($this->f3m1);
					if ($this->f3k1->Exportable) $Doc->ExportCaption($this->f3k1);
					if ($this->f4m1->Exportable) $Doc->ExportCaption($this->f4m1);
					if ($this->f4k1->Exportable) $Doc->ExportCaption($this->f4k1);
					if ($this->f5m1->Exportable) $Doc->ExportCaption($this->f5m1);
					if ($this->f5k1->Exportable) $Doc->ExportCaption($this->f5k1);
					if ($this->f6m1->Exportable) $Doc->ExportCaption($this->f6m1);
					if ($this->f6k1->Exportable) $Doc->ExportCaption($this->f6k1);
					if ($this->f0m2->Exportable) $Doc->ExportCaption($this->f0m2);
					if ($this->f0k2->Exportable) $Doc->ExportCaption($this->f0k2);
					if ($this->f1m2->Exportable) $Doc->ExportCaption($this->f1m2);
					if ($this->f1k2->Exportable) $Doc->ExportCaption($this->f1k2);
					if ($this->f2m2->Exportable) $Doc->ExportCaption($this->f2m2);
					if ($this->f2k2->Exportable) $Doc->ExportCaption($this->f2k2);
					if ($this->f3m2->Exportable) $Doc->ExportCaption($this->f3m2);
					if ($this->f3k2->Exportable) $Doc->ExportCaption($this->f3k2);
					if ($this->f4m2->Exportable) $Doc->ExportCaption($this->f4m2);
					if ($this->f4k2->Exportable) $Doc->ExportCaption($this->f4k2);
					if ($this->f5m2->Exportable) $Doc->ExportCaption($this->f5m2);
					if ($this->f5k2->Exportable) $Doc->ExportCaption($this->f5k2);
					if ($this->f6m2->Exportable) $Doc->ExportCaption($this->f6m2);
					if ($this->f6k2->Exportable) $Doc->ExportCaption($this->f6k2);
					if ($this->f0m3->Exportable) $Doc->ExportCaption($this->f0m3);
					if ($this->f0k3->Exportable) $Doc->ExportCaption($this->f0k3);
					if ($this->f1m3->Exportable) $Doc->ExportCaption($this->f1m3);
					if ($this->f1k3->Exportable) $Doc->ExportCaption($this->f1k3);
					if ($this->f2m3->Exportable) $Doc->ExportCaption($this->f2m3);
					if ($this->f2k3->Exportable) $Doc->ExportCaption($this->f2k3);
					if ($this->f3m3->Exportable) $Doc->ExportCaption($this->f3m3);
					if ($this->f3k3->Exportable) $Doc->ExportCaption($this->f3k3);
					if ($this->f4m3->Exportable) $Doc->ExportCaption($this->f4m3);
					if ($this->f4k3->Exportable) $Doc->ExportCaption($this->f4k3);
					if ($this->f5m3->Exportable) $Doc->ExportCaption($this->f5m3);
					if ($this->f5k3->Exportable) $Doc->ExportCaption($this->f5k3);
					if ($this->f6m3->Exportable) $Doc->ExportCaption($this->f6m3);
					if ($this->f6k3->Exportable) $Doc->ExportCaption($this->f6k3);
				} else {
					if ($this->pd_id->Exportable) $Doc->ExportCaption($this->pd_id);
					if ($this->pegawai_id->Exportable) $Doc->ExportCaption($this->pegawai_id);
					if ($this->dept_id->Exportable) $Doc->ExportCaption($this->dept_id);
					if ($this->f0m1->Exportable) $Doc->ExportCaption($this->f0m1);
					if ($this->f0k1->Exportable) $Doc->ExportCaption($this->f0k1);
					if ($this->f1m1->Exportable) $Doc->ExportCaption($this->f1m1);
					if ($this->f1k1->Exportable) $Doc->ExportCaption($this->f1k1);
					if ($this->f2m1->Exportable) $Doc->ExportCaption($this->f2m1);
					if ($this->f2k1->Exportable) $Doc->ExportCaption($this->f2k1);
					if ($this->f3m1->Exportable) $Doc->ExportCaption($this->f3m1);
					if ($this->f3k1->Exportable) $Doc->ExportCaption($this->f3k1);
					if ($this->f4m1->Exportable) $Doc->ExportCaption($this->f4m1);
					if ($this->f4k1->Exportable) $Doc->ExportCaption($this->f4k1);
					if ($this->f5m1->Exportable) $Doc->ExportCaption($this->f5m1);
					if ($this->f5k1->Exportable) $Doc->ExportCaption($this->f5k1);
					if ($this->f6m1->Exportable) $Doc->ExportCaption($this->f6m1);
					if ($this->f6k1->Exportable) $Doc->ExportCaption($this->f6k1);
					if ($this->f0m2->Exportable) $Doc->ExportCaption($this->f0m2);
					if ($this->f0k2->Exportable) $Doc->ExportCaption($this->f0k2);
					if ($this->f1m2->Exportable) $Doc->ExportCaption($this->f1m2);
					if ($this->f1k2->Exportable) $Doc->ExportCaption($this->f1k2);
					if ($this->f2m2->Exportable) $Doc->ExportCaption($this->f2m2);
					if ($this->f2k2->Exportable) $Doc->ExportCaption($this->f2k2);
					if ($this->f3m2->Exportable) $Doc->ExportCaption($this->f3m2);
					if ($this->f3k2->Exportable) $Doc->ExportCaption($this->f3k2);
					if ($this->f4m2->Exportable) $Doc->ExportCaption($this->f4m2);
					if ($this->f4k2->Exportable) $Doc->ExportCaption($this->f4k2);
					if ($this->f5m2->Exportable) $Doc->ExportCaption($this->f5m2);
					if ($this->f5k2->Exportable) $Doc->ExportCaption($this->f5k2);
					if ($this->f6m2->Exportable) $Doc->ExportCaption($this->f6m2);
					if ($this->f6k2->Exportable) $Doc->ExportCaption($this->f6k2);
					if ($this->f0m3->Exportable) $Doc->ExportCaption($this->f0m3);
					if ($this->f0k3->Exportable) $Doc->ExportCaption($this->f0k3);
					if ($this->f1m3->Exportable) $Doc->ExportCaption($this->f1m3);
					if ($this->f1k3->Exportable) $Doc->ExportCaption($this->f1k3);
					if ($this->f2m3->Exportable) $Doc->ExportCaption($this->f2m3);
					if ($this->f2k3->Exportable) $Doc->ExportCaption($this->f2k3);
					if ($this->f3m3->Exportable) $Doc->ExportCaption($this->f3m3);
					if ($this->f3k3->Exportable) $Doc->ExportCaption($this->f3k3);
					if ($this->f4m3->Exportable) $Doc->ExportCaption($this->f4m3);
					if ($this->f4k3->Exportable) $Doc->ExportCaption($this->f4k3);
					if ($this->f5m3->Exportable) $Doc->ExportCaption($this->f5m3);
					if ($this->f5k3->Exportable) $Doc->ExportCaption($this->f5k3);
					if ($this->f6m3->Exportable) $Doc->ExportCaption($this->f6m3);
					if ($this->f6k3->Exportable) $Doc->ExportCaption($this->f6k3);
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
						if ($this->pd_id->Exportable) $Doc->ExportField($this->pd_id);
						if ($this->pegawai_id->Exportable) $Doc->ExportField($this->pegawai_id);
						if ($this->dept_id->Exportable) $Doc->ExportField($this->dept_id);
						if ($this->f0m1->Exportable) $Doc->ExportField($this->f0m1);
						if ($this->f0k1->Exportable) $Doc->ExportField($this->f0k1);
						if ($this->f1m1->Exportable) $Doc->ExportField($this->f1m1);
						if ($this->f1k1->Exportable) $Doc->ExportField($this->f1k1);
						if ($this->f2m1->Exportable) $Doc->ExportField($this->f2m1);
						if ($this->f2k1->Exportable) $Doc->ExportField($this->f2k1);
						if ($this->f3m1->Exportable) $Doc->ExportField($this->f3m1);
						if ($this->f3k1->Exportable) $Doc->ExportField($this->f3k1);
						if ($this->f4m1->Exportable) $Doc->ExportField($this->f4m1);
						if ($this->f4k1->Exportable) $Doc->ExportField($this->f4k1);
						if ($this->f5m1->Exportable) $Doc->ExportField($this->f5m1);
						if ($this->f5k1->Exportable) $Doc->ExportField($this->f5k1);
						if ($this->f6m1->Exportable) $Doc->ExportField($this->f6m1);
						if ($this->f6k1->Exportable) $Doc->ExportField($this->f6k1);
						if ($this->f0m2->Exportable) $Doc->ExportField($this->f0m2);
						if ($this->f0k2->Exportable) $Doc->ExportField($this->f0k2);
						if ($this->f1m2->Exportable) $Doc->ExportField($this->f1m2);
						if ($this->f1k2->Exportable) $Doc->ExportField($this->f1k2);
						if ($this->f2m2->Exportable) $Doc->ExportField($this->f2m2);
						if ($this->f2k2->Exportable) $Doc->ExportField($this->f2k2);
						if ($this->f3m2->Exportable) $Doc->ExportField($this->f3m2);
						if ($this->f3k2->Exportable) $Doc->ExportField($this->f3k2);
						if ($this->f4m2->Exportable) $Doc->ExportField($this->f4m2);
						if ($this->f4k2->Exportable) $Doc->ExportField($this->f4k2);
						if ($this->f5m2->Exportable) $Doc->ExportField($this->f5m2);
						if ($this->f5k2->Exportable) $Doc->ExportField($this->f5k2);
						if ($this->f6m2->Exportable) $Doc->ExportField($this->f6m2);
						if ($this->f6k2->Exportable) $Doc->ExportField($this->f6k2);
						if ($this->f0m3->Exportable) $Doc->ExportField($this->f0m3);
						if ($this->f0k3->Exportable) $Doc->ExportField($this->f0k3);
						if ($this->f1m3->Exportable) $Doc->ExportField($this->f1m3);
						if ($this->f1k3->Exportable) $Doc->ExportField($this->f1k3);
						if ($this->f2m3->Exportable) $Doc->ExportField($this->f2m3);
						if ($this->f2k3->Exportable) $Doc->ExportField($this->f2k3);
						if ($this->f3m3->Exportable) $Doc->ExportField($this->f3m3);
						if ($this->f3k3->Exportable) $Doc->ExportField($this->f3k3);
						if ($this->f4m3->Exportable) $Doc->ExportField($this->f4m3);
						if ($this->f4k3->Exportable) $Doc->ExportField($this->f4k3);
						if ($this->f5m3->Exportable) $Doc->ExportField($this->f5m3);
						if ($this->f5k3->Exportable) $Doc->ExportField($this->f5k3);
						if ($this->f6m3->Exportable) $Doc->ExportField($this->f6m3);
						if ($this->f6k3->Exportable) $Doc->ExportField($this->f6k3);
					} else {
						if ($this->pd_id->Exportable) $Doc->ExportField($this->pd_id);
						if ($this->pegawai_id->Exportable) $Doc->ExportField($this->pegawai_id);
						if ($this->dept_id->Exportable) $Doc->ExportField($this->dept_id);
						if ($this->f0m1->Exportable) $Doc->ExportField($this->f0m1);
						if ($this->f0k1->Exportable) $Doc->ExportField($this->f0k1);
						if ($this->f1m1->Exportable) $Doc->ExportField($this->f1m1);
						if ($this->f1k1->Exportable) $Doc->ExportField($this->f1k1);
						if ($this->f2m1->Exportable) $Doc->ExportField($this->f2m1);
						if ($this->f2k1->Exportable) $Doc->ExportField($this->f2k1);
						if ($this->f3m1->Exportable) $Doc->ExportField($this->f3m1);
						if ($this->f3k1->Exportable) $Doc->ExportField($this->f3k1);
						if ($this->f4m1->Exportable) $Doc->ExportField($this->f4m1);
						if ($this->f4k1->Exportable) $Doc->ExportField($this->f4k1);
						if ($this->f5m1->Exportable) $Doc->ExportField($this->f5m1);
						if ($this->f5k1->Exportable) $Doc->ExportField($this->f5k1);
						if ($this->f6m1->Exportable) $Doc->ExportField($this->f6m1);
						if ($this->f6k1->Exportable) $Doc->ExportField($this->f6k1);
						if ($this->f0m2->Exportable) $Doc->ExportField($this->f0m2);
						if ($this->f0k2->Exportable) $Doc->ExportField($this->f0k2);
						if ($this->f1m2->Exportable) $Doc->ExportField($this->f1m2);
						if ($this->f1k2->Exportable) $Doc->ExportField($this->f1k2);
						if ($this->f2m2->Exportable) $Doc->ExportField($this->f2m2);
						if ($this->f2k2->Exportable) $Doc->ExportField($this->f2k2);
						if ($this->f3m2->Exportable) $Doc->ExportField($this->f3m2);
						if ($this->f3k2->Exportable) $Doc->ExportField($this->f3k2);
						if ($this->f4m2->Exportable) $Doc->ExportField($this->f4m2);
						if ($this->f4k2->Exportable) $Doc->ExportField($this->f4k2);
						if ($this->f5m2->Exportable) $Doc->ExportField($this->f5m2);
						if ($this->f5k2->Exportable) $Doc->ExportField($this->f5k2);
						if ($this->f6m2->Exportable) $Doc->ExportField($this->f6m2);
						if ($this->f6k2->Exportable) $Doc->ExportField($this->f6k2);
						if ($this->f0m3->Exportable) $Doc->ExportField($this->f0m3);
						if ($this->f0k3->Exportable) $Doc->ExportField($this->f0k3);
						if ($this->f1m3->Exportable) $Doc->ExportField($this->f1m3);
						if ($this->f1k3->Exportable) $Doc->ExportField($this->f1k3);
						if ($this->f2m3->Exportable) $Doc->ExportField($this->f2m3);
						if ($this->f2k3->Exportable) $Doc->ExportField($this->f2k3);
						if ($this->f3m3->Exportable) $Doc->ExportField($this->f3m3);
						if ($this->f3k3->Exportable) $Doc->ExportField($this->f3k3);
						if ($this->f4m3->Exportable) $Doc->ExportField($this->f4m3);
						if ($this->f4k3->Exportable) $Doc->ExportField($this->f4k3);
						if ($this->f5m3->Exportable) $Doc->ExportField($this->f5m3);
						if ($this->f5k3->Exportable) $Doc->ExportField($this->f5k3);
						if ($this->f6m3->Exportable) $Doc->ExportField($this->f6m3);
						if ($this->f6k3->Exportable) $Doc->ExportField($this->f6k3);
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

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 'pegawai_default';
		$usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $Language;
		if (!$this->AuditTrailOnAdd) return;
		$table = 'pegawai_default';

		// Get key value
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['pd_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->FldHtmlTag == "PASSWORD") {
					$newvalue = $Language->Phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $Language;
		if (!$this->AuditTrailOnEdit) return;
		$table = 'pegawai_default';

		// Get key value
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['pd_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && array_key_exists($fldname, $rsold) && $this->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->FldHtmlTag == "PASSWORD") { // Password Field
						$oldvalue = $Language->Phrase("PasswordMask");
						$newvalue = $Language->Phrase("PasswordMask");
					} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						if (EW_AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					ew_WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $Language;
		if (!$this->AuditTrailOnDelete) return;
		$table = 'pegawai_default';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['pd_id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
		$curUser = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->FldHtmlTag == "PASSWORD") {
					$oldvalue = $Language->Phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
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
