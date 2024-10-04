<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchasinfoRequest;
use App\Http\Requests\UpdatePurchasinfoRequest;
use App\Models\Purchasinfo;

class PurchasinfoController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePurchasinfoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchasinfoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchasinfo  $purchasinfo
     * @return \Illuminate\Http\Response
     */
    public function show(Purchasinfo $purchasinfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchasinfo  $purchasinfo
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchasinfo $purchasinfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchasinfoRequest  $request
     * @param  \App\Models\Purchasinfo  $purchasinfo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchasinfoRequest $request, Purchasinfo $purchasinfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchasinfo  $purchasinfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchasinfo $purchasinfo)
    {
        //
    }
}
