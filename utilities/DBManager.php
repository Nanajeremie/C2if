<?php 

require 'QueryBuilder.php';
/**
 * 
 */
class DBManager extends QueryBuilder
{
	
	public function CreateTable($db, $table, $colunms, $p_engin='InnoDB', $p_charset_defaut='utf8mb4')
    {
        try
        {
            $primarykey_compte=0;
            $primarykey_name='';

            if (!is_array($colunms) || count($colunms)<1)
            {
                $this->GetExceptionMessage("Impossible de créer la table SQL car il manque des éléments dans les paramètres de la fonction "."$"."MysqlBddCreateTable.");
            }
            else
            {
                // début de la creation de la table SQL
                $creation = "CREATE TABLE IF NOT EXISTS `".$db."`.`".$table."` (";
                $apercu   = "CREATE TABLE IF NOT EXISTS `".$table."` (<br />";
                // on ouvre une boucle for pour récupérer toutes les données en paramètres
                for ($i = 0; $i < count($colunms); $i++)
                {
                    $col = $colunms[$i];

                    // on vérifie que les paramètres NOM, TYPE et TAILLE soivent bien déclarés
                    if (!isset($col['NOM']) || !isset($col['TYPE']) || !isset($col['TAILLE']))
                    {
                        $this->GetExceptionMessage("Impossible de créer la table SQL car il manque au moins un paramètre \"NOM\", \"TYPE\" ou \"TAILLE\" dans la fonction "."$"."MysqlBddCreateTable.");
                    }
                    else if (empty($col['NOM']) || empty($col['TYPE']))
                    {
                        $this->GetExceptionMessage("Impossible de créer la table SQL car au moins un paramètre \"NOM\", ou \"TYPE\" est vide dans la fonction "."$"."MysqlBddCreateTable.");
                    }

                    // on récupère toutes les données et on les protèges contre l'injection SQL
                    $nom    = Protect(strtoupper($col['NOM']));
                    $type   = Protect(strtoupper($col['TYPE']));
                    $taille = '('.Protect($col['TAILLE']).')';
                    // on récupère aussi les paramètres qui ne sont pas obligatoires
                    (isset($col['VALEUR_DEFAUT']) && !empty($col['VALEUR_DEFAUT']))? $defaut = " DEFAULT '".Protect($col['VALEUR_DEFAUT'])."'" : $defaut = '';
                    (isset($col['NULL']) && !empty($col['NULL']))? $nule = ' NOT NULL' : $nule = '';
                    (isset($col['AUTO_INCREMENT']) && !empty($col['AUTO_INCREMENT']))? $autoincrement = ' AUTO_INCREMENT' : $autoincrement = '';
                    (isset($col['INDEX']) && !empty($col['INDEX']))? $primarykey = ' '.Protect($col['INDEX']) : $primarykey = '';
                    (isset($col['COMMENTAIRES']) && !empty($col['COMMENTAIRES']))? $commentaires = ' COMMENT '." '".Protect($col['COMMENTAIRES'])."'" : $commentaires = '';
                    (isset($col['CHARACTER_SET']) && !empty($col['CHARACTER_SET']))? $character_set = ' '.Protect($col['CHARACTER_SET']) : $character_set = '';

                    // si la colonne doit-être 'auto increment', il faut supprimer la valeur par défaut car risque d'erreur et NULL doit être NOT NULL
                    if (!empty($autoincrement)) $defaut='';
                    if (!empty($autoincrement)) $nule = ' NOT NULL';

                    // on effectue quelques vérification dans les paramètres
                    if ($type == 'TEXT' || $type=='FLOAT' || $type=='DOUBLE' || $type=='DATE' || $type=='DATETIME' || $type=='TIMESTAMP' || $type=='TIME' || $type=='TINYTEXT' || $type=='MEDIUMTEXT' || $type=='LONGTEXT')
                    {
                        // tout ce qui est de type TEXT, DATE, DATETIME etc... n'ont pas de taille minimum ou maximum, donc on vide $taille
                        $taille = '';
                    }
                    else if ($type=='INT' || $type=='TINYINT' || $type=='SMALLINT' || $type=='MEDIUMINT' || $type=='BIGINT')
                    {
                        // si auto increment est actif, il faut vider la valeur par défaut, sinon il y aurra une erreur
                        if (!empty($autoincrement) && !empty($defaut)) { $defaut = ''; }
                        // taille par défaut des paramètres TYPE (numérique) si le paramètre TAILLE est vide
                        if (empty($taille))
                            {
                                if ($type=='INT')
                                {
                                    $taille='(11)';
                                }
                                else if ($type=='TINYINT')
                                {
                                        $taille='(4)';
                                }
                                else if ($type=='SMALLINT')
                                {
                                    $taille='(6)';
                                }
                                else if ($type=='MEDIUMINT')
                                {
                                 $taille='(9)';
                                }
                                else if ($type=='BIGINT')
                                {
                                    $taille='(20)';
                                }
                            }
                    }
                    else if (empty($taille) && ($type=='VARCHAR' || $type=='CHAR'))
                    {
                        // si la taille VARCHAR et CHAR est vide
                        $taille = '(255)';
                    }
                    else if ($type=='YEAR')
                    {
                        // gestion du type YEAR, la taille doit être de 2 ou 4 obligatoirement
                        if ($taille=='2') $taille = '(2)'; else $taille = '(4)';
                    }
                    else if ($type=='VARCHAR' && $taille > '255')
                    {
                        // si le paramètre TAILLE est supérieur à 255, on arrête le script pour en informer l'utilisateur
                        $this->GetExceptionMessage("Impossible de créer la table SQL car la TAILLE du paramètre VARCHAR ne peut pas dépasser 255. Erreur dans la fonction "."$"."MysqlBddCreateTable.");
                    }
                    else if (!empty($primarykey) && $primarykey!='PRIMARY' && $primarykey!='FULLTEXT' && $primarykey!='INDEX' && $primarykey!='UNIQUE')
                    {
                        // si le paramètre INDEX ne contient pas le bon paramètre on arrête le script pour en informer l'utilisateur
                        $this->GetExceptionMessage("Impossible de créer la table SQL car le paramètre INDEX n'est pas valide. Les paramètres valides sont: PRIMARY, UNIQUE, INDEX ou FULLTEXT. Erreur dans la fonction "."$"."MysqlBddCreateTable.");
                    }

                    // on stocke notre ligne dans la variable $creation
                    $virgule='';
                    if($i<(count($colunms)-1) ) { $virgule.=','; }
                    $creation .= "`".$nom."` ".$type.$taille.$character_set.$nule.$autoincrement.$defaut.$commentaires.$virgule;
                    $apercu   .= "&nbsp;&nbsp;&nbsp;&nbsp;`".$nom."` ".$type.$taille.$character_set.$nule.$autoincrement.$defaut.$commentaires.$virgule."<br />";
                    if (!empty($primarykey) && $primarykey_compte==0)
                    {
                        if($primarykey=='INDEX'){ $primarykey=''; }
                        $primarykey_compte=1;
                        $primarykey_name=', '.$primarykey.' KEY (`'.$nom.'`)';
                    }
                }

                if (!empty($primarykey_name))
                {
                    $creation .= $primarykey_name;
                    $apercu   .= '&nbsp;&nbsp;&nbsp;&nbsp;'.$primarykey_name.'<br />';
                }
                $creation .= ") ENGINE=".$p_engin." DEFAULT CHARSET=".$p_charset_defaut;
                $apercu   .= ") ENGINE=".$p_engin." DEFAULT CHARSET=".$p_charset_defaut."<br />";

                // création de la table dans la base de données
                $requete=$this->pdo->query($creation);
                //echo $apercu;
                if (!$requete)
                {
                    // s'il y a eu une erreur on arrête le script
                    $this->GetExceptionMessage("Requête CREATE TABLE invalide : ".mysql_error());
                }

            }

        }
        catch (Exception $e)
        {
            $this->GetExceptionMessage($e->getMessage());
        }
        return true;
    }

