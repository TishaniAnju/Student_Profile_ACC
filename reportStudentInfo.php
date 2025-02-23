 <?php
ob_start();

include('dbAccess.php');
$db = new DBOperations();
include('authcheck.inc.php');
?>

<h1>Student Information Report</h1>
<form method="get" action="rptStudentInfo.php" class="plain">
<table class="searchResults">

	    <tr>
    	<td>Registration No. : </td><td><select name="lstRegNo" id="lstRegNo" size="auto">
        	<?php
			$result=$db->executeQuery("SELECT DISTINCT regNo FROM student where confirmed = 'Yes'");
			//for ($i=0;$i<mysql_numrows($result);$i++)
			while($row = $db->Next_Record($result))
			{
				//$rRegNo = mysql_result($result,$i,"regNo");
				$rRegNo = $row["regNo"];
              	echo "<option value=\"".$rRegNo."\">".$rRegNo."</option>";
        	} 
			?>
        	</select></td></tr>
                
     
        
</table>
<br/><br/>
<p>&nbsp;&nbsp;&nbsp;<input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'home.php';"  class="button"/>&nbsp;&nbsp;&nbsp;
<input name="btnSubmit" type="submit" value="Report" class="button"></p>

</form>





<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Student Information Report - Student Management System - Buddhisht & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Student Information Report</ul>";
  //Apply the template
  include("master_registration.php");
?>