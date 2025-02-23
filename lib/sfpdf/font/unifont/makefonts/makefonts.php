<?php
############################
set_time_limit(1200);
ini_set("memory_limit","128M");
error_reporting(E_ALL & ~E_NOTICE);
############################


$step = $_REQUEST['step'];
echo '<html><body>';
if ($_REQUEST['moveunifonts']==1) { moveunifonts(); }


// INITIAL INSTRUCTIONS
if (!$step) {
	echo '<h2>sFPDF utility to generate Unicode font files</h2>';
	echo '<h3>Prepare the source files</h3>';
	echo '<p>Copy the [fontname].ttf files to this current directory</p>';
	echo '<p>Rename the .ttf files if necessary, so they only contain: ';
	echo 'characters a-z (lowercase only), 0-9 and _ (underscore)</p>';
	echo '<p>Style variants should be fontname.ttf &nbsp; fontname<b>b</b>.ttf &nbsp; fontname<b>i</b>.ttf &nbsp; fontname<b>bi</b>.ttf</p>';
	echo '<p>Execute <a href="makefonts.php?step=1">Step 1</a></p>';

}


// STEP 1 - 
else if ($step==1) {

	makebatlist('U');
	exec('makefonts.bat');
	echo '<h3>Step 1 - Unicode TrueType font files - A</h3>';
	echo '<p>Check that the following files have been created in the current directory (for each of your original .ttf files):</p>';
	echo '<ul><li>fontname.t1a</li>';
	echo '<li>fontname.ufm</li>';
	echo '<li>fontname.afm</li></ul>';

	echo '<hr />';
	echo '<p>If these files are not present:</p>';
	echo '<p>Ensure that the file "ttf2ufm.exe" is in the current directory</p>';
	echo '<p>Execute/Run the batch file "makefonts.bat" - (double click on the file in Windows)</p>';

	echo '<p>When the files are there, go on to step 2.</p>';
	echo '<p>The next step will generate the core files in the current directory</p>';
	echo '<p>Execute <a href="makefonts.php?step=2">Step 2</a></p>';

}







// STEP 2 - 
else if ($step==2) {
	$ff = scandir('./');
	foreach($ff AS $f) {
	   if (substr($f,-4,4)=='.ttf') {
		$file = substr($f,0,(strlen($f)-4));
		MakeFontTTF($file .'.ttf', $file.'.ufm');
		@unlink($file .'.afm');
		@unlink($file .'.z');
		@unlink($file .'.ctg.z');
	   }
	}

	echo '<h3>Step 2 - Unicode TrueType font files - B</h3>';
	echo '<p>Now check you have the following files (for each of your original .ttf files):</p>';
	echo '<ul><li>fontname.php</li></ul>';
	echo '<p>NB The .afm files have been deleted (but .t1a and .ufm should remain).</p>';

	echo '<p>The next step will generate the additional files for embedded subsets</p>';
	echo '<p>Execute <a href="makefonts.php?step=3">Step 3</a> (NB This may take several minutes for large font files; you may need to increase the time-limit or memory-limits - see the top of the makefonts.php file)</p>';

}



