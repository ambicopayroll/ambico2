<!-- Begin Main Menu -->
<?php $RootMenu = new cMenu(EW_MENUBAR_ID) ?>
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(64, "mi_dashboard_php", $Language->MenuPhrase("64", "MenuText"), "dashboard.php", -1, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}dashboard.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(129, "mci_Absensi", $Language->MenuPhrase("129", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(10075, "mri_r5fatt5flog", $Language->MenuPhrase("10075", "MenuText"), "r_att_logsmry.php", 129, "{39A6CE71-835C-4F14-B0BC-8FD07F3D6A26}", AllowListMenu('{39A6CE71-835C-4F14-B0BC-8FD07F3D6A26}r_att_log'), FALSE, FALSE);
$RootMenu->AddMenuItem(10080, "mi_rekon__php", $Language->MenuPhrase("10080", "MenuText"), "rekon_.php", 129, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}rekon_.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(10081, "mri_r5frekon2", $Language->MenuPhrase("10081", "MenuText"), "r_rekon2ctb.php", 129, "{39A6CE71-835C-4F14-B0BC-8FD07F3D6A26}", AllowListMenu('{39A6CE71-835C-4F14-B0BC-8FD07F3D6A26}r_rekon2'), FALSE, FALSE);
$RootMenu->AddMenuItem(128, "mci_Pegawai", $Language->MenuPhrase("128", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(29, "mi_pegawai", $Language->MenuPhrase("29", "MenuText"), "pegawailist.php", 128, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}pegawai'), FALSE, FALSE);
$RootMenu->AddMenuItem(10077, "mi_t_jdw_krj_peg", $Language->MenuPhrase("10077", "MenuText"), "t_jdw_krj_peglist.php?cmd=resetall", 128, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}t_jdw_krj_peg'), FALSE, FALSE);
$RootMenu->AddMenuItem(10079, "mi_generate__php", $Language->MenuPhrase("10079", "MenuText"), "generate_.php", 128, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}generate_.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(10078, "mi_t_jdw_krj_def", $Language->MenuPhrase("10078", "MenuText"), "t_jdw_krj_deflist.php?cmd=resetall", 128, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}t_jdw_krj_def'), FALSE, FALSE);
$RootMenu->AddMenuItem(63, "mci_Pengaturan", $Language->MenuPhrase("63", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(10072, "mi_t_jk", $Language->MenuPhrase("10072", "MenuText"), "t_jklist.php", 63, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}t_jk'), FALSE, FALSE);
$RootMenu->AddMenuItem(10085, "mi_payroll__php", $Language->MenuPhrase("10085", "MenuText"), "payroll_.php", -1, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}payroll_.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(-2, "mi_changepwd", $Language->Phrase("ChangePwd"), "changepwd.php", -1, "", IsLoggedIn() && !IsSysAdmin());
$RootMenu->AddMenuItem(-1, "mi_logout", $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, "mi_login", $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
<!-- End Main Menu -->
