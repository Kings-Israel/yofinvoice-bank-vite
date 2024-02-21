<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
  use HasFactory;

  /**
   * Get the program that owns the Invoice
   */
  public function program(): BelongsTo
  {
    return $this->belongsTo(Program::class);
  }

  /**
   * Get the company that owns the Invoice
   */
  public function company(): BelongsTo
  {
    return $this->belongsTo(Company::class);
  }
}
