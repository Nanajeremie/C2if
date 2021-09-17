<?php

function convertDate($date, $format ){
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date) ) ) );
 }


include("../utilities/QueryBuilder.php");
$obj=new QueryBuilder();
// on recupere la date actuelle dans le serveur
$curretDate = $obj->Requete("SELECT NOW() AS Date");
$curretDate = convertDate($curretDate->fetch()['Date'],'j F Y');


if(isset($_SESSION['IDUSER'])){
}
isset($_SESSION['IDUSER'])?
    $userInfo=$obj->Requete("SELECT * FROM learner, users
                                        WHERE learner.IDUSER=users.IDUSER
                                        AND users.IDUSER=".$_SESSION['IDUSER'])
    :$userInfo=null;


isset($_GET['idCourse'])?
    $coursInfo=$obj->Requete("SELECT * FROM course, subject
                                        WHERE subject.IDSUBJECT=course.IDSUBJECT
                                        AND course.IDCOURSE=".$_GET['idCourse'])
    :$coursInfo=null;
?>

<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Acceuil</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="shortcut icon" type="image/x-icon" href="assets/img/logo.jpg">

		<!-- CSS here -->
            <link rel="stylesheet" href="assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="assets/css/bootstrap.css">
            <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
            <link rel="stylesheet" href="assets/css/flaticon.css">
            <link rel="stylesheet" href="assets/css/slicknav.css">
            <link rel="stylesheet" href="assets/css/animate.min.css">
            <link rel="stylesheet" href="assets/css/magnific-popup.css">
            <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="assets/css/themify-icons.css">
            <link rel="stylesheet" href="assets/css/slick.css">
            <link rel="stylesheet" href="assets/css/nice-select.css">
            <link rel="stylesheet" href="assets/css/style.css">
            <link rel="stylesheet" href="assets/css/main.css">
            <link rel="stylesheet" href="Opensch_final_version\Web-Application-Coding\assets\css\style.css">
        
   </head>

   <body>
     
    <script src="./assets/js/jquery-3.4.0.min.js"></script>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo.jpg" alt="logo">
                </div>
            </div>
        </div>
    </div>
	      
    <!-- Preloader Start -->

    <header>
        <!-- Header Start -->
       <div class="header-area">
            <div class="main-header ">
                <div class="header-top top-bg d-none d-lg-block">
                   <div class="container-fluid">
                       <div class="col-xl-12">
                            <div class="row d-flex justify-content-between align-items-center">
                                <div class="header-info-left">
                                    <ul>
                                        <li><i class="fas fa-envelope" ></i>c2ifburkina@yahoo.com</li>
                                    </ul>
                                </div>
                                <div class="header-info-right">
                                    <ul class="header-social">   
                                        <li><a href="#"><i class="fab fa-yahoo"></i></a></li>
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                       <li> <a href="#"><i class="fab fa-google-plus-g"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                       </div>
                   </div>
                </div>
            </div>
       </div>
    </header>
    <div class="footer-bottom-area ">
        <div class="container-fluid ">
            <div class="row">
                <img src="assets/img/barner.png" class="img-fluid" style="width:100%; height:250px">
            </div>
        </div>
    </div>
    
    <!-- @Jeremie => Affichage des cours -->
    <div class="container-fluid my-5">
        <?php if(isset($userInfo) AND isset($coursInfo)):$userInfo=$userInfo->fetch();
        $coursInfo=$coursInfo->fetch();
        ?>
            <form method="post" action="">
                <div class="row">
                    <div class="col-sm-12 col-md-5 col-lg-4">
                        <div class="card shadow mt-5 bg-danger border-light">
                            <div class="card-body bg-white ml-2">
                                <div class="row mb-3">
                                    <div class="col-12 text-danger uppercase mb-3 text-center font-weight-bold"><?=$coursInfo['SUBJECTNAME']?></div>
                                    <div class="col-12 font-weight-bold mb-2"><?=$coursInfo['COURSETITLE']?></div>
                                    <div class="col-12"> <i class="fa fa-clock fa-1x text-muted " aria-hidden="true"></i>  <?=$coursInfo['DURATION']?> de formation </div>
                                    <div class="col-12"> <i class="fa fa-book fa-1x text-muted" aria-hidden="true"></i>  Vous devez faire des devoir pour valider </div>
                                    <div class="col-12"> <i class="fa fa-graduation-cap fa-1x text-muted" aria-hidden="true"></i> niveau <?=$coursInfo['LEVEL']?></div>
                                </div>
                                <hr class=" bg-danger" style="width:100%; height:1px;">
                                <div class="row">
                                    <div class="col-12 text-dark font-weight-bold"><?php echo $curretDate?></div>
                                    <div class="col-12  text-muted">Votre formation commence aujourd'hui</div>
                                </div>
                                <hr class=" bg-danger">
                                <div class="row">
                                    <div class="col-12 text-dark font-weight-bold"><?=$coursInfo['AMOUNT']?> Fcfa</div>
                                    <div class="col-12  text-muted">Vous pouvez annuler l'abonnement</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-7 col-lg-5">
                        <div class="card shadow mt-5 primeBack border-light">
                            <div class="card-body bg-white ml-2">
                                <div class="row mb-3">
                                    <div class="col-12 primeTxt uppercase mb-3 text-center font-weight-bold">Detail du compte</div>
                                    <div class="col-12 mt-4">
                                        <div class="row">
                                            <div class="input-group col-sm-12 col-md-6 mb-3">
                                                <input value="<?=$userInfo['LASTNAME']?>" type="text" class="form-control" placeholder="Nom" readonly>
                                            </div>
                                            <div class="input-group col-sm-12 col-md-6 mb-3">
                                                <input value="<?=$userInfo['LEARNERFIRSTNAME']?>" type="text" class="form-control" placeholder="Prenom" readonly>
                                            </div>
                                            <div class="input-group col-sm-12 col-md-6 mb-3">
                                                <input value="<?=$userInfo['EMAIL']?>" type="email" class="form-control" placeholder="Email" readonly>
                                            </div>
                                            <div class="input-group col-sm-12 col-md-6 mb-3">
                                                <input type="text" class="form-control" placeholder="Code postal">
                                            </div>
                                            <div class="input-group col-sm-12 col-md-6 mb-3">
                                                <input type="text" class="form-control" placeholder="Votre adresse">
                                            </div>
                                            <div class=" col-sm-12 col-md-6 mb-3">
                                                <Select class="input-group w-100">
                                                    <option value="Pays" class="form-control">Selectionner votre pays</option>
                                                    <option value="Pays" class="form-control">Votre pays</option>
                                                    <option value="Burkina Faso" class="form-control">Burkina Faso</option>
                                                    <option value="Benin" class="form-control">Benin</option>
                                                </Select>
                                            </div>
                                            <div class="input-group col-sm-12 col-md-6 mb-3">
                                                <input type="number" class="form-control" placeholder="Telephonel">
                                            </div>
                                            <div class="input-group col-sm-12 col-md-6 mb-3">
                                                <input type="text" class="form-control" placeholder="Code secret si vous en avez">
                                            </div>
                                            <hr>
                                            <div class="form-check-inline col-sm-12 col-md-12 mb-4 ml-3">
                                                <input type="checkbox" class="form-check-input" value="1">Vous accepter les conditions d'utilisations
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-3">
                        <div class="card shadow mt-5 primeBack border-light">
                            <div class="card-body bg-white ml-2">
                                <div class="row mb-3">
                                    <div class="col-12 primeTxt uppercase mb-3 text-center font-weight-bold">Mode de paiement</div>
                                    <div class="col-12 font-weight-bold ">Conditions de paiement</div>
                                    <div class="col-12"> <i class="fa fa-money-check fa-1x text-muted " aria-hidden="true"></i><b class="text-danger">Montant total: <?=$coursInfo['AMOUNT']?> Fcfa</b></div>
                                </div>
                                <hr class=" primeBack" style="width:100%; height:1px;">
                                <div class="col-12 mb-2">Choisissez votre moyen de paiement</div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="optradio" checked>Paiement par Orange Money
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="optradio">Paiement par Mobicash
                                    </label>
                                </div>
                                <hr class="primeBack">
                                <div class="col-12 font-weight-bold">NB: verifier vos informations </div>
                                <div class="row mt-2">
                                    <div class="col-12 text-dark font-weight-bold">
                                        <a  class="btn btn-secondary" data-toggle="collapse" data-parent="#accordion" href="#collapse2" > Commencer le paiement</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        <?php else:?>
        <div class="row justify-content-center">
            <span class="col-3 text-center">Ooops, Vous devez d'abord vous authentifier et seletionner un cours !!!</span>
        </div>
        <?php endif;?>

    </div>

    <!-- Add course Modals-->
    <div id="collapse2" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered" >
                    <div class="modal-content ">
                        <div class="modal-close-area modal-close-df">
                            <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                        </div>
                        <div class="modal-body">
                            <form action="#" method="post" id="course-form">
                                <div class="row">
                                    <div class="col-12 mt-1 mb-5 h4 text-center">Ajouter un cours</div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                        <label for="course-cat" class="col-12">Categorie <strong class="text-danger">*</strong> : </label>
                                        <select name="course-cat" id="course-cat" class="form-control" onchange="manageError()"></select>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                        <label for="course-title" class="col-12">Titre <strong class="text-danger">*</strong> : </label>
                                        <input type="text" name="course-title" id="course-title" oninput="manageError()" class="form-control" placeholder="Titre du cours">
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                        <label for="course-price" class="col-12">Prix <strong class="text-danger">*</strong> : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <input type="number" name="course-price" id="course-price" class="form-control" oninput="manageError()" placeholder="Prix du cours">
                                                <div class=" input-group-text">F FCFA</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                        <label for="course-price" class="col-12">Difficultes<strong class="text-danger">*</strong> : </label>
                                        <select name="course-level" id="course-level" class="form-control" onchange="manageError()">
                                                <option value="0">Choisir la difficultes</option>
                                                <option value="0">Difficile</option>
                                                <option value="0">Moyen</option>
                                                <option value="0">Facil</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                        <label for="course-duration" class="col-12">Duree de formation <strong class="text-danger">*</strong> : </label>
                                        <input type="text" name="course-duration" id="course-duration" oninput="manageError()" class="form-control" placeholder="Duree necessaire">
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                        <label  class="col-12">Image de couverture <strong class="text-danger">*</strong> : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button type="button" class=" btn niceBgBleu text-white input-group-text"><label for="course-img">Selectionner</label></button>
                                                <input type="text" name="course-img-name" id="course-img-name"  class="w-100 pl-2" placeholder="Pas de fichier" disabled>
                                                <input type="file" name="course-img" id="course-img" class="form-control d-none " onchange="manageError()">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group ">
                                        <label class="col-12">Fichier <strong class="text-danger">*</strong> :</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button type="button" class=" btn niceBgBleu text-white input-group-text"><label for="course-content" class="">Selectionner</label></button>
                                                <input type="text" name="course-content-name" id="course-content-name" class="w-100 pl-2" placeholder="Pas de fichier" disabled>
                                                <input type="file" name="course-content" onchange="manageError()" id="course-content" class="form-control d-none ">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-12 form-group">
                                        <label class="col-12" for="course-description">Description: </label>
                                        <textarea type="text" oninput="manageError()" name="course-description" id="course-description" class="form-control" placeholder="Decrire le cours"></textarea>
                                    </div>
                                    <div class="col-12 my-3 h5" id="submitError"></div>
                                    <div class="col-12 text-right">
                                        <input type="button" name="course-reset" id="course-reset" class="btn btn-secondary text-white" value="Annuler">
                                        <input type="button" name="course-add" id="course-add" class="btn niceBgBleu text-white" onclick="uploadData()" value="Ajouter">
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
       
   <?php include'footer2.php';?>
	<!-- JS here -->
     
		<!-- All JS Custom Plugins Link Here here -->
        
        <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
        <script src="./assets/js/popper.min.js"></script>
        <script src="./assets/js/bootstrap.js"></script>
	    <!-- Jquery Mobile Menu -->
        <script src="./assets/js/jquery.slicknav.min.js"></script>

		<!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="./assets/js/owl.carousel.min.js"></script>
        <script src="./assets/js/slick.min.js"></script>
        <!-- Date Picker -->
        <script src="./assets/js/gijgo.min.js"></script>
		<!-- One Page, Animated-HeadLin -->
        <script src="./assets/js/wow.min.js"></script>
		<script src="./assets/js/animated.headline.js"></script>
        <script src="./assets/js/jquery.magnific-popup.js"></script>

		<!-- Scrollup, nice-select, sticky -->
        <script src="./assets/js/jquery.scrollUp.min.js"></script>
        <script src="./assets/js/jquery.nice-select.min.js"></script>
		<script src="./assets/js/jquery.sticky.js"></script>
        
        <!-- contact js -->
        <script src="./assets/js/contact.js"></script>
        <script src="./assets/js/jquery.form.js"></script>
        <script src="./assets/js/jquery.validate.min.js"></script>
        <script src="./assets/js/mail-script.js"></script>
        <script src="./assets/js/jquery.ajaxchimp.min.js"></script>
        
		<!-- Jquery Plugins, main Jquery -->	
        <script src="./assets/js/plugins.js"></script>
        <script src="./assets/js/main.js"></script>
        
        <script src="./assets/js/jquery.cycle.all.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                $('.slideshow').cycle({
                    fx:'fade'
                }); 
                $('.slideshow1').cycle({
                    fx:'slideX'
                }); $('.slideshow2').cycle({
                    fx:'wipe'
                }); $('.slideshow3').cycle({
                    fx:'fadeZoom'
                }); 
            });
        
        </script>
    </body>
</html>		