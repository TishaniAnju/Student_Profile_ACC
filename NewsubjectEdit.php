<?php
  //Buffer larger content areas like the main page content
  ob_start();
?>


<h1>Subject Edit</h1>
<?php
	 //2021-03-25 start  include('dbAccess.php');
	 require_once("dbAccess.php");
	 $db = new DBOperations();
	 //2021-03-25 end
 
  	//include('authcheck.inc.php');

	if (isset($_POST['btnSubmit']))
	{
		//2021-03-25 start  $subjectID = cleanInput($_GET['subjectID']);
		$subjectID = $db->cleanInput($_GET['subjectID']);
		//2021-03-25 end
		//2021-03-25 start  $codeEnglish = cleanInput($_POST['txtCodeEnglish']);
		$codeEnglish = $db->cleanInput($_POST['txtCodeEnglish']);
		//2021-03-25 end
		//2021-03-25 start  $nameEngslih = cleanInput($_POST['txtNameEnglish']);
		$nameEngslih = $db->cleanInput($_POST['txtNameEnglish']);
		//2021-03-25 end
		//2021-03-25 start  $codeSinhala = cleanInput($_POST['txtCodeSinhala']);
		$codeSinhala = $db->cleanInput($_POST['txtCodeSinhala']);
		//2021-03-25 end
		//2021-03-25 start  $nameSinhala = cleanInput($_POST['txtNameSinhala']);
		$nameSinhala = $db->cleanInput($_POST['txtNameSinhala']);
		//2021-03-25 end
		$faculty = $db->cleanInput($_POST['lstFaculty']);
		$level = $db->cleanInput($_POST['txtLevel']);
		$semester = $db->cleanInput($_POST['txtSemester']);
		$spCategory = $db->cleanInput($_POST['spCategory']);
		$spRelated = $db->cleanInput($_POST['spRelated']);
		$medium = $db->cleanInput($_POST['medium']);
		
		

		//2021-03-25 start  $chours = cleanInput($_POST['txtchours']);
		$chours = $db->cleanInput($_POST['txtchours']);
		//2021-03-25 end
		//2021-03-25 start  $description = cleanInput($_POST['txtDescription']);
		$description = $db->cleanInput($_POST['txtDescription']);
		//2021-03-25 end

		$query = "UPDATE Newsubject SET codeEnglish='$codeEnglish', nameEnglish='$nameEngslih', codeSinhala='$codeSinhala', nameSinhala='$nameSinhala', faculty='$faculty', level='$level', description='$description', semester='$semester',spCategory='$spCategory',spRelated='$spRelated',creditHours='$chours',medium='$medium' WHERE subjectID='$subjectID'";
		//2021-03-25 start  $result = executeQuery($query);
		$result = $db->executeQuery($query);
		header("location:NewsubjectAdmin.php");
	}
	
	//2021-03-25 start  
	$subjectID = $db->cleanInput($_GET['subjectID']);

	$query = "SELECT * FROM Newsubject WHERE subjectID='$subjectID'";
	//2021-03-25 start  $result = executeQuery($query);
	$result = $db->executeQuery($query);
	//2021-03-25 start  $row = mysql_fetch_array($result);
	$row = $db->Next_Record($result);
	//2021-03-25 start  if (mysql_num_rows($result)>0)
	if ($db->Row_Count($result)>0)
	{
?>
<form action="" method="post">
<table class="searchResults">
	<tr>
    	<td>Code (English) : </td><td><input name="txtCodeEnglish" type="text" value="<?php echo $row['codeEnglish'] ?>" /></td>
    </tr>
    <tr>
    	<td>Name (English) : </td><td><input name="txtNameEnglish" type="text" value="<?php echo $row['nameEnglish'] ?>" style="width:300px"/></td>
    </tr>
    <tr>
    	<td>Code (Sinhala) : </td><td><input name="txtCodeSinhala" type="text" value="<?php echo $row['codeSinhala'] ?>" /></td>
    </tr>
    <tr>
    	<td>Name (Sinhala) : </td><td><input name="txtNameSinhala" type="text" value="<?php echo $row['nameSinhala'] ?>" style="width:300px"/></td>
    </tr>
    <tr>
    	<td>Faculty : </td><td><select name="lstFaculty">
        	<option <?php if ($row['faculty']=='Buddhist') echo "selected='selected'"; ?> value="Buddhist">Buddhist Studies</option>
        	<option <?php if ($row['faculty']=='Language') echo "selected='selected'"; ?> value="Language">Language Studies</option>
        </select></td>
    </tr>
    <tr>
    	<td>Level : </td><td><select name="txtLevel">
        	<option <?php if ($row['level']=='I') echo "selected='selected'"; ?>value="I">One</option>
			<option <?php if ($row['level']=='II') echo "selected='selected'"; ?>value="II">Two</option>
				<option <?php if ($row['level']=='III') echo "selected='selected'"; ?>value="III">Three</option>
        	<option <?php if ($row['level']=='IV') echo "selected='selected'"; ?>value="IV">Four</option>
        </select></td>
		
		
		
		
    </tr>
	<tr>
    	<td>Semester : </td><td>
		<select name="txtSemester">
        	<option <?php if ($row['semester']=='First Semester') echo "selected='selected'"; ?> value="First Semester">First Semester</option>
        	<option <?php if ($row['semester']=='Second Semester') echo "selected='selected'"; ?> value="Second Semester">Second Semester</option>
        </select>
		</td>
    </tr>
        
         <?php  
			
			
			
			?>
        </select></td>
    </tr>
   
	 <!--Load special degree subjects-->
    <tr>	
      <td>Special Related : </td>
      <td><select name="spRelated">
	  <?php
				
				$result = $db->executeQuery("SELECT DISTINCT * FROM special_degree");
				
				if ($db->Row_Count($result)>0)
				{
					while ($selectedRow=$db->Next_Record($result))
					{	
					?>
					<option <?php if ($row['spRelated']==$selectedRow['sid']){ echo "selected='selected'";} ?>  value="<?php echo $selectedRow['sid'];?>" ><?php echo $selectedRow['description']; ?></option>		
					<?php
					}
				}
			?>
			<?php echo $selectedRow['description']; ?>
			<option <?php if ($row['spRelated']=='0') echo "selected='selected'"; ?> value="0">None</option>
		</select></td>
    </tr>
	<tr>
    	<td>Credit Hours : </td><td><input name="txtchours" type="text" value="<?php echo $row['creditHours'] ?>" /></td>
    </tr>
	
    <tr>
    	<td>Description : </td><td><input name="txtDescription" type="text" value="<?php echo $row['description'] ?>" style="width:300px" /></td>
    </tr>
	<tr>
    	<td>Medium : </td><td>
		<select name="medium">
        	<option <?php if ($row['medium']=='Sinhala') echo "selected='selected'"; ?> value="Sinhala">Sinhala</option>
        	<option <?php if ($row['medium']=='English') echo "selected='selected'"; ?> value="English">English</option>
			<option <?php if ($row['medium']=='Both') echo "selected='selected'"; ?> value="Both">Both</option>
        </select>
		</td>
    </tr>
</table>
<br/><br/>
<p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'NewsubjectAdmin.php';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="submit" value="Submit" class="button" /></p>
</form>

<?php
   }
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
 $pagetitle = "Edit Subject - Subjects - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='NewsubjectAdmin.php'>Subjects </a></li><li>Edit Subject</li></ul>";
  //Apply the template
  include("master_registration.php");
?>