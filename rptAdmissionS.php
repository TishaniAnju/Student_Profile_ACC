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
	
	$result = executeQuery("SELECT nameSinhala,degreeType FROM student WHERE indexNo='$indexNo'");
	$studentName = mysql_result($result,0,'nameSinhala');
	$degreeType = mysql_result($result,0,'degreeType');
	
	$result = executeQuery("SELECT codeSinhala,nameSinhala,level,date,time,venue FROM examschedule JOIN subject ON examschedule.subjectID=subject.subjectID WHERE acYear='$acYear' AND examschedule.subjectID IN (SELECT subjectID FROM exameffort WHERE indexNo='$indexNo') ORDER BY date,time");
	if (mysql_num_rows($result)==0) die("The student with index number $indexNo is not registered for any exams in $acYear");
	
	$level = queryOfQuery($result,"level");
	$exam = "";
	asort(array_count_values($level[0]));
	$level = $level[0]['level'];
	if ($level==1) $exam = "ප්‍රථම ශාස්ත්‍ර පරීක්ෂණය";
	elseif ($level==2)
	{
		if ($degreeType=='General') $exam = "සාමාන්‍ය ශාස්ත්‍රවේදී ප්‍රථම භාග පරීක්ෂණය";
		else $exam = "විශේෂ ශාස්ත්‍රවේදී ප්‍රථම භාග පරීක්ෂණය";
	}
	elseif ($level==3)
	{
		if ($degreeType=='General') $exam = "සාමාන්‍ය ශාස්ත්‍රවේදී දෙවන භාග පරීක්ෂණය";
		else $exam = "විශේෂ ශාස්ත්‍රවේදී දෙවන භාග පරීක්ෂණය";
	}
	elseif ($level==4) $exam = "විශේෂ ශාස්ත්‍රවේදී තෙවන භාග පරීක්ෂණය";

?>
	<div align="right"><input type="button" id="btnPrint" value="Print" onClick="window.print();return false"/></div>
    <h2 align="center">ශ්‍රී ලංකා බෞද්ධ හා පාලි විශ්ව විද්‍යාලය</h2>
    <h3 align="center"><?php echo $exam." ".$acYear; ?></h3>
    <h3 align="center">ප්‍රවේශ පත්‍රය හා අත්සන් පත්‍රය</h3>
    <p>(විභාගය පැවැත්වෙන පළමු දිනයේදී මෙම ප්‍රවේශ පත්‍රය ශාලාධිපති වෙත භාරදිය යුතුය.)</p>
    <p><b>අයදුම්කරුගේ නම : </b><?php echo $studentName; ?></p>
    <p><b>විභාග අංකය : </b><?php echo $indexNo; ?></p>
    <p><b>විභාග මධ්‍යස්ානය : </b>ශ්‍රී ලංකා බෞද්ධ හා පාලි විශ්ව විද්‍යාලය, ගුරුලුගෝමී මාවත, පිටිපන උතුර, හෝමාගම.</p>
    <p><b>අත්සන සහතික කිරීම : </b></p>
    <p>සෑම අයදුම්කරුවකුම පහත සඳහන් කවරකු හෝ ලවා තම අත්සන සහතික කරවා ගත යුතුය:-</p>
    <p>පිරිවෙනාධිපතීන් වහන්සේ නමක්, විහාරාධිපතීන් වහන්ස් නමක්, පූජ්‍ය ස්ථානයක් භාර පූජකවරයෙක්, විදුහල්පතිවරයෙක්, ග්‍රාමසේවා නිලධරයෙක්, සාමදාන විනිශ්චයකාර වරයෙක් හෝ රජයේ, පළාත් පාලන, රාජ්‍ය සංස්ථා සේවාවක මාණ්ඩලික නිලධරයෙක්.</p>
    <br/>
    <p align="right">සහකාර ලේඛකාධිකාරී (විභාග)<br/>ලේඛකාධිකාරී වෙනුවට</p>
    <br/>
    <p>අයදුම්කරුගේ අත්සන :...........................</p>
    <p>දිනය :...........................</p>
    <br/>
    <p><b>අත්සන සහතික කිරීම : </b></p>
    <p>ඉහත නම සඳහන් අයදුම් කරු මා පෞද්ගලිකව හඳුනන බවත්, අද දින මා ඉදිරිපිටදී අත්සන් කළ බවත් සහතික කරමි.</p>
    <p>සහතික කළ අයගේ අත්සන: ........................... දිනය: ...........................</p>
    <p>සහතික කළ අයගේ නම, තනතුර හා ලිපිනය</p>
    <p>....................................................................................</p>
    <p>....................................................................................</p>
    <p>....................................................................................</p>
    <br/>
    <div style="page-break-after:always"></div>
    
    <h3>අත්සන් පත්‍රය</h3>
    <p>අයදුම්කරුවකු විසින් සෑම විෂයක් සඳහාම ශාලාධිපති/නිරීක්ෂක ඉදිරියේදී ප්‍රශන පත්‍රයේ නම යොදා අත්සන් තැබිය යුතුය.</p>
    <table width="100%">
    	<tr><th width="30%">විෂය</th><th>දිනය</th><th>මාධ්‍ය</th><th>අයදුම්කරුගේ අත්සන</th><th>නිරීක්ෂකගේ අත්සන</th></tr>
        <?php 
		for ($i=1;$i<=30;$i++)
		{
			echo "<tr><td>$i</td><td></td><td></td><td></td><td></td></tr>";
		}
		?>
    </table>
    <br/>
    <p>අනන්‍යතා සහතිකයේ අංකය  : ...................</p>
    <p>විභාග ශාලාධිපතිගේ අත්සන : ...................&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; දිනය : .................</p>
	<br/>
    <div style="page-break-after:always"></div>
    
    <h3 align="center">විභාග කාලසටහන <?php echo $acYear; ?></h3>
    <p><b>විභාග අංකය : </b><?php echo $indexNo; ?></p>
    <p><b>අයදුම්කරුගේ නම : </b><?php echo $studentName; ?></p>
    <?php
	if (mysql_num_rows($result)>0)
	{
	?>
    	<table width="100%">
        	<tr><th>දිනය</th><th>වේලාව</th><th>අංකය</th><th>විෂය</th><th>ස්ථානය</th></tr>
    		<?php 
			while ($row=mysql_fetch_array($result))
			{
				echo "<tr><td>".$row['date']."</td><td>".$row['time']."</td><td>".$row['codeSinhala']."</td><td>".$row['nameSinhala']."</td><td>".$row['venue']."</td></tr>";
			}
			?>
   		</table>
    <?php
	}
	?>
</body>
</html>
