<?php

namespace App;

use Commands\{
	EnterEmail, Start, Help, EnterName, EnterPhoneNumber
};

use lib\Command;
use lib\CommandListInterface;

class CommandList implements CommandListInterface {


	/**
	 * @param string $string
	 *
	 * @return object|null
	 */
	public static function getCommand(string $string){
		$result = null;
		switch ($string){

			case '/start' :
				$result = new Start();
				break;

			case '/help' :
				$result = new Help();
				break;

			case 'Ввести имя' :
				$result = new EnterName();
				break;

			case 'Ввести номер телефона' :
				$result = new EnterPhoneNumber();
				break;

			case 'Ввести E-mail' :
				$result = new EnterEmail();
				break;
		}


		if(!($result instanceof Command)){
			$result = null;
		}
		return $result;
	}
}