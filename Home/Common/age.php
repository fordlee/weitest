<?php

function getAgeSeconds($birthdate){
	$birthtime = strtotime($birthdate);
	$nowtime = time();
	$birthS = $nowtime - $birthtime;
	return $birthS;
}
	
function getAgeMinute($birthdate){
	$birthM = getAgeSeconds($birthdate)/60;
	$birthM = floor($birthM);
	return $birthM;
}

function getAgeHour($birthdate){
	$birthH = getAgeSeconds($birthdate)/(60*60);
	$birthH = floor($birthH);
	return $birthH;
}

function getAgeDay($birthdate){
	$birthD = getAgeSeconds($birthdate)/(60*60*24);
	$birthD = floor($birthD);
	return $birthD;
}

function getAgeYear($birthdate){
	$birthY = getAgeSeconds($birthdate)/(60*60*24*365);
	$birthY = floor($birthY);
	return $birthY;
}

?>