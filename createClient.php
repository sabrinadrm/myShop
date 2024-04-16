<?php 
//initialisation de la connexion 
        $serverName = 'localhost';
        $userName ='root';
        $password ='root';
        $dbname = 'myShop';
//création de la connexion 
$connection = new mysqli($serverName,$userName, $password ,$dbname);

    $name ='';
    $mail ='';
    $phone ='';
    $adress='';


//si method post ok alors initialisationdesvaleur avec les donnes du form
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name=$_POST["name"];
    $email=$_POST["mail"];
    $phone=$_POST["phone"];
    $adress=$_POST["adress"];

    $errorMessage= ''; //message d erreur si le formulaire n'est pas valid
    $successMessage= ''; // message de confirmation en cas de validationcorrect

//verification si les champs sont vide et si oui message erreur 
    do  {  
        if(empty($name) || empty($email)|| empty($phone)|| empty($adress)){
            $errorMessage="Tous les champs doivent être remplis";
            break;
        }
        

        //AJOUTER LE NOUVEAU CLIENT EN BDD  
        $sql = "INSERT INTO clients (name, email, phone, adress)".
        "VALUES ('$name', '$email','$phone','$adress')" ;

        $result = $connection->query($sql);
        //Si erreur dans la requète alors message 
        if(!$result){
            $errorMessage ="Requète invalide :" . $connection->error;
            break;

        }

        $name ='';
        $email ='';
        $phone ='';
        $adress='';

    $successMessage = 'Profil ajouté avec succés';

    header("location: /myShop/index.php");
    exit;
    } while (false);
    
}
  ?>


<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Ma boutique </title>
</head>
<body>
    <div class='container my-5' >  
        <h2>Nouveau client</h2> 
    <!--affichage message d'erreur -->

    <?php 
    if(!empty($errorMessage)){
            echo"
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong>
                    <button type='button' class='btn-close'  data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
            ";
        }
    ?>
        <from method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-from-label">Name </label>
                    <div class="col-sm-6">
                    <input type="text" class="from-control" name="name" valeur="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-from-label">Email </label>
                <div class="col-sm-6">
                    <input type="text" class="from-control" name="email" valeur="<?php echo $email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-from-label">Phone </label>
                <div class="col-sm-6">
                    <input type="text" class="from-control" name="phone" valeur="<?php echo $phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-from-label">Adress </label>
                <div class="col-sm-6">
                    <input type="text" class="from-control" name="adress" valeur="<?php echo $adress; ?>">
                </div>
            </div>;
       
            <?php 
                if(!empty($successMessage)){
                    echo"
                    <div class='row mb-3'>
                            <div class='offset-sm-3 col-sm-6'>
                                    <div class='alert alert-success alert-dismissible'  role='alert'>
                                        <strong>$successMessage</strong>
                                        <button type='button' class='btn-close'  data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>
                             </div>  
                    </div>";
                };
            ?>

            <div  class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid ">
                    <button type="submit" class="btn btn-primary">Soumettre</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btnbtn-outline-primary" href="/myShop/index.php" role="button">Annuler</a>
                </div>
            </div>
        </form>
    </div>
</body>

</html>