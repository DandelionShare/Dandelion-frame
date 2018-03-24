<?php
/**
 * Created by PhpStorm.
 * User: DandelionShare
 * Date: 2018/3/22
 * Time: 17:19
 */

namespace dandelion\model;

use PDO;
use Exception;
class Base
{
	private static $pdo=null;
	private $table;
	private $where=null;
	private $order;
	private $limit;
	private $field=' * ';
public function __construct ($systemmodel)
{
	//调用
	self::conn ();
	$this->table = strtolower ( ltrim ( strrchr ( $systemmodel , '\\' ) , '\\' ) );

}
public function having($having=null){
	$this->having = is_null ($having)?'':' having '.$having;
	return $this;
}

	/**
	 * @param $group分组条件
	 *
	 * @return $this
	 */
public function group($group=null){
	$this->group = is_null ($group)?'':' group by '.$group;
	return $this;
}

public function limit($num=null){
	$this->limit = is_null ($num)?'':' limit '.$num;

	return $this;
}
	/**
	 * @param null $order用户定义的排序方式
	 *
	 * @return $this 链式操作每节必须是个对象
	 */
public function order($order=null){
	$this->order = is_null ($order)?'':' order by '.$order;
	return $this;
}
	/**
	 * @param null $where条件
	 *
	 * @return $this需要返回一个对象
	 */
public function where($where=null){
	$this->where = is_null ($where)?'':' where '.$where;
	return $this;
}
	/**
	 * 获取指定列数据
	 */
	public function field($field){
		$this->field = $field;
		return $this;
	}
	/**
	 * 根据条件查找一条数据
	 */
	public function first(){
		$sql = "select {$this->field} from {$this->table}{$this->where}{$this->order}{$this->limit}" ;
		return current ($this->query ( $sql ));
	}

	/**
	 * 写入数据
	 */
	public function insert($data){
		$fields = '';$values = '';
		foreach($data as $k=>$v){
			$fields .= $k .',';
			$values .= is_int ($v) ? $v.',' : "'$v'".',';
		}
		$fields = rtrim ($fields,',');
		$values = rtrim ($values,',');
		$sql = "insert into {$this->table} ({$fields}) values ({$values})";
		return $this->exec ($sql);
	}

	/**
	 * 数据更新
	 * @param $data		更新数据
	 *
	 * @return bool|int
	 * @throws Exception
	 */
	public function update($data){
		if(is_null ($this->where)){
			return false;
		}
		$fields = '';
		foreach($data as $k=>$v){
			$fields .= $k . '=' . (is_int ($v)?$v:"'$v'") . ',';
		}
		$fields = rtrim ($fields,',');
		$sql = "update {$this->table} set {$fields}{$this->where}";
		return $this->exec ($sql);
	}

	/**
	 * 数据删除
	 * @return bool|int
	 * @throws Exception
	 */
	public function delete(){
		if(is_null ($this->where)){
			return false;
		}
		$sql = "delete from {$this->table}{$this->where}";
		return $this->exec ($sql);
	}
	/**
	 * 获取所有数据
	 */
	public function get ()
	{
		$sql = "select {$this->field} from {$this->table}{$this->where}{$this->order}{$this->limit}" ;
		return $this->query ( $sql );
	}



/*
 * 查找表中的主键
 */
public function getPriField(){
		//主要空白，严格按照命令行的格式，不能将两个相邻的单词写在一起了
		$res = $this->query ('desc ' . $this->table);
		//将得到的数组进行遍历，有几条数据将得到几个数组重新组合的数组
		foreach ($res as $v){
			//存在Key时且值为PRI证明其为主键
			if($v['Key'] == 'PRI'){
				//将主键的字段返回出去
				return $v['Field'];
			}
		}
	}


public function find($primary){
	//获取主键字段
	$priField = $this->getPriField();
	//拼接查询语句
	$sql = "select * from " . $this->table . ' where '.$priField.'=' . $primary;
	//返回主键值为$primary的信息
	return current ($this->query ( $sql ));
}

/*
 * 有结果集处理方法
 */
public function query($sql){
		//echo 11;//测试用户名写错能够看到详细的报错
	try{
		$rows = self::$pdo->query ($sql);
		return $rows->fetchAll (PDO::FETCH_ASSOC);
	}catch (Exception $e){
		//die($e->getMessage ());//对比报错信息
		throw new Exception($e->getMessage ());
	}
}

/*
 * 无结果集的处理
 */
public function exec($sql){
	try{
		return self::$pdo->exec ($sql);
	}catch (Exception $e){
		//die($e->getMessage ());//对比报错的信息
		throw new Exception($e->getMessage ());

	}
}

/*
 * 数据库的链接方法
 */
public static function conn(){
	if (is_null (self::$pdo)){
		try{
			//连接数据库
			$dsn = 'mysql:host='.c ("database.host").';dbname='.c ("database.db_name");
			self::$pdo = new PDO($dsn,c ("database.db_user"),c ("database.db_pass"));
			//设置字符集
			//set character set connection =gbk,
			//character_set_result = gbk,
			//character_set_client = binary;
			//self::exec ('set names utf8');
			self::$pdo->query ('set character set connection=gbk,character_set_result=gbk,character_set_client=binary');
			//设置报错属性
			self::$pdo->setAttribute (PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		}catch (Exception $e){
			//抛出详细的错误，和框架的运行机制
			throw new Exception($e->getMessage ());
		}
	}
}
}