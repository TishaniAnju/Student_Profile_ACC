<?php
  //Buffer larger content areas like the main page content
  ob_start();
?>

<script>
function validate_form(thisform)
{
	with (thisform)
	  {
		if (!validate_required(txtCodeEnglish) || !validate_required(txtNameEnglish))
		{alert("One or more mandatory fields are kept blank.");return false;}
	  }
}
</script>

<h1>New Subject</h1>
<?php
	include('dbAccess.php');
  	include('authcheck.inc.php');
	
	if (isset($_POST['btnSubmit']))
	{
		$codeEnglish = cleanInput($_POST['txtCodeEnglish']);
		$nameEngslih = cleanInput($_POST['txtNameEnglish']);
		$codeSinhala = cleanInput($_POST['txtCodeSinhala']);
		$nameSinhala = cleanInput($_POST['txtNameSinhala']);
		$faculty = $_POST['lstFaculty'];
		$semester = $_POST['subSemester'];
		$level = $_POST['txtLevel'];
		$spCategory = $_POST['spCategory'];
		$spRelated  = $_POST['spRelated'];
		$chours = cleanInput($_POST['txtChours']);
		$description = cleanInput($_POST['txtDescription']);
		
		$query = "INSERT INTO subject SET codeEnglish='$codeEnglish', nameEnglish='$nameEngslih', codeSinhala='$codeSinhala', nameSinhala='$nameSinhala', faculty='$faculty', level='$level',spCategory='$spCategory',spRelated='$spRelated',description='$description',semester='$semester',creditHours='$chours'";
		$result = executeQuery($query);
		header("location:subjectAdmin.php");
		//header("location:message.php?message=Successfully inserted!");
	}
?>
<form method="post" action="" onsubmit="return validate_form(this);" class="plain">
<table class="searchResults">
    <tr>
    	<td>Code (English) : </td><td><input name="txtCodeEnglish" type="text" value="" /></td>
    </tr>
    <tr>
    	<td>Name (English) : </td><td><input name="txtNameEnglish" type="text" value="" style="width:300px"/></td>
    </tr>
    <tr>
    	<td>Code (Sinhala) : </td><td><input name="txtCodeSinhala" type="text" value="" /></td>
    </tr>
    <tr>
    	<td>Name (Sinhala) : </td><td><input name="txtNameSinhala" type="text" value="" style="width:300px"/></td>
    </tr>
    <tr>
    	
      <td height="28">Faculty : </td>
      <td><select name="lstFaculty">
        	<option value="Buddhist">Buddhist Studies</option>
        	<option value="Language">Language Studies</option>
        </select></td>
    </tr>
    <tr>
    	<td>Level : </td>
		 <td><select name="txtLevel">
        	<option value="I">One</option>
			<option value="II">Two</option>
				<option value="III">Three</option>
        	<option value="IV">Four</option>
        </select></td>
    </tr>
	<tr>
    	
      <td>Semester : </td>
      <td><select name="subSemester">
        	<option value="First Semester">First Semester</option>
        	<option value="Second Semester">Second Semester</option>
        </select></td>
    </tr>
	<tr>
    <tr>
    	
      <td>Department : </td>
      <td><select name="spCategory">
        
  <?php  
			
			//$query = "SELECT * FROM subject WHERE level='$level' and semester='$semester'";
			$query = "SELECT * FROM department";
		//print $query;
			$result = executeQuery($query);
			for ($i=0;$i<mysql_numrows($result);$i++)
			{
				$rID = mysql_result($result,$i,"departmentNo");
				$rCode = mysql_result($result,$i,"department");
				
              	echo "<option value=\"".$rID."\">".$rCode."</option>";
        	} 
			
			?>
        </select></td>
    </tr>
        </select></td>
    </tr>	
      <td>Special Related : </td>
      <td><select name="spRelated">
        
        	<option value="N">No</option>
			<option value="Y">Yes</option>
        </select></td>
    </tr>
	<tr>
    	
      <td>Credit Hours: </td>
      <td><input name="txtChours" type="text" value="" /></td>
    </tr>
    <tr>
    	<td>Description : </td><td><input name="txtDescription" type="text" value="" style="width:300px" /></td>
    </tr>
</table>
<br/><br/>
<p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'subjectAdmin.php';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="submit" value="Submit" class="button" /></p>
</form>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
   $pagetitle = "New Subject - Subjects - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='subjectAdmin.php'>Subjects </a></li><li>New Subject</li></ul>";
  //Apply the template
  include("master_registration.php");
