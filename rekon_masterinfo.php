<?php

// Global variable for table object
$rekon_master = NULL;

//
// Table class for rekon_master
//
class crekon_master extends cTable {
	var $rm_id;
	var $pegawai_id;
	var $f1;
	var $f2;
	var $f3;
	var $f4;
	var $f5;
	var $f6;
	var $f7;
	var $f8;
	var $f9;
	var $f10;
	var $f11;
	var $f12;
	var $f13;
	var $f14;
	var $f15;
	var $f16;
	var $f17;
	var $f18;
	var $f19;
	var $f20;
	var $f21;
	var $f22;
	var $f23;
	var $f24;
	var $f25;
	var $f26;
	var $f27;
	var $f28;
	var $f29;
	var $f30;
	var $f31;
	var $f32;
	var $f33;
	var $f34;
	var $f35;
	var $f36;
	var $f37;
	var $f38;
	var $f39;
	var $f40;
	var $f41;
	var $f42;
	var $f43;
	var $f44;
	var $f45;
	var $f46;
	var $f47;
	var $f48;
	var $f49;
	var $f50;
	var $f51;
	var $f52;
	var $f53;
	var $f54;
	var $f55;
	var $f56;
	var $f57;
	var $f58;
	var $f59;
	var $f60;
	var $f61;
	var $f62;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'rekon_master';
		$this->TableName = 'rekon_master';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`rekon_master`";
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

