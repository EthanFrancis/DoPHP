<?php
/**
 * @Author: Fang
 * @Date:   2016-01-06 21:46:45
 * @Last Modified by:   Fang
 * @Last Modified time: 2016-01-06 22:04:19
 */
class DbConn {
	protected $_link;

	public function __construct($hostname, $dbname, $username, $passoword) {
		try {
			$this->_link = new PDO("mysql:host={$hostname};dbname={$dbname}", "{$username}", "{$passowrd}");
		} catch (PDOException $e) {
			die("Failed:" . $e->getMessage());
		}
	}

	//防止克隆
	private function __clone() {}
	//获得该类的对象(单例模式)
	public static function getInstance() {
		static $obj = NULL;
		if ($obj == NULL) {
			$obj = new DbConn();
		}
		return $obj;
	}
	//执行insert、update、delete语句，返回：受影响的行数
	public function exec($sql) {
		$stmt = $this->link->prepare($sql);
		$stmt->execute();
		return $stmt->rowCount();
	}
	//查询多条记录，返回值：二维数组
	public function fetchAll($sql, $result_type = PDO::FETCH_ASSOC) {
		$stmt = $this->_link->prepare($sql);
		$stmt->execute();
		if ($stmt->rowCount()) {
			return $stmt->fetchAll($result_type);
		}
		return FALSE;
	}
	//查询一条记录，返回：一维关联数组
	public function fetch($sql, $result_type = PDO::FETCH_ASSOC) {
		$stmt = $this->_link->prepare($sql);
		$stmt->execute();
		if ($stmt->rowCount()) {
			return $stmt->fetch($result_type);
		}
		return FALSE;
	}

	//关闭数据库
	public function __destruct() {
		unset($this->_link);
	}
}
