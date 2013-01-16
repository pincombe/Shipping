<?php

namespace Shipping;

class ConfigException extends \Exception {}

class Config
{
	public $id;
	public $kunaki_user;
	public $kunaki_pass;

    public function __construct($id, $kunaki_user, $kunaki_pass)
	{
		$this->id = $id;
		$this->kunaki_user = $kunaki_user;
		$this->kunaki_pass = $kunaki_pass;
	}

}