<?php

namespace Commands;

use lib\Command;

class Start extends Command{

	/**
	 * COMMAND: '/start'
	 */

	public function defaultAction(){
		$text = 'Введите ваши данные';
		$keyboardButtons = [];
		if($this->user_info != null){
			if($this->user_info['name'] == null){
				$keyboardButtons[] = array('Ввести имя');
			}
			if($this->user_info['phone'] == null){
				$keyboardButtons[] = array('Ввести номер телефона');
			}
			if($this->user_info['email'] == null){
				$keyboardButtons[] = array('Ввести E-mail');
			}

			if(empty($keyboardButtons)){
				$text = 'У нас уже есть Ваши данные';
			}
		}

		$result = array(
			'method' => 'sendMessage',
			'parameters' => array(
				'chat_id' => $this->chat_id,
				"text" => $text,
				'reply_markup' => array(
					'keyboard' => $keyboardButtons,
					'one_time_keyboard' => true,
					'resize_keyboard' => true
				)
			),
			'db' => array(
				'setAction' => null,
				'query' => ''
			)
		);
		return $result;
	}



}