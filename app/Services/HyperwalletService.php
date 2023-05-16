<?php

namespace App\Services;

use Hyperwallet\Hyperwallet;
use Hyperwallet\Model\Transfer;
use Hyperwallet\Model\User;

use Hyperwallet\Model\TransferMethodConfiguration;
class HyperwalletService
{
    private $client;

    public function __construct()
    {
        $this->client = new Hyperwallet(
            'restapiuser@175606711612',
        'k3+9EYW/KO^{',
        'https://api.sandbox.hyperwallet.com',
        'prg-cb9e31da-ea33-4869-b81e-451de14a6a02'
        );
    }

    public function createTransfer(string $clientTransferId, string $destinationToken, string $currency, string $amount): Transfer
{
    // Instantiate Hyperwallet client with API credentials and program token
    $user = new User();
    $user->setClientUserId('hswiders');
    $user->setProfileType('INDIVIDUAL');
    $user->setFirstName('John');
    $user->setLastName('Doe');
    $user->setCountry('US');
    $user->setLanguage('en');
    $user->setEmail('hakim.webwiders@gmail.com');
    $user = $this->client->createUser($user);
    $userToken = $user->getToken();
    // Retrieve user's payment sources
    $paymentSources = $this->client->listPaymentSources($userToken);

    // Find the PayPal account token
    $paypalAccountToken = null;
    foreach ($paymentSources->getData() as $paymentSource) {
        if ($paymentSource->getType() === 'PAYPAL_ACCOUNT' && $paymentSource->getStatus() === 'ACTIVATED') {
            $paypalAccountToken = $paymentSource->getToken();
            break;
        }
    }

    if ($paypalAccountToken === null) {
        return  "No paypal found";
    }
    

    $transfer = new Transfer();
    $transfer->setClientTransferId($clientTransferId);
    $transfer->setDestinationToken($destinationToken);
    $transfer->setDestinationAmount($amount);
    $transfer->setDestinationCurrency($currency);
    $transfer->setSourceToken('paypal_account_token');

    return $this->client->createTransfer($transfer);
}

}
