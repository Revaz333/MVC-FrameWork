<?php

namespace application\lib;

use PDO;

class Db
{
	protected $db;

	public function __construct()
	{
		$config = require 'application/config/db.php';
		$this->db = new  PDO('mysql:host='.$config['host'].';port='.$config['port'].';dbname='.$config['name'].'', $config['user'], $config['password']);
	}

	public function query($sql, $params =[])
	{
		$stmt = $this->db->prepare($sql);
		$stmt->execute();

		return $stmt;
		
	}

	public function row($sql)
	{
		$result = $this->query($sql);

		return $result->fetchAll(PDO::FETCH_ASSOC);
	}
}