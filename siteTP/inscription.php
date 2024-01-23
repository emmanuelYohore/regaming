<?php
$connexion = new PDO('mysql:host=127.0.0.1;dbname=users_base1', 'root', '');
if ($connexion) {
    echo "connecté !";
}
if (isset($_POST['valider'])) {
    if (!empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['email']) and !empty($_POST['password'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $mdp = sha1($_POST['password']);

        if (strlen($_POST['password']) < 7) {
            $message = "votre mot de passe est trop court !";
        } elseif (strlen($nom) > 25 || strlen($prenom) > 50) {
            $message = "Nom ou Prenom trop long";
        } else {

            $testmail = $connexion->prepare("SELECT * FROM users WHERE email = ?");
            $testmail->execute(array($email));

            $controlmail = $testmail->rowCount();
            if ($controlmail == 0) {
                $insertion = $connexion->prepare("INSERT INTO users(nom, prenom, email, password) VALUES (?, ?, ?, ?)");
                $insertion->execute(array($nom, $prenom, $email, $mdp));
                $message = "votre compte a bien été créé !";
            } else {
                $message = 'un compte est déjà associé à cette adresse mail !';
            }
        }
    } else {
        $message = "Remplissez tous les champs !";
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

    <!-- Ajout des liens vers les fichiers de style Bootstrap et Font Awesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .bg-white {
            background-color: #ffffff;
        }

        .rounded-top {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .text-muted {
            color: #6c757d;
        }

        form {
            padding: 20px;
        }

        .input-group-text {
            background-color: #e9ecef;
            border: none;
        }

        .form-control {
            border: 1px solid #ced4da;
            border-radius: 5px;
        }

        .btn-success {
            background-color: #28a745;
            border: none;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .text-center a {
            color: #007bff;
        }

        .text-center a:hover {
            text-decoration: underline;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-4 bg-white m-auto rounded-top">
                <h2 class="text-center">Inscription</h2>
                <p class="text-center text-muted lead">Simple et Rapide</p>

                <form method="POST" action="">
                    <!-- Vos champs de formulaire ici -->

                    <div class="d-grid">
                        <button type="button" name="valider" class="btn btn-success">S’inscrire</button>
                        <p class="text-center text-muted mt-3">
                            <i style="color:red">
                                <?php
                                if (isset($message)) {
                                    echo $message . "<br />";
                                }
                                ?>
                            </i>
                            En cliquant sur S’inscrire, vous acceptez nos <a href="#">Conditions générales</a>,
                            notre <a href="">Politique de confidentialité</a> et notre <a href="#">Politique d’utilisation</a>
                            des cookies.
                        </p>
                        <p class="text-center">
                            Avez-vous déjà un compte ? <a href="connexion.php">Connexion</a>
                        </p>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Ajout des scripts Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
