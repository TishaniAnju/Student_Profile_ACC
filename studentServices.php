<?php
  //Buffer larger content areas like the main page content
  ob_start();
 ?>
 
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
  
 <h1>Student Services</h1>
 
 
 <?php
   require_once("dbAccess.php");
   $db = new DBOperations();
   include('authcheck.inc.php');
	
	if (isset($_POST['btnSubmit']))

	{
        $regNo = cleanInput($_POST['txtRegistrationNo']);
        $title = $_POST['lstTitle'];
        $nameEnglish = cleanInput($_POST['txtNameEnglish']);
        $Scholarship = $_POST['lstScholarship'];
        $paidamount = cleanInput($_POST['txtScolarAmount']);
        $datescolar = cleanInput($_POST['txtpaidDate']);
        $hostelzone = $_POST['txthostelZone'];
        $hostelroom = cleanInput($_POST['txthostelRoomNo']);
        $hostelpaidamount = cleanInput($_POST['txthostelAmount']);
        $datehostelfee = cleanInput($_POST['txtpaidDateH']);

        $query = "INSERT INTO studentservices SET name='$nameEnglish', reg_no='$regNo', scholarshipType=' $Scholarship', paidAmount='$paidamount', DateScholar='$datescolar',hostelzone='$hostelzone', hostelroomNo='$hostelroom', hostelfeeAmount='$hostelpaidamount',	Datehostelfee='$datehostelfee'  ";
		    $result = $db->executeQuery($query);
		    
        header("location:studentServices.php");


    } 
 
 ?>  
 

 <form method="post" action="" onsubmit="return validate_form(this);" class="plain">

 <table class="searchResults" width="512">
 
    <tr>
    	<td>Registration No. : </td><td><input name="txtRegistrationNo" type="text" value="" /></td>
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
    </table>
    <table border="0" bordercolor="#EAEAEA" class="searchResults">
    <tr>
    <td height="35" width = "496 "colspan="2"><h3 style="font-weight:bold" align="left">Scholarship Details</h3></td>
    </tr>
    
    <tr>
    	<td>Scholarship Type : </td>
    	<td><select name="lstScholarship">
        	<option value="Mahapola">Mahapola</option>
        	<option value="Bursary">Bursary</option>
        </select></td>
    </tr>
    <tr>
    	<td>Paid Amount : </td><td><input name="txtScolarAmount" type="text" value="" /></td>
    </tr>
    <tr>
    	<td>Date : </td><td><input name="txtpaidDate" type="text" value="" onclick="scwShow(this,event);" onfocus="scwShow(this,event);" /></td>
    </tr>

    </table>
    <table border="0" bordercolor="#EAEAEA" class="searchResults">
    <tr>
    <td height="35" width = "496 "colspan="2"><h3 style="font-weight:bold" align="left">Hostel Details</h3></td>
    </tr>
    
    <tr>
    	<td>Hostel Zone : </td>
        <td><select name="txthostelZone">
        	<option value="Mahapola">Zone A - Girls</option>
        	<option value="Bursary">Zone B - Boys</option>
        </select></td>
    </tr>
    <tr>
    	<td>Hostel Room No : </td><td><input name="txthostelRoomNo" type="text" value="" style="width:300px"/></td>
    </tr>
    <tr>
    	<td>Hostel Fee (Paid Amount) : </td><td><input name="txthostelAmount" type="text" value="" /></td>
    </tr>
    <tr>
    	<td>Date : </td><td><input name="txtpaidDateH" type="text" value="" onclick="scwShow(this,event);" onfocus="scwShow(this,event);" /></td>
    </tr>

    </table>
<br/><br/>
<p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'studentServices.php';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="submit" value="Submit" class="button" /></p>
</form>

 
  
  <p>
    <?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Applicants - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Student Services</li></ul>";
  //Apply the template
  include("master_registration.php");
?>
  