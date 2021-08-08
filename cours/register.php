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
            <div class="col-lg-8 mx-auto my-5">
                <div class="card cardBor">
                    <div class="card-header py-3 primeBack">
                        <h3 class="text-uppercase text-center text-light">Creation de compte</h3>
                    </div>
                    <div class="mt-2 col-12 text-center ">
                        <?php 
                            if (isset($getmsg)) {echo $getmsg;}else{if(isset($getUpdMsg)){echo $getUpdMsg;} } ;
                            if(isset($annee_vide)){echo $annee_vide;};
                        ?>
                    </div>
                    <div class="card-body p-lg-4">
                        <form method="post" action="index.php">
                            <div class="row">
                                <div class="input-group col-sm-12 col-md-6 mb-3">
                                    <input class="form-control <?php if (isset($getmsg)): ?> border border-danger text-danger<?php endif ?>" type="text" name="login_username" id="login_username" placeholder="Nom..." value="<?php if(isset($_COOKIE['USERNAME']))
                                            {
                                                echo $_COOKIE['USERNAME'];
                                            }
                                            ?>" required>
                                    <div class="input-group-append">
                                        <span class=" input-group-text fas fa-user-edit bg-light primeTxt"></span>
                                    </div>
                                </div>

                                <div class="input-group col-sm-12 col-md-6 mb-3">
                                    <input class="form-control <?php if (isset($getmsg)): ?> border border-danger <?php endif ?>" type="text" name="login_password" id="login_password" placeholder="Prenom..." value="<?php if(isset($_COOKIE['PASSWORD']))
                                            {
                                                echo $_COOKIE['PASSWORD'];
                                            }
                                            ?>" required>
                                    <div class="input-group-append">
                                        <span class=" input-group-text fas fa-user-edit bg-light primeTxt "></span>
                                    </div>
                                </div>
                                <div class="input-group col-sm-12 col-md-6 mb-3">
                                    <input class="form-control <?php if (isset($getmsg)): ?> border border-danger <?php endif ?>" type="email" name="login_password" id="login_password" placeholder="Email..." value="<?php if(isset($_COOKIE['PASSWORD']))
                                            {
                                                echo $_COOKIE['PASSWORD'];
                                            }
                                            ?>" required>
                                    <div class="input-group-append">
                                        <span class=" input-group-text fas fa-paper-plane bg-light primeTxt "></span>
                                    </div>
                                </div>
                                <div class="input-group col-sm-12 col-md-6 mb-3">
                                    <input class="form-control <?php if (isset($getmsg)): ?> border border-danger <?php endif ?>" type="number" name="login_password" id="login_password" placeholder="tel..." value="<?php if(isset($_COOKIE['PASSWORD']))
                                            {
                                                echo $_COOKIE['PASSWORD'];
                                            }
                                            ?>" required>
                                    <div class="input-group-append">
                                        <span class=" input-group-text fas fa-phone bg-light primeTxt "></span>
                                    </div>
                                </div>
                                <div class="input-group col-sm-12 col-md-6 mb-3">
                                    <input class="form-control <?php if (isset($getmsg)): ?> border border-danger <?php endif ?>" type="password" name="login_password" id="login_password" placeholder="Mot de passe..." value="<?php if(isset($_COOKIE['PASSWORD']))
                                            {
                                                echo $_COOKIE['PASSWORD'];
                                            }
                                            ?>" required>
                                    <div class="input-group-append">
                                        <span class=" input-group-text fas fa-lock bg-light primeTxt"></span>
                                    </div>
                                </div>
                                <div class="input-group col-sm-12 col-md-6 mb-3">
                                    <input class="form-control <?php if (isset($getmsg)): ?> border border-danger <?php endif ?>" type="password" name="login_password" id="login_password" placeholder="Confirmer mot de passe..." value="<?php if(isset($_COOKIE['PASSWORD']))
                                            {
                                                echo $_COOKIE['PASSWORD'];
                                            }
                                            ?>" required>
                                    <div class="input-group-append">
                                        <span class=" input-group-text fas fa-lock bg-light primeTxt"></span>
                                    </div>
                                </div>
                                <div class="col-12 text-center my-4">
                                        <input name="submit" class="btn primeBack text-white w-50 rounded-pill" type="submit" value="Login">
                                </div> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>