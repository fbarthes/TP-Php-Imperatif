<?php
/**
 * coeur du microframework 
 * - gère la query string pour appeler contrôleur et fonction
 * - gère la lecture et ériture du fichier JSON
 * - gère la sécurité
 */

/**
 * Appelle le bon contrôleur et la bonne méthode de ce contrôleur passés dans la query string
 */
function routeur() {
    session_start();
    getController();
    getMethod();
}

/**
 * Appelle la méthode passé en paramètre de la query string dans la clé 'method'
 */
function getMethod()
{
    if (isset($_GET['method'])) {
        $method = $_GET['method'];
        if (function_exists($method)) {
            $method();
        } else {
            redirect('index','index');
        }    
    } else {
        redirect('index','index');
    }
}

/**
 * Inclus un fichier de type controller en fonction du paramètre controller de la query string
 * 
 */
function getController()
{
    if (isset($_GET['controller'])) {
        if (file_exists(__DIR__.'/../controller/'.$_GET['controller'].'Controller.php')) {
            include_once(__DIR__.'/../controller/'.$_GET['controller'].'Controller.php');
        } else {
            redirect('index','index');
        }
    } else {
        redirect('index','index');;
    }
}

/**
 * Ecrit un fichier JSON à partir d'un tableau associatif ou indexé
 * Force l'écriture en objet JSON si c'est un tableau indexé. voir doc PHP.NET json_encode
 * @param string le nom du fichier json à écrire
 * @param array les données à écrire dans le fichier
 */
function ecrireFile($name, $datas) {
    file_put_contents($name, json_encode($datas,JSON_FORCE_OBJECT));
}

/**
 * Lit un fichier JSON et retourne le tableau associatif correspondant
 * @param string le nom complet(dossier inclus) du fichier JSON à lire
 * @return array le tableau associatif correspondant au fichier JSON lu
 */
function lireFile($name) {
    if (!file_exists($name)) {
        return [];
    }
    $content = file_get_contents($name);
    if ($content === "") {
        return [];
    }
    return json_decode($content, true);
}

/**
 * Génère une vue ou autrement dit un HTML
 * @param array un tableau associatif où chaque clé deviendra le nom d"une variable
 * @param string|null le nom du fichier (dossier inclus) de la vue à charger (dans le dossier view) 
 */
function createView($tabVar, $view=null)
{
    extract($tabVar);
    include_once(__DIR__.'/../view/index.php');
}

/**
 * génère une URL avec trois paramètres qui entreront dans la query string
 * @param $controller string le nom du controller à charger 
 * @param $method     string le nom de la méthode du contoller à appeler
 * @param $query      array|null un tableau associatif avec pour clé, le nom du paramètre dans la query string
 * @return string l'url avec la query string
 */
function generateUrl($controller,$method,$query=null)
{
    $url = 'index.php?controller='.$controller.'&method='.$method;
    if (is_array($query) && count($query)>0) {
        foreach($query as $key=>$value) {
            $url = $url.'&'.$key.'='.$value;
        }
    }
    return $url;
}


function redirect($controllerName,$method)
{
    header('location: '.generateUrl($controllerName,$method));
}

function is_connected()
{
    if (isset($_SESSION['connected'])) {
        return true;
    }
    return false;

}