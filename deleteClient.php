<?php // si get contient l'id alors on le lis 
if (isset($_GET['ID'])) {     $ID = $_GET['ID']; 
    
    // initialisation de la connexion
        $servername = 'localhost';
        $username ='root';
        $password ='root';
        $dbname = 'myShop'; 
            
        //création de la connexion  
             $conn = new mysqli($servername, $username, $password, $dbname);  
             
             //exécution de la requête de suppression 
                $sql = 'DELETE FROM clients WHERE ID='.$ID; 
                $result = $conn->query($sql); }  
                header( "Location: /myShop/index.php"); exit;  
                
 ?>