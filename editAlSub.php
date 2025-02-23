<?php
  ob_start();
?>

<?php
	include("dbAccess.php");
  $db = new DBOperations();
  //2021-03-23 end
 


	$subCode = $db->cleanInput($_GET['subCode']);

  if (isset($_POST['btnAdd']))
	{
	$nameE =  $db->cleanInput($_POST['txtNameE']);
	$nameS =  $db->cleanInput($_POST['txtNameS']);
	
	$query = "UPDATE alsubjects SET subnameE='$nameE', subnameS='$nameS' WHERE subjectCode='$subCode'";
	$result =  $db->executeQuery($query); 
		header("location:alSub.php");
	}



  $query = "SELECT * FROM alsubjects WHERE subjectCode='$subCode'";
  $result = $db->executeQuery($query); 


  while ($row = $db->Next_Record($result))

  {



	
?>





<form action="" method="post">
<h1>  GCE A/L Subjects</h1>

<table class="searchResults">
  <tr>
    <td>Subject Code</td>
    <td><input name="txtSubCode" type="text" value="<?php echo $row['subjectCode']; ?>" readonly="readonly" style="border:none" tabindex="1"></td>
  </tr>
  <tr>
    <td>Subject Name in English</td>
    <td><input name="txtNameE" type="text" value="<?php echo $row['subnameE']; ?>"></td>
  </tr>
  <tr>
    <td>Subject Name in Sinhala</td>
    <td><input name="txtNameS" type="text" value="<?php echo $row['subnameS']; ?>"></td>
  </tr>
  <tr><td colspan="2"><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href='alSub.php';" class="button" />
 <input name="btnAdd" type="submit" value="Save" class="button" >
    </td></tr>
 </table>

</form>
<?php
  }
  ?>


<?php
  
    //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Edit A/L Subject - A/L Subjects - Student Management System - Buddhisht & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='AlSub.php'>A/L Subjects </a></li><li>Edit A/L Subject</li></ul>";
  //Apply the template
  include("master_registration.php");
?>