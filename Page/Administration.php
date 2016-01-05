<?php

session_start();
include '../Fonction/ConnexionBDD.php';
//echo $_SESSION["id"];
//echo $_SESSION["email"];  
//echo $_SESSION["admin"];


// for ($i = 30; $i <= 100; $i++) {
//     $req = $bdd->prepare("INSERT INTO User_Role (id_User ,id_Role)VALUES ('" . $i ."',  '2')");         
//         $req->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Administration</title>
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
                        <h4>Espace administration : </h4>
                            <form action="Administration.php" method="get">
                                <button type="submit" name="creation" value="exercice" class="btn btn-primary" style="background-color:#26A64A; font-weight: bold;">Exercice</button>
                   
                                <button type="submit" name="creation" value="objective" class="btn btn-primary" style="background-color:#26A64A; font-weight: bold;">Objectif</button>
                          
                                <button type="submit" name="creation" value="difficulty" class="btn btn-primary" style="background-color:#26A64A; font-weight: bold;">Difficulté</button>
                            </form>
                   
                        </br>
                        </br>
                        </br>


                            
                            <?php    
                            if((isset($_GET["creation"]) && $_GET['creation'] == "exercice") || (isset($_GET["create"]) && $_GET['create'] == "exercice")){
                            ?>
                            <table class="table table-bordered">
                                <tr style="background-color: #26a69a; color:white; font-weight: bold;">
                                    <td>id</td>
                                    <td>Nom de l'exercice</td>
                                    <td>Nombre de repetition</td>
                                    
                                </tr>
                                <?php
                                    $reponse = $bdd->query("SELECT distinct(Exercice_ID), Exercice_Name, Exercice_Repetition
                                                            FROM t_exercice
                                                            ");
                                    while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
                                    {
                                    
                                        
                                    ?> 
                                            <tr><td style="background-color: #26a69a; color:white; font-weight: bold; width: 10px;"><?php echo $donnees["Exercice_ID"];?></td>
                                                <td><?php echo $donnees["Exercice_Name"];?></td>
                                                <td><?php echo $donnees["Exercice_Repetition"];?></td>
                                                  <td style="border:none;">
                                                    <form onsubmit="return confirm('Voulez-vous vraiment supprimer cette exercice ?');"  action="../Fonction/TraitementAdmin.php" method="get">
                                                        <input type="text" class="style-5" style="width:300px; display:none;"  name="Topic" value="<?php echo $donnees["Exercice_ID"];?>"/>
                                                        <button type="submit" name="DeleteExo" value="<?php echo $donnees["Exercice_ID"];?>" class="btn btn-danger" style="background-color:#B20000;">X</button>
                                                    </form>
                                                </td>

                                               
                                            </tr>                     
                                    <?php

                                    }
                                    $reponse->closeCursor(); 
                                    ?>
                                    <tr>
                                        <td>
                                            <form action="Administration.php?creation=exercice" method="get">
                                                <button type="submit" name="create" value="exercice" class="btn btn-primary" style="background-color:#26A64A; font-weight: bold;">Ajouter</button>
                                            </form>
                                        </td>
                                    </tr>
                        </table>
                        <?php
                         if(isset($_GET["create"]) && $_GET['create'] == "exercice"){
                        ?> 
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="../Fonction/TraitementAdmin.php"  method="get">
                                
                                    <h4><small>Votre exercice</small></h4>
                                    <input type="text" class="style-5" style="width:300px;" name="nom" placeholder="Nom" required/>
                                                       
                                    <br>
                                    <input type="text" class="style-5" style="width:300px;" name="repetition" placeholder="Nombre de repetition" required/>
                                                       
                                    <br>
                                    <label>Difficulté possible :</label>
                                    <?php
                                        $reponse_dif = $bdd->query('SELECT * FROM t_difficulty');

                                        while ($donnees = $reponse_dif->fetch(PDO::FETCH_ASSOC))
                                        {
                                        ?>



              

                                     <p>
                                    
                                        <input name=<?php echo "boxdif" . $donnees["Difficulty_ID"];?> value=<?php echo $donnees["Difficulty_ID"];?> type="checkbox" id=<?php echo $donnees["Difficulty_Name"];?>>
                                        <label for=<?php echo $donnees["Difficulty_Name"];?>><?php echo $donnees["Difficulty_Name"];?></label>
                                     
                                      </p>

                                    <?php
                                        }
                                        $reponse_dif->closeCursor();
                                        ?>              
                                    <br>
                                      <label>Objectif possible :</label>
                                    <?php
                                        $reponse_obj = $bdd->query('SELECT * FROM t_objective');

                                        while ($donnees = $reponse_obj->fetch(PDO::FETCH_ASSOC))
                                        {
                                        ?>
                                    <p>
                                       <input name=<?php echo "boxobj" . $donnees["Objective_ID"];?> value=<?php echo $donnees["Objective_ID"];?> type="checkbox" id=<?php echo $donnees["Objective_Name"];?>>
                                        <label for=<?php echo $donnees["Objective_Name"];?>><?php echo $donnees["Objective_Name"];?></label>
                                          
                                         
                                      </p>

                                    <?php
                                        }
                                        $reponse_obj->closeCursor();
                                        ?>              
                                    <br>

                                    <input type="submit" name="creaExo" value="creer mon exercice" class="btn btn-primary" style="background-color:#26A64A; font-weight: bold;"/>
                                
                                    <br>
                                </form>
                            </div>
                        </div>
                        <?php        
                        } 
                    }
                ?>
                          



                            <?php
                            if((isset($_GET["creation"]) && $_GET['creation'] == "objective") || (isset($_GET["create"]) && $_GET['create'] == "objective")){
                            ?>
                            <table class="table table-bordered">
                                <tr style="background-color: #26a69a; color:white; font-weight: bold;">
                                    <td>id</td>
                                    <td>Nom de l'objectif</td>
                                    <td>Facteur multiplicateur</td>
                                    
                                </tr>
                                <?php
                                    $reponse = $bdd->query("SELECT distinct(Objective_ID), Objective_Name, Objective_Factor
                                                            FROM t_objective
                                                            ");
                                    while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
                                    {
                                    
                                        
                                    ?> 
                                            <tr><td style="background-color: #26a69a; color:white; font-weight: bold; width: 10px;"><?php echo $donnees["Objective_ID"];?></td>
                                                <td><?php echo $donnees["Objective_Name"];?></td>
                                                <td><?php echo $donnees["Objective_Factor"];?></td>
                                                  <td style="border:none;">
                                            <form onsubmit="return confirm('Voulez-vous vraiment supprimer cette objectif ?');"  action="../Fonction/TraitementAdmin.php" method="get">
                                                <input type="text" class="style-5" style="width:300px; display:none;"  name="Topic" value="<?php echo $donnees["Objective_ID"];?>"/>
                                                <button type="submit" name="DeleteObj" value="<?php echo $donnees["Objective_ID"];?>" class="btn btn-danger" style="background-color:#B20000;">X</button>
                                            </form>
                                        </td>

                                               
                                            </tr>                     
                                    <?php

                                    }
                                    $reponse->closeCursor(); 
                                    ?>
                                    <tr>
                                        <td>
                                            <form action="Administration.php?creation=objective" method="get">
                                                <button type="submit" name="create" value="objective" class="btn btn-primary" style="background-color:#26A64A; font-weight: bold;">Ajouter</button>
                                            </form>
                                        </td>
                                    </tr>
                        </table>
                        <?php
                         if(isset($_GET["create"]) && $_GET['create'] == "objective"){
                        ?> 
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="../Fonction/TraitementAdmin.php"  method="get">
                                
                                    <h4><small>Votre objectif</small></h4>
                                    <input type="text" class="style-5" style="width:300px;" name="nom" placeholder="Nom" required/>
                                                       
                                    <br>
                                    <input type="text" class="style-5" style="width:300px;" name="factor" placeholder="Facteur multiplicateur" required/>
                                                       
                                    <br>
                                    <input type="submit" name="creaObj" value="creer mon objectif" class="btn btn-primary" style="background-color:#26A64A; font-weight: bold;"/>
                                
                                    <br>
                                </form>
                            </div>
                        </div>
                        <?php        
                        } 
                    }
                ?>





                       <?php
                            if((isset($_GET["creation"]) && $_GET['creation'] == "difficulty") || (isset($_GET["create"]) && $_GET['create'] == "difficulty")){
                            ?>
                            <table class="table table-bordered">
                                <tr style="background-color: #26a69a; color:white; font-weight: bold;">
                                    <td>id</td>
                                    <td>Nom de la difficultée</td>
                                    <td>Facteur multiplicateur</td>
                                    
                                </tr>
                                <?php
                                    $reponse = $bdd->query("SELECT distinct(Difficulty_ID), Difficulty_Name, Difficulty_Factor
                                                            FROM t_difficulty
                                                            ");
                                    while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
                                    {
                                    
                                        
                                    ?> 
                                            <tr><td style="background-color: #26a69a; color:white; font-weight: bold; width: 10px;"><?php echo $donnees["Difficulty_ID"];?></td>
                                                <td><?php echo $donnees["Difficulty_Name"];?></td>
                                                <td><?php echo $donnees["Difficulty_Factor"];?></td>
                                                  <td style="border:none;">
                                            <form onsubmit="return confirm('Voulez-vous vraiment supprimer cette diffcultée ?');"  action="../Fonction/TraitementAdmin.php" method="get">
                                                <input type="text" class="style-5" style="width:300px; display:none;"  name="Topic" value="<?php echo $donnees["Difficulty_ID"];?>"/>
                                                <button type="submit" name="DeleteDif" value="<?php echo $donnees["Difficulty_ID"];?>" class="btn btn-danger" style="background-color:#B20000;">X</button>
                                            </form>
                                        </td>

                                               
                                            </tr>                     
                                    <?php

                                    }
                                    $reponse->closeCursor(); 
                                    ?>
                                    <tr>
                                        <td>
                                            <form action="Administration.php?creation=objective" method="get">
                                                <button type="submit" name="create" value="difficulty" class="btn btn-primary" style="background-color:#26A64A; font-weight: bold;">Ajouter</button>
                                            </form>
                                        </td>
                                    </tr>
                        </table>
                        <?php
                         if(isset($_GET["create"]) && $_GET['create'] == "difficulty"){
                        ?> 
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="../Fonction/TraitementAdmin.php"  method="get">
                                
                                    <h4><small>Votre difficultée</small></h4>
                                    <input type="text" class="style-5" style="width:300px;" name="nom" placeholder="Nom" required/>
                                                       
                                    <br>
                                    <input type="text" class="style-5" style="width:300px;" name="factor" placeholder="Facteur multiplicateur" required/>
                                                       
                                    <br>
                                    <input type="submit" name="creaObj" value="creer ma difficultée" class="btn btn-primary" style="background-color:#26A64A; font-weight: bold;"/>
                                
                                    <br>
                                </form>
                            </div>
                        </div>
                        <?php        
                        } 
                    }
                ?>


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
