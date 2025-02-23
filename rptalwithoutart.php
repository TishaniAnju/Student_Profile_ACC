<?php
include('dbAccess.php');
$db = new DBOperations();
//include('authcheck.inc.php');

$entryYear = $db->cleanInput($_GET['entryYear']);
$al =  $db->cleanInput($_GET['al']);
$title = $db->cleanInput($_GET['title']);

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
        @page {
            size: A3;
            size: landscape
        }

        #btnPrint {
            display: none
        }
    </style>

    <div align="right"><input type="button" id="btnPrint" value="Print" onClick="window.print();return false" /></div>
    <h1 align="center"><font size="+3">Buddhist and Pali University of Sri Lanka</font></h1>
    <h2 align="center"><font size="+2">University Admission <?php echo $entryYear  ?>/ <?php echo $entryYear + 1 ?></font></h2>
    <h3 align="center"><font size="+2">G.C.E A / L Results <?php echo $entryYear ?></font></h3>
	<h4 align="center"><font face="kaputadotcom2004" size="+2">A/L Passed Without Art Stream With Other Pali Qulification Student List (
            <?php
            if ($title == 'Ven.') {
                echo "Monks";
            } elseif ($title == 'Mr.') {
                echo "Boys";
            } elseif ($title == 'all') {
                echo "All";
            } elseif ($title == 'Ms.') {
                echo "Girls";
            } elseif ($title == 'Mrs.') {
                echo "Girls";
            } ?>)</font></h4>
