<?php
//2021-03-25 start  include('dbAccess.php');
require_once("dbAccess.php");
$db = new DBOperations();
  //2021-03-25 end
include('authcheck.inc.php');

//2021-03-25 start  $entryYear = cleanInput($_GET['lstEntryYear']);
$entryYear = $db->cleanInput($_GET['lstEntryYear']);
//2021-03-25 end
?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Applicants Report - Student Management System - Buddhist & Pali University of Sri Lanka</title>
<script type="text/javascript" src="lib/tablesort/tablesort.js"></script>
<link href="css/print.css" rel="stylesheet" type="text/css" media="screen,print,projection" />
<style type='text/css' media='print'>
	@page {size:A3; size:landscape}
	#btnPrint {display : none}
</style>

<div align="right"><input type="button" id="btnPrint" value="Print" onClick="window.print();return false"/></div>
<h1 align="center"><font size="+3">Buddhist and Pali University</font></h1>
<h2 align="center"><font size="+2"><?php echo $entryYear ?>  Statisitics</font></h2>
<h3 align="center">&nbsp;</h3>

<?php
  $LocP = 0;
  $LocL = 0;
  $LocT = 0;
  //2021-03-25 start  $result = executeQuery("SELECT count(appNo) as N FROM applicant where appType = 'Local' and titleE = 'Ven.' and entryYear = '$entryYear'");
  $result = $db->executeQuery("SELECT count(appNo) as N FROM applicant where appType = 'Local' and titleE = 'Ven.' and entryYear = '$entryYear'");
  //2021-03-25 end
  $LocP = mysql_result($result,0,"N");
  //2021-03-25 start  $result = executeQuery("SELECT count(appNo) as N FROM applicant where appType = 'Local' and titleE = 'Mr.' and entryYear = '$entryYear'");
  $result = $db->executeQuery("SELECT count(appNo) as N FROM applicant where appType = 'Local' and titleE = 'Mr.' and entryYear = '$entryYear'");
  //2021-03-25 end
  $LocL = mysql_result($result,0,"N");
  //2021-03-25 start  $result = executeQuery("SELECT count(appNo) as N FROM applicant where appType = 'Local' and entryYear = '$entryYear'");
  $result = $db->executeQuery("SELECT count(appNo) as N FROM applicant where appType = 'Local' and entryYear = '$entryYear'");
  //2021-03-25 end
  $LocT = mysql_result($result,0,"N");
  
  $ForP = 0;
  $ForL = 0;
  $ForT = 0;
  //2021-03-25 start  $result = executeQuery("SELECT count(appNo) as N FROM applicant where appType <> 'Local' and titleE = 'Ven.' and entryYear = '$entryYear'");
  $result = $db->executeQuery("SELECT count(appNo) as N FROM applicant where appType <> 'Local' and titleE = 'Ven.' and entryYear = '$entryYear'");
  //2021-03-25 end
  $ForP = mysql_result($result,0,"N");
  //2021-03-25 start  $result = executeQuery("SELECT count(appNo) as N FROM applicant where appType <> 'Local' and titleE = 'Mr.' and entryYear = '$entryYear'");
  $result = $db->executeQuery("SELECT count(appNo) as N FROM applicant where appType <> 'Local' and titleE = 'Mr.' and entryYear = '$entryYear'");
  //2021-03-25 end
  $ForL = mysql_result($result,0,"N");
  //2021-03-25 start  $result = executeQuery("SELECT count(appNo) as N FROM applicant where appType <> 'Local' and entryYear = '$entryYear'");
  $result = $db->executeQuery("SELECT count(appNo) as N FROM applicant where appType <> 'Local' and entryYear = '$entryYear'");
  //2021-03-25 end
  $ForT = mysql_result($result,0,"N");
  
  $SelLocP = 0;
  $SelLocL = 0;
  $SelLocT = 0;
  //2021-03-25 start  $result = executeQuery("SELECT count(appNo) as N FROM applicant where appType = 'Local' and titleE = 'Ven.' and entryYear = '$entryYear' and qualified = 'Yes'");
  $result = $db->executeQuery("SELECT count(appNo) as N FROM applicant where appType = 'Local' and titleE = 'Ven.' and entryYear = '$entryYear' and qualified = 'Yes'");
  //2021-03-25 end
  $SelLocP = mysql_result($result,0,"N");
  //2021-03-25 start  $result = executeQuery("SELECT count(appNo) as N FROM applicant where appType = 'Local' and titleE = 'Mr.' and entryYear = '$entryYear' and qualified = 'Yes'");
  $result = $db->executeQuery("SELECT count(appNo) as N FROM applicant where appType = 'Local' and titleE = 'Mr.' and entryYear = '$entryYear' and qualified = 'Yes'");
  //2021-03-25 end
  $SelLocL = mysql_result($result,0,"N");
  //2021-03-25 start  $result = executeQuery("SELECT count(appNo) as N FROM applicant where appType = 'Local' and entryYear = '$entryYear' and qualified = 'Yes'");
  $result = $db->executeQuery("SELECT count(appNo) as N FROM applicant where appType = 'Local' and entryYear = '$entryYear' and qualified = 'Yes'");
  //2021-03-25 end
  $SelLocT = mysql_result($result,0,"N");
  
  $SelForP = 0;
  $SelForL = 0;
  $SelForT = 0;
  //2021-03-25 start  $result = executeQuery("SELECT count(appNo) as N FROM applicant where appType <> 'Local' and titleE = 'Ven.' and entryYear = '$entryYear' and qualified = 'Yes'");
  $result = $db->executeQuery("SELECT count(appNo) as N FROM applicant where appType <> 'Local' and titleE = 'Ven.' and entryYear = '$entryYear' and qualified = 'Yes'");
  //2021-03-25 end
  $SelForP = mysql_result($result,0,"N");
  //2021-03-25 start  $result = executeQuery("SELECT count(appNo) as N FROM applicant where appType <> 'Local' and titleE = 'Mr.' and entryYear = '$entryYear' and qualified = 'Yes'");
  $result = $db->executeQuery("SELECT count(appNo) as N FROM applicant where appType <> 'Local' and titleE = 'Mr.' and entryYear = '$entryYear' and qualified = 'Yes'");
  //2021-03-25 end
  $SelForL = mysql_result($result,0,"N");
  //2021-03-25 start  $result = executeQuery("SELECT count(appNo) as N FROM applicant where appType <> 'Local' and entryYear = '$entryYear' and qualified = 'Yes'");
  $result = $db->executeQuery("SELECT count(appNo) as N FROM applicant where appType <> 'Local' and entryYear = '$entryYear' and qualified = 'Yes'");
  //2021-03-25 end
  $SelForT = mysql_result($result,0,"N");  
