<?php

session_start();
include '../Fonction/ConnexionBDD.php';
//echo $_SESSION["id"];
//echo $_SESSION["email"];  
//echo $_SESSION["admin"];


// for ($i = 30; $i <= 100; $i++) {
//     $req = $bdd->prepare("INSERT INTO User_Role (id_User ,id_Role)VALUES ('" . $i ."',  '2')");         
//         $req->execute();


// requete pour obtenir le nombre de programmes effectuer par l'utilisateur ainsi que le nombre de difficultés différentes
$requete_programme=$bdd->query("SELECT Distinct(History_Programme) FROM t_history WHERE ID_User = '".$_SESSION["id"]."'");
$req_programme=$bdd->query("SELECT Distinct(History_Programme) FROM t_history WHERE ID_User = '".$_SESSION["id"]."'");
$requete_difficulty=$bdd->query("SELECT Difficulty_Name FROM t_difficulty");
$req_difficulty=$bdd->query("SELECT Difficulty_Name FROM t_difficulty");
$requete_data=$bdd->query("SELECT `Difficulty_Name`, `Exercice_Name`, `History_Date`, `History_Repetition` ,`Exercice_Repetition`
                            FROM t_history
                            INNER JOIN t_exercice
                            on ID_Exercice = Exercice_ID
                            INNER JOIN t_difficulty
                            on ID_DIfficulty = Difficulty_ID
                            where ID_User = '".$_SESSION["id"]."'");
$res=$requete_data->fetchAll(PDO::FETCH_ASSOC);
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
<!-- creation de la div qui contiendra les graphs en fonction de l'option choisie -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#Poids" aria-controls="Poids" role="tab" data-toggle="tab">Poids</a></li>
                        <li role="presentation" class="dropdown"> <a href="#" id="progDrop" class="dropdown-toggle" data-toggle="dropdown" aria-controls="progDrop-contents" aria-expanded="false">Programmes <span class="caret"></span></a> 
                            <ul class="dropdown-menu" aria-labelledby="progDrop" id="progDrop-contents">
                                <?php // incrémentation du panneau déroulant en fonction du nombre de programmes
                                    $counter_programme=1;
                                    while ($donnees = $requete_programme->fetch(PDO::FETCH_ASSOC)){ ?>
                                        <li class=""><a href="#progDrop<?php echo $counter_programme;?>" role="tab" id="progDrop<?php echo $counter_programme;?>-tab" data-toggle="tab" aria-controls="progDrop<?php echo $counter_programme;?>" aria-expanded="false">programme <?php echo $donnees["History_Programme"];?></a></li>
                                <?php $counter_programme++; } ?>
                            </ul> 
                        </li>
                        <li role="presentation" class="dropdown"> <a href="#" id="lvlDrop" class="dropdown-toggle" data-toggle="dropdown" aria-controls="lvlDrop-contents" aria-expanded="false">Difficulté <span class="caret"></span></a> 
                            <ul class="dropdown-menu" aria-labelledby="lvlDrop" id="lvlDrop-contents">
                                <?php // incrémentation du panneau déroulant en fonction du nombre de difficulté
                                    $counter_difficulty=1;
                                    while ($donnees = $requete_difficulty->fetch(PDO::FETCH_ASSOC)){ ?>
                                    <li class=""><a href="#lvlDrop<?php echo $counter_difficulty;?>" role="tab" id="lvlDrop<?php echo $counter_difficulty;?>-tab" data-toggle="tab" aria-controls="lvlDrop<?php echo $counter_difficulty;?>" aria-expanded="false"><?php echo $donnees["Difficulty_Name"];?></a></li>
                                <?php $counter_difficulty++;} ?>
                            </ul> 
                        </li>
                      </ul>

                      <!-- Tab panels -->
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="Poids">test</div>
                        <?php  // création d'une div qui contient le graphique pour chaque programme
                                    $counter_programme=1;
                                    while ($donnees = $req_programme->fetch(PDO::FETCH_ASSOC)){ ?>
                        <div role="tabpanel" class="tab-pane fade" id="progDrop<?php echo $counter_programme;?>" aria-labelledby="progDrop<?php echo $counter_programme;?>-tab">
                                <table border="1">
                                <tr>
                                    <?php 
                                    foreach($res[0] as $key => $value){
                                    ?>
                                    <td><?php echo $key; ?></td>
                                    <?php   
                                    }
                                    ?>
                                </tr>
                                <?php 
                                foreach($res as $key_user => $row_user){
                                ?>
                                <tr> 
                                    <?php 
                                    foreach($res[$key_user] as $row_data){
                                    ?>
                                        <td><?php echo $row_data ?></td>
                                    <?php 
                                    }
                                }
                                ?>
                                </table>
                        </div>
                        <?php $counter_programme++;} ?>
                        <?php // création d'une div qui contient le graphique pour chaque difficulté
                                    $counter_difficulty=1;
                                    while ($donnees = $req_difficulty->fetch(PDO::FETCH_ASSOC)){ ?>
                        <div role="tabpanel" class="tab-pane fade" id="lvlDrop<?php echo $counter_difficulty;?>" aria-labelledby="lvlDrop<?php echo $counter_difficulty;?>-tab">graph <?php echo $counter_difficulty ?></div>
                        <?php $counter_difficulty++; } ?>
                      </div>

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

