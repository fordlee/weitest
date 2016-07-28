<?php
class FacebookPaint{

    //注入文字
	public function injectText($im,$attribute,$content=''){

		$c=$this -> _parseColor($attribute['color']);
		$font_color  = imagecolorallocate($im,$c[0],$c[1],$c[2]);
		
		$attribute['content']=$content;

		//解析处理函数
		$funcArr=explode('|', @$attribute['func']);
		foreach ($funcArr as $key => $value) {

			if(preg_match('/^wrap/im', $value)>=1){
				$im=$this -> _autoWrap($im,$attribute);
				return $im;
			}

			if(preg_match('/bold/im', $value)>=1){//处理加粗
				$attribute=$this->_setTextAxis($im,$attribute);//先处理文字位置
				$im=$this -> _boldText($im,$attribute);
				return $im;
			}

		}

		//处理文字定位(center|right|bottom)
		$attribute=$this -> _setTextAxis($im,$attribute);
		
		ImageTTFText($im, $attribute['size'], 0, $attribute['x'], $attribute['y'], $font_color, $attribute['font'], $content);
		//header('Content-Type: image/png');imagepng($im);exit;
		return $im;
	}

	//注入图片
	public function injectImage($im,$attribute,$content){
		$funcArr=explode('|', $attribute['func']);
		$_im=$this -> _getImgSource($content);
		
		//解析处理函数
		foreach ($funcArr as $key => $value) {

			if(preg_match('/^round/im', $value)>=1){//处理圆角
				$_im=$this -> _radiusPic($_im);
			}elseif(preg_match('/^resize/im', $value)>=1){//处理缩放
				$_im=$this -> _resizePic($_im,$this -> _getStrParam($value));
			}elseif(preg_match('/^freecut/im', $value)>=1){//自由裁图
				$_im=$this -> _freecutPic($_im,$this -> _getStrParam($value));
			}elseif(preg_match('/^stripXcut/im', $value)>=1){//X轴裁图
				$_im=$this -> _stripXcutPic($_im,$this -> _getStrParam($value));
			}elseif(preg_match('/^gray/im', $value)>=1){//黑白图片
				$_im=$this -> _grayPic($_im);
			}elseif(preg_match('/^bright/im', $value)>=1){//调节亮度
				$_im=$this -> _brightPic($_im,$this -> _getStrParam($value));
			}elseif(preg_match('/^color/im', $value)>=1){//改变颜色
				$_im=$this -> _colorPic($_im,$this -> _getStrParam($value));
			}elseif(preg_match('/^emboss/im', $value)>=1){//改变浮雕
				$_im=$this -> _emboss($_im);
			}elseif(preg_match('/^bold/im', $value)>=1){//字体加粗
				$_im=$this -> _boldText($_im,$this -> _getStrParam($value));
			}elseif(preg_match('/^bold/im', $value)>=1){//调节对比度
				$_im=$this -> _contrastPic($_im,$this -> _getStrParam($value));
			}
		}

		if(empty($attribute['alpha'])){
			$attribute['alpha'] = 100;
		}

		//imagecopymerge($im, $_im, $attribute['x'], $attribute['y'], 0, 0, imagesx($_im), imagesy($_im), $attribute['alpha']); 
		$this -> imagecopymerge_alpha($im, $_im, $attribute['x'], $attribute['y'], 0, 0, imagesx($_im), imagesy($_im), $attribute['alpha']);
		return $im;
	}

	//画圆角
	private function _radiusPic($im){

	    $image_width    = imagesx($im);  
	    $image_height   = imagesy($im);  

	    $bgcolor= imagecolorallocate($im, 223, 223, 0);   // 图像的背景  
	    imagefill($im, 0, 0, $bgcolor);  
	  
	    // 圆角处理  
	    $radius  = $image_width/2;  
	    // lt(左上角)  
	    $lt_corner  = $this -> _get_lt_rounder_corner($radius);  
	    imagecopymerge($im, $lt_corner, 0, 0, 0, 0, $radius, $radius, 100);  
	    // lb(左下角)  
	    $lb_corner  = imagerotate($lt_corner, 90, 0);  
	    imagecopymerge($im, $lb_corner, 0, $image_height - $radius, 0, 0, $radius, $radius, 100);  
	    // rb(右上角)  
	    $rb_corner  = imagerotate($lt_corner, 180, 0);  
	    imagecopymerge($im, $rb_corner, $image_width - $radius, $image_height - $radius, 0, 0, $radius, $radius, 100);  
	    // rt(右下角)  
	    $rt_corner  = imagerotate($lt_corner, 270, 0);  
	    imagecopymerge($im, $rt_corner, $image_width - $radius, 0, 0, 0, $radius, $radius, 100);  
	  
		$color=imagecolorallocate($im,0,0,255);
		imagecolortransparent($im,$color);

		return $im;
	}

