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
  //2021.03.24 start  include('dbAccess.php');
  require_once("dbAccess.php");
  $db = new DBOperations();
  //2021.03.24 end
  include('authcheck.inc.php');
  
  if (isset($_GET['cmd']) && $_GET['cmd']=="delete")
  {
	//2021.03.24 start  $effortID = cleanInput($_GET['effortID']);
	$effortID = $db->cleanInput($_GET['effortID']);
	//2021.03.24 end

	$delQuery = "DELETE FROM exameffort WHERE effortID='$effortID'";

	//2021.03.24 start  $result = executeQuery($delQuery);
	$result = $db->executeQuery($delQuery);
	//2021.03.24 end
  }
  
  //session_start();
  
  $rowsPerPage = 10;
  $pageNum = 1;
  if(isset($_GET['page'])) $pageNum = $_GET['page'];

  //$query = "SELECT * FROM exameffort";

 $query = "SELECT  DISTINCT exameffort.indexNo, student.nameEnglish, student.medium AS student, acYear FROM exameffort JOIN student ON exameffort.indexNo = student.indexNo";
//print $query;
  //Set filter according  to list box values
  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
  	$pageNum = 1;
	$acYear = $_POST['lstAcYear'];
	$subject = $_POST['lstSubject'];
	$student = $_POST['lstStudent'];
	//print $student;
	
	$_SESSION['acYear'] = $acYear;
	$_SESSION['subject'] = $subject;
	//$_SESSION['student'] = $student;
	$_SESSION['indexNo'] = $student;
	//student ==> indexNo

	$subQuery = filterQuery($acYear,$subject,$student);
	$query = $query.$subQuery;
  }
  
  else if (isset($_SESSION['acYear']) && isset($_SESSION['subject']) && isset($_SESSION['indexNo']))
  {
	$acYear = $_SESSION['acYear'];
	$subject = $_SESSION['subject'];
	$student = $_SESSION['indexNo'];
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
			if ($student<>''){
				$subQuery = $subQuery." AND student.indexNo='".$student."'"; // (0,1,1)
			}
		}
		else if ($student<>'')
		{
			$subQuery = " WHERE student.indexNo='".$student."'"; // (0,0,1)
		}
	}
	$subQuery = $subQuery." ORDER BY student.indexNo";
	//print $subQuery;
	return $subQuery;
  }
  
   $_SESSION['query'] = $query;
  
  // counting the offset
	$offset = ($pageNum - 1) * $rowsPerPage;
	//2021.03.24 start  $numRows = mysql_num_rows(executeQuery($query));
	$numRows = $db->Row_Count($db->executeQuery($query));
	//2021.03.24 end
	$numPages = ceil($numRows/$rowsPerPage);
  
  	$pageQuery = $query." LIMIT $offset, $rowsPerPage";
	//echo $pageQuery;
	$pageResult = $db->executeQuery($pageQuery);
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
				//2021.03.24 start  $result = executeQuery("SELECT DISTINCT acYear FROM exameffort");
				$result = $db->executeQuery("SELECT DISTINCT acYear FROM exameffort");
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
				//2021.03.24 start  $result = executeQuery("SELECT subjectID,codeEnglish FROM subject");
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
        <td>Student</td>
        <td>
            <select name="lstStudent" id="lstStudent" onchange="this.form.submit();">
            <?php
				//2021.03.24 start  $result = executeQuery("SELECT indexNo FROM student");
				$result = $db->executeQuery("SELECT indexNo FROM student");
				//2021.03.24 end
				//2021.03.24 start  if (mysql_num_rows($result)>0)
				if ($db->Row_Count($result)>0)
				//2021.03.24 end
				{
					echo "<option value=''>All</option>";
					//2021.03.24 start  while ($row=mysql_fetch_array($result))
					while ($row=$db->Next_Record($result))
					//2021.03.24 end
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
//2021.03.24 start  if (mysql_num_rows($pageResult)>0)
if ($db->Row_Count($pageResult)>0)
//2021.03.24 end
{
?>
<br/>
  <table class="searchResults">
	<tr>
    	<th>Index No.</th><th>Student</th><th>Ac. Year</th><th>Medium</th><th colspan="2"></th>
    </tr>
    
<?php
  //2021.03.24 start while ($row = mysql_fetch_array($pageResult))
  while ($row = $db->Next_Record($pageResult))
  //2021.03.24 end
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