?>

<table width="80%" border="1">
  <tr> 
    <td width="11%">&nbsp;</td>
    <td width="67%">Number of Local Applicants who are Priests</td>
    <td width="22%">
      <?php echo $LocP ?>
      </font></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>Number of Local Applicants who are Laymen</td>
    <td>
      <?php echo $LocL ?>
      </font></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>Total Number of Local Applicants</td>
    <td>
      <?php echo $LocT ?>
      </font></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>Number of Foreign Applicants who are Priests</td>
    <td>
      <?php echo $ForP ?>
    </td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>Number of Foreign Applicants who are Laymen</td>
    <td>
      <?php echo $ForL ?>
    </td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>Total Number of Foreign Applicants</td>
    <td>
      <?php echo $ForT ?>
    </td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>Number of Local Applicants Selected who are Priests</td>
    <td>
      <?php echo $SelLocP ?>
    </td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>Number of Local Applicants Selected who are Laymen</td>
    <td>
      <?php echo $SelLocL ?>
    </td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>Total Number of Local Applicants Selected</td>
    <td>
      <?php echo $SelLocT ?>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>Number of Foreign Applicants Selected who are Priests</td>
    <td>
      <?php echo $SelForP ?>
    </td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>Number of Foreign Applicants Selected who are Laymen</td>
    <td>
      <?php echo $SelForL ?>
    </td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
    <td>Total Number of ForeignApplicants Selected</td>
    <td>
      <?php echo $SelForT ?>
    </td>
  </tr>
</table>
<p align="center"><font size="+2"></font></p>
</head>
</html>
