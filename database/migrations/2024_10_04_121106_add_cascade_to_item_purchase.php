<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCascadeToItemPurchase extends Migration
{
    public function up()
    {
        Schema::table('item_purchase', function (Blueprint $table) {
            // 既存の外部キーを一旦削除してから、onDelete('cascade')を追加して再定義
            $table->dropForeign(['item_id']);
            $table->dropForeign(['purchase_id']);

            $table->foreign('item_id')
                  ->references('id')->on('items')
                  ->onUpdate('cascade')
                  ->onDelete('cascade'); // onDelete('cascade')を追加

            $table->foreign('purchase_id')
                  ->references('id')->on('purchases')
                  ->onUpdate('cascade')
                  ->onDelete('cascade'); // onDelete('cascade')を追加
        });
    }

    public function down()
    {
        Schema::table('item_purchase', function (Blueprint $table) {
            // 外部キーを元に戻す（onDelete('cascade')を削除）
            $table->dropForeign(['item_id']);
            $table->dropForeign(['purchase_id']);

            $table->foreign('item_id')
                  ->references('id')->on('items')
                  ->onUpdate('cascade');

            $table->foreign('purchase_id')
                  ->references('id')->on('purchases')
                  ->onUpdate('cascade');
        });
    }
}

