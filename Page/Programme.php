<?php

session_start();
include '../Fonction/ConnexionBDD.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Simple Sidebar</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/simple-sidebar.css" rel="stylesheet">
    <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css">

  <!-- Compiled and minified JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>
</head>

<body>
    <div id="wrapper">
        <?php 
        include 'Sidebar.php';
        ?>

        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                    
                      </br>
                        </br>
                        </br>
                        <h5>Générer son programme : </h5>
                            <form action="Programme.php" method="post" class="form-inline">
                                    <label>Difficulté :</label>                                       
                                        <select name="difficulty" class="form-control" style="width:300px; ">
                                        <?php
                                        $reponse_difficulty = $bdd->query('SELECT * FROM t_difficulty');

                                        while ($donnees_difficulty = $reponse_difficulty->fetch(PDO::FETCH_ASSOC))
                                        {
                                        ?>
                                            <option style="color:black;" value="<?php echo $donnees_difficulty["Difficulty_Name"];?>"><?php echo $donnees_difficulty["Difficulty_Name"];?></option>  
                                        <?php
                                        }
                                        $reponse_difficulty->closeCursor();
                                        ?>
                                        </select>
                                
                               
                                         <label>Objectif :</label>
                                        <select name="objective" class="form-control" style="width:300px; ">
                                        <?php
                                        $reponse_objective = $bdd->query('SELECT * FROM t_objective');

                                        while ($donnees_objective = $reponse_objective->fetch(PDO::FETCH_ASSOC))
                                        {
                                        ?>
                                            <option style="color:black;" value="<?php echo $donnees_objective["Objective_Name"];?>"><?php echo $donnees_objective["Objective_Name"];?></option>  
                                        <?php
                                        }
                                        $reponse_objective->closeCursor();
                                        ?>
                                        </select>

                                
                                <?php
                                $TestProgramme = $bdd->prepare("SELECT * FROM t_history where ID_Status = 1 and  ID_User = '".$_SESSION["id"]."'");
                                $TestProgramme->execute();
                                $count = $TestProgramme->rowCount();
                                if($count > 0){
                                ?>
                                <button type="submit" name="generer" value="test" class="btn btn-primary" onclick="return confirm('Attention, un programme est déja en cours !')" style="background-color:#26A64A; font-weight: bold;">Generer</button>

                                <button type="submit" name="encours" value="test" class="btn btn-danger" style=" font-weight: bold;">Voir mon programme</button>
                                <?php
                                }else{
                                ?>
                                 <button type="submit" name="generer" value="test" class="btn btn-primary" style="background-color:#26A64A; font-weight: bold;">Generer</button>
                                <?php
                                }
                                ?>                                
                            </form>

<?php
    
