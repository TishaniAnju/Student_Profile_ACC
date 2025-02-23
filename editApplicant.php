<?php
  ob_start();
?>

<?php
	include("dbAccess.php");
    $db = new DBOperations();
	
	$appNo =  $db->cleanInput($_GET['appNo']);
  //print $appNo;
	$appType =$db->cleanInput($_GET['appType']);
  
  if (isset($_POST['nikayaName'])) {
    $nikayaID = $db->cleanInput($_POST['nikayaName']);  
  
  }

  if($appType=="Local")
  {

    if (isset($_POST['btnAdd']))
	{
    
   
	$nameEnglish =  $db->cleanInput($_POST['txtNameE']);
  $entryYear= $_POST['lstYearEntry'];
  $titleE = $_POST['lstTitle'];
  $addressEnglish1 = $db->cleanInput($_POST['txtaddE1']);
	$addressEnglish2 = $db->cleanInput($_POST['txtaddE2']);
	$addressEnglish3 = $db->cleanInput($_POST['txtaddE3']);



	$query = "UPDATE applicant SET entryYear='$entryYear',titleE='$titleE',nameEnglish='$nameEnglish',addressEnglish1='$addressEnglish1',addressEnglish2='$addressEnglish2',addressEnglish3='$addressEnglish3' WHERE appNo='$appNo' AND appType='$appType'";
	$result =  $db->executeQuery($query);
    
    
  $nameSinhala =  $db->cleanInput($_POST['txtNameS']);
  $addressSinhala1 =$db->cleanInput($_POST['txtaddS1']);
	$addressSinhala2 = $db->cleanInput($_POST['txtaddS2']);
	$addressSinhala3 = $db->cleanInput($_POST['txtaddS3']);
  $district = $db->cleanInput($_POST['txtdistrict']); 
  $telno =  $db->cleanInput($_POST['txtTelNo']);
  $email = $db->cleanInput($_POST['txtemail']);
  $gnameSinhala = $db->cleanInput($_POST['txtNameGS']);
	$gnameEnglish = $db->cleanInput($_POST['txtNameGE']);
	$gaddressSinhala1 = $db->cleanInput($_POST['txtaddGS1']);
  $gaddressSinhala2 = $db->cleanInput($_POST['txtaddGS2']);
	$gaddressSinhala3 = $db->cleanInput($_POST['txtaddGS3']); 
	$gaddressEnglish1 = $db->cleanInput($_POST['txtaddGE1']);
	$gaddressEnglish2 = $db->cleanInput($_POST['txtaddGE2']);
	$gaddressEnglish3 = $db->cleanInput($_POST['txtaddGE3']);
  $appFee = $db->cleanInput($_POST['appFee']);
  $entryType = $db->cleanInput($_POST['lstEntry']);
  $alAdNo = $db->cleanInput($_POST['txtA_LAddmision']);
  $alYear = $_POST['lstAlYear'];
  $zScore = $db->cleanInput($_POST['txtZScore']);
	$gkScore = $db->cleanInput($_POST['txtGKScore']);
  $nicNo = $db->cleanInput($_POST['txtID']);
  $dob = $db->cleanInput($_POST['txtbd']);

  $code = $_POST['lstPali'];
		//print $code; 
  $paliresult = $db->cleanInput($_POST['txtPResult']);
  $chapterID=$db->cleanInput($_POST['capteraName']);
  $nikayaID=$db->cleanInput($_POST['nikayaName']);
		//print $paliresult;
    
//============================================= Lakshnai Edit update ===========================================
$subCode11 = $db->cleanInput($_POST['lstSub1']);
		$subCode21 = $db->cleanInput($_POST['lstSub2']);
		$subCode31 = $db->cleanInput($_POST['lstSub3']);
    $grade11= $db->cleanInput($_POST['lstResult1']);
		$grade21 = $db->cleanInput($_POST['lstResult2']);
		$grade31 = $db->cleanInput($_POST['lstResult3']);
    $subCode12 = $db->cleanInput($_POST['2stSub1']);
    $subCode22 = $db->cleanInput($_POST['2stSub2']);
    $subCode32 = $db->cleanInput($_POST['2stSub3']);
    $grade12= $db->cleanInput($_POST['2stResult1']);
    $grade22 = $db->cleanInput($_POST['2stResult2']);
    $grade32 = $db->cleanInput($_POST['2stResult3']);
    $subCode13 = $db->cleanInput($_POST['3stSub1']);
    $subCode23 = $db->cleanInput($_POST['3stSub2']);
    $subCode33 = $db->cleanInput($_POST['3stSub3']);
    $grade13= $db->cleanInput($_POST['3stResult1']);
    $grade23 = $db->cleanInput($_POST['3stResult2']);
    $grade33 = $db->cleanInput($_POST['3stResult3']);
    $subCode14 = $db->cleanInput($_POST['4stSub1']);
    $subCode24 = $db->cleanInput($_POST['4stSub2']);
    $subCode34 = $db->cleanInput($_POST['4stSub3']);
    $grade14= $db->cleanInput($_POST['4stResult1']);
    $grade24 = $db->cleanInput($_POST['4stResult2']);
    $grade34 = $db->cleanInput($_POST['4stResult3']);
    $subCode15 = $db->cleanInput($_POST['5stSub1']);
    $subCode25 = $db->cleanInput($_POST['5stSub2']);
    $subCode35 = $db->cleanInput($_POST['5stSub3']);
    $grade15= $db->cleanInput($_POST['5stResult1']);
    $grade25 = $db->cleanInput($_POST['5stResult2']);
    $grade35 = $db->cleanInput($_POST['5stResult3']);
    //===============================================
    $alAdNo1 = $db->cleanInput($_POST['txtA_LAddmision1']);
		$alYear1 = $_POST['lstAlYear1'];
    $alAdNo2 = $db->cleanInput($_POST['txtA_LAddmision2']);
		$alYear2 = $_POST['lstAlYear2'];
    $alAdNo3 = $db->cleanInput($_POST['txtA_LAddmision3']);
		$alYear3 = $_POST['lstAlYear3'];
   
    $alAdNo4 = $db->cleanInput($_POST['txtA_LAddmision4']);
		$alYear4 = $_POST['lstAlYear4'];
    $medium = $db->cleanInput($_POST['medium1']);
    $medium1 = $db->cleanInput($_POST['medium2']);
    $medium2 = $db->cleanInput($_POST['medium3']);
    $medium3 = $db->cleanInput($_POST['medium4']);
    $medium4 = $db->cleanInput($_POST['medium5']);

    if ($alAdNo!=''){
      $querypaliquli1 = " INSERT INTO applicantquli SET appNo = '$var' ,quli_Id='1', quli_year = '$alYear', indexNo = '$alAdNo', stream = '$stream', medium = '$medium1'";
		
    $query3 = " INSERT INTO applicantsubjects SET appNo = '$var' ,quli_Id='1', subjectCode = '$subCode11', result = '$grade11' ";
    
		//$result = executeQuery($query);
		
		$query4 = " INSERT INTO applicantsubjects SET appNo = '$var' , quli_Id='1', subjectCode = '$subCode21', result = '$grade21' ";
		//$result = executeQuery($query);
		
		$query5 = " INSERT INTO applicantsubjects SET appNo = '$var' ,quli_Id='1', subjectCode = '$subCode31' , result = '$grade31' ";

    $result3 = $db->executeQuery($query3);
    $result4 = $db->executeQuery($query4);
    $result5 = $db->executeQuery($query5);
    $resultpaliquli1 = $db->executeQuery($querypaliquli1);

    }

    if ($alAdNo1!=''){
      $querypaliquli2 = " INSERT INTO applicantquli SET appNo = '$var' ,quli_Id='5', quli_year = '$alYear1', indexNo = '$alAdNo1',medium = '$medium1' ";
		$query6 = " INSERT INTO applicantsubjects SET appNo = '$var' ,quli_Id='5', subjectCode = '$subCode12', result = '$grade12' ";
    
		//$result = executeQuery($query);
		
		$query7 = " INSERT INTO applicantsubjects SET appNo = '$var' , quli_Id='5', subjectCode = '$subCode22', result = '$grade22' ";
		//$result = executeQuery($query);
		
		$query8 = " INSERT INTO applicantsubjects SET appNo = '$var' ,quli_Id='5', subjectCode = '$subCode32' , result = '$grade32' ";
    $result6 = $db->executeQuery($query6);
    $result7 = $db->executeQuery($query7);
    $result8 = $db->executeQuery($query8);
    $resultpaliquli2 = $db->executeQuery($querypaliquli2);

    }
    if ($alAdNo2!=''){
      $querypaliquli3 = " INSERT INTO applicantquli SET appNo = '$var' ,quli_Id='6', quli_year = '$alYear2', indexNo = '$alAdNo2',medium = '$medium2' ";
    $query9 = " INSERT INTO applicantsubjects SET appNo = '$var' ,quli_Id='6', subjectCode = '$subCode13', result = '$grade13' ";
    
		//$result = executeQuery($query);
		
		$query10 = " INSERT INTO applicantsubjects SET appNo = '$var' , quli_Id='6', subjectCode = '$subCode23', result = '$grade23' ";
		//$result = executeQuery($query);
		
		$query11 = " INSERT INTO applicantsubjects SET appNo = '$var' ,quli_Id='6', subjectCode = '$subCode33' , result = '$grade33' ";

    $result9 = $db->executeQuery($query9);
    $result10 = $db->executeQuery($query10);
    $result11 = $db->executeQuery($query11);
    $resultpaliquli3 = $db->executeQuery($querypaliquli3);

    }
    if ($alAdNo3!=''){
      $querypaliquli4 = " INSERT INTO applicantquli SET appNo = '$var' ,quli_Id='7', quli_year = '$alYear3', indexNo = '$alAdNo3',medium = '$medium3' ";
    $query12 = " INSERT INTO applicantsubjects SET appNo = '$var' ,quli_Id='7', subjectCode = '$subCode14', result = '$grade14' ";
    
		//$result = executeQuery($query);
		
		$query13 = " INSERT INTO applicantsubjects SET appNo = '$var' , quli_Id='7', subjectCode = '$subCode24', result = '$grade24' ";
		//$result = executeQuery($query);
		
		$query14 = " INSERT INTO applicantsubjects SET appNo = '$var' ,quli_Id='7', subjectCode = '$subCode34' , result = '$grade34' ";

    $result12 = $db->executeQuery($query12);
    $result13 = $db->executeQuery($query13);
    $result14 = $db->executeQuery($query14);
    $resultpaliquli4 = $db->executeQuery($querypaliquli4);

    }
 
    if ($alAdNo4!=''){
      $querypaliquli5 = " INSERT INTO applicantquli SET appNo = '$var' ,quli_Id='8', quli_year = '$alYear4', indexNo = '$alAdNo4',medium = '$medium4' ";
      $query15 = " INSERT INTO applicantsubjects SET appNo = '$var' ,quli_Id='8', subjectCode = '$subCode15', result = '$grade15' ";
      
      //$result = executeQuery($query);
      
      $query16 = " INSERT INTO applicantsubjects SET appNo = '$var' , quli_Id='8', subjectCode = '$subCode25', result = '$grade25' ";
      //$result = executeQuery($query);
      
      $query17 = " INSERT INTO applicantsubjects SET appNo = '$var' ,quli_Id='8', subjectCode = '$subCode35' , result = '$grade35' ";
      $result15 = $db->executeQuery($query15);
      $result16 = $db->executeQuery($query16);
      $result17 = $db->executeQuery($query17);
      $resultpaliquli5 = $db->executeQuery($querypaliquli5);
      
    }



//==================================================================================================================
  /*$query = "UPDATE localapplicant SET nameSinhala='$nameSinhala',addS1='$addressSinhala1',addS2='$addressSinhala2',addS3='$addressSinhala3',district='$district',
  telno='$telno',email='$email',guardianEname='$gnameEnglish',guardianSname='$gnameSinhala',guardianEadd1='$gaddressEnglish1',guardianEadd2='$gaddressEnglish2',
  guardianEadd3='$gaddressEnglish3',guardianSadd1='$gaddressSinhala1',guardianSadd2='$gaddressSinhala2',guardianSadd3='$gaddressSinhala3',appfee='$appFee',
  entryType='$entryType',alAdNo='$alAdNo',alYear='$alYear',zScore='$zScore',gkScore='$gkScore',nicNo='$nicNo',dob='$dob', nikaya='$nikayaID', chapter='$chapterID' WHERE appNo='$appNo'";*/

  $query = "UPDATE localapplicant SET nameSinhala='$nameSinhala',addS1='$addressSinhala1',addS2='$addressSinhala2',addS3='$addressSinhala3',district='$district',
  telno='$telno',email='$email',guardianEname='$gnameEnglish',guardianSname='$gnameSinhala',guardianEadd1='$gaddressEnglish1',guardianEadd2='$gaddressEnglish2',
  guardianEadd3='$gaddressEnglish3',guardianSadd1='$gaddressSinhala1',guardianSadd2='$gaddressSinhala2',guardianSadd3='$gaddressSinhala3',appfee='$appFee',
  entryType='$entryType',alAdNo='$alAdNo',alYear='$alYear',zScore='$zScore',gkScore='$gkScore',nicNo='$nicNo',dob='$dob'WHERE appNo='$appNo'";
  
  $result =  $db->executeQuery($query);

  $delQuery1 = "DELETE FROM applicantquli WHERE appNo='$appNo'";
  $delQuery1 = "DELETE FROM applicantsubjects WHERE appNo='$appNo'";

  $resultdel1=  $db->executeQuery($delQuery1); 
  $resultdel1=  $db->executeQuery($delQuery1);
  
  $query11 = "INSERT INTO applicantsubjects SET appNo = '$appNo',subjectCode = '$subCode1', result = '$result1' ";
  $query21 = "INSERT INTO applicantsubjects SET appNo = '$appNo',subjectCode = '$subCode2', result = '$result2' ";
  $query31 = "INSERT INTO applicantsubjects SET appNo = '$appNo',subjectCode = '$subCode3', result = '$result3' ";

 
  
$res1 = $db->executeQuery($query11);
 $res2 =  $db->executeQuery($query21);
 $res3 =  $db->executeQuery($query31); 
  $y='n';
  $queryselect = "SELECT * FROM applicantpali WHERE appNo = '$appNo'";
			$resultselect = $db->executeQuery($queryselect);
			while($resultSet = $db->Next_Record($resultselect))
			{
				$y = 'y';
				
        	} 

if($y=='y'){
  $querydel2= "DELETE FROM applicantpali WHERE appNo = '$appNo'";
	$resultdel2 = $db->executeQuery($querydel2);
	}
	
	 if($code==''){
	 
	}
	else{
	
	 $query4 = "INSERT INTO applicantpali SET appNo='$appNo', code='$code', result='$paliresult'";
	$result4 = $db->executeQuery($query4);	 

		}

 
	header("location:applicant.php");
	}

    /* $query = "SELECT * FROM applicant WHERE appNo='$appNo' AND appType='$appType'";
    $result = $db->executeQuery($query); 

    $query = "SELECT * FROM localapplicant WHERE appNo='$appNo'";
    $result = $db->executeQuery($query);  */

    //quering data
		$queryedit = "SELECT entryYear,titleE,nameEnglish,addressEnglish1,addressEnglish2,addressEnglish3,nameSinhala,addS1,addS2,addS3,district,telno,email,guardianEname,guardianSname,guardianEadd1,guardianEadd2,guardianEadd3,guardianSadd1,guardianSadd2,guardianSadd3,appfee,entryType,alAdNo,alYear,zScore,gkScore,nicNo,dob,nikaya,chapter FROM applicant JOIN localapplicant ON applicant.appNo = localapplicant.appNo  WHERE applicant.appNo='$appNo' AND applicant.appType='$appType'";
		
     $resultedit = $db->executeQuery($queryedit);
    
    while ($row = $db->Next_Record($resultedit))
        {
          $nikayaID1=$row['nikaya'];
          $chapterID1=$row['chapter'];
     
          //print $row['entryYear'];
         // print $row['nicNo'];
         // print $chapterID;

    ?>

<h1>Edit Local Applicant Details</h1>
<form action="" method="post" name="form1">
    <table border="0" bordercolorlight="#E2E2E2" class="searchResults">

    <tr>
            <td height="28">Nikaya Name:</td>
            <td>
           
                <select name="nikayaName" id="nikayaName"    required >
               
                <?php 
               /*
            
                     $queryn ="SELECT * FROM nikaya";
                     $resultn = $db->executeQuery($queryn);

                     while ($rown = $db->Next_Record($resultn)) { 
                    
                      echo '<option value="0"> Not applicable </option>';
                     }
                      else if ($rown['nikayaID']==$nikayaID1){
                    
                        //echo '<option value="' . $rown['nikayaID'] . '" selected="selected">' . $nikayaaaaID . '</option>';
                       
                        echo '<option value="' . $rown['nikayaID'] . '" selected="selected">' . $rown['nikayaID'] . ' - ' . $rown['nikayaName'] . '</option>';
                     }
                     
                      else{
                      echo '<option value="' . $rown['nikayaID'] . '">' . $rown['nikayaID'] . ' - ' . $rown['nikayaName'] . '</option>';
                      
                      }
                     }
                     
                    
*/
                    
                    ?>

        <option <?php if($row['nikaya']=='0') echo "selected='selected'"; ?>>- Not Applicable -</option>
			  <option <?php if($row['nikaya']=='2') echo "selected='selected'"; ?>>ස්‍යාමෝපාලි මහ නිකාය</option>
			  <option <?php if($row['nikaya']=='3') echo "selected='selected'"; ?>>ශ්‍රී ලංකා අමරපුර මහානිකාය</option>
        <option <?php if($row['nikaya']=='4') echo "selected='selected'"; ?>>ශ්‍රී ලංකා රාමඤ්ඤ මහානිකාය</option> 
                     
                </select>
               
            </td>
        </tr>
       




        <tr>
            <td height="28">Chapter Name: </td>
            <td>
                <select name="capteraName" id="capteraName" >
                
                <?php 
                $queryeditabc = "SELECT nikaya,chapter FROM applicant JOIN localapplicant ON applicant.appNo = localapplicant.appNo  WHERE applicant.appNo='$appNo' AND applicant.appType='$appType'";
                $resulteditabc = $db->executeQuery($queryeditabc);
                while ($rowabc = $db->Next_Record($resulteditabc))
                    {
                      $nikayaID1=$row['nikaya'];
                      $chapterID1=$row['chapter'];
                    }
                     $queryc ="SELECT * FROM `chapter` ";
                     $resultc = $db->executeQuery($queryc);

                     while ($rown = $db->Next_Record($resultc)) { 
                      
                      if ($rown['chapterID']==$chapterID1){
                      echo '<option value="' . $rown['chapterID'] . '" selected="selected">' . $rown['chapterID'] . ' - ' . $rown['chapter'] . '</option>';
                      }
                      else{
                        echo '<option value="' . $rown['chapterID'] . '">' . $rown['chapterID'] . ' - ' . $rown['chapter'] . '</option>';
                      }
                     }
                    
                    ?>
                    
                </select>
            </td>
        </tr>

    
         <tr>
			<td height="48">Year of Entry </td>
			<td><label>
			  <select name="lstYearEntry" id="lstYearEntry" tabindex="3">
			  <?php 
		   for ($i= 1990; $i<2100; $i++){
			if ($row['entryYear']==$i)
						echo "<option selected='selected' value=\"".$i."\">".$i."</option>";
						else echo "<option value=\"".$i."\">".$i."</option>";
			}
		   ?>
			  </select>
			</label></td>
		  </tr>

      <tr>
        <td height="25">National ID  </td>
        <td><input name="txtID" type="text" value="<?php echo $row['nicNo']; ?>" tabindex="3" size="20" /></td>
      </tr>

      <tr>
        <td height="25">Date of Birth </td>
        <td><input name="txtbd" type="date" value="<?php echo $row['dob']; ?>"  tabindex="3" size="20" /></td>
      </tr>

          <tr>
			<td height="39">Title </td>
			<td><select name="lstTitle" id="lstTitle" tabindex="5">
			 <option <?php if($row['titleE']=='Ven.') echo "selected='selected'"; ?>>Ven.</option>
			  <option <?php if($row['titleE']=='Mr.') echo "selected='selected'"; ?>>Mr.</option>
			  <option <?php if($row['titleE']=='Ms.') echo "selected='selected'"; ?>>Ms.</option>
			</select></td>
		  </tr>

        <tr>
            <td height="49">Name </td>
            <td><label>
            <input type="text" name="txtNameE" id="txtNameE" value="<?php echo $row['nameEnglish']; ?>" tabindex="5" />
            </label></td>
          </tr>

          <tr>
			<td height="45"><p>&#3505;&#3512; <font/></font></font> </p></td>
			<td><label>
			  <input name="txtNameS" type="text" tabindex="7" value="<?php echo $row['nameSinhala']; ?>" size="50" />
			</label></td>
		  </tr>

          <tr>
			<td height="37"> Address - No</td>
			<td><label>
			  <input name="txtaddE1" type="text" value="<?php echo $row['addressEnglish1']; ?>" size="20" tabindex="8"   />
			</label></td>
		  </tr>
		  <tr>
			<td height="45"> <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Street </font></pre></td>
			<td><input name="txtaddE2" type="text" value="<?php echo $row['addressEnglish2']; ?>" size="40" tabindex="9"/></td>
		  </tr>
		  <tr>
			<td height="45"><pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Town</font></pre ></td>
			<td><input name="txtaddE3" type="text" value="<?php echo $row['addressEnglish3']; ?>" size="40" tabindex="10" /></td>
		  </tr>

          <tr>
			<td height="50"><font face="KaputaUnicode" size="2" >&#3517;&#3538;&#3508;&#3538;&#3505;&#3514;-&#3461;&#3458;&#3482;&#3514; </td>
			<td><input name="txtaddS1" type="text" value="<?php echo $row['addS1']; ?>" size="20" tabindex="11" /></td>
		  </tr>
		  <tr>
			<td height="48"><font face="KaputaUnicode" size="2" ><pre>    &#3520;&#3539;&#3503;&#3538;&#3514;<pre/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td><input name="txtaddS2" type="text" value="<?php echo $row['addS2']; ?>" size="40" tabindex="12"/></td>
		  </tr>
		  <tr>
			<td height="44"><font face="KaputaUnicode" size="2" ><pre>    &#3505;&#3484;&#3515;&#3514;<pre/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td><input name="txtaddS3" type="text" value="<?php echo $row['addS3']; ?>" size="40" tabindex="13" /></td>
		  </tr>

      <tr>
        <td height="25">Administrative District</td>
        <!-- &#3508;&#3515;&#3538;&#3508;&#3535;&#3517;&#3505; &#3503;&#3538;&#3523;&#3530;&#3501;&#3538;&#3482;&#3530;&#3482;&#3514;</td> -->
        
        <td><select name="txtdistrict" id="txtdistrict"  tabindex="13">

        <?php
			$query = "SELECT * FROM stu_districts";
			$result = $db->executeQuery($query);
			while($resultSet = $db->Next_Record($result))
			{
				$id = $resultSet["id"];
				$district = $resultSet["districtEnglish"];
        if ($row['district']==$district)
        echo "<option selected='selected' value=\"".$district."\">".$district."</option>";
        
        else echo "<option value=\"".$district."\">".$district."</option>";
        	} 
			?>
      </select></td>
      </tr>

          <tr>
        <td height="25" width="161">  Telephone No</td>
        <td width="309"><input name="txtTelNo" type="text" value="<?php echo $row['telno']; ?>" tabindex="2" size="20" /></td>
      </tr>
      <tr>
        <td height="25">Email</td>
        <td><label>
          <input name="txtemail" type="text" value="<?php echo $row['email']; ?>" size="20" tabindex="19"   />
        </label></td>
      </tr>

      <tr>
        <td height="25">Guardian Name </td>
        <td><label>
        <input name="txtNameGE" type="text" value="<?php echo $row['guardianEname']; ?>" tabindex="5"  size="30"/>
        </label></td>
      </tr>
      <tr>
        <td height="25"><p>&#3505;&#3512; <font/></font></font> </p></td>
        <td><label>
          <input name="txtNameGS" type="text" value="<?php echo $row['guardianSname']; ?>" tabindex="6"  size="50" />
        </label></td>
      </tr>
      <tr>
        <td height="25">Guardian Address - No</td>
        <td><label>
          <input name="txtaddGE1" type="text" size="20" value="<?php echo $row['guardianEadd1']; ?>" tabindex="13"   />
        </label></td>
      </tr>
      <tr>
        <td height="25"> <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Street </font></pre></td>
        <td><input name="txtaddGE2" type="text"  size="40" value="<?php echo $row['guardianEadd2']; ?>" tabindex="14"/></td>
      </tr>
      <tr>
        <td height="25"><pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Town</font></pre ></td>
        <td><input name="txtaddGE3" type="text"  size="40" value="<?php echo $row['guardianEadd3']; ?>" tabindex="15" /></td>
      </tr>
      <tr>
        <td height="25"><font face="KaputaUnicode" size="2" >&#3517;&#3538;&#3508;&#3538;&#3505;&#3514;-&#3461;&#3458;&#3482;&#3514; </td>
        <td><input name="txtaddGS1" type="text"  size="20" value="<?php echo $row['guardianSadd1']; ?>" tabindex="16" /></td>
      </tr>
      <tr>
        <td height="25"><font face="KaputaUnicode" size="2" ><pre>    &#3520;&#3539;&#3503;&#3538;&#3514;<pre/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input name="txtaddGS2" type="text" size="40" value="<?php echo $row['guardianSadd2']; ?>" tabindex="17"/></td>
      </tr>
      <tr>
        <td height="25"><font face="KaputaUnicode" size="2" ><pre>    &#3505;&#3484;&#3515;&#3514;<pre/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input name="txtaddGS3" type="text"  size="40" value="<?php echo $row['guardianSadd3']; ?>" tabindex="18" /></td>
      </tr>

      <tr>
        <td height="25"> Apllication Fee paid or not </td>
        <td>
          <select name="appFee" id="appFee" tabindex="14" >
            <option <?php if($row['appfee']=='Paid') echo "selected='selected'"; ?> >Paid</option>
            <option <?php if($row['appfee']=='Not Paid') echo "selected='selected'"; ?> > Not Paid</option>
              </select></td>
      </tr>

      <tr>
        <td height="25">A/L Subject Results</td>
      </tr>
      <tr>
        <td height="25">A/L Year</td>
        <td><select name="lstAlYear" id="lstYear" tabindex="16">
        <?php 
		   for ($i= 1990; $i<2100; $i++){
			if ($row['alYear']==$i)
						echo "<option selected='selected' value=\"".$i."\">".$i."</option>";
						else echo "<option value=\"".$i."\">".$i."</option>";
			}
		   ?>
      </select></td>
      </tr>
<?php
//=========================================================================================================================
$queryquliALvalues = "SELECT * FROM applicantquli  WHERE appNo = '$appNo' and  applicantquli.quli_id='1' ";
   
$resultquliALvalues = $db->executeQuery($queryquliALvalues);
while($resultSetquli5 = $db->Next_Record($resultquliALvalues))
      {
        $a=$resultSetquli5['indexNo'];
        $b=$resultSetquli5['quli_year'];
        $c=$resultSetquli5['medium'];
        $s1=$resultSetquli5['stream'];

        if ($c=='e'){
          $d="English";
        }
        if ($c=='s'){
          $d="Sinhala";
        }



        $queryqulistream = "SELECT * FROM alstream  WHERE streamId = '$s1' ";

        $resultqulistream = $db->executeQuery($queryqulistream);
while($resultSetstream = $db->Next_Record($resultqulistream))
      {
        $streamdes=$resultSetstream['description'];
        }
      }


//=========================================================================================================================
  ?>  
      <tr>
        <td height="25"> Medium </td>
        <td>
          <select name="medium1" id="medium1" tabindex="14" >
            
            <option <?php if($c=='s') echo "selected='selected'"; ?>> Sinhala</option>
			  <option <?php if($c=='e') echo "selected='selected'"; ?>>English</option>
              </select></td>
      </tr>
		
      <tr>
        <td height="25">Stream</td>
        <!-- &#3508;&#3515;&#3538;&#3508;&#3535;&#3517;&#3505; &#3503;&#3538;&#3523;&#3530;&#3501;&#3538;&#3482;&#3530;&#3482;&#3514;</td> -->
        
        <td><select name="txtstream" id="txtstream" tabindex="13" onChange="subjectFilter(this.value)">
<option value="">-Select-</option>
        <?php
			$query = "SELECT * FROM alstream";
			$result = $db->executeQuery($query);
			while($resultSet = $db->Next_Record($result))
			{
				$streamId = $resultSet["streamId"];
				$description = $resultSet["description"];
				echo "<option value=\"".$streamId."\">".$description."</option>";
        	} 
			?>
      </select></td>
      </tr> 





    <tr>
        <td height="25">Z-Score </td>
        <td><label>
          <input name="txtZScore" type="text" value="<?php echo $row['zScore']; ?>"  tabindex="17" size="20" />
        </label></td>
      </tr>
      <tr>
        <td height="25">General Knowladge Score</td>
        <td><label>
          <input name="txtGKScore" type="text" value="<?php echo $row['gkScore']; ?>"  size="20" tabindex="18" />
        </label></td>
      </tr>
    

      <tr>
        <td height="25" colspan="2">

      <?php
			$queryAL = "SELECT * FROM applicantsubjects JOIN alsubjects ON applicantsubjects.subjectCode = alsubjects.subjectCode  WHERE appNo = '$appNo' and  applicantsubjects.quli_Id='1' ";
		//print $queryAL;
			$resultAL = $db->executeQuery($queryAL);
			
			?>

      <table width="275" border="1" id="tblpali">
      <tr>
      <td colspan="2"><table width="223" height="124" border="1" >
            <tr>
              <th width="150" scope="col">Subject Name</th>
              <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
          </tr>
		 <?php 
          
           $query = "SELECT * FROM alsubjects";
           $result = $db->executeQuery($query); 

          for ($j=1;$j<=1;$j++) {
            
           while($resultSet = $db->Next_Record($resultAL))
            {
			
		
              $rSubjectCode  = $resultSet["subjectCode"];
              $rSubject = $resultSet["subnameE"];
              $rresult = $resultSet["result"];
			
			

              echo "<tr><td><div id='Subject".$j."'> <select name='lstSub".$j."' tabindex='20'>";
              
             echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
              
          
  			$query = "SELECT * FROM alsubjects";
           $result = $db->executeQuery($query); 

              while($resultSet1 = $db->Next_Record($result))
            {
              $subCode = $resultSet1["subjectCode"];
              $sub = $resultSet1["subnameE"];
              if ($rSubjectCode==$subCode){
			
                echo "<option selected='selected' value=\"".$subCode."\">".$sub."</option>";
				//echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
				}
				
				
            /*  else {
		
			  echo "<option value=\"".$subCode."\">".$sub."</option>"; 
			 // echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
			 } */
            }
            
            
            
                    
            ?>
            
            </select></div> </td>

            <?php  echo " <td>
                   <select name= 'lstResult".$j."'tabindex='21'>"; ?>
                        <option <?php if($rresult=='A') echo "selected='selected'";?>>A</option>
                        <option <?php if($rresult=='B') echo "selected='selected'";?>>B</option>
                        <option <?php if($rresult=='C') echo "selected='selected'";?>>C</option>
                        <option <?php if($rresult=='S') echo "selected='selected'";?>>S</option>
                        <option <?php if($rresult=='F') echo "selected='selected'";?>>F</option>
                    </select></td>
                    </tr>

            <?php }} ?>
				</table>
				  </td>
				  </tr>
          
				
          
            
        </table>    
        </td></tr>
        <tr>
        <td height="25">Prachina Madayama Subject Results</td>
      </tr>
      <?php
			$queryAL5 = "SELECT * FROM applicantsubjects JOIN alsubjects ON applicantsubjects.subjectCode = alsubjects.subjectCode  WHERE appNo = '$appNo' and  applicantsubjects.quli_Id='5' ";
		//print $queryAL;
			$resultAL5 = $db->executeQuery($queryAL5);
			$queryquli5 = "SELECT * FROM applicantquli  WHERE appNo = '$appNo' and  applicantquli.quli_id='5' ";
      //print $queryquli5;
      $resultquli5 = $db->executeQuery($queryquli5);
      while($resultSetquli5 = $db->Next_Record($resultquli5))
            {
              $a1=$resultSetquli5['indexNo'];
              $b1=$resultSetquli5['quli_year'];
              $c1=$resultSetquli5['medium'];
              if ($c1=='e'){
                $d1="English";
              }
              if ($c1=='s'){
                $d1="Sinhala";
              }
              //$c1=$resultSetquli5['medium'];
            }
			?>
    <tr>
    	<td>Admission No : </td><td> <?php echo $a1 ?></td>
    </tr>
    <tr>
    	<td>Year : </td><td> <?php echo $b1 ?></td>
    </tr>
    <tr>
    	<td>Medium </td><td> <?php echo $d1; ?></td>
    </tr>
    
    

      <tr>
        <td height="25" colspan="2">

     

      <table width="275" border="1" id="tblpali">
      <tr>
      <td colspan="2"><table width="223" height="124" border="1" >
            <tr>
              <th width="150" scope="col">Subject Name</th>
              <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
          </tr>
		 <?php 
          
           $query = "SELECT * FROM alsubjects";
           $result = $db->executeQuery($query); 

          for ($j=1;$j<=1;$j++) {
            
           while($resultSet = $db->Next_Record($resultAL5))
            {
			
		
              $rSubjectCode  = $resultSet["subjectCode"];
              $rSubject = $resultSet["subnameE"];
              $rresult = $resultSet["result"];
			
			

              echo "<tr><td><div id='Subject".$j."'> <select name='lstSub".$j."' tabindex='20'>";
              
             echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
              
          
  			$query = "SELECT * FROM alsubjects";
           $result = $db->executeQuery($query); 

              while($resultSet1 = $db->Next_Record($result))
            {
              $subCode = $resultSet1["subjectCode"];
              $sub = $resultSet1["subnameE"];
              if ($rSubjectCode==$subCode){
			
                echo "<option selected='selected' value=\"".$subCode."\">".$sub."</option>";
				//echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
				}
				
				
            /*  else {
		
			  echo "<option value=\"".$subCode."\">".$sub."</option>"; 
			 // echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
			 } */
            }
            
            
            
                    
            ?>
            
            </select></div> </td>

            <?php  echo " <td>
                   <select name= 'lstResult".$j."'tabindex='21'>"; ?>
                        <option <?php if($rresult=='A') echo "selected='selected'";?>>A</option>
                        <option <?php if($rresult=='B') echo "selected='selected'";?>>B</option>
                        <option <?php if($rresult=='C') echo "selected='selected'";?>>C</option>
                        <option <?php if($rresult=='S') echo "selected='selected'";?>>S</option>
                        <option <?php if($rresult=='F') echo "selected='selected'";?>>F</option>
                    </select></td>
                    </tr>

            <?php }} ?>
				</table>
				  </td>
				  </tr>
          
				
          
            
        </table>    
        </td></tr>
        
        <tr>
        <td height="25">Prachina Praramba Subject Results</td>
      </tr>
      <?php
			$queryAL6 = "SELECT * FROM applicantsubjects JOIN alsubjects ON applicantsubjects.subjectCode = alsubjects.subjectCode  WHERE appNo = '$appNo' and  applicantsubjects.quli_Id='6' ";
		//print $queryAL;
			$resultAL6 = $db->executeQuery($queryAL6);
			$queryquli6 = "SELECT * FROM applicantquli  WHERE appNo = '$appNo' and  applicantquli.quli_id='6' ";
      //print $queryquli5;
      $resultquli6 = $db->executeQuery($queryquli6);
      while($resultSetquli6 = $db->Next_Record($resultquli6))
            {
              $a2=$resultSetquli6['indexNo'];
              $b2=$resultSetquli6['quli_year'];
              $c2=$resultSetquli6['medium'];
              if ($c2=='e'){
                $d2="English";
              }
              if ($c2=='s'){
                $d2="Sinhala";
              }
              //$c1=$resultSetquli5['medium'];
            }
			?>
     <tr>
    	<td>Admission No : </td><td> <?php echo $a2 ?></td>
    </tr>
    <tr>
    	<td>Year : </td><td> <?php echo $b2 ?></td>
    </tr>
    <tr>
    	<td>Medium </td><td> <?php echo $d2; ?></td>
    </tr>
    
    

      <tr>
        <td height="25" colspan="2">

      <?php
			//$queryAL = "SELECT * FROM applicantsubjects JOIN alsubjects ON applicantsubjects.subjectCode = alsubjects.subjectCode  WHERE appNo = '$appNo' and  applicantsubjects.quli_Id='6' ";
		//print $queryAL;
			//$resultAL = $db->executeQuery($queryAL);
			
			?>

      <table width="275" border="1" id="tblpali">
      <tr>
      <td colspan="2"><table width="223" height="124" border="1" >
            <tr>
              <th width="150" scope="col">Subject Name</th>
              <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
          </tr>
		 <?php 
          
           $query = "SELECT * FROM alsubjects";
           $result = $db->executeQuery($query); 

          for ($j=1;$j<=1;$j++) {
            
           while($resultSet = $db->Next_Record($resultAL6))
            {
			
		
              $rSubjectCode  = $resultSet["subjectCode"];
              $rSubject = $resultSet["subnameE"];
              $rresult = $resultSet["result"];
			
			

              echo "<tr><td><div id='Subject".$j."'> <select name='lstSub".$j."' tabindex='20'>";
              
             echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
              
          
  			$query = "SELECT * FROM alsubjects";
           $result = $db->executeQuery($query); 

              while($resultSet1 = $db->Next_Record($result))
            {
              $subCode = $resultSet1["subjectCode"];
              $sub = $resultSet1["subnameE"];
              if ($rSubjectCode==$subCode){
			
                echo "<option selected='selected' value=\"".$subCode."\">".$sub."</option>";
				//echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
				}
				
				
            /*  else {
		
			  echo "<option value=\"".$subCode."\">".$sub."</option>"; 
			 // echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
			 } */
            }
            
            
            
                    
            ?>
            
            </select></div> </td>

            <?php  echo " <td>
                   <select name= 'lstResult".$j."'tabindex='21'>"; ?>
                        <option <?php if($rresult=='A') echo "selected='selected'";?>>A</option>
                        <option <?php if($rresult=='B') echo "selected='selected'";?>>B</option>
                        <option <?php if($rresult=='C') echo "selected='selected'";?>>C</option>
                        <option <?php if($rresult=='S') echo "selected='selected'";?>>S</option>
                        <option <?php if($rresult=='F') echo "selected='selected'";?>>F</option>
                    </select></td>
                    </tr>

            <?php }} ?>
				</table>
				  </td>
				  </tr>
          
				
          
            
        </table>    
        </td></tr>
        
        
          
				
          
            
      
        <tr>
        <td height="25">Vidyodaya Subject Results</td>
      </tr>
      <?php
			$queryAL7 = "SELECT * FROM applicantsubjects JOIN alsubjects ON applicantsubjects.subjectCode = alsubjects.subjectCode  WHERE appNo = '$appNo' and  applicantsubjects.quli_Id='7' ";
		//print $queryAL;
			$resultAL7 = $db->executeQuery($queryAL6);
			$queryquli7 = "SELECT * FROM applicantquli  WHERE appNo = '$appNo' and  applicantquli.quli_id='7' ";
      //print $queryquli5;
      $resultquli7 = $db->executeQuery($queryquli7);
      while($resultSetquli7 = $db->Next_Record($resultquli7))
            {
              $a3=$resultSetquli7['indexNo'];
              $b3=$resultSetquli7['quli_year'];
              $c3=$resultSetquli7['medium'];
              if ($c3=='e'){
                $d3="English";
              }
              if ($c3=='s'){
                $d3="Sinhala";
              }
              //$c1=$resultSetquli5['medium'];
            }
			?>
     <tr>
    	<td>Admission No : </td><td> <?php echo $a3 ?></td>
    </tr>
    <tr>
    	<td>Year : </td><td> <?php echo $b3 ?></td>
    </tr>
    <tr>
    	<td>Medium </td><td> <?php echo $d3; ?></td>
    </tr>
    
    

    
    

      <tr>
        <td height="25" colspan="2">

      <?php
			//$queryAL7 = "SELECT * FROM applicantsubjects JOIN alsubjects ON applicantsubjects.subjectCode = alsubjects.subjectCode  WHERE appNo = '$appNo' and  applicantsubjects.quli_Id='7' ";
		//print $queryAL;

    //$queryAL = "SELECT * FROM applicantquli JOIN alsubjects ON applicantsubjects.subjectCode = alsubjects.subjectCode  WHERE appNo = '$appNo' and  applicantsubjects.quli_Id='7' ";
			//$resultAL7 = $db->executeQuery($queryAL7);
			
			?>

      <table width="275" border="1" id="tblpali">
      <tr>
      <td colspan="2"><table width="223" height="124" border="1" >
            <tr>
              <th width="150" scope="col">Subject Name</th>
              <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
          </tr>
		 <?php 
          
           $query = "SELECT * FROM alsubjects";
           $result = $db->executeQuery($query); 

          for ($j=1;$j<=1;$j++) {
            
           while($resultSet = $db->Next_Record($resultAL7))
            {
			
		
              $rSubjectCode  = $resultSet["subjectCode"];
              $rSubject = $resultSet["subnameE"];
              $rresult = $resultSet["result"];
			
			

              echo "<tr><td><div id='Subject".$j."'> <select name='lstSub".$j."' tabindex='20'>";
              
             echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
              
          
  			$query = "SELECT * FROM alsubjects";
           $result = $db->executeQuery($query); 

              while($resultSet1 = $db->Next_Record($result))
            {
              $subCode = $resultSet1["subjectCode"];
              $sub = $resultSet1["subnameE"];
              if ($rSubjectCode==$subCode){
			
                echo "<option selected='selected' value=\"".$subCode."\">".$sub."</option>";
				//echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
				}
				
				
            /*  else {
		
			  echo "<option value=\"".$subCode."\">".$sub."</option>"; 
			 // echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
			 } */
            }
            
            
            
                    
            ?>
            
            </select></div> </td>

            <?php  echo " <td>
                   <select name= 'lstResult".$j."'tabindex='21'>"; ?>
                        <option <?php if($rresult=='A') echo "selected='selected'";?>>A</option>
                        <option <?php if($rresult=='B') echo "selected='selected'";?>>B</option>
                        <option <?php if($rresult=='C') echo "selected='selected'";?>>C</option>
                        <option <?php if($rresult=='S') echo "selected='selected'";?>>S</option>
                        <option <?php if($rresult=='F') echo "selected='selected'";?>>F</option>
                    </select></td>
                    </tr>

            <?php }} ?>
				</table>
				  </td>
				  </tr>
          
				
          
            
        </table>    
        </td></tr>
        
        <tr>
        <td height="25">Vidyalankara Subject Results</td>
      </tr>
      <?php
			$queryAL8 = "SELECT * FROM applicantsubjects JOIN alsubjects ON applicantsubjects.subjectCode = alsubjects.subjectCode  WHERE appNo = '$appNo' and  applicantsubjects.quli_Id='8' ";
		//print $queryAL;
			$resultAL8 = $db->executeQuery($queryAL6);
			$queryquli8 = "SELECT * FROM applicantquli  WHERE appNo = '$appNo' and  applicantquli.quli_id='8' ";
      //print $queryquli5;
      $resultquli8 = $db->executeQuery($queryquli8);
      while($resultSetquli8 = $db->Next_Record($resultquli8))
            {
              $a4=$resultSetquli8['indexNo'];
              $b4=$resultSetquli8['quli_year'];
              $c4=$resultSetquli8['medium'];
              if ($c4=='e'){
                $d4="English";
              }
              if ($c4=='s'){
                $d4="Sinhala";
              }
              //$c1=$resultSetquli5['medium'];
            }
			?>
     <tr>
    	<td>Admission No : </td><td> <?php echo $a4; ?></td>
    </tr>
    <tr>
    	<td>Year : </td><td> <?php echo $b4 ?></td>
    </tr>
    <tr>
    	<td>Medium </td><td> <?php echo $d4; ?></td>
    </tr>
    
    

      
      <tr>
        <td height="25" colspan="2">

      <?php
			$queryAL = "SELECT * FROM applicantsubjects JOIN alsubjects ON applicantsubjects.subjectCode = alsubjects.subjectCode  WHERE appNo = '$appNo' and  applicantsubjects.quli_Id='8' ";
		//print $queryAL;
			$resultAL = $db->executeQuery($queryAL);
			
			?>

      <table width="275" border="1" id="tblpali">
      <tr>
      <td colspan="2"><table width="223" height="124" border="1" >
            <tr>
              <th width="150" scope="col">Subject Name</th>
              <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
          </tr>
		 <?php 
          
           $query = "SELECT * FROM alsubjects";
           $result = $db->executeQuery($query); 

          for ($j=1;$j<=1;$j++) {
            
           while($resultSet = $db->Next_Record($resultAL))
            {
			
		
              $rSubjectCode  = $resultSet["subjectCode"];
              $rSubject = $resultSet["subnameE"];
              $rresult = $resultSet["result"];
			
			

              echo "<tr><td><div id='Subject".$j."'> <select name='lstSub".$j."' tabindex='20'>";
              
             echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
              
          
  			$query = "SELECT * FROM alsubjects";
           $result = $db->executeQuery($query); 

              while($resultSet1 = $db->Next_Record($result))
            {
              $subCode = $resultSet1["subjectCode"];
              $sub = $resultSet1["subnameE"];
              if ($rSubjectCode==$subCode){
			
                echo "<option selected='selected' value=\"".$subCode."\">".$sub."</option>";
				//echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
				}
				
				
            /*  else {
		
			  echo "<option value=\"".$subCode."\">".$sub."</option>"; 
			 // echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
			 } */
            }
            
            
            
                    
            ?>
            
            </select></div> </td>

            <?php  echo " <td>
                   <select name= 'lstResult".$j."'tabindex='21'>"; ?>
                        <option <?php if($rresult=='A') echo "selected='selected'";?>>A</option>
                        <option <?php if($rresult=='B') echo "selected='selected'";?>>B</option>
                        <option <?php if($rresult=='C') echo "selected='selected'";?>>C</option>
                        <option <?php if($rresult=='S') echo "selected='selected'";?>>S</option>
                        <option <?php if($rresult=='F') echo "selected='selected'";?>>F</option>
                    </select></td>
                    </tr>

            <?php }} ?>
				</table>
				  </td>
          </tr>





          
          
        </table>
        </td> </tr>

      <tr>
      <td height="46"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Pali Qualification</font></td>	
      </tr>
      <tr>
        <td height="46" colspan="2">

      <?php
		
			
			$query = "SELECT * FROM paliqualification";
			$result =  $db->executeQuery($query);
		
      ?>

        <table width="275" border="1" id="tblpali">
          <tr>
            <!-- <th width="25" scope="col">&nbsp;</th> -->
            <th width="130" scope="col">Subject</th>
            <th width="98" scope="col">Result</th>
          </tr>
          <tr>
            <!-- <td><input type="checkbox" name="chk[]" id="chk" /></td> -->
            <td><select name="lstPali" id="lstPali" tabindex="22">-
			      <!-- <option selected></option> -->
      			<option selected></option>
              <?php
			$query7 = "SELECT * FROM paliqualification";
			$result7 = $db->executeQuery($query7);
			$queryPali = "SELECT * FROM applicantpali JOIN paliqualification ON applicantpali.code = paliqualification.code WHERE appNo='$appNo'"; 
			$resultPali=  $db->executeQuery($queryPali);
			while($resultSet = $db->Next_Record($resultPali))
            {
				 $paliresult1  = $resultSet["result"];
              $paliCode1  = $resultSet["code"];
			  }
			$resultPali=  $db->executeQuery($queryPali);
			while($resultSet1 = $db->Next_Record($result7))
			{
				$PaliCode = $resultSet1["code"];
				
				$Qualification = $resultSet1["qualification"];
				if( $paliCode1==''){
				
				echo "<option value=\"".$PaliCode."\">".$Qualification."</option>";
				}
				elseif ($paliCode1==$PaliCode){
				echo "<option selected='selected' value=\"".$PaliCode."\">".$Qualification."</option>";
				}
				else{
				echo "<option value=\"".$PaliCode."\">".$Qualification."</option>";
				}
        	} 
			?>
             </select></td>
			<td>
			<?php 
			if($paliresult1==''){
			?>
			<input name="txtPResult" type="text" id="txtPResult" tabindex="10" size="15" />
			<?php
			} else{?>
			<input name="txtPResult" type="text" id="txtPResult" tabindex="10" size="15" value="<?php echo $paliresult1; ?>"/>
			<?php }
			?>
			</td>
			</tr>
			
           </table>



          <tr><td colspan="2"><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href='applicant.php';" class="button" />
          <input name="btnAdd" type="submit" value="Save" class="button" >
    </td></tr>

          </table>
          </form>

          <?php
    }//while loop end
    ?>
    <?php
  }//if loop  end

  elseif($appType=="Foreign")
	{

    if (isset($_POST['btnAdd']))
	{

	$nameEnglish =  $db->cleanInput($_POST['txtNameE']);
  $entryYear= $_POST['lstYearEntry'];
  $titleE = $_POST['lstTitle'];
  $addressEnglish1 = $db->cleanInput($_POST['txtaddE1']);
	$addressEnglish2 = $db->cleanInput($_POST['txtaddE2']);
	$addressEnglish3 = $db->cleanInput($_POST['txtaddE3']);



	$query = "UPDATE applicant SET entryYear='$entryYear',titleE='$titleE',nameEnglish='$nameEnglish',addressEnglish1='$addressEnglish1',addressEnglish2='$addressEnglish2',addressEnglish3='$addressEnglish3' WHERE appNo='$appNo' AND appType='$appType'";
	$result =  $db->executeQuery($query);
    
  $telno =  $db->cleanInput($_POST['txtTelNo']);
  $telno1 =  $db->cleanInput($_POST['txtTelNo1']);
  $telno2 =  $db->cleanInput($_POST['txtTelNo2']);
  $email = $db->cleanInput($_POST['txtemail']);
  $Examination = $db->cleanInput($_POST['exam']);
  $Year = $db->cleanInput($_POST['year']);
  $IndexNo = $db->cleanInput($_POST['indexno']);
	$gnameEnglish = $db->cleanInput($_POST['txtNameGE']);
	$gaddressEnglish1 = $db->cleanInput($_POST['txtaddGE1']);
	$gaddressEnglish2 = $db->cleanInput($_POST['txtaddGE2']);
	$gaddressEnglish3 = $db->cleanInput($_POST['txtaddGE3']);
  $appFee = $db->cleanInput($_POST['appFee']);
  $ppNo = $db->cleanInput($_POST['ppNo']);
  $country = $db->cleanInput($_POST['country']);
  $nationality = $db->cleanInput($_POST['nationality']);
  $RgnameEnglish = $db->cleanInput($_POST['residencegname']);
	$RgaddressEnglish1 = $db->cleanInput($_POST['residenceaddG1']);
	$RgaddressEnglish2 = $db->cleanInput($_POST['residenceaddG2']);
	$RgaddressEnglish3 = $db->cleanInput($_POST['residenceaddG3']);
  $residencegtelno = $db->cleanInput($_POST['residencegtelno']);
  $subCode1 = $db->cleanInput($_POST['subject']); 
  $result1 = $_POST['result'];
 /*  $subCode1 = $db->cleanInput($_POST['lstSub1']); 
	$subCode2 = $db->cleanInput($_POST['lstSub2']); 
	$subCode3 = $db->cleanInput($_POST['lstSub3']); 
	
	$result1 = $_POST['lstResult1'];
	$result2 = $_POST['lstResult2'];
	$result3 = $_POST['lstResult3'];
  $code = $_POST['lstPali'];
  $paliresult = $db->cleanInput($_POST['txtPResult']); */
    


  $query = "UPDATE foreignapplicant SET  ppNo =' $ppNo', country = '$country',exam = '$Examination', indexNo = '$IndexNo',	telNo='$telno',	telNo1 = '$telno1' , 	telNo2 = '$telno2' ,email='$email',gnameE='$gnameEnglish',gadde1='$gaddressEnglish1',gadde2='$gaddressEnglish2',
  gadde3='$gaddressEnglish3',appfee='$appFee',gaNameR = '$RgnameEnglish', rsladde1 = '$RgaddressEnglish1' , rsladde2 = '$RgaddressEnglish2' , rsladde3 = '$RgaddressEnglish3' , RSLtelNo = '$residencegtelno' , Nationality = '$nationality'
   WHERE appNo='$appNo'";
  $result =  $db->executeQuery($query);

 /*  $delQuery = "DELETE FROM applicantsubjects WHERE appNo='$appNo'";
  $resultdel=  $db->executeQuery($delQuery); 
  
  $query11 = "INSERT INTO applicantsubjects SET appNo = '$appNo',subjectCode = '$subCode1', result = '$result1' ";
  $query21 = "INSERT INTO applicantsubjects SET appNo = '$appNo',subjectCode = '$subCode2', result = '$result2' ";
  $query31 = "INSERT INTO applicantsubjects SET appNo = '$appNo',subjectCode = '$subCode3', result = '$result3' ";
  
$res1 = $db->executeQuery($query11);
 $res2 =  $db->executeQuery($query21);
 $res3 =  $db->executeQuery($query31); 
  $y='n';
  $queryselect = "SELECT * FROM applicantpali WHERE appNo = '$appNo'";
			$resultselect = $db->executeQuery($queryselect);
			while($resultSet = $db->Next_Record($resultselect))
			{
				$y = 'y';
				
        	} 

if($y=='y'){
  $querydel2= "DELETE FROM applicantpali WHERE appNo = '$appNo'";
	$resultdel2 = $db->executeQuery($querydel2);
	}
	
	 if($code==''){
	 
	}
	else{
	
	 $query4 = "INSERT INTO applicantpali SET appNo='$appNo', code='$code', result='$paliresult'";
	$result4 = $db->executeQuery($query4);	 

		} */

 
	header("location:foreignApplicants.php");
	}

    $queryfedit = "SELECT entryYear,titleE,nameEnglish,addressEnglish1,addressEnglish2,addressEnglish3,telno,email,appfee,ppNo,country,exam,indexNo,year,month,paliQf,Nationality,telNo,telNo1,telNo2,gnameE,gadde1,gadde2,gadde3,appfee,gaNameR,rsladde1,rsladde2,rsladde3,RSLtelNo FROM applicant JOIN foreignapplicant ON applicant.appNo = foreignapplicant.appNo WHERE applicant.appNo='$appNo ' AND applicant.appType='Foreign'";
		$resultfedit = $db->executeQuery($queryfedit);
    while ($row = $db->Next_Record($resultfedit))
        {
          

	?>
  <h1> Edit Foreign Applicant Details</h1>
  <form action="" method="post" name="form1">
    <table border="0" bordercolorlight="#E2E2E2" class="searchResults">
  <tr>
			<td height="48">Year of Entry</td>
			<td><label>
			  <select name="lstYearEntry" id="lstYearEntry" tabindex="3">
			  <?php 
		   for ($i= 1990; $i<2100; $i++){
			if ($row['entryYear']==$i)
						echo "<option selected='selected' value=\"".$i."\">".$i."</option>";
						else echo "<option value=\"".$i."\">".$i."</option>";
			}
		   ?>
			  </select>
			</label></td>
		  </tr>

      <tr>
        <td height="25">Passport No: </td>
        <td><input name="ppNo" type="text" value="<?php echo $row['ppNo']; ?>" tabindex="3" size="20" /></td>
      </tr>
      <tr>
        <td height="25">Country</td>
        <td><input name="country" type="text" value="<?php echo $row['country']; ?>" tabindex="3" size="20" /></td>
      </tr>
      <tr>
        <td height="25">Nationality</td>
        <td><input name="nationality" type="text" value="<?php echo $row['Nationality']; ?>" tabindex="3" size="20" /></td>
      </tr>
          <tr>
			<td height="39">Title </td>
			<td><select name="lstTitle" id="lstTitle" tabindex="5">
			 <option <?php if($row['titleE']=='Ven.') echo "selected='selected'"; ?>>Ven.</option>
			  <option <?php if($row['titleE']=='Mr.') echo "selected='selected'"; ?>>Mr.</option>
			  <option <?php if($row['titleE']=='Ms.') echo "selected='selected'"; ?>>Ms.</option>
			</select></td>
		  </tr>

        <tr>
            <td height="49">Name </td>
            <td><label>
            <input type="text" name="txtNameE" id="txtNameE" value="<?php echo $row['nameEnglish']; ?>" tabindex="5" />
            </label></td>
          </tr>

          <tr>
			<td height="37"> Address - No</td>
			<td><label>
			  <input name="txtaddE1" type="text" value="<?php echo $row['addressEnglish1']; ?>" size="20" tabindex="8"   />
			</label></td>
		  </tr>
		  <tr>
			<td height="45"> <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Street </font></pre></td>
			<td><input name="txtaddE2" type="text" value="<?php echo $row['addressEnglish2']; ?>" size="40" tabindex="9"/></td>
		  </tr>
		  <tr>
			<td height="45"><pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Town</font></pre ></td>
			<td><input name="txtaddE3" type="text" value="<?php echo $row['addressEnglish3']; ?>" size="40" tabindex="10" /></td>
		  </tr>
      <tr>
        <td height="25" width="161">Mobile No</td>
        <td width="309"><input name="txtTelNo" type="text" value="<?php echo $row['telNo']; ?>" tabindex="2" size="20" /></td>
      </tr>
      <tr>
        <td height="25" width="161">Residence Telephone No</td>
        <td width="309"><input name="txtTelNo1" type="text" value="<?php echo $row['telNo1']; ?>" tabindex="2" size="20" /></td>
      </tr>
      <tr>
        <td height="25" width="161">WhatsApp No</td>
        <td width="309"><input name="txtTelNo2" type="text" value="<?php echo $row['telNo2']; ?>" tabindex="2" size="20" /></td>
      </tr>
      <tr>
        <td height="25">Email</td>
        <td><label>
          <input name="txtemail" type="text" value="<?php echo $row['email']; ?>" size="20" tabindex="19"   />
        </label></td>
      </tr>

      </tr>
    <td>Examination : </td>
    <td><input name="exam" type="text"  size="40" value="<?php echo $row['exam']; ?>" tabindex="15" /></td>
    </tr>
    <tr>
    	<td> Year : </td>
      <td><input name="year" type="text"  size="40" value="<?php echo $row['year']; ?>" tabindex="15" /></td>
    </tr>
    <tr>
    	<td>Index No: : </td>
      <td><input name="indexno" type="text"  size="40" value="<?php echo $row['indexNo']; ?>" tabindex="15" /></td>
    </tr>
<!--  -->
    <tr>
        <td height="25">Subject Results</td>
      </tr>
      <tr>
        <td height="25" colspan="2">

      <?php
			$queryfsub = "SELECT * FROM foreignsubjects  WHERE appNo = '$appNo'";
			$resultfsub = $db->executeQuery($queryfsub);
			
     
			  
			?>
      <table width="275" border="1" id="tblfsubjects">
      <tr>
      <!-- <td colspan="2"><table width="223" height="124" border="1" > -->
            <!-- <tr> -->
              <th width="150" scope="col">Subject Name</th>
              <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
          <!-- </tr> -->
    <!-- </td> -->
    </tr>
          <?php
           while($resultSet = $db->Next_Record($resultfsub))
           {
        $subject  = $resultSet["subject"];
        $result  = $resultSet["result"];
          ?>
<tr>
<td><input name="subject[]" type="text" id="subject" tabindex="10" size="15" value="<?php echo $subject; ?>"/>
    </td>
    <td><input name="result[]" type="text" id="result" tabindex="10" size="15" value="<?php echo $result; ?>"/>
    </td>
    </tr>
<?php
            }
            ?>
          
          
          </table>
    </td>
    </tr>
    <!--  -->

      <tr>
        <td height="25">Guardian Name </td>
        <td><label>
        <input name="txtNameGE" type="text" value="<?php echo $row['gnameE']; ?>" tabindex="5"  size="30"/>
        </label></td>
      </tr>
      <tr>
        <td height="25">Guardian Address - No</td>
        <td><label>
          <input name="txtaddGE1" type="text" size="20" value="<?php echo $row['gadde1']; ?>" tabindex="13"   />
        </label></td>
      </tr>
      <tr>
        <td height="25"> <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Street </font></pre></td>
        <td><input name="txtaddGE2" type="text"  size="40" value="<?php echo $row['gadde2']; ?>" tabindex="14"/></td>
      </tr>
      <tr>
        <td height="25"><pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Town</font></pre ></td>
        <td><input name="txtaddGE3" type="text"  size="40" value="<?php echo $row['gadde3']; ?>" tabindex="15" /></td>
      </tr>
      <tr>
        <td height="25"> Apllication Fee paid or not </td>
        <td>
          <select name="appFee" id="appFee" tabindex="14" >
            <option <?php if($row['appfee']=='Paid') echo "selected='selected'"; ?> >Paid</option>
            <option <?php if($row['appfee']=='Not Paid') echo "selected='selected'"; ?> > Not Paid</option>
              </select></td>
      </tr>
      <tr>
    <td height="35" colspan="2"><h3 style="font-weight:bold" align="left">Details about Residence place in Sri Lanka</h3></td>
    </tr>
    <tr>
        <td height="49">Guardian Name of the residence</td>
        <td><input name="residencegname" type="text"  size="40" value="<?php echo $row['gaNameR']; ?>" tabindex="15" /></td>
      </tr>
      <tr>
        <td height="37">Residence Address - No</td>
        <td><input name="residenceaddG1" type="text"  size="40" value="<?php echo $row['rsladde1']; ?>" tabindex="15" /></td>
      </tr>
      <tr>
        <td height="45"> <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2" >  Street </font></pre></td>
        <td><input name="residenceaddG2" type="text"  size="40" value="<?php echo $row['rsladde2']; ?>" tabindex="15" /></td>
      </tr>
      <tr>
        <td height="45"><pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2" >  Town </font></pre></td>
        <td><input name="residenceaddG3" type="text"  size="40" value="<?php echo $row['rsladde3']; ?>" tabindex="15" /></td>
      </tr>
      <tr>
        <td height="34">Residence guardian's Telephone No</td>
        <td><input name="residencegtelno" type="text"  size="40" value="<?php echo $row['RSLtelNo']; ?>" tabindex="15" /></td>
      </tr>
     
    </table> 
    <tr><td colspan="2"><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href='foreignApplicants.php';" class="button" />
          <input name="btnAdd" type="submit" value="Edit" class="button" >
    </td></tr>
    </form>
  <?php
//foreign applicant content
    }
  ?>
<script>
 function subjectFilter(strm_elementval)
    {
        document.getElementById("lstSub1").innerHTML = ""; 
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() 
        {
            if (this.readyState == 4 && this.status == 200) 
            {
              document.getElementById("lstSub1").innerHTML = this.responseText;
              document.getElementById("lstSub2").innerHTML = this.responseText;
              document.getElementById("lstSub3").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "subj_filter.php?subID="+strm_elementval, true);
        xhttp.send();
    }
    function subjectchecker(ddval)
    {
        var v1 = document.getElementById("lstSub1").value;
        var v2 = document.getElementById("lstSub2").value;
        var v3 = document.getElementById("lstSub3").value;
        
        if(ddval==1)
        {
           if(v1==v2 || v1==v3)
           {
               alert("This Subject is already Selected!");
               document.getElementById("lstSub1").value = 0;
           }
        }
        else if(ddval==2)
        {
           if(v2==v1 || v2==v3)
           {
               alert("This Subject is already Selected!");
               document.getElementById("lstSub2").value = 0;
           }
            
        }
        else if(ddval==3)
        {
           if(v3==v1 || v3==v2)
           {
               alert("This Subject is already Selected!");
               document.getElementById("lstSub3").value = 0;
           }
            
        }
        
    }
</script>



<?php
  }//elseifloop end
    //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Edit Applicant - Applicants - Student Management System - Buddhisht & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='applicant.php'>Applicants </a></li><li>Edit Applicant</li></ul>";
  //Apply the template
  include("master_registration.php");
?>