	//画圆角边角
	private function _get_lt_rounder_corner($radius) {  
	    $img     = imagecreatetruecolor($radius, $radius);  // 创建一个正方形的图像  
	    $bgcolor    = imagecolorallocate($img, 0, 0, 255);   // 图像的背景  
	    $fgcolor    = imagecolorallocate($img, 0, 0, 0);  
	    imagefill($img, 0, 0, $bgcolor);  
	    imagefilledarc($img, $radius, $radius, $radius*2, $radius*2, 180, 270, $fgcolor, IMG_ARC_PIE); 
	    // 将弧角图片的颜色设置为透明  
	    imagecolortransparent($img, $fgcolor);  
	    return $img;  
	}

	//调整透明度
	private function _opacity($im, $bgcolor){
		imagecolortransparent($im, $bgcolor);
	}

	//调整图片大小(等比缩放裁切)
	private function _resizePic($im, $param){

		$width=$param[0];
		$height=$param[1];
	    $im_width=imagesx($im);//大图宽度
	    $im_height=imagesy($im);//大图高度
	    $thumb = imagecreatetruecolor($width,$height);

		$fff= imagecolorallocate($thumb , 0 , 0 ,255);//拾取白色
		imagecolortransparent($thumb ,$fff );//把图片中白色设置为透明色

		/**/
		imagealphablending($thumb,false);
		imagesavealpha($thumb,true);
		/**/

	    imagecopyresampled($thumb,$im,0,0,0,0,$width,$height,$im_width,$im_height);
	    return $thumb;
	}

	//裁剪图片
	private function _freecutPic($im, $param){
		//裁剪区域宽高
		$width = $param[0];
		$height = $param[1];
		//裁剪区域开始坐标
		$x = $param[2];
		$y = $param[3];
		
		imagesavealpha($im,true);
		//原图宽高
		$im_width = imagesx($im);
		$im_height = imagesy($im);
		
		//设置新图像
		$img = imagecreatetruecolor($width, $height);
		$color = imagecolorallocate($img, 0, 0, 255);
		imagefill($img, 0, 0, $color);
		
		imagecopyresampled($img,$im,0,0,$x,$y,$width,$height,$width,$im_height);
		return $img;
	}

	//X轴裁条形图
    private function _stripXcutPic($im, $param){
		//裁剪块数
		$num = $param[0];
		//使用裁图哪部分
		$which = $param[1];
		//原图宽高
		$im_width = imagesx($im);
		$im_height = imagesy($im);
		//裁剪图宽高
		$width = floor($im_width/$num);
		$height = $im_height;
		
		//裁剪区域开始坐标
		$x = ($which-1) * $width;
		$y = 0;
		
		//设置新图像
		$img = imagecreatetruecolor($width, $height);
		$color = imagecolorallocate($img, 0, 0, 255);
	    imagefill($img, 0, 0, $color);
		imagecopyresampled($img,$im,0,0,$x,$y,$width,$height,$width,$im_height);
		
		return $img;
	}

	//不失真缩小图片
	private function smallPic($im,$param){
		$maxwidth = $param[0];
		$maxheight = $param[1];

		$pic_width = imagesx($im);
		$pic_height = imagesy($im);

		if(($maxwidth && $pic_width > $maxwidth) || ($maxheight && $pic_height > $maxheight)){
			if($maxwidth && $pic_width>$maxwidth){
				$widthratio = $maxwidth/$pic_width;
				$resizewidth_tag = true;
			}

			if($maxheight && $pic_height>$maxheight){
				$heightratio = $maxheight/$pic_height;
				$resizeheight_tag = true;
			}

			if($resizewidth_tag && $resizeheight_tag){
				if($widthratio<$heightratio){
					$ratio = $widthratio;
				}else{
					$ratio = $heightratio;
				}
			}

			if($resizewidth_tag && !$resizeheight_tag)$ratio = $widthratio;
			if($resizeheight_tag && !$resizewidth_tag)$ratio = $heightratio;

			$newwidth = $pic_width * $ratio;
			$newheight = $pic_height * $ratio;

			if(function_exists("imagecopyresampled")){
				$newim = imagecreatetruecolor($newwidth,$newheight);//PHP系统函数
				imagecopyresampled($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);//PHP系统函数
			}else{
				$newim = imagecreate($newwidth,$newheight);
				imagecopyresized($newim,$im,0,0,0,0,$newwidth,$newheight,$pic_width,$pic_height);
			}

			return $newim;
		}else{
			return $im;
		}
	}

	//图像黑白处理
	private function _grayPic($im){
		imagefilter($im, IMG_FILTER_GRAYSCALE);
		return $im;
	}

