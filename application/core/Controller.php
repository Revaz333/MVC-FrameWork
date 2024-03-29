<?php

namespace application\core;

use application\core\View;

abstract class Controller
{
	public $route;
	public $view;
	public $acl;

	public function __construct($route)
	{
		$this->route = $route;
		// $_SESSION['authorize']['id'] = 1;
		// debug($this->checkAcl());
		$this->view = new View($route);
	}

	public function checkAcl()
	{
		$this->acl  = require 'application/acl/'.$this->route['controller'].'.php';

		if ($this->isAcl('all'))
			return true;
		elseif (isset($_SESSION['authorize']['id']) and $this->isAcl('authorize'))
			return true;
		elseif (!isset($_SESSION['authorize']['id']) and $this->isAcl('guest'))
			return true;
		elseif (!isset($_SESSION['admin']) and $this->isAcl('admin'))
			return true;

		return false;
	}

	public function isAcl($key)
	{
		return in_array($this->route['action'], $this->acl[$key]);
	}
}