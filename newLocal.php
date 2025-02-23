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
    function verifynic(value) {
        var val = document.getElementById("txtNic").value;
        if (val.match(/[V]/g) == "V" && val.charAt(9) == "V" && val.length == 10) {
            document.getElementById("txtNic").setCustomValidity("");
        }
        else if (val.match(/[V]/g) == null && val.length == 12) {
            document.getElementById("txtNic").setCustomValidity("");
        }
        else {
            console.log("wrong nic");
            //document.getElementById("txtNic").value = "";
            document.getElementById("txtNic").setCustomValidity("Invalid field");
        }
    }
</script>



<script>

function validate_form(thisform)
{
	with (thisform)
	  {
		if (!validate_required(txtAppNo) || !validate_required(txtID) || !validate_required(txtNameS) || !validate_required(txtNameE) || !validate_required(txtaddS1)|| !validate_required(txtaddS2) || !validate_required(txtaddS3) || !validate_required(txtaddE1) || !validate_required(txtaddE2)|| !validate_required(txtaddE3)|| !validate_required(txtA_LAddmision)|| !validate_required(txtZScore))
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
	require_once("dbAccess.php");
	$db = new DBOperations();
	
include("authcheck.inc.php");

if (isset($_POST['nikayaName'])) {
  $nikayaID = $db->cleanInput($_POST['nikayaName']);  

}
if (isset($_POST['txtAppNo'])) {
  $appNo = $db->cleanInput($_POST['txtAppNo']);
}

	if (isset($_POST['btnSubmit']))
	{

	
		$appNo = $db->cleanInput($_POST['txtAppNo']);
		//$nicNo = cleanInput($_POST['txtID']);
	
		$nicNo = $db->cleanInput($_POST['txtID']);
		$entryYear=$_POST['lstYearEntry'];
		$titleE = $_POST['lstTitleE'];
		//$nameSinhala = cleanInput($_POST['txtNameS']);
		$nameSinhala = $db->cleanInput($_POST['txtNameS']);
		//$nameEnglish = cleanInput($_POST['txtNameE']);
		$nameEnglish = $db->cleanInput($_POST['txtNameE']);
		//$addressSinhala1 = cleanInput($_POST['txtaddS1']);
		$addressSinhala1 = $db->cleanInput($_POST['txtaddS1']);
		//$addressSinhala2 = cleanInput($_POST['txtaddS2']);
		$addressSinhala2 = $db->cleanInput($_POST['txtaddS2']);
		$addressSinhala3 = $db->cleanInput($_POST['txtaddS3']); 
		$addressEnglish1 = $db->cleanInput($_POST['txtaddE1']);
		$addressEnglish2 = $db->cleanInput($_POST['txtaddE2']);
		$addressEnglish3 = $db->cleanInput($_POST['txtaddE3']);
		$district = $_POST['txtdistrict'];
    	$telno = $db->cleanInput($_POST['txtTelNo']);
		$appType = "Local";
		$entryType = $db->cleanInput($_POST['lstEntry']);
		$alAdNo = $db->cleanInput($_POST['txtA_LAddmision']);
		$alYear = $_POST['lstAlYear'];
		$zScore = $db->cleanInput($_POST['txtZScore']);
		$gkScore = $db->cleanInput($_POST['txtGKScore']);
		$subCode1 = $db->cleanInput($_POST['lstSub1']);
		$subCode2 = $db->cleanInput($_POST['lstSub2']);
		$subCode3 = $db->cleanInput($_POST['lstSub3']);
		$grade1= $db->cleanInput($_POST['lstResult1']);
		$grade2 = $db->cleanInput($_POST['lstResult2']);
		$grade3 = $db->cleanInput($_POST['lstResult3']);
   
		$code = $_POST['lstPali'];
		$paliresult = $db->cleanInput($_POST['txtPResult']);
		$gnameSinhala = $db->cleanInput($_POST['txtNameGS']);
		$gnameEnglish = $db->cleanInput($_POST['txtNameGE']);
		$gaddressSinhala1 = $db->cleanInput($_POST['txtaddGS1']);
		$gaddressSinhala2 = $db->cleanInput($_POST['txtaddGS2']);
		$gaddressSinhala3 = $db->cleanInput($_POST['txtaddGS3']); 
		$gaddressEnglish1 = $db->cleanInput($_POST['txtaddGE1']);
		$gaddressEnglish2 = $db->cleanInput($_POST['txtaddGE2']);
		$gaddressEnglish3 = $db->cleanInput($_POST['txtaddGE3']);
		$email = $db->cleanInput($_POST['txtemail']);
		$appFee = $db->cleanInput($_POST['appFee']);
		$applate = $db->cleanInput($_POST['applate']);
		$dob = $db->cleanInput($_POST['txtbd']);
    $chapterID = $db->cleanInput($_POST['chapterName']);
			/*
		/*$query1 = "INSERT INTO applicant SET appNo='$appNo', entryYear='$entryYear', titleE='$titleE', nameEnglish='$nameEnglish'   ,  addressEnglish1 = '$addressEnglish1', addressEnglish2 = '$addressEnglish2' , addressEnglish3 = '$addressEnglish3', appType = '$appType' ";
		//$result = executeQuery($query);
		//print $query1;
		
		
		$result = $db->executeQuery($query1);


    $query2 = " INSERT INTO localapplicant SET appNo = '$appNo' , nameSinhala='$nameSinhala', district = '$district', addS1 = '$addressSinhala1', addS2 = '$addressSinhala2', addS3 =' $addressSinhala3' , nicNo = '$nicNo' , entryType = '$entryType', alAdNo = '$alAdNo', alYear='$alYear', zScore='$zScore' , gkScore = '$gkScore' ,
    telno = '$telno', guardianEname = '$gnameEnglish', guardianSname = '$gnameSinhala', guardianEadd1 ='$gaddressEnglish1',   guardianEadd2 = '$gaddressEnglish2', guardianEadd3 ='$gaddressEnglish3', guardianSadd1 ='$gaddressSinhala1', guardianSadd2 = '$gaddressSinhala2', guardianSadd3 = '$gaddressSinhala3', email='$email',appfee='$appFee'";

		
		*/
		
		$query1 = "INSERT INTO applicant SET applicationNo='$appNo', entryYear='$entryYear', titleE='$titleE', nameEnglish='$nameEnglish'   ,  addressEnglish1 = '$addressEnglish1', addressEnglish2 = '$addressEnglish2' , addressEnglish3 = '$addressEnglish3', appType = '$appType'";
		//$result = executeQuery($query);
		
    $result1 = $db->executeQuery($query1);

    $var = $db->lastID();


		$query2 = "INSERT INTO localapplicant SET appNo = '$var' , nameSinhala='$nameSinhala', district = '$district',telno='$telno',
		addS1 = '$addressSinhala1', addS2 = '$addressSinhala2', addS3 =' $addressSinhala3' , nicNo = '$nicNo' , entryType = '$entryType', alAdNo = '$alAdNo', alYear='$alYear', zScore='$zScore' , gkScore = '$gkScore', guardianEname = '$gnameEnglish', guardianSname = '$gnameSinhala', guardianEadd1 ='$gaddressEnglish1',   guardianEadd2 = '$gaddressEnglish2', guardianEadd3 ='$gaddressEnglish3', guardianSadd1 ='$gaddressSinhala1', guardianSadd2 = '$gaddressSinhala2', guardianSadd3 = '$gaddressSinhala3', email='$email',appfee='$appFee',dob='$dob',lateApp='$applate',nikaya='$nikayaID',chapter='$chapterID' ";
		//$result = executeQuery($query);
		
   
		
		$query3 = " INSERT INTO applicantsubjects SET appNo = '$var' , subjectCode = '$subCode1', result = '$grade1' ";
    
		//$result = executeQuery($query);
		
		$query4 = " INSERT INTO applicantsubjects SET appNo = '$var' , subjectCode = '$subCode2', result = '$grade2' ";
		//$result = executeQuery($query);
		
		$query5 = " INSERT INTO applicantsubjects SET appNo = '$var' , subjectCode = '$subCode3' , result = '$grade3' ";

    			
		//$result = executeQuery($query);
		//============================ lakshani
	$result2 = $db->executeQuery($query2);
    $result3 = $db->executeQuery($query3);
    $result4 = $db->executeQuery($query4);
    $result5 = $db->executeQuery($query5);
	 if($code==''){
	 
	}
	else{
	
	$query6 = "INSERT INTO applicantpali SET appNo='$var', code='$code', result='$paliresult'";
	    $result6 = $db->executeQuery($query6);
		}

		/*
		$result3 = $db->executeQuery($query3);
		$result4 = $db->executeQuery($query4);
		$result5 = $db->executeQuery($query5); 
	*/
	header("location:applicant.php");
	}

$queryn = "SELECT DISTINCT nikayaName,nikayaID FROM nikaya";
  $nikayaNamesResult = $db->executeQuery($queryn);
    $nikayaNames = array();
    while ($row = $db->Next_Record($nikayaNamesResult)) {
      $nikayaNames[] = $row['nikayaName'];
    
  }
  /*$queryc = "SELECT DISTINCT chapter FROM chapter where ";
  $chapterNamesResult = $db->executeQuery($queryc);
    $chapteraNames = array();
    while ($row = $db->Next_Record($chapterNamesResult)) {
      $chapterNames[] = $row['chapterName'];
      
  }*/

?>
<form action="" method="post" name="localStudents" onsubmit="return validate_form(this);">
   
    <table class="searchResults">
      <tr>
        <td height="25">Applicant Type</td>
        <td><label>
           <select name="lstAppType" id="lstAppType"  onChange="change(this.value)" tabindex="1">
          <option value="LA">Local Applicant</option>
          <option value="FA">Foreign Applicant</option>  
              </select>
        </label></td>
      </tr>
      <tr>
        <td height="25" width="161">  Application No</td>
        <td width="309"><input name="txtAppNo" id="txtAppNo" type="text"  tabindex="2" size="20" /></td>
		</tr>
    <tr>
            <td height="28">Nikaya Name:</td>
            <td>
           
                <select name="nikayaName" id="nikayaName"  onChange="document.localStudents.submit()" required >
                
                
                
                <?php 
                     $queryn ="SELECT * FROM nikaya";
                     $resultn = $db->executeQuery($queryn);

                     while ($rown = $db->Next_Record($resultn)) { 
                      echo '<option value="' . $rown['nikayaID'] . '">' . $rown['nikayaID'] . ' - ' . $rown['nikayaName'] . '</option>';
                     }
                    
                    ?>
                    
                </select>
               
            </td>
        </tr>
        <script>
    document.getElementById("txtAppNo").value = "<?php echo $appNo ?>";
</script>
<script>
    document.getElementById("nikayaName").value = "<?php echo $nikayaID ?>";
</script>



        <tr>
            <td height="28">Chapter Name:</td>
            <td><?php $queryc ="SELECT * FROM `chapter` where `nikayaID`='$nikayaID'";?>
                <select name="chapterName"   >
               
                <?php 
                     $queryc ="SELECT * FROM `chapter` where `nikayaID`='$nikayaID'";
                     $resultc = $db->executeQuery($queryc);

                     while ($rown = $db->Next_Record($resultc)) { 
                      echo '<option value="' . $rown['chapterID'] . '">' . $rown['chapterID'] . ' - ' . $rown['chapter'] . '</option>';
                     }
                    
                    ?>
                    
                </select>
            </td>
        </tr>


      <tr>
        <td height="25">Year of Entry</td>
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
        <td height="25">National ID </td>
        <td> <input name="txtID" id="txtID" type="text" placeholder="123456789V or 123456789012" size="25"
                    oninput="this.value = this.value.replace(/[^0-9V]/g, '').replace(/(\..*)\./g, '$1'); verifynic(this.value);"
                    maxlength="12" required/></td>
       
      </tr>

      <tr>
        <td height="25">Date of Birth </td>
        <td><input name="txtbd" type="date"  tabindex="3" size="20" /></td>
      </tr>
      
      <tr>
        <td height="25">Title </td>
        <td><select name="lstTitleE" id="lstTitleE" tabindex="4"> 
          <option>Ven.</option>
          <option>Mr.</option>
          <option>Ms.</option>
          <option>Non</option>
        </select></td>
      </tr>
      <tr>
        <td height="25">Name </td>
        <td><label>
        <input name="txtNameE" type="text" tabindex="5"  size="30"/>
        </label></td>
      </tr>
      <tr>
        <td height="25"><p>&#3505;&#3512; <font/></font></font> </p></td>
        <td><label>
          <input name="txtNameS" type="text" tabindex="6"  size="50" />
        </label></td>
      </tr>
      <tr>
        <td height="25"> Address - No</td>
        <td><label>
          <input name="txtaddE1" type="text"  size="20" tabindex="7"   />
        </label></td>
      </tr>
      <tr>
        <td height="25"> <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Street </font></pre></td>
        <td><input name="txtaddE2" type="text"  size="40" tabindex="8"/></td>
      </tr>
      <tr>
        <td height="25"><pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Town</font></pre ></td>
        <td><input name="txtaddE3" type="text"  size="40" tabindex="9" /></td>
      </tr>
      <tr>
        <td height="25"><font face="KaputaUnicode" size="2" >&#3517;&#3538;&#3508;&#3538;&#3505;&#3514;-&#3461;&#3458;&#3482;&#3514; </td>
        <td><input name="txtaddS1" type="text"  size="20" tabindex="10" /></td>
      </tr>
      <tr>
        <td height="25"><font face="KaputaUnicode" size="2" ><pre>    &#3520;&#3539;&#3503;&#3538;&#3514;<pre/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input name="txtaddS2" type="text"  size="40" tabindex="11"/></td>
      </tr>
      <tr>
        <td height="25"><font face="KaputaUnicode" size="2" ><pre>    &#3505;&#3484;&#3515;&#3514;<pre/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input name="txtaddS3" type="text"  size="40" tabindex="12" /></td>
      </tr>
      <tr>
        <td height="25">Administrative District</td>
        <!-- &#3508;&#3515;&#3538;&#3508;&#3535;&#3517;&#3505; &#3503;&#3538;&#3523;&#3530;&#3501;&#3538;&#3482;&#3530;&#3482;&#3514;</td> -->
        
        <td><select name="txtdistrict" id="txtdistrict" tabindex="13">

        <?php
			$query = "SELECT * FROM stu_districts";
			$result = $db->executeQuery($query);
			while($resultSet = $db->Next_Record($result))
			{
				$id = $resultSet["id"];
				$district = $resultSet["districtEnglish"];
				echo "<option value=\"".$district."\">".$district."</option>";
        	} 
			?>
      </select></td>
      </tr>
      <tr>
        <td height="25" width="161">  Telephone No</td>
        <td width="309"><input name="txtTelNo" type="text"  tabindex="2" size="20" /></td>
      </tr>
      <tr>
        <td height="25">Email</td>
        <td><label>
          <input name="txtemail" type="text"  size="20" tabindex="19"   />
        </label></td>
      </tr>
      <tr>
        <td height="25">Guardian Name </td>
        <td><label>
        <input name="txtNameGE" type="text" tabindex="5"  size="30"/>
        </label></td>
      </tr>
      <tr>
        <td height="25"><p>&#3505;&#3512; <font/></font></font> </p></td>
        <td><label>
          <input name="txtNameGS" type="text" tabindex="6"  size="50" />
        </label></td>
      </tr>
      <tr>
        <td height="25">Guardian Address - No</td>
        <td><label>
          <input name="txtaddGE1" type="text" size="20" tabindex="13"   />
        </label></td>
      </tr>
      <tr>
        <td height="25"> <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Street </font></pre></td>
        <td><input name="txtaddGE2" type="text"  size="40" tabindex="14"/></td>
      </tr>
      <tr>
        <td height="25"><pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Town</font></pre ></td>
        <td><input name="txtaddGE3" type="text"  size="40" tabindex="15" /></td>
      </tr>
      <tr>
        <td height="25"><font face="KaputaUnicode" size="2" >&#3517;&#3538;&#3508;&#3538;&#3505;&#3514;-&#3461;&#3458;&#3482;&#3514; </td>
        <td><input name="txtaddGS1" type="text"  size="20" tabindex="16" /></td>
      </tr>
      <tr>
        <td height="25"><font face="KaputaUnicode" size="2" ><pre>    &#3520;&#3539;&#3503;&#3538;&#3514;<pre/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input name="txtaddGS2" type="text" size="40" tabindex="17"/></td>
      </tr>
      <tr>
        <td height="25"><font face="KaputaUnicode" size="2" ><pre>    &#3505;&#3484;&#3515;&#3514;<pre/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td><input name="txtaddGS3" type="text"  size="40" tabindex="18" /></td>
      </tr>
       
       
      <tr>
        <td height="25"> Apllication Fee paid or not </td>
        <td>
          <select name="appFee" id="appFee" tabindex="14" >
            <option value='y'>Paid</option>
            <option value='n'> Not Paid</option>
              </select></td>
      </tr>
      <tr>
        <td height="25"> Entry Type </td>
        <td>
          <select name="lstEntry" id="lstEntry" tabindex="14" >
            <option>Normal</option>
            <option> Sanskrit</option>
              </select></td>
      </tr>
      <tr>
        <td height="25">A/L Admission No</td>
        <td><label>
          <input name="txtA_LAddmision" type="text"  tabindex="15" size="20" />
        </label></td>
      </tr>
      <tr>
        <td height="25">A/L Year</td>
        <td><select name="lstAlYear" id="lstYear" tabindex="16">
	  <?php 
	  for ($i= 1990; $i<2100; $i++)
	  echo "<option value=\"".$i."\">".$i."</option>";
	   ?> 
      </select></td>
      </tr>
      <tr>
        <td height="25">Z-Score </td>
        <td><label>
          <input name="txtZScore" type="text"  tabindex="17" size="20" />
        </label></td>
      </tr>
      <tr>
        <td height="25">General Knowladge Score</td>
        <td><label>
          <input name="txtGKScore" type="text"  size="20" tabindex="18" />
        </label></td>
      </tr>
			<tr>
        <td height="25"> Late Applicant </td>
        <td>
          <select name="applate" id="applate" tabindex="14" >
            
            <option value='n'> No</option>
			  <option value='y'>Yes</option>
              </select></td>
      </tr>
    
      <!-- <tr>
        <td height="25" colspan="2"><input class="button" type="button" name="btnaddSub"  value="Add Subject" onclick="popup_show('popup', 'popup_drag', 'popup_exit', 'screen-center', 0,0);" tabindex="21"/>           </td>
      </tr> -->
      <tr>
        <td height="25">Subject Results</td>
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
         
          <?php for ($j=1;$j<=3;$j++) {
            
            echo "
                  <tr>
                    <td><div id='Subject".$j."'> <select name='lstSub".$j."' tabindex='20'>";
                    ?>
                    <option value='0'>- Select Subject- </option>
                    <?php
                    
            $query = "SELECT * FROM alsubjects";
            $result = $db->executeQuery($query);
            while($resultSet = $db->Next_Record($result))
            {
              $rSubjectCode  = $resultSet["subjectCode"];
                    $rSubject = $resultSet["subnameE"];
                   
                    echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
                } ?>
            
                    </select></div> </td>
            <?php  
                    echo " <td>
                   <select name= 'lstResult".$j."' tabindex='21'>"; ?>
                        <option>-Grade-</option>
                        <option value="A">A</option>
                        <option  value="B">B</option>
                        <option  value="C">C</option>
                        <option  value="S">S</option>
                        <option  value="F">F</option>
                                      </select>
                    </td>
                    </tr>
            <?php   }?>
          
         
        </table>          </td>
      </tr>
          
           </table>           </td>
        </tr>
      
      <!-- <tr>
        <td height="46" colspan="2">
        <input type="button" name="btnAddRow" id="btnAddRow" value="Add Row" tabindex="24" onclick="addRowList('tblpali')" class="button"/>&nbsp;&nbsp;        
          <input type="button" name="btndeleteRow" id="btndeleteRow" value="Delete Row" tabindex="23" onclick="deleteRow('tblpali')" align="left" class="button"/>          </td>
       </tr> -->

       <tr>
        <td height="46"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Pali Qualification</font></td>	
      </tr>
      <tr>
        <td height="46" colspan="2">
        <table width="275" border="1" id="tblpali">
          <tr>
            <!-- <th width="25" scope="col">&nbsp;</th> -->
            <th width="130" scope="col">Subject</th>
            <th width="98" scope="col">Result</th>
          </tr>
          <tr>
            <!-- <td><input type="checkbox" name="chk[]" id="chk" /></td> -->
            <td><select name="lstPali" id="lstPali" tabindex="22">
			<option selected></option>
              <?php
			$query7 = "SELECT * FROM paliqualification";
			$result7 = $db->executeQuery($query7);
			while($resultSet = $db->Next_Record($result7))
			{
				$PaliCode = $resultSet["code"];
				$Qualification = $resultSet["qualification"];
				echo "<option value=\"".$PaliCode."\">".$Qualification."</option>";
        	} 
			?>
             </select></td>
            <td><input name="txtPResult" type="text" id="txtPResult" tabindex="23"  size="5" /></td>
            </tr>
           </table>           </td>
        </tr>
      <!-- <tr>
        <td height="46" colspan="2">
        <input type="button" name="btnAddRow" id="btnAddRow" value="Add Row" tabindex="24" onclick="addRowList('tblpali')" class="button"/>&nbsp;&nbsp;        
          <input type="button" name="btndeleteRow" id="btndeleteRow" value="Delete Row" tabindex="23" onclick="deleteRow('tblpali')" align="left" class="button"/></td>
       </tr> -->
      <tr>
        <td height="46" colspan="2"><div align="center">
        <input name="btnCancel" type="button" value="Cancel" class="button" tabindex="25" onclick="document.location.href='applicant.php';"/>&nbsp;&nbsp;<input type="submit" name="btnSubmit" id="btnSubmit" value="Submit" tabindex="26" class="button" />
        </div></td>
      </tr>
    </table>
</form> 




<!--PopupForm-->



<?php
    //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "New Local Applicant - Applicants - Student Management System - Buddhisht & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='applicant.php'>Applicants </a></li><li>New Local Applicant</ul>";
  //Apply the template
  include("master_registration.php");
?>

