<?php
//Buffer larger content areas like the main page content
ob_start();
?>
<script language="javascript">
    function MsgOkCancel() {
        var message = "Please confirm to DELETE this subject...";
        var return_value = confirm(message);
        return return_value;
    }
</script>

<?php

require_once("dbAccess.php");
$db = new DBOperations();

if (isset($_GET['cmd']) && $_GET['cmd'] == "delete") {
    $cpId = $_GET['id'];

    $delQuery = "DELETE FROM `course_position` WHERE id='$cpId'";
    $result = $db->executeQuery($delQuery);

    header("location:coursePosition.php");
}
if (isset($_POST['stLevel'])) {
    $level = $db->cleanInput($_POST['stLevel']);
    //$level=$_POST['level'];
}
if (isset($_POST['stSemester'])) {

    $semester = $db->cleanInput($_POST['stSemester']);
    //$semester=$_POST['stSemester'];
}
if (isset($_POST['stPosition'])) {
    $position = $db->cleanInput($_POST['stPosition']);
}

if (isset($_POST['btnSubmit'])) {

    if (isset($_POST['stCourse'])) {
        $course = $db->cleanInput($_POST['stCourse']);
        //$SubjectID=$_POST['lstSubject'];
    }
    if (isset($_POST['stPosition'])) {
        $position = $db->cleanInput($_POST['stPosition']);
    }

    $positionsQuery = $db->executeQuery("SELECT id FROM positionscourses WHERE id='$position'");

    $positionsRow = $db->Next_Record($positionsQuery);
    $positionId = $positionsRow['id'];


    $couresesQuery = $db->executeQuery("SELECT `course_code`FROM `certificate_course` WHERE course_code='$course'");

    $coursesRow = $db->Next_Record($couresesQuery);
    $courseId = $coursesRow['course_code'];


    $result = $db->executeQuery("INSERT INTO `course_position`(`id`, `courseId`, `positionId`) VALUES (Null,'$courseId','$positionId')");


    header("location:coursePosition.php");
    exit();
}
?>


