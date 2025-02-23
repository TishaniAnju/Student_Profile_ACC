<?php
//Buffer larger content areas like the main page content
ob_start();
?>
<?php

require_once("dbAccess.php");
$db = new DBOperations();
?>
<!-- for catch data -->
<?php
$course = $_GET['course_code'];

if (isset($_POST['btnUpdate'])) {

    $cNameE = $db->cleanInput($_POST['txtCourseNameE']);
    $cNameS = $db->cleanInput($_POST['txtCourseNameS']);
    $cDuration = $db->cleanInput($_POST['txtCourseDuration']);
    $cNoUnits = $db->cleanInput($_POST['txtCourseUnits']);
    $year1 = $db->cleanInput($_POST['1styear']);
    $year2 = $db->cleanInput($_POST['2ndyear']);
    $year3 = $db->cleanInput($_POST['3rdyear']);
    $year4 = $db->cleanInput($_POST['4thyear']);
    $passCertificate = $db->cleanInput($_POST['certifypass']);

    $updatequery = "UPDATE `certificate_course` SET `coursenameE`='$cNameE',`coursenameS`='$cNameS',`duration`='$cDuration',
            `course_units`='$cNoUnits',`1styear`='$year1',`2ndyear`='$year2',`3rdyear`='$year3',
            `4thyear`='$year4',`passed_certificate`='$passCertificate' WHERE `course_code`='$course';";
    $executeUpdate = $db->executeQuery($updatequery);
    //  echo $updatequery;
    header("Location: certificate_course.php");
    exit();
}

$selectquery = "SELECT `course_code`,`coursenameE`,`coursenameS`, `duration`, `course_units`, `1styear`,
            `2ndyear`, `3rdyear`, `4thyear`, `passed_certificate` FROM `certificate_course` WHERE `course_code` = $course ;";
$resultselect = $db->executeQuery($selectquery);
$rec = $db->Next_Record($resultselect);
$year1 = $rec['1styear'];
$year2 = $rec['2ndyear'];
$year3 = $rec['3rdyear'];
$year4 = $rec['4thyear'];
$passCertify = $rec['passed_certificate'];


?>
<h1>Edit Course (Course Code - <?php echo $rec['course_code']; ?>)</h1>

<form action="" method="post">

    <table class="searchResults" width="260%">
        <!-- <tr>
            <td height="25" width="200"> Course Code</td>
            <td width="309">
                <input name="txtCourseCode" id="txtCourseCode" type="text" tabindex="1" size="20" style="font-size: larger;" <?php echo $course_code + 1; ?> disabled />
            </td>
        </tr> -->
        <tr>
            <td height="25" width="200"> Course Name (English)</td>
            <td width="309">
                <input name="txtCourseNameE" id="txtCourseNameE" size="75" style="font-size: larger;" value="<?php echo $rec['coursenameE']; ?>" require />
            </td>
        </tr>
        <tr>
            <td height="25" width="200"> පාඨමාලාවේ නම (සිංහල)</td>
            <td width="309">
                <input name="txtCourseNameS" id="txtCourseNameS" size="75" style="font-size: larger;" value="<?php echo $rec['coursenameS']; ?>" require />
            </td>
        </tr>
        <tr>
            <td height="25" width="200"> Course Duration</td>
            <td width="309">
                <input name="txtCourseDuration" id="txtCourseDuration" size="55" style="font-size: larger;" value="<?php echo $rec['duration']; ?>" require />
            </td>
        </tr>
        <tr>
            <td height="25" width="200"> No. of Units</td>
            <td width="309">
                <input name="txtCourseUnits" id="txtCourseUnits" size="55" style="font-size: larger;" value="<?php echo $rec['course_units']; ?>" require />
            </td>
        </tr>

    </table>

    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <table class="searchResults" width="260%" colspan="2" id="AddCourse">
        <tr>
            <td height="25" colspan='2'>
                <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
                    Due years :
                </font>
            </td>
        </tr>
        <tr>
            <td height="25" width="21%" style=" font-size: larger;">&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                1st Year
            </td>
            <td>
                <input type="radio" name="1styear" id="year1st" value="yes" tabindex="6" <?php if ($year1 == 'yes') echo 'checked'; ?> required><label for=" yes" style="font-size: larger;"> Yes</label></input>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="1styear" id="year1st" value="no" tabindex="7" <?php if ($year1 == 'no') echo 'checked'; ?> required><label for=" no" style="font-size: larger;"> No</label></input>
            </td>
        </tr>
        <tr>
            <td height="25" width="21%" style=" font-size: larger; border-bottom: black groove 1px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                2nd Year</td>
            <td class="ms-2">
                <input type="radio" name="2ndyear" id="year2nd" value="yes" tabindex="8" <?php if ($year2 == 'yes') echo 'checked'; ?> required> <label for=" yes" style="font-size: larger;"> Yes</label></input>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="2ndyear" id="year2nd" value="no" tabindex="9" <?php if ($year2 == 'no') echo 'checked'; ?> required><label for=" no" style="font-size: larger;"> No</label></input>
            </td>
        </tr>
        <tr>
            <td height="25" width="21%" style="font-size: larger;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                3rd Year
            </td>
            <td>
                <input type="radio" name="3rdyear" id="year3rd" value="yes" tabindex="10" <?php if ($year3 == 'yes') echo 'checked'; ?> required> <label for=" yes" style="font-size: larger;"> Yes</label></input>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="3rdyear" id="year3rd" value="no" tabindex="11" <?php if ($year3 == 'no') echo 'checked'; ?> required><label for=" no" style="font-size: larger;"> No</label></input>
            </td>
        </tr>
        <tr>
            <td height="25" width="21%" style="font-size: larger;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                4th Year

            </td>
            <td>
                <input type="radio" name="4thyear" id="year4th" value="yes" tabindex="12" <?php if ($year4 == 'yes') echo 'checked'; ?> required><label for=" yes" style="font-size: larger;"> Yes</label></input>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="4thyear" id="year4th" value="no" tabindex="13" <?php if ($year4 == 'no') echo 'checked'; ?> required><label for=" no" style="font-size: larger;"> No</label></input>
            </td>
        </tr>
    </table>

    <table class="searchResults" width="260%" rowspan="3">
        <tr>
            &nbsp;

            <td height="25" width="21%" style="font-size: larger;" colspan="2" required># Is it necessary to complete this certificate course to start the advanced certificate course?</td>
        </tr>
        <tr>
            <td>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <input type="radio" name="certifypass" id="certifypass" value="y" tabindex="14" <?php if ($passCertify == 'y') echo 'checked'; ?> require><label for=" want" style="font-size: larger;"> Want</label></input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="certifypass" id="certifypass" value="n" tabindex="15" <?php if ($passCertify == 'n') echo 'checked'; ?> require><label for=" donot" style="font-size: larger;"> Don't Want</label></input>
            </td>
        </tr>
        <tr>
            <td height="56" colspan="2">
                <div align="center">
                    <input name="btnCancel" id="btnCancel" type="button" value="Cancel" class="button" tabindex="16" onclick="document.location.href='certificate_course.php';" />
                    &nbsp;&nbsp;
                    <input type="submit" name="btnUpdate" id="btnUpdate" value="Update" tabindex="17" class="button" />
                </div>
            </td>
        </tr>
    </table>
</form>

<?php
//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Certificate Course - Student Management System - Buddhist & Pali University of Sri Lanka";
$navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='certificate_course.php'>Certificate_Course</a></li>
<li>Edit_Course</li></ul>";
//Apply the template
include("master_registration.php");
?>