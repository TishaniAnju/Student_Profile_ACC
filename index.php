<?php
  //Buffer larger content areas like the main page content
  ob_start();
?>

<h1 class="pagetitle">Student Management System</h1><br/>
<?php 
	session_start();
	if (isset($_SESSION['loginMessage'])) echo "<p><font color='red>".$_SESSION['loginMessage']."</font></p>";
	unset($_SESSION['loginMessage']);
?>
<table class="panel" width="auto">
	<tr>
    	<td valign="top" width="400">
        	<h2>Selection Related</h2><br/>
            <ul>
            	<li><a href="applicant.php">Applicant</a></li>
                <li><a href="alSub.php">A/L Subject</a></li>
				<!--<li><a href="gradePoints.php">Grade Points</a></li> -->
                <li><a href="reportSelectRelated.php">Reports</a></li>
				  <li><a href="semesterRelated.php">Semester</a></li>
			
                
            </ul>
        </td>
        <td valign="top" width="400">
        	<h2>Enrolment Related</h2><br/>
            <ul>
            	<li><a href="studentAdmin.php">Student</a></li>
                <li><a href="subjectAdmin.php">Subject</a></li>
                <li><a href="reportEnrollRelated.php">Reports</a></li>
                <li><a href="specialDegreeAdmin.php">Special Degress</a></li>
            </ul>
        </td>
    </tr>
    <!--
    <tr>
        <td valign="top">
        	<h2>Lecture Related</h2><br/>
            <ul>
            	<li><a href="lectureSchedule.php">Lecture Schedule</a></li>
                <li><a href="venue.php">Venue</a></li>
                <li><a href="lecturer.php">Lecturer</a></li>
                <li><a href="timeSlot.php">Time slot</a></li>
                <li><a href="reportTimeTable.php">Reports</a></li>
            </ul>
        </td> -->
        <td valign="top">
        	<h2>Exam Related</h2><br/>
            <ul>
            	<li><a href="examAdmin.php">Exam</a></li>
				<li><a href="examComAdmin.php">Exam Compulsory</a></li>
                <!-- <li><a href="examSchedule.php">Exam Schedule</a></li>
                <li><a href="examAdmission.php">Admission Card</a></li>
                <li><a href="examAttendance.php">Attendance</a></li> -->
                <li><a href="calculateGPA.php">Calculate GPA </a></li>
				 <li><a href="examTranscript.php">Academic Transcript</a></li>
            </ul>
        </td>
    </tr>

</table>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li>Home</li></ul>";
  //Apply the template
  include("master_registration.php");
?>