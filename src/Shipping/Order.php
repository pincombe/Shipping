<?php

namespace Shipping;

use \Shipping\Order\Address;
use \Shipping\Order\Customer;
use \Shipping\Order\Tracking;
use \Shipping\Order\Item;

class OrderException extends \Exception {}

class Order
{
	public $id;
    public $status;
    public $created;

    public $address;
    public $customer;
    public $tracking;
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

	public function setTracking(Tracking $tracking)
	{
		$this->tracking = $tracking;
	}

	public function addItem(Item $item)
	{
		$this->items[] = $item;
	}

	public function clearItems()
	{
		$this->items = array();
	}


	public static function loadAll($data)
	{
		$orders = array();

		foreach ($data as $order) {
			$orders[] = self::load($order);
		}

		return $orders;
	}

	public static function load($data)
	{

		if (empty($data)) {
			throw new OrderException('Unable to decode json object');
		}

		$order = new self($data->id, $data->status, $data->created);

		$order->setAddress(new \Shipping\Order\Address($data->address->recipient,
													   $data->address->organization,
													   $data->address->address1,
													   $data->address->address2,
													   $data->address->city,
													   $data->address->state,
													   $data->address->zip_code,
												       $data->address->country_code));

		$order->setCustomer(new \Shipping\Order\Customer($data->customer->first_name,
						  							     $data->customer->last_name,
												 	     $data->customer->email));

		$order->setTracking(new \Shipping\Order\Tracking($data->tracking->id, $data->tracking->type, $data->tracking->delivery_time));

		foreach ($data->items as $item) {
			$order->addItem(new \Shipping\Order\Item($item->product_id, $item->quantity));
		}

		return $order;
	}

}



