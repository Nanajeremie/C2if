<?php 
include("../utilities/QueryBuilder.php");
$obj = new QueryBuilder();
$error = '';
//if the submit button is clicked
if(isset($_POST["submit"]))
{
    extract($_POST);
    //if the button 'remember me' is on
    $cookies = [];
    if(isset($remember) AND $remember=='on')
    {
        $cookies = ['USERNAME'=>$username, 'PASSWORD'=>$password];
    }
    //hasing the password
    $password = md5($password);
    //checking if the user could be connected to the paltform
    $connect = $obj->Connexion('users', array('USERNAME', 'PASSWORD'), array($username, $password), $return=array('TYPE'), $cookies = $cookies, $sessions=array('USERNAME'=>'USERNAME', 'IDUSER'=>'IDUSER'));
    //if the connection works
    if(is_array($connect) AND count($connect)>0)
    {
        header('Location: cours.php');
    }
    else 
    {
        $error = 'Le mot de passe ou/et le nom d\'utilisateur sont incorrects';
    }
}
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
    <link rel="stylesheet" href="assets/css/errors.css">
</head>
<body>
    <div class="container">
        <div class="row ">
            <div class="col-lg-6 mx-auto my-5">
                <div class="card cardBor">
                    <div class="card-header py-3 primeBack">
                        <h3 class="text-uppercase text-center text-light">Connexion</h3>
                    </div>
                   
                    <div class="card-body p-lg-4">
                        
                        <form method="post" action="#" id="login">
                            <?php
                                if($error != '')
                                {
                                    echo '<div class="alert alert-danger text-center">'.$error.'</div>';
                                }
                            ?>
                            <div class="input-group py-3">
                                <input class="form-control cardBor" type="text" name="username" id="username" placeholder="Nom d'utilisateur" value="<?php if(isset($_COOKIE['USERNAME']))
                                        {
                                            echo $_COOKIE['USERNAME'];
                                        }
                                        ?>" required>
                                <div class="input-group-append">
                                    <span class=" input-group-text fas fa-user-alt  bg-light cardBor primeTxt"></span>
                                </div>
                                <div class="col-12"></div>
                            </div>

                            <div class="input-group py-3">
                                <input class="form-control cardBor" type="password" name="password" id="password" placeholder="Mot de passe" value="<?php if(isset($_COOKIE['PASSWORD']))
                                        {
                                            echo $_COOKIE['PASSWORD'];
                                        }
                                        ?>" required>
                                <div class="input-group-append">
                                    <span class=" input-group-text fas fa-lock bg-light cardBor primeTxt"></span>
                                </div>
                                <div class="col-12"></div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <label for="remember">
                                        <input type="checkbox" class="primeTxt" name="remember" id="remember"><label for="remember" class="ml-2 text-primary">Se souvenir</label>
                                    </label>
                                </div>
                                <div class="col-6 text-right">
                                    <a class="text-info" href="mail/forgot_password.php">Mot de passe oublié ?</a>
                                </div>

                                <div class="col-lg-12 py-5 text-center">
                                    <button  name="submit" class=" primeBack btn px-5 rounded-pill" type="submit"><span class="fas fa-paper-plane text-white"></span></button>
                                </div> 
                            </div>
                        </form>
                        <p class="h5">Si vous n'avez pas de compte, créez en un <a href="register.php" class="text-primary">ici</a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
<script src="assets/js/jquery-3.4.0.min.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script>
    $(function()
    {
        var loginForm = $("#login")
        if(loginForm.length)
        {
            loginForm.validate({
                rules:
                {
                    username:
                    {
                        required: true
                    },
                    password:
                    {
                        required: true
                    }
                },
                messages:
                {
                    username:
                    {
                        required: "Ce champ est requis"
                    },
                    password:
                    {
                        required: "Ce champ est requis"
                    }
                },
                errorPlacement: function(error, element)
                {
                    error.addClass('text-danger')
                    error.appendTo(element.next().next())
                }
            })
        }
    })
</script>