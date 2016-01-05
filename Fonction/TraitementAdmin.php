<?php
session_start(); 
include 'ConnexionBDD.php';

if(isset($_GET["creaExo"])){  

  
        try{
            $req = $bdd->prepare("INSERT INTO t_exercice (Exercice_Name,Exercice_Repetition) 
                                    VALUES (:Exercice_Name,:Exercice_Repetition)");
            $req->execute(array(                 
            'Exercice_Name' => $_GET["nom"],
            'Exercice_Repetition' => $_GET["repetition"],
            ));

            $lastId = $bdd->lastInsertId();

              $reponse_difficulty = $bdd->query('SELECT * FROM t_difficulty');

                                while ($donnees_difficulty = $reponse_difficulty->fetch(PDO::FETCH_ASSOC))
                                {
                                    if ($donnees_difficulty["Difficulty_ID"] == $_GET['boxdif'].$donnees_difficulty["Difficulty_ID"]){

                                        $req = $bdd->prepare("INSERT INTO t_exercice_difficulty (ID_Difficulty,ID_Exercice) 
                                                                VALUES (:ID_Difficulty,:id)");
                                        $req->execute(array(                 
                                         'id' => $lastId,
                                        'ID_Difficulty' => $_GET['boxdif'],
                                        ));
                                    }


                                }
                                $reponse_difficulty->closeCursor();



               $reponse_objective = $bdd->query('SELECT * FROM t_objective');

                                while ($donnees_objective = $reponse_objective->fetch(PDO::FETCH_ASSOC))
                                {
                                    if ($donnees_objective["Objective_ID"] == $_GET['boxobj']){
                                        $req = $bdd->prepare("INSERT INTO t_exercice_objective (ID_Objective,ID_Exercice) 
                                                                VALUES (:ID_Objective,:id)");
                                        $req->execute(array(                 
                                         'id' => $lastId,
                                        'ID_Objective' => $_GET['boxobj'],
                                        ));
                                    }


                                }
                                $reponse_objective->closeCursor();                  





                //header('location:../Page/Administration.php?creation=exercice');
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
