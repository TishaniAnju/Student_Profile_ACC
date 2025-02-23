<?php
//Buffer larger content areas like the main page content
ob_start();
//session_start();
?><head>
 
 
<script language="javascript">

</script>

 <script>
 	function MsgOkCancel()
	{
		var message = "Please confirm to DELETE this item...";
		var return_value = confirm(message);
		return return_value;
	}
 </script>
 

</head>
<?php
include("dbAccess.php");
include("authcheck.inc.php");
if ((isset($_POST['submit']))||(isset($_POST['semesterGPA']))) {
    $indexNo = $_POST['indexNo'];
    $year = $_POST['year'];
    $level = $_POST['level'];
    $semester = $_POST['semester'];
    echo $semester;
}
?>


<h1>Semester GPA Calculation</h1>
<form action="" method="post">
    <table><tr>
            <td>Student Index Number : </td>
            <td><select name="indexNo" id="indexNo" required="true">

                    <?php
                    $result = executeQuery("SELECT distinct`indexNo` FROM `studentenrolment`");
                    echo "<option value='0'>All</option>";
                    while ($row = mysql_fetch_array($result)) {
                        echo "<option value='" . $row['indexNo'] . " '>" . $row['indexNo'] . "</option>";
                    }
                    ?>
                    <script>
                        document.getElementById("indexNo").value = "<?php echo $indexNo; ?>";
                    </script>
                </select><br></td>
        </tr>
        <tr>
            <td>Academic Year : </td>
            <td><select name="year" id="year" required="true">

                    <?php
                    $result = executeQuery("SELECT distinct`acYear` FROM `exameffort`");
                    echo "<option value='0'>All</option>";
                    while ($row = mysql_fetch_array($result)) {
                        echo "<option value='" . $row['acYear'] . "'>" . $row['acYear'] . "</option>";
                    }
                    ?>
                    <script>
                        document.getElementById("year").value = "<?php echo $year; ?>";
                    </script>
                </select><br></td>
        </tr>
        <tr>
            <td>Academic Level : </td>
            <td><select name="level" id="level" required="true">
                    <?php
                    $result = executeQuery("SELECT distinct `level` FROM `subject` ");
                    echo "<option value='0'>All</option>";
                    while ($row = mysql_fetch_array($result)) {
                        echo "<option value='" . $row['level'] . "'>" . $row['level'] . "</option>";
                    }
                    ?>
                    <script>
                        document.getElementById("level").value = "<?php echo $level; ?>";
                    </script>
                </select><br></td>
        </tr>
        <tr>
            <td>Academic Semester : </td>
            <td><select name="semester" id="semester" required="true">
                    <?php
                    $result = executeQuery("SELECT distinct `semester` FROM `subject` ");
                    echo "<option value='0'>All</option>";
                    while ($row = mysql_fetch_array($result)) {
                        echo "<option value='" . $row['semester'] . "'>" . $row['semester'] . "</option>";
                    }
                    ?>
                    <script>
                        document.getElementById("semester").value = "<?php echo $semester; ?>";
                    </script>
                </select><br></td>
        </tr>
    </table>
    <br><input type="submit" name="submit" value="submit"><br><br>



    <?php
    if (isset($_POST['submit'])) {

        echo"<table border='1'>";
        echo "<tr><td > Subject Code </td><td > Subject Name</td><td > Grade </td></tr>";
        $result = executeQuery("SELECT x.subjectID,s.codeEnglish,s.nameEnglish,x.grade FROM `exameffort` x,`subject` s WHERE x.indexNo='$indexNo' and x.acYear='$year' and s.semester='$semester' and  x.subjectID = s.subjectID");
        while ($row = mysql_fetch_array($result)) {
            echo "<tr>";
            echo "<td id='row2' name='row2'> $row[1] </td>";
            echo "<td id='row3' name='row3'> $row[2] </td>";
			 echo "<td id='row1' name='row1'> $row[3] </td>";
            echo "</tr>";
        }
        echo '</table><br>';

        echo "<input type='submit' name='semesterGPA' value='calculate semester GPA'><br><br>";
        echo '</form>';
    } else if (isset($_POST['semesterGPA'])) {

        $indexNo = $_POST['indexNo'];
        $year = $_POST['year'];
        $level = $_POST['level'];
        $semester = $_POST['semester'];
///////////////////////////////////Temp Table///subject ID and Credit Hours/////////////////////////
//    echo"<table border='1'>";
//    echo '<tr><td>Subject ID</td><td>Credit hours</td></tr>';
//    $result = executeQuery("select e.subjectID,s.creditHours from `studentenrolment` e,`subject` s where e.indexNo='$indexNo' and e.subjectID=s.subjectID and s.level='$level'and s.semester='$semester'");
//    while ($row = mysql_fetch_array($result)) {
//        echo "<tr>";
//        echo "<td id='row1' name='row1'> $row[0] </td>";
//        echo "<td id='row2' name='row2'> $row[1] </td>";
//        echo "</tr>";
//    }
////////////////////////////////Temp Table////////Subject ID and Gdare Points//////////////////////////
//    echo '<tr><td>Subject ID</td><td>Grade point</td></tr>';
//
//    $result2 = executeQuery("SELECT `subjectID` , `gradePoint` FROM `exameffort` WHERE `indexNo`='$indexNo' and `acYear`='$year' ");
//    while ($row = mysql_fetch_array($result2)) {
//        echo "<tr>";
//        echo "<td id='row1' name='row1'> $row[0] </td>";
//        echo "<td id='row2' name='row2'> $row[1] </td>";
//        echo "</tr>";
//    }
//    echo '</table>';
        echo"<table border='1'>";
        //calculation//
        $sumCreditaHours = 0;
        $sumGradePoint = 0;
        $sumA = 0;
        $sumB = 0;
        $sumC = 0;
        $sumD = 0;

        $result4 = executeQuery("select e.subjectID,s.creditHours from `studentenrolment` e,`subject` s where e.indexNo='$indexNo' and e.subjectID=s.subjectID and s.level='$level'and s.semester='$semester'");
	
        echo '<tr><td>Subject ID</td><td>Credit Hours(CH)</td><td>Grade Point(GP)</td><td>CH * GP</td><td>sum CH</td><td>sum GP</td></tr>';
        while ($row = mysql_fetch_array($result4)) {
            //calculate total credit hours//
            $sumCreditaHours = $sumCreditaHours + $row[1];

            $result3 = executeQuery("SELECT `gradePoint`,`effort` FROM `exameffort` WHERE `indexNo`='$indexNo' and subjectID='$row[0]' order by effort desc limit 1");
      
			$row3 = mysql_fetch_array($result3);
            //calculate total grade points///
            $sumGradePoint = $sumGradePoint + ( $row[1] * $row3[0]);

            $gradePoint = $row3[0];
            echo "<tr>";
            echo "<td id='row1' name='row1'>" . $row[0] . "</td>";
            echo "<td id='row2' name='row1'>" . $row[1] . "</td>";
            echo "<td id='row3' name='row1'>" . $row3[0] . "</td>";
            echo "<td id='row4' name='row2'>" . $row[1] * $row3[0] . " </td>";
            echo "<td id='row5' name='row1'>" . $sumCreditaHours . "</td>";
            echo "<td id='row6' name='row1'>" . $sumGradePoint . "</td>";
            echo "</tr>";

            //echo $gradePoint . '<br>';
            //count A,B,C,...
            if ($gradePoint == 4) {
                $sumA = $sumA + 1;
            } else if ((4 > $gradePoint) && ($gradePoint >= 3)) {
                $sumB = $sumB + 1;
            } else if ((3 > $gradePoint) && ($gradePoint >= 2)) {
                $sumC = $sumC + 1;
            } else {
                $sumD = $sumD + 1;
            }
        }
        $Aorabove = $sumA;
        $Borabove = $sumA + $sumB;
        $Corabove = $sumA + $sumB + $sumC;
        $totalSubjects = $sumA + $sumB + $sumC + $sumD;

        echo '</table>';
        echo 'A or above = ' . $sumA . '<br>';
        echo 'B or A = ' . ($sumA + $sumB ) . '<br>';
        echo 'C or B or A = ' . ($sumA + $sumB + $sumC ) . '<br>';

        $gpa = $sumGradePoint / $sumCreditaHours;
        $semesterGpa = round($gpa, 2);

        echo '<br>Semester GPA = ' . $semesterGpa . '<br>';
        //echo(round($gpa, 2) . "<br>");

        $value = executeQuery("SELECT * FROM `studentgpa` WHERE `indexNo`= '$indexNo' and `acYear`='$year' and `level`='$level' and `semester`='$semester'");
        if ($value) {
            $numRows = mysql_num_rows($value);
        } else {
            $numRows = 0;
        }
///////////////////////////////////////////////////////////////Insert and Update values///////////////////
        if ($numRows == 0) {
            executeQuery("INSERT INTO `studentgpa`(`indexNo`, `acYear`, `level`, `semester`,`totcredithours`, `totGPA`, `GPAsemester`, `Acount`, `Bcount`, `Ccount`, `TotalSub`) VALUES ('$indexNo','$year','$level','$semester','$sumCreditaHours','$sumGradePoint',' $semesterGpa','$Aorabove','$Borabove','$Corabove','$totalSubjects')");
        } else if ($numRows > 0) {
            executeQuery("UPDATE `studentgpa` SET `totcredithours`='$sumCreditaHours',`totGPA`='$sumGradePoint',`GPAsemester`='$semesterGpa' , `Acount`='$Aorabove', `Bcount`='$Borabove', `Ccount`='$Corabove', `TotalSub`='$totalSubjects' WHERE `indexNo`='$indexNo' and `acYear`='$year' and `level`='$level' and `semester`='$semester'");
       
	   }
        echo'</table><br><br>';
    }
    ?>

