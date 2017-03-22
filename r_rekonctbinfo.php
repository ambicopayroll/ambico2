<?php

// Global variable for table object
$r_rekon = NULL;

//
// Table class for r_rekon
//
class crr_rekon extends crTableCrosstab {
	var $pegawai_id;
	var $tgl_shift;
	var $khusus_lembur;
	var $khusus_extra;
	var $temp_id_auto;
	var $jdw_kerja_m_id;
	var $jk_id;
	var $jns_dok;
	var $izin_jenis_id;
	var $cuti_n_id;
	var $libur_umum;
	var $libur_rutin;
	var $jk_ot;
	var $scan_in;
	var $att_id_in;
	var $late_permission;
	var $late_minute;
	var $late;
	var $break_out;
	var $att_id_break1;
	var $break_in;
	var $att_id_break2;
	var $break_minute;
	var $break;
	var $break_ot_minute;
	var $break_ot;
	var $early_permission;
	var $early_minute;
	var $early;
	var $scan_out;
	var $att_id_out;
	var $durasi_minute;
	var $durasi;
	var $durasi_eot_minute;
	var $jk_count_as;
	var $status_jk;
	var $keterangan;

	//
	// Table class constructor
	//
	function __construct() {
		global $ReportLanguage, $gsLanguage;
		$this->TableVar = 'r_rekon';
		$this->TableName = 'r_rekon';
		$this->TableType = 'REPORT';
		$this->DBID = 'DB';
		$this->ExportAll = FALSE;
		$this->ExportPageBreakCount = 0;

		// pegawai_id
		$this->pegawai_id = new crField('r_rekon', 'r_rekon', 'x_pegawai_id', 'pegawai_id', '`pegawai_id`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->pegawai_id->Sortable = TRUE; // Allow sort
		$this->pegawai_id->GroupingFieldId = 1;
		$this->pegawai_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['pegawai_id'] = &$this->pegawai_id;
		$this->pegawai_id->DateFilter = "";
		$this->pegawai_id->SqlSelect = "SELECT DISTINCT `pegawai_id`, `pegawai_id` AS `DispFld` FROM " . $this->getSqlFrom();
		$this->pegawai_id->SqlOrderBy = "`pegawai_id`";

		// tgl_shift
		$this->tgl_shift = new crField('r_rekon', 'r_rekon', 'x_tgl_shift', 'tgl_shift', '`tgl_shift`', 133, EWR_DATATYPE_DATE, 0);
		$this->tgl_shift->Sortable = TRUE; // Allow sort
		$this->tgl_shift->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EWR_DATE_FORMAT"], $ReportLanguage->Phrase("IncorrectDate"));
		$this->fields['tgl_shift'] = &$this->tgl_shift;
		$this->tgl_shift->DateFilter = "";
		$this->tgl_shift->SqlSelect = "SELECT DISTINCT `tgl_shift`, `tgl_shift` AS `DispFld` FROM " . $this->getSqlFrom();
		$this->tgl_shift->SqlOrderBy = "`tgl_shift`";

		// khusus_lembur
		$this->khusus_lembur = new crField('r_rekon', 'r_rekon', 'x_khusus_lembur', 'khusus_lembur', '`khusus_lembur`', 16, EWR_DATATYPE_NUMBER, -1);
		$this->khusus_lembur->Sortable = TRUE; // Allow sort
		$this->khusus_lembur->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['khusus_lembur'] = &$this->khusus_lembur;
		$this->khusus_lembur->DateFilter = "";
		$this->khusus_lembur->SqlSelect = "";
		$this->khusus_lembur->SqlOrderBy = "";

		// khusus_extra
		$this->khusus_extra = new crField('r_rekon', 'r_rekon', 'x_khusus_extra', 'khusus_extra', '`khusus_extra`', 16, EWR_DATATYPE_NUMBER, -1);
		$this->khusus_extra->Sortable = TRUE; // Allow sort
		$this->khusus_extra->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['khusus_extra'] = &$this->khusus_extra;
		$this->khusus_extra->DateFilter = "";
		$this->khusus_extra->SqlSelect = "";
		$this->khusus_extra->SqlOrderBy = "";

		// temp_id_auto
		$this->temp_id_auto = new crField('r_rekon', 'r_rekon', 'x_temp_id_auto', 'temp_id_auto', '`temp_id_auto`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->temp_id_auto->Sortable = TRUE; // Allow sort
		$this->temp_id_auto->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['temp_id_auto'] = &$this->temp_id_auto;
		$this->temp_id_auto->DateFilter = "";
		$this->temp_id_auto->SqlSelect = "";
		$this->temp_id_auto->SqlOrderBy = "";

		// jdw_kerja_m_id
		$this->jdw_kerja_m_id = new crField('r_rekon', 'r_rekon', 'x_jdw_kerja_m_id', 'jdw_kerja_m_id', '`jdw_kerja_m_id`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->jdw_kerja_m_id->Sortable = TRUE; // Allow sort
		$this->jdw_kerja_m_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['jdw_kerja_m_id'] = &$this->jdw_kerja_m_id;
		$this->jdw_kerja_m_id->DateFilter = "";
		$this->jdw_kerja_m_id->SqlSelect = "";
		$this->jdw_kerja_m_id->SqlOrderBy = "";

		// jk_id
		$this->jk_id = new crField('r_rekon', 'r_rekon', 'x_jk_id', 'jk_id', '`jk_id`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->jk_id->Sortable = TRUE; // Allow sort
		$this->jk_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['jk_id'] = &$this->jk_id;
		$this->jk_id->DateFilter = "";
		$this->jk_id->SqlSelect = "";
		$this->jk_id->SqlOrderBy = "";

		// jns_dok
		$this->jns_dok = new crField('r_rekon', 'r_rekon', 'x_jns_dok', 'jns_dok', '`jns_dok`', 16, EWR_DATATYPE_NUMBER, -1);
		$this->jns_dok->Sortable = TRUE; // Allow sort
		$this->jns_dok->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['jns_dok'] = &$this->jns_dok;
		$this->jns_dok->DateFilter = "";
		$this->jns_dok->SqlSelect = "";
		$this->jns_dok->SqlOrderBy = "";

		// izin_jenis_id
		$this->izin_jenis_id = new crField('r_rekon', 'r_rekon', 'x_izin_jenis_id', 'izin_jenis_id', '`izin_jenis_id`', 2, EWR_DATATYPE_NUMBER, -1);
		$this->izin_jenis_id->Sortable = TRUE; // Allow sort
		$this->izin_jenis_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['izin_jenis_id'] = &$this->izin_jenis_id;
		$this->izin_jenis_id->DateFilter = "";
		$this->izin_jenis_id->SqlSelect = "";
		$this->izin_jenis_id->SqlOrderBy = "";

		// cuti_n_id
		$this->cuti_n_id = new crField('r_rekon', 'r_rekon', 'x_cuti_n_id', 'cuti_n_id', '`cuti_n_id`', 3, EWR_DATATYPE_NUMBER, -1);
		$this->cuti_n_id->Sortable = TRUE; // Allow sort
		$this->cuti_n_id->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['cuti_n_id'] = &$this->cuti_n_id;
		$this->cuti_n_id->DateFilter = "";
		$this->cuti_n_id->SqlSelect = "";
		$this->cuti_n_id->SqlOrderBy = "";

		// libur_umum
		$this->libur_umum = new crField('r_rekon', 'r_rekon', 'x_libur_umum', 'libur_umum', '`libur_umum`', 16, EWR_DATATYPE_NUMBER, -1);
		$this->libur_umum->Sortable = TRUE; // Allow sort
		$this->libur_umum->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['libur_umum'] = &$this->libur_umum;
		$this->libur_umum->DateFilter = "";
		$this->libur_umum->SqlSelect = "";
		$this->libur_umum->SqlOrderBy = "";

		// libur_rutin
		$this->libur_rutin = new crField('r_rekon', 'r_rekon', 'x_libur_rutin', 'libur_rutin', '`libur_rutin`', 16, EWR_DATATYPE_NUMBER, -1);
		$this->libur_rutin->Sortable = TRUE; // Allow sort
		$this->libur_rutin->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['libur_rutin'] = &$this->libur_rutin;
		$this->libur_rutin->DateFilter = "";
		$this->libur_rutin->SqlSelect = "";
		$this->libur_rutin->SqlOrderBy = "";

		// jk_ot
		$this->jk_ot = new crField('r_rekon', 'r_rekon', 'x_jk_ot', 'jk_ot', '`jk_ot`', 16, EWR_DATATYPE_NUMBER, -1);
		$this->jk_ot->Sortable = TRUE; // Allow sort
		$this->jk_ot->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['jk_ot'] = &$this->jk_ot;
		$this->jk_ot->DateFilter = "";
		$this->jk_ot->SqlSelect = "";
		$this->jk_ot->SqlOrderBy = "";

		// scan_in
		$this->scan_in = new crField('r_rekon', 'r_rekon', 'x_scan_in', 'scan_in', '`scan_in`', 135, EWR_DATATYPE_DATE, 0);
		$this->scan_in->Sortable = TRUE; // Allow sort
		$this->scan_in->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EWR_DATE_FORMAT"], $ReportLanguage->Phrase("IncorrectDate"));
		$this->fields['scan_in'] = &$this->scan_in;
		$this->scan_in->DateFilter = "";
		$this->scan_in->SqlSelect = "";
		$this->scan_in->SqlOrderBy = "";

		// att_id_in
		$this->att_id_in = new crField('r_rekon', 'r_rekon', 'x_att_id_in', 'att_id_in', '`att_id_in`', 200, EWR_DATATYPE_STRING, -1);
		$this->att_id_in->Sortable = TRUE; // Allow sort
		$this->fields['att_id_in'] = &$this->att_id_in;
		$this->att_id_in->DateFilter = "";
		$this->att_id_in->SqlSelect = "";
		$this->att_id_in->SqlOrderBy = "";

		// late_permission
		$this->late_permission = new crField('r_rekon', 'r_rekon', 'x_late_permission', 'late_permission', '`late_permission`', 16, EWR_DATATYPE_NUMBER, -1);
		$this->late_permission->Sortable = TRUE; // Allow sort
		$this->late_permission->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['late_permission'] = &$this->late_permission;
		$this->late_permission->DateFilter = "";
		$this->late_permission->SqlSelect = "";
		$this->late_permission->SqlOrderBy = "";

		// late_minute
		$this->late_minute = new crField('r_rekon', 'r_rekon', 'x_late_minute', 'late_minute', '`late_minute`', 2, EWR_DATATYPE_NUMBER, -1);
		$this->late_minute->Sortable = TRUE; // Allow sort
		$this->late_minute->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['late_minute'] = &$this->late_minute;
		$this->late_minute->DateFilter = "";
		$this->late_minute->SqlSelect = "";
		$this->late_minute->SqlOrderBy = "";

		// late
		$this->late = new crField('r_rekon', 'r_rekon', 'x_late', 'late', '`late`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->late->Sortable = TRUE; // Allow sort
		$this->late->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['late'] = &$this->late;
		$this->late->DateFilter = "";
		$this->late->SqlSelect = "";
		$this->late->SqlOrderBy = "";

		// break_out
		$this->break_out = new crField('r_rekon', 'r_rekon', 'x_break_out', 'break_out', '`break_out`', 135, EWR_DATATYPE_DATE, 0);
		$this->break_out->Sortable = TRUE; // Allow sort
		$this->break_out->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EWR_DATE_FORMAT"], $ReportLanguage->Phrase("IncorrectDate"));
		$this->fields['break_out'] = &$this->break_out;
		$this->break_out->DateFilter = "";
		$this->break_out->SqlSelect = "";
		$this->break_out->SqlOrderBy = "";

		// att_id_break1
		$this->att_id_break1 = new crField('r_rekon', 'r_rekon', 'x_att_id_break1', 'att_id_break1', '`att_id_break1`', 200, EWR_DATATYPE_STRING, -1);
		$this->att_id_break1->Sortable = TRUE; // Allow sort
		$this->fields['att_id_break1'] = &$this->att_id_break1;
		$this->att_id_break1->DateFilter = "";
		$this->att_id_break1->SqlSelect = "";
		$this->att_id_break1->SqlOrderBy = "";

		// break_in
		$this->break_in = new crField('r_rekon', 'r_rekon', 'x_break_in', 'break_in', '`break_in`', 135, EWR_DATATYPE_DATE, 0);
		$this->break_in->Sortable = TRUE; // Allow sort
		$this->break_in->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EWR_DATE_FORMAT"], $ReportLanguage->Phrase("IncorrectDate"));
		$this->fields['break_in'] = &$this->break_in;
		$this->break_in->DateFilter = "";
		$this->break_in->SqlSelect = "";
		$this->break_in->SqlOrderBy = "";

		// att_id_break2
		$this->att_id_break2 = new crField('r_rekon', 'r_rekon', 'x_att_id_break2', 'att_id_break2', '`att_id_break2`', 200, EWR_DATATYPE_STRING, -1);
		$this->att_id_break2->Sortable = TRUE; // Allow sort
		$this->fields['att_id_break2'] = &$this->att_id_break2;
		$this->att_id_break2->DateFilter = "";
		$this->att_id_break2->SqlSelect = "";
		$this->att_id_break2->SqlOrderBy = "";

		// break_minute
		$this->break_minute = new crField('r_rekon', 'r_rekon', 'x_break_minute', 'break_minute', '`break_minute`', 2, EWR_DATATYPE_NUMBER, -1);
		$this->break_minute->Sortable = TRUE; // Allow sort
		$this->break_minute->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['break_minute'] = &$this->break_minute;
		$this->break_minute->DateFilter = "";
		$this->break_minute->SqlSelect = "";
		$this->break_minute->SqlOrderBy = "";

		// break
		$this->break = new crField('r_rekon', 'r_rekon', 'x_break', 'break', '`break`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->break->Sortable = TRUE; // Allow sort
		$this->break->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['break'] = &$this->break;
		$this->break->DateFilter = "";
		$this->break->SqlSelect = "";
		$this->break->SqlOrderBy = "";

		// break_ot_minute
		$this->break_ot_minute = new crField('r_rekon', 'r_rekon', 'x_break_ot_minute', 'break_ot_minute', '`break_ot_minute`', 2, EWR_DATATYPE_NUMBER, -1);
		$this->break_ot_minute->Sortable = TRUE; // Allow sort
		$this->break_ot_minute->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['break_ot_minute'] = &$this->break_ot_minute;
		$this->break_ot_minute->DateFilter = "";
		$this->break_ot_minute->SqlSelect = "";
		$this->break_ot_minute->SqlOrderBy = "";

		// break_ot
		$this->break_ot = new crField('r_rekon', 'r_rekon', 'x_break_ot', 'break_ot', '`break_ot`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->break_ot->Sortable = TRUE; // Allow sort
		$this->break_ot->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['break_ot'] = &$this->break_ot;
		$this->break_ot->DateFilter = "";
		$this->break_ot->SqlSelect = "";
		$this->break_ot->SqlOrderBy = "";

		// early_permission
		$this->early_permission = new crField('r_rekon', 'r_rekon', 'x_early_permission', 'early_permission', '`early_permission`', 16, EWR_DATATYPE_NUMBER, -1);
		$this->early_permission->Sortable = TRUE; // Allow sort
		$this->early_permission->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['early_permission'] = &$this->early_permission;
		$this->early_permission->DateFilter = "";
		$this->early_permission->SqlSelect = "";
		$this->early_permission->SqlOrderBy = "";

		// early_minute
		$this->early_minute = new crField('r_rekon', 'r_rekon', 'x_early_minute', 'early_minute', '`early_minute`', 2, EWR_DATATYPE_NUMBER, -1);
		$this->early_minute->Sortable = TRUE; // Allow sort
		$this->early_minute->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['early_minute'] = &$this->early_minute;
		$this->early_minute->DateFilter = "";
		$this->early_minute->SqlSelect = "";
		$this->early_minute->SqlOrderBy = "";

		// early
		$this->early = new crField('r_rekon', 'r_rekon', 'x_early', 'early', '`early`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->early->Sortable = TRUE; // Allow sort
		$this->early->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['early'] = &$this->early;
		$this->early->DateFilter = "";
		$this->early->SqlSelect = "";
		$this->early->SqlOrderBy = "";

		// scan_out
		$this->scan_out = new crField('r_rekon', 'r_rekon', 'x_scan_out', 'scan_out', '`scan_out`', 135, EWR_DATATYPE_DATE, 0);
		$this->scan_out->Sortable = TRUE; // Allow sort
		$this->scan_out->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EWR_DATE_FORMAT"], $ReportLanguage->Phrase("IncorrectDate"));
		$this->fields['scan_out'] = &$this->scan_out;
		$this->scan_out->DateFilter = "";
		$this->scan_out->SqlSelect = "";
		$this->scan_out->SqlOrderBy = "";

		// att_id_out
		$this->att_id_out = new crField('r_rekon', 'r_rekon', 'x_att_id_out', 'att_id_out', '`att_id_out`', 200, EWR_DATATYPE_STRING, -1);
		$this->att_id_out->Sortable = TRUE; // Allow sort
		$this->fields['att_id_out'] = &$this->att_id_out;
		$this->att_id_out->DateFilter = "";
		$this->att_id_out->SqlSelect = "";
		$this->att_id_out->SqlOrderBy = "";

		// durasi_minute
		$this->durasi_minute = new crField('r_rekon', 'r_rekon', 'x_durasi_minute', 'durasi_minute', '`durasi_minute`', 2, EWR_DATATYPE_NUMBER, -1);
		$this->durasi_minute->Sortable = TRUE; // Allow sort
		$this->durasi_minute->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['durasi_minute'] = &$this->durasi_minute;
		$this->durasi_minute->DateFilter = "";
		$this->durasi_minute->SqlSelect = "";
		$this->durasi_minute->SqlOrderBy = "";

		// durasi
		$this->durasi = new crField('r_rekon', 'r_rekon', 'x_durasi', 'durasi', '`durasi`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->durasi->Sortable = TRUE; // Allow sort
		$this->durasi->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['durasi'] = &$this->durasi;
		$this->durasi->DateFilter = "";
		$this->durasi->SqlSelect = "";
		$this->durasi->SqlOrderBy = "";

		// durasi_eot_minute
		$this->durasi_eot_minute = new crField('r_rekon', 'r_rekon', 'x_durasi_eot_minute', 'durasi_eot_minute', '`durasi_eot_minute`', 2, EWR_DATATYPE_NUMBER, -1);
		$this->durasi_eot_minute->Sortable = TRUE; // Allow sort
		$this->durasi_eot_minute->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['durasi_eot_minute'] = &$this->durasi_eot_minute;
		$this->durasi_eot_minute->DateFilter = "";
		$this->durasi_eot_minute->SqlSelect = "";
		$this->durasi_eot_minute->SqlOrderBy = "";

		// jk_count_as
		$this->jk_count_as = new crField('r_rekon', 'r_rekon', 'x_jk_count_as', 'jk_count_as', '`jk_count_as`', 4, EWR_DATATYPE_NUMBER, -1);
		$this->jk_count_as->Sortable = TRUE; // Allow sort
		$this->jk_count_as->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectFloat");
		$this->fields['jk_count_as'] = &$this->jk_count_as;
		$this->jk_count_as->DateFilter = "";
		$this->jk_count_as->SqlSelect = "";
		$this->jk_count_as->SqlOrderBy = "";

		// status_jk
		$this->status_jk = new crField('r_rekon', 'r_rekon', 'x_status_jk', 'status_jk', '`status_jk`', 16, EWR_DATATYPE_NUMBER, -1);
		$this->status_jk->Sortable = TRUE; // Allow sort
		$this->status_jk->FldDefaultErrMsg = $ReportLanguage->Phrase("IncorrectInteger");
		$this->fields['status_jk'] = &$this->status_jk;
		$this->status_jk->DateFilter = "";
		$this->status_jk->SqlSelect = "";
		$this->status_jk->SqlOrderBy = "";

		// keterangan
		$this->keterangan = new crField('r_rekon', 'r_rekon', 'x_keterangan', 'keterangan', '`keterangan`', 201, EWR_DATATYPE_MEMO, -1);
		$this->keterangan->Sortable = TRUE; // Allow sort
		$this->fields['keterangan'] = &$this->keterangan;
		$this->keterangan->DateFilter = "";
		$this->keterangan->SqlSelect = "";
		$this->keterangan->SqlOrderBy = "";
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
			if ($ofld->GroupingFieldId == 0) {
				if ($ctrl) {
					$sOrderBy = $this->getDetailOrderBy();
					if (strpos($sOrderBy, $sSortField . " " . $sLastSort) !== FALSE) {
						$sOrderBy = str_replace($sSortField . " " . $sLastSort, $sSortField . " " . $sThisSort, $sOrderBy);
					} else {
						if ($sOrderBy <> "") $sOrderBy .= ", ";
						$sOrderBy .= $sSortField . " " . $sThisSort;
					}
					$this->setDetailOrderBy($sOrderBy); // Save to Session
				} else {
					$this->setDetailOrderBy($sSortField . " " . $sThisSort); // Save to Session
				}
			}
		} else {
			if ($ofld->GroupingFieldId == 0 && !$ctrl) $ofld->setSort("");
		}
	}

	// Get Sort SQL
	function SortSql() {
		$sDtlSortSql = $this->getDetailOrderBy(); // Get ORDER BY for detail fields from session
		$argrps = array();
		foreach ($this->fields as $fld) {
			if ($fld->getSort() <> "") {
				$fldsql = $fld->FldExpression;
				if ($fld->GroupingFieldId > 0) {
					if ($fld->FldGroupSql <> "")
						$argrps[$fld->GroupingFieldId] = str_replace("%s", $fldsql, $fld->FldGroupSql) . " " . $fld->getSort();
					else
						$argrps[$fld->GroupingFieldId] = $fldsql . " " . $fld->getSort();
				}
			}
		}
		$sSortSql = "";
		foreach ($argrps as $grp) {
			if ($sSortSql <> "") $sSortSql .= ", ";
			$sSortSql .= $grp;
		}
		if ($sDtlSortSql <> "") {
			if ($sSortSql <> "") $sSortSql .= ", ";
			$sSortSql .= $sDtlSortSql;
		}
		return $sSortSql;
	}

	// Table level SQL
	// Column field

	var $ColumnField = "";

	function getColumnField() {
		return ($this->ColumnField <> "") ? $this->ColumnField : "`tgl_shift`";
	}

	function setColumnField($v) {
		$this->ColumnField = $v;
	}

	// Column date type
	var $ColumnDateType = "";

	function getColumnDateType() {
		return ($this->ColumnDateType <> "") ? $this->ColumnDateType : "d";
	}

	function setColumnDateType($v) {
		$this->ColumnDateType = $v;
	}

	// Column captions
	var $ColumnCaptions = "";

	function getColumnCaptions() {
		global $ReportLanguage;
		return ($this->ColumnCaptions <> "") ? $this->ColumnCaptions : "";
	}

	function setColumnCaptions($v) {
		$this->ColumnCaptions = $v;
	}

	// Column names
	var $ColumnNames = "";

	function getColumnNames() {
		return ($this->ColumnNames <> "") ? $this->ColumnNames : "";
	}

	function setColumnNames($v) {
		$this->ColumnNames = $v;
	}

	// Column values
	var $ColumnValues = "";

	function getColumnValues() {
		return ($this->ColumnValues <> "") ? $this->ColumnValues : "";
	}

	function setColumnValues($v) {
		$this->ColumnValues = $v;
	}

	// From
	var $_SqlFrom = "";

	function getSqlFrom() {
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`shift_result`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}

	// Select
	var $_SqlSelect = "";

	function getSqlSelect() {
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT `pegawai_id`, <DistinctColumnFields> FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
		return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
		$this->_SqlSelect = $v;
	}

	// Where
	var $_SqlWhere = "";

	function getSqlWhere() {
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
		return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
		$this->_SqlWhere = $v;
	}

	// Group By
	var $_SqlGroupBy = "";

	function getSqlGroupBy() {
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "`pegawai_id`";
	}

	function SqlGroupBy() { // For backward compatibility
		return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
		$this->_SqlGroupBy = $v;
	}

	// Having
	var $_SqlHaving = "";

	function getSqlHaving() {
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
		return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
		$this->_SqlHaving = $v;
	}

	// Order By
	var $_SqlOrderBy = "";

	function getSqlOrderBy() {
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "`pegawai_id` ASC";
	}

	function SqlOrderBy() { // For backward compatibility
		return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
		$this->_SqlOrderBy = $v;
	}

	// Select Distinct
	var $_SqlDistinctSelect = "";

	function getSqlDistinctSelect() {
		return ($this->_SqlDistinctSelect <> "") ? $this->_SqlDistinctSelect : "SELECT DISTINCT DATE_FORMAT(`tgl_shift`,'%Y-%m-%d') FROM `shift_result`";
	}

	function SqlDistinctSelect() { // For backward compatibility
		return $this->getSqlDistinctSelect();
	}

	function setSqlDistinctSelect($v) {
		$this->_SqlDistinctSelect = $v;
	}

	// Distinct Where
	var $_SqlDistinctWhere = "";

	function getSqlDistinctWhere() {
		$sWhere = ($this->_SqlDistinctWhere <> "") ? $this->_SqlDistinctWhere : "";
		return $sWhere;
	}

	function SqlDistinctWhere() { // For backward compatibility
		return $this->getSqlDistinctWhere();
	}

	function setSqlDistinctWhere($v) {
		$this->_SqlDistinctWhere = $v;
	}

	// Distinct Order By
	var $_SqlDistinctOrderBy = "";

	function getSqlDistinctOrderBy() {
		return ($this->_SqlDistinctOrderBy <> "") ? $this->_SqlDistinctOrderBy : "DATE_FORMAT(`tgl_shift`,'%Y-%m-%d') ASC";
	}

	function SqlDistinctOrderBy() { // For backward compatibility
		return $this->getSqlDistinctOrderBy();
	}

	function setSqlDistinctOrderBy($v) {
		$this->_SqlDistinctOrderBy = $v;
	}
	var $ColCount;
	var $Col;
	var $DistinctColumnFields = "";

	// Load column values
	function LoadColumnValues($filter = "") {
		global $ReportLanguage;
		$conn = &$this->Connection();

		// Build SQL
		$sSql = ewr_BuildReportSql($this->getSqlDistinctSelect(), $this->getSqlDistinctWhere(), "", "", $this->getSqlDistinctOrderBy(), $filter, "");

		// Load recordset
		$rscol = $conn->Execute($sSql);

		// Get distinct column count
		$this->ColCount = ($rscol) ? $rscol->RecordCount() : 0;

/* Uncomment to show phrase
		if ($this->ColCount == 0) {
			if ($rscol) $rscol->Close();
			echo "<p>" . $ReportLanguage->Phrase("NoDistinctColVals") . $sSql . "</p>";
			exit();
		}
*/
		$this->Col = &ewr_Init2DArray($this->ColCount+1, 2, NULL);
		$colcnt = 0;
		while (!$rscol->EOF) {
			if (is_null($rscol->fields[0])) {
				$wrkValue = EWR_NULL_VALUE;
				$wrkCaption = $ReportLanguage->Phrase("NullLabel");
			} elseif ($rscol->fields[0] == "") {
				$wrkValue = EWR_EMPTY_VALUE;
				$wrkCaption = $ReportLanguage->Phrase("EmptyLabel");
			} else {
				$wrkValue = $rscol->fields[0];
				$wrkCaption = $rscol->fields[0];
			}
			$colcnt++;
			$this->Col[$colcnt] = new crCrosstabColumn($wrkValue, $wrkCaption, TRUE);
			$rscol->MoveNext();
		}
		$rscol->Close();

		// 1st dimension = no of groups (level 0 used for grand total)
		// 2nd dimension = no of distinct values

		$nGrps = 1;
		$this->SummaryFields[0] = new crSummaryField('x_durasi_minute', 'durasi_minute', '`durasi_minute`', 'SUM');
		$this->SummaryFields[0]->SummaryCaption = $ReportLanguage->Phrase("RptSum");
		$this->SummaryFields[0]->SummaryVal = &ewr_InitArray($this->ColCount+1, NULL);
		$this->SummaryFields[0]->SummaryValCnt = &ewr_InitArray($this->ColCount+1, NULL);
		$this->SummaryFields[0]->SummaryCnt = &ewr_Init2DArray($this->ColCount+1, $nGrps+1, NULL);
		$this->SummaryFields[0]->SummarySmry = &ewr_Init2DArray($this->ColCount+1, $nGrps+1, NULL);
		$this->SummaryFields[0]->SummarySmryCnt = &ewr_Init2DArray($this->ColCount+1, $nGrps+1, NULL);
		$this->SummaryFields[0]->SummaryInitValue = 0;

		// Update crosstab sql
		$sSqlFlds = "";
		$cnt = count($this->SummaryFields);
		for ($is = 0; $is < $cnt; $is++) {
			$smry = &$this->SummaryFields[$is];
			for ($colcnt = 1; $colcnt <= $this->ColCount; $colcnt++) {
				$sFld = ewr_CrossTabField($smry->SummaryType, $smry->FldExpression, $this->getColumnField(), $this->getColumnDateType(), $this->Col[$colcnt]->Value, "'", "C" . $is . $colcnt, $this->DBID);
				if ($sSqlFlds <> "")
					$sSqlFlds .= ", ";
				$sSqlFlds .= $sFld;
			}
		}
		$this->DistinctColumnFields = $sSqlFlds;
	}

	// Table Level Group SQL
	// First Group Field

	var $_SqlFirstGroupField = "";

	function getSqlFirstGroupField() {
		return ($this->_SqlFirstGroupField <> "") ? $this->_SqlFirstGroupField : "`pegawai_id`";
	}

	function SqlFirstGroupField() { // For backward compatibility
		return $this->getSqlFirstGroupField();
	}

	function setSqlFirstGroupField($v) {
		$this->_SqlFirstGroupField = $v;
	}

	// Select Group
	var $_SqlSelectGroup = "";

	function getSqlSelectGroup() {
		return ($this->_SqlSelectGroup <> "") ? $this->_SqlSelectGroup : "SELECT DISTINCT " . $this->getSqlFirstGroupField() . " FROM " . $this->getSqlFrom();
	}

	function SqlSelectGroup() { // For backward compatibility
		return $this->getSqlSelectGroup();
	}

	function setSqlSelectGroup($v) {
		$this->_SqlSelectGroup = $v;
	}

	// Order By Group
	var $_SqlOrderByGroup = "";

	function getSqlOrderByGroup() {
		return ($this->_SqlOrderByGroup <> "") ? $this->_SqlOrderByGroup : "`pegawai_id` ASC";
	}

	function SqlOrderByGroup() { // For backward compatibility
		return $this->getSqlOrderByGroup();
	}

	function setSqlOrderByGroup($v) {
		$this->_SqlOrderByGroup = $v;
	}

	// Select Aggregate
	var $_SqlSelectAgg = "";

	function getSqlSelectAgg() {
		return ($this->_SqlSelectAgg <> "") ? $this->_SqlSelectAgg : "SELECT <DistinctColumnFields> FROM " . $this->getSqlFrom();
	}

	function SqlSelectAgg() { // For backward compatibility
		return $this->getSqlSelectAgg();
	}

	function setSqlSelectAgg($v) {
		$this->_SqlSelectAgg = $v;
	}

	// Group By Aggregate
	var $_SqlGroupByAgg = "";

	function getSqlGroupByAgg() {
		return ($this->_SqlGroupByAgg <> "") ? $this->_SqlGroupByAgg : "";
	}

	function SqlGroupByAgg() { // For backward compatibility
		return $this->getSqlGroupByAgg();
	}

	function setSqlGroupByAgg($v) {
		$this->_SqlGroupByAgg = $v;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {

			//$sUrlParm = "order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort();
			$sUrlParm = "order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort();
			return ewr_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld) {
		global $gsLanguage;
		switch ($fld->FldVar) {
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld) {
		global $gsLanguage;
		switch ($fld->FldVar) {
		}
	}

	// Table level events
	// Page Selecting event
	function Page_Selecting(&$filter) {

		// Enter your code here
	}

	// Page Breaking event
	function Page_Breaking(&$break, &$content) {

		// Example:
		//$break = FALSE; // Skip page break, or
		//$content = "<div style=\"page-break-after:always;\">&nbsp;</div>"; // Modify page break content

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here
	}

	// Cell Rendered event
	function Cell_Rendered(&$Field, $CurrentValue, &$ViewValue, &$ViewAttrs, &$CellAttrs, &$HrefValue, &$LinkAttrs) {

		//$ViewValue = "xxx";
		//$ViewAttrs["style"] = "xxx";

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

	// Load Filters event
	function Page_FilterLoad() {

		// Enter your code here
		// Example: Register/Unregister Custom Extended Filter
		//ewr_RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A', 'GetStartsWithAFilter'); // With function, or
		//ewr_RegisterFilter($this-><Field>, 'StartsWithA', 'Starts With A'); // No function, use Page_Filtering event
		//ewr_UnregisterFilter($this-><Field>, 'StartsWithA');

	}

	// Page Filter Validated event
	function Page_FilterValidated() {

		// Example:
		//$this->MyField1->SearchValue = "your search criteria"; // Search value

	}

	// Page Filtering event
	function Page_Filtering(&$fld, &$filter, $typ, $opr = "", $val = "", $cond = "", $opr2 = "", $val2 = "") {

		// Note: ALWAYS CHECK THE FILTER TYPE ($typ)! Example:
		//if ($typ == "dropdown" && $fld->FldName == "MyField") // Dropdown filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "extended" && $fld->FldName == "MyField") // Extended filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "popup" && $fld->FldName == "MyField") // Popup filter
		//	$filter = "..."; // Modify the filter
		//if ($typ == "custom" && $opr == "..." && $fld->FldName == "MyField") // Custom filter, $opr is the custom filter ID
		//	$filter = "..."; // Modify the filter

	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		// Enter your code here
	}
}
?>
