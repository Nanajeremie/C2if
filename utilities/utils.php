<?php 
session_start();

	//Redirige l'utilisateur vers l'URL
	function Redirect($path, $time = 0)
	{
		if($time!=0)
		{
			sleep($time);
		}
		
		header("Location: ".$path);
		exit();
	}

	/*methode pour upload des fichiers
	NB: les fichiers seront enregistres dans un dossier creer au prealable et de nom a preciser
	les fichiers peuvent etre envoyes avec l'attribut multiple html5*/

	function Files($inputName, $folder, $type)
	{
		if (isset($_FILES[$inputName]) AND !empty($_FILES[$inputName]))
		{
			/*on check que cest lattribut multiple qui est utilise
				si oui on recuperera les donnees sous form
			*/
				
			if (is_array($_FILES[$inputName]['name'])) 
			{
				//on declare notre variable de retour qui sera un array
				$file = array();
				for ($i = 0; $i < count($_FILES[$inputName]['name']); $i++)
				{ 
					//on recupere le nom entier du fichier envoye
					$infosfichier = pathinfo($_FILES[$inputName]['name'][$i]);

					//on recupere l'extension du fichier
					$extension_upload = $infosfichier['extension'];
					$extension_autorisees; 
					//on definit les extensions autorisees
					if (is_numeric($type)) 
					{
						switch ($type) 
						{
							// 1 pour les images
							case 1:
								$extension_autorisees = array('jpg','jpeg', 'png', 'gif', 'JPEG','JPG', 'PNG', 'GIF');
								break;
							// 2 pour les audios
							case 2:
								$extension_autorisees = array('mp3','mp4', 'wav', 'MP3','MP4', 'WAV' );
								break;
							// 3 pour les videos
							case 3:
								$extension_autorisees = array('mp3','mp4', 'wav', 'avi', 'flv', 'vob', 'MP3','MP4', 'WAV', 'AVI', 'FLV', 'VOB');
								break;
							// pour les documents word, excel, pdf et powerpoint
							case 4:
								$extension_autorisees = array('doc', 'docs', 'xls', 'pdf', 'pptx');
								break;
								// 7 pour tous les types
							default:
									$extension_autorisees = array('jpg','jpeg', 'png', 'gif', 'JPEG','JPG', 'PNG', 'GIF', 'mp3','mp4', 'wav', 'MP3','MP4', 'WAV', 'avi', 'flv', 'vob', 'MP3','MP4', 'WAV', 'AVI', 'FLV', 'VOB');
									break;
						}
					}
					
					//on verifie que l'extension du fichier uploade est parmi celles autorisees
					if(in_array($extension_upload, $extension_autorisees))
					{	
						//on deplace le fichier vers le dossier $folder specifie
						move_uploaded_file($_FILES[$inputName]['tmp_name'][$i], './'.$folder.'/'.basename($_FILES[$inputName]['name'][$i]));
						//echo $_FILES[$inputName]['name'][$i];
						array_push($file, $_FILES[$inputName]['name'][$i]);
						//on retourne le nom du fichier + son extension pour une eventuelle mise a jour ou une insertion dans la base de donnee
					}
					//si l'extension du fichier nexiste pas dans notre liste ou si le type de $type nest pas numerique
					if (!is_numeric($type) || !in_array($extension_upload, $extension_autorisees))
					{
						$error = "Erreur lors de l'enregistrement du fichier: fichier trop lourd ou extension nom supportee ";
						echo $error;
						return 0;
					}
				}
				//on retourne la liste des fichiers uploades sous forme de tableau
				return $file;
			}
			else
			{
				//on recupere le nom entier du fichier envoye
				$infosfichier = pathinfo($_FILES[$inputName]['name']);
				//on recupere l'extension du fichier
				$extension_upload = $infosfichier['extension'];
				$extension_autorisees; 
				//on definit les extensions autorisees
				if (is_numeric($type)) 
				{
					switch ($type) 
						{
							// 1 pour les images
							case 1:
								$extension_autorisees = array('jpg','jpeg', 'png', 'gif', 'JPEG','JPG', 'PNG', 'GIF');
								break;
							// 2 pour les audios
							case 2:
								$extension_autorisees = array('mp3','mp4', 'wav', 'MP3','MP4', 'WAV' );
								break;
							// 3 pour les videos
							case 3:
								$extension_autorisees = array('mp3','mp4', 'wav', 'avi', 'flv', 'vob', 'MP3','MP4', 'WAV', 'AVI', 'FLV', 'VOB');
								break;
							// pour les documents word, excel, pdf et powerpoint
							case 4:
								$extension_autorisees = array('doc', 'docx', 'docs', 'xls', 'pdf', 'pptx');
								break;
								// 7 pour tous les types
							default:
									$extension_autorisees = array('jpg','jpeg', 'png', 'gif', 'JPEG','JPG', 'PNG', 'GIF', 'mp3','mp4', 'wav', 'MP3','MP4', 'WAV', 'avi', 'flv', 'vob', 'MP3','MP4', 'WAV', 'AVI', 'FLV', 'VOB');
									break;
						}
				}

				//on verifie que l'extension du fichier uploade est parmi celles autorisees
				if(in_array($extension_upload, $extension_autorisees))
				{	
					//on deplace le fichier vers le dossier $folder specifie
					move_uploaded_file($_FILES[$inputName]['tmp_name'], './'.$folder.'/'.basename($_FILES[$inputName]['name']));
					$file = $_FILES[$inputName]['name'];
					//on retourne le nom du fichier + son extension pour une eventuelle mise a jour ou une insertion dans la base de donnee
					return $file;
				}
				//si l'extension du fichier nexiste pas dans notre liste ou si le type de $type nest pas numerique
				if (!is_numeric($type) || !in_array($extension_upload, $extension_autorisees))
				{
					$error = "Erreur lors de l'enregistrement du fichier: fichier trop lourd ou extension nom supportee ";
					echo $error;
					return "";
				}
			}
		}
	}
	/*
   methode securisation des donnees envoyees a la base afin deviter les injections et autres failles dues aux donnees envoyees par lutilisateur
   */
	function Protect($chaine)
	{
		if (!is_numeric($chaine) AND !is_array($chaine)) 
		{
			// on supprime les caractères invisibles en début et fin de chaîne
		   $chaine = trim($chaine);
		   //var_dump($chaine);
		   // on supprime les les balises se trouvant dans la chaîne
		   $chaine = Strip_tags($chaine);
		   // si magic quote est activé on ajoute des slashes
		   if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc())
		   {
		   		$chaine = stripslashes($chaine);
		   } 
		       
		} 
		else if (is_array($chaine))
		{
			// on supprime les caractères invisibles en début et fin de chaîne
		   $chaine = array_map('trim', array_values($chaine));
		   //var_dump($chaine);
		   // on supprime les les balises se trouvant dans la chaîne
		   $chaine = array_map('Strip_tags', array_values($chaine));
		   // si magic quote est activé on ajoute des slashes
		   if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc())
		   {
		   		$chaine = array_map('stripslashes', array_values($chaine));
		   } 
		}

		return $chaine; // on retourne le résultat final     
	}
	/*fonction pour la creation des sessions*/
    function setSession($varSession, $Field)
    {
    	 $_SESSION[$varSession] = $Field;//On créer une variable session qui à pour valeur l'id de l'utilisateur logé
    }
    //fonction de destuction des sessions
    function unsetSession($varSession)
	{	
		//on detruit la session 		
		session_destroy($_SESSION[$varSession]);
		if(isset($_SESSION[$varSession]))
		{
			return false;
		}
		else
		{
			return true;
		}
	}
	//fonction denvoie de mail personalisee
	function Sendmail($auteur, $destinataire, $sujet, $message)
	{
		$destinataire;
		$sujet;
		//retour a la ligne automatique apres 70 mots par ligne
		$message = wordwrap($message, 70);
		//If a full stop is found on the beginning of a line in the message, it might be removed. To solve this problem, replace the full stop with a double dot
		$message = str_replace('\n.', '\n..', $message);
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		//definition de l'auteur du message
		$headers .= 'From: <'.$auteur.'>' . "\r\n";
		//on mets laddresse de lauteur en copie pour s'assurer que le mesage est bien envoye
		$headers .= 'Cc: '.$auteur.'' . "\r\n";

		mail($destinataire, $sujet, $message, $header);
	}

	function SetMessage($message, $type)
	{
		$msg='';
		switch ($type) 
		{
			case 'success':
				$type = 'success alert-success text-success';
				break;
			case 'alert':
				$type = 'info alert-danger text-danger';
				break;
			case 'info':
				$type = 'info alert-info text-info';
				break;
			case 'warning':
				$type = 'warning alert-warning text-warning';
				break;
			
			default:
				# code...
				break;
		}

		$msg='<div class="'.$type.' p-2">'.$message.'</div>';
		return $msg;
	}
	//function pour reformer la date pour lafficher dans u input de type date
	function ShowDate($date)
	{
		$date = substr($date, 0, 10);
		return $date;
	}

	//fonction pour lister les fichiers dans un repertoire
	function ShowFiles($path = '', $fileName = '', $extension = '')
	{
		$listeOfFiles = array();
		//on verifie que le chemin est defini
		if (!empty($path))
		{
			//sil nya ni dextension, ni de nom de fichier, alors on liste tous les fichiers quelque soit leur extension
			if (empty($extension) AND empty($fileName)) 
			{
				$listeOfFiles = glob($path."/*.*");
			}
			//sil ya dextension, mais pas de nom de fichier, est defini alors on liste tous les fichiers quelque soit leur extension
			elseif (!empty($extension) AND empty($fileName)) 
			{
				$listeOfFiles = glob($path."/*.".$extension);
			}
			//sil nya pas dextension, mais le du nom de fichier, est defini alors on liste tous les fichiers en fonction du nom voulu
			elseif (empty($extension) AND !empty($fileName)) 
			{
				$listeOfFiles = glob($path."/".$fileName.".*");
			}
			//si non, on fait des fichier en fonctin de lextension et du du nom voulu
			else
			{
				$listeOfFiles = glob($path."/".$fileName.".".$extension);
			}
			//retour de la liste des fichiers
			return $listeOfFiles;
		}
		//si non, on retourne 0
		else
		{
			return 0;
		}
	}
	//function pour retourner le nom de la page courante
	function GetCurrentPageName()
	{
		return $_SERVER['PHP_SELF'];
	}
	//function pour rafraichir/rechrager la page actuelle
	function Refresh($time = 0)
	{
		Redirect(GetCurrentPageName(), $time);
	}

	function alert(string $type, string $description, string $animation = "slideInRight"):void
    {
        $alert_code = "	<div class='row'>
							<div class='col-12 col-lg-6 col-md-4'>
								<div class='d-block alert ";
        $icone = "fas ";
        switch ($type) 
        {
            case 'success':
                $alert_code .= "alert-success";
                $icone .= "fa-check";
                break;
            case 'danger':
                $alert_code .= "alert-danger";
                $icone .= "fa-bell";
                break;
            case 'warning':
                $alert_code .= "alert-warning";
                $icone .= "fa-exclamation-triangle";
                break;
            case 'primary':
                $alert_code .= "alert-primary";
                $icone .= "fa-exclamation";
                break;
            default:
                $alert_code .= "alert-info";
                $icone .= "fa-exclamation-circle";
                break;
        }

        $alert_code .= " alert-dismissible fixed-top mt-0 mt-lg-2 ml-auto w-25 show wow ".$animation ." ' role='alert'>
                        <div class='row align-items-center'>
                            <div class='col-auto'>
                                <span class='fa-2x $icone'></span>
                            </div>
                            <div class='col'>
                                <h6 class='text-capitalize'>$type</h6>
                                <p class='small'> $description </p>
                            </div>

                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                <span class='sr-only'>Close</span>
                            </button>
                        </div>
                    </div>
				</div>
			</div>
		</div>";
        
		echo $alert_code;

	}
	

