<?php

namespace Shipping\Order;

class TrackingException extends \Exception {}

class Tracking
{
	public $id;
	public $type;

    public function __construct($id, $type)
	{
		$this->id = $id;
		$this->type = $type;
	}

	public function getLink()
	{




	}

}