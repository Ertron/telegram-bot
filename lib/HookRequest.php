<?php

namespace lib;

use App\CommandList;

class HookRequest {

	/**
	 * @var int $update_id
	**/
	public $update_id;

	/**
	 * @var int $message_id
	 **/
	public $message_id;
	private $chat;
	private $from;
	private $date;
	private $request;
	private $log;

	/**
	 * @var object $db
	 **/
	private $db;

	/**
	 * HookRequest constructor.
	 *
	 * @param CustomRequest $object
	 * @param $database
	 */
	public function __construct(CustomRequest $object, $database) {
		$this->request = $object;
		$this->db = $database;
		$this->log = $this->request->log;
	}

	/**
	 * @param array $array
	 */
	public function hook(array $array) {
		$this->update_id = $array['update_id'];
		if(isset($array['message'])){
			$this->processMessage($array['message']);
		}
	}

	/**
	 * @param string $string
	 *
	 * @return null|object
	 */
	public function getObjectByText(string $string){
		$object = CommandList::getCommand($string);
		return $object;
	}

	/**
	 * @param int $id
	 *
	 * @return mixed
	 */
	public function getUserInfo(int $id) {
		$query = $this->db->query('SELECT * FROM user_info WHERE telegram_user_id = '.$id);
		$user = $query->fetch();
		return $user;
	}

	/**
	 * @param int $id
	 */
	public function addUser(int $id){
		$query = $this->db->query('INSERT INTO `telegram`.`user_info` (`id`, `telegram_user_id`, `name`, `phone`, `email`, `active_action`, `action_status`) VALUES (NULL, '.$id.', "", "", "", NULL, NULL)');
		$query->fetch();
	}

	/**
	 * @param int $id
	 * @param $action
	 *
	 * @return mixed
	 */
	public function setUserAction(int $id, $action){
		$query = $this->db->query('UPDATE  `telegram`.`user_info` SET  `active_action` =  "'.$action.'" WHERE  `user_info`.`telegram_user_id` = '.$id);
		$user = $query->fetch();
		return $user;
	}

	/**
	 * @param array $message
	 *
	 * @return bool
	 */
	private function processMessage(array $message){

		$this->message_id = $message['message_id'];
		$this->chat = $message['chat'];
		$this->from = $message['from'];
		$this->date = $message['date'];

		if (isset($message['text'])) {

			$object_name = $message['text'];

			$user_info = $this->getUserInfo($message['from']['id']);

			if(!$user_info){
				$this->addUser($message['from']['id']);
				$user_info = $this->getUserInfo($message['from']['id']);
			}

			if(!empty($user_info) && $user_info['active_action'] != NULL){
				$object_name = $user_info['active_action'];
			}
			$object = $this->getObjectByText($object_name);
			if($object == null){
				return false;
			}


			$request = $object->execute($message, $user_info);

			if($request['db']['setAction'] != $user_info['active_action']){
				$this->setUserAction($user_info['telegram_user_id'], $request['db']['setAction']);
			}
			if(!empty($request['db']['query'])){
				$this->db->query($request['db']['query']);
			}

			$this->request->apiRequestJson($request['method'], $request['parameters']);
		}
	}

}