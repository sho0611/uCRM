<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGamesRequest;
use App\Http\Requests\UpdateGamesRequest;
use App\Models\Games;
use Inertia\Inertia;


class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Games::select('id', 'name','memo','price')->get();
        return Inertia::render('Games/Index',[
            'games' => $games
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Games/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGamesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGamesRequest $request)
    {
        Games::create([
            'name' => $request->name,
            'memo' => $request->memo,
            'price' => $request->price
        ]);

        return to_route('games.index')
        ->with([
            'message' => '登録しました',
            'status' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function show(Games $game)
    {
        return Inertia::render('Games/Show',[
            'game' => $game
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function edit(Games $game)
    {
        return Inertia::render('Games/Edit',[
            'game' => $game
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGamesRequest  $request
     * @param  \App\Models\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGamesRequest $request, Games $game)
    {
        $game->name = $request->name;
        $game->memo = $request->memo;
        $game->price = $request->price;
        $game->save();

        return to_route('games.index')->with([
            'message' => '登録しました',
            'status' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Games  $games
     * @return \Illuminate\Http\Response
     */
    public function destroy(Games $game)
    {
    
    }
}
