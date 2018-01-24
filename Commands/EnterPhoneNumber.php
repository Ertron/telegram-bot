<?php

namespace Commands;
use lib\Command;

class EnterPhoneNumber extends Command{

	/**
	 * COMMAND: 'Ввести номер телефона'
	 */

	public function defaultAction(){
		$result = array(
			'method' => 'sendMessage',
			'parameters' => array(
				'chat_id' => $this->chat_id,
				"text" => 'Введите номер вашего телефона',
				'reply_markup' => array(
					'remove_keyboard' => true
				)
			),
			'db' => array(
				'setAction' => 'Ввести номер телефона',
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
				"text" => 'Номер телефона успешно добавлен в базу'
			),
			'db' => array(
				'setAction' => null,
				'query' => 'UPDATE `telegram`.`user_info` SET  `phone` =  "'.$this->text.'" WHERE  `user_info`.`telegram_user_id` ='.$this->user_id
			)
		);
		return $result;
	}
}