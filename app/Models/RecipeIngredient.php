<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecipeIngredient extends Model
{
    /**
     * Tarif malzemesi modeli - Tarif malzemelerini ayrıntılı olarak yönetir
     */
    
    protected $fillable = [
        'recipe_id',
        'name',
        'amount',
        'unit',
        'notes',
        'sort_order',
        'is_optional'
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_optional' => 'boolean'
    ];

    /**
     * Bu malzemenin ait olduğu tarif
     */
    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }

    /**
     * Malzeme bilgisini tam format ile getir
     */
    public function getFullDescriptionAttribute()
    {
        $description = $this->amount;
        if ($this->unit) {
            $description .= ' ' . $this->unit;
        }
        $description .= ' ' . $this->name;
        if ($this->notes) {
            $description .= ' (' . $this->notes . ')';
        }
        if ($this->is_optional) {
            $description .= ' (isteğe bağlı)';
        }
        return $description;
    }
}
