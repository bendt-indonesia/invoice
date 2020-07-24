<?php

namespace Bendt\Invoice\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Bendt\Invoice\Traits\BelongsToCreatedByTrait;
use Bendt\Invoice\Traits\BelongsToUpdatedByTrait;
use Bendt\Invoice\Traits\BelongsToDeletedByTrait;
use Bendt\Invoice\Traits\ScopeActiveTrait;

class InvoicePayment extends BaseModel {

	use SoftCascadeTrait, SoftDeletes, BelongsToCreatedByTrait, BelongsToUpdatedByTrait, BelongsToDeletedByTrait, ScopeActiveTrait;

	protected $table = 'invoice_payment';

	protected $dates = ['payment_date'];

	protected $files = [];

	const FILE_PATH = "/invoice_payment/";

	public function invoice() {
		return $this->belongsTo(Invoice::class);
	}

	public function bank_payment() {
		return $this->belongsTo(BankPayment::class);
	}

	public function customer() {
		return $this->belongsTo(config('bendt-invoice.class.customer'),'customer_id');
	}

	public function payment_via() {
		return $this->belongsTo(config('bendt-invoice.class.option'),'payment_via_id');
	}

	public function payment_status() {
		return $this->belongsTo(config('bendt-invoice.class.option'),'payment_status_id');
	}

}