<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelHub extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'url',
        'logo_path',
        'is_active',
        'sort_order',
    ];
}
