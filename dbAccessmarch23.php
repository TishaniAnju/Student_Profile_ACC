<?php

$hostName = "localhost";
$userName = "root";
$password = "blank@123";
$databaseName = "registration";

function executeQuery($query)
{	
	$connection = @ mysql_connect($GLOBALS['hostName'],$GLOBALS['userName'],$GLOBALS['password']) or die("Cannot connect");
	if (!mysql_select_db($GLOBALS['databaseName'],$connection)) die("No such database found");
	$result = @ mysql_query($query,$connection) or die(mysql_errno($connection).": ".mysql_error($connection));
	mysql_close($connection);
	return $result;
}

function executeTransaction($quries)
{	
	$connection = @ mysql_connect($GLOBALS['hostName'],$GLOBALS['userName'],$GLOBALS['password']) or die("Cannot connect");
	if (!mysql_select_db($GLOBALS['databaseName'],$connection)) die("No such database found");
	$num_quaries = count($quries);
	$result = array();
	if ($num_quaries>0)
	{
		mysql_query("START TRANSACTION; ");
		for ($i=0;$i<$num_quaries;$i++)
		{
			$result[$i] = mysql_query($quries[$i]."; ") or die(mysql_errno($connection).": ".mysql_error($connection));
		}
		//if (in_array(false,$result)) mysql_query("ROLLBACK; ");
		mysql_query("COMMIT; ");
	}
	mysql_close($connection);
	return $result;
}

function queryOfQuery($rs, // The recordset to query
  $fields = "*", // optional comma-separated list of fields to return, or * for all fields
  $distinct = false, // optional true for distinct records
  $fieldToMatch = null, // optional database field name to match
  $valueToMatch = null) { // optional value to match in the field, as a comma-separated list
	
  //$numRows=array('0');
  $newRs = Array();
  $row = Array();
  $valueToMatch = explode(",",$valueToMatch);
  $matched = true;
  if (mysql_num_rows($rs)>0) 
  {
	  mysql_data_seek($rs, 0);
		  if($rs) {
			while ($row_rs = mysql_fetch_assoc($rs)){
			  if($fields == "*") {
				if($fieldToMatch != null) {
				  $matched = false;
				  if(is_integer(array_search($row_rs[$fieldToMatch],$valueToMatch))){
					$matched = true;
				  }
				}
				if($matched) $row = $row_rs;
			  }else{
				$fieldsArray=explode(",",$fields);
				foreach($fieldsArray as $field) {
				  if($fieldToMatch != null) {
					$matched = false;
					if(is_integer(array_search($row_rs[$fieldToMatch],$valueToMatch))){
					  $matched = true;
					}
				  }
				  if($matched) $row[$field] = $row_rs[$field];
				}
			  }
			  if($matched)array_push($newRs, $row);
			};
			if($distinct) {
			  sort($newRs);
			  for($i = count($newRs)-1; $i > 0; $i--) {
				if($newRs[$i] == $newRs[$i-1]) unset($newRs[$i]);
			  }
			}
		  }
	  mysql_data_seek($rs, 0);
	  return $newRs;
  }
  //else return false;
}

function cleanInput($value)
{
// Stripslashes
if (get_magic_quotes_gpc())
  {
  $value = stripslashes($value);
  }
// Quote if not a number
//if (!is_numeric($value))
  //{	
	$connection = @ mysql_connect($GLOBALS['hostName'],$GLOBALS['userName'],$GLOBALS['password']) or die("Cannot connect");
  	$value = mysql_real_escape_string($value,$connection);
  	mysql_close($connection);
  //}
return $value;
}
?>