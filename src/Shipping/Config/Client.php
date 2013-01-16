<?php

namespace Shipping\Config;

use \Shipping\Config;

class ClientException extends \Exception {}

class Client extends \Transmit\Client
{


	public function fetchAll()
	{
		$response = $this->get('/product');

		$products = array();
		foreach (json_decode($response) as $product) {
			$products[] = new Product($product->id, $product->name, $product->stock_id, $product->last_ordered);
		}

		return $products;
	}

	public function fetch($id)
	{
		$response = $this->get(sprintf('/product/%d', $id));

		$product = json_decode($response);

		return new Product($product->id, $product->name, $product->stock_id, $product->last_ordered);
	}

	public function createNew($name, $stock_id, $last_ordered = 0)
	{
		$response = $this->post('/product', json_encode(array('name' => $name, 'stock_id' => $stock_id, 'last_ordered' => $last_ordered)));
		return json_decode($response);
	}

	public function delete($id)
	{
		$response = $this->delete(sprintf('/product/%d', $id));
		return json_decode($response);
	}


}