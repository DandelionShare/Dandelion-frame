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
public function __construct ()
{
	if (is_null (self::$pdo)){
		try{
			//连接数据库
			$dsn = 'mysql:host=127.0.0.1;dbname=homework';
			self::$pdo = new PDO($dsn,'root','root');
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
public function query($sql){
		//echo 11;//测试用户名写错能够看到详细的报错
	try{
		$rows = self::$pdo->query ($sql);
		return $rows->fetchAll (PDO::FETCH_ASSOC);
	}catch (Exception $e){
		die($e->getMessage ());
		throw new Exception($e->getMessage ());
	}
}
public function exec($sql){
	try{
		return self::$pdo->exec ($sql);
	}catch (Exception $e){
		die($e->getMessage ());
		throw new Exception($e->getMessage ());

	}
}
//public function query(){
//	echo 11;
//}
}