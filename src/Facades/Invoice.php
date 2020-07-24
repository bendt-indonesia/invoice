<?php

namespace Bendt\Invoice\Facades;

use Illuminate\Support\Facades\Facade;

class Invoice extends Facade
{
    protected static function getFacadeAccessor() { return 'invoiceManager'; }
}
