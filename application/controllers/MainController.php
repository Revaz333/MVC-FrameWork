<?php

namespace application\controllers;

use application\core\Controller;
use application\models\News;

class MainController extends Controller
{
	public function indexAction()
	{
		$this->view->render("Main page");
	}
}
