<?php
/**
 * @Author: Fang
 * @Date:   2016-01-06 21:31:28
 * @Last Modified by:   Fang
 * @Last Modified time: 2016-01-06 22:10:27
 */
include_once 'Application/Core/Controller.php'; //所有控制器的父类
include_once 'Application/Core/Model.php'; //所有模型的父类
include 'Application/Configs/configs.php'; //全局配置文件

//定义两个全局的常量
define("APP", $config["web"]["app"]); //入口文件的地址
define("ROOT", $config["web"]["root"]); //项目名称(项目根目录)
// 定义URL的方式
$urlModel = $config["web"]["urlModel"];
//1：pathinfo模式,2：url传参
if ($urlModel == 1) {
	//   /app/index.php/Add/index.html
	$url = $_SERVER["REQUEST_URI"]; //当前url地址
	$url = str_replace($config["web"]["urlSuffix"], "", $url);
	$arr = explode("/", $url);
	$index = array_search($config["web"]["firstName"], $arr); //index.php的下标
	if ($index != NULL) {
		$c = $arr[$index + 1]; //控制器名
		$a = $arr[$index + 2]; //方法名
		//代表url中有参数
		if ($arr[$index + 3] != NULL) {
			//将url中的参数，存储到$_GET变量中
			for ($i = $index + 3; $i < count($arr); $i += 2) {
				$key = $arr[$i]; //参数名
				$value = $arr[$i + 1]; //参数值
				$_GET[$key] = $value; //将参数存入$_GET
			}
		}
	}
} else {
	$ctl = $_GET["ctl"]; //控制器名
	$act = $_GET["act"]; //方法名
}

//设置默认的控制器的方法
if ($c == NULL) {
	$c = $config["web"]["defaultController"];
	$a = $config["web"]["defaultAction"];
}

$ctl .= "Controller";
$act .= "Action";

include_once 'Application/Controller/' . $ctl . '.php';
$controller = new $ctl();
$controller->$act();
?>
