<?php
include_once(__DIR__.'/../forms/avatarForm.php');

function loadAvatar() {
    $form = constructAvatarForm();

    if (isset($_POST['submit'])) {
        echo '<pre>';
        var_dump($_FILES);
        echo '</pre>';
        $ext = explode('.',$_FILES['avatar']['name']);
        $ext = $ext[count($ext)-1];
        $name = 'upload/test.'.$ext;
        if (move_uploaded_file($_FILES['avatar']['tmp_name'],$name)) {
            echo 'téléchargé avec succès';
        } else {
            echo 'oups une erreur est survenue';
        }
    }

    createView([
        'title' => 'Télécharger votre avatar',
        'form' => $form,
    ],'/avatar/form.php');

}