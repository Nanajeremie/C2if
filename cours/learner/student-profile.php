<!doctype html>
<html class="no-js" lang="en">

<?php
include("../../utilities/QueryBuilder.php");
$idUser=$_SESSION['IDUSER'];
//$_SESSION['IDUSER']
$obj = new QueryBuilder();
//$subjects = $obj->Select('subject',[],[]);
isset($idUser)? $infos=$obj->Requete('SELECT * FROM users u, learner l WHERE l.IDUSER=u.IDUSER AND u.IDUSER="'.$idUser.'"') : $infos=null;

//modification des infos personnelles
if(isset($_POST['submit'])):
 $obj->Update('users',array('USERNAME','EMAIL','TELEPHONE'),array($_POST['login_username'], $_POST['login_email'],$_POST['login_phone']),array('IDUSER'=>$idUser));
 $obj->Update('learner',array('LASTNAME','LEARNERFIRSTNAME'),array($_POST['login_fname'],$_POST['login_lname']),array('IDUSER'=>$idUser));
 isset($idUser)? $infos=$obj->Requete('SELECT * FROM users u, learner l WHERE l.IDUSER=u.IDUSER AND u.IDUSER="'.$idUser.'"') : $infos=null;

    header('Location','student-profile.php');

endif;
?>



<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>C2if</title>
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
        <?php include('mobile.php');?>
        <!-- Single pro tab review Start-->
        <div class="single-pro-review-area mt-t-30 mg-b-15">
            <div class="container-fluid">
                <?php if(is_object($infos)): $infos = $infos->fetch();?>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <div class="profile-info-inner">
                                <div class="profile-img">
                                    <img src="img/profile/prof.jpg" alt="" />
                                </div>
                                <div class="profile-details-hr">
                                    <div class="row">
                                        <div class="col-6">
                                            <b>Nom d'utilisateur:</b>
                                        </div>
                                        <div class="col-6">
                                            <p><?=$infos['USERNAME']?></p>
                                        </div>
                                        <div class="col-6">
                                            <b>Nom:</b>
                                        </div>
                                        <div class="col-6">
                                            <p><?=$infos['LASTNAME']?></p>
                                        </div>
                                        <div class="col-6">
                                            <b>Prenom:</b>
                                        </div>
                                        <div class="col-6">
                                            <p><?=$infos['LEARNERFIRSTNAME']?></p>
                                        </div>
                                        <div class="col-6">
                                            <b>Email:</b>
                                        </div>
                                        <div class="col-6">
                                            <p><?=$infos['EMAIL']?></p>
                                        </div>
                                        <div class="col-6">
                                            <b>Telephone:</b>
                                        </div>
                                        <div class="col-6">
                                            <p><?=$infos['TELEPHONE']?></p>
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
                                        <form method="post" action="student-profile.php">
                                            <div class="row ">
                                                <div class="input-group col-sm-12 col-md-6 mb-3 ">
                                                    <input class="form-control w-75 <?php if (isset($getmsg)): ?> border border-danger text-danger<?php endif ?>" type="text" name="login_username" id="login_username" placeholder="Nom d'utilisateur..." required>

                                                </div>
                                                <div class="input-group col-sm-12 col-md-6 mb-3 ">
                                                    <input class="form-control w-75 <?php if (isset($getmsg)): ?> border border-danger text-danger<?php endif ?>" type="text" name="login_fname" id="login_fname" placeholder="Nom..." required>

                                                </div>

                                                <div class="input-group col-sm-12 col-md-6 mb-3">
                                                    <input class="form-control w-75 <?php if (isset($getmsg)): ?> border border-danger <?php endif ?>" type="text" name="login_lname" id="login_lname" placeholder="Prenom..." required>

                                                </div>
                                                <div class="input-group col-sm-12 col-md-6 mb-3">
                                                    <input class="form-control w-75 <?php if (isset($getmsg)): ?> border border-danger <?php endif ?>" type="email" name="login_email" id="login_email" placeholder="Email..." required>

                                                </div>
                                                <div class="input-group col-sm-12 col-md-6 mb-3">
                                                    <input class="form-control w-75 <?php if (isset($getmsg)): ?> border border-danger <?php endif ?>" type="number" name="login_phone" id="login_phone" placeholder="tel..." required>

                                                </div>
                                                <div class="col-12 text-center my-4">
                                                    <input name="submit" class="btn primeBack text-white w-50 rounded-pill" type="submit" value="Enregistrer">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php include('footer.php');?>
</body>

</html>