<?php
  ob_start();
  
  //2021.03.24 start  include('dbAccess.php');
  require_once("dbAccess.php");
  $db = new DBOperations();
  //2021-03-23 end

  include('authcheck.inc.php');
?>
 <script language="javascript">
 var xmlhttp;

function change(value)
{
xmlhttp=GetXmlHttpObject();
if (xmlhttp==null)
  {
  alert ("Browser does not support HTTP Request");
  return;
  }
var url="selectRptTimeTbl.php";
url=url+"?type="+value;
url=url+"&sid="+Math.random();
xmlhttp.onreadystatechange=stateChanged;
xmlhttp.open("GET",url,true);
xmlhttp.send(null);
}

function stateChanged()
{
if (xmlhttp.readyState==4)
{
document.getElementById("pnlTimeTbl").innerHTML=xmlhttp.responseText;
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
<h1> Time Table Report </h1>

<br/>
<form name="reportTimeTable" method="post" onsubmit="return false;">
  <table class="searchResults">
    
    <tr>
      <td><pre><font face="Verdana, Arial, Helvetica, sans-serif" size="2"> Time Table Type:</font></pre></td>
      <td align="left">
        <select name="lstType" id="lstType"  onChange="change(this.value)">
          <option selected>-- Select Type --</option>
          <option value="lecturer">Lecturer</option>
          <option value="student">Student</option>  
        </select>
    </td>
    </tr> </table>

 
</form>

 <br/><div id="pnlTimeTbl"></div>


<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "Time Table Report - Student Management System - Buddhisht & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li>Time Table Report</ul>";
  //Apply the template
  include("master_registration.php");
?>