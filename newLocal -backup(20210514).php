<?php
  ob_start();
?>

<script language="javascript" src="addRow_list.js"></script>
<script type="text/javascript" src="lib/pop-up/popup-window.js"></script>
<link href="lib/pop-up/sample.css" rel="stylesheet" type="text/css" />
<script language="javascript">
var xmlhttp;

function addSubject(code,subject)
{
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
	  alert ("Browser does not support HTTP Request");
	  return;
	}
	var url="addsub.php";
	url=url+"?code="+code+"&subject="+subject;
	url=url+"&sid="+Math.random();
	xmlhttp.onreadystatechange=stateChanged;
	xmlhttp.open("GET",url,true);
	xmlhttp.send(null);
}

function stateChanged()
{
	if (xmlhttp.readyState==4)
	{
		document.getElementById("Subject1").innerHTML=xmlhttp.responseText;
		document.getElementById("Subject2").innerHTML=xmlhttp.responseText;
		document.getElementById("Subject3").innerHTML=xmlhttp.responseText;
		
	}
}

function GetXmlHttpObject()
{
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  return new XMLHttpRequest();
  }
if (window.ActiveXObject)
  {
  // code for IE6, IE5
  return new ActiveXObject("Microsoft.XMLHTTP");
  }
return null;
}


</script>



<script>

function validate_form(thisform)
{
	with (thisform)
	  {
		if (!validate_required(txtAppNo) || !validate_required(txtID) || !validate_required(txtNameE) ||  !validate_required(txtaddE1) || !validate_required(txtaddE2)|| !validate_required(txtaddE3)|| !validate_required(txtA/LAddmision)|| !validate_required(txtZScore))
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
		if (!validate_required(txtsubjectCode) ||!validate_required(txtCode) || !validate_required(txtSubject))
		{alert("One or more mandatory fields are kept blank.");return false;}
	  }
}
		

