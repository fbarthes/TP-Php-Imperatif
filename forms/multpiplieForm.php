<?php

function constructFormMultiplie($method)
{
    return "<form class='form' method='POST' action='".generateUrl($_GET['controller'],$method)."'>
        <div class='row d-flex'>
        <input class='form-control col mx-3' type='text' placeholder='axe X' name='axex'>
        <input class='form-control col mx-3' type='text' placeholder='axe Y' name='axey'>
        <input class='btn btn-primary col mx-3' type='submit' name='submit' value='générer la table'>
        </div>
    </form>";
}

function validateFormMultiplie()
{
    if (isset($_POST['axex']) && $_POST['axex']!==''
        && isset($_POST['axey']) && $_POST['axey']!==''
        && is_numeric($_POST['axex']) && is_numeric((int)$_POST['axey'])
        && !str_contains($_POST['axex'],'.') && !str_contains($_POST['axey'],'.')) {
            return true;
        }
        return false;
}