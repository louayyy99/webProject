<?php

include 'PostsC.PHP';
include '../Entities/Posts.php';



if ( !empty($_POST['title'] )&& !empty($_POST['image']) && !empty($_POST['content'] ) && !empty($_POST['category'] )   )
{ 
    $create_datetime = date("Y-m-d");
    $Posts=new Posts (0,$_POST['title'],$_POST['image'],$_POST['content'],$_POST['category'],$create_datetime);
    
    $PostsC=new PostsC();
    $PostsC->Ajouter_PostsC($Posts);
    echo "<script type='text/javascript'> document.location = './../view/blog.php';
    alert ('post added'); </script>";
   // header ('Location : ../View/AfficherEmploye.PHP');

} else echo "Empty FIelds";

?>