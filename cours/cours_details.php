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

if(isset($_SESSION['IDUSER'])){
    $id_user = $_SESSION['IDUSER'];

    // on recupere la date actuelle dans le serveur
    $curretDate = $obj->Requete("SELECT NOW() AS Date");
    $curretDate = $curretDate->fetch();
    $simpleDate =$curretDate['Date'];
    $curretDate = convertDate($simpleDate,'j F Y');

    // @jeremie recuperation de l'id du cours
    if(isset($_GET['idCourse'])){
        $id_course =$_GET['idCourse'];
        
    // on verify si llecteur n'est pas deja inscrit a ce cours
    $targetLearner = $obj->Requete("SELECT * FROM subcription s, learner l, course c WHERE s.MATRICULE=l.MATRICULE AND s.ACCEPT=2 AND s.IDCOURSE=c.IDCOURSE AND s.ISDONE=0 AND s.IDCOURSE='".$id_course."' AND l.IDUSER='".$id_user."'");
    if($getResp = $targetLearner->fetch()){
        Redirect('learner/');
    }else{
    // on verifie s'il n'a pas des paiments innachever
    $check_Pay_No_Done = $obj->Requete("SELECT * FROM subcription s, learner l WHERE s.MATRICULE=l.MATRICULE AND s.ACCEPT!=2 AND l.IDUSER='".$id_user."'");
    
    // On verify s'il n'avait pas deja envoye la preuve du cours courant
    $check_Current_Pay_No_Done = $obj->Requete("SELECT * FROM subcription s, learner l, course c, subject su WHERE s.MATRICULE=l.MATRICULE AND s.ACCEPT!=2 AND s.IDCOURSE=c.IDCOURSE AND c.IDSUBJECT=su.IDSUBJECT AND s.IDCOURSE='".$id_course."' AND l.IDUSER='".$id_user."'")->fetch();
    
    
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
    <div class="container-fluid mt-1 mb-5">
        <?php if(isset($userInfo) AND isset($coursInfo)):$userInfo=$userInfo->fetch();
        $coursInfo=$coursInfo->fetch();
        ?>
            <form method="post" action="#" id="suscription-form">
                <!-- Cet input permet de rediriger -->
                <input type="text" name="last-part" id="last-part" value="<?=(isset($check_Current_Pay_No_Done['IMG']))?2:(isset($check_Current_Pay_No_Done['PHONE'])?1:0)?>" hidden>
                <div class="row" id="back">
                    <div class="col-sm-12 col-md-5 col-lg-4">
                        <div class="card shadow mt-5 bg-danger border-light">
                            <div class="card-body bg-white ml-2">
                                <div class="row mb-3">
                                    <div class="col-12 text-danger uppercase mb-3 text-center font-weight-bold"><?=isset($check_Current_Pay_No_Done['SUBJECTNAME'])?$check_Current_Pay_No_Done['SUBJECTNAME']:$coursInfo['SUBJECTNAME']?></div>
                                    <div class="col-12 font-weight-bold mb-2"><?=isset($check_Current_Pay_No_Done['COURSETITLE'])?$check_Current_Pay_No_Done['COURSETITLE']:$coursInfo['COURSETITLE']?></div>
                                    <div class="col-12"> <i class="fa fa-clock fa-1x text-muted " aria-hidden="true"></i> <?=isset($check_Current_Pay_No_Done['DURATION'])?$check_Current_Pay_No_Done['DURATION']:$coursInfo['DURATION']?> de formation </div>
                                    <div class="col-12"> <i class="fa fa-book fa-1x text-muted" aria-hidden="true"></i>  Vous devez faire des devoir pour valider </div>
                                    <div class="col-12"> <i class="fa fa-graduation-cap fa-1x text-muted" aria-hidden="true"></i> niveau <?=isset($check_Current_Pay_No_Done['DURATION'])?$check_Current_Pay_No_Done['LEVEL']:$coursInfo['LEVEL']?></div>
                                </div>
                                <hr class=" bg-danger" style="width:100%; height:1px;">
                                <div class="row">
                                    <div class="col-12 text-dark font-weight-bold"><?=isset($check_Current_Pay_No_Done['SUBSCRIPTIONDATE'])?convertDate($check_Current_Pay_No_Done['SUBSCRIPTIONDATE'],'j F Y'):$curretDate?></div>
                                    <div class="col-12  text-muted">Votre formation commence aujourd'hui</div>
                                </div>
                                <hr class=" bg-danger">
                                <div class="row">
                                    <div class="col-12 text-dark font-weight-bold"><?=isset($check_Current_Pay_No_Done['AMOUNT'])?$check_Current_Pay_No_Done['AMOUNT']:$coursInfo['AMOUNT']?> Fcfa</div>
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
                                                <input type="text" name="id_user" id="id-user" value="<?=isset($check_Current_Pay_No_Done['MATRICULE'])?$check_Current_Pay_No_Done['MATRICULE']:$userInfo['MATRICULE']?>" hidden>
                                                <input type="text" name=" id_course" id="id-course" value="<?php echo $id_course?>" hidden >
                                                <input value="<?=isset($check_Current_Pay_No_Done['LASTNAME'])?$check_Current_Pay_No_Done['LASTNAME']:$userInfo['LASTNAME']?>" name="learner-lname" type="text" id="learner-name" class="form-control" placeholder="Nom" readonly>
                                            </div>
                                            <div class="input-group col-sm-12 col-md-6 mb-3">
                                                <input value="<?=isset($check_Current_Pay_No_Done['LEARNERFIRSTNAME'])?$check_Current_Pay_No_Done['LEARNERFIRSTNAME']:$userInfo['LEARNERFIRSTNAME']?>" type="text" name="learner-fame" id="learner-fame" class="form-control" placeholder="Prenom" readonly>
                                            </div>
                                            <div class="input-group col-sm-12 col-md-6 mb-3">
                                                <input value="<?=isset($check_Current_Pay_No_Done['EMAIL'])?$check_Current_Pay_No_Done['EMAIL']:$userInfo['EMAIL']?>" type="email" class="form-control" name="learner-email" id="learner-email" placeholder="Email" readonly>
                                            </div>
                                            <div class="input-group col-sm-12 col-md-6 mb-3">
                                                <input type="text" class="form-control" placeholder="Code postal" name="learner-postal" id="learner-postal" value="<?=isset($check_Current_Pay_No_Done['POSTAL'])?$check_Current_Pay_No_Done['POSTAL']:''?>">
                                            </div>
                                            <div class="input-group col-sm-12 col-md-6 mb-3">
                                                <input type="text" class="form-control" placeholder="Votre adresse" name="learner-address" id="learner-address" value="<?=isset($check_Current_Pay_No_Done['ADRESS'])?$check_Current_Pay_No_Done['ADRESS']:''?>">
                                            </div>
                                            <div class=" col-sm-12 col-md-6 mb-3">
                                                <Select class="input-group w-100" name="learner-country" id="learner-country">
                                                    <option value="<?=isset($check_Current_Pay_No_Done['COUNTRY'])?$check_Current_Pay_No_Done['COUNTRY']:'Pays'?>" class="form-control"><?=isset($check_Current_Pay_No_Done['COUNTRY'])?$check_Current_Pay_No_Done['COUNTRY']:'Selectionner votre pays'?></option>
                                                    <option value="Burkina Faso" class="form-control">Burkina Faso</option>
                                                    <option value="Benin" class="form-control">Benin</option>
                                                </Select>
                                            </div>
                                            <div class="input-group col-sm-12 col-md-6 mb-3">
                                                <input type="number" class="form-control" placeholder="Telephonel" name="learner-phone" id="learner-phone" value="<?=isset($check_Current_Pay_No_Done['PHONE'])?$check_Current_Pay_No_Done['PHONE']:''?>">
                                            </div>
                                            <div class="input-group col-sm-12 col-md-6 mb-3">
                                                <input type="text" name="learner-promo" id="learner-promo" class="form-control" placeholder="Code secret promo">
                                            </div>
                                            <hr>
                                            <div class="form-check-inline col-sm-12 col-md-12 mb-4 ml-3">
                                                <input type="checkbox" class="form-check-input" name="learner-agree" id="learner-agree" value="1" <?=isset($check_Current_Pay_No_Done['IMG'])?'checked':''?>>Vous accepter les conditions d'utilisations
                                            </div>
                                            <div class="col-12" id="submitError"></div>
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
                                    <div class="col-12"> <i class="fa fa-money-check fa-1x text-muted " aria-hidden="true"></i><b class="text-danger">Montant total: <?=isset($check_Current_Pay_No_Done['AMOUNT'])?$check_Current_Pay_No_Done['AMOUNT']:$coursInfo['AMOUNT']?> Fcfa</b></div>
                                </div>
                                <hr class="primeBack" style="width:100%; height:1px;">
                                <div class="col-12 mb-2">Choisissez votre moyen de paiement </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="learner-pay-mod" id="learner-pay-mod" value="Orange" checked>Paiement par Orange Money
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="learner-pay-mod " id="learner-pay-mod" value="Telmob">Paiement par Mobicash
                                    </label>
                                </div>
                                <hr class="primeBack">
                                <div class="col-12 font-weight-bold">NB: verifier vos informations</div>
                                <div class="row mt-2">
                                    <div class="col-12 text-dark font-weight-bold text-right">
                                        <button type="button" class="btn btn-secondary" data-toggle="collapse" data-parent="#accordion" onclick="checkAccount()"> Suivant</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center" >
                <div class="col-sm-12 col-md-5" id="suite">
                        <div class="card shadow mt-5 primeBack border-light">
                            <div class="card-body bg-white ml-2">
                                <div class="row mb-3 justify-content-start">
                                    <div class="col-12 primeTxt uppercase mb-3 text-center font-weight-bold">Finaliser le paiement</div>
                                    <div class="col-12"> <i class="fa fa-money-check fa-1x text-muted " aria-hidden="true"></i><b class="text-danger">Montant total: <?=$coursInfo['AMOUNT']?> Fcfa</b><input type="text" name="course-amount" id="course-amount" value="<?=isset($check_Current_Pay_No_Done['AMOUNT'])?$check_Current_Pay_No_Done['AMOUNT']:$coursInfo['AMOUNT']?>" hidden><input type="text" name="souscript-date" id="souscript-date" value="<?=$simpleDate?>" hidden></div>
                                </div>
                                <p class="col-12 mb-2">Pour valider votre paiement, veuillez faire un depot du montant ci-dessus sur le numero <b class="text-danger">+226 66 66 66 66</b> et prenez une capture d'ecran du message de confirmation ensuite vous selectionner l'image du caputre d'ecran en cliquant sur le button <b class="primeTxt ">Image de Confirmation</b>  en dessous et cliquer sur <b class="text-success">Valider</b> pour teminer</p>
                                <div class="row mt-2">
                                <hr class="" style="width:100%; height:1px;">
                                <div class="col-12 form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend col-12">
                                                <button type="button" class=" btn primeBack text-white input-group-text"><label for="learner-validate-img">Image de Confirmation</label></button>
                                                <input type="text" name="validate-img-name" id="validate-img-name"  class="w-100" placeholder="Pas de fichier" value="<?=isset($check_Current_Pay_No_Done['IMG'])?$check_Current_Pay_No_Done['IMG']:''?>" disabled>
                                                <input type="file" name="learner-validate-img" id="learner-validate-img" class="form-control d-none" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 text-dark font-weight-bold">
                                        <div class="row mt-3">
                                            <div class="col-6">
                                                <button type="button" class="btn btn-danger" onclick="{document.getElementById('suite').style.display='none';document.getElementById('back').style.display='flex' }" > Retour</button>
                                            </div>
                                            <div class="col-6 text-right">
                                                <button  class="btn btn-success" type="button" onclick="goPayLast()"> Valider</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3" id="validateError"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center" id="start">
                        <div class="col-sm-12 col-md-5">
                            <div class="card shadow mt-5 primeBack border-light">
                                <div class="card-body bg-white ml-2">
                                    <div class="row mb-3 justify-content-start">
                                        <div class="col-12 primeTxt uppercase mb-3 text-center font-weight-bold">Etape de confirmation</div>
                                    </div>
                                    <p class="col-12 mb-2" id="start-infos">Vous etes a la derniere etape. Veuillez patienter, votre preuve de paiement est en cours de verification.<br> Une fois la verification terminer, vous pouvez commencer la lecture juste en cliquant sur le button <strong class="text-success">Commencer</strong></p>
                                    <div class="row mt-2">
                                        <div class="col-12 text-dark font-weight-bold">
                                            <div class="row mt-3 ">
                                                <div class="col-6">
                                                    <button  class="btn btn-secondary" type="button" onclick="goPayImage()"> Retour</button>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <button  class="btn btn-success" type="button" onclick="checkConfirm()"> Commencer</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3" id="readError"></div>
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

   <?php } }
   else{Redirect('cours.php');}
    include'footer2.php';} 
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

            $("#last-part").val()==2?part3():$("#last-part").val()==1?part2():$("#last-part").val()==0?part1():'';
            

            function part1(){
                document.getElementById('suite').style.display='none';
                document.getElementById('start').style.display='none';
                document.getElementById('back').style.display='flex';
            }
            function part2(){
                document.getElementById('back').style.display='none';
                document.getElementById('suite').style.display='flex';
                document.getElementById('start').style.display='none';
            }
            function part3(){
                document.getElementById('back').style.display='none';
                document.getElementById('suite').style.display='none';
                document.getElementById('start').style.display='flex';
            }

            function goPayImage(){
                part2();
            }
            function targetDashboard(){

            }
            function goPayLast(){
                if($('#learner-validate-img')[0].files.length === 0 && $("#validate-img-name").val()==""){
                    $("#validateError").html("Veuillez selectionner la preuve");
                    $("#validateError").css('color','red');
                }else if($('#learner-validate-img')[0].files.length === 0 && $("#validate-img-name").val()!=""){
                    part3();
                }else{
                    uploadData();
                    part3();
                }
            }

            // recupereration du nom de l'image 
            $("#learner-validate-img").change(function(even){
                $("#validate-img-name").val(even.target.files[0].name);
            });

            //verification des details du compte
            function checkAccount(){
                var learner_fame = $("#learner-fame").val();
                var learner_lame = $("#learner-lame").val();
                var learner_email = $("#learner-email").val();
                var learner_postal = $("#learner-postal").val();
                var learner_country =$("#learner-country option:selected").val();
                var learner_phone=$("#learner-phone").val();
                var learner_address=$("#learner-address").val();
                var learner_promo=$("#learner-promo").val();
                var learner_agree=$("#learner-agree");

                if(learner_postal =="" || learner_country =="Pays" ||
                 learner_fame =="" || learner_lame =="" ||
                  learner_email =="" || learner_postal =="" ||
                   learner_phone =="" || learner_address==""
                     ){
                        $("#submitError").html('Tout les champs sont obligatoire');
                        $("#submitError").css('color','red');
                    }else{
                        if(!learner_agree.is(':checked')){
                            $("#submitError").html("Veuillez accepter les conditions d'utilisation");
                            $("#submitError").css('color','red');
                        }else{
                            document.getElementById('suite').style.display='flex';
                            document.getElementById('back').style.display='none';
                        }
                        
                    }
                }

            // cette fonction est charger d'envoyer un nouveau post  learner-name

            function uploadData(){
                var id_user =$("#id-user").val();
                var id_course =$("#id-course").val();
                var learner_fame =$("#learner-fame").val();
                var learner_lame =$("#learner-lame").val();
                var learner_email =$("#learner-email").val();
                var learner_postal =$("#learner-postal").val();
                var learner_country =$("#learner-country option:selected").val();
                var learner_phone=$("#learner-phone").val();
                var learner_address=$("#learner-address").val();
                var learner_promo=$("#learner-promo").val();
                var learner_agree=$("#learner-agree");
                var learner_pay_mod=$("input[name='learner-pay-mod']:checked").val();
               
                if($('#learner-validate-img')[0].files.length === 0){
                    $("#validateError").html("Veuillez selectionner la preuve");
                    $("#validateError").css('color','red');
                }else{
                   
                    // Extension acceptee
                    var img_ext_arr=['.jpg','.png','.jpeg'];

                    // Extension des fichier selectionnee
                    img_ex ='.'+$("#validate-img-name").val().split('.')[$("#validate-img-name").val().split('.').length-1];

                        // si l'extension de l'image n'est pas valide
                    if(img_ext_arr.includes(img_ex.toLowerCase())==false){
                        $("#validateError").html("Cet format d'image n'est pas valide");
                        $("#validateError").css('color','red');
                    }else{
                        var fd = new FormData();
                        var files = $("#learner-validate-img")[0].files[0];
                        fd.append('learner_img',files);
                        $.ajax({
                            url: 'admin/ajax/ajax.php',
                            type:'post',
                            data:fd,
                            contentType:false,
                            processData:false,
                            dataType:'json',
                            success:function(response){
                                
                                if(response.status==1){
                                    $.post(
                                    'admin/ajax/ajax.php', {
                                        sus_key:'sus_key',
                                        id_course:id_course,
                                        id_user: id_user,
                                        amount:$("#course-amount").val(),
                                        suscrip_date:$("#souscript-date").val(),
                                        learner_address:learner_address,
                                        learner_postal:learner_postal,
                                        payement_type:learner_pay_mod,
                                        learner_country:learner_country,
                                        learner_phone:learner_phone,
                                        file_name:response.message,
                                    }, function (donnees){
                                            if(donnees == 1){
                                                document.getElementById("suscription-form").reset();
                                                part3();
                                                }
                                            else{
                                                $("#validateError").html("Echec d'enregistrement");
                                                $("#validateError").css('color','red');
                                            }
                                        });
                                    }
                                else{
                                    $("#submitError").html(response.message);
                                    $("#submitError").css('color','red');
                                }
                            }
                        });
                    }
                } 
            }

            // Verification de la preuve de paiement
            function checkConfirm(){
                $.post(
                    'admin/ajax/ajax.php', {
                        check_pay:"sub_ref_key",
                         id_user :$("#id-user").val(),
                         id_course :$("#id-course").val(),
                    },
                    function (donnees){
                        if(donnees==1){
                            $("#start-infos").html('<span class="text-danger">Votre preuve de paiement est toujours en cours de verification.<br> Une fois la verification terminer, vous pouvez commencer la lecture juste en cliquant sur le button <strong class="text-success">Commencer</strong></span>');
                        }else if(donnees==0){
                            $("#start-infos").html('<span class="text-danger">Votre preuve de paiement a ete rejetee. Peut etre que vous n\'avez pas envoyee l\'argent ou la photo de la preuve est illisible cliquer sur le button <strong class="text-secondary">Retour</strong> pour renvoyer la preuve de paiement</span>');
                        }
                    });
                }

        </script>
    </body>
</html>		