<?php
$bdd= new PDO ('mysql:host=127.0.0.1;dbname=membre;charset=utf8', 'root','');
session_start();
echo '<link href="stylle.css" rel="stylesheet" type="text/css">';
if(isset($_POST['valider'])){
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email1 = htmlspecialchars($_POST['email1']);
    $email2 = htmlspecialchars($_POST['email2']);
    $pwd1 = sha1($_POST['pwd1']);
    $pwd2 = sha1($_POST['pwd2']);
    if(!empty($_POST['pseudo']) AND !empty($_POST['email1']) AND !empty($_POST['email2']) AND !empty($_POST['pwd1']) AND !empty($_POST['pwd2'])){
        $pseudolenght=strlen($pseudo);
        if($pseudolenght <= 100){
            if($email1==$email2){

                $requetMail = $bdd->prepare("SELECT * FROM info_membre WHERE email=?");
                $requetMail->execute(array($email1));
                $mailexist= $requetMail->rowCount();
                if($mailexist==0){
                    
                if($pwd1==$pwd2){

                    $requetPwd = $bdd->prepare("SELECT * FROM info_membre WHERE motdepasse=?");
                    $requetPwd->execute(array($pwd1));
                    $pwdexist= $requetPwd->rowCount();
                    if($pwdexist==0){
                        $_SESSION['pseudo']= $_POST['pseudo'];
                        $_SESSION['email1']= $_POST['email1'];
                        $insert = $bdd->prepare("INSERT INTO info_membre(pseudo, email, motdepasse) VALUES (?, ?, ?)");
                        $insert->execute(array($pseudo, $email1, $pwd1));
                        $message="inscription reussie, votre compte a ete cree";
                        header("location:acceuil_membre.php");
                    }
                    else{
                        $message="mot de passe déja utilisé";
                    }
                }
                else{
                    $message ="les mot de passes doivent etre identique";
                }
                }
                else{
                    $message="Adresse mail deja utilisé";
                }

                                
                //on verifie si c'est vraiment un mail que l'utilisateur a rentrer

                // if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                
                // else{
                //     $message="votre adresse email n'est pas valide";
                // }

            }
            else{
                $message="vos adresse mail ne correspondent pas !!";
            }
        }
        else{
            $message="votre pseudo est trop long !!";
        }
    }
    else{
        $message = "veuillez remplir tous les champs s'il vous plait!!";
    }
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESPACE MEMBRE</title>
</head>
<body>
    <form action="#" method="post">
        
       <div>
       <table>
       <h1>INSCRIPTION</h1>
        <br> 
            <tr>
                <td>
                <input type="text" name="pseudo" placeholder=" Votre pseudo" value="<?php if(isset($pseudo)){echo $pseudo; } ?>">
                </td>
            </tr>
            <tr>
                <td>
                <input type="email" name="email1" placeholder="Votre email" value="<?php if(isset($email1)){echo $email1; } ?>">
                </td>
            </tr>
            <tr>
                <td>
                <input type="email" name="email2" placeholder="Confirmer votre email" value="<?php if(isset($email2)){echo $email2; } ?>">
                </td>
            </tr>
            <tr>
                <td>
                <input type="passeword" name="pwd1" placeholder="Votre mot de passe">
                </td>
            </tr>
            <tr>
                <td>
                <input type="passeword" name="pwd2" placeholder="Confirmer votre mot de passe">
                </td>
            </tr>
            <tr>
                <td>
                <input type="submit" name="valider" value="S'inscrire" class="dernier">
                <a href="connexion_espaceMembre.php">Vous avez deja un compte?</a>
                </td>
            </tr>
        </table>
        <?php
    if(isset($message))
    {
        echo '<font color="red">'.$message.'</font>';
    }

    ?>
       </div>
    </form>
   
</body>
</html>