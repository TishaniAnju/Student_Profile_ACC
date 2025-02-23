<?php
	include('dbAccess.php');
?>
<form method="post" name="form2" id="form2" action="action='studentEnroll.php?regNo=$regNo'"  class="plain">
<input type="button" id="btnAddRow" onclick="addRow('subjects')" value="Add Subject" class="button" />
<input type="button" id="btnDeleteRow" onclick="deleteRow('subjects')" value="Remove" class="button"/>
<br/><br/>
<table id="subjects">
     <tr>
    	<td>Level : </td>
		<td><select name="level" id="level" onchange="document.form2.submit()">
        	<option value="I">Level One</option>
        	<option value="II">Level Two</option>
			<option value="III">Level Three</option>
        	<option value="IV">Level Four</option>
        </select>
		<script>
								document.getElementById('level').value = "<?php echo $level;?>";
							</script>
		</td>
    </tr>
	<tr>
    	
      <td>Semester : </td>
      <td><select name="subSemester" id="subSemester" onchange="document.form2.submit()">
        	<option value="First Semester">First Semester</option>
        	<option value="Second Semester">Second Semester</option>
        </select>
		
		<script>
								document.getElementById('subSemester').value = "<?php echo $semester;?>";
							</script>
		</td>
    </tr>
	<tr>
    	<td><input name="chk[]" id="chk" type="checkbox" value="" /></td>
    	<td><select name="lstSubject[]" id="lstSubject" style="width:auto">
        	<?php
			
			//$query = "SELECT * FROM subject WHERE level='$level' and semester='$semester'";
			$query = "SELECT * FROM subject";
		//print $query;
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
	<tr>
      <td>Academic Year: </td>
      <td><label>
<select name="acyear" id="acyear">
<?php
 $starting_year  =date('Y', strtotime('-5 year'));
 $ending_year = date('Y', strtotime('+5 year'));
 $current_year = date('Y');
 for($starting_year; $starting_year <= $ending_year; $starting_year++) {
     echo '<option value="'.$starting_year.'"';
     if( $starting_year ==  $current_year ) {
            echo ' selected="selected"';
     }
     echo ' >'.$starting_year.'</option>';
 }     
  ?>          
</select>
					
 </label>
		</td>
        
    </tr>
</table>
<br/><br/>
<input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = '';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="submit" value="Submit" class="button" />
</form>