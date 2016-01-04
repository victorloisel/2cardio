 <?php 
include 'Fonction/Connexion.php';
 session_start();
if(isset($_POST["Valider"])){       
        try
        {
                    $req = $bdd->prepare("UPDATE Utilisateur SET email = :EmailModif, nom = :NomModif, prenom = :PrenomModif, sex = :SexModif, adresse = :AdresseModif, ville = :VilleModif, numero = :NumModif where idUtilisateur = :id");
                    $req->execute(array(                 
                    'NomModif' => $_POST["nom"],
                    'PrenomModif' => $_POST["prenom"],
                    'SexModif' => $_POST["sex"],
                    'AdresseModif' => $_POST["adresse"],
                    'VilleModif' => $_POST["ville"],
                    'NumModif' => $_POST["num"],
                    'EmailModif' => $_POST["email"],
                    'id' => $_SESSION["id"]
                    ));
        }
        catch(Exception $e)
        {
        die('Erreur : '.$e->getMessage());
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
                    <h2>Profil</h2>
                    <div class="col-lg-6">

<?php

$reponse = $bdd->query("SELECT * FROM Utilisateur where idUtilisateur = '".$_SESSION["id"]."'");

while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
{
?>
                            <form action="Profil.php" method="post">
                                <br>
                                <h4><small>Email</small></h4><input type="email" class="style-5" style="width:300px;" value="<?php echo $donnees["email"];?>" name="email" placeholder="Email" required/>
                                <br>
                              
                                <h4><small>Nom</small></h4><input type="text" class="style-5" style="width:300px;" value="<?php echo $donnees["nom"];?>" name="nom" placeholder="Nom" required/>
                                <br>
                                <h4><small>Prenom</small></h4><input type="text" class="style-5" style="width:300px;" value="<?php echo $donnees["prenom"];?>" name="prenom" placeholder="Prenom" required/>
                                <br> 
								<p>
							   
							    <input type="radio" name="sex" value="Homme" id="Homme" checked/> <label style="color:black;" for="Homme">Homme</label><br />
							    <input type="radio" name="sex" value="Femme" id="Femme" /> <label style="color:black;" for="Femme">Femme</label><br />
							    </p>
                                <br>
                                
                </div>
                <div class="col-lg-6">
                                <h4><small>Adresse</small></h4><input type="text" class="style-5" style="width:300px;" name="adresse" value="<?php echo $donnees["adresse"];?>" placeholder="Nouvelle adresse" required/>
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
     
                               

                                <h4><small>Téléphone</small></h4><input type="text" class="style-5" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" style="width:300px; color:black;" name="num" value="<?php echo $donnees["numero"];?>" placeholder="Téléphone" required/>


                                <br>
                                <br>
                                <br>
                                <br>
                                <input class="btn waves-effect waves-light" type="submit" value="Modifier mes infos" name="Valider"/>

                            </form>
<?php
}

$reponse->closeCursor(); 
?>
    
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
