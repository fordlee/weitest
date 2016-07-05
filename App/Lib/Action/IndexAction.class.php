<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
	public function __construct() {
        parent::__construct();
        $this->CheckmSession();
    }

    private function CheckmSession(){
        if(!isset($_SESSION['username'])&& !isset($_SESSION['login']) && $_SESSION['login'] !== true){
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
        }
        
        $this -> assign('item', $item);
        $this -> display();
    }



}