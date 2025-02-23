<?php
  //Buffer larger content areas like the main page content
  ob_start();
?>

<h1>New Lecture</h1>
<?php
	//2021-03-25 start  include('dbAccess.php');
	require_once("dbAccess.php");
	$db = new DBOperations();
    //2021-03-25 end
  	include('authcheck.inc.php');
	
	if (isset($_POST['btnSubmit']))
	{
		$subjectID = $_POST['lstSubject'];
		$venueNo = $_POST['lstVenue'];
		$epfNo = $_POST['lstLecturer'];
		$slotID = $_POST['lstTimeSlot'];
		$medium = $_POST['lstMedium'];
		$query = "INSERT INTO timetable SET subjectID='$subjectID', venueNo='$venueNo', epfNo='$epfNo', slotID='$slotID', medium='$medium'";
		//2021-03-25 start  $result = executeQuery($query);
		$result = $db->executeQuery($query);
		//2021-03-25 end
		header("location:lectureSchedule.php");
	}
?>
<form method="post" action="lectureNew.php" class="plain">
<table class="searchResults">
    <tr>
    	<td>Subject : </td><td>
        	<select name="lstSubject" id="lstSubject" size="auto">
        	<?php
			//2021.05.03
			$query = "SELECT * FROM subject";
			//2021-03-25 start  $result = executeQuery($query);
			$result = $db->executeQuery($query);
			//2021-03-25 end
			//2021-03-25 start  for ($i=0;$i<mysql_numrows($result);$i++)
			while($resultSet1 = $db->Next_Record($result))
			{
				
				$rSubjectID = $resultSet1["subjectID"];
				$rCode = $resultSet1["codeEnglish"];
				$rName = $resultSet1["nameEnglish"];
				echo "<option value=\"".$rSubjectID."\">".$rCode." - ".$rName."</option>";
              
        	}
			//2021.05.03
			?>
        	</select>
        </td>
    </tr>
    <tr>
    	<td>Venue : </td><td>
        	<select name="lstVenue" id="lstVenue" size="auto">
        	<?php
			//2021.05.03
			$query = "SELECT * FROM venue";
			//2021-03-25 start  $result = executeQuery($query);
			$result = $db->executeQuery($query);
			//2021-03-25 end
			//2021-03-25 start  for ($i=0;$i<mysql_numrows($result);$i++)
			while($resultSet1 = $db->Next_Record($result))
			{
				
				$rVenueNo = $resultSet1["venueNo"];
				$rVenue = $resultSet1["venue"];
				echo "<option value=\"".$rVenueNo."\">".$rVenue."</option>";
              
        	} 
			
			//2021.05.03
			?>
        	</select>
        </td>
    </tr>
    <tr>
    	<td>Lecturer : </td><td>
        	<select name="lstLecturer" id="lstLecturer" size="auto">
        	<?php
			//2021.05.03
			$query = "SELECT * FROM lecturer";
			//2021-03-25 start  $result = executeQuery($query);

			//2021-03-25 end
			//2021-03-25 start  for ($i=0;$i<mysql_numrows($result);$i++)

			//2021-03-25 end

			while($resultSet1 = $db->Next_Record($result))
			{
				
				$rEpfNo = $resultSet1["epfNo"];
				$rName = $resultSet1["name"];
				echo "<option value=\"".$rName."\">".$rEpfNo."</option>";
              
        	}
			//2021.05.03
			?>
        	</select>
        </td>
    </tr>
    <tr>
    	<td>Time Slot : </td><td>
        	<select name="lstTimeSlot" id="lstTimeSlot" size="auto">
        	<?php
			//2021.05.03
			$query = "SELECT * FROM timeslot";
			//2021-03-25 start  $result = executeQuery($query);
			$result = $db->executeQuery($query);
			//2021-03-25 end
			//2021-03-25 start  for ($i=0;$i<mysql_numrows($result);$i++)


			while($resultSet1 = $db->Next_Record($result))
			{
				
				$rSlotID  = $resultSet1["slotID"];
				$rDay = $resultSet1["dayOfWeekE"];
				$rSlot = $resultSet1["timeSlot"];
				echo "<option value=\"".$rSlotID."\">".$rDay." @ ".$rSlot."</option>";
              
        	}
			//2021.05.03
			?>
        	</select>
        </td>
    </tr>
    <tr>
    	<td>Medium : </td><td>
        	<select name="lstMedium">
            	<option value="English">English</option>
                <option value="Sinhala">Sinhala</option>
            </select>
       	</td>
    </tr>
</table>
<br/><br/>
<p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'lectureSchedule.php';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="submit" value="Submit" class="button" /></p>
</form>
<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
   $pagetitle = "New Lecture - Lecture Schedule - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='lectureSchedule.php'>Lecture Schedule </a></li><li>New Lecture</li></ul>";
  //Apply the template
  include("master_registration.php");
?>