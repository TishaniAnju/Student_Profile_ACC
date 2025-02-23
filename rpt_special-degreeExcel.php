<?php
include('dbAccess.php');
$db = new DBOperations();

$degreeId = $db->cleanInput($_GET['sid']);
$title = $db->cleanInput($_GET['title']);

$filename = "$degreeId-rpt_Special Degree Excel-English.xls";
$contents = "testdata1 \t testdata2 \t testdata3 \t \n";
header('Content-type: application/ms-excel');
header('Content-Disposition: attachment; filename=' . $filename);
?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Special Degree students Report - Student Management System - Buddhist & Pali University of Sri Lanka.</title>
    <script type="text/javascript" src="lib/tablesort/tablesort.js"></script>
    <link href="css/print.css" rel="stylesheet" type="text/css" media="screen,print,projection" />
    <style type='text/css' media='print'>
        @page {
            size: A3;
            size: landscape
        }

        #btnPrint {
            display: none
        }
    </style>

    <div align="right"><input type="button" id="btnPrint" value="Print" onClick="window.print();return false" /></div>
    <h1 align="center">
        <font size="+3">Buddhist and Pali University of Sri Lanka.</font>
    </h1>

    <?php

    $query = "SELECT `description` FROM special_degree WHERE `sid` = '$degreeId'";
    $result = $db->executeQuery($query);
    $resultSet = $db->Next_Record($result);
    // $desc = $resultSet['description'];
    ?>
    <h2 align="center">
        <font face="kaputadotcom2004" size="+2">

            <?php echo $resultSet['description']; ?> Special Degree - Student list(
            <?php
            if ($title == 'Ven.') {
                echo "Monks";
            } elseif ($title == 'Mr.') {
                echo "Boys";
            } elseif ($title == 'all') {
                echo "All";
            } elseif ($title == 'Ms.') {
                echo "Girls";
            } elseif ($title == 'Mrs.') {
                echo "Girls";
            } else {
                echo "...";
            } ?>)</font>
    </h2>
</head>

<table border="1" cellpadding="2" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th class="sortable-numeric">
                <font>No:</font>
            </th> <!-- index No-->
            <th >App No</th> <!-- Name-->
            <th >Name</th> <!-- Name-->
            <th  class="sortable-numeric">Index Number</th><!-- Index Number -->
            <th >N.I.C.</th>
            <th >Address</th>
            <th >Tel. No</th>
            <th >Entry Type</th><!-- Entry Type-->
            <th >Medium</th>
            <th >Faculty</th><!-- Faculty-->
        </tr>

    </thead>
    <tbody>
        <?php

        if ($title == 'all') {
            $query = "SELECT student.*, localapplicant.*
                FROM `student`
                JOIN `localapplicant` ON student.appNo = localapplicant.appNo
                WHERE student.spDegree= '$degreeId'";
            $result = $db->executeQuery($query);
            $i = 1;

            while ($row = $db->Next_Record($result)) {
                // Calculate age from DOB
                $dob = new DateTime($row['birthday']);
                $now = new DateTime();
                $age = $dob->diff($now)->y;

                // Output table row with age
        ?>

                <tr>
                    <td align="center"><?php echo $i; ?></td>
                    <td align="center"><?php echo $row['appNo']; ?></td>
                    <td><?php echo $row['nameEnglish']; ?></td>
                    <td align="center"><?php echo $row['indexNo']; ?></td>
                    <td align="center"><?php echo $row['nicNo']; ?></td>
                    <td ><?php echo $row['addressE1']; ?>
                        <?php echo $row['addressE2']; ?>
                        <?php echo $row['addressE3']; ?></td>
                    <td align="center"><?php echo $row['contactNo']; ?></td>
                    <td align="center"><?php echo $row['entryType'] ?></td>
                    <td align="center"><?php echo $row['medium']; ?></td>
                    <td ><?php echo $row['faculty']; ?></td>
                    <?php

                    $i++;
                    ?>
                </tr>
            <?php
            }
        }
        if ($title != 'all') {

            $query = "SELECT student.*, localapplicant.*
            FROM `student`
            JOIN `localapplicant` ON student.appNo = localapplicant.appNo
            WHERE student.spDegree= '$degreeId' and `student`.`title` = '$title'";
            $result = $db->executeQuery($query);
            $i = 1;

            while ($row = $db->Next_Record($result)) {
                // Calculate age from DOB
                $dob = new DateTime($row['birthday']);
                $now = new DateTime();
                $age = $dob->diff($now)->y;


            ?>
                <tr>
                    <td align="center"><?php echo $i; ?></td>
                    <td align="center"><?php echo $row['appNo']; ?></td>
                    <td><?php echo $row['nameEnglish']; ?></td>
                    <td align="center"><?php echo $row['indexNo']; ?></td>
                    <td align="center"><?php echo $row['nicNo']; ?></td>
                    <td ><?php echo $row['addressE1']; ?>
                        <?php echo $row['addressE2']; ?>
                        <?php echo $row['addressE3']; ?></td>
                    <td align="center"><?php echo $row['contactNo']; ?></td>
                    <td align="center"><?php echo $row['entryType'] ?></td>
                    <td align="center"><?php echo $row['medium']; ?></td>
                    <td ><?php echo $row['faculty']; ?></td>
                    <?php

                    $i++;
                    ?>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
</table>
<table>
    <tfoot>
        <tr height="30" style="border-bottom:none" style="border-left:none" style="border-right: none">
            <td bordercolor="#FFFFFF" colspan="5" width="20%">Prepared By :-.............................. </td>
            <td bordercolor="#FFFFFF" colspan="5" width="20%">Checked By :-................................... </td>
            <td bordercolor="#FFFFFF" colspan="6" width="25%">Assistant Registrar (Academic and Student Services):-................................ </td>
        </tr>
    </tfoot>
</table>

</html>