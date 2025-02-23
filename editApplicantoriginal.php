<?php
  ob_start();
?>


<?php
	include("dbAccess.php");
	include("authcheck.inc.php");
	
	$appNo = cleanInput($_GET['appNo']);
	$appType = $_GET['appType'];
	
	if($appType=="Local")
	{
	
	?>
	<script language="javascript" src="addRow_list.js"></script>
    <script type="text/javascript" src="lib/pop-up/popup-window.js"></script>
    <link href="lib/pop-up/sample.css" rel="stylesheet" type="text/css" />
    <script>
    
    function validate_form(thisform)
    {
        with (thisform)
          {
            if (!validate_required(txtAppNo) || !validate_required(txtID) || !validate_required(txtNameS) || !validate_required(txtNameE) || !validate_required(txtaddS1)|| !validate_required(txtaddS2) || !validate_required(txtaddS3) || !validate_required(txtaddE1) || !validate_required(txtaddE2)|| !validate_required(txtaddE3)|| !validate_required(txtA/LAddmision)|| !validate_required(txtZScore))
            {alert("One or more mandatory fields are kept blank.");return false;}
          }
    }


	function change(value){
	
	if (value=="LA"){
	
	window.location = 'newLocal.php';
	}
	else if (value=="FA"){
	window.location = 'newForeign.php';
	}
	}
	function validateSubjects(frm)
	{
		with(frm)
		{ 
			if (!validate_required(txtCode) || !validate_required(txtSubject))
			{alert("One or more mandatory fields are kept blank.");return false;}
		  }
	}
		

    </script>
	<h1>Edit Applicant</h1>
	<?php
		if (isset($_POST['btnSubmit']))
		{
			$appNo = cleanInput($_POST['txtAppNo']);
			$nicNo = cleanInput($_POST['txtID']);
			$entryYear= $_POST['lstYearEntry'];
			$titleE = $_POST['lstTitle'];
			$nameSinhala = cleanInput($_POST['txtNameS']);
			$nameEnglish = cleanInput($_POST['txtNameE']);
			$addressSinhala1 =cleanInput($_POST['txtaddS1']);
			$addressSinhala2 = cleanInput($_POST['txtaddS2']);
			$addressSinhala3 = cleanInput($_POST['txtaddS3']); 
			$addressEnglish1 = cleanInput($_POST['txtaddE1']);
			$addressEnglish2 = cleanInput($_POST['txtaddE2']);
			$addressEnglish3 = cleanInput($_POST['txtaddE3']);
			$district = cleanInput($_POST['txtdistrict']);
			$appType = "Local";
			$entryType = $_POST['lstEntry'];
			$alAdNo = cleanInput($_POST['txtA/LAddmision']);
			$alYear = $_POST['lstAlYear'];
			$zScore = cleanInput($_POST['txtZScore']);
			$gkScore = cleanInput($_POST['txtGKScore']);
			$subCode1 = $_POST['lstSub0'];
			$subCode2 = $_POST['lstSub1'];
			$subCode3 = $_POST['lstSub2'];
			$result1 = $_POST['lstResult0'];
			$result2 = $_POST['lstResult1'];
			$result3 = $_POST['lstResult2'];
			$code = $_POST['lstPali'];
			$paliresult = cleanInput($_POST['txtPResult']);
			
				
			$query = "UPDATE Applicant SET entryYear='$entryYear', titleE='$titleE', nameEnglish='$nameEnglish'  ,  addressEnglish1 = '$addressEnglish1', addressEnglish2 = '$addressEnglish2' , addressEnglish3 = '$addressEnglish3', appType = '$appType' WHERE appNo='$appNo' ";
			$result = executeQuery($query);
						
			$query = "UPDATE LocalApplicant SET nameSinhala='$nameSinhala', addS1 = '$addressSinhala1', addS2 = '$addressSinhala2', addS3 =' $addressSinhala3',district = '$district', nicNo = '$nicNo' , entryType = '$entryType', alAdNo = '$alAdNo', alYear='$alYear', zScore='$zScore' , gkScore = '$gkScore' WHERE appNo='$appNo'";
			$result = executeQuery($query);
					
			$delQuery = "DELETE FROM applicantsubjects WHERE appNo='$appNo'";
			$result = executeQuery($delQuery);
			
			$query = " INSERT INTO applicantsubjects SET appNo = '$appNo' , subjectCode = '$subCode1', result = '$result1' ";
			$result = executeQuery($query);
			
			$query = " INSERT INTO applicantsubjects SET appNo = '$appNo' , subjectCode = '$subCode2', result = '$result2' ";
			$result = executeQuery($query);
			
			$query = " INSERT INTO applicantsubjects SET appNo = '$appNo' , subjectCode = '$subCode3' , result = '$result3' ";
			$result = executeQuery($query);
			
			$querydel2= "DELETE FROM applicantpali WHERE appNo = '$appNo'";
			$resultdel2 = executeQuery($querydel2);
			
			foreach($_POST['lstPali'] as $a => $sub)
				   {			   		
						$query = "INSERT INTO applicantpali SET appNo='$appNo', code='$code[$a]', result='$paliresult[$a]'";
						$result = executeQuery($query);	 
				   }
			
			header("location:applicant.php");
		}
		 if (isset($_POST['btnAdd']))
		 {
		 
			$subcode = cleanInput($_POST['txtsubnameE']);
			$alSubject= cleanInput($_POST['txtsubnameS']);
			
			
			$query = " INSERT INTO alSubjects SET subjectCode = '$subcode' , subject = '$alSubject' ";
			$result = executeQuery($query); 
		 }	
		 
		//quering data
		$queryedit = "SELECT applicant.appNo,appType,district,titleE,nameEnglish,addressEnglish1,addressEnglish2, addressEnglish3,entryYear, nameSinhala, addS1, addS2, addS3,nicNo, entryType, alAdNo,alYear, zScore, gkScore FROM applicant JOIN localapplicant ON localapplicant.appNo = applicant.appNo WHERE applicant.appNo='$appNo'";
		$resultedit = executeQuery($queryedit);
		$row = mysql_fetch_array($resultedit);
		
		if (mysql_num_rows($resultedit)>0)
		{
		
	
	?>
	<form action="" method="post" name="localStudents" onsubmit="return validate_form(this);">
	   
		<table class="searchResults">
		  <tr>
			<td height="48">Applicant Type</td>
			<td><label>
			   <select name="lstAppType" id="lstAppType"  onChange="change(this.value)" tabindex="1">
			  <option value="LA">Local Applicant</option>
			  <option value="FA">Foreign Applicant</option>  
				  </select>
			</label></td>
		  </tr>
		  <tr>
			<td height="48" width="161">  Application No</td>
			<td width="309"><input name="txtAppNo" type="text" value="<?php echo $row['appNo']; ?>" readonly="readonly" tabindex="2" size="20" /></td>
		  </tr>
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
			<td height="48">National ID </td>
			<td><input name="txtID" type="text" value="<?php echo $row['nicNo']; ?>" tabindex="4" size="20" /></td>
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
			<input name="txtNameE" type="text" tabindex="6" value="<?php echo $row['nameEnglish']; ?>" size="30"/>
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
			<td height="48"><font face="KaputaUnicode" size="2" ><pre>    &#3520;&#3539;&#3503;&#3538;&#3514;<pre/><font/></td>
			<td><input name="txtaddS2" type="text" value="<?php echo $row['addS2']; ?>" size="40" tabindex="12"/></td>
		  </tr>
		  <tr>
			<td height="44"><font face="KaputaUnicode" size="2" ><pre>    &#3505;&#3484;&#3515;&#3514;<pre/><font/></td>
			<td><input name="txtaddS3" type="text" value="<?php echo $row['addS3']; ?>" size="40" tabindex="13" /></td>
		  </tr>
          <tr>
			<td height="44"><font face="KaputaUnicode" size="2" >&#3508;&#3515;&#3538;&#3508;&#3535;&#3517;&#3505; &#3503;&#3538;&#3523;&#3530;&#3501;&#3538;&#3482;&#3530;&#3482;&#3514;<font/></td>
			<td><input name="txtdistrict" type="text" value="<?php echo $row['district']; ?>" size="40" tabindex="13" /></td>
		  </tr>
		  <tr>
			<td height="44"> Entry Type </td>
			<td>
			  <select name="lstEntry" id="lstEntry" tabindex="14" >
				<option <?php if($row['entryType']=='Normal') echo "selected='selected'"; ?>>Normal</option>
				<option <?php if($row['entryType']=='Sanskrit') echo "selected='selected'"; ?>> Sanskrit</option>
				  </select></td>
		  </tr>
		  <tr>
			<td height="34">A/L Admission No</td>
			<td><label>
			  <input name="txtA/LAddmision" type="text" value="<?php echo $row['alAdNo']; ?>" tabindex="15" size="20" />
			</label></td>
		  </tr>
		  <tr>
		    <td height="26">A/L Year</td>
		    <td><label><select name="lstAlYear" id="lstYear" tabindex="16">
		  <?php 
	  		for ($i= 1990; $i<2100; $i++){
                  if ($row['alYear']==$i)
                      echo "<option selected='selected' value=\"".$i."\">".$i."</option>";
                      else echo "<option value=\"".$i."\">".$i."</option>";
                 }
          ?>
	         </select></label></td>
	      </tr>
		  <tr>
			<td height="26">Z-Score </td>
			<td><label>
			  <input name="txtZScore" type="text" value="<?php echo $row['zScore']; ?>" tabindex="17" size="20" />
			</label></td>
		  </tr>
		  <tr>
			<td height="64">General Knowladge Score</td>
			<td><label>
			  <input name="txtGKScore" type="text" value="<?php echo $row['gkScore']; ?>" size="20" tabindex="18" />
			</label></td>
		  </tr>
		  <tr>
			<td colspan="2">
			<?php
			$queryAL = "SELECT * FROM applicantsubjects JOIN alsubjects ON applicantsubjects.subjectcode = alsubjects.subjectcode  WHERE appNo = '$appNo'";
			$resultAL = executeQuery($queryAL);
			?>
			<table width='223' height='124' border='1' >
			 <tr>
			 <th width='150' scope='col'>Subject Name</th>
			 <th width='57' bgcolor='#FFFFFF' scope='col'>Result</th>
			 </tr>
			 <?php
				$query = "SELECT * FROM alsubjects";
				$result = executeQuery($query);
				for ($j=0;$j<3;$j++)
				{
				$rsubCode = mysql_result($resultAL,$j,"subjectcode");
				$rResult = mysql_result($resultAL,$j,"result");						
				echo "<tr><td><div id='Subject".$j."'> <select name='lstSub".$j."'tabindex='19' >";
				
					for ($i=0;$i<mysql_numrows($result);$i++)
					{
						$subCode = mysql_result($result,$i,"subjectCode");
						$sub = mysql_result($result,$i,"subnameE");
						if ($rsubCode==$subCode)
							echo "<option selected='selected' value=\"".$subCode."\">".$sub."</option>";
						else echo "<option value=\"".$subCode."\">".$sub."</option>";
					} ?>
					</select><div></td>
					<?php echo " <td>
				 <select name= 'lstResult".$j."'tabindex='19' >"; ?>
					<option <?php if($rResult=='A') echo "selected='selected'";?>>A</option>
					<option <?php if($rResult=='B') echo "selected='selected'";?>>B</option>
					<option <?php if($rResult=='C') echo "selected='selected'";?>>C</option>
					<option <?php if($rResult=='S') echo "selected='selected'";?>>S</option>
					<option <?php if($rResult=='F') echo"selected='selected'";?>>F</option>
				</select></td></tr>
				<?php	
				}?>
				</table>
				  </td>
				  </tr>
				<?php   }?>
			 
		   </td>
		  </tr>
		  <tr>
			<td height="38" colspan="2"><input class="button" type="button" name="btnaddSub"  value="Add Subject" tabindex="20" onclick="popup_show('popup', 'popup_drag', 'popup_exit', 'screen-center', 0,0);"/>           </td>
		  </tr>
		  <tr>
			<td height="46"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Pali Qualification</font></td>	
		  </tr>
		  <tr>
			<td height="46" colspan="2">
			<?php
			$queryPali = "SELECT * FROM applicantpali JOIN paliqualification ON applicantpali.code = paliqualification.code WHERE appNo='$appNo'"; 
			$resultPali= executeQuery($queryPali);
			$query = "SELECT * FROM paliqualification";
			$result = executeQuery($query);
			?>
            	<table width='275' border='1' id='tblpali'>
				<tr>
				<th width="25" scope="col">&nbsp;</th>
				<th width="130" scope="col">Subject</th>
				<th width="98" scope="col">Result</th>
			  </tr>
			  
			  <tr>          
				<td><input type="checkbox" name="chk[]" id="chk" /></td>
				<td><select name="lstPali[]" id="lstPali">
				  <?php
			if (mysql_num_rows($resultPali)>0)
			{				 		
				 while ($rowPali = mysql_fetch_array($resultPali))
				{						
					for ($i=0;$i<mysql_numrows($result);$i++)
					{
						$PaliCode = mysql_result($result,$i,"code");
						$Qualification = mysql_result($result,$i,"qualification");
						if($rowPali['code']==$PaliCode)
							echo "<option selected='selected' value=\"".$PaliCode."\">".$Qualification."</option>";
						else echo "<option value=\"".$PaliCode."\">".$Qualification."</option>";
					} 
				?>
				 </select></td>
				<td><input name="txtPResult[]" type="text" id="txtPResult" tabindex="10" size="15" value="<?php echo $rowPali['result']; ?>" /></td>
				</tr>
				<?php
				} 
				
			
			}
			else 
			{
			for ($i=0;$i<mysql_numrows($result);$i++)
					{
						$PaliCode = mysql_result($result,$i,"code");
						$Qualification = mysql_result($result,$i,"qualification");
						echo "<option value=\"".$PaliCode."\">".$Qualification."</option>";
					} 
			?>
             </select></td>
			<td><input name="txtPResult[]" type="text" id="txtPResult" tabindex="10" size="15"/></td>
			</tr>
			<?php
			} 
			?>  
            </table> 
			   
			  </td>
			</tr>
		  <tr>
			<td height="46" colspan="2">
			<input type="button" name="btnAddRow" id="btnAddRow" value="Add Row" onclick="addRowList('tblpali')" class="button"/>
			 <!-- <input type="button" name="btnDelete" id="btnDelete" value="Delete Row" onclick="deleteRow('test')" />-->
			  <input type="button" name="btndeleteRow" id="btndeleteRow" value="Delete Row" onclick="deleteRow('tblpali')" align="left" class="button"/>          </td>
			<input id="rowCount" name="rowCount" type="hidden" value="" /> 
		  </tr>
		  <tr>
			<td height="46" colspan="2" align="center">
			<input name="btnCancel" type="button" value="Cancel" class="buttton" onclick="document.location.href='applicant.php';" />  <input type="submit" name="btnSubmit" id="btnSubmit" value="Submit" class="button" />			</td>
		  </tr>
		</table>
    </form> 
	
	
	<div class="sample_popup" id="popup" style="display: none;">
		
		<div class="menu_form_header" id="popup_drag">
			<img class="menu_form_exit"   id="popup_exit" src="lib/pop-up/form_exit.png" alt="" />
			&nbsp;&nbsp;&nbsp;Add Subject
		</div>
		
		<div class="menu_form_body">
			<form action="" method="post" onsubmit="return validateSubjects(this);">
				<table>
					<tr><th>Name in English:</th><td><input class="field" type="text"     onfocus="select();" name="txtsubnameE" /></td></tr>
					<tr><th>Name in Sinhala:</th><td><input class="field" type="text" onfocus="select();" name="txtsubnameS" /></td></tr>
					<tr><th>         </th><td><input class="btn"   type="submit"   value="Submit" name="btnAdd" /></td></tr>
				</table>
			</form>
		</div>
	
	</div>
	
	<?php
	}
