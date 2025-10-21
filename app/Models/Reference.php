<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class reference extends Model
{
    use HasFactory;
    protected $fillable = [
        'applicant_id',
        'reference_name',
        'reference_address',
        'reference_contact_number',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