// STEP 3 - Create .uni2gn.php files, and .dat / .dat.php
else if ($step==3) {
	$cs_commands = array(
  'abs' => array(12, 9 ),
  'add' => array(12, 10 ),
  'and' => array(12, 3 ),
  'blend' => array(16, -1 ),
  'callgsubr' => array(29, -1 ),
  'callothersubr' => array(12, 16 ),
  'callsubr' => array(10, -1 ),
  'closepath' => array(9, -1 ),
  'cntrmask' => array(20, -1 ),
  'div' => array(12, 12 ),
  'dotsection' => array(12, 0 ),
  'drop' => array(12, 18 ),
  'dup' => array(12, 27 ),
  'endchar' => array(14, -1 ),
  'eq' => array(12, 15 ),
  'error' => array(0, -1 ),
  'escape' => array(12, -1 ),
  'exch' => array(12, 28 ),
  'flex' => array(12, 35 ),
  'flex1' => array(12, 37 ),
  'get' => array(12, 21 ),
  'hflex' => array(12, 34 ),
  'hflex1' => array(12, 36 ),
  'hhcurveto' => array(27, -1 ),
  'hintmask' => array(19, -1 ),
  'hlineto' => array(6, -1 ),
  'hmoveto' => array(22, -1 ),
  'hsbw' => array(13, -1 ),
  'hstem' => array(1, -1 ),
  'hstem3' => array(12, 2 ),
  'hstemhm' => array(18, -1 ),
  'hvcurveto' => array(31, -1 ),
  'ifelse' => array(12, 22 ),
  'index' => array(12, 29 ),
  'load' => array(12, 13 ),
  'mul' => array(12, 24 ),
  'neg' => array(12, 14 ),
  'not' => array(12, 5 ),
  'or' => array(12, 4 ),
  'pop' => array(12, 17 ),
  'put' => array(12, 20 ),
  'random' => array(12, 23 ),
  'rcurveline' => array(24, -1 ),
  'return' => array(11, -1 ),
  'rlinecurve' => array(25, -1 ),
  'rlineto' => array(5, -1 ),
  'rmoveto' => array(21, -1 ),
  'roll' => array(12, 30 ),
  'rrcurveto' => array(8, -1 ),
  'sbw' => array(12, 7 ),
  'seac' => array(12, 6 ),
  'setcurrentpoint' => array(12, 33 ),
  'sqrt' => array(12, 26 ),
  'store' => array(12, 8 ),
  'sub' => array(12, 11 ),
  'vhcurveto' => array(30, -1 ),
  'vlineto' => array(7, -1 ),
  'vmoveto' => array(4, -1 ),
  'vstem' => array(3, -1 ),
  'vstem3' => array(12, 1 ),
  'vstemhm' => array(23, -1 ),
  'vvcurveto' => array(26, -1 )
	);



	$lenIV = 4;
	$cs_start = 'RD';
	// Read uni2gn [code-point to glyph-name] from .ufm file if exists
	$ff = scandir('./');
	foreach($ff AS $f) {
	   if (substr($f,-4,4)=='.ufm') {
		$file = substr($f,0,(strpos($f,'.')));
		if (!file_exists($file.'.t1a')) { die("You must have both .ufm and .t1a files in the current directory ('.$f.')"); }
		$uni2gn = array();
		$a=file($file.'.ufm');
		if(empty($a)) { die('ufm file found but with error'); }
		foreach($a as $l) {
			$e=explode(' ',chop($l));
			if(count($e)<2) { continue; }
			if($e[0]=='U') {
	      		$cc=(int)$e[1];
	      		if ($cc != -1) { $uni2gn[$cc] = $e[7]; }
			}
		}
		$s = '<?php
		$this->uni2gn = '.var_export($uni2gn, true).';
?>';
		file_put_contents($file.'.uni2gn.php', $s);
		// echo "File created: ".$file.'.uni2gn.php'."<br />\n";
		// **************** DAT

		$file_ip = '';
		$file_op = '';
		$op_buffer = '';
		$if_header = '';
		$if_FullName = '';
		$if_FontName = '';
		$if_FamilyName = '';
		$if_encs = array();
		$if_eexec_start = '';
		$if_Subrs = array();
		$if_CharStrings = array();
		$pdf_diffstr = '';	// String of /Diffs for PDF file
		$of_encodingstr = '';
		$useChars = array();
	
		//echo "Processing font: ".$file."... <br />\n";

		$subrs='';
		$CharStrings='';
		$Encoding='';

		$file_ip = $file.'.t1a';

		$ifh = fopen($file_ip, "rb");
		$target = false;
		$rem = '';
		// Header
		$if_header = '';
		while(!$target && !feof($ifh)) {
			$x = fread($ifh, 2048);
			$x = preg_replace("/\r/","",$x);
			$if_header .= $x;
			if (preg_match('/(.*?)\/Encoding (.*)/s', $if_header , $m)) {
				$if_header = $m[1];
				$rem = '/Encoding '.$m[2];
				$target = true;
			}
		}
		if (feof($ifh)) { die("Error parsing ".$file_ip ); }

		// Discard
		$target = false;
		if (preg_match('/(.*?)currentfile eexec(.*)/s', $rem, $m)) {
			$rem = $m[2];
			$target = true;
		}

		$discard = '';
		while(!$target && !feof($ifh)) {
			$x = fread($ifh, 2048);
			$x = preg_replace("/\r/","",$x);
			$discard .= $x;
			if (preg_match('/(.*?)currentfile eexec(.*)/s', $discard , $m)) {
				//$discard = $m[1];
				$rem = $m[2];
				$target = true;
			}
		}
		if (feof($ifh)) { die("Error parsing ".$file_ip ); }


		// eexec_start
		$target = false;
		if (preg_match('/(.*?)\/Subrs (.*)/s', $rem, $m)) {
			$if_eexec_start = $m[1];
			$rem = $m[2];
			$target = true;
		}
		else { $if_eexec_start = $rem; }

		while(!$target && !feof($ifh)) {
			$x = fread($ifh, 2048);
			$x = preg_replace("/\r/","",$x);
			$if_eexec_start .= $x;
			if (preg_match('/(.*?)\/Subrs (.*)/s', $if_eexec_start , $m)) {
				$if_eexec_start = $m[1];
				$rem = $m[2];
				$target = true;
			}
		}
		if (feof($ifh)) { die("Error parsing ".$file_ip ); }


		// WRITE if_header to .dat
		$offset = 0;
		$fh = fopen($file.'.dat', "wb");

		_fwriteint($fh, strlen($if_header));
		fwrite($fh, $if_header);
		$offset += strlen($if_header) + 4;

		// WRITE if_eexec_start to .dat
		_fwriteint($fh, strlen($if_eexec_start));
		fwrite($fh, $if_eexec_start);
		$offset += strlen($if_eexec_start) + 4;

		unset($if_header );
		unset($if_eexec_start );


		// SUBROUTINES
		$if_Subrs = array();
		$target = false;
		if (preg_match('/(.*?)\/CharStrings (.*)/s', $rem, $m)) {
			$subrs = $m[1];
			$rem = $m[2];
			$target = true;
		}
		else { $subrs = $rem; }

		preg_match_all('/dup\s+(\d+)\s+\{(.*?)\}\s+NP/s',$subrs, $mm);
		for($i=0;$i<count($mm[0]);$i++) {
			if ($i > 4) { $if_Subrs[$mm[1][$i]] = preg_replace('/\s+return/', '', $mm[2][$i]); }
		}
		preg_match('/(.*}\s+NP)(.*)/s', $subrs, $mm);
		$subrs = $mm[2];

		while(!$target && !feof($ifh)) {
			$x = fread($ifh, 2048);
			$x = preg_replace("/\r/","",$x);
			$subrs .= $x;
			if (preg_match('/(.*?)\/CharStrings (.*)/s', $subrs , $m)) {
				$subrs = $m[1];
				$rem = $m[2];
				$target = true;
			}
			$subrs = preg_replace("/\r\n/","\n",$subrs);
			preg_match_all('/dup\s+(\d+)\s+\{(.*?)\}\s+NP/s',$subrs, $mm);
			for($i=0;$i<count($mm[0]);$i++) {
				if ($i > 4) { $if_Subrs[$mm[1][$i]] = preg_replace('/\s+return/', '', $mm[2][$i]); }
			}
			preg_match('/(.*}\s+NP)(.*)/s', $subrs, $mm);
			$subrs = $mm[2];
		}
		if (feof($ifh)) { die("Error parsing ".$file_ip ); }

		// CHARSTRINGS
		$offs = array();
		$target = false;
		if (preg_match('/(.*?)mark currentfile closefile/s', $rem, $m)) {
			$CharStrings = $m[1];
			$target = true;
		}
		else { $CharStrings = $rem; }

		preg_match_all('/\/([a-zA-Z0-9._]+)\s+\{(.*?endchar\s+)\}\s+ND/s',$CharStrings, $m);
		for($i=0;$i<count($m[0]);$i++) {
			$cp = $m[1][$i];
			$cs = $m[2][$i];
			$cs = preg_replace('/(\d+) 4 (callgsubr|callothersubr|callsubr)/e', '" ".$if_Subrs[\\1]." "', $cs);
			$cs = preg_replace('/\s+/',' ',$cs);
			$cb = parse_charstring($cs);
			$offs[$cp] = $offset;
			// WRITE $cb to .dat AND save position in file
			_fwriteint($fh, strlen($cb));
			fwrite($fh, $cb);
			$offset += strlen($cb) + 4;
		}
		preg_match('/(.*}\s+ND)(.*)/s', $CharStrings, $mm);
		$CharStrings = $mm[2];

		while(!$target && !feof($ifh)) {
			$x = fread($ifh, 8192);
			$x = preg_replace("/\r/","",$x);
			$CharStrings .= $x;
			if (preg_match('/(.*?)mark currentfile closefile(.*)/s', $CharStrings , $m)) {
				$CharStrings = $m[1];
				$target = true;
			}
			preg_match_all('/\/([a-zA-Z0-9._]+)\s+\{(.*?endchar\s+)\}\s+ND/s',$CharStrings, $m);
			for($i=0;$i<count($m[0]);$i++) {
				$cp = $m[1][$i];
				$cs = $m[2][$i];
				$cs = preg_replace('/(\d+) 4 (callgsubr|callothersubr|callsubr)/e', '" ".$if_Subrs[\\1]." "', $cs);
				$cs = preg_replace('/\s+/',' ',$cs);
				$cb = parse_charstring($cs);
				$offs[$cp] = $offset;
				// WRITE $cb to .dat AND save position in file
				_fwriteint($fh, strlen($cb));
				fwrite($fh, $cb);
				$offset += strlen($cb) + 4;
			}
			preg_match('/(.*}\s+ND)(.*)/s', $CharStrings, $mm);
			$CharStrings = $mm[2];
		}

		fclose($ifh);
		fclose($fh);
		unset($if_Subrs);
		unset($CharStrings);
		unset($fi);
		// WRITE offsets to .dat.php
		$fh = fopen($file.'.dat.php', "w");
		$s = '<?php $offs = '.var_export($offs, true).'; ?>';
		fwrite($fh, $s);
		fclose($fh);
		// echo "Files created: ".$file." [.dat|.dat.php]<br />\n";
		// **************** DAT
	   }
	}




	echo '<h3>Step 3 - Unicode TrueType font files - C</h3>';
	echo '<p>Now check you have the following files (for each of your original .ttf files):</p>';
	echo '<ul><li>fontname.uni2gn.php</li>';
	echo '<li>fontname.dat</li>';
	echo '<li>fontname.dat.php</li></ul>';

	echo '<p>Go to <a href="makefonts.php?step=4">Step 4</a></p>';

}



