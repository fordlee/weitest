<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    //构造函数
    public function __construct() {
        parent::__construct();
        $utm=$_GET['utm'];
        $utm=$utm?'?utm='.$utm:'';
        $_utm=$utm?'&utm='.$utm:'';
        $this->assign('utm',$utm);
        $this->assign('_utm',$_utm);
    }

    public function index(){
        
    	$language = $this -> _getLanguage();
        $m = D('QuestionView');
        $where = array(
            'status' => 1,
            'language' => $language
        );

        $count = $m -> where($where) -> count();
        import("ORG.Util.MyPage");//导入自定义分页类
        $Page   = new Page($count, 15);
        //添加广告参数调用
        if(isset($_GET['aid']) && !empty($_GET['aid'])){
            $arr = explode('_', $_GET['aid']);            
            foreach ($arr as $k => $v) {
                $w = array(
                    'status' => 1,
                    'language' => $language,
                    'id' => $v
                );
                $notqid[$k] = $v;
                if(!isset($_GET['p']) || $_GET['p'] == 1){
                    $_item=$m -> limit($Page->firstRow.','. $Page->listRows)-> where($w)->find();
                    if($_item){
                        $aditem[$k] = $_item;
                    }
                }
            }

            //'id' => array(array('exp','NOT IN('.implode(',', $notqid).')'),array('exp',' is NOT NULL'),'AND')
            $where = array(
                'status' => 1,
                'language' => $language,
                'id' => array('not in',$notqid)
            );
        }
        
        $item = $m -> limit($Page->firstRow.','. $Page->listRows)->order('reorder desc,id desc')-> where($where)->select();        
        
        //添加广告参数调用
        if(isset($_GET['aid']) && !empty($_GET['aid'])){
            for($i=count($aditem)-1,$j=0;$i>=$j;$i--){
                array_unshift($item, $aditem[$i]);
                array_pop($item);
            }
        }
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
        $Page   = new Page($count, 15);
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
        $protocol = ($_SERVER["HTTP_X_FORWARDED_PROTO"]=='https') ? 'https://' : 'http://';

        if($questionId){
            $qid=$questionId;
            $this->assign('processTag',$processTag);
        }
        
    	$language = $this -> _getLanguage();   
        $languageTp = replaceLanguage($language);

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

        if($qitem == NULL){
            header("Location: ".$protocol.$_SERVER['HTTP_HOST']."/Public/404/index.html");
            die();
        }
        
        if($_GET['tag']=='share'){
            $qitem['title']=$qitem['content'];
        }else{
            $qitem['title']=$qitem['content'].' - '.$languageTp['index_title'];
        }
        
		$ogimage = $protocol.$_SERVER['HTTP_HOST'].C('IMAGEQ_PATH').'/'.$qitem['bgpic'];
        $pic=$_GET['pic'];
        if($pic){
            $_path=str_replace('-', '/', $pic);
            $ogimage=$protocol.$_SERVER['HTTP_HOST'].'/Uploads/image/'.$_path;
        }
        
        $this -> assign('ogimage',$ogimage);     
        $this -> assign('qid', $qid);
        $this -> assign('language', $language);
        $this -> assign('languageTp',$languageTp);
        $this -> assign('item', $item);
        $this -> assign('qitem', $qitem);
        $this -> display('Index:question');
    }
	
	private function _getLanguage(){
        if(isset($_POST['language']) && !empty($_POST['language'])){
            $language = $_POST['language'];
            $protocol = ($_SERVER["HTTP_X_FORWARDED_PROTO"]=='https') ? 'https://' : 'http://';
            $url = $protocol.$language.".mytests.co";
            //$qid = $_POST['id'];
            //$url =  $protocol.$language.".mytests.co/question/id/".$qid;
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