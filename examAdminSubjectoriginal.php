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
  //2021-03-25 start  include('dbAccess.php');
	require_once("dbAccess.php");
	$db = new DBOperations();
    //2021-03-25 end
  //include('authcheck.inc.php');
  $indexNo=$db->cleanInput($_GET['indexNo']);
  
  if (isset($_GET['cmd']) && $_GET['cmd']=="delete")
  {
	//2021-03-25 start  $effortID = cleanInput($_GET['effortID']);
	$effortID = $db->cleanInput($_GET['effortID']);
	//2021-03-25 end
	$delQuery = "DELETE FROM exameffort WHERE effortID='$effortID'";
	//2021-03-25 start  $result = executeQuery($delQuery);
	$result = $db->executeQuery($delQuery);
	//2021-03-25 end
  }
  
  //session_start();
  
  $rowsPerPage = 10;
  $pageNum = 1;
  if(isset($_GET['page'])) $pageNum = $_GET['page'];

  $query = "SELECT effortID,exameffort.indexNo,student.nameEnglish AS student,subject.nameEnglish AS subject,subject.subjectID AS subjectID,subject.level AS level,subject.semester AS semester,subject.codeEnglish AS code,subject.creditHours,acYear,exameffort.medium,marks,gradePoint,grade,effort FROM exameffort JOIN student ON exameffort.indexNo=student.indexNo JOIN subject ON exameffort.subjectID=subject.subjectID where exameffort.indexNo='$indexNo' ";
  $result = $db->executeQuery($query);
  
  $row = $db->Next_Record($result);
  if ($db->Row_Count($result)>0)
	{
  //Set filter according  to list box values
  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
  	$pageNum = 1;
	$acYear = $_POST['lstAcYear'];
	$subject = $_POST['lstSubject'];
	$student = $_GET['indexNo'];
	
	$_SESSION['acYear'] = $acYear;
	$_SESSION['subject'] = $subject;
	$_SESSION['indexNo'] = $student;
	
	$subQuery = filterQuery($acYear,$subject);
	$query = $query.$subQuery;
	//print $query;
  }
  
  else if (isset($_SESSION['acYear']) && isset($_SESSION['subject']) )
  {
	$acYear = $_SESSION['acYear'];
	$subject = $_SESSION['subject'];
	$student = $_SESSION['indexNo'];
  	$subQuery = filterQuery($acYear,$subject);
	$query = $query.$subQuery;
	//print $query;
	
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
  
  
   $_SESSION['query'] = $query;
  
  // counting the offset
	$offset = ($pageNum - 1) * $rowsPerPage;
	//2021.03.25 start  $numRows = mysql_num_rows(executeQuery($query));
	$numRows = $db->Row_Count($db->executeQuery($query));
	//2021.03.25 end
	$numPages = ceil($numRows/$rowsPerPage);
  
  	$pageQuery = $query." LIMIT $offset, $rowsPerPage";
	//echo $pageQuery;
	//2021.03.25 start  $pageResult = executeQuery($pageQuery);
	$pageResult = $db->executeQuery($pageQuery);
	//2021.03.25 end
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
				//2021.03.25 start  $result = executeQuery("SELECT DISTINCT acYear FROM exameffort");
				$result = $db->executeQuery("SELECT DISTINCT acYear FROM exameffort");
				//2021.03.25 end
				//2021.03.25 start  if (mysql_num_rows($result)>0)
				if ($db->Row_Count($result)>0)
				//2021.03.25 end
				{
					echo "<option value='0'>All</option>";
					//2021.03.25 start  while ($row=mysql_fetch_array($result))
					while ($row=$db->Next_Record($result))
					//2021.03.25 start
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
				//2021.03.25 start  $result = executeQuery("SELECT subjectID,codeEnglish FROM subject");
				$result = $db->executeQuery("SELECT subjectID,codeEnglish FROM subject");
				//2021.03.25 end
				//2021.03.25 start  if (mysql_num_rows($result)>0)
				if ($db->Row_Count($result)>0)
				//2021.03.25 end
				{
					echo "<option value='0'>All</option>";
					//2021.03.25 start  while ($row=mysql_fetch_array($result))
					while ($row=$db->Next_Record($result))
					//2021.03.25 end
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
		
   	</tr>
  </table>
<?php
//if ($db->Row_Count($pageResult)>0){
?>
<br/>
  <table class="searchResults">
  <th colspan="10" align="left"> 
  <?php 
  //2021.03.25 start  $resultname = executeQuery("SELECT nameEnglish FROM student where indexNo='$indexNo'");
  $resultname = $db->executeQuery("SELECT nameEnglish FROM student where indexNo='$indexNo'");
  //2021.03.25 end
  //2021.03.25 start  $rowName=mysql_fetch_array($resultname);
  $rowName=$db->Next_Record($resultname);
  //2021.03.25 end
  echo $indexNo." ".$rowName['nameEnglish']?>
  </th>
	<tr>
    	<th>Subject</th><!-- <th>1st Mark</th><th>2nd Mark</th> --><th>Mark</th><th>Grade</th><th>Grade Point</th><th>Credit Hours</th><th>Grade Point Av.</th><th colspan="2"></th>
    </tr>
    
<?php
  //2021.03.25 start  while ($row = mysql_fetch_array($pageResult))
  while($row=$db->Next_Record($pageResult))
  {
  $averge=$row['creditHours']*$row['gradePoint'];
?>
	<tr>
        <td><?php echo $row['code']." ".$row['subject']?></td>
		
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
	//}
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Exams - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Exams</li></ul>";
  //Apply the template
  include("master_registration.php");
?>