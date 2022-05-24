<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredients extends Model
{
    use HasFactory;

    protected $table = 'ingredients';

    protected $primaryKey = 'id';

    protected $fillable = [
        'ingredient',
        'qty'
    ];


    public function purcheseHistory()
    {
        return $this->belongsTo(PurchaseHistory::class);
    }

    public function meal()
    {
        return $this->belongsToMany(Meals::class, RelMealsIngredients::class, 'fk_ingredient_id', 'fk_meal_id');
    }
}
