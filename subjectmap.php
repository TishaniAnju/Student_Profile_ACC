<?php
  //Buffer larger content areas like the main page content
  ob_start();
?>

<script>
function validate_form(thisform)
{
	with (thisform)
	  {
		if (!validate_required(txtAcYear))
		{alert("One or more mandatory fields are kept blank.");return false;}
	  }
}
function getAverage(row)
{

	
	var average;
	var grade;
	var gradePoint
mark1=document.getElementById('txtMarks1'+row).value;
mark2=document.getElementById('txtMarks2'+row).value;





if(mark1=='AB' && mark2=='AB' ){
	
	document.getElementById('txtMarks'+row).value="AB"
	document.getElementById('txtGrade'+row).value = '';
	document.getElementById('txtGradePoint'+row).value = '';
		}
else if(mark1=='MD' && mark2=='MD'){
	
	document.getElementById('txtMarks'+row).value="AB"
	document.getElementById('txtGrade'+row).value = '';
	document.getElementById('txtGradePoint'+row).value = '';
		}
else {
mark1=eval(mark1);
mark2=eval(mark2);
	average=((mark1+mark2)/2);
	document.getElementById('txtMarks'+row).value=average;
	marks=average;
	
if (0<=marks && marks<24) {grade = 'E'; gradePoint='0.0';}
	else if (25<=marks && marks<30) {grade = 'D'; gradePoint='1.0';}
	else if (30<=marks && marks<35) {grade = 'D+'; gradePoint='1.3';}
	else if (35<=marks && marks<40) {grade = 'C-'; gradePoint='1.7';}
	else if (40<=marks && marks<45){ grade = 'C'; gradePoint='2.0';}
	else if (45<=marks && marks<50){ grade = 'C+'; gradePoint='2.3';}
	else if (50<=marks && marks<55){ grade = 'B-'; gradePoint='2.7';}
	else if (55<=marks && marks<60){ grade = 'B'; gradePoint='3.0';}
	else if (60<=marks && marks<65){ grade = 'B+'; gradePoint='3.3';}
	else if (65<=marks && marks<70){ grade = 'A-'; gradePoint='3.7';}
	else if (70<=marks && marks<85){ grade = 'A'; gradePoint='4.0';}
	else if (85<=marks && marks<=100){ grade = 'A+'; gradePoint='4.0';}
	else {grade = ''; gradePoint='';}
	

	document.getElementById('txtGrade'+row).value = grade;
	document.getElementById('txtGradePoint'+row).value = gradePoint;
}
}


</script>
<script language="javascript">
 	function MsgOkCancel()
	{
		var message = "Please confirm to DELETE this subject...";
		var return_value = confirm(message);
		return return_value;
	}
 </script>	

<h1>Subject Mapping</h1>
<?php
	//2021-03-25 start  include('dbAccess.php');
	require_once("dbAccess.php");
	$db = new DBOperations();

    //2021-03-25 end
  //	include('authcheck.inc.php');
	
	//====================================
	if (isset($_POST['lstFaculty']))
	{
		//$faculty=$_POST['lstFaculty'];
		$faculty = $db->cleanInput($_POST['lstFaculty']);
	}
	
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
if (isset($_POST['2ndSubject']))
	
	{
	$SubjectIDnew = $db->cleanInput($_POST['2ndSubject']);
		//$SubjectID=$_POST['lstSubject'];
	}
	if (isset($_POST['acyear']))
	{
	$acyear = $db->cleanInput($_POST['acyear']);
		//$acyear=$_POST['acyear'];
	}
	if (isset($_POST['lstMedium']))
	{
	$medium = $db->cleanInput($_POST['lstMedium']);
		//$medium=$_POST['lstMedium'];
	}
	if (isset($_POST['lstEffort']))
	{
	$effort = $db->cleanInput($_POST['lstEffort']);
		//$effort=$_POST['lstEffort'];
	}
	//====================================

if (isset($_GET['cmd']) && $_GET['cmd']=="delete")
  {
	//2021-03-23 start $subjectID = cleanInput($_GET['subjectID']);
	$subID = $db->cleanInput($_GET['subjectID']);
	//2021-03-23 end  
	  
	$delQuery = "DELETE FROM sub_position WHERE subId='$subID'";
	//2021-03-23 start $result = executeQuery($delQuery);
	$result = $db->executeQuery($delQuery);
	header("location:subjectAdmin.php");
	//2021-03-23 end 
	  
	  
  }

	
	if (isset($_POST['btnSubmit']))
	{
	
	if (isset($_POST['lstSubject']))
	
	{
	$SubjectID = $db->cleanInput($_POST['lstSubject']);
		//$SubjectID=$_POST['lstSubject'];
	}
	if (isset($_POST['lstEffort']))
	{
	$effort = $db->cleanInput($_POST['lstEffort']);
	//print $effort;
		//$effort=$_POST['lstEffort'];
	}
	//2021-03-25 start  $result = executeQuery("Insert into exameffort (indexNo,subjectID,mark1,mark2,marks,grade,gradePoint,acYear,effort,medium)VALUES ('$indexNovalue','$SubjectID','$mark1','$mark2','$marks','$grade','$gradepoint','$acyear','$effort','$medium')");
			$result = $db->executeQuery("Insert into subject_map (subjectID,mapSubjectID
)VALUES ('$SubjectID','$SubjectIDnew')");
		print ("Insert into subject_map (subjectID,mapSubjectID
)VALUES ('$SubjectID','$SubjectIDnew')");
		print 'kkk';
			
			//print "Insert into sub_position (subId,positionId)VALUES ('$SubjectID','$effort')";
			
			//2021-03-25 end

		
		header("location:subjectmap.php");
	}
