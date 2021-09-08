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
    <div class="left-sidebar-pro">
        <nav id="sidebar" class=" cardBor primeBack">
            <div class="sidebar-header primeBack" style="margin-top:10px">
                <a href="index.php"><img class="main-logo " src="../assets/img/logo.jpg" alt="" style="height:50px;width:100px" /></a>
                <strong><a href="index.php" style="height:30px;width:50px"><img src="../assets/img/logo.jpg" alt=""/></a></strong>
            </div>
            <hr>
            <div class=" col-12 text-center mb-4"><span id="page-info">
                Pages<span id="init"></span> sur<span id="total"> 6</span>
                </span></div>
                <div class="row text-center">
                <div class="col-6">
                    <button class="btn btn-danger" id="prece"><i class="fa fa-arrow-circle-left"></i></button>
                </div>
                <div class="col-6">
                    <button class="btn btn-success" id="suiv"><i class="fa fa-arrow-circle-right"></i></button>
                </div>
                </div>
                
        </nav>
    </div>
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
                <div class="row">
                    <div class=" col-10 mt-4" style="height:100%; overflow: auto; width:100%;">
                        <canvas id="pdf-render" class="border-danger border"></canvas>
                    </div>
                </div>
            </div>
        </div> 

        <?php include('footer.php');?>
</body>

</html>
