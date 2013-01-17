<?php

namespace Shipping;

class ProductException extends \Exception {}

class Product
{
	public $id;
    public $name;
    public $stock_id;
    public $last_ordered;

    public function __construct($id, $name, $stock_id, $last_ordered)
	{
		$this->id = $id;
		$this->name = $name;
		$this->stock_id = $stock_id;
		$this->last_ordered = $last_ordered;
	}

	public static function load($json)
	{
		$data = json_decode($json);

		if (empty($data)) {
			throw new ProductException('Unable to decode json object');
		}

		return new self($data->id, $data->name, $data->stock_id, $data->last_ordered);
	}

	public static function loadAll($json)
	{
		// TODO: Empty array can be valid but an empty response or undecodable data isn't

		$data = json_decode($json);

		$products = array();
		foreach ($data as $product) {
			$products[] = new self($product->id, $product->name, $product->stock_id, $product->last_ordered);
		}

		return $products;
	}


}