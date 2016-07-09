<?php
class FacebookPaint{

    //生成一张白底图
    private function _createWhiteBackground(){
        $image=imagecreatetruecolor(800, 420);
        $white = imagecolorallocate($image, 255, 255, 255);
        imagefill($image,0,0,$white);
        imagepng($image,IMAGE_PATH.'/imagewhite.png');
    }

   	//生成一张黑底图
    private function _createBlackBackground(){
        $image=imagecreatetruecolor(800, 420);
        $black = imagecolorallocate($image, 0, 0, 0);
        imagefill($image,0,0,$black);
        imagepng($image,IMAGE_PATH.'/imageblack.png');
    }

    //注入文字
	public function injectText($im,$attribute){
		 $c=$this -> _parseColor($attribute['color']);
		 $font_color  = imagecolorallocate($im,$c[0],$c[1],$c[2]);

		 ImageTTFText($im, $attribute['size'], 0, $attribute['x'], $attribute['y'], $font_color, $attribute['font'], $attribute['content']);
		 return $im;
	}

	//注入图片
	public function injectImage($im,$attribute){

		if($attribute['func']=='round'){
			$imgfile=$attribute['content'];
			$_im=$this -> _radiusPic(imagecreatefromjpeg($imgfile));
		}

		imagecopymerge($im, $_im, $attribute['x'], $attribute['y'], 0, 0, imagesx($_im), imagesx($_im), $attribute['alpha']); 

		return $im;
	}

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
	    //header('Content-Type: image/png');  
	    //imagepng($im);exit;
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

	//解析颜色
	private function _parseColor($color){
	    $arr = array();
	    for($ii=1; $ii<strlen ($color); $ii++){
	        $arr[] = hexdec(substr($color,$ii,2));
	        $ii++;
	    }
	    return $arr;
	}
	

	
}
?>