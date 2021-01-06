<?PHP

include_once 'C:/xampp/htdocs/eya-main-web/eya-main/gym life master/config.php' ;

class PostsC
{
 
    function Afficher_PostsC ()

    {
    $sql ='SELECT * FROM Posts';
    $db=config::getConnexion();
    try {
        $liste=$db->query ($sql);
        return $liste;

    }   catch (Exception $e) {
die ('Erreur' .$e->getMessage());
    }
    }


    function Ajouter_PostsC($PostsC)
    {
$sql="INSERT into Posts (title,image,content,category,date) values(:title,:image,:content,:category,:date)";
$db =config ::getConnexion();
try {
        $req =$db->prepare($sql);

        $title=$PostsC->gettitle();
        $image=$PostsC->getimage();
        $content=$PostsC->getcontent();
        $category=$PostsC->getcategory();
        $date=$PostsC->getdate();


        $req->bindValue(':title',$title);
        $req->bindValue(':image',$image);
        $req->bindValue(':content',$content);
        $req->bindValue(':category',$category);
        $req->bindValue(':date',$date);
        $req->execute();
        
}catch (Exception $e)
{
    echo "Erreur ".$e->getMessage();
}


    }

    
    function Supprimer_PostsC($id)
    {
   $sql='DELETE FROM Posts Where id=:id';
$db =config ::getConnexion();
try {   
       
        $req=$db->prepare($sql); 
        $req->bindValue(':id',$id);
        $req->execute();
       

}catch (Exception $e)
{
    echo "Erreur ".$e->getMessage();
}


    }



    function modifier_PostsC($PostsC)
    {
       
            $sql="Update Posts set title=:title , image=:image  ,category=:category, content=:content  where id=:id";
            $db=config::getConnexion();
       
            try{
            $req =$db->prepare($sql);
            $id=$PostsC->getid();
            $title=$PostsC->gettitle();
            $image=$PostsC->getimage();
            $category=$PostsC->getcategory();
            $content=$PostsC->getcontent();
            
    
            $req->bindValue(':id',$id);
            $req->bindValue(':title',$title);
            $req->bindValue(':image',$image);
            $req->bindValue(':category',$category);
            
            $req->bindValue(':content',$content);
            $req->execute();
        }
            catch( PDOException $e)
            { echo $e->getMessage();}

    }

 
}






?>