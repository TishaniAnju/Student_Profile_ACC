<?php
//Buffer larger content areas like the main page content
ob_start();
?>

<h1>Applicant Details</h1>
<?php
require_once("dbAccess.php");
$db = new DBOperations();
$aplicationNo = $db->cleanInput($_GET['appNo']);

//print $aplicationNo;
include('authcheck.inc.php');



//$appNo = $db->cleanInput($_GET['appNo']);
//=========================================
$querytype = "SELECT appType,appNo FROM applicant  WHERE applicant.appNo='$aplicationNo'";
//print $querytype;

$resulttype = $db->executeQuery($querytype);

$rowtype = $db->Next_Record($resulttype);

$appType = $rowtype['appType'];
$appNo = $rowtype['appNo'];

//===========================================
//print $appType;

//$appType = $db->cleanInput($_GET['appType']);
//$appType="Local";

if ($appType == "Local") {

  $queryselect = "SELECT * FROM applicantpali WHERE appNo ='$appNo'";
  //print $queryselect;
  $resultselect = $db->executeQuery($queryselect);

  $query = "SELECT applicant.appNo,entryYear,titleE,nameEnglish,addressEnglish1,addressEnglish2,addressEnglish3,nameSinhala,addS1,addS2,addS3,district,telno,email,guardianEname,guardianSname,guardianEadd1,guardianEadd2,guardianEadd3,guardianSadd1,guardianSadd2,guardianSadd3,appfee,entryType,alAdNo,alYear,zScore,gkScore,nicNo,dob,nikaya, chapter  FROM applicant JOIN localapplicant ON applicant.appNo = localapplicant.appNo  WHERE applicant.appNo='$appNo'";
  //print $query;

  $result = $db->executeQuery($query);

  $row = $db->Next_Record($result);


  if ($db->Row_Count($result) > 0) {

    $nikayaID = $row['nikaya'];
    $chapter = $row['chapter'];
    //print $nikayaID;
    //print $chapter;
    $queryn = "SELECT * FROM nikaya where nikayaID='$nikayaID' ";
    //print $queryn;
    $resultn = $db->executeQuery($queryn);

    while ($rown = $db->Next_Record($resultn)) {
      $nikayaName = $rown['nikayaName'];
    }


    if ($nikayaID != 4) {
      $queryc = "SELECT * FROM chapter where nikayaID='$nikayaID' and chapterID=$chapter";
      //print $queryc;
      $resultc = $db->executeQuery($queryc);

      while ($rowc = $db->Next_Record($resultc)) {
        $chapterName = $rowc['chapter'];
      }
    } else
      $chapterName = "-";
?>

    <table class="searchResults">

      <tr>
        <th colspan="2"><?php echo $row['nameEnglish']; ?></th>
      </tr>

      <tr>
        <td>National ID : </td>
        <td> <?php echo $row['nicNo']; ?></td>
      </tr>
      <tr>
        <td>Date of Birth : </td>
        <td> <?php echo $row['dob']; ?></td>
      </tr>
      <tr>
        <td>Title : </td>
        <td> <?php echo $row['titleE']; ?></td>
      </tr>
      <tr>
        <td>Name : </td>
        <td> <?php echo $row['nameEnglish']; ?></td>
      </tr>
      <tr>
        <td>&#3505;&#3512;: </td>
        <td> <?php echo $row['nameSinhala']; ?></td>
      </tr>
      <tr>
        <td>Address - No : </td>
        <td> <?php echo $row['addressEnglish1']; ?></td>
      </tr>
      <tr>
        <td>Street : </td>
        <td> <?php echo $row['addressEnglish2']; ?></td>
      </tr>
      <tr>
        <td>Town : </td>
        <td> <?php echo $row['addressEnglish3']; ?></td>
      </tr>
      <tr>
        <td>&#3517;&#3538;&#3508;&#3538;&#3505;&#3514;-&#3461;&#3458;&#3482;&#3514; : </td>
        <td> <?php echo $row['addS1']; ?></td>
      </tr>
      <tr>
        <td>&#3520;&#3539;&#3503;&#3538;&#3514;
          <pre />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <font />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
        </td>
        <td> <?php echo $row['addS2']; ?></td>
      </tr>
      <tr>
        <td>&#3505;&#3484;&#3515;&#3514;
          <pre />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <font />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
        </td>
        <td> <?php echo $row['addS3']; ?></td>
      </tr>
      <tr>
        <td>Nikaya: </td>
        <td> <?php echo $nikayaName; ?></td>
      </tr>
      <tr>
        <td>Chapter : </td>
        <td> <?php echo $chapterName; ?></td>
      </tr>
      <tr>
        <td>Administrative District : </td>
        <td> <?php echo $row['district']; ?></td>
      </tr>
      <tr>
        <td>Telephone No : </td>
        <td> <?php echo $row['telno']; ?></td>
      </tr>
      <tr>
        <td>Email : </td>
        <td> <?php echo $row['email']; ?></td>
      </tr>
      <tr>
        <td>Guardian Name : </td>
        <td> <?php echo $row['guardianEname']; ?></td>
      </tr>
      <tr>
        <td>&#3505;&#3512; : </td>
        <td> <?php echo $row['guardianSname']; ?></td>
      </tr>
      <tr>
        <td>Guardian Address - No : </td>
        <td> <?php echo $row['guardianEadd1']; ?></td>
      </tr>
      <tr>
        <td>Street : </td>
        <td> <?php echo $row['guardianEadd2']; ?></td>
      </tr>
      <tr>
        <td>Town : </td>
        <td> <?php echo $row['guardianEadd3']; ?></td>
      </tr>
      <tr>
        <td>&#3517;&#3538;&#3508;&#3538;&#3505;&#3514;-&#3461;&#3458;&#3482;&#3514; : </td>
        <td> <?php echo $row['guardianSadd1']; ?></td>
      </tr>
      <tr>
        <td>&#3520;&#3539;&#3503;&#3538;&#3514;
          <pre />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <font />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
        </td>
        <td> <?php echo $row['guardianSadd2']; ?></td>
      </tr>
      <tr>
        <td>&#3505;&#3484;&#3515;&#3514;
          <pre />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <font />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
        </td>
        <td> <?php echo $row['guardianSadd3']; ?></td>
      </tr>
      <tr>
        <td>Apllication Fee paid or not : </td>
        <td> <?php echo $row['appfee']; ?></td>
      </tr>
      <tr>
        <td>Entry Type : </td>
        <td> <?php echo $row['entryType']; ?></td>
      </tr>
      <tr>
        <td height="25">A/L Subject Results</td>
      </tr>
      <tr>
        <td>A/L Admission No : </td>
        <td> <?php echo $row['alAdNo']; ?></td>
      </tr>
      <tr>
        <td>A/L Year : </td>
        <td> <?php echo $row['alYear']; ?></td>
      </tr>
      <?php
      $queryquliALvalues = "SELECT * FROM applicantquli  WHERE appNo = '$appNo' and  applicantquli.quli_id='1' ";

      $resultquliALvalues = $db->executeQuery($queryquliALvalues);
      while ($resultSetquli5 = $db->Next_Record($resultquliALvalues)) {
        $a = $resultSetquli5['indexNo'];
        $b = $resultSetquli5['quli_year'];
        $c = $resultSetquli5['medium'];
        $s1 = $resultSetquli5['stream'];

        if ($c == 'e') {
          $d = "English";
        }
        if ($c == 's') {
          $d = "Sinhala";
        }



        $queryqulistream = "SELECT * FROM alstream  WHERE streamId = '$s1' ";

        $resultqulistream = $db->executeQuery($queryqulistream);
        while ($resultSetstream = $db->Next_Record($resultqulistream)) {
          $streamdes = $resultSetstream['description'];
        }
      }
      ?>
      <tr>
        <td>Medium </td>
        <td> <?php echo $d; ?></td>
      </tr>
      <tr>
        <td>Stream : </td>
        <td> <?php echo $streamdes; ?></td>
      </tr>
      <tr>
        <td>Z-Score : </td>
        <td> <?php echo $row['zScore']; ?></td>
      </tr>
      <tr>
        <td>General Knowladge Score : </td>
        <td> <?php echo $row['gkScore']; ?></td>
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
              <td colspan="2">
                <table width="223" height="124" border="1">
                  <tr>
                    <th width="150" scope="col">Subject Name</th>
                    <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
                  </tr>
                  <?php

                  $query = "SELECT * FROM alsubjects";
                  $result = $db->executeQuery($query);

                  for ($j = 1; $j <= 1; $j++) {

                    while ($resultSet = $db->Next_Record($resultAL)) {


                      $rSubjectCode  = $resultSet["subjectCode"];
                      $rSubject = $resultSet["subnameE"];
                      $rresult = $resultSet["result"];



                      echo "<tr><td><div id='Subject" . $j . "'> <select name='lstSub" . $j . "' tabindex='20'>";

                      echo "<option value=\"" . $rSubjectCode . "\">" . $rSubject . "</option>";


                      $query = "SELECT * FROM alsubjects";
                      $result = $db->executeQuery($query);

                      while ($resultSet1 = $db->Next_Record($result)) {
                        $subCode = $resultSet1["subjectCode"];
                        $sub = $resultSet1["subnameE"];
                        if ($rSubjectCode == $subCode) {

                          echo "<option selected='selected' value=\"" . $subCode . "\">" . $sub . "</option>";
                          //echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
                        }


                        /*  else {
		
			  echo "<option value=\"".$subCode."\">".$sub."</option>"; 
			 // echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
			 } */
                      }




                  ?>

                      </select></div>
              </td>

              <?php echo " <td>
                   <select name= 'lstResult" . $j . "'tabindex='21'>"; ?>
              <option <?php if ($rresult == 'A') echo "selected='selected'"; ?>>A</option>
              <option <?php if ($rresult == 'B') echo "selected='selected'"; ?>>B</option>
              <option <?php if ($rresult == 'C') echo "selected='selected'"; ?>>C</option>
              <option <?php if ($rresult == 'S') echo "selected='selected'"; ?>>S</option>
              <option <?php if ($rresult == 'F') echo "selected='selected'"; ?>>F</option>
              </select>
        </td>
      </tr>

  <?php }
                  } ?>
    </table>
    </td>
    </tr>




    </table>
    </td>
    </tr>
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
    while ($resultSetquli5 = $db->Next_Record($resultquli5)) {
      $a1 = $resultSetquli5['indexNo'];
      $b1 = $resultSetquli5['quli_year'];
      $c1 = $resultSetquli5['medium'];
      if ($c1 == 'e') {
        $d1 = "English";
      }
      if ($c1 == 's') {
        $d1 = "Sinhala";
      }
      //$c1=$resultSetquli5['medium'];
    }
    ?>
    <tr>
      <td>Admission No : </td>
      <td> <?php echo $a1 ?></td>
    </tr>
    <tr>
      <td>Year : </td>
      <td> <?php echo $b1 ?></td>
    </tr>
    <tr>
      <td>Medium </td>
      <td> <?php echo $d1; ?></td>
    </tr>



    <tr>
      <td height="25" colspan="2">



        <table width="275" border="1" id="tblpali">
          <tr>
            <td colspan="2">
              <table width="223" height="124" border="1">
                <tr>
                  <th width="150" scope="col">Subject Name</th>
                  <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
                </tr>
                <?php

                $query = "SELECT * FROM alsubjects";
                $result = $db->executeQuery($query);

                for ($j = 1; $j <= 1; $j++) {

                  while ($resultSet = $db->Next_Record($resultAL5)) {


                    $rSubjectCode  = $resultSet["subjectCode"];
                    $rSubject = $resultSet["subnameE"];
                    $rresult = $resultSet["result"];



                    echo "<tr><td><div id='Subject" . $j . "'> <select name='lstSub" . $j . "' tabindex='20'>";

                    echo "<option value=\"" . $rSubjectCode . "\">" . $rSubject . "</option>";


                    $query = "SELECT * FROM alsubjects";
                    $result = $db->executeQuery($query);

                    while ($resultSet1 = $db->Next_Record($result)) {
                      $subCode = $resultSet1["subjectCode"];
                      $sub = $resultSet1["subnameE"];
                      if ($rSubjectCode == $subCode) {

                        echo "<option selected='selected' value=\"" . $subCode . "\">" . $sub . "</option>";
                        //echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
                      }


                      /*  else {
		
			  echo "<option value=\"".$subCode."\">".$sub."</option>"; 
			 // echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
			 } */
                    }




                ?>

                    </select></div>
            </td>

            <?php echo " <td>
                   <select name= 'lstResult" . $j . "'tabindex='21'>"; ?>
            <option <?php if ($rresult == 'A') echo "selected='selected'"; ?>>A</option>
            <option <?php if ($rresult == 'B') echo "selected='selected'"; ?>>B</option>
            <option <?php if ($rresult == 'C') echo "selected='selected'"; ?>>C</option>
            <option <?php if ($rresult == 'S') echo "selected='selected'"; ?>>S</option>
            <option <?php if ($rresult == 'F') echo "selected='selected'"; ?>>F</option>
            </select>
      </td>
    </tr>

<?php }
                } ?>
</table>
</td>
</tr>




</table>
</td>
</tr>

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
    while ($resultSetquli6 = $db->Next_Record($resultquli6)) {
      $a2 = $resultSetquli6['indexNo'];
      $b2 = $resultSetquli6['quli_year'];
      $c2 = $resultSetquli6['medium'];
      if ($c2 == 'e') {
        $d2 = "English";
      }
      if ($c2 == 's') {
        $d2 = "Sinhala";
      }
      //$c1=$resultSetquli5['medium'];
    }
?>
<tr>
  <td>Admission No : </td>
  <td> <?php echo $a2 ?></td>
</tr>
<tr>
  <td>Year : </td>
  <td> <?php echo $b2 ?></td>
</tr>
<tr>
  <td>Medium </td>
  <td> <?php echo $d2; ?></td>
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
          <table width="223" height="124" border="1">
            <tr>
              <th width="150" scope="col">Subject Name</th>
              <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
            </tr>
            <?php

            $query = "SELECT * FROM alsubjects";
            $result = $db->executeQuery($query);

            for ($j = 1; $j <= 1; $j++) {

              while ($resultSet = $db->Next_Record($resultAL6)) {


                $rSubjectCode  = $resultSet["subjectCode"];
                $rSubject = $resultSet["subnameE"];
                $rresult = $resultSet["result"];



                echo "<tr><td><div id='Subject" . $j . "'> <select name='lstSub" . $j . "' tabindex='20'>";

                echo "<option value=\"" . $rSubjectCode . "\">" . $rSubject . "</option>";


                $query = "SELECT * FROM alsubjects";
                $result = $db->executeQuery($query);

                while ($resultSet1 = $db->Next_Record($result)) {
                  $subCode = $resultSet1["subjectCode"];
                  $sub = $resultSet1["subnameE"];
                  if ($rSubjectCode == $subCode) {

                    echo "<option selected='selected' value=\"" . $subCode . "\">" . $sub . "</option>";
                    //echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
                  }


                  /*  else {
		
			  echo "<option value=\"".$subCode."\">".$sub."</option>"; 
			 // echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
			 } */
                }




            ?>

                </select></div>
        </td>

        <?php echo " <td>
                   <select name= 'lstResult" . $j . "'tabindex='21'>"; ?>
        <option <?php if ($rresult == 'A') echo "selected='selected'"; ?>>A</option>
        <option <?php if ($rresult == 'B') echo "selected='selected'"; ?>>B</option>
        <option <?php if ($rresult == 'C') echo "selected='selected'"; ?>>C</option>
        <option <?php if ($rresult == 'S') echo "selected='selected'"; ?>>S</option>
        <option <?php if ($rresult == 'F') echo "selected='selected'"; ?>>F</option>
        </select>
  </td>
</tr>

<?php }
            } ?>
</table>
</td>
</tr>




</table>
</td>
</tr>







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
    while ($resultSetquli7 = $db->Next_Record($resultquli7)) {
      $a3 = $resultSetquli7['indexNo'];
      $b3 = $resultSetquli7['quli_year'];
      $c3 = $resultSetquli7['medium'];
      if ($c3 == 'e') {
        $d3 = "English";
      }
      if ($c3 == 's') {
        $d3 = "Sinhala";
      }
      //$c1=$resultSetquli5['medium'];
    }
?>
<tr>
  <td>Admission No : </td>
  <td> <?php echo $a3 ?></td>
</tr>
<tr>
  <td>Year : </td>
  <td> <?php echo $b3 ?></td>
</tr>
<tr>
  <td>Medium </td>
  <td> <?php echo $d3; ?></td>
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
          <table width="223" height="124" border="1">
            <tr>
              <th width="150" scope="col">Subject Name</th>
              <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
            </tr>
            <?php

            $query = "SELECT * FROM alsubjects";
            $result = $db->executeQuery($query);

            for ($j = 1; $j <= 1; $j++) {

              while ($resultSet = $db->Next_Record($resultAL7)) {


                $rSubjectCode  = $resultSet["subjectCode"];
                $rSubject = $resultSet["subnameE"];
                $rresult = $resultSet["result"];



                echo "<tr><td><div id='Subject" . $j . "'> <select name='lstSub" . $j . "' tabindex='20'>";

                echo "<option value=\"" . $rSubjectCode . "\">" . $rSubject . "</option>";


                $query = "SELECT * FROM alsubjects";
                $result = $db->executeQuery($query);

                while ($resultSet1 = $db->Next_Record($result)) {
                  $subCode = $resultSet1["subjectCode"];
                  $sub = $resultSet1["subnameE"];
                  if ($rSubjectCode == $subCode) {

                    echo "<option selected='selected' value=\"" . $subCode . "\">" . $sub . "</option>";
                    //echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
                  }


                  /*  else {
		
			  echo "<option value=\"".$subCode."\">".$sub."</option>"; 
			 // echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
			 } */
                }




            ?>

                </select></div>
        </td>

        <?php echo " <td>
                   <select name= 'lstResult" . $j . "'tabindex='21'>"; ?>
        <option <?php if ($rresult == 'A') echo "selected='selected'"; ?>>A</option>
        <option <?php if ($rresult == 'B') echo "selected='selected'"; ?>>B</option>
        <option <?php if ($rresult == 'C') echo "selected='selected'"; ?>>C</option>
        <option <?php if ($rresult == 'S') echo "selected='selected'"; ?>>S</option>
        <option <?php if ($rresult == 'F') echo "selected='selected'"; ?>>F</option>
        </select>
  </td>
</tr>

<?php }
            } ?>
</table>
</td>
</tr>




</table>
</td>
</tr>

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
    while ($resultSetquli8 = $db->Next_Record($resultquli8)) {
      $a4 = $resultSetquli8['indexNo'];
      $b4 = $resultSetquli8['quli_year'];
      $c4 = $resultSetquli8['medium'];
      if ($c4 == 'e') {
        $d4 = "English";
      }
      if ($c4 == 's') {
        $d4 = "Sinhala";
      }
      //$c1=$resultSetquli5['medium'];
    }
?>
<tr>
  <td>Admission No : </td>
  <td> <?php echo $a4; ?></td>
</tr>
<tr>
  <td>Year : </td>
  <td> <?php echo $b4 ?></td>
</tr>
<tr>
  <td>Medium </td>
  <td> <?php echo $d4; ?></td>
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
          <table width="223" height="124" border="1">
            <tr>
              <th width="150" scope="col">Subject Name</th>
              <th width="57" bgcolor="#FFFFFF" scope="col">Result</th>
            </tr>
            <?php

            $query = "SELECT * FROM alsubjects";
            $result = $db->executeQuery($query);

            for ($j = 1; $j <= 1; $j++) {

              while ($resultSet = $db->Next_Record($resultAL)) {


                $rSubjectCode  = $resultSet["subjectCode"];
                $rSubject = $resultSet["subnameE"];
                $rresult = $resultSet["result"];



                echo "<tr><td><div id='Subject" . $j . "'> <select name='lstSub" . $j . "' tabindex='20'>";

                echo "<option value=\"" . $rSubjectCode . "\">" . $rSubject . "</option>";


                $query = "SELECT * FROM alsubjects";
                $result = $db->executeQuery($query);

                while ($resultSet1 = $db->Next_Record($result)) {
                  $subCode = $resultSet1["subjectCode"];
                  $sub = $resultSet1["subnameE"];
                  if ($rSubjectCode == $subCode) {

                    echo "<option selected='selected' value=\"" . $subCode . "\">" . $sub . "</option>";
                    //echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
                  }


                  /*  else {
		
			  echo "<option value=\"".$subCode."\">".$sub."</option>"; 
			 // echo "<option value=\"".$rSubjectCode."\">".$rSubject."</option>";
			 } */
                }




            ?>

                </select></div>
        </td>

        <?php echo " <td>
                   <select name= 'lstResult" . $j . "'tabindex='21'>"; ?>
        <option <?php if ($rresult == 'A') echo "selected='selected'"; ?>>A</option>
        <option <?php if ($rresult == 'B') echo "selected='selected'"; ?>>B</option>
        <option <?php if ($rresult == 'C') echo "selected='selected'"; ?>>C</option>
        <option <?php if ($rresult == 'S') echo "selected='selected'"; ?>>S</option>
        <option <?php if ($rresult == 'F') echo "selected='selected'"; ?>>F</option>
        </select>
  </td>
</tr>

<?php }
            } ?>
</table>
</td>
</tr>






</table>
</td>
</tr>

<tr>
  <td height="46">
    <font face="Verdana, Arial, Helvetica, sans-serif" size="2">Pali Qualification</font>
  </td>
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
              }
              /* else{
				echo "<option value=\"".$PaliCode."\">".$Qualification."</option>";
				} */
            }
            ?>
          </select></td>
        <td>
          <?php
          if ($paliresult1 == '') {
          ?>
            <input name="txtPResult" type="text" id="txtPResult" tabindex="10" size="15" />
          <?php
          } else { ?>
            <input name="txtPResult" type="text" id="txtPResult" tabindex="10" size="15" value="<?php echo $paliresult1; ?>" />
          <?php }
          ?>
        </td>
      </tr>

    </table>



  <?php
  }
  ?>

  </table>


  <br />
  <p><input name="btnEdit" type="button" value="Edit" onclick="document.location.href ='editApplicant.php?appNo=<?php echo $row['appNo'] ?> & appType=<?php echo Local ?>'" class="button" /></p>


  <?php
} elseif ($appType == "Foreign") {
  $query = "SELECT applicant.appNo,entryYear,titleE,nameEnglish,addressEnglish1,addressEnglish2,addressEnglish3,ppNo,country,exam,year,indexNo,Nationality,telNo,telNo1,telNo2,email,gnameE,gadde1,gadde2,gadde3,gaNameR,	rsladde1,	rsladde2,	rsladde3,RSLtelNo,appfee FROM applicant JOIN foreignapplicant ON applicant.appNo = foreignapplicant.appNo  WHERE applicant.appNo='$appNo'";

  $result = $db->executeQuery($query);

  $row = $db->Next_Record($result);
  if ($db->Row_Count($result) > 0) {
  ?>

    <table class="searchResults">

      <tr>
        <th colspan="2"><?php echo $row['nameEnglish']; ?></th>
      </tr>



      <tr>
        <td>Title : </td>
        <td> <?php echo $row['titleE']; ?></td>
      </tr>
      <tr>
        <td>Name : </td>
        <td> <?php echo $row['nameEnglish']; ?></td>
      </tr>
      <tr>
        <td>Address - No : </td>
        <td> <?php echo $row['addressEnglish1']; ?></td>
      </tr>
      <tr>
        <td>Street : </td>
        <td> <?php echo $row['addressEnglish2']; ?></td>
      </tr>
      <tr>
        <td>Town : </td>
        <td> <?php echo $row['addressEnglish3']; ?></td>
      </tr>
      <tr>
        <td>Passport No: : </td>
        <td> <?php echo $row['ppNo']; ?></td>
      </tr>
      <tr>
        <td>Country : </td>
        <td> <?php echo $row['country']; ?></td>
      </tr>
      <tr>
        <td>Year of Entry : </td>
        <td> <?php echo $row['entryYear']; ?></td>
      </tr>
      <td>Examination : </td>
      <td> <?php echo $row['exam']; ?></td>
</tr>
<tr>
  <td> Year : </td>
  <td> <?php echo $row['year']; ?></td>
</tr>
<tr>
  <td>Index No: : </td>
  <td> <?php echo $row['indexNo']; ?></td>
</tr>
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

<!-- remain -->
<tr>
  <td height="34">Nationality </td>
  <td> <?php echo $row['Nationality']; ?></td>
</tr>
<tr>
  <td height="34">Mobile No</td>
  <td> <?php echo $row['telNo']; ?></td>
</tr>

<tr>
  <td height="34">Residence Telephone No</td>
  <td> <?php echo $row['telNo1']; ?></td>
</tr>

<tr>
  <td height="34">WhatsApp No</td>
  <td> <?php echo $row['telNo2']; ?></td>
</tr>

<tr>
  <td height="49">Email </td>
  <td> <?php echo $row['email']; ?></td>
</tr>
<tr>
  <td height="49">Guardian Name </td>
  <td> <?php echo $row['gnameE']; ?></td>
</tr>
<tr>
  <td height="37">Guardian Permanent Address - Street</td>
  <td> <?php echo $row['gadde1']; ?></td>
</tr>
<tr>
  <td height="45">
    <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2" >  City </font></pre>
  </td>
  <td> <?php echo $row['gadde2']; ?></td>
</tr>
<tr>
  <td height="45">
    <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2" >  Province </font></pre>
  </td>
  <td> <?php echo $row['gadde3']; ?></td>
</tr>
<tr>
  <td height="25"> Apllication Fee paid or not </td>
  <td> <?php echo $row['appfee']; ?></td>
</tr>



<!-- </table>
  <table border="0" bordercolor="#EAEAEA" class="searchResults"> -->
<tr>
  <td height="35" colspan="2">
    <h3 style="font-weight:bold" align="left">Details about Residence place in Sri Lanka</h3>
  </td>
</tr>
<tr>
  <td height="49">Guardian Name of the residence</td>
  <td> <?php echo $row['gaNameR']; ?></td>
</tr>
<tr>
  <td height="37">Residence Address - No</td>
  <td> <?php echo $row['rsladde1']; ?></td>
</tr>
<tr>
  <td height="45">
    <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2" >  Street </font></pre>
  </td>
  <td> <?php echo $row['rsladde2']; ?></td>
</tr>
<tr>
  <td height="45">
    <pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2" >  Town </font></pre>
  </td>
  <td> <?php echo $row['rsladde3']; ?></td>
</tr>
<tr>
  <td height="34">Residence guardian's Telephone No</td>
  <td> <?php echo $row['RSLtelNo']; ?></td>
</tr>

<!--  -->
<?php
  }
?>
</table>


<br />
<p><input name="btnAdd" type="button" value="Edit" onclick="document.location.href ='editApplicant.php?appNo=<?php echo $row['appNo'] ?> & appType=<?php echo Foreign ?>'" class="button" /></p>
<?php
}


//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagetitle = "Applicant Datails - Student Management System - Buddhist & Pali University of Sri Lanka";
$navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='applicant.php'>Applicants </a></li><li>Applicant Details</li></ul>";
//Apply the template
include("master_registration.php");
?>