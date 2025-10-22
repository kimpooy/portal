<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $applicant_id
 * @property string|null $address
 * @property string|null $house_no
 * @property string|null $street
 * @property string|null $subdivision
 * @property string|null $barangay
 * @property string|null $municipality
 * @property string|null $city
 * @property string|null $province
 * @property string $country
 * @property string|null $zip_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Applicant $applicant
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereApplicantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereBarangay($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereHouseNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereMunicipality($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereSubdivision($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Address whereZipCode($value)
 * @mixin \Eloquent
 */
class Address extends Model
{
  use HasFactory;

  protected $table = 'addresses';

    protected $fillable = [
            'applicant_id',
            'address',
            'house_no',
            'street',
            'subdivision',
            'barangay',
            'municipality',
            'city',
            'province',
            'country',
            'zip_code',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }
}
