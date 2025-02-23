
<?php
  //Buffer larger content areas like the main page content
  ob_start();
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
var url="newTime.php";
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
  include('dbAccess.php');
  include('authcheck.inc.php');
  
  if (isset($_POST['btnSubmit']))
	{
		$slotID = cleanInput($_POST['txtSlotID']);
		$dayOfWeekE = cleanInput($_POST['txtDayE']);
		$dayOfWeekS = cleanInput($_POST['txtDayS']);
		$timeSlot = $_POST['lstTimeSlot'];
		
		$query = "INSERT INTO timeslot SET slotID='$slotID', dayOfWeekE='$dayOfWeekE',dayOfWeekS='$dayOfWeekS',timeSlot='$timeSlot' ";
		$result = executeQuery($query);
		//header("location:message.php?message=Successfully inserted!");
	}
  
 if (isset($_GET['cmd']) && $_GET['cmd']=="delete")
	{
		$slotID = cleanInput($_GET['slotID']);
		//$subNS= $_GET['subnamS'];
		$delQuery1 = "DELETE FROM timeslot WHERE slotID='$slotID'";
		$result1 = executeQuery($delQuery1);
	}	

  $query = "SELECT * FROM timeslot ORDER BY slotID";
  $result=executeQuery($query);
?>
<h1>Time Slots Details</h1>
  
<br/>
	<?php if (mysql_num_rows($result)>0){ ?>
 <form method="post" action="timeSlot.php" class="plain">
<br/>
  <table class="searchResults">
	<tr>
    	<th>Slot Id</th>
    	<th>Day</th>
      <th>Time Slot</th>
        <th>&nbsp;</th>
	</tr>
    
<?php
  while ($row = mysql_fetch_array($result))
  {
?>
	<tr>
        <td><?php echo $row['slotID'] ?></td>
      <td><?php echo $row['dayOfWeekE'] ?></td>
        <td><?php echo $row['timeSlot'] ?></td>
		<td><input name="btnDelete" type="button" value="Delete" onClick="if (MsgOkCancel()) document.location.href ='timeSlot.php?cmd=delete&slotID=<?php echo $row['slotID'] ?>';" class="button" /></td>
	</tr>
<?php
  } 
  } 
?>
  </table>
 </form>
  <br/><div id="pnlSlot"><input name="btnAddSlot" type="button" value="Add New" class="button" onClick="addSlot();" /></div>


<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Home - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Time Slots</li></ul>";
  //Apply the template
  include("master_registration.php");
?>