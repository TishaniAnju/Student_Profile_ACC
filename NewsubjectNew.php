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
    //2021.11.25 start 
	//include('dbAccess.php');
    require_once("dbAccess.php");
	$db = new DBOperations();
    //2021.11.25 end
  	include('authcheck.inc.php');
	
	if (isset($_POST['btnSubmit']))
	{   //2021.11.25 start
	
        $codeEnglish = $db->cleanInput($_POST['txtCodeEnglish']);
		$nameEngslih = $db->cleanInput($_POST['txtNameEnglish']);
		$codeSinhala = $db->cleanInput($_POST['txtCodeSinhala']);
		$nameSinhala = $db->cleanInput($_POST['txtNameSinhala']);
        //2021.11.25 end
		$faculty = $_POST['lstFaculty'];
		$semester = $_POST['subSemester'];
		$level = $_POST['txtLevel'];
		$spCategory = $_POST['spCategory'];
		$spRelated  = $_POST['spRelated'];
		$medium  = $_POST['medium'];
    
        $chours = $db->cleanInput($_POST['txtChours']);
		$description =$db-> cleanInput($_POST['txtDescription']);
		
		//2021.11.25 end

		$query = "INSERT INTO Newsubject SET codeEnglish='$codeEnglish', nameEnglish='$nameEngslih', codeSinhala='$codeSinhala', nameSinhala='$nameSinhala', faculty='$faculty', level='$level',spCategory='$spCategory',spRelated='$spRelated',description='$description',semester='$semester',creditHours='$chours',medium='$medium'";
        //2021.11.25 start 
        $result = $db->executeQuery($query);
        //2021.11.25 end
		header("location:NewsubjectAdmin.php");
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

    	<!--Load special degree subjects-->
      <td>Special Related : </td>
      <td><select name="spRelated" id="spRelated">
	  <option value="0">None</option>
      <?php	
				$result = $db->executeQuery("SELECT DISTINCT sid,description FROM special_degree");
				if ($db->Row_Count($result)>0)
				{
					while ($row=$db->Next_Record($result))
					{	
							echo "<option selected='selected' value='".$row['sid']."'>".$row['description']."</option>";
					}
				}
			?>
        </select></td>
    </tr>
	<tr>
    	
      <td>Credit Hours: </td>
      <td><input name="txtChours" type="text" value="" /></td>
    </tr>
    <tr>
    	<td>Description : </td><td><input name="txtDescription" type="text" value="" style="width:300px" /></td>
    </tr>
	<tr>
    	<td>Medium : </td>
		 <td><select name="medium">
        	<option value="Sinhala">Sinhala</option>
			<option value="English">English</option>
			<option value="Both">Both</option>
        </select></td>
    </tr>
</table>
<br/><br/>
<p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'NewsubjectAdmin.php';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="submit" value="Submit" class="button" /></p>
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