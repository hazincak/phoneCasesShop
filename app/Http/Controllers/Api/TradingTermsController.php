<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\TradingTerm;
use Illuminate\Http\Request;

class TradingTermsController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:manipulateContent')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return TradingTerm::get();
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tradingTerms' => 'required|min:50'
        ]);

        $terms = TradingTerm::create([
            'terms' => $request->tradingTerms,
        ]);

        $terms->save();

        return $terms;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'updatedTerms' => 'required|min:50'
        ]);

        $terms = TradingTerm::findOrFail($id);

        $terms->update([
            'terms' => $validatedData['updatedTerms']
        ]);

        $terms->save();
        return $terms;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $terms = TradingTerm::findOrFail($id);

        $terms->delete();
    }
}
