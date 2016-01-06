<?php
/**
 * @Author: Fang
 * @Date:   2016-01-06 21:40:14
 * @Last Modified by:   Fang
 * @Last Modified time: 2016-01-06 21:42:56
 */
//全局配置文件
$config = array(
	//网站的常规则配置信息
	"web" => array(
		"defaultController" => "Index",
		"defaultAction" => "index",
		"firstName" => "index.php",
		"urlModel" => 1,
		"urlSuffix" => ".html",
		"app" => "", //定义入口文件位置
		"root" => "", //定义项目根目录
	),

	//数据库配置信息
	"database" => array(
		"host" => "localhost",
		"user" => "root",
		"password" => "",
		"dbname" => "",
		"charset" => "utf8",
	),

	//Smarty配置信息
	"smarty" => array(
		"caching" => false,
		"cache_lifetime" => 3600,
		"left_delimiter" => "{",
		"right_delimiter" => "}",
		"template_dir" => "Application/View",
		"config_dir" => "Application/Configs",
		"cache_dir" => "Application/Runtime/cache",
		"compile_dir" => "Application/Runtime/templates_c",
	),
);
