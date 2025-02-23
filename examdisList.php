<?php
  //Buffer larger content areas like the main page content
  ob_start();
?>




<h1>Exam Disqulaifications</h1>

<?php
	//2021-03-25 start  include('dbAccess.php');
	require_once("dbAccess.php");
	$db = new DBOperations();
    //2021-03-25 end
  //	include('authcheck.inc.php');
	
	//====================================
	if (isset($_POST['lstFaculty']))
	{
		//$faculty=$_POST['lstFaculty'];
		$faculty = $db->cleanInput($_POST['lstFaculty']);
	}
	
	if (isset($_POST['subSemester']))
	{
	$semester= $db->cleanInput($_POST['subSemester']);
		//$semester=$_POST['subSemester'];
	}
	if (isset($_POST['level']))
	{
	$level = $db->cleanInput($_POST['level']);
		//$level=$_POST['level'];
	}

    if (isset($_POST['disval']))
	{
	$disval = $db->cleanInput($_POST['disval']);
		//$level=$_POST['level'];
	}
    
	if (isset($_POST['lstSubject']))
	
	{
	$SubjectID = $db->cleanInput($_POST['lstSubject']);
		//$SubjectID=$_POST['lstSubject'];
	}
	if (isset($_POST['acyear']))
	{
	$acyear = $db->cleanInput($_POST['acyear']);
		//$acyear=$_POST['acyear'];
	}
	if (isset($_POST['lstMedium']))
	{
	$medium = $db->cleanInput($_POST['lstMedium']);
		//$medium=$_POST['lstMedium'];
	}
	if (isset($_POST['lstEffort']))
	{
	$effort = $db->cleanInput($_POST['lstEffort']);
		//$effort=$_POST['lstEffort'];
	}
	//====================================
	
	if (isset($_POST['btnSubmit']))
	{
		 $queryall = "Select * from studentenrolment e, student s where e.subjectID='$SubjectID' and e.acYear='$acyear'and s.regNo=e.regNo order by e.indexNo";
  //print  $queryall;
  //2021.03.25 start  $resultall = executeQuery($queryall);
  $resultall = $db->executeQuery($queryall);
  //2021.03.25 end
  //2021.03.25 start  while ($row= mysql_fetch_array($resultall))
  while ($row= $db->Next_Record($resultall))
  //2021.03.25 end
  {
		//$indexNovalue = mysql_result($resultall,$i,'$indexNo');
		//$indexNovalue = $resultall['$indexNo'];
		$indexNovalue=$row['indexNo'] ;
			//$indexNovalue = '20133000';
	//print $indexNovalue;
	  $a=substr($indexNovalue,0,2);
		  $b=substr($indexNovalue,3,4);
		  $c=substr($indexNovalue,8,10);
		  $d=$b.$c;
		  
		  if($a=='BS')
		  $effortid='6683'.$d;
		  if($a=='LS')
		  $effortid='7683'.$d;
          $attendance='n';
			//2021-03-25 start  $mark1 = cleanInput($_POST['txtMarks1'.$effortid]);
            if ( isset( $_POST[ 'chk' . $effortid] ) ){
                $attendance='y';
            }
			$offend = $db->cleanInput($_POST['txtMarks1'.$effortid]);

          
            if($attendance=='n' && $offend=='' ){

            }
            else {
            $querymark1 = "Select * from examEligibilty where subjectID='$SubjectID' and indexNo='$indexNovalue' and acYear='$acyear'";
		 //2021.03.25 start  $resultmark = executeQuery($querymark1);
            $resultquerymark1 = $db->executeQuery($querymark1);
         //2021.03.24 end
         //2021.03.24 start  if (mysql_num_rows($result)>0)
         if ($db->Row_Count($resultquerymark1)>0){

         $resultfinal = $db->executeQuery("Update examEligibilty set disquliAtend='$attendance',offend='$offend'where indexNo=''$indexNovalue' and subjectID='' and acYear='')");

                 }        else{}
 $resultfinal = $db->executeQuery("Insert into examEligibilty (indexNo,disquliAtend,offend,subjectID,acYear)VALUES ('$indexNovalue','$attendance','$offend','$SubjectID','$acyear')");
           
            }}
			
            
            
            //2021-03-25 end
			//2021-03-25 start  $mark2 = cleanInput($_POST['txtMarks2'.$effortid]);
			//$mark2 = $db->cleanInput($_POST['txtMarks2'.$effortid]);
			//2021-03-25 end
			//2021-03-25 start  $marks = cleanInput($_POST['txtMarks'.$effortid]);
			//$marks = $db->cleanInput($_POST['txtMarks'.$effortid]);
			//2021-03-25 end
			//2021-03-25 start  $grade = cleanInput($_POST['txtGrade'.$effortid]);
			//$grade = $db->cleanInput($_POST['txtGrade'.$effortid]);
			//2021-03-25 end
			//2021-03-25 start  $gradepoint = cleanInput($_POST['txtGradePoint'.$effortid]);
			//$gradepoint = $db->cleanInput($_POST['txtGradePoint'.$effortid]);
			//2021-03-25 end

		//print "Insert into exameffort (indexNo,subjectID,mark1,mark2,marks,grade,gradePoint,acYear,effort,medium) VALUES ('$indexNovalue','$SubjectID','$mark1','$mark2','$marks','$grade','$gradepoint','$acyear','$effort','$medium')";
			//$grade = cleanInput($_POST['txtGrade'.$effortID]);

			//2021-03-25 start  $result = executeQuery("Insert into exameffort (indexNo,subjectID,mark1,mark2,marks,grade,gradePoint,acYear,effort,medium)VALUES ('$indexNovalue','$SubjectID','$mark1','$mark2','$marks','$grade','$gradepoint','$acyear','$effort','$medium')");
			//$result = $db->executeQuery("Insert into exameffort (indexNo,subjectID,mark1,mark2,marks,grade,gradePoint,acYear,effort)VALUES ('$indexNovalue','$SubjectID','$mark1','$mark2','$marks','$grade','$gradepoint','$acyear','$effort')");
			//2021-03-25 end
            
			//print "Insert into exameffort (indexNo,subjectID,mark1,mark2,marks,grade,gradePoint,acYear,effort)VALUES ($indexNovalue,$SubjectID,'$mark1','$mark2','$marks',$grade,$gradepoint,$acyear,$effort)";
		
		header("location:examEligibility.php");
	}
