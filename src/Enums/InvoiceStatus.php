<?php
/*
 *
  ____                 _ _     _____           _                       _
 |  _ \               | | |   |_   _|         | |                     (_)
 | |_) | ___ _ __   __| | |_    | |  _ __   __| | ___  _ __   ___  ___ _  __ _
 |  _ < / _ \ '_ \ / _` | __|   | | | '_ \ / _` |/ _ \| '_ \ / _ \/ __| |/ _` |
 | |_) |  __/ | | | (_| | |_   _| |_| | | | (_| | (_) | | | |  __/\__ \ | (_| |
 |____/ \___|_| |_|\__,_|\__| |_____|_| |_|\__,_|\___/|_| |_|\___||___/_|\__,_|

 Please don't modify this file because it may be overwritten when re-generated.
 */

namespace Bendt\Invoice\Enums;

class InvoiceStatus extends EnumClass
{
    const KEY = 'invoice-status';

    const DRAFT = 0,
        TAX_PENDING = 1,
        UNPAID = 2,
        GIRO_ACCEPTED = 3,
        PARTIAL_PAID = 4,
        PAID = 5,
        CANCELLED = 99;

    public static $STATUS_LIST = [

    ];
}
