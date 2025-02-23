<?php
//Buffer larger content areas like the main page content
ob_start();
?>



<h1>Academic Transcript</h1>
<?php

//2021.03.24 start  include('dbAccess.php');
require_once("dbAccess.php");
$db = new DBOperations();
//2021.03.24 end
// include('authcheck.inc.php');
$entryyear = '';

if (isset($_POST['btnSubmit'])) {
	$type = $_POST['lstType'];
	$medium = $_POST['lstMedium'];
	$indexNo = $_POST['lstIndexNo'];
	$acYear = $_POST['acYear'];
	$date = $_POST['txtdate'];
	if ($medium == 'English')
		header("location:examTranscriptTestReportE.php?type=$type&indexNo=$indexNo&acYear=$acYear&date=$date&medium=$medium&lstType=$lstType");
	else if ($medium == 'Sinhala')
		header("location:examTranscriptTestReportS.php?type=$type&indexNo=$indexNo&acYear=$acYear&date&medium=$medium&lstType=$lstType");
}
if (isset($_POST['entryyear'])) {
	$entryyear = $db->cleanInput($_POST['entryyear']);
}
?>
<script>
	function getLength() {
		var len = document.getElementById("entryyear").value.length;
		//   alert(len);
		if (len >= 4) {
			document.getElementById("form1").submit();
		}
	}
</script>
<form method="post" action="" name="form1" id="form1" onsubmit="return validate_form(this);" class="plain">
	<table class="searchResults">
		<tr>
			<td>Type : </td>
			<td><select name="lstType">
					<option value="Full">Full</option>
					<option value="1">First Year Semester I</option>
					<option value="2">First Year Semester II</option>
					<option value="3">Second Year Semester I</option>
					<option value="4">Second Year Semester II</option>
					<option value="5">Third Year Semester I</option>
					<option value="6">Third Year Semester II</option>
					<option value="7">Fourth Year Semester I</option>
					<option value="8">Fourth Year Semester II</option>
				</select>
			</td>
		</tr>
		<tr>

		<tr>
			<td>Academic Year:</td>
			<td><label>

					<input type="text" name="entryyear" id="entryyear" onkeyup='getLength()' class="form-control">

					<script>
						document.getElementById('entryyear').value = "<?php echo $entryyear; ?>";
					</script>
				</label>
			</td>
		</tr>
</form>


<?php echo $entryyear; 
        ?>
        
</tr>


<tr>
	<td>Medium : </td>
	<td><select name="lstMedium">
			<option value="English">English</option>
			<option value="Sinhala">Sinhala</option>
		</select>
	</td>
</tr>
<tr>
	<td>Index No. : 
	<td>
	<?php 
if ($entryyear != '')
{


    $query ="SELECT indexNo
    FROM student 
    WHERE yearEntry=$entryyear ";


        
        $result = $db->executeQuery($query);

        if ($db->Row_Count($result)==0) {
            die("Not Indexes");
        }

        else{
            echo '<select name="lstIndexNo" id="lstIndexNo">';
            while ($row = $db->Next_Record($result)) {
            ?>

                        <option value="<?php echo $row['indexNo']  ?>"><?php echo $row['indexNo']  ?></option>      
            <?php }
            echo '</select>';
        }
        
 }       

        

?>
	</td>
	</td>
</tr>


<td>Effective Date of the Degree : </td>
<td><input name="txtdate" type="date" value="" /></td>
</tr>

</table>
<br /><br />
<p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'home.php';" class="button" />&nbsp;&nbsp;&nbsp;
	<input name="btnSubmit" type="submit" value="Generate Report" class="button" />
</p>
</form>

<?php
//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Academic Transcript - Student Management System - Buddhist & Pali University of Sri Lanka";
$navpath = "<ul><li><a href='home.php'>Home </a></li><li>Academic Transcript</li></ul>";
//Apply the template
include("master_registration.php");
?>