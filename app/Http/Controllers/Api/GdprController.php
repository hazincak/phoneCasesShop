<?php

namespace App\Http\Controllers\api;

use App\Gdpr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GdprController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Gdpr::get();
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
            'gdprRules' => 'required|min:50'
        ]);

        $gdprRules = Gdpr::create([
            'gdpr' => $request->gdprRules,
        ]);

        $gdprRules->save();

        return $gdprRules;
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
            'updatedRules' => 'required|min:50'
        ]);

        $gdpr = Gdpr::findOrFail($id);

        $gdpr->update([
            'gdpr' => $validatedData['updatedRules']
        ]);
        $gdpr->save();
        return $gdpr;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gdpr = Gdpr::FindOrFail($id);

        $gdpr->delete();
    }
}
