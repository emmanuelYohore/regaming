<?php
$connexion = new PDO('mysql:host=127.0.0.1;dbname=users_base1', 'root', '');
if ($connexion) {
    ;
}
if (isset($_POST['valider'])) {
    if (!empty($_POST['email']) and !empty($_POST['password'])) {
        $email = htmlspecialchars($_POST['email']);
        $password = sha1($_POST['password']);
        $req = $connexion->prepare("SELECT * FROM users WHERE email =? AND password =?");
        $req->execute(array($email, $password));
        $cpt = $req->rowCount();

        if ($cpt == 1) {
            $message = "votre compte a bien été trouvé !";
        } else {
            $message = "Désolé nous ne trouvons pas ce compte !";
        }
    } else {
        $message = "veuillez Remplir tous les champs !";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Connexion et inscription </title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
   <link rel="stylesheet" href="connexion.css">
</head>

<body class="bg-light">
    <div class="container ">
        <div class="row mt-5">
            <div class="col-lg-4 bg-white m-auto rounded-top">
                <h2 class="text-center"> pone</h2>
                <p class="text-center text-muted lead"> Se connecter à WWW </p>

                <form method="POST" action="">
                    <div class="input-group  mb-3">
                        <span class="input-group-text">
                            <i class="fa fa-envelope">
                            </i>
                        </span>
                        <input type="email" name="email" class="form-control" placeholder="Adresse e-mail  ">
                    </div>

                    <div class="input-group  mb-3">
                        <span class="input-group-text">
                            <i class="fa fa-lock">
                            </i>
                        </span>
                        <input type="password" name="password" class="form-control" placeholder="Mot de passe ">
                    </div>
                    
                    <div class="d-grid">
                       <button type="buton" name="valider" class="btn btn-success"> <a href="http://127.0.0.1/siteTP/index.html">Se connecter</a></button>

                        <p class="text-center">
                            <i style=" color:red ">
                                <?php
                                if (isset($message)) {
                                    echo $message . "<br />";
                                }
                                ?>
                            </i>
                            vous n'avez pas de compte ?<a href="inscription.php"> Inscription </a>
                        </p>
                    </div>
                </form>

            </div>
        </div>
    </div>

</body>

</html>
