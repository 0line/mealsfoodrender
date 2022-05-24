<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RelMealsIngredients extends Pivot
{
    use HasFactory;
    public $incrementing = true;

    protected $table = 'rel_meals_ingredients';

    protected $primaryKey = 'id';

    protected $fillable = [
        'fk_meal_id',
        'fk_ingredient_id',
        'qty_ingredient'
    ];
}
