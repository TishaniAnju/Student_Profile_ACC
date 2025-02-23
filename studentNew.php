<?php
  //Buffer larger content areas like the main page content
  ob_start();
?>

<script language="javascript" src="lib/scw/scw.js"></script>
<script>
function validate_form(thisform)
{
	with (thisform)
	  {
		if (!validate_required(txtRegistrationNo) || !validate_required(txtNameEnglish))
		{alert("One or more mandatory fields are kept blank.");return false;}
	  }
}
</script>

<h1>New Student</h1>
<?php
	//2021-03-25 start  include('dbAccess.php');
	//require_once("dbAccess.php");
	require_once("dbAccess.php");
	$db = new DBOperations();
    //2021-03-25 end
    include('authcheck.inc.php');
	
	if (isset($_POST['btnSubmit']))
	{
		//2021-03-25 start  $appNo = cleanInput($_POST['txtApplicantNo']);
		$appNo = $db->cleanInput($_POST['txtApplicantNo']);
		//2021-03-25 end
		//2021-03-25 start  $regNo = cleanInput($_POST['txtRegistrationNo']);
		$regNo = $db->cleanInput($_POST['txtRegistrationNo']);
		//2021-03-25 end
		//2021-03-25 start  $indexNo = cleanInput($_POST['txtIndexNo']);
		$indexNo = $db->cleanInput($_POST['txtIndexNo']);
		//2021-03-25 end

		$title = $_POST['lstTitle'];

		//2021-03-25 start  $nameEnglish = cleanInput($_POST['txtNameEnglish']);
		$nameEnglish = $db->cleanInput($_POST['txtNameEnglish']);
		//2021-03-25 end
		//2021-03-25 start  $nameSinhala = cleanInput($_POST['txtNameSinhala']);
		$nameSinhala = $db->cleanInput($_POST['txtNameSinhala']);
		//2021-03-25 end
		//2021-03-25 start  $addressE1 = cleanInput($_POST['txtAddressE1']);
		$addressE1 = $db->cleanInput($_POST['txtAddressE1']);
		//2021-03-25 end
		//2021-03-25 start  $addressE2 = cleanInput($_POST['txtAddressE2']);
		$addressE2 = $db->cleanInput($_POST['txtAddressE2']);
		//2021-03-25 end
		//2021-03-25 start  $addressE3 = cleanInput($_POST['txtAddressE3']);
		$addressE3 = $db->cleanInput($_POST['txtAddressE3']);
		//2021-03-25 end
		//2021-03-25 start  $addressS1 = cleanInput($_POST['txtAddressS1']);
		$addressS1 = $db->cleanInput($_POST['txtAddressS1']);
		//2021-03-25 end
		//2021-03-25 start  $addressS2 = cleanInput($_POST['txtAddressS2']);
		$addressS2 = $db->cleanInput($_POST['txtAddressS2']);
		//2021-03-25 end
		//2021-03-25 start  $addressS3 = cleanInput($_POST['txtAddressS3']);
		$addressS3 = $db->cleanInput($_POST['txtAddressS3']);
		//2021-03-25 end
		//2021-03-25 start  $district = cleanInput($_POST['txtDistrict']);
		$district = $db->cleanInput($_POST['txtDistrict']);
		//2021-03-25 end
		//2021-03-25 start  $entryType = cleanInput($_POST['txtEntryType']);
		$entryType = $db->cleanInput($_POST['txtEntryType']);
		//2021-03-25 end
		//2021-03-25 start  $yearEntry = cleanInput($_POST['txtYearEntry']);
		$yearEntry = $db->cleanInput($_POST['txtYearEntry']);
		//2021-03-25 end

		$faculty = $_POST['lstFaculty'];
		$degreeType = $_POST['lstDegreeType'];

		//2021-03-25 start  $id_pp_No = cleanInput($_POST['txtIdPpNo']);
		$id_pp_No = $db->cleanInput($_POST['txtIdPpNo']);
		//2021-03-25 end
		//2021-03-25 start  $contactNo = cleanInput($_POST['txtContactNo']);
		$contactNo = $db->cleanInput($_POST['txtContactNo']);
		//2021-03-25 end
		//2021-03-25 start  $email = cleanInput($_POST['txtEmail']);
		$email = $db->cleanInput($_POST['txtEmail']);
		//2021-03-25 end
		//2021-03-25 start  $birthday = cleanInput($_POST['txtBirthday']);
		$birthday = $db->cleanInput($_POST['txtBirthday']);
		//2021-03-25 end
		//2021-03-25 start  $citizenship = cleanInput($_POST['txtCitizenship']);
		$citizenship = $db->cleanInput($_POST['txtCitizenship']);
		//2021-03-25 end
		//2021-03-25 start  $nationality = cleanInput($_POST['txtNationality']);
		$nationality = $db->cleanInput($_POST['txtNationality']);
		//2021-03-25 end
		//2021-03-25 start  $religion = cleanInput($_POST['txtReligion']);
		$religion = $db->cleanInput($_POST['txtReligion']);
		//2021-03-25 end
		//2021-03-25 start  $civilStatus = cleanInput($_POST['txtCivilStatus']);
		$civilStatus = $db->cleanInput($_POST['txtCivilStatus']);
		//2021-03-25 end
		//2021-03-25 start  $guardName = cleanInput($_POST['txtGuardName']);
		$guardName = $db->cleanInput($_POST['txtGuardName']);
		//2021-03-25 end
		//2021-03-25 start  $guardAddress = cleanInput($_POST['txtGuardAddress']);
		$guardAddress = $db->cleanInput($_POST['txtGuardAddress']);
		//2021-03-25 end
		//2021-03-25 start  $guardContactNo = cleanInput($_POST['txtGuardContactNo']);
		$guardContactNo = $db->cleanInput($_POST['txtGuardContactNo']);
		//2021-03-25 end
		$Scholarship = $_POST['lstScholarship'];
		
		$query = "INSERT INTO student SET appNo='$appNo', regNo='$regNo', indexNo='$indexNo', title='$title', nameEnglish='$nameEnglish', nameSinhala='$nameSinhala', addressE1='$addressE1', addressE2='$addressE2', addressE3='$addressE3', addressS1='$addressS1', addressS2='$addressS2', district='$district', addressS3='$addressS3', entryType='$entryType', yearEntry='$yearEntry', faculty='$faculty', degreeType='$degreeType', id_pp_No='$id_pp_No', contactNo='$contactNo', email='$email', birthday='$birthday', citizenship='$citizenship', nationality='$nationality', religion='$religion', civilStatus='$civilStatus', guardName='$guardName', guardAddress='$guardAddress', guardContactNo='$guardContactNo', Scholarship='$Scholarship'";
		//2021-03-25 start  $result = executeQuery($query);
		$result = $db->executeQuery($query);
		
		//2021-03-25 end
		header("location:studentAdmin.php");
	}
	/* else
    {
		header("location:studentAdmin.php");
    } */
	
