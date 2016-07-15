<?php

function getAge($birthtime){
	$nowtime = time();
	$age = $nowtime - $birthtime;
	return $age;
}
	

?>