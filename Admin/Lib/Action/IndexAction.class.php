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

        $this -> display('Mytests/demo');
    }

    public function gallery(){
        if(isset($_POST['language']) && !empty($_POST['language'])){
            $language = $_POST['language'];
        }else{
            $language = 'en';
        }

        $m_q = M('Question');
        $m = D('QuestionView');

        import("ORG.Util.Page");//导入分页类
        $count  = $m_q -> count();//计算总数
        $Page   = new Page($count, 12);
        $item   = $m_q -> limit($Page->firstRow. ',' . $Page->listRows) -> order('reorder desc,id desc') -> where(array('language' => $language)) -> select();        
        $page = $Page->show();
        
        $this -> assign('page', $page);
        $this -> assign('item', $item);

        $this -> display();
    }


}