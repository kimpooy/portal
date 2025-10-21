<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Eligibility extends Model
{
    use HasFactory;

    protected $table = 'eligibilities';

    protected $fillable = [
        'applicant_id',
        'eligbility_type',
        'rating',
        'exam_date',
        'exam_place',
        'license_number',
        'license_validity',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
