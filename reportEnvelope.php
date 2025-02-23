<?php
  //Buffer larger content areas like the main page content
  ob_start();
 ?>

<h1> Envelope Report </h1>

<?php
  //2021-03-24 start include('dbAccess.php');
	require_once("dbAccess.php");
	$db = new DBOperations();
    //2021-03-24 end
  include("authcheck.inc.php");
?>
<form method="get" action="rptEnvelope.php" class="plain">
<table class="searchResults">

<tr>
         <td>A/L Year : </td><td><select name="lstALYear" id="lstALYear" size="auto">
		 <?php
			//2021.03.24 start  $result=executeQuery("SELECT DISTINCT alYear FROM localapplicant");
			$result=$db->executeQuery("SELECT DISTINCT alYear FROM localapplicant");
			//2021.03.24 end
			while($resultSet = $db->Next_Record($result))
			{
				$rALYear = $resultSet["alYear"];
				//$district = $resultSet["districtEnglish"];
				echo "<option value=\"".$rALYear."\">".$rALYear."</option>";
        	} 
			
			?>
        	</select></td></tr>
		
<tr>
			<td>Title : </td>
			<td>
			<select name="title" id="title" size="auto">
			<?php
			$result=$db->executeQuery("SELECT DISTINCT titleE FROM applicant");
			//2021.03.24 end
			// echo "<option value=\"".All."\">".All."</option>";
			while($resultSet = $db->Next_Record($result))
			{
				$rtitle = $resultSet["titleE"];
				//$district = $resultSet["districtEnglish"];
				
				echo "<option value=\"".$rtitle."\">".$rtitle."</option>";
        	} 
              
				
			?>
			</select>
			</td></tr>
      
	    <tr>
    	<td>Entry Year : </td><td><select name="lstEntryYear" id="lstEntryYear" size="auto">
        	<?php
			//2021.03.24 start  $result=executeQuery("SELECT DISTINCT entryYear FROM applicant");
      $result=$db->executeQuery("SELECT DISTINCT entryYear FROM applicant");
      //2021.03.24 end
			//2021.03.24 start  for ($i=0;$i<mysql_numrows($result);$i++)
      //for ($i=0;$i<$db->Row_Count($result);$i++)
      //2021.03.24 end
		/* 	{
				$rEntryYear = mysql_result($result,$i,"entryYear");
              	echo "<option value=\"".$rEntryYear."\">".$rEntryYear."</option>";
        	} */ 

          while($resultSet = $db->Next_Record($result))
			{
				$rEntryYear = $resultSet["entryYear"];
				//$district = $resultSet["districtEnglish"];
				echo "<option value=\"".$rEntryYear."\">".$rEntryYear."</option>";
        	} 
			?>
        	</select></td></tr>
                <tr><td>Qualification Type:</td><td><select name="qualification" id="qualification" size="auto">
					<option value="pali">Pali Qualified</option>
					<option value="other_pali">Other Pali Qualified</option>

				</tr>
     
        
</table>
<br/><br/>
<p>&nbsp;&nbsp;&nbsp;<input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'home.php';"  class="button"/>&nbsp;&nbsp;&nbsp;
<!--<a href="rptApplicants.php" id="printLink" onClick="OpenPopup(this.href); return false">Click Here to See Popup</a>-->
<input name="btnSubmit" type="submit" value="Report" class="button"></p>
</form>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Envelope Report - Student Management System - Buddhisht & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Envelope Report</ul>";
  //Apply the template
  include("master_registration.php");
?>