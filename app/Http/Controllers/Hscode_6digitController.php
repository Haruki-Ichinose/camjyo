<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HScode_4digits;
use App\Models\HScode_9digits;

class Hscode_6digitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $num = $request->input('number');

        $Table_of_4digit_Contents = HScode_4digits::get4digit_TableContents($num);
        $Table_of_9digit_Contents = HScode_9digits::get9digit_TableContents($num);

        // cttはcontents(内容)の略語のつもりです。 
        return view('9digit.index', ['four_digit_ctt' => $Table_of_4digit_Contents,'nine_digit_ctt' => $Table_of_9digit_Contents]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(string $id)
    {
        //
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