</script>
<h1> New Local Applicant </h1>
<?php
	include("dbAccess.php");
	include("authcheck.inc.php");

   

	if (isset($_POST['btnSubmit']))
	{
		$appNo = cleanInput($_POST['txtAppNo']);
		$nicNo = cleanInput($_POST['txtID']);
		$entryYear=$_POST['lstYearEntry'];
		$titleE = $_POST['lstTitleE'];
		$nameSinhala = cleanInput($_POST['txtNameS']);
		$nameEnglish = cleanInput($_POST['txtNameE']);
		$addressSinhala1 = cleanInput($_POST['txtaddS1']);
		$addressSinhala2 = cleanInput($_POST['txtaddS2']);
		$addressSinhala3 = cleanInput($_POST['txtaddS3']); 
		$addressEnglish1 = cleanInput($_POST['txtaddE1']);
		$addressEnglish2 = cleanInput($_POST['txtaddE2']);
		$addressEnglish3 = cleanInput($_POST['txtaddE3']);
                $contactNo = cleanInput($_POST['txtcontact']);
		$district = cleanInput($_POST['txtdistrict']);
		$appType = "Local";
		$entryType = $_POST['lstEntry'];
		$alAdNo = cleanInput($_POST['txtA/LAddmision']);
		$alYear = $_POST['lstAlYear'];
		$zScore = cleanInput($_POST['txtZScore']);
		$gkScore = cleanInput($_POST['txtGKScore']);
		$subCode1 = $_POST['lstSub1'];
		$subCode2 = $_POST['lstSub2'];
		$subCode3 = $_POST['lstSub3'];
		$result1 = $_POST['lstResult1'];
		$result2 = $_POST['lstResult2'];
		$result3 = $_POST['lstResult3'];
		$code = $_POST['lstPali'];
		$paliresult = $_POST['txtPResult'];
                
			
		$query1 = "INSERT INTO applicant SET appNo='$appNo', entryYear='$entryYear', titleE='$titleE', nameEnglish='$nameEnglish'   ,  addressEnglish1 = '$addressEnglish1', addressEnglish2 = '$addressEnglish2' , addressEnglish3 = '$addressEnglish3', appType = '$appType', contactNo = '$contactNo' ";
		//$result = executeQuery($query);
		
		
		$query2 = " INSERT INTO localapplicant SET appNo = '$appNo' , nameSinhala='$nameSinhala', district = '$district',
		addS1 = '$addressSinhala1', addS2 = '$addressSinhala2', addS3 =' $addressSinhala3' , nicNo = '$nicNo' , entryType = '$entryType', alAdNo = '$alAdNo', alYear='$alYear', zScore='$zScore' , gkScore = '$gkScore' ";
		//$result = executeQuery($query);
		
		
		$query3 = " INSERT INTO applicantsubjects SET appNo = '$appNo' , subjectCode = '$subCode1', result = '$result1' ";
		//$result = executeQuery($query);
		
		$query4 = " INSERT INTO applicantsubjects SET appNo = '$appNo' , subjectCode = '$subCode2', result = '$result2' ";
		//$result = executeQuery($query);
		
		$query5 = " INSERT INTO applicantsubjects SET appNo = '$appNo' , subjectCode = '$subCode3' , result = '$result3' ";
		//$result = executeQuery($query);
		
		$quaries = array($query1,$query2,$query3,$query4,$query5);
		$result = executeTransaction($quaries);
		
		foreach($_POST['lstPali'] as $a => $sub)
               {			   		
					$query = "INSERT INTO applicantpali SET appNo='$appNo', code='$code[$a]', result='$paliresult[$a]'";
					$result = executeQuery($query);	 
			   }
		header("location:applicant.php");
	}
	 if (isset($_POST['btnAdd']))
	 {
	 	$subjectCode = cleanInput($_POST['txtsubjectCode']);
	 	$subnameE = cleanInput($_POST['txtsubnameE']);
		$subnameS = cleanInput($_POST['txtsubnameS']);
				
		$query = "INSERT INTO alSubjects SET subjectCode='$subjectCode', subnameE = '$subnameE' , subnameS = '$subnameS'";
		$result = executeQuery($query); 
	 }	
	

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
        <td width="309"><input name="txtAppNo" type="text" value="<?php if (isset($_POST['txtAppNo'])) echo $_POST['txtAppNo']; ?>" tabindex="2" size="20" /></td>
      </tr>
      <tr>
        <td height="48">Year of Entry</td>
        <td><label>
          <select name="lstYearEntry" id="lstYearEntry" tabindex="3">
          <?php 
	  for ($i= 1990; $i<2100; $i++)
	  echo "<option value=\"".$i."\">".$i."</option>";
	   ?>
          </select>
        </label></td>
      </tr>
      <tr>
        <td height="48">National ID </td>
        <td><input name="txtID" type="text" value= "<?php if (isset($_POST['txtID'])) echo $_POST['txtID']; ?>" tabindex="3" size="20" /></td>
      </tr>

      
      
      <tr>
        <td height="39">Title </td>
        <td><select name="lstTitleE" id="lstTitleE" tabindex="4"> 
          <option>Ven.</option>
          <option>Mr.</option>
          <option>Ms.</option>
        </select></td>
      </tr>
      <tr>
        <td height="49">Name </td>
        <td><label>
        <input name="txtNameE" type="text" tabindex="5" value="<?php if (isset($_POST['txtNameE'])) echo $_POST['txtNameE']; ?>" size="30"/>
        </label></td>
      </tr>
      <tr>
        <td height="45"><p>&#3505;&#3512; <font/></font></font> </p></td>
        <td><label>
          <input name="txtNameS" type="text" tabindex="6" value="<?php if (isset($_POST['txtNameS'])) echo $_POST['txtNameS']; ?>" size="50" />
        </label></td>
      </tr>
      <tr>
        <td height="37"> Address - No</td>
        <td><label>
          <input name="txtaddE1" type="text" value="<?php if (isset($_POST['txtaddE1'])) echo $_POST['txtaddE1']; ?>" size="20" tabindex="7"   />
        </label></td>
      </tr>
      <tr>
        <td height="45"> <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Street </font></pre></td>
        <td><input name="txtaddE2" type="text" value="<?php if (isset($_POST['txtaddE2'])) echo $_POST['txtaddE2']; ?>" size="40" tabindex="8"/></td>
      </tr>
      <tr>
        <td height="45"><pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Town</font></pre ></td>
        <td><input name="txtaddE3" type="text" value="<?php if (isset($_POST['txtaddE3'])) echo $_POST['txtaddE3']; ?>" size="40" tabindex="9" /></td>
      </tr>
      <tr>
        <td height="50"><font face="KaputaUnicode" size="2" >&#3517;&#3538;&#3508;&#3538;&#3505;&#3514;-&#3461;&#3458;&#3482;&#3514; </td>
        <td><input name="txtaddS1" type="text" value="<?php if (isset($_POST['txtaddS1'])) echo $_POST['txtaddS1']; ?>" size="20" tabindex="10" /></td>
      </tr>
      <tr>
        <td height="48"><font face="KaputaUnicode" size="2" ><pre>    &#3520;&#3539;&#3503;&#3538;&#3514;<pre/><font/></td>
        <td><input name="txtaddS2" type="text" value="<?php if (isset($_POST['txtaddS2'])) echo $_POST['txtaddS2']; ?>" size="40" tabindex="11"/></td>
      </tr>
      <tr>
        <td height="44"><font face="KaputaUnicode" size="2" ><pre>    &#3505;&#3484;&#3515;&#3514;<pre/><font/></td>
        <td><input name="txtaddS3" type="text" value="<?php if (isset($_POST['txtaddS3'])) echo $_POST['txtaddS3']; ?>" size="40" tabindex="12" /></td>
      </tr>
      <tr>
        <td height="45"><pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Contact No.</font></pre ></td>
        <td><input name="txtcontact" type="text" value="<?php if (isset($_POST['txtcontact'])) echo $_POST['txtcontact']; ?>" size="20" tabindex="13" /></td>
      </tr>
      <tr>
        <td height="44">&#3508;&#3515;&#3538;&#3508;&#3535;&#3517;&#3505; &#3503;&#3538;&#3523;&#3530;&#3501;&#3538;&#3482;&#3530;&#3482;&#3514;</td>
        <td><input name="txtdistrict" type="text" value="<?php if (isset($_POST['txtdistrict'])) echo $_POST['txtdistrict']; ?>" size="40" tabindex="14" /></td>
      </tr>

      
      <tr>
        <td height="48">Date of Birth</td>
        <td><label for="birthday">Birthday:</label>
        <input type="date" id="birthday" name="birthday"></td>
      </tr>

      <tr>
        <td height="44"> Entry Type </td>
        <td>
          <select name="lstEntry" id="lstEntry" tabindex="15" >
            <option>Normal</option>
            <option> Sanskrit</option>
              </select></td>
      </tr>
      <tr>
        <td height="34">A/L Admission No</td>
        <td><label>
          <input name="txtA/LAddmision" type="text" value="<?php if (isset($_POST['txtA/LAddmision'])) echo $_POST['txtA/LAddmision']; ?>" tabindex="16" size="20" />
        </label></td>
      </tr>
      <tr>
        <td height="26">A/L Year</td>
        <td><select name="lstAlYear" id="lstYear" tabindex="17">
	  <?php 
	  for ($i= 1990; $i<2100; $i++)
	  echo "<option value=\"".$i."\">".$i."</option>";
	   ?> 
      </select></td>
      </tr>
      <tr>
        <td height="26">Z-Score </td>
        <td><label>
          <input name="txtZScore" type="text" value="<?php if (isset($_POST['txtZScore'])) echo $_POST['txtZScore']; ?>" tabindex="18" size="18" />
        </label></td>
      </tr>
      <tr>
        <td height="64">General Knowladge Score</td>
        <td><label>
          <input name="txtGKScore" type="text" value="<?php if (isset($_POST['txtGKScore'])) echo $_POST['txtGKScore']; ?>" size="20" tabindex="19" />
        </label></td>
      </tr>
      <tr>
        <td colspan="2"><table width="223" height="124" border="1" >
            <tr>
              <th width="150" scope="col">Subject Name</th>
              <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
          </tr>
          <?php for ($j=1;$j<=3;$j++){
			echo "
            <tr>
              <td><div id='Subject".$j."'> <select name='lstSub".$j."' tabindex='20'>";
              
			$query = "SELECT * FROM alsubjects";
			$result = executeQuery($query);
			for ($i=0;$i<mysql_numrows($result);$i++)
			{
				$rSubjectCode = mysql_result($result,$i,"subjectCode");
				$rSubject = mysql_result($result,$i,"subnameE");
				echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
        	} ?>
			
              </select></div> </td>
			<?php  
              echo " <td>
             <select name= 'lstResult".$j."'tabindex='21'>"; ?>
                  <option>A</option>
                  <option>B</option>
                  <option>C</option>
                  <option>S</option>
                  <option>F</option>
                                </select>
              </td>
              </tr>
			<?php   }?>
         
        </table>          </td>
      </tr>
      <tr>
        <td height="38" colspan="2"><input class="button" type="button" name="btnaddSub"  value="Add Subject" onclick="popup_show('popup', 'popup_drag', 'popup_exit', 'screen-center', 0,0);" tabindex="21"/>           </td>
      </tr>
      <tr>
        <td height="46"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Pali Qualification</font></td>	
      </tr>
      <tr>
        <td height="46" colspan="2">
        <table width="275" border="1" id="tblpali">
          <tr>
            <th width="25" scope="col">&nbsp;</th>
            <th width="130" scope="col">Subject</th>
            <th width="98" scope="col">Result</th>
          </tr>
          <tr>
            <td><input type="checkbox" name="chk[]" id="chk" /></td>
            <td><select name="lstPali[]" id="lstPali" tabindex="22">
              <?php
			$query = "SELECT * FROM paliqualification";
			$result = executeQuery($query);
			for ($i=0;$i<mysql_numrows($result);$i++)
			{
				$PaliCode = mysql_result($result,$i,"code");
				$Qualification = mysql_result($result,$i,"qualification");
				echo "<option value=\"".$PaliCode."\">".$Qualification."</option>";
        	} 
			?>
             </select></td>
            <td><input name="txtPResult[]" type="text" id="txtPResult" tabindex="23" value="<?php if (isset($_POST['txtPResult'])) echo $_POST['txtPResult']; ?>"size="15" /></td>
            </tr>
           </table>           </td>
        </tr>
      <tr>
        <td height="46" colspan="2">
        <input type="button" name="btnAddRow" id="btnAddRow" value="Add Row" tabindex="24" onclick="addRowList('tblpali')" class="button"/>&nbsp;&nbsp;        <!-- <input type="button" name="btnDelete" id="btnDelete" value="Delete Row" onclick="deleteRow('test')" />-->
          <input type="button" name="btndeleteRow" id="btndeleteRow" value="Delete Row" tabindex="23" onclick="deleteRow('tblpali')" align="left" class="button"/></td>
       </tr>
       
       <tr>
        <td height="49">Name of Ven.Teacher/Guardian </td>
        <td><label>
        <input name="txtGuardian" type="text" tabindex="5" value="<?php if (isset($_POST['txtGuardian'])) echo $_POST['txtGuardian']; ?>" size="30"/>
        </label></td>
      </tr>

      <tr>
        <td height="37"> Address of Ven. Teacher/Guardian - No</td>
        <td><label>
          <input name="txtaddE1" type="text" value="<?php if (isset($_POST['txtaddE1'])) echo $_POST['txtaddE1']; ?>" size="20" tabindex="7"   />
        </label></td>
      </tr>
      <tr>
        <td height="45"> <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Street </font></pre></td>
        <td><input name="txtaddE2" type="text" value="<?php if (isset($_POST['txtaddE2'])) echo $_POST['txtaddE2']; ?>" size="40" tabindex="8"/></td>
      </tr>
      <tr>
        <td height="45"><pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Town</font></pre ></td>
        <td><input name="txtaddE3" type="text" value="<?php if (isset($_POST['txtaddE3'])) echo $_POST['txtaddE3']; ?>" size="40" tabindex="9" /></td>
      </tr>
      
       <tr>
        <td height="44"> Application Fee </td>
        <td>
          <select name="lstEntry" id="lstEntry" tabindex="15" >
            <option>Paid</option>
            <option> Not Paid</option>
              </select></td>
      </tr>

       <tr>
        <td height="49">Email </td>
        <td><label>
        <input name="txtEmail" type="text" tabindex="5" value="<?php if (isset($_POST['txtEmail'])) echo $_POST['txtEmail']; ?>" size="30"/>
        </label></td>
      </tr>



      <tr>
        <td height="46" colspan="2"><div align="center">
        <input name="btnCancel" type="button" value="Cancel" class="button" tabindex="25" onclick="document.location.href='applicant.php';"/>&nbsp;&nbsp;<input type="submit" name="btnSubmit" id="btnSubmit" value="Submit" tabindex="26" class="button" />
        </div></td>
      </tr>
    </table>
