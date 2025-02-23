<?php
  ob_start();
  
  include('dbAccess.php');
  include('authcheck.inc.php');
?>

<h1> Enrollment Related Reports</h1>
<form method="post" onsubmit="return false;">
  <table class="searchResults">
  <tr><td><a href="reportRegInfo.php">Student Registration Report</a></td></tr>
  <tr><td><a href="reportStudentInfo.php">Student Information Report</a></td></tr> 
  <tr><td><a href="reportSubject.php">Student - Subject Wise Report</a></td></tr> 
  <tr><td><a href="reportCountry.php">Foreign Students by Country Report</a></td></tr> 
  </table>
</form>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Enrollment Related Reports - Applicants - Student Management System - Buddhisht & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Enrollment Related Reports</ul>";
  //Apply the template
  include("master_registration.php");
?>