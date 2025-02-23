<?php
ob_start();
?>

<h1>Exam Results- Repeats Student</h1>
<?php
require_once("dbAccess.php");
$db = new DBOperations();

//include('authcheck.inc.php');

if (isset($_POST['Faculty'])) {
	$faculty = $db->cleanInput($_POST['Faculty']);
}
else
{
    $faculty = 0;
}

if (isset($_POST['semester'])) {
	$semester = $db->cleanInput($_POST['semester']);
}
else
{
    $semester = 0;
}
if (isset($_POST['level'])) {
	$level = $db->cleanInput($_POST['level']);
}
else
{
    $level = 0;
}
if (isset($_POST['subject'])) {
	$SubjectID = $db->cleanInput($_POST['subject']);
}
else
{
    $SubjectID = 0;
}
if (isset($_POST['acyear'])) {
	$acyear = $db->cleanInput($_POST['acyear']);
}
else
{
    $acyear = 0;
}

?>
<form method="post" name="form1" id="form1" action="" class="plain">
	<table class="searchResults">
		<tr>
			<td height="28">Faculty : </td>
			<td><select name="Faculty" id="Faculty" onchange="form1.submit()">
            <option value="0" disabled>Select Faculty</option>	
            <?php
					$query = "SELECT DISTINCT faculty FROM subject JOIN exameffort ON subject.subjectID=exameffort.subjectID";
				
					$result = $db->executeQuery($query);
				
					while ($data = $db->Next_Record($result))
					
					{
                        ?>
                        <option value="<?php echo $data['faculty'] ?>"><?php echo $data['faculty'] ?></option>
						
                        <?php
					}
					?>
				</select>
				<script>
					document.getElementById('Faculty').value = "<?php echo $faculty; ?>";
				</script>
			</td>
		</tr>
		<tr>
			<td>Level : </td>
			<td><select name="level" id="level" onchange="form1.submit()">
            <option value="0" disabled>Select Level</option>	
            <?php
					$query = "SELECT DISTINCT level FROM subject JOIN exameffort ON subject.subjectID=exameffort.subjectID ORDER BY subject.level";
					
					$result = $db->executeQuery($query);
					
					while ($data = $db->Next_Record($result))
					
					{
                        ?>
                        <option value="<?php echo $data['level'] ?>"><?php echo $data['level'] ?></option>
						
                        <?php
					}
					?>
				</select>
				<script>
					document.getElementById('level').value = "<?php echo $level; ?>";
				</script>
			</td>
		</tr>
		<tr>
			<td>Semester : </td>
			<td><select name="semester" id="semester" onchange="form1.submit()">
            <option value="0" disabled>Select Semester</option>	
            <?php
					$query = "SELECT DISTINCT semester FROM subject JOIN exameffort ON subject.subjectID=exameffort.subjectID";
					
					$result = $db->executeQuery($query);
					
					while ($data = $db->Next_Record($result))
					
					{
                        ?>
                        <option value="<?php echo $data['semester'] ?>"><?php echo $data['semester'] ?></option>
						
                        <?php
					}
					?>
				</select>
				<script>
					document.getElementById('semester').value = "<?php echo $semester; ?>";
				</script>
			</td>
		</tr>
		<tr>
		<tr>
			<td>Subject : </td>
			<td><select name="subject" id="subject" style="width:auto" onchange="form1.submit()">
            <option value="0" disabled>Select Subject</option>	
					<?php
					$query = "SELECT * FROM subject WHERE faculty='$faculty' and level='$level' and semester='$semester'";
					
					$result = $db->executeQuery($query);
					
					while ($data = $db->Next_Record($result))
					
					{
						?>
                            <option value="<?php echo $data['subjectID'] ?>"><?php echo $data['nameEnglish'] ?></option>

                        <?php
					}
					?>
				</select>
				<script>
					document.getElementById('subject').value = '<?php echo $SubjectID; ?>';
				</script>
			</td>
		</tr>
		<tr>
			<td>Academic Year:</td>
			<td>
            <select name="acyear" id="acyear" onChange="form1.submit()"  class="form-control">
            <option value="0" disabled>Select Year</option>	
					<?php
				
					$sql = "SELECT distinct acYear FROM exameffort order by acYear";
					$result = $db->executeQuery($sql);
					while ($row = $db->Next_Record($result)) 
                    {
                        ?>
						//2021-03-25 start  while ($row = mysql_fetch_array($result))
						<option value="<?php echo $row['acYear'] ?>"><?php echo $row['acYear'] ?></option>
                        <?php
					}
					
					?>
                    </select>
					<script>
						document.getElementById('acyear').value = "<?php echo $acyear; ?>";
					</script>
				</label>
			</td>
		</tr>
		
			
	</table>
	<table class="searchResults">
		<tr>
			<th>Index No.</th>
			<th>Marks</th>
			<th>Grade</th>
		</tr>

		<?php
		
		$queryall = "Select * from exameffort JOIN subject ON exameffort.subjectID=subject.subjectID WHERE subject.faculty='$faculty' AND exameffort.subjectID='$SubjectID' AND exameffort.acYear='$acyear' AND subject.semester='$semester' AND subject.level='$level' AND exameffort.effort='1' AND exameffort.gradePoint<2.0 order by exameffort.indexNo";
   
		$resultall = $db->executeQuery($queryall);
	
		while ($row = $db->Next_Record($resultall))
		
		{
		?>
			<tr>

				<td><?php echo $row['indexNo'] ?></td>
                <td><?php echo $row['marks'] ?></td>
                <td><?php echo $row['grade'] ?></td>

				
			
			

			</tr>
		<?php

		}
        
		?>
	</table>
	</form>

    

<?php
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "New Effort - Exam Efforts - Student Management System - Buddhist & Pali University of Sri Lanka";
$navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='examAdmin.php'>Exam Efforts </a></li><li>New Effort</li></ul>";
include("master_registration.php");
?>