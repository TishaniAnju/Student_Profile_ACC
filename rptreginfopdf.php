<?php
include('dbAccess.php');
$db = new DBOperations();
include('authcheck.inc.php');



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
		<tr style="height:50px;">
			<!-- <th>Index No</th>  -->
			<th>Id</th>
			<th>Name</th>
            <th>Registration No</th>
            <th>ID/Passport No</th>                
			<th>Address</th><!-- Entry Type-->
		    <!-- <th>A/L Year</th> -->
		    <!-- <th>Signature</th> -->
		       
		</tr>
	
	</thead>
     <tbody>
    <?php 
	$result = $db->executeQuery("SELECT title, nameEnglish,regNo,id_pp_No,addressE1,addressE2,addressE3 FROM student WHERE yearEntry ='$entryYear' AND confirmed = 'Yes' AND faculty = '$faculty' ORDER BY regNo");
	$i =1; 
	//while ($row = mysql_fetch_array($result))
	while($row = $db->Next_Record($result))

		{
		?>
		<tr>
			<td align="center"><?php echo $i; ?></td>
			<td><?php echo $row['title']." ".$row['nameEnglish'];?></td>
            <td align="center"><?php echo $row['regNo'];?></td>
			<td align="center"><?php echo $row['id_pp_No'];?></td>
			<?php 
			$address = $row['addressE1']." ".$row['addressE2']." ".$row['addressE3'];
			//$addressLength = strlen($address);
			//if ($addressLength<60)
			echo "<td>".$address."</td>";?>
            <!-- <td><img name="photo" src="" width="114" height="114" align="absmiddle" alt="photo"></td>
            <td width="114"><label style="width:114; height:114"></label></td> -->
            <?php 
			$i++;
			?>
		</tr>
		<?php
		}?>
   	</tbody> 
    </table>    
</html>
