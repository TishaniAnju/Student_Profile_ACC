<?php
  ob_start();
?>

<script language="javascript" src="addRow_list.js"></script>
<script type="text/javascript" src="lib/pop-up/popup-window.js"></script>
<link href="lib/pop-up/sample.css" rel="stylesheet" type="text/css" />





<h1> Stores data Transfer </h1>
<?php
	require_once("dbAccess.php");
	$db = new DBOperations();
	
//include("authcheck.inc.php");

	if (isset($_POST['btnSubmit']))
	{
    //$x= "1";
    //$y="abc";
    $query = "SELECT 


fxGINNo,
fxGINSub,
fxGRN,
fxGRNSub,
fxHdr2,
fxCode,
fxAmount,
fxIDate,
fxRDate,
fxUPFNo,
fxDept,
fxRmks,
fxSerialNo,
fxPhoto,
fxStatus,
fxSalvage



 FROM  st_fxissue       " ; 
    $result = $db->executeQuery($query);
    while($row= $db->Next_Record($result))
    {
    $a = $row['fxGINNo'];
    
    
    $b =  $row['fxGINSub'];
    $c =  $row['fxGRN'];

    // $c =  $db->Real_Escape($row['st_ConIDesc']);
   $d =  $row['fxGRNSub']; 
   $e =  $row['fxHdr2'];
   $f =  $row['fxCode'];
  $g =  $row['fxAmount']; 
   $h =  $row['fxIDate'];  
     $i =  $row['fxRDate'];
    $j =  $row['fxUPFNo'];
    $k =  $row['fxDept'];    
    $l =  $row['fxRmks'];  
    $m =  $row['fxSerialNo'];
    $n =  $row['fxPhoto'];
    $o =  $row['fxStatus'];
    $p =  $row['fxSalvage'];  


 //$queryS="INSERT INTO  sto_fxissues set 
 	//	fxGINNo = '$a',	fxGINSub='$b',fxGRN = '$c',fxGRNSub = '$d', fxHdr2 = '$e',fxCode = '$f',fxAmount = '$g',	fxIDate='$h',	fxRDate='$i',	fxUPFNo='$j',fxDept='$k',fxRmks='$l',fxSerialNo='$m',fxPhoto='$n',fxStatus='$o',fxSalvage='$p' "; 
  $resultS = $db->executeQuery($queryS); 
    }
	
	
}
	 
	

?>
<form action="" method="post"  >
   
    <table class="searchResults">
    <!-- <p  style="font-family:'Iskoola Pota',sans-serif" font-size="100px"  align="justify">ඔබ වහන්සේ/ඔබ මෙම විශ්වවිද්‍යාලයේ 2021/2022 අධ්‍යයන වර්ෂය සඳහා අභ්‍යන්තර ශිෂ්‍යයෙකු වශයෙන් සාමාන්‍ය ප‍්‍රවේශය යටතේ බඳවා ගැනීමට 
සුදුසුකම් පරීක්‍ෂා කිරීමේ සම්මුඛ පරීක්‍ෂණය 2021 දෙසැම්බර් මස &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   දින පෙ.ව / ප.ව................ට අංක 214 බෞද්ධාලෝක මාවත, 
කොළඹ 07 හි පිහිටි ශී‍්‍ර ලංකා බෞද්ධ හා පාලි විශ්වවිද්‍යාලයීය පශ්චාද් උපාධි පීඨය හා බාහිර විභාග මධ්‍යස්ථානයේ් දී පැවැත් වේ.</p>
<p>02.   සුදුසුකම් පරීක්ෂා කර බැලීමේ සම්මුඛ පරීක්ෂණය සඳහා ඔබ වහන්සේ/ඔබ පැමිණෙන විට පහත සඳහන් සහතිකවල <b>මුල් පිටපත්</b> හා <b>ඡායා පිටපත්</b> 
හා අනෙකුත් ලිපි ලේඛන රැගෙන පැමිණිය යුතු ය. </p>   -->

    <tr>
        <td height="46" colspan="2"><div align="center">
        <input type="submit" name="btnSubmit" id="btnSubmit" value="Submit" tabindex="26" class="button" />
        </div></td>
      </tr>


    
    </table>
</form> 




<!--PopupForm-->



<?php
    //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "New Local Applicant - Applicants - Student Management System - Buddhisht & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='test.php'>Applicants </a></li><li>New Local Applicant</ul>";
  //Apply the template
  include("master_registration.php");
?>