<?php
  //Buffer larger content areas like the main page content
  ob_start();
?>

<script>
function validate_form(thisform)
{
	with (thisform)
	  {
		if (!validate_required(txtCodeEnglish) || !validate_required(txtNameEnglish))
		{alert("One or more mandatory fields are kept blank.");return false;}
	  }
}
</script>

<h1>New Subject</h1>
<?php
	include('dbAccess.php');
  	include('authcheck.inc.php');
	
	if (isset($_POST['btnSubmit']))
	{
		$codeEnglish = cleanInput($_POST['txtCodeEnglish']);
		$nameEngslih = cleanInput($_POST['txtNameEnglish']);
		$codeSinhala = cleanInput($_POST['txtCodeSinhala']);
		$nameSinhala = cleanInput($_POST['txtNameSinhala']);
		$faculty = $_POST['lstFaculty'];
		$semester = $_POST['subSemester'];
		$level = $_POST['txtLevel'];
		$spCategory = $_POST['spCategory'];
		$spRelated  = $_POST['spRelated'];
		$chours = cleanInput($_POST['txtChours']);
		$description = cleanInput($_POST['txtDescription']);
		
		$query = "INSERT INTO subject SET codeEnglish='$codeEnglish', nameEnglish='$nameEngslih', codeSinhala='$codeSinhala', nameSinhala='$nameSinhala', faculty='$faculty', level='$level',spCategory='$spCategory',spRelated='$spRelated',description='$description',semester='$semester',creditHours='$chours'";
		$result = executeQuery($query);
		header("location:subjectAdmin.php");
		//header("location:message.php?message=Successfully inserted!");
	}
?>
<form method="post" action="" onsubmit="return validate_form(this);" class="plain">
<table class="searchResults">
    <tr>
    	<td>Code (English) : </td><td><input name="txtCodeEnglish" type="text" value="" /></td>
    </tr>
    <tr>
    	<td>Name (English) : </td><td><input name="txtNameEnglish" type="text" value="" style="width:300px"/></td>
    </tr>
    <tr>
    	<td>Code (Sinhala) : </td><td><input name="txtCodeSinhala" type="text" value="" /></td>
    </tr>
    <tr>
    	<td>Name (Sinhala) : </td><td><input name="txtNameSinhala" type="text" value="" style="width:300px"/></td>
    </tr>
    <tr>
    	
      <td height="28">Faculty : </td>
      <td><select name="lstFaculty">
        	<option value="Buddhist">Buddhist Studies</option>
        	<option value="Language">Language Studies</option>
        </select></td>
    </tr>
    <tr>
    	<td>Level : </td>
		 <td><select name="txtLevel">
        	<option value="I">One</option>
			<option value="II">Two</option>
				<option value="III">Three</option>
        	<option value="IV">Four</option>
        </select></td>
    </tr>
	<tr>
    	
      <td>Semester : </td>
      <td><select name="subSemester">
        	<option value="First Semester">First Semester</option>
        	<option value="Second Semester">Second Semester</option>
        </select></td>
    </tr>
	<tr>
    <tr>
    	
      <td>Department : </td>
      <td><select name="spCategory">
        
  <?php  
			
			//$query = "SELECT * FROM subject WHERE level='$level' and semester='$semester'";
			$query = "SELECT * FROM department";
		//print $query;
			$result = executeQuery($query);
			for ($i=0;$i<mysql_numrows($result);$i++)
			{
				$rID = mysql_result($result,$i,"departmentNo");
				$rCode = mysql_result($result,$i,"department");
				
              	echo "<option value=\"".$rID."\">".$rCode."</option>";
        	} 
			
			?>
        </select></td>
    </tr>
        </select></td>
    </tr>	
      <td>Special Related : </td>
      <td><select name="spRelated">
        
        	<option value="N">No</option>
			<option value="Y">Yes</option>
        </select></td>
    </tr>
	<tr>
    	
      <td>Credit Hours: </td>
      <td><input name="txtChours" type="text" value="" /></td>
    </tr>
    <tr>
    	<td>Description : </td><td><input name="txtDescription" type="text" value="" style="width:300px" /></td>
    </tr>
</table>
<br/><br/>
<p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'subjectAdmin.php';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="submit" value="Submit" class="button" /></p>
</form>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
   $pagetitle = "New Subject - Subjects - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='subjectAdmin.php'>Subjects </a></li><li>New Subject</li></ul>";
  //Apply the template
  include("master_registration.php");
?>