<?php
ob_start();
?>

<h1> Report of Special Degree students.</h1>

<?php
require_once("dbAccess.php");
$db = new DBOperations();
//include("authcheck.inc.php");

if (isset($_POST['btnSubmit'])) {
    // Handle form submission
    $degreeId = $_POST['dgreeName'];
    $title = $_POST['title'];
    header("Location: rpt_special-degree.php?sid=$degreeId&title=$title");
    exit();
}

// if (isset($_POST['btnSubmit1'])) {
//     // Handle form submission1
//     $degreeId = $_POST['dgreeName'];
//     $title = $_POST['title'];

//     header("Location: rpt_special-degreeSinhala.php?sid=$degreeId&title=$title");
//     exit();
// }
if (isset($_POST['btnSubmit2'])) {
    // Handle form submission2
    $degreeId = $_POST['dgreeName'];
    $title = $_POST['title'];

    header("Location: rpt_special-degreeExcel.php?sid=$degreeId&title=$title");
    exit();
}
// if (isset($_POST['btnSubmit3'])) {
//     // Handle form submission3
//     $degreeId = $_POST['dgreeName'];
//     $title = $_POST['title'];

//     header("Location: rpt_special-degreeExcelSinhala.php?sid=$degreeId&title=$title");
//     exit();
// }
?>

<form method="post" action="" class="plain">
<table class="searchResults">
        <tr>
            <td>Degree Name: </td>
            <td>
                <select name="dgreeName" id="dgreeName" size="auto">
                    
                    <?php
                    $result = $db->executeQuery("SELECT DISTINCT * FROM special_degree");
					
                    while ($resultSet = $db->Next_Record($result)) {
                        $degreeId = $resultSet["sid"];
                        $degreename = $resultSet["description"];
                        echo "<option value=\"$degreeId\">$degreeId - $degreename</option>";
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
                    $result = $db->executeQuery("SELECT DISTINCT title FROM student");
                    while ($resultSet = $db->Next_Record($result)) {
                        $rtitle = $resultSet["title"];
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
        
        <input name="btnSubmit2" type="submit" value="Report-Excel(English)" class="button">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        
</form>

<?php
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Special Degree Report - Student Management System - Buddhist & Pali University of Sri Lanka";
$navpath = "<ul><li><a href='home.php'>Home </a></li><li>Special Degree Report</ul>";
include("master_registration.php");
?>
