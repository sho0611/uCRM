<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\gameCustomer;
use App\Models\Games;

class Purchasinfo extends Model
{
    use HasFactory;
    protected $table = 'purchas_infos';

    protected $filable = [
        'game_customer_id',
        'status',
        ];
}
