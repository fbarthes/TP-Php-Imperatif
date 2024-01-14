<?php

function displayForm(&$tab, $cle, $method) {
    if (array_key_exists($cle, $tab)) {
        return "<form action='".generateUrl($_GET['controller'],$method,['cle'=>$cle])."' method='POST'>
            <input type='text' class='form-control mb-3' name='valeur' value='".$tab[$cle]."'>
            <input type='submit' name='submit' class='btn btn-primary' value='mettre à jour'>
        </form>";
    }
}

function validateForm() {
    if (isset($_POST['valeur']) && $_POST['valeur'] !== '') {
        if(isset($_SESSION['error'])) {
            unset($_SESSION['error']);
        } 
        return true;
    }
    $_SESSION['error'] = 'la valeur ne peut être vide';
    return false;
}