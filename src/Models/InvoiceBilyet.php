<?php

namespace Bendt\Invoice\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Bendt\Invoice\Traits\BelongsToCreatedByTrait;
use Bendt\Invoice\Traits\BelongsToUpdatedByTrait;
use Bendt\Invoice\Traits\BelongsToDeletedByTrait;
use Bendt\Invoice\Traits\ScopeActiveTrait;

class InvoiceBilyet extends BaseModel {

	use SoftCascadeTrait, SoftDeletes, BelongsToCreatedByTrait, BelongsToUpdatedByTrait, BelongsToDeletedByTrait, ScopeActiveTrait;

	protected $table = 'invoice_bilyet';

	protected $dates = ['bilyet_date'];

	protected $files = [];

	const FILE_PATH = "/invoice_bilyet/";

	public function bank_payment() {
		return $this->belongsTo(BankPayment::class);
	}

	public function invoice() {
		return $this->belongsTo(Invoice::class);
	}

	public function giro_status() {
		return $this->belongsTo(config('bendt-invoice.class.option'),'giro_status_id');
	}

}