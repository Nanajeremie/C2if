<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>C2if</title>
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
            <div class="container-fluid" id="accordion">
            </div>
        </div> <br>
        <div class="courses-area">
            <div class="container-fluid mb-5">
                <div class="card shadow">
                    <div class="card-header" >
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <form action="#" method="post" class="">
                                            <div class="form-group">
                                                <select name="" id="cat" class="form-control shadow bg-light w-50">
                                                    <option value="">Categorie</option>
                                                    <option value="">Batiment</option>
                                                    <option value="">Mine</option>
                                                    <option value="">Backend</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-3 text-right">
                                    </div>
                                    <div class="col-3 text-right">
                                        <a class="btn btn-primary " data-toggle="modal" href="#InformationproModalalert">Ajouter</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div id="InformationproModalalert" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" >
                                            <div class="modal-content ">
                                                <div class="modal-close-area modal-close-df">
                                                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="#" method="post">
                                                        <div class="row">
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                                                <label for="course-cat" class="col-12">Categorie: </label>
                                                                <select name="course-cat" id="course-cat" class="form-control">
                                                                    <option value="">Choisir la categorie</option>
                                                                    <option value="">Batiment</option>
                                                                    <option value="">Informatique</option>
                                                                    <option value="">Mine</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                                                <label for="course-title" class="col-12">Titre: </label>
                                                                <input type="text" name="course-title" id="course-title" class="form-control" placeholder="Titre du cours">
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                                                <label for="course-price" class="col-12">Prix: </label>
                                                                <input type="number" name="course-price" id="course-price" class="form-control" placeholder="Prix du cours">
                                                            </div>
                                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                                                <label for="course-img" class="col-12">Image de couverture: </label>
                                                                <input type="file" name="course-img" id="course-img" class="form-control">
                                                            </div>
                                                            <div class="col-12 form-group ">
                                                                <label for="course-content" class="col-12">Fichier: </label>
                                                                <input type="file" name="course-content" id="course-content" class="form-control ">
                                                            </div>
                                                            <div class="col-12 form-group">
                                                                <label class="col-12" for="course-description">Description: </label>
                                                                <textarea type="text" name="course-description" id="course-description" class="form-control" placeholder="Decrire le cours"></textarea>
                                                            </div>
                                                            <div class="col-12 text-right">
                                                                <input type="reset" name="course-reset" id="course-reset" class="btn btn-secondary text-white" value="Annuler">
                                                                <input type="button" name="course-add" id="course-add" class="btn btn-primary text-white" value="Ajouter">
                                                            </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2 mb-3">
                                <div class="card shadow">
                                    <div class="card-header bg-white border-none">
                                        <div class="row ">
                                            <div class="col-12">
                                                <h6 class="text-center text-muted"> Informatique</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body " style="background-image:url(../assets/img/formation-elec.jpg);background-size: cover;background-position: center;height:200px;width:100%">
                                    </div>
                                    <div class="card-footer">
                                        <div class="row small">
                                            <div class="col-12 text-right">
                                            <a href="../cours_details.php" class="btn btn-light px-1 py-0  text-muted"><i class="fa fa-eye  text-danger " aria-hidden="true"></i> Detail</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2 mb-3">
                                <div class="card shadow">
                                    <div class="card-header bg-white border-none">
                                        <div class="row ">
                                            <div class="col-12">
                                                <h6 class="text-center text-muted"> Informatique</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body " style="background-image:url(../assets/img/formation-elec.jpg);background-size: cover;background-position: center;height:200px;width:100%">
                                    </div>
                                    <div class="card-footer">
                                        <div class="row small">
                                            <div class="col-12 text-right">
                                            <a href="../cours_details.php" class="btn btn-light px-1 py-0  text-muted"><i class="fa fa-eye  text-danger " aria-hidden="true"></i> Detail</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2 mb-3">
                                <div class="card shadow">
                                    <div class="card-header bg-white border-none">
                                        <div class="row ">
                                            <div class="col-12">
                                                <h6 class="text-center text-muted"> Informatique</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body " style="background-image:url(../assets/img/formation-elec.jpg);background-size: cover;background-position: center;height:200px;width:100%">
                                    </div>
                                    <div class="card-footer">
                                        <div class="row small">
                                            <div class="col-12 text-right">
                                            <a href="../cours_details.php" class="btn btn-light px-1 py-0  text-muted"><i class="fa fa-eye  text-danger " aria-hidden="true"></i> Detail</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2 mb-3">
                                <div class="card shadow">
                                    <div class="card-header bg-white border-none">
                                        <div class="row ">
                                            <div class="col-12">
                                                <h6 class="text-center text-muted"> Informatique</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body " style="background-image:url(../assets/img/formation-elec.jpg);background-size: cover;background-position: center;height:200px;width:100%">
                                    </div>
                                    <div class="card-footer">
                                        <div class="row small">
                                            <div class="col-12 text-right">
                                            <a href="../cours_details.php" class="btn btn-light px-1 py-0  text-muted"><i class="fa fa-eye  text-danger " aria-hidden="true"></i> Detail</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2 mb-3">
                                <div class="card shadow">
                                    <div class="card-header bg-white border-none">
                                        <div class="row ">
                                            <div class="col-12">
                                                <h6 class="text-center text-muted"> Informatique</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body " style="background-image:url(../assets/img/formation-elec.jpg);background-size: cover;background-position: center;height:200px;width:100%">
                                    </div>
                                    <div class="card-footer">
                                        <div class="row small">
                                            <div class="col-12 text-right">
                                            <a href="../cours_details.php" class="btn btn-light px-1 py-0  text-muted"><i class="fa fa-eye  text-danger " aria-hidden="true"></i> Detail</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2 mb-3">
                                <div class="card shadow">
                                    <div class="card-header bg-white border-none">
                                        <div class="row ">
                                            <div class="col-12">
                                                <h6 class="text-center text-muted"> Informatique</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body " style="background-image:url(../assets/img/formation-elec.jpg);background-size: cover;background-position: center;height:200px;width:100%">
                                    </div>
                                    <div class="card-footer">
                                        <div class="row small">
                                            <div class="col-12 text-right">
                                            <a href="../cours_details.php" class="btn btn-light px-1 py-0  text-muted"><i class="fa fa-eye  text-danger " aria-hidden="true"></i> Detail</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2 mb-3">
                                <div class="card shadow">
                                    <div class="card-header bg-white border-none">
                                        <div class="row ">
                                            <div class="col-12">
                                                <h6 class="text-center text-muted"> Informatique</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body " style="background-image:url(../assets/img/formation-elec.jpg);background-size: cover;background-position: center;height:200px;width:100%">
                                    </div>
                                    <div class="card-footer">
                                        <div class="row small">
                                            <div class="col-12 text-right">
                                            <a href="../cours_details.php" class="btn btn-light px-1 py-0  text-muted"><i class="fa fa-eye  text-danger " aria-hidden="true"></i> Detail</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2 mb-3">
                                <div class="card shadow">
                                    <div class="card-header bg-white border-none">
                                        <div class="row ">
                                            <div class="col-12">
                                                <h6 class="text-center text-muted"> Informatique</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body " style="background-image:url(../assets/img/formation-elec.jpg);background-size: cover;background-position: center;height:200px;width:100%">
                                    </div>
                                    <div class="card-footer">
                                        <div class="row small">
                                            <div class="col-12 text-right">
                                            <a href="../cours_details.php" class="btn btn-light px-1 py-0  text-muted"><i class="fa fa-eye  text-danger " aria-hidden="true"></i> Detail</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2 mb-3">
                                <div class="card shadow">
                                    <div class="card-header bg-white border-none">
                                        <div class="row ">
                                            <div class="col-12">
                                                <h6 class="text-center text-muted"> Informatique</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body " style="background-image:url(../assets/img/formation-elec.jpg);background-size: cover;background-position: center;height:200px;width:100%">
                                    </div>
                                    <div class="card-footer">
                                        <div class="row small">
                                            <div class="col-12 text-right">
                                            <a href="../cours_details.php" class="btn btn-light px-1 py-0  text-muted"><i class="fa fa-eye  text-danger " aria-hidden="true"></i> Detail</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2 mb-3">
                                <div class="card shadow">
                                    <div class="card-header bg-white border-none">
                                        <div class="row ">
                                            <div class="col-12">
                                                <h6 class="text-center text-muted"> Informatique</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body " style="background-image:url(../assets/img/formation-elec.jpg);background-size: cover;background-position: center;height:200px;width:100%">
                                    </div>
                                    <div class="card-footer">
                                        <div class="row small">
                                            <div class="col-12 text-right">
                                            <a href="../cours_details.php" class="btn btn-light px-1 py-0  text-muted"><i class="fa fa-eye  text-danger " aria-hidden="true"></i> Detail</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2 mb-3">
                                <div class="card shadow">
                                    <div class="card-header bg-white border-none">
                                        <div class="row ">
                                            <div class="col-12">
                                                <h6 class="text-center text-muted"> Informatique</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body " style="background-image:url(../assets/img/formation-elec.jpg);background-size: cover;background-position: center;height:200px;width:100%">
                                    </div>
                                    <div class="card-footer">
                                        <div class="row small">
                                            <div class="col-12 text-right">
                                            <a href="../cours_details.php" class="btn btn-light px-1 py-0  text-muted"><i class="fa fa-eye  text-danger " aria-hidden="true"></i> Detail</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2 mb-3">
                                <div class="card shadow">
                                    <div class="card-header bg-white border-none">
                                        <div class="row ">
                                            <div class="col-12">
                                                <h6 class="text-center text-muted"> Informatique</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body " style="background-image:url(../assets/img/formation-elec.jpg);background-size: cover;background-position: center;height:200px;width:100%">
                                    </div>
                                    <div class="card-footer">
                                        <div class="row small">
                                            <div class="col-12 text-right">
                                            <a href="../cours_details.php" class="btn btn-light px-1 py-0  text-muted"><i class="fa fa-eye  text-danger " aria-hidden="true"></i> Detail</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 text-right">
                                <ul class="pagination">
                                    <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php');?>
    
</body>

</html>