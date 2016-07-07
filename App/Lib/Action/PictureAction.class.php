<?php
// 本类由系统自动生成，仅供测试用途
class PictureAction extends Action {
	public function __construct() {
        parent::__construct();
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

    public function portraitLocate(){
        $locate = array(10,10);
        import('ORG.Util.Image.ThinkImage');
        $img = new ThinkImage(THINKIMAGE_GD, IMAGE_PATH.'/deus.jpg');
        
        //头像位于水印下方
        $this -> _createWhiteBackground();
        $image = new ThinkImage(THINKIMAGE_GD, IMAGE_PATH.'/imagewhite.png');
        $image->water(IMAGE_PATH.'/logo.png', THINKIMAGE_WATER_CENTER)->save(IMAGE_PATH.'/back.jpg');
        $img -> open(IMAGE_PATH.'/back.jpg')->water(IMAGE_PATH.'/deus.jpg', THINKIMAGE_WATER_CENTER, 100)->save(IMAGE_PATH.'/water_o.jpg');

        //头像位于水印上方
        $img -> open(IMAGE_PATH.'/facebook.jpg')->water(IMAGE_PATH.'/icon.png',THINKIMAGE_WATER_CENTER, 50)->save(IMAGE_PATH.'/facebook_o.jpg');
        
    }

    public function midOverlay(){
        import('ORG.Util.Image.ThinkImage');
        $img = new ThinkImage(THINKIMAGE_GD, IMAGE_PATH.'/imagewhite.png');
        $img1 = new ThinkImage(THINKIMAGE_GD, IMAGE_PATH.'/water_o.jpg');
        $img2 = new ThinkImage(THINKIMAGE_GD, IMAGE_PATH.'/facebook.jpg');
        
        $w1 = $img1 -> width();
        $h1 = $img1 -> height();
        $w2 = $img2 -> width();
        $h2 = $img2 -> height();

        $img1 -> crop($w1/3, $h1, $w1/3, 0) -> save(IMAGE_PATH.'/crop1.jpg');
        $img2 -> crop($w2/3, $h2, $w2/3, 0) -> save(IMAGE_PATH.'/crop2.jpg');
        $img -> open(IMAGE_PATH.'/crop1.jpg') -> water(IMAGE_PATH.'/crop2.jpg',THINKIMAGE_WATER_CENTER, 50) -> save(IMAGE_PATH.'/midOverlay.jpg');
        $this -> _createWhiteBackground();
        $img -> open(IMAGE_PATH.'/imagewhite.png') -> water(IMAGE_PATH.'/crop1.jpg',THINKIMAGE_WATER_WEST, 100) -> water(IMAGE_PATH.'/midOverlay.jpg', THINKIMAGE_WATER_CENTER, 100) -> water(IMAGE_PATH.'/crop2.jpg',THINKIMAGE_WATER_EAST, 100) -> save(IMAGE_PATH.'/overlay.jpg');
    }

    public function twoPart(){
        import('ORG.Util.Image.ThinkImage');
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

    public function nameLocate(){
        import('ORG.Util.Image.ThinkImage');
        $img = new ThinkImage(THINKIMAGE_GD, IMAGE_PATH.'/deus.jpg');
        $text = "天黑黑，要下雨了！";
        $font = UPLOADS_PATH."/font/simsun.ttc";
        $size = 50;
        $img -> text($text, $font, $size,$color = '#00000000', $locate = THINKIMAGE_WATER_WEST, $offset = 0, $angle = 0) -> save(IMAGE_PATH.'/deus_text.jpg');
    }

    

}