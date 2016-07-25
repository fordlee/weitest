<?php

function getPokemon($number,$language='en'){
    $str = file_get_contents(UPLOADS_PATH.'/local/22/'.$language.'.txt');
    $arr = explode("|", $str);
    
    return $arr[$number];
}

?>