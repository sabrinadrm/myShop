<?php

//initialisation de la connexion
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "myShop" ;

//création de la connection
$connexion = new mysqli($servername, $username, $password, $dbname);


    $ID = '';
    $name = '';
    $email = '';
    $phone = '';
    $adress = '';

    $errorMessage = '';
    $succesMessage = '';

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    //méthode get : récupére et affiche les données du client
    if(!isset($_GET['ID'])) {//si il n'existe pas alors on redirige et on quitte
      //  header( 'Location: /myShop/index.php');  
        exit;   
    }
    $ID =  $_GET['ID']; 

// lis les lignes du client sélectionné en bdd
$sql = "SELECT * FROM clients WHERE ID = $ID";
$result = $connexion->query($sql);//exécute la  requête sql
$row = $result->fetch_assoc(); // lis les datas en bdd

//sinon on le redirige vers l'index
if(!$row){
    header('Location: /myShop/index.php');
    exit;
}
//stockage des données de la bdd
$name = $row['name'];
$email = $row['email'];
$phone = $row['phone'];
$adress = $row['adress'];

}
else{
// méthode post : modifie les données d'un client
    $ID = $_POST['ID'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $adress = $_POST['adress'];

//vérifie si champs vIDe et si oui message d'erreur
do{
    if (empty($ID) || empty($name) ||  empty($email) || empty($phone) || empty($adress) ){
        $errorMessage .= "Tous les champs doivent être remplis.";
        break;
    }// requête d'update des données
    $sql = "UPDATE clients 
            SET name='$name', email='$email', phone='$phone', adress='$adress' 
            WHERE ID=$ID";
    //exécution de la requête
    $result =  $connexion->query($sql);
    //si erreur envoi d'un message
    if (!$result){
        $errorMessage ="Requête invalIDe" . $connection->error ;
        break;
    }
    //si tout s'est bien passé on affiche un message puis on redirige
    $succesMessage=" Mise à jour réussie !";
    header('location: /myShop/index.php');
    exit;
}while (false);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wIDth=device-wIDth, initial-scale=1.0">
    <title>Ma boutique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="boostrap-container my-5">
    <h1> Nouveau Client </h1>
    <!--Affichage message d'erreur-->
    <?php
        if (!empty($errorMessage)){
            echo"
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>{$errorMessage}</strong>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'></button>
                </div>
            ";
        }
    ?>
    <form method='post'>
    <input  type="hIDden" name ='ID' value="<?php echo $ID; ?>"/>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Nom</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Téléphone</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Adresse</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="adress" value="<?php echo $adress; ?>">
            </div>
        </div>
    <?php
        if (!empty($succesMessage)){
            echo "
            <div class='row mb-3>
                <div class='offset-sm-3 col-sm-6'>
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>{$succesMessage}</strong>
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                </div>
            </div>
            ";
        }
    ?>
    <div class='row mb-3'>
        <div class="offset-sm-3 col-sm-3 d-grID">
            <button type="submit" class="btn btn-primary" >Enregistrer</button>
        </div>
        <div class="col-sm-3 d-grID">
            <a class="btn btn-outline-primary" href="/myShop/index.php" role="button">Annuler</a>
        </div>
    </div>
</form>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</html>