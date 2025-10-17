<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',

        'first_name',
        'middle_name',
        'last_name',
        'address',
        'house_number',
        'street',
        'subdivision',
        'barangay',
        'municipality',
        'city',
        'province',
        'country',
        'zip_code',
        'phone_number',
        'email',
        'highest_education',
        'experience',
        'civil_status',
        'birth_date',
        'Religion',
        'gender',

        'eligibility',
        'eligibility_rating',
        'eligibility_date',
        'license_number',

        'Inclusive_date_start',
        'Inclusive_date_end',
        'company_name',
        'Position_title',
        'status_of_appointment',
        'monthly_salary',
        'government_service',


        'title_of_training',
        'training_date_start',
        'training_date_end',
        'number_of_hours',
        'conducted_by',


        'pds',
        'tor',
        'diploma',
        'eligibility_certificate',
        'certificate_of_trainings',
        'IPCR',

        'reference_name',
        'reference_address',
        'reference_phone',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
    public function educations()
    {
        return $this->hasMany(EducationalBackground::class);
    }

}
