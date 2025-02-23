<?php
  ob_start();
  
    //2021-03-23 start include('dbAccess.php');
	  require_once("dbAccess.php");
	  $db = new DBOperations();
    //2021-03-23 end
    include("authcheck.inc.php");
?>

<h1> Selection Related Reports</h1>
<form method="post" onsubmit="return false;">
  <table class="searchResults">
  	<tr><td><a href="reportApplicant.php">Applicant Reports</a></td></tr>
    <tr><td><a href="reportalpali.php">Reports of Applicants who have passesd A/L Pali </a></td></tr>
    <tr><td><a href="reportpaliqualification.php">Reports of Applicants who have passesd under Other Pali Qualification </a></td></tr>
	  <tr><td><a href="reportpaliqualificationwithoutalpali.php">Reports of Applicants who have passesd under Other Pali Qualification (Without Pali A/L) </a></td></tr>
    
    <tr><td><a href="reject_report.php">Reports of Applicants who have not passesd under Pali or other Pali Qualification </a></td></tr>

    <tr><td><a href="report_prachinamadyama.php">Reports of Applicants who have passed Prachina Madyama Examination.</a></td></tr>

    <tr><td><a href="reportalwithoutartwithotherpaliquali.php">Reports of Applicants who have passed A/L without Art Stream with Other Pali Qualification</a></td></tr>
    
    <tr><td><a href="reportAllApplicant.php">Reports of  All Applicants  </a></td></tr>
    <tr><td><a href="reportEnvelope.php">Envelope Print</a></td></tr>
    <tr><td><a href="reportLetter.php">Letter Print</a></td></tr>
	<tr><td><a href="reportStatistics.php">Number of Applicants</a></td></tr>
  </table>
</form>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Select Report - Student Management System - Buddhisht & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Select Report</ul>";
  //Apply the template
  include("master_registration.php");
?>