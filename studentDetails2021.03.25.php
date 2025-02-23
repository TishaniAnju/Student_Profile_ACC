<?php
  //Buffer larger content areas like the main page content
  ob_start();
?>

<h1>Student Details</h1>
<?php
	include('dbAccess.php');
	include('authcheck.inc.php');
	
	$appNo = cleanInput($_GET['appNo']);
	$query = "SELECT * FROM student WHERE appNo='$appNo'";
	$result = executeQuery($query);
	$row = mysql_fetch_array($result);
	
	if (mysql_num_rows($result)>0)
	{
?>

<table class="searchResults">
	<tr>
    	<th colspan="2"><?php echo $row['nameEnglish']; ?></th>
    </tr>
    <tr>
    	<td>Applicant No. : </td><td> <?php echo $row['appNo']; ?></td>
    </tr>
    <tr>
    	<td>Registration No. : </td><td> <?php echo $row['regNo']; ?></td>
    </tr>
    <tr>
    	<td>Index No. : </td><td> <?php echo $row['indexNo']; ?></td>
    </tr>
    <tr>
    	<td>Title : </td><td> <?php echo $row['title']; ?></td>
    </tr>
    <tr>
    	<td>Name (English) : </td><td> <?php echo $row['nameEnglish']; ?></td>
    </tr>
    <tr>
    	<td>Name (Sinhala) : </td><td> <?php echo $row['nameSinhala']; ?></td>
    </tr>
    <tr>
    	<td valign="top">Address (English): </td><td> <?php echo $row['addressE1']."<br/>".$row['addressE2']."<br/>".$row['addressE3']; ?></td>
    </tr>
    <tr>
    	<td valign="top">Address (Sinhala): </td><td> <?php echo $row['addressS1']."<br/>".$row['addressS2']."<br/>".$row['addressS3']; ?></td>
    </tr>
    <tr>
    	<td>District : </td><td> <?php echo $row['district']; ?></td>
    </tr>
    <tr>
    	<td>Entry Type : </td><td> <?php echo $row['entryType']; ?></td>
    </tr>
    <tr>
    	<td>Year of Entrance : </td><td> <?php echo $row['yearEntry']; ?></td>
    </tr>
    <tr>
    	<td>Faculty : </td><td> <?php echo $row['faculty']; ?> Studies</td>
    </tr>
    <tr>
    	<td>Degree Type : </td><td> <?php echo $row['degreeType']; ?></td>
    </tr>
	<tr>
    	<td>Meduim : </td><td> <?php echo $row['medium']; ?></td>
    </tr>
    <tr>
    	<td>NIC/Passport No. : </td><td> <?php echo $row['id_pp_No']; ?></td>
    </tr>
    <tr>
    	<td>Contact No. : </td><td> <?php echo $row['contactNo']; ?></td>
    </tr>
    <tr>
    	<td>Email : </td><td> <?php echo $row['email']; ?></td>
    </tr>
    <tr>
    	<td>Birthday : </td><td> <?php echo $row['birthday']; ?></td>
    </tr>
    <tr>
    	<td>Citizenship : </td><td> <?php echo $row['citizenship']; ?></td>
    </tr>
    <tr>
    	<td>Nationality : </td><td> <?php echo $row['nationality']; ?></td>
    </tr>
    <tr>
    	<td>Religion : </td><td> <?php echo $row['religion']; ?></td>
    </tr>
    <tr>
    	<td>Civil Status : </td><td> <?php echo $row['civilStatus']; ?></td>
    </tr>
    <tr>
    	<td>Guardian Name : </td><td> <?php echo $row['guardName']; ?></td>
    </tr>
    <tr>
    	<td>Guardian Address : </td><td> <?php echo $row['guardAddress']; ?></td>
    </tr>
    <tr>
    	<td>Guardian Contact No. : </td><td> <?php echo $row['guardContactNo']; ?></td>
    </tr>
    <tr>
    	<td>Scholarship : </td><td> <?php echo $row['Scholarship']; ?></td>
    </tr>
</table>
	<br/><p><input name="btnEdit" type="button" value="Edit"  class="button" onclick="document.location.href ='studentEdit.php?appNo=<?php echo $row['appNo'] ?>'"/></p>
      
<?php
   }
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Student Details - Students - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='studentAdmin.php'>Students </a></li><li>Student Details</li></ul>";
  //Apply the template
  include("master_registration.php");
?>