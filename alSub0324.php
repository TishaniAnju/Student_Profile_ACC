<?php
  //Buffer larger content areas like the main page content
  ob_start();
 ?>
 <script>
 	function MsgOkCancel()
	{
		var message = "Please confirm to DELETE this item...";
		var return_value = confirm(message);
		return return_value;
	}
 </script>
 <?php
  include("dbAccess.php");
  include("authcheck.inc.php");
  
  $rowsPerPage = 10;
  $pageNum = 1;
  if(isset($_GET['page'])) $pageNum = $_GET['page'];

 /* if (isset($_POST['txtSearch']) && strlen($_POST['txtSearch'])>0)
  {
  	$searchValue = cleanInput($_POST['txtSearch']);
  	$query = "SELECT accNo,author,title,type FROM item JOIN itemtype ON item.itemType = itemtype.typeID WHERE MATCH (accNo,IRFID,type,author,title,publisher,keywords) AGAINST ('$searchValue' IN BOOLEAN MODE) ORDER BY accNo";
  }
  else*/
  	$query = "SELECT * FROM alsubjects ORDER BY subjectCode";
  
 if (isset($_GET['cmd']) && $_GET['cmd']=="delete")
	{
		$subCode = cleanInput($_GET['subCode']);
		//$subNS= cleanInput($_GET['subnamS']);
		$delQuery1 = "DELETE FROM alsubjects WHERE subjectCode='$subCode'";
		$result1 = executeQuery($delQuery1);
	}	
  // counting the offset
	$offset = ($pageNum - 1) * $rowsPerPage;
	$numRows = mysql_num_rows(executeQuery($query));
	$numPages = ceil($numRows/$rowsPerPage);
  
  	$pageQuery = $query." LIMIT $offset, $rowsPerPage";
	$result = executeQuery($pageQuery);
?>
<h1>GCE A/L Subjects</h1>
  
<br/>
<form method="post" action="" class="plain">
  <table style="margin-left:8px"><tr><td><input name="btnNew" type="button" value="New" onclick="document.location.href = 'newAlSub.php';" class="button" /></td><td>&nbsp;&nbsp;&nbsp;</td></table>
	<?php if (mysql_num_rows($result)>0){ ?>
  
  <table class="searchResults">
	<tr>
    	<th>Subject Code</th><th>Subject Name in English</th><th>Subject Name in Sinhala</th>
        <th colspan="2">&nbsp;</th>
	</tr>
    
<?php
  while ($row = mysql_fetch_array($result))
  {
?>
	<tr>
    	<td><?php echo $row['subjectCode'] ?></td>
        <td><?php echo $row['subnameE'] ?></td>
        <td><?php echo $row['subnameS'] ?></td>
		<td><input name="btnEdit" type="button" value="Edit" onclick="document.location.href ='editAlSub.php?subCode=<?php echo $row['subjectCode'] ?>'" class="button" /></td>
		<td><input name="btnDelete" type="button" value="Delete" onclick="if (MsgOkCancel()) document.location.href ='alSub.php?cmd=delete&subCode=<?php echo $row['subjectCode'] ?>';" class="button" /></td>
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
}else echo "<p>No Subjects</p>";

?>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "A/L Subjects - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>A/L Subjects</li></ul>";
  //Apply the template
  include("master_registration.php");
?>