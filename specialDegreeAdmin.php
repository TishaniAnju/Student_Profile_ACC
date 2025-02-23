<?php
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
	require_once("dbAccess.php");
	$db = new DBOperations();

  //include('authcheck.inc.php');
  
  if (isset($_GET['cmd']) && $_GET['cmd']=="delete")
  {
    $subjectID = $db->cleanInput($_GET['subjectID']);
    $delQuery = "DELETE FROM special_degree WHERE sid='$subjectID'";
    $result = $db->executeQuery($delQuery); 
  }
    
  $rowsPerPage = 10;
  $pageNum = 1;
  if(isset($_GET['page'])) $pageNum = $_GET['page'];

  $query = "SELECT * FROM special_degree";
  
  $_SESSION['query'] = $query;

	$offset = ($pageNum - 1) * $rowsPerPage;
	
	$numRows = $db->Row_Count($db->executeQuery($query));
	
	$numPages = ceil($numRows/$rowsPerPage);
  
  	$pageQuery = $query." LIMIT $offset, $rowsPerPage";

	$pageResult = $db->executeQuery($pageQuery);

?>
  
  <h1>Subject Administration</h1>
  <form method="post" action="" class="plain">
  <table style="margin-left:8px" class="panel">
  	<tr>
    	<td><input name="btnNew" type="button" value="New" onclick="document.location.href = 'specialDegreeNew.php';" class="button" /></td>
  	</tr>
  </table>
<?php 
	  
	  if ($db->Row_Count($pageResult)>0)
	 
	  { ?>
<br/>
  <table class="searchResults">
	<tr>
    	<th>Description</th><th colspan="3"></th>
    </tr>
    
<?php
  
  while ($row = $db->Next_Record($pageResult))  
  {
	  $resultp = $db->executeQuery("SELECT sid,description FROM special_degree");
?>
	<tr>
        <td><?php echo $row['description'] ?></td>
		
        <td><input name="btnEdit" type="button" value="Edit" onclick="document.location.href ='specialDegreeEdit.php?sid=<?php echo $row['sid'] ?>'" class="button" /></td>
        <td><input name="btnDelete" type="button" value="Delete" class="button" onclick="if (MsgOkCancel()) document.location.href ='specialDegreeAdmin.php?cmd=delete&subjectID=<?php echo $row['sid'] ?>'" /></td>
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
}else echo "<p>No Special Degrees.</p>";

?>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Special Degree Subjects - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Special Degree Subjects</li></ul>";
  //Apply the template
  include("master_registration.php");
?>