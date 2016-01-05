<?php
session_start(); 
include 'ConnexionBDD.php';

if(isset($_GET["creaExo"])){  

  
        try{
            $req = $bdd->prepare("INSERT INTO t_exercice (Exercice_Name) 
                                    VALUES (:Exercice_Name)");
            $req->execute(array(                 
            'Exercice_Name' => $_GET["nom"],
            ));


                header('location:../Page/Administration.php?creation=exercice');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        } 
}




if(isset($_GET["DeleteExo"])){  
    try{
        $req = $bdd->prepare("DELETE FROM t_exercice WHERE Exercice_ID = '" . $_GET["DeleteExo"] ."'");          
        $req->execute();

        header('location:../Page/Administration.php?creation=exercice');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    } 
}


if(isset($_GET["creaObj"])){  

  
        try{
            $req = $bdd->prepare("INSERT INTO t_objective (Objective_Name,Objective_Factor) 
                                    VALUES (:Objective_Name,:Objective_Factor)");
            $req->execute(array(                 
            'Objective_Name' => $_GET["nom"],
            'Objective_Factor' => $_GET["factor"],
            ));

          
                header('location:../Page/Administration.php?creation=objective');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        } 
}




if(isset($_GET["DeleteObj"])){  
    try{
        $req = $bdd->prepare("DELETE FROM t_objective WHERE Objective_ID = '" . $_GET["DeleteObj"] ."'");          
        $req->execute();

        header('location:../Page/Administration.php?creation=objective');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    } 
}



if(isset($_GET["creaDif"])){  

  
        try{
            $req = $bdd->prepare("INSERT INTO t_difficulty (Difficulty_Name,Difficulty_Factor) 
                                    VALUES (:Difficulty_Name,:Difficulty_Factor)");
            $req->execute(array(                 
            'Difficulty_Name' => $_GET["nom"],
            'Difficulty_Factor' => $_GET["factor"],
            ));

          
                header('location:../Page/Administration.php?creation=difficulty');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        } 
}




if(isset($_GET["DeleteDif"])){  
    try{
        $req = $bdd->prepare("DELETE FROM t_difficulty WHERE Difficulty = '" . $_GET["DeleteDif"] ."'");          
        $req->execute();

        header('location:../Page/Administration.php?creation=difficulty');
    }
    catch(Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    } 
}
?>
