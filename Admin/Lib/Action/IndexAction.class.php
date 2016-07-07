<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
	public function __construct() {
        parent::__construct();
        $this->CheckmSession();
    }

    private function CheckmSession(){
        if(!isset($_SESSION['email'])&& !isset($_SESSION['login']) && $_SESSION['login'] !== true){
            $this -> error('抱歉!您还没有登录或登录超时，请重新登录！',U('Auth/login'));
        }
    }

    public function index(){

		$this -> redirect('gallery');
    }

    public function gallery(){
        if(isset($_POST['language']) && !empty($_POST['language'])){
            $language = $_POST['language'];
        }else{
            $language = 'zh';
        }
        $m = D('QuestionView');
        $item = $m -> where(array('language' => $language)) -> select();

        $m_a = M('answer');
        foreach ($item as $k => $v) {
            $where = array(
                'qid' => $v['qid'],
                'qdid' => $v['qdid']
            );
            $results = $m_a -> where($where) -> select();
            $item[$k]['results'] = $results;

            $generalset = json_decode($v['generalset'],true);
            $item[$k]['generalset'] = $generalset;
        }

        $setQR = $this -> _setQuestionResult($item[0]);
        $this -> _paintQuestionResult($setQR);
        //die();
        $this -> assign('item', $item);
        $this -> display();
    }

    //设置问题答案参数
    private function _setQuestionResult($qr){
        $setQR = array();
        $bgpicPath = str_replace('/weitest', '.', $qr['bgpic']);
        $minePortraitPath = IMAGE_PATH.'/icon.png';
        $mineName = 'hubery';
        $friend1PortraitPath = IMAGE_PATH.'/friend1.png';
        $friend1Name = 'lucy';
        $setQR['bgpicPath'] = $bgpicPath;
        
        $content = $qr['content'];
        $setQR['content'] = $content;
        
        $results = $qr['results'];
        $length = count($results)-1;
        $rand = $this -> _myrand($length);
        $option = $results[$rand];

        $setQR['option'] = $option;
        
        $generalset = $qr['generalset'];
        foreach ($generalset as $k => $v) {
            $generalset[$k]['portraitLocal'] = $this -> _xysplit($v['portraitLocal']);
            $generalset[$k]['portraitSize'] = $this -> _xysplit($v['portraitSize']);
            $generalset[$k]['nameLocal'] = $this -> _xysplit($v['nameLocal']);
            $generalset[$k]['minePortraitPath'] = $minePortraitPath;
            $generalset[$k]['mineName'] = $mineName;
            $generalset[$k]['friend1PortraitPath'] = $friend1PortraitPath;
            $generalset[$k]['friend1Name'] = $friend1Name;
        }
        
        $setQR['generalset'] = $generalset;
        //var_dump($setQR);
        return $setQR;
    }

    //每隔300秒返回选项随机数
    private function _myrand($length){
        $currentTime = time();
        $changeTime = 300;
        $rand = '';
        if(isset($_SESSION['time'])) {
           if(($currentTime - $_SESSION['time']) >= $changeTime) {
                $_SESSION['time'] = $currentTime;
                  $rand = mt_rand(0, $length);
                  $_SESSION['rand'] = $rand;
           }else{
                   $rand = $_SESSION['rand'];
           }
        }else{
            $_SESSION['time'] = $currentTime;
            $rand = mt_rand(0, $length);
            $_SESSION['rand'] = $rand;
        }

        return $rand;
    }

    //横纵坐标拆分
    private function _xysplit($xy){
        $locate = explode('*',$xy);

        return $locate;
    }

    //根据问题答案参数画图
    private function _paintQuestionResult($setQR){
        $paint = A('Paint');
        $paint -> portraitLocate($setQR);
        $paint -> nameLocate($setQR);
    }


}