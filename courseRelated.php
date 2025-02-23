<?php
  ob_start();
  
	  require_once("dbAccess.php");
	  $db = new DBOperations();
   
?>

<h1>Certificate Courses</h1>
<form method="post" onsubmit="return false;">
  <table class="searchResults">
  	<tr><td><a href="certificate_course.php">New Course</a></td></tr>
    <tr><td><a href="coursePosition.php">Allocate Courses for Positions - New Courses</a></td></tr>

	
  </table>
</form>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Certificate Courses - Student Management System - Buddhisht & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Select Report</ul>";
  //Apply the template
  include("master_registration.php");
?>