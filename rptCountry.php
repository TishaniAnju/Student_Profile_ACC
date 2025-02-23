<?php
include('dbAccess.php');
$db = new DBOperations();
include('authcheck.inc.php');

$entryYear = $db->cleanInput($_GET['lstEntryYear']);
$country = $db->cleanInput($_GET['lstCountry']);
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
<h1 align="center"><font size="+3">Foreign Students by Country</font></h1>
<h2 align="center"><font size="+2">Country : 
  <?php echo $country ?>
  </font></h2>
<h2 align="center"><font size="+2">Entrance Year: 
  <?php echo $entryYear ?>
  </font></h2>
</head>
	<table align="center" border="1" cellpadding="2" cellspacing="0">
	<thead>
		<tr style="height:50px;">
			
      <th width="55">Serial No</th>
      <!-- index No-->
			<th width="55">Name</th>
            <th width="87">Registration No</th>
            <th width="95">ID/Passport No</th>                
			<th width="181">Address</th>
		       
		</tr>
	
	</thead>
     <tbody>
    <?php 
	$result = $db->executeQuery("SELECT title, nameEnglish,id_pp_No,regNo,addressE1,addressE2,addressE3 FROM student s, foreignapplicant f 
	                         WHERE f.year ='$entryYear' and (f.country = '$country') and
							       (f.appNo = right(s.appno,3)) ORDER BY regNo");
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
            
      <td>&nbsp;</td>
            <td width="9"><label style="width:114; height:114"></label></td>
            <?php 
			$i++;
			?>
		</tr>
		<?php
		}?>
   	</tbody> 
    </table>    
</html>
