<?php
  //Buffer larger content areas like the main page content
  ob_start();
?>

<script>


</script>

<h1>Subject Orders</h1>
<?php
	//2021-03-25 start  include('dbAccess.php');
	require_once("dbAccess.php");
	$db = new DBOperations();
    //2021-03-25 end
  	include('authcheck.inc.php');
	
	//====================================
	if (isset($_POST['lstFaculty']))
	{
		$faculty=$_POST['lstFaculty'];
	}
	
	if (isset($_POST['subSemester']))
	{
		$semester=$_POST['subSemester'];
	}
	if (isset($_POST['level']))
	{
		$level=$_POST['level'];
	}

	//====================================
	
	if (isset($_POST['btnSubmit']))
	{
		// $queryall = "SELECT * FROM subject WHERE faculty='$faculty' and level='$level' and semester='$semester'";
		 	$queryall = "SELECT * FROM subject WHERE  semester='$semester' and level='$level'"; 

  //print  $queryall;

  //2021-03-25 start  $resultall = executeQuery($queryall);
  $resultall = $db->executeQuery($queryall);
  //2021-03-25 end
  //2021-03-25 start  while ($row= mysql_fetch_array($resultall))
  while ($row= $db->Next_Record($resultall))
  //2021-03-25 end
  {
		//$indexNovalue = mysql_result($resultall,$i,'$indexNo');
		//$indexNovalue = $resultall['$indexNo'];
		$subjectvalue=$row['subjectID'] ;
			//$indexNovalue = '20133000';
	
			
			$order = $_POST['txtMarks1'.$subjectvalue];
			
	//print ("Update subject set order='$order' where subjectID='$subjectvalue'");

			//2021-03-25 start  $result = executeQuery("UPDATE `subject` SET `suborder`='$order' WHERE `subjectID`='$subjectvalue'");
			$result = $db->executeQuery("UPDATE `subject` SET `suborder`='$order' WHERE `subjectID`='$subjectvalue'");
			//2021-03-25 end

			//print ("Update subject set order=$order where subjectID='$subjectvalue'");
			//print "Insert into exameffort (indexNo,subjectID,mark1,mark2,marks,grade,gradePoint,acYear,effort)VALUES ($indexNovalue,$SubjectID,'$mark1','$mark2','$marks',$grade,$gradepoint,$acyear,$effort,$medium)";
		}
		header("location:subjectAdmin.php");
	}
?>
<form method="post" name="form1" id="form1" action="" onsubmit="return validate_form(this);" class="plain">
<table class="searchResults">
   <tr>
    <!---	
     <td height="28">Faculty : </td>
      <td><select name="lstFaculty" id="lstFaculty" onchange="document.form1.submit()">
        	<option value="Buddhist">Buddhist Studies</option>
        	<option value="Language">Language Studies</option>
        </select>
		<script>
								document.getElementById('lstFaculty').value = "<?php echo $faculty;?>";
							</script>
		
		</td>
		-->
    </tr>
    <tr>
    	<td>Level : </td>
		<td><select name="level" id="level" onchange="document.form1.submit()">
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
      <td><select name="subSemester" id="subSemester" onchange="document.form1.submit()">
        	<option value="First Semester">First Semester</option>
        	<option value="Second Semester">Second Semester</option>
        </select>
		
		<script>
								document.getElementById('subSemester').value = "<?php echo $semester;?>";
							</script>
		</td>
	
    </tr>
	
    
</table>
 <table class="searchResults">
	<tr>
    	<th>Subject Code</th><th>Name</th><th>Order</th>
    </tr>
    
<?php
 //$queryall = "Select * from subject_enroll as s, crs_enroll as c where s.subjectID='$SubjectID' and s.Enroll_id=c.Enroll_id and yearEntry='$acyear' order by c.indexNo";
//print $queryall;
 // $queryall = "SELECT * FROM subject WHERE faculty='$faculty' and level='$level' and semester='$semester'";
 $queryall = "SELECT * FROM subject WHERE  semester='$semester' and level='$level'"; 
 //print  $queryall;

  //2021.03.25 start  $resultall = executeQuery($queryall);
  $resultall = $db->executeQuery($queryall);
  //2021.03.25 end
//2021.03.25 start  $numRows = mysql_num_rows($resultall);
$numRows = $db->Row_Count($resultall);
//2021.03.25 end
//2021.03.25 start  while ($row= mysql_fetch_array($resultall))
while ($row= $db->Next_Record($resultall))
//2021.03.25 end
  {
?>
	<tr>
        
		<?php
		
		
	
		 ?>
		 <td><?php echo $row['codeEnglish'] ?></td>
		<td><?php echo $row['nameEnglish'] ?></td>
     
		
          <td> 
	 
								<select name="txtMarks1<?php echo $row['subjectID']?>" id="txtMarks1<?php echo $row['subjectID']?>" class="form-control"> 
							<?php	
								for ($i=1; $i<=$numRows;$i++){
								
								if($row['suborder']==$i){
									echo '<option value="'.$i.'" selected>'. $row['suborder'].'</option>';
									}else{
									echo '<option value="'.$i.'">'. $i.'</option>';
									}
								}
									?>
								</select>
						
							</td> 
        
	</tr>  
<?php

  }
?>
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