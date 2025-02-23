
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
var url="newLecturer.php";
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
 //2021.03.24 start include('dbAccess.php');
  require_once('dbAccess.php');
  $db = new DBOperations();
 //2021.03.24 end 
  include('authcheck.inc.php');
  
  if (isset($_POST['btnSubmit']))
	{ //2021.03.24 start $epfNo = cleanInput($_POST['txtEpfNo']);$name = cleanInput($_POST['txtName']); 
		$epfNo = $db->cleanInput($_POST['txtEpfNo']);
		$name = $db->cleanInput($_POST['txtName']);
		
		$query = "INSERT INTO lecturer SET epfNo='$epfNo', name='$name'";
    //2021.03.24 $result = executeQuery($query); 
		$result = $db->executeQuery($query);
    //2021.03.24 end
		//header("location:message.php?message=Successfully inserted!");
	}
  
   
 if (isset($_GET['cmd']) && $_GET['cmd']=="delete")
	{ //2021.03.24  $epfNo = cleanInput($_GET['epfNo']);
		$epfNo = $db->cleanInput($_GET['epfNo']);
    //2021.03.24 end
		//$subNS= $_GET['subnamS'];
		$delQuery1 = "DELETE FROM lecturer WHERE epfNo='$epfNo'";
    //2021.03.24 start 	$result1 = executeQuery($delQuery1);
		$result1 = $db->executeQuery($delQuery1);
    //2021.03.24 end
	}	

  $query = "SELECT * FROM lecturer ORDER BY epfNo";
  //2021.03.24 start $result=executeQuery($query);
  $result=$db->executeQuery($query);
  //2021.03.24 end
?>
<h1>Lecturer Details</h1>
  
<br/>
<!--2021.03.24 (mysql_num_rows($result)>0)-->
	<?php if ($db->Row_count($result)>0){ ?>
  <form method="post" action="lecturer.php" class="plain">
<br/>
  <table class="searchResults">
	<tr>
    	<th>Epf No</th>
    	<th>Name</th>
        <th>&nbsp;</th>
	</tr>
  <!--2021.03.24 $row=mysql_fetch_array($result)-->  
<?php
  while ($row = $db->Next_Record($result))
  {
?>
	<tr>
        <td><?php echo $row['epfNo'] ?></td>
        <td><?php echo $row['name'] ?></td>
		<td><input name="btnDelete" type="button" value="Delete" onClick="if (MsgOkCancel()) document.location.href ='lecturer.php?cmd=delete&epfNo=<?php echo $row['epfNo'] ?>';" class="button" /></td>
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
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Lecturers</li></ul>";
  //Apply the template
  include("master_registration.php");
?>