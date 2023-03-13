<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SeekerProfile extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'firstname',
        'lastname',
        'location',
        'contact_number',
        'qualification',
        'college',
        'cv',
        'about',
        'description',
        'experience',
        'image',
        'status',
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function skill(): BelongsToMany
    {
        return $this->belongsToMany(skill::class, 'seeker_skills','seeker_id','skill_id');
    }
    public function application(): HasMany
    {
        return $this->hasMany(Application::class);
    }
}
