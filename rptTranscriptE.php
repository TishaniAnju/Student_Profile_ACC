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
</head>

<body>
<?php 
	//2021-03-25 start  include('dbAccess.php');
	require_once("dbAccess.php");
	$db = new DBOperations();
    //2021-03-25 end
	include('authcheck.inc.php');

	$type = $db->cleanInput($_GET['lstType']);
	//2021-03-25 start  $indexNo = cleanInput($_GET['indexNo']);
	$indexNo = $db->cleanInput($_GET['indexNo']);
	//2021-03-25 end
	
	$acYear = $db->cleanInput($_GET['acYear']);
	$acYear = $db->cleanInput($_GET['acYear']);
	$date = $db->cleanInput($_GET['date']);
	$withMarks = $db->cleanInput($_GET['withMarks']);
	$exPeriod = $db->cleanInput($_GET['exPeriod']);
	$yeartime= $acYear.' '.$exPeriod;

	//2021-03-25 start  $result = executeQuery("SELECT std.nameEnglish,std.degreeType,std.regNo,std.medium,fr.finalGPA,fr.class,sbj.semester,sbj.level FROM student as std,finalresults as fr,subject as sbj  WHERE std.indexNo=fr.indexNo and std.indexNo='$indexNo';");
	$result = $db->executeQuery("SELECT std.nameEnglish,std.degreeType,std.regNo,std.medium,fr.finalGPA,fr.class,sbj.semester,sbj.level FROM student as std,finalresults as fr,subject as sbj  WHERE std.indexNo=fr.indexNo and std.indexNo='$indexNo';");
	//2021-03-25 end
	//2021-03-25 start  if (mysql_num_rows($result)==0) die("The student with index number $indexNo has not details");
	if ($db->Row_Count($result)==0) die("The student with index number $indexNo has not details");
	
	while($row1 = $db->Next_Record($result)){
    
	$studentName = $row1['nameEnglish']; 
	$regNo = $row1['regNo'];
	$degreeType = $row1['degreeType'];
	$finalGPA = $row1['finalGPA'];
	$class = $row1['class'];
	$medium = $row1['medium'];
	$semester = $row1['semester'];
	$level = $row1['level'];
	}
	
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
	
	echo "<h3 align='center'><u>Bachelor of Arts $degreeType Degree Examination (Internal) - $acYear</u></h3>";
	echo "<p>This is to certify that $studentName sat for the Bachelor of Arts ($degreeType) Degree Examination held in  $acYear under Index No. $indexNo and reached the standard required for a $class. The study units and grades offered are given below.</p>";
?>

</br>
<table width="1000" border="0" >
	<tr>
    	<td valign="top" width= "50%"><table border="0" width= "100%">
  				<tr>	
					<th align="left" colspan="3" >1st Year</br></th>
				</tr>
				<tr>	
					<th align="left" colspan="3" >First Semester(Semester 01)</br></th>
				</tr>
				<tr>
    				<td width="40%"></td>
    				<td width="42%"></td>	
    				<td width="18%"></td>
  
				</tr>
                <?php

//2021-03-25 start  $result = executeQuery("SELECT sbj.subjectID,sbj.codeEnglish,sbj.nameEnglish,exe.grade,sbj.level,sbj.semester FROM subject as sbj,exameffort as exe  WHERE  sbj.subjectID=exe.subjectID and exe.indexNo=$indexNo and sbj.level='I' and sbj.semester='First Semester';");
$result = $db->executeQuery("SELECT sbj.subjectID,sbj.codeEnglish,sbj.nameEnglish,exe.grade,sbj.level,sbj.semester FROM subject as sbj,exameffort as exe  WHERE  sbj.subjectID=exe.subjectID and exe.indexNo='$indexNo' and sbj.level='I' and sbj.semester='First Semester';");
//2021.03.25 end

?>
				<?php
				//write the results
				//2021-03-25 start  while ($row=mysql_fetch_array($result))
				while ($row=$db->Next_Record($result))
				//2021.03.25 end
				{
				?>

				<tr>
					<td><?php echo $row['codeEnglish'];?></td>
					<td><?php echo $row['nameEnglish'];?></td>
					<td><?php echo $row['grade'];?></td>
	
				</tr>
				<?php

				}
				?>
			</table>
        </td>
		
        <td valign="top" width= "50%"><table border="0" width= "100%">
  				<tr>	
					<th align="left" colspan="3" ></br></th>
				</tr>
		
				<tr>	
					<th align="left" colspan="3" >Second Semester(Semester 02)</br></th>
				</tr>
				<tr>
    				<td width="40%"></td>
    				<td width="42%"></td>	
    				<td width="18%"></td>
  
				</tr>

                <?php

