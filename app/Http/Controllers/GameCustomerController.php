<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoregameCustomerRequest;
use App\Http\Requests\UpdategameCustomerRequest;
use App\Models\gameCustomer;
use Inertia\Inertia;
use Illuminate\Http\Request;

class GameCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $gameCustomers = gameCustomer::SearchCustomers($request->search)
        ->select('id', 'name', 'kana', 'tel')
        ->paginate(50);

        return Inertia::render('Gamecustomers/Index', [
            'gameCustomers' => $gameCustomers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoregameCustomerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoregameCustomerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\gameCustomer  $gameCustomer
     * @return \Illuminate\Http\Response
     */
    public function show(gameCustomer $gameCustomer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\gameCustomer  $gameCustomer
     * @return \Illuminate\Http\Response
     */
    public function edit(gameCustomer $gameCustomer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdategameCustomerRequest  $request
     * @param  \App\Models\gameCustomer  $gameCustomer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdategameCustomerRequest $request, gameCustomer $gameCustomer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\gameCustomer  $gameCustomer
     * @return \Illuminate\Http\Response
     */
    public function destroy(gameCustomer $gameCustomer)
    {
        //
    }
}