    //methode pour ajouter une contrainte dintegrite sur une cle etrangere dune table
    public function AddIntegrityConstraint($Foreign_Key, $key, $OriginTable, $ChildTable)
    {
        try
        {
            $sql = 'ALTER TABLE '.$ChildTable.' ADD INDEX ('.$Foreign_Key.'); ';
            $sql .= 'ALTER TABLE '.$ChildTable.' ADD ';
            $sql .= ' FOREIGN KEY('.$Foreign_Key.') REFERENCES '.$OriginTable.' ('.$key.')';
            //par defaut, les modifications et les suppressions des donnees de la table mere
            $sql .= ' ON DELETE CASCADE ON UPDATE CASCADE';
            //on execute la requete
            $req = $this->pdo->query($sql);
            //echo $sql;
        }
        catch (Exception $e)
        {
            $this->GetExceptionMessage($e->getMessage());
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
            $this->GetExceptionMessage($e->getMessage());
        }
    }

    //methode pour modifier une colonne
    public function AlterColumn($db, $oldName, $newName, $type_size)
    {
        try
        {
            $newName = strtoupper($newName);
            $sql = "ALTER TABLE ".$db." CHANGE ".$oldName." ".$newName." ".$type_size."";
            var_dump($type_size);
            //echo $sql;
            $this->pdo->query($sql);
            return true;
        }
        catch (Exception $e)
        {
            $this->GetExceptionMessage($e->getMessage());
        }
    }

