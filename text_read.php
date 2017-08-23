<html>
<title>example</title>
<center><h1> Byte convertion</h1></center>
<form action="" method="post"> 
	<label> Enter the size=</label>
	<input type="text" name="num"/><br>
	<input type="submit" name="btn_submit"  value="add"/>
</form>
<?php
if(isset($_POST['btn_submit']))
{
    $a = $_POST['num1'];
	convert($a);
}
function convert($a)
{
    $len = strlen($a);
    if($len < 4)
    {
		?><h4><? return sprintf("%d b", $a);?></h4><?
    }
    if($len >= 4 && $len <=6)
    {
       ?><h4><? return sprintf("%0.2f Kb", $a/1024);?></h4><?
    }
    if($len >= 7 && $len <=9)
    {
       ?><h4><? return sprintf("%0.2f Mb", $a/1024/1024);?></h4><?
    }   
    ?><h4><? return sprintf("%0.2f Gb", $a/1024/1024/1024);  ?></h4><?                         
}?>
</html> 
