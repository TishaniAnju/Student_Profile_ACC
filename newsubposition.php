<?php
  ob_start();
?>
<script language="javascript">
function validate_form(thisform)
{
	with (thisform)
	  {
		if (!validate_required(txtsubCode) ||!validate_required(txtNameE) || !validate_required(txtNameS))
		{alert("One or more mandatory fields are kept blank.");return false;}
	  }
}
</script>
<?php
 require_once("dbAccess.php");
 $db = new DBOperations();
 //include('authcheck.inc.php');

 if (isset($_POST['btnAdd']))
	{
    
        $ps = $_POST['ps'];
        $ps_name = $_POST['pname'];
        $level = $_POST['level'];
        $semester = $_POST['subSemester'];
        $sql = "INSERT INTO positions (position,p_name,level,semester) VALUES ('$ps','$ps_name','$level','$semester')";
        $result = $db->executeQuery($sql);
	header("location:positiondetils.php");
	}
?>
<form action="" method="post" onsubmit="return validate_form(this);" class="plain">
<h1>   Subjects Positions</h1>

<table class="searchResults">
   <tr>
    <td>Subject Position: </td>
    <td><input type="number" class="form-control" id="ps" placeholder="Enter Position" name="ps"></td>
   </tr>
  <tr>
    <td>Position Name:</td>
    <td><input type="text" class="form-control" id="pname" placeholder="Enter Position Name" name="pname"></td>
  </tr>
  <tr>
    <td>Level :</td>
    <td> <select name="level" id="level" onchange="form1.submit()"> 

<option value="I">Level One</option>
<option value="II">Level Two</option>
<option value="III">Level Three</option>
<option value="IV">Level Four</option>
</select>
<script>
                    document.getElementById('level').value = "<?php echo $level;?>";
                </script> </td>
  </tr>
 <tr>
    <td>Semester :  </td>
    <td> 
    <select name="subSemester" id="subSemester" onchange="form1.submit()">

<option value="First Semester">First Semester</option>
<option value="Second Semester">Second Semester</option>
</select>
<script>

      document.getElementById('subSemester').value = "<?php echo $semester;?>";
    </script> 
  </tr>
  <tr><td colspan="2"><input name="btnCancel" type="button" value="Cancel" class="button" onclick="document.location.href='alSub.php';" tabindex="3" />&nbsp;&nbsp;<input name="btnAdd" type="submit" value="Add" align="middle" class="button" tabindex="4">
   </td></tr>
 </table>

</form>


<?php
    //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "New A/L Subject - A/L Subjects - Student Management System - Buddhisht & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a Href='alSub.php'>A\L Subjects </a></li><li>New A\L Subject</ul>";
  //Apply the template
  include("master_registration.php");
?>


