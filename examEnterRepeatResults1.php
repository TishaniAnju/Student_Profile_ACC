<?php
//Buffer larger content areas like the main page content
ob_start();
error_reporting(E_ERROR | E_PARSE);

?>

<script>

	function getAverage(rowID) 
	{

		var average;
		var grade;
		var gradePoint;
		var actualGrade;
		var difference_1;
		var difference_2;
		mark1 = document.getElementById('txtMarks1'+rowID).value;
		mark2 = document.getElementById('txtMarks2'+rowID).value;
	

		if (mark1 == 'AB' && mark2 == 'AB') {

			document.getElementById('txtMarks'+rowID).value = "AB";
			document.getElementById('txtGrade'+rowID).value = '';
			document.getElementById('txtGradePoint'+rowID).value = '';
			document.getElementById('txtActualGrade'+rowID).value = '';
		} else if (mark1 == 'MD' && mark2 == 'MD') {

			document.getElementById('txtMarks'+rowID).value = "AB";
			document.getElementById('txtGrade'+rowID).value = '';
			document.getElementById('txtGradePoint'+rowID).value = '';
			document.getElementById('txtActualGrade'+rowID).value = '';
		} else {
			mark1 = eval(mark1);
			mark2 = eval(mark2);
			average = ((mark1 + mark2) / 2);
			document.getElementById('txtMarks'+rowID).value = average;
			marks = average;
			difference_1=(mark1-mark2);
				difference_2=(mark2-mark1);
			
			
			

			if (0 <= marks && marks < 24) {
				grade = 'E';
				gradePoint = '0.0';
				actualGrade = 'E';
			} else if (25 <= marks && marks < 30) {
				grade = 'D';
				gradePoint = '1.0';
				actualGrade = 'D';
			} else if (30 <= marks && marks < 35) {
				grade = 'D+';
				gradePoint = '1.3';
				actualGrade = 'D+';
			} else if (35 <= marks && marks < 40) {
				grade = 'C-';
				gradePoint = '1.7';
				actualGrade = 'C-';
			} else if (40 <= marks && marks < 45) {
				grade = 'C';
				gradePoint = '2.0';
				actualGrade = 'C';
			} else if (45 <= marks && marks < 50) {
				grade = 'C+';
				gradePoint = '2.0';
				actualGrade = 'C';
			} else if (50 <= marks && marks < 55) {
				grade = 'B-';
				gradePoint = '2.0';
				actualGrade = 'C';
			} else if (55 <= marks && marks < 60) {
				grade = 'B';
				gradePoint = '2.0';
				actualGrade = 'C';
			} else if (60 <= marks && marks < 65) {
				grade = 'B+';
				gradePoint = '2.0';
				actualGrade = 'C';
			} else if (65 <= marks && marks < 70) {
				grade = 'A-';
				gradePoint = '2.0';
				actualGrade = 'C';
			} else if (70 <= marks && marks < 85) {
				grade = 'A';
				gradePoint = '2.0';
				actualGrade = 'C';
			} else if (85 <= marks && marks <= 100) {
				grade = 'A+';
				gradePoint = '2.0';
				actualGrade = 'C';
			} else {
				grade = '';
				gradePoint = '';
				actualGrade = '';
			}


			document.getElementById('txtGrade' + rowID).value = grade;
			document.getElementById('txtGradePoint' + rowID).value = gradePoint;
			document.getElementById('txtActualGrade' + rowID).value = actualGrade;
			
			if(difference_1>10 || difference_2>10)
			{
				document.getElementById('txtMarks'+rowID).style.backgroundColor="#c2c2a3"
				document.getElementById('txtGrade'+rowID).style.backgroundColor="#c2c2a3"
				document.getElementById('txtGradePoint'+rowID).style.backgroundColor="#c2c2a3"
				document.getElementById('txtActualGrade' +rowID).style.backgroundColor="#c2c2a3"
			}
			else
			{
				document.getElementById('txtMarks'+rowID).style.backgroundColor="#ffffff"
				document.getElementById('txtGrade'+rowID).style.backgroundColor="#ffffff"
				document.getElementById('txtGradePoint'+rowID).style.backgroundColor="#ffffff"
				document.getElementById('txtActualGrade' +rowID).style.backgroundColor="#ffffff"
		}
		}

	}

</script>



<h1>Exam Enter Repeat Results</h1>
<?php
//2021-03-25 start  include('dbAccess.php');
require_once("dbAccess.php");
$db = new DBOperations();

session_start();
//	include('authcheck.inc.php');
$data=array();
$nextEffort;
if (isset($_POST['lstFaculty'])) 
{
	$faculty = $db->cleanInput($_POST['lstFaculty']);
}
else
{
	$faculty=0;
}

if (isset($_POST['subSemester'])) 
{
	$semester = $db->cleanInput($_POST['subSemester']);
}
else
{
	$semester=0;
}

if (isset($_POST['level']))
{
	$level = $db->cleanInput($_POST['level']);
}
else
{
	$level=0;
}