?>
<form method="post" name="form1" id="form1" action="" onsubmit="return validate_form(this);" class="plain">
<table class="searchResults">
   <tr>
    	
      <td height="28">Faculty : </td>
      <td><select name="lstFaculty" id="lstFaculty" onchange="document.form1.submit()">
        	<option value="Buddhist">Buddhist Studies</option>
        	<option value="Language">Language Studies</option>
        </select>
		<script>
		document.getElementById('lstFaculty').value = "<?php echo $faculty;?>";
		</script>
		</td>
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
    <tr>
    	<td>Subject : </td>
        <td><select name="lstSubject" id="lstSubject" style="width:auto" onchange="document.form1.submit()">
        	<?php
			
			$query = "SELECT * FROM subject WHERE faculty='$faculty' and level='$level' and semester='$semester'";
			//print $query;
			
			$result = $db->executeQuery($query);
			
			while($resultSet = $db->Next_Record($result))
			{
				$rID = $resultSet["subjectID"];
				$rCode = $resultSet["codeEnglish"];
				$rSubject = $resultSet["nameEnglish"];
              	echo "<option value=\"".$rID."\">".$rCode." - ".$rSubject."</option>";
        	}
			
			?>
        	</select>
			<script>
			document.getElementById('lstSubject').value = "<?php echo $SubjectID;?>";
			</script>
        </td>
    </tr>
	
     <tr>
    	<td>Mapping Subject : </td>
        <td><select name="2ndSubject" id="2ndSubject" style="width:auto" ">
        	<?php
			if($semester=='First Semester'){
				$semesternew='Second Semester';
				$levelnew=$level;
				
			}
			else{
				$semesternew='First Semester';
				
				if($level=='I'){
				$levelnew='II';
			}
			else if($level=='II'){
				$levelnew='III';
			}
			}
			
			
			
			$query = "SELECT * FROM subject WHERE faculty='$faculty' and level='$levelnew' and semester='$semesternew'";
			//print $query;
			
			$result = $db->executeQuery($query);
			
			while($resultSet = $db->Next_Record($result))
			{
				$rID = $resultSet["subjectID"];
				$rCode = $resultSet["codeEnglish"];
				$rSubject = $resultSet["nameEnglish"];
              	echo "<option value=\"".$rID."\">".$rCode." - ".$rSubject."</option>";
        	}
			
			?>
        	</select>
			<script>
			document.getElementById('2ndSubject').value = "<?php echo $SubjectIDnew;?>";
			</script>
        </td>
    </tr>	
				<tr>
	<table class="searchResults">
	<tr>
    	<th>Code</th><th>Name</th><th>Mapping Subject Code</th><th>Mapping Subject Code</th><th colspan="1"></th>
    </tr>
    
<?php
		//print $effort;
		//print "SELECT * FROM subject,sub_position WHERE subject.faculty='$faculty' and subject.level='$level' and subject.semester='$semester' and subject.subjectID=sub_position.subId and sub_position.positionId='$effort'";
		//$queryallsub = $db->executeQuery("SELECT * FROM subject,subject_map WHERE subject.faculty='$faculty' and subject.level='$level' and subject.semester='$semester' and subject.subjectID=subject_map.subjectID ");
		$queryallsub = $db->executeQuery("SELECT * FROM subject,subject_map WHERE subject.subjectID=subject_map.subjectID ");
		//$queryallsub2 = $db->executeQuery("SELECT * FROM subject,sub_position WHERE subject.faculty='$faculty' and subject.level='$level' and subject.semester='$semester' and subject.subjectID=sub_position.subId and sub_position.positionId='$effort'");
  //2021-03-23 start while ($row = mysql_fetch_array($pageResult))
  while ($rowallsub = $db->Next_Record($queryallsub))
  //2021-03-23 end  
  {
	  $rrr=$rowallsub['mapSubjectID'];
	 // print $rrr;
	 $queryallsub2 = $db->executeQuery("SELECT * FROM subject WHERE subjectID='$rrr' ");
	  while ($rowallsub2 = $db->Next_Record($queryallsub2))
  //2021-03-23 end  
  {
		$mapsubcode=$rowallsub2['codeEnglish'];
		$mapsubname=$rowallsub2['nameEnglish'];
	  }

?>
	<tr>
        <td><?php echo $rowallsub['codeEnglish'] ?></td>
		<td><?php echo $rowallsub['nameEnglish'] ?></td>
        
		<td><?php echo $mapsubcode ?></td>
			<td><?php echo $mapsubname ?></td>
        
        <td><input name="btnDelete" type="button" value="Remove" class="button" onclick="if (MsgOkCancel()) document.location.href ='subpositionnew.php?cmd=delete&subjectID=<?php echo $rowallsub['subjectID'] ?>'" /></td>
	
	</tr>
<?php
  }
?>
  </table>
	
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