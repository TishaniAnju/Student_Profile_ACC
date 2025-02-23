<?php
  //Buffer larger content areas like the main page content
  ob_start();
  session_start();
  
   if (!isset($_SESSION['authenticatedUser'])) {
   echo $_SESSION['authenticatedUser'];
   header("Location: index.php");
   }
?>

 
 <script language="javascript">
 	function MsgOkCancel()	{

		var message = "Please confirm to DELETE this entry...";
		var return_value = confirm(message);
		return return_value;
	}
	
	function getGrade(mark1,mark2,row)
	{
		var grade;
		var gradePoint;
		
if(mark1=='AB'){
	
	
	document.getElementById('txtMarks'+row).value='AB';
	grade = '';
		gradePoint='';
		document.getElementById('txtGrade'+row).value = grade;
	document.getElementById('txtGradePoint'+row).value = gradePoint;
		}
if(mark1=='MD'){
	
	
	document.getElementById('txtMarks'+row).value='MD';
	grade = '';
	gradePoint='';
	document.getElementById('txtGrade'+row).value = grade;
	document.getElementById('txtGradePoint'+row).value = gradePoint;
		
		}
else{
		
	var average;
	var average1;
	mark1=eval(mark1);
	mark2=eval(mark2);
		

	average=Math.round((mark1+mark2)/2);

	

	document.getElementById('txtMarks'+row).value=average;
	marks=average;
	if (0<=marks && marks<=24) {grade = 'E'; gradePoint='0.0';}
	else if (25<=marks && marks<=29) {grade = 'D'; gradePoint='1.0';}
	else if (30<=marks && marks<=34) {grade = 'D+'; gradePoint='1.3';}
	else if (35<=marks && marks<=39) {grade = 'C-'; gradePoint='1.7';}
	else if (40<=marks && marks<=44) {grade = 'C'; gradePoint='2.0';}
	else if (45<=marks && marks<=49) {grade = 'C+'; gradePoint='2.3';}
	else if (50<=marks && marks<=54) {grade = 'B-'; gradePoint='2.7';}
	else if (55<=marks && marks<=59) {grade = 'B'; gradePoint='3.0';}
	else if (60<=marks && marks<=64) {grade = 'B+'; gradePoint='3.3';}
	else if (65<=marks && marks<=69) {grade = 'A-'; gradePoint='3.7';}
	else if (70<=marks && marks<=84) {grade = 'A'; gradePoint='4.0';}
	else if (85<=marks && marks<=100) {grade = 'A+'; gradePoint='4.0';}
	else grade = '';
	
	document.getElementById('txtGrade'+row).value = grade;
	document.getElementById('txtGradePoint'+row).value = gradePoint;
		}
	}
 </script>
 <?php
  include('dbAccess.php');
  
  
  if (isset($_POST['CourseID']))
	{
		$courseID=$_POST['CourseID'];
	}
	
	if (isset($_POST['subcrsID']))
	{
		$subcrsID=$_POST['subcrsID'];
	}
	if (isset($_POST['acyear']))
	{
		$acyear=$_POST['acyear'];
	}
	if (isset($_POST['SubjectID']))
	{
		$SubjectID=$_POST['SubjectID'];
	}
	
  //print $acyear;
  if (isset($_GET['cmd']) && $_GET['cmd']=="delete")
  {
	$effortID = cleanInput($_GET['effortID']);
	$delQuery = "DELETE FROM exameffort WHERE effortID='$effortID'";
	$result = executeQuery($delQuery);
  }
  
  session_start();
  
  if (isset($_POST['btnSubmit']))
	{
		$indexNo = $_SESSION['indexNo']; 
		///print $indexNo[1];
		$queryall = "Select * from subject_enroll as s, crs_enroll as c where s.subjectID='$SubjectID' and s.Enroll_id=c.Enroll_id and yearEntry='$acyear'";
  //print $queryall;
  $resultall = executeQuery($queryall);
		for ($i=0;$i<mysql_num_rows($resultall);$i++)
		{
		$indexNovalue = $indexNo[$i];
		$querymark1 = "Select * from exameffort where subjectID='$SubjectID' and indexNo=$indexNovalue and acYear='$acyear'";
		 $resultmark = executeQuery($querymark1);
		 $rowmark= mysql_fetch_array($resultmark);
		 $effortvalue = $rowmark['effortID'];
			
		
			$mark2 = cleanInput($_POST['txtMarks2'. $effortvalue]);
			$marks = cleanInput($_POST['txtMarks'. $effortvalue]);
			$grade = cleanInput($_POST['txtGrade'. $effortvalue]);
			$gradepoint = cleanInput($_POST['txtGradePoint'. $effortvalue]);
		
			//$grade = cleanInput($_POST['txtGrade'.$effortID]);
			$result = executeQuery("UPDATE exameffort set mark2='$mark2',marks='$marks',grade='$grade',gradePoint='$gradepoint',effort='1' where effortID='$effortvalue' ");
			print "UPDATE exameffort set mark2='$mark2',marks='$marks',grade='$grade',gradePoint='$gradepoint',effort='1' where effortID='$effortvalue' ";
		}
		header("location:examAdmin.php");
	}
  
  //$query = $_SESSION['query'];
 
