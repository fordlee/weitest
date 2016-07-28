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
        
        $this -> assign('p', $p);
        $this -> assign('page', $page);
        $this -> assign('list', $list);
        $this -> display();
    }

    public function questionentry(){
        
        $this -> display('questionentry');
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

        //$data = $_POST;
        //$generalset = $this -> _getGeneralSet($data);
        //$generalsetjson = json_encode($generalset);
        $generalsetjson = '';

        $icon = $info[0]['savename'];
        $bgpic = $info[1]['savename'];

        $item = array(
            'qcode' => $qcode,
            'icon'  => $icon,
            'bgpic' => $bgpic,
            'generalset' => $generalsetjson,
            'status' => 0,
            'date' => date('Y-m-d')
        );
        
        $m_q = M('question');
        $ret = $m_q -> add($item);
        
        if($ret != false){
            $this -> success('添加成功！','Question/questionlist');
            //$this -> success('添加成功！');
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

        //$data = $_POST;
        //$generalset = $this -> _getGeneralSet($data);
        //$generalsetjson = json_encode($generalset);
        $generalsetjson = '';

        $icon = $info[0]['savename'];
        $bgpic = $info[1]['savename'];

        $item = array(
            'qcode' => $qcode,
            'icon'  => $icon,
            'bgpic' => $bgpic,
            'generalset' => $generalsetjson
        );
        
        $m_q = M('question');
        $ret = $m_q -> where(array('qcode' => $qcode)) -> save($item);
        
        if($ret != false){
            $this -> success('添加成功！','Question/questionlist');
        }else{
            $this -> error('添加失败！');
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

    private function _getGeneralSet($data){
        $minechecked = $data['mine'];
        $friend1checked = $data['friend1'];
        $friend2checked = $data['friend2'];
        $friend3checked = $data['friend3'];
        $friend4checked = $data['friend4'];

        $generalset = array();
        if($minechecked == 'on'){
            $mine = array(
                'portraitLocal' => $data['mineportraitLocal'],
                'portraitSize'  => $data['mineportraitSize'],
                'rel'           => $data['relmine'],
                'nameLocal'     => $data['minenameLocal'],
                'namesize'      => $data['minenamesize']
            );

            $generalset['mine'] = $mine;
        }

        if($friend1checked == 'on'){
            $friend1 = array(
                'portraitLocal' => $data['friend1portraitLocal'],
                'portraitSize'  => $data['friend1portraitSize'],
                'rel'           => $data['relfriend1'],
                'nameLocal'     => $data['friend1nameLocal'],
                'namesize'      => $data['friend1namesize']
            );

            $generalset['friend1'] = $friend1;
        }

        if($friend2checked == 'on'){
            $friend2 = array(
                'portraitLocal' => $data['friend2portraitLocal'],
                'portraitSize'  => $data['friend2portraitSize'],
                'rel'           => $data['relfriend2'],
                'nameLocal'     => $data['friend2nameLocal'],
                'namesize'      => $data['friend2namesize']
            );

            $generalset['friend2'] = $friend2;
        }

        if($friend3checked == 'on'){
            $friend3 = array(
                'portraitLocal' => $data['friend3portraitLocal'],
                'portraitSize'  => $data['friend3portraitSize'],
                'rel'           => $data['relfriend3'],
                'nameLocal'     => $data['friend3nameLocal'],
                'namesize'      => $data['friend3namesize']
            );

            $generalset['friend3'] = $friend3;
        }

        if($friend4checked == 'on'){
            $friend4 = array(
                'portraitLocal' => $data['friend4portraitLocal'],
                'portraitSize'  => $data['friend4portraitSize'],
                'rel'           => $data['relfriend4'],
                'nameLocal'     => $data['friend4nameLocal'],
                'namesize'      => $data['friend4namesize']
            );

            $generalset['friend4'] = $friend4;
        }

        return $generalset;
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
        $qitem = $m_q_d -> where(array("qid" => $qid)) -> select();

        $this -> assign('p',$p);
        $this -> assign('qitem',$qitem);
        
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

            if($ret){
                $newpage = $page+1;
                $this -> success('第'.$page.'次删除成功！',U('Question/delqid').'/qid/'.$qid.'/page/'.$newpage);
            }else{
                $this -> error('此题不存在或已删除！',U('Question/questionlist'));
            }
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

}