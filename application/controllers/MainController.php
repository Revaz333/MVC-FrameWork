<?php 
namespace application\controllers;
use application\core\Controller;
//use application\lib\Db;



class MainController extends Controller{

	public function indexAction(){
		/*$db = new Db;
		$form = '3: DELETE FROM users';
		$params = [
			'id'=> $form,
	];
 $data = $db->column('SELECT name  FROM users WHERE id =:id', $params);*/
$result = $this->model->getNews();
$vars = [
'news' => $result,
];

		$this->view->render("Main page", $vars);
	}

	
}