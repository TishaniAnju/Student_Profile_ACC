<?php include("dbAccess.php");

$subjectID = cleanInput($_GET['subjectID']);
$acYear = cleanInput($_GET['acYear']);
$medium = cleanInput($_GET['medium']);
$query = "SELECT COUNT(indexNo) AS numStudents FROM exameffort WHERE subjectID='$subjectID' AND acYear='$acYear' AND medium='$medium'";
$result = $db->executeQuery($query);
while($resultSet = $db->Next_Record($result))
			{
				$rnumStudents = $resultSet["numStudents"];
              	echo "<option>".$rnumStudents."</option>";

        	}
//$numStudents = mysql_fetch_array($result);
//echo $numStudents['numStudents'];

?>

        	