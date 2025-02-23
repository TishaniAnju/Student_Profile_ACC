<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<link href="css/print.css" rel="stylesheet" type="text/css" media="screen,projection,print" />-->
<style type='text/css' media='print'>
	@page {size:A4; size:portrait}
	#btnPrint {display : none}
</style>
<title>Academic Transcript - Student Management System - Buddhist & Pali University of Sri Lanka</title>
</head>

<body>
<?php 
	include('dbAccess.php');
	include('authcheck.inc.php');
	
	$type = $_GET['type'];
	$indexNo = cleanInput($_GET['indexNo']);
	$acYear = $_GET['acYear'];
	$acYear = $_GET['acYear'];
	$withMarks = $_GET['withMarks'];
	$exPeriod = $_GET['exPeriod'];
	$yeartime= $acYear.' '.$exPeriod;
	$result = executeQuery("SELECT nameEnglish,degreeType,regNo FROM student WHERE indexNo='$indexNo'");
	$studentName = mysql_result($result,0,'nameEnglish');
        $regNo = mysql_result($result,0,'regNo');
	$degreeType = mysql_result($result,0,'degreeType');
?>
	<div align="right"><input type="button" id="btnPrint" value="Print" onClick="window.print();return false"/></div>
    <h2 align="center">Buddhist & Pali University of Sri Lanka</h2>
    <h3 align="center">Academic Transcript</h3>
    <p align="right">Date of Issue : <?php echo date('d-m-Y'); ?></p>

