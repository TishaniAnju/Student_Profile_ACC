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
  //2021.03.24 start include('dbAccess.php');
  require_once("dbAccess.php");
  $db = new DBOperations();
  //2021.03.24 end

  include('authcheck.inc.php');
  
  if (isset($_GET['cmd']) && $_GET['cmd']=="delete")
  	{
		//2021.03.24 start  $subjectID = cleanInput($_GET['subjectID']);
		$subjectID = $db->cleanInput($_GET['subjectID']);
		//2021.03.24 end

		//2021.03.24 start  $venueNo = cleanInput($_GET['venueNo']);
		$venueNo = $db->cleanInput($_GET['venueNo']);
		//2021.03.24 end

		//2021.03.24 start  $epfNo = cleanInput($_GET['epfNo']);
		$epfNo = $db->cleanInput($_GET['epfNo']);
		//2021.03.24 end

		//2021.03.24 start  $slotID = cleanInput($_GET['slotID']);
		$slotID = $db->cleanInput($_GET['slotID']);
		//2021.03.24 end

		$delQuery = "DELETE FROM timetable WHERE subjectID='$subjectID' AND venueNo='$venueNo' AND epfNo='$epfNo' AND slotID='$slotID'";

		
		//2021.03.24 start  $result = executeQuery($delQuery);
		$result = $db->executeQuery($delQuery);
		//2021.03.24 end

		header("location:lectureSchedule.php");
  	}
  
  //session_start();
  
  $rowsPerPage = 10;
  $pageNum = 1;
  if(isset($_GET['page'])) $pageNum = $_GET['page'];

  $query = "SELECT timetable.subjectID,codeEnglish,codeSinhala,nameEnglish,nameSinhala,medium,level,timetable.venueNo,venue,timetable.epfNo,name,timetable.slotID,dayOfWeekE,dayOfWeekS,timeSlot FROM timetable JOIN subject ON timetable.subjectID=subject.subjectID JOIN venue ON timetable.venueNo=venue.venueNo JOIN lecturer ON timetable.epfNo=lecturer.epfNo JOIN timeslot ON timetable.slotID=timeslot.slotID";
  
  //Set filter according  to list box values
  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
  	$pageNum = 1;
	$medium = $_POST['lstMedium'];
	$level = $_POST['lstLevel'];
	$lecturer = $_POST['lstLecturer'];
	
	$_SESSION['medium'] = $medium;
	$_SESSION['level'] = $level;
	$_SESSION['lecturer'] = $lecturer;
	
	$subQuery = filterQuery($medium,$level,$lecturer);
	$query = $query.$subQuery;
  }
  
  else if (isset($_SESSION['medium']) && isset($_SESSION['level']) && isset($_SESSION['lecturer']))
  {
	$medium = $_SESSION['medium'];
	$level = $_SESSION['level'];
	$lecturer = $_SESSION['lecturer'];
  	$subQuery = filterQuery($medium,$level,$lecturer);
	$query = $query.$subQuery;
  }
  
  function filterQuery($medium,$level,$lecturer)
  {
	$subQuery = "";
	if ($medium<>"0")
	{
		$subQuery = " WHERE medium='".$medium."'"; // (1,_,_)
		if ($level<>0)
		{
			$subQuery = $subQuery." AND level='".$level."'"; // (1,1,_)
			if ($lecturer<>0)
				$subQuery = $subQuery." AND lecturer.epfNo='".$lecturer."'"; // (1,1,1)
		}
		else if ($lecturer<>0)
			$subQuery = $subQuery." AND lecturer.epfNo='".$lecturer."'"; // (1,0,1)
	}
	else
	{
		if ($level<>0)
		{
			$subQuery = " WHERE level='".$level."'"; // (0,1,_)
			if ($lecturer<>0)
				$subQuery = $subQuery." AND lecturer.epfNo='".$lecturer."'"; // (0,1,1)
		}
		else if ($lecturer<>0)
			$subQuery = " WHERE lecturer.epfNo='".$lecturer."'"; // (0,0,1)
	}
	$subQuery = $subQuery." ORDER BY timetable.subjectID";
	return $subQuery;
  }
  
   $_SESSION['query'] = $query;
  
  // counting the offset
	$offset = ($pageNum - 1) * $rowsPerPage;
	//2021.03.24 start  $numRows = mysql_num_rows($db->executeQuery($query));
	$numRows = $db->Row_Count($db->executeQuery($query));
	//2021.03.24 end
	$numPages = ceil($numRows/$rowsPerPage);
  
  	$pageQuery = $query." LIMIT $offset, $rowsPerPage";
	//echo $pageQuery;
	//2021.03.24 start  $pageResult = executeQuery($pageQuery);
	$pageResult = $db->executeQuery($pageQuery);
	//2021.03.24 end
?>

 <h1>Lecture Schedule</h1>
 <form method="post" action="" class="plain">
  <table style="margin-left:8px" class="panel">
  	<tr>
    	<td><input name="btnNew" type="button" value="New" onclick="document.location.href = 'lectureNew.php';" class="button" /></td>
        <td>&nbsp;</td>
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
        <td>Lecturer</td>
        <td>
            <select name="lstLecturer" id="lstLecturer" onchange="this.form.submit();">
            <?php
				//2021.03.24 start  $result = executeQuery("SELECT epfNo,name FROM lecturer");
				$result = $db->executeQuery("SELECT epfNo,name FROM lecturer");
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
						if (isset($_POST['lstLecturer']) && $_POST['lstLecturer']==$row['epfNo'])
							echo "<option selected='selected' value='".$row['epfNo']."'>".$row['name']."</option>";
						else if (isset($_SESSION['lecturer']) && $_SESSION['lecturer']==$row['epfNo'])
							echo "<option selected='selected' value='".$row['epfNo']."'>".$row['name']."</option>";
						else echo "<option value='".$row['epfNo']."'>".$row['name']."</option>";
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
    	<th>Code</th><th>Subject</th><th>Venue</th><th>Lecturer</th><th>Time</th><th></th>
    </tr>
    
<?php
  //2021.03.24 start  while ($row = mysql_fetch_array($pageResult))
  while ($row = $db->Next_Record($pageResult))
  //2021.03.24 end
  {
  $medium = $row['medium'];
?>
	<tr>
        <td><?php if ($medium=='English') echo $row['codeEnglish']; else if ($medium=='Sinhala') echo $row['codeSinhala']; ?></td>
		<td><?php if ($medium=='English') echo $row['nameEnglish']; else if ($medium=='Sinhala') echo $row['nameSinhala']; ?></td>
        <td><?php echo $row['venue'] ?></td>
        <td><?php echo $row['name'] ?></td>
        <td><?php if ($medium=='English') echo $row['dayOfWeekE']; else if ($medium=='Sinhala') echo $row['dayOfWeekS']; echo " @ ".$row['timeSlot'];?></td>
        <td><input name="btnDelete" type="button" value="Delete" class="button" onclick="if (MsgOkCancel()) document.location.href='lectureSchedule.php?cmd=delete&subjectID=<?php echo $row['subjectID'] ?>&venueNo=<?php echo $row['venueNo'] ?>&epfNo=<?php echo $row['epfNo'] ?>&slotID=<?php echo $row['slotID'] ?>'" /></td>
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
  $pagetitle = "Lecture Schedule - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Lecture Schedule</li></ul>";
  //Apply the template
  include("master_registration.php");
?>