<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Knife extends Model
{
    protected $fillable = [
      'name', 'image', 'knife_type_id'
    ];

    public function knifeType(): BelongsTo
    {
        return $this->belongsTo(KnifeType::class);
    }
}
