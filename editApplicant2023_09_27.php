<?php
  ob_start();
?>

<?php
	include("dbAccess.php");
    $db = new DBOperations();
	
	$appNo =  $db->cleanInput($_GET['appNo']);
	$appType =$db->cleanInput($_GET['appType']);

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
  $subCode1 = $db->cleanInput($_POST['lstSub1']); 
	$subCode2 = $db->cleanInput($_POST['lstSub2']); 
	$subCode3 = $db->cleanInput($_POST['lstSub3']); 
	
	$result1 = $_POST['lstResult1'];
	$result2 = $_POST['lstResult2'];
	$result3 = $_POST['lstResult3'];
  $code = $_POST['lstPali'];
		//print $code; 
  $paliresult = $db->cleanInput($_POST['txtPResult']);
		//print $paliresult;
    


  $query = "UPDATE localapplicant SET nameSinhala='$nameSinhala',addS1='$addressSinhala1',addS2='$addressSinhala2',addS3='$addressSinhala3',district='$district',
  telno='$telno',email='$email',guardianEname='$gnameEnglish',guardianSname='$gnameSinhala',guardianEadd1='$gaddressEnglish1',guardianEadd2='$gaddressEnglish2',
  guardianEadd3='$gaddressEnglish3',guardianSadd1='$gaddressSinhala1',guardianSadd2='$gaddressSinhala2',guardianSadd3='$gaddressSinhala3',appfee='$appFee',
  entryType='$entryType',alAdNo='$alAdNo',alYear='$alYear',zScore='$zScore',gkScore='$gkScore',nicNo='$nicNo',dob='$dob' WHERE appNo='$appNo'";
  $result =  $db->executeQuery($query);

  $delQuery = "DELETE FROM applicantsubjects WHERE appNo='$appNo'";
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

		}

 
	header("location:applicant.php");
	}

    /* $query = "SELECT * FROM applicant WHERE appNo='$appNo' AND appType='$appType'";
    $result = $db->executeQuery($query); 

    $query = "SELECT * FROM localapplicant WHERE appNo='$appNo'";
    $result = $db->executeQuery($query);  */

    //quering data
		$queryedit = "SELECT entryYear,titleE,nameEnglish,addressEnglish1,addressEnglish2,addressEnglish3,nameSinhala,addS1,addS2,addS3,district,telno,email,guardianEname,guardianSname,guardianEadd1,guardianEadd2,guardianEadd3,guardianSadd1,guardianSadd2,guardianSadd3,appfee,entryType,alAdNo,alYear,zScore,gkScore,nicNo,dob FROM applicant JOIN localapplicant ON applicant.appNo = localapplicant.appNo  WHERE applicant.appNo='$appNo' AND applicant.appType='$appType'";
		$resultedit = $db->executeQuery($queryedit);
    while ($row = $db->Next_Record($resultedit))
        {

    ?>

<h1>Edit Local Applicant Details</h1>
<form action="" method="post" >
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
        <td height="25">National ID </td>
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
        <td height="25"> Entry Type </td>
        <td>
          <select name="lstEntry" id="lstEntry" tabindex="14" >
            <option <?php if($row['entryType']=='Normal') echo "selected='selected'"; ?>>Normal</option>
            <option <?php if($row['entryType']=='Sanskrit') echo "selected='selected'"; ?>> Sanskrit</option>
              </select></td>
      </tr>
      <tr>
        <td height="25">A/L Admission No</td>
        <td><label>
          <input name="txtA_LAddmision" type="text" value="<?php echo $row['alAdNo']; ?>"  tabindex="15" size="20" />
        </label></td>
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
        <td height="25">Subject Results</td>
      </tr>

      <tr>
        <td height="25" colspan="2">

      <?php
			$queryAL = "SELECT * FROM applicantsubjects JOIN alsubjects ON applicantsubjects.subjectCode = alsubjects.subjectCode  WHERE appNo = '$appNo'";
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

         // for ($j=1;$j<=3;$j++) {
		 	$j=1;
            
           while($resultSet = $db->Next_Record($resultAL))
            {
			
		
              $rSubjectCode  = $resultSet["subjectCode"];
              $rSubject = $resultSet["subnameE"];
              $rresult = $resultSet["result"];
			
		

              echo "<tr><td><div id='Subject".$j."'> <select name='lstSub".$j."' id='lstSub".$j."' tabindex='20'>";
              
             //echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
              
          
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
				
				
             else {
		
			  echo "<option value=\"".$subCode."\">".$sub."</option>"; 
			 // echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
			 }
			
			 
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

            <?php  $j++ ;  }  ?>
				</table>
				  </td>
				  </tr>
				
          
            
        </table>    
        </td></tr>
          
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
  <form action="" method="post" >
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