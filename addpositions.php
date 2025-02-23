<?php
  require_once("dbAccess.php");
	$db = new DBOperations();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Position</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container col-sm-6">
  <h2>Add Position</h2>
  <form action="addpositions.php" name="addForm" method="POST">
    <div class="form-group">
      <label for="ps">Position:</label>
      <input type="number" class="form-control" id="ps" placeholder="Enter Position" name="ps">
    </div>
    <div class="form-group">
      <label for="pname">Position Name:</label>
      <input type="text" class="form-control" id="pname" placeholder="Enter Position Name" name="pname">
    </div>
    <div class="form-group">
      <label for="pname">Level : </label>
      <select name="level" id="level" onchange="form1.submit()"> 

        	<option value="I">Level One</option>
        	<option value="II">Level Two</option>
			<option value="III">Level Three</option>
        	<option value="IV">Level Four</option>
        </select>
		<script>
								document.getElementById('level').value = "<?php echo $level;?>";
							</script> 
    </div>
    <div class="form-group">
      <label for="pname">Semester :  </label>
      <select name="subSemester" id="subSemester" onchange="form1.submit()">

<option value="First Semester">First Semester</option>
<option value="Second Semester">Second Semester</option>
</select>
<script>

      document.getElementById('subSemester').value = "<?php echo $semester;?>";
    </script> 
    </div>
    
    <input type="submit" name="add" class="btn btn-default" value="Add">
    <input type="reset" name="clear" class="btn btn-default" value="Clear">
  </form>
</div>

</body>

<?php

if(isset($_POST["add"])){
    $ps = $_POST['ps'];
    $ps_name = $_POST['pname'];
    $level = $_POST['level'];
    $semester = $_POST['subSemester'];
    $sql = "INSERT INTO positions (position,p_name,level,semester) VALUES ('$ps','$ps_name','$level','$semester')";
    $result = $db->executeQuery($sql);
   // header("Location:SubPositiondetails.php");
}

?>

</html>
