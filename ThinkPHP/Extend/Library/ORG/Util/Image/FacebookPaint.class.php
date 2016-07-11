<?php
class FacebookPaint{

    //注入文字
	public function injectText($im,$attribute,$content){
		 $c=$this -> _parseColor($attribute['color']);
		 $font_color  = imagecolorallocate($im,$c[0],$c[1],$c[2]);

		 ImageTTFText($im, $attribute['size'], 0, $attribute['x'], $attribute['y'], $font_color, $attribute['font'], $content);
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
			}
		}

		if(empty($attribute['alpha'])){
			$attribute['alpha'] = 100;
		}

		imagecopymerge($im, $_im, $attribute['x'], $attribute['y'], 0, 0, imagesx($_im), imagesy($_im), $attribute['alpha']); 

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
	  
		$color=imagecolorallocate($im,255,255,255);
		imagecolortransparent($im,$color);

		return $im;
	}

	//画圆角边角
	private function _get_lt_rounder_corner($radius) {  
	    $img     = imagecreatetruecolor($radius, $radius);  // 创建一个正方形的图像  
	    $bgcolor    = imagecolorallocate($img, 255, 255, 255);   // 图像的背景  
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

		$fff= imagecolorallocate($thumb , 255 , 255 ,255);//拾取白色
		imagecolortransparent($thumb ,$fff );//把图片中白色设置为透明色

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
		$color = imagecolorallocate($img, 255, 255, 255);
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
		$width = $im_width/$num;
		$height = $im_height;
		
		//裁剪区域开始坐标
		$x = ($which-1) * $width;
		$y = 0;
		
		//设置新图像
		$img = imagecreatetruecolor($width, $height);
		$color = imagecolorallocate($img, 255, 255, 255);
	    imagefill($img, 0, 0, $color);
		imagecopyresampled($img,$im,0,0,$x,$y,$width,$height,$width,$im_height);
		
		return $img;
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
	
	//获取图片类型并创建相应图片资源 $im=getImgSource('test.jpg');
	private function _getImgSource($path){
		if(preg_match('/^(http|https)/im', $path)){
			$ret = file_get_contents($path);
        	$im=imagecreatefromstring($ret);
		}else{
			$path = IMAGE_PATH.'/'.$path;
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
		}
		
		return $im;
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
	
}
?>