<?php
  //Buffer larger content areas like the main page content
  ob_start();
?>
<script language="javascript">
var xmlhttp;

function getNumStudents()
{
xmlhttp=GetXmlHttpObject();
if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  return;
  }
var subjectID = document.getElementById('lstSubject').value;
var acYear = document.getElementById('txtAcYear').value;
var medium = document.getElementById('lstMedium').value;

var url="numStudents.php";
url = url+"?subjectID="+subjectID+"&acYear="+acYear+"&medium="+medium;
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);
}

function stateChanged()
{
if (xmlhttp.readyState==4)
{
document.getElementById("txtNumStudents").value=xmlhttp.responseText;
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
<script language="javascript" src="lib/scw/scw.js"></script>
<script>
function validate_form(thisform)
{
	with (thisform)
	  {
		if (!validate_required(txtCodeEnglish) || !validate_required(txtNameEnglish))
		{alert("One or more mandatory fields are kept blank.");return false;}
	  }
}
</script>

<h1>New Exam</h1>
<?php
	include('dbAccess.php');
  	include('authcheck.inc.php');
	
	if (isset($_POST['btnSubmit']))
	{
		$subjectID = $_POST['lstSubject'];
		$acYear = cleanInput($_POST['txtAcYear']);
		$medium = $_POST['lstMedium'];
		$date = cleanInput($_POST['txtDate']);
		$time = cleanInput($_POST['txtTime']);
		$venue = $_POST['lstVenue'];
		if (is_array($venue)) $venue = implode(',',$venue);
		echo $venue;
		$query = "INSERT INTO examschedule SET subjectID='$subjectID', acYear='$acYear', medium='$medium', date='$date', time='$time', venue='$venue'";
		$result = executeQuery($query);
		header("location:examSchedule.php");
	}
?>
<form method="post" action="" class="plain">
<table class="searchResults">
    <tr>
    	<td>Subject : </td><td>
        	<select name="lstSubject" id="lstSubject" size="auto" onchange="getNumStudents();">
        	<?php
			$query = "SELECT * FROM subject";
			$result = executeQuery($query);
			for ($i=0;$i<mysql_numrows($result);$i++)
			{
				$rSubjectID = mysql_result($result,$i,"subjectID");
				$rCode = mysql_result($result,$i,"codeEnglish");
				$rName = mysql_result($result,$i,"nameEnglish");
              	echo "<option value=\"".$rSubjectID."\">".$rCode." - ".$rName."</option>";
        	}
			?>
        	</select>
        </td>
    </tr>
    <tr>
    	<td>Academic Year : </td><td><input name="txtAcYear" id="txtAcYear" type="text" onkeyup="getNumStudents();" /></td>
    </tr>
    <tr>
    	<td>Medium : </td><td>
        	<select name="lstMedium" id="lstMedium" size="auto" onchange="getNumStudents();">
            	<option value="English">English</option>
                <option value="Sinhala">Sinhala</option>
            </select>
       	</td>
    </tr>
    <tr>
    	<td>No. of Students Registered : </td><td><input name="txtNumStudents" id="txtNumStudents" type="text" value="0" readonly="readonly" /></td>
    </tr>
    <tr>
    	<td>Date : </td><td><input name="txtDate" type="text" value="<?php echo date('Y-m-d'); ?>" onclick="scwShow(this,event);" /></td>
    </tr>
    <tr>
    	<td>Time : </td><td><input name="txtTime" id="txtTime" type="text" value="12:00" /></td>
    </tr>
    <tr>
    	<td>Venue : </td><td>
        	<select name="lstVenue[]" id="lstVenue" size="2" multiple="multiple" >
        	<?php
			$query = "SELECT * FROM venue";
			$result = executeQuery($query);
			for ($i=0;$i<mysql_numrows($result);$i++)
			{
				//$rVenueNo = mysql_result($result,$i,"venueNo");
				$rVenue = mysql_result($result,$i,"venue");
              	echo "<option value=\"".$rVenue."\">".$rVenue."</option>";
        	} 
			?>
        	</select>
        </td>
    </tr>
</table>
<br/><br/>
<p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'examSchedule.php';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="submit" value="Submit" class="button" /></p>
</form>
<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "New Exam - Exam Schedule - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='examSchedule.php'>Exam Schedule </a></li><li>New Exam</li></ul>";
  //Apply the template
  include("master_registration.php");
?>