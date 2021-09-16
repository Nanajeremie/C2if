<?php
include("../../../utilities/QueryBuilder.php");
$obj = new QueryBuilder();

// @Jeremie => insertion des cours
 if(isset($_FILES['file'])){

      include_once('../functions.php');
      $keys = array('file','file2');
      $num = img_process($keys,'../../assets/fichier_cours');
     echo json_encode($num);
 }

 if(isset($_POST['key'])){
    extract($_POST);

    $cover = explode('&',$file_name)[0];
    $content = explode('&',$file_name)[1];
    $add = $obj->Requete("INSERT INTO course(IDSUBJECT, IDADMIN, COURSETITLE, LEVEL, DURATION, AMOUNT, COURSCOVER, COURSECONTENT, COURSEDESCRIPTION, UPLOADDATE) VALUES($course_categories,2,'".$course_titre."','".$course_level."','".$course_duration."',$course_price,'".$cover."','".$content."','".$course_desc."',NOW())");
    echo 1;
 }
// Ajout de categorie
 if(isset($_POST['cat_key'])){
      extract($_POST);
      //  On verifie si la categorie n'existe pas deja
      $checkCat = $obj->Requete("SELECT SUBJECTNAME FROM subject WHERE SUBJECTNAME='".strtoupper($cat_name)."'");
      if($checkCat->rowCount()>=1){
         echo 0;
      }else{
         $add = $obj->Requete("INSERT INTO subject(SUBJECTNAME, SUBJECTIMAGE) VALUES('".strtoupper($cat_name)."','Image')");
         echo 1;
      }
 }

// Affichage de la liste des categories
if(isset($_POST['cat_list_key'])){
   $getCatList = $obj->Requete("select * from subject");
   $string = '<option value="0">Categorie</option>';

   while($listes = $getCatList->fetch()){
      $string .= "<option value=".$listes['IDSUBJECT'].">".$listes['SUBJECTNAME']."</option>";
   }

   echo $string;
}

?>




