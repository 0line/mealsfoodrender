<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderMeals extends Model
{
    use HasFactory;

    protected $table = 'ordermeals';

    protected $primaryKey = 'id';

    protected $fillable = [
        'fk_order',
        'fk_meal_id',
        'qty'
    ];

    public function order()
    {
        return $this->belongsTo(order::class, 'id', 'fk_order');
    }

    public function meal()
    {
        return $this->belongsToMany(OrderMeals::class);
    }
}
