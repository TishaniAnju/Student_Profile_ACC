<?php
  //Buffer larger content areas like the main page content
  ob_start();
 ?>
 <script>
 	function MsgOkCancel()
	{
		var message = "Please confirm to DELETE this entry...";
		var return_value = confirm(message);
		return return_value;
	}
	function quickSearch()
	{
		var appNo = document.getElementById('txtSearch').value;
		if (appNo == "")
			alert("Enter a Applicant no.!");
		 
		else
		{
			document.location.href ='applicantDetails.php?appNo='+appNo;
		}
	}
 </script>
 <?php
  include("dbAccess.php");
  include("authcheck.inc.php");
 
  $rowsPerPage = 10;
  $pageNum = 1;
  if(isset($_GET['page'])) $pageNum = $_GET['page'];

 	$queryY = "SELECT MAX(entryYear) FROM applicant";
	$resultY = executeQuery($queryY);
	$year=mysql_fetch_array($resultY);
	//echo $year[0];
  	$query = "SELECT appNo,titleE,nameEnglish,appType,qualified FROM applicant WHERE entryYear = '$year[0]' ORDER BY appNo";
	
	 //Set filter according  to list box values
  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
  	$pageNum = 1;
	$entryYear = $_POST['lstentryYear'];		
	$_SESSION['entryYear'] = $entryYear;
	$query = "SELECT appNo,titleE,nameEnglish,appType,qualified FROM applicant WHERE entryYear = '$entryYear' ORDER BY appNo";
  }
  
  else if (isset($_SESSION['entryYear']))
  {
	$entryYear = $_SESSION['entryYear'];
	$query = "SELECT appNo,titleE,nameEnglish,appType,qualified FROM applicant WHERE entryYear = '$entryYear' ORDER BY appNo";
  }
	
  	// Deleting from DB
	if (isset($_GET['cmd']) && $_GET['cmd']=="delete")
	{
		$id = cleanInput($_GET['appNo']);
		$type= $_GET['appType'];
		if($type=='Local')
		{
		$delQuery1 = "DELETE FROM applicantsubjects WHERE appNo='$id'";
		//$result1 = executeQuery($delQuery1);
		$delQuery2 = "DELETE FROM applicantpali WHERE appNo='$id'";
		//$result1 = executeQuery($delQuery1);
		$delQuery3 = "DELETE FROM localapplicant WHERE appNo='$id'";
		//$result2 = executeQuery($delQuery2);
		$delQuery4 = "DELETE FROM applicant WHERE appNo='$id'";
		//$result3 = executeQuery($delQuery3);
		$quaries = array($delQuery1,$delQuery2,$delQuery3,$delQuery4);
		$result = executeTransaction($quaries);
		}
		elseif($type=='Foreign')
		{
		$delQuery1 = "DELETE FROM foreignsubjects WHERE appNo='$id'";
		//$result1 = executeQuery($delQuery1);
		$delQuery2 = "DELETE FROM foreignapplicant WHERE appNo='$id'";
		//$result2 = executeQuery($delQuery2);
		$delQuery3 = "DELETE FROM applicant WHERE appNo='$id'";
		//$result3 = executeQuery($delQuery3);
		$quaries = array($delQuery1,$delQuery2,$delQuery3);
		$result = executeTransaction($quaries);
		
		}
	}
  
  
	//Selecting applicants
	
	if (isset($_POST['btnSelect'])) {
	   	$rowNum = $_POST['chk'];
		$Count=count($rowNum);
		//echo $Count;
       	if ($Count>0){
	       	foreach ($rowNum as $a){
			$row= explode(";",$a);
			//print_r ($row);
			$select="Yes";
			$queryS = "UPDATE applicant set qualified='$select' WHERE appNo='$row[0]'";
			$resultS = executeQuery($queryS);
			
			if($row[1]=="Local")
			{
			$queryR="SELECT titleE,nameEnglish,addressEnglish1,addressEnglish2,addressEnglish3,district,entryYear,nameSinhala,addS1,addS2,addS3,nicNo, entryType FROM applicant JOIN localapplicant ON localapplicant.appNo = applicant.appNo WHERE applicant.appNo='$row[0]'";
			$resultR = executeQuery($queryR);
				while($data=mysql_fetch_array($resultR))
				{
				$appNo=$data['entryYear'].'/'.$row[0];
				$queryS="INSERT INTO student set appNo='$appNo',title='".$data['titleE']."', nameEnglish='".$data['nameEnglish']."',addressE1='".$data['addressEnglish1']."',addressE2='".$data['addressEnglish2']."',addressE3='".$data['addressEnglish3']."',district='".$data['district']."', yearEntry='".$data['entryYear']."', nameSinhala='".$data['nameSinhala']."',addressS1='".$data['addS1']."',addressS2='".$data['addS2']."',addressS3='".$data['addS3']."',id_pp_No='".$data['nicNo']."',entryType='".$data['entryType']."'";
				$resultS = executeQuery($queryS);
				}
			}
			elseif($row[1]=="Foreign")
			{
			$queryR="SELECT titleE,nameEnglish,addressEnglish1,addressEnglish2,addressEnglish3,entryYear, ppNo,country FROM applicant JOIN foreignapplicant ON foreignapplicant.appNo = applicant.appNo WHERE applicant.appNo='$row[0]'";
			$resultR = executeQuery($queryR);
				while($data=mysql_fetch_array($resultR))
				{
				$appNo=$data['entryYear'].'/'.$row[0];
				$queryS="INSERT INTO student set appNo='$appNo',title='".$data['titleE']."', nameEnglish='".$data['nameEnglish']."',addressE1='".$data['addressEnglish1']."',addressE2='".$data['addressEnglish2']."',addressE3='".$data['addressEnglish3']."',yearEntry='".$data['entryYear']."',id_pp_No='".$data['ppNo']."',entryType='Foreign'";
				$resultS = executeQuery($queryS);
				}
			}
			}
		} 
		}
		
		
		if (isset($_POST['btnDeselect'])) 
		{
			
			$rowNum = $_POST['chk'];
			$Count=count($rowNum);
			//echo $Count;
			if ($Count>0)
			{
				foreach ($rowNum as $a)
					{
					$row= explode(";",$a);
					//print_r ($row);
					$queryS = "UPDATE applicant set qualified='No' WHERE appNo='$row[0]'";
					$resultS = executeQuery($queryS);
					$queryS = "SELECT entryYear FROM applicant WHERE appNo='$row[0]'";
					$resultS = executeQuery($queryS);
					$data=mysql_fetch_array($resultS);
					$appNo=$data['entryYear'].'/'.$row[0];
					$queryD = "DELETE FROM student WHERE appNo='$appNo'";
					$resultD = executeQuery($queryD);
					
					}
				}
			} 
		
		
		
	

