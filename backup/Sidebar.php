<?php
    session_start();
?>        
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Menu
                    </a>
                </li>
                <li>
                    <a href="index.php">Accueil</a>
                </li>
               <!--  <li>
                    <a href="Page.php">Page</a>
                </li> -->
               <!--   <li>
                    <a href="tp2.php">Tp 2</a>
                </li> 
                 <li>
                    <a href="index.php?Page=1">Page 1</a>
                </li>
                 <li>
                    <a href="index.php?Page=2">Page 2</a>
                </li>
                 <li>
                    <a href="index.php?Page=3">Page 3</a>
                </li> -->
                 
                 
                <?php
                    if(isset($_SESSION['session'])){
      
                        ?>
                         
                         <li>
                                 <a href="deconnexion.php">Deconnexion</a>
                         </li>
                         <li>
                                <a href="Profil.php">Votre Profil</a>
                        </li>
                         <li>
                                <a href="ListeUser.php">Liste des utilisateurs</a>
                        </li>
                        <?php  
                            }else{
                                ?>
                                <li>
                             <a href="Inscription.php">Inscription</a>
                          </li>
                            <li>
                                 <a href="connexion.php">Connexion</a>
                             </li>

                        <?php

                            }  
                        ?>
               
            </ul>
        </div>

        <a href="#menu-toggle" class="btntest" id="menu-toggle" style="font-weight:50px; font-size:50px; font-color:white; text-decoration:none;">></a>