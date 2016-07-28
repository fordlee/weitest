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

        $count = $m -> where($where) -> count();
        import("ORG.Util.MyPage");//导入自定义分页类
        $Page   = new Page($count, 12);
        $item   = $m -> limit($Page->firstRow. ',' . $Page->listRows)->order('reorder desc,id desc')-> where($where)->select();        
        $page = $Page->show();
        
        $this -> assign('page',$page);
        $this -> assign('language', $language);
		$languageTp = replaceLanguage($language);
        $this -> assign('languageTp',$languageTp);
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
        import("ORG.Util.MyPage");//导入自定义分页类
        $Page   = new Page($count, 12);
        $item   = $m -> limit($Page->firstRow. ',' . $Page->listRows)-> where($where)->order('reorder desc,id desc')->select();       
        $page = $Page->show();

        $this -> assign('page',$page);
        $this -> assign('language', $language);
		$languageTp = replaceLanguage($language);
        $this -> assign('languageTp',$languageTp);
        $this -> assign('item', $item);
        $this -> display('index');
    }

    public function question($questionId='',$processTag=''){

        $qid = $_GET['id'];

        if($questionId){
            $qid=$questionId;
            $this->assign('processTag',$processTag);
        }
        
    	$language = $this -> _getLanguage();   

        $m = D('QuestionView');
		$where = array(
            'status' => 1,
            'language' => $language
        );
        
        $item = $m -> order('reorder desc,id desc') -> where($where) -> limit(0,18) -> select();
		shuffle($item);
        $w_q = array(
            'id' => $qid,
            'language' => $language
        );
        $qitem = $m -> where($w_q) -> find();

		$ogimage = 'http://'.$_SERVER['HTTP_HOST'].C('IMAGEQ_PATH').'/'.$qitem['bgpic'];
        $pic=$_GET['pic'];
        if($pic){
            $_path=str_replace('-', '/', $pic);
            $ogimage='http://'.$_SERVER['HTTP_HOST'].'/Uploads/image/'.$_path;
        }
        
        $this -> assign('ogimage',$ogimage);     
        $this -> assign('qid', $qid);
        $this -> assign('language', $language);
		$languageTp = replaceLanguage($language);
        $this -> assign('languageTp',$languageTp);
        $this -> assign('item', $item);
        $this -> assign('qitem', $qitem);
        $this -> display('Index:question');
    }
	
	private function _getLanguage(){
        if(isset($_POST['language']) && !empty($_POST['language'])){
            $language = $_POST['language'];
            $url = "http://".$language.".mytests.co";
            //$qid = $_POST['id'];
            //$url = "http://".$language.".mytests.co/question/id/".$qid;
            header("Location:".$url);
        }else{
            //$server_name = $_SERVER['SERVER_NAME'];
            $server_name = "zh.mytests.co";
            $language = explode('.',$server_name)[0];
            if($language == "www" || $language == "mytests" || $language == "Mytests"){
                $language = "en";
            }
        }

        return $language;
    }
    
}