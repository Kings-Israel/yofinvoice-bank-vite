<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pipeline extends Model
{
  use HasFactory;

  protected $guarded = [];

  /**
   * The connection name for the model.
   *
   * @var string
   */
  protected $connection = 'crm';

  /**
   * Get all of the uploadedDocuments for the Pipeline
   */
  public function uploadedDocuments(): HasMany
  {
    return $this->hasMany(UploadedDocument::class, 'email', 'email');
  }
}
