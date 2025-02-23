<?php
  //Buffer larger content areas like the main page content
  ob_start();
?>

<script>
function validate_form(thisform)
{
	with (thisform)
	  {
		if (!validate_required(txtAcYear))
		{alert("One or more mandatory fields are kept blank.");return false;}
	  }
}
</script>

<h1>Academic Transcript</h1>
<?php
	include('dbAccess.php');
	include('authcheck.inc.php');
	
	if (isset($_POST['btnSubmit']))
	{
		//$type = $_POST['lstType'];
		$medium = $_POST['lstMedium'];
		$indexNo = $_POST['lstIndexNo'];
		$acYear = $_POST['txtAcYear'];
		//$withMarks = $_POST['chkMarks'];
		//$exPeriod = $_POST['txtExperiod'];
		if ($medium=='English')
			header("location:rptFullTranscriptE.php?indexNo=$indexNo&acYear=$acYear");
		else if ($medium=='Sinhala')
			header("location:rptFullTranscriptS.php?indexNo=$indexNo&acYear=$acYear");
	}
?>
<form method="post" action="" onsubmit="return validate_form(this);" class="plain">
<table class="searchResults">

    <tr>
    	<td>Medium : </td><td><select name="lstMedium">
        		<option value="English">English</option>
            	<option value="Sinhala">Sinhala</option>
            </select>
       	</td>
    </tr>
    <tr>
    	
      <td height="28">Index No. : </td>
      <td><select name="lstIndexNo" id="lstIndexNo">
            <?php
				$result = executeQuery("SELECT DISTINCT indexNo FROM exameffort");
				if (mysql_num_rows($result)>0)
				{
					while ($row=mysql_fetch_array($result))
					{
						echo "<option value='".$row['indexNo']."'>".$row['indexNo']."</option>";
					}
				}
			?>
            </select>
     	</td>
    </tr>
    <tr>
    	<td>Ac. Year : </td><td><input name="txtAcYear" type="text" value="" /></td>
    </tr>
	
</table>
<br/><br/>
<p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'home.php';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="submit" value="Create" class="button" /></p>
</form>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
   $pagetitle = "Academic Transcript - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Academic Transcript</li></ul>";
  //Apply the template
  include("master_registration.php");
?>