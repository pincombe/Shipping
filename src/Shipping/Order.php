<?php

namespace Shipping;

use \Shipping\Order\Address;
use \Shipping\Order\Customer;
use \Shipping\Order\Item;

class OrderException extends \Exception {}

class Order
{
	public $id;
    public $status;
    public $created;

    public $address;
    public $customer;
    public $items = array();

    public function __construct($id, $status, $created)
	{
		$this->id = $id;
		$this->status = $status;
		$this->created = $created;
	}

	public function setAddress(Address $address)
	{
		$this->address = $address;
	}

	public function setCustomer(Customer $customer)
	{
		$this->customer = $customer;
	}

	public function addItem(Item $item)
	{
		$this->items[] = $item;
	}

	public function getAccountID()
	{
		return $this->account_id;
	}
}