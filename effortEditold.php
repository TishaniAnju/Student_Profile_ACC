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

function getGrade(marks)
{
	var grade;
	if (0<=marks && marks<=29) grade = 'E';
	else if (30<=marks && marks<=39) grade = 'D';
	else if (40<=marks && marks<=54) grade = 'C';
	else if (55<=marks && marks<=69) grade = 'B';
	else if (70<=marks && marks<=100) grade = 'A';
	else grade = '';
	document.getElementById('txtGrade').value = grade;
}
</script>

<h1>Effort Edit</h1>
<?php
	include('dbAccess.php');
  	include('authcheck.inc.php');

	if (isset($_POST['btnSubmit']))
	{
		$effortID = cleanInput($_GET['effortID']);
		$indexNo = $_POST['lstIndexNo'];
		$subjectID = $_POST['lstSubject'];
		$acYear = cleanInput($_POST['txtAcYear']);
		$medium = $_POST['lstMedium'];
		$marks = cleanInput($_POST['txtMarks']);
		$grade = cleanInput($_POST['txtGrade']);
		$effort = $_POST['lstEffort'];
		
		$query = "UPDATE exameffort SET indexNo='$indexNo', subjectID='$subjectID', acYear='$acYear', medium='$medium', marks='$marks', grade='$grade', effort='$effort' WHERE effortID='$effortID'";
		$result = executeQuery($query);
		
		header("location:examAdmin.php");
	}
	
	$effortID = cleanInput($_GET['effortID']);
	$query = "SELECT * FROM exameffort WHERE effortID='$effortID'";
	$result = executeQuery($query);
	
	$row = mysql_fetch_array($result);
	if (mysql_num_rows($result)>0)
	{
?>
<form method="post" action="effortEdit.php?effortID=<?php echo $effortID ?>" onsubmit="return validate_form(this);" class="plain">
<table class="searchResults">
    <tr>
    	<td>Index Number : </td>
        <td><select name="lstIndexNo" id="lstIndexNo" style="width:auto" >
        	<?php
			$query = "SELECT indexNo,nameEnglish FROM student WHERE indexNo IN (SELECT DISTINCT indexNo FROM studentenrolment)";
			$result = executeQuery($query);
			for ($i=0;$i<mysql_num_rows($result);$i++)
			{
				$rIndexNo = mysql_result($result,$i,"indexNo");
				$rNameEnglish = mysql_result($result,$i,"nameEnglish");
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
			$result = executeQuery($query);
			for ($i=0;$i<mysql_num_rows($result);$i++)
			{
				$rID = mysql_result($result,$i,"subjectID");
				$rCode = mysql_result($result,$i,"codeEnglish");
				$rSubject = mysql_result($result,$i,"nameEnglish");
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
    	<td>Marks : </td><td><input name="txtMarks" type="text" value="<?php echo $row['marks']; ?>" onkeyup="getGrade(this.value)" /></td>
    </tr>
    <tr>
    	<td>Grade : </td><td><input name="txtGrade" id="txtGrade" type="text" value="<?php echo $row['grade']; ?>" readonly="readonly" /></td>
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