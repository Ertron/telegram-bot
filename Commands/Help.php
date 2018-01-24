<?php

namespace Commands;
use lib\Command;


class Help extends Command{

	/**
	 * COMMAND: '/help'
	 */

	public function defaultAction(){
		$result = array(
			'method' => 'sendMessage',
			'parameters' => array(
				'chat_id' => $this->chat_id,
				"text" => 'Commands:
						/start - Show start registration
						/help - Show all commands',
				'reply_markup' => array(
					'remove_keyboard' => true
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