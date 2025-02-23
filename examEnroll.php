<?php
  //Buffer larger content areas like the main page content
  ob_start();
?>

<script type="text/javascript" language="javascript">
 	function MsgOkCancel()
	{
		var message = "Please confirm to DELETE this student...";
		var return_value = confirm(message);
		return return_value;
	}
 </script>
 
 <?php
	//2021-03-25 start  include('dbAccess.php');
	require_once("dbAccess.php");
	$db = new DBOperations();
    //2021-03-25 end
	//include('authcheck.inc.php');



	 //session_start(); 
    /* print $_SESSION['regNo'] ;
    $studentID = $_SESSION['regNo']; */
    $studentID =$db-> cleanInput($_GET['regNo']);
	//print $studentID;
    /* $rowsPerPage = 100;
    $pageNum = 1;
    if(isset($_GET['page'])) $pageNum = $_GET['page']; 
	
 */
  if (isset($_GET['cmd']) && $_GET['cmd']=="delete")
  	{
	 		$studentID =$db->cleanInput($_GET['regNo']);
		 $subjectID =$db->cleanInput($_GET['subjectID']);
		//$subjectID = cleanInput($_GET['subjectID']);
		//$regNo = cleanInput($_GET['regNo']);
		//print $regNo;
		$delQuery = "DELETE FROM studentenrolment WHERE regNo='$studentID' AND subjectID='$subjectID'";
		//print $delQuery;
		$db->executeQuery($delQuery);
		header("location:examEnroll.php?regNo=$studentID");

  	} 
if (isset($_GET['cmd']) && $_GET['cmd']=="confirm")
  	{
	 		$studentID =$db->cleanInput($_GET['regNo']);
		 $subjectID =$db->cleanInput($_GET['subjectID']);
		//$subjectID = cleanInput($_GET['subjectID']);
		//$regNo = cleanInput($_GET['regNo']);
		//print $regNo;
		$delQuery = "Update studentenrolment set confirm_exam='y' WHERE regNo='$studentID' AND subjectID='$subjectID'";
		//print $delQuery;
		$db->executeQuery($delQuery);
		header("location:examEnroll.php?regNo=$studentID");

  	} 
	$query = "SELECT * FROM subject JOIN studentenrolment ON studentenrolment.subjectID=subject.subjectID WHERE studentenrolment.regNo = '$studentID' "  ; 
	
	$query1 = "SELECT * FROM subject JOIN studentenrolment ON studentenrolment.subjectID=subject.subjectID WHERE subject.level='I' and studentenrolment.regNo = '$studentID' "  ; 
	//print $query1;
	$query2 = "SELECT * FROM subject JOIN studentenrolment ON studentenrolment.subjectID=subject.subjectID WHERE subject.level='II' and studentenrolment.regNo = '$studentID' "  ; 
	$query3 = "SELECT * FROM subject JOIN studentenrolment ON studentenrolment.subjectID=subject.subjectID WHERE subject.level='III' and studentenrolment.regNo = '$studentID' "  ; 
	$query4 = "SELECT * FROM subject JOIN studentenrolment ON studentenrolment.subjectID=subject.subjectID WHERE subject.level='IV' and studentenrolment.regNo = '$studentID' "  ;
	//$query = "SELECT subject.subjectID,codeEnglish,nameEnglish FROM studentenrolment, subject WHERE studentenrolment.subjectID = subject.subjectID AND regNo = '$regNo' order by subject.suborder";
    //$query = "SELECT * FROM `studentenrolment` WHERE regNo = '$studentID' ";
	$pageResult1 = $db->executeQuery($query1);
	$pageResult2 = $db->executeQuery($query2);
	$pageResult3 = $db->executeQuery($query3);
	$pageResult4 = $db->executeQuery($query4);
	$pageResult = $db->executeQuery($query);
	?>


<h1>Exam Enrollment</h1>

<form method="post" action="examEnroll.php?regNo=<?php echo $studentID; ?>" class="plain" >
<table style="margin-left:8px" class="panel">
  	<tr>
    	<!-- <td><input name="btnNew" type="button" value="New" onclick="document.location.href = 'enrollSubjects.php?regNo=<?php echo $studentID; ?>';" class="button" style="width:60px;"/></td> -->
    </tr>
  </table>

