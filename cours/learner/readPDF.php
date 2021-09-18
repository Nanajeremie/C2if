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
            <link rel="stylesheet" href="/css/main.css">
            <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.9.359/build/pdf.min.js"></script>
    </head>

    <body>
        
        </div> 
        <div class="container-fluid">
            <div class="row">
                <div class="col-2 bg-dark text-white pt-4">
                    <div style="position: fixed;">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-3">
                                <button class="btn btn-danger" id="prece">Precedent</button>
                            </div>
                            <div class="col-12 col-md-6">
                            <button class="btn btn-success" id="suiv">Suivant</button>
                            </div>
                            <div class="col-12 mt-4">
                                <span id="page-info">
                                Pages<span id="init"></span> sur<span id="total"> 6</span>
                                </span>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-12">
                                <h6>Progression de lecture</h6>
                            </div>
                            <div class="p-0 col-9 mt-2 progress border">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" style="width:50%">40%</div>
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
                                        <a href="#" class="btn btn-primary py-0">Lire ce cours</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    </div>
                </div>
                
                <div class="col-8 bg-secondary">
                    <div class="container mt-4 ">
                        <div class="row justify-content-center">
                            <canvas id="pdf-render" class="border-danger border" class="col-12"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-2 bg-dark text-white pt-4 ">
                    <div style="position: fixed; overflow-y: scroll; overflow-x: hidden; max-height:900px" class="ml-4 mb-2">
                            <div class="col-12 mb-4">
                                <h5>Vos cours</h5>
                            </div>
                            <div class="container ">
                                <div class="card col-11 mb-2">
                                    <div class="card-body py-4 text-dark">
                                        <h5 class="col-12 text-center">Batiments</h5>
                                        <img src="img/blog-details/1.jpg" width="100%" height="100px" alt="fegfer">
                                        
                                        <div class="col-8 justify-content-center mt-2">
                                            <a href="#" class="btn btn-primary py-0">Lire ce cours</a>
                                        </div>
                                    </div>
                                </div><div class="card col-11 mb-2">
                                    <div class="card-body py-4 text-dark">
                                        <h5 class="col-12 text-center">Batiments</h5>
                                        <img src="img/blog-details/1.jpg" width="100%" height="100px" alt="fegfer">
                                        
                                        <div class="col-8 justify-content-center mt-2">
                                            <a href="#" class="btn btn-primary py-0">Lire ce cours</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card col-11 mb-2">
                                    <div class="card-body py-4 text-dark">
                                        <h5 class="col-12 text-center">Batiments</h5>
                                        <img src="img/blog-details/1.jpg" width="100%" height="100px" alt="fegfer">
                                        
                                        <div class="col-8 justify-content-center mt-2">
                                            <a href="#" class="btn btn-primary py-0">Lire ce cours</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card col-11 mb-2">
                                    <div class="card-body py-4 text-dark">
                                        <h5 class="col-12 text-center">Batiments</h5>
                                        <img src="img/blog-details/1.jpg" width="100%" height="100px" alt="fegfer">
                                        
                                        <div class="col-8 justify-content-center mt-2">
                                            <a href="#" class="btn btn-primary py-0">Lire ce cours</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>

		<!-- All JS Custom Plugins Link Here here -->
        <script src="js/pdfController.js"></script>
    </body>
</html>