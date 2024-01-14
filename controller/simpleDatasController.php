<?php
include_once(__DIR__.'/../model/simpledatas.php');
include_once(__DIR__.'/../forms/simpleDatasForm.php');

function displayAll()
{
    $vars = [
        'title' => 'Liste des enregistrements',
        'datas' => getAll(),
    ];
    createView($vars, '/simpledatas/list.php');
}

function displayOne()
{
    if (!isset($_GET['cle'])) {
        redirect('simpleDatas','displayAll');
    }

    createView([
        'title' => 'Voir un enregistrement',
        'data' => getOne($_GET['cle']),
    ],'/simpledatas/show.php');
}

function createData()
{
    if (!is_connected()) {
        redirect('simpleDatas','displayAll');
    }
    $datas = getAll();
    $cle = getMaxIndiceTab($datas);
    $datas[] = '';
    $form = displayForm($datas,$cle, __METHOD__);
    
    if (isset($_POST['submit']) && validateForm()) {
        $datas[$cle] = $_POST['valeur'];
        create($datas);
        displayAll();
    }

    createView([
        'title' => 'Création enregistrement',
        'form' => $form,
    ], '/simpledatas/create.php');
}

function updateData()
{
    if (!is_connected()) {
        redirect('simpleDatas','displayAll');
    }

    if (!isset($_GET['cle'])) {
        displayAll();
        return;
    }
    $cle = $_GET['cle'];
    $datas = getAll();
    $form = displayForm($datas,$cle, __METHOD__);

    if (isset($_POST['submit']) && validateForm()) {
        $datas[$cle] = $_POST['valeur'];
        create($datas);
        displayAll();
    }

    createView([
        'title' => 'Modification',
        'form' => $form,
    ], '/simpledatas/create.php');
}


