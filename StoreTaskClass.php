<?php
class StoreTask{
	private $mongo;
	private $db;

	function __construct(){
		$this -> mongo = new MongoClient();
		$this -> db = $this -> mongo -> selectDB("task");
	}

	public function storeTask($userid, $taskname){
		$con_queue = $this -> db -> taskqueue;
		$con_log = $this -> db -> tasklog;
		$task_array = array('user_id' => $userid, 'task_name' => $taskname);
		$con_queue -> insert($task_array);
		$con_log -> insert($task_array);
	}
}