<?php
//Buffer larger content areas like the main page content
ob_start();
?>

<script type="text/javascript" language="javascript">
    function MsgOkCancel() {
        var message = "Please confirm to DELETE this student...";
        var return_value = confirm(message);
        return return_value;
    }
</script>

<?php
require_once("dbAccess.php");
$db = new DBOperations();

if (isset($_GET['cmd']) && $_GET['cmd'] == "delete") {
    $studentID = $_GET['regNo'];
    $enrolId = $_GET['enrolId'];
    $cCode = $_GET['courseID'];

    $delQuery = "DELETE FROM `courseenrolment` WHERE regNo='$studentID' AND  courseID =' $cCode'";
    $db->executeQuery($delQuery);

    header("location:studentCourseEnroll.php?regNo=$studentID");
}
if (isset($_GET['cmd']) && $_GET['cmd'] == "confirm") {
    $studentID = $_GET['regNo'];
    $enrolId = $_GET['enrolId'];
    $cCode = $_GET['courseID'];

    $UpdQuery = "UPDATE courseenrolment set confirm = 'y' WHERE regNo='$studentID' AND courseID='$cCode'";
    $db->executeQuery($UpdQuery);

    header("location:studentCourseEnroll.php?regNo=$studentID");
}
$studentID = $_GET['regNo'];
$level = $_GET['st_level'];

$query = "SELECT * FROM certificate_course JOIN courseenrolment ON courseenrolment.courseID=certificate_course.course_code
         WHERE courseenrolment.regNo = '$studentID' order by courseenrolment.semester ";
$pageResult = $db->executeQuery($query);

//  first year
$query1 = "SELECT certificate_course.course_code, certificate_course.coursenameE, certificate_course.duration,
            courseenrolment.st_level, courseenrolment.Semester, courseenrolment.confirm ,
            CASE 
                WHEN certificate_course.1styear = 'Yes' THEN 'I'
            END AS level_status
            FROM 
                certificate_course 
            JOIN 
                courseenrolment ON courseenrolment.courseId = certificate_course.course_code
            WHERE 
            certificate_course.1styear = 'Yes'
             AND courseenrolment.st_level = 'I'
             order by courseenrolment.semester;";
$pageResult1 = $db->executeQuery($query1);

//  Second year
$query2 = "SELECT certificate_course.course_code, certificate_course.coursenameE, certificate_course.duration,
            courseenrolment.st_level, courseenrolment.Semester, courseenrolment.confirm ,
            CASE 
                WHEN certificate_course.2ndyear = 'Yes' THEN 'I'
            END AS level_status
            FROM 
                certificate_course 
            JOIN 
                courseenrolment ON courseenrolment.courseId = certificate_course.course_code
            WHERE 
            certificate_course.2ndyear = 'Yes'
             AND courseenrolment.st_level = 'II'
             order by courseenrolment.semester;";
$pageResult2 = $db->executeQuery($query2);

//  third year
$query3 = "SELECT certificate_course.course_code, certificate_course.coursenameE, certificate_course.duration,
            courseenrolment.st_level, courseenrolment.Semester, courseenrolment.confirm ,
            CASE 
                WHEN certificate_course.3rdyear = 'Yes' THEN 'I'
            END AS level_status
            FROM 
                certificate_course 
            JOIN 
                courseenrolment ON courseenrolment.courseId = certificate_course.course_code
            WHERE 
            certificate_course.3rdyear = 'Yes'
            AND courseenrolment.st_level = 'III'
            order by courseenrolment.semester;";
$pageResult3 = $db->executeQuery($query3);

//  fourth year
$query4 = "SELECT certificate_course.course_code, certificate_course.coursenameE, certificate_course.duration,
            courseenrolment.st_level, courseenrolment.Semester, courseenrolment.confirm ,
            CASE 
                WHEN certificate_course.4thyear = 'Yes' THEN 'I'
            END AS level_status
            FROM 
                certificate_course 
            JOIN 
                courseenrolment ON courseenrolment.courseId = certificate_course.course_code
            WHERE 
            certificate_course.4thyear = 'Yes'
            AND courseenrolment.st_level = 'IV'
            order by courseenrolment.semester;";
$pageResult4 = $db->executeQuery($query4);

?>
<h1>Course Enrollment</h1>
<br>

