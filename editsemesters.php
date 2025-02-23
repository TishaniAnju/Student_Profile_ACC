<?php
  ob_start();
?>

<?php
	include("dbAccess.php");
  $db = new DBOperations();
  //2021-03-23 end
 


	$id = $db->cleanInput($_GET['id']);

  if (isset($_POST['btnAdd']))
	{
	$year =  $db->cleanInput($_POST['year']);
    if($year == 1)
	{
		$year_name = 'First Year';
	}
	elseif($year == 2)
	{
		$year_name = 'Second Year';
	}
	elseif($year == 3)
	{
		$year_name = 'Third Year';
	}
	elseif($year == 4)
	{
		$year_name = 'Fourth Year';
	}
	$semester =  $db->cleanInput($_POST['semester']);
    if($semester == 1)
	{
		$semester_name = 'First Semester';
	}
	else{
	$semester_name = 'Second Semester';
	}
    $sdate =  $db->cleanInput($_POST['sdate']);
    $edate =  $db->cleanInput($_POST['edate']);

	
	$query = "UPDATE enrollPeriod SET year='$year', semester='$semester' , year_name = '$year_name', semester_name = '$semester_name', sdate = '$sdate' , edate = '$edate' WHERE id='$id'";
	$result =  $db->executeQuery($query); 
		header("location:semester.php");
	}



  $query = "SELECT * FROM enrollPeriod WHERE id='$id'";
  $result = $db->executeQuery($query); 


  while ($row = $db->Next_Record($result))

  {



	
?>





<form action="" method="post">
<h1>  Edit Semester Details</h1>

<table class="searchResults">
  <tr>
    <td>ID</td>
    <td><input name="id" type="text" value="<?php echo $row['id']; ?>" readonly="readonly" style="border:none" tabindex="1"></td>
  </tr>
 <tr>
			<td height="39">Year </td>
			<td><select name="year" id="year" tabindex="5">
			 <option <?php if($row['year']=='1') echo "selected='selected'"; ?>>1</option>
			  <option <?php if($row['year']=='2') echo "selected='selected'"; ?>>2</option>
			  <option <?php if($row['year']=='3') echo "selected='selected'"; ?>>3</option>
              <option <?php if($row['year']=='4') echo "selected='selected'"; ?>>4</option>

			</select></td>
		  </tr>

          <tr>
			<td height="39">Semester </td>
			<td><select name="semester" id="semester" tabindex="5">
			 <option <?php if($row['semester']=='1') echo "selected='selected'"; ?>>1</option>
			  <option <?php if($row['semester']=='2') echo "selected='selected'"; ?>>2</option>
			  

			</select></td>
		  </tr>
  <tr>
    <td>Start Date</td>
    <td><input name="sdate" type="date" value="<?php echo $row['sdate']; ?>"></td>
  </tr>
  <tr>
    <td>End Date</td>
    <td><input name="edate" type="date" value="<?php echo $row['edate']; ?>"></td>
  </tr>
  <tr><td colspan="2"><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href='newsemester.php';" class="button" />
 <input name="btnAdd" type="submit" value="Save" class="button" >
    </td></tr>
 </table>

</form>
<?php
  }
  ?>


<?php
  
    //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Edit Semester - Semester Details - Student Management System - Buddhisht & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='semester.php'>Semester Details </a></li><li>Edit Semester Details</li></ul>";
  //Apply the template
  include("master_registration.php");
?>