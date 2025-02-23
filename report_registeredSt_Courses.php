<?php
ob_start();
?>

<h1> Report of Certificte course & Advanced certificate course - Registered students.</h1>

<?php
require_once("dbAccess.php");
$db = new DBOperations();
//include("authcheck.inc.php");

if (isset($_POST['btnSubmit'])) {
    // Handle form submission
    if (empty($_POST['level'])) {
        echo "<script>alert('Level is not selected');</script>";
    } else {
        $level = $_POST['level'];
        $sem = $_POST['semester'];
        $acYear = $_POST['acyear'];
        header("Location: rpt_registeredSt_courses.php?level=$level&semester=$sem&acyear=$acYear");
        exit();
    }
}
if (isset($_POST['btnSubmit1'])) {
    if (empty($_POST['level'])) {
        echo "<script>alert('Level is not selected');</script>";
    } else {
        // Handle form submission
        $level = $_POST['level'];
        $sem = $_POST['semester'];
        $acYear = $_POST['acyear'];
        header("Location: rpt_registeredSt_coursesExcel.php?level=$level&semester=$sem&acyear=$acYear");
        exit();
    }
}
?>

<form method="post" action="" class="plain">
    <table class="searchResults">
        <tr>
            <td>Level: </td>
            <td>
                <select name="level" id="level" size="auto">
                    <option value="0">Not selected</option>
                    <option value="I">I - First year</option>
                    <option value="II">II - Second year</option>
                    <option value="III">III - Third year</option>
                    <option value="IV">IV - Fourth year</option>
                    
                    <?php
                    // $result = $db->executeQuery("SELECT DISTINCT st_level FROM courseenrolment");

                    // while ($resultSet = $db->Next_Record($result)) {
                    //     $level = $resultSet["st_level"];
                    //     if ($level == 'I') {
                    //         $L = "First year";
                    //     } else if ($level == 'II') {
                    //         $L = "Second year";
                    //     } else if ($level == 'III') {
                    //         $L = "Third year";
                    //     } else if ($level == 'IV') {
                    //         $L = "Fourth year";
                    //     }
                    //     echo "<option value=\"$level\">$level - $L</option>";
                    // }

                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Semester : </td>
            <td>
                <select name="semester" id="semester" size="auto">
                    <option value="all">All</option>
                    <?php
                    $result = $db->executeQuery("SELECT DISTINCT Semester FROM courseenrolment");
                    while ($resultSet = $db->Next_Record($result)) {
                        $sem = $resultSet["Semester"];
                        echo "<option value=\"$sem\">$sem</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Acadamic Year : </td>
            <td>
                <select name="acyear" id="acyear" size="auto">
                    <option value="all">All</option>
                    <?php
                    $result = $db->executeQuery("SELECT DISTINCT yearEntry FROM student");
                    while ($resultSet = $db->Next_Record($result)) {
                        $entryYear = $resultSet["yearEntry"];
                        echo "<option value=\"$entryYear\">$entryYear</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>
    <br /><br />
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="btnSubmit" type="submit" value="Report" class="button">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    <input name="btnSubmit1" type="submit" value="Report-Excel(English)" class="button">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

</form>

<?php
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Special Degree Report - Student Management System - Buddhist & Pali University of Sri Lanka";
$navpath = "<ul><li><a href='home.php'>Home </a></li><li>Certificte course & Advanced certificate course - Registered students Report</ul>";
include("master_registration.php");
?>