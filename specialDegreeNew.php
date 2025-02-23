<?php
  ob_start();
?>

<h1>New Special Degree</h1>
<?php

    require_once("dbAccess.php");
	$db = new DBOperations();

	if (isset($_POST['btnSubmit']))
	{  
	
		$description  = $_POST['description'];
		$query = "INSERT INTO special_degree SET description='$description'";
    $result = $db->executeQuery($query);
		header("location:specialDegreeAdmin.php");
	}
?>
<form method="post" action="" class="plain">

<table class="searchResults">
    <tr>
    	<td>Description : </td><td><input name="description" type="text" value="" /></td>
    </tr>
</table>
<br/><br/>
<p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'specialDegreeAdmin.php';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="submit" value="Submit" class="button" /></p>
</form>

<?php
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
   $pagetitle = "New Special Degree - Subjects - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='specialDegreeAdmin.php'>Subjects </a></li><li>New Special Degree</li></ul>";
  include("master_registration.php");
?>