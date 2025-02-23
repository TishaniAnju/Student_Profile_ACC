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
	
mark1 = document.examEffortedit.txtMarks1.value;
mark2 = document.examEffortedit.txtMarks2.value;
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

<h1>Effort Edit</h1>
<?php
	include('dbAccess.php');
	$db = new DBOperations();
  	//include('authcheck.inc.php');

	  $effortID = $db->cleanInput($_GET['effortID']);

	if (isset($_POST['btnSubmit']))
	{
		
		$indexNo = $_POST['lstIndexNo'];
		$subjectID = $_POST['lstSubject'];
		$acYear = $db->cleanInput($_POST['txtAcYear']);
		$medium = $_POST['lstMedium'];
		$marks1 = $db->cleanInput($_POST['txtMarks1']);
		$marks2 = $db->cleanInput($_POST['txtMarks2']);
		$marks = $db->cleanInput($_POST['txtMarks']);
		$grade = $db->cleanInput($_POST['txtGrade']);
		$gradePoint = $db->cleanInput($_POST['txtgradePoint']);
	
		$effort = $_POST['lstEffort'];
		
		$query = "UPDATE exameffort SET indexNo='$indexNo', subjectID='$subjectID', acYear='$acYear', medium='$medium',marks='$marks', grade='$grade', gradePoint='$gradePoint',effort='$effort' WHERE effortID='$effortID'";
		
		$result = $db->executeQuery($query);
		
		header("location:examAdmin.php");
	}
	
	//$effortID = $db->cleanInput($_GET['effortID']);
	$query = "SELECT * FROM exameffort WHERE effortID='$effortID'";
	$result = $db->executeQuery($query);
	
	//$row=$db->Next_Record($result);
	//if ($db->Row_Count($result)>0)
	while ($row = $db->Next_Record($result))
	{
?>
<form method="post" name="examEffortedit" action="effortEdit.php?effortID=<?php echo $effortID ?>" onsubmit="return validate_form(this);" class="plain">
<table class="searchResults">
    <tr>
    	<td>Index Number : </td>
        <td><select name="lstIndexNo" id="lstIndexNo" style="width:auto" >
        	<?php
			$query = "SELECT indexNo,nameEnglish FROM student WHERE indexNo IN (SELECT DISTINCT indexNo FROM studentenrolment)";
			$result = $db->executeQuery($query);
			//for ($i=0;$i<mysql_num_rows($result);$i++)
			while($resultSet = $db->Next_Record($result))
			{
				$rIndexNo = $resultSet["indexNo"];
				$rNameEnglish = $resultSet["nameEnglish"];
				if ($rIndexNo==$row['indexNo'])
				{
					echo "<option selected='selected' onmousedown=\"document.getElementById('txtName').value='(".$rNameEnglish.")'\" value=\"".$rIndexNo."\">".$rIndexNo."</option>";
					$selectedPerson = $rNameEnglish;
				}
				else
              		echo "<option onmousedown=\"document.getElementById('txtName').value='(".$rNameEnglish.")'\" value=\"".$rIndexNo."\">".$rIndexNo."</option>";
        	} 
			?>
        	</select>
            <input name="txtName" id="txtName" type="text" value="<?php echo "(".$selectedPerson.")" ?>" readonly="readonly" style="border:none;width:300px" />
        </td>
    </tr>
    <tr>
    	<td>Subject : </td>
        <td><select name="lstSubject" id="lstSubject" style="width:auto">
        	<?php
			$query = "SELECT * FROM subject WHERE subjectID IN (SELECT subjectID FROM studentenrolment WHERE indexNo='".$row['indexNo']."')";
			$result = $db->executeQuery($query);
			while($resultSet = $db->Next_Record($result))
			{
				$rID = $resultSet["subjectID"];
				$rCode = $resultSet["codeEnglish"];
				$rSubject = $resultSet["nameEnglish"];
				if ($rID==$row['subjectID'])
					echo "<option selected='selected' value=\"".$rID."\">".$rCode." - ".$rSubject."</option>";
				else
              		echo "<option value=\"".$rID."\">".$rCode." - ".$rSubject."</option>";
        	} 
			?>
        	</select>
        </td>
    </tr>
    <tr>
    	<td>Academic Year : </td><td><input name="txtAcYear" type="text" value="<?php echo $row['acYear']; ?>" /></td>
    </tr>
    <tr>
    	<td>Medium : </td><td>
        	<select name="lstMedium" id="lstMedium" size="auto">
            	<option <?php if ($row['medium']=='English') echo "selected='selected'"; ?> value="English">English</option>
                <option <?php if ($row['medium']=='Sinhala') echo "selected='selected'"; ?> value="Sinhala">Sinhala</option>
            </select>
       	</td>
    </tr>
    <tr>
    	<td>First Mark : </td><td><input name="txtMarks1" id="txtMarks1"  type="text" value="<?php echo $row['mark1']; ?>" /></td>
    </tr>
	<tr>
    	<td>Second Mark : </td><td><input name="txtMarks2" id="txtMarks2" type="text" value="<?php echo $row['mark2']; ?>"  onKeyUp="getAverage()" /></td>
    </tr>
    <tr>
    	<td>Marks : </td><td><input name="txtMarks" id="txtMarks" type="text" value="<?php echo $row['marks']; ?>"  readonly="readonly" /></td>
    </tr>
    <tr>
    	<td>Grade : </td><td><input name="txtGrade" id="txtGrade" type="text" value="<?php echo $row['grade']; ?>" readonly="readonly" /></td>
    </tr>
	<tr>
    	<td>Grade Point: </td><td><input name="txtgradePoint" id="txtgradePoint" type="text" value="<?php echo $row['gradePoint']; ?>" readonly="readonly" /></td>
    </tr>
    <tr>
    	<td>Effort : </td><td><select name="lstEffort">
        	<option <?php if ($row['effort']=='1') echo "selected='selected'"; ?> value="1">1</option>
        	<option <?php if ($row['effort']=='2') echo "selected='selected'"; ?> value="2">2</option>
            <option <?php if ($row['effort']=='3') echo "selected='selected'"; ?> value="3">3</option>
        </select></td>
    </tr>
</table>
<br/><br/>
<p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'examAdmin.php';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="submit" value="Submit" class="button" /></p>
</form>

<?php
   }
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Edit Efforts- Exam Efforts - Registration - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='examAdmin.php'>Exam Efforts </a></li><li>Edit Effort</li></ul>";
  //Apply the template
  include("master_registration.php");
?>