<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--<link href="css/print.css" rel="stylesheet" type="text/css" media="screen,projection,print" />-->
    <style type='text/css' media='print'>
        @page {
            size: A4;
            size: portrait
        }

        #btnPrint {
            display: none
        }
    </style>
    <title>Academic Transcript - Student Management System - Buddhist & Pali University of Sri Lanka</title>
    <style type="text/css" media="all">
        @page {
            size: A4 portrait;
            margin: 1.0in;
            border: thin solid black;
            padding: 1em;

            @bottom-center {
                content: element(footer);
            }

            @top-center {
                content: element(header);
            }
        }

        #page-header {
            display: block;
            position: running(header);
        }

        #page-footer {
            display: block;
            position: running(footer);
        }

        .page-number:before {
            content: counter(page);
        }

        .page-count:before {
            content: counter(pages);
        }
    </style>
</head>

<body>
    <?php
    //2021-03-25 start  include('dbAccess.php');
    require_once("dbAccess.php");
    $db = new DBOperations();
    $type = $db->cleanInput($_GET['lstType']);
    $indexNo = $db->cleanInput($_GET['indexNo']);
    $acYear = $db->cleanInput($_GET['acYear']);
    $acYear = $db->cleanInput($_GET['acYear']);
    $date = $db->cleanInput($_GET['date']);

    $result = $db->executeQuery("SELECT std.nameEnglish,std.degreeType,std.regNo,std.medium,fr.finalGPA,fr.class,sbj.semester,sbj.level FROM student as std,finalresults as fr,subject as sbj  WHERE std.indexNo=fr.indexNo and std.indexNo='$indexNo';");
    if ($db->Row_Count($result) == 0) die("The student with index number $indexNo has not details");

    while ($row1 = $db->Next_Record($result)) {

        $studentName = $row1['nameEnglish'];
        $regNo = $row1['regNo'];
        $degreeType = $row1['degreeType'];
        $finalGPA = $row1['finalGPA'];
        $class = $row1['class'];
        $medium = $row1['medium'];
        $semester = $row1['semester'];
        $level = $row1['level'];
    }
    ?>
    <div align="right"><input type="button" id="btnPrint" value="Print" onClick="window.print();return false" /></div>
    <br />
    <br />
    <br />
    <br />
    <p align="right">Date of Issue : <?php echo date('d-m-Y'); ?></p>
    <hr border="2">
    <?php

    echo "<h1 align='center'><u>Bachelor Of Arts(General) Degree Examination</u></h1>";
    echo "<label>Full Name Of Student:</label> $studentName <br> <label>Index No:</label>  $indexNo <br><label>Final GPA:</label>$finalGPA 
    <br><label>Final Result:</label>
    <br><label>Effective Date Of The Grade:</label>$date ";

    ?>


    <form action="" method="post">

        </br>


        <H2 align="center">TRANSCRIPT OF COURSE UNITS AND GRADES</H2>
        <table width="1000" border="1">


            <tr>
                <th>Level</th>
                <th>Course Unit</th>
                <th>Course Title</th>
                <th>Grade</th>
            </tr>

            <?php

            
            $result = $db->executeQuery("SELECT sbj.subjectID,sbj.codeEnglish,sbj.nameEnglish,exe.grade,sbj.level,sbj.semester FROM subject as sbj,exameffort as exe  WHERE  sbj.subjectID=exe.subjectID and exe.indexNo='$indexNo' and sbj.level='I' and sbj.semester='First Semester';");

            $result2 = $db->executeQuery("SELECT sbj.subjectID FROM subject as sbj,exameffort as exe  WHERE  sbj.subjectID=exe.subjectID and exe.indexNo='$indexNo' and sbj.level='I' and sbj.semester='First Semester' ; ");
            $num_rows = mysqli_num_rows($result2);
            $num_rowsc = $num_rows+1;
            ?>
            <?php

            
            echo "<td rowspan='$num_rowsc' align='center'>one</td>";
            while ($row = $db->Next_Record($result))
            //2021.03.25 end
            {
            ?>

                <tr>                
                    <td><?php echo $row['codeEnglish']; ?></td>
                    <td><?php echo $row['nameEnglish']; ?></td>
                    <td><?php echo $row['grade']; ?></td>

                </tr>


            <?php

            }
            
            ?>


            <?php
            $result = $db->executeQuery("SELECT sbj.subjectID,sbj.codeEnglish,sbj.nameEnglish,exe.grade,sbj.level,sbj.semester FROM subject as sbj,exameffort as exe  WHERE  sbj.subjectID=exe.subjectID and exe.indexNo='$indexNo' and sbj.level='I' and sbj.semester='Second Semester';");

            $result2 = $db->executeQuery("SELECT sbj.subjectID FROM subject as sbj,exameffort as exe  WHERE  sbj.subjectID=exe.subjectID and exe.indexNo='$indexNo' and sbj.level='I' and sbj.semester='Second Semester' ; ");
            $num_rows = mysqli_num_rows($result2);
            $num_rowsc = $num_rows+1;
            ?>
            <?php

            
            echo "<td rowspan='$num_rowsc' align='center'>Two</td>";
            while ($row = $db->Next_Record($result))
            //2021.03.25 end
            {
            ?>

                <tr>                
                    <td><?php echo $row['codeEnglish']; ?></td>
                    <td><?php echo $row['nameEnglish']; ?></td>
                    <td><?php echo $row['grade']; ?></td>

                </tr>


            <?php

            }
            ?>
             <?php
            $result = $db->executeQuery("SELECT sbj.subjectID,sbj.codeEnglish,sbj.nameEnglish,exe.grade,sbj.level,sbj.semester FROM subject as sbj,exameffort as exe  WHERE  sbj.subjectID=exe.subjectID and exe.indexNo='$indexNo' and sbj.level='I' and sbj.semester='Third Semester';");

            $result2 = $db->executeQuery("SELECT sbj.subjectID FROM subject as sbj,exameffort as exe  WHERE  sbj.subjectID=exe.subjectID and exe.indexNo='$indexNo' and sbj.level='I' and sbj.semester='Third Semester' ; ");
            $num_rows = mysqli_num_rows($result2);
            $num_rowsc = $num_rows+1;
            ?>
            <?php

            
            echo "<td rowspan='$num_rowsc' align='center'>Three</td>";
            while ($row = $db->Next_Record($result))
            //2021.03.25 end
            {
            ?>

                <tr>                
                    <td><?php echo $row['codeEnglish']; ?></td>
                    <td><?php echo $row['nameEnglish']; ?></td>
                    <td><?php echo $row['grade']; ?></td>

                </tr>


            <?php

            }
            ?>

        </table>




        <br />
        <table width="1000" border="0">
            <tr>
                <td valign="top" width="50%">
                    <table border="1" width="100%">

                        <tr>
                            <td width="15%"><b>Medium&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> </td>
                            <td width="50%"><b><?php echo "$medium"; ?></b></td>

                        </tr>
                        <tr>
                            <td width="15%"><b>Grade Point Average&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b></td>
                            <td width="50%"><b><?php echo "$finalGPA"; ?></b></td>

                        </tr>
                        <tr>
                            <td width="15%"><b>Effective date of the degree:</b></td>
                            <td width="50%"><b><?php echo "$date"; ?></b></td>

                        </tr>
                    </table>

                    <br />
                    <table border="0" width="100%">
                        <tr valign="top">
                            <td width="30%"><b>Prepared by:</b></td>
                            <td width="30%"><b>Checked by I:</b></td>
                            <td width="30%"><b>Checked by II:</b></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                    </table>

                    <div align='left'>
                        <pre><b>
<b>xxxxxxxxxxxxxxxxxxx</b>
<b>Asst. Registar (Examinations)</b>
<b>for Registar</b>    

</pre>
                    </div>
        </table>
        </td>
    </form>
    <br>


</body>

</html>