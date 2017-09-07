<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</head>
<body>
	
<?php 

error_reporting(E_ALL);

$level = 6;
if ( isset($_GET['level']) ) {
	$level = $_GET['level'] ;
}

$base_path = '/home1/sasivarnakum/grocerbro.com/joom/';
$path = '/home1/sasivarnakum/grocerbro.com/joom/';

if ( isset($_GET['path']) ) {
	$path .= $_GET['path'] ;
}
echo "Path : ".$path ;
echo "<br>";
echo "Total Size : ".  convert ( getFileSize ( $base_path ) );

$folder_list = getFolderList($level, $path);

//echo '<pre>';
//echo "Before sorting";
//print_r($folder_list );

// ref https://stackoverflow.com/questions/17364127/how-can-i-sort-arrays-and-data-in-php
 usort($folder_list, 'cmp');
//echo "after sort";
//print_r($folder_list);

?>
	    <div class="container">
	    	<div class="row">
	    		<div class="col-md-2"></div>
	    		<div class="col-md-4">
	    			
			    <table class="table table-bordered table-striped">
			    	<tr>
			    		<th>Folder name</th>
			    		<th>Size</th>
			    	</tr>
				    <?php 
				    foreach ($folder_list as $key => $folder) {
				    	echo "<tr>";
				    	
				    	echo "<td> <a href=\"".$folder['link']."\" > ".$folder['name']." </a></td>";
				        
				        echo "<td>". $folder['printable_size'] ."</td>";
				        //echo "<td>". $folder['printable_size'] ."( ". $folder['size'] .")</td>";
				        
				        echo "</tr>";
				    }
				    ?>
	   			 </table>

	    		</div>
	    		<div class="col-md-4">
	    			<!-- file list -->
	    		</div>
	    		<div class="col-md-2"></div>
	    	</div>
	    </div>
	    <?php  

function getFolderList($level=6,$path='/home1/sasivarnakum/grocerbro.com/')
{
	$folder_list = [];
	$servername = "localhost";
	$username = "sasivarn_gbro";
	$password = "znp=X6qFPmR,";
	$dbname = "sasivarn_gbro";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn)
	{
		die('Could not connect: ' . mysql_error());
	}
	
	$query=" SELECT * FROM file_list WHERE type=1 ";
	$query.=" AND level=".intval($level);
	$query.=" AND file_path LIKE '%".$path."%'";

	/*
	echo $query;
	 
	select * from file_list
		WHERE
		type=1 
		AND file_path LIKE "%/home1/sasivarnakum/grocerbro.com/joom//templates/beez3%"
		AND level = 8;
	 */
	$result = $conn->query($query);

	//echo '<pre>';
	//print_r($result);
	
	if ($result->num_rows > 0) {
	    // output data of each row
	    
	     while($row = $result->fetch_assoc()) {
	     	$folder = [];
	    	$folder ['id'] = $row['id'];
	    	$this_path = '';
	    	$this_path = substr( $row['file_path'], 39 ); // strlen of the base path
	    	$this_level = $row['level']+1 ;
	    	$folder ['link'] = "/list-files.php?level=".$this_level."&path=".$this_path;
	    	$folder['name'] = $row['file_name'];

	        $this_size = getFileSize( $row['file_path'] );
	        $folder ['size'] = $this_size;

	        $this_size = convert($this_size);
	        $folder ['printable_size'] = $this_size;

	        array_push($folder_list, $folder);
	    }
	} else {
	    echo "0 results";
	}
	$conn->close();
	return $folder_list;
}

function getFileSize($path = '/home1/sasivarnakum/grocerbro.com/joom/'){
	$servername = "localhost";
	$username = "sasivarn_gbro";
	$password = "znp=X6qFPmR,";
	$dbname = "sasivarn_gbro";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn)
	{
		die('Could not connect: ' . mysql_error());
	}
	
	$query=" SELECT sum(file_size) as sum_file_size FROM file_list WHERE type=0 ";
	$query.=" AND file_path LIKE '%".$path."%'";

	/*
	echo $query;
	 
	select sum(file_size) from file_list
		WHERE
		type=0 
		AND file_path LIKE "%/home1/sasivarnakum/grocerbro.com/joom//templates%";
	 */
	
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);
	$sum_file_size = $row['sum_file_size'];

	$conn->close();

	return $sum_file_size;
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

function cmp(array $a, array $b) {
    if ($a['size'] > $b['size']) {
        return -1;
    } else if ($a['size'] < $b['size']) {
        return 1;
    } else {
        return 0;
    }
}
	 ?>
</body>
</html>