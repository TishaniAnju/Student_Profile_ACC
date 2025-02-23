<?php 

include("dbAccess.php");
$type = $_GET['type'];
?>




<?php

if($type=='lecturer')
{
?>
<form method="get" action="rptTTLecturer.php" class="plain">
<table class="searchResults">

	<tr>
    	<td>Academic Year: </td><td><input name="txtAcYear" type="text" />(eg:2010)
    	 </td>
    </tr>
    
    <tr>
    	<td>Name : </td><td><select name="lstLecturer" id="lstLecturer" size="auto">
        	<?php
			$result=executeQuery("SELECT * FROM lecturer");
			for ($i=0;$i<mysql_numrows($result);$i++)
			{
				$rEpfNo = mysql_result($result,$i,"epfNo");
				$rName = mysql_result($result,$i,"name");
              	echo "<option value=\"".$rEpfNo."\">".$rName."</option>";
        	} 
			?>
        	</select></td>
    </tr>  
        
</table>
<br/><br/>
<p>&nbsp;&nbsp;&nbsp;<input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = '';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="Submit" value="Submit" class="button"></p>
</form>

<?php
}
elseif($type=='student')
{
?>
<form method="get" action="rptTTStudent.php" class="plain">
<table class="searchResults">

	<tr>
    	<td>Academic Year: </td><td><input name="txtAcYear" type="text" />(eg:2010)
    	 </td>
    </tr>
    
    <tr>
    	<td>Level : </td><td><select name="lstLevel" id="lstLevel" size="auto">
        	<?php
			$result=executeQuery("SELECT DISTINCT level FROM subject");
			for ($i=0;$i<mysql_numrows($result);$i++)
			{
				$rlevel = mysql_result($result,$i,"level");
              	echo "<option value=\"".$rlevel."\">".$rlevel."</option>";
        	} 
			?>
        	</select></td>
    </tr>  
    
        
</table>
<br/><br/>
<p>&nbsp;&nbsp;&nbsp;<input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = '';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="Submit" value="Submit" class="button"></p>
</form>
<?php
}
?>






