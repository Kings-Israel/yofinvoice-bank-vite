<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

class Program extends Model
{
  use HasFactory;

  /**
   * The attributes that should be cast to native types.
   *
   * @var array
   */
  protected $casts = [
    'request_auto_finance' => 'bool',
    'auto_debit_anchor_financed_invoices' => 'bool',
    'auto_debit_anchor_non_financed_invoices' => 'bool',
    'anchor_can_change_due_date' => 'bool',
    'anchor_can_change_payment_term' => 'bool',
    'mandatory_invoice_attachment' => 'bool',
  ];

  /**
   * The attributes that aren't mass assignable.
   *
   * @var array
   */
  protected $guarded = [];

  /**
   * Get the programType that owns the Program
   */
  public function programType(): BelongsTo
  {
    return $this->belongsTo(ProgramType::class);
  }

  /**
   * Get the programCode that owns the Program
   */
  public function programCode(): BelongsTo
  {
    return $this->belongsTo(ProgramCode::class);
  }

  /**
   * Get the bank that owns the Program
   */
  public function bank(): BelongsTo
  {
    return $this->belongsTo(Bank::class);
  }

  /**
   * Get all of the companies for the Program
   */
  public function companies(): HasManyThrough
  {
    return $this->hasManyThrough(Company::class, ProgramCompanyRole::class, 'program_id', 'id');
  }

  /**
   * Get the discountDetails associated with the Program
   */
  public function discountDetails(): HasOne
  {
    return $this->hasOne(ProgramDiscount::class);
  }

  /**
   * Get all of the fees for the Program
   */
  public function fees(): HasMany
  {
    return $this->hasMany(ProgramFee::class);
  }

  /**
   * Get all of the anchorDetails for the Program
   */
  public function anchorDetails(): HasMany
  {
    return $this->hasMany(ProgramAnchorDetails::class);
  }

  /**
   * Get all of the bankUserDetails for the Program
   */
  public function bankUserDetails(): HasMany
  {
    return $this->hasMany(ProgramBankUserDetails::class);
  }

  /**
   * Get all of the bankDetails for the Program
   */
  public function bankDetails(): HasMany
  {
    return $this->hasMany(ProgramBankDetails::class);
  }

  /**
   * Get all of the vendorDiscountDetails for the Program
   */
  public function vendorDiscountDetails(): HasMany
  {
    return $this->hasMany(ProgramVendorDiscount::class);
  }

  /**
   * Get all of the vendorFeeDetails for the Program
   */
  public function vendorFeeDetails(): HasMany
  {
    return $this->hasMany(ProgramVendorFee::class);
  }

  /**
   * Get all of the vendorConfigurations for the Program
   */
  public function vendorConfigurations(): HasMany
  {
    return $this->hasMany(ProgramVendorConfiguration::class);
  }

  /**
   * Get all of the vendorBankDetails for the Program
   */
  public function vendorBankDetails(): HasMany
  {
    return $this->hasMany(ProgramVendorBankDetail::class);
  }

  /**
   * Get all of the vendorContactDetails for the Program
   */
  public function vendorContactDetails(): HasMany
  {
    return $this->hasMany(ProgramVendorContactDetail::class);
  }

  public function getAnchor(): Company|NULL
  {
    $company = NULL;

    $anchor_role = ProgramRole::where('name', 'anchor')->first();

    $anchor_id = ProgramCompanyRole::where('role_id', $anchor_role->id)->where('program_id', $this->id)->first()->company_id;

    if ($anchor_id) {
      $company = Company::find($anchor_id);
    }

    return $company;
  }

  public function getVendors(): Collection
  {
    $vendor_role = ProgramRole::where('name', 'vendor')->first();

    $vendors_ids = ProgramCompanyRole::where('role_id', $vendor_role->id)->where('program_id', $this->id)->get()->pluck('company_id');

    return Company::whereIn('id', $vendors_ids)->get();
  }
}