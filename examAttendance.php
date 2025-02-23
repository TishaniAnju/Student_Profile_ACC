<?php
  //Buffer larger content areas like the main page content
  ob_start();
?>

<h1>Exam Attendance</h1>
<?php
	//2021.03.24 start  include('dbAccess.php');
	require_once("dbAccess.php");
	$db = new DBOperations();
	//2021.03.24 end
	include('authcheck.inc.php');
?>
<form method="get" action="rptExamAttendance.php" class="plain">
<table class="searchResults">
    <tr>
    	<td>Academic Year : </td><td><select name="lstAcYear" id="lstAcYear">
            <?php
				//2021.03.24 start  $result = executeQuery("SELECT DISTINCT acYear FROM exameffort");
				$result = $db->executeQuery("SELECT DISTINCT acYear FROM exameffort");
				//2021.03.24 end
				//2021.03.24 start  if (mysql_num_rows($result)>0)
				if ($db->Row_Count($result)>0)
				//2021.03.24 end
				{
					//2021.03.24 start  while ($row=mysql_fetch_array($result))
					while ($row=$db->Next_Record($result))
					//2021.03.24 end
					{
						echo "<option value='".$row['acYear']."'>".$row['acYear']."</option>";
					}
				}
			?>
            </select>
     	</td>
    </tr>
     <tr>
    	<td>Subject : </td><td><select name="lstSubject" id="lstSubject">
            <?php
				//2021.03.24 start  $result = executeQuery("SELECT subjectID, codeEnglish, nameEnglish FROM subject WHERE subjectID IN (SELECT DISTINCT subjectID FROM exameffort)");
				$result = $db->executeQuery("SELECT subjectID, codeEnglish, nameEnglish FROM subject WHERE subjectID IN (SELECT DISTINCT subjectID FROM exameffort)");
				//2021.03.24 end
				//2021.03.24 start  if (mysql_num_rows($result)>0)
				if ($db->Row_Count($result)>0)
				//2021.03.24 end
				{
					//2021.03.24 start  while ($row=mysql_fetch_array($result))
					while ($row=$db->Next_Record($result))
					//2021.03.24 end
					{
						echo "<option value='".$row['subjectID']."'>".$row['codeEnglish']." - ".$row['nameEnglish']."</option>";
					}
				}
			?>
            </select>
     	</td>
    </tr>
</table>
<br/><br/>
<p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'home.php';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="submit" value="Create" class="button" /></p>
</form>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Exam Attendance - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li></li><li>Exam Attendance</li></ul>";
  //Apply the template
  include("master_registration.php");
?>