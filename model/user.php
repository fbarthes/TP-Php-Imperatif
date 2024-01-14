<?php

function createUser($username,$password)
{
    if (!is_dir('datas')) {
        mkdir('datas');
        chmod('datas',644);
        if (!file_exists('datas/users.json')) {
            $stream = fopen('datas/users.json','w');
            chmod('datas/users.json',644);
            fclose($stream);
        }
    }
    $users = getAllUsers();
    $users[$username] = password_hash($password, PASSWORD_DEFAULT);
    ecrireFile("datas/users.json",$users);
}

function getAllUsers()
{
    return lireFile('datas/users.json');
}

function getUser($username)
{
    $users = getAllUsers();
    if (array_key_exists($username,$users)) {
        return $users[$username];
    }
    return false;
}