<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Purchasinfo;
use App\Models\gamePurchase;

class gameCustomer extends Model
{
    use HasFactory;
    protected $table = 'game_customers'; 

    protected $fillable =  ['name','kana','tel','email','postcode','address', 'birthday','gender', 'memo'];

    public function scopeSearchCustomers($query, $input = null)
    {
        if(!empty($input)){
         if(Customer::where('kana', 'like', $input . '%' )
           ->orWhere('tel', 'like', $input . '%')->exists())
     {
        return $query->where('kana', 'like', $input . '%' )
        ->orWhere('tel', 'like', $input . '%');
      }
    }
  }

  public function purchas_infos()
  {
    return $this->hasMany(Purchasinfo::class);
  }

  public function gamePurchase()
  {
    return $this->hasMany(Purchasinfo::class);
  }


}
