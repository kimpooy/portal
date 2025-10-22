<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

/**
 * @property int $id
 * @property int $applicant_id
 * @property string|null $reference_name
 * @property string|null $reference_adress
 * @property int|null $reference_contact_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Applicant $applicant
 * @method static \Illuminate\Database\Eloquent\Builder<static>|reference newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|reference newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|reference query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|reference whereApplicantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|reference whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|reference whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|reference whereReferenceAdress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|reference whereReferenceContactNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|reference whereReferenceName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|reference whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class reference extends Model
{
    use HasFactory;

    protected $table = 'reference';

    protected $fillable = [
        'applicant_id',
        'reference_name',
        'reference_address',
        'reference_contact_number',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
