<?php
// Start buffering output
ob_start();
?>

<h1>Special Degree Details</h1>
<?php
// Include the necessary database access functions
require_once("dbAccess.php");

// Create a new database object
$db = new DBOperations();

// Check if 'spDegree' is set in the POST data, if not, set it to 0
if (isset($_POST['spDegree'])) {
    $spDegree = $db->cleanInput($_POST['spDegree']);
} else {
    $spDegree = 0;
}

// Check if 'acyear' is set in the POST data, if not, set it to 0
if (isset($_POST['acyear'])) {
    $acyear = $db->cleanInput($_POST['acyear']);
} else {
    $acyear = 0;
}
?>

<!-- Create a form to select Special Degree and Academic Year -->
<form method="post" name="form1" id="form1" action="" class="plain">
    <table class="searchResults">
        <tr>
            <td height="28">Special Degree : </td>
            <td><select name="spDegree" id="spDegree" onchange="form1.submit()">
                    <option value="0" disabled>Select Special Degree</option>
                    <?php
                    // Query to fetch Special Degree options from the database
                    $query = "SELECT * FROM special_degree";
                    $result = $db->executeQuery($query);
                    // Loop through the results and create options for the dropdown
                    while ($data = $db->Next_Record($result)) {
                        ?>
                        <option value="<?php echo $data['sid'] ?>"><?php echo $data['description'] ?></option>
                        <?php
                    }
                    ?>
                </select>
                <script>
                    // Set the selected value for 'spDegree' based on the PHP variable
                    document.getElementById('spDegree').value = "<?php echo $spDegree; ?>";
                </script>
            </td>
        </tr>

        <tr>
            <td>Academic Year:</td>
            <td>
                <select name="acyear" id="acyear" onChange="form1.submit()" class="form-control">
                    <option value="0" disabled>Select Year</option>
                    <?php
                    // Query to fetch Academic Year options from the database
                    $sql = "SELECT distinct acYear FROM exameffort order by acYear";
                    $result = $db->executeQuery($sql);
                    // Loop through the results and create options for the dropdown
                    while ($row = $db->Next_Record($result)) {
                        ?>
                        <option value="<?php echo $row['acYear'] ?>"><?php echo $row['acYear'] ?></option>
                        <?php
                    }
                    ?>
                </select>
                <script>
                    // Set the selected value for 'acyear' based on the PHP variable
                    document.getElementById('acyear').value = "<?php echo $acyear; ?>";
                </script>
                </label>
            </td>
        </tr>
    </table>

    <!-- Display a table to show exam results -->
    <table class="searchResults">
        <tr>
            <th>Index No.</th>
            <th>1st Semester Marks</th>
            <th>2nd Semester Marks</th>
            <th>Subjects Status</th>
            
            
            <th>Department GPA</th>
            <th>Department Eligibility</th>
            <th>Overall GPA</th>
            <th>Overall Eligibility</th>
            <th>Action</th> <!-- Add an action column -->
        </tr>

        <?php
        // Create an array to store exam result data
        $data = array();

        // Query to fetch exam results, including gradePoint, GPA, and Overall Eligibility
        $query = "SELECT exameffort.*, subject.*, grade, gradePoint AS gradePoint0
        FROM exameffort
        JOIN subject ON exameffort.subjectID = subject.subjectID
        WHERE subject.spRelated = '$spDegree' AND exameffort.acYear = '$acyear'";
        //print $query;

        // Execute the query
        $result = $db->executeQuery($query);

        // Loop through the results and organize data by student indexNo
        while ($row = $db->Next_Record($result)) {
            $data[$row['indexNo']][] = array(
                'marks' => $row['marks'],
                'gradePoint' => $row['gradePoint0'],
                'grade' => $row['grade']
            );
        }

        // Loop through the organized data to display results for each student
        foreach ($data as $indexNo => $semesters) {
            $marks0 = $semesters[0]['marks'];
            $marks1 = isset($semesters[1]) ? $semesters[1]['marks'] : null;

            $gradePoint0 = $semesters[0]['gradePoint'];
            $gradePoint1 = isset($semesters[1]) ? $semesters[1]['gradePoint'] : null;

            // Count specific grades for each student
            $cMinusCount = 0;
            $dPlusCount = 0;
            $dCount = 0;
            $eCount = 0;
            $ABCount = 0;

            foreach ($semesters as $semester) {
                $grade = $semester['grade'];
                if ($grade == 'C-') {
                    $cMinusCount++;
                } elseif ($grade == 'D+') {
                    $dPlusCount++;
                } elseif ($grade == 'D') {
                    $dCount++;
                } elseif ($grade == 'E') {
                    $eCount++;
                } elseif ($grade == 'AB') {
                    $ABCount++;
                }
            }

            // Calculate the total grade points and credits for this student
            $totalGradePoints = ($gradePoint0 * 3); // 3 credits for the 1st semester
            $totalCredits = 3; // 3 credits for the 1st semester
            if ($marks1 !== null) {
                $totalGradePoints += ($gradePoint1 * 3); // 3 credits for the 2nd semester
                $totalCredits += 3; // 3 credits for the 2nd semester
            }

            // Calculate GPA for each student
            $gpa = $totalGradePoints / $totalCredits;

            // Determine the Status based on gradePoints
            $status = ($gradePoint0 >= 3.0 && $gradePoint1 >= 3.0) ? "Pass" : "Fail";

            // Determine eligibility based on grade counts
            $Subjecteligibility = ($cMinusCount > 0 || $dPlusCount > 0 || $dCount > 0 || $eCount > 0 || $ABCount > 0) ? "Fail" : "Pass";

            // Calculate department GPA for each student
            $Departmentgpa = $totalGradePoints / 6;

            // Determine Overall eligibility
            $overallEligibility = ($status == 'Pass' && $Subjecteligibility == 'Pass' && $gpa >= 2.00) ? "Eligible" : "Not Eligible";

       


            // Output the table rows
            ?>
            <tr>
                <td><?php echo $indexNo; ?></td>
                <td><?php echo $marks0; ?></td>
                <td><?php echo $marks1; ?></td>
                <td><?php echo $Subjecteligibility; ?></td>
                
                
                <td><?php echo number_format($Departmentgpa, 2); ?></td>
                <td><?php echo $status; ?></td>
                <td><?php echo number_format($gpa, 2); ?></td>
                <td><?php echo $overallEligibility; ?></td>
                <td>
                <form method="post" action="">
                    <input type="hidden" name="selectedIndexNo" value="<?php echo $indexNo; ?>">
                    <input type="hidden" name="selectedAcYear" value="<?php echo $acyear; ?>">
                    <input type="hidden" name="selectedDepartmentGPA" value="<?php echo $Departmentgpa; ?>">
                    <input type="hidden" name="selectedGPA" value="<?php echo $gpa; ?>">
                    <input type="hidden" name="selectedSpDegree" value="<?php echo $spDegree; ?>">
                    <input type="hidden" name="selectedOverallEligibility" value="<?php echo $overallEligibility; ?>">
                    <button type="submit" name="selectButton">Select</button>
                </form>
                </td>

                
            </tr>
            <?php
        }
        ?>

    </table>
    <?php
    // Check if the Select button is clicked
    if (isset($_POST['selectButton'])) {
        // Retrieve the selected data from the form
        $selectedIndexNo = $db->cleanInput($_POST['selectedIndexNo']);
        $selectedAcYear = $db->cleanInput($_POST['selectedAcYear']);
        $selectedDepartmentGPA = $db->cleanInput($_POST['selectedDepartmentGPA']);
        $selectedGPA = $db->cleanInput($_POST['selectedGPA']);
        $selectedSpDegree = $db->cleanInput($_POST['selectedSpDegree']);
        $selectedOverallEligibility = $db->cleanInput($_POST['selectedOverallEligibility']);

        // Insert the selected data into the 'special_eligible_students' database table
        $insertQuery = "INSERT INTO special_eligible_students (indexNo, acYear, DepartmentGPA, GPA, spDegree, overallEligibility) VALUES ('$selectedIndexNo', '$selectedAcYear', '$selectedDepartmentGPA', '$selectedGPA', '$selectedSpDegree', '$selectedOverallEligibility')";
        //print $insertQuery;
        // Execute the query
        $db->executeQuery($insertQuery);

        
    }
    ?>

</form>





<?php
// Get the content of the output buffer and clean the buffer
$pagemaincontent = ob_get_contents();
ob_end_clean();

// Set page title and navigation path
$pagetitle = "New Effort - Exam Efforts - Student Management System - Buddhist & Pali University of Sri Lanka";
$navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='examAdmin.php'>Exam Efforts </a></li><li>New Effort</li></ul>";

// Include the master template for displaying the page
include("master_registration.php");
?>