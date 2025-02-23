<?php
  //Buffer larger content areas like the main page content
  ob_start();
?>



<h1>Academic Transcript</h1>
<?php

	//2021.03.24 start  include('dbAccess.php');
	require_once("dbAccess.php");
	$db = new DBOperations();
	//2021.03.24 end
	include('authcheck.inc.php');
	
	if (isset($_POST['btnSubmit']))
	{
		$type = $_POST['lstType'];
		$medium = $_POST['lstMedium'];
		$indexNo = $_POST['lstIndexNo'];
		$acYear = $_POST['txtAcYear'];
		$date = $_POST['txtdate'];
		$withMarks = $_POST['chkMarks'];
		$exPeriod = $_POST['txtExperiod'];
		if ($medium=='English')
		header("location:rptTranscriptE.php?type=$type&indexNo=$indexNo&acYear=$acYear&withMarks=$withMarks&exPeriod=$exPeriod&date=$date&medium=$medium&lstType=$lstType");
		else if ($medium=='Sinhala')
		header("location:rptTranscriptS.php?type=$type&indexNo=$indexNo&acYear=$acYear&withMarks=$withMarks&exPeriod=$exPeriod&date=$date&medium=$medium&lstType=$lstType");
	}
?>
<form method="post" action="" onsubmit="return validate_form(this);" class="plain">
<table class="searchResults">
	<tr>
    	<td>Type : </td><td><select name="lstType">
        		<option value="Full">Full</option>
            	<option value="1">First Year Semester I</option>
                <option value="2">First Year Semester II</option>
                <option value="3">Second Year Semester I</option>
                <option value="4">Second Year Semester II</option>
				<option value="5">Third Year Semester I</option>
                <option value="6">Third Year Semester II</option>
				<option value="7">Fourth Year Semester I</option>
                <option value="8">Fourth Year Semester II</option>
            </select>
       	</td>
    </tr>
    <tr>
    	<td>Medium : </td><td><select name="lstMedium">
        		<option value="English">English</option>
            	<option value="Sinhala">Sinhala</option>
            </select>
       	</td>
    </tr>
    <tr>
    	<td>Index No. : </td><td><select name="lstIndexNo" id="lstIndexNo">
            <?php
				//2021.03.24 start  $result = executeQuery("SELECT DISTINCT indexNo FROM exameffort");
				$result = $db->executeQuery("SELECT DISTINCT indexNo FROM exameffort");
				//2021.03.24 end
				//2021.03.24 start  if (mysql_num_rows($result)>0)
				if ($db->Row_Count($result)>0)
				//2021.03.24 end
				{
					//2021.03.24 start  while ($row=mysql_fetch_array($result))
					while ($row=$db->Next_Record($result))
					//2021.03.24 end
					{
						echo "<option value='".$row['indexNo']."'>".$row['indexNo']."</option>";
					}
				}
			?>
            </select>
     	</td>
    </tr>
    <tr>
    	<td>Ac. Year : </td><td><input name="txtAcYear" type="text" value="" /></td>
    </tr>
	<tr>
    	<td>Exam Period : </td><td><input name="txtExperiod" type="text" value="" /></td>
    </tr>
	  <tr>
    	<td>Effective Date of the Degree : </td><td><input name="txtdate" type="text" value="" /></td>
    </tr>
    <tr>
    	<td colspan="2"><input name="chkMarks" type="checkbox" /> With marks</td>
    </tr>
</table>
<br/><br/>
<p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'home.php';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="submit" value="Create" class="button" /></p>
</form>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
   $pagetitle = "Academic Transcript - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Academic Transcript</li></ul>";
  //Apply the template
  include("master_registration.php");
?>