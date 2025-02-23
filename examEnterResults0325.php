<?php
  //Buffer larger content areas like the main page content
  ob_start();
 ?>
 
 <script language="javascript">
 	function MsgOkCancel()
	{
		var message = "Please confirm to DELETE this subject...";
		var return_value = confirm(message);
		return return_value;
	}
	
	function getAverage(row)
{

	var average;
	var grade;
	var gradePoint
mark1=document.getElementById('txtMarks1'+row).value;
mark2=document.getElementById('txtMarks2'+row).value;




if(mark1=='AB' && mark2=='AB' ){
	
	document.getElementById('txtMarks'+row).value="AB"
	document.getElementById('txtGrade'+row).value = '';
	document.getElementById('txtGradePoint'+row).value = '';
		}
else if(mark1=='MD' && mark2=='MD'){
	
	document.getElementById('txtMarks'+row).value="AB"
	document.getElementById('txtGrade'+row).value = '';
	document.getElementById('txtGradePoint'+row).value = '';
		}
else {
mark1=eval(mark1);
mark2=eval(mark2);
	average=((mark1+mark2)/2);
	document.getElementById('txtMarks'+row).value=average;
	marks=average;
	
if (0<=marks && marks<24) {grade = 'E'; gradePoint='0.0';}
	else if (25<=marks && marks<30) {grade = 'D'; gradePoint='1.0';}
	else if (30<=marks && marks<35) {grade = 'D+'; gradePoint='1.3';}
	else if (35<=marks && marks<40) {grade = 'C-'; gradePoint='1.7';}
	else if (40<=marks && marks<45){ grade = 'C'; gradePoint='2.0';}
	else if (45<=marks && marks<50){ grade = 'C+'; gradePoint='2.3';}
	else if (50<=marks && marks<55){ grade = 'B-'; gradePoint='2.7';}
	else if (55<=marks && marks<60){ grade = 'B'; gradePoint='3.0';}
	else if (60<=marks && marks<65){ grade = 'B+'; gradePoint='3.3';}
	else if (65<=marks && marks<70){ grade = 'A-'; gradePoint='3.7';}
	else if (70<=marks && marks<85){ grade = 'A'; gradePoint='4.0';}
	else if (85<=marks && marks<=100){ grade = 'A+'; gradePoint='4.0';}
	else {grade = ''; gradePoint='';}
	

	document.getElementById('txtGrade'+row).value = grade;
	document.getElementById('txtGradePoint'+row).value = gradePoint;
}
}
 </script>
 <?php
  include('dbAccess.php');
  include('authcheck.inc.php');
  
  if (isset($_GET['cmd']) && $_GET['cmd']=="delete")
  {
	$effortID = cleanInput($_GET['effortID']);
	$delQuery = "DELETE FROM exameffort WHERE effortID='$effortID'";
	$result = executeQuery($delQuery);
  }
  
  session_start();
  
  if (isset($_POST['btnSubmit']))
	{
		$efforts = $_SESSION['efforts'];
		for ($i=0;$i<count($efforts);$i++)
		{
			$effortID = $efforts[$i];
			$mark1 = cleanInput($_POST['txtMarks1'.$effortID]);
			$mark2 = cleanInput($_POST['txtMarks2'.$effortID]);
			$marks = cleanInput($_POST['txtMarks'.$effortID]);
			print $marks; 
			print 'v';
			$grade = cleanInput($_POST['txtGrade'.$effortID]);
			$gradepoint = cleanInput($_POST['txtGradePoint'.$effortID]);
			//print "UPDATE exameffort SET mark1='$mark1',mark2='$mark2',marks='$marks', grade='$grade',gradePoint='$gradepoint' WHERE effortID='$effortID'";
			
			$result = executeQuery("UPDATE exameffort SET mark1='$mark1',mark2='$mark2',marks='$marks', grade='$grade',gradePoint='$gradepoint' WHERE effortID='$effortID'");
		}
		//header("location:examAdmin.php");
	}
  
  $query = $_SESSION['query'];
  $result = executeQuery($query);
?>

 <h1>Update Results</h1>
 <br />
  
<?php
if (mysql_num_rows($result)>0){
?>
<form method="post" action="examEnterResults.php" class="plain">
<br/>
  <table class="searchResults">
	<tr>
    	<th>Index No.</th><th>Subject</th><th>AcademicYear</th><th>Mark 1</th><th>Mark 2</th><th>Mark </th><th>Grade</th><th>Grade Point</th>
    </tr>
    
<?php
  while ($row = mysql_fetch_array($result))
  {
?>
	<tr>
        <td><?php echo $row['indexNo'] ?></td>
        <td><?php echo $row['subject'] ?></td>
        <td><?php echo $row['acYear'] ?></td>
       <td><input  size="4" name="txtMarks1<?php echo $row['effortID'] ?>" id="txtMarks1<?php echo $row['effortID'] ?>" value="<?php echo $row['mark1'] ?>" type="text" /></td>
        <td><input  size="4" name="txtMarks2<?php echo $row['effortID'] ?>" id="txtMarks2<?php echo $row['effortID'] ?>" value="<?php echo $row['mark2'] ?>" onKeyUp="getAverage(<?php echo $row['effortID'] ?>)" type="text" /></td>
        <td><input size="4" name="txtMarks<?php echo $row['effortID'] ?>" id="txtMarks<?php echo $row['effortID'] ?>" value="<?php echo $row['marks'] ?>" type="text" /></td>
		<td><input size="4" name="txtGrade<?php echo $row['effortID'] ?>" id="txtGrade<?php echo $row['effortID'] ?>" value="<?php echo $row['grade'] ?>" type="text" /></td>
		
		<td><input size="4" name="txtGradePoint<?php echo $row['effortID'] ?>" id="txtGradePoint<?php echo $row['effortID'] ?>" value="<?php echo $row['gradePoint'] ?>" type="text" /></td>
  
  			
	</tr>
<?php
  }
?>
  </table>
  <?php
  	$efforts = array();
  	for ($i=0;$i<mysql_num_rows($result);$i++)
	{
		$efforts[$i] = mysql_result($result,$i,"effortID");
	}
	$_SESSION['efforts'] = $efforts;
  ?>
  <br/><br/>
  <p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'examAdmin.php';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="submit" value="Submit" class="button" /></p>
  </form>

<?php 
}else echo "<p>No exam details available.</p>";

  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Enter Results - Exam Efforts - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='examAdmin.php'>Exam Efforts </a></li><li>Enter Results</li></ul>";
  //Apply the template
  include("master_registration.php");
?>