<?php
class DBOperations
{
private $ServerCon;
private $DbCon;
private $ttttt;
	function __construct()
	{
	$this->Connect_to_DB();
	}
	public function Connect_to_DB()
	{
	$this->ServerCon = mysqli_connect("localhost","root",'');
	if (!$this->ServerCon)
		  {
		  die('Could not connect: ' . mysqli_error());
		  }
	  else
		  {
			$this->DbCon =mysqli_select_db( $this->ServerCon,"misbpudb");
			if (!$this->DbCon)
			  {
			  die('DB Error: ' . mysqli_error());
			  }
		  }  
	} 
	public function prepare($query) {
        return $this->DbCon->prepare($query);
    }
	public function Disconnect_from_DB()
	{
				if(isset($this->ServerCon))
				{
					mysqli_close($this->ServerCon);
					unset($this->ServerCon);
				}
	}
	public function executeQuery($query)
	{
		$this->ttttt=$query;
			$result = mysqli_query($this->ServerCon,$query);
				if(!$result)
				{
					die('DB Error: ' . mysqli_error(). " <br/>" .$query);
					echo '<script> alert ("'. mysqli_error() .'"); </script>';
					/*echo '<script> alert ("This Record is Already Added or Something is Wrong with Your Values"); </script>';*/
				} 
				else 
				{ 
					return $result;
				}
	}
	
	public function lastID()
	{
		return $this->ServerCon->insert_id;
	}
	public function Exe_MultiQry($query)
	{
		$this->ttttt=$query;
		$count = 1;
		
		
		
		
		if (mysqli_multi_query($this->ServerCon,$query))
		{
		  do
			{
			// Store first result set
			if ($result=mysqli_store_result($this->ServerCon)) {
			  // Fetch one and one row
			  
			  if($count==2)
			  {
				 return $result; 
			  }
			  // Free result set
			  mysqli_free_result($result);
			  }
			  $count++;
			}
		  while (mysqli_next_result($this->ServerCon));
		}
		
	}
	public function Next_Record($result)
	{
		
			return mysqli_fetch_array($result,MYSQLI_BOTH);
	}
	public function Row_Count($result)
	{
		return mysqli_num_rows($result);
	}
	
	public function Row_Affec()
	{
			return mysqli_affected_rows($this->ServerCon);
	}

	function cleanInput($value)
	{
		// if (get_magic_quotes_gpc())
	    {
	    $value = stripslashes($value);
	    }
		$value = mysqli_real_escape_string($this->ServerCon,$value);
		return $value;
	}

	

		
}
?>
