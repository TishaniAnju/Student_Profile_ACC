<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <style type="text/css" media="all">
        @page {
            size: A4 portrait; 
            margin: 1.0in;
            border: thin solid black;
            padding: 1em;

            @bottom-center {
                content: element(footer);
            }

            @top-center {
                content: element(header);
            }
        }

        #page-header {
            display: block;
            position: running(header);
        }

        #page-footer {
            display: block;
            position: running(footer);
        }

        .page-number:before {
            content: counter(page); 
        }

        .page-count:before {
            content: counter(pages);  
        }
</style>

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

	$type = $_GET['lstType'];
	$indexNo = cleanInput($_GET['indexNo']);
	
	$acYear = $_GET['acYear'];
	$acYear = $_GET['acYear'];
	$date = $_GET['date'];
	$withMarks = $_GET['withMarks'];
	$exPeriod = $_GET['exPeriod'];
	$yeartime= $acYear.' '.$exPeriod;
	$result = executeQuery("SELECT std.nameSinhala,std.degreeType,std.regNo,std.medium,fr.finalGPA,fr.class,fr.classSinhala,sbj.semester,sbj.level FROM student as std,finalresults as fr,subject as sbj  WHERE std.indexNo=fr.indexNo and std.indexNo='$indexNo';");
	$studentName = mysql_result($result,0,'nameSinhala');  
    $regNo = mysql_result($result,0,'regNo');
	$degreeType = mysql_result($result,0,'degreeType');
	$finalGPA = mysql_result($result,0,'finalGPA');
	$class = mysql_result($result,0,'class');
	$classSinhala = mysql_result($result,0,'classSinhala');
	$medium = mysql_result($result,0,'medium');
	$semester = mysql_result($result,0,'semester');
	$level = mysql_result($result,0,'level');
	
?>
	<div align="right"><input type="button" id="btnPrint" value="Print" onClick="window.print();return false"/></div>
<br/> 
<br/> 
<br/> 
<br/> 
<br/> 
<br/> 
<br/> 
<br/> 
<br/> 
<br/> 
<br/> 
<br/> 
<br/> 
<br/> 
<br/> 
<br/>
<br/> 
<br/> 
<br/> 
<br/> 
<br/> 
<br/>
 
    <p align="right">Date of Issue : <?php echo date('d-m-Y'); ?></p>
<hr>
<?php	
	echo "<h3 align='center'><u>ශාස්ත්‍රවේදී  (සාමාන්‍ය) උපාධි පරීක්ෂණය  (අභ්‍යන්තර) - $acYear</u></h3>";
	echo "<p>විභාග අංක $indexNo  යටතේ  ශාස්ත්‍රවේදී   උපාධි පරීක්ෂණයට  අයත් අධ්‍යන ඒකක වලට පෙනී සිට පහත දැක්වෙන පරීක්ෂණ වලදී  $classSinhala ලත්   $studentName  ශාස්ත්‍රවේදී (සාමාන්‍ය) උපාධිය (අභ්‍යන්තර) ලැබූ බව මෙයින් සහතික කරමි. </p>";
?>

</br>
<table width="1000" border="0" >
	<tr>
    	<td valign="top" width= "50%"><table border="0" width= "100%">
  				<tr>	
					<th align="center" colspan="3" >ප්‍රථම වසර</br></th>
				</tr>
				<tr>	
					<th align="center" colspan="3" >ප්‍රථම අර්ධ වාර්ෂික  පරීක්ෂණය</br></th>
				</tr>
				<tr>
    				<td width="40%"></td>
    				<td width="42%"></td>	
    				<td width="18%"></td>
  
				</tr>
                <?php

$result = executeQuery("SELECT sbj.subjectID,sbj.codeSinhala,sbj.nameSinhala,exe.grade,sbj.level,sbj.semester FROM subject as sbj,exameffort as exe  WHERE  sbj.subjectID=exe.subjectID and exe.indexNo=$indexNo and sbj.level='I' and sbj.semester='First Semester';");

