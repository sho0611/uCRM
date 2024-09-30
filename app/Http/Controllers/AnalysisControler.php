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
        return Inertia::render('Analysis');
    }
}
