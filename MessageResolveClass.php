<?php
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
				$response = new MessageResponse("lianjie","text");
				break;
			case 'event':
				$this -> resolveEventCommand();
				//$response = new MessageResponse("shijian","text");
				break;
			default:
				$response = new MessageResponse("/疑问不认识的信息类型","text");
				break;
		}
	}

	private function resolveTextCommand(){

	}

	private function resolveEventCommand(){
		switch (MessageReceive::$postObj -> Event) {
			case 'subscribe':
				new MessageResponse("欢迎订阅!","text");
				break;
			
			default:
				# code...
				break;
		}
	}
}