?>
				<?php
				//write the results
				while ($row=mysql_fetch_array($result))
				{
				?>

				<tr>
					<td><?php echo $row['codeSinhala'];?></td>
					<td><?php echo $row['nameSinhala'];?></td>
					<td><?php echo $row['grade'];?></td>
	
				</tr>
				<?php

				}
				?>
			</table>
        </td>
		
        <td valign="top" width= "50%"><table border="0" width= "100%">
  				<tr>	
					<th align="center" colspan="3" >ප්‍රථම වසර</br></th>
				</tr>
		
				<tr>	
					<th align="center" colspan="3" >දෙවන අර්ධ වාර්ෂික  පරීක්ෂණය</br></th>
				</tr>
				<tr>
    				<td width="40%"></td>
    				<td width="42%"></td>	
    				<td width="18%"></td>
  
				</tr>

                <?php

$result = executeQuery("SELECT sbj.subjectID,sbj.codeSinhala,sbj.nameSinhala,exe.grade,sbj.level,sbj.semester FROM subject as sbj,exameffort as exe  WHERE  sbj.subjectID=exe.subjectID and exe.indexNo=$indexNo and sbj.level='I' and sbj.semester='Second Semester';");

?>
				<?php
				//write the results
				while ($row=mysql_fetch_array($result))
				{
				?>

				<tr>
					<td><?php echo $row['codeSinhala'];?></td>
					<td><?php echo $row['nameSinhala'];?></td>
					<td><?php echo $row['grade'];?></td>
	
				</tr>
				<?php

				}
				?>
			</table>
        </td>
     </tr>
</table>      

</br>
<table width="1000"  border="0">
	<tr>
    	<td valign="top" width= "50%"><table border="0" width= "100%">
  				<tr>	
					<th align="center" colspan="3">දෙවන  වසර</br></th>
				</tr>
				<tr>	
					<th align="center" colspan="3">ප්‍රථම අර්ධ වාර්ෂික  පරීක්ෂණය</br></th>
				</tr>
				<tr>
    			<td width="40%"></td>
    			<td width="42%"></td>	
    			<td width="18%"></td>
  
				</tr>
                <?php

$result = executeQuery("SELECT sbj.subjectID,sbj.codeSinhala,sbj.nameSinhala,exe.grade,sbj.level,sbj.semester FROM subject as sbj,exameffort as exe  WHERE  sbj.subjectID=exe.subjectID and exe.indexNo=$indexNo and sbj.level='II' and sbj.semester='First Semester';");

?>
				<?php
				//write the results
				while ($row=mysql_fetch_array($result))
				{
				?>

				<tr>
					<td><?php echo $row['codeSinhala'];?></td>
					<td><?php echo $row['nameSinhala'];?></td>
					<td><?php echo $row['grade'];?></td>
	
				</tr>
				<?php

				}
				?>
			</table>
        </td>
        <td valign="top" width= "50%"><table border="0" width= "100%">
  				<tr>	
					<th align="center" colspan="3">දෙවන  වසර</br></th>
				</tr>
				<tr>	
					<th align="center" colspan="3">දෙවන අර්ධ වාර්ෂික  පරීක්ෂණය</br></th>
				</tr>
				<tr>
    				<td width="40%"></td>
    				<td width="42%"></td>	
    				<td width="18%"></td>
  
				</tr>
                <?php

$result = executeQuery("SELECT sbj.subjectID,sbj.codeSinhala,sbj.nameSinhala,exe.grade,sbj.level,sbj.semester FROM subject as sbj,exameffort as exe  WHERE  sbj.subjectID=exe.subjectID and exe.indexNo=$indexNo and sbj.level='II' and sbj.semester='Second Semester';");

?>
				<?php
				//write the results
				while ($row=mysql_fetch_array($result))
				{
				?>

				<tr>
					<td><?php echo $row['codeSinhala'];?></td>
					<td><?php echo $row['nameSinhala'];?></td>
					<td><?php echo $row['grade'];?></td>
	
				</tr>
				<?php

				}
				?>
			</table>
        </td>
     </tr>
</table>      
  
