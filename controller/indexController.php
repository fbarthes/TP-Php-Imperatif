<?php

function index() 
{
    $vars = [
        'title' => 'bienvenue',
        'content' => '<div class="glass my-3"><h2 class="text-center">Bienvenue sur mon site</h2></div>',
    ];
    createView($vars);
}