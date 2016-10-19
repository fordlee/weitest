<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    //构造函数
    public function __construct() {
        parent::__construct();
        $utm=$_GET['utm'];
		$version=$_GET['v'];
		if(rand(1,100)<=40){
			$version=1;
		}
		
		$_v=$version?'&v='.$version:'';
		
		$utm=$utm?'?utm='.$utm.$_v:'';
		$_utm=$utm?'&utm='.$utm.$_v:'';
		
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

        if($_GET['v'] == 1||$language =='zh'){
            import("ORG.Util.MyNewPage");
        }else{
            import("ORG.Util.MyPage");//导入自定义分页类
        }
		
		$num=15;
		if($_GET['v']==1||$language =='zh'){
			$num=16;
		}
		
        $Page   = new Page($count, $num);
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
            $where = array(
                'status' => 1,
                'language' => $language,
                'id' => array('not in',$notqid)
            );
        }
        
        $item = $m -> limit($Page->firstRow.','. $Page->listRows)->order('reorder desc,id desc')-> where($where)->select();
		
        //重新排序,第一页2,4排推荐题目
        if(!isset($_GET['p']) || $_GET['p'] == 1){
            $secondRow = array_slice($item,0,3);
            $fourthRow = array_slice($item,3,3);
            $firstRow  = array_slice($item,6,3);
            $thirdRow  = array_slice($item,9,3);
            for($i=1,$j=count($item)/3;$i<$j;$i++) {
                if($i==2){
                    array_splice($item,0,3,$firstRow);
                    array_splice($item,3,3,$secondRow);
                }
                if($i==4){
                    array_splice($item,6,3,$thirdRow);
                    array_splice($item,9,3,$fourthRow);
                }
            }
        }
        
        //添加广告参数调用
        if(isset($_GET['aid']) && !empty($_GET['aid'])){
            for($i=count($aditem)-1,$j=0;$i>=$j;$i--){
                array_unshift($item, $aditem[$i]);
				array_pop($item);
            }
        }
        $page = $Page->show();

        $category = $this -> _getCategory();
        
        $this -> assign('page',$page);
        $this -> assign('language', $language);
		$languageTp = replaceLanguage($language);
        $this -> assign('languageTp',$languageTp);
        $this -> assign('item', $item);
        $this -> assign('category', $category);
		
		if($_GET['v']==1||$language=='zh'){
			$this -> display('New:index');
		}else{
			$this -> display();
		}
    }

    public function next(){
        $language = $this -> _getLanguage();
        $m = D('QuestionView');
        $where = array(
            'status' => 1,
            'language' => $language
        );

        $count = $m -> where($where) -> count();
        if($_GET['v'] == 1||$language =='zh'){
            import("ORG.Util.MyNewPage");
        }else{
            import("ORG.Util.MyPage");//导入自定义分页类
        }
		
		$num=15;
		if($_GET['v']==1||$language =='zh'){
			$num=16;
		}
        $Page   = new Page($count, $num);
        $item   = $m -> limit($Page->firstRow. ',' . $Page->listRows)-> where($where)->order('reorder desc,id desc')->select();       
        $page = $Page->show();
        $category = $this -> _getCategory();

        $this -> assign('page',$page);
        $this -> assign('language', $language);
		$languageTp = replaceLanguage($language);
        $this -> assign('languageTp',$languageTp);
        $this -> assign('item', $item);
        $this -> assign('category', $category);
        $this -> display('index');
    }

    private function _getCategory(){
        $m_c = M('category');
        $category = $m_c -> where(array("category_status" => 1)) -> select();

        return $category;
    }

	public function questions(){
		$this->question();
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
		
		$tokens=base64_decode($_GET['tokens']);
		$tokenArr=explode('|',$tokens);	
		if($tokenArr[0]){
			$pic=$tokenArr[0];
		}
		
        if($pic){
            $_path=str_replace('-', '/', $pic);
            $ogimage=$protocol.$_SERVER['HTTP_HOST'].'/Uploads/image/'.$_path;
        }
        
		if($processTag=='result'){
			//$this -> assign('path',$ogimage);
		}else{
		}
		$this -> assign('ogimage',$ogimage);     
		
        $this -> assign('qid', $qid);
        $this -> assign('language', $language);
        $this -> assign('languageTp',$languageTp);
        $this -> assign('item', $item);
        $this -> assign('qitem', $qitem);

        //做题类型题目
        if($qitem['isTests'] == 1){
            $this->assign('isTests',1);
            $this->getTestsData($qitem);
        }

		if($_GET['v']==1||$language=='zh'){
			if($processTag=='result'){
				$this -> display('New:result');
			}else{
				$this -> display('New:question');
			}
		}else{
			$this -> display('Index:question');
		}
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

    private function getTestsData($qitem){
        //$testOptions=file_get_contents(UPLOADS_PATH.'/dati.json');
        $OptionsArr = $this -> _getAitemData($qitem);
        
        if($OptionsArr[0]['type'] == "question"){
            $Options = $OptionsArr[0];
            foreach ($Options as $k1 => $v1) {
                if($k1 == 'questionlist'){
                    foreach ($v1 as $k2 => $v2) {
                        if($v2['image']){
                            $Options[$k1][$k2]['image'] = '/Uploads/local/'.$v2['image'];
                        } 
                    }
                }
            }
        }
        //var_dump($Options);
        $resultList=$Options['resultlist'];
        foreach ($Options['resultlist'] as $key => $value) {
            $Options['resultlist'][$key][0]="--";
            $Options['resultlist'][$key][2]="--";
        }

        //echo json_encode($Options);die();
        $this->assign('testOptions',json_encode($Options));
    }

    private function _getAitemData($qitem){
        $where = array(
                'qdid' => $qitem['qdid'],
                'qid'  => $qitem['qid']
        );
        $m_a = M('answer');
        $aitem = $m_a -> where($where) -> select();
        //随机获取答案
        $randnum = mt_rand(0,count($aitem)-1);
        $optionresult = $aitem[$randnum]['optionresult'];
        $data = json_decode($aitem[$randnum]['optionset'],true);

        return $data;
    }
    
    public function album(){
        $language = $this -> _getLanguage();   
        $languageTp = replaceLanguage($language);
		
        $m = D('QuestionView');
        $where = array(
            'status' => 1,
            'language' => $language
        );
        
        $item = $m -> order('reorder desc,id desc') -> where($where) -> limit(0,8) -> select();
        shuffle($item);
		
		$this -> assign('language',$language);
		$this -> assign('languageTp',$languageTp);
        $this -> assign('item', $item);
        $this -> display('Index:album');
    }	
	
	
}