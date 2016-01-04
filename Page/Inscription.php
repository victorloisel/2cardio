<?php
session_start(); 
include '../Fonction/ConnexionBDD.php';

if(isset($_POST["Valider"])){  

    $TestEmail = $bdd->prepare("SELECT * FROM t_user where User_Mail = '".$_POST["email"]."'");
    $TestEmail->execute();
    $count = $TestEmail->rowCount();

    if($count < 1){
            
        try{
            $req = $bdd->prepare("INSERT INTO t_user (User_Mail,User_Password,User_Street,ID_City,User_Phone) 
                                    VALUES (:email,:mdp,:adresse,(SELECT City_ID FROM t_city where City_Name = :ville),:gsm)");
            $req->execute(array(                 
            'adresse' => $_POST["adresse"],
            'ville' => $_POST["ville"],
            'gsm' => $_POST["gsm"],
            'email' => $_POST["email"],
            'mdp' => sha1($_POST["mdp"])
            ));

            $SelectId = $bdd->query("SELECT * FROM t_user where User_Mail = '".$_POST["email"]."'");
            $row = $SelectId->fetch(PDO::FETCH_ASSOC);

            $Role = $bdd->prepare("INSERT INTO t_user_role (ID_User,ID_Role) VALUES (:id_User, '2')");
            $Role->execute(array(                 
            'id_User' => $row["User_id"]
            ));

            header('location:Connexion.php');
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
                     <h4>Inscription</h4>
                    <div class="col-lg-6">
                            <form action="Inscription.php"  method="post">
                            
                                <h4><small>Email</small></h4>
                                <input type="email" class="style-5" style="width:300px;" name="email" placeholder="Email" required/>
                                <br>

                                <h4><small>Mot de passe et Confirmation</small></h4>
                                <input type="password" class="style-5" style="width:300px;" name="mdp" onchange="form.pwd2.pattern = this.value;" placeholder="Mot de passe" required/>
                                <input type="password" class="style-5" style="width:300px;"  name="pwd2" placeholder="Confirmation" required/>

                                <br>
                               

                                <h4><small>Adresse</small></h4>
                                <input type="text" class="style-5"  style="width:300px;" name="adresse" placeholder="Adresse" required/>
                                <br>

                                <h4><small>Ville</small></h4>
                                    <p>
                                        <select name="ville" class="form-control" style="width:300px; ">
                                        <?php
                                        $reponse_ville = $bdd->query('SELECT * FROM t_city');

                                        while ($donnees_ville = $reponse_ville->fetch(PDO::FETCH_ASSOC))
                                        {
                                        ?>
                                            <option style="color:black;" value="<?php echo $donnees_ville["City_Name"];?>"><?php echo $donnees_ville["City_Name"];?></option>  
                                        <?php
                                        }
                                        $reponse_ville->closeCursor();
                                        ?>
                                        </select>
                                    </p>
                                <br />
     
                                <h4><small>Téléphone</small></h4>
                                <input type="tel" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" class="style-5" style="width:300px;" name="gsm" placeholder="Téléphone" required/>
                                <br>
                                 <input class="btn waves-effect waves-light" type="submit" value="Valider" name="Valider"/>
                   
                                <br>
                            </form>
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