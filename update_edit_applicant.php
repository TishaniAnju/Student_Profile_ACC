<?php 
include("dbAccess.php");
$db = new DBOperations();

// Assuming you are receiving the following data from a form:
    $appNo = $_POST['appNo'];
    $appType = $_POST['appType'];
    $entryYear = $_POST['entryYear'];
    $titleE = $_POST['titleE'];
    $nameEnglish = $_POST['nameEnglish'];
    $addressEnglish1 = $_POST['addressEnglish1'];
    $addressEnglish2 = $_POST['addressEnglish2'];
    $addressEnglish3 = $_POST['addressEnglish3'];
    $nameSinhala = $_POST['nameSinhala'];
    $addS1 = $_POST['addS1'];
    $addS2 = $_POST['addS2'];
    $addS3 = $_POST['addS3'];
    $district = $_POST['district'];
    $telno = $_POST['telno'];
    $email = $_POST['email'];
    $guardianEname = $_POST['guardianEname'];
    $guardianSname = $_POST['guardianSname'];
    $guardianEadd1 = $_POST['guardianEadd1'];
    $guardianEadd2 = $_POST['guardianEadd2'];
    $guardianEadd3 = $_POST['guardianEadd3'];
    $guardianSadd1 = $_POST['guardianSadd1'];
    $guardianSadd2 = $_POST['guardianSadd2'];
    $guardianSadd3 = $_POST['guardianSadd3'];
    $appfee = $_POST['appfee'];
    $entryType = $_POST['entryType'];
    $alAdNo = $_POST['alAdNo'];
    $alYear = $_POST['alYear'];
    $zScore = $_POST['zScore'];
    $gkScore = $_POST['gkScore'];
    $nicNo = $_POST['nicNo'];
    $dob = $_POST['dob'];
    $nikaya = $_POST['nikaya'];
    $chapter = $_POST['chapter'];
    $quli_year = $_POST['quli_year'];
    $quli_id = $_POST['quli_id'];
    $stream = $_POST['stream'];
    
    
    // Update `applicant` table
    $queryApplicant = "UPDATE applicant SET 
                       entryYear = '$entryYear', 
                       titleE = '$titleE', 
                       nameEnglish = '$nameEnglish',
                       addressEnglish1 = '$addressEnglish1',
                       addressEnglish2 = '$addressEnglish2',
                       addressEnglish3 = '$addressEnglish3',
                       nameSinhala = '$nameSinhala',
                       district = '$district',
                       telno = '$telno',
                       email = '$email',
                       guardianEname = '$guardianEname',
                       guardianSname = '$guardianSname',
                       guardianEadd1 = '$guardianEadd1',
                       guardianEadd2 = '$guardianEadd2',
                       guardianEadd3 = '$guardianEadd3',
                       guardianSadd1 = '$guardianSadd1',
                       guardianSadd2 = '$guardianSadd2',
                       guardianSadd3 = '$guardianSadd3',
                       appfee = '$appfee',
                       entryType = '$entryType',
                       alAdNo = '$alAdNo',
                       alYear = '$alYear',
                       zScore = '$zScore',
                       gkScore = '$gkScore',
                       nicNo = '$nicNo',
                       dob = '$dob',
                       nikaya = '$nikaya',
                       chapter = '$chapter'
                       WHERE appNo = '$appNo' AND appType = '$appType'";
    
    // Execute the update query for the `applicant` table
    $result1 = $db->cleanInput($queryApplicant);
    
    // Update `localapplicant` table
    $queryLocalApplicant = "UPDATE localapplicant SET 
                            addressEnglish1 = '$addressEnglish1',
                            addressEnglish2 = '$addressEnglish2',
                            addressEnglish3 = '$addressEnglish3',
                            addS1 = '$addS1',
                            addS2 = '$addS2',
                            addS3 = '$addS3',
                            district = '$district',
                            telno = '$telno',
                            email = '$email'
                            WHERE appNo = '$appNo'";
    
    // Execute the update query for the `localapplicant` table
    $result2 = $db->cleanInput($queryLocalApplicant);
    
    // Update `applicantquli` table
    $queryApplicantQuli = "UPDATE applicantquli SET 
                           quli_year = '$quli_year', 
                           quli_id = '$quli_id',
                           stream = '$stream'
                           WHERE appNo = '$appNo'";
    
    // Execute the update query for the `applicantquli` table
    $result3 = $db->cleanInput($queryApplicantQuli);
    
    // Check if all updates were successful
    if ($result1 && $result2 && $result3) {
        echo "All records updated successfully!";
    } else {
        echo "Error updating records: ";
    }
    