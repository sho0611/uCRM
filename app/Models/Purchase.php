<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Item;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',  
        'status'
    ];
  

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->belongsToMany(Item::class)
        ->withPivot('quantity');
    }

    public function scopeSearch($query, $search)
    {
        if (!empty($search)) {
            return $query->whereHas('customer', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    // 名前の曖昧検索
                    $query->where('name', 'like', '%' . $search . '%')
                          // カナによる曖昧検索
                          ->orWhere('kana', 'like', '%' . $search . '%');
                });
            });
        }
        return $query;
    }
    
}   
