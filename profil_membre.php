<?php 
session_start();
    
$bdd  = new PDO('mysql:host=127.0.0.1;dbname=membre;charset=utf8','root','');
    
?>

<?php 
    if(isset($_GET['id']) AND $_GET['id']>0){
        //Protege l' ID passe dans l'URL
        $get_id = intval($_GET['id']);
        $users_req = $bdd->prepare("SELECT * FROM info_membre WHERE id=?");
        $users_req->execute(array($get_id));

        $info = $users_req->fetch();





?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFIL</title>
</head>
<body>
    <h1>PROFIL MEMBRE</h1>
    <div>
       <h3> Pseudo: <?php echo $info['pseudo']; ?> </h3>
        
       <h3> Email: <?php echo $_SESSION['email']; ?></h3>
       <?php
            if($_SESSION['id'] == $info['id']){ ?>
                <a href="">Editer mon profil</a>
                <a href="">Se déconnecter</a>


                <?php }?>
    </div>
</body>
</html>

<?php }else{?>

<?php 
    
}?>