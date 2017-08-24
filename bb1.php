<?php
	$servername = "localhost";
	$username = "sasivarn_gbro";
	$password = "znp=X6qFPmR,";
	$dbname = "sasivarn_gbro";
	$con=mysqli_connect($servername,$username,$password,$dbname);
	if (!$con)
	{
		die('Could not connect:'.mysql_error());
	}
	$query="select * from file_size1 limit 10";
	$res=mysqli_query($con,$query);
	while($row=$res->fetch_assoc())
	{
		$a=[];
		$a['id']= array ($row['id']);
		print($row['file_name']);
		print('<br>');
		//print_r($a);
	}
	print_r($a);
	mysqli_close($con);
	
		
?>