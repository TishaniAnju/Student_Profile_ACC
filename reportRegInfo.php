 <?php
ob_start();

include('dbAccess.php');
$db = new DBOperations();
//include('authcheck.inc.php');
?>

<h1>Student Registration Report</h1>
<form method="get" action="rptRegInfo.php" class="plain">
<table class="searchResults">

	    <tr>
    	<td>Entry Year : </td><td><select name="lstEntryYear" id="lstEntryYear" size="auto">
        	<?php
			$result=$db->executeQuery("SELECT DISTINCT yearEntry FROM student");
			
			//for ($i=0;$i<mysql_numrows($result);$i++)
			while($resultSet = $db->Next_Record($result))

			{
				//$rEntryYear = mysql_result($result,$i,"entryYear");
				$rEntryYear = $resultSet["yearEntry"];
              	echo "<option value=\"".$rEntryYear."\">".$rEntryYear."</option>";
        	} 
			?>
        	</select></td>

			<td>Faculty : </td><td><select name="lstFaculty" id="lstFaculty" size="auto">
        	<?php
			$result=$db->executeQuery("SELECT DISTINCT faculty FROM student");
			
			//for ($i=0;$i<mysql_numrows($result);$i++)
			while($resultSet = $db->Next_Record($result))

			{
				//$rEntryYear = mysql_result($result,$i,"entryYear");
				$rFaculty = $resultSet["faculty"];
              	echo "<option value=\"".$rFaculty."\">".$rFaculty."</option>";
        	} 
			?>
        	</select></td>
		
		
		
		</tr>
                
     
        
</table>
<br/><br/>
<p>&nbsp;&nbsp;&nbsp;<input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'home.php';"  class="button"/>&nbsp;&nbsp;&nbsp;
<!--<a href="rptApplicants.php" id="printLink" onClick="OpenPopup(this.href); return false">Click Here to See Popup</a>-->
<input name="btnSubmit" type="submit" value="Excel Report" class="button"></p>


</form>





<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Enrollment Reports - Student Management System - Buddhisht & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Applicants Report</ul>";
  //Apply the template
  include("master_registration.php");
?>