<?php

namespace App\Services;

use Bendt\Invoice\Models\Invoice;
use Bendt\Invoice\Models\InvoicePayment;

use App\Models\CustomerBalance;
use App\Models\Issuing;
use App\Models\Job;
use App\Models\JobAdvice;
use App\Models\JobMi;
use App\Models\Receiving;
use App\Models\Requisition;
use App\Models\StockOpname;
use App\Models\Survey;
use App\Models\Quotation;
use App\Models\Contract;

use App\Models\UserActivity;
use App\Models\LostUnit;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class NumberingService
{
    protected static $length = 4;

    public static function baseReplace($key, $branchCode = false, $year = null, $month = null)
    {
        if($branchCode === false) {
            $branchCode = 'JKT';
        }

        $replace_year = $year !== null ? $year : date('y');
        $replace_month = $month !== null ? $month : date('m');

        $format = self::$format[$key];
        $format = str_replace('BBB', $branchCode, $format);
        $format = str_replace('YY', $replace_year, $format);
        $format = str_replace('MM', $replace_month, $format);
        return $format;
    }

    public static function invoice_no($branch_code = false, $year = null, $month = null)
    {
        $format = self::baseReplace('invoice_no', $branch_code, $year, $month);

        $last = Invoice::withTrashed()->where('invoice_no','like',$format.'%')->count();

        return $format.str_pad(++$last, self::$length, '0', STR_PAD_LEFT);
    }

    public static function giro_receipt_no($branch_code = false, $year = null, $month = null)
    {
        $format = self::baseReplace('giro_receipt_no', $branch_code, $year, $month);

        $last = InvoicePayment::withTrashed()->where('receipt_no','like',$format.'%')->count();

        return $format.str_pad(++$last, self::$length, '0', STR_PAD_LEFT);
    }

    public static function receipt_no($branch_code = false, $year = null, $month = null)
    {
        $format = self::baseReplace('receipt_no', $branch_code, $year, $month);

        $last = CustomerBalance::withTrashed()->where('transaction_no','like',$format.'%')->count();

        return $format.str_pad(++$last, self::$length, '0', STR_PAD_LEFT);
    }

    public static function va_receipt_no($branch_code = false, $year = null, $month = null)
    {
        $format = self::baseReplace('va_receipt_no', $branch_code, $year, $month);

        $last = CustomerBalance::withTrashed()->where('transaction_no','like',$format.'%')->count();

        return $format.str_pad(++$last, self::$length, '0', STR_PAD_LEFT);
    }
}
