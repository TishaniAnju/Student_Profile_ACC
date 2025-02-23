<?php
  //Buffer larger content areas like the main page content
  ob_start();
 ?>

<h1> Report of Applicants who have passed under Pali Qualification  </h1>

<?php

  //2021-03-24 start include('dbAccess.php');
	require_once("dbAccess.php");
	$db = new DBOperations();
    //2021-03-24 end
  //include("authcheck.inc.php");

if (isset($_POST['btnSubmit']))
	{
		
		$alYear = $_POST['lstALYear'];
		$title = $_POST['title'];
	$entryYear = $_POST['lstEntryYear'];


		header("location:rptpaliqualificationwithoutalpali.php?alYear=$alYear&titleE=$title&entryYear=$entryYear");
		

		
	}

if (isset($_POST['btnSubmit1']))
	{
		$alYear = $_POST['lstALYear'];
		$title = $_POST['title'];
	$entryYear = $_POST['lstEntryYear'];


		header("location:rptpaliqualificationewithoutalpali.php?alYear=$alYear&titleE=$title&entryYear=$entryYear");
		
	} 

	if (isset($_POST['btnSubmit2']))
	{
		$alYear = $_POST['lstALYear'];
		$title = $_POST['title'];
		$entryYear = $_POST['lstEntryYear'];


		header("location:rptpaliqualificationexcelwithoutalpali.php?alYear=$alYear&titleE=$title&entryYear=$entryYear");
		
	} 

	if (isset($_POST['btnSubmit3']))
	{
		$alYear = $_POST['lstALYear'];
		$title = $_POST['title'];
		$entryYear = $_POST['lstEntryYear'];


		header("location:rptpaliqualificationexcelsinhalawithoutalpali.php?alYear=$alYear&titleE=$title&entryYear=$entryYear");
		
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
			<td>Title : </td>
			<td>
			<select name="title" id="title" size="auto">
			<?php
			$result=$db->executeQuery("SELECT DISTINCT titleE FROM applicant");
			//2021.03.24 end
			echo "<option value=\"".All."\">".All."</option>";
			while($resultSet = $db->Next_Record($result))
			{
				$rtitle = $resultSet["titleE"];
				//$district = $resultSet["districtEnglish"];
				echo "<option value=\"".$rtitle."\">".$rtitle."</option>";
        	} 
              
				
			?>
			</select>
			</td></tr>
     
        
</table>
<br/><br/>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
    <!--<a href="rptApplicants.php" id="printLink" onClick="OpenPopup(this.href); return false">Click Here to See Popup</a>-->
    <input name="btnSubmit" type="submit" value="Report-Sinhala" class="button">

	<input name="btnSubmit1" type="submit" value="Report-English" class="button">

	<input name="btnSubmit2" type="submit" value="Excel-Report" class="button">

	<input name="btnSubmit3" type="submit" value="Excel-Report sinhla" class="button">

    <!-- <input name="btnSubmit2" type="submit" value="Report-English" class="button"> -->
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
?>