<?php

session_start();
include '../Fonction/ConnexionBDD.php';

// requete pour obtenir le nombre de programmes effectuer par l'utilisateur ainsi que le nombre de difficultés différentes
$req_programme=$bdd->prepare("SELECT Distinct(History_Programme) FROM t_history WHERE ID_User = '".$_SESSION["id"]."'");
$req_difficulty=$bdd->prepare("SELECT Difficulty_Name FROM t_difficulty");
//requete pour obtenir les données poids du l'utilisateur

$req_weight = $bdd->query("SELECT `Weight_Value` as weight,YEAR(`Weight_Date`) as year, MONTH(`Weight_Date`) as month, DAY(`Weight_Date`) as day FROM `t_weight` WHERE `ID_User`='".$_SESSION["id"]."'");
//$req_weight=$req_weight->fetchAll(PDO::FETCH_ASSOC);
function statRequest($param1,$param2,$bdd)
{
    switch ($param1) {
        case 'prog':
            $constraint='History_Programme = '.$param2;
            break;
        
       case 'difficulty':
            $constraint='Difficulty_Name = "'.$param2.'"';
            break;
    }
    $requete_data=$bdd->query("SELECT `Difficulty_Name`, `Exercice_Name`, `History_Date`, `History_Repetition` ,`Exercice_Repetition`*`Difficulty_factor` as Goal
                            FROM t_history
                            INNER JOIN t_exercice
                            on ID_Exercice = Exercice_ID
                            INNER JOIN t_difficulty
                            on ID_DIfficulty = Difficulty_ID
                            where ID_User = ".$_SESSION["id"]." AND ".$constraint."");
    $res=$requete_data->fetchAll(PDO::FETCH_ASSOC);
    return $res;
}

//var_dump(statRequest('difficulty','Easy',$bdd));
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
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css">-->
    <!-- ajout de JQuery -->
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>   
    <!-- Compiled and minified JavaScript -->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>-->
    <script async src="http://code.highcharts.com/highcharts.js" onload="myInit()"></script>
    <!-- ajout de HighChart -->
    <!-- function générant le graphique poids en fonction des données de l'utilisateur -->
    <script>
    function myInit(){
        $(function() {
            $('#poids').highcharts({
                chart: {
                    type: 'spline'
                    //renderTo:'Poids'
                },
                title: {
                    text: 'Courbe de Poids'
                },
                xAxis: {
                    type: 'datetime',
                    title: {
                        text: 'Date'
                    }
                },
                yAxis: {
                    title: {
                        text: 'Poids (Kg)'
                    },
                    min: 0
                },
                tooltip: {
                    headerFormat: '<b>{series.name}</b><br>',
                    pointFormat: '{point.x:%e. %b}: {point.y:.2f} m'
                },

                plotOptions: {
                    spline: {
                        marker: {
                            enabled: true
                        }
                    }
                },

                series: [{
                    name: 'Poids',
                    data: [
                    <?php while ($donnees = $req_weight->fetch(PDO::FETCH_ASSOC)){ ?>
                        [Date.UTC(<?php echo $donnees["year"]?>, <?php echo $donnees["month"]?>, <?php echo $donnees["day"]?>), <?php echo $donnees["weight"]?>],
                    <?php } ?>
                    ]
                }]
            });
        });
    }
    </script>
</head>

<body>
    <div id="wrapper">
        <?php include 'Sidebar.php'; ?>
        <!-- creation de la div qui contiendra les graphs en fonction de l'option choisie -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                      <!-- Nav tabs -->
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#poids" aria-controls="Poids" role="tab" data-toggle="tab">Poids</a></li>
                        <li role="presentation" class="dropdown"> <a href="#" id="progDrop" class="dropdown-toggle" data-toggle="dropdown" aria-controls="progDrop-contents" aria-expanded="false">Programmes <span class="caret"></span></a> 
                            <ul class="dropdown-menu" aria-labelledby="progDrop" id="progDrop-contents">
                                <?php // incrémentation du panneau déroulant en fonction du nombre de programmes
                                    $req_programme->execute();
                                    while ($donnees = $req_programme->fetch(PDO::FETCH_ASSOC)){ ?>
                                        <li class=""><a href="#progDrop<?php echo $donnees["History_Programme"];?>" role="tab" id="progDrop<?php echo $donnees["History_Programme"];?>-tab" data-toggle="tab" aria-controls="progDrop<?php echo $donnees["History_Programme"];?>" aria-expanded="false">programme <?php echo $donnees["History_Programme"];?></a></li>
                                <?php } ?>
                            </ul> 
                        </li>
                        <li role="presentation" class="dropdown"> <a href="#" id="lvlDrop" class="dropdown-toggle" data-toggle="dropdown" aria-controls="lvlDrop-contents" aria-expanded="false">Difficulté <span class="caret"></span></a> 
                            <ul class="dropdown-menu" aria-labelledby="lvlDrop" id="lvlDrop-contents">
                                <?php // incrémentation du panneau déroulant en fonction du nombre de difficulté
                                    $req_difficulty->execute();
                                    while ($donnees = $req_difficulty->fetch(PDO::FETCH_ASSOC)){ ?>
                                    <li class=""><a href="#lvlDrop<?php echo $donnees["Difficulty_Name"];?>" role="tab" id="lvlDrop<?php echo $donnees["Difficulty_Name"];?>-tab" data-toggle="tab" aria-controls="lvlDrop<?php echo $donnees["Difficulty_Name"];?>" aria-expanded="false"><?php echo $donnees["Difficulty_Name"];?></a></li>
                                <?php } ?>
                            </ul> 
                        </li>
                      </ul>

                      <!-- Tab panels -->
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="poids" style="width:100%; height:400px;"></div>
                        <?php  // création d'une div qui contient le graphique pour chaque programme
                                    $req_programme->execute();
                                    while ($donnees = $req_programme->fetch(PDO::FETCH_ASSOC)){ ?>
                        <div role="tabpanel" class="tab-pane fade" id="progDrop<?php echo $donnees["History_Programme"];?>" aria-labelledby="progDrop<?php echo $donnees["History_Programme"];?>-tab">
                            <?php
                            var_dump(statRequest('prog',$donnees["History_Programme"],$bdd)); 
                            ?>
 
                        </div>
                        <?php } ?>
                        <?php // création d'une div qui contient le graphique pour chaque difficulté
                                    $req_difficulty->execute();
                                    while ($donnees = $req_difficulty->fetch(PDO::FETCH_ASSOC)){ ?>
                        <div role="tabpanel" class="tab-pane fade" id="lvlDrop<?php echo $donnees["Difficulty_Name"];?>" aria-labelledby="lvlDrop<?php echo $donnees["Difficulty_Name"];?>-tab">
                            <?php
                            var_dump(statRequest('difficulty',$donnees["Difficulty_Name"],$bdd)); 
                            ?>
                        </div>
                        <?php  } ?>
                      </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../Fonction/Script.php'; ?>
</body>
</html>
