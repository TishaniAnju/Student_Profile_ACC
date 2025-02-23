<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Attendance</title>
<link href="css/print.css" rel="stylesheet" type="text/css" />
<?php
include('dbAccess.php');
include('authcheck.inc.php');

$entryYear = cleanInput($_GET['lstEntryYear']);
$faculty = cleanInput($_GET['lstFaculty']);
if ($faculty=='Buddhist') $facultyS = "බෞද්ධ අධ්‍යයන පීඨය";
elseif ($faculty=='Language') $facultyS = "භාෂා අධ්‍යයන පීඨය";
$acYear = cleanInput($_GET['txtAcYear']);
$degreeType = cleanInput($_GET['lstDegreeType']);
$exam = "";
if ($degreeType=='General')
{
	switch ($acYear-$entryYear)
	{
		case 0: {$exam = "ප්‍රථම ශාස්ත්‍ර පරීක්ෂණය"; break;}
		case 1: {$exam = "සාමාන්‍ය ශාස්ත්‍රවේදී ප්‍රථම භාග පරීක්ෂණය"; break;}
		case 2: {$exam = "සාමාන්‍ය ශාස්ත්‍රවේදී දෙවන භාග පරීක්ෂණය"; break;}
	}
}
else
{
	$speciality = substr($degreeType,8);
	if ($speciality=='A') $speciality = "පුරාවිද්‍යාව";
	elseif ($speciality=='BC') $speciality = "බෞද්ධ සංස්කෘතිය";
	elseif ($speciality=='BP') $speciality = "බෞද්ධ දර්ශනය"; 
	elseif ($speciality=='P') $speciality = "පාලි";
	elseif ($speciality=='S') $speciality = "සංස්කෘත";
	
	switch ($acYear-$entryYear)
	{
		case 0: {$exam = "ප්‍රථම ශාස්ත්‍ර පරීක්ෂණය"; break;}
		case 1: {$exam = "ිශේෂ ශාස්ත්‍රවේදී ($speciality) ප්‍රථම භාග පරීක්ෂණය"; break;}
		case 2: {$exam = "ිශේෂ ශාස්ත්‍රවේදී ($speciality) දෙවන භාග පරීක්ෂණය"; break;}
		case 2: {$exam = "ිශේෂ ශාස්ත්‍රවේදී ($speciality) තෙවන භාග පරීක්ෂණය"; break;}
	}
}
?>
<h2 align="center">ශ්‍රී ලංකා බෞ‍ද්ධ හා පාලි විශ්වවි‍ද්‍යාලය</h2>
<h3 align="center">පැමිනීමේ ලේඛනය - <?php echo $acYear; ?></h3>
<h4><?php echo $exam." (".$facultyS.")"; ?></h4>
</head>

<body>
<?php
	$result = executeQuery("SELECT codeSinhala FROM subject WHERE subjectID IN (SELECT DISTINCT subjectID FROM exameffort WHERE acYear='$acYear' AND indexNo IN (SELECT indexNo FROM student WHERE yearEntry = '$entryYear' AND faculty='$faculty' AND degreeType='$degreeType')) ORDER BY codeSinhala");
?>
	<table width="100%">
    	<thead>
        	<tr height="100px">
            	<th></th><th>ලියාපදිංචි අංකය</th><th>විභාග අංකය</th><th>නම</th>
<?php
				$numSubjects = mysql_num_rows($result);
				while ($row = mysql_fetch_array($result))
				{
					echo "<th class='box_rotate'>".$row['codeSinhala']."</th>";
				}
?>
            </tr>
   		</thead>
        <tbody>
<?php
			$result = executeQuery("SELECT regNo,indexNo,nameSinhala FROM student WHERE yearEntry = '$entryYear' AND faculty='$faculty' AND degreeType='$degreeType'");
			for ($i=1;$i<=mysql_num_rows($result);$i++)
			{
				$row = mysql_fetch_array($result);
				echo "<tr><td>$i</td><td>".$row['regNo']."</td><td>".$row['indexNo']."</td><td>".$row['nameSinhala']."</td>";
				for ($j=1;$j<=$numSubjects;$i++)
				{
					echo "<td></td>";
				}
				echo "</tr>";
			}
?>
        </tbody>
    </table>
</body>
</html>
