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
			document.location.href ='applicantDetails.php?appNo='+appNo;
	}
 </script>
 <?php
  //2021-03-24 start include('dbAccess.php');
	require_once("dbAccess.php");
	$db = new DBOperations();
    //2021-03-24 end
  //include("authcheck.inc.php");
  
  $rowsPerPage = 10;
  $pageNum = 1;
  if(isset($_GET['page'])) $pageNum = $_GET['page'];

 /* if (isset($_POST['txtSearch']) && strlen($_POST['txtSearch'])>0)
  {
  	$searchValue = $_POST['txtSearch'];
  	$query = "SELECT borrow.IRFID,borrow.URFID,accNo,title,borrowDate,dueDate FROM item JOIN borrow ON borrow.IRFID = item.IRFID WHERE returnStatus='Out' AND dueDate<CURDATE() AND MATCH (borrow.IRFID,borrow.URFID,accNo,title) AGAINST ('$searchValue' IN BOOLEAN MODE) ORDER BY borrowDate";
  }
  else*/
  	$queryY = "SELECT MAX(alYear) FROM localapplicant";
	//2021.03.24 start  $resultY = executeQuery($queryY);
	$resultY = $db->executeQuery($queryY);
	//2021.03.24 end
	//2021.03.24 start  $year=mysql_fetch_array($resultY);
	$year=$db->Next_Record($resultY);
	//2021.03.24 end
  	$query = "SELECT 	
	  nameSinhala,
	  addS1,
	  addS2,
	  addS3,
	  district FROM localapplicant JOIN applicant ON localapplicant.appNo = applicant.appNo JOIN applicantsubjects ON localapplicant.appNo = applicantsubjects.appNo  WHERE  alYear = '$year[0]' AND subjectCode = '12' AND titleE = 'Ven.' ORDER BY Zscore DESC";
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
  	$pageNum = 1;
	$entryYear = $_POST['lstentryYear'];		
	$_SESSION['alYear'] = $entryYear;

	//$query = "SELECT applicant.appNo,titleE,nameEnglish,appType,qualified,entryType,confirmed FROM applicant JOIN localapplicant ON localapplicant.appNo = applicant.appNo WHERE appType='Local' AND entryYear = '$entryYear' AND `qualified` LIKE 'Yes' OR `qualified` LIKE 'Yes_SA' ORDER BY appNo";
    $query = "SELECT 	
	nameSinhala,
	addS1,
	addS2,
	addS3,
	district FROM localapplicant JOIN applicant ON localapplicant.appNo = applicant.appNo JOIN applicantsubjects ON localapplicant.appNo = applicantsubjects.appNo  WHERE  alYear = '$entryYear' AND subjectCode = '12' AND titleE = 'Ven.' ORDER BY Zscore DESC";  
}
  
  else if (isset($_SESSION['alYear']))
  {
	$entryYear = $_SESSION['alYear'];
	//$query = "SELECT applicant.appNo,titleE,nameEnglish,appType,qualified,entryType,confirmed FROM applicant JOIN localapplicant ON localapplicant.appNo = applicant.appNo WHERE appType='Local' AND entryYear = '$entryYear' AND `qualified` LIKE 'Yes' OR `qualified` LIKE 'Yes_SA' ORDER BY appNo";
	$query = "SELECT 	
	nameSinhala,
	addS1,
	addS2,
	addS3,
	district FROM localapplicant JOIN applicant ON localapplicant.appNo = applicant.appNo JOIN applicantsubjects ON localapplicant.appNo = applicantsubjects.appNo  WHERE  alYear = '$entryYear' AND subjectCode = '12' AND titleE = 'Ven.' ORDER BY Zscore DESC";  
}
  
 	// Deleting from DB
	if (isset($_GET['cmd']) && $_GET['cmd']=="delete")
	{
		$id = $_GET['appNo'];
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
		//2021.03.24 start  $result = executeTransaction($quaries);
		$result = $db->executeTransaction($quaries);
		//2021.03.24 end
		}
		/*elseif($type=='Foreign')
		{
		$delQuery1 = "DELETE FROM foreignsubjects WHERE appNo='$id'";
		//$result1 = executeQuery($delQuery1);
		$delQuery2 = "DELETE FROM foreignapplicant WHERE appNo='$id'";
		//$result2 = executeQuery($delQuery2);
		$delQuery3 = "DELETE FROM applicant WHERE appNo='$id'";
		//$result3 = executeQuery($delQuery3);
		$quaries = array($delQuery1,$delQuery2,$delQuery3);
		$result = executeTransaction($quaries);
		}*/
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
			
            if($row[1]=="Local")
			{
			$queryR="SELECT titleE,nameEnglish,addressEnglish1,addressEnglish2,addressEnglish3,district,entryYear,nameSinhala,addS1,addS2,addS3,nicNo,telno,entryType,email,dob,guardianEname,guardianEadd1,guardianEadd2,guardianEadd3 FROM applicant JOIN localapplicant ON localapplicant.appNo = applicant.appNo WHERE applicant.appNo='$row[0]'";
			//2021.03.24 start  $resultR = executeQuery($queryR);
			$resultR = $db->executeQuery($queryR);
			//2021.03.24 end
				//2021.03.24 start  while($data=mysql_fetch_array($resultR))
				while($data=$db->Next_Record($resultR))
				{

                $x = $row[0];
				//print $x;
				if ($x % 2 == 0){
				$appNo= LS.'/'.$row[0];
			    $queryS = "UPDATE student set confirmed='$select' WHERE appNo='$row[0]'";

				//$queryS="INSERT INTO student set appNo='$appNo',regNO = '$appNo' ,indexNo = '$appNo' ,title='".$data['titleE']."', nameEnglish='".$data['nameEnglish']."',addressE1='".$data['addressEnglish1']."',addressE2='".$data['addressEnglish2']."',addressE3='".$data['addressEnglish3']."',district='".$data['district']."', yearEntry='".$data['entryYear']."', nameSinhala='".$data['nameSinhala']."',addressS1='".$data['addS1']."',addressS2='".$data['addS2']."',addressS3='".$data['addS3']."',id_pp_No='".$data['nicNo']."', contactNo = '".$data['telno']."', email = '".$data['email']."', birthday = '".$data['dob']."',guardName = '".$data['guardianEname']."', confirmed = '$select' , entryType='".$data['entryType']."'";
				//2021.03.24 start  $resultS = executeQuery($queryS);
				$resultS = $db->executeQuery($queryS);
//2021.03.24 end

				$query1="INSERT INTO student_user set appNo = '$row[0]' , RegNo = '$appNo', username = '$appNo',password=  MD5('".$data['nicNo']."') ";
				
				$result1 = $db->executeQuery($query1);
				}
				else{
					$appNo= BS.'/'.$row[0];

					$queryS = "UPDATE student set confirmed='$select' WHERE appNo='$row[0]'";

					//$queryS="INSERT INTO student set appNo='$appNo',regNO = '$appNo' ,indexNo = '$appNo' ,title='l".$data['titleE']."', nameEnglish='".$data['nameEnglish']."',addressE1='".$data['addressEnglish1']."',addressE2='".$data['addressEnglish2']."',addressE3='".$data['addressEnglish3']."',district='".$data['district']."', yearEntry='".$data['entryYear']."', nameSinhala='".$data['nameSinhala']."',addressS1='".$data['addS1']."',addressS2='".$data['addS2']."',addressS3='".$data['addS3']."',id_pp_No='".$data['nicNo']."', contactNo = '".$data['telno']."', email = '".$data['email']."', birthday = '".$data['dob']."',guardName = '".$data['guardianEname']."', confirmed = '$select' ,entryType='".$data['entryType']."'";
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
			}
			elseif($row[1]=="Foreign")
			{
			$queryR="SELECT titleE,nameEnglish,addressEnglish1,addressEnglish2,addressEnglish3,entryYear, ppNo,country FROM applicant JOIN foreignapplicant ON foreignapplicant.appNo = applicant.appNo WHERE applicant.appNo='$row[0]'";
			//2021.03.24 start  $resultR = executeQuery($queryR);
			$resultR = $db->executeQuery($queryR);
			//2021.03.24 end
				//2021.03.24 start  while($data=mysql_fetch_array($resultR))
				while($data=$db->Next_Record($resultR))
				//2021.03.24 end
				{
				$x = $row[0];
				//print $x;
				if ($x % 2 == 0){
			    $appNo= LS.'/'.$row[0];
				$queryS = "UPDATE student set confirmed='$select' WHERE appNo='$row[0]'";

				//$appNo= LS.'/'.$row[0]; 
				//$appNo=$data['entryYear'].'/'.$row[0];
				//$queryS="INSERT INTO student set appNo='$appNo',regNO = '$appNo' ,indexNo = '$appNo' ,title='".$data['titleE']."', nameEnglish='".$data['nameEnglish']."',addressE1='".$data['addressEnglish1']."',addressE2='".$data['addressEnglish2']."',addressE3='".$data['addressEnglish3']."',yearEntry='".$data['entryYear']."',id_pp_No='".$data['ppNo']."',entryType='Foreign'";
				//2021.03.24 start  $resultS = executeQuery($queryS);
				$resultS = $db->executeQuery($queryS);
				$query1="INSERT INTO student_user set appNo = '$row[0]' , RegNo = '$appNo', username = '$appNo',password=  MD5('".$data['ppNo']."') ";
					
					$result1 = $db->executeQuery($query1);
				//2021.03.24 end
				}
				else{
					$appNo= BS.'/'.$row[0];
					$queryS = "UPDATE student set confirmed='$select' WHERE appNo='$row[0]'";
					$resultS = $db->executeQuery($queryS);
					$query1="INSERT INTO student_user set appNo = '$row[0]' , RegNo = '$appNo', username = '$appNo',password=  MD5('".$data['ppNo']."') ";
					
					$result1 = $db->executeQuery($query1);
				}
				}
			}
			}
		} 

		header("location:studentAdmin.php");
		}
		if (isset($_POST['btnSAselect'])) {
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
			 
			 if($row[1]=="Local")
			 {
			 $queryR="SELECT titleE,nameEnglish,addressEnglish1,addressEnglish2,addressEnglish3,district,entryYear,nameSinhala,addS1,addS2,addS3,nicNo,telno,entryType,email,dob,guardianEname,guardianEadd1,guardianEadd2,guardianEadd3 FROM applicant JOIN localapplicant ON localapplicant.appNo = applicant.appNo WHERE applicant.appNo='$row[0]'";
			 //2021.03.24 start  $resultR = executeQuery($queryR);
			 $resultR = $db->executeQuery($queryR);
			 //2021.03.24 end
				 //2021.03.24 start  while($data=mysql_fetch_array($resultR))
				 while($data=$db->Next_Record($resultR))
				 {
 
				 $x = $row[0];
				 print $x;
				 if ($x % 2 == 0){
				 $appNo= LS.'/'.SA.'/'.$row[0];
				 $queryS = "UPDATE student set confirmed='$select' WHERE appNo='$row[0]'";
 
				 //$queryS="INSERT INTO student set appNo='$appNo',regNO = '$appNo' ,indexNo = '$appNo' ,title='".$data['titleE']."', nameEnglish='".$data['nameEnglish']."',addressE1='".$data['addressEnglish1']."',addressE2='".$data['addressEnglish2']."',addressE3='".$data['addressEnglish3']."',district='".$data['district']."', yearEntry='".$data['entryYear']."', nameSinhala='".$data['nameSinhala']."',addressS1='".$data['addS1']."',addressS2='".$data['addS2']."',addressS3='".$data['addS3']."',id_pp_No='".$data['nicNo']."', contactNo = '".$data['telno']."', email = '".$data['email']."', birthday = '".$data['dob']."',guardName = '".$data['guardianEname']."', confirmed = '$select' , entryType='".$data['entryType']."'";
				 //2021.03.24 start  $resultS = executeQuery($queryS);
				 $resultS = $db->executeQuery($queryS);
 //2021.03.24 end
 
				 $query1="INSERT INTO student_user set appNo = '$row[0]' , RegNo = '$appNo', username = '$appNo',password=  MD5('".$data['nicNo']."') ";
				 
				 $result1 = $db->executeQuery($query1);
				 }
				 else{
					 $appNo= BS.'/'.SA.'/'.$row[0];
 
					 $queryS = "UPDATE student set confirmed='$select' WHERE appNo='$row[0]'";
 
					 //$queryS="INSERT INTO student set appNo='$appNo',regNO = '$appNo' ,indexNo = '$appNo' ,title='l".$data['titleE']."', nameEnglish='".$data['nameEnglish']."',addressE1='".$data['addressEnglish1']."',addressE2='".$data['addressEnglish2']."',addressE3='".$data['addressEnglish3']."',district='".$data['district']."', yearEntry='".$data['entryYear']."', nameSinhala='".$data['nameSinhala']."',addressS1='".$data['addS1']."',addressS2='".$data['addS2']."',addressS3='".$data['addS3']."',id_pp_No='".$data['nicNo']."', contactNo = '".$data['telno']."', email = '".$data['email']."', birthday = '".$data['dob']."',guardName = '".$data['guardianEname']."', confirmed = '$select' ,entryType='".$data['entryType']."'";
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
			 elseif($row[1]=="Foreign")
			 {
			 $queryR="SELECT titleE,nameEnglish,addressEnglish1,addressEnglish2,addressEnglish3,entryYear, ppNo,country FROM applicant JOIN foreignapplicant ON foreignapplicant.appNo = applicant.appNo WHERE applicant.appNo='$row[0]'";
			 //2021.03.24 start  $resultR = executeQuery($queryR);
			 $resultR = $db->executeQuery($queryR);
			 //2021.03.24 end
				 //2021.03.24 start  while($data=mysql_fetch_array($resultR))
				 while($data=$db->Next_Record($resultR))
				 //2021.03.24 end
				 {
				 $x = $row[0];
				 print $x;
				 if ($x % 2 == 0){
				 $appNo= LS.'/'.SA.'/'.$row[0];
				 $queryS = "UPDATE student set confirmed='$select' WHERE appNo='$row[0]'";
 
				 //$appNo= LS.'/'.$row[0]; 
				 //$appNo=$data['entryYear'].'/'.$row[0];
				 //$queryS="INSERT INTO student set appNo='$appNo',regNO = '$appNo' ,indexNo = '$appNo' ,title='".$data['titleE']."', nameEnglish='".$data['nameEnglish']."',addressE1='".$data['addressEnglish1']."',addressE2='".$data['addressEnglish2']."',addressE3='".$data['addressEnglish3']."',yearEntry='".$data['entryYear']."',id_pp_No='".$data['ppNo']."',entryType='Foreign'";
				 //2021.03.24 start  $resultS = executeQuery($queryS);
				 $resultS = $db->executeQuery($queryS);
				 $query1="INSERT INTO student_user set appNo = '$row[0]' , RegNo = '$appNo', username = '$appNo',password=  MD5('".$data['ppNo']."') ";
					 
					 $result1 = $db->executeQuery($query1);
				 //2021.03.24 end
				 }
				 else{
					 $appNo= BS.'/'.SA.'/'.$row[0];
					 $queryS = "UPDATE student set confirmed='$select' WHERE appNo='$row[0]'";
					 $resultS = $db->executeQuery($queryS);
					 $query1="INSERT INTO student_user set appNo = '$row[0]' , RegNo = '$appNo', username = '$appNo',password=  MD5('".$data['ppNo']."') ";
					 
					 $result1 = $db->executeQuery($query1);
				 }
				 }
			 }
			 }
		 } 
 
		 header("location:studentAdmin.php");
		 }
		
		//De- select applicant
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

					$x = $row[0];
					//print $x;
					if ($x % 2 == 0){
					$appNo= LS.'/'.$row[0];
					//print_r ($row);
					$queryS = "UPDATE applicant set confirmed='No' WHERE appNo='$row[0]'";
					//2021.03.24 start  $resultS = executeQuery($queryS);
					$resultS = $db->executeQuery($queryS);
					//2021.03.24 end
					$queryS = "SELECT entryYear FROM applicant WHERE appNo='$row[0]'";
					//2021.03.24 start  $resultS = executeQuery($queryS);
					$resultS = $db->executeQuery($queryS);
					//2021.03.24 end
					//2021.03.24 start  $data=mysql_fetch_array($resultS);
					$data=$db->Next_Record($resultS);
					//2021.03.24 end
					
					//$appNo=$data['entryYear'].'/'.$row[0];
					$queryD = "UPDATE student set confirmed='No' WHERE appNo='$row[0]'";
					//2021.03.24 start  $resultD = executeQuery($queryD);
					$resultD = $db->executeQuery($queryD);
					$query1 = "DELETE FROM student_user WHERE appNo='$row[0]'";
					
					$result1 = $db->executeQuery($query1);
					}
					else{
						$appNo= BS.'/'.$row[0];
						$row= explode(";",$a);
					//print_r ($row);
					$queryS = "UPDATE applicant set confirmed='No' WHERE appNo='$row[0]'";
					//2021.03.24 start  $resultS = executeQuery($queryS);
					$resultS = $db->executeQuery($queryS);
					//2021.03.24 end
					$queryS = "SELECT entryYear FROM applicant WHERE appNo='$row[0]'";
					//2021.03.24 start  $resultS = executeQuery($queryS);
					$resultS = $db->executeQuery($queryS);
					//2021.03.24 end
					//2021.03.24 start  $data=mysql_fetch_array($resultS);
					$data=$db->Next_Record($resultS);
					//2021.03.24 end
					
					//$appNo=$data['entryYear'].'/'.$row[0];
					$queryD = "UPDATE student set confirmed='No' WHERE appNo='$row[0]'";
					//2021.03.24 start  $resultD = executeQuery($queryD);
					$resultD = $db->executeQuery($queryD);
					$query1 = "DELETE FROM student_user WHERE appNo='$row[0]'";
					
					$result1 = $db->executeQuery($query1);

					}

					
					}
				}
				header("location:studentAdmin.php");
			} 
		
	 // counting the offset
	$offset = ($pageNum - 1) * $rowsPerPage;
	//2021.03.24 start  $numRows = mysql_num_rows(executeQuery($query));
	$numRows = $db->Row_Count($db->executeQuery($query));
	//2021.03.24 end 
	$numPages = ceil($numRows/$rowsPerPage);
  
  	$pageQuery = $query." LIMIT $offset, $rowsPerPage";
	//2021.03.24 start  $result = executeQuery($pageQuery);
	$result = $db->executeQuery($pageQuery);
	//2021.03.24 end 
