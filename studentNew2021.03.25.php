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
	include('dbAccess.php');
    include('authcheck.inc.php');
	
	if (isset($_POST['btnSubmit']))
	{
		$appNo = cleanInput($_POST['txtApplicantNo']);
		$regNo = cleanInput($_POST['txtRegistrationNo']);
		$indexNo = cleanInput($_POST['txtIndexNo']);
		$title = $_POST['lstTitle'];
		$nameEnglish = cleanInput($_POST['txtNameEnglish']);
		$nameSinhala = cleanInput($_POST['txtNameSinhala']);
		$addressE1 = cleanInput($_POST['txtAddressE1']);
		$addressE2 = cleanInput($_POST['txtAddressE2']);
		$addressE3 = cleanInput($_POST['txtAddressE3']);
		$addressS1 = cleanInput($_POST['txtAddressS1']);
		$addressS2 = cleanInput($_POST['txtAddressS2']);
		$addressS3 = cleanInput($_POST['txtAddressS3']);
		$district = cleanInput($_POST['txtDistrict']);
		$entryType = cleanInput($_POST['txtEntryType']);
		$yearEntry = cleanInput($_POST['txtYearEntry']);
		$faculty = $_POST['lstFaculty'];
		$degreeType = $_POST['lstDegreeType'];
		$id_pp_No = cleanInput($_POST['txtIdPpNo']);
		$contactNo = cleanInput($_POST['txtContactNo']);
		$email = cleanInput($_POST['txtEmail']);
		$birthday = cleanInput($_POST['txtBirthday']);
		$citizenship = cleanInput($_POST['txtCitizenship']);
		$nationality = cleanInput($_POST['txtNationality']);
		$religion = cleanInput($_POST['txtReligion']);
		$civilStatus = cleanInput($_POST['txtCivilStatus']);
		$guardName = cleanInput($_POST['txtGuardName']);
		$guardAddress = cleanInput($_POST['txtGuardAddress']);
		$guardContactNo = cleanInput($_POST['txtGuardContactNo']);
		$Scholarship = $_POST['lstScholarship'];
		
		$query = "INSERT INTO student SET appNo='$appNo', regNo='$regNo', indexNo='$indexNo', title='$title', nameEnglish='$nameEnglish', nameSinhala='$nameSinhala', addressE1='$addressE1', addressE2='$addressE2', addressE3='$addressE3', addressS1='$addressS1', addressS2='$addressS2', district='$district', addressS3='$addressS3', entryType='$entryType', yearEntry='$yearEntry', faculty='$faculty', degreeType='$degreeType', id_pp_No='$id_pp_No', contactNo='$contactNo', email='$email', birthday='$birthday', citizenship='$citizenship', nationality='$nationality', religion='$religion', civilStatus='$civilStatus', guardName='$guardName', guardAddress='$guardAddress', guardContactNo='$guardContactNo', Scholarship='$Scholarship'";
		$result = executeQuery($query);
		header("location:studentAdmin.php");
	}
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