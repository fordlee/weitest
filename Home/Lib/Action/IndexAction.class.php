<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
    	$language = $this -> _getLanguage();
        $m = D('QuestionView');
        $item = $m -> where(array('language' => $language)) -> limit(12) -> select();
        
        $this -> assign('language', $language);
        $this -> assign('item', $item);
		$this -> display();
    }

    public function question(){
        if(!isset($_GET['id']) && empty($_GET['id'])){
            $qid = $_POST['id'];
        }else{
            $qid = $_GET['id'];
        }
        
    	$language = $this -> _getLanguage();
        $m = D('QuestionView');
        $item = $m -> where(array('language' => $language)) -> select();
        $qitem = $m -> where(array('language' => $language,'id' => $qid)) -> find();
        
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