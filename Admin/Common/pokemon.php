<?php

function getPokemon($number,$language='en'){
    $str = file_get_contents(UPLOADS_PATH.'/local/22/'.$language.'.txt');
    $arr = explode("|", $str);
    
    return $arr[$number];
}

function getRandomText($number,$path){
	$str = file_get_contents(UPLOADS_PATH.'/local/'.$path);
	$arr = explode("|", $str);
	//header("Content-type:text/html;charset=utf-8");
	
	return $arr[$number];
}
?>