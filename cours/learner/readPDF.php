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
        <div style="position:relative" >
            <div class="container-fluid" >
                <div class="row">
                    <div class="col-2 bg-dark text-white mb-4" style="position:fixed;z-index:2; min-height:783px" >
                        <div class="row">
                            <div class="col-2 "  >
                                <button class="btn btn-danger" id="prece">Precedent</button>
                            </div>
                            <div class="col-2">
                            <button class="btn btn-success" id="suiv">Suivant</button>
                            </div>
                        </div>
                        
                        
                        <span id="page-info">
                            Pages<span id="init"></span> sur<span id="total"> 6</span>
                        </span>
                    </div>
                    <div class="col-2" ></div>
                        <div class=" mt-4 col-" style="height:503px; overflow: scroll; width:100%;">
                            <canvas id="pdf-render" class="border-danger border"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>






    <!-- JS here -->
     
		<!-- All JS Custom Plugins Link Here here -->
        <script src="js/pdfController.js"></script>
        
        
    </body>
</html>