?>
<form method="post" name="form1" id="form1" action="" onsubmit="return validate_form(this);" class="plain">
<table class="searchResults">
   <tr>
    	
      <td height="28">Faculty : </td>
      <!-- <td><select name="lstFaculty" id="lstFaculty" onchange="document.form1.submit()"> -->
	  <td><select name="lstFaculty" id="lstFaculty" onchange="form1.submit()">

        	<option value="Buddhist">Buddhist Studies</option>
        	<option value="Language">Language Studies</option>
        </select>
		<script>
								document.getElementById('lstFaculty').value = "<?php echo $faculty;?>";
							</script>
		
		</td>
    </tr>
    <tr>
    	<td>Level : </td>
		<!-- <td><select name="level" id="level" onchange="document.form1.submit()">  -->
		 <td><select name="level" id="level" onchange="form1.submit()"> 

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
      <!-- <td><select name="subSemester" id="subSemester" onchange="document.form1.submit()"> -->
	  <td><select name="subSemester" id="subSemester" onchange="form1.submit()">

        	<option value="First Semester">First Semester</option>
        	<option value="Second Semester">Second Semester</option>
        </select>
			<script>
		
								document.getElementById('subSemester').value = "<?php echo $semester;?>";
							</script> 
		</td>
    </tr>
	<tr>
    <tr>
    	<td>Subject : </td>
        <!-- <td><select name="lstSubject" id="lstSubject" style="width:auto" onchange="document.form1.submit()"> -->
		<td><select name="lstSubject" id="lstSubject" style="width:auto" onchange="form1.submit()">>

        	<?php
			
			$query = "SELECT * FROM subject WHERE faculty='$faculty' and level='$level' and semester='$semester'";
			// print $query;
			//2021-03-25 start  $result = executeQuery($query);
			$result = $db->executeQuery($query);
			//2021.03.25 end
			//2021-03-25 start  for ($i=0;$i<mysql_num_rows($result);$i++)
			
			// for ($i=0;$i<$db->Row_Count($result);$i++)
			while($data=$db->Next_Record($result))
				
			//2021.03.25 end
			{
				$rID = $data["subjectID"];
				$rCode = $data["codeEnglish"];
				$rSubject =$data["nameEnglish"];
              	echo "<option value=\"".$rID."\">".$rCode." - ".$rSubject."</option>";
        	} 
			?>
        	</select>
			<script>
								document.getElementById('lstSubject').value = '<?php echo $SubjectID;?>';
							</script> 
        </td>
    </tr>
   <tr>
      <td>Academic Year:</td>
      <td><label>
     	  <?php
	 							// echo '<select name="acyear" id="acyear"  onChange="document.form1.submit()" class="form-control">'; // Open your drop down box
								echo '<select name="acyear" id="acyear" onChange="form1.submit()"  class="form-control">'; // Open your drop down box
								$sql="SELECT distinct acYear FROM studentenrolment";
								//2021-03-25 start  $result = executeQuery($sql);
								//echo '<option value="all">Select All</option>';
								$result = $db->executeQuery($sql);
								//echo '<option value="all">Select All</option>';
								while ($row=$db->Next_Record($result))
								{
								//2021-03-25 start  while ($row = mysql_fetch_array($result)){
									echo '<option value="'.$row['acYear'].'">'.$row['acYear'].'</option>';
								}
								echo '</select>';// Close drop down box
							?>
							
							  <script>
								document.getElementById('acyear').value = "<?php echo $acyear;?>";
							</script> 
 </label>
		</td>
        
    </tr>
    
    
