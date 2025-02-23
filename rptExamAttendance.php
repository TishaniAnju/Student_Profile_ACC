<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Attendance - Student Management System (External) - Buddhist & Pali University of Sri Lanka</title>
<link href="css/print.css" rel="stylesheet" type="text/css" />
<style type='text/css' media='print'>
	@page {size:A4; size:portrait}
	#btnPrint {display : none}
</style>
<?php
//2021-03-25 start  include('dbAccess.php');
require_once("dbAccess.php");
$db = new DBOperations();
//2021-03-25 end
include('authcheck.inc.php');

//2021-03-25 start  $acYear = cleanInput($_GET['lstAcYear']);
$acYear = $db->cleanInput($_GET['lstAcYear']);
//2021-03-25 end
//2021-03-25 start  $subjectID = cleanInput($_GET['lstSubject']);
$subjectID = $db->cleanInput($_GET['lstSubject']);
//2021-03-25 end
//2021-03-25 start  $result = executeQuery("SELECT codeEnglish, nameEnglish FROM subject WHERE subjectID=$subjectID");
$result = $db->executeQuery("SELECT codeEnglish, nameEnglish FROM subject WHERE subjectID=$subjectID");
//2021-03-25 end
//2021-03-25 start  $subject = mysql_fetch_array($result);
$subject = $db->Next_Record($result);
//2021-03-25 end
?>
<div align="right"><input type="button" id="btnPrint" value="Print" onClick="window.print();return false"/></div>
<h2 align="center">Buddhist & Pali University of Sri Lanka</h2>
<h3 align="center">Exam Attendance Sheet - <?php echo $acYear; ?></h3>
<h4 align="center"><?php echo $subject['codeEnglish']." - ".$subject['nameEnglish']; ?></h4>
</head>

<body>
	<table width="100%">
    	<thead>
        	<tr>
            	<th></th><th>Reg. No.</th><th>Index No.</th><th>Name</th><th>Medium</th><th>Signature</th>
            </tr>
   		</thead>
        <tbody>
<?php
			//2021-03-25 start  $result = executeQuery("SELECT regNo,student.indexNo,nameEnglish,medium FROM student JOIN exameffort ON student.indexNo=exameffort.indexNO WHERE acYear=$acYear AND subjectID=$subjectID");
			$result = $db->executeQuery("SELECT regNo,student.indexNo,nameEnglish,medium FROM student JOIN exameffort ON student.indexNo=exameffort.indexNO WHERE acYear=$acYear AND subjectID=$subjectID");
			//2021-03-25 end
			//2021-03-25 start  for ($i=1;$i<=mysql_num_rows($result);$i++)
			for ($i=1;$i<=$db->Row_Count($result);$i++)
			//2021-03-25 end
			{
				//2021-03-25 start  $row = mysql_fetch_array($result);
				$row = $db->Next_Record($result);
				//2021-03-25 end
				echo "<tr><td>$i</td><td>".$row['regNo']."</td><td>".$row['indexNo']."</td><td>".$row['nameEnglish']."</td><td>".$row['medium']."</td><td></td></tr>";
			}
?>
        </tbody>
    </table>
</body>
</html>
