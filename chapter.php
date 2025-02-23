<?php
ob_start();
?>

<h1> Chapter Details</h1>

<?php
require_once("dbAccess.php");
$db = new DBOperations();

// Check if the form is submitted to add a new Chapter
if (isset($_POST['addChapter'])) {
    $nikayaName = $_POST['nikayaName'];
    $chapter = $_POST['chapter'];

    // Retrieve the corresponding nikayaID from the 'nikaya' table
    $query = "SELECT nikayaID FROM nikaya WHERE nikayaName = '$nikayaName'";
    $nikayaResult = $db->executeQuery($query);
    $nikayaRow = $db->Next_Record($nikayaResult);
    $nikayaID = $nikayaRow['nikayaID'];

    // Insert the new Chapter into the 'chapter' table with the retrieved nikayaID
    $query = "INSERT INTO chapter (nikayaID, chapter) VALUES ('$nikayaID', '$chapter')";
    $result = $db->executeQuery($query);

    // Redirect to the same page to avoid form resubmission
    header("Location: {$_SERVER['PHP_SELF']}");
    exit(); // Terminate script execution after redirection
}

// Check if the form is submitted to remove a Chapter
if (isset($_POST['removeChapter'])) {
    $chapterID = $_POST['removeID'];

    // Delete the Chapter from the 'chapter' table
    $query = "DELETE FROM chapter WHERE chapterID = $chapterID";
    $result = $db->executeQuery($query);

    // Redirect to the same page to avoid form resubmission
    header("Location: {$_SERVER['PHP_SELF']}");
    exit(); // Terminate script execution after redirection
}

// Retrieve Chapter data from the 'chapter' table
$query = "SELECT * FROM chapter";
$result = $db->executeQuery($query);

// Retrieve all distinct nikayaName values from the 'nikaya' table
$query = "SELECT DISTINCT nikayaName FROM nikaya";
$nikayaNamesResult = $db->executeQuery($query);
$nikayaNames = array();

while ($row = $db->Next_Record($nikayaNamesResult)) {
    $nikayaNames[] = $row['nikayaName'];
}
?>

<!-- Display the form to add a new Chapter -->
<form action="" method="post">
    <table style="margin-left:8px">
        <tr>
            <td height="28">Nikaya Name:</td>
            <td>
                <select name="nikayaName" required>
                    <?php foreach ($nikayaNames as $name) { ?>
                        <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td height="28"> Chapter:</td>
            <td><input type="text" name="chapter" size="75"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" name="addChapter" value="Submit"></td>
        </tr>
    </table>
</form>
<br />
<!-- Display the list of Chapters -->
<table class="searchResults">
    <tr>
        <th>Chapter ID</th>
       
        <th>Nikaya Name</th>
        <th>Chapter</th>
        <th>&nbsp;</th>
    </tr>
    <?php while ($row = $db->Next_Record($result)) { ?>
        <tr>
            <td><?php echo $row['chapterID']; ?></td>
            
            <td>
                <?php
                // Retrieve the nikayaName based on the nikayaID
                $nikayaID = isset($row['nikayaID']) ? $row['nikayaID'] : '';
                $nikayaNameQuery = "SELECT nikayaName FROM nikaya WHERE nikayaID = '$nikayaID'";
                $nikayaNameResult = $db->executeQuery($nikayaNameQuery);
                $nikayaNameRow = $db->Next_Record($nikayaNameResult);
                echo isset($nikayaNameRow['nikayaName']) ? $nikayaNameRow['nikayaName'] : '';
                ?>
            </td>
            <td><?php echo isset($row['chapter']) ? $row['chapter'] : ''; ?></td>
            <td>
                <!-- Display the remove form for each Chapter -->
                <form action="" method="post">
                    <input type="hidden" name="removeID" value="<?php echo $row['chapterID']; ?>">
                    <input type="submit" name="removeChapter" value="Remove">
                </form>
            </td>
        </tr>
    <?php } ?>
</table>

<br>&nbsp;
    <!-- Add hyperlink to 'chapter.php' -->
    <h3> <a href="nikaya.php">Nikaya details >> </a> </h3>

<?php
//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Chapter Details - Student Management System - Buddhists & Pali University of Sri Lanka";
$navpath = "<ul><li><a href='home.php'>Home </a></li><li>Chapter Details</ul>";
//Apply the template
include("master_registration.php");
?>
