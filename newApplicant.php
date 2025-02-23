<?php
  ob_start();
?>
<script language="javascript">

function change(value){

if (value=="LA"){

window.location = 'newLocalUpdated.php';
}
else if (value=="FA"){
window.location = 'newForeign.php';
}
}
</script>
<h1> New Applicant </h1>
<form name="registration" method="post" onsubmit="return false;">
  <table class="searchResults">
    
    <tr>
      <td width="181" ><pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> Applicant Type</font></pre></td>
      <td width="331" align="left"><label>
        <select name="lstAppType" id="lstAppType"  onChange="change(this.value)">
          <option selected>-- Select Type --</option>
          <option value="LA">Local Applicant</option>
          <option value="FA">Foreign Applicant</option>  
        </select>
      </label></td>
    </tr> </table>

 
</form>





<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "New Applicant - Applicants - Student Management System - Buddhisht & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='applicant.php'>Applicants </a></li><li>New Applicant</ul>";
  //Apply the template
  include("master_registration.php");
?>