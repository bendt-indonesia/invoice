<?php

namespace Bendt\Invoice\Enums;

class PaymentStatus extends EnumClass
{
    const KEY = 'payment-status';

    const SETTLED = 1,
        CANCELLED = 2;

    public static $STATUS_LIST = [

    ];
}
