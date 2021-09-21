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
    </head>

    <body onload="currentFile()">
    <?php if ($course = $coursesFollowed->fetch()){?><input type="text" name="file-name" id="file-name" value="<?= $course['COURSECONTENT'] ?>" hidden><?php } ?>
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-2 bg-dark text-white pt-4">
                    <div style="">
                    <div class="container-fluid">
                        
                        <form method="post" id="form_reader">
                            <div class="row">
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
                            
                        <div class="row mt-5">
                            <div class="col-12">
                                <h6>Progression de lecture</h6>
                            </div>
                            <div class="p-0 col-9 mt-2 progress border">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" id="progressBar" style="width:0%">0%</div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row mt-5">
                            <div class="col-12">
                                <h6>Cours en lecture</h6>
                            </div>
                    </div>
                    <div class="container-fluid mt-5">
                        <div class="row">
                        <div class="card col-10 mb-2">
                                <div class="card-body py-4 text-dark">
                                    <h5 class="text-center">Batiments</h5>
                                    <img src="img/blog-details/1.jpg" width="100%" height="100px" alt="fegfer">
                                    
                                    <div class="justify-content-center mt-2">
                                        <a href="#" class="btn btn-primary py-0" >Lire ce cours</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    </div>
                </div>
                
                <div class="col-12 col-md-12 col-lg-8 bg-secondary" style="min-height: 1170px;">
                    <div class="container mt-4 ">
                        <div class="row justify-content-center">
                            <canvas id="pdf-render" class="border-warning border" style="width: 410px; height:100%;" class="col-12"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-12 col-lg-2 bg-dark text-white pt-4 ">
                    <div style="position: fixed; overflow-y: auto; overflow-x: hidden; max-height:900px" class="ml-4 mb-2">
                        <div class="col-12 mb-4">
                            <h5>Vos cours</h5>
                        </div>
                        <div class="container">
                        <?php while ($course = $allCoursesFollowed->fetch())
                            {
                        ?>
                            <div class="card col-11 mb-2">
                                <div class="card-body py-4 text-dark">
                                    <h5 class="col-12 text-center"><?= $course['COURSETITLE'] ?></h5>
                                    <img src="../assets/fichier_cours/<?= $course['COURSCOVER']?>" width="100%" height="100px" alt="fegfer">
                                    
                                    <div class="col-8 justify-content-center mt-2">
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
      
		<!-- All JS Custom Plugins Link Here here -->
        <script src="./js/pdfController.js"></script>
    </body>
    <?php } ?>
</html>
