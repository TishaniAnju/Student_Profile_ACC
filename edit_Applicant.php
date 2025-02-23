<?php
ob_start();
// echo ("Test 12");
?>
<script language="javascript" src="addRow_list.js"></script>
<script type="text/javascript" src="lib/pop-up/popup-window.js"></script>
<link href="lib/pop-up/sample.css" rel="stylesheet" type="text/css" />
<script>
  function subjectFilter(strm_elementval) {

    document.getElementById("1stSub1").innerHTML = "";
    document.getElementById("1stSub2").innerHTML = "";
    document.getElementById("1stSub3").innerHTML = "";
    document.getElementById("1stResult1").selectedIndex = 0;
    document.getElementById("1stResult2").selectedIndex = 0;
    document.getElementById("1stResult3").selectedIndex = 0;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("1stSub1").innerHTML = this.responseText;
        document.getElementById("1stSub2").innerHTML = this.responseText;
        document.getElementById("1stSub3").innerHTML = this.responseText;
      }
    };
    xhttp.open("GET", "subj_filter.php?subID=" + strm_elementval, true);
    xhttp.send();
  }
  // A/L examination subject checker
  function subjectchecker1(ddval) {
    var v1 = document.getElementById("1stSub1").value;
    var v2 = document.getElementById("1stSub2").value;
    var v3 = document.getElementById("1stSub3").value;

    if (ddval == 1) {
      if (v1 == v2 || v1 == v3) {
        alert("This Subject is already Selected!");
        document.getElementById("1stSub1").value = 0;
      }
    } else if (ddval == 2) {
      if (v2 == v1 || v2 == v3) {
        alert("This Subject is already Selected!");
        document.getElementById("1stSub2").value = 0;
      }

    } else if (ddval == 3) {
      if (v3 == v1 || v3 == v2) {
        alert("This Subject is already Selected!");
        document.getElementById("1stSub3").value = 0;
      }

    }

  }

  // Prachina Madyama examination subject checker
  function subjectchecker2(ddval) {
    var v1 = document.getElementById("2ndSub1").value;
    var v2 = document.getElementById("2ndSub2").value;
    var v3 = document.getElementById("2ndSub3").value;

    if (ddval == 1) {
      if (v1 == v2 || v1 == v3) {
        alert("This Subject is already Selected!");
        document.getElementById("2ndSub1").value = 0;
      }
    } else if (ddval == 2) {
      if (v2 == v1 || v2 == v3) {
        alert("This Subject is already Selected!");
        document.getElementById("2ndSub2").value = 0;
      }

    } else if (ddval == 3) {
      if (v3 == v1 || v3 == v2) {
        alert("This Subject is already Selected!");
        document.getElementById("2ndSub3").value = 0;
      }

    }

  }

  //Prachina Prarambha examination subject checker
  function subjectchecker3(ddval) {
    var v1 = document.getElementById("3rdSub1").value;
    var v2 = document.getElementById("3rdSub2").value;
    var v3 = document.getElementById("3rdSub3").value;

    if (ddval == 1) {
      if (v1 == v2 || v1 == v3) {
        alert("This Subject is already Selected!");
        document.getElementById("3rdSub1").value = 0;
      }
    } else if (ddval == 2) {
      if (v2 == v1 || v2 == v3) {
        alert("This Subject is already Selected!");
        document.getElementById("3rdSub2").value = 0;
      }

    } else if (ddval == 3) {
      if (v3 == v1 || v3 == v2) {
        alert("This Subject is already Selected!");
        document.getElementById("3rdSub3").value = 0;
      }

    }

  }

  // Vidyodaya examination subject checker
  function subjectchecker4(ddval) {
    var v1 = document.getElementById("4thSub1").value;
    var v2 = document.getElementById("4thSub2").value;
    var v3 = document.getElementById("4thSub3").value;

    if (ddval == 1) {
      if (v1 == v2 || v1 == v3) {
        alert("This Subject is already Selected!");
        document.getElementById("4thSub1").value = 0;
      }
    } else if (ddval == 2) {
      if (v2 == v1 || v2 == v3) {
        alert("This Subject is already Selected!");
        document.getElementById("4thSub2").value = 0;
      }

    } else if (ddval == 3) {
      if (v3 == v1 || v3 == v2) {
        alert("This Subject is already Selected!");
        document.getElementById("4thSub3").value = 0;
      }

    }

  }

  // A/L examination subject checker
  function subjectchecker5(ddval) {
    var v1 = document.getElementById("5thSub1").value;
    var v2 = document.getElementById("5thSub2").value;
    var v3 = document.getElementById("5thSub3").value;

    if (ddval == 1) {
      if (v1 == v2 || v1 == v3) {
        alert("This Subject is already Selected!");
        document.getElementById("5thSub1").value = 0;
      }
    } else if (ddval == 2) {
      if (v2 == v1 || v2 == v3) {
        alert("This Subject is already Selected!");
        document.getElementById("5thSub2").value = 0;
      }

    } else if (ddval == 3) {
      if (v3 == v1 || v3 == v2) {
        alert("This Subject is already Selected!");
        document.getElementById("5thSub3").value = 0;
      }

    }

  }


  function loadOtherData(selectedSubject) {
    if (selectedSubject) {
      // AJAX call to load other data related to the selected subject
      var xhr = new XMLHttpRequest();
      xhr.open('GET', "subj_filter.php?subID=" + strm_elementval, true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          // Display the related data in the div
          document.getElementById('relatedData').innerHTML = xhr.responseText;
        }
      };
      xhr.send();
    } else {
      document.getElementById('relatedData').innerHTML = '';
    }
  }
</script>

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
        alert("One or more mandatory fields are kept blank.");
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


<?php
include("dbAccess.php");
$db = new DBOperations();

// echo "<pre>";
// print_r($_GET);
// echo "</pre>";

if (!isset($_GET['appNo']) || !isset($_GET['appType'])) {
  echo "Required parameters 'appNo' and 'appType' are missing.";
  exit();
}

$appNo = $db->cleanInput($_GET['appNo']);
$appType = $db->cleanInput($_GET['appType']);

// $quli_Id = $db->cleanInput($_GET['quli_Id']);

//$entryType = $db->cleanInput($_POST['entryType']);



if (isset($_POST['nikayaName'])) {
  $nikayaID = $db->cleanInput($_POST['nikayaName']);
}

