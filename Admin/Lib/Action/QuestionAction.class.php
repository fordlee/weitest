<?php
// 本类由系统自动生成，仅供测试用途
class QuestionAction extends Action {
	public function __construct() {
        parent::__construct();
        $this->CheckmSession();
    }

    private function CheckmSession(){
        if(!isset($_SESSION['email'])&& !isset($_SESSION['login']) && $_SESSION['login'] !== true){
            $this -> error('抱歉!您还没有登录或登录超时，请重新登录！',U('Auth/login'));
        }
    }

    public function questionlist(){
        $m_q = M('question');
        
        $p = $this -> _getp();

        import("ORG.Util.Page");//导入分页类
        $count  = $m_q -> count();//计算总数
        $Page   = new Page($count, 5);
        $list   = $m_q -> limit($Page->firstRow. ',' . $Page->listRows)->order('reorder desc,id desc')-> field('id,reorder,qcode,status,date') -> select();
        $page = $Page->show();

        $m_q_d = M('question_detail');
        foreach ($list as $k => $v) {
            $ret = $m_q_d -> where(array('qid'=>$v['id'])) -> select();
            $list[$k]['qd'] = $ret;
        }

        $m_c = M('category');
        $categories = $m_c -> select();
        
        $this -> assign('p', $p);
        $this -> assign('page', $page);
        $this -> assign('list', $list);
        $this -> assign('categories', $categories);
        $this -> display();
    }

    public function categorysort(){
        $cid = $_GET['cid'];
        $m_q_c = M('question_category');
        $p = $this -> _getp();

        import("ORG.Util.Page");//导入分页类
        $count  = $m_q_c -> where(array('cid' => $cid)) -> count();//计算总数 

        $Page   = new Page($count, 5);
        $list = $m_q_c -> join('question on question.id = question_category.qid') 
                       -> limit($Page->firstRow. ',' . $Page->listRows)
                       -> order('reorder desc,id desc')
                       -> field('question.id,question.reorder,question.qcode,question.status,question.date')
                       -> where(array('question_category.cid' => $cid))
                       -> select();
        $page = $Page->show();

        $m_q_d = M('question_detail');
        foreach ($list as $k => $v) {
            $ret = $m_q_d -> where(array('qid'=>$v['id'])) -> select();
            $list[$k]['qd'] = $ret;
        }

        $m_c = M('category');
        $categories = $m_c -> select();
        
        $this -> assign('p', $p);
        $this -> assign('cid',$cid);
        $this -> assign('page', $page);
        $this -> assign('list', $list);
        $this -> assign('categories', $categories);

        $this -> display('questionlist');
    }

    public function getQuestionById(){
        $qid = $_POST['qid'];
        $m_q = M('question');
        $p = $this -> _getp();
        $list = $m_q -> order('reorder desc,id desc')
                       -> field('id,reorder,qcode,status,date')
                       -> where(array('id' => $qid))
                       -> select();

        $m_q_d = M('question_detail');
        foreach ($list as $k => $v) {
            $ret = $m_q_d -> where(array('qid'=>$v['id'])) -> select();
            $list[$k]['qd'] = $ret;
        }
        

        $m_c = M('category');
        $categories = $m_c -> select();
        
        $this -> assign('p', $p);
        $this -> assign('dateRange',$date);
        $this -> assign('list', $list);
        $this -> assign('categories', $categories);

        $this -> display('questionlist');
    }

    public function datesort(){
        $date = $_POST['date_range'];
        $dateRange = $this -> _getDateSwap($date);
        $p = $this -> _getp();

        $m_q = M('question');
        $dateW = array(
            'question.date' => array('between', array($dateRange['begin'], $dateRange['end']))
        );
        
        $list   = $m_q -> order('reorder desc,id desc')
                       -> field('id,reorder,qcode,status,date')
                       -> where($dateW)
                       -> select();

        $m_q_d = M('question_detail');
        foreach ($list as $k => $v) {
            $ret = $m_q_d -> where(array('qid'=>$v['id'])) -> select();
            $list[$k]['qd'] = $ret;
        }
        

        $m_c = M('category');
        $categories = $m_c -> select();
        
        $this -> assign('p', $p);
        $this -> assign('dateRange',$date);
        $this -> assign('list', $list);
        $this -> assign('categories', $categories);

        $this -> display('questionlist');

    }

