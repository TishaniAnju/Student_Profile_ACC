<?php
ob_start();
?>

<h1>Student Medium Update</h1>
<?php
require_once("dbAccess.php");
$db = new DBOperations();

include('authcheck.inc.php');

if (isset($_POST['acYear'])) {
	$acYear = $db->cleanInput($_POST['acYear']);	
}

if (isset($_POST['indexNo'])) {
	$indexNo = $db->cleanInput($_POST['indexNo']);
}

if (isset($_POST['level'])) {
	$level = $db->cleanInput($_POST['level']);
}

if (isset($_POST['semester'])) {
	$semester = $db->cleanInput($_POST['semester']);
}

if (isset($_POST['medium'])) {
	$medium = $db->cleanInput($_POST['medium']);
}

if (isset($_POST['btnSubmit']))
{  
	date_default_timezone_set('Asia/Colombo');
	$currentDate =date('Y-m-d H:i:s');

	$query = "SELECT * FROM semester_register WHERE indexNo='$indexNo' AND level='$level' AND semester='$semester'";
		
$result = $db->executeQuery($query);

		if ($db->Row_Count($result)>0)		
		{	
			$queryUpdate = "UPDATE semester_register set acYear='$acYear',indexNo='$indexNo',level='$level',semester='$semester',medium='$medium',date='$currentDate' WHERE indexNo='$indexNo'";
			$executeQuery = $db->executeQuery($queryUpdate);
		}
		else		
		{
			$queryInsert = "INSERT INTO semester_register set acYear='$acYear',indexNo='$indexNo',level='$level',semester='$semester',medium='$medium',date='$currentDate'";
			$executeQuery = $db->executeQuery($queryInsert);
		}
}

?>
<form method="post" name="form1" id="form1" action="" class="plain">
	<table class="searchResults">
		<tr>
			<td height="28">Academic Year : </td>
			<td><select name="acYear" id="acYear" onchange="form1.submit()" required>
            <?php
					$query = "SELECT DISTINCT acYear FROM studentenrolment ORDER BY acYear";
				
					$result = $db->executeQuery($query);
				
					while ($data = $db->Next_Record($result))
					
					{
                        ?>
                        <option value="<?php echo $data['acYear'] ?>"><?php echo $data['acYear'] ?></option>
						
                        <?php
					}
					?>
				</select>
				<script>
					document.getElementById('acYear').value = "<?php echo $acYear; ?>";
				</script>
			</td>
		</tr>
		<tr>
			<td>Index No : </td>
			<td><select name="indexNo" id="indexNo" onchange="form1.submit()" required>
            <?php
					$query = "SELECT DISTINCT indexNo FROM studentenrolment WHERE acYear='$acYear' ORDER BY indexNo";
					
					$result = $db->executeQuery($query);
					
					while ($data = $db->Next_Record($result))
					
					{
                        ?>
                        <option value="<?php echo $data['indexNo'] ?>"><?php echo $data['indexNo'] ?></option>
						
                        <?php
					}
					?>
				</select>
				<script>
					document.getElementById('indexNo').value = "<?php echo $indexNo; ?>";
				</script>
			</td>
		</tr>
		<tr>
			<td>Level : </td>
			<td><select name="level" id="level" onchange="form1.submit()" required>
				<option value="I">I</option>
				<option value="II">II</option>
				<option value="III">III</option>
				<option value="IV">IV</option>
				</select>
				<script>
					document.getElementById('level').value = "<?php echo $level; ?>";
				</script>
			</td>
		</tr>
		<tr>
			<td>Semester : </td>
			<td><select name="semester" id="semester" onchange="form1.submit()" required>
				<option value="First Semester">First Semester</option>
				<option value="Second Semester" >Second Semester</option>
				</select>
				<script>
					document.getElementById('semester').value = "<?php echo $semester; ?>";
				</script>
			</td>
		</tr>
		<tr>
		<tr>
			<td>Medium : </td>
			<td><select name="medium" id="medium" style="width:auto" onchange="form1.submit()" required>
				<option value="Sinhala">Sinhala</option>
				<option value="English">English</option>
				</select>
				<script>
					document.getElementById('medium').value = "<?php echo $medium; ?>";
				</script>
			</td>
		</tr>
		<tr>
			<td>
			<input name="btnSubmit" type="submit" value="Submit" class="button"/>
			</td>
		</tr>		
	</table>
	<br/><br/>


	
	</form>

    

<?php
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Semester Register - Student Management System - Buddhist & Pali University of Sri Lanka";
$navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='examAdmin.php'>Semester Register </a></li><li>New Effort</li></ul>";
include("master_registration.php");
?>