//fonction pour creer un dossier
function CreateDirectory($pathdir)
{
	if (!is_dir($pathdir)) 
	{
		system("mkdir ".$pathdir);
		return $pathdir;
	}
}

//function to write in a log file
function LogWrite($action = "", $user = '', $table = "", $values = array(), $path = '', $fileName="logs_record.txt")
{
	// $path = dirname(GetCurrentPageName(), 4);
	// $path = $path."/LOG"; 
	// $path = str_replace('/', "\\", $path);
	// //$path .= $path;
	// $folder_year = CreateDirectory("..\\..\\..\\LOG\\".date("Y"));
	// $folder_month = CreateDirectory($folder_year."\\".date("m"));
	// $path = $folder_year;
	
	/*
	creation of the string as the record
	*/
	if(!empty($path) AND is_dir($path) AND !empty($fileName))
	{
		try
		{
			//opening the file in writing and reading mode
			$logs_record = fopen($path.DIRECTORY_SEPARATOR.$fileName, 'a+');
			try
			{
				//if the file "current_log_line_line" doesnt exists we'll create it
				if (!is_file($path.DIRECTORY_SEPARATOR."current_log_line.txt"))
				{
					touch($path.DIRECTORY_SEPARATOR."current_log_line.txt");
					$test = fopen($path.DIRECTORY_SEPARATOR."current_log_line.txt", 'w+');
					fputs($test, 0);
					fclose($test);
				}
				// 1 - adding the number of line/incrementation of the number of line
				$current_log_line = fopen($path.DIRECTORY_SEPARATOR."current_log_line.txt", 'r+');
				//fetching the current line value
				$log_line_count = fgets($current_log_line);
				//adding the number of line
				$line = $log_line_count;
				//reseting the cursor at the start of the file
				fseek($current_log_line, 0);
				//incrementation of the current line value
				$log_line_count++;
				//insertion of the current line value++
				fputs($current_log_line, $log_line_count);
				// 2 - adding the current date to the string for the log
				$line .= "| ".date('m/d/Y H:i:s');
				//
				$line .= '| '.$user;
				// 3 - adding the action done (to the string for the log)
				$line .= " | ".$action;
				//we checks if there is a now() value is in the array 
				if (in_array("NOW()", $values)) 
				{
					//look for the index of now
					$indexof = array_search("NOW()", $values);
					//setting the date value to the index of "NOW()"
					$values[$indexof] = date('m/d/Y H:i:s');
				}
				// 4 - adding the values
				$line .= " | ".implode(', ', $values);
				// 5 - adding the table where occurs
				$line .= "| ".$table.PHP_EOL;
				//start writng into the file
				fputs($logs_record, $line);
				//closing the opened file
				fclose($logs_record);
			}
			catch (Exception $error)
			{
				echo "The file isn't found !!!";
			}
			fclose($current_log_line);
		}
		catch (Exception $error)
		{
			echo "The file isn't found !!!";
		}
	}
}

