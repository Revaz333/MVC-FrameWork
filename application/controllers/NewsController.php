<?php

namespace application\controllers;

use application\core\Controller;
use application\models\News;

class NewsController extends Controller
{
	public function indexAction()
	{
		$this->view->render("News");
	}
}
