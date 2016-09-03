<?php
// 本类由系统自动生成，仅供测试用途
class PaintAction extends Action {
	public function __construct() {
        parent::__construct();
        import('ORG.Util.Image.ThinkImage');
        $this->CheckmSession();
    }

    private function CheckmSession(){
        if(!isset($_SESSION['email'])&& !isset($_SESSION['login']) && $_SESSION['login'] !== true){
            $this -> error('抱歉!您还没有登录或登录超时，请重新登录！',U('Auth/login'));
        }
    }

    private function _createWhiteBackground(){
        $image=imagecreatetruecolor(800, 420);
        $white = imagecolorallocate($image, 255, 255, 255);
        imagefill($image,0,0,$white);
        imagepng($image,IMAGE_PATH.'/imagewhite.png');
    }

    private function _createBlackBackground(){
        $image=imagecreatetruecolor(800, 420);
        $black = imagecolorallocate($image, 0, 0, 0);
        imagefill($image,0,0,$black);
        imagepng($image,IMAGE_PATH.'/imageblack.png');
    }

    private function _getLocate($generalset,$type){
        foreach ($generalset as $k => $v) {
            $locate[$k] = $v[$type];
        }

        return $locate;
    }

    public function portraitLocate($setQR){
        $generalset = $setQR['generalset'];
        $image = new ThinkImage();
        
        $this -> _createWhiteBackground();
        $length = count($generalset)-1;
        $locate = $this -> _getLocate($generalset,'portraitLocal');
        foreach ($generalset as $k => $v) {
            if($v['rel'] == 2){
                //头像位于水印下方
                switch ($length) {
                    case 1:
                        $image -> open(IMAGE_PATH.'/imagewhite.png') -> water($v['minePortraitPath'], $locate['mine']) -> water($v['friend1PortraitPath'], $locate['friend1']) -> save(IMAGE_PATH.'/back.jpg');
                        break;
                    case 2:
                        $image -> open(IMAGE_PATH.'/imagewhite.png') -> water($v['minePortraitPath'], $locate['mine']) -> water($v['friend1PortraitPath'], $locate['friend1']) -> water($v['friend2PortraitPath'], $locate['friend2']) -> save(IMAGE_PATH.'/back.jpg');
                        break;
                    case 3:
                        $image -> open(IMAGE_PATH.'/imagewhite.png') -> water($v['minePortraitPath'], $$locate['mine']) -> water($v['friend1PortraitPath'], $locate['friend1']) -> water($v['friend2PortraitPath'], $locate['friend2']) -> water($v['friend3PortraitPath'], $locate['friend3']) -> save(IMAGE_PATH.'/back.jpg');
                        break;
                    case 4:
                        $image -> open(IMAGE_PATH.'/imagewhite.png') -> water($v['minePortraitPath'], $$locate['mine']) -> water($v['friend1PortraitPath'], $locate['friend1']) -> water($v['friend2PortraitPath'], $locate['friend2']) -> water($v['friend3PortraitPath'], $locate['friend3']) -> water($v['friend4PortraitPath'], $locate['friend4']) -> save(IMAGE_PATH.'/back.jpg');
                        break;
                    default:
                        $image -> open(IMAGE_PATH.'/imagewhite.png') -> water($v['minePortraitPath'], $$locate['mine']) -> save(IMAGE_PATH.'/back.jpg');
                }
                $image -> open(IMAGE_PATH.'/back.jpg') -> water($setQR['bgpicPath'], $locate, 50) -> save(IMAGE_PATH.'/facebook_o.jpg');
            }else{
                //头像位于水印上方
                switch ($length) {
                    case 1:
                        $image -> open($setQR['bgpicPath']) -> water($v['minePortraitPath'], $locate['mine']) -> water($v['friend1PortraitPath'], $locate['friend1']) -> save(IMAGE_PATH.'/facebook_o.jpg');
                        break;
                    case 2:
                        $image -> open($setQR['bgpicPath']) -> water($v['minePortraitPath'], $locate['mine']) -> water($v['friend1PortraitPath'], $locate['friend1']) -> water($v['friend2PortraitPath'], $locate['friend2']) -> save(IMAGE_PATH.'/facebook_o.jpg');
                        break;
                    case 3:
                        $image -> open($setQR['bgpicPath']) -> water($v['minePortraitPath'], $locate['mine']) -> water($v['friend1PortraitPath'], $locate['friend1']) -> water($v['friend2PortraitPath'], $locate['friend2']) -> water($v['friend3PortraitPath'], $locate['friend3']) -> save(IMAGE_PATH.'/facebook_o.jpg');
                        break;
                    case 4:
                        $image -> open($setQR['bgpicPath']) -> water($v['minePortraitPath'], $locate['mine']) -> water($v['friend1PortraitPath'], $locate['friend1']) -> water($v['friend2PortraitPath'], $locate['friend2']) -> water($v['friend3PortraitPath'], $locate['friend3']) -> water($v['friend4PortraitPath'], $locate['friend4']) -> save(IMAGE_PATH.'/facebook_o.jpg');
                        break;
                    default:
                        $image -> open($setQR['bgpicPath']) -> water($v['minePortraitPath'], $locate['mine']) -> save(IMAGE_PATH.'/facebook_o.jpg');
                }
                
            }
        }
        
    }

