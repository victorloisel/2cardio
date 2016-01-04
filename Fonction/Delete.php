<?php
session_start();
include 'ConnexionBDD.php';

if(isset($_POST["Delete"] )){

    try
    {
        $req = $bdd->prepare("DELETE FROM t_user WHERE User_ID = '" . $_POST["Delete"] ."'");          
        $req->execute();


        header('location:../Page/ListeUser.php');
    }
    catch(Exception $e)
    {
    die('Erreur : '.$e->getMessage());
    }     
}
   
  

?>


