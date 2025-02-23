<?php
  //Buffer larger content areas like the main page content
  ob_start();
?>

<h1>Subject Details</h1>
<?php
	//2021-03-23 start  include('dbAccess.php');
	  require_once("dbAccess.php");
	  $db = new DBOperations();
    //2021-03-23 end
  	include('authcheck.inc.php');
	
	//2021-03-23 start  $subjectID = cleanInput($_GET['subjectID']);
  $subjectID = $db->cleanInput($_GET['subjectID']);
  //2021-03-23 end
	$query = "SELECT * FROM subject WHERE subjectID='$subjectID'";
	//2021-03-23 start  $result = executeQuery($query);
  $result = $db->executeQuery($query);
  //2021-03-23 end
	//2021-03-23 start  $row = mysql_fetch_array($result);
  $row = $db->Next_Record($result);
	//2021-03-23 end
	//2021-03-23 start  if (mysql_num_rows($result)>0)
  if ($db->Row_Count($result)>0)
  //2021-03-23 end
	{
?>

<table class="searchResults">
	<tr>
    	<th colspan="2"><?php echo $row['nameEnglish']; ?></th>
    </tr>
    <tr>
    	<td>Code (English) : </td><td> <?php echo $row['codeEnglish']; ?></td>
    </tr>
    <tr>
    	<td>Name (English) : </td><td> <?php echo $row['nameEnglish']; ?></td>
    </tr>
    <tr>
    	<td>Code (Sinhala) : </td><td> <?php echo $row['codeSinhala']; ?></td>
    </tr>
    <tr>
    	<td>Name (Sinhala) : </td><td> <?php echo $row['nameSinhala']; ?></td>
    </tr>
    <tr>
    	<td>Faculty : </td><td> <?php echo $row['faculty']; ?> Studies</td>
    </tr>
    <tr>
    	<td>Level : </td><td> <?php echo $row['level']; ?></td>
    </tr>
	<tr>
    	<td>Semester : </td><td> <?php echo $row['semester']; ?></td>
    </tr>
	<tr>
    	<td>Credit Hours : </td><td> <?php echo $row['creditHours']; ?></td>
    </tr>
    <tr>
    	<td>Description : </td><td> <?php echo $row['description']; ?></td>
    </tr>
</table>
	<br/><p><input name="btnEdit" type="button" value="Edit"  class="button" onclick="document.location.href ='subjectEdit.php?subjectID=<?php echo $row['subjectID'] ?>'"/></p>
      
<?php
   }
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Subject Details - Subjects - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='subjectAdmin.php'>Subjects </a></li><li>Subject Details</li></ul>";
  //Apply the template
  include("master_registration.php");
?>