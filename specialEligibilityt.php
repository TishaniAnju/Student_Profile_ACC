<?php
// Start buffering output
ob_start();

// Include the necessary database access functions
require_once("dbAccess.php");

// Create a new database object
$db = new DBOperations();

// Initialize spDegree and acyear variables
$spDegree = isset($_POST['spDegree']) ? $db->cleanInput($_POST['spDegree']) : 0;
$acyear = isset($_POST['acyear']) ? $db->cleanInput($_POST['acyear']) : 0;

// Process form submission
if (isset($_POST['spDegree']) || isset($_POST['acyear'])) {
    // Handle form submission and database queries here if needed
}

?>

<!-- Create a form to select Special Degree and Academic Year -->
<form method="post" name="form1" id="form1" action="" class="plain">
    <table class="searchResults">
        <tr>
            <td height="28">Special Degree :</td>
            <td>
                <select name="spDegree" id="spDegree" onchange="form1.submit()">
                    <option value="0" disabled>Select Special Degree</option>
                    <?php
                    // Query to fetch Special Degree options from the database
                    $query = "SELECT * FROM special_degree";
                    $result = $db->executeQuery($query);
                    // Loop through the results and create options for the dropdown
                    while ($data = $db->Next_Record($result)) {
                        $selected = ($data['sid'] == $spDegree) ? "selected" : "";
                        echo "<option value='{$data['sid']}' {$selected}>{$data['description']}</option>";
                    }
                    ?>
                </select>
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
                        $selected = ($row['acYear'] == $acyear) ? "selected" : "";
                        echo "<option value='{$row['acYear']}' {$selected}>{$row['acYear']}</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>

    <!-- Display a table to show exam results -->
    <table class="searchResults">
        <tr>
            <th>Index No.</th>
            <th>1st Semester Marks</th>
            <th>2nd Semester Marks</th>
            <th>Subject GPA</th>
            <th>Status</th>
            <th>Other subjects Eligibility</th>
            <th>Overall GPA</th>
            <th>Overall Eligibility</th>
        </tr>

        <?php
        // Query to fetch exam results of all subjects, including gradePoint
        $query = "SELECT exameffort.*, subject.*, grade, gradePoint AS gradePoint0
        FROM exameffort
        JOIN subject ON exameffort.subjectID = subject.subjectID
        WHERE subject.spRelated = '$spDegree' AND exameffort.acYear = '$acyear'";

        // Execute the query
        $result = $db->executeQuery($query);

        // Initialize examResultsData as an empty array
        $examResultsData = [];

        // Loop through the results and organize data by student indexNo
        while ($row = $db->Next_Record($result)) {
            $indexNo = $row['indexNo'];
            $examResultsData[$indexNo][] = array(
                'marks' => $row['marks'],
                'gradePoint' => $row['gradePoint0'],
                'grade' => $row['grade'], // Added to track grades
            );
        }
        // Loop through the organized data to display results for each student
        foreach ($examResultsData as $indexNo => $subjects) {
            $status = 'Fail'; // Default status
            $eligible = false; // Assume the student is eligible by default
            $Gpa = 0;
            $marks0 = isset($subjects[0]['marks']) ? $subjects[0]['marks'] : null;
            $marks1 = isset($subjects[1]['marks']) ? $subjects[1]['marks'] : null;
            $gradePoint0 = isset($subjects[0]['gradePoint']) ? $subjects[0]['gradePoint'] : null;
            $gradePoint1 = isset($subjects[1]['gradePoint']) ? $subjects[1]['gradePoint'] : null;

            if ($gradePoint0 >= 3.0 && $gradePoint1 >= 3.0) {
                $status = 'Pass';
            }

            // Initialize the count of failing grades
            $countFailGrades = 0;

            foreach ($subjects as $subject) {
                // Check if 'grade' key exists in the $subject array
                if (isset($subject['grade'])) {
                    $grade = $subject['grade'];
                    if (in_array($grade, ["C-", "D+", "D", "E", "AB"])) {
                        $countFailGrades++;
                    } else {
                        $eligible = true; // If any subject has a passing grade, mark the student as not eligible
                    }
                } else {
                    $grade = "AB";
                    // You can add error handling or a default value here if needed
                    $countFailGrades++; // Increment $countFailGrades as an example
                }
            }

            
        // Calculate GPA based on the gradePoint of all subjects (assuming 6 subjects)
        $totalGradePoints = 0;
        $totalSubjects = 0;

        foreach ($subjects as $subject) {
            if (isset($subject['gradePoint'])) {
                $gradePoint = $subject['gradePoint'];
                // Assuming grade points are numeric values (e.g., 4.0 for A, 3.0 for B, etc.)
                $totalGradePoints += $gradePoint;
                $totalSubjects++;
            }
        }
        // Calculate GPA (assuming 6 subjects)
        $gpa = ($totalSubjects > 0) ? ($totalGradePoints / $totalSubjects) : 0;

        // Calculate GPA for selected Special degree
        $Subjectgpa = ($totalGradePoints / 2);

        // Calculate eligibility of other subjects based on the count of failing grades
        $otherSubjectsEligibility = ($countFailGrades >= 1) ? "Not Eligible" : "Eligible";

        // Calculate overall eligibility based on the status and other subjects eligibility
        $overallEligibility = ($status === 'Fail' && $countFailGrades >= 1) ? 'Not Eligible' : 'Eligible';
        ?>
        <tr>
            <td><?php echo $indexNo; ?></td>
            <td><?php echo $marks0; ?></td>
            <td><?php echo $marks1; ?></td>
            <td><?php echo $Subjectgpa; ?></td>
            <td><?php echo $status; ?></td>
            <td><?php echo $otherSubjectsEligibility; ?></td>
            <td><?php echo number_format($gpa, 2); // Display GPA with 2 decimal places ?></td>
            <td><?php echo $overallEligibility; ?></td>
        </tr>
    <?php } ?>
</table>
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
