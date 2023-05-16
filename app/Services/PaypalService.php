<?php

namespace App\Services;

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\Payout;
use PayPal\Api\PayoutSenderBatchHeader;
use PayPal\Api\Currency;
use PayPal\Api\PayoutItem;
use PayPal\Api\PayoutItemDetails;

class PaypalService
{
    private $apiContext;

    public function __construct()
    {
        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                'paypal_client_id',
                'paypal_secret'
            )
        );
        $this->apiContext->setConfig(
            array(
                'mode' => 'sandbox',
                'log.LogEnabled' => true,
                'log.FileName' => 'PayPal.log',
                'log.LogLevel' => 'DEBUG'
            )
        );
    }

    public function createPayout(string $senderBatchId, string $email, string $currency, string $amount): Payout
    {
        $senderBatchHeader = new PayoutSenderBatchHeader();
        $senderBatchHeader->setSenderBatchId($senderBatchId);
        $senderBatchHeader->setEmailSubject('You have a payout!');

        $senderItem = new PayoutItem();
        $senderItem->setRecipientType('Email')
                   ->setReceiver($email)
                   ->setAmount(new Currency(['value' => $amount, 'currency' => $currency]))
                   ->setSenderItemId(uniqid());

        $payoutItemDetails = new PayoutItemDetails();
        $payoutItemDetails->setPayoutItems(array($senderItem));

        $payout = new Payout();
        $payout->setSenderBatchHeader($senderBatchHeader);
        $payout->setItems($payoutItemDetails);

        return $payout->create(null, $this->apiContext);
    }
}

