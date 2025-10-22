<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $applicant_id
 * @property string|null $level
 * @property string|null $school_name
 * @property string|null $degree_course
 * @property string|null $year_graduated
 * @property string|null $honors_received
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Applicant $applicant
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationalBackground newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationalBackground newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationalBackground query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationalBackground whereApplicantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationalBackground whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationalBackground whereDegreeCourse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationalBackground whereHonorsReceived($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationalBackground whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationalBackground whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationalBackground whereSchoolName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationalBackground whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EducationalBackground whereYearGraduated($value)
 * @mixin \Eloquent
 */
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
