<?php
// 本类由系统自动生成，仅供测试用途
class AjaxAction extends Action {
    //获取个人信息
	public function getProfile(){
		$info = $this -> _getInfoArray();
		$user_profile = json_encode($info['user_profile']);

        echo $user_profile;
	}

    //获取好友列表
    public function getAllFriends(){
        $info = $this -> _getInfoArray();
        $allFriends = json_encode($info['allFriends']);

        echo $allFriends;
    }

    //获取个人相册Id
    public function getAlbumsId(){
        $info = $this -> _getInfoArray();

        $albums = $info['user_albums']['albums'];
        foreach ($albums as $k => $v) {
            $albumsId[] = $v['id'];
        }

        echo json_encode($albumsId);   
    }

    //获取个人相册图片Id
	public function getPhotosId(){
        $albumsId = $_GET['albumsId'];
        $info = $this -> _getInfoArray();

        $albums = $info['user_albums']['albums'];
        foreach ($albums as $k => $v) {
            if($v['id'] == $albumsId){
                $photos = $v['photos'];
                foreach ($photos as $k1 => $v1) {
                    $photosId[] = $v1['id'];
                }
            }
        }
        
        echo json_encode($photosId);
	}

    //获取个人相册图片
    public function getImages(){
        $albumsId = $_GET['albumsId'];
        $photosId = $_GET['photosId'];
        $info = $this -> _getInfoArray();

        $albums = $info['user_albums']['albums'];
        foreach ($albums as $k1 => $v1) {
            if($v1['id'] == $albumsId){
                $photos = $v1['photos'];
                foreach ($photos as $k2 => $v2) {
                    if($v2['id'] == $photosId){
                       $images = $v2['images'];
                    }
                }
            }
        }

        if(!empty($_GET['size']) && isset($_GET['size'])){
            $size = $_GET['size'];
            $images[0]['height'] > $image[0]['width']?$largesize=$images[0]['height']:$largesize=$images[0]['width'];
            $size>$largesize?$size=$largesize:$size=$size;
            foreach ($images as $k3 => $v3) {
                if((($v3['height'] >= $size - 50)&&($v3['height'] <= $size + 50))
                    || (($v3['width'] >= $size - 50)&&($v3['width'] <= $size + 50))){
                    $images = $v3['source'];
                    break;
                }
            }
        }
        
        if(is_array($images)){
            $images = $images[0]['source'];
        }

        echo $images;
    }

    //获取性取向
    public function getInterestedIn(){
        $info = $this -> _getInfoArray();

        $interested = $info['user_relationships']['interested_in'];

        echo json_encode($interested);
    }

    //获取个人感情状态(是否单身)
    public function getRelationshipstatus(){
        $info = $this -> _getInfoArray();

        $status = $info['user_relationships']['relationship_status'];

        echo $status;
    }

    //获取家庭成员Id
    public function getFMId(){
        $info = $this -> _getInfoArray();

        $families = $info['user_relationships']['family'];

        foreach ($families as $k => $v) {
            $familyMemberId[] = $v['id'];
        }

        echo json_encode($familyMemberId);
    }

    //获取家庭成员相册Id
    public function getFMAId(){
        $memberId = $_GET['memberId'];
        $info = $this -> _getInfoArray();

        $families = $info['user_relationships']['family'];
        foreach ($families as $k1 => $v1) {
            if($v1['id'] == $memberId){
                $albums = $v1['albums'];
                foreach ($albums as $k2 => $v2) {
                    $albumsId[] = $v2['id'];
                }
            }
        }

        echo json_encode($albumsId);
    }

    //获取家庭成员相册图片Id
    public function getFMPId(){
        $memberId = $_GET['memberId'];
        $albumsId = $_GET['albumsId'];
        $info = $this -> _getInfoArray();

        $families = $info['user_relationships']['family'];
        foreach ($families as $k1 => $v1) {
            if($v1['id'] == $memberId){
                $albums = $v1['albums'];
                foreach ($albums as $k2 => $v2) {
                    if($v2['id'] == $albumsId){
                        $photos = $v2['photos'];
                        foreach ($photos as $k3 => $v3) {
                           $photosId[] = $v3['id'];
                        }
                    }
                }
            }
        }

        echo json_encode($photosId);
    }

    //获取家庭成员相册图片
    public function getFMPImg(){
        $memberId = $_GET['memberId'];
        $albumsId = $_GET['albumsId'];
        $photosId = $_GET['photosId'];
        $info = $this -> _getInfoArray();

        $families = $info['user_relationships']['family'];
        foreach ($families as $k1 => $v1) {
            if($v1['id'] == $memberId){
                $albums = $v1['albums'];
                foreach ($albums as $k2 => $v2) {
                    if($v2['id'] == $albumsId){
                        $photos = $v2['photos'];
                        foreach ($photos as $k3 => $v3) {
                            if($v3['id'] == $photosId){
                                $images = $v3['images'];
                            }
                        }
                    }
                }
            }
        }

        if(!empty($_GET['size']) && isset($_GET['size'])){
            $size = $_GET['size'];
            $images[0]['height'] > $image[0]['width']?$largesize=$images[0]['height']:$largesize=$images[0]['width'];
            $size>$largesize?$size=$largesize:$size=$size;
            foreach ($images as $k3 => $v3) {
                if((($v3['height'] >= $size - 50)&&($v3['height'] <= $size + 50))
                    || (($v3['width'] >= $size - 50)&&($v3['width'] <= $size+ 50))){
                    $images = $v3['source'];
                    break;
                }
            }
        }

        if(is_array($images)){
            $images = $images[0]['source'];
        }

        echo $images;
    }

    //获取家庭成员信息
    public function getFMInfo(){
        $memberId = $_GET['memberId'];
        $info = $this -> _getInfoArray();

        $families = $info['user_relationships']['family'];
        foreach ($families as $k1 => $v1) {
            array_splice($v1, -2, 1);
            if($v1['id'] == $memberId){
                $familyMemberInfo = $v1;
            }
        }

        echo json_encode($familyMemberInfo);
    }

	private function _getInfoArray(){
        $uid =  $_SESSION['uid'];
        $foldername = substr($uid,-2);
        $infoFolder = UPLOADS_PATH.'/info/'.$foldername;

        //生成文件夹
        if(!is_dir($infoFolder)){
            mkdir($infoFolder,0777,true);
        }
        $filename = $infoFolder.'/'.$uid.'.json';

		$info = gzinflate(file_get_contents($filename));
		$info = json_decode($info,true);

        return $info;
    }

}
?>