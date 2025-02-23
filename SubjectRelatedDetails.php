<?php
  ob_start();
  
    //2021-03-23 start include('dbAccess.php');
	  require_once("dbAccess.php");
	  $db = new DBOperations();
    //2021-03-23 end
    //include("authcheck.inc.php");
?>

<h1> Subject Related Details</h1>
<form method="post" onsubmit="return false;">
  <table class="searchResults">
  	
    <tr><td><a href="positiondetils.php">Subject positions for Semester</a></td></tr>
    <tr><td><a href="subpositionnew.php">Allocate Subject for postions</a></td></tr>
    <tr><td><a href="subjectmap.php">Subject Mapping Among Semesters </a></td></tr>
    
	
  </table>
</form>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Semesters - Student Management System - Buddhisht & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Select Report</ul>";
  //Apply the template
  include("master_registration.php");
?>