<?php
session_start();
// if(isset($_SESSION['nom'])){
//     header("location: acceuil.php");
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>*
    <style>
        .container{
            position:absolute;
            top:50%;
            left:50%;
            transform: translate(-50%, -50%);
                }
    </style>
</head>
<body>
    <?php
    //FONCTION ANONYME: permet d'utiliser une variable globale dans une fonction
    $a = 12;
    $b = 1.99;
    $add = function() use($a,$b){
        return $a + $b;
    };
    ?>

    <?php
    $mot = "123456";
    $hash = password_hash($mot, PASSWORD_BCRYPT);
    $nom = htmlspecialchars($_POST['nom']);
    $mail = htmlspecialchars($_POST['mail']);
    ?>

    <?php

    if(isset($_POST["valider"])){
        if(!empty($_POST["nom"]) AND !empty($_POST["mail"]) AND !empty($_POST["password"])){
            if(password_verify($_POST["password"], $hash)){
                $_SESSION["nom"] = $_POST['nom'];
                header("location: acceuil.php");
                exit();

            }else{
                $message = "votre mot de passe est incorrect";
            }
        }else{
            $message  = "veuillez remplir tous les champs svp!";
        }
        
    };

    
    ?>

    <div class="container">
    <form action="#" method="post">
        <label for="name"> Votre nom : </label>
        <input type="text" name="nom" id="name"><br>
        <br>
        <label for="email"> Votre email: </label>
        <input type="text" name="mail" id="email">
        <br>
        <label for="pwd">Votre password:</label>
        <input type="text" name="password" id="pwd">
        <br>
        <button name="valider" >Valider</button> <br>
        <p>
        <?php if(isset($message)){ echo $message;} ?>
        </p>
    </form>
    </div>
</body>
</html>