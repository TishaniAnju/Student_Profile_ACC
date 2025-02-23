<?php
//Buffer larger content areas like the main page content
ob_start();
require_once("dbAccess.php");
$db = new DBOperations();

?>
<h1> Special Degree Courses Related Reports</h1>

<!-- <form method="post" onsubmit="return false;"> -->
<form method="post" onsubmit="return false;">
    <table class="searchResults">
        <tr>
            <td><a href="report_specialdegree.php">Special Degree - Student list Report</a></td>
        </tr>
        <tr>
            <td><a href="report_registeredSt_Courses.php">Certificte course & Advanced certificate course - Registered students</a></td>
        </tr>

    </table>
</form>
<?php
//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Special Degree Courses Reports - Applicants - Student Management System - Buddhisht & Pali University of Sri Lanka";
$navpath = "<ul><li><a href='home.php'>Home </a></li><li>Special Degree Courses Related Reports</ul>";
//Apply the template
include("master_registration.php");
?>