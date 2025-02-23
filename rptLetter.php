<?php
//2021-03-25 start  include('dbAccess.php');
require_once("dbAccess.php");
$db = new DBOperations();
//2021-03-25 end
//include('authcheck.inc.php');

//2021-03-25 start  $entryYear = cleanInput($_GET['lstEntryYear']);
$entryYear = $db->cleanInput($_GET['lstEntryYear']);
$alYear = $db->cleanInput($_GET['lstALYear']);
$title = $db->cleanInput($_GET['title']);
$qualificayion = $db->cleanInput($_GET['qualification']);


//2021-03-25 end
?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="lib/tablesort/tablesort.js"></script>
<link href="css/print.css" rel="stylesheet" type="text/css" media="screen,print,projection" />
<style type='text/css' media='print'>
	@page {size:A4; size:portrait}
	#btnPrint {display : none}
    p{}
</style>

<div align="right"><input type="button" id="btnPrint" value="Print" onClick="window.print();return false"/></div>
</head>

	
    <?php 
	//@page {width:834px; height:415px; size:landscape}
	//2021-03-25 start  $result = executeQuery("SELECT nameSinhala,addS1,addS2,addS3 FROM localapplicant JOIN applicant ON localapplicant.appNo = applicant.appNo WHERE entryYear = '$entryYear' AND qualified ='Yes'  ORDER BY zScore");
  //$result = $db->executeQuery("SELECT nameSinhala,addS1,addS2,addS3 FROM localapplicant JOIN applicant ON localapplicant.appNo = applicant.appNo WHERE entryYear = '$entryYear' AND qualified ='Yes'  ORDER BY zScore");
  if($qualificayion=="pali")
  {
  $result = $db->executeQuery("SELECT * FROM localapplicant JOIN applicantsubjects ON localapplicant.appNo = applicantsubjects.appNo JOIN applicant ON localapplicant.appNo = applicant.appNo WHERE alYear = '$alYear' AND subjectCode = '12' AND titleE='$title'  ORDER BY zScore DESC");

  $i=1;
  //2021-03-25 end
	//2021-03-25 start  while ($row = mysql_fetch_array($result))
  while ($row = $db->Next_Record($result))
  //2021-03-25 end
		{
		?>
	
<p>&nbsp;</p>
<p>&nbsp;</p>
<table align="center" width="750px" height="750px" border="0">
  <tr>
             <td height="250px" width="70px" style="border:0;" > 
            <p><br><br><br><br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
            &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;   BPU/ASS-04/UD-11/2021</p>

      
             </td>  
        </tr>
<tr><td align="right" height="20px" width="350px" style="border:0;">2021/12/ &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   
</td></tr>
        <tr><td  width="350" align="left" style="width:350px; height:150px; border:0; ">
<p><?php echo $row['nameSinhala'].",<br/>".$row['addS1']."<br/>". $row['addS2']."<br/>".$row['addS3'];?>
      </p>
      </td>
        <!-- <td width="350" align="left"  style="width:350px; height:150px; border:hidden;"><?php echo $row['nameSinhala'].",<br/>".$row['addS1']."<br/>". $row['addS2']."<br/>".$row['addS3'];?></td> -->
      </tr>
      <tr>
          <td style=" border:hidden;"><p>ගෞරවණීය ස්වාමීන් වහන්ස/මහත්මයාණෙනි,</p>
          <p  align="justify"><b><u>2021/2022 ශී‍්‍ර ලංකා බෞද්ධ හා පාලි විශ්වවිද්‍යාලයීය ප‍්‍රවේශය</u></b> </p>
          <p  align="justify">ඔබ වහන්සේ/ඔබ මෙම විශ්වවිද්‍යාලයේ 2021/2022 අධ්‍යයන වර්ෂය සඳහා අභ්‍යන්තර ශිෂ්‍යයෙකු වශයෙන් සාමාන්‍ය ප‍්‍රවේශය යටතේ බඳවා ගැනීමට 
සුදුසුකම් පරීක්‍ෂා කිරීමේ සම්මුඛ පරීක්‍ෂණය 2021 දෙසැම්බර් මස &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   දින පෙ.ව / ප.ව................ට අංක 214 බෞද්ධාලෝක මාවත, 
කොළඹ 07 හි පිහිටි ශී‍්‍ර ලංකා බෞද්ධ හා පාලි විශ්වවිද්‍යාලයීය පශ්චාද් උපාධි පීඨය හා බාහිර විභාග මධ්‍යස්ථානයේ් දී පැවැත් වේ.</p>
<p>02.   සුදුසුකම් පරීක්ෂා කර බැලීමේ සම්මුඛ පරීක්ෂණය සඳහා ඔබ වහන්සේ/ඔබ පැමිණෙන විට පහත සඳහන් සහතිකවල <b>මුල් පිටපත්</b> හා <b>ඡායා පිටපත්</b> 
හා අනෙකුත් ලිපි ලේඛන රැගෙන පැමිණිය යුතු ය. </p>  
<ol type="i">

	 
    <li>ජාතික හැඳුනුම්පත</li>
    <li>උප්පැන්න සහතිකය</li>
    <li>සාමණේර භික්ෂූන් පිළිබඳ ප‍්‍රකාශනය/උපසම්පන්න භික්ෂූන් පිළිබඳ ප‍්‍රකාශනය</li>
    <li>පාසල්/පිරිවෙන් කාර්ය දර්ශනය (අස්වීමේ සහතිකය)</li>
    <li>අ.පො.ස. (උ/පෙළ) සහතිකය (විභාග දෙපාර්තමේන්තුවෙන් හෝ පාසලක/පිරිවෙනක
විදුහල්පති/පරිවේණාධිපති විසින් නිකුත් කළ සහතික පමණක් භාර ගනු ලැබේ.)</li>
    <li>ප‍්‍රාචීන මධ්‍යම විභාග සහතිකය (විභාග දෙපාර්තමේන්තුවෙන් හෝ පාසලක/පිරිවෙනක විදුහල්පති/පරිවේණාධිපති විසින් නිකුත් කළ සහතික පමණක් 
භාර ගනු ලැබේ.)</li>
    <li>අ.පො.ස. (උ/පෙළ) සඳහා පාලි විෂය හදාරා නොමැති අයදුම්කරුවන් පහත සඳහන් සුදුසුකම්වලින් එකක් සම්පූර්ණ කර තිබිය යුතු ය.</li>
    <ol type="a">
        <li>ප‍්‍රාචීන ප‍්‍රාරම්භ විභාගය (පාලි භාෂාව සමත් වීම)</li>
        <li>පිරිවෙන් අවසාන විභාගය (පාලි භාෂාව සමත් වීම)</li>
        <li>අ.පො.ස. (සා/පෙළ) විභාගය (පාලි විෂය සමත් වීම)</li>
        <li>ශ‍්‍රී ලංකා බෞද්ධ හා පාලි විශ්වවිද්‍යාලයේ පාලි ඩිප්ලෝමා පරීක්ෂණය සමත් වීම.)</li>
        <li>බෞද්ධ ධර්මාචාර්ය විභාගය සමත් වීම.</li>
    </ol>

        </ol>     
</td>
        </tr>
        
       
     </table> 
     <div style="page-break-after:always"></div>
         <?php
         $i++;
		 }
    }
    elseif($qualificayion=="other_pali")
    {
      $result = $db->executeQuery("SELECT * FROM localapplicant JOIN applicantpali ON localapplicant.appNo = applicantpali.appNo JOIN applicant ON localapplicant.appNo = applicant.appNo WHERE alYear = '$alYear' AND titleE = '$title' AND result IS NOT NULL  ORDER BY  zScore DESC");

      //$result = $db->executeQuery("SELECT * FROM localapplicant JOIN applicantsubjects ON localapplicant.appNo = applicantsubjects.appNo JOIN applicant ON localapplicant.appNo = applicant.appNo WHERE alYear = '$alYear' AND subjectCode = '12' AND titleE='$title'  ORDER BY zScore DESC");

      $i=1;
      //2021-03-25 end
      //2021-03-25 start  while ($row = mysql_fetch_array($result))
      while ($row = $db->Next_Record($result))
      //2021-03-25 end
        {
        ?>
      
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <table align="center" width="750px" height="750px" border="0">
      <tr>
                 <td height="250px" width="70px" style="border:0;" > 
                <p><br><br><br><br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;   BPU/ASS-04/UD-11/2021</p>
    
          
                 </td>  
            </tr>
    <tr><td align="right" height="20px" width="350px" style="border:0;">2021/12/ &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;   
    </td></tr>
            <tr><td  width="350" align="left" style="width:350px; height:150px; border:0; ">
    <p><?php echo $row['nameSinhala'].",<br/>".$row['addS1']."<br/>". $row['addS2']."<br/>".$row['addS3'];?>
          </p>
          </td>
            <!-- <td width="350" align="left"  style="width:350px; height:150px; border:hidden;"><?php echo $row['nameSinhala'].",<br/>".$row['addS1']."<br/>". $row['addS2']."<br/>".$row['addS3'];?></td> -->
          </tr>
          <tr>
              <td style=" border:hidden;"><p>ගෞරවණීය ස්වාමීන් වහන්ස/මහත්මයාණෙනි,</p>
              <p  align="justify"><b><u>2021/2022 ශී‍්‍ර ලංකා බෞද්ධ හා පාලි විශ්වවිද්‍යාලයීය ප‍්‍රවේශය</u></b> </p>
              <p  align="justify">ඔබ වහන්සේ/ඔබ මෙම විශ්වවිද්‍යාලයේ 2021/2022 අධ්‍යයන වර්ෂය සඳහා අභ්‍යන්තර ශිෂ්‍යයෙකු වශයෙන් සාමාන්‍ය ප‍්‍රවේශය යටතේ බඳවා ගැනීමට 
    සුදුසුකම් පරීක්‍ෂා කිරීමේ සම්මුඛ පරීක්‍ෂණය 2021 දෙසැම්බර් මස &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;   දින පෙ.ව / ප.ව................ට අංක 214 බෞද්ධාලෝක මාවත, 
    කොළඹ 07 හි පිහිටි ශී‍්‍ර ලංකා බෞද්ධ හා පාලි විශ්වවිද්‍යාලයීය පශ්චාද් උපාධි පීඨය හා බාහිර විභාග මධ්‍යස්ථානයේ් දී පැවැත් වේ.</p>
    <p>02.   සුදුසුකම් පරීක්ෂා කර බැලීමේ සම්මුඛ පරීක්ෂණය සඳහා ඔබ වහන්සේ/ඔබ පැමිණෙන විට පහත සඳහන් සහතිකවල <b>මුල් පිටපත්</b> හා <b>ඡායා පිටපත්</b> 
    හා අනෙකුත් ලිපි ලේඛන රැගෙන පැමිණිය යුතු ය. </p>  
    <ol type="i">
    
       
        <li>ජාතික හැඳුනුම්පත</li>
        <li>උප්පැන්න සහතිකය</li>
        <li>සාමණේර භික්ෂූන් පිළිබඳ ප‍්‍රකාශනය/උපසම්පන්න භික්ෂූන් පිළිබඳ ප‍්‍රකාශනය</li>
        <li>පාසල්/පිරිවෙන් කාර්ය දර්ශනය (අස්වීමේ සහතිකය)</li>
        <li>අ.පො.ස. (උ/පෙළ) සහතිකය (විභාග දෙපාර්තමේන්තුවෙන් හෝ පාසලක/පිරිවෙනක
    විදුහල්පති/පරිවේණාධිපති විසින් නිකුත් කළ සහතික පමණක් භාර ගනු ලැබේ.)</li>
        <li>ප‍්‍රාචීන මධ්‍යම විභාග සහතිකය (විභාග දෙපාර්තමේන්තුවෙන් හෝ පාසලක/පිරිවෙනක විදුහල්පති/පරිවේණාධිපති විසින් නිකුත් කළ සහතික පමණක් 
    භාර ගනු ලැබේ.)</li>
        <li>අ.පො.ස. (උ/පෙළ) සඳහා පාලි විෂය හදාරා නොමැති අයදුම්කරුවන් පහත සඳහන් සුදුසුකම්වලින් එකක් සම්පූර්ණ කර තිබිය යුතු ය.</li>
        <ol type="a">
            <li>ප‍්‍රාචීන ප‍්‍රාරම්භ විභාගය (පාලි භාෂාව සමත් වීම)</li>
            <li>පිරිවෙන් අවසාන විභාගය (පාලි භාෂාව සමත් වීම)</li>
            <li>අ.පො.ස. (සා/පෙළ) විභාගය (පාලි විෂය සමත් වීම)</li>
            <li>ශ‍්‍රී ලංකා බෞද්ධ හා පාලි විශ්වවිද්‍යාලයේ පාලි ඩිප්ලෝමා පරීක්ෂණය සමත් වීම.)</li>
            <li>බෞද්ධ ධර්මාචාර්ය විභාගය සමත් වීම.</li>
        </ol>
    
            </ol>     
    </td>
            </tr>
            
           
         </table> 
         <div style="page-break-after:always"></div>
             <?php
             $i++;
         }
    }
		 ?>
             	
			           
</html>
