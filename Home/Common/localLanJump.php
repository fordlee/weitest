<?php
function getAcceptLan(){ 
    preg_match_all('/([a-z]+)[,;]/is', strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']), $matches);
    preg_match_all('/([a-z-]+)[,;]/is', strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE']), $matches1);
    $lanArr = $matches[1];
    
    $sepMatch=$matches1[1];
    if($sepMatch[0]){
        $sepLan=explode('-',$sepMatch[0]);
        if($sepLan[1])array_unshift($lanArr,$sepLan[1]);
    }

    $LANG=array('en','pt','zh','vi');

    $len=count($lanArr);
    for($i=0;$i<$len;$i++){
        $data=$lanArr[$i];
        if(in_array($data, $LANG)){
            $lan=$data;
            break;
        }
    }
    if(!$lan){
        $lan='en';
    }
    return $lan;
}

function autoGo(){
    $lan=getAcceptLan();
    $host=$_SERVER['HTTP_HOST'];
    $arr=explode('.', $host);
    $siteLan=$arr[0];

    if($siteLan!=$lan&&$lan!='en'&&!in_array($siteLan, array('en','pt','zh','vi'))){
        $utm=$_GET['utm'];
        $utm=$utm?'?utm='.$utm:'';
        header('Location:http://'.$lan.'.mytests.co'.$utm);
        exit;
    }
}

?>