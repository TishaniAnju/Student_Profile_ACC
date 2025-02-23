 <?php
ob_start();

include('dbAccess.php');
$db = new DBOperations();
include('authcheck.inc.php');
?>

<h1>Student - Subject Wise Report</h1>
<form method="get" action="rptSubject.php" class="plain">
<table class="searchResults">

	    <tr>
    	<td>Select Year : </td><td><select name="lstEntryYear" id="lstEntryYear" size="auto">
        	<?php
			$result=$db->executeQuery("SELECT DISTINCT yearEntry FROM student");
			//for ($i=0;$i<mysql_numrows($result);$i++)
			while($row = $db->Next_Record($result))
			{
				//$rEntryYear = mysql_result($result,$i,"entryYear");
				$rEntryYear = $row["yearEntry"];
              	echo "<option value=\"".$rEntryYear."\">".$rEntryYear."</option>";
        	} 
			?>
        	</select></td></tr>
		<tr>
    	<td>Select Subject : </td><td><select name="lstSubject" id="lstSubject" size="auto">
        	<?php
			$result=$db->executeQuery("SELECT DISTINCT codeEnglish FROM subject order by codeEnglish");
			//for ($i=0;$i<mysql_numrows($result);$i++)
			while($row = $db->Next_Record($result))
			{
				$rSubject = $row["codeEnglish"];
				//$rSubject = mysql_result($result,$i,"codeEnglish");
              	echo "<option value=\"".$rSubject."\">".$rSubject."</option>";
        	} 
			?>
        	</select></td></tr>	
                
        <tr>
    	<td>Select Medium : </td><td><select name="lstMedium" id="lstMedium" size="auto">
        	<?php
			
              	echo "<option value='All'>All</option>";
                echo "<option value='Sinhala'>Sinhala</option>";
				echo "<option value='English'>English</option>";
			?>
        	</select></td></tr>
			
       <tr>
    	<td>Select Degree : </td><td><select name="lstDegree" id="lstDegree" size="auto">
        	<?php
			
              	echo "<option value='All'>All</option>";
                echo "<option value='General'>General</option>";
				echo "<option value='Special-All'>Special-All</option>";
				echo "<option value='Special-A'>Special-A</option>";
				echo "<option value='Special-BC'>Special-BC</option>";
				echo "<option value='Special-BP'>Special-BP</option>";
				echo "<option value='Special-P'>Special-P</option>";
				echo "<option value='Special-S'>Special-S</option>";
				echo "<option value='Special-Sin'>Special-Sin</option>";
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