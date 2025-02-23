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
	
	function quickSearch()
	{
		var regNo = document.getElementById('txtSearch').value;
		if (regNo == "")
			alert("Enter a registration no.!");
		else
			document.location.href ='studentDetails.php?regNo='+regNo;
	}
 </script>
 <?php

  //2021.03.23 startinclude('dbAccess.php');
  require_once("dbAccess.php");
  $db = new DBOperations();
  //2021.03.23 end 

  include('authcheck.inc.php');
  
  if (isset($_GET['cmd']) && $_GET['cmd']=="delete")
  {
	//2021.03.23 start  $appNo = cleanInput($_GET['appNo']);
	$appNo = $db->cleanInput($_GET['appNo']);
	//2021.03.23 end

	$delQuery = "DELETE FROM student WHERE appNo='$appNo'";

	//2021.03.23 start  $result = executeQuery($delQuery);
	$result = $db->executeQuery($delQuery);
	//2021.03.23 end
  }
  
  //session_start();
  
  $rowsPerPage = 10;
  $pageNum = 1;
  if(isset($_GET['page'])) $pageNum = $_GET['page'];

  //$query = "SELECT * FROM student JOIN localapplicant ON student.appNo=localapplicant.appNo"; 
  $query = "SELECT * FROM student";  
  //$query = "SELECT * FROM student JOIN localapplicant ON Right( student.appNo, Length( student.appNo ) -5 ) = localapplicant.appNo";                  // Replaced by Anjana : 2011-03-22
  //Set filter according  to list box values
  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
  	$pageNum = 1;
	$subject = $_POST['lstSubject'];
	$faculty = $_POST['lstFaculty'];
	$yearEntry = $_POST['lstYearEntry'];
	
	$_SESSION['subject'] = $subject;
	$_SESSION['faculty'] = $faculty;
	$_SESSION['yearEntry'] = $yearEntry;
	
	$subQuery = filterQuery($subject,$faculty,$yearEntry);
	$query = $query.$subQuery;
  }
  
  else if (isset($_SESSION['subject']) && isset($_SESSION['faculty']) && isset($_SESSION['yearEntry']))
  {
	$subject = $_SESSION['subject'];
	$faculty = $_SESSION['faculty'];
	$yearEntry = $_SESSION['yearEntry'];
  	$subQuery = filterQuery($subject,$faculty,$yearEntry);
	$query = $query.$subQuery;
  }
  
 $query = $query." ORDER BY yearEntry";     
  
  function filterQuery($subject,$faculty,$yearEntry)
  {
	$subQuery = "";
	if ($subject<>0)
	{
		$subQuery = " WHERE regNo IN (SELECT DISTINCT regNo FROM studentenrolment WHERE subjectID='".$subject."')"; // (1,_,_)
		if ($faculty<>'0')
		{
			$subQuery = $subQuery." AND faculty='".$faculty."'"; // (1,1,_)
			if ($yearEntry<>0)
				$subQuery = $subQuery." AND yearEntry='".$yearEntry."'"; // (1,1,1)
		}
		else if ($yearEntry<>0)
			$subQuery = $subQuery." AND yearEntry='".$yearEntry."'"; // (1,0,1)
	}
	else
	{
		if ($faculty<>'0')
		{
			$subQuery = " WHERE faculty='".$faculty."'"; // (0,1,_)
			if ($yearEntry<>0)
				$subQuery = $subQuery." AND yearEntry='".$yearEntry."'"; // (0,1,1)
		}
		else if ($yearEntry<>0)
			$subQuery = " WHERE yearEntry='".$yearEntry."'"; // (0,0,1)
	}
	//$subQuery = $subQuery." ORDER BY zScore DESC";
	return $subQuery;
  }
  
   $_SESSION['query'] = $query;
  print $query;
  // counting the offset
	$offset = ($pageNum - 1) * $rowsPerPage;
	
	//2021-03-23 start $numRows = mysql_num_rows(executeQuery($query));
	$numRows = $db->Row_Count(executeQuery($query));
	//2021-03-23 end
	$numPages = ceil($numRows/$rowsPerPage);
  
  	$pageQuery = $query." LIMIT $offset, $rowsPerPage";
	//print $pageQuery;
	//2021-03-23 start  $pageResult = executeQuery($pageQuery);
	$pageResult = $db->executeQuery($pageQuery);
	//2021-03-23 end
