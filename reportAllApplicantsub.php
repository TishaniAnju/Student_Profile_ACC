<?php
// Buffer larger content areas like the main page content
ob_start();
?>

<h1>All Applicant Report</h1>

<?php

require_once("dbAccess.php");
$db = new DBOperations();

//include("authcheck.inc.php");

// Check if the Report button (English) is clicked
if (isset($_POST['btnSubmit2'])) {
    $entryYear = $_POST['lstEntryYear'];
    $appType = $_POST['applicanttype'];
    // Redirect to the English report page
    header("location:rptAllApplicants_esub.php?entryYear=$entryYear&appType=$appType");
}

// Check if the Excel Report button is clicked
if (isset($_POST['btnSubmit3'])) {
    $entryYear = $_POST['lstEntryYear'];
    $appType = $_POST['applicanttype'];
    // Redirect to the Excel report page
    header("location:rptAllApplicants_excelsub.php?entryYear=$entryYear&appType=$appType");
}

?>
<form method="post" action="" class="plain">
    <table class="searchResults">
        <tr>
            <td>Entry Year :</td>
            <td>
                <select name="lstEntryYear" id="lstEntryYear" size="auto">
                    <?php
                    // Fetch distinct entry years from the database
                    $result = $db->executeQuery("SELECT DISTINCT entryYear FROM applicant");
                    while ($resultSet = $db->Next_Record($result)) {
                        $rEntryYear = $resultSet["entryYear"];
                        echo "<option value=\"$rEntryYear\">$rEntryYear</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Applicant Type:</td>
            <td>
                <select name="applicanttype" id="applicanttype" tabindex="4">
                    <option value="Local">Local Applicant</option>
                    <option value="Foreign">Foreign Applicant</option>
                </select>
            </td>
        </tr>
    </table>
    <br /><br />
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="btnSubmit2" type="submit" value="Report-English" class="button">
        <input name="btnSubmit3" type="submit" value="Excel-Report" class="button">
        <input name="btnCancel" type="button" value="Cancel" onClick="document.location.href = 'home.php';" class="button" />
    </p>
</form>

<?php
// Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Applicants Report - Student Management System - Buddhisht & Pali University of Sri Lanka";
$navpath = "<ul><li><a href='home.php'>Home </a></li><li>Applicants Report</ul>";
// Apply the template
include("master_registration.php");
?>