elseif($appType=="Foreign")
	{
	?>
<script language="javascript" src="addRow_list.js"></script>

<script language="javascript">
 function change(value){

if (value=="LA"){

window.location = 'newLocal.php';
}
else if (value=="FA"){
window.location = 'newForeign.php';
}
}

</script>
<h1> Foreign Applicant Details</h1>
<?php
	if (isset($_POST['btnSubmit']))
	{
		$appNo = cleanInput($_POST['txtAppNo']);
		$nicNo = cleanInput($_POST['txtppNo']);
		$title = $_POST['lstTitle'];
		$name = cleanInput($_POST['txtName']);
		$addressEnglish1 = cleanInput($_POST['txtadd1']);
		$addressEnglish2 = cleanInput($_POST['txtadd2']);
		$addressEnglish3 = cleanInput($_POST['txtadd3']);
		$appType = "Foreign";
		$ppNo = cleanInput($_POST['txtppNo']);
		$country = cleanInput($_POST['txtCountry']);
		$exam = cleanInput($_POST['txtExam']);
		$indexNo = cleanInput($_POST['txtIndex']);
		$year = $_POST['lstYear'];
		$month = $_POST['lstMonth'];
		$paliQf = cleanInput($_POST['txtPali']);
		$rowCount = $_POST['rowCount'];
		$subject = cleanInput($_POST['txtsubjects']);
		$grade = cleanInput($_POST['txtgrade']);
	
		
		$query = "UPDATE Applicant SET titleE='$title', nameEnglish='$name'  ,  addressEnglish1 = '$addressEnglish1', addressEnglish2 = '$addressEnglish2' , addressEnglish3 = '$addressEnglish3', appType = '$appType' WHERE appNo='$appNo' ";
		$result = executeQuery($query);
		
		$query = "UPDATE foreignapplicant SET ppNo='$ppNo', country='$country' , exam = '$exam', year='$year', month='$month', indexNo = '$indexNo' , paliQf = '$paliQf' where appNo='$appNo' ";
		$result = executeQuery($query);	
		
		$delQuery = "DELETE FROM foreignsubjects WHERE appNo='$appNo'";
		$result = executeQuery($delQuery);
	
		foreach($_POST['txtsubjects'] as $a => $sub)
               {
			   	if(!($subject[$a]=="")||!($grade[$a]==""))
					{
			   		$query = "INSERT INTO foreignsubjects SET appNo='$appNo', subject='$subject[$a]', result='$grade[$a]'";
					$result = executeQuery($query);	 
					}
               }
			header("location:applicant.php");   
	}
	
	
	//Loading from DB
	
	$query = "SELECT applicant.appNo,appType,titleE,nameEnglish,addressEnglish1,addressEnglish2, addressEnglish3,entryYear, ppNo, country,exam,indexNo,year,month,paliQf FROM applicant JOIN foreignapplicant ON foreignapplicant.appNo = applicant.appNo WHERE applicant.appNo='$appNo'";
	
	$result = executeQuery($query);
	$row = mysql_fetch_array($result);
		
	if (mysql_num_rows($result)>0)
	{		
?>


    <form action="" method="post" >
    <table border="0" bordercolorlight="#E2E2E2" class="searchResults">
    <tr>
            <td height="48">Applicant Type</td>
            <td><label>
              <select name="lstAppType" id="lstAppType" onchange="change(this.value)" tabindex="1">
              <?php
                    if ($row['appType']=="Foreign")
                    {
                        echo " <option selected='selected' value='FA'>Foreign Applicant</option>";
                        echo "<option value='LA'>Local Applicant</option>";
                    }
                    else
                    {
                        echo "<option selected='selected' value='LA'>Local Applicant</option>";
                        echo "<option value='FA'>Foreign Applicant</option>";
                    }
                ?>
                </select>
            </label></td>
          </tr>
          <tr>
            <td width="169" height="48"> Application No</td>
            <td width="234"><input name="txtAppNo" type="text" id="txtAppNo" tabindex="2" value="<?php echo $row['appNo']; ?>"/></td>
        </tr>
          <tr>
            <td height="39">Year of Entry</td>
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
            <td height="39">Title <font/></td>
            <td><select name="lstTitle" id="lstTitle" tabindex="4">
            <?php
                switch($row['titleE'])
                {
                case 'Ven.':
                    {echo" <option selected='selected'>Ven.</option>";
                    echo"<option>Mr.</option><option>Ms.</option>";}
                    break;
                case 'Mr.':
                    {echo" <option selected='selected'>Mr.</option>";
                    echo"<option>Ven.</option><option>Ms.</option>";}
                    break;
                case 'Ms.':
                    {echo" <option selected='selected'>Ms.</option>";
                    echo"<option>Ven.</option><option>Mr.</option>";}
                    break;
                default:
                    echo"Error";
                }			
            ?>
            </select></td>
          </tr>
          <tr>
            <td height="49">Name </td>
            <td><label>
            <input type="text" name="txtName" id="txtName" value="<?php echo $row['nameEnglish']; ?>" tabindex="5" />
            </label></td>
          </tr>
          <tr>
            <td height="37"> Address - No</td>
            <td><label>
              <input name="txtadd1" type="text" id="txtadd1" size="20" tabindex="6" value="<?php echo $row['addressEnglish1']; ?>"  />
            </label></td>
          </tr>
          <tr>
            <td height="45"> <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2" >  Street </font></pre></td>
            <td><input name="txtadd2" type="text" id="txtadd2" size="30" tabindex="7" value="<?php echo $row['addressEnglish2']; ?>" /></td>
          </tr>
          <tr>
            <td height="45"><pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2" >  Town </font></pre></td>
            <td><input name="txtadd3" type="text" id="txtadd3" size="30" tabindex="8" value="<?php echo $row['addressEnglish3']; ?>"/></td>
          </tr>
          
          <tr>
            <td height="34">Passport Number/ NIC</td>
            <td><input name="txtppNo" type="text" id="txtppNo" tabindex="9" size="20" value="<?php echo $row['ppNo']; ?>" /></td>
          </tr>
          <tr>
            <td height="34">Country </td>
            <td><input name="txtCountry" type="text" id="txtCountry3" tabindex="10" size="20" value="<?php echo $row['country']; ?>" /></td>
          </tr>
      </table>
    <label></label>
          <label><br />
          </label>
    <table border="0" bordercolor="#EAEAEA" class="searchResults">
      <tr>
        <td height="35" colspan="2"><h3 style="font-weight:bold" align="left">Educational Qualifications</h3></td>
        </tr>
      <tr>
        <td width="169" height="30">Examination </td>
        <td width="234"><label>
          <input name="txtExam" type="text" id="txtExam" size="30" tabindex="11" value="<?php echo $row['exam']; ?>"/>
        </label></td>
      </tr>
      <tr>
        <td height="34">Index No</td>
        <td><label>
          <input name="txtIndex" type="text" id="txtIndex" size="20" tabindex="12" value="<?php echo $row['indexNo']; ?>" />
        </label></td>
      </tr>
      <tr>
        <td height="35">Year &amp; Month</td>
        <td><label> Year
          <select name="lstYear" id="lstYear" tabindex="13">
          <?php 
          for ($i= 1990; $i<2100; $i++)
            {
              if($row['year']==$i)
                 echo "<option selected='selected' value=\"".$i."\">".$i."</option>";
                 else echo "<option value=\"".$i."\">".$i."</option>";
            }
           ?> 
          </select>
        Month
        <select name="lstMonth" size="1" id="lstMonth" tabindex="14">
          <option <?php if($row['month']=='January') echo "selected='selected'"; ?>>January</option>
          <option <?php if($row['month']=='February') echo "selected='selected'"; ?>>February</option>
          <option <?php if($row['month']=='March') echo "selected='selected'"; ?>>March</option>
          <option <?php if($row['month']=='April') echo "selected='selected'"; ?>>April</option>
          <option <?php if($row['month']=='May') echo "selected='selected'"; ?>>May</option>
          <option <?php if($row['month']=='June') echo "selected='selected'"; ?>>June</option>
          <option <?php if($row['month']=='July') echo "selected='selected'"; ?>>July</option>
          <option <?php if($row['month']=='August') echo "selected='selected'"; ?>>August</option>
          <option <?php if($row['month']=='September') echo "selected='selected'"; ?>>September</option>
          <option <?php if($row['month']=='October') echo "selected='selected'"; ?>>October</option>
          <option <?php if($row['month']=='November') echo "selected='selected'"; ?>>November</option>
          <option <?php if($row['month']=='December') echo "selected='selected'"; ?>>December</option>
        </select>
        </label>  </tr>
      <tr>
        <td height="69" colspan="2">
          <?php
            $query2 = "SELECT * FROM foreignsubjects WHERE appNo = '$appNo'";
            $result2 = executeQuery($query2);
            
            if (mysql_num_rows($result2)>0)
            {
            echo" <table width='290' border='1' id='tblsubjects'>
            <tr>
            <th width='26'>&nbsp;</th>
            <th width='145'>Subjects</th>
            <th width='97'>Mark or Grade</th>
            </tr>";
              while ($row2 = mysql_fetch_array($result2))
              { 
              echo"<tr><td><input type='checkbox' name='checkbox[]' id='checkbox'></td>
              <td><input type='text' name='txtsubjects[]' id='txtsubjects' value=".$row2['subject']." tabindex='15'></td>
              <td><input name='txtgrade[]' type='text' id='txtgrade' size='15' value=".$row2['result']." tabindex='15'></td></tr>";
              }
             echo"</table>";
           	 }
			 else{
			  ?>
			  <table width="290" border="1" id="tblsubjects">
		  	<tr>
			<th width="26">&nbsp;</th>
			<th width="145">Subjects</th>
			<th width="97">Mark or Grade</th>
		  	</tr>
		  	<tr>
			<td><input type="checkbox" name="checkbox[]" id="checkbox"></td>
			<td><input type="text" name="txtsubjects[]" id="txtsubjects" tabindex="16"></td>
			<td><input name="txtgrade[]" type="text" id="txtgrade" size="15" tabindex="17"></td>
		  	</tr>
			</table>
		<?php
		}
		?>
        </td>
        </tr>
      <tr>
        <td height="47" colspan="2">
        <input type="button" name="btnaddRow" id="btnaddRow" value="Add Row" onclick="addRowList('tblsubjects')" align="left" class="button" tabindex="18"/>
              <input type="button" name="btndeleteRow" id="btndeleteRow" value="Delete Row" onclick="deleteRow('tblsubjects')" on align="left" class="button" tabindex="19"/>    </td>
        </tr>
    </table>
    <table border="0" class="searchResults">
      <tr>
        <td width="169">Pali Qualification</td>
        <td width="234"><label>
          <input name="txtPali" type="text" id="txtPali" size="30" value="<?php echo $row['paliQf']; ?>" tabindex="20" />
        </label></td>
      </tr>
      <tr>
        <td height="39" colspan="2">
        <input name="btnCancel" type="button" value="Cancel" class="button" onclick="document.location.href='applicant.php';" tabindex="21" />
          <input type="submit" name="btnSubmit" id="btnSubmit" value="Submit" align="middle" class="button" tabindex="22"/>
        </td>
        </tr>
    </table>
    
    
   </form>


<?php
}
}
    //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Edit Applicant - Applicants - Student Management System - Buddhisht & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='applicant.php'>Applicants </a></li><li>Edit Applicant</li></ul>";
  //Apply the template
  include("master_registration.php");
?>

