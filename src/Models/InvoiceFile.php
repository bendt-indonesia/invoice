<?php

namespace Bendt\Invoice\Models;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Bendt\Invoice\Traits\BelongsToCreatedByTrait;
use Bendt\Invoice\Traits\BelongsToUpdatedByTrait;
use Bendt\Invoice\Traits\BelongsToDeletedByTrait;
use Bendt\Invoice\Traits\ScopeActiveTrait;

class InvoiceFile extends BaseModel {

	use SoftCascadeTrait, SoftDeletes, BelongsToCreatedByTrait, BelongsToUpdatedByTrait, BelongsToDeletedByTrait, ScopeActiveTrait;

	protected $table = 'invoice_file';

	protected $appends = ['file_download_url'];

	protected $files = ['file_url'];

	const FILE_PATH = "/invoice_file/";

	public function invoice() {
		return $this->belongsTo(Invoice::class);
	}

	public function type_file() {
		return $this->belongsTo(config('bendt-invoice.class.option'),'type_file_id');
	}

	public function getFileDownloadUrlAttribute() {
		return asset('storage'.$this->file_url);
	}
}