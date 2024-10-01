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
        $startDate = '2024-08-01';
        $endDate = '2024-09-10';

        return Inertia::render('Analysis');
    }
}