</head>


	<table border="1" cellpadding="2" cellspacing="0">
	<thead>
		<tr>
			<th class="sortable-numeric" rowspan="2"><font>Index No:</font></th> <!-- index No-->
			<th rowspan="2">Name</th> <!-- Name-->
            <th rowspan="2">N.I.C</th>
			<th rowspan="2">Entry Type</th><!-- Entry Type-->
		    <th class="sortable-numeric" rowspan="2">A/L Index No:</th><!-- A/L No-->
			<th class="sortable-numeric" rowspan="2">Z Score</th><!-- Z score-->

		    <th colspan="4">G.C.E A/L</th>
		    <th colspan="7">Pali Qualification</th>
		    <th class="sortable-numeric" rowspan="2">Application No:</th> <!-- App No-->
		    <!-- <th rowspan="2">Address</th>  -->
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
	if($title == 'all'){ 
		/*$result = $db->executeQuery("SELECT * FROM localapplicant JOIN applicant ON localapplicant.appNo = applicant.appNo WHERE 
            localapplicant.appNo NOT IN ( SELECT localapplicant.appNo FROM localapplicant 
										JOIN applicantquli ON localapplicant.appNo = applicantquli.appNo 
										JOIN applicant ON localapplicant.appNo = applicant.appNo 
										JOIN applicantsubjects ON localapplicant.appNo = applicantsubjects.appNo  
										WHERE  applicantquli.stream = '1' AND applicantsubjects.subjectCode<=24) 
			localapplicant.appNo  IN (SELECT localapplicant.appNo FROM localapplicant JOIN applicantquli ON localapplicant.appNo = applicantquli.appNo 
										WHERE  applicantquli.stream IN ('3', '4', '5')								
            AND localapplicant.appNo IN (SELECT localapplicant.appNo FROM localapplicant JOIN applicant ON localapplicant.appNo = applicant.appNo 
										JOIN applicantpali ON localapplicant.appNo = applicantpali.appNo WHERE result IS NOT NULL  ) 
               AND entryYear='$entryYear' AND alYear='$al'");*/


// $result = $db->executeQuery("SELECT * FROM localapplicant JOIN applicant ON localapplicant.appNo = applicant.appNo WHERE 
// 			localapplicant.appNo NOT IN ( SELECT localapplicant.appNo FROM localapplicant 
// 										JOIN applicantquli ON localapplicant.appNo = applicantquli.appNo
// 										JOIN applicant ON localapplicant.appNo = applicant.appNo 
// 										JOIN applicantSubjects ON localapplicant.appNo=applicantSubjects.appNo 
// 										where applicantquali.stream='1' OR applicantSubjects.subjectCode<=24)
// 			 localapplicant.appNo  IN (SELECT localapplicant.appNo FROM localapplicant 
// 			 							JOIN applicantpali ON localapplicant.appNo = applicantpali.appNo WHERE applicantpali.result IS NOT NULL)
// 			  AND entryYear='$entryYear' 
// 			  AND alYear='$al'
// 			");
// Combined query with filtering
$query = "
    SELECT 
        applicantquli.Id, 
        applicantquli.appNo, 
        qulidetails.description AS quli_description, 
        applicantquli.quli_year, 
        applicantquli.indexNo, 
        applicantquli.medium, 
        alstream.description AS stream_description,
        paliqualification.qualificationE, 
        applicantpali.result
    FROM 
        applicantquli
    INNER JOIN 
        qulidetails 
    ON 
        applicantquli.quli_id = qulidetails.quli_id
    INNER JOIN 
        alstream 
    ON 
        applicantquli.stream = alstream.streamId
    INNER JOIN 
        applicantpali 
    ON 
        applicantquli.appNo = applicantpali.appNo
    INNER JOIN 
        paliqualification 
    ON 
        applicantpali.code = paliqualification.code
    WHERE 
        alstream.description NOT IN ('A/L');
";

// Execute the query
$filtedData = $db->executeQuery($query);

	$i =1; 

	
	
	while($row = $db->Next_Record($result))
		{
		?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $row['nameEnglish'];?></td>
            <td><?php echo $row['nicNo'];?></td>
			<td align="center"><?php if ($row['entryType']=='Normal') echo 'Normal';
			else if ($row['entryType']=='Sanskrit') echo 'Sanskrit' ?></td>
			<td align="center"><?php echo $row['alAdNo'];?></td>
			<td align="center"><?php echo $row['zScore'];?></td>
			<td align="center"><?php echo $row['gkScore'];?></td>
			<?php 
			$resultSub1 = $db->executeQuery("SELECT subnameE,result FROM applicantsubjects JOIN alsubjects ON applicantsubjects.subjectCode = alsubjects.subjectCode WHERE applicantsubjects.appNo = $row[0] ");
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
			$i++;
			?>
		</tr>
		<?php
		}}
		if($title != 'All')
		{	

			 /*$result = $db->executeQuery("SELECT * FROM localapplicant JOIN applicant ON localapplicant.appNo = applicant.appNo WHERE 
           localapplicant.appNo NOT IN ( SELECT localapplicant.appNo FROM localapplicant JOIN applicantquli ON localapplicant.appNo = applicantquli.appNo 
										JOIN applicant ON localapplicant.appNo = applicant.appNo 
										JOIN applicantsubjects ON localapplicant.appNo = applicantsubjects.appNo  
										WHERE  applicantquli.stream = '1' AND applicantsubjects.subjectCode<=24 )
			localapplicant.appNo  IN (SELECT localapplicant.appNo FROM localapplicant JOIN applicantquli ON localapplicant.appNo = applicantquli.appNo
			 
										WHERE applicantquli.stream IN ('3', '4', '5')									
            AND localapplicant.appNo IN (SELECT localapplicant.appNo FROM localapplicant JOIN applicant ON localapplicant.appNo = applicant.appNo 
										JOIN applicantpali ON localapplicant.appNo = applicantpali.appNo WHERE result IS NOT NULL  ) 
            AND titleE='$title'  AND entryYear='$entryYear' AND alYear='$al'");*/

			$result = $db->executeQuery("SELECT * FROM localapplicant JOIN applicant ON localapplicant.appNo = applicant.appNo WHERE 
			localapplicant.appNo NOT IN ( SELECT localapplicant.appNo FROM localapplicant JOIN applicantquli ON localapplicant.appNo = applicantquli.appNo
										JOIN applicant ON applicant.appNo = applicantquli.appNo
										JOIN applicantSubjects ON localapplicant.appNo=applicantSubjects.appNo 
										where applicantquali.stream='1' OR applicantSubjects.subjectCode<=24)
			 localapplicant.appNo  IN (SELECT localapplicant.appNo FROM localapplicant 
			 							JOIN applicantpali ON localapplicant.appNo = applicantpali.appNo WHERE applicantpali.result IS NOT NULL)
			 AND titleE='$title'  AND entryYear='$entryYear' AND alYear='$al'
			");

	$i =1; 
	while($row = $db->Next_Record($result))

	//while ($row = mysql_fetch_array($result))
		{
		?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $row['nameEnglish'];?></td>
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