<h1>Course Position</h1>
<form action="" method="post" name="form1" id="form1" class="plain">
    <table class="searchResults">
        <tr>
            <td height="28">Level:</td>
            <td><select name="stLevel" id="stLevel" onchange="document.form1.submit()" required>
                    <option value="">Not Selected</option>
                    <option value="I">Level one</option>
                    <option value="II">Level two</option>
                    <option value="III">Level three</option>
                    <option value="IV">Level four</option>
                </select>
                <script>
                    document.getElementById('stLevel').value = "<?php echo $level; ?>";
                </script>
            </td>
        </tr>
        <tr>
            <td height="28">Semester:</td>
            <td><select name="stSemester" id="stSemester" onchange="document.form1.submit()" required>
                    <option value="">Not Selected</option>
                    <option value="First Semester">First Semester</option>
                    <option value="Second Semester">Second Semester</option>
                </select>
                <script>
                    document.getElementById('stSemester').value = "<?php echo $semester; ?>";
                </script>
            </td>
        </tr>
        <tr>
            <td height="28">Position</td>
            <td><select name="stPosition" id="stPosition" onchange="document.form1.submit()" required>
                    <option value="">Not Selected</option>
                    <?php
                    $positionQuery = "SELECT `id`, `position`, `p_name`, `level`, `semester`, `Type` FROM `positionscourses` WHERE level='$level' and semester='$semester' order by position";
                    $result = $db->executeQuery($positionQuery);
                    while ($positionRow = $db->Next_Record($result)) {
                        $Id = $positionRow['id'];
                        $positionId = $positionRow['position'];
                        $positionName = $positionRow['p_name'];
                        echo "<option value=\"$Id\">$positionId - $positionName</option>";
                    }
                    ?>
                </select>
                <script>
                    document.getElementById('stPosition').value = "<?php echo $position; ?>";
                </script>

            </td>
        </tr>
        <tr>
            <td height="28">Course</td>
            <td><select name="stCourse" id="stCourse" required>
                    <option value="">Not Selected</option>
                    <?php
                    $courseQuery = "SELECT `course_code`, `coursenameE`,
    CASE 
        WHEN 1styear = 'Yes' THEN 'I'
        WHEN 2ndyear = 'Yes' THEN 'II'
        WHEN 3rdyear = 'Yes' THEN 'III'
        WHEN 4thyear = 'Yes' THEN 'IV'
    END AS level_status
    FROM `certificate_course`
    WHERE (1styear = 'Yes' AND '$level' = 'I')
       OR (2ndyear = 'Yes' AND '$level' = 'II')
       OR (3rdyear = 'Yes' AND '$level' = 'III')
       OR (4thyear = 'Yes' AND '$level' = 'IV')";

                    // Execute the query
                    $courseResult = $db->executeQuery($courseQuery);

                    // Fetch the results and display them
                    while ($courseRow = $db->Next_Record($courseResult)) {
                        $rcourseCode = $courseRow['course_code'];
                        $rcourseNameE = $courseRow['coursenameE'];
                        $rlevel_status = $courseRow['level_status'];

                        // Output as options in a select dropdown
                        echo "<option value=\"$rcourseCode\">$rcourseCode - $rcourseNameE</option>";
                    }
                    ?>

                </select>
                <script>
                    document.getElementById('stCourse').value = "<?php echo $course; ?>";
                </script>
            </td>
        </tr>
    </table>
    <br>
    <table class="searchResults">
        <tr>

            <th>Name</th>
            <th>Position</th>
            <th>Level</th>
            <th>Semester</th>
            <th colspan="1"></th>
        </tr>
        <?php
        if (isset($_POST['stPosition'])) {
            $STP = $_POST['stPosition'];
            $query = $db->executeQuery("
                SELECT certificate_course.coursenameE, positionscourses.p_name, positionscourses.level,positionscourses.semester, course_position.id AS cp_id
                FROM course_position
                JOIN certificate_course ON certificate_course.course_code = course_position.courseId
                JOIN positionscourses ON positionscourses.id = course_position.positionId 
                where course_position.positionId = '$STP';
               ");
        } else {
            $query = $db->executeQuery("
                SELECT certificate_course.coursenameE, positionscourses.p_name, positionscourses.level,positionscourses.semester, course_position.id AS cp_id
                FROM course_position
                JOIN certificate_course ON certificate_course.course_code = course_position.courseId
                JOIN positionscourses ON positionscourses.id = course_position.positionId
        ");
        }
        ?>

        <?php
        if ($db->Row_Count($query) > 0) {
            // Loop through the combined results of course and position
            while ($row = $db->Next_Record($query)) {
        ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['coursenameE']); ?></td>
                    <td><?php echo htmlspecialchars($row['p_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['level']); ?></td>
                    <td><?php echo htmlspecialchars($row['semester']); ?></td>
                    <td>
                        <input name="btnDelete" type="button" value="Remove" class="button" onclick="if (MsgOkCancel()) { 
                        document.location.href ='coursePosition.php?cmd=delete&id=<?php echo $row['cp_id']; ?>';
                    }" />
                    </td>
                </tr>
        <?php
            }
        } else {
            echo "<tr><td colspan='3'>No data found.</td></tr>"; // Optional: display message if no data
        }
        ?>

    </table>

    <br /><br />
    <p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'courseRelated.php';" class="button" />&nbsp;&nbsp;&nbsp;
        <input name="btnSubmit" type="submit" value="Submit" class="button" />
    </p>

</form>
<?php
//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "New Courses -  - Student Management System - Buddhist & Pali University of Sri Lanka";
$navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='examAdmin.php'>Exam Efforts </a></li><li>New Effort</li></ul>";
//Apply the template
include("master_registration.php");
?>