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
    
	$year = $_POST['cyear'];
	if($year == 1)
	{
		$year_name = 'First Year';
	}
	elseif($year == 2)
	{
		$year_name = 'Second Year';
	}
	elseif($year == 3)
	{
		$year_name = 'Third Year';
	}
	elseif($year == 4)
	{
		$year_name = 'Fourth Year';
	}
	$semester = $db->cleanInput($_POST['csem']);
	
	if($semester == 1)
	{
		$semester_name = 'First Semester';
	}
	else{
	$semester_name = 'Second Semester';
	}
	$sdate = $db->cleanInput($_POST['sdate']);
	$edate = $db->cleanInput($_POST['edate']);

	$query = "INSERT INTO enrollPeriod SET year='$year', semester='$semester', year_name='$year_name',semester_name='$semester_name',sdate='$sdate',edate='$edate'";
	$result = $db->executeQuery($query);
	header("location:semester.php");
	}
?>
<form action="" method="post" onsubmit="return validate_form(this);" class="plain">
<h1> New Semester</h1>

<table class="searchResults">
   
   <tr>
        <td height="25">Year </td>
        <td><select name="cyear" id="cyear" tabindex="4" > 
           <option value='1'>1</option>
           <option value='2'>2</option>
		   <option value='3'>3</option>
           <option value='4'>4</option>

        </select></td>
      </tr>
   <tr>
        <td height="25">Semester </td>
        <td><select name="csem" id="csem" tabindex="4" > 
           <option value='1'>1</option>
           <option value='2'>2</option>
		  
        </select></td>
      </tr>
	  <tr>
  <tr>
    
        <td height="25">Start Date </td>
        <td><input name="sdate" type="date"  tabindex="3" size="20" /></td>
    
  </tr>
   <tr>
        <td height="25">End Date </td>
        <td><input name="edate" type="date"  tabindex="3" size="20" /></td>
      </tr>
  <tr><td colspan="2"><input name="btnCancel" type="button" value="Cancel" class="button" onclick="document.location.href='semester.php';" tabindex="3" />&nbsp;&nbsp;<input name="btnAdd" type="submit" value="Add" align="middle" class="button" tabindex="4">
   </td></tr>
 </table>

</form>


<?php
    //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "New Semester - Semester Details - Student Management System - Buddhisht & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a Href='semester.php'>Semester Details</a></li><li>New Semester</ul>";
  //Apply the template
  include("master_registration.php");
?>


