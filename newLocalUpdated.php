<?php
ob_start();
?>

<script language="javascript" src="addRow_list.js"></script>
<script type="text/javascript" src="lib/pop-up/popup-window.js"></script>
<link href="lib/pop-up/sample.css" rel="stylesheet" type="text/css" />
<script language="javascript">
  var xmlhttp;

  function addSubject(code, subject) {
    xmlhttp = GetXmlHttpObject();
    if (xmlhttp == null) {
      alert("Browser does not support HTTP Request");
      return;
    }
    var url = "addsub.php";
    url = url + "?code=" + code + "&subject=" + subject;
    url = url + "&sid=" + Math.random();
    xmlhttp.onreadystatechange = stateChanged;
    xmlhttp.open("GET", url, true);
    xmlhttp.send(null);
  }

  function stateChanged() {
    if (xmlhttp.readyState == 4) {
      document.getElementById("Subject1").innerHTML = xmlhttp.responseText;
      document.getElementById("Subject2").innerHTML = xmlhttp.responseText;
      document.getElementById("Subject3").innerHTML = xmlhttp.responseText;

    }
  }



  function GetXmlHttpObject() {
    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      return new XMLHttpRequest();
    }
    if (window.ActiveXObject) {
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
    } else if (val.match(/[V]/g) == null && val.length == 12) {
      document.getElementById("txtNic").setCustomValidity("");
    } else {
      console.log("wrong nic");
      //document.getElementById("txtNic").value = "";
      document.getElementById("txtNic").setCustomValidity("Invalid field");
    }
  }
</script>



