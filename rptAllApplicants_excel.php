<?php
include('dbAccess.php');
$db = new DBOperations();
//include('authcheck.inc.php');

###excel####

$filename ="report_selected_applicants.xls";
$contents = "testdata1 \t testdata2 \t testdata3 \t \n";
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename); 

###excel####

$entryYear = $db->cleanInput($_GET['entryYear']);
//$ALYear = $db->cleanInput($_GET['alYear']);
$ALYear = "2023";
$appType = $db->cleanInput($_GET['appType']);

if($appType == 'Local')
	{
?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Local Applicants Report - Student Management System - Buddhist & Pali University of Sri Lanka</title>
<script type="text/javascript" src="lib/tablesort/tablesort.js"></script>
<link href="css/print.css" rel="stylesheet" type="text/css" media="screen,print,projection" />
<style type='text/css' media='print'>
	@page {size:A3; size:landscape}
	#btnPrint {display : none}
</style>

<div align="right"><input type="button" id="btnPrint" value="Print" onClick="window.print();return false"/></div>
<h1 align="center"><font size="+3">Buddhist and Pali University of Sri Lanka</font></h1>
<h2 align="center"><font size="+2"><?php echo $entryYear ?>University Admission</font></h2>
<h3 align="center"><font size="+2"> List of eligible students </font></h3>
<h4 align="center"><font face="kaputadotcom2004" size="+2"><?php echo $ALYear ?> According to the GCE A / L results</font></h4>
</head>
	<table border="1" cellpadding="2" cellspacing="0">
	<thead>
		<tr>
			<th class="sortable-numeric" rowspan="2"><font>Application No</font></th> <!-- index No-->
			<th rowspan="2"><font>Registratin No</font></th> <!-- index No-->
			<th rowspan="2">Name</th> <!-- Name-->
			<th rowspan="2">Name (Sinhala)</th> <!-- Name-->
            <th rowspan="2">N.I.C</th> <!-- Nic number-->  
			<th rowspan="2">TP</th> <!-- TP--> 
			<th rowspan="2">email</th> <!-- Email-->
			<th rowspan="2">Address</th> <!-- Address-->
			<th rowspan="2">Address (Sinhala)</th> <!-- Address-->
			<th rowspan="2">Entry Type</th><!-- Entry Type-->
		    <th class="sortable-numeric" rowspan="2">A/L Index No</th><!-- A/L No-->
		    <th colspan="5">G.C.E A/L</th>
		    <th colspan="6">Pali Qualification</th>
			<th rowspan="2">Nikaya</th>
			<th rowspan="2">Chapter</th>
        

		</tr>
		<tr>
		  <th class="sortable-numeric">Z Score</th><!-- Z score-->
		  <th>G.C.E</th><!-- General Know-->
		  <th>Subject 1</th>
		  <th>Subject 2</th>
		  <th>Subject 3</th>
          <?php 
		  $resultH = $db->executeQuery("SELECT qualificationE FROM paliqualification");
		  while($row = $db->Next_Record($resultH))
     	  echo "<th>".$row['qualificationE']."</th>";		  
		  ?>
		 </tr>
	</thead>
     <tbody>
    <?php 
	$result = $db->executeQuery("SELECT * FROM localapplicant JOIN applicant ON localapplicant.appNo = applicant.appNo JOIN chapter ON localapplicant.chapter = chapter.chapterID
    JOIN nikaya ON localapplicant.nikaya = nikaya.nikayaID JOIN student ON applicant.appNo = student.appNo  WHERE entryYear = '$entryYear' ORDER BY applicationNo");
	$i =1; 

	while($row = $db->Next_Record($result))
		{
		?>
		<tr>
		    <td><?php echo $row['applicationNo'];?></td>
			<td><?php echo $row['regNo'];?></td>
			<td><?php echo $row['nameEnglish'];?></td>
			<td><?php echo $row['nameSinhala'];?></td>
            <td><?php echo $row['nicNo'];?></td>
			<td><?php echo $row['telno'];?></td>
			<td><?php echo $row['email'];?></td>
			<?php 
			$address = $row['addressEnglish1']."".$row['addressEnglish2']."".$row['addressEnglish3'];
			echo "<td>".$address."</td>";
			$i++;
			?>
			<?php 
                    $address = $row['addS1']."".$row['addS2']."".$row['addS3'];
                    echo "<td>".$address."</td>";
                    $i++;
                    ?>
			<td align="center"><?php if ($row['entryType']=='Normal') echo 'Normal';
			else if ($row['entryType']=='Sanskrit') echo 'Sanskrit' ?></td>
			<td align="center"><?php echo $row['alAdNo'];?></td>
			<td align="center"><?php echo $row['zScore'];?></td>
			<td align="center"><?php echo $row['gkScore'];?></td>
			<?php 
			$resultSub1 = $db->executeQuery("SELECT subnameE,result FROM applicantsubjects JOIN alsubjects ON applicantsubjects.subjectCode = alsubjects.subjectCode WHERE applicantsubjects.appNo = $row[0]");
		
			if($db->Row_Count($resultSub1)==3)
				{
				while($rowSub1 = $db->Next_Record($resultSub1))
					echo "<td align='center'>".$rowSub1['subnameE']. ":" .$rowSub1['result']."</td>";
				}
			elseif ($db->Row_Count($resultSub1)==2)
				{ 
				while($rowSub1 = $db->Next_Record($resultSub1))
						echo "<td align='center'>".$rowSub1['subnameE']. ":" .$rowSub1['result']."</td>";
				echo "<td> - </td>";
				}
				
		
			elseif ($db->Row_Count($resultSub1)==1)
				{ 	
					while($rowSub1 = $db->Next_Record($resultSub1))
						echo "<td align='center'>".$rowSub1['subnameE']. ":" .$rowSub1['result']."</td>";
					for ($j=1;$j<3;$j++){		
						echo "<td> - </td>";}
				}
		
			elseif ($db->Row_Count($resultSub1)==0)
			{ 	
				for ($j=1;$j<4;$j++){		
					echo "<td> - </td>";}
			}		
			
			for ($j=1;$j<=6;$j++)
			{
				$resultSub2 = $db->executeQuery("SELECT result FROM applicantpali WHERE appNo = $row[0] AND code = 'p0$j'");
			
				if ($db->Row_Count($resultSub2)>0)
				{
				
					$rowSub2 = $db->Next_Record($resultSub2);
					echo "<td width='3' align='center'>".$rowSub2['result']."</td>";
				}
				else echo "<td width='3'> - </td>";
			}
			?>     
			<td align="center"><?php echo $row['nikayaName'];?></td>
			<td align="center"><?php echo $row['chapter'];?></td>
		</tr>
		<?php
		}?>
   	</tbody> 
    
	   <tfoot><tr height="30" style="border-bottom:none" style="border-left:none" style="border-right: none"><td bordercolor="#FFFFFF" colspan="5" width="25%">Prepared By :-.............</td><td bordercolor="#FFFFFF" colspan="5" width="25%">Checked By :-.................</td><td bordercolor="#FFFFFF" colspan="6" width="25%">Assistant Registrar (Academic and Student Services):-...............</td></tr></tfoot></table>    
</html>
<?php
	}
	if($appType == 'Foreign')
	{
	?>
	<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Foreign Applicants Report - Student Management System - Buddhist & Pali University of Sri Lanka</title>
<script type="text/javascript" src="lib/tablesort/tablesort.js"></script>
<link href="css/print.css" rel="stylesheet" type="text/css" media="screen,print,projection" />
<style type='text/css' media='print'>
	@page {size:A3; size:landscape}
	#btnPrint {display : none}
</style>

<div align="right"><input type="button" id="btnPrint" value="Print" onClick="window.print();return false"/></div>
<h1 align="center"><font size="+3">Buddhist and Pali University of Sri Lanka</font></h1>
<h2 align="center"><font size="+2"><?php echo $entryYear ?>University Admission</font></h2>
<h3 align="center"><font size="+2"> List of eligible students </font></h3>
</head>
	<table align="center" border="1" cellpadding="2" cellspacing="0">
	<thead>
		<tr>
			<th class="sortable-numeric" rowspan="2"><font>Application No</font></th> <!-- index No-->
			<th rowspan="2"><font>Registratin No</font></th> <!-- index No-->
			<th rowspan="2">Name</th> <!-- Name-->
            <th rowspan="2">Passport No</th>
			<th rowspan="2">TP</th>  
			<th rowspan="2">Email</th>  
			<th rowspan="2">Address</th>              
			<th rowspan="2">Country</th><!-- Entry Type-->
			<th  rowspan="2">Exam</th><!-- Exam name-->
		    <th class="sortable-numeric" rowspan="2">Exam Index No</th><!-- A/L No-->
			<th  rowspan="2">Exam Year</th><!-- Exam year-->
    
		
		</tr>
		<tr>
		  <th >Foreign Subjects</th><!-- foreign subjects-->
		 
		  
		 </tr>
	</thead>
     <tbody>
    <?php 
	//$result = $db->executeQuery("SELECT * FROM foreignapplicant JOIN applicant ON foreignapplicant.appNo = applicant.appNo  JOIN student ON applicant.appNo = student.appNo   WHERE entryYear = '$entryYear'  AND  qualified = 'Yes' ");
	
	$result = $db->executeQuery("SELECT * FROM foreignapplicant JOIN applicant ON foreignapplicant.appNo = applicant.appNo   WHERE entryYear = '$entryYear'  AND  qualified = 'Yes' ");
	$i =1; 
	while($row = $db->Next_Record($result))
		{
			$t=$row['appNo'];
			$result22 = $db->executeQuery("SELECT * FROM student  WHERE appNo  = '$t' ");
			while($row22 = $db->Next_Record($result22)){
				$regnoo=$row22['regNo'];
			}
		?>
		<tr>
		    <td><?php echo $row['applicationNo'];?></td>
			<td><?php echo $regnoo?></td>
			<td><?php echo $row['nameEnglish'];?></td>
            <td><?php echo $row['ppNo'];?></td>
			<?php 
			$tp = $row['telNo'].",".$row['telNo1'].",".$row['telNo2'];
			echo "<td>".$tp."</td>";
			$i++;
			?>
			<td align="center"><?php echo $row['email']; ?></td>
			<?php 
			$address = $row['addressEnglish1']."".$row['addressEnglish2']."".$row['addressEnglish3'];
			echo "<td>".$address."</td>";
			$i++;
			?>
			<td align="center"><?php echo $row['country']; ?></td>
			<td align="center"><?php echo $row['exam'];?></td>
			<td align="center"><?php echo $row['indexNo'];?></td>
			<td align="center"><?php echo $row['year'];?></td>	
		</tr>
		<?php
		}?>
   	</tbody> 
    </table>
	<table>
    <tfoot><tr height="30" style="border-bottom:none" style="border-left:none" style="border-right: none"><td bordercolor="#FFFFFF" colspan="5" width="25%">Prepared By :-.............</td><td bordercolor="#FFFFFF" colspan="5" width="25%">Checked By :-.................</td><td bordercolor="#FFFFFF" colspan="6" width="25%">Assistant Registrar (Academic and Student Services):-...............</td></tr></tfoot></table>    
</html>
<?php
	}
	if($appType == 'All')
	{
	?>
	<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Applicants Report - Student Management System - Buddhist & Pali University of Sri Lanka</title>
<script type="text/javascript" src="lib/tablesort/tablesort.js"></script>
<link href="css/print.css" rel="stylesheet" type="text/css" media="screen,print,projection" />
<style type='text/css' media='print'>
	@page {size:A3; size:landscape}
	#btnPrint {display : none}
</style>

<div align="right"><input type="button" id="btnPrint" value="Print" onClick="window.print();return false"/></div>
<h1 align="center"><font size="+3">Buddhist and Pali University of Sri Lanka</font></h1>
<h2 align="center"><font size="+2"><?php echo $entryYear ?>University Admission</font></h2>
<h3 align="center"><font size="+2"> List of eligible students </font></h3>
</head>
	<table align="center" border="1" cellpadding="2" cellspacing="0">
	<thead>
		<tr>
			<th class="sortable-numeric" rowspan="2"><font>Index No</font></th> <!-- index No-->
			<th rowspan="2">Application No</th> <!-- Application No--> 
			<th rowspan="2">Name</th> <!-- Name-->              
			<th rowspan="2">Entry Type</th><!-- Entry Type-->
		    <th rowspan="2">Address</th> <!-- Address-->
		</tr>
	</thead>
     <tbody>
    <?php 
	$result = $db->executeQuery("SELECT * FROM applicant   WHERE entryYear = '$entryYear' AND  qualified = 'Yes' ");
	$i =1; 
	while($row = $db->Next_Record($result))
		{
		?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $row['applicationNo'];?></td>
			<td><?php echo $row['nameEnglish'];?></td>
			<td align="center"><?php if ($row['appType']=='Local') echo 'Local';
			else if ($row['appType']=='Foreign') echo 'Foreign' ?></td>
			<?php 
			$address = $row['addressEnglish1']."".$row['addressEnglish2']."".$row['addressEnglish3'];
			echo "<td>".$address."</td>";
			$i++;
			?>
		</tr>
		<?php
		}?>
   	</tbody> 
    </table>
	   <table>
    <tfoot><tr height="30" style="border-bottom:none" style="border-left:none" style="border-right: none"><td bordercolor="#FFFFFF" colspan="5" width="25%">Prepared By :-.............</td><td bordercolor="#FFFFFF" colspan="5" width="25%">Checked By :-.................</td><td bordercolor="#FFFFFF" colspan="6" width="25%">Assistant Registrar (Academic and Student Services):-...............</td></tr></tfoot></table>    
</html>
<?php
	}
	?>