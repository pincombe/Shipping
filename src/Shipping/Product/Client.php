<?php

namespace Shipping\Product;

class ClientException extends \Exception {}

class Client extends \Transmit\Client
{


	public function fetchAll()
	{
		$response = $this->get('/product');
		return json_decode($response);
	}

	public function fetch($id)
	{
		$response = $this->get(sprintf('/product/%d', $id));
		return json_decode($response);
	}

	public function createNew($name, $stock_id, $last_ordered = 0)
	{
		$response = $this->post('/product', json_encode(array('name' => $name, 'stock_id' => $stock_id, 'last_ordered' => $last_ordered)));
		return json_decode($response);
	}


}