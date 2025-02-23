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
 include('authcheck.inc.php');

 if (isset($_POST['btnAdd']))
	{
    
	$subjectCode = $db->cleanInput($_POST['txtsubCode']);
	$nameE = $db->cleanInput($_POST['txtNameE']);
	$nameS = $db->cleanInput($_POST['txtNameS']);
	$qualif = $db->cleanInput($_POST['qualif']);
	$strm = $db->cleanInput($_POST['strm']);
        
     
	$query = "INSERT INTO alsubjects SET subjectCode='$subjectCode', subnameE='$nameE', subnameS='$nameS', streamId='$strm', quli_id='$qualif'";
	$result = $db->executeQuery($query);
	header("location:alSub.php");
	}
?>
<form action="" method="post" onsubmit="return validate_form(this);" class="plain">
<h1>  GCE A/L Subjects</h1>

<table class="searchResults">
    
    <tr>
    <td>Qualification</td>
    <td><select required name="qualif" id="qualif">
       <option value="">Select Qualification</option>
       <?php
       $empnos = $db->executeQuery("SELECT * FROM qulidetails;");
	   while ($emps = $db->Next_Record($empnos))
	   {
		  ?>
		  <option value="<?php echo $emps[0]?>"><?php echo $emps[1]?></option>
		  <?php 
	   }
	   ?>
       </select></td>
   </tr>
    <tr>
    <td>Stream</td>
    <td><select name="strm" id="strm">
       <option value="">No Stream</option>
       <?php
       $empnos = $db->executeQuery("SELECT * FROM alstream;");
//        dd($empnos);
	   while ($emps = $db->Next_Record($empnos))
	   {
		  ?>
		  <option value="<?php echo $emps[0]?>"><?php echo $emps[1]?></option>
		  <?php 
	   }
	   ?>
       </select></td>
   </tr>
    
   <tr>
    <td>Subject Code</td>
    <td><input name="txtsubCode" id="txtsubCode" type="text" tabindex="1"></td>
   </tr>
  <tr>
    <td>Subject Name in English</td>
    <td><input name="txtNameE" id="txtNameE" type="text" tabindex="2"></td>
  </tr>
  <tr>
    <td>Subject Name in Sinhala</td>
    <td><input name="txtNameS" id="txtNameS" type="text" tabindex="3"></td>
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


