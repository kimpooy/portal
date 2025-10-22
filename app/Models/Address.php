<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Address extends Model
{
  use HasFactory;

  protected $table = 'addresses';

    protected $fillable = [
            'applicant_id',
            'address',
            'house_no',
            'street',
            'subdivision',
            'barangay',
            'municipality',
            'city',
            'province',
            'country',
            'zip_code',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
