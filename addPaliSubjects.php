<?php
  ob_start();
?>

<?php
	//include("authcheck.inc.php");
	include("dbAccess.php");
	
	if (isset($_POST['btnSubmit']))
	{
		$code = cleanInput($_POST['code']);
		$sub = cleanInput($_POST['sub']);
		
		$query = "INSERT INTO paliqualification SET code = '$code' , qualification = '$sub'";
		$result = executeQuery($query); 
		echo $code-$sub;
	}
?>
<form action="" method="post">
<label>code</label><input name="code" type="text">
<label>sub</label><input name="sub" type="text">
<input type="submit" name="btnSubmit" id="btnSubmit" value="Submit" class="button" />
</form>
<?php
    //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Local Applicant - Registration - Buddhisht & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href=''>Home </a></li><li><a href=''>Registration </a></li><li>Local Applicant</li></ul>";
  //Apply the template
  include("master_registration.php");
?>
