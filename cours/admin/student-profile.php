<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard V.1 | Kiaalap - Kiaalap Admin Template</title>
    <?php include('links.php');?>
</head>

<body>
   <!--[if lt IE 8]>
		<p class="browserupgrade">Votre navigateur n'est pas <strong>à jour</strong>. Faites une  <a href="http://browsehappy.com/"> mise à jour</a></p>
	<![endif]-->
    <!-- Start Left menu area -->
    <?php include('desktop.php');?>
    <!-- End Left menu area -->
    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="index.html"><img class="main-logo" src="img/logo/logo.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <?php include('mobile.php');?>
        <!-- Single pro tab review Start-->
        <div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="profile-info-inner">
                            <div class="profile-img">
                                <img src="img/profile/1.jpg" alt="" />
                            </div>
                            <div class="profile-details-hr">
                                <div class="row">
                                    <div class="col-6">
                                            <b>Nom d'utilisateur:</b>
                                    </div>
                                    <div class="col-6">
                                            <p>Fly Zend</p>
                                    </div>
                                    <div class="col-6">
                                            <b>Nom:</b>
                                    </div>
                                    <div class="col-6">
                                            <p>Fly Zend</p>
                                    </div>
                                    <div class="col-6">
                                            <b>Prenom:</b>
                                    </div>
                                    <div class="col-6">
                                            <p>CSE</p>
                                    </div>
                                    <div class="col-6">
                                            <b>Email:</b>
                                    </div>
                                    <div class="col-6">
                                            <p>fly@gmail.com</p>
                                    </div>
                                    <div class="col-6">
                                            <b>Telephone:</b>
                                    </div>
                                    <div class="col-6">
                                            <p>+01962067309</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <div class="profile-info-inner">
                            <div class="row ">
                                <div class="col-12 ">
                                    <h5 class="primeTxt text-muted text-center mb-5">Modifier votre compte</h5>
                                </div>
                                <div class="col-12 text-center">
                                    <form method="post" action="index.php">
                                        <div class="row ">
                                            <div class="input-group col-sm-12 col-md-6 mb-3 ">
                                                <input class="form-control w-75 <?php if (isset($getmsg)): ?> border border-danger text-danger<?php endif ?>" type="text" name="login_username" id="login_username" placeholder="Nom d'utilisateur..." required>
                                                
                                            </div>
                                            <div class="input-group col-sm-12 col-md-6 mb-3 ">
                                                <input class="form-control w-75 <?php if (isset($getmsg)): ?> border border-danger text-danger<?php endif ?>" type="text" name="login_username" id="login_username" placeholder="Nom..." required>
                                                
                                            </div>

                                            <div class="input-group col-sm-12 col-md-6 mb-3">
                                                <input class="form-control w-75 <?php if (isset($getmsg)): ?> border border-danger <?php endif ?>" type="text" name="login_password" id="login_password" placeholder="Prenom..." required>
                                                
                                            </div>
                                            <div class="input-group col-sm-12 col-md-6 mb-3">
                                                <input class="form-control w-75 <?php if (isset($getmsg)): ?> border border-danger <?php endif ?>" type="email" name="login_password" id="login_password" placeholder="Email..." required>
                                                
                                            </div>
                                            <div class="input-group col-sm-12 col-md-6 mb-3">
                                                <input class="form-control w-75 <?php if (isset($getmsg)): ?> border border-danger <?php endif ?>" type="number" name="login_password" id="login_password" placeholder="tel..." required>
                                                
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
            </div>
        </div>

        
        <?php include('footer.php');?>
</body>

</html>