<?php

class Router{

	protected static $_instance=NULL;

	public static function getInstance(){
		if(self::$_instance==NULL){
			self::$_instance=new Router();
			return self::$_instance;
		}
		else{
			return self::$_instance;
		}
	}

	public function __construct(){

		if(isset($_GET['url'])){
			$url=rtrim($_GET['url'],'/');
			$url=explode('/',$url);
			$file="controllers".DS.$url[0].".php";
			if(file_exists($file)){
			require_once($file);
			$controller=new $url[0];
			if(isset($url[1])){
				$controller->$url[1]();
				
			}
			if(isset($url[2])){
				$controller->$url[1]($url[2]);
			}
		}
		else{
			require_once('controllers'.DS.'error.php');
			$controller = new Error();
			return false;

		}
		}
		if(empty($url[0])){
	require_once('controllers'.DS.'index.php');
	$controller = new Index();
}

	}
}