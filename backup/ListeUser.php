 <?php 
        include 'Fonction/Connexion.php';
        ?>
<?php


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
 <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">

  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css">
 -->
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
                    <h2>Liste des Utilisateurs</h2>
                    <div class="col-lg-12">

<table class="table table-bordered">
<tr style="background-color: #26a69a; color:white; font-weight: bold;"><td>Id</td><td>Email</td><td>Nom</td><td>Prenom</td><td>Adresse</td><td>Ville</td><td>Téléphone</td><td>H/F</td><td>Suppr</td></tr>
<?php

$reponse = $bdd->query("SELECT * FROM Utilisateur ");

while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
{
?>
    <tr><td style="background-color: #26a69a; color:white; font-weight: bold;"><?php echo $donnees["idUtilisateur"];?></td><td><?php echo $donnees["email"];?></td><td><?php echo $donnees["nom"];?></td><td><?php echo $donnees["prenom"];?></td><td><?php echo $donnees["adresse"];?></td><td><?php echo $donnees["ville"];?></td><td><?php echo $donnees["numero"];?></td><td><?php echo $donnees["sex"];?></td><td><form onsubmit="return confirm('Voulez-vous vraiment supprimer <?php echo $donnees["prenom"];?> <?php echo $donnees["nom"];?>');" action="Delete.php" method="post"><button type="submit" name="Delete" value="<?php echo $donnees["idUtilisateur"];?>" class="btn btn-danger">X</button></form></td></tr>                     
<?php
}

$reponse->closeCursor(); 
?>
</table>
    
                </div>
                </div>
            </div>
        </div>
     </div>

 <?php 
include 'Script.php';
?>   

</body>
</html>
