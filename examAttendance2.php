<?php
  //Buffer larger content areas like the main page content
  ob_start();
?>

<script>
function validate_form(thisform)
{
	with (thisform)
	  {
		if (!validate_required(txtAcYear))
		{alert("One or more mandatory fields are kept blank.");return false;}
	  }
}
</script>

<h1>Exam Attendance</h1>
<?php
	include('dbAccess.php');
  	include('authcheck.inc.php');
?>
<form method="get" action="rptExamAttendance.php" onsubmit="return validate_form(this);" class="plain">
<table class="searchResults">
    <tr>
    	<td>Batch (By entry year) : </td><td><select name="lstEntryYear" id="lstEntryYear">
            <?php
				$result = executeQuery("SELECT DISTINCT yearEntry FROM student");
				if (mysql_num_rows($result)>0)
				{
					while ($row=mysql_fetch_array($result))
					{
						echo "<option value='".$row['yearEntry']."'>".$row['yearEntry']."</option>";
					}
				}
			?>
            </select>
     	</td>
    </tr>
    <tr>
    	<td>Faculty : </td><td><select name="lstFaculty">
        		<option value="Buddhist">Buddhist Studies</option>
            	<option value="Language">Language Studies</option>
            </select>
       	</td>
    </tr>
    <tr>
    	<td>Degree Type : </td><td><select name="lstDegreeType">
        		<option value="General">General</option>
                <option value="Special-A">Special - Archeology</option>
                <option value="Special-BC">Special - Buddhist Culture</option>
                <option value="Special-BP">Special - Buddhist Philosophy</option>
                <option value="Special-P">Special - Pali</option>
                <option value="Special-S">Special - Sanskrit</option>
            </select>
       	</td>
    </tr>
    <tr>
    	<td>Acdemic Year : </td><td><input name="txtAcYear" type="text" /></td>
    </tr>
</table>
<br/><br/>
<p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'home.php';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="submit" value="Create" class="button" /></p>
</form>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Exam Attendance - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li></li><li>Exam Attendance</li></ul>";
  //Apply the template
  include("master_registration.php");
?>