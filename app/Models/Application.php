<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'seeker_id',
        'post_id',
        'status',
        'link',
    ];

    public function seekerProfile():BelongsTo
    {
        return $this->belongsTo(SeekerProfile::class,'seeker_id','id');
    }

        public function jobPost():BelongsTo
    {
        return $this->belongsTo(JobPost::class, 'post_id', 'id');
    }
}
