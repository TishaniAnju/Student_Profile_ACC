<?php include("dbAccess.php"); ?>
<h2>Add New</h2>
<form method="post" action="" onsubmit="return validate_form(this);" class="plain">
<table class="searchResults">
    <tr>
    	<td>Epf No : </td><td>
        	<input name="txtEpfNo" type="text">
        </td>
    </tr>
    <tr>
    	<td>Name : </td><td>
        	<input name="txtName" type="text">
        </td>
    </tr>
    
</table>
<br/><br/>
<p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = '';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="submit" value="Submit" class="button" /></p>
</form>
