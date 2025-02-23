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

<h1>Student Edit</h1>
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
		$medium = $_POST['lstMedium'];
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
		
		$query = "UPDATE student SET regNo='$regNo', indexNo='$indexNo', title='$title', nameEnglish='$nameEnglish', 
		                 nameSinhala='$nameSinhala', addressE1='$addressE1', addressE2='$addressE2', addressE3='$addressE3', 
						 addressS1='$addressS1', addressS2='$addressS2', addressS3='$addressS3', district='$district',
						 entryType='$entryType', yearEntry='$yearEntry', faculty='$faculty', degreeType='$degreeType', medium = '$medium',  
						 id_pp_No='$id_pp_No', contactNo='$contactNo', email='$email', birthday='$birthday', 
						 citizenship='$citizenship', nationality='$nationality', religion='$religion', civilStatus='$civilStatus', 
						 guardName='$guardName', guardAddress='$guardAddress', guardContactNo='$guardContactNo', Scholarship='$Scholarship' WHERE appNo='$appNo'";
		$result = executeQuery($query);
		header("location:studentAdmin.php");
	}
	
	$appNo = cleanInput($_GET['appNo']);
	$query = "SELECT * FROM student WHERE appNo='$appNo'";
	$result = executeQuery($query);
	
	$row = mysql_fetch_array($result);
	if (mysql_num_rows($result)>0)
	{
?>
<form method="post" action="studentEdit.php?appNo=<?php echo $appNo; ?>" onsubmit="return validate_form(this);" class="plain">
<table class="searchResults">
	<tr>
    	<td>Applicant No. : </td><td><input name="txtApplicantNo" type="text" value="<?php echo $row['appNo']; ?>" readonly="readonly" /></td>
    </tr>
    <tr>
    	<td>Registration No. : </td><td><input name="txtRegistrationNo" type="text" value="<?php echo $row['regNo'] ?>" /></td>
    </tr>
    <tr>
    	<td>Index No. : </td><td><input name="txtIndexNo" type="text" value="<?php echo $row['indexNo'] ?>" /></td>
    </tr>
    <tr>
    	<td>Title : </td><td><select name="lstTitle">
    	  <option <?php if ($row['title']=='Dr.') echo "selected='selected'"; ?> value="Dr.">Dr.</option>
    	  <option <?php if ($row['title']=='Mr.') echo "selected='selected'"; ?> value="Mr.">Mr.</option>
    	  <option <?php if ($row['title']=='Miss.') echo "selected='selected'"; ?> value="Miss.">Miss</option>
    	  <option <?php if ($row['title']=='Mrs.') echo "selected='selected'"; ?> value="Mrs.">Mrs.</option>
    	  <option <?php if ($row['title']=='Ven.') echo "selected='selected'"; ?> value="Ven.">Ven.</option>
    	</select></td>
    </tr>
    <tr>
    	<td>Name (English) : </td><td><input name="txtNameEnglish" type="text" value="<?php echo $row['nameEnglish'] ?>" style="width:300px"/></td>
    </tr>
    <tr>
    	<td>Name (Sinhala) : </td><td><input name="txtNameSinhala" type="text" value="<?php echo $row['nameSinhala'] ?>" style="width:300px"/></td>
    </tr>
    <tr>
    	<td valign="top">Address (English) : </td><td><input name="txtAddressE1" type="text" value="<?php echo $row['addressE1'] ?>" /><br/><input name="txtAddressE2" type="text" value="<?php echo $row['addressE2'] ?>" style="width:300px"/><br/><input name="txtAddressE3" type="text" value="<?php echo $row['addressE3'] ?>" style="width:300px"/></td>
    </tr>
    <tr>
    	<td valign="top">Address (Sinhala) : </td><td><input name="txtAddressS1" type="text" value="<?php echo $row['addressS1'] ?>" /><br/><input name="txtAddressS2" type="text" value="<?php echo $row['addressS2'] ?>" style="width:300px"/><br/><input name="txtAddressS3" type="text" value="<?php echo $row['addressS3'] ?>" style="width:300px"/></td>
    </tr>
    <tr>
    	<td>District : </td><td><input name="txtDistrict" type="text" value="<?php echo $row['district'] ?>" /></td>
    </tr>
    <tr>
    	<td>Entry Type : </td><td><input name="txtEntryType" type="text" value="<?php echo $row['entryType'] ?>" /></td>
    </tr>
    <tr>
    	<td>Year of Entrance : </td><td><input name="txtYearEntry" type="text" value="<?php echo $row['yearEntry'] ?>"  /></td>
    </tr>
    <tr>
    	<td>Faculty : </td><td><select name="lstFaculty">
        	<option <?php if ($row['faculty']=='Buddhist') echo "selected='selected'"; ?> value="Buddhist">Buddhist Studies</option>
        	<option <?php if ($row['faculty']=='Language') echo "selected='selected'"; ?> value="Language">Language Studies</option>
        </select></td>
    </tr>
    <tr>
    	<td>Degree Type : </td><td><select name="lstDegreeType">
        	<option <?php if ($row['degreeType']=='General') echo "selected='selected'"; ?> value="General">General</option>
        	<option <?php if ($row['degreeType']=='Special-A') echo "selected='selected'"; ?> value="Special-A">Special - Archeology</option>
            <option <?php if ($row['degreeType']=='Special-BC') echo "selected='selected'"; ?> value="Special-BC">Special - Buddhist Culture</option>
            <option <?php if ($row['degreeType']=='Special-BP') echo "selected='selected'"; ?> value="Special-BP">Special - Buddhist Philosophy </option>
            <option <?php if ($row['degreeType']=='Special-P') echo "selected='selected'"; ?> value="Special-P">Special - Pali</option>
            <option <?php if ($row['degreeType']=='Special-S') echo "selected='selected'"; ?> value="Special-S">Special - Sanskrit</option>
			<option <?php if ($row['degreeType']=='Special-Sin') echo "selected='selected'"; ?> value="Special-Sin">Special - Sinhala</option>
        </select></td>
    </tr>
	<tr>
    	
      <td>Medium : </td>
      <td><select name="lstMedium">
        	<option <?php if ($row['medium']=='Sinhala') echo "selected='selected'"; ?> value="Sinhala">Sinhala</option>
        	<option <?php if ($row['medium']=='English') echo "selected='selected'"; ?> value="English">English</option>
        </select></td>
    </tr>
    <tr>
    	<td>NIC/Passport No. : </td><td><input name="txtIdPpNo" type="text" value="<?php echo $row['id_pp_No'] ?>" /></td>
    </tr>
    <tr>
    	<td>Contact No. : </td><td><input name="txtContactNo" type="text" value="<?php echo $row['contactNo'] ?>" /></td>
    </tr>
     <tr>
    	<td>Email : </td><td><input name="txtEmail" type="text" value="<?php echo $row['email'] ?>" /></td>
    </tr>
     <tr>
    	<?php     // Included by Anjana  2011-03-25
		if ($row['birthday'] == '0000-00-00') {
		   $birthday = '1900-01-01';
		} else {
		  $birthday = $row['birthday'];
		}
		?>     
        <td>Birthday : </td><td><input name="txtBirthday" type="text" value="<?php echo $birthday; ?>" 
        onclick="scwShow(this,event);" onfocus="scwShow(this,event);" /></td>
    </tr>
     <tr>
    	<td>Citizenship : </td><td><input name="txtCitizenship" type="text" value="<?php echo $row['citizenship'] ?>" /></td>
    </tr>
     <tr>
    	<td>Nationality : </td><td><input name="txtNationality" type="text" value="<?php echo $row['nationality'] ?>" /></td>
    </tr>
    <tr>
    	<td>Religion : </td><td><input name="txtReligion" type="text" value="<?php echo $row['religion'] ?>" /></td>
    </tr>
     <tr>
    	<td>Civil Status : </td><td><input name="txtCivilStatus" type="text" value="<?php echo $row['civilStatus'] ?>" /></td>
    </tr>
    <tr>
    	<td>Gurdian Name : </td><td><input name="txtGuardName" type="text" value="<?php echo $row['guardName'] ?>" /></td>
    </tr>
    <tr>
    	<td>Gurdian Address : </td><td><input name="txtGuardAddress" type="text" value="<?php echo $row['guardAddress'] ?>" /></td>
    </tr>
    <tr>
    	<td>Gurdian Contact No. : </td><td><input name="txtGuardContactNo" type="text" value="<?php echo $row['guardContactNo'] ?>" /></td>
    </tr>
    <tr>
    	<td>Scholarship : </td>
    	<td><select name="lstScholarship">
        	<option <?php if ($row['Scholarship']=='Mahapola') echo "selected='selected'"; ?> value="Mahapola">Mahapola</option>
        	<option <?php if ($row['Scholarship']=='Bursary') echo "selected='selected'"; ?> value="Bursary">Bursary</option>
        	<option <?php if ($row['Scholarship']=='Other') echo "selected='selected'"; ?> value="Other">Other</option>
        	<option <?php if ($row['Scholarship']=='None') echo "selected='selected'"; ?> value="None">None</option>
        </select></td>
    </tr>
	
</table>
<br/><br/>
<p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'studentAdmin.php';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="submit" value="Submit" class="button" /></p>
</form>

<?php
   }
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Edit Student - Students - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='studentAdmin.php'>Students </a></li><li>Edit Student</li></ul>";
  //Apply the template
  include("master_registration.php");
?>