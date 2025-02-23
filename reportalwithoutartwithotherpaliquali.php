<?php
ob_start();
?>

<h1> Report of Applicants who have passed A/L without Art Stream with Other Pali qualification </h1>

<?php
require_once("dbAccess.php");
$db = new DBOperations();
//include("authcheck.inc.php");

if (isset($_POST['btnSubmit'])) {
    // Handle form submission
    $entryYear = $_POST['lstEntryYear'];
    $al=$_POST['alYr'];
    $title = $_POST['title'];

    // Redirect to rptreject_report.php with selected parameters
    header("Location: rptalwithoutart.php?entryYear=$entryYear&al=$al&title=$title");
    exit();
}
if (isset($_POST['btnSubmit1'])) {
    // Handle form submission
    $entryYear = $_POST['lstEntryYear'];
    $al=$_POST['alYr'];
    $title = $_POST['title'];

    // Redirect to rptreject_report.php with selected parameters
    header("Location: rptalwithoutartsinhala.php?entryYear=$entryYear&al=$al&title=$title");
    exit();
}
if (isset($_POST['btnSubmit2'])) {
    // Handle form submission
    $entryYear = $_POST['lstEntryYear'];
    $title = $_POST['title'];

    // Redirect to rptreject_report.php with selected parameters
    header("Location: rprejectexcel.php?entryYear=$entryYear&title=$title");
    exit();
}
?>

<form method="post" action="" class="plain">
<table class="searchResults">
        <tr>
            <td>Entry Year : </td>
            <td>
                <select name="lstEntryYear" id="lstEntryYear" size="auto">
                    
                    <?php
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
            <td>A/L Year:</td>
            <td>
                <select name="alYr" id="alYr" size="auto">
                    <?php
                    $result = $db->executeQuery("SELECT DISTINCT alYear FROM localapplicant");

                    while ($resultSet = $db->Next_Record($result)) {
                        $ralYear = $resultSet["alYear"];
                        echo "<option value=\"$ralYear\">$ralYear</option>";
                    }

                    ?>
                </select>
            </td>
        </tr>
        <tr></tr>
            <td>Title : </td>
            <td>
                <select name="title" id="title" size="auto">
				<option value="all">All</option>
                    <?php
                    $result = $db->executeQuery("SELECT DISTINCT titleE FROM applicant");
                    while ($resultSet = $db->Next_Record($result)) {
                        $rtitle = $resultSet["titleE"];
                        echo "<option value=\"$rtitle\">$rtitle</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
    </table>
    <br/><br/>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="btnSubmit" type="submit" value="Report" class="button">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="btnSubmit1" type="submit" value="Report-Sinhala" class="button">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="btnSubmit2" type="submit" value="Report-Excel" class="button">
    </p>
</form>

<?php
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Applicants Report - Student Management System - Buddhist & Pali University of Sri Lanka";
$navpath = "<ul><li><a href='home.php'>Home </a></li><li>Applicants Report</ul>";
include("master_registration.php");
?>
