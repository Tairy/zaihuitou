<?php

/**
 * 获取微信返回数据.
 *
 * 这个类主要是接受微信返回的数据，把它存入类变量$postObj中，
 * 这样就可以在其他类中使用 MessageReceive::$postObj->XXX
 * 来获取微信返回的相关信息。 
 * 
 * @category   MessageReceive
 * @author     Tairy <tairyguo@gmail.com>
 * @copyright  2014 Tairy
 * @version    0.0.1
 */
// {{{ MessageReceive

class MessageReceive{

	// {{{ properties

  /**
   * 微信返回信息解析成的SimpleXMLElement对象
   *
   * 主要有ToUserName FromUserName CreateTime MsgType 
   * Content MsgId等属性，详细见微信开发文档.
   * http://mp.weixin.qq.com/wiki/index.php
   *
   * @var SimpleXMLElement
   * @access public
   */
	public static $postObj;

	// }}}
	// {{{ main()
	/**
	* 入口函数
	*
	*
	* @param void
	* @access public
	*
	*/
	public function main(){
		/*
		* 调用receiveMessage()方法
		*/
		$this -> receiveMessage();
	}
	// }}}

	// {{{ receiveMessage()
	/**
	* 接受数据，解析成SimpleXMLElement对象,调用MessageResolve类
	*
	*
	* @param void
	* @access private
	*
	*/
	private function receiveMessage(){
		$postData = $GLOBALS["HTTP_RAW_POST_DATA"];
		if(!empty($postData)){
			self::$postObj  = simplexml_load_string($postData, 'SimpleXMLElement', LIBXML_NOCDATA);
			$resolve = new MessageResolve();
			$resolve -> sortMessageType();
		}else{
			$response = new MessageResponse("指令为空！", "text");
		}
	}

	// }}}
}
// }}}
?>