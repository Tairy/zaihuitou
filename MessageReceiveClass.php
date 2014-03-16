<?
/**
*
*
*/
class MessageReceive{
	public static $postObj;


	public function main(){
		$this -> receiveMessage();
	}

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
}