    public function midOverlay(){
        $image = new ThinkImage();
        $img1 = new ThinkImage(THINKIMAGE_GD, IMAGE_PATH.'/water_o.jpg');
        $img2 = new ThinkImage(THINKIMAGE_GD, IMAGE_PATH.'/facebook.jpg');
        
        $w1 = $img1 -> width();
        $h1 = $img1 -> height();
        $w2 = $img2 -> width();
        $h2 = $img2 -> height();

        $img1 -> crop($w1/3, $h1, $w1/3, 0) -> save(IMAGE_PATH.'/crop1.jpg');
        $img2 -> crop($w2/3, $h2, $w2/3, 0) -> save(IMAGE_PATH.'/crop2.jpg');
        $image -> open(IMAGE_PATH.'/crop1.jpg') -> water(IMAGE_PATH.'/crop2.jpg',THINKIMAGE_WATER_CENTER, 50) -> save(IMAGE_PATH.'/midOverlay.jpg');
        $this -> _createWhiteBackground();
        $image -> open(IMAGE_PATH.'/imagewhite.png') -> water(IMAGE_PATH.'/crop1.jpg',THINKIMAGE_WATER_WEST, 100) -> water(IMAGE_PATH.'/midOverlay.jpg', THINKIMAGE_WATER_CENTER, 100) -> water(IMAGE_PATH.'/crop2.jpg',THINKIMAGE_WATER_EAST, 100) -> save(IMAGE_PATH.'/overlay.jpg');
    }

    public function twoPart(){
        $this -> _createWhiteBackground();
        $img = new ThinkImage(THINKIMAGE_GD, IMAGE_PATH.'/imagewhite.png');
        $img1 = new ThinkImage(THINKIMAGE_GD, IMAGE_PATH.'/water_o.jpg');
        $img2 = new ThinkImage(THINKIMAGE_GD, IMAGE_PATH.'/facebook.jpg');

        $w1 = $img1 -> width();
        $h1 = $img1 -> height();
        $w2 = $img2 -> width();
        $h2 = $img2 -> height();

        $img1 -> crop($w1/2, $h1, $w1/4, 0) -> save(IMAGE_PATH.'/part1.jpg');
        $img2 -> crop($w2/2, $h2, $w2/4, 0) -> save(IMAGE_PATH.'/part2.jpg');

        $img -> open(IMAGE_PATH.'/imagewhite.png') -> water(IMAGE_PATH.'/part1.jpg',THINKIMAGE_WATER_WEST, 100) -> water(IMAGE_PATH.'/part2.jpg',THINKIMAGE_WATER_EAST, 100) -> save(IMAGE_PATH.'/composer.jpg');     
    }

    public function nameLocate($setQR){
        $generalset = $setQR['generalset'];
        $image = new ThinkImage();

        $length = count($generalset)-1;
        $locate = $this -> _getLocate($generalset,'nameLocal');
        $font = UPLOADS_PATH."/font/simsun.ttc";
        $size = 50;
        $color = '#00000000';
        foreach ($generalset as $k => $v) {
            switch ($length) {
                case 1:
                    $image -> open($setQR['bgpicPath']) -> text($v['mineName'], $font, $size, $color, $locate['mine']) -> text($v['friend1Name'], $font, $size, $color, $locate['friend1']) -> save(IMAGE_PATH.'/facebook_text.jpg');
                    break;
                case 2:
                    $image -> open($setQR['bgpicPath']) -> text($v['mineName'], $font, $size, $color, $locate['mine']) -> text($v['friend1Name'], $font, $size, $color, $locate['friend1']) -> text($v['friend2Name'], $font, $size, $color, $locate['friend2']) -> save(IMAGE_PATH.'/facebook_text.jpg');
                    break;
                case 3:
                    $image -> open($setQR['bgpicPath']) -> text($v['mineName'], $font, $size, $color, $locate['mine']) -> text($v['friend1Name'], $font, $size, $color, $locate['friend1']) -> text($v['friend2Name'], $font, $size, $color, $locate['friend2']) -> text($v['friend3Name'], $font, $size, $color, $locate['friend3']) -> save(IMAGE_PATH.'/facebook_text.jpg');
                    break;
                case 4:
                    $image -> open($setQR['bgpicPath']) -> text($v['mineName'], $font, $size, $color, $locate['mine']) -> text($v['friend1Name'], $font, $size, $color, $locate['friend1']) -> text($v['friend2Name'], $font, $size, $color, $locate['friend2']) -> text($v['friend3Name'], $font, $size, $color, $locate['friend3']) -> text($v['friend4Name'], $font, $size, $color, $locate['friend4']) -> save(IMAGE_PATH.'/facebook_text.jpg');
                    break;
                default:
                    $image -> open($setQR['bgpicPath']) -> text($v['mineName'], $font, $size, $color, $locate['mine']) -> save(IMAGE_PATH.'/facebook_text.jpg');
            }
        }
    }

    

}