<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\gamePurchase;

class Games extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'memo',
        'price',
    ];

    public function purchases()
    {
        return $this->belongsToMany(gamePurchase::class)
        ->withPivot('quantity');
    }
}