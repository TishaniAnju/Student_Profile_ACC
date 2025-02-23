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
    <title>Select Subject Enrollment Report - Student Management System - Buddhist & Pali University of Sri Lanka
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
        <font size="+3">Select Subject Enrollment Report</font>
    </h1>
    <h2 align="center">
        <font size="+2">
            <?php echo $acYear ?> Subject Enrollment Report
        </font>
    </h2>

</head>
<?php
$querysubject = "SELECT subjectID, nameEnglish , codeEnglish FROM subject WHERE level='$level' AND semester='$semester'";
// Include subjectID for comparison
$resultsubject = $db->executeQuery($querysubject);

if ($resultsubject->num_rows > 0) {
    // Store subject IDs and names in arrays for easy access
    $subjects = [];
    while ($rows = $db->Next_Record($resultsubject)) {
        if ($resultsubject->num_rows > 0) {
            // Store subject IDs and names in arrays for easy access
            $subjects = [];
            while ($rows = $db->Next_Record($resultsubject)) {
                $subjects[$rows['subjectID']] = [
                    'nameEnglish' => $rows['nameEnglish'],
                    'codeEnglish' => $rows['codeEnglish']
                ];
            }
        }
    }
    // Start the table
    echo '<table align="center" border="1" cellpadding="2" cellspacing="2">
            <thead>
                <tr>
                    <th class="sortable-numeric" rowspan="2">Registration No</th>
                    <th colspan="' . count($subjects) . '">Subject Name</th>
                </tr>
                <tr>';

    // Print subject names as column headers
    foreach ($subjects as $subjectID => $subjectData) {
        echo "<th>" . $subjectData['nameEnglish'] . "<br>" . $subjectData['codeEnglish'] . "</th>"; // Display the subject name
    }
    echo '</tr></thead><tbody>';

    // Query to get student enrollments
    $query = "SELECT studentenrolment.regNo, studentenrolment.subjectID, subject.level, subject.semester
          FROM studentenrolment 
          JOIN subject ON studentenrolment.subjectID = subject.subjectID
          WHERE studentenrolment.acYear = '$acYear' AND subject.level = '$level' AND subject.semester = '$semester'";
    // Make sure to use a safe method for $acYear

    $result = $db->executeQuery($query);
    $enrollments = [];

    // Build an array of enrollments
    while ($row = $db->Next_Record($result)) {
        $enrollments[$row['regNo']][] = $row['subjectID'];
    }

    // Output each student's enrollment status
    foreach ($enrollments as $regNo => $subjectIDs) {
        echo "<tr><td>$regNo</td>";

        // Check each subject and print "YES" or "NO"
        foreach ($subjects as $subjectID => $subjectName) {
            if (in_array($subjectID, $subjectIDs)) {
                echo "<td>YES</td>";
            } else {
                echo "<td>NO</td>";
            }
        }

        echo '</tr>';
    }

    echo '</tbody></table>';
}
?>

</tbody>

</table>

</html>