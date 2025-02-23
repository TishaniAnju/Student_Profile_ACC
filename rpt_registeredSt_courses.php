<?php
include('dbAccess.php');
$db = new DBOperations();

// $degreeId = $db->cleanInput($_GET['sid']);
// $title = $db->cleanInput($_GET['title']);
$level =  $db->cleanInput($_GET['level']);
$sem =  $db->cleanInput($_GET['semester']);
$acYear =  $db->cleanInput($_GET['acyear']);
if ($level == 'I') {
    $L = "First year";
} else if ($level == 'II') {
    $L = "Second year";
} else if ($level == 'III') {
    $L = "Third year";
} else if ($level == 'IV') {
    $L = "Fourth year";
}
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

    <h2 align="center">
        <font face="kaputadotcom2004" size="+2">
            Who have registered Certificate Course & Advanced Certificate Course - Student list(
            <?php
            echo $L . "/" . $sem . "/" . $acYear;
            ?>)</font>
    </h2>
</head>
<?php
if ($level == 'I') {
    $queryCourses = "SELECT * FROM certificate_course
    -- JOIN courseenrolment ON certificate_course.course_code = courseenrolment.courseID
    WHERE certificate_course.1styear = 'yes'
    ";
    $resultCourse = $db->executeQuery($queryCourses);

    if ($resultCourse->num_rows > 0) {
        // Store subject IDs and names in arrays for easy access
        $courses = [];
        while ($rows = $db->Next_Record($resultCourse)) {
            $courses[$rows['course_code']] = $rows['coursenameE'];
        }
    }
?>
    <table border="1" cellpadding="2" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="sortable-numeric" rowspan="4">
                    <font>No:</font>
                </th> <!-- index No-->
                <th rowspan="4" class="sortable-numeric">Registration No</th> <!-- Registration no-->
                <th rowspan="4">Student No</th> <!-- Student no-->
                <th rowspan="4">Medium</th> <!-- Medium -->

                <!-- Main "Courses" header spanning all courses -->
                <?php
                echo "<th colspan='" . count($courses) . "'>Courses</th>";
                ?>
            </tr>
            <tr>
                <?php
                // Loop through the courses array to create a subheader for each individual course
                foreach ($courses as $course_code => $coursenameE) {
                    echo "<th>$coursenameE</th>";
                }
                ?>
            </tr>



        </thead>
        <tbody>
            <?php

            if ($sem == 'all' && $acYear == 'all') {
                $query = "SELECT student.medium, courseenrolment.regNo,courseenrolment.indexNo, courseenrolment.courseID  
                FROM `student`
                JOIN `courseenrolment` ON student.regNo = courseenrolment.regNo
                WHERE courseenrolment.st_level= '$level' ORDER BY `regNo`";
                $result = $db->executeQuery($query);
                // $nxtresult = $db->Next_Record($result);
                // echo $nxtresult;
                $students = [];
                while ($row = $db->Next_Record($result)) {
                    $regNo = $row['regNo'];
                    if (!isset($students[$regNo])) {
                        $students[$regNo] = [
                            'indexNo' => $row['indexNo'],
                            'medium' => $row['medium'],
                            'registered_courses' => []
                        ];
                    }
                    $students[$regNo]['registered_courses'][] = $row['courseID'];
                }

                // Check if there are results
                if ($result->num_rows > 0) {
                    $i = 1;
                    foreach ($students as $regNo => $student) {
                        echo "<tr>";
                        echo "<td align='center'>{$i}";
                        // print_r($student);
                        echo "</td>"; // Row number
                        echo "<td>{$regNo}</td>";           // Registration Number
                        echo "<td>{$student['indexNo']}</td>";  // Index Number
                        echo "<td>{$student['medium']}</td>";   // Medium

                        // Loop through all courses and check registration status
                        foreach ($courses as $course_code => $coursenameE) {
                            if (in_array($course_code, $student['registered_courses'])) {
                                echo "<td>Yes</td>";
                            } else {
                                echo "<td>No</td>";
                            }
                        }

                        echo "</tr>";
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='4'>No data found</td></tr>";
                }
            }

            if ($sem != 'all'  && $acYear == 'all') {
                $query = "SELECT student.medium, courseenrolment.regNo,courseenrolment.indexNo, courseenrolment.courseID  
                FROM `student`
                JOIN `courseenrolment` ON student.regNo = courseenrolment.regNo
                WHERE courseenrolment.st_level= '$level'
                AND courseenrolment.Semester = '$sem' ORDER BY `regNo`";
                $result = $db->executeQuery($query);
                // $nxtresult = $db->Next_Record($result);
                // echo $nxtresult;
                $students = [];
                while ($row = $db->Next_Record($result)) {
                    $regNo = $row['regNo'];
                    if (!isset($students[$regNo])) {
                        $students[$regNo] = [
                            'indexNo' => $row['indexNo'],
                            'medium' => $row['medium'],
                            'registered_courses' => []
                        ];
                    }
                    $students[$regNo]['registered_courses'][] = $row['courseID'];
                }

                // Check if there are results
                if ($result->num_rows > 0) {
                    $i = 1;
                    foreach ($students as $regNo => $student) {
                        echo "<tr>";
                        echo "<td align='center'>{$i}</td>"; // Row number
                        echo "<td>{$regNo}</td>";           // Registration Number
                        echo "<td>{$student['indexNo']}</td>";  // Index Number
                        echo "<td>{$student['medium']}</td>";   // Medium

                        // Loop through all courses and check registration status
                        foreach ($courses as $course_code => $coursenameE) {
                            if (in_array($course_code, $student['registered_courses'])) {
                                echo "<td>Yes</td>";
                            } else {
                                echo "<td>No</td>";
                            }
                        }

                        echo "</tr>";
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='4'>No data found</td></tr>";
                }
            }

            if ($sem != 'all'  && $acYear != 'all') {
                $query = "SELECT student.medium, courseenrolment.regNo,courseenrolment.indexNo, courseenrolment.courseID  
                    FROM `student`
                    JOIN `courseenrolment` ON student.regNo = courseenrolment.regNo
                    WHERE courseenrolment.st_level= '$level'
                    AND courseenrolment.Semester = '$sem'
                    AND student.yearEntry = '$acYear' ORDER BY `regNo`";
                $result = $db->executeQuery($query);
                // $nxtresult = $db->Next_Record($result);

                $students = [];
                while ($row = $db->Next_Record($result)) {
                    $regNo = $row['regNo'];
                    if (!isset($students[$regNo])) {
                        $students[$regNo] = [
                            'indexNo' => $row['indexNo'],
                            'medium' => $row['medium'],
                            'registered_courses' => []
                        ];
                    }
                    $students[$regNo]['registered_courses'][] = $row['courseID'];
                }
                // Check if there are results
                if ($result->num_rows > 0) {
                    $i = 1;
                    foreach ($students as $regNo => $student) {
                        echo "<tr>";
                        echo "<td align='center'>{$i}</td>"; // Row number
                        echo "<td>{$regNo}</td>";           // Registration Number
                        echo "<td>{$student['indexNo']}</td>";  // Index Number
                        echo "<td>{$student['medium']}</td>";   // Medium

                        // Loop through all courses and check registration status
                        foreach ($courses as $course_code => $coursenameE) {
                            if (in_array($course_code, $student['registered_courses'])) {
                                echo "<td>Yes</td>";
                            } else {
                                echo "<td>No</td>";
                            }
                        }

                        echo "</tr>";
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='4'>No data found</td></tr>";
                }
            }
            ?>
        </tbody>
    </table>
<?php } elseif ($level == 'II') {
    $queryCourses = "SELECT * FROM certificate_course
    -- JOIN courseenrolment ON certificate_course.course_code = courseenrolment.courseID
    WHERE certificate_course.2ndyear = 'yes'
    ";
    $resultCourse = $db->executeQuery($queryCourses);

    if ($resultCourse->num_rows > 0) {
        // Store subject IDs and names in arrays for easy access
        $courses = [];
        while ($rows = $db->Next_Record($resultCourse)) {
            $courses[$rows['course_code']] = $rows['coursenameE'];
        }
    }
?>
    <table border="1" cellpadding="2" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="sortable-numeric" rowspan="4">
                    <font>No:</font>
                </th> <!-- index No-->
                <th rowspan="4" class="sortable-numeric">Registration No</th> <!-- Registration no-->
                <th rowspan="4">Student No</th> <!-- Student no-->
                <th rowspan="4">Medium</th> <!-- Medium -->

                <!-- Main "Courses" header spanning all courses -->
                <?php
                echo "<th colspan='" . count($courses) . "'>Courses</th>";
                ?>
            </tr>
            <tr>
                <?php
                // Loop through the courses array to create a subheader for each individual course
                foreach ($courses as $course_code => $coursenameE) {
                    echo "<th>$coursenameE</th>";
                }
                ?>
            </tr>



        </thead>
        <tbody>
            <?php

            if ($sem == 'all' && $acYear == 'all') {
                $query = "SELECT student.medium, courseenrolment.regNo,courseenrolment.indexNo, courseenrolment.courseID  
            FROM `student`
            JOIN `courseenrolment` ON student.regNo = courseenrolment.regNo
            WHERE courseenrolment.st_level= '$level' ORDER BY `regNo`";
                $result = $db->executeQuery($query);
                // $nxtresult = $db->Next_Record($result);
                // echo $nxtresult;
                $students = [];
                while ($row = $db->Next_Record($result)) {
                    $regNo = $row['regNo'];
                    if (!isset($students[$regNo])) {
                        $students[$regNo] = [
                            'indexNo' => $row['indexNo'],
                            'medium' => $row['medium'],
                            'registered_courses' => []
                        ];
                    }
                    $students[$regNo]['registered_courses'][] = $row['courseID'];
                }

                // Check if there are results
                if ($result->num_rows > 0) {
                    $i = 1;
                    foreach ($students as $regNo => $student) {
                        echo "<tr>";
                        echo "<td align='center'>{$i}";
                        // print_r($student);
                        echo "</td>"; // Row number
                        echo "<td>{$regNo}</td>";           // Registration Number
                        echo "<td>{$student['indexNo']}</td>";  // Index Number
                        echo "<td>{$student['medium']}</td>";   // Medium

                        // Loop through all courses and check registration status
                        foreach ($courses as $course_code => $coursenameE) {
                            if (in_array($course_code, $student['registered_courses'])) {
                                echo "<td>Yes</td>";
                            } else {
                                echo "<td>No</td>";
                            }
                        }

                        echo "</tr>";
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='4'>No data found</td></tr>";
                }
            }

            if ($sem != 'all'  && $acYear == 'all') {
                $query = "SELECT student.medium, courseenrolment.regNo,courseenrolment.indexNo, courseenrolment.courseID  
            FROM `student`
            JOIN `courseenrolment` ON student.regNo = courseenrolment.regNo
            WHERE courseenrolment.st_level= '$level'
            AND courseenrolment.Semester = '$sem' ORDER BY `regNo`";
                $result = $db->executeQuery($query);
                // $nxtresult = $db->Next_Record($result);
                // echo $nxtresult;
                $students = [];
                while ($row = $db->Next_Record($result)) {
                    $regNo = $row['regNo'];
                    if (!isset($students[$regNo])) {
                        $students[$regNo] = [
                            'indexNo' => $row['indexNo'],
                            'medium' => $row['medium'],
                            'registered_courses' => []
                        ];
                    }
                    $students[$regNo]['registered_courses'][] = $row['courseID'];
                }

                // Check if there are results
                if ($result->num_rows > 0) {
                    $i = 1;
                    foreach ($students as $regNo => $student) {
                        echo "<tr>";
                        echo "<td align='center'>{$i}</td>"; // Row number
                        echo "<td>{$regNo}</td>";           // Registration Number
                        echo "<td>{$student['indexNo']}</td>";  // Index Number
                        echo "<td>{$student['medium']}</td>";   // Medium

                        // Loop through all courses and check registration status
                        foreach ($courses as $course_code => $coursenameE) {
                            if (in_array($course_code, $student['registered_courses'])) {
                                echo "<td>Yes</td>";
                            } else {
                                echo "<td>No</td>";
                            }
                        }

                        echo "</tr>";
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='4'>No data found</td></tr>";
                }
            }

            if ($sem != 'all'  && $acYear != 'all') {
                $query = "SELECT student.medium, courseenrolment.regNo,courseenrolment.indexNo, courseenrolment.courseID  
        FROM `student`
        JOIN `courseenrolment` ON student.regNo = courseenrolment.regNo
        WHERE courseenrolment.st_level= '$level'
        AND courseenrolment.Semester = '$sem'
        AND student.yearEntry = '$acYear' ORDER BY `regNo`";
                $result = $db->executeQuery($query);
                // $nxtresult = $db->Next_Record($result);

                $students = [];
                while ($row = $db->Next_Record($result)) {
                    $regNo = $row['regNo'];
                    if (!isset($students[$regNo])) {
                        $students[$regNo] = [
                            'indexNo' => $row['indexNo'],
                            'medium' => $row['medium'],
                            'registered_courses' => []
                        ];
                    }
                    $students[$regNo]['registered_courses'][] = $row['courseID'];
                }
                // Check if there are results
                if ($result->num_rows > 0) {
                    $i = 1;
                    foreach ($students as $regNo => $student) {
                        echo "<tr>";
                        echo "<td align='center'>{$i}</td>"; // Row number
                        echo "<td>{$regNo}</td>";           // Registration Number
                        echo "<td>{$student['indexNo']}</td>";  // Index Number
                        echo "<td>{$student['medium']}</td>";   // Medium

                        // Loop through all courses and check registration status
                        foreach ($courses as $course_code => $coursenameE) {
                            if (in_array($course_code, $student['registered_courses'])) {
                                echo "<td>Yes</td>";
                            } else {
                                echo "<td>No</td>";
                            }
                        }

                        echo "</tr>";
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='4'>No data found</td></tr>";
                }
            }
            ?>
        </tbody>
    </table>
    <?php } elseif ($level == 'III') {
        $queryCourses = "SELECT * FROM certificate_course
            -- JOIN courseenrolment ON certificate_course.course_code = courseenrolment.courseID
            WHERE certificate_course.3rdyear = 'yes'
            ";
        $resultCourse = $db->executeQuery($queryCourses);

        if ($resultCourse->num_rows > 0) {
            // Store subject IDs and names in arrays for easy access
            $courses = [];
            while ($rows = $db->Next_Record($resultCourse)) {
                $courses[$rows['course_code']] = $rows['coursenameE'];
            }
        }
    ?>
         <table border="1" cellpadding="2" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="sortable-numeric" rowspan="4">
                    <font>No:</font>
                </th> <!-- index No-->
                <th rowspan="4" class="sortable-numeric">Registration No</th> <!-- Registration no-->
                <th rowspan="4">Student No</th> <!-- Student no-->
                <th rowspan="4">Medium</th> <!-- Medium -->

                <!-- Main "Courses" header spanning all courses -->
                <?php
                echo "<th colspan='" . count($courses) . "'>Courses</th>";
                ?>
            </tr>
            <tr>
                <?php
                // Loop through the courses array to create a subheader for each individual course
                foreach ($courses as $course_code => $coursenameE) {
                    echo "<th>$coursenameE</th>";
                }
                ?>
            </tr>



        </thead>
        <tbody>
            <?php

            if ($sem == 'all' && $acYear == 'all') {
                $query = "SELECT student.medium, courseenrolment.regNo,courseenrolment.indexNo, courseenrolment.courseID  
                        FROM `student`
                        JOIN `courseenrolment` ON student.regNo = courseenrolment.regNo
                        WHERE courseenrolment.st_level= '$level' ORDER BY `regNo`";
                $result = $db->executeQuery($query);
                // $nxtresult = $db->Next_Record($result);
                // echo $nxtresult;
                $students = [];
                while ($row = $db->Next_Record($result)) {
                    $regNo = $row['regNo'];
                    if (!isset($students[$regNo])) {
                        $students[$regNo] = [
                            'indexNo' => $row['indexNo'],
                            'medium' => $row['medium'],
                            'registered_courses' => []
                        ];
                    }
                    $students[$regNo]['registered_courses'][] = $row['courseID'];
                }

                // Check if there are results
                if ($result->num_rows > 0) {
                    $i = 1;
                    foreach ($students as $regNo => $student) {
                        echo "<tr>";
                        echo "<td align='center'>{$i}";
                        // print_r($student);
                        echo "</td>"; // Row number
                        echo "<td>{$regNo}</td>";           // Registration Number
                        echo "<td>{$student['indexNo']}</td>";  // Index Number
                        echo "<td>{$student['medium']}</td>";   // Medium

                        // Loop through all courses and check registration status
                        foreach ($courses as $course_code => $coursenameE) {
                            if (in_array($course_code, $student['registered_courses'])) {
                                echo "<td>Yes</td>";
                            } else {
                                echo "<td>No</td>";
                            }
                        }

                        echo "</tr>";
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='4'>No data found</td></tr>";
                }
            }

            if ($sem != 'all'  && $acYear == 'all') {
                $query = "SELECT student.medium, courseenrolment.regNo,courseenrolment.indexNo, courseenrolment.courseID  
    FROM `student`
    JOIN `courseenrolment` ON student.regNo = courseenrolment.regNo
    WHERE courseenrolment.st_level= '$level'
    AND courseenrolment.Semester = '$sem' ORDER BY `regNo`";
                $result = $db->executeQuery($query);
                // $nxtresult = $db->Next_Record($result);
                // echo $nxtresult;
                $students = [];
                while ($row = $db->Next_Record($result)) {
                    $regNo = $row['regNo'];
                    if (!isset($students[$regNo])) {
                        $students[$regNo] = [
                            'indexNo' => $row['indexNo'],
                            'medium' => $row['medium'],
                            'registered_courses' => []
                        ];
                    }
                    $students[$regNo]['registered_courses'][] = $row['courseID'];
                }

                // Check if there are results
                if ($result->num_rows > 0) {
                    $i = 1;
                    foreach ($students as $regNo => $student) {
                        echo "<tr>";
                        echo "<td align='center'>{$i}</td>"; // Row number
                        echo "<td>{$regNo}</td>";           // Registration Number
                        echo "<td>{$student['indexNo']}</td>";  // Index Number
                        echo "<td>{$student['medium']}</td>";   // Medium

                        // Loop through all courses and check registration status
                        foreach ($courses as $course_code => $coursenameE) {
                            if (in_array($course_code, $student['registered_courses'])) {
                                echo "<td>Yes</td>";
                            } else {
                                echo "<td>No</td>";
                            }
                        }

                        echo "</tr>";
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='4'>No data found</td></tr>";
                }
            }

            if ($sem != 'all'  && $acYear != 'all') {
                $query = "SELECT student.medium, courseenrolment.regNo,courseenrolment.indexNo, courseenrolment.courseID  
        FROM `student`
        JOIN `courseenrolment` ON student.regNo = courseenrolment.regNo
        WHERE courseenrolment.st_level= '$level'
        AND courseenrolment.Semester = '$sem'
        AND student.yearEntry = '$acYear' ORDER BY `regNo`";
                $result = $db->executeQuery($query);
                // $nxtresult = $db->Next_Record($result);

                $students = [];
                while ($row = $db->Next_Record($result)) {
                    $regNo = $row['regNo'];
                    if (!isset($students[$regNo])) {
                        $students[$regNo] = [
                            'indexNo' => $row['indexNo'],
                            'medium' => $row['medium'],
                            'registered_courses' => []
                        ];
                    }
                    $students[$regNo]['registered_courses'][] = $row['courseID'];
                }
                // Check if there are results
                if ($result->num_rows > 0) {
                    $i = 1;
                    foreach ($students as $regNo => $student) {
                        echo "<tr>";
                        echo "<td align='center'>{$i}</td>"; // Row number
                        echo "<td>{$regNo}</td>";           // Registration Number
                        echo "<td>{$student['indexNo']}</td>";  // Index Number
                        echo "<td>{$student['medium']}</td>";   // Medium

                        // Loop through all courses and check registration status
                        foreach ($courses as $course_code => $coursenameE) {
                            if (in_array($course_code, $student['registered_courses'])) {
                                echo "<td>Yes</td>";
                            } else {
                                echo "<td>No</td>";
                            }
                        }

                        echo "</tr>";
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='4'>No data found</td></tr>";
                }
            }
            ?>
        </tbody>
    </table>
<?php } elseif ($level == 'IV') {
    $queryCourses = "SELECT * FROM certificate_course
            -- JOIN courseenrolment ON certificate_course.course_code = courseenrolment.courseID
            WHERE certificate_course.4thyear = 'yes'
            ";
    $resultCourse = $db->executeQuery($queryCourses);

    if ($resultCourse->num_rows > 0) {
        // Store subject IDs and names in arrays for easy access
        $courses = [];
        while ($rows = $db->Next_Record($resultCourse)) {
            $courses[$rows['course_code']] = $rows['coursenameE'];
        }
    }
?>
    <table border="1" cellpadding="2" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="sortable-numeric" rowspan="4">
                    <font>No:</font>
                </th> <!-- index No-->
                <th rowspan="4" class="sortable-numeric">Registration No</th> <!-- Registration no-->
                <th rowspan="4">Student No</th> <!-- Student no-->
                <th rowspan="4">Medium</th> <!-- Medium -->

                <!-- Main "Courses" header spanning all courses -->
                <?php
                echo "<th colspan='" . count($courses) . "'>Courses</th>";
                ?>
            </tr>
            <tr>
                <?php
                // Loop through the courses array to create a subheader for each individual course
                foreach ($courses as $course_code => $coursenameE) {
                    echo "<th>$coursenameE</th>";
                }
                ?>
            </tr>



        </thead>
        <tbody>
            <?php

            if ($sem == 'all' && $acYear == 'all') {
                $query = "SELECT student.medium, courseenrolment.regNo,courseenrolment.indexNo, courseenrolment.courseID  
                    FROM `student`
                    JOIN `courseenrolment` ON student.regNo = courseenrolment.regNo
                    WHERE courseenrolment.st_level= '$level' ORDER BY `regNo`";
                $result = $db->executeQuery($query);
                // $nxtresult = $db->Next_Record($result);
                // echo $nxtresult;
                $students = [];
                while ($row = $db->Next_Record($result)) {
                    $regNo = $row['regNo'];
                    if (!isset($students[$regNo])) {
                        $students[$regNo] = [
                            'indexNo' => $row['indexNo'],
                            'medium' => $row['medium'],
                            'registered_courses' => []
                        ];
                    }
                    $students[$regNo]['registered_courses'][] = $row['courseID'];
                }

                // Check if there are results
                if ($result->num_rows > 0) {
                    $i = 1;
                    foreach ($students as $regNo => $student) {
                        echo "<tr>";
                        echo "<td align='center'>{$i}";
                        // print_r($student);
                        echo "</td>"; // Row number
                        echo "<td>{$regNo}</td>";           // Registration Number
                        echo "<td>{$student['indexNo']}</td>";  // Index Number
                        echo "<td>{$student['medium']}</td>";   // Medium

                        // Loop through all courses and check registration status
                        foreach ($courses as $course_code => $coursenameE) {
                            if (in_array($course_code, $student['registered_courses'])) {
                                echo "<td>Yes</td>";
                            } else {
                                echo "<td>No</td>";
                            }
                        }

                        echo "</tr>";
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='4'>No data found</td></tr>";
                }
            }

            if ($sem != 'all'  && $acYear == 'all') {
                $query = "SELECT student.medium, courseenrolment.regNo,courseenrolment.indexNo, courseenrolment.courseID  
                FROM `student`
                JOIN `courseenrolment` ON student.regNo = courseenrolment.regNo
                WHERE courseenrolment.st_level= '$level'
                AND courseenrolment.Semester = '$sem' ORDER BY `regNo`";
                $result = $db->executeQuery($query);
                // $nxtresult = $db->Next_Record($result);
                // echo $nxtresult;
                $students = [];
                while ($row = $db->Next_Record($result)) {
                    $regNo = $row['regNo'];
                    if (!isset($students[$regNo])) {
                        $students[$regNo] = [
                            'indexNo' => $row['indexNo'],
                            'medium' => $row['medium'],
                            'registered_courses' => []
                        ];
                    }
                    $students[$regNo]['registered_courses'][] = $row['courseID'];
                }

                // Check if there are results
                if ($result->num_rows > 0) {
                    $i = 1;
                    foreach ($students as $regNo => $student) {
                        echo "<tr>";
                        echo "<td align='center'>{$i}</td>"; // Row number
                        echo "<td>{$regNo}</td>";           // Registration Number
                        echo "<td>{$student['indexNo']}</td>";  // Index Number
                        echo "<td>{$student['medium']}</td>";   // Medium

                        // Loop through all courses and check registration status
                        foreach ($courses as $course_code => $coursenameE) {
                            if (in_array($course_code, $student['registered_courses'])) {
                                echo "<td>Yes</td>";
                            } else {
                                echo "<td>No</td>";
                            }
                        }

                        echo "</tr>";
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='4'>No data found</td></tr>";
                }
            }

            if ($sem != 'all'  && $acYear != 'all') {
                $query = "SELECT student.medium, courseenrolment.regNo,courseenrolment.indexNo, courseenrolment.courseID  
        FROM `student`
        JOIN `courseenrolment` ON student.regNo = courseenrolment.regNo
        WHERE courseenrolment.st_level= '$level'
        AND courseenrolment.Semester = '$sem'
        AND student.yearEntry = '$acYear' ORDER BY `regNo`";
                $result = $db->executeQuery($query);
                // $nxtresult = $db->Next_Record($result);

                $students = [];
                while ($row = $db->Next_Record($result)) {
                    $regNo = $row['regNo'];
                    if (!isset($students[$regNo])) {
                        $students[$regNo] = [
                            'indexNo' => $row['indexNo'],
                            'medium' => $row['medium'],
                            'registered_courses' => []
                        ];
                    }
                    $students[$regNo]['registered_courses'][] = $row['courseID'];
                }
                // Check if there are results
                if ($result->num_rows > 0) {
                    $i = 1;
                    foreach ($students as $regNo => $student) {
                        echo "<tr>";
                        echo "<td align='center'>{$i}</td>"; // Row number
                        echo "<td>{$regNo}</td>";           // Registration Number
                        echo "<td>{$student['indexNo']}</td>";  // Index Number
                        echo "<td>{$student['medium']}</td>";   // Medium

                        // Loop through all courses and check registration status
                        foreach ($courses as $course_code => $coursenameE) {
                            if (in_array($course_code, $student['registered_courses'])) {
                                echo "<td>Yes</td>";
                            } else {
                                echo "<td>No</td>";
                            }
                        }

                        echo "</tr>";
                        $i++;
                    }
                } else {
                    echo "<tr><td colspan='4'>No data found</td></tr>";
                }
            }
            ?>
        </tbody>
    </table>
<?php } ?>
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