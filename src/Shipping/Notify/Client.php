<?php

namespace Shipping\Notification;

use \Shipping\Order;

class ClientException extends \Exception {}

class Client extends \Transmit\Client
{

	public function shipped(Order $order)
	{
		$response = $this->post('/', json_encode(array('name' => $name, 'stock_id' => $stock_id, 'last_ordered' => $last_ordered)));
		return json_decode($response);
	}

}