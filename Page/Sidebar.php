      
<style>
a:active { color: white }
a:link { color: white } /* Liens non visités */
a:visited { color: white } /* Liens visités */
a:hover { color: white }
</style>




        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
            
                <li>
                    <a href="Index.php">Accueil</a>
                </li>
                    <?php
                    if(isset($_SESSION['session'])){
                    ?>
                    <li>
                       
                    </li>
                    <li>
                        <a href="Forum.php">Forum</a>
                    </li>
                    <li>
                        <a href="Profil.php">Votre Profil</a>
                    </li>
                    <li>
                        <a href="Stat.php">Statistiques</a>
                    </li>
                    <li>
                        <a href="ListeUser.php">Liste des utilisateurs</a>
                    </li>
                   
                    <?php
                        if(isset($_SESSION['admin'])){
                    ?>
                    <li>
                    <a href="#">Administration</a>
                    </li>
                    <?php
                        }
                        ?>
                    <li>
                    <a href="../Fonction/Deconnexion.php">Deconnexion</a>
                    </li>
                    <?php
                    }else{
                    ?>
                    <li>
                        <a href="Inscription.php">Inscription</a>
                    </li>
                    <li>
                        <a href="Connexion.php">Connexion</a>
                    </li>
                       <?php
                    }
                    ?>
            </ul>
        </div>
<a href="#menu-toggle" class="btntest" id="menu-toggle" style="font-weight:20px; font-size:30px; font-color:white; border-bottom:2px white solid; border-right:7px white solid; text-decoration:none; box-shadow: 2px 2px 12px 2.5px #656565; border-bottom-right-radius: 50px;">Menu</a>

<?php
    if(isset($_SESSION['session'])){
?>
 <a href="#" style="font-weight:20px; font-size:25px; color:#26a69a; text-decoration:none; margin-left:22em;">Bonjour, <?php echo $_SESSION['email'];?></a>
<?php
    }
?>