//applies correct separator to a certain path
function Correct_sep($path)
{
	$path = str_replace('/', DIRECTORY_SEPARATOR, $path);
	$path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
	return $path;
}

function __($str)
{
	print('<br>'.$str.'<br>');
}

//function to find relative path of a file function of a file
function RelativePath($abs_path)
{
	function to_folder_path($path)
	{
		if($path != '')
		{
			if($path[strlen($path)-1] != DIRECTORY_SEPARATOR)
			{$path .= DIRECTORY_SEPARATOR;}
			if($path[0] == DIRECTORY_SEPARATOR)
			{$path = substr($path, 1);}
		}
		return $path;
		
	}
    $abs_path = Correct_sep($abs_path);
    $abs_path = to_folder_path($abs_path);

    //get the current directory complete path
    $current_dir_name = dirname(realpath(basename($_SERVER['PHP_SELF']))).DIRECTORY_SEPARATOR;
    //get the current file complete path
    $current_file_name = $current_dir_name.DIRECTORY_SEPARATOR.basename($_SERVER['PHP_SELF']);
    $current_dir_name = to_folder_path($current_dir_name);
    //if the abs_path is a directory
	__(realpath($abs_path));
	__($abs_path);
	__(realpath("wamp64\www\Opensch_final_version\Web-Application-Coding\assets\media"));
	var_dump(is_dir($abs_path));
    if(is_dir($abs_path))
    {
        //cursor
        $cursor = 0;
        //str_arr
        $str_arr = [];
        if(strlen($abs_path) >= strlen($current_dir_name))
        {
            $str_arr[0]=$current_dir_name;
            $str_arr[1]=$abs_path;
        }
        else
        {
            $str_arr[0]=$abs_path;
            $str_arr[1]=$current_dir_name;
        }

        //get the last index of intersection between both paths
        for ($i = 0; $i < strlen($str_arr[0]); $i++)
        {
            //cursor is the last index
            $cursor = $i;
            //if we reach an index when characters arent same, we exit the loop   
            if($str_arr[0][$i] != $str_arr[1][$i])
            {
                break;
            }
        }
        //gets the parent folder pf both files
        $parent_folder = substr($current_dir_name, 0, $cursor);
        $parent_folder = to_folder_path($parent_folder);

        //gets the source of the file
        $file_source = substr($current_dir_name, $cursor);
        $file_source = to_folder_path($file_source);

        //gets the abs path source
        $abs_source = substr($abs_path, $cursor);
        $abs_source = to_folder_path($abs_source);
        $abs_path = to_folder_path($abs_path);

        //gets the number of times we must go back to reach the parent folder
        $back_to_root = count(explode(DIRECTORY_SEPARATOR, $file_source));
        //creates the relative path to reach absolute path passed in params
        $rel_path = '';
        if($back_to_root-1==0){$rel_path='.'.DIRECTORY_SEPARATOR;}
        for($i = 0; $i < $back_to_root-1; $i++)
        {
            $rel_path .= '..'.DIRECTORY_SEPARATOR;
        }
        $rel_path .= $abs_source;
        $rel_path = to_folder_path($rel_path);
        if(is_dir($rel_path))
        {return $rel_path;}
    }
}

 ?>