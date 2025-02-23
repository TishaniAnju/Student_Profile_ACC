<?php
  ob_start();
  
  include("dbAccess.php");
  include("authcheck.inc.php");
?>

<h1> Selection Related Reports</h1>
<form method="post" onsubmit="return false;">
  <table class="searchResults">
  	<tr><td><a href="reportApplicant.php">Applicant Reports</a></td></tr>
  	<tr><td><a href="reportEnvelope.php">Envelope Print</a></td></tr>
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