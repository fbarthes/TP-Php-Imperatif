<?php
include_once(__DIR__ . '/../forms/avatarForm.php');

function loadAvatar()
{
    $form = constructAvatarForm();
    $error ='';

    if (($error = processAvatarForm()) === true) {
        redirect('index','index');
    }
   

    createView([
        'title' => 'Télécharger votre avatar',
        'form' => $form,
        'error' => $error,
    ], '/avatar/form.php');
}
