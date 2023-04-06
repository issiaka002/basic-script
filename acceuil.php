<?php
//Toujours gerer les erreur 

// try {
//     $bdd= new PDO ('mysql:host=127.0.0.1;dbname=membre;charset=utf8', 'root','');
// } catch (PDOException $exception) {
//     exit("Oups, une erreur s'est produit lors de la connection");
// };

// $bdd= new PDO ('mysql:host=127.0.0.1;dbname=membre;charset=utf8', 'root','');


?>
<?php
session_start();
?>

<?php

if(isset($_POST["deconnecter"])){
    session_destroy();
    header("location: requete.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESPACE MEMBRE</title>
    <style>
    h1{
        font-weight: bold;
        font-family: Verdana,Tahoma, sans-serif;
        font-size: 70px;
    }
    p{
        font-size: 30px;
        font-style: italic;
    }
div{
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-40%, -50%);
    margin-top: ;
}
    </style>
</head>
<body>
    <div>
        <h1>
         BIENVENUE <?= $_SESSION["nom"];?>
        </h1>
        <p>La qualité et efficacité est notre devise</p>
        <form action="#" method="post">
            <input type="submit" value="déconnecter" name="deconnecter" > <br>
          
        </form>
    </div>
</body>
</html>