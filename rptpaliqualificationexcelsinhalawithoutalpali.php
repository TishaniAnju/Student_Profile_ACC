<?php
include('dbAccess.php');
$db = new DBOperations();
//include('authcheck.inc.php');

###excel####

$filename ="rpt_pali_qualification_sinhala.xls";
$contents = "testdata1 \t testdata2 \t testdata3 \t \n";
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename); 

###excel####

//$entryYear = $db->cleanInput($_GET['entryYear']);
$ALYear = $db->cleanInput($_GET['alYear']);
$title = $db->cleanInput($_GET['titleE']);
$entryYear = $db->cleanInput($_GET['entryYear']);

//$appType = $db->cleanInput($_GET['appType']);
//$result = $db->executeQuery("SELECT * FROM localapplicant JOIN applicantsubjects ON localapplicant.appNo = applicantsubjects.appNo WHERE alYear = '$ALYear' AND subjectCode = '12'   ORDER BY zScore");
//$result = $db->executeQuery("SELECT * FROM applicant JOIN localapplicant ON applicant.appNo = localapplicant.appNo WHERE entryYear = '$entryYear' AND appType = '$appType'  ");

?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Applicants Report - Student Management System - Buddhist & Pali University of Sri Lanka</title>
<script type="text/javascript" src="lib/tablesort/tablesort.js"></script>
<link href="css/print.css" rel="stylesheet" type="text/css" media="screen,print,projection" />
<style type='text/css' media='print'>
	@page {size:A3; size:landscape}
	#btnPrint {display : none}
</style>

