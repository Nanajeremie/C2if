<?php 
    include("../../utilities/QueryBuilder.php");
    $obj = new QueryBuilder();
    // Selection du cours courant
    if(isset($_GET['id_sub'])){
    $idSub = $_GET['id_sub'];
    $id_user = $_GET['id_user'];
    $coursesFollowed = $obj->Select( $table = 'course c, subcription s, learner l', $columns = array(), $status = array('l.MATRICULE'=>'s.MATRICULE', 's.IDCOURSE'=>'c.IDCOURSE', "s.IDSUBCRIPTION"=>$idSub), $orderBy = '', $order = 1);

    // Selection des autres cours a suivre
    $allCoursesFollowed = $obj->Select( $table = 'course c, subcription s, learner l', $columns = array(), $status = array('l.MATRICULE'=>'s.MATRICULE', 's.IDCOURSE'=>'c.IDCOURSE', "l.IDUSER"=>$id_user), $orderBy = '', $order = 1);
    $allCoursesFollowed1 = $obj->Select( $table = 'course c, subcription s, learner l', $columns = array(), $status = array('l.MATRICULE'=>'s.MATRICULE', 's.IDCOURSE'=>'c.IDCOURSE', "l.IDUSER"=>$id_user), $orderBy = '', $order = 1);

    // var_dump($allCoursesFollowed->fetchAll());
    
?>

<!doctype html>
<html class="no-js" lang="zxx">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>ReadPDF</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="shortcut icon" type="image/x-icon" href="assets/img/logo.jpg">

		<!-- CSS here -->
            <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="../assets/css/bootstrap.css">
            <link rel="stylesheet" href="../assets/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="../assets/css/main.css">
            <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.9.359/build/pdf.min.js"></script>
            <script src="./build/pdf.js"></script>
            <script src="../assets/js/jquery-3.4.0.min.js"></script>

            <!--modes de lectures des cours et adaptation avec les ecran  -->

           
    </head>

    <body onload="currentFile()">
    <?php  if ($course = $coursesFollowed->fetch()){?><input type="text" name="file-name" id="file-name" value="<?= $course['COURSECONTENT'] ?>" hidden><?php } ?>
        <!-- <input type="text" name="scaleNum" id="scaleNum" value="2" hidden>; -->
        <div class="container-fluid mainFrame mt-0" >
            <div class="row d-flex">
                    <div class=" courseDetail bg-dark text-white">
                        <div class="mt-4">
                            <form method="post" id="form_reader">
                                <div class="row text-center">
                                    <div class="col-6 mb-3">
                                        <button class="btn btn-danger" id="prece">Precedent</button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-success" id="suiv">Suivant</button>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <span id="page-info">
                                            Pages<span id="init"></span> sur <span id="total">0</span>
                                        </span>
                                    </div>
                                </div>
                            </form>
                                
                            <div class="row mt-5 justify-content-center">
                                <div class="col-12 text-center">
                                    <h6>Progression de lecture</h6>
                                </div>
                                <div class="p-0 col-9 mt-2 progress border">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" id="progressBar" style="width:0%">0%</div>
                                </div>
                            </div>
                            <div class="row mt-5 justify-content-center">
                                <div class="col-12 text-center">
                                    <h6>Cours en lecture</h6>
                                </div>
                                <div class="card col-4 mb-2" id="currentCourse">
                                    <div class="card-body  text-dark" >
                                        <h5 class="col-12 text-center">Batiment</h5>
                                        
                                        <div class="col-12 justify-content-center mt-2">
                                            <a href="#" class="btn btn-primary py-0" >Devoir</a>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                                <div style="overflow-y: auto; overflow-x: hidden; max-height:600px" class="ml-4 mb-2">
                                    <div class="col-12 mt-5 text-center">
                                        <h5>Autres cours</h5>
                                    </div>
                                        <div class="row">
                                        <?php while ($course = $allCoursesFollowed1->fetch()){?>
                                        
                                            <div class="card mb-2 ml-2 col-5" id="currentCourse">
                                                <div class="card-body py-4 text-dark">
                                                    <h6 class="col-12 text-center"><?= $course['COURSETITLE'] ?></h6>
                                                    <div class="col-12 text-center mt-2">
                                                        <a href="readPDF.php?id_sub=<?=$course['IDSUBCRIPTION']?>&id_user=<?=$course['IDUSER']?>" class="btn btn-primary py-0" >Lire ce cours</a>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        <?php }?>
                                        </div>
                                </div>
                        </div>
                    </div>
                    <div class="coursCanvas bg-secondary ">
                        <div class="row justify-content-center">
                            <canvas id="pdf-render" class="border-warning border mt-4"></canvas>
                        </div>
                    </div>

                    <div class="  bg-dark text-white d-none">
                        <div class="mt-4">
                            <form method="post" id="form_reader">
                                <div class="row text-center">
                                    <div class="col-6 mb-3">
                                        <button class="btn btn-danger" id="prece">Precedent</button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-success" id="suiv">Suivant</button>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <span id="page-info">
                                            Pages<span id="init"></span> sur <span id="total">0</span>
                                        </span>
                                    </div>
                                </div>
                            </form>
                                
                            <div class="row mt-5 justify-content-center">
                                <div class="col-12 text-center">
                                    <h6>Progression de lecture</h6>
                                </div>
                                <div class="p-0 col-9 mt-2 progress border">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" id="progressBar" style="width:0%">0%</div>
                                </div>
                            </div>
                            <div class="row mt-5 justify-content-center">
                                <div class="col-12 text-center">
                                    <h6>Cours en lecture</h6>
                                </div>
                                <div class="card col-4 mb-2" id="currentCourse">
                                    <div class="card-body  text-dark" >
                                        <h5 class="col-12 text-center">Batiment</h5>
                                        
                                        <div class="col-12 justify-content-center mt-2">
                                            <a href="#" class="btn btn-primary py-0" >Devoir</a>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                                <div style="overflow-y: auto; overflow-x: hidden; max-height:600px" class="ml-4 mb-2">
                                    <div class="col-12 mt-5 text-center">
                                        <h5>Autres cours</h5>
                                    </div>
                                        <div class="row">
                                        <?php while ($course = $allCoursesFollowed->fetch()){?>
                                        
                                            <div class="card mb-2 ml-2 col-5" id="currentCourse">
                                                <div class="card-body py-4 text-dark">
                                                    <h6 class="col-12 text-center"><?= $course['COURSETITLE'] ?></h6>
                                                    <div class="col-12 text-center mt-2">
                                                        <a href="readPDF.php?id_sub=<?=$course['IDSUBCRIPTION']?>&id_user=<?=$course['IDUSER']?>" class="btn btn-primary py-0" >Lire ce cours</a>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        <?php }?>
                                        </div>
                                </div>
                        </div>
                    </div>
            </div>
        </div>
        <script>
           
             

        </script>
		<!-- All JS Custom Plugins Link Here here -->
        <script src="./js/pdfController.js"></script>
    </body>
    <?php } ?>
</html>
