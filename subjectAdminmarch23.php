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
	$subjectID = cleanInput($_GET['subjectID']);
	$delQuery = "DELETE FROM subject WHERE subjectID='$subjectID'";
	$result = executeQuery($delQuery);
  }
  
  //session_start();
  
  $rowsPerPage = 10;
  $pageNum = 1;
  if(isset($_GET['page'])) $pageNum = $_GET['page'];

  $query = "SELECT * FROM subject";
  
  //Set filter according  to list box values
  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
  	$pageNum = 1;
	$faculty = $_POST['lstFaculty'];
	$level = $_POST['lstLevel'];
	$semester = $_POST['lstSemester'];
	$spCategory= $_POST['lstsubject'];
	print $spCategory;

	
	$_SESSION['faculty'] = $faculty;
	$_SESSION['level'] = $level;
	$_SESSION['semester'] = $semester;
	$_SESSION['spCategory'] = $spCategory;
	

	
	$subQuery = filterQuery($faculty,$level,$semester,$spCategory);
	$query = $query.$subQuery;
  }
  
  //else if (isset($_SESSION['faculty']) && isset($_SESSION['level']) && isset($_SESSION['semester']))
  else if (isset($_SESSION['faculty']) && isset($_SESSION['level']) && isset($_SESSION['semester']) && isset($_SESSION['spCategory']))
  {
	/*
	$faculty = $_SESSION['faculty'];
	$level = $_SESSION['level'];
	$semester = $_SESSION['semester'];
	print $semester;
  	$subQuery = filterQuery($faculty,$level,$semeseter);
	
	$query = $query.$subQuery;
	print $query;
	print 'x';*/
	
	$faculty = $_SESSION['faculty'];
	$level = $_SESSION['level'];
	$semester = $_SESSION['semester'];
	$spCategory = $_SESSION['spCategory'];
	//print 'sssssss';
	//print $spCategory;
	
  	$subQuery = filterQuery($faculty,$level,$semester,$spCategory);
	//print 'subQuery';
	//print 	$subQuery;
	$query = $query.$subQuery;
	//print $query;

  }
 /* 
  function filterQuery($faculty,$level,$semeseter)
  {
	$subQuery = "";
	if($semester<>'0')
	$subQuery = " WHERE semester='".$semester."'";
	print $subQuery;
	{
	if ($faculty<>'0')
	{
		$subQuery = " AND faculty='".$faculty."'"; // (1,_)
		if ($level<>'0')
			$subQuery = $subQuery." AND level='".$level."'"; 
			 print $subQuery;// (1,1)
			
			 print  $subQuery;
	}
	else
	{
	
		if ($level<>'0')
			$subQuery = " WHERE level='".$level."'"; // (0,1)
			
	}
	
	}
	$subQuery = $subQuery." ORDER BY codeEnglish";
	return $subQuery;
  }
  */
   function filterQuery($faculty,$level,$semester,$spCategory)
  {

 if ($faculty<>'0')
	{
		$subQuery = " WHERE faculty='".$faculty."'";; 
	// (1,_,_)
		if ($level<>'0')
		{
			$subQuery = $subQuery." AND level='".$level."'"; 
			// (1,1,_)
			if ($semester<>'0')
			{
				$subQuery = $subQuery." AND semester='".$semester."'"; 
				
				 }// (1,1,1)
			
		else if ($semester<>'0'){
			$subQuery = $subQuery." AND semester='".$semester."'";
		
			} // (1,0,1)
	}
	}
	if($faculty=='0')
	{
	
		if ($level<>'0')
		{
			$subQuery = " WHERE level='".$level."'"; 
	 // (0,1,_)
			if ($semester<>'0'){
				$subQuery = $subQuery." AND semester='".$semester."'"; 
				
				}// (0,1,1)
		}
		else if ($semester<>'0'){
			$subQuery = " WHERE semester='".$semester."'";
		
			}
			
			} // (0,0,1)
	if($spCategory<>'0'){
	//print $spCategory;
	if($level=='0' && $faculty=='0'&& $semester=='0'){
	$subQuery2=" WHERE spCategory='".$spCategory."'";
	$subQuery = $subQuery.$subQuery2." ORDER BY level,semester ASC,suborder ASC";
	}
	else{
	$subQuery2=" AND spCategory='".$spCategory."'";
	$subQuery = $subQuery.$subQuery2." ORDER BY level,semester ASC,suborder ASC";
	}
	}
	else{
$subQuery = $subQuery." ORDER BY level,semester ASC,suborder ASC";
} 
//print $subQuery;
	return $subQuery;
  }
  $_SESSION['query'] = $query;
  // counting the offset
	$offset = ($pageNum - 1) * $rowsPerPage;
	$numRows = mysql_num_rows(executeQuery($query));
	$numPages = ceil($numRows/$rowsPerPage);
  

  	$pageQuery = $query." LIMIT $offset, $rowsPerPage";
	$pageResult = executeQuery($pageQuery);
