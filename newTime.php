<?php include("dbAccess.php"); ?>
<h2>Add New</h2>
<form method="post" action="" onsubmit="return validate_form(this);" class="plain">
<table class="searchResults">
    <tr>
    	<td>Slot ID : </td><td><input name="txtSlotID" type="text"></td>
    </tr>
    <tr>
    	<td>Day in English : </td><td><select name="txtDayE">
    	  <option selected="selected">Monday</option>
    	  <option>Tuesday</option>
    	  <option>Wednesday</option>
    	  <option>Thursday</option>
    	  <option>Friday</option>
    	  <option>Saturday</option>
    	  <option>Sunday</option>
    	</select></td>
    </tr>
    <tr>
    	<td>Day in Sinhala : </td><td><input name="txtDayS" type="text"></td>
    </tr>
     <tr>
    	<td>Time Slot : </td><td><select name="lstTimeSlot">
    	  <option selected="selected">8.30-9.30 a.m</option>
    	  <option>9.30-10.30 a.m</option>
    	  <option>10.30-11.30 a.m</option>
    	  <option>12.30-01.30 p.m</option>
    	  <option>01.30-02.30 p.m</option>
    	  <option>02.30-03.30 p.m</option>
    	  <option>03.30-04.30 p.m</option>
    	</select></td>
    </tr>
    
</table>
<br/><br/>
<p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = '';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="submit" value="Submit" class="button" /></p>
</form>
