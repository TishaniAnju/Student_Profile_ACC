<?php
include('dbAccess.php');
$db = new DBOperations();
//include('authcheck.inc.php');

###excel####

$filename ="Registered Student List.xls";
$contents = "testdata1 \t testdata2 \t testdata3 \t \n";
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename='.$filename); 

###excel####

$entryYear = $db->cleanInput($_GET['lstEntryYear']);
$faculty = $db->cleanInput($_GET['lstFaculty']);

?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student Registration Report - Student Management System - Buddhist & Pali University of Sri Lanka</title>
<script type="text/javascript" src="lib/tablesort/tablesort.js"></script>
<link href="css/print.css" rel="stylesheet" type="text/css" media="screen,print,projection" />
<style type='text/css' media='print'>
	@page {size:A4; size:landscape}
	#btnPrint {display : none}
</style>

<div align="right"><input type="button" id="btnPrint" value="Print" onClick="window.print();return false"/></div>
<h1 align="center"><font size="+3">Student Registration Report</font></h1>
<h2 align="center"><font size="+2"><?php echo $entryYear ?> University Entrance</font></h2>
</head>
	<table align="center" border="1" cellpadding="2" cellspacing="0">
	<thead>
		<tr>
		   <th rowspan="2">Id</th> <!-- Name-->

			<th class="sortable-numeric" rowspan="2"><font>Registration No:</font></th> <!-- index No-->
			<th rowspan="2">Name</th> <!-- Name-->
			<th rowspan="2">Name Sinhala</th> <!-- Name-->
            <th rowspan="2">N.I.C</th>
			<th rowspan="2">Entry Type</th><!-- Entry Type-->
			<th rowspan="2">A/L Year</th><!-- Entry Type-->
		    <th class="sortable-numeric" rowspan="2">A/L Index No:</th><!-- A/L No-->
			<th class="sortable-numeric" rowspan="2">Z Score</th><!-- Z score-->

		    <th colspan="4">G.C.E A/L</th>
		    <th colspan="6">Pali Qualification</th>
			<th rowspan="2">Address</th><!-- Entry Type-->
			<th rowspan="2">Sinhala Address</th>
			<th rowspan="2">District</th><!-- Entry Type-->
			<th rowspan="2">Contact No.</th><!-- Entry Type-->
			<th rowspan="2">Email</th><!-- Entry Type-->
			<th rowspan="2">Birthday</th>
			<th rowspan="2">Nikaya</th>
			<th rowspan="2">Chapter</th><!-- Entry Type-->
			<th rowspan="2">Guardian Name</th><!-- Entry Type-->
			<th rowspan="2">Guardian Address</th><!-- Entry Type-->

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
    $result = $db->executeQuery("SELECT * FROM student JOIN localapplicant ON student.appNo=localapplicant.appNo WHERE yearEntry ='$entryYear' AND confirmed = 'Yes' AND faculty = '$faculty' ORDER BY regNo");

	//$result = $db->executeQuery("SELECT title, nameEnglish,regNo,id_pp_No,addressE1,addressE2,addressE3,district,entryType,yearEntry,faculty,degreeType,medium,id_pp_No,contactNo,email,birthday,citizenship,nationality,religion,civilStatus,guardName,guardAddress,guardContactNo,Scholarship,confirmed,current_sem,alYear FROM student JOIN localapplicant ON student.appNo=localapplicant.appNo WHERE yearEntry ='$entryYear' AND confirmed = 'Yes' AND faculty = '$faculty' ORDER BY regNo");
	$i =1; 
	//while ($row = mysql_fetch_array($result))
	while($row = $db->Next_Record($result))

		{
		?>
		<tr>
			<td align="center"><?php echo $i; ?></td>
			<td align="center"><?php echo $row['regNo'];?></td>
			<td><?php echo $row['nameEnglish'];?></td>
			<td><?php echo $row['nameSinhala'];?></td>
			<td align="center"><?php echo $row['id_pp_No'];?></td>
			<td align="center"><?php echo $row['entryType'];?></td>
			<td align="center"><?php echo $row['alYear'];?></td>
			<td align="center"><?php echo $row['alAdNo'];?></td>
			<td align="center"><?php echo $row['zScore'];?></td>
			<td align="center"><?php echo $row['gkScore'];?></td>

			<?php 
			
//-------------------------------------------------------------------------------------------

			$xxvalue=$row['nikaya'];
			$yyvalue=$row['chapter'];
			
			
			$resultN = $db->executeQuery("SELECT nikayaName FROM nikaya where nikayaID= '$xxvalue'");
		  while($rowN = $db->Next_Record($resultN)){

			$nikaya=$rowN[0];
		  }

	
		  $resultCccc = $db->executeQuery("SELECT chapter FROM chapter where chapterID='$yyvalue'");
//print 
		  while($rowCccc = $db->Next_Record($resultCccc)){

			$chaptervalue=$rowCccc['chapter'];
		  }
		  
	

//=====================================================================================

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

			<?php 
			$address = $row['addressE1']." ".$row['addressE2']." ".$row['addressE3'];
			//$addressLength = strlen($address);
			//if ($addressLength<60)
			echo "<td>".$address."</td>";
			$addressS = $row['addS1']." ".$row['addS2']." ".$row['addS3'];
			//$addressLength = strlen($address);
			//if ($addressLength<60)
			echo "<td>".$addressS."</td>";?>
			
			
			
			
            <!-- <td><img name="photo" src="" width="114" height="114" align="absmiddle" alt="photo"></td>
            <td width="114"><label style="width:114; height:114"></label></td> -->
           
			<td align="center"><?php echo $row['district'];?></td>
			<td align="center"><?php echo $row['contactNo'];?></td>
			<td align="center"><?php echo $row['email'];?></td>
			
			<td align="center"><?php echo $row['birthday'];?></td>

			<td align="center"><?php echo $nikaya;?></td>
			<td align="center"><?php echo $chaptervalue;?></td>
			<td align="center"><?php echo $row['guardName'];?></td>
			<?php 
			$address = $row['guardianEadd1']." ".$row['guardianEadd2']." ".$row['guardianEadd3'];
			//$addressLength = strlen($address);
			//if ($addressLength<60)
			echo "<td>".$address."</td>";?>

			<?php 
			$i++;
			?>
		</tr>
		<?php
		}?>
   	</tbody> 
   
    </table>    
</html>