    private function _getDateSwap($dateRange){
        if(is_array($dateRange)){
            //将数组时间转为字符串时间
            $dateRange['begin'] = date("m/d/Y",strtotime($dateRange['begin']));
            $dateRange['end'] = date("m/d/Y",strtotime($dateRange['end']));
            $dateRange = implode(' - ',$dateRange);
        }else{
            //将字符串03/01/2016 - 03/25/2016转为数组
            $date = explode(' - ', $dateRange);
            $dateRange = array();
            $dateRange['begin'] = date('Y-m-d',strtotime($date[0]));
            $dateRange['end'] = date('Y-m-d',strtotime($date[1]));
        }
        return $dateRange;
    }

    public function questionentry(){
        $profile = $this -> _getProfile();
        $this -> assign('profile',$profile);

        $this -> display('questionentry');
    }

    private function _getGeneralset($front){
        if($front){
            $generalset = array();
            $userdefault = $_POST['userdefault'];
            if($userdefault){
                $generalset['userdefault'] = array(
                    "default" => 1,
                    "num"     => "1"
                );
            }
            $userfriends = $_POST['userfriends'];
            if($userfriends){
                $generalset['userfriends'] = array(
                    "friends" => 1,
                    "num"     => $_POST['numfriends']
                );
            }
            $userphotoes = $_POST['userphotos'];
            if($userphotoes){
                $generalset['userphotos'] = array(
                    "photos" => 1,
                    "num"    => $_POST['numphotos']
                );
            }
            
            $generalset = json_encode($generalset);
        }else{
            $generalset = NULL;
        }

        return $generalset;
    }

    private function _getFront($front){
        $front ? $front = 1 : $front = 0;

        return $front;
    }

    private function _getFrontcontent($front){
        if($front){
            $frontcontent = $_POST['frontcontent'];
        }else{
            $frontcontent = NULL;
        }

        return $frontcontent;
    }

    public function questionentrysave(){
        
        import('ORG.Net.UploadFile');
        $upload = new UploadFile();
        $upload->maxSize  = 3145728;
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');
        $upload->uploadReplace = true;
        $upload->savePath = UPLOADS_PATH."/imgQ/";
        if(!$upload->upload()) {
            $this->error($upload->getErrorMsg());
        }else{
            $info =  $upload->getUploadFileInfo();
        }
        
        $qcode = $_POST['qcode'].'_'.uniqid();
        
        $front = $_POST['front'];
        $front = $this -> _getFront($front);
        $frontcontent = $this -> _getFrontcontent($front);
        $generalset = $this -> _getGeneralset($front);

        $gif = intval($_POST['gif']);

        $profile = $_POST['profile'];
        $profileStr=implode(',',$profile);

        $icon = $info[0]['savename'];
        $bgpic = $info[1]['savename'];

        $item = array(
            'qcode' => $qcode,
            'profileset'=> $profileStr,
            'icon'  => $icon,
            'bgpic' => $bgpic,
            'generalset' => $generalset,
            'frontcontent' => $frontcontent,
            'front' => $front,
            'gif' => $gif,
            'status' => 0,
            'date' => date('Y-m-d')
        );
        
        $m_q = M('question');
        $ret = $m_q -> add($item);
        
        if($ret != false){
            $this -> success('添加成功！','questionlist');
        }else{
            $this -> error('添加失败！');
        }
    }

    public function questionedit(){
        $m_q = M('question');
        $qcodes = $m_q -> field('qcode') -> select();

        $this -> assign('qcodes', $qcodes);
        $this -> display('questionentry');
    }

    public function questionentryedit(){

        import('ORG.Net.UploadFile');
        $upload = new UploadFile();
        $upload->maxSize  = 3145728;
        $upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');
        $upload->uploadReplace = true;
        $upload->savePath = UPLOADS_PATH."/imgQ/";
        if(!$upload->upload()) {
            $this->error($upload->getErrorMsg());
        }else{
            $info =  $upload->getUploadFileInfo();
        }
        
        $qcode = $_POST['qcode'];

        $front = $_POST['front'];
        $front = $this -> _getFront($front);
        $frontcontent = $this -> _getFrontcontent($front);
        $generalset = $this -> _getGeneralset($front);

        $gif = intval($_POST['gif']);

        $icon = $info[0]['savename'];
        $bgpic = $info[1]['savename'];
        
        $item = array(
            'qcode' => $qcode,
            'icon'  => $icon,
            'bgpic' => $bgpic,
            'generalset' => $generalset,
            'frontcontent' => $frontcontent,
            'front' => $front,
            'gif' => $gif
        );

        $m_q = M('question');
        $qitem = $m_q -> where(array('qcode' => $qcode)) -> find();
        if($qitem){
            $imgQ = UPLOADS_PATH."/imgQ/";
            unlink($imgQ.$qitem['icon']);
            unlink($imgQ.$qitem['bgpic']);
        }
        $ret = $m_q -> where(array('qcode' => $qcode)) -> save($item);
        
        if($ret != false){
            $this -> success('修改成功！','questionlist');
        }else{
            $this -> error('修改失败！');
        }
    }

