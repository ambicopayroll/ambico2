<!-- Begin Main Menu -->
<?php $RootMenu = new cMenu(EW_MENUBAR_ID) ?>
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(64, "mi_dashboard_php", $Language->MenuPhrase("64", "MenuText"), "dashboard.php", -1, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}dashboard.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(129, "mci_Absensi", $Language->MenuPhrase("129", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(1, "mi_att_log", $Language->MenuPhrase("1", "MenuText"), "att_loglist.php", 129, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}att_log'), FALSE, FALSE);
$RootMenu->AddMenuItem(128, "mci_Pegawai", $Language->MenuPhrase("128", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(29, "mi_pegawai", $Language->MenuPhrase("29", "MenuText"), "pegawailist.php", 128, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}pegawai'), FALSE, FALSE);
$RootMenu->AddMenuItem(63, "mci_Pengaturan", $Language->MenuPhrase("63", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(22, "mi_jdw_kerja_m", $Language->MenuPhrase("22", "MenuText"), "jdw_kerja_mlist.php", 63, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}jdw_kerja_m'), FALSE, FALSE);
$RootMenu->AddMenuItem(18, "mi_jam_kerja", $Language->MenuPhrase("18", "MenuText"), "jam_kerjalist.php", 63, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}jam_kerja'), FALSE, FALSE);
$RootMenu->AddMenuItem(19, "mi_jam_kerja_extra", $Language->MenuPhrase("19", "MenuText"), "jam_kerja_extralist.php", 63, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}jam_kerja_extra'), FALSE, FALSE);
$RootMenu->AddMenuItem(130, "mci_Penggajian", $Language->MenuPhrase("130", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(-2, "mi_changepwd", $Language->Phrase("ChangePwd"), "changepwd.php", -1, "", IsLoggedIn() && !IsSysAdmin());
$RootMenu->AddMenuItem(-1, "mi_logout", $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, "mi_login", $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
<!-- End Main Menu -->