	//图片浮雕处理
	private function _emboss($im){
		imagefilter($im, IMG_FILTER_EMBOSS);
		return $im;
	}

	//图片亮度处理
	private function _brightPic($im, $param){
		$bright = $param[0];
		imagefilter($im, IMG_FILTER_BRIGHTNESS, $bright);
		return $im;
	}

	//图片颜色改变
	private function _colorPic($im, $param){
		$r = $param[0];
		$g = $param[1];
		$b = $param[2];
		imagefilter($im, IMG_FILTER_COLORIZE, $r, $g, $b);
		return $im;
	}

	//调节对比度
	private function _contrastPic($im, $param){
		$constrast = $param[0];
		imagefilter($im, IMG_FILTER_CONTRAST,$constrast);
		return $im;
	}

	//字体加粗
	private function _boldText($im,$attribute){
		$_attribute=$attribute;
		$_im=$im;

		//Get the params
		preg_match_all('/bold\(.*?\)/', $_attribute['func'], $match);
		$match=$match[0][0];
		$param=$this -> _getStrParam($match);

		if(!$param[0])$param[0]=0;
		if(!$param[1])$param[1]=0;

		$_attribute['func']="";

		$_im= $this -> injectText($_im,$_attribute,$_attribute['content']);

		//reSet X,Y
		$arr=array('x','y');
		foreach ($arr as $key => $value) {
			preg_match_all('/\d+/', $_attribute[$value], $matchs);
			$_axis=$matchs[0][0]+$param[$key];
			$_attribute[$value]=preg_replace('/\d+/', $_axis, $_attribute[$value]);
		}

		$_im=$this -> injectText($_im,$_attribute,$_attribute['content']);
		return $_im;
	}	

	########################通用函数 START########################
	//解析颜色
	private function _parseColor($color){
	    $arr = array();
	    for($ii=1; $ii<strlen ($color); $ii++){
	        $arr[] = hexdec(substr($color,$ii,2));
	        $ii++;
	    }
	    return $arr;
	}
	
	private function getHTTPS($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_REFERER, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}

	//获取图片类型并创建相应图片资源 $im=getImgSource('test.jpg');
	private function _getImgSource($path){
		if(preg_match('/^(http|https)/im', $path)){

			$uid =  $_SESSION['uid'];
			$foldername = substr($uid,-2);
	        $tmpHeader = UPLOADS_PATH.'/tmp/'.$foldername;

	        //生成文件夹
	        if(!is_dir($tmpHeader)){
	            mkdir($tmpHeader,0777,true);
	        }
	        
	        $arr=pathinfo($path);
			$name=explode('?', $arr['basename']);
			$name=$name[0];
			$filename = $tmpHeader.'/'.$uid.'_'.$name;

			//将个人头像再次存储
			$isRangeTime = $this -> _rangeTime(5*60*60);
			$isUserPic = $this -> _is_UserPic($arr['dirname'],$isRangeTime);

			if(!file_exists($filename) || $isUserPic){
				$ret = $this->getHTTPS($path);
        		$im=imagecreatefromstring($ret);
        		if($ret)file_put_contents($filename, $ret);
			}else{
				$im = $this -> _createImgSource($filename);
			}
		}else{
			$path = UPLOADS_PATH.'/local/'.$path;
			$im = $this -> _createImgSource($path);
		}
		
		return $im;
	}

	private function _is_UserPic($url,$isRangeTime){
		if(preg_match('/(p50x50)$/im', $url)){
			return 0;
		}else{
			return $isRangeTime?1:0;
		}
	}

	//返回时间间隔
    private function _rangeTime($changeTime){
        $currentTime = time();
        if(isset($_SESSION['rangetime'])) {
           if(($currentTime - $_SESSION['rangetime']) >= $changeTime) {
                $_SESSION['rangetime'] = $currentTime;
                return 1;
           }else{
           		$_SESSION['rangetime'] = $currentTime;
           		return 0;
           }
        }else{
            $_SESSION['rangetime'] = $currentTime;
            return 1;
        }
    }

	private function _createImgSource($path){
		
		$image_size=GetImageSize($path);
		switch($image_size[2]){
			case  1:
			$im=@ImageCreateFromGIF($path);
			break;
			case  2:
			$im=@ImageCreateFromJPEG($path);
			break;
			case  3:
			$im=@ImageCreateFromPNG($path);
			break;
		}

		return $im;
	}

	private function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
	    // creating a cut resource
	    $cut = imagecreatetruecolor($src_w, $src_h);
	    $cut = imagecreatetruecolor($src_w,$src_h);

		$fff= imagecolorallocate($cut , 0 , 0 ,255);//拾取白色
		imagecolortransparent($cut ,$fff );//把图片中白色设置为透明色

	    // copying relevant section from background to the cut resource
	    imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
	   
