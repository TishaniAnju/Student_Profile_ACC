<?php
include('dbAccess.php');
$db = new DBOperations();
//include('authcheck.inc.php');

//$entryYear = $db->cleanInput($_GET['entryYear']);

$title = $db->cleanInput($_GET['title']);
$entryYear = $db->cleanInput($_GET['entryYear']);
//$appType = $db->cleanInput($_GET['appType']);
//$result = $db->executeQuery("SELECT * FROM localapplicant JOIN applicantsubjects ON localapplicant.appNo = applicantsubjects.appNo WHERE alYear = '$ALYear' AND subjectCode = '12'   ORDER BY zScore");
//$result = $db->executeQuery("SELECT * FROM applicant JOIN localapplicant ON applicant.appNo = localapplicant.appNo WHERE entryYear = '$entryYear' AND appType = '$appType'  ");
/* $result = $db->executeQuery("SELECT * FROM localapplicant JOIN applicantsubjects ON localapplicant.appNo = applicantsubjects.appNo JOIN applicant ON localapplicant.appNo = applicant.appNo WHERE alYear = '$ALYear' AND subjectCode = '12' AND titleE = '$title'
ORDER BY zScore"); */
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
<h1 align="center"><font size="+3">ශ්‍රී ලංකා බෞ‍ද්ධ හා පාලි විශ්වවි‍ද්‍යාලය</font></h1>
<h2 align="center"><font size="+2"><?php echo $entryYear ?>/ <?php echo $entryYear+1 ?> විශ්වවි‍ද්‍යාල ප්‍රවේශය</font></h2>
<h3 align="center"><font size="+2"> අයදුම් කර ඇති සිසුන්ගේ නාම ලේඛනය - ???????????? ???? (
<?php
            if ($title == 'Ven.') {
                echo "  පූජ්‍ය ";
            } elseif ($title == 'Mr.') {
                echo "  පුරුෂ ";
            } elseif ($title == 'all') {
                echo "  සියළු ";
            } elseif ($title == 'Ms.') {
                echo "  ස්ත්‍රී ";
            } elseif ($title == 'Mrs.') {
                echo "  ස්ත්‍රී ";
            } ?>)
