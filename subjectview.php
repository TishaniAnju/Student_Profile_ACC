<script language="javascript"></script>
<style>
table {
    border-collapse: collapse;
}

table,
th,
td {
    border: 1px solid black;
}

.vTableHeader1 {
    text-align: center;
	text-size:10pt;
    transform: rotate(270deg);
	
	max-width:50px;
}

.vTableHeader2 {
    text-align: center;
	text-size:10pt;
    transform: rotate(270deg);
    height: 150px;
	word-wrap: break-word;
	word-break: keep-all;
	max-width:50px;
}

.vTableHeader {
    text-align: center;
	text-size:10pt;
    transform: rotate(270deg);
    height: 75px;
	max-width:50px;
}
</style>
<center>
    <?php
	  include('dbAccess.php');
	 $courseID=$_GET['courseID'];
	 $subcrsID=$_GET['subcrsID'];
	 $emonth=$_GET['emonth'];
	 $acyear=$_GET['acyear'];
	
echo '<img src="logo.png" width="75" height="75" />';
if (isset($_POST['btn-save'])) {

    $dist = $_POST['year'];
    ?>
		<script type="text/javascript">

		var dist = document.getElementById( "year" );
			alert( dist );

			window.location.href = 'new333.php?dist='+dist
	</script>
	<?php

}
if (isset($_POST['btn-save'])) {

    $dist = $_POST['year'];
  
				
			header("location:newresultsheet.php?courseID=$courseID&subcrsID=$subcrsID&acyear=$acyear&emonth=$emonth");
	

}
?>
    <h3>BUDDHIST AND PALI UNIVERSITY OF SRI LANKA</h3>
    <h4>Bachlor of Arts (General) External Degree - Examination I - 2019 (October)</h4>
    <h4>Detailed Result Sheet</h4>