    private function _getp(){
        if(isset($_GET['p']) && !empty($_GET['p'])){
            $p = $_GET['p'];
        }else{
            $p = 1;
        }

        return $p;
    }

    private function _getProfile(){
        $profile = file_get_contents(APP_PATH.'Conf/profile.json');
        $profile = json_decode($profile,true);

        return $profile;
    }

    public function addQuestion(){
        $p = $_POST['p'];
        if(isset($_POST['qid']) && !empty($_POST['qid'])
            && isset($_POST['languageset']) && !empty($_POST['languageset'])
            && isset($_POST['content']) && !empty($_POST['content'])){

            $item = array(
                'qid'      => $_POST['qid'],
                'language' => $_POST['languageset'],
                'content'  => $_POST['content']
            );

            $m_q_d = M('question_detail');
            $ret = $m_q_d -> where($item) -> find();
            if($ret == null){
                $m_q_d -> add($item);
                $this -> success('添加成功！','questionlist/p/'.$p);
            }else{
                $this -> error('请勿重复添加！','questionlist/p/'.$p);
            }
        }else{
            $this -> error('添加失败！','questionlist/p/'.$p);
        }
    }

    public function editQuestion(){
        $qid = $_GET['qid'];
        $p = $this -> _getp();

        $m_q_d = M('question_detail');
        $qditem = $m_q_d -> where(array("qid" => $qid)) -> select();

        $m_q = M('question');
        $item = $m_q -> where(array("id" => $qid)) -> find();       
        $selProfile = explode(',', $item['profileset']);
        $allProfile = $this -> _getProfile();
        $profile = $allProfile;
        foreach ($allProfile as $k => $v) {
            if(in_array($v['profile'], $selProfile)){
                $profile[$k]['default'] = 1;
            }else{
                $profile[$k]['default'] = 0;
            }
        }

        $this -> assign('p',$p);
        $this -> assign('qditem',$qditem);
        $this -> assign('profile',$profile);
        $this -> assign('qid', $item['id']);
        $this -> assign('front',$item['front']);
        $this -> assign('gif',$item['gif']);
        $this -> assign('frontcontent',$item['frontcontent']);
        $this -> assign('generalset',json_decode($item['generalset'],true));
        
        $this -> display('questionedit');
    }

    public function editquestionsave(){
        $qdid = $_POST['qdid'];
        $qid = $_POST['qid'];
        $p = $_POST['p'];
        $language = $_POST['language'];
        $content = $_POST['content'];

        $m_q_d = M('question_detail');
        $newItem = array(
            "id" => $qdid,
            "qid" => $qid,
            "language" => $language,
            "content" => $content
        );

        $ret = $m_q_d -> where($newItem) -> select();

        if($ret == null){
            $ret1 = $m_q_d -> where(array("id" => $qdid)) -> save($newItem);
            if($ret1 != false){
                $this -> success('修改成功！', 'questionlist/p/'.$p);
            }else{
                $this -> error('修改失败！');
            }
        }else{
            $this -> error('未修改内容！');
        }
    }

    public function editprofilesave(){
        $p = $_POST['p'];
        $qid = $_POST['qid'];
        $profile = $_POST['profile'];
        $profileStr=implode(',',$profile);

        $item = array(
            'profileset' => $profileStr
        );
        
        $m_q = M('question');
        $ret = $m_q -> where('id='.$qid) -> save($item);
        
        if($ret){
            $this -> success("修改成功！","questionlist/p/".$p);
        }else{
            $this -> error("修改失败！");
        }
    }

    public function editfrontsave(){
        $p = $_POST['p'];
        $qid = $_POST['qid'];

        $front = 1;
        $front = $this -> _getFront($front);
        $frontcontent = $this -> _getFrontcontent($front);
        $generalset = $this -> _getGeneralset($front);
        
        $item = array(
            'generalset' => $generalset,
            'frontcontent' => $frontcontent,
            'front' => $front
        );
        
        $m_q = M('question');
        $ret = $m_q -> where('id='.$qid) -> save($item);

        if($ret){
            $this -> success("修改成功！","questionlist/p/".$p);
        }else{
            $this -> error("修改失败！");
        }
    }

