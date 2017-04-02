<?php  

require_once 'vendor/autoload.php';

$paypal = new \PayPal\Rest\ApiContext(
	new \PayPal\Auth\OAuthTokenCredential('', '')
);



