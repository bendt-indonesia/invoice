<?php

namespace Bendt\Invoice\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Bendt\Invoice\Traits\BelongsToCreatedByTrait;
use Bendt\Invoice\Traits\BelongsToUpdatedByTrait;
use Bendt\Invoice\Traits\BelongsToDeletedByTrait;
use Bendt\Invoice\Traits\ScopeActiveTrait;

use Bendt\Invoice\Enums\InvoiceStatus;
use Bendt\Invoice\Enums\PaymentStatus;

class Invoice extends BaseModel {

	use SoftCascadeTrait, SoftDeletes, BelongsToCreatedByTrait, BelongsToUpdatedByTrait, BelongsToDeletedByTrait, ScopeActiveTrait;

	protected $table = 'invoice';

	protected $softCascade = ['invoice_activity','invoice_report','invoice_detail','invoice_payment','invoice_file','invoice_bilyet'];

	protected $appends = ['outstanding', 'grand_total'];

	protected $dates = ['invoice_date','due_date','send_date','received_date'];

	protected $files = [];

	const FILE_PATH = "/invoice/";

	public function customer() {
	    $customerClass = config('bendt-invoice.class.customer');
		return $this->belongsTo($customerClass);
	}

	public function invoice_bilyet() {
		return $this->hasMany(InvoiceBilyet::class);
	}

	public function invoice_file() {
		return $this->hasMany(InvoiceFile::class);
	}

	public function invoice_detail() {
		return $this->hasMany(InvoiceDetail::class);
	}

	public function invoice_payment() {
		return $this->hasMany(InvoicePayment::class);
	}

	public function invoice_receipt() {
		return $this->belongsTo(config('bendt-invoice.class.option'),'invoice_receipt_id');
	}

	public function invoice_status() {
	    return $this->belongsTo(config('bendt-invoice.class.option'),'invoice_status_id');
	}

	//Append Fields
    public function getGrandTotalAttribute() {
        $grand_total = $this->sub_total - $this->discount_price +  $this->ppn_total;
        return $grand_total;
    }

    public function getOutstandingAttribute() {
        $total_paid = $this->total_paid ? $this->total_paid : 0;
        return $this->grand_total - $total_paid;
    }
    //========================


    public function getInvoicePaymentByStatus($payment_status) {
        $status = foption(PaymentStatus::KEY, $payment_status)['id'];

        return $this->hasMany(InvoicePayment::class)->where('payment_status_id',$status);
    }

    public function getInvoiceBillyetByStatus($statuses) {
        return $this->hasMany(InvoiceBilyet::class)->whereIn('giro_status_id',$statuses);
    }

    public function checkInvoiceStatus() {
        if($this->outstanding > 0) {
            $this->invoice_status_id = foption(InvoiceStatus::KEY, InvoiceStatus::UNPAID)['id'];
        } else {
            $this->invoice_status_id = foption(InvoiceStatus::KEY, InvoiceStatus::PAID)['id'];
        }

        $this->save();
    }

    public function recalculateInvoice() {
        if($this->is_ppn) {
            $this->ppn_total = 0.1 * ($this->sub_total - $this->discount_price);
        } else {
            $this->ppn_total = 0;
        }
        $this->ppn_total = floor($this->ppn_total);
        $this->save();
    }
}