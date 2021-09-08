<?php 
include("../utilities/QueryBuilder.php");
$obj = new QueryBuilder();
//creation of the error message variable
$error = '';
//if the submit button is clicked
if(isset($_POST["submit"]))
{
    extract($_POST);
    //hashing the password
    $password = md5($password);
    //die(var_dump($password));
    //inserts the new user in the users table
    $res = $obj->Inscription('users', array("USERNAME", "PASSWORD", "EMAIL", "TELEPHONE", "TYPE"), array($username, $password, $email, $telephone, "learner"), $status = array("USERNAME"=>$username));
    //if the registration in the users table is done
    if($res==true)
    {
        //selection of the id of the user
        $id = $obj->Select('users', array('IDUSER'), array("USERNAME"=>$username))->fetch();
        $id = $id['IDUSER'];
        //creation of the user matricule
        $matricule = 'learner'.$id.date('Ymd');
        $res = $obj->Insert('learner', ["MATRICULE", "IDUSER", "LASTNAME", "LEARNERFIRSTNAME"], [$matricule, $id, $lastname, $firstname]);
        //if the registration is ok
        if($res==true)
        {
            //leads the user to connects itself
            header('Location: index.php');
        }
    }
    else if($res == false)
    {
        $error = 'Ce nom d\'utilisateur n\'est plus valide.';
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
    <link rel="stylesheet" href="assets/css/errors.css">
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
    
                    </div>
                    <div class="card-body p-lg-4">
                        <?php
                        if($error != '')
                        {
                            echo '<div class="alert alert-danger text-center">'.$error.'</div>';
                        }
                        ?>
                        <form method="post" action="#" id="registrate">
                            
                            <div class="row">

                                <div class="input-group col-sm-12 col-md-12 mb-3">
                                    <input class="form-control" type="text" name="username" id="username" placeholder="Nom d'utilisateur..." required>
                                    <div class="input-group-append">
                                        <span class=" input-group-text fas fa-user-edit bg-light primeTxt"></span>
                                    </div>
                                    <div class='dispaly_err col-12'></div>
                                </div>

                                <div class="input-group col-sm-12 col-md-6 mb-3">
                                    <input class="form-control" type="text" name="lastname" id="lastname" placeholder="Nom..." required>
                                    <div class="input-group-append">
                                        <span class=" input-group-text fas fa-user-edit bg-light primeTxt"></span>
                                    </div>
                                    <div class='dispaly_err col-12'></div>
                                </div>

                                <div class="input-group col-sm-12 col-md-6 mb-3">
                                    <input class="form-control" type="text" name="firstname" id="firstname" placeholder="Prenom..." required>
                                    <div class="input-group-append">
                                        <span class=" input-group-text fas fa-user-edit bg-light primeTxt "></span>
                                    </div>
                                    <div class='dispaly_err col-12'></div>
                                </div>
                                
                                <div class="input-group col-sm-12 col-md-6 mb-3">
                                    <input class="form-control" type="email" name="email" id="email" placeholder="Email..." required>
                                    <div class="input-group-append">
                                        <span class=" input-group-text fas fa-paper-plane bg-light primeTxt "></span>
                                    </div>
                                    <div class='dispaly_err col-12'></div>
                                </div>
                                <div class="input-group col-sm-12 col-md-6 mb-3">
                                    <input class="form-control" type="number" name="telephone" id="telephone" placeholder="tel..." required>
                                    <div class="input-group-append">
                                        <span class=" input-group-text fas fa-phone bg-light primeTxt "></span>
                                    </div>
                                    <div class='dispaly_err col-12'></div>
                                </div>
                                <div class="input-group col-sm-12 col-md-6 mb-3">
                                    <input class="form-control" type="password" name="password" id="password" placeholder="Mot de passe..." required>
                                    <div class="input-group-append">
                                        <span class=" input-group-text fas fa-lock bg-light primeTxt"></span>
                                    </div>
                                    <div class='dispaly_err col-12'></div>
                                </div>
                                <div class="input-group col-sm-12 col-md-6 mb-3">
                                    <input class="form-control " type="password" name="confirm_password" id="confirm_password" placeholder="Confirmer mot de passe..." required>
                                    <div class="input-group-append">
                                        <span class=" input-group-text fas fa-lock bg-light primeTxt"></span>
                                    </div>
                                    <div class='dispaly_err col-12'></div>
                                </div>
                                <div class="col-12 text-center my-4">
                                        <input name="submit" class="btn primeBack text-white w-50 rounded-pill" type="submit" value="S'inscrire">
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
<script src="assets/js/jquery-3.4.0.min.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script>
    $(function(){
        var registerForm = $("#registrate");
        if(registerForm.length)
        {
            registerForm.validate({
                rules:
                {
                    username:
                    {
                        required: true
                    },
                    lastname:
                    {
                        required: true
                    },
                    firstname:
                    {
                        required: true
                    },
                    email:
                    {
                        required: true
                    },
                    telephone:
                    {
                        required: true
                    },
                    password: 
                    {
                        required: true
                    },
                    confirm_password:
                    {
                        required: true,
                        equalTo: '#password'
                    }
                },
                messages: 
                {
                    username:
                    {
                        required: "Ce champ est obligatoire."
                    },
                    firstname:
                    {
                        required: "Ce champ est obligatoire."
                    },
                    lastname:
                    {
                        required: "Ce champ est obligatoire."
                    },
                    email:
                    {
                        required: "Ce champ est obligatoire."
                    },
                    telephone:
                    {
                        required: "Ce champ est obligatoire."
                    },
                    password:
                    {
                        required: 'Ce champ est obligatoire.'
                    },
                    confirm_password:
                    {
                        required: 'Ce champ est obligatoire.',
                        equalTo: 'Les mots de passe ne correspondent pas.'
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