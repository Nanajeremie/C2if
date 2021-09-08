<?php
include("../../utilities/QueryBuilder.php");
$obj = new QueryBuilder();
// Recuperation du matricule de learner
isset($_SESSION['IDUSER'])?
    $idLearner=$obj->Select('learner', array('MATRICULE'), array('IDUSER'=>$_SESSION['IDUSER']))->fetch()['MATRICULE']:$idLearner=1;

// la progresion de la lecture
$sql = "SELECT * FROM subcription, subject, course 
            WHERE subcription.MATRICULE='".$idLearner."' 
                AND subcription.PROGRESS < 100 
                AND subcription.IDCOURSE= course.IDCOURSE 
                AND subcription.AMOUNTPAID >= course.AMOUNT
                AND course.IDSUBJECT = subject.IDSUBJECT 
                    ORDER BY subcription.PROGRESS DESC 
                    LIMIT 4";
$progresses = $obj->Requete($sql);


// selections des matieres
$subjects = $obj->Select('subject',[],[]);

// termair pour recuperation et filtrage de cours par matiere
!isset($_GET['idMatiere'])? $courses = $obj->Select('course',[],[]) : $courses = $obj->Select('course',[],['IDSUBJECT'=>$_GET['idMatiere']]);



?>


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
        <div class="analytics-sparkle-area mb-3">
            <div class="container-fluid">
                <div class="card shadow">
                    <div class="card-header">
                            <div class="col-12 text-center h5 text-muted font-weight-bold primeTxt">Les cours en cours de lecture</div>
                    </div>
                    <div class="card-body">
                        <?php if(isset($progresses) AND $progresses->rowCount()>0):?>
                        <div class="row">
                            <?php while($progresse=$progresses->fetch()):?>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 ">
                                <div class="analytics-sparkle-line reso-mg-b-30 shadow">
                                    <div class="analytics-content">
                                        <h5><?=$progresse['COURSETITLE']?></h5>
                                        <h2><span class="h5"> <a href="#">Continuer la lecture</a></span> <span class="tuition-fees">Progression</span></h2>
                                        <span class="text-<?=$progresse['COLOR']?>"><?=$progresse['PROGRESS']?>%</span>
                                        <div class="progress m-b-0">
                                            <div class="progress-bar progress-bar-<?=$progresse['COLOR']?>" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:20%;"> <span class="sr-only"><?=$progresse['PROGRESS']?>% Complete</span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile ?>
                        </div>
                        <?php else:?>
                            <div class="row justify-content-center">
                                <span>Vos pressions s'afficherons ici, une fois souscrire !!!</span>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div> <br>
        <div class="courses-area mb-3">
            <div class="container-fluid">
                <?php
                if (is_object($subjects)):
                ?>
                <div class="card shadow">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-12">
                                <p class="text-center">Veuillez chosir une categorie pour vour la liste des cours disponible</p>
                            </div>
                            <?php while ($subject=$subjects->fetch()): ?>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-2 mb-3">
                                <a href="all-courses.php?idMatiere=<?=$subject['IDSUBJECT']?>">
                                    <button class="btn btn-outline-<?=$subject['COLOR']?> w-100" type="button"><?=$subject['SUBJECTNAME']?></button>
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
                                <div class="card border-<?=$matiere['COLOR']?> shadow">
                                    <div class="card-header bg-<?=$matiere['COLOR']?>">
                                        <div class="row ">
                                            <div class="col-12">
                                                <h6 class="text-center text-white"> <?=$course['COURSETITLE']?></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body " style="background-image:url(../assets/img/formation-elec.jpg);background-size: cover;background-position: center;height:200px;width:100%">
                                    </div>
                                    <div class="card-footer border-<?=$matiere['COLOR']?> bg-<?=$matiere['COLOR']?>">
                                        <div class="row small">
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Durée: </Strong></div>
                                                    <div class="col-6"><?=isset($course['DURATION'])?$course['DURATION'].' jours':'Indefinie'?> </div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Prix: </Strong></div>
                                                    <div class="col-6"><?=$course['AMOUNT']?> Fcfa</div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Difficulté: </Strong></div>
                                                    <div class="col-6"><?=$course['LEVEL']?></div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-white mt-2 text-right">
                                            <a href="../cours_details.php?idCourse=<?=$course['IDCOURSE']?>" class="btn btn-light px-1 py-0  text-danger"><i class="fa fa-eye  text-danger " aria-hidden="true"></i> Suivre</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                        <?php else:?>
                        <div class="">Oops!!! Pas de cours</div>
                        <?php endif;?>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
                <?php else:?>
                    <div class=""> Oops!!! Pas de matieres</div>
                <?php endif?>
            </div>
        </div>
        <?php include('footer.php');?>
</body>

</html>