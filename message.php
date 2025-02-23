<?php
  //Buffer larger content areas like the main page content
  ob_start();

$message = $_GET['message'];
echo "<p>$message</p>";

?>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Registration - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href=''>Home </a></li><li><a href=''>Registration </a></li></ul>";
  //Apply the template
  include("master_registration.php");
?>