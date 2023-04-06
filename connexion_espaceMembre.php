<?php 
    session_start();
    
    $bdd  = new PDO('mysql:host=127.0.0.1;dbname=membre;charset=utf8','root','');
    echo'<link rel="stylesheet" href="connexion.css" type="trxt/css"';
?>

<?php ?>

<?php ?>

<?php

if(isset($_POST['connecter'])){
    $email_connect = htmlspecialchars($_POST['email_connexion']);
    $pwd_connect = sha1($_POST['pwd_connexion']);
    if(!empty($_POST['email_connexion']) AND !empty($_POST['pwd_connexion'])){
        
        $ma_req = $bdd->prepare("SELECT * FROM info_membre WHERE email=? AND motdepasse=?");
        $ma_req->execute(array($email_connect, $pwd_connect));
        $email_exit = $ma_req->rowCount();
        if($email_exit==1){
            $info_users = $ma_req->fetch();
            $_SESSION['id']= $info_users['id'];
            $_SESSION['pseudo']= $info_users['pseudo'];
            $_SESSION['email']= $info_users['email'];

            header('location: profil_Membre.php?id='.$_SESSION['id']);
            exit();
            

        }else{
            $message ="Adresse mail ou mot de passe incorrect";
        }
        

    }else{
        $message = "veuillez remplir tous les champs !!!!";
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <form action="#" method="post">
        <input type="text" name="email_connexion" placeholder= "Votre email.... " value="<?php if(isset($email_connect)){echo $email_connect;}?>">
        <br> <br>
        <input type="password" name="pwd_connexion" placeholder= "Votre mot de passe....">
        <br> <br>
        <input type="submit" name="connecter" value='se connecter'>
        <a href="espace_Membre.php">Inscrivez-vous ici</a>


    </form>
    <p>
    <?php 
        if(isset($message)){ echo $message;}
    ?>

    </p>
</body>
</html>