<?php
/**
 * Created by PhpStorm.
 * User: DandelionShare
 * Date: 2018/3/21
 * Time: 15:02
 */

namespace app\home\controller;


use dandelion\core\Controller;
use dandelion\model\Model;
use dandelion\view\View;

class IndexController extends Controller
{
	public function index(){
		//dd (105);
		//1.测试;可以使用Controller类中的方法是继承过来了
		//parent::index ();
		//3.测试是否运行到V层的view
		//(new \dandelion\view\View())->index();//调用成功
		return View::make()->with();
		//4.封装数据库
		//$data = (new Model())->query('select * from tag');
		//dd ($data);
	}
	public function add(){
		//2.完善提示信息和跳转页面
		$this->setRedirect ()->message ('添加成功了');
		//$this->message ('添加成功')->setRedirect ('https://www.baidu.com');
	}
}