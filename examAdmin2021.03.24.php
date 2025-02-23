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

  $query = "SELECT DISTINCT exameffort.indexNo, student.nameEnglish, student.medium AS student, acYear FROM exameffort JOIN student ON exameffort.indexNo = student.indexNo";
  //Set filter according  to list box values
  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
  	$pageNum = 1;
	$acYear = $_POST['lstAcYear'];
	$subject = $_POST['lstSubject'];
	$student = $_POST['lstStudent'];
	print $student;
	
	$_SESSION['acYear'] = $acYear;
	$_SESSION['subject'] = $subject;
	$_SESSION['student'] = $student;
	
	$subQuery = filterQuery($acYear,$subject,$student);
	$query = $query.$subQuery;
  }
  
  else if (isset($_SESSION['acYear']) && isset($_SESSION['subject']) && isset($_SESSION['student']))
  {
	$acYear = $_SESSION['acYear'];
	$subject = $_SESSION['subject'];
	$student = $_SESSION['student'];
//print	 $student;
  	$subQuery = filterQuery($acYear,$subject,$student);
	$query = $query.$subQuery;
  }
  
  function filterQuery($acYear,$subject,$student)
  {
  //$student='10000';
 
  
	$subQuery = "";
	if ($acYear<>0)
	{
		$subQuery = " WHERE acYear='".$acYear."'"; // (1,_,_)
		if ($subject<>0)
		{
			$subQuery = $subQuery." AND exameffort.subjectID='".$subject."'"; // (1,1,_)
			if ($student<>'')
				$subQuery = $subQuery." AND student.indexNo='".$student."'"; // (1,1,1)
		}
		else if ($student<>'')
			$subQuery = $subQuery." AND student.indexNo='".$student."'"; // (1,0,1)
	}
	else
	{
		if ($subject<>0)
		{
			$subQuery = " WHERE exameffort.subjectID='".$subject."'"; // (0,1,_)
			if ($student<>'')
				$subQuery = $subQuery." AND student.indexNo='".$student."'"; // (0,1,1)
		}
		else if ($student<>'')
			$subQuery = " WHERE student.indexNo='".$student."'"; // (0,0,1)
	}
	$subQuery = $subQuery." ORDER BY student.indexNo";
	//print $subQuery;
	return $subQuery;
  }
  
   $_SESSION['query'] = $query;
  
  // counting the offset
	$offset = ($pageNum - 1) * $rowsPerPage;
	$numRows = mysql_num_rows(executeQuery($query));
	$numPages = ceil($numRows/$rowsPerPage);
  
  	$pageQuery = $query." LIMIT $offset, $rowsPerPage";
	//echo $pageQuery;
	$pageResult = executeQuery($pageQuery);
?>

 <h1>Exam Administration</h1>
 <form method="post" action="" class="plain">
  <table style="margin-left:8px" class="panel">
  	<tr>
    	<td><input name="btnNew" type="button" value="New" onclick="document.location.href = 'effortNew.php';" class="button" /></td>
        <td>&nbsp;</td>
        <td><input name="btnEnterResults" type="button" value="Enter Results" class="button" onclick="document.location.href ='examEnterResults1.php'" /></td>
		<td>&nbsp;</td>
        
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
        <td>Student</td>
        <td>
            <select name="lstStudent" id="lstStudent" onchange="this.form.submit();">
            <?php
				$result = executeQuery("SELECT indexNo FROM student");
				if (mysql_num_rows($result)>0)
				{
					echo "<option value=''>All</option>";
					while ($row=mysql_fetch_array($result))
					{
						if (isset($_POST['lstStudent']) && $_POST['lstStudent']==$row['indexNo'])
							echo "<option selected='selected' value='".$row['indexNo']."'>".$row['indexNo']."</option>";
						else if (isset($_SESSION['student']) && $_SESSION['student']==$row['indexNo'])
							echo "<option selected='selected' value='".$row['indexNo']."'>".$row['indexNo']."</option>";
						else echo "<option value='".$row['indexNo']."'>".$row['indexNo']."</option>";
					}
				}
			?>
            </select>
        </td>
   	</tr>
  </table>
<?php
if (mysql_num_rows($pageResult)>0){
?>
<br/>
  <table class="searchResults">
	<tr>
    	<th>Index No.</th><th>Student</th><th>Ac. Year</th><th>Medium</th><th colspan="2"></th>
    </tr>
    
<?php
  while ($row = mysql_fetch_array($pageResult))
  {
?>
	<tr>
        <td><?php echo $row['indexNo'] ?></td>
		<td><?php echo $row['nameEnglish'] ?></td>
    
        <td><?php echo $row['acYear'] ?></td>
        <td><?php echo $row['student'] ?></td>
      
       
        <td><input name="btnEdit" type="button" value="View" onclick="document.location.href ='examAdminSubject.php?indexNo=<?php echo $row['indexNo'] ?>'" class="button" /></td>
        
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