<?php
//2021-03-25 start  include('dbAccess.php');
require_once("dbAccess.php");
$db = new DBOperations();
//2021-03-25 end
include('authcheck.inc.php');

//2021-03-25 start  $entryYear = cleanInput($_GET['lstEntryYear']);
$entryYear = $db->cleanInput($_GET['lstEntryYear']);
$alYear = $db->cleanInput($_GET['lstALYear']);
$title = $db->cleanInput($_GET['title']);
$qualificayion = $db->cleanInput($_GET['qualification']);


//2021-03-25 end
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
	//2021-03-25 start  $result = executeQuery("SELECT nameSinhala,addS1,addS2,addS3 FROM localapplicant JOIN applicant ON localapplicant.appNo = applicant.appNo WHERE entryYear = '$entryYear' AND qualified ='Yes'  ORDER BY zScore");
  //$result = $db->executeQuery("SELECT nameSinhala,addS1,addS2,addS3 FROM localapplicant JOIN applicant ON localapplicant.appNo = applicant.appNo WHERE entryYear = '$entryYear' AND qualified ='Yes'  ORDER BY zScore");
  if($qualificayion=="pali")
  {
  $result = $db->executeQuery("SELECT * FROM localapplicant JOIN applicantsubjects ON localapplicant.appNo = applicantsubjects.appNo JOIN applicant ON localapplicant.appNo = applicant.appNo WHERE alYear = '$alYear' AND subjectCode = '12' AND titleE='$title'  ORDER BY zScore DESC");

  $i=1;
  //2021-03-25 end
	//2021-03-25 start  while ($row = mysql_fetch_array($result))
  while ($row = $db->Next_Record($result))
  //2021-03-25 end
		{
		?>
	
<p>&nbsp;</p>
<p>&nbsp;</p>
<table align="center" width="750px" height="450" border="0">
  <tr>
             <td height="20px" width="70px" style="border:hidden;" >
             <p>Serial No:<?php echo $i;?>
      </p>
             </td>  
        </tr>

        <tr><td  width="350" align="left" style="width:350px; height:150px; border:hidden; ">
<p>BPU/ASS-04/UD-11/<?php echo $entryYear;?>
      </p>
      </td>
        <td width="350" align="left"  style="width:350px; height:150px; border:hidden;"><?php echo $row['nameSinhala'].",<br/>".$row['addS1']."<br/>". $row['addS2']."<br/>".$row['addS3'];?></td>
      </tr>
        
       
     </table> 
     <div style="page-break-after:always"></div>
         <?php
         $i++;
		 }
    }
    elseif($qualificayion=="other_pali")
    {
      $result = $db->executeQuery("SELECT * FROM localapplicant JOIN applicantpali ON localapplicant.appNo = applicantpali.appNo JOIN applicant ON localapplicant.appNo = applicant.appNo WHERE alYear = '$alYear' AND titleE = '$title' AND result IS NOT NULL  ORDER BY  zScore DESC");

      //$result = $db->executeQuery("SELECT * FROM localapplicant JOIN applicantsubjects ON localapplicant.appNo = applicantsubjects.appNo JOIN applicant ON localapplicant.appNo = applicant.appNo WHERE alYear = '$alYear' AND subjectCode = '12' AND titleE='$title'  ORDER BY zScore DESC");

      $i=1;
      //2021-03-25 end
      //2021-03-25 start  while ($row = mysql_fetch_array($result))
      while ($row = $db->Next_Record($result))
      //2021-03-25 end
        {
        ?>
      
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <table align="center" width="750px" height="450" border="0">
      <tr>
                 <td height="20px" width="70px" style="border:hidden;" >
                 <p>Serial No:<?php echo $i;?>
          </p>
                 </td>  
            </tr>
    
            <tr><td  width="350" align="left" style="width:350px; height:150px; border:hidden; ">
    <p>BPU/ASS-04/UD-11/<?php echo $entryYear;?>
          </p>
          </td>
            <td width="350" align="left"  style="width:350px; height:150px; border:hidden;"><?php echo $row['nameSinhala'].",<br/>".$row['addS1']."<br/>". $row['addS2']."<br/>".$row['addS3'];?></td>
          </tr>
            
           
         </table> 
         <div style="page-break-after:always"></div>
             <?php
             $i++;
         }

    }
		 ?>
             	
			           
</html>