<div align="right"><input type="button" id="btnPrint" value="Print" onClick="window.print();return false"/></div>
<h1 align="center"><font size="+3">Buddhist and Pali University of Sri Lanka</font></h1>
<h2 align="center"><font size="+2">University Admission <?php echo $ALYear + 1 ?>/ <?php echo $ALYear + 2 ?></font></h2>
<h3 align="center"><font size="+2"> G.C.E A / L Results <?php echo $ALYear ?></font></h3>
<h4 align="center"><font face="kaputadotcom2004" size="+2">Other Pali Qualification (<?php if($title == 'Ven.'){echo "Monks";}elseif($title=='Mr.'){echo "Boys";}elseif($title=='All'){echo "All";}elseif($title=='Ms.'){echo "Girls";}elseif($title=='Mrs.'){echo "Girls";}?>)</font></h4>
</head>
	<table border="1" cellpadding="2" cellspacing="0">
	<thead>
		<tr>
			<th class="sortable-numeric" rowspan="2"><font>Index No:</font></th> <!-- index No-->
			<th rowspan="2">නම</th> <!-- Name-->
            <th rowspan="2">N.I.C</th>
			<th rowspan="2">Entry Type</th><!-- Entry Type-->
		    <th class="sortable-numeric" rowspan="2">A/L Index No:</th><!-- A/L No-->
			<th class="sortable-numeric" rowspan="2">Z Score</th><!-- Z score-->

		    <th colspan="4">G.C.E A/L</th>
		    <th colspan="6">Pali Qualification</th>
		    <th class="sortable-numeric" rowspan="2">Application No:</th> <!-- App No-->
		    <th rowspan="2">ලිපිනය</th>  
			<!-- Address-->
		</tr>
		<tr>
		  <th>Common General Test</th><!-- General Know-->
		  <th>Subject 1</th>
		  <th>Subject 2</th>
		  <th>Subject 3</th>
          <?php 
		  $resultH = $db->executeQuery("SELECT qualificationE FROM paliqualification");
		  while($row = $db->Next_Record($resultH))
		  //while ($row = mysql_fetch_array($resultH))
		  echo "<th>".$row['qualificationE']."</th>";		  
		  ?>
		 </tr>
	</thead>
     <tbody>
    <?php 
	if($title == 'All'){
	$result = $db->executeQuery("SELECT * FROM localapplicant JOIN applicantpali ON localapplicant.appNo = applicantpali.appNo JOIN applicant ON localapplicant.appNo = applicant.appNo WHERE alYear = '$ALYear' AND entryYear='$entryYear' AND code !='p01' AND result IS NOT NULL  ORDER BY  zScore DESC
    ");
	$i =1; 
	while($row = $db->Next_Record($result))

	//while ($row = mysql_fetch_array($result))
		{
		?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $row['nameSinhala'];?></td>
            <td><?php echo $row['nicNo'];?></td>
			<td align="center"><?php if ($row['entryType']=='Normal') echo 'Normal';
			else if ($row['entryType']=='Sanskrit') echo 'Sanskrit' ?></td>
			<td align="center"><?php echo $row['alAdNo'];?></td>
			<td align="center"><?php echo $row['zScore'];?></td>
			<td align="center"><?php echo $row['gkScore'];?></td>
			<?php 
			$resultSub1 = $db->executeQuery("SELECT subnameE,result FROM applicantsubjects JOIN alsubjects ON applicantsubjects.subjectCode = alsubjects.subjectCode WHERE applicantsubjects.appNo = $row[0]");
			//if (mysql_num_rows($resultSub1)==3)
			if($db->Row_Count($resultSub1)==3)
				{
				//while ($rowSub1 = mysql_fetch_array($resultSub1))
				while($rowSub1 = $db->Next_Record($resultSub1))

					echo "<td align='center'>".$rowSub1['subnameE']. ":" .$rowSub1['result']."</td>";
				}
			//elseif (mysql_num_rows($resultSub1)==2)
			elseif ($db->Row_Count($resultSub1)==2)
				{ 
				//while ($rowSub1 = mysql_fetch_array($resultSub1))
				while($rowSub1 = $db->Next_Record($resultSub1))

						echo "<td align='center'>".$rowSub1['subnameE']. ":" .$rowSub1['result']."</td>";
				echo "<td> - </td>";
				}
				
			//elseif (mysql_num_rows($resultSub1)==1)
			elseif ($db->Row_Count($resultSub1)==1)

				{ 	
					//while ($rowSub1 = mysql_fetch_array($resultSub1))
					while($rowSub1 = $db->Next_Record($resultSub1))

						echo "<td align='center'>".$rowSub1['subnameE']. ":" .$rowSub1['result']."</td>";
					for ($j=1;$j<3;$j++){		
						echo "<td> - </td>";}
				}
			//elseif (mysql_num_rows($resultSub1)==0)
			elseif ($db->Row_Count($resultSub1)==0)

			{ 	
				for ($j=1;$j<4;$j++){		
					echo "<td> - </td>";}
			}
				
			
			for ($j=1;$j<=6;$j++)
			{
				$resultSub2 = $db->executeQuery("SELECT result FROM applicantpali WHERE appNo = $row[0] AND code = 'p0$j'");
				//if (mysql_num_rows($resultSub2)>0)
				if ($db->Row_Count($resultSub2)>0)
				{
					//$rowSub2 = mysql_fetch_array($resultSub2);
					$rowSub2 = $db->Next_Record($resultSub2);

					echo "<td width='3' align='center'>".$rowSub2['result']."</td>";
				}
				else echo "<td width='3'> - </td>";
			}
			?>     
			
			<td align="center"><?php echo $row['applicationNo'];?></td>
			<?php 
                        			$address = $row['addS1']."".$row['addS2']."".$row['addS3'];
			//$address = $row['addressEnglish1']."".$row['addressEnglish2']."".$row['addressEnglish3'];
			//$addressLength = strlen($address);
			//if ($addressLength<60)
			echo "<td>".$address."</td>";
			
			/*else
			{
				if ($addressLength<120) $pdf->MultiCell(60,7.5,$address,1,'L');
				else $pdf->MultiCell(60,7.5,substr($address,0,100) + '...',1,'L');
			}*/
		  
			$i++;
			?>
		</tr>
		<?php
		}}
		if($title != All)
		{
			$result = $db->executeQuery("SELECT * FROM localapplicant JOIN applicantpali ON localapplicant.appNo = applicantpali.appNo JOIN applicant ON localapplicant.appNo = applicant.appNo WHERE alYear = '$ALYear' AND entryYear='$entryYear' AND code !='p01' AND result IS NOT NULL AND titleE = '$title'  ORDER BY  zScore DESC
    ");
	$i =1; 
	while($row = $db->Next_Record($result))

	//while ($row = mysql_fetch_array($result))
		{
		?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $row['nameSinhala'];?></td>
            <td><?php echo $row['nicNo'];?></td>
			<td align="center"><?php if ($row['entryType']=='Normal') echo 'Normal';
			else if ($row['entryType']=='Sanskrit') echo 'Sanskrit' ?></td>
			<td align="center"><?php echo $row['alAdNo'];?></td>
			<td align="center"><?php echo $row['zScore'];?></td>
			<td align="center"><?php echo $row['gkScore'];?></td>
			<?php 
			$resultSub1 = $db->executeQuery("SELECT subnameE,result FROM applicantsubjects JOIN alsubjects ON applicantsubjects.subjectCode = alsubjects.subjectCode WHERE applicantsubjects.appNo = $row[0]");
			//if (mysql_num_rows($resultSub1)==3)
			if($db->Row_Count($resultSub1)==3)
				{
				//while ($rowSub1 = mysql_fetch_array($resultSub1))
				while($rowSub1 = $db->Next_Record($resultSub1))

					echo "<td align='center'>".$rowSub1['subnameE']. ":" .$rowSub1['result']."</td>";
				}
			//elseif (mysql_num_rows($resultSub1)==2)
			elseif ($db->Row_Count($resultSub1)==2)
				{ 
				//while ($rowSub1 = mysql_fetch_array($resultSub1))
				while($rowSub1 = $db->Next_Record($resultSub1))

						echo "<td align='center'>".$rowSub1['subnameE']. ":" .$rowSub1['result']."</td>";
				echo "<td> - </td>";
				}
				
			//elseif (mysql_num_rows($resultSub1)==1)
			elseif ($db->Row_Count($resultSub1)==1)

				{ 	
					//while ($rowSub1 = mysql_fetch_array($resultSub1))
					while($rowSub1 = $db->Next_Record($resultSub1))

						echo "<td align='center'>".$rowSub1['subnameE']. ":" .$rowSub1['result']."</td>";
					for ($j=1;$j<3;$j++){		
						echo "<td> - </td>";}
				}
			//elseif (mysql_num_rows($resultSub1)==0)
			elseif ($db->Row_Count($resultSub1)==0)

			{ 	
				for ($j=1;$j<4;$j++){		
					echo "<td> - </td>";}
			}
				
			
			for ($j=1;$j<=6;$j++)
			{
				$resultSub2 = $db->executeQuery("SELECT result FROM applicantpali WHERE appNo = $row[0] AND code = 'p0$j'");
				//if (mysql_num_rows($resultSub2)>0)
				if ($db->Row_Count($resultSub2)>0)
				{
					//$rowSub2 = mysql_fetch_array($resultSub2);
					$rowSub2 = $db->Next_Record($resultSub2);

					echo "<td width='3' align='center'>".$rowSub2['result']."</td>";
				}
				else echo "<td width='3'> - </td>";
			}
			?>     
			
			<td align="center"><?php echo $row['applicationNo'];?></td>
			<?php 
                        			$address = $row['addS1']."".$row['addS2']."".$row['addS3'];
			//$address = $row['addressEnglish1']."".$row['addressEnglish2']."".$row['addressEnglish3'];
			//$addressLength = strlen($address);
			//if ($addressLength<60)
			echo "<td>".$address."</td>";
			
			/*else
			{
				if ($addressLength<120) $pdf->MultiCell(60,7.5,$address,1,'L');
				else $pdf->MultiCell(60,7.5,substr($address,0,100) + '...',1,'L');
			}*/
		  
			$i++;
			?>
		</tr>
		<?php
		}}
		?>
   	</tbody>
	</table> 
    <table>
    <tfoot><tr height="30" style="border-bottom:none" style="border-left:none" style="border-right: none"><td bordercolor="#FFFFFF" colspan="5" width="25%">Prepared By :-.............</td><td bordercolor="#FFFFFF" colspan="5" width="25%">Checked By :-.................</td><td bordercolor="#FFFFFF" colspan="6" width="25%">Assistant Registrar (Academic and Student Services):-...............</td></tr></tfoot></table>    
</html>
