<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class workexperience extends Model
{
    use HasFactory;
    protected $fillable = [
        'applicant_id',
        'company_name',
        'position_title',
        'status_of_appointment',
        'monthly_salary',
        'inclusive_date_start',
        'inclusive_date_end',
        'government_service',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