?>
  <h1>Selected Local Applicants for The Interview</h1>
  <div id="tabs">
  <ul>
    <li><a href="studentConfirm.php"><span>All Applicantss</span></a></li>
    <li><a href="localApplicantsConfirm.php"><span class="current">Local Applicants</span></a></li>
    <li><a href="foreignApplicantsConfirm.php"><span>Foreign Applicants</span></a></li>
  </ul>
</div>
<br/><br/><br/><br/><br/><br/>
 
 <form method="post" action="localApplicantsConfirm.php" class="plain">
  <table class="panel" style="margin-left:8px">
  <tr>
  	<td> <input type="button" name="btnNew" id="btnNew" value="New" onclick="document.location.href = 'newLocal.php';" class="button" /> </td>
    <td><input name="btnSearch" type="button" value="Search" onclick="quickSearch();" class="button"/></td>
    <td><input name="txtSearch" id="txtSearch" type="text" /> (Applicant No.)</td>
    <td align="right"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Year of Entry</font>
        <select name="lstentryYear" id="lstentryYear" onchange="this.form.submit();">
          <?php
			$queryY = "SELECT DISTINCT alYear FROM localapplicant ORDER BY alYear DESC";
			//2021.03.24 start  $resultY = executeQuery($queryY);
			$resultY = $db->executeQuery($queryY);
			//2021.03.24 end
			//2021.03.24 start  while ($year=mysql_fetch_array($resultY))
			while ($year=$db->Next_Record($resultY))
			//2021.03.24 end
					{
						if (isset($_POST['alYear']) && $_POST['alYear']==$year['alYear'])
							echo "<option selected='selected' value='".$year['alYear']."'>".$year['alYear']."</option>";
						else if (isset($_SESSION['alYear']) && $_SESSION['alYear']==$year['alYear'])
							echo "<option selected='selected' value='".$year['alYear']."'>".$year['alYear']."</option>";
						else echo "<option value='".$year['alYear']."'>".$year['alYear']."</option>";
					}
			?>
        </select>
   </td>
  </tr></table>