?>
  
  <h1>Student Administration</h1>
  <form method="post" action="rptStudentsList.php" class="plain">
  <table style="margin-left:8px" class="panel">
  	<tr>
    	<td><input name="btnNew" type="button" value="New" onclick="document.location.href = 'studentNew.php';" class="button" /></td>
        <td>&nbsp;</td>
        <td><input name="btnSearch" type="button" value="Search" onclick="quickSearch();" class="button"/></td>
        <td><input name="txtSearch" id="txtSearch" type="text" /> (Registration No.)</td>
		<td><input name="btnDetails2" type="button" value="Foreign Applicants" onclick="document.location.href ='studentAdminF.php'" class="button" /></td>		
    </tr>
    <tr>
        <td><input name="btnGetReport" type="submit" value="Get Report" class="button" /></td>
        <td>&nbsp;</td>
        <td>Heading</td>
		<td><input name="txtReportHeading" type="text" /></td>
		<td>&nbsp;</td>
    </tr>
  </table>
  </form>
  <form method="post" action="" class="plain">
  <table style="margin-left:8px" class="panel">
    <tr>
        <td>Subject</td>
        <td>
            <select name="lstSubject" id="lstSubject" onchange="this.form.submit();">
            <?php
				//2021.03.24 start $result = executeQuery("SELECT subjectID,codeEnglish FROM subject");
				$result = $db->executeQuery("SELECT subjectID,codeEnglish FROM subject");
				//2021.03.24 end

				//2021.03.24 start  if (mysql_num_rows($result)>0)
				if ($db->Row_Count($result)>0)
				//2021.03.24 end
				{
					echo "<option value='0'>All</option>";
					//2021.03.24 start  while ($row=mysql_fetch_array($result))
					while ($row=$db->Next_Record($result))
					//2021.03.24 end
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
        <td>Faculty</td>
        <td>
            <select name="lstFaculty" id="lstFaculty" onchange="this.form.submit();">
            <?php
				//2021.03.24 start  $result = executeQuery("SELECT DISTINCT faculty FROM student where faculty IS NOT NULL");
				$result = $db->executeQuery("SELECT DISTINCT faculty FROM student where faculty IS NOT NULL");
				//2021.03.24 end
				//2021.03.24 start  if (mysql_num_rows($result)>0)
				if ($db->Row_Count($result)>0)
				//2021.03.24 end
				{
					echo "<option value='0'>All</option>";
					//2021.03.24 start while ($row=mysql_fetch_array($result))
					while ($row=$db->Next_Record($result))
					//2021-03-23 end
					{
						if (isset($_POST['lstFaculty']) && $_POST['lstFaculty']==$row['faculty'])
							echo "<option selected='selected' value='".$row['faculty']."'>".$row['faculty']." Studies</option>";
						else if (isset($_SESSION['faculty']) && $_SESSION['faculty']==$row['faculty'])
							echo "<option selected='selected' value='".$row['faculty']."'>".$row['faculty']." Studies</option>";
						else echo "<option value='".$row['faculty']."'>".$row['faculty']." Studies</option>";
					}
				}
			?>
            </select>
        </td>
        <td>&nbsp;</td>
        <td>Entry Year</td>
        <td>
            <select name="lstYearEntry" id="lstYearEntry" onchange="this.form.submit();">
            <?php
				//2021-03-23 start  $result = executeQuery("SELECT DISTINCT yearEntry FROM student");
				$result = $db->executeQuery("SELECT DISTINCT yearEntry FROM student");
				//2021-03-23 end
				//2021-03-23 start  if (mysql_num_rows($result)>0)
				if ($db->Row_Count($result)>0)
				//2021-03-23 end
				{
					echo "<option value='0'>All</option>";
					//2021-03-23 start  while ($row=mysql_fetch_array($result))
					while ($row=$db->Next_Record($result))
					//2021-03-23 end
					{
						if (isset($_POST['lstYearEntry']) && $_POST['lstYearEntry']==$row['yearEntry'])
							echo "<option selected='selected' value='".$row['yearEntry']."'>".$row['yearEntry']."</option>";
						else if (isset($_SESSION['yearEntry']) && $_SESSION['yearEntry']==$row['yearEntry'])
							echo "<option selected='selected' value='".$row['yearEntry']."'>".$row['yearEntry']."</option>";
						else echo "<option value='".$row['yearEntry']."'>".$row['yearEntry']."</option>";
					}
				}
			?>
            </select>
        </td>
   	</tr>
  </table>
<?php 
	//2021-03-23 start  if (mysql_num_rows($pageResult)>0)
	if ($db->Row_Count($pageResult)>0)
	//2021-03-23 end
	{ 
?>

<br/>
  <table class="searchResults">
	<tr>
    	<th>Registration No.</th><th>Index No.</th><th>Name</th><th>Entry Type</th><th colspan="4"></th>
    </tr>
    
<?php
  //2021-03-23 start  while ($row = mysql_fetch_array($pageResult))
  while ($row = $db->Next_Record($pageResult))
  //2021-03-23 end
  {
?>
	<tr>
        <td><?php echo $row['regNo'] ?></td>
        <td><?php echo $row['indexNo'] ?></td>
		<td><?php echo $row['nameEnglish'] ?></td>
        <td><?php echo $row['entryType'] ?></td>
        <td><input name="btnDetails" type="button" value="Details" onclick="document.location.href ='studentDetails.php?appNo=<?php echo $row['appNo'] ?>'" class="button" /></td>
        <td><input name="btnEdit" type="button" value="Edit" onclick="document.location.href ='studentEdit.php?appNo=<?php echo $row['appNo'] ?>'" class="button" /></td>
        <td><input name="btnDelete" type="button" value="Delete" class="button" onclick="if (MsgOkCancel()) document.location.href ='studentAdmin.php?cmd=delete&appNo=<?php echo $row['appNo'] ?>'" /></td>
        <td><input name="btnEnroll" type="button" value="Enroll" onclick="document.location.href ='studentEnroll.php?regNo=<?php echo $row['regNo'] ?>'" class="button" /></td>
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
}else echo "<p>No students.</p>";

?>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Students - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Students</li></ul>";
  //Apply the template
  include("master_registration.php");
?>