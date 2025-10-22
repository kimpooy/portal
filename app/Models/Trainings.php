<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

/**
 * @property int $id
 * @property int $applicant_id
 * @property string|null $title_of_training
 * @property string|null $training_date_start
 * @property string|null $training_date_end
 * @property int|null $number_of_hours
 * @property string|null $conducted_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Applicant $applicant
 * @method static \Illuminate\Database\Eloquent\Builder<static>|trainings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|trainings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|trainings query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|trainings whereApplicantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|trainings whereConductedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|trainings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|trainings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|trainings whereNumberOfHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|trainings whereTitleOfTraining($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|trainings whereTrainingDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|trainings whereTrainingDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|trainings whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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