if ($appType == "Local") {

  if (isset($_POST['btnAdd'])) {

    echo "Form processing started.<br>";



    $nameEnglish =  $db->cleanInput($_POST['txtNameE']);
    $entryYear = $_POST['lstYearEntry'];
    $titleE = $_POST['lstTitle'];
    $addressEnglish1 = $db->cleanInput($_POST['txtaddE1']);
    $addressEnglish2 = $db->cleanInput($_POST['txtaddE2']);
    $addressEnglish3 = $db->cleanInput($_POST['txtaddE3']);
    $txtapplicationNb = $db->cleanInput($_POST['txtapplicationNb']);



    // $query = "UPDATE applicant SET entryYear='$entryYear',titleE='$titleE',nameEnglish='$nameEnglish',addressEnglish1='$addressEnglish1',addressEnglish2='$addressEnglish2',addressEnglish3='$addressEnglish3' WHERE appNo='$appNo' AND appType='$appType'";
    // $result =  $db->executeQuery($query);


    $nameSinhala =  $db->cleanInput($_POST['txtNameS']);
    $addressSinhala1 = $db->cleanInput($_POST['txtaddS1']);
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
    $zScore = $db->cleanInput($_POST['txtZScore']);
    $gkScore = $db->cleanInput($_POST['txtGKScore']);
    $nicNo = $db->cleanInput($_POST['txtID']);
    $dob = $db->cleanInput($_POST['txtbd']);

    $code = $_POST['lstPali'];
    //print $code; 
    $paliresult = $db->cleanInput($_POST['txtPResult']);
    $chapterID = $db->cleanInput($_POST['capteraName']);
    $nikayaID = $db->cleanInput($_POST['nikayaName']);
    //print $paliresult;

    //============================================= Lakshnai Edit update ===========================================
    // $subCode1 = $db->cleanInput($_POST['subject']);

    // AL ==>1
    $subCode11 = $db->cleanInput($_POST['1stSub1']);
    $subCode21 = $db->cleanInput($_POST['1stSub2']);
    $subCode31 = $db->cleanInput($_POST['1stSub3']);
    $grade11 = $db->cleanInput($_POST['1stResult1']);
    $grade21 = $db->cleanInput($_POST['1stResult2']);
    $grade31 = $db->cleanInput($_POST['1stResult3']);
    $alAdNo = $db->cleanInput($_POST['txtA_LAddmision']);
    $alYear = $_POST['lstAlYear'];
    $medium = $db->cleanInput($_POST['mediumAL']);
    $stream = $db->cleanInput($_POST['txtstream']);

    // PrachinaMadyama==>5
    $subCode12 = $db->cleanInput($_POST['2ndSub1']);
    $subCode22 = $db->cleanInput($_POST['2ndSub2']);
    $subCode32 = $db->cleanInput($_POST['2ndSub3']);
    $grade12 = $db->cleanInput($_POST['2ndResult1']);
    $grade22 = $db->cleanInput($_POST['2ndResult2']);
    $grade32 = $db->cleanInput($_POST['2ndResult3']);
    $alAdNo1 = $db->cleanInput($_POST['txtA_LAddmision1']);
    $alYear1 = $_POST['prachinaMadyamaYear'];
    $medium1 = $db->cleanInput($_POST['mediumPrachinaMadyama']);

    // PrachinaPrarambha ==>6
    $subCode13 = $db->cleanInput($_POST['3rdSub1']);
    $subCode23 = $db->cleanInput($_POST['3rdSub2']);
    $subCode33 = $db->cleanInput($_POST['3rdSub3']);
    // print "HELLOW";
    // print "$subCode13";
    // print  $subCode23;
    // print  $subCode33;
    $grade13 = $db->cleanInput($_POST['3rdResult1']);
    $grade23 = $db->cleanInput($_POST['3rdResult2']);
    print $grade23;
    $grade33 = $db->cleanInput($_POST['3rdResult3']);
    print $grade33;
    $alAdNo2 = $db->cleanInput($_POST['txtA_LAddmision2']);
    $alYear2 = $_POST['prachinaPrarambaYear'];
    $medium2 = $db->cleanInput($_POST['mediumPrachinaPraramba']);

    // Vidyodaya ==>7
    $subCode14 = $db->cleanInput($_POST['4thSub1']);
    $subCode24 = $db->cleanInput($_POST['4thSub2']);
    $subCode34 = $db->cleanInput($_POST['4thSub3']);
    $grade14 = $db->cleanInput($_POST['4thResult1']);
    $grade24 = $db->cleanInput($_POST['4thResult2']);
    $grade34 = $db->cleanInput($_POST['4thResult3']);
    $alAdNo3 = $db->cleanInput($_POST['txtA_LAddmision3']);
    $alYear3 = $_POST['VidyodayaYear'];
    $medium3 = $db->cleanInput($_POST['mediumVidyodaya']);

    // vidyalankara ==>8
    $subCode15 = $db->cleanInput($_POST['5thSub1']);
    $subCode25 = $db->cleanInput($_POST['5thSub2']);
    $subCode35 = $db->cleanInput($_POST['5thSub3']);
    $grade15 = $db->cleanInput($_POST['5thResult1']);
    $grade25 = $db->cleanInput($_POST['5thResult2']);
    $grade35 = $db->cleanInput($_POST['5thResult3']);
    $alAdNo4 = $db->cleanInput($_POST['txtA_LAddmision4']);
    $alYear4 = $_POST['VidyalankaraYear'];
    $medium4 = $db->cleanInput($_POST['mediumVidyalankara']);

    //===============================================
    if ($medium == 'English') {
      $m = 'e';
    } elseif ($medium == 'Sinhala') {
      $m = 's';
    } else {
      $m = ' ';
    }

    if ($medium1 == 'English') {
      $m1 = 'e';
    } elseif ($medium1 == 'Sinhala') {
      $m1 = 's';
    } else {
      $m1 = ' ';
    }

    if ($medium2 == 'English') {
      $m2 = 'e';
    } elseif ($medium2 == 'Sinhala') {
      $m2 = 's';
    } else {
      $m2 = ' ';
    }

    if ($medium3 == 'English') {
      $m3 = 'e';
    } elseif ($medium3 == 'Sinhala') {
      $m3 = 's';
    } else {
      $m3 = ' ';
    }

    if ($medium4 == 'English') {
      $m4 = 'e';
    } elseif ($medium4 == 'Sinhala') {
      $m4 = 's';
    } else {
      $m4 = ' ';
    }


    $querylocalapplicant = "UPDATE localapplicant SET nameSinhala='$nameSinhala',addS1='$addressSinhala1',addS2='$addressSinhala2',addS3='$addressSinhala3',district='$district',
    telno='$telno',email='$email',guardianEname='$gnameEnglish',guardianSname='$gnameSinhala',guardianEadd1='$gaddressEnglish1',guardianEadd2='$gaddressEnglish2',
    guardianEadd3='$gaddressEnglish3',guardianSadd1='$gaddressSinhala1',guardianSadd2='$gaddressSinhala2',guardianSadd3='$gaddressSinhala3',appfee='$appFee',
   alAdNo='$alAdNo',alYear='$alYear',zScore='$zScore',gkScore='$gkScore',nicNo='$nicNo',dob='$dob'WHERE appNo='$appNo'";

    $resultlocalapplicant =  $db->executeQuery($querylocalapplicant);

    $queryapplicant = "UPDATE applicant SET applicationNo='$txtapplicationNb',entryYear='$entryYear',titleE='$titleE',nameEnglish='$nameEnglish',
   addressEnglish1='$addressEnglish1',addressEnglish2='addressEnglish2',addressEnglish3='$addressEnglish3',appType='$appType',qualified='',
   confirmed='' WHERE appNo='$appNo'";

    $resultapplicant =  $db->executeQuery($queryapplicant);


    // Check if $alAdNo is empty
    // Handling for quli_Id 1
    // Handle for quli_Id 1
    function insertSubjects($db, $appNo, $quliId, $subjects)
    {
      foreach ($subjects as $subject) {
        //print $quliId ;
        //print "www";
        //print $subjects ;
        print "zzz";
        $queryInsertSubject = "INSERT IGNORE INTO applicantsubjects (appNo, quli_Id, subjectCode, result) 
                           VALUES ('$appNo', '$quliId', '{$subject['code']}', '{$subject['grade']}')";
        echo $queryInsertSubject;
        $db->executeQuery($queryInsertSubject);
      }
    }



    //A/L==============================================================================================================
    $subjects1 = [
      ['code' => $subCode11, 'grade' => $grade11],
      ['code' => $subCode21, 'grade' => $grade21],
      ['code' => $subCode31, 'grade' => $grade31]
    ];

    if ($alAdNo != '') {
      // Check if the applicantquli record already exists
      $query = "SELECT Id FROM applicantquli WHERE appNo = '$appNo' AND quli_Id='1'";
      $result = $db->executeQuery($query);

      if ($result && $db->Row_Count($result) > 0) {
        // Record exists, update it
        $row = $db->Next_Record($result);
        $id = $row['Id'];

        $queryapquli1 = "UPDATE applicantquli SET quli_year='$alYear', indexNo='$alAdNo', medium='$m', stream='$stream' WHERE Id='$id'";
        $resquli = $db->executeQuery($queryapquli1);

        // Delete existing subjects and insert new ones
        $delQuery2 = "DELETE FROM applicantsubjects WHERE appNo='$appNo' AND quli_Id='1'";
        $db->executeQuery($delQuery2);

        // Insert new subjects
        insertSubjects($db, $appNo, '1', $subjects1);
      } else {
        // Record does not exist, insert a new one
        $querypaliquli1 = "INSERT INTO applicantquli (appNo, quli_Id, quli_year, indexNo, stream, medium) 
                         VALUES ('$appNo', '1', '$alYear', '$alAdNo', '$stream', '$m')";
        $db->executeQuery($querypaliquli1);

        // Insert new subjects
        insertSubjects($db, $appNo, '1', $subjects1);
      }
    } else if ($alAdNo == "") {

      // Delete existing records
      $delQueryApp_quli = "DELETE FROM `applicantquli` WHERE appNo='$appNo' AND quli_Id='1'";
      $db->executeQuery($delQueryApp_quli);
      $delQueryAppSub = "DELETE FROM applicantsubjects WHERE appNo='$appNo' AND quli_Id='1'";
      $db->executeQuery($delQueryAppSub);
    }





    //Prachina madyama========================================================================================
    $subjects5 = [
      ['code' => $subCode12, 'grade' => $grade12],
      ['code' => $subCode22, 'grade' => $grade22],
      ['code' => $subCode32, 'grade' => $grade32]
    ];

    if ($alAdNo1 != '') {
      // Check if the applicantquli record already exists
      $query = "SELECT Id FROM applicantquli WHERE appNo = '$appNo' AND quli_Id='5'";
      $result = $db->executeQuery($query);

      if ($result && $db->Row_Count($result) > 0) {
        // Record exists, update it
        $row = $db->Next_Record($result);
        $id = $row['Id'];

        $queryapquli5 = "UPDATE applicantquli SET quli_year='$alYear1', indexNo='$alAdNo1', medium='$m1', stream=' ' WHERE Id='$id'";
        $resquli = $db->executeQuery($queryapquli5);

        // Delete existing subjects and insert new ones
        $delQuery5 = "DELETE FROM applicantsubjects WHERE appNo='$appNo' AND quli_Id='5'";
        $db->executeQuery($delQuery5);

        // Insert new subjects
        insertSubjects($db, $appNo, '5', $subjects5);
      } else {
        // Record does not exist, insert a new one
        $querypaliquli5 = "INSERT INTO applicantquli (Id, appNo, quli_Id, quli_year, indexNo, stream, medium) 
                         VALUES (NULL, '$appNo', '5', '$alYear1', '$alAdNo1', ' ', '$m1')";
        $db->executeQuery($querypaliquli5);

        // Insert subjects
        insertSubjects($db, $appNo, '5', $subjects5);
      }
    } else if ($alAdNo1 == "") {
      // Delete existing records
      $delQueryApp_quli1 = "DELETE FROM applicantquli WHERE appNo='$appNo' AND quli_Id='5'";
      $db->executeQuery($delQueryApp_quli1);
      $delQueryAppSub1 = "DELETE FROM applicantsubjects WHERE appNo='$appNo' AND quli_Id='5'";
      $db->executeQuery($delQueryAppSub1);
    }



    //Prachina prarambha========================================================================================

    $subjects6 = [
      ['code' => $subCode13, 'grade' => $grade13],
      ['code' => $subCode23, 'grade' => $grade23],
      ['code' => $subCode33, 'grade' => $grade33]
    ];

    if ($alAdNo2 != '') {
      // Check if the applicantquli record already exists
      $query = "SELECT Id FROM applicantquli WHERE appNo = '$appNo' AND quli_Id='6'";
      $result = $db->executeQuery($query);

      if ($result && $db->Row_Count($result) > 0) {
        // Record exists, update it
        $row = $db->Next_Record($result);
        $id = $row['Id'];

        $queryapquli6 = "UPDATE applicantquli SET quli_year='$alYear2', indexNo='$alAdNo2', medium='$m2', stream=' ' WHERE Id='$id'";
        $db->executeQuery($queryapquli6);

        // Delete existing subjects and insert new ones
        $delQuery6 = "DELETE FROM applicantsubjects WHERE appNo='$appNo' AND quli_Id='6'";
        $db->executeQuery($delQuery6);

        // Insert new subjects
        insertSubjects($db, $appNo, '6', $subjects6);
      } else {
        // Record does not exist, insert a new one
        $querypaliquli6 = "INSERT INTO applicantquli (Id, appNo, quli_Id, quli_year, indexNo, stream, medium) 
                         VALUES (NULL, '$appNo', '6', '$alYear2', '$alAdNo2', ' ', '$m2')";
        $db->executeQuery($querypaliquli6);

        // Insert subjects
        insertSubjects($db, $appNo, '6', $subjects6);
      }
    } else if ($alAdNo2 == "") {
      // Delete existing records
      $delQueryApp_quli6 = "DELETE FROM applicantquli WHERE appNo='$appNo' AND quli_Id='6'";
      $db->executeQuery($delQueryApp_quli6);

      $delQueryAppSub6 = "DELETE FROM applicantsubjects WHERE appNo='$appNo' AND quli_Id='6'";
      $db->executeQuery($delQueryAppSub6);
    }

    $subjects7 = [
      ['code' => $subCode14, 'grade' => $grade14],
      ['code' => $subCode24, 'grade' => $grade24],
      ['code' => $subCode34, 'grade' => $grade34]
    ];


    //vidyodaya========================================================================================

    if ($alAdNo3 != '') {
      // Check if the applicantquli record already exists
      $query = "SELECT Id FROM applicantquli WHERE appNo = '$appNo' AND quli_Id='7'";
      $result = $db->executeQuery($query);

      if ($result && $db->Row_Count($result) > 0) {
        // Record exists, update it
        $row = $db->Next_Record($result);
        $id = $row['Id'];

        $queryapquli7 = "UPDATE applicantquli SET quli_year='$alYear3', indexNo='$alAdNo3', medium='$m3', stream=' ' WHERE Id='$id'";
        $resquli = $db->executeQuery($queryapquli7);

        // Delete existing subjects and insert new ones
        $delQuery7 = "DELETE FROM applicantsubjects WHERE appNo='$appNo' AND quli_Id='7'";
        $db->executeQuery($delQuery7);

        // Insert new subjects
        insertSubjects($db, $appNo, '7', $subjects7);
      } else {
        // Record does not exist, insert a new one
        $querypaliquli7 = "INSERT INTO applicantquli (Id, appNo, quli_Id, quli_year, indexNo, stream, medium) 
                         VALUES (NULL, '$appNo', '7', '$alYear3', '$alAdNo3', ' ', '$m3')";
        $db->executeQuery($querypaliquli7);

        print_r($subjects7);
        // Insert subjects
        insertSubjects($db, $appNo, '7', $subjects7);
      }
    } else if ($alAdNo3 == "") {
      // Delete existing records
      $delQueryApp_quli7 = "DELETE FROM applicantquli WHERE appNo='$appNo' AND quli_Id='7'";
      $db->executeQuery($delQueryApp_quli7);
      $delQueryAppSub7 = "DELETE FROM applicantsubjects WHERE appNo='$appNo' AND quli_Id='7'";
      $db->executeQuery($delQueryAppSub7);
    }



    //Vidyalankara========================================================================================
    $subjects8 = [
      ['code' => $subCode15, 'grade' => $grade15],
      ['code' => $subCode25, 'grade' => $grade25],
      ['code' => $subCode35, 'grade' => $grade35]
    ];

    if ($alAdNo4 != '') {
      // Check if the applicantquli record already exists
      $query = "SELECT Id FROM applicantquli WHERE appNo = '$appNo' AND quli_Id='8'";
      $result = $db->executeQuery($query);

      if ($result && $db->Row_Count($result) > 0) {
        // Record exists, update it
        $row = $db->Next_Record($result);
        $id = $row['Id'];

        $queryapquli8 = "UPDATE applicantquli SET quli_year='$alYear4', indexNo='$alAdNo4', medium='$m4', stream=' ' WHERE Id='$id'";
        $resquli = $db->executeQuery($queryapquli8);

        // Delete existing subjects and insert new ones
        $delQuery8 = "DELETE FROM applicantsubjects WHERE appNo='$appNo' AND quli_Id='8'";
        $db->executeQuery($delQuery8);

        // Insert new subjects
        insertSubjects($db, $appNo, '8', $subjects8);
      } else {
        // Record does not exist, insert a new one
        $querypaliquli8 = "INSERT INTO applicantquli (Id, appNo, quli_Id, quli_year, indexNo, stream, medium) 
                         VALUES (NULL, '$appNo', '8', '$alYear4', '$alAdNo4', ' ', '$m4')";
        $db->executeQuery($querypaliquli8);

        print_r($subjects8);
        // Insert subjects
        insertSubjects($db, $appNo, '8', $subjects8);
      }
    } else if ($alAdNo4 == "") {
      // Delete existing records
      $delQueryApp_quli8 = "DELETE FROM applicantquli WHERE appNo='$appNo' AND quli_Id='8'";
      $db->executeQuery($delQueryApp_quli8);
      $delQueryAppSub8 = "DELETE FROM applicantsubjects WHERE appNo='$appNo' AND quli_Id='8'";
      $db->executeQuery($delQueryAppSub8);
    }




    //==================================================================================================================
    /*$query = "UPDATE localapplicant SET nameSinhala='$nameSinhala',addS1='$addressSinhala1',addS2='$addressSinhala2',addS3='$addressSinhala3',district='$district',
  telno='$telno',email='$email',guardianEname='$gnameEnglish',guardianSname='$gnameSinhala',guardianEadd1='$gaddressEnglish1',guardianEadd2='$gaddressEnglish2',
  guardianEadd3='$gaddressEnglish3',guardianSadd1='$gaddressSinhala1',guardianSadd2='$gaddressSinhala2',guardianSadd3='$gaddressSinhala3',appfee='$appFee',
  entryType='$entryType',alAdNo='$alAdNo',alYear='$alYear',zScore='$zScore',gkScore='$gkScore',nicNo='$nicNo',dob='$dob', nikaya='$nikayaID', chapter='$chapterID' WHERE appNo='$appNo'";*/




    // $queryappsubject="UPDATE applicantsubjects SET appNo='[value-1]',subjectCode='[value-3]',result='[value-4]' WHERE quli_Id='$quli_Id'";



    $y = 'n';
    $queryselect = "SELECT * FROM applicantpali WHERE appNo = '$appNo'";
    $resultselect = $db->executeQuery($queryselect);
    while ($resultSet = $db->Next_Record($resultselect)) {
      $y = 'y';
    }

    if ($y == 'y') {
      $querydel2 = "DELETE FROM applicantpali WHERE appNo = '$appNo'";
      $resultdel2 = $db->executeQuery($querydel2);
    }

    if ($code == '') {
    } else {

      $query4 = "INSERT INTO applicantpali SET appNo='$appNo', code='$code', result='$paliresult'";
      $result4 = $db->executeQuery($query4);
    }
    echo "Form processing completed.<br>";


    header("Location: applicant.php?appNo=$appNo&appType=$appType");
    exit();
  }
  /* $query = "SELECT * FROM applicant WHERE appNo='$appNo' AND appType='$appType'";
    $result = $db->executeQuery($query); 

    $query = "SELECT * FROM localapplicant WHERE appNo='$appNo'";
    $result = $db->executeQuery($query);  */

  //quering data
  $queryedit = "SELECT entryYear,titleE,nameEnglish,addressEnglish1,addressEnglish2,
        addressEnglish3,nameSinhala,addS1,addS2,addS3,district,telno,email,guardianEname,
        guardianSname,guardianEadd1,guardianEadd2,guardianEadd3,guardianSadd1,guardianSadd2,
        guardianSadd3,appfee,entryType,alAdNo,alYear,zScore,gkScore,nicNo,dob,nikaya,chapter,
        quli_year ,quli_id,stream,applicationNo
        FROM applicant JOIN localapplicant ON applicant.appNo = localapplicant.appNo  
        JOIN applicantquli ON applicant.appNo = applicantquli.appNo and applicantquli.quli_id='1'
        WHERE applicant.appNo='$appNo' AND applicant.appType='$appType'";

  $resultedit = $db->executeQuery($queryedit);

  // while ($row = $db->Next_Record($resultedit)){
  $row = $db->Next_Record($resultedit);

  $nikayaID1 = $row['nikaya'];
  $chapterID1 = $row['chapter'];

  //print $row['entryYear'];
  // print $row['nicNo'];
  // print $chapterID;

?>



  <!-- edit local application is here.. -->

  <h1>Edit Local Applicant Details</h1>
  <form action=" " method="post" name="form1">
    <table border="0" bordercolorlight="#E2E2E2" class="searchResults">
      <input type="hidden" id="form-submitted" name="form-submitted" value="0">

      <tr>
        <td height="25">Application Number: </td>
        <td><input name="txtapplicationNb" type="text" value="<?php echo $row['applicationNo']; ?>" tabindex="3" size="20" /></td>
      </tr>
      <tr>
        <td height="28">Nikaya Name:</td>
        <td>
          <select name="nikayaName" id="nikayaName" required>
            <option <?php if ($row['nikaya'] == '0') echo "selected='selected'"; ?>>- Not Applicable -</option>
            <option <?php if ($row['nikaya'] == '2') echo "selected='selected'"; ?>>ස්‍යාමෝපාලි මහ නිකාය</option>
            <option <?php if ($row['nikaya'] == '3') echo "selected='selected'"; ?>>ශ්‍රී ලංකා අමරපුර මහානිකාය</option>
            <option <?php if ($row['nikaya'] == '4') echo "selected='selected'"; ?>>ශ්‍රී ලංකා රාමඤ්ඤ මහානිකාය</option>
          </select>
        </td>
      </tr>

      <tr>
        <td height="28">Chapter Name: </td>
        <td>
          <select name="capteraName" id="capteraName" weight="50">
            <?php
            $queryeditabc = "SELECT nikaya,chapter FROM applicant JOIN localapplicant ON applicant.appNo = localapplicant.appNo  WHERE applicant.appNo='$appNo' AND applicant.appType='$appType'";
            $resulteditabc = $db->executeQuery($queryeditabc);
            while ($rowabc = $db->Next_Record($resulteditabc)) {
              $nikayaID1 = $row['nikaya'];
              $chapterID1 = $row['chapter'];
            }
            $queryc = "SELECT * FROM `chapter` ";
            $resultc = $db->executeQuery($queryc);

            while ($rown = $db->Next_Record($resultc)) {

              if ($rown['chapterID'] == $chapterID1) {
                echo '<option value="' . $rown['chapterID'] . '" selected="selected">' . $rown['chapterID'] . ' - ' . $rown['chapter'] . '</option>';
              } else {
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
              for ($i = 1990; $i < 2100; $i++) {
                if ($row['entryYear'] == $i) {
                  echo "<option selected='selected' value=\"" . $i . "\">" . $i . "</option>";
                } else {
                  echo "<option value=\"" . $i . "\">" . $i . "</option>";
                }
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
        <td><input name="txtbd" type="date" value="<?php echo $row['dob']; ?>" tabindex="3" size="20" /></td>
      </tr>

      <tr>
        <td height="39">Title </td>
        <td><select name="lstTitle" id="lstTitle" tabindex="5">
            <option <?php if ($row['titleE'] == 'Ven.') echo "selected='selected'"; ?>>Ven.</option>
            <option <?php if ($row['titleE'] == 'Mr.') echo "selected='selected'"; ?>>Mr.</option>
            <option <?php if ($row['titleE'] == 'Ms.') echo "selected='selected'"; ?>>Ms.</option>
          </select></td>
      </tr>

      <tr>
        <td height="49">Name </td>
        <td><label>
            <input type="text" name="txtNameE" id="txtNameE" value="<?php echo $row['nameEnglish']; ?>" tabindex="5" size="50" />
          </label></td>
      </tr>

      <tr>
        <td height="45">
          <p>&#3505;&#3512;</p>
        </td>
        <td><label>
            <input name="txtNameS" type="text" tabindex="7" value="<?php echo $row['nameSinhala']; ?>" size="50" />
          </label></td>
      </tr>

      <tr>
        <td height="37"> Address - No</td>
        <td><label>
            <input name="txtaddE1" type="text" value="<?php echo $row['addressEnglish1']; ?>" size="20" tabindex="8" />
          </label></td>
      </tr>
      <tr>
        <td height="45">
          <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Street </font></pre>
        </td>
        <td><input name="txtaddE2" type="text" value="<?php echo $row['addressEnglish2']; ?>" size="40" tabindex="9" /></td>
      </tr>
      <tr>
        <td height="45">
          <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Town</font></pre>
        </td>
        <td><input name="txtaddE3" type="text" value="<?php echo $row['addressEnglish3']; ?>" size="40" tabindex="10" /></td>
      </tr>

      <tr>
        <td height="50">
          <font face="KaputaUnicode" size="2">&#3517;&#3538;&#3508;&#3538;&#3505;&#3514;-&#3461;&#3458;&#3482;&#3514;
        </td>
        <td><input name="txtaddS1" type="text" value="<?php echo $row['addS1']; ?>" size="20" tabindex="11" /></td>
      </tr>
      <tr>
        <td height="48">
          <font face="KaputaUnicode" size="2">
            <pre>    &#3520;&#3539;&#3503;&#3538;&#3514;<pre/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
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
          while ($resultSet = $db->Next_Record($result)) {
            $id = $resultSet["id"];
            $district = $resultSet["districtEnglish"];
            if ($row['district'] == $district)
              echo "<option selected='selected' value=\"" . $district . "\">" . $district . "</option>";

            else echo "<option value=\"" . $district . "\">" . $district . "</option>";
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
          <td height="25"> <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Street </font></pre>
        </td>
        <td><input name="txtaddGE2" type="text" size="40" value="<?php echo $row['guardianEadd2']; ?>" tabindex="14" /></td>
      </tr>
      <tr>
        <td height="25">
          <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Town</font></pre>
        </td>
        <td><input name="txtaddGE3" type="text" size="40" value="<?php echo $row['guardianEadd3']; ?>" tabindex="15" /></td>
      </tr>
      <tr>
        <td height="25">
          <font face="KaputaUnicode" size="2">&#3517;&#3538;&#3508;&#3538;&#3505;&#3514;-&#3461;&#3458;&#3482;&#3514;
        </td>
        <td><input name="txtaddGS1" type="text" size="20" value="<?php echo $row['guardianSadd1']; ?>" tabindex="16" /></td>
      </tr>
      <tr>
        <td height="25">
          <font face="KaputaUnicode" size="2">
            <pre>    &#3520;&#3539;&#3503;&#3538;&#3514;<pre/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
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
              <option <?php if ($row['appfee'] == 'Paid') echo "selected='selected'"; ?> >Paid</option>
              <option <?php if ($row['appfee'] == 'Not Paid') echo "selected='selected'"; ?> > Not Paid</option>
                </select></td>
        </tr>
        <?php
        $queryAL1 = "SELECT * FROM applicantsubjects JOIN alsubjects ON applicantsubjects.subjectCode = alsubjects.subjectCode
          WHERE appNo = '$appNo' and  applicantsubjects.quli_Id='1' ";
        //print $queryAL;
        $resultAL1 = $db->executeQuery($queryAL1);
        $queryquliALvalues = "SELECT * FROM applicantquli  WHERE appNo = '$appNo' and  applicantquli.quli_id='1' ";
        $resultquliALvalues = $db->executeQuery($queryquliALvalues);
        while ($resultSetquli1 = $db->Next_Record($resultquliALvalues)) {
          $a = $resultSetquli1['indexNo'];
          $b = $resultSetquli1['quli_year'];
          $c = $resultSetquli1['medium'];
          $s1 = $resultSetquli1['stream'];
          $d = $resultSetquli1['quli_id'];
          
          $queryqulistream = "SELECT * FROM alstream  WHERE streamId = '$s1' ";

          $resultqulistream = $db->executeQuery($queryqulistream);
          while ($resultSetstream = $db->Next_Record($resultqulistream)) {
            $streamdes = $resultSetstream['description'];
          }
        }

        //  A/L Subject Result=========================================================================================================================
        ?> 
        <tr>
          <td height="25" style="font-weight:bolder">A/L Subject Results</td>
        </tr>
        <tr>
        <td>Admission No : </td>
        <td>
        <?php if ($d == 1) { ?>
            <input name="txtA_LAddmision" type="text" value="<?php echo $a; ?>">
            <?php } else { ?>
              <input name="txtA_LAddmision" type="text" value="" placeholder="- Not Applicable -">
              <?php } ?>
        </td>
      </tr>
        <tr>
          <td height="25">A/L Year</td>
          <td>
            <select name="lstAlYear" id="lstYear" tabindex="16">
            <option selected='selected'>- Not Selected -</option>
           
          <?php

          if ($d == 1) {
            for ($i = 1990; $i < 2100; $i++) {

              if ($row['alYear'] == $i) {
                echo "<option selected='selected' value=\"" . $i . "\">" . $i . "</option>";
              }
              echo "<option value=\"" . $i . "\">" . $i . "</option>";
            }
          } else {
            for ($i = 1990; $i < 2100; $i++) {
              echo "<option value=\"" . $i . "\">" . $i . "</option>";
            }
          }
          ?>
        </select></td>
        </tr>
         
        <tr>
          <td height="25"> Medium </td>
          <td>
            <select name="mediumAL" id="mediumAL" tabindex="14" >
            <option selected='selected' name='1medium0'>- Not Selected -</option>
               
              <?php if ($d == 1) { ?>
              <option <?php if ($c == 's') echo "selected='selected'"; ?>> Sinhala</option>
              <option <?php if ($c == 'e') echo "selected='selected'"; ?>>English</option>
              
              <?php } else { ?>
                <option name='1medium1'>English</option>
                <option name='1medium2'>Sinhala</option>
                  <?php } ?>
              </select></td>
        </tr>
      
        <tr>
          <td height="25">Stream</td>
          <!-- &#3508;&#3515;&#3538;&#3508;&#3535;&#3517;&#3505; &#3503;&#3538;&#3523;&#3530;&#3501;&#3538;&#3482;&#3530;&#3482;&#3514;</td> -->
          
          <td>
            <select name="txtstream" id="txtstream" tabindex="13" onChange="subjectFilter(this.value)">
              <option value="0">- Not Selected -</option>
              <?php

              $query = "SELECT * FROM alstream ";
              $result = $db->executeQuery($query);

              while ($resultSet = $db->Next_Record($result)) {
                $streamId = $resultSet["streamId"];
                $description = $resultSet["description"];
                if ($d == 1) {
                  if ($s1 == $streamId) {
                    echo "<option selected='selected' value=\"" . $streamId . "\">" . $description;
                  } else {
                    echo "<option  value=\"" . $streamId . "\">" . $description;
                  }
                } else {

                  //echo "<option >- Not selected -</option>";


                  echo "<option value=\"" . $streamId . "\">" . $description . "</option>";
                }
              }
              ?>
            </select>
          </td>
        </tr> 

        <tr>
          <td height="25">Z-Score </td>
          <td>
            <label>
            <?php if ($d == 1) { ?>
              <input name="txtZScore" type="text" value="<?php echo $row['zScore']; ?>"  tabindex="17" size="20" />
              <?php } else { ?>
                <input name="txtZScore" type="text" value=""  tabindex="17" size="20" placeholder="- Not Applicable -" />
                <?php } ?>
            </label>
          </td>
        </tr>
        <tr>
          <td height="25">General Knowladge Score</td>
          <td>
            <label>
              <?php if ($d == 1) { ?>
                <input name="txtGKScore" type="text" value="<?php echo $row['gkScore']; ?>"  size="20" tabindex="18" />
                <?php } else { ?>
                  <input name="txtGKScore" type="text" value=""  size="20" tabindex="18" placeholder="- Not Applicable -" />
                <?php } ?>
           </label>
          </td>
        </tr>
      

        <tr>
          <td height="25" colspan="2">

        <?php
        $queryAL = "SELECT * FROM applicantsubjects JOIN alsubjects ON applicantsubjects.subjectCode = alsubjects.subjectCode  WHERE appNo = '$appNo' and  applicantsubjects.quli_Id='1' ";
        //print $queryAL;
        $resultAL = $db->executeQuery($queryAL);
        //print_r($resultAL);

        ?>

        <?php
        //echo($row['quli_id']);
        if ($d == 1) {
        ?>
            <table width="275" border="1" id="tblpali">
            <tr>
            <td colspan="2">
              <table width="223" height="124" border="1" >
                  <tr>
                    <th width="150" scope="col">Subject Name</th>
                    <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
                  </tr>
            <?php
            $strmId = $row['stream'];

            // for ($j = 1; $j <= 3; $j++) {
            $j = 1;
            while ($resultSet = $db->Next_Record($resultAL)) {


              $rSubjectCode  = $resultSet["subjectCode"];
              $rSubject = $resultSet["subnameE"];
              $rresult = $resultSet["result"];

              $query1 = "SELECT * FROM alsubjects where streamId = $strmId";
              $result = $db->executeQuery($query1);

              echo "<tr><td>";
              //print_r($result);
              echo "<div id='Subject" . $j . "'> 
                          <select name='1stSub" . $j . "' id='1stSub" . $j . "' tabindex='20' 
                          onChange='subjectchecker1(" . $j . ")'>
                          <option value='0'>- Not Selected -</option>";



              while ($subrow = $db->Next_Record($result)) {
                $rSubjectCode1  = $subrow["subjectCode"];
                $rSubject1 = $subrow["subnameE"];
                if ($rSubjectCode1 == $rSubjectCode) {
                  echo "<option selected='selected'  value=\"" . $rSubjectCode1 . "\">" . $rSubject1;
                } else {
                  echo "<option  value=\"" . $rSubjectCode1 . "\">" . $rSubject1;
                }
              }

            ?>
                  </select></div> </td>

                  <?php echo " <td>
                        <select name= '1stResult" . $j . "' id= '1stResult" . $j . "' tabindex='21'>"; ?>
                              <option>-Grade-</option>
                              <option <?php if ($rresult == 'A') echo "selected='selected'"; ?>>A</option>
                              <option <?php if ($rresult == 'B') echo "selected='selected'"; ?>>B</option>
                              <option <?php if ($rresult == 'C') echo "selected='selected'"; ?>>C</option>
                              <option <?php if ($rresult == 'S') echo "selected='selected'"; ?>>S</option>
                              <option <?php if ($rresult == 'F') echo "selected='selected'"; ?>>F</option>
                          </select></td>
                          </tr>

                  <?php
                  $j++;
                }

                // }
                  ?>
                  <?php
                  // Add additional empty rows (if no records are found or to add more options)
                  for ($i = $j; $i <= 3; $i++) { ?>
              <tr>
                <td>
                  <div id='Subject<?= $i; ?>'>
                    <select name='1stSub<?= $i; ?>' id='1stSub<?= $i; ?>' tabindex='20' onChange='subjectchecker1(<?= $j; ?>)'>
                      <option value='0'>- Not Selected -</option>
                      <?php
                      // Fetch all available subjects for qualification ID 5
                      $query = "SELECT * FROM alsubjects WHERE quli_id=1";
                      $result = $db->executeQuery($query);

                      while ($resultSet1 = $db->Next_Record($result)) {
                        $subCode = $resultSet1["subjectCode"];
                        $sub = $resultSet1["subnameE"];
                        echo "<option value=\"$subCode\">$sub</option>";
                      }
                      ?>
                    </select>
                  </div>
                </td>
                <td>
                  <select name='1stResult<?= $i; ?>' tabindex='21'>
                    <option>- Grade -</option>
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>S</option>
                    <option>F</option>
                  </select>
                </td>
              </tr>
            <?php } ?>  
              </table>
            </td>
            </tr>
            
          </table>    
          <?php
        } else { ?>
                <tr>
              <td height="25">Subject Results</td>           
              <tr>
              <td colspan="2">
              <table width="223" height="124" border="1" >
              <tr>
                <th width="150" scope="col">Subject Name</th>
                <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
              </tr>
          
            <?php
            // $j=1;
            for ($j = 1; $j <= 3; $j++) {

              echo "<tr>
                      <td>
                        <div id='Subject" . $j . "'> 
                          <select name='1stSub" . $j . "' id='1stSub" . $j . "' tabindex='20' 
                          onChange='subjectchecker1(" . $j . ")'>
                          <option value='0'>- Not Selected -</option>";
            ?>
                      </select>
                    </div> 
                  </td>
              <?php
              echo " <td>
                    <select name= '1stResult" . $j . "' id= '1stResult" . $j . "' tabindex='21'>"; ?>
                          <option>-Grade-</option>
                          <option value="A">A</option>
                          <option value="B">B</option>
                          <option value="C">C</option>
                          <option value="S">S</option>
                          <option value="F">F</option>
                        </select>
                      </td>
                      </tr>
              <?php
              // $y++;
            } ?>
         
        </table>         
              </td>
            </tr>
            </td></tr>
            <?php
          }
          //Prachina madyama==========================================================================================================================================================================
            ?>
        
        <tr>
        <td height="25" style="font-weight:bolder">
          Prachina Madayama Subject Results</td>
      </tr>
      <?php
      $queryquli5 = "SELECT * FROM applicantquli  WHERE appNo = '$appNo' and  applicantquli.quli_id='5' ";
      //print $queryquli5;
      $resultquli5 = $db->executeQuery($queryquli5);
      while ($resultSetquli5 = $db->Next_Record($resultquli5)) {
        $a1 = $resultSetquli5['indexNo'];
        $b1 = $resultSetquli5['quli_year'];
        $c1 = $resultSetquli5['medium'];
        $d1 = $resultSetquli5['quli_id'];


        //$c1=$resultSetquli5['medium'];
      }
      ?>
      <tr>
        <td>Admission No : </td>
        <td>
        <?php if ($d1 == 5) { ?>
            <input name="txtA_LAddmision1" type="text" value="<?php echo $a1; ?>">
            <?php } else { ?>
              <input name="txtA_LAddmision1" type="text" value="" placeholder="- Not Applicable -">
              <?php } ?>
        </td>
      </tr>
      <tr>
        <td>Year : </td>
        <td>
          <select name="prachinaMadyamaYear" id="prachinaMadyamaYear" tabindex="16">
          <option  name='2year0'>- Not Selected -</option>
                
        <?php
        if ($d1 == 5) {
          for ($i = 1990; $i < 2100; $i++) {

            if ($row['quli_year'] == $i) {
              echo "<option selected='selected' value=\"" . $i . "\">" . $i . "</option>";
            }
            echo "<option value=\"" . $i . "\">" . $i . "</option>";
          }
        } else {
          for ($i = 1990; $i < 2100; $i++) {
            echo "<option value=\"" . $i . "\">" . $i . "</option>";
          }
        }
        ?>
      </tr>
      <tr>
        <td>Medium </td>
        <td> 
          <select name="mediumPrachinaMadyama" id="mediumPrachinaMadyama">
          <option  name='2medium0'>- Not Selected -</option>
                
          <?php if ($d1 == 5) { ?>
              <option <?php if ($c1 == 's') echo "selected='selected'"; ?>> Sinhala</option>
              <option <?php if ($c1 == 'e') echo "selected='selected'"; ?>>English</option>
              
              <?php } else { ?>
                <option name='2medium1'>English</option>
                <option name='2medium2'>Sinhala</option>
                 <?php } ?>
           </select>
         </td>
      </tr>
      
    

      <tr>
        <td height="25" colspan="2">

     

      <table width="275" border="1" id="tblpali">
      <tr>
      <td colspan="2">
        <?php
        //Selects all the data contained in the selection
        if ($d1 == 5) { ?>
          <table width="223" height="124" border="1" >
            <tr>
              <th width="150" scope="col">Subject Name</th>
              <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
          </tr>

          <?php

          $queryAL5 = "SELECT * FROM applicantsubjects JOIN alsubjects ON applicantsubjects.subjectCode = alsubjects.subjectCode  WHERE appNo = '$appNo' and  applicantsubjects.quli_Id = 5 ";
          //print $queryAL;
          $resultAL5 = $db->executeQuery($queryAL5);


          //for ($j = 1; $j <= 1; $j++) {
          $j = 1;
          while ($resultSet = $db->Next_Record($resultAL5)) {

            $rSubjectCode  = $resultSet["subjectCode"];
            $rSubject = $resultSet["subnameE"];
            $rresult = $resultSet["result"];
            // echo  $rSubject . "=>" . $rresult;

            echo " <tr><td>
              <div id='Subject" . $j . "'>
                     <select name='2ndSub" . $j . "' id='2ndSub" . $j . "' tabindex='20'
                      onChange='subjectchecker2(" . $j . ")'>
                     <option value='0'>- Not Selected -</option>";

            $query = "SELECT * FROM alsubjects where quli_id=5";
            $result = $db->executeQuery($query);

            while ($resultSet1 = $db->Next_Record($result)) {
              $subCode = $resultSet1["subjectCode"];
              $sub = $resultSet1["subnameE"];
              if ($rSubjectCode == $subCode) {
                echo "<option selected='selected' value=\"" . $subCode . "\">" . $sub . "</option>";
              } else {
                echo "<option value=\"" . $subCode . "\" >" . $sub . "</option>";
              }
            }
          ?>
                
                </select></div> </td>

                <?php echo " <td>
                      <select name= '2ndResult" . $j . "'tabindex='21'>"; ?>
                            <option>- Grade -</option>
                            <option <?php if ($rresult == 'A') echo "selected='selected'"; ?>>A</option>
                            <option <?php if ($rresult == 'B') echo "selected='selected'"; ?>>B</option>
                            <option <?php if ($rresult == 'C') echo "selected='selected'"; ?>>C</option>
                            <option <?php if ($rresult == 'S') echo "selected='selected'"; ?>>S</option>
                            <option <?php if ($rresult == 'F') echo "selected='selected'"; ?>>F</option>
                        </select></td>
                        </tr>

                <?php
                $j++;
              }
              // Add additional empty rows (if no records are found or to add more options)
              for ($i = $j; $i <= 3; $i++) { ?>
              <tr>
                <td>
                  <div id='Subject<?= $i; ?>'>
                    <select name='2ndSub<?= $i; ?>' id='2ndSub<?= $i; ?>' tabindex='20' onChange='subjectchecker2(<?= $j; ?>)'>
                      <option value='0'>- Not Selected -</option>
                      <?php
                      // Fetch all available subjects for qualification ID 5
                      $query = "SELECT * FROM alsubjects WHERE quli_id=5";
                      $result = $db->executeQuery($query);

                      while ($resultSet1 = $db->Next_Record($result)) {
                        $subCode = $resultSet1["subjectCode"];
                        $sub = $resultSet1["subnameE"];
                        echo "<option value=\"$subCode\">$sub</option>";
                      }
                      ?>
                    </select>
                  </div>
                </td>
                <td>
                  <select name='2ndResult<?= $i; ?>' tabindex='21'>
                    <option>- Grade -</option>
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>S</option>
                    <option>F</option>
                  </select>
                </td>
              </tr>
            <?php } ?>  
				</table>
          <?php } else { ?>
            <table width="223" height="124" border="1" >
            <tr>
              <th width="150" scope="col">Subject Name</th>
              <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
          </tr>
         
          <?php
          for ($j = 1; $j <= 3; $j++) {

            echo "
                  <tr>
                    <td><div id='Subject" . $j . "'>
                    <select name='2ndSub" . $j . "' id='2ndSub" . $j .  "' tabindex='20'  
                    onChange='subjectchecker2(" . $j . ")'>";
          ?>
                <option value='0'>- Select Subject- </option>
                    
                    <?php

                    $query = "SELECT * FROM alsubjects where quli_id='5'";
                    $result = $db->executeQuery($query);

                    while ($resultSet = $db->Next_Record($result)) {
                      $rSubjectCode  = $resultSet["subjectCode"];
                      $rSubject = $resultSet["subnameE"];

                      echo "<option value=\"" . $rSubjectCode . "\"onChange='subjectchecker(" . $j . ")'>" . $rSubject . "</option>";
                    } ?>
            
                    </select></div> </td>
            <?php
            echo " <td>
                   <select name= '2ndResult" . $j . "' tabindex='21'>"; ?>
                        <option>-Grade-</option>
                        <option value="A">A</option>
                        <option  value="B">B</option>
                        <option  value="C">C</option>
                        <option  value="S">S</option>
                        <option  value="F">F</option>
                                      </select>
                    </td>
                    </tr>
            <?php

          }


            ?>
          
         
        </table>
          <?php } ?>
				  </td>
				  </tr>   
        </table>    
        </td></tr>
        <?php
        //Prachina prarambha==========================================================================================================================================================================
        ?>
        <tr>
        <td height="25" style="font-weight:bolder">Prachina Praramba Subject Results</td>
      </tr>
      <?php
      $queryAL6 = "SELECT * FROM applicantsubjects JOIN alsubjects ON applicantsubjects.subjectCode = alsubjects.subjectCode  WHERE appNo = '$appNo' and  applicantsubjects.quli_Id='6' ";
      //print $queryAL;
      $resultAL6 = $db->executeQuery($queryAL6);
      $queryquli6 = "SELECT * FROM applicantquli  WHERE appNo = '$appNo' and  applicantquli.quli_id='6' ";
      //print $queryquli5;
      $resultquli6 = $db->executeQuery($queryquli6);
      while ($resultSetquli6 = $db->Next_Record($resultquli6)) {
        $a2 = $resultSetquli6['indexNo'];
        $b2 = $resultSetquli6['quli_year'];
        $c2 = $resultSetquli6['medium'];
        $d2 = $resultSetquli6['quli_id'];
        //$c1=$resultSetquli5['medium'];
      }
      ?>
      <tr>
        <td>Admission No : </td>
        <td>
        <?php if ($d2 == 6) { ?>
            <input name="txtA_LAddmision2" type="text" value="<?php echo $a2; ?>">
            <?php } else { ?>
              <input name="txtA_LAddmision2" type="text" value="" placeholder="- Not Applicable -">
              <?php } ?>  
        </td>
      </tr>
      <tr>
        <td>Year : </td>
        <td>
          <select name="prachinaPrarambaYear" id="prachinaPrarambaYear" tabindex="16">
          <option>- Not Selected -</option>
        <?php
        if ($d2 == 6) {
          for ($i = 1990; $i < 2100; $i++) {

            if ($row['quli_year'] == $i) {
              echo "<option selected='selected' value=\"" . $i . "\">" . $i . "</option>";
            }
            echo "<option value=\"" . $i . "\">" . $i . "</option>";
          }
        } else {
          echo "<option selected='selected'>" . "- Not Selected -" . "</option>";
          for ($i = 1990; $i < 2100; $i++) {
            echo "<option value=\"" . $i . "\">" . $i . "</option>";
          }
        }
        ?>
        </select></td>
      </tr>
      <tr>
        <td>Medium </td><td>
          <select name="mediumPrachinaPraramba" id="mediumPrachinaPraramba">
          <option>- Not Selected -</option>
          <?php if ($d2 == 6) { ?>
              <option <?php if ($c == 's') echo "selected='selected'"; ?>> Sinhala</option>
              <option <?php if ($c == 'e') echo "selected='selected'"; ?>>English</option>
              
              <?php } else { ?>
       
                <option name='3medium1'>English</option>
                <option name='3medium2'>Sinhala</option>
                  <?php } ?>
           </select></td>
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
      <td colspan="2">
        
				  
          <?php if ($d2 == 6) { ?>
            <table width="223" height="124" border="1" >
            <tr>
              <th width="150" scope="col">Subject Name</th>
              <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
          </tr>
		 <?php


            //  for ($j = 1; $j <= 1; $j++) {
            $j = 1;
            while ($resultSet = $db->Next_Record($resultAL6)) {

              $rSubjectCode  = $resultSet["subjectCode"];
              $rSubject = $resultSet["subnameE"];
              $rresult = $resultSet["result"];
              // echo  $rSubject . "=>" . $rresult;
              echo " <tr>
                      <td><div id='Subject" . $j . "'>
                       <select name='3rdSub" . $j . "' id='3rdSub" . $j . "' tabindex='20' onChange='subjectchecker3(" . $j . ")'>
                       <option value='0'>- Select Subject -</option>";

              $query = "SELECT * FROM alsubjects where quli_id=6";
              $result = $db->executeQuery($query);

              while ($resultSet1 = $db->Next_Record($result)) {
                $subCode = $resultSet1["subjectCode"];
                $sub = $resultSet1["subnameE"];
                if ($rSubjectCode == $subCode) {
                  echo "<option selected='selected' value=\"" . $subCode . "\">" . $sub . "</option>";
                } else {
                  echo "<option value=\"" . $subCode . "\" >" . $sub . "</option>";
                }
              }




      ?>
            
            </select></div> </td>

            <?php echo " <td>
                   <select name= '3rdResult" . $j . "'tabindex='21'>"; ?>
                        <option>- Grade -</option>
                        <option <?php if ($rresult == 'A') echo "selected='selected'"; ?>>A</option>
                        <option <?php if ($rresult == 'B') echo "selected='selected'"; ?>>B</option>
                        <option <?php if ($rresult == 'C') echo "selected='selected'"; ?>>C</option>
                        <option <?php if ($rresult == 'S') echo "selected='selected'"; ?>>S</option>
                        <option <?php if ($rresult == 'F') echo "selected='selected'"; ?>>F</option>
                    </select></td>
                    </tr>

            <?php
              $j++;
            }

            // Add additional empty rows (if no records are found or to add more options)
            for ($i = $j; $i <= 3; $i++) { ?>
              <tr>
                <td>
                  <div id='Subject<?= $i; ?>'>
                    <select name='3rdSub<?= $i; ?>' id='3rdSub<?= $i; ?>' tabindex='20' onChange='subjectchecker3(<?= $j; ?>)'>
                      <option value='0'>- Not Selected -</option>
                      <?php
                      // Fetch all available subjects for qualification ID 5
                      $query = "SELECT * FROM alsubjects WHERE quli_id=6";
                      $result = $db->executeQuery($query);

                      while ($resultSet1 = $db->Next_Record($result)) {
                        $subCode = $resultSet1["subjectCode"];
                        $sub = $resultSet1["subnameE"];
                        echo "<option value=\"$subCode\">$sub</option>";
                      }
                      ?>
                    </select>
                  </div>
                </td>
                <td>
                  <select name='3rdResult<?= $i; ?>' tabindex='21'>
                    <option>- Grade -</option>
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>S</option>
                    <option>F</option>
                  </select>
                </td>
              </tr>
            <?php } ?>  
				</table>
          <?php } else { ?>
            <table width="223" height="124" border="1" >
            <tr>
              <th width="150" scope="col">Subject Name</th>
              <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
          </tr>
         
          <?php for ($j = 1; $j <= 3; $j++) {

              echo "
                  <tr>
                    <td><div id='Subject" . $j . "'>
                     <select name='3rdSub" . $j . "' id='3rdSub" . $j . "'  onChange='subjectchecker3(" . $j . ")' tabindex='20'>";
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
                   <select name= '3rdResult" . $j . "' tabindex='21'>"; ?>
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
          
         
        </table> 
            <?php } ?>          

            </td></tr>
        </table>    
        </td></tr>
        
      <?php
      //Vidyodaya======================================================================================================================================================================================
      ?>  
     <tr>
        <td height="25" style="font-weight:bolder">Vidyodaya Subject Results</td>
      </tr>
      <?php
      $queryAL7 = "SELECT * FROM applicantsubjects JOIN alsubjects ON applicantsubjects.subjectCode = alsubjects.subjectCode  WHERE appNo = '$appNo' and  applicantsubjects.quli_Id='7' ";
      //print $queryAL;
      $resultAL7 = $db->executeQuery($queryAL7);
      $queryquli7 = "SELECT * FROM applicantquli  WHERE appNo = '$appNo' and  applicantquli.quli_id='7' ";
      //print $queryquli5;
      $resultquli7 = $db->executeQuery($queryquli7);
      while ($resultSetquli7 = $db->Next_Record($resultquli7)) {
        $a3 = $resultSetquli7['indexNo'];
        $b3 = $resultSetquli7['quli_year'];
        $c3 = $resultSetquli7['medium'];
        $d3 = $resultSetquli7['quli_id'];

        //$c1=$resultSetquli5['medium'];
      }
      ?>
      <tr>
    	  <td>Admission No : </td>
        <td> 
        <?php if ($d3 == 7) { ?>
            <input name="txtA_LAddmision3" type="text" value="<?php echo $a3; ?>">
            <?php } else { ?>
              <input name="txtA_LAddmision3" type="text" value="" placeholder="- Not Applicable -">
              <?php } ?>
        </td>
      </tr>
      <tr>
        <td>Year : </td>
        <td><select name="VidyodayaYear" id="VidyodayaYear" tabindex="16">
        <option>- Not Selected -</option>
          <?php
          if ($d3 == 7) {
            for ($i = 1990; $i < 2100; $i++) {

              if ($row['quli_year'] == $i) {
                echo "<option selected='selected' value=\"" . $i . "\">" . $i . "</option>";
              }
              echo "<option value=\"" . $i . "\">" . $i . "</option>";
            }
          } else {
            for ($i = 1990; $i < 2100; $i++) {
              echo "<option value=\"" . $i . "\">" . $i . "</option>";
            }
          }
          ?>
      </tr>
      <tr>
        <td>Medium </td>
        <td>
          <select name="mediumVidyodaya" id="mediumVidyodaya">
          <option  name='4medium0'>- Not Selected -</option>

          <?php if ($d3 == 7) { ?>
              <option <?php if ($c == 's') echo "selected='selected'"; ?>> Sinhala</option>
              <option <?php if ($c == 'e') echo "selected='selected'"; ?>>English</option>
              
              <?php } else { ?>
                  <option name='4medium1'>English</option>
                <option name='4medium2'>Sinhala</option>
                 <?php } ?>
           </select>
        </td>
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
      <td colspan="2">
        <?php if ($d3 == 7) { ?>
          <table width="223" height="124" border="1" >
            <tr>
              <th width="150" scope="col">Subject Name</th>
              <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
          </tr>
		 <?php



          //for ($j = 1; $j <= 1; $j++) {
          $j = 1;
          while ($resultSet = $db->Next_Record($resultAL7)) {

            $rSubjectCode  = $resultSet["subjectCode"];
            $rSubject = $resultSet["subnameE"];
            $rresult = $resultSet["result"];
            // echo  $rSubject . "=>" . $rresult;
            echo " <tr>
                  <td><div id='Subject" . $j . "'>
                   <select name='4thSub" . $j . "' id='4thSub" . $j . "' tabindex='20' 
                   onChange='subjectchecker4(" . $j . ")'>
                   <option value = 0>- Select Subject -</option>";

            $query = "SELECT * FROM alsubjects where quli_id=7";
            $result = $db->executeQuery($query);

            while ($resultSet1 = $db->Next_Record($result)) {
              $subCode = $resultSet1["subjectCode"];
              $sub = $resultSet1["subnameE"];
              if ($rSubjectCode == $subCode) {
                echo "<option selected='selected' value=\"" . $subCode . "\">" . $sub . "</option>";
              } else {
                echo "<option value=\"" . $subCode . "\" >" . $sub . "</option>";
              }


              /*  else {
  
      echo "<option value=\"".$subCode."\">".$sub."</option>"; 
     // echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
     } */
            }




    ?>
          
          </select></div> </td>

          <?php echo " <td>
                 <select name= '4thResult" . $j . "'tabindex='21'>"; ?>
                      <option>- Grade -</option>
                      <option <?php if ($rresult == 'A') echo "selected='selected'"; ?>>A</option>
                      <option <?php if ($rresult == 'B') echo "selected='selected'"; ?>>B</option>
                      <option <?php if ($rresult == 'C') echo "selected='selected'"; ?>>C</option>
                      <option <?php if ($rresult == 'S') echo "selected='selected'"; ?>>S</option>
                      <option <?php if ($rresult == 'F') echo "selected='selected'"; ?>>F</option>
                  </select></td>
                  </tr>

          <?php
            $j++;
          }
          // Add additional empty rows (if no records are found or to add more options)
          for ($i = $j; $i <= 3; $i++) { ?>
              <tr>
                <td>
                  <div id='Subject<?= $i; ?>'>
                    <select name='4thSub<?= $i; ?>' id='4thSub<?= $i; ?>' tabindex='20' onChange='subjectchecker4(<?= $i; ?>)'>
                      <option value='0'>- Select Subject -</option>
                      <?php
                      // Fetch all available subjects for qualification ID 7
                      $query = "SELECT * FROM alsubjects WHERE quli_id= 7";
                      $result7 = $db->executeQuery($query);

                      while ($resultSet1 = $db->Next_Record($result7)) {
                        $subCode = $resultSet1["subjectCode"];
                        $sub = $resultSet1["subnameE"];
                        echo "<option value=\"$subCode\">$sub</option>";
                      }
                      ?>
                    </select>
                  </div>
                </td>
                <td>
                  <select name='4thResult<?= $i; ?>' tabindex='21'>
                    <option>- Grade -</option>
                    <option>A</option>
                    <option>B</option>
                    <option>C</option>
                    <option>S</option>
                    <option>F</option>
                  </select>
                </td>
              </tr>
            <?php } ?>  
				</table>
        <?php } else { ?>
          <table width="223" height="124" border="1" >
            <tr>
              <th width="150" scope="col">Subject Name</th>
              <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
          </tr>
         
          <?php
          for ($j = 1; $j <= 3; $j++) {

            echo "
                  <tr>
                    <td><div id='Subject" . $j . "'> 
                    <select name='4thSub" . $j . "' id='4thSub" . $j . "' tabindex='20' onChange='subjectchecker4(" . $j . ")'>";
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
                   <select name= '4thResult" . $j . "' tabindex='21'>"; ?>
                        <option>-Grade-</option>
                        <option value="A">A</option>
                        <option  value="B">B</option>
                        <option  value="C">C</option>
                        <option  value="S">S</option>
                        <option  value="F">F</option>
                                      </select>
                    </td>
                    </tr>
            <?php
          } ?>
          
         
        </table>  
          <?php } ?>
				  </td>
				  </tr>
        </table>    
        </td>
      </tr>

      <?php
      // Vidyalankara =======================================================================================================================================================================================
      ?>
        
        <tr>
        <td height="25" style="font-weight:bolder">Vidyalankara Subject Results</td>
      </tr>
      <?php
      $queryAL8 = "SELECT * FROM applicantsubjects JOIN alsubjects ON applicantsubjects.subjectCode = alsubjects.subjectCode  WHERE appNo = '$appNo' and  applicantsubjects.quli_Id='8' ";
      //print $queryAL;
      $resultAL8 = $db->executeQuery($queryAL8);
      $queryquli8 = "SELECT * FROM applicantquli  WHERE appNo = '$appNo' and  applicantquli.quli_id='8' ";
      //print $queryquli5;
      $resultquli8 = $db->executeQuery($queryquli8);
      while ($resultSetquli8 = $db->Next_Record($resultquli8)) {
        $a4 = $resultSetquli8['indexNo'];
        $b4 = $resultSetquli8['quli_year'];
        $c4 = $resultSetquli8['medium'];
        $d4 = $resultSetquli8['quli_id'];
        //$c1=$resultSetquli5['medium'];
      }
      ?>
      <tr>
        <td>Admission No : </td>
        <td>
          <?php if ($d4 == 8) { ?>
            <input name="txtA_LAddmision4" type="text" value="<?php echo $a4; ?>">
            <?php } else { ?>
              <input name="txtA_LAddmision4" type="text" value="" placeholder="- Not Applicable -">
              <?php } ?>
        </td>
      </tr>
      <tr>
        <td>Year : </td>
        <td><select name="VidyalankaraYear" id="VidyalankaraYear" tabindex="16">
        <option>- Not Selected -</option>
        
        <?php
        if ($d4 == 8) {
          for ($i = 1990; $i < 2100; $i++) {

            if ($row['quli_year'] == $i) {
              echo "<option selected='selected' value=\"" . $i . "\">" . $i . "</option>";
            }
            echo "<option value=\"" . $i . "\">" . $i . "</option>";
          }
        } else {
          for ($i = 1990; $i < 2100; $i++) {
            echo "<option value=\"" . $i . "\">" . $i . "</option>";
          }
        }
        ?>
      </tr>
      <tr>
        <td>Medium </td>
        <td> <select name="mediumVidyalankara" id="mediumVidyalankara">
          <?php if ($d4 == 8) { ?>
              <option <?php if ($c == 's') echo "selected='selected'"; ?>> Sinhala</option>
              <option <?php if ($c == 'e') echo "selected='selected'"; ?>>English</option>
              
              <?php } else { ?>
                <option selected='selected' name='5medium0'>- Not Selected -</option>
                <option name='5medium1'>English</option>
                <option name='5medium2'>Sinhala</option>
                 <?php } ?>
           </select>
          </td>
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
      <td colspan="2">
        <?php if ($d4 == 8) { ?>
          <table width="223" height="124" border="1" >
            <tr>
              <th width="150" scope="col">Subject Name</th>
              <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
          </tr>
		 <?php




          // for ($j = 1; $j <= 1; $j++) {
          $j = 1;
          while ($resultSet = $db->Next_Record($resultAL8)) {

            $rSubjectCode  = $resultSet["subjectCode"];
            $rSubject = $resultSet["subnameE"];
            $rresult = $resultSet["result"];
            // echo  $rSubject . "=>" . $rresult;
            echo " <tr>
              <td><div id='Subject" . $j . "'>
               <select name='5thSub" . $j . "' id='5thSub" . $j . "' tabindex='20' onChange='subjectchecker5(" . $j . ")'>
               <option value='0'>- Select Subject -</option>
               ";

            $query = "SELECT * FROM alsubjects where quli_id= 8";
            $result = $db->executeQuery($query);

            while ($resultSet1 = $db->Next_Record($result)) {
              $subCode = $resultSet1["subjectCode"];
              $sub = $resultSet1["subnameE"];
              if ($rSubjectCode == $subCode) {
                echo "<option selected='selected' value=\"" . $subCode . "\">" . $sub . "</option>";
              } else {
                echo "<option value=\"" . $subCode . "\" >" . $sub . "</option>";
              }
            }

      ?>
      
      </select></div> </td>

            <?php echo " <td>
                   <select name= '5thResult" . $j . "'tabindex='21'>"; ?>
                       <option>-Grade-</option>
                       <option <?php if ($rresult == 'A') echo "selected='selected'"; ?>>A</option>
                        <option <?php if ($rresult == 'B') echo "selected='selected'"; ?>>B</option>
                        <option <?php if ($rresult == 'C') echo "selected='selected'"; ?>>C</option>
                        <option <?php if ($rresult == 'S') echo "selected='selected'"; ?>>S</option>
                        <option <?php if ($rresult == 'F') echo "selected='selected'"; ?>>F</option>
                    </select></td>
                    </tr>

            <?php

            $j++;
          }
          // Add additional empty rows (if no records are found or to add more options)
          for ($i = $j; $i <= 3; $i++) { ?>
            <tr>
              <td>
                <div id='Subject<?= $i; ?>'>
                  <select name='5thSub<?= $i; ?>' id='5thSub<?= $i; ?>' tabindex='20' 
                  onChange='subjectchecker5(<?= $i; ?>)'>
                    <option value='0'>- Not Selected -</option>
                    <?php
                    // Fetch all available subjects for qualification ID 8
                    $query = "SELECT * FROM alsubjects WHERE quli_id=8";
                    $result = $db->executeQuery($query);

                    while ($resultSet1 = $db->Next_Record($result)) {
                      $subCode = $resultSet1["subjectCode"];
                      $sub = $resultSet1["subnameE"];
                      echo "<option value=\"$subCode\">$sub</option>";
                    }
                    ?>
                  </select>
                </div>
              </td>
              <td>
                <select name='5thResult<?= $i; ?>' tabindex='21'>
                  <option>- Grade -</option>
                  <option>A</option>
                  <option>B</option>
                  <option>C</option>
                  <option>S</option>
                  <option>F</option>
                </select>
              </td>
            </tr>
          <?php } ?>  
				</table>
        <?php } else { ?>
          <table width="223" height="124" border="1" >
            <tr>
              <th width="150" scope="col">Subject Name</th>
              <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
          </tr>
         
          <?php for ($j = 1; $j <= 3; $j++) {

            echo "
                  <tr>
                    <td><div id='Subject" . $j . "'> 
                    <select name='5thSub" . $j . "' id='5thSub" . $j . "' tabindex='20' onChange='subjectchecker5(" . $j . ")'>
                    <option value='0'>- Select Subject -</option>";
          ?>
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
                   <select name= '5thResult" . $j . "' tabindex='21'>"; ?>
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
          
         
        </table>   
          <?php } ?>
				  </td>
          </tr>





          
          
        </table>
        </td> </tr>

      <tr>
      <td height="46">
        <font face="Verdana, Arial, Helvetica, sans-serif" size="2">Pali Qualification</font></td>	
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
              $resultPali =  $db->executeQuery($queryPali);
              while ($resultSet = $db->Next_Record($resultPali)) {
                $paliresult1  = $resultSet["result"];
                $paliCode1  = $resultSet["code"];
              }
              $resultPali =  $db->executeQuery($queryPali);
              while ($resultSet1 = $db->Next_Record($result7)) {
                $PaliCode = $resultSet1["code"];

                $Qualification = $resultSet1["qualification"];
                if ($paliCode1 == '') {

                  echo "<option value=\"" . $PaliCode . "\">" . $Qualification . "</option>";
                } elseif ($paliCode1 == $PaliCode) {
                  echo "<option selected='selected' value=\"" . $PaliCode . "\">" . $Qualification . "</option>";
                } else {
                  echo "<option value=\"" . $PaliCode . "\">" . $Qualification . "</option>";
                }
              }
              ?>
             </select></td>
             <?php
              // Ensure $paliresult1 is defined
              if (!isset($paliresult1)) {
                $paliresult1 = ''; // Set a default value if it's not set
              }
              ?>
			<td>
			<?php
      if ($paliresult1 == ' ') {
      ?>
			<input name="txtPResult" type="text" id="txtPResult" tabindex="10" size="15" value="<?php echo " "; ?>"/>
			<?php
      } else {
      ?>
			<input name="txtPResult" type="text" id="txtPResult" tabindex="10" size="15" value="<?php echo $paliresult1; ?>"/>
			<?php }
      ?>
			</td>
			</tr>
			
           </table>



          <tr><td colspan="2">
            <input name="btnCancel" type="button" value="Cancel" onclick="document.location.href='applicant.php';" class="button" />
            <input name="btnAdd" type="submit" value="Save" class="button" >
        </td></tr>

          </table>
      </form>


    <?php
  } //if loop  end

  elseif ($appType == "Foreign") {

    if (isset($_POST['btnAdd'])) {

      $nameEnglish =  $db->cleanInput($_POST['txtNameE']);
      $entryYear = $_POST['lstYearEntry'];
      $titleE = $_POST['lstTitle'];
      $addressEnglish1 = $db->cleanInput($_POST['txtaddE1']);
      $addressEnglish2 = $db->cleanInput($_POST['txtaddE2']);
      $addressEnglish3 = $db->cleanInput($_POST['txtaddE3']);



      $query = "UPDATE applicant SET entryYear='$entryYear',titleE='$titleE',nameEnglish='$nameEnglish',addressEnglish1='$addressEnglish1',addressEnglish2='$addressEnglish2',addressEnglish3='$addressEnglish3' WHERE appNo='$appNo' AND appType='$appType'";
      echo $query;


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
      exit();
    }

    $queryfedit = "SELECT entryYear,titleE,nameEnglish,addressEnglish1,addressEnglish2,addressEnglish3,telno,email,appfee,ppNo,country,exam,indexNo,year,month,paliQf,Nationality,telNo,telNo1,telNo2,gnameE,gadde1,gadde2,gadde3,appfee,gaNameR,rsladde1,rsladde2,rsladde3,RSLtelNo FROM applicant JOIN foreignapplicant ON applicant.appNo = foreignapplicant.appNo WHERE applicant.appNo='$appNo ' AND applicant.appType='Foreign'";
    $resultfedit = $db->executeQuery($queryfedit);
    while ($row = $db->Next_Record($resultfedit)) {


    ?>
  <h1> Edit Foreign Applicant Details</h1>
  <form action="" method="post" name="form1">
    <table border="0" bordercolorlight="#E2E2E2" class="searchResults">
      <tr>
        <td height="48">Year of Entry</td>
        <td><label>
          <select name="lstYearEntry" id="lstYearEntry" tabindex="3">
          <?php
          for ($i = 1990; $i < 2100; $i++) {
            if ($row['entryYear'] == $i)
              echo "<option selected='selected' value=\"" . $i . "\">" . $i . "</option>";
            else echo "<option value=\"" . $i . "\">" . $i . "</option>";
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
			 <option <?php if ($row['titleE'] == 'Ven.') echo "selected='selected'"; ?>>Ven.</option>
			  <option <?php if ($row['titleE'] == 'Mr.') echo "selected='selected'"; ?>>Mr.</option>
			  <option <?php if ($row['titleE'] == 'Ms.') echo "selected='selected'"; ?>>Ms.</option>
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
			<td height="45"> <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Street </font></pre>
        </td>
        <td><input name="txtaddE2" type="text" value="<?php echo $row['addressEnglish2']; ?>" size="40" tabindex="9" /></td>
      </tr>
      <tr>
        <td height="45">
          <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Town</font></pre>
        </td>
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
            <input name="txtemail" type="text" value="<?php echo $row['email']; ?>" size="20" tabindex="19" />
          </label></td>
      </tr>

      </tr>
      <td>Examination : </td>
      <td><input name="exam" type="text" size="40" value="<?php echo $row['exam']; ?>" tabindex="15" /></td>
      </tr>
      <tr>
        <td> Year : </td>
        <td><input name="year" type="text" size="40" value="<?php echo $row['year']; ?>" tabindex="15" /></td>
      </tr>
      <tr>
        <td>Index No: : </td>
        <td><input name="indexno" type="text" size="40" value="<?php echo $row['indexNo']; ?>" tabindex="15" /></td>
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
            while ($resultSet = $db->Next_Record($resultfsub)) {
              $subject  = $resultSet["subject"];
              $result  = $resultSet["result"];
            ?>
              <tr>
                <td><input name="subject[]" type="text" id="subject" tabindex="10" size="15" value="<?php echo $subject; ?>" />
                </td>
                <td><input name="result[]" type="text" id="result" tabindex="10" size="15" value="<?php echo $result; ?>" />
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
            <input name="txtNameGE" type="text" value="<?php echo $row['gnameE']; ?>" tabindex="5" size="30" />
          </label></td>
      </tr>
      <tr>
        <td height="25">Guardian Address - No</td>
        <td><label>
            <input name="txtaddGE1" type="text" size="20" value="<?php echo $row['gadde1']; ?>" tabindex="13" />
          </label></td>
      </tr>
      <tr>
        <td height="25">
          <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Street </font></pre>
        </td>
        <td><input name="txtaddGE2" type="text" size="40" value="<?php echo $row['gadde2']; ?>" tabindex="14" /></td>
      </tr>
      <tr>
        <td height="25">
          <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2">   Town</font></pre>
        </td>
        <td><input name="txtaddGE3" type="text" size="40" value="<?php echo $row['gadde3']; ?>" tabindex="15" /></td>
      </tr>
      <tr>
        <td height="25"> Apllication Fee paid or not </td>
        <td>
          <select name="appFee" id="appFee" tabindex="14">
            <option <?php if ($row['appfee'] == 'Paid') echo "selected='selected'"; ?>>Paid</option>
            <option <?php if ($row['appfee'] == 'Not Paid') echo "selected='selected'"; ?>> Not Paid</option>
          </select>
        </td>
      </tr>
      <tr>
        <td height="35" colspan="2">
          <h3 style="font-weight:bold" align="left">Details about Residence place in Sri Lanka</h3>
        </td>
      </tr>
      <tr>
        <td height="49">Guardian Name of the residence</td>
        <td><input name="residencegname" type="text" size="40" value="<?php echo $row['gaNameR']; ?>" tabindex="15" /></td>
      </tr>
      <tr>
        <td height="37">Residence Address - No</td>
        <td><input name="residenceaddG1" type="text" size="40" value="<?php echo $row['rsladde1']; ?>" tabindex="15" /></td>
      </tr>
      <tr>
        <td height="45">
          <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2" >  Street </font></pre>
        </td>
        <td><input name="residenceaddG2" type="text" size="40" value="<?php echo $row['rsladde2']; ?>" tabindex="15" /></td>
      </tr>
      <tr>
        <td height="45">
          <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2" >  Town </font></pre>
        </td>
        <td><input name="residenceaddG3" type="text" size="40" value="<?php echo $row['rsladde3']; ?>" tabindex="15" /></td>
      </tr>
      <tr>
        <td height="34">Residence guardian's Telephone No</td>
        <td><input name="residencegtelno" type="text" size="40" value="<?php echo $row['RSLtelNo']; ?>" tabindex="15" /></td>
      </tr>

    </table>
    <tr>
      <td colspan="2"><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href='foreignApplicants.php';" class="button" />
        <input name="btnAdd" type="submit" value="Edit" class="button">
      </td>
    </tr>
  </form>
<?php
      //foreign applicant content
    }

?>

<?php }
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Edit Applicant - Applicants - Student Management System - Buddhisht & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='applicant.php'>Applicants </a></li><li>Edit Applicant</li></ul>";
  //Apply the template
  include("master_registration.php");
?>