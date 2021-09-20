<?php
include("../utilities/QueryBuilder.php");
$obj = new QueryBuilder();

//on verifie que les sessions existe sinon on le renvoit vers la page de connection
if(isset($_SESSION['IDUSER'])){
    $id_user = $_SESSION['IDUSER'];

    // on verifie qu'il s'est deja inscrit a un cours si oui on le renvoit directement vers son dashbord
    $check_learner_susp = $obj->Requete("SELECT * from subcription s, learner l WHERE s.MATRICULE = l.MATRICULE AND l.IDUSER='".$id_user."'");
    if($check_learner_susp->rowCount()>=1){
       Redirect("learner/");
    }
    else{
        $subjects = $obj->Select('subject',[],[]);
        !isset($_GET['idMatiere'])? $courses = $obj->Select('course',[],[]) : $courses = $obj->Select('course',[],['IDSUBJECT'=>$_GET['idMatiere']]);
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
        <?php if (is_object($subjects)):?>
        <div class="row">
            <div class="col-12">
                <div class="card mt-5 cardBor">
                <div class="card-header ">
                        <div class="row">
                            <div class="col-12">
                                <p class="text-center">Veuillez chosir une categorie pour vour la liste des cours disponible</p>
                            </div>
                            <?php while ($subject=$subjects->fetch()): ?>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-2 mb-3">
                                <a href="all-courses.php?idMatiere=<?=$subject['IDSUBJECT']?>">
                                    <button class="btn btn-outline-primary w-100" type="button"><?=$subject['SUBJECTNAME']?></button>
                                </a>
                            </div>
                            <?php endwhile;?>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if(is_object($courses)):?>
                        <div class="row">
                            <?php while($course=$courses->fetch()): $matiere=$obj->Select('subject',[],['IDSUBJECT'=>$course['IDSUBJECT']])->fetch();?>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                                <div class="card border border-primary shadow ">
                                    <div class="card-body ">
                                        <div class="row justify-content-center">
                                            <div class="col-10">
                                                <img src="assets/fichier_cours/<?=$course['COURSCOVER']?>" alt="" width="100%" height="100px">
                                            </div>
                                        </div>
                                        <div class="row ">
                                            <div class="col-12">
                                                <h6 class="text-center text-muted my-3"> <?=$course['COURSETITLE']?></h6>
                                            </div>
                                        </div>
                                        <div class="row small">
                                            <div class="col-12 ">
                                                <div class="row">
                                                    <div class="col-4"><Strong>Durée: </Strong></div>
                                                    <div class="col-8"><?=isset($course['DURATION'])?$course['DURATION'].' jours':'Indefinie'?> </div>
                                                </div>
                                            </div>
                                            <div class="col-12 ">
                                                <div class="row">
                                                    <div class="col-4"><Strong>Prix: </Strong></div>
                                                    <div class="col-8"><?=$course['AMOUNT']?> Fcfa</div>
                                                </div>
                                            </div>
                                            <div class="col-12 ">
                                                <div class="row">
                                                    <div class="col-4"><Strong>Niveau: </Strong></div>
                                                    <div class="col-8"><?=$course['LEVEL']?></div>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2 text-center">
                                            <a href="../cours_details.php?idCourse=<?=$course['IDCOURSE']?>" class="btn btn-primary px-1 py-0  text-white"><i class="fa fa-eye  text-white " aria-hidden="true"></i> Suivre</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile;?>
                        </div>
                        <?php endif;?>
                    </div>
                    <div class="card-footer "></div>
                </div>
            </div>
        </div>
        <?php else:?>
        <div class="">
            <span>Desoler, pas de cours dans la base de donnees !!!</span>
        </div>
        <?php endif;?>
    </div>
       
   <?php } include'footer2.php';} 
   else{
       Redirect('index.php');
    }?>
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