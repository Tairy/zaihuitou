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
				break;
			default:
				$response = new MessageResponse("/疑问不认识的信息类型","text");
				break;
		}
	}

	public function resolveTextCommand(){
		switch (MessageReceive::$postObj -> Content) {
			case '今天实验':
				$date = date('Y-n-d');
				$pyExperiment = new GetPyExperiment();
				$responseMes = "今天";
				$responseMes .= $pyExperiment -> getExpreimentByDate($date);
				new MessageResponse($responseMes,"text");
				break;
			case '明天实验':
				$date = date('Y-n-d',strtotime('+1 day'));
				$pyExperiment = new GetPyExperiment();
				$responseMes = "明天也";
				$responseMes .= $pyExperiment -> getExpreimentByDate($date);
				new MessageResponse($responseMes,"text");
				break;
			case '本周实验':
				$monday = date('Y-m-d',strtotime('last Monday'));
				$friday = date('Y-m-d',strtotime('Friday'));
				$pyExperiment = new GetPyExperiment();
				$respons = $pyExperiment -> getExpreimentByRange($monday,$friday);
				if(empty($respons)){
					$responseMes = "本周没有实验哦～";
				}else{
					$responseMes = "本周实验:\n";
					$responseMes .= $respons;
				}
				new MessageResponse($responseMes,"text");
				break;

			case '下周实验':
				$monday = date('Y-m-d',strtotime('Monday'));
				$friday = date('Y-m-d',strtotime('next Friday'));
				$pyExperiment = new GetPyExperiment();
				$respons = $pyExperiment -> getExpreimentByRange($monday,$friday);
				if(empty($respons)){
					$responseMes = "下周没有实验哦～";
				}else{
					$responseMes = "下周实验:\n";
					$responseMes .= $respons;
				}
				new MessageResponse($responseMes,"text");
				break;
			
			default:
				$aiResponse = new AIResponse(MessageReceive::$postObj -> Content);
				$responseMes = $aiResponse -> getAIResponse();
				new MessageResponse($responseMes,"text");
				break;
		}

	}

	private function resolveEventCommand(){
		switch (MessageReceive::$postObj -> Event) {
			case 'subscribe':
				new MessageResponse("欢迎订阅!\n回复'今天实验','明天实验','本周实验','下周实验'即可查询实验相关信息。","text");
				break;
			
			default:
				# code...
				break;
		}
	}
}