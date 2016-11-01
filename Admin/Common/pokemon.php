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

/* 函数 listDirTree( $dirName = null ) 
** 功能 列出目录下所有文件及子目录 
** 参数 $dirName 目录名称 
*/ 
function listDirTree( $dirName = null ) { 
	if( empty( $dirName ) ) exit( "IBFileSystem: directory is empty." ); 
	if( is_dir( $dirName ) ) { 
		if( $dh = opendir( $dirName ) ) { 
			$tree = array(); 
			while( ( $file = readdir( $dh ) ) !== false ) { 
				if( $file != "." && $file != ".." ) { 
					$filePath = $dirName . "/" . $file; 
					if( is_dir( $filePath ) ) { 
						//为目录,递归 
						$tree[$file] = listDirTree( $filePath ); 
					}else{ 
						//为文件,添加到当前数组 
						$tree[] = $file; 
					} 
				} 
			} 
			closedir( $dh ); 
		}else{ 
			exit( "IBFileSystem: can not open directory $dirName."); 
		} 
			//返回当前的$tree 
			return $tree; 
	}else{ 
		exit( "IBFileSystem: $dirName is not a directory."); 
	} 
}



?>