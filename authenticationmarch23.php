<?php
include("dbAccess.php");

function authenticateUser($userName,$password)
{
	//Test the username and password
	if (!isset($userName) || !isset($password)) return false;
	
	//Get 2 characters salt from username
	$salt = substr($userName,0,2);
	
	//Encrypt password
	$crypted_password = crypt($password,$salt);
	
	//clean
	$userName = cleanInput($userName);
	$password = cleanInput($password);
	$crypted_password = cleanInput($crypted_password);
	
	//Formulate the query
	$query = "SELECT password 
			FROM user
			WHERE userID = '$userName'
				AND password = '$password'";
				
	//Execute the query
	$result = executeQuery($query);
	
	//Should be exactly one row
	if (mysql_num_rows($result) != 1) return false;
	else return true;
}

//Main------

session_start();
$authenticated = false;

//Get data collected from the user
$appUserName = $_POST["txtUserName"];
$appPassword = $_POST["txtPassword"];

$authenticated = authenticateUser($appUserName,$appPassword);
if ($authenticated == true)
{
	//Register the customer ID
	$_SESSION['authenticatedUser'] = $appUserName;
	
	//Register the remote IP address
	$_SESSION['loginIpAddress'] = $_SERVER['REMOTE_ADDR'];
}
else
{
	//The authentication failed
	$_SESSION['loginMessage'] = "Could not connect to the system as \"$appUserName\"";
}

//Relocate back to the login page
header("Location: home.php");
?>