// STEP 4 - 
else if ($step==4) {
	if ($_REQUEST['moveunifonts']==1) { 
		echo '<p>Files transferred!</p>';
	}
	else {
		echo '<p>Copy all of the following files to the folder [path to sFPDF]/font/unifont/</p>';
		echo '<p>(4 for each font/style)</p>';
	}

	echo '<ul>';
	echo '<li>fontname.php</li>';
	echo '<li>fontname.dat</li>';
	echo '<li>fontname.dat.php</li>';
	echo '<li>fontname.uni2gn.php</li></ul>';

	echo '<p>(This <a href="makefonts.php?step=4&moveunifonts=1">link</a> should do the job for you)</p>';
	echo '<p>When you have done that, you\'re all done!</p>';
	echo '<p>Optionally you can <a href="makefonts.php?step=5">tidy up</a> which will delete all the font files except your .ttf files from the current directory.</p>';

}


// STEP 5 - 
else if ($step==5) {
	$ff = scandir('./');
	foreach($ff AS $f) {
	   if (substr($f,-4,4)=='.ttf') {
		$file = substr($f,0,(strlen($f)-4));
		@unlink($file .'.afm');
		@unlink($file .'.ufm');
		@unlink($file .'.t1a');
		@unlink($file .'.php');
		@unlink($file .'.z');
		@unlink($file .'.ctg.z');
		@unlink($file .'.dat');
		@unlink($file .'.dat.php');
		@unlink($file .'.uni2gn.php');
		@unlink('makefonts.bat');
	   }
	}

	echo '<p>All done!</p>';
	echo '<p><a href="makefonts.php">Start again</a></p>';

}







