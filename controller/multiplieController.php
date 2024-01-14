<?php
include_once(__DIR__.'/../include/math.php');
include_once(__DIR__.'/../forms/multpiplieForm.php');


function displayMultiplie()
{
    $x = 10;
    $y = 10;
    $form = constructFormMultiplie(__METHOD__);

    if (isset($_POST['submit']) && validateFormMultiplie()) {
        $x = $_POST['axex'];
        $y = $_POST['axey'];
    }
    $vars = [
        'title' => 'Table de multiplication',
        'table' => constructTableMultiplie($x,$y),
        'form' => $form,
    ];
    createView($vars, '/table/show.php');
}