<?php
include('dbAccess.php');
include('authcheck.inc.php');

$acYear = $_GET['txtAcYear'];
$lecturer = cleanInput($_GET['lstLecturer']);

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="css/print.css" rel="stylesheet" type="text/css" media="screen,projection,print" />
<style type='text/css' media='print'>
	@page {size:A4; size:landscape}
	#btnPrint {display : none}
</style>
<title>Lecturer Time Table - Student Management System - Buddhist & Pali University of Sri Lanka</title>

<div align="right"><input type="button" id="btnPrint" value="Print" onClick="window.print();return false"/></div>
<h2 style="margin-bottom:10px; margin-top:15px;" align="center" >ශ්‍රී ලංකා බෞ‍ද්ධ හා පාලි විශ්වවි‍ද්‍යාලය</h2>
<h2 style="margin-bottom:8px; margin-top:10px;" align="center">Buddhist and Pali University Of Sri Lanka</h2>
<h3 style="margin-bottom:0px; margin-top:0px;" align="center">අධ්‍යයන වර්ෂය:<?php echo $acYear ?> </h3>
<h3 style="margin-top: 2px; margin-bottom:2px;" align="center">Academic year:<?php echo $acYear ?> </h3>
<h4 style="margin-top:2px; margin-bottom:3px;" align="left">Lecturer :
<?php $rs= executeQuery("SELECT name FROM lecturer WHERE epfNo='$lecturer'");
	$lec =mysql_fetch_array($rs); 
	echo $lec['name']; ?> </h4>
</head>
	<body>
	<table width="100%" border="1">
	
	<tr height="100px" style="font-size:13px"><th></th>
    
	<?php 
	$dayOfWeek = array("Monday","Tuesday","Wednesday","Thursday","Friday");
	$timeSlot= array("8.30-9.30 a.m","9.30-10.30 a.m","10.30-11.30 a.m","12.30-01.30 p.m","01.30-02.30 p.m","02.30-03.30 p.m","03.30-04.30 p.m");
	for($i=0;$i<count($timeSlot);$i++)
	{
    echo "<th>".$timeSlot[$i]."</th><th><div class=\"box_rotate\">ශාලා අංකය:<br/> Hall No:</div></th>";   
    
	}
	?>
	</tr>		 
	 <?php
     for ($i=0;$i<count($dayOfWeek);$i++)
	 {
	$rs = executeQuery("SELECT timeSlot,timetable.subjectID,venueNo,medium,codeEnglish,codeSinhala FROM timetable JOIN timeslot ON timetable.slotID=timeslot.slotID JOIN subject ON subject.subjectID=timetable.subjectID JOIN lecturer ON lecturer.epfNo=timetable.epfNo WHERE timeslot.dayOfWeekE='$dayOfWeek[$i]' AND lecturer.epfNo='$lecturer' ORDER BY timeSlot");
	
	$result=executeQuery("SELECT dayOfWeekS FROM timeslot WHERE dayOfWeekE='$dayOfWeek[$i]'");	
	$day=mysql_fetch_array($result);
	
	echo "<tr><td>".$day['dayOfWeekS']."<br/>".$dayOfWeek[$i]."</td>";
		
	for($j=0;$j<count($timeSlot);$j++)
		{
		$rs1 = queryOfQuery($rs, "*", false, "timeSlot",$timeSlot[$j]);
				
		if(!count($rs1)==0)
			{
			echo "<td align=\"center\">";
			for ($k=0;$k<count($rs1);$k++)
				{
				//echo count($rs1);
				if($rs1[$k]['medium']=='Sinhala'){echo $rs1[$k]['codeSinhala']."<br/>";}
				elseif($rs1[$k]['medium']=='English'){echo $rs1[$k]['codeSinhala']."<br/>";}
				}
			
			echo "</td><td align=\"center\">";
			for ($k=0;$k<count($rs1);$k++)
				{
				//echo "hoo";
                echo $rs1[$k]['venueNo']."<br/>";
				}
				echo "</td>";
			}
		else echo "<td align='center'>-</td><td align='center'>-</td>";
		}
		echo "</tr>";
		}
     ?>
   	 
  </table>
  <table style="border:none">
 <?php
  $result = executeQuery("SELECT DISTINCT codeSinhala,nameSinhala,codeEnglish,nameEnglish,subject.subjectID FROM timetable JOIN subject ON subject.subjectID=timetable.subjectID JOIN lecturer ON lecturer.epfNo=timetable.epfNo WHERE lecturer.epfNo='$lecturer' ORDER BY subject.subjectID");
	while($subject=mysql_fetch_array($result))	
	{
	echo"<tr style=\"border:none\"><td style=\"border:none\">".$subject['codeSinhala']."-".$subject['nameSinhala']."</td><td width=\"10\"></td><td style=\"border:none\">".$subject['codeEnglish']."-".$subject['nameEnglish']."</td></tr>";
	}
	?>
    <tr style="border:none">
    </table>
</body>
</html>



