<?php
/**
 * DB
 * user : root
 * pass: student
 * db: test
 * table documents
 * http://localhost/phpmyadmin/
 *
 * run script
 * http://localhost/m/script.php
 * */
 error_reporting(E_ALL);


$i=1;
    print($i);
    $servername = "localhost";
    $username = "root";
    $password = "student";
    $dbname = "test";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn)
    {
        die('Could not connect: ' . mysql_error());
    }

 
 $query="select * from documents";
 $res=mysqli_query($conn,$query);

  while($row = $res->fetch_assoc()) {
    $str_to_com = strtolower(substr($row['filepath'], 0,4));
   
    category_call($row['id'], $str_to_com);
     
    }

function category_call($id, $cate1)
    {           
        $str1="rese";
        $str2="moti";
        $str3="case";
        $str4="juve";
        $str5="brie";
        $str6="rece";
        $str7="outl";
        $str8="jury";
        if(strcmp($cate1,$str1)==0)
                {
                    $c_id=4;
                    $cat='Misc. Research and Notes';
                    category($id,$c_id,$cat);
                }
                else if(strcmp($cate1,$str2)==0)
                {
                    $c_id=5;
                    $cat='Motions';
                    category($id,$c_id,$cat);
                }   
                    else if(strcmp($cate1,$str3)==0)
                {
                    $c_id=6;
                    $cat='Case Summaries';
                    category($id,$c_id,$cat);
                }
                else if(strcmp($cate1,$str4)==0)
                {
                    $c_id=7;
                    $cat='Juvenile';
                    category($id,$c_id,$cat);
                }
                else if(strcmp($cate1,$str5)==0)
                {
                    $c_id=8;
                    $cat='Briefs';
                    category($id,$c_id,$cat);
                }
                else if(strcmp($cate1,$str6)==0)
                {
                    $c_id=9;
                    $cat='Recent cases';
                    category($id,$c_id,$cat);
                }
                else if(strcmp($cate1,$str7)==0)
                {
                    $c_id=10;
                    $cat='Outlines';
                    category($id,$c_id,$cat);
                }
                else if(strcmp($cate1,$str8)==0)
                {
                    $c_id=11;
                    $cat='Jury Instructions';
                    category($id,$c_id,$cat);
                }

    }   

function category($id,$c_id,$cate)
{
   
    $servername = "localhost";
    $username = "root";
    $password = "student";
    $dbname = "test";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn)
    {
        die('Could not connect: ' . mysql_error());
    }
   
    $id = intval($id);
   
    $query="update documents set cat_id=".$c_id.",category='".$cate."' where id=".$id;
   
    echo $query;
    echo '<br>';
   
    mysqli_query($conn,$query);
    if(!$query)
    {   
        die('Could not enter data: ' . mysql_error());
    }
   
    mysqli_close($conn);
}