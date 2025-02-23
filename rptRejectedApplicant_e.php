<?php
// File: rptSelectedApplicants_e.php
// Purpose: Generate a report for selected applicants

// Include the database access class
include('dbAccess.php');
$db = new DBOperations();

$entryYear = $db->cleanInput($_GET['entryYear']);
$appType = $db->cleanInput($_GET['appType']);

if ($appType == 'Local') {
?>

	<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Rejected Local Applicants Report - Student Management System - Buddhist & Pali University of Sri Lanka</title>
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
		<h1 align="center">
			<font size="+3">Buddhist and Pali University of Sri Lanka</font>
		</h1>
		<h2 align="center">
			<font size="+2"><?php echo $entryYear ?> - University Admission</font>
		</h2>
		<h3 align="center">
			<font size="+2"> List of Rejected Applicants </font>
		</h3>
		
	</head>
	<table border="1" cellpadding="2" cellspacing="0">
		<thead>
			<tr>
				<th class="sortable-numeric" rowspan="1">
					<font>Application No</font>
				</th> <!-- index No-->
                <th rowspan="1">Title</th> <!-- Nic number-->
				<th rowspan="1">Name</th> <!-- Name-->
                <th rowspan="1">Address</th> <!-- Address-->
				<th rowspan="1">TP</th> <!-- TP-->
				<th rowspan="1">NIC</th> <!-- Email-->
			</tr>
		</thead>
		<tbody>
			<?php
			$result = $db->executeQuery("SELECT * FROM localapplicant JOIN applicant ON localapplicant.appNo = applicant.appNo WHERE entryYear = '$entryYear' ORDER BY applicationNo");
			$i = 1;

			while ($row = $db->Next_Record($result)) {
			?>
				<tr>
					<td><?php echo $row['applicationNo']; ?></td>
					<td><?php echo $row['titleE']; ?></td>
					<td><?php echo $row['nameEnglish']; ?></td>
					<?php
					$address = $row['addressEnglish1'] . "" . $row['addressEnglish2'] . "" . $row['addressEnglish3'];
					echo "<td>" . $address . "</td>";
					$i++;
					?>
					<td><?php echo $row['telno']; ?></td>
					<td><?php echo $row['nicNo']; ?></td>
					
				</tr>
			<?php
			} ?>
		</tbody>

		<tfoot>
			<tr height="30" style="border-bottom:none" style="border-left:none" style="border-right: none">
				<td bordercolor="#FFFFFF" colspan="5" width="25%">Prepared By :-.............</td>
				<td bordercolor="#FFFFFF" colspan="5" width="25%">Checked By :-.................</td>
				<td bordercolor="#FFFFFF" colspan="6" width="25%">Assistant Registrar (Academic and Student Services):-...............</td>
			</tr>
		</tfoot>
	</table>

	</html>
<?php
}
if ($appType == 'Foreign') {
?>
	<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Rejected Foreign Applicants Report - Student Management System - Buddhist & Pali University of Sri Lanka</title>
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
		<h1 align="center">
			<font size="+3">Buddhist and Pali University of Sri Lanka</font>
		</h1>
		<h2 align="center">
			<font size="+2"><?php echo $entryYear ?> - University Admission</font>
		</h2>
		<h3 align="center">
			<font size="+2"> List of Rejected Applicants </font>
		</h3>
		
	</head>
	<table align="center" border="1" cellpadding="2" cellspacing="0">
		<thead>
			<tr>
				<th class="sortable-numeric" rowspan="1">
					<font>Application No</font>
				</th> <!-- index No-->
                <th rowspan="1">Title</th> <!-- Nic number-->
				<th rowspan="1">Name</th> <!-- Name-->
                <th rowspan="1">Address</th> <!-- Address-->
				<th rowspan="1">Country</th><!-- Entry Type-->
				<th rowspan="1">TP</th> <!-- TP-->
				<th rowspan="1">Passport No</th> <!-- Email-->
			</tr>	
		</thead>
		<tbody>
			<?php
			$result = $db->executeQuery("SELECT * FROM foreignapplicant JOIN applicant ON foreignapplicant.appNo = applicant.appNo   WHERE entryYear = '$entryYear'  AND  qualified = 'Yes' ");
			$i = 1;
			while ($row = $db->Next_Record($result)) {
			?>
				<tr>
				    <td><?php echo $row['applicationNo']; ?></td>
					<td><?php echo $row['titleE']; ?></td>
					<td><?php echo $row['nameEnglish']; ?></td>
				    <?php
					$address = $row['addressEnglish1'] . "" . $row['addressEnglish2'] . "" . $row['addressEnglish3'];
					echo "<td>" . $address . "</td>";
					$i++;
					?>
					<td align="center"><?php echo $row['country']; ?></td>
					<?php
					$tp = $row['telNo'] . "," . $row['telNo1'] . "," . $row['telNo2'];
					echo "<td>" . $tp . "</td>";
					$i++;
					?>
					<td><?php echo $row['ppNo']; ?></td>
				</tr>
			<?php
			} ?>
		</tbody>
	</table>
	<table>
		<tfoot>
			<tr height="30" style="border-bottom:none" style="border-left:none" style="border-right: none">
				<td bordercolor="#FFFFFF" colspan="5" width="25%">Prepared By :-.............</td>
				<td bordercolor="#FFFFFF" colspan="5" width="25%">Checked By :-.................</td>
				<td bordercolor="#FFFFFF" colspan="6" width="25%">Assistant Registrar (Academic and Student Services):-...............</td>
			</tr>
		</tfoot>
	</table>

	</html>
<?php
}
if ($appType == 'All') {
?>
	<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Rejected Applicants Report - Student Management System - Buddhist & Pali University of Sri Lanka</title>
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
		<h1 align="center">
			<font size="+3">Buddhist and Pali University of Sri Lanka</font>
		</h1>
		<h2 align="center">
			<font size="+2"><?php echo $entryYear ?> - University Admission</font>
		</h2>
		<h3 align="center">
			<font size="+2"> List of Rejected Applicants </font>
		</h3>
		
	</head>
	<table align="center" border="1" cellpadding="2" cellspacing="0">
		<thead>
			<tr>
			<th class="sortable-numeric" rowspan="1">
					<font>Index No</font></th> 
				<th rowspan="1">Application No</th> <!-- Nic number-->
				<th rowspan="1">Title</th> <!-- Nic number-->
				<th rowspan="1">Name</th> <!-- Name-->
				<th rowspan="1">Entry Type</th><!-- Entry Type-->
                <th rowspan="1">Address</th> <!-- Address-->
				
			</tr>
		</thead>	
		<tbody>
			<?php
			$result = $db->executeQuery("SELECT * FROM applicant   WHERE entryYear = '$entryYear' AND  qualified = 'Yes' ");
			$i = 1;
			while ($row = $db->Next_Record($result)) {
			?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $row['applicationNo']; ?></td>
					<td><?php echo $row['titleE']; ?></td>
					<td><?php echo $row['nameEnglish']; ?></td>
					<td align="center"><?php if ($row['appType'] == 'Local') echo 'Local';
										else if ($row['appType'] == 'Foreign') echo 'Foreign' ?></td>
					<?php
					$address = $row['addressEnglish1'] . "" . $row['addressEnglish2'] . "" . $row['addressEnglish3'];
					echo "<td>" . $address . "</td>";
					$i++;
					?>
				</tr>
			<?php
			} ?>
		</tbody>
	</table>
	<table>
		<tfoot>
			<tr height="30" style="border-bottom:none" style="border-left:none" style="border-right: none">
				<td bordercolor="#FFFFFF" colspan="5" width="25%">Prepared By :-.............</td>
				<td bordercolor="#FFFFFF" colspan="5" width="25%">Checked By :-.................</td>
				<td bordercolor="#FFFFFF" colspan="6" width="25%">Assistant Registrar (Academic and Student Services):-...............</td>
			</tr>
		</tfoot>
	</table>

	</html>
<?php
}
?>