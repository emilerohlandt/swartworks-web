<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Material extends Model
{
    use HasFactory;

    protected $fillable = ['material_category_id', 'name', 'colors'];

    protected $casts = [
        'colors' => 'array',
    ];

    // Predefined available colors across all materials
    public static array $availableColors = [
        'Black', 'White', 'Grey', 'Red', 'Blue',
        'Green', 'Yellow', 'Orange', 'Purple', 'Silver', 'Gold', 'Brown', 'Multi-Colour', 'Transparent', 'Carbon-Fibre'
    ];

    /**
     * Map color names to Hex values for visual UI badges/dots.
     */
    public static array $colorHexMap = [
        'Black'  => '#18181b',
        'White'  => '#f4f4f5',
        'Grey'   => '#64748b',
        'Red'    => '#ef4444',
        'Blue'   => '#3b82f6',
        'Green'  => '#22c55e',
        'Yellow' => '#eab308',
        'Orange' => '#f97316',
        'Purple' => '#a855f7',
        'Silver' => '#9ca3af',
        'Gold'   => '#f59e0b',
        'Brown'        => '#78350f',
        'Multi-Colour' => 'linear-gradient(135deg, #ef4444, #3b82f6, #22c55e)',
        'Transparent'  => 'transparent',
        'Carbon-Fibre'  => '#666666',
    ];

    /**
     * Services assigned to this material.
     */
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class);
    }

    public function category()
    {
        return $this->belongsTo(MaterialCategory::class, 'material_category_id');
    }
}
