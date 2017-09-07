<html>
<?php
$servername = "localhost";
	$username = "sasivarn_gbro";
	$password = "znp=X6qFPmR,";
	$dbname = "sasivarn_gbro";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn)
	{
		die('Could not connect: ' . mysqli_error());
	}
	$sql=" SELECT * FROM files WHERE 'level'==0";
    $q=mysqli_query($conn,$sql);
	//mysqli_query($conn,$query);
	if($q)
	{
	while($row=mysqli_fetch_array($q)){ 
          $f  =$row['name']; 
	          $l=$row['size']; 
	          $id=$row['level']; 
			  echo $l;
			  echo $f;
			  echo $id;
	}
	}
mysqli_close($conn);
?>
	</html>