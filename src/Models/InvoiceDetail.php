<?php

namespace Bendt\Invoice\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Bendt\Invoice\Traits\BelongsToCreatedByTrait;
use Bendt\Invoice\Traits\BelongsToUpdatedByTrait;
use Bendt\Invoice\Traits\BelongsToDeletedByTrait;
use Bendt\Invoice\Traits\ScopeActiveTrait;

class InvoiceDetail extends BaseModel {

	use SoftCascadeTrait, SoftDeletes, BelongsToCreatedByTrait, BelongsToUpdatedByTrait, BelongsToDeletedByTrait, ScopeActiveTrait;

	protected $table = 'invoice_detail';

	protected $appends = ['total_price'];

	protected $files = [];

	const FILE_PATH = "/invoice_detail/";

	public function invoice() {
		return $this->belongsTo(Invoice::class);
	}

	public function getTotalPriceAttribute() {
		return $this->price*$this->quantity;
	}

}