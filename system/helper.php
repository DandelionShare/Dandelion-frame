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

