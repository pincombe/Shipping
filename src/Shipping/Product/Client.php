<?php

namespace Shipping\Product;

use \Shipping\Product;

class ClientException extends \Exception {}

class Client extends \Transmit\Client
{

	public function fetchAll()
	{
		$response = $this->get('/product');
		return \Shipping\Product::loadAll($response);
	}

	public function fetch($id)
	{
		$response = $this->get(sprintf('/product/%d', $id));
		return \Shipping\Product::load($response);
	}

	public function save(Product $product)
	{
		if ($product->id == 0) {
			$response = $this->post('/product', json_encode($product));
			return \Shipping\Product::load($response);
		}

		$response = $this->put(sprintf('/product/%d', $product->id), json_encode($product));
		return \Shipping\Product::load($response);
	}

	public function delete($id)
	{
		$response = $this->delete(sprintf('/product/%d', $id));
		return json_decode($response);
	}

}