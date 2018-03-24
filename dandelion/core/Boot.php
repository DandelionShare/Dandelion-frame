<?php
/**
 * Created by PhpStorm.
 * User: DandelionShare
 * Date: 2018/3/21
 * Time: 14:04
 */

namespace dandelion\core;

/*
 * 框架启动类
 */
//use app\admin\controller\ActicleController;
//use app\admin\controller\IndexController;

class Boot
{
	public static function run ()
	{
		//错误提示
		self::mistake ();
		//测试是否运行到此处
		//echo 111;
		//测试是否加载到助手函数库
		//dd (111);
		//初始化框架
		self::init ();
		//执行应用模块
		self::runApp ();
	}


	/*
	 *初始化框架,其中设置的有(头部,时区,开启session)
	 */
	private static function init ()
	{
		//测试是否使用该方法
		//dd (1);
		//设置头部
		header ( 'content-type:text/html;charset=utf8' );
		//设置时区,已在配置项中配置可以通过改配置项来实现时区的设置
		date_default_timezone_set ( c ("time.time") );
		//开启session
		session_id () || session_start ();
	}

	/*
   * 执行应用模块
   */
	private static function runApp ()
	{
		//测试，是否可以实例化
		//(new ArticleController())->index ();
		//( new IndexController() )->index ();
		//将上面的实例化进行优化
			if(isset($_GET['s'])){
				//接收get参数
				$s = $_GET['s'];
				//测试
				//dd ($s);die;//admin/index/index
				$arr = explode ('/',$s);
				$m = $arr[0];
				$c = $arr[1];
				$a = $arr[2];
			}else{
				//默认访问页面
				$m = 'home';
				$c = 'index';
				$a = 'index';
			}
			//将上面控制访问文件的参数定义成全局的常量
			define ('MODULE',$m);
			define ('CONTROLLER',$c);
			define ('ACTION',$a);
		$controller = 'app\\'.$m.'\controller\\'.ucfirst ($c).'Controller';
		//实例化调用
			echo call_user_func_array ([new $controller,$a],[]);
	}

	/**
	 * 错误提示whoops
	 */
	public static function mistake(){
		$whoops = new \Whoops\Run;
		$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
		$whoops->register();
	}


}