echo '</body></html>';
exit;
/*******************************************************************************
*  Functions to generate Unicode font .dat files                               *
*******************************************************************************/
function _fwriteint($fh, $i)
{
	//Write a 4-byte integer to file
	$s=chr(($i>>24) % 256);
	$s.=chr(($i>>16) % 256);
	$s.=chr(($i>>8) % 256);
	$s.=chr($i % 256);
	fwrite($fh, $s);
}


/* This function parses an entire charstring into integers and commands,
   outputting bytes through the charstring buffer. */
function parse_charstring($cs) {
	global $lenIV, $cs_start, $cs_commands, $cipher_cr ;
	/* initializes charstring encryption. */
	$buffer = '';
	$cipher_cr = 4330;
	for ($i = 0; $i < $lenIV; $i++) {
		$buffer .= charstring_byte(chr(0));
	}
	$cc = preg_split('/\s+/',$cs,-1,PREG_SPLIT_NO_EMPTY);
	foreach($cc AS $c) {
		// Encode the integers according to charstring number encoding
		if (preg_match('/^[\-]{0,1}\d+$/',$c)) {
			$buffer .= charstring_int($c);
		}

		// Encode the commands according to charstring command encoding
		else if (isset($cs_commands[$c])) {
			$one = $cs_commands[$c][0];
			$two = $cs_commands[$c][1];
			if ($one < 0 || $one > 255)
				echo sprintf("bad charstring command number $d in %s in %s", $one, $c, $cs);
			else if ($two > 255)
				echo sprintf("bad charstring command number $d in %s in %s", $two, $c, $cs);
			else if ($two < 0) {
				$buffer .= charstring_byte($one);
			}
			else {
				$buffer .= charstring_byte($one);
				$buffer .= charstring_byte($two);
			}
		}
		else {
			echo sprintf("unknown charstring entry %s in %s", $c, $cs);
		}
	}
	$s = sprintf("%d ", strlen($buffer));
	$s .= sprintf("%s ", $cs_start);
	$s .= $buffer;
	$buffer = '';
	return $s;
}

