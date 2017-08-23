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

</html> 