    //Gif图片生成设置
    public function setGif(){
        $qid = $_POST['qid'];
        $gif = $_POST['gif'];

        $m_q = M('question');
        if($gif == 1){
            $data = array(
                "id" => $qid,
                "gif"=> 1 
            );
        }else{
            $data = array(
                "id" => $qid,
                "gif"=> 0
            );
        }

        $ret = $m_q -> save($data);

        if($ret){
            echo 1;
        }else{
            echo 0;
        }
    }

    //Front设置修改
    public function setFront(){
        $qid = $_POST['qid'];
        $front = $_POST['front'];
        $m_q = M('question');
        if($front == 1){
            $generalset = '{"userdefault":{"default":1,"num":"1"},"userfriends":{"friends":1,"num":"3"},"userphotos":{"photos":1,"num":"10"}}';
            $data = array(
                "id" => $qid,
                "generalset" => $generalset,
                "front" => 1
            );
            $ret = $m_q -> save($data);
        }else{
            $data = array(
                "id" => $qid,
                "front" => 0
            );
            $ret = $m_q -> save($data);
        }

        if($ret){
            echo 1;
        }else{
            echo 0;
        }

    }

    public function setStatus(){
        $id = $_POST['qid'];
        $status = $_POST['status'];
        $p = $_POST['p'];

        $m_q = M('question');
        if($status == 1){
            $item = array(
                'id' => $id,
                'status' => 0
            );

            $ret = $m_q -> save($item);
            if(!$ret){
                $this -> error('设置失败！','questionlist/p/'.$p);
            }
        }else{
            $item = array(
                'id' => $id,
                'status' => 1
            );
        
            $ret = $m_q -> save($item);
            if(!$ret){
                $this -> error('设置失败！','questionlist/p/'.$p);
            }
        }

        $this -> success('设置成功！','questionlist/p/'.$p);
    }

    public function setReorder(){
        $id = $_POST['qid'];
        $reorder = $_POST['reorder'];
        $p = $_POST['p'];
        
        $m_q = M('question');
        $item = array(
            'id' => $id,
            'reorder' => $reorder
        );

        $ret = $m_q -> where('id='.$id) -> save($item);

        if($ret != false){
            $this -> success('设置成功！','questionlist/p/'.$p);
        }else{
            $this -> error('设置失败！','questionlist/p/'.$p);
        }

    }

    public function delpic(){
        $qid = $_POST['qid'];
        $uid = $_POST['uid'];

        if((isset($_POST['uid']) && !empty($_POST['uid']))&&
            (isset($_POST['qid']) && !empty($_POST['qid']))){
            $this -> redirect('/Question/deluid/uid/'.$uid.'/qid/'.$qid);
        }elseif(isset($_POST['uid']) && !empty($_POST['uid'])){
            $this -> redirect('/Question/deluid/uid/'.$uid);
        }elseif(isset($_POST['qid']) && !empty($_POST['qid'])){
            $this -> redirect('/Question/delqid/qid/'.$qid);
        }else{
            $this -> redirect('/Question/questionlist');
        }
    }

    public function delqid(){
        $filedir = IMAGE_PATH;
        $qid = $_GET['qid'];
        $page = isset($_GET['page'])?$_GET['page']:1;
        $foldersnames = scandir($filedir);
        $folders = array();
        foreach ($foldersnames as $name) {
            if($name!='.'&&$name!='..'){
                $folders[] = $filedir.'/'.$name;
            }
        }

        $isExistPage = $page<=ceil(count($folders)/5)?1:0;
        if($isExistPage){
            $i = ($page-1)*5;
            $j = $page*5;
            for($i,$j;$i<$j;$i++){
                $filesnames = scandir($folders[$i]);
                foreach ($filesnames as $k => $v) {
                    if($v!='.' && $v!='..'){
                        $arr = explode('_', $v);
                        $fileqid = $arr[1];
                        $files = $folders[$i].'/'.$v;
                        if($qid == $fileqid){
                            $ret = @unlink($files);
                        }
                    }
                }
            }

            $newpage = $page+1;
            $this -> success('第'.$page.'次删除成功！',U('Question/delqid').'/qid/'.$qid.'/page/'.$newpage);
        }else{
            $this -> success('全部删除成功！',U('question/questionlist'));
        }


    }

