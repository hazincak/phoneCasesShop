<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\ReturnAndRefundPolicy;
use Illuminate\Http\Request;

class ReturnAndRefundController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ReturnAndRefundPolicy::get();
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
            'returnAndRefundPolicy' => 'required|min:50'
        ]);

        $policies = ReturnAndRefundPolicy::create([
            'return_and_refund_policies' => $request->returnAndRefundPolicy,
        ]);

        $policies->save();

        return $policies;
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
            'updatedPolicies' => 'required|min:50'
        ]);

        $policy = ReturnAndRefundPolicy::findOrFail($id);

        $policy->update([
            'return_and_refund_policies' => $validatedData['updatedPolicies']
        ]);
        $policy->save();
        return $policy;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $policies = ReturnAndRefundPolicy::findOrFail($id);

        $policies->delete();
    }
}
