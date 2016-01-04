<?php
session_start();
include '../Fonction/ConnexionBDD.php';

if(isset($_POST["Valider"])){
    $email = $_POST["email"];
    $mdp = sha1($_POST["mdp"]);
        
    $requete = $bdd->query("SELECT * From t_user where User_Mail = '" . $_POST["email"] ."'");
    $row = $requete->fetch(PDO::FETCH_ASSOC);

    if ($row["User_Mail"]==$email and $row["User_Password"]==$mdp){
        $_SESSION["session"]=1;
        $_SESSION["email"]=$_POST["email"];
        $_SESSION["id"]=$row["User_ID"];

        $role = $bdd->query("SELECT ID_Role FROM t_user_role WHERE ID_User = '".$_SESSION["id"]."'");
        while ($row_role = $role->fetch(PDO::FETCH_ASSOC)){
            if($row_role["ID_Role"]==1){
              $_SESSION["admin"]=1;  
            }
        } 
        header('location:Index.php');
    }else{
?>
        <h4>Une erreur est survenu, verifier votre mot de passe.</h4>
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
                    <h4>Connexion</h4>
                    <div class="col-lg-4">   
                            <form action="Connexion.php" method="post">
                            <br>
                            <h4>Email</h4><input type="email" class="style-5" style="width:300px;" name="email" placeholder="Email" required/>
                    </div>
                    <div class="col-lg-4">
                            <br>
                            <h4>Mot de passe</h4><input type="password" class="style-5" style="width:300px;" name="mdp" placeholder="Mot de passe" required/>
                            <br>
                            <input class="btn waves-effect waves-light" type="submit" value="Connexion" name="Valider"/>
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