    //methode pour supprimer une colonne
    public function DropColumn($db, $column)
    {
        try
        {
            $sql =  "ALTER TABLE ".$db." DROP ".$column."";
            $this->pdo->query($sql);
            return true;
        }
        catch (Exception $e)
        {
            $this->GetExceptionMessage($e->getMessage());
        }
    }
    //methode pour supprimer une base de donnees
    public function DropTable($table)
    {
        try
        {
            $sql = "DROP TABLE ".$table."";
            $this->pdo->query($sql);
            return true;
        }
        catch (Exception $e)
        {
            $this->GetExceptionMessage($e->getMessage());
        }
    }
    //methode pour ajouter une colonne
    public function AddColumn($table, $colunm, $type, $size, $after_colx)
    {
        try
        {
            $colunm = strtoupper($colunm);
            if ($after_colx != "")
            {
               if (is_numeric($size) AND $type == 'DECIMAL')
               {
                  $sql = "ALTER TABLE ".$table." ADD ".$colunm." ".$type."(".$size.") NOT  NULL AFTER ".$after_colx."";
               }
               elseif(is_numeric($size) AND $type == 'VARCHAR')
               {
                  $sql = "ALTER TABLE ".$table." ADD ".$colunm." ".$type."(".$size.")  NULL AFTER ".$after_colx."";
               }
               else
               {
                  $sql = "ALTER TABLE ".$table." ADD ".$colunm." ".$type."  NULL AFTER ".$after_colx."";
               }
            }
            else
            {
                if (is_numeric($size) AND $type == 'DECIMAL')
               {
                  $sql = "ALTER TABLE ".$table." ADD ".$colunm." ".$type."(".$size.") NOT  NULL";
               }
               elseif(is_numeric($size) AND $type == 'VARCHAR')
               {
                  $sql = "ALTER TABLE ".$table." ADD ".$colunm." ".$type."(".$size.")  NULL ";
               }
               else
               {
                  $sql = "ALTER TABLE ".$table." ADD ".$colunm." ".$type."  NULL ";
               }
            }
            echo $sql;
            $this->pdo->query($sql);
            return true;
        }
        catch (Exception $e)
        {
            $this->GetExceptionMessage($e->getMessage());
        }
    }

    //methode pour changer lordre des tables avec la commande sql After
    public function ChangeColOrderAfter($db, $column, $type_size, $after_colx)
    {
        try
        {
            $sql  = "ALTER TABLE ".$db." MODIFY COLUMN ".$column." ".$type_size." AFTER ".$after_colx.";";
            echo $sql.'<br>';
            $this->pdo->query($sql);
            return true;
        }
        catch (Exception $e)
        {
            $this->GetExceptionMessage($e->getMessage());
        }
    }

    //methode pour changer lordre des tables avec la clause First
    public function ChangeColOrderFirst($db, $column, $type_size)
    {
        try
        {
            $sql  = "ALTER TABLE ".$db." MODIFY COLUMN ".$column." ".$type_size." FIRST;";
            echo $sql.'<br>';
            $this->pdo->query($sql);
            return true;
        }
        catch (Exception $e)
        {
            $this->GetExceptionMessage($e->getMessage());
        }
    }

    

