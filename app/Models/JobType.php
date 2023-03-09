<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class JobType extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
    ];

    public function jobPost():HasOne
    {
        return $this->hasOne(JobPost::class);
    }
}
