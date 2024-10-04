<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\game_Subtotal;
use Illuminate\Support\Carbon;

class game_Order extends Model
{
    use HasFactory;

    protected static function booted()
{
    static::addGlobalScope(new game_Subtotal);
}

public function scopeBetweenDate($query, $startDate = null, $endDate = null)
{

//開始日が指定されていない/終了日が指定されている//
if(is_null($startDate) && !is_null($endDate))
{
//created_atカラムがしてされた終了日以前のレコード
$endDate1 = Carbon::parse($endDate)->addDays(1);
return $query->where('created_at', '<=', $endDate1);
}


//両方指定されている場合//
if(!is_null($startDate) && !is_null($endDate))
{
//created_atが指定された開始日から終了日までのレコードを取得
$endDate1 = Carbon::parse($endDate)->addDays(1);
return $query->where('created_at', ">=", $startDate)
->where('created_at', '<=', $endDate1);
}
}



}