<?php
	if ($type<>'Full')
	{
		echo "<p>Index Number : $indexNo</p>";
                echo "<p>Registration No :$regNo</p>";
		echo "<p>Student Name : $studentName</p>";
                echo "<p><b><u>Shasthravadi ($degreeType) degree(Internal)</u></b></p>";
              //echo "<></>";
switch ($type)
                    {
                    case "1":
                      echo "<b><u>First year First semester Examination - $yeartime<u></b>";
                      $level = 1;
                      break;
                    case "2":
                      echo "<b><u>First year Second semester Examination - $yeartime</u></b>";
                      $level = 1;
                      break;
                    case "3":
                      echo "<b><u>Second year First semester Examination - $yeartime</u></b>";
                      $level = 2;
                      break;
                    case "4":
                      echo "<b><u>Second year Second semester Examination - $yeartime</u></b>";
                      $level = 2;  
                      break;
                    case "5":
                      echo "<b><u>Third year First semester Examination - $yeartime</u></b>";
                      $level = 3;  
                      break;
                    case "6":
                      echo "<b><u>Third year 2nd semester Examination - $yeartime</u></b>";
                      $level = 3;  
                      break;
                    case "7":
                      echo "<b><u>Fourth year First semester Examination - $yeartime</u></b>";
                      $level = 4;  
                      break;
                    case "8":
                      echo "<b><u>Fourth year 2nd semester Examination - $yeartime</u></b>";
                      $level = 4;  
                      break;
                    default:
                      echo "Your favorite";
                    }

///
       /* 
		if ($type=='GAQ') {$exam = "General Arts Qualifying Examination (Internal)"; $level = 1;}
		else if ($type=='Part1')
		{
			if ($degreeType=='General') {$exam = "General Arts Degree Part I Examination (Internal)"; $level = 2;}
			else {$exam = "Special Arts Degree Part I Examination (Internal)"; $level = 2;}
		}
		else if ($type=='Part2') 
		{
			if ($degreeType=='General') {$exam = "General Arts Degree Part II Examination (Internal)"; $level = 3;}
			else {$exam = "Special Arts Degree Part II Examination (Internal)"; $level = 3;}
		}
		else if ($type=='Part3') {$exam = "Special Arts Degree Part III Examination (Internal)"; $level = 4;}
		echo "<h4 align='center'><u>$exam</u></h4>";
		echo "<h4 align='center'><u>November/December $acYear</u></h4>";
	*/

		$result = executeQuery("SELECT codeEnglish,nameEnglish,grade,marks,effort FROM exameffort JOIN subject ON exameffort.subjectID=subject.subjectID WHERE indexNo='$indexNo' AND level='$level' AND effortID IN (SELECT effortID FROM exameffort JOIN (SELECT subjectID,MAX(marks) as marks FROM exameffort GROUP BY subjectID) AS temp_ee ON exameffort.subjectID=temp_ee.subjectID AND exameffort.marks=temp_ee.marks)");
		$comment = ""; $numFailedSubjects = 0;
		
		while ($row = mysql_fetch_array($result))
		{
			if ($row['marks']<40)
			{
				$numFailedSubjects +=1;
				if ($numFailedSubjects>2 && $type=='GAQ')
				{
					$comment = "We are sorry to inform that you have not fullfilled the requirements to pass the above examination. Your gradings are mentioned below.";
					break;
				}
				elseif ($numFailedSubjects>1 && $type<>'GAQ')
				{
					$comment = "We are sorry to inform that you have not fullfilled the requirements to pass the above examination. Your gradings are mentioned below.";
					break;
				}
				$avgMark = queryOfQuery($result,"marks");
				$avgMark = array_sum($avgMark[0])/count($avgMark[0]);
				if ($avgMark>=40) $comment = "This is to inform that you have passed the above examination. Your gradings are mentioned below.";
				else {$comment = "We are sorry to inform that you have not fullfilled the requirements to pass the above examination. Your gradings are mentioned below."; break;}
			}
			else $comment = "This is to inform that you have passed the above examination. Your gradings are mentioned below.";
		}
		echo "<p>$comment</p>";
	
?>
        <table border="0" width="100%" align="center">
        	<tr>
            	<th colspan="2"><u>Study Unit</u></th>
                <th><u>Grade</u></th>
				<?php if ($withMarks=='on') echo "<th><u>Marks</u></th>"; ?>
                <th><u>Effort</u></th>
           	</tr>
<?php
		if (mysql_num_rows($result)>0) mysql_data_seek($result,0);
		while ($row = mysql_fetch_array($result))
		{
			echo "<tr align='center'><td>".$row['codeEnglish']."</td><td align='left'>".$row['nameEnglish']."</td><td>".$row['grade']."</td>";
			if ($withMarks=='on') echo "<td>".$row['marks']."</td>";
			echo "<td>".$row['effort']."</td></tr>";
		}	
		echo "</table>";
	}
	
	elseif ($type=='Full')
	{
		function getStudyUnits($indexNo,$exam,$level)
		{
			echo "<tr><td align='left' colspan='4'><u>$exam</u></td></tr>";
			$result = executeQuery("SELECT codeEnglish,nameEnglish,grade,marks,effort FROM exameffort JOIN subject ON exameffort.subjectID=subject.subjectID WHERE indexNo='$indexNo' AND level='$level' AND effortID IN (SELECT effortID FROM exameffort JOIN (SELECT subjectID,MAX(marks) as marks FROM exameffort GROUP BY subjectID) AS temp_ee ON exameffort.subjectID=temp_ee.subjectID AND exameffort.marks=temp_ee.marks)");
			while ($row=mysql_fetch_array($result))
			{
				echo "<tr align='center'><td>".$row['codeEnglish']."</td><td align='left'>".$row['nameEnglish']."</td><td>".$row['grade']."</td>";
				if ($GLOBALS['withMarks']=='on') echo "<td>".$row['marks']."</td>";
				echo "<td>".$row['effort']."</td></tr>";
			}
			if (mysql_num_rows($result)>0) mysql_data_seek($result,0);
			$comment = false; $numFailedSubjects = 0;
			while ($row = mysql_fetch_array($result))
			{
				if ($row['marks']<40)
				{
					$numFailedSubjects +=1;
					if ($numFailedSubjects>2 && $level==1) {$comment = false; break;}
					elseif ($numFailedSubjects>1 && level<>1) {$comment = false; break;}
					$avgMark = queryOfQuery($result,"marks");
					$avgMark = array_sum($avgMark[0])/count($avgMark[0]);
					if ($avgMark>=40) $comment = true;
					else {$comment = false; break;}
				}
				else $comment = true;
			}
			return $comment;
		}
		
		function getDegreeClass($indexNo)
		{
			$result = executeQuery("SELECT codeEnglish,nameEnglish,grade,marks,effort FROM exameffort JOIN subject ON exameffort.subjectID=subject.subjectID WHERE indexNo='$indexNo' AND level<>'1' AND effortID IN (SELECT effortID FROM exameffort JOIN (SELECT subjectID,MAX(marks) as marks FROM exameffort GROUP BY subjectID) AS temp_ee ON exameffort.subjectID=temp_ee.subjectID AND exameffort.marks=temp_ee.marks)");
			$failedSubjects = queryOfQuery($result,"codeEnglish",false,"grade","D,E");
			$failedSubjects = count($failedSubjects[0]);
			$goodSubjects = queryOfQuery($result,"codeEnglish",false,"grade","A,B");
			$goodSubjects = count($goodSubjects[0]);
			$veryGoodSubjects = queryOfQuery($result,"codeEnglish",false,"grade","A");
			$veryGoodSubjects = count($veryGoodSubjects[0]);
			$avgMark = queryOfQuery($result,"marks");
			$avgMark = array_sum($avgMark[0])/count($avgMark[0]);
			$class = "";
			if ($failedSubjects>0) $class = "Pass";
			else
			{
				if (($veryGoodSubjects>=6) && ($avgMark>=65)) $class = "First Class";
				elseif (($goodSubjects>=6) && ($avgMark>=60) && (65>$avgMark)) $class = "Second Class Upper";
				elseif (($goodSubjects>=6) && ($avgMark>=55) && (60>$avgMark)) $class = "Second Class Lower";
			}
			return $class;
		}
		
		if ($degreeType=='General')
		{
			echo "<h4 align='center'><u>General Arts Degree Examination - $acYear(Internal)</u></h4>";
			echo "<p>This is to certify that $studentName sat for the General Arts Degree Examination held in November/December $acYear under Index No. $indexNo. Study units and grades offered are given below.</p>";
?>
            <table border='0' width='100%'>
                <tr>
                    <th colspan="2"><u>Study Unit</u></th>
                    <th><u>Grade</u></th>
                    <?php if ($withMarks=='on') echo "<th><u>Marks</u></th>"; ?>
                    <th><u>Effort</u></th>
                </tr>
<?php
			$gaq = getStudyUnits($indexNo,"General Arts Qualifying Examination",1);
			$part1 = getStudyUnits($indexNo,"General Arts Degree Part I Examination",2);
			$part2 = getStudyUnits($indexNo,"General Arts Degree Part II Examination",3);
			echo "</table>";
			if ($gaq && $part1 && part2)
			{
				$class = getDegreeClass($indexNo);
				echo "<p>Degree Result: $class</p>";
			}
			else echo "<p>Degree Result: Incomplete</p>";
		}
		else
		{
			echo "<h4 align='center'><u>Special Arts Degree Examination - $acYear(Internal)</u></h4>";
			$speciality = substr($degreeType,8);
			if ($speciality=='A') $speciality = "Archeology";
			elseif ($speciality=='BC') $speciality = "Buddhist Culture";
			elseif ($speciality=='BP') $speciality = "Buddhist Philosophy"; 
			elseif ($speciality=='P') $speciality = "Pali";
			elseif ($speciality=='S') $speciality = "Sanskrit";
			echo "<p>This is to certify that $studentName sat for the Special Arts Degree Examination ($speciality) held in November/December $acYear under Index No. $indexNo. Study units and grades offered are given below.</p>";
?>
            <table border='0' width='100%'>
                <tr>
                    <th colspan="2"><u>Study Unit</u></th>
                    <th><u>Grade</u></th>
                    <?php if ($withMarks=='on') echo "<th><u>Marks</u></th>"; ?>
                    <th><u>Effort</u></th>
                </tr>
<?php
			$gaq = getStudyUnits($indexNo,"General Arts Qualifying Examination",1);
			$part1 = getStudyUnits($indexNo,"Special Arts Degree Part I Examination",2);
			$part2 = getStudyUnits($indexNo,"Special Arts Degree Part II Examination",3);
			$part3 = getStudyUnits($indexNo,"Special Arts Degree Part III Examination",4);
			echo "</table>";
			if ($gaq && $part1 && part2 && part3)
			{
				$class = getDegreeClass($indexNo);
				echo "<p>Degree Result: $class</p>";
			}
			else echo "<p>Degree Result: Incomplete</p>";
		}
	}
?> 
	<br/>
	<table border="0" width="100%">
    	<tr valign="top">
        	<td width="30%">Prepared by:</td>
            <td width="30%">Checked by:</td>
            <td></td>
        </tr>
        <tr>
        	<td></td>
            <td></td>
            <td>N.A.S.K. Premachandra <br/>Asst. Registar (Examinations) <br/>for Registar</td>
        </tr>
    </table>
    <br/>
    <table border="0">
    	<tr><th colspan="3" align="left">Key to Grading</th></tr>
        <tr><td>A - (70-100)</td><td>B - (55-69)</td><td>C - (40-54)</td></tr>
        <tr><td>D - (30-39)</td><td>E - (0-29)</td><td>ab - Absent</td></tr>
    </table>
</body>
</html>
