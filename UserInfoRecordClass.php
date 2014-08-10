<?php
/**
*	用户信息记录类
* 
* 这个类主要是记录关注用户信息，方便进行和用户相关的
* 功能的扩展.
* 
* 
* @category   UserInfoRecord
* @author     Tairy <tairyguo@gmail.com>
* @copyright  2014 Tairy
* @version    0.0.1
* 
*/

//{{{ UserInfoRecord

class UserInfoRecord{

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
		$this -> db = $this -> mongo -> selectDB("weichatuserinfo");
	}

  // }}}

	// {{{ recordUserInfo($wx_id)

	/**
	 *
	 * 记录用户微信id
	 * 
	 * @param string $wx_id 用户微信id
	 * @access public
	 * 
   */
	public function  recordUserInfo($wx_id){
		$wx_id = (string)$wx_id;
		$conllection = $this -> db -> userinfo;
		if(!$this -> hasUserRecord($wx_id)){
			$userId = time();
			$userinfo = array(
				"wx_id" => $wx_id,
				"user_id" => $userId
				);
			$conllection -> insert($userinfo);
		}
		return $userId;
	}
	// }}}

	// {{{ hasUserRecord($wx_id)

	/**
	 *
	 * 查询某个用户是否存在
	 * 
	 * @param string $wx_id 用户微信id
	 * @access public
	 * @return 存在返回true 不存在返回 false
	 * 
	 * */

	public function hasUserRecord($wx_id){
		$wx_id = (string)$wx_id;
		$collection = $this -> db -> userinfo;
		$cursor = $collection -> findOne(array('wx_id' => $wx_id));
		if(empty($cursor)){
			return false;
		}else{
			return true;
		}
	}
	// }}}

	public function getUseridByWxid($wx_id){
		$wx_id = (string)$wx_id;
		$collection = $this -> db -> userinfo;
		$userinfo = $collection -> findOne(array('wx_id' => $wx_id));
		return $userinfo['user_id'];
	}

	public function getHomeTemp($wx_id){
		$wx_id = (string)$wx_id;
		$collection = $this -> db -> userinfo;
		$userinfo = $collection -> findOne(array('wx_id' => $wx_id));
		if(empty($userinfo['home_temp'])){
			return "未绑定温度测试设备";
		}
		return $userinfo['home_temp'];
	}
}

// }}}