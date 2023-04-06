<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=membre;charset=utf8', 'root', '');
session_start();
if(!isset($_SESSION['pseudo'])){
    header('location:espace_membre.php');
    exit();
}
?>
<?php
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace memvbre</title>
</head>
<body>
    <div class="profil">
    <?php
        $mon_table= $bdd->query('SELECT pseudo FROM info_membre');
    ?>

        <?php
            while($info=$mon_table->fetch()):
        ?>
            <!-- <h2><?=$info['pseudo'];?></h2> -->
        <?php endwhile; ?>

    <h1>
        Bienvenu <?= $_SESSION['pseudo'] ?>
    </h1>
    <p>Votre adresse mail est <?= $_SESSION['email1'] ?></p>
    <?php 
        $table = $bdd->query('SELECT * FROM info_membre')->fetchAll(PDO::FETCH_OBJ);
        //Pour utiliser des objet plutot que les tableaux, on utilise '->fetchAll(PDO::FETCH_OBJ)'
    ?>
    <h1>Les autre membre sont:</h1>
     <?php 
        foreach($table as $element):
    ?>
    <ul>
        <Li><?= "<strong>Votre pseudo</strong> :$element->pseudo"?></Li>
        <a href="#">envoyer une invitation</a>
    </ul>
    <?php 
        endforeach;
    ?>
     <?php 
        if(isset($_POST["deconnecter"])){
            session_destroy();
            header('location:espace_membre.php');
            exit();
        }
    ?>
    <form action="#" method="post">
        <input type="submit" value="se deconnecter" name="deconnecter">
    </form>
    
   
    </div>
</body>
</html>