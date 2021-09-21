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

// @Jeremie => Validation de la souscription
if(isset($_FILES['learner_img'])){

   include_once('../functions.php');
   $keys = array('learner_img');
   $num = img_process($keys,'../../assets/learner_preuve');
  echo json_encode($num);
}

// Insertion d'un inscrit
if(isset($_POST['sus_key'])){
   extract($_POST);
   // On verifie si l'utilisateur n'a pas deja fait une inscription du cours et qui est en traitement
   $checkExistSub = $obj->Requete("SELECT * FROM subcription WHERE MATRICULE ='".$id_user."'  AND IDCOURSE ='".$id_course."' AND ACCEPT !=2");
   if($getEl = $checkExistSub->fetch()){
      $updSub = $obj->Requete("UPDATE subcription SET IMG='".$file_name."',PAIEMENT_TYPE='".$payement_type."',PHONE='".$learner_phone."',SUBSCRIPTIONDATE='".$suscrip_date."',AMOUNTPAID='".$amount."',COUNTRY='".$learner_country."', ADRESS='".$learner_address."',POSTAL='".$learner_postal."',ACCEPT=1 WHERE IDSUBCRIPTION='".$getEl['IDSUBCRIPTION']."'");
   }else{
      $addLerner = $obj->Requete("INSERT INTO subcription(IDCOURSE,MATRICULE,AMOUNTPAID, SUBSCRIPTIONDATE,READINGPAGE,IMG,ADRESS,POSTAL,PAIEMENT_TYPE,COUNTRY,PROMO,PHONE) VALUES($id_course,'".$id_user."',$amount,'".$suscrip_date."',0,'".$file_name."','".$learner_address."','".$learner_postal."','".$payement_type."','".$learner_country."','non','".$learner_phone."')");
   }
  
   echo 1;
}

//refresh subcription page

if(isset($_POST['sub_ref_key'])){
   $getSub = $obj->Requete("SELECT * FROM course c, subcription s, subject su WHERE c.IDCOURSE = s.IDCOURSE AND su.IDSUBJECT=c.IDSUBJECT AND s.ACCEPT=1");
   $string = " ";
   $cpt = 1; while($subList = $getSub->fetch()){
      $string.='<tr>
          <td>'.$cpt.'</td>
          <td> <a data-toggle="modal" href="#viewImage"><img src="../assets/learner_preuve/'.$subList['IMG'].'" alt="" onclick="bigImage("'.$subList['IMG'].'")" /></a> 
          </td> <td>'.$subList['SUBJECTNAME'].'</td>
          <td>'.$subList['COURSETITLE'].'</td>
          <td>'.$subList['AMOUNT'].' F CFA</td>
          <td>'.$subList['SUBSCRIPTIONDATE'].'</td>
          <td>'.$subList['PHONE'].'</td>
          <td>
          <button  title="Edit" class="pd-setting-ed"  data-toggle="modal" href="#validePay" onclick="setValId('.htmlspecialchars($subList["IDSUBCRIPTION"]).')"><i class="fa fa-check text-success" aria-hidden="true"></i></button>
          <button title="Trash" class="pd-setting-ed" data-toggle="modal" href="#rejectPay" onclick="setDelId('.htmlspecialchars($subList["IDSUBCRIPTION"]).')"><i class="fa fa-trash-o text-danger" aria-hidden="true"></i></button>
          </td>
      </tr>';
      $cpt++;} 
      echo $string;
}

// valider paiement
if(isset($_POST['vali_key'])){
   extract($_POST);
   $validePay = $obj->Requete("UPDATE subcription SET ACCEPT=2 WHERE IDSUBCRIPTION='".$val_id."'");
   echo 1;
}
if(isset($_POST['del_key'])){
   extract($_POST);
   $rejectPay = $obj->Requete("UPDATE subcription SET ACCEPT=0 WHERE IDSUBCRIPTION='".$del_id."'");
   echo 1;
}

// redirection ver le dashboard
if(isset($_POST['check_pay'])){
   extract($_POST);
   $targetResp = $obj->Requete("SELECT * FROM subcription WHERE MATRICULE ='".$id_user."'  AND IDCOURSE ='".$id_course."' AND ISDONE=0");
   if($getRest = $targetResp->fetch()){
      if($getRest['ACCEPT']==2){Redirect("../../learner/index.php");}elseif($getRest['ACCEPT']==1){echo 1;} else{echo 0;};
   }
}

?>  



