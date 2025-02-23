<?php
include('dbAccess.php');
include('authcheck.inc.php');

$entryYear = cleanInput($_GET['lstEntryYear']);
?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="lib/tablesort/tablesort.js"></script>
<link href="css/print.css" rel="stylesheet" type="text/css" media="screen,print,projection" />
<style type='text/css' media='print'>
	@page {size:DL; size:landscape}
	#btnPrint {display : none}
</style>

<div align="right"><input type="button" id="btnPrint" value="Print" onClick="window.print();return false"/></div>
</head>

	
    <?php 
	//@page {width:834px; height:415px; size:landscape}
	$result = executeQuery("SELECT nameSinhala,addS1,addS2,addS3 FROM localapplicant JOIN applicant ON localapplicant.appNo = applicant.appNo WHERE entryYear = '$entryYear' AND qualified ='Yes'  ORDER BY zScore");
	while ($row = mysql_fetch_array($result))
		{
		?>
	
<p>&nbsp;</p>
<p>&nbsp;</p>
<table align="center" width="750px" height="266" border="0">
  <tr>
            <td height="150px" colspan="2" rowspan="2"></td> 
        </tr>
        <tr><td width="360" align="left" style="width:350px; height:150px; border:none">
<p>BPU/ASS-01/11/
        <?php echo $entryYear;?>
      </p>
      </td>
        <td width="350" align="left" valign="bottom" style="width:350px; height:150px; border:none"><?php echo $row['nameSinhala'].",<br/>".$row['addS1']."<br/>". $row['addS2']."<br/>".$row['addS3'];?></td></tr>
        <tr></tr>
     </table> 
     <div style="page-break-after:always"></div>
         <?php
		 }
		 ?>
             	
			           
</html>
