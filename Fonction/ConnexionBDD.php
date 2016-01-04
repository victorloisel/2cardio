<?php

// Init vars
$dsn_bdd = 'mysql:host=localhost;dbname=2.Cardio;charset=UTF8'; //Data Source Name
$user_bdd = 'root';
$pass_bdd = '';
// options de connection

// on essai de se connecter à la base de données
try {
    $bdd = new PDO($dsn_bdd, $user_bdd, $pass_bdd);
    //echo "gooodddddddd";
} catch (Exception $e) {
    die('Erreur :' . $e->getMessage());
}
?>