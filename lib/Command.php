<?php

namespace lib;

abstract class Command {

	/**
	 * @var int $chat_id
	**/
	public $chat_id = null;

	/**
	 * @var string $text
	 **/
	public $text = null;

	/**
	 * @var int $user_id
	 **/
	public $user_id = null;

	/**
	 * @var array $user_info
	 **/
	public $user_info = null;

	/**
	 * @return array
	 */
	abstract function defaultAction();


	/**
	 * @return array
	 */
	function serviceAction(){
		return array();
	}

	/**
	 * @param array $message Message from Telegram
	 *
	 * @param array $user_info User Information
	 *
	 * @return array
	 */
	public function execute(array $message, array $user_info){

		$this->user_info = $user_info;

		$this->chat_id = $message['chat']['id'];

		$this->text = $message['text'];

		$this->user_id = $message['from']['id'];

		$result = null;
		if($user_info['active_action'] == null){
			$result = $this->defaultAction();
		}
		else{
			$result = $this->serviceAction();
		}
		return $result;
	}

}