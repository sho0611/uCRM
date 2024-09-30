<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Servises\AnalysisService;
use App\Servises\DecileService;

class AnalysisController extends Controller
{
    // form空の入力内容を受け取る
    public function index(Request $request)
    {
        $subQuery = Order::betweenDate($request->startDate, $request->endDate);

        if($request->type === 'perDay')
        {
            list($data, $labels, $totals) = AnalysisService::perDay($subQuery);
        }

        if($request->type === 'perMonth')
        {
            list($data, $labels, $totals) = AnalysisService::perMouth($subQuery);
        }

        if($request->type === 'perYear')
        {
            list($data, $labels, $totals) = AnalysisService::perYear($subQuery);
        }

        if($request->type === 'decile')
        {
            list($data, $labels, $totals) = DecileService::decile($subQuery);
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