?>
<form method="post" action="" onsubmit="return validate_form(this);" class="plain">
<table class="searchResults">
    <tr>
    	<td>Applicant No. : </td><td><input name="txtApplicantNo" type="text" value="" /></td>
    </tr>
    <tr>
    	<td>Registration No. : </td><td><input name="txtRegistrationNo" type="text" value="" /></td>
    </tr>
    <tr>
    	<td>Index No. : </td><td><input name="txtIndexNo" type="text" value="" /></td>
    </tr>
    <tr>
    	<td>Title : </td><td><select name="lstTitle">
    	  <option value="Dr.">Dr.</option>
    	  <option value="Mr.">Mr.</option>
    	  <option value="Miss.">Miss</option>
    	  <option value="Mrs.">Mrs.</option>
    	  <option value="Ven.">Ven.</option>
    	</select></td>
    </tr>
    <tr>
    	<td>Name (English) : </td><td><input name="txtNameEnglish" type="text" value="" style="width:300px"/></td>
    </tr>
    <tr>
    	<td>Name (Sinhala) : </td><td><input name="txtNameSinhala" type="text" value="" style="width:300px"/></td>
    </tr>
    <tr>
    	<td valign="top">Address (English) : </td><td><input name="txtAddressE1" type="text" value="" /><br/><input name="txtAddressE2" type="text" value="" style="width:300px"/><br/><input name="txtAddressE3" type="text" value="" style="width:300px"/></td>
    </tr>
    <tr>
    	<td valign="top">Address (Sinhala) : </td><td><input name="txtAddressS1" type="text" value="" /><br/><input name="txtAddressS2" type="text" value="" style="width:300px"/><br/><input name="txtAddressS3" type="text" value="" style="width:300px"/></td>
    </tr>
    <tr>
    	<td>District : </td><td><input name="txtDistrict" type="text" value="" /></td>
    </tr>
    <tr>
    	<td>Entry Type : </td><td><input name="txtEntryType" type="text" value="" /></td>
    </tr>
    <tr>
    	<td>Year of Entrance : </td><td><input name="txtYearEntry" type="text" value=""  /></td>
    </tr>
    <tr>
    	<td>Faculty : </td><td><select name="lstFaculty">
        	<option value="Buddhist">Buddhist Studies</option>
        	<option value="Language">Language Studies</option>
        </select></td>
    </tr>
    <tr>
    	<td>Degree Type : </td><td><select name="lstDegreeType">
        	<option value="General">General</option>
            <option value="Special-A">Special - Archeology</option>
            <option value="Special-BC">Special - Buddhist Culture</option>
            <option value="Special-BP">Special - Buddhist Philosophy</option>
            <option value="Special-P">Special - Pali</option>
            <option value="Special-S">Special - Sanskrit</option>
			<option value="Special-Sin">Special - Sinhala</option>
			<option value="Special-Eng">Special - English</option>
			<option value="Special-RS">Special -  Religious studies and comparative philosophy</option>
        </select></td>
    </tr>
    <tr>
    	<td>NIC/Passport No. : </td><td><input name="txtIdPpNo" type="text" value="" /></td>
    </tr>
    <tr>
    	<td>Contact No. : </td><td><input name="txtContactNo" type="text" value="" /></td>
    </tr>
     <tr>
    	<td>Email : </td><td><input name="txtEmail" type="text" value="" /></td>
    </tr>
     <tr>
    	<td>Birthday : </td><td><input name="txtBirthday" type="text" value="" onclick="scwShow(this,event);" onfocus="scwShow(this,event);" /></td>
    </tr>
     <tr>
    	<td>Citizenship : </td><td><input name="txtCitizenship" type="text" value="" /></td>
    </tr>
     <tr>
    	<td>Nationality : </td><td><input name="txtNationality" type="text" value="" /></td>
    </tr>
    <tr>
    	<td>Religion : </td><td><input name="txtReligion" type="text" value="" /></td>
    </tr>
     <tr>
    	<td>Civil Status : </td><td><input name="txtCivilStatus" type="text" value="" /></td>
    </tr>
    <tr>
    	<td>Gurdian Name : </td><td><input name="txtGuardName" type="text" value="" /></td>
    </tr>
    <tr>
    	<td>Gurdian Address : </td><td><input name="txtGuardAddress" type="text" value="" /></td>
    </tr>
    <tr>
    	<td>Gurdian Contact No. : </td><td><input name="txtGuardContactNo" type="text" value="" /></td>
    </tr>
    <tr>
    	<td>Scholarship : </td>
    	<td><select name="lstScholarship">
        	<option value="Mahapola">Mahapola</option>
        	<option value="Bursary">Bursary</option>
        	<option value="Other">Other</option>
        	<option value="None">None</option>
        </select></td>
    </tr>
</table>
<br/><br/>
<p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'studentAdmin.php';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="submit" value="Submit" class="button" /></p>
</form>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
   $pagetitle = "New Student - Students - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='studentAdmin.php'>Students </a></li><li>New Student</li></ul>";
  //Apply the template
  include("master_registration.php");
?>