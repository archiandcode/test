<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Knife extends Model
{
    protected $fillable = [
      'name', 'image', 'knife_type_id'
    ];

    public function knifeType(): BelongsTo
    {
        return $this->belongsTo(KnifeType::class);
    }

    public function listings(): HasMany
    {
        return $this->hasMany(Listing::class);
    }
}
