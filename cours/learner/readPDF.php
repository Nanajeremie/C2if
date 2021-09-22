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

            <!--modes de lectures des cours et adaptation avec les ecran  -->

           
    </head>

    <body onload="currentFile()">
    <?php if ($course = $coursesFollowed->fetch()){?><input type="text" name="file-name" id="file-name" value="<?= $course['COURSECONTENT'] ?>" hidden><?php } ?>
        
        <div class="container-fluid mainFrame" >
            <div class="row d-flex">
                    <div class="container-fluid courseDetail bg-dark text-white">
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
                                <div class="card col-lg-4 col-md-7 mb-2">
                                    <div class="card-body  text-dark">
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
                                    <div class="container">
                                        <div class="row">
                                        <?php while ($course = $allCoursesFollowed->fetch()){?>
                                        
                                            <div class="card col-lg-5 col-md-12 ml-3 mb-2">
                                                <div class="card-body py-4 text-dark">
                                                    <h5 class="col-12 text-center"><?= $course['COURSETITLE'] ?></h5>
                                                    <!-- <img src="../assets/fichier_cours/<?= $course['COURSCOVER']?>" width="100%" height="100px" alt="fegfer"> -->
                                                    
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
                    <div class="coursCanvas bg-secondary ">
                        <div class="row justify-content-center">
                            <canvas id="pdf-render" class="border-warning border mt-4"></canvas>
                        </div>
                    </div>
            </div>
        </div>
        <script>
            // Recuperation des duimension de l'ecran du visiteur
            let deviceScrenne = window.screen;
            let deviceHeight = deviceScrenne.availHeight;
            let deviceWidth = deviceScrenne.availWidth;
            // recuperation des dimensions du canvas
            let canvasDim = document.getElementById("pdf-render");
            let canWidth = canvasDim.offsetWidth;
            let canHeight = canvasDim.offsetHeight;
            //course infos
            let courseInfoFrame = document.querySelector(".courseDetail");
            let coursCanvasFrame = document.querySelector(".coursCanvas");
            let otherCoursFrame = document.querySelector(".otherCours");
            
            // container principal
            
            let mainFrame = document.querySelector(".mainFrame");
            // mainFrame.style.width="100%";
            // alert("Height= "+canHeight+" width= "+canWidth);
            document.body.style.backgroundColor="#6c757d";

            // ecran tres large
            function myFunction(x) {
                if (x.matches) { // If media query matches
                    courseInfoFrame.style.width="30%";
                    courseInfoFrame.style.height=deviceHeight+"px";
                    courseInfoFrame.style.position="fixed";

                    canvasDim.style.width = "800px";
                    canvasDim.style.height = deviceHeight+"px";


                    coursCanvasFrame.style.width="80%";
                    coursCanvasFrame.style.marginLeft="400px"
                    coursCanvasFrame.style.height="1200px";

                } else {
                    document.body.style.backgroundColor = "pink";
                    }
                }

                var x = window.matchMedia("(min-width: 1231px)")
                myFunction(x) // Call listener function at run time
                x.addListener(myFunction) // Attach listener function on state changes


                // ecran tres large
            // function mediumFunction(x) {
            //     if (x.matches) { // If media query matches
            //         // courseInfoFrame.style.width="30%";
            //         // courseInfoFrame.style.height=deviceHeight+"px";
            //         // courseInfoFrame.style.position="fixed";

            //         // canvasDim.style.width = "800px";
            //         // canvasDim.style.height = deviceHeight+"px";


            //         // coursCanvasFrame.style.width="80%";
            //         // coursCanvasFrame.style.marginLeft="400px"
            //         // coursCanvasFrame.style.height="1200px";

            //         alert("ghhsd");

            //     } else {
            //         document.body.style.backgroundColor = "pink";
            //         }
            //     }

            //     var x = window.matchMedia("(max-width: 1231px)")
            //     mediumFunction(x) // Call listener function at run time
            //     x.addListener(mediumFunction) // Attach listener function on state changes

        </script>
		<!-- All JS Custom Plugins Link Here here -->
        <script src="./js/pdfController.js"></script>
    </body>
    <?php } ?>
</html>
