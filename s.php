  <html>
<?php
	//echo __DIR__;
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
      while ($file = @readdir($dh))
      {		 
		 ?><br><?
        if ($file != "." and $file != "..") 
        {
          $path = $dir."/".$file;
		      
		    if (is_dir($path))
          {							
			$size += dirsize($path);
			//sub folder size
		?><br><h5><?	echo($file);
			$a=$size;
			$b=$a-$c;
			$c=$b;
			echo("=");
			print(convert($c));?><br></h5><?
			//main folder size
			?><br><h4><?echo("folder size=");
			print(convert($size));?></h4><?

			}
          elseif (is_file($path))
          {
			$s = filesize($path);
			$size += filesize($path); 
			echo($file);//file size
			echo("=>");
			print(convert($s));?><br><?
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

?>
</html>