<?php
session_start(); 
include 'Fonction/Connexion.php';
?>


<?php

  if(isset($_POST["Valider"])){  

$TestEmail = $bdd->prepare("SELECT * FROM Utilisateur where email = '".$_POST["email"]."'");
$TestEmail->execute();
$count = $TestEmail->rowCount();

echo $count;
if($count < 1){
        
        try
        {
                    $req = $bdd->prepare("INSERT INTO Utilisateur (email,mdp,nom,prenom,sex,adresse,ville,numero) VALUES (:email,:mdp,:nom,:prenom,:sex,:adresse,:ville,:numero)");
                    $req->execute(array(                 
                    'nom' => $_POST["nom"],
                    'prenom' => $_POST["prenom"],
                    'sex' => $_POST["sex"],
                    'adresse' => $_POST["adresse"],
                    'ville' => $_POST["ville"],
                    'numero' => $_POST["num"],
                    'email' => $_POST["email"],
                    'mdp' => sha1($_POST["mdp"])
                    ));

                    header('location:connexion.php');

        }
        catch(Exception $e)
        {
        die('Erreur : '.$e->getMessage());
        } 
}else{
    ?>
    <h2>Vous ne pouvez pas avoir deux comptes sur la même adresse mail.</h2>
    <?php
}  
}          
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
                     <h4>Inscription</h4>
                    <div class="col-lg-6">
                      
                       
                            <form action="Inscription.php"  method="post">
                            
                                <h4><small>Email</small></h4><input type="email" class="style-5" style="width:300px;" name="email" placeholder="Email" required/>
                                <br>
                                <h4><small>Mot de passe et Confirmation</small></h4><input type="password" class="style-5" style="width:300px;" name="mdp" onchange="form.pwd2.pattern = this.value;" placeholder="Mot de passe" required/>
                                <input type="password" class="style-5" style="width:300px;"  name="pwd2" placeholder="Confirmation" required/>

                                </br>
                                <h4><small>Nom</small></h4><input type="text" class="style-5" style="width:300px;" name="nom" placeholder="Nom" required/>
                                <br>
                                <h4><small>Prenom</small></h4><input type="text" class="style-5" style="width:300px;" name="prenom" placeholder="Prenom" required/>
                                <br>
                                <br>
                                  <input class="btn waves-effect waves-light" type="submit" value="Valider" name="Valider"/>
                                </div> 
                                <div class="col-lg-6">
                                    <br>

								 <p>
							     <br />
							     <input type="radio" name="sex" value="Homme" id="Homme" checked required/> <label for="Homme">Homme</label><br />
							     <input type="radio" name="sex" value="Femme" id="Femme" required/> <label for="Femme">Femme</label><br />
							     </p>
                                <br>
                                 <h4><small>Adresse</small></h4><input type="text" class="style-5"  style="width:300px;" name="adresse" placeholder="Adresse" required/>
                                    <br>
                                    <h4><small>Ville</small></h4>
                                <p>
                                <select name="ville" class="form-control" style="width:300px; ">

                                <?php
                                $reponse_ville = $bdd->query('SELECT * FROM Ville');

                                // On affiche chaque entrée une à une
                                while ($donnees_ville = $reponse_ville->fetch(PDO::FETCH_ASSOC))
                                {
                                    if ($donnees_ville["Ville_name"] == $donnees["ville"]){
                                        ?>
                                        <option selected style="color:black;" value="<?php echo $donnees_ville["Ville_name"];?>"><?php echo $donnees_ville["Ville_name"];?></option>                    
                                        <?php
                                    }else{
                                        ?>
                                        <option style="color:black;" value="<?php echo $donnees_ville["Ville_name"];?>"><?php echo $donnees_ville["Ville_name"];?></option>  
                                        <?php
                                    }
                                }
                                $reponse_ville->closeCursor();
                                ?>
                                </p>
                                </select><br />
     
                                <h4><small>Téléphone</small></h4><input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" class="style-5" style="width:300px;" name="num" placeholder="Téléphone" required/>


                                <br>


                              
                            </form>





               
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
