
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
	$withMarks = $_GET['withMarks'];
		$exPeriod = $_GET['exPeriod'];
	$yeartime= $acYear.' '.$exPeriod;
	$result = executeQuery("SELECT nameSinhala,degreeType FROM student WHERE indexNo='$indexNo'");
	$studentName = mysql_result($result,0,'nameSinhala');
	$regNo = mysql_result($result,0,'regNo');
	$degreeType = mysql_result($result,0,'degreeType');
?>
	<div align="right"><input type="button" id="btnPrint" value="Print" onClick="window.print();return false"/></div>
    <h2 align="center">ශ්‍රී ලංකා බෞද්ධ හා පාලි විශ්ව විද්‍යාලය</h2>
    <h3 align="center">විභාග ප්‍රතිඵල ලේඛනය</h3>
    <p align="right">නිකුත් කල දිනය : <?php echo date('d-m-Y'); ?></p>

<?php
	if ($type<>'Full')
	{
		echo "<p>විභාග අංකය : $indexNo</p>";
		echo "<p>ලියාපදිංචි  අංකය : $regNo</p>";
		echo "<p>ශිෂ්‍යයාගේ නම : $studentName</p>";
		
		echo "<br/>";
                echo "<p><b><u>ශාස්ත්‍රවේදී ($degreeType) උපාධිය (අභ්‍යන්තර) </u></b></p>";
		/*
		if ($type=='GAQ') {$exam = "ප්‍රථම ශාස්ත්‍ර පරීක්ෂණය (අභ්‍යන්තර)"; $level = 1;}
		else if ($type=='Part1')
		{
			if ($degreeType=='General') {$exam = "සාමාන්‍ය ශාස්ත්‍රවේදී ප්‍රථම භාග පරීක්ෂණය (අභ්‍යන්තර)"; $level = 2;}
			else {$exam = "ිශේෂ ශාස්ත්‍රවේදී ප්‍රථම භාග පරීක්ෂණය (අභ්‍යන්තර)"; $level = 2;}
		}
		else if ($type=='Part2') 
		{
			if ($degreeType=='General') {$exam = "සාමාන්‍ය ශාස්ත්‍රවේදී දෙවන භාග පරීක්ෂණය (අභ්‍යන්තර)"; $level = 3;}
			else {$exam = "විශේෂ ශාස්ත්‍රවේදී දෙවන භාග පරීක්ෂණය (අභ්‍යන්තර)"; $level = 3;}
		}
		else if ($type=='Part3') {$exam = "විශේෂ ශාස්ත්‍රවේදී තෙවන භාග පරීක්ෂණය (අභ්‍යන්තර)"; $level = 4;}
		echo "<h4 align='center'><u>$exam</u></h4>";
		echo "<h4 align='center'><u>‍නොවැම්බර්/දෙසැම්බර් $acYear</u></h4>";
		*/
		switch ($type)
                    {
                    case "1":
                      echo "<b><u>  ප්‍රථම වර්ෂ  ප්‍රථම භාග පරීක්ෂණය - $yeartime<u></b>";
                      $level = 1;
                      break;
                    case "2":
                      echo "<b><u> ප්‍රථම වර්ෂ දෙවන භාග පරීක්ෂණය - $yeartime</u></b>";
                      $level = 1;
                      break;
                    case "3":
                      echo "<b><u> දෙවන වර්ෂ  ප්‍රථම භාග පරීක්ෂණය - $yeartime</u></b>";
                      $level = 2;
                      break;
                    case "4":
                      echo "<b><u> දෙවන වර්ෂ දෙවන භාග පරීක්ෂණය - $yeartime</u></b>";
                      $level = 2;  
                      break;
                    case "5":
                      echo "<b><u> තෙවන වර්ෂ  ප්‍රථම භාග පරීක්ෂණය - $yeartime</u></b>";
                      $level = 3;  
                      break;
                    case "6":
                      echo "<b><u> තෙවන වර්ෂ දෙවන භාග පරීක්ෂණය - $yeartime</u></b>";
                      $level = 3;  
                      break;
                    case "7":
                      echo "<b><u> සීව්වන වර්ෂ  ප්‍රථම භාග පරීක්ෂණය - $yeartime</u></b>";
                      $level = 4;  
                      break;
                    case "8":
                      echo "<b><u> සීව්වන වර්ෂ  ප්‍රථම භාග පරීක්ෂණය - $yeartime</u></b>";
                      $level = 4;  
                      break;
                    default:
                      echo "Your favorite";
                    }

		
		$result = executeQuery("SELECT codeSinhala,nameSinhala,grade,marks,effort FROM exameffort JOIN subject ON exameffort.subjectID=subject.subjectID WHERE indexNo='$indexNo' AND level='$level' AND effortID IN (SELECT effortID FROM exameffort JOIN (SELECT subjectID,MAX(marks) as marks FROM exameffort GROUP BY subjectID) AS temp_ee ON exameffort.subjectID=temp_ee.subjectID AND exameffort.marks=temp_ee.marks)");
		$comment = ""; $numFailedSubjects = 0;
		
		while ($row = mysql_fetch_array($result))
		{
			if ($row['marks']<40)
			{
				$numFailedSubjects +=1;
				if ($numFailedSubjects>2 && $type=='GAQ')
				{
					$comment = "ඉහත විභාගය සමත් වීම සඳහා වූ මූලික සුදුසුකම් ඔබ විසින් සපුරා නොමැත. ඔබගේ සාමාර්ථයන් පහත අයුරින් වේ.";
					break;
				}
				elseif ($numFailedSubjects>1 && $type<>'GAQ')
				{
					$comment = "ඉහත විභාගය සමත් වීම සඳහා වූ මූලික සුදුසුකම් ඔබ විසින් සපුරා නොමැත. ඔබගේ සාමාර්ථයන් පහත අයුරින් වේ.";
					break;
				}
				$avgMark = queryOfQuery($result,"marks");
				$avgMark = array_sum($avgMark[0])/count($avgMark[0]);
				if ($avgMark>=40) $comment = "ඉහත විභාගය සඳහා පෙනී සිටි ඔබ ඉන් සමත් වී ඇති බව දන්වා සිටිමි. ඔබගේ සාමාර්ථයන් පහත අයුරින් වේ.";
				else {$comment = "ඉහත විභාගය සමත් වීම සඳහා වූ මූලික සුදුසුකම් ඔබ විසින් සපුරා නොමැත. ඔබගේ සාමාර්ථයන් පහත අයුරින් වේ."; break;}
			}
			else $comment = "ඉහත විභාගය සඳහා පෙනී සිටි ඔබ ඉන් සමත් වී ඇති බව දන්වා සිටිමි. ඔබගේ සාමාර්ථයන් පහත අයුරින් වේ.";
		}
		echo "<p>$comment</p>";
?>
        <table border="0" width="100%" align="center">
        	<tr>
            	<th colspan="2"><u>විෂය</u></th>
                <th><u>ශ්‍රේණිය</u></th>
				<?php if ($withMarks=='on') echo "<th><u>ලකුණු</u></th>"; ?>
                <th><u>උත්සාහය</u></th>
           	</tr>
<?php
		if (mysql_num_rows($result)>0) mysql_data_seek($result,0);
		while ($row = mysql_fetch_array($result))
		{
			echo "<tr align='center'><td>".$row['codeSinhala']."</td><td align='left'>".$row['nameSinhala']."</td><td>".$row['grade']."</td>";
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
			$result = executeQuery("SELECT codeSinhala,nameSinhala,grade,marks,effort FROM exameffort JOIN subject ON exameffort.subjectID=subject.subjectID WHERE indexNo='$indexNo' AND level='$level' AND effortID IN (SELECT effortID FROM exameffort JOIN (SELECT subjectID,MAX(marks) as marks FROM exameffort GROUP BY subjectID) AS temp_ee ON exameffort.subjectID=temp_ee.subjectID AND exameffort.marks=temp_ee.marks)");
			while ($row=mysql_fetch_array($result))
			{
				echo "<tr align='center'><td>".$row['codeSinhala']."</td><td align='left'>".$row['nameSinhala']."</td><td>".$row['grade']."</td>";
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
			if ($failedSubjects>0) $class = "සමත්";
			else
			{
				if (($veryGoodSubjects>=6) && ($avgMark>=65)) $class = "පළමු පන්තිය";
				elseif (($goodSubjects>=6) && ($avgMark>=60) && (65>$avgMark)) $class = "දෙවන පෙල ඉහල පන්තිය";
				elseif (($goodSubjects>=6) && ($avgMark>=55) && (60>$avgMark)) $class = "දෙවන පෙල පහල පන්තිය";
			}
			return $class;
		}
		
		if ($degreeType=='General')
		{
			echo "<h4 align='center'><u>සාමාන්‍ය ශාස්ත්‍රවේදී උපෘධි පරීක්ෂණය - $acYear (අභ්‍යන්තර)</u></h4>";
			echo "<p>$acYear නොවැම්බර්/දෙසැම්බර් පැවති සාමාන්‍ය ශාස්ත්‍රවේදී උපාධි පරීක්ෂණයට, විභාග අංක $indexNo යටතේ පෙනී සිටි $studentName, පහත දැක්වෙන අයුරින් විෂය සාමාර්ථයන් ලැබූ බව සහතික කරමි.<p>";
?>
            <table border='0' width='100%'>
                <tr>
                    <th colspan="2"><u>විෂය</u></th>
                    <th><u>ශ්‍රේණිය</u></th>
                    <?php if ($withMarks=='on') echo "<th><u>ලකුණු</u></th>"; ?>
                    <th><u>උත්සාහය</u></th>
                </tr>
<?php
			$gaq = getStudyUnits($indexNo,"ප්‍රථම ශාස්ත්‍ර පරීක්ෂණය",1);
			$part1 = getStudyUnits($indexNo,"සාමාන්‍ය ශාස්ත්‍රවේදී ප්‍රථම භාග පරීක්ෂණය",2);
			$part2 = getStudyUnits($indexNo,"සාමාන්‍ය ශාස්ත්‍රවේදී දෙවන භාග පරීක්ෂණය",3);
			echo "</table>";
			if ($gaq && $part1 && part2)
			{
				$class = getDegreeClass($indexNo);
				echo "<p>උපාධි ප්‍රතිඵලය: $class</p>";
			}
			else echo "<p>උපාධි ප්‍රතිඵලය: අසම්පූර්න</p>";
		}
		else
		{
			echo "<h4 align='center'><u>විශේෂ ශාස්ත්‍රවේදී උපෘධි පරීක්ෂණය - $acYear (අභ්‍යන්තර)</u></h4>";
			$speciality = substr($degreeType,8);
			if ($speciality=='A') $speciality = "පුරාවිද්‍යාව";
			elseif ($speciality=='BC') $speciality = "බෞද්ධ සංස්කෘතිය";
			elseif ($speciality=='BP') $speciality = "බෞද්ධ දර්ශනය"; 
			elseif ($speciality=='P') $speciality = "පාලි";
			elseif ($speciality=='S') $speciality = "සංස්කෘත";
			echo "<p>$acYear නොවැම්බර්/දෙසැම්බර් පැවති විශේෂ ශාස්ත්‍රවේදී ($speciality) උපාධි පරීක්ෂණයට, විභාග අංක $indexNo යටතේ පෙනී සිටි $studentName, පහත දැක්වෙන අයුරින් විෂය සාමාර්ථයන් ලැබූ බව සහතික කරමි.</p>";
?>
            <table border='0' width='100%'>
                <tr>
                    <th colspan="2"><u>විෂය</u></th>
                    <th><u>ශ්‍රේණිය</u></th>
                    <?php if ($withMarks=='on') echo "<th><u>ලකුණු</u></th>"; ?>
                    <th><u>උත්සාහය</u></th>
                </tr>
<?php
			$gaq = getStudyUnits($indexNo,"ප්‍රථම ශාස්ත්‍ර පරීක්ෂණය",1);
			$part1 = getStudyUnits($indexNo,"විශේෂ ශාස්ත්‍රවේදී ප්‍රථම භාග පරීක්ෂණය",2);
			$part2 = getStudyUnits($indexNo,"විශේෂ ශාස්ත්‍රවේදී දෙවන භාග පරීක්ෂණය",3);
			$part3 = getStudyUnits($indexNo,"විශේෂ ශාස්ත්‍රවේදී තෙවන භාග පරීක්ෂණය",4);
			echo "</table>";
			if ($gaq && $part1 && part2 && part3)
			{
				$class = getDegreeClass($indexNo);
				echo "<p>උපාධි ප්‍රතිඵලය: $class</p>";
			}
			else echo "<p>උපාධි ප්‍රතිඵලය: අසම්පූර්න</p>";
		}
	}
?>
	<br/>
	<table border="0" width="100%">
    	<tr valign="top">
        	<td width="30%">සකස් කලේ:</td>
            <td width="30%">පරීක්ෂා කලේ:</td>
            <td></td>
        </tr>
        <tr>
        	<td></td>
            <td></td>
            <td>එන්.ඒ.එස්.කේ. ප්‍රේමචන්ද්‍ර <br/>සහකාර ලේඛකාධිකාරී (විභාග) <br/>ලේඛකාධිකාරී වෙනුවට</td>
        </tr>
    </table>
    <br/>
    <table border="0">
    	<tr><th colspan="3" align="left">ශේණි</th></tr>
        <tr><td>A - (70-100)</td><td>B - (55-69)</td><td>C - (40-54)</td></tr>
        <tr><td>D - (30-39)</td><td>E - (0-29)</td><td>ab - Absent</td></tr>
    </table>
</body>
</html>
