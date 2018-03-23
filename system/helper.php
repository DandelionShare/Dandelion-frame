<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/8
 * Time: 11:50
 */
//打印函数
function dd($a){
	echo "<pre style='width: 100%;background: lightpink;border: 1px solid greenyellow;border-radius: 6px;font-size: 2rem;'>";
	if(is_bool ($a) || is_null ($a)){
		var_dump ($a);
	}else{
		print_r ($a);
	}
	echo "</pre>";
}
//判断是post请求方式还是get请求方式
define ("IS_POST",$_SERVER['REQUEST_METHOD']=='POST'?true:false);
//判断是否为合法的ajax请求
define ("IS_AJAX",isset($_SERVER['HTTP_X_REQUESTED_WITH'] ) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'?true:false);

/**
 * @param null $conf 用户自定义的配置项
 *配置文件config
 * @return array|mixed|null
 */
function c($conf=null){
	//当没穿参数时默认为加载所有配置项
	if (is_null ($conf)){
		//echo 111;//输出成功
		//1.我们首先先读取目录看其中有多少文件
		$files = glob ('../system/config/*');
		//dd ($data);//打印出他们的路径
		//创建一个数组用于存储文件中的数据(所有配置文件)
		$data = [];
		foreach ($files as $file){
			//dd ($file);打印
			$index = substr (basename ($file),0,strpos (basename ($file),'.'));
			//dd ($index);
			$data[$index] = include $file;
		}
		//dd ($data);
		return $data;
	}
	//对使用者所传参数进行处理
	$info = explode ('.',$conf);
	//dd ($info);die;
	if (count ($info) == 1){
		//dd ($info[0]);die();//database
		$file = "../system/config/".$conf.".php";
		//echo 111;
		//dd ( $file);
		return is_file ($file)?include $file:null;
	}
	if (count ($info)==2){
		//echo 222;
		$file="../system/config/".$info[0].".php";
		if (is_file ($file)){
			$data = include $file;
			//dd ($data[$info[1]]);die();//127.0.0.1
			return isset($info[1])?$data[$info[1]]:null;
		}
		return null;
	}
}