<br/>
 <?php 
 //2021.03.24 start  if (mysql_num_rows($result)>0)
 if ($db->Row_Count($result)>0)
 //2021.03.24 end
 { ?>
  <table width="480" class="searchResults">
<tr>
	<th>&nbsp;</th>
    <th>Application No.</th>
    <th>Title</th>
   	<th>Name</th>
   	<th>Entry type</th>
   	<th>Qualified</th>
	   <th>Confirmed</th>

    <th colspan="3">&nbsp;</th>
    </tr>
    
<?php
  //2021.03.24 start  while ($row = mysql_fetch_array($result))
  while ($row = $db->Next_Record($result))
  //2021.03.24 end
  {
?>
	<tr>
   		<td><input name="chk[]" type="checkbox" value="<?php echo $row['appNo'].";". $row['appType'] ?>"><br>
        <td><?php echo $row[''] ?></td>
        <td><?php echo $row['nameSinhala'] ?></td>
		<td><?php echo $row['']?></td>
        <td><?php echo $row['']?></td>
        <td><?php echo $row[''] ?></td>
		<td><?php echo $row[''] ?></td>

        <td ><input name="btnDetails" type="button" value="Details"  class="button" onclick="document.location.href ='applicantDetails.php?appNo=<?php echo $row['appNo'] ?>'"/></td>
      <td><input name="btnEdit" type="button" value="Edit" onclick="document.location.href ='editapplicant.php?appNo=<?php echo $row['appNo'] ?> &amp; appType=<?php echo $row['appType'] ?> '" class="button" /></td>
      <td><input name="btnDelete" type="button" value="Delete" onclick="if (MsgOkCancel()) document.location.href ='localApplicants.php?cmd=delete&amp;appNo=<?php echo $row['appNo'] ?> &amp; appType=<?php echo $row['appType'] ?> ';" class="button" /></td>
    </tr>
<?php
  }  
?>
  </table>
   <input name="btnSelect" type="submit" id="btnSelect" value="Confirm" class="button"> 
   <td width="176"><input type="submit" name="btnSAselect" id="btnSAselect" value="Special Admission Confirm(SA)" class="button" /></td>
   <input type="submit" name="btnDeselect" id="btnDeSelect" value="Reject" class="button" />
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
}else echo "<p>No Entries</p>";

?>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
 $pagetitle = "Local Applicants - Applicants - Student Management System - Buddhist & Pali University of Sri Lanka";
 $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='applicant.php'>Applicants </a></li><li>Local Applicants</li></ul>";
  //Apply the template
  include("master_registration.php");
?>