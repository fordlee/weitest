<?php
return array(
	//'配置项'=>'配置值'
	'DEFAULT_MODULE' => 'Index', //默认模块
	'LOAD_EXT_FILE'=>'age,pokemon,constellation,zhconverter',//载入自定义函数库
	//URL不区分大小写
    'URL_CASE_INSENSITIVE' => true,
	'DEFAULT_CHARSET' => 'utf-8', // 默认输出编码
	'APP_STATUS' => 'debug', //应用调试模式状态
	'TMPL_PARSE_STRING' => array (// 站点公共目录
				'__PUBLIC__' => __ROOT__ . '/Public'
	),

	//打开页面跟踪
    //'SHOW_PAGE_TRACE' => true,
	
	//数据库相关
	'DB_PREFIX' => '',
	'DB_DSN' => 'mysql://root:root@localhost:3306/weitest',//数据库配置
	//'DB_DSN' => 'mysql://thehotgames:weekmovie2013@mysqls.mytests.co:3306/mytests_co',//数据库配置
	'DB_CHARSET'=>'utf8',
	
	//限制伪静态后缀
	'URL_HTML_SUFFIX'=>'',
	'URL_ROUTER_ON'   => true, //开启路由
	'URL_ROUTE_RULES' => array( //定义路由规则
	),

	'FACEBOOK_APP_ID' => '1053226548106670',
	'FACEBOOK_APP_SECRET' => '58a9253409d0cd2be600135a14627d18',
	'IMAGEQ_PATH' => '/Uploads/imgQ',
	'IMAGEA_PATH' => '/Uploads/imgA',
	'LOG_RECORD' => true, // 开启日志记录    
	'LOG_RECORD_LEVEL' => array('EMERG','ALERT','CRIT','ERR')

	/*'TMPL_CACHE_ON' =>true, //是否开启模板编译缓存 
	'HTML_CACHE_ON'=>true, // 开启静态缓存	
	'HTML_PATH' => GROUP_NAME,//静态缓存文件目录，HTML_PATH可任意设置，此处设为当前项目下新建的html目录
    'HTML_FILE_SUFFIX'  =>  '.html', // 设置静态缓存后缀为.shtml
    'HTML_CACHE_RULES'=> array(
		'index:index'=>array('{$_SERVER.HTTP_HOST}_{:group}_{:module}_{:action}_{id}_{p}','172800'),
		//'index:question'=>array('{$_SERVER.HTTP_HOST}_{:group}_{:module}_{:action}_{id}','172800'),
		'result:analyze'=>array('{$_SERVER.HTTP_HOST}_{:group}_{:module}_{:action}_{id}','172800')
    )*/
);
?>