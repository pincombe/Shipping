<?php

namespace Shipping\Order\Notification;

use \Shipping\Order;

class ClientException extends \Exception {}

class Client extends \Transmit\Client
{

	public function notify(Order $order)
	{
		$response = $this->_post('/notify/shipping', json_encode($order));
		return json_decode($response);
	}

}