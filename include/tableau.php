<?php

function getMaxIndiceTab($tab) {
    $max = -1;
    foreach ($tab as $key=>$value) {
        if ($key > $max) {
            $max = $key;
        }
    }
    return $max+1;
}