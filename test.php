<html>
<?php
	echo __DIR__;
	$dirprefix ='/home1/sasivarnakum/grocerbro.com/joom/' ;
	$dir=$dirprefix;
	$a=dirsize($dir);
	?><br><?
	echo("full size=");
	print(convert($a));
	//size count
	function dirsize($dir)
    {
		@$dh = opendir($dir);
		$size = 0;
		$a=0;
		$b=0;
		$c=0;
		$id=0;
		$l=0;
		while ($file = @readdir($dh))
		{		 
			//$l=$l+.1;
			$c=$l;
			if ($file != "." and $file != "..") 
			{
				$path = $dir."/".$file;
								
				if (is_dir($path))
				{		
					$type=1;
					$size += dirsize($path);
					$x=convert($s);
					$y=convert($size);					
					//db($id,$path,$file,$size,$type);	
					$s_size=0;					
					
				}
				elseif (is_file($path))
				{
					$type=0;
					$fsize = filesize($path);
					$size += filesize($path); 
					$s_size +=filesize($path);
					print($fsize);?><br><?
					print($s_size);?><br><?
					print($size);?><br><?
					//$x=convert($s);
					//$y=convert($size);
					//db($id,$path,$file,$fsize,$type);
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
function db($id,$path,$file,$size,$type)
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
	$query="INSERT INTO `file_size`(`id`,`file_path`,`file_name`,`file_size`,`type`) VALUES ('$id','$path','$file','$size','$type')";
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