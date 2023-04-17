<?php
class TODO_CONTROLLER
{

	#todoS
	public static function record_todo()
	{
		$diagnoArray[0] = 'NO_ERRORS';
		$validate = new \Validate();
		$prfx = 'todo-';
		foreach ($_POST as $index => $val):
			$ar = explode($prfx, $index);
			if (count($ar)):
				$_SIGNUP[end($ar)] = $val;
			endif;
		endforeach;

		//validation
		$validation = $validate->check(
			$_SIGNUP,
			array(
				'title' => array(
					'name' => 'title',
					'required' => true
				),
				'description' => array(
					'name' => 'description',
					'required' => false
				),
				'due_date' => array(
					'name' => 'Due date',
					'required' => true
				)
			)
		);

		//if vwell validated
		if ($validation->passed()) {
			$todoTable = new \todo();
			$Str = new \Str();
			$_SIGNUP = (object) $_SIGNUP;

			$_title = $Str->data_in($_SIGNUP->title);
			$_description = $Str->data_in($_SIGNUP->description);
			$_due_date = $Str->data_in($_SIGNUP->due_date);

			$_status = 'ACTIVE';

			//fields
			$_fields = array(

				'title' => $_title,
				'description' => $_description,
				'due_date' => $_due_date,

				'status' => $_status,
			);

			if ($diagnoArray[0] == 'NO_ERRORS') {
				try {
					$todoTable->insert_todo($_fields);

				} catch (Exception $e) {
					$diagnoArray[0] = "ERRORS_FOUND";
					$diagnoArray[] = $e->getMessage();
				}
			}
		} else {
			$diagnoArray[0] = 'ERRORS_FOUND';
		}
		if ($diagnoArray[0] == 'ERRORS_FOUND') {
			return (object) [
				'ERRORS' => true,
				'SUCCESS' => false,
				'ERRORS_SCRIPT' => "Error " . implode(', ', $diagnoArray)
			];
		} else {
			return (object) [
				'ERRORS' => false,
				'SUCCESS' => true,
				'ERRORS_SCRIPT' => ""
			];
		}
	}

	public static function edit_todo()
	{
		$diagnoArray[0] = 'NO_ERRORS';
		$validate = new \Validate();
		$prfx = 'todo-';
		foreach ($_POST as $index => $val):
			$ar = explode($prfx, $index);
			if (count($ar)):
				$_SIGNUP[end($ar)] = $val;
			endif;
		endforeach;

		$validation = $validate->check(
			$_SIGNUP,
			array(
				'title' => array(
					'name' => 'title',
					'required' => true
				),
				'description' => array(
					'name' => 'description',
					'required' => false
				),
				'due_date' => array(
					'name' => 'Due date',
					'required' => true
				)
			)
		);

		if ($validation->passed()) {
			$Shiptodo = new \todo();
			$Str = new \Str();
			$_SIGNUP = (object) $_SIGNUP;

			$HASH = new \Hash;

			$_ID = $HASH->decryptAES($Str->data_in($_SIGNUP->_id_));

			$_title = $Str->data_in($_SIGNUP->title);
			$_description = $Str->data_in($_SIGNUP->description);
			$_due_date = $Str->data_in($_SIGNUP->due_date);

			$_status = 'ACTIVE';

			$_fields = array(

				'title' => $_title,
				'description' => $_description,
				'due_date' => $_due_date,

				'status' => $_status,
			);

			if ($diagnoArray[0] == 'NO_ERRORS') {
				try {
					$Shiptodo->update_todo($_fields, $_ID);
				} catch (Exception $e) {
					$diagnoArray[0] = "ERRORS_FOUND";
					$diagnoArray[] = $e->getMessage();
				}
			}
		} else {
			$diagnoArray[0] = 'ERRORS_FOUND';
			// $error_msg = ul_array($validation->errors());
		}
		if ($diagnoArray[0] == 'ERRORS_FOUND') {
			return (object) [
				'ERRORS' => true,
				'SUCCESS' => false,
				'ERRORS_SCRIPT' => $validate->getErrorLocation()
			];
		} else {
			return (object) [
				'ERRORS' => false,
				'SUCCESS' => true,
				'ERRORS_SCRIPT' => $validate->errors()
			];
		}
	}

