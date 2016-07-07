<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
    	if(isset($_POST['language']) && !empty($_POST['language'])){
            $language = $_POST['language'];
        }else{
            $language = 'zh';
        }
        $m = D('QuestionView');
        $item = $m -> where(array('language' => $language)) -> limit(12) -> select();
        //var_dump($item);
        //die();
        $this -> assign('item', $item);
		$this -> display();
    }

    public function question(){
    	$qid = $_GET['id'];
    	
    	$this -> display();
    }


}