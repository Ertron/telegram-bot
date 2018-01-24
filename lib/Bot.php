<?php

namespace lib;

class Bot {

	/**
	 * @var object $hook
	 **/
	private $hook;

	/**
	 * Bot constructor.
	 *
	 * @param HookRequest $hook_request
	 */
	public function __construct(HookRequest $hook_request) {
		$this->hook = $hook_request;
	}

	/**
	 * @param array $data
	 */
	public function process(array $data){
		$this->hook->hook($data);
	}
}