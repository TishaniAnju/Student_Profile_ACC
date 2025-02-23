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
 </script>
 <?php
  include('dbAccess.php');
  include('authcheck.inc.php');
  $indexNo=$_GET['indexNo'];
  
  if (isset($_GET['cmd']) && $_GET['cmd']=="delete")
  {
	$effortID = cleanInput($_GET['effortID']);
	$delQuery = "DELETE FROM exameffort WHERE effortID='$effortID'";
	$result = executeQuery($delQuery);
  }
  
  //session_start();
  
  $rowsPerPage = 10;
  $pageNum = 1;
  if(isset($_GET['page'])) $pageNum = $_GET['page'];

  $query = "SELECT effortID,exameffort.indexNo,student.nameEnglish AS student,subject.nameEnglish AS subject,subject.subjectID AS subjectID,subject.level AS level,subject.semester AS semester,subject.codeEnglish AS code,subject.creditHours,acYear,exameffort.medium,marks,mark1,mark2,gradePoint,grade,effort FROM exameffort JOIN student ON exameffort.indexNo=student.indexNo JOIN subject ON exameffort.subjectID=subject.subjectID where exameffort.indexNo='$indexNo' ";
  
  //Set filter according  to list box values
  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
  	$pageNum = 1;
	$acYear = $_POST['lstAcYear'];
	$subject = $_POST['lstSubject'];
	$student = $_GET['indexNo'];
	
	$_SESSION['acYear'] = $acYear;
	$_SESSION['subject'] = $subject;
	$_SESSION['student'] = $student;
	
	$subQuery = filterQuery($acYear,$subject,$student);
	$query = $query.$subQuery;
	print $query;
  }
  
  else if (isset($_SESSION['acYear']) && isset($_SESSION['subject']) && isset($_SESSION['student']))
  {
	$acYear = $_SESSION['acYear'];
	$subject = $_SESSION['subject'];
	$student = $_SESSION['student'];
  	$subQuery = filterQuery($acYear,$subject);
	$query = $query.$subQuery;
	print $query;
	
  }
  
   function filterQuery($acYear,$subject)
  {
	$subQuery = "";
	if ($acYear<>'0')
	{
		$subQuery = " AND acYear='".$acYear."'"; // (1,_)
		if ($subject<>'0')
			$subQuery = $subQuery." AND subject.subjectID='".$subject."'"; // (1,1)
	}
	else
	{
		if ($subject<>'0')
			$subQuery = " AND subject.subjectID='".$subject."'"; // (0,1)
	}
	$subQuery = $subQuery." ORDER BY level,semester";
	return $subQuery;
  }
  
  /*
  function filterQuery($acYear,$subject,$student)
  {
	$subQuery = "";

	if ($acYear<>0)
	{
		$subQuery = " WHERE acYear='".$acYear."'and exameffort.indexNo='".$student."'"; // (1,_,_)
		if ($subject<>0)
		{
			$subQuery = $subQuery." AND exameffort.subjectID='".$subject."' and exameffort.indexNo='".$student."'"; // (1,1,_)
			if ($student<>'')
				$subQuery = $subQuery." AND exameffort.indexNo='".$student."'"; // (1,1,1)
		}
		else if ($student<>'')
			$subQuery = $subQuery." AND exameffort.indexNo='".$student."'"; // (1,0,1)
	}
	else
	{
		if ($subject<>0)
		{
			$subQuery = " WHERE exameffort.subjectID='".$subject."'and  exameffort.indexNo='".$student."'"; // (0,1,_)
			if ($student<>'')
				$subQuery = $subQuery." AND exameffort.indexNo='".$student."' and exameffort.indexNo='".$student."'"; // (0,1,1)
		}
		else if ($student<>'')
			$subQuery = " WHERE exameffort.indexNo='".$student."'"; // (0,0,1)
	}
	$subQuery = $subQuery;
	return $subQuery;
  }
  */
  
   $_SESSION['query'] = $query;
  
  // counting the offset
	$offset = ($pageNum - 1) * $rowsPerPage;
	$numRows = mysql_num_rows(executeQuery($query));
	$numPages = ceil($numRows/$rowsPerPage);
  
  	$pageQuery = $query." LIMIT $offset, $rowsPerPage";
	//echo $pageQuery;
	$pageResult = executeQuery($pageQuery);