	    // copying relevant section from watermark to the cut resource
	    imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);

	    // insert cut resource to destination image
	    imagecopymerge($dst_im, $cut, $dst_x, $dst_y, 0, 0, $src_w, $src_h, $pct);
	}

	//获取函数参数列表
	private function _getStrParam($str){
		preg_match_all('/(\d+)/im', $str, $match);
		return $match[0];
	}

	//获取图像信息
	private function _getImgInfo($path){
		//获取图像信息
	    $info = getimagesize($path);
		//设置图像信息
		$info = array(
			'width'  => $info[0],
			'height' => $info[1],
			'type'   => image_type_to_extension($info[2], false),
			'mime'   => $info['mime'],
		);
		
		return $info;
	}

	//获取文本大小(长宽)
	private function _getTextSize($attribute){
		//imagettfbbox ( float $size , float $angle , string $fontfile , string $text );
		$sizeArr=imagettfbbox ($attribute['size'], 0, $attribute['font'], $attribute['content']);
		$size=array(
			'width'=>abs($sizeArr[2]-$sizeArr[0]),
			'height'=>abs($sizeArr[5]-$sizeArr[3])
		);

		return $size;
	}

	//获取文本的坐标轴
	private function _getTextAxis($type,$im,$attribute){
		$im_width = imagesx($im);
	    $im_height = imagesy($im);
		
		//获取文字大小
		$textSize=$this -> _getTextSize($attribute);

		$param_attr=$type=='x'?$attribute['x']:$attribute['y'];
		$param_sizeImg=$type=='x'?$im_width:$im_height;
		$param_sizeText=$type=='x'?$textSize['width']:$textSize['height'];

		preg_match_all('/(\w+)/im', $param_attr, $match);
		$match=$match[0];

		$axis=count($match)>=2?($match[1]-$param_sizeText/2):($param_sizeImg-$param_sizeText)/2;
		return $axis;
	}


	//设置文本的坐标轴
	private function _setTextAxis($im,$attribute){
		//获取画板长宽
		$im_width = imagesx($im);
	    $im_height = imagesy($im);	

		//获取文字大小
		$textSize=$this -> _getTextSize($attribute);

		$axisArr=array(
			'x'=>$attribute['x'],
			'y'=>$attribute['y']
		);

		foreach ($axisArr as $key => $value) {
			preg_match_all('/(center|right|bottom)\(?(\d+)?\)?/', $value, $match);
			
			$axisName=$key;
			$fun=@$match[1][0];
			$param=@$match[2][0];
			$param_check=isset($param)&&$param!='';
			
			if(!$fun)continue;

			$param_attr=$axisName=='x'?$attribute['x']:$attribute['y'];
			$param_sizeImg=$axisName=='x'?$im_width:$im_height;
			$param_sizeText=$axisName=='x'?$textSize['width']:$textSize['height'];
			
			switch ($fun) {
				case 'center':
					$axis=$param_check?($param-$param_sizeText/2):($param_sizeImg-$param_sizeText)/2;
					break;
				case 'right':
				case 'bottom':
					$axis=$param_check?($param-$param_sizeText):($param_sizeImg-$param_sizeText);
					break;
			}
			$attribute[$axisName]=$axis;
		}
		
		return $attribute;
	}

	//自动换行
	private function _autoWrap($im,$attribute){
		$param=$this -> _getStrParam($attribute['func']);
		$textArr=preg_split('/[;\r\n]+/s', $attribute['content']);

		$_im=$im;
		$_attribute=$attribute;
		foreach ($textArr as $key => $value) {
			$_attribute['content']=$value;
			$_attribute['func']=preg_replace('/wrap\(.*?\)\|?/im', '', $_attribute['func']);
			$textSize=$this -> _getTextSize($attribute);//获取文字大小
			
			preg_match_all('/\d+/', $_attribute['y'], $matchs);
			$_y=$matchs[0][0]+$key*($param[0]);
			$_attribute['y']=preg_replace('/\d+/', $_y, $_attribute['y']);

			$_im= $this -> injectText($_im,$_attribute,$_attribute['content']);
			$_attribute=$attribute;
		}

		unset($_attribute);
		return $_im;
	}

	//生成不重复随机数
	private function _getUniqueRand($param,$SessionTag=''){
		$min=$param[0];
		$max=$param[1];

		$_arr=range($min,$max);
		$_sRand=$_SESSION[$SessionTag]?$_SESSION[$SessionTag]:array();

		//var_dump($_arr);exit;
		$_arr=array_merge(array_diff($_arr,$_sRand),array_diff($_sRand,$_arr));
		$_len=count($_arr);
		$_rand=@$_arr[rand(0,$_len-1)];

		array_push($_SESSION[$SessionTag], $_rand);
		return $_rand;
	}
	
}
?>