<?php

namespace Commands;
use lib\Command;

class EnterName extends Command{

	/**
	 * COMMAND: 'Ввести имя'
	 */

	public function defaultAction(){
		$result = array(
			'method' => 'sendMessage',
			'parameters' => array(
				'chat_id' => $this->chat_id,
				"text" => 'Введите ваше имя',
				'reply_markup' => array(
					'remove_keyboard' => true
				)
			),
			'db' => array(
				'setAction' => 'Ввести имя',
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
				"text" => 'Имя успешно добавлено в базу'
			),
			'db' => array(
				'setAction' => null,
				'query' => 'UPDATE `telegram`.`user_info` SET  `name` =  "'.$this->text.'" WHERE  `user_info`.`telegram_user_id` ='.$this->user_id
			)
		);
		return $result;
	}
}