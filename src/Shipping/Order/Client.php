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
		$response = $this->_get('/order');
		return \Shipping\Order::loadAll(json_decode($response));
	}
	
	public function fetchByStatus($status)
	{
    	$response = $this->_get(sprintf('/order?%s', http_build_query(array('status' => $status))));
		return \Shipping\Order::loadAll(json_decode($response));    	
	}

	public function fetch($id)
	{
		$response = $this->_get(sprintf('/order/%d', $id));
		return \Shipping\Order::load(json_decode($response));
	}

	public function save(Order $order)
	{
		if ($order->id == 0) {
			$response = $this->_post('/order', json_encode($order));
			return \Shipping\Order::load(json_decode($response));
		}

		$response = $this->_put(sprintf('/order/%d', $order->id), json_encode($order));
		return \Shipping\Order::load(json_decode($response));
	}

	public function delete($id)
	{
		$this->_delete(sprintf('/order/%d', $id));
	}

}