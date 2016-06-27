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

    public function portraitpaint($locate = THINKIMAGE_WATER_CENTER){
        $imagepath = C('IMAGE_PATH');
        $locate = array(10,10);
        //引入图片处理库
        import('ORG.Util.Image.ThinkImage'); 
        //使用GD库来处理deus.jpg图片
        $img = new ThinkImage(THINKIMAGE_GD, $imagepath.'/back/deus.jpg'); 
        //将图片裁剪为440x440并保存为corp.jpg
        $img->crop(440, 440)->save($imagepath.'/back/crop.jpg');
        //给裁剪后的图片添加图片水印，位置为右下角，保存为water.jpg
        $img->water($imagepath.'/back/logo.jpg', THINKIMAGE_WATER_CENTER)->save($imagepath.'/back/water.jpg');
        //给原图添加水印并保存为water_o.jpg（需要重新打开原图）
        $img->open($imagepath.'/back/deus.jpg')->water($imagepath.'/back/logo.jpg', $locate)->save($imagepath.'/back/water_o.jpg');
       
    }

    public function namepaint(){
        $imagepath = C('IMAGE_PATH');
    }

}