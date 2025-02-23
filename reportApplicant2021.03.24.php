<?php
  //Buffer larger content areas like the main page content
  ob_start();
 ?>

<h1> Applicant Report </h1>

<?php

  include("dbAccess.php");
  include("authcheck.inc.php");

if (isset($_POST['btnSubmit']))
	{
		$entryYear = $_POST['lstEntryYear'];
		$alYear = $_POST['lstALYear'];
		$selected = $_POST['chkSelected'];
		if ($selected=='on')
			header("location:rptSelectedApplicants.php?entryYear=$entryYear&alYear=$alYear");
		else header("location:rptApplicants.php?entryYear=$entryYear&alYear=$alYear");
	}

if (isset($_POST['btnSubmit2']))
	{
		$entryYear = $_POST['lstEntryYear'];
		$alYear = $_POST['lstALYear'];
		$selected = $_POST['chkSelected'];
		if ($selected=='on')
			header("location:rptSelectedApplicants_e.php?entryYear=$entryYear&alYear=$alYear");
		else header("location:rptApplicants_e.php?entryYear=$entryYear&alYear=$alYear");
	}

?>
<form method="post" action="" class="plain">
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
         <tr>
         <td>A/L Year : </td><td><select name="lstALYear" id="lstALYear" size="auto">
        	<?php
			$result=executeQuery("SELECT DISTINCT alYear FROM localapplicant");
			for ($i=0;$i<mysql_numrows($result);$i++)
			{
				$rALYear = mysql_result($result,$i,"alYear");
				echo "<option value=\"".$rALYear."\">".$rALYear."</option>";
        	} 
			?>
        	</select></td></tr>
          <tr>
    		<td colspan="2"><input name="chkSelected" type="checkbox" /> Selected applicants only</td>
   		 </tr>
    	
        
     
        
</table>
<br/><br/>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
    <!--<a href="rptApplicants.php" id="printLink" onClick="OpenPopup(this.href); return false">Click Here to See Popup</a>-->
    <input name="btnSubmit" type="submit" value="Report-Sinhala" class="button">
    <input name="btnSubmit2" type="submit" value="Report-English" class="button">
    <input name="btnCancel" type="button" value="Cancel" onClick="document.location.href = 'home.php';"  class="button"/>
  </p>
</form>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Applicants Report - Student Management System - Buddhisht & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Applicants Report</ul>";
  //Apply the template
  include("master_registration.php");
?>