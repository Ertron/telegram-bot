<?php

namespace Commands;
use lib\Command;

class EnterEmail extends Command{

	/**
	 * COMMAND: 'Ввести E-mail'
	 */

	public function defaultAction(){
		$result = array(
			'method' => 'sendMessage',
			'parameters' => array(
				'chat_id' => $this->chat_id,
				"text" => 'Введите ваш E-mail',
				'reply_markup' => array(
					'remove_keyboard' => true
				)
			),
			'db' => array(
				'setAction' => 'Ввести E-mail',
				'query' => ''
			)
		);
		return $result;
	}

	public function serviceAction(){
		$result = array(
			'method' => 'sendMessage',
			'parameters' => array(
				'chat_id' => $this->chat_id,
				"text" => 'E-mail успешно добавлен в базу'
			),
			'db' => array(
				'setAction' => null,
				'query' => 'UPDATE `telegram`.`user_info` SET  `email` =  "'.$this->text.'" WHERE  `user_info`.`telegram_user_id` ='.$this->user_id
			)
		);
		return $result;
	}
}