?>
  
  <h1>Subject Administration</h1>
  <form method="post" action="" class="plain">
  <table style="margin-left:8px" class="panel">
  	<tr>
    	<td><input name="btnNew" type="button" value="New" onclick="document.location.href = 'subjectNew.php';" class="button" /></td>
      
			
      
        <td>Faculty</td>
        <td>
            <select name="lstFaculty" id="lstFaculty" onchange="this.form.submit();">
            <?php
				$result = executeQuery("SELECT DISTINCT faculty FROM subject");
				if (mysql_num_rows($result)>0)
				{
					echo "<option value='0'>All</option>";
					while ($row=mysql_fetch_array($result))
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
    
        <td>Level</td>
        <td>
            <select name="lstLevel" id="lstLevel" onchange="this.form.submit();">
            <?php
				$result = executeQuery("SELECT DISTINCT level FROM subject");
				if (mysql_num_rows($result)>0)
				{
					echo "<option value='0'>All</option>";
					while ($row=mysql_fetch_array($result))
					{
						if (isset($_POST['lstLevel']) && $_POST['lstLevel']==$row['level'])
							echo "<option selected='selected' value='".$row['level']."'>".$row['level']."</option>";
						else if (isset($_SESSION['level']) && $_SESSION['level']==$row['level'])
							echo "<option selected='selected' value='".$row['level']."'>".$row['level']."</option>";
						else echo "<option value='".$row['level']."'>".$row['level']."</option>";
					}
				}
			?>
            </select>
        </td>
		<td>Semester</td>
        <td>
            <select name="lstSemester" id="lstSemester" onchange="this.form.submit();">
            <?php
				$result = executeQuery("SELECT DISTINCT semester FROM subject");
				if (mysql_num_rows($result)>0)
				{
					echo "<option value='0'>All</option>";
					while ($row=mysql_fetch_array($result))
					{
						if (isset($_POST['lstSemester']) && $_POST['lstSemester']==$row['semester'])
							echo "<option selected='selected' value='".$row['semester']."'>".$row['semester']."</option>";
						else if (isset($_SESSION['semester']) && $_SESSION['semester']==$row['semester'])
							echo "<option selected='selected' value='".$row['semester']."'>".$row['semester']."</option>";
						else echo "<option value='".$row['semester']."'>".$row['semester']."</option>";
					}
				}
			?>
            </select>
        </td>
  	</tr>
	<tr>
    
      
			<td><input name="btnorder" type="button" value="Order" onclick="document.location.href = 'OrderSubject.php';" class="button" /></td>
      
        <td>Department</td>
        <td>
            <select name="lstsubject" id="lstsubject" onchange="this.form.submit();">
            <?php  
			
			//$query = "SELECT * FROM subject WHERE level='$level' and semester='$semester'";
			$query = "SELECT * FROM department";
		//print $query;
			$result = executeQuery($query);
			echo "<option value='0'>All</option>";
			for ($i=0;$i<mysql_numrows($result);$i++)
			{
				$rID = mysql_result($result,$i,"departmentNo");
				$rCode = mysql_result($result,$i,"department");
				
              	echo "<option value=\"".$rID."\">".$rCode."</option>";
        	} 
			
			?>
            </select>
        </td>
    
        
	
        
  	</tr>
  </table>
<?php if (mysql_num_rows($pageResult)>0){ ?>
<br/>
  <table class="searchResults">
	<tr>
    	<th>Code</th><th>Name</th><th>Faculty</th><th>Level</th><th>Semester</th><th>Credit Hours</th><th colspan="3"></th>
    </tr>
    
<?php
  while ($row = mysql_fetch_array($pageResult))
  {

?>
	<tr>
        <td><?php echo $row['codeEnglish'] ?></td>
		<td><?php echo $row['nameEnglish'] ?></td>
        <td><?php echo $row['faculty'] ?></td>
        <td><?php echo $row['level'] ?></td>
		<td><?php echo $row['semester'] ?></td>
		<td><?php echo $row['creditHours'] ?></td>
        <td><input name="btnDetails" type="button" value="Details" onclick="document.location.href ='subjectDetails.php?subjectID=<?php echo $row['subjectID'] ?>'"  class="button" /></td>
        <td><input name="btnEdit" type="button" value="Edit" onclick="document.location.href ='subjectEdit.php?subjectID=<?php echo $row['subjectID'] ?>'" class="button" /></td>
        <td><input name="btnDelete" type="button" value="Delete" class="button" onclick="if (MsgOkCancel()) document.location.href ='subjectAdmin.php?cmd=delete&subjectID=<?php echo $row['subjectID'] ?>'" /></td>
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
}else echo "<p>No subjects.</p>";

?>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Subjects - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Subjects</li></ul>";
  //Apply the template
  include("master_registration.php");
?>