</center>
<div style="overflow: auto;  white-space: nowrap; margin-left: 50px; margin-right: 50px;">
    <form method="post">
        <table>
            <!-- Main Heading Row -->
            <tr>
                <!-- Fixed -->
                <th rowspan="2" class="vTableHeader1">
                    Serial Number
                </th>
                <th rowspan="2">
                    Index Number
                </th>
                <th rowspan="2" class="vTableHeader1">
                    Withheld
                </th>
                <!-- Subjects -->
                <?php
                
               $query = "SELECT * FROM subject WHERE faculty='$faculty' and level='$level'";
				//print $queryallS;
				$resultallS = executeQuery($queryallS);
	 $k=0;
				$subjects;
				
		  			  while ($rowS= mysql_fetch_array($resultallS))
					  {
						 
						 // print 'kkk'; 
  						$nameEnglish = $rowS['nameEnglish'];
						  $subjectID=$rowS['codeEnglish'];
						   $subjects[$k]=$rowS['subjectID'];
						 // print $sujects[k];
						  $k++;
						  $str2=$nameEnglish."       ".$subjectID;
			//	print $subjectID;?>
						  <th colspan="5" class="vTableHeader2"><?php echo wordwrap($str2,15,"<br>\n")?></th>
                    
                   
                    <?php
                }
				$noofsubjects=$k;
				//print 'hh';
				//print $sujects[0];
				//print 'hh';
                ?>
                
                
             
                
                <!-- Fixed -->
                <th rowspan="2" class="vTableHeader1">
                    Sub Total
                </th>
                <th rowspan="2" class="vTableHeader1">
                    %
                </th>
                <th rowspan="2" class="vTableHeader1">
                    Final Results
                </th>
            </tr>
            <!-- Sub-Heading Row -->
           
            
            
               <?php
               // $queryallSE = "Select * from crs_subject c,subject s where  c.CourseID='$courseID' and c.subcrsid='$subcrsID'  and c.subjectID=s.subjectID ";
				//print $queryallSE;
				$resultallSE = executeQuery($queryallSE);
				 $rowSE= mysql_fetch_array($resultallSE);
				//getting exam results
				$queryallSER = "Select distinct indexNo from studentenrolment acYear='$acyear' order by indexNo";
				//print $queryallSER;
				$resultallSER = executeQuery($queryallSER);
				 //$rowSER= mysql_num_rows($resultallSER);
				$j=0;
			
			//print mysql_num_rows($resultallSER);
			//print 'hhh';
			while ($rowSER=mysql_fetch_array($resultallSER))
				// for ($j=0;$j<mysql_num_rows($resultallSER);$j++)
		         { 
					// $rowSER= mysql_fetch_array($resultallSER);
					 $indexNo=$rowSER['indexNo'];
					  $j++;
				//  print $indexNo;
					// $queryallSERM = "Select e.mark1,e.mark2,e.marks,e.grade,e.gradePoint,e.subjectID from exameffort e,subject s  where  e.acYear='$acyear' and e.indexNo='$indexNo' and s.subjectID=e.subjectID ORDER BY s.suborder";
					 $resultallSERM = executeQuery($queryallSERM);
					// $rowSERM=mysql_fetch_array($resultallSERM);
					// print $queryallSERM;
					// print $rowSERM[0];print 'll'; print $rowSERM[1];
					// print 'll';
					 // $queryallcom = "Select status from final_result r,crs_enroll c  where  c.yearEntry='$acyear' and c.indexNo='$indexNo' and r.enroll_id=c.Enroll_id";
					 $resultallcom = executeQuery($queryallcom);
					 $rowcom=mysql_fetch_array($resultallcom);
					 $status1=$rowcom[status];
					 
				?>
                <!-- Serial Number -->
               <tr>
                <td>
                    <input type="text" value="<?php echo $j; ?>" size="4" />
                </td>
               
                <!-- Index Number -->
                <td>
                    <input type="text" value="<?php echo $indexNo; ?>" size="12" />
                </td>
                <!-- Withheld -->
                <td>
                    <input type="text" size="4" />
                </td>
                <?php
				//	 print 'ttt';
				//print $queryallSERM	;
					// print 'ttt';
                //print mysql_num_rows($resultallSERM);
					 //$m=0;
					
				 
					 //print 'inside';
					 
              //while ($rowSERM=mysql_fetch_array($resultallSERM))
			  
			  {
				  $rowSERM=mysql_fetch_array($resultallSERM);
				  //print 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
					//  print $marks2;
					// print 'll';
					 $marks2=0;$a=0;
				   for ($m=0;$m<$noofsubjects;$m++){
				  //print 'forr';
				 //print $m;
					   //print 'forr';
					   //print $rowSERM[$subjectID];print 'y';
					   //print $subjects[$m];
					   //print 'ndd';
					   
					 //  
					//  print $rowSERM['subjectID'];
					 //  print 'kk'; 
					  
				  if ($rowSERM['subjectID']==$subjects[$m]){
					   //if (true){
                    ?>
                    <!-- One Subject -->
                    <td>
                        <input type="text" value="<?php echo $rowSERM[0]; ?>" size="3" />
                    </td>
                    <td>
                        <input type="text" value="<?php echo $rowSERM[1]; ?>" size="3" />
                    </td>
                    <td>
                        <input type="text" value="<?php echo $rowSERM[2]; ?>" size="3" />
                    </td>
                    <td>
                        <input type="text" value="<?php echo $rowSERM[3]; ?>" size="3" />
                    </td>
                    <td>
                        <input type="text" value="<?php echo $rowSERM[4]; ?>"  size="3" />
                    </td>
                    <?php
					  $marks2=$marks2+$rowSERM[2];
					 $a=$a+1;
					//  print 'yyyyyyyyyyyyy';
					//  print $rowSERM[2];
					//  print 'yyyyyyyyyyyyy';
					  $rowSERM=mysql_fetch_array($resultallSERM);
				  }
					  else{?>
					<td>
                        <input type="text"  size="3" />
                    </td>
                    <td>
                        <input type="text"  size="3" />
                    </td>
                    <td>
                        <input type="text"  size="3" />
                    </td>
                    <td>
                        <input type="text"  size="3" />
                    </td>
                    <td>
                        <input type="text"  size="3" />
                    </td>  
					<?php 
						  }
						  
               // }
			  }
			  }
				 ?>
                <!-- Sub Total -->
                <td> 
                    <input type="text"  value="<?php echo $marks2; ?>" size="7" />
                </td>
                <!-- % -->
                <td>
                    <input type="text" value="<?php echo number_format(($marks2)/$a,2); ?>" size="6" />
                </td>
                <!-- Final Results -->
                <td>
                    <input type="text"  value="<?php echo $status1;?>" size="15" />
                </td>
                </tr>
                 <?php
					
                }
				
				 ?>
            
        </table>
		<div align="left" class="box-header with-border">
			<button type="submit" name="btn-save" class="btn btn-primary" id="btn-save" align="left">Print</button>
			</div>
    </form>
</div>