<?php

namespace Shipping\Order;

class AddressException extends \Exception {}

class Address
{
    public $recipient;
    public $organization;
    public $address1;
    public $address2;
    public $city;
    public $state;
    public $zip_code;
    public $country_code;

    public function __construct($recipient, $organization, $address1, $address2, $city, $state, $zip_code, $country_code)
	{
		$this->recipient = $recipient;
		$this->organization = $organization;
		$this->address1 = $address1;
		$this->address2 = $address2;
		$this->city = $city;
		$this->state = $state;
		$this->zip_code = $zip_code;
		$this->country_code = $country_code;
	}
}