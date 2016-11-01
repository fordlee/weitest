<?php
function defaults($data,$default){
	if(!$data){
		return $default;
	}
	return $data;
}

function debug($input){
	printf("<p>输出数据为：</p><pre>%s</pre>\n", var_export($input , true));
	exit;
}

function deldir($dir) {
    //先删除目录下的文件
    $dh=opendir($dir);
    while ($file=readdir($dh)) {
        if($file!="." && $file!="..") {
            $fullpath=$dir."/".$file;
            if(!is_dir($fullpath)) {
              unlink($fullpath);
            } else {
              deldir($fullpath);
            }
        }
    }
    closedir($dh);

    //删除当前文件夹
    if(rmdir($dir)) {
        return '删除成功！';
    } else {
        return '删除失败或已删除！';
    }
}

//列出目录下所有文件及子目录 
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

function WordMake( $content , $absolutePath = "" , $isEraseLink = true ){
	import("ORG.Util.Wordmaker");
	$mht = new Wordmaker();
	if ($isEraseLink){
		$content = preg_replace('/<a\s*.*?\s*>(\s*.*?\s*)<\/a>/i' , '$1' , $content);   //去掉链接
	}
	$images = array();
	$files = array();
	$matches = array();
	//这个算法要求src后的属性值必须使用引号括起来
	if ( preg_match_all('/<img[.\n]*?src\s*?=\s*?[\"\'](.*?)[\"\'](.*?)\/>/i',$content ,$matches ) ){
		$arrPath = $matches[1];
		for ( $i=0;$i<count($arrPath);$i++){
			$path = $arrPath[$i];
			$imgPath = trim( $path );
			if ( $imgPath != "" ){
				$files[] = $imgPath;
				if( substr($imgPath,0,7) == 'http://'){
					//绝对链接，不加前缀
				}else{
					$imgPath = $absolutePath.$imgPath;
				}
				$images[] = $imgPath;
			}
		}
	}
	$mht->AddContents("tmp.html",$mht->GetMimeType("tmp.html"),$content);
	for ( $i=0;$i<count($images);$i++){
		$image = $images[$i];
		if ( @fopen($image , 'r') ){
			$imgcontent = @file_get_contents( $image );
			if ( $content )$mht->AddContents($files[$i],$mht->GetMimeType($image),$imgcontent);
		}else{
			echo "file:".$image." not exist!<br />";
		}
	}
	return $mht->GetFile();
}

function downFile($sFilePath){
   if(file_exists($sFilePath)){
		$aFilePath=explode("/",str_replace("","/",$sFilePath));
		$sFileName=$aFilePath[count($aFilePath)-1];
		$nFileSize=filesize($sFilePath);
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
		header("Content-Type:application/force-download");
		header("Content-Disposition:attachment;filename=".$sFileName);
		header("Content-Length: " . $nFileSize);
		header("Content-type: application/octet-stream");
		mb_convert_encoding(readfile($sFilePath),"utf-8","GB2312");
   }else{
       	echo("文件不存在!");
   }
}

?>