/* This function encrypts and buffers a single byte of charstring data. */
function charstring_byte($v) {
	$b = ($v & 0xff);
	$c = cencrypt($b);
	return chr($c);
}

/* This function encodes an integer according to charstring number encoding. */
function charstring_int($num) {
  $c = '';
  if ($num >= -107 && $num <= 107) {
    $c .= charstring_byte($num + 139);
  } else if ($num >= 108 && $num <= 1131) {
    $x = $num - 108;
    $c .= charstring_byte($x / 256 + 247);
    $c .= charstring_byte($x % 256);
  } else if ($num >= -1131 && $num <= -108) {
    $x = abs($num) - 108;
    $c .= charstring_byte($x / 256 + 251);
    $c .= charstring_byte($x % 256);
  } else if ($num >= (-2147483647-1) && $num <= 2147483647) {
    $c .= charstring_byte(255);
    $c .= charstring_byte($num >> 24);
    $c .= charstring_byte($num >> 16);
    $c .= charstring_byte($num >> 8);
    $c .= charstring_byte($num);
  } else {
    echo sprintf("can't format huge number `%d'", $num);
    /* output 0 instead */
    $c .= charstring_byte(139);
  }
  return $c;
}

function cencrypt($plain) {
  global $lenIV, $cipher_cr;
  $c1 = 52845;
  $c2 = 22719;
  if ($lenIV < 0) return $plain;
  $cipher = ($plain ^ ($cipher_cr >> 8));
  $cipher_cr = (($cipher + $cipher_cr) * $c1 + $c2) & 0xffff;
  return $cipher;
}

