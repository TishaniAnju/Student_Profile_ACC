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
	
mark = document.examEffort.txtMarks.value;
//alert(mark);
//mark2 = document.examEffort.txtMarks2.value;
marks=eval(mark);
//mark2=eval(mark2);
	//average=((mark1+mark2)/2);
	//document.getElementById('txtMarks').value=average;
	//marks=average;
	if (0<=marks && marks<=29.5) {grade = 'E'; gradePoint='';}
	else if (29.6<=marks && marks<=39.5) {grade = 'D'; gradePoint='';}
	else if (39.6<=marks && marks<=54.5) {grade = 'C'; gradePoint='';}
	else if (54.6<=marks && marks<=69.5) {grade = 'B'; gradePoint='';}
	else if (69.6<=marks && marks<=100){ grade = 'A'; gradePoint='';}
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
		//$marks1 = cleanInput($_POST['txtMarks1']);
		//$marks2 = cleanInput($_POST['txtMarks2']);

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
		
		$query = "INSERT INTO exameffort SET indexNo='$indexNo', subjectID='$subjectID', acYear='$acYear', medium='$medium', marks='$marks', grade='$grade', effort='$effort'";
		//2021-03-25 start  $result = executeQuery($query);
		$result = $db->executeQuery($query);
		//2021-03-25 end
		
		header("location:examComAdmin.php");
	}
?>
<form method="post" name="examEffort" action="" onsubmit="return validate_form(this);" class="plain">
<table class="searchResults">
    <tr>
    	<td>Index Number : </td>
        <td><select name="lstIndexNo" id="lstIndexNo" style="width:auto" onchange="this.form.submit();" >
        	<?php
			//2021.05.04
			$query = "SELECT indexNo,nameEnglish FROM student WHERE indexNo IN (SELECT DISTINCT indexNo FROM studentenrolment) ORDER BY indexNo";
			//2021-03-25 start  $result = executeQuery($query);
			$result = $db->executeQuery($query);
			//2021-03-25 end
			//2021-03-25 start  for ($i=0;$i<mysql_num_rows($result);$i++)
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
			//2021.05.04
			?>
        	</select>
            <input name="txtName" id="txtName" type="text" value="<?php if (isset($_POST['txtName'])) echo $_POST['txtName']; ?>" readonly="readonly" style="border:none;width:300px" />
        </td>
    </tr>
    <tr>
    	<td>Subject : </td>
        <td><select name="lstSubject" id="lstSubject" style="width:auto">
        	<?php
			//2021.05.04
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
			
			$result = $db->executeQuery($query);

			while($resultSet = $db->Next_Record($result))
			{
				$rID = $resultSet["subjectID"];
				$rCode = $resultSet["codeEnglish"];
				$rSubject = $resultSet["nameEnglish"];
              	echo "<option value=\"".$rID."\">".$rCode." - ".$rSubject."</option>";
        	}
			
			//2021.05.04
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
	<!--<tr>
    	<td>First Mark : </td><td><input name="txtMarks1" id="txtMarks1"  type="text"  /></td>
    </tr>
	<tr>
    	<td>Second Mark : </td><td><input name="txtMarks2" id="txtMarks2" type="text" value=""    onKeyUp="getAverage()" /></td>
    </tr>-->
    <tr>
    	<td>Marks : </td><td><input name="txtMarks" id="txtMarks" type="text" value=""   onKeyUp="getAverage()"  /></td>
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