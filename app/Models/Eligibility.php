<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

/**
 * @property int $id
 * @property int $applicant_id
 * @property string|null $eligibility_type
 * @property float|null $rating
 * @property string|null $exam_date
 * @property string|null $exam_place
 * @property string|null $license_number
 * @property string|null $license_validity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Applicant $applicant
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Eligibility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Eligibility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Eligibility query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Eligibility whereApplicantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Eligibility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Eligibility whereEligibilityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Eligibility whereExamDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Eligibility whereExamPlace($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Eligibility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Eligibility whereLicenseNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Eligibility whereLicenseValidity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Eligibility whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Eligibility whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
