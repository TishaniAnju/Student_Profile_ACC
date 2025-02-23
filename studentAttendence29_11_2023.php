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
  
  
  //session_start();
  
  $rowsPerPage = 10;
  $pageNum = 1;
  if(isset($_GET['page'])) $pageNum = $_GET['page'];
  
  //$query = "SELECT  subjectID,acYear,indexNo FROM studentenrolment WHERE entryYear = '$faculty' acYear = '$level';
  $query = "SELECT subjectID,acYear,indexNo,totaldates,percentage,totalpresentdates,totalabcentdates FROM attendence ";
  
  //Set filter according  to list box values
  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
  	$pageNum = 1;
	$faculty = $_POST['subjectid'];
	$level = $_POST['acyear'];
	/* $semester = $_POST['lstSemester'];
	$spCategory= $_POST['lstsubject'];
	print $spCategory; */
	
	
	$_SESSION['subjectID'] = $faculty;
	$_SESSION['acYear'] = $level;
	/* $_SESSION['semester'] = $semester;
	$_SESSION['spCategory'] = $spCategory; */
	

	
	$subQuery = filterQuery($faculty,$level);
	$query = $query.$subQuery;
  }
  
  //else if (isset($_SESSION['faculty']) && isset($_SESSION['level']) && isset($_SESSION['semester']))
  else if (isset($_SESSION['subjectID']) && isset($_SESSION['acYear']) )
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
	
	$faculty = $_SESSION['subjectID'];
	$level = $_SESSION['acYear'];
	/* $semester = $_SESSION['semester'];
	$spCategory = $_SESSION['spCategory']; */
	//print 'sssssss';
	//print $spCategory;
	
  	$subQuery = filterQuery($faculty,$level);
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
   function filterQuery($faculty,$level)
  {

 if ($faculty<>'0')
	{
		$subQuery = " WHERE  subjectID='".$faculty."'";; 
	// (1,_,_)
		if ($level<>'0')
		{
			$subQuery = $subQuery." AND acYear='".$level."'"; 
			// (1,1,_)
			
			
	}
	}
    else if ($level<>0){
        $subQuery = " WHERE acYear='".$level."'"; // (0,0,1)
    }
	if($faculty=='0')
	{
	
		if ($level<>'0')
		{
			$subQuery = " WHERE acYear='".$level."'"; 
	 // (0,1,_)
			
		}
		elseif($level<>'0')
        {
            $subQuery = " WHERE acYear='".$level."'";
        }
			
			} // (0,0,1)
	/* if($spCategory<>'0'){
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
}  */
//print $subQuery;
	return $subQuery;
  }
  $_SESSION['query'] = $query;
  // counting the offset
	$offset = ($pageNum - 1) * $rowsPerPage;
	

	
	$numRows = $db->Row_Count($db->executeQuery($query));

	$numPages = ceil($numRows/$rowsPerPage);
  

  	$pageQuery = $query." LIMIT $offset, $rowsPerPage";
	
	$pageResult = $db->executeQuery($pageQuery);
	

	if (isset($_POST['btnSelect'])) {
		 
		$rowNum= $_POST['chk'];
        $present = $_POST['lecturedate'];
		$abcent = "$present.ab";

	    $Count=count($rowNum);
		if ($Count>0){
			foreach ($rowNum as $a){
		 $row= explode(";",$a);
		 //$select="Yes";

		 $queryK = "SELECT*FROM attendence WHERE indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'";
		 $resultK = $db->executeQuery($queryK);
		 while($data=$db->Next_Record($resultK))
				{
		if($data['date1'] == null || $data['date1'] == $present || $data['date1'] == $abcent )
		{
			$queryS = "UPDATE attendence set date1='$present' WHERE indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'";
			$resultS = $db->executeQuery($queryS);
		}

        elseif($data['date2'] == null || $data['date2'] == $present || $data['date1'] == $abcent)
		{
			$queryS = "UPDATE attendence set date2='$present' WHERE indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'";
			$resultS = $db->executeQuery($queryS);
		}
		elseif($data['date3'] == null || $data['date3'] == $present || $data['date1'] == $abcent)
		{
			$queryS = "UPDATE attendence set date3='$present' WHERE indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'";
			$resultS = $db->executeQuery($queryS);
		}
		elseif($data['date4'] == null || $data['date4'] == $present || $data['date1'] == $abcent)
		{
			$queryS = "UPDATE attendence set date4='$present' WHERE indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'";
			$resultS = $db->executeQuery($queryS);
		}
		elseif($data['date5'] == null || $data['date5'] == $present || $data['date1'] == $abcent)
		{
			$queryS = "UPDATE attendence set date5='$present' WHERE indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'";
			$resultS = $db->executeQuery($queryS);
		}
		elseif($data['date6'] == null || $data['date6'] == $present || $data['date1'] == $abcent)
		{
			$queryS = "UPDATE attendence set date6='$present' WHERE indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'";
			$resultS = $db->executeQuery($queryS);
		}
		elseif($data['date7'] == null || $data['date7'] == $present || $data['date1'] == $abcent)
		{
			$queryS = "UPDATE attendence set date7='$present' WHERE indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'";
			$resultS = $db->executeQuery($queryS);
		}
		elseif($data['date8'] == null || $data['date8'] == $present || $data['date1'] == $abcent)
		{
			$queryS = "UPDATE attendence set date8='$present' WHERE indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'";
			$resultS = $db->executeQuery($queryS);
		}
		elseif($data['date9'] == null || $data['date9'] == $present || $data['date1'] == $abcent)
		{
			$queryS = "UPDATE attendence set date9='$present' WHERE indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'";
			$resultS = $db->executeQuery($queryS);
		}
		



				}


		 //$queryS = "UPDATE attendence set date1='$select' WHERE indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'";
		 
		// $resultS = $db->executeQuery($queryS);
			}
		}
		
	 }
	 if (isset($_POST['btnDeselect'])) {
		 
		$rowNum= $_POST['chk'];
        $date = $_POST['lecturedate'];


	    $Count=count($rowNum);
		if ($Count>0){
			foreach ($rowNum as $a){
		 $row= explode(";",$a);
		 $select="$date.ab";


		 $queryK = "SELECT*FROM attendence WHERE indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'";
		 $resultK = $db->executeQuery($queryK);
		 while($data=$db->Next_Record($resultK))
				{
		if($data['date1'] == null || $data['date1'] == $date || $data['date1'] == $select )
		{
			$queryS = "UPDATE attendence set date1='$select' WHERE indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'";
			$resultS = $db->executeQuery($queryS);
		}

        elseif($data['date2'] == null || $data['date2'] == $date || $data['date2'] == $select )
		{
			$queryS = "UPDATE attendence set date2='$select' WHERE indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'";
			$resultS = $db->executeQuery($queryS);
		}
		elseif($data['date3'] == null || $data['date3'] == $date || $data['date3'] == $select)
		{
			$queryS = "UPDATE attendence set date3='$select' WHERE indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'";
			$resultS = $db->executeQuery($queryS);
		}
		elseif($data['date4'] == null || $data['date4'] == $date || $data['date4'] == $select)
		{
			$queryS = "UPDATE attendence set date4='$select' WHERE indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'";
			$resultS = $db->executeQuery($queryS);
		}
		elseif($data['date5'] == null || $data['date5'] == $date || $data['date5'] == $select)
		{
			$queryS = "UPDATE attendence set date5='$select' WHERE indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'";
			$resultS = $db->executeQuery($queryS);
		}
		elseif($data['date6'] == null || $data['date6'] == $date || $data['date6'] == $select)
		{
			$queryS = "UPDATE attendence set date6='$select' WHERE indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'";
			$resultS = $db->executeQuery($queryS);
		}
		elseif($data['date7'] == null || $data['date7'] == $date || $data['date7'] == $select)
		{
			$queryS = "UPDATE attendence set date7='$select' WHERE indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'";
			$resultS = $db->executeQuery($queryS);
		}
		elseif($data['date8'] == null || $data['date8'] == $date || $data['date8'] == $select)
		{
			$queryS = "UPDATE attendence set date8='$select' WHERE indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'";
			$resultS = $db->executeQuery($queryS);
		}
		elseif($data['date9'] == null || $data['date9'] == $date || $data['date9'] == $select)
		{
			$queryS = "UPDATE attendence set date9='$select' WHERE indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'";
			$resultS = $db->executeQuery($queryS);
		}
		



				}


		 //$queryS = "UPDATE attendence set date1='$select' WHERE indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'";
		 
		// $resultS = $db->executeQuery($queryS);
			}
		}
		
	 }
	 if (isset($_POST['btnpercentage'])) {
		$rowNum= $_POST['chk'];
		$days =  $db->cleanInput($_POST['abc']);
 
		 $Count=count($rowNum);
		 if ($Count>0){
			 foreach ($rowNum as $a){
		  $row= explode(";",$a);
		 
		//$queryD="SELECT date1,date2,date3,date4,date5,date6,date7,date8,date9 FROM attendence  WHERE indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]' ";
		//$resultD = $db->executeQuery($queryD);

		

		  $queryR="SELECT SUM(CASE WHEN date1 LIKE '%ab' OR date1 IS NULL  THEN 0 ELSE 1 END
        + CASE WHEN date2 LIKE '%ab' OR date2 IS NULL THEN 0 ELSE 1 END
		+ CASE WHEN date3 LIKE '%ab' OR date3 IS NULL THEN 0 ELSE 1 END
		+ CASE WHEN date4 LIKE '%ab' OR date4 IS NULL THEN 0 ELSE 1 END
		+ CASE WHEN date5 LIKE '%ab' OR date5 IS NULL THEN 0 ELSE 1 END
		+ CASE WHEN date6 LIKE '%ab' OR date6 IS NULL THEN 0 ELSE 1 END
		+ CASE WHEN date7 LIKE '%ab' OR date7 IS NULL THEN 0 ELSE 1 END
		+ CASE WHEN date8 LIKE '%ab' OR date8 IS NULL THEN 0 ELSE 1 END
		+ CASE WHEN date9 LIKE '%ab' OR date9 IS NULL THEN 0 ELSE 1 END) AS TotalNotNullCount
        FROM attendence WHERE indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'  ";
        $resultR = $db->executeQuery($queryR);


		$queryQ="SELECT SUM(CASE WHEN date1 LIKE '%ab'   THEN 1 ELSE 0 END
        + CASE WHEN date2 LIKE '%ab'   THEN 1 ELSE 0 END
		+ CASE WHEN date3 LIKE '%ab'   THEN 1 ELSE 0 END
		+ CASE WHEN date4 LIKE '%ab'   THEN 1 ELSE 0 END
		+ CASE WHEN date5 LIKE '%ab'   THEN 1 ELSE 0 END
		+ CASE WHEN date6 LIKE '%ab'   THEN 1 ELSE 0 END
		+ CASE WHEN date7 LIKE '%ab'   THEN 1 ELSE 0 END
		+ CASE WHEN date8 LIKE '%ab'   THEN 1 ELSE 0 END
		+ CASE WHEN date9 LIKE '%ab'   THEN 1 ELSE 0 END) AS TotalabcentCount
        FROM attendence WHERE indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'  ";
        $resultQ = $db->executeQuery($queryQ);


		
		foreach($resultR as $row1)
		{
			$rowcount = $row1['TotalNotNullCount'];
			//$abcentdays = ($days - $rowcount) ;
			$percentage = ($rowcount/$days)*100 ;
			$queryS = "UPDATE attendence set percentage='$percentage',totaldates='$days',totalpresentdates='$rowcount'  WHERE   indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'  ";
			
			 //2021.03.24 start  $resultS = executeQuery($queryS);
			 $resultS = $db->executeQuery($queryS); 
			 
		}
		
		foreach($resultQ as $row2)
		{
			$rowcount1 = $row2['TotalabcentCount'];
			//$abcentdays = ($days - $rowcount) ;
			//$percentage = ($rowcount/$days)*100 ;
			$queryS = "UPDATE attendence set totalabcentdates = '$rowcount1'  WHERE   indexNo='$row[1]' AND subjectID='$row[0]' AND acYear ='$row[2]'  ";
			
			 //2021.03.24 start  $resultS = executeQuery($queryS);
			 $resultS = $db->executeQuery($queryS); 
			 
		}
		
			 
		 header("location:studentAttendence.php");
	 }}}
			   
		 
	