?>

 <h1>Enter Results</h1>
 <br />
  
<?php
//if (mysql_num_rows($result)>0){
?>
<form method="post" action="" name="form1" id="form1" class="plain">
<br/>
 <table width="230" class="searchResults">
    <tr> 
      <td width="127">Course  :</td>
	 
      <td width="91"><select id="CourseID" name="CourseID" onchange="document.form1.submit()" >
      <option value="">---</option>
          <?php
			$query = "SELECT courseID,courseCode FROM course;";
			$result = executeQuery($query);
			while ($data=mysql_fetch_array($result)) 
			{
			if ($_SESSION['courseId']==0)
			  {
			  echo '<option value="'.$data[0].'">'.$data[1].'</option>'; 
			  }
			  else
			  {
				if ($_SESSION['courseId']==$data[0])
				  {
				  echo '<option value="'.$data[0].'">'.$data[1].'</option>'; 
				  }	
			  }
        	} 
			?>
        </select>
        <script type="text/javascript" language="javascript">
		document.getElementById('CourseID').value="<?php if(isset($courseID)){echo $courseID;}?>";
		</script>
      </td>
    </tr>
   
	
	
	<tr>
      <td>SubCourse: </td>
      <td><label>
     	  <?php
	 
								echo '<select name="subcrsID" id="subcrsID"  onChange="document.form1.submit()" class="form-control">'; // Open your drop down box
								$sql="SELECT * FROM `crs_sub` WHERE `courseID` ='".$_SESSION['courseId']."' ";
								$result = executeQuery($sql);
								//echo '<option value="all">Select All</option>';
								
								while ($row = mysql_fetch_array($result)){
									echo '<option value="'.$row['id'].'">'.$row['description'].'</option>';
								}
								echo '</select>';// Close drop down box
							?>
							
							 <script>
								document.getElementById('subcrsID').value = "<?php echo $subcrsID;?>";
							</script>
 </label>
		</td>
        
    </tr>
	 
   
    <tr>
      <td>Subject: </td>
      <td><label>
	  <select id="SubjectID" name="SubjectID" onchange="document.form1.submit()" >
              <?php
		if(isset($courseID))
		{
		
			//$query2 = "SELECT subjectID,nameEnglish,codeEnglish FROM subject Where `courseID` ='".$_SESSION['courseId']."' ;";
		$query2 = "SELECT * FROM crs_subject WHERE CourseID='".$_SESSION['courseId']."' AND `subcrsid`='$subcrsID' order by compulsary  ";
			$result2 = executeQuery($query2);
			while ($data2=mysql_fetch_array($result2)) 
			{
			$subjectid=$data2[3];
				$query22="SELECT subjectID,nameEnglish,codeEnglish FROM subject Where `subjectID` ='$subjectid'";
				$result22=executeQuery($query22);
				$data22=mysql_fetch_array($result22);
				
			echo '<option value="'.$data22[0].'">'.$data22[2].'--'.$data22[1].'</option>';
        	} 

		}

			?>
      </select>
        <script type="text/javascript" language="javascript">
		document.getElementById('SubjectID').value="<?php if(isset($SubjectID)){echo $SubjectID;}?>"; 
			</script>
      </label> </td>
    </tr>
	<tr>
      <td>Academic Year: </td>
      <td><label>
     	  <?php
	 
								echo '<select name="acyear" id="acyear"  onChange="document.form1.submit()" class="form-control">'; // Open your drop down box
								$sql="SELECT distinct yearEntry FROM crs_enroll";
								$result = executeQuery($sql);
								//echo '<option value="all">Select All</option>';
								
								while ($row = mysql_fetch_array($result)){
									echo '<option value="'.$row['yearEntry'].'">'.$row['yearEntry'].'</option>';
								}
								echo '</select>';// Close drop down box
							?>
							
							 <script>
								document.getElementById('acyear').value = "<?php echo $acyear;?>";
							</script>
 </label>
		</td>
        
    </tr>
	</table>
 
 
 
 
 
  <table class="searchResults">
	<tr>
    	<th>Index No.</th><th>Mark 1</th><th>Mark 2</th><th>Marks</th><th>Grade</th><th>Grade Point</th>
    </tr>
    
