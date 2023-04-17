<?php
class TODO
{
	private $_db,
	$_data,
	$_count = 0,
	$_errors = array();

	public function __construct($user = null)
	{
		$this->_db = DB::getInstance();
	}

	# CREATE TODO
	public function insert_todo($fields = array())
	{
		if (!$this->_db->insert('todo', $fields)) 
			throw new Exception("There was a problem creating an account.");
	}

	# UPDATE TODO
	public function update_todo($fields = array(), $id = null)
	{
		if (!$this->_db->update('todo', $id, $fields)) 
			throw new Exception('There was a problem updating');
	}

	# DELETE TODO
	public function delete_todo($id = null)
	{
		if (!$this->_db->delete('todo', array('id', '=', $id))) 
			throw new Exception('There was a problem deleting');
	}

	# CHANGE STATUS TODO
	public function change_status_todo($fields = array(), $id = null)
	{
		if (!$this->_db->update('todo', $id, $fields)) 
			throw new Exception('There was a problem updating');
	}

	# Select
	public function select($sql = null, $params = array())
	{
		$data = $this->_db->query("SELECT* FROM `todo` {$sql}", $params);
		if ($data->count()) {
			$this->_count = $data->count();
			$this->_data = $data->results();
		}
	}

	# Select
	public function selectQuery($sql, $params = array())
	{
		$data = $this->_db->query($sql, $params);
		if ($data->count()) {
			$this->_count = $data->count();
			$this->_data = $data->results();
		}
	}


	public function exists()
	{
		return (!empty($this->_data)) ? true : false;
	}


	# DATA COLLECT
	public function data()
	{
		return $this->_data;
	}

	# first
	public function first()
	{
		$data = (array) $this->data();
		if (isset($data[0])) {
			return $data[0];
		}
		return '';
	}

	# DATA COUNT
	public function count()
	{
		return $this->_count;
	}

	# ERROR COLLECT
	public function errors()
	{
		return $this->_errors;
	}
}
?>
