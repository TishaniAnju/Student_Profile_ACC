<?php
include('dbAccess.php');
$db = new DBOperations();
include('authcheck.inc.php');

$entryYear = $db->cleanInput($_GET['lstEntryYear']);
$subjectCode = $db->cleanInput($_GET['lstSubject']);
$medium = $db->cleanInput($_GET['lstMedium']);
$degree = $db->cleanInput($_GET['lstDegree']);
?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student Registration Report - Student Management System - Buddhist & Pali University of Sri Lanka</title>
<script type="text/javascript" src="lib/tablesort/tablesort.js"></script>
<link href="css/print.css" rel="stylesheet" type="text/css" media="screen,print,projection" />
<style type='text/css' media='print'>
	@page {size:A4; size:landscape}
	#btnPrint {display : none}
</style>

<div align="right"><input type="button" id="btnPrint" value="Print" onClick="window.print();return false"/></div>
<h1 align="center"><font size="+3">Student Enrollment for Subject</font></h1>
<h2 align="center"><font size="+1">Subject</font><font size="+1"> : 
  <?php
    $resultS = $db->executeQuery("SELECT subjectID, nameEnglish FROM subject
	                         WHERE codeEnglish = '$subjectCode'"); 
	//$rowS = mysql_fetch_array($resultS);
	$rowS = $db->Next_Record($resultS);
	$subjectID = $rowS['subjectID'];
  
    echo $subjectCode.' - '.$rowS['nameEnglish']; ?>
  </font></h2>
<h2 align="center"><font size="+1">Entrance Year: 
  <?php echo $entryYear ?>
  </font></h2>
<p align="center"><font size="+1">Degree : 
  <?php echo $degree ?>
  - (Medium : 
  <?php echo $medium ?>
  ) </font></p>
</head>
	
<table width="618" border="1" align="center" cellpadding="2" cellspacing="0">
  <thead>
    <tr style="height:50px;"> 
      <th width="63">Serial No</th>
      <th width="99">Registration No</th>
      <th width="100">Index No</th>
      <th width="315">Name</th>
    </tr>
  </thead>
  <tbody>
    <?php
	if ($medium == 'All') {
	   $sqlMedium = " ";
	} else if ($medium == 'Sinhala') {
	   $sqlMedium = "and (s.medium = 'Sinhala') ";
	} else if ($medium == 'English') {
	   $sqlMedium = "and (s.medium = 'English') ";
	}  
	
	if ($degree == 'All') {
	   $sqlDegree = " ";
	} else if ($degree == 'General') {
	     $sqlDegree = "and (s.degreeType = 'General') ";
	} else if ($degree == 'Special-All') {
	     $sqlDegree = "and (Left(s.degreeType,1) = 'S') ";
	} else if ($degree == 'Special-A') {
	     $sqlDegree = "and (s.degreeType = 'Special-A') ";
	} else if ($degree == 'Special-BC') {
	     $sqlDegree = "and (s.degreeType = 'Special-BC') ";
	} else if ($degree == 'Special-BP') {
	     $sqlDegree = "and (s.degreeType = 'Special-BP') ";
	} else if ($degree == 'Special-P') {
	     $sqlDegree = "and (s.degreeType = 'Special-P') ";
	} else if ($degree == 'Special-S') {
	     $sqlDegree = "and (s.degreeType = 'Special-S') ";
	} else if ($degree == 'Special-Sin') {
	     $sqlDegree = "and (s.degreeType = 'Special-Sin') ";
	}	  
	
	$sqlExec = "SELECT s.title,s.nameEnglish,s.regNo,s.indexNo FROM student s, studentenrolment e 
	                         WHERE (s.yearEntry ='$entryYear') and (s.regNo = e.regNo) and 
							       (e.subjectID = '$subjectID') " . $sqlMedium . $sqlDegree . 
								   "ORDER BY regNo";
	$result = $db->executeQuery($sqlExec);
	$i =1; 
	//while ($row = mysql_fetch_array($result))
	while($row = $db->Next_Record($result))

		{
		?>
    <tr> 
      <td align="center"> 
        <?php echo $i; ?>
      </td>
      <td align="left"> 
        <?php echo $row['regNo'];?>
      </td>
      <td align="center"> 
        <?php echo $row['indexNo'];?>
      </td>
      <td align="left"> 
        <?php echo $row['title']." ".$row['nameEnglish'];?>
      </td>
      <?php 
			$i++;
	  }		
	  ?>
    </tr>
  </tbody>
</table>    
</html>