?>



  
  <h1>Student Attendence</h1>
  <form method="post" action="" class="plain">
  <table style="margin-left:8px" class="panel">
  	<tr>
    	<!-- <td><input name="btnNew" type="button" value="New" onclick="document.location.href = 'subjectNew.php';" class="button" /></td> -->
      
			
      
        <td>Subject</td>
        <td>
            <select name="subjectid" id="subjectid" onchange="this.form.submit();" >
            <?php
				//2021-03-23 start $result = executeQuery("SELECT DISTINCT faculty FROM subject");
				$result = $db->executeQuery("SELECT DISTINCT subjectID FROM stu_subject");
				//2021-03-23 end
				
				
				//2021-03-23 start if (mysql_num_rows($result)>0)
				if ($db->Row_Count($result)>0)	
				//2021-03-23 end
				{
					echo "<option value='0'>All</option>";
					//2021-03-23 start while ($row=mysql_fetch_array($result))
					while ($row=$db->Next_Record($result)) 
					//2021-03-23 end
					{
						if (isset($_POST['subjectid']) && $_POST['subjectid']==$row['subjectID'])
							echo "<option selected='selected' value='".$row['subjectID']."'>".$row['subjectID']."</option>";
						else if (isset($_SESSION['subjectID']) && $_SESSION['subjectID']==$row['subjectID'])
							echo "<option selected='selected' value='".$row['subjectID']."'>".$row['subjectID']." </option>";
						else echo "<option value='".$row['subjectID']."'>".$row['subjectID']."</option>";
					}
				}
			?>
            </select>
        </td>
        
        <td>Acadamic Year</td>
        <td>
        <select name="acyear" id="acyear" onchange="this.form.submit();">
            <?php
			$queryY = "SELECT DISTINCT acYear FROM attendence ORDER BY acYear DESC";
			//2021.03.24 start  $resultY = executeQuery($queryY);
			$resultY = $db->executeQuery($queryY);
			//2021.03.24 end
			//2021.03.24 start  while ($year=mysql_fetch_array($resultY))
            echo "<option value='0'>All</option>";
			while ($year=$db->Next_Record($resultY))
			//2021.03.24 end
					{
                       
						if (isset($_POST['acyear']) && $_POST['acyear']==$year['acYear'])
							echo "<option selected='selected' value='".$year['acYear']."'>".$year['acYear']."</option>";
						else if (isset($_SESSION['acYear']) && $_SESSION['acYear']==$year['acYear'])
							echo "<option selected='selected' value='".$year['acYear']."'>".$year['acYear']."</option>";
						else echo "<option value='".$year['acYear']."'>".$year['acYear']."</option>";
					}
			?>
          </select>
        </td>

	<!-- 	<td>Date</td>
		<td><input type="date" id="lecturedate" name="lecturedate"></td> -->
		
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
    	<th colspan="1" rowspan="3"></th><th rowspan="3">Code</th><th rowspan="3">Index No</th><th rowspan="3">Ac Year</th><th colspan = "2" >Attendence</th><th  rowspan="2" colspan="1">Total Dates</th><th rowspan="3">Percentage</th>
    </tr>

	<tr>
        <th  colspan = "2"><input type="date" id="lecturedate" name="lecturedate"></th>
		<th></th>
		
	    
		
    </tr>
	<tr>
        <th>Total Present Dates</th>
	    <th>Total Abcent Dates</th> 
		<th ><input name="abc" id="abc" type="number" size="1" value=""></th> 
	
		
    </tr>
    
