<?php
ob_start();

include('dbAccess.php');
$db = new DBOperations();
//include('authcheck.inc.php');
?>

<h1>Student Subject Enrollment Report</h1>
<form method="get" action="rptSubjectEnrollmentInfo.php" class="plain">
    <table class="searchResults">

        <tr>
            <!-- Entry Year selection -->
            <td>Entry Year : </td>
            <td><select name="acYear" id="acYear" size="auto">
                    <?php
                    $result = $db->executeQuery("SELECT DISTINCT acYear FROM studentenrolment");

                    //for ($i=0;$i<mysql_numrows($result);$i++)
                    while ($resultSet = $db->Next_Record($result)) {

                        $racYear = $resultSet["acYear"];
                        echo "<option value=\"" . $racYear . "\">" . $racYear . "</option>";
                    }
                    ?>
                </select></td>

        </tr>
        <tr>
            <!-- level selection -->
            <td>Level : </td>
            <td>
                <select name="level" id="level" size="auto">
                    <option value="All">All</option> <!-- Adding the 'All' option -->
                    <?php
                    $result = $db->executeQuery("SELECT DISTINCT level FROM subject");

                    while ($resultSet = $db->Next_Record($result)) {
                        $rlevel = $resultSet["level"];
                        echo "<option value=\"" . $rlevel . "\">" . $rlevel . "</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>

        <!-- Semester selection -->
        <td>Semester : </td>
        <td>
            <select name="semester" id="semester" size="auto" onchange="selectSemester(this.value)">
                <option value="All">All</option>
                <?php
                $result = $db->executeQuery("SELECT DISTINCT semester FROM subject");

                while ($resultSet = $db->Next_Record($result)) {
                    $rsemester = $resultSet["semester"];
                    echo $rsemester;
                    echo "<option value=\"" . $rsemester . "\">" . $rsemester . "</option>";
                }
                ?>
            </select>
        </td>


        </tr>



    </table>
    <br /><br />
    <p>&nbsp;&nbsp;&nbsp;<input name="btnCancel" type="button" value="Cancel"
            onclick="document.location.href = 'home.php';" class="button" />&nbsp;&nbsp;&nbsp;
        <!--<a href="rptApplicants.php" id="printLink" onClick="OpenPopup(this.href); return false">Click Here to See Popup</a>-->
        <input name="btnSubmit" type="submit" value="Excel Report" class="button">
    </p>


</form>





<?php
//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Enrollment Reports - Student Management System - Buddhisht & Pali University of Sri Lanka";
$navpath = "<ul><li><a href='home.php'>Home </a></li><li>Applicants Report</ul>";
//Apply the template
include("master_registration.php");
?>