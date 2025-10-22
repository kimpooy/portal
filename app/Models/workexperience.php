<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $applicant_id
 * @property string|null $company_name
 * @property string|null $position_title
 * @property string|null $status_of_appointment
 * @property float|null $monthly_salary
 * @property string|null $inclusive_date_start
 * @property string|null $inclusive_date_end
 * @property int $government_service
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Applicant $applicant
 * @method static \Illuminate\Database\Eloquent\Builder<static>|workexperience newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|workexperience newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|workexperience query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|workexperience whereApplicantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|workexperience whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|workexperience whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|workexperience whereGovernmentService($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|workexperience whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|workexperience whereInclusiveDateEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|workexperience whereInclusiveDateStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|workexperience whereMonthlySalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|workexperience wherePositionTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|workexperience whereStatusOfAppointment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|workexperience whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class workexperience extends Model
{
    use HasFactory;

    protected $table ='work_experience';
    
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
