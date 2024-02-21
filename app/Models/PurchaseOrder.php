<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseOrder extends Model
{
  use HasFactory;

  /**
   * Get the company that owns the PurchaseOrder
   */
  public function company(): BelongsTo
  {
    return $this->belongsTo(Company::class);
  }
}
