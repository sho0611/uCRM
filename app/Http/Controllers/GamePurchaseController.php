<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoregamePurchaseRequest;
use App\Http\Requests\UpdategamePurchaseRequest;
use App\Models\game_Order;
use App\Models\gamePurchase;
use App\Models\gameCustomer;
use App\Models\Games;
use App\Models\Item;
use Inertia\Inertia;

class GamePurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
           //合計
           $orders = game_Order::groupBy('id', 'customer_name', 'status')
           ->selectRaw('id, customer_name, SUM(subtotal) as total, status, created_at')
           ->paginate(50);
    
    return Inertia::render('gamePurchase/Index', [
        'orders' => $orders 
    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = gameCustomer::select('id', 'name', 'kana')->get();
        $games = Games::select('id','name','price')->get();


        return Inertia::render('gamePurchase/Create', [
            'customers' => $customers,
            'items' => $games
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoregamePurchaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoregamePurchaseRequest $request)
    {
        //gamePurchaseテーブルへ
        $gamePurchase = gamePurchase::create([
            'game_customer_id' => $request->customer_id,
            'status' => $request->status
        ]);

        //中間テーブルへ
        foreach($request->items as $item){
            $gamePurchase->games()->attach($gamePurchase->id,[
                'games_id' => $item['id'],
                "quantity" => $item['quantity']
            ]);
        }
        return to_route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\gamePurchase  $gamePurchase
     * @return \Illuminate\Http\Response
     */
    public function show(gamePurchase $gamePurchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\gamePurchase  $gamePurchase
     * @return \Illuminate\Http\Response
     */
    public function edit(gamePurchase $gamePurchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdategamePurchaseRequest  $request
     * @param  \App\Models\gamePurchase  $gamePurchase
     * @return \Illuminate\Http\Response
     */
    public function update(UpdategamePurchaseRequest $request, gamePurchase $gamePurchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\gamePurchase  $gamePurchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(gamePurchase $gamePurchase)
    {
        //
    }
}
