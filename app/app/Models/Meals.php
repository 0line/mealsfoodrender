<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Meals extends Model
{
    use HasFactory;

    protected $table = 'meals';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title_food',
        'description'
    ];

    public function order()
    {
        return $this->belongsToMany(OrderMeals::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(
            Ingredients::class,
            RelMealsIngredients::class,
            'fk_meal_id',
            'fk_ingredient_id'
        )->withPivot('qty_ingredient');
    }
}
