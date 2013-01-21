<?php

namespace Shipping\Order;

class TrackingException extends \Exception {}

class Tracking
{
	public $id;
	public $type;
	public $delivery_time;

    public function __construct($id, $type, $delivery_time)
	{
		$this->id = $id;
		$this->type = $type;
		$this->delivery_time = $delivery_time;
	}

	public function getLink()
	{

    	if ($this->type == 'http://usps.com') {
        	return sprintf('http://trkcnfrm1.smi.usps.com/PTSInternetWeb/InterLabelInquiry.do?%s', 
        	               http_build_query(array('strOrigTrackNum' => $this->id)));
    	}


    	if ($this->type == 'http://ups.com') {
        	return sprintf('http://wwwapps.ups.com/WebTracking/OnlineTool?%s', 
        	               http_build_query(array('InquiryNumber1' => $this->id)));
    	}


    	throw new TrackingException('Tracking Link Not Available');
	}

}