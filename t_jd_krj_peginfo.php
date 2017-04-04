<?php

// Global variable for table object
$t_jd_krj_peg = NULL;

//
// Table class for t_jd_krj_peg
//
class ct_jd_krj_peg extends cTable {
	var $AuditTrailOnAdd = TRUE;
	var $AuditTrailOnEdit = TRUE;
	var $AuditTrailOnDelete = TRUE;
	var $AuditTrailOnView = FALSE;
	var $AuditTrailOnViewData = FALSE;
	var $AuditTrailOnSearch = FALSE;
	var $jdwkrjpeg_id;
	var $pegawai_id;
	var $f20170101;
	var $f20170102;
	var $f20170103;
	var $f20170104;
	var $f20170105;
	var $f20170106;
	var $f20170107;
	var $f20170108;
	var $f20170109;
	var $f20170110;
	var $f20170111;
	var $f20170112;
	var $f20170113;
	var $f20170114;
	var $f20170115;
	var $f20170116;
	var $f20170117;
	var $f20170118;
	var $f20170119;
	var $f20170120;
	var $f20170121;
	var $f20170122;
	var $f20170123;
	var $f20170124;
	var $f20170125;
	var $f20170126;
	var $f20170127;
	var $f20170128;
	var $f20170129;
	var $f20170130;
	var $f20170131;
	var $f20170201;
	var $f20170202;
	var $f20170203;
	var $f20170204;
	var $f20170205;
	var $f20170206;
	var $f20170207;
	var $f20170208;
	var $f20170209;
	var $f20170210;
	var $f20170211;
	var $f20170212;
	var $f20170213;
	var $f20170214;
	var $f20170215;
	var $f20170216;
	var $f20170217;
	var $f20170218;
	var $f20170219;
	var $f20170220;
	var $f20170221;
	var $f20170222;
	var $f20170223;
	var $f20170224;
	var $f20170225;
	var $f20170226;
	var $f20170227;
	var $f20170228;
	var $f20170229;
	var $f20170301;
	var $f20170302;
	var $f20170303;
	var $f20170304;
	var $f20170305;
	var $f20170306;
	var $f20170307;
	var $f20170308;
	var $f20170309;
	var $f20170310;
	var $f20170311;
	var $f20170312;
	var $f20170313;
	var $f20170314;
	var $f20170315;
	var $f20170316;
	var $f20170317;
	var $f20170318;
	var $f20170319;
	var $f20170320;
	var $f20170321;
	var $f20170322;
	var $f20170323;
	var $f20170324;
	var $f20170325;
	var $f20170326;
	var $f20170327;
	var $f20170328;
	var $f20170329;
	var $f20170330;
	var $f20170331;
	var $f20170401;
	var $f20170402;
	var $f20170403;
	var $f20170404;
	var $f20170405;
	var $f20170406;
	var $f20170407;
	var $f20170408;
	var $f20170409;
	var $f20170410;
	var $f20170411;
	var $f20170412;
	var $f20170413;
	var $f20170414;
	var $f20170415;
	var $f20170416;
	var $f20170417;
	var $f20170418;
	var $f20170419;
	var $f20170420;
	var $f20170421;
	var $f20170422;
	var $f20170423;
	var $f20170424;
	var $f20170425;
	var $f20170426;
	var $f20170427;
	var $f20170428;
	var $f20170429;
	var $f20170430;
	var $f20170501;
	var $f20170502;
	var $f20170503;
	var $f20170504;
	var $f20170505;
	var $f20170506;
	var $f20170507;
	var $f20170508;
	var $f20170509;
	var $f20170510;
	var $f20170511;
	var $f20170512;
	var $f20170513;
	var $f20170514;
	var $f20170515;
	var $f20170516;
	var $f20170517;
	var $f20170518;
	var $f20170519;
	var $f20170520;
	var $f20170521;
	var $f20170522;
	var $f20170523;
	var $f20170524;
	var $f20170525;
	var $f20170526;
	var $f20170527;
	var $f20170528;
	var $f20170529;
	var $f20170530;
	var $f20170531;
	var $f20170601;
	var $f20170602;
	var $f20170603;
	var $f20170604;
	var $f20170605;
	var $f20170606;
	var $f20170607;
	var $f20170608;
	var $f20170609;
	var $f20170610;
	var $f20170611;
	var $f20170612;
	var $f20170613;
	var $f20170614;
	var $f20170615;
	var $f20170616;
	var $f20170617;
	var $f20170618;
	var $f20170619;
	var $f20170620;
	var $f20170621;
	var $f20170622;
	var $f20170623;
	var $f20170624;
	var $f20170625;
	var $f20170626;
	var $f20170627;
	var $f20170628;
	var $f20170629;
	var $f20170630;
	var $f20170701;
	var $f20170702;
	var $f20170703;
	var $f20170704;
	var $f20170705;
	var $f20170706;
	var $f20170707;
	var $f20170708;
	var $f20170709;
	var $f20170710;
	var $f20170711;
	var $f20170712;
	var $f20170713;
	var $f20170714;
	var $f20170715;
	var $f20170716;
	var $f20170717;
	var $f20170718;
	var $f20170719;
	var $f20170720;
	var $f20170721;
	var $f20170722;
	var $f20170723;
	var $f20170724;
	var $f20170725;
	var $f20170726;
	var $f20170727;
	var $f20170728;
	var $f20170729;
	var $f20170730;
	var $f20170731;
	var $f20170801;
	var $f20170802;
	var $f20170803;
	var $f20170804;
	var $f20170805;
	var $f20170806;
	var $f20170807;
	var $f20170808;
	var $f20170809;
	var $f20170810;
	var $f20170811;
	var $f20170812;
	var $f20170813;
	var $f20170814;
	var $f20170815;
	var $f20170816;
	var $f20170817;
	var $f20170818;
	var $f20170819;
	var $f20170820;
	var $f20170821;
	var $f20170822;
	var $f20170823;
	var $f20170824;
	var $f20170825;
	var $f20170826;
	var $f20170827;
	var $f20170828;
	var $f20170829;
	var $f20170830;
	var $f20170831;
	var $f20170901;
	var $f20170902;
	var $f20170903;
	var $f20170904;
	var $f20170905;
	var $f20170906;
	var $f20170907;
	var $f20170908;
	var $f20170909;
	var $f20170910;
	var $f20170911;
	var $f20170912;
	var $f20170913;
	var $f20170914;
	var $f20170915;
	var $f20170916;
	var $f20170917;
	var $f20170918;
	var $f20170919;
	var $f20170920;
	var $f20170921;
	var $f20170922;
	var $f20170923;
	var $f20170924;
	var $f20170925;
	var $f20170926;
	var $f20170927;
	var $f20170928;
	var $f20170929;
	var $f20170930;
	var $f20171001;
	var $f20171002;
	var $f20171003;
	var $f20171004;
	var $f20171005;
	var $f20171006;
	var $f20171007;
	var $f20171008;
	var $f20171009;
	var $f20171010;
	var $f20171011;
	var $f20171012;
	var $f20171013;
	var $f20171014;
	var $f20171015;
	var $f20171016;
	var $f20171017;
	var $f20171018;
	var $f20171019;
	var $f20171020;
	var $f20171021;
	var $f20171022;
	var $f20171023;
	var $f20171024;
	var $f20171025;
	var $f20171026;
	var $f20171027;
	var $f20171028;
	var $f20171029;
	var $f20171030;
	var $f20171031;
	var $f20171101;
	var $f20171102;
	var $f20171103;
	var $f20171104;
	var $f20171105;
	var $f20171106;
	var $f20171107;
	var $f20171108;
	var $f20171109;
	var $f20171110;
	var $f20171111;
	var $f20171112;
	var $f20171113;
	var $f20171114;
	var $f20171115;
	var $f20171116;
	var $f20171117;
	var $f20171118;
	var $f20171119;
	var $f20171120;
	var $f20171121;
	var $f20171122;
	var $f20171123;
	var $f20171124;
	var $f20171125;
	var $f20171126;
	var $f20171127;
	var $f20171128;
	var $f20171129;
	var $f20171130;
	var $f20171201;
	var $f20171202;
	var $f20171203;
	var $f20171204;
	var $f20171205;
	var $f20171206;
	var $f20171207;
	var $f20171208;
	var $f20171209;
	var $f20171210;
	var $f20171211;
	var $f20171212;
	var $f20171213;
	var $f20171214;
	var $f20171215;
	var $f20171216;
	var $f20171217;
	var $f20171218;
	var $f20171219;
	var $f20171220;
	var $f20171221;
	var $f20171222;
	var $f20171223;
	var $f20171224;
	var $f20171225;
	var $f20171226;
	var $f20171227;
	var $f20171228;
	var $f20171229;
	var $f20171230;
	var $f20171231;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 't_jd_krj_peg';
		$this->TableName = 't_jd_krj_peg';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`t_jd_krj_peg`";
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

		// jdwkrjpeg_id
		$this->jdwkrjpeg_id = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_jdwkrjpeg_id', 'jdwkrjpeg_id', '`jdwkrjpeg_id`', '`jdwkrjpeg_id`', 3, -1, FALSE, '`jdwkrjpeg_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->jdwkrjpeg_id->Sortable = TRUE; // Allow sort
		$this->jdwkrjpeg_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['jdwkrjpeg_id'] = &$this->jdwkrjpeg_id;

		// pegawai_id
		$this->pegawai_id = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_pegawai_id', 'pegawai_id', '`pegawai_id`', '`pegawai_id`', 3, -1, FALSE, '`EV__pegawai_id`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->pegawai_id->Sortable = TRUE; // Allow sort
		$this->pegawai_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pegawai_id'] = &$this->pegawai_id;

		// f20170101
		$this->f20170101 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170101', 'f20170101', '`f20170101`', '`f20170101`', 3, -1, FALSE, '`f20170101`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170101->Sortable = TRUE; // Allow sort
		$this->f20170101->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170101'] = &$this->f20170101;

		// f20170102
		$this->f20170102 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170102', 'f20170102', '`f20170102`', '`f20170102`', 3, -1, FALSE, '`EV__f20170102`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170102->Sortable = TRUE; // Allow sort
		$this->f20170102->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170102'] = &$this->f20170102;

		// f20170103
		$this->f20170103 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170103', 'f20170103', '`f20170103`', '`f20170103`', 3, -1, FALSE, '`f20170103`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170103->Sortable = TRUE; // Allow sort
		$this->f20170103->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170103'] = &$this->f20170103;

		// f20170104
		$this->f20170104 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170104', 'f20170104', '`f20170104`', '`f20170104`', 3, -1, FALSE, '`f20170104`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170104->Sortable = TRUE; // Allow sort
		$this->f20170104->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170104'] = &$this->f20170104;

		// f20170105
		$this->f20170105 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170105', 'f20170105', '`f20170105`', '`f20170105`', 3, -1, FALSE, '`f20170105`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170105->Sortable = TRUE; // Allow sort
		$this->f20170105->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170105'] = &$this->f20170105;

		// f20170106
		$this->f20170106 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170106', 'f20170106', '`f20170106`', '`f20170106`', 3, -1, FALSE, '`f20170106`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170106->Sortable = TRUE; // Allow sort
		$this->f20170106->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170106'] = &$this->f20170106;

		// f20170107
		$this->f20170107 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170107', 'f20170107', '`f20170107`', '`f20170107`', 3, -1, FALSE, '`f20170107`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170107->Sortable = TRUE; // Allow sort
		$this->f20170107->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170107'] = &$this->f20170107;

		// f20170108
		$this->f20170108 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170108', 'f20170108', '`f20170108`', '`f20170108`', 3, -1, FALSE, '`f20170108`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170108->Sortable = TRUE; // Allow sort
		$this->f20170108->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170108'] = &$this->f20170108;

		// f20170109
		$this->f20170109 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170109', 'f20170109', '`f20170109`', '`f20170109`', 3, -1, FALSE, '`f20170109`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170109->Sortable = TRUE; // Allow sort
		$this->f20170109->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170109'] = &$this->f20170109;

		// f20170110
		$this->f20170110 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170110', 'f20170110', '`f20170110`', '`f20170110`', 3, -1, FALSE, '`f20170110`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170110->Sortable = TRUE; // Allow sort
		$this->f20170110->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170110'] = &$this->f20170110;

		// f20170111
		$this->f20170111 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170111', 'f20170111', '`f20170111`', '`f20170111`', 3, -1, FALSE, '`f20170111`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170111->Sortable = TRUE; // Allow sort
		$this->f20170111->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170111'] = &$this->f20170111;

		// f20170112
		$this->f20170112 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170112', 'f20170112', '`f20170112`', '`f20170112`', 3, -1, FALSE, '`f20170112`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170112->Sortable = TRUE; // Allow sort
		$this->f20170112->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170112'] = &$this->f20170112;

		// f20170113
		$this->f20170113 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170113', 'f20170113', '`f20170113`', '`f20170113`', 3, -1, FALSE, '`f20170113`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170113->Sortable = TRUE; // Allow sort
		$this->f20170113->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170113'] = &$this->f20170113;

		// f20170114
		$this->f20170114 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170114', 'f20170114', '`f20170114`', '`f20170114`', 3, -1, FALSE, '`f20170114`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170114->Sortable = TRUE; // Allow sort
		$this->f20170114->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170114'] = &$this->f20170114;

		// f20170115
		$this->f20170115 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170115', 'f20170115', '`f20170115`', '`f20170115`', 3, -1, FALSE, '`f20170115`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170115->Sortable = TRUE; // Allow sort
		$this->f20170115->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170115'] = &$this->f20170115;

		// f20170116
		$this->f20170116 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170116', 'f20170116', '`f20170116`', '`f20170116`', 3, -1, FALSE, '`f20170116`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170116->Sortable = TRUE; // Allow sort
		$this->f20170116->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170116'] = &$this->f20170116;

		// f20170117
		$this->f20170117 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170117', 'f20170117', '`f20170117`', '`f20170117`', 3, -1, FALSE, '`f20170117`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170117->Sortable = TRUE; // Allow sort
		$this->f20170117->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170117'] = &$this->f20170117;

		// f20170118
		$this->f20170118 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170118', 'f20170118', '`f20170118`', '`f20170118`', 3, -1, FALSE, '`f20170118`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170118->Sortable = TRUE; // Allow sort
		$this->f20170118->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170118'] = &$this->f20170118;

		// f20170119
		$this->f20170119 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170119', 'f20170119', '`f20170119`', '`f20170119`', 3, -1, FALSE, '`f20170119`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170119->Sortable = TRUE; // Allow sort
		$this->f20170119->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170119'] = &$this->f20170119;

		// f20170120
		$this->f20170120 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170120', 'f20170120', '`f20170120`', '`f20170120`', 3, -1, FALSE, '`f20170120`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170120->Sortable = TRUE; // Allow sort
		$this->f20170120->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170120'] = &$this->f20170120;

		// f20170121
		$this->f20170121 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170121', 'f20170121', '`f20170121`', '`f20170121`', 3, -1, FALSE, '`f20170121`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170121->Sortable = TRUE; // Allow sort
		$this->f20170121->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170121'] = &$this->f20170121;

		// f20170122
		$this->f20170122 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170122', 'f20170122', '`f20170122`', '`f20170122`', 3, -1, FALSE, '`f20170122`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170122->Sortable = TRUE; // Allow sort
		$this->f20170122->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170122'] = &$this->f20170122;

		// f20170123
		$this->f20170123 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170123', 'f20170123', '`f20170123`', '`f20170123`', 3, -1, FALSE, '`f20170123`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170123->Sortable = TRUE; // Allow sort
		$this->f20170123->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170123'] = &$this->f20170123;

		// f20170124
		$this->f20170124 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170124', 'f20170124', '`f20170124`', '`f20170124`', 3, -1, FALSE, '`f20170124`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170124->Sortable = TRUE; // Allow sort
		$this->f20170124->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170124'] = &$this->f20170124;

		// f20170125
		$this->f20170125 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170125', 'f20170125', '`f20170125`', '`f20170125`', 3, -1, FALSE, '`f20170125`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170125->Sortable = TRUE; // Allow sort
		$this->f20170125->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170125'] = &$this->f20170125;

		// f20170126
		$this->f20170126 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170126', 'f20170126', '`f20170126`', '`f20170126`', 3, -1, FALSE, '`f20170126`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170126->Sortable = TRUE; // Allow sort
		$this->f20170126->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170126'] = &$this->f20170126;

		// f20170127
		$this->f20170127 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170127', 'f20170127', '`f20170127`', '`f20170127`', 3, -1, FALSE, '`f20170127`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170127->Sortable = TRUE; // Allow sort
		$this->f20170127->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170127'] = &$this->f20170127;

		// f20170128
		$this->f20170128 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170128', 'f20170128', '`f20170128`', '`f20170128`', 3, -1, FALSE, '`f20170128`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170128->Sortable = TRUE; // Allow sort
		$this->f20170128->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170128'] = &$this->f20170128;

		// f20170129
		$this->f20170129 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170129', 'f20170129', '`f20170129`', '`f20170129`', 3, -1, FALSE, '`f20170129`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170129->Sortable = TRUE; // Allow sort
		$this->f20170129->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170129'] = &$this->f20170129;

		// f20170130
		$this->f20170130 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170130', 'f20170130', '`f20170130`', '`f20170130`', 3, -1, FALSE, '`f20170130`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170130->Sortable = TRUE; // Allow sort
		$this->f20170130->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170130'] = &$this->f20170130;

		// f20170131
		$this->f20170131 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170131', 'f20170131', '`f20170131`', '`f20170131`', 3, -1, FALSE, '`f20170131`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170131->Sortable = TRUE; // Allow sort
		$this->f20170131->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170131'] = &$this->f20170131;

		// f20170201
		$this->f20170201 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170201', 'f20170201', '`f20170201`', '`f20170201`', 3, -1, FALSE, '`f20170201`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170201->Sortable = TRUE; // Allow sort
		$this->f20170201->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170201'] = &$this->f20170201;

		// f20170202
		$this->f20170202 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170202', 'f20170202', '`f20170202`', '`f20170202`', 3, -1, FALSE, '`f20170202`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170202->Sortable = TRUE; // Allow sort
		$this->f20170202->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170202'] = &$this->f20170202;

		// f20170203
		$this->f20170203 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170203', 'f20170203', '`f20170203`', '`f20170203`', 3, -1, FALSE, '`f20170203`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170203->Sortable = TRUE; // Allow sort
		$this->f20170203->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170203'] = &$this->f20170203;

		// f20170204
		$this->f20170204 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170204', 'f20170204', '`f20170204`', '`f20170204`', 3, -1, FALSE, '`f20170204`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170204->Sortable = TRUE; // Allow sort
		$this->f20170204->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170204'] = &$this->f20170204;

		// f20170205
		$this->f20170205 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170205', 'f20170205', '`f20170205`', '`f20170205`', 3, -1, FALSE, '`f20170205`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170205->Sortable = TRUE; // Allow sort
		$this->f20170205->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170205'] = &$this->f20170205;

		// f20170206
		$this->f20170206 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170206', 'f20170206', '`f20170206`', '`f20170206`', 3, -1, FALSE, '`f20170206`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170206->Sortable = TRUE; // Allow sort
		$this->f20170206->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170206'] = &$this->f20170206;

		// f20170207
		$this->f20170207 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170207', 'f20170207', '`f20170207`', '`f20170207`', 3, -1, FALSE, '`f20170207`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170207->Sortable = TRUE; // Allow sort
		$this->f20170207->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170207'] = &$this->f20170207;

		// f20170208
		$this->f20170208 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170208', 'f20170208', '`f20170208`', '`f20170208`', 3, -1, FALSE, '`f20170208`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170208->Sortable = TRUE; // Allow sort
		$this->f20170208->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170208'] = &$this->f20170208;

		// f20170209
		$this->f20170209 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170209', 'f20170209', '`f20170209`', '`f20170209`', 3, -1, FALSE, '`f20170209`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170209->Sortable = TRUE; // Allow sort
		$this->f20170209->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170209'] = &$this->f20170209;

		// f20170210
		$this->f20170210 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170210', 'f20170210', '`f20170210`', '`f20170210`', 3, -1, FALSE, '`f20170210`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170210->Sortable = TRUE; // Allow sort
		$this->f20170210->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170210'] = &$this->f20170210;

		// f20170211
		$this->f20170211 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170211', 'f20170211', '`f20170211`', '`f20170211`', 3, -1, FALSE, '`f20170211`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170211->Sortable = TRUE; // Allow sort
		$this->f20170211->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170211'] = &$this->f20170211;

		// f20170212
		$this->f20170212 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170212', 'f20170212', '`f20170212`', '`f20170212`', 3, -1, FALSE, '`f20170212`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170212->Sortable = TRUE; // Allow sort
		$this->f20170212->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170212'] = &$this->f20170212;

		// f20170213
		$this->f20170213 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170213', 'f20170213', '`f20170213`', '`f20170213`', 3, -1, FALSE, '`f20170213`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170213->Sortable = TRUE; // Allow sort
		$this->f20170213->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170213'] = &$this->f20170213;

		// f20170214
		$this->f20170214 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170214', 'f20170214', '`f20170214`', '`f20170214`', 3, -1, FALSE, '`f20170214`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170214->Sortable = TRUE; // Allow sort
		$this->f20170214->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170214'] = &$this->f20170214;

		// f20170215
		$this->f20170215 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170215', 'f20170215', '`f20170215`', '`f20170215`', 3, -1, FALSE, '`f20170215`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170215->Sortable = TRUE; // Allow sort
		$this->f20170215->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170215'] = &$this->f20170215;

		// f20170216
		$this->f20170216 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170216', 'f20170216', '`f20170216`', '`f20170216`', 3, -1, FALSE, '`f20170216`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170216->Sortable = TRUE; // Allow sort
		$this->f20170216->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170216'] = &$this->f20170216;

		// f20170217
		$this->f20170217 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170217', 'f20170217', '`f20170217`', '`f20170217`', 3, -1, FALSE, '`f20170217`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170217->Sortable = TRUE; // Allow sort
		$this->f20170217->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170217'] = &$this->f20170217;

		// f20170218
		$this->f20170218 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170218', 'f20170218', '`f20170218`', '`f20170218`', 3, -1, FALSE, '`f20170218`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170218->Sortable = TRUE; // Allow sort
		$this->f20170218->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170218'] = &$this->f20170218;

		// f20170219
		$this->f20170219 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170219', 'f20170219', '`f20170219`', '`f20170219`', 3, -1, FALSE, '`f20170219`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170219->Sortable = TRUE; // Allow sort
		$this->f20170219->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170219'] = &$this->f20170219;

		// f20170220
		$this->f20170220 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170220', 'f20170220', '`f20170220`', '`f20170220`', 3, -1, FALSE, '`f20170220`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170220->Sortable = TRUE; // Allow sort
		$this->f20170220->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170220'] = &$this->f20170220;

		// f20170221
		$this->f20170221 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170221', 'f20170221', '`f20170221`', '`f20170221`', 3, -1, FALSE, '`f20170221`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170221->Sortable = TRUE; // Allow sort
		$this->f20170221->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170221'] = &$this->f20170221;

		// f20170222
		$this->f20170222 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170222', 'f20170222', '`f20170222`', '`f20170222`', 3, -1, FALSE, '`f20170222`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170222->Sortable = TRUE; // Allow sort
		$this->f20170222->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170222'] = &$this->f20170222;

		// f20170223
		$this->f20170223 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170223', 'f20170223', '`f20170223`', '`f20170223`', 3, -1, FALSE, '`f20170223`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170223->Sortable = TRUE; // Allow sort
		$this->f20170223->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170223'] = &$this->f20170223;

		// f20170224
		$this->f20170224 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170224', 'f20170224', '`f20170224`', '`f20170224`', 3, -1, FALSE, '`f20170224`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170224->Sortable = TRUE; // Allow sort
		$this->f20170224->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170224'] = &$this->f20170224;

		// f20170225
		$this->f20170225 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170225', 'f20170225', '`f20170225`', '`f20170225`', 3, -1, FALSE, '`f20170225`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170225->Sortable = TRUE; // Allow sort
		$this->f20170225->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170225'] = &$this->f20170225;

		// f20170226
		$this->f20170226 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170226', 'f20170226', '`f20170226`', '`f20170226`', 3, -1, FALSE, '`f20170226`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170226->Sortable = TRUE; // Allow sort
		$this->f20170226->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170226'] = &$this->f20170226;

		// f20170227
		$this->f20170227 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170227', 'f20170227', '`f20170227`', '`f20170227`', 3, -1, FALSE, '`f20170227`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170227->Sortable = TRUE; // Allow sort
		$this->f20170227->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170227'] = &$this->f20170227;

		// f20170228
		$this->f20170228 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170228', 'f20170228', '`f20170228`', '`f20170228`', 3, -1, FALSE, '`f20170228`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170228->Sortable = TRUE; // Allow sort
		$this->f20170228->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170228'] = &$this->f20170228;

		// f20170229
		$this->f20170229 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170229', 'f20170229', '`f20170229`', '`f20170229`', 3, -1, FALSE, '`f20170229`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170229->Sortable = TRUE; // Allow sort
		$this->f20170229->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170229'] = &$this->f20170229;

		// f20170301
		$this->f20170301 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170301', 'f20170301', '`f20170301`', '`f20170301`', 3, -1, FALSE, '`f20170301`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170301->Sortable = TRUE; // Allow sort
		$this->f20170301->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170301'] = &$this->f20170301;

		// f20170302
		$this->f20170302 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170302', 'f20170302', '`f20170302`', '`f20170302`', 3, -1, FALSE, '`f20170302`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170302->Sortable = TRUE; // Allow sort
		$this->f20170302->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170302'] = &$this->f20170302;

		// f20170303
		$this->f20170303 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170303', 'f20170303', '`f20170303`', '`f20170303`', 3, -1, FALSE, '`f20170303`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170303->Sortable = TRUE; // Allow sort
		$this->f20170303->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170303'] = &$this->f20170303;

		// f20170304
		$this->f20170304 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170304', 'f20170304', '`f20170304`', '`f20170304`', 3, -1, FALSE, '`f20170304`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170304->Sortable = TRUE; // Allow sort
		$this->f20170304->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170304'] = &$this->f20170304;

		// f20170305
		$this->f20170305 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170305', 'f20170305', '`f20170305`', '`f20170305`', 3, -1, FALSE, '`f20170305`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170305->Sortable = TRUE; // Allow sort
		$this->f20170305->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170305'] = &$this->f20170305;

		// f20170306
		$this->f20170306 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170306', 'f20170306', '`f20170306`', '`f20170306`', 3, -1, FALSE, '`f20170306`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170306->Sortable = TRUE; // Allow sort
		$this->f20170306->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170306'] = &$this->f20170306;

		// f20170307
		$this->f20170307 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170307', 'f20170307', '`f20170307`', '`f20170307`', 3, -1, FALSE, '`f20170307`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170307->Sortable = TRUE; // Allow sort
		$this->f20170307->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170307'] = &$this->f20170307;

		// f20170308
		$this->f20170308 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170308', 'f20170308', '`f20170308`', '`f20170308`', 3, -1, FALSE, '`f20170308`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170308->Sortable = TRUE; // Allow sort
		$this->f20170308->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170308'] = &$this->f20170308;

		// f20170309
		$this->f20170309 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170309', 'f20170309', '`f20170309`', '`f20170309`', 3, -1, FALSE, '`f20170309`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170309->Sortable = TRUE; // Allow sort
		$this->f20170309->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170309'] = &$this->f20170309;

		// f20170310
		$this->f20170310 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170310', 'f20170310', '`f20170310`', '`f20170310`', 3, -1, FALSE, '`f20170310`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170310->Sortable = TRUE; // Allow sort
		$this->f20170310->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170310'] = &$this->f20170310;

		// f20170311
		$this->f20170311 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170311', 'f20170311', '`f20170311`', '`f20170311`', 3, -1, FALSE, '`f20170311`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170311->Sortable = TRUE; // Allow sort
		$this->f20170311->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170311'] = &$this->f20170311;

		// f20170312
		$this->f20170312 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170312', 'f20170312', '`f20170312`', '`f20170312`', 3, -1, FALSE, '`f20170312`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170312->Sortable = TRUE; // Allow sort
		$this->f20170312->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170312'] = &$this->f20170312;

		// f20170313
		$this->f20170313 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170313', 'f20170313', '`f20170313`', '`f20170313`', 3, -1, FALSE, '`f20170313`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170313->Sortable = TRUE; // Allow sort
		$this->f20170313->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170313'] = &$this->f20170313;

		// f20170314
		$this->f20170314 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170314', 'f20170314', '`f20170314`', '`f20170314`', 3, -1, FALSE, '`f20170314`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170314->Sortable = TRUE; // Allow sort
		$this->f20170314->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170314'] = &$this->f20170314;

		// f20170315
		$this->f20170315 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170315', 'f20170315', '`f20170315`', '`f20170315`', 3, -1, FALSE, '`f20170315`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170315->Sortable = TRUE; // Allow sort
		$this->f20170315->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170315'] = &$this->f20170315;

		// f20170316
		$this->f20170316 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170316', 'f20170316', '`f20170316`', '`f20170316`', 3, -1, FALSE, '`f20170316`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170316->Sortable = TRUE; // Allow sort
		$this->f20170316->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170316'] = &$this->f20170316;

		// f20170317
		$this->f20170317 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170317', 'f20170317', '`f20170317`', '`f20170317`', 3, -1, FALSE, '`f20170317`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170317->Sortable = TRUE; // Allow sort
		$this->f20170317->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170317'] = &$this->f20170317;

		// f20170318
		$this->f20170318 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170318', 'f20170318', '`f20170318`', '`f20170318`', 3, -1, FALSE, '`f20170318`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170318->Sortable = TRUE; // Allow sort
		$this->f20170318->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170318'] = &$this->f20170318;

		// f20170319
		$this->f20170319 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170319', 'f20170319', '`f20170319`', '`f20170319`', 3, -1, FALSE, '`f20170319`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170319->Sortable = TRUE; // Allow sort
		$this->f20170319->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170319'] = &$this->f20170319;

		// f20170320
		$this->f20170320 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170320', 'f20170320', '`f20170320`', '`f20170320`', 3, -1, FALSE, '`f20170320`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170320->Sortable = TRUE; // Allow sort
		$this->f20170320->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170320'] = &$this->f20170320;

		// f20170321
		$this->f20170321 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170321', 'f20170321', '`f20170321`', '`f20170321`', 3, -1, FALSE, '`f20170321`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170321->Sortable = TRUE; // Allow sort
		$this->f20170321->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170321'] = &$this->f20170321;

		// f20170322
		$this->f20170322 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170322', 'f20170322', '`f20170322`', '`f20170322`', 3, -1, FALSE, '`f20170322`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170322->Sortable = TRUE; // Allow sort
		$this->f20170322->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170322'] = &$this->f20170322;

		// f20170323
		$this->f20170323 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170323', 'f20170323', '`f20170323`', '`f20170323`', 3, -1, FALSE, '`f20170323`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170323->Sortable = TRUE; // Allow sort
		$this->f20170323->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170323'] = &$this->f20170323;

		// f20170324
		$this->f20170324 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170324', 'f20170324', '`f20170324`', '`f20170324`', 3, -1, FALSE, '`f20170324`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170324->Sortable = TRUE; // Allow sort
		$this->f20170324->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170324'] = &$this->f20170324;

		// f20170325
		$this->f20170325 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170325', 'f20170325', '`f20170325`', '`f20170325`', 3, -1, FALSE, '`f20170325`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170325->Sortable = TRUE; // Allow sort
		$this->f20170325->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170325'] = &$this->f20170325;

		// f20170326
		$this->f20170326 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170326', 'f20170326', '`f20170326`', '`f20170326`', 3, -1, FALSE, '`f20170326`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170326->Sortable = TRUE; // Allow sort
		$this->f20170326->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170326'] = &$this->f20170326;

		// f20170327
		$this->f20170327 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170327', 'f20170327', '`f20170327`', '`f20170327`', 3, -1, FALSE, '`f20170327`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170327->Sortable = TRUE; // Allow sort
		$this->f20170327->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170327'] = &$this->f20170327;

		// f20170328
		$this->f20170328 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170328', 'f20170328', '`f20170328`', '`f20170328`', 3, -1, FALSE, '`f20170328`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170328->Sortable = TRUE; // Allow sort
		$this->f20170328->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170328'] = &$this->f20170328;

		// f20170329
		$this->f20170329 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170329', 'f20170329', '`f20170329`', '`f20170329`', 3, -1, FALSE, '`f20170329`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170329->Sortable = TRUE; // Allow sort
		$this->f20170329->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170329'] = &$this->f20170329;

		// f20170330
		$this->f20170330 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170330', 'f20170330', '`f20170330`', '`f20170330`', 3, -1, FALSE, '`f20170330`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170330->Sortable = TRUE; // Allow sort
		$this->f20170330->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170330'] = &$this->f20170330;

		// f20170331
		$this->f20170331 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170331', 'f20170331', '`f20170331`', '`f20170331`', 3, -1, FALSE, '`f20170331`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170331->Sortable = TRUE; // Allow sort
		$this->f20170331->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170331'] = &$this->f20170331;

		// f20170401
		$this->f20170401 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170401', 'f20170401', '`f20170401`', '`f20170401`', 3, -1, FALSE, '`f20170401`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170401->Sortable = TRUE; // Allow sort
		$this->f20170401->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170401'] = &$this->f20170401;

		// f20170402
		$this->f20170402 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170402', 'f20170402', '`f20170402`', '`f20170402`', 3, -1, FALSE, '`f20170402`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170402->Sortable = TRUE; // Allow sort
		$this->f20170402->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170402'] = &$this->f20170402;

		// f20170403
		$this->f20170403 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170403', 'f20170403', '`f20170403`', '`f20170403`', 3, -1, FALSE, '`f20170403`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170403->Sortable = TRUE; // Allow sort
		$this->f20170403->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170403'] = &$this->f20170403;

		// f20170404
		$this->f20170404 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170404', 'f20170404', '`f20170404`', '`f20170404`', 3, -1, FALSE, '`f20170404`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170404->Sortable = TRUE; // Allow sort
		$this->f20170404->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170404'] = &$this->f20170404;

		// f20170405
		$this->f20170405 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170405', 'f20170405', '`f20170405`', '`f20170405`', 3, -1, FALSE, '`f20170405`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170405->Sortable = TRUE; // Allow sort
		$this->f20170405->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170405'] = &$this->f20170405;

		// f20170406
		$this->f20170406 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170406', 'f20170406', '`f20170406`', '`f20170406`', 3, -1, FALSE, '`f20170406`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170406->Sortable = TRUE; // Allow sort
		$this->f20170406->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170406'] = &$this->f20170406;

		// f20170407
		$this->f20170407 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170407', 'f20170407', '`f20170407`', '`f20170407`', 3, -1, FALSE, '`f20170407`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170407->Sortable = TRUE; // Allow sort
		$this->f20170407->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170407'] = &$this->f20170407;

		// f20170408
		$this->f20170408 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170408', 'f20170408', '`f20170408`', '`f20170408`', 3, -1, FALSE, '`f20170408`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170408->Sortable = TRUE; // Allow sort
		$this->f20170408->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170408'] = &$this->f20170408;

		// f20170409
		$this->f20170409 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170409', 'f20170409', '`f20170409`', '`f20170409`', 3, -1, FALSE, '`f20170409`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170409->Sortable = TRUE; // Allow sort
		$this->f20170409->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170409'] = &$this->f20170409;

		// f20170410
		$this->f20170410 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170410', 'f20170410', '`f20170410`', '`f20170410`', 3, -1, FALSE, '`f20170410`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170410->Sortable = TRUE; // Allow sort
		$this->f20170410->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170410'] = &$this->f20170410;

		// f20170411
		$this->f20170411 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170411', 'f20170411', '`f20170411`', '`f20170411`', 3, -1, FALSE, '`f20170411`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170411->Sortable = TRUE; // Allow sort
		$this->f20170411->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170411'] = &$this->f20170411;

		// f20170412
		$this->f20170412 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170412', 'f20170412', '`f20170412`', '`f20170412`', 3, -1, FALSE, '`f20170412`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170412->Sortable = TRUE; // Allow sort
		$this->f20170412->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170412'] = &$this->f20170412;

		// f20170413
		$this->f20170413 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170413', 'f20170413', '`f20170413`', '`f20170413`', 3, -1, FALSE, '`f20170413`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170413->Sortable = TRUE; // Allow sort
		$this->f20170413->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170413'] = &$this->f20170413;

		// f20170414
		$this->f20170414 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170414', 'f20170414', '`f20170414`', '`f20170414`', 3, -1, FALSE, '`f20170414`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170414->Sortable = TRUE; // Allow sort
		$this->f20170414->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170414'] = &$this->f20170414;

		// f20170415
		$this->f20170415 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170415', 'f20170415', '`f20170415`', '`f20170415`', 3, -1, FALSE, '`f20170415`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170415->Sortable = TRUE; // Allow sort
		$this->f20170415->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170415'] = &$this->f20170415;

		// f20170416
		$this->f20170416 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170416', 'f20170416', '`f20170416`', '`f20170416`', 3, -1, FALSE, '`f20170416`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170416->Sortable = TRUE; // Allow sort
		$this->f20170416->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170416'] = &$this->f20170416;

		// f20170417
		$this->f20170417 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170417', 'f20170417', '`f20170417`', '`f20170417`', 3, -1, FALSE, '`f20170417`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170417->Sortable = TRUE; // Allow sort
		$this->f20170417->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170417'] = &$this->f20170417;

		// f20170418
		$this->f20170418 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170418', 'f20170418', '`f20170418`', '`f20170418`', 3, -1, FALSE, '`f20170418`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170418->Sortable = TRUE; // Allow sort
		$this->f20170418->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170418'] = &$this->f20170418;

		// f20170419
		$this->f20170419 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170419', 'f20170419', '`f20170419`', '`f20170419`', 3, -1, FALSE, '`f20170419`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170419->Sortable = TRUE; // Allow sort
		$this->f20170419->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170419'] = &$this->f20170419;

		// f20170420
		$this->f20170420 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170420', 'f20170420', '`f20170420`', '`f20170420`', 3, -1, FALSE, '`f20170420`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170420->Sortable = TRUE; // Allow sort
		$this->f20170420->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170420'] = &$this->f20170420;

		// f20170421
		$this->f20170421 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170421', 'f20170421', '`f20170421`', '`f20170421`', 3, -1, FALSE, '`f20170421`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170421->Sortable = TRUE; // Allow sort
		$this->f20170421->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170421'] = &$this->f20170421;

		// f20170422
		$this->f20170422 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170422', 'f20170422', '`f20170422`', '`f20170422`', 3, -1, FALSE, '`f20170422`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170422->Sortable = TRUE; // Allow sort
		$this->f20170422->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170422'] = &$this->f20170422;

		// f20170423
		$this->f20170423 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170423', 'f20170423', '`f20170423`', '`f20170423`', 3, -1, FALSE, '`f20170423`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170423->Sortable = TRUE; // Allow sort
		$this->f20170423->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170423'] = &$this->f20170423;

		// f20170424
		$this->f20170424 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170424', 'f20170424', '`f20170424`', '`f20170424`', 3, -1, FALSE, '`f20170424`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170424->Sortable = TRUE; // Allow sort
		$this->f20170424->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170424'] = &$this->f20170424;

		// f20170425
		$this->f20170425 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170425', 'f20170425', '`f20170425`', '`f20170425`', 3, -1, FALSE, '`f20170425`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170425->Sortable = TRUE; // Allow sort
		$this->f20170425->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170425'] = &$this->f20170425;

		// f20170426
		$this->f20170426 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170426', 'f20170426', '`f20170426`', '`f20170426`', 3, -1, FALSE, '`f20170426`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170426->Sortable = TRUE; // Allow sort
		$this->f20170426->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170426'] = &$this->f20170426;

		// f20170427
		$this->f20170427 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170427', 'f20170427', '`f20170427`', '`f20170427`', 3, -1, FALSE, '`f20170427`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170427->Sortable = TRUE; // Allow sort
		$this->f20170427->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170427'] = &$this->f20170427;

		// f20170428
		$this->f20170428 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170428', 'f20170428', '`f20170428`', '`f20170428`', 3, -1, FALSE, '`f20170428`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170428->Sortable = TRUE; // Allow sort
		$this->f20170428->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170428'] = &$this->f20170428;

		// f20170429
		$this->f20170429 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170429', 'f20170429', '`f20170429`', '`f20170429`', 3, -1, FALSE, '`f20170429`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170429->Sortable = TRUE; // Allow sort
		$this->f20170429->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170429'] = &$this->f20170429;

		// f20170430
		$this->f20170430 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170430', 'f20170430', '`f20170430`', '`f20170430`', 3, -1, FALSE, '`f20170430`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170430->Sortable = TRUE; // Allow sort
		$this->f20170430->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170430'] = &$this->f20170430;

		// f20170501
		$this->f20170501 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170501', 'f20170501', '`f20170501`', '`f20170501`', 3, -1, FALSE, '`f20170501`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170501->Sortable = TRUE; // Allow sort
		$this->f20170501->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170501'] = &$this->f20170501;

		// f20170502
		$this->f20170502 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170502', 'f20170502', '`f20170502`', '`f20170502`', 3, -1, FALSE, '`f20170502`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170502->Sortable = TRUE; // Allow sort
		$this->f20170502->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170502'] = &$this->f20170502;

		// f20170503
		$this->f20170503 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170503', 'f20170503', '`f20170503`', '`f20170503`', 3, -1, FALSE, '`f20170503`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170503->Sortable = TRUE; // Allow sort
		$this->f20170503->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170503'] = &$this->f20170503;

		// f20170504
		$this->f20170504 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170504', 'f20170504', '`f20170504`', '`f20170504`', 3, -1, FALSE, '`f20170504`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170504->Sortable = TRUE; // Allow sort
		$this->f20170504->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170504'] = &$this->f20170504;

		// f20170505
		$this->f20170505 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170505', 'f20170505', '`f20170505`', '`f20170505`', 3, -1, FALSE, '`f20170505`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170505->Sortable = TRUE; // Allow sort
		$this->f20170505->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170505'] = &$this->f20170505;

		// f20170506
		$this->f20170506 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170506', 'f20170506', '`f20170506`', '`f20170506`', 3, -1, FALSE, '`f20170506`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170506->Sortable = TRUE; // Allow sort
		$this->f20170506->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170506'] = &$this->f20170506;

		// f20170507
		$this->f20170507 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170507', 'f20170507', '`f20170507`', '`f20170507`', 3, -1, FALSE, '`f20170507`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170507->Sortable = TRUE; // Allow sort
		$this->f20170507->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170507'] = &$this->f20170507;

		// f20170508
		$this->f20170508 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170508', 'f20170508', '`f20170508`', '`f20170508`', 3, -1, FALSE, '`f20170508`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170508->Sortable = TRUE; // Allow sort
		$this->f20170508->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170508'] = &$this->f20170508;

		// f20170509
		$this->f20170509 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170509', 'f20170509', '`f20170509`', '`f20170509`', 3, -1, FALSE, '`f20170509`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170509->Sortable = TRUE; // Allow sort
		$this->f20170509->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170509'] = &$this->f20170509;

		// f20170510
		$this->f20170510 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170510', 'f20170510', '`f20170510`', '`f20170510`', 3, -1, FALSE, '`f20170510`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170510->Sortable = TRUE; // Allow sort
		$this->f20170510->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170510'] = &$this->f20170510;

		// f20170511
		$this->f20170511 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170511', 'f20170511', '`f20170511`', '`f20170511`', 3, -1, FALSE, '`f20170511`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170511->Sortable = TRUE; // Allow sort
		$this->f20170511->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170511'] = &$this->f20170511;

		// f20170512
		$this->f20170512 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170512', 'f20170512', '`f20170512`', '`f20170512`', 3, -1, FALSE, '`f20170512`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170512->Sortable = TRUE; // Allow sort
		$this->f20170512->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170512'] = &$this->f20170512;

		// f20170513
		$this->f20170513 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170513', 'f20170513', '`f20170513`', '`f20170513`', 3, -1, FALSE, '`f20170513`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170513->Sortable = TRUE; // Allow sort
		$this->f20170513->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170513'] = &$this->f20170513;

		// f20170514
		$this->f20170514 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170514', 'f20170514', '`f20170514`', '`f20170514`', 3, -1, FALSE, '`f20170514`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170514->Sortable = TRUE; // Allow sort
		$this->f20170514->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170514'] = &$this->f20170514;

		// f20170515
		$this->f20170515 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170515', 'f20170515', '`f20170515`', '`f20170515`', 3, -1, FALSE, '`f20170515`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170515->Sortable = TRUE; // Allow sort
		$this->f20170515->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170515'] = &$this->f20170515;

		// f20170516
		$this->f20170516 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170516', 'f20170516', '`f20170516`', '`f20170516`', 3, -1, FALSE, '`f20170516`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170516->Sortable = TRUE; // Allow sort
		$this->f20170516->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170516'] = &$this->f20170516;

		// f20170517
		$this->f20170517 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170517', 'f20170517', '`f20170517`', '`f20170517`', 3, -1, FALSE, '`f20170517`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170517->Sortable = TRUE; // Allow sort
		$this->f20170517->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170517'] = &$this->f20170517;

		// f20170518
		$this->f20170518 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170518', 'f20170518', '`f20170518`', '`f20170518`', 3, -1, FALSE, '`f20170518`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170518->Sortable = TRUE; // Allow sort
		$this->f20170518->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170518'] = &$this->f20170518;

		// f20170519
		$this->f20170519 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170519', 'f20170519', '`f20170519`', '`f20170519`', 3, -1, FALSE, '`f20170519`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170519->Sortable = TRUE; // Allow sort
		$this->f20170519->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170519'] = &$this->f20170519;

		// f20170520
		$this->f20170520 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170520', 'f20170520', '`f20170520`', '`f20170520`', 3, -1, FALSE, '`f20170520`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170520->Sortable = TRUE; // Allow sort
		$this->f20170520->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170520'] = &$this->f20170520;

		// f20170521
		$this->f20170521 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170521', 'f20170521', '`f20170521`', '`f20170521`', 3, -1, FALSE, '`f20170521`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170521->Sortable = TRUE; // Allow sort
		$this->f20170521->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170521'] = &$this->f20170521;

		// f20170522
		$this->f20170522 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170522', 'f20170522', '`f20170522`', '`f20170522`', 3, -1, FALSE, '`f20170522`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170522->Sortable = TRUE; // Allow sort
		$this->f20170522->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170522'] = &$this->f20170522;

		// f20170523
		$this->f20170523 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170523', 'f20170523', '`f20170523`', '`f20170523`', 3, -1, FALSE, '`f20170523`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170523->Sortable = TRUE; // Allow sort
		$this->f20170523->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170523'] = &$this->f20170523;

		// f20170524
		$this->f20170524 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170524', 'f20170524', '`f20170524`', '`f20170524`', 3, -1, FALSE, '`f20170524`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170524->Sortable = TRUE; // Allow sort
		$this->f20170524->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170524'] = &$this->f20170524;

		// f20170525
		$this->f20170525 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170525', 'f20170525', '`f20170525`', '`f20170525`', 3, -1, FALSE, '`f20170525`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170525->Sortable = TRUE; // Allow sort
		$this->f20170525->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170525'] = &$this->f20170525;

		// f20170526
		$this->f20170526 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170526', 'f20170526', '`f20170526`', '`f20170526`', 3, -1, FALSE, '`f20170526`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170526->Sortable = TRUE; // Allow sort
		$this->f20170526->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170526'] = &$this->f20170526;

		// f20170527
		$this->f20170527 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170527', 'f20170527', '`f20170527`', '`f20170527`', 3, -1, FALSE, '`f20170527`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170527->Sortable = TRUE; // Allow sort
		$this->f20170527->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170527'] = &$this->f20170527;

		// f20170528
		$this->f20170528 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170528', 'f20170528', '`f20170528`', '`f20170528`', 3, -1, FALSE, '`f20170528`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170528->Sortable = TRUE; // Allow sort
		$this->f20170528->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170528'] = &$this->f20170528;

		// f20170529
		$this->f20170529 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170529', 'f20170529', '`f20170529`', '`f20170529`', 3, -1, FALSE, '`f20170529`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170529->Sortable = TRUE; // Allow sort
		$this->f20170529->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170529'] = &$this->f20170529;

		// f20170530
		$this->f20170530 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170530', 'f20170530', '`f20170530`', '`f20170530`', 3, -1, FALSE, '`f20170530`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170530->Sortable = TRUE; // Allow sort
		$this->f20170530->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170530'] = &$this->f20170530;

		// f20170531
		$this->f20170531 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170531', 'f20170531', '`f20170531`', '`f20170531`', 3, -1, FALSE, '`f20170531`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170531->Sortable = TRUE; // Allow sort
		$this->f20170531->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170531'] = &$this->f20170531;

		// f20170601
		$this->f20170601 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170601', 'f20170601', '`f20170601`', '`f20170601`', 3, -1, FALSE, '`f20170601`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170601->Sortable = TRUE; // Allow sort
		$this->f20170601->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170601'] = &$this->f20170601;

		// f20170602
		$this->f20170602 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170602', 'f20170602', '`f20170602`', '`f20170602`', 3, -1, FALSE, '`f20170602`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170602->Sortable = TRUE; // Allow sort
		$this->f20170602->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170602'] = &$this->f20170602;

		// f20170603
		$this->f20170603 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170603', 'f20170603', '`f20170603`', '`f20170603`', 3, -1, FALSE, '`f20170603`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170603->Sortable = TRUE; // Allow sort
		$this->f20170603->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170603'] = &$this->f20170603;

		// f20170604
		$this->f20170604 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170604', 'f20170604', '`f20170604`', '`f20170604`', 3, -1, FALSE, '`f20170604`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170604->Sortable = TRUE; // Allow sort
		$this->f20170604->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170604'] = &$this->f20170604;

		// f20170605
		$this->f20170605 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170605', 'f20170605', '`f20170605`', '`f20170605`', 3, -1, FALSE, '`f20170605`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170605->Sortable = TRUE; // Allow sort
		$this->f20170605->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170605'] = &$this->f20170605;

		// f20170606
		$this->f20170606 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170606', 'f20170606', '`f20170606`', '`f20170606`', 3, -1, FALSE, '`f20170606`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170606->Sortable = TRUE; // Allow sort
		$this->f20170606->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170606'] = &$this->f20170606;

		// f20170607
		$this->f20170607 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170607', 'f20170607', '`f20170607`', '`f20170607`', 3, -1, FALSE, '`f20170607`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170607->Sortable = TRUE; // Allow sort
		$this->f20170607->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170607'] = &$this->f20170607;

		// f20170608
		$this->f20170608 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170608', 'f20170608', '`f20170608`', '`f20170608`', 3, -1, FALSE, '`f20170608`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170608->Sortable = TRUE; // Allow sort
		$this->f20170608->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170608'] = &$this->f20170608;

		// f20170609
		$this->f20170609 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170609', 'f20170609', '`f20170609`', '`f20170609`', 3, -1, FALSE, '`f20170609`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170609->Sortable = TRUE; // Allow sort
		$this->f20170609->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170609'] = &$this->f20170609;

		// f20170610
		$this->f20170610 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170610', 'f20170610', '`f20170610`', '`f20170610`', 3, -1, FALSE, '`f20170610`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170610->Sortable = TRUE; // Allow sort
		$this->f20170610->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170610'] = &$this->f20170610;

		// f20170611
		$this->f20170611 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170611', 'f20170611', '`f20170611`', '`f20170611`', 3, -1, FALSE, '`f20170611`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170611->Sortable = TRUE; // Allow sort
		$this->f20170611->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170611'] = &$this->f20170611;

		// f20170612
		$this->f20170612 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170612', 'f20170612', '`f20170612`', '`f20170612`', 3, -1, FALSE, '`f20170612`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170612->Sortable = TRUE; // Allow sort
		$this->f20170612->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170612'] = &$this->f20170612;

		// f20170613
		$this->f20170613 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170613', 'f20170613', '`f20170613`', '`f20170613`', 3, -1, FALSE, '`f20170613`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170613->Sortable = TRUE; // Allow sort
		$this->f20170613->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170613'] = &$this->f20170613;

		// f20170614
		$this->f20170614 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170614', 'f20170614', '`f20170614`', '`f20170614`', 3, -1, FALSE, '`f20170614`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170614->Sortable = TRUE; // Allow sort
		$this->f20170614->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170614'] = &$this->f20170614;

		// f20170615
		$this->f20170615 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170615', 'f20170615', '`f20170615`', '`f20170615`', 3, -1, FALSE, '`f20170615`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170615->Sortable = TRUE; // Allow sort
		$this->f20170615->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170615'] = &$this->f20170615;

		// f20170616
		$this->f20170616 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170616', 'f20170616', '`f20170616`', '`f20170616`', 3, -1, FALSE, '`f20170616`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170616->Sortable = TRUE; // Allow sort
		$this->f20170616->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170616'] = &$this->f20170616;

		// f20170617
		$this->f20170617 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170617', 'f20170617', '`f20170617`', '`f20170617`', 3, -1, FALSE, '`f20170617`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170617->Sortable = TRUE; // Allow sort
		$this->f20170617->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170617'] = &$this->f20170617;

		// f20170618
		$this->f20170618 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170618', 'f20170618', '`f20170618`', '`f20170618`', 3, -1, FALSE, '`f20170618`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170618->Sortable = TRUE; // Allow sort
		$this->f20170618->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170618'] = &$this->f20170618;

		// f20170619
		$this->f20170619 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170619', 'f20170619', '`f20170619`', '`f20170619`', 3, -1, FALSE, '`f20170619`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170619->Sortable = TRUE; // Allow sort
		$this->f20170619->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170619'] = &$this->f20170619;

		// f20170620
		$this->f20170620 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170620', 'f20170620', '`f20170620`', '`f20170620`', 3, -1, FALSE, '`f20170620`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170620->Sortable = TRUE; // Allow sort
		$this->f20170620->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170620'] = &$this->f20170620;

		// f20170621
		$this->f20170621 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170621', 'f20170621', '`f20170621`', '`f20170621`', 3, -1, FALSE, '`f20170621`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170621->Sortable = TRUE; // Allow sort
		$this->f20170621->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170621'] = &$this->f20170621;

		// f20170622
		$this->f20170622 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170622', 'f20170622', '`f20170622`', '`f20170622`', 3, -1, FALSE, '`f20170622`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170622->Sortable = TRUE; // Allow sort
		$this->f20170622->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170622'] = &$this->f20170622;

		// f20170623
		$this->f20170623 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170623', 'f20170623', '`f20170623`', '`f20170623`', 3, -1, FALSE, '`f20170623`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170623->Sortable = TRUE; // Allow sort
		$this->f20170623->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170623'] = &$this->f20170623;

		// f20170624
		$this->f20170624 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170624', 'f20170624', '`f20170624`', '`f20170624`', 3, -1, FALSE, '`f20170624`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170624->Sortable = TRUE; // Allow sort
		$this->f20170624->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170624'] = &$this->f20170624;

		// f20170625
		$this->f20170625 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170625', 'f20170625', '`f20170625`', '`f20170625`', 3, -1, FALSE, '`f20170625`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170625->Sortable = TRUE; // Allow sort
		$this->f20170625->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170625'] = &$this->f20170625;

		// f20170626
		$this->f20170626 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170626', 'f20170626', '`f20170626`', '`f20170626`', 3, -1, FALSE, '`f20170626`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170626->Sortable = TRUE; // Allow sort
		$this->f20170626->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170626'] = &$this->f20170626;

		// f20170627
		$this->f20170627 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170627', 'f20170627', '`f20170627`', '`f20170627`', 3, -1, FALSE, '`f20170627`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170627->Sortable = TRUE; // Allow sort
		$this->f20170627->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170627'] = &$this->f20170627;

		// f20170628
		$this->f20170628 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170628', 'f20170628', '`f20170628`', '`f20170628`', 3, -1, FALSE, '`f20170628`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170628->Sortable = TRUE; // Allow sort
		$this->f20170628->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170628'] = &$this->f20170628;

		// f20170629
		$this->f20170629 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170629', 'f20170629', '`f20170629`', '`f20170629`', 3, -1, FALSE, '`f20170629`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170629->Sortable = TRUE; // Allow sort
		$this->f20170629->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170629'] = &$this->f20170629;

		// f20170630
		$this->f20170630 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170630', 'f20170630', '`f20170630`', '`f20170630`', 3, -1, FALSE, '`f20170630`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170630->Sortable = TRUE; // Allow sort
		$this->f20170630->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170630'] = &$this->f20170630;

		// f20170701
		$this->f20170701 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170701', 'f20170701', '`f20170701`', '`f20170701`', 3, -1, FALSE, '`f20170701`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170701->Sortable = TRUE; // Allow sort
		$this->f20170701->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170701'] = &$this->f20170701;

		// f20170702
		$this->f20170702 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170702', 'f20170702', '`f20170702`', '`f20170702`', 3, -1, FALSE, '`f20170702`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170702->Sortable = TRUE; // Allow sort
		$this->f20170702->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170702'] = &$this->f20170702;

		// f20170703
		$this->f20170703 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170703', 'f20170703', '`f20170703`', '`f20170703`', 3, -1, FALSE, '`f20170703`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170703->Sortable = TRUE; // Allow sort
		$this->f20170703->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170703'] = &$this->f20170703;

		// f20170704
		$this->f20170704 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170704', 'f20170704', '`f20170704`', '`f20170704`', 3, -1, FALSE, '`f20170704`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170704->Sortable = TRUE; // Allow sort
		$this->f20170704->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170704'] = &$this->f20170704;

		// f20170705
		$this->f20170705 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170705', 'f20170705', '`f20170705`', '`f20170705`', 3, -1, FALSE, '`f20170705`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170705->Sortable = TRUE; // Allow sort
		$this->f20170705->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170705'] = &$this->f20170705;

		// f20170706
		$this->f20170706 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170706', 'f20170706', '`f20170706`', '`f20170706`', 3, -1, FALSE, '`f20170706`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170706->Sortable = TRUE; // Allow sort
		$this->f20170706->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170706'] = &$this->f20170706;

		// f20170707
		$this->f20170707 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170707', 'f20170707', '`f20170707`', '`f20170707`', 3, -1, FALSE, '`f20170707`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170707->Sortable = TRUE; // Allow sort
		$this->f20170707->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170707'] = &$this->f20170707;

		// f20170708
		$this->f20170708 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170708', 'f20170708', '`f20170708`', '`f20170708`', 3, -1, FALSE, '`f20170708`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170708->Sortable = TRUE; // Allow sort
		$this->f20170708->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170708'] = &$this->f20170708;

		// f20170709
		$this->f20170709 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170709', 'f20170709', '`f20170709`', '`f20170709`', 3, -1, FALSE, '`f20170709`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170709->Sortable = TRUE; // Allow sort
		$this->f20170709->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170709'] = &$this->f20170709;

		// f20170710
		$this->f20170710 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170710', 'f20170710', '`f20170710`', '`f20170710`', 3, -1, FALSE, '`f20170710`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170710->Sortable = TRUE; // Allow sort
		$this->f20170710->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170710'] = &$this->f20170710;

		// f20170711
		$this->f20170711 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170711', 'f20170711', '`f20170711`', '`f20170711`', 3, -1, FALSE, '`f20170711`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170711->Sortable = TRUE; // Allow sort
		$this->f20170711->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170711'] = &$this->f20170711;

		// f20170712
		$this->f20170712 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170712', 'f20170712', '`f20170712`', '`f20170712`', 3, -1, FALSE, '`f20170712`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170712->Sortable = TRUE; // Allow sort
		$this->f20170712->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170712'] = &$this->f20170712;

		// f20170713
		$this->f20170713 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170713', 'f20170713', '`f20170713`', '`f20170713`', 3, -1, FALSE, '`f20170713`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170713->Sortable = TRUE; // Allow sort
		$this->f20170713->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170713'] = &$this->f20170713;

		// f20170714
		$this->f20170714 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170714', 'f20170714', '`f20170714`', '`f20170714`', 3, -1, FALSE, '`f20170714`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170714->Sortable = TRUE; // Allow sort
		$this->f20170714->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170714'] = &$this->f20170714;

		// f20170715
		$this->f20170715 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170715', 'f20170715', '`f20170715`', '`f20170715`', 3, -1, FALSE, '`f20170715`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170715->Sortable = TRUE; // Allow sort
		$this->f20170715->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170715'] = &$this->f20170715;

		// f20170716
		$this->f20170716 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170716', 'f20170716', '`f20170716`', '`f20170716`', 3, -1, FALSE, '`f20170716`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170716->Sortable = TRUE; // Allow sort
		$this->f20170716->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170716'] = &$this->f20170716;

		// f20170717
		$this->f20170717 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170717', 'f20170717', '`f20170717`', '`f20170717`', 3, -1, FALSE, '`f20170717`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170717->Sortable = TRUE; // Allow sort
		$this->f20170717->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170717'] = &$this->f20170717;

		// f20170718
		$this->f20170718 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170718', 'f20170718', '`f20170718`', '`f20170718`', 3, -1, FALSE, '`f20170718`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170718->Sortable = TRUE; // Allow sort
		$this->f20170718->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170718'] = &$this->f20170718;

		// f20170719
		$this->f20170719 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170719', 'f20170719', '`f20170719`', '`f20170719`', 3, -1, FALSE, '`f20170719`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170719->Sortable = TRUE; // Allow sort
		$this->f20170719->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170719'] = &$this->f20170719;

		// f20170720
		$this->f20170720 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170720', 'f20170720', '`f20170720`', '`f20170720`', 3, -1, FALSE, '`f20170720`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170720->Sortable = TRUE; // Allow sort
		$this->f20170720->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170720'] = &$this->f20170720;

		// f20170721
		$this->f20170721 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170721', 'f20170721', '`f20170721`', '`f20170721`', 3, -1, FALSE, '`f20170721`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170721->Sortable = TRUE; // Allow sort
		$this->f20170721->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170721'] = &$this->f20170721;

		// f20170722
		$this->f20170722 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170722', 'f20170722', '`f20170722`', '`f20170722`', 3, -1, FALSE, '`f20170722`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170722->Sortable = TRUE; // Allow sort
		$this->f20170722->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170722'] = &$this->f20170722;

		// f20170723
		$this->f20170723 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170723', 'f20170723', '`f20170723`', '`f20170723`', 3, -1, FALSE, '`f20170723`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170723->Sortable = TRUE; // Allow sort
		$this->f20170723->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170723'] = &$this->f20170723;

		// f20170724
		$this->f20170724 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170724', 'f20170724', '`f20170724`', '`f20170724`', 3, -1, FALSE, '`f20170724`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170724->Sortable = TRUE; // Allow sort
		$this->f20170724->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170724'] = &$this->f20170724;

		// f20170725
		$this->f20170725 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170725', 'f20170725', '`f20170725`', '`f20170725`', 3, -1, FALSE, '`f20170725`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170725->Sortable = TRUE; // Allow sort
		$this->f20170725->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170725'] = &$this->f20170725;

		// f20170726
		$this->f20170726 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170726', 'f20170726', '`f20170726`', '`f20170726`', 3, -1, FALSE, '`f20170726`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170726->Sortable = TRUE; // Allow sort
		$this->f20170726->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170726'] = &$this->f20170726;

		// f20170727
		$this->f20170727 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170727', 'f20170727', '`f20170727`', '`f20170727`', 3, -1, FALSE, '`f20170727`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170727->Sortable = TRUE; // Allow sort
		$this->f20170727->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170727'] = &$this->f20170727;

		// f20170728
		$this->f20170728 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170728', 'f20170728', '`f20170728`', '`f20170728`', 3, -1, FALSE, '`f20170728`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170728->Sortable = TRUE; // Allow sort
		$this->f20170728->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170728'] = &$this->f20170728;

		// f20170729
		$this->f20170729 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170729', 'f20170729', '`f20170729`', '`f20170729`', 3, -1, FALSE, '`f20170729`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170729->Sortable = TRUE; // Allow sort
		$this->f20170729->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170729'] = &$this->f20170729;

		// f20170730
		$this->f20170730 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170730', 'f20170730', '`f20170730`', '`f20170730`', 3, -1, FALSE, '`f20170730`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170730->Sortable = TRUE; // Allow sort
		$this->f20170730->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170730'] = &$this->f20170730;

		// f20170731
		$this->f20170731 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170731', 'f20170731', '`f20170731`', '`f20170731`', 3, -1, FALSE, '`f20170731`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170731->Sortable = TRUE; // Allow sort
		$this->f20170731->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170731'] = &$this->f20170731;

		// f20170801
		$this->f20170801 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170801', 'f20170801', '`f20170801`', '`f20170801`', 3, -1, FALSE, '`f20170801`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170801->Sortable = TRUE; // Allow sort
		$this->f20170801->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170801'] = &$this->f20170801;

		// f20170802
		$this->f20170802 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170802', 'f20170802', '`f20170802`', '`f20170802`', 3, -1, FALSE, '`f20170802`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170802->Sortable = TRUE; // Allow sort
		$this->f20170802->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170802'] = &$this->f20170802;

		// f20170803
		$this->f20170803 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170803', 'f20170803', '`f20170803`', '`f20170803`', 3, -1, FALSE, '`f20170803`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170803->Sortable = TRUE; // Allow sort
		$this->f20170803->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170803'] = &$this->f20170803;

		// f20170804
		$this->f20170804 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170804', 'f20170804', '`f20170804`', '`f20170804`', 3, -1, FALSE, '`f20170804`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170804->Sortable = TRUE; // Allow sort
		$this->f20170804->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170804'] = &$this->f20170804;

		// f20170805
		$this->f20170805 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170805', 'f20170805', '`f20170805`', '`f20170805`', 3, -1, FALSE, '`f20170805`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170805->Sortable = TRUE; // Allow sort
		$this->f20170805->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170805'] = &$this->f20170805;

		// f20170806
		$this->f20170806 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170806', 'f20170806', '`f20170806`', '`f20170806`', 3, -1, FALSE, '`f20170806`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170806->Sortable = TRUE; // Allow sort
		$this->f20170806->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170806'] = &$this->f20170806;

		// f20170807
		$this->f20170807 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170807', 'f20170807', '`f20170807`', '`f20170807`', 3, -1, FALSE, '`f20170807`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170807->Sortable = TRUE; // Allow sort
		$this->f20170807->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170807'] = &$this->f20170807;

		// f20170808
		$this->f20170808 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170808', 'f20170808', '`f20170808`', '`f20170808`', 3, -1, FALSE, '`f20170808`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170808->Sortable = TRUE; // Allow sort
		$this->f20170808->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170808'] = &$this->f20170808;

		// f20170809
		$this->f20170809 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170809', 'f20170809', '`f20170809`', '`f20170809`', 3, -1, FALSE, '`f20170809`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170809->Sortable = TRUE; // Allow sort
		$this->f20170809->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170809'] = &$this->f20170809;

		// f20170810
		$this->f20170810 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170810', 'f20170810', '`f20170810`', '`f20170810`', 3, -1, FALSE, '`f20170810`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170810->Sortable = TRUE; // Allow sort
		$this->f20170810->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170810'] = &$this->f20170810;

		// f20170811
		$this->f20170811 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170811', 'f20170811', '`f20170811`', '`f20170811`', 3, -1, FALSE, '`f20170811`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170811->Sortable = TRUE; // Allow sort
		$this->f20170811->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170811'] = &$this->f20170811;

		// f20170812
		$this->f20170812 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170812', 'f20170812', '`f20170812`', '`f20170812`', 3, -1, FALSE, '`f20170812`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170812->Sortable = TRUE; // Allow sort
		$this->f20170812->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170812'] = &$this->f20170812;

		// f20170813
		$this->f20170813 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170813', 'f20170813', '`f20170813`', '`f20170813`', 3, -1, FALSE, '`f20170813`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170813->Sortable = TRUE; // Allow sort
		$this->f20170813->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170813'] = &$this->f20170813;

		// f20170814
		$this->f20170814 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170814', 'f20170814', '`f20170814`', '`f20170814`', 3, -1, FALSE, '`f20170814`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170814->Sortable = TRUE; // Allow sort
		$this->f20170814->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170814'] = &$this->f20170814;

		// f20170815
		$this->f20170815 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170815', 'f20170815', '`f20170815`', '`f20170815`', 3, -1, FALSE, '`f20170815`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170815->Sortable = TRUE; // Allow sort
		$this->f20170815->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170815'] = &$this->f20170815;

		// f20170816
		$this->f20170816 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170816', 'f20170816', '`f20170816`', '`f20170816`', 3, -1, FALSE, '`f20170816`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170816->Sortable = TRUE; // Allow sort
		$this->f20170816->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170816'] = &$this->f20170816;

		// f20170817
		$this->f20170817 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170817', 'f20170817', '`f20170817`', '`f20170817`', 3, -1, FALSE, '`f20170817`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170817->Sortable = TRUE; // Allow sort
		$this->f20170817->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170817'] = &$this->f20170817;

		// f20170818
		$this->f20170818 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170818', 'f20170818', '`f20170818`', '`f20170818`', 3, -1, FALSE, '`f20170818`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170818->Sortable = TRUE; // Allow sort
		$this->f20170818->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170818'] = &$this->f20170818;

		// f20170819
		$this->f20170819 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170819', 'f20170819', '`f20170819`', '`f20170819`', 3, -1, FALSE, '`f20170819`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170819->Sortable = TRUE; // Allow sort
		$this->f20170819->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170819'] = &$this->f20170819;

		// f20170820
		$this->f20170820 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170820', 'f20170820', '`f20170820`', '`f20170820`', 3, -1, FALSE, '`f20170820`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170820->Sortable = TRUE; // Allow sort
		$this->f20170820->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170820'] = &$this->f20170820;

		// f20170821
		$this->f20170821 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170821', 'f20170821', '`f20170821`', '`f20170821`', 3, -1, FALSE, '`f20170821`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170821->Sortable = TRUE; // Allow sort
		$this->f20170821->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170821'] = &$this->f20170821;

		// f20170822
		$this->f20170822 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170822', 'f20170822', '`f20170822`', '`f20170822`', 3, -1, FALSE, '`f20170822`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170822->Sortable = TRUE; // Allow sort
		$this->f20170822->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170822'] = &$this->f20170822;

		// f20170823
		$this->f20170823 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170823', 'f20170823', '`f20170823`', '`f20170823`', 3, -1, FALSE, '`f20170823`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170823->Sortable = TRUE; // Allow sort
		$this->f20170823->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170823'] = &$this->f20170823;

		// f20170824
		$this->f20170824 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170824', 'f20170824', '`f20170824`', '`f20170824`', 3, -1, FALSE, '`f20170824`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170824->Sortable = TRUE; // Allow sort
		$this->f20170824->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170824'] = &$this->f20170824;

		// f20170825
		$this->f20170825 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170825', 'f20170825', '`f20170825`', '`f20170825`', 3, -1, FALSE, '`f20170825`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170825->Sortable = TRUE; // Allow sort
		$this->f20170825->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170825'] = &$this->f20170825;

		// f20170826
		$this->f20170826 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170826', 'f20170826', '`f20170826`', '`f20170826`', 3, -1, FALSE, '`f20170826`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170826->Sortable = TRUE; // Allow sort
		$this->f20170826->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170826'] = &$this->f20170826;

		// f20170827
		$this->f20170827 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170827', 'f20170827', '`f20170827`', '`f20170827`', 3, -1, FALSE, '`f20170827`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170827->Sortable = TRUE; // Allow sort
		$this->f20170827->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170827'] = &$this->f20170827;

		// f20170828
		$this->f20170828 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170828', 'f20170828', '`f20170828`', '`f20170828`', 3, -1, FALSE, '`f20170828`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170828->Sortable = TRUE; // Allow sort
		$this->f20170828->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170828'] = &$this->f20170828;

		// f20170829
		$this->f20170829 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170829', 'f20170829', '`f20170829`', '`f20170829`', 3, -1, FALSE, '`f20170829`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170829->Sortable = TRUE; // Allow sort
		$this->f20170829->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170829'] = &$this->f20170829;

		// f20170830
		$this->f20170830 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170830', 'f20170830', '`f20170830`', '`f20170830`', 3, -1, FALSE, '`f20170830`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170830->Sortable = TRUE; // Allow sort
		$this->f20170830->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170830'] = &$this->f20170830;

		// f20170831
		$this->f20170831 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170831', 'f20170831', '`f20170831`', '`f20170831`', 3, -1, FALSE, '`f20170831`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170831->Sortable = TRUE; // Allow sort
		$this->f20170831->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170831'] = &$this->f20170831;

		// f20170901
		$this->f20170901 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170901', 'f20170901', '`f20170901`', '`f20170901`', 3, -1, FALSE, '`f20170901`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170901->Sortable = TRUE; // Allow sort
		$this->f20170901->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170901'] = &$this->f20170901;

		// f20170902
		$this->f20170902 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170902', 'f20170902', '`f20170902`', '`f20170902`', 3, -1, FALSE, '`f20170902`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170902->Sortable = TRUE; // Allow sort
		$this->f20170902->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170902'] = &$this->f20170902;

		// f20170903
		$this->f20170903 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170903', 'f20170903', '`f20170903`', '`f20170903`', 3, -1, FALSE, '`f20170903`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170903->Sortable = TRUE; // Allow sort
		$this->f20170903->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170903'] = &$this->f20170903;

		// f20170904
		$this->f20170904 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170904', 'f20170904', '`f20170904`', '`f20170904`', 3, -1, FALSE, '`f20170904`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170904->Sortable = TRUE; // Allow sort
		$this->f20170904->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170904'] = &$this->f20170904;

		// f20170905
		$this->f20170905 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170905', 'f20170905', '`f20170905`', '`f20170905`', 3, -1, FALSE, '`f20170905`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170905->Sortable = TRUE; // Allow sort
		$this->f20170905->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170905'] = &$this->f20170905;

		// f20170906
		$this->f20170906 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170906', 'f20170906', '`f20170906`', '`f20170906`', 3, -1, FALSE, '`f20170906`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170906->Sortable = TRUE; // Allow sort
		$this->f20170906->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170906'] = &$this->f20170906;

		// f20170907
		$this->f20170907 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170907', 'f20170907', '`f20170907`', '`f20170907`', 3, -1, FALSE, '`f20170907`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170907->Sortable = TRUE; // Allow sort
		$this->f20170907->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170907'] = &$this->f20170907;

		// f20170908
		$this->f20170908 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170908', 'f20170908', '`f20170908`', '`f20170908`', 3, -1, FALSE, '`f20170908`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170908->Sortable = TRUE; // Allow sort
		$this->f20170908->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170908'] = &$this->f20170908;

		// f20170909
		$this->f20170909 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170909', 'f20170909', '`f20170909`', '`f20170909`', 3, -1, FALSE, '`f20170909`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170909->Sortable = TRUE; // Allow sort
		$this->f20170909->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170909'] = &$this->f20170909;

		// f20170910
		$this->f20170910 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170910', 'f20170910', '`f20170910`', '`f20170910`', 3, -1, FALSE, '`f20170910`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170910->Sortable = TRUE; // Allow sort
		$this->f20170910->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170910'] = &$this->f20170910;

		// f20170911
		$this->f20170911 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170911', 'f20170911', '`f20170911`', '`f20170911`', 3, -1, FALSE, '`f20170911`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170911->Sortable = TRUE; // Allow sort
		$this->f20170911->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170911'] = &$this->f20170911;

		// f20170912
		$this->f20170912 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170912', 'f20170912', '`f20170912`', '`f20170912`', 3, -1, FALSE, '`f20170912`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170912->Sortable = TRUE; // Allow sort
		$this->f20170912->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170912'] = &$this->f20170912;

		// f20170913
		$this->f20170913 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170913', 'f20170913', '`f20170913`', '`f20170913`', 3, -1, FALSE, '`f20170913`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170913->Sortable = TRUE; // Allow sort
		$this->f20170913->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170913'] = &$this->f20170913;

		// f20170914
		$this->f20170914 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170914', 'f20170914', '`f20170914`', '`f20170914`', 3, -1, FALSE, '`f20170914`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170914->Sortable = TRUE; // Allow sort
		$this->f20170914->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170914'] = &$this->f20170914;

		// f20170915
		$this->f20170915 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170915', 'f20170915', '`f20170915`', '`f20170915`', 3, -1, FALSE, '`f20170915`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170915->Sortable = TRUE; // Allow sort
		$this->f20170915->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170915'] = &$this->f20170915;

		// f20170916
		$this->f20170916 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170916', 'f20170916', '`f20170916`', '`f20170916`', 3, -1, FALSE, '`f20170916`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170916->Sortable = TRUE; // Allow sort
		$this->f20170916->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170916'] = &$this->f20170916;

		// f20170917
		$this->f20170917 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170917', 'f20170917', '`f20170917`', '`f20170917`', 3, -1, FALSE, '`f20170917`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170917->Sortable = TRUE; // Allow sort
		$this->f20170917->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170917'] = &$this->f20170917;

		// f20170918
		$this->f20170918 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170918', 'f20170918', '`f20170918`', '`f20170918`', 3, -1, FALSE, '`f20170918`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170918->Sortable = TRUE; // Allow sort
		$this->f20170918->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170918'] = &$this->f20170918;

		// f20170919
		$this->f20170919 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170919', 'f20170919', '`f20170919`', '`f20170919`', 3, -1, FALSE, '`f20170919`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170919->Sortable = TRUE; // Allow sort
		$this->f20170919->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170919'] = &$this->f20170919;

		// f20170920
		$this->f20170920 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170920', 'f20170920', '`f20170920`', '`f20170920`', 3, -1, FALSE, '`f20170920`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170920->Sortable = TRUE; // Allow sort
		$this->f20170920->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170920'] = &$this->f20170920;

		// f20170921
		$this->f20170921 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170921', 'f20170921', '`f20170921`', '`f20170921`', 3, -1, FALSE, '`f20170921`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170921->Sortable = TRUE; // Allow sort
		$this->f20170921->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170921'] = &$this->f20170921;

		// f20170922
		$this->f20170922 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170922', 'f20170922', '`f20170922`', '`f20170922`', 3, -1, FALSE, '`f20170922`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170922->Sortable = TRUE; // Allow sort
		$this->f20170922->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170922'] = &$this->f20170922;

		// f20170923
		$this->f20170923 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170923', 'f20170923', '`f20170923`', '`f20170923`', 3, -1, FALSE, '`f20170923`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170923->Sortable = TRUE; // Allow sort
		$this->f20170923->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170923'] = &$this->f20170923;

		// f20170924
		$this->f20170924 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170924', 'f20170924', '`f20170924`', '`f20170924`', 3, -1, FALSE, '`f20170924`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170924->Sortable = TRUE; // Allow sort
		$this->f20170924->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170924'] = &$this->f20170924;

		// f20170925
		$this->f20170925 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170925', 'f20170925', '`f20170925`', '`f20170925`', 3, -1, FALSE, '`f20170925`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170925->Sortable = TRUE; // Allow sort
		$this->f20170925->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170925'] = &$this->f20170925;

		// f20170926
		$this->f20170926 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170926', 'f20170926', '`f20170926`', '`f20170926`', 3, -1, FALSE, '`f20170926`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170926->Sortable = TRUE; // Allow sort
		$this->f20170926->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170926'] = &$this->f20170926;

		// f20170927
		$this->f20170927 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170927', 'f20170927', '`f20170927`', '`f20170927`', 3, -1, FALSE, '`f20170927`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170927->Sortable = TRUE; // Allow sort
		$this->f20170927->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170927'] = &$this->f20170927;

		// f20170928
		$this->f20170928 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170928', 'f20170928', '`f20170928`', '`f20170928`', 3, -1, FALSE, '`f20170928`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170928->Sortable = TRUE; // Allow sort
		$this->f20170928->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170928'] = &$this->f20170928;

		// f20170929
		$this->f20170929 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170929', 'f20170929', '`f20170929`', '`f20170929`', 3, -1, FALSE, '`f20170929`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170929->Sortable = TRUE; // Allow sort
		$this->f20170929->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170929'] = &$this->f20170929;

		// f20170930
		$this->f20170930 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20170930', 'f20170930', '`f20170930`', '`f20170930`', 3, -1, FALSE, '`f20170930`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20170930->Sortable = TRUE; // Allow sort
		$this->f20170930->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20170930'] = &$this->f20170930;

		// f20171001
		$this->f20171001 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171001', 'f20171001', '`f20171001`', '`f20171001`', 3, -1, FALSE, '`f20171001`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171001->Sortable = TRUE; // Allow sort
		$this->f20171001->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171001'] = &$this->f20171001;

		// f20171002
		$this->f20171002 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171002', 'f20171002', '`f20171002`', '`f20171002`', 3, -1, FALSE, '`f20171002`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171002->Sortable = TRUE; // Allow sort
		$this->f20171002->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171002'] = &$this->f20171002;

		// f20171003
		$this->f20171003 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171003', 'f20171003', '`f20171003`', '`f20171003`', 3, -1, FALSE, '`f20171003`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171003->Sortable = TRUE; // Allow sort
		$this->f20171003->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171003'] = &$this->f20171003;

		// f20171004
		$this->f20171004 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171004', 'f20171004', '`f20171004`', '`f20171004`', 3, -1, FALSE, '`f20171004`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171004->Sortable = TRUE; // Allow sort
		$this->f20171004->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171004'] = &$this->f20171004;

		// f20171005
		$this->f20171005 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171005', 'f20171005', '`f20171005`', '`f20171005`', 3, -1, FALSE, '`f20171005`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171005->Sortable = TRUE; // Allow sort
		$this->f20171005->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171005'] = &$this->f20171005;

		// f20171006
		$this->f20171006 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171006', 'f20171006', '`f20171006`', '`f20171006`', 3, -1, FALSE, '`f20171006`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171006->Sortable = TRUE; // Allow sort
		$this->f20171006->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171006'] = &$this->f20171006;

		// f20171007
		$this->f20171007 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171007', 'f20171007', '`f20171007`', '`f20171007`', 3, -1, FALSE, '`f20171007`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171007->Sortable = TRUE; // Allow sort
		$this->f20171007->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171007'] = &$this->f20171007;

		// f20171008
		$this->f20171008 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171008', 'f20171008', '`f20171008`', '`f20171008`', 3, -1, FALSE, '`f20171008`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171008->Sortable = TRUE; // Allow sort
		$this->f20171008->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171008'] = &$this->f20171008;

		// f20171009
		$this->f20171009 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171009', 'f20171009', '`f20171009`', '`f20171009`', 3, -1, FALSE, '`f20171009`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171009->Sortable = TRUE; // Allow sort
		$this->f20171009->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171009'] = &$this->f20171009;

		// f20171010
		$this->f20171010 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171010', 'f20171010', '`f20171010`', '`f20171010`', 3, -1, FALSE, '`f20171010`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171010->Sortable = TRUE; // Allow sort
		$this->f20171010->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171010'] = &$this->f20171010;

		// f20171011
		$this->f20171011 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171011', 'f20171011', '`f20171011`', '`f20171011`', 3, -1, FALSE, '`f20171011`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171011->Sortable = TRUE; // Allow sort
		$this->f20171011->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171011'] = &$this->f20171011;

		// f20171012
		$this->f20171012 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171012', 'f20171012', '`f20171012`', '`f20171012`', 3, -1, FALSE, '`f20171012`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171012->Sortable = TRUE; // Allow sort
		$this->f20171012->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171012'] = &$this->f20171012;

		// f20171013
		$this->f20171013 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171013', 'f20171013', '`f20171013`', '`f20171013`', 3, -1, FALSE, '`f20171013`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171013->Sortable = TRUE; // Allow sort
		$this->f20171013->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171013'] = &$this->f20171013;

		// f20171014
		$this->f20171014 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171014', 'f20171014', '`f20171014`', '`f20171014`', 3, -1, FALSE, '`f20171014`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171014->Sortable = TRUE; // Allow sort
		$this->f20171014->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171014'] = &$this->f20171014;

		// f20171015
		$this->f20171015 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171015', 'f20171015', '`f20171015`', '`f20171015`', 3, -1, FALSE, '`f20171015`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171015->Sortable = TRUE; // Allow sort
		$this->f20171015->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171015'] = &$this->f20171015;

		// f20171016
		$this->f20171016 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171016', 'f20171016', '`f20171016`', '`f20171016`', 3, -1, FALSE, '`f20171016`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171016->Sortable = TRUE; // Allow sort
		$this->f20171016->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171016'] = &$this->f20171016;

		// f20171017
		$this->f20171017 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171017', 'f20171017', '`f20171017`', '`f20171017`', 3, -1, FALSE, '`f20171017`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171017->Sortable = TRUE; // Allow sort
		$this->f20171017->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171017'] = &$this->f20171017;

		// f20171018
		$this->f20171018 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171018', 'f20171018', '`f20171018`', '`f20171018`', 3, -1, FALSE, '`f20171018`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171018->Sortable = TRUE; // Allow sort
		$this->f20171018->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171018'] = &$this->f20171018;

		// f20171019
		$this->f20171019 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171019', 'f20171019', '`f20171019`', '`f20171019`', 3, -1, FALSE, '`f20171019`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171019->Sortable = TRUE; // Allow sort
		$this->f20171019->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171019'] = &$this->f20171019;

		// f20171020
		$this->f20171020 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171020', 'f20171020', '`f20171020`', '`f20171020`', 3, -1, FALSE, '`f20171020`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171020->Sortable = TRUE; // Allow sort
		$this->f20171020->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171020'] = &$this->f20171020;

		// f20171021
		$this->f20171021 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171021', 'f20171021', '`f20171021`', '`f20171021`', 3, -1, FALSE, '`f20171021`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171021->Sortable = TRUE; // Allow sort
		$this->f20171021->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171021'] = &$this->f20171021;

		// f20171022
		$this->f20171022 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171022', 'f20171022', '`f20171022`', '`f20171022`', 3, -1, FALSE, '`f20171022`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171022->Sortable = TRUE; // Allow sort
		$this->f20171022->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171022'] = &$this->f20171022;

		// f20171023
		$this->f20171023 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171023', 'f20171023', '`f20171023`', '`f20171023`', 3, -1, FALSE, '`f20171023`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171023->Sortable = TRUE; // Allow sort
		$this->f20171023->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171023'] = &$this->f20171023;

		// f20171024
		$this->f20171024 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171024', 'f20171024', '`f20171024`', '`f20171024`', 3, -1, FALSE, '`f20171024`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171024->Sortable = TRUE; // Allow sort
		$this->f20171024->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171024'] = &$this->f20171024;

		// f20171025
		$this->f20171025 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171025', 'f20171025', '`f20171025`', '`f20171025`', 3, -1, FALSE, '`f20171025`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171025->Sortable = TRUE; // Allow sort
		$this->f20171025->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171025'] = &$this->f20171025;

		// f20171026
		$this->f20171026 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171026', 'f20171026', '`f20171026`', '`f20171026`', 3, -1, FALSE, '`f20171026`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171026->Sortable = TRUE; // Allow sort
		$this->f20171026->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171026'] = &$this->f20171026;

		// f20171027
		$this->f20171027 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171027', 'f20171027', '`f20171027`', '`f20171027`', 3, -1, FALSE, '`f20171027`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171027->Sortable = TRUE; // Allow sort
		$this->f20171027->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171027'] = &$this->f20171027;

		// f20171028
		$this->f20171028 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171028', 'f20171028', '`f20171028`', '`f20171028`', 3, -1, FALSE, '`f20171028`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171028->Sortable = TRUE; // Allow sort
		$this->f20171028->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171028'] = &$this->f20171028;

		// f20171029
		$this->f20171029 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171029', 'f20171029', '`f20171029`', '`f20171029`', 3, -1, FALSE, '`f20171029`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171029->Sortable = TRUE; // Allow sort
		$this->f20171029->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171029'] = &$this->f20171029;

		// f20171030
		$this->f20171030 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171030', 'f20171030', '`f20171030`', '`f20171030`', 3, -1, FALSE, '`f20171030`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171030->Sortable = TRUE; // Allow sort
		$this->f20171030->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171030'] = &$this->f20171030;

		// f20171031
		$this->f20171031 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171031', 'f20171031', '`f20171031`', '`f20171031`', 3, -1, FALSE, '`f20171031`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171031->Sortable = TRUE; // Allow sort
		$this->f20171031->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171031'] = &$this->f20171031;

		// f20171101
		$this->f20171101 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171101', 'f20171101', '`f20171101`', '`f20171101`', 3, -1, FALSE, '`f20171101`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171101->Sortable = TRUE; // Allow sort
		$this->f20171101->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171101'] = &$this->f20171101;

		// f20171102
		$this->f20171102 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171102', 'f20171102', '`f20171102`', '`f20171102`', 3, -1, FALSE, '`f20171102`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171102->Sortable = TRUE; // Allow sort
		$this->f20171102->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171102'] = &$this->f20171102;

		// f20171103
		$this->f20171103 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171103', 'f20171103', '`f20171103`', '`f20171103`', 3, -1, FALSE, '`f20171103`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171103->Sortable = TRUE; // Allow sort
		$this->f20171103->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171103'] = &$this->f20171103;

		// f20171104
		$this->f20171104 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171104', 'f20171104', '`f20171104`', '`f20171104`', 3, -1, FALSE, '`f20171104`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171104->Sortable = TRUE; // Allow sort
		$this->f20171104->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171104'] = &$this->f20171104;

		// f20171105
		$this->f20171105 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171105', 'f20171105', '`f20171105`', '`f20171105`', 3, -1, FALSE, '`f20171105`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171105->Sortable = TRUE; // Allow sort
		$this->f20171105->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171105'] = &$this->f20171105;

		// f20171106
		$this->f20171106 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171106', 'f20171106', '`f20171106`', '`f20171106`', 3, -1, FALSE, '`f20171106`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171106->Sortable = TRUE; // Allow sort
		$this->f20171106->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171106'] = &$this->f20171106;

		// f20171107
		$this->f20171107 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171107', 'f20171107', '`f20171107`', '`f20171107`', 3, -1, FALSE, '`f20171107`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171107->Sortable = TRUE; // Allow sort
		$this->f20171107->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171107'] = &$this->f20171107;

		// f20171108
		$this->f20171108 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171108', 'f20171108', '`f20171108`', '`f20171108`', 3, -1, FALSE, '`f20171108`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171108->Sortable = TRUE; // Allow sort
		$this->f20171108->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171108'] = &$this->f20171108;

		// f20171109
		$this->f20171109 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171109', 'f20171109', '`f20171109`', '`f20171109`', 3, -1, FALSE, '`f20171109`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171109->Sortable = TRUE; // Allow sort
		$this->f20171109->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171109'] = &$this->f20171109;

		// f20171110
		$this->f20171110 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171110', 'f20171110', '`f20171110`', '`f20171110`', 3, -1, FALSE, '`f20171110`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171110->Sortable = TRUE; // Allow sort
		$this->f20171110->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171110'] = &$this->f20171110;

		// f20171111
		$this->f20171111 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171111', 'f20171111', '`f20171111`', '`f20171111`', 3, -1, FALSE, '`f20171111`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171111->Sortable = TRUE; // Allow sort
		$this->f20171111->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171111'] = &$this->f20171111;

		// f20171112
		$this->f20171112 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171112', 'f20171112', '`f20171112`', '`f20171112`', 3, -1, FALSE, '`f20171112`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171112->Sortable = TRUE; // Allow sort
		$this->f20171112->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171112'] = &$this->f20171112;

		// f20171113
		$this->f20171113 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171113', 'f20171113', '`f20171113`', '`f20171113`', 3, -1, FALSE, '`f20171113`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171113->Sortable = TRUE; // Allow sort
		$this->f20171113->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171113'] = &$this->f20171113;

		// f20171114
		$this->f20171114 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171114', 'f20171114', '`f20171114`', '`f20171114`', 3, -1, FALSE, '`f20171114`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171114->Sortable = TRUE; // Allow sort
		$this->f20171114->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171114'] = &$this->f20171114;

		// f20171115
		$this->f20171115 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171115', 'f20171115', '`f20171115`', '`f20171115`', 3, -1, FALSE, '`f20171115`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171115->Sortable = TRUE; // Allow sort
		$this->f20171115->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171115'] = &$this->f20171115;

		// f20171116
		$this->f20171116 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171116', 'f20171116', '`f20171116`', '`f20171116`', 3, -1, FALSE, '`f20171116`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171116->Sortable = TRUE; // Allow sort
		$this->f20171116->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171116'] = &$this->f20171116;

		// f20171117
		$this->f20171117 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171117', 'f20171117', '`f20171117`', '`f20171117`', 3, -1, FALSE, '`f20171117`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171117->Sortable = TRUE; // Allow sort
		$this->f20171117->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171117'] = &$this->f20171117;

		// f20171118
		$this->f20171118 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171118', 'f20171118', '`f20171118`', '`f20171118`', 3, -1, FALSE, '`f20171118`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171118->Sortable = TRUE; // Allow sort
		$this->f20171118->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171118'] = &$this->f20171118;

		// f20171119
		$this->f20171119 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171119', 'f20171119', '`f20171119`', '`f20171119`', 3, -1, FALSE, '`f20171119`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171119->Sortable = TRUE; // Allow sort
		$this->f20171119->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171119'] = &$this->f20171119;

		// f20171120
		$this->f20171120 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171120', 'f20171120', '`f20171120`', '`f20171120`', 3, -1, FALSE, '`f20171120`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171120->Sortable = TRUE; // Allow sort
		$this->f20171120->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171120'] = &$this->f20171120;

		// f20171121
		$this->f20171121 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171121', 'f20171121', '`f20171121`', '`f20171121`', 3, -1, FALSE, '`f20171121`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171121->Sortable = TRUE; // Allow sort
		$this->f20171121->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171121'] = &$this->f20171121;

		// f20171122
		$this->f20171122 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171122', 'f20171122', '`f20171122`', '`f20171122`', 3, -1, FALSE, '`f20171122`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171122->Sortable = TRUE; // Allow sort
		$this->f20171122->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171122'] = &$this->f20171122;

		// f20171123
		$this->f20171123 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171123', 'f20171123', '`f20171123`', '`f20171123`', 3, -1, FALSE, '`f20171123`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171123->Sortable = TRUE; // Allow sort
		$this->f20171123->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171123'] = &$this->f20171123;

		// f20171124
		$this->f20171124 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171124', 'f20171124', '`f20171124`', '`f20171124`', 3, -1, FALSE, '`f20171124`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171124->Sortable = TRUE; // Allow sort
		$this->f20171124->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171124'] = &$this->f20171124;

		// f20171125
		$this->f20171125 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171125', 'f20171125', '`f20171125`', '`f20171125`', 3, -1, FALSE, '`f20171125`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171125->Sortable = TRUE; // Allow sort
		$this->f20171125->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171125'] = &$this->f20171125;

		// f20171126
		$this->f20171126 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171126', 'f20171126', '`f20171126`', '`f20171126`', 3, -1, FALSE, '`f20171126`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171126->Sortable = TRUE; // Allow sort
		$this->f20171126->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171126'] = &$this->f20171126;

		// f20171127
		$this->f20171127 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171127', 'f20171127', '`f20171127`', '`f20171127`', 3, -1, FALSE, '`f20171127`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171127->Sortable = TRUE; // Allow sort
		$this->f20171127->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171127'] = &$this->f20171127;

		// f20171128
		$this->f20171128 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171128', 'f20171128', '`f20171128`', '`f20171128`', 3, -1, FALSE, '`f20171128`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171128->Sortable = TRUE; // Allow sort
		$this->f20171128->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171128'] = &$this->f20171128;

		// f20171129
		$this->f20171129 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171129', 'f20171129', '`f20171129`', '`f20171129`', 3, -1, FALSE, '`f20171129`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171129->Sortable = TRUE; // Allow sort
		$this->f20171129->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171129'] = &$this->f20171129;

		// f20171130
		$this->f20171130 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171130', 'f20171130', '`f20171130`', '`f20171130`', 3, -1, FALSE, '`f20171130`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171130->Sortable = TRUE; // Allow sort
		$this->f20171130->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171130'] = &$this->f20171130;

		// f20171201
		$this->f20171201 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171201', 'f20171201', '`f20171201`', '`f20171201`', 3, -1, FALSE, '`f20171201`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171201->Sortable = TRUE; // Allow sort
		$this->f20171201->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171201'] = &$this->f20171201;

		// f20171202
		$this->f20171202 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171202', 'f20171202', '`f20171202`', '`f20171202`', 3, -1, FALSE, '`f20171202`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171202->Sortable = TRUE; // Allow sort
		$this->f20171202->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171202'] = &$this->f20171202;

		// f20171203
		$this->f20171203 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171203', 'f20171203', '`f20171203`', '`f20171203`', 3, -1, FALSE, '`f20171203`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171203->Sortable = TRUE; // Allow sort
		$this->f20171203->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171203'] = &$this->f20171203;

		// f20171204
		$this->f20171204 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171204', 'f20171204', '`f20171204`', '`f20171204`', 3, -1, FALSE, '`f20171204`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171204->Sortable = TRUE; // Allow sort
		$this->f20171204->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171204'] = &$this->f20171204;

		// f20171205
		$this->f20171205 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171205', 'f20171205', '`f20171205`', '`f20171205`', 3, -1, FALSE, '`f20171205`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171205->Sortable = TRUE; // Allow sort
		$this->f20171205->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171205'] = &$this->f20171205;

		// f20171206
		$this->f20171206 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171206', 'f20171206', '`f20171206`', '`f20171206`', 3, -1, FALSE, '`f20171206`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171206->Sortable = TRUE; // Allow sort
		$this->f20171206->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171206'] = &$this->f20171206;

		// f20171207
		$this->f20171207 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171207', 'f20171207', '`f20171207`', '`f20171207`', 3, -1, FALSE, '`f20171207`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171207->Sortable = TRUE; // Allow sort
		$this->f20171207->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171207'] = &$this->f20171207;

		// f20171208
		$this->f20171208 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171208', 'f20171208', '`f20171208`', '`f20171208`', 3, -1, FALSE, '`f20171208`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171208->Sortable = TRUE; // Allow sort
		$this->f20171208->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171208'] = &$this->f20171208;

		// f20171209
		$this->f20171209 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171209', 'f20171209', '`f20171209`', '`f20171209`', 3, -1, FALSE, '`f20171209`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171209->Sortable = TRUE; // Allow sort
		$this->f20171209->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171209'] = &$this->f20171209;

		// f20171210
		$this->f20171210 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171210', 'f20171210', '`f20171210`', '`f20171210`', 3, -1, FALSE, '`f20171210`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171210->Sortable = TRUE; // Allow sort
		$this->f20171210->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171210'] = &$this->f20171210;

		// f20171211
		$this->f20171211 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171211', 'f20171211', '`f20171211`', '`f20171211`', 3, -1, FALSE, '`f20171211`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171211->Sortable = TRUE; // Allow sort
		$this->f20171211->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171211'] = &$this->f20171211;

		// f20171212
		$this->f20171212 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171212', 'f20171212', '`f20171212`', '`f20171212`', 3, -1, FALSE, '`f20171212`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171212->Sortable = TRUE; // Allow sort
		$this->f20171212->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171212'] = &$this->f20171212;

		// f20171213
		$this->f20171213 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171213', 'f20171213', '`f20171213`', '`f20171213`', 3, -1, FALSE, '`f20171213`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171213->Sortable = TRUE; // Allow sort
		$this->f20171213->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171213'] = &$this->f20171213;

		// f20171214
		$this->f20171214 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171214', 'f20171214', '`f20171214`', '`f20171214`', 3, -1, FALSE, '`f20171214`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171214->Sortable = TRUE; // Allow sort
		$this->f20171214->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171214'] = &$this->f20171214;

		// f20171215
		$this->f20171215 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171215', 'f20171215', '`f20171215`', '`f20171215`', 3, -1, FALSE, '`f20171215`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171215->Sortable = TRUE; // Allow sort
		$this->f20171215->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171215'] = &$this->f20171215;

		// f20171216
		$this->f20171216 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171216', 'f20171216', '`f20171216`', '`f20171216`', 3, -1, FALSE, '`f20171216`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171216->Sortable = TRUE; // Allow sort
		$this->f20171216->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171216'] = &$this->f20171216;

		// f20171217
		$this->f20171217 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171217', 'f20171217', '`f20171217`', '`f20171217`', 3, -1, FALSE, '`f20171217`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171217->Sortable = TRUE; // Allow sort
		$this->f20171217->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171217'] = &$this->f20171217;

		// f20171218
		$this->f20171218 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171218', 'f20171218', '`f20171218`', '`f20171218`', 3, -1, FALSE, '`f20171218`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171218->Sortable = TRUE; // Allow sort
		$this->f20171218->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171218'] = &$this->f20171218;

		// f20171219
		$this->f20171219 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171219', 'f20171219', '`f20171219`', '`f20171219`', 3, -1, FALSE, '`f20171219`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171219->Sortable = TRUE; // Allow sort
		$this->f20171219->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171219'] = &$this->f20171219;

		// f20171220
		$this->f20171220 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171220', 'f20171220', '`f20171220`', '`f20171220`', 3, -1, FALSE, '`f20171220`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171220->Sortable = TRUE; // Allow sort
		$this->f20171220->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171220'] = &$this->f20171220;

		// f20171221
		$this->f20171221 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171221', 'f20171221', '`f20171221`', '`f20171221`', 3, -1, FALSE, '`f20171221`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171221->Sortable = TRUE; // Allow sort
		$this->f20171221->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171221'] = &$this->f20171221;

		// f20171222
		$this->f20171222 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171222', 'f20171222', '`f20171222`', '`f20171222`', 3, -1, FALSE, '`f20171222`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171222->Sortable = TRUE; // Allow sort
		$this->f20171222->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171222'] = &$this->f20171222;

		// f20171223
		$this->f20171223 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171223', 'f20171223', '`f20171223`', '`f20171223`', 3, -1, FALSE, '`f20171223`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171223->Sortable = TRUE; // Allow sort
		$this->f20171223->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171223'] = &$this->f20171223;

		// f20171224
		$this->f20171224 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171224', 'f20171224', '`f20171224`', '`f20171224`', 3, -1, FALSE, '`f20171224`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171224->Sortable = TRUE; // Allow sort
		$this->f20171224->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171224'] = &$this->f20171224;

		// f20171225
		$this->f20171225 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171225', 'f20171225', '`f20171225`', '`f20171225`', 3, -1, FALSE, '`f20171225`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171225->Sortable = TRUE; // Allow sort
		$this->f20171225->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171225'] = &$this->f20171225;

		// f20171226
		$this->f20171226 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171226', 'f20171226', '`f20171226`', '`f20171226`', 3, -1, FALSE, '`f20171226`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171226->Sortable = TRUE; // Allow sort
		$this->f20171226->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171226'] = &$this->f20171226;

		// f20171227
		$this->f20171227 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171227', 'f20171227', '`f20171227`', '`f20171227`', 3, -1, FALSE, '`f20171227`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171227->Sortable = TRUE; // Allow sort
		$this->f20171227->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171227'] = &$this->f20171227;

		// f20171228
		$this->f20171228 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171228', 'f20171228', '`f20171228`', '`f20171228`', 3, -1, FALSE, '`f20171228`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171228->Sortable = TRUE; // Allow sort
		$this->f20171228->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171228'] = &$this->f20171228;

		// f20171229
		$this->f20171229 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171229', 'f20171229', '`f20171229`', '`f20171229`', 3, -1, FALSE, '`f20171229`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171229->Sortable = TRUE; // Allow sort
		$this->f20171229->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171229'] = &$this->f20171229;

		// f20171230
		$this->f20171230 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171230', 'f20171230', '`f20171230`', '`f20171230`', 3, -1, FALSE, '`f20171230`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171230->Sortable = TRUE; // Allow sort
		$this->f20171230->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171230'] = &$this->f20171230;

		// f20171231
		$this->f20171231 = new cField('t_jd_krj_peg', 't_jd_krj_peg', 'x_f20171231', 'f20171231', '`f20171231`', '`f20171231`', 3, -1, FALSE, '`EV__f20171231`', TRUE, TRUE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->f20171231->Sortable = TRUE; // Allow sort
		$this->f20171231->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['f20171231'] = &$this->f20171231;
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`t_jd_krj_peg`";
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
			"SELECT *, (SELECT `pegawai_nama` FROM `pegawai` `EW_TMP_LOOKUPTABLE` WHERE `EW_TMP_LOOKUPTABLE`.`pegawai_id` = `t_jd_krj_peg`.`pegawai_id` LIMIT 1) AS `EV__pegawai_id`, (SELECT `jk_nm` FROM `t_jk` `EW_TMP_LOOKUPTABLE` WHERE `EW_TMP_LOOKUPTABLE`.`jk_id` = `t_jd_krj_peg`.`f20170102` LIMIT 1) AS `EV__f20170102`, (SELECT `jk_nm` FROM `t_jk` `EW_TMP_LOOKUPTABLE` WHERE `EW_TMP_LOOKUPTABLE`.`jk_id` = `t_jd_krj_peg`.`f20171231` LIMIT 1) AS `EV__f20171231` FROM `t_jd_krj_peg`" .
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
		if ($this->f20170102->AdvancedSearch->SearchValue <> "" ||
			$this->f20170102->AdvancedSearch->SearchValue2 <> "" ||
			strpos($sWhere, " " . $this->f20170102->FldVirtualExpression . " ") !== FALSE)
			return TRUE;
		if (strpos($sOrderBy, " " . $this->f20170102->FldVirtualExpression . " ") !== FALSE)
			return TRUE;
		if ($this->f20171231->AdvancedSearch->SearchValue <> "" ||
			$this->f20171231->AdvancedSearch->SearchValue2 <> "" ||
			strpos($sWhere, " " . $this->f20171231->FldVirtualExpression . " ") !== FALSE)
			return TRUE;
		if (strpos($sOrderBy, " " . $this->f20171231->FldVirtualExpression . " ") !== FALSE)
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
			$this->jdwkrjpeg_id->setDbValue($conn->Insert_ID());
			$rs['jdwkrjpeg_id'] = $this->jdwkrjpeg_id->DbValue;
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
			$fldname = 'jdwkrjpeg_id';
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
			if (array_key_exists('jdwkrjpeg_id', $rs))
				ew_AddFilter($where, ew_QuotedName('jdwkrjpeg_id', $this->DBID) . '=' . ew_QuotedValue($rs['jdwkrjpeg_id'], $this->jdwkrjpeg_id->FldDataType, $this->DBID));
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
		return "`jdwkrjpeg_id` = @jdwkrjpeg_id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->jdwkrjpeg_id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@jdwkrjpeg_id@", ew_AdjustSql($this->jdwkrjpeg_id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "t_jd_krj_peglist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "t_jd_krj_peglist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("t_jd_krj_pegview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("t_jd_krj_pegview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "t_jd_krj_pegadd.php?" . $this->UrlParm($parm);
		else
			$url = "t_jd_krj_pegadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("t_jd_krj_pegedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("t_jd_krj_pegadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("t_jd_krj_pegdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "jdwkrjpeg_id:" . ew_VarToJson($this->jdwkrjpeg_id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->jdwkrjpeg_id->CurrentValue)) {
			$sUrl .= "jdwkrjpeg_id=" . urlencode($this->jdwkrjpeg_id->CurrentValue);
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
			if ($isPost && isset($_POST["jdwkrjpeg_id"]))
				$arKeys[] = ew_StripSlashes($_POST["jdwkrjpeg_id"]);
			elseif (isset($_GET["jdwkrjpeg_id"]))
				$arKeys[] = ew_StripSlashes($_GET["jdwkrjpeg_id"]);
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
			$this->jdwkrjpeg_id->CurrentValue = $key;
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
		$this->jdwkrjpeg_id->setDbValue($rs->fields('jdwkrjpeg_id'));
		$this->pegawai_id->setDbValue($rs->fields('pegawai_id'));
		$this->f20170101->setDbValue($rs->fields('f20170101'));
		$this->f20170102->setDbValue($rs->fields('f20170102'));
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
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
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
		// jdwkrjpeg_id

		$this->jdwkrjpeg_id->ViewValue = $this->jdwkrjpeg_id->CurrentValue;
		$this->jdwkrjpeg_id->ViewCustomAttributes = "";

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

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// jdwkrjpeg_id
		$this->jdwkrjpeg_id->EditAttrs["class"] = "form-control";
		$this->jdwkrjpeg_id->EditCustomAttributes = "";
		$this->jdwkrjpeg_id->EditValue = $this->jdwkrjpeg_id->CurrentValue;
		$this->jdwkrjpeg_id->ViewCustomAttributes = "";

		// pegawai_id
		$this->pegawai_id->EditAttrs["class"] = "form-control";
		$this->pegawai_id->EditCustomAttributes = "";
		$this->pegawai_id->EditValue = $this->pegawai_id->CurrentValue;
		$this->pegawai_id->PlaceHolder = ew_RemoveHtml($this->pegawai_id->FldCaption());

		// f20170101
		$this->f20170101->EditAttrs["class"] = "form-control";
		$this->f20170101->EditCustomAttributes = "";
		$this->f20170101->EditValue = $this->f20170101->CurrentValue;
		$this->f20170101->PlaceHolder = ew_RemoveHtml($this->f20170101->FldCaption());

		// f20170102
		$this->f20170102->EditAttrs["class"] = "form-control";
		$this->f20170102->EditCustomAttributes = "";
		$this->f20170102->EditValue = $this->f20170102->CurrentValue;
		$this->f20170102->PlaceHolder = ew_RemoveHtml($this->f20170102->FldCaption());

		// f20170103
		$this->f20170103->EditAttrs["class"] = "form-control";
		$this->f20170103->EditCustomAttributes = "";
		$this->f20170103->EditValue = $this->f20170103->CurrentValue;
		$this->f20170103->PlaceHolder = ew_RemoveHtml($this->f20170103->FldCaption());

		// f20170104
		$this->f20170104->EditAttrs["class"] = "form-control";
		$this->f20170104->EditCustomAttributes = "";
		$this->f20170104->EditValue = $this->f20170104->CurrentValue;
		$this->f20170104->PlaceHolder = ew_RemoveHtml($this->f20170104->FldCaption());

		// f20170105
		$this->f20170105->EditAttrs["class"] = "form-control";
		$this->f20170105->EditCustomAttributes = "";
		$this->f20170105->EditValue = $this->f20170105->CurrentValue;
		$this->f20170105->PlaceHolder = ew_RemoveHtml($this->f20170105->FldCaption());

		// f20170106
		$this->f20170106->EditAttrs["class"] = "form-control";
		$this->f20170106->EditCustomAttributes = "";
		$this->f20170106->EditValue = $this->f20170106->CurrentValue;
		$this->f20170106->PlaceHolder = ew_RemoveHtml($this->f20170106->FldCaption());

		// f20170107
		$this->f20170107->EditAttrs["class"] = "form-control";
		$this->f20170107->EditCustomAttributes = "";
		$this->f20170107->EditValue = $this->f20170107->CurrentValue;
		$this->f20170107->PlaceHolder = ew_RemoveHtml($this->f20170107->FldCaption());

		// f20170108
		$this->f20170108->EditAttrs["class"] = "form-control";
		$this->f20170108->EditCustomAttributes = "";
		$this->f20170108->EditValue = $this->f20170108->CurrentValue;
		$this->f20170108->PlaceHolder = ew_RemoveHtml($this->f20170108->FldCaption());

		// f20170109
		$this->f20170109->EditAttrs["class"] = "form-control";
		$this->f20170109->EditCustomAttributes = "";
		$this->f20170109->EditValue = $this->f20170109->CurrentValue;
		$this->f20170109->PlaceHolder = ew_RemoveHtml($this->f20170109->FldCaption());

		// f20170110
		$this->f20170110->EditAttrs["class"] = "form-control";
		$this->f20170110->EditCustomAttributes = "";
		$this->f20170110->EditValue = $this->f20170110->CurrentValue;
		$this->f20170110->PlaceHolder = ew_RemoveHtml($this->f20170110->FldCaption());

		// f20170111
		$this->f20170111->EditAttrs["class"] = "form-control";
		$this->f20170111->EditCustomAttributes = "";
		$this->f20170111->EditValue = $this->f20170111->CurrentValue;
		$this->f20170111->PlaceHolder = ew_RemoveHtml($this->f20170111->FldCaption());

		// f20170112
		$this->f20170112->EditAttrs["class"] = "form-control";
		$this->f20170112->EditCustomAttributes = "";
		$this->f20170112->EditValue = $this->f20170112->CurrentValue;
		$this->f20170112->PlaceHolder = ew_RemoveHtml($this->f20170112->FldCaption());

		// f20170113
		$this->f20170113->EditAttrs["class"] = "form-control";
		$this->f20170113->EditCustomAttributes = "";
		$this->f20170113->EditValue = $this->f20170113->CurrentValue;
		$this->f20170113->PlaceHolder = ew_RemoveHtml($this->f20170113->FldCaption());

		// f20170114
		$this->f20170114->EditAttrs["class"] = "form-control";
		$this->f20170114->EditCustomAttributes = "";
		$this->f20170114->EditValue = $this->f20170114->CurrentValue;
		$this->f20170114->PlaceHolder = ew_RemoveHtml($this->f20170114->FldCaption());

		// f20170115
		$this->f20170115->EditAttrs["class"] = "form-control";
		$this->f20170115->EditCustomAttributes = "";
		$this->f20170115->EditValue = $this->f20170115->CurrentValue;
		$this->f20170115->PlaceHolder = ew_RemoveHtml($this->f20170115->FldCaption());

		// f20170116
		$this->f20170116->EditAttrs["class"] = "form-control";
		$this->f20170116->EditCustomAttributes = "";
		$this->f20170116->EditValue = $this->f20170116->CurrentValue;
		$this->f20170116->PlaceHolder = ew_RemoveHtml($this->f20170116->FldCaption());

		// f20170117
		$this->f20170117->EditAttrs["class"] = "form-control";
		$this->f20170117->EditCustomAttributes = "";
		$this->f20170117->EditValue = $this->f20170117->CurrentValue;
		$this->f20170117->PlaceHolder = ew_RemoveHtml($this->f20170117->FldCaption());

		// f20170118
		$this->f20170118->EditAttrs["class"] = "form-control";
		$this->f20170118->EditCustomAttributes = "";
		$this->f20170118->EditValue = $this->f20170118->CurrentValue;
		$this->f20170118->PlaceHolder = ew_RemoveHtml($this->f20170118->FldCaption());

		// f20170119
		$this->f20170119->EditAttrs["class"] = "form-control";
		$this->f20170119->EditCustomAttributes = "";
		$this->f20170119->EditValue = $this->f20170119->CurrentValue;
		$this->f20170119->PlaceHolder = ew_RemoveHtml($this->f20170119->FldCaption());

		// f20170120
		$this->f20170120->EditAttrs["class"] = "form-control";
		$this->f20170120->EditCustomAttributes = "";
		$this->f20170120->EditValue = $this->f20170120->CurrentValue;
		$this->f20170120->PlaceHolder = ew_RemoveHtml($this->f20170120->FldCaption());

		// f20170121
		$this->f20170121->EditAttrs["class"] = "form-control";
		$this->f20170121->EditCustomAttributes = "";
		$this->f20170121->EditValue = $this->f20170121->CurrentValue;
		$this->f20170121->PlaceHolder = ew_RemoveHtml($this->f20170121->FldCaption());

		// f20170122
		$this->f20170122->EditAttrs["class"] = "form-control";
		$this->f20170122->EditCustomAttributes = "";
		$this->f20170122->EditValue = $this->f20170122->CurrentValue;
		$this->f20170122->PlaceHolder = ew_RemoveHtml($this->f20170122->FldCaption());

		// f20170123
		$this->f20170123->EditAttrs["class"] = "form-control";
		$this->f20170123->EditCustomAttributes = "";
		$this->f20170123->EditValue = $this->f20170123->CurrentValue;
		$this->f20170123->PlaceHolder = ew_RemoveHtml($this->f20170123->FldCaption());

		// f20170124
		$this->f20170124->EditAttrs["class"] = "form-control";
		$this->f20170124->EditCustomAttributes = "";
		$this->f20170124->EditValue = $this->f20170124->CurrentValue;
		$this->f20170124->PlaceHolder = ew_RemoveHtml($this->f20170124->FldCaption());

		// f20170125
		$this->f20170125->EditAttrs["class"] = "form-control";
		$this->f20170125->EditCustomAttributes = "";
		$this->f20170125->EditValue = $this->f20170125->CurrentValue;
		$this->f20170125->PlaceHolder = ew_RemoveHtml($this->f20170125->FldCaption());

		// f20170126
		$this->f20170126->EditAttrs["class"] = "form-control";
		$this->f20170126->EditCustomAttributes = "";
		$this->f20170126->EditValue = $this->f20170126->CurrentValue;
		$this->f20170126->PlaceHolder = ew_RemoveHtml($this->f20170126->FldCaption());

		// f20170127
		$this->f20170127->EditAttrs["class"] = "form-control";
		$this->f20170127->EditCustomAttributes = "";
		$this->f20170127->EditValue = $this->f20170127->CurrentValue;
		$this->f20170127->PlaceHolder = ew_RemoveHtml($this->f20170127->FldCaption());

		// f20170128
		$this->f20170128->EditAttrs["class"] = "form-control";
		$this->f20170128->EditCustomAttributes = "";
		$this->f20170128->EditValue = $this->f20170128->CurrentValue;
		$this->f20170128->PlaceHolder = ew_RemoveHtml($this->f20170128->FldCaption());

		// f20170129
		$this->f20170129->EditAttrs["class"] = "form-control";
		$this->f20170129->EditCustomAttributes = "";
		$this->f20170129->EditValue = $this->f20170129->CurrentValue;
		$this->f20170129->PlaceHolder = ew_RemoveHtml($this->f20170129->FldCaption());

		// f20170130
		$this->f20170130->EditAttrs["class"] = "form-control";
		$this->f20170130->EditCustomAttributes = "";
		$this->f20170130->EditValue = $this->f20170130->CurrentValue;
		$this->f20170130->PlaceHolder = ew_RemoveHtml($this->f20170130->FldCaption());

		// f20170131
		$this->f20170131->EditAttrs["class"] = "form-control";
		$this->f20170131->EditCustomAttributes = "";
		$this->f20170131->EditValue = $this->f20170131->CurrentValue;
		$this->f20170131->PlaceHolder = ew_RemoveHtml($this->f20170131->FldCaption());

		// f20170201
		$this->f20170201->EditAttrs["class"] = "form-control";
		$this->f20170201->EditCustomAttributes = "";
		$this->f20170201->EditValue = $this->f20170201->CurrentValue;
		$this->f20170201->PlaceHolder = ew_RemoveHtml($this->f20170201->FldCaption());

		// f20170202
		$this->f20170202->EditAttrs["class"] = "form-control";
		$this->f20170202->EditCustomAttributes = "";
		$this->f20170202->EditValue = $this->f20170202->CurrentValue;
		$this->f20170202->PlaceHolder = ew_RemoveHtml($this->f20170202->FldCaption());

		// f20170203
		$this->f20170203->EditAttrs["class"] = "form-control";
		$this->f20170203->EditCustomAttributes = "";
		$this->f20170203->EditValue = $this->f20170203->CurrentValue;
		$this->f20170203->PlaceHolder = ew_RemoveHtml($this->f20170203->FldCaption());

		// f20170204
		$this->f20170204->EditAttrs["class"] = "form-control";
		$this->f20170204->EditCustomAttributes = "";
		$this->f20170204->EditValue = $this->f20170204->CurrentValue;
		$this->f20170204->PlaceHolder = ew_RemoveHtml($this->f20170204->FldCaption());

		// f20170205
		$this->f20170205->EditAttrs["class"] = "form-control";
		$this->f20170205->EditCustomAttributes = "";
		$this->f20170205->EditValue = $this->f20170205->CurrentValue;
		$this->f20170205->PlaceHolder = ew_RemoveHtml($this->f20170205->FldCaption());

		// f20170206
		$this->f20170206->EditAttrs["class"] = "form-control";
		$this->f20170206->EditCustomAttributes = "";
		$this->f20170206->EditValue = $this->f20170206->CurrentValue;
		$this->f20170206->PlaceHolder = ew_RemoveHtml($this->f20170206->FldCaption());

		// f20170207
		$this->f20170207->EditAttrs["class"] = "form-control";
		$this->f20170207->EditCustomAttributes = "";
		$this->f20170207->EditValue = $this->f20170207->CurrentValue;
		$this->f20170207->PlaceHolder = ew_RemoveHtml($this->f20170207->FldCaption());

		// f20170208
		$this->f20170208->EditAttrs["class"] = "form-control";
		$this->f20170208->EditCustomAttributes = "";
		$this->f20170208->EditValue = $this->f20170208->CurrentValue;
		$this->f20170208->PlaceHolder = ew_RemoveHtml($this->f20170208->FldCaption());

		// f20170209
		$this->f20170209->EditAttrs["class"] = "form-control";
		$this->f20170209->EditCustomAttributes = "";
		$this->f20170209->EditValue = $this->f20170209->CurrentValue;
		$this->f20170209->PlaceHolder = ew_RemoveHtml($this->f20170209->FldCaption());

		// f20170210
		$this->f20170210->EditAttrs["class"] = "form-control";
		$this->f20170210->EditCustomAttributes = "";
		$this->f20170210->EditValue = $this->f20170210->CurrentValue;
		$this->f20170210->PlaceHolder = ew_RemoveHtml($this->f20170210->FldCaption());

		// f20170211
		$this->f20170211->EditAttrs["class"] = "form-control";
		$this->f20170211->EditCustomAttributes = "";
		$this->f20170211->EditValue = $this->f20170211->CurrentValue;
		$this->f20170211->PlaceHolder = ew_RemoveHtml($this->f20170211->FldCaption());

		// f20170212
		$this->f20170212->EditAttrs["class"] = "form-control";
		$this->f20170212->EditCustomAttributes = "";
		$this->f20170212->EditValue = $this->f20170212->CurrentValue;
		$this->f20170212->PlaceHolder = ew_RemoveHtml($this->f20170212->FldCaption());

		// f20170213
		$this->f20170213->EditAttrs["class"] = "form-control";
		$this->f20170213->EditCustomAttributes = "";
		$this->f20170213->EditValue = $this->f20170213->CurrentValue;
		$this->f20170213->PlaceHolder = ew_RemoveHtml($this->f20170213->FldCaption());

		// f20170214
		$this->f20170214->EditAttrs["class"] = "form-control";
		$this->f20170214->EditCustomAttributes = "";
		$this->f20170214->EditValue = $this->f20170214->CurrentValue;
		$this->f20170214->PlaceHolder = ew_RemoveHtml($this->f20170214->FldCaption());

		// f20170215
		$this->f20170215->EditAttrs["class"] = "form-control";
		$this->f20170215->EditCustomAttributes = "";
		$this->f20170215->EditValue = $this->f20170215->CurrentValue;
		$this->f20170215->PlaceHolder = ew_RemoveHtml($this->f20170215->FldCaption());

		// f20170216
		$this->f20170216->EditAttrs["class"] = "form-control";
		$this->f20170216->EditCustomAttributes = "";
		$this->f20170216->EditValue = $this->f20170216->CurrentValue;
		$this->f20170216->PlaceHolder = ew_RemoveHtml($this->f20170216->FldCaption());

		// f20170217
		$this->f20170217->EditAttrs["class"] = "form-control";
		$this->f20170217->EditCustomAttributes = "";
		$this->f20170217->EditValue = $this->f20170217->CurrentValue;
		$this->f20170217->PlaceHolder = ew_RemoveHtml($this->f20170217->FldCaption());

		// f20170218
		$this->f20170218->EditAttrs["class"] = "form-control";
		$this->f20170218->EditCustomAttributes = "";
		$this->f20170218->EditValue = $this->f20170218->CurrentValue;
		$this->f20170218->PlaceHolder = ew_RemoveHtml($this->f20170218->FldCaption());

		// f20170219
		$this->f20170219->EditAttrs["class"] = "form-control";
		$this->f20170219->EditCustomAttributes = "";
		$this->f20170219->EditValue = $this->f20170219->CurrentValue;
		$this->f20170219->PlaceHolder = ew_RemoveHtml($this->f20170219->FldCaption());

		// f20170220
		$this->f20170220->EditAttrs["class"] = "form-control";
		$this->f20170220->EditCustomAttributes = "";
		$this->f20170220->EditValue = $this->f20170220->CurrentValue;
		$this->f20170220->PlaceHolder = ew_RemoveHtml($this->f20170220->FldCaption());

		// f20170221
		$this->f20170221->EditAttrs["class"] = "form-control";
		$this->f20170221->EditCustomAttributes = "";
		$this->f20170221->EditValue = $this->f20170221->CurrentValue;
		$this->f20170221->PlaceHolder = ew_RemoveHtml($this->f20170221->FldCaption());

		// f20170222
		$this->f20170222->EditAttrs["class"] = "form-control";
		$this->f20170222->EditCustomAttributes = "";
		$this->f20170222->EditValue = $this->f20170222->CurrentValue;
		$this->f20170222->PlaceHolder = ew_RemoveHtml($this->f20170222->FldCaption());

		// f20170223
		$this->f20170223->EditAttrs["class"] = "form-control";
		$this->f20170223->EditCustomAttributes = "";
		$this->f20170223->EditValue = $this->f20170223->CurrentValue;
		$this->f20170223->PlaceHolder = ew_RemoveHtml($this->f20170223->FldCaption());

		// f20170224
		$this->f20170224->EditAttrs["class"] = "form-control";
		$this->f20170224->EditCustomAttributes = "";
		$this->f20170224->EditValue = $this->f20170224->CurrentValue;
		$this->f20170224->PlaceHolder = ew_RemoveHtml($this->f20170224->FldCaption());

		// f20170225
		$this->f20170225->EditAttrs["class"] = "form-control";
		$this->f20170225->EditCustomAttributes = "";
		$this->f20170225->EditValue = $this->f20170225->CurrentValue;
		$this->f20170225->PlaceHolder = ew_RemoveHtml($this->f20170225->FldCaption());

		// f20170226
		$this->f20170226->EditAttrs["class"] = "form-control";
		$this->f20170226->EditCustomAttributes = "";
		$this->f20170226->EditValue = $this->f20170226->CurrentValue;
		$this->f20170226->PlaceHolder = ew_RemoveHtml($this->f20170226->FldCaption());

		// f20170227
		$this->f20170227->EditAttrs["class"] = "form-control";
		$this->f20170227->EditCustomAttributes = "";
		$this->f20170227->EditValue = $this->f20170227->CurrentValue;
		$this->f20170227->PlaceHolder = ew_RemoveHtml($this->f20170227->FldCaption());

		// f20170228
		$this->f20170228->EditAttrs["class"] = "form-control";
		$this->f20170228->EditCustomAttributes = "";
		$this->f20170228->EditValue = $this->f20170228->CurrentValue;
		$this->f20170228->PlaceHolder = ew_RemoveHtml($this->f20170228->FldCaption());

		// f20170229
		$this->f20170229->EditAttrs["class"] = "form-control";
		$this->f20170229->EditCustomAttributes = "";
		$this->f20170229->EditValue = $this->f20170229->CurrentValue;
		$this->f20170229->PlaceHolder = ew_RemoveHtml($this->f20170229->FldCaption());

		// f20170301
		$this->f20170301->EditAttrs["class"] = "form-control";
		$this->f20170301->EditCustomAttributes = "";
		$this->f20170301->EditValue = $this->f20170301->CurrentValue;
		$this->f20170301->PlaceHolder = ew_RemoveHtml($this->f20170301->FldCaption());

		// f20170302
		$this->f20170302->EditAttrs["class"] = "form-control";
		$this->f20170302->EditCustomAttributes = "";
		$this->f20170302->EditValue = $this->f20170302->CurrentValue;
		$this->f20170302->PlaceHolder = ew_RemoveHtml($this->f20170302->FldCaption());

		// f20170303
		$this->f20170303->EditAttrs["class"] = "form-control";
		$this->f20170303->EditCustomAttributes = "";
		$this->f20170303->EditValue = $this->f20170303->CurrentValue;
		$this->f20170303->PlaceHolder = ew_RemoveHtml($this->f20170303->FldCaption());

		// f20170304
		$this->f20170304->EditAttrs["class"] = "form-control";
		$this->f20170304->EditCustomAttributes = "";
		$this->f20170304->EditValue = $this->f20170304->CurrentValue;
		$this->f20170304->PlaceHolder = ew_RemoveHtml($this->f20170304->FldCaption());

		// f20170305
		$this->f20170305->EditAttrs["class"] = "form-control";
		$this->f20170305->EditCustomAttributes = "";
		$this->f20170305->EditValue = $this->f20170305->CurrentValue;
		$this->f20170305->PlaceHolder = ew_RemoveHtml($this->f20170305->FldCaption());

		// f20170306
		$this->f20170306->EditAttrs["class"] = "form-control";
		$this->f20170306->EditCustomAttributes = "";
		$this->f20170306->EditValue = $this->f20170306->CurrentValue;
		$this->f20170306->PlaceHolder = ew_RemoveHtml($this->f20170306->FldCaption());

		// f20170307
		$this->f20170307->EditAttrs["class"] = "form-control";
		$this->f20170307->EditCustomAttributes = "";
		$this->f20170307->EditValue = $this->f20170307->CurrentValue;
		$this->f20170307->PlaceHolder = ew_RemoveHtml($this->f20170307->FldCaption());

		// f20170308
		$this->f20170308->EditAttrs["class"] = "form-control";
		$this->f20170308->EditCustomAttributes = "";
		$this->f20170308->EditValue = $this->f20170308->CurrentValue;
		$this->f20170308->PlaceHolder = ew_RemoveHtml($this->f20170308->FldCaption());

		// f20170309
		$this->f20170309->EditAttrs["class"] = "form-control";
		$this->f20170309->EditCustomAttributes = "";
		$this->f20170309->EditValue = $this->f20170309->CurrentValue;
		$this->f20170309->PlaceHolder = ew_RemoveHtml($this->f20170309->FldCaption());

		// f20170310
		$this->f20170310->EditAttrs["class"] = "form-control";
		$this->f20170310->EditCustomAttributes = "";
		$this->f20170310->EditValue = $this->f20170310->CurrentValue;
		$this->f20170310->PlaceHolder = ew_RemoveHtml($this->f20170310->FldCaption());

		// f20170311
		$this->f20170311->EditAttrs["class"] = "form-control";
		$this->f20170311->EditCustomAttributes = "";
		$this->f20170311->EditValue = $this->f20170311->CurrentValue;
		$this->f20170311->PlaceHolder = ew_RemoveHtml($this->f20170311->FldCaption());

		// f20170312
		$this->f20170312->EditAttrs["class"] = "form-control";
		$this->f20170312->EditCustomAttributes = "";
		$this->f20170312->EditValue = $this->f20170312->CurrentValue;
		$this->f20170312->PlaceHolder = ew_RemoveHtml($this->f20170312->FldCaption());

		// f20170313
		$this->f20170313->EditAttrs["class"] = "form-control";
		$this->f20170313->EditCustomAttributes = "";
		$this->f20170313->EditValue = $this->f20170313->CurrentValue;
		$this->f20170313->PlaceHolder = ew_RemoveHtml($this->f20170313->FldCaption());

		// f20170314
		$this->f20170314->EditAttrs["class"] = "form-control";
		$this->f20170314->EditCustomAttributes = "";
		$this->f20170314->EditValue = $this->f20170314->CurrentValue;
		$this->f20170314->PlaceHolder = ew_RemoveHtml($this->f20170314->FldCaption());

		// f20170315
		$this->f20170315->EditAttrs["class"] = "form-control";
		$this->f20170315->EditCustomAttributes = "";
		$this->f20170315->EditValue = $this->f20170315->CurrentValue;
		$this->f20170315->PlaceHolder = ew_RemoveHtml($this->f20170315->FldCaption());

		// f20170316
		$this->f20170316->EditAttrs["class"] = "form-control";
		$this->f20170316->EditCustomAttributes = "";
		$this->f20170316->EditValue = $this->f20170316->CurrentValue;
		$this->f20170316->PlaceHolder = ew_RemoveHtml($this->f20170316->FldCaption());

		// f20170317
		$this->f20170317->EditAttrs["class"] = "form-control";
		$this->f20170317->EditCustomAttributes = "";
		$this->f20170317->EditValue = $this->f20170317->CurrentValue;
		$this->f20170317->PlaceHolder = ew_RemoveHtml($this->f20170317->FldCaption());

		// f20170318
		$this->f20170318->EditAttrs["class"] = "form-control";
		$this->f20170318->EditCustomAttributes = "";
		$this->f20170318->EditValue = $this->f20170318->CurrentValue;
		$this->f20170318->PlaceHolder = ew_RemoveHtml($this->f20170318->FldCaption());

		// f20170319
		$this->f20170319->EditAttrs["class"] = "form-control";
		$this->f20170319->EditCustomAttributes = "";
		$this->f20170319->EditValue = $this->f20170319->CurrentValue;
		$this->f20170319->PlaceHolder = ew_RemoveHtml($this->f20170319->FldCaption());

		// f20170320
		$this->f20170320->EditAttrs["class"] = "form-control";
		$this->f20170320->EditCustomAttributes = "";
		$this->f20170320->EditValue = $this->f20170320->CurrentValue;
		$this->f20170320->PlaceHolder = ew_RemoveHtml($this->f20170320->FldCaption());

		// f20170321
		$this->f20170321->EditAttrs["class"] = "form-control";
		$this->f20170321->EditCustomAttributes = "";
		$this->f20170321->EditValue = $this->f20170321->CurrentValue;
		$this->f20170321->PlaceHolder = ew_RemoveHtml($this->f20170321->FldCaption());

		// f20170322
		$this->f20170322->EditAttrs["class"] = "form-control";
		$this->f20170322->EditCustomAttributes = "";
		$this->f20170322->EditValue = $this->f20170322->CurrentValue;
		$this->f20170322->PlaceHolder = ew_RemoveHtml($this->f20170322->FldCaption());

		// f20170323
		$this->f20170323->EditAttrs["class"] = "form-control";
		$this->f20170323->EditCustomAttributes = "";
		$this->f20170323->EditValue = $this->f20170323->CurrentValue;
		$this->f20170323->PlaceHolder = ew_RemoveHtml($this->f20170323->FldCaption());

		// f20170324
		$this->f20170324->EditAttrs["class"] = "form-control";
		$this->f20170324->EditCustomAttributes = "";
		$this->f20170324->EditValue = $this->f20170324->CurrentValue;
		$this->f20170324->PlaceHolder = ew_RemoveHtml($this->f20170324->FldCaption());

		// f20170325
		$this->f20170325->EditAttrs["class"] = "form-control";
		$this->f20170325->EditCustomAttributes = "";
		$this->f20170325->EditValue = $this->f20170325->CurrentValue;
		$this->f20170325->PlaceHolder = ew_RemoveHtml($this->f20170325->FldCaption());

		// f20170326
		$this->f20170326->EditAttrs["class"] = "form-control";
		$this->f20170326->EditCustomAttributes = "";
		$this->f20170326->EditValue = $this->f20170326->CurrentValue;
		$this->f20170326->PlaceHolder = ew_RemoveHtml($this->f20170326->FldCaption());

		// f20170327
		$this->f20170327->EditAttrs["class"] = "form-control";
		$this->f20170327->EditCustomAttributes = "";
		$this->f20170327->EditValue = $this->f20170327->CurrentValue;
		$this->f20170327->PlaceHolder = ew_RemoveHtml($this->f20170327->FldCaption());

		// f20170328
		$this->f20170328->EditAttrs["class"] = "form-control";
		$this->f20170328->EditCustomAttributes = "";
		$this->f20170328->EditValue = $this->f20170328->CurrentValue;
		$this->f20170328->PlaceHolder = ew_RemoveHtml($this->f20170328->FldCaption());

		// f20170329
		$this->f20170329->EditAttrs["class"] = "form-control";
		$this->f20170329->EditCustomAttributes = "";
		$this->f20170329->EditValue = $this->f20170329->CurrentValue;
		$this->f20170329->PlaceHolder = ew_RemoveHtml($this->f20170329->FldCaption());

		// f20170330
		$this->f20170330->EditAttrs["class"] = "form-control";
		$this->f20170330->EditCustomAttributes = "";
		$this->f20170330->EditValue = $this->f20170330->CurrentValue;
		$this->f20170330->PlaceHolder = ew_RemoveHtml($this->f20170330->FldCaption());

		// f20170331
		$this->f20170331->EditAttrs["class"] = "form-control";
		$this->f20170331->EditCustomAttributes = "";
		$this->f20170331->EditValue = $this->f20170331->CurrentValue;
		$this->f20170331->PlaceHolder = ew_RemoveHtml($this->f20170331->FldCaption());

		// f20170401
		$this->f20170401->EditAttrs["class"] = "form-control";
		$this->f20170401->EditCustomAttributes = "";
		$this->f20170401->EditValue = $this->f20170401->CurrentValue;
		$this->f20170401->PlaceHolder = ew_RemoveHtml($this->f20170401->FldCaption());

		// f20170402
		$this->f20170402->EditAttrs["class"] = "form-control";
		$this->f20170402->EditCustomAttributes = "";
		$this->f20170402->EditValue = $this->f20170402->CurrentValue;
		$this->f20170402->PlaceHolder = ew_RemoveHtml($this->f20170402->FldCaption());

		// f20170403
		$this->f20170403->EditAttrs["class"] = "form-control";
		$this->f20170403->EditCustomAttributes = "";
		$this->f20170403->EditValue = $this->f20170403->CurrentValue;
		$this->f20170403->PlaceHolder = ew_RemoveHtml($this->f20170403->FldCaption());

		// f20170404
		$this->f20170404->EditAttrs["class"] = "form-control";
		$this->f20170404->EditCustomAttributes = "";
		$this->f20170404->EditValue = $this->f20170404->CurrentValue;
		$this->f20170404->PlaceHolder = ew_RemoveHtml($this->f20170404->FldCaption());

		// f20170405
		$this->f20170405->EditAttrs["class"] = "form-control";
		$this->f20170405->EditCustomAttributes = "";
		$this->f20170405->EditValue = $this->f20170405->CurrentValue;
		$this->f20170405->PlaceHolder = ew_RemoveHtml($this->f20170405->FldCaption());

		// f20170406
		$this->f20170406->EditAttrs["class"] = "form-control";
		$this->f20170406->EditCustomAttributes = "";
		$this->f20170406->EditValue = $this->f20170406->CurrentValue;
		$this->f20170406->PlaceHolder = ew_RemoveHtml($this->f20170406->FldCaption());

		// f20170407
		$this->f20170407->EditAttrs["class"] = "form-control";
		$this->f20170407->EditCustomAttributes = "";
		$this->f20170407->EditValue = $this->f20170407->CurrentValue;
		$this->f20170407->PlaceHolder = ew_RemoveHtml($this->f20170407->FldCaption());

		// f20170408
		$this->f20170408->EditAttrs["class"] = "form-control";
		$this->f20170408->EditCustomAttributes = "";
		$this->f20170408->EditValue = $this->f20170408->CurrentValue;
		$this->f20170408->PlaceHolder = ew_RemoveHtml($this->f20170408->FldCaption());

		// f20170409
		$this->f20170409->EditAttrs["class"] = "form-control";
		$this->f20170409->EditCustomAttributes = "";
		$this->f20170409->EditValue = $this->f20170409->CurrentValue;
		$this->f20170409->PlaceHolder = ew_RemoveHtml($this->f20170409->FldCaption());

		// f20170410
		$this->f20170410->EditAttrs["class"] = "form-control";
		$this->f20170410->EditCustomAttributes = "";
		$this->f20170410->EditValue = $this->f20170410->CurrentValue;
		$this->f20170410->PlaceHolder = ew_RemoveHtml($this->f20170410->FldCaption());

		// f20170411
		$this->f20170411->EditAttrs["class"] = "form-control";
		$this->f20170411->EditCustomAttributes = "";
		$this->f20170411->EditValue = $this->f20170411->CurrentValue;
		$this->f20170411->PlaceHolder = ew_RemoveHtml($this->f20170411->FldCaption());

		// f20170412
		$this->f20170412->EditAttrs["class"] = "form-control";
		$this->f20170412->EditCustomAttributes = "";
		$this->f20170412->EditValue = $this->f20170412->CurrentValue;
		$this->f20170412->PlaceHolder = ew_RemoveHtml($this->f20170412->FldCaption());

		// f20170413
		$this->f20170413->EditAttrs["class"] = "form-control";
		$this->f20170413->EditCustomAttributes = "";
		$this->f20170413->EditValue = $this->f20170413->CurrentValue;
		$this->f20170413->PlaceHolder = ew_RemoveHtml($this->f20170413->FldCaption());

		// f20170414
		$this->f20170414->EditAttrs["class"] = "form-control";
		$this->f20170414->EditCustomAttributes = "";
		$this->f20170414->EditValue = $this->f20170414->CurrentValue;
		$this->f20170414->PlaceHolder = ew_RemoveHtml($this->f20170414->FldCaption());

		// f20170415
		$this->f20170415->EditAttrs["class"] = "form-control";
		$this->f20170415->EditCustomAttributes = "";
		$this->f20170415->EditValue = $this->f20170415->CurrentValue;
		$this->f20170415->PlaceHolder = ew_RemoveHtml($this->f20170415->FldCaption());

		// f20170416
		$this->f20170416->EditAttrs["class"] = "form-control";
		$this->f20170416->EditCustomAttributes = "";
		$this->f20170416->EditValue = $this->f20170416->CurrentValue;
		$this->f20170416->PlaceHolder = ew_RemoveHtml($this->f20170416->FldCaption());

		// f20170417
		$this->f20170417->EditAttrs["class"] = "form-control";
		$this->f20170417->EditCustomAttributes = "";
		$this->f20170417->EditValue = $this->f20170417->CurrentValue;
		$this->f20170417->PlaceHolder = ew_RemoveHtml($this->f20170417->FldCaption());

		// f20170418
		$this->f20170418->EditAttrs["class"] = "form-control";
		$this->f20170418->EditCustomAttributes = "";
		$this->f20170418->EditValue = $this->f20170418->CurrentValue;
		$this->f20170418->PlaceHolder = ew_RemoveHtml($this->f20170418->FldCaption());

		// f20170419
		$this->f20170419->EditAttrs["class"] = "form-control";
		$this->f20170419->EditCustomAttributes = "";
		$this->f20170419->EditValue = $this->f20170419->CurrentValue;
		$this->f20170419->PlaceHolder = ew_RemoveHtml($this->f20170419->FldCaption());

		// f20170420
		$this->f20170420->EditAttrs["class"] = "form-control";
		$this->f20170420->EditCustomAttributes = "";
		$this->f20170420->EditValue = $this->f20170420->CurrentValue;
		$this->f20170420->PlaceHolder = ew_RemoveHtml($this->f20170420->FldCaption());

		// f20170421
		$this->f20170421->EditAttrs["class"] = "form-control";
		$this->f20170421->EditCustomAttributes = "";
		$this->f20170421->EditValue = $this->f20170421->CurrentValue;
		$this->f20170421->PlaceHolder = ew_RemoveHtml($this->f20170421->FldCaption());

		// f20170422
		$this->f20170422->EditAttrs["class"] = "form-control";
		$this->f20170422->EditCustomAttributes = "";
		$this->f20170422->EditValue = $this->f20170422->CurrentValue;
		$this->f20170422->PlaceHolder = ew_RemoveHtml($this->f20170422->FldCaption());

		// f20170423
		$this->f20170423->EditAttrs["class"] = "form-control";
		$this->f20170423->EditCustomAttributes = "";
		$this->f20170423->EditValue = $this->f20170423->CurrentValue;
		$this->f20170423->PlaceHolder = ew_RemoveHtml($this->f20170423->FldCaption());

		// f20170424
		$this->f20170424->EditAttrs["class"] = "form-control";
		$this->f20170424->EditCustomAttributes = "";
		$this->f20170424->EditValue = $this->f20170424->CurrentValue;
		$this->f20170424->PlaceHolder = ew_RemoveHtml($this->f20170424->FldCaption());

		// f20170425
		$this->f20170425->EditAttrs["class"] = "form-control";
		$this->f20170425->EditCustomAttributes = "";
		$this->f20170425->EditValue = $this->f20170425->CurrentValue;
		$this->f20170425->PlaceHolder = ew_RemoveHtml($this->f20170425->FldCaption());

		// f20170426
		$this->f20170426->EditAttrs["class"] = "form-control";
		$this->f20170426->EditCustomAttributes = "";
		$this->f20170426->EditValue = $this->f20170426->CurrentValue;
		$this->f20170426->PlaceHolder = ew_RemoveHtml($this->f20170426->FldCaption());

		// f20170427
		$this->f20170427->EditAttrs["class"] = "form-control";
		$this->f20170427->EditCustomAttributes = "";
		$this->f20170427->EditValue = $this->f20170427->CurrentValue;
		$this->f20170427->PlaceHolder = ew_RemoveHtml($this->f20170427->FldCaption());

		// f20170428
		$this->f20170428->EditAttrs["class"] = "form-control";
		$this->f20170428->EditCustomAttributes = "";
		$this->f20170428->EditValue = $this->f20170428->CurrentValue;
		$this->f20170428->PlaceHolder = ew_RemoveHtml($this->f20170428->FldCaption());

		// f20170429
		$this->f20170429->EditAttrs["class"] = "form-control";
		$this->f20170429->EditCustomAttributes = "";
		$this->f20170429->EditValue = $this->f20170429->CurrentValue;
		$this->f20170429->PlaceHolder = ew_RemoveHtml($this->f20170429->FldCaption());

		// f20170430
		$this->f20170430->EditAttrs["class"] = "form-control";
		$this->f20170430->EditCustomAttributes = "";
		$this->f20170430->EditValue = $this->f20170430->CurrentValue;
		$this->f20170430->PlaceHolder = ew_RemoveHtml($this->f20170430->FldCaption());

		// f20170501
		$this->f20170501->EditAttrs["class"] = "form-control";
		$this->f20170501->EditCustomAttributes = "";
		$this->f20170501->EditValue = $this->f20170501->CurrentValue;
		$this->f20170501->PlaceHolder = ew_RemoveHtml($this->f20170501->FldCaption());

		// f20170502
		$this->f20170502->EditAttrs["class"] = "form-control";
		$this->f20170502->EditCustomAttributes = "";
		$this->f20170502->EditValue = $this->f20170502->CurrentValue;
		$this->f20170502->PlaceHolder = ew_RemoveHtml($this->f20170502->FldCaption());

		// f20170503
		$this->f20170503->EditAttrs["class"] = "form-control";
		$this->f20170503->EditCustomAttributes = "";
		$this->f20170503->EditValue = $this->f20170503->CurrentValue;
		$this->f20170503->PlaceHolder = ew_RemoveHtml($this->f20170503->FldCaption());

		// f20170504
		$this->f20170504->EditAttrs["class"] = "form-control";
		$this->f20170504->EditCustomAttributes = "";
		$this->f20170504->EditValue = $this->f20170504->CurrentValue;
		$this->f20170504->PlaceHolder = ew_RemoveHtml($this->f20170504->FldCaption());

		// f20170505
		$this->f20170505->EditAttrs["class"] = "form-control";
		$this->f20170505->EditCustomAttributes = "";
		$this->f20170505->EditValue = $this->f20170505->CurrentValue;
		$this->f20170505->PlaceHolder = ew_RemoveHtml($this->f20170505->FldCaption());

		// f20170506
		$this->f20170506->EditAttrs["class"] = "form-control";
		$this->f20170506->EditCustomAttributes = "";
		$this->f20170506->EditValue = $this->f20170506->CurrentValue;
		$this->f20170506->PlaceHolder = ew_RemoveHtml($this->f20170506->FldCaption());

		// f20170507
		$this->f20170507->EditAttrs["class"] = "form-control";
		$this->f20170507->EditCustomAttributes = "";
		$this->f20170507->EditValue = $this->f20170507->CurrentValue;
		$this->f20170507->PlaceHolder = ew_RemoveHtml($this->f20170507->FldCaption());

		// f20170508
		$this->f20170508->EditAttrs["class"] = "form-control";
		$this->f20170508->EditCustomAttributes = "";
		$this->f20170508->EditValue = $this->f20170508->CurrentValue;
		$this->f20170508->PlaceHolder = ew_RemoveHtml($this->f20170508->FldCaption());

		// f20170509
		$this->f20170509->EditAttrs["class"] = "form-control";
		$this->f20170509->EditCustomAttributes = "";
		$this->f20170509->EditValue = $this->f20170509->CurrentValue;
		$this->f20170509->PlaceHolder = ew_RemoveHtml($this->f20170509->FldCaption());

		// f20170510
		$this->f20170510->EditAttrs["class"] = "form-control";
		$this->f20170510->EditCustomAttributes = "";
		$this->f20170510->EditValue = $this->f20170510->CurrentValue;
		$this->f20170510->PlaceHolder = ew_RemoveHtml($this->f20170510->FldCaption());

		// f20170511
		$this->f20170511->EditAttrs["class"] = "form-control";
		$this->f20170511->EditCustomAttributes = "";
		$this->f20170511->EditValue = $this->f20170511->CurrentValue;
		$this->f20170511->PlaceHolder = ew_RemoveHtml($this->f20170511->FldCaption());

		// f20170512
		$this->f20170512->EditAttrs["class"] = "form-control";
		$this->f20170512->EditCustomAttributes = "";
		$this->f20170512->EditValue = $this->f20170512->CurrentValue;
		$this->f20170512->PlaceHolder = ew_RemoveHtml($this->f20170512->FldCaption());

		// f20170513
		$this->f20170513->EditAttrs["class"] = "form-control";
		$this->f20170513->EditCustomAttributes = "";
		$this->f20170513->EditValue = $this->f20170513->CurrentValue;
		$this->f20170513->PlaceHolder = ew_RemoveHtml($this->f20170513->FldCaption());

		// f20170514
		$this->f20170514->EditAttrs["class"] = "form-control";
		$this->f20170514->EditCustomAttributes = "";
		$this->f20170514->EditValue = $this->f20170514->CurrentValue;
		$this->f20170514->PlaceHolder = ew_RemoveHtml($this->f20170514->FldCaption());

		// f20170515
		$this->f20170515->EditAttrs["class"] = "form-control";
		$this->f20170515->EditCustomAttributes = "";
		$this->f20170515->EditValue = $this->f20170515->CurrentValue;
		$this->f20170515->PlaceHolder = ew_RemoveHtml($this->f20170515->FldCaption());

		// f20170516
		$this->f20170516->EditAttrs["class"] = "form-control";
		$this->f20170516->EditCustomAttributes = "";
		$this->f20170516->EditValue = $this->f20170516->CurrentValue;
		$this->f20170516->PlaceHolder = ew_RemoveHtml($this->f20170516->FldCaption());

		// f20170517
		$this->f20170517->EditAttrs["class"] = "form-control";
		$this->f20170517->EditCustomAttributes = "";
		$this->f20170517->EditValue = $this->f20170517->CurrentValue;
		$this->f20170517->PlaceHolder = ew_RemoveHtml($this->f20170517->FldCaption());

		// f20170518
		$this->f20170518->EditAttrs["class"] = "form-control";
		$this->f20170518->EditCustomAttributes = "";
		$this->f20170518->EditValue = $this->f20170518->CurrentValue;
		$this->f20170518->PlaceHolder = ew_RemoveHtml($this->f20170518->FldCaption());

		// f20170519
		$this->f20170519->EditAttrs["class"] = "form-control";
		$this->f20170519->EditCustomAttributes = "";
		$this->f20170519->EditValue = $this->f20170519->CurrentValue;
		$this->f20170519->PlaceHolder = ew_RemoveHtml($this->f20170519->FldCaption());

		// f20170520
		$this->f20170520->EditAttrs["class"] = "form-control";
		$this->f20170520->EditCustomAttributes = "";
		$this->f20170520->EditValue = $this->f20170520->CurrentValue;
		$this->f20170520->PlaceHolder = ew_RemoveHtml($this->f20170520->FldCaption());

		// f20170521
		$this->f20170521->EditAttrs["class"] = "form-control";
		$this->f20170521->EditCustomAttributes = "";
		$this->f20170521->EditValue = $this->f20170521->CurrentValue;
		$this->f20170521->PlaceHolder = ew_RemoveHtml($this->f20170521->FldCaption());

		// f20170522
		$this->f20170522->EditAttrs["class"] = "form-control";
		$this->f20170522->EditCustomAttributes = "";
		$this->f20170522->EditValue = $this->f20170522->CurrentValue;
		$this->f20170522->PlaceHolder = ew_RemoveHtml($this->f20170522->FldCaption());

		// f20170523
		$this->f20170523->EditAttrs["class"] = "form-control";
		$this->f20170523->EditCustomAttributes = "";
		$this->f20170523->EditValue = $this->f20170523->CurrentValue;
		$this->f20170523->PlaceHolder = ew_RemoveHtml($this->f20170523->FldCaption());

		// f20170524
		$this->f20170524->EditAttrs["class"] = "form-control";
		$this->f20170524->EditCustomAttributes = "";
		$this->f20170524->EditValue = $this->f20170524->CurrentValue;
		$this->f20170524->PlaceHolder = ew_RemoveHtml($this->f20170524->FldCaption());

		// f20170525
		$this->f20170525->EditAttrs["class"] = "form-control";
		$this->f20170525->EditCustomAttributes = "";
		$this->f20170525->EditValue = $this->f20170525->CurrentValue;
		$this->f20170525->PlaceHolder = ew_RemoveHtml($this->f20170525->FldCaption());

		// f20170526
		$this->f20170526->EditAttrs["class"] = "form-control";
		$this->f20170526->EditCustomAttributes = "";
		$this->f20170526->EditValue = $this->f20170526->CurrentValue;
		$this->f20170526->PlaceHolder = ew_RemoveHtml($this->f20170526->FldCaption());

		// f20170527
		$this->f20170527->EditAttrs["class"] = "form-control";
		$this->f20170527->EditCustomAttributes = "";
		$this->f20170527->EditValue = $this->f20170527->CurrentValue;
		$this->f20170527->PlaceHolder = ew_RemoveHtml($this->f20170527->FldCaption());

		// f20170528
		$this->f20170528->EditAttrs["class"] = "form-control";
		$this->f20170528->EditCustomAttributes = "";
		$this->f20170528->EditValue = $this->f20170528->CurrentValue;
		$this->f20170528->PlaceHolder = ew_RemoveHtml($this->f20170528->FldCaption());

		// f20170529
		$this->f20170529->EditAttrs["class"] = "form-control";
		$this->f20170529->EditCustomAttributes = "";
		$this->f20170529->EditValue = $this->f20170529->CurrentValue;
		$this->f20170529->PlaceHolder = ew_RemoveHtml($this->f20170529->FldCaption());

		// f20170530
		$this->f20170530->EditAttrs["class"] = "form-control";
		$this->f20170530->EditCustomAttributes = "";
		$this->f20170530->EditValue = $this->f20170530->CurrentValue;
		$this->f20170530->PlaceHolder = ew_RemoveHtml($this->f20170530->FldCaption());

		// f20170531
		$this->f20170531->EditAttrs["class"] = "form-control";
		$this->f20170531->EditCustomAttributes = "";
		$this->f20170531->EditValue = $this->f20170531->CurrentValue;
		$this->f20170531->PlaceHolder = ew_RemoveHtml($this->f20170531->FldCaption());

		// f20170601
		$this->f20170601->EditAttrs["class"] = "form-control";
		$this->f20170601->EditCustomAttributes = "";
		$this->f20170601->EditValue = $this->f20170601->CurrentValue;
		$this->f20170601->PlaceHolder = ew_RemoveHtml($this->f20170601->FldCaption());

		// f20170602
		$this->f20170602->EditAttrs["class"] = "form-control";
		$this->f20170602->EditCustomAttributes = "";
		$this->f20170602->EditValue = $this->f20170602->CurrentValue;
		$this->f20170602->PlaceHolder = ew_RemoveHtml($this->f20170602->FldCaption());

		// f20170603
		$this->f20170603->EditAttrs["class"] = "form-control";
		$this->f20170603->EditCustomAttributes = "";
		$this->f20170603->EditValue = $this->f20170603->CurrentValue;
		$this->f20170603->PlaceHolder = ew_RemoveHtml($this->f20170603->FldCaption());

		// f20170604
		$this->f20170604->EditAttrs["class"] = "form-control";
		$this->f20170604->EditCustomAttributes = "";
		$this->f20170604->EditValue = $this->f20170604->CurrentValue;
		$this->f20170604->PlaceHolder = ew_RemoveHtml($this->f20170604->FldCaption());

		// f20170605
		$this->f20170605->EditAttrs["class"] = "form-control";
		$this->f20170605->EditCustomAttributes = "";
		$this->f20170605->EditValue = $this->f20170605->CurrentValue;
		$this->f20170605->PlaceHolder = ew_RemoveHtml($this->f20170605->FldCaption());

		// f20170606
		$this->f20170606->EditAttrs["class"] = "form-control";
		$this->f20170606->EditCustomAttributes = "";
		$this->f20170606->EditValue = $this->f20170606->CurrentValue;
		$this->f20170606->PlaceHolder = ew_RemoveHtml($this->f20170606->FldCaption());

		// f20170607
		$this->f20170607->EditAttrs["class"] = "form-control";
		$this->f20170607->EditCustomAttributes = "";
		$this->f20170607->EditValue = $this->f20170607->CurrentValue;
		$this->f20170607->PlaceHolder = ew_RemoveHtml($this->f20170607->FldCaption());

		// f20170608
		$this->f20170608->EditAttrs["class"] = "form-control";
		$this->f20170608->EditCustomAttributes = "";
		$this->f20170608->EditValue = $this->f20170608->CurrentValue;
		$this->f20170608->PlaceHolder = ew_RemoveHtml($this->f20170608->FldCaption());

		// f20170609
		$this->f20170609->EditAttrs["class"] = "form-control";
		$this->f20170609->EditCustomAttributes = "";
		$this->f20170609->EditValue = $this->f20170609->CurrentValue;
		$this->f20170609->PlaceHolder = ew_RemoveHtml($this->f20170609->FldCaption());

		// f20170610
		$this->f20170610->EditAttrs["class"] = "form-control";
		$this->f20170610->EditCustomAttributes = "";
		$this->f20170610->EditValue = $this->f20170610->CurrentValue;
		$this->f20170610->PlaceHolder = ew_RemoveHtml($this->f20170610->FldCaption());

		// f20170611
		$this->f20170611->EditAttrs["class"] = "form-control";
		$this->f20170611->EditCustomAttributes = "";
		$this->f20170611->EditValue = $this->f20170611->CurrentValue;
		$this->f20170611->PlaceHolder = ew_RemoveHtml($this->f20170611->FldCaption());

		// f20170612
		$this->f20170612->EditAttrs["class"] = "form-control";
		$this->f20170612->EditCustomAttributes = "";
		$this->f20170612->EditValue = $this->f20170612->CurrentValue;
		$this->f20170612->PlaceHolder = ew_RemoveHtml($this->f20170612->FldCaption());

		// f20170613
		$this->f20170613->EditAttrs["class"] = "form-control";
		$this->f20170613->EditCustomAttributes = "";
		$this->f20170613->EditValue = $this->f20170613->CurrentValue;
		$this->f20170613->PlaceHolder = ew_RemoveHtml($this->f20170613->FldCaption());

		// f20170614
		$this->f20170614->EditAttrs["class"] = "form-control";
		$this->f20170614->EditCustomAttributes = "";
		$this->f20170614->EditValue = $this->f20170614->CurrentValue;
		$this->f20170614->PlaceHolder = ew_RemoveHtml($this->f20170614->FldCaption());

		// f20170615
		$this->f20170615->EditAttrs["class"] = "form-control";
		$this->f20170615->EditCustomAttributes = "";
		$this->f20170615->EditValue = $this->f20170615->CurrentValue;
		$this->f20170615->PlaceHolder = ew_RemoveHtml($this->f20170615->FldCaption());

		// f20170616
		$this->f20170616->EditAttrs["class"] = "form-control";
		$this->f20170616->EditCustomAttributes = "";
		$this->f20170616->EditValue = $this->f20170616->CurrentValue;
		$this->f20170616->PlaceHolder = ew_RemoveHtml($this->f20170616->FldCaption());

		// f20170617
		$this->f20170617->EditAttrs["class"] = "form-control";
		$this->f20170617->EditCustomAttributes = "";
		$this->f20170617->EditValue = $this->f20170617->CurrentValue;
		$this->f20170617->PlaceHolder = ew_RemoveHtml($this->f20170617->FldCaption());

		// f20170618
		$this->f20170618->EditAttrs["class"] = "form-control";
		$this->f20170618->EditCustomAttributes = "";
		$this->f20170618->EditValue = $this->f20170618->CurrentValue;
		$this->f20170618->PlaceHolder = ew_RemoveHtml($this->f20170618->FldCaption());

		// f20170619
		$this->f20170619->EditAttrs["class"] = "form-control";
		$this->f20170619->EditCustomAttributes = "";
		$this->f20170619->EditValue = $this->f20170619->CurrentValue;
		$this->f20170619->PlaceHolder = ew_RemoveHtml($this->f20170619->FldCaption());

		// f20170620
		$this->f20170620->EditAttrs["class"] = "form-control";
		$this->f20170620->EditCustomAttributes = "";
		$this->f20170620->EditValue = $this->f20170620->CurrentValue;
		$this->f20170620->PlaceHolder = ew_RemoveHtml($this->f20170620->FldCaption());

		// f20170621
		$this->f20170621->EditAttrs["class"] = "form-control";
		$this->f20170621->EditCustomAttributes = "";
		$this->f20170621->EditValue = $this->f20170621->CurrentValue;
		$this->f20170621->PlaceHolder = ew_RemoveHtml($this->f20170621->FldCaption());

		// f20170622
		$this->f20170622->EditAttrs["class"] = "form-control";
		$this->f20170622->EditCustomAttributes = "";
		$this->f20170622->EditValue = $this->f20170622->CurrentValue;
		$this->f20170622->PlaceHolder = ew_RemoveHtml($this->f20170622->FldCaption());

		// f20170623
		$this->f20170623->EditAttrs["class"] = "form-control";
		$this->f20170623->EditCustomAttributes = "";
		$this->f20170623->EditValue = $this->f20170623->CurrentValue;
		$this->f20170623->PlaceHolder = ew_RemoveHtml($this->f20170623->FldCaption());

		// f20170624
		$this->f20170624->EditAttrs["class"] = "form-control";
		$this->f20170624->EditCustomAttributes = "";
		$this->f20170624->EditValue = $this->f20170624->CurrentValue;
		$this->f20170624->PlaceHolder = ew_RemoveHtml($this->f20170624->FldCaption());

		// f20170625
		$this->f20170625->EditAttrs["class"] = "form-control";
		$this->f20170625->EditCustomAttributes = "";
		$this->f20170625->EditValue = $this->f20170625->CurrentValue;
		$this->f20170625->PlaceHolder = ew_RemoveHtml($this->f20170625->FldCaption());

		// f20170626
		$this->f20170626->EditAttrs["class"] = "form-control";
		$this->f20170626->EditCustomAttributes = "";
		$this->f20170626->EditValue = $this->f20170626->CurrentValue;
		$this->f20170626->PlaceHolder = ew_RemoveHtml($this->f20170626->FldCaption());

		// f20170627
		$this->f20170627->EditAttrs["class"] = "form-control";
		$this->f20170627->EditCustomAttributes = "";
		$this->f20170627->EditValue = $this->f20170627->CurrentValue;
		$this->f20170627->PlaceHolder = ew_RemoveHtml($this->f20170627->FldCaption());

		// f20170628
		$this->f20170628->EditAttrs["class"] = "form-control";
		$this->f20170628->EditCustomAttributes = "";
		$this->f20170628->EditValue = $this->f20170628->CurrentValue;
		$this->f20170628->PlaceHolder = ew_RemoveHtml($this->f20170628->FldCaption());

		// f20170629
		$this->f20170629->EditAttrs["class"] = "form-control";
		$this->f20170629->EditCustomAttributes = "";
		$this->f20170629->EditValue = $this->f20170629->CurrentValue;
		$this->f20170629->PlaceHolder = ew_RemoveHtml($this->f20170629->FldCaption());

		// f20170630
		$this->f20170630->EditAttrs["class"] = "form-control";
		$this->f20170630->EditCustomAttributes = "";
		$this->f20170630->EditValue = $this->f20170630->CurrentValue;
		$this->f20170630->PlaceHolder = ew_RemoveHtml($this->f20170630->FldCaption());

		// f20170701
		$this->f20170701->EditAttrs["class"] = "form-control";
		$this->f20170701->EditCustomAttributes = "";
		$this->f20170701->EditValue = $this->f20170701->CurrentValue;
		$this->f20170701->PlaceHolder = ew_RemoveHtml($this->f20170701->FldCaption());

		// f20170702
		$this->f20170702->EditAttrs["class"] = "form-control";
		$this->f20170702->EditCustomAttributes = "";
		$this->f20170702->EditValue = $this->f20170702->CurrentValue;
		$this->f20170702->PlaceHolder = ew_RemoveHtml($this->f20170702->FldCaption());

		// f20170703
		$this->f20170703->EditAttrs["class"] = "form-control";
		$this->f20170703->EditCustomAttributes = "";
		$this->f20170703->EditValue = $this->f20170703->CurrentValue;
		$this->f20170703->PlaceHolder = ew_RemoveHtml($this->f20170703->FldCaption());

		// f20170704
		$this->f20170704->EditAttrs["class"] = "form-control";
		$this->f20170704->EditCustomAttributes = "";
		$this->f20170704->EditValue = $this->f20170704->CurrentValue;
		$this->f20170704->PlaceHolder = ew_RemoveHtml($this->f20170704->FldCaption());

		// f20170705
		$this->f20170705->EditAttrs["class"] = "form-control";
		$this->f20170705->EditCustomAttributes = "";
		$this->f20170705->EditValue = $this->f20170705->CurrentValue;
		$this->f20170705->PlaceHolder = ew_RemoveHtml($this->f20170705->FldCaption());

		// f20170706
		$this->f20170706->EditAttrs["class"] = "form-control";
		$this->f20170706->EditCustomAttributes = "";
		$this->f20170706->EditValue = $this->f20170706->CurrentValue;
		$this->f20170706->PlaceHolder = ew_RemoveHtml($this->f20170706->FldCaption());

		// f20170707
		$this->f20170707->EditAttrs["class"] = "form-control";
		$this->f20170707->EditCustomAttributes = "";
		$this->f20170707->EditValue = $this->f20170707->CurrentValue;
		$this->f20170707->PlaceHolder = ew_RemoveHtml($this->f20170707->FldCaption());

		// f20170708
		$this->f20170708->EditAttrs["class"] = "form-control";
		$this->f20170708->EditCustomAttributes = "";
		$this->f20170708->EditValue = $this->f20170708->CurrentValue;
		$this->f20170708->PlaceHolder = ew_RemoveHtml($this->f20170708->FldCaption());

		// f20170709
		$this->f20170709->EditAttrs["class"] = "form-control";
		$this->f20170709->EditCustomAttributes = "";
		$this->f20170709->EditValue = $this->f20170709->CurrentValue;
		$this->f20170709->PlaceHolder = ew_RemoveHtml($this->f20170709->FldCaption());

		// f20170710
		$this->f20170710->EditAttrs["class"] = "form-control";
		$this->f20170710->EditCustomAttributes = "";
		$this->f20170710->EditValue = $this->f20170710->CurrentValue;
		$this->f20170710->PlaceHolder = ew_RemoveHtml($this->f20170710->FldCaption());

		// f20170711
		$this->f20170711->EditAttrs["class"] = "form-control";
		$this->f20170711->EditCustomAttributes = "";
		$this->f20170711->EditValue = $this->f20170711->CurrentValue;
		$this->f20170711->PlaceHolder = ew_RemoveHtml($this->f20170711->FldCaption());

		// f20170712
		$this->f20170712->EditAttrs["class"] = "form-control";
		$this->f20170712->EditCustomAttributes = "";
		$this->f20170712->EditValue = $this->f20170712->CurrentValue;
		$this->f20170712->PlaceHolder = ew_RemoveHtml($this->f20170712->FldCaption());

		// f20170713
		$this->f20170713->EditAttrs["class"] = "form-control";
		$this->f20170713->EditCustomAttributes = "";
		$this->f20170713->EditValue = $this->f20170713->CurrentValue;
		$this->f20170713->PlaceHolder = ew_RemoveHtml($this->f20170713->FldCaption());

		// f20170714
		$this->f20170714->EditAttrs["class"] = "form-control";
		$this->f20170714->EditCustomAttributes = "";
		$this->f20170714->EditValue = $this->f20170714->CurrentValue;
		$this->f20170714->PlaceHolder = ew_RemoveHtml($this->f20170714->FldCaption());

		// f20170715
		$this->f20170715->EditAttrs["class"] = "form-control";
		$this->f20170715->EditCustomAttributes = "";
		$this->f20170715->EditValue = $this->f20170715->CurrentValue;
		$this->f20170715->PlaceHolder = ew_RemoveHtml($this->f20170715->FldCaption());

		// f20170716
		$this->f20170716->EditAttrs["class"] = "form-control";
		$this->f20170716->EditCustomAttributes = "";
		$this->f20170716->EditValue = $this->f20170716->CurrentValue;
		$this->f20170716->PlaceHolder = ew_RemoveHtml($this->f20170716->FldCaption());

		// f20170717
		$this->f20170717->EditAttrs["class"] = "form-control";
		$this->f20170717->EditCustomAttributes = "";
		$this->f20170717->EditValue = $this->f20170717->CurrentValue;
		$this->f20170717->PlaceHolder = ew_RemoveHtml($this->f20170717->FldCaption());

		// f20170718
		$this->f20170718->EditAttrs["class"] = "form-control";
		$this->f20170718->EditCustomAttributes = "";
		$this->f20170718->EditValue = $this->f20170718->CurrentValue;
		$this->f20170718->PlaceHolder = ew_RemoveHtml($this->f20170718->FldCaption());

		// f20170719
		$this->f20170719->EditAttrs["class"] = "form-control";
		$this->f20170719->EditCustomAttributes = "";
		$this->f20170719->EditValue = $this->f20170719->CurrentValue;
		$this->f20170719->PlaceHolder = ew_RemoveHtml($this->f20170719->FldCaption());

		// f20170720
		$this->f20170720->EditAttrs["class"] = "form-control";
		$this->f20170720->EditCustomAttributes = "";
		$this->f20170720->EditValue = $this->f20170720->CurrentValue;
		$this->f20170720->PlaceHolder = ew_RemoveHtml($this->f20170720->FldCaption());

		// f20170721
		$this->f20170721->EditAttrs["class"] = "form-control";
		$this->f20170721->EditCustomAttributes = "";
		$this->f20170721->EditValue = $this->f20170721->CurrentValue;
		$this->f20170721->PlaceHolder = ew_RemoveHtml($this->f20170721->FldCaption());

		// f20170722
		$this->f20170722->EditAttrs["class"] = "form-control";
		$this->f20170722->EditCustomAttributes = "";
		$this->f20170722->EditValue = $this->f20170722->CurrentValue;
		$this->f20170722->PlaceHolder = ew_RemoveHtml($this->f20170722->FldCaption());

		// f20170723
		$this->f20170723->EditAttrs["class"] = "form-control";
		$this->f20170723->EditCustomAttributes = "";
		$this->f20170723->EditValue = $this->f20170723->CurrentValue;
		$this->f20170723->PlaceHolder = ew_RemoveHtml($this->f20170723->FldCaption());

		// f20170724
		$this->f20170724->EditAttrs["class"] = "form-control";
		$this->f20170724->EditCustomAttributes = "";
		$this->f20170724->EditValue = $this->f20170724->CurrentValue;
		$this->f20170724->PlaceHolder = ew_RemoveHtml($this->f20170724->FldCaption());

		// f20170725
		$this->f20170725->EditAttrs["class"] = "form-control";
		$this->f20170725->EditCustomAttributes = "";
		$this->f20170725->EditValue = $this->f20170725->CurrentValue;
		$this->f20170725->PlaceHolder = ew_RemoveHtml($this->f20170725->FldCaption());

		// f20170726
		$this->f20170726->EditAttrs["class"] = "form-control";
		$this->f20170726->EditCustomAttributes = "";
		$this->f20170726->EditValue = $this->f20170726->CurrentValue;
		$this->f20170726->PlaceHolder = ew_RemoveHtml($this->f20170726->FldCaption());

		// f20170727
		$this->f20170727->EditAttrs["class"] = "form-control";
		$this->f20170727->EditCustomAttributes = "";
		$this->f20170727->EditValue = $this->f20170727->CurrentValue;
		$this->f20170727->PlaceHolder = ew_RemoveHtml($this->f20170727->FldCaption());

		// f20170728
		$this->f20170728->EditAttrs["class"] = "form-control";
		$this->f20170728->EditCustomAttributes = "";
		$this->f20170728->EditValue = $this->f20170728->CurrentValue;
		$this->f20170728->PlaceHolder = ew_RemoveHtml($this->f20170728->FldCaption());

		// f20170729
		$this->f20170729->EditAttrs["class"] = "form-control";
		$this->f20170729->EditCustomAttributes = "";
		$this->f20170729->EditValue = $this->f20170729->CurrentValue;
		$this->f20170729->PlaceHolder = ew_RemoveHtml($this->f20170729->FldCaption());

		// f20170730
		$this->f20170730->EditAttrs["class"] = "form-control";
		$this->f20170730->EditCustomAttributes = "";
		$this->f20170730->EditValue = $this->f20170730->CurrentValue;
		$this->f20170730->PlaceHolder = ew_RemoveHtml($this->f20170730->FldCaption());

		// f20170731
		$this->f20170731->EditAttrs["class"] = "form-control";
		$this->f20170731->EditCustomAttributes = "";
		$this->f20170731->EditValue = $this->f20170731->CurrentValue;
		$this->f20170731->PlaceHolder = ew_RemoveHtml($this->f20170731->FldCaption());

		// f20170801
		$this->f20170801->EditAttrs["class"] = "form-control";
		$this->f20170801->EditCustomAttributes = "";
		$this->f20170801->EditValue = $this->f20170801->CurrentValue;
		$this->f20170801->PlaceHolder = ew_RemoveHtml($this->f20170801->FldCaption());

		// f20170802
		$this->f20170802->EditAttrs["class"] = "form-control";
		$this->f20170802->EditCustomAttributes = "";
		$this->f20170802->EditValue = $this->f20170802->CurrentValue;
		$this->f20170802->PlaceHolder = ew_RemoveHtml($this->f20170802->FldCaption());

		// f20170803
		$this->f20170803->EditAttrs["class"] = "form-control";
		$this->f20170803->EditCustomAttributes = "";
		$this->f20170803->EditValue = $this->f20170803->CurrentValue;
		$this->f20170803->PlaceHolder = ew_RemoveHtml($this->f20170803->FldCaption());

		// f20170804
		$this->f20170804->EditAttrs["class"] = "form-control";
		$this->f20170804->EditCustomAttributes = "";
		$this->f20170804->EditValue = $this->f20170804->CurrentValue;
		$this->f20170804->PlaceHolder = ew_RemoveHtml($this->f20170804->FldCaption());

		// f20170805
		$this->f20170805->EditAttrs["class"] = "form-control";
		$this->f20170805->EditCustomAttributes = "";
		$this->f20170805->EditValue = $this->f20170805->CurrentValue;
		$this->f20170805->PlaceHolder = ew_RemoveHtml($this->f20170805->FldCaption());

		// f20170806
		$this->f20170806->EditAttrs["class"] = "form-control";
		$this->f20170806->EditCustomAttributes = "";
		$this->f20170806->EditValue = $this->f20170806->CurrentValue;
		$this->f20170806->PlaceHolder = ew_RemoveHtml($this->f20170806->FldCaption());

		// f20170807
		$this->f20170807->EditAttrs["class"] = "form-control";
		$this->f20170807->EditCustomAttributes = "";
		$this->f20170807->EditValue = $this->f20170807->CurrentValue;
		$this->f20170807->PlaceHolder = ew_RemoveHtml($this->f20170807->FldCaption());

		// f20170808
		$this->f20170808->EditAttrs["class"] = "form-control";
		$this->f20170808->EditCustomAttributes = "";
		$this->f20170808->EditValue = $this->f20170808->CurrentValue;
		$this->f20170808->PlaceHolder = ew_RemoveHtml($this->f20170808->FldCaption());

		// f20170809
		$this->f20170809->EditAttrs["class"] = "form-control";
		$this->f20170809->EditCustomAttributes = "";
		$this->f20170809->EditValue = $this->f20170809->CurrentValue;
		$this->f20170809->PlaceHolder = ew_RemoveHtml($this->f20170809->FldCaption());

		// f20170810
		$this->f20170810->EditAttrs["class"] = "form-control";
		$this->f20170810->EditCustomAttributes = "";
		$this->f20170810->EditValue = $this->f20170810->CurrentValue;
		$this->f20170810->PlaceHolder = ew_RemoveHtml($this->f20170810->FldCaption());

		// f20170811
		$this->f20170811->EditAttrs["class"] = "form-control";
		$this->f20170811->EditCustomAttributes = "";
		$this->f20170811->EditValue = $this->f20170811->CurrentValue;
		$this->f20170811->PlaceHolder = ew_RemoveHtml($this->f20170811->FldCaption());

		// f20170812
		$this->f20170812->EditAttrs["class"] = "form-control";
		$this->f20170812->EditCustomAttributes = "";
		$this->f20170812->EditValue = $this->f20170812->CurrentValue;
		$this->f20170812->PlaceHolder = ew_RemoveHtml($this->f20170812->FldCaption());

		// f20170813
		$this->f20170813->EditAttrs["class"] = "form-control";
		$this->f20170813->EditCustomAttributes = "";
		$this->f20170813->EditValue = $this->f20170813->CurrentValue;
		$this->f20170813->PlaceHolder = ew_RemoveHtml($this->f20170813->FldCaption());

		// f20170814
		$this->f20170814->EditAttrs["class"] = "form-control";
		$this->f20170814->EditCustomAttributes = "";
		$this->f20170814->EditValue = $this->f20170814->CurrentValue;
		$this->f20170814->PlaceHolder = ew_RemoveHtml($this->f20170814->FldCaption());

		// f20170815
		$this->f20170815->EditAttrs["class"] = "form-control";
		$this->f20170815->EditCustomAttributes = "";
		$this->f20170815->EditValue = $this->f20170815->CurrentValue;
		$this->f20170815->PlaceHolder = ew_RemoveHtml($this->f20170815->FldCaption());

		// f20170816
		$this->f20170816->EditAttrs["class"] = "form-control";
		$this->f20170816->EditCustomAttributes = "";
		$this->f20170816->EditValue = $this->f20170816->CurrentValue;
		$this->f20170816->PlaceHolder = ew_RemoveHtml($this->f20170816->FldCaption());

		// f20170817
		$this->f20170817->EditAttrs["class"] = "form-control";
		$this->f20170817->EditCustomAttributes = "";
		$this->f20170817->EditValue = $this->f20170817->CurrentValue;
		$this->f20170817->PlaceHolder = ew_RemoveHtml($this->f20170817->FldCaption());

		// f20170818
		$this->f20170818->EditAttrs["class"] = "form-control";
		$this->f20170818->EditCustomAttributes = "";
		$this->f20170818->EditValue = $this->f20170818->CurrentValue;
		$this->f20170818->PlaceHolder = ew_RemoveHtml($this->f20170818->FldCaption());

		// f20170819
		$this->f20170819->EditAttrs["class"] = "form-control";
		$this->f20170819->EditCustomAttributes = "";
		$this->f20170819->EditValue = $this->f20170819->CurrentValue;
		$this->f20170819->PlaceHolder = ew_RemoveHtml($this->f20170819->FldCaption());

		// f20170820
		$this->f20170820->EditAttrs["class"] = "form-control";
		$this->f20170820->EditCustomAttributes = "";
		$this->f20170820->EditValue = $this->f20170820->CurrentValue;
		$this->f20170820->PlaceHolder = ew_RemoveHtml($this->f20170820->FldCaption());

		// f20170821
		$this->f20170821->EditAttrs["class"] = "form-control";
		$this->f20170821->EditCustomAttributes = "";
		$this->f20170821->EditValue = $this->f20170821->CurrentValue;
		$this->f20170821->PlaceHolder = ew_RemoveHtml($this->f20170821->FldCaption());

		// f20170822
		$this->f20170822->EditAttrs["class"] = "form-control";
		$this->f20170822->EditCustomAttributes = "";
		$this->f20170822->EditValue = $this->f20170822->CurrentValue;
		$this->f20170822->PlaceHolder = ew_RemoveHtml($this->f20170822->FldCaption());

		// f20170823
		$this->f20170823->EditAttrs["class"] = "form-control";
		$this->f20170823->EditCustomAttributes = "";
		$this->f20170823->EditValue = $this->f20170823->CurrentValue;
		$this->f20170823->PlaceHolder = ew_RemoveHtml($this->f20170823->FldCaption());

		// f20170824
		$this->f20170824->EditAttrs["class"] = "form-control";
		$this->f20170824->EditCustomAttributes = "";
		$this->f20170824->EditValue = $this->f20170824->CurrentValue;
		$this->f20170824->PlaceHolder = ew_RemoveHtml($this->f20170824->FldCaption());

		// f20170825
		$this->f20170825->EditAttrs["class"] = "form-control";
		$this->f20170825->EditCustomAttributes = "";
		$this->f20170825->EditValue = $this->f20170825->CurrentValue;
		$this->f20170825->PlaceHolder = ew_RemoveHtml($this->f20170825->FldCaption());

		// f20170826
		$this->f20170826->EditAttrs["class"] = "form-control";
		$this->f20170826->EditCustomAttributes = "";
		$this->f20170826->EditValue = $this->f20170826->CurrentValue;
		$this->f20170826->PlaceHolder = ew_RemoveHtml($this->f20170826->FldCaption());

		// f20170827
		$this->f20170827->EditAttrs["class"] = "form-control";
		$this->f20170827->EditCustomAttributes = "";
		$this->f20170827->EditValue = $this->f20170827->CurrentValue;
		$this->f20170827->PlaceHolder = ew_RemoveHtml($this->f20170827->FldCaption());

		// f20170828
		$this->f20170828->EditAttrs["class"] = "form-control";
		$this->f20170828->EditCustomAttributes = "";
		$this->f20170828->EditValue = $this->f20170828->CurrentValue;
		$this->f20170828->PlaceHolder = ew_RemoveHtml($this->f20170828->FldCaption());

		// f20170829
		$this->f20170829->EditAttrs["class"] = "form-control";
		$this->f20170829->EditCustomAttributes = "";
		$this->f20170829->EditValue = $this->f20170829->CurrentValue;
		$this->f20170829->PlaceHolder = ew_RemoveHtml($this->f20170829->FldCaption());

		// f20170830
		$this->f20170830->EditAttrs["class"] = "form-control";
		$this->f20170830->EditCustomAttributes = "";
		$this->f20170830->EditValue = $this->f20170830->CurrentValue;
		$this->f20170830->PlaceHolder = ew_RemoveHtml($this->f20170830->FldCaption());

		// f20170831
		$this->f20170831->EditAttrs["class"] = "form-control";
		$this->f20170831->EditCustomAttributes = "";
		$this->f20170831->EditValue = $this->f20170831->CurrentValue;
		$this->f20170831->PlaceHolder = ew_RemoveHtml($this->f20170831->FldCaption());

		// f20170901
		$this->f20170901->EditAttrs["class"] = "form-control";
		$this->f20170901->EditCustomAttributes = "";
		$this->f20170901->EditValue = $this->f20170901->CurrentValue;
		$this->f20170901->PlaceHolder = ew_RemoveHtml($this->f20170901->FldCaption());

		// f20170902
		$this->f20170902->EditAttrs["class"] = "form-control";
		$this->f20170902->EditCustomAttributes = "";
		$this->f20170902->EditValue = $this->f20170902->CurrentValue;
		$this->f20170902->PlaceHolder = ew_RemoveHtml($this->f20170902->FldCaption());

		// f20170903
		$this->f20170903->EditAttrs["class"] = "form-control";
		$this->f20170903->EditCustomAttributes = "";
		$this->f20170903->EditValue = $this->f20170903->CurrentValue;
		$this->f20170903->PlaceHolder = ew_RemoveHtml($this->f20170903->FldCaption());

		// f20170904
		$this->f20170904->EditAttrs["class"] = "form-control";
		$this->f20170904->EditCustomAttributes = "";
		$this->f20170904->EditValue = $this->f20170904->CurrentValue;
		$this->f20170904->PlaceHolder = ew_RemoveHtml($this->f20170904->FldCaption());

		// f20170905
		$this->f20170905->EditAttrs["class"] = "form-control";
		$this->f20170905->EditCustomAttributes = "";
		$this->f20170905->EditValue = $this->f20170905->CurrentValue;
		$this->f20170905->PlaceHolder = ew_RemoveHtml($this->f20170905->FldCaption());

		// f20170906
		$this->f20170906->EditAttrs["class"] = "form-control";
		$this->f20170906->EditCustomAttributes = "";
		$this->f20170906->EditValue = $this->f20170906->CurrentValue;
		$this->f20170906->PlaceHolder = ew_RemoveHtml($this->f20170906->FldCaption());

		// f20170907
		$this->f20170907->EditAttrs["class"] = "form-control";
		$this->f20170907->EditCustomAttributes = "";
		$this->f20170907->EditValue = $this->f20170907->CurrentValue;
		$this->f20170907->PlaceHolder = ew_RemoveHtml($this->f20170907->FldCaption());

		// f20170908
		$this->f20170908->EditAttrs["class"] = "form-control";
		$this->f20170908->EditCustomAttributes = "";
		$this->f20170908->EditValue = $this->f20170908->CurrentValue;
		$this->f20170908->PlaceHolder = ew_RemoveHtml($this->f20170908->FldCaption());

		// f20170909
		$this->f20170909->EditAttrs["class"] = "form-control";
		$this->f20170909->EditCustomAttributes = "";
		$this->f20170909->EditValue = $this->f20170909->CurrentValue;
		$this->f20170909->PlaceHolder = ew_RemoveHtml($this->f20170909->FldCaption());

		// f20170910
		$this->f20170910->EditAttrs["class"] = "form-control";
		$this->f20170910->EditCustomAttributes = "";
		$this->f20170910->EditValue = $this->f20170910->CurrentValue;
		$this->f20170910->PlaceHolder = ew_RemoveHtml($this->f20170910->FldCaption());

		// f20170911
		$this->f20170911->EditAttrs["class"] = "form-control";
		$this->f20170911->EditCustomAttributes = "";
		$this->f20170911->EditValue = $this->f20170911->CurrentValue;
		$this->f20170911->PlaceHolder = ew_RemoveHtml($this->f20170911->FldCaption());

		// f20170912
		$this->f20170912->EditAttrs["class"] = "form-control";
		$this->f20170912->EditCustomAttributes = "";
		$this->f20170912->EditValue = $this->f20170912->CurrentValue;
		$this->f20170912->PlaceHolder = ew_RemoveHtml($this->f20170912->FldCaption());

		// f20170913
		$this->f20170913->EditAttrs["class"] = "form-control";
		$this->f20170913->EditCustomAttributes = "";
		$this->f20170913->EditValue = $this->f20170913->CurrentValue;
		$this->f20170913->PlaceHolder = ew_RemoveHtml($this->f20170913->FldCaption());

		// f20170914
		$this->f20170914->EditAttrs["class"] = "form-control";
		$this->f20170914->EditCustomAttributes = "";
		$this->f20170914->EditValue = $this->f20170914->CurrentValue;
		$this->f20170914->PlaceHolder = ew_RemoveHtml($this->f20170914->FldCaption());

		// f20170915
		$this->f20170915->EditAttrs["class"] = "form-control";
		$this->f20170915->EditCustomAttributes = "";
		$this->f20170915->EditValue = $this->f20170915->CurrentValue;
		$this->f20170915->PlaceHolder = ew_RemoveHtml($this->f20170915->FldCaption());

		// f20170916
		$this->f20170916->EditAttrs["class"] = "form-control";
		$this->f20170916->EditCustomAttributes = "";
		$this->f20170916->EditValue = $this->f20170916->CurrentValue;
		$this->f20170916->PlaceHolder = ew_RemoveHtml($this->f20170916->FldCaption());

		// f20170917
		$this->f20170917->EditAttrs["class"] = "form-control";
		$this->f20170917->EditCustomAttributes = "";
		$this->f20170917->EditValue = $this->f20170917->CurrentValue;
		$this->f20170917->PlaceHolder = ew_RemoveHtml($this->f20170917->FldCaption());

		// f20170918
		$this->f20170918->EditAttrs["class"] = "form-control";
		$this->f20170918->EditCustomAttributes = "";
		$this->f20170918->EditValue = $this->f20170918->CurrentValue;
		$this->f20170918->PlaceHolder = ew_RemoveHtml($this->f20170918->FldCaption());

		// f20170919
		$this->f20170919->EditAttrs["class"] = "form-control";
		$this->f20170919->EditCustomAttributes = "";
		$this->f20170919->EditValue = $this->f20170919->CurrentValue;
		$this->f20170919->PlaceHolder = ew_RemoveHtml($this->f20170919->FldCaption());

		// f20170920
		$this->f20170920->EditAttrs["class"] = "form-control";
		$this->f20170920->EditCustomAttributes = "";
		$this->f20170920->EditValue = $this->f20170920->CurrentValue;
		$this->f20170920->PlaceHolder = ew_RemoveHtml($this->f20170920->FldCaption());

		// f20170921
		$this->f20170921->EditAttrs["class"] = "form-control";
		$this->f20170921->EditCustomAttributes = "";
		$this->f20170921->EditValue = $this->f20170921->CurrentValue;
		$this->f20170921->PlaceHolder = ew_RemoveHtml($this->f20170921->FldCaption());

		// f20170922
		$this->f20170922->EditAttrs["class"] = "form-control";
		$this->f20170922->EditCustomAttributes = "";
		$this->f20170922->EditValue = $this->f20170922->CurrentValue;
		$this->f20170922->PlaceHolder = ew_RemoveHtml($this->f20170922->FldCaption());

		// f20170923
		$this->f20170923->EditAttrs["class"] = "form-control";
		$this->f20170923->EditCustomAttributes = "";
		$this->f20170923->EditValue = $this->f20170923->CurrentValue;
		$this->f20170923->PlaceHolder = ew_RemoveHtml($this->f20170923->FldCaption());

		// f20170924
		$this->f20170924->EditAttrs["class"] = "form-control";
		$this->f20170924->EditCustomAttributes = "";
		$this->f20170924->EditValue = $this->f20170924->CurrentValue;
		$this->f20170924->PlaceHolder = ew_RemoveHtml($this->f20170924->FldCaption());

		// f20170925
		$this->f20170925->EditAttrs["class"] = "form-control";
		$this->f20170925->EditCustomAttributes = "";
		$this->f20170925->EditValue = $this->f20170925->CurrentValue;
		$this->f20170925->PlaceHolder = ew_RemoveHtml($this->f20170925->FldCaption());

		// f20170926
		$this->f20170926->EditAttrs["class"] = "form-control";
		$this->f20170926->EditCustomAttributes = "";
		$this->f20170926->EditValue = $this->f20170926->CurrentValue;
		$this->f20170926->PlaceHolder = ew_RemoveHtml($this->f20170926->FldCaption());

		// f20170927
		$this->f20170927->EditAttrs["class"] = "form-control";
		$this->f20170927->EditCustomAttributes = "";
		$this->f20170927->EditValue = $this->f20170927->CurrentValue;
		$this->f20170927->PlaceHolder = ew_RemoveHtml($this->f20170927->FldCaption());

		// f20170928
		$this->f20170928->EditAttrs["class"] = "form-control";
		$this->f20170928->EditCustomAttributes = "";
		$this->f20170928->EditValue = $this->f20170928->CurrentValue;
		$this->f20170928->PlaceHolder = ew_RemoveHtml($this->f20170928->FldCaption());

		// f20170929
		$this->f20170929->EditAttrs["class"] = "form-control";
		$this->f20170929->EditCustomAttributes = "";
		$this->f20170929->EditValue = $this->f20170929->CurrentValue;
		$this->f20170929->PlaceHolder = ew_RemoveHtml($this->f20170929->FldCaption());

		// f20170930
		$this->f20170930->EditAttrs["class"] = "form-control";
		$this->f20170930->EditCustomAttributes = "";
		$this->f20170930->EditValue = $this->f20170930->CurrentValue;
		$this->f20170930->PlaceHolder = ew_RemoveHtml($this->f20170930->FldCaption());

		// f20171001
		$this->f20171001->EditAttrs["class"] = "form-control";
		$this->f20171001->EditCustomAttributes = "";
		$this->f20171001->EditValue = $this->f20171001->CurrentValue;
		$this->f20171001->PlaceHolder = ew_RemoveHtml($this->f20171001->FldCaption());

		// f20171002
		$this->f20171002->EditAttrs["class"] = "form-control";
		$this->f20171002->EditCustomAttributes = "";
		$this->f20171002->EditValue = $this->f20171002->CurrentValue;
		$this->f20171002->PlaceHolder = ew_RemoveHtml($this->f20171002->FldCaption());

		// f20171003
		$this->f20171003->EditAttrs["class"] = "form-control";
		$this->f20171003->EditCustomAttributes = "";
		$this->f20171003->EditValue = $this->f20171003->CurrentValue;
		$this->f20171003->PlaceHolder = ew_RemoveHtml($this->f20171003->FldCaption());

		// f20171004
		$this->f20171004->EditAttrs["class"] = "form-control";
		$this->f20171004->EditCustomAttributes = "";
		$this->f20171004->EditValue = $this->f20171004->CurrentValue;
		$this->f20171004->PlaceHolder = ew_RemoveHtml($this->f20171004->FldCaption());

		// f20171005
		$this->f20171005->EditAttrs["class"] = "form-control";
		$this->f20171005->EditCustomAttributes = "";
		$this->f20171005->EditValue = $this->f20171005->CurrentValue;
		$this->f20171005->PlaceHolder = ew_RemoveHtml($this->f20171005->FldCaption());

		// f20171006
		$this->f20171006->EditAttrs["class"] = "form-control";
		$this->f20171006->EditCustomAttributes = "";
		$this->f20171006->EditValue = $this->f20171006->CurrentValue;
		$this->f20171006->PlaceHolder = ew_RemoveHtml($this->f20171006->FldCaption());

		// f20171007
		$this->f20171007->EditAttrs["class"] = "form-control";
		$this->f20171007->EditCustomAttributes = "";
		$this->f20171007->EditValue = $this->f20171007->CurrentValue;
		$this->f20171007->PlaceHolder = ew_RemoveHtml($this->f20171007->FldCaption());

		// f20171008
		$this->f20171008->EditAttrs["class"] = "form-control";
		$this->f20171008->EditCustomAttributes = "";
		$this->f20171008->EditValue = $this->f20171008->CurrentValue;
		$this->f20171008->PlaceHolder = ew_RemoveHtml($this->f20171008->FldCaption());

		// f20171009
		$this->f20171009->EditAttrs["class"] = "form-control";
		$this->f20171009->EditCustomAttributes = "";
		$this->f20171009->EditValue = $this->f20171009->CurrentValue;
		$this->f20171009->PlaceHolder = ew_RemoveHtml($this->f20171009->FldCaption());

		// f20171010
		$this->f20171010->EditAttrs["class"] = "form-control";
		$this->f20171010->EditCustomAttributes = "";
		$this->f20171010->EditValue = $this->f20171010->CurrentValue;
		$this->f20171010->PlaceHolder = ew_RemoveHtml($this->f20171010->FldCaption());

		// f20171011
		$this->f20171011->EditAttrs["class"] = "form-control";
		$this->f20171011->EditCustomAttributes = "";
		$this->f20171011->EditValue = $this->f20171011->CurrentValue;
		$this->f20171011->PlaceHolder = ew_RemoveHtml($this->f20171011->FldCaption());

		// f20171012
		$this->f20171012->EditAttrs["class"] = "form-control";
		$this->f20171012->EditCustomAttributes = "";
		$this->f20171012->EditValue = $this->f20171012->CurrentValue;
		$this->f20171012->PlaceHolder = ew_RemoveHtml($this->f20171012->FldCaption());

		// f20171013
		$this->f20171013->EditAttrs["class"] = "form-control";
		$this->f20171013->EditCustomAttributes = "";
		$this->f20171013->EditValue = $this->f20171013->CurrentValue;
		$this->f20171013->PlaceHolder = ew_RemoveHtml($this->f20171013->FldCaption());

		// f20171014
		$this->f20171014->EditAttrs["class"] = "form-control";
		$this->f20171014->EditCustomAttributes = "";
		$this->f20171014->EditValue = $this->f20171014->CurrentValue;
		$this->f20171014->PlaceHolder = ew_RemoveHtml($this->f20171014->FldCaption());

		// f20171015
		$this->f20171015->EditAttrs["class"] = "form-control";
		$this->f20171015->EditCustomAttributes = "";
		$this->f20171015->EditValue = $this->f20171015->CurrentValue;
		$this->f20171015->PlaceHolder = ew_RemoveHtml($this->f20171015->FldCaption());

		// f20171016
		$this->f20171016->EditAttrs["class"] = "form-control";
		$this->f20171016->EditCustomAttributes = "";
		$this->f20171016->EditValue = $this->f20171016->CurrentValue;
		$this->f20171016->PlaceHolder = ew_RemoveHtml($this->f20171016->FldCaption());

		// f20171017
		$this->f20171017->EditAttrs["class"] = "form-control";
		$this->f20171017->EditCustomAttributes = "";
		$this->f20171017->EditValue = $this->f20171017->CurrentValue;
		$this->f20171017->PlaceHolder = ew_RemoveHtml($this->f20171017->FldCaption());

		// f20171018
		$this->f20171018->EditAttrs["class"] = "form-control";
		$this->f20171018->EditCustomAttributes = "";
		$this->f20171018->EditValue = $this->f20171018->CurrentValue;
		$this->f20171018->PlaceHolder = ew_RemoveHtml($this->f20171018->FldCaption());

		// f20171019
		$this->f20171019->EditAttrs["class"] = "form-control";
		$this->f20171019->EditCustomAttributes = "";
		$this->f20171019->EditValue = $this->f20171019->CurrentValue;
		$this->f20171019->PlaceHolder = ew_RemoveHtml($this->f20171019->FldCaption());

		// f20171020
		$this->f20171020->EditAttrs["class"] = "form-control";
		$this->f20171020->EditCustomAttributes = "";
		$this->f20171020->EditValue = $this->f20171020->CurrentValue;
		$this->f20171020->PlaceHolder = ew_RemoveHtml($this->f20171020->FldCaption());

		// f20171021
		$this->f20171021->EditAttrs["class"] = "form-control";
		$this->f20171021->EditCustomAttributes = "";
		$this->f20171021->EditValue = $this->f20171021->CurrentValue;
		$this->f20171021->PlaceHolder = ew_RemoveHtml($this->f20171021->FldCaption());

		// f20171022
		$this->f20171022->EditAttrs["class"] = "form-control";
		$this->f20171022->EditCustomAttributes = "";
		$this->f20171022->EditValue = $this->f20171022->CurrentValue;
		$this->f20171022->PlaceHolder = ew_RemoveHtml($this->f20171022->FldCaption());

		// f20171023
		$this->f20171023->EditAttrs["class"] = "form-control";
		$this->f20171023->EditCustomAttributes = "";
		$this->f20171023->EditValue = $this->f20171023->CurrentValue;
		$this->f20171023->PlaceHolder = ew_RemoveHtml($this->f20171023->FldCaption());

		// f20171024
		$this->f20171024->EditAttrs["class"] = "form-control";
		$this->f20171024->EditCustomAttributes = "";
		$this->f20171024->EditValue = $this->f20171024->CurrentValue;
		$this->f20171024->PlaceHolder = ew_RemoveHtml($this->f20171024->FldCaption());

		// f20171025
		$this->f20171025->EditAttrs["class"] = "form-control";
		$this->f20171025->EditCustomAttributes = "";
		$this->f20171025->EditValue = $this->f20171025->CurrentValue;
		$this->f20171025->PlaceHolder = ew_RemoveHtml($this->f20171025->FldCaption());

		// f20171026
		$this->f20171026->EditAttrs["class"] = "form-control";
		$this->f20171026->EditCustomAttributes = "";
		$this->f20171026->EditValue = $this->f20171026->CurrentValue;
		$this->f20171026->PlaceHolder = ew_RemoveHtml($this->f20171026->FldCaption());

		// f20171027
		$this->f20171027->EditAttrs["class"] = "form-control";
		$this->f20171027->EditCustomAttributes = "";
		$this->f20171027->EditValue = $this->f20171027->CurrentValue;
		$this->f20171027->PlaceHolder = ew_RemoveHtml($this->f20171027->FldCaption());

		// f20171028
		$this->f20171028->EditAttrs["class"] = "form-control";
		$this->f20171028->EditCustomAttributes = "";
		$this->f20171028->EditValue = $this->f20171028->CurrentValue;
		$this->f20171028->PlaceHolder = ew_RemoveHtml($this->f20171028->FldCaption());

		// f20171029
		$this->f20171029->EditAttrs["class"] = "form-control";
		$this->f20171029->EditCustomAttributes = "";
		$this->f20171029->EditValue = $this->f20171029->CurrentValue;
		$this->f20171029->PlaceHolder = ew_RemoveHtml($this->f20171029->FldCaption());

		// f20171030
		$this->f20171030->EditAttrs["class"] = "form-control";
		$this->f20171030->EditCustomAttributes = "";
		$this->f20171030->EditValue = $this->f20171030->CurrentValue;
		$this->f20171030->PlaceHolder = ew_RemoveHtml($this->f20171030->FldCaption());

		// f20171031
		$this->f20171031->EditAttrs["class"] = "form-control";
		$this->f20171031->EditCustomAttributes = "";
		$this->f20171031->EditValue = $this->f20171031->CurrentValue;
		$this->f20171031->PlaceHolder = ew_RemoveHtml($this->f20171031->FldCaption());

		// f20171101
		$this->f20171101->EditAttrs["class"] = "form-control";
		$this->f20171101->EditCustomAttributes = "";
		$this->f20171101->EditValue = $this->f20171101->CurrentValue;
		$this->f20171101->PlaceHolder = ew_RemoveHtml($this->f20171101->FldCaption());

		// f20171102
		$this->f20171102->EditAttrs["class"] = "form-control";
		$this->f20171102->EditCustomAttributes = "";
		$this->f20171102->EditValue = $this->f20171102->CurrentValue;
		$this->f20171102->PlaceHolder = ew_RemoveHtml($this->f20171102->FldCaption());

		// f20171103
		$this->f20171103->EditAttrs["class"] = "form-control";
		$this->f20171103->EditCustomAttributes = "";
		$this->f20171103->EditValue = $this->f20171103->CurrentValue;
		$this->f20171103->PlaceHolder = ew_RemoveHtml($this->f20171103->FldCaption());

		// f20171104
		$this->f20171104->EditAttrs["class"] = "form-control";
		$this->f20171104->EditCustomAttributes = "";
		$this->f20171104->EditValue = $this->f20171104->CurrentValue;
		$this->f20171104->PlaceHolder = ew_RemoveHtml($this->f20171104->FldCaption());

		// f20171105
		$this->f20171105->EditAttrs["class"] = "form-control";
		$this->f20171105->EditCustomAttributes = "";
		$this->f20171105->EditValue = $this->f20171105->CurrentValue;
		$this->f20171105->PlaceHolder = ew_RemoveHtml($this->f20171105->FldCaption());

		// f20171106
		$this->f20171106->EditAttrs["class"] = "form-control";
		$this->f20171106->EditCustomAttributes = "";
		$this->f20171106->EditValue = $this->f20171106->CurrentValue;
		$this->f20171106->PlaceHolder = ew_RemoveHtml($this->f20171106->FldCaption());

		// f20171107
		$this->f20171107->EditAttrs["class"] = "form-control";
		$this->f20171107->EditCustomAttributes = "";
		$this->f20171107->EditValue = $this->f20171107->CurrentValue;
		$this->f20171107->PlaceHolder = ew_RemoveHtml($this->f20171107->FldCaption());

		// f20171108
		$this->f20171108->EditAttrs["class"] = "form-control";
		$this->f20171108->EditCustomAttributes = "";
		$this->f20171108->EditValue = $this->f20171108->CurrentValue;
		$this->f20171108->PlaceHolder = ew_RemoveHtml($this->f20171108->FldCaption());

		// f20171109
		$this->f20171109->EditAttrs["class"] = "form-control";
		$this->f20171109->EditCustomAttributes = "";
		$this->f20171109->EditValue = $this->f20171109->CurrentValue;
		$this->f20171109->PlaceHolder = ew_RemoveHtml($this->f20171109->FldCaption());

		// f20171110
		$this->f20171110->EditAttrs["class"] = "form-control";
		$this->f20171110->EditCustomAttributes = "";
		$this->f20171110->EditValue = $this->f20171110->CurrentValue;
		$this->f20171110->PlaceHolder = ew_RemoveHtml($this->f20171110->FldCaption());

		// f20171111
		$this->f20171111->EditAttrs["class"] = "form-control";
		$this->f20171111->EditCustomAttributes = "";
		$this->f20171111->EditValue = $this->f20171111->CurrentValue;
		$this->f20171111->PlaceHolder = ew_RemoveHtml($this->f20171111->FldCaption());

		// f20171112
		$this->f20171112->EditAttrs["class"] = "form-control";
		$this->f20171112->EditCustomAttributes = "";
		$this->f20171112->EditValue = $this->f20171112->CurrentValue;
		$this->f20171112->PlaceHolder = ew_RemoveHtml($this->f20171112->FldCaption());

		// f20171113
		$this->f20171113->EditAttrs["class"] = "form-control";
		$this->f20171113->EditCustomAttributes = "";
		$this->f20171113->EditValue = $this->f20171113->CurrentValue;
		$this->f20171113->PlaceHolder = ew_RemoveHtml($this->f20171113->FldCaption());

		// f20171114
		$this->f20171114->EditAttrs["class"] = "form-control";
		$this->f20171114->EditCustomAttributes = "";
		$this->f20171114->EditValue = $this->f20171114->CurrentValue;
		$this->f20171114->PlaceHolder = ew_RemoveHtml($this->f20171114->FldCaption());

		// f20171115
		$this->f20171115->EditAttrs["class"] = "form-control";
		$this->f20171115->EditCustomAttributes = "";
		$this->f20171115->EditValue = $this->f20171115->CurrentValue;
		$this->f20171115->PlaceHolder = ew_RemoveHtml($this->f20171115->FldCaption());

		// f20171116
		$this->f20171116->EditAttrs["class"] = "form-control";
		$this->f20171116->EditCustomAttributes = "";
		$this->f20171116->EditValue = $this->f20171116->CurrentValue;
		$this->f20171116->PlaceHolder = ew_RemoveHtml($this->f20171116->FldCaption());

		// f20171117
		$this->f20171117->EditAttrs["class"] = "form-control";
		$this->f20171117->EditCustomAttributes = "";
		$this->f20171117->EditValue = $this->f20171117->CurrentValue;
		$this->f20171117->PlaceHolder = ew_RemoveHtml($this->f20171117->FldCaption());

		// f20171118
		$this->f20171118->EditAttrs["class"] = "form-control";
		$this->f20171118->EditCustomAttributes = "";
		$this->f20171118->EditValue = $this->f20171118->CurrentValue;
		$this->f20171118->PlaceHolder = ew_RemoveHtml($this->f20171118->FldCaption());

		// f20171119
		$this->f20171119->EditAttrs["class"] = "form-control";
		$this->f20171119->EditCustomAttributes = "";
		$this->f20171119->EditValue = $this->f20171119->CurrentValue;
		$this->f20171119->PlaceHolder = ew_RemoveHtml($this->f20171119->FldCaption());

		// f20171120
		$this->f20171120->EditAttrs["class"] = "form-control";
		$this->f20171120->EditCustomAttributes = "";
		$this->f20171120->EditValue = $this->f20171120->CurrentValue;
		$this->f20171120->PlaceHolder = ew_RemoveHtml($this->f20171120->FldCaption());

		// f20171121
		$this->f20171121->EditAttrs["class"] = "form-control";
		$this->f20171121->EditCustomAttributes = "";
		$this->f20171121->EditValue = $this->f20171121->CurrentValue;
		$this->f20171121->PlaceHolder = ew_RemoveHtml($this->f20171121->FldCaption());

		// f20171122
		$this->f20171122->EditAttrs["class"] = "form-control";
		$this->f20171122->EditCustomAttributes = "";
		$this->f20171122->EditValue = $this->f20171122->CurrentValue;
		$this->f20171122->PlaceHolder = ew_RemoveHtml($this->f20171122->FldCaption());

		// f20171123
		$this->f20171123->EditAttrs["class"] = "form-control";
		$this->f20171123->EditCustomAttributes = "";
		$this->f20171123->EditValue = $this->f20171123->CurrentValue;
		$this->f20171123->PlaceHolder = ew_RemoveHtml($this->f20171123->FldCaption());

		// f20171124
		$this->f20171124->EditAttrs["class"] = "form-control";
		$this->f20171124->EditCustomAttributes = "";
		$this->f20171124->EditValue = $this->f20171124->CurrentValue;
		$this->f20171124->PlaceHolder = ew_RemoveHtml($this->f20171124->FldCaption());

		// f20171125
		$this->f20171125->EditAttrs["class"] = "form-control";
		$this->f20171125->EditCustomAttributes = "";
		$this->f20171125->EditValue = $this->f20171125->CurrentValue;
		$this->f20171125->PlaceHolder = ew_RemoveHtml($this->f20171125->FldCaption());

		// f20171126
		$this->f20171126->EditAttrs["class"] = "form-control";
		$this->f20171126->EditCustomAttributes = "";
		$this->f20171126->EditValue = $this->f20171126->CurrentValue;
		$this->f20171126->PlaceHolder = ew_RemoveHtml($this->f20171126->FldCaption());

		// f20171127
		$this->f20171127->EditAttrs["class"] = "form-control";
		$this->f20171127->EditCustomAttributes = "";
		$this->f20171127->EditValue = $this->f20171127->CurrentValue;
		$this->f20171127->PlaceHolder = ew_RemoveHtml($this->f20171127->FldCaption());

		// f20171128
		$this->f20171128->EditAttrs["class"] = "form-control";
		$this->f20171128->EditCustomAttributes = "";
		$this->f20171128->EditValue = $this->f20171128->CurrentValue;
		$this->f20171128->PlaceHolder = ew_RemoveHtml($this->f20171128->FldCaption());

		// f20171129
		$this->f20171129->EditAttrs["class"] = "form-control";
		$this->f20171129->EditCustomAttributes = "";
		$this->f20171129->EditValue = $this->f20171129->CurrentValue;
		$this->f20171129->PlaceHolder = ew_RemoveHtml($this->f20171129->FldCaption());

		// f20171130
		$this->f20171130->EditAttrs["class"] = "form-control";
		$this->f20171130->EditCustomAttributes = "";
		$this->f20171130->EditValue = $this->f20171130->CurrentValue;
		$this->f20171130->PlaceHolder = ew_RemoveHtml($this->f20171130->FldCaption());

		// f20171201
		$this->f20171201->EditAttrs["class"] = "form-control";
		$this->f20171201->EditCustomAttributes = "";
		$this->f20171201->EditValue = $this->f20171201->CurrentValue;
		$this->f20171201->PlaceHolder = ew_RemoveHtml($this->f20171201->FldCaption());

		// f20171202
		$this->f20171202->EditAttrs["class"] = "form-control";
		$this->f20171202->EditCustomAttributes = "";
		$this->f20171202->EditValue = $this->f20171202->CurrentValue;
		$this->f20171202->PlaceHolder = ew_RemoveHtml($this->f20171202->FldCaption());

		// f20171203
		$this->f20171203->EditAttrs["class"] = "form-control";
		$this->f20171203->EditCustomAttributes = "";
		$this->f20171203->EditValue = $this->f20171203->CurrentValue;
		$this->f20171203->PlaceHolder = ew_RemoveHtml($this->f20171203->FldCaption());

		// f20171204
		$this->f20171204->EditAttrs["class"] = "form-control";
		$this->f20171204->EditCustomAttributes = "";
		$this->f20171204->EditValue = $this->f20171204->CurrentValue;
		$this->f20171204->PlaceHolder = ew_RemoveHtml($this->f20171204->FldCaption());

		// f20171205
		$this->f20171205->EditAttrs["class"] = "form-control";
		$this->f20171205->EditCustomAttributes = "";
		$this->f20171205->EditValue = $this->f20171205->CurrentValue;
		$this->f20171205->PlaceHolder = ew_RemoveHtml($this->f20171205->FldCaption());

		// f20171206
		$this->f20171206->EditAttrs["class"] = "form-control";
		$this->f20171206->EditCustomAttributes = "";
		$this->f20171206->EditValue = $this->f20171206->CurrentValue;
		$this->f20171206->PlaceHolder = ew_RemoveHtml($this->f20171206->FldCaption());

		// f20171207
		$this->f20171207->EditAttrs["class"] = "form-control";
		$this->f20171207->EditCustomAttributes = "";
		$this->f20171207->EditValue = $this->f20171207->CurrentValue;
		$this->f20171207->PlaceHolder = ew_RemoveHtml($this->f20171207->FldCaption());

		// f20171208
		$this->f20171208->EditAttrs["class"] = "form-control";
		$this->f20171208->EditCustomAttributes = "";
		$this->f20171208->EditValue = $this->f20171208->CurrentValue;
		$this->f20171208->PlaceHolder = ew_RemoveHtml($this->f20171208->FldCaption());

		// f20171209
		$this->f20171209->EditAttrs["class"] = "form-control";
		$this->f20171209->EditCustomAttributes = "";
		$this->f20171209->EditValue = $this->f20171209->CurrentValue;
		$this->f20171209->PlaceHolder = ew_RemoveHtml($this->f20171209->FldCaption());

		// f20171210
		$this->f20171210->EditAttrs["class"] = "form-control";
		$this->f20171210->EditCustomAttributes = "";
		$this->f20171210->EditValue = $this->f20171210->CurrentValue;
		$this->f20171210->PlaceHolder = ew_RemoveHtml($this->f20171210->FldCaption());

		// f20171211
		$this->f20171211->EditAttrs["class"] = "form-control";
		$this->f20171211->EditCustomAttributes = "";
		$this->f20171211->EditValue = $this->f20171211->CurrentValue;
		$this->f20171211->PlaceHolder = ew_RemoveHtml($this->f20171211->FldCaption());

		// f20171212
		$this->f20171212->EditAttrs["class"] = "form-control";
		$this->f20171212->EditCustomAttributes = "";
		$this->f20171212->EditValue = $this->f20171212->CurrentValue;
		$this->f20171212->PlaceHolder = ew_RemoveHtml($this->f20171212->FldCaption());

		// f20171213
		$this->f20171213->EditAttrs["class"] = "form-control";
		$this->f20171213->EditCustomAttributes = "";
		$this->f20171213->EditValue = $this->f20171213->CurrentValue;
		$this->f20171213->PlaceHolder = ew_RemoveHtml($this->f20171213->FldCaption());

		// f20171214
		$this->f20171214->EditAttrs["class"] = "form-control";
		$this->f20171214->EditCustomAttributes = "";
		$this->f20171214->EditValue = $this->f20171214->CurrentValue;
		$this->f20171214->PlaceHolder = ew_RemoveHtml($this->f20171214->FldCaption());

		// f20171215
		$this->f20171215->EditAttrs["class"] = "form-control";
		$this->f20171215->EditCustomAttributes = "";
		$this->f20171215->EditValue = $this->f20171215->CurrentValue;
		$this->f20171215->PlaceHolder = ew_RemoveHtml($this->f20171215->FldCaption());

		// f20171216
		$this->f20171216->EditAttrs["class"] = "form-control";
		$this->f20171216->EditCustomAttributes = "";
		$this->f20171216->EditValue = $this->f20171216->CurrentValue;
		$this->f20171216->PlaceHolder = ew_RemoveHtml($this->f20171216->FldCaption());

		// f20171217
		$this->f20171217->EditAttrs["class"] = "form-control";
		$this->f20171217->EditCustomAttributes = "";
		$this->f20171217->EditValue = $this->f20171217->CurrentValue;
		$this->f20171217->PlaceHolder = ew_RemoveHtml($this->f20171217->FldCaption());

		// f20171218
		$this->f20171218->EditAttrs["class"] = "form-control";
		$this->f20171218->EditCustomAttributes = "";
		$this->f20171218->EditValue = $this->f20171218->CurrentValue;
		$this->f20171218->PlaceHolder = ew_RemoveHtml($this->f20171218->FldCaption());

		// f20171219
		$this->f20171219->EditAttrs["class"] = "form-control";
		$this->f20171219->EditCustomAttributes = "";
		$this->f20171219->EditValue = $this->f20171219->CurrentValue;
		$this->f20171219->PlaceHolder = ew_RemoveHtml($this->f20171219->FldCaption());

		// f20171220
		$this->f20171220->EditAttrs["class"] = "form-control";
		$this->f20171220->EditCustomAttributes = "";
		$this->f20171220->EditValue = $this->f20171220->CurrentValue;
		$this->f20171220->PlaceHolder = ew_RemoveHtml($this->f20171220->FldCaption());

		// f20171221
		$this->f20171221->EditAttrs["class"] = "form-control";
		$this->f20171221->EditCustomAttributes = "";
		$this->f20171221->EditValue = $this->f20171221->CurrentValue;
		$this->f20171221->PlaceHolder = ew_RemoveHtml($this->f20171221->FldCaption());

		// f20171222
		$this->f20171222->EditAttrs["class"] = "form-control";
		$this->f20171222->EditCustomAttributes = "";
		$this->f20171222->EditValue = $this->f20171222->CurrentValue;
		$this->f20171222->PlaceHolder = ew_RemoveHtml($this->f20171222->FldCaption());

		// f20171223
		$this->f20171223->EditAttrs["class"] = "form-control";
		$this->f20171223->EditCustomAttributes = "";
		$this->f20171223->EditValue = $this->f20171223->CurrentValue;
		$this->f20171223->PlaceHolder = ew_RemoveHtml($this->f20171223->FldCaption());

		// f20171224
		$this->f20171224->EditAttrs["class"] = "form-control";
		$this->f20171224->EditCustomAttributes = "";
		$this->f20171224->EditValue = $this->f20171224->CurrentValue;
		$this->f20171224->PlaceHolder = ew_RemoveHtml($this->f20171224->FldCaption());

		// f20171225
		$this->f20171225->EditAttrs["class"] = "form-control";
		$this->f20171225->EditCustomAttributes = "";
		$this->f20171225->EditValue = $this->f20171225->CurrentValue;
		$this->f20171225->PlaceHolder = ew_RemoveHtml($this->f20171225->FldCaption());

		// f20171226
		$this->f20171226->EditAttrs["class"] = "form-control";
		$this->f20171226->EditCustomAttributes = "";
		$this->f20171226->EditValue = $this->f20171226->CurrentValue;
		$this->f20171226->PlaceHolder = ew_RemoveHtml($this->f20171226->FldCaption());

		// f20171227
		$this->f20171227->EditAttrs["class"] = "form-control";
		$this->f20171227->EditCustomAttributes = "";
		$this->f20171227->EditValue = $this->f20171227->CurrentValue;
		$this->f20171227->PlaceHolder = ew_RemoveHtml($this->f20171227->FldCaption());

		// f20171228
		$this->f20171228->EditAttrs["class"] = "form-control";
		$this->f20171228->EditCustomAttributes = "";
		$this->f20171228->EditValue = $this->f20171228->CurrentValue;
		$this->f20171228->PlaceHolder = ew_RemoveHtml($this->f20171228->FldCaption());

		// f20171229
		$this->f20171229->EditAttrs["class"] = "form-control";
		$this->f20171229->EditCustomAttributes = "";
		$this->f20171229->EditValue = $this->f20171229->CurrentValue;
		$this->f20171229->PlaceHolder = ew_RemoveHtml($this->f20171229->FldCaption());

		// f20171230
		$this->f20171230->EditAttrs["class"] = "form-control";
		$this->f20171230->EditCustomAttributes = "";
		$this->f20171230->EditValue = $this->f20171230->CurrentValue;
		$this->f20171230->PlaceHolder = ew_RemoveHtml($this->f20171230->FldCaption());

		// f20171231
		$this->f20171231->EditAttrs["class"] = "form-control";
		$this->f20171231->EditCustomAttributes = "";
		$this->f20171231->EditValue = $this->f20171231->CurrentValue;
		$this->f20171231->PlaceHolder = ew_RemoveHtml($this->f20171231->FldCaption());

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
					if ($this->jdwkrjpeg_id->Exportable) $Doc->ExportCaption($this->jdwkrjpeg_id);
					if ($this->pegawai_id->Exportable) $Doc->ExportCaption($this->pegawai_id);
					if ($this->f20170101->Exportable) $Doc->ExportCaption($this->f20170101);
					if ($this->f20170102->Exportable) $Doc->ExportCaption($this->f20170102);
					if ($this->f20170103->Exportable) $Doc->ExportCaption($this->f20170103);
					if ($this->f20170104->Exportable) $Doc->ExportCaption($this->f20170104);
					if ($this->f20170105->Exportable) $Doc->ExportCaption($this->f20170105);
					if ($this->f20170106->Exportable) $Doc->ExportCaption($this->f20170106);
					if ($this->f20170107->Exportable) $Doc->ExportCaption($this->f20170107);
					if ($this->f20170108->Exportable) $Doc->ExportCaption($this->f20170108);
					if ($this->f20170109->Exportable) $Doc->ExportCaption($this->f20170109);
					if ($this->f20170110->Exportable) $Doc->ExportCaption($this->f20170110);
					if ($this->f20170111->Exportable) $Doc->ExportCaption($this->f20170111);
					if ($this->f20170112->Exportable) $Doc->ExportCaption($this->f20170112);
					if ($this->f20170113->Exportable) $Doc->ExportCaption($this->f20170113);
					if ($this->f20170114->Exportable) $Doc->ExportCaption($this->f20170114);
					if ($this->f20170115->Exportable) $Doc->ExportCaption($this->f20170115);
					if ($this->f20170116->Exportable) $Doc->ExportCaption($this->f20170116);
					if ($this->f20170117->Exportable) $Doc->ExportCaption($this->f20170117);
					if ($this->f20170118->Exportable) $Doc->ExportCaption($this->f20170118);
					if ($this->f20170119->Exportable) $Doc->ExportCaption($this->f20170119);
					if ($this->f20170120->Exportable) $Doc->ExportCaption($this->f20170120);
					if ($this->f20170121->Exportable) $Doc->ExportCaption($this->f20170121);
					if ($this->f20170122->Exportable) $Doc->ExportCaption($this->f20170122);
					if ($this->f20170123->Exportable) $Doc->ExportCaption($this->f20170123);
					if ($this->f20170124->Exportable) $Doc->ExportCaption($this->f20170124);
					if ($this->f20170125->Exportable) $Doc->ExportCaption($this->f20170125);
					if ($this->f20170126->Exportable) $Doc->ExportCaption($this->f20170126);
					if ($this->f20170127->Exportable) $Doc->ExportCaption($this->f20170127);
					if ($this->f20170128->Exportable) $Doc->ExportCaption($this->f20170128);
					if ($this->f20170129->Exportable) $Doc->ExportCaption($this->f20170129);
					if ($this->f20170130->Exportable) $Doc->ExportCaption($this->f20170130);
					if ($this->f20170131->Exportable) $Doc->ExportCaption($this->f20170131);
					if ($this->f20170201->Exportable) $Doc->ExportCaption($this->f20170201);
					if ($this->f20170202->Exportable) $Doc->ExportCaption($this->f20170202);
					if ($this->f20170203->Exportable) $Doc->ExportCaption($this->f20170203);
					if ($this->f20170204->Exportable) $Doc->ExportCaption($this->f20170204);
					if ($this->f20170205->Exportable) $Doc->ExportCaption($this->f20170205);
					if ($this->f20170206->Exportable) $Doc->ExportCaption($this->f20170206);
					if ($this->f20170207->Exportable) $Doc->ExportCaption($this->f20170207);
					if ($this->f20170208->Exportable) $Doc->ExportCaption($this->f20170208);
					if ($this->f20170209->Exportable) $Doc->ExportCaption($this->f20170209);
					if ($this->f20170210->Exportable) $Doc->ExportCaption($this->f20170210);
					if ($this->f20170211->Exportable) $Doc->ExportCaption($this->f20170211);
					if ($this->f20170212->Exportable) $Doc->ExportCaption($this->f20170212);
					if ($this->f20170213->Exportable) $Doc->ExportCaption($this->f20170213);
					if ($this->f20170214->Exportable) $Doc->ExportCaption($this->f20170214);
					if ($this->f20170215->Exportable) $Doc->ExportCaption($this->f20170215);
					if ($this->f20170216->Exportable) $Doc->ExportCaption($this->f20170216);
					if ($this->f20170217->Exportable) $Doc->ExportCaption($this->f20170217);
					if ($this->f20170218->Exportable) $Doc->ExportCaption($this->f20170218);
					if ($this->f20170219->Exportable) $Doc->ExportCaption($this->f20170219);
					if ($this->f20170220->Exportable) $Doc->ExportCaption($this->f20170220);
					if ($this->f20170221->Exportable) $Doc->ExportCaption($this->f20170221);
					if ($this->f20170222->Exportable) $Doc->ExportCaption($this->f20170222);
					if ($this->f20170223->Exportable) $Doc->ExportCaption($this->f20170223);
					if ($this->f20170224->Exportable) $Doc->ExportCaption($this->f20170224);
					if ($this->f20170225->Exportable) $Doc->ExportCaption($this->f20170225);
					if ($this->f20170226->Exportable) $Doc->ExportCaption($this->f20170226);
					if ($this->f20170227->Exportable) $Doc->ExportCaption($this->f20170227);
					if ($this->f20170228->Exportable) $Doc->ExportCaption($this->f20170228);
					if ($this->f20170229->Exportable) $Doc->ExportCaption($this->f20170229);
					if ($this->f20170301->Exportable) $Doc->ExportCaption($this->f20170301);
					if ($this->f20170302->Exportable) $Doc->ExportCaption($this->f20170302);
					if ($this->f20170303->Exportable) $Doc->ExportCaption($this->f20170303);
					if ($this->f20170304->Exportable) $Doc->ExportCaption($this->f20170304);
					if ($this->f20170305->Exportable) $Doc->ExportCaption($this->f20170305);
					if ($this->f20170306->Exportable) $Doc->ExportCaption($this->f20170306);
					if ($this->f20170307->Exportable) $Doc->ExportCaption($this->f20170307);
					if ($this->f20170308->Exportable) $Doc->ExportCaption($this->f20170308);
					if ($this->f20170309->Exportable) $Doc->ExportCaption($this->f20170309);
					if ($this->f20170310->Exportable) $Doc->ExportCaption($this->f20170310);
					if ($this->f20170311->Exportable) $Doc->ExportCaption($this->f20170311);
					if ($this->f20170312->Exportable) $Doc->ExportCaption($this->f20170312);
					if ($this->f20170313->Exportable) $Doc->ExportCaption($this->f20170313);
					if ($this->f20170314->Exportable) $Doc->ExportCaption($this->f20170314);
					if ($this->f20170315->Exportable) $Doc->ExportCaption($this->f20170315);
					if ($this->f20170316->Exportable) $Doc->ExportCaption($this->f20170316);
					if ($this->f20170317->Exportable) $Doc->ExportCaption($this->f20170317);
					if ($this->f20170318->Exportable) $Doc->ExportCaption($this->f20170318);
					if ($this->f20170319->Exportable) $Doc->ExportCaption($this->f20170319);
					if ($this->f20170320->Exportable) $Doc->ExportCaption($this->f20170320);
					if ($this->f20170321->Exportable) $Doc->ExportCaption($this->f20170321);
					if ($this->f20170322->Exportable) $Doc->ExportCaption($this->f20170322);
					if ($this->f20170323->Exportable) $Doc->ExportCaption($this->f20170323);
					if ($this->f20170324->Exportable) $Doc->ExportCaption($this->f20170324);
					if ($this->f20170325->Exportable) $Doc->ExportCaption($this->f20170325);
					if ($this->f20170326->Exportable) $Doc->ExportCaption($this->f20170326);
					if ($this->f20170327->Exportable) $Doc->ExportCaption($this->f20170327);
					if ($this->f20170328->Exportable) $Doc->ExportCaption($this->f20170328);
					if ($this->f20170329->Exportable) $Doc->ExportCaption($this->f20170329);
					if ($this->f20170330->Exportable) $Doc->ExportCaption($this->f20170330);
					if ($this->f20170331->Exportable) $Doc->ExportCaption($this->f20170331);
					if ($this->f20170401->Exportable) $Doc->ExportCaption($this->f20170401);
					if ($this->f20170402->Exportable) $Doc->ExportCaption($this->f20170402);
					if ($this->f20170403->Exportable) $Doc->ExportCaption($this->f20170403);
					if ($this->f20170404->Exportable) $Doc->ExportCaption($this->f20170404);
					if ($this->f20170405->Exportable) $Doc->ExportCaption($this->f20170405);
					if ($this->f20170406->Exportable) $Doc->ExportCaption($this->f20170406);
					if ($this->f20170407->Exportable) $Doc->ExportCaption($this->f20170407);
					if ($this->f20170408->Exportable) $Doc->ExportCaption($this->f20170408);
					if ($this->f20170409->Exportable) $Doc->ExportCaption($this->f20170409);
					if ($this->f20170410->Exportable) $Doc->ExportCaption($this->f20170410);
					if ($this->f20170411->Exportable) $Doc->ExportCaption($this->f20170411);
					if ($this->f20170412->Exportable) $Doc->ExportCaption($this->f20170412);
					if ($this->f20170413->Exportable) $Doc->ExportCaption($this->f20170413);
					if ($this->f20170414->Exportable) $Doc->ExportCaption($this->f20170414);
					if ($this->f20170415->Exportable) $Doc->ExportCaption($this->f20170415);
					if ($this->f20170416->Exportable) $Doc->ExportCaption($this->f20170416);
					if ($this->f20170417->Exportable) $Doc->ExportCaption($this->f20170417);
					if ($this->f20170418->Exportable) $Doc->ExportCaption($this->f20170418);
					if ($this->f20170419->Exportable) $Doc->ExportCaption($this->f20170419);
					if ($this->f20170420->Exportable) $Doc->ExportCaption($this->f20170420);
					if ($this->f20170421->Exportable) $Doc->ExportCaption($this->f20170421);
					if ($this->f20170422->Exportable) $Doc->ExportCaption($this->f20170422);
					if ($this->f20170423->Exportable) $Doc->ExportCaption($this->f20170423);
					if ($this->f20170424->Exportable) $Doc->ExportCaption($this->f20170424);
					if ($this->f20170425->Exportable) $Doc->ExportCaption($this->f20170425);
					if ($this->f20170426->Exportable) $Doc->ExportCaption($this->f20170426);
					if ($this->f20170427->Exportable) $Doc->ExportCaption($this->f20170427);
					if ($this->f20170428->Exportable) $Doc->ExportCaption($this->f20170428);
					if ($this->f20170429->Exportable) $Doc->ExportCaption($this->f20170429);
					if ($this->f20170430->Exportable) $Doc->ExportCaption($this->f20170430);
					if ($this->f20170501->Exportable) $Doc->ExportCaption($this->f20170501);
					if ($this->f20170502->Exportable) $Doc->ExportCaption($this->f20170502);
					if ($this->f20170503->Exportable) $Doc->ExportCaption($this->f20170503);
					if ($this->f20170504->Exportable) $Doc->ExportCaption($this->f20170504);
					if ($this->f20170505->Exportable) $Doc->ExportCaption($this->f20170505);
					if ($this->f20170506->Exportable) $Doc->ExportCaption($this->f20170506);
					if ($this->f20170507->Exportable) $Doc->ExportCaption($this->f20170507);
					if ($this->f20170508->Exportable) $Doc->ExportCaption($this->f20170508);
					if ($this->f20170509->Exportable) $Doc->ExportCaption($this->f20170509);
					if ($this->f20170510->Exportable) $Doc->ExportCaption($this->f20170510);
					if ($this->f20170511->Exportable) $Doc->ExportCaption($this->f20170511);
					if ($this->f20170512->Exportable) $Doc->ExportCaption($this->f20170512);
					if ($this->f20170513->Exportable) $Doc->ExportCaption($this->f20170513);
					if ($this->f20170514->Exportable) $Doc->ExportCaption($this->f20170514);
					if ($this->f20170515->Exportable) $Doc->ExportCaption($this->f20170515);
					if ($this->f20170516->Exportable) $Doc->ExportCaption($this->f20170516);
					if ($this->f20170517->Exportable) $Doc->ExportCaption($this->f20170517);
					if ($this->f20170518->Exportable) $Doc->ExportCaption($this->f20170518);
					if ($this->f20170519->Exportable) $Doc->ExportCaption($this->f20170519);
					if ($this->f20170520->Exportable) $Doc->ExportCaption($this->f20170520);
					if ($this->f20170521->Exportable) $Doc->ExportCaption($this->f20170521);
					if ($this->f20170522->Exportable) $Doc->ExportCaption($this->f20170522);
					if ($this->f20170523->Exportable) $Doc->ExportCaption($this->f20170523);
					if ($this->f20170524->Exportable) $Doc->ExportCaption($this->f20170524);
					if ($this->f20170525->Exportable) $Doc->ExportCaption($this->f20170525);
					if ($this->f20170526->Exportable) $Doc->ExportCaption($this->f20170526);
					if ($this->f20170527->Exportable) $Doc->ExportCaption($this->f20170527);
					if ($this->f20170528->Exportable) $Doc->ExportCaption($this->f20170528);
					if ($this->f20170529->Exportable) $Doc->ExportCaption($this->f20170529);
					if ($this->f20170530->Exportable) $Doc->ExportCaption($this->f20170530);
					if ($this->f20170531->Exportable) $Doc->ExportCaption($this->f20170531);
					if ($this->f20170601->Exportable) $Doc->ExportCaption($this->f20170601);
					if ($this->f20170602->Exportable) $Doc->ExportCaption($this->f20170602);
					if ($this->f20170603->Exportable) $Doc->ExportCaption($this->f20170603);
					if ($this->f20170604->Exportable) $Doc->ExportCaption($this->f20170604);
					if ($this->f20170605->Exportable) $Doc->ExportCaption($this->f20170605);
					if ($this->f20170606->Exportable) $Doc->ExportCaption($this->f20170606);
					if ($this->f20170607->Exportable) $Doc->ExportCaption($this->f20170607);
					if ($this->f20170608->Exportable) $Doc->ExportCaption($this->f20170608);
					if ($this->f20170609->Exportable) $Doc->ExportCaption($this->f20170609);
					if ($this->f20170610->Exportable) $Doc->ExportCaption($this->f20170610);
					if ($this->f20170611->Exportable) $Doc->ExportCaption($this->f20170611);
					if ($this->f20170612->Exportable) $Doc->ExportCaption($this->f20170612);
					if ($this->f20170613->Exportable) $Doc->ExportCaption($this->f20170613);
					if ($this->f20170614->Exportable) $Doc->ExportCaption($this->f20170614);
					if ($this->f20170615->Exportable) $Doc->ExportCaption($this->f20170615);
					if ($this->f20170616->Exportable) $Doc->ExportCaption($this->f20170616);
					if ($this->f20170617->Exportable) $Doc->ExportCaption($this->f20170617);
					if ($this->f20170618->Exportable) $Doc->ExportCaption($this->f20170618);
					if ($this->f20170619->Exportable) $Doc->ExportCaption($this->f20170619);
					if ($this->f20170620->Exportable) $Doc->ExportCaption($this->f20170620);
					if ($this->f20170621->Exportable) $Doc->ExportCaption($this->f20170621);
					if ($this->f20170622->Exportable) $Doc->ExportCaption($this->f20170622);
					if ($this->f20170623->Exportable) $Doc->ExportCaption($this->f20170623);
					if ($this->f20170624->Exportable) $Doc->ExportCaption($this->f20170624);
					if ($this->f20170625->Exportable) $Doc->ExportCaption($this->f20170625);
					if ($this->f20170626->Exportable) $Doc->ExportCaption($this->f20170626);
					if ($this->f20170627->Exportable) $Doc->ExportCaption($this->f20170627);
					if ($this->f20170628->Exportable) $Doc->ExportCaption($this->f20170628);
					if ($this->f20170629->Exportable) $Doc->ExportCaption($this->f20170629);
					if ($this->f20170630->Exportable) $Doc->ExportCaption($this->f20170630);
					if ($this->f20170701->Exportable) $Doc->ExportCaption($this->f20170701);
					if ($this->f20170702->Exportable) $Doc->ExportCaption($this->f20170702);
					if ($this->f20170703->Exportable) $Doc->ExportCaption($this->f20170703);
					if ($this->f20170704->Exportable) $Doc->ExportCaption($this->f20170704);
					if ($this->f20170705->Exportable) $Doc->ExportCaption($this->f20170705);
					if ($this->f20170706->Exportable) $Doc->ExportCaption($this->f20170706);
					if ($this->f20170707->Exportable) $Doc->ExportCaption($this->f20170707);
					if ($this->f20170708->Exportable) $Doc->ExportCaption($this->f20170708);
					if ($this->f20170709->Exportable) $Doc->ExportCaption($this->f20170709);
					if ($this->f20170710->Exportable) $Doc->ExportCaption($this->f20170710);
					if ($this->f20170711->Exportable) $Doc->ExportCaption($this->f20170711);
					if ($this->f20170712->Exportable) $Doc->ExportCaption($this->f20170712);
					if ($this->f20170713->Exportable) $Doc->ExportCaption($this->f20170713);
					if ($this->f20170714->Exportable) $Doc->ExportCaption($this->f20170714);
					if ($this->f20170715->Exportable) $Doc->ExportCaption($this->f20170715);
					if ($this->f20170716->Exportable) $Doc->ExportCaption($this->f20170716);
					if ($this->f20170717->Exportable) $Doc->ExportCaption($this->f20170717);
					if ($this->f20170718->Exportable) $Doc->ExportCaption($this->f20170718);
					if ($this->f20170719->Exportable) $Doc->ExportCaption($this->f20170719);
					if ($this->f20170720->Exportable) $Doc->ExportCaption($this->f20170720);
					if ($this->f20170721->Exportable) $Doc->ExportCaption($this->f20170721);
					if ($this->f20170722->Exportable) $Doc->ExportCaption($this->f20170722);
					if ($this->f20170723->Exportable) $Doc->ExportCaption($this->f20170723);
					if ($this->f20170724->Exportable) $Doc->ExportCaption($this->f20170724);
					if ($this->f20170725->Exportable) $Doc->ExportCaption($this->f20170725);
					if ($this->f20170726->Exportable) $Doc->ExportCaption($this->f20170726);
					if ($this->f20170727->Exportable) $Doc->ExportCaption($this->f20170727);
					if ($this->f20170728->Exportable) $Doc->ExportCaption($this->f20170728);
					if ($this->f20170729->Exportable) $Doc->ExportCaption($this->f20170729);
					if ($this->f20170730->Exportable) $Doc->ExportCaption($this->f20170730);
					if ($this->f20170731->Exportable) $Doc->ExportCaption($this->f20170731);
					if ($this->f20170801->Exportable) $Doc->ExportCaption($this->f20170801);
					if ($this->f20170802->Exportable) $Doc->ExportCaption($this->f20170802);
					if ($this->f20170803->Exportable) $Doc->ExportCaption($this->f20170803);
					if ($this->f20170804->Exportable) $Doc->ExportCaption($this->f20170804);
					if ($this->f20170805->Exportable) $Doc->ExportCaption($this->f20170805);
					if ($this->f20170806->Exportable) $Doc->ExportCaption($this->f20170806);
					if ($this->f20170807->Exportable) $Doc->ExportCaption($this->f20170807);
					if ($this->f20170808->Exportable) $Doc->ExportCaption($this->f20170808);
					if ($this->f20170809->Exportable) $Doc->ExportCaption($this->f20170809);
					if ($this->f20170810->Exportable) $Doc->ExportCaption($this->f20170810);
					if ($this->f20170811->Exportable) $Doc->ExportCaption($this->f20170811);
					if ($this->f20170812->Exportable) $Doc->ExportCaption($this->f20170812);
					if ($this->f20170813->Exportable) $Doc->ExportCaption($this->f20170813);
					if ($this->f20170814->Exportable) $Doc->ExportCaption($this->f20170814);
					if ($this->f20170815->Exportable) $Doc->ExportCaption($this->f20170815);
					if ($this->f20170816->Exportable) $Doc->ExportCaption($this->f20170816);
					if ($this->f20170817->Exportable) $Doc->ExportCaption($this->f20170817);
					if ($this->f20170818->Exportable) $Doc->ExportCaption($this->f20170818);
					if ($this->f20170819->Exportable) $Doc->ExportCaption($this->f20170819);
					if ($this->f20170820->Exportable) $Doc->ExportCaption($this->f20170820);
					if ($this->f20170821->Exportable) $Doc->ExportCaption($this->f20170821);
					if ($this->f20170822->Exportable) $Doc->ExportCaption($this->f20170822);
					if ($this->f20170823->Exportable) $Doc->ExportCaption($this->f20170823);
					if ($this->f20170824->Exportable) $Doc->ExportCaption($this->f20170824);
					if ($this->f20170825->Exportable) $Doc->ExportCaption($this->f20170825);
					if ($this->f20170826->Exportable) $Doc->ExportCaption($this->f20170826);
					if ($this->f20170827->Exportable) $Doc->ExportCaption($this->f20170827);
					if ($this->f20170828->Exportable) $Doc->ExportCaption($this->f20170828);
					if ($this->f20170829->Exportable) $Doc->ExportCaption($this->f20170829);
					if ($this->f20170830->Exportable) $Doc->ExportCaption($this->f20170830);
					if ($this->f20170831->Exportable) $Doc->ExportCaption($this->f20170831);
					if ($this->f20170901->Exportable) $Doc->ExportCaption($this->f20170901);
					if ($this->f20170902->Exportable) $Doc->ExportCaption($this->f20170902);
					if ($this->f20170903->Exportable) $Doc->ExportCaption($this->f20170903);
					if ($this->f20170904->Exportable) $Doc->ExportCaption($this->f20170904);
					if ($this->f20170905->Exportable) $Doc->ExportCaption($this->f20170905);
					if ($this->f20170906->Exportable) $Doc->ExportCaption($this->f20170906);
					if ($this->f20170907->Exportable) $Doc->ExportCaption($this->f20170907);
					if ($this->f20170908->Exportable) $Doc->ExportCaption($this->f20170908);
					if ($this->f20170909->Exportable) $Doc->ExportCaption($this->f20170909);
					if ($this->f20170910->Exportable) $Doc->ExportCaption($this->f20170910);
					if ($this->f20170911->Exportable) $Doc->ExportCaption($this->f20170911);
					if ($this->f20170912->Exportable) $Doc->ExportCaption($this->f20170912);
					if ($this->f20170913->Exportable) $Doc->ExportCaption($this->f20170913);
					if ($this->f20170914->Exportable) $Doc->ExportCaption($this->f20170914);
					if ($this->f20170915->Exportable) $Doc->ExportCaption($this->f20170915);
					if ($this->f20170916->Exportable) $Doc->ExportCaption($this->f20170916);
					if ($this->f20170917->Exportable) $Doc->ExportCaption($this->f20170917);
					if ($this->f20170918->Exportable) $Doc->ExportCaption($this->f20170918);
					if ($this->f20170919->Exportable) $Doc->ExportCaption($this->f20170919);
					if ($this->f20170920->Exportable) $Doc->ExportCaption($this->f20170920);
					if ($this->f20170921->Exportable) $Doc->ExportCaption($this->f20170921);
					if ($this->f20170922->Exportable) $Doc->ExportCaption($this->f20170922);
					if ($this->f20170923->Exportable) $Doc->ExportCaption($this->f20170923);
					if ($this->f20170924->Exportable) $Doc->ExportCaption($this->f20170924);
					if ($this->f20170925->Exportable) $Doc->ExportCaption($this->f20170925);
					if ($this->f20170926->Exportable) $Doc->ExportCaption($this->f20170926);
					if ($this->f20170927->Exportable) $Doc->ExportCaption($this->f20170927);
					if ($this->f20170928->Exportable) $Doc->ExportCaption($this->f20170928);
					if ($this->f20170929->Exportable) $Doc->ExportCaption($this->f20170929);
					if ($this->f20170930->Exportable) $Doc->ExportCaption($this->f20170930);
					if ($this->f20171001->Exportable) $Doc->ExportCaption($this->f20171001);
					if ($this->f20171002->Exportable) $Doc->ExportCaption($this->f20171002);
					if ($this->f20171003->Exportable) $Doc->ExportCaption($this->f20171003);
					if ($this->f20171004->Exportable) $Doc->ExportCaption($this->f20171004);
					if ($this->f20171005->Exportable) $Doc->ExportCaption($this->f20171005);
					if ($this->f20171006->Exportable) $Doc->ExportCaption($this->f20171006);
					if ($this->f20171007->Exportable) $Doc->ExportCaption($this->f20171007);
					if ($this->f20171008->Exportable) $Doc->ExportCaption($this->f20171008);
					if ($this->f20171009->Exportable) $Doc->ExportCaption($this->f20171009);
					if ($this->f20171010->Exportable) $Doc->ExportCaption($this->f20171010);
					if ($this->f20171011->Exportable) $Doc->ExportCaption($this->f20171011);
					if ($this->f20171012->Exportable) $Doc->ExportCaption($this->f20171012);
					if ($this->f20171013->Exportable) $Doc->ExportCaption($this->f20171013);
					if ($this->f20171014->Exportable) $Doc->ExportCaption($this->f20171014);
					if ($this->f20171015->Exportable) $Doc->ExportCaption($this->f20171015);
					if ($this->f20171016->Exportable) $Doc->ExportCaption($this->f20171016);
					if ($this->f20171017->Exportable) $Doc->ExportCaption($this->f20171017);
					if ($this->f20171018->Exportable) $Doc->ExportCaption($this->f20171018);
					if ($this->f20171019->Exportable) $Doc->ExportCaption($this->f20171019);
					if ($this->f20171020->Exportable) $Doc->ExportCaption($this->f20171020);
					if ($this->f20171021->Exportable) $Doc->ExportCaption($this->f20171021);
					if ($this->f20171022->Exportable) $Doc->ExportCaption($this->f20171022);
					if ($this->f20171023->Exportable) $Doc->ExportCaption($this->f20171023);
					if ($this->f20171024->Exportable) $Doc->ExportCaption($this->f20171024);
					if ($this->f20171025->Exportable) $Doc->ExportCaption($this->f20171025);
					if ($this->f20171026->Exportable) $Doc->ExportCaption($this->f20171026);
					if ($this->f20171027->Exportable) $Doc->ExportCaption($this->f20171027);
					if ($this->f20171028->Exportable) $Doc->ExportCaption($this->f20171028);
					if ($this->f20171029->Exportable) $Doc->ExportCaption($this->f20171029);
					if ($this->f20171030->Exportable) $Doc->ExportCaption($this->f20171030);
					if ($this->f20171031->Exportable) $Doc->ExportCaption($this->f20171031);
					if ($this->f20171101->Exportable) $Doc->ExportCaption($this->f20171101);
					if ($this->f20171102->Exportable) $Doc->ExportCaption($this->f20171102);
					if ($this->f20171103->Exportable) $Doc->ExportCaption($this->f20171103);
					if ($this->f20171104->Exportable) $Doc->ExportCaption($this->f20171104);
					if ($this->f20171105->Exportable) $Doc->ExportCaption($this->f20171105);
					if ($this->f20171106->Exportable) $Doc->ExportCaption($this->f20171106);
					if ($this->f20171107->Exportable) $Doc->ExportCaption($this->f20171107);
					if ($this->f20171108->Exportable) $Doc->ExportCaption($this->f20171108);
					if ($this->f20171109->Exportable) $Doc->ExportCaption($this->f20171109);
					if ($this->f20171110->Exportable) $Doc->ExportCaption($this->f20171110);
					if ($this->f20171111->Exportable) $Doc->ExportCaption($this->f20171111);
					if ($this->f20171112->Exportable) $Doc->ExportCaption($this->f20171112);
					if ($this->f20171113->Exportable) $Doc->ExportCaption($this->f20171113);
					if ($this->f20171114->Exportable) $Doc->ExportCaption($this->f20171114);
					if ($this->f20171115->Exportable) $Doc->ExportCaption($this->f20171115);
					if ($this->f20171116->Exportable) $Doc->ExportCaption($this->f20171116);
					if ($this->f20171117->Exportable) $Doc->ExportCaption($this->f20171117);
					if ($this->f20171118->Exportable) $Doc->ExportCaption($this->f20171118);
					if ($this->f20171119->Exportable) $Doc->ExportCaption($this->f20171119);
					if ($this->f20171120->Exportable) $Doc->ExportCaption($this->f20171120);
					if ($this->f20171121->Exportable) $Doc->ExportCaption($this->f20171121);
					if ($this->f20171122->Exportable) $Doc->ExportCaption($this->f20171122);
					if ($this->f20171123->Exportable) $Doc->ExportCaption($this->f20171123);
					if ($this->f20171124->Exportable) $Doc->ExportCaption($this->f20171124);
					if ($this->f20171125->Exportable) $Doc->ExportCaption($this->f20171125);
					if ($this->f20171126->Exportable) $Doc->ExportCaption($this->f20171126);
					if ($this->f20171127->Exportable) $Doc->ExportCaption($this->f20171127);
					if ($this->f20171128->Exportable) $Doc->ExportCaption($this->f20171128);
					if ($this->f20171129->Exportable) $Doc->ExportCaption($this->f20171129);
					if ($this->f20171130->Exportable) $Doc->ExportCaption($this->f20171130);
					if ($this->f20171201->Exportable) $Doc->ExportCaption($this->f20171201);
					if ($this->f20171202->Exportable) $Doc->ExportCaption($this->f20171202);
					if ($this->f20171203->Exportable) $Doc->ExportCaption($this->f20171203);
					if ($this->f20171204->Exportable) $Doc->ExportCaption($this->f20171204);
					if ($this->f20171205->Exportable) $Doc->ExportCaption($this->f20171205);
					if ($this->f20171206->Exportable) $Doc->ExportCaption($this->f20171206);
					if ($this->f20171207->Exportable) $Doc->ExportCaption($this->f20171207);
					if ($this->f20171208->Exportable) $Doc->ExportCaption($this->f20171208);
					if ($this->f20171209->Exportable) $Doc->ExportCaption($this->f20171209);
					if ($this->f20171210->Exportable) $Doc->ExportCaption($this->f20171210);
					if ($this->f20171211->Exportable) $Doc->ExportCaption($this->f20171211);
					if ($this->f20171212->Exportable) $Doc->ExportCaption($this->f20171212);
					if ($this->f20171213->Exportable) $Doc->ExportCaption($this->f20171213);
					if ($this->f20171214->Exportable) $Doc->ExportCaption($this->f20171214);
					if ($this->f20171215->Exportable) $Doc->ExportCaption($this->f20171215);
					if ($this->f20171216->Exportable) $Doc->ExportCaption($this->f20171216);
					if ($this->f20171217->Exportable) $Doc->ExportCaption($this->f20171217);
					if ($this->f20171218->Exportable) $Doc->ExportCaption($this->f20171218);
					if ($this->f20171219->Exportable) $Doc->ExportCaption($this->f20171219);
					if ($this->f20171220->Exportable) $Doc->ExportCaption($this->f20171220);
					if ($this->f20171221->Exportable) $Doc->ExportCaption($this->f20171221);
					if ($this->f20171222->Exportable) $Doc->ExportCaption($this->f20171222);
					if ($this->f20171223->Exportable) $Doc->ExportCaption($this->f20171223);
					if ($this->f20171224->Exportable) $Doc->ExportCaption($this->f20171224);
					if ($this->f20171225->Exportable) $Doc->ExportCaption($this->f20171225);
					if ($this->f20171226->Exportable) $Doc->ExportCaption($this->f20171226);
					if ($this->f20171227->Exportable) $Doc->ExportCaption($this->f20171227);
					if ($this->f20171228->Exportable) $Doc->ExportCaption($this->f20171228);
					if ($this->f20171229->Exportable) $Doc->ExportCaption($this->f20171229);
					if ($this->f20171230->Exportable) $Doc->ExportCaption($this->f20171230);
					if ($this->f20171231->Exportable) $Doc->ExportCaption($this->f20171231);
				} else {
					if ($this->jdwkrjpeg_id->Exportable) $Doc->ExportCaption($this->jdwkrjpeg_id);
					if ($this->pegawai_id->Exportable) $Doc->ExportCaption($this->pegawai_id);
					if ($this->f20170101->Exportable) $Doc->ExportCaption($this->f20170101);
					if ($this->f20170102->Exportable) $Doc->ExportCaption($this->f20170102);
					if ($this->f20170103->Exportable) $Doc->ExportCaption($this->f20170103);
					if ($this->f20170104->Exportable) $Doc->ExportCaption($this->f20170104);
					if ($this->f20170105->Exportable) $Doc->ExportCaption($this->f20170105);
					if ($this->f20170106->Exportable) $Doc->ExportCaption($this->f20170106);
					if ($this->f20170107->Exportable) $Doc->ExportCaption($this->f20170107);
					if ($this->f20170108->Exportable) $Doc->ExportCaption($this->f20170108);
					if ($this->f20170109->Exportable) $Doc->ExportCaption($this->f20170109);
					if ($this->f20170110->Exportable) $Doc->ExportCaption($this->f20170110);
					if ($this->f20170111->Exportable) $Doc->ExportCaption($this->f20170111);
					if ($this->f20170112->Exportable) $Doc->ExportCaption($this->f20170112);
					if ($this->f20170113->Exportable) $Doc->ExportCaption($this->f20170113);
					if ($this->f20170114->Exportable) $Doc->ExportCaption($this->f20170114);
					if ($this->f20170115->Exportable) $Doc->ExportCaption($this->f20170115);
					if ($this->f20170116->Exportable) $Doc->ExportCaption($this->f20170116);
					if ($this->f20170117->Exportable) $Doc->ExportCaption($this->f20170117);
					if ($this->f20170118->Exportable) $Doc->ExportCaption($this->f20170118);
					if ($this->f20170119->Exportable) $Doc->ExportCaption($this->f20170119);
					if ($this->f20170120->Exportable) $Doc->ExportCaption($this->f20170120);
					if ($this->f20170121->Exportable) $Doc->ExportCaption($this->f20170121);
					if ($this->f20170122->Exportable) $Doc->ExportCaption($this->f20170122);
					if ($this->f20170123->Exportable) $Doc->ExportCaption($this->f20170123);
					if ($this->f20170124->Exportable) $Doc->ExportCaption($this->f20170124);
					if ($this->f20170125->Exportable) $Doc->ExportCaption($this->f20170125);
					if ($this->f20170126->Exportable) $Doc->ExportCaption($this->f20170126);
					if ($this->f20170127->Exportable) $Doc->ExportCaption($this->f20170127);
					if ($this->f20170128->Exportable) $Doc->ExportCaption($this->f20170128);
					if ($this->f20170129->Exportable) $Doc->ExportCaption($this->f20170129);
					if ($this->f20170130->Exportable) $Doc->ExportCaption($this->f20170130);
					if ($this->f20170131->Exportable) $Doc->ExportCaption($this->f20170131);
					if ($this->f20170201->Exportable) $Doc->ExportCaption($this->f20170201);
					if ($this->f20170202->Exportable) $Doc->ExportCaption($this->f20170202);
					if ($this->f20170203->Exportable) $Doc->ExportCaption($this->f20170203);
					if ($this->f20170204->Exportable) $Doc->ExportCaption($this->f20170204);
					if ($this->f20170205->Exportable) $Doc->ExportCaption($this->f20170205);
					if ($this->f20170206->Exportable) $Doc->ExportCaption($this->f20170206);
					if ($this->f20170207->Exportable) $Doc->ExportCaption($this->f20170207);
					if ($this->f20170208->Exportable) $Doc->ExportCaption($this->f20170208);
					if ($this->f20170209->Exportable) $Doc->ExportCaption($this->f20170209);
					if ($this->f20170210->Exportable) $Doc->ExportCaption($this->f20170210);
					if ($this->f20170211->Exportable) $Doc->ExportCaption($this->f20170211);
					if ($this->f20170212->Exportable) $Doc->ExportCaption($this->f20170212);
					if ($this->f20170213->Exportable) $Doc->ExportCaption($this->f20170213);
					if ($this->f20170214->Exportable) $Doc->ExportCaption($this->f20170214);
					if ($this->f20170215->Exportable) $Doc->ExportCaption($this->f20170215);
					if ($this->f20170216->Exportable) $Doc->ExportCaption($this->f20170216);
					if ($this->f20170217->Exportable) $Doc->ExportCaption($this->f20170217);
					if ($this->f20170218->Exportable) $Doc->ExportCaption($this->f20170218);
					if ($this->f20170219->Exportable) $Doc->ExportCaption($this->f20170219);
					if ($this->f20170220->Exportable) $Doc->ExportCaption($this->f20170220);
					if ($this->f20170221->Exportable) $Doc->ExportCaption($this->f20170221);
					if ($this->f20170222->Exportable) $Doc->ExportCaption($this->f20170222);
					if ($this->f20170223->Exportable) $Doc->ExportCaption($this->f20170223);
					if ($this->f20170224->Exportable) $Doc->ExportCaption($this->f20170224);
					if ($this->f20170225->Exportable) $Doc->ExportCaption($this->f20170225);
					if ($this->f20170226->Exportable) $Doc->ExportCaption($this->f20170226);
					if ($this->f20170227->Exportable) $Doc->ExportCaption($this->f20170227);
					if ($this->f20170228->Exportable) $Doc->ExportCaption($this->f20170228);
					if ($this->f20170229->Exportable) $Doc->ExportCaption($this->f20170229);
					if ($this->f20170301->Exportable) $Doc->ExportCaption($this->f20170301);
					if ($this->f20170302->Exportable) $Doc->ExportCaption($this->f20170302);
					if ($this->f20170303->Exportable) $Doc->ExportCaption($this->f20170303);
					if ($this->f20170304->Exportable) $Doc->ExportCaption($this->f20170304);
					if ($this->f20170305->Exportable) $Doc->ExportCaption($this->f20170305);
					if ($this->f20170306->Exportable) $Doc->ExportCaption($this->f20170306);
					if ($this->f20170307->Exportable) $Doc->ExportCaption($this->f20170307);
					if ($this->f20170308->Exportable) $Doc->ExportCaption($this->f20170308);
					if ($this->f20170309->Exportable) $Doc->ExportCaption($this->f20170309);
					if ($this->f20170310->Exportable) $Doc->ExportCaption($this->f20170310);
					if ($this->f20170311->Exportable) $Doc->ExportCaption($this->f20170311);
					if ($this->f20170312->Exportable) $Doc->ExportCaption($this->f20170312);
					if ($this->f20170313->Exportable) $Doc->ExportCaption($this->f20170313);
					if ($this->f20170314->Exportable) $Doc->ExportCaption($this->f20170314);
					if ($this->f20170315->Exportable) $Doc->ExportCaption($this->f20170315);
					if ($this->f20170316->Exportable) $Doc->ExportCaption($this->f20170316);
					if ($this->f20170317->Exportable) $Doc->ExportCaption($this->f20170317);
					if ($this->f20170318->Exportable) $Doc->ExportCaption($this->f20170318);
					if ($this->f20170319->Exportable) $Doc->ExportCaption($this->f20170319);
					if ($this->f20170320->Exportable) $Doc->ExportCaption($this->f20170320);
					if ($this->f20170321->Exportable) $Doc->ExportCaption($this->f20170321);
					if ($this->f20170322->Exportable) $Doc->ExportCaption($this->f20170322);
					if ($this->f20170323->Exportable) $Doc->ExportCaption($this->f20170323);
					if ($this->f20170324->Exportable) $Doc->ExportCaption($this->f20170324);
					if ($this->f20170325->Exportable) $Doc->ExportCaption($this->f20170325);
					if ($this->f20170326->Exportable) $Doc->ExportCaption($this->f20170326);
					if ($this->f20170327->Exportable) $Doc->ExportCaption($this->f20170327);
					if ($this->f20170328->Exportable) $Doc->ExportCaption($this->f20170328);
					if ($this->f20170329->Exportable) $Doc->ExportCaption($this->f20170329);
					if ($this->f20170330->Exportable) $Doc->ExportCaption($this->f20170330);
					if ($this->f20170331->Exportable) $Doc->ExportCaption($this->f20170331);
					if ($this->f20170401->Exportable) $Doc->ExportCaption($this->f20170401);
					if ($this->f20170402->Exportable) $Doc->ExportCaption($this->f20170402);
					if ($this->f20170403->Exportable) $Doc->ExportCaption($this->f20170403);
					if ($this->f20170404->Exportable) $Doc->ExportCaption($this->f20170404);
					if ($this->f20170405->Exportable) $Doc->ExportCaption($this->f20170405);
					if ($this->f20170406->Exportable) $Doc->ExportCaption($this->f20170406);
					if ($this->f20170407->Exportable) $Doc->ExportCaption($this->f20170407);
					if ($this->f20170408->Exportable) $Doc->ExportCaption($this->f20170408);
					if ($this->f20170409->Exportable) $Doc->ExportCaption($this->f20170409);
					if ($this->f20170410->Exportable) $Doc->ExportCaption($this->f20170410);
					if ($this->f20170411->Exportable) $Doc->ExportCaption($this->f20170411);
					if ($this->f20170412->Exportable) $Doc->ExportCaption($this->f20170412);
					if ($this->f20170413->Exportable) $Doc->ExportCaption($this->f20170413);
					if ($this->f20170414->Exportable) $Doc->ExportCaption($this->f20170414);
					if ($this->f20170415->Exportable) $Doc->ExportCaption($this->f20170415);
					if ($this->f20170416->Exportable) $Doc->ExportCaption($this->f20170416);
					if ($this->f20170417->Exportable) $Doc->ExportCaption($this->f20170417);
					if ($this->f20170418->Exportable) $Doc->ExportCaption($this->f20170418);
					if ($this->f20170419->Exportable) $Doc->ExportCaption($this->f20170419);
					if ($this->f20170420->Exportable) $Doc->ExportCaption($this->f20170420);
					if ($this->f20170421->Exportable) $Doc->ExportCaption($this->f20170421);
					if ($this->f20170422->Exportable) $Doc->ExportCaption($this->f20170422);
					if ($this->f20170423->Exportable) $Doc->ExportCaption($this->f20170423);
					if ($this->f20170424->Exportable) $Doc->ExportCaption($this->f20170424);
					if ($this->f20170425->Exportable) $Doc->ExportCaption($this->f20170425);
					if ($this->f20170426->Exportable) $Doc->ExportCaption($this->f20170426);
					if ($this->f20170427->Exportable) $Doc->ExportCaption($this->f20170427);
					if ($this->f20170428->Exportable) $Doc->ExportCaption($this->f20170428);
					if ($this->f20170429->Exportable) $Doc->ExportCaption($this->f20170429);
					if ($this->f20170430->Exportable) $Doc->ExportCaption($this->f20170430);
					if ($this->f20170501->Exportable) $Doc->ExportCaption($this->f20170501);
					if ($this->f20170502->Exportable) $Doc->ExportCaption($this->f20170502);
					if ($this->f20170503->Exportable) $Doc->ExportCaption($this->f20170503);
					if ($this->f20170504->Exportable) $Doc->ExportCaption($this->f20170504);
					if ($this->f20170505->Exportable) $Doc->ExportCaption($this->f20170505);
					if ($this->f20170506->Exportable) $Doc->ExportCaption($this->f20170506);
					if ($this->f20170507->Exportable) $Doc->ExportCaption($this->f20170507);
					if ($this->f20170508->Exportable) $Doc->ExportCaption($this->f20170508);
					if ($this->f20170509->Exportable) $Doc->ExportCaption($this->f20170509);
					if ($this->f20170510->Exportable) $Doc->ExportCaption($this->f20170510);
					if ($this->f20170511->Exportable) $Doc->ExportCaption($this->f20170511);
					if ($this->f20170512->Exportable) $Doc->ExportCaption($this->f20170512);
					if ($this->f20170513->Exportable) $Doc->ExportCaption($this->f20170513);
					if ($this->f20170514->Exportable) $Doc->ExportCaption($this->f20170514);
					if ($this->f20170515->Exportable) $Doc->ExportCaption($this->f20170515);
					if ($this->f20170516->Exportable) $Doc->ExportCaption($this->f20170516);
					if ($this->f20170517->Exportable) $Doc->ExportCaption($this->f20170517);
					if ($this->f20170518->Exportable) $Doc->ExportCaption($this->f20170518);
					if ($this->f20170519->Exportable) $Doc->ExportCaption($this->f20170519);
					if ($this->f20170520->Exportable) $Doc->ExportCaption($this->f20170520);
					if ($this->f20170521->Exportable) $Doc->ExportCaption($this->f20170521);
					if ($this->f20170522->Exportable) $Doc->ExportCaption($this->f20170522);
					if ($this->f20170523->Exportable) $Doc->ExportCaption($this->f20170523);
					if ($this->f20170524->Exportable) $Doc->ExportCaption($this->f20170524);
					if ($this->f20170525->Exportable) $Doc->ExportCaption($this->f20170525);
					if ($this->f20170526->Exportable) $Doc->ExportCaption($this->f20170526);
					if ($this->f20170527->Exportable) $Doc->ExportCaption($this->f20170527);
					if ($this->f20170528->Exportable) $Doc->ExportCaption($this->f20170528);
					if ($this->f20170529->Exportable) $Doc->ExportCaption($this->f20170529);
					if ($this->f20170530->Exportable) $Doc->ExportCaption($this->f20170530);
					if ($this->f20170531->Exportable) $Doc->ExportCaption($this->f20170531);
					if ($this->f20170601->Exportable) $Doc->ExportCaption($this->f20170601);
					if ($this->f20170602->Exportable) $Doc->ExportCaption($this->f20170602);
					if ($this->f20170603->Exportable) $Doc->ExportCaption($this->f20170603);
					if ($this->f20170604->Exportable) $Doc->ExportCaption($this->f20170604);
					if ($this->f20170605->Exportable) $Doc->ExportCaption($this->f20170605);
					if ($this->f20170606->Exportable) $Doc->ExportCaption($this->f20170606);
					if ($this->f20170607->Exportable) $Doc->ExportCaption($this->f20170607);
					if ($this->f20170608->Exportable) $Doc->ExportCaption($this->f20170608);
					if ($this->f20170609->Exportable) $Doc->ExportCaption($this->f20170609);
					if ($this->f20170610->Exportable) $Doc->ExportCaption($this->f20170610);
					if ($this->f20170611->Exportable) $Doc->ExportCaption($this->f20170611);
					if ($this->f20170612->Exportable) $Doc->ExportCaption($this->f20170612);
					if ($this->f20170613->Exportable) $Doc->ExportCaption($this->f20170613);
					if ($this->f20170614->Exportable) $Doc->ExportCaption($this->f20170614);
					if ($this->f20170615->Exportable) $Doc->ExportCaption($this->f20170615);
					if ($this->f20170616->Exportable) $Doc->ExportCaption($this->f20170616);
					if ($this->f20170617->Exportable) $Doc->ExportCaption($this->f20170617);
					if ($this->f20170618->Exportable) $Doc->ExportCaption($this->f20170618);
					if ($this->f20170619->Exportable) $Doc->ExportCaption($this->f20170619);
					if ($this->f20170620->Exportable) $Doc->ExportCaption($this->f20170620);
					if ($this->f20170621->Exportable) $Doc->ExportCaption($this->f20170621);
					if ($this->f20170622->Exportable) $Doc->ExportCaption($this->f20170622);
					if ($this->f20170623->Exportable) $Doc->ExportCaption($this->f20170623);
					if ($this->f20170624->Exportable) $Doc->ExportCaption($this->f20170624);
					if ($this->f20170625->Exportable) $Doc->ExportCaption($this->f20170625);
					if ($this->f20170626->Exportable) $Doc->ExportCaption($this->f20170626);
					if ($this->f20170627->Exportable) $Doc->ExportCaption($this->f20170627);
					if ($this->f20170628->Exportable) $Doc->ExportCaption($this->f20170628);
					if ($this->f20170629->Exportable) $Doc->ExportCaption($this->f20170629);
					if ($this->f20170630->Exportable) $Doc->ExportCaption($this->f20170630);
					if ($this->f20170701->Exportable) $Doc->ExportCaption($this->f20170701);
					if ($this->f20170702->Exportable) $Doc->ExportCaption($this->f20170702);
					if ($this->f20170703->Exportable) $Doc->ExportCaption($this->f20170703);
					if ($this->f20170704->Exportable) $Doc->ExportCaption($this->f20170704);
					if ($this->f20170705->Exportable) $Doc->ExportCaption($this->f20170705);
					if ($this->f20170706->Exportable) $Doc->ExportCaption($this->f20170706);
					if ($this->f20170707->Exportable) $Doc->ExportCaption($this->f20170707);
					if ($this->f20170708->Exportable) $Doc->ExportCaption($this->f20170708);
					if ($this->f20170709->Exportable) $Doc->ExportCaption($this->f20170709);
					if ($this->f20170710->Exportable) $Doc->ExportCaption($this->f20170710);
					if ($this->f20170711->Exportable) $Doc->ExportCaption($this->f20170711);
					if ($this->f20170712->Exportable) $Doc->ExportCaption($this->f20170712);
					if ($this->f20170713->Exportable) $Doc->ExportCaption($this->f20170713);
					if ($this->f20170714->Exportable) $Doc->ExportCaption($this->f20170714);
					if ($this->f20170715->Exportable) $Doc->ExportCaption($this->f20170715);
					if ($this->f20170716->Exportable) $Doc->ExportCaption($this->f20170716);
					if ($this->f20170717->Exportable) $Doc->ExportCaption($this->f20170717);
					if ($this->f20170718->Exportable) $Doc->ExportCaption($this->f20170718);
					if ($this->f20170719->Exportable) $Doc->ExportCaption($this->f20170719);
					if ($this->f20170720->Exportable) $Doc->ExportCaption($this->f20170720);
					if ($this->f20170721->Exportable) $Doc->ExportCaption($this->f20170721);
					if ($this->f20170722->Exportable) $Doc->ExportCaption($this->f20170722);
					if ($this->f20170723->Exportable) $Doc->ExportCaption($this->f20170723);
					if ($this->f20170724->Exportable) $Doc->ExportCaption($this->f20170724);
					if ($this->f20170725->Exportable) $Doc->ExportCaption($this->f20170725);
					if ($this->f20170726->Exportable) $Doc->ExportCaption($this->f20170726);
					if ($this->f20170727->Exportable) $Doc->ExportCaption($this->f20170727);
					if ($this->f20170728->Exportable) $Doc->ExportCaption($this->f20170728);
					if ($this->f20170729->Exportable) $Doc->ExportCaption($this->f20170729);
					if ($this->f20170730->Exportable) $Doc->ExportCaption($this->f20170730);
					if ($this->f20170731->Exportable) $Doc->ExportCaption($this->f20170731);
					if ($this->f20170801->Exportable) $Doc->ExportCaption($this->f20170801);
					if ($this->f20170802->Exportable) $Doc->ExportCaption($this->f20170802);
					if ($this->f20170803->Exportable) $Doc->ExportCaption($this->f20170803);
					if ($this->f20170804->Exportable) $Doc->ExportCaption($this->f20170804);
					if ($this->f20170805->Exportable) $Doc->ExportCaption($this->f20170805);
					if ($this->f20170806->Exportable) $Doc->ExportCaption($this->f20170806);
					if ($this->f20170807->Exportable) $Doc->ExportCaption($this->f20170807);
					if ($this->f20170808->Exportable) $Doc->ExportCaption($this->f20170808);
					if ($this->f20170809->Exportable) $Doc->ExportCaption($this->f20170809);
					if ($this->f20170810->Exportable) $Doc->ExportCaption($this->f20170810);
					if ($this->f20170811->Exportable) $Doc->ExportCaption($this->f20170811);
					if ($this->f20170812->Exportable) $Doc->ExportCaption($this->f20170812);
					if ($this->f20170813->Exportable) $Doc->ExportCaption($this->f20170813);
					if ($this->f20170814->Exportable) $Doc->ExportCaption($this->f20170814);
					if ($this->f20170815->Exportable) $Doc->ExportCaption($this->f20170815);
					if ($this->f20170816->Exportable) $Doc->ExportCaption($this->f20170816);
					if ($this->f20170817->Exportable) $Doc->ExportCaption($this->f20170817);
					if ($this->f20170818->Exportable) $Doc->ExportCaption($this->f20170818);
					if ($this->f20170819->Exportable) $Doc->ExportCaption($this->f20170819);
					if ($this->f20170820->Exportable) $Doc->ExportCaption($this->f20170820);
					if ($this->f20170821->Exportable) $Doc->ExportCaption($this->f20170821);
					if ($this->f20170822->Exportable) $Doc->ExportCaption($this->f20170822);
					if ($this->f20170823->Exportable) $Doc->ExportCaption($this->f20170823);
					if ($this->f20170824->Exportable) $Doc->ExportCaption($this->f20170824);
					if ($this->f20170825->Exportable) $Doc->ExportCaption($this->f20170825);
					if ($this->f20170826->Exportable) $Doc->ExportCaption($this->f20170826);
					if ($this->f20170827->Exportable) $Doc->ExportCaption($this->f20170827);
					if ($this->f20170828->Exportable) $Doc->ExportCaption($this->f20170828);
					if ($this->f20170829->Exportable) $Doc->ExportCaption($this->f20170829);
					if ($this->f20170830->Exportable) $Doc->ExportCaption($this->f20170830);
					if ($this->f20170831->Exportable) $Doc->ExportCaption($this->f20170831);
					if ($this->f20170901->Exportable) $Doc->ExportCaption($this->f20170901);
					if ($this->f20170902->Exportable) $Doc->ExportCaption($this->f20170902);
					if ($this->f20170903->Exportable) $Doc->ExportCaption($this->f20170903);
					if ($this->f20170904->Exportable) $Doc->ExportCaption($this->f20170904);
					if ($this->f20170905->Exportable) $Doc->ExportCaption($this->f20170905);
					if ($this->f20170906->Exportable) $Doc->ExportCaption($this->f20170906);
					if ($this->f20170907->Exportable) $Doc->ExportCaption($this->f20170907);
					if ($this->f20170908->Exportable) $Doc->ExportCaption($this->f20170908);
					if ($this->f20170909->Exportable) $Doc->ExportCaption($this->f20170909);
					if ($this->f20170910->Exportable) $Doc->ExportCaption($this->f20170910);
					if ($this->f20170911->Exportable) $Doc->ExportCaption($this->f20170911);
					if ($this->f20170912->Exportable) $Doc->ExportCaption($this->f20170912);
					if ($this->f20170913->Exportable) $Doc->ExportCaption($this->f20170913);
					if ($this->f20170914->Exportable) $Doc->ExportCaption($this->f20170914);
					if ($this->f20170915->Exportable) $Doc->ExportCaption($this->f20170915);
					if ($this->f20170916->Exportable) $Doc->ExportCaption($this->f20170916);
					if ($this->f20170917->Exportable) $Doc->ExportCaption($this->f20170917);
					if ($this->f20170918->Exportable) $Doc->ExportCaption($this->f20170918);
					if ($this->f20170919->Exportable) $Doc->ExportCaption($this->f20170919);
					if ($this->f20170920->Exportable) $Doc->ExportCaption($this->f20170920);
					if ($this->f20170921->Exportable) $Doc->ExportCaption($this->f20170921);
					if ($this->f20170922->Exportable) $Doc->ExportCaption($this->f20170922);
					if ($this->f20170923->Exportable) $Doc->ExportCaption($this->f20170923);
					if ($this->f20170924->Exportable) $Doc->ExportCaption($this->f20170924);
					if ($this->f20170925->Exportable) $Doc->ExportCaption($this->f20170925);
					if ($this->f20170926->Exportable) $Doc->ExportCaption($this->f20170926);
					if ($this->f20170927->Exportable) $Doc->ExportCaption($this->f20170927);
					if ($this->f20170928->Exportable) $Doc->ExportCaption($this->f20170928);
					if ($this->f20170929->Exportable) $Doc->ExportCaption($this->f20170929);
					if ($this->f20170930->Exportable) $Doc->ExportCaption($this->f20170930);
					if ($this->f20171001->Exportable) $Doc->ExportCaption($this->f20171001);
					if ($this->f20171002->Exportable) $Doc->ExportCaption($this->f20171002);
					if ($this->f20171003->Exportable) $Doc->ExportCaption($this->f20171003);
					if ($this->f20171004->Exportable) $Doc->ExportCaption($this->f20171004);
					if ($this->f20171005->Exportable) $Doc->ExportCaption($this->f20171005);
					if ($this->f20171006->Exportable) $Doc->ExportCaption($this->f20171006);
					if ($this->f20171007->Exportable) $Doc->ExportCaption($this->f20171007);
					if ($this->f20171008->Exportable) $Doc->ExportCaption($this->f20171008);
					if ($this->f20171009->Exportable) $Doc->ExportCaption($this->f20171009);
					if ($this->f20171010->Exportable) $Doc->ExportCaption($this->f20171010);
					if ($this->f20171011->Exportable) $Doc->ExportCaption($this->f20171011);
					if ($this->f20171012->Exportable) $Doc->ExportCaption($this->f20171012);
					if ($this->f20171013->Exportable) $Doc->ExportCaption($this->f20171013);
					if ($this->f20171014->Exportable) $Doc->ExportCaption($this->f20171014);
					if ($this->f20171015->Exportable) $Doc->ExportCaption($this->f20171015);
					if ($this->f20171016->Exportable) $Doc->ExportCaption($this->f20171016);
					if ($this->f20171017->Exportable) $Doc->ExportCaption($this->f20171017);
					if ($this->f20171018->Exportable) $Doc->ExportCaption($this->f20171018);
					if ($this->f20171019->Exportable) $Doc->ExportCaption($this->f20171019);
					if ($this->f20171020->Exportable) $Doc->ExportCaption($this->f20171020);
					if ($this->f20171021->Exportable) $Doc->ExportCaption($this->f20171021);
					if ($this->f20171022->Exportable) $Doc->ExportCaption($this->f20171022);
					if ($this->f20171023->Exportable) $Doc->ExportCaption($this->f20171023);
					if ($this->f20171024->Exportable) $Doc->ExportCaption($this->f20171024);
					if ($this->f20171025->Exportable) $Doc->ExportCaption($this->f20171025);
					if ($this->f20171026->Exportable) $Doc->ExportCaption($this->f20171026);
					if ($this->f20171027->Exportable) $Doc->ExportCaption($this->f20171027);
					if ($this->f20171028->Exportable) $Doc->ExportCaption($this->f20171028);
					if ($this->f20171029->Exportable) $Doc->ExportCaption($this->f20171029);
					if ($this->f20171030->Exportable) $Doc->ExportCaption($this->f20171030);
					if ($this->f20171031->Exportable) $Doc->ExportCaption($this->f20171031);
					if ($this->f20171101->Exportable) $Doc->ExportCaption($this->f20171101);
					if ($this->f20171102->Exportable) $Doc->ExportCaption($this->f20171102);
					if ($this->f20171103->Exportable) $Doc->ExportCaption($this->f20171103);
					if ($this->f20171104->Exportable) $Doc->ExportCaption($this->f20171104);
					if ($this->f20171105->Exportable) $Doc->ExportCaption($this->f20171105);
					if ($this->f20171106->Exportable) $Doc->ExportCaption($this->f20171106);
					if ($this->f20171107->Exportable) $Doc->ExportCaption($this->f20171107);
					if ($this->f20171108->Exportable) $Doc->ExportCaption($this->f20171108);
					if ($this->f20171109->Exportable) $Doc->ExportCaption($this->f20171109);
					if ($this->f20171110->Exportable) $Doc->ExportCaption($this->f20171110);
					if ($this->f20171111->Exportable) $Doc->ExportCaption($this->f20171111);
					if ($this->f20171112->Exportable) $Doc->ExportCaption($this->f20171112);
					if ($this->f20171113->Exportable) $Doc->ExportCaption($this->f20171113);
					if ($this->f20171114->Exportable) $Doc->ExportCaption($this->f20171114);
					if ($this->f20171115->Exportable) $Doc->ExportCaption($this->f20171115);
					if ($this->f20171116->Exportable) $Doc->ExportCaption($this->f20171116);
					if ($this->f20171117->Exportable) $Doc->ExportCaption($this->f20171117);
					if ($this->f20171118->Exportable) $Doc->ExportCaption($this->f20171118);
					if ($this->f20171119->Exportable) $Doc->ExportCaption($this->f20171119);
					if ($this->f20171120->Exportable) $Doc->ExportCaption($this->f20171120);
					if ($this->f20171121->Exportable) $Doc->ExportCaption($this->f20171121);
					if ($this->f20171122->Exportable) $Doc->ExportCaption($this->f20171122);
					if ($this->f20171123->Exportable) $Doc->ExportCaption($this->f20171123);
					if ($this->f20171124->Exportable) $Doc->ExportCaption($this->f20171124);
					if ($this->f20171125->Exportable) $Doc->ExportCaption($this->f20171125);
					if ($this->f20171126->Exportable) $Doc->ExportCaption($this->f20171126);
					if ($this->f20171127->Exportable) $Doc->ExportCaption($this->f20171127);
					if ($this->f20171128->Exportable) $Doc->ExportCaption($this->f20171128);
					if ($this->f20171129->Exportable) $Doc->ExportCaption($this->f20171129);
					if ($this->f20171130->Exportable) $Doc->ExportCaption($this->f20171130);
					if ($this->f20171201->Exportable) $Doc->ExportCaption($this->f20171201);
					if ($this->f20171202->Exportable) $Doc->ExportCaption($this->f20171202);
					if ($this->f20171203->Exportable) $Doc->ExportCaption($this->f20171203);
					if ($this->f20171204->Exportable) $Doc->ExportCaption($this->f20171204);
					if ($this->f20171205->Exportable) $Doc->ExportCaption($this->f20171205);
					if ($this->f20171206->Exportable) $Doc->ExportCaption($this->f20171206);
					if ($this->f20171207->Exportable) $Doc->ExportCaption($this->f20171207);
					if ($this->f20171208->Exportable) $Doc->ExportCaption($this->f20171208);
					if ($this->f20171209->Exportable) $Doc->ExportCaption($this->f20171209);
					if ($this->f20171210->Exportable) $Doc->ExportCaption($this->f20171210);
					if ($this->f20171211->Exportable) $Doc->ExportCaption($this->f20171211);
					if ($this->f20171212->Exportable) $Doc->ExportCaption($this->f20171212);
					if ($this->f20171213->Exportable) $Doc->ExportCaption($this->f20171213);
					if ($this->f20171214->Exportable) $Doc->ExportCaption($this->f20171214);
					if ($this->f20171215->Exportable) $Doc->ExportCaption($this->f20171215);
					if ($this->f20171216->Exportable) $Doc->ExportCaption($this->f20171216);
					if ($this->f20171217->Exportable) $Doc->ExportCaption($this->f20171217);
					if ($this->f20171218->Exportable) $Doc->ExportCaption($this->f20171218);
					if ($this->f20171219->Exportable) $Doc->ExportCaption($this->f20171219);
					if ($this->f20171220->Exportable) $Doc->ExportCaption($this->f20171220);
					if ($this->f20171221->Exportable) $Doc->ExportCaption($this->f20171221);
					if ($this->f20171222->Exportable) $Doc->ExportCaption($this->f20171222);
					if ($this->f20171223->Exportable) $Doc->ExportCaption($this->f20171223);
					if ($this->f20171224->Exportable) $Doc->ExportCaption($this->f20171224);
					if ($this->f20171225->Exportable) $Doc->ExportCaption($this->f20171225);
					if ($this->f20171226->Exportable) $Doc->ExportCaption($this->f20171226);
					if ($this->f20171227->Exportable) $Doc->ExportCaption($this->f20171227);
					if ($this->f20171228->Exportable) $Doc->ExportCaption($this->f20171228);
					if ($this->f20171229->Exportable) $Doc->ExportCaption($this->f20171229);
					if ($this->f20171230->Exportable) $Doc->ExportCaption($this->f20171230);
					if ($this->f20171231->Exportable) $Doc->ExportCaption($this->f20171231);
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
						if ($this->jdwkrjpeg_id->Exportable) $Doc->ExportField($this->jdwkrjpeg_id);
						if ($this->pegawai_id->Exportable) $Doc->ExportField($this->pegawai_id);
						if ($this->f20170101->Exportable) $Doc->ExportField($this->f20170101);
						if ($this->f20170102->Exportable) $Doc->ExportField($this->f20170102);
						if ($this->f20170103->Exportable) $Doc->ExportField($this->f20170103);
						if ($this->f20170104->Exportable) $Doc->ExportField($this->f20170104);
						if ($this->f20170105->Exportable) $Doc->ExportField($this->f20170105);
						if ($this->f20170106->Exportable) $Doc->ExportField($this->f20170106);
						if ($this->f20170107->Exportable) $Doc->ExportField($this->f20170107);
						if ($this->f20170108->Exportable) $Doc->ExportField($this->f20170108);
						if ($this->f20170109->Exportable) $Doc->ExportField($this->f20170109);
						if ($this->f20170110->Exportable) $Doc->ExportField($this->f20170110);
						if ($this->f20170111->Exportable) $Doc->ExportField($this->f20170111);
						if ($this->f20170112->Exportable) $Doc->ExportField($this->f20170112);
						if ($this->f20170113->Exportable) $Doc->ExportField($this->f20170113);
						if ($this->f20170114->Exportable) $Doc->ExportField($this->f20170114);
						if ($this->f20170115->Exportable) $Doc->ExportField($this->f20170115);
						if ($this->f20170116->Exportable) $Doc->ExportField($this->f20170116);
						if ($this->f20170117->Exportable) $Doc->ExportField($this->f20170117);
						if ($this->f20170118->Exportable) $Doc->ExportField($this->f20170118);
						if ($this->f20170119->Exportable) $Doc->ExportField($this->f20170119);
						if ($this->f20170120->Exportable) $Doc->ExportField($this->f20170120);
						if ($this->f20170121->Exportable) $Doc->ExportField($this->f20170121);
						if ($this->f20170122->Exportable) $Doc->ExportField($this->f20170122);
						if ($this->f20170123->Exportable) $Doc->ExportField($this->f20170123);
						if ($this->f20170124->Exportable) $Doc->ExportField($this->f20170124);
						if ($this->f20170125->Exportable) $Doc->ExportField($this->f20170125);
						if ($this->f20170126->Exportable) $Doc->ExportField($this->f20170126);
						if ($this->f20170127->Exportable) $Doc->ExportField($this->f20170127);
						if ($this->f20170128->Exportable) $Doc->ExportField($this->f20170128);
						if ($this->f20170129->Exportable) $Doc->ExportField($this->f20170129);
						if ($this->f20170130->Exportable) $Doc->ExportField($this->f20170130);
						if ($this->f20170131->Exportable) $Doc->ExportField($this->f20170131);
						if ($this->f20170201->Exportable) $Doc->ExportField($this->f20170201);
						if ($this->f20170202->Exportable) $Doc->ExportField($this->f20170202);
						if ($this->f20170203->Exportable) $Doc->ExportField($this->f20170203);
						if ($this->f20170204->Exportable) $Doc->ExportField($this->f20170204);
						if ($this->f20170205->Exportable) $Doc->ExportField($this->f20170205);
						if ($this->f20170206->Exportable) $Doc->ExportField($this->f20170206);
						if ($this->f20170207->Exportable) $Doc->ExportField($this->f20170207);
						if ($this->f20170208->Exportable) $Doc->ExportField($this->f20170208);
						if ($this->f20170209->Exportable) $Doc->ExportField($this->f20170209);
						if ($this->f20170210->Exportable) $Doc->ExportField($this->f20170210);
						if ($this->f20170211->Exportable) $Doc->ExportField($this->f20170211);
						if ($this->f20170212->Exportable) $Doc->ExportField($this->f20170212);
						if ($this->f20170213->Exportable) $Doc->ExportField($this->f20170213);
						if ($this->f20170214->Exportable) $Doc->ExportField($this->f20170214);
						if ($this->f20170215->Exportable) $Doc->ExportField($this->f20170215);
						if ($this->f20170216->Exportable) $Doc->ExportField($this->f20170216);
						if ($this->f20170217->Exportable) $Doc->ExportField($this->f20170217);
						if ($this->f20170218->Exportable) $Doc->ExportField($this->f20170218);
						if ($this->f20170219->Exportable) $Doc->ExportField($this->f20170219);
						if ($this->f20170220->Exportable) $Doc->ExportField($this->f20170220);
						if ($this->f20170221->Exportable) $Doc->ExportField($this->f20170221);
						if ($this->f20170222->Exportable) $Doc->ExportField($this->f20170222);
						if ($this->f20170223->Exportable) $Doc->ExportField($this->f20170223);
						if ($this->f20170224->Exportable) $Doc->ExportField($this->f20170224);
						if ($this->f20170225->Exportable) $Doc->ExportField($this->f20170225);
						if ($this->f20170226->Exportable) $Doc->ExportField($this->f20170226);
						if ($this->f20170227->Exportable) $Doc->ExportField($this->f20170227);
						if ($this->f20170228->Exportable) $Doc->ExportField($this->f20170228);
						if ($this->f20170229->Exportable) $Doc->ExportField($this->f20170229);
						if ($this->f20170301->Exportable) $Doc->ExportField($this->f20170301);
						if ($this->f20170302->Exportable) $Doc->ExportField($this->f20170302);
						if ($this->f20170303->Exportable) $Doc->ExportField($this->f20170303);
						if ($this->f20170304->Exportable) $Doc->ExportField($this->f20170304);
						if ($this->f20170305->Exportable) $Doc->ExportField($this->f20170305);
						if ($this->f20170306->Exportable) $Doc->ExportField($this->f20170306);
						if ($this->f20170307->Exportable) $Doc->ExportField($this->f20170307);
						if ($this->f20170308->Exportable) $Doc->ExportField($this->f20170308);
						if ($this->f20170309->Exportable) $Doc->ExportField($this->f20170309);
						if ($this->f20170310->Exportable) $Doc->ExportField($this->f20170310);
						if ($this->f20170311->Exportable) $Doc->ExportField($this->f20170311);
						if ($this->f20170312->Exportable) $Doc->ExportField($this->f20170312);
						if ($this->f20170313->Exportable) $Doc->ExportField($this->f20170313);
						if ($this->f20170314->Exportable) $Doc->ExportField($this->f20170314);
						if ($this->f20170315->Exportable) $Doc->ExportField($this->f20170315);
						if ($this->f20170316->Exportable) $Doc->ExportField($this->f20170316);
						if ($this->f20170317->Exportable) $Doc->ExportField($this->f20170317);
						if ($this->f20170318->Exportable) $Doc->ExportField($this->f20170318);
						if ($this->f20170319->Exportable) $Doc->ExportField($this->f20170319);
						if ($this->f20170320->Exportable) $Doc->ExportField($this->f20170320);
						if ($this->f20170321->Exportable) $Doc->ExportField($this->f20170321);
						if ($this->f20170322->Exportable) $Doc->ExportField($this->f20170322);
						if ($this->f20170323->Exportable) $Doc->ExportField($this->f20170323);
						if ($this->f20170324->Exportable) $Doc->ExportField($this->f20170324);
						if ($this->f20170325->Exportable) $Doc->ExportField($this->f20170325);
						if ($this->f20170326->Exportable) $Doc->ExportField($this->f20170326);
						if ($this->f20170327->Exportable) $Doc->ExportField($this->f20170327);
						if ($this->f20170328->Exportable) $Doc->ExportField($this->f20170328);
						if ($this->f20170329->Exportable) $Doc->ExportField($this->f20170329);
						if ($this->f20170330->Exportable) $Doc->ExportField($this->f20170330);
						if ($this->f20170331->Exportable) $Doc->ExportField($this->f20170331);
						if ($this->f20170401->Exportable) $Doc->ExportField($this->f20170401);
						if ($this->f20170402->Exportable) $Doc->ExportField($this->f20170402);
						if ($this->f20170403->Exportable) $Doc->ExportField($this->f20170403);
						if ($this->f20170404->Exportable) $Doc->ExportField($this->f20170404);
						if ($this->f20170405->Exportable) $Doc->ExportField($this->f20170405);
						if ($this->f20170406->Exportable) $Doc->ExportField($this->f20170406);
						if ($this->f20170407->Exportable) $Doc->ExportField($this->f20170407);
						if ($this->f20170408->Exportable) $Doc->ExportField($this->f20170408);
						if ($this->f20170409->Exportable) $Doc->ExportField($this->f20170409);
						if ($this->f20170410->Exportable) $Doc->ExportField($this->f20170410);
						if ($this->f20170411->Exportable) $Doc->ExportField($this->f20170411);
						if ($this->f20170412->Exportable) $Doc->ExportField($this->f20170412);
						if ($this->f20170413->Exportable) $Doc->ExportField($this->f20170413);
						if ($this->f20170414->Exportable) $Doc->ExportField($this->f20170414);
						if ($this->f20170415->Exportable) $Doc->ExportField($this->f20170415);
						if ($this->f20170416->Exportable) $Doc->ExportField($this->f20170416);
						if ($this->f20170417->Exportable) $Doc->ExportField($this->f20170417);
						if ($this->f20170418->Exportable) $Doc->ExportField($this->f20170418);
						if ($this->f20170419->Exportable) $Doc->ExportField($this->f20170419);
						if ($this->f20170420->Exportable) $Doc->ExportField($this->f20170420);
						if ($this->f20170421->Exportable) $Doc->ExportField($this->f20170421);
						if ($this->f20170422->Exportable) $Doc->ExportField($this->f20170422);
						if ($this->f20170423->Exportable) $Doc->ExportField($this->f20170423);
						if ($this->f20170424->Exportable) $Doc->ExportField($this->f20170424);
						if ($this->f20170425->Exportable) $Doc->ExportField($this->f20170425);
						if ($this->f20170426->Exportable) $Doc->ExportField($this->f20170426);
						if ($this->f20170427->Exportable) $Doc->ExportField($this->f20170427);
						if ($this->f20170428->Exportable) $Doc->ExportField($this->f20170428);
						if ($this->f20170429->Exportable) $Doc->ExportField($this->f20170429);
						if ($this->f20170430->Exportable) $Doc->ExportField($this->f20170430);
						if ($this->f20170501->Exportable) $Doc->ExportField($this->f20170501);
						if ($this->f20170502->Exportable) $Doc->ExportField($this->f20170502);
						if ($this->f20170503->Exportable) $Doc->ExportField($this->f20170503);
						if ($this->f20170504->Exportable) $Doc->ExportField($this->f20170504);
						if ($this->f20170505->Exportable) $Doc->ExportField($this->f20170505);
						if ($this->f20170506->Exportable) $Doc->ExportField($this->f20170506);
						if ($this->f20170507->Exportable) $Doc->ExportField($this->f20170507);
						if ($this->f20170508->Exportable) $Doc->ExportField($this->f20170508);
						if ($this->f20170509->Exportable) $Doc->ExportField($this->f20170509);
						if ($this->f20170510->Exportable) $Doc->ExportField($this->f20170510);
						if ($this->f20170511->Exportable) $Doc->ExportField($this->f20170511);
						if ($this->f20170512->Exportable) $Doc->ExportField($this->f20170512);
						if ($this->f20170513->Exportable) $Doc->ExportField($this->f20170513);
						if ($this->f20170514->Exportable) $Doc->ExportField($this->f20170514);
						if ($this->f20170515->Exportable) $Doc->ExportField($this->f20170515);
						if ($this->f20170516->Exportable) $Doc->ExportField($this->f20170516);
						if ($this->f20170517->Exportable) $Doc->ExportField($this->f20170517);
						if ($this->f20170518->Exportable) $Doc->ExportField($this->f20170518);
						if ($this->f20170519->Exportable) $Doc->ExportField($this->f20170519);
						if ($this->f20170520->Exportable) $Doc->ExportField($this->f20170520);
						if ($this->f20170521->Exportable) $Doc->ExportField($this->f20170521);
						if ($this->f20170522->Exportable) $Doc->ExportField($this->f20170522);
						if ($this->f20170523->Exportable) $Doc->ExportField($this->f20170523);
						if ($this->f20170524->Exportable) $Doc->ExportField($this->f20170524);
						if ($this->f20170525->Exportable) $Doc->ExportField($this->f20170525);
						if ($this->f20170526->Exportable) $Doc->ExportField($this->f20170526);
						if ($this->f20170527->Exportable) $Doc->ExportField($this->f20170527);
						if ($this->f20170528->Exportable) $Doc->ExportField($this->f20170528);
						if ($this->f20170529->Exportable) $Doc->ExportField($this->f20170529);
						if ($this->f20170530->Exportable) $Doc->ExportField($this->f20170530);
						if ($this->f20170531->Exportable) $Doc->ExportField($this->f20170531);
						if ($this->f20170601->Exportable) $Doc->ExportField($this->f20170601);
						if ($this->f20170602->Exportable) $Doc->ExportField($this->f20170602);
						if ($this->f20170603->Exportable) $Doc->ExportField($this->f20170603);
						if ($this->f20170604->Exportable) $Doc->ExportField($this->f20170604);
						if ($this->f20170605->Exportable) $Doc->ExportField($this->f20170605);
						if ($this->f20170606->Exportable) $Doc->ExportField($this->f20170606);
						if ($this->f20170607->Exportable) $Doc->ExportField($this->f20170607);
						if ($this->f20170608->Exportable) $Doc->ExportField($this->f20170608);
						if ($this->f20170609->Exportable) $Doc->ExportField($this->f20170609);
						if ($this->f20170610->Exportable) $Doc->ExportField($this->f20170610);
						if ($this->f20170611->Exportable) $Doc->ExportField($this->f20170611);
						if ($this->f20170612->Exportable) $Doc->ExportField($this->f20170612);
						if ($this->f20170613->Exportable) $Doc->ExportField($this->f20170613);
						if ($this->f20170614->Exportable) $Doc->ExportField($this->f20170614);
						if ($this->f20170615->Exportable) $Doc->ExportField($this->f20170615);
						if ($this->f20170616->Exportable) $Doc->ExportField($this->f20170616);
						if ($this->f20170617->Exportable) $Doc->ExportField($this->f20170617);
						if ($this->f20170618->Exportable) $Doc->ExportField($this->f20170618);
						if ($this->f20170619->Exportable) $Doc->ExportField($this->f20170619);
						if ($this->f20170620->Exportable) $Doc->ExportField($this->f20170620);
						if ($this->f20170621->Exportable) $Doc->ExportField($this->f20170621);
						if ($this->f20170622->Exportable) $Doc->ExportField($this->f20170622);
						if ($this->f20170623->Exportable) $Doc->ExportField($this->f20170623);
						if ($this->f20170624->Exportable) $Doc->ExportField($this->f20170624);
						if ($this->f20170625->Exportable) $Doc->ExportField($this->f20170625);
						if ($this->f20170626->Exportable) $Doc->ExportField($this->f20170626);
						if ($this->f20170627->Exportable) $Doc->ExportField($this->f20170627);
						if ($this->f20170628->Exportable) $Doc->ExportField($this->f20170628);
						if ($this->f20170629->Exportable) $Doc->ExportField($this->f20170629);
						if ($this->f20170630->Exportable) $Doc->ExportField($this->f20170630);
						if ($this->f20170701->Exportable) $Doc->ExportField($this->f20170701);
						if ($this->f20170702->Exportable) $Doc->ExportField($this->f20170702);
						if ($this->f20170703->Exportable) $Doc->ExportField($this->f20170703);
						if ($this->f20170704->Exportable) $Doc->ExportField($this->f20170704);
						if ($this->f20170705->Exportable) $Doc->ExportField($this->f20170705);
						if ($this->f20170706->Exportable) $Doc->ExportField($this->f20170706);
						if ($this->f20170707->Exportable) $Doc->ExportField($this->f20170707);
						if ($this->f20170708->Exportable) $Doc->ExportField($this->f20170708);
						if ($this->f20170709->Exportable) $Doc->ExportField($this->f20170709);
						if ($this->f20170710->Exportable) $Doc->ExportField($this->f20170710);
						if ($this->f20170711->Exportable) $Doc->ExportField($this->f20170711);
						if ($this->f20170712->Exportable) $Doc->ExportField($this->f20170712);
						if ($this->f20170713->Exportable) $Doc->ExportField($this->f20170713);
						if ($this->f20170714->Exportable) $Doc->ExportField($this->f20170714);
						if ($this->f20170715->Exportable) $Doc->ExportField($this->f20170715);
						if ($this->f20170716->Exportable) $Doc->ExportField($this->f20170716);
						if ($this->f20170717->Exportable) $Doc->ExportField($this->f20170717);
						if ($this->f20170718->Exportable) $Doc->ExportField($this->f20170718);
						if ($this->f20170719->Exportable) $Doc->ExportField($this->f20170719);
						if ($this->f20170720->Exportable) $Doc->ExportField($this->f20170720);
						if ($this->f20170721->Exportable) $Doc->ExportField($this->f20170721);
						if ($this->f20170722->Exportable) $Doc->ExportField($this->f20170722);
						if ($this->f20170723->Exportable) $Doc->ExportField($this->f20170723);
						if ($this->f20170724->Exportable) $Doc->ExportField($this->f20170724);
						if ($this->f20170725->Exportable) $Doc->ExportField($this->f20170725);
						if ($this->f20170726->Exportable) $Doc->ExportField($this->f20170726);
						if ($this->f20170727->Exportable) $Doc->ExportField($this->f20170727);
						if ($this->f20170728->Exportable) $Doc->ExportField($this->f20170728);
						if ($this->f20170729->Exportable) $Doc->ExportField($this->f20170729);
						if ($this->f20170730->Exportable) $Doc->ExportField($this->f20170730);
						if ($this->f20170731->Exportable) $Doc->ExportField($this->f20170731);
						if ($this->f20170801->Exportable) $Doc->ExportField($this->f20170801);
						if ($this->f20170802->Exportable) $Doc->ExportField($this->f20170802);
						if ($this->f20170803->Exportable) $Doc->ExportField($this->f20170803);
						if ($this->f20170804->Exportable) $Doc->ExportField($this->f20170804);
						if ($this->f20170805->Exportable) $Doc->ExportField($this->f20170805);
						if ($this->f20170806->Exportable) $Doc->ExportField($this->f20170806);
						if ($this->f20170807->Exportable) $Doc->ExportField($this->f20170807);
						if ($this->f20170808->Exportable) $Doc->ExportField($this->f20170808);
						if ($this->f20170809->Exportable) $Doc->ExportField($this->f20170809);
						if ($this->f20170810->Exportable) $Doc->ExportField($this->f20170810);
						if ($this->f20170811->Exportable) $Doc->ExportField($this->f20170811);
						if ($this->f20170812->Exportable) $Doc->ExportField($this->f20170812);
						if ($this->f20170813->Exportable) $Doc->ExportField($this->f20170813);
						if ($this->f20170814->Exportable) $Doc->ExportField($this->f20170814);
						if ($this->f20170815->Exportable) $Doc->ExportField($this->f20170815);
						if ($this->f20170816->Exportable) $Doc->ExportField($this->f20170816);
						if ($this->f20170817->Exportable) $Doc->ExportField($this->f20170817);
						if ($this->f20170818->Exportable) $Doc->ExportField($this->f20170818);
						if ($this->f20170819->Exportable) $Doc->ExportField($this->f20170819);
						if ($this->f20170820->Exportable) $Doc->ExportField($this->f20170820);
						if ($this->f20170821->Exportable) $Doc->ExportField($this->f20170821);
						if ($this->f20170822->Exportable) $Doc->ExportField($this->f20170822);
						if ($this->f20170823->Exportable) $Doc->ExportField($this->f20170823);
						if ($this->f20170824->Exportable) $Doc->ExportField($this->f20170824);
						if ($this->f20170825->Exportable) $Doc->ExportField($this->f20170825);
						if ($this->f20170826->Exportable) $Doc->ExportField($this->f20170826);
						if ($this->f20170827->Exportable) $Doc->ExportField($this->f20170827);
						if ($this->f20170828->Exportable) $Doc->ExportField($this->f20170828);
						if ($this->f20170829->Exportable) $Doc->ExportField($this->f20170829);
						if ($this->f20170830->Exportable) $Doc->ExportField($this->f20170830);
						if ($this->f20170831->Exportable) $Doc->ExportField($this->f20170831);
						if ($this->f20170901->Exportable) $Doc->ExportField($this->f20170901);
						if ($this->f20170902->Exportable) $Doc->ExportField($this->f20170902);
						if ($this->f20170903->Exportable) $Doc->ExportField($this->f20170903);
						if ($this->f20170904->Exportable) $Doc->ExportField($this->f20170904);
						if ($this->f20170905->Exportable) $Doc->ExportField($this->f20170905);
						if ($this->f20170906->Exportable) $Doc->ExportField($this->f20170906);
						if ($this->f20170907->Exportable) $Doc->ExportField($this->f20170907);
						if ($this->f20170908->Exportable) $Doc->ExportField($this->f20170908);
						if ($this->f20170909->Exportable) $Doc->ExportField($this->f20170909);
						if ($this->f20170910->Exportable) $Doc->ExportField($this->f20170910);
						if ($this->f20170911->Exportable) $Doc->ExportField($this->f20170911);
						if ($this->f20170912->Exportable) $Doc->ExportField($this->f20170912);
						if ($this->f20170913->Exportable) $Doc->ExportField($this->f20170913);
						if ($this->f20170914->Exportable) $Doc->ExportField($this->f20170914);
						if ($this->f20170915->Exportable) $Doc->ExportField($this->f20170915);
						if ($this->f20170916->Exportable) $Doc->ExportField($this->f20170916);
						if ($this->f20170917->Exportable) $Doc->ExportField($this->f20170917);
						if ($this->f20170918->Exportable) $Doc->ExportField($this->f20170918);
						if ($this->f20170919->Exportable) $Doc->ExportField($this->f20170919);
						if ($this->f20170920->Exportable) $Doc->ExportField($this->f20170920);
						if ($this->f20170921->Exportable) $Doc->ExportField($this->f20170921);
						if ($this->f20170922->Exportable) $Doc->ExportField($this->f20170922);
						if ($this->f20170923->Exportable) $Doc->ExportField($this->f20170923);
						if ($this->f20170924->Exportable) $Doc->ExportField($this->f20170924);
						if ($this->f20170925->Exportable) $Doc->ExportField($this->f20170925);
						if ($this->f20170926->Exportable) $Doc->ExportField($this->f20170926);
						if ($this->f20170927->Exportable) $Doc->ExportField($this->f20170927);
						if ($this->f20170928->Exportable) $Doc->ExportField($this->f20170928);
						if ($this->f20170929->Exportable) $Doc->ExportField($this->f20170929);
						if ($this->f20170930->Exportable) $Doc->ExportField($this->f20170930);
						if ($this->f20171001->Exportable) $Doc->ExportField($this->f20171001);
						if ($this->f20171002->Exportable) $Doc->ExportField($this->f20171002);
						if ($this->f20171003->Exportable) $Doc->ExportField($this->f20171003);
						if ($this->f20171004->Exportable) $Doc->ExportField($this->f20171004);
						if ($this->f20171005->Exportable) $Doc->ExportField($this->f20171005);
						if ($this->f20171006->Exportable) $Doc->ExportField($this->f20171006);
						if ($this->f20171007->Exportable) $Doc->ExportField($this->f20171007);
						if ($this->f20171008->Exportable) $Doc->ExportField($this->f20171008);
						if ($this->f20171009->Exportable) $Doc->ExportField($this->f20171009);
						if ($this->f20171010->Exportable) $Doc->ExportField($this->f20171010);
						if ($this->f20171011->Exportable) $Doc->ExportField($this->f20171011);
						if ($this->f20171012->Exportable) $Doc->ExportField($this->f20171012);
						if ($this->f20171013->Exportable) $Doc->ExportField($this->f20171013);
						if ($this->f20171014->Exportable) $Doc->ExportField($this->f20171014);
						if ($this->f20171015->Exportable) $Doc->ExportField($this->f20171015);
						if ($this->f20171016->Exportable) $Doc->ExportField($this->f20171016);
						if ($this->f20171017->Exportable) $Doc->ExportField($this->f20171017);
						if ($this->f20171018->Exportable) $Doc->ExportField($this->f20171018);
						if ($this->f20171019->Exportable) $Doc->ExportField($this->f20171019);
						if ($this->f20171020->Exportable) $Doc->ExportField($this->f20171020);
						if ($this->f20171021->Exportable) $Doc->ExportField($this->f20171021);
						if ($this->f20171022->Exportable) $Doc->ExportField($this->f20171022);
						if ($this->f20171023->Exportable) $Doc->ExportField($this->f20171023);
						if ($this->f20171024->Exportable) $Doc->ExportField($this->f20171024);
						if ($this->f20171025->Exportable) $Doc->ExportField($this->f20171025);
						if ($this->f20171026->Exportable) $Doc->ExportField($this->f20171026);
						if ($this->f20171027->Exportable) $Doc->ExportField($this->f20171027);
						if ($this->f20171028->Exportable) $Doc->ExportField($this->f20171028);
						if ($this->f20171029->Exportable) $Doc->ExportField($this->f20171029);
						if ($this->f20171030->Exportable) $Doc->ExportField($this->f20171030);
						if ($this->f20171031->Exportable) $Doc->ExportField($this->f20171031);
						if ($this->f20171101->Exportable) $Doc->ExportField($this->f20171101);
						if ($this->f20171102->Exportable) $Doc->ExportField($this->f20171102);
						if ($this->f20171103->Exportable) $Doc->ExportField($this->f20171103);
						if ($this->f20171104->Exportable) $Doc->ExportField($this->f20171104);
						if ($this->f20171105->Exportable) $Doc->ExportField($this->f20171105);
						if ($this->f20171106->Exportable) $Doc->ExportField($this->f20171106);
						if ($this->f20171107->Exportable) $Doc->ExportField($this->f20171107);
						if ($this->f20171108->Exportable) $Doc->ExportField($this->f20171108);
						if ($this->f20171109->Exportable) $Doc->ExportField($this->f20171109);
						if ($this->f20171110->Exportable) $Doc->ExportField($this->f20171110);
						if ($this->f20171111->Exportable) $Doc->ExportField($this->f20171111);
						if ($this->f20171112->Exportable) $Doc->ExportField($this->f20171112);
						if ($this->f20171113->Exportable) $Doc->ExportField($this->f20171113);
						if ($this->f20171114->Exportable) $Doc->ExportField($this->f20171114);
						if ($this->f20171115->Exportable) $Doc->ExportField($this->f20171115);
						if ($this->f20171116->Exportable) $Doc->ExportField($this->f20171116);
						if ($this->f20171117->Exportable) $Doc->ExportField($this->f20171117);
						if ($this->f20171118->Exportable) $Doc->ExportField($this->f20171118);
						if ($this->f20171119->Exportable) $Doc->ExportField($this->f20171119);
						if ($this->f20171120->Exportable) $Doc->ExportField($this->f20171120);
						if ($this->f20171121->Exportable) $Doc->ExportField($this->f20171121);
						if ($this->f20171122->Exportable) $Doc->ExportField($this->f20171122);
						if ($this->f20171123->Exportable) $Doc->ExportField($this->f20171123);
						if ($this->f20171124->Exportable) $Doc->ExportField($this->f20171124);
						if ($this->f20171125->Exportable) $Doc->ExportField($this->f20171125);
						if ($this->f20171126->Exportable) $Doc->ExportField($this->f20171126);
						if ($this->f20171127->Exportable) $Doc->ExportField($this->f20171127);
						if ($this->f20171128->Exportable) $Doc->ExportField($this->f20171128);
						if ($this->f20171129->Exportable) $Doc->ExportField($this->f20171129);
						if ($this->f20171130->Exportable) $Doc->ExportField($this->f20171130);
						if ($this->f20171201->Exportable) $Doc->ExportField($this->f20171201);
						if ($this->f20171202->Exportable) $Doc->ExportField($this->f20171202);
						if ($this->f20171203->Exportable) $Doc->ExportField($this->f20171203);
						if ($this->f20171204->Exportable) $Doc->ExportField($this->f20171204);
						if ($this->f20171205->Exportable) $Doc->ExportField($this->f20171205);
						if ($this->f20171206->Exportable) $Doc->ExportField($this->f20171206);
						if ($this->f20171207->Exportable) $Doc->ExportField($this->f20171207);
						if ($this->f20171208->Exportable) $Doc->ExportField($this->f20171208);
						if ($this->f20171209->Exportable) $Doc->ExportField($this->f20171209);
						if ($this->f20171210->Exportable) $Doc->ExportField($this->f20171210);
						if ($this->f20171211->Exportable) $Doc->ExportField($this->f20171211);
						if ($this->f20171212->Exportable) $Doc->ExportField($this->f20171212);
						if ($this->f20171213->Exportable) $Doc->ExportField($this->f20171213);
						if ($this->f20171214->Exportable) $Doc->ExportField($this->f20171214);
						if ($this->f20171215->Exportable) $Doc->ExportField($this->f20171215);
						if ($this->f20171216->Exportable) $Doc->ExportField($this->f20171216);
						if ($this->f20171217->Exportable) $Doc->ExportField($this->f20171217);
						if ($this->f20171218->Exportable) $Doc->ExportField($this->f20171218);
						if ($this->f20171219->Exportable) $Doc->ExportField($this->f20171219);
						if ($this->f20171220->Exportable) $Doc->ExportField($this->f20171220);
						if ($this->f20171221->Exportable) $Doc->ExportField($this->f20171221);
						if ($this->f20171222->Exportable) $Doc->ExportField($this->f20171222);
						if ($this->f20171223->Exportable) $Doc->ExportField($this->f20171223);
						if ($this->f20171224->Exportable) $Doc->ExportField($this->f20171224);
						if ($this->f20171225->Exportable) $Doc->ExportField($this->f20171225);
						if ($this->f20171226->Exportable) $Doc->ExportField($this->f20171226);
						if ($this->f20171227->Exportable) $Doc->ExportField($this->f20171227);
						if ($this->f20171228->Exportable) $Doc->ExportField($this->f20171228);
						if ($this->f20171229->Exportable) $Doc->ExportField($this->f20171229);
						if ($this->f20171230->Exportable) $Doc->ExportField($this->f20171230);
						if ($this->f20171231->Exportable) $Doc->ExportField($this->f20171231);
					} else {
						if ($this->jdwkrjpeg_id->Exportable) $Doc->ExportField($this->jdwkrjpeg_id);
						if ($this->pegawai_id->Exportable) $Doc->ExportField($this->pegawai_id);
						if ($this->f20170101->Exportable) $Doc->ExportField($this->f20170101);
						if ($this->f20170102->Exportable) $Doc->ExportField($this->f20170102);
						if ($this->f20170103->Exportable) $Doc->ExportField($this->f20170103);
						if ($this->f20170104->Exportable) $Doc->ExportField($this->f20170104);
						if ($this->f20170105->Exportable) $Doc->ExportField($this->f20170105);
						if ($this->f20170106->Exportable) $Doc->ExportField($this->f20170106);
						if ($this->f20170107->Exportable) $Doc->ExportField($this->f20170107);
						if ($this->f20170108->Exportable) $Doc->ExportField($this->f20170108);
						if ($this->f20170109->Exportable) $Doc->ExportField($this->f20170109);
						if ($this->f20170110->Exportable) $Doc->ExportField($this->f20170110);
						if ($this->f20170111->Exportable) $Doc->ExportField($this->f20170111);
						if ($this->f20170112->Exportable) $Doc->ExportField($this->f20170112);
						if ($this->f20170113->Exportable) $Doc->ExportField($this->f20170113);
						if ($this->f20170114->Exportable) $Doc->ExportField($this->f20170114);
						if ($this->f20170115->Exportable) $Doc->ExportField($this->f20170115);
						if ($this->f20170116->Exportable) $Doc->ExportField($this->f20170116);
						if ($this->f20170117->Exportable) $Doc->ExportField($this->f20170117);
						if ($this->f20170118->Exportable) $Doc->ExportField($this->f20170118);
						if ($this->f20170119->Exportable) $Doc->ExportField($this->f20170119);
						if ($this->f20170120->Exportable) $Doc->ExportField($this->f20170120);
						if ($this->f20170121->Exportable) $Doc->ExportField($this->f20170121);
						if ($this->f20170122->Exportable) $Doc->ExportField($this->f20170122);
						if ($this->f20170123->Exportable) $Doc->ExportField($this->f20170123);
						if ($this->f20170124->Exportable) $Doc->ExportField($this->f20170124);
						if ($this->f20170125->Exportable) $Doc->ExportField($this->f20170125);
						if ($this->f20170126->Exportable) $Doc->ExportField($this->f20170126);
						if ($this->f20170127->Exportable) $Doc->ExportField($this->f20170127);
						if ($this->f20170128->Exportable) $Doc->ExportField($this->f20170128);
						if ($this->f20170129->Exportable) $Doc->ExportField($this->f20170129);
						if ($this->f20170130->Exportable) $Doc->ExportField($this->f20170130);
						if ($this->f20170131->Exportable) $Doc->ExportField($this->f20170131);
						if ($this->f20170201->Exportable) $Doc->ExportField($this->f20170201);
						if ($this->f20170202->Exportable) $Doc->ExportField($this->f20170202);
						if ($this->f20170203->Exportable) $Doc->ExportField($this->f20170203);
						if ($this->f20170204->Exportable) $Doc->ExportField($this->f20170204);
						if ($this->f20170205->Exportable) $Doc->ExportField($this->f20170205);
						if ($this->f20170206->Exportable) $Doc->ExportField($this->f20170206);
						if ($this->f20170207->Exportable) $Doc->ExportField($this->f20170207);
						if ($this->f20170208->Exportable) $Doc->ExportField($this->f20170208);
						if ($this->f20170209->Exportable) $Doc->ExportField($this->f20170209);
						if ($this->f20170210->Exportable) $Doc->ExportField($this->f20170210);
						if ($this->f20170211->Exportable) $Doc->ExportField($this->f20170211);
						if ($this->f20170212->Exportable) $Doc->ExportField($this->f20170212);
						if ($this->f20170213->Exportable) $Doc->ExportField($this->f20170213);
						if ($this->f20170214->Exportable) $Doc->ExportField($this->f20170214);
						if ($this->f20170215->Exportable) $Doc->ExportField($this->f20170215);
						if ($this->f20170216->Exportable) $Doc->ExportField($this->f20170216);
						if ($this->f20170217->Exportable) $Doc->ExportField($this->f20170217);
						if ($this->f20170218->Exportable) $Doc->ExportField($this->f20170218);
						if ($this->f20170219->Exportable) $Doc->ExportField($this->f20170219);
						if ($this->f20170220->Exportable) $Doc->ExportField($this->f20170220);
						if ($this->f20170221->Exportable) $Doc->ExportField($this->f20170221);
						if ($this->f20170222->Exportable) $Doc->ExportField($this->f20170222);
						if ($this->f20170223->Exportable) $Doc->ExportField($this->f20170223);
						if ($this->f20170224->Exportable) $Doc->ExportField($this->f20170224);
						if ($this->f20170225->Exportable) $Doc->ExportField($this->f20170225);
						if ($this->f20170226->Exportable) $Doc->ExportField($this->f20170226);
						if ($this->f20170227->Exportable) $Doc->ExportField($this->f20170227);
						if ($this->f20170228->Exportable) $Doc->ExportField($this->f20170228);
						if ($this->f20170229->Exportable) $Doc->ExportField($this->f20170229);
						if ($this->f20170301->Exportable) $Doc->ExportField($this->f20170301);
						if ($this->f20170302->Exportable) $Doc->ExportField($this->f20170302);
						if ($this->f20170303->Exportable) $Doc->ExportField($this->f20170303);
						if ($this->f20170304->Exportable) $Doc->ExportField($this->f20170304);
						if ($this->f20170305->Exportable) $Doc->ExportField($this->f20170305);
						if ($this->f20170306->Exportable) $Doc->ExportField($this->f20170306);
						if ($this->f20170307->Exportable) $Doc->ExportField($this->f20170307);
						if ($this->f20170308->Exportable) $Doc->ExportField($this->f20170308);
						if ($this->f20170309->Exportable) $Doc->ExportField($this->f20170309);
						if ($this->f20170310->Exportable) $Doc->ExportField($this->f20170310);
						if ($this->f20170311->Exportable) $Doc->ExportField($this->f20170311);
						if ($this->f20170312->Exportable) $Doc->ExportField($this->f20170312);
						if ($this->f20170313->Exportable) $Doc->ExportField($this->f20170313);
						if ($this->f20170314->Exportable) $Doc->ExportField($this->f20170314);
						if ($this->f20170315->Exportable) $Doc->ExportField($this->f20170315);
						if ($this->f20170316->Exportable) $Doc->ExportField($this->f20170316);
						if ($this->f20170317->Exportable) $Doc->ExportField($this->f20170317);
						if ($this->f20170318->Exportable) $Doc->ExportField($this->f20170318);
						if ($this->f20170319->Exportable) $Doc->ExportField($this->f20170319);
						if ($this->f20170320->Exportable) $Doc->ExportField($this->f20170320);
						if ($this->f20170321->Exportable) $Doc->ExportField($this->f20170321);
						if ($this->f20170322->Exportable) $Doc->ExportField($this->f20170322);
						if ($this->f20170323->Exportable) $Doc->ExportField($this->f20170323);
						if ($this->f20170324->Exportable) $Doc->ExportField($this->f20170324);
						if ($this->f20170325->Exportable) $Doc->ExportField($this->f20170325);
						if ($this->f20170326->Exportable) $Doc->ExportField($this->f20170326);
						if ($this->f20170327->Exportable) $Doc->ExportField($this->f20170327);
						if ($this->f20170328->Exportable) $Doc->ExportField($this->f20170328);
						if ($this->f20170329->Exportable) $Doc->ExportField($this->f20170329);
						if ($this->f20170330->Exportable) $Doc->ExportField($this->f20170330);
						if ($this->f20170331->Exportable) $Doc->ExportField($this->f20170331);
						if ($this->f20170401->Exportable) $Doc->ExportField($this->f20170401);
						if ($this->f20170402->Exportable) $Doc->ExportField($this->f20170402);
						if ($this->f20170403->Exportable) $Doc->ExportField($this->f20170403);
						if ($this->f20170404->Exportable) $Doc->ExportField($this->f20170404);
						if ($this->f20170405->Exportable) $Doc->ExportField($this->f20170405);
						if ($this->f20170406->Exportable) $Doc->ExportField($this->f20170406);
						if ($this->f20170407->Exportable) $Doc->ExportField($this->f20170407);
						if ($this->f20170408->Exportable) $Doc->ExportField($this->f20170408);
						if ($this->f20170409->Exportable) $Doc->ExportField($this->f20170409);
						if ($this->f20170410->Exportable) $Doc->ExportField($this->f20170410);
						if ($this->f20170411->Exportable) $Doc->ExportField($this->f20170411);
						if ($this->f20170412->Exportable) $Doc->ExportField($this->f20170412);
						if ($this->f20170413->Exportable) $Doc->ExportField($this->f20170413);
						if ($this->f20170414->Exportable) $Doc->ExportField($this->f20170414);
						if ($this->f20170415->Exportable) $Doc->ExportField($this->f20170415);
						if ($this->f20170416->Exportable) $Doc->ExportField($this->f20170416);
						if ($this->f20170417->Exportable) $Doc->ExportField($this->f20170417);
						if ($this->f20170418->Exportable) $Doc->ExportField($this->f20170418);
						if ($this->f20170419->Exportable) $Doc->ExportField($this->f20170419);
						if ($this->f20170420->Exportable) $Doc->ExportField($this->f20170420);
						if ($this->f20170421->Exportable) $Doc->ExportField($this->f20170421);
						if ($this->f20170422->Exportable) $Doc->ExportField($this->f20170422);
						if ($this->f20170423->Exportable) $Doc->ExportField($this->f20170423);
						if ($this->f20170424->Exportable) $Doc->ExportField($this->f20170424);
						if ($this->f20170425->Exportable) $Doc->ExportField($this->f20170425);
						if ($this->f20170426->Exportable) $Doc->ExportField($this->f20170426);
						if ($this->f20170427->Exportable) $Doc->ExportField($this->f20170427);
						if ($this->f20170428->Exportable) $Doc->ExportField($this->f20170428);
						if ($this->f20170429->Exportable) $Doc->ExportField($this->f20170429);
						if ($this->f20170430->Exportable) $Doc->ExportField($this->f20170430);
						if ($this->f20170501->Exportable) $Doc->ExportField($this->f20170501);
						if ($this->f20170502->Exportable) $Doc->ExportField($this->f20170502);
						if ($this->f20170503->Exportable) $Doc->ExportField($this->f20170503);
						if ($this->f20170504->Exportable) $Doc->ExportField($this->f20170504);
						if ($this->f20170505->Exportable) $Doc->ExportField($this->f20170505);
						if ($this->f20170506->Exportable) $Doc->ExportField($this->f20170506);
						if ($this->f20170507->Exportable) $Doc->ExportField($this->f20170507);
						if ($this->f20170508->Exportable) $Doc->ExportField($this->f20170508);
						if ($this->f20170509->Exportable) $Doc->ExportField($this->f20170509);
						if ($this->f20170510->Exportable) $Doc->ExportField($this->f20170510);
						if ($this->f20170511->Exportable) $Doc->ExportField($this->f20170511);
						if ($this->f20170512->Exportable) $Doc->ExportField($this->f20170512);
						if ($this->f20170513->Exportable) $Doc->ExportField($this->f20170513);
						if ($this->f20170514->Exportable) $Doc->ExportField($this->f20170514);
						if ($this->f20170515->Exportable) $Doc->ExportField($this->f20170515);
						if ($this->f20170516->Exportable) $Doc->ExportField($this->f20170516);
						if ($this->f20170517->Exportable) $Doc->ExportField($this->f20170517);
						if ($this->f20170518->Exportable) $Doc->ExportField($this->f20170518);
						if ($this->f20170519->Exportable) $Doc->ExportField($this->f20170519);
						if ($this->f20170520->Exportable) $Doc->ExportField($this->f20170520);
						if ($this->f20170521->Exportable) $Doc->ExportField($this->f20170521);
						if ($this->f20170522->Exportable) $Doc->ExportField($this->f20170522);
						if ($this->f20170523->Exportable) $Doc->ExportField($this->f20170523);
						if ($this->f20170524->Exportable) $Doc->ExportField($this->f20170524);
						if ($this->f20170525->Exportable) $Doc->ExportField($this->f20170525);
						if ($this->f20170526->Exportable) $Doc->ExportField($this->f20170526);
						if ($this->f20170527->Exportable) $Doc->ExportField($this->f20170527);
						if ($this->f20170528->Exportable) $Doc->ExportField($this->f20170528);
						if ($this->f20170529->Exportable) $Doc->ExportField($this->f20170529);
						if ($this->f20170530->Exportable) $Doc->ExportField($this->f20170530);
						if ($this->f20170531->Exportable) $Doc->ExportField($this->f20170531);
						if ($this->f20170601->Exportable) $Doc->ExportField($this->f20170601);
						if ($this->f20170602->Exportable) $Doc->ExportField($this->f20170602);
						if ($this->f20170603->Exportable) $Doc->ExportField($this->f20170603);
						if ($this->f20170604->Exportable) $Doc->ExportField($this->f20170604);
						if ($this->f20170605->Exportable) $Doc->ExportField($this->f20170605);
						if ($this->f20170606->Exportable) $Doc->ExportField($this->f20170606);
						if ($this->f20170607->Exportable) $Doc->ExportField($this->f20170607);
						if ($this->f20170608->Exportable) $Doc->ExportField($this->f20170608);
						if ($this->f20170609->Exportable) $Doc->ExportField($this->f20170609);
						if ($this->f20170610->Exportable) $Doc->ExportField($this->f20170610);
						if ($this->f20170611->Exportable) $Doc->ExportField($this->f20170611);
						if ($this->f20170612->Exportable) $Doc->ExportField($this->f20170612);
						if ($this->f20170613->Exportable) $Doc->ExportField($this->f20170613);
						if ($this->f20170614->Exportable) $Doc->ExportField($this->f20170614);
						if ($this->f20170615->Exportable) $Doc->ExportField($this->f20170615);
						if ($this->f20170616->Exportable) $Doc->ExportField($this->f20170616);
						if ($this->f20170617->Exportable) $Doc->ExportField($this->f20170617);
						if ($this->f20170618->Exportable) $Doc->ExportField($this->f20170618);
						if ($this->f20170619->Exportable) $Doc->ExportField($this->f20170619);
						if ($this->f20170620->Exportable) $Doc->ExportField($this->f20170620);
						if ($this->f20170621->Exportable) $Doc->ExportField($this->f20170621);
						if ($this->f20170622->Exportable) $Doc->ExportField($this->f20170622);
						if ($this->f20170623->Exportable) $Doc->ExportField($this->f20170623);
						if ($this->f20170624->Exportable) $Doc->ExportField($this->f20170624);
						if ($this->f20170625->Exportable) $Doc->ExportField($this->f20170625);
						if ($this->f20170626->Exportable) $Doc->ExportField($this->f20170626);
						if ($this->f20170627->Exportable) $Doc->ExportField($this->f20170627);
						if ($this->f20170628->Exportable) $Doc->ExportField($this->f20170628);
						if ($this->f20170629->Exportable) $Doc->ExportField($this->f20170629);
						if ($this->f20170630->Exportable) $Doc->ExportField($this->f20170630);
						if ($this->f20170701->Exportable) $Doc->ExportField($this->f20170701);
						if ($this->f20170702->Exportable) $Doc->ExportField($this->f20170702);
						if ($this->f20170703->Exportable) $Doc->ExportField($this->f20170703);
						if ($this->f20170704->Exportable) $Doc->ExportField($this->f20170704);
						if ($this->f20170705->Exportable) $Doc->ExportField($this->f20170705);
						if ($this->f20170706->Exportable) $Doc->ExportField($this->f20170706);
						if ($this->f20170707->Exportable) $Doc->ExportField($this->f20170707);
						if ($this->f20170708->Exportable) $Doc->ExportField($this->f20170708);
						if ($this->f20170709->Exportable) $Doc->ExportField($this->f20170709);
						if ($this->f20170710->Exportable) $Doc->ExportField($this->f20170710);
						if ($this->f20170711->Exportable) $Doc->ExportField($this->f20170711);
						if ($this->f20170712->Exportable) $Doc->ExportField($this->f20170712);
						if ($this->f20170713->Exportable) $Doc->ExportField($this->f20170713);
						if ($this->f20170714->Exportable) $Doc->ExportField($this->f20170714);
						if ($this->f20170715->Exportable) $Doc->ExportField($this->f20170715);
						if ($this->f20170716->Exportable) $Doc->ExportField($this->f20170716);
						if ($this->f20170717->Exportable) $Doc->ExportField($this->f20170717);
						if ($this->f20170718->Exportable) $Doc->ExportField($this->f20170718);
						if ($this->f20170719->Exportable) $Doc->ExportField($this->f20170719);
						if ($this->f20170720->Exportable) $Doc->ExportField($this->f20170720);
						if ($this->f20170721->Exportable) $Doc->ExportField($this->f20170721);
						if ($this->f20170722->Exportable) $Doc->ExportField($this->f20170722);
						if ($this->f20170723->Exportable) $Doc->ExportField($this->f20170723);
						if ($this->f20170724->Exportable) $Doc->ExportField($this->f20170724);
						if ($this->f20170725->Exportable) $Doc->ExportField($this->f20170725);
						if ($this->f20170726->Exportable) $Doc->ExportField($this->f20170726);
						if ($this->f20170727->Exportable) $Doc->ExportField($this->f20170727);
						if ($this->f20170728->Exportable) $Doc->ExportField($this->f20170728);
						if ($this->f20170729->Exportable) $Doc->ExportField($this->f20170729);
						if ($this->f20170730->Exportable) $Doc->ExportField($this->f20170730);
						if ($this->f20170731->Exportable) $Doc->ExportField($this->f20170731);
						if ($this->f20170801->Exportable) $Doc->ExportField($this->f20170801);
						if ($this->f20170802->Exportable) $Doc->ExportField($this->f20170802);
						if ($this->f20170803->Exportable) $Doc->ExportField($this->f20170803);
						if ($this->f20170804->Exportable) $Doc->ExportField($this->f20170804);
						if ($this->f20170805->Exportable) $Doc->ExportField($this->f20170805);
						if ($this->f20170806->Exportable) $Doc->ExportField($this->f20170806);
						if ($this->f20170807->Exportable) $Doc->ExportField($this->f20170807);
						if ($this->f20170808->Exportable) $Doc->ExportField($this->f20170808);
						if ($this->f20170809->Exportable) $Doc->ExportField($this->f20170809);
						if ($this->f20170810->Exportable) $Doc->ExportField($this->f20170810);
						if ($this->f20170811->Exportable) $Doc->ExportField($this->f20170811);
						if ($this->f20170812->Exportable) $Doc->ExportField($this->f20170812);
						if ($this->f20170813->Exportable) $Doc->ExportField($this->f20170813);
						if ($this->f20170814->Exportable) $Doc->ExportField($this->f20170814);
						if ($this->f20170815->Exportable) $Doc->ExportField($this->f20170815);
						if ($this->f20170816->Exportable) $Doc->ExportField($this->f20170816);
						if ($this->f20170817->Exportable) $Doc->ExportField($this->f20170817);
						if ($this->f20170818->Exportable) $Doc->ExportField($this->f20170818);
						if ($this->f20170819->Exportable) $Doc->ExportField($this->f20170819);
						if ($this->f20170820->Exportable) $Doc->ExportField($this->f20170820);
						if ($this->f20170821->Exportable) $Doc->ExportField($this->f20170821);
						if ($this->f20170822->Exportable) $Doc->ExportField($this->f20170822);
						if ($this->f20170823->Exportable) $Doc->ExportField($this->f20170823);
						if ($this->f20170824->Exportable) $Doc->ExportField($this->f20170824);
						if ($this->f20170825->Exportable) $Doc->ExportField($this->f20170825);
						if ($this->f20170826->Exportable) $Doc->ExportField($this->f20170826);
						if ($this->f20170827->Exportable) $Doc->ExportField($this->f20170827);
						if ($this->f20170828->Exportable) $Doc->ExportField($this->f20170828);
						if ($this->f20170829->Exportable) $Doc->ExportField($this->f20170829);
						if ($this->f20170830->Exportable) $Doc->ExportField($this->f20170830);
						if ($this->f20170831->Exportable) $Doc->ExportField($this->f20170831);
						if ($this->f20170901->Exportable) $Doc->ExportField($this->f20170901);
						if ($this->f20170902->Exportable) $Doc->ExportField($this->f20170902);
						if ($this->f20170903->Exportable) $Doc->ExportField($this->f20170903);
						if ($this->f20170904->Exportable) $Doc->ExportField($this->f20170904);
						if ($this->f20170905->Exportable) $Doc->ExportField($this->f20170905);
						if ($this->f20170906->Exportable) $Doc->ExportField($this->f20170906);
						if ($this->f20170907->Exportable) $Doc->ExportField($this->f20170907);
						if ($this->f20170908->Exportable) $Doc->ExportField($this->f20170908);
						if ($this->f20170909->Exportable) $Doc->ExportField($this->f20170909);
						if ($this->f20170910->Exportable) $Doc->ExportField($this->f20170910);
						if ($this->f20170911->Exportable) $Doc->ExportField($this->f20170911);
						if ($this->f20170912->Exportable) $Doc->ExportField($this->f20170912);
						if ($this->f20170913->Exportable) $Doc->ExportField($this->f20170913);
						if ($this->f20170914->Exportable) $Doc->ExportField($this->f20170914);
						if ($this->f20170915->Exportable) $Doc->ExportField($this->f20170915);
						if ($this->f20170916->Exportable) $Doc->ExportField($this->f20170916);
						if ($this->f20170917->Exportable) $Doc->ExportField($this->f20170917);
						if ($this->f20170918->Exportable) $Doc->ExportField($this->f20170918);
						if ($this->f20170919->Exportable) $Doc->ExportField($this->f20170919);
						if ($this->f20170920->Exportable) $Doc->ExportField($this->f20170920);
						if ($this->f20170921->Exportable) $Doc->ExportField($this->f20170921);
						if ($this->f20170922->Exportable) $Doc->ExportField($this->f20170922);
						if ($this->f20170923->Exportable) $Doc->ExportField($this->f20170923);
						if ($this->f20170924->Exportable) $Doc->ExportField($this->f20170924);
						if ($this->f20170925->Exportable) $Doc->ExportField($this->f20170925);
						if ($this->f20170926->Exportable) $Doc->ExportField($this->f20170926);
						if ($this->f20170927->Exportable) $Doc->ExportField($this->f20170927);
						if ($this->f20170928->Exportable) $Doc->ExportField($this->f20170928);
						if ($this->f20170929->Exportable) $Doc->ExportField($this->f20170929);
						if ($this->f20170930->Exportable) $Doc->ExportField($this->f20170930);
						if ($this->f20171001->Exportable) $Doc->ExportField($this->f20171001);
						if ($this->f20171002->Exportable) $Doc->ExportField($this->f20171002);
						if ($this->f20171003->Exportable) $Doc->ExportField($this->f20171003);
						if ($this->f20171004->Exportable) $Doc->ExportField($this->f20171004);
						if ($this->f20171005->Exportable) $Doc->ExportField($this->f20171005);
						if ($this->f20171006->Exportable) $Doc->ExportField($this->f20171006);
						if ($this->f20171007->Exportable) $Doc->ExportField($this->f20171007);
						if ($this->f20171008->Exportable) $Doc->ExportField($this->f20171008);
						if ($this->f20171009->Exportable) $Doc->ExportField($this->f20171009);
						if ($this->f20171010->Exportable) $Doc->ExportField($this->f20171010);
						if ($this->f20171011->Exportable) $Doc->ExportField($this->f20171011);
						if ($this->f20171012->Exportable) $Doc->ExportField($this->f20171012);
						if ($this->f20171013->Exportable) $Doc->ExportField($this->f20171013);
						if ($this->f20171014->Exportable) $Doc->ExportField($this->f20171014);
						if ($this->f20171015->Exportable) $Doc->ExportField($this->f20171015);
						if ($this->f20171016->Exportable) $Doc->ExportField($this->f20171016);
						if ($this->f20171017->Exportable) $Doc->ExportField($this->f20171017);
						if ($this->f20171018->Exportable) $Doc->ExportField($this->f20171018);
						if ($this->f20171019->Exportable) $Doc->ExportField($this->f20171019);
						if ($this->f20171020->Exportable) $Doc->ExportField($this->f20171020);
						if ($this->f20171021->Exportable) $Doc->ExportField($this->f20171021);
						if ($this->f20171022->Exportable) $Doc->ExportField($this->f20171022);
						if ($this->f20171023->Exportable) $Doc->ExportField($this->f20171023);
						if ($this->f20171024->Exportable) $Doc->ExportField($this->f20171024);
						if ($this->f20171025->Exportable) $Doc->ExportField($this->f20171025);
						if ($this->f20171026->Exportable) $Doc->ExportField($this->f20171026);
						if ($this->f20171027->Exportable) $Doc->ExportField($this->f20171027);
						if ($this->f20171028->Exportable) $Doc->ExportField($this->f20171028);
						if ($this->f20171029->Exportable) $Doc->ExportField($this->f20171029);
						if ($this->f20171030->Exportable) $Doc->ExportField($this->f20171030);
						if ($this->f20171031->Exportable) $Doc->ExportField($this->f20171031);
						if ($this->f20171101->Exportable) $Doc->ExportField($this->f20171101);
						if ($this->f20171102->Exportable) $Doc->ExportField($this->f20171102);
						if ($this->f20171103->Exportable) $Doc->ExportField($this->f20171103);
						if ($this->f20171104->Exportable) $Doc->ExportField($this->f20171104);
						if ($this->f20171105->Exportable) $Doc->ExportField($this->f20171105);
						if ($this->f20171106->Exportable) $Doc->ExportField($this->f20171106);
						if ($this->f20171107->Exportable) $Doc->ExportField($this->f20171107);
						if ($this->f20171108->Exportable) $Doc->ExportField($this->f20171108);
						if ($this->f20171109->Exportable) $Doc->ExportField($this->f20171109);
						if ($this->f20171110->Exportable) $Doc->ExportField($this->f20171110);
						if ($this->f20171111->Exportable) $Doc->ExportField($this->f20171111);
						if ($this->f20171112->Exportable) $Doc->ExportField($this->f20171112);
						if ($this->f20171113->Exportable) $Doc->ExportField($this->f20171113);
						if ($this->f20171114->Exportable) $Doc->ExportField($this->f20171114);
						if ($this->f20171115->Exportable) $Doc->ExportField($this->f20171115);
						if ($this->f20171116->Exportable) $Doc->ExportField($this->f20171116);
						if ($this->f20171117->Exportable) $Doc->ExportField($this->f20171117);
						if ($this->f20171118->Exportable) $Doc->ExportField($this->f20171118);
						if ($this->f20171119->Exportable) $Doc->ExportField($this->f20171119);
						if ($this->f20171120->Exportable) $Doc->ExportField($this->f20171120);
						if ($this->f20171121->Exportable) $Doc->ExportField($this->f20171121);
						if ($this->f20171122->Exportable) $Doc->ExportField($this->f20171122);
						if ($this->f20171123->Exportable) $Doc->ExportField($this->f20171123);
						if ($this->f20171124->Exportable) $Doc->ExportField($this->f20171124);
						if ($this->f20171125->Exportable) $Doc->ExportField($this->f20171125);
						if ($this->f20171126->Exportable) $Doc->ExportField($this->f20171126);
						if ($this->f20171127->Exportable) $Doc->ExportField($this->f20171127);
						if ($this->f20171128->Exportable) $Doc->ExportField($this->f20171128);
						if ($this->f20171129->Exportable) $Doc->ExportField($this->f20171129);
						if ($this->f20171130->Exportable) $Doc->ExportField($this->f20171130);
						if ($this->f20171201->Exportable) $Doc->ExportField($this->f20171201);
						if ($this->f20171202->Exportable) $Doc->ExportField($this->f20171202);
						if ($this->f20171203->Exportable) $Doc->ExportField($this->f20171203);
						if ($this->f20171204->Exportable) $Doc->ExportField($this->f20171204);
						if ($this->f20171205->Exportable) $Doc->ExportField($this->f20171205);
						if ($this->f20171206->Exportable) $Doc->ExportField($this->f20171206);
						if ($this->f20171207->Exportable) $Doc->ExportField($this->f20171207);
						if ($this->f20171208->Exportable) $Doc->ExportField($this->f20171208);
						if ($this->f20171209->Exportable) $Doc->ExportField($this->f20171209);
						if ($this->f20171210->Exportable) $Doc->ExportField($this->f20171210);
						if ($this->f20171211->Exportable) $Doc->ExportField($this->f20171211);
						if ($this->f20171212->Exportable) $Doc->ExportField($this->f20171212);
						if ($this->f20171213->Exportable) $Doc->ExportField($this->f20171213);
						if ($this->f20171214->Exportable) $Doc->ExportField($this->f20171214);
						if ($this->f20171215->Exportable) $Doc->ExportField($this->f20171215);
						if ($this->f20171216->Exportable) $Doc->ExportField($this->f20171216);
						if ($this->f20171217->Exportable) $Doc->ExportField($this->f20171217);
						if ($this->f20171218->Exportable) $Doc->ExportField($this->f20171218);
						if ($this->f20171219->Exportable) $Doc->ExportField($this->f20171219);
						if ($this->f20171220->Exportable) $Doc->ExportField($this->f20171220);
						if ($this->f20171221->Exportable) $Doc->ExportField($this->f20171221);
						if ($this->f20171222->Exportable) $Doc->ExportField($this->f20171222);
						if ($this->f20171223->Exportable) $Doc->ExportField($this->f20171223);
						if ($this->f20171224->Exportable) $Doc->ExportField($this->f20171224);
						if ($this->f20171225->Exportable) $Doc->ExportField($this->f20171225);
						if ($this->f20171226->Exportable) $Doc->ExportField($this->f20171226);
						if ($this->f20171227->Exportable) $Doc->ExportField($this->f20171227);
						if ($this->f20171228->Exportable) $Doc->ExportField($this->f20171228);
						if ($this->f20171229->Exportable) $Doc->ExportField($this->f20171229);
						if ($this->f20171230->Exportable) $Doc->ExportField($this->f20171230);
						if ($this->f20171231->Exportable) $Doc->ExportField($this->f20171231);
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
		$table = 't_jd_krj_peg';
		$usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $Language;
		if (!$this->AuditTrailOnAdd) return;
		$table = 't_jd_krj_peg';

		// Get key value
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['jdwkrjpeg_id'];

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
		$table = 't_jd_krj_peg';

		// Get key value
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['jdwkrjpeg_id'];

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
		$table = 't_jd_krj_peg';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['jdwkrjpeg_id'];

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