//2021-03-25 start  $result = executeQuery("SELECT sbj.subjectID,sbj.codeEnglish,sbj.nameEnglish,exe.grade,sbj.level,sbj.semester FROM subject as sbj,exameffort as exe  WHERE  sbj.subjectID=exe.subjectID and exe.indexNo=$indexNo and sbj.level='I' and sbj.semester='Second Semester';");
$result = $db->executeQuery("SELECT sbj.subjectID,sbj.codeEnglish,sbj.nameEnglish,exe.grade,sbj.level,sbj.semester FROM subject as sbj,exameffort as exe  WHERE  sbj.subjectID=exe.subjectID and exe.indexNo='$indexNo' and sbj.level='I' and sbj.semester='Second Semester';");
//2021.03.25 end

?>
				<?php
				//write the results
				//2021-03-25 start  while ($row=mysql_fetch_array($result))
				while ($row=$db->Next_Record($result))
				//2021.03.25 end
				{
				?>

				<tr>
					<td><?php echo $row['codeEnglish'];?></td>
					<td><?php echo $row['nameEnglish'];?></td>
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
					<th align="left" colspan="3">2nd Year</br></th>
				</tr>
				<tr>	
					<th align="left" colspan="3">First Semester(Semester 03)</br></th>
				</tr>
				<tr>
    				<td width="40%"></td>
    				<td width="42%"></td>	
    				<td width="18%"></td>
  
				</tr>
                <?php

//2021-03-25 start  $result = executeQuery("SELECT sbj.subjectID,sbj.codeEnglish,sbj.nameEnglish,exe.grade,sbj.level,sbj.semester FROM subject as sbj,exameffort as exe  WHERE  sbj.subjectID=exe.subjectID and exe.indexNo=$indexNo and sbj.level='II' and sbj.semester='First Semester';");
$result = $db->executeQuery("SELECT sbj.subjectID,sbj.codeEnglish,sbj.nameEnglish,exe.grade,sbj.level,sbj.semester FROM subject as sbj,exameffort as exe  WHERE  sbj.subjectID=exe.subjectID and exe.indexNo='$indexNo' and sbj.level='II' and sbj.semester='First Semester';");
//2021.03.25 end
?>
				<?php
				//write the results
				//2021-03-25 start  while ($row=mysql_fetch_array($result))
				while ($row=$db->Next_Record($result))
				//2021.03.25 end
				{
				?>

				<tr>
					<td><?php echo $row['codeEnglish'];?></td>
					<td><?php echo $row['nameEnglish'];?></td>
					<td><?php echo $row['grade'];?></td>
	
				</tr>
				<?php

				}
				?>
			</table>
        </td>
        <td valign="top" width= "50%"><table border="0" width= "100%">
  				<tr>	
					<th align="left" colspan="3"></br></th>
				</tr>
				<tr>	
					<th align="left" colspan="3">Second Semester(Semester 04)</br></th>
				</tr>
				<tr>
    				<td width="40%"></td>
    				<td width="42%"></td>	
    				<td width="18%"></td>
  
				</tr>
                <?php

//2021-03-25 start  $result = executeQuery("SELECT sbj.subjectID,sbj.codeEnglish,sbj.nameEnglish,exe.grade,sbj.level,sbj.semester FROM subject as sbj,exameffort as exe  WHERE  sbj.subjectID=exe.subjectID and exe.indexNo=$indexNo and sbj.level='II' and sbj.semester='Second Semester';");
$result = $db->executeQuery("SELECT sbj.subjectID,sbj.codeEnglish,sbj.nameEnglish,exe.grade,sbj.level,sbj.semester FROM subject as sbj,exameffort as exe  WHERE  sbj.subjectID=exe.subjectID and exe.indexNo='$indexNo' and sbj.level='II' and sbj.semester='Second Semester';");
//2021.03.25 end

?>
				<?php
				//write the results
				//2021-03-25 start  while ($row=mysql_fetch_array($result))
				while ($row=$db->Next_Record($result))
				//2021.03.25 end
				{
				?>

				<tr>
					<td><?php echo $row['codeEnglish'];?></td>
					<td><?php echo $row['nameEnglish'];?></td>
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
					<th align="left" colspan="3">3rd Year</br></th>
				</tr>
				<tr>	
					<th align="left" colspan="3">First Semester(Semester 05)</br></th>
				</tr>
				<tr>
    				<td width="40%"></td>
    				<td width="42%"></td>	
    				<td width="18%"></td>
  
				</tr>
                <?php

//2021-03-25 start  $result = executeQuery("SELECT sbj.subjectID,sbj.codeEnglish,sbj.nameEnglish,exe.grade,sbj.level,sbj.semester FROM subject as sbj,exameffort as exe  WHERE  sbj.subjectID=exe.subjectID and exe.indexNo=$indexNo and sbj.level='III' and sbj.semester='First Semester';");
$result = $db->executeQuery("SELECT sbj.subjectID,sbj.codeEnglish,sbj.nameEnglish,exe.grade,sbj.level,sbj.semester FROM subject as sbj,exameffort as exe  WHERE  sbj.subjectID=exe.subjectID and exe.indexNo='$indexNo' and sbj.level='III' and sbj.semester='First Semester';");
//2021.03.25 start

?>
				<?php
				//write the results
				//2021-03-25 start  while ($row=mysql_fetch_array($result))
				while ($row=$db->Next_Record($result))
				//2021.03.25 end
				{
				?>

				<tr>
					<td><?php echo $row['codeEnglish'];?></td>
					<td><?php echo $row['nameEnglish'];?></td>
					<td><?php echo $row['grade'];?></td>
	
				</tr>
				<?php

				}
				?>
			</table>
        </td>
        <td valign="top" width= "50%"><table border="0" width= "100%">
  				<tr>	
					<th align="left" colspan="3"></br></th>
				</tr>
				<tr>	
					<th align="left" colspan="3">Second Semester(Semester 06)</br></th>
				</tr>
				<tr>
    				<td width="40%"></td>
    				<td width="42%"></td>	
    				<td width="18%"></td>
  
				</tr>
                <?php

//2021-03-25 start  $result = executeQuery("SELECT sbj.subjectID,sbj.codeEnglish,sbj.nameEnglish,exe.grade,sbj.level,sbj.semester FROM subject as sbj,exameffort as exe  WHERE  sbj.subjectID=exe.subjectID and exe.indexNo=$indexNo and sbj.level='III' and sbj.semester='Second Semester';");
$result = $db->executeQuery("SELECT sbj.subjectID,sbj.codeEnglish,sbj.nameEnglish,exe.grade,sbj.level,sbj.semester FROM subject as sbj,exameffort as exe  WHERE  sbj.subjectID=exe.subjectID and exe.indexNo='$indexNo' and sbj.level='III' and sbj.semester='Second Semester';");
//2021.03.25 end

?>
				<?php
				//write the results
				//2021-03-25 start  while ($row=mysql_fetch_array($result))
				while ($row=$db->Next_Record($result))
				//2021.03.25 end
				{
				?>

				<tr>
					<td><?php echo $row['codeEnglish'];?></td>
					<td><?php echo $row['nameEnglish'];?></td>
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
<table width="1000" border="0" >
	<tr>
    	<td valign="top" width= "50%"><table border="0" width= "100%">
  				
				<tr>
    				<td width="15%"><b>Medium&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> </td>
    				<td width="50%"><b><?php echo "$medium";?></b></td>	
    		
				</tr>
					<tr>
    				<td width="15%"><b>Grade Point Average&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b></td>
    				<td width="50%"><b><?php echo "$finalGPA";?></b></td>	
    		
				</tr>
					<tr>
    				<td width="15%"><b>Effective date of the degree:</b></td>
    				<td width="50%"><b><?php echo "$date";?></b></td>	
    		
				</tr>
				</table>

<br/>
	<table border="0" width="100%">
    	<tr valign="top">
        	<td width="30%"><b>Prepared by:</b></td>
            <td width="30%"><b>Checked by I:</b></td>
			<td width="30%"><b>Checked by II:</b></td>
            <td></td>
        </tr>
        <tr>
        	<td></td>  
    </table>

<div align='left'>
<pre><b>
<b>xxxxxxxxxxxxxxxxxxx</b>
<b>Asst. Registar (Examinations)</b>
<b>for Registar</b>    

</pre>
</div>  
<hr><table border="0">
    	<tr><th colspan="3" align="left"><u>Grades</u></th></tr>
        <tr><td width="30%">85-100&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A<sup>+</sup></td><td width="30%">60-64&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B<sup>+</sup></td width="30%"><td>45-49&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C<sup>+</sup></td><td width="30%">30-34&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;D<sup>+</sup></td></tr>
        <tr><td width="30%">70-84&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; A</td><td>55-59&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B</td width="30%"><td>40-44&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C</td><td width="30%">25-29&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;D</td></tr>
		<tr><td width="30%">65-69&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A<sup>-</sup></td><td width="30%">50-54&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B<sup>-</sup></td><td width="30%">35-39&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C<sup></sup></td><td width="30%"> 00-24&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;E</td></tr>

    </table>
</body>
</html>
