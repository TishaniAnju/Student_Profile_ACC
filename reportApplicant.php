<?php
  //Buffer larger content areas like the main page content
  ob_start();
 ?>

<h1> Applicant Report </h1>

<?php

  //2021-03-24 start include('dbAccess.php');
	require_once("dbAccess.php");
	$db = new DBOperations();
    //2021-03-24 end
  include("authcheck.inc.php");

if (isset($_POST['btnSubmit']))
	{
		$entryYear = $_POST['lstEntryYear'];
		$alYear = $_POST['lstALYear'];
		$appType =  $_POST['applicanttype'];
		$selected = $_POST['chkSelected'];
	$selected1 = $_POST['chkSelected1'];
		if ($selected=='on')
		{
			if($appType == 'All')
			{
				header("location:rptSelectedApplicants.php?entryYear=$entryYear&alYear=$alYear&appType=$appType");
			}
			elseif($appType == 'Local')
			{
				header("location:rptSelectedApplicants.php?entryYear=$entryYear&alYear=$alYear&appType=$appType");
			}
			elseif($appType == 'Foreign')
			{
				header("location:rptSelectedApplicants.php?entryYear=$entryYear&alYear=$alYear&appType=$appType");
			}

			// header("location:rptSelectedApplicants.php?entryYear=$entryYear&alYear=$alYear");
		}
		else 
		{
			if($appType == 'Local'){
		header("location:rptApplicants.php?entryYear=$entryYear&alYear=$alYear&appType=$appType");
			}
elseif($appType == 'Foreign')
{
	header("location:rptApplicants.php?entryYear=$entryYear&alYear=$alYear&appType=$appType");

}
else
{
	header("location:rptApplicants.php?entryYear=$entryYear&alYear=$alYear&appType=$appType");
}

		}
	}

if (isset($_POST['btnSubmit2']))
	{
		$entryYear = $_POST['lstEntryYear'];
		$alYear = $_POST['lstALYear'];
		$appType =  $_POST['applicanttype'];
		$selected = $_POST['chkSelected'];
		if ($selected !='on')
		header("location:rptApplicants_e.php?entryYear=$entryYear&alYear=$alYear&appType=$appType");
		else header("location:rptSelectedApplicants_e.php?entryYear=$entryYear&alYear=$alYear&appType=$appType");
	}

	if (isset($_POST['btnSubmit3']))
	{
		$entryYear = $_POST['lstEntryYear'];
		$alYear = $_POST['lstALYear'];
		$appType =  $_POST['applicanttype'];
		$selected = $_POST['chkSelected'];
		if ($selected !='on')
		header("location:rptApplicants_excel.php?entryYear=$entryYear&alYear=$alYear&appType=$appType");
		else header("location:rptSelectedApplicants_excel.php?entryYear=$entryYear&alYear=$alYear&appType=$appType");
	}

	if (isset($_POST['btnSubmit4']))
	{
		$entryYear = $_POST['lstEntryYear'];
		$alYear = $_POST['lstALYear'];
		$appType =  $_POST['applicanttype'];
		$selected = $_POST['chkSelected'];
		$selected1 = $_POST['chkSelected1'];
		if ($selected1 !='on'){
			$lateType='n';
		if ($selected !='on')
		header("location:rptApplicants_excel_with_personal_info.php?entryYear=$entryYear&alYear=$alYear&appType=$appType&lateType=$lateType");
		}
		else{
			$lateType='y';
			if ($selected !='on')
				
		header("location:rptApplicants_excel_with_personal_info.php?entryYear=$entryYear&alYear=$alYear&appType=$appType&lateType=$lateType");
		}
	}


?>
<form method="post" action="" class="plain">
<table class="searchResults">

	    <tr>
    	<td>Entry Year : </td><td><select name="lstEntryYear" id="lstEntryYear" size="auto">
		<?php
			//2021.03.24 start  $result=executeQuery("SELECT DISTINCT entryYear FROM applicant");
			$result=$db->executeQuery("SELECT DISTINCT entryYear FROM applicant");
			//2021.03.24 end

			while($resultSet = $db->Next_Record($result))
			{
				$rEntryYear = $resultSet["entryYear"];
				//$district = $resultSet["districtEnglish"];
				echo "<option value=\"".$rEntryYear."\">".$rEntryYear."</option>";
        	} 
			
			?>
        	</select></td></tr>
         <tr>
         <td>A/L Year : </td><td><select name="lstALYear" id="lstALYear" size="auto">
		 <?php
			//2021.03.24 start  $result=executeQuery("SELECT DISTINCT alYear FROM localapplicant");
			$result=$db->executeQuery("SELECT DISTINCT alYear FROM localapplicant");
			//2021.03.24 end
			while($resultSet = $db->Next_Record($result))
			{
				$rALYear = $resultSet["alYear"];
				//$district = $resultSet["districtEnglish"];
				echo "<option value=\"".$rALYear."\">".$rALYear."</option>";
        	} 
			
			?>
        	</select></td></tr>
         
			<tr>
			<td>Applicant Type:</td>
			<td><select name="applicanttype" id="applicanttype" tabindex="4"> 
          <option value="All">All</option>
          <option value="Local">Local Applicant</option>
          <option value="Foreign">Foreign Aplicant</option>
        </select></td>
    	</tr>

		 <tr>
    		<td colspan="2"><input name="chkSelected" type="checkbox" /> Selected applicants only</td>
   		 </tr>
	 <tr>
    		<td colspan="2"><input name="chkSelected1" type="checkbox" />Late applicant only</td>
   		 </tr>
     
        
</table>
<br/><br/>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
    <!--<a href="rptApplicants.php" id="printLink" onClick="OpenPopup(this.href); return false">Click Here to See Popup</a>-->
    <input name="btnSubmit" type="submit" value="Report-Sinhala" class="button">
    <input name="btnSubmit2" type="submit" value="Report-English" class="button">
	<input name="btnSubmit3" type="submit" value="Excel-Report" class="button">
	<input name="btnSubmit4" type="submit" value="Excel-Report with Personal Info" class="button">

    <input name="btnCancel" type="button" value="Cancel" onClick="document.location.href = 'home.php';"  class="button"/>
  </p>
</form>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Applicants Report - Student Management System - Buddhisht & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Applicants Report</ul>";
  //Apply the template
  include("master_registration.php");
?>ss