	public static function delete_todo($_todo_ID)
	{
		$diagnoArray[0] = 'NO_ERRORS';
		$validate = new \Validate();
		$prfx = 'todo-';
		foreach ($_POST as $index => $val):
			$ar = explode($prfx, $index);
			if (count($ar)):
				$_SIGNUP[end($ar)] = $val;
			endif;
		endforeach;

		$validation = $validate->check(
			$_SIGNUP,
			array(
				'_id_' => array(
					'name' => 'todo id',
					'required' => true
				)
			)
		);

		if ($validation->passed()) {
			$Shiptodo = new \todo();
			$Str = new \Str();
			$_SIGNUP = (object) $_SIGNUP;
			$HASH = new \Hash();

			$_todo_ID = $HASH->decryptAES($Str->data_in($_SIGNUP->_id_));

			$_todo_data = self::getInfotodoByID($_todo_ID);
			if (!$_todo_data)
				return (object) [
					'ERRORS' => true,
					'SUCCESS' => false,
					'ERRORS_SCRIPT' => "Invalid data"
				];
			$_todo_data = (Object) $_todo_data;

			$_todo_ID = $_todo_data->id;

			if ($diagnoArray[0] == 'NO_ERRORS') {
				try {
					$Shiptodo->delete_todo($_todo_ID);

				} catch (Exception $e) {
					$diagnoArray[0] = "ERRORS_FOUND";
					$diagnoArray[] = $e->getMessage();
				}
			}
		} else {
			$diagnoArray[0] = 'ERRORS_FOUND';
		}
		if ($diagnoArray[0] == 'ERRORS_FOUND') {
			return (object) [
				'ERRORS' => true,
				'SUCCESS' => false,
				'ERRORS_SCRIPT' => "Error " . implode(', ', $diagnoArray)
			];
		} else {
			return (object) [
				'ERRORS' => false,
				'SUCCESS' => true,
				'ERRORS_SCRIPT' => ""
			];
		}
	}

	public static function change_status_todo()
	{
		$diagnoArray[0] = 'NO_ERRORS';
		$validate = new \Validate();
		$prfx = 'todo-';
		foreach ($_POST as $index => $val):
			$ar = explode($prfx, $index);
			if (count($ar)):
				$_SIGNUP[end($ar)] = $val;
			endif;
		endforeach;

		$_success_response_ = "";

		$validation = $validate->check($_SIGNUP, array(
			'_id_' => array(
				'name' => 'ID',
				'required' => true
			),
			'status' => array(
				'name' => 'Status',
				'required' => true
			),
		)
		);

		if ($validation->passed()) {
			$ShiptodoTable = new \todo();
			$Str = new \Str();
			$datetime = \Config::get('time/date_time');
			$_SIGNUP = (object) $_SIGNUP;

			/** Encryption Hash Class */
			$HASH = new \Hash();

			$_ID = $HASH->decryptAES($Str->data_in($_SIGNUP->_id_));
			$_status = $Str->data_in($_SIGNUP->status);

			$_fields = array(
				'status' => $_status,
			);

			if ($diagnoArray[0] == 'NO_ERRORS') {
				try {
					$ShiptodoTable->change_status_todo($_fields, $_ID);
				} catch (Exception $e) {
					$diagnoArray[0] = "ERRORS_FOUND";
					$diagnoArray[] = $e->getMessage();
				}
			}
		} else {
			$diagnoArray[0] = 'ERRORS_FOUND';
			// $error_msg = ul_array($validation->errors());
		}
		if ($diagnoArray[0] == 'ERRORS_FOUND') {
			return (object) [
				'ERRORS' => true,
				'SUCCESS' => false,
				'ERRORS_SCRIPT' => $validate->getErrorLocation()
			];
		} else {
			return (object) [
				'ERRORS' => false,
				'SUCCESS' => true,
				'SUCCESS_SCRIPT' => $_success_response_,
				'ERRORS_SCRIPT' => $validate->errors()
			];
		}
	}

	//to do list
	public static function gettodos()
	{
		$CNSROOTtodoTable = new \todo();
		$HASH = new \Hash();
		$CNSROOTtodoTable->selectQuery("SELECT id as token_id, title, description, due_date, status FROM todo WHERE status = 'ACTIVE' ");
		if ($CNSROOTtodoTable->count()):
			$_DATA_ = array();
			foreach ($CNSROOTtodoTable->data() as $list_):
				$list_->token_auth = $HASH->encryptAES($list_->token_id);
				

				$_DATA_[] = (Array) $list_;
			endforeach;
			return $_DATA_;
		endif;
		return false;
	}

	//to do unique item 
	public static function getInfotodoByID($ID)
	{
		$CNSROOTtodoTable = new \todo();
		$HASH = new \Hash();
		$CNSROOTtodoTable->selectQuery("SELECT id as token_id, title, description, due_date, status FROM todo WHERE status != 'ACTIVE' ", array($ID));
		if ($CNSROOTtodoTable->count()):
			return $CNSROOTtodoTable->first();
		endif;
		return false;
	}



	//item code generation
	public static function generateCode($TYPE = 'todo')
	{
		if ($TYPE == 'todo')
			return 'prod.' . rand(10, 90) . rand(100, 999) . date('d');
		return false;
	}


	public static function clean_null_value($_key_)
	{
		return ($_key_ == null) ? 0 : $_key_;
	}

	public static function number_format($_number_)
	{
		return number_format($_number_);
	}

	public static function checkToken($token)
    {
        $CNS_ROOT_todoTable = new \TODO();
        $CNS_ROOT_todoTable->selectQuery("SELECT id, status FROM todo where  `id` = ? ", array($token));
        if ($CNS_ROOT_todoTable->count()) 
            return $CNS_ROOT_todoTable->first();
        return false;
    }

}