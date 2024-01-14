<?php

function constructRegistrationForm()
{
    return "<form action='".generateUrl('security','registration')."' method='POST'>
        <label for='username'>Nom d'utilisateur</label>
        <input type='text' name='username' class='form-control' autocomplete='username' required autofocus>
        <label for='password'>Mot de passe</label>
        <input type='password' name='password' id='password' class='form-control'>
        <label for='passwordverify'>Confirmez le mot de passe</label>
        <input type='password' name='passwordverify' id='passwordverify' class='form-control'>
        <button class='btn btn-lg btn-primary' type='submit' name='submit'>
            Se connecter
        </button>
    </form>";
}

function validateFormRegistration()
{
    $error = [];
    if (isset($_POST['username']) && strlen($_POST['username']) < 5) {
        $error[] = '<div class="text-danger">Le nom d\'utilisateur doit comporter 5 caractères</div>';
    } 
    if (isset($_POST['password']) && strlen($_POST['password']) < 5) {
        $error[] = '<div class="text-danger">Le mot de passe doit comporter 5 caractères</div>';
    } 

    if (isset($_POST['password']) && isset($_POST['passwordverify']) && ($_POST['password'] !== $_POST['passwordverify'])) {
        $error[] = '<div class="text-danger">Les mots de passe doivent être identiques</div>';
    }

    if (count($error) > 0) {
        return $error;
    }
    return true;
}