<?php
// effectue des vérifications basiques pour un champs de $_POST (type, requit, max)
function verifier_entree($var, $type, $requis = false, $max = null) {
    // on regarde si la clé existe bien dans $_POST, et si la valeur string n'est pas vide
    if (
        $requis &&
        !array_key_exists($var, $_POST) &&
        strval($_POST[$var]) != '')
    {
        return false;
    }

    $types_filtres = [
        'int' => FILTER_VALIDATE_INT,
        'float' => FILTER_VALIDATE_FLOAT,
        'bool' => FILTER_VALIDATE_BOOLEAN,
        'string' => FILTER_DEFAULT
    ];
    // on effectue une vérification du type de variable avec la fonction filter_var
    // on s'assure bien que l'index existe pour éviter une erreur
    if (
        array_key_exists($var, $_POST) &&
        filter_var($_POST[$var], $types_filtres[$type]) === false
    ) {
        return false;
    }

    // on regarde la longueur en fonction du type:
    // - string: strlen (nombre de caractères)
    // - int/float: < > (valeur)
    if (array_key_exists($var, $_POST) && $max != null) {
        if (is_string($_POST[$var]) && strlen($_POST[$var]) > $max) {
            return false;
        } else if (is_numeric($_POST[$var]) && ($type == 'int' || $type == 'float') && $_POST[$var] > $max) {
            return false;
        }
    }

    return true;
}
