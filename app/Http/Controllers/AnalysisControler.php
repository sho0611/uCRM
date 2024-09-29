<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class AnalysisControler extends Controller
{
    public function index()
    {
        $startDate = '2022-08-01';
        $endDate = '2022-08-10';

        //1. 購買id毎の売上をまとめ, dateをフォーマットした状態のサブクエリをつくる
        $subQuery = Order::BetweenDate($startDate, $endDate)
        //販売しているもののみ取得
        ->where('status', true)
        //id毎にグループ化
        ->groupBy('id')
        ->selectRaw('id, SUM(subtotal) as totalPerPurchase,
        DATE_FORMAT(created_at, "%Y%m%d") as date');

        //2. サブクエリをgroupByで日毎にまとめる
        $data = DB::table($subQuery)
        ->groupBy('date')
        ->selectRaw('date, SUM(totalPerPurchase) as total')
        ->get();

        return Inertia::render('Analysis');
    }
}
