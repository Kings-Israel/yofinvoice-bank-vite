<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgramDiscount extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'program_id',
    'benchmark_title',
    'benchmark_rate',
    'reset_frequency',
    'days_frequency_days',
    'business_strategy_spread',
    'credit_spread',
    'total_spread',
    'total_roi',
    'anchor_discount_bearing',
    'vendor_discount_bearing',
    'discount_type',
    'penal_discount_on_principle',
    'anchor_fee_recovery',
    'grace_period',
    'grace_period_discount',
    'maturity_handling_on_holidays',
  ];

  /**
   * Get the program that owns the ProgramCompanyRole
   */
  public function program(): BelongsTo
  {
    return $this->belongsTo(Program::class);
  }
}
