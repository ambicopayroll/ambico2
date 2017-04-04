<!-- Begin Main Menu -->
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(10074, "mmi_t_tgl_2017", $Language->MenuPhrase("10074", "MenuText"), "t_tgl_2017list.php?cmd=resetall", -1, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}t_tgl_2017'), FALSE, FALSE);
$RootMenu->AddMenuItem(64, "mmi_dashboard_php", $Language->MenuPhrase("64", "MenuText"), "dashboard.php", -1, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}dashboard.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(129, "mmci_Absensi", $Language->MenuPhrase("129", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(128, "mmci_Pegawai", $Language->MenuPhrase("128", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(29, "mmi_pegawai", $Language->MenuPhrase("29", "MenuText"), "pegawailist.php", 128, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}pegawai'), FALSE, FALSE);
$RootMenu->AddMenuItem(10076, "mmi_t_jdkr_peg", $Language->MenuPhrase("10076", "MenuText"), "t_jdkr_peglist.php?cmd=resetall", 128, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}t_jdkr_peg'), FALSE, FALSE);
$RootMenu->AddMenuItem(10075, "mmi_t_jd_krj_peg", $Language->MenuPhrase("10075", "MenuText"), "t_jd_krj_peglist.php", 128, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}t_jd_krj_peg'), FALSE, FALSE);
$RootMenu->AddMenuItem(63, "mmci_Pengaturan", $Language->MenuPhrase("63", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(10072, "mmi_t_jk", $Language->MenuPhrase("10072", "MenuText"), "t_jklist.php?cmd=resetall", 63, "", AllowListMenu('{4B5DAB39-E4BC-48DF-9311-E295A5F18030}t_jk'), FALSE, FALSE);
$RootMenu->AddMenuItem(130, "mmci_Penggajian", $Language->MenuPhrase("130", "MenuText"), "", -1, "", TRUE, FALSE, TRUE);
$RootMenu->AddMenuItem(-2, "mmi_changepwd", $Language->Phrase("ChangePwd"), "changepwd.php", -1, "", IsLoggedIn() && !IsSysAdmin());
$RootMenu->AddMenuItem(-1, "mmi_logout", $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, "mmi_login", $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
<!-- End Main Menu -->
