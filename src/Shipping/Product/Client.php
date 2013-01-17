<?php

namespace Shipping\Product;

use \Shipping\Product;

class ClientException extends \Exception {}

class Client extends \Transmit\Client
{

	public function fetchAll()
	{
		$response = $this->_get('/product');
		return \Shipping\Product::loadAll($response);
	}

	public function fetch($id)
	{
		$response = $this->_get(sprintf('/product/%d', $id));
		return \Shipping\Product::load($response);
	}

	public function save(Product $product)
	{
		if ($product->id == 0) {
			$response = $this->_post('/product', json_encode($product));
			return \Shipping\Product::load($response);
		}

		$response = $this->_put(sprintf('/product/%d', $product->id), json_encode($product));
		return \Shipping\Product::load($response);
	}

	public function delete($id)
	{
		$this->_delete(sprintf('/product/%d', $id));
	}

}