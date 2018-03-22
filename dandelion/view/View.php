<?php
/**
 * Created by PhpStorm.
 * User: DandelionShare
 * Date: 2018/3/22
 * Time: 16:20
 */
namespace dandelion\view;
class View{
	/*
	 * 测试方法
	 */
	//public function index(){
	//	echo 11;
	//}
	public function __call ( $name , $arguments )
	{
		return self::runParse ($name,$arguments);
	}
	public static function __callStatic ( $name , $arguments )
	{
		return self::runParse ($name,$arguments);
	}
	private static function runParse($name,$arguments){
			return call_user_func_array ([new Base(),$name],$arguments);
	}
}