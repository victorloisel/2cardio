<?php
session_start(); 
include '../Fonction/ConnexionBDD.php';
if(!isset($_SESSION['session'])){
header('location:Connexion.php');
}
if(isset($_GET["Repondre"])){     
    try
    {
            $req = $bdd->prepare("INSERT INTO Reponse (Topic_id,User_ID,Reponse_texte) 
                                    VALUES (:Topic_id,:User_ID,:Reponse_texte)");
            $req->execute(array(                 
            'Topic_id' => $_GET['Topic'],
            'User_ID' => $_SESSION["id"],
            'Reponse_texte' => $_GET["reponse"]
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
                <?php 
                if(!isset($_GET['Topic'])){
                ?>  
                        <h2>Forum</h2>
                        <div class="col-lg-12">
                            <table class="table">
                                <tr class="active"><td>Titre</td><td>Auteur</td><td>Nombre de reponses</td></tr>
                                <?php
                                $reponse_topic = $bdd->query('SELECT Topic_id, id_User, Topic_titre, (SELECT count(Reponse_id)-1 from Reponse where Topic_id = Topic.Topic_id) as Topic_nbreponse, (select User_Mail from t_user where User_ID = Topic.id_User) as User FROM Topic');
                                
                                while ($donnees_topic = $reponse_topic->fetch(PDO::FETCH_ASSOC))
                                {
                                    if($_SESSION["id"] == $donnees_topic["id_User"]){
                                      ?>
                                    <tr>
                                        <td>
                                            <a style="color:black; font-weight: bold; text-decoration: none; padding: 1em;" href="Forum.php?Topic=<?php echo $donnees_topic["Topic_id"];?>"><?php echo $donnees_topic["Topic_titre"];?></a>
                                        </td>
                                        <td>
                                            <?php echo $donnees_topic["User"];?></td><td><?php echo $donnees_topic["Topic_nbreponse"];?>
                                        </td>
                                        <td style="border-top:none;">
                                            <form onsubmit="return confirm('Voulez-vous vraiment supprimer le topic <?php echo $donnees_topic["Topic_titre"];?> ?');"  action="../Fonction/TraitementTopic.php" method="get">
                                                <button type="submit" name="DeleteTopic" value="<?php echo $donnees_topic["Topic_id"];?>" class="btn btn-danger" style="background-color:#B20000;">X</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php  
                                    }else{
                                    ?>
                                    <tr>
                                        <td>
                                            <a style="color:black; font-weight: bold; text-decoration: none; padding: 1em;" href="Forum.php?Topic=<?php echo $donnees_topic["Topic_id"];?>"><?php echo $donnees_topic["Topic_titre"];?></a>
                                        </td>
                                        <td>
                                            <?php echo $donnees_topic["User"];?>
                                        </td>
                                        <td>
                                            <?php echo $donnees_topic["Topic_nbreponse"];?>
                                        </td>
                                    </tr>
                                    <?php
                                    }
                                }
                                $reponse_topic->closeCursor();
                                ?>
                            </table>
                            <form action="Forum.php" method="get">
                                <button type="submit" name="Creation" value="<?php echo $_SESSION["id"];?>" class="btn btn-primary" style="background-color:#26A64A; font-weight: bold;">Nouveau Topic</button>
                            </form>
                        </div>
                <?php 
                }elseif(isset($_GET['Topic'])) {

                     $titre = $bdd->query("SELECT * FROM Topic WHERE Topic_id = '".$_GET['Topic']."'");
                     $donnees = $titre->fetch(PDO::FETCH_ASSOC);
                  ?>     
                        <h4><?php echo $donnees["Topic_titre"];?></h4>
                        <div class="col-lg-12">
                            <table class="table">
                                <tr class="active"><td>Date/Auteur</td><td>Reponse</td></tr>
                                <?php
                                $reponse_topic = $bdd->query("SELECT Reponse_id, Topic_id,id_User, Reponse_texte, Reponse_date, (select User_Mail from t_user where User_ID = Reponse.id_User) as User FROM Reponse where Topic_id = '" . $_GET['Topic'] ."'");
                                
                                while ($donnees_topic = $reponse_topic->fetch(PDO::FETCH_ASSOC))
                                {
                                    if($_SESSION["id"] == $donnees_topic["id_User"]){
                                ?>
                                        <tr>
                                            <td>
                                                <?php echo $donnees_topic["Reponse_date"];?><br><?php echo $donnees_topic["User"];?>
                                            </td>
                                            <td>
                                                <?php echo $donnees_topic["Reponse_texte"];?>
                                            </td>
                                            <td style="border-top:none;">
                                            <form onsubmit="return confirm('Voulez-vous vraiment supprimer votre reponse ?');"  action="../Fonction/TraitementTopic.php" method="get">
                                                <input type="text" class="style-5" style="width:300px; display:none;"  name="Topic" value="<?php echo $donnees_topic["Topic_id"];?>"/>
                                                <button type="submit" name="DeleteReponse" value="<?php echo $donnees_topic["Reponse_id"];?>" class="btn btn-danger" style="background-color:#B20000;">X</button>
                                            </form>
                                        </td>
                                        </tr>
                                   <?php  
                                    }else{
                                    ?>
                                          <tr>
                                            <td>
                                                <?php echo $donnees_topic["Reponse_date"];?><br><?php echo $donnees_topic["User"];?>
                                            </td>
                                            <td>
                                                <?php echo $donnees_topic["Reponse_texte"];?>
                                            </td>
                                        </tr>
                                 <?php
                                    }
                                }
                                ?>
                            </table>
                           
                        </div>
                        <div class="col-lg-5">
                         <form action="Forum.php" method="get">
                                    <input type="text" rows="8" cols="50" style="display: none;" name="Topic" value="<?php echo $_GET['Topic'];?>" placeholder="Votre reponse ici."></input>
                                    <textarea rows="8" cols="50" name="reponse" style="height: 5em;" placeholder="Votre reponse ici."></textarea>
                                    <button type="submit" name="Repondre" value="<?php echo $_SESSION["id"];?>" class="btn btn-primary" style="background-color:#26A64A; font-weight: bold;">Repondre</button>
                            </form>
                        </div>    
                <?php        
                } 
                ?>      
                </div>

                 <?php 
                if(isset($_GET['Creation'])){
                ?> 
                <div class="row">
                    <div class="col-lg-12">
                            <form action="../Fonction/TraitementTopic.php"  method="get">
                            
                                <h4><small>Titre du Topic</small></h4>
                                <input type="text" class="style-5" style="width:300px;" name="Titre" placeholder="Titre" required/>
                                <br> 
                                 <textarea rows="4" cols="50" style="width:300px;" name="question" placeholder="Votre question ici."></textarea>
                                                          
                                <br>
                                <input type="submit" name="creer" value="creer mon topic" class="btn btn-primary" style="background-color:#26A64A; font-weight: bold;"/>
                            
                                <br>
                            </form>
                    </div>
                </div>
                <?php        
                } 
                ?> 
            </div>
        </div>
     </div>

 <?php 
include '../Fonction/Script.php';
?>   

</body>
</html>