if (isset($_POST['lstSubject'])) 
{
	$SubjectID = $db->cleanInput($_POST['lstSubject']);
}
else
{
	$SubjectID=0;
}

if (isset($_POST['propperacyear'])) 
{
	$propperacyear = $db->cleanInput($_POST['propperacyear']);
}
else
{
	$propperacyear=0;
}

if (isset($_POST['acyear'])) 
{
	$effort = $db->cleanInput($_POST['acyear']);	
}
else
{
	$effort=0;
}

?>
<form method="post" name="form1" id="form1" action="" onsubmit="return validate_form(this);" class="plain">
	<table class="searchResults">
		<tr>
			<td height="28">Faculty : </td>
			<td><select name="lstFaculty" id="lstFaculty" onchange="form1.submit()">
					<option value="0" disabled>Select Faculty</option>	
					<option value="Buddhist">Buddhist Studies</option>
					<option value="Language">Language Studies</option>
				</select>
				<script>
					document.getElementById('lstFaculty').value = "<?php echo $faculty; ?>";
				</script>
			</td>
		</tr>

		<tr>
			<td>Level : </td>
			<td><select name="level" id="level" onchange="form1.submit()">
					<option value="0" disabled>Select Level</option>	
					<option value="I">Level One</option>
					<option value="II">Level Two</option>
					<option value="III">Level Three</option>
					<option value="IV">Level Four</option>
				</select>
				<script>
					document.getElementById('level').value = "<?php echo $level; ?>";
				</script>
			</td>
		</tr>

		<tr>
			<td>Semester : </td>
			<td><select name="subSemester" id="subSemester" onchange="form1.submit()">
					<option value="0" disabled>Select Semester</option>	
					<option value="First Semester">First Semester</option>
					<option value="Second Semester">Second Semester</option>
				</select>
				<script>
					document.getElementById('subSemester').value = "<?php echo $semester; ?>";
				</script>
			</td>
		</tr>
		
		<tr>
			<td>Subject : </td>
			<td><select name="lstSubject" id="lstSubject" style="width:auto" onchange="form1.submit()">>
					<option value="0" disabled>Select Subject</option>	
					<?php
					$query = "SELECT * FROM subject WHERE faculty='$faculty' and level='$level' and semester='$semester'";
					$result = $db->executeQuery($query);
					while ($data = $db->Next_Record($result))
					{
						$rID = $data["subjectID"];
						$rCode = $data["codeEnglish"];
						$rSubject = $data["nameEnglish"];
						echo "<option value=\"" . $rID . "\">" . $rCode . " - " . $rSubject . "</option>";
					}
					?>
				</select>
				<script>
					document.getElementById('lstSubject').value = '<?php echo $SubjectID; ?>';
				</script>
			</td>
		</tr>

		<tr>
			<td>Propper Academic Year:</td>
			<td><select name="propperacyear" id="propperacyear" onChange="form1.submit()"  class="form-control">
					<option value="0" disabled>Select Year</option>	
					<?php
					$sql = "SELECT distinct acYear FROM studentenrolment order by acYear";
					$result = $db->executeQuery($sql);
					while ($row = $db->Next_Record($result)) 
					{
						?>
						<option value="<?php echo $row['acYear'] ?>"><?php echo $row['acYear'] ?></option>
						<?php
					}
					
					?>
				</select>
				<script>
					document.getElementById('propperacyear').value = "<?php echo $propperacyear; ?>";
				</script>
			</td>
		</tr>

		<tr>
			<td>Academic Year:</td>
			<td><select name="acyear" id="acyear" onChange="form1.submit()"  class="form-control">
					<option value="0" disabled>Select Year</option>	
					<?php
					$efforts=1;
					$sql = "SELECT max(acYear) as acyear FROM studentenrolment";
					
					$result = $db->executeQuery($sql);

					$maxEffort=$propperacyear+2;
					
					while ($row = $db->Next_Record($result)) 
					{	
						for($x=$propperacyear;$x<=$maxEffort;$x++)
						{
						?>						
						<option value="<?php echo $efforts++ ?>"><?php echo $x ?></option>
						<?php
						}
					}
					?>
					</select>
					<script>
						document.getElementById('acyear').value = "<?php echo $effort; ?>";
					</script>
			</td>
		</tr>
	</table>
	<table class="searchResults">
		<tr>
			<th>Index No.</th>
			<th>Mark 1</th>
			<th>Mark 2</th>
			<th>Marks</th>
			<th>Grade</th>
			<th>Actual Grade</th>
			<th>Grade Point</th>
		</tr>

		<?php

		$queryallstudents = "SELECT * FROM subject JOIN studentenrolment ON studentenrolment.subjectID=subject.subjectID WHERE subject.subjectID='$SubjectID'";
			$resultallstudents = $db->executeQuery($queryallstudents);
			$count=0;
			//for get students  data according to the selected subject
			while ($row = $db->Next_Record($resultallstudents))

			{
				//display all the indexes relavent to the selected subject;			
				$index=$row['indexNo'];				
			
			//for display repeaters according to the selected exam effort
			$queryallrepeaters = "SELECT * FROM subject JOIN exameffort ON subject.subjectID=exameffort.subjectID WHERE subject.subjectID='$SubjectID' AND exameffort.indexNo='$index' and exameffort.acYear='$propperacyear' AND exameffort.effort='$effort' and exameffort.gradePoint<2.0 order by exameffort.indexNo ";
			
				$resultallrepeaters = $db->executeQuery($queryallrepeaters);
			
				while ($row2= $db->Next_Record($resultallrepeaters))

				{
					$indexno=$row2['indexNo'];
	//this will restrict to display student indexes who already done another effort also.
					$querydonerepeaters = "SELECT * FROM subject JOIN exameffort ON subject.subjectID=exameffort.subjectID WHERE subject.subjectID='$SubjectID' AND exameffort.indexNo='$indexno' and exameffort.acYear='$propperacyear' AND exameffort.effort>'$effort' order by exameffort.indexNo ";

	
					$resultdonerepeaters = $db->executeQuery($querydonerepeaters);
	
				//if no records about other attempt(effort) that subject, then display it.
							if($db->Row_Count($resultdonerepeaters)==0)
							{					
		?>

	<tr>
		<td><?php echo $row2['indexNo'] ?></td>
		<!-- <td><?php echo $row2['effortID'] ?></td> -->
		<!-- <td><input  size="4" name="<?php echo $row2['indexNo']; ?>" id="<?php $row2['indexNo'] ; ?>" value="<?php echo $row2['indexNo'] ?>" type="text" /></td> -->

 		<td><input  size="4" name="txtMarks1<?php echo $row2['effortID']; ?>" id="txtMarks1<?php echo $row2['effortID']  ?>" value="" type="text" /></td>
 		<td><input  size="4" name="txtMarks2<?php echo $row2['effortID'] ?>" id="txtMarks2<?php echo $row2['effortID']?>" value="" onKeyUp="getAverage(<?php echo $row2['effortID'];?>)" type="text" /></td>
 		<td><input size="4" name="txtMarks<?php echo $row2['effortID'] ?>" id="txtMarks<?php echo $row2['effortID'] ?>" value="" type="text" /></td> 		
 		<td><input size="4" name="txtGrade<?php echo $row2['effortID'] ?>" id="txtGrade<?php echo $row2['effortID'] ?>" value="" type="text" /></td>
 		<td><input size="4" name="txtActualGrade<?php echo $row2['effortID'] ?>" id="txtActualGrade<?php echo $row2['effortID'] ?>" value="" type="text" /></td>
 		<td><input size="4" name="txtGradePoint<?php echo $row2['effortID'] ?>" id="txtGradePoint<?php echo $row2['effortID'] ?>" value="" type="text" /></td>
 	</tr>
<?php
		
				if($_POST['txtGradePoint'.$row2['effortID']]!=null)
				{	
					$data[]=$_POST[$row2['indexNo']].",".$_POST['txtMarks1'.$row2['effortID']].",".$_POST['txtMarks2'.$row2['effortID']].",".$_POST['txtMarks'.$row2['effortID']].",".$_POST['txtActualGrade'.$row2['effortID']].",".$_POST['txtGradePoint'.$row2['effortID']];
				}	
			}
		}
	}		
		$_SESSION['array']=$data;
	
		?>
	</table>
	<p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'examAdmin.php';" class="button" />&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="submit" value="Submit" class="button" /></p>
