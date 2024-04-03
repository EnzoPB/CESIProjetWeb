<?php

class ServiceBase {
    protected static $table;
    protected static $colonneId;
    protected static $classe;
    protected static $requeteGet;

    // récupérer les éléments en fonction d'une clé et de sa valeur
    public static function getBy($cle, $valeur) {
        global $bdd;

        // si la requête get a été remplacé par un enfant de ServiceBase
        // alors on utilise cette requète,
        // sinon on utilise celle par défaut
        $requeteGet = 'SELECT * FROM {table} WHERE {cle} = ?';
        if (static::$requeteGet != null) {
            $requeteGet = static::$requeteGet;
        }
        
        // on remplace {table} et {cle} par le nom de la table et la clé
        $requeteGet = str_replace('{table}', static::$table, $requeteGet);
        $requeteGet = str_replace('{cle}', $cle, $requeteGet);

        $res = $bdd->req($requeteGet, [
            $valeur
        ]);

        if (empty($res)) {
            return null;
        }

        $retour = [];
        foreach ($res as $element) {
            $retour[] = new static::$classe($element);
        }
        return $retour;
    }

    // racourcis pour avoir un seul élément
    public static function getOneBy($cle, $valeur) {
        $res = static::getBy($cle, $valeur);
        if ($res == null) {
            return null;
        } else {
            return $res[0];
        }
    }

    // racourcis pour avoir un seul élément par son id
    public static function getById($id) {
        return static::getOneBy(static::$colonneId, $id);
    }
}