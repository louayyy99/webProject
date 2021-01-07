<?php

include "PostsC.php";
include "../Entities/Posts.PHP";


if ( !empty($_POST['title'] )&& !empty($_POST['image'])  && !empty($_POST['category'] ) && !empty($_POST['content'] )&& !empty($_POST['idd'] ) )
{ 
$PostsC=new PostsC();
$create_datetime = date("Y-m-d");

$Posts=new Posts ($_POST['idd'],$_POST['title'],$_POST['image'],$_POST['content'],$_POST['category'],$create_datetime);


$PostsC->modifier_PostsC($Posts);
echo "<script type='text/javascript'> document.location = './../view/back/tables.php'; </script>";

} else 
echo "error";








?>