<?php
 $queryall = "Select * from subject_enroll as s, crs_enroll as c where s.subjectID='$SubjectID' and s.Enroll_id=c.Enroll_id and yearEntry='$acyear' order by c.indexNo";
//print $queryall;
  $resultall = executeQuery($queryall);
  while ($row= mysql_fetch_array($resultall))
  {
?>
	<tr>
        
		<?php
		
		$u=$row['indexNo'] ;
		$querymark1 = "Select * from exameffort where subjectID='$SubjectID' and indexNo=$u and acYear='$acyear'";
		 $resultmark = executeQuery($querymark1);
		 $rowmark= mysql_fetch_array($resultmark);
		
		if ($rowmark['mark1']==''){
		
		}
		else {
		 ?>
		 <td><?php echo $row['indexNo'] ?></td>
     	<td><?php echo $rowmark['mark1'] ?></td>
        <td><input  size="4" name="txtMarks2<?php echo $rowmark['effortID'] ?>" value="<?php echo $rowmark['mark2'] ?>" onkeyup="getGrade(this.value,<?php echo $rowmark['mark1'] ?>,<?php echo $rowmark['effortID'] ?>)" type="text" /></td>
        <td><input size="4" name="txtMarks<?php echo $rowmark['effortID'] ?>" id="txtMarks<?php echo $rowmark['effortID'] ?>" value="<?php echo $rowmark['marks'] ?>" type="text" /></td>
		<td><input size="4" name="txtGrade<?php echo $rowmark['effortID'] ?>" id="txtGrade<?php echo $rowmark['effortID'] ?>" value="<?php echo $rowmark['grade'] ?>" type="text" /></td>
		
		<td><input size="4" name="txtGradePoint<?php echo $rowmark['effortID'] ?>" id="txtGradePoint<?php echo $rowmark['effortID'] ?>" value="<?php echo $rowmark['gradePoint'] ?>" type="text" /></td>
  
  			
        
        
	</tr>
<?php
}
  }
?>
  </table>
  <?php
  	$indexNo = array();
  	for ($i=0;$i<mysql_num_rows($resultall);$i++)
	{
			$indexNo[$i] = mysql_result($resultall,$i,"indexNo");
			//print $indexNo[$i] ;
	}
	$_SESSION['indexNo'] = $indexNo;
  ?>
  <br/><br/>
  <p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'examAdmin.php';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="submit" value="Submit" class="button" /></p>
  </form>

<?php 
//}else echo "<p>No exam details available.</p>";

  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Enter Results - Exam Efforts - Student Management System (External) - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='examAdmin.php'>Exam Efforts </a></li><li>Enter Results</li></ul>";
  //Apply the template
  include("master_sms_external.php");
?>