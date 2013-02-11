<?php

/**
 * Authors: 
 *	- Tyrence (RK2)
 *
 * @Instance
 */
class AutoJoinController extends AutoInject {

	/**
	 * Name of the module.
	 * Set automatically by module loader.
	 */
	public $moduleName;
	
	/**
	 * @Setup
	 */
	public function setup() {
		$this->settingManager->add($this->moduleName, "auto_join_channel", "Private channel to automatically join", "edit", "text", "none", "none");
	}
	
	/**
	 * @Event("logon")
	 * @Description("Send 'join' tell to auto join bot")
	 */
	public function autoJoinLogonEvent($eventObj) {
		if ($this->isAutoJoinChannel($eventObj->sender)) {
			$this->chatBot->send_tell($eventObj->sender, 'join', "\0", AOC_PRIORITY_MED);
		}
	}
	
	/**
	 * @Event("extjoinprivrequest")
	 * @Description("Accept private channel invite from player being listened to")
	 */
	public function acceptInviteForExternalCommandsEvent($eventObj) {
		if ($this->isAutoJoinChannel($eventObj->sender)) {
			$this->chatBot->privategroup_join($eventObj->sender);
		}
	}
	
	public function isAutoJoinChannel($name) {
		$name = strtolower($name);
		if ($name == 'none') {
			return false;
		} else {
			return strtolower($this->setting->auto_join_channel) == $name;
		}
	}
}