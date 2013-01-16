<?php

namespace Shipping;

class ConfigException extends \Exception {}

class Config
{
	public $kunaki_user;
	public $kunaki_pass;

    public function __construct($kunaki_user, $kunaki_pass)
	{
		$this->kunaki_user = $kunaki_user;
		$this->kunaki_pass = $kunaki_pass;
	}

}