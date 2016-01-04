<?php
    session_start();

if(isset($_POST["Delete"] )){

 include 'Fonction/Connexion.php';


        $id = $_POST["Delete"];
      echo $id;
        try
        {
                    $req = $bdd->prepare("DELETE FROM Utilisateur WHERE idUtilisateur = :id");
                    $req->execute(array(
                    'id' => $id
                    ));
                    header('location:ListeUser.php');
        }
        catch(Exception $e)
        {
        die('Erreur : '.$e->getMessage());
        }     
    }else
   
  

?>