</font></h3>
</head>


	<table border="1" cellpadding="2" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th class="sortable-numeric" rowspan="2"><font>අනු අංකය</font></th> <!-- index No-->
				<th rowspan="2">නම</th> <!-- Name-->
				<th rowspan="2">ජාතික හැඳුනුම්පත් අංකය</th>
				<th rowspan="2">වයස</th>
				<th rowspan="2">ප්‍රවේශය</th><!-- Entry Type-->
				<th rowspan="2">මාධ්‍ය</th>
				<th rowspan="2" class="sortable-numeric">විභාග අංකය</th><!-- Entry Year-->
				<th rowspan="2" class="sortable-numeric">විභාග වර්ශය</th><!-- Exam Year-->
				<th colspan="3">ප්‍රාචීණ මධ්‍යම විභාගය:</th>

				
				<th class="sortable-numeric" rowspan="2">අයදුම්පත් අංකය</th> <!-- App No-->
				<!-- <th rowspan="2">Address</th>  -->
				<!-- Address-->
			</tr>
			<tr>
				
			<th>විෂය 1</th>
			<th>විෂය 2</th>
			<th>විෂය 3</th>
			
			</tr>
		</thead>
		<tbody>
		<?php 
		if($title == 'all'){ 
			$result = $db->executeQuery( "SELECT *            -- Concatenate results into a comma-separated list
					FROM localapplicant AS la
					JOIN applicant AS a ON la.appNo = a.appNo
					JOIN applicantquli AS aq ON la.appNo = aq.appNo
					WHERE aq.quli_id = '8' AND a.entryYear = '$entryYear'
					" );


				/* ("SELECT * 
				FROM localapplicant 
				JOIN applicant ON localapplicant.appNo = applicant.appNo
				JOIN applicantquli ON localapplicant.appNo = applicantquli.appNo 
				WHERE localapplicant.appNo IN (
					SELECT localapplicant.appNo 
					FROM localapplicant 
					JOIN applicantsubjects ON localapplicant.appNo = applicantsubjects.appNo 
					WHERE applicantsubjects.quli_id = '5'
				) 
				AND entryYear = '$entryYear'") */
			$i =1; 

			while ($row = $db->Next_Record($result)) {
				// Calculate age from DOB
				$dob = new DateTime($row['dob']);
				$now = new DateTime();
				$age = $dob->diff($now)->y;
			
				// Output table row with age
				?>
		
			<tr>
			<td align="center"><?php echo $i; ?></td>
				<td align="center"><?php echo $row['nameSinhala'];?></td>
				<td align="center"><?php echo $row['nicNo'];?></td>
				<td align="center"><?php echo $age;?></td>
				<td align="center"><?php if ($row['entryType']=='Normal') echo 'සාමාන්‍ය';
				else if ($row['entryType']=='Sanskrit') echo 'සංස්කෘත' ?></td>
				<td align="center"><?php if ($row['medium']=='s') echo'සිංහල';
				else if ($row['medium']=='e') echo'ඉංග්‍රීසි';?></td>
				<td align="center"><?php echo $row['indexNo'];?></td>
				<td align="center"><?php echo $row['quli_year'];?></td>
				<?php 
				$resultSub1 = $db->executeQuery("SELECT subnameS,result FROM applicantsubjects JOIN alsubjects ON applicantsubjects.subjectCode = alsubjects.subjectCode 
				WHERE applicantsubjects.appNo = $row[0] AND applicantsubjects.quli_id = '8'");
				//if (mysql_num_rows($resultSub1)==3)
				if($db->Row_Count($resultSub1)==3)
					{
					//while ($rowSub1 = mysql_fetch_array($resultSub1))
					while($rowSub1 = $db->Next_Record($resultSub1))

						echo "<td align='center'>".$rowSub1['subnameS']. ":" .$rowSub1['result']."</td>";
					}
				//elseif (mysql_num_rows($resultSub1)==2)
				elseif ($db->Row_Count($resultSub1)==2)
					{ 
					//while ($rowSub1 = mysql_fetch_array($resultSub1))
					while($rowSub1 = $db->Next_Record($resultSub1))

							echo "<td align='center'>".$rowSub1['subnameS']. ":" .$rowSub1['result']."</td>";
					echo "<td> - </td>";
					}
					
				//elseif (mysql_num_rows($resultSub1)==1)
				elseif ($db->Row_Count($resultSub1)==1)

					{ 	
						//while ($rowSub1 = mysql_fetch_array($resultSub1))
						while($rowSub1 = $db->Next_Record($resultSub1))

							echo "<td align='center'>".$rowSub1['subnameS']. ":" .$rowSub1['result']."</td>";
						for ($j=1;$j<3;$j++){		
							echo "<td> - </td>";}
					}
				//elseif (mysql_num_rows($resultSub1)==0)
				elseif ($db->Row_Count($resultSub1)==0)

				{ 	
					for ($j=1;$j<4;$j++){		
						echo "<td> - </td>";}
				}
				
				?>     
				
				<td align="center"><?php echo $row['applicationNo'];?></td>
				<?php 
				//$address = $row['addressEnglish1']."".$row['addressEnglish2']."".$row['addressEnglish3'];
				//$addressLength = strlen($address);
				//if ($addressLength<60)
				//echo "<td>".$address."</td>";
				
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
			if($title != 'All')
			{
				
				$result = $db->executeQuery( "SELECT *            -- Concatenate results into a comma-separated list
				FROM localapplicant AS la
				JOIN applicant AS a ON la.appNo = a.appNo				
				JOIN applicantquli AS aq ON la.appNo = aq.appNo
				WHERE aq.quli_id = '8' AND a.entryYear = '$entryYear'
				AND titleE='$title' 
				" );

		$i =1; 
		while ($row = $db->Next_Record($result)) {
			// Calculate age from DOB
			$dob = new DateTime($row['dob']);
			$now = new DateTime();
			$age = $dob->diff($now)->y;
		
			// Output table row with age
			?>
	
		<tr>
		<td align="center"><?php echo $i; ?></td>
			<td align="center"><?php echo $row['nameSinhala'];?></td>
			<td align="center"><?php echo $row['nicNo'];?></td>
			<td align="center"><?php echo $age;?></td>
			<td align="center"><?php if ($row['entryType']=='Normal') echo 'සාමාන්‍ය';
			else if ($row['entryType']=='Sanskrit') echo 'සංස්කෘත' ?></td>
			<td align="center"><?php if ($row['medium']=='s') echo'සිංහල';
			else if ($row['medium']=='e') echo'ඉංග්‍රීසි';?></td>
			<td align="center"><?php echo $row['indexNo'];?></td>
			<td align="center"><?php echo $row['quli_year'];?></td>
			<?php 
			$resultSub1 = $db->executeQuery("SELECT subnameS,result FROM applicantsubjects JOIN alsubjects ON applicantsubjects.subjectCode = alsubjects.subjectCode 
			WHERE applicantsubjects.appNo = $row[0] AND applicantsubjects.quli_id = '8'");
			//if (mysql_num_rows($resultSub1)==3)
			if($db->Row_Count($resultSub1)==3)
				{
				//while ($rowSub1 = mysql_fetch_array($resultSub1))
				while($rowSub1 = $db->Next_Record($resultSub1))

					echo "<td align='center'>".$rowSub1['subnameS']. ":" .$rowSub1['result']."</td>";
				}
			//elseif (mysql_num_rows($resultSub1)==2)
			elseif ($db->Row_Count($resultSub1)==2)
				{ 
				//while ($rowSub1 = mysql_fetch_array($resultSub1))
				while($rowSub1 = $db->Next_Record($resultSub1))

						echo "<td align='center'>".$rowSub1['subnameS']. ":" .$rowSub1['result']."</td>";
				echo "<td> - </td>";
				}
				
			//elseif (mysql_num_rows($resultSub1)==1)
			elseif ($db->Row_Count($resultSub1)==1)

				{ 	
					//while ($rowSub1 = mysql_fetch_array($resultSub1))
					while($rowSub1 = $db->Next_Record($resultSub1))

						echo "<td align='center'>".$rowSub1['subnameS']. ":" .$rowSub1['result']."</td>";
					for ($j=1;$j<3;$j++){		
						echo "<td> - </td>";}
				}
			//elseif (mysql_num_rows($resultSub1)==0)
			elseif ($db->Row_Count($resultSub1)==0)

			{ 	
				for ($j=1;$j<4;$j++){		
					echo "<td> - </td>";}
			}
			
			?>     
			
			<td align="center"><?php echo $row['applicationNo'];?></td>
			<?php 
			//$address = $row['addressEnglish1']."".$row['addressEnglish2']."".$row['addressEnglish3'];
			//$addressLength = strlen($address);
			//if ($addressLength<60)
			//echo "<td>".$address."</td>";
			
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
		<tfoot>
			<tr height="30" style="border-bottom:none" style="border-left:none" style="border-right: none" >
				<td bordercolor="#FFFFFF" colspan="5" width="20%">සකස් කළේ :-.............................. </td>
				<td bordercolor="#FFFFFF" colspan="5" width="20%">පරික්ෂා කළේ :-................................... </td>
				<td bordercolor="#FFFFFF" colspan="6" width="25%">සහකාර ලේඛකාධිකාරී(අධ්‍යයන හා ශිෂ්‍ය සේවා):-................................ </td>
			</tr>
		</tfoot>
	</table>    
</html>
