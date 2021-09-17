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


    <?php 
    
    include("../../utilities/QueryBuilder.php");
    $obj = new QueryBuilder();
    // Selection des categories
    $getCatList = $obj->Requete("select * from subject");

    include('desktop.php');
    
    ?>
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
                    <div class="card-header bg-white">
                        <div class="col-12 col-md-6">
                            <form action="#" method="post" class="">
                                <div class="form-group">
                                    <select name="" id="cat" class="form-control shadow bg-light">
                                        <option value="0">Categorie</option>
                                        <?php    
                                            while($listes = $getCatList->fetch()){?>
                                                <option value="<?php echo $listes['IDSUBJECT'] ?>"><?php echo $listes['SUBJECTNAME'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 col-sm-2 text-right"></div>
                        <div class="col-12 col-md-2 mb-1">
                                <a class="btn btn-secondary text-white panel-title d-flex justify-content-center " data-toggle="collapse" data-parent="#accordion" href="#collapse2" >Nouveau categorie</a>
                            <div id="collapse2" class="collapse panel-collapse panel-ic">
                                <div class="panel-body admin-panel-content animated bg-light">
                                    <form action="#" method="post" id="cat-form" class="">
                                        <div class="input-group ">
                                            <div class="input-group-prepend ">
                                                <input type="text" name="cat-name" id="cat-name" class="form-control w-100" placeholder="Nom de la categorie" oninput="{document.getElementById('catError').innerHTML=''}">
                                                <button type="button" id="add-cat" class="btn btn-success input-group-text" onclick="addCat()">OK</button>
                                            </div>
                                        </div>
                                        <div class="col-12 h5" id="catError"></div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-5 col-md-2 ">
                            <a class="btn btn-primary" data-toggle="modal" href="#InformationproModalalert" onclick="getCatList()">Ajouter cours</a>
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
                                            <div class="col-6">
                                            <a href="../cours_details.php" class="btn btn-light px-1 py-0  text-muted"><i class="fa fa-eye  text-primary " aria-hidden="true"></i> Detail</a>
                                            </div>
                                            <div class="col-6 text-right">
                                            <a href="../cours_details.php" class="btn btn-light px-1 py-0  text-muted"><i class="fa fa-trash-o text-danger " aria-hidden="true"></i> supprimer</a> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
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
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <!-- Add course Modals-->
            <div id="InformationproModalalert" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered" >
                    <div class="modal-content ">
                        <div class="modal-close-area modal-close-df">
                            <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                        </div>
                        <div class="modal-body">
                            <form action="#" method="post" id="course-form">
                                <div class="row">
                                    <div class="col-12 mt-1 mb-5 h4 text-center">Ajouter un cours</div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                        <label for="course-cat" class="col-12">Categorie <strong class="text-danger">*</strong> : </label>
                                        <select name="course-cat" id="course-cat" class="form-control" onchange="manageError()"></select>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                        <label for="course-title" class="col-12">Titre <strong class="text-danger">*</strong> : </label>
                                        <input type="text" name="course-title" id="course-title" oninput="manageError()" class="form-control" placeholder="Titre du cours">
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                        <label for="course-price" class="col-12">Prix <strong class="text-danger">*</strong> : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <input type="number" name="course-price" id="course-price" class="form-control" oninput="manageError()" placeholder="Prix du cours">
                                                <div class=" input-group-text">F FCFA</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                        <label for="course-price" class="col-12">Difficultes<strong class="text-danger">*</strong> : </label>
                                        <select name="course-level" id="course-level" class="form-control" onchange="manageError()">
                                                <option value="0">Choisir la difficultes</option>
                                                <option value="0">Difficile</option>
                                                <option value="0">Moyen</option>
                                                <option value="0">Facil</option>
                                        </select>
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                        <label for="course-duration" class="col-12">Duree de formation <strong class="text-danger">*</strong> : </label>
                                        <input type="text" name="course-duration" id="course-duration" oninput="manageError()" class="form-control" placeholder="Duree necessaire">
                                    </div>
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 form-group">
                                        <label  class="col-12">Image de couverture <strong class="text-danger">*</strong> : </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button type="button" class=" btn niceBgBleu text-white input-group-text"><label for="course-img">Selectionner</label></button>
                                                <input type="text" name="course-img-name" id="course-img-name"  class="w-100 pl-2" placeholder="Pas de fichier" disabled>
                                                <input type="file" name="course-img" id="course-img" class="form-control d-none " onchange="manageError()">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group ">
                                        <label class="col-12">Fichier <strong class="text-danger">*</strong> :</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <button type="button" class=" btn niceBgBleu text-white input-group-text"><label for="course-content" class="">Selectionner</label></button>
                                                <input type="text" name="course-content-name" id="course-content-name" class="w-100 pl-2" placeholder="Pas de fichier" disabled>
                                                <input type="file" name="course-content" onchange="manageError()" id="course-content" class="form-control d-none ">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="col-12 form-group">
                                        <label class="col-12" for="course-description">Description: </label>
                                        <textarea type="text" oninput="manageError()" name="course-description" id="course-description" class="form-control" placeholder="Decrire le cours"></textarea>
                                    </div>
                                    <div class="col-12 my-3 h5" id="submitError"></div>
                                    <div class="col-12 text-right">
                                        <input type="button" name="course-reset" id="course-reset" class="btn btn-secondary text-white" value="Annuler">
                                        <input type="button" name="course-add" id="course-add" class="btn niceBgBleu text-white" onclick="uploadData()" value="Ajouter">
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <?php include('footer.php');?>

        <script>

            // recupereration du nom de l'image 
            $("#course-img").change(function(even){
                $("#course-img-name").val(even.target.files[0].name);
                console.log(even.target.files[0].name);
            });

            // recupereration du nom du fichier 
            $("#course-content").change(function(even){
                $("#course-content-name").val(even.target.files[0].name);
                console.log(even.target.files[0].name);
            });

            // mise a jour de l'affichage des erreurs
            function manageError(){
                $("#submitError").html('');
            }

            // Afficher la liste des categories

            function getCatList(){
                $.post(
                    'ajax/ajax.php', {
                        cat_list_key : 'cat_list_key',
                    }, function (donnees){
                        $("#course-cat").html(donnees);
                        $("#cat").html(donnees);
                    });
                }

            // @Jeremie => Ajout de categories
            function addCat(){
                if($("#cat-name").val()==""){
                    $("#catError").html("Champ obligatoire");
                    $("#catError").css('color','red');
                }else{
                    $.post(
                    'ajax/ajax.php', {
                            cat_key : 'add-cat',
                            cat_name : $("#cat-name").val(),
                    }, function (donnees){
                        if(donnees == 1){
                            $("#catError").html("Ajouté avec succès");
                            $("#catError").css('color','green');
                            document.getElementById("cat-form").reset();
                            getCatList();
                        }
                        else{
                            $("#catError").html("Cette categorie existe");
                            $("#catError").css('color','red');
                        }
                    });
                }  
            } 
            
            // cette fonction est charger d'envoyer un nouveau post  

            function uploadData(){
                var course_titre = $("#course-title").val();
                var course_price = $("#course-price").val();
                var course_duration = $("#course-duration").val();
                var course_categories =$("#course-cat option:selected").val();
                var course_level =$("#course-level option:selected").val();
                var course_desc=$("#course-description").val();
                
                if(course_titre =="" || course_price =="" || course_desc =="" || course_categories=="" || $('#course-img')[0].files.length === 0 || $('#course-content')[0].files.length === 0){
                    $("#submitError").html('Tout les champs sont obligatoire');
                    $("#submitError").css('color','red');
                }else{

                    // Verifier si les deux fichiers ne sont pas identique
                    if($("#course-content-name").val()==$("#course-img-name").val()){
                        $("#submitError").html("L'image de couverture doit etre different du fichier");
                        $("#submitError").css('color','red');
                    }else{
                        // verification des extension des fichier

                        // Extension acceptee
                        var img_ext_arr=['.jpg','.png','.jpeg'];
                        var cont_ext_arr=['.pdf','.mp4','.avi'];

                        // Extension des fichier selectionnee
                        img_ex ='.'+$("#course-img-name").val().split('.')[$("#course-img-name").val().split('.').length-1];
                        cont_ex = '.'+$("#course-content-name").val().split('.')[$("#course-content-name").val().split('.').length-1];

                        // si l'extension de l'image n'est pas valide
                        if(img_ext_arr.includes(img_ex.toLowerCase())==false){
                            $("#submitError").html("Cet format d'image n'est pas valide");
                            $("#submitError").css('color','red');
                        }else{
                            // Si l'extension du fichier n'est pas valide
                            if(cont_ext_arr.includes(cont_ex.toLowerCase())==false){
                                $("#submitError").html("Cet format de fichier n'est pas valide");
                                $("#submitError").css('color','red');
                            }else{
                                
                                var fd = new FormData();
                                var files = $("#course-img")[0].files[0];
                                var files2 = $("#course-content")[0].files[0];

                                fd.append('file',files);
                                fd.append('file2',files2);
                                
                                $.ajax({
                                    url: 'ajax/ajax.php',
                                    type:'post',
                                    data:fd,
                                    contentType:false,
                                    processData:false,
                                    dataType:'json',
                                    success:function(response){
                                        
                                        if(response.status==1){
                                            $.post(
                                            'ajax/ajax.php', {
                                                key:'cours',
                                                course_titre:course_titre,
                                                course_price:course_price,
                                                course_duration:course_duration,
                                                course_categories : course_categories,
                                                course_level : course_level,
                                                course_desc:course_desc,
                                                file_name:response.message,
                                            }, function (donnees){
                                                    if(donnees == 1){
                                                        $("#submitError").html("Le cours a été ajouté avec succès");
                                                        $("#submitError").css('color','green');
                                                        document.getElementById("course-form").reset();
                                                        }
                                                    else{
                                                        $("#submitError").html("Echec d'enregistrement");
                                                        $("#submitError").css('color','red');
                                                    }
                                                });
                                            }
                                        else{
                                            $("#submitError").html(response.message);
                                            $("#submitError").css('color','red');
                                        }
                                    }
                                });
                            }
                        }
                    }
                } 
            }






            // @Jeremie=> cette fonction permet de delete un fichier deja upload
            function del_post(id){
                $("#del_id").val(id);
            }
            function conf_del(){
                $.post(
                    'ajax.php', {
                        del_key:"remove",
                        del_id :$("#del_id").val(),
                    }, function (donnees){
                        afficher_post();
                    });
            }
            // @Jeremie=> Cette fonction permet de modifier les infos d'un fichier deja upload
            function edit_post(id){
                $.post(
                    'ajax.php', {
                        set_post_info:"info",
                        file_id:id,
                    }, function (donnees){
                        $("#title").html(donnees.split('~^#')[0]);
                        $("#titre_post_modif").val(donnees.split('~^#')[0]);
                        //    $("#photo_post_modif").val(donnees.split('~^#')[1]);
                        $("#summernot").val(donnees.split('~^#')[2]);
                        $("#up_id").val(donnees.split('~^#')[4]);
                        if(donnees.split('~^#')[3]==1){
                            $("#comment_accept").prop('checked',true);
                        }else{
                            $("#comment_accept").prop('checked',false);
                        }
                    });
            }
            // @Jeremie => cette fonction permet de faire le update final du fichier
            function send_update(){  
                var titre_post_modif = $("#titre_post_modif").val();
                var summernot = $("#summernot").val();
                var iscomment = 0;
                var id = $("#up_id").val();
                if($("#comment_accept").prop("checked") == true){
                    iscomment = 1;
                }

                if(titre_post_modif =="" || summernot ==""){
                    $("#flag_update").html("Les champs precedés par * sont obigatoirs");
                    $("#flag_update").css("color",'red');
                }else{
                        if ($('#photo_post_modif')[0].files.length === 0) {

                            file_detail("Update","",titre_post_modif,summernot,iscomment,id);
                        } else {
                            // descrip:descrip,'nom_module':nom_module,'matricule':matricule
                            var fd = new FormData();
                            var files = $("#photo_post_modif")[0].files[0];
                            fd.append('file',files);
                            $.ajax({
                                url: 'ajax.php',
                                type:'post',
                                data:fd,
                                contentType:false,
                                processData:false,
                                dataType:'json',
                                success:function(response){
                                    if(response.status!=-1){
                                        file_detail("Update",response.message,titre_post_modif,summernot,iscomment,id);
                                    }
                                    else{
                                        $("#error").html(response.message);
                                        $("#error").css("color",'red');
                                    }
                                }
                            });
                        }

                }
            }


            





            // fermeture de modal
            function fermer(){
                afficher_post();
                document.getElementById("upd_form").reset();
                $("#error").html("");
            }
            // Valider un commentaire
            function valide_comment(id){
                $.post(
                    'ajax.php', {
                        valid_key:"ok",
                        valid_id :id,
                    }, function (donnees){
                        afficher_commentaire();
                    });
            }
            // Supprimer un commentaire
            function supp_comment(id){
                $.post(
                    'ajax.php', {
                        del_comm_key:"ok",
                        del_id :id,
                    }, function (donnees){
                        afficher_commentaire();
                    });
            }

            
            
        </script>
    
</body>

</html>