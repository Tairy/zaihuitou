<?php

/**
 * 信息回复类（暂时只支持回复文本信息）.
 *
 * 这个了主要根据微信开发文档规定的格式生成xml格式并返回給微信服务器
 * 
 * @category   MessageResponse
 * @author     Tairy <tairyguo@gmail.com>
 * @copyright  2014 Tairy
 * @version    0.0.1
 */
//{{{ MessageResponse

class MessageResponse{

	//{{{ properties

	/**
   * 要回复给微信的文本信息
   *
   *
   * @var string
   * @access private
   */
	private $responsemessage;
  
  // }}}

  //{{{ __construct

	/**
	* 构造函数
	*
	*
	* @param string $responsemessage 回复给微信的文本信息
	* @param string $messagetype 文本信息类型
	* @access public
	*
	*/
	function __construct($responsemessage,$messagetype){
		$this -> responsemessage = $responsemessage;
		if("text" == $messagetype){
			$this -> responseTextMessage();
		}
	}

	// }}}

	//{{{ responseTextMessage()

	/**
	* 生成回复信息xml，返回給微信
	*
	*
	* @param void
	* @access private
	*
	*/

	private function responseTextMessage(){
		$time = time();
		$msgType = "text";
		$contentStr = $this -> responsemessage;    
    $textTpl = "<xml>
					<ToUserName><![CDATA[%s]]></ToUserName>
					<FromUserName><![CDATA[%s]]></FromUserName>
					<CreateTime>%s</CreateTime>
					<MsgType><![CDATA[%s]]></MsgType>
					<Content><![CDATA[%s]]></Content>
					<FuncFlag>0</FuncFlag>
					</xml>";             
    $resultStr = sprintf($textTpl, MessageReceive::$postObj -> FromUserName, MessageReceive::$postObj -> ToUserName, $time, $msgType, $contentStr);
    echo $resultStr;
	}

	//}}}
}

// }}}