</br>
<table width="1000"  border="0">
	<tr>
    	<td valign="top" width= "50%"><table border="0" width= "100%">
  				<tr>	
					<th align="center" colspan="3">තෙවන වසර</br></th>
				</tr>
				<tr>	
					<th align="center" colspan="3">ප්‍රථම අර්ධ වාර්ෂික  පරීක්ෂණය</br></th>
				</tr>
				<tr>
    				<td width="40%"></td>
    				<td width="42%"></td>	
    				<td width="18%"></td>
  
				</tr>
                <?php

$result = executeQuery("SELECT sbj.subjectID,sbj.codeSinhala,sbj.nameSinhala,exe.grade,sbj.level,sbj.semester FROM subject as sbj,exameffort as exe  WHERE  sbj.subjectID=exe.subjectID and exe.indexNo=$indexNo and sbj.level='III' and sbj.semester='First Semester';");

?>
				<?php
				//write the results
				while ($row=mysql_fetch_array($result))
				{
				?>

				<tr>
					<td><?php echo $row['codeSinhala'];?></td>
					<td><?php echo $row['nameSinhala'];?></td>
					<td><?php echo $row['grade'];?></td>
	
				</tr>
				<?php

				}
				?>
			</table>
        </td>
        <td valign="top" width= "50%"><table border="0" width= "100%">
  				<tr>	
					<th align="center" colspan="3">තෙවන වසර</br></th>
				</tr>
				<tr>	
					<th align="center" colspan="3">දෙවන අර්ධ වාර්ෂික  පරීක්ෂණය</br></th>
				</tr>
				<tr>
    				<td width="40%"></td>
    				<td width="42%"></td>	
    				<td width="18%"></td>
  
				</tr>
                <?php

$result = executeQuery("SELECT sbj.subjectID,sbj.codeSinhala,sbj.nameSinhala,exe.grade,sbj.level,sbj.semester FROM subject as sbj,exameffort as exe  WHERE  sbj.subjectID=exe.subjectID and exe.indexNo=$indexNo and sbj.level='III' and sbj.semester='Second Semester';");

?>
				<?php
				//write the results
				while ($row=mysql_fetch_array($result))
				{
				?>

				<tr>
					<td><?php echo $row['codeSinhala'];?></td>
					<td><?php echo $row['nameSinhala'];?></td>
					<td><?php echo $row['grade'];?></td>
	
				</tr>
				<?php
}
				
				?>
			</table>
        </td>
     </tr>
</table>      
<br/>

<?php

echo "<p><b>උපාධිය වලංගු දිනය &nbsp;&nbsp;: &nbsp; $date </b></p>";
?>

<br/>
	<table border="0" width="100%">
    	<tr valign="top">
        	<td width="30%"><b>සකස් කලේ:</b></td>
            <td width="30%"><b>පරීක්ෂා කලේ  I:</b></td>
			<td width="30%"><b>පරීක්ෂා කලේ II:</b></td>
            <td></td>
        </tr>
        <tr>
        	<td></td>  
    </table>
<br/>
<div align='left'>
<pre>
<b>එම්.ඩබ්. සේපාලි කුලතුංග</b>
<b>සහකාර ලේඛකාධිකාරී (විභාග)</b>
<b>ලේඛකාධිකාරී වෙනුවට</b>    

</pre>
</div>  
<hr><table border="0">
    	<tr><th colspan="3" align="left"><u>ශේණි</u></th></tr>
        <tr><td width="30%">85-100&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A<sup>+</sup></td><td width="30%">60-64&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B<sup>+</sup></td width="30%"><td>45-49&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C<sup>+</sup></td><td width="30%">30-34&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;D<sup>+</sup></td></tr>
        <tr><td width="30%">70-84&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; A</td><td>55-59&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B</td width="30%"><td>40-44&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C</td><td width="30%">25-29&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;D</td></tr>
		<tr><td width="30%">65-69&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A<sup>-</sup></td><td width="30%">50-54&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B<sup>-</sup></td><td width="30%">35-39&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C<sup></sup></td><td width="30%"> 00-24&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;E</td></tr>

    </table>
</body>
</html>