</form>

<?php
if (isset($_POST['btnSubmit']))
{
	$data=$_SESSION['array'];
	$indexnumber;
	$nextEffort=++$effort;

	for($i = 0; $i < count($data); $i++)
	{
		$details=explode(",",$data[$i]);
		$newIndex=$details[0];
		$newMark1=$details[1];
		$newMark2=$details[2];
		$newMarks=$details[3];
		$newActualGrade=$details[4];
		$newGradePoint=$details[5];
	//get all the students who done next effort also
		$queryall = "SELECT * FROM subject JOIN exameffort ON subject.subjectID=exameffort.subjectID WHERE subject.subjectID='$SubjectID' AND exameffort.indexNo='$newIndex' and exameffort.acYear='$propperacyear' AND exameffort.effort='$nextEffort' and exameffort.gradePoint<2.0 order by exameffort.indexNo ";
		$resultall = $db->executeQuery($queryall);

//if student do not have marks entered, then insert those data.
		if($db->Row_Count($resultall)==0)
		{
			$queryinsert= "Insert into exameffort (indexNo,regNo,subjectID,mark1,mark2,marks,grade,gradePoint,acYear,effort)VALUES ('$newIndex','$newIndex','$SubjectID','$newMark1','$newMark2','$newMarks','$newActualGrade','$newGradePoint','$propperacyear','$nextEffort')";
			$db->executeQuery($queryinsert);	
		}
	}
	
	
	session_destroy();
}	


//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "New Effort - Exam Efforts - Student Management System - Buddhist & Pali University of Sri Lanka";
$navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='examAdmin.php'>Exam Efforts </a></li><li>New Effort</li></ul>";
//Apply the template
include("master_registration.php");
?>