/*******************************************************************************
* Other Functions to generate font definition files
*******************************************************************************/

function moveunifonts() {
	$ff = scandir('./');
	foreach($ff AS $f) {
	   if (substr($f,-4,4)=='.ttf') {
		$file = substr($f,0,(strlen($f)-4));
		@rename($file .'.dat', '../'.$file .'.dat');
		@rename($file .'.dat.php', '../'.$file .'.dat.php');
		@rename($file .'.php', '../'.$file .'.php');
		@rename($file .'.uni2gn.php', '../'.$file .'.uni2gn.php');
	   }
	}
}


function makebatlist($type='U') {
	$bat = '';
	$ff = scandir('./');
	foreach($ff AS $f) {
	   if (substr($f,-4,4)=='.ttf') {
		$file = substr($f,0,(strlen($f)-4));

		// FOR UNIFONTS
		if ($type=='U') {
			$bat .= 'ttf2ufm -a '.$f." ".$file."\r\n";
		}
	   }
	}
	file_put_contents('makefonts.bat', $bat);
}



/*******************************************************************************
* Common Functions to generate font definition files - Type 1 + Unicode        *
*******************************************************************************/


function SaveToFile($file,$s,$mode='t')
{
	$f=fopen($file,'w'.$mode);
	if(!$f)
		die('Can\'t write to file '.$file);
	fwrite($f,$s,strlen($s));
	fclose($f);
}

function ReadShort($f)
{
	$a=unpack('n1n',fread($f,2));
	return $a['n'];
}

function ReadLong($f)
{
	$a=unpack('N1N',fread($f,4));
	return $a['N'];
}

function CheckTTF($file)
{
	//Check if font license allows embedding
	$f=fopen($file,'rb');
	if(!$f)
		die('<B>Error:</B> Can\'t open '.$file);
	//Extract number of tables
	fseek($f,4,SEEK_CUR);
	$nb=ReadShort($f);
	fseek($f,6,SEEK_CUR);
	//Seek OS/2 table
	$found=false;
	for($i=0;$i<$nb;$i++)
	{
		if(fread($f,4)=='OS/2')
		{
			$found=true;
			break;
		}
		fseek($f,12,SEEK_CUR);
	}
	if(!$found)
	{
		fclose($f);
		return;
	}
	fseek($f,4,SEEK_CUR);
	$offset=ReadLong($f);
	fseek($f,$offset,SEEK_SET);
	//Extract fsType flags
	fseek($f,8,SEEK_CUR);
	$fsType=ReadShort($f);
	$rl=($fsType & 0x02)!=0;
	$pp=($fsType & 0x04)!=0;
	$e=($fsType & 0x08)!=0;
	fclose($f);
	if($rl and !$pp and !$e)
		echo '<B>Warning:</B> font license does not allow embedding';
}




/*******************************************************************************
* Functions to generate font definition files for Unicode Truetype fonts       *
*******************************************************************************/

