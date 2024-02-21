<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'unique_identification_number',
    'branch_code',
    'business_identification_number',
    'organization_type',
    'business_segment',
    'customer_type',
    'kra_pin',
    'cust_ancode',
    'logo',
    'city',
    'postal_code',
    'address',
    'relationship_manager_name',
    'relationship_manager_email',
    'relationship_manager_phone_number',
    'pipeline_id'
  ];

  /**
   * Get the logo
   *
   * @param  string  $value
   * @return string
   */
  public function getLogoAttribute($value)
  {
    return $value;
  }

  /**
   * Get the bank that owns the Company
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function bank(): BelongsTo
  {
    return $this->belongsTo(Bank::class);
  }

  /**
   * The users that belong to the Company
   */
  public function users(): BelongsToMany
  {
    return $this->belongsToMany(User::class, 'company_users', 'user_id', 'company_id');
  }

  /**
   * Get all of the documents for the Company
   */
  public function documents(): HasMany
  {
    return $this->hasMany(CompanyDocument::class);
  }

  /**
   * Get all of the requestedDocuments for the Company
   */
  public function requestedDocuments(): HasMany
  {
    return $this->hasMany(RequestDocument::class);
  }

  /**
   * Get all of the programDiscountDetails for the Program
   */
  public function programDiscountDetails(): HasMany
  {
    return $this->hasMany(ProgramVendorDiscount::class);
  }

  /**
   * Get all of the programFeeDetails for the Program
   */
  public function programFeeDetails(): HasMany
  {
    return $this->hasMany(ProgramVendorFee::class);
  }

  /**
   * Get all of the programConfigurations for the Program
   */
  public function programConfigurations(): HasMany
  {
    return $this->hasMany(ProgramVendorConfiguration::class);
  }

  /**
   * Get all of the programBankDetails for the Program
   */
  public function programBankDetails(): HasMany
  {
    return $this->hasMany(ProgramVendorBankDetail::class);
  }

  /**
   * Get all of the programContactDetails for the Program
   */
  public function programContactDetails(): HasMany
  {
    return $this->hasMany(ProgramVendorContactDetail::class);
  }

  /**
   * Get all of the roles for the Company
   */
  public function roles(): HasManyThrough
  {
    return $this->hasManyThrough(ProgramRole::class, ProgramCompanyRole::class, 'company_id', 'id');
  }

  /**
   * Get the pipeline associated with the Company
   */
  public function pipeline(): HasOne
  {
      return $this->hasOne(Pipeline::class, 'id', 'pipeline_id');
  }

  public function getProgramLimit(Program $program)
  {
    return $this->programConfigurations()->where('program_id', $program->id)->first()->sanctioned_limit;
  }

  public function resolveApprovalStatus(): string
  {
    switch ($this->approval_status) {
      case 'pending':
        return 'bg-label-primary';
        break;
      case 'approved':
        return 'bg-label-success';
        break;
      case 'rejected':
        return 'bg-label-danger';
        break;
      default:
        return 'bg-label-secondary';
        break;
    }
  }

  public function resolveStatus(): string
  {
    switch ($this->approval_status) {
      case 'active':
        return 'bg-label-primary';
        break;
      case 'inactive':
        return 'bg-label-secondary';
        break;
      default:
        return 'bg-label-primary';
        break;
    }
  }
}
