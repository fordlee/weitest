<?php
class Blending{
	public static function layerDarken($A, $B){
		return $B > $A ? $A : $B;
	}
	
	public static function layerMultiply($A, $B){
		return $A * $B / 255;
	}

	public static function layerColorBurn($A, $B){
		return $B == 0 ? $B : max(0, (255 - ((255 - $A) << 8 ) / $B));
	}

	public static function layerSubtract($A, $B){
		return $A + $B < 255 ? 0 : $A + $B - 255;
	}

	public static function layerLighten($A, $B){
		return $B > $A ? $B : $A;
	}

	public static function layerScreen($A, $B){
		return 255 - ( ((255 - $A) * (255 - $B)) >> 8);
	}

	public static function layerColorDodge($A, $B){
		return $B == 255 ? $B : min(255, (($A << 8 ) / (255 - $B)));
	}

	public static function layerAdd($A, $B){
		return min(255, ($A + $B));
	}

	public static function layerOverlay($A, $B){
		return ($B < 128) ? (2 * $A * $B / 255) : (255 - 2 * (255 - $A) * (255 - $B) / 255);
	}

	public static function layerSoftLight($A, $B){
		return $B < 128 ? 
			 (2 * (( $A >> 1) + 64)) * ($B / 255) : 
			 (255 - ( 2 * (255 - ( ($A >> 1) + 64 ) )  *  ( 255 - $B ) / 255 ));
	}

	public static function layerHardLight($A, $B){
		return ($A < 128) ? (2 * $A * $B / 255) : (255 - 2 * (255 - $A) * (255 - $B) / 255);
	}

	public static function layerVividLight($A, $B){
		return $B < 128 ? 
			(
				$B == 0 ? 2 * $B : max(0, (255 - ((255 - $A) << 8 ) / (2 * $B)))
			) :
			(
				(2 * ($B - 128)) == 255 ? (2 * ($B - 128)) : min(255, (($A << 8 ) / (255 - (2 * ($B - 128)) )))
			) ;
	}

	public static function layerLinearLight($A, $B){
		return min(255, max(
			0, (($B + 2 * $A) - 255)
		));
	}

	public static function layerPinLight($A, $B){
		return max(0, max(2 * $A - 255, min($B, 2 * $A)));
	}

	public static function layerHardMix($A, $B){
		return ($B < 128 ? 
			(
				$B == 0 ? 2 * $B : max(0, (255 - ((255 - $A) << 8 ) / (2 * $B)))
			) :
			(
				(2 * ($B - 128)) == 255 ? (2 * ($B - 128)) : min(255, (($A << 8 ) / (255 - (2 * ($B - 128)) )))
			))
			< 128 ? 0 : 255 ;
	}

	public static function layerDifference($A, $B){
		return abs($A - $B);
	}

	public static function layerExclusion($A, $B){
		return $A + $B - 2 * $A * $B / 255;
	}
}

?>