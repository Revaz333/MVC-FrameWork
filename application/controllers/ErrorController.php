<?php 
namespace application\controllers;

use application\core\Controller;



class ErrorController extends Controller{

	public function error(){
		$this->view->render("error");
	}
}