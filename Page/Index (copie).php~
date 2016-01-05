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
                        <?php
                        if(isset($_SESSION['session'])){
                            $user = $bdd->query("SELECT User_Mail FROM t_user WHERE User_ID = '".$_SESSION["id"]."'");
                            while ($row = $user->fetch(PDO::FETCH_ASSOC))
                            {                             
                        ?>
                                <h3>Bienvenue sur notre site Internet, <?php echo $row["User_Mail"];?> !</h3>
                        <?php
                            }
                            }else{
                        ?>
                                <h3>Bienvenue sur notre site, <a href="Connexion.php" style="text-decoration:none; color:#26a69a;">Connectez vous !</a></h3>
                        <?php  
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
