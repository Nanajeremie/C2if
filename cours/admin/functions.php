<?php

function img_process($file,$location){
    $filesName = "";
    for($i = 0; $i<count($file); $i++){

        $_fileType = $_FILES[$file[$i]]['type'];
        $_fileName = $_FILES[$file[$i]]['name'];
        $_file_Tmp = $_FILES[$file[$i]]['tmp_name'];
        $_file_size = $_FILES[$file[$i]]['size'];

        $response= array(
            'status'=>-1,
            'message'=>$filesName,
        );
        if($_FILES[$file[$i]]['error'] == 0 ){

        $extension = explode(".",$_fileName);
        $extension = ".".$extension[count($extension)-1];
        $extensions_array =array(".png",".jpeg",".jpg",".pdf",".mp4",".avi");
        
        if(in_array(strtolower($extension),$extensions_array)){
            $file_location = $location."/".$_fileName;
            if($_file_size<=2000000){
                if(move_uploaded_file($_file_Tmp,$file_location)){
                    $filesName .=$_fileName;
                    $response['status']=1;
                    $response['message'] =$filesName;

                    if(count(explode('&',$filesName))>=1){
                        $filesName.='&';
                    }
                    
                }else{
                    $response['status']=00;
                    $response['message'] = "Erreur detecté. Le fichier ".$_fileName. " N'a pas ete enregistree";
                    break;
                }
            }else{
                $response['message'] = "Erreur detecté. Votre fichier ".$_fileName. " est lourd";
                break;
                $response['status']=0;
            }
        }else{
            $response['message'] = "Erreur detecté. L'extension ".$extension." du fichier ".$_fileName." n'est pas autorisé";
            $response['status']=0;
            break;
            }
        }else{
        $response['message'] = "Erreur detecté. Impossible de charger le ficher ".$_fileName; 
        $response['status']=0;   
        break;  
        }
       
    }
    return $response;
}
?>