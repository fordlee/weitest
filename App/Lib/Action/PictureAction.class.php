<?php
// 本类由系统自动生成，仅供测试用途
class PictureAction extends Action {
	public function __construct() {
        parent::__construct();
        $this->CheckmSession();
    }

    private function CheckmSession(){
        if(!isset($_SESSION['username'])&& !isset($_SESSION['login']) && $_SESSION['login'] !== true){
            $this -> error('抱歉!您还没有登录或登录超时，请重新登录！',U('Auth/login'));
        }
    }

    private function _createWhiteBackground(){
        $image=imagecreatetruecolor(800, 420);
        $white = imagecolorallocate($image, 255, 255, 255);
        imagefill($image,0,0,$white);
        imagepng($image,IMAGE_PATH.'/image.png');
        $image = new ThinkImage(THINKIMAGE_GD, IMAGE_PATH.'/image.png');
        $image->water(IMAGE_PATH.'/logo.png', THINKIMAGE_WATER_CENTER)->save(IMAGE_PATH.'/back.jpg');
    }

    private function _createCut(){
        //将图片裁剪为40x40并保存为corp.jpg
        $img->crop(40, 40)->save(IMAGE_PATH.'/crop.jpg');
        //给裁剪后的图片添加图片水印，位置为右下角，保存为water.jpg
        $img->water(IMAGE_PATH.'/logo.jpg', THINKIMAGE_WATER_CENTER)->save(IMAGE_PATH.'/water.jpg');
    }

    public function portraitpaint(){
        $locate = array(10,10);
        //引入图片处理库
        import('ORG.Util.Image.ThinkImage'); 
        //使用GD库来处理deus.jpg图片
        $img = new ThinkImage(THINKIMAGE_GD, IMAGE_PATH.'/deus.jpg');
        
        //头像位于水印下方
        $this -> _createWhiteBackground();
        $img->open(IMAGE_PATH.'/back.jpg')->water(IMAGE_PATH.'/deus.jpg', THINKIMAGE_WATER_CENTER, 100)->save(IMAGE_PATH.'/water_o.jpg');

        //头像位于水印上方
        $img->open(IMAGE_PATH.'/facebook.jpg')->water(IMAGE_PATH.'/icon.png',THINKIMAGE_WATER_CENTER, 50)->save(IMAGE_PATH.'/facebook_o.jpg');
        
    }

    public function namepaint(){
        //引入图片处理库
        import('ORG.Util.Image.ThinkImage');
        //使用GD库来处理deus.jpg图片
        $img = new ThinkImage(THINKIMAGE_GD, IMAGE_PATH.'/deus.jpg');
        $text = "天黑黑，要下雨了！";
        $font = UPLOADS_PATH."/font/ygyxsziti2.0.ttf";
        $size = 50;
        $img -> text($text, $font, $size,$color = '#00000000', $locate = THINKIMAGE_WATER_CENTER, $offset = 0, $angle = 0) -> save(IMAGE_PATH.'/deus_text.jpg');
    }

}