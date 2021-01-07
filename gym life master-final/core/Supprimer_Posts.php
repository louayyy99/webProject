<?php
    include "PostsC.php";
    include "./../Entities/Posts.php";

    $PostsC=new PostsC ();
    $PostsC->Supprimer_PostsC($_POST['id=']);
    echo "<script type='text/javascript'> document.location = './../view/back/tables.php'; </script>";



?>