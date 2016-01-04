<?php




        $ip = $_SERVER['REMOTE_ADDR'];

        
        if(mysql_connect("localhost","root","")!= FALSE){
            mysql_select_db("testphp");
   
            $requete = "Update Compteur set idCompteur = idCompteur + 1";
            $pages_vues = "Select idCompteur From Compteur";
            $res=mysql_query($pages_vues);
            $vues=mysql_fetch_array($res);

            if( mysql_query($requete)){ 
                echo '<h1>Page vue ' . $vues["idCompteur"] . ' fois.</h1>';
                if (!file_exists("log.txt")) file_put_contents("log.txt", "");
                file_put_contents("log.txt",date("[j/m/y H:i:s]")." - connexion : $ip \r\n".file_get_contents("log.txt"));
            }else{
                echo '<h1>Page vue ' . $vues["idCompteur"] . ' fois.</h1>';
                if (!file_exists("log.txt")) file_put_contents("log.txt", "");
                file_put_contents("log.txt",date("[j/m/y H:i:s]")." - erreur de log sql $ip \r\n".file_get_contents("log.txt"));
        }

        $requeteLog = "INSERT INTO Log (Ip,Date) VALUES ('" . $Ip . "','". date("Y-m-d",time()) ."')";
         if( mysql_query($requeteLog)){ 
                echo '<h1>requete mysql bien passée '.date("Y-m-d",time()).' !</h1>';
               
            }
        



    }   
        mysql_close();


    
    

?>