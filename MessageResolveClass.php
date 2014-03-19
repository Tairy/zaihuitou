<?php

/**
 * 解析用户消息
 *
 * 这个类主要是解析MessageReceive::$postObj -> MsgType和
 * MessageReceive::$postObj -> Content两个变量的内容，然
 * 后再调用不同的接口处理数据
 * 
 * @category   MessageResolve
 * @author     Tairy <tairyguo@gmail.com>
 * @copyright  2014 Tairy
 * @version    0.0.1
 */
// {{{ MessageResolve

class MessageResolve{
	// {{{ sortMessageType()

	/**
	*
	* 分析信息类型
	* 
	* 主要是根据MessageReceive::$postObj -> MsgType获取用户发送的
	* 数据的类型，从而做出相应的操作
	*
	* @param void
	* @access public
	*
	*/
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

	// }}}

	// {{{ function resolveTextCommand()

	/**
	*
	* 解析用户文本信息
	*
	* 解析MessageReceive::$postObj -> MsgType为text时的操作
	* 主要是根据MessageReceive::$postObj -> Content，即用的
	* 发送的文本信息，确定调用不同的接口.
	*
	* @param void
	* @access private
	*
	*/

	private function resolveTextCommand(){
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

	// }}}

	//{{{resolveEventCommand()

	/**
	*
	* 解析用户事件命令
	*
	* 解析MessageReceive::$postObj -> MsgType为event时的操作
	* 主要是根据MessageReceive::$postObj -> Event，来确定事件
	* 对应的操作
	*
	* @param void
	* @access private
	* 
	*/

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

	// }}}
}

// }}}