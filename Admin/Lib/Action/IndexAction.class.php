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

		$this -> redirect('Question/questionlist');
    }

    public function test(){
        $m = M('admin');
        $email = $_SESSION['email'];
        $item = $m -> where(array("email" => $email)) -> find();
        switch ($item['id']) {
            case 1:
                header('Location:http://'.$_SERVER['HTTP_HOST'].'/test/demo1/demo.html');
                break;
            case 2:
                header('Location:http://'.$_SERVER['HTTP_HOST'].'/test/demo2/demo.html');
                break;
            case 3:
                header('Location:http://'.$_SERVER['HTTP_HOST'].'/test/demo3/demo.html');
                break;
            default:
                header('Location:http://'.$_SERVER['HTTP_HOST'].'/test/demo/demo.html');
                break;
        }
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
        
        $this -> assign('item', $item);
        $this -> display();
    }


}