<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'description',
        'image_path',
        'callout_text',
        'badge_text',
    ];

    public function materials(): BelongsToMany
    {
        return $this->belongsToMany(Material::class);
    }
}
