<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
<script language="javascript">
	function popUp(URL) {
		day = new Date();
		id = day.getTime();
		eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=600,height=400,left = 340,top = 312');");
	}
	
	function ChangeColor(tableRow, highLight)
    {
    	if (highLight)
		{
			tableRow.style.backgroundColor = 'rgb(240,240,240)';
			document.body.style.cursor = 'pointer';
		}
    	else
		{
			tableRow.style.backgroundColor = 'white';
			document.body.style.cursor = 'default';
		}
  	}

  	function DoNav(tableRow)
  	{
		var accNo = tableRow.id.toString();
  		document.location.href = 'itemDetails.php?accNo=' + accNo;
  	}
	
	function validateEmpty(fld)
	{
		var error = "";
	 
		if (fld.value.length == 0) {
			fld.style.background = '#FF9999'; 
			error = "The required field has not been filled in.\n"
		} else {
			fld.style.background = 'White';
		}
		return error;  
	}
	
	function validate_required(field)
	{
	with (field)
	  {
	  if (value==null||value=="")
		{
			//alert(alerttxt);
			field.style.background = '#FF9999'; 
			return false;
		}
	  else
		{
			field.style.background = 'White';
			return true;
		}
	  }
	}
</script>
<script language="javascript" src="lib/remlogin/remlogin.js"></script>
<title><?php echo $pagetitle; ?></title>
<meta name="description" content="The Buddhist & Paali University of Sri Lanka" />
<meta name="keywords" content="Buddhist, Paali, University, Sri lanka" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="screen,projection,print" href="css/layout_setup.css" />
<link rel="stylesheet" type="text/css" media="screen,projection,print" href="css/layout_text.css" />
</head>
<!-- Global IE fix to avoid layout crash when single word size wider than column width -->
<!--[if IE]><style type="text/css"> body {word-wrap: break-word;}</style><![endif]-->
<body>
<!-- Main Page Container -->
<div class="page-container">
  <!-- For alternative headers START PASTE here -->
  <!-- A. header--->
  <div class="header">
    <!-- A.1 header-TOP -->
    <div class="header-top">
      <!-- Navigation Level 1 -->
      <div class="nav1">
        <ul>
          <li><a href="">Home</a></li>
          <li><a href="">Sitemap</a></li>
        </ul>
      </div>
    </div>
    <!-- A.2 header-MIDDLE -->
    <div class="header-middle">
      <!-- Site message
      <div class="sitemessage">
        <h1>EASY &bull; FLEXIBLE &bull; ROBUST</h1>
        <h2>The third generation Multiflex is<br />
          here, now with cooler Design<br />
          features and easier code!</h2>
        <h3> <a href="http://www.free-css.com/">&rsaquo;&rsaquo;&nbsp;More details</a></h3>
      </div> -->
    </div>
    <!-- A.3 header-BOTTOM -->
    <div class="header-bottom">
      <!-- Navigation Level 2 (Drop-down menus) -->
      <div class="nav2">
        <!-- Navigation item -->
        <ul>
          <li><a href="home.php">Home</a></li>
        </ul>
        <!-- Navigation item -->
        <ul>
          <li><a>Selection Related 
            <!--[if IE 7]><!-->
            </a> 
            <!--<![endif]-->
            <!--[if lte IE 6]><table><tr><td><![endif]-->
            <ul>
              <li><a href="applicant.php">Applicant</a></li>
              <li><a href="alSub.php">A/L Subject</a></li>
              <li><a href="alSub.php">Grade Points</a></li>
              <li><a href="reportSelectRelated.php">Reports</a></li>
			  <li><a href="semesterRelated.php">Semester</a></li>
            </ul>
            <!--[if lte IE 6]></td></tr></table></a><![endif]-->
          </li>
        </ul>
        <!-- Navigation item -->
        <ul>
          <li><a>Enrollment Related 
            <!--[if IE 7]><!-->
            </a> 
            <!--<![endif]-->
            <!--[if lte IE 6]><table><tr><td><![endif]-->
            <ul>
              <!-- <li><a href="studentAdmin.php">Student</a></li> -->
              <li><a href="studentNew.php">Student</a></li>
              <li><a href="studentAttendence.php">Student Attendence</a></li>
              <li><a href="studentServices.php">Student Services</a></li>
              <li><a href="specialDegreeAdmin.php">Special Degress</a></li>
              <li><a href="subjectRelated.php">Subject</a></li>
              <li><a href="reportEnrollRelated.php">Reports</a></li>
            </ul>
            <!--[if lte IE 6]></td></tr></table></a><![endif]-->
          </li>
        </ul>
        <!-- Navigation item -->
        <ul>
          <li><a>Lecture Related 
            <!--[if IE 7]><!-->
            </a> 
            <!--<![endif]-->
            <!--[if lte IE 6]><table><tr><td><![endif]-->
            <ul>
              <li><a href="lectureSchedule.php">Lecture Schedule</a></li>
              <li><a href="venue.php">Venue</a></li>
              <li><a href="lecturer.php">Lecturer</a></li>
              <li><a href="timeSlot.php">Timeslot</a></li>
              <li><a href="reportTimeTable.php">Reports</a></li>
            </ul>
            <!--[if lte IE 6]></td></tr></table></a><![endif]-->
          </li>
        </ul>
        <!-- Navigation item -->
        <ul>
          <li><a>Exam Related 
            <!--[if IE 7]><!-->
            </a> 
            <!--<![endif]-->
            <!--[if lte IE 6]><table><tr><td><![endif]-->
            <ul>
              <li><a href="examAdmin.php">Exam Results</a></li>
              <li><a href="repeatexam.php">Exam Results-Repeat</a></li>
              <li><a href="SpecialDegreeRelated.php">Special Degree</a></li>
              <li><a href="examSchedule.php">Exam Schedule</a></li>
              <li><a href="examAdmission">Admission Card</a></li>
              <li><a href="examAttendance.php">Attendance</a></li>
              <li><a href="examTranscript.php">Transcript</a></li>
            </ul>
            <!--[if lte IE 6]></td></tr></table></a><![endif]-->
          </li>
        </ul>
      </div>
    </div>
    <!-- A.4 header-BREADCRUMBS -->
    <!-- Breadcrumbs -->
    <div class="header-breadcrumbs">
     <?php echo $navpath; ?>
    </div>
  </div>
  <!-- For alternative headers END PASTE here -->
  <!-- B. MAIN -->
  <div class="main">
    <!-- B.1 MAIN NAVIGATION -->
    <div class="main-navigation">
      <!-- Navigation Level 3 -->
      <div class="round-border-topright"></div>
      <h1 class="first">Quick Links</h1>
      <!-- Navigation with grid style -->
      <dl class="nav3-grid">
        <dt> <a href="home.php">Home</a></dt>
        <dt> <a>Selection Related</a></dt>
        	 <dd> <a href="applicant.php">Applicant</a></dd>
             <dd> <a href="alSub.php">A/L Subject</a></dd>
			 <dd> <a href="Gradepoints.php">Grade Points</a></dd>
             <dd> <a href="reportSelectRelated.php">Reports</a></dd>
             <dd><a href="semesterRelated.php">Semester</a></dd>
             <dd> <a href="test.php">test</a></dd>
        <dt> <a>Enrollment Related</a></dt>
            <dd> <a href="studentAdmin.php">Student</a></dd>
            <dd><a href="studentAttendence.php">Student Attendence</a></dd>
            <dd><a href="studentServices.php">Student Services</a></dd>
            <dd> <a href="subjectRelated.php">Subject</a></dd>
            <dd> <a href="reportEnrollRelated.php">Reports</a></dd>
        <dt> <a>Lecture Related</a></dt>
        	<dd> <a href="lectureSchedule.php">Lecture Schedule</a></dd>
            <dd> <a href="venue.php">Venue</a></dd>
            <dd> <a href="lecturer.php">Lecturer</a></dd>
            <dd> <a href="timeSlot.php">Time Slot</a></dd>
            <dd> <a href="reportTimeTable.php">Reports</a></dd>
        <dt> <a>Exam Related</a></dt>
            <dd> <a href="examAdmin.php">Exam Results</a></dd>
			<dd><a href="repeatexam.php">Exam Results-Repeat</a></dd>
      <dd><a href="SpecialDegreeRelated.php">Special Degree </a></dd>
            <dd> <a href="examSchedule.php">Exam Schedule</a></dd>
            <dd> <a href="examAdmission.php">Admission Card</a></dd>
            <dd> <a href="examAttendance.php">Attendance</a></dd>
			<dd><a href="calculateGPA.php">Calculate GPA </a></dd>
            <dd> <a href="examTranscript.php">Academic Transcript</a></dd>
      </dl>
      <?php if (!isset($_SESSION['authenticatedUser'])) { ?>
      <h1>Login</h1>
      <div class="loginform">
        <form name="login" method="post" action="authentication.php" onsubmit="if (this.chkRememberMe.checked) toMem(this);">
          <p>
            <input type="hidden" name="rememberme" value="0" />
          </p>
          <fieldset>
          <p>
            <label for="txtUserName" class="top">User:</label>
            <br />
            <input type="text" name="txtUserName" id="txtUserName" tabindex="1" class="field" value="" />
          </p>
          <p>
            <label for="txtPassword" class="top">Password:</label>
            <br />
            <input type="password" name="txtPassword" id="txtPassword" tabindex="2" class="field" value="" />
          </p>
          <p>
            <input type="checkbox" name="chkRememberMe" id="chkRememberMe" class="checkbox" tabindex="3" size="1" value="" />
            <label for="chkRememberMe" class="right">Remember me</label>
          </p>
          <p>
            <input type="submit" name="cmdweblogin" class="button" value="LOGIN"  />
          </p>
          <br/>
          <p><a href="" onclick="delMem();">Clear Login</a></p>
          </fieldset>
        </form>
        <script language="javascript">
			document.login.txtUserName.value = readCookie("theName");
			document.login.txtPassword.value = readCookie("thePassword");
		</script>
      </div>
      <?php } else echo "<p><a href='logout.php'>Logout</a></p>" ?>
    </div>
    <!-- B.1 MAIN CONTENT -->
    <div class="main-content">
     <?php echo $pagemaincontent; ?>
    </div>
  </div>
  <!-- C. FOOTER AREA -->
  <div class="footer">
    <p>Copyright &copy; 2010 Buddhist & Pali University of Sri Lanka | All Rights Reserved</p>
    <p class="credits">Powered by <a href="http://www.accimt.ac.lk">Arthur C. Clarke Institute for Modern Technologies</a></p>
  </div>
</div>
</body>
</html>

