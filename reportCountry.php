 <?php
ob_start();

include('dbAccess.php');
$db = new DBOperations();
include('authcheck.inc.php');
?>

<h1>Foreign Students by Country Report</h1>
<form method="get" action="rptCountry.php" class="plain">
  <table width="180" class="searchResults">
    <tr>
    	<td>Select Year : </td><td><select name="lstEntryYear" id="lstEntryYear" size="auto">
        	<?php
			$result=$db->executeQuery("SELECT DISTINCT year FROM foreignapplicant order by year");
			//for ($i=0;$i<mysql_numrows($result);$i++)
			while($resultSet = $db->Next_Record($result))
			{
				//$rEntryYear = mysql_result($result,$i,"entryYear");
				$rEntryYear = $resultSet["year"];
              	echo "<option value=\"".$rEntryYear."\">".$rEntryYear."</option>";
        	} 
			?>
        	</select></td></tr>
		<tr>
    	
      <td>Select Country : </td>
      <td><select name="lstCountry" id="lstCountry" size="auto">
        	<?php
			$result=$db->executeQuery("SELECT DISTINCT country FROM foreignapplicant order by country");
			//for ($i=0;$i<mysql_numrows($result);$i++)
			while($resultSet = $db->Next_Record($result))
			{
				//$rCountry = mysql_result($result,$i,"country");
				$rCountry = $resultSet["country"];
              	echo "<option value=\"".$rCountry."\">".$rCountry."</option>";
        	} 
			?>
        	</select></td></tr>	
                
     
        
</table>
<br/><br/>
<p>&nbsp;&nbsp;&nbsp;<input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'home.php';"  class="button"/>&nbsp;&nbsp;&nbsp;
<!--<a href="rptApplicants.php" id="printLink" onClick="OpenPopup(this.href); return false">Click Here to See Popup</a>-->
<input name="btnSubmit" type="submit" value="Report" class="button"></p>

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