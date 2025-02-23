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
    //2021-03-23 start include('dbAccess.php');
	require_once("dbAccess.php");
	$db = new DBOperations();
    //2021-03-23 end


    //include('authcheck.inc.php');
  
  if (isset($_GET['cmd']) && $_GET['cmd']=="delete")
  {
	//2021-03-23 start $subjectID = cleanInput($_GET['subjectID']);
	$subjectID = $db->cleanInput($_GET['subjectID']);
	//2021-03-23 end  
	  
	$delQuery = "DELETE FROM subject WHERE subjectID='$subjectID'";
	//2021-03-23 start $result = executeQuery($delQuery);
	$result = $db->executeQuery($delQuery);
	//2021-03-23 end 
	  
	  
  }
  
  //session_start();
  
  $rowsPerPage = 1000;
  $pageNum = 1;
  if(isset($_GET['page'])) $pageNum = $_GET['page'];

  $query = "SELECT * FROM localapplicant JOIN applicantsubjects ON localapplicant.appNo = applicantsubjects.appNo JOIN applicant ON localapplicant.appNo = applicant.appNo and applicant.entryYear='2023'  ";
  
  //Set filter according  to list box values
  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
  	$pageNum = 1;
	//$faculty = $_POST['lstFaculty'];
	$year = $_POST['lstYear'];
	$title = $_POST['lstTitle'];
	//$spCategory= $_POST['lstsubject'];
	print $spCategory;

	
	//$_SESSION['faculty'] = $faculty;
	$_SESSION['alYear'] = $year;
	$_SESSION['titleE'] = $title;
	//$_SESSION['spCategory'] = $spCategory;
	

	
	$subQuery = filterQuery($year,$title);
	$query = $query.$subQuery;
  }
  
  else if (isset($_SESSION['alYear']) && isset($_SESSION['titleE']) )
  {
	
	
	
	$year = $_SESSION['alYear'];
	$title = $_SESSION['titleE'];
	
	
  	$subQuery = filterQuery($year,$title);
	//print 'subQuery';
	//print 	$subQuery;
	$query = $query.$subQuery;
	//print $query;

  }
 
   function filterQuery($year,$title)
  {

 
		
	// (1,_,_)
		if ($year<>'0')
		{
			$subQuery = " WHERE alYear='".$year."'   "; 
			// (1,1,_)
			if ($title<>'0')
			{
				$subQuery = $subQuery." AND titleE='".$title."' AND subjectCode = '12' AND appType='Local'   "; 
				
				 }// (1,1,1)
				 else if ($title=='0'){
					$subQuery = " WHERE alYear='".$year."' AND subjectCode = '12' AND appType='Local'   "; 
				}
		
	}

	if ($year=='0')
		{
			// (1,1,_)
			if ($title<>'0')
			{
				$subQuery = " WHERE titleE='".$title."' AND subjectCode = '12' AND appType='Local' "; 
				
				 }// (1,1,1)
				 
		
	}

	
	
	
	else{
$subQuery = $subQuery." ORDER BY localapplicant.zScore DESC ";
} 
//print $subQuery;
	return $subQuery;
  }
  $_SESSION['query'] = $query;
  // counting the offset
	$offset = ($pageNum - 1) * $rowsPerPage;
	

	//2021-03-23 start $numRows = mysql_num_rows(executeQuery($query));
	$numRows = $db->Row_Count($db->executeQuery($query));
	//2021-03-23 end
	$numPages = ceil($numRows/$rowsPerPage);
  

  	$pageQuery = $query." LIMIT $offset, $rowsPerPage";
	//2021-03-23 start $pageResult = executeQuery($pageQuery);
	$pageResult = $db->executeQuery($pageQuery);
	//2021-03-23 end


	////////////////////////////////////////////////
	//selecting applicants for the interview
	if (isset($_POST['interview'])) {
		$rowNum = $_POST['chk'];
	 $Count=count($rowNum);
	 //echo $Count;
		if ($Count>0){
			foreach ($rowNum as $a){
		 $row= explode(";",$a);
		 //print_r ($row);
		 $select="Yes";
		 $queryS = "UPDATE applicant set qualified='$select' WHERE appNo='$row[0]'";
		 $resultS = $db->executeQuery($queryS);
		 
		 
		 $queryR="SELECT appNo,titleE,nameEnglish FROM applicant  WHERE appNo='$row[0]'";
		 $resultR = $db->executeQuery($queryR);
		 
			 while($data=$db->Next_Record($resultR))
			 {

			
			 
			 //$queryS = "UPDATE student set confirmed='$select' WHERE appNo='$row[0]'";
			 $queryS="INSERT INTO interview_list set appNo='$row[0]',name='".$data['nameEnglish']."',title='".$data['titleE']."'";

			 //2021.03.24 start  $resultS = executeQuery($queryS);
			 $resultS = $db->executeQuery($queryS);

			 }
			
		 }
		
	}
	header("location:studentConfirm.php");

}

	


