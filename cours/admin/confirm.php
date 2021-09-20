<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>C2if</title>
    
<?php 
    include("../../utilities/QueryBuilder.php");
    $obj = new QueryBuilder();
    //recuperation des preuves de paiement 

    $getSub = $obj->Requete("SELECT * FROM course c, subcription s, subject su WHERE c.IDCOURSE = s.IDCOURSE AND su.IDSUBJECT=c.IDSUBJECT");
    include('links.php');
?>
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
                                            <th>Telephone</th>
                                            <th>Action</th>
                                        </tr>
                                        <tbody id="subBody">
                                            <?php $cpt = 1; while($subList = $getSub->fetch()){?>
                                                <tr>
                                                    <td><?=$cpt?></td>
                                                    <td> <a data-toggle="modal" href="#viewImage"><img src="../assets/learner_preuve/<?=$subList['IMG']?>" alt="" onclick="bigImage('<?php echo htmlspecialchars($subList['IMG'])?>')" /></a> </td>
                                                    <td><?=$subList['SUBJECTNAME']?></td>
                                                    <td><?=$subList['COURSETITLE']?></td>
                                                    <td><?=$subList['AMOUNT']?> F CFA</td>
                                                    <td><?=$subList['SUBSCRIPTIONDATE']?></td>
                                                    <td><?=$subList['PHONE']?></td>
                                                    <td>
                                                        <button  title="Edit" class="pd-setting-ed"  data-toggle="modal" href="#validePay"><i class="fa fa-check text-success" aria-hidden="true"></i></button>
                                                        <button title="Trash" class="pd-setting-ed" data-toggle="modal" href="#rejectPay" onclick="{$('#validId').val(<?php echo htmlspecialchars($subList['IDSUBCRIPTION']) ?>)}"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></button>
                                                    </td>
                                                </tr>
                                            <?php $cpt++;} ?>
                                        </tbody>
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
             <!-- Afficher image Modal-->
            <div id="viewImage" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered" >
                    <div class="modal-content ">
                        <div class="modal-close-area modal-close-df">
                            <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                        </div>
                        <div class="modal-body d-flex justify-content-center" id="getImage">
                        </div>
                    </div>
                </div>
            </div>
             <!-- view valider Modal-->
             <div id="validePay" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1">
                <div class="modal-dialog  modal-dialog-centered" >
                    <div class="modal-content ">
                        <div class="modal-close-area modal-close-df">
                            <a class="close bg-success" data-dismiss="modal" href="#"><i class="fa fa-close text-white"></i></a>
                        </div>
                        <div class="modal-body d-flex justify-content-center">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h4 class="text-success">
                                        Attention!! Action irreversible.
                                        <input type="text" name="validId" id="validId">
                                    </h4>
                                </div>
                                <div class="col-12 my-4 text-center">
                                    <p>
                                        Voulez-vous reelement valider le paiement?
                                    </p>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6"><button type="button" class="btn btn-danger" data-dismiss="modal" >Annuler</button></div>
                                        <div class="col-6 text-right"><button type="button" class="btn btn-success" data-dismiss="modal" onclick="refresh()" >Valider</button></div>
                                        <div class="col-6"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
             <!-- view rejeter Modal-->
             <div id="rejectPay" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered" >
                    <div class="modal-content ">
                        <div class="modal-close-area modal-close-df">
                            <a class="close bg-danger" data-dismiss="modal" href="#"><i class="fa fa-close text-white"></i></a>
                        </div>
                        <div class="modal-body d-flex justify-content-center">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h4 class="text-danger">
                                        Attention!! Action irreversible.
                                    </h4>
                                </div>
                                <div class="col-12 my-4 text-center">
                                    <p>
                                        Voulez-vous reelement rejeter le paiement?
                                    </p>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6"><button type="button" class="btn btn-secondary" data-dismiss="modal" >Annuler</button></div>
                                        <div class="col-6 text-right"><button type="button" class="btn btn-danger" data-dismiss="modal" >Valider</button></div>
                                        <div class="col-6"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
        <?php include_once('footer.php')?>
        <script>
            function bigImage(link){
               let lien = "<img src='../assets/learner_preuve/"+link+"' alt='"+link+"'/>";
                $("#getImage").html(lien);

            }

            // Validation de la preuve


            // Rejet de la preuve 

            // Actualiser la table

            function refresh(){
                $.post(
                    'ajax/ajax.php', {
                        sub_ref_key:"sub_ref_key",
                    }, function (donnees){
                       $("#subBody").html(donnees);
                    });
            }
        </script>
</body>

</html>