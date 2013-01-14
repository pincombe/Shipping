<?php

namespace Shipping;

class ProductException extends \Exception {}

class Product
{
	public $id;
    public $name;
    public $stock_id;
    public $last_ordered;

    private $account_id;

    public function __construct($id, $name, $stock_id, $last_ordered)
	{
		$this->id = $id;
		$this->name = $name;
		$this->stock_id = $stock_id;
		$this->account_id = $account_id;
		$this->last_ordered = $last_ordered;
	}

	public function getAccountID()
	{
		return $this->account_id;
	}

	public function setAccountID($account_id)
	{
		$this->account_id = $account_id;
	}

}