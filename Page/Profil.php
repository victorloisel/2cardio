<?php
session_start(); 
include '../Fonction/ConnexionBDD.php';
if(!isset($_SESSION['session'])){
header('location:Connexion.php');
}

if(isset($_POST["Valider"])){     
    try
    {
        $req = $bdd->prepare("UPDATE t_user 
                                SET User_Mail = :email, User_Street = :adresse, 
                                ID_City = (SELECT City_ID FROM city where City_Name = :ville), User_Phone = :gsm where User_ID = :id");
        $req->execute(array(                 
        'adresse' => $_POST["adresse"],
        'ville' => $_POST["ville"],
        'gsm' => $_POST["gsm"],
        'email' => $_POST["email"],
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
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/simple-sidebar.css" rel="stylesheet">
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

$reponse = $bdd->query("SELECT * FROM t_user where User_ID = '".$_SESSION["id"]."'");

while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
{
?>
                            <form action="Profil.php" method="post">
                                <br>
                                <h4><small>Email</small></h4><input type="email" class="style-5" style="width:300px;" value="<?php echo $donnees["User_Mail"];?>" name="email" placeholder="Email" required/>
                                
                                <br>

                                <h4><small>Adresse</small></h4><input type="text" class="style-5" style="width:300px;" name="adresse" value="<?php echo $donnees["User_Street"];?>" placeholder="Nouvelle adresse" required/>
                                <br>
                                <h4><small>Ville</small></h4>
                                <p>
                                <select name="ville" class="form-control" style="width:300px; ">

                                <?php
                                $reponse_ville = $bdd->query('SELECT * FROM t_city');

                                // On affiche chaque entrée une à une
                                while ($donnees_ville = $reponse_ville->fetch(PDO::FETCH_ASSOC))
                                {
                                    if ($donnees_ville["City_ID"] == $donnees["ID_City"]){
                                        ?>
                                        <option selected style="color:black;" value="<?php echo $donnees_ville["City_Name"];?>"><?php echo $donnees_ville["City_Name"];?></option>                    
                                        <?php
                                    }else{
                                        ?>
                                        <option style="color:black;" value="<?php echo $donnees_ville["City_Name"];?>"><?php echo $donnees_ville["City_Name"];?></option>  
                                        <?php
                                    }
                                }
                                $reponse_ville->closeCursor();
                                ?>
                                </p>
                                </select><br />
     
                               

                                <h4><small>Téléphone</small></h4><input type="text" class="style-5" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" style="width:300px; color:black;" name="gsm" value="<?php echo $donnees["User_Phone"];?>" placeholder="Téléphone" required/>


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
include '../Fonction/Script.php';
?>   

</body>
</html>
