<?php

namespace Bendt\Invoice\Seeder;

use Bendt\Invoice\Models\BankPayment as BankPayment;

class BankPaymentSeeder
{
    /**
     * Option Helper
     *
     * @param array $data
     *
     * @return BankPayment;
     */

    public static function seed($data)
    {
        $bank = new BankPayment($data);
        $bank->process();
        return $bank;
    }
}