function ReadUFM($file, &$cidtogidmap)
{
  //Prepare empty CIDToGIDMap
  $cidtogidmap = str_pad('', 256*256*2, "\x00");
  
  //Read a font metric file
  $a=file($file);
  if(empty($a))
    die('File not found (ReadUFM) - '.$file);
  $widths=array();
  $fm=array();
  foreach($a as $l)
  {
    $e=explode(' ',chop($l));
    if(count($e)<2)
      continue;
    $code=$e[0];
    $param=$e[1];
    if($code=='U')
    {
      // U 827 ; WX 0 ; N squaresubnosp ; G 675 ;
      //Character metrics
      $cc=(int)$e[1];
      if ($cc != -1) {
        $gn = $e[7];
        $w = $e[4];
        $glyph = $e[10];
        $widths[$cc] = $w;
        if($cc == ord('X'))
          $fm['CapXHeight'] = $e[13];
          
        // Set GID
        if ($cc >= 0 && $cc < 0xFFFF && $glyph) {
          $cidtogidmap{$cc*2} = chr($glyph >> 8);
          $cidtogidmap{$cc*2 + 1} = chr($glyph & 0xFF);
        }        
      }
      if($gn=='.notdef' && !isset($fm['MissingWidth']))
        $fm['MissingWidth']=$w;
    }
    elseif($code=='FontName')
      $fm['FontName']=$param;
    elseif($code=='Weight')
      $fm['Weight']=$param;
    elseif($code=='ItalicAngle')
      $fm['ItalicAngle']=(double)$param;
    elseif($code=='Ascender')
      $fm['Ascender']=(int)$param;
    elseif($code=='Descender')
      $fm['Descender']=(int)$param;
    elseif($code=='UnderlineThickness')
      $fm['UnderlineThickness']=(int)$param;
    elseif($code=='UnderlinePosition')
      $fm['UnderlinePosition']=(int)$param;
    elseif($code=='IsFixedPitch')
      $fm['IsFixedPitch']=($param=='true');
    elseif($code=='FontBBox')
      $fm['FontBBox']=array($e[1],$e[2],$e[3],$e[4]);
    elseif($code=='CapHeight')
      $fm['CapHeight']=(int)$param;
    elseif($code=='StdVW')
      $fm['StdVW']=(int)$param;
  }
  if(!isset($fm['MissingWidth']))
    $fm['MissingWidth']=600;

  if(!isset($fm['FontName']))
    die('FontName not found');

  $fm['Widths']=$widths;
  
  return $fm;
}

function MakeFontDescriptorTTF($fm)
{
  //Ascent
  $asc=(isset($fm['Ascender']) ? $fm['Ascender'] : 1000);
  $fd="array('Ascent'=>".$asc;
  //Descent
  $desc=(isset($fm['Descender']) ? $fm['Descender'] : -200);
  $fd.=",'Descent'=>".$desc;
  //CapHeight
  if(isset($fm['CapHeight']))
    $ch=$fm['CapHeight'];
  elseif(isset($fm['CapXHeight']))
    $ch=$fm['CapXHeight'];
  else
    $ch=$asc;
  $fd.=",'CapHeight'=>".$ch;
  //Flags
  $flags=0;
  if(isset($fm['IsFixedPitch']) and $fm['IsFixedPitch'])
    $flags+=1<<0;
  $flags+=1<<5;
  if(isset($fm['ItalicAngle']) and $fm['ItalicAngle']!=0)
    $flags+=1<<6;
  $fd.=",'Flags'=>".$flags;
  //FontBBox
  if(isset($fm['FontBBox']))
    $fbb=$fm['FontBBox'];
  else
    $fbb=array(0,$des-100,1000,$asc+100);
  $fd.=",'FontBBox'=>'[".$fbb[0].' '.$fbb[1].' '.$fbb[2].' '.$fbb[3]."]'";
  //ItalicAngle
  $ia=(isset($fm['ItalicAngle']) ? $fm['ItalicAngle'] : 0);
  $fd.=",'ItalicAngle'=>".$ia;
  //StemV
  if(isset($fm['StdVW']))
    $stemv=$fm['StdVW'];
  elseif(isset($fm['Weight']) and preg_match('/(bold|black)/i',$fm['Weight']))
    $stemv=120;
  else
    $stemv=70;
  $fd.=",'StemV'=>".$stemv;
  //MissingWidth
  if(isset($fm['MissingWidth']))
    $fd.=",'MissingWidth'=>".$fm['MissingWidth'];
  $fd.=')';
  return $fd;
}

