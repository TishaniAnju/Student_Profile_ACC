<?php
//Buffer larger content areas like the main page content
ob_start();
?>
<script>
    // if you want delete
    function MsgOkCancel() {
        var message = "Please confirm to DELETE this entry...";
        var return_value = confirm(message);
        return return_value;

    }
</script>
<?php

require_once("dbAccess.php");
$db = new DBOperations();

$course = $_GET['course_code'];

if (isset($_GET['cmd']) && $_GET['cmd'] == "delete") {
    $course = $_GET['course_code'];

    $delQuery1 = "DELETE FROM `certificate_course` WHERE course_code='$course'";
    $delExec = $db->executeQuery($delQuery1);
}


// if (isset($_GET['search'])) {
//     $rows = $db->singalCoursedata($_GET['search']);
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <h1> Certificate Courses</h1>


    <form method="post" class="plain" form name="certificate_course">
        <table class="panel" style="margin-left:8px" width="260%">
            <tr>
                <td><input name="btnAddC" type="button" value="Add" onclick="document.location.href = 'add_certificateCourse.php';" class="button" />
                <td>
                <td align="left">
                    <font face="Verdana, Arial, Helvetica, sans-serif" size="2">Course Code :-</font>
                    <select name="lstCCode" id="lstCCode" onchange="this.form.submit();">
                        <option value="0">- Not Selected - </option>
                        <?php
                        $queryCC = "SELECT course_code FROM certificate_course";
                        $resultCC = $db->executeQuery($queryCC);
                        while ($code = $db->Next_Record($resultCC)) {
                            // Check if the posted value or session matches the course_code and set it as selected
                            if (isset($_POST['lstCCode']) && $_POST['lstCCode'] == $code['course_code']) {
                                echo "<option selected='selected' value='" . $code['course_code'] . "'>" . $code['course_code'] . "</option>";
                            } else if (isset($_SESSION['course_code']) && $_SESSION['course_code'] == $code['course_code']) {
                                echo "<option selected='selected' value='" . $code['course_code'] . "'>" . $code['course_code'] . "</option>";
                            } else {
                                echo "<option value='" . $code['course_code'] . "'>" . $code['course_code'] . "</option>";
                            }
                        }

                        ?>
                    </select>
                    &nbsp;
                    <input type="button" name="btnreset" id="btnreset" value="Reset Select" onclick="document.location.href = 'certificate_course.php';">
                <td>

                </td>
            </tr>
        </table>
        <br>
        <?php
        //Show Courses
        ?>
        <table class="searchResults" width="260%">
            <!-- heading in table -->
            <tr>
                <th rowspan="2">Course Code</th>
                <th rowspan="2">Course Name</th>
                <th rowspan="2">Duration</th>
                <th rowspan="2">No. of Units</th>
                <th colspan="4">Applicant's Year</th> <!-- Total columns for 4 years -->
                <th rowspan="2">Certificate Exam Quli.</th>
                <th colspan="3" rowspan="2"></th>
            </tr>
            <tr>
                <th>1st Year</th>
                <th>2nd Year</th>
                <th>3rd Year</th>
                <th>4th Year</th>
            </tr>
            <!-- for catch all data in that table -->
            <?php

            if (isset($_POST['lstCCode'])) {
                $cc = $_POST['lstCCode'];
                $selectquery = "SELECT `course_code`,`coursenameE`, `duration`, `course_units`, `1styear`,
                        `2ndyear`, `3rdyear`, `4thyear`, `passed_certificate` FROM `certificate_course` where course_code= '$cc';";
            } else {

                $selectquery = "SELECT `course_code`,`coursenameE`, `duration`, `course_units`, `1styear`,
                        `2ndyear`, `3rdyear`, `4thyear`, `passed_certificate` FROM `certificate_course` ;";
            }
            $resultselect = $db->executeQuery($selectquery);
            if ($db->Row_Count($resultselect) > 0) {
                while ($rec = $db->Next_Record($resultselect)) {
                    if ($rec['passed_certificate'] == 'y') {
                        $show = 'Want';
                    } else if ($rec['passed_certificate'] == 'n') {
                        $show = 'Do not Want';
                    } ?>
                    <tr>
                        <td><?php echo $rec['course_code'] ?></td>
                        <td><?php echo $rec['coursenameE'] ?></td>
                        <td><?php echo $rec['duration'] ?></td>
                        <td><?php echo $rec['course_units'] ?></td>
                        <td><?php echo $rec['1styear'] ?></td>
                        <td><?php echo $rec['2ndyear'] ?></td>
                        <td><?php echo $rec['3rdyear'] ?></td>
                        <td><?php echo $rec['4thyear'] ?></td>
                        <td><?php echo $show ?></td>

                        <!-- buttons in the fetch data -->
                        <td><input name="btnDetailsC" type="button" value="Details" class="button" 
                        onclick="document.location.href ='courseDetails.php?course_code=<?php echo $rec['course_code'] ?>'" /></td>
                        <td><input name="btnUpdate" type="button" value="Update" 
                        onclick="document.location.href ='edit_Course.php?course_code=<?php echo $rec['course_code'] ?> '" class="button" /></td>
                        <td><input name="btnDeleteC" type="button" value="Delete" 
                        onclick="if (MsgOkCancel()) document.location.href ='certificate_course.php?cmd=delete&course_code=<?php echo $rec['course_code'] ?>';" class="button" /></td>

                    </tr>
            <?php
                }
            } ?>

        </table>

        <br>
</body>

</html>
<?php
//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Certificate Course - Student Management System - Buddhist & Pali University of Sri Lanka";
$navpath = "<ul><li><a href='home.php'>Home </a></li><li>Certificate_Course</li></ul>";
//Apply the template
include("master_registration.php");
?>