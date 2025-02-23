<?php
  //Buffer larger content areas like the main page content
  ob_start();
?>

<script language="javascript" src="lib/scw/scw.js"></script>




<h1>New Subject Enrolment</h1>
<?php
	//2021-03-25 start  include('dbAccess.php');
	require_once("dbAccess.php");
	$db = new DBOperations();
    //2021-03-25 end
  //	include('authcheck.inc.php');
	
	//====================================
	 

  $studentID =$db->cleanInput($_GET['regNo']);

	if (isset($_POST['subSemester']))
	{
	$semester= $db->cleanInput($_POST['subSemester']);
		//$semester=$_POST['subSemester'];
	}
	if (isset($_POST['level']))
	{
	$level = $db->cleanInput($_POST['level']);
		//$level=$_POST['level'];
	}
	if (isset($_POST['lstSubject']))
	
	{
	$SubjectID = $db->cleanInput($_POST['lstSubject']);
		//$SubjectID=$_POST['lstSubject'];
	}
	if (isset($_POST['acyear']))
	{
	$acyear = $db->cleanInput($_POST['acyear']);
		//$acyear=$_POST['acyear'];
	}
	
	//====================================
	
	if (isset($_POST['btnSubmit']))
	{
    $query = "INSERT INTO studentenrolment SET regNo='$studentID', subjectID='$SubjectID',indexNo='$studentID', acYear='$acyear'";
		$result = $db->executeQuery($query);

		$query1 = "INSERT INTO attendence SET  subjectID='$SubjectID',indexNo='$studentID', acYear='$acyear'";
		$result1 = $db->executeQuery($query1);

		header("location:studentEnroll.php?regNo=$studentID");
	}
?>
<form method="post" name="form" id="form" action="" onsubmit="return validate_form(this);" class="plain">
<table class="searchResults">
<tr>
    	<td>Registration No. : </td><td><input name="txtRegNo" type="text" value="<?php echo $studentID; ?>" /></td>
    </tr>
    <tr>
    	<td>Level : </td>
		<!-- <td><select name="level" id="level" onchange="document.form1.submit()">  -->
		 <td><select name="level" id="level" onchange="form.submit()"> 

        	<option value="I">Level One</option>
        	<option value="II">Level Two</option>
			<option value="III">Level Three</option>
        	<option value="IV">Level Four</option>
        </select>
		<script>
								document.getElementById('level').value = "<?php echo $level;?>";
							</script> 
		</td>
    </tr>
	<tr>
    	
      <td>Semester : </td>
      <!-- <td><select name="subSemester" id="subSemester" onchange="document.form1.submit()"> -->
	  <td><select name="subSemester" id="subSemester" onchange="form.submit()">

        	<option value="First Semester">First Semester</option>
        	<option value="Second Semester">Second Semester</option>
        </select>
			<script>
		
								document.getElementById('subSemester').value = "<?php echo $semester;?>";
							</script> 
		</td>
    </tr>
	<tr>
    <tr>
    	<td>Subject : </td>
        <!-- <td><select name="lstSubject" id="lstSubject" style="width:auto" onchange="document.form1.submit()"> -->
		<td><select name="lstSubject" id="lstSubject" style="width:auto" onchange="form.submit()">>

        	<?php
			
			$query = "SELECT * FROM subject WHERE level='$level' and semester='$semester'";
			// print $query;
			//2021-03-25 start  $result = executeQuery($query);
			$result = $db->executeQuery($query);
			//2021.03.25 end
			//2021-03-25 start  for ($i=0;$i<mysql_num_rows($result);$i++)
			
			// for ($i=0;$i<$db->Row_Count($result);$i++)
			while($data=$db->Next_Record($result))
				
			//2021.03.25 end
			{
				$rID = $data["subjectID"];
				$rCode = $data["codeEnglish"];
				$rSubject =$data["nameEnglish"];
				echo "<option value=\"".$rID."\">".$rCode."-".$rSubject."</option>";        	
        	} 
			?>
        	</select>
			<script>
								document.getElementById('lstSubject').value = '<?php echo $SubjectID;?>';
							</script> 
        </td>
    </tr>
    <tr>
      <td>Academic Year: </td>
      <td><label>
<select name="acyear" id="acyear"> 
<?php
$starting_year  =date('Y', strtotime('-5 year'));
 $ending_year = date('Y', strtotime('+5 year'));
 $current_year = date('Y');
 for($starting_year; $starting_year <= $ending_year; $starting_year++) {
     echo '<option value="'.$starting_year.'"';
     if( $starting_year ==  $current_year ) {
            echo ' selected="selected"';
     }
     echo ' >'.$starting_year.'</option>'; 
 }   
  ?>          
</select>
					
 </label>
		</td> 
        
    </tr>
  
	
   
</table>
 
<br/><br/>
<p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'examAdmin.php';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="submit" value="Submit" class="button" /></p>
</form>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "New Effort - Exam Efforts - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='examAdmin.php'>Exam Efforts </a></li><li>New Effort</li></ul>";
  //Apply the template
  include("master_registration.php");
?>