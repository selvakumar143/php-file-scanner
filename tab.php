<html>
<?php
	echo __DIR__;
	$dirprefix ='/home1/sasivarnakum/grocerbro.com/joom/' ;
	$dir=$dirprefix;
	$a=dirsize($dir);
	?><br><?
	echo("full size=");
	print(convert($a));
	function dirsize($dir)
    {
		@$dh = opendir($dir);
		$size = 0;
		
		$ll=0;
		$id=0;
		$l=0;
		while ($file = @readdir($dh))
		{	 
			
			if ($file != "." and $file != "..") 
			{	
		$path = $dir."/".$file;
				
				
				
											
				if (is_dir($path))
				{		
					$type=1;
					$ll=0;
					$s_len=strlen($path);
				//	$path = $dir."/".$file;
					for($i=0;$i<$s_len;$i++)
						{
						$char = substr( $path, $i, 1 );									
						if (strcmp($char,"/")==0)
						{			
							$ll=$ll+1;
							}
						}
					$x=convert($s);
					$y=convert($size);
					//$lvl=level($path);				
					db($id,$path,$file,$size,$type,$ll);
					$size += dirsize($path);	
						$ll=0;
						}
				elseif (is_file($path))
				{
					$type=0;
					$ll=0;
					$fsize = filesize($path);
					$size += filesize($path); 
					//$s_size +=filesize($path);					
					//$lvl=level($path);
					$s_len=strlen($path);
					
					for($i=0;$i<$s_len;$i++)
						{
						$char = substr( $path, $i, 1 );									
						if (strcmp($char,"/")==0)
						{			
							$ll=$ll+1;
							}
						}
						db($id,$path,$file,$fsize,$type,$ll);
						$ll=0;
					
				}
			}
		}
    @closedir($dh);
    return $size;
    }
	//convert
function convert($a)
{
    $len = strlen($a);
    if($len < 4)
    {
        return sprintf("%d b", $a);
    }
    if($len >= 4 && $len <=6)
    {
        return sprintf("%0.2f Kb", $a/1024);
    }
    if($len >= 7 && $len <=9)
    {
        return sprintf("%0.2f Mb", $a/1024/1024);
    }   
    return sprintf("%0.2f Gb", $a/1024/1024/1024);
                           
}
function db($id,$path,$file,$size,$type,$ll)
{
	$servername = "localhost";
	$username = "sasivarn_gbro";
	$password = "znp=X6qFPmR,";
	$dbname = "sasivarn_gbro";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn)
	{
		die('Could not connect: ' . mysql_error());
	}
	//echo"connected";
	$query="INSERT INTO `file_list`(`id`,`file_path`,`file_name`,`file_size`,`type`,`level`) VALUES ('$id','$path','$file','$size','$type','$ll')";
	mysqli_query($conn,$query);
	if(!$query)
	{	
		die('Could not enter data: ' . mysql_error());
	}
	//echo "Entered data successfully\n";
	mysqli_close($conn);
}
?>
</html>