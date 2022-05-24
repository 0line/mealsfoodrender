<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PurchaseHistory extends Model
{
    use HasFactory;

    protected $table = 'purchase_history';

    protected $primaryKey = 'id';

    protected $fillable = [
        'fk_ingredient_id',
        'qty'
    ];

    public function ingredient()
    {
        return $this->hasOne(Ingredients::class);
    }
}