// counting the offset
	$offset = ($pageNum - 1) * $rowsPerPage;
	//echo $query;
	$numRows = mysql_num_rows(executeQuery($query));
	$numPages = ceil($numRows/$rowsPerPage);
  
  	$pageQuery = $query." LIMIT $offset, $rowsPerPage";
	$result = executeQuery($pageQuery);	
?>
    <h1>Applicants</h1>
    <div id="tabs">
      <ul>
        <li><a href="applicant.php"><span class="current">All Applicants</span></a></li>
        <li><a href="localApplicants.php"><span>Local Applicants</span></a></li>
        <li><a href="foreignApplicants.php"><span>Foreign Applicants</span></a></li>
      </ul>
    </div>
    <br/><br/><br/><br/><br/><br/>
    
<form method="post" action="applicant.php" class="plain">
  <table class="panel" style="margin-left:8px">
    <tr>
    	<td><input name="btnNew" type="button" value="New" onclick="document.location.href = 'newApplicant.php';" class="button" />
    	<td><input name="btnSearch" type="button" value="Search" onclick="quickSearch();" class="button"/></td>
    	<td><input name="txtSearch" id="txtSearch" type="text" /> (Applicant No.)</td>
      	<td align="lefy"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Year of Entry</font>
          <select name="lstentryYear" id="lstentryYear" onchange="this.form.submit();">
            <?php
			$queryY = "SELECT DISTINCT entryYear FROM applicant ORDER BY entryYear DESC";
			$resultY = executeQuery($queryY);
			while ($year=mysql_fetch_array($resultY))
					{
						if (isset($_POST['lstentryYear']) && $_POST['lstentryYear']==$year['entryYear'])
							echo "<option selected='selected' value='".$year['entryYear']."'>".$year['entryYear']."</option>";
						else if (isset($_SESSION['entryYear']) && $_SESSION['entryYear']==$year['entryYear'])
							echo "<option selected='selected' value='".$year['entryYear']."'>".$year['entryYear']."</option>";
						else echo "<option value='".$year['entryYear']."'>".$year['entryYear']."</option>";
					}
			?>
          </select>
      </td>
  	</tr>
  </table>

<br/>
	<?php if (mysql_num_rows($result)>0){ ?>
  <table class="searchResults">
	<tr>
	  <th>&nbsp;</th>
    	<th>Applicant No</th>
   	    <th>Title</th>
   	  <th>Name</th>
   	  <th>Applicant Type</th>
   	  <th>Qualified</th>
   	  <th colspan="3"></th>
    </tr>
    
<?php
	$rowNum=0;
  while ($row = mysql_fetch_array($result))
  { 
 ?>
	<tr>
	  <td><input name="chk[]" type="checkbox" value="<?php echo $row['appNo'].";". $row['appType'] ?>"><br>
        <td><?php echo $row['appNo'] ?></td>
        <td><?php echo $row['titleE'] ?></td>
		<td><?php echo $row['nameEnglish'] ?></td>
        <td><?php echo $row['appType'] ?></td>
        <td><?php echo $row['qualified'] ?></td>
        <td><input name="btnDetails" type="button" value="Details"  class="button" onclick="document.location.href ='applicantDetails.php?appNo=<?php echo $row['appNo'] ?> '"/></td>
        <td><input name="btnEdit" type="button" value="Edit" onclick="document.location.href ='editApplicant.php?appNo=<?php echo $row['appNo'] ?> & appType=<?php echo $row['appType'] ?> '" class="button" /></td>
        <td><input name="btnDelete" type="button" value="Delete" onclick="if (MsgOkCancel()) document.location.href ='applicant.php?cmd=delete&appNo=<?php echo $row['appNo'] ?> & appType=<?php echo $row['appType'] ?> ';" class="button" /></td>
    </tr>
<?php
$rowNum+=1;
  }  
?>
</table>
 <input name="btnSelect" type="submit" id="btnSelect" value="Select" class="button"/> 

 <input type="submit" name="btnDeselect" id="btnDeSelect" value="Deselect" class="button" />
 
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

echo "<table border=\"0\" align=\"center\" width=\"50%\"><tr><td width=\"10%\">".$first."</td><td width=\"10%\">".$prev."</td><td width=\"30%\">"."$pageNum of $numPages"."</td><td width=\"10%\">".$next."</td><td width=\"10%\">".$last."</td></tr></table>";
}else echo "<p>No Entries</p>";

?>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Applicants - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Applicants</li></ul>";
  //Apply the template
  include("master_registration.php");
?>