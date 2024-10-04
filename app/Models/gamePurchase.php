<?php

namespace App\Models;

use App\Models\gameCustomer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Game;

class gamePurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_customer_id',
        'status',
        ];

    public function customer()
    {
      return $this->belongsTo(gamePurchase::class);
    }

    public function games()
   {
    return $this->belongsToMany(Games::class)
    ->withPivot('quantity');
    }

}
