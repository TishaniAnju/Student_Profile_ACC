<input type="button" id="btnAddRow" onclick="addRow('subjects')" value="Add Subject" class="button" />
<input type="button" id="btnDeleteRow" onclick="deleteRow('subjects')" value="Remove" class="button"/>
<br/><br/>
<table id="subjects">
	<tr>
    	<td><input name="chk[]" id="chk" type="checkbox" value="" /></td>
    	<td><select name="lstSubject[]" id="lstSubject" style="width:auto">
        	<?php
			include("dbAccess.php");
			$query = "SELECT * FROM subject";
			$result = executeQuery($query);
			for ($i=0;$i<mysql_numrows($result);$i++)
			{
				$rID = mysql_result($result,$i,"subjectID");
				$rCode = mysql_result($result,$i,"codeEnglish");
				$rSubject = mysql_result($result,$i,"nameEnglish");
              	echo "<option value=\"".$rID."\">".$rCode." - ".$rSubject."</option>";
        	} 
			?>
        	</select>
        </td>
    </tr>
</table>
<br/><br/>
<input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = '';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="submit" value="Submit" class="button" />