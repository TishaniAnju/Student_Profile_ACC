<?php
//Buffer larger content areas like the main page content
ob_start();
//session_start();
?>

<head>
    <script language="javascript">

    </script>
    <script>
        function MsgOkCancel() {
            var message = "Please confirm to DELETE this item...";
            var return_value = confirm(message);
            return return_value;
        }
    </script>
</head>
<?php

require_once("dbAccess.php");
$db = new DBOperations();
//include("authcheck.inc.php");

if (isset($_POST['submit'])) {
    $yearEntry = '2022';
}
?>

<h1>Insert students</h1>
<form action="" method="post">
   
    <br><input type="submit" name="submit" value="submit"><br><br>
    <?php
    if (isset($_POST['submit'])) {
        $yearEntry = '2022';
        $selectQuery = "SELECT regNo, indexNo, appNo FROM student WHERE yearEntry = '$yearEntry'";
        $result = $db->executeQuery($selectQuery);
    
        while ($row = $db->Next_Record($result)) {
            $regNo = $row['regNo'];
            $indexNo = $row['indexNo'];
            $appNo = $row['appNo'];
    
            $checkExistingQuery = "SELECT * FROM Student_Current WHERE regNO = '$regNo' AND acyear = '2022' AND level = 'I' AND semester = 'First Semester'";
            $existingRecord = $db->executeQuery($checkExistingQuery);
    
            if ($db->Row_Count($existingRecord) == 0) {
                $insertQuery = "INSERT INTO Student_Current (regNO, acyear, level, semester, active) VALUES ('$regNo', '2022', 'I', 'First Semester', 'y')";
                $db->executeQuery($insertQuery);
    
                echo "Data inserted successfully for regNo: $regNo<br>";
            }
        }
    }
    
    $pagemaincontent = ob_get_contents();
    ob_end_clean();
    $pagetitle = "Insert 2022 student details - Student Management System - Buddhist & Pali University of Sri Lanka";
    $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Insert 2022 student details</li></ul>";
    include("master_registration.php");
    ?>
    </p>
</form>
<p>&nbsp;</p>