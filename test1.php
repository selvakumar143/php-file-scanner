<html>
<?php
	echo __DIR__;
	$dirprefix =__DIR__ ;
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
			if ($file != "." and $file != "..") 
			{
				$path = $dir."/".$file;
								
				if (is_dir($path))
				{				
					
					$size += dirsize($path);
					//echo($file);
					$l=$l+1;
					//$l=$l+1;
					//echo("=");
					//print(convert($c));
					//main folder size
					//echo("folder size=");
					//print(convert($size));
					$x=convert($s);
					$y=convert($size);					
					db($id,$path,$l,$file,$x,$y);
					
					//$c=0;	
				}
				elseif (is_file($path))
				{
					//$c=$c+1;
					$s = filesize($path);
					$size += filesize($path); 
				//echo($file);//file size
				//echo("=>");
				//print(convert($s));
					$x=convert($s);
					$y=convert($size);
					db($id,$path,$l,$file,$x,$y);
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
function db($id,$path,$l,$file,$s,$size)
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
	$query="INSERT INTO `files` (`id`, `dir_name`, `level`,`file_name`,`size`,`t_size`) VALUES ('$id','$path','$l','$file','$s','$size')";
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