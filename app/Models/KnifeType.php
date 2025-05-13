<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KnifeType extends Model
{
    protected $fillable = [
        'name',
    ];

    public function knives(): HasMany
    {
        return $this->hasMany(Knife::class);
    }

    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class);
    }
}
