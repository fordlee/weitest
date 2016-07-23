<?php

function getPokemon($number,$language='en'){
    $str = file_get_contents(UPLOADS_PATH.'/local/22/'.$language.'.txt');
    $str = str_replace(PHP_EOL, ",", $str);
    $arr = explode(",", $str);
    
    return $arr[$number];
}

?>