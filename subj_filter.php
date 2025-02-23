<?php
require_once("dbAccess.php");
$db = new DBOperations();
$subID = $_GET['subID'];
echo '<option value="0">- Select Subject-</option>';
$query = "SELECT * FROM alsubjects where quli_id='1' AND streamId='$subID';";
	   $result = $db->executeQuery($query);
            while($resultSet = $db->Next_Record($result))
            {
              $rSubjectCode  = $resultSet["subjectCode"];
                    $rSubject = $resultSet["subnameE"];
                   
                    echo "<option value='$rSubjectCode'>$rSubject</option>";
                }
?>