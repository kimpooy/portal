<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $first_name
 * @property string|null $middle_name
 * @property string $last_name
 * @property \App\Models\Address|null $address
 * @property string $phone_number
 * @property string $highest_education
 * @property string $email
 * @property string $civil_status
 * @property string $birth_date
 * @property string $religion
 * @property string $gender
 * @property string $pds
 * @property string|null $tor
 * @property string|null $diploma
 * @property string|null $eligibility_certificate
 * @property string|null $certificate_of_trainings
 * @property string|null $IPCR
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Application> $applications
 * @property-read int|null $applications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\EducationalBackground> $educations
 * @property-read int|null $educations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Eligibility> $eligibilities
 * @property-read int|null $eligibilities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\reference> $references
 * @property-read int|null $references_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\trainings> $trainings
 * @property-read int|null $trainings_count
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\workexperience> $workExperiences
 * @property-read int|null $work_experiences_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Applicant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Applicant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Applicant query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Applicant whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Applicant whereBirthDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Applicant whereCertificateOfTrainings($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Applicant whereCivilStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Applicant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Applicant whereDiploma($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Applicant whereEligibilityCertificate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Applicant whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Applicant whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Applicant whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Applicant whereHighestEducation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Applicant whereIPCR($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Applicant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Applicant whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Applicant whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Applicant wherePds($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Applicant wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Applicant whereReligion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Applicant whereTor($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Applicant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Applicant whereUserId($value)
 * @mixin \Eloquent
 */
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
