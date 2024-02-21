<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramVendorConfiguration extends Model
{
  use HasFactory;

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'request_auto_finance' => 'bool',
    'auto_approve_finance' => 'bool',
  ];

  /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = [];

  /**
   * Get the program that owns the ProgramVendorBankDetail
   */
  public function program(): BelongsTo
  {
    return $this->belongsTo(Program::class);
  }

  /**
   * Get the company that owns the ProgramVendorBankDetail
   */
  public function company(): BelongsTo
  {
    return $this->belongsTo(Company::class);
  }
}
