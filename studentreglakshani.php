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
  //2021-03-23 start include('dbAccess.php');
  require_once("dbAccess.php");
  $db = new DBOperations();
  //2021-03-23 end
 /// include("authcheck.inc.php");
 
  $rowsPerPage = 10;
  $pageNum = 1;
  $_SESSION['entryYear']='2023';
  $entryYear='2023';
  if(isset($_GET['page'])) $pageNum = $_GET['page'];

 	$queryY = "SELECT MAX(entryYear) FROM applicant";
	//2021.03.24 start  $resultY = executeQuery($queryY);
	$resultY = $db->executeQuery($queryY);
	//2021.03.24 end
	//2021.03.24 start  $year=mysql_fetch_array($resultY);
	$year=$db->Next_Record($resultY);
	//2021.03.24 end
	//echo $year[0];
  	//$query = "SELECT appNo,titleE,nameEnglish,appType,qualified,confirmed FROM applicant WHERE entryYear = '$year[0]' AND `qualified` LIKE 'Yes' OR `qualified` LIKE 'Yes_SA'  ORDER BY appNo";
	$query = "SELECT final_interview_list.appNo,id,title,name,qualified,confirmed FROM final_interview_list JOIN applicant ON final_interview_list.appNo=applicant.appNo  ORDER BY id";

	 //Set filter according  to list box values
  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
  	$pageNum = 1;
	$entryYear = $_POST['lstentryYear'];		
	$_SESSION['entryYear'] = $entryYear;
	//$query = "SELECT appNo,titleE,nameEnglish,appType,qualified,confirmed FROM applicant WHERE entryYear = '$entryYear' AND `qualified` LIKE 'Yes' OR `qualified` LIKE 'Yes_SA' ORDER BY appNo";
	$query = "SELECT final_interview_list.appNo,id,title,name,qualified,confirmed FROM final_interview_list JOIN applicant ON final_interview_list.appNo=applicant.appNo  ORDER BY id";

}
  
  else if (isset($_SESSION['entryYear']))
  {
	$entryYear = $_SESSION['entryYear'];
	//$query = "SELECT appNo,titleE,nameEnglish,appType,qualified,confirmed FROM applicant WHERE entryYear = '$entryYear' AND `qualified` LIKE 'Yes' OR `qualified` LIKE 'Yes_SA' ORDER BY appNo";
	$query = "SELECT final_interview_list.appNo,id,title,name,qualified,confirmed FROM final_interview_list JOIN applicant ON final_interview_list.appNo=applicant.appNo  ORDER BY id";
  
}
	
  	// Deleting from DB
	if (isset($_GET['cmd']) && $_GET['cmd']=="delete")
	{
		//2021.03.24 start  $id = cleanInput($_GET['appNo']);
		$id = $db->cleanInput($_GET['appNo']);
		//2021.03.24 end
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
		//2021.03.24 start   $result = executeTransaction($quaries);
		$result = $db->executeTransaction($quaries);
		//2021.03.24 end
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
		//2021.03.24 start  $result = executeTransaction($quaries);
		$result = $db->executeTransaction($quaries);
		//2021.03.24 end
		
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
			$queryS = "UPDATE applicant set confirmed='$select' WHERE appNo='$row[0]'";
			//2021.03.24 start  $resultS = executeQuery($queryS);
			$resultS = $db->executeQuery($queryS);
			//2021.03.24 end
			
			
			$queryR="SELECT titleE,nameEnglish,addressEnglish1,addressEnglish2,addressEnglish3,district,entryYear,nameSinhala,addS1,addS2,addS3,nicNo,telno,entryType,email,dob,guardianEname,guardianEadd1,guardianEadd2,guardianEadd3 FROM applicant JOIN localapplicant ON localapplicant.appNo = applicant.appNo WHERE applicant.appNo='$row[0]'";
			//2021.03.24 start  $resultR = executeQuery($queryR);
			$resultR = $db->executeQuery($queryR);
			//2021.03.24 end
				//2021.03.24 start  while($data=mysql_fetch_array($resultR))
				while($data=$db->Next_Record($resultR))
				{

                $x = $row[1];
					
				  
				print $x;
				if ($x % 2 == 0){
				$y = $x - ($x/2);
				if($y < 10){
				$appNo= LS.'/'.$entryYear.'/00'.$y;
				}
				else{
					$appNo= LS.'/'.$entryYear.'/0'.$y;
				}
				$queryA ="INSERT INTO academic_enrolments set student_id = '$appNo',exam_year = '1', exam_sem = '1', degree_type = 'g' "; 
				$resultA = $db->executeQuery($queryA);
				$queryB ="INSERT INTO Student_Current set 	RegNo = '$appNo',acyear = '$entryYear', level = 'I',semester = 'First Semester',active = 'y' "; 
				$resultB = $db->executeQuery($queryB);

			    //$queryS = "UPDATE student set confirmed='$select' WHERE appNo='$row[0]'";

				$queryS="INSERT INTO student set appNo='$row[0]',regNO = '$appNo' ,indexNo = '$appNo' ,title='".$data['titleE']."', nameEnglish='".$data['nameEnglish']."',addressE1='".$data['addressEnglish1']."',addressE2='".$data['addressEnglish2']."',addressE3='".$data['addressEnglish3']."',district='".$data['district']."', yearEntry='".$data['entryYear']."', nameSinhala='".$data['nameSinhala']."',addressS1='".$data['addS1']."',addressS2='".$data['addS2']."',addressS3='".$data['addS3']."',id_pp_No='".$data['nicNo']."', contactNo = '".$data['telno']."', email = '".$data['email']."', birthday = '".$data['dob']."',guardName = '".$data['guardianEname']."', confirmed = '$select' , entryType='".$data['entryType']."' , faculty='Language Studies'";
				//2021.03.24 start  $resultS = executeQuery($queryS);
				$resultS = $db->executeQuery($queryS);
//2021.03.24 end

				$query1="INSERT INTO student_user set appNo = '$row[0]' , RegNo = '$appNo', username = '$appNo',password=  MD5('".$data['nicNo']."') ";
				
				$result1 = $db->executeQuery($query1);
				}
				else{
					$k = $x % 2;
					$a = ($x - $k) / 2;
					$z = $x - $a;
					print $z;
					if($z < 10){
					$appNo= BS.'/'.$entryYear.'/00'.$z;
					}
					else
					{
					$appNo= BS.'/'.$entryYear.'/0'.$z;
					}
				
					//$queryS = "UPDATE student set confirmed='$select' WHERE appNo='$row[0]'";

					$queryA ="INSERT INTO academic_enrolments set student_id = '$appNo',exam_year = '1', exam_sem = '1', degree_type = 'g' "; 
				    $resultA = $db->executeQuery($queryA);
					$queryB ="INSERT INTO Student_Current set 	RegNo = '$appNo',acyear = '$entryYear', level = 'I',semester = 'First Semester', active = 'y' "; 
					$resultB = $db->executeQuery($queryB);

					$queryS="INSERT INTO student set appNo='$row[0]',regNO = '$appNo' ,indexNo = '$appNo' ,title='l".$data['titleE']."', nameEnglish='".$data['nameEnglish']."',addressE1='".$data['addressEnglish1']."',addressE2='".$data['addressEnglish2']."',addressE3='".$data['addressEnglish3']."',district='".$data['district']."', yearEntry='".$data['entryYear']."', nameSinhala='".$data['nameSinhala']."',addressS1='".$data['addS1']."',addressS2='".$data['addS2']."',addressS3='".$data['addS3']."',id_pp_No='".$data['nicNo']."', contactNo = '".$data['telno']."', email = '".$data['email']."', birthday = '".$data['dob']."',guardName = '".$data['guardianEname']."', confirmed = '$select' ,entryType='".$data['entryType']."',faculty='Buddhist Studies'";
					//2021.03.24 start  $resultS = executeQuery($queryS);
					$resultS = $db->executeQuery($queryS);
	//2021.03.24 end
	
					$query1="INSERT INTO student_user set appNo = '$row[0]' , RegNo = '$appNo', username = '$appNo',password=  MD5('".$data['nicNo']."') ";
					
					$result1 = $db->executeQuery($query1);

				}
				
				/* $queryS="INSERT INTO student set appNo='$appNo',regNO = '$appNo' ,indexNo = '$appNo' ,title='".$data['titleE']."', nameEnglish='".$data['nameEnglish']."',addressE1='".$data['addressEnglish1']."',addressE2='".$data['addressEnglish2']."',addressE3='".$data['addressEnglish3']."',district='".$data['district']."', yearEntry='".$data['entryYear']."', nameSinhala='".$data['nameSinhala']."',addressS1='".$data['addS1']."',addressS2='".$data['addS2']."',addressS3='".$data['addS3']."',id_pp_No='".$data['nicNo']."', contactNo = '".$data['telno']."', entryType='".$data['entryType']."'";
				//2021.03.24 start  $resultS = executeQuery($queryS);
				$resultS = $db->executeQuery($queryS);
//2021.03.24 end

				$query1="INSERT INTO student_user set RegNo = '$row[0]', username = '$row[0]',password=  MD5('".$data['nicNo']."') ";
				
				$result1 = $db->executeQuery($query1); */
				
				}
				//header("location:studentAdmin.php");

			
			
			}
		} 

		header("location:studentAdmin.php");
		}
		//SAselect
		if (isset($_POST[''])) {
			$rowNum = $_POST['chk'];
		 $Count=count($rowNum);
		 //echo $Count;
			if ($Count>0){
				foreach ($rowNum as $a){
			 $row= explode(";",$a);
			 //print_r ($row);
			 $select="Yes";
			 $queryS = "UPDATE applicant set confirmed='$select' WHERE appNo='$row[0]'";
			 //2021.03.24 start  $resultS = executeQuery($queryS);
			 $resultS = $db->executeQuery($queryS);
			 //2021.03.24 end
			 
			 
			 $queryR="SELECT titleE,nameEnglish,addressEnglish1,addressEnglish2,addressEnglish3,district,entryYear,nameSinhala,addS1,addS2,addS3,nicNo,telno,entryType,email,dob,guardianEname,guardianEadd1,guardianEadd2,guardianEadd3 FROM applicant JOIN localapplicant ON localapplicant.appNo = applicant.appNo WHERE applicant.appNo='$row[0]'";
			 //2021.03.24 start  $resultR = executeQuery($queryR);
			 $resultR = $db->executeQuery($queryR);
			 //2021.03.24 end
				 //2021.03.24 start  while($data=mysql_fetch_array($resultR))
				 while($data=$db->Next_Record($resultR))
				 {
 
				 $x = $row[1];
					 
				   
				 
				
				
				 $appNo= LS.'/SA/'$entryYear.'/0';
				 
				 //$queryS = "UPDATE student set confirmed='$select' WHERE appNo='$row[0]'";
				 $queryB ="INSERT INTO Student_Current set 	RegNo = '$appNo',acyear = '$entryYear', level = 'I',semester = 'First Semester',active = 'y' "; 
				$resultB = $db->executeQuery($queryB);
 
				 $queryS="INSERT INTO student set appNo='$row[0]',regNO = '$appNo' ,indexNo = '$appNo' ,title='".$data['titleE']."', nameEnglish='".$data['nameEnglish']."',addressE1='".$data['addressEnglish1']."',addressE2='".$data['addressEnglish2']."',addressE3='".$data['addressEnglish3']."',district='".$data['district']."', yearEntry='".$data['entryYear']."', nameSinhala='".$data['nameSinhala']."',addressS1='".$data['addS1']."',addressS2='".$data['addS2']."',addressS3='".$data['addS3']."',id_pp_No='".$data['nicNo']."', contactNo = '".$data['telno']."', email = '".$data['email']."', birthday = '".$data['dob']."',guardName = '".$data['guardianEname']."', confirmed = '$select' , entryType='".$data['entryType']."' , faculty='Language Studies'";
				 //2021.03.24 start  $resultS = executeQuery($queryS);
				 $resultS = $db->executeQuery($queryS);
 //2021.03.24 end
 
				 $query1="INSERT INTO student_user set appNo = '$row[0]' , RegNo = '$appNo', username = '$appNo',password=  MD5('".$data['nicNo']."') ";
				 
				 $result1 = $db->executeQuery($query1);
				 
				 
				 /* $queryS="INSERT INTO student set appNo='$appNo',regNO = '$appNo' ,indexNo = '$appNo' ,title='".$data['titleE']."', nameEnglish='".$data['nameEnglish']."',addressE1='".$data['addressEnglish1']."',addressE2='".$data['addressEnglish2']."',addressE3='".$data['addressEnglish3']."',district='".$data['district']."', yearEntry='".$data['entryYear']."', nameSinhala='".$data['nameSinhala']."',addressS1='".$data['addS1']."',addressS2='".$data['addS2']."',addressS3='".$data['addS3']."',id_pp_No='".$data['nicNo']."', contactNo = '".$data['telno']."', entryType='".$data['entryType']."'";
				 //2021.03.24 start  $resultS = executeQuery($queryS);
				 $resultS = $db->executeQuery($queryS);
 //2021.03.24 end
 
				 $query1="INSERT INTO student_user set RegNo = '$row[0]', username = '$row[0]',password=  MD5('".$data['nicNo']."') ";
				 
				 $result1 = $db->executeQuery($query1); */
				 
				 }
				 //header("location:studentAdmin.php");
 
			 
			 
			 }
		 } 
 
		 header("location:studentAdmin.php");
		 }
		//reject
		if (isset($_POST[''])) 
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
					$queryS = "UPDATE applicant set confirmed='No' WHERE appNo='$row[0]'";
					//2021.03.24 start  $resultS = executeQuery($queryS);
					$resultS = $db->executeQuery($queryS);
					
					
					$query1 = "DELETE FROM student WHERE appNo='$row[0]'";
					
					$result1 = $db->executeQuery($query1);

					$query2 = "DELETE FROM student_user WHERE appNo='$row[0]'";
					
					$result2 = $db->executeQuery($query2);
					
					

					
					}
				}
				header("location:studentAdmin.php");
			} 

			//final interviw list

	if (isset($_POST[''])) {
		$rowNum = $_POST['chk'];
	 $Count=count($rowNum);
	 //echo $Count;
		if ($Count>0){
			foreach ($rowNum as $a){
		 $row= explode(";",$a);
		 //print_r ($row);
		
		 
		 
		 $queryR="SELECT appNo,titleE,nameEnglish FROM applicant  WHERE appNo='$row[0]'";
		 $resultR = $db->executeQuery($queryR);
		 
			 while($data=$db->Next_Record($resultR))
			 {

			
			 
			 //$queryS = "UPDATE student set confirmed='$select' WHERE appNo='$row[0]'";
			 $queryS="INSERT INTO final_interview_list set appNo='$row[0]',name='".$data['nameEnglish']."',title='".$data['titleE']."'";

			 //2021.03.24 start  $resultS = executeQuery($queryS);
			 $resultS = $db->executeQuery($queryS);

			 }
			
		 }
		
	}

	header("location:studentreg.php");

}

		
  if (isset($_POST['btnGoPage'])) {	
     //2021.03.24 start  $GoPage = cleanInput($_POST['txtPage']);
	 $GoPage = $db->cleanInput($_POST['txtPage']);
	 //2021.03.24 end
	 echo $GoPage;
	 ?>
	 <script language="JavaScript1.2">
       // if(oSelect.selectedIndex != 0)  
       ///tempvalue= oSelect.options[oSelect.selectedIndex].text;  	 
	   //self.location='premReceipt.php?policyno=' + tempvalue ;
	   //self.location='applicant.php?page=4'  //+applicant.txtPage.value		   
     </script>
	 <?php //header("location:AlSub.php");
	 $GoPage = $pageNum;
	 echo $GoPage; 
  }
		
		
	

