<?php
  //Buffer larger content areas like the main page content
  ob_start();
?>

<h1>New Lecture</h1>
<?php
	include('dbAccess.php');
  	include('authcheck.inc.php');
	
	if (isset($_POST['btnSubmit']))
	{
		$subjectID = $_POST['lstSubject'];
		$venueNo = $_POST['lstVenue'];
		$epfNo = $_POST['lstLecturer'];
		$slotID = $_POST['lstTimeSlot'];
		$medium = $_POST['lstMedium'];
		$query = "INSERT INTO timetable SET subjectID='$subjectID', venueNo='$venueNo', epfNo='$epfNo', slotID='$slotID', medium='$medium'";
		$result = executeQuery($query);
		header("location:lectureSchedule.php");
	}
?>
<form method="post" action="lectureNew.php" class="plain">
<table class="searchResults">
    <tr>
    	<td>Subject : </td><td>
        	<select name="lstSubject" id="lstSubject" size="auto">
        	<?php
			$query = "SELECT * FROM subject";
			$result = executeQuery($query);
			for ($i=0;$i<mysql_numrows($result);$i++)
			{
				$rSubjectID = mysql_result($result,$i,"subjectID");
				$rCode = mysql_result($result,$i,"codeEnglish");
				$rName = mysql_result($result,$i,"nameEnglish");
              	echo "<option value=\"".$rSubjectID."\">".$rCode." - ".$rName."</option>";
        	} 
			?>
        	</select>
        </td>
    </tr>
    <tr>
    	<td>Venue : </td><td>
        	<select name="lstVenue" id="lstVenue" size="auto">
        	<?php
			$query = "SELECT * FROM venue";
			$result = executeQuery($query);
			for ($i=0;$i<mysql_numrows($result);$i++)
			{
				$rVenueNo = mysql_result($result,$i,"venueNo");
				$rVenue = mysql_result($result,$i,"venue");
              	echo "<option value=\"".$rVenueNo."\">".$rVenue."</option>";
        	} 
			?>
        	</select>
        </td>
    </tr>
    <tr>
    	<td>Lecturer : </td><td>
        	<select name="lstLecturer" id="lstLecturer" size="auto">
        	<?php
			$query = "SELECT * FROM lecturer";
			$result = executeQuery($query);
			for ($i=0;$i<mysql_numrows($result);$i++)
			{
				$rEpfNo = mysql_result($result,$i,"epfNo");
				$rName = mysql_result($result,$i,"name");
              	echo "<option value=\"".$rEpfNo."\">".$rName."</option>";
        	} 
			?>
        	</select>
        </td>
    </tr>
    <tr>
    	<td>Time Slot : </td><td>
        	<select name="lstTimeSlot" id="lstTimeSlot" size="auto">
        	<?php
			$query = "SELECT * FROM timeslot";
			$result = executeQuery($query);
			for ($i=0;$i<mysql_numrows($result);$i++)
			{
				$rSlotID = mysql_result($result,$i,"slotID");
				$rDay = mysql_result($result,$i,"dayOfWeekE");
				$rSlot = mysql_result($result,$i,"timeSlot");
              	echo "<option value=\"".$rSlotID."\">".$rDay." @ ".$rSlot."</option>";
        	}
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