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
  if(isset($_GET['page'])) $pageNum = $_GET['page'];

 	$queryY = "SELECT MAX(entryYear) FROM applicant";
	//2021.03.24 start  $resultY = executeQuery($queryY);
	$resultY = $db->executeQuery($queryY);
	//2021.03.24 end
	//2021.03.24 start  $year=mysql_fetch_array($resultY);
	$year=$db->Next_Record($resultY);
	$csem = $db->cleanInput($_POST['csem']);
	$nsem = $db->cleanInput($_POST['nsem']);
	//2021.03.24 end
	//echo $year[0];
  //	$query = "SELECT appNo,titleE,nameEnglish,appType,qualified,confirmed FROM applicant WHERE entryYear = '$year[0]' AND `qualified` LIKE 'Yes' AND current_sem ='11' ORDER BY appNo";
		//$query = "SELECT appNo,titleE,nameEnglish,appType,qualified,confirmed FROM applicant WHERE entryYear = '$year[0]' AND `qualified` LIKE 'Yes' ORDER BY appNo";
		 //$query = "SELECT * FROM student JOIN applicant ON applicant.appNo=student.appNo WHERE applicant.appType = 'Local' AND  current_sem = '11'" ; 
		$query =  "SELECT * FROM student where current_sem = '11'";
		//print  $query;
	 //Set filter according  to list box values
  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
  	$pageNum = 1;
	$entryYear = $_POST['lstentryYear'];		
	$_SESSION['entryYear'] = $entryYear;
	//$query = "SELECT appNo,titleE,nameEnglish,appType,qualified,confirmed FROM applicant WHERE entryYear = '$entryYear' AND current_sem = '$csem' AND `qualified` LIKE 'Yes' ORDER BY appNo";
  //	$query = "SELECT appNo,titleE,nameEnglish,appType,qualified,confirmed FROM applicant WHERE entryYear = '$year[0]' AND `qualified` LIKE 'Yes' ORDER BY appNo";
  // $query = "SELECT * FROM student JOIN applicant ON applicant.appNo=student.appNo WHERE applicant.appType = 'Local' AND  current_sem = '11'" ; 
   $query =  "SELECT * FROM student where current_sem = '11'";
  }
  
  else if (isset($_SESSION['entryYear']))
  {
	$entryYear = $_SESSION['entryYear'];
		//$query = "SELECT appNo,titleE,nameEnglish,appType,qualified,confirmed FROM applicant WHERE entryYear = '$year[0]' AND `qualified` LIKE 'Yes' ORDER BY appNo";
	//$query = "SELECT appNo,titleE,nameEnglish,appType,qualified,confirmed FROM applicant WHERE entryYear = '$entryYear' AND current_sem = '$csem'AND `qualified` LIKE 'Yes' ORDER BY appNo";
   //$query = "SELECT * FROM student JOIN applicant ON applicant.appNo=student.appNo WHERE applicant.appType = 'Local' AND  current_sem = '11'" ; 
   $query =  "SELECT * FROM student where current_sem = '11'";
   print  $query;
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
			$queryS = "UPDATE student set current_sem='12' WHERE appNo='$row[0]'";
			//2021.03.24 start  $resultS = executeQuery($queryS);
			$resultS = $db->executeQuery($queryS);
			//2021.03.24 end
			
			if($row[1]=="Local")
			{
			//$queryR="SELECT titleE,nameEnglish,addressEnglish1,addressEnglish2,addressEnglish3,district,entryYear,nameSinhala,addS1,addS2,addS3,nicNo,telno,entryType,email,dob,guardianEname,guardianEadd1,guardianEadd2,guardianEadd3 FROM applicant JOIN localapplicant ON localapplicant.appNo = applicant.appNo WHERE applicant.appNo='$row[0]'";
			 $queryR = "SELECT * FROM student JOIN applicant ON applicant.appNo=student.appNo WHERE applicant.appType = 'Local' AND  student.current_sem = '11'" ; 
			//2021.03.24 start  $resultR = executeQuery($queryR);
			print $queryR;
			$resultR = $db->executeQuery($queryR);
			//2021.03.24 end
				//2021.03.24 start  while($data=mysql_fetch_array($resultR))
				while($data=$db->Next_Record($resultR))
				{

                $x = $row[0];
				print $x;
				if ($x % 2 == 0){
				$appNo= LS.'/'.$row[0];
			    $queryS = "UPDATE student set current_sem='12' WHERE appNo='$row[0]'";

				//$queryS="INSERT INTO student set appNo='$appNo',regNO = '$appNo' ,indexNo = '$appNo' ,title='".$data['titleE']."', nameEnglish='".$data['nameEnglish']."',addressE1='".$data['addressEnglish1']."',addressE2='".$data['addressEnglish2']."',addressE3='".$data['addressEnglish3']."',district='".$data['district']."', yearEntry='".$data['entryYear']."', nameSinhala='".$data['nameSinhala']."',addressS1='".$data['addS1']."',addressS2='".$data['addS2']."',addressS3='".$data['addS3']."',id_pp_No='".$data['nicNo']."', contactNo = '".$data['telno']."', email = '".$data['email']."', birthday = '".$data['dob']."',guardName = '".$data['guardianEname']."', confirmed = '$select' , entryType='".$data['entryType']."'";
				//2021.03.24 start  $resultS = executeQuery($queryS);
				$resultS = $db->executeQuery($queryS);
//2021.03.24 end

				$query1="INSERT INTO student_user set appNo = '$row[0]' , RegNo = '$appNo', username = '$appNo',password=  MD5('".$data['nicNo']."') ";
				
				$result1 = $db->executeQuery($query1);
				}
				else{
					$appNo= BS.'/'.$row[0];

					$queryS = "UPDATE student set current_sem='12' WHERE appNo='$row[0]'";

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
			//$queryR="SELECT titleE,nameEnglish,addressEnglish1,addressEnglish2,addressEnglish3,entryYear, ppNo,country FROM applicant JOIN foreignapplicant ON foreignapplicant.appNo = applicant.appNo WHERE applicant.appNo='$row[0]'";
			//2021.03.24 start  $resultR = executeQuery($queryR);
			 $queryR = "SELECT * FROM student JOIN applicant ON applicant.appNo=student.appNo WHERE applicant.appType = 'Foreign'  and current_sem = '11'" ; 
			$resultR = $db->executeQuery($queryR);
			//2021.03.24 end
				//2021.03.24 start  while($data=mysql_fetch_array($resultR))
				while($data=$db->Next_Record($resultR))
				//2021.03.24 end
				{
				$x = $row[0];
				print $x;
				if ($x % 2 == 0){
			    $appNo= LS.'/'.$row[0];
				$queryS = "UPDATE student set current_sem='12' WHERE appNo='$row[0]'";

				//$appNo= LS.'/'.$row[0]; 
				//$appNo=$data['entryYear'].'/'.$row[0];
				//$queryS="INSERT INTO student set appNo='$appNo',regNO = '$appNo' ,indexNo = '$appNo' ,title='".$data['titleE']."', nameEnglish='".$data['nameEnglish']."',addressE1='".$data['addressEnglish1']."',addressE2='".$data['addressEnglish2']."',addressE3='".$data['addressEnglish3']."',yearEntry='".$data['entryYear']."',id_pp_No='".$data['ppNo']."',entryType='Foreign'";
				//2021.03.24 start  $resultS = executeQuery($queryS);
				$resultS = $db->executeQuery($queryS);
				$query1="INSERT INTO student_user set  appNo = '$row[0]' , RegNo = '$appNo', username = '$appNo',password=  MD5('".$data['ppNo']."') ";
					
					$result1 = $db->executeQuery($query1);
				//2021.03.24 end
				}
				else{
					$appNo= BS.'/'.$row[0];
					$queryS = "UPDATE student set current_sem='12' WHERE appNo='$row[0]'";
					$resultS = $db->executeQuery($queryS);
					$query1="INSERT INTO student_user set  appNo = '$row[0]' , RegNo = '$appNo', username = '$appNo',password=  MD5('".$data['ppNo']."') ";
					
					$result1 = $db->executeQuery($query1);
				}
				}
			}
			}
		} 

		//header("location:studentAdmin.php");
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
			 $queryS = "UPDATE student set current_sem='12' WHERE appNo='$row[0]'";
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
				 $queryS = "UPDATE student set current_sem='12' WHERE appNo='$row[0]'";
 
				 //$queryS="INSERT INTO student set appNo='$appNo',regNO = '$appNo' ,indexNo = '$appNo' ,title='".$data['titleE']."', nameEnglish='".$data['nameEnglish']."',addressE1='".$data['addressEnglish1']."',addressE2='".$data['addressEnglish2']."',addressE3='".$data['addressEnglish3']."',district='".$data['district']."', yearEntry='".$data['entryYear']."', nameSinhala='".$data['nameSinhala']."',addressS1='".$data['addS1']."',addressS2='".$data['addS2']."',addressS3='".$data['addS3']."',id_pp_No='".$data['nicNo']."', contactNo = '".$data['telno']."', email = '".$data['email']."', birthday = '".$data['dob']."',guardName = '".$data['guardianEname']."', confirmed = '$select' , entryType='".$data['entryType']."'";
				 //2021.03.24 start  $resultS = executeQuery($queryS);
				 $resultS = $db->executeQuery($queryS);
 //2021.03.24 end
 
				 $query1="INSERT INTO student_user set appNo = '$row[0]' , RegNo = '$appNo', username = '$appNo',password=  MD5('".$data['nicNo']."') ";
				 
				 $result1 = $db->executeQuery($query1);
				 }
				 else{
					 $appNo= BS.'/'.SA.'/'.$row[0];
 
					 $queryS = "UPDATE student set current_sem='12' WHERE appNo='$row[0]'";
 
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
				 $queryS = "UPDATE student set current_sem='12' WHERE appNo='$row[0]'";
 
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
					 $queryS = "UPDATE student set current_sem='12' WHERE appNo='$row[0]'";
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
					print $x;
					if ($x % 2 == 0){
					$appNo= LS.'/'.$row[0];
					//print_r ($row);
					$queryS = "UPDATE applicant set current_sem='12' WHERE appNo='$row[0]'";
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
					$queryD = "UPDATE student set current_sem='12' WHERE appNo='$row[0]'";
					//2021.03.24 start  $resultD = executeQuery($queryD);
					$resultD = $db->executeQuery($queryD);
					$query1 = "DELETE FROM student_user WHERE appNo='$row[0]'";
					
					$result1 = $db->executeQuery($query1);
					}
					else{
						$appNo= BS.'/'.$row[0];
						$row= explode(";",$a);
					//print_r ($row);
					$queryS = "UPDATE applicant set current_sem='12' WHERE appNo='$row[0]'";
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
    <h1>Update Students Semester</h1>
    <div id="tabs">
      <ul>
        <li><a href="studentConfirm.php"><span class="current">All Applicants</span></a></li>
        <li><a href="localApplicantsConfirm.php"><span>Local Applicants</span></a></li>
        <li><a href="foreignApplicantsConfirm.php"><span>Foreign Applicants</span></a></li>
      </ul>
    </div>
    <br/><br/><br/><br/><br/><br/>
    
<form method="post" action="semesterUpdate.php" class="plain" form name="appicant">
  <table class="panel" style="margin-left:8px">
    <tr>
    
		
  	</tr>
	<tr>
        <td height="25">Current Semester </td>
        <td><select name="csem" id="csem" tabindex="4" onchange="this.form.submit();"> 
           <option value='11'>1 Year 1 Semester</option>
           <option value='12'>1 Year 2 Semester</option>
		   <option value='21'>2 Year 1 Semester</option>
		   <option value='22'>2 Year 2 Semester</option>
		   <option value='31'>3 Year 1 Semester</option>
		   <option value='32'>3 Year 2 Semester</option>
		   <option value='41'>4 Year 1 Semester</option>
		   <option value='42'>4 Year 2 Semester</option>
        </select></td>
      </tr>
	  <tr>
        <td height="25">New Semester </td>
        <td><select name="nsem" id="nsem" tabindex="4"> 
            <option value='11'>1 Year 1 Semester</option>
           <option value='12'>1 Year 2 Semester</option>
		   <option value='21'>2 Year 1 Semester</option>
		   <option value='22'>2 Year 2 Semester</option>
		   <option value='31'>3 Year 1 Semester</option>
		   <option value='32'>3 Year 2 Semester</option>
		   <option value='41'>4 Year 1 Semester</option>
		   <option value='42'>4 Year 2 Semester</option>
        </select></td>
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
	  <th>&nbsp;</th>
    	<th>Applicant No</th>
   	   
   	  <th>Name</th>
   	
   	  <th>Current Semester</th>
		 
   	  
    </tr>
    
<?php
	$rowNum=0;
  //2021.03.24 start  while ($row = mysql_fetch_array($result))
  while ($row = $db->Next_Record($result))
  //2021.03.24 end
  { 
     
 ?>
	<tr>
	  <td><input name="chk[]" type="checkbox" value="<?php echo $row['appNo'].";". $row['appType'] ?>"><br>
        <td><?php echo $row['regNo'] ?></td>
       
		<td><?php echo $row['nameEnglish'] ?></td>
        <td><?php echo $row['current_sem'] ?></td>

        
    </tr>
<?php
      
$rowNum+=1;
  }  
?>
</table>
 <table width="515" class="panel" style="margin-left:8px">
    <tr> 
      <td width="140"><input name="btnSelect" type="submit" id="btnSelect3" value="Update" class="button"/> 
	  
	 
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