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
function getAverage()
{
	
	var average;
	
mark1 = document.examEffort.txtMarks1.value;
mark2 = document.examEffort.txtMarks2.value;
mark1=eval(mark1);
mark2=eval(mark2);
	average=((mark1+mark2)/2);
	document.getElementById('txtMarks').value=average;
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
	document.getElementById('txtGrade').value = grade;
	document.getElementById('txtgradePoint').value = gradePoint;
}



</script>

<h1>Exam Effort</h1>
<?php
	include('dbAccess.php');
  	include('authcheck.inc.php');
	
	if (isset($_POST['btnSubmit']))
	{
		$indexNo = $_POST['lstIndexNo'];
		$subjectID = $_POST['lstSubject'];
		$acYear = cleanInput($_POST['txtAcYear']);
		$medium = $_POST['lstMedium'];
		$marks1 = cleanInput($_POST['txtMarks1']);
		$marks2 = cleanInput($_POST['txtMarks2']);
		$marks = cleanInput($_POST['txtMarks']);
		$grade = cleanInput($_POST['txtGrade']);
		$gradePoint = cleanInput($_POST['txtgradePoint']);
		$effort = $_POST['lstEffort'];
		
		$query = "INSERT INTO exameffort SET indexNo='$indexNo', subjectID='$subjectID', acYear='$acYear', medium='$medium',mark1='$marks1',mark2='$marks2', marks='$marks', grade='$grade',gradePoint='$gradePoint', effort='$effort'";
		$result = executeQuery($query);
		
		header("location:examAdmin.php");
	}
?>
<form method="post" name="examEffort" action="" onsubmit="return validate_form(this);" class="plain">
<table class="searchResults">
   <tr>
    	
      <td height="28">Faculty : </td>
      <td><select name="lstFaculty">
        	<option value="Buddhist">Buddhist Studies</option>
        	<option value="Language">Language Studies</option>
        </select></td>
    </tr>
    <tr>
    	<td>Level : </td>
		<td><select name="level">
        	<option value="One">Level One</option>
        	<option value="Two">Level two</option>
			<option value="Three">Level Three</option>
        	<option value="Four">Level Four</option>
        </select></td>
    </tr>
	<tr>
    	
      <td>Semester : </td>
      <td><select name="subSemester">
        	<option value="Frist Semester">First Semester</option>
        	<option value="Second Semester">Second Semester</option>
        </select></td>
    </tr>
	<tr>
    <tr>
    	<td>Subject : </td>
        <td><select name="lstSubject" id="lstSubject" style="width:auto">
        	<?php
			if (isset($_POST['lstIndexNo'])) $indexNo = $_POST['lstIndexNo'];
			else $indexNo = mysql_result($result,0,"indexNo");
			$query = "SELECT * FROM subject WHERE subjectID IN (SELECT subjectID FROM studentenrolment WHERE indexNo='".$indexNo."')";
			$result = executeQuery($query);
			for ($i=0;$i<mysql_num_rows($result);$i++)
			{
				$rID = mysql_result($result,$i,"subjectID");
				$rCode = mysql_result($result,$i,"codeEnglish");
				$rSubject = mysql_result($result,$i,"nameEnglish");
              	echo "<option value=\"".$rID."\">".$rCode." - ".$rSubject."</option>";
        	} 
			?>
        	</select>
        </td>
    </tr>
    <tr>
    	<td>Academic Year : </td><td><input name="txtAcYear" type="text" value="" /></td>
    </tr>
    <tr>
    	<td>Medium : </td><td>
        	<select name="lstMedium" id="lstMedium" size="auto">
            	<option value="English">English</option>
                <option value="Sinhala">Sinhala</option>
            </select>
       	</td>
    </tr>
	<tr>
    	<td>First Mark : </td><td><input name="txtMarks1" id="txtMarks1"  type="text"  /></td>
    </tr>
	<tr>
    	<td>Second Mark : </td><td><input name="txtMarks2" id="txtMarks2" type="text" value=""    onKeyUp="getAverage()" /></td>
    </tr>
    <tr>
    	<td>Marks : </td><td><input name="txtMarks" id="txtMarks" type="text" value=""  readonly="readonly" /></td>
    </tr>
    <tr>
    	<td>Grade : </td><td><input name="txtGrade" id="txtGrade" type="text" value="" readonly="readonly" /></td>
    </tr>
	<tr>
    	<td>Grade Point: </td><td><input name="txtgradePoint" id="txtgradePoint" type="text" value="" readonly="readonly" /></td>
    </tr>
    <tr>
    	<td>Effort : </td><td><select name="lstEffort">
        	<option value="1">1</option>
        	<option value="2">2</option>
            <option value="3">3</option>
        </select></td>
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