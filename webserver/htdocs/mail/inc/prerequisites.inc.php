<?php
ini_set("session.cookie_secure", 1);
ini_set("session.cookie_httponly", 1);
session_start();
if (isset($_POST["logout"])) {
	session_unset();
	session_destroy();
	session_write_close();
	setcookie(session_name(),'',0,'/');
}

require_once 'inc/vars.inc.php';
include_once 'inc/vars.local.inc.php';

$dsn = "$database_type:host=$database_host;dbname=$database_name";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $database_user, $database_pass, $opt);

if(isset($_COOKIE['admin']))	{
	$AdminLogin = $_COOKIE['admin'];
} else {
	$AdminLogin = '';
}
if(isset($_COOKIE['user']))	{
	$UserLogin = $_COOKIE['user'];
} else {
	$UserLogin = '';
}

$_SESSION['mailcow_locale'] = strtolower(trim($DEFAULT_LANG));
if (isset($_COOKIE['language'])) {
	switch ($_COOKIE['language']) {
		case "de":
			$_SESSION['mailcow_locale'] = 'de';
		break;
		case "en":
			$_SESSION['mailcow_locale'] = 'en';
		break;
		case "fr":
			$_SESSION['mailcow_locale'] = 'fr';
		break;
		case "nl":
			$_SESSION['mailcow_locale'] = 'nl';
		break;
		case "pt":
			$_SESSION['mailcow_locale'] = 'pt';
		break;
	}
}
if (isset($_GET['lang'])) {
	switch ($_GET['lang']) {
		case "de":
			$_SESSION['mailcow_locale'] = 'de';
		break;
		case "en":
			$_SESSION['mailcow_locale'] = 'en';
		break;
		case "fr":
			$_SESSION['mailcow_locale'] = 'fr';
		break;
		case "nl":
			$_SESSION['mailcow_locale'] = 'nl';
		break;
		case "pt":
			$_SESSION['mailcow_locale'] = 'pt';
		break;
	}
}
setcookie('language', $_SESSION['mailcow_locale'], time()+7776000);
require_once 'lang/lang.en.php';
include 'lang/lang.'.$_SESSION['mailcow_locale'].'.php';
require_once 'inc/functions.inc.php';
require_once 'inc/triggers.inc.php';
