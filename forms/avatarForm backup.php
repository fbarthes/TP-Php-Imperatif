<?php

function constructAvatarForm()
{
     return "<form method='POST' action='" . generateUrl('avatar', 'loadAvatar') . "' enctype='multipart/form-data'>
        <input type='hidden' name='MAX_FILE_SIZE' value='100000'>
        <input type='file' name='avatar' />
        <input type='submit' name='submit' value='télécharger'>
        </form>";
}


function processFormAvatar()
{

     if (isset($_POST['submit'])) {


          $dossier = 'upload/';
          $fichier = basename($_FILES['avatar']['name']);
          $taille_maxi = 100000;
          $taille = filesize($_FILES['avatar']['tmp_name']);
          $extensions = array('.png', '.jpg', '.jpeg');
          $extension = strrchr($_FILES['avatar']['name'], '.');
          $erreur='';

          
          if (!in_array($extension, $extensions)) {
               $erreur = 'Vous devez uploader un fichier de type png, jpg, jpeg.<br>';
          }
          
          elseif ($taille > $taille_maxi) {
               $erreur = 'Vous devez uploader un fichier inférieur à 100ko.<br>';
          }
          
          if (empty($erreur)) //S'il n'y a pas d'erreur, on upload
          {
               //On formate le nom du fichier ici...
               $fichier = strtr($fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
               $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);

               if (move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) {
                    echo 'Upload effectué avec succès !';
               } else {
                    echo 'Echec de l\'upload !';
                    echo $erreur, 'coucou';
               }
          } 
          
          else {
               echo $erreur;
          }
     }
}

