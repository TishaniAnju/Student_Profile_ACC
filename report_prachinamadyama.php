<?php
ob_start();
?>

<h1> Report of Applicants who have passed Prachina Madyama Examination.</h1>

<?php
require_once("dbAccess.php");
$db = new DBOperations();
//include("authcheck.inc.php");

if (isset($_POST['btnSubmit'])) {
    // Handle form submission
    $entryYear = $_POST['lstEntryYear'];
    $title = $_POST['title'];

    header("Location: rpt_prachina-madyama.php?entryYear=$entryYear&title=$title");
    exit();
}

if (isset($_POST['btnSubmit1'])) {
    // Handle form submission1
    $entryYear = $_POST['lstEntryYear'];
    $title = $_POST['title'];

    header("Location: rpt_prachina-madyamaSinhala.php?entryYear=$entryYear&title=$title");
    exit();
}
if (isset($_POST['btnSubmit2'])) {
    // Handle form submission2
    $entryYear = $_POST['lstEntryYear'];
    $title = $_POST['title'];

    header("Location: rpt_prachina-madyamaExcel.php?entryYear=$entryYear&title=$title");
    exit();
}
if (isset($_POST['btnSubmit3'])) {
    // Handle form submission3
    $entryYear = $_POST['lstEntryYear'];
    $title = $_POST['title'];

    header("Location: rpt_prachina-madyamaExcelSinhala.php?entryYear=$entryYear&title=$title");
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
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="btnSubmit" type="submit" value="Report" class="button">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="btnSubmit1" type="submit" value="Report-Sinhala" class="button">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="btnSubmit2" type="submit" value="Report-Excel(English)" class="button">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="btnSubmit3" type="submit" value="Report-Excel(Sinhala)" class="button">
</form>

<?php
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Applicants Report - Student Management System - Buddhist & Pali University of Sri Lanka";
$navpath = "<ul><li><a href='home.php'>Home </a></li><li>Applicants Report</ul>";
include("master_registration.php");
?>
