<?php
class AIResponse{
	private $message;
	private $mongo;
	private $db;

	function __construct($message){
		$this -> message = $message;
		$this -> mongo = new MongoClient();
		$this -> db = $this -> mongo -> selectDB("airesponse");
	}

	public function getAIResponse(){
		$collection = $this -> db -> response;
		$cursor = $collection -> find(array("comment" => $this -> message));
		$cursor_array = iterator_to_array($cursor,false);
		$array_count = count($cursor_array);
		$response_key = rand(0,$array_count-1);
		if(!empty($cursor_array[$response_key])){
			return $cursor_array[$response_key]['response'];
		}else{
			return "/疑问";
		}
	}

	public function addResponseInfo($comment, $response){
		$collection = $this -> db -> response;
		$collection -> insert(array("comment" => $comment, "response" => $response));
	}
}

// $test = new AIResponse('金仁超');
// $test -> getAIResponse();
//$test -> addResponseInfo('金仁超','金仁超是傻逼!');
// echo "success";