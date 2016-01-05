<?php
session_start(); 
include 'ConnexionBDD.php';

if(isset($_POST["validerrep"])){  

  
        try{
            $req = $bdd->prepare("UPDATE  t_history SET  History_Repetition = :NbRep WHERE  ID_User = :ID and ID_Exercice = :Rep");
            $req->execute(array(  
            'NbRep' => $_POST["nbrep"],               
            'ID' => $_SESSION["id"],
            'Rep' => $_POST["validerrep"],
            ));
            
            header('location:../Page/Programme.php?encours=test');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        } 
}


if(isset($_POST["validerprog"])){  

  
        try{
            $req = $bdd->prepare("UPDATE  t_history SET  ID_Status = 2 WHERE  ID_User = :ID and ID_Status = 1");
            $req->execute(array(                         
            'ID' => $_SESSION["id"],         
            ));
            
            header('location:../Page/Programme.php');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        } 
}


if(isset($_POST["annulerprog"])){  
    try{
        $req = $bdd->prepare("DELETE FROM t_history WHERE  ID_User = :ID and ID_Status = 1");          
        $req->execute(array(                         
            'ID' => $_SESSION["id"],         
            ));

        header('location:../Page/Programme.php');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    } 
}
?>
