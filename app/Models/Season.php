<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        "number"
    ];

    public function episodes(): HasMany
    {
        return $this->hasMany(Episode::class);
    }

    public function anime()
    {
        return $this->belongsTo(Anime::class);
    }
}