</table>
 <table class="searchResults">
	<tr>
    	<th>Index No.</th><th>Attendance Disqaulify</th><th>Exam Offend</th>
    </tr>
    
<?php
 //$queryall = "Select * from subject_enroll as s, crs_enroll as c where s.subjectID='$SubjectID' and s.Enroll_id=c.Enroll_id and yearEntry='$acyear' order by c.indexNo";
//print $queryall;
  $queryall = "Select * from examEligibilty where subjectID='$SubjectID' and  acYear='$acyear' order by indexNo";
  //print  $queryall;
  //2021.03.25 start  $resultall = executeQuery($queryall);
  $resultall = $db->executeQuery($queryall);
  //2021.03.25 end
  //2021.03.25 start  while ($row= mysql_fetch_array($resultall))
  while ($row= $db->Next_Record($resultall))
  //2021.03.25 end
  {
?>
	<tr>
        
		<?php
		
		
		
	
		 ?>
		 <td><?php echo $row['indexNo'] ?></td>
         <td><?php if ($row['disquliAtend']=='y') {echo  ('Yes');} else {echo  ('No');}  ?></td>
         <td><?php echo $row['offend'] ?></td>
        
      
        
  			
        
        
	</tr>
<?php

  }
?>
  </table>
<br/><br/>
<p><input name="btnCancel" type="button" value="Cancel" onclick="document.location.href = 'examAdmin.php';"  class="button"/>&nbsp;&nbsp;&nbsp;<input name="btnSubmit" type="submit" value="Submit" class="button" /></p>
</form>

<?php
  //Assign all Page Specific variables
  $pagemaincontent = ob_get_contents();
  ob_end_clean();
  $pagetitle = "New Effort - Exam Efforts - Student Management System - Buddhist & Pali University of Sri Lanka";
  $navpath = "<ul><li><a href='home.php'>Home </a></li><li><a href='examAdmin.php'>Exam Efforts </a></li><li>New Effort</li></ul>";
  //Apply the template
  include("master_registration.php");
?>