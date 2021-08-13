<?php
/*appel du fichier contenant la connection a la base de donnees*/
require 'utils.php';

//fonction de connection a la base de donnees
function getPdo()
{
    $pdo = new PDO("mysql:host=localhost;dbname=c2ifdb", "root", "", [PDO:: MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8", PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]);

    return $pdo;
}
//function to set the path for logs
function getLogsPath($path)
{
    //gets the root folder of the project
    $path = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.$path;
    //adding separators function of the OS of the server
    //$path .= DIRECTORY_SEPARATOR.'Opensch_final_version'.DIRECTORY_SEPARATOR.'Web-Application-Coding'.DIRECTORY_SEPARATOR.'LOG'.DIRECTORY_SEPARATOR;
    $path = Correct_sep($path);
    //gets the absolute path of the log folder
    $path = realpath($path);
    if(!empty($path))
    {
        return $path;
    }
}
//function to get the username
function getUsername()
{
    if(isset($_SESSION['USERNAME']) AND !empty($_SESSION['USERNAME']))
    {
        $username = $_SESSION['USERNAME'];
    }
    else
    {
        $username = 'Guest';
    }
    return $username;
}

class QueryBuilder
{
    /*$pdo : variable qui recupere l'objet pdo de la connection a la base de donnees*/
    /*$pdo est protege car toutes classes heritante de QueryBuilder pourra heriter de ladite variable*/

    public $pdo;
    protected $message;
    protected $table;
    protected $columns;
    protected $values;
    protected $status;
    protected $orderBy;
    protected $order;
    protected $showMessage = true;
    protected $username;
    protected $log_write = true;
    protected $path_for_logs;

    /**
     * constructeur pour affectation de l'instance PDO a $pdo
     * affectation du chemmin pour les logs
     * affectation du username
     */
    public function __construct()
    {
    	$this->pdo = getPdo();
        $this->path_for_logs = getLogsPath('/c2if/C2if/Log');
        $this->username = getUsername();
    }

    	/*
    	NB:-$status sera un tableau associatif, d'ou l'utilisation de la boucle while pour faciliter les choses
    	   -$message represente le message que l'on pourra passer dans les fonctions afin quelles soient affichees a la fin de ces dernieres
    	   -$error represente les messages derreur affiches a lutilisateur
    	*/
    /*methode pour la creeation de cookies*/
    public function set_cookies($cookies)
    {
        foreach ($cookies as $key => $value)
        {
            setcookie($key, $value, time()+365*24*3600,null,null,false,true);
        }
    }
    /*function de selection de toutes les donnees dans une table */
    public function Select( $table = '', $columns = array(), $status = array(), $orderBy = '', $order = 1)
    {
        try
        {
                //on assanie les variables passees en parametre
            $table = Protect($table);
            $columns = array_map('Protect', array_values($columns));
            $orderBy = Protect($orderBy);
            $fields = array_keys($status);
            $values = array_map('Protect', array_values($status));
            $status = array_combine($fields, $values);
            $sql = "SELECT ";
            //on verifie que columns nest pas vide
            if (!empty($columns))
            {
                //on ajoute a la fin de chaque column une virgule
                for ($i=0; $i < count($columns); $i++)
                {
                    $sql .= $columns[$i];
                    //la derniere column naura pas de virgule apres
                    if ($i < count($columns) - 1)
                    {
                        $sql .= ", ";
                    }
                }
            }
            //si columns est vide, alors on selectionne toutes les lignes
            else
            {
                $sql .= "*";
            }
            // on choisie la table a utiliser
            $sql .= " FROM ".$table;
            //on verifie que $status nest pas vide
            if (!empty($status))
            {
                //on lui passe la clause where
                $sql .= " WHERE ";
                $i = 0;
                //on ajoute le status a toute la requete
                foreach ($status as $col => $value)
                {
                    //on verifie que $value est une chaine et quil nest pas utilisee pour une jointure, si oui on y ajoute des single quotes
                    if (!is_numeric($value) AND stripos($value, '.') == FALSE)
                    {
                        $value = "'".$value."'";
                    }
                    $sql .= $col."= ".$value."";
                    //le dernier etat naura pas de virgule apres
                    if ($i < count($status) - 1)
                    {
                        $sql .= " AND ";
                    }
                    $i++;
                }

            }
            // on verifie que l'ordre est definie
            if (!empty($orderBy))
            {
                if (is_numeric($order) AND $order == 1)
                {
                    $sql .= " ORDER BY ".$orderBy." ASC ";
                }
                else
                {
                    $sql .= " ORDER BY ".$orderBy." DESC";
                }
            }
            //on execute la requete
            // echo $sql;
            $req = $this->pdo->query($sql);
            /*les resultats seront retournees avec fetch au lieu de fetchAll et de leur attibuts FETCH_OBJ, FETCH_ASSOC, afin d'eviter les erreurs de retour de donnees avec les boucles for ou foreach. Peu importe le nombre de lignes les resultats pourraient etre affichees sous forme de while(donnees), avec donnees = $result = $req->fetch();
            */
            //sil y a pas de resultats correspondant a la requete
            if ($req->rowCount()==0)
            {
                return null;
            }
            else
            {
                //on retourne le resultat de la requete
                return $req;
            }
        }

        catch (Exception $e)
        {
            $this->GetExceptionMessage($e);
        }
    }

    /*methode pour recherche dans une table*/
    public function Search( $table = '', $status = array())
    {
        try
        {
	    	//on assanie les variables passees en parametre
	    	$table = Protect($table);
	    	$fields = array_keys($status);
	    	$values = array_map('Protect', array_values($status));
	    	$status = array_combine($fields, $values);
	    	// on choisie la table a utiliser
	    	$sql = "SELECT * FROM ".$table;
	    	//on verifie que $status nest pas vide
	    	if (!empty($status))
	    	{
	    		//on lui passe la clause where
	    		$sql .= " WHERE ";
	    		$i = 0;
	    		//on ajoute le status a toute la requete
	    		foreach ($status as $col => $value)
	    		{
	    			//on verifie que $value est une chaine, si oui on y ajoute des single quotes
	    			if (!is_numeric($value))
	    			{
	    				$value = "'%".$value."%'";
	    				$sql .= $col." LIKE ".$value."";
	    			}
	    			else
	    			{
	    				$sql .= $col." = ".$value."";
	    			}

	    			//le dernier etat naura pas de virgule apres
	    			if ($i < count($status) - 1)
	    			{
	    				$sql .= " AND ";
	    			}
	    			$i++;
	    		}
	    	}

        	//on execute la requete
        	$req = $this->pdo->query($sql);
        	// sil ya une erreur, on affiche
        	if ($req->rowCount()==0)
        	{
            	return null;
        	}
        	else
        	{
        		/*les resultats seront retournees avec fetch au lieu de fetchAll et de leur attibuts FETCH_OBJ, FETCH_ASSOC, afin d'eviter les erreurs de retour de donnees avec les boucles for ou foreach. Peu importe le nombre de lignes les resultats pourraient etre affichees sous forme de while(donnees), avec donnees = $result = $req->fetch();
        	*/
        		return $req;
        	}
        	//afin d’éviter d’avoir des problèmes à la requête suivante, on ferme la connection a base de donnees
        	$req->closeCursor();
        	//echo $sql."<br>";
        }
        catch (Exception $e)
        {
            $this->GetExceptionMessage($e);
        }
    }
    /*methode dinsertion des donnees dans une table*/
   	public function Insert($table = '', $columns = array(), $values = array())
    {
	    try
        {

            //on assanie les variables passees en parametre
	    	$table = Protect($table);
	    	$columns = array_map('Protect', array_values($columns));
            $values = array_map('Protect', array_values($values));
            //creation of a copy variable for the values to keep in the log file
            $values_for_logs = $values;

		    	//on verifie que columns nest pas vide
		    	if (!empty($columns))
                {
                    $sql = "INSERT INTO ".$table." ( ";
                    //on ajoute a la fin de chaque column une virgule
                    for ($i=0; $i < count($columns); $i++)
                    {
                        //la derniere column naura pas de virgule apres
                        $sql .= $columns[$i];
                        if ($i < count($columns) - 1)
                        {
                            $sql .= ", ";
                        }
                    }
                    $sql .= " ) ";
                }
		    	//si columns est vide
		    	else
		    	{
		    		$sql = "INSERT INTO ".$table." ";
		    	}
		    	$sql .= " VALUES (";
		    	//on ajoute a la fin de chaque value une virgule
		    	for ($i=0; $i < count($values); $i++)
		    		{
		    			//on verifie que $value est une chaine, si oui on y ajoute des single quotes
		    			if (!is_numeric($values[$i]) AND $values[$i] != 'NOW()')
		    			{
		    				$values[$i] = "'".$values[$i]."'";
		    			}
			    		$sql .= $values[$i];
			    		//la derniere column naura pas de virgule apres
			    		if ($i < count($values) - 1)
			    		{
			    			$sql .= ", ";
			    		}
		    		}
		    	$sql .= " )";
                //echo $sql;
		    	//on execute la requete
		    	$req = $this->pdo->query($sql);
                //if the we have to records logs
                if ($this->log_write == true)
                {
                    //writing in log file
                    LogWrite($action = "INSERTION", $this->username, $table, $values_for_logs , $this->path_for_logs);
                }
                return $req;
        }
        catch (Exception $e)
        {
            $this->GetExceptionMessage($e);
        }
   }

	/*methode pour verifier que l'entree nexiste pas deja dans la table*/
	public function Inscription( $table = '', $columns = array(), $values = array(), $status = array())
	{
		try
        {

            $sql = 'SELECT * FROM '.$table.' WHERE ';
            $i = 0;
            foreach ($status as $col => $value)
            {
                //on verifie que $value est une chaine, si oui on y ajoute des single quotes
                if (!is_numeric($value))
                {
                    $value = "'".$value."'";
                }
                $sql .= $col.' = '.$value;
                //la derniere column naura pas de 'AND' apres
                if ($i < count($status) - 1)
                {
                    $sql .= " AND ";
                }
                $i++;
                //echo $sql."<br>";
            }
            // on execute la requete
            $req = $this->pdo->query($sql);
            //var_dump($req);
            // si le nombre de resulats pour la requete est superieure a 1 <==> la donnee existe donc on affiche un message derreur
            if ($req->rowCount()>0)
            {
                return null;
            }
            //si non, on insert dans la base de donnees, les donnees les data envoyees par lutilisateur
            else
            {
                $req = $this->Insert($table, $columns, $values);
                //on retourne le resultat de la requete
                return $req;
            }


        }
        catch (Exception $e)
        {
            $this->GetExceptionMessage($e);
        }
	}

    /*methode de mise a jour des donnees*/
    public function Update( $table = '', $columns = array(), $values = array(), $status = array())
    {
        //creation of variables for logs
        $values_for_logs = array();
        try
        {
        	//on assanie les variables passees en parametre
        	$table = Protect($table);
        	$columns = array_map('Protect', array_values($columns));
        	$values = array_map('Protect', array_values($values));
        	$fields = array_keys($status);
        	$values2 = array_map('Protect', array_values($status));
        	$status = array_combine($fields, $values2);
            
            $sql = "UPDATE ".$table." SET ";
            //on verifie que columns nest pas vide


            for ($i=0; $i < count($columns); $i++)
                {
                    //on verifie que $value est une chaine et different de 'NOW()' lheure actuelle], si oui on y ajoute des single quotes, si oui on y ajoute des single quotes
                    if (!is_numeric($values[$i]) AND $values[$i] != 'NOW()')
                    {
                        $values[$i] = "'".$values[$i]."'";
                    }
                    // on etablit la correspondance de chaque colonne a sa valeur
                    $sql .= $columns[$i]." = ".$values[$i]."";
                    //la derniere column naura pas de virgule apres
                    if ($i < count($columns) - 1)
                    {
                        $sql .= ", ";
                    }
                    //if the we have to records logs
                    if($this->log_write == true)
                    {
                        $values_for_logs[] = $columns[$i]." = ".$values[$i];
                    }
                }
            $sql .= " WHERE ";
            foreach ($status as $col => $value)
            {
                //on verifie que $value est une chaine et different de 'NOW()' [pour linsertion de lheure actuelle], si oui on y ajoute des single quotes
                if (!is_numeric($value) AND $value != 'NOW()')
                {
                    $value = "'".$value."'";
                }
                //echo $col."<br>";
                $sql .= $col." = ".$value."";
                //la derniere column naura pas 'AND' apres
                if ($i < count($status) - 1)
                {
                    $sql .= " AND ";
                }
                $i++;
            }
            $sql .= " LIMIT 1";
            //
            //on execute la requete
            //  echo $sql."<br>";
            $req = $this->pdo->query($sql);
            //if the we have to records logs
            if ($this->log_write == true)
            {
                //writing in log file
                LogWrite($action = "UPDATE", $this->username, $table, $values_for_logs, $this->path_for_logs);
            }
            // si l'option de message est activee et le message nest pas vide//si l'option message est active et definit, on affiche
            //NB: $message pourra etre encadre de balises HTML, un comportement CSS ou BOOTSTRAP
            if (!empty($message))
            {
                //echo $message;
            }

            return $req;
        }
        catch (Exception $e)
        {
            $this->GetExceptionMessage($e);
        }
    }
    /*methode de supression de donnees*/
    public function Delete($table = '', $status = array())
    {
        try
        {
        	//on assanie les variables passees en parametre
        	$table = Protect($table);
        	$fields = array_keys($status);
        	$values = array_map('Protect', array_values($status));
        	$status = array_combine($fields, $values);
            //creation of variable for logs
            $values_for_logs = array();

        	$i = 0;
        	$sql = "DELETE FROM ".$table." WHERE ";
        	foreach ($status as $col => $value)
    		{
    			//on verifie que $value est une chaine, si oui on y ajoute des single quotes
    			if (!is_numeric($value))
    			{
    				$value = "'".$value."'";
    			}
    			$sql .= $col." = ".$value."";
    			//le dernier value naura pas 'AND' apres
    			if ($i < count($status) - 1)
    			{
    				$sql .= " AND ";
    			}
    			$i++;
                //if the we have to records logs
                if($this->log_write == true)
                {
                    $values_for_logs[] = $col." = ".$value;
                }
    		}
        	// on limite la suppression des lignes a 1 une seule ligne
        	$sql .= " LIMIT 1";
        	//on execute la requete
        	$req = $this->pdo->query($sql);
        	//afin d’éviter d’avoir des problèmes à la requête suivante, on ferme la connection a base de donnees
            //if the we have to records logs
            if ($this->log_write == true)
            {
                //writing in log file
                LogWrite($action = "DELETION", $this->username, $table, $values_for_logs , $this->path_for_logs);
            }
        	//echo $sql."<br>";
            return $req;
        }
        catch (Exception $e)
        {
            $this->GetExceptionMessage($e);
        }
    }
    /*methode pour toutes autres requestes a l'instar des sous requestes, jointures, ou tout autres*/
   	public function Requete($requete)
    {
    	//on essaie la requete
    	try
    	{
    	    //echo $requete;
    		$req = $this->pdo->query($requete);
            return $req;
    	}
    	//si la requete est invalide on affiche lerreur suivie du message
    	catch (Exception $e)
        {
            $this->GetExceptionMessage($e);
        }
    }
    //methode pour verifier qun utilisateur existe dans la base de donnees
    public function Connexion($table = '', $columns = array(), $values = array(), $return=array(), $cookies = array(),$sessions=array())
    {
       
        $check=array();
        try
        {

            $sql = "SELECT * FROM ".$table." WHERE ";
            for ($i=0; $i < count($columns) ; $i++)
            {
                //on verifie que $value est une chaine, si oui on y ajoute des single quotes
                if (!is_numeric($values[$i]))
                {
                    $values[$i] = "'".$values[$i]."'";
                }
                $sql .= $columns[$i] .' = '.$values[$i];
                if ($i < count($columns) - 1)
                {
                    $sql .= " AND ";
                }
            }
            //On effectue la requete
           // echo $sql."<br>";
            $req = $this->pdo->query($sql);
            $ligne = $req->fetch();
            
            //Si il y a un résultat c'est que l'utilisateur est bien logged
            if($req->rowCount()==1)
            {
                foreach ($sessions as $key)
                {
                   setSession($key, $ligne[$key]);
                }
                
                foreach ($return as $key)
                {
                    array_push($check, $ligne[$key]);
                }
                //On retourne lid de lutilisateur pour dire que tout c'est bien passé

               if (count($cookies)>0) 
               {
                   $this->set_cookies($cookies);
               }
                
                //if the we have to records logs
                if ($this->log_write == true)
                {
                    //writing in log file
                    LogWrite($action = "Connexion", $this->username, $table, $values_for_logs= array("Connected Successfully") , $this->path_for_logs);
                }

            }
            //Sinon c'est que le mot de passe ou le nom d'utilisateur n'est pas bon
            else
            {
                $check = array();//Si c'est pas bon on renvoie false
                if ($this->log_write == true)
                {
                    //writing in log file
                    LogWrite($action = "Connexion", $this->username, $table, $values_for_logs= array("Connection Rejected") , $this->path_for_logs);
                }
            }

            return $check;

        }
        catch (Exception $e)
        {
            $this->GetExceptionMessage($e);
        }
    }

	/*
	 *  Fonction deconnexion, detruit les variables de sessions utilisé par la classe
	 */
    public function Deconnexion($varsessions = array())
    {
        //if the we have to records logs
        if ($this->log_write == true)
        {
            //writing in log file
            //$values_for_logs will be void
            LogWrite($action = "DECONNEXION", $this->username, $table = "users", $values_for_logs = array("---"), $this->path_for_logs);
        }
        foreach ($varsessions as $varsession)
        {
           unsetSession($varsession);
        }
    }
    // Methode de gestion et d'affichage des erreurs
    private function GetExceptionMessage($errors)
    {
        $err_message = $errors->getMessage();
        if ($this->showMessage == 1)
        {
            echo "<p style='color: red; font-weight: bold'>".$err_message."</p>";
        }

        //gets the trace=>all files and linked function detaails about exception
        $err_trace = $errors->getTrace();
        //checks wether $err_trace is an array and not empty
        if (is_array($err_trace) AND !empty($err_trace)) 
        {
            //adds the origin file where the errors occurs
           $err_message .= ' origins from : '.$err_trace[0]['file'];
           //adds the origin line of the file where the errors occurs
           $err_message .= ' on line : '.$err_trace[0]['line'];
           //adds the origin function causing the errors
           $err_message .= ' by function : `'.$err_trace[1]['function'].'`';
           //adds the line of the file where the function is called
           $err_message .= ' called at line : '.$err_trace[1]['line'];
           //adds the  of the file where the function is called
           $err_message .= ' in the file : '.$err_trace[1]['file'];
        }

        //adds the current date
        $err_message .= " at ".date('m/d/Y h:i:s');
        //recording database requests errors for improving
        $exeception_err_log = fopen($this->path_for_logs.DIRECTORY_SEPARATOR.'exeception_err_log.txt', 'a+');
        //breaklines
        $err_message = $err_message.PHP_EOL;
        //append the error at the end of the file
        fwrite($exeception_err_log, $err_message);
    }

    
    //fonction de recherche sur toutes les tables de la base de donnees
    public function Coalesce($tables, $like)
    {
        try
        {
            $table = explode(', ', $tables);
            //on initialise $fields a vide
            $fields = "CONCAT (";
            if (is_array($table))
            {
               foreach ($table as $table)
               {
                    //on fait une liste des champs de la table
                    $listFields = $this->Requete('DESCRIBE '.$table.'')->fetchAll();
                    //on initialise $i = 0
                    $i = 0;
                    $stop = 1;
                    foreach ($listFields as $specific_Fields)
                    {
                        if ($specific_Fields['Key']=='')
                        {
                            //on echape les champs ou la valeur est nulle
                            $fields .= " COALESCE(".$specific_Fields['Field']. ", '')";
                            //si on est pas a la fin de tu tableau, on ajoute une virgule
                            if ($i < count($listFields) - $stop)
                            {
                                $fields .= ", ";
                            }
                            $i++;
                        }
                        else
                        {
                            $stop ++;
                        }
                    }
                }
            }
            $sql = "SELECT * FROM ".$tables." WHERE ".$fields." ) LIKE '%".$like."%' ";
            /*echo $sql.'<br>';
            die();*/
            //on passe la concatenation dans notre function de sel
           return $this->Requete($sql);
        }
        catch (Exception $e)
        {
            $this->GetExceptionMessage($e);
        }

    }

    //methode pour liste les tables dune base de donnees
    public function ShowTables($db)
    {
        try
        {
            $sql = 'SHOW TABLES FROM '.$db;
            return $this->pdo->query($sql);
        }
        catch (Exception $e)
        {
            $this->GetExceptionMessage($e);
        }
    }

    //methode retournant la creation dune table
    public function ShowCreateTable($table)
    {
        try
        {
            $sql = 'SHOW CREATE TABLE '.$table;
            return $this->Requete($sql);
        }
        catch (Exception $e)
        {
            $this->GetExceptionMessage($e);
        }
    }

    
    //methode de sauvegarde de base de donnees
    public function DumpExport($path, $db, $mode)
    {
        //nom du champ pour lindex des requestes de show tables
        $fieldName = 'Tables_in_'.$db;
        //on annulle la verificaion des contraintes dintegrite
        $entete = "SET FOREIGN_KEY_CHECKS = 0;\n";
        //$entete => juste pour la deco
        $entete .= "-- ----------------------\n";
        $entete .= "-- dump de la base ".$db." du ".date("d-M-Y")."\n";
        $entete .= "-- ----------------------\n\n\n";
        //$creation represente les tables creees
        $creations = "";
        //$insetion represente les insertions dans les differentes tables
        $insertions = "\n\n";
        //$listeTables => la liste des tables sous forme dobjet
        $listeTables = $this->ShowTables($db);
        //on parcours $listeTables sous forme de tableau
        while($table = $listeTables->fetch())
        {
            // structure ou la totalité de la BDD
            if($mode == 1 || $mode == 2)
            {
                $creations .= "-- -----------------------------\n";
                $creations .= "-- Structure de la table ".$table[$fieldName]."\n";
                $creations .= "-- -----------------------------\n";
                //on fait la description totale des tables creees,
                $listeCreationsTables = $this->ShowCreateTable($db.'.'.$table[$fieldName]);
                //quon enregistre dans le tableau $creation
                if($creationTable = $listeCreationsTables->fetch())
                {
                    $creations .= "DROP TABLE IF EXISTS `".$table[$fieldName]."`;\n";
                    $creations .= $creationTable['Create Table'].";\n\n";
                }
            }
            // données ou la totalité
            //si le mode est 2 alors, on ajoute les differentes insertions
            if($mode == 2)
            {
                //on selsctionne tous les eleements de la table
                $donnees = $this->Select($db.'.'.$table[$fieldName]);
                //on fait un description de la table pour retenir ses entetes et les types
                $describe = $this->Describe($db.'.'.$table[$fieldName]);
                //header => entetes de la table courrante
                $headers = array();
                //headerType => type des entetes de la table courrante
                $headerType = array();
                //headerDefault => valeurs par defaut des champs de la table courrante
                $headerDefault = array();
                //headerNull => booleen verifiant si les des champs champs acceptent des valeurs nulles ou pas de la table courrante
                $headerNull = array();
                while ($header = $describe->fetch())
                {
                    $headers[] = $header['Field'];
                    $headerType[] = $header['Type'];
                    $headerNull[] = $header['Null'];
                    if ($header['Default'] == 'NON DEFINIT')
                    {
                        $headerDefault[] = '';
                    }
                    else
                    {
                        $headerDefault[] = $header['Default'];
                    }
                }
                /*var_dump($table[$fieldName]);
                var_dump($headers);
                var_dump($headerDefault);*/
                $insertions .= "-- -----------------------------\n";
                $insertions .= "-- Contenu de la table ".$table[$fieldName]."\n";
                $insertions .= "-- -----------------------------\n";
                //si $donnees est un objet alors on peut utiliser fetch sur lui
                if (is_object($donnees))
                {
                    while($nuplet = $donnees->fetch())
                    {
                        $insertions .= "INSERT INTO ".$table[$fieldName]." VALUES(";
                        for($i=0; $i < count($headers); $i++)
                        {
                            //si le type de lentete est varchar ou text ou blob, alors on y ajoute de quotes
                            if(substr_count($headerType[$i], 'varchar') > 0 || substr_count($headerType[$i], 'text') > 0 || substr_count($headerType[$i], 'blob') > 0 || substr_count($headerType[$i], 'date') > 0 || substr_count($headerType[$i], 'hour') > 0)
                            {
                                //si la valeur courrante est vide, ...
                                if (empty($nuplet[$headers[$i]]))
                                {
                                    //si le champ naccepte pas les valeurs nulles
                                    if ($headerNull[$i]=='NO')
                                    {
                                       //si la valeur par defaut est non nulle
                                        if ($headerDefault[$i] != NULL)
                                        {
                                            $insertions .=  '"'.$headerDefault[$i].'"';
                                        }
                                        //si non, ... on insert une chaine de caracteres vide
                                        else
                                        {
                                            $insertions .=  '""';
                                        }
                                    }
                                    //si non, ...
                                    else
                                    {
                                        //si la valeur par defaut est non nulle
                                        if ($headerDefault[$i] != NULL)
                                        {
                                            $insertions .=  '"'.$headerDefault[$i].'"';
                                        }
                                        //si non, ... on insert une chaine de caracteres vide
                                        else
                                        {
                                            $insertions .=  'NULL';
                                        }
                                    }
                                }
                                //si non, ...
                                else
                                {
                                    $insertions .=  '"'.$nuplet[$headers[$i]].'"';
                                }
                            }
                            //si non, cest un champ de type int ou decimal
                            else
                            {
                                //si la valeur courante est vide
                                if (empty($nuplet[$headers[$i]]))
                                {
                                    //si le champ naccepte pas les valeurs nulles
                                    if ($headerNull[$i]=='NO')
                                    {
                                       //si la valeur par defaut est non nulle
                                        if ($headerDefault[$i] != NULL)
                                        {
                                            $insertions .=  $headerDefault[$i];
                                        }
                                        //si non, ... on met 0
                                        else
                                        {
                                            $insertions .=  0;
                                        }
                                    }
                                    //si non, ...
                                    else
                                    {
                                        //si la valeur par defaut est non nulle
                                        if ($headerDefault[$i] != NULL)
                                        {
                                            $insertions .=  $headerDefault[$i];
                                        }
                                        //si non, ... on insert une chaine de caracteres vide
                                        else
                                        {
                                            $insertions .=  'NULL';
                                        }
                                    }
                                }
                                //si non, ...
                                else
                                {
                                    $insertions .=  $nuplet[$headers[$i]];
                                }
                            }
                            //si n est pas a la fin des cellules, on ajoute un point-virgule
                            if($i < count($headers) - 1)
                            {
                                $insertions .=  ", ";
                            }
                        }
                        $insertions .=  ");\n";
                    }
                }
                $insertions .= "\n";
            }
        }

        $fichierDump = fopen($path."/sauvegarde_".date("d-M-Y_h-i-s").".sql", "a+");
        fwrite($fichierDump, $entete);
        fwrite($fichierDump, $creations);
        fwrite($fichierDump, $insertions);
        fclose($fichierDump);
    }

    
    //fonction pour decrire une table
    public function Describe($table)
    {
        try
        {
            $sql = 'DESCRIBE '.$table;
            return $this->pdo->query($sql);
        }
        catch (Exception $e)
        {
            $this->GetExceptionMessage($e);
        }
    }

    /////////////////////////
    //methode de suppresion dun element en fonction de son id et de sa table
    public function DelById($db, $table, $pageName, $urlVars)
    {
        //liste des entetes
        $listOfheaders = $this->Describe($db.'.'.$table);
        //on sauvegarde la liste des champs/liste des pieces dans un tableau, puisque les boucles directement appliquees sur la variable, modifie sa stucture et son contenu
        while ($col = $listOfheaders->fetch())
        {
            $listColumns[] = ['Field'=>$col['Field'], 'Type'=>$col['Type'], 'Key'=>$col['Key']];
        }

        extract($_GET);
        //on recupere la cle primaire de la table
        $primaryKey = null;
        foreach ($listColumns as $col)
        {
            if ($col['Key']=='PRI')
            {
                $primaryKey = $col['Field'];
            }
        }
        //on supprime lelement en fonction de son id et de sa table
        $status = array($primaryKey=>$idcaract);
        $del = $this->Delete($db.'.'.$table, $status);
        //on retourne sur la page
        $page = $pageName.'.php?';
        $i = 0;
        foreach ($urlVars as $urlVar)
        {
           $page .= $urlVar['varName'].'='.$urlVar['data'];
           if ($i < count($urlVars) - 1)
           {
               $page .= '&';
           }
           $i++;
        }
        Redirect($page);
    }
    

    //methode pour importer une base de donnees
    public function DumpImport($db, $fileNameSQL, $mode)
    {
        try 
        {
           //debut de la requete
            $sql = '';
            //si le mode est egale a 1, on cree la database si elle nexiste pas
            if ($mode == 1)
            {
                $sql .= "CREATE DATABASE IF NOT EXISTS".$db.";";
            }
            //si le mode est egale a 2, on cree la database de meme si elle existe
            if ($mode == 2)
            {
                $sql .= "DROP DATABASE IF EXISTS ".$db.";\n";
                $sql .= "CREATE DATABASE IF NOT EXISTS ".$db.";\n";
            }
            //on choisit la base de donnees a utiliser
            $sql .= "USE ".$db.";\n";
            //on ouvre le fichier sql contenant la structure et les donnees
            $file = fopen($fileNameSQL, 'r');
            //on ajoute le contenu du fichier ouvert a la requete
            $sql .= fread($file, filesize($fileNameSQL));
            //on ferme le curseur du fichier ouvert
            fclose($file);
            //echo nl2br($sql);
            $this->Requete($sql);
        }
        catch (Exception $e)
        {
            $this->GetExceptionMessage($e);
        }
    }

    //methode pour retourner les differentes valeurs dun champs select en provenance
    public function OptionValues($table, $FieldName)
    {
        $PrimaryKey = $this->PrimaryKey($table);
        $columns = array($PrimaryKey, $FieldName);
        $status = array();
        $select = $this->Select($table, $columns, $status);
        //si le nbr de lignes de la requete est sup a 0, alors
        if ($select->rowCount()>0)
        {
           //cree une variable qui contiendra la liste des options
            //ouverture des balises select
            $selectTag = '<select name="'.$PrimaryKey.'">';
            while ($optionTag = $select->fetch())
            {
                //la value de loption courrant sera lid du cham passe en parametre
               $selectTag .= '<option value="'.$optionTag[$PrimaryKey].'">'.$optionTag[$FieldName].'</option>';
            }
            //feermeture des balises select
            $selectTag .= '<select>';
            return $selectTag;
        }
        //si non, on return 0
        else
        {
            return 0;
        }
    }

    //methode pour retourner les differentes valeurs dun champs select en provenance (pour ecuperer les optgroup provenant dune table mere)
    /*public function OptionValuesOptgroup($table_parent, $table, $FieldName)
    {
       /* $PrimaryKey = $this->PrimaryKey($table);
        $columns = array($PrimaryKey, $FieldName);
        $status = array();
        $select = $this->Select($table, $columns, $status);
        $selectE = $this->Requete('SELECT * FROM classe c WHERE f.ID_FILIERE = c.ID_FILIERE order BY f.NOM_FILIERE');
var_dump($selectE->fetchAll());
        //si le nbr de lignes de la requete est sup a 0, alors
        if ($select->rowCount()>0)
        {
           //cree une variable qui contiendra la liste des options
            //ouverture des balises select
            $selectTag = '<select name="'.$PrimaryKey.'">';
            while ($optionTag = $select->fetch())
            {
                //la value de loption courrant sera lid du cham passe en parametre
               $selectTag .= '<option value="'.$optionTag[$PrimaryKey].'">'.$optionTag[$FieldName].'</option>';
            }
            //fermeture des balises select
            $selectTag .= '<select>';
            return $selectTag;
        }
        //si non, on return 0
        else
        {
            return 0;
        }
    }*/

    //fonction pour retourner la cle primaire dune table
    public function PrimaryKey($table)
    {
        try
        {
            //variable contenant la cle primaire de la table
            $primarykey = '';
            $listOfheaders = $this->Describe($table);
            //on parcours la boucle jusqua trouver la cle primaire
            while ($header = $listOfheaders->fetch())
            {
                //on choisie la cle primaire
                if ($header['Key']=='PRI')
                {
                    $primarykey = $header['Field'];
                    //on arrete la boucle
                    break;
                }
            }
            //on retourne la cle primaire
            //si la cle primaire trouvee est vide, alors on retourne 0
            if ($primarykey == '')
            {
               return false;
            }
            //si non on retourne la cle primaire trouvee
            else
            {
                return $primarykey;
            }
        }
        catch (Exception $e)
        {
            $this->GetExceptionMessage($e);
        }
    }


}


