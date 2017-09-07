<html>
<head>
    <style type="text/css">
        .name               {   color: #000000;         }
        .folderclose        {   height: 16px;
                                width: 16px;
                                display: inline-block;  }
        .area .last         {   background-image: url(02_files/01_images/paper_small.png);          }
        .folderclose        {   background-image: url(02_files/01_images/folder_green.png);         }
        .expand .tog        {   background-image: url(02_files/01_images/folder_green_open.png);    }
    </style>
    <script type="text/javascript" src="jquery-2.1.4.js"></script>
</head>
<body>
    <form>
    <table>
        <tr><th>No</th>
            <th>Area & Plant</th>
            <th>Location</th>
            <th>Main Group</th>
            <th>Sub Group</th>
            <th>Function Group</th>
            <th>Functional Location</th>
            <th>Equipment</th>
        </tr>
<?  $servername = "localhost";
	$username = "sasivarn_gbro";
	$password = "znp=X6qFPmR,";
	$dbname = "sasivarn_gbro";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn)
	{
		die('Could not connect: ' . mysqli_error());
	}
    $areaid = 1;
    $sql = mysqli_query("SELECT DISTINCT(name) FROM files");
    while($data=mysqli_fetch_array($sql)){?>
        <tr id="area">
            <td align='center' class="id"><?=$areaid?></td>
            <td align='left' width='400'>   <a class="folderclose"></a>
                                            <a title='<?=$areaid.'. '.$data['level']?>' href="javascript:void(0)" class="name"><?=$data['Business_Area']?></a></td></tr>
        <tr id="plant<?=$areaid?>"></tr><?
        $areaid++; }

if (!empty($_POST['area'])){
    $plantid = 1;
    $sql = mysqli_query("SELECT DISTINCT(name) FROM files WHERE level='$_POST[0]'");
    while($data=mysqli_fetch_array($sql)){?>
        <tr id="plant">
            <td align='center' class="id"><?=$plantid?></td>
            <td align='left' width='400'>   <a class="folderclose"></a>
                                            <a title='<?=$plantid.'. '.$data['Plant']?>' href="javascript:void(0)" class="name"><?=$data['Plant']?></a></td></tr>
        <tr id="level<?=$plantid?>"></tr><?
        $plantid++; }}?>

        </table>
    </form>
</body>
<script type="text/javascript">
$('document').ready(function(){
    $('#area .name').click(function() {
        var area = $(this).text();
        var areaid = $(this).parent().parent().find('.id').text();
        $('#plant'+areaid).html('<img src="02_files/01_images/loading.gif">');
        $.ajax({
            type:   'POST',
            url:    'index.php',
            data:   'area='+area+'&areaid='+areaid,
            success: function(data){
                $('#plant'+level).html(data).toggle();
            }
        });
    });
    $('#plant .name').click(function() {
        var plant = $(this).text();
        var plantid = $(this).parent().parent().find('.id').text();
        $('#location'+plantid).html('<img src="02_files/01_images/loading.gif">');
        $.ajax({
            type:   'POST',
            url:    'Action.php',
            data:   'plant='+plant+'&plantid='+plantid,
            success: function(data){
                $('#location'+plantid).html(data);
            }
        });
    });
});
</script>