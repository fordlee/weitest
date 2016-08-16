<?php
class GDFilter{
	/** Apply 'Dreamy' preset */
	public function gd_filter_dreamy($im){
		imagefilter($im, IMG_FILTER_BRIGHTNESS, 20);
		imagefilter($im, IMG_FILTER_CONTRAST, -35);
		imagefilter($im, IMG_FILTER_COLORIZE, 60, -10, 35);
		imagefilter($im, IMG_FILTER_SMOOTH, 7);
		$im = $this -> gd_apply_overlay($im, 'scratch', 10);
		$im = $this -> gd_apply_overlay($im, 'vignette', 100);
		return $im;
	}

	/** Apply 'Blue Velvet' preset */
	public function gd_filter_velvet($im){
		imagefilter($im, IMG_FILTER_BRIGHTNESS, 5);
		imagefilter($im, IMG_FILTER_CONTRAST, -25);
		imagefilter($im, IMG_FILTER_COLORIZE, -10, 45, 65);
		$im = $this -> gd_apply_overlay($im, 'noise', 45);
		$im = $this -> gd_apply_overlay($im, 'vignette', 100);
		return $im;
	}

	/** Apply 'Chrome' preset */
	public function gd_filter_chrome($im){
		imagefilter($im, IMG_FILTER_BRIGHTNESS, 15);
		imagefilter($im, IMG_FILTER_CONTRAST, -15);
		imagefilter($im, IMG_FILTER_COLORIZE, -5, -10, -15);
		$im = $this -> gd_apply_overlay($im, 'noise', 45);
		$im = $this -> gd_apply_overlay($im, 'vignette', 100);
		return $im;
	}

	/** Apply 'Lift' preset */
	public function gd_filter_lift($im){
		imagefilter($im, IMG_FILTER_BRIGHTNESS, 50);
		imagefilter($im, IMG_FILTER_CONTRAST, -25);
		imagefilter($im, IMG_FILTER_COLORIZE, 75, 0, 25);
		$im = $this -> gd_apply_overlay($im, 'emulsion', 100);
		return $im;
	}

	/** Apply 'Canvas' preset */
	public function gd_filter_canvas($im){
		imagefilter($im, IMG_FILTER_BRIGHTNESS, 25);
		imagefilter($im, IMG_FILTER_CONTRAST, -25);
		imagefilter($im, IMG_FILTER_COLORIZE, 50, 25, -35);
		$im = $this -> gd_apply_overlay($im, 'canvas', 100);
		return $im;
	}

	/** Apply 'Vintage 600' preset */
	public function gd_filter_vintage($im){
		imagefilter($im, IMG_FILTER_BRIGHTNESS, 15);
		imagefilter($im, IMG_FILTER_CONTRAST, -25);
		imagefilter($im, IMG_FILTER_COLORIZE, -10, -5, -15);
		imagefilter($im, IMG_FILTER_SMOOTH, 7);
		$im = $this -> gd_apply_overlay($im, 'scratch', 7);
		return $im;
	}

	/** Apply 'Monopin' preset */
	public function gd_filter_monopin($im){
		imagefilter($im, IMG_FILTER_GRAYSCALE);
		imagefilter($im, IMG_FILTER_BRIGHTNESS, -15);
		imagefilter($im, IMG_FILTER_CONTRAST, -15);
		$im = $this -> gd_apply_overlay($im, 'vignette', 100);
		return $im;
	}

	/** Apply 'Antique' preset */
	public function gd_filter_antique($im){
		imagefilter($im, IMG_FILTER_BRIGHTNESS, 0);
		imagefilter($im, IMG_FILTER_CONTRAST, -30);
		imagefilter($im, IMG_FILTER_COLORIZE, 75, 50, 25);
		return $im;
	}

	/** Apply 'Black & White' preset */
	public function gd_filter_blackwhite($im){
		imagefilter($im, IMG_FILTER_GRAYSCALE);
		imagefilter($im, IMG_FILTER_BRIGHTNESS, 10);
		imagefilter($im, IMG_FILTER_CONTRAST, -20);
		return $im;
	}

	/** Apply 'Colour Boost' preset */
	public function gd_filter_boost($im){
		imagefilter($im, IMG_FILTER_CONTRAST, -35);
		imagefilter($im, IMG_FILTER_COLORIZE, 25, 25, 25);
		return $im;
	}

	/** Apply 'Sepia' preset */
	public function gd_filter_sepia($im){
		imagefilter($im, IMG_FILTER_GRAYSCALE);
		imagefilter($im, IMG_FILTER_BRIGHTNESS, -10);
		imagefilter($im, IMG_FILTER_CONTRAST, -20);
		imagefilter($im, IMG_FILTER_COLORIZE, 60, 30, -15);
		return $im;
	}

	/** Apply 'Partial blur' preset */
	public function gd_filter_blur($im){
		imagefilter($im, IMG_FILTER_SELECTIVE_BLUR);
		imagefilter($im, IMG_FILTER_GAUSSIAN_BLUR);
		imagefilter($im, IMG_FILTER_CONTRAST, -15);
		imagefilter($im, IMG_FILTER_SMOOTH, -2);
		return $im;
	}

	/** Apply a PNG overlay */
	public function gd_apply_overlay($im, $type, $amount){
		$width = imagesx($im);
		$height = imagesy($im);
		$filter = imagecreatetruecolor($width, $height);
		
		imagealphablending($filter, false);
		imagesavealpha($filter, true);
		
		$transparent = imagecolorallocatealpha($filter, 255, 255, 255, 127);
		imagefilledrectangle($filter, 0, 0, $width, $height, $transparent);
		
		$overlay = UPLOADS_PATH.'/filters/'.$type.'.png';
		$png = imagecreatefrompng($overlay);
		imagecopyresampled($filter, $png, 0, 0, 0, 0, $width, $height, $width, $height);
		
		$comp = imagecreatetruecolor($width, $height);
		imagecopy($comp, $im, 0, 0, 0, 0, $width, $height);
		imagecopy($comp, $filter, 0, 0, 0, 0, $width, $height);
		imagecopymerge($im, $comp, 0, 0, 0, 0, $width, $height, $amount);
		
		imagedestroy($comp);
		return $im;
	}
	

}

?>