		// rm_id
		$this->rm_id = new cField('rekon_master', 'rekon_master', 'x_rm_id', 'rm_id', '`rm_id`', '`rm_id`', 3, -1, FALSE, '`rm_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->rm_id->Sortable = TRUE; // Allow sort
		$this->rm_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['rm_id'] = &$this->rm_id;

		// pegawai_id
		$this->pegawai_id = new cField('rekon_master', 'rekon_master', 'x_pegawai_id', 'pegawai_id', '`pegawai_id`', '`pegawai_id`', 3, -1, FALSE, '`pegawai_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pegawai_id->Sortable = TRUE; // Allow sort
		$this->pegawai_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pegawai_id'] = &$this->pegawai_id;

		// f1
		$this->f1 = new cField('rekon_master', 'rekon_master', 'x_f1', 'f1', '`f1`', ew_CastDateFieldForLike('`f1`', 0, "DB"), 135, -1, FALSE, '`f1`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f1->Sortable = TRUE; // Allow sort
		$this->f1->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f1'] = &$this->f1;

		// f2
		$this->f2 = new cField('rekon_master', 'rekon_master', 'x_f2', 'f2', '`f2`', ew_CastDateFieldForLike('`f2`', 0, "DB"), 135, -1, FALSE, '`f2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f2->Sortable = TRUE; // Allow sort
		$this->f2->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f2'] = &$this->f2;

		// f3
		$this->f3 = new cField('rekon_master', 'rekon_master', 'x_f3', 'f3', '`f3`', ew_CastDateFieldForLike('`f3`', 0, "DB"), 135, -1, FALSE, '`f3`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f3->Sortable = TRUE; // Allow sort
		$this->f3->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f3'] = &$this->f3;

		// f4
		$this->f4 = new cField('rekon_master', 'rekon_master', 'x_f4', 'f4', '`f4`', ew_CastDateFieldForLike('`f4`', 0, "DB"), 135, -1, FALSE, '`f4`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f4->Sortable = TRUE; // Allow sort
		$this->f4->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f4'] = &$this->f4;

		// f5
		$this->f5 = new cField('rekon_master', 'rekon_master', 'x_f5', 'f5', '`f5`', ew_CastDateFieldForLike('`f5`', 0, "DB"), 135, -1, FALSE, '`f5`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f5->Sortable = TRUE; // Allow sort
		$this->f5->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f5'] = &$this->f5;

		// f6
		$this->f6 = new cField('rekon_master', 'rekon_master', 'x_f6', 'f6', '`f6`', ew_CastDateFieldForLike('`f6`', 0, "DB"), 135, -1, FALSE, '`f6`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f6->Sortable = TRUE; // Allow sort
		$this->f6->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f6'] = &$this->f6;

		// f7
		$this->f7 = new cField('rekon_master', 'rekon_master', 'x_f7', 'f7', '`f7`', ew_CastDateFieldForLike('`f7`', 0, "DB"), 135, -1, FALSE, '`f7`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f7->Sortable = TRUE; // Allow sort
		$this->f7->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f7'] = &$this->f7;

		// f8
		$this->f8 = new cField('rekon_master', 'rekon_master', 'x_f8', 'f8', '`f8`', ew_CastDateFieldForLike('`f8`', 0, "DB"), 135, -1, FALSE, '`f8`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f8->Sortable = TRUE; // Allow sort
		$this->f8->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f8'] = &$this->f8;

		// f9
		$this->f9 = new cField('rekon_master', 'rekon_master', 'x_f9', 'f9', '`f9`', ew_CastDateFieldForLike('`f9`', 0, "DB"), 135, -1, FALSE, '`f9`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f9->Sortable = TRUE; // Allow sort
		$this->f9->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f9'] = &$this->f9;

		// f10
		$this->f10 = new cField('rekon_master', 'rekon_master', 'x_f10', 'f10', '`f10`', ew_CastDateFieldForLike('`f10`', 0, "DB"), 135, -1, FALSE, '`f10`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f10->Sortable = TRUE; // Allow sort
		$this->f10->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f10'] = &$this->f10;

		// f11
		$this->f11 = new cField('rekon_master', 'rekon_master', 'x_f11', 'f11', '`f11`', ew_CastDateFieldForLike('`f11`', 0, "DB"), 135, -1, FALSE, '`f11`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f11->Sortable = TRUE; // Allow sort
		$this->f11->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f11'] = &$this->f11;

		// f12
		$this->f12 = new cField('rekon_master', 'rekon_master', 'x_f12', 'f12', '`f12`', ew_CastDateFieldForLike('`f12`', 0, "DB"), 135, -1, FALSE, '`f12`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f12->Sortable = TRUE; // Allow sort
		$this->f12->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f12'] = &$this->f12;

		// f13
		$this->f13 = new cField('rekon_master', 'rekon_master', 'x_f13', 'f13', '`f13`', ew_CastDateFieldForLike('`f13`', 0, "DB"), 135, -1, FALSE, '`f13`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f13->Sortable = TRUE; // Allow sort
		$this->f13->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f13'] = &$this->f13;

		// f14
		$this->f14 = new cField('rekon_master', 'rekon_master', 'x_f14', 'f14', '`f14`', ew_CastDateFieldForLike('`f14`', 0, "DB"), 135, -1, FALSE, '`f14`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f14->Sortable = TRUE; // Allow sort
		$this->f14->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f14'] = &$this->f14;

		// f15
		$this->f15 = new cField('rekon_master', 'rekon_master', 'x_f15', 'f15', '`f15`', ew_CastDateFieldForLike('`f15`', 0, "DB"), 135, -1, FALSE, '`f15`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f15->Sortable = TRUE; // Allow sort
		$this->f15->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f15'] = &$this->f15;

		// f16
		$this->f16 = new cField('rekon_master', 'rekon_master', 'x_f16', 'f16', '`f16`', ew_CastDateFieldForLike('`f16`', 0, "DB"), 135, -1, FALSE, '`f16`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f16->Sortable = TRUE; // Allow sort
		$this->f16->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f16'] = &$this->f16;

		// f17
		$this->f17 = new cField('rekon_master', 'rekon_master', 'x_f17', 'f17', '`f17`', ew_CastDateFieldForLike('`f17`', 0, "DB"), 135, -1, FALSE, '`f17`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f17->Sortable = TRUE; // Allow sort
		$this->f17->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f17'] = &$this->f17;

		// f18
		$this->f18 = new cField('rekon_master', 'rekon_master', 'x_f18', 'f18', '`f18`', ew_CastDateFieldForLike('`f18`', 0, "DB"), 135, -1, FALSE, '`f18`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f18->Sortable = TRUE; // Allow sort
		$this->f18->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f18'] = &$this->f18;

		// f19
		$this->f19 = new cField('rekon_master', 'rekon_master', 'x_f19', 'f19', '`f19`', ew_CastDateFieldForLike('`f19`', 0, "DB"), 135, -1, FALSE, '`f19`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f19->Sortable = TRUE; // Allow sort
		$this->f19->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f19'] = &$this->f19;

		// f20
		$this->f20 = new cField('rekon_master', 'rekon_master', 'x_f20', 'f20', '`f20`', ew_CastDateFieldForLike('`f20`', 0, "DB"), 135, -1, FALSE, '`f20`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20->Sortable = TRUE; // Allow sort
		$this->f20->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f20'] = &$this->f20;

		// f21
		$this->f21 = new cField('rekon_master', 'rekon_master', 'x_f21', 'f21', '`f21`', ew_CastDateFieldForLike('`f21`', 0, "DB"), 135, -1, FALSE, '`f21`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f21->Sortable = TRUE; // Allow sort
		$this->f21->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f21'] = &$this->f21;

		// f22
		$this->f22 = new cField('rekon_master', 'rekon_master', 'x_f22', 'f22', '`f22`', ew_CastDateFieldForLike('`f22`', 0, "DB"), 135, -1, FALSE, '`f22`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f22->Sortable = TRUE; // Allow sort
		$this->f22->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f22'] = &$this->f22;

		// f23
		$this->f23 = new cField('rekon_master', 'rekon_master', 'x_f23', 'f23', '`f23`', ew_CastDateFieldForLike('`f23`', 0, "DB"), 135, -1, FALSE, '`f23`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f23->Sortable = TRUE; // Allow sort
		$this->f23->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f23'] = &$this->f23;

		// f24
		$this->f24 = new cField('rekon_master', 'rekon_master', 'x_f24', 'f24', '`f24`', ew_CastDateFieldForLike('`f24`', 0, "DB"), 135, -1, FALSE, '`f24`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f24->Sortable = TRUE; // Allow sort
		$this->f24->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f24'] = &$this->f24;

		// f25
		$this->f25 = new cField('rekon_master', 'rekon_master', 'x_f25', 'f25', '`f25`', ew_CastDateFieldForLike('`f25`', 0, "DB"), 135, -1, FALSE, '`f25`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f25->Sortable = TRUE; // Allow sort
		$this->f25->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f25'] = &$this->f25;

		// f26
		$this->f26 = new cField('rekon_master', 'rekon_master', 'x_f26', 'f26', '`f26`', ew_CastDateFieldForLike('`f26`', 0, "DB"), 135, -1, FALSE, '`f26`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f26->Sortable = TRUE; // Allow sort
		$this->f26->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f26'] = &$this->f26;

		// f27
		$this->f27 = new cField('rekon_master', 'rekon_master', 'x_f27', 'f27', '`f27`', ew_CastDateFieldForLike('`f27`', 0, "DB"), 135, -1, FALSE, '`f27`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f27->Sortable = TRUE; // Allow sort
		$this->f27->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f27'] = &$this->f27;

		// f28
		$this->f28 = new cField('rekon_master', 'rekon_master', 'x_f28', 'f28', '`f28`', ew_CastDateFieldForLike('`f28`', 0, "DB"), 135, -1, FALSE, '`f28`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f28->Sortable = TRUE; // Allow sort
		$this->f28->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f28'] = &$this->f28;

		// f29
		$this->f29 = new cField('rekon_master', 'rekon_master', 'x_f29', 'f29', '`f29`', ew_CastDateFieldForLike('`f29`', 0, "DB"), 135, -1, FALSE, '`f29`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f29->Sortable = TRUE; // Allow sort
		$this->f29->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f29'] = &$this->f29;

		// f30
		$this->f30 = new cField('rekon_master', 'rekon_master', 'x_f30', 'f30', '`f30`', ew_CastDateFieldForLike('`f30`', 0, "DB"), 135, -1, FALSE, '`f30`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f30->Sortable = TRUE; // Allow sort
		$this->f30->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f30'] = &$this->f30;

		// f31
		$this->f31 = new cField('rekon_master', 'rekon_master', 'x_f31', 'f31', '`f31`', ew_CastDateFieldForLike('`f31`', 0, "DB"), 135, -1, FALSE, '`f31`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f31->Sortable = TRUE; // Allow sort
		$this->f31->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_TIME_SEPARATOR"], $Language->Phrase("IncorrectTime"));
		$this->fields['f31'] = &$this->f31;

		// f32
		$this->f32 = new cField('rekon_master', 'rekon_master', 'x_f32', 'f32', '`f32`', ew_CastDateFieldForLike('`f32`', 0, "DB"), 135, 0, FALSE, '`f32`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f32->Sortable = TRUE; // Allow sort
		$this->f32->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f32'] = &$this->f32;

		// f33
		$this->f33 = new cField('rekon_master', 'rekon_master', 'x_f33', 'f33', '`f33`', ew_CastDateFieldForLike('`f33`', 0, "DB"), 135, 0, FALSE, '`f33`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f33->Sortable = TRUE; // Allow sort
		$this->f33->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f33'] = &$this->f33;

		// f34
		$this->f34 = new cField('rekon_master', 'rekon_master', 'x_f34', 'f34', '`f34`', ew_CastDateFieldForLike('`f34`', 0, "DB"), 135, 0, FALSE, '`f34`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f34->Sortable = TRUE; // Allow sort
		$this->f34->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f34'] = &$this->f34;

		// f35
		$this->f35 = new cField('rekon_master', 'rekon_master', 'x_f35', 'f35', '`f35`', ew_CastDateFieldForLike('`f35`', 0, "DB"), 135, 0, FALSE, '`f35`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f35->Sortable = TRUE; // Allow sort
		$this->f35->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f35'] = &$this->f35;

		// f36
		$this->f36 = new cField('rekon_master', 'rekon_master', 'x_f36', 'f36', '`f36`', ew_CastDateFieldForLike('`f36`', 0, "DB"), 135, 0, FALSE, '`f36`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f36->Sortable = TRUE; // Allow sort
		$this->f36->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f36'] = &$this->f36;

		// f37
		$this->f37 = new cField('rekon_master', 'rekon_master', 'x_f37', 'f37', '`f37`', ew_CastDateFieldForLike('`f37`', 0, "DB"), 135, 0, FALSE, '`f37`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f37->Sortable = TRUE; // Allow sort
		$this->f37->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f37'] = &$this->f37;

		// f38
		$this->f38 = new cField('rekon_master', 'rekon_master', 'x_f38', 'f38', '`f38`', ew_CastDateFieldForLike('`f38`', 0, "DB"), 135, 0, FALSE, '`f38`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f38->Sortable = TRUE; // Allow sort
		$this->f38->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f38'] = &$this->f38;

		// f39
		$this->f39 = new cField('rekon_master', 'rekon_master', 'x_f39', 'f39', '`f39`', ew_CastDateFieldForLike('`f39`', 0, "DB"), 135, 0, FALSE, '`f39`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f39->Sortable = TRUE; // Allow sort
		$this->f39->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f39'] = &$this->f39;

		// f40
		$this->f40 = new cField('rekon_master', 'rekon_master', 'x_f40', 'f40', '`f40`', ew_CastDateFieldForLike('`f40`', 0, "DB"), 135, 0, FALSE, '`f40`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f40->Sortable = TRUE; // Allow sort
		$this->f40->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f40'] = &$this->f40;

		// f41
		$this->f41 = new cField('rekon_master', 'rekon_master', 'x_f41', 'f41', '`f41`', ew_CastDateFieldForLike('`f41`', 0, "DB"), 135, 0, FALSE, '`f41`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f41->Sortable = TRUE; // Allow sort
		$this->f41->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f41'] = &$this->f41;

		// f42
		$this->f42 = new cField('rekon_master', 'rekon_master', 'x_f42', 'f42', '`f42`', ew_CastDateFieldForLike('`f42`', 0, "DB"), 135, 0, FALSE, '`f42`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f42->Sortable = TRUE; // Allow sort
		$this->f42->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f42'] = &$this->f42;

		// f43
		$this->f43 = new cField('rekon_master', 'rekon_master', 'x_f43', 'f43', '`f43`', ew_CastDateFieldForLike('`f43`', 0, "DB"), 135, 0, FALSE, '`f43`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f43->Sortable = TRUE; // Allow sort
		$this->f43->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f43'] = &$this->f43;

		// f44
		$this->f44 = new cField('rekon_master', 'rekon_master', 'x_f44', 'f44', '`f44`', ew_CastDateFieldForLike('`f44`', 0, "DB"), 135, 0, FALSE, '`f44`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f44->Sortable = TRUE; // Allow sort
		$this->f44->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f44'] = &$this->f44;

		// f45
		$this->f45 = new cField('rekon_master', 'rekon_master', 'x_f45', 'f45', '`f45`', ew_CastDateFieldForLike('`f45`', 0, "DB"), 135, 0, FALSE, '`f45`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f45->Sortable = TRUE; // Allow sort
		$this->f45->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f45'] = &$this->f45;

		// f46
		$this->f46 = new cField('rekon_master', 'rekon_master', 'x_f46', 'f46', '`f46`', ew_CastDateFieldForLike('`f46`', 0, "DB"), 135, 0, FALSE, '`f46`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f46->Sortable = TRUE; // Allow sort
		$this->f46->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f46'] = &$this->f46;

		// f47
		$this->f47 = new cField('rekon_master', 'rekon_master', 'x_f47', 'f47', '`f47`', ew_CastDateFieldForLike('`f47`', 0, "DB"), 135, 0, FALSE, '`f47`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f47->Sortable = TRUE; // Allow sort
		$this->f47->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f47'] = &$this->f47;

		// f48
		$this->f48 = new cField('rekon_master', 'rekon_master', 'x_f48', 'f48', '`f48`', ew_CastDateFieldForLike('`f48`', 0, "DB"), 135, 0, FALSE, '`f48`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f48->Sortable = TRUE; // Allow sort
		$this->f48->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f48'] = &$this->f48;

		// f49
		$this->f49 = new cField('rekon_master', 'rekon_master', 'x_f49', 'f49', '`f49`', ew_CastDateFieldForLike('`f49`', 0, "DB"), 135, 0, FALSE, '`f49`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f49->Sortable = TRUE; // Allow sort
		$this->f49->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f49'] = &$this->f49;

		// f50
		$this->f50 = new cField('rekon_master', 'rekon_master', 'x_f50', 'f50', '`f50`', ew_CastDateFieldForLike('`f50`', 0, "DB"), 135, 0, FALSE, '`f50`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f50->Sortable = TRUE; // Allow sort
		$this->f50->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f50'] = &$this->f50;

		// f51
		$this->f51 = new cField('rekon_master', 'rekon_master', 'x_f51', 'f51', '`f51`', ew_CastDateFieldForLike('`f51`', 0, "DB"), 135, 0, FALSE, '`f51`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f51->Sortable = TRUE; // Allow sort
		$this->f51->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f51'] = &$this->f51;

		// f52
		$this->f52 = new cField('rekon_master', 'rekon_master', 'x_f52', 'f52', '`f52`', ew_CastDateFieldForLike('`f52`', 0, "DB"), 135, 0, FALSE, '`f52`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f52->Sortable = TRUE; // Allow sort
		$this->f52->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f52'] = &$this->f52;

		// f53
		$this->f53 = new cField('rekon_master', 'rekon_master', 'x_f53', 'f53', '`f53`', ew_CastDateFieldForLike('`f53`', 0, "DB"), 135, 0, FALSE, '`f53`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f53->Sortable = TRUE; // Allow sort
		$this->f53->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f53'] = &$this->f53;

		// f54
		$this->f54 = new cField('rekon_master', 'rekon_master', 'x_f54', 'f54', '`f54`', ew_CastDateFieldForLike('`f54`', 0, "DB"), 135, 0, FALSE, '`f54`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f54->Sortable = TRUE; // Allow sort
		$this->f54->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f54'] = &$this->f54;

		// f55
		$this->f55 = new cField('rekon_master', 'rekon_master', 'x_f55', 'f55', '`f55`', ew_CastDateFieldForLike('`f55`', 0, "DB"), 135, 0, FALSE, '`f55`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f55->Sortable = TRUE; // Allow sort
		$this->f55->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f55'] = &$this->f55;

		// f56
		$this->f56 = new cField('rekon_master', 'rekon_master', 'x_f56', 'f56', '`f56`', ew_CastDateFieldForLike('`f56`', 0, "DB"), 135, 0, FALSE, '`f56`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f56->Sortable = TRUE; // Allow sort
		$this->f56->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f56'] = &$this->f56;

		// f57
		$this->f57 = new cField('rekon_master', 'rekon_master', 'x_f57', 'f57', '`f57`', ew_CastDateFieldForLike('`f57`', 0, "DB"), 135, 0, FALSE, '`f57`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f57->Sortable = TRUE; // Allow sort
		$this->f57->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f57'] = &$this->f57;

		// f58
		$this->f58 = new cField('rekon_master', 'rekon_master', 'x_f58', 'f58', '`f58`', ew_CastDateFieldForLike('`f58`', 0, "DB"), 135, 0, FALSE, '`f58`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f58->Sortable = TRUE; // Allow sort
		$this->f58->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f58'] = &$this->f58;

		// f59
		$this->f59 = new cField('rekon_master', 'rekon_master', 'x_f59', 'f59', '`f59`', ew_CastDateFieldForLike('`f59`', 0, "DB"), 135, 0, FALSE, '`f59`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f59->Sortable = TRUE; // Allow sort
		$this->f59->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f59'] = &$this->f59;

		// f60
		$this->f60 = new cField('rekon_master', 'rekon_master', 'x_f60', 'f60', '`f60`', ew_CastDateFieldForLike('`f60`', 0, "DB"), 135, 0, FALSE, '`f60`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f60->Sortable = TRUE; // Allow sort
		$this->f60->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f60'] = &$this->f60;

		// f61
		$this->f61 = new cField('rekon_master', 'rekon_master', 'x_f61', 'f61', '`f61`', ew_CastDateFieldForLike('`f61`', 0, "DB"), 135, 0, FALSE, '`f61`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f61->Sortable = TRUE; // Allow sort
		$this->f61->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f61'] = &$this->f61;

		// f62
		$this->f62 = new cField('rekon_master', 'rekon_master', 'x_f62', 'f62', '`f62`', ew_CastDateFieldForLike('`f62`', 0, "DB"), 135, 0, FALSE, '`f62`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f62->Sortable = TRUE; // Allow sort
		$this->f62->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['f62'] = &$this->f62;
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`rekon_master`";
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
			$this->rm_id->setDbValue($conn->Insert_ID());
			$rs['rm_id'] = $this->rm_id->DbValue;
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
			if (array_key_exists('rm_id', $rs))
				ew_AddFilter($where, ew_QuotedName('rm_id', $this->DBID) . '=' . ew_QuotedValue($rs['rm_id'], $this->rm_id->FldDataType, $this->DBID));
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
		return "`rm_id` = @rm_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->rm_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@rm_id@", ew_AdjustSql($this->rm_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "rekon_masterlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "rekon_masterlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("rekon_masterview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("rekon_masterview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "rekon_masteradd.php?" . $this->UrlParm($parm);
		else
			$url = "rekon_masteradd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("rekon_masteredit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("rekon_masteradd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("rekon_masterdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "rm_id:" . ew_VarToJson($this->rm_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->rm_id->CurrentValue)) {
			$sUrl .= "rm_id=" . urlencode($this->rm_id->CurrentValue);
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
			if ($isPost && isset($_POST["rm_id"]))
				$arKeys[] = ew_StripSlashes($_POST["rm_id"]);
			elseif (isset($_GET["rm_id"]))
				$arKeys[] = ew_StripSlashes($_GET["rm_id"]);
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
			$this->rm_id->CurrentValue = $key;
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

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
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

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// rm_id
		$this->rm_id->EditAttrs["class"] = "form-control";
		$this->rm_id->EditCustomAttributes = "";
		$this->rm_id->EditValue = $this->rm_id->CurrentValue;
		$this->rm_id->ViewCustomAttributes = "";

		// pegawai_id
		$this->pegawai_id->EditAttrs["class"] = "form-control";
		$this->pegawai_id->EditCustomAttributes = "";
		$this->pegawai_id->EditValue = $this->pegawai_id->CurrentValue;
		$this->pegawai_id->PlaceHolder = ew_RemoveHtml($this->pegawai_id->FldCaption());

		// f1
		$this->f1->EditAttrs["class"] = "form-control";
		$this->f1->EditCustomAttributes = "";
		$this->f1->EditValue = $this->f1->CurrentValue;
		$this->f1->PlaceHolder = ew_RemoveHtml($this->f1->FldCaption());

		// f2
		$this->f2->EditAttrs["class"] = "form-control";
		$this->f2->EditCustomAttributes = "";
		$this->f2->EditValue = $this->f2->CurrentValue;
		$this->f2->PlaceHolder = ew_RemoveHtml($this->f2->FldCaption());

		// f3
		$this->f3->EditAttrs["class"] = "form-control";
		$this->f3->EditCustomAttributes = "";
		$this->f3->EditValue = $this->f3->CurrentValue;
		$this->f3->PlaceHolder = ew_RemoveHtml($this->f3->FldCaption());

		// f4
		$this->f4->EditAttrs["class"] = "form-control";
		$this->f4->EditCustomAttributes = "";
		$this->f4->EditValue = $this->f4->CurrentValue;
		$this->f4->PlaceHolder = ew_RemoveHtml($this->f4->FldCaption());

		// f5
		$this->f5->EditAttrs["class"] = "form-control";
		$this->f5->EditCustomAttributes = "";
		$this->f5->EditValue = $this->f5->CurrentValue;
		$this->f5->PlaceHolder = ew_RemoveHtml($this->f5->FldCaption());

		// f6
		$this->f6->EditAttrs["class"] = "form-control";
		$this->f6->EditCustomAttributes = "";
		$this->f6->EditValue = $this->f6->CurrentValue;
		$this->f6->PlaceHolder = ew_RemoveHtml($this->f6->FldCaption());

		// f7
		$this->f7->EditAttrs["class"] = "form-control";
		$this->f7->EditCustomAttributes = "";
		$this->f7->EditValue = $this->f7->CurrentValue;
		$this->f7->PlaceHolder = ew_RemoveHtml($this->f7->FldCaption());

		// f8
		$this->f8->EditAttrs["class"] = "form-control";
		$this->f8->EditCustomAttributes = "";
		$this->f8->EditValue = $this->f8->CurrentValue;
		$this->f8->PlaceHolder = ew_RemoveHtml($this->f8->FldCaption());

		// f9
		$this->f9->EditAttrs["class"] = "form-control";
		$this->f9->EditCustomAttributes = "";
		$this->f9->EditValue = $this->f9->CurrentValue;
		$this->f9->PlaceHolder = ew_RemoveHtml($this->f9->FldCaption());

		// f10
		$this->f10->EditAttrs["class"] = "form-control";
		$this->f10->EditCustomAttributes = "";
		$this->f10->EditValue = $this->f10->CurrentValue;
		$this->f10->PlaceHolder = ew_RemoveHtml($this->f10->FldCaption());

		// f11
		$this->f11->EditAttrs["class"] = "form-control";
		$this->f11->EditCustomAttributes = "";
		$this->f11->EditValue = $this->f11->CurrentValue;
		$this->f11->PlaceHolder = ew_RemoveHtml($this->f11->FldCaption());

		// f12
		$this->f12->EditAttrs["class"] = "form-control";
		$this->f12->EditCustomAttributes = "";
		$this->f12->EditValue = $this->f12->CurrentValue;
		$this->f12->PlaceHolder = ew_RemoveHtml($this->f12->FldCaption());

		// f13
		$this->f13->EditAttrs["class"] = "form-control";
		$this->f13->EditCustomAttributes = "";
		$this->f13->EditValue = $this->f13->CurrentValue;
		$this->f13->PlaceHolder = ew_RemoveHtml($this->f13->FldCaption());

		// f14
		$this->f14->EditAttrs["class"] = "form-control";
		$this->f14->EditCustomAttributes = "";
		$this->f14->EditValue = $this->f14->CurrentValue;
		$this->f14->PlaceHolder = ew_RemoveHtml($this->f14->FldCaption());

		// f15
		$this->f15->EditAttrs["class"] = "form-control";
		$this->f15->EditCustomAttributes = "";
		$this->f15->EditValue = $this->f15->CurrentValue;
		$this->f15->PlaceHolder = ew_RemoveHtml($this->f15->FldCaption());

		// f16
		$this->f16->EditAttrs["class"] = "form-control";
		$this->f16->EditCustomAttributes = "";
		$this->f16->EditValue = $this->f16->CurrentValue;
		$this->f16->PlaceHolder = ew_RemoveHtml($this->f16->FldCaption());

		// f17
		$this->f17->EditAttrs["class"] = "form-control";
		$this->f17->EditCustomAttributes = "";
		$this->f17->EditValue = $this->f17->CurrentValue;
		$this->f17->PlaceHolder = ew_RemoveHtml($this->f17->FldCaption());

		// f18
		$this->f18->EditAttrs["class"] = "form-control";
		$this->f18->EditCustomAttributes = "";
		$this->f18->EditValue = $this->f18->CurrentValue;
		$this->f18->PlaceHolder = ew_RemoveHtml($this->f18->FldCaption());

		// f19
		$this->f19->EditAttrs["class"] = "form-control";
		$this->f19->EditCustomAttributes = "";
		$this->f19->EditValue = $this->f19->CurrentValue;
		$this->f19->PlaceHolder = ew_RemoveHtml($this->f19->FldCaption());

		// f20
		$this->f20->EditAttrs["class"] = "form-control";
		$this->f20->EditCustomAttributes = "";
		$this->f20->EditValue = $this->f20->CurrentValue;
		$this->f20->PlaceHolder = ew_RemoveHtml($this->f20->FldCaption());

		// f21
		$this->f21->EditAttrs["class"] = "form-control";
		$this->f21->EditCustomAttributes = "";
		$this->f21->EditValue = $this->f21->CurrentValue;
		$this->f21->PlaceHolder = ew_RemoveHtml($this->f21->FldCaption());

		// f22
		$this->f22->EditAttrs["class"] = "form-control";
		$this->f22->EditCustomAttributes = "";
		$this->f22->EditValue = $this->f22->CurrentValue;
		$this->f22->PlaceHolder = ew_RemoveHtml($this->f22->FldCaption());

		// f23
		$this->f23->EditAttrs["class"] = "form-control";
		$this->f23->EditCustomAttributes = "";
		$this->f23->EditValue = $this->f23->CurrentValue;
		$this->f23->PlaceHolder = ew_RemoveHtml($this->f23->FldCaption());

		// f24
		$this->f24->EditAttrs["class"] = "form-control";
		$this->f24->EditCustomAttributes = "";
		$this->f24->EditValue = $this->f24->CurrentValue;
		$this->f24->PlaceHolder = ew_RemoveHtml($this->f24->FldCaption());

		// f25
		$this->f25->EditAttrs["class"] = "form-control";
		$this->f25->EditCustomAttributes = "";
		$this->f25->EditValue = $this->f25->CurrentValue;
		$this->f25->PlaceHolder = ew_RemoveHtml($this->f25->FldCaption());

		// f26
		$this->f26->EditAttrs["class"] = "form-control";
		$this->f26->EditCustomAttributes = "";
		$this->f26->EditValue = $this->f26->CurrentValue;
		$this->f26->PlaceHolder = ew_RemoveHtml($this->f26->FldCaption());

		// f27
		$this->f27->EditAttrs["class"] = "form-control";
		$this->f27->EditCustomAttributes = "";
		$this->f27->EditValue = $this->f27->CurrentValue;
		$this->f27->PlaceHolder = ew_RemoveHtml($this->f27->FldCaption());

		// f28
		$this->f28->EditAttrs["class"] = "form-control";
		$this->f28->EditCustomAttributes = "";
		$this->f28->EditValue = $this->f28->CurrentValue;
		$this->f28->PlaceHolder = ew_RemoveHtml($this->f28->FldCaption());

		// f29
		$this->f29->EditAttrs["class"] = "form-control";
		$this->f29->EditCustomAttributes = "";
		$this->f29->EditValue = $this->f29->CurrentValue;
		$this->f29->PlaceHolder = ew_RemoveHtml($this->f29->FldCaption());

		// f30
		$this->f30->EditAttrs["class"] = "form-control";
		$this->f30->EditCustomAttributes = "";
		$this->f30->EditValue = $this->f30->CurrentValue;
		$this->f30->PlaceHolder = ew_RemoveHtml($this->f30->FldCaption());

		// f31
		$this->f31->EditAttrs["class"] = "form-control";
		$this->f31->EditCustomAttributes = "";
		$this->f31->EditValue = $this->f31->CurrentValue;
		$this->f31->PlaceHolder = ew_RemoveHtml($this->f31->FldCaption());

		// f32
		$this->f32->EditAttrs["class"] = "form-control";
		$this->f32->EditCustomAttributes = "";
		$this->f32->EditValue = ew_FormatDateTime($this->f32->CurrentValue, 8);
		$this->f32->PlaceHolder = ew_RemoveHtml($this->f32->FldCaption());

		// f33
		$this->f33->EditAttrs["class"] = "form-control";
		$this->f33->EditCustomAttributes = "";
		$this->f33->EditValue = ew_FormatDateTime($this->f33->CurrentValue, 8);
		$this->f33->PlaceHolder = ew_RemoveHtml($this->f33->FldCaption());

		// f34
		$this->f34->EditAttrs["class"] = "form-control";
		$this->f34->EditCustomAttributes = "";
		$this->f34->EditValue = ew_FormatDateTime($this->f34->CurrentValue, 8);
		$this->f34->PlaceHolder = ew_RemoveHtml($this->f34->FldCaption());

		// f35
		$this->f35->EditAttrs["class"] = "form-control";
		$this->f35->EditCustomAttributes = "";
		$this->f35->EditValue = ew_FormatDateTime($this->f35->CurrentValue, 8);
		$this->f35->PlaceHolder = ew_RemoveHtml($this->f35->FldCaption());

		// f36
		$this->f36->EditAttrs["class"] = "form-control";
		$this->f36->EditCustomAttributes = "";
		$this->f36->EditValue = ew_FormatDateTime($this->f36->CurrentValue, 8);
		$this->f36->PlaceHolder = ew_RemoveHtml($this->f36->FldCaption());

		// f37
		$this->f37->EditAttrs["class"] = "form-control";
		$this->f37->EditCustomAttributes = "";
		$this->f37->EditValue = ew_FormatDateTime($this->f37->CurrentValue, 8);
		$this->f37->PlaceHolder = ew_RemoveHtml($this->f37->FldCaption());

		// f38
		$this->f38->EditAttrs["class"] = "form-control";
		$this->f38->EditCustomAttributes = "";
		$this->f38->EditValue = ew_FormatDateTime($this->f38->CurrentValue, 8);
		$this->f38->PlaceHolder = ew_RemoveHtml($this->f38->FldCaption());

		// f39
		$this->f39->EditAttrs["class"] = "form-control";
		$this->f39->EditCustomAttributes = "";
		$this->f39->EditValue = ew_FormatDateTime($this->f39->CurrentValue, 8);
		$this->f39->PlaceHolder = ew_RemoveHtml($this->f39->FldCaption());

		// f40
		$this->f40->EditAttrs["class"] = "form-control";
		$this->f40->EditCustomAttributes = "";
		$this->f40->EditValue = ew_FormatDateTime($this->f40->CurrentValue, 8);
		$this->f40->PlaceHolder = ew_RemoveHtml($this->f40->FldCaption());

		// f41
		$this->f41->EditAttrs["class"] = "form-control";
		$this->f41->EditCustomAttributes = "";
		$this->f41->EditValue = ew_FormatDateTime($this->f41->CurrentValue, 8);
		$this->f41->PlaceHolder = ew_RemoveHtml($this->f41->FldCaption());

		// f42
		$this->f42->EditAttrs["class"] = "form-control";
		$this->f42->EditCustomAttributes = "";
		$this->f42->EditValue = ew_FormatDateTime($this->f42->CurrentValue, 8);
		$this->f42->PlaceHolder = ew_RemoveHtml($this->f42->FldCaption());

		// f43
		$this->f43->EditAttrs["class"] = "form-control";
		$this->f43->EditCustomAttributes = "";
		$this->f43->EditValue = ew_FormatDateTime($this->f43->CurrentValue, 8);
		$this->f43->PlaceHolder = ew_RemoveHtml($this->f43->FldCaption());

		// f44
		$this->f44->EditAttrs["class"] = "form-control";
		$this->f44->EditCustomAttributes = "";
		$this->f44->EditValue = ew_FormatDateTime($this->f44->CurrentValue, 8);
		$this->f44->PlaceHolder = ew_RemoveHtml($this->f44->FldCaption());

		// f45
		$this->f45->EditAttrs["class"] = "form-control";
		$this->f45->EditCustomAttributes = "";
		$this->f45->EditValue = ew_FormatDateTime($this->f45->CurrentValue, 8);
		$this->f45->PlaceHolder = ew_RemoveHtml($this->f45->FldCaption());

		// f46
		$this->f46->EditAttrs["class"] = "form-control";
		$this->f46->EditCustomAttributes = "";
		$this->f46->EditValue = ew_FormatDateTime($this->f46->CurrentValue, 8);
		$this->f46->PlaceHolder = ew_RemoveHtml($this->f46->FldCaption());

		// f47
		$this->f47->EditAttrs["class"] = "form-control";
		$this->f47->EditCustomAttributes = "";
		$this->f47->EditValue = ew_FormatDateTime($this->f47->CurrentValue, 8);
		$this->f47->PlaceHolder = ew_RemoveHtml($this->f47->FldCaption());

		// f48
		$this->f48->EditAttrs["class"] = "form-control";
		$this->f48->EditCustomAttributes = "";
		$this->f48->EditValue = ew_FormatDateTime($this->f48->CurrentValue, 8);
		$this->f48->PlaceHolder = ew_RemoveHtml($this->f48->FldCaption());

		// f49
		$this->f49->EditAttrs["class"] = "form-control";
		$this->f49->EditCustomAttributes = "";
		$this->f49->EditValue = ew_FormatDateTime($this->f49->CurrentValue, 8);
		$this->f49->PlaceHolder = ew_RemoveHtml($this->f49->FldCaption());

		// f50
		$this->f50->EditAttrs["class"] = "form-control";
		$this->f50->EditCustomAttributes = "";
		$this->f50->EditValue = ew_FormatDateTime($this->f50->CurrentValue, 8);
		$this->f50->PlaceHolder = ew_RemoveHtml($this->f50->FldCaption());

		// f51
		$this->f51->EditAttrs["class"] = "form-control";
		$this->f51->EditCustomAttributes = "";
		$this->f51->EditValue = ew_FormatDateTime($this->f51->CurrentValue, 8);
		$this->f51->PlaceHolder = ew_RemoveHtml($this->f51->FldCaption());

		// f52
		$this->f52->EditAttrs["class"] = "form-control";
		$this->f52->EditCustomAttributes = "";
		$this->f52->EditValue = ew_FormatDateTime($this->f52->CurrentValue, 8);
		$this->f52->PlaceHolder = ew_RemoveHtml($this->f52->FldCaption());

		// f53
		$this->f53->EditAttrs["class"] = "form-control";
		$this->f53->EditCustomAttributes = "";
		$this->f53->EditValue = ew_FormatDateTime($this->f53->CurrentValue, 8);
		$this->f53->PlaceHolder = ew_RemoveHtml($this->f53->FldCaption());

		// f54
		$this->f54->EditAttrs["class"] = "form-control";
		$this->f54->EditCustomAttributes = "";
		$this->f54->EditValue = ew_FormatDateTime($this->f54->CurrentValue, 8);
		$this->f54->PlaceHolder = ew_RemoveHtml($this->f54->FldCaption());

		// f55
		$this->f55->EditAttrs["class"] = "form-control";
		$this->f55->EditCustomAttributes = "";
		$this->f55->EditValue = ew_FormatDateTime($this->f55->CurrentValue, 8);
		$this->f55->PlaceHolder = ew_RemoveHtml($this->f55->FldCaption());

		// f56
		$this->f56->EditAttrs["class"] = "form-control";
		$this->f56->EditCustomAttributes = "";
		$this->f56->EditValue = ew_FormatDateTime($this->f56->CurrentValue, 8);
		$this->f56->PlaceHolder = ew_RemoveHtml($this->f56->FldCaption());

		// f57
		$this->f57->EditAttrs["class"] = "form-control";
		$this->f57->EditCustomAttributes = "";
		$this->f57->EditValue = ew_FormatDateTime($this->f57->CurrentValue, 8);
		$this->f57->PlaceHolder = ew_RemoveHtml($this->f57->FldCaption());

		// f58
		$this->f58->EditAttrs["class"] = "form-control";
		$this->f58->EditCustomAttributes = "";
		$this->f58->EditValue = ew_FormatDateTime($this->f58->CurrentValue, 8);
		$this->f58->PlaceHolder = ew_RemoveHtml($this->f58->FldCaption());

		// f59
		$this->f59->EditAttrs["class"] = "form-control";
		$this->f59->EditCustomAttributes = "";
		$this->f59->EditValue = ew_FormatDateTime($this->f59->CurrentValue, 8);
		$this->f59->PlaceHolder = ew_RemoveHtml($this->f59->FldCaption());

		// f60
		$this->f60->EditAttrs["class"] = "form-control";
		$this->f60->EditCustomAttributes = "";
		$this->f60->EditValue = ew_FormatDateTime($this->f60->CurrentValue, 8);
		$this->f60->PlaceHolder = ew_RemoveHtml($this->f60->FldCaption());

		// f61
		$this->f61->EditAttrs["class"] = "form-control";
		$this->f61->EditCustomAttributes = "";
		$this->f61->EditValue = ew_FormatDateTime($this->f61->CurrentValue, 8);
		$this->f61->PlaceHolder = ew_RemoveHtml($this->f61->FldCaption());

		// f62
		$this->f62->EditAttrs["class"] = "form-control";
		$this->f62->EditCustomAttributes = "";
		$this->f62->EditValue = ew_FormatDateTime($this->f62->CurrentValue, 8);
		$this->f62->PlaceHolder = ew_RemoveHtml($this->f62->FldCaption());

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
					if ($this->rm_id->Exportable) $Doc->ExportCaption($this->rm_id);
					if ($this->pegawai_id->Exportable) $Doc->ExportCaption($this->pegawai_id);
					if ($this->f1->Exportable) $Doc->ExportCaption($this->f1);
					if ($this->f2->Exportable) $Doc->ExportCaption($this->f2);
					if ($this->f3->Exportable) $Doc->ExportCaption($this->f3);
					if ($this->f4->Exportable) $Doc->ExportCaption($this->f4);
					if ($this->f5->Exportable) $Doc->ExportCaption($this->f5);
					if ($this->f6->Exportable) $Doc->ExportCaption($this->f6);
					if ($this->f7->Exportable) $Doc->ExportCaption($this->f7);
					if ($this->f8->Exportable) $Doc->ExportCaption($this->f8);
					if ($this->f9->Exportable) $Doc->ExportCaption($this->f9);
					if ($this->f10->Exportable) $Doc->ExportCaption($this->f10);
					if ($this->f11->Exportable) $Doc->ExportCaption($this->f11);
					if ($this->f12->Exportable) $Doc->ExportCaption($this->f12);
					if ($this->f13->Exportable) $Doc->ExportCaption($this->f13);
					if ($this->f14->Exportable) $Doc->ExportCaption($this->f14);
					if ($this->f15->Exportable) $Doc->ExportCaption($this->f15);
					if ($this->f16->Exportable) $Doc->ExportCaption($this->f16);
					if ($this->f17->Exportable) $Doc->ExportCaption($this->f17);
					if ($this->f18->Exportable) $Doc->ExportCaption($this->f18);
					if ($this->f19->Exportable) $Doc->ExportCaption($this->f19);
					if ($this->f20->Exportable) $Doc->ExportCaption($this->f20);
					if ($this->f21->Exportable) $Doc->ExportCaption($this->f21);
					if ($this->f22->Exportable) $Doc->ExportCaption($this->f22);
					if ($this->f23->Exportable) $Doc->ExportCaption($this->f23);
					if ($this->f24->Exportable) $Doc->ExportCaption($this->f24);
					if ($this->f25->Exportable) $Doc->ExportCaption($this->f25);
					if ($this->f26->Exportable) $Doc->ExportCaption($this->f26);
					if ($this->f27->Exportable) $Doc->ExportCaption($this->f27);
					if ($this->f28->Exportable) $Doc->ExportCaption($this->f28);
					if ($this->f29->Exportable) $Doc->ExportCaption($this->f29);
					if ($this->f30->Exportable) $Doc->ExportCaption($this->f30);
					if ($this->f31->Exportable) $Doc->ExportCaption($this->f31);
					if ($this->f32->Exportable) $Doc->ExportCaption($this->f32);
					if ($this->f33->Exportable) $Doc->ExportCaption($this->f33);
					if ($this->f34->Exportable) $Doc->ExportCaption($this->f34);
					if ($this->f35->Exportable) $Doc->ExportCaption($this->f35);
					if ($this->f36->Exportable) $Doc->ExportCaption($this->f36);
					if ($this->f37->Exportable) $Doc->ExportCaption($this->f37);
					if ($this->f38->Exportable) $Doc->ExportCaption($this->f38);
					if ($this->f39->Exportable) $Doc->ExportCaption($this->f39);
					if ($this->f40->Exportable) $Doc->ExportCaption($this->f40);
					if ($this->f41->Exportable) $Doc->ExportCaption($this->f41);
					if ($this->f42->Exportable) $Doc->ExportCaption($this->f42);
					if ($this->f43->Exportable) $Doc->ExportCaption($this->f43);
					if ($this->f44->Exportable) $Doc->ExportCaption($this->f44);
					if ($this->f45->Exportable) $Doc->ExportCaption($this->f45);
					if ($this->f46->Exportable) $Doc->ExportCaption($this->f46);
					if ($this->f47->Exportable) $Doc->ExportCaption($this->f47);
					if ($this->f48->Exportable) $Doc->ExportCaption($this->f48);
					if ($this->f49->Exportable) $Doc->ExportCaption($this->f49);
					if ($this->f50->Exportable) $Doc->ExportCaption($this->f50);
					if ($this->f51->Exportable) $Doc->ExportCaption($this->f51);
					if ($this->f52->Exportable) $Doc->ExportCaption($this->f52);
					if ($this->f53->Exportable) $Doc->ExportCaption($this->f53);
					if ($this->f54->Exportable) $Doc->ExportCaption($this->f54);
					if ($this->f55->Exportable) $Doc->ExportCaption($this->f55);
					if ($this->f56->Exportable) $Doc->ExportCaption($this->f56);
					if ($this->f57->Exportable) $Doc->ExportCaption($this->f57);
					if ($this->f58->Exportable) $Doc->ExportCaption($this->f58);
					if ($this->f59->Exportable) $Doc->ExportCaption($this->f59);
					if ($this->f60->Exportable) $Doc->ExportCaption($this->f60);
					if ($this->f61->Exportable) $Doc->ExportCaption($this->f61);
					if ($this->f62->Exportable) $Doc->ExportCaption($this->f62);
				} else {
					if ($this->rm_id->Exportable) $Doc->ExportCaption($this->rm_id);
					if ($this->pegawai_id->Exportable) $Doc->ExportCaption($this->pegawai_id);
					if ($this->f1->Exportable) $Doc->ExportCaption($this->f1);
					if ($this->f2->Exportable) $Doc->ExportCaption($this->f2);
					if ($this->f3->Exportable) $Doc->ExportCaption($this->f3);
					if ($this->f4->Exportable) $Doc->ExportCaption($this->f4);
					if ($this->f5->Exportable) $Doc->ExportCaption($this->f5);
					if ($this->f6->Exportable) $Doc->ExportCaption($this->f6);
					if ($this->f7->Exportable) $Doc->ExportCaption($this->f7);
					if ($this->f8->Exportable) $Doc->ExportCaption($this->f8);
					if ($this->f9->Exportable) $Doc->ExportCaption($this->f9);
					if ($this->f10->Exportable) $Doc->ExportCaption($this->f10);
					if ($this->f11->Exportable) $Doc->ExportCaption($this->f11);
					if ($this->f12->Exportable) $Doc->ExportCaption($this->f12);
					if ($this->f13->Exportable) $Doc->ExportCaption($this->f13);
					if ($this->f14->Exportable) $Doc->ExportCaption($this->f14);
					if ($this->f15->Exportable) $Doc->ExportCaption($this->f15);
					if ($this->f16->Exportable) $Doc->ExportCaption($this->f16);
					if ($this->f17->Exportable) $Doc->ExportCaption($this->f17);
					if ($this->f18->Exportable) $Doc->ExportCaption($this->f18);
					if ($this->f19->Exportable) $Doc->ExportCaption($this->f19);
					if ($this->f20->Exportable) $Doc->ExportCaption($this->f20);
					if ($this->f21->Exportable) $Doc->ExportCaption($this->f21);
					if ($this->f22->Exportable) $Doc->ExportCaption($this->f22);
					if ($this->f23->Exportable) $Doc->ExportCaption($this->f23);
					if ($this->f24->Exportable) $Doc->ExportCaption($this->f24);
					if ($this->f25->Exportable) $Doc->ExportCaption($this->f25);
					if ($this->f26->Exportable) $Doc->ExportCaption($this->f26);
					if ($this->f27->Exportable) $Doc->ExportCaption($this->f27);
					if ($this->f28->Exportable) $Doc->ExportCaption($this->f28);
					if ($this->f29->Exportable) $Doc->ExportCaption($this->f29);
					if ($this->f30->Exportable) $Doc->ExportCaption($this->f30);
					if ($this->f31->Exportable) $Doc->ExportCaption($this->f31);
					if ($this->f32->Exportable) $Doc->ExportCaption($this->f32);
					if ($this->f33->Exportable) $Doc->ExportCaption($this->f33);
					if ($this->f34->Exportable) $Doc->ExportCaption($this->f34);
					if ($this->f35->Exportable) $Doc->ExportCaption($this->f35);
					if ($this->f36->Exportable) $Doc->ExportCaption($this->f36);
					if ($this->f37->Exportable) $Doc->ExportCaption($this->f37);
					if ($this->f38->Exportable) $Doc->ExportCaption($this->f38);
					if ($this->f39->Exportable) $Doc->ExportCaption($this->f39);
					if ($this->f40->Exportable) $Doc->ExportCaption($this->f40);
					if ($this->f41->Exportable) $Doc->ExportCaption($this->f41);
					if ($this->f42->Exportable) $Doc->ExportCaption($this->f42);
					if ($this->f43->Exportable) $Doc->ExportCaption($this->f43);
					if ($this->f44->Exportable) $Doc->ExportCaption($this->f44);
					if ($this->f45->Exportable) $Doc->ExportCaption($this->f45);
					if ($this->f46->Exportable) $Doc->ExportCaption($this->f46);
					if ($this->f47->Exportable) $Doc->ExportCaption($this->f47);
					if ($this->f48->Exportable) $Doc->ExportCaption($this->f48);
					if ($this->f49->Exportable) $Doc->ExportCaption($this->f49);
					if ($this->f50->Exportable) $Doc->ExportCaption($this->f50);
					if ($this->f51->Exportable) $Doc->ExportCaption($this->f51);
					if ($this->f52->Exportable) $Doc->ExportCaption($this->f52);
					if ($this->f53->Exportable) $Doc->ExportCaption($this->f53);
					if ($this->f54->Exportable) $Doc->ExportCaption($this->f54);
					if ($this->f55->Exportable) $Doc->ExportCaption($this->f55);
					if ($this->f56->Exportable) $Doc->ExportCaption($this->f56);
					if ($this->f57->Exportable) $Doc->ExportCaption($this->f57);
					if ($this->f58->Exportable) $Doc->ExportCaption($this->f58);
					if ($this->f59->Exportable) $Doc->ExportCaption($this->f59);
					if ($this->f60->Exportable) $Doc->ExportCaption($this->f60);
					if ($this->f61->Exportable) $Doc->ExportCaption($this->f61);
					if ($this->f62->Exportable) $Doc->ExportCaption($this->f62);
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
						if ($this->rm_id->Exportable) $Doc->ExportField($this->rm_id);
						if ($this->pegawai_id->Exportable) $Doc->ExportField($this->pegawai_id);
						if ($this->f1->Exportable) $Doc->ExportField($this->f1);
						if ($this->f2->Exportable) $Doc->ExportField($this->f2);
						if ($this->f3->Exportable) $Doc->ExportField($this->f3);
						if ($this->f4->Exportable) $Doc->ExportField($this->f4);
						if ($this->f5->Exportable) $Doc->ExportField($this->f5);
						if ($this->f6->Exportable) $Doc->ExportField($this->f6);
						if ($this->f7->Exportable) $Doc->ExportField($this->f7);
						if ($this->f8->Exportable) $Doc->ExportField($this->f8);
						if ($this->f9->Exportable) $Doc->ExportField($this->f9);
						if ($this->f10->Exportable) $Doc->ExportField($this->f10);
						if ($this->f11->Exportable) $Doc->ExportField($this->f11);
						if ($this->f12->Exportable) $Doc->ExportField($this->f12);
						if ($this->f13->Exportable) $Doc->ExportField($this->f13);
						if ($this->f14->Exportable) $Doc->ExportField($this->f14);
						if ($this->f15->Exportable) $Doc->ExportField($this->f15);
						if ($this->f16->Exportable) $Doc->ExportField($this->f16);
						if ($this->f17->Exportable) $Doc->ExportField($this->f17);
						if ($this->f18->Exportable) $Doc->ExportField($this->f18);
						if ($this->f19->Exportable) $Doc->ExportField($this->f19);
						if ($this->f20->Exportable) $Doc->ExportField($this->f20);
						if ($this->f21->Exportable) $Doc->ExportField($this->f21);
						if ($this->f22->Exportable) $Doc->ExportField($this->f22);
						if ($this->f23->Exportable) $Doc->ExportField($this->f23);
						if ($this->f24->Exportable) $Doc->ExportField($this->f24);
						if ($this->f25->Exportable) $Doc->ExportField($this->f25);
						if ($this->f26->Exportable) $Doc->ExportField($this->f26);
						if ($this->f27->Exportable) $Doc->ExportField($this->f27);
						if ($this->f28->Exportable) $Doc->ExportField($this->f28);
						if ($this->f29->Exportable) $Doc->ExportField($this->f29);
						if ($this->f30->Exportable) $Doc->ExportField($this->f30);
						if ($this->f31->Exportable) $Doc->ExportField($this->f31);
						if ($this->f32->Exportable) $Doc->ExportField($this->f32);
						if ($this->f33->Exportable) $Doc->ExportField($this->f33);
						if ($this->f34->Exportable) $Doc->ExportField($this->f34);
						if ($this->f35->Exportable) $Doc->ExportField($this->f35);
						if ($this->f36->Exportable) $Doc->ExportField($this->f36);
						if ($this->f37->Exportable) $Doc->ExportField($this->f37);
						if ($this->f38->Exportable) $Doc->ExportField($this->f38);
						if ($this->f39->Exportable) $Doc->ExportField($this->f39);
						if ($this->f40->Exportable) $Doc->ExportField($this->f40);
						if ($this->f41->Exportable) $Doc->ExportField($this->f41);
						if ($this->f42->Exportable) $Doc->ExportField($this->f42);
						if ($this->f43->Exportable) $Doc->ExportField($this->f43);
						if ($this->f44->Exportable) $Doc->ExportField($this->f44);
						if ($this->f45->Exportable) $Doc->ExportField($this->f45);
						if ($this->f46->Exportable) $Doc->ExportField($this->f46);
						if ($this->f47->Exportable) $Doc->ExportField($this->f47);
						if ($this->f48->Exportable) $Doc->ExportField($this->f48);
						if ($this->f49->Exportable) $Doc->ExportField($this->f49);
						if ($this->f50->Exportable) $Doc->ExportField($this->f50);
						if ($this->f51->Exportable) $Doc->ExportField($this->f51);
						if ($this->f52->Exportable) $Doc->ExportField($this->f52);
						if ($this->f53->Exportable) $Doc->ExportField($this->f53);
						if ($this->f54->Exportable) $Doc->ExportField($this->f54);
						if ($this->f55->Exportable) $Doc->ExportField($this->f55);
						if ($this->f56->Exportable) $Doc->ExportField($this->f56);
						if ($this->f57->Exportable) $Doc->ExportField($this->f57);
						if ($this->f58->Exportable) $Doc->ExportField($this->f58);
						if ($this->f59->Exportable) $Doc->ExportField($this->f59);
						if ($this->f60->Exportable) $Doc->ExportField($this->f60);
						if ($this->f61->Exportable) $Doc->ExportField($this->f61);
						if ($this->f62->Exportable) $Doc->ExportField($this->f62);
					} else {
						if ($this->rm_id->Exportable) $Doc->ExportField($this->rm_id);
						if ($this->pegawai_id->Exportable) $Doc->ExportField($this->pegawai_id);
						if ($this->f1->Exportable) $Doc->ExportField($this->f1);
						if ($this->f2->Exportable) $Doc->ExportField($this->f2);
						if ($this->f3->Exportable) $Doc->ExportField($this->f3);
						if ($this->f4->Exportable) $Doc->ExportField($this->f4);
						if ($this->f5->Exportable) $Doc->ExportField($this->f5);
						if ($this->f6->Exportable) $Doc->ExportField($this->f6);
						if ($this->f7->Exportable) $Doc->ExportField($this->f7);
						if ($this->f8->Exportable) $Doc->ExportField($this->f8);
						if ($this->f9->Exportable) $Doc->ExportField($this->f9);
						if ($this->f10->Exportable) $Doc->ExportField($this->f10);
						if ($this->f11->Exportable) $Doc->ExportField($this->f11);
						if ($this->f12->Exportable) $Doc->ExportField($this->f12);
						if ($this->f13->Exportable) $Doc->ExportField($this->f13);
						if ($this->f14->Exportable) $Doc->ExportField($this->f14);
						if ($this->f15->Exportable) $Doc->ExportField($this->f15);
						if ($this->f16->Exportable) $Doc->ExportField($this->f16);
						if ($this->f17->Exportable) $Doc->ExportField($this->f17);
						if ($this->f18->Exportable) $Doc->ExportField($this->f18);
						if ($this->f19->Exportable) $Doc->ExportField($this->f19);
						if ($this->f20->Exportable) $Doc->ExportField($this->f20);
						if ($this->f21->Exportable) $Doc->ExportField($this->f21);
						if ($this->f22->Exportable) $Doc->ExportField($this->f22);
						if ($this->f23->Exportable) $Doc->ExportField($this->f23);
						if ($this->f24->Exportable) $Doc->ExportField($this->f24);
						if ($this->f25->Exportable) $Doc->ExportField($this->f25);
						if ($this->f26->Exportable) $Doc->ExportField($this->f26);
						if ($this->f27->Exportable) $Doc->ExportField($this->f27);
						if ($this->f28->Exportable) $Doc->ExportField($this->f28);
						if ($this->f29->Exportable) $Doc->ExportField($this->f29);
						if ($this->f30->Exportable) $Doc->ExportField($this->f30);
						if ($this->f31->Exportable) $Doc->ExportField($this->f31);
						if ($this->f32->Exportable) $Doc->ExportField($this->f32);
						if ($this->f33->Exportable) $Doc->ExportField($this->f33);
						if ($this->f34->Exportable) $Doc->ExportField($this->f34);
						if ($this->f35->Exportable) $Doc->ExportField($this->f35);
						if ($this->f36->Exportable) $Doc->ExportField($this->f36);
						if ($this->f37->Exportable) $Doc->ExportField($this->f37);
						if ($this->f38->Exportable) $Doc->ExportField($this->f38);
						if ($this->f39->Exportable) $Doc->ExportField($this->f39);
						if ($this->f40->Exportable) $Doc->ExportField($this->f40);
						if ($this->f41->Exportable) $Doc->ExportField($this->f41);
						if ($this->f42->Exportable) $Doc->ExportField($this->f42);
						if ($this->f43->Exportable) $Doc->ExportField($this->f43);
						if ($this->f44->Exportable) $Doc->ExportField($this->f44);
						if ($this->f45->Exportable) $Doc->ExportField($this->f45);
						if ($this->f46->Exportable) $Doc->ExportField($this->f46);
						if ($this->f47->Exportable) $Doc->ExportField($this->f47);
						if ($this->f48->Exportable) $Doc->ExportField($this->f48);
						if ($this->f49->Exportable) $Doc->ExportField($this->f49);
						if ($this->f50->Exportable) $Doc->ExportField($this->f50);
						if ($this->f51->Exportable) $Doc->ExportField($this->f51);
						if ($this->f52->Exportable) $Doc->ExportField($this->f52);
						if ($this->f53->Exportable) $Doc->ExportField($this->f53);
						if ($this->f54->Exportable) $Doc->ExportField($this->f54);
						if ($this->f55->Exportable) $Doc->ExportField($this->f55);
						if ($this->f56->Exportable) $Doc->ExportField($this->f56);
						if ($this->f57->Exportable) $Doc->ExportField($this->f57);
						if ($this->f58->Exportable) $Doc->ExportField($this->f58);
						if ($this->f59->Exportable) $Doc->ExportField($this->f59);
						if ($this->f60->Exportable) $Doc->ExportField($this->f60);
						if ($this->f61->Exportable) $Doc->ExportField($this->f61);
						if ($this->f62->Exportable) $Doc->ExportField($this->f62);
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
