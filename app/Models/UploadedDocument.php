<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UploadedDocument extends Model
{
  use HasFactory;

  protected $guarded = [];

  /**
   * The table associated with the model.
   *
   * @var string
   */
  protected $table = 'upload_documents';

  /**
   * The connection name for the model.
   *
   * @var string
   */
  protected $connection = 'crm';

  /**
   * Get all of the documents for the UploadDocument
   */
  public function companyDocuments(): HasMany
  {
    return $this->hasMany(Document::class, 'uuid', 'slug');
  }

  /**
   * Get the pipeline that owns the UploadDocument
   */
  public function pipeline(): BelongsTo
  {
    return $this->belongsTo(Pipeline::class, 'email', 'email');
  }
}