    //fonction pour creer des inputs specifiques a la table passee en parametre
    public function createInput($db, $table)
    {
        //on fait une descripion de la table pour avoir la liste de de ses colonnes
        $inputs = $this->Describe($db.'.'.$table);
        //on fait la description de la table des pieces pour recuperer les diffentes designations dans un select
        $id_pieces = $this->Select($db.'.pieces');
        //on fait la liste des diffents codes mecaniques des equipements
        $table_mere = $db.'.equipements';
        $FieldName = 'CODE_MECA';
        $selectTag = $this->OptionValues($table_mere, $FieldName);
         //boucle pour afficher les differents inputs
        $newElement = '';
        $id = 0;
        while ($input = $inputs->fetch())
        {
            //on affiche seulement ceux dont le type est different est 'id' et dont la key est '' (on evite les cles primaires et secondaires)
            if (stristr('id', $input['Type'])==false AND $input['Key']!='PRI')
            {
                //ouverture des balises td
                $newElement .= '<td>';
                //si le champ courant est egal a celui de la cle primaire de la table des pieces, alors le type du champs sera un select
                if ($input['Field'] == 'ID_EQUIP')
                {
                    $newElement .= $selectTag;
                }
                //si le type est varchar(255), ...
                elseif ($input['Type'] == 'varchar(255)')
                {
                    //alors le type du champ creee sera text
                    $newElement .= '<input type="text" placeholder="'.$input['Field'].'" name="'.$input['Field'].'[]"/>';
                }
                //si le champ est de type varchar(90)
                //si dans le nom du champ il ya photo, alors, on cree un champ de type file
                elseif ($input['Type'] == 'varchar(90)')
                {
                    $newElement .= '<input type="file" accept="image/*" name="'.$input['Field'].'" >';
                }
                //si le type est decimal(10,0), on cree un champ de type number
                elseif (($input['Type'] == 'decimal(10,2)' || $input['Type'] == 'int(11)'))
                {
                    $newElement .= '<input type="text" placeholder="'.$input['Field'].'" name="'.$input['Field'].'[]" oninput="EnableDecimal(this)" id="'.$id.'" required class="test"/>';
                    $id++;
                }
                //si le type est 'text', on cree un champ de type textarea
                elseif ($input['Type'] == 'text')
                {
                    $newElement .= '<textarea placeholder="'.$input['Field'].'" name="'.$input['Field'].'[]"></textarea>';
                }
                elseif ($input['Type'] = 'datetime')
                {
                    $newElement .= '<input type="date" placeholder="'.$input['Field'].'" name="'.$input['Field'].'[]" required />';
                }

                $newElement .= '</td>' ;
            }

        }
        //retour des inputs sous forme de texte pour etre traite en js
        return $newElement;
    }

    public function Coalesce2($db, $like)
    {
        try
        {
            //creation du tableau pour contenir la liste des different resultats sous forme dobjet
            $req = array();
            //selection de la liste des tables
            $listeTables = $this->ShowTables($db);
            //nom de lindex/champ pour recuperer la liste des tables, quon concatene avec le nom de la base de donnees
            $fieldName = 'Tables_in_'.$db;
            //on fait une boucle pour ne selectionner que les tables qui ne sont pas vides
            while ($table = $listeTables->fetch())
            {
                $r = 'select * from '.$db.'.'.$table[$fieldName];
                $r = $this->Requete($r);
                //si le nombre de lignes que contient la table est superieure a 0,
                if ($r->rowCount()>0)
                {
                    //on lajoute dans le tableau $tables
                    $tables[]= $db.'.'.$table[$fieldName];
                }
            }

            if (is_array($tables))
            {
               foreach ($tables as $table)
               {
                    //on fait une liste des champs de la table
                    $listFields = $this->Requete('DESCRIBE '.$table.'')->fetchAll();
                    //on initialise $i = 0
                    $i = 0;
                    $stop = 1;
                    //on initialise $fields a la clause CONCAT
                    $fields = "CONCAT (";
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
                        $sql = "SELECT * FROM ".$table." WHERE ".$fields." ) LIKE '%".$like."%' ;";
                    }
                    //execution de la requete
                    $req[] = $this->Requete($sql);
                    echo $sql.'<br><br>';
                }
            }
            //on passe la concatenation dans notre function Requete, puis on la retourne
            return $req;
        }
        catch (Exception $e)
        {
            $this->GetExceptionMessage($e->getMessage());
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
            $this->GetExceptionMessage($e->getMessage());
        }
    }

