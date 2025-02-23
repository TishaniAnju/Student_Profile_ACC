<?php
//Buffer larger content areas like the main page content
ob_start();
?>
<script>
    function validate_Form(thisform) {
        //this function not used..
        with(thisform) {
            if (!validate_required(txtCourseNameE) || !validate_required(txtCourseNameS) ||
                !validate_required(txtCourseDuration) || !validate_required(txtCourseUnits) ||
                !validate_required(year1st) || !validate_required(year2snd) || !validate_required(year3rd) ||
                !validate_required(year4th) || !validate_required(certifypass)) {
                alert("One or more fields are kept blank.");
                return false;
            }
        }
    }
</script>
<?php
//start include('dbAccess.php');
require_once("dbAccess.php");
$db = new DBOperations();

if (isset($_POST['btnSubmit'])) {

    $cNameE = $db->cleanInput($_POST['txtCourseNameE']);
    $cNameS = $db->cleanInput($_POST['txtCourseNameS']);
    $cDuration = $db->cleanInput($_POST['txtCourseDuration']);
    $cNoUnits = $db->cleanInput($_POST['txtCourseUnits']);
    $year1 = $db->cleanInput($_POST['1styear']);
    $year2 = $db->cleanInput($_POST['2ndyear']);
    $year3 = $db->cleanInput($_POST['3rdyear']);
    $year4 = $db->cleanInput($_POST['4thyear']);
    $passCertificate = $db->cleanInput($_POST['certifypass']);

   if($passCertificate == 'want'){
    $inscerty ='y';
   }elseif($passCertificate == 'donot'){
    $inscerty ='n';
   }
    $queryInsert1 = "INSERT INTO certificate_course(course_code, coursenameE, coursenameS, duration, course_units, 1styear, 2ndyear, 3rdyear, 4thyear, passed_certificate)
                VALUES (NULL,'$cNameE','$cNameS','$cDuration','$cNoUnits','$year1','$year2','$year3','$year4','$inscerty')";
    $executequery1 = $db->executeQuery($queryInsert1);

    $querySelect1 = "SELECT * From certificate_course";
    $executequery1 = $db->executeQuery($querySelect1);
    $nextrec1 = $db->Next_Record($executequery1);
    $course_code = $nextrec1['course_code'];

    header("Location: certificate_course.php");
    exit();
}

?>

<h1> New Certificate Course </h1>
<br><br>
<form action="" method="POST">
    <table class="searchResults" width="260%">
        <!-- <tr>
            <td height="25" width="200"> Course Code</td>
            <td width="309">
                <input name="txtCourseCode" id="txtCourseCode" type="text" tabindex="1" size="20" style="font-size: larger;" <?php echo $course_code + 1; ?> disabled />
            </td>
        </tr> -->
        <tr>
            <td height="25" width="200"> Course Name (English)</td>
            <td width="309">
                <input name="txtCourseNameE" id="txtCourseNameE" type="text" tabindex="2" size="75" style="font-size: larger;" placeholder=" Course Name " required />
            </td>
        </tr>
        <tr>
            <td height="25" width="200"> පාඨමාලාවේ නම (සිංහල)</td>
            <td width="309">
                <input name="txtCourseNameS" id="txtCourseNameS" type="text" tabindex="3" size="75" style="font-size: larger;" placeholder=" පාඨමාලාවේ නම" required />
            </td>
        </tr>
        <tr>
            <td height="25" width="200"> Course Duration</td>
            <td width="309">
                <input name="txtCourseDuration" id="txtCourseDuration" type="text" tabindex="4" size="20" style="font-size: larger;" placeholder=" Course Duration" required />
            </td>
        </tr>
        <tr>
            <td height="25" width="200"> No. of Units</td>
            <td width="309">
                <input name="txtCourseUnits" id="txtCourseUnits" type="text" tabindex="5" size="20" style="font-size: larger;" placeholder=" Number of Units" required />
            </td>
        </tr>

    </table>

    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <table class="searchResults" width="260%" colspan="2" id="AddCourse">
        <tr>
            <td height="25" colspan='2'>
                <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
                    Due years :
                </font>
            </td>
        </tr>
        <tr>
            <td height="25" width="21%" style=" font-size: larger;">&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
                1st Year
            </td>
            <td>
                <input type="radio" name="1styear" id="year1st" value="yes" tabindex="6" required><label for=" yes" style="font-size: larger;"> Yes</label></input>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="1styear" id="year1st" value="no" tabindex="7" required><label for=" no" style="font-size: larger;"> No</label></input>
            </td>
        </tr>
        <tr>
            <td height="25" width="21%" style=" font-size: larger; border-bottom: black groove 1px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                2nd Year</td>
            <td class="ms-2">
                <input type="radio" name="2ndyear" id="year2nd" value="yes" tabindex="8" required> <label for=" yes" style="font-size: larger;"> Yes</label></input>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="2ndyear" id="year2nd" value="no" tabindex="9" required><label for=" no" style="font-size: larger;"> No</label></input>
            </td>
        </tr>
        <tr>
            <td height="25" width="21%" style="font-size: larger;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                3rd Year
            </td>
            <td>
                <input type="radio" name="3rdyear" id="year3rd" value="yes" tabindex="10" required> <label for=" yes" style="font-size: larger;"> Yes</label></input>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="3rdyear" id="year3rd" value="no" tabindex="11" required><label for=" no" style="font-size: larger;"> No</label></input>
            </td>
        </tr>
        <tr>
            <td height="25" width="21%" style="font-size: larger;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                4th Year

            </td>
            <td>
                <input type="radio" name="4thyear" id="year4th" value="yes" tabindex="12" required><label for=" yes" style="font-size: larger;"> Yes</label></input>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="4thyear" id="year4th" value="no" tabindex="13" required><label for=" no" style="font-size: larger;"> No</label></input>
            </td>
        </tr>
    </table>

    <table class="searchResults" width="260%" rowspan="3">
        <tr>
            &nbsp;

            <td height="25" width="21%" style="font-size: larger;" colspan="2" required># Is it necessary to complete this certificate course to start the advanced certificate course?</td>
        </tr>
        <tr>
            <td>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                <input type="radio" name="certifypass" id="certifypass" value="want" tabindex="14"><label for=" want" style="font-size: larger;"> Want</label></input>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="certifypass" id="certifypass" value="donot" tabindex="15"><label for=" donot" style="font-size: larger;"> Don't Want</label></input>
            </td>
        </tr>
        <tr>
            <td height="56" colspan="2">
                <div align="center">
                    <input name="btnCancel" id="btnCancel" type="button" value="Cancel" class="button" tabindex="16" onclick="document.location.href='certificate_course.php';" />
                    &nbsp;&nbsp;
                    <input type="submit" name="btnSubmit" id="btnSubmit" value="Submit" tabindex="17" class="button" />
                </div>
            </td>
        </tr>
    </table>
</form>

<?php
//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Certificate Course - Student Management System - Buddhist & Pali University of Sri Lanka";
$navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='certificate_course.php'>Certificate_Course </a></li><li>Add_New_Course</li></ul>";
//Apply the template
include("master_registration.php");
?>