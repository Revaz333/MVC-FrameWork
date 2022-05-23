<?php

namespace application\core;

use application\lib\Db;

abstract class Model
{
	public $db;

	public function __construct()
	{
		$this->db = new Db;
	}

	public static function find($params = null, $operation = 'AND')
	{
		$self = new static;
		$model = lcfirst(basename(str_replace('\\', '/', get_called_class())));

		$sql = "SELECT * FROM $model ";
		if($params)
			$sql .= ' ' . self::buildWhere($params, $operation);

		return $self->db->row($sql);
	}

	public static function insert($params)
	{
		$self = new static;
		$model = lcfirst(basename(str_replace('\\', '/', get_called_class())));
		$counter = 1;

		$values = ' VALUES (';
		foreach($params as $val)
		{
			$values .= "'" . $val . "'";
			if(count($params) !== $counter)
				$values .= ',';
			$counter ++;
		}
		$values .= ')';

		$sql = "INSERT INTO $model "
			. '(' . implode(',', array_keys($params)) . ')' . $values;

		return boolval($self->db->query($sql));
	}

	public static function update($set, $params = null, $operation = 'AND')
	{
		$self = new static;
		$model = lcfirst(basename(str_replace('\\', '/', get_called_class())));
		$counter = 1;

		$values = ' SET ';
		foreach($set as $key => $val)
		{
			$values .= $key . '=' . "'" . $val . "'";
			if(count($set) !== $counter)
				$values .= ', ';
			$counter ++;
		}
		$values .= ' ';

		$sql = "UPDATE $model " . $values;
		if($params)
			$sql .= self::buildWhere($params, $operation);

		return boolval($self->db->query($sql));
	}

	public static function delete($params = null, $operation = 'AND')
	{
		$self = new static;
		$model = lcfirst(basename(str_replace('\\', '/', get_called_class())));

		$sql = "DELETE FROM $model ";
		if($params)
			$sql .= ' ' . self::buildWhere($params, $operation);

		return boolval($self->db->query($sql));
	}

	public static function buildWhere($params, $operation)
	{
		$where = 'WHERE ';
		$counter = 1;
		foreach($params as $key => $val)
		{
			$where .= $key . '=' . "'".$val."'";
			if(count($params) !== $counter)
				$where .= ' ' . $operation . ' ';
			$counter ++;
		}
		return $where;
	}
}