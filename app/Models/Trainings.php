<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class trainings extends Model
{
    use HasFactory;
    protected $fillable = [
        'applicant_id',
        'title_of_training',
        'training_date_start',
        'training_date_end',
        'number_of_hours',
        'conducted_by',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}

