<?php
  ob_start();
?>
<script language="javascript">
function validate_form(thisform)
{
	with (thisform)
	  {
		if (!validate_required(txtlower) ||!validate_required(txtupper) || !validate_required(txtgrade))
		{alert("One or more mandatory fields are kept blank.");return false;}
	  }
}
</script>
<?php
if (isset($_POST['btnAdd']))
	{
	include("dbAccess.php");
	$lower = cleanInput($_POST['txtlower']);
	$upper = cleanInput($_POST['txtupper']);
	$grade = cleanInput($_POST['txtgrade']);
	$point = cleanInput($_POST['txtpoint']);
/*	
	$sqlgetId = "Select Id from gradepoints order by Id";

 $FoundId = @mysql_query($sqlgetId);
 $NumRowsId = @mysql_numrows($FoundId);
 if($NumRowsId<1){
 $newId=1;
 }
 else{
  $lastId = @mysql_result($FoundId,$NumRowsId-1 ,"Id");
  $newId=$lastId+1;
} 
	*/
  //,Id='$newId'
	$query = "INSERT INTO gradepoints SET lower='$lower', upper='$upper', grade='$grade', points='$point'";
	$result = $db->executeQuery($query);
	header("location:gradepoints.php");
	}
?>
<form action="" method="post" onsubmit="return validate_form(this);" >
  <h1> Geade Points</h1>

<table class="searchResults">
   <tr>
      <td>Lower Marks</td>
    <td><input name="txtlower" type="text" tabindex="1"></td>
   </tr>
  <tr>
      <td height="25">Upper Marks</td>
    <td><input name="txtupper" type="text" tabindex="2"></td>
  </tr>
  <tr>
    <td>Grade</td>
    <td><input name="txtgrade" type="text" tabindex="3"></td>
  </tr>
  <tr>
      <td>Points</td>
    <td><input name="txtpoint" type="text" tabindex="3"></td>
  </tr>
  <tr><td colspan="2"><input name="btnCancel" type="button" value="Cancel" class="button" onclick="document.location.href='AlSub.php';" tabindex="3" />&nbsp;&nbsp;<input name="btnAdd" type="submit" value="Add" align="middle" class="button" tabindex="4">
   </td></tr>
 </table>

</form>


<?php
    //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "New Grade Points - Grade Points - Student Management System - Buddhisht & Pali University of Sri Lanka";
  //$navpath = "<ul><li><a href='home.php'>Home </a></li><li><a Href='Gradepoints.php'>A\L Subjects </a></li><li>New Grade Points</ul>";
  //Apply the template
  include("master_registration.php");
?>


