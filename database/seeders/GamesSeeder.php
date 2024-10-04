<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    DB::table('games')->insert([
        ['name' => 'モンハン', 'memo' => 'オープンワールド', 'price' => 9000],
        ['name' => 'ファイナルファンタジー', 'memo' => 'RPG', 'price' => 8000],
        ['name' => 'ゼルダの伝説', 'memo' => 'アドベンチャー', 'price' => 7500],
        ['name' => 'スプラトゥーン', 'memo' => 'シューティング', 'price' => 6000],
        ['name' => 'ドラクエ', 'memo' => 'RPG', 'price' => 7000],
        ['name' => 'マリオカート', 'memo' => 'レース', 'price' => 5000],
        ['name' => 'バイオハザード', 'memo' => 'ホラー', 'price' => 9000],
        ['name' => 'テトリス', 'memo' => 'パズル', 'price' => 3000],
        ['name' => 'グランツーリスモ', 'memo' => 'レース', 'price' => 8000],
        ['name' => 'ポケモン', 'memo' => 'RPG', 'price' => 6000],
        ['name' => 'フォートナイト', 'memo' => 'バトルロイヤル', 'price' => 0],
        ['name' => 'アサシンクリード', 'memo' => 'アクション', 'price' => 7500],
        ['name' => 'デッドバイデイライト', 'memo' => 'ホラー', 'price' => 4000],
        ['name' => 'マインクラフト', 'memo' => 'サバイバル', 'price' => 3000],
        ['name' => 'GTA V', 'memo' => 'オープンワールド', 'price' => 6000],
        ['name' => 'アニメーションマスター', 'memo' => 'シミュレーション', 'price' => 2000],
        ['name' => 'リングフィット', 'memo' => 'フィットネス', 'price' => 8000],
        ['name' => 'ドラゴンズドグマ', 'memo' => 'RPG', 'price' => 7000],
        ['name' => 'ウィッチャー3', 'memo' => 'RPG', 'price' => 10000],
        ['name' => 'バトルフィールド', 'memo' => 'シューティング', 'price' => 8000],
        ['name' => 'ディスガイア', 'memo' => 'RPG', 'price' => 4000],
        ['name' => 'ダークソウル', 'memo' => 'アクション', 'price' => 8000],
        ['name' => 'フォールアウト', 'memo' => 'RPG', 'price' => 9000],
        ['name' => 'ニーアオートマタ', 'memo' => 'アクション', 'price' => 8000],
        ['name' => 'セキロ', 'memo' => 'アクション', 'price' => 7000],
        ['name' => 'バイオショック', 'memo' => 'アクション', 'price' => 5000],
        ['name' => 'トゥームレイダー', 'memo' => 'アクション', 'price' => 6000],
        ['name' => 'スターデューバレー', 'memo' => 'シミュレーション', 'price' => 2000]
     ]);
    }
}
