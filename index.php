<?php

/**
 * 入口文件.
 *
 * 项目入口，调用MessageReceive类
 * 
 * 
 * @author     Tairy <tairyguo@gmail.com>
 * @copyright  2014 Tairys
 * @version    0.0.1
 */

/**
	* __autoload 函数自动加载代码中出现的类名对应的文件s
	*
	*
	* @param $classname
	*
	*
	*/
function __autoload($classname){
	require_once($classname."Class.php");
}

/*
* 调用MessageReceive类
*/
$message = new MessageReceive();
$message -> main();
?>