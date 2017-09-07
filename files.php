<html>
<?php
	echo __DIR__;
	$dirprefix ='/home1/sasivarnakum/grocerbro.com/joom/' ;
	$dir=$dirprefix;
	//$spl[] = array();
	$spl() = array(split ("\/", $dir[1])); 
	//$n=length($spl);	
   print(count($spl[]));
  /* print "$spl[0] <br />";
   print "$spl[1] <br />";
   print "$spl[2] <br />";
   "  ;/*for($i=0;$i<=strlen($dir);$i++)
	{
		if($dir[i]!='/')
		{
		$spt[i]=(split($dir,'/'));
		print($spt[i]);
	}*/
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
					$size += dirsize($path);
					//echo($file);
					$l=$l+1;
					//echo("=");
					//print(convert($c));
					//main folder size
					//echo("folder size=");
					//print(convert($size));	
					$x=convert($s);
					$y=convert($size);					
			//		db($id,$path,$l,$file,$x,$y);			
					/*if($l>0)
					{?><br><?
						$a="&nbsp;&nbsp;&nbsp;";
						echo($a);
						echo($file);
						echo("=");
						echo($s);
					}*/
				}
				elseif (is_file($path))
				{
					$a="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
					$l=0;
					$s = filesize($path);
					$size += filesize($path); 
				//echo($file);//file size
				//echo("=>");
				//print(convert($s));
					$x=convert($s);
					$y=convert($size);
					//if($l>0
		//			db($id,$path,$l,$file,$x,$y);
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
	$query="INSERT INTO `file` (`id`, `dir_name`, `level`,`file_name`,`size`,`t_size`) VALUES ('$id','$path','$l','$file','$s','$size')";
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