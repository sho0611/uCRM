<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Purchase;
use Database\Seeders\ItemSeeder;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::select('id', 'name', 'kana')->get();
        $items = Item::select('id', 'name', 'price')->where('is_seling', true)->get();
        //dump($items);


        return Inertia::render('Purchases/Create',[
            'customers' => $customers,
            'items' => $items
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePurchaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseRequest $request)
    {
        DB::beginTransaction();
        try{
            //purchasesテーブルへ
        $purchase = Purchase::create([
            'customer_id' => $request->customer_id, // 修正
            'status' => $request->status
        ]);

        //中間テーブルへ($item.id, $item.quantity)
        foreach($request->items as $item){
            $purchase->items()->attach($purchase->id, [
                'item_id' => $item['id'],
                'quantity' => $item['quantity']
            ]);
        }
        DB::commit();
        return to_route('dashboard');

        } catch(\Exception $e){
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchaseRequest  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}