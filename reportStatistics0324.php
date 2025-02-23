<?php
  //Buffer larger content areas like the main page content
  ob_start();
 ?>

<h1> Applicant Statistics Report </h1>

<?php
  include("dbAccess.php");
  include("authcheck.inc.php");
?>
<form method="get" action="rptStatistics.php" class="plain">
<table class="searchResults">

	    <tr>
    	<td>Entry Year : </td><td><select name="lstEntryYear" id="lstEntryYear" size="auto">
        	<?php
			$result=executeQuery("SELECT DISTINCT entryYear FROM applicant");
			for ($i=0;$i<mysql_numrows($result);$i++)
			{
				$rEntryYear = mysql_result($result,$i,"entryYear");
              	echo "<option value=\"".$rEntryYear."\">".$rEntryYear."</option>";
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
  $pagetitle = "Applicant Statistics Report - Student Management System - Buddhisht & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Statistics Report</ul>";
  //Apply the template
  include("master_registration.php");
?>