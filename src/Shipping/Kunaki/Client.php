<?php

namespace Shipping\Kunaki;

use \Shipping\Order;

class ClientException extends \Exception {}

class Client extends \Transmit\Client
{


	public function fetchAll()
	{
		$response = $this->get('/order');
		return json_decode($response);
	}

	public function fetch($id)
	{
		$response = $this->get(sprintf('/order/%d', $id));
		return json_decode($response);
	}

	public function createNew(Order $order)
	{
        $doc =new \DOMDocument();
        $root = $doc->createElement('order');
        $doc->appendChild($root);

        $root->appendChild($doc->createElement('UserId', ''));
        $root->appendChild($doc->createElement('Password', ''));
        $root->appendChild($doc->createElement('Mode', 'Live'));
        $root->appendChild($doc->createElement('Name', $address->recipient));
        $root->appendChild($doc->createElement('Company', $address->organization));
        $root->appendChild($doc->createElement('Address1', $address->address1));
        $root->appendChild($doc->createElement('Address2', $address->address2));
        $root->appendChild($doc->createElement('City', $address->city));
        $root->appendChild($doc->createElement('State_Province', $address->state));
        $root->appendChild($doc->createElement('PostalCode', $address->zip_code));
        $root->appendChild($doc->createElement('Country', $address->getCountry()));
        $root->appendChild($doc->createElement('ShippingDescription', $delivery_option->description));

    	// Add Natural Hypnosis CD
        $product = $doc->createElement('product');
        $product->appendChild($doc->createElement('ProductId', 'PX00ZMPYJD'));
        $product->appendChild($doc->createElement('Quantity', '1'));
        $root->appendChild($product);

        $response = self::postRequest('https://kunaki.com/XMLService.ASP', $doc->saveXML());

        $response = str_replace('<HTML>', '', $response);
        $response = str_replace('<BODY>', '', $response);

        $xml = new \SimpleXMLElement($response);
        $error_text = (string)$xml->ErrorText;
        $order_id = (string)$xml->OrderId;

        if ($error_text == 'success') {
            print $order_id;
            return;
        }

        throw new KunakiException($error_text);
	}

	public function save($order)
	{
		$response = $this->post(sprintf('/order/%d', $order->id), json_encode($order));
		return json_decode($response);
	}


}