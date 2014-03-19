<?php
class GetPyExperiment{
	private $mongo;
	private $db;

	function __construct(){
		$this -> mongo = new MongoClient();
		$this -> db = $this -> mongo -> selectDB("pyexperiment");
	}

  public function getExpreimentByDate($date){
  	$collection = $this -> db -> experiment;
  	$cursor = $collection->findOne(array('date' => $date));
  	if(!empty($cursor)){
  		return "实验名称：".$cursor['name']."\n实验日期:".$cursor['date']." ".$cursor['day']."\n实验成员:".$cursor['students']."\n实验地点:".$cursor['place']."\n实验类型:".$cursor['type']."\n实验老师:".$cursor['teacher'];
  	}

  	return "没有实验哦～";
  }

  public function getExpreimentByRange($startdate, $enddate){
    $collection = $this -> db -> experiment;
    $cursor = $collection -> find(array("date" => array('$gt' => $startdate,'$lt' => $enddate)));
    $re_info = "";
    foreach ($cursor as $doc) {
      $re_info .= "--------\n实验名称：".$doc['name']."\n实验日期:".$doc['date']." ".$doc['day']."\n实验成员:".$doc['students']."\n实验地点:".$doc['place']."\n实验类型:".$doc['type']."\n实验老师:".$doc['teacher']."\n";
    }
    return $re_info;
  }
}