<?php

/**
 * 智能回复类
 *
 * 主要是查询数据库中可能的回复信息，返回給用户
 * 
 * @category   AIResponse
 * @author     Tairy <tairyguo@gmail.com>
 * @copyright  2014 Tairy
 * @version    0.0.1
 */

 // {{{ AIResponse

class AIResponse{

	// {{{ properties

	/**
	* 用户发送的消息
	*
	*
	* @var string
	* @access private
	*/

	private $message;

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

	// {{{ __construct

	/**
   * 构造函数
   *
   * @param void
   * @access public
   * 
   */
	function __construct($message){
		$this -> message = $message;
		$this -> mongo = new MongoClient();
		$this -> db = $this -> mongo -> selectDB("airesponse");
	}

	// }}}

	// {{{ getAIResponse()

	/**
   * 获取回复的信息
   *
   * @param void
   * @access public
   * 
   */
	public function getAIResponse()
	{
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

	// }}}

	// {{{ addResponseInfo($comment, $response)

	/**
   * 添加一天消息映射
   *
   * @param string $comment 用户回复的消息
   * @param string $response 返回給用户的消息
   * @access public
   * 
   */

	public function addResponseInfo($comment, $response){
		$collection = $this -> db -> response;
		$collection -> insert(array("comment" => $comment, "response" => $response));
	}

	// }}}
}

// }}}