<?php  

namespace application\core;

class View
{
	public $path;
	public $layout = 'default';

	public function __construct($route)
	{
		$this->route = $route;
		$this->path = $route['controller'].'/'.$route['action'];
	}

	public function render($title, $vars = [])
	{
		ob_start();
		require 'application/views/'.$this->path.'.php';
		$content = ob_get_clean();
		require 'application/views/layouts/'.$this->layout.'.php';
	}

	public static function errorCode($code)
	{
		http_response_code($code);
		require 'application/views/error/'.$code.'.php';
		exit;
	}
}
