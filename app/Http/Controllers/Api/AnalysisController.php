<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AnalysisController extends Controller
{
    // form空の入力内容を受け取る
    public function index(Request $request)
    {
        $subQuery = Order::betweenDate($request->startDate, $request->endDate);

        if($request->type === 'perDay')
        {
            $subQuery     
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

            $labels = $data->pluck('date');
            $totals = $data->pluck('total');

        }

        // Ajax通信なのでJsonで返却する必要がある
        return response()->json([
            'data' => $data,
            'type' => $request->type,
            'labels' => $labels,
            'totals' => $totals
        ], Response::HTTP_OK);
    }
}

