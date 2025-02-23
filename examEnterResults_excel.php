<?php
include('dbAccess.php');
$db = new DBOperations();
//include('authcheck.inc.php');

###excel####

$filename ="rpt_examEffort.xls";
$contents = "testdata1 \t testdata2 \t testdata3 \t \n";
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename); 

###excel####


$acYear = $db->cleanInput($_GET['acYear']);
$subjectID = $db->cleanInput($_GET['subjectID']);

$result = $db->executeQuery("SELECT s.*, e.*, sub.nameEnglish, sub.codeEnglish FROM studentenrolment AS s JOIN exameffort AS e ON s.indexNo = e.indexNo JOIN subject AS sub ON s.subjectID = sub.subjectID WHERE s.acYear = '$acYear' AND s.subjectID = '$subjectID' ");

    // Fetch the first row to get subject information
    $subjectInfo = $db->Next_Record($result);

    // Display the Subject name and Subject code
	$subjectCode = $subjectInfo['codeEnglish'];
    $subjectName = $subjectInfo['nameEnglish'];
    

?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Exam Effort Report - Student Management System - Buddhist & Pali University of Sri Lanka</title>
<script type="text/javascript" src="lib/tablesort/tablesort.js"></script>
<link href="css/print.css" rel="stylesheet" type="text/css" media="screen,print,projection" />
<style type='text/css' media='print'>
	@page {size:A3; size:landscape}
	#btnPrint {display : none}
</style>

<div align="right"><input type="button" id="btnPrint" value="Print" onClick="window.print();return false"/></div>
<h1 align="center"><font size="+3">Buddhist and Pali University of Sri Lanka</font></h1>
<h2 align="center"><font size="+2"><?php echo $acYear ?>-Academic Year</font></h2>
<h4 align="center"><font face="kaputadotcom2004" size="+2"><?php echo $subjectCode ?> - <?php echo $subjectName ?></font></h4>

</head>
	<table border="1" cellpadding="2" cellspacing="0">
	<thead>
		<tr>
			<th class="sortable-numeric" rowspan="1"><font>Number</font></th> <!-- index No-->
            <th rowspan="1">Index Number</th> <!-- Name-->
			<th rowspan="1">Mark1</th> <!-- Name-->
            <th rowspan="1">Mark2</th>
			<th rowspan="1">Mark3</th><!-- Entry Type-->
            <th rowspan="1">Grade</th><!-- Entry Type-->
            <th rowspan="1">Grade Point</th><!-- Entry Type-->
		 </tr>
	</thead>
     <tbody>
    <?php 

    $result = $db->executeQuery("SELECT s.*, e.* FROM studentenrolment AS s JOIN exameffort AS e ON s.indexNo = e.indexNo JOIN subject AS sub ON s.subjectID = sub.subjectID WHERE s.acYear = '$acYear' AND s.subjectID = '$subjectID' ");
	$i =1;   
	while($row = $db->Next_Record($result))
	//while ($row = mysql_fetch_array($result))
		{
		?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $row['indexNo'];?></td>
            <td><?php echo $row['mark1'];?></td>
			<td align="center"><?php echo $row['mark2'];?></td>
			<td align="center"><?php echo $row['marks'];?></td>
			<td align="center"><?php echo $row['grade'];?></td>
			<td align="center"><?php echo $row['gradePoint'];?></td>
	    
			
			<?php 
			$i++;
			?>
		</tr>
		<?php
		}?>
   	</tbody> 
    
	   <tfoot><tr height="30" style="border-bottom:none" style="border-left:none" style="border-right: none"><td bordercolor="#FFFFFF" colspan="3" width="25%">Prepared By :-.............</td><td bordercolor="#FFFFFF" colspan="4" width="25%">Checked By :-.................</td></tr></tfoot></table>    

	   </html>
<?php
	
	

