<?php
namespace App\Servises;
use Illuminate\Support\Facades\DB;

class AnalysisService
{
    public static function perDay($subQuery)
    {
            $query = $subQuery     
                //販売しているもののみ取得
                ->where('status', true)
                //id毎にグループ化
                ->groupBy('id')
                ->selectRaw('id, SUM(subtotal) as totalPerPurchase,
                DATE_FORMAT(created_at, "%Y%m%d") as date');

            //2. サブクエリをgroupByで日毎にまとめる
            $data = DB::table($query)
                ->groupBy('date')
                ->selectRaw('date, SUM(totalPerPurchase) as total')
                ->get();

                $labels = $data->pluck('date');
                $totals = $data->pluck('total');

            return [$data, $labels, $totals];
    }

    public static function perMouth($subQuery)
    {
            $query = $subQuery     
                //販売しているもののみ取得
                ->where('status', true)
                //id毎にグループ化
                ->groupBy('id')
                //%Y%m→年/月
                ->selectRaw('id, SUM(subtotal) as totalPerPurchase,
                DATE_FORMAT(created_at, "%Y%m") as date');

            //2. サブクエリをgroupByで日毎にまとめる
            $data = DB::table($query)
                ->groupBy('date')
                ->selectRaw('date, SUM(totalPerPurchase) as total')
                ->get();

                $labels = $data->pluck('date');
                $totals = $data->pluck('total');

            return [$data, $labels, $totals];
    }

    public static function perYear($subQuery)
    {
            $query = $subQuery     
                //販売しているもののみ取得
                ->where('status', true)
                //id毎にグループ化
                ->groupBy('id')
                //%Y->年
                ->selectRaw('id, SUM(subtotal) as totalPerPurchase,
                DATE_FORMAT(created_at, "%Y") as date');

            //2. サブクエリをgroupByで日毎にまとめる
            $data = DB::table($query)
                ->groupBy('date')
                ->selectRaw('date, SUM(totalPerPurchase) as total')
                ->get();

                $labels = $data->pluck('date');
                $totals = $data->pluck('total');

            return [$data, $labels, $totals];
    }
}
