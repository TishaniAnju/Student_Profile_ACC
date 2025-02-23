<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/print.css" rel="stylesheet" type="text/css" media="screen,projection,print" />
<style type='text/css' media='print'>
	@page {size:A4; size:portrait}
	#btnPrint {display : none}
</style>
<title>Admission Card - Student Management System - Buddhist & Pali University of Sri Lanka</title>
</head>

<body>
<?php 
	include('dbAccess.php');
  	include('authcheck.inc.php');
	
	$indexNo = cleanInput($_GET['indexNo']);
	$acYear = cleanInput($_GET['acYear']);
	
	$result = executeQuery("SELECT nameEnglish,degreeType FROM student WHERE indexNo='$indexNo'");
	$studentName = mysql_result($result,0,'nameEnglish');
	$degreeType = mysql_result($result,0,'degreeType');
	
	$result = executeQuery("SELECT codeEnglish,nameEnglish,level,date,time,venue FROM examschedule JOIN subject ON examschedule.subjectID=subject.subjectID WHERE acYear='$acYear' AND examschedule.subjectID IN (SELECT subjectID FROM exameffort WHERE indexNo='$indexNo') ORDER BY date,time");
	if (mysql_num_rows($result)==0) die("The student with index number $indexNo is not registered for any exams in $acYear");
	
	$level = queryOfQuery($result,"level");
	$exam = "";
	asort(array_count_values($level[0]));
	$level = $level[0]['level'];
	if ($level==1) $exam = "General Arts Qualifying Examination";
	elseif ($level==2)
	{
		if ($degreeType=='General') $exam = "General Arts Degree Part I Examination";
		else $exam = "Special Arts Degree Part I Examination";
	}
	elseif ($level==3)
	{
		if ($degreeType=='General') $exam = "General Arts Degree Part II Examination";
		else $exam = "Special Arts Degree Part II Examination";
	}
	elseif ($level==4) $exam = "Special Arts Degree Part III Examination";

?>
	<div align="right"><input type="button" id="btnPrint" value="Print" onClick="window.print();return false"/></div>
    <h2 align="center">Buddhist & Pali University of Sri Lanka</h2>
    <h3 align="center"><?php echo $exam." ".$acYear; ?></h3>
    <h3 align="center">Admission Card and Signature Form</h3>
    <p>(This form should be handed over to the supervisor on the first day of the examination)</p>
    <p><b>Name of Candidate : </b><?php echo $studentName; ?></p>
    <p><b>Index Number : </b><?php echo $indexNo; ?></p>
    <p><b>Examination Center : </b>Buddhist and Pali University of Sri Lanka, Gurulugomi Mawatha, Pitipana North, Homagama.</p>
    <p><b>Attestation of Signature : </b></p>
    <p>Every candidate should get his/her signature attested by one of the following:-</p>
    <p>Principal of a Pirivena, Chief Incumbent of a Temple, a Priest in Charge of a place of Worship, A Principal of a school, a Grama Sevaka, a Justice of the Peace, or a Staff Officer in a Government Department, Local Government Department or State Corporation.</p>
    <br/>
    <p align="right">Asst. Registrar(Examinations) For Registrar</p>
    <br/>
    <p>Signature of the Candidate :...........................</p>
    <p>Date :...........................</p>
    <br/>
    <p><b>Attestation : </b></p>
    <p>I hereby certify that the above candidate is known to me personally and has placed his/her signature before me on this day of ...........................</p>
    <p>Signature of the Attestor........................... Date...........................</p>
    <p>Name, Designation and the Address of the Attestor</p>
    <p>....................................................................................</p>
    <p>....................................................................................</p>
    <p>....................................................................................</p>
    <br/>
    <div style="page-break-after:always"></div>
    
    <h3>Signature Form</h3>
    <p>The candidate should place his signature before the Supervisor/Invigilator on every occasion he sits a paper.</p>
    <table width="100%">
    	<tr><th width="30%">Subject</th><th>Date</th><th>Medium</th><th>Signature of Applicant</th><th>Signature of Supervisor</th></tr>
        <?php 
		for ($i=1;$i<=30;$i++)
		{
			echo "<tr><td>$i</td><td></td><td></td><td></td><td></td></tr>";
		}
		?>
    </table>
    <br/>
    <p>Identity Certificate No  : ...................</p>
    <p>Signature of the Supervisor : ...................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date : .................</p>
	<br/>
    <div style="page-break-after:always"></div>
    
    <h3 align="center">Exam Timetable <?php echo $acYear; ?></h3>
    <p><b>Index Number : </b><?php echo $indexNo; ?></p>
    <p><b>Name of Candidate : </b><?php echo $studentName; ?></p>
    <?php
	if (mysql_num_rows($result)>0)
	{
	?>
    	<table width="100%">
        	<tr><th>Date</th><th>Time</th><th>Code</th><th>Subject</th><th>Venue</th></tr>
    		<?php 
			while ($row=mysql_fetch_array($result))
			{
				echo "<tr><td>".$row['date']."</td><td>".$row['time']."</td><td>".$row['codeEnglish']."</td><td>".$row['nameEnglish']."</td><td>".$row['venue']."</td></tr>";
			}
			?>
   		</table>
    <?php
	}
	?>
</body>
</html>
