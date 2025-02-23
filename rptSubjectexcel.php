<?php
include('dbAccess.php');
$db = new DBOperations();


###excel####

$filename = "Student Subject Enrollment Report.xls";
$contents = "testdata1 \t testdata2 \t testdata3 \t \n";
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename=' . $filename);

###excel####

$acYear = $db->cleanInput($_GET['acYear']);
$level = $db->cleanInput($_GET['level']);
$semester = $db->cleanInput($_GET['semester']);
$variablQuery



    ?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Select Subject Enrollment Report - Student Management System - Buddhist & Pali University of Sri Lanka
    </title>
    <script type="text/javascript" src="lib/tablesort/tablesort.js"></script>
    <link href="css/print.css" rel="stylesheet" type="text/css" media="screen,print,projection" />
    <style type='text/css' media='print'>
        @page {
            size: A4;
            size: landscape
        }

        #btnPrint {
            display: none
        }
    </style>

    <div align="right"><input type="button" id="btnPrint" value="Print" onClick="window.print();return false" /></div>
    <h1 align="center">
        <font size="+3">Select Subject Enrollment Report</font>
    </h1>
    <h2 align="center">
        <font size="+2">
            <?php echo $acYear ?> Subject Enrollment Report
        </font>
    </h2>

</head>
<?php
$querysubject="SELECT nameEnglish From subject ";


$resultsubject = $db->executeQuery($querysubject);
if($resultsubject->num_rows>0){


?>

<table align="center" border="1" cellpadding="2" cellspacing="2">
    <thead>
        <tr>

            <th class="sortable-numeric" rowspan="2">
                <font>Registration No</font>
            </th>
            <th colspan="9">Subject Name</th>
            <tr>
            <?php 
            // Loop through the result to print each subject name as a column header
            while ($rows = $db->Next_Record($resultsubject)) {
                echo "<th>" . $rows['nameEnglish'] . "</th>";
            }
        }
            ?>

            </tr>
            
          
        </tr>  

    </thead>

    <tbody>
        <?php
        $query="SELECT studentenrolment.regNo,studentenrolment.subjectID,subject.subjectID ,studentenrolment.acYear
        FROM studentenrolment JOIN subject ON studentenrolment.subjectID=subject.subjectID 
        WHERE studentenrolment.subjectID= subject.subjectID AND acYear=$acYear";

        $result=$db->executeQuery($query);
        while($row=$db->Next_Record($result)){
        ?>
       <tr>
        <td><?php echo $row['regNo']?></td>
        <?php
        if($rows['nameEnglish']){
            echo "<td>YES</td>";
        }else{
            echo "<td>NO</td>";
        }
        ?>
       </tr>
       <?php
       }?>
    </tbody>

</table>

</html>