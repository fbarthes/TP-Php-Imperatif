<?php

// Check if the user is authenticated
if (!isset($_SESSION['connected'])) {
     // Redirect to the login page or show an error message
     redirect('index', 'index');
}

function constructAvatarForm()
{
     return "<form method='POST' action='" . generateUrl('avatar', 'loadAvatar') . "' enctype='multipart/form-data'>
        <input type='hidden' name='MAX_FILE_SIZE'>
        <input type='file' name='avatar' class='form-control-file' accept='image/jpeg, image/jpg, image/png'/ />
        <input type='submit' class='btn btn-lg btn-primary my-2' name='submit' value='Télécharger'>
        </form>";
}

function processAvatarForm()
{
     $error = '';

     /* bon faut surement trouver un moyen de bloquer upload d'un fichier trop gros (php size limit, JS ou je sais pas quoi)
     mais il est 1h du mat et j'en ai vraiment plein le Q..... J'ai fait mon max sur ce coup là, suis mort. Le dev, très peu pour moi */

     if (isset($_POST['submit'])) {
          
          
          $dossier = 'upload/';
          $fichier = basename($_FILES['avatar']['name']);
          $taille_maxi = 100000;
          $taille = $_FILES['avatar']['size'];
          $extensions = array('.png', '.jpg', '.jpeg');
          $extension = strrchr($_FILES['avatar']['name'], '.');
          

          if (!in_array($extension, $extensions)) {
               $error = '<p class="text-danger">Vous devez uploader un fichier de type png, jpg, jpeg.</p>';
          }


          if ($taille > $taille_maxi) {
               $error = '<p class="text-danger">Vous devez uploader un fichier (png, jpg, jpeg) inférieur à 100ko. Votre fichier pèse ' . $taille . ' octets</p>';
          }

          if (file_exists($dossier . $fichier) == true && !$fichier == null) {
               $error = '<p class="text-danger">Le fichier ' . $fichier . ' existe déjà.</p>';
          }

          if ($fichier == null) {
               $error = '<p class="text-danger">Vous devez sélectionner un fichier à uploader.</p>';
          }


          if (empty($error))  //S'il n'y a pas d'erreur, on upload
          {

               //On formate le nom du fichier ici...
               $fichier = strtr($fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
               $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);


               if (move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) {
                    $error = '<p class="text-success">Fichier ' . $fichier . ' (' . $taille . ' octets) téléversé avec succès !</p>';
               } else {
                    $error = 'Echec de l\'upload !';
               }
          }
     }

     return $error;
}
