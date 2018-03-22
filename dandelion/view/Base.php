<?php
/**
 * Created by PhpStorm.
 * User: DandelionShare
 * Date: 2018/3/22
 * Time: 16:29
 */
namespace dandelion\view;
class Base{
	private $files;
	private $data=[];
	/*
	 * 加载模板方法
	 */
		public function make($path = ''){
			//dd (MODULE);//home
			//dd (CONTROLLER);//index
			//dd (ACTION);die();//index
			//当没有穿传参数默认走else分支
			if ($path){
				$this->files = '../app/'.MODULE.'/view/'.CONTROLLER.'/'.$path.'.php';
			}else{
				$this->files = '../app/'.MODULE.'/view/'.CONTROLLER.'/'.ACTION.'.php';
			}

			return $this;
		}
		/*
		 * 分配变量
		 */
		public function with($data = []){
			$this->data = $data;
			return $this;
		}
		public function __toString ()
		{
			//先分配变量
			extract ($this->data);
			//在加载模板保证变量在模板中能使用
			if (!is_null ($this->files)){
				//echo 11;
				include $this->files;
			}
			//tostring必须要return一个空字符串
			return '';
		}
}