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
                        echo '<br />'.'<br />';

                        $Prenom='jeremy'; 
                        $nom='murail';
                        $age=21;
                        $promotion='cdl14';
                        $note=19;


                        $TabPromo= array('cdl13','cdl14','ap15');
                        $TabEtudiant= array('jeremy','moussa','aurelien','max','tom');

                        echo '<table style="width:250px;" class="table table-striped">';

                            for ($i = 0; $i < count($TabPromo); $i++)
                            {
                                echo '<tr><td>' . $TabPromo[$i] . '</td></tr><br />';
                            }
                        echo '<br />'.'<br />';
                        echo '<br />'.'<br />';


                            foreach ($TabEtudiant as $key => $valeur) {
                                echo '<tr><td>Key : ' . $key . '</td><td> Value : ' . $valeur . '</tr><br />';
                            }
                        echo '<table>';

                        echo '<br />'.'<br />';
                        echo '<br />'.'<br />';

                        var_dump($TabEtudiant);



                        echo '<br />'.'<br />';
                        echo '<br />'.'<br />';


                        $TabPrincipal['cesi']['cdl14'] = array('jeremy'=>16,
                                                                'moussa'=>16,
                                                                'aurelien'=>16); 
                        $TabPrincipal['cesi']['ap15'] = array('max'=>14,
                                                                'tom'=>14);


                        foreach ($TabPrincipal as $key=>$valeur)  
                        { 
                     
                            echo $key.' = '.$valeur.' <br>';  
                                foreach ($valeur as $key2=>$valeur2)  
                                { 
                                    echo '&nbsp;&nbsp;&nbsp;'.$key2.' = '.$valeur2.' <br>';
                                        foreach ($valeur2 as $key3=>$valeur3)  
                                        { 
                                            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$key3.' = '.$valeur3.' <br>';   
                                        }    
                                }   
                        }



                        echo '<table style="width:250px;" class="table table-striped">';
                        foreach ($TabPrincipal as $key=>$valeur)  
                        { 
                     
                            echo '<tr><td>Key : ' .$key. '</td><td> Value : ' .$valeur. '</tr><br /><br>';  
                                foreach ($valeur as $key2=>$valeur2)  
                                { 
                                    echo '&nbsp;&nbsp;&nbsp;'.'<tr><td>Key : ' .$key2. '</td><td> Value : ' .$valeur2. '</tr><br /><br>';
                                        foreach ($valeur2 as $key3=>$valeur3)  
                                        { 
                                            echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.'<tr><td>Key : ' .$key3. '</td><td> Value : ' .$valeur3. '</tr><br /><br>';   
                                        }    
                                }   
                        }
                        echo '</table>';   

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
