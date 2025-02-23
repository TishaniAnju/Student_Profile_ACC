<?php
  ob_start();
  
    //2021-03-23 start include('dbAccess.php');
	  require_once("dbAccess.php");
	  $db = new DBOperations();
    //2021-03-23 end
    //include("authcheck.inc.php");
?>

<h1> Selected Students from the Interview</h1>
<form method="post" onsubmit="return false;">
  <table class="searchResults">
  
    <tr><td><a href="interviewpali.php">Students who have passesd A/L Pali </a></td></tr>
    <tr><td><a href="interviewpaliqualification.php">Students who have passesd under Other Pali Qualification </a></td></tr>
    
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