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
                <th class="sortable-numeric" rowspan="1"><font>Application No</font></th> <!-- index No-->
                <th rowspan="1">Name</th> <!-- Name-->
                <th rowspan="1">Name (Sinhala)</th> <!-- Name-->
                <th rowspan="1">Gardian Name</th> <!-- Nic number-->
                <th rowspan="1">Gardian Name (Sinhala)</th> <!-- TP-->
                <th rowspan="1">Gardian Address</th> <!-- Address-->
                <th rowspan="1">Gardian Address (Sinhala)</th> <!-- Address-->
		</tr>
	</thead>
	<tbody>
            <?php 
            // Fetch and display applicant data
            $result = $db->executeQuery("SELECT * FROM localapplicant JOIN applicant ON localapplicant.appNo = applicant.appNo 
                 WHERE entryYear = '$entryYear' ORDER BY applicationNo");
            $i = 1; 

            while($row = $db->Next_Record($result)) {
                ?>
                <tr>
                    <td><?php echo $row['applicationNo'];?></td>
                    <td><?php echo $row['nameEnglish'];?></td>
                    <td><?php echo $row['nameSinhala'];?></td>
                    <td><?php echo $row['guardianEname'];?></td>
                    <td><?php echo $row['guardianSname'];?></td>
                    <?php 
                    $address = $row['guardianEadd1']."".$row['guardianEadd2']."".$row['guardianEadd3'];
                    echo "<td>".$address."</td>";
                    $i++;
                    ?>
                    <?php 
                   

                    $saddress = $row['guardianSadd1']."".$row['guardianSadd2']."".$row['guardianSadd3'];
                    echo "<td>".$saddress."</td>";
                    $i++;
                    ?>
                   
                </tr>
                <?php
            }
            ?>
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
<title>Student Guardian Report - Student Management System - Buddhist & Pali University of Sri Lanka</title>
<script type="text/javascript" src="lib/tablesort/tablesort.js"></script>
<link href="css/print.css" rel="stylesheet" type="text/css" media="screen,print,projection" />
<style type='text/css' media='print'>
	@page {size:A3; size:landscape}
	#btnPrint {display : none}
</style>

<div align="right"><input type="button" id="btnPrint" value="Print" onClick="window.print();return false"/></div>
<h1 align="center"><font size="+3">Buddhist and Pali University of Sri Lanka</font></h1>
<h2 align="center"><font size="+2"><?php echo $entryYear ?>University Admission</font></h2>
<h3 align="center"><font size="+2"> Student Guardian Details Report</font></h3>
</head>
	<table align="center" border="1" cellpadding="2" cellspacing="0">
	<thead>
	<tr>
                <th class="sortable-numeric" rowspan="1"><font>Application No</font></th> <!-- index No-->
                <th rowspan="1">Name</th> <!-- Name-->
                <th rowspan="1">Guardian Name</th> <!-- Nic number-->
                <th rowspan="1">Guardian Address</th> <!-- Address-->
                <th rowspan="1">Guardian Name Residant </th> <!-- Nic number-->
\                <th rowspan="1">Guardian Address Residant</th> <!-- Address-->
                <th rowspan="1">Guardian Tp Residant</th> <!-- Address-->
            
            </tr>
			</thead>
     <tbody>
    <?php 
	$result = $db->executeQuery("SELECT * FROM foreignapplicant JOIN applicant ON foreignapplicant.appNo = applicant.appNo   WHERE entryYear = '$entryYear'  AND  qualified = 'Yes' ");
	$i =1; 
	while($row = $db->Next_Record($result))
		{
		?>
		<tr>

                    <td><?php echo $row['applicationNo'];?></td>
                    <td><?php echo $row['nameEnglish'];?></td>
                    <td><?php echo $row['gnameE'];?></td>
                    <?php 
                    $address = $row['gadde1']."".$row['gadde1']."".$row['gadde1'];
                    echo "<td>".$address."</td>";
                    $i++;
                    ?>
                    <td><?php echo $row['gaNameR'];?></td>
                    
                    <?php 
                    
                    $saddress = $row['rsladde1']."".$row['rsladde2']."".$row['rsladde3'];
                    echo "<td>".$saddress."</td>";
                    $i++;
                    ?>
                    <td><?php echo $row['RSLtelNo'];?></td>
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