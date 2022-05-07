<?php

namespace Kasipay\Rave\Facades;

use Illuminate\Support\Facades\Facade;
use Kasipay\Rave\Helpers\Banks;
use Kasipay\Rave\Helpers\Beneficiary;
use Kasipay\Rave\Helpers\Payments;
use Kasipay\Rave\Helpers\Transfers;

/**
 * Class Rave
 *
 * @method static string generateReference(String $transactionPrefix = null)
 * @method static object initializePayment(array $data)
 * @method static string getTransactionIDFromCallback()
 * @method static object verifyTransaction(string $transactionId)
 * @method static bool verifyWebhook()
 * @method static Payments payments()
 * @method static Banks banks()
 * @method static Transfers transfers()
 * @method static Beneficiary beneficiaries()
 *
 * @see \Kasipay\Rave\Rave
 *
 */
class Rave extends Facade
{
    /**
     * Get the registered name of the component
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravelrave';
    }
}
