<?php
ob_start();
?>

<h1> Nikaya Details</h1>

<?php
require_once("dbAccess.php");
$db = new DBOperations();

// Check if the form is submitted to add a new Nikaya
if (isset($_POST['addNikaya'])) {
    $nikayaName = $_POST['nikayaName'];
    $description = $_POST['description'];

    // Insert the new Nikaya into the 'nikaya' table
    $query = "INSERT INTO nikaya (nikayaName, description) VALUES ('$nikayaName', '$description')";
    $result = $db->executeQuery($query);

    // Redirect to the same page to avoid form resubmission
    header("Location: {$_SERVER['PHP_SELF']}");
    exit(); // Terminate script execution after redirection
}

// Check if the form is submitted to remove a Nikaya
if (isset($_POST['removeNikaya'])) {
    $nikayaID = $_POST['removeID'];

    // Delete the Nikaya from the 'nikaya' table
    $query = "DELETE FROM nikaya WHERE nikayaID = $nikayaID";
    $result = $db->executeQuery($query);

    // Redirect to the same page to avoid form resubmission
    header("Location: {$_SERVER['PHP_SELF']}");
    exit(); // Terminate script execution after redirection
}

// Retrieve Nikaya data from the 'nikaya' table
$query = "SELECT * FROM nikaya";
$result = $db->executeQuery($query);
?>

<!-- Display the form to add a new Nikaya -->
<form action="" method="post">
    <table style="margin-left:8px">
        <tr>
            <td height="28">Nikaya Name:</td>
            <td><input type="text" name="nikayaName" required></td>
        </tr>
        <tr>
            <td height="28">Description:</td>
            <td><input type="text" name="description"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="addNikaya" value="Submit"></td>
        </tr>
    </table>
</form>
<br />
<!-- Display the list of Nikayas -->
<table class="searchResults">
    <tr>
        <th>Nikaya ID</th>
        <th>Nikaya Name</th>
        <th>Description</th>
        <th>&nbsp;</th>
    </tr>
    <?php while ($row = $db->Next_Record($result)) { ?>
        <tr>
            <td><?php echo $row['nikayaID']; ?></td>
            <td><?php echo isset($row['nikayaName']) ? $row['nikayaName'] : ''; ?></td>
            <td><?php echo isset($row['description']) ? $row['description'] : ''; ?></td>
            <td>
                <!-- Display the remove form for each Nikaya -->
                <form action="" method="post">
                    <input type="hidden" name="removeID" value="<?php echo $row['nikayaID']; ?>">
                    <input type="submit" name="removeNikaya" value="Remove">
                </form>
            </td>
        </tr>
    <?php } ?>
</table>
    <br>&nbsp;
    <!-- Add hyperlink to 'chapter.php' -->
    <h3> <a href="chapter.php">chapters details >> </a> </h3>

<?php
//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Nikaya Details - Student Management System - Buddhists & Pali University of Sri Lanka";
$navpath = "<ul><li><a href='home.php'>Home </a></li><li>Nikaya Details</ul>";
//Apply the template
include("master_registration.php");
?>
