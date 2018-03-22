<?php
/**
 * Created by PhpStorm.
 * User: DandelionShare
 * Date: 2018/3/22
 * Time: 14:49
 */
namespace dandelion\core;
class Controller{
	//这里需要一个地址
	private $url;
	//测试方法
 //public function index(){
 //	echo "我是controller类中的index0";
 //}
	public function message($message=''){
			//echo "11";//测试能够输出
		include "./view/message.php";
		return $this;
	}
	public function setRedirect($url=''){
		//echo "111";//成功输出
		//跳转页面的时候要考虑是跳转到新的页面还是调回
		if ($url){
			//当有新页面地址传入时
			$this->url = $url;
		}else{
			//没有新的页面传入时
			$this->url = 'javascript:history.back()';
		}
			return $this;
	}
}