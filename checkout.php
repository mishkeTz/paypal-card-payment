<?php  

require_once 'app/bootstrap.php';

use PayPal\Api\CreditCard;
use PayPal\Api\FundingInstrument;
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\Payment;

if (!isset(
	$_POST['product'],	
	$_POST['price'],	
	$_POST['card_type'],	
	$_POST['card_number'],	
	$_POST['card_exp_month'],	
	$_POST['card_exp_year'],	
	$_POST['card_cvv'],	
	$_POST['card_first_name'],	
	$_POST['card_last_name']	
)) {
	die();
}

$cardType 		= $_POST['card_type'];
$cardNumber 	= $_POST['card_number'];
$cardExpMonth 	= $_POST['card_exp_month'];
$cardExpYear 	= $_POST['card_exp_year'];
$cardCvv 		= $_POST['card_cvv'];
$cardFirstName 	= $_POST['card_first_name'];
$cardLastName 	= $_POST['card_last_name'];

$product 		= $_POST['product'];
$price 			= $_POST['price'];
$shipping 		= 2.00;

$total 			= $price + $shipping;

$card = new CreditCard();
$card->setType($cardType)
	->setNumber($cardNumber)
	->setExpireMonth($cardExpMonth)
	->setExpireYear($cardExpYear)
	->setCvv2($cardCvv)
	->setFirstName($cardFirstName)
	->setLastName($cardLastName);

$funding = new FundingInstrument();
$funding->setCreditCard($card);

$payer = new Payer();
$payer->setPaymentMethod('credit_card')
	->setFundingInstruments([$funding]);

$item = new Item();
$item->setName($product)
	->setCurrency('GBP')
	->setQuantity(1)
	->setPrice($price);

$itemList = new ItemList();
$itemList->setItems([$item]); // if there is more than one item - $itemList->setItems([$item1, $item2, $item3...]);

$details = new Details();
$details->setShipping($shipping)
		->setSubtotal($price);

$amount = new Amount();
$amount->setCurrency("GBP")
		->setTotal($total)
		->setDetails($details);

$transaction = new Transaction();
$transaction->setAmount($amount)
			->setDescription('PayForSomething payment')
			->setInvoiceNumber(uniqid());

$payment = new Payment();
$payment->setIntent('sale')
		->setPayer($payer)
		->setTransactions([$transaction]);

// Charge
try {
	$pay = $payment->create($paypal);

	if ($pay->getState() == 'approved') {
		die("Payment made.");
		// 
	}

} catch(Exception $e) {
	$ex = json_decode($e->getData());
	var_dump($ex);
}

