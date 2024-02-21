<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyUser extends Model
{
  use HasFactory;

  /**
     * Get the user that owns the CompanyUser
     */
    public function user(): BelongsTo
    {
      return $this->belongsTo(User::class);
    }

    /**
     * Get the company that owns the CompanyUser
     */
    public function company(): BelongsTo
    {
      return $this->belongsTo(Company::class);
    }
}
