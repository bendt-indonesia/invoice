<?php

namespace Bendt\Invoice\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Bendt\Invoice\Traits\BelongsToCreatedByTrait;
use Bendt\Invoice\Traits\BelongsToUpdatedByTrait;
use Bendt\Invoice\Traits\BelongsToDeletedByTrait;
use Bendt\Invoice\Traits\ScopeActiveTrait;

class BankPayment extends BaseModel {

	use SoftCascadeTrait, SoftDeletes, BelongsToCreatedByTrait, BelongsToUpdatedByTrait, BelongsToDeletedByTrait, ScopeActiveTrait;

	protected $table = 'bank_payment';

	protected $files = [];

	const FILE_PATH = "/bank_payment/";

	public function bank() {
		return $this->belongsTo(config('bendt-invoice.class.option'),'bank_id');
	}

}