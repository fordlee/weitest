<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
    	$language = $this -> _getLanguage();
        $m = D('QuestionView');
        $where = array(
            'status' => 1,
            'language' => $language
        );
        //$item = $m -> order('id desc') -> where($where) -> limit(12) -> select();
        $item = $m -> where($where) -> limit(12) -> select();
        $this -> assign('language', $language);
        $this -> assign('item', $item);
		$this -> display();
    }

    public function next(){
        $language = $this -> _getLanguage();
        $m = D('QuestionView');
        $where = array(
            'status' => 1,
            'language' => $language
        );
        $count = $m -> where($where) -> count();
        $start = rand(0,$count-12);
        //$item = $m -> order('id desc') -> where($where) -> limit($start,12) -> select();
        $item = $m -> where($where) -> limit($start,12) -> select();

        $this -> assign('backflag',1);
        $this -> assign('language', $language);
        $this -> assign('item', $item);
        $this -> display('index');
    }

    public function question(){
        if(!isset($_GET['id']) && empty($_GET['id'])){
            $qid = $_POST['id'];
        }else{
            $qid = $_GET['id'];
        }
        
    	$language = $this -> _getLanguage();
        $m = D('QuestionView');
        $start = $_SESSION['start'];
        $where = array(
            'status' => 1,
            'language' => $language
        );
        //$item = $m -> order('id desc') -> where($where) -> limit(0,12) -> select();
        $item = $m -> where($where) -> limit(0,12) -> select();
        $w_q = array(
            'id' => $qid,
            'status' => 1,
            'language' => $language
        );
        $qitem = $m -> where($w_q) -> find();
        
        $this -> assign('qid', $qid);
        $this -> assign('language', $language);
        $this -> assign('item', $item);
        $this -> assign('qitem', $qitem);
        $this -> display();
    }

    private function _getLanguage(){
        if(isset($_POST['language']) && !empty($_POST['language'])){
            $language = $_POST['language'];
            $_SESSION['language'] = $language;
        }elseif(!empty($_SESSION['language'])){
            $language = $_SESSION['language'];
        }else{
            $language = 'zh';
        }

        return $language;
    }
    

}