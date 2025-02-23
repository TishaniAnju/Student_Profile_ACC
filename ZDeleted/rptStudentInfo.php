<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/print.css" rel="stylesheet" type="text/css" media="screen,projection,print" />
<style type='text/css' media='print'>
	@page {size:A4; size:portrait}
	#btnPrint {display : none}
</style>
<title>Student Information Report - Student Management System - Buddhist & Pali University of Sri Lanka</title>
</head>

<body>
<?php 
	include('dbAccess.php');
  	include('authcheck.inc.php');
	
	$regNo = cleanInput($_GET['lstRegNo']);
	
	$result = executeQuery("SELECT * FROM student WHERE regNo='$regNo'");
	$row = mysql_fetch_array($result);
?>
	<h3 align="center">Student Information Report</h3>
	<table align="center" width="80%">
    	<tr><td width="30%"><b>Reg. No.:</b></td><td width="70%"><?php echo $row['regNo'] ?></td></tr>
    	<tr><td><b>Name:</b></td><td><?php echo $row['nameEnglish'] ?></td></tr>
        <tr><td><b>Address:</b></td><td><?php echo $row['addressE1']." ,".$row['addressE2']." ,".$row['addressE3'] ?></td></tr>
        <tr><td><b>District:</b></td><td><?php echo $row['district'] ?></td></tr>
        <tr><td><b>Entry Type:</b></td><td><?php echo $row['entryType'] ?></td></tr>
        <tr><td><b>Year of Entrance:</b></td><td><?php echo $row['yearEntry'] ?></td></tr>
        <tr><td><b>Faculty:</b></td><td><?php echo $row['faculty'] ?></td></tr>
        <tr><td><b>Degree Type:</b></td><td><?php echo $row['degreeType'] ?></td></tr>
        <tr><td><b>NIC/Passport No.:</b></td><td><?php echo $row['id_pp_No'] ?></td></tr>
        <tr><td><b>Contact No.:</b></td><td><?php echo $row['contactNo'] ?></td></tr>
        <tr><td><b>Email:</b></td><td><?php echo $row['email'] ?></td></tr>
        <tr><td><b>Birthday:</b></td><td><?php echo $row['birthday'] ?></td></tr>
        <tr><td><b>Citizenship:</b></td><td><?php echo $row['citizenship'] ?></td></tr>
        <tr><td><b>Nationality:</b></td><td><?php echo $row['nationality'] ?></td></tr>
        <tr><td><b>Religion:</b></td><td><?php echo $row['religion'] ?></td></tr>
        <tr><td><b>Civil Status:</b></td><td><?php echo $row['civilStatus'] ?></td></tr>
        <tr><td><b>Name of Guardian:</b></td><td><?php echo $row['guardName'] ?></td></tr>
        <tr><td><b>Address of Guardian:</b></td><td><?php echo $row['guardAddress'] ?></td></tr>
        <tr><td><b>Contact No. of Guardian:</b></td><td><?php echo $row['guardContactNo'] ?></td></tr>
        <tr><td valign="top"><b>Enrolled Subjects:</b></td>
        	<td>
<?php
		$result = executeQuery("SELECT codeEnglish, nameEnglish FROM studentenrolment JOIN subject ON studentenrolment.subjectID=subject.subjectID WHERE indexNo='".$row['indexNo']."'");
		while ($row = mysql_fetch_array($result))
		{
			echo $row['codeEnglish']." - ".$row['nameEnglish']."<br/>";
		}
?>         		
            </td>
        </tr>
	</table>
</body>
</html>
