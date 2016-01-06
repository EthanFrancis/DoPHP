<?php
/**
 * @Author: Fang
 * @Date:   2016-01-06 22:09:53
 * @Last Modified by:   Fang
 * @Last Modified time: 2016-01-06 22:11:52
 */

include_once 'Library/Smarty/Smarty.class.php';

//通过表名，返回：Model类的对象
function M($tableName = NULL) {
	include_once 'Application/Core/Model.class.php';
	$model = new Model();
	if ($tableName != NULL) {
		$model->tableName = $tableName;
	}
	return $model;
}
//通过模型名，返回：模型对象
function D($modelName) {
	include_once 'Application/Model/' . $modelName . '.php';
	$model = new $modelName();
	return $model;
}

//所有控制器的父类
class Controller {
	private $smarty = NULL;

	//初始化Smarty(在入口文件中实例化子类控制器对象，将调用该构造)
	public function __construct() {
		include 'Application/Configs/configs.php';
		$this->smarty = new Smarty();
		$this->smarty->caching = $config["smarty"]["caching"];
		$this->smarty->cache_lifetime = $config["smarty"]["cache_lifetime"];
		$this->smarty->left_delimiter = $config["smarty"]["left_delimiter"];
		$this->smarty->right_delimiter = $config["smarty"]["right_delimiter"];
		$this->smarty->setTemplateDir($config["smarty"]["template_dir"]);
		$this->smarty->setConfigDir($config["smarty"]["config_dir"]);
		$this->smarty->setCompileDir($config["smarty"]["compile_dir"]);
		$this->smarty->setCacheDir($config["smarty"]["cache_dir"]);
		$this->smarty->assign("APP", APP);
		$this->smarty->assign("ROOT", ROOT);
	}
	//显示系统提示信息页面
	public function reaction($message, $jumpUrl) {
		$this->smarty->assign("message", $message);
		$this->smarty->assign("jumpUrl", $jumpUrl);
		$this->smarty->display("reaction.html");
	}
	//页面的重定向
	public function redirect($url) {
		echo "<script type='text/javascript'>";
		echo "  window.location='{$url}';";
		echo "</script>";
	}
	//设置缓存
	public function setCache($caching, $cache_lifetime = 3600) {
		$this->smarty->caching = $caching;
		$this->smarty->cache_lifetime = $cache_lifetime;
	}
	//向html传递数据
	public function assign($key, $value) {
		$this->smarty->assign($key, $value);
	}
	//跳转到指定的html页面
	public function display($tpl, $cacheId = NULL) {
		if ($cacheId == NULL) {
			$this->smarty->display($tpl);
		} else {
			$this->smarty->display($tpl, $cacheId);
		}
	}
}
?>
