<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\HScode_9digits;
use App\Models\HScode_4digits;

class ExportabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $HScode_id = $request->query('HScode');
        $HScode_data = HScode_9digits::get9digit_TableContents_fromID($HScode_id);

        $tmp = $HScode_data->HScode_4;

        $category = HScode_4digits::get4digit_TableContents($tmp);

        $Country = $request->query('Country');
        $Country_id = Country::getCountry_id($Country);

        return view('exportability.create', compact('HScode_id','HScode_data','category','Country_id','Country') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
