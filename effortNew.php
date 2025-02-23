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
	//2021-03-25 start  include('dbAccess.php');
	require_once("dbAccess.php");
	$db = new DBOperations();
    //2021-03-25 end
  	include('authcheck.inc.php');
	
	if (isset($_POST['btnSubmit']))
	{
		$indexNo = $_POST['lstIndexNo'];
		$subjectID = $_POST['lstSubject'];
		//2021-03-25 start  $acYear = cleanInput($_POST['txtAcYear']);
		$acYear = $db->cleanInput($_POST['txtAcYear']);
		//2021-03-25 end
		$medium = $_POST['lstMedium'];
		//2021-03-25 start  $marks1 = cleanInput($_POST['txtMarks1']);
		$marks1 = $db->cleanInput($_POST['txtMarks1']);
		//2021-03-25 end
		//2021-03-25 start  $marks2 = cleanInput($_POST['txtMarks2']);
		$marks2 = $db->cleanInput($_POST['txtMarks2']);
		//2021-03-25 end
		//2021-03-25 start  $marks = cleanInput($_POST['txtMarks']);
		$marks = $db->cleanInput($_POST['txtMarks']);
		//2021-03-25 end
		//2021-03-25 start  $grade = cleanInput($_POST['txtGrade']);
		$grade = $db->cleanInput($_POST['txtGrade']);
		//2021-03-25 end
		//2021-03-25 start  $gradePoint = cleanInput($_POST['txtgradePoint']);
		$gradePoint = $db->cleanInput($_POST['txtgradePoint']);
		//2021-03-25 end
		$effort = $_POST['lstEffort'];
		
		$query = "INSERT INTO exameffort SET indexNo='$indexNo', subjectID='$subjectID', acYear='$acYear', medium='$medium', marks='$marks', grade='$grade',gradePoint='$gradePoint', effort='$effort'";
		//2021-03-25 start  $result = executeQuery($query);
		$result = $db->executeQuery($query);
		//2021-03-25 end
		
		header("location:examAdmin.php");
	}
?>
<form method="post" name="examEffort" action="" onsubmit="return validate_form(this);" class="plain">
<table class="searchResults">
    <tr>
    	<td>Index Number : </td>
        <td><select name="lstIndexNo" id="lstIndexNo" style="width:auto" onchange="this.form.submit();" >
        	<?php
			$query = "SELECT indexNo,nameEnglish FROM student WHERE indexNo IN (SELECT DISTINCT indexNo FROM studentenrolment) ORDER BY indexNo";
			//2021.03.25 start  $result = executeQuery($query);
			$result = $db->executeQuery($query);
			//2021.03.25 end
			//2021.03.25 start  for ($i=0;$i<mysql_num_rows($result);$i++)
			
			//2021.03.25 end
				
				
				
			//2021.04.30 start for ($i=0;$i<$db->Row_Count($result);$i++)	
//			{
//				$rIndexNo = mysql_result($result,$i,"indexNo");
//				$rNameEnglish = mysql_result($result,$i,"nameEnglish");
				
				while($resultSet1 = $db->Next_Record($result))
				{
				$rIndexNo = $resultSet1["indexNo"];
				$rNameEnglish = $resultSet1["nameEnglish"];
			//2021.04.30 end
				if (isset($_POST['lstIndexNo']) && $rIndexNo==$_POST['lstIndexNo'])
					echo "<option selected='selected' onmousedown=\"document.getElementById('txtName').value='(".$rNameEnglish.")'\" value=\"".$rIndexNo."\">".$rIndexNo."</option>";
				else
              		echo "<option onmousedown=\"document.getElementById('txtName').value='(".$rNameEnglish.")'\" value=\"".$rIndexNo."\">".$rIndexNo."</option>";
        	} 
			?>
        	</select>
            <input name="txtName" id="txtName" type="text" value="<?php if (isset($_POST['txtName'])) echo $_POST['txtName']; ?>" readonly="readonly" style="border:none;width:300px" />
        </td>
    </tr>
    <tr>
    	<td>Subject : </td>
        <td><select name="lstSubject" id="lstSubject" style="width:auto">
        	<?php
			if (isset($_POST['lstIndexNo'])) $indexNo = $_POST['lstIndexNo'];
			else 
			{
			
				//2021.04.30 start $indexNo = mysql_result($result,0,"indexNo");
				$result2 = $db->executeQuery($query);
				$resultSet2 = $db->Next_Record($result2);
				$indexNo = $resultSet2["indexNo"];
				//2021.04.30 end
			
			}
			$query = "SELECT * FROM subject WHERE subjectID IN (SELECT subjectID FROM studentenrolment WHERE indexNo='".$indexNo."')";
			//2021.03.25 start  $result = executeQuery($query);
			$result = $db->executeQuery($query);
			//2021.03.25 end
			//2021.03.25 start  for ($i=0;$i<mysql_num_rows($result);$i++)
			
			
			//2021.03.25 end
			
			
			//2021.04.30 start for ($i=0;$i<$db->Row_Count($result);$i++)
//			{
//				$rID = mysql_result($result,$i,"subjectID");
//				$rCode = mysql_result($result,$i,"codeEnglish");
//				$rSubject = mysql_result($result,$i,"nameEnglish");
//              	echo "<option value=\"".$rID."\">".$rCode." - ".$rSubject."</option>";
//        	} 
			while($resultSet = $db->Next_Record($result))
			{
				$rID = $resultSet["subjectID"];
				$rCode = $resultSet["codeEnglish"];
				$rSubject = $resultSet["nameEnglish"];
              	echo "<option value=\"".$rID."\">".$rCode." - ".$rSubject."</option>";
        	}
			
			//2021.04.30 end
			
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