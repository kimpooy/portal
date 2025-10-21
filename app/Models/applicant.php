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
        'phone_number',
        'email',
        'highest_education',
        'experience',
        'civil_status',
        'birth_date',
        'religion',
        'gender',

        'pds',
        'tor',
        'diploma',
        'eligibility_certificate',
        'certificate_of_trainings',
        'IPCR',

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
    public function eligibilities()
    {
        return $this->hasMany(Eligibility::class);
    }
    public function workExperiences()
    {
        return $this->hasMany(workExperience::class);
    }
    public function trainings()
    {
        return $this->hasMany(Trainings::class);
    }
    public function references()
    {
        return $this->hasMany(Reference::class);
    }
    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
