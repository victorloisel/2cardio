<?php
session_start(); 
include '../Fonction/ConnexionBDD.php';
if(!isset($_SESSION['session'])){
header('location:Connexion.php');
}

if(isset($_POST["ValiderModif"])){     
    try
    {
        $req = $bdd->prepare("UPDATE t_user, t_user_role 
                                SET User_Mail = :email, User_Street = :adresse,
                                ID_City = (SELECT City_ID FROM city where City_Name = :ville), User_Phone = :gsm, ID_Role = :role where User_ID = :id and ID_User = User_ID");
        $req->execute(array(                 
        'adresse' => $_POST["adresse"],
        'ville' => $_POST["ville"],
        'gsm' => $_POST["gsm"],
        'email' => $_POST["email"],
        'role' => $_POST["role"],
        'id' => $_POST["ValiderModif"]
        ));
    }
    catch(Exception $e)
    {
    die('Erreur : '.$e->getMessage());
    }       
}
if(isset($_POST["CSV"])){     
    include '../Fonction/CSV.php';
    try
    {
        $fichier = new FichierExcel();


        $reponse = $bdd->query("SELECT distinct(User_ID), User_Mail, User_Street, User_Phone, City_Name, ID_Role, Role_Name
                                FROM t_user 
                                inner join t_user_role on User_ID = ID_User 
                                inner join t_role on Role_ID = ID_Role
                                inner join t_city on ID_City = City_ID");
        
        $fichier->Colonne("Id;Email;Adresse;Téléphone;Ville;Role;Etat");
        while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
        {
            $fichier->Insertion("'" . $donnees["User_ID"] ."';'" . $donnees["User_Mail"] ."';'" . $donnees["User_Street"] ."';'" . $donnees["User_Phone"] ."';'" . $donnees["City_Name"] ."';'" . $donnees["Role_Name"] ."'");
            $fichier->output('ListeUtilisateurs');
        }
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
                    <h2>Liste des Utilisateurs</h2>
                    <div class="col-lg-12">
                        <table class="table table-bordered">
                            <?php
                            if(!isset($_SESSION['admin'])){
                            ?>
                                <tr style="background-color: #26a69a; color:white; font-weight: bold;">
                                    <td>Id</td>
                                    <td>Role</td>
                                    <td>Email</td>
                                    <td>Adresse</td>
                                    <td>Ville</td>
                                    <td>Téléphone</td>
                                </tr>
                                <?php
                                    $reponse = $bdd->query("SELECT distinct(User_ID), User_Mail, User_Street, User_Phone, City_Name, ID_Role, Role_Name
                                                            FROM t_user 
                                                            inner join t_user_role on User_ID = ID_User 
                                                            inner join t_role on Role_ID = ID_Role
                                                            inner join t_city on ID_City = City_ID");
                                    while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
                                    {
                                    
                                        if($donnees["User_ID"] == $_SESSION["id"]){
                                    ?>
                                            <tr><td style="background-color: #26a69a; color:white; font-weight: bold;"><?php echo $donnees["User_ID"];?></td>
                                                <td><?php echo $donnees["Role_Name"];?></td>
                                                <td><?php echo $donnees["User_Mail"];?></td>
                                                <td><?php echo $donnees["User_Street"];?></td>
                                                <td><?php echo $donnees["City_Name"];?></td>
                                                <td><?php echo $donnees["User_Phone"];?></td>
                                            </tr>                     
                                    <?php 
                                        }else{
                                    ?> 
                                            <tr><td style="background-color: #26a69a; color:white; font-weight: bold;"><?php echo $donnees["User_ID"];?></td>
                                                <td><?php echo $donnees["Role_Name"];?></td>
                                                <td><?php echo $donnees["User_Mail"];?></td>
                                                <td><?php echo $donnees["User_Street"];?></td>
                                                <td><?php echo $donnees["City_Name"];?></td>
                                                <td><?php echo $donnees["User_Phone"];?></td>
                                            </tr>                     
                                    <?php
                                        }

                                         
                                    }
                                    $reponse->closeCursor(); 
                            }elseif(isset($_SESSION['admin'])){
                                if(isset($_POST["Modif"])){
                                    ?>
                                    <tr style="background-color: #26a69a; color:white; font-weight: bold;">
                                        <td>Id</td>
                                        <td>Role</td>
                                        <td>Email</td>
                                        <td>Adresse</td>
                                        <td>Ville</td>
                                        <td>Téléphone</td>
                                        <td>Valider</td>
                                    </tr>
                                    <?php
                                    $reponse = $bdd->query("SELECT distinct(User_ID), User_Mail, User_Street, User_Phone, ID_City, City_Name, ID_Role, Role_Name
                                                            FROM t_user 
                                                            inner join t_user_role on User_ID = ID_User 
                                                            inner join t_role on Role_ID = ID_Role
                                                            inner join t_city on ID_City = City_ID
                                                            ");
                                    while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
                                    {
                                        if($_POST["Modif"] == $donnees["User_ID"]){
                                    ?>

                                        <form action="ListeUser.php" method="post">
                                            <tr>
                                                <td style="background-color: #26a69a; color:white; font-weight: bold; vertical-align:middle;"><?php echo $donnees["User_ID"];?></td>
                                                <td style="vertical-align:middle;">
                                                    <p>
                                                    <select name="role" class="form-control" >

                                                    <?php
                                                    $reponse_Role = $bdd->query('SELECT * FROM t_role');

                                                    // On affiche chaque entrée une à une
                                                    while ($donnees_Role = $reponse_Role->fetch(PDO::FETCH_ASSOC))
                                                    {
                                                        if ($donnees_Role["Role_ID"] == $donnees["ID_Role"]){
                                                    ?>
                                                            <option selected style="color:black;" value="<?php echo $donnees_Role["Role_ID"];?>"><?php echo $donnees_Role["Role_Name"];?></option>                    
                                                    <?php
                                                        }else{
                                                    ?>
                                                            <option style="color:black;" value="<?php echo $donnees_Role["Role_ID"];?>"><?php echo $donnees_Role["Role_Name"];?></option>  
                                                    <?php
                                                        }
                                                    }
                                                    $reponse_Role->closeCursor();
                                                    ?>
                                                    </select>
                                                    </p>
                                                </td>
                                                <td><input type="email" class="style-5"  value="<?php echo $donnees["User_Mail"];?>" name="email" placeholder="Email" required/></td>
                                                <td><input type="text" class="style-5"  name="adresse" value="<?php echo $donnees["User_Street"];?>" placeholder="Nouvelle adresse" required/></td>
                                                <td style="vertical-align: middle;">
                                                    <p>
                                                    <select name="ville" class="form-control" >

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
                                                    </select>
                                                    </p>
                                                </td>
                                                <td><input type="text" class="style-5" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" name="gsm" value="<?php echo $donnees["User_Phone"];?>" placeholder="Téléphone" required/></td>
                                                <td><button type="submit" name="ValiderModif" value="<?php echo $donnees["User_ID"];?>" class="btn btn-success" style="background-color:#26A64A;">Valider</button></td>
                                            </tr>
                                        </form>                     
                                    <?php
                                        }else{
                                            ?>
                                            <tr><td style="background-color: #26a69a; color:white; font-weight: bold;"><?php echo $donnees["User_ID"];?></td><td><?php echo $donnees["Role_Name"];?></td><td><?php echo $donnees["User_Mail"];?></td><td><?php echo $donnees["User_Street"];?></td><td><?php echo $donnees["City_Name"];?></td><td><?php echo $donnees["User_Phone"];?></td></tr>                     
                                            <?php
                                        }
                                    }
                                    $reponse->closeCursor();  
                                }else{
                            ?>
                                <tr style="background-color: #26a69a; color:white; font-weight: bold;">
                                    <td>Id</td>
                                    <td>Role</td>
                                    <td>Email</td>
                                    <td>Adresse</td>
                                    <td>Ville</td>
                                    <td>Téléphone</td>
                                    <td>Suppr</td>
                                    <td>Modif</td>
                                </tr>
                                <?php
                                    $reponse = $bdd->query("SELECT distinct(User_ID), User_Mail, User_Street, User_Phone, City_Name, ID_Role, Role_Name
                                                            FROM t_user 
                                                            inner join t_user_role on User_ID = ID_User 
                                                            inner join t_role on Role_ID = ID_Role
                                                            inner join t_city on ID_City = City_ID");
                                    while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
                                    {
                                    
                                        if($donnees["User_ID"] == $_SESSION["id"]){
                                    ?>
                                            <tr>
                                                <td style="background-color: #26a69a; color:white; font-weight: bold;"><?php echo $donnees["User_ID"];?></td>
                                                <td><?php echo $donnees["Role_Name"];?></td>
                                                <td><?php echo $donnees["User_Mail"];?></td>
                                                <td><?php echo $donnees["User_Street"];?></td>
                                                <td><?php echo $donnees["City_Name"];?></td>
                                                <td><?php echo $donnees["User_Phone"];?></td>
                                                <td>
                                                    <form onsubmit="return confirm('Voulez-vous vraiment supprimer <?php echo $donnees["User_Mail"];?>');"  action="../Fonction/Delete.php" method="post">
                                                        <button type="submit" disabled name="Delete" value="<?php echo $donnees["User_ID"];?>" class="btn btn-danger" style="background-color:#B20000;">X</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="ListeUser.php" method="post">
                                                        <button type="submit" name="Modif" value="<?php echo $donnees["User_ID"];?>" class="btn btn-primary" style="background-color:#26A64A; font-weight: bold;">Modifier</button>
                                                    </form>
                                                </td>
                                            </tr>                     
                                    <?php 
                                        }else{
                                    ?> 
                                            <tr>
                                                <td style="background-color: #26a69a; color:white; font-weight: bold;"><?php echo $donnees["User_ID"];?></td>
                                                <td><?php echo $donnees["Role_Name"];?></td>
                                                <td><?php echo $donnees["User_Mail"];?></td>
                                                <td><?php echo $donnees["User_Street"];?></td>
                                                <td><?php echo $donnees["City_Name"];?></td>
                                                <td><?php echo $donnees["User_Phone"];?></td>
                                                <td>
                                                    <form onsubmit="return confirm('Voulez-vous vraiment supprimer <?php echo $donnees["User_Mail"];?>');" action="../Fonction/Delete.php" method="post">
                                                        <button type="submit" name="Delete" value="<?php echo $donnees["User_ID"];?>" class="btn btn-danger" style="background-color:#B20000;">X</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="ListeUser.php" method="post"><button type="submit" name="Modif" value="<?php echo $donnees["User_ID"];?>" class="btn btn-primary" style="background-color:#26A64A; font-weight: bold;">Modifier</button>
                                                    </form>
                                                </td>
                                            </tr>                     
                                    <?php
                                        }

                                         
                                    }
                                    $reponse->closeCursor();
                                }
                            }
                            ?>

                               

                        
                          
                        </table>
                        <form action="ListeUser.php" method="post"><button type="submit" name="CSV" class="btn btn-primary" style="background-color:#26A64A; font-weight: bold;">Exporter la liste</button>
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
