<?php
  //Buffer larger content areas like the main page content
  ob_start();
 ?>
 
 <script language="javascript">
 	function MsgOkCancel()
	{
		var message = "Please confirm to DELETE this entry...";
		var return_value = confirm(message);
		return return_value;
	}
 </script>
 <?php
  include('dbAccess.php');
  include('authcheck.inc.php');
  
  if (isset($_GET['cmd']) && $_GET['cmd']=="delete")
  	{
		$subjectID = cleanInput($_GET['subjectID']);
		$acYear = cleanInput($_GET['acYear']);
		$delQuery = "DELETE FROM examschedule WHERE subjectID='$subjectID' AND acYear='$acYear'";
		$result = executeQuery($delQuery);
  	}
  
  //session_start();
  
  $rowsPerPage = 10;
  $pageNum = 1;
  if(isset($_GET['page'])) $pageNum = $_GET['page'];

 $query = "SELECT * FROM examschedule JOIN subject ON examschedule.subjectID=subject.subjectID";
  
  //Set filter according  to list box values
  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
  	$pageNum = 1;
	$medium = $_POST['lstMedium'];
	$level = $_POST['lstLevel'];
	$acYear = $_POST['lstAcYear'];
	
	$_SESSION['medium'] = $medium;
	$_SESSION['level'] = $level;
	$_SESSION['acYear'] = $acYear;
	
	$subQuery = filterQuery($medium,$level,$acYear);
	$query = $query.$subQuery;
  }
  
  else if (isset($_SESSION['medium']) && isset($_SESSION['level']) && isset($_SESSION['acYear']))
  {
	$medium = $_SESSION['medium'];
	$level = $_SESSION['level'];
	$acYear = $_SESSION['acYear'];
  	$subQuery = filterQuery($medium,$level,$acYear);
	$query = $query.$subQuery;
  }
  
  function filterQuery($medium,$level,$acYear)
  {
	$subQuery = "";
	if ($medium<>"0")
	{
		$subQuery = " WHERE medium='".$medium."'"; // (1,_,_)
		if ($level<>0)
		{
			$subQuery = $subQuery." AND level='".$level."'"; // (1,1,_)
			if ($acYear<>0)
				$subQuery = $subQuery." AND acYear='".$acYear."'"; // (1,1,1)
		}
		else if ($acYear<>0)
			$subQuery = $subQuery." AND acYear='".$acYear."'"; // (1,0,1)
	}
	else
	{
		if ($level<>0)
		{
			$subQuery = " WHERE level='".$level."'"; // (0,1,_)
			if ($acYear<>0)
				$subQuery = $subQuery." AND acYear='".$acYear."'"; // (0,1,1)
		}
		else if ($acYear<>0)
			$subQuery = " WHERE acYear='".$acYear."'"; // (0,0,1)
	}
	$subQuery = $subQuery." ORDER BY date";
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

 <h1>Exam Schedule</h1>
 <form method="post" action="rptExamSchedule.php" class="plain">
  <table style="margin-left:8px" class="panel">
  	<tr>
    	<td><input name="btnNew" type="button" value="New" onclick="document.location.href = 'examNew.php';" class="button" /></td>
        <td>&nbsp;</td>
        <td><input name="btnGetReport" type="submit" value="Get Report" class="button" /></td>
        <td>With Heading</td><td><input name="txtReportHeading" type="text" /></td>
    </tr>
  </table>
 </form>
 <form method="post" action="" class="plain">
  <table style="margin-left:8px" class="panel">
  	<tr>
        <td>Medium</td>
        <td>
            <?php
				$medium = "0";
            	if (isset($_POST['lstMedium'])) $medium = $_POST['lstMedium']; 
				else if (isset($_SESSION['medium']))  $medium = $_SESSION['medium'];
			?>
            <select name="lstMedium" id="lstMedium" onchange="this.form.submit();">
            	<option value='0'>All</option>
            	<option <?php if ($medium == 'English') echo "selected='selected'";?> value="English">English</option>
                <option <?php if ($medium == 'Sinhala') echo "selected='selected'";?> value="Sinhala">Sinhala</option>
            </select>
        </td>
        <td>&nbsp;</td>
        <td>Level</td>
        <td>
            <?php
				$level = 0;
            	if (isset($_POST['lstLevel'])) $level = $_POST['lstLevel']; 
				else if (isset($_SESSION['level']))  $level = $_SESSION['level'];
			?>
            <select name="lstLevel" id="lstLevel" onchange="this.form.submit();">
            	<option value="0">All</option>
            	<option <?php if ($level == 1) echo "selected='selected'";?> value="1">1</option>
                <option <?php if ($level == 2) echo "selected='selected'";?> value="2">2</option>
                <option <?php if ($level == 3) echo "selected='selected'";?> value="3">3</option>
                <option <?php if ($level == 4) echo "selected='selected'";?> value="4">4</option>
            </select>
        </td>
        <td>&nbsp;</td>
        <td>Ac. Year</td>
        <td>
            <select name="lstAcYear" id="lstAcYear" onchange="this.form.submit();">
            <?php
				$result = executeQuery("SELECT acYear FROM examschedule");
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
   	</tr>
  </table>
<?php
if (mysql_num_rows($pageResult)>0){
?>
<br/>
  <table class="searchResults">
	<tr>
    	<th>Code</th><th>Subject</th><th>Ac. Year</th><th>Date</th><th>Time</th><th>Venue</th><th></th>
    </tr>
    
<?php
  while ($row = mysql_fetch_array($pageResult))
  {
  $medium = $row['medium'];
?>
	<tr>
        <td><?php if ($medium=='English') echo $row['codeEnglish']; else if ($medium=='Sinhala') echo $row['codeSinhala']; ?></td>
		<td><?php if ($medium=='English') echo $row['nameEnglish']; else if ($medium=='Sinhala') echo $row['nameSinhala']; ?></td>
        <td><?php echo $row['acYear'] ?></td>
        <td><?php echo $row['date'] ?></td>
        <td><?php echo $row['time'] ?></td>
        <td><?php echo $row['venue'] ?></td>
        <td><input name="btnDelete" type="button" value="Delete" class="button" onclick="if (MsgOkCancel()) document.location.href='examSchedule.php?cmd=delete&subjectID=<?php echo $row['subjectID'] ?>&acYear=<?php echo $row['acYear'] ?>&medium=<?php echo $row['medium'] ?>'" /></td>
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
}else echo "<p>No scheduled lectures.</p>";

?>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Exam Schedule - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Exam Schedule</li></ul>";
  //Apply the template
  include("master_registration.php");
?>