</form> 




<!--PopupForm-->
<div class="sample_popup" id="popup" style="display: none;">
    
    <div class="menu_form_header" id="popup_drag">
    	<img class="menu_form_exit"   id="popup_exit" src="lib/pop-up/form_exit.png" alt="" />
    	&nbsp;&nbsp;&nbsp;Add Subject
    </div>
    
    <div class="menu_form_body">
    	<form action="" method="post" onsubmit="return validateSubjects(this);">
    		<table>
            	<tr><th>Subject Code:</th><td><input class="field" type="text"     onfocus="select();" name="txtsubjectCode" /></td></tr>
      			<tr><th>Name in English:</th><td><input class="field" type="text"     onfocus="select();" name="txtsubnameE" /></td></tr>
      			<tr><th>Name in Sinhala:</th><td><input class="field" type="text" onfocus="select();" name="txtsubnameS" /></td></tr>
      			<tr><th>         </th><td><input class="btn"   type="submit"   value="Submit" name="btnAdd"/></td></tr>
    		</table>
    	</form>
    </div>

</div>


<?php
    //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "New Local Applicant - Applicants - Student Management System - Buddhisht & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='applicant.php'>Applicants </a></li><li>New Local Applicant</ul>";
  //Apply the template
  include("master_registration.php");
?>