//function pour lister les colonnes des tables avec le script pour masquer les colonnes
    public function ListCols($db, $table)
    {
        $cols = $this->Describe($db.'.'.$table);
        $i = 0;
        $headersCheckBox = '';
        while ($col = $cols->fetch())
        {
            if (stristr('id', $col['Type'])==false AND $col['Key']!='PRI')
            {
                $listOfheaders = '<label>'.$col['Field'].'</label><input type="checkbox" name="" onclick="hide(\'<?= $i?>\')"><br>';
            }
        $i++;
        }
        return $headersCheckBox;
    }

    //methode pour selection des elements / remplace la table piece
    public function SelectGroup($db, $id)
    {
        //on selectionne la cle primaire de la table des equipements
        $EquipmentsPrimaryKey = $this->PrimaryKey($db.'.equipements');
        //nom du champ pour la recuperation des tables
        $fieldName = 'Tables_in_'.$db;
        //on fait la liste des tables sous forme dobjet
        $listeOfTables = $this->ShowTables($db);
        //liste des tables qui ne sont pas vides
        $notEmptyTables = array();
        //on selectionne les tables qui ne sont pas vides
        while ($table = $listeOfTables->fetch())
        {
            $TableName = $db.'.'.$table[$fieldName];
            $TableContent = $this->Select($TableName);
            if (is_object($TableContent))
            {
                //on choisit les tables qui ont la cle etrangere de equipements
                $describe = $this->Describe($db.'.'.$table[$fieldName]);
                foreach ($describe as $TableDescribed)
                {
                    if ($TableDescribed['Field']==$EquipmentsPrimaryKey)
                    {
                        //puis celles qui ont la cle etrangere passee en parametre
                        $checkPrimaryKeyIsset = $this->Select($db.'.'.$table[$fieldName], array(), array($EquipmentsPrimaryKey=>$id));
                        if (is_object($checkPrimaryKeyIsset))
                        {
                           $notEmptyTables[]=$table[$fieldName];
                        }
                    }
                }
            }
        }
        //liste des tables sous forme de tableau
        $tables = array();
        //on commence la requete
        $sql = 'SELECT * FROM '.$db.'.'.'equipements, ';
        //on parcours la des tables non vides
        for ($i=0; $i < count($notEmptyTables) ; $i++)
        {
            //on concatene uniquement toutes tables qui ne sont pas 'equipemnt'
            if ($notEmptyTables[$i]!='equipements')
            {
                $sql .= $db.'.'.$notEmptyTables[$i];
                $tables[] = $notEmptyTables[$i];
                if ($i < count($notEmptyTables) - 2)
                {
                    $sql .= ', ';
                }
            }
        }
        $sql .= ' WHERE equipements.'.$EquipmentsPrimaryKey.'='.$id.' AND ';
        //on ajoute les alias et on fait les jointures
        for ($i=0; $i < count($tables) ; $i++)
        {
            $sql .= $tables[$i].'.'.$EquipmentsPrimaryKey.' = equipements.'.$EquipmentsPrimaryKey;
            if ($i < count($tables) - 1)
            {
                $sql .= ' AND ';
            }
        }
        //on ajoute le group by
        //$sql .= ' GROUP BY equipements.'.$EquipmentsPrimaryKey;

        //on execute la requete
        //echo $sql;
        return $this->Requete($sql);

    }

/////////////////////////

    //fonction pour creer des inputs pour la table equipement
    public function createInputEquipements($db, $table)
    {
        //on fait une descripion de la table pour avoir la liste de de ses colonnes
        $inputs = $this->Describe($db.'.'.$table);
        //boucle pour afficher les differents inputs
        $newElement = '';
        while ($input = $inputs->fetch())
        {
            //on affiche seulement ceux dont le type est different est 'id' et dont la key est '' (on evite les cles primaires et secondaires)
            if (stristr('id', $input['Type'])==false AND $input['Key']!='PRI')
            {
                //ouverture des balises td
                $newElement .= '<td>';
                //si le type est varchar(255), ...
                if ($input['Type'] == 'varchar(255)')
                {
                    //si dans le nom du champ il ya photo, alors, on cree un champ de type file
                    if ($input['Type'] == 'varchar(90)')
                    {
                        $newElement .= '<input type="file" accept="image/*" name="'.$input['Field'].'[]">';
                    }
                    //alors le type du champ creee sera text
                    else
                    {
                        $newElement .= '<input type="text" placeholder="'.$input['Field'].'" name="'.$input['Field'].'[]"/>';
                    }
                }//si le type est decimal(10,0), on cree un champ de type number
                elseif ($input['Type'] == 'decimal(10,0)' || $input['Type'] == 'int(11)')
                {
                    $newElement .= '<input type="number" placeholder="'.$input['Field'].'" name="'.$input['Field'].'[]" required/>';
                }
                //si le type est 'text', on cree un champ de type textarea
                elseif ($input['Type'] == 'text')
                {
                    $newElement .= '<textarea placeholder="'.$input['Field'].'" name="'.$input['Field'].'[]"></textarea>';
                }
                elseif ($input['Type'] = 'datetime')
                {
                    $newElement .= '<input type="date" placeholder="'.$input['Field'].'" name="'.$input['Field'].'[]" required />';
                }

                $newElement .= '</td>' ;
            }

        }
        //retour des inputs sous forme de texte pour etre traite en js
        return $newElement;
    }
}
 ?>