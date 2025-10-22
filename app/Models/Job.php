<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'employment_type',
        'location',
        'salary',
        'salary_grade',
        'qualifications',
        'application_deadline',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

}