function MakeWidthArrayTTF($fm)
{
  //Make character width array
  $s="array(";
  $cw=$fm['Widths'];
  $els=array();
  $c=0;
  foreach ($cw as $i => $w)
  {
    $els[] = ((($c++)%16==0)?"\n\t":'').$i.'=>'.$w;
  }
  $s .= implode(', ', $els);
  $s.=')';
  return $s;
}


/*******************************************************************************
* $fontfile: path to TTF file (or empty string if not to be embedded)          *
* $ufmfile:  path to UFM file                                                  *
*******************************************************************************/
function MakeFontTTF($fontfile,$ufmfile)
{
  //Generate a font definition file
  if (ini_get("magic_quotes_runtime")) set_magic_quotes_runtime(0);
  if(!file_exists($ufmfile))
    die('<B>Error:</B> UFM file not found: '.$ufmfile);
  $cidtogidmap = '';
  $fm=ReadUFM($ufmfile, $cidtogidmap);
  $fd=MakeFontDescriptorTTF($fm);
  //Find font type
  if($fontfile)
  {
    $ext=strtolower(substr($fontfile,-3));
    if($ext=='ttf')
      $type='TrueTypeUnicode';
    else
      die('<B>Error:</B> not a truetype font: '.$ext);
  }
  else
  {
    if($type!='TrueTypeUnicode')
      die('<B>Error:</B> incorrect font type: '.$type);
  }
  //Start generation
  $s='<?php'."\n";
  $s.='$type=\''.$type."';\n";
  $s.='$name=\''.$fm['FontName']."';\n";
  $s.='$desc='.$fd.";\n";
  if(!isset($fm['UnderlinePosition']))
    $fm['UnderlinePosition']=-100;
  if(!isset($fm['UnderlineThickness']))
    $fm['UnderlineThickness']=50;
  $s.='$up='.$fm['UnderlinePosition'].";\n";
  $s.='$ut='.$fm['UnderlineThickness'].";\n";
  $w=MakeWidthArrayTTF($fm);
  $s.='$cw='.$w.";\n";
  $s.="\$enc='';\n";
  $s.="\$diff='';\n";
  $basename=substr(basename($ufmfile),0,-4);
  if($fontfile)
  {
    //Embedded font
    if(!file_exists($fontfile))
      die('<B>Error:</B> font file not found: '.$fontfile);
    CheckTTF($fontfile);
    $f=fopen($fontfile,'rb');
    if(!$f)
      die('<B>Error:</B> Can\'t open '.$fontfile);
    $file=fread($f,filesize($fontfile));
    fclose($f);
    if(function_exists('gzcompress'))
    {
      $cmp=$basename.'.z';
      SaveToFile($cmp,gzcompress($file),'b');
      $s.='$file=\''.$cmp."';\n";
      // echo 'Font file compressed ('.$cmp.')<BR>';

      $cmp=$basename.'.ctg.z';
      SaveToFile($cmp,gzcompress($cidtogidmap),'b');
      //echo 'CIDToGIDMap created and compressed ('.$cmp.')<BR>';     
      $s.='$ctg=\''.$cmp."';\n";
    }
    else
    {
      $s.='$file=\''.basename($fontfile)."';\n";
      echo '<B>Notice:</B> font file could not be compressed (gzcompress not available)<BR>';
      
      $cmp=$basename.'.ctg';
      $f = fopen($cmp, 'wb');
      fwrite($f, $cidtogidmap);
      fclose($f);
      echo 'CIDToGIDMap created ('.$cmp.')<BR>';
      $s.='$ctg=\''.$cmp."';\n";
    }
    if($type=='Type1')
    {
      $s.='$size1='.$size1.";\n";
      $s.='$size2='.$size2.";\n";
    }
    else
      $s.='$originalsize='.filesize($fontfile).";\n";
  }
  else
  {
    //Not embedded font
    $s.='$file='."'';\n";
  }
  $s.="?>\n";
  SaveToFile($basename.'.php',$s);
  // echo 'Font definition file generated ('.$basename.'.php'.')<BR>';
  return true;
}


?>