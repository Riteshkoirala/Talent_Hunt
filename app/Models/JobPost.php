<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobPost extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'uuid',
        'recruiter_id',
        'title',
        'location',
        'deadline',
        'type_id',
        'qualification',
        'experience',
        'vacancy',
        'description',
        'responsibility',
        'benefit',
    ];

    public function recruiterProfile():HasOne
    {
        return $this->hasOne(RecruiterProfile::class,'id','recruiter_id');
    }

    public function application(): HasMany
    {
        return $this->hasMany(Application::class, 'post_id', 'id');
    }

    public function jobType():HasOne
    {
        return $this->hasOne(JobType::class,'id','type_id');
    }

    public function postSkill():BelongsToMany
    {
        return $this->belongsToMany(skill::class,'post_skills','post_id','skill_id');
    }

}
