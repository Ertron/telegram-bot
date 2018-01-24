<?php

namespace lib;

interface CommandListInterface{

	/**
	 * @param string $string Command name
	 * @return Command instance of abstract class Command
	 */
	public static function getCommand(string $string);

}