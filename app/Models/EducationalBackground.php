<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class EducationalBackground extends Model
{
    use HasFactory;

    protected $fillable = [
        'applicant_id',
        'level',
        'school_name',
        'degree_course',
        'year_graduated',
        'honors_received',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
