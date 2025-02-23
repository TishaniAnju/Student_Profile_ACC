<?php
// Start buffering output
ob_start();
?>


<h1>Special Degree Priority  Details</h1>
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
            <th>GPA</th>
            <th>Priority</th>
            
        </tr>

        <?php
            // Create an array to store exam result data
            $data = array();

            $query = "SELECT * FROM special_eligible_students WHERE spDegree = '$spDegree' AND acYear = '$acyear' ORDER BY gpa ASC";

            
            
 // Check if the "Select" button is clicked
if (isset($_POST['selectindex'])) {
    // Get the selected student's indexNo
    $selectedIndexNo = $db->cleanInput($_POST['selectID']);
    
    // Update the student table with the selected spDegree
    $updateQuery = "UPDATE student SET spDegree = '$spDegree' WHERE indexNo = '$selectedIndexNo'";
    $db->executeQuery($updateQuery);
    
    // Optionally, you can display a success message here
    echo "Student Special degree updated successfully!";
}
           
         
            
             
            // Execute the query
            $result = $db->executeQuery($query);

            // Output the table rows
            while ($row = $db->Next_Record($result)) {
                $indexNo = $row['indexNo'];
                $gpa = $row['gpa'];

        ?>
            <tr>
                <td><?php echo $indexNo; ?></td>
                <td><?php echo number_format($gpa, 2); ?></td>
                <td></td> <!-- This empty cell will make the "Priority" field null -->
                <td><form action="" method="post">
                    <input type="hidden" name="selectID" value="<?php echo $row['indexNo']; ?>">
                    <input type="submit" name="selectindex" value="Select">
                </form>
                </td>
            </tr>

        <?php
        }
        ?>
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