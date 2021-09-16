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
        <div class="product-status mg-b-15">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="product-status-wrap">
                                <h4>Liste des souscriptions</h4>
                                <div class="asset-inner">
                                    <table>
                                        <tr>
                                            <th>Matricule</th>
                                            <th>Preuve</th>
                                            <th>Categories</th>
                                            <th>Titre</th>
                                            <th>Prix</th>
                                            <th>Date</th>
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
                                            <td>
                                                <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-check text-success" aria-hidden="true"></i></button>
                                                <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></button>
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
                                            <td>
                                                <button data-toggle="tooltip" title="Edit" class="pd-setting-ed"><i class="fa fa-check text-success" aria-hidden="true"></i></button>
                                                <button data-toggle="tooltip" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></button>
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