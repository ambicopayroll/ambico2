<!-- Begin Main Menu -->
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(64, "mmi_dashboard_php", $Language->MenuPhrase("64", "MenuText"), "dashboard.php", -1, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}dashboard.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(129, "mmci_Absensi", $Language->MenuPhrase("129", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(10075, "mmri_r5fatt5flog", $Language->MenuPhrase("10075", "MenuText"), "r_att_logsmry.php", 129, "{39A6CE71-835C-4F14-B0BC-8FD07F3D6A26}", AllowListMenu('{39A6CE71-835C-4F14-B0BC-8FD07F3D6A26}r_att_log'), FALSE, FALSE);
$RootMenu->AddMenuItem(10080, "mmi_rekon__php", $Language->MenuPhrase("10080", "MenuText"), "rekon_.php", 129, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}rekon_.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(10081, "mmri_r5frekon2", $Language->MenuPhrase("10081", "MenuText"), "r_rekon2ctb.php", 129, "{39A6CE71-835C-4F14-B0BC-8FD07F3D6A26}", AllowListMenu('{39A6CE71-835C-4F14-B0BC-8FD07F3D6A26}r_rekon2'), FALSE, FALSE);
$RootMenu->AddMenuItem(128, "mmci_Pegawai", $Language->MenuPhrase("128", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(29, "mmi_pegawai", $Language->MenuPhrase("29", "MenuText"), "pegawailist.php", 128, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}pegawai'), FALSE, FALSE);
$RootMenu->AddMenuItem(31, "mmi_pembagian1", $Language->MenuPhrase("31", "MenuText"), "pembagian1list.php", 128, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}pembagian1'), FALSE, FALSE);
$RootMenu->AddMenuItem(32, "mmi_pembagian2", $Language->MenuPhrase("32", "MenuText"), "pembagian2list.php", 128, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}pembagian2'), FALSE, FALSE);
$RootMenu->AddMenuItem(33, "mmi_pembagian3", $Language->MenuPhrase("33", "MenuText"), "pembagian3list.php", 128, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}pembagian3'), FALSE, FALSE);
$RootMenu->AddMenuItem(10072, "mmi_t_jk", $Language->MenuPhrase("10072", "MenuText"), "t_jklist.php", 128, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}t_jk'), FALSE, FALSE);
$RootMenu->AddMenuItem(10494, "mmci_Jadwal_Kerja", $Language->MenuPhrase("10494", "MenuText"), "", 128, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(10077, "mmi_t_jdw_krj_peg", $Language->MenuPhrase("10077", "MenuText"), "t_jdw_krj_peglist.php?cmd=resetall", 10494, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}t_jdw_krj_peg'), FALSE, FALSE);
$RootMenu->AddMenuItem(10079, "mmi_generate__php", $Language->MenuPhrase("10079", "MenuText"), "generate_.php", 10494, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}generate_.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(10078, "mmi_t_jdw_krj_def", $Language->MenuPhrase("10078", "MenuText"), "t_jdw_krj_deflist.php?cmd=resetall", 10494, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}t_jdw_krj_def'), FALSE, FALSE);
$RootMenu->AddMenuItem(10087, "mmi_t_rumus_peg", $Language->MenuPhrase("10087", "MenuText"), "t_rumus_peglist.php?cmd=resetall", 128, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}t_rumus_peg'), FALSE, FALSE);
$RootMenu->AddMenuItem(10363, "mmci_Penggajian", $Language->MenuPhrase("10363", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(10086, "mmi_t_rumus", $Language->MenuPhrase("10086", "MenuText"), "t_rumuslist.php", 10363, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}t_rumus'), FALSE, FALSE);
$RootMenu->AddMenuItem(10085, "mmi_payroll__php", $Language->MenuPhrase("10085", "MenuText"), "payroll_.php", 10363, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}payroll_.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(-2, "mmi_changepwd", $Language->Phrase("ChangePwd"), "changepwd.php", -1, "", IsLoggedIn() && !IsSysAdmin());
$RootMenu->AddMenuItem(-1, "mmi_logout", $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, "mmi_login", $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
<!-- End Main Menu -->