?>
  
  <h1>Update Selected List</h1>
  <form method="post" action="" class="plain">
  <table style="margin-left:8px" class="panel">
  	<tr>
      
			
    
        <td>A/L Year</td>
        <td>
            <select name="lstYear" id="lstYear" onchange="this.form.submit();">
            <?php
				//2021-03-23 start $result = executeQuery("SELECT DISTINCT level FROM subject");
				$result = $db->executeQuery("SELECT DISTINCT alYear FROM localapplicant");
				//if (mysql_num_rows($result)>0)
				if ($db->Row_Count($result)>0)
				//2021-03-23 end	
				{
					echo "<option value='0'>All</option>";
					//2021-03-23 start while ($row=mysql_fetch_array($result))
					while ($row=$db->Next_Record($result))
					//2021-03-23 end
					{
						if (isset($_POST['lstYear']) && $_POST['lstYear']==$row['alYear'])
							echo "<option selected='selected' value='".$row['alYear']."'>".$row['alYear']."</option>";
						else if (isset($_SESSION['alYear']) && $_SESSION['alYear']==$row['alYear'])
							echo "<option selected='selected' value='".$row['alYear']."'>".$row['alYear']."</option>";
						else echo "<option value='".$row['alYear']."'>".$row['alYear']."</option>";
					}
				}
			?>
            </select>
        </td>
		<td>Title</td>
        <td>
            <select name="lstTitle" id="lstTitle" onchange="this.form.submit();">
            <?php
				//2021-03-23 start $result = executeQuery("SELECT DISTINCT semester FROM subject");
				$result = $db->executeQuery("SELECT DISTINCT titleE FROM applicant");
				//if (mysql_num_rows($result)>0)
				if ($db->Row_Count($result)>0)
				//2021-03-23 end
				{
					echo "<option value='0'>All</option>";
					//2021-03-23 start while ($row=mysql_fetch_array($result))
					while ($row=$db->Next_Record($result))
					//2021-03-23 end
					{
						if (isset($_POST['lstTitle']) && $_POST['lstTitle']==$row['titleE'])
							echo "<option selected='selected' value='".$row['titleE']."'>".$row['titleE']."</option>";
						else if (isset($_SESSION['titleE']) && $_SESSION['titleE']==$row['titleE'])
							echo "<option selected='selected' value='".$row['titleE']."'>".$row['titleE']."</option>";
						else echo "<option value='".$row['titleE']."'>".$row['titleE']."</option>";
					}
				}
			?>
            </select>
        </td>

		<td><input name="interview" id="interview" type="submit" value="Select"  class="button" onclick="document.location.href ='studentConfirm.php'"/></td>
  	</tr>

  </table>
  <table>
	  <tr>
	  <!-- <td><input name="select" type="button" value="Select All"  class="button" onclick="document.location.href ='tails.php?appNo=<?php echo $row['appNo'] ?> & appType=<?php echo $row['appType'] ?>'"/></td> -->

	  </tr>
  </table>
<?php 
	  //2021-03-23 start if (mysql_num_rows($pageResult)>0)
	  if ($db->Row_Count($pageResult)>0)
	  //2021-03-23 end
	  { ?>
<br/>
  <table class="searchResults">
	<tr>
    	<th><input id="chk2[]" name="chk[]" type="checkbox" value="<?php echo $row['appNo'] ?>">
</th><th>AppNo</th><th>Name</th><th ></th>
    </tr>
    <script>
		document.getElementById('chk2[]').onclick = function() {
    var checkboxes = document.getElementsByName('chk[]');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
}
		</script>
<?php
  //2021-03-23 start while ($row = mysql_fetch_array($pageResult))
  while ($row = $db->Next_Record($pageResult))
  //2021-03-23 end  
  {

?>
	<tr>
	<td><input id="chk1[]" name="chk[]" type="checkbox" value="<?php echo $row['appNo'] ?>"><br>
        <td><?php echo $row['applicationNo'] ?></td>
		<td><?php echo $row['nameEnglish'] ?></td>

        <!-- <td><input name="btnDelete" type="button" value="Delete" class="button" onclick="if (MsgOkCancel()) document.location.href ='as.php?cmd=delete&subjectID=<?php echo $row['subjectID'] ?>'" /></td> -->
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
}else echo "<p>No Students.</p>";

?>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Subjects - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Interview List</li></ul>";
  //Apply the template
  include("master_registration.php");
?>