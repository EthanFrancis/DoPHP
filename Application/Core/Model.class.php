<?php
/**
 * @Author: Fang
 * @Date:   2016-01-06 21:51:31
 * @Last Modified by:   Fang
 * @Last Modified time: 2016-01-06 22:09:01
 */

include_once 'Application/Core/DbConn.class.php';

//所有模型的父类
class Model {
	public $tableName = NULL; //表名

	//查询多条记录，返回：二维数组
	public function select($where = NULL, $order = NULL, $limit = NULL) {
		$sql = "SELECT * FROM {$this->tableName}";
		if ($where != NULL) {
			$sql .= " WHERE {$where}";
		}
		if ($order != NULL) {
			$sql .= " ORDER BY {$order}";
		}
		if ($limit != NULL) {
			$sql .= " LIMIT {$limit}";
		}
		$conn = DbConn::getInstance();
		$result = $conn->fetchAll($sql);
		return $result;
	}
	//查询一条记录，返回：一维关联数组
	public function find($where = NULL) {
		$sql = "SELECT * FROM {$this->tableName}";
		if ($where != NULL) {
			$sql .= " WHERE {$where}";
		}
		$conn = DbConn::getInstance();
		$result = $conn->queryOne($sql);
		return $result;
	}
	//删除记录，返回：受影响的行数
	public function delete($where = NULL) {
		$sql = "DELETE FROM {$this->tableName}";
		if ($where != NULL) {
			$sql .= " WHERE {$where}";
		}
		$conn = DbConn::getInstance();
		$result = $conn->exec($sql);
		return $result;
	}
	//添加记录，返回：受影响的行数
	public function insert($data) {
		$str1 = "";
		$str2 = "";
		foreach ($data as $k => $v) {
			$str1 .= "{$k},";
			$str2 .= "'{$v}',";
		}
		$str1 = rtrim($str1, ",");
		$str2 = rtrim($str2, ",");
		$sql = "INSERT INTO {$this->tableName}({$str1}) VALUES({$str2})";
		$conn = DbConn::getInstance();
		$result = $conn->exec($sql);
		return $result;
	}
	//修改记录，返回：受影响的行数
	public function update($data, $where = NULL) {
		$str = "";
		foreach ($data as $k => $v) {
			$str .= "{$k}='{$v}',";
		}
		$str = rtrim($str, ",");
		$sql = "UPDATE {$this->tableName} SET {$str}";
		if ($where != NULL) {
			$sql .= " WHERE {$where}";
		}
		$conn = DbConn::getInstance();
		$result = $conn->exec($sql);
		return $result;
	}
	//分页查询，返回：二维数组
	public function limitPage($pageIndex, $pageSize = 20) {
		$start = ($pageIndex - 1) * $pageSize;
		$sql = "SELECT * FROM {$this->tableName} LIMIT {$start},{$pageSize}";
		$conn = DbConn::getInstance();
		$result = $conn->fetchAll($sql);
		return $result;
	}
	//count查询，返回：整数
	public function count($where = NULL) {
		$sql = "SELECT COUNT(*) FROM {$this->tableName}";
		if ($where != NULL) {
			$sql .= " where {$where}";
		}
		$conn = DbConn::getInstance();
		$result = $conn->fetch($sql);
		return $result[0];
	}
	//sum查询，返回：整数
	public function sum($fieldName, $where = NULL) {
		$sql = "SELECT SUM({$fieldName}) FROM {$this->tableName}";
		if ($where != NULL) {
			$sql .= " where {$where}";
		}
		$conn = DbConn::getInstance();
		$result = $conn->fetch($sql);
		return $result[0];
	}
	//avg查询，返回：整数
	public function avg($fieldName, $where = NULL) {
		$sql = "SELECT AVG({$fieldName}) FROM {$this->tableName}";
		if ($where != NULL) {
			$sql .= " WHERE {$where}";
		}
		$conn = DbConn::getInstance();
		$result = $conn->fetch($sql);
		return $result[0];
	}
	//max查询，返回：整数
	public function max($fieldName, $where = NULL) {
		$sql = "SELECT MAX({$fieldName}) FROM {$this->tableName}";
		if ($where != NULL) {
			$sql .= " WHERE {$where}";
		}
		$conn = DbConn::getInstance();
		$result = $conn->fetch($sql);
		return $result[0];
	}
	//min查询，返回：整数
	public function min($fieldName, $where = NULL) {
		$sql = "SELECT MIN({$fieldName}) FROM {$this->tableName}";
		if ($where != NULL) {
			$sql .= " WHERE {$where}";
		}
		$conn = DbConn::getInstance();
		$result = $conn->fetch($sql);
		return $result[0];
	}
	//执行select语句，返回：二维数组
	public function fetchAll($sql) {
		$conn = DbConn::getInstance();
		$result = $conn->fetchAll($sql);
		return $result;
	}
	//执行select语句，返回：一维关联数组
	public function fetch($sql) {
		$conn = DbConn::getInstance();
		$result = $conn->fetch($sql);
		return $result;
	}
	//执行insert、update、delete语句，返回：受影响的行数
	public function exec($sql) {
		$conn = DbConn::getInstance();
		$result = $conn->exec($sql);
		return $result;
	}
}
?>