    public function deluid(){
        $uid = $_GET['uid'];
        $qid = $_GET['qid'];
        $dir = IMAGE_PATH;
        $folder = substr($uid,-2);
        $filedir = $dir.'/'.$folder;
        $filesnames = scandir($filedir);
        foreach ($filesnames as $name) {
            if($name!='.'&&$name!='..'){
                $arr = explode('_', $name);
                $fileuid = $arr[0];
                $fileqid = $arr[1];
                if(isset($uid) && isset($qid)){
                    if($uid == $fileuid && $qid == $fileqid){
                        $files = $filedir.'/'.$name;
                        $ret = @unlink($files);
                    }
                }else{
                    if($uid == $fileuid){
                        $files = $filedir.'/'.$name;
                        $ret = @unlink($files);
                    }
                }
            }
        }

        if($ret){
            $this -> success('删除成功！',U('Question/questionlist'));
        }else{
            $this -> error('此人不存在或已删除！',U('Question/questionlist'));
        }
    }

    public function categorysave(){
        $qids = $_POST['qids'];
        $cid = $_POST['cid'];

        $m_q_c = M('question_category');
        foreach ($qids as $k => $v) {
            $data = array(
                "qid" => $v,
                "cid" => $cid
            );
            $qcitem = $m_q_c -> where($data) -> find();
            if($qcitem == NULL){
                $ret = $m_q_c -> add($data);
            }
        }

        if($ret){
            echo 1;
        }else{
            echo 0;
        }
    }

    public function delCategoryQid(){
        $qids = $_POST['qids'];
        $cid = $_POST['cid'];

        $m_q_c = M('question_category');
        foreach ($qids as $k => $v) {
            $data = array(
                "qid" => $v,
                "cid" => $cid
            );
            $qcitem = $m_q_c -> where($data) -> find();
            if($qcitem !== NULL){
                $ret = $m_q_c -> where($data) -> delete();
            }
        }

        if($ret){
            echo 1;
        }else{
            echo 0;
        }
    }

    public function showCategory(){
        $m_c =M('category');
        $m_q_c = M('question_category');

        $categories = $m_c -> select();
        foreach ($categories as $k1 => $v1) {
            $qcitem = $m_q_c -> where(array('cid' => $v1['id'])) -> select();
            foreach ($qcitem as $k2 => $v2) {
                $qids[$k1][$k2] = $v2['qid'];
            }

            $categories[$k1]['qids'] = implode(',', $qids[$k1]);
        }

        //var_dump($categories);die();
        $this -> assign('categories', $categories);
        $this -> display();
    }

    public function addCategory(){
        $m_c = M('category');
        $category = $_POST['category'];
        $data['category_name'] = $category;
        $ret = $m_c -> add($data);
        if($ret){
            $this -> redirect('showCategory');
        }else{
            $this -> error('添加失败！','showCategory');
        }
    }

    public function categoryedit(){
        $cid = $_POST['cid'];
        $category_name = $_POST['category_name'];
        $oqids = $_POST['oqids'];
        $nqids = $_POST['nqids'];

        $m_c = M('category');
        $m_q_c = M('question_category');

        $ret1 = $m_c -> where(array('id' => $cid,'category_name' => $category_name)) -> find();
        if($ret1 == NULL){
            $ret = $m_c -> where(array('id' => $cid)) -> save(array('category_name' => $category_name));
        }

        $oarr = explode(',', $oqids);
        foreach ($oarr as $k => $v) {
            $qcids[] = $m_q_c -> where(array('cid' => $cid,'qid' => $v)) -> find();
        }

        $narr = explode(',', $nqids);
        if(count($oarr) <= count($narr)){
            foreach ($narr as $k => $v) {
                $ret2 = $m_q_c -> where(array('cid' => $cid,'qid' => $v)) -> find();
                if($ret2 == NULL){
                    $ret = $m_q_c -> where(array('id' => $qcids[$k]['id'],'cid' => $cid)) -> save(array('qid' => $v));
                    if($ret == false){
                        $data = array('qid' => $v,'cid' => $cid);
                        $ret = $m_q_c -> add($data);
                    }
                }
            }
        }

        if($ret){
            echo 1;
        }else{
            echo 0;
        }
        
    }

