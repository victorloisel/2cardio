<?php
    session_start();
?>
<?php
if(isset($_POST["Valider"] )){

        if(mysql_connect("localhost","root","")!= FALSE){


        $email = $_POST["email"];
        $mdp = sha1($_POST["mdp"]);
        

            mysql_select_db("testphp");
   
        
        

            $requete = "SELECT * From Utilisateur where email = '" . $_POST["email"] ."'";
            $res= mysql_query($requete);
            $user= mysql_fetch_array($res);
            

            if ($user["email"]==$email and $user["mdp"]==$mdp){
                $_SESSION["session"]=1;
                $_SESSION["email"]=$_POST["email"];
                $_SESSION["id"]=$user["idUtilisateur"];
                header('location:index.php');
            }else{
                ?>
            <h4>Une erreur est survenu, verifier votre mot de passe.
        </h4>
                <?php
                echo $mdp;
            }
        
    }
    mysql_close();
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
                    <h4>Connexion</h4>
                    <div class="col-lg-4">
                     

                        
                            <form action="connexion.php" method="post">
                                <br>
                                <h4>Email</h4><input type="email" class="style-5" style="width:300px;" name="email" placeholder="Email" required/>
                                <input class="btn waves-effect waves-light" type="submit" value="Connexion" name="Valider"/>
                            </div>
                             <div class="col-lg-4">
                                <br>
                                <h4>Mot de passe</h4><input type="password" class="style-5" style="width:300px;" name="mdp" placeholder="Mot de passe" required/>
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


