<?php

function getPokemon($number,$language='en'){
    $str = file_get_contents(UPLOADS_PATH.'/local/22/'.$language.'.txt');
    $arr = explode("|", $str);
    
    return $arr[$number];
}

function getRandomText($number,$path){
	$str = file_get_contents(UPLOADS_PATH.'/local/'.$path);
	$arr = explode("|", $str);
	
	return $arr[$number];
}

function getCharacterGeneration($birthdate,$lineNo,$language,$path){
	$birthYear = date("Y",strtotime($birthdate));
	$str = file_get_contents(UPLOADS_PATH.'/local/'.$path.'/'.$birthYear.'.txt');

	if($language == "zh"){
		preg_match_all("/./us", $str, $match);
	    $arr = $match[0];
	    for ($i=0; $i < count($arr); $i++) { 
	      $txt .= $arr[$i];
	      if(($i+1)%$lineNo == 0){
	        $txt = $txt."\r\n";
	      }
	    }
	}else{
		$arr = explode(' ', $str);
		for ($i=0; $i < count($arr); $i++) { 
			$txt=$txt.' '.$arr[$i];
			if(($i+1)%$lineNo == 0){
		       $txt = $txt."\r\n";
		    }
		}
	}
	
	return $txt;
}

function getTextByDateformat($birthdate,$lineNo,$language,$path,$format='z'){
	$date = date($format,strtotime($birthdate));
	$str = file_get_contents(UPLOADS_PATH.'/local/'.$path.'/'.$date.'.txt');

	if($language == "zh"){
		preg_match_all("/./us", $str, $match);
	    $arr = $match[0];
	    for ($i=0; $i < count($arr); $i++) { 
	      $txt .= $arr[$i];
	      if(($i+1)%$lineNo == 0){
	        $txt = $txt."\r\n";
	      }
	    }
	}else{
		$arr = explode(' ', $str);
		for ($i=0; $i < count($arr); $i++) { 
			$txt=$txt.' '.$arr[$i];
			if(($i+1)%$lineNo == 0){
		       $txt = $txt."\r\n";
		    }
		}
	}
	
	return $txt;
}
?>