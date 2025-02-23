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

<h1>Subject Edit</h1>
<?php
	include('dbAccess.php');
  	include('authcheck.inc.php');

	if (isset($_POST['btnSubmit']))
	{
		$subjectID = cleanInput($_GET['subjectID']);
		$codeEnglish = cleanInput($_POST['txtCodeEnglish']);
		$nameEngslih = cleanInput($_POST['txtNameEnglish']);
		$codeSinhala = cleanInput($_POST['txtCodeSinhala']);
		$nameSinhala = cleanInput($_POST['txtNameSinhala']);
		$faculty = $_POST['lstFaculty'];
		$level = cleanInput($_POST['txtLevel']);
		$semester = cleanInput($_POST['txtSemester']);
		$chours = cleanInput($_POST['txtchours']);
		$description = cleanInput($_POST['txtDescription']);
		
		$query = "UPDATE subject SET codeEnglish='$codeEnglish', nameEnglish='$nameEngslih', codeSinhala='$codeSinhala', nameSinhala='$nameSinhala', faculty='$faculty', level='$level', description='$description', semester='$semester', creditHours='$chours' WHERE subjectID='$subjectID'";
		$result = executeQuery($query);
		header("location:subjectAdmin.php");
	}
	
	$subjectID = cleanInput($_GET['subjectID']);
	$query = "SELECT * FROM subject WHERE subjectID='$subjectID'";
	$result = executeQuery($query);
	
	$row = mysql_fetch_array($result);
	if (mysql_num_rows($result)>0)
	{
?>
<form method="post" action="subjectEdit.php?subjectID=<?php echo $subjectID ?>" onsubmit="return validate_form(this);" class="plain">
<table class="searchResults">
	<tr>
    	<td>Code (English) : </td><td><input name="txtCodeEnglish" type="text" value="<?php echo $row['codeEnglish'] ?>" /></td>
    </tr>
    <tr>
    	<td>Name (English) : </td><td><input name="txtNameEnglish" type="text" value="<?php echo $row['nameEnglish'] ?>" style="width:300px"/></td>
    </tr>
    <tr>
    	<td>Code (Sinhala) : </td><td><input name="txtCodeSinhala" type="text" value="<?php echo $row['codeSinhala'] ?>" /></td>
    </tr>
    <tr>
    	<td>Name (Sinhala) : </td><td><input name="txtNameSinhala" type="text" value="<?php echo $row['nameSinhala'] ?>" style="width:300px"/></td>
    </tr>
    <tr>
    	<td>Faculty : </td><td><select name="lstFaculty">
        	<option <?php if ($row['faculty']=='Buddhist') echo "selected='selected'"; ?> value="Buddhist">Buddhist Studies</option>
        	<option <?php if ($row['faculty']=='Language') echo "selected='selected'"; ?> value="Language">Language Studies</option>
        </select></td>
    </tr>
    <tr>
    	<td>Level : </td><td><input name="txtLevel" type="text" value="<?php echo $row['level'] ?>" /></td>
    </tr>
	<tr>
    	<td>Semester : </td><td><input name="txtSemester" type="text" value="<?php echo $row['semester'] ?>" /></td>
    </tr>
	<tr>
    	<td>Credit Hours : </td><td><input name="txtchours" type="text" value="<?php echo $row['creditHours'] ?>" /></td>
    </tr>
    <tr>
    	<td>Description : </td><td><input name="txtDescription" type="text" value="<?php echo $row['description'] ?>" style="width:300px" /></td>
    </tr>
</table>
<br/><br/>
<p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'subjectAdmin.php';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="submit" value="Submit" class="button" /></p>
</form>

<?php
   }
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
 $pagetitle = "Edit Subject - Subjects - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='subjectAdmin.php'>Subjects </a></li><li>Edit Subject</li></ul>";
  //Apply the template
  include("master_registration.php");
?>