    public function categorydel(){
        $cid = $_POST['cid'];
        $category_name = $_POST['category_name'];
        $qids = $_POST['qids'];

        $m_c = M('category');
        $m_q_c = M('question_category');

        $ret = $m_c -> where(array('id' => $cid)) -> delete();

        $arr = explode(',', $qids);
        foreach ($arr as $k => $v) {
            $ret = $m_q_c -> where(array('cid' => $cid, 'qid' => $v)) -> delete();
        }

        if($ret){
            echo 1;
        }else{
            echo 0;
        }
    }

    public function setCategoryStatus(){
        $qids = $_POST['qids'];
        $cid = $_POST['cid'];
        $category_status = $_POST['category_status'];

        $m_q = M('question');
        $m_c = M('category');
        $arr = explode(',', $qids);
        
        foreach ($arr as $k => $v) {
            if($category_status == 0){
                $ret = $m_q -> where('id='.$v) -> save(array('status' => 1));
            }else{
                $ret = $m_q -> where('id='.$v) -> save(array('status' => 0));
            }
        }

        if($category_status == 0){
            $ret1 = $m_c -> where('id='.$cid) -> save(array('category_status' => 1));
        }else{
            $ret1 = $m_c -> where('id='.$cid) -> save(array('category_status' => 0));
        }

        if($ret1){
            $this -> redirect('showCategory');
        }else{
            $this -> error('设置失败！','showCategory');
        }
    }

    public function export(){
        $language = $_POST['languageset'];
        $_SESSION['lang'] = $language;
        $m_q_d = M('question_detail');
        $m_a = M('answer');
        
        $item = $m_q_d -> field('question_detail.qid,question_detail.content,answer.optionset') -> join('answer on answer.qdid = question_detail.id') -> order('question_detail.qid asc') -> where(array("language" => $language)) -> select();
        foreach ($item as $k => $v) {
            $optionset = json_decode($v['optionset'],true);
            foreach ($optionset as $k1 => $v1) {
                if($v1['type'] == "text"){
                    $_content = $v1['attribute']['content'];
                    if(preg_match('/{(.*)}/im', $_content, $arr)){
                        $text = $this -> _getTextContent($arr[1]);
                        $content = $content."\r\n".$text;
                    }else{
                        $content = $content."\r\n".$v1['attribute']['content'];
                    }
                }else{
                    $content = "{XXX}";
                }
                
                $item[$k]['optionset'] = $content;
            }
        }
        //var_dump($item);die();
        $this -> _generateExecl($item);
    }

    private function _getTextContent($param){
        $_param = explode('|', $param);
        foreach ($_param as $k => $v) {
            $textUrlArr = explode(',', $v);
        }
        $textUrl = $textUrlArr[1];
        $str = file_get_contents(UPLOADS_PATH.'/local/'.$textUrl);
        if($str){
            $arr = explode('|', $str);
            for ($i=0; $i < count($arr); $i++) { 
                $n = $i + 1;
                $arr[$i] = $n.'.'.$arr[$i]; 
            }
            $text = implode("\r\n", $arr);
        }else{
            $text = "<xxx>";
        }

        return $text;
    }

    private function _generateExecl($data){
        $language = $_SESSION['lang'];
        unset($_SESSION['lang']);
        
        //引入PHPExcel库文件（路径根据自己情况）
        include APP_PATH.'/phpexcel/PHPExcel.php';
        //创建对象
        $excel = new PHPExcel();
        //Excel表格式,这里简略写了8列
        $letter = array('A','B','C','D','E','F','F','G');
        //表头数组
        $tableheader = array('题号','题目','选项');
        //填充表头信息
        for($i = 0;$i < count($tableheader);$i++) {
            $excel->getActiveSheet()->setCellValue("$letter[$i]1","$tableheader[$i]");
        }
        
        //填充表格信息
        for ($i = 2;$i <= count($data) + 1;$i++) {
            $j = 0;
            foreach ($data[$i - 2] as $key=>$value) {
                $excel->getActiveSheet()->setCellValue("$letter[$j]$i","$value");
                $j++;
            }
        }
        
        //创建Excel输入对象
        $write = new PHPExcel_Writer_Excel5($excel);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control:must-revalidate, post-check=0, pre-check=0");
        header("Content-Type:application/force-download");
        header("Content-Type:application/vnd.ms-execl");
        header("Content-Type:application/octet-stream");
        header("Content-Type:application/download");;
        header('Content-Disposition:attachment;filename="'.$language.'.xls"');
        header("Content-Transfer-Encoding:binary");
        $write->save('php://output');
    }

}