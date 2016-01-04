<?php
session_start(); 
include 'ConnexionBDD.php';

if(isset($_GET["creer"])){  

  
        try{
            $req = $bdd->prepare("INSERT INTO Topic (Topic_titre,id_User) 
                                    VALUES (:Topic_titre,:id_User)");
            $req->execute(array(                 
            'Topic_titre' => $_GET["Titre"],
            'id_User' => $_SESSION["id"]
            ));

            $lastId = $bdd->lastInsertId();

            $reqQuestion = $bdd->prepare("INSERT INTO Reponse (Topic_id,id_User,Reponse_texte) 
                                    VALUES (:Topic_id,:id_User,:Reponse_texte)");
            $reqQuestion->execute(array(                 
            'Topic_id' => $lastId,
            'id_User' => $_SESSION["id"],
            'Reponse_texte' => $_GET["question"]
            ));
                header('location:../Page/Forum.php');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        } 
}



if(isset($_GET["DeleteTopic"])){  

  
        try{
            $req = $bdd->prepare("DELETE FROM Topic WHERE Topic_id = '" . $_GET["DeleteTopic"] ."'");          
        $req->execute();


        $role = $bdd->prepare("SELECT Reponse_id FROM Reponse WHERE Topic_id = '".$_GET["DeleteTopic"]."'");
        $role->execute();
        $count = $role->rowCount();

        if($count > 0){   
            try{
               $req = $bdd->prepare("DELETE FROM Reponse WHERE Topic_id = '" . $_GET["DeleteTopic"] ."'");          
                $req->execute();
            }
            catch(Exception $e)
            {
                die('Erreur : '.$e->getMessage());
            } 

        
                
        }
        header('location:../Page/Forum.php');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        } 
}

if(isset($_GET["DeleteReponse"])){  
    try{
        $req = $bdd->prepare("DELETE FROM Reponse WHERE Reponse_id = '" . $_GET["DeleteReponse"] ."'");          
        $req->execute();

        header('location:../Page/Forum.php?Topic='.$_GET["Topic"].'');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    } 
}
?>