<script>
  function validate_form(thisform) {
    with(thisform) {
      if (!validate_required(txtAppNo) || !validate_required(txtID) || !validate_required(txtNameS) || !validate_required(txtNameE) || !validate_required(txtaddS1) || !validate_required(txtaddS2) || !validate_required(txtaddS3) || !validate_required(txtaddE1) || !validate_required(txtaddE2) || !validate_required(txtaddE3)) {
        alert("One or more fields are kept blank.");
        return false;
      }
    }
  }


  function change(value) {

    if (value == "LA") {

      window.location = 'newLocalUpdated.php';
    } else if (value == "FA") {
      window.location = 'newForeign.php';
    }
  }

  function validateSubjects(frm) {
    with(frm) {
      if (!validate_required(txtsubjectCode) || !validate_required(txtCode) || !validate_required(txtSubject)) {
        alert("One or more mandatory fields are kept blank.");
        return false;
      }
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

if (isset($_POST['btnSubmit'])) {


  $appNo = $db->cleanInput($_POST['txtAppNo']);
  //$nicNo = cleanInput($_POST['txtID']);

  $nicNo = $db->cleanInput($_POST['txtID']);
  $entryYear = $_POST['lstYearEntry'];
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
  $stream = $db->cleanInput($_POST['txtstream']);







  $zScore = $db->cleanInput($_POST['txtZScore']);
  $gkScore = $db->cleanInput($_POST['txtGKScore']);
  $subCode11 = $db->cleanInput($_POST['lstSub1']);
  $subCode21 = $db->cleanInput($_POST['lstSub2']);
  $subCode31 = $db->cleanInput($_POST['lstSub3']);
  $grade11 = $db->cleanInput($_POST['lstResult1']);
  $grade21 = $db->cleanInput($_POST['lstResult2']);
  $grade31 = $db->cleanInput($_POST['lstResult3']);
  //============================================================================

  $subCode12 = $db->cleanInput($_POST['2stSub1']);
  $subCode22 = $db->cleanInput($_POST['2stSub2']);
  $subCode32 = $db->cleanInput($_POST['2stSub3']);
  $grade12 = $db->cleanInput($_POST['2stResult1']);
  $grade22 = $db->cleanInput($_POST['2stResult2']);
  $grade32 = $db->cleanInput($_POST['2stResult3']);

  //==========================================================================
  //============================================================================

  $subCode13 = $db->cleanInput($_POST['3stSub1']);
  $subCode23 = $db->cleanInput($_POST['3stSub2']);
  $subCode33 = $db->cleanInput($_POST['3stSub3']);
  $grade13 = $db->cleanInput($_POST['3stResult1']);
  $grade23 = $db->cleanInput($_POST['3stResult2']);
  $grade33 = $db->cleanInput($_POST['3stResult3']);

  //==========================================================================

  //============================================================================

  $subCode14 = $db->cleanInput($_POST['4stSub1']);
  $subCode24 = $db->cleanInput($_POST['4stSub2']);
  $subCode34 = $db->cleanInput($_POST['4stSub3']);
  $grade14 = $db->cleanInput($_POST['4stResult1']);
  $grade24 = $db->cleanInput($_POST['4stResult2']);
  $grade34 = $db->cleanInput($_POST['4stResult3']);

  //==========================================================================
  //============================================================================

  $subCode15 = $db->cleanInput($_POST['5stSub1']);
  $subCode25 = $db->cleanInput($_POST['5stSub2']);
  $subCode35 = $db->cleanInput($_POST['5stSub3']);
  $grade15 = $db->cleanInput($_POST['5stResult1']);
  $grade25 = $db->cleanInput($_POST['5stResult2']);
  $grade35 = $db->cleanInput($_POST['5stResult3']);

  //==========================================================================



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

  if ($alAdNo != '') {
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

  if ($alAdNo1 != '') {
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
  if ($alAdNo2 != '') {
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
  if ($alAdNo3 != '') {
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

  if ($alAdNo4 != '') {
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


  //$result = executeQuery($query);
  //============================ lakshani
  $result2 = $db->executeQuery($query2);













  if ($code == '') {
  } else {

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
          <select name="lstAppType" id="lstAppType" onChange="change(this.value)" tabindex="1">
            <option value="LA">Local Applicant</option>
            <option value="FA">Foreign Applicant</option>
          </select>
        </label></td>
    </tr>
    <tr>
      <td height="25" width="161"> Application No</td>
      <td width="309"><input name="txtAppNo" id="txtAppNo" type="text" tabindex="2" size="20" /></td>
    </tr>
    <tr>
      <td height="28">Nikaya Name:</td>
      <td>

        <select name="nikayaName" id="nikayaName" onChange="document.localStudents.submit()" required>



          <?php
          $queryn = "SELECT * FROM nikaya";
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
      <td><?php $queryc = "SELECT * FROM `chapter` where `nikayaID`='$nikayaID'"; ?>
        <select name="chapterName">

          <?php
          $queryc = "SELECT * FROM `chapter` where `nikayaID`='$nikayaID'";
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
            for ($i = 1990; $i < 2100; $i++)
              echo "<option value=\"" . $i . "\">" . $i . "</option>";
            ?>
          </select>
        </label></td>
    </tr>
    <tr>
      <td height="25">National ID </td>
      <td> <input name="txtID" id="txtID" type="text" placeholder="123456789V or 123456789012" size="25" oninput="this.value = this.value.replace(/[^0-9V]/g, '').replace(/(\..*)\./g, '$1'); verifynic(this.value);" maxlength="12" required /></td>

    </tr>

    <tr>
      <td height="25">Date of Birth </td>
      <td><input name="txtbd" type="date" tabindex="3" size="20" /></td>
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
          <input name="txtNameE" type="text" tabindex="5" size="30" />
        </label></td>
    </tr>
    <tr>
      <td height="25">
        <p>&#3505;&#3512;
          <font />
          </font>
          </font>
        </p>
      </td>
      <td><label>
          <input name="txtNameS" type="text" tabindex="6" size="50" />
        </label></td>
    </tr>
    <tr>
      <td height="25"> Address - No</td>
      <td><label>
          <input name="txtaddE1" type="text" size="20" tabindex="7" />
        </label></td>
    </tr>
    <tr>
      <td height="25">
        <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Street </font></pre>
      </td>
      <td><input name="txtaddE2" type="text" size="40" tabindex="8" /></td>
    </tr>
    <tr>
      <td height="25">
        <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Town</font></pre>
      </td>
      <td><input name="txtaddE3" type="text" size="40" tabindex="9" /></td>
    </tr>
    <tr>
      <td height="25">
        <font face="KaputaUnicode" size="2">&#3517;&#3538;&#3508;&#3538;&#3505;&#3514;-&#3461;&#3458;&#3482;&#3514;
      </td>
      <td><input name="txtaddS1" type="text" size="20" tabindex="10" /></td>
    </tr>
    <tr>
      <td height="25">
        <font face="KaputaUnicode" size="2">
          <pre>    &#3520;&#3539;&#3503;&#3538;&#3514;<pre/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
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
        while ($resultSet = $db->Next_Record($result)) {
          $id = $resultSet["id"];
          $district = $resultSet["districtEnglish"];
          echo "<option value=\"" . $district . "\">" . $district . "</option>";
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
        <td height="25"> <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Street </font></pre>
      </td>
      <td><input name="txtaddGE2" type="text" size="40" tabindex="14" /></td>
    </tr>
    <tr>
      <td height="25">
        <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Town</font></pre>
      </td>
      <td><input name="txtaddGE3" type="text" size="40" tabindex="15" /></td>
    </tr>
    <tr>
      <td height="25">
        <font face="KaputaUnicode" size="2">&#3517;&#3538;&#3508;&#3538;&#3505;&#3514;-&#3461;&#3458;&#3482;&#3514;
      </td>
      <td><input name="txtaddGS1" type="text" size="20" tabindex="16" /></td>
    </tr>
    <tr>
      <td height="25">
        <font face="KaputaUnicode" size="2">
          <pre>    &#3520;&#3539;&#3503;&#3538;&#3514;<pre/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
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
        <td height="25"> Late Applicant </td>
        <td>
          <select name="applate" id="applate" tabindex="14" >
            
            <option value='n'> No</option>
			  <option value='y'>Yes</option>
              </select></td>
      </tr>
      <tr>
        <td height="46" colspan='2' bgcolor="#bae8e8"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">A/L Qualification</font></td>	
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
    for ($i = 1990; $i < 2100; $i++)
      echo "<option value=\"" . $i . "\">" . $i . "</option>";
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
        <td height="25"> Medium </td>
        <td>
          <select name="medium1" id="medium1" tabindex="14" >
            
            <option value='s'> Sinhala</option>
			  <option value='e'>English</option>
              </select></td>
      </tr>
		
      <tr>
        <td height="25">Stream</td>
        <!-- &#3508;&#3515;&#3538;&#3508;&#3535;&#3517;&#3505; &#3503;&#3538;&#3523;&#3530;&#3501;&#3538;&#3482;&#3530;&#3482;&#3514;</td> -->
        
        <td>
          <select name="txtstream" id="txtstream" tabindex="13" onChange="subjectFilter(this.value)">
            <option value="">-Select-</option>
                <?php
                $query = "SELECT * FROM alstream";
                $result = $db->executeQuery($query);
                while ($resultSet = $db->Next_Record($result)) {
                  $streamId = $resultSet["streamId"];
                  $description = $resultSet["description"];
                  echo "<option value=\"" . $streamId . "\">" . $description . "</option>";
                }
                ?>
          </select>
        </td>
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
        <td colspan="2">
          <table width="223" height="124" border="1" >
            <tr>
              <th width="150" scope="col">Subject Name</th>
              <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
            </tr>
         
          <?php for ($j = 1; $j <= 3; $j++) {

            echo "<tr>
                    <td>
                      <div id='Subject" . $j . "'> 
                        <select name='lstSub" . $j . "' id='lstSub" . $j . "' tabindex='20' 
                        onChange='subjectchecker(" . $j . ")'>";
          ?>
                    </select>
                  </div> 
                </td>
            <?php
            echo " <td>
                   <select name= 'lstResult" . $j . "' tabindex='21'>"; ?>
                        <option>-Grade-</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="S">S</option>
                        <option value="F">F</option>
                      </select>
                    </td>
                    </tr>
            <?php   } ?>
          
         
        </table>         
       </td>
      </tr>
          
           </table>          
           </td>
        </tr>



        <?php /*******************************************************************************************************************************************/ ?>
        <tr>
        <td height="46" colspan='2' bgcolor="#bae8e8">
          <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
            Prachina Madayama Qualification</font></td>	
      </tr>
        <tr>
        <td height="25"> Admission No</td>
        <td><label>
          <input name="txtA_LAddmision1" type="text"  tabindex="15" size="20" />
        </label></td>
      </tr>
      <tr>
        <td height="25">Year</td>
        <td><select name="lstAlYear1" id="lstYear1" tabindex="16">
	  <?php
    for ($i = 1990; $i < 2100; $i++)
      echo "<option value=\"" . $i . "\">" . $i . "</option>";
    ?> 
      </select></td>
      </tr>
      
      
			<tr>
        <td height="25"> Medium </td>
        <td>
          <select name="medium2" id="medium2" tabindex="14" >
            
            <option value='s'> Sinhala</option>
			  <option value='e'>English</option>
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
        <td colspan="2">
          <table width="223" height="124" border="1" >
            <tr>
              <th width="150" scope="col">Subject Name</th>
              <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
          </tr>
         
          <?php for ($j = 1; $j <= 3; $j++) {

            echo "
                  <tr>
                    <td><div id='Subject" . $j . "'> <select name='2stSub" . $j . "' tabindex='20'>";
          ?>
                    <option value='0'>- Select Subject- </option>
                    <?php

                    $query = "SELECT * FROM alsubjects where quli_id='5'";
                    $result = $db->executeQuery($query);
                    while ($resultSet = $db->Next_Record($result)) {
                      $rSubjectCode  = $resultSet["subjectCode"];
                      $rSubject = $resultSet["subnameE"];

                      echo "<option value=\"" . $rSubjectCode . "\">" . $rSubject . "</option>";
                    } ?>
            
                    </select></div> </td>
            <?php
            echo " <td>
                   <select name= '2stResult" . $j . "' tabindex='21'>"; ?>
                        <option>-Grade-</option>
                        <option value="A">A</option>
                        <option  value="B">B</option>
                        <option  value="C">C</option>
                        <option  value="S">S</option>
                        <option  value="F">F</option>
                                      </select>
                    </td>
                    </tr>
            <?php   } ?>
          
         
        </table>          </td>
      </tr>
          
           </table>           </td>
        </tr>

        <?php /*****************************************************************************************************************************************/ ?>
        
        <?php /*******************************************************************************************************************************************/ ?>
        <tr>
        <td height="46" colspan='2' bgcolor="#bae8e8"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Prachina Praramba Qualification</font></td>	
      </tr>
        <tr>
        <td height="25"> Admission No</td>
        <td><label>
          <input name="txtA_LAddmision2" type="text"  tabindex="15" size="20" />
        </label></td>
      </tr>
      <tr>
        <td height="25">Year</td>
        <td><select name="lstAlYear2" id="lstYear2" tabindex="16">
	  <?php
    for ($i = 1990; $i < 2100; $i++)
      echo "<option value=\"" . $i . "\">" . $i . "</option>";
    ?> 
      </select></td>
      </tr>
      
      
			<tr>
        <td height="25"> Medium </td>
        <td>
          <select name="medium3" id="medium3" tabindex="14" >
            
            <option value='s'> Sinhala</option>
			  <option value='e'>English</option>
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
        <td colspan="2">
          <table width="223" height="124" border="1" >
            <tr>
              <th width="150" scope="col">Subject Name</th>
              <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
          </tr>
         
          <?php for ($j = 1; $j <= 3; $j++) {

            echo "
                  <tr>
                    <td><div id='Subject" . $j . "'> <select name='3stSub" . $j . "' tabindex='20'>";
          ?>
                    <option value='0'>- Select Subject- </option>
                    <?php

                    $query = "SELECT * FROM alsubjects where quli_id='6'";
                    $result = $db->executeQuery($query);
                    while ($resultSet = $db->Next_Record($result)) {
                      $rSubjectCode  = $resultSet["subjectCode"];
                      $rSubject = $resultSet["subnameE"];

                      echo "<option value=\"" . $rSubjectCode . "\">" . $rSubject . "</option>";
                    } ?>
            
                    </select></div> </td>
            <?php
            echo " <td>
                   <select name= '3stResult" . $j . "' tabindex='21'>"; ?>
                        <option>-Grade-</option>
                        <option value="A">A</option>
                        <option  value="B">B</option>
                        <option  value="C">C</option>
                        <option  value="S">S</option>
                        <option  value="F">F</option>
                                      </select>
                    </td>
                    </tr>
            <?php   } ?>
          
         
        </table>          </td>
      </tr>
          
           </table>           </td>
        </tr>

        <?php /*****************************************************************************************************************************************/ ?>
        <?php /*******************************************************************************************************************************************/ ?>
        <tr>
        <td height="46" colspan='2' bgcolor="#bae8e8">
          <font face="Verdana, Arial, Helvetica, sans-serif" size="2">
            Vidyalankara Qualification</font></td>	
      </tr>
        <tr>
        <td height="25"> Admission No</td>
        <td><label>
          <input name="txtA_LAddmision4" type="text"  tabindex="15" size="20" />
        </label></td>
      </tr>
      <tr>
        <td height="25">Year</td>
        <td><select name="lstAlYear4" id="lstYear2" tabindex="16">
	  <?php
    for ($i = 1990; $i < 2100; $i++)
      echo "<option value=\"" . $i . "\">" . $i . "</option>";
    ?> 
      </select></td>
      </tr>
      
      
			<tr>
        <td height="25"> Medium </td>
        <td>
          <select name="medium4" id="medium3" tabindex="14" >
            
            <option value='s'> Sinhala</option>
			  <option value='e'>English</option>
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
         
          <?php for ($j = 1; $j <= 3; $j++) {

            echo "
                  <tr>
                    <td><div id='Subject" . $j . "'> <select name='5stSub" . $j . "' tabindex='20'>";
          ?>
                    <option value='0'>- Select Subject- </option>
                    <?php

                    $query = "SELECT * FROM alsubjects where quli_id='8'";
                    $result = $db->executeQuery($query);
                    while ($resultSet = $db->Next_Record($result)) {
                      $rSubjectCode  = $resultSet["subjectCode"];
                      $rSubject = $resultSet["subnameE"];

                      echo "<option value=\"" . $rSubjectCode . "\">" . $rSubject . "</option>";
                    } ?>
            
                    </select></div> </td>
            <?php
            echo " <td>
                   <select name= '5stResult" . $j . "' tabindex='21'>"; ?>
                        <option>-Grade-</option>
                        <option value="A">A</option>
                        <option  value="B">B</option>
                        <option  value="C">C</option>
                        <option  value="S">S</option>
                        <option  value="F">F</option>
                                      </select>
                    </td>
                    </tr>
            <?php   } ?>
          
         
        </table>          </td>
      </tr>
          
           </table>           </td>
        </tr>

        <?php /*****************************************************************************************************************************************/ ?>

      
        <?php /*******************************************************************************************************************************************/ ?>
        <tr>
        <td height="46" colspan='2' bgcolor="#bae8e8">
          <font face="Verdana, Arial, Helvetica, sans-serif" size="2">Vidyodaya Qualification</font></td>	
      </tr>
        <tr>
        <td height="25"> Admission No</td>
        <td><label>
          <input name="txtA_LAddmision3" type="text"  tabindex="15" size="20" />
        </label></td>
      </tr>
      <tr>
        <td height="25">Year</td>
        <td><select name="lstAlYear3" id="lstYear3" tabindex="16">
	  <?php
    for ($i = 1990; $i < 2100; $i++)
      echo "<option value=\"" . $i . "\">" . $i . "</option>";
    ?> 
      </select></td>
      </tr>
      
      
			<tr>
        <td height="25"> Medium </td>
        <td>
          <select name="medium4" id="medium4" tabindex="14" >
            
            <option value='s'> Sinhala</option>
			  <option value='e'>English</option>
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
        <td colspan="2">
          <table width="223" height="124" border="1" >
            <tr>
              <th width="150" scope="col">Subject Name</th>
              <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
          </tr>
         
          <?php for ($j = 1; $j <= 3; $j++) {

            echo "
                  <tr>
                    <td><div id='Subject" . $j . "'> <select name='4stSub" . $j . "' tabindex='20'>";
          ?>
                    <option value='0'>- Select Subject- </option>
                    <?php

                    $query = "SELECT * FROM alsubjects where quli_id='7'";
                    $result = $db->executeQuery($query);
                    while ($resultSet = $db->Next_Record($result)) {
                      $rSubjectCode  = $resultSet["subjectCode"];
                      $rSubject = $resultSet["subnameE"];

                      echo "<option value=\"" . $rSubjectCode . "\">" . $rSubject . "</option>";
                    } ?>
            
                    </select></div> </td>
            <?php
            echo " <td>
                   <select name= '4stResult" . $j . "' tabindex='21'>"; ?>
                        <option>-Grade-</option>
                        <option value="A">A</option>
                        <option  value="B">B</option>
                        <option  value="C">C</option>
                        <option  value="S">S</option>
                        <option  value="F">F</option>
                                      </select>
                    </td>
                    </tr>
            <?php   } ?>
          
         
        </table>          </td>
      </tr>
     
          
           </table>           </td>
        </tr>

        <?php /*****************************************************************************************************************************************/ ?>
      <!-- <tr>
        <td height="46" colspan="2">
        <input type="button" name="btnAddRow" id="btnAddRow" value="Add Row" tabindex="24" onclick="addRowList('tblpali')" class="button"/>&nbsp;&nbsp;        
          <input type="button" name="btndeleteRow" id="btndeleteRow" value="Delete Row" tabindex="23" onclick="deleteRow('tblpali')" align="left" class="button"/>          </td>
       </tr> -->

       <tr>
        <td height="46" colspan='2' bgcolor="#bae8e8"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Pali Qualification</font></td>	
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
              while ($resultSet = $db->Next_Record($result7)) {
                $PaliCode = $resultSet["code"];
                $Qualification = $resultSet["qualification"];
                echo "<option value=\"" . $PaliCode . "\">" . $Qualification . "</option>";
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
        <input name="btnCancel" type="button" value="Cancel" class="button" tabindex="25" onclick="document.location.href='applicant.php';"/>
        &nbsp;&nbsp;
        <input type="submit" name="btnSubmit" id="btnSubmit" value="Submit" tabindex="26" class="button" />
        </div></td>
      </tr>
    </table>
</form> 


<script>
 function subjectFilter(strm_elementval)
    {
        console.log("selected value= ", strm_elementval);
        
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