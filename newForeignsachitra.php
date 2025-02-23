<?php
  ob_start();
?>
<script language="javascript" src="addRow_list.js"></script>
<script type="text/javascript" src="lib/pop-up/popup-window.js"></script>
<link href="lib/pop-up/sample.css" rel="stylesheet" type="text/css" />

<script language="javascript">
function validate_form(thisform)
{
	with (thisform)
	  {
		if (!validate_required(txtAppNo) || !validate_required(lstYearEntry) || !validate_required(txtName) || !validate_required(txtadd1)|| !validate_required(txtadd2) || !validate_required(txtadd3) || !validate_required(txtppNo) ||!validate_required(txtCountry))
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
</script>
<h1> New Foreign Applicant </h1>
<?php
	 require_once("dbAccess.php");
   $db = new DBOperations();
   include("authcheck.inc.php");
	//if (isset($_SESSION['admin'])){
	if (isset($_POST['btnSubmit']))
	{
		$appNo = cleanInput($_POST['txtAppNo']);
		$entryYear=$_POST['lstYearEntry'];
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
		$subject = cleanInput($_POST['txtsubjects']);
		$grade = cleanInput($_POST['txtgrade']);
	  $Nationality = cleanInput($_POST['txtNationality']);
    $telNo = cleanInput($_POST['txttelNo']);
    $email = cleanInput($_POST['txtEmail']);
    $guardianname = cleanInput($_POST['txtNameG']);
    $guardianaddressEnglish1 = cleanInput($_POST['txtaddg1']);
		$guardianaddressEnglish2 = cleanInput($_POST['txtaddg2']);
		$guardianaddressEnglish3 = cleanInput($_POST['txtaddg3']);
    $residenceguardianname = cleanInput($_POST['txtNameGR']);
    $residenceaddressEnglish1 = cleanInput($_POST['txtaddgr1']);
		$residenceaddressEnglish2 = cleanInput($_POST['txtaddgr2']);
		$residenceaddressEnglish3 = cleanInput($_POST['txtaddgr3']);
    $residencetelNo = cleanInput($_POST['txttelNoR']);
		
		$query = "INSERT INTO applicant SET appNo='$appNo', entryYear='$entryYear', titleE='$title', nameEnglish='$name'  ,  addressEnglish1 = '$addressEnglish1', addressEnglish2 = '$addressEnglish2' , addressEnglish3 = '$addressEnglish3', appType = '$appType' ";
		$result = $db->executeQuery($query);
		
		/* $query = "INSERT INTO foreignapplicant SET appNo='$appNo', ppNo='$ppNo', country='$country' , exam = '$exam', indexNo = '$indexNo' , paliQf = '$paliQf' ,
    Nationality = ' $Nationality', 	telNo = '$telNo', email = ' $email', gnameE = '$guardianname', gadde1 = '$guardianaddressEnglish1', gadde2 = '$guardianaddressEnglish2', 
    gadde3='$guardianaddressEnglish3', gaNameR='$residenceguardianname', rsladde1=' $residenceaddressEnglish1', rsladde2='$residenceaddressEnglish2', rsladde3='$residenceaddressEnglish3', 	RSLtelNo ='$residencetelNo'";
		$result = executeQuery($query);		
		
		foreach($_POST['txtsubjects'] as $a => $sub)
               {			   		
					$query = "INSERT INTO foreignsubjects SET appNo='$appNo', subject='$subject[$a]', result='$grade[$a]'";
					$result = executeQuery($query);	 
			   } */
	
	
	
		/*foreach($_POST['txtsubjects'] as $a => $sub)
		   {
			echo "$subject[$a]- $grade[$a] <br/>" ;
			$query = "INSERT INTO foreignsubjects SET appNo='$appNo', subject='$subject[$a]', result='$grade[$a]'";
			$result = executeQuery($query);	 
				
		   }
			   //header("location:message.php?message=Successfully inserted!"); 
			 
	/*foreach ($_POST['txtgrade'] as $val)
              {
			   		$result[] = $val;
					print_r($result);
					echo "<br/>";
					
               }	
	/*for ($i=0; $i<= count($sub); $i++)
	{
		$query = "INSERT INTO foreignsubjects SET appNo='$appNo', subject='$subject[$i]', result='$result[$i]'";
		$result = executeQuery($query);	 	   
	
	
	}	
	header("location:message.php?message=Successfully inserted!"); */
	header("location:applicant.php");	
	}
?>


<form action="" method="post" onsubmit="return validate_form(this);" >
<table border="0" bordercolorlight="#E2E2E2" class="searchResults">
<tr>
        <td height="48">Applicant Type</td>
        <td><label>
          <select name="lstAppType" id="lstAppType" onchange="change(this.value)" tabindex="1">
            <option value="FA">Foreign Applicant</option>
            <option value="LA">Local Applicant</option>
                    </select>
        </label></td>
      </tr>
      <tr>
        <td width="169" height="48"> Application No</td>
        <td width="234"><input name="txtAppNo" type="text" id="txtAppNo" tabindex="2" size="20" /></td>
    </tr>
      <tr>
        <td height="39">Year of Entry</td>
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
        <td height="39">Title <font/></td>
        <td><select name="lstTitle" id="lstTitle" tabindex="4">
          <option>Ven.</option>
          <option>Mr.</option>
          <option>Ms.</option>
        </select></td>
      </tr>
      <tr>
        <td height="49">Name </td>
        <td><input name="txtName" type="text" tabindex="5" size="30"/></td>
      </tr>
      <tr>
        <td height="37">Permanent Address - No</td>
        <td><label>
          <input name="txtadd1" type="text" id="txtadd1" size="20" tabindex="6"  />
        </label></td>
      </tr>
      <tr>
        <td height="45"> <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2" >  Street </font></pre></td>
        <td><input name="txtadd2" type="text" id="txtadd2" size="30" tabindex="7" /></td>
      </tr>
      <tr>
        <td height="45"><pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2" >  Town </font></pre></td>
        <td><input name="txtadd3" type="text" id="txtadd3" size="30" tabindex="8"/></td>
      </tr>
      
      <tr>
        <td height="34">Passport Number/ NIC</td>
        <td><input name="txtppNo" type="text" id="txtppNo" tabindex="9" size="20"/></td>
      </tr>
      <!-- 2021.05.04 --><tr>
        <td height="34">Country </td>
        <td><input name="txtCountry" type="text" id="txtCountry" tabindex="10" size="20"/></td>
      </tr>
      <tr>
        <td height="34">Nationality </td>
        <td><input name="txtNationality" type="text" id="txtNationality" tabindex="10" size="20"/></td>
      </tr> 
      <tr>
        <td height="34">Telephone No</td>
        <td><input name="txttelNo" type="text" id="txttelNo" tabindex="9" size="20"/></td>
      </tr>
      <tr>
        <td height="49">Email </td>
        <td><input name="txtEmail" type="text" tabindex="5" size="30"/></td>
      </tr>
      <tr>
        <td height="49">Guardian Name </td>
        <td><input name="txtNameG" type="text" tabindex="5" size="30"/></td>
      </tr>
      <tr>
        <td height="37">Guardian Permanent Address - No</td>
        <td><label>
          <input name="txtaddg1" type="text" id="txtaddg1" size="20" tabindex="6"  />
        </label></td>
      </tr>
      <tr>
        <td height="45"> <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2" >  Street </font></pre></td>
        <td><input name="txtaddg2" type="text" id="txtaddg2" size="30" tabindex="7" /></td>
      </tr>
      <tr>
        <td height="45"><pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2" >  Town </font></pre></td>
        <td><input name="txtaddg3" type="text" id="txtaddg3" size="30" tabindex="8"/></td>
      </tr>


      
  </table>
  <table border="0" bordercolor="#EAEAEA" class="searchResults">
  <tr>
    <td height="35" colspan="2"><h3 style="font-weight:bold" align="left">Details about Residence place in Sri Lanka</h3></td>
    </tr>
    <tr>
        <td height="49">Guardian Name of the residence</td>
        <td><input name="txtNameGR" type="text" tabindex="5" size="30"/></td>
      </tr>
      <tr>
        <td height="37">Residence Address - No</td>
        <td><label>
          <input name="txtaddgr1" type="text" id="txtaddgr1" size="20" tabindex="6"  />
        </label></td>
      </tr>
      <tr>
        <td height="45"> <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2" >  Street </font></pre></td>
        <td><input name="txtaddgr2" type="text" id="txtaddgr2" size="30" tabindex="7" /></td>
      </tr>
      <tr>
        <td height="45"><pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2" >  Town </font></pre></td>
        <td><input name="txtaddgr3" type="text" id="txtaddgr3" size="30" tabindex="8"/></td>
      </tr>
      <tr>
        <td height="34">Residence guardian's Telephone No</td>
        <td><input name="txttelNoR" type="text" id="txttelNoR" tabindex="9" size="20"/></td>
      </tr>

  <!-- 2021.05.04 -->

</table>
<br/>
<table border="0" bordercolor="#EAEAEA" class="searchResults">
  <tr>
    <td height="35" colspan="2"><h3 style="font-weight:bold" align="left">Educational Qualifications</h3></td>
    </tr>
  <tr>
    <td width="169" height="30">Examination </td>
    <td width="234"><label>
      <input name="txtExam" type="text" id="txtExam" size="30" tabindex="11"/>
    </label></td>
  </tr>
  <tr>
    <td height="34">Index No</td>
    <td><label>
      <input name="txtIndex" type="text" id="txtIndex" size="20" tabindex="12" />
    </label></td>
  </tr>
  <tr>
    <td height="35">Year &amp; Month</td>
    <td><label>
      <select name="lstYear" id="lstYear" tabindex="13">
	  <?php 
	  for ($i= 1990; $i<2100; $i++)
	  echo "<option value=\"".$i."\">".$i."</option>";
	   ?> 
      </select>
    Year 
    <select name="lstMonth" size="1" id="lstMonth" tabindex="14">
      <option>January</option>
      <option>February</option>
      <option>March</option>
      <option>April</option>
      <option>May</option>
      <option>June</option>
      <option>July</option>
      <option>August</option>
      <option>September</option>
      <option>October</option>
      <option>November</option>
      <option>December</option>
    </select>
    Month</label>  </tr>
  <tr>
    <td height="69" colspan="2"><table width="290" border="1" id="tblsubjects">
      <tr>
        <th width="26">&nbsp;</th>
        <th width="145">Subjects</th>
        <th width="97">Mark or Grade</th>
      </tr>
      <tr>
        <td><input type="checkbox" name="checkbox[]" id="checkbox"></td>
        <td><input type="text" name="txtsubjects[]" id="txtsubjects" tabindex="15"></td>
        <td><input name="txtgrade[]" type="text" id="txtgrade" size="15" tabindex="16"></td>
      </tr>
    </table></td>
    </tr>
  <tr>
    <td height="47" colspan="2">
    <input type="button" name="btnaddRow" id="btnaddRow" value="Add Row" onclick="addRowList('tblsubjects')" align="left" class="button" tabindex="17"/>&nbsp;&nbsp;<input type="button" name="btndeleteRow" id="btndeleteRow" value="Delete Row" onclick="deleteRow('tblsubjects')" align="left" class="button" tabindex="18"/>    </td>
    </tr>
</table>
<table border="0" class="searchResults">
  <tr>
    <td width="169">Pali Qualification(Pali language/Buddhist Studies)</td>
    <td width="234"><label>
      <input name="txtPali" type="text" id="txtPali" size="30" tabindex="19" />
    </label></td>
  </tr>
  <tr>
    <td height="39" colspan="2"><input name="btnCancel" type="button" value="Cancel" class="button" tabindex="20" onclick="document.location.href='applicant.php';" />&nbsp;&nbsp;<input type="submit" name="btnSubmit" id="btnSubmit" value="Submit" align="middle" tabindex="21" class="button"/>
    </td>
    </tr>
</table>
</form>
<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Foreign Applicant - Applicants - Student Management System - Buddhisht & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='applicant.php'>Applicants </a></li><li>New Foreign Applicant</ul>";
  //Apply the template
  include("master_registration.php");
?>


