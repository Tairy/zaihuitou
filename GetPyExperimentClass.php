<?php

/**
 * 实验信息类
 *
 * 这个类是我扩展的用来查询这学期实验信息的,主要是从数据库中读
 * 取到实验的相关信息然后返回給微信，便捷查询
 * 
 * @category   GetPyExperiment
 * @author     Tairy <tairyguo@gmail.com>
 * @copyright  2014 Tairy
 * @version    0.0.1
 */

// {{{ GetPyExperiment

class GetPyExperiment{

  // {{{ properties

  /**
   * 连接mongodb数据库对象
   *
   * @var MongoClient
   * @access private
   * 
   */
	private $mongo;

  /**
   * 选择操作数据库对象
   *
   * @var MongoClient
   * @access private
   * 
   */
	private $db;

  // }}}

  //{{{ __construct()

  /**
   * 构造函数
   *
   * @param void
   * @access public
   * 
   */
	function __construct(){
		$this -> mongo = new MongoClient();
		$this -> db = $this -> mongo -> selectDB("pyexperiment");
	}

  // }}}

  //{{{ getExpreimentByDate($date)

  /**
  * 根据日期获取实验信息
  *
  *
  * @param string $date 实验日期
  * @access public
  *
  */
  public function getExpreimentByDate($date){
  	$collection = $this -> db -> experiment;
  	$cursor = $collection->findOne(array('date' => $date));
  	if(!empty($cursor)){
  		return "实验名称：".$cursor['name']."\n实验日期:".$cursor['date']." ".$cursor['day']."\n实验成员:".$cursor['students']."\n实验地点:".$cursor['place']."\n实验类型:".$cursor['type']."\n实验老师:".$cursor['teacher'];
  	}

  	return "没有实验哦～";
  }

  // }}}

  //{{{ getExpreimentByRange($startdate, $enddate)

  /**
  * 获取某一段时间的实验信息
  *
  *
  * @param string $startdate 开始时间日期
  * @param string $enddate 结束时间日期
  * @access public
  *
  */

  public function getExpreimentByRange($startdate, $enddate){
    $collection = $this -> db -> experiment;
    $cursor = $collection -> find(array("date" => array('$gt' => $startdate,'$lt' => $enddate)));
    $re_info = "";
    foreach ($cursor as $doc) {
      $re_info .= "--------\n实验名称：".$doc['name']."\n实验日期:".$doc['date']." ".$doc['day']."\n实验成员:".$doc['students']."\n实验地点:".$doc['place']."\n实验类型:".$doc['type']."\n实验老师:".$doc['teacher']."\n";
    }
    return $re_info;
  }

  // }}}
}

// }}}