<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('kana');
            $table->string('tel')->unique();
            $table->string('email');
            $table->string('postcode');
            $table->string('address');
            $table->date('birthday')->nullable(); // 修正: nullable()に変更
            $table->tinyInteger('gender'); // 0男性, 1女性、2その他
            $table->text('memo')->nullable(); // 修正: nullable()に変更
            $table->timestamps();
        });        
    }
       
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_customers');
    }
};
