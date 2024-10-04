<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Purchase;
use App\Models\User;
use App\Models\gamePurchase;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ItemSeeder::class,
            RankSeeder::class,
            GamesSeeder::class
        ]);

        \App\Models\Customer::factory(100)->create();
        \App\Models\gameCustomer::factory(100)->create();

        
        $items = \App\Models\Item::all();

        Purchase::factory(30000)->create()
        //each 100件のデータから１件ずつ
        ->each(function(Purchase $purchase) use ($items) {
            //Purchase モデルと関連付けられた Item モデルのリレーションを取得
            $purchase->items()

            //中間テーブルにデータを挿入する
            ->attach(

                //$items コレクションから、1から3の範囲でランダムにアイテムを選択
                $items->random(rand(1, 3))
                
                //選択されたアイテムからidのみを取得する
                ->pluck('id')->toArray(),

                //中間テーブルに quantity（数量）をランダムに1から5の範囲で設定
                [ 'quantity' => rand(1, 5) ]
            );
        });

        $games = \App\Models\Games::all();
        
            gamePurchase::factory(30000)->create()
            ->each(function(gamePurchase $gamePurchase) use ($games){
            $gamePurchase->games()->attach(
            $games->random(rand(1,3))->pluck('id')->toArray(),
            // 1～3個のitemをpurchaseにランダムに紐づけ
            ['quantity' => rand(1, 5) ] ); });

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