if(isset($_POST["encours"]) || isset($_GET["encours"])){  
?>
<br>
<br>
        <h5>Votre programme en cours :</h5>

                 <table class="table table-bordered">
                               
                                <tr style="background-color: #26a69a; color:white; font-weight: bold;">
                                  
                                    <td>Nom de l'exercice</td>
                                    <td>Nombre de repetitions / durée</td>
                                    <td>Nombre de repetitions / durée faites</td>
                                    
                                </tr>
                                <?php
                                    $reponse = $bdd->query("SELECT ID_Exercice, History_Repetition, ID_Objective, ID_Difficulty,Exercice_Name,
                            (Exercice_Repetition*(select Difficulty_Factor from t_difficulty where Difficulty_ID = ID_Difficulty)*(select Objective_Factor from t_objective where Objective_ID = ID_Objective)) as  Exercice_Repetition
                                                            FROM t_history inner join t_exercice on Exercice_ID = ID_Exercice
                                                            where ID_Status = 1 and ID_User = '".$_SESSION["id"]."' 
                                                          ");
                                    while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
                                    {
                                    
                                        
                                    ?> 
                                            <tr><td style=" font-weight: bold; width: 10px;"><?php echo $donnees["Exercice_Name"];?></td>
                                                <td style=" font-weight: bold; width: 10px;"><?php echo $donnees["Exercice_Repetition"];?></td>
                                            


                                                  <td style="border:none; font-weight: bold; width: 10px;">
                                                    <form action="../Fonction/TraitementProgramme.php" method="post">
                                                                                                    <?php

                                            if(is_null($donnees["History_Repetition"])){
                                            ?>
                                                        <input type="text" class="style-5" style="width:75px;"  name="nbrep"/>
                                            <?php
                                            }else{
                                             ?>
                                                        <input type="text" class="style-5" style="width:75px;" value=<?php echo $donnees["History_Repetition"];?> name="nbrep"/>

                                            <?php
                                            }
                                            ?> 

                                                        
                                                        <button type="submit" name="validerrep" value="<?php echo $donnees["ID_Exercice"];?>" class="btn btn-primary" style="background-color:#26A64A; font-weight: bold;">Ok</button>

                                                    </form>
                                                </td>  
                                            </tr>                     
                                    <?php

                                    }

                                    $reponse->closeCursor(); 
                                    ?>
                                    
                        </table>

                                                    <form onsubmit="return confirm('etes vous sur ?');" action="../Fonction/TraitementProgramme.php" method="post">
                                                        <button type="submit" name="validerprog" value="<?php echo $donnees["ID_Exercice"];?>" class="btn btn-primary" style="background-color:#26A64A; font-weight: bold; width:300px;">Valider mon programme</button>
                                                        <br>
                                                        <br>
                                                        <button type="submit" name="annulerprog" value="<?php echo $donnees["ID_Exercice"];?>" class="btn btn-danger" style="background-color:#B20000; font-weight: bold; width:300px;">Annuler mon programme</button>
                                                    </form>

<?php 
   }       
?>
                   
                        </br>
                        </br>
                        </br>


<?php
    
if(isset($_POST["generer"])){  

    $DeleteEnCours = $bdd->prepare("SELECT History_ID,MAX(History_Programme) as History_Programme FROM t_history WHERE ID_Status = 1 and ID_User = '" . $_SESSION["id"] ."'");
        $DeleteEnCours->execute();
        $count = $DeleteEnCours->rowCount();

        if($count > 0){  
           
            try{
               $req = $bdd->prepare("DELETE FROM t_history WHERE ID_Status = 1 and ID_User = '" . $_SESSION["id"] ."'");          
                $req->execute();
            }
            catch(Exception $e)
            {
                die('Erreur : '.$e->getMessage());
            }        
        }else{
            
           
        }
      

?>
<br>
<br>
        <h5>Notre proposition :</h5>
                
                 <table class="table table-bordered">
                               
                                <tr style="background-color: #26a69a; color:white; font-weight: bold;">
                                  
                                    <td>Nom de l'exercice</td>
                                    <td>Nombre de repetitions / durée</td>
                                    
                                    
                                </tr>
                                <?php
                                    $prog1 = $bdd->query("SELECT MAX(History_Programme) FROM t_history WHERE ID_User = '" . $_SESSION["id"] . "'");
                                    $prog = $prog1->fetch(PDO::FETCH_ASSOC);
                                    $i = $prog["MAX(History_Programme)"]+1;


                                    $reponse = $bdd->query("SELECT Exercice_Name,Exercice_ID, (
                                                                Exercice_Repetition * ( 
                                                                SELECT Difficulty_Factor
                                                                FROM t_difficulty
                                                                WHERE Difficulty_Name =  '".$_POST["difficulty"]."' ) * ( 
                                                                SELECT Objective_Factor
                                                                FROM t_objective
                                                                WHERE Objective_Name =  '".$_POST["objective"]."' )
                                                                ) AS Exercice_Repetition
                                                                FROM t_exercice
                                                                WHERE Exercice_ID
                                                                IN (

                                                                SELECT ID_Exercice
                                                                FROM t_exercice_difficulty
                                                                WHERE ID_Difficulty = ( 
                                                                SELECT Difficulty_ID
                                                                FROM t_difficulty
                                                                WHERE Difficulty_Name =  '".$_POST["difficulty"]."' )
                                                                )
                                                                AND Exercice_ID
                                                                IN (

                                                                SELECT ID_Exercice
                                                                FROM t_exercice_objective
                                                                WHERE ID_Objective = ( 
                                                                SELECT Objective_ID
                                                                FROM t_objective
                                                                WHERE Objective_Name =  '".$_POST["objective"]."' )
                                                                )
                                                                ORDER BY RAND( ) 
                                                                LIMIT 3");
                                    while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
                                    {
                                      
                                         $req = $bdd->prepare("INSERT INTO t_history 
                                            ( History_Programme, ID_User, ID_Exercice, ID_Difficulty, ID_Objective, 
                                                ID_Status, History_Date, History_Repetition) 
                                                VALUES ( '" . $i ."','" . $_SESSION["id"] ."',
                                                        (select Exercice_ID from t_exercice WHERE Exercice_Name = '" . $donnees["Exercice_Name"] ."'),
                                                        (select Difficulty_ID from t_difficulty WHERE Difficulty_Name = '" . $_POST["difficulty"] ."'),
                                                        (select Objective_ID from t_objective WHERE Objective_Name = '" . $_POST["objective"] ."'),
                                                    '1', CURRENT_TIMESTAMP, NULL)");          
                                    $req->execute();
                                    ?> 
                                            <tr><td style=" font-weight: bold; width: 10px;"><?php echo $donnees["Exercice_Name"];?></td>
                                                <td style=" font-weight: bold; width: 10px;"><?php echo $donnees["Exercice_Repetition"];?></td>     
                                            </tr>                     
                                    <?php
                                    }

                                    $reponse->closeCursor(); 
                                    ?>
                                    
                        </table>                 
                                                    <form onsubmit="return confirm('etes vous sur ?');" action="Programme.php?encours=test" method="post">
                                                        <button type="submit" name="creerprog" value="<?php echo $donnees["ID_Exercice"];?>" class="btn btn-primary" style="background-color:#26A64A; font-weight: bold; width:300px;">Je veux suivre ce programme</button>
                                                        <br>
                                                   </form>

<?php 
   }       
?>
                   
                        </br>
                        </br>
                        </br>




                    </div>
                </div>
            </div>
        </div>
     </div>

 <?php 
include '../Fonction/Script.php';
?>   

</body>
</html>
