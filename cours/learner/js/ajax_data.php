<?php
    include("../../../utilities/QueryBuilder.php");
    $obj = new QueryBuilder();
    if(isset($_POST))
    {
        extract($_POST);
        $obj->Requete('UPDATE subcription set READINGPAGE='.$page.' WHERE MATRICULE = "'.$matricule.'" and IDCOURSE ='.$idCourse.' and IDSUBCRIPTION ='.$idSub);
    }

?>