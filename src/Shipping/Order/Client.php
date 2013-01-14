<?php

namespace Shipping\Order;

use \Shipping\Order;
use \Shipping\Order\Address;
use \Shipping\Order\Customer;
use \Shipping\Order\Item;

class ClientException extends \Exception {}

class Client extends \Transmit\Client
{


	public function fetchAll()
	{
		$response = $this->get('/order');
		return json_decode($response);
	}

	public function fetch($id)
	{
		$response = $this->get(sprintf('/order/%d', $id));
		return json_decode($response);
	}

	public function createNew(Address $address, Customer $customer, $items = array())
	{
		$response = $this->post('/order', json_encode(array('address' => $address, 'customer' => $customer, 'items' => $items)));
		return json_decode($response);
	}

	public function save(Order $order)
	{
		$response = $this->post(sprintf('/order/%d', $order->id), json_encode($order));
		return json_decode($response);
	}


}