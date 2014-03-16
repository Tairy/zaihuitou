<?php
class MessageResponse{
	private $responsemessage;

	function __construct($responsemessage,$messagetype){
		$this -> responsemessage = $responsemessage;
		if("text" == $messagetype){
			$this -> responseTextMessage();
		}
	}

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
    $resultStr = sprintf($textTpl, UserView::$postObj -> FromUserName, UserView::$postObj -> ToUserName, $time, $msgType, $contentStr);
    echo $resultStr;
	}
}