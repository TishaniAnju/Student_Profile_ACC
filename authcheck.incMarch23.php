<?php
//include('dbAccess.php');
session_start();
$loginScript = 'home.php';
$currentPage = basename($_SERVER['PHP_SELF']);

$notAuthenticated = !isset($_SESSION['authenticatedUser']);
$notLoginIp = !isset($_SESSION['loginIpAddress']) && ($_SESSION["loginIpAddress"] != $_SERVER['REMOTE_ADDR']);
$notPrivilleged = true;

if (!$notAuthenticated) 
{
	$userID = $_SESSION['authenticatedUser'];
	$result = executeQuery("SELECT * FROM privillege WHERE userID='$userID' AND pageID IN (SELECT pageID FROM page WHERE pageName='$currentPage')");
	if (mysql_num_rows($result)>0) $notPrivilleged = false;
}

if ($notAuthenticated)
{
	$_SESSION['loginMessage'] = "You have not been authorized to access the page: ".$currentPage;
	header("Location: ".$loginScript);
	exit;
}
else if ($notLoginIp)
{
	$_SESSION['loginMessage'] = "You have not been authorized to access the page: ".$currentPage." from the address ".$_SERVER['REMOTE_ADDR'];
	header("Location: ".$loginScript);
	exit;
}
else if ($notPrivilleged)
{
	$_SESSION['loginMessage'] = "You have not been authorized to access the page: ".$currentPage." with user name: ".$_SESSION['authenticatedUser'];
	header("Location: ".$loginScript);
	exit;
}
?>