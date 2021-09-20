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
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div id="InformationproModalalert" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1">
                        <div class="modal-dialog modal-lg modal-dialog-centered" >
                            <div class="modal-content ">
                                <div class="modal-close-area modal-close-df">
                                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                </div>
                                <!--  `IDCOURSE`, `TESTCONTENT`, `DURATION`, `CORRECTION` -->
                                <div class="modal-body">
                                    <form action="#" method="post">
                                        <div class="row" id="put">
                                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                                <label for="test-course" class="col-12">Choisir un cours </label>
                                                <select name="test-course" id="test-course" class="form-control">
                                                    <option value="">Choisir un cours</option>
                                                    <option value="">Batiment</option>
                                                    <option value="">Informatique</option>
                                                    <option value="">Mine</option>
                                                </select>
                                            </div>
                                            <div class=" mb-5 col-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                                <label for="test-time" class="col-12">Duree du devoir: </label>
                                                <input type="number" name="test-time" id="test-time" class="form-control" placeholder="La duree du devoir">
                                            </div>

                                            <div class="col-12 form-group">
                                                <input type="button" id="test_start" class="btn btn-success" value="creer le devoir">
                                            </div>
                                            <div class="col-12 form-group">
                                                <input type="text" name="#" id="#" class=" col-12 form-control" placeholder="Saisir la question N1:">
                                            </div>
                                            <div class="col-12">
                                                <input type="button" value="Ajouter une reponse" id="test-ans" class="btn btn-warning">
                                            </div>
                                            <div class="row col-12 mt-4">
                                                <div class="col-1 form-group">
                                                   <input type="checkbox" name="#" id="#" class=" iCheck-helper form-control " checked>
                                                </div>
                                                <div class="col-11 form-group">
                                                    <input type="text" name="#" id="#" class="form-control">
                                                </div>
                                            </div>
                                            
                                            <div class="col-12 text-right">
                                                <input type="reset" name="course-reset" id="course-reset" class="btn btn-secondary text-white" value="Annuler">
                                                <input type="button" name="course-add" id="course-add" class="btn btn-primary text-white" onclick="addForm('put','input','Note')" value="Ajouter">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-status mg-b-15">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="product-status-wrap">
                                <h4>Liste des devoirs</h4>
                                <div class="add-product">
                                    <a data-toggle="modal" href="#InformationproModalalert">Programmer un devoir</a>
                                </div>
                                <div class="asset-inner">
                                    <table>
                                        <tr>
                                            <th>No</th>
                                            <th>Image</th>
                                            <th>Titre</th>
                                            <th>Status</th>
                                            <th>Categories</th>
                                            <th>Date</th>
                                            <th>Duree</th>
                                            <th>Action</th>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td><img src="img/product/book-1.jpg" alt="" /></td>
                                            <td>Batiments</td>
                                            <td>
                                                <button class="pd-setting">En cours</button>
                                            </td>
                                            <td>Genie civil</td>
                                            <td>2020-01-02</td>
                                            <td>2 heures</td>
                                            <td>
                                                <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><img src="img/product/book-1.jpg" alt="" /></td>
                                            <td>Batiments</td>
                                            <td>
                                                <button class="ps-setting">Terminee</button>
                                            </td>
                                            <td>Genie civil</td>
                                            <td>2020-01-02</td>
                                            <td>2 heures</td>
                                            <td>
                                                <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td><img src="img/product/book-1.jpg" alt="" /></td>
                                            <td>Batiments</td>
                                            <td>
                                                <button class="pd-setting">En cours</button>
                                            </td>
                                            <td>Genie civil</td>
                                            <td>2020-01-02</td>
                                            <td>2 heures</td>
                                            <td>
                                                <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><img src="img/product/book-1.jpg" alt="" /></td>
                                            <td>Batiments</td>
                                            <td>
                                                <button class="ps-setting">Terminee</button>
                                            </td>
                                            <td>Genie civil</td>
                                            <td>2020-01-02</td>
                                            <td>2 heures</td>
                                            <td>
                                                <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td><img src="img/product/book-1.jpg" alt="" /></td>
                                            <td>Batiments</td>
                                            <td>
                                                <button class="pd-setting">En cours</button>
                                            </td>
                                            <td>Genie civil</td>
                                            <td>2020-01-02</td>
                                            <td>2 heures</td>
                                            <td>
                                                <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><img src="img/product/book-1.jpg" alt="" /></td>
                                            <td>Batiments</td>
                                            <td>
                                                <button class="ps-setting">Terminee</button>
                                            </td>
                                            <td>Genie civil</td>
                                            <td>2020-01-02</td>
                                            <td>2 heures</td>
                                            <td>
                                                <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td><img src="img/product/book-1.jpg" alt="" /></td>
                                            <td>Batiments</td>
                                            <td>
                                                <button class="pd-setting">En cours</button>
                                            </td>
                                            <td>Genie civil</td>
                                            <td>2020-01-02</td>
                                            <td>2 heures</td>
                                            <td>
                                                <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><img src="img/product/book-1.jpg" alt="" /></td>
                                            <td>Batiments</td>
                                            <td>
                                                <button class="ps-setting">Terminee</button>
                                            </td>
                                            <td>Genie civil</td>
                                            <td>2020-01-02</td>
                                            <td>2 heures</td>
                                            <td>
                                                <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td><img src="img/product/book-1.jpg" alt="" /></td>
                                            <td>Batiments</td>
                                            <td>
                                                <button class="pd-setting">En cours</button>
                                            </td>
                                            <td>Genie civil</td>
                                            <td>2020-01-02</td>
                                            <td>2 heures</td>
                                            <td>
                                                <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><img src="img/product/book-1.jpg" alt="" /></td>
                                            <td>Batiments</td>
                                            <td>
                                                <button class="ps-setting">Terminee</button>
                                            </td>
                                            <td>Genie civil</td>
                                            <td>2020-01-02</td>
                                            <td>2 heures</td>
                                            <td>
                                                <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>1</td>
                                            <td><img src="img/product/book-1.jpg" alt="" /></td>
                                            <td>Batiments</td>
                                            <td>
                                                <button class="pd-setting">En cours</button>
                                            </td>
                                            <td>Genie civil</td>
                                            <td>2020-01-02</td>
                                            <td>2 heures</td>
                                            <td>
                                                <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><img src="img/product/book-1.jpg" alt="" /></td>
                                            <td>Batiments</td>
                                            <td>
                                                <button class="ps-setting">Terminee</button>
                                            </td>
                                            <td>Genie civil</td>
                                            <td>2020-01-02</td>
                                            <td>2 heures</td>
                                            <td>
                                                <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="custom-pagination">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
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
            
        </div>
        <?php include_once('footer.php')?>
</body>

</html>