<form method="post" action="studentCourseEnroll.php?regNo=<?php echo $studentID; ?>" class="plain">
    <?php if (($db->Row_Count($pageResult)) > 0) { ?>
        <table class="searchResults">
            <tr>
                <th colspan="8">Index No :
                    <?php echo $studentID; ?>
                </th>
            </tr>
            <tr>
                <th>Course Code</th>
                <th>Course Name</th>
                <th>Duration</th>
                <th>Student's Level</th>
                <th>Semester</th>
                <th></th>
                <th colspan="3"></th>
            </tr>

            <tr>
                <th colspan="8"> Year One</th>
            </tr>
            <?php
            while ($row = $db->Next_Record($pageResult1)) {
            ?>
                <tr>
                    <td width=250><?php echo $row['course_code'] ?></td>
                    <td width=250><?php echo $row['coursenameE'] ?></td>
                    <td width=250><?php echo $row['duration'] ?></td>
                    <td width=250><?php echo $row['st_level'] ?></td>
                    <td width=250><?php echo $row['Semester'] ?></td>

                    <td><input name="btnDisenroll" type="button" value="Disenroll" onclick="if (MsgOkCancel()) 
                    document.location.href ='studentCourseEnroll.php?cmd=delete&courseID=<?php echo $row['course_code'] . 
                    "&regNo=" . $studentID  ?>';" class="button" /></td>
                    <?php
                    if ($row['confirm'] == 'y') {
                        echo " <td><input name='btnConfirm' type='button' value='Confirmed'/></td>";
                    } else {
                        echo " <td><input name='btnConfirm' type='button' value='Confirm' class='button' 
                        onclick=\" document.location.href ='studentCourseEnroll.php?cmd=confirm&courseID=" . $row['course_code'] . 
                        "&regNo=" . $studentID . "'\" /></td>";
                    }
                    ?>
                </tr>
            <?php
            }
            ?>

            <tr>
                <th colspan="8"> Year Two</th>
            </tr>
            <?php
            while ($row = $db->Next_Record($pageResult2)) {
            ?>
                <tr>
                    <td width=250><?php echo $row['course_code'] ?></td>
                    <td width=250><?php echo $row['coursenameE'] ?></td>
                    <td width=250><?php echo $row['duration'] ?></td>
                    <td width=250><?php echo $row['st_level'] ?></td>
                    <td width=250><?php echo $row['Semester'] ?></td>

                    <!-- <?php echo " <td><input name='btnDisenroll' type='button' value='Disenroll' class='button' onclick=\"if (MsgOkCancel()) document.location.href ='studentEnroll.php?cmd=delete&subjectID=" . $row['course_code'] . "&regNo=" . $studentID . "'\" /></td>"; ?> -->
                    <td><input name="btnDisenroll" type="button" value="Disenroll" onclick="if (MsgOkCancel()) document.location.href ='studentCourseEnroll.php?cmd=delete&courseID=<?php echo $row['course_code'] . "&regNo=" . $studentID  ?>';" class="button" /></td>
                    <?php


                    if ($row['confirm'] == 'y') {
                        echo " <td><input name='btnConfirm' type='button' value='Confirmed'/></td>";
                    } else {
                        echo " <td><input name='btnConfirm' type='button' value='Confirm' class='button' onclick=\" document.location.href ='studentCourseEnroll.php?cmd=confirm&courseID=" . $row['course_code'] . "&regNo=" . $studentID . "'\" /></td>";
                    }
                    ?>
                </tr>
            <?php
            }
            ?>

            <tr>
                <th colspan="8"> Year Three</th>
            </tr>
            <?php
            while ($row = $db->Next_Record($pageResult3)) {
            ?>
                <tr>
                    <td width=250><?php echo $row['course_code'] ?></td>
                    <td width=250><?php echo $row['coursenameE'] ?></td>
                    <td width=250><?php echo $row['duration'] ?></td>
                    <td width=250><?php echo $row['st_level'] ?></td>
                    <td width=250><?php echo $row['Semester'] ?></td>

                    <!-- <?php echo " <td><input name='btnDisenroll' type='button' value='Disenroll' class='button' onclick=\"if (MsgOkCancel()) document.location.href ='studentEnroll.php?cmd=delete&subjectID=" . $row['course_code'] . "&regNo=" . $studentID . "'\" /></td>"; ?> -->
                    <td><input name="btnDisenroll" type="button" value="Disenroll" onclick="if (MsgOkCancel()) document.location.href ='studentCourseEnroll.php?cmd=delete&courseID=<?php echo $row['course_code'] . "&regNo=" . $studentID  ?>';" class="button" /></td>
                    <?php


                    if ($row['confirm'] == 'y') {
                        echo " <td><input name='btnConfirm1' type='button' value='Confirmed'/></td>";
                    } else {
                        echo " <td><input name='btnConfirm' type='button' value='Confirm' class='button' onclick=\" document.location.href ='studentCourseEnroll.php?cmd=confirm&courseID=" . $row['course_code'] . "&regNo=" . $studentID . "'\" /></td>";
                    }
                    ?>
                </tr>
            <?php
            }
            ?>


            <tr>
                <th colspan="8"> Year Four</th>
            </tr>
            <?php
            while ($row = $db->Next_Record($pageResult4)) {
            ?>
                <tr>
                    <td width=250><?php echo $row['course_code'] ?></td>
                    <td width=250><?php echo $row['coursenameE'] ?></td>
                    <td width=250><?php echo $row['duration'] ?></td>
                    <td width=250><?php echo $row['st_level'] ?></td>
                    <td width=250><?php echo $row['Semester'] ?></td>

                    <!-- <?php echo " <td><input name='btnDisenroll' type='button' value='Disenroll' class='button' onclick=\"if (MsgOkCancel()) document.location.href ='studentEnroll.php?cmd=delete&subjectID=" . $row['course_code'] . "&regNo=" . $studentID . "'\" /></td>"; ?> -->
                    <td><input name="btnDisenroll" type="button" value="Disenroll" onclick="if (MsgOkCancel()) document.location.href ='studentCourseEnroll.php?cmd=delete&courseID=<?php echo $row['course_code'] . "&regNo=" . $studentID  ?>';" class="button" /></td>
                    <?php


                    if ($row['confirm'] == 'y') {
                        echo " <td><input name='btnConfirm' type='button' value='Confirmed'/></td>";
                    } else {
                        echo " <td><input name='btnConfirm' type='button' value='Confirm' class='button' onclick=\" document.location.href ='studentCourseEnroll.php?cmd=confirm&courseID=" . $row['course_code'] . "&regNo=" . $studentID . "'\" /></td>";
                    }
                    ?>
                </tr>
            <?php
            }
            ?>

        </table>
    <?php } else echo "<p>  No enrollments.</p>"; ?>
</form>
<?php
//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Enroll - Students - Student Management System - Buddhist & Pali University of Sri Lanka";
$navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='studentAdmin.php'>Students </a></li><li>Course Enroll</li></ul>";
//Apply the template
include("master_registration.php");
?>