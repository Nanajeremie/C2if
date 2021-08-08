<?php 

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="icon" href="assets/media/logo_bit.png">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto my-5">
                <div class="card cardBor">
                    <div class="card-header py-3 primeBack">
                        <h3 class="text-uppercase text-center text-light">Connexion</h3>
                    </div>
                    <div class="mt-2 col-12 text-center ">
                        <?php 
                            if (isset($getmsg)) {echo $getmsg;}else{if(isset($getUpdMsg)){echo $getUpdMsg;} } ;
                            if(isset($annee_vide)){echo $annee_vide;};
                        ?>
                    </div>
                    <div class="card-body p-lg-4">
                        
                        <form method="post" action="index.php">

                            <div class="input-group py-3">
                                <input class="form-control <?php if (isset($getmsg)): ?> border border-danger text-danger<?php endif ?> cardBor" type="text" name="login_username" id="login_username" placeholder="Nom d'utilisateur" value="<?php if(isset($_COOKIE['USERNAME']))
                                        {
                                            echo $_COOKIE['USERNAME'];
                                        }
                                        ?>" required>
                                <div class="input-group-append">
                                    <span class=" input-group-text fas fa-user-alt  bg-light cardBor primeTxt"></span>
                                </div>
                            </div>

                            <div class="input-group py-5">
                                <input class="form-control <?php if (isset($getmsg)): ?> border border-danger  <?php endif ?> cardBor" type="password" name="login_password" id="login_password" placeholder="Mot de passe" value="<?php if(isset($_COOKIE['PASSWORD']))
                                        {
                                            echo $_COOKIE['PASSWORD'];
                                        }
                                        ?>" required>
                                <div class="input-group-append">
                                    <span class=" input-group-text fas fa-lock bg-light cardBor primeTxt"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <label for="login_remember">
                                        <input type="checkbox" class="primeTxt" name="login_remember" id="login_remember" > Se souvenir
                                    </label>
                                </div>
                                <div class="col-6 text-right">
                                    <a class="text-info" href="mail/forgot_password.php">Mot de passe oublié?</a>
                                </div>

                                <div class="col-lg-12 py-5 text-center">
                                    <button  name="submit" class=" primeBack btn px-5 rounded-pill" type="submit"><span class="fas fa-paper-plane text-white"></span></button>
                                </div> 
                            </div>
                        </form>
                        <p class="h5">Si vous n'avez pas de compte créer un <a href="register.php" class="text-primary">ici</a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>