?>

 <h1>Student Subject Result</h1>
 <form method="post" action="" class="plain" target="_blank">
  <table style="margin-left:8px" class="panel">
  	<tr>
    	<td><input name="btnNew" type="button" value="New" onclick="document.location.href = 'effortNew.php';" class="button" /></td>
        
		<td>&nbsp;</td>
        <td><input name="btnUpdateResults" type="button" value="Update Results" class="button" onclick="document.location.href ='examEnterResults.php'" /></td>
    </tr>
   </table>
   <table style="margin-left:8px" class="panel">
    <tr>
        <td>Academic Year</td>
        <td>
            <select name="lstAcYear" id="lstAcYear" onchange="this.form.submit();">
            <?php
				$result = executeQuery("SELECT DISTINCT acYear FROM exameffort");
				if (mysql_num_rows($result)>0)
				{
					echo "<option value='0'>All</option>";
					while ($row=mysql_fetch_array($result))
					{
						if (isset($_POST['lstAcYear']) && $_POST['lstAcYear']==$row['acYear'])
							echo "<option selected='selected' value='".$row['acYear']."'>".$row['acYear']."</option>";
						else if (isset($_SESSION['acYear']) && $_SESSION['acYear']==$row['acYear'])
							echo "<option selected='selected' value='".$row['acYear']."'>".$row['acYear']."</option>";
						else echo "<option value='".$row['acYear']."'>".$row['acYear']."</option>";
					}
				}
			?>
            </select>
        </td>
        <td>&nbsp;</td>
        <td>Subject</td>
        <td>
            <select name="lstSubject" id="lstSubject" onchange="this.form.submit();">
            <?php
				$result = executeQuery("SELECT subjectID,codeEnglish FROM subject");
				if (mysql_num_rows($result)>0)
				{
					echo "<option value='0'>All</option>";
					while ($row=mysql_fetch_array($result))
					{
						if (isset($_POST['lstSubject']) && $_POST['lstSubject']==$row['subjectID'])
							echo "<option selected='selected' value='".$row['subjectID']."'>".$row['codeEnglish']."</option>";
						else if (isset($_SESSION['subject']) && $_SESSION['subject']==$row['subjectID'])
							echo "<option selected='selected' value='".$row['subjectID']."'>".$row['codeEnglish']."</option>";
						else echo "<option value='".$row['subjectID']."'>".$row['codeEnglish']."</option>";
					}
				}
			?>
            </select>
        </td>
        <td>&nbsp;</td>
		<!--
        <td>Student</td>
        <td>
            <select name="lstStudent" id="lstStudent" onchange="this.form.submit();">
            <?php /*
				$result = executeQuery("SELECT indexNo FROM student");
				if (mysql_num_rows($result)>0)
				{
					echo "<option value='0'>All</option>";
					while ($row=mysql_fetch_array($result))
					{
						if (isset($_POST['lstStudent']) && $_POST['lstStudent']==$row['indexNo'])
							echo "<option selected='selected' value='".$row['indexNo']."'>".$row['indexNo']."</option>";
						else if (isset($_SESSION['student']) && $_SESSION['student']==$row['indexNo'])
							echo "<option selected='selected' value='".$row['indexNo']."'>".$row['indexNo']."</option>";
						else echo "<option value='".$row['indexNo']."'>".$row['indexNo']."</option>";
					}
				}*/
			?>
            </select>
        </td> -->
   	</tr>
  </table>
<?php
if (mysql_num_rows($pageResult)>0){
?>
<br/>
  <table class="searchResults">
  <th colspan="10" align="left"> <?php 
  $resultname = executeQuery("SELECT nameEnglish FROM student where indexNo='$indexNo'");
  $rowName=mysql_fetch_array($resultname);
  echo $indexNo." ".$rowName['nameEnglish']?>
  </th>
	<tr>
    	<th>Subject</th><th>1st Mark</th><th>2nd Mark</th><th>Mark</th><th>Grade</th><th>Grade Point</th><th>Credit Hours</th><th>Grade Point Av.</th><th colspan="2"></th>
    </tr>
    
<?php
  while ($row = mysql_fetch_array($pageResult))
  {
  $averge=$row['creditHours']*$row['gradePoint'];
?>
	<tr>
        <td><?php echo $row['code']." ".$row['subject']?></td>
		<td><?php echo $row['mark1'] ?></td>
        <td><?php echo $row['mark2'] ?></td>
        <td><?php echo $row['marks'] ?></td>
        <td><?php echo $row['grade'] ?></td>
        <td><?php echo $row['gradePoint'] ?></td>
        <td><?php echo $row['creditHours'] ?></td> 
		<td><?php echo $averge ?></td>
				

        <td><input name="btnEdit" type="button" value="Edit" onclick="window.open(document.location.href ='effortEdit.php?effortID=<?php echo $row['effortID'] ?>','_blank')" class="button" /></td>
        <td><input name="btnDelete" type="button" value="Delete" class="button" onclick="if (MsgOkCancel()) document.location.href ='examAdmin.php?cmd=delete&effortID=<?php echo $row['effortID'] ?>'" /></td>
	</tr>
<?php
  }
?>
  </table>
  </form>
<?php 
  $self = $_SERVER['PHP_SELF'];
  if ($pageNum > 1)
{
   $page  = $pageNum - 1;
   $prev  = " <a class=\"link\" href=\"$self?page=$page\">[Prev]</a> ";
   $first = " <a class=\"link\" href=\"$self?page=1\">[First Page]</a> ";
}
else
{
   $prev  = '&nbsp;'; // we're on page one, don't print previous link
   $first = '&nbsp;'; // nor the first page link
}

if ($pageNum < $numPages)
{
   $page = $pageNum + 1;
   $next = " <a class=\"link\" href=\"$self?page=$page\">[Next]</a> ";
   $last = " <a class=\"link\" href=\"$self?page=$numPages\">[Last Page]</a> ";
}
else
{
   $next = '&nbsp;'; // we're on the last page, don't print next link
   $last = '&nbsp;'; // nor the last page link
}

echo "<table border=\"0\" align=\"center\" width=\"50%\"><tr><td width=\"20%\">".$first."</td><td width=\"10%\">".$prev."</td><td width=\"10%\">"."$pageNum of $numPages"."</td><td width=\"10%\">".$next."</td><td width=\"30%\">".$last."</td></tr></table>";
}else echo "<p>No exam details available.</p>";

?>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Exams - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Exams</li></ul>";
  //Apply the template
  include("master_registration.php");
?>