<?php if (($db->Row_Count($pageResult))>0){ ?>
<br/>
  <table class="searchResults">
  <tr>
    	<th colspan="8">Index No : <?php echo $studentID; ?></th>
    </tr>
	<tr>
    	<th>Subject Code</th><th>Subject Name</th><th>Status</th><th>Attendance</th><th></th><th colspan="3"></th>
    </tr> 
	<tr>
    	<th colspan="8"> Year One</th>
    </tr>
    
<?php
  while ($row = $db->Next_Record($pageResult1))
  {
?>
	<tr> 
		<td width = 250><?php echo $row['codeEnglish'] ?></td>
		<td width = 250><?php echo $row['nameEnglish'] ?></td>
        <td width = 250><?php if($row['confirm']=='p') echo 'Not Registered'; elseif($row['confirm']=='y') echo 'Registered'; ?></td>   
    
    <td width = 250></td> 
		<?php 
   
   if($row['ExamEligible']==1)
    {
		if($row['confirm_exam']=='y'){
			echo" <td><input name='btnConfirm' type='button' value='Confirmed' disabled/></td>" ;
		}
		else{
   echo" <td><input name='btnConfirm' type='button' value='Confirm' class='button' onclick=\" document.location.href ='examEnroll.php?cmd=confirm&subjectID=".$row['subjectID']."&regNo=".$studentID."'\" /></td>" ;
   }
}

    ?>
	</tr>
<?php
  }
?>
<tr>
    	<th colspan="8"> Year Two</th>
    </tr>
<?php
  while ($row = $db->Next_Record($pageResult2))
  {
?>
	<tr>  
		<td width = 250><?php echo $row['codeEnglish'] ?></td>
		<td width = 250><?php echo $row['nameEnglish'] ?></td> 
        <td width = 250><?php if($row['confirm']=='p') echo 'Not Registered'; elseif($row['confirm']=='y') echo 'Registered'; ?></td>     
    
    <td width = 250></td> 
		<?php 
   
   if($row['ExamEligible']==1)
   {
	if($row['confirm_exam']=='y'){
		echo" <td><input name='btnConfirm' type='button' value='Confirmed' disabled/></td>" ;
	}
	else{
   echo" <td><input name='btnConfirm' type='button' value='Confirm' class='button' onclick=\" document.location.href ='examEnroll.php?cmd=confirm&subjectID=".$row['subjectID']."&regNo=".$studentID."'\" /></td>" ;
   }
}
		?>
	</tr>
<?php
  }
?>
<tr>
    	<th colspan="8"> Year Three</th>
    </tr>
<?php
  while ($row = $db->Next_Record($pageResult3))
  {
?>
	<tr>    
		<td width = 250><?php echo $row['codeEnglish'] ?></td>
		<td width = 250><?php echo $row['nameEnglish'] ?></td> 
        <td width = 250><?php if($row['confirm']=='p') echo 'Not Registered'; elseif($row['confirm']=='y') echo 'Registered'; ?></td>   
  
    <td width = 250></td> 
		<?php 
   
    if($row['ExamEligible']==1)
    {
		if($row['confirm_exam']=='y'){
			echo" <td><input name='btnConfirm' type='button' value='Confirmed' disabled/></td>" ;
		}
		else{
   echo" <td><input name='btnConfirm' type='button' value='Confirm' class='button' onclick=\" document.location.href ='examEnroll.php?cmd=confirm&subjectID=".$row['subjectID']."&regNo=".$studentID."'\" /></td>" ;
   }
}
		?>
	</tr>
<?php
  }
?>
<tr>
    	<th colspan="8"> Year Four</th>
    </tr>
<?php
  while ($row = $db->Next_Record($pageResult4))
  {
?>
	<tr>    
		<td width = 250><?php echo $row['codeEnglish'] ?></td>
		<td width = 250><?php echo $row['nameEnglish'] ?></td>
        <td width = 250><?php if($row['confirm']=='p') echo 'Not Registered'; elseif($row['confirm']=='y') echo 'Registered'; ?></td>      
 
    <td width = 250></td> 
		<?php 
   
   if($row['ExamEligible']==1)
    {
   if($row['confirm_exam']=='y'){
	   echo" <td><input name='btnConfirm' type='button' value='Confirmed' disabled/></td>" ;
   }
   else{
   echo" <td><input name='btnConfirm' type='button' value='Confirm' class='button' onclick=\" document.location.href ='examEnroll.php?cmd=confirm&subjectID=".$row['subjectID']."&regNo=".$studentID."'\" /></td>" ;
   }
}
		?>
		
		
	</tr>
<?php
  }
?>
  </table>

</form>
<?php 
 
}else echo "<p>No enrollments.</p>";

?>

	

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Enroll - Students - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='studentAdmin.php'>Students </a></li><li>Enroll</li></ul>";
  //Apply the template
  include("master_registration.php");
?>