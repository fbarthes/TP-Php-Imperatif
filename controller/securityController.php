<?php
include_once(__DIR__.'/../forms/loginForm.php');
include_once(__DIR__.'/../forms/registrationForm.php');
include_once(__DIR__.'/../model/user.php');

function login()
{ 
    $form = constructLoginForm();
    if (($error = processFormLogin()) === true) {
        redirect('index','index');
    }

    createView([
        'title' => 'Login!',
        'error' => $error,
        'form' => $form,
    ],'/login/login.php');
    
}

function disconnect()
{
    if($_SESSION['connected']) {
        unset($_SESSION['connected']);
    }
    redirect('index','index');
}

function registration()
{
    $form = constructRegistrationForm();
    $error= [];

    if(isset($_POST['submit']) && (($error=validateFormRegistration()) === true)) {
        if(getUser($_POST['username']) === false) {
            createUser($_POST['username'],$_POST['password']);
            redirect('security','login');
        } else {
            $error = [];
            $error[] = '<div class="text-danger">identifiant déjà utilisé</div>';
        }

    }

    createView([
        'title' => 'Enregistrez vous',
        'form' => $form,
        'error' => $error,
    ],'/registration/registration.php');
}