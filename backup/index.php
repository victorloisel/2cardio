<?php
    session_start();
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
                    <div class="col-lg-12">
                        <?php
                if(isset($_SESSION['session'])){
      

   if(mysql_connect("localhost","root","")!= FALSE){
            mysql_select_db("testphp");
   

                        $result = mysql_query("SELECT nom, prenom FROM Utilisateur WHERE idUtilisateur = '".$_SESSION["id"]."'");

while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
?>
                                <h3>Bienvenue sur notre site Internet, <?php echo $row["prenom"]." ".$row["nom"];?> !</h3>

                        <?php
                        }
                        mysql_close();
                        }  
                            }else{
                            ?>
                                <h3>Bienvenue sur notre site, <a href="connexion.php" style="text-decoration:none;">Connectez vous !</a></h3>
                            <?php  
                            }
                            
                            if(isset($_GET["Page"])){
                                 include 'Page'.$_GET["Page"].'.php';
                       }

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