<form action="" method="post">
<h1>Final GPA Calculation</h1>
<form method="post" action="" onsubmit="return validate_form(this);" class="plain">
        <table><tr>
                <td>Student Index Number : </td>
                <td><select name="indexNo" id="indexNo" required="true">
                        <?php
                        $result = executeQuery("SELECT distinct`indexNo` FROM `studentenrolment`");
				      	
                        echo "<option value='0'>All</option>";
                        while ($row = mysql_fetch_array($result)) {
                            echo "<option value='" . $row['indexNo'] . " '>" . $row['indexNo'] . "</option>";
                        }
                        ?>
                    </select><br></td>
            </tr>
        </table>
        <input type='submit' name='finalGPA' value='calculate final GPA'>
		<br/>
		<br/>
	<input type='submit' name='Confirm' value='Confirm'>
    </form>


    <?php
	
    if (isset($_POST['finalGPA'])) {

        $indexNo =$_POST['indexNo'];

        $valueFinal = executeQuery("SELECT `level`,`semester`,`totcredithours` ,`totGPA`,`GPAsemester`, `Acount`, `Bcount`, `Ccount`, `TotalSub` FROM `studentgpa` WHERE `indexNo`='$indexNo' order by level ");
      if (mysql_num_rows($result)==0) die("The student with index number $indexNo has not details");


        echo'<br>';
        echo"<table border='1'>";
        echo '<tr><td>Level</td><td>Semester</td><td>Total Credit Hours</td><td>Total GPA</td><td>Semester GPA</td></tr>';

        $count = 0;
        $totalGPA = 0;
        $sumA = 0;
        $sumB = 0;
        $sumC = 0;
        $totalSubjects = 0;
		
        while ($row = mysql_fetch_array($valueFinal)) {
            $count = $count + 1;
            //calculate final grade points///
            $totalGPA = $totalGPA + $row[4];
            $sumA = $sumA + $row[5];
            $sumB = $sumB + $row[6];
            $sumC = $sumC + $row[7];
            $totalSubjects = $totalSubjects + $row[8];
			$totalGPASubjects=$totalSubjects-2;
            echo "<tr>";
            echo "<td id='row1' name='row1'>" . $row[0] . "</td>";
            echo "<td id='row2' name='row1'>" . $row[1] . "</td>";
            echo "<td id='row3' name='row2'>" . $row[2] . " </td>";
            echo "<td id='row4' name='row2'>" . $row[3] . " </td>";
            echo "<td id='row5' name='row2'>" . $row[4] . " </td>";
            echo "<td id='row6' name='row1'>" . $totalGPA . "</td>";
            echo "</tr>";
        }
        echo"</table>";
        echo '<br><br>';
        $finalGPA = $totalGPA / $count;
		
        echo 'Final GPA = ' . $finalGPA . '<br>';
        $GPA = round($finalGPA, 1);

        echo 'GPA after round = ' . $GPA . '<br>';
		
  

  $class="";
  $classSinhala="";

      if ($GPA >= 3.7) {
            echo 'Total A s = ' . $sumA . '<br>';
            echo 'Talat subjects = ' . $totalSubjects . '<br>';
           if (($totalGPASubjects <= $sumA * 2)&&($sumC>=$totalGPASubjects)) {
                $class= 'First Class';
				echo $class;
				$classSinhala='පළමු පංතිය සාමාර්ථයක්';

	
            } else {
                echo ' Not having first class Becaus only have A s ' . $sumA . ' out of' . $totalSubjects . ' subjects.It is not covered 50% of A s.';
            }
        } else if (($GPA >= 3.3) && ($GPA < 3.7)) {
            echo 'Total A s and B s = ' . $sumB . '<br>';
            echo 'Talat subjects = ' . $totalSubjects . '<br>';
             if (($totalGPASubjects <= $sumB * 2)&&($sumC>=$totalGPASubjects)) {
                $class= 'Second Upper Class';
				echo $class;
				$classSinhala='දෙවන පන්තියේ ඉහළ සාමාර්ථයක්';
				
            } else {
                echo ' Not having second upper class Becaus only have A s and B s ' . $sumB . ' out of' . $totalSubjects . ' subjects.It is not covered 50% of B s or above results.';
            }
        } else if (($GPA >= 3.0) && ($GPA < 3.3)) {
            echo 'Total A s B s and C s = ' . $sumC . '<br>';
            echo 'Talat subjects = ' . $totalSubjects . '<br>';
            if (($totalGPASubjects <= $sumC * 2)&&($sumC>=$totalGPASubjects)) {
                $class= 'Second Lower Class';
				echo $class;
				$classSinhala='දෙවන පන්තියේ පහළ සාමාර්ථයක්';
			
            } else {
                	echo 'Not having any class.';
					  $class= 'Pass';
					  echo $class;
			$classSinhala='සාමාර්ථයක්';
				//echo ' Not having second lower class Becaus only have A s, B s and C s' . $sumC . ' out of' . $totalSubjects . ' subjects.It is not covered 50% of C s or above results.';
            }
        } else {
            $class= 'Pass';
			$classSinhala='සාමාර්ථයක්';
		
        }
      



      }
	  if ($GPA!="" && $class!= "" && $classSinhala!=""){
	  
	   $query = "INSERT INTO finalresults  SET  indexNo='$indexNo', finalGPA='$GPA', class='$class', classSinhala='$classSinhala'";

		$result = executeQuery($query);
	}

?>

<p>
  
  <?php
  /*
	 if (isset($_POST['Confirm']))
	{
		
		$indexNo = cleanInput($_POST['indexNo']);
		$finalGPA = cleanInput($_POST['finalGPA']);
	    $class = cleanInput($_POST['class']);
		
		$query = "INSERT INTO finalresults  SET  indexNo='$indexNo', finalGPA='$GPA', class='$class', classSinhala='$classSinhala'";

		$result = executeQuery($query);
	
	}
	*/
		
	
?>

<?php
//Assign all Page Specific variables
        $pagemaincontent = ob_get_contents();
        ob_end_clean();
        $pagetitle = "Applicants - Student Management System - Buddhist & Pali University of Sri Lanka";
        $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Calculate GPA</li></ul>";
//Apply the template
        include("master_registration.php");
        ?>
    </p>
</form>
<p>&nbsp;</p>