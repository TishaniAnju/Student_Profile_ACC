<?php
include('dbAccess.php');
$db = new DBOperations();


###excel####

$filename = "Student Subject Enrollment Report.xls";
$contents = "testdata1 \t testdata2 \t testdata3 \t \n";
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename=' . $filename);

###excel####

$acYear = $db->cleanInput($_GET['acYear']);
$level = $db->cleanInput($_GET['level']);
$semester = $db->cleanInput($_GET['semester']);
$variablQuery



    ?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Student Subject Enrollment Report - Student Management System - Buddhist & Pali University of Sri Lanka
    </title>
    <script type="text/javascript" src="lib/tablesort/tablesort.js"></script>
    <link href="css/print.css" rel="stylesheet" type="text/css" media="screen,print,projection" />
    <style type='text/css' media='print'>
        @page {
            size: A4;
            size: landscape
        }

        #btnPrint {
            display: none
        }
    </style>

    <div align="right"><input type="button" id="btnPrint" value="Print" onClick="window.print();return false" /></div>
    <h1 align="center">
        <font size="+3">Student's Subject Enrollment Report</font>
    </h1>
    <h2 align="center">
        <font size="+2">
            <?php echo $acYear ?> Subject Enrollment Report
        </font>
    </h2>

</head>
<table align="center" border="1" cellpadding="2" cellspacing="2">
    <thead>
        <tr>

            <th class="sortable-numeric" rowspan="2">
                <font>Registration No</font>
            </th>
            <th rowspan="2">Name</th>
            <th rowspan="2">Index No</th>
            <th colspan="2">Subject</th>
            <th rowspan="2">Academic Year</th>
            <th rowspan="2">Level</th>
            <th rowspan="2">Semester</th>
            <th rowspan="2">Enrollment Confirmed Or Not</th>

        </tr>
        <tr>

            <th>Subject Code</th>
            <th>Subject Name</th>
        </tr>

    </thead>

    <tbody>
        <?php
        $levels = array('I', 'II', 'III', 'IV'); // Define all levels
        
        // Build the SQL query with a condition to fetch data for all levels
        $levelConditions = implode("', '", $levels); // Convert array to a comma-separated string
        
        $variablQuery = "SELECT studentenrolment.*, student.nameEnglish AS stName, subject.*
                FROM studentenrolment 
                JOIN student ON studentenrolment.regNo = student.regNo
                JOIN subject ON studentenrolment.subjectID = subject.subjectID 
                WHERE studentenrolment.acYear = '$acYear'
                AND subject.level IN ('$levelConditions')";

        if ($semester != 'first semester.second semester' && $semester != 'All') {
            $variablQuery .= " AND subject.semester = '$semester'";
        }

        $variablQuery .= " ORDER BY studentenrolment.regNo, subject.level, subject.semester";


        $query = $variablQuery;

        $result = $db->executeQuery($query);
        $prevRegNo = null;

        while ($row = $db->Next_Record($result)) {
            if ($prevRegNo !== null && $prevRegNo !== $row['regNo']) {
                echo '<tr><td colspan="9" style="background-color: #e0e0de">&nbsp;<br>&nbsp;</td></tr>';
            }


            $prevRegNo = $row['regNo'];
            ?>

            <tr>

                <td>
                    <?php echo $row['regNo']; ?>
                </td>
                <td>
                    <?php echo $row['stName']; ?>
                </td>
                <td>
                    <?php echo $row['indexNo']; ?>
                </td>



                <?php
                $subQuery = "SELECT * FROM subject 
                JOIN studentenrolment ON studentenrolment.subjectID = subject.subjectID 
                WHERE subject.subjectID = '{$row['subjectID']}' 
                AND studentenrolment.regNo = '{$row['regNo']}' 
                AND studentenrolment.acYear = '{$row['acYear']}' 
                ORDER BY subject.semester";

                $resultSub1 = $db->executeQuery($subQuery);

                // Check the number of rows returned by the subquery
                if ($db->Row_Count($resultSub1) == 1) {
                    while ($rowSub1 = $db->Next_Record($resultSub1)) {
                        // Output the appropriate columns from the subquery
            
                        echo "<td>" . $rowSub1['codeEnglish'] . "</td>";
                        echo "<td>" . $rowSub1['nameEnglish'] . "</td>";
                    }
                } elseif ($db->Row_Count($resultSub1) == 0) {
                    // Output placeholders if no rows found in the subquery
                    for ($j = 0; $j < 3; $j++) {
                        echo "<td> - </td>";
                    }
                }
                ?>


                <td align='center'>
                    <?php echo $row['acYear']; ?>
                </td>

                <td align='center'>
                    <?php echo $row['level']; ?>
                </td>


                <td>
                    <?php echo $row['semester']; ?>
                </td>
                <td>
                    <?php
                    if ($row['confirm'] === 'y') {
                        echo 'confirmed';
                    } else {
                        echo 'not confirmed';
                    }
                    ?>
                </td>


            </tr>
            <?php
        } ?>
    </tbody>

</table>

</html>