// counting the offset
	$offset = ($pageNum - 1) * $rowsPerPage;
	//echo $query;
	//2021.03.24 start  $numRows = mysql_num_rows(executeQuery($query));
	$numRows = $db->Row_Count($db->executeQuery($query));
	//2021.03.24 end 
	$numPages = ceil($numRows/$rowsPerPage);
  
  	$pageQuery = $query." LIMIT $offset, $rowsPerPage";
	//2021.03.24 start  $result = executeQuery($pageQuery);	
	$result = $db->executeQuery($pageQuery);	
	//2021.03.24 end
?>
    <h1>Generating Student Registration Numbers</h1>
    <div id="tabs">
      <ul>
        <li><a href="studentConfirm.php"><span class="current">All Applicants</span></a></li>
        <li><a href="localApplicantsConfirm.php"><span>Local Applicants</span></a></li>
        <li><a href="foreignApplicantsConfirm.php"><span>Foreign Applicants</span></a></li>
      </ul>
    </div>
    <br/><br/><br/><br/><br/><br/>
    
<form method="post" action="studentConfirm.php" class="plain" form name="appicant">
  <table class="panel" style="margin-left:8px">
    <tr>
    	 <td><input name="btnNew" type="button" value="Back" onclick="document.location.href = 'studentConfirm.php';" class="button" />
    	<td><input name="btnSearch" type="button" value="Search" onclick="quickSearch();" class="button"/></td>
    	<td><input name="txtSearch" id="txtSearch" type="text" /> (Applicant No.)</td>
      	<td align="lefy"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Year of Entry</font>
          <select name="lstentryYear" id="lstentryYear" onchange="this.form.submit();">
            <?php
			$queryY = "SELECT DISTINCT entryYear FROM applicant ORDER BY entryYear DESC";
			//2021.03.24 start  $resultY = executeQuery($queryY);
			$resultY = $db->executeQuery($queryY);
			//2021.03.24 end
			//2021.03.24 start  while ($year=mysql_fetch_array($resultY))
			while ($year=$db->Next_Record($resultY))
			//2021.03.24 end
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
	<?php 
	//2021.03.24 start  if (mysql_num_rows($result)>0)
	if ($db->Row_Count($result)>0)
	//2021.03.24 end
	{ ?>
  <table class="searchResults">
	<tr>
	  <!-- <th>&nbsp;</th> -->
	  <th><input id="chk2[]" name="chk[]" type="checkbox" value="<?php echo $row['appNo'] ?>">
</th>
    	<th>Id</th>
   	    <th>Title</th>
   	  <th>Name</th>
   	  <th>App No</th>
   	  <th>Qualified</th>
		 <th>Confirmed</th>
   	  <th colspan="3"></th>
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
	$rowNum=0;
  //2021.03.24 start  while ($row = mysql_fetch_array($result))
  while ($row = $db->Next_Record($result))
  //2021.03.24 end
  { 
     
 ?>
	<tr>
	  <td><input id="chk1[]" name="chk[]" type="checkbox" value="<?php echo $row['appNo'].";". $row['id'] ?>"><br>
        <td><?php echo $row['id'] ?></td>
        <td><?php echo $row['title'] ?></td>
		<td><?php echo $row['name'] ?></td>
        <td><?php echo $row['appNo'] ?></td>
        <td><?php echo $row['qualified'] ?></td>
        <td><?php echo $row['confirmed'] ?></td>
        <td><input name="btnDetails" type="button" value="Details"  class="button" onclick="document.location.href ='applicantDetails.php?appNo=<?php echo $row['appNo'] ?> & appType=<?php echo $row['appType'] ?>'"/></td>
        <td><input name="btnEdit" type="button" value="Edit" onclick="document.location.href ='editApplicant.php?appNo=<?php echo $row['appNo'] ?> & appType=<?php echo $row['appType'] ?> '" class="button" /></td>
        <!-- <td><input name="btnDelete" type="button" value="Delete" onclick="if (MsgOkCancel()) document.location.href ='applicant.php?cmd=delete&appNo=<?php echo $row['appNo'] ?> & appType=<?php echo $row['appType'] ?> ';" class="button" /></td> -->
    </tr>
<?php
      
$rowNum+=1;
  }  
?>
</table>
 <table width="515" class="panel" style="margin-left:8px">
    <tr> 
	  <!-- <td width="140"><input name="btnSelect2" type="submit" id="btnSelect2" value="Generate Final Interview List" class="button"/>  -->

      <td width="140"><input name="btnSelect" type="submit" id="btnSelect3" value="Confirm" class="button"/> 
	  <td width="176"><input type="submit" name="btnSAselect" id="btnSAselect" value="Special Admission Confirm(SA)" class="button" />
      <!-- <td width="176"><input type="submit" name="btnDeselect" id="btnDeselect" value="Reject" class="button" /></td>  -->
	 
      <td width="8">&nbsp; </td>
      <td width="171" align="lefy">&nbsp; </td>
    </tr>
  </table>
  <p> 
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
  </p>
  <table width="391" align="left" class="panel" style="margin-left:8px">
    <tr> 
      <td width="99">Select Page
      <td width="10">&nbsp;</td>
      <td width="144"><input name="txtPage" type="text" id="txtPage" value="" /> </td>
      <td width="126" align="lefy"><input name="btnGoPage" type="submit" class="button" id="btnGoPage" value="Go to Page" /> 
      </td>
    </tr>
  </table>
  <p>
    <?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Student Confirmation - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='studentAdmin.php'>Students </a></li><li>Student Confirmation</li></ul>";
  //Apply the template
  include("master_registration.php");
?>
  </p>
</form>
<p>&nbsp;</p>