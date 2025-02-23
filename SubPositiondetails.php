
<?php
  //Buffer larger content areas like the main page content
  //ob_start();
 ?>
 <script language="javascript">
 var xmlhttp;

function addSlot()
{
xmlhttp=GetXmlHttpObject();
if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  return;
  }
var url="addpositions.php";
url=url+"?sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);
}

function stateChanged()
{
if (xmlhttp.readyState==4)
{
document.getElementById("pnlSlot").innerHTML=xmlhttp.responseText;
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
 	function MsgOkCancel()
	{
		var message = "Please confirm to DELETE this item...";
		var return_value = confirm(message);
		return return_value;
	}
 </script>
 
 <?php
 //2021.03.24 include('dbAccess.php');
 require_once("dbAccess.php");
 $db = new DBOperations();
//2021.03.24 end

  //include('authcheck.inc.php');
  
  if (isset($_POST['btnSubmit']))
	{
    //2021.03.24 $venueNo = cleanInput($_POST['txtVenueNo']);
    $venueNo = $db->cleanInput($_POST['txtVenueNo']);
    //2021.03.24 end
		$venue = cleanInput($_POST['txtVenue']);
		
		$query = "INSERT INTO venue SET venueNo='$venueNo', venue='$venue'";
    //2021.03.24 $result = executeQuery($query);
    $result = $db->executeQuery($query);
    //2021.03.24 end
		//header("location:message.php?message=Successfully inserted!");
	}
  
   
 if (isset($_GET['cmd']) && $_GET['cmd']=="delete")
	{  //2021.03.24 $venueNo = cleanInput($_GET['venueNo']);
		$venueNo = $db->cleanInput($_GET['venueNo']);
    //2021.03.24 end
		//$subNS= $_GET['subnamS'];
		$delQuery1 = "DELETE FROM venue WHERE venueNo='$venueNo'";
    //2021.03.24 $result1 = executeQuery($delQuery1);
		$result1 =$db-> executeQuery($delQuery1);
    //2021.03.24 end
	}	

  $query = "SELECT * FROM positions ORDER BY id";
  //2021.03.24 $result=executeQuery($query);
  $result=$db->executeQuery($query);
  //2021.03.24 end
?>
<h1>Subject Position Details</h1>
  
<br/>
<!--2021.03.24 -->
	<?php if ($db->Row_count($result)>0){ ?>
  <!--end-->
  <form method="post" action="SubPositiondetails.php" class="plain">
<br/>
  <table class="searchResults">
	<tr>
    	<th>Position Id</th>
        <th>Position Name</th>
        <th>Level</th>
    	<th>Semester</th>
        <th>&nbsp;</th>
        
	</tr>
    
<?php
  //2021.03.24 while ($row = mysql_fetch_array($result))
  while ($row = $db->Next_Record($result))
  //2021.03.24
  {
?>
	<tr>
        <td><?php echo $row['position'] ?></td>
        <td><?php echo $row['p_name'] ?></td>
        <td><?php echo $row['level'] ?></td>
        <td><?php echo $row['semester'] ?></td>
       
        
		<td><input name="btnDelete" type="button" value="Delete" onClick="if (MsgOkCancel()) document.location.href ='venue.php?cmd=delete&venueNo=<?php echo $row['venueNo'] ?>';" class="button" /></td>
	</tr>
<?php
  } 
  } 
?>
  </table>
   </form>
  <br/><div id="pnlSlot"><input name="btnAddSlot" type="button" value="Add New" class="button" onclick="addSlot();" /></div>


<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Home - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Venue</li></ul>";
  //Apply the template
  include("master_registration.php");
?>