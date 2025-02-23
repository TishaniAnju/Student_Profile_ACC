<?php
  //Buffer larger content areas like the main page content
  ob_start();
 ?>
 
 <?php

  //2021.03.23 startinclude('dbAccess.php');
  require_once("dbAccess.php");
  $db = new DBOperations();
  //2021.03.23 end 

  

  //include('authcheck.inc.php');
  //session_start();
  if (isset($_POST['stores'])) {
      
    $query = "SELECT * FROM sto_bincard " ; 
    $result = $db->executeTransaction($query);
    while($row=$db->Next_Record($result))
                    {
                        $queryS="INSERT INTO sto_bin_cards set binDate='".$row['binDate']."', binMSerial = '".$row['binMSerial']."' , binVch_PO = '".$row['binVch_PO']."' , binRct = '".$row['binRct']."', binSerial = '".$row['binSerial']."', binItemCode = '".$row['binItemCode']."' , binQty = '".$row['binQty']."' , binUnitPrice = '".$row['binUnitPrice']."', binBalance = '".$row['binBalance']."', binRmks = '".$row['binRmks']."', binType ='".$row['binType']."' ";
    
                        //2021.03.24 start  $resultS = executeQuery($queryS);
                        $resultS = $db->executeQuery($queryS);
    
    
                    }

  }
  
?>
  
  <form method="post" action="" class="plain">
  <table style="margin-left:8px" class="panel">
  

	<td><input name="stores" type="button" value="Transfer to stores" onclick="document.location.href = 'stores.php';" class="button" /></td>
</table>
</form>
     

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Students - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Students</li></ul>";
  //Apply the template
  include("master_registration.php");
?>