<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
  use HasFactory;

  /**
   * The connection name for the model.
   *
   * @var string
   */
  protected $connection = 'crm';

  /**
   * Get the uploadedDocument that owns the Document
   */
  public function uploadedDocument(): BelongsTo
  {
    return $this->belongsTo(UploadedDocument::class, 'uuid', 'slug');
  }

  public function resolveStatus(): string
  {
    switch ($this->status) {
      case 'accepted':
        return 'bg-label-success';
        break;
      case 'rejected':
        return 'bg-label-danger';
        break;
      default:
        return 'bg-label-primary';
        break;
    }
  }
}
