<?php

  ob_start();

?>
<!--
<script language="javascript">
function validate_form(thisform)
{
	with (thisform)
	  {
		if (!validate_required(txtsubCode) ||!validate_required(txtNameE) || !validate_required(txtNameS))
		{alert("One or more mandatory fields are kept blank.");return false;}
	  }
}
</script>
-->
<?php

 require_once("dbAccess.php");
 $db = new DBOperations();

// include('authcheck.inc.php');
//echo("Test");
//exit;

$uname = "new";
$txtNameE="";
if(isset($_POST['uname']))
{
    $uname = $_POST['uname'];
    $userdata= $db->Next_Record($db->executeQuery("SELECT description FROM alstream WHERE streamId ='$uname';"));
    $txtNameE = $userdata[0];
}



    if (isset($_POST['btnDel']))
	{
        $uname = $db->cleanInput($_POST['uname']);
        $query = "DELETE FROM alstream WHERE streamId ='$uname'; ";
        $result = $db->executeQuery($query);
        $uname = "new";
        $txtNameE="";
	}
    else if (isset($_POST['btnEdi']))
	{
        $uname = $db->cleanInput($_POST['uname']);
        $txtNameE = $db->cleanInput($_POST['txtNameE']);
        $query = "UPDATE alstream SET description='$txtNameE' WHERE streamId ='$uname'; ";
        $result = $db->executeQuery($query);
	}
    else if(isset($_POST['btnAdd']))
	{
        $txtNameE = $db->cleanInput($_POST['txtNameE']);
        $query = "INSERT INTO alstream SET description='$txtNameE'; ";
        $result = $db->executeQuery($query);
        $uname = "new";
        $txtNameE="";
	}


?>
<form id="form1" name="form1" action="" method="post" onsubmit="return validate_form(this);" class="plain">
<h1> A/L Stream Details</h1>

<table class="searchResults">
   <tr>
    <td>Stream</td>
    <td>
        <select name="uname" id="uname" onChange="document.form1.submit()">
       <option value="new">New Stream</option>
       <?php
       $empnos = $db->executeQuery("SELECT * FROM alstream;");
	   while ($emps = $db->Next_Record($empnos))
	   {
		  ?>
		  <option value="<?php echo $emps[0]?>"><?php echo $emps[1]?></option>
		  <?php 
	   }
	   ?>
       </select>
       <script>
       document.getElementById("uname").value="<?php echo $uname;?>";
       </script>
       </td>
   </tr>
  <tr>
    <td>Stream Name</td>
    <td><input name="txtNameE" id="txtNameE" value="<?php echo($txtNameE); ?>" type="text" tabindex="2"></td>
  </tr>
  <tr><td colspan="2"><input name="btnCancel" type="button" value="Cancel" class="button" onclick="document.location.href='alSub.php';" tabindex="3" />&nbsp;&nbsp;
      <?php
      if($uname == "new")
      {
          ?>
      <input name="btnAdd" type="submit" value="Add" align="middle" class="button" tabindex="4">
      <?php
      }
      else{
          
          ?>
      <input name="btnEdi" onClick="return confirm('Are You Sure to Edit?');" type="submit" value="Edit" align="middle" class="button" tabindex="4">&nbsp;&nbsp;<input name="btnDel" type="submit" onClick="return confirm('Are You Sure to Delete?');" value="Delete" align="middle" class="button" tabindex="4">
      
      <?php
      }
      ?>
      
      
  </td></tr>
 </table><br>
<br>
<br>

    <table width="100%" class="searchResults">
    <?php
       $empnos = $db->executeQuery("SELECT * FROM alstream;");
        if ($db->Row_Count($empnos)>0)
        {
           ?>
              <tr><td>#</td><td>Name</td></tr>
              <?php 
           while ($emps = $db->Next_Record($empnos))
           {
              ?>
              <tr><td><?php echo($emps[0])?></td><td><?php echo($emps[1])?></td></tr>
              <?php 
           }
        }
        else
        {
            ?>
        <tr><td>No Data</td></tr>
        
        <?php
        }
    ?>
</table>
</form>


<?php
    //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "New A/L Subject - A/L Subjects - Student Management System - Buddhisht & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a Href='alSub.php'>A\L Subjects </a></li><li>New A\L Subject</ul>";
  //Apply the template
  include("master_registration.php");
?>


