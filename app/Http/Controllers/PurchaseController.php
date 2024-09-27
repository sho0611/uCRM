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
use App\Models\Order;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::groupBy('id')
        ->selectRaw('id, sum(subtotal) as total , 
        customer_name, status, created_at')
        ->paginate(50);

        return Inertia::render('Purchases/Index', [
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
        //小計
        $items = Order::where('id', $purchase->id)->get();

        //合計
        $order = Order::groupBy('id')
        ->where('id', $purchase->id)
        ->selectRaw('id, sum(subtotal) as total , 
        customer_name, status, created_at, updated_at')
        ->get();

        return Inertia::render('Purchases/Show', [
            'items' => $items,
            'order' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //idのみを取得
        $purchase = Purchase::find($purchase->id);
        //Itemから取得
        $allItems = Item::select('id', 'name', 'price')
        ->get();
        //データ挿入用の空の配列を作成
        $items = [];

        foreach($allItems as $allItem){
            //初期値
            $quantity = 0;

            //中間テーブルに入っているものを一つずつテェック
            foreach($purchase->items as $item){
                //中間テーブルにidが存在していたら
                if($allItem->id === $item->id){
                    //quantityの情報を中間テーブルのものに入れ配列に追加する
                    //なかったら初期値のままとする
                    $quantity = $item->pivot->quantity;
                }
            }
            //連想配列で追加
            array_push($items, [
                'id' => $allItem->id,
                'name' => $allItem->name,
                'price' => $allItem->price,
                'quantity' => $quantity,
            ]);
        }   

        $order = Order::groupBy('id')
        ->where('id', $purchase->id)
        ->selectRaw('id, customer_id, 
        customer_name, status, created_at')
        ->get();


        return Inertia::render('Purchases/Edit', [
            'items' => $items,
            'order' => $order
        ]);
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
        DB::beginTransaction();

        try {
        //purchaseはApp\models\purchase -> purchases
        //ステータスの上書き
        $purchase->status = $request->status;
        $purchase->save();

        //これがsyncに入る
        $items = [];

        //中間テーブルへ変更を挿入
        foreach($request->items as $item){
            $items = $items + [
                $item['id'] => [
                    'quantity' => $item['quantity']

                ]
            ];
        }
        $purchase->items()->sync($items);

        DB::commit();
        return to_route('dashboard');
     } catch(\Exception $e) {
        DB::rollBack();
     }
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
