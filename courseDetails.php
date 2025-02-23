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
$selectquery = "SELECT `course_code`,`coursenameE`,`coursenameS`, `duration`, `course_units`, `1styear`,
            `2ndyear`, `3rdyear`, `4thyear`, `passed_certificate` FROM `certificate_course` WHERE `course_code` = $course;";
$resultselect = $db->executeQuery($selectquery);
$rec = $db->Next_Record($resultselect);

if ($db->Row_Count($resultselect) > 0) {

    if($rec['passed_certificate']=='y'){
        $show = 'Want';
    }
    else if($rec['passed_certificate']=='n'){
        $show = 'Do not Want';
    }
    // $rec = $db->Next_Record($resultselect);
?>
    <h1>Course Details - (Course Code - <?php echo $rec['course_code']; ?> )</h1>
    <table class="searchResults" width="260%">
        <!-- <tr>
            <td height="25" width="200"> Course Code</td>
            <td width="309">
                <input name="txtCourseCode" id="txtCourseCode" type="text" tabindex="1" size="20" style="font-size: larger;" <?php echo $rec['course_code'];  ?> disabled />
            </td>
        </tr> -->
        <tr>
            <td height="25" width="200"> Course Name (English)</td>
            <td width="309">
                <input size="75" style="font-size: larger;" value="<?php echo $rec['coursenameE']; ?>" disabled />
            </td>
        </tr>
        <tr>
            <td height="25" width="200"> පාඨමාලාවේ නම (සිංහල)</td>
            <td width="309">
                <input size="75" style="font-size: larger;" value="<?php echo $rec['coursenameS']; ?>" disabled />
            </td>
        </tr>
        <tr>
            <td height="25" width="200"> Course Duration</td>
            <td width="309">
                <input size="55" style="font-size: larger;" value="<?php echo $rec['duration']; ?>" disabled />
            </td>
        </tr>
        <tr>
            <td height="25" width="200"> No. of Units</td>
            <td width="309">
                <input size="55" style="font-size: larger;" value="<?php echo $rec['course_units']; ?>" disabled />
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
                <input size="55" style="font-size: larger;" value="<?php echo $rec['1styear']; ?>" disabled />
            </td>
        </tr>
        <tr>
            <td height="25" width="21%" style=" font-size: larger; border-bottom: black groove 1px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                2nd Year</td>
            <td class="ms-2">
                <input size="55" style="font-size: larger;" value="<?php echo $rec['2ndyear']; ?>" disabled />
            </td>
        </tr>
        <tr>
            <td height="25" width="21%" style="font-size: larger;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                3rd Year
            </td>
            <td>
                <input size="55" style="font-size: larger;" value="<?php echo $rec['3rdyear']; ?>" disabled />
            </td>
        </tr>
        <tr>
            <td height="25" width="21%" style="font-size: larger;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                4th Year

            </td>
            <td>
                <input size="55" style="font-size: larger;" value="<?php echo $rec['4thyear']; ?>" disabled />
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
                <input size="95" style="font-size: larger;" value="<?php echo $show ?>" disabled />
            </td>
        </tr>
        <tr>
            <td height="56" colspan="2">
                <div align="center">
                    <input name="btnExit" id="btnExit" type="button" value=" Exit " class="button" tabindex="16" onclick="document.location.href='certificate_course.php';" />
                </div>
            </td>
        </tr>
    </table>
<?php
}
//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Certificate Course - Student Management System - Buddhist & Pali University of Sri Lanka";
$navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='certificate_course.php'>Certificate_Course</a></li>
<li>Certificate_Course_Details</li></ul>";
//Apply the template
include("master_registration.php");
?>