<?php
  //2021-03-23 start while ($row = mysql_fetch_array($pageResult))
  while ($row = $db->Next_Record($pageResult))
  //2021-03-23 end  
  {

?>



	<tr>
	    <td><input name="chk[]" type="checkbox" value="<?php echo $row['subjectID'].";". $row['indexNo'] .";". $row['acYear']?>" ></td>
		<td><?php echo $row['subjectID'] ?></td>
		<td><?php echo $row['indexNo'] ?></td>
        <td><?php echo $row['acYear'] ?></td>
		
        <td><?php echo $row['totalpresentdates'] ?></td>
		<td><?php echo $row['totalabcentdates'] ?></td>
		
        
        <td><?php echo $row['totaldates'] ?></td>
        <td><?php echo $row['percentage'] ?></td>
        <!-- <td width="140"><input name="btnpercentage" type="submit" id="btnpercentage" value="Total attendence"  class="button"/>  -->
       
	</tr>
<?php
  }
?>
  </table>
  <table width="515" class="panel" style="margin-left:8px">
    <tr> 
      <td width="140"><input name="btnSelect" type="submit" id="btnSelect3" value="Present" class="button"/> 
      <td width="176"><input type="submit" name="btnDeselect" id="btnDeselect" value="Abcent" class="button" /></td>
	  <td width="140"><input name="btnpercentage" type="submit" id="btnpercentage" value="Total attendence"  class="button"/> 
      <td width="8">&nbsp; </td>
      <td width="171" align="lefy">&nbsp; </td>
    </tr>
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