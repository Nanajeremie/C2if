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
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 ">
                                <div class="analytics-sparkle-line reso-mg-b-30 shadow">
                                    <div class="analytics-content">
                                        <h5>Maintenance</h5>
                                        <h2><span class="h5"> <a href="read.php?cours=1">Continuer la lecture</a></span> <span class="tuition-fees">Progression</span></h2>
                                        <span class="text-success">20%</span>
                                        <div class="progress m-b-0">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:20%;"> <span class="sr-only">20% Complete</span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                <div class="analytics-sparkle-line reso-mg-b-30 shadow">
                                    <div class="analytics-content">
                                        <h5>Batiment</h5>
                                        <h2><span class="h5"> <a href="#">Continuer la lecture</a></span> <span class="tuition-fees">Progression</span></h2>
                                        <span class="text-danger">30%</span>
                                        <div class="progress m-b-0">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:30%;"> <span class="sr-only">30% Complete</span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                <div class="analytics-sparkle-line reso-mg-b-30 table-mg-t-pro dk-res-t-pro-30 shadow">
                                    <div class="analytics-content">
                                        <h5>Programmation</h5>
                                        <h2><span class="h5"> <a href="#">Continuer la lecture</a></span><span class="tuition-fees">Progression</span></h2>
                                        <span class="text-info">60%</span>
                                        <div class="progress m-b-0">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:60%;"> <span class="sr-only">60% Complete</span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                <div class="analytics-sparkle-line table-mg-t-pro dk-res-t-pro-30 shadow">
                                    <div class="analytics-content">
                                        <h5>Mine</h5>
                                        <h2><span class="h5"> <a href="#">Continuer la lecture</a></span> <span class="tuition-fees">Progression</span></h2>
                                        <span class="text-inverse">80%</span>
                                        <div class="progress m-b-0">
                                            <div class="progress-bar progress-bar-inverse" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:80%;"> <span class="sr-only">80% Complete</span> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div> <br>
        <div class="courses-area mb-3">
            <div class="container-fluid">
                <div class="card shadow">
                    <div class="card-header ">
                        <div class="row">
                            <div class="col-12">
                                <p class="text-center">Veuillez chosir une categorie pour vour la liste des cours disponible</p>
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-2 mb-3">
                                <button class="btn btn-outline-danger w-100" type="button">Informatique</button>
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-2 mb-3">
                                <button class="btn btn-outline-warning w-100" type="button">Comptabilites</button>
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-2 mb-3">
                                <button class="btn btn-outline-success w-100" type="button">Resource humaine</button>
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-2 mb-3">
                                <button class="btn btn-outline-secondary w-100" type="button">Genie civil</button>
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-2 mb-3">
                                <button class="btn btn-outline-info w-100" type="button">Mine</button>
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-lg-2 mb-3">
                                <button class="btn btn-outline-primary w-100" type="button">Banque</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                                <div class="card border-danger shadow">
                                    <div class="card-header bg-danger">
                                        <div class="row ">
                                            <div class="col-12">
                                                <h6 class="text-center text-white"> Informatique</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body " style="background-image:url(../assets/img/formation-elec.jpg);background-size: cover;background-position: center;height:200px;width:100%">
                                    </div>
                                    <div class="card-footer border-danger bg-danger">
                                        <div class="row small">
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Durée: </Strong></div>
                                                    <div class="col-6">3 mois</div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Prix: </Strong></div>
                                                    <div class="col-6">20 000 Fcfa</div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Difficulté: </Strong></div>
                                                    <div class="col-6">Moyenne</div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-white mt-2 text-right">
                                            <a href="../cours_details.php" class="btn btn-light px-1 py-0  text-danger"><i class="fa fa-eye  text-danger " aria-hidden="true"></i> Suivre</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                                <div class="card border-danger shadow">
                                    <div class="card-header bg-success">
                                        <div class="row ">
                                            <div class="col-12">
                                                <h6 class="text-center text-white"> Batiments</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body " style="background-image:url(../assets/img/formation-elec.jpg);background-size: cover;background-position: center;height:200px;width:100%">
                                    </div>
                                    <div class="card-footer border-success bg-success">
                                        <div class="row small">
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Durée: </Strong></div>
                                                    <div class="col-6">6 mois</div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Prix: </Strong></div>
                                                    <div class="col-6">30 000 Fcfa</div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Difficulté: </Strong></div>
                                                    <div class="col-6">Moyenne</div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-white mt-2 text-right">
                                            <a href="../cours_details.php" class="btn btn-light px-1 py-0  text-success"><i class="fa fa-eye  text-success " aria-hidden="true"></i> Suivre</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                                <div class="card border-danger shadow">
                                    <div class="card-header bg-danger">
                                        <div class="row ">
                                            <div class="col-12">
                                                <h6 class="text-center text-white"> Informatique</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body " style="background-image:url(../assets/img/formation-elec.jpg);background-size: cover;background-position: center;height:200px;width:100%">
                                    </div>
                                    <div class="card-footer border-danger bg-danger">
                                        <div class="row small">
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Durée: </Strong></div>
                                                    <div class="col-6">3 mois</div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Prix: </Strong></div>
                                                    <div class="col-6">20 000 Fcfa</div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Difficulté: </Strong></div>
                                                    <div class="col-6">Moyenne</div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-white mt-2 text-right">
                                            <a href="../cours_details.php" class="btn btn-light px-1 py-0  text-danger"><i class="fa fa-eye  text-danger " aria-hidden="true"></i> Suivre</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                                <div class="card border-danger shadow">
                                    <div class="card-header bg-success">
                                        <div class="row ">
                                            <div class="col-12">
                                                <h6 class="text-center text-white"> Batiments</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body " style="background-image:url(../assets/img/formation-elec.jpg);background-size: cover;background-position: center;height:200px;width:100%">
                                    </div>
                                    <div class="card-footer border-success bg-success">
                                        <div class="row small">
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Durée: </Strong></div>
                                                    <div class="col-6">6 mois</div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Prix: </Strong></div>
                                                    <div class="col-6">30 000 Fcfa</div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Difficulté: </Strong></div>
                                                    <div class="col-6">Moyenne</div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-white mt-2 text-right">
                                            <a href="../cours_details.php" class="btn btn-light px-1 py-0  text-success"><i class="fa fa-eye  text-success " aria-hidden="true"></i> Suivre</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                                <div class="card border-danger shadow">
                                    <div class="card-header bg-danger">
                                        <div class="row ">
                                            <div class="col-12">
                                                <h6 class="text-center text-white"> Informatique</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body " style="background-image:url(../assets/img/formation-elec.jpg);background-size: cover;background-position: center;height:200px;width:100%">
                                    </div>
                                    <div class="card-footer border-danger bg-danger">
                                        <div class="row small">
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Durée: </Strong></div>
                                                    <div class="col-6">3 mois</div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Prix: </Strong></div>
                                                    <div class="col-6">20 000 Fcfa</div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Difficulté: </Strong></div>
                                                    <div class="col-6">Moyenne</div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-white mt-2 text-right">
                                            <a href="../cours_details.php" class="btn btn-light px-1 py-0  text-danger"><i class="fa fa-eye  text-danger " aria-hidden="true"></i> Suivre</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                                <div class="card border-danger shadow">
                                    <div class="card-header bg-success">
                                        <div class="row ">
                                            <div class="col-12">
                                                <h6 class="text-center text-white"> Batiments</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body " style="background-image:url(../assets/img/formation-elec.jpg);background-size: cover;background-position: center;height:200px;width:100%">
                                    </div>
                                    <div class="card-footer border-success bg-success">
                                        <div class="row small">
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Durée: </Strong></div>
                                                    <div class="col-6">6 mois</div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Prix: </Strong></div>
                                                    <div class="col-6">30 000 Fcfa</div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Difficulté: </Strong></div>
                                                    <div class="col-6">Moyenne</div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-white mt-2 text-right">
                                            <a href="../cours_details.php" class="btn btn-light px-1 py-0  text-success"><i class="fa fa-eye  text-success " aria-hidden="true"></i> Suivre</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                                <div class="card border-danger shadow">
                                    <div class="card-header bg-danger">
                                        <div class="row ">
                                            <div class="col-12">
                                                <h6 class="text-center text-white"> Informatique</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body " style="background-image:url(../assets/img/formation-elec.jpg);background-size: cover;background-position: center;height:200px;width:100%">
                                    </div>
                                    <div class="card-footer border-danger bg-danger">
                                        <div class="row small">
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Durée: </Strong></div>
                                                    <div class="col-6">3 mois</div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Prix: </Strong></div>
                                                    <div class="col-6">20 000 Fcfa</div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Difficulté: </Strong></div>
                                                    <div class="col-6">Moyenne</div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-white mt-2 text-right">
                                            <a href="../cours_details.php" class="btn btn-light px-1 py-0  text-danger"><i class="fa fa-eye  text-danger " aria-hidden="true"></i> Suivre</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                                <div class="card border-danger shadow">
                                    <div class="card-header bg-success">
                                        <div class="row ">
                                            <div class="col-12">
                                                <h6 class="text-center text-white"> Batiments</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body " style="background-image:url(../assets/img/formation-elec.jpg);background-size: cover;background-position: center;height:200px;width:100%">
                                    </div>
                                    <div class="card-footer border-success bg-success">
                                        <div class="row small">
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Durée: </Strong></div>
                                                    <div class="col-6">6 mois</div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Prix: </Strong></div>
                                                    <div class="col-6">30 000 Fcfa</div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-white">
                                                <div class="row">
                                                    <div class="col-6"><Strong>Difficulté: </Strong></div>
                                                    <div class="col-6">Moyenne</div>
                                                </div>
                                            </div>
                                            <div class="col-12 text-white mt-2 text-right">
                                            <a href="../cours_details.php" class="btn btn-light px-1 py-0  text-success"><i class="fa fa-eye  text-success " aria-hidden="true"></i> Suivre</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php');?>
</body>

</html>