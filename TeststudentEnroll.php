<?php
  //Buffer larger content areas like the main page content
  ob_start();
?>

<script language="javascript">
var xmlhttp;

function addSubjects()
{
xmlhttp=GetXmlHttpObject();
if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  return;
  }
var url="enrollSubjects.php";
url=url+"?sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);
}

function stateChanged()
{
if (xmlhttp.readyState==4)
{
document.getElementById("pnlSubjects").innerHTML=xmlhttp.responseText;
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

<script language="javascript">
function addRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	var row = table.insertRow(rowCount);
	var colCount = table.rows[0].cells.length;
	for(var i=0; i<colCount; i++) {
		var newcell	= row.insertCell(i);
		newcell.innerHTML = table.rows[0].cells[i].innerHTML;
		//alert(newcell.childNodes);
		switch(newcell.childNodes[0].type) {
			case "text":
					newcell.childNodes[0].value = "";
					break;
			case "checkbox":
					newcell.childNodes[0].checked = false;
					break;
			case "select-one":
					newcell.childNodes[0].selectedIndex = 0;
					break;
		}
	}
}

function deleteRow(tableID) {
	try {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	for(var i=0; i<rowCount; i++) {
		var row = table.rows[i];
		var chkbox = row.cells[0].childNodes[0];
		if(null != chkbox && true == chkbox.checked) {
			/*if(rowCount <= 1) {
				alert("Cannot delete all the rows.");
				break;
			}*/
			table.deleteRow(i);
			rowCount--;
			i--;
		}
	}
	if (rowCount==0) document.getElementById('pnlSubjects').innerHTML = "<input type='button' id='btnAddRow' onclick='addSubjects();' value='Add Subject' class='button' />";
	}catch(e) {
		alert(e);
	}
}
</script>

<script language="javascript">
 	function MsgOkCancel()
	{
		var message = "Please confirm to disenrol this unit ...";
		var return_value = confirm(message);
		return return_value;
	}
</script>


<h1>Student Enrollment</h1>

<?php
	include('dbAccess.php');
	include('authcheck.inc.php');
	
	if (isset($_POST['btnSubmit']))
	{
	$result = executeQuery("select regNo from studentenrolment");
	
		         while ($regNo = mysql_fetch_array($result))
				 {
				 $result2 = mysql_fetch_array(executeQuery("select indexNo from student where regNo='$regNo[0]'"));
				 echo $regNo[0]. '---'.$result2[0];
				 executeQuery("Update studentenrolment SET indexNo='$result2[0]' WHERE regNo='$regNo[0]'");
				 }
	
	
		/*$regNo = cleanInput($_GET['regNo']);
		foreach ($_POST['lstSubject'] as $val)
		{
		     $result = executeQuery("select indexNo from student where regNo='$regNo'");
	         $indexNo = mysql_fetch_array($result);
		    $query = "INSERT INTO studentenrolment SET regNo='$regNo', subjectID='$val',indexNo='$indexNo'";
			$result = executeQuery($query);
		}
		//header("location:message.php?message=Successfully inserted!");*/
	}
	
	 if (isset($_GET['cmd']) && $_GET['cmd']=="delete")
  	{
		$subjectID = cleanInput($_GET['subjectID']);
		$regNo = cleanInput($_GET['regNo']);
		$delQuery = "DELETE FROM studentenrolment WHERE regNo='$regNo' AND subjectID='$subjectID'";
		$result = executeQuery($delQuery);
  	}

	$regNo = cleanInput($_GET['regNo']);
	$result = executeQuery("SELECT nameEnglish FROM student WHERE regNo = '$regNo'");
	$student = mysql_fetch_array($result);
	echo "<h2>".$regNo." - ".$student['nameEnglish']."</h2>";
	
	$result = executeQuery("SELECT subject.subjectID,codeEnglish,nameEnglish FROM studentenrolment, subject WHERE studentenrolment.subjectID = subject.subjectID AND regNo = '$regNo'");
	
	echo "<form method='post' action='' class='plain'>";
	if (mysql_num_rows($result) > 0)
	{
		echo "<table class='searchResults'>
        	<tr>
            	<th>Subject Code</th>
                <th>Subject</th>
				<th></th>
            </tr>";
		while ($subject = mysql_fetch_array($result))
		{
			echo "<tr>
            	<td>".$subject['codeEnglish']."</td>
                <td>".$subject['nameEnglish']."</td>
           		<td><input name='btnDisenroll' type='button' value='Disenroll' class='button' onclick=\"if (MsgOkCancel()) document.location.href ='studentEnroll.php?cmd=delete&subjectID=".$subject['subjectID']."&regNo=".$regNo."'\" /></td>
            </tr>";
		}
		echo "</table>";
	}
	else echo "<p>No enrolled subjects.</p>";
?>

<br/>
<div id="pnlSubjects">
<input type="button" id="btnAddRow" onclick="addSubjects()" value="Add Subject" class="button" />
</div>
</form>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Enroll - Students - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='studentAdmin.php'>Students </a></li><li>Enroll</li></ul>";
  //Apply the template
  include("master_registration.php");
?>