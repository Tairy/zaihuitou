<?
class MessageResolve{
	public function sortMessageType(){
		switch (MessageReceive::$postObj -> MsgType) {
			case 'text':
				$this -> resolveTextCommand();
				break;
			case 'image':
				$response = new MessageResponse("tupian","text");
				break;
			case 'location':
				$response = new MessageResponse("diliweizhi","text");
				break;
			case 'link':
				$response = new ResponseView("lianjie","text");
				break;
			case 'event':
				$this -> resolveEventCommand();
				//$response = new ResponseView("shijian","text");
				break;
			default:
				$response = new ResponseView("/疑问不认识的信息类型","text");
				break;
		}
	}

	private function resolveTextCommand(){

	}

	private function resolveEventCommand(){

	}
}